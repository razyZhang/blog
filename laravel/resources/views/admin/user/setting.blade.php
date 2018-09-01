@extends('layouts.base')

@section('title','欢迎使用')

@section('head')

@endsection

@section('content')
<div class="key-box">
	<div class="input-group">
	  <span class="input-group-addon" id="get-key">邀请码</span>
	  <input type="text" class="form-control" value="{{ $code }}">
	</div>
</div>
@endsection