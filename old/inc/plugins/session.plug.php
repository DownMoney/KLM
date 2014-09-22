<?php


  class WT_Plugin_session {
    var $title = 'Sesje';
    var $description = 'Menad�er sesji dla u�ytkownik�w, go�ci i robot�w wyszukiwarek.';
    var $uninstallable = false;
    var $depends;
    var $preceeds;

    function start() {
      
      global $request_type, $cookie_path, $cookie_domain, $SID, $wt_session, $messageStack, $wt_navigation;

        include_once(CFGF_DIR_FS_INCLUDES . 'session.inc.php');
      
      $wt_session = new wt_Session;

		
	 	setcookie('wt_cookie_test', 'please_accept_for_session', time()+60*60*24*30, $cookie_path, $cookie_domain, 0);
		 
	
	 
      if (PLUGIN_SESSION_FORCE_COOKIE_USAGE == 'True') {
      
        if (isset($_COOKIE['wt_cookie_test'])) {
          $wt_session->start();
        }
      } elseif (PLUGIN_SESSION_BLOCK_SPIDERS == 'True') {
        $user_agent = strtolower($_SERVER['HTTP_USER_AGENT']);
        $spider_flag = false;

        if (wt_not_null($user_agent)) {
          $spiders = file(CFGF_DIR_FS_INCLUDES . 'spiders.txt');

          foreach ($spiders as $spider) {
            if (wt_not_null($spider)) {
              if (strpos($user_agent, trim($spider)) !== false) {
                $spider_flag = true;
                break;
              }
            }
          }
        }

        if ($spider_flag == false) {
          $wt_session->start();
        }
      } else {
      	
      	
        $wt_session->start(); // tu sie psuje
        
      }

      $SID = (defined('SID') ? SID : '');

// verify the ssl_session_id
      if ( ($request_type == 'SSL') && (PLUGIN_SESSION_CHECK_SSL_SESSION_ID == 'True') && (ENABLE_SSL == true) && ($wt_session->is_started == true) ) {
        if (isset($_SERVER['SSL_SESSION_ID'])) {
          $ssl_session_id = $_SERVER['SSL_SESSION_ID'];

          if ($wt_session->exists('SESSION_SSL_ID') == false) {
            $wt_session->set('SESSION_SSL_ID', $ssl_session_id);
          }

          if ($wt_session->value('SESSION_SSL_ID') != $ssl_session_id) {
            $wt_session->destroy();

            echo 'ssl check';//wt_redirect(wt_href_link(FILENAME_SSL_CHECK));
          }
        }
      }

// verify the browser user agent
      if (PLUGIN_SESSION_CHECK_USER_AGENT == 'True') {
        $http_user_agent = (isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '');

        if ($wt_session->exists('SESSION_USER_AGENT') == false) {
          $wt_session->set('SESSION_USER_AGENT', $http_user_agent);
        } elseif ($wt_session->value('SESSION_USER_AGENT') != $http_user_agent) {
          $wt_session->destroy();

         echo 'user agent';// wt_redirect(wt_href_link(FILENAME_LOGIN));
        }
      }

// verify the IP address
      if (PLUGIN_SESSION_CHECK_IP_ADDRESS == 'True') {
        $ip_address = wt_get_ip_address();

        if ($wt_session->exists('SESSION_IP_ADDRESS') == false) {
          $wt_session->set('SESSION_IP_ADDRESS', $ip_address);
        }

        if ($wt_session->value('SESSION_IP_ADDRESS') != $ip_address) {
          $wt_session->destroy();

          echo 'user ip';//wt_redirect(wt_href_link(FILENAME_LOGIN));
        }
      }

// navigation history

      if ($wt_session->exists('wt_navigation')) {
        $GLOBALS['wt_navigation'] =& $wt_session->value('wt_navigation');
      } else {
        $GLOBALS['wt_navigation'] = new wt_navigation_history;
        $wt_session->set('wt_navigation', $GLOBALS['wt_navigation']);
      }
      
      $GLOBALS['wt_message_stack']->loadFromSession();

	 
	 
	  
      return true;
    }
    
    function action_after_user() {
      return false;
    }
    
    function action_after_module() {
      return false;
    }
    
    function action_after_block() {
      return false;
    }
    
    function action_before_load() {
	 	$GLOBALS['wt_navigation']->add_current_page();
      return false;
    }

    function stop() {
      global $wt_session;

      $wt_session->close();
      return true;
    }

    function install() {
    global $wt_sql;
      $wt_sql->db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Sprawd� u�ycie cookie', 'PLUGIN_SESSION_FORCE_COOKIE_USAGE', 'False', 'Rozpoczynaj sesje tylko i wy��cznie gdy obs�uga cookie jest w��czona', '6', '0', 'wt_cfg_select_option(array(\'True\', \'False\'), ', now())");
      $wt_sql->db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Blokuj roboty wyszukiwarek (bot spiders)', 'PLUGIN_SESSION_BLOCK_SPIDERS', 'False', 'Blokuj roboty wyszukiwarek internetowych aby nie rozpoczyna�y sesji.', '6', '0', 'wt_cfg_select_option(array(\'True\', \'False\'), ', now())");
      $wt_sql->db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Sprawdzaj ID sesji SSL', 'PLUGIN_SESSION_CHECK_SSL_SESSION_ID', 'False', 'Sprawdzaj SSL_SESSION_ID na ka�dej zabezpieczonej stronie SSL.', '6', '0', 'wt_cfg_select_option(array(\'True\', \'False\'), ', now())");
      $wt_sql->db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Sprawdzaj przegl�darke', 'PLUGIN_SESSION_CHECK_USER_AGENT', 'False', 'Sprawdzaj rodzaj przegl�darki na ka�dej stronie.', '6', '0', 'wt_cfg_select_option(array(\'True\', \'False\'), ', now())");
      $wt_sql->db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Sprawdzaj numer IP', 'PLUGIN_SESSION_CHECK_IP_ADDRESS', 'False', 'Sprawdzaj numer IP na ka�dej stronie.', '6', '0', 'wt_cfg_select_option(array(\'True\', \'False\'), ', now())");
      $wt_sql->db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Odnawiaj ID sesji', 'PLUGIN_SESSION_REGENERATE_ID', 'False', 'Odnawiaj ID sesji po zalogowaniu lub za�o�eniu konta przez u�ytkownika (wymaga PHP >= 4.1).', '6', '0', 'wt_cfg_select_option(array(\'True\', \'False\'), ', now())");
    }

    function remove() {
    global $wt_sql;
      $wt_sql->db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('PLUGIN_SESSION_FORCE_COOKIE_USAGE', 'PLUGIN_SESSION_BLOCK_SPIDERS', 'PLUGIN_SESSION_CHECK_SSL_SESSION_ID', 'PLUGIN_SESSION_CHECK_USER_AGENT', 'PLUGIN_SESSION_CHECK_IP_ADDRESS', 'PLUGIN_SESSION_REGENERATE_ID');
    }
  }
?>