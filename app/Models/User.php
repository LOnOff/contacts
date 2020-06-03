<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use phpDocumentor\Reflection\Types\This;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    protected $fillable = [
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
        'house',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getContacts()
    {
        return $this->hasMany('App\Models\Contact');
    }

    public static function isAdmin($u_id){
       $_u = User::where('id',$u_id)->where('type_account','admin')->first();
       return isset($_u);
    }
}
