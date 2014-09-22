<?php 
if(basename(__FILE__) == basename($_SERVER['PHP_SELF'])) { die(); }
 	 define(DB_MODULE_PREFIX, 'mod_');
    define('TABLE_MODULES', DB_PREFIX . 'modules');
    define('TABLE_MODULES_DESCRIPTION', DB_PREFIX . 'modules_description');
    define('TABLE_MODULES_PERMISSION', DB_PREFIX . 'modules_permission');    
    define('TABLE_CONFIGURATION', DB_PREFIX . 'configuration');
    define('TABLE_BLOCKS_TO_MODULES', DB_PREFIX . 'blocks_to_modules');
    define('TABLE_BLOCKS_DESCRIPTION', DB_PREFIX . 'blocks_description');
    define('TABLE_BLOCKS', DB_PREFIX . 'blocks');
  	 define('TABLE_TEMPLATES', DB_PREFIX . 'templates');
  	 define('TABLE_LANGUAGES_TEXTS', DB_PREFIX . 'languages_texts');
  	 define('TABLE_LANGUAGES', DB_PREFIX . 'languages');
?>