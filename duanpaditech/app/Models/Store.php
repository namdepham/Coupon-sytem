<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class Store extends Model
{
    use HasFactory;

    /** @var string */
    protected $table = 'stores';

    /**
     * @return BelongsTo
     */
    public function app(): BelongsTo
    {
        return $this->belongsTo(App::class);
    }

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'app_id',
        'address',
    ];

    /**
     * Get all stores.
     *
     * @return LengthAwarePaginator
     */
    public function getAllStores(): LengthAwarePaginator
    {
        $appId = Auth::guard('admin')->user()->app_id;
        $query = Store::query()
            ->join('apps', 'stores.app_id', '=', 'apps.id')
            ->select(['apps.*', 'stores.*'])
            ->where('apps.id', '=', $appId)
            ->orderBy('stores.id', 'desc')
            ->paginate(5);

        if (!$appId) {
            $query = Store::query()
                ->join('apps', 'stores.app_id', '=', 'apps.id')
                ->select(['apps.*', 'stores.*'])
                ->orderBy('stores.id', 'desc')
                ->paginate(5);
        }

        return $query;
    }
}
