<?php

  class WT_Plugin_simple_cron {

    function start() { 
    	return true;
    }
    
    function action_after_user() {
      return false;
    }
    
    function action_after_module() {
    	return true;
    }
    
    function action_after_block() {
      return false;
    }
    
    function action_before_load() {
    	global $wt_template;
		if(time()-@filemtime(CFGF_DIR_FS_WORK.'cron') > 3600) {
			$wt_template->add_to_footer('<script type="text/javascript">
			new Ajax.Request(\''.CFGF_DIR_WS_HTTP_CATALOG.'cron.php\', { method:\'get\' });
			</script>');
			@fclose(@fopen(CFGF_DIR_FS_WORK.'cron','w'));
		}
      return true;
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