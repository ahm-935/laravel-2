<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $roles = Role::all();
        // $roles = DB::table('roles')->get();
        // $roles = DB::table('roles')->first();
        // $roles = DB::table('roles')->offset(2)->limit(2);
        // $roles = DB::table('products')->avg('price');
        // $roles = DB::table('products')->min('price');
        // $roles = DB::table('products')->select('name', 'price')->get();
        // $roles = DB::table('products as p')
        // ->join('categories as c', 'p.category_id', '=', 'c.id')
        // ->join('brands as b', 'p.brand_id', '=', 'b.id')
        // ->select('p.name', 'p.price', 'c.name as category', 'b.name as brand')
        // ->get();

        // $roles = DB::table('roles as r')
        // ->join('users as u', 'r.id', '=', 'u.role_id')
        // ->select('r.name as role')
        // ->selectRaw('count(u.id) as num_of_users')
        // ->groupBy('role')
        // ->get();

        // $roles = DB::table('roles as r')
        // ->join('users as u', 'r.id', '=', 'u.role_id')
        // ->select('r.name as role_name', 'u.name as user_name')
        // ->get();
        $roles = DB::table('roles')->orderBy('name', 'asc')
        ->get();
        // ->paginate(3);
        // dd($roles);
        // return view('admin.pages.role.index', compact('roles'));
        return response()->json($roles);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.role.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name|min:2|max:30'
        ]);
        $role = DB::table('roles')->insert([
            'name' => $request->name
        ]);
        if ($role) {
            return redirect()->route('roles.index')->with('success', 'Role created successfully');
        } else {
            return redirect()->route('roles.index')->with('error', 'Role not created');
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        return view('admin.pages.role.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|unique:roles,name|min:2|max:30'
        ]);
        $role = DB::table('roles')->where('id', $role->id)->update([
            'name' => $request->name
        ]);
        if ($role) {
            return redirect()->route('roles.index')->with('success', 'Role updated successfully');
        } else {
            return redirect()->route('roles.index')->with('error', 'Role not updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role = DB::table('roles')->where('id', $role->id)->delete();
        if ($role) {
            return redirect()->route('roles.index')->with('success', 'Role deleted successfully');
        } else {
            return redirect()->route('roles.index')->with('error', 'Role not deleted');
        }
    }

    // Custom method
    public function search(Request $request)
    {
        // dd('search');
        // echo $request->search;
        $roles = DB::table('roles')
            ->where('name', 'like', '%' . $request->search . '%')
            ->paginate();
        return response()->json($roles);
    }
}
