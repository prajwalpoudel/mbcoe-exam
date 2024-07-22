<?php

namespace Database\Seeders;

use App\Constants\ExamTypeConstant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExamTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            [
                'name' => ExamTypeConstant::SPRING
            ],
            [
                'name' => ExamTypeConstant::FALL
            ],
            [
                'name' => ExamTypeConstant::INTERNAL
            ],
        ];
        $exams = [
            [
                'name' => '2022',
                'exam_type_id' => ExamTypeConstant::SPRING_ID
            ],
            [
                'name' => '2022',
                'exam_type_id' => ExamTypeConstant::FALL_ID
            ],
            [
                'name' => '2023',
                'exam_type_id' => ExamTypeConstant::SPRING_ID
            ],
            [
                'name' => '2023',
                'exam_type_id' => ExamTypeConstant::FALL_ID
            ],
            [
                'name' => '2024',
                'exam_type_id' => ExamTypeConstant::SPRING_ID
            ]
        ];

        DB::table('exam_types')->truncate();
        DB::table('exams')->truncate();
        DB::table('exam_types')->insert($types);
        DB::table('exams')->insert($exams);
    }
}
