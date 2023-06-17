<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;


class TokenApiMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $apiKey = $request->header('Authorization');
        if (empty($apiKey)) {
            return response()->json(['message' => 'The API token has not been provided. Verify the "Authorization" header has an authorization token'], 401);
        }

        $apiKey = str_replace(['Bearer ', ' ', 'Bearer', 'bearer'], '', $apiKey);
        $token = PersonalAccessToken::where('token', $apiKey)->first();

        if(!is_null($token)){
            $user = $token->tokenable;
            Auth::login($user);
            if ($user) {
                return $next($request);
            }
        }

        return response()->json(['message' => 'The API token is invalid. Verify that a valid api token has been provided'], 401);
    }
}
