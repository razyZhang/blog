@extends('layouts.base_blog')

@section('title','Freakguys')

@section('content')
    <div id="about">
        <div class="about-members-box">
        @foreach($about_members as $member)

        	<div class="member-info-box">
        		<div class="top-box">
        			<div class="avatar-box">
        				<img src="{{ $member->avatar }}">
        			</div>
        			<div class="name-box">
        				<span class="name">{{ $member->nickname != null ? $member->nickname : $member->name }}</span>
        				<span class="label">{{ $member->label }}</span>
        			</div>
        		</div>
        		<div class="experience">{{ $member->experience }}</div>
        	</div>
        @endforeach
        </div>
        <div class="about-info-box"></div>
    </div>
@endsection

@section('scripts')
<script type="text/javascript">
	window.onload = function(){
		$('#about').fadeIn(500);
	}
</script>
@endsection