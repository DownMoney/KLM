

$( document ).ready(function() {
  $('div.jumbotron').css('height', $(window).height()-50);
	$('div.jumbotron').fadeIn(1000, function(){
		$('nav').show('blind', 300);
	});
	//
});