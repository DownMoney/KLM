<?php
/**
* @package core
*/



  class splitPageResults {
     var $pages_array = array('5' => '5',
     									'10' => '10',
     									'15' => '15',
     									'20' => '20',
     									'30' => '30',
     									'50' => '50',
     									'100' => '100',
     									'200' => '200');
     var $max_rows_per_page = '20';
     var $db;
	  var $current_page_number;


    function splitPageResults($current_page_number, $max_rows_per_page, &$sql_query, &$query_num_rows, $count_key = '*', $db = '', $params = array()) {
     global $wt_sql, $wt_session, $wt_module;
  		if( !isset($current_page_number) || $current_page_number == 0 ) {
			$current_page_number = 1;
		}
		$this->current_page_number	= $current_page_number;

  		if( isset($db) && is_object($db) ) {
  			$this->db = &$db;
  		} else {
  			$this->db = &$wt_sql;
		}

  if($wt_module->module_info['mod_type'] == 'manager') {
      if($_REQUEST['results_to_display'] && wt_not_null($_REQUEST['results_to_display'])) {
      $wt_session->set('results_to_display', $_REQUEST['results_to_display']);
      $this->max_rows_per_page = $_REQUEST['results_to_display'];
      } else if(!wt_not_null($wt_session->value('results_to_display'))) {
      $wt_session->set('results_to_display', $max_rows_per_page);
      $this->max_rows_per_page = $max_rows_per_page;
      } else {
      $this->max_rows_per_page = $wt_session->value('results_to_display');
      }
   } else {
      $this->max_rows_per_page = $max_rows_per_page;
   }


   if( !wt_is_valid($this->max_rows_per_page, 'int', 0) ) {
		if(defined('MAX_DISPLAY_SEARCH_RESULTS') && wt_is_valid(MAX_DISPLAY_SEARCH_RESULTS, 'int', 0) ) {
			$this->max_rows_per_page = MAX_DISPLAY_SEARCH_RESULTS;
		} else {
			$this->max_rows_per_page = 50;
		}
	}

      if (empty($current_page_number)) $current_page_number = 1;

      $pos_to = strlen($sql_query);
      $pos_from = strrpos($sql_query, ' FROM', 0);

      $pos_group_by = strpos($sql_query, ' GROUP BY', $pos_from);
      if (($pos_group_by < $pos_to) && ($pos_group_by != false)) $pos_to = $pos_group_by;

      $pos_having = strpos($sql_query, ' HAVING', $pos_from);
      if (($pos_having < $pos_to) && ($pos_having != false)) $pos_to = $pos_having;

      $pos_order_by = strpos($sql_query, ' ORDER BY', $pos_from);
      if (($pos_order_by < $pos_to) && ($pos_order_by != false)) $pos_to = $pos_order_by;

		if ((strpos($sql_query, 'DISTINCT') || strpos($sql_query, 'GROUP BY')) && $count_key != '*') {
        $count_string = 'DISTINCT ' . $count_key;
      } else {
        $count_string = $count_key;
      }

		$query = "SELECT count(".$count_string.") AS total " . substr($sql_query, $pos_from, ($pos_to - $pos_from));

		if(wt_is_valid($params['cache_groups'],'array')) {
			$cache = new wt_cache();
			$cache_key = array();
			$cache_key['groups'] = $params['cache_groups'];
			$cache_key['name'] = 'split_'.md5($query);
			if(!$cache->read($cache_key,$params['cache_life']) || isset($params['no_cache'])) {
				$reviews_count_query = $this->db->db_query($query);
      		$reviews_count = $this->db->db_fetch_array($reviews_count_query);
				$cache->writeBuffer($reviews_count);
			} else {
				$reviews_count = $cache->getCache();
			}
		} else {
				$reviews_count_query = $this->db->db_query($query);
      		$reviews_count = $this->db->db_fetch_array($reviews_count_query);
		}

      $query_num_rows = $reviews_count['total'];

      $this->num_pages = ceil($query_num_rows / $this->max_rows_per_page);
      if ($current_page_number > $this->num_pages) {
        $current_page_number = $this->num_pages;
      }
      $this->offset = ($this->max_rows_per_page * ($current_page_number - 1));

      if($this->offset < 0) {
      $this->offset = 0;
      }

      $sql_query .= " limit " . $this->offset . ", " . $this->max_rows_per_page;
    }

    function display_links($query_numrows, $max_rows_per_page, $max_page_links, $current_page_number, $parameters = '', $page_name = 'page') {
      global $PHP_SELF, $wt_session, $wt_module;

		if( !wt_is_valid($current_page_number, 'int', '0') ) {
	 	$current_page_number = 1;
	 }

      if ( wt_not_null($parameters) && (substr($parameters, -1) != '&') ) $parameters .= '&';

      $num_pages = ceil($query_numrows / $this->max_rows_per_page);

      $pages_array = array();
      for ($i=1; $i<=$num_pages; $i++) {
        $pages_array[] = array('id' => $i, 'text' => $i);
      }

      if ($num_pages > 1) {
        $display_links = '<form action="' . wt_href_link('', '', wt_get_all_get_params(array('page')), '', 'NONSSL', false, false) . '" method="GET" name="pages">';

        if ($current_page_number > 1) {
          $display_links .= '<a href="' . wt_href_link('', '', wt_get_all_get_params(array('page', 'mod')) . $page_name . '=' . ($current_page_number - 1), '', 'NONSSL', false) . '" class="splitPageLink">&laquo;</a>&nbsp;';
        } else {
          $display_links .= '&laquo;&nbsp;';
        }

        $display_links .= TEXT_SPLITPAGE_PAGE.' <select name="' . $page_name . '" onChange="this.form.submit();">';
        foreach($pages_array as $p) {
                         $display_links .= '<option value="' . $p['id'] . '"';
                         if($current_page_number == $p['id']) {
                         $display_links .= ' SELECTED';
                         }
                         $display_links .= '>' . $p['id'] . '</option>';
        }
        $display_links .= '</select> '.TEXT_SPLITPAGE_FROM.' ' . $num_pages;


        if (($current_page_number < $num_pages) && ($num_pages != 1)) {
          $display_links .= '&nbsp;<a href="' . wt_href_link('', '', wt_get_all_get_params(array('page')) . $page_name . '=' . ($current_page_number + 1), '', 'NONSSL', false) . '" class="splitPageLink">&raquo;</a>';
        } else {
          $display_links .= '&nbsp;&raquo;';
        }

        $parameters = 'mod=' . $_REQUEST['mod'] . '&' . wt_get_all_get_params(array('page'));

        if ($parameters != '') {
          if (substr($parameters, -1) == '&') $parameters = substr($parameters, 0, -1);
          $pairs = explode('&', $parameters);
          while (list(, $pair) = each($pairs)) {
            list($key,$value) = explode('=', $pair);
            $display_links .= '<input type="hidden" name="' . rawurldecode($key) . '" value="' . rawurldecode($value) . '">';
          }
        }

        if (SID) $display_links .= '<input type="hidden" name="' . $wt_session->name . '" value="' . $wt_session->id . '">';

        $display_links .= '</form>';
      } else {
        $display_links = sprintf(TEXT_SPLITPAGE_PAGE.' %s '.TEXT_SPLITPAGE_FROM.' %s', $num_pages, $num_pages);
      }

      return $display_links;
    }

    function display_text_links($max_page_links, $params = array()) {

    	if( !wt_is_valid($max_page_links, 'int', '0') ) {
    		$max_page_links = 10;
    	}

    	$display_links_string = '';
    	if ($this->current_page_number > 1) {
    		$display_links_string .= '<a class="p" href="' . wt_href_link('', '', wt_get_all_get_params( array('page') ) . 'page=' . ($this->current_page_number - 1), '', 'NONSSL', false) . '"  title=" poprzednia strona ">&laquo;</a>';
    	}

    	//$this->current_page_number / $max_page_links);
    	//$max_window_num = intval($this->num_pages / $max_page_links);
    	$max_page_links= 3;
    	if ($this->current_page_number-$max_page_links<=1) {
    		$start_page = 1;
    	} else {
    		$start_page = $this->current_page_number-$max_page_links;
    	}

    	if ($this->current_page_number+$max_page_links>=$this->num_pages) {
    		$end_page = $this->num_pages;
    	} else {
    		$end_page = $this->current_page_number + $max_page_links;
    	}




    	for ($jump_to_page=$start_page;($jump_to_page <= $end_page); $jump_to_page++) {
    		if ($jump_to_page == $this->current_page_number) {
    			$display_links_string .= '<b>' . $jump_to_page . '</b>';
    		} else {
    			$display_links_string .= '<a class="pa" id="navPa'.$jump_to_page.'" href="' . wt_href_link('', '', wt_get_all_get_params( array('page') ) . 'page=' . $jump_to_page, '', 'NONSSL', false) . '" title="  ">' . $jump_to_page . '</a>';
    		}
//    		$_i++;
    	}

   /* 	if ($cur_window_num < $max_window_num) {
    		$display_links_string .= '<a href="' . wt_href_link('', '', wt_get_all_get_params( array('page') ) . 'page=' . (($cur_window_num) * $max_page_links + 1), '', 'NONSSL', false, false )  . '"  title=" ">...</a> ';
    	}*/


    	if (($this->current_page_number < $this->num_pages) && ($this->num_pages != 1) ) {
    		$display_links_string .= '<a class="n" href="' . wt_href_link('', '', wt_get_all_get_params( array('page') ) . 'page=' . ($this->current_page_number + 1), '', 'NONSSL', false) . '" title=" ">&raquo;</a>';
    	}

    	return $display_links_string;
    }

    /*function display_text_links($max_page_links, $params = array()) {

    	if( !wt_is_valid($max_page_links, 'int', '0') ) {
    		$max_page_links = 20;
    	}

    	$display_links_string = '';
    	if ($this->current_page_number > 1) {
    		$display_links_string .= '<a href="' . wt_href_link('', '', wt_get_all_get_params( array('page') ) . 'page=' . ($this->current_page_number - 1), '', 'NONSSL', false, false) . '"  title=" poprzednia strona ">&laquo;</a> ';
    	}

    	// check if number_of_pages > $max_page_links
    	$cur_window_num = intval($this->current_page_number / $max_page_links);
    	if ($this->current_page_number % $max_page_links) {
    		$cur_window_num++;
    	}

    	$max_window_num = intval($this->num_pages / $max_page_links);
    	if ($this->num_pages % $max_page_links) {
    		$max_window_num++;
    	}

    	if ($cur_window_num > 1) {
    		$display_links_string .= '<a href="' . wt_href_link('', '', wt_get_all_get_params( array('page') ) . 'page=' . ($cur_window_num - 1) * $max_page_links, '', 'NONSSL', false, false) . '" title=" więcej stron ">...</a>';
    	}

    	$_i = 0;
    	for ($jump_to_page = 1 + (($cur_window_num - 1) * $max_page_links); ($jump_to_page <= ($cur_window_num * $max_page_links)) && ($jump_to_page <= $this->num_pages); $jump_to_page++) {
    		if ($_i > 0) $display_links_string .= $sep;
    		if ($jump_to_page == $this->current_page_number) {
    			$display_links_string .= '<b>' . $jump_to_page . '</b>';
    		} else {
    			$display_links_string .= '<a href="' . wt_href_link('', '', wt_get_all_get_params( array('page') ) . 'page=' . $jump_to_page, '', 'NONSSL', false, false) . '" title="  ">' . $jump_to_page . '</a>';
    		}
    		$_i++;
    	}

    	if ($cur_window_num < $max_window_num) {
    		$display_links_string .= '<a href="' . wt_href_link('', '', wt_get_all_get_params( array('page') ) . 'page=' . (($cur_window_num) * $max_page_links + 1), '', 'NONSSL', false, false )  . '"  title=" ">...</a> ';
    	}


    	if (($this->current_page_number < $this->num_pages) && ($this->num_pages != 1) ) {
    		$display_links_string .= ' <a href="' . wt_href_link('', '', wt_get_all_get_params( array('page') ) . 'page=' . ($this->current_page_number + 1), '', 'NONSSL', false, false ) . '" title=" ">&raquo;</a>';
    	}

    	return $display_links_string;
    }*/



    function display_to_display() {
     global $wt_session;

     $display_to_display = '<form action="' . wt_href_link('', '', wt_get_all_get_params(array('page')), '', 'NONSSL', false, false) . '" method="GET" name="results_to_display">';


     $display_to_display .= '<input type="text" size="3" name="results_to_display" value="' . (($wt_session->value('results_to_display')) ? $wt_session->value('results_to_display') : '20') . '">';

     $display_to_display .= '<a href="javascript:document.forms.results_to_display.submit();">&raquo;</a> wyników';

   /*   $display_to_display .= 'Wy&#182;wietlaj <select name="results_to_display" onChange="submit(this.form);">';

     foreach($this->pages_array as $key => $val) {
     $display_to_display .= '<option value="' . $key . '"';

    if( (wt_not_null($wt_session->value('results_to_display')) && $key == $wt_session->value('results_to_display') ) || ($key == $this->max_rows_per_page) ) {
     $display_to_display .= ' SELECTED>';
     } else {
     $display_to_display .= '>';
     }

     $display_to_display .= $val . '</option>';
     }



     $display_to_display .= '</select> wynik&#55958;&#56699; */

     $parameters = 'mod=' . $_REQUEST['mod'] . '&' . wt_get_all_get_params(array('results_to_display'));

        if ($parameters != '') {
          if (substr($parameters, -1) == '&') $parameters = substr($parameters, 0, -1);
          $pairs = explode('&', $parameters);
          while (list(, $pair) = each($pairs)) {
            list($key,$value) = explode('=', $pair);
            $display_to_display .= '<input type="hidden" name="' . rawurldecode($key) . '" value="' . rawurldecode($value) . '">';
          }
        }

        if (SID) {
        $display_to_display .= '<input type="hidden" name="' . $wt_session->name . '" value="' . $wt_session->id . '">';
     }
     $display_to_display .= '</form>';

     return $display_to_display;
    }

    function display_count($query_numrows, $max_rows_per_page, $current_page_number, $text_output) {
	 if( !wt_is_valid($current_page_number, 'int', '0') ) {
	 	$current_page_number = 1;
	 }
      $to_num = ($this->max_rows_per_page * $current_page_number);
      if ($to_num > $query_numrows) $to_num = $query_numrows;
      $from_num = ($this->max_rows_per_page * ($current_page_number - 1));
      if ($to_num == 0) {
        $from_num = 0;
      } else {
        $from_num++;
      }

      return sprintf($text_output, $from_num, $to_num, $query_numrows);
    }
  }
?>