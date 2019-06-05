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

        @if(count($devices))
        <ul>
        	@foreach($devices as $device)
        	<li>
        		{{ $device->name }} ({{ $device->dsid }})
        		@if($device->children)
        			<ul>
        				@foreach($device->children as $child)
        					<li>
        						{{ $child->name }} ({{ $child->dsid }})
        					</li>
        				@endforeach
        			</ul>
        		@endif
        	</li>

        	@endforeach

        </ul>
        @endif

        <a href="{{ route('device.sync') }}" class="btn btn-primary">Sync Devices</a>
    </div>
</div>

@endsection
