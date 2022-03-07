<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class isTM
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (User::isThemeAdmin()==false){

            return back()->with('error','Denied - You do not have permissions to access Theme Management');
        }
        return $next($request);
    }
}
