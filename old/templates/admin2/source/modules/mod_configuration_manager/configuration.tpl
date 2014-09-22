<script type="text/javascript">
{literal}
Event.observe(window, 'load', function() { new ADM_TableNavigation() });
Event.observe(window, 'load', function() { Interface.setDataTableDim(); });

var tableList = new ADM_TableList({
{/literal}
statusChangeType: 'full',
imageRoot: '{$__imageRoot__}/icons_large/',
itemInfoURL: '{wt_href_tpl_link mod_key="mod_configuration_manager" parameters="m=configuration&t=configurationInfo&cID="}',
delURL: '{wt_href_tpl_link mod_key="mod_configuration_manager" parameters="a=delConfiguration&from=admin_list&cID="}'
{literal} 
});

makeListOperation = function(o) {

	if( o.value == '' ) {
		return;
	}
	
	list_elems =	document.getElementsByClassName('rowCheckbox');	
	selected_rows = new Array();
		for(i=0; i<list_elems.length;i++) {
			if(list_elems[i].type == 'checkbox' && list_elems[i].checked == true && list_elems[i].value > 0 ) {
				selected_rows.push(list_elems[i].value);
			}
		}
	selected_rows = selected_rows.compact();
	
	if( selected_rows.length == 0 ) {
		alert('Musisz coś zaznaczyć');
		return;
	}
	
	if( !confirm('Potrzebne potwierdzenie, jesteś pewien, że chcesz wykonać operację ?') ) {
		return;
	}
	
	if(o.value == 'del' && !confirm('Potrzebne ostateczne potwierdzenie, jesteś pewien, że chcesz usunąć zaznaczone rekordy ?\n\n PAMIĘTAJ USUWANIE JEST NIEODWRACALNE, NA TRWALE STRACISZ WSZYSTKIE USUWANE DANE !') ) {
		return; 
	}
	
	for(i=0; i<selected_rows.length;i++) {
	switch( o.value ) {
		case 'del':
			tableList.delRowItem(selected_rows[i], true);
		break;
	}	
	}
}
{/literal}
</script>

<table class="cT">
<tr>
<td class="cTO" id="cTO">

<table>
	<tr>
		<td class="listSelectMark">
			<b>Zaznaczone:</b>
			<select name="listOperation" id="listOperation" onChange="makeListOperation(this);">
				<option value="">--- wybierz ---</option>
				<option value="del">usuń</option>
			</select>
		</td>
		<td class="listOpenClose">
			<b>wszystkie:</b>
			<a href="#" onClick="tableList.openCloseRowItems('all', false); return false">otwórz</a>, <a href="#" onClick="tableList.openCloseRowItems('all', true); return false">zamknij</a>
		</td>
		<td class="listMark">
			<b>Zaznacz:</b>
				<a href="#" onClick="tableList.setReverseRowChecked(); return false">odwrotnie</a>
			</td>
			<td class="listSearch">
				<form action="{wt_href_tpl_link parameters="t=searchConfiguration"}">
					<input name="mod" value="{wt_mod_id m=mod_configuration_manager}" id="mod" type="hidden">
					<input name="m" value="configuration" id="m" type="hidden">
					<input name="t" value="searchConfiguration" id="t" type="hidden">
					<b>Szukaj:</b>
					<input type="text" name="gSearch" value="{$smarty.get.gSearch}" /> 
				</form>
			</td>
	</tr>
</table>

</td>
</tr>

<tr><td>
<table class="dT" cellpadding="0" cellspacing="0">
<tr class="dTH">
<td width="10" class="dT-ch{if $smarty.session.sort_orders.configuration == 0} sortSelected{/if}"><input type="checkbox" onClick="tableList.setALLRowChecked(this.checked);" class="checkbox" /> {wt_admin_sort_order i=0 c=$smarty.session.sort_orders.configuration}</td>
<td {if $smarty.session.sort_orders.configuration == 1}class="sortSelected"{/if} width="200">Nazwa
{wt_admin_sort_order i=1 c=$smarty.session.sort_orders.configuration}
</td>

<td {if $smarty.session.sort_orders.configuration == 2 || $smarty.session.sort_orders.configuration == 3}class="sortSelected"{/if}>Klucz
{wt_admin_sort_order i=2 c=$smarty.session.sort_orders.configuration}
 / Wartość
{wt_admin_sort_order i=3 c=$smarty.session.sort_orders.configuration}</td>

<td class="dTOp">Opcje</td>
<![if !IE]>
<td width="13"></td>
<![endif]>
</tr>
<tbody id="data_table_content">
{if $configuration_listing}
{foreach item=conf from=$configuration_listing name="configuration_listing"}

<tr id="row_{$conf.configuration_id}" class="dTR" onmouseover="this.className='dTRO';" onmouseout="this.className='dTR'" onClick="tableList.setRowClick('{$conf.configuration_id}', this);" ondblclick="parent.action_form_large('{wt_href_tpl_link parameters="m=configuration&t=addConfiguration&cID=`$conf.configuration_id`&from=admin_list"}', 'Edycja wpisu'); return false;">

<td class="dT-ch{if $smarty.session.sort_orders.configuration == 0} sortSelected{/if}" width="20"><nobr><input type="checkbox" onCLick="tableList.setRowClick('{$conf.configuration_id}', this); tableList.setRowChecked('{$conf.configuration_id}');" id="row_checkbox_{$conf.configuration_id}" class="rowCheckbox" value="{$conf.configuration_id}" /> <a href="#" onClick="tableList.loadRowItemInfo('{$conf.configuration_id}'); return false"><img id="row_make_info_{$conf.configuration_id}" src="{$__imageRoot__}/icons_large/plus.gif" alt="" align="absmiddle" /></a></nobr></td> 

<td {if $smarty.session.sort_orders.configuration == 1}class="sortSelected"{/if} style="width:100px !important;">{$conf.configuration_title}</td>
<td class="{if $smarty.session.sort_orders.configuration == 2 || $smarty.session.sort_orders.configuration == 3}>sortSelected{/if}"><b>{$conf.configuration_key}</b><br />
<small>{$conf.configuration_value|truncate:70}</small></td>
<td class="dTOp">
<nobr>
<a href="{wt_href_tpl_link parameters="m=configuration&t=addConfiguration&cID=`$conf.configuration_id`&from=admin_list"}" onclick="parent.action_form_large(this.href, 'Edycja wpisu'); return false;" title=" edytuj "><img src="{$__imageRoot__}/edit.png" alt=" edytuj " border="0" width="16" height="16"></a>
<a href="#" onClick="tableList.delRowItem('{$conf.configuration_id}'); return false" title=" usuń "><img src="{$__imageRoot__}/trash.png" alt=" usuń" border="0" width="16" height="16"></a>
</nobr>
</td>
<![if !IE]>
<td width="13">&nbsp;</td>
<![endif]>
</tr>
</tr>
{/foreach}
{else}
<tr>
<td colspan="8" align="center" height="100%" valign="middle">BRAK REKORDÓW W BAZIE</td>
</tr>
{/if}
</tbody>
</table> 
</td></tr>
<tr class="dTFR">
<td>
<table class="dTFRC">
<tr>
<td >{$number_of_rows_text}</td>
<td>{$display_to_display}</td>
<td align="right">{$number_of_rows_links}</td>
</tr>
</table>
</td>
</tr>
</table>