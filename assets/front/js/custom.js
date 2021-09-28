$(function() {
	//console.log('width: '+jQuery(window).width());
		var wWidth = jQuery(window).width();
		var ulMargin = 50;
		var slWidth = 300;
		var smode = 'horizontal';
		var minSlide = 3;
		var maxSlide = 3;
		
		if(wWidth < 1083){
			ulMargin = 10;
			slWidth = 240;
		}
		
		if(wWidth < 883){
			smode = 'vertical';
			slWidth = 300;
			ulMargin = 0;
			minSlide = 1;
			maxSlide = 1;
		}
		/*Slideshow Initiation - Comment out if no slideshow*/
		slider = $('ul.slider').bxSlider({
			mode: smode,
			auto:true,
			pause:6000,
			nextSelector:'.slider-next',
			prevSelector:'.slider-prev',
			minSlides: minSlide,
			maxSlides: maxSlide,
			moveSlides:1,
			slideWidth: slWidth,
			slideMargin: ulMargin,
			pager:false,
			startSlide:0,
			randomStart:false,
			onSliderLoad:function(currentIndex) {
				$('ul.slider li:not([class="bx-clone"])').eq(1).addClass('active');
			},
			onSlideBefore:function() {
				$('ul.slider').children().removeClass('active');
				current = slider.getCurrentSlide();
				$('ul.slider li:not([class="bx-clone"])').eq(current+1).addClass('active');
			}
		});

/* Playing videos with cover*/
		$('.cover').on('click', function(e) {
			e.preventDefault();
			var vURL = $(this).parent().find('iframe').data('src');
			$(this).parent().find('iframe').attr('src', vURL);
			$(this).parent().addClass('playing');
		});

});
