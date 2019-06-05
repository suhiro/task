@extends('layouts.app')
@section('content')

<chart-component :data='@json($data)'></chart-component>
@json($data)
@endsection





