<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DepartmentPartner;

class DepartmentPartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departmentPartnerData = [

                ['department_id' => 1, 'partner_id' => 1,  'role' => 'leader'],
                ['department_id' => 2, 'partner_id' => 1,  'role' => 'leader'],
                ['department_id' => 3, 'partner_id' => 1,  'role' => 'mentor'],
                ['department_id' => 4, 'partner_id' => 2,  'role' => 'advisor'],
                ['department_id' => 5, 'partner_id' => 3,  'role' => 'advisor'],
                ['department_id' => 6, 'partner_id' => 4,  'role' => 'leader'],
                ['department_id' => 7, 'partner_id' => 5,  'role' => 'mentor'],
                ['department_id' => 8, 'partner_id' => 6,  'role' => 'mentor'],
                ['department_id' => 9, 'partner_id' => 7,  'role' => 'leader'],
                ['department_id' => 10, 'partner_id' => 8,  'role' => 'advisor'],

               
    
                // Add more entries for other departments and members as needed
        
        ];

        foreach ( $departmentPartnerData as $data) {
            DepartmentPartner::create($data);
        }


    }
}
