<?php

namespace Database\Seeders;

use App\Constants\RoleConstant;
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
        $users = [
            [
                'name' => 'Admin Admin',
                'email' => 'examcoe@mbman.edu.np',
                'password' => bcrypt('mbcoe@exam'),
                'role_id' => RoleConstant::ADMIN_ID,
            ]
        ];

        DB::table('users')->truncate();
        foreach($users as $user) {
            DB::beginTransaction();
            $user = $this->userService->create($user);
            DB::commit();
        }
    }
}
