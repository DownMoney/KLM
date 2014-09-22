<?php 
	$wt_template->assign('action', $action);
	$form = new form_class();
	$form->NAME = 'addItem';
	$form->ID = 'addItem';
	$form->METHOD = 'POST';
	$form->ACTION = wt_href_link('', '', wt_get_all_get_params(array('a', 'iID', 't', 'm')));
	$form->TARGET = 'operation2';
	$form->error = 'wt_print_array';
	$form->ENCTYPE = 'multipart/form-data';
  	
  $form->AddInput(array(
		'TYPE' => 'checkbox',
		'NAME' => 'status',
		'ID' => 'status',
		'LABEL' => 'Publikuj',
		'CHECKED' => ($action == 'add') ? 1 : $item['status'],
		'VALUE' => '1',
		'CLASS' => 't4checkbox'
	));
	
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'date_up',
		'ID' => 'date_up',
		'LABEL' => 'Rozpoczęcie wyświetlania',
		'MAXLENGTH' => 19,
		'VALUE' => wt_parse_publish_date_desc($item['date_up'], 'up'),
		'CLASS' => 't2',
	));
		
	$form->AddInput(array(
		'TYPE' => 'button',
		'NAME' => 'date_up_call',
		'ID' => 'date_up_call',
		'VALUE' => '>>',
		'CLASS' => 'button',
	));
	
	$form->AddInput(array(
		'TYPE' => 'button',
		'NAME' => 'date_down_call',
		'ID' => 'date_down_call',
		'VALUE' => '>>',
		'CLASS' => 'button',
	));
	
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'date_down',
		'ID' => 'date_down',
		'LABEL' => 'Zakończenie wyświetlania',
		'MAXLENGTH' => 19,
		'VALUE' => wt_parse_publish_date_desc($item['date_down'], 'down'),
		'CLASS' => 't2',
	));
	
	if( $action == 'edit' ) {
		$it = $this->get_items($item['it_id2']);
		$dane = $it['it_name'];
	}
		
 if( $item_type['itt_key'] == 'shortcut' ) {
	
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'it_name',
		'ID' => 'it_name',
		'MAXLENGTH' => 255,
		'LABEL' => 'Tytuł',
		'CLASS' => 't4',
		'VALUE' => $item['it_name'],
	));
	
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'item',
		'ID' => 'item',
		'MAXLENGTH' => 255,
		'LABEL' => 'Skrót do',
		'CLASS' => 't2',
		'VALUE' => $dane,
	));
	
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'it_id2',
		'ID' => 'it_id2',
		'MAXLENGTH' => 255,
		'LABEL' => " ",
		'CLASS' => 't2',
		'VALUE' => $item['it_id2'],
		'ValidateAsNotEmpty' => 1,
		'ValidateAsNotEmptyErrorMessage' => 'Musisz podać element do którego kieruje skrót',
	));
	
 } elseif( $item_type['itt_key'] == 'copy' ) {
 
 	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'item',
		'ID' => 'item',
		'MAXLENGTH' => 255,
		'LABEL' => 'Kopia',
		'CLASS' => 't2',
		'VALUE' => $dane,
	));
	
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'it_id2',
		'ID' => 'it_id2',
		'MAXLENGTH' => 255,
		'LABEL' => " ",
		'CLASS' => 't2',
		'VALUE' => $item['it_id2'],
		'ValidateAsNotEmpty' => 1,
		'ValidateAsNotEmptyErrorMessage' => 'Musisz podać element z którego mają być skopiowane dane',
	));
 
 	
 }
	
 	$form->AddInput(array(
		'TYPE' => 'hidden',
		'NAME' => 'language_id',
		'VALUE' => $language_id
	));
 
if( $wt_language->languages_count > 1 ) {	
	foreach($wt_language->catalog_languages as $l) {
		$form->AddInput(array(
			'TYPE' => 'checkbox',
			'NAME' => 'languages_status['.$l['id'].']',
			'ID' => 'languages_status_'.$l['id'],
			'LABEL' => $l['code'],
			'VALUE' => '1',
			'CHECKED' => ($action == 'add' && $l['id'] == $language_id) ? true : $item['languages_status'][$l['id']],
		));
	}
}
	
	
  $form->AddInput(array(
		'TYPE' => 'hidden',
		'NAME' => 'parent_id',
		'ID' => 'parent_id',
		'VALUE' => ($action == 'add') ? $this->current_item_id() : $item['parent_id']
	));
	
	$form->AddInput(array(
		'TYPE' => 'hidden',
		'NAME' => 'sort_order',
		'ID' => 'sort_order',
		'VALUE' => ($action == 'add') ? '100000' : $item['sort_order']
	));
			
	$form->AddInput(array(
		'TYPE' => 'hidden',
		'NAME' => 'a',
		'ID' => 'action',
		'VALUE' => 'saveItem'
	));
	
	if($action == 'edit') {
		$form->AddInput(array(
			'TYPE' => 'hidden',
			'NAME' => 'iID',
			'ID' => 'iID',
			'VALUE' => $iID
		));
	}
	
			
	$form->AddInput(array(
		'TYPE' => 'hidden',
		'NAME' => 'it_type',
		'ID' => 'it_type',
		'VALUE' => $itID
	));
  
	$form->AddInput(array(
		'TYPE' => 'hidden',
		'NAME' => 'submit_type',
		'ID' => 'submit_type',
		'VALUE' => ''
	));
		
   $form->AddInput(array(
		'TYPE' => 'hidden',
		'NAME' => 'list_fields_changed',
		'ID' => 'list_fields_changed',
		'VALUE' => '0'
	));
	
	$form->AddInput(array(
		'TYPE' => 'hidden',
		'NAME' => 'tree_fields_changed',
		'ID' => 'tree_fields_changed',
		'VALUE' => '0'
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
		'NAME' => 'doit',
		'VALUE' => 1
	));
	
	$action_save = array();
	$action_save['save'] = 'zapisz';
	if($action == "edit") {
	$action_save['save_as_new'] = 'dodaj jako nowy skrót';
	}
	
	$form->AddInput(array(
		'TYPE' => 'select',
		'NAME' => 'action_save',
		'ID' => 'action_save',
		'VALUE' => wt_set_task($_REQUEST, 'action_save', 'save'),
		'LABEL' => 'Akcja',
		'OPTIONS' => $action_save
	));
	
	$form->AddInput(array(
		'TYPE' => 'select',
		'NAME' => 'action_after',
		'ID' => 'action_after',
		'VALUE' => wt_set_task($_REQUEST, 'action_after', 'main'),
		'LABEL' => 'Akcja',
		'OPTIONS' => array('main' => 'powróć do listy',
								 'add_new' => 'dodaj nowy skrót',
								 'edit' => 'powrót do edycji tego skrótu')
	));
		
	$wt_template->assign_by_ref('form', $form);
	$wt_template->register_prefilter('smarty_prefilter_form');
	$wt_template->SetTemplateDir('modules' . DIRECTORY_SEPARATOR . $this->module_key . DIRECTORY_SEPARATOR);
	$wt_template->fetch('addItemCopy_form.tpl', null, $this->module_key);
	$wt_template->SetTemplateDir();
	$wt_template->unregister_prefilter('smarty_prefilter_form');
	$wt_template->assign('addItemCopy_form', FormCaptureOutput($form, array('EndOfLine' => "\n")));
	$wt_template->load_file('addItemCopy.tpl');
?>