<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Mail\CredentialUpdateMail;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $users = User::all();
        // $users = User::orderBy('id', 'desc')->get();
        // $users = User::orderBy('id', 'asc')->offset(10)->limit(10)->get();
        // $users = User::orderBy('id', 'asc')->offset(10)->first();
        // $users = User::orderBy('id', 'asc')->where('role_id', 1)->get();
        // $users = User::orderBy('id', 'asc')
        // // ->where('role_id', 2)
        // ->whereIn('role_id', [2, 3])
        // ->get();
        // $users = User::orderBy('id', 'asc')
        // ->select('id', 'name', 'email', 'role_id')
        // ->first(); 

        // $users = User::from('users as u')
        // ->join('roles as r', 'u.role_id', '=', 'r.id')
        // ->orderBy('id', 'asc')
        // ->select('u.id', 'u.name', 'u.email', 'role_id', 'r.name as role_name')
        // ->first();
        // if (Auth::user()->role_id == 5) {
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
        return response()->json([
            'status' => 'success',
            'data' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->role_id == 5) {
            abort(403);
            exit();
        }
        $roles = Role::from('roles as r')->select('id', 'name')
            ->orderBy('name', 'asc')
            ->get();

        return view('admin.pages.user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // if (Auth::user()->role_id == 5) {
        //     abort(403);
        //     exit();
        // }

        $request->validate([
            'name' => 'required|min:3 |max:100',
            'email' => 'required|email|unique:users,email',
            'role_id' => 'required|exists:roles,id',
            // 'password' => 'required|min:3|max:20|confirmed',
            'password' => 'required|min:3|max:20',
            'password_confirmation' => 'required|same:password',
        ]);

        // $user = User::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'role_id' => $request->role_id,
        //     'password' => Hash::make($request->password)
        // ]);

        // $user = false;
        // if ($user) {
        //     return redirect()
        //         ->route('users.index')
        //         ->with('success', 'User created successfully.');
        // } else {
        //     return redirect()
        //         ->route('users.create')
        //         ->with('error', 'User creation failed.');
        // }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $request->role_id;
        $user->password = Hash::make($request->password);
        // $user->save();

        if ($user->save()) {
            // return redirect()
            //     ->route('users.index')
            //     ->with('success', 'User created successfully.');
            return response()->json([
                'status' => 'success',
                'message' => 'User created successfully.',
              
            ]);
        } else {
            // return redirect()
            //     ->route('users.create')
            //     ->with('error', 'User creation failed.');
            return response()->json([
                'status' => 'error',
                'message' => 'User creation failed.',
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // if (Auth::user()->role_id == 5 && Auth::user()->id != $id) {
        //     abort(403);
        // }
        $user = User::join('roles as r', 'users.role_id', '=', 'r.id')
            ->where('users.id', $id)
            ->select('users.id', 'users.name', 'users.email', 'users.role_id', 'r.name as role')
            ->first();
        // dd($user);
        // return view('admin.pages.user.show', compact('user'));
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found.',
            ], 404);
        }else {
            return response()->json([
                'status' => 'success',
                'data' => $user,
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // if (Auth::user()->role_id == 5 && Auth::user()->id != $id) {
        //     abort(403);
        // }
        $roles = Role::from('roles as r')->select('id', 'name')
            ->orderBy('name', 'asc')
            ->get();
        $user = User::find($id);
        return view('admin.pages.user.edit', compact('roles', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        // dd($request->all());
        // if (Auth::user()->role_id == 5 && Auth::user()->id != $id) {
        //     abort(403);
        //     exit();
        // }
        $request->validate([
            'name' => 'required|min:3|max:100',
            'email' => 'required|email|unique:users,email,' . $id,
            'role_id' => 'required|exists:roles,id',
            'password' => 'min:3|max:20',
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $request->role_id;
        $user->save();

        // $user = User::where('id', $id)->update([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'role_id' => $request->role_id,
        // ]);
        // $user = false;
        if ($user) {

            $role = Role::find($request->role_id);

            // Mail::to($request->email)
            //     ->send(
            //         new CredentialUpdateMail(
            //             $request->name,
            //             $request->email,
            //             $role->name
            //         )
            //     );
            // return redirect()
            //     ->route('users.index')
            //     ->with('success', 'User updated successfully.');
            return response()->json([
                'status' => 'success',
                'message' => 'User updated successfully.',
            ]);
        // } else {
        //     return redirect()
        //         ->route('users.show', ['user' => $id])
        //         ->with('error', 'User update failed.');
        // }
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'User update failed.',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // dd($id);
        // User::destroy($id);
        // return redirect()
        //     ->route('users.index')
        //     ->with('success', 'User deleted successfully.');

        // if (Auth::user()->role_id != 1) {
        //     abort(403);
        // } else {


        //     $user = User::find($id);
        //     if ($user) {
        //         $user->delete();
        //         return redirect()
        //             ->route('users.index')
        //             ->with('success', 'User deleted successfully.');
        //     } else {
        //         return redirect()
        //             ->route('users.index')
        //             ->with('error', 'User not found.');
        //     }
        // }
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'User deleted successfully.',
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found.',
            ], 404);
        }
    }
}
