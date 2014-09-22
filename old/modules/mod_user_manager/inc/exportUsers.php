<?php 

  $form = new form_class();
  $form->NAME = 'exportUsers';
  $form->ID = 'exportUsers';	
  $form->METHOD = 'POST';
  $form->ACTION = wt_href_link('', '', 'a=exportUsers');
  $form->ResubmitConfirmMessage = 'Jesteś pewien, że chcesz wysłać formularz ponownie ?';
  $form->debug = 'wt_print_array';
  $form->TARGET = 'operation2';
     
	$zones = $this->zones_array;
	unset($zones['']);
		
   $form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'gSearch',
		'ID' => 'gSearch',
		'VALUE' => $data['gSearch'],
		'LABEL' => 'Słowo kluczowe',
		'CLASS' => 't3',
	));
	
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'usr_first_name',
		'ID' => 'usr_first_name',
		'VALUE' => $data['usr_first_name'],
		'LABEL' => 'Imię',
		'CLASS' => 't3',
	));
	
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'usr_last_name',
		'ID' => 'usr_last_name',
		'VALUE' => $data['usr_last_name'],
		'LABEL' => 'Nazwisko',
		'CLASS' => 't3',
	));
	
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'usr_city',
		'ID' => 'usr_city',
		'VALUE' => $data['usr_city'],
		'LABEL' => 'Miasto',
		'CLASS' => 't3',
	));
	
	$form->AddInput(array(
		'TYPE' => 'select',
		'NAME' => 'usr_state',
		'ID' => 'usr_state',
		'LABEL' => 'województwo',
		'OPTIONS' => $zones,
		'SELECTED' => $data['usr_state'],
		'MULTIPLE' => true,
		'SIZE' => 6,
	));
	
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'usr_company',
		'ID' => 'usr_company',
		'VALUE' => $data['usr_company'],
		'LABEL' => 'Nazwa',
		'CLASS' => 't3',
	));
	
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'usr_company_city',
		'ID' => 'usr_company_city',
		'VALUE' => $data['usr_company_city'],
		'LABEL' => 'Miasto',
		'CLASS' => 't3',
	));
		
	$form->AddInput(array(
		'TYPE' => 'select',
		'NAME' => 'usr_company_state',
		'ID' => 'usr_company_state',
		'LABEL' => 'województwo',
		'OPTIONS' => $zones,
		'SELECTED' => $data['usr_company_state'],
		'MULTIPLE' => true,
		'SIZE' => 6,
	));
	
	$form->AddInput(array(
		'TYPE' => 'select',
		'NAME' => 'status',
		'ID' => 'status',
		'LABEL' => 'Status',
		'OPTIONS' => array('0' => 'nieaktwne', '1' => 'aktywne', '2' => 'zablokowane'),
		'SELECTED' => $data['status'],
		'MULTIPLE' => true,
		'SIZE' => 3,
	));
	
	
	
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'date_added_from',
		'ID' => 'date_added_from',
		'VALUE' => $data['date_added_from'],
		'LABEL' => 'od',
		'CLASS' => 't3',
	));
	
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'date_added_to',
		'ID' => 'date_added_to',
		'VALUE' => $data['date_added_to'],
		'LABEL' => 'do',
		'CLASS' => 't3',
	));
		
	$form->AddInput(array(
		'TYPE' => 'select',
		'NAME' => 'usr_source',
		'ID' => 'usr_source',
		'LABEL' => 'źródło rejestracji',
		'OPTIONS' => array('user' => 'użytkownik', 'admin' => 'admin', 'sys' => 'system'),
		'SELECTED' => $data['usr_source'],
		'MULTIPLE' => true,
		'SIZE' => 3,
	));
		
	$form->AddInput(array(
		'TYPE' => 'select',
		'NAME' => 'usr_confirm_sended',
		'ID' => 'usr_confirm_sended',
		'VALUE' => $data['usr_confirm_sended'],
		'LABEL' => 'wysłano zestaw startowy',
		'CLASS' => 't3',
		'OPTIONS' => array('' => 'nie istotne', '1' => 'tak', '0' => 'nie'),
	));
	
		 
		 
		 
	$form->AddInput(array(
		'TYPE' => 'hidden',
		'NAME' => 'a',
		'ID' => 'action',
		'VALUE' => 'saveGroup'
	));
	
	if($action == 'edit') {
	$form->AddInput(array(
		'TYPE' => 'hidden',
		'NAME' => 'gID',
		'ID' => 'gID',
		'VALUE' => $gID
	));
	}
	
	
  
	
	
$form->AddInput(array(
		'TYPE' => 'hidden',
		'NAME' => 'submit_type',
		'ID' => 'submit_type',
		'VALUE' => ''
	));
	
	
	$form->AddInput(array(
		'TYPE' => 'submit',
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
	
	$form->AddInput(array(
		'TYPE' => 'hidden',
		'NAME' => 'doit',
		'VALUE' => 1
	)); 
  
	
	   
	   $wt_template->assign_by_ref('form', $form);
		$wt_template->register_prefilter('smarty_prefilter_form');
		$wt_template->SetTemplateDir('modules' . DIRECTORY_SEPARATOR . $this->module_key . DIRECTORY_SEPARATOR);
		$wt_template->fetch('exportUsers_form.tpl');
		$wt_template->SetTemplateDir();
		$wt_template->unregister_prefilter('smarty_prefilter_form');
		  
  $wt_template->assign('exportUsers_form', FormCaptureOutput($form, array('EndOfLine' => "\n")));
       

  
      
$wt_template->load_file('exportUsers.tpl');
?>
