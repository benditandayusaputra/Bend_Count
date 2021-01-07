<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * To User Login
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $request->validate([
            'email'     => 'required|email',
            'password'  => 'required'
        ], [
            'email.required'    => 'Email Harus Di Isi',
            'password.required' => 'Password Harus Di Isi'
        ]);

        $user = User::where('email', $request->email)->first();

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $token = $user->createToken($user->name)->plainTextToken;
            return response()->json([
                'success'   => true,
                'user'      => $user,
                'token'     => $token
            ]);
        }

        return response()->json([
            'success'   => false,
            'message'   => 'Username/Password Salah!'
        ]);
    }

    /**
     * To User Logout
     * @return void
     */
    public function logout(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        $user->tokens()->where('tokenable_id', $user->id)->delete();
        auth()->logout();
        return response()->json([
            'success'   => true,
            'message'   => 'Anda Berhasil Logout'
        ]);
    }
}
