(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */
	$(document).ready(function () {
		_slaask.init('55934b6ff115e3af1c1d9e58ffdb1557');
		$('#nuttifox_live').click(function(e){
			e.preventDefault();
			$('#slaask-button-cross').click();
		})
		
		$( '#support_request_nuttifox' ).submit(function( e ) {
			e.preventDefault();
			var problem = $('#problem_description').val();
			console.log(problem);
			$.ajax({
			type: 'POST',
			url: nuttifoxmail.ajax_url,
			datatype: 'html',
			data: {'action': 'nuttifox_support_email', 'problem': problem, 'problem': problem},
			success: function(response) {
				//alert(response);
				jQuery( '.nuttifox_hello,#support_request_nuttifox,.or_live' ).toggle();
				jQuery( '#support_request_nuttifox_done' ).fadeToggle();
			},error:function(response){
				//alert('error is ' + response);
			}
			});
		});

	});
})( jQuery );
