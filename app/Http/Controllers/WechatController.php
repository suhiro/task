<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Worker;
use App\ShiftLog;
use App\WechatSession;

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
        Log::info('Someone trying to login via wechat');
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
        Log::info($response->getBody());
        $res = json_decode($response->getBody());

        if($res->session_key){
            $worker = Worker::where('wechat_openid',$res->openid)->first();
            if($worker){
                WechatSession::create([
                    'session_key' => $res->session_key,
                    'wechat_openid' => $res->openid,
                ]);

//                        retrieve factory_name from db factories table with factory_id;
//                    retrieve device list from devices table with factory_id;
                $devices = $worker->factory->devices;


//
//                    check if there are records of shift_logs;
                $currentShift = ShiftLog::where('wechat_openid',$res->openid)->where('end',null)->first();
                if($currentShift){
                    $data = [
                        'on_shift' => true,
                      'open_id' => $currentShift->wechat_openid,
                      'factory_id' => $worker->factory_id,
                      'factory_name' => $worker->factory->name,
                        'device_id' => $currentShift->dsid,
                        'device_name' => $currentShift->device->name,
                        'check_in' => $currentShift->start,
                        'session_key' => $res->session_key,
                    ];
                    Log::info(json_encode($data));
                    return $data;
                } else {
                    $data = [
                        'on_shift' => false,
                        'open_id' => $res->openid,
                        'factory_id' => $worker->factory_id,
                        'factory_name' => $worker->factory->name,
                        'session_key' => $res->session_key,
                    ];
                Log::info(json_encode($data));
                return $data;
                }

//                    if(exist){//微信用户已经有扫码上机的记录
//                        return success with json data {"opeinid": , "factory_id": , "factory_name"：, "device_id": , ”device_name“, "checkin_time": };
//                    }else{//微信用户没有扫码上任何机器
//                        return success with json data {"opeinid": , "factory_id": , "factory_name"：};
//                    }
                $data = [
                    'session_key' => $res->session_key,
                    'factory_id' => $worker->factory_id,
                    'factory_name' => $worker->factory->name,
                    'device_id' => null,
                    'device_name' => null,
                    'devices' => $devices,
                    'session_key' => $res->session_key,
                ];
                Log::info(json_encode($data));
                return [
                    'success' => true,
                    'data' => $data,
                    'message' => 'success',

                ];
            } else {
                return [
                    'success' => false,
                    'status' => 'error',
                    'message' => '当前微信用户尚未注册到任何工厂，请先联系人事部门注册',
                    'session_key' => $res->session_key,
                ];
            }
        } else {
            return $response->getBody();
        }

    }
}
