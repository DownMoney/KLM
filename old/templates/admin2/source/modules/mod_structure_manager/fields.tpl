<script type="text/javascript">

var prInfoHint = 'Kliknij aby zobaczyć szczegółowe informacje o elemencie.';
var prFieldsHint = 'Kliknij aby zobaczyć elementy podrzędne.';

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
delURL: '{wt_href_tpl_link mod_key="mod_structure_manager" parameters="a=delField&from=admin_list&fID="}',
itemInfoURL: '{wt_href_tpl_link parameters="m=items&t=itemInfo&iID="}',
sortOrderURL: '{wt_href_tpl_link parameters="a=setFieldOrder&pID=`$smarty.get.pID`&tID=`$smarty.get.pID`&fID="}'
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
				tableList.setRowFieldStatus(selected_rows[i], '0');
			break;	
			case 'status1':
				tableList.setRowFieldStatus(selected_rows[i], '1');
			break;
		}
	}

var selected_rows_string = selected_rows.toString();


{/literal} var base_url = '{wt_href_tpl_link mod_key="mod_structure_manager" parameters="m=items&cPath=`$smarty.get.cPath`"}';{literal}

	switch( action ) {
		case 'move':
			parent.action_form(base_url+'&t=moveField&iID='+selected_rows_string, 'Przenieś wpisy');
		break;
		case 'del':
			parent.action_form(base_url+'&t=deleteField&iID='+selected_rows_string, 'Usuń wpisy');
			break;
		{/literal}
			{if $__languages__}
				{foreach from=$__languages__ item="l" key="k"}
					case 'lng_status_0_{$l.id}':
					  new Ajax.Request(base_url+'&a=setFieldLanguageStatus&iID='+selected_rows_string+'&status=0&language_id={$l.id}', {literal} { evalScripts:true, asynchronous:true, onSuccess: function() { document.location.href = document.location.href; } }); {/literal}
					break;
					case 'lng_status_1_{$l.id}':
					  new Ajax.Request(base_url+'&a=setFieldLanguageStatus&iID='+selected_rows_string+'&status=1&language_id={$l.id}', {literal} { evalScripts:true, asynchronous:true, onSuccess: function() { document.location.href = document.location.href; } }); {/literal}
					break;
				{/foreach}
			{/if}
		{literal}
	}
}

{/literal}
</script>

{if $smarty.get.pID > 0}
	{include file="`$__templateFSRoot__`admin2/source/modules/mod_structure_manager/sub/currentFieldInfo.tpl"}
{elseif $smarty.get.tID > 0}
	{include file="`$__templateFSRoot__`admin2/source/modules/mod_structure_manager/sub/currentTypeInfo.tpl"}
{/if}
<table class="cT" style="border-top: 1px solid #ccc;">
<tr>
<td class="cTO" id="cTO">
<table>
	<tr>
		<td class="listSelectMark">
			{*<b>Zaznaczone:</b>
			<select name="listOperation" id="listOperation" onChange="makeListOperation(this);">
			<option value="">--- wybierz ---</option>
			<option value="status0">wyłącz</option>
			<option value="status1">włącz</option>
			<option value="move">przenieś</option>
			<option value="del">usuń</option>		
			{if $__languages__}	
			<optgroup label="Publikuj w języku">
				{foreach from=$__languages__ item="l" key="k"}
					<option value="lng_status_1_{$l.id}">{$l.name}</option>
				{/foreach} 
			</optgroup>
			<optgroup label="NIE publikuj w języku">
				{foreach from=$__languages__ item="l" key="k"}
					<option value="lng_status_0_{$l.id}">{$l.name}</option>
				{/foreach} 
			</optgroup>
			{/if}
			</select>*}
		</td>
		<td class="listOpenClose">
			<b>wszystkie:</b>
			<a href="#" onClick="tableList.openCloseRowFields('all', false); return false">otwórz</a>, <a href="#" onClick="tableList.openCloseRowFields('all', true); return false">zamknij</a>
		</td>
		<td class="listMark">
		<b>Zaznacz:</b>
			<a href="#" onClick="tableList.setReverseRowChecked(); return false">odwrotnie</a>
		</td>
		<td class="listSearch">
		<form action="{wt_href_tpl_link parameters="t=searchFields"}">
			<input name="mod" value="{wt_mod_id m=mod_structure_manager}" id="mod" type="hidden">
			<input name="m" value="items" id="m" type="hidden">
			<input name="t" value="searchFields" id="t" type="hidden">
			<input type="text" id="gSearch" name="gSearch" value="{$smarty.get.gSearch}" />
		</form>
		</td>
	</tr>
