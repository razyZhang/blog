@extends('layouts.base_blog')

@section('title','Freakguys')

@section('content')
    <div id="welcome">
        <span class="glass"></span>
        <span class="title">HELLO</span>
        <span class="subtitle">Welcome to our personal</br>writing space</span>
    </div>
@endsection

@section('scripts')
<script type="text/javascript">
	window.onload = function(){
		$('#welcome').fadeIn(500);
	}
</script>
@endsection