<?php

namespace App\Http\Controllers\api_v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BaseApiController extends Controller
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
