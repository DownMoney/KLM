<?php

	$fID = wt_set_task($_REQUEST, 'fID');
	$tID = wt_set_task($_REQUEST, 'tID');

	if( wt_is_valid($fID, 'int', '0') ) {
		$action = 'edit';
		$wt_template->assign('item', $item = $this->get_config_fields($fID, array('language_id' => $language_id)));
	} else {
		$action = 'add';
		$item['parent_id'] = wt_set_task($_REQUEST, 'pID');
		$item['it_type'] = $tID;
	}

	//wt_print_array($item);

	$wt_template->assign('action', $action);

	$form = new form_class();
	$form->NAME = 'addField';
	$form->ID = 'addField';
	$form->METHOD = 'POST';
	$form->ACTION = wt_href_link('', '', wt_get_all_get_params(array('a', 'fID', 't', 'm')));
	$form->TARGET = 'operation2';
	$form->error = 'wt_print_array';
	$form->ENCTYPE = 'multipart/form-data';

	$db_item_params = new wt_params($item['params']);
	$parameters = new wt_set_params('', array('addField','addField_'.$item['itt_key'],'addField_structure_add','addField_addItem'), $db_item_params);
	$parameters->set_form($form);
	$parameters->set_template();
	$wt_template->assign('params', $parameters->params_array);
	$wt_template->assign('item_params', $db_item_params->get_array());


	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'fi_name',
		'ID' => 'fi_name',
		'MAXLENGTH' => 255,
		'LABEL' => 'Nazwa',
		'CLASS' => 't4',
		'VALUE' => $item['fi_name'],
		'ValidateAsNotEmpty' => 1,
		'ValidateAsNotEmptyErrorMessage' => 'Pole musi mieć nazwę'
	));

	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'fi_name_short',
		'ID' => 'fi_name_short',
		'MAXLENGTH' => 255,
		'LABEL' => 'Nazwa skrócona',
		'CLASS' => 't3',
		'VALUE' => $item['fi_name_short'],
	));

	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'fi_gr',
		'ID' => 'fi_gr',
		'MAXLENGTH' => 255,
		'LABEL' => 'Klucz',
		'CLASS' => 't3',
		'VALUE' => $item['fi_gr']
	));

	$form->AddInput(array(
		'TYPE' => 'select',
		'NAME' => 'fi_type',
		'ID' => 'fi_type',
		'LABEL' => 'Pole',
		'CLASS' => 't3',
		'VALUE' => $item['fi_type'],
		'OPTIONS' => array('' => '--- brak ---',
							    'text' => 'input - tekst',
							    'url' => 'input - url',
							    'email' => 'input - email',
							    'date' => 'input - data',
							    'datetime' => 'input - data i czas',
							    'textarea' => 'textarea',
							    'select' => 'select',
								 'select_item' => 'select z wyborem wpisów z mod_structure',
								 'multi_select_item' => 'select wielokrotny  z wyborem wpisów z mod_structure',
							    'multi_select' => 'select wielokrotnego zaznaczenia',
							    'multi_select_group' => 'select grupowy wielokrotnego zaznaczenia',
							    'checkbox' => 'checkbox',
							    'gallery' => 'galeria',
							    'files' => 'pliki',
							    'file' => 'plik',
							    'data_table' => 'tabela',
							    'googlemaps' => 'google maps',
							    'head' => 'nagłówek w adminie',
							    'user_defined' => 'zdefiniowane przez admina',
							    'form' => 'formularz', )
	));

	if($item['parent_id'] == 0) {
		$form->AddInput(array(
			'TYPE' => 'checkbox',
			'NAME' => 'fi_show_on_short',
			'ID' => 'fi_show_on_short',
			'LABEL' => 'Pokaż w skrótach',
			'CLASS' => 't4checkbox',
			'VALUE' => '1',
			'CHECKED' => $item['fi_show_on_short']
		));
	}


		$form->AddInput(array(
			'TYPE' => 'checkbox',
			'NAME' => 'fi_multi_language',
			'ID' => 'fi_multi_language',
			'LABEL' => 'Taka sama wartość we wszystkich językach',
			'CLASS' => 't4checkbox',
			'VALUE' => '1',
			'CHECKED' => $item['fi_multi_language']
		));


	$form->AddInput(array(
			'TYPE' => 'checkbox',
			'NAME' => 'fi_root_edit',
			'ID' => 'fi_root_edit',
			'LABEL' => 'ROOT edit',
			'CLASS' => 't4checkbox',
			'VALUE' => '1',
			'CHECKED' => $item['fi_root_edit']
		));

	$form->AddInput(array(
			'TYPE' => 'checkbox',
			'NAME' => 'fi_root_show',
			'ID' => 'fi_root_show',
			'LABEL' => 'ROOT show',
			'CLASS' => 't4checkbox',
			'VALUE' => '1',
			'CHECKED' => $item['fi_root_show']
		));

	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'parent_id',
		'ID' => 'parent_id',
		'MAXLENGTH' => 255,
		'LABEL' => 'parent_id',
		'VALUE' => $item['parent_id'],
	));

	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'fi_depends_on',
		'ID' => 'fi_depends_on',
		'MAXLENGTH' => 255,
		'LABEL' => 'fi_depends_on',
		'VALUE' => $item['fi_depends_on'],
	));

	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'fi_related_to',
		'ID' => 'fi_related_to',
		'MAXLENGTH' => 255,
		'LABEL' => 'fi_related_to',
		'VALUE' => $item['fi_related_to'],
	));

	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'has_children',
		'ID' => 'has_children',
		'MAXLENGTH' => 255,
		'LABEL' => 'has_children',
		'VALUE' => $item['has_children'],
	));


	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'it_type',
		'ID' => 'it_type',
		'MAXLENGTH' => 255,
		'LABEL' => 'it_type',
		'VALUE' => $item['it_type'],
	));

	$form->AddInput(array(
		'TYPE' => 'text',
		'ID' => 'import_id',
		'NAME' => 'import_id',
		'MAXLENGTH' => 255,
		'LABEL' => 'Import ID',
		'CLASS' => 't2',
		'VALUE' => $item['import_id'],
	));

	$form->AddInput(array(
		'TYPE' => 'text',
		'ID' => 'fi_key',
		'NAME' => 'fi_key',
		'MAXLENGTH' => 255,
		'LABEL' => 'Klucz',
		'CLASS' => 't2',
		'VALUE' => $item['fi_key'],
	));

	$form->AddInput(array(
		'TYPE' => 'hidden',
		'NAME' => 'a',
		'ID' => 'action',
		'VALUE' => 'saveField'
	));

	if($action == 'edit') {
		$form->AddInput(array(
			'TYPE' => 'hidden',
			'NAME' => 'fID',
			'ID' => 'fID',
			'VALUE' => $fID
		));
	}

	$form->AddInput(array(
			'TYPE' => 'hidden',
			'NAME' => 'language_id',
			'ID' => 'language_id',
			'VALUE' => $language_id
		));



	$form->AddInput(array(
		'TYPE' => 'hidden',
		'NAME' => 'submit_type',
		'ID' => 'submit_type',
		'VALUE' => ''
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
	$action_save['save_as_new'] = 'dodaj jako nowe pole';
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
								 'add_new' => 'dodaj nowe pole',
								 'edit' => 'powrót do edycji tego pola')
	));



	/*------ params_add ---------------*/

	$form->AddInput(array(
		'TYPE' => 'checkbox',
		'NAME' => 'params_add[show]',
		'ID' => 'params_add_show',
		'VALUE' => 1,
		'CHECKED' => $item['params_add']['show'],
		'LABEL' => 'Pokaż użytkownikowi',
	));

	$form->AddInput(array(
		'TYPE' => 'checkbox',
		'NAME' => 'params_add[ValidateAsNotEmpty]',
		'ID' => 'params_add_ValidateAsNotEmpty',
		'VALUE' => 1,
		'LABEL' => 'Validate As Not Empty',
		'CHECKED' => $item['params_add']['ValidateAsNotEmpty'],
	));

	$form->AddInput(array(
		'TYPE' => 'checkbox',
		'NAME' => 'params_add[ValidateAsEmail]',
		'ID' => 'params_add_ValidateAsEmail',
		'VALUE' => 1,
		'LABEL' => 'Validate As Email',
		'CHECKED' => $item['params_add']['ValidateAsEmail'],
	));

	$form->AddInput(array(
		'TYPE' => 'checkbox',
		'NAME' => 'params_add[ValidateAsInteger]',
		'ID' => 'params_add_ValidateAsInteger',
		'VALUE' => 1,
		'LABEL' => 'Validate As Integer',
		'CHECKED' => $item['params_add']['ValidateAsInteger'],
	));

	$form->AddInput(array(
		'TYPE' => 'checkbox',
		'NAME' => 'params_add[ValidateAsVatId]',
		'ID' => 'params_add_ValidateAsVatId',
		'VALUE' => 1,
		'LABEL' => 'Validate As Vat Id',
		'CHECKED' => $item['params_add']['ValidateAsVatId'],
	));

	$form->AddInput(array(
		'TYPE' => 'checkbox',
		'NAME' => 'params_add[ValidateAsFloat]',
		'ID' => 'params_add_ValidateAsFloat',
		'VALUE' => 1,
		'LABEL' => 'Validate As Float',
		'CHECKED' => $item['params_add']['ValidateAsFloat'],
	));

	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'params_add[ValidateRegularExpression]',
		'ID' => 'params_add_ValidateRegularExpression',
		'VALUE' => $item['params_add']['ValidateRegularExpression'],
		'LABEL' => 'Validate Regular Expression',
	));

	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'params_add[ValidateMinimumLength]',
		'ID' => 'params_add_ValidateMinimumLength',
		'VALUE' => $item['params_add']['ValidateMinimumLength'],
		'LABEL' => 'Validate Minimum Length',
	));

	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'params_add[ValidateDateForm]',
		'ID' => 'params_add_ValidateDateForm',
		'VALUE' => $item['params_add']['ValidateDateForm'],
		'LABEL' => 'Validate Date Form',
	));

	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'params_add[ValidateDateTo]',
		'ID' => 'params_add_ValidateDateTo',
		'VALUE' => $item['params_add']['ValidateDateTo'],
		'LABEL' => 'Validate Date To',
	));

	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'params_add[ValidateFileMinX]',
		'ID' => 'params_add_ValidateFileMinX',
		'VALUE' => $item['params_add']['ValidateFileMinX'],
		'LABEL' => 'Validate File Min X',
	));

	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'params_add[ValidateFileMaxX]',
		'ID' => 'params_add_ValidateFileMaxX',
		'VALUE' => $item['params_add']['ValidateFileMaxX'],
		'LABEL' => 'Validate File Max X',
	));

	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'params_add[ValidateFileMinY]',
		'ID' => 'params_add_ValidateFileMinY',
		'VALUE' => $item['params_add']['ValidateFileMinY'],
		'LABEL' => 'Validate File Min Y',
	));

	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'params_add[ValidateFileMaxY]',
		'ID' => 'params_add_ValidateFileMaxY',
		'VALUE' => $item['params_add']['ValidateFileMaxY'],
		'LABEL' => 'Validate File Max Y',
	));

	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'params_add[ValidateFileMaxSize]',
		'ID' => 'params_add_ValidateFileMaxSize',
		'VALUE' => $item['params_add']['ValidateFileMaxSize'],
		'LABEL' => 'Validate File Max Size',
	));

	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'params_add[ValidateFileConfirmedTypes]',
		'ID' => 'params_add_ValidateFileConfirmedTypes',
		'VALUE' => $item['params_add']['ValidateFileConfirmedTypes'],
		'LABEL' => 'Validate File Confirmed Types',
	));

	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'params_add[ValidateFileMaxCount]',
		'ID' => 'params_add_ValidateFileMaxCount',
		'VALUE' => $item['params_add']['ValidateFileMaxCount'],
		'LABEL' => 'Validate File Max Count',
	));


	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'params_add[ValidateFileMinCount]',
		'ID' => 'params_add_ValidateFileMinCount',
		'VALUE' => $item['params_add']['ValidateFileMinCount'],
		'LABEL' => 'Validate File Min Count',
	));
	/*
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'params_add[ValidationUpperLimit]',
		'ID' => 'params_add_ValidationUpperLimit',
		'VALUE' => $item['params_add']['ValidationUpperLimit'],
		'LABEL' => 'Validation Upper Limit',
	));

	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'params_add[ValidationLowerLimit]',
		'ID' => 'params_add_ValidationLowerLimit',
		'VALUE' => $item['params_add']['ValidationLowerLimit'],
		'LABEL' => 'Validation Lower Limit',
	));*/

	/*---- end params add --------*/


	$wt_template->assign_by_ref('form', $form);
	$wt_template->register_prefilter('smarty_prefilter_form');
	$wt_template->SetTemplateDir('modules' . DIRECTORY_SEPARATOR . $this->module_key . DIRECTORY_SEPARATOR);
	$wt_template->fetch('addField_form.tpl', null, $this->module_key);
	$wt_template->SetTemplateDir();
	$wt_template->unregister_prefilter('smarty_prefilter_form');
	$wt_template->assign('addField_form', FormCaptureOutput($form, array('EndOfLine' => "\n")));
	$wt_template->load_file('addField.tpl');
?>
