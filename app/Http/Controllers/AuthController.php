<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\LogoutUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use HttpResponses;

    public function login(LoginUserRequest $request)
    {
        $credentials = $request->validated();

        if (! Auth::attempt($credentials)) {
            return $this->error([], 401, 'Invalid credentials');
        }

        $user = User::where('email', $credentials['email'])->first();

        return $this->success([
            'user' => $user,
            'token' => $user->createToken('API token for '.$user->name)->plainTextToken,
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
            'token' => $user->createToken('API token for '.$user->name)->plainTextToken,
        ]);
    }

    public function logout(LogoutUserRequest $request)
    {
        $request->validated($request->all());

        $user = $request->user();
        $user->tokens()->delete();

        return $this->success();
    }
}
