@extends('layouts.base')

@section('title','欢迎使用')

@section('head')

@endsection

@section('content')
	@include('admin.plugs.weather')
	@include('admin.plugs.date')
@endsection