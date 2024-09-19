<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        $this->call(RoleTableSeeder::class);
        $this->call(SyllabusTableSeeder::class);
        $this->call(BatchTableSeeder::class);
        $this->call(FacultyTableSeeder::class);
        $this->call(SemesterTableSeeder::class);
//        $this->call(SubjectTableSeeder::class);
        $this->call(ExamTableSeeder::class);
        $this->call(MenuTableSeeder::class);
//        $this->call(UserTableSeeder::class);
        Schema::enableForeignKeyConstraints();
    }
}
