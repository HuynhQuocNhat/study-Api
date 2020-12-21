<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function sendReponse($result, $message)
    {
        $response = [
            'success' => true,
            'data' => $result,
            'message' => $message,
        ];

        return response()->json($response, 200);
    }

    public function sendError($errorMessage = [], $code = 200)
    {
        $response = [
            'status' => false,
            'message data' => empty($errorMessage) ? [] : $errorMessage,
        ];

        return response()->json($response, 200);
    }
}
