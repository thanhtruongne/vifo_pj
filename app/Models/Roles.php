<?php

namespace App\Models;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;

/**
 * App\Models\Role
 *
 * @property int $id
 * @property string $name
 * @property int $type
 * @property string $guard_name
 * @property string $description
 * @property int $created_by
 * @property int $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role query()
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereGuardName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereUpdatedBy($value)
 * @property string|null $code
 * @property int|null $unit_by
 * @property int|null $status 1 hiệu lực, 0 không hiệu lực
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder|Roles all($columns = [])
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder|Roles avg($column)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder|Roles cache(array $tags = [])
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder|Roles cachedValue(array $arguments, string $cacheKey)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder|Roles count($columns = '*')
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder|Roles disableCache()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder|Roles disableModelCaching()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder|Roles exists()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder|Roles flushCache(array $tags = [])
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder|Roles getModelCacheCooldown(\Illuminate\Database\Eloquent\Model $instance)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder|Roles inRandomOrder($seed = '')
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder|Roles insert(array $values)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder|Roles isCachable()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder|Roles max($column)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder|Roles min($column)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder|Roles sum($column)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder|Roles truncate()
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder|Roles whereCode($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder|Roles whereStatus($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder|Roles whereUnitBy($value)
 * @method static \GeneaLabs\LaravelModelCaching\CachedBuilder|Roles withCacheCooldownSeconds(?int $seconds = null)
 * @mixin \Eloquent
 */
class Roles extends Model
{
    use Cachable;
    protected $table = 'roles';
    protected $table_name = "Vai trò của vifo";
    protected $fillable = [
        'code',
        'name',
        'type',
        'guard_name',
        'description',
        'created_by',
        'updated_by',
        'status'
    ];
    protected $primaryKey = 'id';

    public static function getAttributeName() {
        return [
            'code' => 'Mã vai trò',
            'name' => 'Tên vai trò',
            'type' => 'Loại vai trò',
            'description' => 'Miêu tả vai trò',
        ];
    }
}
