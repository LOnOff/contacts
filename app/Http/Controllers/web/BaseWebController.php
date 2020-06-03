<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BaseWebController extends Controller
{

    public function __construct()
    {

    }

    public function unexpected(\Exception $e)
    {
        return response()->json([
            'message' => $e->getMessage()
        ], 500);
    }

}
