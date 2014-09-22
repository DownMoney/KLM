<?php 
 $menu_data[] = array('name' => 'dodaj',
										   'href' => wt_href_link('mod_news_manager', '', 'm=topics&t=addTopic'),
											'action_form_large' => true,
											'awt' => 'Nowy temat',
											'ico' => 'add_folder'  );
				
				if( wt_is_valid($params['tID'], 'int', '0') ) {
				
					$menu_data[] = array('name' => 'edytuj',
										   'href' => wt_href_link('mod_news_manager', '', 'm=topics&t=addTopic&tID=' . $params['tID']),
											'action_form_large' => true,
											'awt' => 'Edycja tematu',
											'ico' => 'edit_folder'  );	
								 											
					$menu_data[] = array('name' => 'usuń',									   'href' => wt_href_link('mod_news_manager', '', 'm=topics&t=deleteTopic&tID=' . $params['tID']),
											'action_form' => true,
											'awt' => 'Usuwanie tematu',
											'ico' => 'del_folder'  );
											
					
					}
								 
	 
				$menu_data[] = array('sep' => true);
				$menu_data[] = array('name' => 'dodaj',
										   'href' => wt_href_link('mod_news_manager', '', 'm=news&t=addNews&tID=' . $params['nID']),
											'action_form_large' => true,
											'awt' => 'Nowy news',
											'ico' => 'add_content'  );
				  if( wt_is_valid($params['nID'], 'int', '0') ) {
					$menu_data[] = array('name' => 'edytuj',
										   'href' => wt_href_link('mod_news_manager', '', 'm=news&t=addNews&nID=' . $params['nID'] . '&tID=' . $params['tID']),
											'action_form_large' => true,
											'awt' => 'Edycja newsa',
											'ico' => 'edit_content'  );
													  	
					$menu_data[] = array('name' => 'usuń',										      'href' => wt_href_link('mod_news_manager', '', 'm=news&t=deleteNews&nID=' . $params['nID'] . '&tID=' . $params['tID']),
											'action_form' => true,
											'awt' => 'Usuwanie newsa',
											'ico' => 'del_content' );
			  /* 
	$menu_data[] = array('name' => 'deaktywuj',										      	   'href' => '',
											'action_form' => true,
											'awt' => 'Usuwanie podstrony',
											'ico' => 'unpublish' );
 */
					
				  }
				  $menu_data[] = array('sep' => true);
		  
	 
?>