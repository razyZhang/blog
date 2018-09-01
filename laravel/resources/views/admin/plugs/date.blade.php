<div class="card">
	<div class="date-box">
		<img src="{{ url('img/front/clock.png') }}" align="center" width="30" height="30">
		<span class="time"><em class="q">{{ $date['q'] }}</em><em class="t">{{ $date['t'] }}</em><em class="a">{{ $date['a'] }}</em></span>
		<span class="date"><em class="m">{{ $date['m'] }}</em><em class="d">{{ $date['d'] }}</em><em class="y">{{ $date['y'] }}</em></span>
	</div>
	@if($date['cn'])
	<div class="cn-box">
		<span class="cndate">{{ $date['cn']['date'] }}</span>
		<span class="cnjq">
		@foreach ($date['cn']['jq'] as $jq)
			<em class="jq">{{ $jq }}</em>
		@endforeach
		</span>
	</div>
	@endif
</div>