<?php 

  

  $form = new form_class();
  
  $form->NAME = 'deleteLink';
  $form->METHOD = 'POST';
  $form->ACTION = wt_href_link('', '', wt_get_all_get_params(array('a', 't')));
  $form->ResubmitConfirmMessage = 'Jesteś pewien, że chcesz wysłać formularz ponownie ?';
 // $form->encoding = 'ISO-8859-2';
  $form->debug = 'wt_print_array';
  
  
  if( wt_is_valid($links_to_delete, 'array') ) {
  
  
  
  foreach($links_to_delete as $link_id) {
  
  $form->AddInput(array(
		'TYPE' => 'hidden',
		'NAME' => 'link_id[]',
		'ID' => 'link_id_' . $link_id,
		'VALUE' => $link_id,
	));
	
	}
  
  $wt_template->assign('links_to_delete', $links_to_delete);
  $wt_template->assign('count_links', count($links_to_delete));
  }
  	
	
	
	$form->AddInput(array(
		'TYPE' => 'hidden',
		'NAME' => 'a',
		'ID' => 'action',
		'VALUE' => 'delLink',
	));
	
 
	$form->AddInput(array(
		'TYPE' => 'submit',
		'ID' => 'submit_button',
		'VALUE' => 'Usuń >>',
		'ACCESSKEY' => 'D',
		'CLASS' => 'buttonIB',
		'ONCLICK' => 'if( confirm(\'Jesteś pewien, że chcesz usunąć:\n\n ' . count($links_to_delete) . ' - linków\n\n \') ) this.form.submit();',
		'ExtraAttributes' => array('onMouseOver' => "updateInfoBoxStatus('alert', 'Usuń link', 'Kliknij aby ostatecznie usunąć link wraz ze podrżednymi linkami.');this.style.cursor = 'pointer';",
											'onMouseOut' => "updateInfoBoxStatus();"),
		'ONCLICK' => 'lon();',
	));

	$form->AddInput(array(
		'TYPE' => 'button',
		'ID' => 'cancel_button',
		'VALUE' => '<< Anuluj',
		'ACCESSKEY' => 'W',
		'CLASS' => 'buttonIB',
		'ONCLICK' => 'lon(); document.location.href=(\'' . wt_href_link('', '', wt_get_all_get_params(array('t', 'm')) . 'm=categories') . '\');',
		'ExtraAttributes' => array('onMouseOver' => "updateInfoBoxStatus('info', 'Anuluj usuwanie', 'Kliknij aby anulować usuwanie linku.');this.style.cursor = 'pointer';",
											'onMouseOut' => "updateInfoBoxStatus();"),
	));

  

	
	   
	   $wt_template->assign_by_ref('form', $form);
		$wt_template->register_prefilter('smarty_prefilter_form');
		$wt_template->SetTemplateDir('modules' . DIRECTORY_SEPARATOR . $this->module_key . DIRECTORY_SEPARATOR);
		$wt_template->fetch('deleteLink_form.tpl');
		$wt_template->SetTemplateDir();
		$wt_template->unregister_prefilter('smarty_prefilter_form');
		
  $wt_template->assign('deleteLink_form', FormCaptureOutput($form, array('EndOfLine' => "\n")));
       
?>
