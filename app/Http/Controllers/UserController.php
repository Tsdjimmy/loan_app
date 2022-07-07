<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\services\UserServices;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function signUp( Request $request ) : \Illuminate\Http\JsonResponse
    {
        return UserServices::signUp( $request );
    }

    public function login( Request $request ) : \Illuminate\Http\JsonResponse
    {
        return UserServices::login( $request );
    }
}
