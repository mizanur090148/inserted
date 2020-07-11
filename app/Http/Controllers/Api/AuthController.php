<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Http\Controllers\Api\ApiCrudHandler;
use Illuminate\Http\Request;
use App\User;
use Validator;
use Auth;

class AuthController extends BaseController
{   

    public function login(Request $request)
    {
        try {
            $credential = [
                'email' => $request->email, 
                'password' => $request->password
            ];

            if (auth()->attempt($credential)) {
                $user = Auth::user();
                $data['token'] = $this->getUserToken($user, "TestToken");

                return $this->sendResponse($data);
                //return response(['user' => $user, 'access_token' => $this->getUserToken($user, "TestToken")]);
            }
        } catch (Exception $e) {
            
        }

        return $this->apiResposeHandler->returnResponse(
            $this->apiResposeHandler->error,
            'Unauthorized Access'
        );
    }

    public function getUserToken($user, string $token_name = null ) 
    {
        return $user->createToken($token_name)->accessToken; 
    }
}
