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
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Illuminate\Support\Facades\Auth;
use Products_JWT\User;




class AuthenticateController extends Controller
{
    public function authenticate(Request $request){
        $credentials = $request->only('email','password');
        try{
            //en base a las credenciales genero un token
            if(!$token = JWTAuth::attempt($credentials)){
                return response()->json(['error_message'=>'invalid_credential','status'=>'error'],401);
            }

            //en base al token generado consulto el usuario
            $user_auth = JWTAuth::toUser($token);
            //obtengo el token que se uso la ultima vez, si es primera vez viene null
            $last_token=$user_auth->api_token;
            //grabo el nuevo token en el campo api_token que se creo en la tabla users
            $user_auth->api_token=$token;
            $user_auth->save();
            //consulto los datos del usuario que acabo de actualizar y obtengo la info del usuario con su token generado
            $user = User::find($user_auth->id);
            $response['status']='success';
            $response['user_data']=$user;
            $response['last_token'] =$last_token;

            return $response;

        }catch(JWTException $e){
            return response()->json(['error_mmessage'=>$e->getMessage(),'status'=>'error'],500);
        }


    }

    public function register(Request $request){
        $rules =[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ];
        $this->validate($request,$rules);
        return User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);


    }

    public function getAuthenticatedUser()
    {
        try {

            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());

        } catch (TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());

        }

        // the token is valid and we have found the user via the sub claim
        return response()->json(compact('user'));
    }

    public function user(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $user['empresa']= $user->empresas()->first();
        return response([
            'status' => 'success',
            'data' => $user,
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
        $token = JWTAuth::getToken();

        if (! $token) {
            throw new BadRequestHttpException('Token not provided');
        }

        try {
            $token = JWTAuth::refresh($token);
        } catch (TokenInvalidException $e) {
            throw new AccessDeniedHttpException('The token is invalid');
        }

        return response()->json(compact('token'));
    }
}
