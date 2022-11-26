<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function registerPage()
    {
        return view('register');
    }

    public function loginPage()
    {
        return view('login');
    }

    public function register(RegisterRequest $request)
    {
        $role = Role::where('name', 'superAdmin')->first();
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' =>$role->id
        ]);

        $permissions = Permission::all();
        $role->permissions()->attach($permissions);

        Auth::login($user);
        return redirect()->route('dashboard');

    }

    public function login(LoginRequest $request)
    {
        $admin = $request->only('email', 'password');
        if(auth()->attempt($admin)){
        $request->session()->regenerate();
        return redirect()->route('dashboard');
        }
        return back()->withErrors([
            'email' => 'The Provided Credentials Don\'t Match Our Record',
            'password' => 'The Provided Email Doesn\'t Match Our Record',
        ]);

    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('login');
    }
}
