<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function posts(){
        return $this->hasMany(Post::class);
    }
    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    public static function isUserAdmin(){ //return true or false
        //see if the user admin role is one of the user's current roles
        $currentId=Auth::id();
        $matches=\DB::table('role_user')->where('user_id', $currentId)->get();
        foreach ($matches as $match){
            if ($match->role_id==1){
                return true;
            }
        }
        return false;
    }
    public static function isMod(){ //return true or false
        //see if the user mod is one of the user's current roles
        $currentId=Auth::id();
        $matches=\DB::table('role_user')->where('user_id', $currentId)->get();
        foreach ($matches as $match){
            if ($match->role_id==2){
                return true;
            }
        }
        return false;
    }
    public static function isThemeAdmin(){ //return true or false
        //see if the user theme admin is one of the user's current roles
        $currentId=Auth::id();
        $matches=\DB::table('role_user')->where('user_id', $currentId)->get();
        foreach ($matches as $match){
            if ($match->role_id==3){
                return true;
            }
        }
        return false;
    }
}
