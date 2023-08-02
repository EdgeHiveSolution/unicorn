<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Partner;
use Illuminate\Support\Facades\Hash;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Partner::create([
            'name' => 'Abc Innovations',
            'email' => 'alicx@gmail.com',
            'address'=> 'PO BOX 300',
            'phone' => '0717820954',       
            'country_id' => '1',
            'business_type' => 'IT',
            'password' => Hash::make('password'),
             'about' => 'Abc testing'

        ]);




        Partner::create([
            'name' => 'Solvency Solutions',
            'email' => 'solvent@gmail.com',
            'address'=> 'PO BOX 500',
            'phone' => '0717820952',       
            'country_id' => '1',
            'business_type' => 'IT',
            'password' => Hash::make('password'),
             'about' => 'Solvency testing'

        ]);




        Partner::create([
            'name' => 'Hasp Solutions',
            'email' => 'kizeima20@gmail.com',
            'address'=> 'PO BOX 300',
            'phone' => '0714820934',       
            'country_id' => '1',
            'business_type' => 'IT',
            'password' => Hash::make('password'),
            'about' => 'hasp testing'

        ]);



        Partner::create([
            'name' => 'WY Solutions',
            'email' => 'wy20@gmail.com',
            'address'=> 'PO BOX 300',
            'phone' => '0714820932',       
            'country_id' => '1',
            'business_type' => 'IT',
            'password' => Hash::make('password'),
            'about' => 'testing'

        ]);




        Partner::create([
            'name' => 'UAP Solutions',
            'email' => 'uap20@gmail.com',
            'address'=> 'PO BOX 300',
            'phone' => '07148209192',       
            'country_id' => '1',
            'business_type' => 'IT',
            'password' => Hash::make('password'),
            'about' => 'testing'

        ]);




        Partner::create([
            'name' => 'WKT Solutions',
            'email' => 'w20@gmail.com',
            'address'=> 'PO BOX 300',
            'phone' => '0714820137',       
            'country_id' => '1',
            'business_type' => 'IT',
            'password' => Hash::make('password'),
            'about' => 'testing'

        ]);




        Partner::create([
            'name' => 'BAG Solutions',
            'email' => 'bag@gmail.com',
            'address'=> 'PO BOX 300',
            'phone' => '0714820990',       
            'country_id' => '1',
            'business_type' => 'IT',
            'password' => Hash::make('password'),
            'about' => 'testing'

        ]);


        Partner::create([
            'name' => 'OUT Solutions',
            'email' => 'out@gmail.com',
            'address'=> 'PO BOX 300',
            'phone' => '0794820990',       
            'country_id' => '1',
            'business_type' => 'IT',
            'password' => Hash::make('password'),
            'about' => 'testing'

        ]);




        Partner::create([
            'name' => 'MAT Solutions',
            'email' => 'mat@gmail.com',
            'address'=> 'PO BOX 300',
            'phone' => '0711920990',       
            'country_id' => '1',
            'business_type' => 'IT',
            'password' => Hash::make('password'),
            'about' => 'testing'

        ]);


        Partner::create([
            'name' => 'VTU Solutions',
            'email' => 'vt@gmail.com',
            'address'=> 'PO BOX 300',
            'phone' => '0714825490',       
            'country_id' => '1',
            'business_type' => 'IT',
            'password' => Hash::make('password'),
            'about' => 'testing'

        ]);


    }
}
