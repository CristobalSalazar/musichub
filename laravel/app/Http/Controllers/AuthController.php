<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register()
    {
        request()->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        return User::create([
            'email' => request()->email,
            'password' => Hash::make(request()->password),
        ]);
    }

    public function user()
    {
        return request()->user();
    }

    public function token(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        return $user->createToken($request->email)->plainTextToken;
    }
}
