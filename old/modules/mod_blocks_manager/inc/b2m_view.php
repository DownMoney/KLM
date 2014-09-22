<?php 

  

$form = new form_class();
  
  $form->NAME = 'b2m_view_form';
  $form->METHOD = 'GET';
  $form->ACTION = wt_href_link();
  $form->ResubmitConfirmMessage = 'Jeste¶ pewien, ¿e chcesz wys³aæ formularz ponownie ?';
 // $form->encoding = 'ISO-8859-2';
  
  
  $mod_modules_manager = wt_module::singleton('mod_modules_manager');
  
  $Mparams = array();
  $Mparams['type'] = 'local';
  $Mparams['add_blank'] = true;
  
  
  $form->AddInput(array(
		'TYPE' => 'select',
		'NAME' => 'mod_id',
		'ID' => 'mod_id',
		'LABEL' => 'widoczne w modu³ach',
		'OPTIONS' => $mod_modules_manager->get_modules_for_form($Mparams),
		'VALUE' => $_GET['mod_id'],
		'ONCHANGE' => 'this.form.submit();',
	));
	
	unset($mod_modules_manager);
	
  $Cparams = array();
  $Cparams['add_blank'] = true;	
  
  	
	$form->AddInput(array(
		'TYPE' => 'select',
		'NAME' => 'col_id',
		'ID' => 'col_id',
		'LABEL' => 'kolumna',
		'OPTIONS' => $this->get_columns_for_form($Cparams),
		'VALUE' => $_GET['col_id'],
		'ONCHANGE' => 'this.form.submit();',
	));
	
	
	
	
 
	$form->AddInput(array(
		'TYPE' => 'hidden',
		'NAME' => 'mod',
		'ID' => 'mod',
		'VALUE' => 'mod_blocks_manager'
	));
	
	$form->AddInput(array(
		'TYPE' => 'hidden',
		'NAME' => 'm',
		'ID' => 'm',
		'VALUE' => 'blocks'
	));
	
	$form->AddInput(array(
		'TYPE' => 'submit',
		'ID' => 'submit_button',
		'VALUE' => '>>',
		'CLASS' => 'buttonIB'
	));
	
	   
	   $wt_template->assign_by_ref('form', $form);
		$wt_template->register_prefilter('smarty_prefilter_form');
		$wt_template->SetTemplateDir('modules' . DIRECTORY_SEPARATOR . $this->module_key . DIRECTORY_SEPARATOR);
		$wt_template->fetch('b2m_view_form.tpl');
		$wt_template->SetTemplateDir();
		$wt_template->unregister_prefilter('smarty_prefilter_form');
		  
  $wt_template->assign('b2m_view_form', FormCaptureOutput($form, array('EndOfLine' => "\n")));
  

?>
