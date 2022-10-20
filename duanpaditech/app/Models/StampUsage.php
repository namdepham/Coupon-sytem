<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StampUsage extends Model
{
    protected $fillable = [
        'stamp_id',
        'user_id',
    ];
    use HasFactory;

    /**
     * @return BelongsTo
     */
    public function stamp(): BelongsTo
    {
        return $this->belongsTo(Stamp::class);
    }

    /**
     * @param int $userId
     * @param int $stampId
     * @return Collection
     */
    public function getStampUser(int $userId, int $stampId): Collection
    {
        return StampUsage::query()
            ->where('stamp_usages.user_id', $userId)
            ->where('stamp_usages.stamp_id', $stampId)
            ->get();
    }
}
