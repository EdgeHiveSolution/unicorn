<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            
            RoleSeeder::class,
            AdminSeeder::class,
            UserSeeder::class, 
            DepartmentSeeder::class,
            CountrySeeder::class,
            PartnerSeeder::class,
            DepartmentPartnerSeeder::class,
            MemberSeeder::class,
            KpiSeeder::class,
            MemberPartnerSeeder::class, 
            DepartmentMemberSeeder::class,
          
           
            
        ]);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}