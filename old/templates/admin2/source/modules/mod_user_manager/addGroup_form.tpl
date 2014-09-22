{input name="action"} 
{input name="submit_type"}
{input name="parent_id"}
{if $action == "edit"}
{input name="gID"}
{/if}


<table cellpadding="0" cellspacing="0" width="100%" height="100%" class="eL">
<tr>
<td colspan="2" class="mT-m2 eL_h">

<div class="eL_but">{input name="submit_button"} {input name="save_close_button"} {input name="cancel_button"}
</div>

</td>
</tr>

<tr>

<td class="eL_nav"><a href="#" class="offtab" onClick="addGroupTab.cycleTab(this.id); return false" id="tab1">Ogólne</a>
</td>

<td class="eL_form" valign="top"><div id="eL_form"><div class="eL_formC">

<div class="hide" id="page1">
<h1>[OGÓLNE]</h1>

{label for="group_default"}{input name="group_default"}
{label for="group_name"}{input name="group_name"}
{label for="group_desc"}{input name="group_desc"}
</div>

</div></div></td>

</tr>

</table>