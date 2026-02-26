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
		$plugin_url = \plugin_dir_url( WEATHER_FILE );
		\wp_register_style( 'current-weather', $plugin_url . 'src/assets/css/current-weather.css' );
		\wp_register_style( 'weather-style', $plugin_url . 'src/assets/css/style.css' );

		\wp_register_script( 'weather-script', $plugin_url . 'src/assets/js/weather.js', ['jquery'], '1.0.0', true );
		
		\wp_register_script( 'weather-blocks', $plugin_url . 'src/assets/js/blocks.js', ['wp-blocks', 'wp-element', 'wp-server-side-render'], '1.0.0', true );

		\wp_localize_script( 'weather-script', 'weather', [
			'saveWeatherEndpoint' => \rest_url( 'weather/v1/save' ),
			'getWeatherEndpoint'  => \rest_url( 'weather/v1/get' ),
			'nonce'               => \wp_create_nonce( 'wp_rest' ),
		] );

		return $this;
	}

	function enqueue_weather_css() {
		\add_action( 'wp_enqueue_scripts', function() {
			\wp_enqueue_style( 'current-weather' );
			\wp_enqueue_style( 'weather-style' );
			\wp_enqueue_script( 'weather-script' );
		} );

		return $this;
	}
}
