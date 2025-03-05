<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;

class StudentSeeder extends Seeder {
    public function run() {
        // Generate 50 students with factory
        Student::factory()->count(50)->create();

    }
}
