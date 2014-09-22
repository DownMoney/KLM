<?php /* Smarty version 2.6.16, created on 2014-03-29 03:31:32
         compiled from form_contact_form.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('insert', 'formaddinputpart', 'form_contact_form.tpl', 2, false),array('insert', 'formaddlabelpart', 'form_contact_form.tpl', 13, false),array('insert', 'formadddatapart', 'form_contact_form.tpl', 39, false),)), $this); ?>
<?php ob_start(); ?><div class="well contact_form">
<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => '_t', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?>
<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => 'form_name', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?>
<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => 'contact_form_fi_id', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?>
		<h2>Formularz kontaktowy</h2>
		<p>
		Aby w łatwy i szybki sposób się z nami skontaktować, wypełnij poniższy formularz. Pola oznaczone kolorem <span class="request">czerwonym</span> są wymagane.</p>
<?php $_from = $this->_tpl_vars['item']['fields_group']['contact_form']['n']['form']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['fields'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['fields']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['ff']):
        $this->_foreach['fields']['iteration']++;
?>
	<?php if (($this->_foreach['fields']['iteration'] <= 1) || $this->_foreach['fields']['iteration']%2 == 0): ?>
	<div class="row"><?php endif; ?>
	<div class="<?php if ($this->_tpl_vars['ff']['type'] == 'textarea'): ?>span6<?php else: ?>span3<?php endif; ?>">
		<?php if ($this->_tpl_vars['ff']['type'] == 'radio'): ?>
			<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddlabelpart', 'for' => "contact_form_".($this->_tpl_vars['ff']['field_form_name']), 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?>
			<?php $_from = $this->_tpl_vars['ff']['options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ro']):
?>
				<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddlabelpart', 'for' => "contact_form_".($this->_tpl_vars['ff']['field_form_name'])."_".($this->_tpl_vars['ro']), 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?>
				<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'CLASS' => 'span3', 'input' => "contact_form_".($this->_tpl_vars['ff']['field_form_name'])."_".($this->_tpl_vars['ro']), 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?>
			<?php endforeach; endif; unset($_from); ?>
		<?php elseif ($this->_tpl_vars['ff']['type'] == 'textarea'): ?>
			<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddlabelpart', 'for' => "contact_form_".($this->_tpl_vars['ff']['field_form_name']), 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?>
			<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'CLASS' => 'span6', 'input' => "contact_form_".($this->_tpl_vars['ff']['field_form_name']), 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?>
		<?php else: ?>
			<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddlabelpart', 'for' => "contact_form_".($this->_tpl_vars['ff']['field_form_name']), 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?>
			<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'CLASS' => 'span3', 'input' => "contact_form_".($this->_tpl_vars['ff']['field_form_name']), 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?>
		<?php endif; ?>
		</div>

	<?php if (($this->_foreach['fields']['iteration'] == $this->_foreach['fields']['total']) || $this->_foreach['fields']['iteration']%2 == 1): ?></div><?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
		<div class="row" style="text-align: center;">
			<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'CLASS' => "btn btn-large btn-inverse", 'input' => 'submit_button', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?>
		</div>
</div>
<style type="text/css">
<?php $_from = $this->_tpl_vars['item']['fields_group']['contact_form']['n']['form']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['fields'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['fields']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['ff']):
        $this->_foreach['fields']['iteration']++;
?>
<?php if ($this->_tpl_vars['ff']['required'] == '1'): ?>#contact_form_<?php echo $this->_tpl_vars['ff']['field_form_name']; ?>
_label, <?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
#aaa { color: #E00; }
</style>
<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formadddatapart', 'data' => $this->_smarty_vars['capture']['formdata'])), $this); ?>