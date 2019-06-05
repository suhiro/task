@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">Dashboard</div>

    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <dl class="row">
          <dt class="col-sm-3">Account</dt>
          <dd class="col-sm-9">{{$account->name}}</dd>

          <dt class="col-sm-3">dsid</dt>
          <dd class="col-sm-9">
            {{ $account->dsid }}
          </dd>

        </dl>
    </div>
</div>

@endsection
