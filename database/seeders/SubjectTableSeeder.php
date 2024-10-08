<?php

namespace Database\Seeders;

use App\Constants\FacultyConstant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjects = [
            [
                'name' => 'Engineering Mathematics 1',
                'code' => 'MTH 111',
                'credit_hour' => 3,
                'syllabus_id' => 1,
                'faculty_id' => FacultyConstant::COMPUTER_ID,
                'semester_id' => 9
            ],
            [
                'name' => 'Chemistry',
                'code' => 'MTH 111',
                'credit_hour' => 3,
                'syllabus_id' => 1,
                'faculty_id' => FacultyConstant::COMPUTER_ID,
                'semester_id' => 9
            ],
            [
                'name' => 'Communication Technique',
                'code' => 'MTH 111',
                'credit_hour' => 3,
                'syllabus_id' => 1,
                'faculty_id' => FacultyConstant::COMPUTER_ID,
                'semester_id' => 9
            ],
            [
                'name' => 'Programming in C',
                'code' => 'MTH 111',
                'credit_hour' => 3,
                'syllabus_id' => 1,
                'faculty_id' => FacultyConstant::COMPUTER_ID,
                'semester_id' => 9
            ],
            [
                'name' => 'Basic Electrical Engineering',
                'code' => 'MTH 111',
                'credit_hour' => 3,
                'syllabus_id' => 1,
                'faculty_id' => FacultyConstant::COMPUTER_ID,
                'semester_id' => 9
            ],
            [
                'name' => 'Mechanical Workshop',
                'code' => 'MTH 111',
                'credit_hour' => 3,
                'syllabus_id' => 1,
                'faculty_id' => FacultyConstant::COMPUTER_ID,
                'semester_id' => 9
            ],
            [
                'name' => 'Numerical Methods',
                'code' => 'MTH 230',
                'credit_hour' => 3,
                'syllabus_id' => 1,
                'faculty_id' => FacultyConstant::COMPUTER_ID,
                'semester_id' => 13
            ],
            [
                'name' => 'Probability and Statistics',
                'code' => 'MTH 220',
                'credit_hour' => 3,
                'syllabus_id' => 1,
                'faculty_id' => FacultyConstant::COMPUTER_ID,
                'semester_id' => 13
            ],
            [
                'name' => 'Operating System',
                'code' => 'CMP 330',
                'credit_hour' => 3,
                'syllabus_id' => 1,
                'faculty_id' => FacultyConstant::COMPUTER_ID,
                'semester_id' => 13
            ],
            [
                'name' => 'Computer Architecture',
                'code' => 'CMP 332',
                'credit_hour' => 3,
                'syllabus_id' => 1,
                'faculty_id' => FacultyConstant::COMPUTER_ID,
                'semester_id' => 13
            ],
            [
                'name' => 'Computer Graphics',
                'code' => 'CMP 241',
                'credit_hour' => 3,
                'syllabus_id' => 1,
                'faculty_id' => FacultyConstant::COMPUTER_ID,
                'semester_id' => 13
            ],
            [
                'name' => 'Theory of Computation',
                'code' => 'CMP 326',
                'credit_hour' => 3,
                'syllabus_id' => 1,
                'faculty_id' => FacultyConstant::COMPUTER_ID,
                'semester_id' => 13
            ],
        ];

        DB::table('subjects')->truncate();
        DB::table('subjects')->insert($subjects);
    }
}
