<?php

namespace App\Services;
use App\Models\User;

class VerificationService
{

    public static function isAdmin($r){
        $_u = User::where('id',$r->user()->id)->where('type_account','admin')->first();
        return isset($_u);
    }

}
