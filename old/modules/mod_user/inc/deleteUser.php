<?php 

function mod_user__check_password($pass) {
$mod_user = wt_module::singleton('mod_user');
return $mod_user->check_password($pass); 
} 

  $form = new form_class();
  
  $form->NAME = 'deleteUser';
  $form->METHOD = 'POST';
  $form->ACTION = wt_href_link('mod_user', '', 't=deleteUser', '', 'SSL');
  $form->ResubmitConfirmMessage = 'Jesteś pewien, że chcesz wysłać formularz ponownie ?';
  $form->debug = 'wt_print_array';
  
	
  $form->AddInput(array(
		'TYPE' => 'password',
		'NAME' => 'usr_password',
		'ID' => 'usr_password',
		'LABEL' => 'Hasło',
		'CLASS' => 'form1_text',
		'ValidateAsNotEmpty' => 1,
		'ValidateAsNotEmptyErrorMessage' => 'Musisz podać - Hasło - !',
		'ValidateMinimumLength' => ($this->module_params->get('minimum_usr_password')) ? $this->module_params->get('minimum_usr_password') : NULL,
		'ValidateMinimumLengthErrorMessage' => 'Pole - Hasło -  musi mieć przynajmniej ' . $this->module_params->get('minimum_usr_password') . ' znaków !',
		'ValidationServerFunction' => 'mod_user__check_password',
		'ValidationServerFunctionErrorMessage' => 'Podane przez Ciebie hasło jest nieprawidłowe.',
	));
  
   

		$form->AddInput(array(
		'TYPE' => 'submit',
		'ID' => 'submit_button',
		'VALUE' => 'usuń swoje konto &raquo;',
		'CLASS' => 'form1_button'
	));
	
		
	$form->AddInput(array(
		'TYPE' => 'button',
		'ID' => 'cancel_button',
		'VALUE' => '&laquo; Powrót',
		'CLASS' => 'form1_button',
		'ONCLICK' => 'document.location.href=(\'' . wt_href_link('mod_user') . '\');',
	));
	
 

	$form->AddInput(array(
		'TYPE' => 'hidden',
		'ID' => 't',
		'NAME' => 't',
		'VALUE' => 'deleteUser'
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
  	$this->delUser();
  }
	
	
	
	
	   
	   $wt_template->assign_by_ref('form', $form);
	   $wt_template->assign('error_message', $error_message);
		$wt_template->assign_by_ref('verify', $verify);
		$wt_template->assign('doit', $doit);
	   
		$wt_template->register_prefilter('smarty_prefilter_form');
		$wt_template->SetTemplateDir('modules' . DIRECTORY_SEPARATOR . $this->module_key . DIRECTORY_SEPARATOR);
		$wt_template->fetch('deleteUser_form.tpl');
		$wt_template->SetTemplateDir();
		$wt_template->unregister_prefilter('smarty_prefilter_form');
 
  $wt_template->assign('deleteUser_form', FormCaptureOutput($form, array('EndOfLine' => "\n")));
         
?>
