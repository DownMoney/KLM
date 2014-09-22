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
page: {$smarty.get.page|default:1},
results: {$results},
resultsPP: {$resultsPP|default:20},
statusChangeURL: '{wt_href_tpl_link mod_key="mod_structure_manager" parameters="a=setItemStatus&iID="}',
delURL: '{wt_href_tpl_link mod_key="mod_structure_manager" parameters="a=delItem&cPath=`$smarty.get.cPath`&from=admin_list&iID="}',
itemInfoURL: '{wt_href_tpl_link parameters="m=items&t=itemInfo&iID="}',
sortOrderURL: '{wt_href_tpl_link parameters="a=setItemOrder&cPath=`$smarty.get.cPath`&iID="}'
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
		{/literal}
			{if $__languages__}
				{foreach from=$__languages__ item="l" key="k"}
					case 'lng_status_0_{$l.id}':
					  new Ajax.Request(base_url+'&a=setItemLanguageStatus&iID='+selected_rows_string+'&status=0&language_id={$l.id}', {literal} { evalScripts:true, asynchronous:true, onSuccess: function() { document.location.href = document.location.href; } }); {/literal}
					break;
					case 'lng_status_1_{$l.id}':
					  new Ajax.Request(base_url+'&a=setItemLanguageStatus&iID='+selected_rows_string+'&status=1&language_id={$l.id}', {literal} { evalScripts:true, asynchronous:true, onSuccess: function() { document.location.href = document.location.href; } }); {/literal}
					break;
				{/foreach}
			{/if}
		{literal}
	}
}

{/literal}
</script>
{if $item_data.params_array.adminList_current_item != "-1"}
{include file="`$__templateFSRoot__`admin2/source/modules/mod_structure_manager/sub/currentItemInfo.tpl"}
{/if}

{if $item_data.itt_nochildren == 1}
<table class="noDataMess">
	<tr>
		<td>W tej części serwisu nie możesz dodać już nic.<br />
{if $item_data.itt_root_edit == "0" || $__isRoot__}
Jeżeli chcesz zmienić bieżący element, kliknij na link <a href="{wt_href_tpl_link parameters="m=items&t=addItem&cPath=`$item_data.cPath`&cID=`$smarty.get.cID`&iID=`$item_data.it_id`&from=admin_list"}" onclick="parent.action_form_large(this.href, 'Edycja wpisu'); return false;" title=" edytuj "><img src="{$__imageRoot__}/edit.png" alt=" edytuj " align="absmiddle" /> edytuj</a>.{/if}</td>
	</tr>
</table>
{else}

<table class="cT">
<tr>
<td class="cTO" id="cTO">

<table>
	<tr>
		<td class="listSelectMark">
			<img src="{$__imageRoot__}/arrow_d.gif" align="absmiddle" alt="" />
			<select name="listOperation" id="listOperation" onChange="makeListOperation(this);">
			<option value="">--- zaznaczone ---</option>
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
		<form action="{wt_href_tpl_link parameters="t=searchItems"}">
			<input name="mod" value="{wt_mod_id m=mod_structure_manager}" id="mod" type="hidden">
			<input name="m" value="items" id="m" type="hidden">
			<input name="t" value="searchItems" id="t" type="hidden">
			<input type="text" id="gSearch" name="gSearch" value="{$smarty.get.gSearch}" />
		</form>
		</td>
	</tr>
</table>

</td>
</tr>

<tr><td>

