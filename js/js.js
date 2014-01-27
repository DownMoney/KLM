

$( document ).ready(function() {
  	$('div.carousel').css('height', $(window).height()-50);
	$('div.item').css('height', $(window).height()-50);
  	$('div.carousel').fadeIn(1000, function(){
		$('nav').show('blind', 300);
	});

	$('.carousel').carousel({
  interval: 3000
});
	//
});

window.onresize = function(event) {
   $('div.carousel').css('height', $(window).height()-50);
	$('div.item').css('height', $(window).height()-50);
}