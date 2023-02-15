<?php

namespace App\Http\Middleware;

<<<<<<< HEAD
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
=======
use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;
>>>>>>> refs/remotes/origin/master

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
<<<<<<< HEAD
        if (Auth::check()) {    //si está autentificado
            if (auth()->user()->rol == "user") {   //si es role es admin

                return $next($request);    //significa continua
            }
        }
        return redirect()->route('login');  //en caso contrario va al login
=======
        if (Auth::check()) {
            if (auth()->user()->rol == "user") {   //si es rol es "user"

                return $next($request);    //significa que continua continua
            }
        }
        return redirect()->route('login');
>>>>>>> refs/remotes/origin/master
    }
}
