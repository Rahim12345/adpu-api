<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PermissionLinks
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $current_route_name = $request->route()->getName();
        if (auth()->check())
        {
            $permissions = auth()->user()->getPermissionLinks()->toArray();
            if ($current_route_name != 'admin.dashboard')
            {
                if (auth()->id() != 1)
                {
                    if (!in_array($current_route_name,$permissions))
                    {
                        abort(403);
                    }
                }
            }
        }
        return $next($request);
    }
}
