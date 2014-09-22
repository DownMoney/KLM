<table style="width: 100%" class="EditTable">
<tr><td class="AdminFormButtons">
{hiddeninput name="action"} 
{if $action == "edit"}
{hiddeninput name="mID"}
{/if}


{input name="cancel_button"}&nbsp;{input name="reset_button"}&nbsp;{input name="submit_button"}
</td></tr>
<tr>
<td align="center" style="padding: 0px;">
<table align="center" class="AdminFormSaveOptionsTable" cellpadding="5" cellspacing="0">
<tr>
<td> 
{input name="action_save"} {label for="action_save"}<br>
</td> 
<td valign="middle" style="padding: 0px 25px;"><b>Oraz</b></td>
<td>
{input name="action_after_main"} {label for="action_after_main"}<br>
{input name="action_after_add_new"} {label for="action_after_add_new"}
<br>
{input name="action_after_edit"} {label for="action_after_edit"}
</td>
</tr>
</table>
</td></tr>
<tr><td><br> 
<div class="pagetext" id="page1"> 

<table class="adminForm">
<tr><td colspan="2" class="AdminFormHeading">Ogólne</td></tr>
<tr>
<td class="AdminFormTitle">{label for="menu_name"}</td>
<td>{input name="menu_name"}</td>
</tr>
<tr>
<td class="AdminFormTitle">{label for="menu_title"}</td>
<td>{input name="menu_title"}</td>
</tr>
<tr>
<td class="AdminFormTitle">{label for="menu_desc"}</td>
<td>{input name="menu_desc"}</td>
</tr>

<tr><td colspan="2" class="AdminFormHeading">Dostêp</td></tr>
<tr>
<td class="AdminFormTitle" style="vertical-align: top;">{label for="access"}</td>
<td>{input name="access"}</td>
</tr>
 
</table>

</div>

</td></tr>

<tr><td class="AdminFormButtons">
{input name="cancel_button"}&nbsp;{input name="reset_button"}&nbsp;{input name="submit_button"}&nbsp;{input name="doit"}
</td></tr>
</table>