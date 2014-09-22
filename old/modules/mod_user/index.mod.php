<?php 


     class mod_user {
         var $task;
   		var $action;
  		   var $mode;
   		var $module_dir;
   		var $module_class;
   		var $module_key;
   		var $db;
         var $zones_array = array(
         						 '' => 'wybierz',
         						 'dolnośląskie' => 'dolnośląskie',
   						       'kujawsko-pomorskie' => 'kujawsko-pomorskie',
   						       'lubelskie' => 'lubelskie',
   						       'lubuskie' => 'lubuskie',
   						       'łódzkie' => 'łódzkie',
   						       'mazowieckie' => 'mazowieckie',
   						       'małopolskie' => 'małopolskie',
   						       'opolskie' => 'opolskie',
   						       'podkarpackie' => 'podkarpackie',
   						       'podlaskie' => 'podlaskie',
   						       'pomorskie' => 'pomorskie',
   						       'śląskie' => 'śląskie',
   						       'świętokrzyskie' => 'świętokrzyskie',
   						       'warmińsko-mazurskie' => 'warmińsko-mazurskie',
   						       'wielkopolskie' => 'wielkopolskie',
   						       'zachodniopomorskie' => 'zachodniopomorskie',
         								 'nie dotyczy / obcokrajowiec' => 'nie dotyczy / obcokrajowiec',
         								 );
         								 
   var $usr_gender = array('' => 'wybierz',
   								'F' => 'kobieta',
   								'M' => 'mężczyzna');
         
   function mod_user() {
   	global $wt_module, $wt_sql;
   	 
		 
	 
		 
         $this->module_dir = dirname(__FILE__);
  			$this->module_class = get_class($this);
  			$this->module_key = basename($this->module_dir);
  			$this->module_params = $wt_module->get_module_params('mod_user');
  			$login_key = $this->get_user_login_type();
         $this->login_key = $login_key['tbl_key'];
         $this->login_name = $login_key['login_name'];
         
         
         if($this->module_params->get('db_us_this_db') == '1' && wt_not_null($this->module_params->get('db_host')) && wt_not_null($this->module_params->get('db_user')) && wt_not_null($this->module_params->get('db_database'))) { 
  		
  		$db_host = $this->module_params->get('db_host');
  		$db_user = $this->module_params->get('db_user');
  		$db_password = $this->module_params->get('db_password');
  		$db_database = $this->module_params->get('db_database');
  		$this->db_prefix = $this->module_params->get('db_prefix');
  		$db_silent_mode = $this->module_params->get('db_silent_mode');
  		$db_persistant = $this->module_params->get('db_persistant');
  		
  		$this->db = new wt_sql($db_host, $db_user, $db_password, $db_database, NULL, $db_silent_mode, $db_persistant);
  		
  		} else {
  		$this->db = &$wt_sql;
  		}	
     
   }
   
  function get_module_path() {
   return $this->module_dir;
   }
  
  function get_module_class() {
   return $this->module_class;
   } 
  
  function get_module_key() {
   return $this->module_key;
   }       
  
  function __construct() {

         $class_name = __CLASS__;
    	  	$this->$class_name();

    	  	}      
        
  function _init() {
     global $wt_user, $wt_module, $wt_session;   
  $this->task = wt_set_task($_REQUEST, 't');
  $this->action = wt_set_task($_REQUEST, 'a');
  $this->mode = wt_set_task($_REQUEST, 'm');
  
  
    
    $confirmed_actions = array('loginPage', 'lP', 'fastLoginPage', 'fLP', 'fastRegisterPage', 'fRP', 'logoutPage', 'newUser', 'nU', 'successRegistrationPage', 'makeLogin', 'makeLogout', 'confirmRegistrationPage', 'confirmRegistrationErrorPage', 'confirmRegistration', 'accountDisabledPage', 'notActiveAccountPage', 'reSendActiveCodePage', 'reSendActiveCodeSuccessPage', 'errorPage', 'noPermissionPage', 'nPP', 'deleteUserSuccessPage', 'saveFastRegistration', 'uLP', 'usersListPage', 'uIP', 'userInfoPage', 'rP', 'sRPP', 'saveUser');
    
    if(!$wt_user->is_user()) {
    if(in_array($this->task, $confirmed_actions) || in_array($this->action, $confirmed_actions)) {
    
    } else {    
    wt_redirect(wt_href_link('mod_user', '', 't=lP'));
    }
    
    }
     
         
       switch($this->action) {
             case 'makeLogin':
             $this->makeLogin();
             break;
             case 'makeLogout':
             $this->makeLogout();
             break;
             case 'confirmRegistration':
     			 $this->confirmRegistration();
     		    break;
				 case 'saveFastRegistration':
				 $this->saveFastRegistration();
				 break;
				 case 'saveUser':
				 $this->saveUser();
				 break;
				 case 'saveUserSettings':
				 $this->saveUserSettings();
				 break;
                    }
       
    if(!wt_not_null($this->action))  { 
       $wt_session->remove('__user_data',$user_array);
		 
  switch ($this->mode) {
  
    default:
    case 'user':
    	switch($this->task) {
     		default: 
     			$this->mainPage();
     		break;   
			case 'lP':
         case 'loginPage':
     		   $this->loginPage();
     		break; 
			case 'fLP':
         case 'fastLoginPage':
     		   $this->fastLoginPage();
     		break; 
			case 'fRP':
			case 'fastRegistrationPage':
				$this->fastRegistrationPage();
			break;
     		case 'logoutPage':
     		   $this->logoutPage();
     		break; 
     		case 'newUser':
			case 'nU':
     		   $this->newUser();
     		break;  
     		case 'successRegistrationPage':
     			$this->successRegistrationPage();
     		break; 		
     		case 'confirmRegistrationPage':
     			$this->confirmRegistrationPage();
     		break;
     		case 'confirmRegistrationErrorPage':
     			$this->confirmRegistrationErrorPage();
     		break;
     		case 'accountDisabledPage':
     			$this->accountDisabledPage();
     		break;
     		case 'notActiveAccountPage':
     			$this->notActiveAccountPage();
     		break;
     		case 'reSendActiveCodePage':
     			$this->reSendActiveCodePage();
     		break;
     		case 'reSendActiveCodeSuccessPage':
     			$this->reSendActiveCodeSuccessPage();
     		break;
     		case 'errorPage':
     			$this->errorPage();
     	   break;	
			case 'nPP':
     	   case 'noPermissionPage':
     	   	$this->noPermissionPage();
     	   break;
     	   case 'changePass':
			case 'cP':
     	   	$this->changePass();
     	   break;
     	   case 'deleteUser':
			case 'dU':
     	   	$this->deleteUser();
     	   break;
     	   case 'deleteUserSuccessPage':
     	   	$this->deleteUserSuccessPage();
     	   break;
			case 'uLP':
			case 'usersListPage':
				$this->usersListPage();
     		break;
			case 'uIP':
			case 'userInfoPage':
				$this->userInfoPage();
     		break;
			case 'rP':
			case 'recreatePassword':
				$this->recreatePassword();
     		break;
			case 'sRPP':
			case 'successRecreatePasswordPage':
				$this->successRecreatePasswordPage();
     		break;
			
			
    }
    break;
  }
     }
     
     
     $this->wt_navigationbar();
     
        }
		
	  function successRecreatePasswordPage() {
     		global $wt_template, $wt_session, $wt_session;
			
			
			if($wt_session->exists('admin_login')) {	 
	  		$wt_template->SetTemplateDir('modules'.DIRECTORY_SEPARATOR.'mod_user_manager'.DIRECTORY_SEPARATOR,'','mod_user_manager'); 		
		   $wt_template->display_self = true;
		  	echo $wt_template->fetch('successRecreatePasswordPage.tpl','','mod_user_manager');	
	  		die();	
	  		}
			
     		$wt_template->assign('email_sended', $wt_session->value('email_sended'));
			$wt_session->remove('email_sended');
     		$wt_template->load_file('successRecreatePasswordPage.tpl');
     }	
			
	  function recreateUserPassword() {	
     		global $wt_session, $wt_template;
     		
			$user_ident = wt_set_task($_REQUEST, 'user_ident');
			$wt_session->remove('user_data'); 
			
			if( wt_not_null($user_ident) ) {
			
	  		$user_ident = $this->db->db_prepare_input($user_ident);	
     		$params = array();
			
     			switch($this->login_key) {
     				case 'usr_login':
     					$params['where'] = " u.usr_login = '" . $user_ident . "' AND ";
     			   break;
     			   case 'usr_id':
     					$params['where'] = " u.usr_id = '" . $user_ident . "' AND ";
     			   break;
     			   default:
     			   	$params['where'] = " ui." . $this->login_key . " = '" . $user_ident . "' AND ";
     			   	break;
     			}
     			
     		  $_user_data = $this->get_users(null, $params);
			  $user_data = $_user_data[0];	
				
			  if( wt_is_valid($user_data['usr_email'], 'email') && wt_is_valid($user_data['usr_id'], 'int', '0') ) {
			  		$new_pass = wt_create_random_value(6);
					$new_pass_crypted = wt_encrypt_password($new_pass);
					
					$this->db->db_perform(TABLE_USERS, array('usr_pass' => $new_pass_crypted), 'update', " usr_id = '" . $user_data['usr_id'] . "' LIMIT 1");
					$user_data['new_pass'] = $new_pass;
					$wt_session->set('__user_data',$user_data);
					
		
	 	if($wt_session->exists('admin_login')) {		
		 	$wt_template->SetTemplateDir('mails'.DIRECTORY_SEPARATOR . 'mod_user_manager'.DIRECTORY_SEPARATOR, NULL, 'mod_user_manager');    		  	 
		 	$wt_template->assign('new_pass', $new_pass);
		   $message = $wt_template->fetch('recreate_password.tpl','','mod_user_manager');
		   $email = new email();
		   $email->add_html($message);
		   $email->build_message();   
		   $email->send($email_to_user, $user_data['usr_email'], SITE_NAME, CFGDB_EMAIL_FROM_ADDRESS, TEXT_MOD_USER_EMAIL_SUBJECT_NEWPASSWORD.' '.SITE_NAME);	
	    } else {
		 	$Sparams = array();
	    	$Sparams['action'] = 'user_recreate_password';
	    	$Sparams['usr_id'] = $user_data['usr_id'];
	    	$Sparams['news_pass'] = $new_pass;
	    	$this->send_system_message($Sparams);
		 	$wt_session->set('email_sended', $user_data['usr_email']);	
		 }
	 }		
		$wt_session->set('user_data', $Sparams); 
		wt_redirect(wt_href_link('mod_user', '', 't=sRPP'));
	 }
			
     }	
			
	  function recreatePassword() {
     		global $wt_template, $wt_session, $wt_module;
			
     		if($wt_session->exists('admin_login')) {		
     			$wt_template->assign('admin_login', true);
	 			$admin_login = true;	
     		}
			  
     		include_once($this->module_dir . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'recreatePassword.php'); 
     	
	  if($admin_login == true) {	 
	  		$wt_template->SetTemplateDir('modules'.DIRECTORY_SEPARATOR.'mod_user_manager'.DIRECTORY_SEPARATOR,'','mod_user_manager'); 		
		   $wt_template->display_self = true;
		  	echo $wt_template->fetch('recreatePassword.tpl','','mod_user_manager');	
	  		die();	
	  }
			
     $wt_template->load_file('recreatePassword.tpl');
     }
			
	  function userInfoPage() {	
		global $wt_template;
		
		if( wt_is_valid($uID = wt_set_task($_REQUEST, 'uID'), 'int', '0') ) {
     	$wt_template->assign('user_data', $this->get_users($uID));
	 //	wt_print_array( $this->get_users($uID) );
		}
		
     $wt_template->load_file('userInfoPage');
	  		
	  }			
			
	  function usersListPage() {
		global $wt_template;
		
     $wt_template->assign('users_listing', $users_listing = $this->get_users());
		
     $number_of_items_text = $this->users_split_listing->display_count($this->db_users_query_numrows, MAX_DISPLAY_ADMIN_SEARCH_RESULTS, $_GET['page'], 'Wyświetlono od <b>%s</b> do <b>%s</b> (z <b>%s</b> użytkowników)');
     $wt_template->assign('number_of_items_text', $number_of_items_text);
    
     $number_of_items_links = $this->users_split_listing->display_links($this->db_users_query_numrows, MAX_DISPLAY_ADMIN_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page']);
     
     $wt_template->assign('number_of_items_links', $number_of_items_links);
     $wt_template->assign('display_to_display',  $this->users_split_listing->display_to_display());
 	  
     $wt_template->load_file('usersListPage');
	  		
	  }		
        
     function deleteUser() {
     		global $wt_template, $wt_session;
     		
     		$wt_template->assign('nU_params', $this->module_params->get_array());
     		
     		include_once($this->module_dir . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'deleteUser.php'); 
     		
     $wt_template->load_file('deleteUser.tpl');
     	
     }   
     
     function delUser() {
     	global $wt_sql, $wt_user, $wt_session;
     	
     	   $Sparams = array();
    		$Sparams = array('action' => 'user_register');
         $Sparams = array('usr_id' => $wt_user->usr_info['usr_id']);
    
         
         $this->send_admin_message($Sparams);
     	
     	
     		$this->db->db_query("DELETE FROM " . TABLE_USERS . " WHERE usr_id = '" . (int)$wt_user->usr_info['usr_id'] . "' LIMIT 1;");
         $this->db->db_query("DELETE FROM " . TABLE_USERS_INFO . " WHERE usr_id = '" . (int)$wt_user->usr_info['usr_id'] . "' LIMIT 1;");
         $this->db->db_query("DELETE FROM " . TABLE_USERS_TO_GROUPS . " WHERE usr_id = '" . (int)$wt_user->usr_info['usr_id'] . "'");
         
         $wt_user->user_logout();
         
         $deleteSuccess = 1;
         $wt_session->set('deleteSuccess', $deleteSuccess);
         
         wt_redirect(wt_href_link('mod_user', '', 't=deleteUserSuccessPage'));
         
     }
     
     function deleteUserSuccessPage() {
     		global $wt_session, $wt_template;
     		
     		if($wt_session->exists('deleteSuccess') && $wt_session->value('deleteSuccess') == '1') {
     			$wt_session->remove('deleteSuccess');
     			$wt_template->load_file('deleteUserSuccessPage');
     			
     		} else {
     			wt_redirect(wt_href_link('mod_user'));
     		}
     
     }
        
     function saveChangePass($data = array()) {
     		global $wt_session, $wt_sql, $wt_user;
     		
       $outside_action = false;
       $pass_array = array();
       	
      if(is_array($data) && wt_not_null($data)) {
       $pass_array = $this->db->db_prepare_input($data);
       $outside_action = true;
       }	else {
       $pass_array = $this->db->db_prepare_input($_REQUEST);
       }
       
       
      $sql_pass_data_array = array();
      $sql_pass_data_array = array('usr_pass' => wt_encrypt_password($pass_array['new_password']),
      							        'last_modified' => 'now()',
      									  'modified_by' => 'Użytkownik, zmiana hasła' );
      
       
       	
         $this->db->db_perform(TABLE_USERS, $sql_pass_data_array, 'update', " usr_id = '" . $wt_user->usr_info['usr_id'] ."'");
  	      
  	      
    $successModifyMessage = '1';
    
    $wt_session->set('successModifyMessage', $successModifyMessage);
	 	 
    $wt_session->set('__user_data',$pass_array);
	 
    wt_redirect(wt_href_link('mod_user', '', 't=changePass', '', 'SSL'));
     		
     }
        
     function changePass() {
     global $wt_template, $wt_session;
     		
     		$wt_template->assign('nU_params', $this->module_params->get_array());
     	if($wt_session->exists('successModifyMessage') && $wt_session->exists('successModifyMessage') == '1') {	
     	   $wt_session->remove('successModifyMessage');
     		$wt_template->assign('successModifyMessage', '1');
     	 }	
     		
     		include_once($this->module_dir . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'changePass.php'); 
     		
     $wt_template->load_file('changePass.tpl');
     
          }   
        
     function noPermissionPage() {
     	global $wt_template;
     	$wt_template->load_file('noPermissionPage');
     }   
        
     function reSendActiveCodeSuccessPage() {
     			global $wt_template;     		
     		$wt_template->load_file('reSendActiveCodeSuccessPage');
     } 
     
     function errorPage() {
     			global $wt_template, $wt_session;
     		
     	if($wt_session->exists('eP_error_message'))  {
     	$wt_template->assign('eP_error_message', $wt_session->value('eP_error_message'));
     	$wt_session->remove('eP_error_message');
     	$wt_template->load_file('errorPage');
     	}	else {
     	wt_redirect('mod_user');
     	}
     		
     		
     }   
     
        
     
     function reSendActiveCode() {
     		global $wt_session;
     		
			$login = $_POST[$this->login_key];
			
     		$params = array();
     			switch($this->login_key) {
     				case 'usr_login':
     					$params['where'] = " u.usr_login = '" . $login . "' AND ";
     			   break;
     			   case 'usr_id':
     					$params['where'] = " u.usr_id = '" . $login . "' AND ";
     			   break;
     			   default:
     			   	$params['where'] = " ui." . $this->login_key . " = '" . $login . "' AND ";
     			   	break;
     			}
     			
     		  $user_data = $this->get_users(null, $params);
     		  
			  	
				
     		  if(wt_is_valid($user_data[0], 'array') && $user_data[0]['usr_id'] > 0) {
     		     $Sparams = array();
     		     $Sparams['action'] = 'user_register';
     		     $Sparams['usr_id'] = $user_data[0]['usr_id'];
     		  	  $this->send_system_message($Sparams);
     		  	  $email_send_error = $wt_session->value('email_send_error');
     		  } else {
     		   $email_send_error .= 'Wystąpił nieoczekiwany błąd <a href="' . wt_href_link('mod_contact') . '" title=" Kontakt ">skotaktuj się</a> z nami w celu wyjaśnienia tej sytuacji.';
     			
     		  }
     		  
     		  if($email_send_error) {
     		   $wt_session->set('eP_error_message', $email_send_error);
     		  	wt_redirect( wt_href_link('mod_user', '', 't=errorPage') );
     		  }
     		  
				
     		wt_redirect(wt_href_link('mod_user', '', 't=reSendActiveCodeSuccessPage'));
     
     }
        
     function check_login($login) {
     		global $wt_sql, $wt_user;
     					
     		$login = $this->db->db_prepare_input($login);
     		$params = array();
			
     			switch($this->login_key) {
     				case 'usr_login':
     					$params['where'] = " u.usr_login = '" . $login . "' AND ";
     			   break;
     			   case 'usr_id':
     					$params['where'] = " u.usr_id = '" . $login . "' AND ";
     			   break;
					case 'usr_company_vat_id':
     					$params['where'] = " REPLACE(ui.usr_company_vat_id, '-', '') = '".trim(preg_replace("/[^0-9]/",'',$login))."' AND ";
     			   break;
     			   default:
     			   	$params['where'] = " ui." . $this->login_key . " = '" . $login . "' AND ";
     			   	break;
     			}
			       			
     		  $_user_data = $this->get_users(null, $params);
			  $user_data = $_user_data[0];
				  
     		  if($wt_user->is_user()) {	
				
				if(wt_is_valid($user_data['usr_id'], 'int', '0') && $wt_user->usr_info['usr_id'] != $user_data['usr_id']) {
				return false;
				}
				
     			return true;
     		
     			    		
     		} else {
     		
						
     		if(wt_is_valid($user_data['usr_id'], 'int', '0')) {
     			return false;
     		} else {
     			return true;
     		}
     		
     		}
			
			
     		return false;
			
     }   
        
     function reSendActiveCodePage() {
     		global $wt_template;
     		
     		$wt_template->assign('resacP_params', $this->module_params->get_array());
     		include_once($this->module_dir . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'reSendActiveCode.php'); 
     		
     $wt_template->load_file('reSendActiveCodePage');
     
     }   
        
     function accountDisabledPage() {
     		global $wt_template;
     		
     		$wt_template->load_file('accountDisabledPage');
     }  
     
     function notActiveAccountPage() {
     		global $wt_template;
     		
     		$wt_template->assign('naaP_register_type', $this->module_params->get('register_type'));
     		
     		
     		
     		$wt_template->load_file('notActiveAccountPage');
     }   
        
        
     function get_user_login_type() {
        $login_type = array();
     		switch($this->module_params->get('use_as_login')) {
     			case 'usr_login':
     				$login_type = array('tbl_key' => 'usr_login',
     										  'login_name' => 'Login');
     			break;
     		   case 'usr_nick':
     				$login_type = array('tbl_key' => 'usr_nick',
     										  'login_name' => 'Nick');
     			break;
				default:
     			case 'usr_email':
     				$login_type = array('tbl_key' => 'usr_email',
     										  'login_name' => 'E-mail');
     			break;
     			case 'usr_id':
     				$login_type = array('tbl_key' => 'usr_id',
     										  'login_name' => 'Numer użytkownika');
     			break;
				case 'usr_company_vat_id':
     				$login_type = array('tbl_key' => 'usr_company_vat_id',
     										  'login_name' => 'NIP');
     			break;
     		}
     		
     		return $login_type;
     }   
     
     function activate_user($usr_id) {
     		global $wt_sql;
     		
     		$this->db->db_query("UPDATE " . TABLE_USERS . " set status = '1' WHERE usr_id = '" . $usr_id . "'");
     		
     		$Aparams = array();
     		$Aparams['usr_id'] = $usr_id;
     		$Aparams['action'] = 'user_activ';
     		$this->send_system_message($Aparams);
     		$this->send_admin_message($Aparams);
     	  
     }
     
     function successRegistrationPage() {
      	global $wt_session, $wt_template;
      	
     		if($wt_session->exists('uSP_message') && $wt_session->exists('successRegistration')) {
     	
     		   $wt_template->assign('uSP_message', $wt_session->value('uSP_message'));
     		   
     		   if($wt_session->exists('email_send_error')) {
     		   $wt_template->assign('uSP_email_send_error', $wt_session->value('email_send_error'));
     		   }
     		   
				$wt_session->remove('user_data');  
     		   $wt_session->remove('email_send_error');   		   
     		   $wt_session->remove('uSP_message');
     		   $wt_session->remove('successRegistration');
     		   
     		   $wt_template->load_file('successRegistrationPage');
     		   return;
     		}  	
     			
     		wt_redirect(wt_href_link('mod_user'));
     		  
     }
     
     function confirmRegistrationErrorPage() {
     		global $wt_session, $wt_template;
     		
     		if($wt_session->exists('error_title') && $wt_session->exists('error_message')  ) {
     		   
     		   $wt_template->assign('error_title', $wt_session->value('error_title'));
     		   $wt_template->assign('error_message', $wt_session->value('error_message'));
     		   
     		   $wt_session->remove('error_title');
     		   $wt_session->remove('error_message');
     		   
     		   $wt_template->load_file('confirmRegistrationErrorPage');
     		   return;
     		}  		
     		wt_redirect(wt_href_link('mod_user'));
     }
	  
	   function confirmRegistrationPage() {		
			global $wt_sql, $wt_session, $wt_template;			
			
			$wt_template->load_file('confirmRegistrationPage');
		}
		
     
     function confirmRegistration() {
     		global $wt_sql, $wt_session, $wt_template;
     		$confirm_data = $this->db->db_prepare_input($_GET);
     		
     		$error = 0;
     		
     		if(isset($confirm_data['uID']) && (int)$confirm_data['uID'] > 0 && isset($confirm_data['confirmCode']) && wt_not_null($confirm_data['confirmCode'])) {
     		
     			$user_data = $this->get_users($confirm_data['uID']);
     			
				
				
     			if(wt_is_valid($user_data, 'array')) {
     			
     				if($user_data['status'] == '0') {
     					$error = 2; // account blocked
     				} else if($user_data['status'] == '1') {
     				   $error = 3; // account active
     				} else if($user_data['status'] == '2') { 
     				   
     				   	if(wt_validate_password($user_data['usr_id'] . '-' . $user_data['usr_email'], $confirm_data['confirmCode'])) {
     				   		$this->activate_user($user_data['usr_id']);
     				   	} else {
     				   		$error = 4; // wrong activate code
     				   	}
     				   
     				} else {
     					$error = 1; // this nver happen unknown error
     				}
     			     			
     			} else {
     			$error = 1;
     			}
     		
     		}
     		
     		$error_title = '';
     		$error_message = '';
     	  			
     		switch($error) {
     			case '1':
     			   $error_title = 'Niespodziewany błąd !!!';
     				$error_message = 'Nie można aktywować konta. <br><a href="' . wt_href_link('mod_contact') . '">Skontaktuj się</a>  z nami w celu wyjaśnienia tego zdarzenia.';
     			break;	
     			case '2':
     			   $error_title = 'To konto zostało zablokowane !!!';
     				$error_message = 'To konto zostało zablokowane. Nie możesz go aktywować. Jeżeli nie znasz powodu zablokowania konta skontaktuj się z nami.';
     			break;
     			case '3':
     			   $error_title = 'Konto jest już aktywne.';
     				$error_message = 'To konto zostało już aktywowane. Nie ma potrzeby go aktywować. Możesz zalogować się na konto klikając <a href="' . wt_href_link('mod_user', '', 't=loginPage') . '">tutaj</a>.<br>Jeżeli masz problemy z logowaniem lub zapomniałeś hasła zajrzyj do pomocy lub skorzystaj z opcji odzyskiwania hasła.';
     			break;
     			case '4':
     			   $error_title = 'Niepoprawny kod aktywacyjny.';
     				$error_message = 'W twoim linku znajduje się nie poprawny kod aktywacyjny. Upewnij się, że jest to poprawny link jeżeli tak skotaktuj się z nami w celu wyjąsnienia tej sytuacji.';
     			break;
     		}
			
     		if( wt_is_valid($error, 'int', '0') ) {
     		$wt_session->set('error_title', $error_title);
     		$wt_session->set('error_message', $error_message);
     		wt_redirect(wt_href_link('mod_user', '', 't=confirmRegistrationErrorPage'));
     		} 
			
			wt_redirect(wt_href_link('mod_user', '', 't=confirmRegistrationPage'));
			
     }
		
		
	  function saveFastRegistration() {
	  		global $wt_template,$wt_user;
			
			$d = $_REQUEST;
			
			if($this->check_login($d[$this->login_key])) {
					if( wt_is_valid($this->saveUser($d), 'int', '0') ) {
						$wt_template->assign('state', '1');
						$wt_user->user_login($d[$this->login_key], $d['usr_password']);
					} else {
						$wt_template->assign('state', '2');
					}
			} else {
				$wt_template->assign('state', '3');
			}
			
			
			$wt_template->display_self = true;
			$wt_template->load_file('saveFastRegistration');
	  }	
     
     function saveUser($data = array()) {
     		global $wt_sql, $wt_user, $wt_session;
       
       $outside_action = false;
       $successRegistration = 0;
       	
      if( wt_is_valid( $data, 'array' ) ) {
       $user_array = $data;
		 unset($data);
       $outside_action = true;
       }	else {
       $user_array = $_POST;
       }
		 
       $user_array = $this->db->db_prepare_input(wt_string_user_safe_array($user_array));
      
       
       if( $wt_user->is_user() && wt_is_valid($wt_user->usr_info['usr_id'], 'int', '0') ) {
          $usr_id = $wt_user->usr_info['usr_id'];
          $action = 'save';
       } else {
       $action = 'add';
       }
       
         $sql_user_data_array = array();
      $sql_user_data_array = array('usr_login' => $user_array['usr_login'],
											  'language_id' => $wt_session->value('languages_id'));
		
      if(wt_not_null($user_array['usr_password'])) {
			$sql_user_data_array['usr_pass'] = wt_encrypt_password($user_array['usr_password']);
		}
		
       if($action == 'add') {
		   
       	$sql_user_data_array['date_added'] = 'now()';
       	$sql_user_data_array['added_by'] = '0';
       	
       	if($this->module_params->get('register_type') == 'no_confirm') {
       	$sql_user_data_array['status'] = '1';
       	} else {
       	$sql_user_data_array['status'] = '0';
       	}
       	
         $this->db->db_perform(TABLE_USERS, $sql_user_data_array);
  	      $usr_id = $this->db->db_insert_id();
			wt_core_log::saveLog(array('ms_type' => 'user_add', 'ms_title' => 'Rejestracja nowego użytkownika', 'mod_id' => $this->module_key, 'mod_task' => 'nU', 'mod_task_id' => $usr_id, 'usr_id' => $usr_id));
       } //$action == 'add'
       
       if($action == 'save') {
       	$sql_user_data_array['last_modified'] = 'now()';
  			$sql_user_data_array['modified_by'] = $wt_user->usr_info['usr_login'];
  			$this->db->db_perform(TABLE_USERS, $sql_user_data_array, 'update', 'usr_id = ' . $usr_id);
  			wt_core_log::saveLog(array('ms_type' => 'user_edit', 'ms_title' => 'Zmieniono dane użytkownika', 'mod_id' => $this->module_key, 'mod_task' => 'nU', 'mod_task_id' => $usr_id));
       } //$action == 'save'
       
       unset($sql_user_data_array);
        
$sql_user_info_data_array = array('usr_gender' => $user_array['usr_gender'],
								          'usr_dob' => $user_array['_usr_dob_year'] . '-' . $user_array['_usr_dob_month'] . '-' . $user_array['_usr_dob_day'],
								          'usr_first_name' => $user_array['usr_first_name'],
								          'usr_second_name' => $user_array['usr_second_name'],
								          'usr_last_name' => $user_array['usr_last_name'],
								          'usr_nick' => $user_array['usr_nick'],
								          'usr_company' => $user_array['usr_company'],
								          'usr_company_vat_id' => $user_array['usr_company_vat_id'],
								          'usr_company_address' => $user_array['usr_company_address'],
								          'usr_company_post_code' => $user_array['usr_company_post_code'],
								          'usr_company_city' => $user_array['usr_company_city'],
								          'usr_company_state' => $user_array['usr_company_state'],
								          'usr_company_email' => $user_array['usr_company_email'],
								          'usr_company_www' => $user_array['usr_company_www'],
								          'usr_company_phone' => $user_array['usr_company_phone'],
								          'usr_company_fax' => $user_array['usr_company_fax'],
								          'usr_address' => $user_array['usr_address'],
								          'usr_suburb' => $user_array['usr_suburb'],
								          'usr_city' => $user_array['usr_city'],
								          'usr_post_code' => $user_array['usr_post_code'],
								          'usr_state' => $user_array['usr_state'],
								          'usr_country_id' => $user_array['usr_country_id'],
								          'usr_zone_id' => $user_array['usr_zone_id'],
								          'usr_email' => $user_array['usr_email'],
								          'usr_phone' => $user_array['usr_phone'],
								          'usr_fax' => $user_array['usr_fax'],
								          'usr_mobile' => $user_array['usr_mobile'],
								          'usr_www' => $user_array['usr_www'],
								          'usr_gg' => $user_array['usr_gg'],
								          'usr_tlen' => $user_array['usr_tlen'],
								          'usr_icq' => $user_array['usr_icq'],
								          'usr_skype' => $user_array['usr_skype'],
								          'usr_other_contact' => $user_array['usr_other_contact'],
								          'usr_params' => wt_parse_params_for_db($user_array['params']),
										  ); 			
			
			
		  $upload_dir = 'mod_user' . DIRECTORY_SEPARATOR;	
		if(!is_dir(CFGF_DIR_FS_MEDIA . $upload_dir)) {
			wt_create_dir_structure(CFGF_DIR_FS_MEDIA . $upload_dir);
			$create_file = @fopen(CFGF_DIR_FS_MEDIA . $upload_dir . DIRECTORY_SEPARATOR . 'index.html', 'w');
			@fclose($create_file);
		}
	  				  
			if($action == 'add') {
  	       $sql_user_info_data_array['usr_id'] = $usr_id;
  	       $this->db->db_perform(TABLE_USERS_INFO, $sql_user_info_data_array);
			 
			if($this->module_params->get('register_type') == 'no_confirm') {
			 $wt_user->user_login($user_array[$this->login_key], $user_array['usr_password']);
			 }
			 
  	        }	//$action == 'add'
  	
  
	
  	if($action == 'save') {
  	  	$this->db->db_perform(TABLE_USERS_INFO, $sql_user_info_data_array, 'update', 'usr_id = ' . $usr_id);
	  
  	  	$wt_session->remove('usr_info');
  	  	$wt_session->remove('usr_id');
  	  	$wt_session->remove('usr_pass');
  	  	$wt_session->remove('usr_group');
  	  	$wt_session->remove('usr_permission');
  	  	
		if( wt_is_valid($user_array['delete_usr_image'], 'int', '0') && wt_not_null($user_array['previus_usr_image'])) {
		
				@unlink(CFGF_DIR_FS_MEDIA . $upload_dir . $user_array['previus_usr_image']);
			
			$this->db->db_perform(TABLE_USERS_INFO, array('usr_image' => ''), 'update', " usr_id = '" . (int)$usr_id . "' LIMIT 1 ");
		}
  	  	global $wt_user;  	  	
  	  	$wt_user->user_login($user_array[$this->login_key],null,array('ignore_password' => true));  	  	
  	}	
	
	$sql_image_data_array = array();
	$lP = array();
	$lP['dir'] = $upload_dir;
	$lP['file_name'] = $usr_id . '_image';
	$lP['file'] = 'usr_image';
	if( $usr_image_name = move_uploaded_media_file($lP) ) {
			$wt_sql->db_perform(TABLE_USERS_INFO, array('usr_image' => $usr_image_name), 'update', " usr_id = '" . (int)$usr_id . "' LIMIT 1 ");		
	}
	
	
  	
  		unset($sql_user_info_data_array);
      
      if($action == 'add') {
  	       $sql_user_to_groups_data_array = array('usr_id' => $usr_id,
  	       												    'group_id' => ((wt_is_valid($user_array['group_id'], 'int', 0) && $user_array['group_id'] != 1) ? $user_array['group_id'] : $this->get_default_group()),
  	       												    'date_added' => 'now()',
  	       												    'added_by' => 'Rejestracja');
  	       
  	   $this->db->db_perform(TABLE_USERS_TO_GROUPS, $sql_user_to_groups_data_array);
  	   }	//$action == 'add'
  	
  wt_plugins::run_action($this->module_key, 'saveUser', $action, $usr_id);	
	
  if($outside_action) {
  		return $usr_id;
  } else {   
  
  if($action == 'add') {
  
  	$uSP_message = '';
   
   
  			switch($this->module_params->get('register_type')) {
  				case 'usr_confirm':
  				 	$uSP_message = 'Na Twój adres e-mail: ' . $user_array['usr_email'] . ' została właśnie wysłana wiadomość z instrukacjami dotyczącymi aktywacji konta i zakończenia procesu rejestracji. Zajżyj na swoją skrzynkę aby aktywować konto i móc już w pełni z niego korzystać.';
  				break;
  				
  				case 'admin_confirm':
  				 	$uSP_message = 'Aby móc w pełni korzystać z konta musisz poczekać na jego aktywacje przez naszą redakcję. Gdy tylko aktywujemy Ci konto wyślemy do Ciebie wiadomość.';
  				break; 
  				
            case 'no_confirm':
            
            	$login_type = '';
    switch($this->module_params->get('use_as_login')) {
    	case 'usr_id';
    		$login_type = '<b><u>Numeru użytkownika:</u></b> ' . $user_data['usr_id'];
      break;
    	case 'usr_login';
    		$login_type = '<b><u>Loginu:</u></b> ' . $user_data['usr_login'];
      break;
      case 'usr_nick';
    		$login_type = '<b><u>Nicka:</u></b> ' . $user_data['usr_nick'];
      break;
      case 'usr_email';
    		$login_type = '<b><u>Adresu e-mail:</u></b> ' . $user_data['usr_email'];
      break;
    }
            
  				 	$uSP_message = 'Twoje konto zostało pomyślnie zarejestrowane.<br><br>'; 
  				   $uSP_message	.= 'Od tej pory twoje konto jest już aktywne.<br><br>
Możesz się na nie zalogować używając:<br>
' . $login_type . '<br>
i hasła jakie ustaliłeś podczas procesu rejestracji.<br>';
	            $uSP_message	.= '<br>
<br>
<b>Aby się zalogować na konto kliknij na poniższy link:</b><br>
<a href="' . wt_href_link('mod_user', '', 't=loginPage') . '">' . wt_href_link('mod_user', '', 't=loginPage') .'</a>';
  				break;		
  			}
  			
    $Sparams = array();
    $Sparams['action'] = 'user_register';
    $Sparams['usr_id'] = $usr_id;
    
    $this->send_system_message($Sparams);
    $this->send_admin_message($Sparams);
    
	 
	 global $wt_navigation;
	 
	
	/*
 if( wt_is_valid( $wt_navigation->snapshot, 'array' ) && $this->module_params->get('register_type') == 'no_confirm' ) {
	 
	    $wt_navigation->remove_current_page();
       $snapshot = $wt_navigation->snapshot;
   	 $wt_navigation->clear_snapshot();
       $snapshot['get']['from'] = 'login';
		 $mod = $snapshot['get']['mod'];
		 unset($snapshot['get']['mod']);
       wt_redirect( wt_href_link($mod, '', wt_http_build_query($snapshot['get']), '', $snapshot['mode'], false, false, array('full_url' => true)) );
	 }
*/
    
    $successRegistration = 1;
    $wt_session->set('uSP_message', $uSP_message);
    $wt_session->set('successRegistration', $successRegistration);
  		
	 $user_array['usr_id'] = $usr_id;
	 $wt_session->set('__user_data',$user_array);   
	 
       	wt_redirect(wt_href_link('mod_user', '', 't=successRegistrationPage'));
  } else {
  		
	 $user_array['usr_id'] = $usr_id;
	 $wt_session->set('__user_data',$user_array);  
	 
  	 $Sparams = array();
    $Sparams = array('action' => 'modify_user');
    $Sparams = array('usr_id' => $usr_id);
    $this->send_admin_message($Sparams);
    
    $successModifyMessage = '1';
    
    $wt_session->set('successModifyMessage', $successModifyMessage);
    
    wt_redirect(wt_href_link('mod_user', '', 't=newUser', '', 'SSL'));
    
  }  // if($action == 'add') {
   
   } //   if($outside_action) { return $usr_id; } else {  
    
     } // function
     
     
     
     function send_admin_message($params) {
     		global $wt_template;
     		
     		   $user_data = $this->get_users($params['usr_id']);
     			$wt_template->assign('user_data', $user_data);
     			
     			$email_from = $this->module_params->get('email_from');
     			$email_from_email = $this->module_params->get('email_from_email');
     			
            $wt_template->SetTemplateDir('mails' . DIRECTORY_SEPARATOR . 'mod_user' . DIRECTORY_SEPARATOR, NULL, $this->mod_key);
     			$admin_email_header = $wt_template->fetch('admin.mail_header.tpl','',$this->module_key);
     			$admin_email_footer = $wt_template->fetch('admin.mail_footer.tpl','',$this->module_key);
     			$user_data_email_body = $wt_template->fetch('user.user_data.tpl','',$this->module_key);
     		   
    			$message  = $admin_email_header;
    		
    		$system_message = '';
    		
    switch($params['action']) {
    	case 'user_register':
    		   $email_subject = 'Zarejestrowano nowego użytkownika';
    		   
    			$system_message .= 'Utworzono nowe konto na <a href="'.wt_href_link('home','','','','NONSSL',false,false,array('full_url' => true)).'" target="_blank">'.wt_href_link('home','','','','NONSSL',false,false,array('full_url' => true)).'</a>';
    			$system_message .= '<br><br />';
				
    			
    			switch($this->module_params->get('register_type')) {
    				case 'usr_confirm':
    					$system_message .= 'Konto czeka na aktywację przez użytkownika. (Link aktywacyjny w e-mailu do użytkownika).';
    				break;
    				case 'admin_confirm':
    					$system_message .= 'Konto czeka na aktywację przez administratora. <br /><a href="'.wt_href_link('mod_admin_manager','','','','NONSSL',false,false,array('full_url' => true)).'" target="_blank">Zaloguj się</a> do panelu administracyjnego aby aktywować konto.';
    				break;	
    				case 'no_confirm':
    					$system_message .= 'Konto zostało automatycznie aktywowane i jest gotowe do użytkowania.';
    				break;
    			}	
    	break;
    	case 'modify_user':
    		$email_subject = 'Zmieniono dane istniejącego użytkownika';
    		$system_message .= 'Konto użytkownika nr: <b>' . $user_data['usr_id'] . '</b> zostało zmienione.';
    	break;
    	case 'delete_user':
    		$email_subject = 'Usunięto użytkownika';
    		$system_message .= 'Konto użytkownika nr: <b>' . $user_data['usr_id'] . '</b> zostało usunięte.';
    	break;
    	case 'user_activ':
    		$email_subject = 'Aktywowano użytkownika';
    		$system_message .= 'Konto użytkownika nr: <b>' . $user_data['usr_id'] . '</b> zostało aktywowane i jest gotowe do użycia.';
    	break;
    }
    
    
    $message .= $system_message;
    $message .= '<br><br>';
    $message .= 'Poniżej znajdują się dane konta:';
    $message .= '<br>';
    $message .= $user_data_email_body;
    $message .= $admin_email_footer;
        
    $email = new email(array('X-Mailer: WT mail - builder'));
    $email->add_html($message);
    $email->build_message();
    
    $send_to_emails = array();
    
    if($this->module_params->get('inform_user_registartion') && $params['action'] == 'user_register' && wt_not_null($this->module_params->get('inform_user_registartion_emails')) ) {
    
    $send_to_emails = explode(';', $this->module_params->get('inform_user_registartion_emails'));
    
    if(is_array($send_to_emails) && wt_not_null($send_to_emails)) {
    		
    		foreach($send_to_emails as $email_address) {
    			$email->send('Administrator', $email_address, SITE_NAME.' :: system', CFGDB_EMAIL_FROM_ADDRESS, $email_subject);
    		}
    }
    
    } else if($this->module_params->get('inform_user_modify') && $params['action'] == 'modify_user' && wt_not_null($this->module_params->get('inform_user_modify_emails')) ) {
    
    $send_to_emails = explode(';', $this->module_params->get('inform_user_modify_emails'));
    
    if(is_array($send_to_emails) && wt_not_null($send_to_emails)) {
    		
    		foreach($send_to_emails as $email_address) {
    			$email->send('Administrator', $email_address, SITE_NAME.' :: system', CFGDB_EMAIL_FROM_ADDRESS, $email_subject);
    		}
    }
    
    } else if($this->module_params->get('inform_user_delete') && $params['action'] == 'delete_user' && wt_not_null($this->module_params->get('inform_user_modify_emails')) ) {
    
    $send_to_emails = explode(';', $this->module_params->get('inform_user_delete_emails'));
    
    if(is_array($send_to_emails) && wt_not_null($send_to_emails)) {
    		
    		foreach($send_to_emails as $email_address) {
    			$email->send('Administrator', $email_address, SITE_NAME.' :: system', CFGDB_EMAIL_FROM_ADDRESS, $email_subject);
    		}
    }
    
    }
    $wt_template->SetTemplateDir();
    
     }
     
     function send_system_message($params) {
     		global $wt_template, $wt_session;
     		
     		$error = 0;
     		
	  //		wt_print_array( $params );
			
     		if(isset($params['action'])) {
     		
     			$user_data = $this->get_users($params['usr_id']);
     			$wt_template->assign('user_data', $user_data);
     			
     			$email_from = $this->module_params->get('email_from');
     			$email_from_email = $this->module_params->get('email_from_email');
     			
     if(isset($user_data['usr_first_name']) && wt_not_null($user_data['usr_first_name']) && isset($user_data['usr_last_name']) && wt_not_null($user_data['usr_last_name']) ) {
     
    $email_to_user = $user_data['usr_first_name'] . ' ' . $user_data['usr_last_name'];
    
    } else if(isset($user_data['usr_nick']) && wt_not_null($user_data['usr_nick'])) {
    
    $email_to_user = $user_data['usr_nick'];
    
    } else if(isset($user_data['usr_login']) && wt_not_null($user_data['usr_login'])) {
    
    $email_to_user = $user_data['usr_login'];
    
    }
     			
     			$wt_template->SetTemplateDir('mails' . DIRECTORY_SEPARATOR . 'mod_user' . DIRECTORY_SEPARATOR, NULL, 'mod_user');
     			$user_email_header = $wt_template->fetch('user.mail_header.tpl','',$this->module_key);
     			$user_email_footer = $wt_template->fetch('user.mail_footer.tpl','',$this->module_key);
     
		
	  if($params['action'] == 'user_recreate_password') {
		
	 $wt_template->assign('new_pass', $params['news_pass']);
	 $email_subject = TEXT_MOD_USER_EMAIL_SUBJECT_NEWPASSWORD.' '.SITE_NAME;
    $message  = $user_email_header;
    $message .= $wt_template->fetch('user.usr_recreate_password.tpl','',$this->module_key);
    $message .= $user_email_footer;
    
    $email = new email();
    $email->add_html($message);
    $email->build_message();
    
    
    if(!$email->send($email_to_user, $user_data['usr_email'], SITE_NAME, CFGDB_EMAIL_FROM_ADDRESS, $email_subject)) {
    		$error = 1; // email send error
    }
	 
	 
		} elseif($params['action'] == 'user_register') {
     		
     		if($this->module_params->get('register_type') == 'usr_confirm') {
     				
    $wt_template->assign('confirm_link', wt_href_link('mod_user', '', 'a=confirmRegistration&uID=' . $params['usr_id'] . '&confirmCode=' . $this->generate_confirm_key($user_data['usr_id'], $user_data['usr_email']), '', 'NONSSL', false, false, array('full_url' => true) ));
     
    $email_subject = 'Potwierdzenie rejestracji i aktywacja konta na ' . SITE_NAME;
    $message  = $user_email_header;
    $message .= $wt_template->fetch('user.usr_confirm.tpl','',$this->module_key);
    $message .= $user_data_email_body;
    $message .= $user_email_footer;
    
    $email = new email(array('X-Mailer: WT mail - builder'));
    $email->add_html($message);
    $email->build_message();
    
    
    if(!$email->send($email_to_user, $user_data['usr_email'], SITE_NAME, CFGDB_EMAIL_FROM_ADDRESS, $email_subject)) {
    		$error = 1; // email send error
    }
    
  
     		
     		} else if($this->module_params->get('register_type') == 'admin_confirm') {
     		
    $email_subject = 'Potwierdzenie rejestracji na ' . SITE_NAME;
    
    $message  = $user_email_header;
    $message .= $wt_template->fetch('user.admin_confirm.tpl','',$this->module_key);
    $message .= $user_data_email_body;
    $message .= $user_email_footer;
    
    
    $email = new email(array('X-Mailer: WT mail - builder'));
    $email->add_html($message);
    $email->build_message();
     		
    $email->send($email_to_user, $user_data['usr_email'], SITE_NAME, CFGDB_EMAIL_FROM_ADDRESS, $email_subject);
     		
     		
     		} else if($this->module_params->get('register_type') == 'no_confirm') {
     		
     	  $Aparams = array();
     	  $Aparams['usr_id'] = $user_data['usr_id'];
     	  $Aparams['action'] = 'user_activ';
     	  
        $this->send_system_message($Aparams);
     		
     		}  
     		
     		} // if($params['action'] == 'user_register') {
     		
    if($params['action'] == 'user_activ') {
    		
    		$login_type = '';
    switch($this->module_params->get('use_as_login')) {
    	case 'usr_id';
    		$login_type = '<b><u>Numeru użytkownika:</u></b> ' . $user_data['usr_id'];
      break;
    	case 'usr_login';
    		$login_type = '<b><u>Loginu:</u></b> ' . $user_data['usr_login'];
      break;
      case 'usr_nick';
    		$login_type = '<b><u>Nicka:</u></b> ' . $user_data['usr_nick'];
      break;
      case 'usr_email';
    		$login_type = '<b><u>Adresu e-mail:</u></b> ' . $user_data['usr_email'];
      break;
    }
    
    $wt_template->assign('login_type', $login_type);
    
     $email_subject = 'Potwierdzenie aktywacji konta na ' . SITE_NAME;
    
    $message  = $user_email_header;
    $message .= $wt_template->fetch('user.account_activated.tpl','',$this->module_key);
    $message .= $user_data_email_body;
    $message .= $user_email_footer;
    
    
    $email = new email(array('X-Mailer: WT mail - builder'));
    $email->add_html($message);
    $email->build_message();
     		
     $email->send($email_to_user, $user_data['usr_email'], SITE_NAME, CFGDB_EMAIL_FROM_ADDRESS, $email_subject);
    
    }  		
	 
	 
	 
	 
     		
     		if($error) {
     			$email_send_error = 'Wystąpił problem z wysłaniem wiadomości e-mail na adres który wskazałeś. Jeżeli jesteś pewien, że podałeś poprawny adres <a href="' . wt_href_link('mod_contact') . '">skontaktuj się</a> z nami w celu wyjaśnienia tej sytuacji.';
     			$wt_session->set('email_send_error', $email_send_error);
     		}
     		
     		$wt_template->SetTemplateDir();
     		} // 	if(isset($params['action'])) {
     		
     		
     	 
     
     } // function
     
     
     function account_activated_message($params) {
     global $wt_template;
     		
     		$error = 0;
     		
     			$user_data = $this->get_users($params['usr_id']);
     			$wt_template->assign('user_data', $user_data);
     			
     			$email_from = $this->module_params->get('email_from');
     			$email_from_email = $this->module_params->get('email_from_email');
     			
     if(isset($user_data['usr_first_name']) && wt_not_null($user_data['usr_first_name']) && isset($user_data['usr_last_name']) && wt_not_null($user_data['usr_last_name']) ) {
     
    $email_to_user = $user_data['usr_first_name'] . ' ' . $user_data['usr_last_name'];
    
    } else if(isset($user_data['usr_nick']) && wt_not_null($user_data['usr_nick'])) {
    
    $email_to_user = $user_data['usr_nick'];
    
    } else if(isset($user_data['usr_login']) && wt_not_null($user_data['usr_login'])) {
    
    $email_to_user = $user_data['usr_login'];
    
    }
     			
     			$wt_template->SetTemplateDir('mails' . DIRECTORY_SEPARATOR . 'mod_user' . DIRECTORY_SEPARATOR, NULL, $this->mod_key);
     			$user_email_header = $wt_template->fetch('user.mail_header.tpl','',$this->module_key);
     			$user_email_footer = $wt_template->fetch('user.mail_footer.tpl','',$this->module_key);
     			$user_data_email_body = $wt_template->fetch('user.user_data.tpl','',$this->module_key);
     
    		
     
     
     }
     
     function generate_confirm_key($usr_id, $usr_email) {
     return wt_encrypt_password($usr_id . '-' . $usr_email);
     }
     
function saveUserSettings($data = array()) {
     	global $wt_user,$wt_session;
		$outside_action = true;
		
		if(!wt_is_valid($data,'array')) {
			$data = $_REQUEST['usr_settings'];
			$outside_action = false;
		}
		
     	
     	if(wt_is_valid($data,'array')) {
     	 //	foreach($data as $)
			$data = array_merge($wt_user->usr_settings,$data);
			$this->db->db_perform(TABLE_USERS_INFO, array('usr_settings' => wt_parse_params_for_db($data)), 'update', "usr_id = '".$wt_user->usr_info['usr_id']."' LIMIT 1" );
			$wt_user->usr_settings = $data;
			$wt_user->usr_info['settings'] = $data;
     	}
		if($outside_action === true) {
			return true;
		} else {
			die('ok');
		}
     }
     
     function get_users($usr_id = null, $params = array()) {
     	   		global $wt_sql, $wt_session, $wt_template;
        
        $users_array = array();
        
     if(wt_is_valid($usr_id, 'int', '0')) {
     
     $db_users_query_raw = "SELECT u.*, ui.* FROM (" . TABLE_USERS . " u, " . TABLE_USERS_INFO . " ui) LEFT JOIN ". TABLE_USERS_SETTINGS ." us ON u.usr_id=us.usr_id WHERE " . ((isset($params['where']) && wt_not_null($params['where'])) ? $params['where'] : '') . " u.usr_id = '" . $usr_id . "' AND u.usr_id = ui.usr_id LIMIT 1";

     } else {
     
     $db_users_query_raw = "SELECT u.*, ui.* FROM (" . TABLE_USERS . " u, " . TABLE_USERS_INFO . " ui) LEFT JOIN ". TABLE_USERS_SETTINGS ." us ON u.usr_id=us.usr_id WHERE " . ( (isset($params['where']) && wt_not_null($params['where'])) ? $params['where'] : '') . " u.usr_id = ui.usr_id ";
     
	  if( isset($params['order']) && wt_not_null($params['order']) ) {	
	  $db_users_query_raw .= " ORDER BY " . $params['order'] . " ";	
	  } elseif (!isset($params['order'])) {
	  $db_users_query_raw .= " ORDER BY u.usr_login, ui.usr_last_name, ui.usr_first_name ";
	  }	
		
	  if(isset($params['dsplit']) && wt_is_valid($params['limit'], 'int') ) { 	
     $db_users_query_raw .= " LIMIT 0," . $params['limit'];
     }
		
     if(!isset($params['dsplit'])) { 
     $this->users_split_listing = new splitPageResults($_GET['page'], ($params['limit']) ? $params['limit'] : MAX_DISPLAY_SEARCH_RESULTS, $db_users_query_raw, $this->db_users_query_numrows, '*', $this->db);
     }
		
		
     }
     
     $db_users_query = $this->db->db_query($db_users_query_raw);
     
     while($db_users = $this->db->db_fetch_array($db_users_query)) {
	  
     $db_users['settings'] = unserialize($db_users['settings']);
     	if( wt_not_null($db_users['usr_www']) && substr($db_users['usr_www'], 0, 7) != 'http://' ) {
		 	$db_users['usr_www'] = 'http://' . $db_users['usr_www'];
		 	}
     	$db_users['usr_params_array'] = unserialize($db_users['usr_params']);
		
      if(wt_is_valid($usr_id, 'int', '0') || $params['get_array']) {
		
      $users_array = $this->db->db_output_data($db_users);
      } else {
      $users_array[] = $this->db->db_output_data($db_users);
      }

     }
    
    
    return $users_array;
    
		} // function
     
         
     function check_email($email_address = '') {
     		global $wt_sql, $wt_user;
     		
     		$db_email_check_query = $this->db->db_query("SELECT usr_id FROM " . TABLE_USERS_INFO . " WHERE usr_email = '" . $this->db->db_input($email_address) . "'");
     		
     		$db_email_check = $this->db->db_fetch_array($db_email_check_query);
     		
     		
     		if($wt_user->is_user()) {
     			if($db_email_check['usr_id'] > 0 && $wt_user->usr_info['usr_id'] == $db_email_check['usr_id']) {
     			return true;
     			} elseif(!wt_is_valid($db_email_check['usr_id'],'int','0')) {
     			return true;
     			}	
     		} else {
     		
     		if($db_email_check['usr_id'] > 0) {
     			return false;
     		} else {
     			return true;
     		}
     		
     		}
     		
     		return false;
     }
     
     function check_password($pass = '') {
     		global $wt_user;
     		
     		
     		if(!$wt_user->is_user()) {
     			return true;
     		} else {
     			$db_pass_check_query = $this->db->db_query("SELECT usr_pass FROM " . TABLE_USERS . " WHERE usr_id = '" . $wt_user->usr_info['usr_id'] . "'");
     		
     			$db_pass_check = $this->db->db_fetch_array($db_pass_check_query);
     		
     		     		
     		if(wt_validate_password($pass, $db_pass_check['usr_pass'])) {
     			return true;
     		} else {
     			return false;
     		}
     		
     		}
     		
     		
     		return false;
     }
     
     
     
     function check_vat_id($nip) {
     
     $nip = trim(preg_replace("/[^0-9]/",'',$nip));
     $nip = trim($nip);
		
     if(!wt_not_null($nip)) {
     return true;
     }
     
    if(strlen($nip) != 10) {
        return false;
    }
    
      
    
    $arrSteps = array(6, 5, 7, 2, 3, 4, 5, 6, 7);
    $intSum = 0;
    for ($i = 0; $i < 9; $i++) {
        $intSum += $arrSteps[$i] * $nip[$i];
    }
    
    $int = $intSum % 11;
    
    $intControlNr = ($int == 10) ? 0 : $int;
    
    if ($intControlNr == $nip[9]) {
        return true;
    }
    return false;
}
     
     function newUser() {
     		global $wt_template, $wt_session;
     		
     		$wt_template->assign('nU_params', $this->module_params->get_array());
     	if($wt_session->exists('successModifyMessage') && $wt_session->exists('successModifyMessage') == '1') {	
     	   $wt_session->remove('successModifyMessage');
     		$wt_template->assign('successModifyMessage', '1');
     	 }	
     		
     		include_once($this->module_dir . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'newUser.php'); 
     		
     		
     
     $wt_template->load_file('newUser.tpl');
     
     }
     
     function loginPage($action = '') {
     global $wt_template, $wt_session, $wt_module;
     		
     if($wt_session->exists('lP_login_error')) {
     $wt_template->assign('lP_login_error', $wt_session->value('lP_login_error'));
     }
		
	  if($wt_session->exists('loginMessage')) {	
     $wt_template->assign('loginMessage', $wt_session->value('loginMessage'));
     }
		
	  if($wt_session->exists('admin_login')) {		
     $wt_template->assign('admin_login', true);
	  $admin_login = true;	
     }
		
	  $wt_session->remove('loginMessage');	
	  
     $wt_session->remove('lP_login_error');
     $wt_template->assign('__moduleTitle__', 'Logowanie');
     	  
     include_once($this->module_dir . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'loginPage.php'); 
		
	  if($admin_login == true) {	 
	  $wt_template->SetTemplateDir('modules'.DIRECTORY_SEPARATOR.'mod_user_manager'.DIRECTORY_SEPARATOR,'','mod_user_manager'); 		
	  $wt_template->display_self = true;
	  echo $wt_template->fetch('loginPage.tpl','','mod_user_manager');	
	  die();	
	  }	
	 
     $wt_template->load_file('loginPage.tpl');
     }
		
	  	
		
	  function fastRegistrationPage() {		
     global $wt_template, $wt_session;
     include_once($this->module_dir . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'fastRegistrationPage.php'); 
	  $wt_template->display_self = true;	
     $wt_template->load_file('fastRegistrationPage.tpl');
     }
		
	  function fastLoginPage() {	
     global $wt_template, $wt_session;
     include_once($this->module_dir . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'fastLoginPage.php'); 
	  $wt_template->display_self = true;	
     $wt_template->load_file('fastLoginPage.tpl');
     }
     
     function makeLogout() {
     global $wt_template, $wt_user;
     
     $wt_user->user_logout();
     if(wt_is_valid(wt_set_task($_REQUEST,'from_admin'),'int','0')) {
	  		wt_redirect(wt_href_link('mod_user', '', 't=logoutPage&from_admin=1', '', 'NONSSL', true));
	  } else {
			 wt_redirect(wt_href_link('mod_user', '', 't=logoutPage', '', 'NONSSL', true));
	  }
    
     
     }
     
     function logoutPage() {
     global $wt_template, $wt_user;
	  
	  	if(wt_is_valid(wt_set_task($_REQUEST,'from_admin'),'int','0')) {  
	  		$wt_template->SetTemplateDir('modules'.DIRECTORY_SEPARATOR.'mod_user_manager'.DIRECTORY_SEPARATOR,'','mod_user_manager'); 		
		   $wt_template->display_self = true;
		  	echo $wt_template->fetch('logoutPage.tpl','','mod_user_manager');	
	  		die();	
	  }			
     
       $wt_template->load_file('logoutPage.tpl');
       
     }
     
     function mainPage() {
     global $wt_template, $shopping_cart;
      	        
     $wt_template->load_file('mainPage.tpl');  
     }
     
     function user_register() {
     global $wt_template, $wt_sql, $wt_user;
     
     include_once(DIR_FS_MODULE . '/inc/user_register.php');
     
         
     }
          
     function get_default_group() {
  global $wt_sql;
  
  $db_default_group_query = $this->db->db_query("SELECT group_id FROM " . TABLE_USERS_GROUPS . " WHERE group_default = '1'");
  
  $db_default_group = $this->db->db_fetch_array($db_default_group_query);
  if( wt_is_valid($db_default_group['group_id'], 'int', '0') ) {
  		return $db_default_group['group_id'];
  }
  return 0;
  
  }
  
  function makeLogin() {
    global $wt_user, $wt_session, $wt_navigation, $wt_template;
  
  $login_state = $wt_user->user_login($_POST[$this->login_key], $_POST['usr_pass']);
  $method = wt_set_task($_REQUEST, 'method');
  
  if( $method == 'fastLogin' ) {
  		$wt_template->assign('login_state', $login_state);
		$wt_template->display_self = true;
		$wt_template->load_file('makeFastLogin');		
		return;
  }	
  
  if($login_state == '1') {
  	  $wt_session->remove('admin_login');		
     if(wt_not_null($wt_navigation->snapshot) && wt_not_null($wt_navigation->snapshot['get']['mod'])) {
       $wt_navigation->remove_current_page();
       
       $snapshot = $wt_navigation->snapshot;
   	 $wt_navigation->clear_snapshot();
       $snapshot['get']['from'] = 'login';
		 $mod = $snapshot['get']['mod'];
		 unset($snapshot['get']['mod']);
       wt_redirect( wt_href_link($mod, '', wt_get_all_get_params(array('some'),$snapshot['get']).'from=login', '', $snapshot['mode'], false, false, array('full_url' => true)) );
       
      } else {
      wt_redirect(wt_href_link('mod_user', '', 'from=login', '', 'SSL', true));
	 //	wt_redirect(wt_href_link());
      } // if
     } else {
     
     
     switch($login_state) {
     		case '2':
     			wt_redirect(wt_href_link('mod_user', '', 't=accountDisabledPage'));
     		break;
     		case '4':
     			wt_redirect(wt_href_link('mod_user', '', 't=notActiveAccountPage'));
     		break;
     		case '3':
     		
     			$login_error = 'Podany <b>' . $this->login_name . '</b> lub hasło jest nieprawidłowe.<br>Sprawdź jeszcze raz wszystko i spróbuj ponownie.';
     		
      		 $wt_session->set('lP_login_error', $login_error);
      	  
      		wt_redirect(wt_href_link('mod_user', '', 't=loginPage'));
     		break;
     }
     
      
     
     }  // if
  
  
  }
  
  
  
  function wt_navigationbar() {
          global $wt_template, $wt_navigationbar, $wt_user;
          
          $wt_navigationbar->add('Twój profil', wt_href_link('mod_user')); 
          
    switch($this->task) {
	 	case 'lP':
    	case 'loginPage':
    		 $wt_navigationbar->add('Logowanie', wt_href_link('mod_user', '', 't=loginPage')); 	
    	break;
    	case 'logoutPage':
    		 $wt_navigationbar->add('Wylogowanie', wt_href_link('mod_user')); 	
    	break;
		case 'nU':
    	case 'newUser':
    	
    	if($wt_user->is_user()) {
    	$wt_navigationbar->add('Zmiana danych', wt_href_link('mod_user', '', 't=newUser')); 
    	} else {
    	$wt_navigationbar->add('Rejestracja nowego użytkownika', wt_href_link('mod_user', '', 't=newUser')); 
    	}
    		 	
    	break;
    	case 'successRegistrationPage':
    	    $wt_navigationbar->add('Rejestracja nowego użytkownika', wt_href_link('mod_user', '', 't=newUser'));
    		 $wt_navigationbar->add('Rejestracja zakończona sukcesem'); 	
    	break;
    	
    	case 'confirmRegistrationPage':
    	    $wt_navigationbar->add('Rejestracja nowego użytkownika', wt_href_link('mod_user', '', 't=newUser'));
    		 $wt_navigationbar->add('Aktywacja konta'); 	
    	break;
    	
    	case 'confirmRegistrationErrorPage':
    	    $wt_navigationbar->add('Rejestracja nowego użytkownika', wt_href_link('mod_user', '', 't=newUser'));
    		 $wt_navigationbar->add('Błąd aktywacji konta'); 	
    	break;
    	
    	case 'notActiveAccountPage':
    		 $wt_navigationbar->add('Konto nieaktywne'); 	
    	break;
    	
    	case 'reSendActiveCodeSuccessPage':
    		 $wt_navigationbar->add('Wysyłanie kodu aktywacyjnego'); 	
    	break;
    	
      case 'errorPage':
    		 $wt_navigationbar->add('Błąd'); 	
    	break;
    	
    	case 'noPermissionPage':
    		 $wt_navigationbar->add('Brak dostępu'); 	
    	break;
    	
		case 'cP':
    	case 'changePass':
    		 $wt_navigationbar->add('Zmiana hasła'); 	
    	break;
    	
		case 'dU':
    	case 'deleteUser':
    		 $wt_navigationbar->add('Usuwanie konta'); 	
    	break;
    	
    	case 'deleteUserSuccessPage':
    		 $wt_navigationbar->add('Konto usunięte'); 	
    	break;
    
    }      
   		
   	

 
        } // function
  
  
     
     } // class



?>