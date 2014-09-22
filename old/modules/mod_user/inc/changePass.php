<?php 

function mod_user__check_password($pass) {
	$mod_user = wt_module::singleton('mod_user');
	return $mod_user->check_password($pass);
} 



  $form = new form_class();
  
  $form->NAME = 'changePass';
  $form->METHOD = 'POST';
  $form->ACTION = wt_href_link('mod_user', '', 't=changePass', '', 'SSL');
  $form->ResubmitConfirmMessage = 'Jesteś pewien, że chcesz wysłać formularz ponownie ?';
  
	
  $form->AddInput(array(
		'TYPE' => 'password',
		'NAME' => 'usr_password',
		'ID' => 'usr_password',
		'LABEL' => 'Obecne hasło',
		'ValidateAsNotEmpty' => 1,
		'ValidateAsNotEmptyErrorMessage' => 'Pole - Obecne hasło -  jest wymagane',
		'ValidateMinimumLength' => ($this->module_params->get('minimum_usr_password')) ? $this->module_params->get('minimum_usr_password') : NULL,
		'ValidateMinimumLengthErrorMessage' => 'Pole - Obecne hasło -  musi mieć przynajmniej ' . $this->module_params->get('minimum_usr_password') . ' znaków !',
		'ValidationServerFunction' => 'mod_user__check_password',
		'ValidationServerFunctionErrorMessage' => 'Obecne hasło jest nieprawidłowe.',
	));
  
  $form->AddInput(array(	
		'TYPE' => 'password',
		'NAME' => 'new_password',
		'ID' => 'new_password',
		'LABEL' => 'Nowe hasło',
		'ValidateMinimumLength' => ($this->module_params->get('minimum_usr_password')) ? $this->module_params->get('minimum_usr_password') : NULL,
		'ValidateMinimumLengthErrorMessage' => 'Pole - Nowe hasło -  musi mieć przynajmniej ' . $this->module_params->get('minimum_usr_password') . ' znaków !',
		
	));

  $form->AddInput(array(	
		'TYPE' => 'password',
		'NAME' => 'new_password_confirm',
		'ID' => 'new_password_confirm',
		'LABEL' => 'Powtórz nowe hasło',
		'ValidateAsEqualTo' => 'new_password',
		'ValidateAsEqualToErrorMessage' => 'Potwierdzenie nowego hasła musi być takie same jak nowe hasło.',
	));
 
		$form->AddInput(array(
		'TYPE' => 'submit',
		'ID' => 'submit_button',
		'VALUE' => 'zmień',
	));
	
	$form->AddInput(array(
		'TYPE' => 'hidden',
		'ID' => 't',
		'NAME' => 't',
		'VALUE' => 'changePass'
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
	 			$doit = 1;
	 	} else {
	 	$doit = 0;
	 	}		
  } else	{
  		$error_message = '';
		$doit = 0;
  }
  
  if($doit) {
  	$this->saveChangePass();
  }
	
	
	
	
	   
	   $wt_template->assign_by_ref('form', $form);
	   $wt_template->assign('error_message', $error_message);
		$wt_template->assign_by_ref('verify', $verify);
		$wt_template->assign('doit', $doit);
	   
		$wt_template->register_prefilter('smarty_prefilter_form');
		$wt_template->SetTemplateDir('modules' . DIRECTORY_SEPARATOR . $this->module_key . DIRECTORY_SEPARATOR);
		$wt_template->fetch('changePass_form.tpl');
		$wt_template->SetTemplateDir();
		$wt_template->unregister_prefilter('smarty_prefilter_form');
 
  $wt_template->assign('changePass_form', FormCaptureOutput($form, array('EndOfLine' => "\n")));
         
?>
