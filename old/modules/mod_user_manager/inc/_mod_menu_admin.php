<?php 
 $menu_data[] = array('name' => 'dodaj grupę',
										   'href' => wt_href_link('mod_user_manager', '', 'm=groups&t=addGroup&gPath=' . $params['gPath']),
											'action_form_large' => true,
											'awt' => 'Nowa grupa',
											'ico' => 'user_group_add'  );
				
				if( wt_is_valid($cgi, 'int', '2') ) {
				
					$menu_data[] = array('name' => 'edytuj grupę',
										   'href' => wt_href_link('mod_user_manager', '', 'm=groups&t=addGroup&gPath=' . $params['gPath'] . '&gID=' . $cgi),
											'action_form_large' => true,
											'awt' => 'Edycja grupy',
											'ico' => 'user_group_edit'  );	
											
					$menu_data[] = array('name' => 'usuń grupę',									   'href' => wt_href_link('mod_user_manager', '', 'm=groups&t=deleteGroup&gPath=' . $params['gPath'] . '&gID=' . $cgi),
											'action_form' => true,
											'awt' => 'Usuwanie grupy',
											'ico' => 'user_group_delete'  );
											
					
					}
								 
	 
				$menu_data[] = array('sep' => true);
				$menu_data[] = array('name' => 'dodaj użytkownika',
										   'href' => wt_href_link('mod_user_manager', '', 'm=users&t=addUser&gPath=' . $params['gPath']),
											'action_form_large' => true,
											'awt' => 'Nowy użytkownik',
											'ico' => 'user_add'  );
				$menu_data[] = array('sep' => true);	
										
				$menu_data[] = array('name' => 'eksportuj użytkowników',
										   'href' => wt_href_link('mod_user_manager', '', wt_get_all_get_params(array('m','t','a'), $params).'a=makeExportUsers'),
											'target' => 'mod_content',
											'awt' => 'Nowy użytkownik',
											'ico' => 'user_export'  );
		  
?>