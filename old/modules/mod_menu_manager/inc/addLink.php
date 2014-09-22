<?php 
  
  $mID = wt_set_task($_REQUEST, 'mID');
  
  if( wt_is_valid($_REQUEST['lID'], 'int', '0')  ) {
  $action = 'edit';
  $lID = wt_set_task($_REQUEST, 'lID');
  $wt_template->assign('db_link', $db_link = $this->get_links($lID) );
  } else {
  $action = 'add';
  }
  
  $db_link['access'] = wt_parse_access($db_link['access']);
  
  $sort_order = array();
  
  if($action == 'edit') {
  $sort_order[''] = 'nie rób nic';
  }
  
  $sort_order['-1000000'] = 'przesuń na początek';
  
  if($action == 'edit') {
  	
     $lParams = array();
     $lParams['where'] = " ml.link_parent_id = '" . (int)$db_link['link_parent_id'] . "' AND ml.menu_id = '" . (int)$mID . "' AND ";
     $links_data = $this->get_links(null, $lParams);
  		
  	  if( wt_is_valid($links_data, 'array') )	{
  	  		foreach($links_data as $link) {
  	  		   $sort = $link['sort_order']+0.5;
  	  			$sort_order["$sort"] = '&nbsp;&nbsp;&nbsp;&nbsp;Po: ' . $link['link_name'];
  	  		}
  	  }
  }
  
  $sort_order['1000000'] = 'przesuń na koniec';
  
  
  $wt_template->assign('action', $action);
  

