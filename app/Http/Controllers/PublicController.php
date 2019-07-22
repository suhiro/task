<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DeviceLog;
use App\Device;

class PublicController extends Controller
{
    public function index()
	{

//		$data = DeviceLog::whereDate('start',now()->toDateString())->get();

//        $data = DeviceLog::whereDate('start',now()->toDateString())->get();
//        $data->load('device');
        $devices = Device::terminal()->get();
//        $devices->append('fullName');
//        $devices->each(function($device){
//           $device->fullName;
//        });

    	return view('public.index',compact('devices'));
    }
}
