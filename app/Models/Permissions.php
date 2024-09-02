<?php

namespace App\Models;

use Illuminate\Support\Facades\Cache;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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
 * @mixin \Eloquent
 * @property string $user_code
 * @property string $user_name
 * @property int $number_hits
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LoginHistory whereNumberHits($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LoginHistory whereUserCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LoginHistory whereUserName($value)
 * @property-read \App\Models\User|null $user
 */
class Permissions extends Model
{
    use Cachable;
    protected $table = 'permissions';
    protected $table_name = "Danh sách quyền";
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'description',
        'guard_name',
        'model',
        'parent',
        'extend',
        'group',
    ];


    public static function checkPermissionCode($code) {
        $query = self::query();
        $query->from('permission');
        $query->where('code', '=', $code);
        return $query->exists();
    }

    public static function isAdmin() {
        $cacheKey = 'admin_access_for_' . Auth::user()->id;
        return Cache::rememberForever($cacheKey, function () {
            if (in_array(Auth::user()->username, ['admin', 'superadmin'])) {
                return true;
            }
            return Auth::user() ? Auth::user()->roles()->where('name', 'Admin')->count() : false;
        });
    }
    public static function getChildPermission($code, $prefix='', &$result = []) {
        $rows = Permissions::where('parent_code', $code)->get();
        $parent_id = Permissions::where('code', $code)->first(['id'])->id;
        foreach ($rows as $row) {
            $result[] = (object) [
                'id' => $row->id,
                'code' => $row->code,
                'name' => $prefix .' '. $row->name,
                'parent_id' => $parent_id
            ];

            self::getChildPermission($row->code, $prefix . ' --', $result);
        }

        return $result;
    }

    public static function getArrayCodeChild($code, &$result = []) {
        $rows = Permission::where('parent_code', $code)->get();
        foreach ($rows as $row) {
            $result[] = $row->code;
            self::getArrayCodeChild($row->code, $result);
        }
        return $result;
    }

    public static function getIdUnitManagerByUser($parent_code, $user_id = null) {
        $user_id = empty($user_id) ? profile()->user_id : $user_id;
        $ids1 = UnitManager::getIdUnitManagedByUser($user_id);
        $ids2 = UnitManager::getIdUnitPermissionByUser($parent_code, $user_id);
        return array_merge($ids1, $ids2);
    }

    public static function isSaleMan($user_id = null) {
        $user_id = empty($user_id) ? profile()->user_id : $user_id;
        if (TrainingTeacher::where('user_id', '=', $user_id)
                ->where('status', '=', 1)->exists()) {
            return true;
        }

        return false;
    }

    public static function isProvider($profile_view = null, $user_id = null, $manager_type = null) {
        if(!isset($user_id) && !isset($profile_view)) {
            $profile = profile();
        } else {
            $user_id = empty($user_id) ? profile()->user_id : $user_id;
            if(!isset($profile_view)) {
                $profile = Profile::where('user_id', '=', $user_id)->first();
            } else {
                $profile = $profile_view;
            }
        }

        if (empty($profile)) {
            return false;
        }
        $unit_manger = UnitManager::where('user_code', '=', $profile->code);
        if ($manager_type){
            $unit_manger = $unit_manger->where('manager_type', '=', $manager_type);
        }

        return $unit_manger->first()?true:false;
    }
    public static function isUnitManagerPermission($user_id = null, $manager_type = null) {
        $user_id = empty($user_id) ? profile()->user_id : $user_id;
        $profile = \DB::table('el_profile')->where('user_id', '=', $user_id)->first();
        if (empty($profile)) {
            return false;
        }
        $unit_manger = \DB::table('el_unit_manager')->where('user_code', '=', $profile->code);
        if ($manager_type){
            $unit_manger = $unit_manger->where('manager_type', '=', $manager_type);
        }

        return $unit_manger->exists();
    }
    public static function isUnitPermistion($user_id = null) {
        $user_id = empty($user_id) ? profile()->user_id : $user_id;
        return UnitPermission::where('user_id', '=', $user_id)
            ->exists();
    }

    /*
     * Hàm lấy danh sách các user có quyền
     * Tham số: mã quyền, id đơn vị (nếu có)
     * Trả về: mảng user có quyền truyền vào
     * */
    public static function getUserPermission($permission_code, $unit_id = 0) {
        $query = PermissionUser::query();
        $query->where('permission_code', '=', $permission_code)
            ->where('unit_id', '=', $unit_id);
        return $query->pluck('user_id')->toArray();
    }

    public static function permissionExtend($model)
    {
        return Permission::where(['model'=>$model])->whereNotNull('extend')->value('extend');
    }

    public static function removeCache()
    {
        $prefixCache = Cache::getPrefix();
        $model = self::class;
        $cacheKey = Redis::connection('cache')->keys("{$prefixCache}{$model}*");
        dd($cacheKey);
    }

    public static function getKeyCache()
    {
        $part['model'] = self::class;
        $part['uri'] = request()->route()->uri;
        $part['user_id'] = profile()->user_id;
        $request =  request()->all();
        array_push($part,$request);
        $key = Arr::query($part);
        return $key;
    }

    public static function isLeader() {
        $profile = profile();
        if (empty($profile)) {
            return false;
        }
        $unit_manger = UnitManager::where('user_id', '=', $profile->user_id)->exists();
        return $unit_manger?true:false;
    }
}
