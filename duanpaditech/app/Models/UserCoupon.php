<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Cookie;

class UserCoupon extends Model
{
    /** @var string */
    protected $table = 'user_coupon';

    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'coupon_id',
        'app_id'
    ];

    use HasFactory;

    public function app(): BelongsTo
    {
        return $this->belongsTo(App::class);
    }

    /**
     * @param int $userId
     * @return Collection
     */
    public function getCouponIdsByUserIdAndAppId(int $userId, int $appId): Collection
    {
        return UserCoupon::query()
            ->where('user_coupon.user_id', '=', $userId)
            ->where('user_coupon.app_id', '=', $appId)
            ->where('user_coupon.status', '=', 0)
            ->get();
    }

    /**
     * @param int $couponId
     * @return Model
     */
    public function getCouponDetailByCouponId(int $couponId): Model
    {
        return UserCoupon::query()
            ->where('user_coupon.user_id', Cookie::get('user_id'))
            ->where('user_coupon.coupon_id', $couponId)
            ->where('user_coupon.status', '=', 0)
            ->first();
    }

    /**
     * @param int $userId
     * @return Collection
     */
    public function getCouponListByUserIdAndCouponId(int $userId): Collection
    {
        return UserCoupon::with('app')
            ->join('coupons', 'coupons.id', '=', 'user_coupon.coupon_id')
            ->where('user_coupon.user_id', '=', $userId)
            ->where('user_coupon.status', '=', 0)
            ->select(['coupons.*'])
            ->get();
    }

    /**
     * @param int $appId
     * @return Collection
     */
    public function getCouponsByUserIdAndAppId(int $appId): Collection
    {
        return UserCoupon::query()
            ->join('users', 'users.id', '=', 'user_coupon.user_id')
            ->join('coupons', 'coupons.id', '=', 'user_coupon.coupon_id')
            ->where('user_coupon.app_id', '=', $appId)
            ->select(['coupons.name as coupon_name', 'users.phonenumber', 'user_coupon.created_at'])
            ->get();
    }

    /**
     * @param int $appId
     * @param $start_date
     * @param $end_date
     * @return Collection
     */
    public function getCouponsByDateRange(int $appId, $start_date, $end_date): Collection
    {
        return UserCoupon::query()
            ->join('users', 'users.id', '=', 'user_coupon.user_id')
            ->join('coupons', 'coupons.id', '=', 'user_coupon.coupon_id')
            ->where('user_coupon.app_id', '=', $appId)
            ->whereBetween('user_coupon.created_at', array($start_date, $end_date))
            ->select(['coupons.name as coupon_name', 'users.phonenumber', 'user_coupon.created_at'])
            ->get();
    }

    /**
     * @return Collection
     */
    public function getCouponsWithoutAppId(): Collection
    {
        return UserCoupon::query()
            ->join('users', 'users.id', '=', 'user_coupon.user_id')
            ->join('coupons', 'coupons.id', '=', 'user_coupon.coupon_id')
            ->select(['coupons.name as coupon_name', 'users.phonenumber', 'user_coupon.created_at'])
            ->get();
    }

    /**
     * @param $start_date
     * @param $end_date
     * @return Collection
     */
    public function getCouponsByDateRangeWithoutAppID($start_date, $end_date): Collection
    {
        return UserCoupon::query()
            ->join('users', 'users.id', '=', 'user_coupon.user_id')
            ->join('coupons', 'coupons.id', '=', 'user_coupon.coupon_id')
            ->whereBetween('user_coupon.created_at', array($start_date, $end_date))
            ->select(['coupons.name as coupon_name', 'users.phonenumber', 'user_coupon.created_at'])
            ->get();
    }

}
