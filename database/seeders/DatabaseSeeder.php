<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Partner;
use App\Models\Kpi;
use App\Models\KpiMetric;
use App\Models\Unit;

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
            //UserSeeder::class, 
            // DepartmentSeeder::class,
             CountrySeeder::class,
             UnitSeeder::class
            // PartnerSeeder::class,
            // DepartmentPartnerSeeder::class,
            // MemberSeeder::class,
            // KpiSeeder::class,
            // KpiMetricsSeeder::class,
            // MemberPartnerSeeder::class, 
            // DepartmentMemberSeeder::class,
        ]);

       
    }
}
