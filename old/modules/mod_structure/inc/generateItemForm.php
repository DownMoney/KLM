<?php
	$form = new form_class();
	$form->NAME = $child['fi_gr'];
	$form->ID = $child['fi_gr'];
	$form->METHOD = 'POST';
	$form->ACTION = wt_href_link('', '', wt_get_all_get_params(array('t', 'form_sended')).'t=sF');
	$form->error = 'wt_print_array';
	$form->ENCTYPE = 'multipart/form-data';


	if (wt_is_valid($item_form,'array')) {

		if (wt_is_valid($item_form['form'],'array')) {
			foreach ($item_form['form'] as $field) {
				$field_name = $field['field_form_name'];
				$form_field = array(
					'NAME' => $child['fi_gr'].'['.$field_name.']',
					'ID' => $child['fi_gr'].'_'.$field_name,
					'LABEL' => $field['name'],
					//'VALUE' => '',
				);
				if ($field['type']=='text' || $field['type']=='pass' || $field['type']=='date') {
					if ($field['type']=='pass') {
						$form_field['TYPE'] = 'password';
					} else {
						$form_field['TYPE'] = 'text';
					}
					$form_field['VALUE'] = '';
					if (wt_is_valid($field['size'],'int','0')) {
						$form_field['SIZE'] = $field['size'];
					}
					if (wt_is_valid($field['required'],'int','0')) {
						$form_field['ValidateAsNotEmpty'] = 1;
     					$form_field['ValidateAsNotEmptyErrorMessage'] = 'Pole '.$field['name'].' musi być wypełnione.';
     					if ($field['type']=='date') {
     						$form_field['ValidateRegularExpression'] = '^[0-9]{2}-[0-9]{2}-[0-9]{4}$';
     						$form_field['ValidateRegularExpressionErrorMessage'] = 'Pole '.$field['name'].' musi mieć format DD-MM-RRRR.';
     					}
					}
					if (wt_is_valid($field['asEmail'],'int','0')) {
						$form_field['ValidateAsEmail'] = 1;
     					$form_field['ValidateAsEmailErrorMessage'] = 'Pole '.$field['name'].' musi zawierać prawidłowy e-mail.';
					}
					$form->AddInput($form_field);
				}
				if ($field['type']=='textarea') {
					$form_field['TYPE'] = 'textarea';
					$form_field['VALUE'] = '';
					if (wt_is_valid($field['required'],'int','0')) {
						$form_field['ValidateAsNotEmpty'] = 1;
     					$form_field['ValidateAsNotEmptyErrorMessage'] = 'Pole '.$field['name'].' musi być wypełnione.';
					}
					if (wt_is_valid($field['cols'],'int','0')) {
						$form_field['COLS'] = $field['cols'];
     				}
     				if (wt_is_valid($field['rows'],'int','0')) {
						$form_field['ROWS'] = $field['rows'];
     				}
     				$form->AddInput($form_field);
				}
				if ($field['type']=='select') {
					$form_field['TYPE'] = 'select';
					$form_field['VALUE'] = '';
					if (wt_is_valid($field['required'],'int','0')) {
						$form_field['ValidateMinimumLength'] = 1;
	  					$form_field['ValidateMinimumLengthErrorMessage'] = 'Pole '.$field['name'].' musi być wypełnione.';
					}
					if (wt_is_valid($field['options'],'array')) {
						$options_for_form = array('' => '--- WYBIERZ ---');
						foreach ($field['options'] as $option) {
							$options_for_form[$option] = $option;
						}
						$form_field['OPTIONS'] = $options_for_form;
					}
					$form->AddInput($form_field);
				}
				if ($field['type']=='radio' || $field['type']=='checkbox') {
					$form_field['TYPE'] = $field['type'];
					if (wt_is_valid($field['required'],'int','0')) {
						$form_field['ValidateAsSet'] = 1;
		  				$form_field['ValidateAsSetErrorMessage'] = 'Musisz zaznaczyć ' . $field['name'];
					}
					if (wt_is_valid($field['options'],'array')) {
						foreach ($field['options'] as $option) {
							$radio_button = $form_field;
							$radio_button['VALUE'] = $option;
							$radio_button['ID'] .= '_'.$option;
							$radio_button['LABEL'] = $option;
							$form->AddInput($radio_button);
						}
					}
				}
			}
		}
	}

	$form->AddInput(array(
		'TYPE' => 'hidden',
		'NAME' => 't',
		'ID' => 't',
		'VALUE' => 'sF'
	));

	$form->AddInput(array(
		'TYPE' => 'hidden',
		'NAME' => 'form_name',
		'ID' => 'form_name',
		'VALUE' => $child['fi_gr']
	));

	$form->AddInput(array(
		'TYPE' => 'hidden',
		'NAME' => $child['fi_gr'].'[fi_id]',
		'ID' => $child['fi_gr'].'_fi_id',
		'VALUE' => $child['fi_id']
	));

	$form->AddInput(array(
		'TYPE' => 'submit',
		'ID' => 'submit_button',
		'NAME' => 'submit',
		'VALUE' => 'Wyślij',
		'CLASS' => '',
		'LABEL' => "save"
	));
	global $wt_template;

	$wt_template->assign_by_ref('form', $form);
	$wt_template->register_prefilter('smarty_prefilter_form');
	$wt_template->SetTemplateDir('modules' . DIRECTORY_SEPARATOR . $this->module_key . DIRECTORY_SEPARATOR);
	$wt_template->fetch('form_'.$child['fi_gr'].'.tpl', null, $this->module_key);
	$wt_template->SetTemplateDir();
	$wt_template->unregister_prefilter('smarty_prefilter_form');
	$wt_template->assign('form_'.$child['fi_gr'], FormCaptureOutput($form, array('EndOfLine' => "\n")));
?>
