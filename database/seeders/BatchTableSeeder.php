<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BatchTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $batches = [
            [
                'name' => '2075',
                'syllabus_id' => 1
            ],
            [
                'name' => '2076',
                'syllabus_id' => 1
            ],
            [
                'name' => '2077',
                'syllabus_id' => 1
            ],
            [
                'name' => '2078',
                'syllabus_id' => 1
            ],
            [
                'name' => '2079',
                'syllabus_id' => 2
            ],
            [
                'name' => '2080',
                'syllabus_id' => 2
            ],
        ];

        DB::table('batches')->truncate();
        DB::table('batches')->insert($batches);
    }
}
