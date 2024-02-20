<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use App\Models\Unit;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       /***  DB::table('units')->insert([
            'name' => 'Count',
            'type' => 'integer'
        ],
        [
            'name' => 'Currency',
            'type' => 'integer'
          ]
    
    );***/

    Unit::create([
        'name' => 'Count',
        'type' => 'integer'
    ]);

    Unit::create([
        'name' => 'Currency',
        'type' => 'integer'
    ]);
    }
}