</table>

</td>
</tr>

<tr><td>

<table class="dT dT-str" cellpadding="0" cellspacing="0">
<tr class="dTH">
<td class="dT-ch"><input type="checkbox" onClick="tableList.setALLRowChecked(this.checked);" class="checkbox" />{wt_admin_sort_order i=0 c=$sort_orders.fields}</td>
<td {if $sort_orders.fields == 1}class="sortSelected"{/if}>Nazwa
{wt_admin_sort_order i=1 c=$sort_orders.fields}
</td>
<td class="dT-t{if $sort_orders.fields == 4} sortSelected{/if}">Typ
{wt_admin_sort_order i=2 c=$sort_orders.fields}
</td>
<td class="dT-t{if $sort_orders.fields == 4} sortSelected{/if}">Klucz
{wt_admin_sort_order i=3 c=$sort_orders.fields}
</td>
<td class="dT-so{if $sort_orders.fields == 2} sortSelected{/if}">Kolejność
{wt_admin_sort_order i=4 c=$sort_orders.fields}
</td>
<td class="dTOp">Opcje</td>
<![if !IE]>
<td width="13"></td>
<![endif]>
</tr>
<tbody id="data_table_content">
{if $items_listing}
{foreach item=it from=$items_listing name="items_listing"}
<tr id="row_{$it.fi_id}" class="dTR" onmouseover="this.className='dTRO';" onmouseout="this.className='dTR'" onClick="tableList.setRowClick('{$it.fi_id}', this);" ondblclick="parent.action_form_large('{wt_href_tpl_link get_params="m|t|fID" parameters="m=fields&t=addField&fID=`$it.fi_id`&from=admin_list"}', 'Edycja pola{if $__languagesCurLanguage__} - język: {$__languagesCurLanguage__.name}{/if}'); return false;">

<td class="dT-ch"><nobr><input type="checkbox" onCLick="tableList.setRowClick('{$it.fi_id}', this); tableList.setRowChecked('{$it.fi_id}');" id="row_checkbox_{$it.fi_id}" class="rowCheckbox" value="{$it.fi_id}" /> <a href="#" onClick="tableList.loadRowFieldInfo('{$it.fi_id}'); return false" onmouseover="parent.displayLeftHint(prInfoHint); return false" onmouseout="parent.hideLeftHint(); return false"><img id="row_make_info_{$it.fi_id}" src="{$__imageRoot__}/icons_large/plus.gif" alt="" align="absmiddle" /></a> [{$it.fi_id}]</nobr></td>

<td class="dT-n{if $sort_orders.fields == 1} sortSelected{/if}">
<a href="{wt_href_tpl_link get_params="m|t|fID|tID" parameters="m=fields&pID=`$it.fi_id`&from=admin_list"}" onmouseover="parent.displayLeftHint(prFieldsHint); return false" onmouseout="parent.hideLeftHint(); return false">{if $__isRoot__}{if $it.fi_root_show == "1"}<img align="absmiddle" src="{$__imageRoot__}/root_view.gif" alt="ROOT VIEW" /> {/if}{if $it.fi_root_edit == "1"}<img align="absmiddle" src="{$__imageRoot__}/root_edit.gif" alt="ROOT EDIT" /> {/if}{/if}{$it.fi_name}</a>
<small>{$it.fi_desc|strip_tags|truncate:100}</small>
{if $__languages__}<div class="dT-lng">{foreach from=$it.languages_status key=i item=s}<a href="{wt_href_tpl_link get_params="m|t|fID" parameters="m=fields&t=addField&fID=`$it.fi_id`&from=admin_list&language_id=`$i`"}" onclick="parent.action_form_large(this.href, 'Edycja wpisu - język: {$__languagesid__.$i.name}'); return false;" title=" edytuj {$__languagesid__.$i.name} " onmouseover="parent.displayLeftHint(prEditHint); return false" onmouseout="parent.hideLeftHint(); return false"><img src="{$__imageRoot__}/flags/{$__languagesid__.$i.code}.gif" alt="{$__languagesid__.$i.name}" align="absmiddle"  {if $s == 0}class="ld"{/if} /></a>{/foreach}</div>{/if}

