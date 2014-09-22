{input name="action"} 
{input name="iID"}
{input name="fID"}
{input name="cID"}

<div id="action_window">
<a style="float: right" href="#" onclick="hide_action_form(); return false"><img src="{$__imageRoot__}/close_dialog.gif" alt="" /></a>	
<h1 id="action_window_title">
	Dodawanie zdjęcia</h1>
	<div id="action_window_content">
		{label for="fi_image"}
		{input name="fi_image"}<br /><br />
	
 		{label for="fi_url"}
		{input name="fi_url"} 
	</div>

	<div id="action_window_buttons">
		{input name="close_button"}&nbsp;{input name="submit_button_aw"}&nbsp;{input name="doit"}
	</div>
</div>