<table class="dT dT-str" cellpadding="0" cellspacing="0">
<thead>
<tr class="dTH">
<td class="dT-ch"><input type="checkbox" onClick="tableList.setALLRowChecked(this.checked);" class="checkbox" />#{wt_admin_sort_order i=0 c=$sort_orders.items}</td>
<td {if $sort_orders.items == 1}class="sortSelected"{/if}  {if $item_data.params_array.adminList_show_logo != "-1"}colspan="2"{/if}>Nazwa
{wt_admin_sort_order i=1 c=$sort_orders.items}
</td>
{foreach from=$table_fields item=f}
	<td>{$f}</td>
{/foreach}
{if $item_data.params_array.adminList_it_type != "-1"}<td class="dT-t{if $sort_orders.items == 4} sortSelected{/if}">Typ
{wt_admin_sort_order i=4 c=$sort_orders.items}
</td>{/if}
{if $item_data.params_array.adminList_sort_order != "-1"}<td class="dT-so{if $sort_orders.items == 2} sortSelected{/if}">Kolejność
{wt_admin_sort_order i=2 c=$sort_orders.items}
</td>{/if}
{if $item_data.params_array.adminList_status != "-1"}<td class="dT-s{if $sort_orders.items == 3} sortSelected{/if}">Wł.
{wt_admin_sort_order i=3 c=$sort_orders.items}
</td>{/if}
{if $item_data.params_array.adminList_date_added == "1" || $item_data.params_array.adminList_date_publish == "1"}<td class="{if $sort_orders.items == 5 || $sort_orders.items == 6} sortSelected{/if}">Data {if $item_data.params_array.adminList_date_added == "1"}{wt_admin_sort_order i=5 c=$sort_orders.items}{elseif $item_data.params_array.adminList_date_publish != "-1"}{wt_admin_sort_order i=6 c=$sort_orders.items}{/if}</td>{/if}
{if $item_data.params_array.adminList_options == "1" ||  $__isRoot__}<td class="dTOp">Opcje</td>{/if}
<![if !IE]>
<td width="13"></td>
<![endif]>
</tr>
</thead>
<tbody id="data_table_content">
{if $items_listing}
{foreach item=it from=$items_listing name="items_listing"}
<tr id="row_{$it.it_id}" {if $it.status == "1"}class="dTR{cycle values=", row2"}" onmouseover="this.addClassName('dTRO');" onmouseout="this.removeClassName('dTRO');"{else} class="dTR0{cycle values=", row2"}" onmouseover="this.addClassName('dTRO0');" onmouseout="this.removeClassName('dTRO0');"{/if} onClick="tableList.setRowClick('{$it.it_id}', this);" {if $it.itt_root_edit == "0" || $__isRoot__}ondblclick="parent.action_form_large('{wt_href_tpl_link parameters="m=items&t=addItem&cPath=`$smarty.get.cPath`&iID=`$it.it_id`&from=admin_list"}', 'Edycja wpisu{if $__languages__} - język: {$__languagesCurLanguage__.name}{/if}'); return false;"{/if}>

<td class="dT-ch"><nobr><input type="checkbox" onCLick="tableList.setRowClick('{$it.it_id}', this); tableList.setRowChecked('{$it.it_id}');" id="row_checkbox_{$it.it_id}" class="rowCheckbox" value="{$it.it_id}" /> <a href="#" onClick="tableList.loadRowItemInfo('{$it.it_id}'); return false" onmouseover="parent.displayLeftHint(prInfoHint); return false" onmouseout="parent.hideLeftHint(); return false"><img id="row_make_info_{$it.it_id}" src="{$__imageRoot__}/icons_large/plus.gif" alt="" align="absmiddle" /></a></nobr></td>
{if $item_data.params_array.adminList_show_logo != "-1"}<td class="dT-lo{if $sort_orders.items == 1} sortSelected{/if}">{if $it.itt_nochildren == "0" || $it.it_id2}<a href="{wt_href_tpl_link mod_key="mod_structure_manager" parameters="cPath=`$it.cPath`"}" onmouseover="parent.displayLeftHint(prItemsHint); return false" onmouseout="parent.hideLeftHint(); return false">{/if}{wt_thumb_image 	
		src="mod_structure/`$it.media_path`/`$it.it_logo`"  
		width="40"
		height="30"
		compress="75"
		show_blank="1"}{/if}{if $it.itt_nochildren == "0" || $it.it_id2}</a></td>{/if}
