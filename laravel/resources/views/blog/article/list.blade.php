@extends('layouts.base_blog')

@section('title','Freakguys')

@section('content')
    <div id="catalog" attr-index = 0 >
    	<div class="left-box" attr-show="0"></div>
    	<div class="main-box">
    		<div class="left-second-box">
    			<span class="toleft"></span>
    		</div>
    		<div class="middle-box" id="title-list">
    			@php $num = 0; @endphp
    			@foreach($list as $item)
    			<div class="title-box" attr-url='/blog/article/{{ $item->id }}'>
					<div class="show-box">
						@php 
						$time = $item->created_at;
						$time_arr = explode(" ",$time);
						$time = $time_arr[0];
						$time = str_replace("-"," ",$time);
						$num++;
						@endphp
						<span class="num">{{ $num }}</span>
						<span class="title">{{ $item->title }}</span>
						<span class="author">writed by {{ $item->author }}</span>
						<span class="time">{{ $time }}</span>					
					</div>
					<div class="hide-box">
						<div class="banner-box"><img src="{{ $item->banner }}"></div>
						<div class="abstract">{{ $item->abstract }}</div>
					</div>
				</div>
				@endforeach
    		</div>
    		<div class="right-second-box">
    			<span class="toright"></span>
    		</div>
    	</div>
    </div>
@endsection

@section('scripts')
<script type="text/javascript" src="{{ URL::asset('js/blog-list.js') }}"></script>
<script type="text/javascript">
	window.onload = function(){
		$('#catalog').find('.main-box').fadeIn(500);
	}
</script>
@endsection