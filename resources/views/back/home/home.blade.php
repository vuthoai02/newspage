@extends('back.template.master')
@section('title', 'Chào mừng bạn đến với website');
@section('heading', 'Chào mừng bạn đến với website');
@if(session('loggedInUser'))
    @section('loggedInUser', session('loggedInUser')->username);
@endif


@section('content')
<p>
    <img src="{{url('/dist/img/images')}}" alt="Web Admin">
</p>
@stop