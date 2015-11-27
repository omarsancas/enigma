/* ------------------------------------------------------------------------ */
/* Javascripts
/* ------------------------------------------------------------------------ */
function home_parallax() {
	"use strict";
    jQuery(window).scroll(function() {
        var coords, yPos = -(jQuery(window).scrollTop() / 2); 
         
        // Put together our final background position
        coords = 'center '+ yPos + 'px !important';

        // Move the background
        //$('.page-title-wrapper').css({ backgroundPosition: coords });
        jQuery('.parallax-bg').css({ backgroundPosition: coords });
    
    }); 
}
function header_size()
{
    var win	            = jQuery(window),
        header          = jQuery('#header.fixed_header'),
        dropdown_menu	= jQuery('#header:not(.fixed_header) #navigation ul.menu > li .sub-menu'),
        dropdown_elem	= jQuery('#header:not(.fixed_header) #navigation .cart-contents, #header:not(.fixed_header) #navigation .search-area'),
        elements        = jQuery('#header.header1.fixed_header .my-table, #header.fixed_header .menu > li'),
        el_height       = jQuery(elements).filter(':first').height(),
        isMobile        = 'ontouchstart' in document.documentElement,
        scroll_top		= jQuery('#scroll-top-link'),
        logo_height		= jQuery('.logo a img').filter(':first').height(),
        set_height      = function()
        {
            var st = win.scrollTop(), newH = 0, newLH=0;

            if(st < el_height/1)
            {
                newH = el_height - st;
                header.removeClass('header-scrolled');

            } else {
                newH = el_height/2;
                if(!dropdown_menu.is(':visible'))
                	header.addClass('header-scrolled');
               	if(dropdown_elem.is(':visible'))
                	dropdown_elem.hide();
            }
            elements.css({height: newH + 'px', lineHeight: newH + 'px'});
        }
    	if(!header.length) return false;
        if(isMobile)
        {
            return false;
        }
        win.scroll(set_height);
        set_height();
}

