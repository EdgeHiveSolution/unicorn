<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Member;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
       
        $membersData = [
      
            ['user_id' => 2],
            ['user_id' => 3],
            ['user_id' => 4],
            ['user_id' => 5],
            ['user_id' => 6],
            ['user_id' => 7],
            ['user_id' => 8],
            ['user_id' => 9],
            ['user_id' => 10],
            ['user_id' => 11],
           
        ];

        // Create members using the specified user_id
        foreach ($membersData as $data) {
            Member::create($data);
        }
    }
}
