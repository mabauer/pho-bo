jQuery(function($){
   /*
    * Handles page loading indicator
    */

    $(window).load(function() {
        $('.progress-indicator .endless').each(function() {
            $(this).hide();
            // $(this).css('animation', 'fadeout 0.2s');
        });
        $('.content-area').each(function() {
            $(this).css('opacity', '1');
        });
    });
});
