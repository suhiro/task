<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DeviceLog;

class PublicController extends Controller
{
    public function index()
	{

//		$data = DeviceLog::whereDate('start',now()->toDateString())->get();

        $data = DeviceLog::whereDate('start',now()->toDateString())->get();
        $data->load('device');

    	return view('public.index',compact('data'));
    }
}
