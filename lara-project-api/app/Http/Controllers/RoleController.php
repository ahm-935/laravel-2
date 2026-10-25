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
        // $roles = DB::table('roles')->paginate(2);
        // $roles = DB::table('roles')->where('name', 'admin')->first();
        // $roles = DB::table('users')->latest()->get();
        // $roles = DB::table('users')->oldest()->get();
        // $roles = DB::table('roles')->offset(2)->limit(2)->get();
        // $roles = DB::table('roles')->count('id');
        // $roles = DB::table('products')->avg('price');
        // $roles = DB::table('products')->min('price');
        // $roles = DB::table('products')->select('name', 'price')->get();
        // $roles = DB::table('products as p')
        //         ->join('categories as c', 'p.category_id', '=', 'c.id')
        //         ->join('brands as b', 'p.brand_id', '=', 'b.id')
        //         ->select('p.name', 'c.name as category', 'b.name as brand', 'p.price')
        //         ->get();
        
        // role     no_of_users
        // ----------------------
        // Admin    5
        // Vendor   10
        
        // $roles = DB::table('roles as r')
        //         ->join('users as u', 'r.id', '=', 'u.role_id')
        //         ->select('r.name as role', DB::raw('count(u.id) as no_of_users'))
        //         ->groupBy('role')
        //         ->get();
        // $roles = DB::table('roles as r')
        //         ->join('users as u', 'r.id', '=', 'u.role_id')
        //         ->select('r.name as role')
        //         ->selectRaw('COUNT(u.id) as no_of_users')
        //         ->groupBy('role')
        //         ->toSql();
        
        $roles = DB::table('roles')->orderBy('name','asc')->paginate();
        // dd($roles);
        // return view('admin.pages.role.index', ['roles' => $roles]);
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
        // $role = Role::create([
        //             'name' => $request->name
        //         ]);
        $role = DB::table('roles')
                ->insert([
                    'name' => $request->name
                ]);
        if($role){
            return redirect()->route('roles.index')->with('success', 'Role created successfully');
        }else{
            return redirect()->route('roles.create')->with('error', 'Role not created');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        return view('admin.pages.role.edit', ['role' => $role]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|unique:roles,name|min:2|max:30'
        ]);
        $role = DB::table('roles')
                ->where('id', $role->id)
                ->update([
                    'name' => $request->name
                ]);
        if($role){
            return redirect()->route('roles.index')->with('success', 'Role updated successfully');
        }else{
            return redirect()->route('roles.edit', ['role' => $role])->with('error', 'Role not update');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role = DB::table('roles')
                ->where('id', $role->id)
                ->delete();
        if($role){
            return redirect()->route('roles.index')->with('success', 'Role deleted successfully');
        }else{
            return redirect()->route('roles.index')->with('error', 'Role not deleted');
        }
    }

    // Custom Method
    public function search(Request $request){
        // dd("Search works");
        // echo $request->search;
        $roles = DB::table('roles')
                ->where('name', 'like', '%'.$request->search.'%')
                ->paginate();
        return response()->json($roles);
    }
}
