<?php
	 define('CFG_NEW_DIR_CHMOD', 0777); //0755
	 define('CFG_NEW_FILE_CHMOD', 0777); //0644
		
  define('DB_SERVER', '{DB_HOST}');
  define('DB_SERVER_USERNAME', '{DB_LOGIN}');
  define('DB_SERVER_PASSWORD', '{DB_PASSWORD}');
  define('DB_DATABASE', '{DB_DATABASE}');
  define('DB_PREFIX', '{DB_PREFIX}');

  define('SESSIONS_DB_SERVER', '');
  define('SESSIONS_DB_SERVER_USERNAME', '');
  define('SESSIONS_DB_SERVER_PASSWORD', '');
  define('SESSIONS_DB_DATABASE', '');
  define('SESSIONS_DB_PREFIX', '');
  define('SESSIONS_SECRET', '');

  define('USE_PCONNECT', 'false');
  define('DB_USE_SILENT_MODE_CONNECT', 'true');
  define('STORE_SESSIONS', 'file');
  define('DIRECTORY_SEPARATOR', '/');

  define('CFG_COOKIE_NAME', '{COOKIE_NAME}');
  define('CFG_COOKIE_LIFE', '1');


  if($_SERVER['HTTP_HOST'] == 'testy') {
	  define('HTTP_COOKIE_DOMAIN', '');
  	  define('HTTPS_COOKIE_DOMAIN', '');
	  define('HTTP_COOKIE_PATH', '');
	  define('HTTPS_COOKIE_PATH', '');
  	  define('CFGF_HTTP_SERVER', 'http://testy');
	  define('CFGF_HTTPS_SERVER', 'http://testy');
	  define('CFGF_DIR_WS_HTTP_CATALOG', '{HTTP_TEST_CATALOG}');
	  define('CFGF_DIR_WS_HTTPS_CATALOG', '{HTTP_TEST_CATALOG}');
  } else {
  	  define('HTTP_COOKIE_DOMAIN', '{COOKIE_DOMAIN}');
  	  define('HTTPS_COOKIE_DOMAIN', '{COOKIE_DOMAIN}');
	  define('HTTP_COOKIE_PATH', '{COOKIE_PATH}');
	  define('HTTPS_COOKIE_PATH', '{COOKIE_PATH}');
  	  define('CFGF_HTTP_SERVER', '{HTTP_SERVER}');
	  define('CFGF_HTTPS_SERVER', '{HTTPS_SERVER}');
	  define('CFGF_DIR_WS_HTTP_CATALOG', '{HTTP_CATALOG}');
	  define('CFGF_DIR_WS_HTTPS_CATALOG', '{HTTP_CATALOG}');
  }


  define('CFGF_FILENAME_DEFAULT', 'index.php');

  define('CFGDB_DEFAULT_THEME', 'default');

 if ($request_type == 'NONSSL') {
    define('CFGF_DIR_WS_CATALOG', CFGF_DIR_WS_HTTP_CATALOG);
  } else {
    define('CFGF_DIR_WS_CATALOG', CFGF_DIR_WS_HTTPS_CATALOG);
  }

define('CFG_WS_FULL_PATH_TO_DOCUMENT_ROOT', CFGF_HTTP_SERVER . CFGF_DIR_WS_CATALOG);
define('CFG_WS_PATH_TO_DOCUMENT_ROOT', CFGF_DIR_WS_CATALOG);
define('CFGF_DIR_WS_TEMPLATES', CFG_WS_PATH_TO_DOCUMENT_ROOT . 'templates/');
define('CFGF_DIR_WS_MEDIA', CFG_WS_PATH_TO_DOCUMENT_ROOT . 'media/');

define('CFGF_DOCUMENT_FS_ROOT', substr(dirname(__FILE__), 0, strpos(dirname(__FILE__), 'inc')));
define('DIR_FS_WORK', CFGF_DOCUMENT_FS_ROOT . 'tmp' . DIRECTORY_SEPARATOR);
define('CFGF_DIR_FS_MODULES', CFGF_DOCUMENT_FS_ROOT . 'modules' . DIRECTORY_SEPARATOR);
define('CFGF_DIR_FS_TEMPLATES', CFGF_DOCUMENT_FS_ROOT . 'templates' . DIRECTORY_SEPARATOR);
define('CFGF_DIR_FS_BLOCKS',  CFGF_DOCUMENT_FS_ROOT . 'blocks' . DIRECTORY_SEPARATOR);
define('CFGF_DIR_FS_INCLUDES',  CFGF_DOCUMENT_FS_ROOT . 'inc' . DIRECTORY_SEPARATOR);
define('CFGF_DIR_FS_DRIVERS',  CFGF_DIR_FS_INCLUDES . 'drivers' . DIRECTORY_SEPARATOR);
define('CFGF_DIR_FS_LIBRARY',  CFGF_DIR_FS_INCLUDES . 'lib' . DIRECTORY_SEPARATOR);
define('CFGF_DIR_FS_PLUGINS',  CFGF_DIR_FS_INCLUDES . 'plugins' . DIRECTORY_SEPARATOR);
define('CFGF_DIR_FS_LANGUAGES',  CFGF_DOCUMENT_FS_ROOT . 'languages' . DIRECTORY_SEPARATOR);
define('CFGF_DIR_FS_MEDIA',  CFGF_DOCUMENT_FS_ROOT . 'media' . DIRECTORY_SEPARATOR);
define('CFGF_DIR_FS_WORK', CFGF_DOCUMENT_FS_ROOT . 'tmp' . DIRECTORY_SEPARATOR);

$request_type = (isset($_SERVER['HTTPS']) && (strtolower($_SERVER['HTTPS']) == 'on')) ? 'SSL' : 'NONSSL';

$cookie_domain = (($request_type == 'NONSSL') ? HTTP_COOKIE_DOMAIN : HTTPS_COOKIE_DOMAIN);
$cookie_path = (($request_type == 'NONSSL') ? HTTP_COOKIE_PATH : HTTPS_COOKIE_PATH);

		
?>