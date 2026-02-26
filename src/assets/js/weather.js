/**
 * Ensure the application object is defined.
 *
 * @since 1.0.0
 *
 * @type {Object}
 */
window.weather = window.weather || {};

( function( window, $, obj ) {
	'use strict';

	/**
	 * Selectors used by the application.
	 *
	 * @since 1.0.0
	 *
	 * @type {Object}
	 */
	obj.selectors = {
		form: '.weather-form',
		list: '.weather-list',
		message: '.weather-form__message',
		refresh: '.weather-list__refresh'
	};

	/**
	 * Submit the form via Ajax.
	 *
	 * @since 1.0.0
	 *
	 * @param e
	 */
	obj.submitForm = function( e ) {
		e.preventDefault();

		let $form = $( this );

		$( obj.selectors.message ).html( 'Saving...' );

		// submit the form via Ajax to the /weather endpoint
		$.ajax( {
			url: obj.saveWeatherEndpoint,
			method: 'POST',
			beforeSend: function ( xhr ) {
				xhr.setRequestHeader( 'X-WP-Nonce', obj.nonce );
			},
			data: $form.serialize(),
			dataType: 'json',
			success: function( response ) {
				if ( typeof response.data.date == 'undefined' || typeof response.data.location == 'undefined' || typeof response.data.weather == 'undefined' ) {
					if ( typeof response.data.message != 'undefined' ) {
						$( obj.selectors.message ).html( response.data.message );
						return;
					}

					$( obj.selectors.message ).html( 'Invalid response from the server. The response must include a date, location, and weather element.' );
					return;
				}

				// If the request was successful, display the weather data at the top of the list.
				$( obj.selectors.list ).prepend( '<li>' + response.data.location + ' (' + response.data.date + '): ' + response.data.weather + '</li>' );
				$( obj.selectors.message ).html( 'Entry added!' );
			},
			error: function() {
				$( obj.selectors.message ).html( 'There was an error processing your request.' );
			}
		} );
	};

	/**
	 * Fetch date/weather combos from the server.
	 *
	 * @since 1.0.0
	 *
	 * @param e
	 */
	obj.refreshList = function( e ) {
		e.preventDefault();

		$( obj.selectors.message ).html( 'Fetching...' );

		// submit the form via Ajax to the /weather endpoint
		$.ajax( {
			url: obj.getWeatherEndpoint,
			method: 'GET',
			dataType: 'json',
			success: function( response ) {
				if ( typeof response.data.dates == 'undefined' ) {
					if ( typeof response.data.message != 'undefined' ) {
						$( obj.selectors.message ).html( response.data.message );
						return;
					}

					$( obj.selectors.message ).html( 'Invalid response from the server. The response must include an array of date, location, and weather elements.' );
					return;
				}

				// Clear the list.
				$( obj.selectors.list ).html( '' );

				// Build the list.
				for ( i in response.data.dates ) {
					$( obj.selectors.list ).prepend( '<li>' + response.data.dates[i].location + ' (' + response.data.dates[i].date + '): ' + response.data.dates[i].weather + '</li>' );
				}

				$( obj.selectors.message ).html( '' );
			},
			error: function() {
				$( obj.selectors.message ).html( 'There was an error processing your request.' );
			}
		} );
	};

	/**
	 * Initialize the application.
	 *
	 * @since 1.0.0
	 */
	obj.ready = function() {
		$( obj.selectors.form ).on( 'submit', obj.submitForm );
		$( obj.selectors.refresh ).on( 'click', obj.refreshList );
	};

	$( obj.ready );
} )( window, jQuery, window.weather );