
<?php 

function  smarty_function_wt_init_editor($params, &$smarty) {
   global $wt_module, $wt_template;
   
	
	$ed = '<script type="text/javascript">' . "\n";
	$ed .= '' . $params['id'] . '_ED_options = {' . "\n";
	$ed .= "id:'" . $params['id'] . "'";
	if( wt_is_valid($params['width'], 'int', '0') ) {
	$ed .= ",\n";
	$ed .= "width:'" . $params['width'] . "'";
	}
	if( wt_is_valid($params['height'], 'int', '0') ) {
	$ed .= ",\n";
	$ed .= "height:'" . $params['height'] . "'";
	}
	if( wt_not_null($params['mode']) ) {
	$ed .= ",\n";
	$ed .= "mode:'" . $params['mode'] . "'";
	}
   
	$ed .= '};' . "\n";
	
   $ed .= '</script>';
	
	
	$ed .= '<a href="#" id="' . $params['id'] . '_link" onClick="init_editor(' . $params['id'] . '_ED_options); return false">WŁĄCZ EDYTOR HTML</a>';
   		
   echo $ed;
}


?>