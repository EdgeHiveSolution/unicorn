<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\UserRole;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $adminRole = UserRole::where('name', 'admin')->first();

        $adminUser = User::where('email', 'admin@gmail.com')->first();
        if (!$adminUser) {
            $adminUser = User::create([
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('admin@123'), // Replace 'password' with the actual admin password
            ]);
        }

        $adminUser->userrole()->associate($adminRole);
        $adminUser->save();
    }
}
