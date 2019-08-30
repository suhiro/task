@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">Create worker</div>

        <div class="card-body">
            @include('layouts.errors')
            <form method="post" action="{{route('workers.store')}}">
                @csrf
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" value="{{old('name','')}}" class="form-control" placeholder="Worker name">
                        </div>


                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label>ID</label>
                            <input type="text" name="worker_id" value="{{old('worker_id','')}}" class="form-control" placeholder="Worker ID assigned by factory">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label>Wechat id</label>
                            <input type="text" name="wechat_openid" value="{{old('wechat_openid','')}}" class="form-control" placeholder="Worker wechat open id">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label>Factory</label>
                            <select class="custom-select" name="factory_id" placeholder="Factory">
                                @foreach($factories as $factory)
                                <option value="{{$factory->id}}">{{$factory->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="form-group">
                            <label>身份证号</label>
                            <input type="text" name="national_id" value="{{old('national_id','')}}" class="form-control" placeholder="Worker government Id">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection