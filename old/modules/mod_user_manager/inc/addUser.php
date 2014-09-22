<?php 

function mod_user__check_email($email_address = '') {
	$mod_user_manager = wt_module::singleton('mod_user_manager');
     		return $mod_user_manager->check_email($email_address);   		
     }
     
function mod_user__check_vat_id($nip = '') {
	$mod_user = wt_module::singleton('mod_user');
			return $mod_user->check_vat_id($nip);
}    

function mod_user__check_password($pass) {
	$mod_user = wt_module::singleton('mod_user');
			return $mod_user->check_password($pass);
} 

	
	$uID = wt_set_task($_REQUEST, 'uID');
	
	if( wt_is_valid( $uID, 'int', '0' ) ) {
	$wt_template->assign('item_data', $db_item = $this->get_users($uID));
	$action = 'edit';
	} else {
	$action = 'add';
	}

	
 	
  $wt_template->assign('action', $action);
  $wt_template->assign('adm_params',$this->module_params->get_array());
	
  $form = new form_class();
  $form->NAME = 'addUser';
  $form->ID = 'addUser';	
  $form->METHOD = 'POST';
  $form->ACTION = wt_href_link('mod_user_manager', '', wt_get_all_get_params( array('a', 't') ) . 'a=saveUser');
  $form->debug = 'wt_print_array';
  $form->ENCTYPE = 'multipart/form-data';
  $form->TARGET = 'operation2';		
 	
 	
 	$gID = $this->current_group_id();
 	$groups_tree = $this->get_groups_tree('', '', '', '', '', true, false);
   $users_to_groups = $this->get_users_to_groups($uID);
   

		 
  if( wt_is_valid( $groups_tree, 'array' ) ) {
  
  foreach($groups_tree as $group) {
  $checked = NULL;

  if((in_array($group['group_id'], $users_to_groups)) || ( $action == 'add' && $group['group_id'] == $gID ) ) {
  $checked = (bool)true;
  }
  
  $form->AddInput(array(
		'TYPE' => 'checkbox',
		'NAME' => 'groups[]',
		'ID' => 'groups_' . $group['group_id'],
		'LABEL' => $group['group_name'],
	  	'CHECKED' => $checked,
	  	'STYLE' => $style,
		'VALUE' => $group['group_id'],
	  //	'ValidateAsSet' => true,
	 //	'ValidateAsSetErrorMessage' => 'Musisz wybrać przynamniej jedną kategorię do której ma należeć produkt !!!',
	));
	
  }
  
  $wt_template->assign('groups_tree', $groups_tree);
  }
 	
 
 	
	$form->AddInput(array(
		'TYPE' => 'select',
		'NAME' => 'status',
		'ID' => 'status',
		'LABEL' => 'Aktywny',
		'OPTIONS' => array('0' => 'nieaktwne', '1' => 'aktywne', '2' => 'zablokowane'),
		'VALUE' => ($action == 'add') ? 1 : $db_item['status'],
	));
	
	if($action == 'edit') {
		$form->AddInput(array(
			'TYPE' => 'hidden',
			'NAME' => 'old_status',
			'ID' => 'old_status',
			'VALUE' => $db_item['status'],
		));
		$form->AddInput(array(
			'TYPE' => 'checkbox',
			'NAME' => 'send_active_email',
			'ID' => 'send_active_email',
			'LABEL' => 'Wyślij email z potwierdzeniem aktywacji konta',
			'VALUE' => '1',
			'CHECKED' => true,
			'CLASS' => 't4checkbox'
		));
	}
	
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'usr_first_name',
		'ID' => 'usr_first_name',
		'LABEL' => 'Imię',
		'VALUE' => $db_item['usr_first_name'],
		'CLASS' => 't3',
	));

	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'usr_last_name',
		'ID' => 'usr_last_name',
		'LABEL' => 'Nazwisko',
		'VALUE' => $db_item['usr_last_name'],
		'CLASS' => 't3',
  
	));

	
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'usr_nick',
		'ID' => 'usr_nick',
		'LABEL' => $this->module_params->get('admlabel_usr_nick','Nick'),
		'VALUE' => $db_item['usr_nick'],
		'CLASS' => 't3',
	 ));
	
 
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'usr_login',
		'ID' => 'usr_login',
		'LABEL' => $this->module_params->get('admlabel_usr_login','Login'),
		'VALUE' => $db_item['usr_login'],
		'CLASS' => 't3',
	)); 


	$form->AddInput(array(
		'TYPE' => 'select',
		'NAME' => 'usr_gender',
		'ID' => 'usr_gender',
		'LABEL' => 'Płeć',
		'VALUE' => ($db_item['usr_gender']) ? $db_item['usr_gender'] : '',
		'OPTIONS' => $this->usr_gender,
		'CLASS' => 't2',
	  
	));
	
  
  $year_start = date('Y')-18;		
  $start_date = '1900-01-01';
  $end_date = date("Y-m-d");
  
	$form->AddInput(array(
		'TYPE' => 'custom',
		'NAME' => 'usr_dob',
		'ID' => 'usr_dob',
		'LABEL' => 'Data urodzenia',
		'CLASS' => 't2',
		'CustomClass' => 'form_date_class',
	 	'VALUE' => (!wt_not_null($db_item['usr_dob']) || $db_item['usr_dob'] == '0000-00-00') ? null : $db_item['usr_dob'],
		'Format' => '{day}/{month}/{year}',
		'Months' => array(
			'01' => 'Styczeń',
			'02' => 'Luty',
			'03' => 'Marzec',
			'04' => 'Kwiecień',
			'05' => 'Maj',
			'06' => 'Czerwiec',
			'07' => 'Lipiec',
			'08' => 'Sierpień',
			'09' => 'Wrzesień',
			'10' => 'Październik',
			'11' => 'Listopad',
			'12' => 'Grudzień'
		),
		
		
	));
 
	

	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'usr_company',
		'ID' => 'usr_company',
		'LABEL' => 'Nazwa firmy',
		'VALUE' => $db_item['usr_company'],
		'CLASS' => 't3',
	));
	
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'usr_company_vat_id',
		'ID' => 'usr_company_vat_id',
		'LABEL' => 'NIP firmy',
		'VALUE' => $db_item['usr_company_vat_id'],
		'CLASS' => 't3',
		'ValidationServerFunction' => 'mod_user__check_vat_id',
		'ValidationServerFunctionErrorMessage' => 'Podany przez Ciebie numer NIP firmy, jest niepoprawny.',
	));
	
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'usr_company_address',
		'ID' => 'usr_company_address',
		'LABEL' => 'Adres',
		'VALUE' => $db_item['usr_company_address'],
		'CLASS' => 't3',
	));
	
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'usr_company_post_code',
		'ID' => 'usr_company_post_code',
		'LABEL' => 'Kod pocztowy',
		'VALUE' => $db_item['usr_company_post_code'],
		'CLASS' => 't3',
	));
	
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'usr_company_city',
		'ID' => 'usr_company_city',
		'LABEL' => 'Miasto',
		'VALUE' => $db_item['usr_company_city'],
		'CLASS' => 't3',
	));
	
	$form->AddInput(array(
		'TYPE' => 'select',
		'NAME' => 'usr_company_state',
		'ID' => 'usr_company_state',
		'LABEL' => 'Województwo',
		'VALUE' => ($db_item['usr_company_state']) ? $db_item['usr_company_state'] : '',
		'OPTIONS' => $this->zones_array,
		'CLASS' => 'form1_select',
	));
	
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'usr_company_email',
		'ID' => 'usr_company_email',
		'LABEL' => 'E-mail',
		'VALUE' => $db_item['usr_company_email'],
		'CLASS' => 't3',
	));
	
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'usr_company_www',
		'ID' => 'usr_company_www',
		'LABEL' => 'Strona WWW',
		'VALUE' => $db_item['usr_company_www'],
		'CLASS' => 't3',
	));
	
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'usr_company_phone',
		'ID' => 'usr_company_phone',
		'LABEL' => 'Telefon',
		'VALUE' => $db_item['usr_company_phone'],
		'CLASS' => 't3',
	));
	
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'usr_company_fax',
		'ID' => 'usr_company_fax',
		'LABEL' => 'Fax',
		'VALUE' => $db_item['usr_company_fax'],
		'CLASS' => 't3',
	));
	
	
	
	

	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'usr_address',
		'ID' => 'usr_address',
		'LABEL' => 'Adres',
		'VALUE' => $db_item['usr_address'],
		'CLASS' => 't3',
		
	));
	
	
 
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'usr_city',
		'ID' => 'usr_city',
		'LABEL' => 'Miasto',
		'VALUE' => $db_item['usr_city'],
		'CLASS' => 't3',
		
	));

	
	

	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'usr_post_code',
		'ID' => 'usr_post_code',
		'LABEL' => 'Kod pocztowy',
		'SIZE' => '6',
		'VALUE' => $db_item['usr_post_code'],
		'CLASS' => 't3',
	));

	
	
 
	$form->AddInput(array(
		'TYPE' => 'select',
		'NAME' => 'usr_state',
		'ID' => 'usr_state',
		'LABEL' => 'Województwo',
		'VALUE' => ($db_item['usr_state']) ? $db_item['usr_state'] : '',
		'OPTIONS' => $this->zones_array,
		'CLASS' => 'form1_select',
	));
	
	
	

	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'usr_country',
		'ID' => 'usr_country',
		'LABEL' => 'Kraj',
		'VALUE' => $db_item['usr_country'],
		'CLASS' => 't3',
	));

	
	

		

	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'usr_email',
		'ID' => 'usr_email',
		'LABEL' => 'E-mail',
		'VALUE' => $db_item['usr_email'],
		'CLASS' => 't3',
		'ValidationServerFunction' => 'mod_user__check_email',
		'ValidationServerFunctionErrorMessage' => 'Podany przez Ciebie adres e-mail istnieje już w naszej bazie danych. Podaj inny adres e-mail.',
		'Capitalization' => 'lowercase', 
	));
	
	
	 
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'usr_phone',
		'ID' => 'usr_phone',
		'LABEL' => 'Telefon',
		'VALUE' => $db_item['usr_phone'],
		'CLASS' => 't3',
	));
	
	
	

	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'usr_fax',
		'ID' => 'usr_fax',
		'LABEL' => 'Fax',
		'VALUE' => $db_item['usr_fax'],
		'CLASS' => 't3',
	));

  
	
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'usr_mobile',
		'ID' => 'usr_mobile',
		'LABEL' => 'Tel. kom.',
		'VALUE' => $db_item['usr_mobile'],
		'CLASS' => 't3',
	));



	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'usr_gg',
		'ID' => 'usr_gg',
		'LABEL' => 'Gadu-Gadu',
		'VALUE' => $db_item['usr_gg'],
		'CLASS' => 't3',
	));

	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'usr_tlen',
		'ID' => 'usr_tlen',
		'LABEL' => 'Tlen',
		'VALUE' => $db_item['usr_tlen'],
		'CLASS' => 't3',
	));
  
 

	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'usr_skype',
		'ID' => 'usr_skype',
		'LABEL' => 'Skype',
		'VALUE' => $db_item['usr_skype'],
		'CLASS' => 't3',
	));

 
 
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'usr_www',
		'ID' => 'usr_www',
		'LABEL' => 'Adres www',
		'MAXLENGTH' => 255,
		'CLASS' => 't3',
		'VALUE' => $db_item['usr_www'],
		"ReplacePatterns" => array(
			"^\\s+" => "", 
			"\\s+\$" => "",  
			"^([wW]{3}\\.)" => "http://\\1", 
			"^([^:]+)\$" => "http://\\1", 
			"^(http|https)://(([-!#\$%&'*+.0-9=?A-Z^_`a-z{|}~]+\.)+[A-Za-z]{2,6}(:[0-9]+)?)\$" => "\\1://\\2/" 
		),
		
	));
	

  

	$form->AddInput(array(
		'TYPE' => 'textarea',
		'NAME' => 'usr_other_contact',
		'ID' => 'usr_other_contact',
		'LABEL' => 'Inny kontakt',
		'VALUE' => $db_item['usr_other_contact'],
		'CLASS' => 't3',
		'COLS' => 40,
		'ROWS' => 10,
	));
	
	
	
  $form->AddInput(array(
		'TYPE' => 'password',
		'NAME' => 'usr_password',
		'ID' => 'usr_password',
		'LABEL' => 'Hasło',
		'CLASS' => 't3',
	));



  $form->AddInput(array(	
		'TYPE' => 'password',
		'NAME' => 'usr_password_confirm',
		'ID' => 'usr_password_confirm',
		'LABEL' => 'Powtórz hasło',
		'CLASS' => 't3',
		'ValidateAsEqualTo' => 'usr_password',
		'ValidateAsEqualToErrorMessage' => 'Potwierdzenie hasła musi być takie same jak hasło !',
	));
 


	if($action == 'edit') {
	
	$form->AddInput(array(
		'TYPE' => 'hidden',
		'NAME' => 'uID',
		'ID' => 'uID',
		'VALUE' => $uID,
	));
	
	
	}
	
	
	$form->AddInput(array(
		'TYPE' => 'file',
		'NAME' => 'usr_image',
		'ID' => 'usr_image',
		'LABEL' => 'Zdjęcie'
	));
	
	if( $action == 'edit' ) {
	
		$form->AddInput(array(
		'TYPE' => 'hidden',
		'NAME' => 'previus_usr_image',
		'ID' => 'previus_usr_image',
		'VALUE' => $db_info['usr_image']
  		));
		
		$form->AddInput(array(
		'TYPE' => 'checkbox',
		'NAME' => 'delete_usr_image',
		'ID' => 'delete_usr_image',
		'LABEL' => 'usuń zdjęcie',
		'VALUE' => '1'
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
  
	 $form->AddInput(array(
		'TYPE' => 'hidden',
		'ID' => 'doit',
		'NAME' => 'doit',
		'VALUE' => '1'
	));
	
	 $form->AddInput(array(
		'TYPE' => 'hidden',
		'ID' => 'action',
		'NAME' => 'a',
		'VALUE' => 'saveUser'
	));
	 
	   
	   $wt_template->assign_by_ref('form', $form);
	   $wt_template->assign('error_message', $error_message);
		$wt_template->assign_by_ref('verify', $verify);
		$wt_template->assign('doit', $doit);
	   
		$wt_template->register_prefilter('smarty_prefilter_form');
		$wt_template->SetTemplateDir('modules' . DIRECTORY_SEPARATOR . $this->module_key . DIRECTORY_SEPARATOR);
		$wt_template->fetch('addUser_form.tpl');
		$wt_template->SetTemplateDir();
		$wt_template->unregister_prefilter('smarty_prefilter_form');
 
  $wt_template->assign('addUser_form', FormCaptureOutput($form, array('EndOfLine' => "\n")));
         
      

?>