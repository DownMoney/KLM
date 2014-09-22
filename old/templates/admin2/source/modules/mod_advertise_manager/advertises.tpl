<script type="text/javascript">
{literal}

var ttInfoHint = 'Kliknij aby zobaczyć szczegółowe informacje o reklamie.';
var ttEdit = 'Kliknij aby edytować reklamę';
var ttEditHint = 'Kliknij aby edytować reklamę w tym języku: ';
var ttDelHint = 'Kliknij aby usunąć reklamę z serwisu.';
var ttGoToURL = 'Kliknij aby przejść do adresu: ';
var ttPreview = 'Kliknij aby zobaczyć tą reklamę';
var ttShowGroup = 'Zobacz wszystkie reklamy z grupy: ';
var ttDisable = 'Kliknij aby wyłączyć reklamę';
var ttEnable = 'Kliknij aby włączyć reklamę';


Event.observe(window, 'load', function() { Interface.setDataTableDim() } );

var tableList = new ADM_TableList({
{/literal}
imageRoot: '{$__imageRoot__}/icons_large/',
page: '{$smarty.get.page|default:1}',
statusChangeType: 'full',
maxRows: '{$smarty.session.results_to_display|default:50}',
itemInfoURL: '{wt_href_tpl_link parameters="m=advertise&t=advertiseInfo&aID="}',
statusChangeURL: '{wt_href_tpl_link parameters="a=setAdvertiseStatus&aID="}',
delURL: '{wt_href_tpl_link parameters="a=delAdvertise&aID="}'
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
	
	{/literal} var base_url = '{wt_href_tpl_link get_params="a|t"}';{literal}
			
		  var selected_rows_string = selected_rows.toString();	
			
		switch( action ) {
			case 'status0':
				new Ajax.Request(tableList.options.statusChangeURL+selected_rows_string+'&status=0', {asynchronous:true});
			break;	
			case 'status1':
				new Ajax.Request(tableList.options.statusChangeURL+selected_rows_string+'&status=1', {asynchronous:true});
			break;
			case 'del':
				new Ajax.Request(tableList.options.delURL+selected_rows_string, {asynchronous:true});
			break;
			{/literal}
			{if $__languages__}
				{foreach from=$__languages__ item="l" key="k"}
					case 'lng_status_0_{$l.id}':
					  new Ajax.Request(base_url+'&a=setAdvertiseLanguageStatus&aID='+selected_rows_string+'&status=0&language_id={$l.id}', {literal} { evalScripts:true, asynchronous:true, onSuccess: function() { document.location.href = document.location.href; } }); {/literal}
					break;
					case 'lng_status_1_{$l.id}':
					  new Ajax.Request(base_url+'&a=setAdvertiseLanguageStatus&aID='+selected_rows.toString()+'&status=1&language_id={$l.id}', {literal} { evalScripts:true, asynchronous:true, onSuccess: function() { document.location.href = document.location.href; } }); {/literal}
					break;
				{/foreach}
			{/if}
		{literal}
		}
			
	for(i=0; i<selected_rows.length;i++) {
		switch( action ) {
			case 'status0':
				tableList.setRowItemStatus(selected_rows[i], '0',true);
			break;	
			case 'status1':
				tableList.setRowItemStatus(selected_rows[i], '1',true);
			break;
			case 'del':
					tableList.delRowItem(selected_rows[i],true,true);
			break;
		}
	}
	
  
	
	
}

{/literal}
</script>

<table id="currentItemInfo" class="currentItemInfo" cellspacing="0">
	<tr>
		<td class="navigationBar">{$__navigationBar__}</td>
	</tr>
</table>

<table class="cT">
<tr>
<td class="cTO" id="cTO">

<table>
	<tr>
		<td class="listSelectMark">
			<b>Zaznaczone:</b>
			<select name="listOperation" id="listOperation" onChange="makeListOperation(this);">
			<option value="">--- wybierz ---</option>
			<optgroup label="-----------------">
			<option value="status0">wyłącz</option>
			<option value="status1" style="color:#090;">włącz</option>
			</optgroup>
			<optgroup label="-----------------">
			<option value="del" style="color:#F00;">usuń</option>
			</optgroup>
			<optgroup label="-----------------">
			</optgroup>
			{if $__languages__}	
			<optgroup label="Włącz w języku:">
				{foreach from=$__languages__ item="l" key="k"}
					<option value="lng_status_1_{$l.id}">{$l.name}</option>
				{/foreach} 
			</optgroup>
			<optgroup label="Wyłącz w języku:">
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
			<form action="{wt_href_tpl_link parameters="t=searchAdvertise"}">
					<input name="mod" value="{wt_mod_id m=mod_advertise_manager}" id="mod" type="hidden">
					<input name="m" value="advertise" id="m" type="hidden">
					<input name="t" value="searchAdvertise" id="t" type="hidden">
					<input id="gSearch" type="text" name="gSearch" value="{$smarty.get.gSearch}" /><a href="#" onClick="tableList.showAdvanceSearch(); return false"></a>
			</form>			
		</td>
	</tr>
</table>

</td>
</tr>


<tr><td>

<table class="dT" cellpadding="0" cellspacing="0">
<thead>
	<tr class="dTH">
		<td class="dT-ch{if $smarty.session.sort_orders.advertises == 0} sortSelected{/if}"><nobr><input type="checkbox" onClick="tableList.setALLRowChecked(this.checked);" class="checkbox" />#{wt_admin_sort_order i=0 c=$smarty.session.sort_orders.advertises}</nobr></td>
		<td {if $smarty.session.sort_orders.advertises == 1}class="sortSelected"{/if} colspan="2">Nazwa
		{wt_admin_sort_order i=1 c=$smarty.session.sort_orders.advertises}
		</td>
		<td align="center" {if $smarty.session.sort_orders.advertises == 2}class="sortSelected"{/if}>Wł.
		{wt_admin_sort_order i=2 c=$smarty.session.sort_orders.advertises}</td>
		<td>Typ {wt_admin_sort_order i=3 c=$smarty.session.sort_orders.advertises}</td>
		</td>
		{if !$smarty.get.gID}
		<td>Miejsce wyświetlania {wt_admin_sort_order i=4 c=$smarty.session.sort_orders.advertises}</td>
		{/if}
		<td align="right">Klik./Wyś.</td>

		<td class="dTOp">Opcje</td>
		<![if !IE]>
		<td width="13"></td>
		<![endif]>
	</tr>
</thead>
<tbody id="data_table_content" style="">

{if $advertise_listing}
{foreach item=ad from=$advertise_listing name="advertise_listing"}
<tr id="row_{$ad.ad_id}" {if $ad.status == "1"}class="dTR" onmouseover="this.className='dTRO';" onmouseout="this.className='dTR'"{else} class="dTR0" onmouseover="this.className='dTRO0';" onmouseout="this.className='dTR0'"{/if} onClick="tableList.setRowClick('{$ad.ad_id}', this);" ondblclick="parent.action_form_large('{wt_href_tpl_link get_params="aID|t|m" parameters="m=advertise&t=addAdvertise&aID=`$ad.ad_id`"}', 'Edycja reklamy'); return false;">

<td class="dT-ch{if $smarty.session.sort_orders.advertises == 0} sortSelected{/if}"><nobr><input type="checkbox" onCLick="tableList.setRowClick('{$ad.ad_id}', this); tableList.setRowChecked('{$ad.ad_id}');" id="row_checkbox_{$ad.ad_id}" class="rowCheckbox" value="{$ad.ad_id}" />
<a href="#" onClick="tableList.loadRowItemInfo('{$ad.ad_id}'); return false" onmouseover="parent.displayLeftHint(ttInfoHint); return false" onmouseout="parent.hideLeftHint(); return false"><img id="row_make_info_{$ad.ad_id}" src="{$__imageRoot__}/icons_large/plus.gif" alt="" align="absmiddle" /></a></nobr></td>

<td class="dT-lo{if $smarty.session.sort_orders.advertises == 1} sortSelected{/if}">
<a href="{wt_href_tpl_link parameters="m=advertise&t=previewAdvertise&aID=`$ad.ad_id`"}" onClick="popupWindow(this.href,'advertise','','','yes'); return false" target="_blank" onmouseover="parent.displayLeftHint(ttPreview); return false" onmouseout="parent.hideLeftHint(); return false">{wt_thumb_image 	
		src="mod_advertise/`$ad.ad_image`"  
		width="40"
		height="30"
		compress="75"
		show_blank="1"}</a>
</td>

<td {if $smarty.session.sort_orders.advertises == 1}class="sortSelected dT-n"{else} class="dT-n"{/if}>{$ad.ad_name}<br />
<small><a href="{$ad.ad_url}" target="_blank" title="{$ad.ad_url}" onmouseover="parent.displayLeftHint(ttGoToURL+'{$ad.ad_url}'); return false" onmouseout="parent.hideLeftHint(); return false">{$ad.ad_url|wt_split_str_over}</a></small>
{if $__languages__}<div class="dT-lng">{foreach from=$ad.languages_status key=i item=s}<a href="{wt_href_tpl_link get_params="aID|t|m" parameters="m=advertise&t=addAdvertise&aID=`$ad.ad_id`"}" onclick="parent.action_form_large(this.href, 'Edycja reklamy - język: {$__languagesid__.$i.name}'); return false;" title=" edytuj {$__languagesid__.$i.name} " onmouseover="parent.displayLeftHint(ttEditHint+'{$__languagesid__.$i.name}'); return false" onmouseout="parent.hideLeftHint(); return false"><img src="{$__imageRoot__}/flags/{$__languagesid__.$i.code}.gif" alt="{$__languagesid__.$i.name}" align="absmiddle"  {if $s == 0}class="ld"{/if} /></a>{/foreach}</div>{/if}

</td>

<td id="row_status_{$ad.ad_id}" {if $smarty.session.sort_orders.advertises == 2}class="sortSelected dT-s"{else} class="dT-s"{/if}><a href="#" onClick="tableList.setRowItemStatus('{$ad.ad_id}', '{$ad.status_text.change_to}'); return false" onmouseover="parent.displayLeftHint({if $ad.status == "0"}ttEnable{else}ttDisable{/if}); return false" onmouseout="parent.hideLeftHint(); return false"><img border="0" src="{$__imageRoot__}/icons_large/{$ad.status_text.icon}"></a></td>

<td>{$ad.ad_type_text}</td>

{if !$smarty.get.gID}
<td><small>
<ul>
{foreach from=$ad.groups item="g"}
<li><a href="{wt_href_tpl_link parameters="m=advertise&gID=`$g.gr_id`"}" onmouseover="parent.displayLeftHint(ttShowGroup+'{$g.gr_name}'); return false" onmouseout="parent.hideLeftHint(); return false">{$g.gr_name}</a></li>
{/foreach}
</ul></small></td>
{/if}

<td align="right"><small>{$ad.ad_clicks}<br />{$ad.ad_display}</small></td>

<td class="dTOp">
<a href="{wt_href_tpl_link get_params="aID|t|m" parameters="m=advertise&t=addAdvertise&aID=`$ad.ad_id`"}" onclick="parent.action_form_large(this.href, 'Edycja reklamy'); return false;" title=" edytuj " onmouseover="parent.displayLeftHint(ttEdit); return false" onmouseout="parent.hideLeftHint(); return false"><img src="{$__imageRoot__}/edit.png" alt=" edytuj " border="0" width="16" height="16"></a>
<a href="#" onClick="tableList.delRowItem('{$ad.ad_id}'); return false" title=" usuń " onmouseover="parent.displayLeftHint(ttDelHint); return false" onmouseout="parent.hideLeftHint(); return false"><img src="{$__imageRoot__}/trash.png" alt=" usuń" border="0" width="16" height="16"></a>
</td>
<td width="13">&nbsp;</td>
</tr>
{/foreach}
{else}
<tr>
	<td colspan="7">
<table class="noDataMess">
	<tr>
		<td>Nie dodałeś jeszcze żadnych reklam w tym miejscu.<br />
Aby dodać reklamę kliknij na przycisk <a onClick="parent.action_form_large(this.href, 'Nowa reklama'); return false;" href="{wt_href_tpl_link parameters="m=advertise&t=addAdvertise&gID=`$smarty.get.gID`&from=admin_list"}"><img align="absmiddle" src="{$__imageRoot__}/icons/add_content.gif"/>dodaj</a>.</td>
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