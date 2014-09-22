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
					<td class="currentItemInfoT-d">
						<h3>{$item_data.fi_name}</h3>
						{$item_data.fi_desc|strip_tags|truncate:"175"}<br />
					</td>
					<td>&nbsp;</td>	  
					<td class="currentItemInfoT-o">					  
		<a href="{wt_href_tpl_link parameters="m=fields&t=addField&pID=`$smarty.get.pID`&fID=`$item_data.it_id`&from=admin_list"}" onclick="parent.action_form_large(this.href, 'Edycja pola{if $__languagesCurLanguage__} - język: {$__languagesCurLanguage__.name}{/if}'); return false;" title=" edytuj "><img src="{$__imageRoot__}/edit.png" alt=" edytuj " align="absmiddle" /> edytuj</a>
				</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
{/if}