<?php
/**
 * This registers REST endpoints and handles REST requests for weather.
 *
 * @since 1.0.0
 *
 * @package Weather
 */
namespace Weather\REST;

use WP_REST_Request;
use WP_REST_Response;

/**
 * Weather routing.
 *
 * @since 1.0.0
 *
 * @todo: Create a GET /wp-json/weather/v1/get endpoint that fetches weather for submitted dates. (see /requirements/rest-api.md)
 * @todo: Create a GET /wp-json/weather/v1/group endpoint that fetches grouped weather data. (see /requirements/rest-api.md)
 * @todo: Create a POST /wp-json/weather/v1/save endpoint that accepts a submission and creates a post with that data. (see /requirements/rest-api.md)
 * @todo: Maybe keep the business logic isolated from the REST handling.
 * @todo: Maybe prevent duplicate entries for a location/date combination. (update is better than rejecting)
 * @todo: Make sure only authenticated users can submit entries.
 */
class Weather implements Contracts\REST_Interface {
	/**
	 * Register REST routes.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function register() {
		// @todo register routes
	}

	/**
	 * Fetch weather data.
	 *
	 * @since 1.0.0
	 *
	 * @param WP_REST_Request $request
	 *
	 * @return WP_REST_Response
	 */
	public function fetch( WP_REST_Request $request ) {
		// @todo: fetch weather data.
		$weather_posts = []; // Change to fetch posts.

		$data = [];

		foreach ( $weather_posts as $post ) {
			// @todo: set these variables.
			$date     = '';
			$location = '';
			$weather  = '';

			$data[] = [
				'date'     => $date,
				'location' => $location,
				'weather'  => $weather,
			];
		}

		// If successful:
		// @todo: response should be JSON in the following format:
		$response = new WP_REST_Response( $data );

		// @todo: Handle if the save was not successful and return 'message' rather than an array of 'date' and 'weather' pairs.

		return $response;
	}

	/**
	 * Save weather data.
	 *
	 * @since 1.0.0
	 *
	 * @param WP_REST_Request $request
	 *
	 * @return WP_REST_Response
	 */
	public function save( WP_REST_Request $request ) {
		// @todo: save the data.
		// @todo: Make the title a concatenation of the location and the date.

		// @todo: set these variables.
		$date     = '';
		$location = '';
		$weather  = '';

		// If successful:
		// @todo: response should be JSON in the following format:
		$response = new WP_REST_Response(
			[
				'date'     => $date,
				'location' => $location,
				'weather'  => $weather,
			]
		);

		// @todo: Handle if the save was not successful and return 'message' rather than 'date' and 'weather'.

		return $response;
	}
}
