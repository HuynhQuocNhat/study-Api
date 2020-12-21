<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Resources\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends BaseController
{
    public function register(Request $request)
    {

    }

    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        if(!Auth::attempt($credentials))
            return $this->sendError(['Account of email '.$credentials['email'].' not exit'], 401);

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Client');
        $token = $tokenResult->token;
        $token->save();

        return response()->json([
            'access token' => $tokenResult->accessToken,
            'token' => $token,
            'token type' => 'Bearer',
            'Expire' => Carbon::parse(
                $token->expires_at
            )->toDateTimeString()
        ], 200);
    }

    public function logout (Request $request)
    {
        $request->user()->token()->revoke();
        return $this->sendReponse([],'Logout success');
    }

    public function checkMe()
    {
        $user = Auth::user();
        if(!empty($user))
            return response(new User($user), 200);
        return $this->sendError(['User not exit'], 401);
    }
}
