<?php

namespace App\Exports;

use App\Models\UserCoupon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UserCouponExport implements FromCollection, WithHeadings
{
    /** @var UserCoupon */
    private $userCoupon;

    /**
     * Construction.
     */
    public function __construct()
    {
        $this->userCoupon = new UserCoupon();
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        if ((Session::get('start_date') == null || Session::get('end_date') == null) && !Auth::guard('admin')->user()->app_id) {
            return $this->userCoupon->getCouponsWithoutAppId();
        }
        if (!Auth::guard('admin')->user()->app_id) {
            return $this->userCoupon->getCouponsByDateRangeWithoutAppID(Session::get('start_date'), Session::get('end_date'));
        }
        if (Session::get('start_date') == null || Session::get('end_date') == null && isset(Auth::guard('admin')->user()->app_id)) {
            return $this->userCoupon->getCouponsByUserIdAndAppId(Auth::guard('admin')->user()->app_id);
        }
        return $this->userCoupon->getCouponsByDateRange((Auth::guard('admin')->user()->app_id), Session::get('start_date'), Session::get('end_date'));
    }

    /**
     * @return string[]
     */
    public function headings(): array
    {
        return ["Coupon name", "User phonenumber", "Get coupon at"];
    }
}
