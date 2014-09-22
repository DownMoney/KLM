<?php 

	
	// 
  	
	$wt_template->assign('fields', $fields = $this->get_config_fields_to_type($itID,array('language_id' => $language_id)));
	$wt_template->assign('fields_value', $fields_value = $this->get_fields_value_to_item($iID,array('language_id' => $language_id)));
	
	
	
	$wt_template->assign('action', $action);
	$form = new form_class();
	$form->NAME = 'addItem';
	$form->ID = 'addItem';
	$form->METHOD = 'POST';
	$form->ACTION = wt_href_link('', '', wt_get_all_get_params(array('a', 'iID', 't', 'm')));
	$form->TARGET = 'operation2';
	$form->error = 'wt_print_array';
	$form->ENCTYPE = 'multipart/form-data';
	$GLOBALS['it'] = $item_type['itt_key'];
	
	$item_type_params = new wt_params($item_type['params']);	
	$wt_template->assign('item_type_params', $item_type_params_array = $item_type_params->get_array());
	
	$db_item_params = new wt_params($item['params']);
	$db_params_type = new wt_params($item['params_type'], '', '', $item_type_params);
	$params_type = $db_params_type->get_array();
		
	$parameters = new wt_set_params('', array('addItem','addItem_'.$item_type['itt_key']), $db_item_params);
	$params_type_parameters = new wt_set_params('', array('addType', 'addType_addItem', 'addType_adminList'), $db_params_type);
	
	
	$parameters->set_form($form);
	$parameters->set_template();
	$wt_template->assign('params', $parameters->params_array);
	$wt_template->assign('item_params', $db_item_params->get_array());
	
	$params_type_parameters->set_form($form, 'params_type');
	$params_type_parameters->set_template();
	$wt_template->assign('params_type', $params_type_parameters->params_array);
	

		
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
		'TYPE' => 'text',
		'NAME' => 'date_down',
		'ID' => 'date_down',
		'LABEL' => 'Zakończenie wyświetlania',
		'MAXLENGTH' => 19,
		'VALUE' => wt_parse_publish_date_desc($item['date_down'], 'down'),
		'CLASS' => 't2',
	));
	
		
	$form->AddInput(array(
		'TYPE' => 'hidden',
		'NAME' => 'sort_order',
		'ID' => 'sort_order',
		'VALUE' => ($action == 'add') ? $item_type_params->get('itemAdd_sort_order','100000') : $item['sort_order'],
	));
			
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'it_name',
		'ID' => 'it_name',
		'MAXLENGTH' => 255,
		'LABEL' => $item_type_params->get('itemAdd_it_name_label','Tytuł'),
		'CLASS' => 't4',
		'VALUE' => $item['it_name'],
		'ValidateAsNotEmpty' => 1,
		'ValidateAsNotEmptyErrorMessage' => 'Musisz uzupełnić pole: '.$item_type_params->get('itemAdd_it_name_label','Tytuł'),
	));
	
if($item_type_params->get('itemAdd_it_name_short',0)) {
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'it_name_short',
		'ID' => 'it_name_short',
		'MAXLENGTH' => 255,
		'LABEL' => $item_type_params->get('itemAdd_it_name_short_label','Skrócony tytuł'),
		'CLASS' => 't3',
		'VALUE' => $item['it_name_short']
	));
}

if($item_type_params->get('itemAdd_tags',0)) {
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'tags',
		'ID' => 'tags',
		'MAXLENGTH' => 255,
		'LABEL' => $item_type_params->get('itemAdd_tags_label','Tagi'),
		'CLASS' => 't3',
		'VALUE' => $item['tags'],
	));
}

if($item_type_params->get('itemAdd_it_desc_short',1)) {
	$form->AddInput(array(
		'TYPE' => 'textarea',
		'NAME' => 'it_desc_short',
		'ID' => 'it_desc_short',
		'LABEL' => $item_type_params->get('itemAdd_it_desc_short_label','Skrócony opis'),
		'COLS' => 40,
		'ROWS' => 7,
		'VALUE' => $item['it_desc_short'],
		'CLASS' => 't4',
	));
}
	
if($item_type_params->get('itemAdd_it_desc',1)) {
	$form->AddInput(array(
		'TYPE' => 'textarea',
		'NAME' => 'it_desc',
		'ID' => 'it_desc',
		'COLS' => 40,
		'ROWS' => 20,
		'LABEL' => $item_type_params->get('itemAdd_it_desc_label','Pełny opis'),
		'VALUE' => $item['it_desc'],
		'CLASS' => 't4',
	));
}	
	
