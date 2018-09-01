@extends('layouts.base_box')

@section('content')
	<form id="loginform" class="type-box" action="{{ $url }}" method="POST" autocomplete="on" enctype="multipart/form-data">
  		{{ csrf_field() }}
  		<input type="file" name="file">
  		<input type="submit">
  	</form>
@endsection