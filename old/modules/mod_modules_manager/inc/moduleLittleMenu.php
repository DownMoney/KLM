<?php 
  
			$little_menu = array();
			
	
	 		$little_menu[] = array('title' => 'aktualizuj tabele', 
	 							        'image' => 'upload_f2.png',
	 							        'link' => wt_href_link('mod_modules_manager', '', 'a=updateDBTableInfo' ),
	 							        'onMouseOver' => "updateInfoBoxStatus('info', 'Aktualizuj tabele bazy danych', 'Kliknij aby aktualizowaæ informacjê o strukturze bazy danych.');",
	 							        'onMouseOut' => "updateInfoBoxStatus();");
	     
?>