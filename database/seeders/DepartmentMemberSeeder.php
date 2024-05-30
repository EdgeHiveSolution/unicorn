<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DepartmentMember;

class DepartmentMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Manually specify the department_id and member_id for each entry
        $departmentMemberData = [
            ['department_id' => 1, 'member_id' => 2],
            ['department_id' => 1, 'member_id' => 3],
            ['department_id' => 2, 'member_id' => 4],
            ['department_id' => 2, 'member_id' => 5],
            ['department_id' => 3, 'member_id' => 6],
            ['department_id' => 4, 'member_id' => 7],
            ['department_id' => 5, 'member_id' => 8],
            ['department_id' => 6, 'member_id' => 9],
            ['department_id' => 7, 'member_id' => 10],
          

            // Add more entries for other departments and members as needed
        ];

        foreach ( $departmentMemberData as $data) {
            DepartmentMember::create($data);
        }
    }
}
