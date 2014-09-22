<?php 
		class mod_user_structure_plug {
			var $structure = array();	
			var $mod_structure = array();	
			
				function mod_user_structure_plug() {
						 			
 if( !wt_is_valid($this->mod_structure, 'array') ) {
$this->mod_structure[] = array('key' => 'all',
										 'name' => 'cały moduł');
$this->mod_structure[] = array('key' => 'mP',
										 'name' => 'strona główna modułu');
$this->mod_structure[] = array('key' => 'lP',
										 'name' => 'logowanie');
$this->mod_structure[] = array('key' => 'lOP',
										 'name' => 'wylogowanie');
$this->mod_structure[] = array('key' => 'nU',
										 'name' => 'rejestracja');
$this->mod_structure[] = array('key' => 'sRP',
										 'name' => 'podsumowanie rejestracji');
$this->mod_structure[] = array('key' => 'cRP',
										 'name' => 'potwierdzenie rejestracji');
$this->mod_structure[] = array('key' => 'rSACP',
										 'name' => 'ponowne wysłanie kodu aktywującego');
$this->mod_structure[] = array('key' => 'rSACSP',
										 'name' => 'podsumowanie wysłania kodu aktywującego');
$this->mod_structure[] = array('key' => 'eP',
										 'name' => 'strona błędu');
$this->mod_structure[] = array('key' => 'nPP',
										 'name' => 'brak uprawnień');
$this->mod_structure[] = array('key' => 'cP',
										 'name' => 'zmiana hasła');
$this->mod_structure[] = array('key' => 'dU',
										 'name' => 'usuwanie konta');
$this->mod_structure[] = array('key' => 'dUSP',
										 'name' => 'usuwanie konta - podsumowanie');
$this->mod_structure[] = array('key' => 'uLP',
										 'name' => 'Lista uzytkowników');
$this->mod_structure[] = array('key' => 'uIP',
										 'name' => 'Informacje o użytkowniku');

			 } 
			 
				}
			
		} //class
?>