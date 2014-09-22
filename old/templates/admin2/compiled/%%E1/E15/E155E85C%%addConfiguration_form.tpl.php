<?php /* Smarty version 2.6.16, created on 2013-04-25 12:57:27
         compiled from addConfiguration_form.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('insert', 'formaddinputpart', 'addConfiguration_form.tpl', 1, false),array('insert', 'formaddlabelpart', 'addConfiguration_form.tpl', 23, false),array('insert', 'formadddatapart', 'addConfiguration_form.tpl', 39, false),)), $this); ?>
<?php ob_start();  $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => 'action', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?>
<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => 'submit_type', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?> 

<?php if ($this->_tpl_vars['action'] == 'edit'): ?>
<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => 'cID', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?>
<?php endif; ?>

<table cellpadding="0" cellspacing="0" width="100%" height="100%" class="eL">
	<tr>
		<td colspan="2" class="mT-m2 eL_h">
		<div class="eL_but"><?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => 'submit_button', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?> <?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => 'save_close_button', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?> <?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => 'cancel_button', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?>
		</div>
		</td>
	</tr>
	<tr>
		<td class="eL_nav" width="150">
			<a href="#" class="offtab" onClick="addConfigurationTab.cycleTab(this.id); return false" id="tab1">Dane ogólne</a>
		</td>
 		<td class="eL_form" valign="top"><div id="eL_form">
		<div class="eL_formC">
			<div class="hide" id="page1">
				<h1>Dane ogólne</h1>
					<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddlabelpart', 'for' => 'configuration_title', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?>
					<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => 'configuration_title', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?>
					
					<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddlabelpart', 'for' => 'configuration_key', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?>
					<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => 'configuration_key', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?>
					
					<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddlabelpart', 'for' => 'configuration_value', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?>
					<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => 'configuration_value', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?>

					<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddlabelpart', 'for' => 'configuration_description', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?> 
					<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => 'configuration_description', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?>
			</div>
			
</div></div></td>

</tr>
</table><?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formadddatapart', 'data' => $this->_smarty_vars['capture']['formdata'])), $this); ?>