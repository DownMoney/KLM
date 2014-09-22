<?php 

						
function smarty_function_wt_item_att_form($params, &$smarty)
{

require_once $smarty->_get_plugin_filepath('shared','escape_special_chars');


$_at_type = array('' => 'zwyk³y', 
						'header' => 'nag³ówek', 
						'image' => 'obrazek',  
						'desc' => 'opis',  
						'sdesc' => 'sam opis', );


		
echo '<script type="text/javascript">' . "\n";
echo 'function insert_data_' . $params['at_group'] . '(id, type, only_type, lock_type) {' . "\n";
echo "Sortable.destroy('di_list_" . $params['at_group'] . "');" . "\n";
echo "var new_id = new String (Math.random()).substring (2, 11);" . "\n";
echo "var content = '<li id=\"di_list_item_" . $params['at_group'] . "_'+new_id+'\" class=\"it_new\">';" . "\n";

$att = array();
$Atparams = array();
$ATparams['js'] = true;
$ATparams['at_group'] = $params['at_group'];
$att['att_id'] = "'+new_id+'";

echo  "content += '" . _wt_item_att_type($att, $ATparams) . "';" . "\n";

echo "content += '<span id=\"di_list_options_" . $params['at_group'] . "_'+new_id+'\">';" . "\n";

echo "content += '" . _wt_item_att_item($att, $params, $smarty) . "';" . "\n";

echo "content += '</span>';" . "\n";

echo "content += 'dodaj <a href=\"#\" onclick=\"insert_data_" . $params['at_group'] . "(\''+new_id+'\', \'before\'); return false;\">przed</a> <a href=\"#\" onclick=\"insert_data_" . $params['at_group'] . "(\''+new_id+'\', \'after\'); return false;\">po</a> <a href=\"#\" onclick=\"insert_data_" . $params['at_group'] . "(\''+new_id+'\', \'del\'); return false;\">usuñ</a> <span style=\"cursor: n-resize;\">przesuñ</span>';" . "\n";

echo "content += '</li>';" . "\n";

echo "if( type == 'after' ) {" . "\n";
echo "new Insertion.After('di_list_item_" . $params['at_group'] . "_'+id, content);" . "\n";
echo "} else if( type == 'before' ) {" . "\n";
echo "new Insertion.Before('di_list_item_" . $params['at_group'] . "_'+id, content);" . "\n";
echo "} else if( type == 'del' ) {" . "\n";
echo "Element.remove('di_list_item_" . $params['at_group'] . "_'+id);" . "\n";
echo "}" . "\n";
echo "Sortable.create('di_list_" . $params['at_group'] . "');" . "\n";
echo "}" . "\n\n";
echo "function update_change_" . $params['at_group'] . "(id) {" . "\n";
echo "Element.setStyle('di_list_item_" . $params['at_group'] . "_'+id, {backgroundColor:'#FFB7B7'} );" . "\n";
echo "}" . "\n" . "\n";

echo "function update_type_" . $params['at_group'] . "(id) {" . "\n";
echo "var val = _gsev('type_" . $params['at_group'] . "_'+id);" . "\n";
echo "content = '';" . "\n";

foreach( $_at_type as $at => $desc ) {
echo "if( val == '" . $at . "' ) {" . "\n";
echo "content += '";
$att = array();
$att['att_type'] = $at;
$att['att_id'] = "'+id+'";
echo _wt_item_att_item($att, $params, $smarty);
echo "';
}";
}


echo "update_field = _gebi( 'di_list_options_" . $params['at_group'] . "_'+id );" . "\n";
echo "return  update_field.innerHTML = content;	" . "\n";
echo "}" . "\n";
echo "</script>" . "\n\n";

echo '<div class="con">' . "\n";
echo '<ul id="di_list_' . $params['at_group'] . '" class="di_list">' . "\n";

