<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class Menager
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

            if (auth()->user() && auth()->user()->position === "developer"){
                return redirect(url('dev'));
            }

        return $next($request);
    }
}