$form = new form_class();
  
  $form->NAME = 'addLink';
  $form->METHOD = 'POST';
  $form->ACTION = wt_href_link('', '', wt_get_all_get_params(array('a', 't')));
  $form->ResubmitConfirmMessage = 'Jesteś pewien, że chcesz wysłać formularz ponownie ?';
  $form->debug = 'wt_print_array';
  
  $form->ENCTYPE = 'multipart/form-data';
  
  
  if(wt_check_permission('', 'new_activ', false)) {
  $form->AddInput(array(
		'TYPE' => 'checkbox',
		'NAME' => 'status',
		'ID' => 'status',
		'LABEL' => 'Publikuj',
		'ACCESSKEY' => 'P',
		'CHECKED' => ($action == 'add') ? 1 : $db_link['status'],
		'VALUE' => '1'
	));
	
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'date_up',
		'ID' => 'date_up',
		'LABEL' => 'Rozpoczęcie wyświetlania',
		'MAXLENGTH' => 11,
		'VALUE' => wt_parse_publish_date_desc($db_link['date_up'], 'up'),
		'CLASS' => 'text_area2',
	));
	
	
	$form->AddInput(array(
		'TYPE' => 'button',
		'NAME' => 'date_up_call',
		'ID' => 'date_up_call',
		'VALUE' => '>>',
		'CLASS' => 'button',
		'ONCLICK' => 'return showCalendar(\'date_up\', \'y-mm-dd\');'
	));
	
	$form->AddInput(array(
		'TYPE' => 'button',
		'NAME' => 'date_down_call',
		'ID' => 'date_down_call',
		'VALUE' => '>>',
		'CLASS' => 'button',
		'ONCLICK' => 'return showCalendar(\'date_down\', \'y-mm-dd\');'
	));

	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'date_down',
		'ID' => 'date_down',
		'LABEL' => 'Zakończenie wyświetlania',
		'ACCESSKEY' => 'Z',
		'MAXLENGTH' => 19,
		'VALUE' => wt_parse_publish_date_desc($db_link['date_down'], 'down'),
		'CLASS' => 'text_area2',
	));
  } else {
  
  $form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'status',
		'ID' => 'status',
		'LABEL' => 'Publikuj',
		'Accessible' => 0,
		'VALUE' => 'Nie masz uprawnien do opercji publikacji !',
	));
  
  }
  
  
   $form->AddInput(array(
		'TYPE' => 'select',
		'NAME' => 'link_parent_id',
		'ID' => 'link_parent_id',
		'LABEL' => 'Nadrzędna',
		'VALUE' => $db_link['link_parent_id'],
		'OPTIONS' => $links_tree = $this->get_links_tree_for_form($mID),
		'CLASS' => 'text_area4',
		'ONCHANGE' => "populate(document.addLink.link_parent_id, document.addLink.elements['sort_order'], sort_order_a);",
	));
	
 //	wt_print_array(  );
	if( wt_is_valid( $links_tree, 'array' ) )	{
	
  			$sort_order = array();
		foreach( $links_tree as $l_id => $l_name ) {
			$lParams = array();
			$lParams['where'] = " ml.menu_id = '" . (int)$mID . "' AND  ml.link_parent_id = '" . (int)$l_id . "' AND ";
			$links = $this->get_links(null, $lParams);
			
			if( $action == 'edit' && $l_id == $db_link['link_parent_id']  ) {
			$sort_order[$l_id][''] = ' --- nie zmieniaj --- '; 
			}
			
			$sort_order[$l_id][-1000] = 'Pierwszy';
			
			if( wt_is_valid( $links, 'array' ) ) {
				foreach( $links as $l ) {
					
					if( !wt_not_null($l['sort_order']) ) {
						$l['sort_order'] = 0;
					}
					$sort = $l['sort_order']+0.5;
  	  				$sort_order[$l_id]["$sort"] = '   Po: ' . $l['link_name'];
				}
					$sort_order[$l_id][10000] = 'Ostatni';
			
			}
			
		}
 }	
	
	$wt_template->assign('sort_order', $sort_order);
	
	
	
	$form->AddInput(array(
		'TYPE' => 'select',
		'NAME' => 'sort_order',
		'ID' => 'sort_order',
		'LABEL' => 'Kolejność',
		'VALUE' => '',
		'OPTIONS' => array(),
		'CLASS' => 'text_area4',
	));
	
	$link_types = array();
	$link_types[''] = ' === WYBIERZ === ';
	$link_types = $link_types+$this->links_type;
	
	$form->AddInput(array(
		'TYPE' => 'select',
		'NAME' => 'link_type',
		'ID' => 'link_type',
		'LABEL' => 'Typ',
		'VALUE' => $db_link['link_type'],
		'OPTIONS' => $link_types,
		'CLASS' => 'text_area2',
		'ONCHANGE' => 'updateAddLinkForm();'
	));
	
	
	$mod_modules_manager = wt_module::singleton('mod_modules_manager');	
	$Mparams = array();
	$Mparams['add_blank'] = true;
	$Mparams['add_type'] = true;
	$Mparams['use_keys'] = true;
	
	$form->AddInput(array(
		'TYPE' => 'select',
		'NAME' => 'link_module',
		'ID' => 'link_module',
		'LABEL' => 'Moduł',
		'VALUE' => $db_link['link_module'],
		'OPTIONS' => $mod_modules_manager->get_modules_for_form($Mparams),
		'CLASS' => 'text_area4',
		'ONCHANGE' => 'getModStructure();',
	));
 
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'link_link',
		'ID' => 'link_link',
		'LABEL' => 'Link',
	 	'CLASS' => 'text_area2',
		'VALUE' => $db_link['link_link'],
		'CLASS' => 'text_area4',
	));
	
	
	$link_module_link = array();
	
 if( $db_link['link_type'] == 'mod_link' ) {
	$plugin_class = wt_module_plugins::singleton($db_link['link_module'], 'structure');
		
	  if( is_object($plugin_class)) {
			$structure = $plugin_class->structure;
		}	
    		
			
     if( wt_is_valid($structure, 'array') ) {  
      	
      foreach( $structure as $s ) {
			$link_module_link[$s['url']] = $s['name'];
      }
      	
     }
 }
 
 	
	$form->AddInput(array(
		'TYPE' => 'select',
		'NAME' => 'link_module_link',
		'ID' => 'link_module_link',
		'LABEL' => 'Link wewnętrzny',
		'VALUE' => $db_link['link_link'],
		'SELECTED' => $db_link['link_link'],
		'OPTIONS' => $link_module_link,
		'CLASS' => 'text_area4',
		'ONCHANGE' => 'updateLinkLink();',
	));
	
	
	
	$form->AddInput(array(
		'TYPE' => 'file',
		'NAME' => 'link_image',
		'ID' => 'link_image',
		'LABEL' => 'Obraz',
	 	'CLASS' => 'text_area2',
	));
	
	$form->AddInput(array(	
		'TYPE' => 'hidden',
		'NAME' => 'previus_link_image',
		'ID' => 'previus_link_image',
		'VALUE' => $db_link['link_image'],
	));
	
  $form->AddInput(array(
		'TYPE' => 'checkbox',
		'NAME' => 'delete_link_image',
		'ID' => 'delete_link_image',
		'LABEL' => 'usuń bierzący obraz',
		'VALUE' => '1',
	));
	
	$form->AddInput(array(
		'TYPE' => 'file',
		'NAME' => 'link_image_over',
		'ID' => 'link_image_over',
		'LABEL' => 'Obraz (over)',
	 	'CLASS' => 'text_area2',
	));
	
	$form->AddInput(array(	
		'TYPE' => 'hidden',
		'NAME' => 'previus_link_image_over',
		'ID' => 'previus_link_image_over',
		'VALUE' => $db_link['link_image_over'],
	));
	
  $form->AddInput(array(
		'TYPE' => 'checkbox',
		'NAME' => 'delete_link_image_over',
		'ID' => 'delete_link_image_over',
		'LABEL' => 'usuń bierzący obraz',
		'VALUE' => '1',
	));
	
	$form->AddInput(array(
		'TYPE' => 'file',
		'NAME' => 'link_icon_left',
		'ID' => 'link_icon_left',
		'LABEL' => 'Obraz po lewej',
	 	'CLASS' => 'text_area2',
	));
	
	$form->AddInput(array(	
		'TYPE' => 'hidden',
		'NAME' => 'previus_link_icon_left',
		'ID' => 'previus_link_icon_left',
		'VALUE' => $db_link['link_icon_left'],
	));
	
  $form->AddInput(array(
		'TYPE' => 'checkbox',
		'NAME' => 'delete_link_icon_left',
		'ID' => 'delete_link_icon_left',
		'LABEL' => 'usuń bierzący obraz',
		'VALUE' => '1',
	));
	
	$form->AddInput(array(
		'TYPE' => 'file',
		'NAME' => 'link_icon_right',
		'ID' => 'link_icon_right',
		'LABEL' => 'Obraz po prawej',
	 	'CLASS' => 'text_area2',
	));
	
	$form->AddInput(array(	
		'TYPE' => 'hidden',
		'NAME' => 'previus_link_icon_right',
		'ID' => 'previus_link_icon_right',
		'VALUE' => $db_link['link_icon_right'],
	));
	
  $form->AddInput(array(
		'TYPE' => 'checkbox',
		'NAME' => 'delete_link_icon_right',
		'ID' => 'delete_link_icon_right',
		'LABEL' => 'usuń bierzący obraz',
		'VALUE' => '1',
	));
	
	$form->AddInput(array(
		'TYPE' => 'file',
		'NAME' => 'link_bg',
		'ID' => 'link_bg',
		'LABEL' => 'Tło',
	 	'CLASS' => 'text_area2',
	));
	
	$form->AddInput(array(	
		'TYPE' => 'hidden',
		'NAME' => 'previus_link_bg',
		'ID' => 'previus_link_bg',
		'VALUE' => $db_link['link_bg'],
	));
	
  $form->AddInput(array(
		'TYPE' => 'checkbox',
		'NAME' => 'delete_link_bg',
		'ID' => 'delete_link_bg',
		'LABEL' => 'usuń bierzący obraz',
		'VALUE' => '1',
	));
	
	$form->AddInput(array(
		'TYPE' => 'file',
		'NAME' => 'link_bgover',
		'ID' => 'link_bgover',
		'LABEL' => 'Tło (over)',
	 	'CLASS' => 'text_area2',
	));
	
	$form->AddInput(array(	
		'TYPE' => 'hidden',
		'NAME' => 'previus_link_bgover',
		'ID' => 'previus_link_bgover',
		'VALUE' => $db_link['link_bgover'],
	));
	
  $form->AddInput(array(
		'TYPE' => 'checkbox',
		'NAME' => 'delete_link_bgover',
		'ID' => 'delete_link_bgover',
		'LABEL' => 'usuń bierzący obraz',
		'VALUE' => '1',
	));
	
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'css_id',
		'ID' => 'css_id',
		'LABEL' => 'CSS ID',
	 	'CLASS' => 'text_area2',
		'VALUE' => $db_link['css_id']
	));
	
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'link_key_words',
		'ID' => 'link_key_words',
		'LABEL' => 'Słowa kluczowe',
	 	'CLASS' => 'text_area4',
		'VALUE' => $db_link['link_key_words']
	));
	
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'link_index_file',
		'ID' => 'link_index_file',
		'LABEL' => 'Plik indeksu',
	 	'CLASS' => 'text_area4',
		'VALUE' => $db_link['link_index_file']
	));
	
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'link_name',
		'ID' => 'link_name',
		'LABEL' => 'Nazwa',
	 	'CLASS' => 'text_area4',
		'VALUE' => $db_link['link_name']
	));
	
	$form->AddInput(array(
		'TYPE' => 'text',
		'NAME' => 'link_title',
		'ID' => 'link_title',
		'LABEL' => 'Tytuł ( title="" )',
	 	'CLASS' => 'text_area4',
		'VALUE' => $db_link['link_title']
	));
	
	
