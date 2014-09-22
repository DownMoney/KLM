<?php 
/**
* @package core
*/


class wt_language {
    var $languages;
    var $catalog_languages;
    var $browser_languages;
    var $language;
    var $languages_count = 0;
    
    function wt_language($lng = '') {
        global $wt_sql;
        $this->languages = array('ar' => array('ar([-_][[:alpha:]]{2})?|arabic', 'arabic', 'ar'),
        'bg-win1251' => array('bg|bulgarian', 'bulgarian-win1251', 'bg'),
        'bg-koi8r' => array('bg|bulgarian', 'bulgarian-koi8', 'bg'),
        'ca' => array('ca|catalan', 'catala', 'ca'),
        'cs-iso' => array('cs|czech', 'czech-iso', 'cs'),
        'cs-win1250' => array('cs|czech', 'czech-win1250', 'cs'),
        'da' => array('da|danish', 'danish', 'da'),
        'de' => array('de([-_][[:alpha:]]{2})?|german', 'german', 'de'),
        'el' => array('el|greek',  'greek', 'el'),
        'en' => array('en([-_][[:alpha:]]{2})?|english', 'english', 'en'),
        'es' => array('es([-_][[:alpha:]]{2})?|spanish', 'spanish', 'es'),
        'et' => array('et|estonian', 'estonian', 'et'),
        'fi' => array('fi|finnish', 'finnish', 'fi'),
        'fr' => array('fr([-_][[:alpha:]]{2})?|french', 'french', 'fr'),
        'gl' => array('gl|galician', 'galician', 'gl'),
        'he' => array('he|hebrew', 'hebrew', 'he'),
        'hu' => array('hu|hungarian', 'hungarian', 'hu'),
        'id' => array('id|indonesian', 'indonesian', 'id'),
        'it' => array('it|italian', 'italian', 'it'),
        'ja-euc' => array('ja|japanese', 'japanese-euc', 'ja'),
        'ja-sjis' => array('ja|japanese', 'japanese-sjis', 'ja'),
        'ko' => array('ko|korean', 'korean', 'ko'),
        'ka' => array('ka|georgian', 'georgian', 'ka'),
        'lt' => array('lt|lithuanian', 'lithuanian', 'lt'),
        'lv' => array('lv|latvian', 'latvian', 'lv'),
        'nl' => array('nl([-_][[:alpha:]]{2})?|dutch', 'dutch', 'nl'),
        'no' => array('no|norwegian', 'norwegian', 'no'),
        'pl' => array('pl|polish', 'polish', 'pl'),
        'pt-br' => array('pt[-_]br|brazilian portuguese', 'brazilian_portuguese', 'pt-BR'),
        'pt' => array('pt([-_][[:alpha:]]{2})?|portuguese', 'portuguese', 'pt'),
        'ro' => array('ro|romanian', 'romanian', 'ro'),
        'ru-koi8r' => array('ru|russian', 'russian-koi8', 'ru'),
        'ru-win1251' => array('ru|russian', 'russian-win1251', 'ru'),
        'sk' => array('sk|slovak', 'slovak-iso', 'sk'),
        'sk-win1250' => array('sk|slovak', 'slovak-win1250', 'sk'),
        'sr-win1250' => array('sr|serbian', 'serbian-win1250', 'sr'),
        'sv' => array('sv|swedish', 'swedish', 'sv'),
        'th' => array('th|thai', 'thai', 'th'),
        'tr' => array('tr|turkish', 'turkish', 'tr'),
        'uk-win1251' => array('uk|ukrainian', 'ukrainian-win1251', 'uk'),
        'zh-tw' => array('zh[-_]tw|chinese traditional', 'chinese_big5', 'zh-TW'),
        'zh' => array('zh|chinese simplified', 'chinese_gb', 'zh'));
        
    	$cache = new wt_cache();		
		$cache_key = array();
		$cache_key['groups'] = array('core', 'laguages');
		$cache_key['name'] = 'wt_language';	
		$cache_key['dont_add_gr_key'] = true;			
		if(!$cache->read($cache_key)) {
			
        $this->catalog_languages = array();
        $languages_query = $wt_sql->db_query("select * from " . TABLE_LANGUAGES . " ");
        while ($languages = $wt_sql->db_fetch_array($languages_query)) {
            $this->catalog_languages[$languages['code']] = array('id' => $languages['languages_id'],
            'name' => $languages['name'],
            'image' => $languages['image'],
            'directory' => $languages['directory'],
				'code' => $languages['code'],
				'cr_code' => $languages['cr_code'],
				'locale' => $languages['locale'],
				'skip_sefu' => $languages['skip_sefu']);
          }
			$cache->writeBuffer($this->catalog_languages);

		} else {
		$this->catalog_languages = $cache->getCache();
		}	
			
        $this->languages_count = count($this->catalog_languages);
        $this->browser_languages = '';
        $this->language = '';
			
		  if( wt_is_valid($this->catalog_languages, 'array') ) {
		  		foreach($this->catalog_languages as $l) {
					$this->languages[$l['id']] = $l;	
				}	
		  }
		  
        if(wt_not_null($lng) && $this->exists($lng) ) {
            $this->language = $this->catalog_languages[$lng];
        } else {
		  		$this->language = $this->catalog_languages[DEFAULT_LANGUAGE];	
        }
    }
    
