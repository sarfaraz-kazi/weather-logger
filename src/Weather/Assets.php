<?php
/**
 * Defines and enqueues the assets and localized JS variables.
 *
 * @since 1.0.0
 *
 * @package Weather
 */
namespace Weather;

/**
 * Assets class.
 *
 * @since 1.0.0
 */
class Assets {
	// @todo: register and enqueue assets
	// @todo: localize JS variables. The JS requires the following JS variables to be set:
	// - weather.saveWeatherEndpoint
	// - weather.getWeatherEndpoint

	function register_weather_css() {
		$url = preg_replace( '!(://[^/]+).*!', '\1', $_SERVER['REQUEST_URI'] );
		wp_register_style( 'current-weather', $url . '/wp-content/plugins/backend-trial-project/src/assets/css/current-weather.css' );

		return $this;
	}

	function enqueue_weather_css() {
		add_action( 'wp_enqueue_scripts', function() {
			wp_enqueue_style( 'current-weather' );
		} );

		return $this;
	}
}
