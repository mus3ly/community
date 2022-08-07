(function($) {
	
	/*---Owl-carousel----*/

	// ___Owl-carousel-icons
	var owl = $('.owl-carousel-icons');
	owl.owlCarousel({
		loop: true,
		rewind: false,
		margin: 0,
		animateIn: 'fadeInDowm',
		animateOut: 'fadeOutDown',
		autoplay: false,
		autoplayTimeout: 5000, 
		autoplayHoverPause: true,
		dots: false,
		nav: true,
		autoplay: true,
		responsiveClass: true,
		responsive: {
			0: {
				items: 1,
				nav: true
			},
			600: {
				items: 2,
				nav: true
			},
			1250: {
				items: 8,
				nav: true
			}
		}
	})
 // ___Owl-carousel-icons

})(jQuery);




$(document).ready(function(){
	
	$('ul.tabs__box li').click(function(){
		var tab_id = $(this).attr('data-tab');

		$('ul.tabs__box li').removeClass('current');
		$('.tab-content__box').removeClass('current');

		$(this).addClass('current');
		$("#"+tab_id).addClass('current');
	})

})



