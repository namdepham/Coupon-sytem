<?php

namespace App\Models;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class App extends Model
{
    /**
     * @var string
     */
    protected $table = 'apps';

    /**
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'logo'
    ];
    use HasFactory, SoftDeletes;

    /**
     * Relationship with users.
     *
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'app_user');
    }

    /**
     * Relationship with stamp.
     *
     * @return HasOne
     */
    public function stamp(): HasOne
    {
        return $this->hasOne(Stamp::class);
    }

    /**
     * @return LengthAwarePaginator
     */
    public function getAllApps(): LengthAwarePaginator
    {
        return App::query()->orderBy('id', 'desc')->paginate(5);
    }

    /**
     * @param int $id
     * @return Model
     */
    public function getAnApp(int $id): Model
    {
        return App::query()->where('apps.id', '=', $id)->first();
    }
}
