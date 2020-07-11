<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($result)
    {
    	$response = [
            'success' => true,
            'content'    => $result,
            'message' => 'Operation successful',
        ];

        return response()->json($response, 200);
    }


    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error)
    {
    	$response = [
            'success' => false,           
            'message' => $error,
        ];

        return response()->json($response, 500);
    }
}
