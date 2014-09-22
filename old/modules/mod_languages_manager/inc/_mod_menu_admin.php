<?php 
global $wt_session;
	$menu_data[] = array('name' => 'dodaj',
						 'href' => wt_href_link('mod_languages_manager', '','m=texts&t=addText&mID='.$params['mod_id']),
						 'action_form_large' => true,
						 'awt' => 'Nowy wpis',
						 'ico' => 'add_content'  );
	$menu_data[] = array('name' => 'generuj',
						 'href' => wt_href_link('mod_languages_manager', '','a=generateAllFiles'),
						 //'action_form_large' => true,
						 'awt' => 'Nowy wpis',
						 'ico' => 'add_content',
						 'target' => 'mod_content'  );

?>