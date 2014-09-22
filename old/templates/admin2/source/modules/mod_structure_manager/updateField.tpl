{if $field_data.fi_type == "select"}

{if $field_data.fi_gr != ""}
	 {assign var="field_id" value="fi_`$field_data.fi_gr`"}
{else}
	{assign var="field_id" value="fi_`$field_data.fi_id`"}
{/if}

<select name="fi[{$field_data.fi_id}]" id="{$field_id}" class="t3" {if $field_data.fi_type == "multi_select"} multiple="multiple" size="5"{/if}>
<option value="" selected="selected"> --- wybierz ---</option>
{foreach from=$fields_listing item=fi}
<option value="{$fi.fi_id}">{$fi.fi_name}</option>
{/foreach}
</select>

{if $field_data.fi_depends_on}
<script type="text/javascript">
	updateDependsField{$field_data.fi_id}();
</script>
{/if}
{/if}

{if $field_data.fi_type == "multi_select"}
<table cellspacing="0" cellpadding="0">
{foreach from=$fields_listing item="fit"}
	<tr onclick="setIt2ItRowClick{$field_data.fi_id}(this);" class="{cycle values="row1,row2"} {if (is_array($fields_value.$fiid) && in_array($fit.fi_id, $fields_value.$fiid))} sel{/if}">
		<td class="ch">
				<input type="checkbox"  onclick="setIt2ItRowClick{$field_data.fi_id}(this); setIt2ItRowChecked{$field_data.fi_id}(this);" name="fi[{$field_data.fi_id}][]" value="{$fit.fi_id}" {if is_array($fields_value.$fiid) && in_array($fit.it_id, $fields_value.$fiid)} checked="checked"{/if} />
		</td>
		<td class="d">{$fit.fi_name}</td>
	</tr>
{foreachelse}
	<tr class="row2"><td colspan="2" align="center">brak opcji</td></tr>
{/foreach}
</table>
{/if}


{if $field_data.fi_type == "multi_select_group"}
<script type="text/javascript">
alert('Musisz przeładować formularz żeby zobaczyć zmiany !!!');
</script>
{/if}
