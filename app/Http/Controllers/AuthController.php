<?php

namespace App\Http\Controllers;

use App\Traits\HttpResponses;
use App\Http\Requests\{StoreUserRequest, LoginUserRequest};
use App\Models\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use HttpResponses;

    public function login(LoginUserRequest $request)
    {
        $credentials = $request->validated();

        if(!Auth::attempt($credentials)){
            return $this->error('', 'Invalid credentials', 401);
        }

        $user = User::where('email', $credentials['email'])->first();

        return $this->success([
            'user' => $user,
            'token' => $user->createToken('API token for ' . $user->name)->plainTextToken,
        ]);
    }

    public function register(StoreUserRequest $request)
    {
        $request->validated($request->all());

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return $this->success([
            'user' => $user, 
            'token' => $user->createToken('API token for ' . $user->name)->plainTextToken,
        ]);
    }

    public function logout()
    {
        return response()->json('Logout route');
    }
}