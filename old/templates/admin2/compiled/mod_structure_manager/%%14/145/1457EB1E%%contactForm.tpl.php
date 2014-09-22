<?php /* Smarty version 2.6.16, created on 2013-04-29 08:36:27
         compiled from /var/www/vhosts/klmchauffeurs.com/httpdocs/templates/admin2/source/modules/mod_structure_manager/sub/contactForm.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('insert', 'formadddatapart', '/var/www/vhosts/klmchauffeurs.com/httpdocs/templates/admin2/source/modules/mod_structure_manager/sub/contactForm.tpl', 83, false),)), $this); ?>
<?php ob_start(); ?><ul id="contactForm_form_list">

	<?php $_from = $this->_tpl_vars['fields_value'][$this->_tpl_vars['fic']['fi_id']]['form']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['n'] => $this->_tpl_vars['it']):
?>
	<li id="thelist_<?php echo $this->_tpl_vars['n']; ?>
">
	<table id="rowT_<?php echo $this->_tpl_vars['n']; ?>
" width="550">
	<tbody>
	<tr>
	<td class="form_field_Tdesc">
	<span id="label_<?php echo $this->_tpl_vars['n']; ?>
" onclick="editField('<?php echo $this->_tpl_vars['n']; ?>
'); return false" style="cursor: pointer; <?php if ($this->_tpl_vars['it']['required'] == '1'): ?>color: #f00;<?php endif; ?>" class="form_field_label"><?php echo $this->_tpl_vars['it']['name']; ?>
</span>
	<span id="desc_<?php echo $this->_tpl_vars['n']; ?>
" onclick="editField('<?php echo $this->_tpl_vars['n']; ?>
'); return false" style="cursor: pointer;" class="form_field_desc"><?php echo $this->_tpl_vars['it']['desc']; ?>
</span>
	</td>
	
	<td class="form_field_fields">
		<input name="fi[<?php echo $this->_tpl_vars['fic']['fi_id']; ?>
][form][<?php echo $this->_tpl_vars['n']; ?>
][name]" value="<?php echo $this->_tpl_vars['it']['name']; ?>
" id="it_value_<?php echo $this->_tpl_vars['n']; ?>
_name" type="hidden">
		<input name="fi[<?php echo $this->_tpl_vars['fic']['fi_id']; ?>
][form][<?php echo $this->_tpl_vars['n']; ?>
][desc]" value="<?php echo $this->_tpl_vars['it']['desc']; ?>
" id="it_value_<?php echo $this->_tpl_vars['n']; ?>
_desc" type="hidden">
		<input name="fi[<?php echo $this->_tpl_vars['fic']['fi_id']; ?>
][form][<?php echo $this->_tpl_vars['n']; ?>
][type]" value="<?php echo $this->_tpl_vars['it']['type']; ?>
" id="it_value_<?php echo $this->_tpl_vars['n']; ?>
_type" type="hidden">
		<?php if ($this->_tpl_vars['it']['required']): ?>
			<input name="fi[<?php echo $this->_tpl_vars['fic']['fi_id']; ?>
][form][<?php echo $this->_tpl_vars['n']; ?>
][required]" value="<?php echo $this->_tpl_vars['it']['required']; ?>
" id="it_value_<?php echo $this->_tpl_vars['n']; ?>
_required" type="hidden">
		<?php endif; ?>
		<?php if ($this->_tpl_vars['it']['size']): ?>
			<input name="fi[<?php echo $this->_tpl_vars['fic']['fi_id']; ?>
][form][<?php echo $this->_tpl_vars['n']; ?>
][size]" value="<?php echo $this->_tpl_vars['it']['size']; ?>
" id="it_value_<?php echo $this->_tpl_vars['n']; ?>
_size" type="hidden">
		<?php endif; ?>
		<?php if ($this->_tpl_vars['it']['asEmail']): ?>
			<input name="fi[<?php echo $this->_tpl_vars['fic']['fi_id']; ?>
][form][<?php echo $this->_tpl_vars['n']; ?>
][asEmail]" value="<?php echo $this->_tpl_vars['it']['asEmail']; ?>
" id="it_value_<?php echo $this->_tpl_vars['n']; ?>
_asEmail" type="hidden">
		<?php endif; ?>
		<?php if ($this->_tpl_vars['it']['cols']): ?>
			<input name="fi[<?php echo $this->_tpl_vars['fic']['fi_id']; ?>
][form][<?php echo $this->_tpl_vars['n']; ?>
][cols]" value="<?php echo $this->_tpl_vars['it']['cols']; ?>
" id="it_value_<?php echo $this->_tpl_vars['n']; ?>
_cols" type="hidden">
		<?php endif; ?>
		<?php if ($this->_tpl_vars['it']['rows']): ?>
			<input name="fi[<?php echo $this->_tpl_vars['fic']['fi_id']; ?>
][form][<?php echo $this->_tpl_vars['n']; ?>
][rows]" value="<?php echo $this->_tpl_vars['it']['rows']; ?>
" id="it_value_<?php echo $this->_tpl_vars['n']; ?>
_rows" type="hidden">
		<?php endif; ?>
		<?php if ($this->_tpl_vars['it']['options']): ?>
			<input name="fi[<?php echo $this->_tpl_vars['fic']['fi_id']; ?>
][form][<?php echo $this->_tpl_vars['n']; ?>
][options]" value="<?php echo $this->_tpl_vars['it']['options']; ?>
" id="it_value_<?php echo $this->_tpl_vars['n']; ?>
_options" type="hidden">
		<?php endif; ?>
		<span id="form_field_fields_<?php echo $this->_tpl_vars['n']; ?>
">
			<?php if ($this->_tpl_vars['it']['type'] == 'text'): ?>
				<input type="text" <?php if ($this->_tpl_vars['it']['size'] > 0): ?> size="<?php echo $this->_tpl_vars['it']['size']; ?>
"<?php endif; ?> id="ncFF_<?php echo $this->_tpl_vars['n']; ?>
" />
			<?php elseif ($this->_tpl_vars['it']['type'] == 'date'): ?>
				<input type="text" <?php if ($this->_tpl_vars['it']['size'] > 0): ?> size="<?php echo $this->_tpl_vars['it']['size']; ?>
"<?php endif; ?> id="ncFF_<?php echo $this->_tpl_vars['n']; ?>
" value="dd-mm-rrrr" /> <img src="<?php echo $this->_tpl_vars['__imageRoot__']; ?>
/icons/calendar_add.png" align="absmiddle" alt="" />
			<?php elseif ($this->_tpl_vars['it']['type'] == 'textarea'): ?>	
				<textarea id="ncFF_<?php echo $this->_tpl_vars['n']; ?>
" <?php if ($this->_tpl_vars['it']['cols'] > 0): ?> cols="<?php echo $this->_tpl_vars['it']['cols']; ?>
"<?php endif; ?> <?php if ($this->_tpl_vars['it']['rows'] > 0): ?> rows="<?php echo $this->_tpl_vars['it']['rows']; ?>
"<?php endif; ?>></textarea>
			<?php elseif ($this->_tpl_vars['it']['type'] == 'select'): ?>	
				<select id="ncFF_<?php echo $this->_tpl_vars['n']; ?>
">
						<option value="">--- wybierz ---</option>
					<?php $_from = $this->_tpl_vars['it']['options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['index'] => $this->_tpl_vars['opt']):
?>
						<option value="<?php echo $this->_tpl_vars['index']; ?>
"><?php echo $this->_tpl_vars['opt']; ?>
</option>
					<?php endforeach; endif; unset($_from); ?>
				</select>
				<?php $_from = $this->_tpl_vars['it']['options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['index'] => $this->_tpl_vars['opt']):
?>
					<input id="it_value_<?php echo $this->_tpl_vars['n']; ?>
_options_<?php echo $this->_tpl_vars['index']; ?>
" type="hidden" value="<?php echo $this->_tpl_vars['opt']; ?>
" name="fi[<?php echo $this->_tpl_vars['fic']['fi_id']; ?>
][form][<?php echo $this->_tpl_vars['n']; ?>
][options][<?php echo $this->_tpl_vars['index']; ?>
]" />
				<?php endforeach; endif; unset($_from); ?>
			<?php elseif ($this->_tpl_vars['it']['type'] == 'radio'): ?>	
				<?php $_from = $this->_tpl_vars['it']['options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['index'] => $this->_tpl_vars['opt']):
?>
					<input type="radio" name="radio_<?php echo $this->_tpl_vars['index']; ?>
" value="<?php echo $this->_tpl_vars['index']; ?>
" /> <?php echo $this->_tpl_vars['opt']; ?>
<br />
				<?php endforeach; endif; unset($_from); ?>
				<?php $_from = $this->_tpl_vars['it']['options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['index'] => $this->_tpl_vars['opt']):
?>
					<input id="it_value_<?php echo $this->_tpl_vars['n']; ?>
_options_<?php echo $this->_tpl_vars['index']; ?>
" type="hidden" value="<?php echo $this->_tpl_vars['opt']; ?>
" name="fi[<?php echo $this->_tpl_vars['fic']['fi_id']; ?>
][form][<?php echo $this->_tpl_vars['n']; ?>
][options][<?php echo $this->_tpl_vars['index']; ?>
]" />
				<?php endforeach; endif; unset($_from); ?>
			<?php elseif ($this->_tpl_vars['it']['type'] == 'checkbox'): ?>	
				<?php $_from = $this->_tpl_vars['it']['options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['index'] => $this->_tpl_vars['opt']):
?>
					<input type="checkbox" name="checkbox_<?php echo $this->_tpl_vars['index']; ?>
" value="<?php echo $this->_tpl_vars['index']; ?>
" /> <?php echo $this->_tpl_vars['opt']; ?>
<br />
				<?php endforeach; endif; unset($_from); ?>
				<?php $_from = $this->_tpl_vars['it']['options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['index'] => $this->_tpl_vars['opt']):
?>
					<input id="it_value_<?php echo $this->_tpl_vars['n']; ?>
_options_<?php echo $this->_tpl_vars['index']; ?>
" type="hidden" value="<?php echo $this->_tpl_vars['opt']; ?>
" name="fi[<?php echo $this->_tpl_vars['fic']['fi_id']; ?>
][form][<?php echo $this->_tpl_vars['n']; ?>
][options][<?php echo $this->_tpl_vars['index']; ?>
]" />
				<?php endforeach; endif; unset($_from); ?>
			<?php endif; ?>
		
		</span>
	</td>
	<td class="form_field_Top">
	<a href="#" onclick="move_li('contactForm_form_list', 'thelist_<?php echo $this->_tpl_vars['n']; ?>
', 'up'); return false"><img src="<?php echo $this->_tpl_vars['__imageRoot__']; ?>
/order_arrow_up.gif"></a>
	<a href="#" onclick="move_li('contactForm_form_list', 'thelist_<?php echo $this->_tpl_vars['n']; ?>
', 'down'); return false"><img src="<?php echo $this->_tpl_vars['__imageRoot__']; ?>
/order_arrow_down.gif"></a>
	<a href="#" onclick="editField('<?php echo $this->_tpl_vars['n']; ?>
'); return false"><img src="<?php echo $this->_tpl_vars['__imageRoot__']; ?>
/icons/icon_edit.gif"></a>
	<a href="#" onclick="delField('<?php echo $this->_tpl_vars['n']; ?>
'); return false"><img src="<?php echo $this->_tpl_vars['__imageRoot__']; ?>
/icons/icon_del.gif"></a>
	
	
	</td>
</tr>
</tbody>
</table>
  </li>	
	<?php endforeach; endif; unset($_from); ?>
</ul><?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formadddatapart', 'data' => $this->_smarty_vars['capture']['formdata'])), $this); ?>