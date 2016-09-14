<?php

namespace App\Http\Middleware;


use Closure;
use \Illuminate\Support\Facades\Auth;

class UserCreatedAccount
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
        // Check if the logged in id matches the id of the account they are trying to edit.
        // Not send them a 403.
        return (Auth::user()->id == $request->customer) 
            ? $next($request)
            : abort(403);
    }
}
