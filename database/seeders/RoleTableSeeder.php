<?php

namespace Database\Seeders;

use App\Constants\RoleConstant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => RoleConstant::ADMIN
            ],
            [
                'name' => RoleConstant::STUDENT
            ]
        ];

        DB::table('roles')->truncate();
        DB::table('roles')->insert($roles);
    }
}
