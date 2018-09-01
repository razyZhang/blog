@extends('layouts.base_box')

@section('content')
<div class="info-box" id='redirect' attr-url='{{ $redirecturl }}'>
	<img src="{{ $imgurl }}" width="120" height="120" align="center">
	<span class="info">{{ $info }}</span><br/><p><strong id="remain" style="font-size:18px">10</strong> 秒之后跳转</p></span>
</div>
@endsection

@section('script')
<script type="text/javascript">
	var remain_time = 5;
	function remain(){
		remain_time -= 1;
		document.getElementById('remain').innerHTML = remain_time;
		if (remain_time == 0) {
			var url = $('#redirect').attr('attr-url');
			location.href = url;
		}
		setTimeout("remain()",1000);
	}
	window.onload = remain();
</script>
@endsection