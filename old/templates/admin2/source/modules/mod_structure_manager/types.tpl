<script type="text/javascript">

var prInfoHint = 'Kliknij aby zobaczyć szczegółowe informacje o elemencie.';
var prItemsHint = 'Kliknij aby zobaczyć elementy podrzędne.';

var prSODownHint = 'Kliknij aby przenieść element jedną pozycję niżej.';
var prSOUpHint = 'Kliknij aby przenieść element jedną pozycję wyżej.';
var prSOTopHint = 'Kliknij aby przenieść element na pierwszą pozycję.';
var prSOBottomHint = 'Kliknij aby przenieść element na ostatnią pozycję.';

var prMoveHint = 'Kliknij aby przenieść element.';
var prEditHint = 'Kliknij aby edytować element.';
var prDelHint = 'Kliknij aby całkowicie usunąć element z serwisu.';

{literal}
Event.observe(window, 'load', function() { Interface.setDataTableDim() });

var tableList = new ADM_TableList({
{/literal}
statusChangeType: 'base',
imageRoot: '{$__imageRoot__}/icons_large/',
page: '{$smarty.get.page|default:1}',
delURL: '{wt_href_tpl_link mod_key="mod_structure_manager" parameters="a=delType&tID="}'
{literal} 
});
makeListOperation = function(o) {
	
	var action = o.value;
	o.selectedIndex = 0;
	
	if( action == '' ) {
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
	
	if(action == 'del' && !confirm('Potrzebne ostateczne potwierdzenie, jesteś pewien, że chcesz usunąć zaznaczone rekordy ?\n\n PAMIĘTAJ USUWANIE JEST NIEODWRACALNE, NA TRWALE STRACISZ WSZYSTKIE USUWANE DANE !') ) {
		return; 
	}
	
	for(i=0; i<selected_rows.length;i++) {
		switch( action ) {
			case 'status0':
				tableList.setRowItemStatus(selected_rows[i], '0');
			break;	
			case 'status1':
				tableList.setRowItemStatus(selected_rows[i], '1');
			break;
			
		}
	}

var selected_rows_string = selected_rows.toString();


{/literal} var base_url = '{wt_href_tpl_link mod_key="mod_structure_manager" parameters="m=items&cPath=`$smarty.get.cPath`"}';{literal}

	switch( action ) {
		case 'move':
			parent.action_form(base_url+'&t=moveItem&iID='+selected_rows_string, 'Przenieś wpisy');
		break;
		case 'del':
			parent.action_form(base_url+'&t=deleteItem&iID='+selected_rows_string, 'Usuń wpisy');
			break;
	}


}

{/literal}
</script>

<table id="currentItemInfo" class="currentItemInfo" cellspacing="0">
	<tr>
		<td class="navigationBar">{$__navigationBar__}</td>
	</tr>
	<tr><td class="sep"></td></tr>
</table>

<table class="cT" style="border-top: 1px solid #ccc;">
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
		&nbsp;
		</td>
		<td class="listMark">
		&nbsp;
		</td>
		<td class="listSearch">
		&nbsp;
		</form>
		</td>
	</tr>
</table>

</td>
</tr>

<tr><td>

<table class="dT dT-str" cellpadding="0" cellspacing="0">
<tr class="dTH">
<td class="dT-ch{if $sort_orders.types == 1} sortSelected{/if}"><input type="checkbox" onClick="tableList.setALLRowChecked(this.checked);" class="checkbox" />#{wt_admin_sort_order i=0 c=$sort_orders.types}</td>
<td {if $sort_orders.types == 1}class="sortSelected"{/if}>Nazwa
{wt_admin_sort_order i=1 c=$sort_orders.types}
</td>
<td class="dT-t{if $sort_orders.types == 2} sortSelected{/if}">Klucz
{wt_admin_sort_order i=2 c=$sort_orders.types}
</td>
<td class="dTOp">Opcje</td>
<![if !IE]>
<td width="13"></td>
<![endif]>
</tr>
<tbody id="data_table_content">
{foreach item=it from=$items_listing name="items_listing"}
<tr id="row_{$it.itt_id}" class="dTR" onmouseover="this.className='dTRO';" onmouseout="this.className='dTR'" onClick="tableList.setRowClick('{$it.itt_id}', this);" ondblclick="parent.action_form_large('{wt_href_tpl_link parameters="m=types&t=addType&tID=`$it.itt_id`&from=admin_list"}', 'Edycja typu'); return false;">

<td class="dT-ch{if $sort_orders.types == 0} sortSelected{/if}"><nobr><input type="checkbox" onCLick="tableList.setRowClick('{$it.itt_id}', this); tableList.setRowChecked('{$it.itt_id}');" id="row_checkbox_{$it.itt_id}" class="rowCheckbox" value="{$it.itt_id}" /> [{$it.itt_id}]</nobr></td>
<td class="{if $sort_orders.types == 1} sortSelected{/if}"><a href="{wt_href_tpl_link parameters="m=fields&tID=`$it.itt_id`"}">{$it.itt_name}</a><br />
<small>{$it.itt_desc}</small></td>
<td class="dT-t{if $sort_orders.types == 2} sortSelected{/if}"><img id="row_type_img_{$it.itt_id}" src="{$__imageRoot__}/tree/{$it.itt_ico}.gif" align="absmiddle" alt="" /><br /><small>{$it.itt_key}</small></td>

{if (!$smarty.get.cPath && $__isRoot__) || $smarty.get.cPath || $it.itt_root_edit == "0"}
<td class="dTOp">
<a href="{wt_href_tpl_link parameters="m=types&t=addType&tID=`$it.itt_id`&from=admin_list"}" onclick="parent.action_form_large(this.href, 'Edycja typu'); return false;" title=" edytuj " onmouseover="parent.displayLeftHint(prEditHint); return false" onmouseout="parent.hideLeftHint(); return false"><img src="{$__imageRoot__}/edit.png" alt=" edytuj " /></a>
<a href="#" onClick="tableList.delRowItem('{$it.itt_id}'); return false" title=" usuń " onmouseover="parent.displayLeftHint(prDelHint); return false" onmouseout="parent.hideLeftHint(); return false"><img src="{$__imageRoot__}/trash.png" alt=" usuń" /></a>
</td>
{else}
<td class="dTOp">---</td>
{/if}
<![if !IE]>
<td width="13">&nbsp;</td>
<![endif]>
</tr>
{/foreach}
</tbody>
</table> 
</td></tr>
<tr class="dTFR">
<td>
<table class="dTFRC">
<tr>
<td >{$number_of_items_text}</td>
<td>{$display_to_display}</td>
<td align="right">{$number_of_items_links}</td>
</tr>
</table>
</td>
</tr> 
</table>