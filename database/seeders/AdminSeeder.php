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

        // Creating the first admin user
        $adminUser1 = User::where('email', 'admin@gmail.com')->first();
        if (!$adminUser1) {
            $adminUser1 = User::create([
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('admin@123'), // Replace 'password' with the actual admin password
            ]);
        }
        $adminUser1->userrole()->associate($adminRole);
        $adminUser1->save();

        // Creating the second admin user
        $adminUser2 = User::where('email', 'kaye@unicn.africa')->first();
        if (!$adminUser2) {
            $adminUser2 = User::create([
                'name' => 'Kaye',
                'email' => 'kaye@unicn.africa',
                'password' => bcrypt('kaye@123'), // Replace 'password' with the actual password
            ]);
        }
        $adminUser2->userrole()->associate($adminRole);
        $adminUser2->save();



        // Creating the third admin user
        $adminUser3 = User::where('email', 'judith@unicn.africa')->first();
        if (!$adminUser3) {
            $adminUser3 = User::create([
                'name' => 'Judith',
                'email' => 'judith@unicn.africa',
                'password' => bcrypt('judith@123'), // Replace 'password' with the actual password
            ]);
        }
        $adminUser3->userrole()->associate($adminRole);
        $adminUser3->save();
    }
}
