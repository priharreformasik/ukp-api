<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Alert;

class IsAdmin
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
        if(Auth::user()){
            if(Auth::user()->level=='Admin'){
                return $next($request);
            }
            else if(Auth::user()->level=='Super Admin'){
                return $next($request);
            }
            else{
                Alert::error('Failed','You are not admin!');
                return redirect()->back();
            }
        }else{
            return redirect('/');
        }
    }
  
}
