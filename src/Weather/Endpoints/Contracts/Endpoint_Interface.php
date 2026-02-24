<?php
/**
 * This defines the contract for endpoints.
 *
 * @since   1.0.0
 *
 * @package Weather
 */

namespace Weather\Endpoints\Contracts;

/**
 * Endpoints.
 *
 * @since 1.0.0
 */
interface Endpoint_Interface {
	/**
	 * Registers the endpoint.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function register();

	/**
	 * Renders the endpoint content.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function render();
}