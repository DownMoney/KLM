

$( document ).ready(function() {
	if(detectmob())
	{	
		$('nav').css('position', 'absolute');
		$('div.menu a').css('font-family', 'Helvetica');
		$('div.menu a').css('font-size', '40px');
		$('nav').css('height', '180px');
	}
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

//alert(detectmob());

window.onresize = function(event) {
   $('div.carousel').css('height', $(window).height()-50);
	$('div.item').css('height', $(window).height()-50);
}

function detectmob() { 
 if( navigator.userAgent.match(/Android/i)
 || navigator.userAgent.match(/webOS/i)
 || navigator.userAgent.match(/iPhone/i)
 || navigator.userAgent.match(/iPad/i)
 || navigator.userAgent.match(/iPod/i)
 || navigator.userAgent.match(/BlackBerry/i)
 || navigator.userAgent.match(/Windows Phone/i)
 ){
    return true;
  }
 else {
    return false;
  }
}
