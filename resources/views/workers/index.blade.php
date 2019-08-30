@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">Workers</div>

        <div class="card-body">
            <table class="table table-responsive">
                <thead>
                <tr><th>Name</th><th>Open Id</th><th>National ID</th><th>Worker ID</th></tr>
                </thead>
                <tbody>
                @forelse($workers as $worker)
                    <tr>
                        <td>{{$worker->name}}</td>
                        <td>{{$worker->wechat_openid}}</td>
                        <td>{{$worker->national_id}}</td>
                        <td>{{$worker->worker_id}}</td>
                    </tr>
                    @empty
                <tr><td>No workers yet</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection