<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Student;
use Illuminate\Database\Seeder;


class StudentSeeder extends Seeder {
    public function run() {
        Student::factory()->count(50)->create();
    }
}
