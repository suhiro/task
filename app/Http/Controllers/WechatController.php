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
    public function get_login()
    {
        
        // return request()->all();

        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'https://api.weixin.qq.com/sns/jscode2session?',
            [
                'query' => [
                    'appid' => env('WECHAT_APP_ID'),
                    'secret'=> env('WECHAT_SECRET'),
                    'grant_type' => 'grant_type',
                    'js_code' => request()->login_code,
                ],
            ]);
        if($response->getStatusCode() == 200){
            
        }
        return $response->getBody();
        $res = json_decode($response->getBody());
    }
}
