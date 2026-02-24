<?php

// @todo: This is a basic structure. There are probably flaws here. Make it better (and functional).

// @todo: Fetch the weather data so we can loop over it and render it.
$weather_data = []; // This needs to change so it holds an array of posts.

$current_weather = Weather\Current_Weather::get();
?>
<div class="current-weather">
	<h2>Current Weather in Monowi, Nebraska</h2>
	<h3><?php echo $current_weather->properties->periods[0]->name; ?></h3>
	<p><?php echo $current_weather->properties->periods[0]->detailedForecast; ?></p>
	<h3><?php echo $current_weather->properties->periods[1]->name; ?></h3>
	<p><?php echo $current_weather->properties->periods[1]->detailedForecast; ?></p>
</div>
<hr />
<form action="/weather" method="post" class="weather-form">
	<label for="location">Location</label>
	<input type="text" name="location" id="location" value="" />
	<label for="date">Date</label>
	<input type="date" name="date" id="date" value="" />
	<label for="weather">Weather</label>
	<select name="weather" id="weather">
		<option value="">Select the weather...</option>
		<option value="hail">Hail</option>
		<option value="hurricane">Hurricane</option>
		<option value="overcast">Overcast</option>
		<option value="rain">Rain</option>
		<option value="snow">Snow</option>
		<option value="sunny">Sunny</option>
		<option value="thunderstorm">Thunderstorm</option>
		<option value="tornado">Tornado</option>
	</select>
	<button type="submit" class="weather-button">Submit</button>
	<div class="weather-form__message"></div>
</form>