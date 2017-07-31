/**
 * File site.js.
 *
 * Various scripts for the Birthday Poster Series website
 *
 */
 
// Because the Wordpress jQuery is loaded in no conflict mode, and I am too lazy not to use $
var $ = jQuery.noConflict();

var leavingPosterPage = false;
var animationDuration = 380;

function setUpLayerButtons() {
	$('#layer-button1').click(function(){
		$('#poster-layer1').fadeToggle(100);
		$(this).toggleClass('active');
	});
	$('#layer-button2').click(function(){
		$('#poster-layer2').fadeToggle(100);
		$(this).toggleClass('active');
	});
	$('#layer-button3').click(function(){
		$('#poster-layer3').fadeToggle(100);
		$(this).toggleClass('active');
	});
	
	
	$('.poster-thumb').click(function(){
		$('.poster-thumbs').each(function(){
			var height = $(this).height();
			$(this).css('height', height);
		});
		
		var $this = $(this);
		var x = $(this).offset().left - $(window).scrollLeft();
		var y = $(this).offset().top - $(window).scrollTop();
		var width = $(this).width();
		$(this).css({width: width, top: y, left: x, position: 'fixed'});
		
		window.setTimeout(function(){
			$this.addClass('clicked');
		}, 2);
	});
}


$(document).ready(function() {
	setUpLayerButtons();
	
	if ($(window).width() < 800) {
	   animationDuration = 0;
	}
	else {
	   animationDuration = 380;
	}
});


( function( $ ) {

	$( function() { // Ready

		var settings = { 
			anchors: 'a',
			prefetch: true,
			onStart: {
				duration: animationDuration, // ms
				render: function ( $container ) {
					$container.addClass( 'slide-out' );
					$('.poster').css('z-index', '0');
					
					$('html, body').animate({
						scrollTop: 0
					}, animationDuration);
					
					if ($(".poster").length > 0) {
						leavingPosterPage = true;
						$('#main').fadeOut(animationDuration);
					}
				}
			},
			onAfter: function( $container ) {
				$('#page').waitForImages(function() {
					// All descendant images have loaded, now slide up.
					$container.removeClass( 'slide-out' );
				});
				
				if (leavingPosterPage) {
					$('#main').fadeOut(0);
					window.setTimeout(function(){
						$('#main').fadeIn(animationDuration);
					}, 2);
					leavingPosterPage = false;
				}
				
				setUpLayerButtons();
			}
		};

		$( '#page' ).smoothState( settings );
	} );

})( jQuery );