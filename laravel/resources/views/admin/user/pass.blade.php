@extends('layouts.base')

@section('title','密码设置')

@section('head')

@endsection

@section('content')
<form class="password-box" id="passform" method="POST" action="{{ route('setpass') }}">
	{{ csrf_field() }}
	<div class="input-group">
	  <span class="input-group-addon">原密码:</span>
	  <input type="password" name='originPass' class="form-control original" aria-describedby="basic-addon1" placeholder="输入数字大小写字母下划线">
	</div>
	<div class="input-group">
	  <span class="input-group-addon">新密码:</span>
	  <input type="password" name='newPass' class="form-control new" aria-describedby="basic-addon1" placeholder="长度在4-20位之间">
	</div>
	<div class="input-group">
	  <span class="input-group-addon">确认新密码:</span>
	  <input type="password" class="form-control repeat" aria-describedby="basic-addon1" placeholder="再次输入新密码确认">
	</div>
	<div class="btn-group">
		<button type="button" class="submit">Submit</button>
	</div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
$(function(){
	var pattern = /^[A-Za-z0-9_]{4,20}$/;
	$('#passform').find('.form-control').each(function(){

		$(this).blur(function(){
			$(this).removeClass('pass');

			var value = $(this).val();
			if (!pattern.test(value)) {
				$(this).attr('style','border:1px solid #F0A2A2;box-shadow:0 0 4px #D16262');
			}else{
				$(this).addClass('pass');
			}

			if ($(this).hasClass('repeat')) {
				if (value != $('#passform').find('.new').val()) {
					$(this).removeClass('pass').attr('style','border:1px solid #F0A2A2;box-shadow:0 0 4px #D16262');
				}
			}

			if ($(this).hasClass('pass')) {
				$(this).attr('style','');
			}
		});
	});

	$('#passform').find('.submit').click(function(){
		var isPass = true;
		$('#passform').find('.form-control').each(function(){
			if (!$(this).hasClass('pass')) {
				isPass = false;
			}
		});
		if (isPass) {
			$('#passform').submit();
		}
	});
});
</script>
@endsection