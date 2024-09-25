<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * @var string
     */
    private $view = 'admin.profile.';
    /**
     * @var UserService
     */
    private $userService;

    /**
     * ProfileController constructor.
     * @param UserService $userService
     */
    public function __construct(
        UserService $userService
    )
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = getUser();

        return view($this->view . 'index', compact('user'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = getUser();

        return view($this->view.'edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->userService->update($id, $request->all());

        return $this->userService->redirect('admin.profile.index', 'success', 'Profile updated successfully');
    }
}
