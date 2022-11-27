<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $post = Post::latest()->get();
        return view('home', ['post' => $post]);
    }

    public function listUser()
    {
        $user = User::get();
        return view('ListUser', [
            'user' => $user,
        ]);
    }

    public function assignRole($id)
    {
        $role = Role::get();
        $user  = User::findOr($id);
        return view('assign-role', [
            'role' => $role,
            'user' => $user
        ]);
    }

    public function setRole(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->syncRoles($request->input('role'));
        $user->update();
        return to_route('list-user');
    }

    public function listPermission()
    {
        $permission = Permission::get();
        $role = Role::get();
       
        return view('ListPermission', [
            'permission' => $permission,
            'role' => $role,
        ]);
    }

    public function createPermission()
    {
        return view('create-permission');
    }

    public function storePermission(Request $request)
    {
        $permission = Permission::create(['name' => $request->input('name')]);
        return to_route('list-permission');
    }

    public function assignPermission($id)
    {
        $role = Role::findOrFail($id);
        $roles = $role->permissions->collect();
        // $roles = Role::with('permissions')->get();
        $permission = Permission::get();
        return view('assign-permission', [
            'role' => $role,
            'roles' => $roles,
            'permission' => $permission
        ]);
    }

    public function setPermission(Request $request,$id)
    {
        $role = role::findOrFail($id);
        $role->syncPermissions($request->input('permission'));
        $role->update();
        return to_route('list-permission');
    }
}
