<div class="card">
	<div class="weather-box">
		<span class="icon"></span>
		<span class="temp">{{ $weather['temp'] }}<em>°C</em></span>
		<span class="weather">{{ $weather['weather'] }}</span>
		<span class="wind">{{ $weather['wind'] }}</span>
		<span class="wet">湿度{{ $weather['wet'] }}%</span>
	</div>
	<div class="location-box">
		<span class="icon"></span>
		<span class="address">{{ $weather['address'] }}</span>
	</div>
</div>