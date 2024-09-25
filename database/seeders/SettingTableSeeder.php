<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'name' => 'Madan Bhandari Memorial Academy Nepal',
                'site_name' => 'MBCOE',
                'address' => 'Urlabari-03, Morang',
                'phone' =>'021-463201'
            ],
        ];

        DB::table('settings')->truncate();
        DB::table('settings')->insert($settings);
    }
}
