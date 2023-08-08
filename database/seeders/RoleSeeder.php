<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserRole;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        UserRole::create(['name' => 'admin']);
        UserRole::create(['name' => 'Member']);
        $partnerRole = UserRole::create(['name' => 'Partner']);
        UserRole::create(['name' => 'Member_partner']);
      

        $partnerRole = User::create([
            'name' => 'John Doe',
            'email' => 'partner@gmail.com',
            'password' => Hash::make('password'),
            'user_role_id' => $partnerRole->id,
        ]);

    }
    
}
