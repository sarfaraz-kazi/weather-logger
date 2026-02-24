<?php
/**
 * Plugin Name: Handy Dandy Weather Logger
 * Plugin URI: https://github.com/the-events-calendar/backend-trial-project
 * Description: Provide a page for authenticated users to log weather for the day.
 * Version: 1.0.0
 * Author: Your Name
 * Author URI: https://example.com
 * Text Domain: weather
 * Namespace: Weather
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'WEATHER_FILE', __FILE__ );

require_once __DIR__ . '/vendor/autoload.php';

// @todo: Perhaps this class shouldn't be initialized at this moment. Maybe an action is better?
Weather\Plugin::instance();