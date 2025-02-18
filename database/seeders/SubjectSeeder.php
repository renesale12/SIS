<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectSeeder extends Seeder
{
    public function run()
    {
        DB::table('subjects')->insert([
            ['code' => 'MATH101', 'name' => 'Mathematics', 'units' => 3],
            ['code' => 'ENG102', 'name' => 'English', 'units' => 3],
            ['code' => 'SCI103', 'name' => 'Science', 'units' => 4],
        ]);
    }
}