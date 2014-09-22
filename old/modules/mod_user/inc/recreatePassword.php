<?php 

function mod_user__check_login($login = '') {
			$mod_user = wt_module::singleton('mod_user');
     		return !$mod_user->check_login($login);   		
     }
       
  $wt_template->assign('action', $action);

  $form = new form_class();
  $form->NAME = 'recreatePasswordForm';
  $form->ID = 'recreatePasswordForm';	
  $form->METHOD = 'POST';
  $form->ACTION = wt_href_link('mod_user', '', 't=rP');
  $form->debug = 'wt_print_array';

$login_type = $this->get_user_login_type();
  $wt_template->assign('lP_login_type', $login_type);

//wt_print_array($login_type);
 
	
 if($login_type['tbl_key']!= 'usr_email')	{
  $form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'user_ident',
		'ID' => 'user_ident',
		'VALUE' => '',
		'LABEL' => $login_type['login_name'],
		'CLASS' => 'form1_text',
		'ValidateAsNotEmpty' => 1,
		'ValidateAsNotEmptyErrorMessage' => 'Musisz wypełnić pole - ' . $login_type['login_name'] . ' - !',
		'ValidationServerFunction' => 'mod_user__check_login',
		'ValidationServerFunctionErrorMessage' => 'Podany przez Ciebie ' . $login_type['login_name'] . ' nie istnieje w naszej bazie użytkowników.',
	));
	
	}
	
 	
if($login_type['tbl_key'] == 'usr_email')	{	
  $form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'user_ident',
		'ID' => 'user_ident',
		'VALUE' => '',
		'LABEL' => TEXT_MOD_USER_LABEL_EMAIL,
		'CLASS' => 'form1_text',
		'ValidateAsNotEmpty' => 1,
		'ValidateAsNotEmptyErrorMessage' => TEXT_MOD_USER_LABEL_EMAIL.' '.TEXT_MOD_USER_IS_REQUIRED,
		'ValidateAsEmail' => 1,
		'ValidateAsEmailErrorMessage' => TEXT_MOD_USER_WRONG_EMAIL_FORMAT,
			'ValidationServerFunction' => 'mod_user__check_login',
		'ValidationServerFunctionErrorMessage' => TEXT_MOD_USER_EMAIL_NOT_EXISTS,
		
	));
  }
  	
	$form->AddInput(array(
		'TYPE' => 'submit',
		'ID' => 'submit_button',
		'NAME' => 'submit_button',
		'VALUE' => TEXT_MOD_USER_SEND_PASSWORD.'',
	));
	
	$form->AddInput(array(
		'TYPE' => 'hidden',
		'ID' => 't',
		'NAME' => 't',
		'VALUE' => 'pP'
	));
		
	$form->AddInput(array(
		'TYPE' => 'hidden',
		'ID' => 'doit',
		'NAME' => 'doit',
		'VALUE' => '1'
	));
	 
	  $form->LoadInputValues($form->WasSubmitted('doit'));
  $verify = array();
  if($form->WasSubmitted('doit'))  {
			
		if(($error_message = $form->Validate($verify)) == "")  {
		$doit = true;
	 	} else {
	 	$doit = false;
	 	}		
  } else	{
  		$error_message = '';
		$doit = false;
  }
  
  
  if($doit === true) {
  	$this->recreateUserPassword();
  }
	
	   $wt_template->assign_by_ref('form', $form);
	   $wt_template->assign('error_message', $error_message);
		$wt_template->assign_by_ref('verify', $verify);
		$wt_template->assign('doit', $doit);
		$wt_template->register_prefilter('smarty_prefilter_form');
		if($admin_login == true) {		
  	  		$wt_template->set_theme($wt_module->installed_modules['mod_user_manager']['theme']);  		
			  $wt_template->SetTemplateDir('modules'.DIRECTORY_SEPARATOR.'mod_user_manager'.DIRECTORY_SEPARATOR);  
	  	} else {
	  	  $wt_template->SetTemplateDir('modules'.DIRECTORY_SEPARATOR.$this->module_key . DIRECTORY_SEPARATOR);
	  	}	
		$wt_template->fetch('recreatePassword_form.tpl');
		$wt_template->SetTemplateDir();
		$wt_template->unregister_prefilter('smarty_prefilter_form');
 
  $wt_template->assign('recreatePassword_form', FormCaptureOutput($form, array('EndOfLine' => "\n")));

?>