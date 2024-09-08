<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Permissions;
use App\Models\Profile;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class UserDatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = Factory::create();
        /***** superadmin *******/
        $admin = User::firstOrNew(['username' => 'admin'],[
            'auth' => 'manual',
            'username' => 'superadmin',
            'password' => \Hash::make('admin123'),
            'email' => 'admin123@gmail.com',
            'firstname' => 'admin',
            'lastname' => 'supp'
        ]);
        $admin->save();
        $profile= Profile::firstOrNew(['id'=>$admin->id],[
            'code'=> 'admin',
            'id' => $admin->id,
            'user_id' => $admin->id,
            'firstname' => 'Super',
            'lastname' => 'Admin',
            'email' => 'superadmin@gmail.com',
        ]);
        $profile->save();

    }
}
