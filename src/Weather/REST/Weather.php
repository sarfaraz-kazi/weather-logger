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
		\register_rest_route( 'weather/v1', '/save', [
			'methods'             => 'POST',
			'callback'            => [ $this, 'save' ],
			'permission_callback' => function () {
				return \current_user_can( 'edit_posts' );
			},
		] );

		\register_rest_route( 'weather/v1', '/get', [
			'methods'             => 'GET',
			'callback'            => [ $this, 'fetch' ],
			'permission_callback' => '__return_true',
		] );

		\register_rest_route( 'weather/v1', '/group', [
			'methods'             => 'GET',
			'callback'            => [ $this, 'group' ],
			'permission_callback' => '__return_true',
		] );
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
		$params = $request->get_params();
		$post_type = new \Weather\Post_Type();
		
		$posts = $post_type->query( [
			'date_from' => $params['date_from'] ?? '',
			'date_to'   => $params['date_to'] ?? '',
			'location'  => $params['location'] ?? '',
			'page'      => $params['page'] ?? 1,
			'posts_per_page' => $params['per_page'] ?? 10,
		] );

		$data = [];

		foreach ( $posts as $post ) {
			$data[] = [
				'date'     => \get_post_meta( $post->ID, 'date', true ),
				'location' => \get_post_meta( $post->ID, 'location', true ),
				'weather'  => \get_post_meta( $post->ID, 'weather', true ),
			];
		}

		return new WP_REST_Response( [ 'dates' => $data ] );
	}

	/**
	 * Group weather data.
	 *
	 * @since 1.0.0
	 *
	 * @param WP_REST_Request $request
	 *
	 * @return WP_REST_Response
	 */
	public function group( WP_REST_Request $request ) {
		// For now, group by date as a simple implementation
		// This can be extended based on specific grouping requirements
		$params = $request->get_params();
		$post_type = new \Weather\Post_Type();
		
		$posts = $post_type->query( [
			'posts_per_page' => -1, // Get all for grouping
		] );

		$grouped = [];
		foreach ( $posts as $post ) {
			$date = \get_post_meta( $post->ID, 'date', true );
			if ( ! isset( $grouped[ $date ] ) ) {
				$grouped[ $date ] = [];
			}
			$grouped[ $date ][] = [
				'location' => \get_post_meta( $post->ID, 'location', true ),
				'weather'  => \get_post_meta( $post->ID, 'weather', true ),
			];
		}

		return new WP_REST_Response( $grouped );
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
		$params = $request->get_params();

		// Basic validation
		if ( empty( $params['date'] ) || empty( $params['location'] ) || empty( $params['weather'] ) ) {
			return new WP_REST_Response( [
				'message' => 'Missing required fields: date, location, weather.',
			], 400 );
		}

		$post_type = new \Weather\Post_Type();
		$post_id   = $post_type->insert( [
			'date'     => \sanitize_text_field( $params['date'] ),
			'location' => \sanitize_text_field( $params['location'] ),
			'weather'  => \sanitize_text_field( $params['weather'] ),
		] );

		if ( ! $post_id ) {
			return new WP_REST_Response( [
				'message' => 'Failed to save weather data.',
			], 500 );
		}

		return new WP_REST_Response( [
			'data' => [
				'date'     => $params['date'],
				'location' => $params['location'],
				'weather'  => $params['weather'],
			],
			'message' => 'Entry added!',
		] );
	}
}
