<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\web\BaseWebController;
use Yajra\DataTables\DataTables;

use App\Models\User;
use App\Services\web\UserService;

use Illuminate\Http\Request;
use App\Http\Requests\User\web\AddUserRequest;
use App\Http\Requests\User\web\DeleteUserRequest;
use App\Http\Requests\User\web\EditUserRequest;

class UserController extends BaseWebController
{

    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

    public function index()
    {
        return view('block.users');
    }

    public function getUsers(Request $r){
        try {
            return app(UserService::class)->getUsers($r);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function editUser(EditUserRequest $r){
        try {
            return app(UserService::class)->editUser($r);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function addUser(AddUserRequest $r){
        try {
            return app(UserService::class)->addUser($r);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function deleteUser(DeleteUserRequest $r){
        try {
            return app(UserService::class)->deleteUser($r);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }







}