    function set_language($lang) {
    	global $wt_session;
    if($this->exists($lang)) {
    	$this->language = $this->catalog_languages[$lang];
		$wt_session->set('language', $this->language['directory']);
	   $wt_session->set('languages_id', $this->language['id']);
		$wt_session->set('language_data', $this->language);
    }
    
    }
	 
	 function get_language($lng) {
    	return $this->catalog_languages[$lng];
    }
	 
	 
	  function wt_load_languages($mod = null) {
 global $wt_module, $wt_session, $wt_template;
       
       $count_language = $this->count_languages();
       
		 if(!wt_not_null($mod)) {
		 	$mod = $wt_module->module_info['mod_key'];
		 }
		 
		 if($count_language > 1) {   
	  //	 wt_print_array( $this->language );
		 $wt_template->assign('__languages__', $this->catalog_languages);	 		}
		 
		 $wt_template->assign('__languagesid__', $this->languages);
		 $wt_template->assign('__languagesCurLanguage__', $this->language);
		 
       if(!@include_once(CFGF_DIR_FS_LANGUAGES.$wt_session->value('language').'.lang.php')) {
		 }                    
        //load module language file
        if(wt_not_null($mod)) {
            if(!@include_once(CFGF_DIR_FS_LANGUAGES.$mod.'/'.$wt_session->value('language').'.lang.php')) {
            } 
        } // if(is_array($wt_module->module_info)) {   
    } // function
	 
    
    function exists($language) {
      if (isset($this->catalog_languages[$language])) {
        return true;
      }
    }
    
    function get_browser_language() {
        $this->browser_languages = explode(',', getenv('HTTP_ACCEPT_LANGUAGE'));
        
        for ($i=0, $n=sizeof($this->browser_languages); $i<$n; $i++) {
            reset($this->languages);
            while (list($key, $value) = each($this->languages)) {
                if (eregi('^(' . $value[0] . ')(;q=[0-9]\\.[0-9])?$', $this->browser_languages[$i]) && isset($this->catalog_languages[$key])) {
                    $this->set_language($key);
						  $key_set = true;	
                    break 2;
                }
            }
        }
       
       if($key_set !== true) {
		 $this->set_language(DEFAULT_LANGUAGE);
       }
    }
	 
function update_language_table($d,$t,$k='',$v='') {
		global $wt_sql;
if( wt_is_valid($d, 'array') && wt_not_null($t) ) {

if(wt_not_null($k) && wt_not_null($v)) {
	$wt_sql->db_perform($t,$d,'update'," ".$k."='".$v."'");
	return;
}
		if( wt_is_valid( $this->catalog_languages, 'array' ) ) {
			foreach($this->catalog_languages as $l) {
				if( wt_is_valid($l['id'], 'int', '0') &&  !wt_not_null($k) && !wt_not_null($v) ) {
						$d['language_id'] = $l['id'];
						$wt_sql->db_perform($t, $d);
				}
			}
		}
	}
} 
       
   function count_languages() {
   	return $this->languages_count;
   }
	
function get_item_languages_status($id,$key,$table,&$db) {
	if(wt_is_valid($id,'int','0') && wt_not_null($table) && wt_not_null($key) && wt_is_valid($db,'object')) {
		$lng = array();
		$db_lang_query = $db->db_query("SELECT language_id, language_status FROM ".$table." WHERE ".$key." = '".$id."' ");
		while($db_lang = $db->db_fetch_array($db_lang_query)) {
			$lng[$db_lang['language_id']] = $db_lang['language_status'];
		}
	} 	
	return $lng;
} 

function update_item_languages_status($id,$key,$table,&$db,$status) {
	if(wt_is_valid($id,'int','0') && wt_not_null($table) && wt_not_null($key) && wt_is_valid($db,'object')) {
		foreach($this->catalog_languages as $l) {
				if( wt_is_valid($l['id'], 'int', '0') ) {
					if( $this->languages_count == 1 ) {
						$s = 1;
					} else {
						if(isset($status['all'])) {
							$s = $status['all'];
						} else {
							$s = (int)$status[$l['id']];
						}
						
					}
					$db->db_perform($table, array('language_status' => $s),'update'," ".$key." = '".$id."' AND  language_id = '".$l['id']."' LIMIT 1");
				}
		}
	} 	
} 
	
	
} // class

?>