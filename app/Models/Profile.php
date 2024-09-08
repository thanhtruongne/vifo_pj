<?php

namespace App\Models;

use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use Cachable;
    protected $table = 'profile';
    protected $table_name = "Thông tin tài khoản";
    protected $fillable = [
        'user_id',
        'code',
        'lastname',
        'firstname',
        'dob',
        'address',
        'email',
        'identity_card',
        'date_range',
        'issued_by',
        'gender',
        'phone',
        'status',
        'avatar',
        'id_code',
        'referer',
        'role',
        'marriage',
        'created_by',
        'updated_by',
    ];

    public function user() {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
}
