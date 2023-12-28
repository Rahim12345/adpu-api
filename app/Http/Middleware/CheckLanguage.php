<?php

namespace App\Http\Middleware;

use App\Models\SystemLanguage;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $language = request('language');
        $check_language = SystemLanguage::where('language', $language)->first();

        if (!$check_language)
        {
            return response()->json([
                'errors'=>[
                    'message'=>__('static.data_not_found')
                ]
            ],404);
        }

        return $next($request);
    }
}
