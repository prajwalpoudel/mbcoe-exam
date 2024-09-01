<?php

namespace Database\Seeders;

use App\Constants\FacultyConstant;
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
                'order' => 1
            ],
            [
                'name' => 'Second',
                'display_name' => '2nd',
                'code' => 'I/II',
                'faculty_id' => FacultyConstant::CIVIL_ID,
                'order' => 2
            ],
            [
                'name' => 'Third',
                'display_name' => '3rd',
                'code' => 'II/I',
                'faculty_id' => FacultyConstant::CIVIL_ID,
                'order' => 3
            ],
            [
                'name' => 'Fourth',
                'display_name' => '4th',
                'code' => 'II/II',
                'faculty_id' => FacultyConstant::CIVIL_ID,
                'order' => 4
            ],
            [
                'name' => 'Fifth',
                'display_name' => '5th',
                'code' => 'III/I',
                'faculty_id' => FacultyConstant::CIVIL_ID,
                'order' => 5
            ],
            [
                'name' => 'Sixth',
                'display_name' => '6th',
                'code' => 'III/II',
                'faculty_id' => FacultyConstant::CIVIL_ID,
                'order' => 6
            ],
            [
                'name' => 'Seventh',
                'display_name' => '7th',
                'code' => 'IV/II',
                'faculty_id' => FacultyConstant::CIVIL_ID,
                'order' => 7
            ],
            [
                'name' => 'Eighth',
                'display_name' => '8th',
                'code' => 'IV/II',
                'faculty_id' => FacultyConstant::CIVIL_ID,
                'order' => 8
            ],
            [
                'name' => 'First',
                'display_name' => '1st',
                'code' => 'I/I',
                'faculty_id' => FacultyConstant::COMPUTER_ID,
                'order' => 1
            ],
            [
                'name' => 'Second',
                'display_name' => '2nd',
                'code' => 'I/II',
                'faculty_id' => FacultyConstant::COMPUTER_ID,
                'order' => 2
            ],
            [
                'name' => 'Third',
                'display_name' => '3rd',
                'code' => 'II/I',
                'faculty_id' => FacultyConstant::COMPUTER_ID,
                'order' => 3
            ],
            [
                'name' => 'Fourth',
                'display_name' => '4th',
                'code' => 'II/II',
                'faculty_id' => FacultyConstant::COMPUTER_ID,
                'order' => 4
            ],
            [
                'name' => 'Fifth',
                'display_name' => '5th',
                'code' => 'III/I',
                'faculty_id' => FacultyConstant::COMPUTER_ID,
                'order' => 5
            ],
            [
                'name' => 'Sixth',
                'display_name' => '6th',
                'code' => 'III/II',
                'faculty_id' => FacultyConstant::COMPUTER_ID,
                'order' => 6
            ],
            [
                'name' => 'Seventh',
                'display_name' => '7th',
                'code' => 'IV/II',
                'faculty_id' => FacultyConstant::COMPUTER_ID,
                'order' => 7
            ],
            [
                'name' => 'Eighth',
                'display_name' => '8th',
                'code' => 'IV/II',
                'faculty_id' => FacultyConstant::COMPUTER_ID,
                'order' => 8
            ],
        ];
        DB::table('semesters')->truncate();
        DB::table('semesters')->insert($semesters);
    }
}
