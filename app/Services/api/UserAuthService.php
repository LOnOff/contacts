<?php

namespace App\Services\api;

use App\Models\User;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserAuthService
{

    public function signUpUser($r)
    {
        try {

            $_user   = User::create([
                'type_account'  => 'user',
                'email'         => $r->email,
                'tel_number'    => $r->tel_number,
                'password'      => bcrypt($r->password),
                'last_name'     => $r->last_name,
                'first_name'    => $r->first_name,
                'middle_name'   => $r->middle_name,
                'birth_date'    => $r->birth_date,
                'city'          => $r->city,
                'street'        => $r->street,
                'house'         => $r->house,
            ]);

            if(!Auth::attempt(['email' => $r->email, 'password' => $r->password])){
                return response()->json([
                    'message' => 'Unauthorized'
                ], 401);
            }

            $user = $r->user();
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->token;
            $token->expires_at = \Carbon\Carbon::now()->addWeeks(1);
            $token->save();

            return response()->json([
                'access_token' => $tokenResult->accessToken,
                'token_type'   => 'Bearer',
                'expires_at'   => Carbon::parse(
                    $tokenResult->token->expires_at
                )->toDateTimeString()
            ]);

        } catch (Exception $e) {
            return $this->unexpected($e);
        }

    }

    public function loginUser($r)
    {
        if(
            Auth::attempt([
                'type_account'  => 'user',
                'tel_number'    => $r->tel_number,
                'password'      => $r->password,
            ])
        ){
            $user               = Auth::user();
            $tokenResult        = $user->createToken('Personal Access Token');
            $token              = $tokenResult->token;
            $token->expires_at  = Carbon::now()->addWeeks(1);
            $token->save();

            return response()->json([
                'access_token'  => $tokenResult->accessToken,
                'token_type'    => 'Bearer',
                'expires_at'    => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString()
            ]);

        } else {
            return response()->json([
                'message' => 'User Unauthorized'
            ], 401);
        }
    }

    public function logoutUser($r)
    {
        $r->user()->token()->revoke();

        return response()->json([
            'message' => 'User successfully logged out'
        ]);
    }

}
