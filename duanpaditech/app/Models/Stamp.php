<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class Stamp extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'stamps';

    /**
     * @var string[]
     */
    protected $fillable = [
        'app_id',
        'config_stamp',
        'in_many_times',
        'stamp_id'
    ];

    /**
     * @return belongsTo
     */
    public function app(): belongsTo
    {
        return $this->belongsTo(App::class);
    }

    /**
     * @return HasMany
     */
    public function images(): HasMany
    {
        return $this->hasMany(StampImage::class);
    }

    /**
     * @return HasMany
     */
    public function coupons(): hasMany
    {
        return $this->hasMany(Coupon::class);
    }

    /**
     * @return HasMany
     */
    public function users(): hasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * @return HasMany
     */
    public function usages(): hasMany
    {
        return $this->hasMany(StampUsage::class);
    }

    /**
     * Get a stamp.
     *
     * @param int $stamp_id
     * @return Model
     */
    public function getStamp(int $stamp_id): Model
    {
        return Stamp::query()->where('id', '=', $stamp_id)->first();
    }

    /**
     * Get stamp with app.
     *
     * @param int $appId
     * @return Model
     */
    function getStampApp(int $appId): Model
    {
        return Stamp::query()
            ->join('apps', 'stamps.app_id', '=', 'apps.id')
            ->where('apps.id', '=', $appId)
            ->get(['apps.*', 'stamps.*'])
            ->first();
    }

    /**
     * Get all stamps.
     *
     * @return Collection
     */
    function getStamps(): Collection
    {
        if (Auth::guard('admin')->user()->app_id) {
            return Stamp::query()
                ->join('apps', 'stamps.app_id', '=', 'apps.id')
                ->where('apps.id', '=', Auth::guard('admin')->user()->app_id)
                ->get(['apps.name', 'stamps.*']);
        }
        return Stamp::query()
            ->join('apps', 'stamps.app_id', '=', 'apps.id')
            ->get(['apps.name', 'stamps.*']);
    }

    /**
     * @param int $appId
     * @return Collection
     */
    public function getCouponStamp(int $appId)
    {
        return Stamp::query()
            ->whereHas('app', function ($query) use ($appId) {
                $query->where('app_id', $appId);
            })
            ->whereHas('coupons', function ($query) {
                $query->select('coupons.*');
            })
            ->whereHas('images', function ($query) {
                $query->select('images.*');
            })
            ->get();
    }
}