$form->AddInput(array(
		'TYPE' => 'select',
		'NAME' => 'access',
		'ID' => 'access',
		'VALUE' => '0',
		'SIZE' => 10,
		'SELECTED' => $db_link['access'],
	   'OPTIONS' => wt_prepare_user_group_array_to_form(),
		'MULTIPLE' => '1',
		'LABEL' => 'Dostęp',
	));
	
  	
  	$form->AddInput(array(
		'TYPE' => 'radio',
		'NAME' => 'action_save',
		'ID' => 'action_save',
		'VALUE' => 'save',
		'LABEL' => 'Zapisz',
		'CHECKED' => 1
	));
	
	$form->AddInput(array(
		'TYPE' => 'radio',
		'NAME' => 'action_after',
		'ID' => 'action_after_main',
		'VALUE' => 'main',
		'LABEL' => 'Powrót do listy',
		'CHECKED' => 1
	));
	
	$form->AddInput(array(
		'TYPE' => 'radio',
		'NAME' => 'action_after',
		'ID' => 'action_after_add_new',
		'VALUE' => 'add_new',
		'LABEL' => 'Dodaj nowy',
		'CHECKED' => 0
	));
   
   $form->AddInput(array(
		'TYPE' => 'radio',
		'NAME' => 'action_after',
		'ID' => 'action_after_edit',
		'VALUE' => 'edit',
		'LABEL' => 'Edycja bieżącego',
		'CHECKED' => 0
	));

	if($action == "edit") {
	
	$form->AddInput(array(
		'TYPE' => 'radio',
		'NAME' => 'action_save',
		'ID' => 'action_save_as_new',
		'VALUE' => 'save_as_new',
		'LABEL' => 'Dodanie jako nowego',
		'CHECKED' => 0
	));
	
	}

	$form->AddInput(array(
		'TYPE' => 'hidden',
		'NAME' => 'a',
		'ID' => 'action',
		'VALUE' => 'saveLink'
	));
	
	if($action == 'edit') {
	$form->AddInput(array(
		'TYPE' => 'hidden',
		'NAME' => 'lID',
		'ID' => 'lID',
		'VALUE' => $lID
	));
	}
	
	$form->AddInput(array(
		'TYPE' => 'hidden',
		'NAME' => 'menu_id',
		'ID' => 'menu_id',
		'VALUE' => $mID
	));
	
  $form->AddInput(array(
		'TYPE' => 'submit',
		'ID' => 'submit_button',
		'VALUE' => 'Zapisz >>',
		'CLASS' => 'button',	
	));
	
	$form->AddInput(array(
		'TYPE' => 'reset',
		'ID' => 'reset_button',
		'VALUE' => 'Wyczyść',
		'CLASS' => 'button',
	));
	
	$form->AddInput(array(
		'TYPE' => 'button',
		'ID' => 'cancel_button',
		'VALUE' => '<< Anuluj',
		'CLASS' => 'button',
		'ONCLICK' => 'document.location.href=(\'' . wt_href_link('', '', wt_get_all_get_params(array('t'))) . '\');',
	));

  

	
	   
	   $wt_template->assign_by_ref('form', $form);
		$wt_template->register_prefilter('smarty_prefilter_form');
		$wt_template->SetTemplateDir('modules' . DIRECTORY_SEPARATOR . $this->module_key . DIRECTORY_SEPARATOR);
		$wt_template->fetch('addLink_form.tpl');
		$wt_template->SetTemplateDir();
		$wt_template->unregister_prefilter('smarty_prefilter_form');
		
  $wt_template->assign('addLink_form', FormCaptureOutput($form, array('EndOfLine' => "\n")));
  		$wt_template->load_file('addLink');
       
?>
