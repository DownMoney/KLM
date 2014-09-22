{if $item_data}
<table id="currentItemInfo" class="currentItemInfo" cellspacing="0">
	<tr>
		<td class="navigationBar">{$__navigationBar__}</td>
	</tr>
	<tr><td class="sep"></td></tr>
	<tr>
		<td>
			<table class="currentItemInfoT" cellspacing="0">
				<tr>
					<td class="currentItemInfoT-i"><img src="{$__imageRoot__}/tree/{$item_data.itt_ico}.gif" align="absmiddle" alt="" /></td>
					<td class="currentItemInfoT-d">
						<h3>{$item_data.itt_name}</h3>
						{$item_data.itt_desc|strip_tags|truncate:"175"}
					</td>
					<td>&nbsp;</td>
					<td class="currentItemInfoT-t">
<small>{$item_data.itt_key}</small></td>
					<td class="currentItemInfoT-o">					
		<a href="{wt_href_tpl_link parameters="m=types&t=addType&tID=`$item_data.itt_id`&from=admin_list"}" onclick="parent.action_form_large(this.href, 'Edycja typu'); return false;" title=" edytuj "><img src="{$__imageRoot__}/edit.png" alt=" edytuj " align="absmiddle" /> edytuj</a>
				</tr>
			</table>
		</td>
	</tr>
</table>
{/if}