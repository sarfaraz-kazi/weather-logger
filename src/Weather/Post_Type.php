<?php
/**
 * This defines the post type to store weather information.
 *
 * @since 1.0.0
 *
 * @package Weather
 */
namespace Weather;

/**
 * Post Type class.
 *
 * @since 1.0.0
 */
class Post_Type {
	/**
	 * Registers the post type.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function register() {
		// @todo register post type
	}

	/**
	 * Gets a post.
	 *
	 * @since 1.0.0
	 *
	 * @param string $by   The field to search by.
	 * @param string $value The value to search for.
	 *
	 * @return array<int, WP_Post>
	 */
	public function get( string $by = 'date', string $value = '' ): array {
		//@todo fetch a post by date
	}

	/**
	 * Inserts a post.
	 *
	 * @since 1.0.0
	 *
	 * @param array $data The data to insert.
	 *
	 * @return int
	 */
	public function insert( array $data = [] ): int {
		// @todo insert post
	}
}