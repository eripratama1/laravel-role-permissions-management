<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
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

    public function assignRole()
    {
        $role = Role::get();
        return view('assign-role', ['role' => $role]);
    }

    public function setRole()
    {
        //
    }
}
