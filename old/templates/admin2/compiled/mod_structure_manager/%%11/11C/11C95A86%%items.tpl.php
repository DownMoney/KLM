<?php /* Smarty version 2.6.16, created on 2013-05-06 10:12:21
         compiled from modules/mod_structure_manager/items.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'modules/mod_structure_manager/items.tpl', 22, false),array('modifier', 'strip_tags', 'modules/mod_structure_manager/items.tpl', 211, false),array('modifier', 'truncate', 'modules/mod_structure_manager/items.tpl', 211, false),array('modifier', 'string_format', 'modules/mod_structure_manager/items.tpl', 226, false),array('modifier', 'date_format', 'modules/mod_structure_manager/items.tpl', 233, false),array('function', 'wt_href_tpl_link', 'modules/mod_structure_manager/items.tpl', 25, false),array('function', 'wt_mod_id', 'modules/mod_structure_manager/items.tpl', 157, false),array('function', 'wt_admin_sort_order', 'modules/mod_structure_manager/items.tpl', 174, false),array('function', 'cycle', 'modules/mod_structure_manager/items.tpl', 200, false),array('function', 'wt_thumb_image', 'modules/mod_structure_manager/items.tpl', 203, false),)), $this); ?>
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

<?php echo '
Event.observe(window, \'load\', function() { Interface.setDataTableDim() });

var tableList = new ADM_TableList({
'; ?>

statusChangeType: 'base',
imageRoot: '<?php echo $this->_tpl_vars['__imageRoot__']; ?>
/icons_large/',
page: <?php echo ((is_array($_tmp=@$_GET['page'])) ? $this->_run_mod_handler('default', true, $_tmp, 1) : smarty_modifier_default($_tmp, 1)); ?>
,
results: <?php echo $this->_tpl_vars['results']; ?>
,
resultsPP: <?php echo ((is_array($_tmp=@$this->_tpl_vars['resultsPP'])) ? $this->_run_mod_handler('default', true, $_tmp, 20) : smarty_modifier_default($_tmp, 20)); ?>
,
statusChangeURL: '<?php echo smarty_function_wt_href_tpl_link(array('mod_key' => 'mod_structure_manager','parameters' => "a=setItemStatus&iID="), $this);?>
',
delURL: '<?php echo smarty_function_wt_href_tpl_link(array('mod_key' => 'mod_structure_manager','parameters' => "a=delItem&cPath=".($_GET['cPath'])."&from=admin_list&iID="), $this);?>
',
itemInfoURL: '<?php echo smarty_function_wt_href_tpl_link(array('parameters' => "m=items&t=itemInfo&iID="), $this);?>
',
sortOrderURL: '<?php echo smarty_function_wt_href_tpl_link(array('parameters' => "a=setItemOrder&cPath=".($_GET['cPath'])."&iID="), $this);?>
'
<?php echo ' 
});
makeListOperation = function(o) {
	
	var action = o.value;
	o.selectedIndex = 0;
	
	if( action == \'\' ) {
		return;
	}
	
	list_elems =	document.getElementsByClassName(\'rowCheckbox\');	
	selected_rows = new Array();
		for(i=0; i<list_elems.length;i++) {
			if(list_elems[i].type == \'checkbox\' && list_elems[i].checked == true && list_elems[i].value > 0 ) {
				selected_rows.push(list_elems[i].value);
			}
		}
	selected_rows = selected_rows.compact();
	
	if( selected_rows.length == 0 ) {
		alert(\'Musisz coś zaznaczyć\');
		return;
	}
	
	
	if( !confirm(\'Potrzebne potwierdzenie, jesteś pewien, że chcesz wykonać operację ?\') ) {
		return;
	}
	
	
	
	if(action == \'del\' && !confirm(\'Potrzebne ostateczne potwierdzenie, jesteś pewien, że chcesz usunąć zaznaczone rekordy ?\\n\\n PAMIĘTAJ USUWANIE JEST NIEODWRACALNE, NA TRWALE STRACISZ WSZYSTKIE USUWANE DANE !\') ) {
		return; 
	}
	
	for(i=0; i<selected_rows.length;i++) {
		switch( action ) {
			case \'status0\':
				tableList.setRowItemStatus(selected_rows[i], \'0\');
			break;	
			case \'status1\':
				tableList.setRowItemStatus(selected_rows[i], \'1\');
			break;
		}
	}

var selected_rows_string = selected_rows.toString();


'; ?>
 var base_url = '<?php echo smarty_function_wt_href_tpl_link(array('mod_key' => 'mod_structure_manager','parameters' => "m=items&cPath=".($_GET['cPath'])), $this);?>
';<?php echo '

	switch( action ) {
		case \'move\':
			parent.action_form(base_url+\'&t=moveItem&iID=\'+selected_rows_string, \'Przenieś wpisy\');
		break;
		case \'del\':
			parent.action_form(base_url+\'&t=deleteItem&iID=\'+selected_rows_string, \'Usuń wpisy\');
			break;
		'; ?>

			<?php if ($this->_tpl_vars['__languages__']): ?>
				<?php $_from = $this->_tpl_vars['__languages__']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['l']):
?>
					case 'lng_status_0_<?php echo $this->_tpl_vars['l']['id']; ?>
':
					  new Ajax.Request(base_url+'&a=setItemLanguageStatus&iID='+selected_rows_string+'&status=0&language_id=<?php echo $this->_tpl_vars['l']['id']; ?>
', <?php echo ' { evalScripts:true, asynchronous:true, onSuccess: function() { document.location.href = document.location.href; } }); '; ?>

					break;
					case 'lng_status_1_<?php echo $this->_tpl_vars['l']['id']; ?>
':
					  new Ajax.Request(base_url+'&a=setItemLanguageStatus&iID='+selected_rows_string+'&status=1&language_id=<?php echo $this->_tpl_vars['l']['id']; ?>
', <?php echo ' { evalScripts:true, asynchronous:true, onSuccess: function() { document.location.href = document.location.href; } }); '; ?>

					break;
				<?php endforeach; endif; unset($_from); ?>
			<?php endif; ?>
		<?php echo '
	}
}

'; ?>

</script>
<?php if ($this->_tpl_vars['item_data']['params_array']['adminList_current_item'] != "-1"):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['__templateFSRoot__'])."admin2/source/modules/mod_structure_manager/sub/currentItemInfo.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  endif; ?>

<?php if ($this->_tpl_vars['item_data']['itt_nochildren'] == 1): ?>
<table class="noDataMess">
	<tr>
		<td>W tej części serwisu nie możesz dodać już nic.<br />
<?php if ($this->_tpl_vars['item_data']['itt_root_edit'] == '0' || $this->_tpl_vars['__isRoot__']): ?>
Jeżeli chcesz zmienić bieżący element, kliknij na link <a href="<?php echo smarty_function_wt_href_tpl_link(array('parameters' => "m=items&t=addItem&cPath=".($this->_tpl_vars['item_data']['cPath'])."&cID=".($_GET['cID'])."&iID=".($this->_tpl_vars['item_data']['it_id'])."&from=admin_list"), $this);?>
" onclick="parent.action_form_large(this.href, 'Edycja wpisu'); return false;" title=" edytuj "><img src="<?php echo $this->_tpl_vars['__imageRoot__']; ?>
/edit.png" alt=" edytuj " align="absmiddle" /> edytuj</a>.<?php endif; ?></td>
	</tr>
</table>
<?php else: ?>

<table class="cT">
<tr>
<td class="cTO" id="cTO">

<table>
	<tr>
		<td class="listSelectMark">
			<img src="<?php echo $this->_tpl_vars['__imageRoot__']; ?>
/arrow_d.gif" align="absmiddle" alt="" />
			<select name="listOperation" id="listOperation" onChange="makeListOperation(this);">
			<option value="">--- zaznaczone ---</option>
			<option value="status0">wyłącz</option>
			<option value="status1">włącz</option>
			<option value="move">przenieś</option>
			<option value="del">usuń</option>		
			<?php if ($this->_tpl_vars['__languages__']): ?>	
			<optgroup label="Publikuj w języku">
				<?php $_from = $this->_tpl_vars['__languages__']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['l']):
?>
					<option value="lng_status_1_<?php echo $this->_tpl_vars['l']['id']; ?>
"><?php echo $this->_tpl_vars['l']['name']; ?>
</option>
				<?php endforeach; endif; unset($_from); ?> 
			</optgroup>
			<optgroup label="NIE publikuj w języku">
				<?php $_from = $this->_tpl_vars['__languages__']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['l']):
?>
					<option value="lng_status_0_<?php echo $this->_tpl_vars['l']['id']; ?>
"><?php echo $this->_tpl_vars['l']['name']; ?>
</option>
				<?php endforeach; endif; unset($_from); ?> 
			</optgroup>
			<?php endif; ?>
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
		<form action="<?php echo smarty_function_wt_href_tpl_link(array('parameters' => "t=searchItems"), $this);?>
">
			<input name="mod" value="<?php echo smarty_function_wt_mod_id(array('m' => 'mod_structure_manager'), $this);?>
" id="mod" type="hidden">
			<input name="m" value="items" id="m" type="hidden">
			<input name="t" value="searchItems" id="t" type="hidden">
			<input type="text" id="gSearch" name="gSearch" value="<?php echo $_GET['gSearch']; ?>
" />
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
<td class="dT-ch"><input type="checkbox" onClick="tableList.setALLRowChecked(this.checked);" class="checkbox" />#<?php echo smarty_function_wt_admin_sort_order(array('i' => 0,'c' => $this->_tpl_vars['sort_orders']['items']), $this);?>
</td>
<td <?php if ($this->_tpl_vars['sort_orders']['items'] == 1): ?>class="sortSelected"<?php endif; ?>  <?php if ($this->_tpl_vars['item_data']['params_array']['adminList_show_logo'] != "-1"): ?>colspan="2"<?php endif; ?>>Nazwa
<?php echo smarty_function_wt_admin_sort_order(array('i' => 1,'c' => $this->_tpl_vars['sort_orders']['items']), $this);?>

</td>
<?php $_from = $this->_tpl_vars['table_fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['f']):
?>
	<td><?php echo $this->_tpl_vars['f']; ?>
</td>
<?php endforeach; endif; unset($_from);  if ($this->_tpl_vars['item_data']['params_array']['adminList_it_type'] != "-1"): ?><td class="dT-t<?php if ($this->_tpl_vars['sort_orders']['items'] == 4): ?> sortSelected<?php endif; ?>">Typ
<?php echo smarty_function_wt_admin_sort_order(array('i' => 4,'c' => $this->_tpl_vars['sort_orders']['items']), $this);?>

</td><?php endif;  if ($this->_tpl_vars['item_data']['params_array']['adminList_sort_order'] != "-1"): ?><td class="dT-so<?php if ($this->_tpl_vars['sort_orders']['items'] == 2): ?> sortSelected<?php endif; ?>">Kolejność
<?php echo smarty_function_wt_admin_sort_order(array('i' => 2,'c' => $this->_tpl_vars['sort_orders']['items']), $this);?>

</td><?php endif;  if ($this->_tpl_vars['item_data']['params_array']['adminList_status'] != "-1"): ?><td class="dT-s<?php if ($this->_tpl_vars['sort_orders']['items'] == 3): ?> sortSelected<?php endif; ?>">Wł.
<?php echo smarty_function_wt_admin_sort_order(array('i' => 3,'c' => $this->_tpl_vars['sort_orders']['items']), $this);?>

</td><?php endif;  if ($this->_tpl_vars['item_data']['params_array']['adminList_date_added'] == '1' || $this->_tpl_vars['item_data']['params_array']['adminList_date_publish'] == '1'): ?><td class="<?php if ($this->_tpl_vars['sort_orders']['items'] == 5 || $this->_tpl_vars['sort_orders']['items'] == 6): ?> sortSelected<?php endif; ?>">Data <?php if ($this->_tpl_vars['item_data']['params_array']['adminList_date_added'] == '1'):  echo smarty_function_wt_admin_sort_order(array('i' => 5,'c' => $this->_tpl_vars['sort_orders']['items']), $this); elseif ($this->_tpl_vars['item_data']['params_array']['adminList_date_publish'] != "-1"):  echo smarty_function_wt_admin_sort_order(array('i' => 6,'c' => $this->_tpl_vars['sort_orders']['items']), $this); endif; ?></td><?php endif;  if ($this->_tpl_vars['item_data']['params_array']['adminList_options'] == '1' || $this->_tpl_vars['__isRoot__']): ?><td class="dTOp">Opcje</td><?php endif; ?>
<![if !IE]>
<td width="13"></td>
<![endif]>
</tr>
</thead>
<tbody id="data_table_content">
<?php if ($this->_tpl_vars['items_listing']):  $_from = $this->_tpl_vars['items_listing']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['items_listing'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['items_listing']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['it']):
        $this->_foreach['items_listing']['iteration']++;
?>
<tr id="row_<?php echo $this->_tpl_vars['it']['it_id']; ?>
" <?php if ($this->_tpl_vars['it']['status'] == '1'): ?>class="dTR<?php echo smarty_function_cycle(array('values' => ", row2"), $this);?>
" onmouseover="this.addClassName('dTRO');" onmouseout="this.removeClassName('dTRO');"<?php else: ?> class="dTR0<?php echo smarty_function_cycle(array('values' => ", row2"), $this);?>
" onmouseover="this.addClassName('dTRO0');" onmouseout="this.removeClassName('dTRO0');"<?php endif; ?> onClick="tableList.setRowClick('<?php echo $this->_tpl_vars['it']['it_id']; ?>
', this);" <?php if ($this->_tpl_vars['it']['itt_root_edit'] == '0' || $this->_tpl_vars['__isRoot__']): ?>ondblclick="parent.action_form_large('<?php echo smarty_function_wt_href_tpl_link(array('parameters' => "m=items&t=addItem&cPath=".($_GET['cPath'])."&iID=".($this->_tpl_vars['it']['it_id'])."&from=admin_list"), $this);?>
', 'Edycja wpisu<?php if ($this->_tpl_vars['__languages__']): ?> - język: <?php echo $this->_tpl_vars['__languagesCurLanguage__']['name'];  endif; ?>'); return false;"<?php endif; ?>>

<td class="dT-ch"><nobr><input type="checkbox" onCLick="tableList.setRowClick('<?php echo $this->_tpl_vars['it']['it_id']; ?>
', this); tableList.setRowChecked('<?php echo $this->_tpl_vars['it']['it_id']; ?>
');" id="row_checkbox_<?php echo $this->_tpl_vars['it']['it_id']; ?>
" class="rowCheckbox" value="<?php echo $this->_tpl_vars['it']['it_id']; ?>
" /> <a href="#" onClick="tableList.loadRowItemInfo('<?php echo $this->_tpl_vars['it']['it_id']; ?>
'); return false" onmouseover="parent.displayLeftHint(prInfoHint); return false" onmouseout="parent.hideLeftHint(); return false"><img id="row_make_info_<?php echo $this->_tpl_vars['it']['it_id']; ?>
" src="<?php echo $this->_tpl_vars['__imageRoot__']; ?>
/icons_large/plus.gif" alt="" align="absmiddle" /></a></nobr></td>
<?php if ($this->_tpl_vars['item_data']['params_array']['adminList_show_logo'] != "-1"): ?><td class="dT-lo<?php if ($this->_tpl_vars['sort_orders']['items'] == 1): ?> sortSelected<?php endif; ?>"><?php if ($this->_tpl_vars['it']['itt_nochildren'] == '0' || $this->_tpl_vars['it']['it_id2']): ?><a href="<?php echo smarty_function_wt_href_tpl_link(array('mod_key' => 'mod_structure_manager','parameters' => "cPath=".($this->_tpl_vars['it']['cPath'])), $this);?>
" onmouseover="parent.displayLeftHint(prItemsHint); return false" onmouseout="parent.hideLeftHint(); return false"><?php endif;  echo smarty_function_wt_thumb_image(array('src' => "mod_structure/".($this->_tpl_vars['it']['media_path'])."/".($this->_tpl_vars['it']['it_logo']),'width' => '40','height' => '30','compress' => '75','show_blank' => '1'), $this); endif;  if ($this->_tpl_vars['it']['itt_nochildren'] == '0' || $this->_tpl_vars['it']['it_id2']): ?></a></td><?php endif; ?>
<td class="dT-n<?php if ($this->_tpl_vars['sort_orders']['items'] == 1): ?> sortSelected<?php endif; ?>"><?php if ($this->_tpl_vars['it']['itt_nochildren'] == '0' || $this->_tpl_vars['it']['it_id2']): ?><a href="<?php echo smarty_function_wt_href_tpl_link(array('mod_key' => 'mod_structure_manager','parameters' => "cPath=".($this->_tpl_vars['it']['cPath'])), $this);?>
" onmouseover="parent.displayLeftHint(prItemsHint); return false" onmouseout="parent.hideLeftHint(); return false"><?php endif;  if ($this->_tpl_vars['it']['it_name2']):  echo $this->_tpl_vars['it']['it_name']; ?>
<br /><?php endif; ?> <?php if ($this->_tpl_vars['it']['itt_key'] == 'shortcut'): ?><small>Skrót do: </small><?php elseif ($this->_tpl_vars['it']['itt_key'] == 'copy'): ?><small>Kopia: </small><?php endif; ?> <?php if ($this->_tpl_vars['it']['it_name2']): ?> <?php echo $this->_tpl_vars['it']['it_name2']; ?>
 <?php else: ?> <?php echo $this->_tpl_vars['it']['it_name']; ?>
 <?php endif; ?> <?php if ($this->_tpl_vars['it']['itt_nochildren'] == '0' || $this->_tpl_vars['it']['it_id2']): ?></a><?php endif;  if ($this->_tpl_vars['it']['it_id2']): ?><br /><small><a href="<?php echo smarty_function_wt_href_tpl_link(array('mod_key' => 'mod_structure_manager','parameters' => "cPath=".($this->_tpl_vars['it']['cPath'])), $this);?>
" onmouseover="parent.displayLeftHint(prItemsHint); return false" onmouseout="parent.hideLeftHint(); return false"><img src="<?php echo $this->_tpl_vars['__imageRoot__']; ?>
/shorcut_go.gif" alt="idź" align="absmiddle" /> przejdź do docelowego wpisu</a> </small><br /><?php endif;  if ($this->_tpl_vars['it']['it_desc_short']): ?><br /><small><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['it']['it_desc_short'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 100) : smarty_modifier_truncate($_tmp, 100)); ?>
</small><?php endif;  if ($this->_tpl_vars['__languages__'] && $this->_tpl_vars['it']['itt_disable_languages'] != '1' && $this->_tpl_vars['item_data']['params_array']['adminList_show_languages'] != "-1"): ?><div class="dT-lng"><?php $_from = $this->_tpl_vars['it']['languages_status']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['i'] => $this->_tpl_vars['s']):
?><a href="<?php echo smarty_function_wt_href_tpl_link(array('parameters' => "m=items&t=addItem&cPath=".($_GET['cPath'])."&iID=".($this->_tpl_vars['it']['it_id'])."&from=admin_list&language_id=".($this->_tpl_vars['i'])), $this);?>
" onclick="parent.action_form_large(this.href, 'Edycja wpisu - język: <?php echo $this->_tpl_vars['__languagesid__'][$this->_tpl_vars['i']]['name']; ?>
'); return false;" title=" edytuj <?php echo $this->_tpl_vars['__languagesid__'][$this->_tpl_vars['i']]['name']; ?>
 " onmouseover="parent.displayLeftHint(prEditHint); return false" onmouseout="parent.hideLeftHint(); return false"><img src="<?php echo $this->_tpl_vars['__imageRoot__']; ?>
/flags/<?php echo $this->_tpl_vars['__languagesid__'][$this->_tpl_vars['i']]['code']; ?>
.gif" alt="<?php echo $this->_tpl_vars['__languagesid__'][$this->_tpl_vars['i']]['name']; ?>
" align="absmiddle"  <?php if ($this->_tpl_vars['s'] == 0): ?>class="ld"<?php endif; ?> /></a><?php endforeach; endif; unset($_from); ?></div><?php endif;  if ($this->_tpl_vars['__isRoot__']): ?><br style="clear:both;" /><?php if ($this->_tpl_vars['it']['itt_root_show'] == '1'): ?><img align="absmiddle" src="<?php echo $this->_tpl_vars['__imageRoot__']; ?>
/root_view.gif" alt="ROOT VIEW" width="12" height="12" /> <?php endif;  if ($this->_tpl_vars['it']['itt_root_edit'] == '1'): ?><img align="absmiddle" src="<?php echo $this->_tpl_vars['__imageRoot__']; ?>
/root_edit.gif" alt="ROOT EDIT" width="12" height="12" /> <?php endif;  if ($this->_tpl_vars['it']['itt_root_addchildren'] == '1'): ?><img align="absmiddle" src="<?php echo $this->_tpl_vars['__imageRoot__']; ?>
/root_addchild.gif" alt="ROOT ADD CHILDREN" width="12" height="12" /> <?php endif;  endif; ?>
</td>
<?php $_from = $this->_tpl_vars['table_fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['field_key'] => $this->_tpl_vars['f']):
?>
	<td class="<?php if ($this->_tpl_vars['it']['fields'][$this->_tpl_vars['field_key']]['t'] == 'date'): ?>ar<?php endif; ?>">
	<?php if ($this->_tpl_vars['it']['fields'][$this->_tpl_vars['field_key']]['t'] == 'multi_select_item'): ?>
		<ul>
		<?php $_from = $this->_tpl_vars['it']['fields'][$this->_tpl_vars['field_key']]['n']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['fi']):
?>		  
			<li><a href="<?php echo smarty_function_wt_href_tpl_link(array('parameters' => "m=items&t=itemInfo&iID=".($this->_tpl_vars['fi']['it_id'])."&tFile="), $this);?>
" onClick="popupWindow(this.href, 'itemInfo', '750', '600', 'yes'); return false"><?php echo $this->_tpl_vars['fi']['it_name']; ?>
</a></li>
		<?php endforeach; endif; unset($_from); ?>
		</ul>
	<?php elseif ($this->_tpl_vars['it']['fields'][$this->_tpl_vars['field_key']]['t'] == 'files'): ?>	
		<ul>
		<?php $_from = $this->_tpl_vars['it']['fields'][$this->_tpl_vars['field_key']]['n']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['files'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['files']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['fi']):
        $this->_foreach['files']['iteration']++;
?>
			<li style="background:none;padding-left:0;"><?php if (file_exists ( ($this->_tpl_vars['__imageRoot__'])."/files/".($this->_tpl_vars['fi']['ext']).".gif" )): ?><img src="<?php echo $this->_tpl_vars['__imageRoot__']; ?>
/files/<?php echo $this->_tpl_vars['fi']['ext']; ?>
.gif" align="absmiddle" /><?php else: ?><img src="<?php echo $this->_tpl_vars['__imageRoot__']; ?>
/files/default.gif" align="absmiddle" /><?php endif; ?> <a href="<?php echo smarty_function_wt_href_tpl_link(array('parameters' => "m=items&t=itemInfo&iID=".($this->_tpl_vars['fi']['it_id'])."&tFile="), $this);?>
" onClick="popupWindow(this.href, 'itemInfo', '750', '600', 'yes'); return false"><?php echo ((is_array($_tmp=@$this->_tpl_vars['fi']['name'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['fi']['file']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['fi']['file'])); ?>
</a> <small>(<?php echo $this->_tpl_vars['fi']['ext']; ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['fi']['size'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
MB)</small></li>
		<?php endforeach; endif; unset($_from); ?>
		<?php if ($this->_foreach['files']['total'] > 1): ?>
			<li><a href="<?php echo smarty_function_wt_href_tpl_link(array('parameters' => "m=items&t=itemInfo&iID=".($this->_tpl_vars['it']['it_id'])."&tFile="), $this);?>
" onClick="popupWindow(this.href, 'itemInfo', '750', '600', 'yes'); return false"><b>wszystkie pliki &raquo;</b></a></li>
		<?php endif; ?>
		</ul>
	<?php elseif ($this->_tpl_vars['it']['fields'][$this->_tpl_vars['field_key']]['t'] == 'date'): ?>
		<nobr><?php echo ((is_array($_tmp=$this->_tpl_vars['it']['fields'][$this->_tpl_vars['field_key']]['n'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%a, %d %B %Y") : smarty_modifier_date_format($_tmp, "%a, %d %B %Y")); ?>
</nobr>
	<?php elseif ($this->_tpl_vars['it']['fields'][$this->_tpl_vars['field_key']]['t'] == 'select'): ?>
		<?php echo $this->_tpl_vars['it']['fields'][$this->_tpl_vars['field_key']]['n']['fi_name']; ?>

	<?php else: ?>
		<?php echo $this->_tpl_vars['it']['fields'][$this->_tpl_vars['field_key']]['n']; ?>

	<?php endif; ?>
	</td>
<?php endforeach; endif; unset($_from); ?>


<?php if ($this->_tpl_vars['item_data']['params_array']['adminList_it_type'] != "-1"): ?>
<td class="dT-t<?php if ($this->_tpl_vars['sort_orders']['items'] == 4): ?> sortSelected<?php endif; ?>"><img id="row_type_img_<?php echo $this->_tpl_vars['it']['it_id']; ?>
" src="<?php echo $this->_tpl_vars['__imageRoot__']; ?>
/tree/<?php echo $this->_tpl_vars['it']['itt_ico']; ?>
_s.gif" align="absmiddle" alt="<?php echo $this->_tpl_vars['it']['itt_name']; ?>
" /><br />
<small><?php if ($this->_tpl_vars['__isRoot__']): ?><a href="<?php echo smarty_function_wt_href_tpl_link(array('parameters' => "m=fields&tID=".($this->_tpl_vars['it']['it_type'])), $this);?>
"><?php echo $this->_tpl_vars['it']['itt_name']; ?>
</a><?php else:  echo $this->_tpl_vars['it']['itt_name'];  endif; ?></small></td>
<?php endif;  if ($this->_tpl_vars['item_data']['params_array']['adminList_sort_order'] != "-1"): ?>
<td <?php if ($this->_tpl_vars['sort_orders']['items'] == 2): ?>class="sortSelected dT-so"<?php else: ?> class="dT-so"<?php endif; ?>>
<?php if ($this->_tpl_vars['sort_orders']['items'] == 2): ?>
<nobr><a href="#" onCLick="tableList.setSortOrder('<?php echo $this->_tpl_vars['it']['it_id']; ?>
', 'top'); return false" title=" przesuń na samą górę " onmouseover="parent.displayLeftHint(prSOTopHint); return false" onmouseout="parent.hideLeftHint(); return false"><img border="0" src="<?php echo $this->_tpl_vars['__imageRoot__']; ?>
/icons_large/order_arrow_top.gif" align="absmiddle"></a>
<a href="#" onCLick="tableList.setSortOrder('<?php echo $this->_tpl_vars['it']['it_id']; ?>
', 'up'); return false" title=" przesuń wyżej " onmouseover="parent.displayLeftHint(prSOUpHint); return false" onmouseout="parent.hideLeftHint(); return false"><img border="0" src="<?php echo $this->_tpl_vars['__imageRoot__']; ?>
/icons_large/order_arrow_up.gif" align="absmiddle"></a>
<a href="#" onCLick="tableList.setSortOrder('<?php echo $this->_tpl_vars['it']['it_id']; ?>
', 'down'); return false" title=" przesuń niżej " onmouseover="parent.displayLeftHint(prSODownHint); return false" onmouseout="parent.hideLeftHint(); return false"><img border="0" src="<?php echo $this->_tpl_vars['__imageRoot__']; ?>
/icons_large/order_arrow_down.gif" align="absmiddle"></a>
<a href="#" onCLick="tableList.setSortOrder('<?php echo $this->_tpl_vars['it']['it_id']; ?>
', 'bottom'); return false" title=" przesuń na sam dół " onmouseover="parent.displayLeftHint(prSOBottomHint); return false" onmouseout="parent.hideLeftHint(); return false"><img border="0" src="<?php echo $this->_tpl_vars['__imageRoot__']; ?>
/icons_large/order_arrow_bottom.gif" align="absmiddle"></a></nobr>
<?php else: ?>
aby ustawiać kolejność zmień sortowanie
<?php endif; ?>
</td>
<?php endif;  if ($this->_tpl_vars['item_data']['params_array']['adminList_status'] != "-1"): ?>
<td id="row_status_<?php echo $this->_tpl_vars['it']['it_id']; ?>
" <?php if ($this->_tpl_vars['sort_orders']['items'] == 3): ?>class="sortSelected dT-s"<?php else: ?> class="dT-s"<?php endif; ?>><a href="#" onClick="tableList.setRowItemStatus('<?php echo $this->_tpl_vars['it']['it_id']; ?>
', '<?php echo $this->_tpl_vars['it']['status_text']['change_to']; ?>
'); return false"><img border="0" src="<?php echo $this->_tpl_vars['__imageRoot__']; ?>
/icons_large/<?php echo $this->_tpl_vars['it']['status_text']['icon']; ?>
"></a>
</td>
<?php endif;  if ($this->_tpl_vars['item_data']['params_array']['adminList_date_added'] == '1' || $this->_tpl_vars['item_data']['params_array']['adminList_date_publish'] == '1'): ?>
<td class="ar">
<?php if ($this->_tpl_vars['item_data']['params_array']['adminList_date_added'] == '1'): ?>
	<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['it']['date_added'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)))) ? $this->_run_mod_handler('date_format', true, $_tmp, "%a, %d %b %y<br />%H:%M:%S") : smarty_modifier_date_format($_tmp, "%a, %d %b %y<br />%H:%M:%S")); ?>

<?php endif;  if ($this->_tpl_vars['item_data']['params_array']['adminList_date_publish'] == '1'): ?>
	<?php echo ((is_array($_tmp=$this->_tpl_vars['it']['publish_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%a, %d %b %y<br />%H:%M:%S") : smarty_modifier_date_format($_tmp, "%a, %d %b %y<br />%H:%M:%S")); ?>

<?php endif; ?>
</td><?php endif; ?>

<?php if (( $this->_tpl_vars['it']['itt_root_edit'] == '0' || $this->_tpl_vars['__isRoot__'] ) || ( ! $this->_tpl_vars['__isRoot__'] && $this->_tpl_vars['item_data']['params_array']['adminList_options'] != "-1" && $_GET['cPath'] != "" )): ?>
<td class="dTOp">
<a href="<?php echo smarty_function_wt_href_tpl_link(array('parameters' => "m=items&t=moveItem&cPath=".($_GET['cPath'])."&iID=".($this->_tpl_vars['it']['it_id'])), $this);?>
" onclick="parent.action_form(this.href, 'Przenieś wpis'); return false;" title=" przenieś " onmouseover="parent.displayLeftHint(prMoveHint); return false" onmouseout="parent.hideLeftHint(); return false"><img src="<?php echo $this->_tpl_vars['__imageRoot__']; ?>
/move.png" alt=" przenieś " /></a>
<a href="<?php echo smarty_function_wt_href_tpl_link(array('parameters' => "m=items&t=addItem&cPath=".($_GET['cPath'])."&iID=".($this->_tpl_vars['it']['it_id'])."&from=admin_list"), $this);?>
" onclick="parent.action_form_large(this.href, 'Edycja wpisu<?php if ($this->_tpl_vars['__languages__']): ?> - język: <?php echo $this->_tpl_vars['__languagesCurLanguage__']['name'];  endif; ?>'); return false;" title=" edytuj " onmouseover="parent.displayLeftHint(prEditHint); return false" onmouseout="parent.hideLeftHint(); return false"><img src="<?php echo $this->_tpl_vars['__imageRoot__']; ?>
/edit.png" alt=" edytuj " /></a> 
<a href="#" onClick="parent.action_form('<?php echo smarty_function_wt_href_tpl_link(array('mod_key' => 'mod_structure_manager','parameters' => "m=items&t=deleteItem&cPath=".($_GET['cPath'])."&iID=".($this->_tpl_vars['it']['it_id'])), $this);?>
', 'Usuń wpis')" title=" usuń " onmouseover="parent.displayLeftHint(prDelHint); return false" onmouseout="parent.hideLeftHint(); return false"><img src="<?php echo $this->_tpl_vars['__imageRoot__']; ?>
/trash.png" alt=" usuń" /></a>
</td>
<?php else: ?>
<td class="dTOp">---</td>
<?php endif; ?>
<![if !IE]>
<td width="13">&nbsp;</td>
<![endif]>
</tr>
<?php endforeach; endif; unset($_from);  else: ?>
<tr>
	<td colspan="7">
<table class="noDataMess">
	<tr>
		<td>
		<?php if (( $this->_tpl_vars['item_data']['itt_root_addchildren'] == '1' && $this->_tpl_vars['__isRoot__'] ) || $this->_tpl_vars['item_data']['itt_root_addchildren'] == '0'): ?>
		Nie dodałeś jeszcze żadnego elementu w tej części strony.<br />
Aby dodać w tym miejscu nowy element kliknij na przycisk <a onClick="parent.action_form_large(this.href, 'Nowy wpis'); return false;" href="<?php echo smarty_function_wt_href_tpl_link(array('parameters' => "m=items&t=addItem&cPath=".($_GET['cPath'])."&from=admin_list"), $this);?>
"><img align="absmiddle" src="<?php echo $this->_tpl_vars['__imageRoot__']; ?>
/icons/add_content.gif"/>dodaj</a>.
		<?php else: ?>
		W tej części serwisu nie możesz dodać już nic.
		<?php endif; ?>

</td>
	</tr>
</table>
</td>
</tr>
<?php endif; ?>
</tbody>
</table> 
</td></tr>
<tr class="dTFR">
<td>
<table class="dTFRC">
<tr>
<td ><?php echo $this->_tpl_vars['number_of_items_text']; ?>
</td>
<td><?php echo $this->_tpl_vars['display_to_display']; ?>
</td>
<td align="right"><?php echo $this->_tpl_vars['number_of_items_links']; ?>
</td>
</tr>
</table>
</td>
</tr> 
</table>
<?php endif; ?>
<script type="text/javascript">
parent.$('navTabModLink').update('<?php echo ((is_array($_tmp=@$this->_tpl_vars['item_data']['it_name'])) ? $this->_run_mod_handler('default', true, $_tmp, 'struktura') : smarty_modifier_default($_tmp, 'struktura')); ?>
');
</script>