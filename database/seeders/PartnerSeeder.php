<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Partner;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Partner::create([
            'name' => 'ABC',
            'email' => 'partner@gmail.com',
            'name'=>
            'address', 
            'phone', 
            'email', 
            'website', 
            'logo', 
            'country_id', 
            'business_type',
            'is_active',
            'password', 
            'description',
             'documents', 
             'about',

        ]);
    }
}
