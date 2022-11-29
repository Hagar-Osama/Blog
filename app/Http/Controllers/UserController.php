<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeleteUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Services\UserService;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        return $this->userService->index();
    }

    public function edit($userId)
    {
        return $this->userService->edit($userId);
    }

    public function update(UpdateUserRequest $request, Role $role)
    {
        return $this->userService->update($request, $role);
    }

    public function destroy(DeleteUserRequest $request)
    {
        return $this->userService->destroy($request);
    }
}
