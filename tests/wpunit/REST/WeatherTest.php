<?php

namespace Weather\Tests\REST;

use Weather\Tests\WeatherTestCase;
use Weather\Plugin;

class WeatherTest extends WeatherTestCase {

	public function test_save_route_is_registered() {
		$server = rest_get_server();
		$route = '/wp-json/weather/v1/save';

		$this->assertNotEmpty( $server->get_routes( $route ) );
	}

	public function test_fetch_route_is_registered() {
		$server = rest_get_server();
		$route = '/wp-json/weather/v1/get';

		$this->assertNotEmpty( $server->get_routes( $route ) );
	}

	public function test_group_route_is_registered() {
		$server = rest_get_server();
		$route = '/wp-json/weather/v1/group';

		$this->assertNotEmpty( $server->get_routes( $route ) );
	}
}

