<?php 

$gID = wt_set_task($_REQUEST, 'gID');

  if( wt_is_valid($gID, 'int', '0') ) {
  $action = 'edit';
  } else {
  $action = 'add';
  }
  
  $wt_template->assign('action', $action);
	
  if($action == 'edit')	 {
    $db_group = $this->get_groups($gID);
    $wt_template->assign('group', $db_group);
  } 
  

  $form = new form_class();
  $form->NAME = 'addGroup';
  $form->ID = 'addGroup';	
  $form->METHOD = 'POST';
  $form->ACTION = wt_href_link('', '', wt_get_all_get_params(array('a', 'gID', 't', 'm')));
  $form->ResubmitConfirmMessage = 'Jesteś pewien, że chcesz wysłać formularz ponownie ?';
  $form->debug = 'wt_print_array';
  $form->TARGET = 'operation2';
  
 /* 
 $modules_permission = $this->get_groups_permission($gID, $action);
  
 
  
  foreach($modules_permission as $modules) {
  		
  			$add_this = array();
  			$add_this = array(
									'TYPE' => 'checkbox',
									'NAME' => 'mod_id[]',
									'ID' => 'mod_id_' . $modules['mod_id'],
									'VALUE' => $modules['mod_id'],
									'LABEL' => $modules['mod_name'],
									'CHECKED' => (isset($modules['mod_checked']) && $modules['mod_checked'] == '1') ? '1' : null,
									);
									
 if(isset($modules['mod_read_only']) && $modules['mod_read_only'] == '1') {
 		$add_this['ExtraAttributes'] = array('disabled' => 'disabled');
 	}
  		
  		$form->AddInput($add_this);
  		
  		if(is_array($modules['mod_perm_class']) && wt_not_null($modules['mod_perm_class'])) {
  		
  			foreach($modules['mod_perm_class'] as $mod_perm_class) {
  			
  			foreach($mod_perm_class['perm'] as $perm) {
  			
  		
  			$add_this2 = array();
  			$add_this2 = array(
									'TYPE' => 'checkbox',
									'NAME' => 'perm_id[]',
									'ID' => 'perm_id_' . $perm['perm_id'],
									'VALUE' => $perm['perm_id'],
									'LABEL' => $perm['perm_name'],
									'CHECKED' => (isset($perm['perm_checked']) && $perm['perm_checked'] == '1') ? '1' : null,
									);
									
 if(isset($perm['perm_read_only']) && $perm['perm_read_only'] == '1') {
 		$add_this2['ExtraAttributes'] = array('disabled' => 'disabled');
 	}
  		
  		$form->AddInput($add_this2);
  } // 	foreach($mod_perm_class['perm'] as $perm) {
  
  		
  		} //foreach($modules['mod_perm_class'] as $mod_perm_class) {
  		
  		} //if(is_array($modules['mod_perm_class']) && wt_not_null($modules['mod_perm_class'])) {
  
  } // foreach($modules_permission as $modules) {
  
  
  $wt_template->assign('modules_permission', $modules_permission);
  
 */
 	
		$form->AddInput(array(
		'TYPE' => 'hidden',
		'NAME' => 'parent_id',
		'ID' => 'parent_id',
		'VALUE' => $this->current_group_id(),
	));
 
   $form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'group_name',
		'ID' => 'group_name',
		'VALUE' => $db_group['group_name'],
		'LABEL' => 'Nazwa',
		'CLASS' => 't4'
	));
	
	$form->AddInput(array(
		'TYPE' => 'textarea',
		'NAME' => 'group_desc',
		'ID' => 'group_desc',
		'VALUE' => $db_group['group_desc'],
		'LABEL' => 'Komentarz',
		'CLASS' => 't3',
		'ROWS' => 7,
		'COLS' => 40,
	));
	
	$form->AddInput(array(
		'TYPE' => 'checkbox',
		'NAME' => 'group_default',
		'ID' => 'group_default',
		'VALUE' => '1',
		'LABEL' => 'Domyślna',
		'CHECKED' => $db_group['group_default']
	));
	
	    
	$form->AddInput(array(
		'TYPE' => 'hidden',
		'NAME' => 'a',
		'ID' => 'action',
		'VALUE' => 'saveGroup'
	));
	
	if($action == 'edit') {
	$form->AddInput(array(
		'TYPE' => 'hidden',
		'NAME' => 'gID',
		'ID' => 'gID',
		'VALUE' => $gID
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
  
	
	   
	   $wt_template->assign_by_ref('form', $form);
		$wt_template->register_prefilter('smarty_prefilter_form');
		$wt_template->SetTemplateDir('modules' . DIRECTORY_SEPARATOR . $this->module_key . DIRECTORY_SEPARATOR);
		$wt_template->fetch('addGroup_form.tpl');
		$wt_template->SetTemplateDir();
		$wt_template->unregister_prefilter('smarty_prefilter_form');
		  
  $wt_template->assign('addGroup_form', FormCaptureOutput($form, array('EndOfLine' => "\n")));
       

  
      
$wt_template->load_file('addGroup.tpl');
?>
