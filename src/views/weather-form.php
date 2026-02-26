<?php

// @todo: Fetch the weather data so we can loop over it and render it.
$post_type = new Weather\Post_Type();
$posts = $post_type->query( [ 'posts_per_page' => 10 ] );

$current_weather = Weather\Current_Weather::get();
?>
<div class="current-weather">
	<h2>Current Weather in Monowi, Nebraska</h2>
	<?php if ( ! empty( $current_weather->properties->periods ) ) : ?>
		<h3><?php echo esc_html( $current_weather->properties->periods[0]->name ); ?></h3>
		<p><?php echo esc_html( $current_weather->properties->periods[0]->detailedForecast ); ?></p>
		<h3><?php echo esc_html( $current_weather->properties->periods[1]->name ); ?></h3>
		<p><?php echo esc_html( $current_weather->properties->periods[1]->detailedForecast ); ?></p>
	<?php else : ?>
		<p>Weather data unavailable.</p>
	<?php endif; ?>
</div>
<hr />
<form action="/weather" method="post" class="weather-form">
	<label for="location">Location</label>
	<input type="text" name="location" id="location" value="" required />
	<label for="date">Date</label>
	<input type="date" name="date" id="date" value="" required />
	<label for="weather">Weather</label>
	<select name="weather" id="weather" required>
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
<hr />
<h3>Recent Submissions</h3>
<ul class="weather-list">
	<?php foreach ( $posts as $post ) : 
		$date     = get_post_meta( $post->ID, 'date', true );
		$location = get_post_meta( $post->ID, 'location', true );
		$weather  = get_post_meta( $post->ID, 'weather', true );
	?>
		<li><?php echo esc_html( sprintf( '%s (%s): %s', $location, $date, $weather ) ); ?></li>
	<?php endforeach; ?>
</ul>