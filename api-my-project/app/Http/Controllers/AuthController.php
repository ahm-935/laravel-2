<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name'                  => 'required|min:3|max:100',
            'email'                 => 'required|email|unique:users,email',
            'password'              => 'required|min:3|max:15',
            'password_confirmation' => 'required|same:password',
        ]);

        $user           = new User();
        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->role_id  = 5;
        $user->password = Hash::make($request->password);
        
        if ($user->save()) {
            return response()->json([
                'success' => 'Registration completed successfully.'
            ]);
        } else {
            return response()->json([
                'error' => 'Registration failed. Try again later.'
            ], 500);
        }
    }
}