<td class="dT-n{if $sort_orders.items == 1} sortSelected{/if}">{if $it.itt_nochildren == "0" || $it.it_id2}<a href="{wt_href_tpl_link mod_key="mod_structure_manager" parameters="cPath=`$it.cPath`"}" onmouseover="parent.displayLeftHint(prItemsHint); return false" onmouseout="parent.hideLeftHint(); return false">{/if}{if $it.it_name2}{$it.it_name}<br />{/if} {if $it.itt_key == "shortcut"}<small>Skrót do: </small>{elseif $it.itt_key == "copy"}<small>Kopia: </small>{/if} {if $it.it_name2} {$it.it_name2} {else} {$it.it_name} {/if} {if $it.itt_nochildren == "0" || $it.it_id2}</a>{/if}
{if $it.it_id2}<br /><small><a href="{wt_href_tpl_link mod_key="mod_structure_manager" parameters="cPath=`$it.cPath`"}" onmouseover="parent.displayLeftHint(prItemsHint); return false" onmouseout="parent.hideLeftHint(); return false"><img src="{$__imageRoot__}/shorcut_go.gif" alt="idź" align="absmiddle" /> przejdź do docelowego wpisu</a> </small><br />{/if}
{if $it.it_desc_short}<br /><small>{$it.it_desc_short|strip_tags|truncate:100}</small>{/if}
{if $__languages__ && $it.itt_disable_languages != "1" && $item_data.params_array.adminList_show_languages != "-1"}<div class="dT-lng">{foreach from=$it.languages_status key=i item=s}<a href="{wt_href_tpl_link parameters="m=items&t=addItem&cPath=`$smarty.get.cPath`&iID=`$it.it_id`&from=admin_list&language_id=`$i`"}" onclick="parent.action_form_large(this.href, 'Edycja wpisu - język: {$__languagesid__.$i.name}'); return false;" title=" edytuj {$__languagesid__.$i.name} " onmouseover="parent.displayLeftHint(prEditHint); return false" onmouseout="parent.hideLeftHint(); return false"><img src="{$__imageRoot__}/flags/{$__languagesid__.$i.code}.gif" alt="{$__languagesid__.$i.name}" align="absmiddle"  {if $s == 0}class="ld"{/if} /></a>{/foreach}</div>{/if}
{if $__isRoot__}<br style="clear:both;" />{if $it.itt_root_show == "1"}<img align="absmiddle" src="{$__imageRoot__}/root_view.gif" alt="ROOT VIEW" width="12" height="12" /> {/if}{if $it.itt_root_edit == "1"}<img align="absmiddle" src="{$__imageRoot__}/root_edit.gif" alt="ROOT EDIT" width="12" height="12" /> {/if}{if $it.itt_root_addchildren == "1"}<img align="absmiddle" src="{$__imageRoot__}/root_addchild.gif" alt="ROOT ADD CHILDREN" width="12" height="12" /> {/if}{/if}
</td>
{foreach from=$table_fields item=f key="field_key"}
	<td class="{if $it.fields.$field_key.t == "date"}ar{/if}">
	{if $it.fields.$field_key.t == "multi_select_item"}
		<ul>
		{foreach from=$it.fields.$field_key.n item="fi"}		  
			<li><a href="{wt_href_tpl_link parameters="m=items&t=itemInfo&iID=`$fi.it_id`&tFile="}" onClick="popupWindow(this.href, 'itemInfo', '750', '600', 'yes'); return false">{$fi.it_name}</a></li>
		{/foreach}
		</ul>
	{elseif $it.fields.$field_key.t == "files"}	
		<ul>
		{foreach from=$it.fields.$field_key.n item="fi" name="files"}
			<li style="background:none;padding-left:0;">{if file_exists("`$__imageRoot__`/files/`$fi.ext`.gif")}<img src="{$__imageRoot__}/files/{$fi.ext}.gif" align="absmiddle" />{else}<img src="{$__imageRoot__}/files/default.gif" align="absmiddle" />{/if} <a href="{wt_href_tpl_link parameters="m=items&t=itemInfo&iID=`$fi.it_id`&tFile="}" onClick="popupWindow(this.href, 'itemInfo', '750', '600', 'yes'); return false">{$fi.name|default:$fi.file}</a> <small>({$fi.ext} {$fi.size|string_format:"%.2f"}MB)</small></li>
		{/foreach}
		{if $smarty.foreach.files.total > 1}
			<li><a href="{wt_href_tpl_link parameters="m=items&t=itemInfo&iID=`$it.it_id`&tFile="}" onClick="popupWindow(this.href, 'itemInfo', '750', '600', 'yes'); return false"><b>wszystkie pliki &raquo;</b></a></li>
		{/if}
		</ul>
	{elseif $it.fields.$field_key.t == "date"}
		<nobr>{$it.fields.$field_key.n|date_format:"%a, %d %B %Y"}</nobr>
	{elseif $it.fields.$field_key.t == "select"}
		{$it.fields.$field_key.n.fi_name}
	{else}
		{$it.fields.$field_key.n}
	{/if}
	</td>
{/foreach}


