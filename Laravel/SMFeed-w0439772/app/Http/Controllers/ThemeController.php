<?php

namespace App\Http\Controllers;

use App\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ThemeController extends Controller
{
    public function __construct()
    {
        $this->middleware('isTm')->except('changeTheme');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */

    public function index()
    {
        //

        $themes= Theme::all();
//        foreach ($user->roles as $role) {
//            //
//            $users=User::where();
//        }
        //$users=  User::where();
        //$users = auth()->user()->users;
        return view('theme/home', compact('themes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        //
        return view('/theme/create');
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
            'name'=>'required',
            'cdn_url'=>'required|url'
        ]);
        $theme=Theme::create([
            'name'=>$data['name'],
            'cdn_url'=>$data['cdn_url'],
            'created_by'=>auth()->id(),
            'created_at'=>now()
        ]);
        return redirect('/theme/home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Theme  $theme
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show(Theme $theme)
    {
        //
        return view('theme.show',compact('theme'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Theme  $theme
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit(Theme $theme)
    {
        //
        return view('theme.edit',compact('theme'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Theme  $theme
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Theme $theme)
    {
        //

        $theme->update($this->validatedData());
        Theme::where('id',$theme->id)->update(array('updated_at'=>now()));
        Theme::where('id',$theme->id)->update(array('updated_by'=>Auth::id()));
        return redirect('/theme/home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Theme  $theme
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy(Theme $theme)
    {
        //
        $currentID=Auth::id();
        Theme::where('id',$theme->id)->update(array('deleted_by'=>$currentID));
        $theme->delete();
        return redirect('/theme/home');
    }
    public function changeTheme(Theme $theme){
        //set a cookie with the id of the chosen theme
        //redirect back to the page we just came from

        return redirect()->back()->withCookie('theme', $theme->cdn_url);
    }
    protected function validatedData(){
        return request()->validate([
            'name' => 'required',
            'cdn_url'=> 'required|url'

        ]);
    }
}
