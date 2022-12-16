<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private $userModel;
    use ApiResponseTrait;

    public function __construct(User $user)
    {
        $this->userModel = $user;
    }

    public function index()
    {
        $users = $this->userModel::get();
        return UserResource::collection($users);
    }


    public function update(UpdateUserRequest $request, User $user, Role $role)
    {
        $this->authorize('update', $this->userModel);

        if (!empty($request->password)) {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role_id' => $request->role_id
            ]);
        } else {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'role_id' => $request->role_id
            ]);
        }

        $role->permissions()->sync($request->permissions);
        return $this->success([
            'user' => $user,
            'message' => 'User Updated Successfully',
            'code' => Response::HTTP_NO_CONTENT
        ]);
    }


    public function destroy(User $user)
    {
        $this->authorize('delete', $this->userModel);

        $user->delete();
        return $this->success('', 'User Deleted Successfully', Response::HTTP_NO_CONTENT);
    }
}
