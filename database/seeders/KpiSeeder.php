<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kpi;

class KpiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {



        $kpi = [
            [
                'title' => 'Sales Count',
                'partner_id' => '1',
                
            ],
            [
                'title' => 'Example 2',
                'partner_id' => '2',
                
            ],
            [
                'title' => 'Example 3',
                'partner_id' => '3',
                
            ],
            [
                'title' => 'Example 4',
                'partner_id' => '4',
                
            ],
            [
                'title' => 'Example 5',
                'partner_id' => '5',
                
            ],

            [
                'title' => 'Example 6',
                'partner_id' => '6',
                
            ],

            [
                'title' => 'Example 7',
                'partner_id' => '7',
                
            ],


            [
                'title' => 'Example 8',
                'partner_id' => '7',
                
            ],


            [
                'title' => 'Example 9',
                'partner_id' => '7',
                
            ],

            [
                'title' => 'Example 10',
                'partner_id' => '7',
                
            ],

        ];

        foreach ( $kpi as $data) {
            Kpi::create($data);
        }
    

    }
}
