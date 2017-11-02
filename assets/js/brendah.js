(function($) {

	"use strict";

	//Input fields
	$('.hubaga-field')
		.on( 'focus', function(){
			$(this).addClass( 'hubaga-is-focused' )
		})

		.on( 'blur', function(){
			$(this).removeClass( 'hubaga-is-focused' )
		})

		.on( 'keyup', function(){
			if ($(this).val().length === 0) {
				$(this).addClass('hubaga-is-empty');
			} else {
				$(this).removeClass('hubaga-is-empty');
			}
		})

	// Mobile menu
	$('.navbar-collapse').on('click', function(e){
		e.preventDefault();
		$('#mobile-primary-menu').toggleClass( 'toggled' );
	});


		//Hide menu on click outside
	   $(document).on('mouseup', function(e){
			var menu = $('#mobile-primary-menu');
			if(!menu.is(e.target) && menu.has(e.target).length === 0 ) {
				menu.removeClass('toggled');
			}
	  });

  //List groups
   $('.list-group-menu .list-group-item').on('click', function(e){
		$( this ).closest('.list-group-menu').find('.list-group-item').removeClass('active');
		$(this).addClass( 'active' );
   });

  //Add smooth scrolling to the back to top buttons on doc pages
  $('[href="#header"]').on('click', function(event){
		event.preventDefault();
		$('body,html').animate(
			{
				scrollTop: 0,
		 	},
			700,
			function(){
				window.location.hash = '#header'
			}
		);
	});

	//List groups
   $('.docmenu a, .smooth-scroll').on('click', function(e){
	    e.preventDefault();
		var hash = this.hash
		var target = $($(this).attr('href')).find('h2')
		$('body,html').animate(
			{
				scrollTop: target.offset().top - 80 ,
		 	},
			700,
			function(){
				target.focus()
				if(! target.is(':focus')){
					target.attr('tabindex','-1');
					target.focus()
				}
				window.location.hash = hash
			}
		);

   });

  	//hide or show the "back to top" link + filter navbar classes
	$(window).scroll(function(){
		( $(this).scrollTop() > 300 ) ? $('.scroll-to-top').fadeIn() : $('.scroll-to-top').fadeOut();
		( $(this).scrollTop() >200 ) ? $('.main-nav-bar').addClass('z-depth-1') : $('.main-nav-bar').removeClass('z-depth-1');
	});

	$('.scroll-to-top').on('click', function(event){
		event.preventDefault();
		$('body,html').animate({
			scrollTop: 0 ,
		 	}, 700
		);
	});

if( $('body').has('.hero').length > 0 ){
	var hero = $('.hero')
	hero.css({
		height: $(window).innerHeight()
	})

	$(window).on( 'resize', function(){
		hero.css({
			height: $(window).innerHeight()
		})
	})
}

})(jQuery);
