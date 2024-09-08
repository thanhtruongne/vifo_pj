<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, Cachable;


    private $user = null;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'firstname',
        'lastname',
        'code',
        'last_online',
        'auth'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];



    public function provider(){
        return $this->belongsTo(ProviderManager::class,'id','user_id');
    }

    private function getIntance(){
        if (self::$user === null) self::$user = Auth::user();
        return self::$user;
    }

    public static function isAdmin(){
        if (in_array(Auth::user()->username, ['admin']))
           return true;
        return self::getInstance()->roles()->where('name', 'admin')->count();
    }
}