if( wt_is_valid($params['att_list'], 'array') ) {


foreach($params['att_list'] as $att) {

echo '<li id="di_list_item_' . $params['at_group'] . '_' . $att['att_id'] . '">' . "\n";

if( isset($params['only_type']) ) {
echo '<input type="hidden" name="item_att[' . $params['at_group'] . '][' . $att['att_id'] . '][type]" value="' . $params['only_type'] . '" />' . "\n";
} else {
echo _wt_item_att_type($att, $params);
}

echo '<span id="di_list_options_' . $params['at_group'] . '_' . $att['att_id'] . '">';

echo _wt_item_att_item($att, $params, $smarty);

echo '</span>';

echo "dodaj <a href=\"#\" onclick=\"insert_data_" . $params['at_group'] . "('" . $att['att_id'] . "', 'before'); return false;\">przed</a> <a href=\"#\" onclick=\"insert_data_" . $params['at_group'] . "('" . $att['att_id'] . "', 'after'); return false;\">po</a> <a href=\"#\" onclick=\"insert_data_" . $params['at_group'] . "('" . $att['att_id'] . "', 'del'); return false;\">usuñ</a> <span style=\"cursor: n-resize;\">przesuñ</span></li>";
}

} else {
echo '<li id="di_list_item_' . $params['at_group'] . '_1">' . "\n";
echo _wt_item_att_type($att, $params);

echo '<span id="di_list_options_' . $params['at_group'] . '_1">';

echo _wt_item_att_item($att, $params, $smarty);

echo '</span>';

echo "dodaj <a href=\"#\" onclick=\"insert_data_" . $params['at_group'] . "('1', 'before'); return false;\">przed</a> <a href=\"#\" onclick=\"insert_data_" . $params['at_group'] . "('1', 'after'); return false;\">po</a> <a href=\"#\" onclick=\"insert_data_" . $params['at_group'] . "('1', 'del'); return false;\">usuñ</a> <span style=\"cursor: n-resize;\">przesuñ</span></li>";

} 

echo '</ul>';
echo '</div>';
echo '<script type="text/javascript">' . "\n";
echo "Sortable.create('di_list_" . $params['at_group'] . "');" . "\n";
echo '</script>' . "\n";
}

function _wt_item_att_item($att, $params, &$smarty) {

	if(!wt_not_null($att['att_id'])) {
			$att['att_id'] = 1;
	}

switch($att['att_type']) {
	  
		case 'header':
			$str = '<input type="text" name="item_att[' . $params['at_group'] . '][' . $att['att_id'] . '][value]" value="' . $att['att_value'] . '" class="it_header" />  ';
		break;
		case 'image':
		
			$Iparams = array();
			$Iparams['src'] = 'mod_developer/items/' . $att['att_file'];
			$Iparams['MAXwidth'] = '100';
			$Iparams['show_blank'] = '1';
			$Iparams['compress'] = '100';
		
			$str = smarty_function_wt_thumb_image($Iparams, $smarty) . '<input type="text" name="item_att[' . $params['at_group'] . '][' . $att['att_id'] . '][name]" value="' . $att['att_name'] . '" /> <input type="file" name="item_att_' . $params['at_group'] . '_' . $att['att_id'] . '_file" value="" />';
			if( isset($att['att_file']) && wt_not_null($att['att_file']) ) {
			$str .= '<input type="checkbox" name="item_att[' . $params['at_group'] . '][' . $att['att_id'] . '][del_file]" value="1" />';
			$str .= '<input type="hidden" name="item_att[' . $params['at_group'] . '][' . $att['att_id'] . '][previus_file]" value="' . $att['att_file'] . '" />';
			}
		break;
		case 'desc':
			$str = '<input type="text" name="item_att[' . $params['at_group'] . '][' . $att['att_id'] . '][name]" value="' . $att['att_name'] . '" /> <textarea cols="40" rows="4" name="item_att[' . $params['at_group'] . '][' . $att['att_id'] . '][value]">' . $att['att_value'] . '</textarea> ';
		break;
		case 'sdesc':
			$str = '<textarea cols="40" rows="4" name="item_att[' . $params['at_group'] . '][' . $att['att_id'] . '][value]">' . $att['att_value'] . '</textarea> ';
		break;
		default: 
		$str = '<input type="text" name="item_att[' . $params['at_group'] . '][' . $att['att_id'] . '][name]" value="' . $att['att_name'] . '" /> <input type="text" name="item_att[' . $params['at_group'] . '][' . $att['att_id'] . '][value]" value="' . $att['att_value'] . '" />';
		break;
}

return $str;

} 

function _wt_item_att_type($att, $params) {

$_at_type = array('' => 'zwyk³y', 
						'header' => 'nag³ówek', 
						'image' => 'obrazek',  
						'desc' => 'opis',  
						'sdesc' => 'sam opis', );;
if( $params['js'] == true ) {
$js_att_id = "\'" . $att['att_id'] . "\'";
} else {
$js_att_id = "'" . $att['att_id'] . "'";
}

$str = '<select onChange="update_type_' . $params['at_group'] . '(' . $js_att_id . ');" name="item_att[' . $params['at_group'] . '][' . $att['att_id'] . '][type]" id="type_' . $params['at_group'] . '_' . $att['att_id'] . '"autocomplete="off" >';

foreach( $_at_type as $at => $desc ) {
$str .= '<option value="' . $at . '" ' . (($att['att_type'] == $at) ? 'selected' : '') . '>' . $desc . '</option>';

}
$str .= '</select>';

return $str;


}




?>