<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Worker;
use App\Factory;

class WorkerController extends Controller
{
    public function index()
    {

        $workers = Worker::get();
        return view('workers.index',compact('workers'));
    }

    public function create()
    {
        $factories = Factory::get();
        return view('workers.create',compact('factories'));
    }


    public function store(Request $request)
    {
        $validatedDate = $request->validate([
            'factory_id' => 'required|numeric',
            'name' => 'required|max:255',
            'national_id' => 'required|max:64',
            'wechat_openid' => 'required|max:255',
        ]);
        Worker::create([
            'factory_id' => $request->factory_id,
            'name' => $request->name,
            'national_id' => $request->national_id,
            'wechat_openid' => $request->wechat_openid,
        ]);
        return redirect('workers');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
