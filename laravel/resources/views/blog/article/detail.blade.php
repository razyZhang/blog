@extends('layouts.base_blog')

@section('title','Freakguys')

@section('content')
    <div id="catalog" attr-index = 0 >
    	<div class="left-box" attr-show="0"></div>
    	<div class="main-box">
    		<div class="left-second-box">
    			<span class="toleft"></span>
    		</div>
    		<div class="middle-box" id="detail">
    			<div class="detail-title">{{ $article_info->title }}</div>
    			<div class="detail-box">
    				<span class="detail-time">{{ $article_info->created_at }}</span>
    				<span class="detail-author">write by {{ $article_info->author }}</span>
    			</div>
    			<div class="detail-banner">
    				<img src="{{ $article_info->banner }}">
    			</div>
    			<div class="detail-abstract">{{ $article_info->abstract }}</div>
    			<div class="detail-content">{!! $article_content !!}</div>
    		</div>
<!--     		<div class="right-second-box">
    			<span class="toright"></span>
    		</div> -->
    	</div>
    </div>
@endsection

@section('scripts')
<script type="text/javascript" src="{{ URL::asset('js/blog-list.js') }}"></script>
<script type="text/javascript">
	window.onload = function(){
		$('#catalog').find('.main-box').fadeIn(500);
	}

	$('#catalog').find('.toleft').click(function(){
		$('#catalog').find('.main-box').fadeOut(500,function(){
			location.href = "{{ route('blog.catalog') }}";
		});
	});
</script>
@endsection