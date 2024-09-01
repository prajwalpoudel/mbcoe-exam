<?php


namespace App\Services;


use App\Models\User;

class UserService extends BaseService
{
    /**
     * UserService constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return string
     */
    public function model()
    {
        return User::class;
    }
}
