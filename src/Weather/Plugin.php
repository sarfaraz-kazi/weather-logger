<?php
/**
 * This is the main plugin class that bootstraps everything.
 *
 * @since 1.0.0
 *
 * @package Weather
 */
namespace Weather;

/**
 * Bootstrap class.
 *
 * @since 1.0.0
 *
 * @todo Handle the routing of REST requests using the REST\Weather class.
 * @todo Create an object structure for managing assets and enqueueing them. (src/assets/js/weather.js and src/assets/css/style.css)
 * @todo Create an object structure for the business logic of storing weather data as a post.
 * @todo Create an endpoint called "/weather" in Endpoints/ directory.
 */
class Plugin {
	/**
	 * @var Plugin
	 */
	public static $instance;

	/**
	 * Returns the singleton instance of the plugin.
	 *
	 * @since 1.0.0
	 *
	 * @return Plugin
	 */
	public static function instance() {
		if ( ! isset( static::$instance ) ) {
			static::$instance = new static();
		}

		return static::$instance;
	}

	/**
	 * Plugin constructor.
	 *
	 * @since 1.0.0
	 */
	function __construct() {
		(new Assets())
			->register_weather_css()
			->enqueue_weather_css();
	}
}
