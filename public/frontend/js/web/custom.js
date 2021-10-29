/*

Template: Jobber - Job Board HTML5 Template
Author: potenzaglobalsolutions.com
Design and Developed by: potenzaglobalsolutions.com

NOTE: This file contains all scripts for the actual Template.

*/

/*================================================
[  Table of contents  ]
================================================

:: Preloader
:: Menu
:: Tooltip
:: Counter
:: Owl carousel
:: Slickslider
:: Magnific Popup
:: Datetimepicker
:: Select2
:: Range Slider
:: Countdown
:: Scrollbar
:: Back to top

======================================
[ End table content ]
======================================*/
//POTENZA var

( function ($) {
  "use strict";
  var POTENZA = {};

	/*************************
	  Predefined Variables
	*************************/
	
	var $window     = $(window),
    $document       = $(document),
    $body           = $('body'),
    $countdownTimer = $('.countdown'),
    $counter        = $('.counter');
  
	//Check if function exists
	$.fn.exists = function () {
		return this.length > 0;
	};

	/*************************
		Preloader
    *************************/
	
	POTENZA.preloader = function () {
       $("#load").fadeOut();
       $('#pre-loader').delay(0).fadeOut('slow');
	};

	/*************************
		menu
	*************************/
	POTENZA.dropdownmenu = function () {
		if ( $('.navbar').exists() ) {
			$('.dropdown-menu a.dropdown-toggle').on('click', function (e) {
				if ( !$(this).next().hasClass('show') ) {
					$(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
				}
				var $subMenu = $(this).next(".dropdown-menu");
				$subMenu.toggleClass('show');
				
				$(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function (e) {
					$('.dropdown-submenu .show').removeClass("show");
				});
				return false;
			});
		}
	};

	$(document).ready(function(){
		$('#nav-icon4').on( 'click', function(){
			$(this).toggleClass('open');
		});
	});

	/*************************
		sticky
	*************************/
	POTENZA.isSticky = function () {
		$(window).scroll( function(){
			if ($(this).scrollTop() > 150) {
				$('.header-sticky').addClass('is-sticky');
			} else {
				$('.header-sticky').removeClass('is-sticky');
			}
		});
	};


	/*************************
		tooltip
	*************************/

	$('[data-toggle="tooltip"]').tooltip();
	$('[data-toggle="popover"]').popover()

	/*************************
		counter
	*************************/
	
	POTENZA.counters = function () {
		var counter = jQuery(".counter");
		if (counter.length > 0) {
			$counter.each(function () {
				var $elem = $(this);
				$elem.appear(function () {
					$elem.find('.timer').countTo();
				});
			});
		}
	};

	/*************************
       owl carousel
	*************************/

	POTENZA.carousel = function () {
		var owlslider = jQuery("div.owl-carousel");
		if ( owlslider.length > 0 ) {
			owlslider.each( function () {
			var $this = $(this),
				$items = ($this.data('items')) ? $this.data('items') : 1,
				$loop = ($this.attr('data-loop')) ? $this.data('loop') : true,
				$navdots = ($this.data('nav-dots')) ? $this.data('nav-dots') : false,
				$navarrow = ($this.data('nav-arrow')) ? $this.data('nav-arrow') : false,
				$autoplay = ($this.attr('data-autoplay')) ? $this.data('autoplay') : true,
				$autospeed = ($this.attr('data-autospeed')) ? $this.data('autospeed') : 5000,
				$smartspeed = ($this.attr('data-smartspeed')) ? $this.data('smartspeed') : 1500,
				$autohgt = ($this.data('autoheight')) ? $this.data('autoheight') : false,
				$space = ($this.attr('data-space')) ? $this.data('space') : 30,
				$animateOut = ($this.attr('data-animateOut')) ? $this.data('animateOut') : false;

				$(this).owlCarousel({
					loop: $loop,
					items: $items,
					responsive: {
						0: {
							items: $this.data('xx-items') ? $this.data('xx-items') : 1
						},
						480: {
							items: $this.data('xs-items') ? $this.data('xs-items') : 1
						},
						768: {
							items: $this.data('sm-items') ? $this.data('sm-items') : 2
						},
						980: {
							items: $this.data('md-items') ? $this.data('md-items') : 3
						},
						1200: {
							items: $items
						}
					},
					dots: $navdots,
					autoplayTimeout: $autospeed,
					smartSpeed: $smartspeed,
					autoHeight: $autohgt,
					margin: $space,
					nav: $navarrow,
					navText: ["<i class='fas fa-chevron-left'></i>", "<i class='fas fa-chevron-right'></i>"],
					autoplay: $autoplay,
					autoplayHoverPause: true
				});
			});
		}
	}

	/*************************
        slickslider
	*************************/
	
	POTENZA.slickslider = function () {
		if ( $('.slider-for').exists() ) {
			$('.slider-for').slick({
				slidesToShow: 1,
				slidesToScroll: 1,
				arrows: true,
				asNavFor: '.slider-nav'
			});
			$('.slider-nav').slick({
				slidesToShow: 3,
				slidesToScroll: 1,
				asNavFor: '.slider-for',
				dots: false,
				centerMode: true,
				focusOnSelect: true
			});
		}
	};

	/*************************
		Magnific Popup
	*************************/
	
	POTENZA.mediaPopups = function () {
		if ($(".popup-single").exists() || $(".popup-gallery").exists() || $('.modal-onload').exists() || $(".popup-youtube, .popup-vimeo, .popup-gmaps").exists()) {
			if ($(".popup-single").exists()) {
				$('.popup-single').magnificPopup({
					type: 'image'
				});
			}

			if ( $(".popup-gallery").exists() ) {
				$('.popup-gallery').magnificPopup({
					delegate: 'a.portfolio-img',
					type: 'image',
					tLoading: 'Loading image #%curr%...',
					mainClass: 'mfp-img-mobile',
					gallery: {
						enabled: true,
						navigateByImgClick: true,
						preload: [0, 1] // Will preload 0 - before current, and 1 after the current image
					}
				});
			}
			
			if ( $(".popup-youtube, .popup-vimeo, .popup-gmaps").exists() ) {
				$('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
					disableOn: 700,
					type: 'iframe',
					mainClass: 'mfp-fade',
					removalDelay: 160,
					preloader: false,
					fixedContentPos: false
				});
			}
			
			var $modal = $('.modal-onload');
			if ( $modal.length > 0 ) {
				$('.popup-modal').magnificPopup({
					type: 'inline'
				});
				
				$(document).on('click', '.popup-modal-dismiss', function (e) {
					e.preventDefault();
					$.magnificPopup.close();
				});
		
				var elementTarget = $modal.attr('data-target');
				setTimeout(function () {
					$.magnificPopup.open({
						items: {
							src: elementTarget
						},
						type: "inline",
						mainClass: "mfp-no-margins mfp-fade",
						closeBtnInside: !0,
						fixedContentPos: !0,
						removalDelay: 500
					}, 0 )
				}, 1500 );
			}
		}
	}

	/*************************
		datetimepicker
	*************************/
	
	POTENZA.datetimepickers = function () {
		if ( $('.datetimepickers').exists() ) {
			$('#datetimepicker-01, #datetimepicker-02').datetimepicker({
				format: 'L'
			});
			$('#datetimepicker-03, #datetimepicker-04').datetimepicker({
				format: 'LT'
			});
		}
	};

	/*************************
		select2
	*************************/
	
	POTENZA.select2 = function () {
		if ( $('.basic-select').exists() ) {
			var select = jQuery(".basic-select");
			if ( select.length > 0 ) {
				$('.basic-select').select2();
			}
		}
	};

	/*************************
		Range Slider
	*************************/
	
	POTENZA.rangesliders = function () {
		if ( $('.property-price-slider').exists() ) {
			var rangeslider = jQuery(".rangeslider-wrapper");
			$("#property-price-slider").ionRangeSlider({
				type: "double",
				min: 0,
				max: 10000,
				prefix: "$"
			});
		}
	};

	/*************************
	   Countdown
	*************************/
	
	POTENZA.countdownTimer = function () {
		if ($countdownTimer.exists()) {
			$countdownTimer.downCount({
				date: '12/25/2020 12:00:00', // Month/Date/Year HH:MM:SS
				offset: 400
			});
		}
	}

    /*************************
        BgSlider
	*************************/
	
	POTENZA.bgSlider = function () {
		var $bgSlider = $('#bg-slider');
		if ( $bgSlider.exists() ) {
			$("#bg-slider").kenburnsy({
				fullscreen: false
			});
		}
	}

	/*************************
		scrollbar
	*************************/
	
	POTENZA.scrollbar = function () {
		var scrollbar = jQuery(".scrollbar");
		if ( scrollbar.length > 0 ) {

			// Sidebar Scroll
			var scroll_light = jQuery(".scroll_light");
			if ( scroll_light.length > 0 ) {
				$( scroll_light ).niceScroll({
					cursorborder: 0,
					cursorcolor: "rgba(255,255,255,0.25)"
				});
				$(scroll_light).getNiceScroll().resize();
			}
		
			// Chat Scroll
			var scroll_dark = jQuery(".scroll_dark");
			if ( scroll_dark.length > 0 ) {
				$(scroll_dark).niceScroll({
					cursorborder: 0,
					cursorcolor: "rgba(0,0,0,0.1)"
				});
				$(scroll_dark).getNiceScroll().resize();
			}
		}
	}


	/*************************
		Secondary menu
	*************************/
	
	POTENZA.secondarymenu = function () {
		$(".secondary-menu ul li a[href^='#']").on('click', function(e) {

			// prevent default anchor click behavior
			e.preventDefault();

			// store hash
			var hash = this.hash;

			// animate
			$('html, body').animate({
				scrollTop: $(hash).offset().top
			 }, 1000, function(){
				// when done, add hash to url
				// (default click behaviour)
				window.location.hash = hash;
			});
		});
	}


	/*************************
		Back to top
	*************************/
	
	POTENZA.goToTop = function () {
		var $goToTop = $('#back-to-top');
		$goToTop.hide();
		$window.scroll( function () {
			if ( $window.scrollTop() > 100 ) $goToTop.fadeIn();
			else $goToTop.fadeOut();
		});
		
		$goToTop.on("click", function () {
			$('body,html').animate({
				scrollTop: 0
			}, 1000);
			return false;
		});
	}

	/****************************************************
		POTENZA Window load and functions
	****************************************************/
	
	// Window load functions
	$window.on("load", function () {
		POTENZA.preloader();
	});
	
	// Document ready functions
	$document.ready(function () {
		POTENZA.counters(),
		POTENZA.slickslider(),
		POTENZA.datetimepickers(),
		POTENZA.select2(),
		POTENZA.dropdownmenu(),
		POTENZA.isSticky(),
		POTENZA.scrollbar(),
		POTENZA.goToTop(),
		POTENZA.bgSlider(),
		POTENZA.countdownTimer(),
		POTENZA.secondarymenu(),
		POTENZA.mediaPopups(),
		POTENZA.rangesliders(),
		POTENZA.carousel();
	});

/*$('.moreless-button1').click(function() {
  $('.moretext1').slideToggle();
  if ($('.moreless-button1').text() == "What will you learn +") {
    $(this).text("What will you learn -")
  } else {
    $(this).text("What will you learn +")
  }
});

		$('.moreless-button2').click(function() {
  $('.moretext2').slideToggle();
  if ($('.moreless-button2').text() == "Outcomes +") {
    $(this).text("Outcomes -")
  } else {
    $(this).text("Outcomes +")
  }
});

	$('.moreless-button3').click(function() {
  $('.moretext3').slideToggle();
  if ($('.moreless-button3').text() == "What will you learn +") {
    $(this).text("What will you learn -")
  } else {
    $(this).text("What will you learn +")
  }
});

		$('.moreless-button4').click(function() {
  $('.moretext4').slideToggle();
  if ($('.moreless-button4').text() == "Outcomes +") {
    $(this).text("Outcomes -")
  } else {
    $(this).text("Outcomes +")
  }
});

	$('.moreless-button5').click(function() {
  $('.moretext5').slideToggle();
  if ($('.moreless-button5').text() == "What will you learn +") {
    $(this).text("What will you learn -")
  } else {
    $(this).text("What will you learn +")
  }
});

		$('.moreless-button6').click(function() {
  $('.moretext6').slideToggle();
  if ($('.moreless-button6').text() == "Outcomes +") {
    $(this).text("Outcomes -")
  } else {
    $(this).text("Outcomes +")
  }
});

	$('.moreless-button7').click(function() {
  $('.moretext7').slideToggle();
  if ($('.moreless-button7').text() == "What will you learn +") {
    $(this).text("What will you learn -")
  } else {
    $(this).text("What will you learn +")
  }
});

	$('.moreless-button8').click(function() {
  $('.moretext8').slideToggle();
  if ($('.moreless-button8').text() == "Outcomes +") {
    $(this).text("Outcomes -")
  } else {
    $(this).text("Outcomes +")
  }
});

	$('.moreless-button9').click(function() {
  $('.moretext9').slideToggle();
  if ($('.moreless-button9').text() == "What will you learn +") {
    $(this).text("What will you learn -")
  } else {
    $(this).text("What will you learn +")
  }
});

		$('.moreless-button10').click(function() {
  $('.moretext10').slideToggle();
  if ($('.moreless-button10').text() == "Outcomes +") {
    $(this).text("Outcomes -")
  } else {
    $(this).text("Outcomes +")
  }
});*/


$('#btn').click(function(e){    
    $('#fancy, #btn').fadeOut('slow', function(){
        $('#bank, #btn-bk').fadeIn('slow');
    });
});

$('#btn-bk').click(function(e){    
    $('#bank, #btn-bk').fadeOut('slow', function(){
        $('#fancy, #btn').fadeIn('slow');
    });
});

$('#btn2').click(function(e){    
    $('#fancy2, #btn2').fadeOut('slow', function(){
        $('#bank2, #btn-bk2').fadeIn('slow');
    });
});

$('#btn-bk2').click(function(e){    
    $('#bank2, #btn-bk2').fadeOut('slow', function(){
        $('#fancy2, #btn2').fadeIn('slow');
    });
});


$('#btn3').click(function(e){    
    $('#fancy3, #btn3').fadeOut('slow', function(){
        $('#bank3, #btn-bk3').fadeIn('slow');
    });
});

$('#btn-bk3').click(function(e){    
    $('#bank3, #btn-bk3').fadeOut('slow', function(){
        $('#fancy3, #btn3').fadeIn('slow');
    });
});


$('#btn4').click(function(e){    
    $('#fancy4, #btn4').fadeOut('slow', function(){
        $('#bank4, #btn-bk4').fadeIn('slow');
    });
});

$('#btn-bk4').click(function(e){    
    $('#bank4, #btn-bk4').fadeOut('slow', function(){
        $('#fancy4, #btn4').fadeIn('slow');
    });
});

$('#btn5').click(function(e){    
    $('#fancy5, #btn5').fadeOut('slow', function(){
        $('#bank5, #btn-bk5').fadeIn('slow');
    });
});

$('#btn-bk5').click(function(e){    
    $('#bank5, #btn-bk5').fadeOut('slow', function(){
        $('#fancy5, #btn5').fadeIn('slow');
    });
});

$('#btn6').click(function(e){    
    $('#fancy6, #btn6').fadeOut('slow', function(){
        $('#bank6, #btn-bk6').fadeIn('slow');
    });
});

$('#btn-bk6').click(function(e){    
    $('#bank6, #btn-bk6').fadeOut('slow', function(){
        $('#fancy6, #btn6').fadeIn('slow');
    });
});


$('#btn7').click(function(e){    
    $('#fancy7, #btn7').fadeOut('slow', function(){
        $('#bank7, #btn-bk7').fadeIn('slow');
    });
});

$('#btn-bk7').click(function(e){    
    $('#bank7, #btn-bk7').fadeOut('slow', function(){
        $('#fancy7, #btn7').fadeIn('slow');
    });
});

// Custom js
$('.what-you-learn').click(function(){
	$('#learndiv'+$(this).attr('target')).slideToggle();
	$('#learndiv'+$(this).attr('target')).hide();
    $('#learndiv'+$(this).attr('target')).show();
    if ($('#what_you_learn'+$(this).attr('target')).text() == "What will you learn +") {
	    $(this).text("What will you learn -")
	} else {
	    $(this).text("What will you learn +")
	}
});

$('.outcomes').click(function(){
	$('#outcomesdiv'+$(this).attr('target')).slideToggle();
	$('#outcomesdiv'+$(this).attr('target')).hide();
    $('#outcomesdiv'+$(this).attr('target')).show();
    if ($('#outcomes_div'+$(this).attr('target')).text() == "Outcomes +") {
	    $(this).text("Outcomes -")
	} else {
	    $(this).text("Outcomes +")
	}
});
})(jQuery);