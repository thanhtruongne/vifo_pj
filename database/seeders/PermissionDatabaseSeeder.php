<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Permissions;
use Illuminate\Database\Seeder;

class PermissionDatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Chi tiet61 các permissions:
        //
        $permissions = [       
            // Vai trò role
            ['role','Quản lý vai trò','roles',null, 1],
            ['role-create','Thêm vai trò',null,'roles', 1],
            ['role-edit','Chỉnh sửa vai trò',null,'roles', 1],
            ['role-permission','Cấp quyền vai trò',null,'roles', 1],
            ['role-create-employee','Thêm nhân viên vào vai trò',null,'roles', 1],
            ['role-delete-employee','Xoá nhân viên vào vai trò',null,'roles', 1],
            ['role-delete', 'Xoá vai trò',null,'roles', 1],

             // Vai trò role
             ['product-family','Quản lý thông tin bảo hiểm','roles',null, 1],
             ['role-create','Thêm vai trò',null,'roles', 1],
             ['role-edit','Chỉnh sửa vai trò',null,'roles', 1],
             ['role-permission','Cấp quyền vai trò',null,'roles', 1],
             ['role-create-employee','Thêm nhân viên vào vai trò',null,'roles', 1],
             ['role-delete-employee','Xoá nhân viên vào vai trò',null,'roles', 1],
             ['role-delete', 'Xoá vai trò',null,'roles', 1],

            // Provider
            ['provider','Quản lý nhà cung cấp','providers',null, 2],
            ['provider-create','Thêm nhà cung cấp',null,'providers', 2],
            ['provider-edit','Chỉnh sửa nhà cung cấp',null,'providers', 2],
            ['provider-permission','Cấp quyền nhà cung cấp',null,'providers', 2],
            ['provider-create-employee','Thêm nhân viên vào nhà cung cấp',null,'providers', 2],
            ['provider-delete-employee','Xoá nhân viên vào nhà cung cấp',null,'providers', 2],
            ['provider-delete', 'Xoá nhà cung cấp',null,'providers', 2],

             // saleman
             ['saleman','Quản lý nhà phân phối','providers',null, 3],
             ['saleman-create','Thêm nhà phân phối',null,'saleman', 3],
             ['saleman-edit','Chỉnh sửa nhà phân phối',null,'saleman', 3],
             ['saleman-permission','Cấp quyền nhà phân phối',null,'saleman', 3],
             ['saleman-create-employee','Thêm nhân viên vào nhà phân phối',null,'saleman', 3],
             ['saleman-delete-employee','Xoá nhân viên vào nhà phân phối',null,'saleman', 3],
             ['saleman-delete', 'Xoá nhà phân phối',null,'saleman', 3],
 
   
        ];
        foreach ($permissions as $key => $value) {
            $extend = isset($value[5]) ? $value[5] : null;
            $permission = Permissions::query()->updateOrCreate(
                [
                    'name' => $value[0],
                ],
                [
                    'name' => $value[0],
                    'description' => $value[1],
                    'model' => $value[2],
                    'parent' => $value[3],
                    'group' => $value[4],
                    'extend' => $extend,
                ]
            );
            \DB::table('role_has_permissions')->updateOrInsert(
                [
                    'permission_id' => $permission->id,
                    'role_id' => 1,
                ],
                [
                    'permission_id' => $permission->id,
                    'role_id' => 1,
                ]
            );
        }
    }
}
