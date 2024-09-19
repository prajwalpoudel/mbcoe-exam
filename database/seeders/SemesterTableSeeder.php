<?php

namespace Database\Seeders;

use App\Constants\FacultyConstant;
use App\Constants\StatusConstant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SemesterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $semesters = [
            [
                'name' => 'First',
                'display_name' => '1st',
                'code' => 'I/I',
                'faculty_id' => FacultyConstant::CIVIL_ID,
                'order' => 1,
                'status' => StatusConstant::RUNNING
            ],
            [
                'name' => 'Second',
                'display_name' => '2nd',
                'code' => 'I/II',
                'faculty_id' => FacultyConstant::CIVIL_ID,
                'order' => 2,
                'status' => StatusConstant::RUNNING
            ],
            [
                'name' => 'Third',
                'display_name' => '3rd',
                'code' => 'II/I',
                'faculty_id' => FacultyConstant::CIVIL_ID,
                'order' => 3,
                'status' => StatusConstant::RUNNING
            ],
            [
                'name' => 'Fourth',
                'display_name' => '4th',
                'code' => 'II/II',
                'faculty_id' => FacultyConstant::CIVIL_ID,
                'order' => 4,
                'status' => StatusConstant::RUNNING
            ],
            [
                'name' => 'Fifth',
                'display_name' => '5th',
                'code' => 'III/I',
                'faculty_id' => FacultyConstant::CIVIL_ID,
                'order' => 5,
                'status' => StatusConstant::RUNNING
            ],
            [
                'name' => 'Sixth',
                'display_name' => '6th',
                'code' => 'III/II',
                'faculty_id' => FacultyConstant::CIVIL_ID,
                'order' => 6,
                'status' => StatusConstant::RUNNING
            ],
            [
                'name' => 'Seventh',
                'display_name' => '7th',
                'code' => 'IV/II',
                'faculty_id' => FacultyConstant::CIVIL_ID,
                'order' => 7,
                'status' => StatusConstant::RUNNING
            ],
            [
                'name' => 'Eighth',
                'display_name' => '8th',
                'code' => 'IV/II',
                'faculty_id' => FacultyConstant::CIVIL_ID,
                'order' => 8,
                'status' => StatusConstant::RUNNING
            ],
            [
                'name' => 'Pass Out',
                'display_name' => 'Pass Out',
                'code' => 'Pass Out',
                'faculty_id' => FacultyConstant::CIVIL_ID,
                'order' => 9,
                'status' => StatusConstant::PASSOUT
            ],
            [
                'name' => 'First',
                'display_name' => '1st',
                'code' => 'I/I',
                'faculty_id' => FacultyConstant::COMPUTER_ID,
                'order' => 1,
                'status' => StatusConstant::RUNNING
            ],
            [
                'name' => 'Second',
                'display_name' => '2nd',
                'code' => 'I/II',
                'faculty_id' => FacultyConstant::COMPUTER_ID,
                'order' => 2,
                'status' => StatusConstant::RUNNING
            ],
            [
                'name' => 'Third',
                'display_name' => '3rd',
                'code' => 'II/I',
                'faculty_id' => FacultyConstant::COMPUTER_ID,
                'order' => 3,
                'status' => StatusConstant::RUNNING
            ],
            [
                'name' => 'Fourth',
                'display_name' => '4th',
                'code' => 'II/II',
                'faculty_id' => FacultyConstant::COMPUTER_ID,
                'order' => 4,
                'status' => StatusConstant::RUNNING
            ],
            [
                'name' => 'Fifth',
                'display_name' => '5th',
                'code' => 'III/I',
                'faculty_id' => FacultyConstant::COMPUTER_ID,
                'order' => 5,
                'status' => StatusConstant::RUNNING
            ],
            [
                'name' => 'Sixth',
                'display_name' => '6th',
                'code' => 'III/II',
                'faculty_id' => FacultyConstant::COMPUTER_ID,
                'order' => 6,
                'status' => StatusConstant::RUNNING
            ],
            [
                'name' => 'Seventh',
                'display_name' => '7th',
                'code' => 'IV/II',
                'faculty_id' => FacultyConstant::COMPUTER_ID,
                'order' => 7,
                'status' => StatusConstant::RUNNING
            ],
            [
                'name' => 'Eighth',
                'display_name' => '8th',
                'code' => 'IV/II',
                'faculty_id' => FacultyConstant::COMPUTER_ID,
                'order' => 8,
                'status' => StatusConstant::RUNNING
            ],
            [
                'name' => 'Pass Out',
                'display_name' => 'Pass Out',
                'code' => 'Pass Out',
                'faculty_id' => FacultyConstant::COMPUTER_ID,
                'order' => 9,
                'status' => StatusConstant::PASSOUT
            ],
            [
                'name' => 'First',
                'display_name' => '1st',
                'code' => 'I/I',
                'faculty_id' => FacultyConstant::ARCH_ID,
                'order' => 1,
                'status' => StatusConstant::RUNNING
            ],
            [
                'name' => 'Second',
                'display_name' => '2nd',
                'code' => 'I/II',
                'faculty_id' => FacultyConstant::ARCH_ID,
                'order' => 2,
                'status' => StatusConstant::RUNNING
            ],
            [
                'name' => 'Third',
                'display_name' => '3rd',
                'code' => 'II/I',
                'faculty_id' => FacultyConstant::ARCH_ID,
                'order' => 3,
                'status' => StatusConstant::RUNNING
            ],
            [
                'name' => 'Fourth',
                'display_name' => '4th',
                'code' => 'II/II',
                'faculty_id' => FacultyConstant::ARCH_ID,
                'order' => 4,
                'status' => StatusConstant::RUNNING
            ],
            [
                'name' => 'Fifth',
                'display_name' => '5th',
                'code' => 'III/I',
                'faculty_id' => FacultyConstant::ARCH_ID,
                'order' => 5,
                'status' => StatusConstant::RUNNING
            ],
            [
                'name' => 'Sixth',
                'display_name' => '6th',
                'code' => 'III/II',
                'faculty_id' => FacultyConstant::ARCH_ID,
                'order' => 6,
                'status' => StatusConstant::RUNNING
            ],
            [
                'name' => 'Seventh',
                'display_name' => '7th',
                'code' => 'IV/II',
                'faculty_id' => FacultyConstant::ARCH_ID,
                'order' => 7,
                'status' => StatusConstant::RUNNING
            ],
            [
                'name' => 'Eighth',
                'display_name' => '8th',
                'code' => 'IV/II',
                'faculty_id' => FacultyConstant::ARCH_ID,
                'order' => 8,
                'status' => StatusConstant::RUNNING
            ],
            [
                'name' => 'Ninth',
                'display_name' => '9th',
                'code' => 'V/I',
                'faculty_id' => FacultyConstant::ARCH_ID,
                'order' => 9,
                'status' => StatusConstant::RUNNING
            ],
            [
                'name' => 'Tenth',
                'display_name' => '10th',
                'code' => 'V/II',
                'faculty_id' => FacultyConstant::ARCH_ID,
                'order' => 10,
                'status' => StatusConstant::RUNNING
            ],
            [
                'name' => 'Pass Out',
                'display_name' => 'Pass Out',
                'code' => 'Pass Out',
                'faculty_id' => FacultyConstant::ARCH_ID,
                'order' => 11,
                'status' => StatusConstant::PASSOUT
            ],
        ];
        DB::table('semesters')->truncate();
        DB::table('semesters')->insert($semesters);
    }
}
