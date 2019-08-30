<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Worker;
use App\Workerlog;

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
        if($res->session_key){
            $worker = Woker::where('wechat_openid',$res->openid)->first();
            if($worker){
//                        retrieve factory_name from db factories table with factory_id;
//                    retrieve device list from devices table with factory_id;
//
//                    check if there are records of shift_logs;
//                    if(exist){//微信用户已经有扫码上机的记录
//                        return success with json data {"opeinid": , "factory_id": , "factory_name"：, "device_id": , ”device_name“, "checkin_time": };
//                    }else{//微信用户没有扫码上任何机器
//                        return success with json data {"opeinid": , "factory_id": , "factory_name"：};
//                    }
            } else {
                return [
                    'success' => false,
                    'status' => 'error',
                    'message' => '当前微信用户尚未注册到任何工厂，请先联系人事部门注册',
                ];
            }
        } else {
            return $res;
        }

    }
}
