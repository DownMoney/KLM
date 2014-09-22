<?php

	$form = new form_class();

	$form->NAME = 'deleteItem';
	$form->METHOD = 'POST';
	$form->TARGET = 'operation2';
	$form->ONSUBMIT = "setActionFormSubmit('Usuwam wpisy, proszę czekać ...')";
	$form->ACTION = wt_href_link('', '', wt_get_all_get_params(array('a', 'iID', 't')));

	if (wt_not_null($items_to_delete) && is_array($items_to_delete)) {
	    foreach($items_to_delete as $it_id) {
	        $form->AddInput(array('TYPE' => 'hidden',
	                'NAME' => 'it_id[]',
	                'ID' => 'it_id_' . $it_id,
	                'VALUE' => $it_id,
	                ));
	    }
	    $wt_template->assign('items_to_delete', $items_to_delete);
	    $wt_template->assign('count_items', count($items_to_delete));
	}

	$form->AddInput(array('TYPE' => 'hidden',
       'NAME' => 'a',
       'ID' => 'action',
       'VALUE' => 'delItem',
    ));
	        
    $form->AddInput(array(
    	'TYPE' => 'hidden',
       'NAME' => 'ca_id',
       'ID' => 'ca_id',
       'VALUE' => $_GET['cID'],
    ));
    
    $form->AddInput(array(
    	'TYPE' => 'hidden',
       'NAME' => 'cPath',
       'ID' => 'cPath',
       'VALUE' => $_GET['cPath'],
    ));
	 
	 $form->AddInput(array(
		'TYPE' => 'hidden',
		'NAME' => '_return2',
		'ID' => '_return2',
		'VALUE' => wt_set_task($_REQUEST, '_return2'),
	));
    
	$form->AddInput(array('TYPE' => 'submit',
	        'ID' => 'submit_button',
	        'VALUE' => 'Usuń &raquo;',
	        'ONCLICK' => 'if( confirm(\'Jesteś pewien, że chcesz usunąć:\n\n ' . count($items_to_delete) . ' - wpisów\n\n \') ) this.form.submit();',
	        ));

	$form->AddInput(array('TYPE' => 'button',
	        'ID' => 'cancel_button',
	        'VALUE' => '&laquo; Anuluj',
	        'ONCLICK' => 'hide_action_form();',
	        ));

	$wt_template->assign_by_ref('form', $form);
	$wt_template->register_prefilter('smarty_prefilter_form');
	$wt_template->SetTemplateDir('modules' . DIRECTORY_SEPARATOR . $this->module_key . DIRECTORY_SEPARATOR);
	$wt_template->fetch('deleteItem_form.tpl', null, $this->module_key);
	$wt_template->SetTemplateDir();
	$wt_template->unregister_prefilter('smarty_prefilter_form');
	$wt_template->assign('deleteItem_form', FormCaptureOutput($form, array('EndOfLine' => "\n")));
	$wt_template->load_file('deleteItem');

?>