<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function Login(Request $request) {

        try{
            
            if(Auth::attempt($request->only('email','password'))) {
                $user = Auth::user();
                $token = $user->createToken('app')->accessToken;

                return response ([
                    'message' => "Successfully Login",
                    'token' => $token,
                    'UserDetails' => $user
                ],200);
            }


        }catch(Exception $exception) {
            return response([
                'message'=> $exception->getMessage()
            ],400);
        }

        return response ([
            'message' => "Invalid Email or password"
        ],401);
        
    }
}
