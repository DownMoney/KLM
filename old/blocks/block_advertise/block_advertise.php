<?php 
global $wt_sql, $wt_session, $wt_template;
  
  
  unset($bl_params);    
  $bl_params = new wt_params($block_params);
  $mod_advertise = wt_module::singleton('mod_advertise');
  
  //wt_print_array($bl_params);
 
  $groups = array();
  $groups = $bl_params->get('groups');
  $params = array();
  
 // wt_print_array($groups);
  
  if(is_array($groups) && wt_not_null($groups)) {
  
  $params = array();
  $params['where'] = " ( ";
  $all_count = count($groups);
  $i = 1;
    
  foreach($groups as $gr_id) {
  
  $params['where'] .= " a2d.gr_id = '" . $gr_id . "' ";
  
  if($i < $all_count) {
  $params['where'] .= " OR ";
  } else {
  $params['where'] .= " ) AND ";
  } // if($i < $all_count) {
  
  $i++;
  } // foreach($groups as $gr_id) {
  
  
  $banners = $mod_advertise->get_advertise(null, $params);
  
  } 
    else if(is_array($bl_params->get('advertise')) && wt_not_null($bl_params->get('advertise'))) {
    $params = array();
    $params['where'] = " a.ad_id IN (" . implode(',', $bl_params->get('advertise')) . ") AND ";
    $banners = $mod_advertise->get_advertise(null, $params);
    }
  
  //if(is_array($groups) && wt_not_null($groups)) {
  
  $random_banner_data = array();
 if(is_array($banners) && wt_not_null($banners)) {
  
  $random_banner_data = wt_random_array($banners, $bl_params->get('no_of_advertise', 1));
  
 // wt_print_array($random_banner_data);
  
}  

$wt_template->assign('BA_banners_data', $random_banner_data);
$wt_template->assign('BA_params', $bl_params->get_array());

  /*
  $p = array('groups' => array('1'), 
 		       'no_of_advertise' => 2);
  
  echo serialize($p);
   */
?>
