<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckApiKey
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $api_key = request('api_key');
        if ($api_key != config('app.api_key'))
        {
            return response()->json([
                'errors'=>[
                    'message'=>__('static.access_denied')
                ]
            ],401);
        }

        return $next($request);
    }
}
