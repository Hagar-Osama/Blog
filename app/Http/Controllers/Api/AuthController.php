<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Traits\ApiResponseTrait;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use ApiResponseTrait;

     public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            // 'role_id' => 3
        ]);

        return $this->success([
            'user' => $user,
            'token' => $user->createToken('token')->plainTextToken,
            'code' => Response::HTTP_CREATED
        ]);

    }

    public function login(LoginRequest $request)
    {
        $admin = $request->only('email', 'password');
        if(auth()->attempt($admin)){
            $user = User::where('email', $request->email)->first();
            return $this->success([
                'user' => $user,
                'token' => $user->createToken('token')->plainTextToken,
                'code' => Response::HTTP_FOUND
            ]);

        }
        return $this->error('', 'Credentials Dont Match Our Record', Response::HTTP_NOT_FOUND);

    }

    public function logout()
    {
        Auth::user()->currentAccessToken()->delete();
        return $this->success([
            'message' => 'You Have Succesfully logged out',
        ]);


    }
}
