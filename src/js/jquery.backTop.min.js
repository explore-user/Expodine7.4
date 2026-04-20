/* Minified js for jQuery BackTop */
!function(o){o.fn.backTop=function(e){var n=this,i=o.extend({position:400,speed:500,color:"white"},e),t=i.position,c=i.speed,d=i.color;n.addClass("white"==d?"white":"red"==d?"red":"green"==d?"green":"black"),n.css({right:40,bottom:40,position:"fixed"}),o(document).scroll(function(){var e=o(window).scrollTop();console.log(e),e>=t?n.fadeIn(c):n.fadeOut(c)}),n.click(function(){o(".kot_recent_left_cc_1").animate({scrollTop:0},{duration:1200})})}}(jQuery);

jQuery(document).ready(function($){
	// browser window scroll (in pixels) after which the "back to top" link is shown
	var offset = 300,
		//browser window scroll (in pixels) after which the "back to top" link opacity is reduced
		offset_opacity = 1200,
		//duration of the top scrolling animation (in ms)
		scroll_top_duration = 700,
		//grab the "back to top" link
		$back_to_top = $('.cd-top');

	//hide or show the "back to top" link
	$(window).scroll(function(){
		( $(this).scrollTop() > offset ) ? $back_to_top.addClass('cd-is-visible') : $back_to_top.removeClass('cd-is-visible cd-fade-out');
		if( $(this).scrollTop() > offset_opacity ) { 
			$back_to_top.addClass('cd-fade-out');
		}
	});

	//smooth scroll to top
	$back_to_top.on('click', function(event){
		event.preventDefault();
		$('.kot_recent_left_cc_1').animate({
			scrollTop: 0 ,
		 	}, scroll_top_duration
		);
	});

});