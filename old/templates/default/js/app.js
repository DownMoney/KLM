function toggle(id,parent)
{
	/*
	$(".shownDescription").slideUp("slow").removeClass('.shownDescription');
	$("div#"+id).slideToggle("slow").addClass('shownDescription');
	*/
	if (parent==true)
	{
    var par_id = $("div#"+id).parent('div.slideContent');
    $("div.slideChild:not(div#"+id+")").slideUp();
    $("div.slideContent").not(par_id).slideUp();
  }
	else
    $("div.slideContent:not(div#"+id+")").slideUp();

	$("div#"+id).slideToggle("slow");
}
