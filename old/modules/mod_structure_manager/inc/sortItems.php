<?php 
	$cID = wt_set_task($_REQUEST,'cID');
 
  	$form = new form_class();
    $form->NAME = 'sortItems';
  	$form->METHOD = 'POST';
  	$form->ACTION = wt_href_link('', '', wt_get_all_get_params(array('a', 'cID', 't')));
  	$form->ResubmitConfirmMessage = 'Jesteś pewien, że chcesz wysłać formularz ponownie ?';
  	$form->ONSUBMIT = "setActionFormSubmit('Sortuję, proszę czekać ...')";
 	$form->TARGET = 'operation2';
   	
 	$form->AddInput(array(
		'TYPE' => 'hidden',
		'NAME' => 'ca_id',
		'ID' => 'ca_id',
		'VALUE' => $cID,
	));
	
	$form->AddInput(array(
		'TYPE' => 'hidden',
		'NAME' => 'a',
		'ID' => 'action',
		'VALUE' => 'saveItemsOrder',
	));
	global $wt_sql;
	$db_query = $wt_sql->db_query("SELECT * FROM ".TABLE_MOD_STRUCTURE_FIELDS_CONFIG." cfc WHERE cfc.parent_id IN(SELECT fi_id FROM ".TABLE_MOD_STRUCTURE_FIELDS_CONFIG." cfc2 WHERE cfc2.ca_id='".$cID."') AND cfc.fi_type!='multi_select'");
	while ($db_field = $wt_sql->db_fetch_array($db_query)) {
		$field_array[$db_field['fi_id']] = $db_field['fi_name'];
	}
	$form->AddInput(array(
		'TYPE' => 'select',
		'NAME' => 'fi_id',
		'ID' => 'fi_id',
		'LABEL' => 'Sortuj według:',
		'OPTIONS' => $field_array,
		'VALUE' => '',
	));	
	
	$form->AddInput(array(
		'TYPE' => 'radio',
		'NAME' => 'order',
		'ID' => 'desc',
		'VALUE' => '1',
		'LABEL' => 'malejąco',
	));
	
	$form->AddInput(array(
		'TYPE' => 'radio',
		'NAME' => 'order',
		'ID' => 'asc',
		'VALUE' => '0',
		'LABEL' => 'rosnąco',
		'CHECKED' => '1'
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
	$wt_template->fetch('sortItems_form.tpl', null, $this->module_key);
	$wt_template->SetTemplateDir();
	$wt_template->unregister_prefilter('smarty_prefilter_form');
	$wt_template->assign('sortItems_form', FormCaptureOutput($form, array('EndOfLine' => "\n")));   
	$wt_template->load_file('sortItems');
?>