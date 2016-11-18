jQuery(document).ready(function (e) {
    jQuery('.hovercard').hover(function() {
        jQuery(this).stop(true, false).show();
        }, function() {
            jQuery('.hovercard').hide();
        });
        jQuery('a[rel="hovercard"]').hover(function() {
           
            jQuery(this).children('.hovercard').delay(100).fadeIn();
        }, function() {
            jQuery(this).children('.hovercard').delay(100).fadeOut('fast');
    });
    
    jQuery('a').click(function() {
        if ( jQuery(this).attr("href") == "#" ) {
            return false;
        }
    });
    
    function statWhatpulse (array) {
        jQuery(this).closest("span .stats").text(array[0]);
    } 
});