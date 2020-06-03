<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{

    protected $fillable = [
        "id",
        "u_id",
        'tel_number',
        'last_name',
        'first_name',
        'middle_name',
    ];

    public function getUser(){
        return $this->belongsTo ('App\Models\User','u_id','id');
    }

}
