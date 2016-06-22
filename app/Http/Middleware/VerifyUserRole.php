<?php

namespace CodeBase\Http\Middleware;

use Closure;
use CodeBase\Models\User;
use CodeBase\Models\Role;
use League\Flysystem\Exception;
use Auth;

class VerifyUserRole
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
        if(Auth::check()){
            if(Auth::user()->roles()->count() == 0){
                if(Auth::user()->username == 'angelo.neto'){
                    Auth::user()->roles()->attach(Role::find(1));
                }else{
                    Auth::user()->roles()->attach(Role::find(3));
                }
            }
        }

        return $next($request);
    }
}
