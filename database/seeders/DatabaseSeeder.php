<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Roles;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $roles = [
            ['Admin','Admin','Vai trò có quyền cao nhất', 1,1],
            ['Provider','Nhà cung cấp','Vai trò nhà cung câp', 1,0],
            ['Saleman','Nhà phân phối','Vai trò nhàphân phối', 1,0],
            ['User','Người dùng', 'Vai trờ người dùng', 1,0],
        ];
        foreach ($roles as $key => $value) {
            Roles::updateOrCreate(
                [
                    'code' => $value[0]
                ],
                [
                    'code' => $value[0],
                    'name' => $value[1],
                    'description'=>$value[2],
                    'type' => $value[3],
                    'guard_name' => 'web',
                    'created_by'=>2,
                    'updated_by'=>2,
                    'unit_by' => 1,
                    'status'=>$value[4]
                ]
            );
        }
        User::find(1)->assignRole('Admin');
        User::find(2)->assignRole('Admin');
    }
}
