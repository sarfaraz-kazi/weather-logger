<?php
/**
 * This defines the contract for REST endpoints.
 *
 * @since   1.0.0
 *
 * @package Weather
 */

namespace Weather\REST\Contracts;

/**
 * Endpoints.
 *
 * @since 1.0.0
 */
interface REST_Interface {
	/**
	 * Registers rest endpoints.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function register();
}