<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Fluent;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // if (Auth::user()->role_id == 3) {
        //     abort(403);
        //     exit();
        // }

        $users = User::join('roles as r', 'users.role_id', '=', 'r.id')
            ->orderBy('id', 'desc')
            ->select('users.id', 'users.name', 'users.email', 'r.name as role')
            // ->limit(10)               
            ->paginate(10);
        // ->get();
        // dd($users);
        // return view('admin.pages.user.index', compact('users'));
        return response()->json($users);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::from('roles')
            ->select('id', 'name')
            ->get();
        return view('admin.pages.user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'role_id' => 'required',
            'password' => 'required|min:3',
            'confirm_password' => 'required|same:password',
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $request->role_id;
        $user->password = Hash::make($request->password);
        // $user->save();
        // return redirect()->route('users.index');
        if ($user->save()) {
            // return redirect()
            //     ->route('users.index')
            //     ->with('success', 'User created successfully');
            return response()->json([
                'success' => 'User created successfully'
            ]);
        } else {
            // return redirect()
            //     ->route('users.create')
            //     ->with('error', 'User not created');
            return response()->json([
                'error' => 'User not created'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::join('roles as r', 'users.role_id', '=', 'r.id')
            ->where('users.id', $id)
            ->select('users.id', 'users.name', 'users.email', 'r.name as role')
            ->first();
        // dd($user);
        // return view('admin.pages.user.show', compact('user'));
        if ($user) {
            return response()->json($user);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $roles = Role::from('roles')
            ->select('id', 'name')
            ->get();

        $user = User::find($id);

        return view('admin.pages.user.edit', compact('user', 'roles'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'role_id' => 'required',
        ]);
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $request->role_id;
        $user->save();

        // $user = false;
        if ($user) {
            $role = Role::find($user->role_id);
            $user = User::find($id);
            $userdata = [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $role->name,
                'updated_at' => $user->updated_at
            ];
            // $userdata = (object)$userdata;
            $userdata = new Fluent($userdata);
            // dd($userdata);
            // Mail::to($user->email)->send(new \App\Mail\ProfileUpdateMail($userdata));
            // return redirect()
            //     ->route('users.index');
            return response()->json([
                'success' => 'User updated successfully'
            ]);
        } else {
            // return redirect()
            //     ->route('users.edit')
            //     ->with('error', 'User not updated');
            return response()->json([
                'error' => 'User not updated'
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('success', 'User deleted successfully');
    }
}
