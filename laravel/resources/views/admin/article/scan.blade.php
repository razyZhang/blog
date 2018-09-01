@extends('layouts.base')

@section('title','预览文章')

@section('content')
<div class="scan-left">
	<h3 class="title">{{ $scandata->title }}</h3>
	<div class="window">
		<img src="{{ $scandata->banner }}">
	</div>
	<div class="abstract">{{ $scandata->abstract }}</div>
</div>
<div class="scan-right">
	<div class="window">
		<div class="content">@php echo $content @endphp</div>
	</div>
</div>
@endsection