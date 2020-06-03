<?php

namespace App\Services\web;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use App\Models\User;

use Yajra\DataTables\DataTables;

class UserService
{

    public function getUsers(){
        $users = User::select(
            'id',
            'type_account',
            'email',
            'tel_number',
            'password',
            'last_name',
            'first_name',
            'middle_name',
            'birth_date',
            'city',
            'street',
            'house');
        return Datatables::of($users)->make(true);
    }

    public function editUser($r){
        $_u = User::find($r->id);
        $_u->type_account    = $r->type_account;
        $_u->email           = $r->email;
        $_u->tel_number      = $r->tel_number;
        $_u->last_name       = $r->last_name;
        $_u->first_name      = $r->first_name;
        $_u->middle_name     = $r->middle_name;
        $_u->birth_date      = $r->birth_date;
        $_u->city            = $r->city;
        $_u->street          = $r->street;
        $_u->house           = $r->house;
        $_u->save();
    }

    public function addUser($r){
        $password = Hash::make(Str::random(12));
        $_u = new User();
        $_u->type_account    = $r->type_account;
        $_u->email           = $r->email;
        $_u->tel_number      = $r->tel_number;
        $_u->password        = $password;
        $_u->last_name       = $r->last_name;
        $_u->first_name      = $r->first_name;
        $_u->middle_name     = $r->middle_name;
        $_u->birth_date      = $r->birth_date;
        $_u->city            = $r->city;
        $_u->street          = $r->street;
        $_u->house           = $r->house;
        $_u->save();
    }

    public function deleteUser($r){
        $_u = User::find($r->id);
        $_u->delete();
    }

}