function set_slider_effect (slider)
{
    var win = jQuery(window);
    el_height  = jQuery(slider).height();
    var st = win.scrollTop(), newH = 0, newBg = 0;
    if(st > 0)
    {
        newH = el_height - st;
        newBg = 0.3*st;
        jQuery(slider).css({'overflow':'hidden'});
        jQuery(slider).children("div:first").find('.slotholder div').css({'top':newBg+'px'});
    } else {
    	jQuery(slider).children("div:first").find('.slotholder div').css({'top':'0px'});
    }
}					
jQuery(document).ready(function($){
	var regMob = /ipod|ipad|iphone/gi,
	resMob = navigator.userAgent.match(regMob);
	if(!resMob) {
		home_parallax();
	}

	header_size();

	$('#header a[href*=#]:not([href=#], a.button[href*=#]:not([href=#])').click(function() {
	    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
	      var target = $(this.hash);
	      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
	      if (target.length) {
	        $('html,body').animate({
	          scrollTop: target.offset().top - 50
	        }, 900);
	        return false;
	      }
	    }
	});

	var drag_fw = $('#flexslider-portfolio');
	  var drag_start, drag_end;
	  drag_fw.mousedown(function(e){
	    drag_start = e.pageX;
	    drag_fw.addClass('dragging');
	    return drag_start;
	  });
	  drag_fw.mouseup(function(e){
	    drag_fw.removeClass('dragging');
	  });
	  drag_fw.mousemove(function(e){
	    if (drag_fw.hasClass('dragging')) {
	      if(drag_start - e.pageX < -100) {
	            drag_fw.flexslider('prev')
	    drag_fw.removeClass('dragging');
	      } else if (drag_start - e.pageX > 100) {
	            drag_fw.flexslider('next')
	    drag_fw.removeClass('dragging');
	      }
	    }
	  });

	/* ------------------------------------------------------------------------ */
	/* Top bar sliding */
	/* ------------------------------------------------------------------------ */
	
	if( $(".toparea-content").hasClass('active') ){
		$(".toparea-content").show();
		$(".toparea-sb").find('i.fa').removeClass('fa-plus').addClass('fa-minus');
	}

	$(".toparea-sb").click(function(){
		if( $(".toparea-content").hasClass('active') ){
			$(".toparea-content").removeClass("active").slideUp(200);
			$(this).find('i.fa').removeClass('fa-minus').addClass('fa-plus');
		}
		else{
			$(".toparea-content").addClass("active").slideDown(300);
			$(this).find('i.fa').removeClass('fa-plus').addClass('fa-minus');
		}
	});
     // Clear Input Fields value
	 $('input[type=text]').each(function() {
		var default_value = this.value;
		$(this).focus(function(){
		   if(this.value == default_value) {
		           this.value = '';
		   }
		});
		$(this).blur(function(){
		       if(this.value == '') {
		               this.value = default_value;
		       }
		});
	});
	
	jQuery('.sidenav .children').parent('li').addClass('parent');
	jQuery('.sidenav li.parent:not(.current_page_parent)').hover(
		function(){jQuery(this).find('.children').stop().slideDown('normal');},
		function(){jQuery(this).find('.children').stop().slideUp('fast');
	});
	/* ------------------------------------------------------------------------ */
	/* Image Hovers */
	/* ------------------------------------------------------------------------ */

	$(".post-image a, .post-gallery a, #portfolio-slider li a, .portfolio-image a").hover(function(){
		$(this).has('img').stop().append('<div class="overlay"></div>');
		$(this).find('.overlay').stop().animate({opacity : '1'}, 300);
	}, function(){
		$(this).find('.overlay').stop().animate({opacity : '0'}, 300 ,function(){ 
			$(this).stop().remove(); 
		});
	});

	$('.blog-item').hover(function() {
		$(this).find('.blog-overlay').stop().animate({'opacity' : 1}, 200, 'easeOutSine');
		$(this).find('.post-icon').stop().animate({'top' : 50, 'opacity' : 1}, 160, 'easeOutSine');
	}, function(){
		$(this).find('.blog-overlay').stop().animate({'opacity' : 0}, 300, 'easeInSine');
		$(this).find('.post-icon').stop().animate({'top' : -25, 'opacity' : 0}, 260, 'easeOutSine');
	});

	jQuery('a.add_to_cart_button').click(function(e) {
		var link = this;
		jQuery(link).parents('.product').find('.cart-loading').find('i').removeClass('fa-check').addClass('fa-spinner fa-spin');
		jQuery(this).parents('.product').find('.cart-loading').fadeIn();
		setTimeout(function(){
			jQuery(link).parents('.product').find('.product-images img').animate({opacity: 0.75});
			jQuery(link).parents('.product').find('.cart-loading').find('i').hide().removeClass('fa-spinner fa-spin').addClass('fa-check').fadeIn();
			setTimeout(function(){
				jQuery(link).parents('.product').find('.cart-loading').fadeOut().parents('.product').find('.product-images img').animate({opacity: 1},200);
			},1000);
		}, 1000)
			
		
	});	
	
	jQuery('li.product').hover(
		function() {if(jQuery(this).find('.cart-loading').find('i').hasClass('fa-check')) {jQuery(this).find('.cart-loading').stop().fadeIn()} },
		function() {if(jQuery(this).find('.cart-loading').find('i').hasClass('fa-check')) {jQuery(this).find('.cart-loading').stop().fadeOut()} }
	);
	
	/* ------------------------------------------------------------------------ */
	/* Back To Top */
	/* ------------------------------------------------------------------------ */

	$(window).scroll(function(){
		if($(window).scrollTop() > 200){
			$("#back-to-top").fadeIn(200);
		} else{
			$("#back-to-top").fadeOut(200);
		}
	});
	
	$('#back-to-top, .back-to-top').click(function() {
		  $('html, body').animate({ scrollTop:0 }, '800');
		  return false;
	});

	$('.toggleMenu').click(function(){
		$(this).children('i.fa').toggleClass('fa-bars fa-times');
		$('.side-navigation-overlay').toggleClass('show');
		$('aside.side-navigation.side-navigation-toggle .navbar-menu').toggleClass('show');
	});
	$(document).on('click touchstart', '.side-navigation-overlay', function(){
		$(this).removeClass('show');
		$('.toggleMenu i.fa').toggleClass('fa-bars fa-times');
		$('aside.side-navigation.side-navigation-toggle .navbar-menu').removeClass('show');
	});
	$(window).resize(function(){
		$('.side-navigation-overlay').removeClass('show');
		$('.toggleMenu i.fa').addClass('fa-bars').removeClass('fa-times');
		$('aside.side-navigation.side-navigation-toggle .navbar-menu').removeClass('show');
	});
	/*$('#side-nav-toggle li').hover(
	function(){
		if($(this).find(' > .sub-menu').is(':hidden')) {
			$(this).find(' > .sub-menu').stop().slideDown('normal');
		}
	},
	function(){$(this).find(' > .sub-menu').stop().delay(500).slideUp('normal');}
	);*/
	$('#side-nav-toggle li').hover(
	  function () {
	     $(this).children('ul.sub-menu').stop(true,true).delay(300).slideDown('medium');
	  }, 
	  function () {
	     $(this).children('ul.sub-menu').stop(true,true).delay(800).slideUp('medium');
	  }
	);
	/* ------------------------------------------------------------------------ */
});
jQuery(document).ready(function(e) {
	jQuery(document).click(function() {
        jQuery(".search-link .search-area").fadeOut('fast');
        jQuery('li.cart, li.cart-main').find('> div').stop().fadeOut('fast');
    });
    jQuery(".search-link .search-area, .cart-contents, .cart-empty").click(function (e) {
        e.stopPropagation();
        //do redirect or any other action on the content
    });    
    jQuery(".search-link a").click(function(e) {
        e.stopPropagation();
        jQuery('li.cart, li.cart-main').find('> div').stop().fadeOut('fast');
        jQuery(this).next().stop().fadeIn('fast');
    });
    jQuery("li.cart, li.cart-main").click(function(e) {
        e.stopPropagation();
        jQuery(".search-link .search-area").fadeOut('fast');
        jQuery(this).find('> div').stop().fadeIn('fast');
    });
});
/* ------------------------------------------------------------------------ */
/* EOF
/* ------------------------------------------------------------------------ */