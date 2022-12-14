<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AdminUser;
use Illuminate\Support\Carbon;

class AuthController extends Controller
{

    public function admin_register(Request $request){
        $request->validate([
            'name'=>'required|string',
            'email'=>'required|email|unique:admin_users,email',
            'password'=>'required'
        ]);

        $user = new AdminUser([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>md5($request->password)
        ]);
        $user = $user->save();
        $credidentials = ['email'=>$request->email, 'password'=>$request->password];
        
        if(!Auth::attempt($credidentials)){
            return response()->json([
                'message'=>'Giriş Yapılamadı'
            ],401);
        }

        $user = Auth::user();//$request->user();
        $tokenResult = $user->createToken('Personal Access');
        
        return response()->json([
            'success'=>true,
            'user'=>$user,
            'access_token'=>$tokenResult->accessToken,
            'token_type'=>'Bearer',
            'provider'=>'admin',
            'expires_at'=>Carbon::parse($tokenResult->token->expires_at)->toDateTimeString()
        ],201);
        $token = $tokenResult->token;
        $token->save();
    }

    public function login(Request $request){
        $request->validate([
            'email'=>'required|string|email',
            'password'=>'required|string'
        ]);
      
        $credentials = request(['email','password']);
        if(!Auth::attempt($credentials)){
            return response()->json([
                'message'=>'Bilgiler hatalı'
            ], 401);
        }
        $user = Auth::user();//$request->user;
        $tokenResult = $user->createToken("Personal Access Token");

        return response()->json([
            'success'=>true,
            'user'=>$user,
            'access_token'=>$tokenResult->accessToken,
            'token_type'=>'Bearer',
            'expires_at'=>Carbon::parse($tokenResult->token->expires_at)->toDateTimeString()
        ],201);
        $token = $tokenResult->accessToken;
        $token->save();
        
    }

    public function logout(Request $request){
        $request->user()->token()->revoke();
        return response()->json([
            'message'=>'Çıkış Yapıldı'
        ],201);
    }
    public function authenticate(Request $request){
        $user = [];
        if(Auth::check()){
            $user = Auth::user();
        }
        return response()->json([
            'user'=>$user,
            'isLoggedIn'=>Auth::check()
        ],201);
    }
}