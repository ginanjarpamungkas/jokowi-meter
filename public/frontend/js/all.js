$(document).ready(function() {

		var num2 =20; //number of pixels before modifying styles
		var num = 200; //number of pixels before modifying styles
		
		jQuery(window).bind('scroll', function () {
			if ($(window).scrollTop() > num) {
				$('.scrollup').fadeIn('fast');
			} else {
				$('.scrollup').fadeOut('fast');
			}});

		$(".top-search").click(function(){	
		$(".box-search").fadeToggle(500);
		$(this).find('i').toggleClass('fa-close fa-search');
	});
});
$(".scrollup").click(function(){
				$('html, body').animate({
				scrollTop: 0
			}, 500);
		});