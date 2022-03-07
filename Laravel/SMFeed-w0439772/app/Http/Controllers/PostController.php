<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use App\Role;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {

        $posts= Post::get();
        $users= User::has('roles')->get();

//        foreach ($user->roles as $role) {
//            //
//            $users=User::where();
//        }
        //$users=  User::where();
        //$users = auth()->user()->users;
        return view('post/feed', compact('posts'), compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        //
        $user= User::get();
        return view('/post/create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        //
        $data=request()->validate([
            'title'=>'required',
            'content'=>'required'
        ]);
        $post=Post::create([
            'title'=>$data['title'],
            'content'=>$data['content'],
            'created_by'=>auth()->id(),
            'created_at'=>now()
        ]);
        return redirect('/post/feed');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit(Post $post)
    {
        //
        return view('post.edit', compact('post'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Post $post)
    {
        //

        $post->update($this->validatedData());
        return redirect('/post/feed');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy(Post $post)
    {
        //
        $currentId=Auth::id();
        Post::where('id',$post->id)->update(array('deleted_by'=>$currentId));
        $post->delete();
        return redirect('/post/feed');
        //return $currentId;
    }
    protected function validatedData(){
        return request()->validate([
            'title' => 'required',
            'content'=> 'required'
        ]);
    }
}
