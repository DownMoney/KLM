<?php
include_once(CFGF_DIR_FS_INCLUDES . 'smarty/Smarty.class.php');

class wt_template extends Smarty {

	 var $want_to_load = null;
    var $theme = CFGDB_DEFAULT_THEME;
    var $template_module_file = '404.tpl';
    var $template_module_file_attr = '';
    var $header = '';
    var $footer = '';
    var $meta_desc = META_DESCRIPTION;
    var $meta_keys = META_KEYS;
    var $site_title = SITE_TITLE;
    var $cache_id = null;
	 var $headers = array('Expires' => 'Mon, 26 Jul 1997 05:00:00 GMT',
	 						    'Content-type' => 'text/html; charset=UTF-8');

    function wt_template() {

       $this->plugins_dir = CFGF_DIR_FS_INCLUDES.'smarty/plugins/';

       if(DEVELOPERS_MODE == 'true') {

       $this->caching = false;
       $this->cache_lifetime = -1;
       $this->debugging = false;
       $this->compile_check = true;
       $this->force_compile = true;
       $this->use_sub_dirs = true;
       $this->debugging_ctrl = true;

       } else {

       $this->caching = false;
       $this->cache_lifetime = -1;
       $this->debugging = false;
       $this->compile_check = false;
       $this->force_compile = false;
       $this->use_sub_dirs = true;
       $this->debugging_ctrl = false;

       }
     $this->caching = false;
	  $this->assign('__templateFSRoot__', CFGF_DIR_FS_TEMPLATES);
	  $this->assign('__BaseMediaRoot__', CFG_WS_PATH_TO_DOCUMENT_ROOT . 'media');

     $this->assign('__BaseImageRoot__', CFG_WS_PATH_TO_DOCUMENT_ROOT . 'media/images');
     $this->assign('__BaseJsRoot__', CFG_WS_PATH_TO_DOCUMENT_ROOT . 'js');
     $this->assign('__BaseURL__', CFG_WS_PATH_TO_DOCUMENT_ROOT);
     $this->assign('__BaseTemplate__', CFGF_DIR_WS_TEMPLATES);
    }


	function create_block_cache_key($column, $blocks_value) {
		global $wt_module, $wt_session;

	$cache_key = array();



	$cache_key_groups = array();
	$cache_key_groups[] = '_blocks_content';
	$cache_key_groups[] = $wt_module->module_info['mod_key'];
	$cache_key_groups[] = $blocks_value['block_key'];


	if(isset($blocks_value['cache_depends_on_request']) && $blocks_value['cache_depends_on_request'] == '1') {

      if(wt_not_null($_REQUEST)) {

      	$_cache_key = array();

      	foreach($_REQUEST as $key => $val) {

      		if(wt_not_null($key) && wt_not_null($val) && $key != $wt_session->name && $key != 'mod') {

      			$_cache_key_groups[$key] = $val;

      		}

      	} // foreach($_REQUEST as $key => $val) {


       if(is_array($_cache_key_groups) && wt_not_null($_cache_key_groups)) {
       	$cache_key_groups[] = md5(serialize($_cache_key_groups));
       }	//if(is_array($_cache_key) && wt_not_null($_cache_key)) {


      } // if(wt_not_null($_REQUEST)) {

	} // 	if(isset($blocks_value['cache_depends_on_request']) &&



   $cache_key['groups'] = $cache_key_groups;
   $cache_key['name'] = $blocks_value['btm_id'];

   return $cache_key;



	}

    function create_cache_id($params = array()) {
    	global $wt_user;



    if(!isset($this->cache_id) || wt_not_null($this->cache_id))	{

      $template_cache_key = array();

      if(isset($_GET['mod']) && wt_not_null($_GET['mod'])) {
      $template_cache_key[] = $_GET['mod'];
      }

      if(isset($_GET['m']) && wt_not_null($_GET['m'])) {
      $template_cache_key[] = $_GET['m'];
      }

      if(isset($_GET['t']) && wt_not_null($_GET['t'])) {
      $template_cache_key[] = $_GET['t'];
      }

 		$template_cache_key2 = array_diff($_GET, $template_cache_key);
 		$template_cache_key = array_merge($template_cache_key, $template_cache_key2);

 	   $template_cache_key = array_values($template_cache_key);
 	 //	$template_cache_key[] = md5(serialize(array_keys($wt_user->usr_group)));
 		$this->cache_id = implode('|', $template_cache_key);

 		}

 		$cache_id = $this->cache_id;

 		if(isset($params['add']) && is_array($params['add']) && wt_not_null($params['add'])) {
    	  $cache_id = $cache_id . '|' .  implode('|', $params['add']);
    	}

    	if(isset($params['return_array'])) {
    	  $cache_id = explode('|', $cache_id);
    	}


 		return $cache_id;
    }

