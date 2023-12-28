<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsBlocked
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->blocked == 1)
        {
            auth()->logout();
            toastr()->error('Siz blok olunmusunuz','Diqqət');
            return redirect()->route('login');
        }

        return $next($request);
    }
}
