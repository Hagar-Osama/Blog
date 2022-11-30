<?php

namespace App\Http\Services;

use App\Http\Controllers\UserController;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;

class UserService extends UserController
{

    private $userModel;

    public function __construct(User $user)
    {
        $this->userModel = $user;
    }

    public function index()
    {
        $users = $this->userModel::get();
        return view('users.index', compact('users'));
    }

    public function edit($userId)
    {
        $this->authorize('update', $this->userModel);

        $user = $this->userModel::findOrFail($userId);
        $permissions = Permission::all();
        $roles = Role::all();
        return view('users.edit', compact('user', 'permissions', 'roles'));
    }

    public function update($request, $role)
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

            $role->permissions()->sync($request->permissions);
            session()->flash('message', 'User Updated Successfully');
            return redirect()->route('users.index');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
        $this->authorize('delete', $this->userModel);

        $this->userModel::findOrFail($request->userId)->delete();
        session()->flash('message', 'User Deleted Successfully');
        return redirect()->route('users.index');
    }
}