</td>
<td>{$it.fi_type}</td>
<td>{$it.fi_gr}</td>

<td {if $sort_orders.fields == 4}class="sortSelected dT-so"{else} class="dT-so"{/if}>
{if $sort_orders.fields == 4}
<nobr><a href="#" onCLick="tableList.setSortOrder('{$it.fi_id}', 'top'); return false" title=" przesuń na samą górę " onmouseover="parent.displayLeftHint(prSOTopHint); return false" onmouseout="parent.hideLeftHint(); return false"><img border="0" src="{$__imageRoot__}/icons_large/order_arrow_top.gif" align="absmiddle"></a>
<a href="#" onCLick="tableList.setSortOrder('{$it.fi_id}', 'up'); return false" title=" przesuń wyżej " onmouseover="parent.displayLeftHint(prSOUpHint); return false" onmouseout="parent.hideLeftHint(); return false"><img border="0" src="{$__imageRoot__}/icons_large/order_arrow_up.gif" align="absmiddle"></a>
<a href="#" onCLick="tableList.setSortOrder('{$it.fi_id}', 'down'); return false" title=" przesuń niżej " onmouseover="parent.displayLeftHint(prSODownHint); return false" onmouseout="parent.hideLeftHint(); return false"><img border="0" src="{$__imageRoot__}/icons_large/order_arrow_down.gif" align="absmiddle"></a>
<a href="#" onCLick="tableList.setSortOrder('{$it.fi_id}', 'bottom'); return false" title=" przesuń na sam dół " onmouseover="parent.displayLeftHint(prSOBottomHint); return false" onmouseout="parent.hideLeftHint(); return false"><img border="0" src="{$__imageRoot__}/icons_large/order_arrow_bottom.gif" align="absmiddle"></a></nobr>
{else}
aby ustawiać kolejność zmień sortowanie
{/if}
</td>

{if (!$smarty.get.cPath && $__isRoot__) || $smarty.get.cPath || $it.itt_root_edit == "0"}
<td class="dTOp">
<a href="{wt_href_tpl_link get_params="m|t|fID" parameters="m=fields&t=addField&fID=`$it.fi_id`&from=admin_list"}" onclick="parent.action_form_large(this.href, 'Edycja pola{if $__languagesCurLanguage__} - język: {$__languagesCurLanguage__.name}{/if}'); return false;" title=" edytuj " onmouseover="parent.displayLeftHint(prEditHint); return false" onmouseout="parent.hideLeftHint(); return false"><img src="{$__imageRoot__}/edit.png" alt=" edytuj " /></a>
<a href="#" onClick="tableList.delRowItem('{$it.fi_id}');" title=" usuń " onmouseover="parent.displayLeftHint(prDelHint); return false" onmouseout="parent.hideLeftHint(); return false"><img src="{$__imageRoot__}/trash.png" alt=" usuń" /></a>
</td>
{else}
<td class="dTOp">---</td>
{/if}
<![if !IE]>
<td width="13">&nbsp;</td>
<![endif]>
</tr>
{/foreach}
{else}
<tr>
	<td colspan="7">
<table class="noDataMess">
	<tr>
		<td>Nie dodałeś jeszcze żadnego pola.<br />
Aby dodać w tym miejscu nowe pole kliknij na przycisk <a onclick="parent.action_form_large(this.href, 'Edycja pola{if $__languagesCurLanguage__} - język: {$__languagesCurLanguage__.name}{/if}'); return false;" href="{wt_href_tpl_link get_params="m|t|fID" parameters="m=fields&t=addField&from=admin_list"}"><img align="absmiddle" src="{$__imageRoot__}/icons/add_content.gif"/>dodaj</a>.</td>
	</tr>
</table>
</td>
</tr>
{/if}
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