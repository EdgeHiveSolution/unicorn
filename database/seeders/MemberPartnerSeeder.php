<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MemberPartner;

class MemberPartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        
        $memberPartnerData = [

            ['member_id' => 1, 'partner_id' => 1,  'kpi_id' => 1 ],
            ['member_id' => 2, 'partner_id' => 2,  'kpi_id' => 2],
            ['member_id' => 3, 'partner_id' => 3,  'kpi_id' => 3],
            ['member_id' => 4, 'partner_id' => 4,  'kpi_id' => 4 ],
            ['member_id' => 5, 'partner_id' => 5,  'kpi_id' => 5 ],
            ['member_id' => 6, 'partner_id' => 6,  'kpi_id' => 6 ],
            ['member_id' => 7, 'partner_id' => 7,  'kpi_id' => 7],
            ['member_id' => 8, 'partner_id' => 8,  'kpi_id' => 8 ],
            ['member_id' => 9, 'partner_id' => 9,  'kpi_id' => 9 ],
            ['member_id' => 10, 'partner_id' => 10, 'kpi_id' => 10 ],

       // Add more entries for other departments and members as needed
    
    ];

    foreach ( $memberPartnerData as $data) {
        MemberPartner::create($data);
    }

    }
}
