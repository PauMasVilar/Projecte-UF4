<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StudentEnrollment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StudentEnrollmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StudentEnrollment::factory([
            "id_student" => 4,
            "id_course" => 1,
            "enrollment_date" => fake()->dateTime(),
        ])->create();

        StudentEnrollment::factory([
            "id_student" => 4,
            "id_course" => 2,
            "enrollment_date" => fake()->dateTime(),
        ])->create();
    }
}
