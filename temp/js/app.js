(function($) {
	"use strict";

	$(document).ready(function(){
		// Add class to images with anchor links
		$('.content').find('img').parent('a').addClass('imgwrap');

         //fixed header
         var header = $( '.site-header' );
         var pos = header.position().top*2;

         $(window).scroll(function(){
			if ($(this).scrollTop() > pos ){
				header.addClass('fixed animated fadeInDown');
			} else {
				header.removeClass('fixed animated fadeInDown');
			}
		});


		// Responsive Menu
		$( '.nav-primary' ).before( '<button class="menu-toggle" role="button" aria-pressed="false"></button>' ); // Add toggles to menus
		$( '.genesis-nav-menu .sub-menu' ).before( '<button class="sub-menu-toggle" role="button" aria-pressed="false"></button>' ); // Add toggles to sub menus

		// Show/hide the navigation
		$( '.menu-toggle, .sub-menu-toggle' ).on( 'click', function() {
			var $this = $( this );
			$this.attr( 'aria-pressed', function( index, value ) {
				return 'false' === value ? 'true' : 'false';
			});

			$this.toggleClass( 'activated' );
			$this.next( '.sub-menu' ).slideToggle( 'fast' );

			$this.next('.nav-primary').slideToggle( 'fast' );

		});




		$('#main-nav-search-link').click(function(){
			$('.search-div').slideDown('fast');
		});

		$("*", document.body).click(function(event){
			// event.stopPropagation();
			var el = $(event.target);
			var gsfrm = $(el).closest('form');

			var width = $(window).width(), height = $(window).height();
			if ((width >= 1023)) {
				if(el.attr('id') !='main-nav-search-link' && el.attr('role') != 'search' && gsfrm.attr('role') != 'search'){
					$('.search-div').slideUp('fast');
				}
			}
		});
		

		// FitVids
		var container = $( '.video, .content' );
		container.fitVids();
		container.fitVids( {
			customSelector: "iframe[src*='//fast.wistia.net']"
		} );
		$('.content p').each(function() {
			var $this = $(this);
			if($this.html().replace(/\s| /g, '').length === 0){
				$this.addClass('empty');
			}
		});


		$(".featuredpost").find('.entry').each(function(){

			var xxx = $(this),
			    href = xxx.find(".imgwrap").attr('href');

			    console.log(href);

			xxx.find(" .entry-header ").insertBefore( xxx.find(" .imgwrap ") );
			
			$('<a>View Blog Post</a>')
				.insertAfter( xxx.find(" .imgwrap ") )
				.addClass('btn border')
				.attr('href', href );
		});

		//home-section-6 right
		var halfImage = $( ".home-section-6" ).find(".widget_mb_image .widget-wrap"),
		    imgUrl = halfImage.find(' img ').attr( 'src' );

		    halfImage.css('background-image', 'url(' + imgUrl + ')' );	
		    halfImage.find(' img ').remove();

		//home-section-7 left
        $('<div class=section-6-about-bg></div>').insertAfter('.home-section-6 .widget-last');


        $('.casestudy-widget').owlCarousel({
			navigation : true, // Show next and prev buttons
			slideSpeed : 300,
			//paginationSpeed : 400,
			pagination : false,
			singleItem:true,
			navigationText: ["<span class='mega-octicon octicon-triangle-left'></span>","<span class='mega-octicon octicon-triangle-right'></span>"],
			autoHeight:	true
		});

		 $('.after-content-slider').owlCarousel({
			navigation : true, // Show next and prev buttons
			slideSpeed : 300,
			//paginationSpeed : 400,
			pagination : true,
			singleItem:true,
			navigationText: ["<span class='mega-octicon octicon-triangle-left'></span>","<span class='mega-octicon octicon-triangle-right'></span>"],
			autoHeight:	true
		});


        $('.home-section-1 .widget-last .textwidget').addClass('animated fadeInUp');

        var $window = $(window), win_height_padded = $window.height() * 1.1;
     	
     	$window.on('scroll', revealOnScroll);
     	
        function revealOnScroll() {
    		var scrolled = $window.scrollTop();	
		    $(".revealOnScroll:not(.animated)").each(function () {
		        var $this     = $(this),
		        offsetTop = $this.offset().top;

				if (scrolled + win_height_padded > offsetTop) {
					if ($this.data('timeout')) {
					  window.setTimeout(function(){
					    $this.addClass('animated ' + $this.data('animation'));
					  }, parseInt($this.data('timeout'),10));
					} else {
					  $this.addClass('animated ' + $this.data('animation'));
					}
				}
			});
		}

		 $(".revealOnScroll.animated").each(function (index) {
	      var $this     = $(this),
	          offsetTop = $this.offset().top;
	      if (scrolled + win_height_padded < offsetTop) {
	        $(this).removeClass('animated fadeInUp flipInX lightSpeedIn')
	      }
	    });


		 $(".cta-btn").fancybox({
			'showCloseButton'	: false	
		});

	});


       
	

	// Window load event with minimum delay
	// @https://css-tricks.com/snippets/jquery/window-load-event-with-minimum-delay/
	(function fn() {
		fn.now = +new Date;
		$(window).load(function() {
			if (+new Date - fn.now < 300) {
				setTimeout(fn, 300);
			}
			var foo = $('body');
			$('body').addClass('animated fadeIn');
			$('body').stop().fadeIn(10000);
			/* foo.velocity('fadeIn', {
					duration: 500
			}); */
            foo.css('visibility', 'visible');

            // $(this).impulse({
            // 	leap: 1.4
            // });
		});
	})();
})(jQuery);
