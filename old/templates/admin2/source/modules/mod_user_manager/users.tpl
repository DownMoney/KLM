<script type="text/javascript">

{literal}
Event.observe(window, 'load', function() { Interface.setDataTableDim() });
var tableList = new ADM_TableList({
{/literal}
imageRoot: '{$__imageRoot__}/icons_large/',
itemInfoURL: '{wt_href_tpl_link mod_key="mod_user_manager" parameters="m=users&t=userInfo&uID="}',
statusChangeURL: '{wt_href_tpl_link mod_key="mod_user_manager" parameters="a=setUserStatus&uID="}',
delURL: '{wt_href_tpl_link mod_key="mod_user_manager" parameters="a=delUser&uID="}'
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
		case 'del':
				tableList.delRowItem(selected_rows[i], true);
		break;
	}
	
	}

}

{/literal}
</script>

<table class="cT">
<tr id="listAdvanceSearch" {if !$iSearch}style="display:none;"{/if}>
	<td class="listAdvanceSearch2">
		<a id="closeListAdvanceSearch" href="#" onClick="$('listAdvanceSearch').toggle(); Interface.setDataTableDim(); return false"><img src="{$__imageRoot__}/close_dialog.gif" alt="" /></a>
		{$searchUser_form}
	</td>
</tr>
<tr>
<td class="cTO" id="cTO">

<table>
	<tr>
		<td class="listSelectMark">
		<img src="{$__imageRoot__}/arrow_d.gif" align="absmiddle" alt="" />
<select name="listOperation" id="listOperation" onChange="makeListOperation(this);">
<option value="">--- wybierz ---</option>
<option value="status0">wyłącz</option>
<option value="status1">włącz</option>
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
		<form action="{wt_href_tpl_link parameters="t=SearchUser"}">
				<input name="mod" value="{wt_mod_id m=mod_user_manager}" id="mod" type="hidden">
				<input name="m" value="users" id="m" type="hidden">
				<input name="t" value="userSearch" id="t" type="hidden">
				<input {literal}onblur="if(this.value=='') { this.value='szukaj użytkowników ...'; }" onfocus="if(this.value=='szukaj użytkowników ...') { this.value=''; }"{/literal} id="gSearch" type="text" name="gSearch" value="{$smarty.get.gSearch|default:"szukaj użytkowników ..."}" /><a href="#" onClick="$('listAdvanceSearch').toggle(); Interface.setDataTableDim(); return false"></a>
		</form>
		</td>
	</tr>
</table>

</td>
</tr>

<tr><td>
<table class="dT dT-str" cellpadding="0" cellspacing="0">
<tr class="dTH">
<td width="10" class="dT-ch"><input type="checkbox" onClick="tableList.setALLRowChecked(this.checked);" class="checkbox" /># 
{wt_admin_sort_order i=0 c=$smarty.session.sort_orders.users}</td>
<td {if $smarty.session.sort_orders.users == 1}class="sortSelected"{/if}>Nazwisko
{wt_admin_sort_order i=1 c=$smarty.session.sort_orders.users}
</td>
<td {if $smarty.session.sort_orders.users == 2}class="sortSelected"{/if}>Imię
{wt_admin_sort_order i=2 c=$smarty.session.sort_orders.users}
</td>
<td {if $smarty.session.sort_orders.users == 4}class="sortSelected"{/if}>E-mail
{wt_admin_sort_order i=4 c=$smarty.session.sort_orders.users} Tel.
{wt_admin_sort_order i=7 c=$smarty.session.sort_orders.users}
</td>
<td {if $smarty.session.sort_orders.users == 5}class="sortSelected"{/if}>Firma
{wt_admin_sort_order i=6 c=$smarty.session.sort_orders.users} Miasto
{wt_admin_sort_order i=5 c=$smarty.session.sort_orders.users}
</td>
<td align="center" {if $smarty.session.sort_orders.users == 3}class="sortSelected"{/if}>Ak.
{wt_admin_sort_order i=3 c=$smarty.session.sort_orders.users}
</td>
<td class="dTOp">Opcje</td>
<![if !IE]>
<td width="13"></td>
<![endif]>
</tr>
<tbody id="data_table_content" style="">
{if $users_listing}
{foreach item=usr from=$users_listing name="users_listing"}
<tr id="row_{$usr.usr_id}" {if $usr.status == "1"}class="dTR{cycle values=", row2"}" onmouseover="this.addClassName('dTRO');" onmouseout="this.removeClassName('dTRO');"{else} class="dTR0{cycle values=", row2"}" onmouseover="this.addClassName('dTRO0');" onmouseout="this.removeClassName('dTRO0');"{/if} onClick="tableList.setRowClick('{$usr.usr_id}', this);" ondblclick="parent.action_form_large('{wt_href_tpl_link get_params="uID|t|m" parameters="m=users&t=addUser&uID=`$usr.usr_id`"}', 'Edycja użytkownika'); return false;">

