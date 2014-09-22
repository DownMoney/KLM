<?php 

if(!isset($data['col_id']) || !is_array($data['col_id'])) {
$data['col_id'] = array();
}


$color_data = array('#400040', '#C0C0C0', '#408080', '#808040', '#400080', '#400040', '#000080', '#004040', '#804000', '#400000', '#8000FF', '#800080', '#0000A0', '#0000FF', '#008000', '#FF8000', '#800000', '#FF0080', '#800040', '#8080FF', '#004080', '#008080', '#00FF00', '#804040', '#FF00FF', '#8080C0', '#0080C0', '#00FFFF', '#FFFF00', '#FF0000', '#FF80C0', '#0080FF', '#FFFF80', '#FF8080');
  

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
		'LABEL' => 'Modu³',
		'OPTIONS' => $mod_modules_manager->get_modules_for_form($Mparams),
		'VALUE' => $data['mod_id'],
	));
	
	unset($mod_modules_manager);
	
 $columns_list = $this->get_columns_for_form();
 

 
 if(is_array($columns_list) && wt_not_null($columns_list)) {
  $i = 0; 
  $column_colors = array();
  
 	foreach($columns_list as $id => $value) {
 	
 		$form->AddInput(array(
		'TYPE' => 'checkbox',
		'NAME' => 'col_id[' . $id . ']',
		'ID' => 'col_id_' . $id,
		'LABEL' => $value,
		'VALUE' => $color_data[$i],
		'CHECKED' => (array_key_exists($id, $data['col_id'])) ? 1 : null,
	));
	
	$column_colors[$id] = $color_data[$i];
 	$i++;
 	}
 	
 	$wt_template->assign('columns_list', $column_colors);
 
 } // if(is_array
  
  
  	
  	
	
	
	
	
	
 
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
		'TYPE' => 'hidden',
		'NAME' => 't',
		'ID' => 't',
		'VALUE' => 'columnPreview'
	));
	
	$form->AddInput(array(
		'TYPE' => 'hidden',
		'NAME' => 'tFile',
		'ID' => 'tFile',
		'VALUE' => 'popup_theme.tpl'
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
		$wt_template->fetch('columnPreview_form.tpl');
		$wt_template->SetTemplateDir();
		$wt_template->unregister_prefilter('smarty_prefilter_form');
		  
  $wt_template->assign('columnPreview_form', FormCaptureOutput($form, array('EndOfLine' => "\n")));
  

?>
