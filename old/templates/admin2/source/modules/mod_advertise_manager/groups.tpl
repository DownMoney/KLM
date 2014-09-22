<script type="text/javascript" src="{$__BaseJsRoot__}/flash_detection.js"></script>
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
			<option value="status0">wyłącz</option>
			<option value="status1">włącz</option>
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
	</tr>
</table>

</td>
</tr>
<tr><td>
<table class="dT" cellpadding="0" cellspacing="0"  >
<tr class="dTH">
<td width="10"><input type="checkbox" onClick="tableList.setALLRowChecked(this.checked);" class="checkbox" /></td>
<td>#</td>
<td>Nazwa</td>
<td align="center">Status</td>
<td align="center">Reklam</td>
<td align="right">Opcje</td>
<td width="13">&nbsp;</td>
</tr>
<tbody id="data_table_content" style="">
{foreach item=gr from=$groups_listing name="groups_listing"}
<tr id="row_{$gr.gr_id}" {if $gr.status == "1"}class="dTR" onmouseover="this.className='dTRO';" onmouseout="this.className='dTR'"{else} class="dTR0" onmouseover="this.className='dTRO0';" onmouseout="this.className='dTR0'"{/if}>
<td><input type="checkbox" onCLick="tableList.setRowChecked('{$gr.gr_id}');" id="row_checkbox_{$gr.gr_id}" class="rowCheckbox" value="{$gr.gr_id}" /></td>
<td width="20"><nobr><a href="#" onClick="tableList.loadRowItemInfo('{$gr.gr_id}'); return false"><img id="row_make_info_{$gr.gr_id}" src="{$__imageRoot__}/plus.gif" width="11" height="11" alt="" align="absmiddle" /></a><a href="{wt_href_tpl_link parameters="m=advertise&gID=`$gr.gr_id`"}"><img id="row_type_img_{$gr.gr_id}" src="{$__imageRoot__}/folder.png" width="16" height="16" align="absmiddle" alt="" /></a>&nbsp;[{$gr.gr_id|default:"&nbsp;"}]&nbsp;</nobr></td>

<td>{$gr.gr_name}</td>

{assign var="status_id" value=$gr.status_text.id}
{assign var="status_icon" value=$gr.status_text.icon}
{assign var="status_text" value=$gr.status_text.text}
{assign var="change_to" value=$gr.status_text.change_to}


<td align="center" id="row_status_{$gr.gr_id}">
 
{wt_check_permission perm_key="ncm_activ"}
<a href="#" onClick="tableList.setRowItemStatus('{$gr.gr_id}', '{$gr.status_text.change_to}'); return false">
{/wt_check_permission}
<img border="0" src="{$__imageRoot__}/{$status_icon}" width="12" height="12">
{wt_check_permission perm_key="new_activ"}
</a>
{/wt_check_permission}
</td>
<td align="center">{$gr.count_advertise}</td>
<td style="text-align: right;">
<a href="{wt_href_tpl_link get_params="rID|t|m" parameters="m=groups&t=addGroup&gID=`$gr.gr_id`"}" onclick="parent.action_form(this.href); return false;" title=" edytuj "><img src="{$__imageRoot__}/edit.png" alt=" edytuj " border="0" width="16" height="16"></a>
<a href="#" onClick="tableList.delRowItem('{$gr.gr_id}'); return false" title=" usuń "><img src="{$__imageRoot__}/trash.png" alt=" usuń" border="0" width="16" height="16"></a>
</td>
<td width="13">&nbsp;</td>
</tr>
{/foreach}

</tbody>
</table> 
</td></tr>
<tr class="dTFR">

</tr>
</table>

<script type="text/javascript">
Interface.setDataTableDim();
{literal}
var tableList = new ADM_TableList({
{/literal}
imageRoot: '{$__imageRoot__}',
statusChangeURL: '{wt_href_tpl_link parameters="a=setGroupStatus&gID="}',
itemInfoURL: '{wt_href_tpl_link parameters="m=groups&t=groupInfo&gID="}',
delURL: '{wt_href_tpl_link parameters="a=delGroup&gID="}'
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