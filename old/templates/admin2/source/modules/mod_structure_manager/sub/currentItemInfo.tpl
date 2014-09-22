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
					<td class="currentItemInfoT-i">{wt_thumb_image 	
		src="mod_structure/`$item_data.it_id`/`$item_data.it_logo`"  
		width="50"
		height="30"
		compress="75"
		show_blank="1"}</td>
					<td class="currentItemInfoT-d">
						<h3>{$item_data.it_name}</h3>
						{if $item_data.it_desc}
						{$item_data.it_desc|strip_tags|truncate:"175"}<br />
						{/if}
						<b>Adres WWW:</b> <input type="text" value="{wt_href_tpl_link mod_key="mod_structure" parameters="t=iP&cPath=`$item_data.cPath`" full_url=true}" /> <a href="{wt_href_tpl_link mod_key="mod_structure" parameters="t=iP&cPath=`$item_data.cPath`"}" target="_blank">przejdź &raquo;</a>
					</td>
					<td>&nbsp;</td>
					<td class="currentItemInfoT-t"><img src="{$__imageRoot__}/tree/{$item_data.itt_ico}_s.gif" align="absmiddle" alt="" /><br />
<small>{if $__isRoot__}<a href="{wt_href_tpl_link parameters="m=fields&tID=`$item_data.it_type`"}">{$item_data.itt_name}</a>{else}{$item_data.itt_name}{/if}</small></td>
{if $item_data.itt_root_edit == "0" || $__isRoot__}
					<td class="currentItemInfoT-o">
					  <a href="{wt_href_tpl_link parameters="m=items&t=moveItem&cPath=`$item_data.cPath`&iID=`$item_data.it_id`"}" onclick="parent.action_form(this.href, 'Przenieś wpis'); return false;" title=" przenieś "><img src="{$__imageRoot__}/move.png" alt="przenieś wpis" align="absmiddle" /> przenieś</a>	
		<a href="{wt_href_tpl_link parameters="m=items&t=addItem&cPath=`$item_data.cPath`&cID=`$smarty.get.cID`&iID=`$item_data.it_id`&from=admin_list"}" onclick="parent.action_form_large(this.href, 'Edycja wpisu{if $__languagesCurLanguage__} - język: {$__languagesCurLanguage__.name}{/if}'); return false;" title=" edytuj "><img src="{$__imageRoot__}/edit.png" alt=" edytuj " align="absmiddle" /> edytuj</a>
		<a href="#" onClick="parent.action_form('{wt_href_tpl_link mod_key="mod_structure_manager" parameters="m=items&t=deleteItem&cID=`$smarty.get.cID`&iID=`$item_data.it_id`&cPath=`$item_data.cPath`"}', 'Usuń wpis')" title=" usuń "><img src="{$__imageRoot__}/trash.png" alt=" usuń " align="absmiddle" /> usuń</a></td>
{/if}
				</tr>
			</table>
		</td>
	</tr>
</table>
{/if}