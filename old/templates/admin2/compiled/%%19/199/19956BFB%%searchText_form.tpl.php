<?php /* Smarty version 2.6.16, created on 2013-04-29 08:42:55
         compiled from searchText_form.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('insert', 'formaddinputpart', 'searchText_form.tpl', 2, false),array('insert', 'formaddlabelpart', 'searchText_form.tpl', 7, false),array('insert', 'formadddatapart', 'searchText_form.tpl', 18, false),)), $this); ?>
<?php ob_start(); ?><b>Szukaj wpisów:</b>
<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => 'mod', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start();  $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => 'm', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start();  $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => 't', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?>
<table>
	<tr class="thead">
		<td width="20%"><?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddlabelpart', 'for' => 'mod_id', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?></td>
		<td><?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddlabelpart', 'for' => 'txt_value', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?></td>
		<td><?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddlabelpart', 'for' => 'txt_key', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?></td>
		<td rowspan="4" class="searchSubmit" valign="middle"><?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => 'submit_button', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?></td>		
	</tr>
	<tr>
		<td width="20%"><?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => 'mod_id', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?></td>
		<td><?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => 'txt_value', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?></td>
		<td><?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => 'txt_key', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?></td>	
	</tr>
	
</table> <?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formadddatapart', 'data' => $this->_smarty_vars['capture']['formdata'])), $this); ?>