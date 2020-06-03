<?php

namespace App\Services\web;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use App\Models\Contact;

use Yajra\DataTables\DataTables;

class ContactService
{

    public function getContacts(){
        $contacts = Contact::select(
            'id',
            'tel_number',
            'last_name',
            'first_name',
            'middle_name');
        return Datatables::of($contacts)->make(true);
    }

    public function editContact($r){
        $_o = Contact::find($r->id);
        $_o->u_id           = $r->user()->id;
        $_o->tel_number     = $r->tel_number;
        $_o->last_name      = $r->last_name;
        $_o->first_name     = $r->first_name;
        $_o->middle_name    = $r->middle_name;
        $_o->save();
    }

    public function addContact($r){
        $_o = new Contact();
        $_o->u_id           = $r->user()->id;
        $_o->tel_number     = $r->tel_number;
        $_o->last_name      = $r->last_name;
        $_o->first_name     = $r->first_name;
        $_o->middle_name    = $r->middle_name;
        $_o->save();
    }

    public function deleteContact($r){
        $_o = Contact::find($r->id);
        $_o->delete();
    }

}
