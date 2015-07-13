/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 * ======================================================================== */

(function($) {

  // Use this variable to set up the common and page specific functions. If you
  // rename this variable, you will also need to rename the namespace below.
  var Sage = {
    // All pages
    'common': {
      init: function() {
	     
	    // Function so window size check fires on resize event too
	    // From: http://stackoverflow.com/questions/2854407/javascript-jquery-window-resize-how-to-fire-after-the-resize-is-completed
	    
	    var waitForFinalEvent = (function() {
		  var timers = {};
		  return function(callback, ms, uniqueId) {
		    if (!uniqueId) {
		      uniqueId = "Don't call this twice without a uniqueId";
		    }
		    if (timers[uniqueId]) {
		      clearTimeout(timers[uniqueId]);
		    }
		    timers[uniqueId] = setTimeout(callback, ms);
		  };
		})();
		
		// Declare variables 
		var _w = Math.max( $(window).width(), $(window).height() );
        var mobileView = (_w <= 750);
        var largeView = (_w >= 751);    
		  
		var header_cta = $(".header_cta");
		var midbar = $(".midbar");
		var header_container = $(".header");
			
		var top_spacing = 0;
		var waypoint_offset = 1;
		
		//$('.midbar').scrollFix();
		
		//var scrollbar = (window.innerWidth-$(window).width());


	    var header_waypoint_handler = new Waypoint({		    
		      
			element: document.getElementById('header_waypoint'),
			handler: function(direction) {			  						
				
				function large_header_waypoint() {
					if (largeView) {
						if (direction === 'down') {
							header_container.css({ 'height':midbar.outerHeight() });		
							midbar.stop().addClass("stick").css("top",-midbar.outerHeight()).animate({"top":top_spacing});
						}
						if (direction === 'up') {
							header_container.css({ 'height':'auto' });
							midbar.removeClass("stick").css("top",midbar.outerHeight()+waypoint_offset).animate({"top":""});
						
						}
						
					}
				}
				

				function mobile_header_waypoint() {
					if (mobileView) {
						
						if (direction === 'down') {
						  $('div.header_hamburger_menu').addClass('stick');
						  header_container.css({ 'height':header_cta.outerHeight() });		
						  header_cta.stop().addClass("stick").css("top",-header_cta.outerHeight()).animate({"top":top_spacing});
						}
						if (direction === 'up') {
						  $('div.header_hamburger_menu').removeClass('stick');
						  header_container.css({ 'height':'auto' });
						  header_cta.removeClass("stick").css("top",header_cta.outerHeight()+waypoint_offset).animate({"top":""});
						}
					}
				}

				
				$(window).resize(function() {
				    waitForFinalEvent(function() {
					    //header_waypoint();
						large_header_waypoint();
						mobile_header_waypoint();
					}, 0);
				}).resize();
			},
		});
		
      },
      finalize: function() {
        // JavaScript to be fired on all pages, after page specific JS is fired
      }
    },
    // Home page
    'home': {
      init: function() {
	      
	    var _w = Math.max( $(window).width(), $(window).height() );
		var _h = Math.min( $(window).width(), $(window).height() );
		 
		// assume tablet view based upon display resolution
		var tabletView = (_w <= 1024);
		
		// DOn't run anything if tablet, mobile or anything touch
	  	if (tabletView || Modernizr.touch || /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) { 
		  	
		  	$('.parallax').parallax('50%', 0.4);
		  	
		} else {
			(function($) {
		        $(document).ready(function() {
		            
		        });
			})(jQuery);
		}
        
      },
      finalize: function() {
        // JavaScript to be fired on the home page, after the init JS
      }
    },
    // About us page, note the change from about-us to about_us.
    'about_us': {
      init: function() {
        // JavaScript to be fired on the about us page
      }
    }
  };

  // The routing fires all common scripts, followed by the page specific scripts.
  // Add additional events for more control over timing e.g. a finalize event
  var UTIL = {
    fire: function(func, funcname, args) {
      var fire;
      var namespace = Sage;
      funcname = (funcname === undefined) ? 'init' : funcname;
      fire = func !== '';
      fire = fire && namespace[func];
      fire = fire && typeof namespace[func][funcname] === 'function';

      if (fire) {
        namespace[func][funcname](args);
      }
    },
    loadEvents: function() {
      // Fire common init JS
      UTIL.fire('common');

      // Fire page-specific init JS, and then finalize JS
      $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function(i, classnm) {
        UTIL.fire(classnm);
        UTIL.fire(classnm, 'finalize');
      });

      // Fire common finalize JS
      UTIL.fire('common', 'finalize');
    }
  };

  // Load Events
  $(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.
