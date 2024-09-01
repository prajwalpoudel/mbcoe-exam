<?php

namespace Database\Seeders;

use App\Services\UserService;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * @var UserService
     */
    private $userService;

    /**
     * UserTableSeeder constructor.
     * @param UserService $userService
     */
    public function __construct(
        UserService $userService
    )
    {
        $this->userService = $userService;
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = [
            [
                'name' => 'Aditya Pokhrel',
                'role_id' => 2,
                'student' => [
                    'symbol_no' => '21075184',
                    'registration_number' => '2021-1-07-0689',
                    'admitted_year' => Carbon::now(),
                    'batch_id' => 4,
                    'faculty_id' => 2,
                    'semester' => [
                        [
                            'semester_id'=> 9,
                        ],
                        [
                            'semester_id'=> 10,
                        ],
                        [
                            'semester_id'=> 11,
                        ],
                        [
                            'semester_id'=> 12,
                        ],
                        [
                            'semester_id'=> 13,
                        ]
                    ]
                ]
            ]
        ];

        DB::table('users')->truncate();
        DB::table('students')->truncate();
        DB::table('semester_student')->truncate();
        foreach($students as $student) {
            $userData = Arr::except($student, ['student']);
            $studentData = $student['student'];
            $semesterDatas = $studentData['semester'];
            unset($studentData['semester']);
            DB::beginTransaction();
            $user = $this->userService->create($userData);
            $student = $user->student()->create($studentData);
            $student->semesters()->attach($semesterDatas);
            DB::commit();
        }
    }
}
