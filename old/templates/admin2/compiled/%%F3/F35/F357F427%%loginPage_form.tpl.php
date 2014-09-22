<?php /* Smarty version 2.6.16, created on 2013-04-25 12:55:52
         compiled from loginPage_form.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('insert', 'formaddinputpart', 'loginPage_form.tpl', 1, false),array('insert', 'formadddatapart', 'loginPage_form.tpl', 34, false),array('function', 'wt_href_tpl_link', 'loginPage_form.tpl', 26, false),)), $this); ?>
<?php ob_start();  $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => 'action', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?>
<table width="100%" align="center" height="100%">
	<tr>
		<td align="center">
<table width="500" align="center" cellpadding="5">
	<tr>
		<td colspan="2" align="center"><img src="<?php echo $this->_tpl_vars['__imageRoot__']; ?>
/logo.gif" alt="" /></td>
	</tr>
	<?php if ($this->_tpl_vars['lP_login_error']): ?>
	<tr>
		<td align="center" colspan="2" id="errorMessage"><?php echo $this->_tpl_vars['lP_login_error']; ?>
</td>
	</tr>
	<?php endif; ?>
	<tr>
		<td><label id="usr_email_label" ><?php echo $this->_tpl_vars['lP_login_type']['login_name']; ?>
: </label></td>
		<td><?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => ($this->_tpl_vars['lP_login_type']['tbl_key']), 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?></td>
	</tr>
	<tr>
		<td><label for="usr_pass" id="usr_pass_label" >Hasło:</label></td>
		<td><?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => 'usr_pass', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?></td>
	</tr>
	<tr>
		<td align="center" colspan="2"><input type="submit" name="submit_button" value="Zaloguj mnie" id="submit_button" />	</td>
	</tr>
	<tr>
		<td align="right" colspan="2"><a class="fPass" href="<?php echo smarty_function_wt_href_tpl_link(array('mod_key' => 'mod_user','parameters' => "t=rP"), $this);?>
" title=" przypomnienie hasła ">zapomniane hasło &raquo;</a></td>
	</tr>
</table>
<br />
<br />
</td>
	</tr>
</table>
<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formadddatapart', 'data' => $this->_smarty_vars['capture']['formdata'])), $this); ?>