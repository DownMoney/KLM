<?php
function smarty_function_wt_getimagesize($params, &$smarty)
	{
        $file_info = false;
			if(isset($params['assign']) && wt_not_null($params['assign'])  && isset($params['file']) && wt_not_null($params['file']) && is_file($params['file']) && file_exists($params['file']) ) {
				
				if($file_data = @getimagesize($params['file'])  ) {
				
				if(wt_is_valid($file_data, 'array')  ) {
					$file_info = array();
					$file_info['width'] = $file_data[0];
					$file_info['height'] = $file_data[1];
				}
					
				
				}
			} 
		
		$smarty->assign($params['assign'], $file_info);
			
	} 

?>