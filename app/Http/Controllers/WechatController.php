<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WechatController extends Controller
{
    public function login(Request $request)
    {
    	$login_code = $request->login_code;
    	return $request->all();
    }
}
