<?php 

  

$form = new form_class();
  
  $form->NAME = 'addBlockToModule_1';
  $form->METHOD = 'POST';
  $form->ACTION = wt_href_link();
  $form->ResubmitConfirmMessage = 'JesteÂś pewien, Ĺźe chcesz wys3aäźŚormularz ponownie ?';
 // $form->encoding = 'ISO-8859-2';
  
  
  $all_blocks_data = $this->detect_installed_blocks();
  
  
 
  
  if( wt_is_valid( $all_blocks_data, 'array' )  ) {
  
  	$options = array();
   $options[''] = ' --- wybierz --- ';
  foreach($all_blocks_data as $group) {
  
  if( $group['gr_key'] != 'block_admin' )	{
	
  		$options['__LABEL_' . $group['gr_key']] = $group['gr_name'];
  	if( wt_is_valid( $group['files'], 'array' ) ) {
  	
  			foreach($group['files'] as $files)  {
  			  $options[$files['block_id']] = $files['block_name'];
  			}
  	} 
  
  }	// foreach($all_blocks_data
  
  } // if( wt_is_valid
  
  
  $form->AddInput(array(
							'TYPE' => 'select',
							'NAME' => 'block_id',
							'ID' => 'block_id',
							'OPTIONS' => $options,
							'VALUE' => '',
							'LABEL' => 'Wybierz',
							'ValidateAsNotEmpty' => 1,
							'ValidateAsNotEmptyErrorMessage' => 'Musisz wybrać blok',
								));
  
  
  }  
  
 $wt_template->assign('all_blocks_data', $all_blocks_data);	
	
	$form->AddInput(array(
		'TYPE' => 'hidden',
		'NAME' => 't',
		'ID' => 'task',
		'VALUE' => 'addBlockToModule'
	));
	
 
	$form->AddInput(array(
		'TYPE' => 'submit',
		'ID' => 'submit_button',
		'VALUE' => 'Dalej &raquo;',
		'CLASS' => 'button'
	));
	
	$form->AddInput(array(
		'TYPE' => 'reset',
		'ID' => 'reset_button',
		'VALUE' => 'Wyczyść',
		'CLASS' => 'button'
	));
	
	$form->AddInput(array(
		'TYPE' => 'button',
		'ID' => 'cancel_button',
		'VALUE' => '&laquo; Anuluj',
		'CLASS' => 'button',
		'ONCLICK' => 'window.close();',
	));
	
	   
	   $wt_template->assign_by_ref('form', $form);
		$wt_template->register_prefilter('smarty_prefilter_form');
		$wt_template->SetTemplateDir('modules' . DIRECTORY_SEPARATOR . $this->module_key . DIRECTORY_SEPARATOR);
		$wt_template->fetch('addBlockToModule_1_form.tpl');
		$wt_template->SetTemplateDir();
		$wt_template->unregister_prefilter('smarty_prefilter_form');
		  
  $wt_template->assign('addBlockToModule_1', FormCaptureOutput($form, array('EndOfLine' => "\n"))); 
  

?>