<td class="dT-ch{if $smarty.session.sort_orders.users == 0} sortSelected{/if}"><input type="checkbox" onCLick="tableList.setRowClick('{$usr.usr_id}', this); tableList.setRowChecked('{$usr.usr_id}');" id="row_checkbox_{$usr.usr_id}" class="rowCheckbox" value="{$usr.usr_id}" /> <a href="#" onClick="tableList.loadRowItemInfo('{$usr.usr_id}'); return false"><img id="row_make_info_{$usr.usr_id}" src="{$__imageRoot__}/icons_large/plus.gif" align="absmiddle" /></a>
</td>
<td {if $smarty.session.sort_orders.users == 1}class="sortSelected"{/if}>{$usr.usr_last_name|default:"---"}</td>
<td {if $smarty.session.sort_orders.users == 2}class="sortSelected"{/if}>{$usr.usr_first_name|default:"---"}</td>

{assign var="status_id" value=$usr.status_text.id}
{assign var="status_icon" value=$usr.status_text.icon}
{assign var="status_text" value=$usr.status_text.text}
{assign var="change_to" value=$usr.status_text.change_to}

<td {if $smarty.session.sort_orders.users == 4}class="sortSelected"{/if}>{if $usr.usr_email}<a href="mailto:{$usr.usr_email}">{$usr.usr_email}</a>{else}---{/if}<br /><small>kom: {$usr.usr_mobile}</small>
</td>

<td {if $smarty.session.sort_orders.users == 5}class="sortSelected"{/if}>{$usr.usr_company|default:"---"}<br />
<small>{$usr.usr_city|default:"---"}</small></td>
<td align="center" id="row_status_{$usr.usr_id}" {if $smarty.session.sort_orders.users == 3}class="sortSelected"{/if}><a href="#" onClick="tableList.setRowItemStatus('{$usr.usr_id}', '{$usr.status_text.change_to}'); return false">
<img border="0" src="{$__imageRoot__}/icons_large/{$status_icon}"></td>
<td class="dTOp"><nobr>
<a href="{wt_href_tpl_link get_params="uID|t|m" parameters="m=users&t=addUser&uID=`$usr.usr_id`"}" onclick="parent.action_form_large(this.href, 'Edycja użytkownika'); return false;" title=" edytuj "><img src="{$__imageRoot__}/edit.png" alt=" edytuj " border="0" width="16" height="16"></a>

<a href="#" onClick="tableList.delRowItem('{$usr.usr_id}'); return false" title=" usuń "><img src="{$__imageRoot__}/trash.png" alt=" usuń" border="0" width="16" height="16"></nobr></a>

</td>
<![if !IE]>
<td width="13"></td>
<![endif]>
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
<td >{$number_of_items_text}</td>
<td>{$display_to_display}</td>
<td align="right">{$number_of_items_links}</td>
</tr>
</table>
</td>
</tr>
</table>