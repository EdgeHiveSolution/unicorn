<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Country;


class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void

    {
        Country::create([
            'name' => 'Kenya',
            'code' => 'KE',
        ]);

        Country::create([
            'name' => 'United States',
            'code' => 'US',
        ]);

        Country::create([
            'name' => 'United Kingdom',
            'code' => 'UK',
        ]);

        Country::create([
            'name' => 'India',
            'code' => 'IN',
        ]);

        Country::create([
            'name' => 'Canada',
            'code' => 'CA',
        ]);
    }
}

