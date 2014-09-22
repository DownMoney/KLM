<?php 
function smarty_function_wt_count($p, &$smarty) {
			if( wt_is_valid( $p['c'], 'array' ) ) {
				return count($p['c']);
			} else {
				return 0;
			}
}
?>