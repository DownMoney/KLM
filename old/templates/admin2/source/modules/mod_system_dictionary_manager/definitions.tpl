<table class="cT">
<tr>
<td class="cTO" id="cTO">

<table>
	<tr>
		<td class="listSelectMark">
			
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
		</td>
	</tr>
</table>

</td>
</tr>

<tr><td>
<table class="dT" cellpadding="0" cellspacing="0">
<tr class="dTH">
<td width="10"><input type="checkbox" onClick="tableList.setALLRowChecked(this.checked);" class="checkbox" /></td>
<td width="20" {if $smarty.session.sort_orders.definitions == 0}class="sortSelected"{/if}># 
{wt_admin_sort_order i=0 c=$smarty.session.sort_orders.definitions}
</td>
<td {if $smarty.session.sort_orders.definitions == 1}class="sortSelected"{/if}>Nazwa
{wt_admin_sort_order i=1 c=$smarty.session.sort_orders.definitions}
</td>
<td {if $smarty.session.sort_orders.definitions == 2}class="sortSelected"{/if} align="center">Klucz
{wt_admin_sort_order i=2 c=$smarty.session.sort_orders.definitions}
</td>
<td {if $smarty.session.sort_orders.definitions == 3}class="sortSelected"{/if} align="center">Klucz modułu
{wt_admin_sort_order i=3 c=$smarty.session.sort_orders.definitions}
</td>
<td {if $smarty.session.sort_orders.definitions == 4}class="sortSelected"{/if} align="center">Dział
{wt_admin_sort_order i=4 c=$smarty.session.sort_orders.definitions}
</td>
<td align="right">Opcje</td>
<td width="17"></td>
</tr>
<tbody id="data_table_content">
{if $definitions_listing}
{foreach item=def from=$definitions_listing name="definitions_listing"}

<tr id="row_{$def.dc_id}" class="dTR" onmouseover="this.className='dTRO';" onmouseout="this.className='dTR'">

<td><input type="checkbox" onCLick="tableList.setRowChecked('{$def.dc_id}');" id="row_checkbox_{$def.dc_id}" class="rowCheckbox" value="{$def.dc_id}" /></td>
<td {if $smarty.session.sort_orders.definitions == 0}class="sortSelected"{/if} width="20"><nobr><a href="#" onClick="tableList.loadRowItemInfo('{$def.dc_id}'); return false"><img id="row_make_info_{$def.dc_id}" src="{$__imageRoot__}/plus.gif" width="11" height="11" alt="" align="absmiddle" /></a> <img id="row_type_img_{$def.dc_id}" src="{$__imageRoot__}/doc.png" width="16" height="16" align="absmiddle" alt="" />&nbsp;[{$def.dc_id|default:"&nbsp;"}]&nbsp;</nobr></td>

<td {if $smarty.session.sort_orders.definitions == 1}class="sortSelected"{/if}>{$def.dc_name}</td>
<td align="center" {if $smarty.session.sort_orders.definitions == 2}class="sortSelected"{/if}>
{$def.dc_key}
</td>
<td {if $smarty.session.sort_orders.definitions == 3}class="sortSelected"{/if} >{$def.mod_key}</td>
<td {if $smarty.session.sort_orders.definitions == 4}class="sortSelected"{/if} >{$def.dc_section}</td>

<td align="right">
<nobr>
<a href="{wt_href_tpl_link get_params="m|t|dID|from" parameters="m=dictionary&t=addDefinition&dID=`$def.dc_id`&from=admin_list"}" onclick="parent.action_form_large(this.href, 'Edycja wpisu'); return false;" title=" edytuj "><img src="{$__imageRoot__}/edit.png" alt=" edytuj " border="0" width="16" height="16"></a>
<a href="#" onClick="tableList.delRowItem('{$def.dc_id}'); return false" title=" usuń "><img src="{$__imageRoot__}/trash.png" alt=" usuń" border="0" width="16" height="16"></a>
</nobr>
</td>
<td width="17">&nbsp;</td>
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
<td>{$number_of_rows_links}</td>
</tr>
</table>
</td>
</tr>
</table>

<script type="text/javascript">
Interface.setDataTableDim();

Event.observe(window, 'load', new ADM_TableNavigation());

{literal}
var tableList = new ADM_TableList({
{/literal}
statusChangeType: 'full',
imageRoot: '{$__imageRoot__}',
itemInfoURL: '{wt_href_tpl_link mod_key="mod_system_dictionary_manager" parameters="m=dictionary&t=definitionInfo&dID="}',
delURL: '{wt_href_tpl_link mod_key="mod_system_dictionary_manager" parameters="a=delDefinition&from=admin_list&dID="}'
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