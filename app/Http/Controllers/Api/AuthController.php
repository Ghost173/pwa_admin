<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Validator;


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



    public function Register (Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }

    try {
            $user = User::create([
                'name' => $request->name,
                'email'=> $request->email,
                'password'=>Hash::make($request->password),
            ]);
            $token = $user->createToken('app')->accessToken;

            return response ([
                'message' => 'registration successful',
                'token' => $token,
                'user'=>$user 
            ],200);

        } catch (\Throwable $th) {
            return response([
                'message'=> $th->getMessage()
            ],400);
        }

    }




    public function logout(Request $request) {
        // $accessToken = auth()->user()->token();
        // $token= $request->user()->tokens->find($accessToken);
        // $token->revoke();
        
        Auth::user()->token()->revoke();
        return response(['message'=> 'Je bent uitgelogd'], 200);
    }
   
}
