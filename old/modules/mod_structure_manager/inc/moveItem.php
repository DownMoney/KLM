<?php 
  $iID = wt_set_task($_REQUEST, 'iID');
  $cpID = $this->current_item_id();
  if(wt_is_valid($iID,'int','0')) {	
  	$wt_template->assign('item', $item = $this->get_items($iID));	
  } else {
  		$item['parent_id'] = $cpID;
  }

$form = new form_class();
  
  $form->NAME = 'moveItem';
  $form->METHOD = 'POST';
  $form->TARGET = 'operation2';	
  $form->ONSUBMIT = "setActionFormSubmit('Przenoszę wpis, proszę czekać ...')";		
  $form->ACTION = wt_href_link('', '', wt_get_all_get_params(array('a', 'cID', 't')));
  
  $form->AddInput(array(
		'TYPE' => 'hidden',
		'NAME' => 'iID',
		'ID' => 'iID',
		'VALUE' => $iID,
	));
	
	$form->AddInput(array(
		'TYPE' => 'hidden',
		'NAME' => 'ca_id',
		'ID' => 'ca_id',
		'VALUE' => $_GET['cID'],
	));
	
	$form->AddInput(array(
		'TYPE' => 'hidden',
		'NAME' => 'cPath',
		'ID' => 'cPath',
		'VALUE' => $_GET['cPath'],
	));
  	
	$form->AddInput(array(
		'TYPE' => 'select',
		'NAME' => 'parent_id',
		'ID' => 'parent_id',
		'SIZE' => 10,
		'LABEL' => "Przenieś do",
		'CLASS' => 't2',
		'VALUE' => $item['parent_id'],
		'OPTIONS' => $this->get_items_tree_for_form(),
		'ValidateAsNotEmpty' => 1,
		'ValidateAsNotEmptyErrorMessage' => 'Musisz wybrać element do które chcesz przenieśc wpis',
	));
	
	$form->AddInput(array(
		'TYPE' => 'hidden',
		'NAME' => 'a',
		'ID' => 'action',
		'VALUE' => 'saveMoveItem',
	));
		
	$form->AddInput(array(
		'TYPE' => 'hidden',
		'NAME' => 'sort_order',
		'ID' => 'sort_order',
		'VALUE' => '',
	));
		
	$form->AddInput(array(
		'TYPE' => 'submit',
		'ID' => 'submit_button',
		'VALUE' => 'Zapisz &raquo;',
	));
		
	$form->AddInput(array(
		'TYPE' => 'button',
		'ID' => 'cancel_button',
		'VALUE' => '&laquo; Anuluj',
		'ONCLICK' => 'hide_action_form();',
	));

	   
	$wt_template->assign_by_ref('form', $form);
	$wt_template->register_prefilter('smarty_prefilter_form');
	$wt_template->SetTemplateDir('modules' . DIRECTORY_SEPARATOR . $this->module_key . DIRECTORY_SEPARATOR);
	$wt_template->fetch('moveItem_form.tpl', null, $this->module_key);
	$wt_template->SetTemplateDir();
	$wt_template->unregister_prefilter('smarty_prefilter_form');
	$wt_template->assign('moveItem_form', FormCaptureOutput($form, array('EndOfLine' => "\n")));
  	$wt_template->load_file('moveItem');
       
?>