<style type="text/css">
{literal}
.itType { text-align: center; font-size: 10px; }
.itType IMG { clear:both; }
{/literal}
</style>
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
delURL: '{wt_href_tpl_link mod_key="mod_structure_manager" parameters="a=delFieldConfig&fID="}',
sortOrderURL: '{wt_href_tpl_link parameters="a=setFieldOrder&tID=`$smarty.get.tID`&fID="}'
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


}

{/literal}
</script>

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
<td width="10"><input type="checkbox" onClick="tableList.setALLRowChecked(this.checked);" class="checkbox" /></td>
<td {if $smarty.session.sort_orders.fields == 1}class="sortSelected"{/if}>Nazwa
{wt_admin_sort_order i=1 c=$smarty.session.sort_orders.fields}
</td>
<td {if $smarty.session.sort_orders.fields == 4}class="sortSelected"{/if}>Kolejność
{wt_admin_sort_order i=2 c=$smarty.session.sort_orders.fields}
</td>
<td class="dTOp">Opcje</td>
<![if !IE]>
<td width="13"></td>
<![endif]>
</tr>
<tbody id="data_table_content">
{foreach item=fi from=$fields_listing name="fields_listing"}
<tr id="row_{$fi.fi_id}" class="dTR" onmouseover="this.className='dTRO';" onmouseout="this.className='dTR'" onClick="tableList.setRowClick('{$fi.fi_id}', this);">

<td><nobr><input type="checkbox" onCLick="tableList.setRowClick('{$fi.fi_id}', this); tableList.setRowChecked('{$fi.fi_id}');" id="row_checkbox_{$fi.fi_id}" class="rowCheckbox" value="{$fi.fi_id}" /> </nobr></td>
<td {if $smarty.session.sort_orders.fields == 1}class="sortSelected dT-n"{else} class="dT-n"{/if}>{$fi.fi_name}</td>

<td>
<a href="#" onCLick="tableList.setSortOrder('{$it.it_id}', 'top'); return false" title=" przesuń na samą górę " onmouseover="parent.displayLeftHint(prSOTopHint); return false" onmouseout="parent.hideLeftHint(); return false"><img border="0" src="{$__imageRoot__}/icons_large/order_arrow_top.gif" align="absmiddle"></a>
<a href="#" onCLick="tableList.setSortOrder('{$it.it_id}', 'up'); return false" title=" przesuń wyżej " onmouseover="parent.displayLeftHint(prSOUpHint); return false" onmouseout="parent.hideLeftHint(); return false"><img border="0" src="{$__imageRoot__}/icons_large/order_arrow_up.gif" align="absmiddle"></a>
<a href="#" onCLick="tableList.setSortOrder('{$it.it_id}', 'down'); return false" title=" przesuń niżej " onmouseover="parent.displayLeftHint(prSODownHint); return false" onmouseout="parent.hideLeftHint(); return false"><img border="0" src="{$__imageRoot__}/icons_large/order_arrow_down.gif" align="absmiddle"></a>
<a href="#" onCLick="tableList.setSortOrder('{$it.it_id}', 'bottom'); return false" title=" przesuń na sam dół " onmouseover="parent.displayLeftHint(prSOBottomHint); return false" onmouseout="parent.hideLeftHint(); return false"><img border="0" src="{$__imageRoot__}/icons_large/order_arrow_bottom.gif" align="absmiddle"></a>
</td>

<td class="dTOp">
<a href="{wt_href_tpl_link parameters="m=types&t=addType&tID=`$fi.fi_id`&from=admin_list"}" onclick="parent.action_form_large(this.href, 'Edycja typu'); return false;" title=" edytuj " onmouseover="parent.displayLeftHint(prEditHint); return false" onmouseout="parent.hideLeftHint(); return false"><img src="{$__imageRoot__}/edit.png" alt=" edytuj " /></a>
<a href="#" onClick="tableList.delRowItem('{$fi.fi_id}'); return false" title=" usuń " onmouseover="parent.displayLeftHint(prDelHint); return false" onmouseout="parent.hideLeftHint(); return false"><img src="{$__imageRoot__}/trash.png" alt=" usuń" /></a>
</td>
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