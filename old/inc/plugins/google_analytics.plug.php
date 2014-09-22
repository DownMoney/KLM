<?php


  class WT_Plugin_google_analytics {
        var $preceeds = '';

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
    	global $wt_template, $wt_module, $wt_session, $wt_currencies;
	
		if(defined('CFGDB_GOOGLE_ANALYTICS_URCHIN_NO') && wt_not_null(CFGDB_GOOGLE_ANALYTICS_URCHIN_NO) && !$wt_module->is_manager()) {
			$wt_template->add_to_footer('<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src=\'" + gaJsHost + "google-analytics.com/ga.js\' type=\'text/javascript\'%3E%3C/script%3E"));
</script>
');
$wt_template->add_to_footer('<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("'.CFGDB_GOOGLE_ANALYTICS_URCHIN_NO.'");
pageTracker._initData();
pageTracker._trackPageview();
} catch(err) {}</script>
');

	
if(CFGDB_GOOGLE_ANALYTICS_TRACK_ORDERS == 'true' ) {
		
		 	if( $wt_module->module_info['mod_key'] == 'mod_checkout' && ($_REQUEST['t'] == 'successPage' || $_REQUEST['t'] == 'sP') &&  wt_is_valid($wt_session->value('order_oID'), 'int', '0') ) {
				
				$mod_orders = wt_module::singleton('mod_orders');
				$order_d = $mod_orders->get_orders($wt_session->value('order_oID'));
				
			 //	wt_print_array( $order_d );
				
if( wt_is_valid($order_d, 'array') ) {
	if( wt_is_valid($order_d['order_total'], 'array') ) {	
	 foreach( $order_d['order_total'] as $ot ) {
			if( $ot['ot_key'] == 'ot_shipping' )  {
				$shipping_cost = $ot['ot_value'];
			}	 
	 }		
	}	
		 
 $s = '<script type="text/javascript">
try {
  pageTracker._addTrans(
    "'.$order_d['or_id'].'",
    "",
	 "'.$order_d['total_value']['not_formatted'].'",
	 "0",
	 "'.$shipping_cost.'",
	 "'.$order_d['usr_city'].'",
	 "'.$order_d['usr_state'].'",
	 "'.(wt_not_null($order_d['usr_country']) ? $order_d['usr_country'] : 'Polska').'");
	';
  if( wt_is_valid($order_d['products'], 'array') ) {		
	 foreach( $order_d['products'] as $pr ) {
			$s .= 'pageTracker._addItem(
			    "'.$order_d['or_id'].'",
				 "'.$pr['pr_id'].'",
				 "'.wt_clear_string($pr['pr_name']).'",
				 "'.$pr['cat_name'].'", 
				 "'.$wt_currencies->priceValue($pr['pr_price'], $pr['pr_tax']).'",
				 "'.$pr['pr_quantity'].'");
				';
	}		
}
$s .= 'pageTracker._trackTrans();
} catch(err) {}</script>';
  $wt_template->add_to_footer($s);			
				
}
				
			
			}
} 
	



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