    function SetTemplateDir($TemplateDir = '', $now_theme = '', $get_mod_theme = '') {
    global $wt_module;



if(wt_not_null($get_mod_theme)) {
  $mod_info = $wt_module->get_module_info('', $get_mod_theme);
  $now_theme = $mod_info['theme'];
 }

  if(!wt_not_null($now_theme)) {
    $now_theme = $this->theme;
  }

  $this->assign('__mediaRoot__', CFGF_DIR_WS_TEMPLATES . $now_theme . '/media');
  $this->assign('__mediaFSRoot__', CFGF_DIR_FS_MEDIA);

  $this->assign('__imageRoot__', CFGF_DIR_WS_TEMPLATES . $now_theme . '/media/images');
  $this->assign('__cssRoot__', CFGF_DIR_WS_TEMPLATES . $now_theme . '/css');
  $this->assign('__jsRoot__', CFGF_DIR_WS_TEMPLATES . $now_theme . '/js');

   if (wt_not_null($TemplateDir)) {
	$this->set_theme($now_theme);
   $this->template_dir = CFGF_DIR_FS_TEMPLATES . $now_theme . '/source/' . $TemplateDir;
    } else {
	$this->get_template_variable();
	$this->set_theme($this->theme);
    }



    }


    function add_to_header($data) {
    $this->header = $this->header . "\n" . $data;
    }



    function add_to_footer($data) {
    $this->footer = $this->footer . "\n" . $data;
    }

    function add_meta_desc($desc, $only_this = true) {

	 if($this->lock_meta_desc === true)	{
	  	return;
	  }

    if($only_this) {
    $this->meta_desc = $desc;
    } else {
    $this->meta_desc = $this->meta_desc . ' ' . $desc;
    }
    }

     function add_meta_keys($keys, $only_this = true) {

	  if($this->lock_meta_keys === true)	{
	  	return;
	  }

    if($only_this) {
    $this->meta_keys = $keys;
    } else {
    $this->meta_keys = $this->meta_keys . ' ' . $keys;
    }
    }

    function add_site_title($title, $only_this = false) {

	 if($this->lock_title === true)	{
	  	return;
	 }

    if($only_this) {
    $this->site_title = $title;
    } else {
    $this->site_title = $title . ' ' . SITE_TITLE_SHORT;
    }

    }

     function load_javascript_to_header($file, $dir = '') {

    if(wt_not_null($dir)) {
    $adds = $dir . $file;
    } else {
    $adds = CFG_WS_PATH_TO_DOCUMENT_ROOT . 'js/' . $file;
    }

    $script = '<script language="JavaScript" type="text/javascript" src="' . $adds . '"></script>';

    $this->add_to_header($script);

    }



    function load_file($file, $file_attr = '') {
    global $wt_module, $wt_core_error;

	 if( wt_is_valid($file, 'array') ) {
		if( wt_not_null($file[0]) ) {
			$file = $file[0];
		} else {
			$file = $file[1];
		}
	 }


     $file = str_replace('---', DIRECTORY_SEPARATOR, $file);

    if( strpos($file, ';') !== false ) {
    	$prepare = explode(';', $file);
    	if( wt_not_null($prepare[0]) ) {
    		$this->set_theme($prepare[0]);
    	}
    	$file = $prepare[1];
    }

    $file = $this->prepare_tfile($file);
    $this->want_to_load = $file;

    if(file_exists(CFGF_DIR_FS_TEMPLATES . $this->theme . '/source' . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR . $wt_module->module_info['mod_key'] . DIRECTORY_SEPARATOR . $file))  {

     $this->template_module_file = 'modules' . DIRECTORY_SEPARATOR . $wt_module->module_info['mod_key'] . '/' . $file;
     $this->template_module_file_attr = $file_attr;
     } else {
    // $this->template_module_file = '404.tpl';

     wt_core_log::add('core_error', array('Nieudane za3adowanie pliku szablonu modu3u', 'Plik szablonu (' . CFGF_DIR_FS_TEMPLATES . $this->theme . '/source/modules/' . $wt_module->module_info['mod_key'] . '/' . $file . ') nie istnieje. Prze3ączam na plik 404.tpl' ) );

     }



    }

