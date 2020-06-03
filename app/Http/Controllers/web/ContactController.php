<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\web\BaseWebController;
use App\Services\web\ContactService;

use Illuminate\Http\Request;
use App\Http\Requests\Contact\web\AddContactRequest;
use App\Http\Requests\Contact\web\DeleteContactRequest;
use App\Http\Requests\Contact\web\EditContactRequest;

class ContactController extends BaseWebController
{

    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

    public function index()
    {
        return view('block.contacts');
    }

    public function getContacts(Request $r){
        try {
            return app(ContactService::class)->getcontacts($r);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function editContact(EditContactRequest $r){
        try {
            return app(ContactService::class)->editContact($r);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function addContact(AddContactRequest $r){
        try {
            return app(ContactService::class)->addContact($r);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function deleteContact(DeleteContactRequest $r){
        try {
            return app(ContactService::class)->deleteContact($r);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

}
