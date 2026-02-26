( function( wp ) {
	var registerBlockType = wp.blocks.registerBlockType;
	var ServerSideRender = wp.serverSideRender;
	var el = wp.element.createElement;

	registerBlockType( 'weather/form', {
		title: 'Weather Form',
		icon: 'cloud',
		category: 'widgets',
		edit: function( props ) {
			return el( ServerSideRender, {
				block: 'weather/form',
				attributes: props.attributes
			} );
		},
		save: function() {
			return null;
		}
	} );

	registerBlockType( 'weather/list', {
		title: 'Weather List',
		icon: 'list-view',
		category: 'widgets',
		attributes: {
			location: { type: 'string' },
			date_from: { type: 'string' },
			date_to: { type: 'string' }
		},
		edit: function( props ) {
			return el( ServerSideRender, {
				block: 'weather/list',
				attributes: props.attributes
			} );
		},
		save: function() {
			return null;
		}
	} );
} )( window.wp );
