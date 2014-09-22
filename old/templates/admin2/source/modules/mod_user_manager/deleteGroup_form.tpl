{input name="action"} 
<div id="action_window">
<h1 id="action_window_title">
<a href="#" onclick="hide_action_form(); return false"><img src="{$__imageRoot__}/close_dialog.gif" alt="" /></a>

Usuwanie grupy</h1>

<div id="action_window_content">
<b>UWAGA:</b><br />
Grupa jak i wszystkie podgrupy zostaną <span class="Alert">bezpowrotnie usunięte.
<br />

<b>W sumie usuniętych zostanie:</b><br>
{if $groups_to_delete}
{foreach from=$groups_to_delete item=group_id}
{input name="group_id_`$group_id`"}
{/foreach}
 - <span class="Alert">{$count_groups}</span> grup<br>
{/if}

</div>

<div id="action_window_buttons">
{input name="cancel_button"}&nbsp;{input name="submit_button"}&nbsp;{input name="doit"}
</div>

</div>