<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {


        $posts= Post::get();
        //$user->load('roles');
        $admin=User::isUserAdmin();
        $mod=User::isMod();
//        foreach ($user->roles as $role) {
//            //
//            $users=User::where();
//        }
        //$users=  User::where();
        //$users = auth()->user()->users;
        return view('post/feed', compact('posts', 'mod'),compact('admin'));
    }
}
