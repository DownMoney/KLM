<?php /* Smarty version 2.6.16, created on 2013-04-25 12:57:38
         compiled from modules/mod_configuration_manager/configuration.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'wt_href_tpl_link', 'modules/mod_configuration_manager/configuration.tpl', 10, false),array('function', 'wt_mod_id', 'modules/mod_configuration_manager/configuration.tpl', 77, false),array('function', 'wt_admin_sort_order', 'modules/mod_configuration_manager/configuration.tpl', 93, false),array('modifier', 'truncate', 'modules/mod_configuration_manager/configuration.tpl', 118, false),)), $this); ?>
<script type="text/javascript">
<?php echo '
Event.observe(window, \'load\', function() { new ADM_TableNavigation() });
Event.observe(window, \'load\', function() { Interface.setDataTableDim(); });

var tableList = new ADM_TableList({
'; ?>

statusChangeType: 'full',
imageRoot: '<?php echo $this->_tpl_vars['__imageRoot__']; ?>
/icons_large/',
itemInfoURL: '<?php echo smarty_function_wt_href_tpl_link(array('mod_key' => 'mod_configuration_manager','parameters' => "m=configuration&t=configurationInfo&cID="), $this);?>
',
delURL: '<?php echo smarty_function_wt_href_tpl_link(array('mod_key' => 'mod_configuration_manager','parameters' => "a=delConfiguration&from=admin_list&cID="), $this);?>
'
<?php echo ' 
});

makeListOperation = function(o) {

	if( o.value == \'\' ) {
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
	
	if(o.value == \'del\' && !confirm(\'Potrzebne ostateczne potwierdzenie, jesteś pewien, że chcesz usunąć zaznaczone rekordy ?\\n\\n PAMIĘTAJ USUWANIE JEST NIEODWRACALNE, NA TRWALE STRACISZ WSZYSTKIE USUWANE DANE !\') ) {
		return; 
	}
	
	for(i=0; i<selected_rows.length;i++) {
	switch( o.value ) {
		case \'del\':
			tableList.delRowItem(selected_rows[i], true);
		break;
	}	
	}
}
'; ?>

</script>

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
				<form action="<?php echo smarty_function_wt_href_tpl_link(array('parameters' => "t=searchConfiguration"), $this);?>
">
					<input name="mod" value="<?php echo smarty_function_wt_mod_id(array('m' => 'mod_configuration_manager'), $this);?>
" id="mod" type="hidden">
					<input name="m" value="configuration" id="m" type="hidden">
					<input name="t" value="searchConfiguration" id="t" type="hidden">
					<b>Szukaj:</b>
					<input type="text" name="gSearch" value="<?php echo $_GET['gSearch']; ?>
" /> 
				</form>
			</td>
	</tr>
</table>

</td>
</tr>

<tr><td>
<table class="dT" cellpadding="0" cellspacing="0">
<tr class="dTH">
<td width="10" class="dT-ch<?php if ($_SESSION['sort_orders']['configuration'] == 0): ?> sortSelected<?php endif; ?>"><input type="checkbox" onClick="tableList.setALLRowChecked(this.checked);" class="checkbox" /> <?php echo smarty_function_wt_admin_sort_order(array('i' => 0,'c' => $_SESSION['sort_orders']['configuration']), $this);?>
</td>
<td <?php if ($_SESSION['sort_orders']['configuration'] == 1): ?>class="sortSelected"<?php endif; ?> width="200">Nazwa
<?php echo smarty_function_wt_admin_sort_order(array('i' => 1,'c' => $_SESSION['sort_orders']['configuration']), $this);?>

</td>

<td <?php if ($_SESSION['sort_orders']['configuration'] == 2 || $_SESSION['sort_orders']['configuration'] == 3): ?>class="sortSelected"<?php endif; ?>>Klucz
<?php echo smarty_function_wt_admin_sort_order(array('i' => 2,'c' => $_SESSION['sort_orders']['configuration']), $this);?>

 / Wartość
<?php echo smarty_function_wt_admin_sort_order(array('i' => 3,'c' => $_SESSION['sort_orders']['configuration']), $this);?>
</td>

<td class="dTOp">Opcje</td>
<![if !IE]>
<td width="13"></td>
<![endif]>
</tr>
<tbody id="data_table_content">
<?php if ($this->_tpl_vars['configuration_listing']):  $_from = $this->_tpl_vars['configuration_listing']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['configuration_listing'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['configuration_listing']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['conf']):
        $this->_foreach['configuration_listing']['iteration']++;
?>

<tr id="row_<?php echo $this->_tpl_vars['conf']['configuration_id']; ?>
" class="dTR" onmouseover="this.className='dTRO';" onmouseout="this.className='dTR'" onClick="tableList.setRowClick('<?php echo $this->_tpl_vars['conf']['configuration_id']; ?>
', this);" ondblclick="parent.action_form_large('<?php echo smarty_function_wt_href_tpl_link(array('parameters' => "m=configuration&t=addConfiguration&cID=".($this->_tpl_vars['conf']['configuration_id'])."&from=admin_list"), $this);?>
', 'Edycja wpisu'); return false;">

<td class="dT-ch<?php if ($_SESSION['sort_orders']['configuration'] == 0): ?> sortSelected<?php endif; ?>" width="20"><nobr><input type="checkbox" onCLick="tableList.setRowClick('<?php echo $this->_tpl_vars['conf']['configuration_id']; ?>
', this); tableList.setRowChecked('<?php echo $this->_tpl_vars['conf']['configuration_id']; ?>
');" id="row_checkbox_<?php echo $this->_tpl_vars['conf']['configuration_id']; ?>
" class="rowCheckbox" value="<?php echo $this->_tpl_vars['conf']['configuration_id']; ?>
" /> <a href="#" onClick="tableList.loadRowItemInfo('<?php echo $this->_tpl_vars['conf']['configuration_id']; ?>
'); return false"><img id="row_make_info_<?php echo $this->_tpl_vars['conf']['configuration_id']; ?>
" src="<?php echo $this->_tpl_vars['__imageRoot__']; ?>
/icons_large/plus.gif" alt="" align="absmiddle" /></a></nobr></td> 

<td <?php if ($_SESSION['sort_orders']['configuration'] == 1): ?>class="sortSelected"<?php endif; ?> style="width:100px !important;"><?php echo $this->_tpl_vars['conf']['configuration_title']; ?>
</td>
<td class="<?php if ($_SESSION['sort_orders']['configuration'] == 2 || $_SESSION['sort_orders']['configuration'] == 3): ?>>sortSelected<?php endif; ?>"><b><?php echo $this->_tpl_vars['conf']['configuration_key']; ?>
</b><br />
<small><?php echo ((is_array($_tmp=$this->_tpl_vars['conf']['configuration_value'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 70) : smarty_modifier_truncate($_tmp, 70)); ?>
</small></td>
<td class="dTOp">
<nobr>
<a href="<?php echo smarty_function_wt_href_tpl_link(array('parameters' => "m=configuration&t=addConfiguration&cID=".($this->_tpl_vars['conf']['configuration_id'])."&from=admin_list"), $this);?>
" onclick="parent.action_form_large(this.href, 'Edycja wpisu'); return false;" title=" edytuj "><img src="<?php echo $this->_tpl_vars['__imageRoot__']; ?>
/edit.png" alt=" edytuj " border="0" width="16" height="16"></a>
<a href="#" onClick="tableList.delRowItem('<?php echo $this->_tpl_vars['conf']['configuration_id']; ?>
'); return false" title=" usuń "><img src="<?php echo $this->_tpl_vars['__imageRoot__']; ?>
/trash.png" alt=" usuń" border="0" width="16" height="16"></a>
</nobr>
</td>
<![if !IE]>
<td width="13">&nbsp;</td>
<![endif]>
</tr>
</tr>
<?php endforeach; endif; unset($_from);  else: ?>
<tr>
<td colspan="8" align="center" height="100%" valign="middle">BRAK REKORDÓW W BAZIE</td>
</tr>
<?php endif; ?>
</tbody>
</table> 
</td></tr>
<tr class="dTFR">
<td>
<table class="dTFRC">
<tr>
<td ><?php echo $this->_tpl_vars['number_of_rows_text']; ?>
</td>
<td><?php echo $this->_tpl_vars['display_to_display']; ?>
</td>
<td align="right"><?php echo $this->_tpl_vars['number_of_rows_links']; ?>
</td>
</tr>
</table>
</td>
</tr>
</table>