
jQuery(document).ready(function($){

	// Masonry settings to organize footer widgets
    var $footer = $('#footer-widgets');
    enquire.register("screen and (min-width:800px)", {

        // Triggered when a media query matches.
        match : function() {
            $footer.masonry({
                columnWidth: '.widget',
                itemSelector: '.widget',
                // gutter: 40, // the widgets introduce some spacing on their own.
                isFitWidth: false,
                isAnimated: true
            });
            $footer.imagesLoaded(function() {
  				$footer.masonry();
			});
        },

        // Triggered when the media query transitions
        // *from a matched state to an unmatched state*.
        unmatch : function() {
            $footer.masonry('destroy');
        }

    });

    // Masonry settings to organize the portfolio
	var $portfolio =$('.portfolio-grid');

	if ($portfolio.length > 0) {

        var refresh_portfolio = function() {
            // Enforce square pictures by setting the height...
            size = parseInt($('.portfolio-element').css('width'), 10)
                 - parseInt($('.portfolio-element').css('padding-top'), 10)
                 - parseInt($('.portfolio-element').css('padding-bottom'), 10);
            $('.portfolio-element').each(function(){
                $elem = $(this);
                $elem.height(size);
            });

            // ...and letting masonry figuring out the width during layouting
            $portfolio.masonry({
				columnWidth: '.portfolio-element',
				itemSelector: '.portfolio-element',
				// gutter: 40, // the widgets introduce some spacing on their own.
				isFitWidth: false,
				isAnimated: true
			});
        }


		enquire.register("screen and (min-width:880px)", [{

			// Triggered when a media query matches.
			match : function() {
                refresh_portfolio();

                // Resizing the browser leads to a new layout
                $(window).resize(refresh_portfolio);

			},

			// Triggered when the media query transitions
			// *from a matched state to an unmatched state*.
            // Remove masonry and reset height of portfolio boxes
			unmatch : function() {
				$portfolio.masonry('destroy');
                $('.portfolio-element').each(function(){
                    $elem = $(this);
                    $elem.css('height', 'auto');
                });
                $(window).off('resize', refresh_portfolio);
			}

		}]);
    }
});
