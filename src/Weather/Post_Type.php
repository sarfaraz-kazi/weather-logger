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
		$labels = [
			'name'                  => _x( 'Weather', 'Post Type General Name', 'weather' ),
			'singular_name'         => _x( 'Weather', 'Post Type Singular Name', 'weather' ),
			'menu_name'             => __( 'Weather', 'weather' ),
			'name_admin_bar'        => __( 'Weather', 'weather' ),
			'archives'              => __( 'Weather Archives', 'weather' ),
			'attributes'            => __( 'Weather Attributes', 'weather' ),
			'parent_item_colon'     => __( 'Parent Weather:', 'weather' ),
			'all_items'             => __( 'All Weather', 'weather' ),
			'add_new_item'          => __( 'Add New Weather', 'weather' ),
			'add_new'               => __( 'Add New', 'weather' ),
			'new_item'              => __( 'New Weather', 'weather' ),
			'edit_item'             => __( 'Edit Weather', 'weather' ),
			'update_item'           => __( 'Update Weather', 'weather' ),
			'view_item'             => __( 'View Weather', 'weather' ),
			'view_items'            => __( 'View Weather', 'weather' ),
			'search_items'          => __( 'Search Weather', 'weather' ),
			'not_found'             => __( 'Not found', 'weather' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'weather' ),
			'featured_image'        => __( 'Featured Image', 'weather' ),
			'set_featured_image'    => __( 'Set featured image', 'weather' ),
			'remove_featured_image' => __( 'Remove featured image', 'weather' ),
			'use_featured_image'    => __( 'Use as featured image', 'weather' ),
			'insert_into_item'      => __( 'Insert into weather', 'weather' ),
			'uploaded_to_this_item' => __( 'Uploaded to this weather', 'weather' ),
			'items_list'            => __( 'Weather list', 'weather' ),
			'items_list_navigation' => __( 'Weather list navigation', 'weather' ),
			'filter_items_list'     => __( 'Filter weather list', 'weather' ),
		];
		$args = [
			'label'                 => __( 'Weather', 'weather' ),
			'description'           => __( 'Weather information', 'weather' ),
			'labels'                => $labels,
			'supports'              => [ 'title', 'custom-fields' ],
			'hierarchical'          => false,
			'public'                => false,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => false,
			'exclude_from_search'   => false,
			'publicly_queryable'    => false,
			'capability_type'       => 'post',
			'show_in_rest'          => false, // We use custom endpoints
		];
		register_post_type( 'weather', $args );
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
		$args = [
			'post_type'      => 'weather',
			'posts_per_page' => -1,
			'post_status'    => 'publish',
		];

		if ( 'date' === $by && ! empty( $value ) ) {
			$args['meta_query'] = [
				[
					'key'   => 'date',
					'value' => $value,
				],
			];
		} elseif ( 'location' === $by && ! empty( $value ) ) {
			$args['meta_query'] = [
				[
					'key'   => 'location',
					'value' => $value,
				],
			];
		}

		return get_posts( $args );
	}

	/**
	 * Query posts with more options.
	 *
	 * @since 1.0.0
	 *
	 * @param array $args Query arguments.
	 *
	 * @return array<int, WP_Post>
	 */
	public function query( array $args = [] ): array {
		$defaults = [
			'post_type'      => 'weather',
			'post_status'    => 'publish',
			'posts_per_page' => 10,
			'orderby'        => 'meta_value',
			'meta_key'       => 'date',
			'order'          => 'ASC',
		];

		$query_args = wp_parse_args( $args, $defaults );

		// Handle date range
		if ( ! empty( $args['date_from'] ) || ! empty( $args['date_to'] ) ) {
			$date_query = [ 'relation' => 'AND' ];
			if ( ! empty( $args['date_from'] ) ) {
				$date_query[] = [
					'key'     => 'date',
					'value'   => $args['date_from'],
					'compare' => '>=',
					'type'    => 'DATE',
				];
			}
			if ( ! empty( $args['date_to'] ) ) {
				$date_query[] = [
					'key'     => 'date',
					'value'   => $args['date_to'],
					'compare' => '<=',
					'type'    => 'DATE',
				];
			}
			$query_args['meta_query'][] = $date_query;
		}

		// Handle specific location
		if ( ! empty( $args['location'] ) ) {
			$query_args['meta_query'][] = [
				'key'   => 'location',
				'value' => $args['location'],
			];
		}

		// Handle pagination
		if ( ! empty( $args['page'] ) ) {
			$query_args['paged'] = absint( $args['page'] );
		}
		
		return get_posts( $query_args );
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
		if ( empty( $data['date'] ) || empty( $data['location'] ) || empty( $data['weather'] ) ) {
			return 0;
		}

		// Check for existing post
		$existing = get_posts( [
			'post_type'  => 'weather',
			'meta_query' => [
				'relation' => 'AND',
				[
					'key'   => 'date',
					'value' => $data['date'],
				],
				[
					'key'   => 'location',
					'value' => $data['location'],
				],
			],
			'posts_per_page' => 1,
			'post_status'    => 'any',
		] );

		$post_id = 0;
		$title   = sprintf( '%s (%s): %s', $data['location'], $data['date'], $data['weather'] );

		if ( ! empty( $existing ) ) {
			$post_id = $existing[0]->ID;
			wp_update_post( [
				'ID'         => $post_id,
				'post_title' => $title,
			] );
		} else {
			$post_id = wp_insert_post( [
				'post_title'  => $title,
				'post_type'   => 'weather',
				'post_status' => 'publish',
			] );
		}

		if ( $post_id ) {
			update_post_meta( $post_id, 'date', $data['date'] );
			update_post_meta( $post_id, 'location', $data['location'] );
			update_post_meta( $post_id, 'weather', $data['weather'] );
		}

		return $post_id;
	}
}