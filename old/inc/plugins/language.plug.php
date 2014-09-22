<?php


  class WT_Plugin_language {

    function start() {
      global $wt_session, $wt_language;
		//wt_print_array($_SESSION);
	  if (($wt_session->exists('language_data') == false) || isset($_GET['language'])) {
        if (isset($_GET['language']) && wt_not_null($_GET['language'])) {
          $wt_language->set_language($_GET['language']);
        } else {
          $wt_language->get_browser_language();
        }
      } elseif( $wt_session->exists('language_data') ) {
			$lang = $wt_session->value('language_data');
			$wt_language->set_language($lang['code']);
		}

      setlocale(LC_TIME, $wt_language->language['locale']);
      return false;
    }

   function action_after_user() {

    }

    function action_after_module() {
      return false;
    }

    function action_after_block() {
      return false;
    }

    function action_before_load() {
      return false;
    }

    function stop() {
      return true;
    }

    function install() {
      return false;
    }

    function remove() {
      return false;
    }

    function keys() {
      return false;
    }
  }
?>
