<?php
/**
 * Registers blocks.
 *
 * @since 1.0.0
 *
 * @package Weather
 */
namespace Weather;

/**
 * Blocks class.
 *
 * @since 1.0.0
 */
class Blocks {
	/**
	 * Registers blocks.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function register() {
		\register_block_type( 'weather/form', [
			'editor_script'   => 'weather-blocks',
			'render_callback' => [ $this, 'render_form' ],
			'attributes'      => [
				'requireLogin' => [
					'type'    => 'boolean',
					'default' => true,
				],
			],
		] );

		\register_block_type( 'weather/list', [
			'editor_script'   => 'weather-blocks',
			'render_callback' => [ $this, 'render_list' ],
			'attributes'      => [
				'location' => [
					'type'    => 'string',
					'default' => '',
				],
				'date_from' => [
					'type'    => 'string',
					'default' => '',
				],
				'date_to' => [
					'type'    => 'string',
					'default' => '',
				],
			],
		] );
	}

	/**
	 * Renders the form block.
	 *
	 * @since 1.0.0
	 *
	 * @param array $attributes Block attributes.
	 *
	 * @return string
	 */
	public function render_form( $attributes ) {
		if ( $attributes['requireLogin'] && ! \is_user_logged_in() ) {
			return '<p>Please log in to submit weather data.</p>';
		}

		ob_start();
		include \plugin_dir_path( WEATHER_FILE ) . 'src/views/weather-form.php';
		return ob_get_clean();
	}

	/**
	 * Renders the list block.
	 *
	 * @since 1.0.0
	 *
	 * @param array $attributes Block attributes.
	 *
	 * @return string
	 */
	public function render_list( $attributes ) {
		$args = [
			'location'  => $attributes['location'] ?? '',
			'date_from' => $attributes['date_from'] ?? '',
			'date_to'   => $attributes['date_to'] ?? '',
		];

		$post_type = new Post_Type();
		$posts     = $post_type->query( $args );

		ob_start();
		// We can include a view or just output here
		if ( empty( $posts ) ) {
			echo '<p>No weather data found.</p>';
		} else {
			echo '<ul class="weather-list">';
			foreach ( $posts as $post ) {
				$date     = \get_post_meta( $post->ID, 'date', true );
				$location = \get_post_meta( $post->ID, 'location', true );
				$weather  = \get_post_meta( $post->ID, 'weather', true );
				printf( '<li>%s (%s): %s</li>', \esc_html( $location ), \esc_html( $date ), \esc_html( $weather ) );
			}
			echo '</ul>';
		}
		
		// Add refresh button for JS interaction if needed
		echo '<button class="weather-list__refresh">Refresh</button>';
		echo '<div class="weather-form__message"></div>'; // Reusing message class for simplicity

		return ob_get_clean();
	}
}
