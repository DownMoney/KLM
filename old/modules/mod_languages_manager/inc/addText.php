<?php 
	$tID = wt_set_task($_REQUEST, 'tID');
	$mod_id = wt_set_task($_REQUEST, 'mID', '-1');
	if(wt_is_valid($tID,'int','0')) {
  		$action = 'edit';
  		$tID = wt_set_task($_REQUEST, 'tID');
  		$params = array();
  		$params['all_values'] = true;
  		$item = $this->get_texts($tID,$params);
  		$wt_template->assign('item',$item);
  	} else {
  		$action = 'add'; 
  	}
   	$wt_template->assign('action', $action);
	
   	global $wt_module;
	
	
    $form = new form_class();
  	$form->NAME = 'addText';
  	$form->ID = 'addText';
  	$form->TARGET = 'operation2';
  	$form->METHOD = 'POST';
  	$form->ACTION = wt_href_link('', '', wt_get_all_get_params(array('a', 'tID', 't', 'm')));
  	$form->debug = 'wt_print_array';
  	$form->ENCTYPE = 'multipart/form-data';
   
  	if ($action=='edit') {
	  	if ($item['mod_id']==-1) {
	  		$offset = 0;
	  	} else {
	  		$offset = strlen($wt_module->installed_modules_ids[$item['mod_id']])+1;
	  	}
	  	$key_value = substr_replace($item['txt_key'],'',0,5+$offset);
  	} else {
  		$key_value = '';
  	}
  	$form->AddInput(array(	
		'TYPE' => 'text',
		'NAME' => 'txt_key',
		'ID' => 'txt_key',
		'MAXLENGTH' => 255,
		'LABEL' => 'Klucz',
	 	'CLASS' => 't4',
		'VALUE' => $key_value,
		'ExtraAttributes' => array('onchange' => 'updateKey(this); return false',
								'onkeyup' => 'updateKey(this); return false'),
		'ValidateAsNotEmpty' => 1,
		'ValidateAsNotEmptyErrorMessage' => 'Należy podać klucz wpisu.',
	));
	$local_suffix = '';
	$modules_keys = array();
	$modules_for_form = array();
	$modules_for_form['-1'] = 'globalne';
	if (wt_is_root()) {
		if (wt_is_valid($wt_module->installed_modules_manager,'array')) {
			$modules_for_form['__LABEL_M'] = 'Administracyjne';
			$tmp_modules = array();
			foreach ($wt_module->installed_modules_manager as $mod_key) {
				//$modules_for_form[$wt_module->installed_modules_keys[$mod_key]] = $mod_key;
				//$modules_for_form[$wt_module->installed_modules_keys[$mod_key]] = $wt_module->installed_modules[$mod_key]['mod_title'];
				$label = (wt_not_null($wt_module->installed_modules[$mod_key]['mod_title']) ? $wt_module->installed_modules[$mod_key]['mod_title'] : $mod_key);
				$tmp_modules[$wt_module->installed_modules_keys[$mod_key]] = $label;
				$modules_keys[$wt_module->installed_modules_keys[$mod_key]] = $mod_key;
			}
			asort($tmp_modules);
			$modules_for_form = $modules_for_form+$tmp_modules;
			$modules_for_form['__LABEL_M'] = 'Administracyjne';
		}
	}
	if (wt_is_valid($wt_module->installed_modules_local,'array')) {
		$modules_for_form['__LABEL_L'] = 'Lokalne';
		$tmp_modules = array();
		foreach ($wt_module->installed_modules_local as $mod_key) {
			//$modules_for_form[$wt_module->installed_modules_keys[$mod_key]] = $mod_key;
			//$modules_for_form[$wt_module->installed_modules_keys[$mod_key]] = $wt_module->installed_modules[$mod_key]['mod_title'];
			$label = (wt_not_null($wt_module->installed_modules[$mod_key]['mod_title']) ? $wt_module->installed_modules[$mod_key]['mod_title'] : $mod_key);
			$tmp_modules[$wt_module->installed_modules_keys[$mod_key]] = $label;
			$modules_keys[$wt_module->installed_modules_keys[$mod_key]] = $mod_key;
		}
		asort($tmp_modules);
		$modules_for_form = $modules_for_form+$tmp_modules;
		$modules_for_form['__LABEL_L'] = 'Lokalne';
	}
	//asort($modules_for_form);
	$wt_template->assign('modules_keys',$modules_keys);
	$form->AddInput(array(	
		'TYPE' => 'select',
		'NAME' => 'mod_id',
		'ID' => 'mod_id',
		'LABEL' => 'Moduł',
	 	'CLASS' => 't3',
	 	'OPTIONS' => $modules_for_form,
		'VALUE' => ($action=='edit' ? $item['mod_id'] : $mod_id),
		'ONCHANGE' => 'updateTxtKey(this); return false'
	));
	
	global $wt_language;
	
	$languages = array();
	if (wt_is_valid($wt_language->catalog_languages,'array')) {
		foreach ($wt_language->catalog_languages as $language) {
			$form->AddInput(array(	
				'TYPE' => 'textarea',
				'NAME' => 'txt_value['.$language['id'].']',
				'ID' => 'txt_value_'.$language['id'],
				//'LABEL' => ' ',
				'LABEL' => '<img src="'.CFGF_DIR_WS_TEMPLATES . 'admin2/media/images/flags/'.$language['code'].'.gif" alt="'.$language['name'].'" align="absmiddle" /> '.$language['name'],				
			 	'CLASS' => 't3',
				'VALUE' => $item['values'][$language['id']]['txt_value'],
				'ValidationClientFunction' => 'checkValues',
				'ValidationClientFunctionErrorMessage' => 'Należy podać wartość dla conajmniej jednego języka'
			));
			
			$form->AddInput(array(	
					'TYPE' => 'hidden',
					'NAME' => 'ln_id['.$language['id'].']',
					'ID' => 'ln_id_'.$language['id'],
					'VALUE' => $language['id']
				));
				
			$languages[$language['id']] = $language;
			if (wt_is_valid($item['values'][$language['id']]['txt_id'],'int','0')) {
				$form->AddInput(array(	
					'TYPE' => 'hidden',
					'NAME' => 'txt_id['.$language['id'].']',
					'ID' => 'txt_id_'.$language['id'],
					'VALUE' => $item['values'][$language['id']]['txt_id']
				));
			}
		}
		$wt_template->assign('languages',$languages);
	}
	
	$form->AddInput(array(
		'TYPE' => 'hidden',
		'NAME' => 'a',
		'ID' => 'action',
		'VALUE' => 'saveText'
	));
	
	if($action == 'edit') {
	$form->AddInput(array(
		'TYPE' => 'hidden',
		'NAME' => 'tID',
		'ID' => 'tID',
		'VALUE' => $tID
	));
	}
	
	global $wt_session;	
	
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
		'TYPE' => 'select',
		'NAME' => 'action_after',
		'ID' => 'action_after',
		'VALUE' => wt_set_task($_REQUEST, 'action_after', 'main'),
		'LABEL' => 'Akcja',
		'OPTIONS' => array('main' => 'powróć do listy',
								 'add_new' => 'dodaj nowy wpis',
								 'edit' => 'powrót do edycji tego wpisu')
	));
	
	$wt_template->assign_by_ref('form', $form);
	$wt_template->register_prefilter('smarty_prefilter_form');
	$wt_template->SetTemplateDir('modules' . DIRECTORY_SEPARATOR . $this->module_key . DIRECTORY_SEPARATOR);
	$wt_template->fetch('addText_form.tpl', null, $this->module_key);
	$wt_template->SetTemplateDir();
	$wt_template->unregister_prefilter('smarty_prefilter_form');
		
	$wt_template->assign('addText_form', FormCaptureOutput($form, array('EndOfLine' => "\n")));
		
    $wt_template->load_file('addText.tpl');
	 
?>
