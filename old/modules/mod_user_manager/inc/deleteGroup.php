<?php 

  

  $form = new form_class();
  
  $form->NAME = 'deleteGroup';
  $form->ID = 'deleteGroup';	
  $form->METHOD = 'POST';
  $form->ACTION = wt_href_link('', '', wt_get_all_get_params(array('a', 'gID', 't')));
  $form->ResubmitConfirmMessage = 'Jesteś pewien, że chcesz wysłać formularz ponownie ?';
 $form->TARGET = 'operation2';	
 $form->ONSUBMIT = "setActionFormSubmit('Usuwam grupę, proszę czekać ...')";	
  
  
  
  if(wt_not_null($groups_to_delete) && is_array($groups_to_delete)) {
  
  foreach($groups_to_delete as $group_id) {
  
  $form->AddInput(array(
		'TYPE' => 'hidden',
		'NAME' => 'group_id[]',
		'ID' => 'group_id_' . $group_id,
		'VALUE' => $group_id,
	));
	
	}
  
  $wt_template->assign('groups_to_delete', $groups_to_delete);
  $wt_template->assign('count_groups', count($groups_to_delete));
  }
  	
	
	
	$form->AddInput(array(
		'TYPE' => 'hidden',
		'NAME' => 'a',
		'ID' => 'action',
		'VALUE' => 'delGroup',
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
		$wt_template->fetch('deleteGroup_form.tpl');
		$wt_template->SetTemplateDir();
		$wt_template->unregister_prefilter('smarty_prefilter_form');
		
  $wt_template->assign('deleteGroup_form', FormCaptureOutput($form, array('EndOfLine' => "\n")));
       
?>
