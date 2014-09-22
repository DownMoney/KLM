<?php


  class wt_message_stack {
    var $messages;


    function wt_message_stack() {
      $this->messages = array();
    }


    function add($title, $message = '', $type = 'error') {
    
    $this->messages[] = array('type' => $type, 
    									'title' => $title, 
    									'text' => $message,
    									'time' => date('H:i:s'));
    }
    
    

    function add_session($title, $message = '', $type = 'error') {
      global $wt_session;
      
      
      

      if ($wt_session->exists('wt_message_to_stack')) {
        $wt_message_to_stack = $wt_session->value('wt_message_to_stack');
      } else {
        $wt_message_to_stack = array();
      }
      
      wt_core_log::add('admin_action', array($title, $message) );

      $wt_message_to_stack[] = array('title' => $title, 
      										 'text' => $message, 
      										 'type' => $type,
      										 'time' => date('H:i:s'));

      $wt_session->set('wt_message_to_stack', $wt_message_to_stack);

      $this->add($title, $message, $type);
    }

    function reset() {
      $this->messages = array();
    }
    
    

  function output() {
  
   return $this->messages;
  
  }

  function output_last() {
  		global $wt_session;
  		
  $this->loadFromSession();
  
  if($this->messages[(count($this->messages)-1)] && wt_not_null($this->messages[(count($this->messages)-1)])) {
  $last_message = $this->messages[(count($this->messages)-1)];
  $wt_session->set('wt_message_stack_last', $last_message);
  } else {
  $last_message = $wt_session->value('wt_message_stack_last');
  }
  	return $last_message;
  	
  }

    function size($class) {

      return count($this->messages);
    }

    function loadFromSession() {
      global $wt_session;

      if ($wt_session->exists('wt_message_to_stack')) {
        $wt_message_to_stack = $wt_session->value('wt_message_to_stack');

        for ($i = 0, $n = sizeof($wt_message_to_stack); $i < $n; $i++) {
          $this->add($wt_message_to_stack[$i]['title'], $wt_message_to_stack[$i]['text'], $wt_message_to_stack[$i]['type']);
        }

        $wt_session->remove('wt_message_to_stack');
      }
    }
  }
?>
