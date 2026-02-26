<?php
/**
 * Fetches the current weather and renders it.
 *
 * @since 1.0.0
 *
 * @package Weather
 */
namespace Weather;

/**
 * Weather fetcher class.
 *
 * @since 1.0.0
 */
class Current_Weather {
	static function get() {
		$url = "https://api.weather.gov/gridpoints/TOP/31,80/forecast";

		// create a new cURL resource
		$ch = curl_init();

		// set URL and other appropriate options
		curl_setopt( $ch, CURLOPT_URL, $url );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

		// grab URL and pass it to the browser
		$json_data = curl_exec( $ch );

		// close cURL resource, and free up system resources
		curl_close($ch);

		return json_decode( $json_data );
	}
}
