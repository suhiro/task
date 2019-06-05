<?php

namespace App\Http\Controllers;

use App\Account;
use App\Device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{

    public function index()
    {
        $account = Account::first();
        $devices = $account->devices;
        return view('device.index',compact('devices'));
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show(Device $device)
    {
        //
    }


    public function edit(Device $device)
    {
        //
    }


    public function update(Request $request, Device $device)
    {
        //
    }


    public function destroy(Device $device)
    {
        //
    }

    public function sync()
    {
        Device::syncDevices();
        return $this->index();
    }
}
