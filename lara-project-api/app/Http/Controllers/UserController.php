<?php

namespace App\Http\Controllers;

use App\Mail\ProfileUpdateMail;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Fluent;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $users = User::all();
        // $users = User::orderBy('id', 'desc')->first();
        // $users = User::orderBy('name', 'asc')->get();
        // $users = User::orderBy('id', 'asc')->offset(10)->limit(5)->get();
        // $users = User::orderBy('id', 'asc')->offset(10)->first();
        // $users = User::orderBy('id', 'asc')->where('role_id', 1)->get();
        // $users = User::orderBy('id', 'asc')->where('role_id', 1)->first();
        // $users = User::orderBy('id', 'asc')
        //         ->whereIn('role_id', [2, 3])
        //         ->get();
        // $users = User::orderBy('id', 'desc')
        //         ->select('id', 'name', 'email', 'role_id')
        //         ->first();
        // $users = User::from('users as u')
        //         ->join('roles as r', 'u.role_id', '=', 'r.id')
        //         ->orderBy('id', 'desc')
        //         ->select('u.id', 'u.name', 'u.email', 'r.name as role')
        //         ->first();
        // if (Auth::user()->role_id == 5) {
        //     abort(403);
        //     exit;
        // }
        $users = User::join('roles as r', 'users.role_id', '=', 'r.id')
            ->orderBy('id', 'desc')
            ->select('users.id', 'users.name', 'users.email', 'r.name as role')
            // ->get();
            ->paginate(10);

        // dd($users);
        // return view('admin.pages.user.index', compact('users'));
        return response()->json([
            'success'   => true,
            'users'     => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->role_id == 5) {
            abort(403);
            exit;
        }
        // $roles = Role::all();
        $roles = Role::orderBy('name', 'asc')->get();
        // return view('admin.pages.user.create', compact('roles'));
        return view('admin.pages.user.create', ['roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // if (Auth::user()->role_id == 5) {
        //     abort(403);
        //     exit;
        // }
        // dd($request->all());
        $request->validate([
            'name'                  => 'required|min:3|max:100',
            'email'                 => 'required|email|unique:users,email',
            'role_id'               => 'required|exists:roles,id',
            // 'password' => 'required|min:3|max:15|confirmed',
            'password'              => 'required|min:3|max:15',
            'password_confirmation' => 'required|same:password',
        ]);

        // $user = User::create([
        //     'name'      => $request->name,
        //     'email'     => $request->email,
        //     'role_id'   => $request->role_id,
        //     'password'  => Hash::make($request->password),
        // ]);

        $user           = new User();
        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->role_id  = $request->role_id;
        $user->password = Hash::make($request->password);
        // $user->save();

        // $user = false;

        // if ($user) {
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
                'error' => 'User not created. Try again later.'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // dd($id);
        // if (Auth::user()->role_id == 5 && Auth::user()->id != $id) {
        //     abort(403);
        //     exit;
        // }
        $user = User::join('roles as r', 'users.role_id', '=', 'r.id')
            ->where('users.id', $id)
            ->select('users.id', 'users.name', 'users.email', 'users.role_id', 'r.name as role')
            ->first();
        // dd($user);
        // return view('admin.pages.user.show', ['user' => $user]);
        if($user){
            return response()->json([
                'success' => true,
                'user' => $user
            ]);
        }else{
            return response()->json([
                'error' => true,
                'message' => 'User not found'
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // if (Auth::user()->role_id == 5 && Auth::user()->id != $id) {
        //     abort(403);
        //     exit;
        // }
        $roles = Role::all();
        $user = User::find($id);
        // dd($user);
        return view('admin.pages.user.edit', [
            'user'  => $user,
            'roles' => $roles
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // if (Auth::user()->role_id == 5 && Auth::user()->id != $id) {
        //     abort(403);
        //     exit;
        // }
        // dd($request->all());
        $request->validate([
            'name'                  => 'required|min:3|max:100',
            'email'                 => "required|email|unique:users,email,$id",
            // 'email'                 => 'required|email|unique:users,email'.$id,
            'role_id'               => 'required',
        ]);

        // $user = User::find($id);
        // $user->name     = $request->name;
        // $user->email    = $request->email;
        // $user->role_id  = $request->role_id;
        // $user->save();

        $user = User::where('id', $id)
            ->update([
                'name'      => $request->name,
                'email'     => $request->email,
                'role_id'   => $request->role_id
            ]);

        if ($user) {
            // $role = Role::find($request->role_id);
            // $user = User::find($id);
            // $userData = [
            //     'id'        => $user->id,
            //     'name'      => $user->name,
            //     'email'     => $user->email,
            //     'role_id'   => $role->name,
            //     'updated'   => $user->updated_at
            // ];
            // // $userData = (object) $userData;     // PHP object convertion
            // $userData = new Fluent($userData);  // Laravel object convertion
            // // dd($userData);
            // Mail::to($request->email)->send(new ProfileUpdateMail($userData));
            // return redirect()
            //     ->route('users.index')
            //     ->with('success', 'User updated successfully! A notification email has been sent to the user.');
            return response()->json([
               'success' => true,
               'message' => 'User updated successfully!'
            ]);
        } else {
            // return redirect()
            //     ->route('users.edit', $id)
            //     ->with('error', 'Something went wrong. User not updated');
            return response()->json([
               'error' => true,
               'message' => 'User not found'
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // dd($id);
        // $user->delete();

        // if (Auth::user()->role_id != 1 && Auth::user()->role_id != 2) {
        //     abort(403);
        //     exit;
        // } else {
        //     User::destroy($id);
        //     return redirect()
        //         ->route('users.index')
        //         ->with('success', 'User deleted successfully');
        // }        
        $user = User::find($id);
        if($user){
            $user->delete();
            return response()->json([
                'success' => true,
                'message' => 'User deleted successfully'
            ]);
        }else{
            return response()->json([
                'error' => true,
                'message' => 'User not found'
            ], 404);
        }
    }
}
