<?php

namespace Weather\Tests;

use Weather\Tests\WeatherTestCase;
use Weather\Plugin;

class BootstrapTest extends WeatherTestCase {

	public function test_is_initialized() {
		$instance = Plugin::instance();

		$this->assertInstanceOf( Plugin::class, $instance );
	}
}

