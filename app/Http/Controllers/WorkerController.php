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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
