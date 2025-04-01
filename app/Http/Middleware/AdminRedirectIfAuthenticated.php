<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminRedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        /**if the user is already logged in and tries to login page then we 
         * send the user to the dashboard page from here
         * it will check if your in the login apge and your session is already created then 
         * you will be send back to dashboard page
         */
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }

        return $next($request);
    }
}
