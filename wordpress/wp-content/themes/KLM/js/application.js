
jQuery(window).resize(function(){
    jQuery('#menu').addClass('menu');
    jQuery('#menu').removeClass('text-center');
});

jQuery('.navbar-collapse').on('show.bs.collapse', function () {
    jQuery('#menu').removeClass('menu');
    jQuery('#menu').addClass('text-center');
});