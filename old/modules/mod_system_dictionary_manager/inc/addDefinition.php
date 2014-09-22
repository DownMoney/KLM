<?php 
	if(($_GET['dID'] && wt_not_null($_GET['dID']) && $_GET['dID'] > 0) || ( $_POST['dID'] && wt_not_null($_POST['dID']) && $_POST['dID'] > 0)) {
		$action = 'edit';
		$dID = wt_set_task($_REQUEST, 'dID');
	} else {
		$action = 'add';
	}
	
	$wt_template->assign('action', $action);
	if($action == 'edit')	 {
		$db_definition = $this->get_definitions($dID);
		$wt_template->assign('item', $db_definition);
	}
	$form = new form_class();
	
	$form->NAME = 'addDefinition';
	$form->METHOD = 'POST';
	$form->ACTION = wt_href_link('', '', wt_get_all_get_params(array('a', 'dID', 't')));
	$form->ENCTYPE = 'multipart/form-data';
	$form->TARGET = 'operation2';
	$form->debug = 'wt_print_array';
		
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'dc_name',
		'ID' => 'dc_name',
		'LABEL' => 'Nazwa:',
		'CLASS' => 't4',
		'VALUE' => $db_definition['dc_name'],
		'ValidateAsNotEmpty' => 1,
		'ValidateAsNotEmptyErrorMessage' => 'Musisz podać nazwę wpisu.'
	));
	
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'dc_key',
		'ID' => 'dc_key',
		'LABEL' => 'Klucz:',
		'CLASS' => 't4',
		'VALUE' => $db_definition['dc_key'],
	));
	
	$mod_modules_manager = wt_module::singleton("mod_modules_manager");
	$params = array('use_keys' => true,
					'add_type' => true);
					
	$mods = $mod_modules_manager->get_modules_for_form($params);
	$mods = array('all' => 'cała strona')+$mods;
	
	
	$form->AddInput(array(	
		'TYPE' => 'select',
		'NAME' => 'mod_key',
		'ID' => 'mod_key',
		'LABEL' => 'Klucz modułu:',
		'VALUE' => $db_definition['mod_key'],
		'SELECTED' => $db_definition['mod_key'],
		'OPTIONS' => $mods,
		'CLASS' => 't2',
		'ValidateAsNotEmpty' => 1,
		'ValidateAsNotEmptyErrorMessage' => 'Musisz podać klucz modułu.'
	));
	
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'dc_section',
		'ID' => 'dc_section',
		'LABEL' => 'Dział:',
		'CLASS' => 't4',
		'VALUE' => $db_definition['dc_section']
	));
	
	$form->AddInput(array(
		'TYPE' => 'textarea',
		'NAME' => 'dc_desc',
		'CLASS' => 't4',
		'ID' => 'dc_desc',
		'COLS' => 80,
		'ROWS' => 10,
		'LABEL' => 'Opis',
		'ExtraAttributes' => array('wrap' => 'soft'),
		'VALUE' => $db_definition['dc_desc']
	));
	
		
	$form->AddInput(array(
	'TYPE' => 'hidden',
	'NAME' => 'a',
	'ID' => 'action',
	'VALUE' => 'saveDefinition'
	));
	
	if($action == 'edit') {
		$form->AddInput(array(
		'TYPE' => 'hidden',
		'NAME' => 'dID',
		'ID' => 'dID',
		'VALUE' => $dID
		));
	
	}
	
	$form->AddInput(array(
		'TYPE' => 'hidden',
		'NAME' => 'submit_type',
		'ID' => 'submit_type',
		'VALUE' => ''
	));	
	
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
	$wt_template->fetch('addDefinition_form.tpl');
	$wt_template->SetTemplateDir();
	$wt_template->unregister_prefilter('smarty_prefilter_form');
	$wt_template->assign('addDefinition_form', FormCaptureOutput($form, array('EndOfLine' => "\n")));
	$wt_template->load_file('addDefinition.tpl');
?>
