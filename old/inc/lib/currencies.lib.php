<?php


  class wt_currencies {
    var $currencies; 
    var $usr_currency;

    function wt_currencies() {
      global $wt_sql, $wt_session, $wt_language;
//fileatime
      $this->currencies = array();
   	
   	$cache = new wt_cache();
    	$cache_key = array();	
  		$cache_key['groups'] = array('mod_currencies');
  		$cache_key['name'] = 'init';
  		$cache_key['dont_add_gr_key'] = true;
   	
    if(!$cache->read($cache_key) ) {			   
      $mod_currencies_manager = wt_module::singleton('mod_currencies_manager');
      
      $db_currencies = $mod_currencies_manager->get_currency();
       
      foreach($db_currencies as $currencie) {
      $this->currencies[$currencie['cr_code']] = $currencie;
      }

     $cache->writeBuffer($this->currencies);
     } else {
     $this->currencies = $cache->getCache();
     } 
       
      
      if($wt_session->exists('currency') && $this->exists($wt_session->value('currency')))    {
		  $this->set_current_currency($wt_session->value('currency'));	
   } else {
        $this->set_current_currency(DEFAULT_CURRENCY);
   }   
	
}


	function set_current_currency($c) {
		global $wt_session;
		if( $this->exists($c) ) {
			$this->usr_currency = $c;
			$wt_session->set('currency', $c);	
		}
	}


    function format($number, $currency_code = '', $currency_value = '') {
      global $wt_session;

      if (!wt_not_null($currency_code) || ($this->exists($currency_code) == false)) {
        $currency_code = $this->usr_currency;
      }

      if (empty($currency_value) || (is_numeric($currency_value) == false)) {
        $currency_value = $this->currencies[$currency_code]['cr_value'];
      }
		$number = round($number * $currency_value, $this->currencies[$currency_code]['cr_decimal_places']);
		
		if($this->currencies[$currency_code]['cr_round'] == 'up') {
			$number = ceil($number);
		}
		if($this->currencies[$currency_code]['cr_round'] == 'down') {
			$number = floor($number);
		}
		
		if( strstr($number, '.') != false ) {
			if( substr($number, -2) == '01' ) {
				$number -= 0.01;			
			}
		}
		

	
      return $this->currencies[$currency_code]['cr_symbol_left'] . number_format($number, $this->currencies[$currency_code]['cr_decimal_places'], NUMERIC_DECIMAL_SEPARATOR, NUMERIC_THOUSANDS_SEPARATOR) . $this->currencies[$currency_code]['cr_symbol_right'];
    }

    function displayPrice($price, $tax_class_id = 0, $quantity = 1, $is_class_id = false) {
      global $wt_tax;

      $price = round($price, $this->currencies[DEFAULT_CURRENCY]['cr_decimal_places']);
      
		if($is_class_id) {
    $tax_class_id = $wt_tax->getTaxRate($tax_class_id);
    
    } 
      if ( $tax_class_id > 0 ) {
        $price += round($price * ($tax_class_id / 100), $this->currencies[DEFAULT_CURRENCY]['cr_decimal_places']);
      }
	
      return $this->format($price * $quantity);
    }
    
    function priceValue($price, $tax_value = 0, $quantity = 1, $is_class_id = false) {
     global $wt_tax;
    
    
    $price = round($price, $this->currencies[DEFAULT_CURRENCY]['cr_decimal_places']);
    
    if($is_class_id) {
    $tax_value = $wt_tax->getTaxRate($tax_value);
    }
    
    $price += round($price * ($tax_value / 100), $this->currencies[DEFAULT_CURRENCY]['cr_decimal_places']) ;
    
      
		$currency_value = $this->currencies[$this->usr_currency]['cr_value'];
		$price = round($price * $currency_value, $this->currencies[$currency_code]['cr_decimal_places']);
		
		if($this->currencies[$this->usr_currency]['cr_round'] == 'up') {
			$price = ceil($price);
		}
		if($this->currencies[$this->usr_currency]['cr_round'] == 'down') {
			$price = floor($price);
		}
	 
	 $price = $price * $quantity;
	 
  if( strstr($price, '.') != false ) {
			if( substr($price, -2) == '01' ) {
				$price -= 0.01;			
			}
		}
    
    return $price;
    
    }
    
    
    
    function displayDiffrence($price1, $price2, $mode = '') {
    
    $mode = ($mode) ? $mode : 'currency';
    $discount = '';
    
	 if( strstr($price1, '.') != false ) {
			if( substr($price1, -2) == '01' ) {
				$price1 -= 0.01;			
			}
		}
		
	 if( strstr($price2, '.') != false ) {
			if( substr($price2, -2) == '01' ) {
				$price2 -= 0.01;			
			}
		}
	 
    if(($mode == 'percent' && $price2 > 0) && $price1 > 0 ) {
     $discount = round((($price1 - $price2) / $price1) * 100);
     return $discount . '%';
    }
    
   if($mode == 'currency' && $price2 > 0) {
    $discount = $this->displayPrice(($price1 - $price2));
     return $discount;
    }
    
   return false;
    
    }

    function exists($code) {
      if (isset($this->currencies[$code])) {
        return true;
      }

      return false;
    }

    function decimalPlaces($code = '') {
    	
    	if(!wt_not_null($code)) {
    		return $this->currencies[$this->usr_currency]['cr_decimal_places'];
    	}
    
      if ($this->exists($code)) {
        return $this->currencies[$code]['cr_decimal_places'];
      }

      return false;
    }

    function value($code = '') {
    
    if(!wt_not_null($code)) {
    		return $this->currencies[$this->usr_currency]['cr_value'];
    	}
    
      if ($this->exists($code)) {
        return $this->currencies[$code]['cr_value'];
      }

      return false;
    }
  }
?>