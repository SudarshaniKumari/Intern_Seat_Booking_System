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
        Department::create(['dep_no' => 'D001', 'dep_name' => 'Human Resources']);
        Department::create(['dep_no' => 'D002', 'dep_name' => 'Marketing']);
        Department::create(['dep_no' => 'D003', 'dep_name' => 'IT']);
        Department::create(['dep_no' => 'D004', 'dep_name' => 'Finance']);
        Department::create(['dep_no' => 'D005', 'dep_name' => 'Accounting']);
        Department::create(['dep_no' => 'D006', 'dep_name' => 'Administration']);
    }
}
