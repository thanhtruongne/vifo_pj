<?php

namespace App\Models;

use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;

class ProviderManager extends Model
{
    use Cachable;
    protected $table = 'provider_manager';
    protected $table_name = "Thông tin nhà cung cấp";
    protected $fillable = [
        'provider_code',
        'user_code',
        'provider_id',
        'user_id',
        'type',
    ];

    public function user() {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
}