{if $item_data.params_array.adminList_it_type != "-1"}
<td class="dT-t{if $sort_orders.items == 4} sortSelected{/if}"><img id="row_type_img_{$it.it_id}" src="{$__imageRoot__}/tree/{$it.itt_ico}_s.gif" align="absmiddle" alt="{$it.itt_name}" /><br />
<small>{if $__isRoot__}<a href="{wt_href_tpl_link parameters="m=fields&tID=`$it.it_type`"}">{$it.itt_name}</a>{else}{$it.itt_name}{/if}</small></td>
{/if}
{if $item_data.params_array.adminList_sort_order != "-1"}
<td {if $sort_orders.items == 2}class="sortSelected dT-so"{else} class="dT-so"{/if}>
{if $sort_orders.items == 2}
<nobr><a href="#" onCLick="tableList.setSortOrder('{$it.it_id}', 'top'); return false" title=" przesuń na samą górę " onmouseover="parent.displayLeftHint(prSOTopHint); return false" onmouseout="parent.hideLeftHint(); return false"><img border="0" src="{$__imageRoot__}/icons_large/order_arrow_top.gif" align="absmiddle"></a>
<a href="#" onCLick="tableList.setSortOrder('{$it.it_id}', 'up'); return false" title=" przesuń wyżej " onmouseover="parent.displayLeftHint(prSOUpHint); return false" onmouseout="parent.hideLeftHint(); return false"><img border="0" src="{$__imageRoot__}/icons_large/order_arrow_up.gif" align="absmiddle"></a>
<a href="#" onCLick="tableList.setSortOrder('{$it.it_id}', 'down'); return false" title=" przesuń niżej " onmouseover="parent.displayLeftHint(prSODownHint); return false" onmouseout="parent.hideLeftHint(); return false"><img border="0" src="{$__imageRoot__}/icons_large/order_arrow_down.gif" align="absmiddle"></a>
<a href="#" onCLick="tableList.setSortOrder('{$it.it_id}', 'bottom'); return false" title=" przesuń na sam dół " onmouseover="parent.displayLeftHint(prSOBottomHint); return false" onmouseout="parent.hideLeftHint(); return false"><img border="0" src="{$__imageRoot__}/icons_large/order_arrow_bottom.gif" align="absmiddle"></a></nobr>
{else}
aby ustawiać kolejność zmień sortowanie
{/if}
</td>
{/if}
{if $item_data.params_array.adminList_status != "-1"}
<td id="row_status_{$it.it_id}" {if $sort_orders.items == 3}class="sortSelected dT-s"{else} class="dT-s"{/if}><a href="#" onClick="tableList.setRowItemStatus('{$it.it_id}', '{$it.status_text.change_to}'); return false"><img border="0" src="{$__imageRoot__}/icons_large/{$it.status_text.icon}"></a>
</td>
{/if}
{if  $item_data.params_array.adminList_date_added == "1" || $item_data.params_array.adminList_date_publish == "1"}
<td class="ar">
{if $item_data.params_array.adminList_date_added == "1"}
	{$it.date_added|date_format|date_format:"%a, %d %b %y<br />%H:%M:%S"}
{/if}
{if $item_data.params_array.adminList_date_publish == "1"}
	{$it.publish_date|date_format:"%a, %d %b %y<br />%H:%M:%S"}
{/if}
</td>{/if}

{if ($it.itt_root_edit == "0" || $__isRoot__) || (!$__isRoot__ && $item_data.params_array.adminList_options != "-1" && $smarty.get.cPath != "")}
<td class="dTOp">
<a href="{wt_href_tpl_link parameters="m=items&t=moveItem&cPath=`$smarty.get.cPath`&iID=`$it.it_id`"}" onclick="parent.action_form(this.href, 'Przenieś wpis'); return false;" title=" przenieś " onmouseover="parent.displayLeftHint(prMoveHint); return false" onmouseout="parent.hideLeftHint(); return false"><img src="{$__imageRoot__}/move.png" alt=" przenieś " /></a>
<a href="{wt_href_tpl_link parameters="m=items&t=addItem&cPath=`$smarty.get.cPath`&iID=`$it.it_id`&from=admin_list"}" onclick="parent.action_form_large(this.href, 'Edycja wpisu{if $__languages__} - język: {$__languagesCurLanguage__.name}{/if}'); return false;" title=" edytuj " onmouseover="parent.displayLeftHint(prEditHint); return false" onmouseout="parent.hideLeftHint(); return false"><img src="{$__imageRoot__}/edit.png" alt=" edytuj " /></a> 
<a href="#" onClick="parent.action_form('{wt_href_tpl_link mod_key="mod_structure_manager" parameters="m=items&t=deleteItem&cPath=`$smarty.get.cPath`&iID=`$it.it_id`"}', 'Usuń wpis')" title=" usuń " onmouseover="parent.displayLeftHint(prDelHint); return false" onmouseout="parent.hideLeftHint(); return false"><img src="{$__imageRoot__}/trash.png" alt=" usuń" /></a>
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
		<td>
		{if ($item_data.itt_root_addchildren == "1" && $__isRoot__) || $item_data.itt_root_addchildren == "0"}
		Nie dodałeś jeszcze żadnego elementu w tej części strony.<br />
Aby dodać w tym miejscu nowy element kliknij na przycisk <a onClick="parent.action_form_large(this.href, 'Nowy wpis'); return false;" href="{wt_href_tpl_link parameters="m=items&t=addItem&cPath=`$smarty.get.cPath`&from=admin_list"}"><img align="absmiddle" src="{$__imageRoot__}/icons/add_content.gif"/>dodaj</a>.
		{else}
		W tej części serwisu nie możesz dodać już nic.
		{/if}

</td>
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
{/if}
<script type="text/javascript">
parent.$('navTabModLink').update('{$item_data.it_name|default:"struktura"}');
</script>