if($item_type_params->get('itemAdd_it_logo',1)) {	
	$form->AddInput(array(
		'TYPE' => 'file',
		'NAME' => 'it_logo',
		'ID' => 'it_logo',
		'LABEL' => 'Plik',
	));
	
	$form->AddInput(array(
		'TYPE' => 'hidden',
		'NAME' => 'previus_it_logo',
		'ID' => 'previus_it_logo',
		'VALUE' => $item['it_logo'],
	));
	
	$form->AddInput(array(
		'TYPE' => 'checkbox',
		'NAME' => 'delete_it_logo',
		'ID' => 'delete_it_logo',
		'LABEL' => 'usuń bieżący obraz',
		'VALUE' => '1',
	));
	
if( $wt_language->languages_count > 1 ) {
	$form->AddInput(array(
		'TYPE' => 'checkbox',
		'NAME' => 'it_logo_multilng',
		'ID' => 'it_logo_multilng',
		'LABEL' => 'Takie samo logo we wszystkich językach',
		'VALUE' => '1',
		'CHECKED' => ($action == 'add') ? 1 : $item['it_logo_multilng'],
	));
}
	
}


if($item_type_params->get('itemAdd_it_logo_large',1)) {	
	$form->AddInput(array(
		'TYPE' => 'file',
		'NAME' => 'it_logo_large',
		'ID' => 'it_logo_large',
		'LABEL' => 'Plik',
	));
	
	$form->AddInput(array(
		'TYPE' => 'hidden',
		'NAME' => 'previus_it_logo_large',
		'ID' => 'previus_it_logo_large',
		'VALUE' => $item['it_logo_large'],
	));
	
	$form->AddInput(array(
		'TYPE' => 'checkbox',
		'NAME' => 'delete_it_logo_large',
		'ID' => 'delete_it_logo_large',
		'LABEL' => 'usuń bieżący obraz',
		'VALUE' => '1',
	));
	
if( $wt_language->languages_count > 1 ) {	
	$form->AddInput(array(
		'TYPE' => 'checkbox',
		'NAME' => 'it_logo_large_multilng',
		'ID' => 'it_logo_large_multilng',
		'LABEL' => 'Takie samo duże logo we wszystkich językach',
		'VALUE' => '1',
		'CHECKED' => ($action == 'add') ? 1 : $item['it_logo_large_multilng'],
	));
}
}

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
		'NAME' => 'parent_id',
		'ID' => 'parent_id',
		'VALUE' => ($action == 'add') ? $this->current_item_id() : $item['parent_id'],
	));
	
