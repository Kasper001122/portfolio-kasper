<?php

namespace App\Http\Controllers;
use App\Role;
use App\User;

//use App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isUa');


    }
    public function index()
    {
        $users= User::has('roles')->get();

        return view('/home', compact('users'));
    }
    public function create()
    {
        $roles=Role::all();
        return view('user.admin.create',compact('roles'));
    }
    public function store(){
        $data=request()->validate([
            'name'=>'required',
            'password'=>'required',
            'email'=>'required|email',
            'roles'=>'required|min:1'
        ]);
        //$data->password=Hash::make(request()->password);
//        $data->user()->fill([
//            'password'=>Hash::make($data->password)
//        ]);
        $user= User::create([
           'name'=>$data['name'],
           'email'=>$data['email'],
           'password'=>bcrypt($data['password']),
        ]);


        foreach (request()->roles as $role) {
            \DB::table('role_user')->insert([
                'role_id' => $role,
                'user_id' => $user->id,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        return redirect('/user/admin/'.$user->id);
    }
    public function show(\App\User $user){
        return view('user.admin.show',compact('user'));
    }
    public function edit(User $user){ //route model binding
        //the user only has direct data...no related data
        //load additional related data to the object after the fact...lazy load

        $user->load('roles');
        $roles=Role::all();
        return view('user.admin.edit',compact('user', 'roles'));
    }
    public function update(User $user){
        \DB::table('role_user')->where('user_id',$user->id)->delete();
        $user ->update($this->validatedData());
        foreach (request()->roles as $role) {
            \DB::table('role_user')->insert([
                'role_id' => $role,
                'user_id' => $user->id,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
        return redirect('/home');

    }
    public function destroy(User $user){

        $currentId=Auth::id();//https://stackoverflow.com/questions/45522428/how-to-get-current-user-id-in-laravel-5-4/51926832
        User::where('id',$user->id)->update(array('deleted_by'=>$currentId));//https://www.codegrepper.com/code-examples/php/update+only+one+column+laravel
        $user->delete();
        return redirect('/home');
    }
    protected function validatedData(){
        return request()->validate([
            'name' => 'required',
            'email'=> 'required|email',
            'roles'=>'required|min:1'
        ]);
    }
}
