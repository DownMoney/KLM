<script type="text/javascript">

// onmouseover="parent.displayLeftHint(prMoveHint); return false" onmouseout="parent.hideLeftHint();

var txtEditHint = 'Kliknij aby edytować wpis.';
var txtDelHint = 'Kliknij aby całkowicie usunąć wpis.';
var txtInfoHint = 'Kliknij aby zobaczyć szczegółowe informacje o wpisie.';
var genFilesHint = 'Kliknij aby wygenerować plik z wpisami dla tego modułu.';
{literal}

Event.observe(window, 'load', function() { Interface.setDataTableDim(); } );
Event.observe(window, 'load', function() { new ADM_TableNavigation() } );
var tableList = new ADM_TableList({
{/literal}
statusChangeType: 'full',
imageRoot: '{$__imageRoot__}/icons_large/',
itemInfoURL: '{wt_href_tpl_link mod_key="mod_languages_manager" parameters="m=texts&t=textInfo&tID="}',
//statusChangeURL: '{wt_href_tpl_link mod_key="mod_languages_manager" parameters="a=setTextStatus&tID="}',
delURL: '{wt_href_tpl_link mod_key="mod_languages_manager" parameters="a=delText&from=admin_list&tID="}'
{literal} 
});

makeListOperation = function(o) {

	var action = o.value;
	o.selectedIndex = 0;
	
	if( action == '' ) {
		return;
	}
	
	list_elems =	$('data_list_body').getElementsByTagName('INPUT');	
	selected_rows = new Array();
		for(i=0; i<list_elems.length;i++) {
			if(list_elems[i].className == 'rowCheckbox' && list_elems[i].type == 'checkbox' && list_elems[i].checked == true && list_elems[i].value > 0 ) {
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
		case 'del':
			tableList.delRowItem(selected_rows[i], true);
		break;
	}	
	}

}

{/literal}

</script>

{if $smarty.get.mod_id}
<script language="javascript" type="text/javascript">
{literal}
generateFiles = function(mod_id) {
	new Ajax.Request('{/literal}{wt_href_tpl_link mod_key="mod_languages_manager" parameters="a=generateFile&mID='+mod_id+'"}{literal}', {asynchronous:true,
	onComplete: function(t) {
		var data = t.responseText;
		var message = '';
		if (data=='ok') {
			message = 'Wygenerowano plik.'
		} else if(data='no_text') {
			message = 'Nie znaleziono wpisów do zapisania.';
		} else {
			message = 'Wystąpił błąd.'
		}
		parent.$('system_message').update(message);
		parent.$('system_message').show();
	
		parent.Effect.Pulsate('system_message', {duration: 1, pulses:1});
		setTimeout(function() { parent.Effect.Fade('system_message'); }, 5000);
	
	}
	});
}

{/literal}
</script>

{include file="`$__templateFSRoot__`admin2/source/modules/mod_languages_manager/sub/currentModInfo.tpl"}
{/if}

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
				<form action="{wt_href_tpl_link parameters="m=texts&t=SearchText"}">
				<input name="mod" value="{wt_mod_id m=mod_languages_manager}" id="mod" type="hidden">
				<input name="m" value="texts" id="m" type="hidden">
				<input name="t" value="textSearch" id="t" type="hidden">
				<input id="gSearch" type="text" name="gSearch" value="{$smarty.get.gSearch}" /><a href="#" onClick="tableList.showAdvanceSearch(); return false"></a>
			</form>
		</td>
	</tr>
</table>

</td>
</tr>

<tr id="listAdvanceSearch" {if !$iSearch}style="display:none;"{/if}>
	<td class="listAdvanceSearch">
		<a id="closeListAdvanceSearch" href="#" onClick="tableList.hideAdvanceSearch(); return false"><img src="{$__imageRoot__}/close_dialog.gif" alt="" /></a>
		{$searchText_form}
	</td>
</tr>
<tr><td>

<table class="dT dT-str" cellpadding="0" cellspacing="0">
<tr class="dTH">
<td class="dT-ch{if $sort_orders.texts == 0} sortSelected{/if}"><input type="checkbox" onClick="tableList.setALLRowChecked(this.checked);" class="checkbox" />#{wt_admin_sort_order i=0 c=$sort_orders.texts}</td>
<td {if $sort_orders.texts == 1}class="sortSelected"{/if}>Treść
{wt_admin_sort_order i=1 c=$sort_orders.texts}
</td>
<td {if $sort_orders.texts == 2}class="sortSelected"{/if} align="left">Moduł
{wt_admin_sort_order i=2 c=$sort_orders.texts}<br />
</td>
<td {if $sort_orders.texts == 3}class="sortSelected"{/if} align="left">Klucz
{wt_admin_sort_order i=3 c=$sort_orders.texts}<br />
</td>
<td align="right">Języki<br /><small>uzup. / wyst. </td>
<td class="dTOp">Opcje</td>
<![if !IE]>
<td width="13"></td>
<![endif]>
</tr>
<tbody id="data_table_content">
{if $texts_listing}
{foreach item=txt from=$texts_listing name="texts_listing"}