if(wt_is_root()) {		
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'it_type',
		'ID' => 'it_type',
		'LABEL' => 'Typ',
		'CLASS' => 't3',
		'VALUE' => $itID
	));
} else {
	$form->AddInput(array(
		'TYPE' => 'hidden',
		'NAME' => 'it_type',
		'ID' => 'it_type',
		'VALUE' => $itID
	));
}
if($item_type_params->get('itemAdd_meta',1)) {		
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'sefu_link',
		'ID' => 'sefu_link',
		'MAXLENGTH' => 255,
		'LABEL' => 'Przyjazny link (sefu)',
		'CLASS' => 't3',
		'VALUE' => $item['sefu_link']
	));
	
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'meta_title',
		'ID' => 'meta_title',
		'MAXLENGTH' => 255,
		'LABEL' => 'META tytuł',
		'CLASS' => 't3',
		'VALUE' => $item['meta_title']
	));
	
	$form->AddInput(array(
		'TYPE' => 'textarea',
		'NAME' => 'meta_keys',
		'ID' => 'meta_keys',
		'LABEL' => 'META słowa kluczowe',
		'COLS' => 40,
		'ROWS' => 7,
		'VALUE' => $item['meta_keys'],
		'CLASS' => 't4',
	));
	
	$form->AddInput(array(
		'TYPE' => 'textarea',
		'NAME' => 'meta_desc',
		'ID' => 'meta_desc',
		'LABEL' => 'META opis',
		'COLS' => 40,
		'ROWS' => 7,
		'VALUE' => $item['meta_desc'],
		'CLASS' => 't4',
	));
}
	
	
	$images = array();
	
	foreach($fields as $_f) {
		if( wt_is_valid( $_f['children'], 'array' ) ) {
			foreach($_f['children'] as $f) {
				switch($f['fi_type']) {
					case 'text':
					case 'url':
					case 'email':
					case 'date':
					case 'datetime':
					case 'video':
					 if(($f['fi_root_edit'] == '1' || $f['fi_root_show'] == '1') && !wt_is_root()) {
					 	 $form->AddInput(array(
							'TYPE' => 'hidden',
							'NAME' => 'fi[' . $f['fi_id'] . ']',
							'ID' => ($f['fi_gr']) ? 'fi_' . $f['fi_gr'] : 'fi_' . $f['fi_id'],
							'LABEL' => $f['fi_name'],
							'VALUE' => $fields_value[$f['fi_id']],
							'CLASS' => 't3',
						));
					 } else {
					 	$form->AddInput(array(
							'TYPE' => 'text',
							'NAME' => 'fi[' . $f['fi_id'] . ']',
							'ID' => ($f['fi_gr']) ? 'fi_' . $f['fi_gr'] : 'fi_' . $f['fi_id'],
							'LABEL' => $f['fi_name'],
							'VALUE' => $fields_value[$f['fi_id']],
							'CLASS' => 't3',
						));
					 }
						break;
					case 'textarea':
					if($f['fi_root_edit'] == '1' && !wt_is_root()) {
						$form->AddInput(array(
							'TYPE' => 'hidden',
							'NAME' => 'fi[' . $f['fi_id'] . ']',
							'ID' => ($f['fi_gr']) ? 'fi_' . $f['fi_gr'] : 'fi_' . $f['fi_id'],
							'LABEL' => $f['fi_name'],
							'VALUE' => $fields_value[$f['fi_id']],
							'CLASS' => 't3',
						));
					} else {
						$form->AddInput(array(
							'TYPE' => 'textarea',
							'NAME' => 'fi[' . $f['fi_id'] . ']',
							'ID' => ($f['fi_gr']) ? 'fi_' . $f['fi_gr'] : 'fi_' . $f['fi_id'],
							'LABEL' => $f['fi_name'],
							'VALUE' => $fields_value[$f['fi_id']],
							'CLASS' => 't3',
							'COLS' => 40,
							'ROWS' => 7,
						));
					}
						break;
					case 'select':
						if($f['fi_root_edit'] == '1' && !wt_is_root()) {
							$form->AddInput(array(
								'TYPE' => 'hidden',
								'NAME' => 'fi[' . $f['fi_id'] . ']',
								'ID' => ($f['fi_gr']) ? 'fi_' . $f['fi_gr'] : 'fi_' . $f['fi_id'],
								'LABEL' => $f['fi_name'],
								'VALUE' => $fields_value[$f['fi_id']],
								'CLASS' => 't3',
							));
						} else {
							$form->AddInput(array(
								'TYPE' => 'select',
								'NAME' => 'fi[' . $f['fi_id'] . ']',
								'ID' => ($f['fi_gr']) ? 'fi_' . $f['fi_gr'] : 'fi_' . $f['fi_id'],
								'LABEL' => $f['fi_name'],
								'OPTIONS' => $this->parse_options_for_form($f['children']),
								'VALUE' => $fields_value[$f['fi_id']],
								'CLASS' => 't3',
							));
						}
						break;
		  /*
		case 'multi_select':
						$size = 12;
						$count_opt = count($options);
						if($count_opt < 50) {
							$size = round(count($options)/4);
						}
						if($size < 4) {
							$size = 4;
						}
						
						$Sparams = array();
						$Sparams['dont_add_blank'] = true;
						$form->AddInput(array(
							'TYPE' => 'select',
							'NAME' => 'fi[' . $f['fi_id'] . ']',
							'ID' => ($f['fi_gr']) ? 'fi_' . $f['fi_gr'] : 'fi_' . $f['fi_id'],
							'LABEL' => $f['fi_name'],
							'OPTIONS' => $options = $this->parse_options_for_form($f['children'], $Sparams),
							'SELECTED' => $fields_value[$f['fi_id']],
							'CLASS' => 't3',
							'MULTIPLE' => 1,
							'SIZE' => $size,
						));
						break;
*/
					case 'checkbox':
						if($f['fi_root_edit'] == '1' && !wt_is_root()) {
						$form->AddInput(array(
							'TYPE' => 'hidden',
							'NAME' => 'fi[' . $f['fi_id'] . ']',
							'ID' => ($f['fi_gr']) ? 'fi_' . $f['fi_gr'] : 'fi_' . $f['fi_id'],
							'LABEL' => $f['fi_name'],
							'VALUE' => $fields_value[$f['fi_id']] ? 1 : 0,
							'CLASS' => 't3',
						));
					} else {
						$form->AddInput(array(
							'TYPE' => 'checkbox',
							'NAME' => 'fi[' . $f['fi_id'] . ']',
							'ID' => ($f['fi_gr']) ? 'fi_' . $f['fi_gr'] : 'fi_' . $f['fi_id'],
							'LABEL' => $f['fi_name'],
							'VALUE' => 1,
							'CHECKED' => $fields_value[$f['fi_id']] ? $fields_value[$f['fi_id']] : null,
							'CLASS' => 't4checkbox'
						));
				   }
						break;
					/*
						$images[$f['fi_id']] = $fields_value[$f['fi_id']];
						$wt_template->assign('images', $images);
						break;
					*/
					case 'files':
					case 'gallery':
						$files[$f['fi_id']] = $fields_value[$f['fi_id']];
						$wt_template->assign('files',$files);
						break;
					case 'file':	
						$file = $fields_value[$f['fi_id']];
						$wt_template->assign('file',$file);
						break;
					case 'data_table':
						$f_params = new wt_params($f['params']);
						$data_table_params[$f['fi_id']] = $f_params->get_array();
						$data_table_params[$f['fi_id']]['data_table_columns_head_array'] = explode('|', $data_table_params[$f['fi_id']]['data_table_columns_head']);
						$data_table_params[$f['fi_id']]['data_table_columns_key_array'] = explode('|', $data_table_params[$f['fi_id']]['data_table_columns_key']);
						$wt_template->assign('data_table_params', $data_table_params);
				  //		wt_print_array($data_table_params);
						break;
					case 'form':
						$wt_template->assign('add_form_section',1);
						$wt_template->assign('fi_id',$f['fi_id']);
						$form->AddInput(array(
							'TYPE' => 'text',
							'NAME' => 'fi[' . $f['fi_id'] . '][email_title]',
							'ID' => (($f['fi_gr']) ? 'fi_' . $f['fi_gr'] : 'fi_' . $f['fi_id']) . '_email_title',
							'LABEL' => 'Tytuł maila',
							'VALUE' => $fields_value[$f['fi_id']]['email_title'],
							'CLASS' => 't3',
						));
						$form->AddInput(array(
							'TYPE' => 'textarea',
							'NAME' => 'fi[' . $f['fi_id'] . '][email_addresses]',
							'ID' => (($f['fi_gr']) ? 'fi_' . $f['fi_gr'] : 'fi_' . $f['fi_id']) .'_email_addresses',
							'LABEL' => 'Wysyłaj na adresy email',
							'VALUE' => $fields_value[$f['fi_id']]['email_addresses'],
							'CLASS' => 't3',
							'COLS' => 40,
							'ROWS' => 7,
						));
						break;
						//
				} // switch($f['fi_type']) {
					
						$fields_key_to_id[($f['fi_gr']) ? 'fi_' . $f['fi_gr'] : 'fi_' . $f['fi_id']] = $f['fi_id'];
						$fields_id_to_key[$f['fi_id']] = ($f['fi_gr']) ? 'fi_' . $f['fi_gr'] : 'fi_' . $f['fi_id'];
			} // foreach($_f['children'] as $f) {
		} // if( wt_is_valid( $_f['children'], 'array' ) ) {
	} // foreach($fields as $_f) {
				$wt_template->assign('fields_key_to_id', $fields_key_to_id);
				$wt_template->assign('fields_id_to_key', $fields_id_to_key);

