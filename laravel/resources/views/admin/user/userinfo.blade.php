@extends('layouts.base')

@section('title','个人信息')

@section('head')

@endsection

@section('content')
<form class="userinfo" id="userform" method="POST" action="{{ route('setinfo') }}" enctype="multipart/form-data">
	<div class="baseinfo">
		<div class="avatar-box">
			<div class="img-box">
				<img id="image" src="{{ $user['avatar']}}">
				<input type="file"  name='avatar' id="imgsrc" hidden="hidden" style="display:none">
			</div>
		</div>
		<div class="info-box">
			{{ csrf_field() }}
			<div class="input-box">
				<input type="text" name="nickname" placeholder="nickname" value="{{ $user['nickname']}}">
			</div>
			<div class="input-box">
				<input type="text" name="email" placeholder="email" value="{{ $user['email']}}">
			</div>
			<div class="input-box">
				<input type="text" name="intro" placeholder="intro" value="{{ $user['intro']}}">
			</div>
		</div>
	</div>
	<div class='extrainfo'>
		<div class="about-box">
			<div class="input-box">
				<input type="text" name="label" placeholder="label" value="{{ $user['label']}}">
			</div>
			<div class="area-box">
				<textarea name="experience" placeholder="write down your experience" value="{{ $user['experience']}}"></textarea>
			</div>
		</div>
	</div>
	<div class="btn-box">
		<button class="submit">Submit</button>
	</div>
</form>
@endsection

@section('scripts')
<script type="text/javascript">
$(function(){
	$("#imgsrc").change(function(){
		var choose_image = document.getElementById("imgsrc").files[0];
		var URL = window.URL || window.webkitURL;
		var local_url = URL.createObjectURL(choose_image);
		$('#image').attr('src',local_url);
	});

	$('#image').click(function(){
		$(this).next().click();
	});
});
</script>
@endsection