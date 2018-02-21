<?php
/**
 * Created by PhpStorm.
 * User: gustavodecker
 * Date: 2/20/18
 * Time: 19:39
 */

namespace Products_JWT\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Auth;
use Products_JWT\User;



class AuthenticateController extends Controller
{
    public function authenticate(Request $request){
        $credentials = $request->only('email','password');
        try{
            if(!$token = JWTAuth::attempt($credentials)){
                return response()->json(['error'=>'invalid_credential'],401);
            }
        }catch(JWTException $e){
            return response()->json(['error'=>'could_not_create_token'],500);
        }

        $response = compact('token');
        $response['status']='success';
        $response['user'] = Auth::user();
        return $response;
    }

    public function user(Request $request)
    {
        $user = User::find(Auth::user()->id);
        return response([
            'status' => 'success',
            'data' => $user
        ]);
    }

    public function logout()
    {
        JWTAuth::invalidate();
        return response([
            'status' => 'success',
            'msg' => 'Logged out Successfully.'
        ], 200);
    }

    public function refresh()
    {
        return response([
            'status' => 'success'
        ]);
    }
}