<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Users
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
{
    $allowedTypes = [2, 3, 4, 11, 12];
    if (!in_array(Auth::user()->tipe_user_id, $allowedTypes)) {
        return redirect('404');
    }
    return $next($request);
}

}
