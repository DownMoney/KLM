{input name="mod"}
{input name="m"}
{input name="t"}
{input name="tFile"}
<table class="main" width="100%">
<tr>
<td>{label for="mod_id"} {input name="mod_id"}</td>
</tr>
<tr>
<td>
<table width="100%">
<tr>
{foreach from=$columns_list item=color key=id name=columns_list}
<td bgcolor="{$color}" class="verdana12" style="color: #FFFFFF;">{input name="col_id_`$id`"} <b>{label for="col_id_`$id`"}</b></td>

{if $smarty.foreach.columns_list.iteration%8 == "0"}
</tr><tr>
{/if}
{/foreach}
</tr>
</table>

</td>
</tr>
<tr><td>{input name="submit_button"}</td></tr>
</table>
