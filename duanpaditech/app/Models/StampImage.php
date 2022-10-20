<?php

namespace App\Models;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class StampImage extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = "stamp_images";

    /**
     * @var string[]
     */
    protected $fillable = [
        'stamp_id',
        'image_before_ticked',
        'image_after_ticked'
    ];

    /**
     * @return BelongsTo
     */
    public function stamp(): BelongsTo
    {
        return $this->belongsTo(Stamp::class);
    }

    /**
     * Get all images.
     *
     * @return LengthAwarePaginator
     */
    public function getAllImages(): LengthAwarePaginator
    {
        if (!Auth::guard('admin')->user()->app_id) {
            return StampImage::with('stamp', 'stamp.app')->paginate(5);
        }
        return StampImage::query()
            ->with('stamp')
            ->whereHas('stamp.app', function ($query) {
                $query->where('apps.id', Auth::guard('admin')->user()->app_id);
            })
            ->paginate(5);
    }

    /**
     * Get specific data.
     *
     * @param int $id
     * @return Model
     */
    public function getAImage(int $id): Model
    {
        return StampImage::with('stamp', 'stamp.app')
            ->where('stamp_images.id', '=', $id)
            ->first();
    }

    /**
     * @param int $stampId
     * @return Collection
     */
    public function getImagesByStampId(int $stampId): Collection
    {
        return StampImage::query()
            ->where('stamp_images.stamp_id', $stampId)
            ->get();
    }
}
