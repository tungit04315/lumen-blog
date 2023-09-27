<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;

class ExampleController extends Controller
{
    /**
     * @var \Tymon\JWTAuth\JWTAuth
     */
    protected $jwt;

    public function __construct(JWTAuth $jwt)
    {
        $this->jwt = $jwt;
    }
    
    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email'    => 'required|email|max:255',
            'password' => 'required',
        ]);

        

        try {
            $userEmail = $request->input('email');
            $userPassword = $request->input('password');

            echo "Email: " . $userEmail;
            echo "Password: " . $userPassword;

            $user = \App\User::where('email', $userEmail)->where('password', $userPassword)->first();
            echo $user;

            if (!$token = $this->jwt->attempt($request->only('email', 'password'))) {            
                return response()->json([$request->only('email', 'password'),
                $this->jwt->attempt($request->only('email', 'password')),'user_not_found'], 404);
            }            

        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], 500);

        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], 500);

        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent' => $e->getMessage()], 500);

        }

        return response()->json(compact('token', 'user'));
    }
}
