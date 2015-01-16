// Masonry settings to organize footer widgets
jQuery(document).ready(function($){
    var $container = $('#footer-widgets');
    enquire.register("screen and (min-width:800px)", {

        // Triggered when a media query matches.
        match : function() {
            $container.masonry({
                columnWidth: '.widget',
                itemSelector: '.widget',
                // gutter: 40, // the widgets introduce some spacing on their own.
                isFitWidth: false,
                isAnimated: true
            });
            $container.imagesLoaded(function() {
  				$container.masonry();	
			});
        },      

        // Triggered when the media query transitions 
        // *from a matched state to an unmatched state*.
        unmatch : function() {
            $container.masonry('destroy');
        }   
        
    }); 
});