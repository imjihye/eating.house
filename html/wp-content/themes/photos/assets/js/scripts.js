jQuery(document).ready(function($) {

	// Smooth Scroll
	jQuery('a[href*="#"]').click(function() {
		if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
			var target = jQuery(this.hash);
			target = target.length ? target : jQuery('[name=' + this.hash.slice(1) +']');
			if (target.length) {
				jQuery('html,body').animate({
					scrollTop: target.offset().top
				}, 1200);
				return false;
			}
		}
	});
	
	// init Masonry
	var $photogrid = $('.photogrid').masonry({
		itemSelector: '.photogrid-item',
		percentPosition: true,
		columnWidth: '.photogrid-sizer'
	});
	// layout Isotope after each image loads
	$photogrid.imagesLoaded().progress( function() {
		$photogrid.masonry();
	});

	var menuLeft = document.getElementById( 'push-menu-id' ),
		showLeftPush = document.getElementById( 'showLeftPush' ),
		closeMenu = document.getElementById( 'close-menu' ),
		body = document.body;

	showLeftPush.onclick = function() {
		classie.toggle( this, 'active' );
		classie.toggle( body, 'push-menu-push-toright' );
		classie.toggle( menuLeft, 'push-menu-open' );
		disableOther( 'showLeftPush' );
	};

	function disableOther( button ) {
		if( button !== 'showLeftPush' ) {
			classie.toggle( showLeftPush, 'disabled' );
		}
	}

});
