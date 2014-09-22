<?php 
	
  $form = new form_class();
  $form->NAME = 'searchUser';
  $form->ID = 'searchUser';	
  $form->METHOD = 'GET';
  $form->ACTION = wt_href_link('', '', 'm=users');
  $form->debug = 'wt_print_array';
     
	$zones = $this->zones_array;
	unset($zones['']);
		
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'iSearch[usr_first_name]',
		'ID' => 'usr_first_name',
		'VALUE' => $iSearch['usr_first_name'],
		'LABEL' => 'Imię:',
		'CLASS' => 't3',
	));
	
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'iSearch[usr_last_name]',
		'ID' => 'usr_last_name',
		'VALUE' => $iSearch['usr_last_name'],
		'LABEL' => 'Nazwisko:',
		'CLASS' => 't3',
	));
	
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'iSearch[usr_city]',
		'ID' => 'usr_city',
		'VALUE' => $iSearch['usr_city'],
		'LABEL' => 'Miasto:',
		'CLASS' => 't3',
	));
	
	$form->AddInput(array(
		'TYPE' => 'select',
		'NAME' => 'iSearch[usr_state]',
		'ID' => 'usr_state',
		'LABEL' => 'Województwo:',
		'OPTIONS' => $zones,
		'SELECTED' => $iSearch['usr_state'],
		'MULTIPLE' => true,
		'SIZE' => 6,
	));
	
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'iSearch[usr_company]',
		'ID' => 'usr_company',
		'VALUE' => $iSearch['usr_company'],
		'LABEL' => 'Nazwa:',
		'CLASS' => 't3',
	));
	
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'iSearch[usr_company_city]',
		'ID' => 'usr_company_city',
		'VALUE' => $iSearch['usr_company_city'],
		'LABEL' => 'Miasto:',
		'CLASS' => 't3',
	));
		
	$form->AddInput(array(
		'TYPE' => 'select',
		'NAME' => 'iSearch[usr_company_state]',
		'ID' => 'usr_company_state',
		'LABEL' => 'Województwo:',
		'OPTIONS' => $zones,
		'SELECTED' => $iSearch['usr_company_state'],
		'MULTIPLE' => true,
		'SIZE' => 6,
	));
	
	$form->AddInput(array(
		'TYPE' => 'select',
		'NAME' => 'iSearch[status]',
		'ID' => 'status',
		'LABEL' => 'Status:',
		'OPTIONS' => array('0' => 'nieaktwne', '1' => 'aktywne', '2' => 'zablokowane'),
		'SELECTED' => $iSearch['status'],
		'MULTIPLE' => true,
		'SIZE' => 3,
	));
	
	
	
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'iSearch[date_added_from]',
		'ID' => 'date_added_from',
		'VALUE' => $iSearch['date_added_from'],
		'LABEL' => 'od',
		'CLASS' => 't3',
	));
	
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'iSearch[date_added_to]',
		'ID' => 'date_added_to',
		'VALUE' => $iSearch['date_added_to'],
		'LABEL' => 'do',
		'CLASS' => 't3',
	));
		
	$form->AddInput(array(
		'TYPE' => 'select',
		'NAME' => 'iSearch[usr_source]',
		'ID' => 'usr_source',
		'LABEL' => 'Źródło rejestracji:',
		'OPTIONS' => array('user' => 'użytkownik', 'admin' => 'admin', 'sys' => 'system'),
		'SELECTED' => $iSearch['usr_source'],
		'MULTIPLE' => true,
		'SIZE' => 3,
	));
		
	$form->AddInput(array(
		'TYPE' => 'select',
		'NAME' => 'iSearch[usr_confirm_sended]',
		'ID' => 'usr_confirm_sended',
		'VALUE' => $iSearch['usr_confirm_sended'],
		'LABEL' => 'Wysłano zestaw startowy:',
		'CLASS' => 't3',
		'OPTIONS' => array('' => 'nie istotne', '1' => 'tak', '0' => 'nie'),
	));
	
		 
	$form->AddInput(array(
		'TYPE' => 'hidden',
		'NAME' => 'mod',
		'ID' => 'mod',
		'VALUE' => $this->module_key
	));
	
	$form->AddInput(array(
		'TYPE' => 'hidden',
		'NAME' => 'm',
		'ID' => 'm',
		'VALUE' => 'users'
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
		'TYPE' => 'submit',
		'ID' => 'submit_button',
		'NAME' => 'submit',
		'VALUE' => 'szukaj &raquo;',
	));
  	
	
	$form->AddInput(array(
		'TYPE' => 'hidden',
		'NAME' => 'doit',
		'VALUE' => 1
	)); 
  
	
	   
	   $wt_template->assign_by_ref('form', $form);
		$wt_template->register_prefilter('smarty_prefilter_form');
		$wt_template->SetTemplateDir('modules' . DIRECTORY_SEPARATOR . $this->module_key . DIRECTORY_SEPARATOR);
		$wt_template->fetch('searchUser_form.tpl', null, $this->module_key);
		$wt_template->SetTemplateDir();
		$wt_template->unregister_prefilter('smarty_prefilter_form');
		  
  $wt_template->assign('searchUser_form', FormCaptureOutput($form, array('EndOfLine' => "\n")));
  
?>