/*

wt_print_array(serialize(array('data_table_columns_head' => 'Parametr|Wartość',
										 'data_table_columns_key' => 'param|value')));
*/

/*

wt_print_array(serialize(array('where' => "si.it_type = '63' AND ",
										 'dsplit' => true,
										 'order' => "si.it_id DESC")));	
*/
	// wt_print_array(serialize(array('where' => "si.parent_id = '103' AND ", 'dsplit' => true, 'order' => " sid.it_name")));	

	
	$form->AddInput(array(
		'TYPE' => 'hidden',
		'NAME' => '_formType', 
		'ID' => '_formType',
		'VALUE' => $_formType
	));
				
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
	
	if($_formType == 'popup') {	
		if(wt_not_null($_return2 = wt_set_task($_REQUEST, '_return2'))) {
			$form->AddInput(array(
				'TYPE' => 'image',
				'ID' => 'cancel_button',
				'VALUE' => '&laquo; Anuluj',
				'CLASS' => 'button',
				'ONCLICK' => "document.location.href = '".wt_href_link('mod_structure_manager', '', wt_parse_sefu_string_to_url($_return2))."'; return false",
				'SRC' => CFGF_DIR_WS_TEMPLATES . 'admin2/media/images/but_cancel.gif',
			));
		} else {
			$form->AddInput(array(
				'TYPE' => 'image',
				'ID' => 'cancel_button',
				'VALUE' => '&laquo; Anuluj',
				'CLASS' => 'button',
				'ONCLICK' => 'window.close(); return false',
				'SRC' => CFGF_DIR_WS_TEMPLATES . 'admin2/media/images/but_cancel.gif',
			));
		}
		
		$form->AddInput(array(
			'TYPE' => 'image',
			'ID' => 'cancel_button',
			'VALUE' => '&laquo; Anuluj',
			'CLASS' => 'button',
			'ONCLICK' => 'window.close(); return false',
			'SRC' => CFGF_DIR_WS_TEMPLATES . 'admin2/media/images/but_cancel.gif',
		));
  } else {
  	 $form->AddInput(array(	
		'TYPE' => 'image',
		'ID' => 'cancel_button',
		'VALUE' => '&laquo; Anuluj',
		'CLASS' => 'button',
		'ONCLICK' => 'hide_action_form_large(); return false',
		'SRC' => CFGF_DIR_WS_TEMPLATES . 'admin2/media/images/but_cancel.gif',
	));	
  }	
	
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
		'TYPE' => 'hidden',
		'NAME' => 'language_id',
		'VALUE' => $language_id
	));
	
	$form->AddInput(array(
		'TYPE' => 'hidden',
		'NAME' => '_return2',
		'VALUE' => wt_set_task($_REQUEST, '_return2'),
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
			'CLASS' => 'languageStatus',
		));
	}
}
	
	
  // PARAMS_TYPE	

