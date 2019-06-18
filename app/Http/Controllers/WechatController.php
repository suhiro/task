<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WechatController extends Controller
{
    public function login(Request $request)
    {
    	return 'wechat login';
    	$login_code = $request->login_code;
    	return $request->all();
    }
}
