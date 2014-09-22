<?php /* Smarty version 2.6.16, created on 2013-04-29 08:34:16
         compiled from /var/www/vhosts/klmchauffeurs.com/httpdocs/templates/admin2/source/params.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('insert', 'formaddlabelpart', '/var/www/vhosts/klmchauffeurs.com/httpdocs/templates/admin2/source/params.tpl', 9, false),array('insert', 'formaddinputpart', '/var/www/vhosts/klmchauffeurs.com/httpdocs/templates/admin2/source/params.tpl', 58, false),array('insert', 'formadddatapart', '/var/www/vhosts/klmchauffeurs.com/httpdocs/templates/admin2/source/params.tpl', 70, false),array('function', 'wt_thumb_image', '/var/www/vhosts/klmchauffeurs.com/httpdocs/templates/admin2/source/params.tpl', 27, false),array('function', 'wt_getimagesize', '/var/www/vhosts/klmchauffeurs.com/httpdocs/templates/admin2/source/params.tpl', 37, false),array('function', 'popup', '/var/www/vhosts/klmchauffeurs.com/httpdocs/templates/admin2/source/params.tpl', 64, false),)), $this); ?>
<?php ob_start();  if (! $this->_tpl_vars['params_prefix'] || $this->_tpl_vars['params_prefix'] == ""): ?>
	<?php $this->assign('params_prefix', 'params');  endif; ?>

<?php $_from = $this->_tpl_vars['params']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['params_groups'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['params_groups']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['group']):
        $this->_foreach['params_groups']['iteration']++;
?>
<div class="formParamsGroup" onClick="Element.toggle('formParams_<?php echo $this->_tpl_vars['id']; ?>
');"><?php echo $this->_tpl_vars['group']['name']; ?>
 &raquo;</div>
<div class="formParamsGroupContent" id="formParams_<?php echo $this->_tpl_vars['id']; ?>
" style="display: none;">
<?php $_from = $this->_tpl_vars['group']['params']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['params'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['params']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['param_id'] => $this->_tpl_vars['param']):
        $this->_foreach['params']['iteration']++;
?>
<h2><?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddlabelpart', 'for' => ($this->_tpl_vars['params_prefix'])."_".($this->_tpl_vars['param_id']), 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start();  if ($this->_tpl_vars['param']['warning_message']): ?>
<img align="absmiddle" src="<?php echo $this->_tpl_vars['__imageRoot__']; ?>
/icons/warning.png"> <span style="color: #FF0; font-weight: bold;">UWAGA:</span> <?php echo $this->_tpl_vars['param']['warning_message']; ?>

<?php endif;  if ($this->_tpl_vars['param']['tip_message']): ?>
<img align="absmiddle" src="<?php echo $this->_tpl_vars['__imageRoot__']; ?>
/remember_to.png"> <?php echo $this->_tpl_vars['param']['tip_message']; ?>

<?php endif; ?>
</h2>

<?php if ($this->_tpl_vars['param']['special'] == 'theme'): ?>
<h2 style="font-size: 1.2em;">Ustawienia wyglądu</h2>
<?php $_from = $this->_tpl_vars['param']['values']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['tm']):
?>

<fieldset>
<legend><?php echo $this->_tpl_vars['tm']['name']; ?>
</legend>

<?php $_from = $this->_tpl_vars['tm']['files']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['th']):
?>
<div style="width: 250px; float: left; clear: none;"><input type="radio" name="params[<?php echo $this->_tpl_vars['param_id']; ?>
]" value="<?php echo $this->_tpl_vars['th']['formated']; ?>
" <?php if ($this->_tpl_vars['item_params'][$this->_tpl_vars['param_id']] == $this->_tpl_vars['th']['formated']): ?>checked="checked"<?php endif; ?>  /><?php echo $this->_tpl_vars['th']['name']; ?>
<br />
<?php echo smarty_function_wt_thumb_image(array('src' => ($this->_tpl_vars['th']['path']).".jpg",'width' => '240','height' => '240','compress' => '100','show_blank' => '1','watermark' => "",'dir' => (@CFGF_DIR_FS_TEMPLATES),'style' => "margin: 5px 0;"), $this);?>
<br />

<?php echo smarty_function_wt_getimagesize(array('file' => (@CFGF_DIR_FS_TEMPLATES).($this->_tpl_vars['th']['path']).".jpg",'assign' => 'th_info'), $this);?>
		
		
		
<?php if ($this->_tpl_vars['th_info']): ?>
<a class="ag" href="<?php echo @CFGF_DIR_WS_TEMPLATES;  echo $this->_tpl_vars['th']['path']; ?>
.jpg" target="_blank" onclick="popupWindow(this.href, 'img_prev', '<?php echo $this->_tpl_vars['th_info']['width']+20; ?>
', '<?php echo $this->_tpl_vars['th_info']['height']+20; ?>
', 'yes'); return false;">
				<img src="<?php echo $this->_tpl_vars['__imageRoot__']; ?>
/icon_preview.gif" align="absmiddle" alt="" />
			powiększ</a>
<?php endif; ?>
	
<?php if ($this->_tpl_vars['action'] == 'edit'): ?>
<a href="<?php echo $this->_tpl_vars['item_url']; ?>
&th=<?php echo $this->_tpl_vars['th']['formated']; ?>
" target="_blank">podgląd</a>
<?php endif; ?>
</div>
<?php endforeach; endif; unset($_from); ?>

</fieldset>


<?php endforeach; endif; unset($_from); ?>

<?php else:  $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => ($this->_tpl_vars['params_prefix'])."_".($this->_tpl_vars['param_id']), 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?> 
<?php endif; ?>



<?php if ($this->_tpl_vars['param']['info_icon']): ?>
<img align="absmiddle" style="cursor: help;" src="<?php echo $this->_tpl_vars['__imageRoot__']; ?>
/icon_info.png" <?php echo smarty_function_popup(array('text' => $this->_tpl_vars['param']['info_icon']), $this);?>
>
<?php endif; ?>

<?php endforeach; endif; unset($_from); ?> 

</div>
<?php endforeach; endif; unset($_from);  $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formadddatapart', 'data' => $this->_smarty_vars['capture']['formdata'])), $this); ?>