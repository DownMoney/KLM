<?php

	$tID = wt_set_task($_REQUEST, 'tID');
	if( wt_is_valid($tID, 'int', '0') ) {
		$action = 'edit';
		$wt_template->assign('item', $item = $this->get_items_types($tID));
	} else {
		$action = 'add';
	}

	$wt_template->assign('action', $action);


	$form = new form_class();
	$form->NAME = 'addType';
	$form->ID = 'addType';
	$form->METHOD = 'POST';
	$form->ACTION = wt_href_link('', '', wt_get_all_get_params(array('a', 'tID', 't', 'm')));
	$form->TARGET = 'operation2';
	$form->error = 'wt_print_array';
	$form->ENCTYPE = 'multipart/form-data';

	$db_item_params = new wt_params($item['params']);
	$parameters = new wt_set_params('', array('addType','addType_'.$item['itt_key'],'addType_structure_add','addType_addItem', 'addType_adminList'), $db_item_params);
	$parameters->set_form($form);
	$parameters->set_template();
	$wt_template->assign('params', $parameters->params_array);
	$wt_template->assign('item_params', $db_item_params->get_array());


	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'itt_name',
		'ID' => 'itt_name',
		'MAXLENGTH' => 255,
		'LABEL' => 'Nazwa',
		'CLASS' => 't4',
		'VALUE' => $item['itt_name'],
		'ValidateAsNotEmpty' => 1,
		'ValidateAsNotEmptyErrorMessage' => 'Typ musi mieć nazwę !!!'
	));

	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'itt_key',
		'ID' => 'itt_key',
		'MAXLENGTH' => 255,
		'LABEL' => 'Klucz',
		'CLASS' => 't3',
		'VALUE' => $item['itt_key'],
		'ValidateAsNotEmpty' => 1,
		'ValidateAsNotEmptyErrorMessage' => 'Typ musi mieć klucz !!!'
	));

	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'itt_sefu_id',
		'ID' => 'itt_sefu_id',
		'MAXLENGTH' => 255,
		'LABEL' => 'SEFU id',
		'CLASS' => 't3',
		'VALUE' => $item['itt_sefu_id']
	));

	$form->AddInput(array(
		'TYPE' => 'checkbox',
		'NAME' => 'itt_sefu_ignore',
		'ID' => 'itt_sefu_ignore',
		'LABEL' => 'SEFU - nie generuj',
		'CHECKED' => $item['itt_sefu_ignore'],
		'VALUE' => '1',
		'CLASS' => 't4checkbox'
	));

	$form->AddInput(array(
		'TYPE' => 'checkbox',
		'NAME' => 'itt_sefu_treat_as_file',
		'ID' => 'itt_sefu_treat_as_file',
		'LABEL' => 'SEFU - generuj jako plik',
		'CHECKED' => $item['itt_sefu_treat_as_file'],
		'VALUE' => '1',
		'CLASS' => 't4checkbox'
	));

	$form->AddInput(array(
		'TYPE' => 'textarea',
		'NAME' => 'itt_desc',
		'ID' => 'itt_desc',
		'LABEL' => 'Opis',
		'COLS' => 40,
		'ROWS' => 7,
		'VALUE' => $item['itt_desc'],
		'CLASS' => 't4',
	));

	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'itt_ico',
		'ID' => 'itt_ico',
		'MAXLENGTH' => 255,
		'LABEL' => 'Ikona',
		'CLASS' => 't2',
		'VALUE' => $item['itt_ico']
	));

	$form->AddInput(array(
		'TYPE' => 'checkbox',
		'NAME' => 'itt_nochildren',
		'ID' => 'itt_nochildren',
		'LABEL' => 'Brak dzieci',
		'CHECKED' => $item['itt_nochildren'],
		'VALUE' => '1',
		'CLASS' => 't4checkbox'
	));



	$form->AddInput(array(
		'TYPE' => 'checkbox',
		'NAME' => 'itt_root_show',
		'ID' => 'itt_root_show',
		'LABEL' => 'ROOT show',
		'CHECKED' => $item['itt_root_show'],
		'VALUE' => '1',
		'CLASS' => 't4checkbox'
	));

	$form->AddInput(array(
		'TYPE' => 'checkbox',
		'NAME' => 'itt_mod_structure_add_show',
		'ID' => 'itt_mod_structure_add_show',
		'LABEL' => 'MSA show',
		'CHECKED' => $item['itt_mod_structure_add_show'],
		'VALUE' => '1',
		'CLASS' => 't4checkbox'
	));

	$form->AddInput(array(
		'TYPE' => 'checkbox',
		'NAME' => 'itt_root_edit',
		'ID' => 'itt_root_edit',
		'LABEL' => 'ROOT edit',
		'CHECKED' => $item['itt_root_edit'],
		'VALUE' => '1',
		'CLASS' => 't4checkbox'
	));



	$form->AddInput(array(
		'TYPE' => 'checkbox',
		'NAME' => 'itt_root_addchildren',
		'ID' => 'itt_root_addchildren',
		'LABEL' => 'ROOT addchildren',
		'CHECKED' => $item['itt_root_addchildren'],
		'VALUE' => '1',
		'CLASS' => 't4checkbox'
	));

	$form->AddInput(array(
		'TYPE' => 'checkbox',
		'NAME' => 'itt_disable_languages',
		'ID' => 'itt_disable_languages',
		'LABEL' => 'Wyłącz języki',
		'CHECKED' => $item['itt_disable_languages'],
		'VALUE' => '1',
		'CLASS' => 't4checkbox'
	));




	$item['itt_children_only_tree_array'] = explode(',',$item['itt_children_only_tree']);
	$tree =  array('' => '--- pokaż wszystko ---', 'none' => '--- nic nie pokazuj ---');
	$tree = array_merge($tree, $this->get_items_type_for_form());

	$form->AddInput(array(
		'TYPE' => 'select',
		'NAME' => 'itt_children_only_tree',
		'ID' => 'itt_children_only_tree',
		'MULTIPLE' => 1,
		'SIZE' => 10,
		'VALUE' => $item['itt_children_only_tree'],
		'SELECTED' => (($action == 'add') ? array('none') : $item['itt_children_only_tree_array']),
		'LABEL' => 'W drzewie pokaż jedynie',
		'OPTIONS' => $tree,
	));

	$item['itt_children_only_array'] = explode(',',$item['itt_children_only']);
	$form->AddInput(array(
		'TYPE' => 'select',
		'NAME' => 'itt_children_only',
		'ID' => 'itt_children_only',
		'MULTIPLE' => 1,
		'SIZE' => 10,
		'VALUE' => $item['itt_children_only'],
		'SELECTED' => $item['itt_children_only_array'],
		'LABEL' => 'Dozwolone dzieci',
		'OPTIONS' => $this->get_items_type_for_form(),
	));


	$form->AddInput(array(
		'TYPE' => 'hidden',
		'NAME' => 'a',
		'ID' => 'action',
		'VALUE' => 'saveType'
	));

	if($action == 'edit') {
		$form->AddInput(array(
			'TYPE' => 'hidden',
			'NAME' => 'tID',
			'ID' => 'tID',
			'VALUE' => $tID
		));
	}

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

	$action_save = array();
	$action_save['save'] = 'zapisz';
	if($action == "edit") {
	$action_save['save_as_new'] = 'dodaj jako nowy typ';
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
								 'add_new' => 'dodaj nowy typ',
								 'edit' => 'powrót do edycji tego typu')
	));


	/*  fields list   */
	if(wt_is_valid($tID, 'int', 0)) {
		$fields = $this->get_config_fields_to_type($tID);
		$wt_template->assign('fields', $fields);
		//wt_print_array($fields);
		if(wt_is_valid($fields, 'array', 0)) {
			foreach($fields as $_f) {
				$form->AddInput(array(
					'TYPE' => 'checkbox',
					'NAME' => 'fields['.$_f['fi_id'].'][params_add][show]',
					'ID' => 'fields_'.$_f['fi_id'].'_params_add_show',
					'VALUE' => 1,
					'CHECKED' => ($_f['params_add']['show']) ? 1 : 0,
					'LABEL' => 'Pokaż grupę użytkownikowi',
					'CLASS' => 't4checkbox'
				));
				if(wt_is_valid($_f['children'], 'array', 0)) {
					foreach($_f['children'] as $f) {
						$form->AddInput(array(
							'TYPE' => 'checkbox',
							'NAME' => 'fields['.$f['fi_id'].'][params_add][show]',
							'ID' => 'fields_'.$f['fi_id'].'_params_add_show',
							'VALUE' => 1,
							'CHECKED' => ($f['params_add']['show']) ? 1 : 0,
							'LABEL' => 'Pokaż pole użytkownikowi',
						));
						$form->AddInput(array(
							'TYPE' => 'checkbox',
							'NAME' => 'fields['.$f['fi_id'].'][params_add][ValidateAsNotEmpty]',
							'ID' => 'fields_'.$f['fi_id'].'_params_ValidateAsNotEmpty',
							'VALUE' => 1,
							'CHECKED' => ($f['params_add']['ValidateAsNotEmpty']) ? 1 : 0,
							'LABEL' => 'Validate As Not Empty',
						));
						switch($f['fi_type']) {
							case 'text':
								$form->AddInput(array(
									'TYPE' => 'checkbox',
									'NAME' => 'fields['.$f['fi_id'].'][params_add][ValidateAsEmail]',
									'ID' => 'fields_'.$f['fi_id'].'_params_add_ValidateAsEmail',
									'VALUE' => 1,
									'CHECKED' => ($f['params_add']['ValidateAsEmail']) ? 1 : 0,
									'LABEL' => 'Validate As Email',
								));
								$form->AddInput(array(
									'TYPE' => 'checkbox',
									'NAME' => 'fields['.$f['fi_id'].'][params_add][ValidateAsInteger]',
									'ID' => 'fields_'.$f['fi_id'].'_params_add_ValidateAsInteger',
									'VALUE' => 1,
									'CHECKED' => ($f['params_add']['ValidateAsInteger']) ? 1 : 0,
									'LABEL' => 'Validate As Integer',
								));
								$form->AddInput(array(
									'TYPE' => 'checkbox',
									'NAME' => 'fields['.$f['fi_id'].'][params_add][ValidateAsVatId]',
									'ID' => 'fields_'.$f['fi_id'].'_params_add_ValidateAsVatId',
									'VALUE' => 1,
									'CHECKED' => ($f['params_add']['ValidateAsVatId']) ? 1 : 0,
									'LABEL' => 'Validate As Vat Id',
								));
								$form->AddInput(array(
									'TYPE' => 'checkbox',
									'NAME' => 'fields['.$f['fi_id'].'][params_add][ValidateAsFloat]',
									'ID' => 'fields_'.$f['fi_id'].'_params_add_ValidateAsFloat',
									'VALUE' => 1,
									'CHECKED' => ($f['params_add']['ValidateAsFloat']) ? 1 : 0,
									'LABEL' => 'Validate As Float',
								));

								$form->AddInput(array(
									'TYPE' => 'text',
									'NAME' => 'fields['.$f['fi_id'].'][params_add][ValidateRegularExpression]',
									'ID' => 'fields_'.$f['fi_id'].'_params_add_ValidateRegularExpression',
									'VALUE' => $f['params_add']['ValidateRegularExpression'],
									'LABEL' => 'Validate Regular Expression',
								));

								$form->AddInput(array(
									'TYPE' => 'text',
									'NAME' => 'fields['.$f['fi_id'].'][params_add][ValidateMinimumLength]',
									'ID' => 'fields_'.$f['fi_id'].'_params_add_ValidateMinimumLength',
									'VALUE' => $f['params_add']['ValidateMinimumLength'],
									'LABEL' => 'Validate Minimum Length',
								));
								break;
							case 'date':
							case 'datetime':
								$form->AddInput(array(
									'TYPE' => 'text',
									'NAME' => 'fields['.$f['fi_id'].'][params_add][ValidateDateForm]',
									'ID' => 'fields_'.$f['fi_id'].'_params_add_ValidateDateForm',
									'VALUE' => $f['params_add']['ValidateDateForm'],
									'LABEL' => 'Validate Date Form',
								));
								$form->AddInput(array(
									'TYPE' => 'text',
									'NAME' => 'fields['.$f['fi_id'].'][params_add][ValidateDateTo]',
									'ID' => 'fields_'.$f['fi_id'].'_params_add_ValidateDateTo',
									'VALUE' => $f['params_add']['ValidateDateTo'],
									'LABEL' => 'Validate Date To',
								));
								break;
							case 'textarea':
								$form->AddInput(array(
									'TYPE' => 'text',
									'NAME' => 'fields['.$f['fi_id'].'][params_add][ValidateMinimumLength]',
									'ID' => 'fields_'.$f['fi_id'].'_params_add_ValidateMinimumLength',
									'VALUE' => $f['params_add']['ValidateMinimumLength'],
									'LABEL' => 'Validate Minimum Length',
								));
								break;
							case 'gallery':
							case 'files':
								$form->AddInput(array(
									'TYPE' => 'text',
									'NAME' => 'fields['.$f['fi_id'].'][params_add][ValidateFileMinX]',
									'ID' => 'fields_'.$f['fi_id'].'_params_add_ValidateFileMinX',
									'VALUE' => $f['params_add']['ValidateFileMinX'],
									'LABEL' => 'Validate File Min X',
								));
								$form->AddInput(array(
									'TYPE' => 'text',
									'NAME' => 'fields['.$f['fi_id'].'][params_add][ValidateFileMinY]',
									'ID' => 'fields_'.$f['fi_id'].'_params_add_ValidateFileMinY',
									'VALUE' => $f['params_add']['ValidateFileMinY'],
									'LABEL' => 'Validate File Min Y',
								));
								$form->AddInput(array(
									'TYPE' => 'text',
									'NAME' => 'fields['.$f['fi_id'].'][params_add][ValidateFileMaxX]',
									'ID' => 'fields_'.$f['fi_id'].'_params_add_ValidateFileMaxX',
									'VALUE' => $f['params_add']['ValidateFileMaxX'],
									'LABEL' => 'Validate File Max X',
								));
								$form->AddInput(array(
									'TYPE' => 'text',
									'NAME' => 'fields['.$f['fi_id'].'][params_add][ValidateFileMaxY]',
									'ID' => 'fields_'.$f['fi_id'].'_params_add_ValidateFileMaxY',
									'VALUE' => $f['params_add']['ValidateFileMaxY'],
									'LABEL' => 'Validate File Max Y',
								));
								$form->AddInput(array(
									'TYPE' => 'text',
									'NAME' => 'fields['.$f['fi_id'].'][params_add][ValidateFileMaxSize]',
									'ID' => 'fields_'.$f['fi_id'].'_params_add_ValidateFileMaxSize',
									'VALUE' => $f['params_add']['ValidateFileMaxSize'],
									'LABEL' => 'Validate File Max Size',
								));
								$form->AddInput(array(
									'TYPE' => 'text',
									'NAME' => 'fields['.$f['fi_id'].'][params_add][ValidateFileConfirmedTypes]',
									'ID' => 'fields_'.$f['fi_id'].'_params_add_ValidateFileConfirmedTypes',
									'VALUE' => $f['params_add']['ValidateFileConfirmedTypes'],
									'LABEL' => 'Validate File Confirmed Types',
								));
								$form->AddInput(array(
									'TYPE' => 'text',
									'NAME' => 'fields['.$f['fi_id'].'][params_add][ValidateFileMaxCount]',
									'ID' => 'fields_'.$f['fi_id'].'_params_add_ValidateFileMaxCount',
									'VALUE' => $f['params_add']['ValidateFileMaxCount'],
									'LABEL' => 'Validate File Max Count',
								));
								$form->AddInput(array(
									'TYPE' => 'text',
									'NAME' => 'fields['.$f['fi_id'].'][params_add][ValidateFileMinCount]',
									'ID' => 'fields_'.$f['fi_id'].'_params_add_ValidateFileMinCount',
									'VALUE' => $f['params_add']['ValidateFileMinCount'],
									'LABEL' => 'Validate File Min Count',
								));


								break;
						}
					}
				}
			}//foreach($fields as $_f)
		}
	}

	$wt_template->assign_by_ref('form', $form);
	$wt_template->register_prefilter('smarty_prefilter_form');
	$wt_template->SetTemplateDir('modules' . DIRECTORY_SEPARATOR . $this->module_key . DIRECTORY_SEPARATOR);
	$wt_template->fetch('addType_form.tpl', null, $this->module_key);
	$wt_template->SetTemplateDir();
	$wt_template->unregister_prefilter('smarty_prefilter_form');
	$wt_template->assign('addType_form', FormCaptureOutput($form, array('EndOfLine' => "\n")));
	$wt_template->load_file('addType.tpl');
?>
