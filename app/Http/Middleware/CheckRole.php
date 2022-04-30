<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        $user = Auth::user();
        $roles = explode('|', $role);
        $roleUser = [
            User::ROLE_ADMIN => 'admin',
            User::ROLE_SINGER => 'singer',
            User::ROLE_USER => 'user',
        ];

        if ($user && in_array($roleUser[$user->role], $roles)) return $next($request);

        return response()->redirectToRoute('home');
    }

}
