<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DeviceLog;

class PublicController extends Controller
{
    public function index()
	{

		$data = DeviceLog::all();
		
    	return view('public.index',compact('data'));
    }
}
