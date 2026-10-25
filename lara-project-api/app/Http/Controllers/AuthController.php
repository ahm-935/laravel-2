<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);
        $result = Auth::attempt([
                    'email'     => $request->email,
                    'password'  => $request->password
                ]);
        if($result){
            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'success'   => true,
                'token'     => $token,
                'user'      => $user
            ]);
        }else{
            return response()->json([
                'error'     => true,
                'message'   => 'Invalid credentials'
            ], 401);
        }
    }

    public function logout(Request $request)
    {
        // return $request->user()->currentAccessToken()->delete();
        // Single token logout
        // $request->user()->currentAccessToken()->delete();

        // All tokens logout
        $request->user()->tokens()->delete();
        
        return response()->json("Logout works");
    }
    
    public function checkToken(Request $request)
    {
        $result = Auth::guard('sanctum')->check();
        if(!$result){
            return response()->json([
                'error'     => true,
                'message'   => 'Invalid token'
            ], 401);
        }else{
            $user = Auth::guard('sanctum')->user();
           return response()->json($user);
        }
        return response()->json($result);
        // return response()->json($request->user());
    }
}