    function is_cached_module_file($file, $cache_id) {
    	global $wt_module;



    if(CFG_USE_SMARTY_CACHE == 'true' && $wt_module->module_info['use_cache'] == '1' && $wt_module->module_info['mod_type'] == 'local') {


     $this->load_file($file, $cache_id);

     $this->caching = true;
     $is_cached = $this->is_cached($this->template_module_file, $cache_id);
     $this->caching = false;

     return	$is_cached;

    } else {
    	return false;
    }

    }

    function is_cached_block_file($file, $cache_id) {


    }

    function get_template_variable() {
     global $wt_module;

     if(isset($wt_module->module_info['theme']) && wt_not_null($wt_module->module_info['theme']) && file_exists(CFGF_DIR_FS_TEMPLATES . $wt_module->module_info['theme'] . DIRECTORY_SEPARATOR . 'source' . DIRECTORY_SEPARATOR . 'theme.tpl')) {
     $this->theme = $wt_module->module_info['theme'];
     } else {

     wt_core_log::add('core_error', array('Nieudane załadowanie szablonu modułu', 'Plik szablonu (' . CFGF_DIR_FS_TEMPLATES . $wt_module->module_info['theme'] . DIRECTORY_SEPARATOR . 'source' . DIRECTORY_SEPARATOR . 'theme.tpl - nie istnieje. Przełączam na domyślny szablon: ' . CFGDB_DEFAULT_THEME ) );

     $this->theme = CFGDB_DEFAULT_THEME;
     }

	$this->load_theme_variable();

    }


    function countColumn() {
        global $wt_block, $wt_session;

    if( wt_is_valid($wt_block->blocks_list, 'array') ) {
        $columns = array_keys($wt_block->blocks_list);

        }
     if( isset($_GET['structureEdit']) || $wt_session->value('structureEdit') == '1' ) {
     $columns = range(1, 98);
     }

     if( wt_is_valid($columns, 'array') ) {
        foreach($columns as $column) {
        $this->assign('__column' . $column . '__', '1');
        $this->columns[] = $column;
          }

     }
}

	function get_columns() {
		if( !wt_is_valid($this->columns, 'array') ) {
			$this->countColumn();
		}

		return $this->columns;
	}


   function set_theme($theme = null) {

   if(!wt_not_null($theme)) {
   return;
   }

   if(file_exists(CFGF_DIR_FS_TEMPLATES . $theme . DIRECTORY_SEPARATOR . 'source' . DIRECTORY_SEPARATOR . 'theme.tpl')) {
   $this->theme = $theme;
   $this->load_theme_variable();
   }

   return;

   }

  function load_theme_variable() {

   $this->compile_dir = CFGF_DIR_FS_TEMPLATES . $this->theme . DIRECTORY_SEPARATOR . 'compiled' . DIRECTORY_SEPARATOR;
	$this->config_dir = CFGF_DIR_FS_TEMPLATES . $this->theme . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR;
	$this->cache_dir = CFGF_DIR_FS_TEMPLATES . $this->theme . DIRECTORY_SEPARATOR . 'cache' . DIRECTORY_SEPARATOR;
   $this->template_dir = CFGF_DIR_FS_TEMPLATES . $this->theme . DIRECTORY_SEPARATOR . 'source' . DIRECTORY_SEPARATOR;
  }

 function get_item_theme_files($item, $params) {
   global $wt_module, $wt_template;
   $module = $params['mod'];
   $module_info = $wt_module->get_module_info(null, $module);
   $items_themes_array = array();

   $mod_templates_manager = wt_module::singleton('mod_templates_manager');

   $Tparams = array();
   $Tparams['where'] = " tem_key != 'admin' ";
   $themes_data = $mod_templates_manager->get_themes(null, $Tparams);

    	$i = 0;

		foreach($themes_data as $theme) {

   $read_dir = CFGF_DIR_FS_TEMPLATES . $theme['tem_key'] . DIRECTORY_SEPARATOR . 'source' . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR . $module;

   if(file_exists($read_dir . DIRECTORY_SEPARATOR . $item . '.tpl')) {

	  $items_themes_array[$theme['tem_key']]['name'] = $theme['tem_name'];
	  $items_themes_array[$theme['tem_key']]['files'][] = array('name' => 'domyślny',
		'path' => $theme['tem_key'] . DIRECTORY_SEPARATOR . 'source'. DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR . $module_info['mod_key'] . DIRECTORY_SEPARATOR . $item,
		'formated' => '');

   if(is_dir($read_dir . DIRECTORY_SEPARATOR . $item)) {
   	$handle = dir($read_dir . DIRECTORY_SEPARATOR . $item);

   while ($file = $handle->read()) {
        if (preg_match("/\.(tpl)$/i",$file)) {

           $files = substr($file, 0, strpos($file, '.tpl'));

			  $items_themes_array[$theme['tem_key']]['files'][] = array('name' => $files,
		'path' => $theme['tem_key'] . DIRECTORY_SEPARATOR . 'source'. DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR . $module_info['mod_key'] . DIRECTORY_SEPARATOR . $item . DIRECTORY_SEPARATOR . $files,
		'formated' => $theme['tem_key'] . ';' . $item . '---' . $files);


         }  // if




      } // while
   }
 }

}


   return $items_themes_array;



 }

