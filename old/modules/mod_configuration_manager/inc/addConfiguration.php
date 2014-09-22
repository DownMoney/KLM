<?php 
	if(($_GET['cID'] && wt_not_null($_GET['cID']) && $_GET['cID'] > 0) || ( $_POST['cID'] && wt_not_null($_POST['cID']) && $_POST['cID'] > 0)) {
		$action = 'edit';
		$cID = wt_set_task($_REQUEST, 'cID');
	} else {
		$action = 'add';
	}
	
	$wt_template->assign('action', $action);
	if($action == 'edit')	 {
		$db_item = $this->get_configuration($cID);
		$wt_template->assign('item', $db_item);
	}
	$form = new form_class();
	
	$form->NAME = 'addConfiguration';
	$form->METHOD = 'POST';
	$form->ACTION = wt_href_link('', '', wt_get_all_get_params(array('a', 'cID', 't')));
	$form->ENCTYPE = 'multipart/form-data';
	$form->TARGET = 'operation2';
	$form->debug = 'wt_print_array';
		
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'configuration_title',
		'ID' => 'configuration_title',
		'LABEL' => 'Nazwa:',
		'CLASS' => 't4',
		'VALUE' => $db_item['configuration_title'],
	));
	
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'configuration_key',
		'ID' => 'configuration_key',
		'LABEL' => 'Klucz:',
		'CLASS' => 't4',
		'VALUE' => $db_item['configuration_key'],
		'ValidateAsNotEmpty' => 1,
		'ValidateAsNotEmptyErrorMessage' => 'Musisz podać klucz parametru.'
	));
	
	$form->AddInput(array(
		'TYPE' => 'textarea',
		'NAME' => 'configuration_value',
		'ID' => 'configuration_value',
		'LABEL' => 'Wartość:',
		'CLASS' => 't4',
		'COLS' => 80,
		'ROWS' => 10,
		'VALUE' => $db_item['configuration_value'],
	));
	
	$form->AddInput(array(
		'TYPE' => 'textarea',
		'NAME' => 'configuration_description',
		'CLASS' => 't4',
		'ID' => 'configuration_description',
		'COLS' => 80,
		'ROWS' => 10,
		'LABEL' => 'Opis',
		'VALUE' => $db_definition['configuration_description']
	));
		
	$form->AddInput(array(
	'TYPE' => 'hidden',
	'NAME' => 'a',
	'ID' => 'action',
	'VALUE' => 'saveConfiguration'
	));
	
	if($action == 'edit') {
		$form->AddInput(array(
		'TYPE' => 'hidden',
		'NAME' => 'cID',
		'ID' => 'cID',
		'VALUE' => $cID
		));
	
	}
	
	$form->AddInput(array(
		'TYPE' => 'image',
		'ID' => 'submit_button',
		'NAME' => 'submit',
		'VALUE' => 'save',
		'CLASS' => 'button',
		'SRC' => CFGF_DIR_WS_TEMPLATES . 'admin2/media/images/but_save.gif', 
		'ONCLICK' => "$('submit_type').value = this.value",
	));
  	
	$form->AddInput(array(
		'TYPE' => 'image',
		'ID' => 'cancel_button',
		'VALUE' => '&laquo; Anuluj',
		'CLASS' => 'button',
		'ONCLICK' => 'hide_action_form_large(); return false',
		'SRC' => CFGF_DIR_WS_TEMPLATES . 'admin2/media/images/but_cancel.gif', 
	));
	
	$form->AddInput(array(
		'TYPE' => 'image',
		'ID' => 'save_close_button',
		'NAME' => 'submit',
		'VALUE' => 'save_close',
		'CLASS' => 'button',
		'SRC' => CFGF_DIR_WS_TEMPLATES . 'admin2/media/images/but_save_close.gif', 
		'ONCLICK' => "$('submit_type').value = this.value",
	));
	
	$wt_template->assign_by_ref('form', $form);
	$wt_template->register_prefilter('smarty_prefilter_form');
	$wt_template->SetTemplateDir('modules' . DIRECTORY_SEPARATOR . $this->module_key . DIRECTORY_SEPARATOR);
	$wt_template->fetch('addConfiguration_form.tpl');
	$wt_template->SetTemplateDir();
	$wt_template->unregister_prefilter('smarty_prefilter_form');
	$wt_template->assign('addConfiguration_form', FormCaptureOutput($form, array('EndOfLine' => "\n")));
	$wt_template->load_file('addConfiguration.tpl');
?>
