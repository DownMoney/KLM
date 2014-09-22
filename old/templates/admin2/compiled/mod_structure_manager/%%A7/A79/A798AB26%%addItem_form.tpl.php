<?php /* Smarty version 2.6.16, created on 2013-04-29 08:34:16
         compiled from addItem_form.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('insert', 'formaddinputpart', 'addItem_form.tpl', 1, false),array('insert', 'formadddatapart', 'addItem_form.tpl', 100, false),array('insert', 'formaddlabelpart', 'addItem_form.tpl', 107, false),array('modifier', 'strip_quotas', 'addItem_form.tpl', 22, false),array('modifier', 'default', 'addItem_form.tpl', 78, false),array('modifier', 'upper', 'addItem_form.tpl', 297, false),array('modifier', 'date_format', 'addItem_form.tpl', 580, false),array('function', 'wt_href_tpl_link', 'addItem_form.tpl', 44, false),array('function', 'wt_init_editor', 'addItem_form.tpl', 124, false),array('function', 'wt_thumb_image', 'addItem_form.tpl', 153, false),array('function', 'wt_getimagesize', 'addItem_form.tpl', 173, false),)), $this); ?>
<?php ob_start();  $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => 'action', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?>
<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => 'submit_type', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?>
<?php if (! $this->_tpl_vars['__isRoot__']): ?>
<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => 'it_type', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?>
<?php endif; ?>
<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => 'parent_id', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?>
<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => 'list_fields_changed', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?>
<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => 'tree_fields_changed', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?>
<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => 'language_id', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?>
<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => '_return2', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?>
<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => '_formType', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?>

<?php if ($this->_tpl_vars['action'] == 'edit'): ?>
<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => 'iID', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?>
<?php endif; ?>

<table cellpadding="0" cellspacing="0" width="100%" height="100%" class="eL">
	<tr>
		<td colspan="2" class="mT-m2 eL_h">
			<div id="eL_formTitle">
			<?php if ($this->_tpl_vars['action'] == 'edit'): ?>
			<img src="<?php echo $this->_tpl_vars['__imageRoot__']; ?>
/tree/<?php echo $this->_tpl_vars['item']['itt_ico']; ?>
.gif" align="absmiddle" alt="<?php echo ((is_array($_tmp=$this->_tpl_vars['type']['itt_name'])) ? $this->_run_mod_handler('strip_quotas', true, $_tmp) : smarty_modifier_strip_quotas($_tmp)); ?>
" /> <?php echo $this->_tpl_vars['item']['it_name']; ?>

			<?php elseif ($this->_tpl_vars['action'] == 'add'): ?>
			<img src="<?php echo $this->_tpl_vars['__imageRoot__']; ?>
/tree/<?php echo $this->_tpl_vars['item_type']['itt_ico']; ?>
.gif" align="absmiddle" /> NOWY: <?php echo $this->_tpl_vars['item_type']['itt_name']; ?>

			<?php endif; ?>
			</div>
			<div class="eL_but"><?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => 'submit_button', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?> <?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => 'save_close_button', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?> <?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => 'cancel_button', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?></div>
		</td>
	</tr>
	<tr>
	<td colspan="2" class="eL_formOptions">
		<table cellpadding="0" cellspacing="0" width="100%">
			<tr>
				<td class="eL_formOptions-lng">
					<?php if ($this->_tpl_vars['__languages__'] && $this->_tpl_vars['item_type']['itt_disable_languages'] != '1'): ?>
					<table>
						<tr>
					<td>Publikuj w:</td>
					<td style="background:#E1E1E1"><input type="checkbox" id="setAllLanguageStatusCheckbox" onClick="setCheckBoxByClassName(this.checked,'languageStatus');" />wsz</td>
					<?php $this->assign('selected_language_visible', '0'); ?>
					<?php $_from = $this->_tpl_vars['__languages__']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['__languages__'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['__languages__']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['l']):
        $this->_foreach['__languages__']['iteration']++;
?>
					<?php if ($this->_foreach['__languages__']['iteration'] <= 5): ?>
					<?php if ($this->_tpl_vars['language_id'] == $this->_tpl_vars['l']['id']):  $this->assign('selected_language_visible', '1');  endif; ?>
					<td><?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => "languages_status_".($this->_tpl_vars['l']['id']), 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?><a <?php if ($this->_tpl_vars['language_id'] == $this->_tpl_vars['l']['id']): ?>class="cl"<?php endif; ?> href="<?php echo smarty_function_wt_href_tpl_link(array('get_params' => 'language_id','parameters' => "language_id=".($this->_tpl_vars['l']['id'])), $this);?>
" onClick="if(($('form_was_changed').value == '1' && confirm('NIE ZAPISANO ZMIAN !!! \n\nJesteś pewien, że chcesz zmienić język edycji ?\n\nJeżeli nie chcesz zapisywać zmian i przejść do edycji innej wersji językowej kliknij przycik OK.\nJeżeli chcesz zapisać swoje zmiany kliknij na przycisk ANULUJ a następnie ZAPISZ w prawym górnym rogu. \n\nPamiętaj, że nie zapisane zmiany zostaną utracone na zawsze !!!')) || !$('form_was_changed') || $('form_was_changed').value != '1') { action_form_large(this.href, '<?php if ($this->_tpl_vars['action'] == 'edit'): ?>Edycja wpisu<?php else: ?>Nowy wpis<?php endif; ?> - język: <?php echo $this->_tpl_vars['l']['name']; ?>
'); } return false"><img src="<?php echo $this->_tpl_vars['__imageRoot__']; ?>
/flags/<?php echo $this->_tpl_vars['l']['code']; ?>
.gif" alt="<?php echo $this->_tpl_vars['l']['name']; ?>
" align="absmiddle" /><?php echo $this->_tpl_vars['l']['code']; ?>
</a></td>
					<?php endif; ?>
					<?php endforeach; endif; unset($_from); ?>
					<?php if (count ( $this->_tpl_vars['__languages__'] ) > 5): ?>
					<?php if ($this->_tpl_vars['selected_language_visible'] == 0): ?>
						<?php $_from = $this->_tpl_vars['__languages__']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['__languages__'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['__languages__']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['l']):
        $this->_foreach['__languages__']['iteration']++;
?>
						<?php if ($this->_tpl_vars['language_id'] == $this->_tpl_vars['l']['id']): ?>
						<td>| <?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => "languages_status_".($this->_tpl_vars['l']['id']), 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?><a <?php if ($this->_tpl_vars['language_id'] == $this->_tpl_vars['l']['id']): ?>class="cl"<?php endif; ?> href="<?php echo smarty_function_wt_href_tpl_link(array('get_params' => 'language_id','parameters' => "language_id=".($this->_tpl_vars['l']['id'])), $this);?>
" onClick="if(($('form_was_changed').value == '1' && confirm('NIE ZAPISANO ZMIAN !!! \n\nJesteś pewien, że chcesz zmienić język edycji ?\n\nJeżeli nie chcesz zapisywać zmian i przejść do edycji innej wersji językowej kliknij przycik OK.\nJeżeli chcesz zapisać swoje zmiany kliknij na przycisk ANULUJ a następnie ZAPISZ w prawym górnym rogu. \n\nPamiętaj, że nie zapisane zmiany zostaną utracone na zawsze !!!')) || !$('form_was_changed') || $('form_was_changed').value != '1') { action_form_large(this.href, '<?php if ($this->_tpl_vars['action'] == 'edit'): ?>Edycja wpisu<?php else: ?>Nowy wpis<?php endif; ?> - język: <?php echo $this->_tpl_vars['l']['name']; ?>
'); } return false"><img src="<?php echo $this->_tpl_vars['__imageRoot__']; ?>
/flags/<?php echo $this->_tpl_vars['l']['code']; ?>
.gif" alt="<?php echo $this->_tpl_vars['l']['name']; ?>
" align="absmiddle" /><?php echo $this->_tpl_vars['l']['code']; ?>
</a></td>
						<?php endif; ?>
						<?php endforeach; endif; unset($_from); ?>
					<?php endif; ?>
					<td><nobr><ul class="dropDownMenu" id="languageMenu" style="display:none;">
					<li>|więcej &raquo;<ul>
					<?php $_from = $this->_tpl_vars['__languages__']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['__languages__'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['__languages__']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['l']):
        $this->_foreach['__languages__']['iteration']++;
?>
					<?php if ($this->_foreach['__languages__']['iteration'] > 5): ?>
					<li><?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => "languages_status_".($this->_tpl_vars['l']['id']), 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?><a <?php if ($this->_tpl_vars['language_id'] == $this->_tpl_vars['l']['id']): ?>class="cl"<?php endif; ?> href="javascript:action_form_large('<?php echo smarty_function_wt_href_tpl_link(array('get_params' => 'language_id','parameters' => "language_id=".($this->_tpl_vars['l']['id'])), $this);?>
', '<?php if ($this->_tpl_vars['action'] == 'edit'): ?>Edycja wpisu<?php else: ?>Nowy wpis<?php endif; ?> - język: <?php echo $this->_tpl_vars['l']['name']; ?>
');"><img src="<?php echo $this->_tpl_vars['__imageRoot__']; ?>
/flags/<?php echo $this->_tpl_vars['l']['code']; ?>
.gif" alt="<?php echo $this->_tpl_vars['l']['name']; ?>
" align="absmiddle" /><?php echo $this->_tpl_vars['l']['name']; ?>
</a></li>
					<?php endif; ?>
					<?php endforeach; endif; unset($_from); ?>
					</ul></li>
					</ul>
					<?php endif; ?>
					</nobr></td>
					</tr>
					</table>

					<?php endif; ?>
				</td>
				<td id="eL_formSavingOptions" class="eL_formSavingOptions" align="right"><nobr>najpierw <?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => 'action_save', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?> potem <?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => 'action_after', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?></nobr></td>
			</tr>
		</table>

	</td>
	</tr>
	<tr>
		<td class="eL_nav"><a href="#" class="offtab" onClick="addItemTab.cycleTab(this.id); return false" id="tab1">Treść</a><?php $_from = ($this->_tpl_vars['fields']); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['fi']):
 if ($this->_tpl_vars['fi']['fi_root_show'] == '0' || $this->_tpl_vars['__isRoot__']): ?><a href="#" class="offtab" onClick="addItemTab.cycleTab(this.id); return false" id="tab_<?php echo $this->_tpl_vars['fi']['fi_gr']; ?>
"><?php echo ((is_array($_tmp=@$this->_tpl_vars['fi']['fi_name_short'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['fi']['fi_name']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['fi']['fi_name'])); ?>
</a><?php endif;  endforeach; endif; unset($_from);  if ($this->_tpl_vars['item_type_params']['itemAdd_status'] != '0' || $this->_tpl_vars['item_type_params']['itemAdd_dateupdown'] != '0' || $this->_tpl_vars['item_type_params']['itemAdd_parent_id'] != '0'): ?><a href="#" class="offtab" onClick="addItemTab.cycleTab(this.id); return false" id="tab2">Publikacja</a><?php endif;  if ($this->_tpl_vars['params']): ?><a href="#" class="offtab" onClick="addItemTab.cycleTab(this.id); return false" id="tab3">Parametry</a><?php endif;  if ($this->_tpl_vars['item_type_params']['itemAdd_meta'] != '0'): ?><a href="#" class="offtab" onClick="addItemTab.cycleTab(this.id); return false" id="tab4">Optymalizacja - SEO</a><?php endif;  if ($this->_tpl_vars['__isRoot__']): ?><a href="#" class="offtab" onClick="addItemTab.cycleTab(this.id); return false" id="tab6">ROOT</a></a><?php endif; ?>
	<?php if ($this->_tpl_vars['add_form_section'] != 0): ?>
		<script language="javascript" type="text/javascript">
			<?php echo '
			add_events_to_tabs = function() {
				var links_td = $$(\'td.eL_nav\');
				var links_tabs = links_td[0].select(\'a\');
				var i = 0;
				for(i=0;i<links_tabs.length;i++) {
					links_tabs[i].observe(\'click\', function(e) {
						if (e.target.id==\'tab_form\') {
							$(\'newFormContentOption\').show();
						} else {
							$(\'newFormContentOption\').hide();
						}
					});
				}
			}
			'; ?>

			add_events_to_tabs();
		</script>
				<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formadddatapart', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['__templateFSRoot__'])."admin2/source/modules/mod_structure_manager/sub/addFormForm.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  ob_start(); ?>
		<?php endif; ?>
		</td>
		<td class="eL_form" valign="top"><div id="eL_form"><div class="eL_formC">
			<div class="hide" id="page1">
				<h1>[TREŚĆ]</h1>

				<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddlabelpart', 'for' => 'it_name', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?>
				<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => 'it_name', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?>

				<?php if ($this->_tpl_vars['item_type_params']['itemAdd_it_name_short'] != '0'): ?>
				<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddlabelpart', 'for' => 'it_name_short', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?>
				<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => 'it_name_short', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?>
				<?php endif; ?>

				<?php if ($this->_tpl_vars['item_type_params']['itemAdd_tags'] != '0'): ?>
				<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddlabelpart', 'for' => 'tags', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?>
				<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => 'tags', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?>
				<?php endif; ?>

				<?php if ($this->_tpl_vars['item_type_params']['itemAdd_it_desc_short'] != '0'): ?>
				<h2><?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddlabelpart', 'for' => 'it_desc_short', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?> 				<span><input type="checkbox" checked="checked" onClick="Element.toggle('g_it_desc_short_i');" id="g_it_desc_short_c" /> twórz automatycznie</span> </h2>
				<div id="g_it_desc_short_i" style="display: none;" class="eL_hec">
				<?php echo smarty_function_wt_init_editor(array('id' => 'it_desc_short'), $this);?>
<br />
				<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => 'it_desc_short', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?>
				<div class="eL_tao">
					<b>potrzeba:</b> <a href="#" onClick="Interface.textAreaSize('it_desc_short', '+'); return false">więcej</a> <a href="#" onClick="Interface.textAreaSize('it_desc_short', '-'); return false">mniej</a> miejsca</div>
				</div>

				<script type="text/javascript">
					<?php echo '
						if( $(\'it_desc_short\').innerHTML != \'\' ) {
							$(\'g_it_desc_short_i\').show();
							$(\'g_it_desc_short_c\').checked = false;
						}
					'; ?>

				</script>
				<?php endif; ?>

				<?php if ($this->_tpl_vars['item_type_params']['itemAdd_it_desc'] != '0'): ?>
				<h2><?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddlabelpart', 'for' => 'it_desc', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?> <br />
				<?php echo smarty_function_wt_init_editor(array('id' => 'it_desc'), $this);?>
</h2>
				<div ><?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => 'it_desc', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?></div>
				<div class="eL_tao">
				<b>potrzeba:</b> <a href="#" onClick="Interface.textAreaSize('it_desc', '+'); return false">więcej</a> <a href="#" onClick="Interface.textAreaSize('it_desc', '-'); return false">mniej</a> miejsca</div>
				<?php endif; ?>

				<?php if ($this->_tpl_vars['item_type_params']['itemAdd_it_logo'] != '0'): ?>
				<h2><?php echo ((is_array($_tmp=@$this->_tpl_vars['item_type_params']['itemAdd_it_logo_label'])) ? $this->_run_mod_handler('default', true, $_tmp, "Logo główne") : smarty_modifier_default($_tmp, "Logo główne")); ?>
</h2>
				<table>
					<tbody>
						<tr>
							<td width="170" align="center"><?php echo smarty_function_wt_thumb_image(array('src' => "mod_structure/".($this->_tpl_vars['item']['media_path'])."/".($this->_tpl_vars['item']['it_logo']),'width' => '150','height' => '150','compress' => '100','show_blank' => '1','watermark' => ""), $this);?>
</td>
						<td valign="top">
							<table>
								<tbody>
									<tr>
										<td><b>Wgraj nowy plik:</b></td>
									</tr>
									<tr>
										<td><?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => 'it_logo', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?></td>
									</tr>
									<?php if ($this->_tpl_vars['action'] == 'edit' && $this->_tpl_vars['item']['it_logo']): ?>
									<tr>
										<td><?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => 'delete_it_logo', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?> <?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => 'previus_it_logo', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?><b style="color: #F00;">usuń</b></td>
									</tr>
									<?php echo smarty_function_wt_getimagesize(array('file' => ($this->_tpl_vars['__mediaFSRoot__'])."mod_structure/".($this->_tpl_vars['item']['media_path'])."/".($this->_tpl_vars['item']['it_logo']),'assign' => 'logo_info'), $this);?>

									<?php if ($this->_tpl_vars['logo_info']): ?>
									<tr>
										<td><a class="ag" href="<?php echo smarty_function_wt_thumb_image(array('src' => "mod_structure/".($this->_tpl_vars['item']['media_path'])."/".($this->_tpl_vars['item']['it_logo']),'path_return' => true), $this);?>
" target="_blank" onclick="popupWindow(this.href, 'img_prev', '<?php echo $this->_tpl_vars['logo_info']['width']+20; ?>
', '<?php echo $this->_tpl_vars['logo_info']['height']+20; ?>
', 'yes'); return false;">
										<img src="<?php echo $this->_tpl_vars['__imageRoot__']; ?>
/icon_preview.gif" align="absmiddle" alt="" />
										powiększ</a></td>
									</tr>
									<?php endif; ?>
									<?php endif; ?>
									<?php if ($this->_tpl_vars['__languages__']): ?>
									<tr>
										<td><?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => 'it_logo_multilng', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?> <b>To samo logo we wszystkich językach</b></td>
									</tr>
									<?php endif; ?>
								</tbody>
							</table>
						</td>
					</tr>
				</tbody>
			</table>
			<?php endif; ?>
			<?php if ($this->_tpl_vars['item_type_params']['itemAdd_it_logo_large'] != '0'): ?>
			<h2><?php echo ((is_array($_tmp=@$this->_tpl_vars['item_type_params']['itemAdd_it_logo_large_label'])) ? $this->_run_mod_handler('default', true, $_tmp, "Duże logo") : smarty_modifier_default($_tmp, "Duże logo")); ?>
</h2>
			<table>
				<tbody>
					<tr>
						<td width="170" align="center"><?php echo smarty_function_wt_thumb_image(array('src' => "mod_structure/".($this->_tpl_vars['item']['media_path'])."/".($this->_tpl_vars['item']['it_logo_large']),'width' => '150','height' => '150','compress' => '100','show_blank' => '1','watermark' => ""), $this);?>
</td>
						<td valign="top">
							<table>
								<tbody>
									<tr>
										<td><b>Wgraj nowy plik:</b></td>
									</tr>
									<tr>
										<td><?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => 'it_logo_large', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?></td>
									</tr>
									<?php if ($this->_tpl_vars['action'] == 'edit' && $this->_tpl_vars['item']['it_logo_large']): ?>
									<tr>
										<td><?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => 'delete_it_logo_large', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?> <?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => 'previus_it_logo_large', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?><b style="color: #F00;">usuń</b></td>
									</tr>
									<?php echo smarty_function_wt_getimagesize(array('file' => ($this->_tpl_vars['__mediaFSRoot__'])."mod_structure/".($this->_tpl_vars['item']['media_path'])."/".($this->_tpl_vars['item']['it_logo_large']),'assign' => 'logo_info'), $this);?>

									<?php if ($this->_tpl_vars['logo_info']): ?>
									<tr>
										<td><a class="ag" href="<?php echo $this->_tpl_vars['__BaseMediaRoot__']; ?>
/mod_structure/<?php echo $this->_tpl_vars['item']['media_path']; ?>
/<?php echo $this->_tpl_vars['item']['it_logo_large']; ?>
" target="_blank" onclick="popupWindow(this.href, 'img_prev', '<?php echo $this->_tpl_vars['logo_info']['width']+20; ?>
', '<?php echo $this->_tpl_vars['logo_info']['height']+20; ?>
', 'yes'); return false;">
										<img src="<?php echo $this->_tpl_vars['__imageRoot__']; ?>
/icon_preview.gif" align="absmiddle" alt="" />
										powiększ</a></td>
									</tr>
									<?php endif; ?>
									<?php endif; ?>
									<?php if ($this->_tpl_vars['__languages__']): ?>
									<tr>
										<td><?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => 'it_logo_large_multilng', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?> <b>To samo logo we wszystkich językach</b></td>
									</tr>
									<?php endif; ?>
								</tbody>
							</table>
						</td>
					</tr>
				</tbody>
			</table>
		<?php endif; ?>

	</div>

	<div class="hide" id="page2">
	<h1>[PUBLIKACJA]</h1>
	 <?php if ($this->_tpl_vars['item_type_params']['itemAdd_status'] != '0'): ?>
		<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddlabelpart', 'for' => 'status', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?>
		<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => 'status', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?>
	 <?php else: ?>
	 	<input type="hidden" name="status" value="1" id="status" />
	 <?php endif; ?>

	 <?php if ($this->_tpl_vars['item_type_params']['itemAdd_dateupdown'] != '0'): ?>
	 <table>
	 	<tr>
			<td><?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddlabelpart', 'for' => 'date_up', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?></td>
			<td><?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddlabelpart', 'for' => 'date_down', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?></td>
		</tr>
	 	<tr>
			<td><?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => 'date_up', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?></td>
			<td><?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => 'date_down', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?></td>
		</tr>

	 </table>






		<style type="text/css">

		#date_up, #date_down { 	background: #FFF url('<?php echo $this->_tpl_vars['__imageRoot__']; ?>
/icons/calendar.gif') 3px 4px no-repeat;
					padding-left: 24px;
					 width: 190px; }
		</style>

			<?php endif; ?>

		<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => 'sort_order', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?>
	</div>




	<?php $_from = ($this->_tpl_vars['fields']); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['fi']):
?>
	<div class="hide" id="page_<?php echo $this->_tpl_vars['fi']['fi_gr']; ?>
">
		<h1>[<?php echo ((is_array($_tmp=$this->_tpl_vars['fi']['fi_name'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
]<?php if ($this->_tpl_vars['fi']['fi_type'] == 'multi_select_group'): ?> <a href="#" onClick="addNewField('<?php echo $this->_tpl_vars['fi']['fi_id']; ?>
'); return false">[ dodaj / zmień / usuń ]</a><?php endif;  if ($this->_tpl_vars['__isRoot__']):  if ($this->_tpl_vars['fi']['fi_root_show'] == '1'): ?><img align="absmiddle" src="<?php echo $this->_tpl_vars['__imageRoot__']; ?>
/root_view.gif" alt="ROOT VIEW" /> <?php endif;  if ($this->_tpl_vars['fi']['fi_root_edit'] == '1'): ?><img align="absmiddle" src="<?php echo $this->_tpl_vars['__imageRoot__']; ?>
/root_edit.gif" alt="ROOT EDIT" /> <?php endif;  endif; ?></h1>
		<?php $this->assign('maintab_field', $this->_tpl_vars['fi']); ?>
		<input type="hidden" name="fi[<?php echo $this->_tpl_vars['fi']['fi_id']; ?>
]"  value="" />
		<?php if ($this->_tpl_vars['fi']['fi_type'] == 'multi_select_group'): ?>
		<span id="multi_select_<?php echo $this->_tpl_vars['fi']['fi_id']; ?>
"></span>
		<?php endif; ?>
		<?php $_from = $this->_tpl_vars['fi']['children']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['fic']):
?>

		<?php if ($this->_tpl_vars['fic']['fi_gr'] != ""): ?>
			<?php $this->assign('field_id', "fi_".($this->_tpl_vars['fic']['fi_gr'])); ?>
		<?php else: ?>
			<?php $this->assign('field_id', "fi_".($this->_tpl_vars['fic']['fi_id'])); ?>
		<?php endif; ?>

		<?php if ($this->_tpl_vars['fic']['fi_type'] != 'hidden'): ?>

		<?php if ($this->_tpl_vars['fic']['fi_type'] == 'head'): ?><h1>[<?php echo ((is_array($_tmp=$this->_tpl_vars['fic']['fi_name'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
]</h1><?php endif; ?>

		<?php if (( $this->_tpl_vars['fic']['fi_root_show'] == '0' || $this->_tpl_vars['__isRoot__'] ) && $this->_tpl_vars['fic']['fi_type'] != 'multi_select'): ?><h2> <?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddlabelpart', 'for' => ($this->_tpl_vars['field_id']), 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?> <?php if ($this->_tpl_vars['fic']['fi_type'] == 'select'): ?>
		<?php if (( $this->_tpl_vars['fic']['fi_root_edit'] == 1 && $this->_tpl_vars['__isRoot__'] ) || $this->_tpl_vars['fic']['fi_root_edit'] == 0): ?>
		<a href="#" onClick="fieldValues('<?php echo $this->_tpl_vars['fic']['fi_id']; ?>
'); return false">[ dodaj / zmień / usuń ]</a>
		<?php endif; ?>
		<?php endif;  if ($this->_tpl_vars['__isRoot__']):  if ($this->_tpl_vars['fic']['fi_root_show'] == '1'): ?><img align="absmiddle" src="<?php echo $this->_tpl_vars['__imageRoot__']; ?>
/root_view.gif" alt="ROOT VIEW" /> <?php endif;  if ($this->_tpl_vars['fic']['fi_root_edit'] == '1'): ?><img align="absmiddle" src="<?php echo $this->_tpl_vars['__imageRoot__']; ?>
/root_edit.gif" alt="ROOT EDIT" /> <?php endif;  endif; ?>
		<?php endif; ?>	</h2><?php endif; ?>

		<?php if ($this->_tpl_vars['fic']['fi_type'] == 'gallery' || $this->_tpl_vars['fic']['fi_type'] == 'files'): ?>

		<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formadddatapart', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['__templateFSRoot__'])."admin2/source/modules/mod_structure_manager/sub/filesForm.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  ob_start(); ?>
		<?php endif; ?>

		<?php if ($this->_tpl_vars['fic']['fi_type'] == 'googlemaps'): ?>
		<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formadddatapart', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['__templateFSRoot__'])."admin2/source/modules/mod_structure_manager/sub/googleMapForm.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  ob_start(); ?>
		<?php endif; ?>

		<?php if ($this->_tpl_vars['fic']['fi_type'] == 'multi_select_item' || $this->_tpl_vars['fic']['fi_type'] == 'select_item'): ?>
		<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formadddatapart', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['__templateFSRoot__'])."admin2/source/modules/mod_structure_manager/sub/selectItemForm.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  ob_start(); ?>
		<?php endif; ?>

		<?php if ($this->_tpl_vars['fic']['fi_type'] == 'file'): ?>
		<?php if ($this->_tpl_vars['action'] == 'add'): ?>
		Pliki można dodawać dopiero po zapisaniu elementu, kliknij <?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => 'submit_button', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?>.
		<?php else: ?>
		<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formadddatapart', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['__templateFSRoot__'])."admin2/source/modules/mod_structure_manager/sub/fileForm.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  ob_start(); ?>
		<?php endif; ?>
		<?php endif; ?>

		<?php if ($this->_tpl_vars['fic']['fi_type'] == 'form'): ?>
			<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddlabelpart', 'for' => ($this->_tpl_vars['field_id'])."_email_title", 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?> <?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => ($this->_tpl_vars['field_id'])."_email_title", 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?>
			<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddlabelpart', 'for' => ($this->_tpl_vars['field_id'])."_email_addresses", 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?> <?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => ($this->_tpl_vars['field_id'])."_email_addresses", 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?>

			<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formadddatapart', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['__templateFSRoot__'])."admin2/source/modules/mod_structure_manager/sub/contactForm.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  ob_start(); ?>

		<?php endif; ?>

		<?php if ($this->_tpl_vars['fic']['fi_type'] == 'data_table'): ?>
		<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formadddatapart', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['__templateFSRoot__'])."admin2/source/modules/mod_structure_manager/sub/dataTableForm.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  ob_start(); ?>
		<?php endif; ?>

		<?php if ($this->_tpl_vars['fic']['fi_type'] == 'user_defined'): ?>
		<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formadddatapart', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['__templateFSRoot__'])."admin2/source/modules/mod_structure_manager/addons/fFuser_".($this->_tpl_vars['fic']['fi_gr']).".tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  ob_start(); ?>
		<?php endif; ?>

		<?php if ($this->_tpl_vars['fic']['fi_type'] == 'multi_select'): ?>
		<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formadddatapart', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['__templateFSRoot__'])."admin2/source/modules/mod_structure_manager/sub/multiSelectForm.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  ob_start(); ?>
		<br style="clear:both;" />
		<?php endif; ?>

		<?php if ($this->_tpl_vars['fic']['fi_type'] == 'select'): ?><span id="fi_edit_<?php echo $this->_tpl_vars['fic']['fi_id']; ?>
"><?php endif; ?>
		<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => ($this->_tpl_vars['field_id']), 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?>

		<?php if ($this->_tpl_vars['fic']['fi_root_edit'] == '1' && ! $this->_tpl_vars['__isRoot__'] && $this->_tpl_vars['fic']['fi_root_show'] == '0'): ?>
			<?php if ($this->_tpl_vars['fic']['fi_type'] == 'select'): ?>
			<?php $this->assign('select_id', $this->_tpl_vars['fields_value'][$this->_tpl_vars['fic']['fi_id']]); ?>
			<select disabled="disabled" readonly="readonly" class="t3">
				<option><?php if ($this->_tpl_vars['select_id']):  echo $this->_tpl_vars['fic']['children'][$this->_tpl_vars['select_id']]['fi_name'];  else: ?>---<?php endif; ?></option>
			</select>
			<?php elseif ($this->_tpl_vars['fic']['fi_type'] == 'textarea'): ?>
			<textarea class="t3" disabled="disabled" readonly="readonly" cols="40" rows="3"><?php echo $this->_tpl_vars['fields_value'][$this->_tpl_vars['fic']['fi_id']]; ?>
</textarea>
			<?php else: ?>
			<input type="text" value="<?php echo $this->_tpl_vars['fields_value'][$this->_tpl_vars['fic']['fi_id']]; ?>
" class="t3" disabled="disabled" readonly="readonly" />
			<?php endif; ?>

		<?php endif; ?>

		<?php if ($this->_tpl_vars['fic']['fi_type'] == 'select' || $this->_tpl_vars['fic']['fi_type'] == 'multi_select'): ?></span><?php endif; ?>

		<?php if ($this->_tpl_vars['fic']['fi_type'] == 'datetime'): ?>
	   	<?php echo '
			<script type="text/javascript">
			Calendar.setup({	inputField     :    "';  echo $this->_tpl_vars['field_id'];  echo '",
									ifFormat       :    "%Y-%m-%d %H:%M:00",
						     		showsTime      :    true,
									timeFormat     :    "24",
								   button         :    "';  echo $this->_tpl_vars['field_id'];  echo '",
								   step           :    1
						    	});
			</script>
			'; ?>

			<style type="text/css">
				#<?php echo $this->_tpl_vars['field_id']; ?>
 {
					background: #FFF url('<?php echo $this->_tpl_vars['__imageRoot__']; ?>
/icons/calendar.gif') 3px 4px no-repeat;
					padding-left: 24px;
					 width: 190px;
				}
			</style>

		<?php endif; ?>

		<?php if ($this->_tpl_vars['fic']['fi_type'] == 'date'): ?>
	   	<?php echo '
			<script type="text/javascript">
			Calendar.setup({	inputField     :    "';  echo $this->_tpl_vars['field_id'];  echo '",
									ifFormat       :    "%Y-%m-%d",
						     		showsTime      :    false,
								   button         :    "';  echo $this->_tpl_vars['field_id'];  echo '",
								   step           :    1
						    	});
			</script>
			'; ?>

			<style type="text/css">
				#<?php echo $this->_tpl_vars['field_id']; ?>
 {
					background: #FFF url('<?php echo $this->_tpl_vars['__imageRoot__']; ?>
/icons/calendar.gif') 3px 4px no-repeat;
					padding-left: 24px;
					 width: 130px;
				}
			</style>
		<?php endif; ?>

		<?php if ($this->_tpl_vars['fic']['fi_depends_on']): ?>
		<script type="text/javascript">

			<?php $this->assign('fID', ($this->_tpl_vars['fic']['fi_depends_on'])); ?>

			$$('#fi_edit_<?php echo $this->_tpl_vars['fic']['fi_depends_on']; ?>
 tr').each(function(elem) {
			Event.observe(elem, 'click', function() { updateDependsField<?php echo $this->_tpl_vars['fic']['fi_id']; ?>
() });
			});

		updateDependsField<?php echo $this->_tpl_vars['fic']['fi_id']; ?>
 = function() {

			var selected_field_values = new Array();
			$$('#fi_edit_<?php echo $this->_tpl_vars['fic']['fi_depends_on']; ?>
 input').each(function(elem) {
			if(elem.checked === true) {
				selected_field_values.push(elem.value);
			}
			});
			new Ajax.Updater('fi_edit_<?php echo $this->_tpl_vars['fic']['fi_id']; ?>
', '<?php echo smarty_function_wt_href_tpl_link(array('parameters' => "m=items&t=updateFieldDepends&language_id=".($this->_tpl_vars['language_id'])."&fID=".($this->_tpl_vars['fic']['fi_id'])."&fVAL="), $this);?>
'+selected_field_values.toString(), {
			evalScripts:true,
			asynchronous:true,
			onLoading:function(){
		  //	  	$('<?php echo $this->_tpl_vars['field_id']; ?>
').disable();
			},
			onComplete:function(){
		  //		$('<?php echo $this->_tpl_vars['field_id']; ?>
').enable();
		 //		setFieldSelectedValue<?php echo $this->_tpl_vars['fic']['fi_id']; ?>
();
			}
			});
		}

  //		updateDependsField<?php echo $this->_tpl_vars['fic']['fi_id']; ?>
();

		setFieldSelectedValue<?php echo $this->_tpl_vars['fic']['fi_id']; ?>
 = function() {
				<?php $this->assign('fvid', ($this->_tpl_vars['fic']['fi_id'])); ?>
				$('<?php echo $this->_tpl_vars['field_id']; ?>
').value = '<?php echo $this->_tpl_vars['fields_value'][$this->_tpl_vars['fvid']]; ?>
';
				var op = $('<?php echo $this->_tpl_vars['field_id']; ?>
').options;
				for(i=0;i<op.length;i++) {
					if(op[i].value == '<?php echo $this->_tpl_vars['fields_value'][$this->_tpl_vars['fvid']]; ?>
') {
						op[i].selected = true;
					}
				}
		}

		</script>
		<?php endif; ?>
		<br style="clear:both;" />
		<?php endforeach; endif; unset($_from); ?>
	</div>
	<?php endforeach; endif; unset($_from); ?>


 <?php if ($this->_tpl_vars['params']): ?>
	<div class="hide" id="page3">
		<h1>[PARAMETRY]</h1>
		<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formadddatapart', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['__templateFSRoot__'])."admin2/source/params.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  ob_start(); ?>
	</div>
 <?php endif; ?>

 <?php if ($this->_tpl_vars['__isRoot__']): ?>
	<div class="hide" id="page5">
		<h1>[PARAMETRY TYPU - NA RAZIE NIE DZIAŁA!!!]</h1>
		<?php $this->assign('params', $this->_tpl_vars['params_type']); ?>
		<?php $this->assign('params_prefix', 'params_type'); ?>
		<label for="it_use_item_type_params">Nadpisz parametry typu dla tego elementu</label>
		<input type="checkbox" class="t4checkbox" value="1" name="it_use_item_type_params"<?php if ($this->_tpl_vars['item']['params_type']): ?> checked="checked"<?php endif; ?>>

		<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddlabelpart', 'for' => 'params_type_itt_sefu_id', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?>
		<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => 'params_type_itt_sefu_id', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?>

		<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddlabelpart', 'for' => 'params_type_itt_ico', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?>
		<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => 'params_type_itt_ico', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?>
		<br clear="both"  />

		<table cellspacing="0" class="typeOptions">
			 	<tr>
					<td><?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddlabelpart', 'for' => 'params_type_itt_nochildren', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?></td>
					<td style="background: #F0F0F0;"><?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddlabelpart', 'for' => 'params_type_itt_root_show', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?></td>
					<td><?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddlabelpart', 'for' => 'params_type_itt_root_edit', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?></td>
					<td style="background: #F0F0F0;"><?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddlabelpart', 'for' => 'params_type_itt_root_addchildren', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?></td>
					<td><?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddlabelpart', 'for' => 'params_type_itt_disable_languages', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?></td>
					<td style="background: #F0F0F0;"><?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddlabelpart', 'for' => 'params_type_itt_mod_structure_add_show', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?></td>
				</tr>
				<tr>
					<td align="center"><?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => 'params_type_itt_nochildren', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?></td>
					<td align="center" style="background: #F0F0F0;"><?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => 'params_type_itt_root_show', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?></td>
					<td align="center"><?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => 'params_type_itt_root_edit', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?></td>
					<td align="center" style="background: #F0F0F0;"><?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => 'params_type_itt_root_addchildren', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?></td>
					<td align="center"><?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => 'params_type_itt_disable_languages', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?></td>
					<td align="center"><?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => 'params_type_itt_mod_structure_add_show', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?></td>
				</tr>
			 </table>

			  <style type="text/css">
			  	<?php echo '
					.typeOptions { float: left; margin: 10px 0 0 0; clear:both; }
					.typeOptions TD { padding: 0 10px; }
				'; ?>

			  </style>
<br class="c" />


				<table cellspacing="0" class="typeOptions">
			 	<tr>
					<td><?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddlabelpart', 'for' => 'params_type_itt_children_only', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?></td>
					<td><?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddlabelpart', 'for' => 'params_type_itt_children_only_tree', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?></td>
				</tr>
				<tr>
					<td align="center"><?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => 'params_type_itt_children_only', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?></td>
					<td align="center"><?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => 'params_type_itt_children_only_tree', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?></td>
				</tr>
			 </table>
		<br clear="both"  />
		<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formadddatapart', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['__templateFSRoot__'])."admin2/source/params.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  ob_start(); ?>
	</div>
 <?php endif; ?>

 <?php if ($this->_tpl_vars['item_type_params']['itemAdd_meta'] != '0'): ?>
 <div class="hide" id="page4">
	<h1>[SEO]</h1>

		<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddlabelpart', 'for' => 'sefu_link', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?>
		<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => 'sefu_link', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?>

		<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddlabelpart', 'for' => 'meta_title', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?>
		<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => 'meta_title', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?>

		<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddlabelpart', 'for' => 'meta_keys', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?>
		<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => 'meta_keys', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?>

		<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddlabelpart', 'for' => 'meta_desc', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?>
		<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => 'meta_desc', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?>
	</div>
 <?php endif; ?>

 <?php if ($this->_tpl_vars['__isRoot__']): ?>
 <div class="hide" id="page6">
	<h1>[ROOT]</h1>

		<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddlabelpart', 'for' => 'import_id', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?>
		<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => 'import_id', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?>

		<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddlabelpart', 'for' => 'it_type', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?>
		<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => 'it_type', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?>



	</div>
 <?php endif; ?>



</div></div></td>
</tr>

<tr>
	<td colspan="2" class="addItemMetaData">#<?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['it_id'])) ? $this->_run_mod_handler('default', true, $_tmp, 'nowy') : smarty_modifier_default($_tmp, 'nowy')); ?>
 | Dodano: <?php echo ((is_array($_tmp=$this->_tpl_vars['item']['date_added'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%a, %d %b %Y @ %T") : smarty_modifier_date_format($_tmp, "%a, %d %b %Y @ %T")); ?>
,  przez: --- | Modyfikowano: <?php echo ((is_array($_tmp=$this->_tpl_vars['item']['last_modified'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%a, %d %b %Y @ %T") : smarty_modifier_date_format($_tmp, "%a, %d %b %Y @ %T")); ?>
, przez: --- | Wersja: <?php echo $this->_tpl_vars['item']['version']; ?>
</td>
</tr>

</table>
<script type="text/javascript">
<?php echo '
fieldValues = function(fi_id) {
'; ?>
 urlF = '<?php echo smarty_function_wt_href_tpl_link(array('mod_key' => 'mod_structure_manager','parameters' => "t=fieldValues&fID='+fi_id+'&language_id=".($this->_tpl_vars['language_id'])."&iID=".($this->_tpl_vars['item']['it_id'])), $this);?>
'; <?php echo '
	dialogForm({url: urlF});
}

addNewField = function(fi_id) {
'; ?>
 urlF = '<?php echo smarty_function_wt_href_tpl_link(array('mod_key' => 'mod_structure_manager','parameters' => "t=addNewField&parent_id='+fi_id+'&language_id=".($this->_tpl_vars['language_id'])."&iID=".($this->_tpl_vars['item']['it_id'])), $this);?>
'; <?php echo '
	dialogForm({url: urlF});
}

'; ?>

</script>

<?php if (file_exists ( ($this->_tpl_vars['__templateFSRoot__'])."admin2/source/modules/mod_structure_manager/addons/addItem/".($this->_tpl_vars['item_type']['itt_key']).".tpl" )): ?>
<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formadddatapart', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['__templateFSRoot__'])."admin2/source/modules/mod_structure_manager/addons/addItem/".($this->_tpl_vars['item_type']['itt_key']).".tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  ob_start(); ?>
<?php endif; ?>
<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formadddatapart', 'data' => $this->_smarty_vars['capture']['formdata'])), $this); ?>