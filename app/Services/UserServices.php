<?php


namespace App\services;

use App\Helpers\GeneralHelper;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UserServices
{
    public static function signUp($request)
    {
        try {
            $rules = [
                'username' => 'required | unique:users,username',
                'first_name' => 'required',
                'last_name' => 'required',
                'phone' => 'required | unique:users,phone',
                'password' => 'required'
            ];

            $validator = Validator::make($request->input(), $rules, GeneralHelper::customMessage());

            if($validator->fails()){
                return response()->json([
                    'error' => true,
                    'message' => $validator->errors()
                ]);
            }

            $username = $request->input('username');
            $first_name = $request->input('first_name');
            $last_name = $request->input('last_name');
            $phone = $request->input('phone');
            $image = $request->input('image');
            $password = $request->input('password');

            if (User::where('username', $username)->count() > 0) return response()->json(['message' => 'Username already exist.'], 200);

            if (User::where('phone', $phone)->count() > 0) return response()->json(['message' => 'Phone number already in use'], 200);

            $user = new User();
            $user->username = $username;
            $user->first_name = $first_name;
            $user->last_name = $last_name;
            $user->phone = $phone;
            $user->image = $image;
            $user->password = password_hash($password, PASSWORD_DEFAULT);

            $token = $user->createToken('Personal Access Token', ['user'])->accessToken;
            $user->save();

            return response()->json(
                [
                    'message' => 'Account created successfully',
                    'data' => [
                        'user' => $user,
                        'token' => $token,
                    ]
                ],
                200
            );
        } catch (\Exception $exception) {
            return response()->json(
                [
                    'message' => $exception->getMessage()
                ],
                400
            );
        }
    }

    public static function login($request): \Illuminate\Http\JsonResponse
    {
        try {

            $username = $request->input('username');
            $password = $request->input('password');

            $user = User::where('username', $username)->first();

            if (is_null($user)) return response()->json(['message' => 'Invalid credentials provided'], 400);

            if (!password_verify($password, $user->password)) return response()->json(['message' => 'Invalid credentials provided'], 400);


            $token = $user->createToken('Personal Access Token', ['user'])->accessToken;
            return response()->json(
                [
                    'message' => 'Access granted successfully',
                    'data' => [
                        'user' => $user,
                        'token' => $token
                    ]
                ],
                200
            );
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while logging in',
                'short_description' => $e->getMessage(),
            ], 400);
        }
    }


}