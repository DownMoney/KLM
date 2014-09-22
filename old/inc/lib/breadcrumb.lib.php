<?php

  class wt_breadcrumb {
    var $trail;
    var $class = 'Nav';
    var $last_class = 'lastNav';

    function wt_breadcrumb() {
      $this->reset();
    }

    function reset() {
      $this->trail = array();
    }

    function add($title, $link = '', $target = '') {
      $this->trail[] = array('title' => $title, 'link' => $link, 'target' => $target);
    }

    function draw_breadcrump($separator = ' - ') {
      $trail_string = '';

      $n = sizeof($this->trail);
      
      if($n > 1) {
      
      for ($i=0; $i<$n; $i++) {
      if(($i+1) == $n) {
        $class = 'breadcrumbLast';
        } elseif($i == '0') {
        $class = 'breadcrumbFirst';
        } else {
		  $class = '';	
		  }
        
      if( wt_not_null($this->trail[$i]['target']) ) {
      $target = 'target="' . $this->trail[$i]['target'] . '"';
      } else {
      $target = null;
      }
        
        
        
        if (isset($this->trail[$i]['link']) && wt_not_null($this->trail[$i]['link'])) {
        
                
          $trail_string .= '<a ' . ( ($class) ? 'class="' . $class . '"' : '') . ' href="' . $this->trail[$i]['link'] . '"  ' . $target . ' >' . $this->trail[$i]['title'] . '</a>';
        } else {
          $trail_string .= '<span class="' . $class . '">' . $this->trail[$i]['title'] . '</span>';
        }

        if (($i+1) < $n) $trail_string .= $separator;
      }

      }
      
      return $trail_string;
    } 
  }
  
?>