if(wt_is_root()) {

		$form->AddInput(array(
		'TYPE' => 'text',
		'ID' => 'import_id',
		'NAME' => 'import_id',
		'MAXLENGTH' => 255,
		'LABEL' => 'Import ID',
		'CLASS' => 't3',
		'VALUE' => $item['import_id'],
	));

	$form->AddInput(array(
		'TYPE' => 'text',
		'ID' => 'params_type_itt_sefu_id',
		'NAME' => 'params_type[itt_sefu_id]',
		'MAXLENGTH' => 255,
		'LABEL' => 'Sefu id',
		'CLASS' => 't3',
		'VALUE' => wt_set_task($params_type, 'itt_sefu_id', $item_type['itt_sefu_id']),
	));
	
	$form->AddInput(array(
		'TYPE' => 'text',
		'ID' => 'params_type_itt_ico',
		'NAME' => 'params_type[itt_ico]',
		'MAXLENGTH' => 255,
		'LABEL' => 'Ikona',
		'CLASS' => 't2',
		'VALUE' => wt_set_task($params_type, 'itt_ico', $item_type['itt_ico']),
	));
	
	$form->AddInput(array(
		'TYPE' => 'checkbox',
		'ID' => 'params_type_itt_nochildren',
		'NAME' => 'params_type[itt_nochildren]',
		'LABEL' => 'Brak dzieci',
		'CHECKED' => wt_set_task($params_type, 'itt_nochildren', $item_type['itt_nochildren']),
		'VALUE' => '1',
		'CLASS' => 't4checkbox'
	));
	
	
	
	$form->AddInput(array(
		'TYPE' => 'checkbox',
		'ID' => 'params_type_itt_root_show',
		'NAME' => 'params_type[itt_root_show]',
		'LABEL' => 'ROOT show',
		'CHECKED' => wt_set_task($params_type, 'itt_root_show', $item_type['itt_root_show']),
		'VALUE' => '1',
		'CLASS' => 't4checkbox'
	));
		
	$form->AddInput(array(
		'TYPE' => 'checkbox',
		'ID' => 'params_type_itt_mod_structure_add_show',
		'NAME' => 'params_type[itt_mod_structure_add_show]',
		'LABEL' => 'MSA show',
		'CHECKED' => wt_set_task($params_type, 'itt_mod_structure_add_show', $item_type['itt_mod_structure_add_show']),
		'VALUE' => '1',
		'CLASS' => 't4checkbox'
	));
		
	$form->AddInput(array(
		'TYPE' => 'checkbox',
		'ID' => 'params_type_itt_root_edit',
		'NAME' => 'params_type[itt_root_edit]',
		'LABEL' => 'ROOT edit',
		'CHECKED' => wt_set_task($params_type, 'itt_root_edit', $item_type['itt_root_edit']),
		'VALUE' => '1',
		'CLASS' => 't4checkbox'
	));
	
	$form->AddInput(array(
		'TYPE' => 'checkbox',
		'ID' => 'params_type_itt_root_addchildren',
		'NAME' => 'params_type[itt_root_addchildren]',
		'LABEL' => 'ROOT addchildren',
		'CHECKED' => wt_set_task($params_type, 'itt_root_addchildren', $item_type['itt_root_addchildren']),
		'VALUE' => '1',
		'CLASS' => 't4checkbox'
	));
	
	$form->AddInput(array(
		'TYPE' => 'checkbox',
		'ID' => 'params_type_itt_disable_languages',
		'NAME' => 'params_type[itt_disable_languages]',
		'LABEL' => 'Wyłącz języki',
		'CHECKED' => wt_set_task($params_type, 'itt_disable_languages', $item_type['itt_disable_languages']),
		'VALUE' => '1',
		'CLASS' => 't4checkbox'
	));
	
	$item['itt_children_only_tree_array'] = explode(',',$item['itt_children_only_tree']);
	$tree =  array('' => '--- pokaż wszystko ---', 'none' => '--- nic nie pokazuj ---');
	$tree = array_merge($tree, $this->get_items_type_for_form());

	$form->AddInput(array(
		'TYPE' => 'select',
		'ID' => 'params_type_itt_children_only_tree',
		'NAME' => 'params_type[itt_children_only_tree]',
		'MULTIPLE' => 1,
		'SIZE' => 10,
		'VALUE' => wt_set_task($params_type, 'itt_children_only_tree', $item_type['itt_children_only_tree']),
		'SELECTED' => explode(',', wt_set_task($params_type, 'itt_children_only_tree', $item_type['itt_children_only_tree'])),
		'LABEL' => 'W drzewie pokaż jedynie',
		'OPTIONS' => $tree,
	));
	
	$item['itt_children_only_array'] = explode(',',$item['itt_children_only']);
	$form->AddInput(array(
		'TYPE' => 'select',
		'ID' => 'params_type_itt_children_only',
		'NAME' => 'params_type[itt_children_only]',
		'MULTIPLE' => 1,
		'SIZE' => 10,
		'VALUE' => wt_set_task($params_type, 'itt_children_only', $item_type['itt_children_only']),
		'SELECTED' => explode(',', wt_set_task($params_type, 'itt_children_only', $item_type['itt_children_only'])),
		'LABEL' => 'Dozwolone dzieci',
		'OPTIONS' => $this->get_items_type_for_form(),
	));
}

	
	$action_save = array();
	$action_save['save'] = 'zapisz';
	if($action == "edit") {
	$action_save['save_as_new'] = 'dodaj jako nowy wpis';
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
								 'add_new' => 'dodaj nowy wpis',
								 'edit' => 'powrót do edycji tego wpisu')
	));
  //	wt_print_array($item_type_params_array);
	
	$wt_template->assign_by_ref('form', $form);
	$wt_template->register_prefilter('smarty_prefilter_form');
	$wt_template->SetTemplateDir('modules' . DIRECTORY_SEPARATOR . $this->module_key . DIRECTORY_SEPARATOR);
	if(wt_not_null($item_type_params_array['adminList_items_add_theme'])) {
		$wt_template->fetch('addons/addItem_'.$item_type_params_array['adminList_items_add_theme'].'_form.tpl', null, $this->module_key);
	} else {
		$wt_template->fetch('addItem_form.tpl', null, $this->module_key);
	}
	
	$wt_template->SetTemplateDir();
	$wt_template->unregister_prefilter('smarty_prefilter_form');
	$wt_template->assign('addItem_form', FormCaptureOutput($form, array('EndOfLine' => "\n")));
	
	if(wt_not_null($item_type_params_array['adminList_items_add_theme'])) {
		$wt_template->load_file('addons/addItem_'.$item_type_params_array['adminList_items_add_theme'].'.tpl');
	} else {
		$wt_template->load_file('addItem.tpl');
	}	
?>