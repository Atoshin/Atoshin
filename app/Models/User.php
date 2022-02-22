<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use \Eloquence\Behaviours\CamelCasing;


    protected $guarded = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
//    protected $fillable = [
//        'name',
//        'email',
//        'password',
//    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
        'email'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

//    public function wallet()
//    {
//        return $this->hasOne(Wallet::class);
//    }

    public function signatures()
    {
        return $this->hasMany(Signature::class);
    }

    public function media()
    {
        return $this->morphOne(Media::class, 'mediable');
    }

    public function wallet()
    {
        return $this->morphOne(Wallet::class, 'walletable');
    }

    public function getAvatarUrlAttribute()
    {
        return env('APP_URL') . '/' . $this->avatar;
    }
}
