
jQuery(document).ready(function($){

	// Masonry settings to organize footer widgets
    var $footer = $('#footer-widgets');

    var relayoutFooterWidgets = function () {
        $footer.masonry('layout');
    }

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
            $footer.imagesLoaded().progress(function() {
  				$footer.masonry('layout');
			});


            $(window).on('resize', relayoutFooterWidgets);
            $(document).on('imageCropped', relayoutFooterWidgets);
        },

        // Triggered when the media query transitions
        // *from a matched state to an unmatched state*.
        unmatch : function() {
            $footer.masonry('destroy');
            $(window).off('resize', relayoutFooterWidgets);
            $(document).off('imageCropped', relayoutFooterWidgets);
        }

    });

    // Masonry settings to layout posts in DPE's flexible_posts widget in the widget area
    var $flexible_posts = $('.widget-area .dpe-flexible-posts');
    if ($flexible_posts.length > 0) {

        var relayoutPostsWidget = function (event, img) {
            if (event.type == 'resize') {
                $flexible_posts.masonry('layout');
            }
            else {
                if ($(img).closest($flexible_posts).length > 0) {
                    // Instead of calling $flexible_posts.masonry('layout') directly, we need a short delay
                    setTimeout( function () {$flexible_posts.masonry('layout');}, 100);
                }
            }
        }

        enquire.register("screen and (min-width:600px)", {

            // Triggered when a media query matches.
            match : function() {
                $flexible_posts.masonry({
                    columnWidth: 'li',
                    itemSelector: 'li',
                    gutter: 20,
                    isFitWidth: false,
                    isAnimated: false,
                });
                $flexible_posts.imagesLoaded().progress(function() {
                    $flexible_posts.masonry('layout');
                });

                $(window).on('resize', relayoutPostsWidget);
                $(document).on('imageCropped', relayoutPostsWidget);
            },
            // Triggered when the media query transitions
            // *from a matched state to an unmatched state*.
            unmatch : function() {
                $(window).off('resize', relayoutPostsWidget);
                $(document).off('imageCropped', relayoutPostsWidget);
                $flexible_posts.masonry('destroy');

            }

        });
    }

    // Masonry settings to organize the portfolio
    var $portfolio = $('.portfolio-grid');
	if ($portfolio.length > 0) {

        var relayoutPortfolio = function () {
            $portfolio.isotope();
        }

		enquire.register("screen and (min-width:600px)", [{

			// Triggered when the media query matches.
			match : function() {
                var $portfolio_items = $('.portfolio-grid .portfolio-element').detach();

                $portfolio.isotope({
                    columnWidth: '.portfolio-element',
                    itemSelector: '.portfolio-element',
                    layoutMode: 'fitRows',
                    getSortData: {
                        title: '.entry-title a',
                        published: function( itemElem ) {
                            var $published = $( itemElem ).find('time.published')
                            var date = $published.attr("datetime");
                            return date ;
                        },
                    },
                    sortBy: 'published',
                    sortAscending: false,
                });

                if ( $('.portfolio-element').length == 0 ) {
                    $portfolio_items.hide();
                    $portfolio.append($portfolio_items);
                }

                $portfolio_items.imagesLoaded().progress(function(instance, image) {
			        var $img = $(image.img);
                    var $thumb = $img.closest('.portfolio-thumb');
                    $item = $img.parents('.portfolio-element');
                    $item.show();
                    $portfolio.isotope('appended', $item);
                    $portfolio.isotope();
                });

                /*
                $portfolio_items.imagesLoaded( function() {
                    $portfolio_items.each(function () {
                        $(this).show();
                        $portfolio.masonry('appended', $(this));
                        $portfolio.masonry();
                    });
                });
                */

                $(window).on('resize', relayoutPortfolio);
                $(document).on('imageCropped', relayoutPortfolio);

			},

			// Triggered when the media query transitions
			// *from a matched state to an unmatched state*.
            // Remove masonry and reset height of portfolio boxes
			unmatch : function() {
				$portfolio.isotope('destroy');

                // TODO: Remove resize-handler
                $(window).off('resize', relayoutPortfolio);
                $(document).off('imageCropped', relayoutPortfolio);

			}

		}]);
    }

});
