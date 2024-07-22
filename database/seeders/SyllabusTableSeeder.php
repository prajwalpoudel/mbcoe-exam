<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SyllabusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $syllabus = [
            [
                'name' => 'Old Syllabus'
            ],
            [
                'name' => 'New Syllabus'
            ]
        ];

        DB::table('syllabi')->truncate();
        DB::table('syllabi')->insert($syllabus);
    }
}
