<?php /* Smarty version 2.6.16, created on 2013-04-29 08:42:55
         compiled from modules/mod_languages_manager/texts.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'wt_href_tpl_link', 'modules/mod_languages_manager/texts.tpl', 17, false),array('function', 'wt_mod_id', 'modules/mod_languages_manager/texts.tpl', 128, false),array('function', 'wt_admin_sort_order', 'modules/mod_languages_manager/texts.tpl', 150, false),array('modifier', 'strip_tags', 'modules/mod_languages_manager/texts.tpl', 174, false),array('modifier', 'truncate', 'modules/mod_languages_manager/texts.tpl', 174, false),array('modifier', 'default', 'modules/mod_languages_manager/texts.tpl', 177, false),)), $this); ?>
<script type="text/javascript">

// onmouseover="parent.displayLeftHint(prMoveHint); return false" onmouseout="parent.hideLeftHint();

var txtEditHint = 'Kliknij aby edytować wpis.';
var txtDelHint = 'Kliknij aby całkowicie usunąć wpis.';
var txtInfoHint = 'Kliknij aby zobaczyć szczegółowe informacje o wpisie.';
var genFilesHint = 'Kliknij aby wygenerować plik z wpisami dla tego modułu.';
<?php echo '

Event.observe(window, \'load\', function() { Interface.setDataTableDim(); } );
Event.observe(window, \'load\', function() { new ADM_TableNavigation() } );
var tableList = new ADM_TableList({
'; ?>

statusChangeType: 'full',
imageRoot: '<?php echo $this->_tpl_vars['__imageRoot__']; ?>
/icons_large/',
itemInfoURL: '<?php echo smarty_function_wt_href_tpl_link(array('mod_key' => 'mod_languages_manager','parameters' => "m=texts&t=textInfo&tID="), $this);?>
',
//statusChangeURL: '<?php echo smarty_function_wt_href_tpl_link(array('mod_key' => 'mod_languages_manager','parameters' => "a=setTextStatus&tID="), $this);?>
',
delURL: '<?php echo smarty_function_wt_href_tpl_link(array('mod_key' => 'mod_languages_manager','parameters' => "a=delText&from=admin_list&tID="), $this);?>
'
<?php echo ' 
});

makeListOperation = function(o) {

	var action = o.value;
	o.selectedIndex = 0;
	
	if( action == \'\' ) {
		return;
	}
	
	list_elems =	$(\'data_list_body\').getElementsByTagName(\'INPUT\');	
	selected_rows = new Array();
		for(i=0; i<list_elems.length;i++) {
			if(list_elems[i].className == \'rowCheckbox\' && list_elems[i].type == \'checkbox\' && list_elems[i].checked == true && list_elems[i].value > 0 ) {
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
		case \'del\':
			tableList.delRowItem(selected_rows[i], true);
		break;
	}	
	}

}

'; ?>


</script>

<?php if ($_GET['mod_id']): ?>
<script language="javascript" type="text/javascript">
<?php echo '
generateFiles = function(mod_id) {
	new Ajax.Request(\'';  echo smarty_function_wt_href_tpl_link(array('mod_key' => 'mod_languages_manager','parameters' => "a=generateFile&mID='+mod_id+'"), $this); echo '\', {asynchronous:true,
	onComplete: function(t) {
		var data = t.responseText;
		var message = \'\';
		if (data==\'ok\') {
			message = \'Wygenerowano plik.\'
		} else if(data=\'no_text\') {
			message = \'Nie znaleziono wpisów do zapisania.\';
		} else {
			message = \'Wystąpił błąd.\'
		}
		parent.$(\'system_message\').update(message);
		parent.$(\'system_message\').show();
	
		parent.Effect.Pulsate(\'system_message\', {duration: 1, pulses:1});
		setTimeout(function() { parent.Effect.Fade(\'system_message\'); }, 5000);
	
	}
	});
}

'; ?>

</script>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['__templateFSRoot__'])."admin2/source/modules/mod_languages_manager/sub/currentModInfo.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  endif; ?>

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
				<form action="<?php echo smarty_function_wt_href_tpl_link(array('parameters' => "m=texts&t=SearchText"), $this);?>
">
				<input name="mod" value="<?php echo smarty_function_wt_mod_id(array('m' => 'mod_languages_manager'), $this);?>
" id="mod" type="hidden">
				<input name="m" value="texts" id="m" type="hidden">
				<input name="t" value="textSearch" id="t" type="hidden">
				<input id="gSearch" type="text" name="gSearch" value="<?php echo $_GET['gSearch']; ?>
" /><a href="#" onClick="tableList.showAdvanceSearch(); return false"></a>
			</form>
		</td>
	</tr>
</table>

</td>
</tr>

<tr id="listAdvanceSearch" <?php if (! $this->_tpl_vars['iSearch']): ?>style="display:none;"<?php endif; ?>>
	<td class="listAdvanceSearch">
		<a id="closeListAdvanceSearch" href="#" onClick="tableList.hideAdvanceSearch(); return false"><img src="<?php echo $this->_tpl_vars['__imageRoot__']; ?>
/close_dialog.gif" alt="" /></a>
		<?php echo $this->_tpl_vars['searchText_form']; ?>

	</td>
</tr>
<tr><td>

<table class="dT dT-str" cellpadding="0" cellspacing="0">
<tr class="dTH">
<td class="dT-ch<?php if ($this->_tpl_vars['sort_orders']['texts'] == 0): ?> sortSelected<?php endif; ?>"><input type="checkbox" onClick="tableList.setALLRowChecked(this.checked);" class="checkbox" />#<?php echo smarty_function_wt_admin_sort_order(array('i' => 0,'c' => $this->_tpl_vars['sort_orders']['texts']), $this);?>
</td>
<td <?php if ($this->_tpl_vars['sort_orders']['texts'] == 1): ?>class="sortSelected"<?php endif; ?>>Treść
<?php echo smarty_function_wt_admin_sort_order(array('i' => 1,'c' => $this->_tpl_vars['sort_orders']['texts']), $this);?>

</td>
<td <?php if ($this->_tpl_vars['sort_orders']['texts'] == 2): ?>class="sortSelected"<?php endif; ?> align="left">Moduł
<?php echo smarty_function_wt_admin_sort_order(array('i' => 2,'c' => $this->_tpl_vars['sort_orders']['texts']), $this);?>
<br />
</td>
<td <?php if ($this->_tpl_vars['sort_orders']['texts'] == 3): ?>class="sortSelected"<?php endif; ?> align="left">Klucz
<?php echo smarty_function_wt_admin_sort_order(array('i' => 3,'c' => $this->_tpl_vars['sort_orders']['texts']), $this);?>
<br />
</td>
<td align="right">Języki<br /><small>uzup. / wyst. </td>
<td class="dTOp">Opcje</td>
<![if !IE]>
<td width="13"></td>
<![endif]>
</tr>
<tbody id="data_table_content">
<?php if ($this->_tpl_vars['texts_listing']):  $_from = $this->_tpl_vars['texts_listing']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['texts_listing'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['texts_listing']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['txt']):
        $this->_foreach['texts_listing']['iteration']++;
?>

<tr id="row_<?php echo $this->_tpl_vars['txt']['txt_id']; ?>
" class="dTR" onmouseover="this.className='dTRO';" onmouseout="this.className='dTR'" onClick="tableList.setRowClick('<?php echo $this->_tpl_vars['txt']['txt_id']; ?>
', this);"  ondblclick="parent.action_form_large('<?php echo smarty_function_wt_href_tpl_link(array('get_params' => "m|t|pID|from",'parameters' => "m=texts&t=addText&tID=".($this->_tpl_vars['txt']['txt_id'])."&from=admin_list"), $this);?>
', 'Edycja wpisu'); return false;">

<td class="dT-ch<?php if ($this->_tpl_vars['sort_orders']['texts'] == 0): ?> sortSelected<?php endif; ?>"><nobr><input type="checkbox" onCLick="tableList.setRowClick('<?php echo $this->_tpl_vars['txt']['txt_id']; ?>
', this); tableList.setRowChecked('<?php echo $this->_tpl_vars['txt']['txt_id']; ?>
');" id="row_checkbox_<?php echo $this->_tpl_vars['txt']['txt_id']; ?>
" class="rowCheckbox" value="<?php echo $this->_tpl_vars['txt']['txt_id']; ?>
" /> <a href="#" onClick="tableList.loadRowItemInfo('<?php echo $this->_tpl_vars['txt']['txt_id']; ?>
'); return false" onmouseover="parent.displayLeftHint(txtInfoHint); return false" onmouseout="parent.hideLeftHint(); return false"><img id="row_make_info_<?php echo $this->_tpl_vars['txt']['txt_id']; ?>
" src="<?php echo $this->_tpl_vars['__imageRoot__']; ?>
/icons_large/plus.gif" alt="" align="absmiddle" /></a></nobr></td>

<td class="dT-n<?php if ($this->_tpl_vars['sort_orders']['texts'] == 1): ?> sortSelected<?php endif; ?>"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['txt']['txt_value'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 50) : smarty_modifier_truncate($_tmp, 50)); ?>
</td>

<td align="left" <?php if ($this->_tpl_vars['sort_orders']['texts'] == 2): ?>class="sortSelected"<?php endif; ?>><small>
<a href="<?php echo smarty_function_wt_href_tpl_link(array('parameters' => "m=texts&mod_id=".($this->_tpl_vars['txt']['mod_id'])), $this);?>
" ><?php echo ((is_array($_tmp=@$this->_tpl_vars['txt']['mod_title'])) ? $this->_run_mod_handler('default', true, $_tmp, 'Globalny') : smarty_modifier_default($_tmp, 'Globalny')); ?>
</small></a></td>
<td align="left" <?php if ($this->_tpl_vars['sort_orders']['texts'] == 3): ?>class="sortSelected"<?php endif; ?>><small><?php echo $this->_tpl_vars['txt']['txt_key']; ?>
</small></td>
<td align="right">
<?php if ($this->_tpl_vars['txt']['saved_languages'] < $this->_tpl_vars['txt']['language_count']): ?>
	<b style="color: #F00;"><?php echo ((is_array($_tmp=@$this->_tpl_vars['txt']['saved_languages'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
</b>/<?php echo ((is_array($_tmp=@$this->_tpl_vars['txt']['language_count'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>

<?php else: ?>
	<?php echo ((is_array($_tmp=@$this->_tpl_vars['txt']['saved_languages'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
/<?php echo ((is_array($_tmp=@$this->_tpl_vars['txt']['language_count'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
</td>
<?php endif; ?>
<td class="dTOp">
<nobr>
<a href="<?php echo smarty_function_wt_href_tpl_link(array('get_params' => "m|t|pID|from",'parameters' => "m=texts&t=addText&tID=".($this->_tpl_vars['txt']['txt_id'])."&from=admin_list"), $this);?>
" onclick="parent.hideLeftHint(); parent.action_form_large(this.href, 'Edycja wpisu'); return false;" onmouseover="parent.displayLeftHint(txtEditHint); return false" onmouseout="parent.hideLeftHint(); return false"title=" edytuj "><img src="<?php echo $this->_tpl_vars['__imageRoot__']; ?>
/edit.png" alt=" edytuj " border="0" width="16" height="16"></a>
<a href="#" onClick="tableList.delRowItem('<?php echo $this->_tpl_vars['txt']['txt_id']; ?>
'); return false" onmouseover="parent.displayLeftHint(txtDelHint); return false" onmouseout="parent.hideLeftHint(); return false" title=" usuń "><img src="<?php echo $this->_tpl_vars['__imageRoot__']; ?>
/trash.png" alt=" usuń" border="0" width="16" height="16"></a>
</nobr>
</td>
<![if !IE]>
<td width="13"></td>
<![endif]>
</tr>
<?php endforeach; endif; unset($_from);  else: ?>
<tr>
	<td colspan="7">
<table class="noDataMess">
	<tr>
		<td>Nie dodałeś jeszcze żadnego wpisu<?php if ($_GET['mod_id']): ?> w tym module<?php endif; ?>.<br />
Aby dodać nowy wpis<?php if ($_GET['mod_id']): ?> w tym module<?php endif; ?> kliknij na przycisk <a onClick="parent.action_form_large(this.href, 'Nowy wpis'); return false;" href="<?php echo smarty_function_wt_href_tpl_link(array('parameters' => "m=texts&t=addText&mID=".($_GET['mod_id'])), $this);?>
"><img align="absmiddle" src="<?php echo $this->_tpl_vars['__imageRoot__']; ?>
/icons/add_content.gif"/>dodaj</a>.</td>
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