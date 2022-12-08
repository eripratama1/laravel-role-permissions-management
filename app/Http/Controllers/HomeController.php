<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        return view('home');
    }

    public function listUser()
    {
        /**
         * Method ini akan menampilkan data user 
         * dan hanya user dengan role  SuperAdmin yang bisa 
         * mengakses halaman ini jika user tersebut tidak memiliki role SuperAdmin
         * 
         * Maka akan langsung di-redirect ke halaman Home
         */
        if (Auth::user()->hasAnyRole('SuperAdmin')) {
            # code...
            $user = User::get();
            return view('role.ListUser', [
                'user' => $user
            ]);
        }
        return to_route('home')->with('status', 'Maaf role kamu tidak punya akses');
    }

    public function assignRole($id)
    {
        /**
         * Sama seperti method di atas pada method assignRole ini 
         * hanya user yang mempunyai role SuperAdmin yang bisa mengakses halaman
         * assignRole, serta menambahkan atau memberi
         * role untuk user lainnya.
         */
        if (Auth::user()->hasRole('SuperAdmin')) {
            # code...
            $role = Role::get();
            $user  = User::findOr($id);
            return view('role.assign-role', [
                'role' => $role,
                'user' => $user
            ]);
        }
        return to_route('home')->with('status', 'Maaf kamu tidak bisa melakukan itu');
    }

    public function setRole(Request $request, $id)
    {
        /**
         * Proses assignRole user dengan memanfaatkan trait
         * syncRoles dari spatie untuk menambahkan atau mengubah role
         * lalu update data tersebut.
         */
        $user = User::findOrFail($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->syncRoles($request->input('role'));
        $user->update();
        return to_route('list-user');
    }

    public function listPermission()
    {
        /**
         * Menampilkan data permission dan role
         */
        $permission = Permission::get();
        $role = Role::get();

        return view('role.ListPermission', [
            'permission' => $permission,
            'role' => $role,
        ]);
    }

    public function createPermission()
    {
        return view('role.create-permission');
    }

    public function editPermission($id)
    {
        /**
         * Melakukan edit permission untuk proses update
         * silahkan dikembangkan sendiri proses update
         * sama dengan proses update data seperti biasanya..
         */
        $permission = Permission::findOrFail($id);
        return dd($permission);
    }

    public function storePermission(Request $request)
    {
        /**
         * Proses Store permission 
         */
        $permission = Permission::create(['name' => $request->input('name')]);
        return to_route('list-permission');
    }

    public function assignPermission($id)
    {
        /**
         * Melakukan proses check apakah user memiliki role SuperAdmin
         * atau tidak
         */
        if (Auth::user()->hasRole('SuperAdmin')) {
            # code...
            $role = Role::findOrFail($id);
            $roles = $role->permissions->collect();
            // $roles = Role::with('permissions')->get();
            $permission = Permission::get();
            return view('role.assign-permission', [
                'role' => $role,
                'roles' => $roles,
                'permission' => $permission
            ]);
        }
        return to_route('home')->with('status', 'Maaf kamu tidak bisa melakukan itu');
    }

    public function setPermission(Request $request, $id)
    {
        /**
         * Proses set permission untuk user 
         */
        $role = role::findOrFail($id);
        $role->syncPermissions($request->input('permission'));
        $role->update();
        return to_route('list-permission');
    }
}
