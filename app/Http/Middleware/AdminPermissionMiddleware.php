<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminPermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$permissions): Response
    {
        if (! Auth::check()) {
            abort(403, 'Unauthorized. Please login to access this page.');
        }

        $user = Auth::user();

        // Allow access if user is admin
        if ($user->isAdmin()) {
            return $next($request);
        }

        // Check if user has a role assigned
        if (!$user->role) {
            abort(403, 'Unauthorized. No role assigned to your account. Please contact administrator.');
        }

        // Check user status
        if ($user->status != 'active') {
            abort(403, 'Unauthorized. Your account is not active. Please contact administrator.');
        }

        // Check permissions if any are specified
        if ($permissions) {
            foreach ($permissions as $permission) {
                if (!$user->hasPermission($permission)) {
                    abort(403, 'Unauthorized. You do not have the required permissions to access this page.');
                }
            }
        }

        return $next($request);
    }
}
