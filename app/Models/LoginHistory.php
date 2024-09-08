<?php

namespace App\Models;

use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\LoginHistory
 *
 * @property int $id
 * @property int $user_id
 * @property string $ip_address
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LoginHistory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LoginHistory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LoginHistory query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LoginHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LoginHistory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LoginHistory whereIpAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LoginHistory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LoginHistory whereUserId($value)
 * @property string $user_code
 * @property string $user_name
 * @property int $number_hits
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LoginHistory whereNumberHits($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LoginHistory whereUserCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LoginHistory whereUserName($value)
 * @property-read \App\Models\User|null $user
 * @property int|null $user_type 1: người dùng , 2: nghi vấn
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder|LoginHistory all($columns = [])
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder|LoginHistory avg($column)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder|LoginHistory cache(array $tags = [])
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder|LoginHistory cachedValue(array $arguments, string $cacheKey)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder|LoginHistory count($columns = '*')
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder|LoginHistory disableCache()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder|LoginHistory disableModelCaching()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder|LoginHistory exists()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder|LoginHistory flushCache(array $tags = [])
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder|LoginHistory getModelCacheCooldown(\Illuminate\Database\Eloquent\Model $instance)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder|LoginHistory inRandomOrder($seed = '')
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder|LoginHistory insert(array $values)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder|LoginHistory isCachable()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder|LoginHistory max($column)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder|LoginHistory min($column)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder|LoginHistory sum($column)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder|LoginHistory truncate()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder|LoginHistory whereUserType($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder|LoginHistory withCacheCooldownSeconds(?int $seconds = null)
 * @mixin \Eloquent
 */
class LoginHistory extends Model
{
    use Cachable;
    protected $table = 'login_history';
    protected $table_name = "Lịch sử đăng nhập";
    protected $fillable = [
        'user_id',
        'user_code',
        'user_name',
        'ip_address',
        'number_hits',
    ];

    public function user() {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
    public static function setLoginHistory($profile, $ip) {
        $user = LoginHistory::where('user_id', '=', $profile->user_id)
            ->orderBy('created_at', 'DESC')
            ->first(['number_hits']);

        $model = new LoginHistory();
        $model->user_id = $profile->user_id;
        $model->user_code = $profile->code;
        $model->user_name = $profile->lastname . ' ' . $profile->firstname;
        $model->ip_address =$ip;
        if ($user){
            $model->number_hits = $user->number_hits + 1;
        }else{
            $model->number_hits = 1;
        }
        $model->save();
    }


    public static function getLoginHistoryByYear($user_id){
        $user_login = LoginHistory::where('user_id', '=', $user_id)
            ->where(\DB::raw('year(created_at)'), '=', date('Y'))
            ->count();

        return $user_login;
    }
}
