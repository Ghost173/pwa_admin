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
use Mail;
use App\Mail\ForgotPasswordMail;
use App\Mail\passwordResetConfirm;

class AuthController extends Controller
{
  
    public function Login(Request $request) {
  
        try{
            
            if(Auth::attempt($request->only('email','password'))) {
                $user = Auth::user();
                $token = $user->createToken('app')->accessToken;

                $user->touch(); // Update the updated_at timestamp
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
            return response(['errors'=>$validator->errors()->all()], 401);
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
   

    public function forgotpassword(Request $request) {

        $validator = Validator::make($request->all(), [
            'email' => 'required',
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 401);
        }

        $email = $request->email;

        if(User::where('email',$email)->doesntExist()) {
            return response([
                'message' => 'Email not found with in the database'
            ],401);
        }

        //generate random token for rest 
        $token = rand(10,100000);
        try {
            DB::table('password_reset_tokens')->insert([
                'email'=> $email,
                'token' => $token
            ]);

            //mail function
            Mail::to($email)->send(new ForgotPasswordMail($token));

            return response ([
                'message' => 'Rest password email was sent'
            ],200);

        }catch (\Throwable $th) {
            return response([
                'message'=> $th->getMessage()
            ],400);
        }
    }

    public function restpassword(Request $request) {
        $validator = Validator::make($request->all(), [
            'token' => 'required',
            'email' => 'required',
            'password'=> 'required|string|min:6|confirmed',
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 401);
        }

        $email = $request->email;
        $token = $request->token;
        $password = Hash::make($request->password);

        $emailcheck = DB::table('password_reset_tokens')->where('email',$email)->where('token',$token)->first();

        if(!$emailcheck) {
            return response ([
                'message' => 'Enter data was mismatch'
            ],401);
        }

        DB::table('users')->where('email',$email)->update(['password' => $password]);
        DB::table('password_reset_tokens')->where('email',$email)->delete();


        Mail::to($email)->send(new passwordResetConfirm);


        return response ([
            'message' => 'password change success'
        ],200);

    }



    public function user() {
        return Auth::user();
    }
}