  function set_content_type() {


  		$th = $this->prepare_tfile(basename(wt_set_task($_REQUEST, 'th', $this->template_module_file)));

		$ext1 = substr($th, -8);
		preg_match('/\.(.*).tpl/', $th, $matches_o);

		if( wt_not_null($matches_o[1]) ) {
			switch( $matches_o[1] ) {
			  case 'xml':
				$this->headers['Content-type'] = 'text/xml; charset=UTF-8';
			  break;
			}
		}



	}

  function load_headers() {

  //	ob_start("ob_gzhandler");
	$this->set_content_type();
	if( wt_is_valid( $this->headers, 'array' ) ) {
		foreach($this->headers as $k => $v) {
			header("$k: $v");
		}
		header('Last-Modified: ' . (gmdate('D, d M Y H:i:s')) . ' GMT');
	}

}


	function set_headers($params = array(), $reset = false) {

	if( wt_is_valid($params, 'array') ) {

		if( $reset === true ) {
			$this->headers = $params;
		} else {
			$this->headers = $this->headers+$params;
		}


	}


	}


	function prepare_tfile($tFile) {
		if(substr($tFile, -4) != '.tpl') {
    	$tFile = $tFile . '.tpl';
    	}
		return $tFile;
	}



    function load() {
        global $wt_module, $wt_core_error, $wt_sql, $wt_navigationbar, $wt_user, $wt_block;

       $this->load_filter('output','trimwhitespace');
        $this->countColumn();

		  $css_files = array();
        $css_files[] = '@import "' . CFGF_DIR_WS_TEMPLATES . $this->theme . '/css/main.css?'.filemtime(CFGF_DIR_FS_TEMPLATES . $this->theme . '/css/main.css').'";';

		  if( wt_is_valid($wt_block->block_themes, 'array') )	{

			foreach( $wt_block->block_themes as $bt => $some ) {
			if(file_exists(CFGF_DIR_FS_TEMPLATES . $this->theme . '/css/blocks/' . $bt . '.css'))  {
				$css_files[] = '@import "' . CFGF_DIR_WS_TEMPLATES . $this->theme . '/css/blocks/' . $bt . '.css?'.filemtime(CFGF_DIR_FS_TEMPLATES . $this->theme . '/css/blocks/' . $bt . '.css').'";';
		  }

		}
		}

         $this->assign('__isRoot__', wt_is_root());

              // load module
        $wt_module->load();

    /*
if( wt_check_access('|1|') && !$wt_module->is_manager() ) {
    		$this->load_javascript_to_header('admin_menu.js');
    		$this->add_to_footer( $wt_module->get_admin_functions_menu('template') );
    }
*/


      //  echo $this->theme;

        $this->assign('__moduleTitle__', $wt_module->module_info['mod_title']);
        $this->assign('__moduleDesc__', $wt_module->module_info['mod_desc']);



      //  $this->assign('__pageTitle__', TEXT_SITE_TITLE);

        $this->assign('__mediaRoot__', CFGF_DIR_WS_TEMPLATES . $this->theme . '/media');
        $this->assign('__mediaFSRoot__', CFGF_DIR_FS_MEDIA);

        $this->assign('__imageRoot__', CFGF_DIR_WS_TEMPLATES . $this->theme . '/media/images');
        $this->assign('__cssRoot__', CFGF_DIR_WS_TEMPLATES . $this->theme . '/css');
        $this->assign('__jsRoot__', CFGF_DIR_WS_TEMPLATES . $this->theme . '/js');
         $this->assign('__modulesRoot__', CFG_WS_PATH_TO_DOCUMENT_ROOT . 'modules');
			$this->assign('__templatesRoot__', CFGF_DIR_WS_TEMPLATES);

      //load navigation bar
        $this->assign('__navigationBar__', $wt_navigationbar->draw_breadcrump(' &raquo; '));
		  $this->assign('__navigationBarArray__', $wt_navigationbar->trail);
     // load module css file
        if(file_exists(CFGF_DIR_FS_TEMPLATES . $this->theme . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR . $wt_module->module_info['mod_key'] . '.css')) {
        		$css_files[] = '@import "' . CFGF_DIR_WS_TEMPLATES . $this->theme . '/css/modules/' . $wt_module->module_info['mod_key'] . '.css?'.filemtime(CFGF_DIR_FS_TEMPLATES . $this->theme . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR . $wt_module->module_info['mod_key'] . '.css').'";';
        }

			if(file_exists(CFGF_DIR_FS_TEMPLATES . $this->theme . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . $wt_module->module_info['mod_key'] . '.js')) {
        $this->load_javascript_to_header($wt_module->module_info['mod_key'] . '.js', CFGF_DIR_WS_TEMPLATES . $this->theme . '/js/');
        }



        $this->assign('__metaDesc__', str_replace('"','',$this->meta_desc));
        $this->assign('__metaKeys__', str_replace('"','',$this->meta_keys));
        $this->assign('__siteTitle__', str_replace('"','',$this->site_title));

		  $this->add_to_header('<style type="text/css" media="all">'.implode("\n", $css_files).'</style>');



      if(isset($_GET['CLEAR']) && wt_not_null($_GET['CLEAR'])) {

      if($_GET['CLEAR'] == 'all') {

      $db_theme_query = $wt_sql->db_query("SELECT tem_key FROM " . TABLE_TEMPLATES . "");

      while($db_theme = $wt_sql->db_fetch_array($db_theme_query)) {

         $this->compile_dir = CFGF_DIR_FS_TEMPLATES . $db_theme['tem_key'] . DIRECTORY_SEPARATOR . 'compiled' . DIRECTORY_SEPARATOR;
         $this->clear_compiled_tpl();


      }

      $wt_cache = new wt_cache();
      $wt_cache->clearAll();
      unset($wt_cache);

      wt_rmdir(DIR_FS_WORK);
         wt_create_dir_structure(DIR_FS_WORK);


      die('Oczyszczono kompilacje !!! System przygotowany do eksportu !');
      }
      $this->clear_compiled_tpl();
      }

      if(isset($_GET['MBF']) && $_GET['MBF'] == '1') {
      $params['dirname'] = CFGF_DOCUMENT_FS_ROOT;
      wt_create_blank_files($params);
      }


      if(DEBUG == 'true' || isset($_GET['WT_DEBUG'])) {
include_once('inc/debug.inc.php');
$wt_debug = new wt_debug();
$this->add_to_header($wt_debug->popup_display());
}

        $this->assign('__header__', $this->header);
        $this->assign('__footer__', $this->footer);

		   $this->load_headers();


		if( isset($_REQUEST['display_self']) && $_REQUEST['display_self'] == '1' ) {
			$this->display_self = true;
		} elseif(wt_not_null(wt_set_task($_REQUEST, 'tFile')) && $this->display_self == true) {
			$this->display_self = false;
		}


      if(substr(basename($this->template_module_file), 0, 6) == 'popup_' || ( isset($_REQUEST['th']) && substr(basename($_REQUEST['th']), 0, 6) == 'popup_' ) || $this->display_self === true ) {


      if(isset($_REQUEST['th']) && wt_not_null($_REQUEST['th'])) {
		$this->SetTemplateDir('modules' . DIRECTORY_SEPARATOR . $wt_module->module_info['mod_key'] . '/');
      $this->display($this->prepare_tfile($_REQUEST['th']), null, $wt_module->module_info['mod_key']);
      } else {
		$this->SetTemplateDir(dirname($this->template_module_file) . '/');
      $this->display(basename($this->template_module_file), null, $wt_module->module_info['mod_key']);
      }

      } else {


	 if( isset($_REQUEST['th']) && wt_not_null($_REQUEST['th']) )  {
			$this->load_file($_REQUEST['th']);
	 }

	 $tFile = wt_set_task($_REQUEST, 'tFile', $this->tFile);

    if(wt_not_null($tFile)) {
    $this->display($this->prepare_tfile($tFile));
    } else {
    $this->display('theme.tpl');
    }

      }


    }



}

?>
