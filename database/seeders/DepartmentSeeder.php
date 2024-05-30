<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
               // Define the departments data
               $departments = [
                [
                    'name' => 'Sales',
                    'email' => 'sales@example.com',
                    'about' => 'Description of Sales',
                ],
                [
                    'name' => 'Finance',
                    'email' => 'finance@example.com',
                    'about' => 'Description of Finance',
                ],
                [
                    'name' => 'Human Resource',
                    'email' => 'hr@example.com',
                    'about' => 'Description of HR',
                ],
                [
                    'name' => 'Software',
                    'email' => 'software@example.com',
                    'about' => 'Description of Sales',
                ],


                [
                    'name' => 'Marketing',
                    'email' => 'marketing@example.com',
                    'about' => 'Description of Marketing',
                ],


                [
                    'name' => 'Data Analysis',
                    'email' => 'analysis@example.com',
                    'about' => 'Description of Analysis',
                ],


                
                [
                    'name' => 'Careers',
                    'email' => 'careers@example.com',
                    'about' => 'Description of Careers',
                ],


                [
                    'name' => 'Outsourcing',
                    'email' => 'outsource@example.com',
                    'about' => 'Description of Outsourcing',
                ],


                [
                    'name' => 'Transport',
                    'email' => 'transport@example.com',
                    'about' => 'Description of Transport',
                ],

                
                [
                    'name' => 'Catering',
                    'email' => 'catering@example.com',
                    'about' => 'Description of Catering',
                ],
                // Add more departments here...
            ];
    
            // Insert the departments into the database
            foreach ($departments as $departmentData) {
                Department::create($departmentData);
            }
        }
    }

