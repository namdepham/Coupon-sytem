<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddStampRequest;
use App\Http\Requests\ListStampUserRequest;
use App\Models\AppUser;
use App\Models\Coupon;
use App\Models\Stamp;
use App\Models\StampImage;
use App\Models\StampUsage;
use App\Models\User;
use App\Models\UserCoupon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Vonage\Client;
use Vonage\Insights\Basic;
use Vonage\SMS\Message\SMS;


class HomeController extends Controller
{
    /** @var Coupon */
    private $coupon;

    /** @var Stamp */
    private $stamp;

    /** @var StampUsage */
    private $usage;

    /** @var StampImage */
    private $image;

    /** @var UserCoupon */
    private $userCoupon;

    /**
     * Construct home.
     */
    public function __construct()
    {
        $this->coupon = new Coupon();
        $this->stamp = new Stamp();
        $this->usage = new StampUsage();
        $this->image = new StampImage();
        $this->userCoupon = new UserCoupon();
        $this->appUser = new AppUser();
    }

    /**
     * Show the application dashboard.
     *
     * @param int $storeId
     * @param int $appId
     * @return Renderable
     */
    public function index(int $appId, int $storeId): Renderable
    {
        $stampId = $this->stamp->getStampApp($appId)->id;
        $userId = Cookie::get('user_id');
        $coupons = $this->coupon->getCouponsByStampId($stampId);
        $stampUsages = $this->usage->getStampUser($userId, $stampId)->toArray();
        $stamp = $this->stamp->getStampApp($appId);
        $stampImages = $this->image->getImagesByStampId($stampId);

        if (count($stampUsages) >= $stamp->config_stamp) {
            StampUsage::destroy(StampUsage::where('user_id', $userId)->get());
        }

        if ($stamp->in_many_times == 1) {
            StampUsage::create([
                'stamp_id' => $stampId,
                'user_id' => $userId,
            ]);
        }
        if ($stamp->in_many_times == 0 && count($stampUsages) == 0) {
            StampUsage::updateOrCreate([
                'stamp_id' => $stampId,
                'user_id' => $userId,
            ]);
        }
        for ($key = 0; $key < count($coupons); $key++) {
            if (count($stampUsages) == $coupons[$key]->config_coupon) {
                UserCoupon::updateOrCreate([
                    'user_id' => $userId,
                    'coupon_id' => $coupons[$key]->id,
                    'app_id' => $appId
                ]);
                $basic  = new Client\Credentials\Basic("3e23c47b", "QhsBeuf9wTAipyVu");
                $client = new Client($basic);
                $client->sms()->send(
                    new SMS("84904525881", "84989591069", 'A text message sent using the Nexmo SMS API')
                );
            }
        }
        Session::put('numberOfCoupons', count($this->userCoupon->getCouponIdsByUserIdAndAppId($userId, $appId)->toArray()));
        Session::put('store_id', $storeId);
        Session::put('app_id', $appId);
        $couponLists = $this->userCoupon->getCouponListByUserIdAndCouponId($userId);

        return view('user.home')->with(['data' => $stampImages, 'count' => $stampUsages, 'couponLists' => $couponLists]);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function couponDetail(int $id): JsonResponse
    {
        $data = Coupon::find($id);

        return response()->json(['detail' => $data]);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function couponUse(int $id): JsonResponse
    {
        $coupon = $this->userCoupon->getCouponDetailByCouponId($id);
        $coupon->status = 1;
        $coupon->save();

        return response()->json(['statusCode' => 200]);
    }

    /**
     * List stamp.
     *
     * @param ListStampUserRequest $request
     * @return
     */
    public function listStampUser(ListStampUserRequest $request): JsonResponse
    {
        $phonenumber = $request->get('phonenumber');
        $appID = $request->get('app');
        $stampID = Stamp::query()->where('stamps.app_id', $appID)->first()->id;
        $userID = User::query()->where('phonenumber', $phonenumber)->first()->id;
        $data = $this->appUser->getDataAppUserStamp($stampID, $userID);

        $stamps = new Collection();
        $stampUsages = $data->stamp->usages->toArray();
        $stampImages = $data->stamp->images;
        for ($key = 0; $key < count($stampImages); $key++) {
            $stampImages[$key] = isset($stampUsages[$key])
                ? $stamps->push("https://3f7c-14-248-94-44.ap.ngrok.io/storage/".$stampImages[$key]->image_after_ticked)
                : $stamps->push("https://3f7c-14-248-94-44.ap.ngrok.io/storage/".$stampImages[$key]->image_before_ticked);
        }

        return response()->json(['app_name' => $data->name, 'max_stamp' => $data->config_stamp, 'stamp_images' => $stamps]);
    }

    /**
     * Add stamp.
     *
     * @param AddStampRequest $request
     * @return JsonResponse
     */
    public function addStampUser(AddStampRequest $request): JsonResponse
    {
        $phonenumber = $request->get('phonenumber');
        $users = User::all()->pluck('phonenumber')->toArray();
        if (! in_array($phonenumber, $users)) {
            User::create([
                'phonenumber' => $request->get('phonenumber'),
                'name' => "User"
            ]);
        }
        $appID = $request->get('app');
        $userID = User::query()->where('phonenumber', $phonenumber)->first()->id;
        $stampID = Stamp::query()->where('stamps.app_id', $appID)->first()->id;
        $stampUsages = $this->usage->getStampUser($userID, $stampID)->toArray();
        $stamp = $this->stamp->getStampApp($appID);

        AppUser::updateOrCreate([
            'app_id' => $appID,
            'user_id' => $userID,
            'stamp_id' => $stampID
        ]);

        if (count($stampUsages) > $stamp->config_stamp) {
            StampUsage::destroy(StampUsage::where('user_id', $userID)->get());
        }

        if ($stamp->in_many_times == 1) {
            StampUsage::create([
                'stamp_id' => $stampID,
                'user_id' => $userID,
            ]);
        }
        if ($stamp->in_many_times == 0 && count($stampUsages) == 0) {
            StampUsage::updateOrCreate([
                'stamp_id' => $stampID,
                'user_id' => $userID,
            ]);
        }

        $stampUsages = $this->usage->getStampUser($userID, $stampID)->toArray();
        $coupons = $this->coupon->getCouponsByStampId($stampID);

        for ($key = 0; $key < count($coupons); $key++) {
            if (count($stampUsages) == $coupons[$key]->config_coupon && count($stampUsages) >= $coupons[$key]->config_coupon) {
                UserCoupon::updateOrCreate([
                    'user_id' => $userID,
                    'coupon_id' => $coupons[$key]->id,
                    'app_id' => $appID
                ]);
            }
        }

        return response()->json(['status' => "true"]);
    }
}

