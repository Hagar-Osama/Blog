<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeleteUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private $userModel;

    public function __construct(User $user)
    {
        $this->userModel = $user;
    }

    public function index()
    {
        // $roleId = Role::where('name', 'superAdmin')->pluck('id');
        // if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('moderator')) {
        //     $users = $this->userModel::where('role_id', '<>', $roleId)->get();
        //     return view('users.index', compact('users'));
        // }else {
            $users = $this->userModel::get();
            return view('users.index', compact('users'));
       // }
    }

    public function edit($userId)
    {
        $this->authorize('update', $this->userModel);

        $user = $this->userModel::findOrFail($userId);
        $permissions = Permission::all();
        $roles = Role::all();
        return view('users.edit', compact('user', 'permissions', 'roles'));
    }

    public function update(UpdateUserRequest $request, Role $role)
    {
        try {
            $user = $this->userModel::findOrFail($request->userId);
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

            $role->permissions()->attach($request->permissions);
            session()->flash('message', 'User Updated Successfully');
            return redirect()->route('users.index');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy(DeleteUserRequest $request)
    {
        $this->authorize('delete', $this->userModel);

        $this->userModel::findOrFail($request->userId)->delete();
        session()->flash('message', 'User Deleted Successfully');
        return redirect()->route('users.index');
    }
}
