<?php

namespace App\Http\Controllers\Admin;

use App\Exports\UserCouponExport;
use App\Http\Controllers\Controller;
use App\Models\UserCoupon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class UserCouponController extends Controller
{
    /** @var UserCoupon */
    private $userCoupon;

    /**
     * Constructs.
     */
    public function __construct()
    {
        $this->userCoupon = new UserCoupon();
    }

    /**
     * List user coupons.
     *
     * @param Request $request
     * @return Renderable
     */
    public function index(Request $request): Renderable
    {
        if ($request->start_date == null || $request->end_date == null) {
            if (!Auth::guard('admin')->user()->app_id) {
                return view('admin.usercoupon.index')
                    ->with(['data' => $this->userCoupon->getCouponsWithoutAppId()]);
            }
            return view('admin.usercoupon.index')
                ->with(['data' => $this->userCoupon->getCouponsByUserIdAndAppId(Auth::guard('admin')->user()->app_id)]);
        }
        $start_date = Carbon::parse($request->start_date);
        $end_date = Carbon::parse($request->end_date)->addHours(24);
        Session::put('start_date', $start_date);
        Session::put('end_date', $end_date);

        if (!Auth::guard('admin')->user()->app_id) {
            return view('admin.usercoupon.index')
                ->with(['data' => $this->userCoupon->getCouponsByDateRangeWithoutAppID($start_date, $end_date)]);
        }

        return view('admin.usercoupon.index')
            ->with(['data' => $this->userCoupon->getCouponsByDateRange((Auth::guard('admin')->user()->app_id), $start_date, $end_date)]);
    }

    /**
     * Export CSV.
     *
     * @return BinaryFileResponse
     */
    public function exportFile()
    {
        if (Session::get('start_date')) {
            return Excel::download(new UserCouponExport, Session::get('start_date')->format('Ymd') . '_sent_coupon.csv');
        }

        return Excel::download(new UserCouponExport, Carbon::now()->format('Ymd') . '_sent_coupon.csv');
    }

}