<tr id="row_{$txt.txt_id}" class="dTR" onmouseover="this.className='dTRO';" onmouseout="this.className='dTR'" onClick="tableList.setRowClick('{$txt.txt_id}', this);"  ondblclick="parent.action_form_large('{wt_href_tpl_link get_params="m|t|pID|from" parameters="m=texts&t=addText&tID=`$txt.txt_id`&from=admin_list"}', 'Edycja wpisu'); return false;">

<td class="dT-ch{if $sort_orders.texts == 0} sortSelected{/if}"><nobr><input type="checkbox" onCLick="tableList.setRowClick('{$txt.txt_id}', this); tableList.setRowChecked('{$txt.txt_id}');" id="row_checkbox_{$txt.txt_id}" class="rowCheckbox" value="{$txt.txt_id}" /> <a href="#" onClick="tableList.loadRowItemInfo('{$txt.txt_id}'); return false" onmouseover="parent.displayLeftHint(txtInfoHint); return false" onmouseout="parent.hideLeftHint(); return false"><img id="row_make_info_{$txt.txt_id}" src="{$__imageRoot__}/icons_large/plus.gif" alt="" align="absmiddle" /></a></nobr></td>

<td class="dT-n{if $sort_orders.texts == 1} sortSelected{/if}">{$txt.txt_value|strip_tags|truncate:50}</td>

<td align="left" {if $sort_orders.texts == 2}class="sortSelected"{/if}><small>
<a href="{wt_href_tpl_link parameters="m=texts&mod_id=`$txt.mod_id`"}" >{$txt.mod_title|default:'Globalny'}</small></a></td>
<td align="left" {if $sort_orders.texts == 3}class="sortSelected"{/if}><small>{$txt.txt_key}</small></td>
<td align="right">
{if $txt.saved_languages<$txt.language_count}
	<b style="color: #F00;">{$txt.saved_languages|default:0}</b>/{$txt.language_count|default:0}
{else}
	{$txt.saved_languages|default:0}/{$txt.language_count|default:0}</td>
{/if}
<td class="dTOp">
<nobr>
<a href="{wt_href_tpl_link get_params="m|t|pID|from" parameters="m=texts&t=addText&tID=`$txt.txt_id`&from=admin_list"}" onclick="parent.hideLeftHint(); parent.action_form_large(this.href, 'Edycja wpisu'); return false;" onmouseover="parent.displayLeftHint(txtEditHint); return false" onmouseout="parent.hideLeftHint(); return false"title=" edytuj "><img src="{$__imageRoot__}/edit.png" alt=" edytuj " border="0" width="16" height="16"></a>
<a href="#" onClick="tableList.delRowItem('{$txt.txt_id}'); return false" onmouseover="parent.displayLeftHint(txtDelHint); return false" onmouseout="parent.hideLeftHint(); return false" title=" usuń "><img src="{$__imageRoot__}/trash.png" alt=" usuń" border="0" width="16" height="16"></a>
</nobr>
</td>
<![if !IE]>
<td width="13"></td>
<![endif]>
</tr>
{/foreach}
{else}
<tr>
	<td colspan="7">
<table class="noDataMess">
	<tr>
		<td>Nie dodałeś jeszcze żadnego wpisu{if $smarty.get.mod_id} w tym module{/if}.<br />
Aby dodać nowy wpis{if $smarty.get.mod_id} w tym module{/if} kliknij na przycisk <a onClick="parent.action_form_large(this.href, 'Nowy wpis'); return false;" href="{wt_href_tpl_link parameters="m=texts&t=addText&mID=`$smarty.get.mod_id`"}"><img align="absmiddle" src="{$__imageRoot__}/icons/add_content.gif"/>dodaj</a>.</td>
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
<td >{$number_of_rows_text}</td>
<td>{$display_to_display}</td>
<td align="right">{$number_of_rows_links}</td>
</tr>
</table>
</td>
</tr>
</table>