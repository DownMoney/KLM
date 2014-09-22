<div id="action_window">
<h1 id="action_window_title">
<a href="#" onclick="hide_action_form(); return false"><img src="{$__imageRoot__}/close_dialog.gif" alt="" /></a>
{if $action == "edit"}
Edycja grupy
{else}
Nowa grupa
{/if}

</h1>

<div id="action_window_content" class="eL_form">
{input name="action"} 

{if $action == "edit"}
{input name="gID"} 
{/if}
{label for="gr_name"}
{input name="gr_name"}

{label for="gr_desc"}
{input name="gr_desc"}

</div>
<div id="action_window_buttons">

{input name="cancel_button"}&nbsp;{input name="reset_button"}&nbsp;{input name="submit_button"}

</div></div>