<?php

namespace Database\Seeders;

use App\Constants\FacultyConstant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FacultyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faculties = [
            [
                'name' => FacultyConstant::CIVIL
            ],
            [
                'name' => FacultyConstant::COMPUTER
            ],
            [
                'name' => FacultyConstant::ARCH
            ],
        ];

        DB::table('faculties')->truncate();
        DB::table('faculties')->insert($faculties);
    }
}
