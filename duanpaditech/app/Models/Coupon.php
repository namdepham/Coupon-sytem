<?php

namespace App\Models;

use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'description',
        'config_coupon',
        'app_id',
        'stamp_id'
    ];

    /**
     * Relationship with app.
     *
     * @return belongsTo
     */
    public function app(): belongsTo
    {
        return $this->belongsTo(App::class);
    }

    /**
     * @return BelongsTo
     */
    public function stamp():belongsTo
    {
        return $this->belongsTo(Stamp::class);
    }

    /**
     * Get all coupons.
     *
     * @return LengthAwarePaginator
     */
    public function getAllCoupons(): LengthAwarePaginator
    {
        if (! Auth::guard('admin')->user()) {
            abort(403);
        }
        if (! Auth::guard('admin')->user()->app_id ) {
            return Coupon::with('app')
                ->select('coupons.*')
                ->orderBy('coupons.id', 'desc')
                ->paginate(5);
        }
        return Coupon::query()
            ->join('apps', 'apps.id', '=', 'coupons.app_id')
            ->select(['coupons.*', 'apps.name as app_name'])
            ->where('apps.id', '=', Auth::guard('admin')->user()->app_id)
            ->paginate(5);
    }

    /**
     * Get a specific coupon.
     *
     * @param int $id
     * @return Model
     */
    public function getACoupon(int $id): Model
    {
        return Coupon::with('app')
            ->select(['coupons.*'])
            ->where('coupons.id', '=', $id)
            ->first();
    }

    /**
     * @param int $stampId
     * @return Collection
     */
    public function getCouponsByStampId(int $stampId): Collection
    {
        return Coupon::query()
            ->where('coupons.stamp_id', $stampId)
            ->get();
    }
}
