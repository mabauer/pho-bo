
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
		enquire.register("screen and (min-width:880px)", {

			// Triggered when a media query matches.
			match : function() {
				$portfolio.masonry({
					columnWidth: '.portfolio-element',
					itemSelector: '.portfolio-element',
					// gutter: 40, // the widgets introduce some spacing on their own.
					isFitWidth: false,
					isAnimated: true
				});
				$portfolio.imagesLoaded(function() {
					$portfolio.masonry();	
				});
			},      

			// Triggered when the media query transitions 
			// *from a matched state to an unmatched state*.
			unmatch : function() {
				$portfolio.masonry('destroy');
			}   
		
		}); 
    }
});