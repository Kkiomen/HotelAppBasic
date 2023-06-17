<?php

namespace App\Helpers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Laravel\Sanctum\PersonalAccessToken;

class RequestHelper
{
    /**
     * Get User model from Request
     * @param Request $request
     * @return User
     */
    public static function getUserFromRequestApi(Request $request): User{
        $authKey = $request->header('Authorization');
        $apiKey = str_replace(['Bearer ', ' ', 'Bearer', 'bearer'], '', $authKey);
        $token = PersonalAccessToken::where('token', $apiKey)->first();
        $user = $token->tokenable;
        return $user;
    }

}
