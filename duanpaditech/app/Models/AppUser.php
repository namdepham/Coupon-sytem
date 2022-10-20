<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AppUser extends Model
{
    /** @var string */
    protected $table = "app_user";
    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id', 'app_id', 'stamp_id'
    ];

    /**
     * @return BelongsTo
     */
    public function app(): belongsTo
    {
        return $this->belongsTo(App::class);
    }

    /**
     * @return BelongsTo
     */
    public function stamp(): belongsTo
    {
        return $this->belongsTo(Stamp::class);
    }

    use HasFactory;

    /**
     * @param int $stampID
     * @param int $userID
     * @return \Illuminate\Database\Eloquent\Builder|Model|object|null
     */
    public function getDataAppUserStamp(int $stampID, int $userID)
    {
        return
            AppUser::query()
                ->with
                ([
                    'stamp.usages' => function ($query) use ($userID) {
                        $query->where('stamp_usages.user_id', '=', $userID);
                    },
                    'stamp.images' => function ($query) {
                        $query->select('stamp_images.*');
                    }
                ])
                ->join('stamps', 'stamps.id', '=', 'app_user.stamp_id')
                ->join('apps', 'apps.id', '=', 'app_user.app_id')
                ->where('app_user.stamp_id', $stampID)
                ->where('app_user.user_id', $userID)
                ->first();
    }
}
