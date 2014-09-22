{input name="action"} 
{input name="iID"}
{input name="cPath"}
{input name="ca_id"}

<div id="action_window">
<h1 id="action_window_title">
<a href="#" onclick="hide_action_form(); return false"><img src="{$__imageRoot__}/close_dialog.gif" alt="" /></a>

Przenoszenie: {if $item}{$item.it_name}{else}wiele wpisów{/if}</h1>

<div id="action_window_content" class="eL_form">
{label for="parent_id"} {input name="parent_id"}

<style type="text/css">
{literal}
#parent_id { width: 500px; }
{/literal}
</style>

</div>

<div id="action_window_buttons">
{input name="cancel_button"}&nbsp;{input name="submit_button"}&nbsp;{input name="doit"}
</div>

</div>