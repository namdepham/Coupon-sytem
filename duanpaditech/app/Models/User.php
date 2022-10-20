<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'phonenumber'
    ];

    /**
     * Relationship with apps.
     *
     * @return BelongsToMany
     */
    public function apps(): belongsToMany
    {
        return $this->belongsToMany(App::class, 'app_user');
    }
}
