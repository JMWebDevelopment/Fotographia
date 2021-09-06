jQuery( document ).ready( function() {
	jQuery( ".story" ).hover(
		function() {
			jQuery( this ).find( ".story-wrap" ).hide();
			jQuery( this ).find( ".photo-wrap" ).show();
		}, function() {
			jQuery( this ).find( ".story-wrap" ).show();
			jQuery( this ).find( ".photo-wrap" ).hide();
		}
	);
	jQuery( '.photo-wrap' ).cycle( {
		fx: 'fade',
		speed: 1000,
	} );
} );
