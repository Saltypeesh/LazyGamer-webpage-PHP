<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;

class AuthController extends Controller
{
    use HttpResponses;

    public function userLogin(LoginUserRequest $request)
    {
        $request->validated($request->all());

        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return $this->error('', 'Credentials do not match', 401);
        }

        $user = User::where('email', $request->email)->first();

        $user = User::where('email', $request->email)->first();
        if ($user->role != "customer") {
            return $this->error('', 'Credentials do not match', 401);
        }

        return $this->success([
            'user' => $user,
            'token' => $user->createToken('Api Token of ' . $user->username)->plainTextToken
        ]);
    }

    public function userRegister(StoreUserRequest $request)
    {
        $request->validated($request->all());

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return $this->success([
            'user' => $user,
            'token' => $user->createToken('API Token of ' . $user->username)->plainTextToken
        ]);
    }

    public function adminLogin(LoginUserRequest $request)
    {
        $request->validated($request->all());
        $role = "admin";

        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return $this->error('', 'Credentials do not match', 401);
        }

        $user = User::where('email', $request->email)->first();

        if ($user->role != "admin") {
            return $this->error('', 'Credentials do not match', 401);
        }

        return $this->success([
            'user' => $user,
            'token' => $user->createToken('Api Token of ' . $user->username)->plainTextToken
        ]);
    }

    public function adminRegister(StoreUserRequest $request)
    {
        $request->validated($request->all());

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 1
        ]);

        return $this->success([
            'user' => $user,
            'token' => $user->createToken('API Token of ' . $user->username)->plainTextToken
        ]);
    }

    public function destroy(User $user)
    {
        if (Auth::user()->id !== $user->id) {
            return $this->error('', 'You are not authorized to make this request', 403);
        }
        Auth::user()->currentAccessToken()->delete();
        $user->delete();

        
        return $this->success([
            'message' => 'Account has been successfully deleted!'
        ]);
    }

    public function logout()
    {
        Auth::user()->currentAccessToken()->delete();

        return $this->success([
            'message' => 'You have successfully been logged out your token has been deleted'
        ]);
    }
}
