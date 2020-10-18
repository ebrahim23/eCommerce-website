jQuery(document).ready(function($) {
		var stickyHeaderTop = $('.menu-box-wrapper').offset().top;
		$(window).scroll(function(){
		    if( $(window).scrollTop() > stickyHeaderTop ) {
			$('.menu-box-wrapper').addClass("sticky-nav");
		    } else {
			$('.menu-box-wrapper').removeClass("sticky-nav");
		    }
		});
});