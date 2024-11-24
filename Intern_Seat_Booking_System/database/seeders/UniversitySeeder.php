<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UniversitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('universities')->insert([
            ['name' => 'Sri Lanka Institute of Information Technology (SLIIT)'],
            ['name' => 'Informatics Institute of Technology (IIT)'],
            ['name' => 'NSBM'],
            ['name' => ' Sri Lanka Institute of Advanced Technological Education (SLIATE)'],
            ['name' => 'ICBT Campus'],
            ['name' => 'University of Kelaniya'],
            ['name' => 'University of Sri Jayewardenepura'],
            ['name' => 'South Eastern University of Sri Lanka'],
            ['name' => 'The Open University of Sri Lanka'],
            ['name' => 'Sabaragamuwa University of Sri Lanka'],
        ]);
    }
}
