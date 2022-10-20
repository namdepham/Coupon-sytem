<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CouponStoreRequest;
use App\Models\App;
use App\Models\Coupon;
use App\Models\Stamp;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class CouponController extends Controller
{
    /** @var Coupon */
    private $coupon;

    /** @var App */
    private $app;

    /** @var Stamp */
    private $stamp;

    /**
     * Construct coupon.
     */
    public function __construct()
    {
        $this->coupon = new Coupon();
        $this->app = new App();
        $this->stamp = new Stamp();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        return view('admin.coupon.index')->with(['data' => $this->coupon->getAllCoupons()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Renderable
     */
    public function create(): Renderable
    {
        if (!Auth::guard('admin')->user()->app_id) {
            return view('admin.coupon.create')->with(['apps' => $this->app->getAllApps(), 'stamps' => $this->stamp->getStamps()]);
        } else {
            $appId = Auth::guard('admin')->user()->app_id;
            $stamp_id = $this->app->getAnApp($appId)->stamp->id;

            return view('admin.coupon.create')->with(['apps' => $this->app->getAllApps(), 'stamp_id' => $stamp_id]);
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CouponStoreRequest $request
     * @return RedirectResponse
     */
    public function store(CouponStoreRequest $request): RedirectResponse
    {
        if ($request->has('image')) {
            $filePath = $request['image']->storeAs('uploads', request('image')->getClientOriginalName(), 'public');
        }
        $inputs = [
            'name' => $request->input('name'),
            'image' => $filePath,
            'description' => $request->input('description'),
            'config_coupon' => $request->input('config_coupon'),
            'app_id' => $request->input('app_id'),
            'stamp_id' => $request->input('stamp_id')
        ];
        Coupon::create($inputs);

        return redirect()->route('coupon.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Renderable
     */
    public function show(int $id): Renderable
    {
        return view('admin.coupon.edit')->with(['data' => $this->coupon->getACoupon($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CouponStoreRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(CouponStoreRequest $request, int $id): RedirectResponse
    {
        $coupon = Coupon::find($id);

        if ($request->has('image')) {
            $filePath = $request['image']->storeAs('uploads', request('image')->getClientOriginalName(), 'public');
        }
        $coupon->name = $request->input('name');
        $coupon->image = $filePath;
        $coupon->description = $request->input('description');
        $coupon->config_coupon = $request->input('config_coupon');
        $coupon->app_id = $request->input('app_id');
        $coupon->stamp_id = $request->input('stamp_id');

        $coupon->save();

        return redirect()->route('coupon.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $this->coupon->getACoupon($id)->delete();

        return redirect()->route('coupon.index');
    }
}
