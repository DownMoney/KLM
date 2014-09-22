<?php /* Smarty version 2.6.16, created on 2013-04-29 08:42:49
         compiled from addText_form.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('insert', 'formaddinputpart', 'addText_form.tpl', 1, false),array('insert', 'formaddlabelpart', 'addText_form.tpl', 150, false),array('insert', 'formadddatapart', 'addText_form.tpl', 173, false),array('function', 'wt_href_tpl_link', 'addText_form.tpl', 92, false),)), $this); ?>
<?php ob_start();  $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => 'action', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start();  $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => 'submit_type', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start();  $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => 'list_fields_changed', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start();  $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => 'tree_fields_changed', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?>

<?php if ($this->_tpl_vars['action'] == 'edit'):  $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => 'tID', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start();  endif; ?>

<style type="text/css">
<?php echo '
	#unique_message {
		border: 1px solid #F00;
		background-color: #FFC0C0;
		padding: 15px 15px 15px 15px;
		margin-top: 10px;
		text-align: center;
		width: 467px;
	}

'; ?>

</style>

<script language="javascript" type="text/javascript">


var modules_keys = new Array();
<?php $_from = $this->_tpl_vars['modules_keys']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['mod_id'] => $this->_tpl_vars['mod_key']):
?>
modules_keys[<?php echo $this->_tpl_vars['mod_id']; ?>
] = '<?php echo $this->_tpl_vars['mod_key']; ?>
';
<?php endforeach; endif; unset($_from); ?>

<?php echo '


updateKey = function(v) {
	//v.value = v.value.toUpperCase().gsub(\'[^a-zA-Z0-9_]\',\'_\');
	v.value = v.value.toUpperCase().gsub(\' \',\'_\');
}

updateTxtKey = function(v) {
	if (v.options[v.selectedIndex].value==\'-1\') {
		$(\'key_prefix\').update(\'TEXT_\');
	} else {
		var mod = modules_keys[v.options[v.selectedIndex].value].toUpperCase();
		$(\'key_prefix\').update(\'TEXT_\'+mod+\'_\');
	}
}

checkValues = function(v) {
	var elements = $$(\'#languages_values textarea\');
	var nr = elements.length;
	for(i=0;i<nr;i++) {
		if ($(elements[i].id).value!=\'\')  {
			return true;
		}
	}
	return false;
}


Event.observe(\'addText\', \'submit\', checkValues);

checkUnique = function() {
	if (observer) clearTimeout(observer);
	observer = setTimeout(checkUniqueKey,1000);
}

Event.observe(\'txt_key\',\'keydown\',checkUnique);
Event.observe(\'mod_id\',\'change\',checkUnique);


var observer;



checkUniqueKey = function() {
	
	
	var val = $(\'txt_key\').value;
	var txt_ids = \'\';
	
	if ($(\'action_save\').options[$(\'action_save\').selectedIndex].value==\'save\') {
		var elements = $$(\'#languages_values input[type="hidden"]\');
		var nr = elements.length;
		for(i=0;i<nr;i++) {
			if (elements[i].id.match(\'txt_id_\')!=null && $(\'txt_id_\'+elements[i].value)==null) {
				txt_ids += elements[i].value+\',\';
			}
		}
		txt_ids = txt_ids.substr(0,txt_ids.length-1);
	}
	new Ajax.Request(\'';  echo smarty_function_wt_href_tpl_link(array('mod_key' => 'mod_languages_manager','parameters' => "a=checkUniqueKey&key='+val+'&ignore='+txt_ids+'&mod_id='+$('mod_id').value+'"), $this); echo '\', {asynchronous:true,
	onComplete: function(t) {
		var data = t.responseText;
		var message = \'\';
		if (data==\'ok\') {
			$(\'unique_message\').hide();
			message = \'Wpisany klucz jest unikalny.\';
		} else if (data==\'not_unique\') {
			message = \'Wpisany klucz NIE jest unikalny. Wpisz inny klucz.\';
			$(\'unique_message\').show();
		} else if (data==\'no_key\') {
			message = \'Należy podać klucz do wpisania\';
			$(\'unique_message\').show();
		} else {
			message = \'Wystąpił błąd podczas sprawdzania\';
			$(\'unique_message\').show();
		}
		$(\'unique_message\').update(message);
	//	alert(message);
	}
	});
}

updateTxtKey($(\'mod_id\'));
'; ?>

</script>
<table cellpadding="0" cellspacing="0" width="100%" height="100%" class="eL">
	<tr>
		<td colspan="2" class="mT-m2 eL_h">
			<div id="eL_formTitle">
				<?php if ($this->_tpl_vars['action'] == 'edit'): ?>
				 #<?php echo $this->_tpl_vars['item']['txt_id']; ?>
 - <?php echo $this->_tpl_vars['item']['txt_key']; ?>

				<?php elseif ($this->_tpl_vars['action'] == 'add'): ?>
				NOWY WPIS
				<?php endif; ?>
			</div>
			<div class="eL_but"><?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => 'submit_button', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?> <?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => 'save_close_button', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?> <?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => 'cancel_button', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?>
			</div>
		</td>
	</tr>
	<tr> 
		<td colspan="2" class="eL_formOptions">
			<table cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td id="eL_formSavingOptions" class="eL_formSavingOptions" align="right">najpierw <?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => 'action_save', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?> potem <?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => 'action_after', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr> 
		<td class="eL_nav">
			<a href="#" class="offtab" onClick="addTextTab.cycleTab(this.id); return false" id="tab1">Dane ogólne</a>
			<!--<a href="#" class="offtab" onClick="addTextTab.cycleTab(this.id); return false" id="tab2">Wartości</a>-->
		</td>
		<td class="eL_form" valign="top"><div id="eL_form">
			<div class="eL_formC">
				<div class="hide" id="page1">
					<h1>[DANE OGÓLNE]</h1>
						<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddlabelpart', 'for' => 'txt_key', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?>
						<span id="key_prefix"></span>&nbsp;<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => 'txt_key', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?><br />
						<div id="unique_message" style="display:none;"></div>
						<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddlabelpart', 'for' => 'mod_id', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?>
						<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => 'mod_id', 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?>
						<span id="languages_values">
						<?php $_from = $this->_tpl_vars['languages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['lnid'] => $this->_tpl_vars['ln']):
?>
							<!--<img src="<?php echo $this->_tpl_vars['__imageRoot__']; ?>
/flags/<?php echo $this->_tpl_vars['ln']['code']; ?>
.gif" alt="<?php echo $this->_tpl_vars['ln']['name']; ?>
" align="absmiddle" /><?php echo $this->_tpl_vars['ln']['name']; ?>
-->
							<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddlabelpart', 'for' => "txt_value_".($this->_tpl_vars['lnid']), 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?>
							<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => "txt_value_".($this->_tpl_vars['lnid']), 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?>
							
							<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => "ln_id_".($this->_tpl_vars['lnid']), 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?>
							<?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formaddinputpart', 'input' => "txt_id_".($this->_tpl_vars['lnid']), 'data' => $this->_smarty_vars['capture']['formdata'])), $this);  ob_start(); ?>
						<?php endforeach; endif; unset($_from); ?>
						</span>
				</div>
				
				<!--<div class="hide" id="page2">
					<h1>[PRODUKTY]</h1>
					
				</div>-->

</div></div></td>
</table><?php $this->_smarty_vars['capture']['formdata'] = ob_get_contents(); ob_end_clean();  require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'formadddatapart', 'data' => $this->_smarty_vars['capture']['formdata'])), $this); ?>