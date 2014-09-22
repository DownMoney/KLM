<?php

define('EMAIL_LINEFEED', 'some');
define('EMAIL_TRANSPORT', 'other');

class email{

  var $html;
  var $text;
  var $output;
  var $html_text;
  var $html_images;
  var $image_types;
  var $build_params;
  var $attachments;
  var $headers;

  function email($headers = array()){

    $this->html_images  = array();
    $this->headers      = array();

    if (EMAIL_LINEFEED == 'CRLF') {
      $this->lf = "\r\n";
    } else {
      $this->lf = "\n";
    }

    $this->image_types = array(
                  'gif'  => 'image/gif',
                  'jpg'  => 'image/jpeg',
                  'jpeg'  => 'image/jpeg',
                  'jpe'  => 'image/jpeg',
                  'bmp'  => 'image/bmp',
                  'png'  => 'image/png',
                  'tif'  => 'image/tiff',
                  'tiff'  => 'image/tiff',
                  'swf'  => 'application/x-shockwave-flash'
                  );

    $this->build_params['html_encoding']  = 'base64';
    $this->build_params['text_encoding']  = '7bit';
    $this->build_params['html_charset']    = 'UTF-8';
    $this->build_params['text_charset']    = 'UTF-8';
    $this->build_params['text_wrap']    = 600;

    $this->headers[] = 'MIME-Version: 1.0';

    foreach($headers as $value){
      if(!empty($value))
        $this->headers[] = $value;
    }
  }

  function get_file($filename){
      return @file_get_contents($filename);
  }

  function find_html_images() {

    while(list($key,) = each($this->image_types)) {
      $extensions[] = $key;
	 }

    //preg_match_all('/"([^"]+\.('.implode('|', $extensions).'))"/Ui', $this->html, $images);
	 preg_match_all('<img.*src=\"(.*?)\".*>',$this->html, $images);
	
   $cut = strlen(CFG_WS_PATH_TO_DOCUMENT_ROOT);
 
    for($i=0; $i<count($images[1]); $i++){    
    $sub_path = '';   
  /*
 if(substr($images[1][$i], 0, 1) == '/') {   	
   	$image_t = urldecode(CFG_WS_PATH_TO_DOCUMENT_ROOT . $images[1][$i]);
   	$this->html = str_replace($images[1][$i], $image_t, $this->html);
   	$images[1][$i] = $image_t;
   	unset($image_t);
   } 
*/
    
  if(substr($images[1][$i], 0, $cut) == CFG_WS_PATH_TO_DOCUMENT_ROOT) {  
    $sub_path = substr($images[1][$i], $cut, strlen($images[1][$i])-$cut);
    } else {
    $sub_path = $images[1][$i];
    }
   
	if(substr($sub_path,0,7) == 'http://') {
		$html_images[] = $sub_path;
		$image = $sub_path;
	} else {
		$html_images[] = str_replace('//', '/', CFGF_DOCUMENT_FS_ROOT . $sub_path);
		$image = str_replace('//', '/', CFGF_DOCUMENT_FS_ROOT . $sub_path);
	}
      $this->html = str_replace($images[1][$i], md5($image), $this->html);
 }
 
    if(wt_is_valid($html_images, 'array')){
      // If duplicate images are embedded, they may show up as attachments, so remove them.
      $html_images = array_unique($html_images);
      foreach($html_images as $img) {
        if($image = $this->get_file($img)){
			 $content_type = getimagesize($img);
          $this->add_html_image($image, md5($img), $content_type['mime']);
        }
      }
    }
  }

  function add_text($text = '') {
    $this->text = $text;
  }

  function add_html($html, $text = NULL) {
    $this->html      = $html;
    $this->html_text  = $text;
      $this->find_html_images();
  }

  function add_html_image($file, $name = '', $c_type='application/octet-stream'){
    $this->html_images[] = array(
                    'body'   => $file,
                    'name'   => $name,
                    'c_type' => $c_type,
                    'cid'    => md5(uniqid(time()))
                  );
  }

  function add_attachment($file, $name = '', $c_type='application/octet-stream', $encoding = 'base64'){
    $this->attachments[] = array(
                  'body'    => $file,
                  'name'    => $name,
                  'c_type'  => $c_type,
                  'encoding'  => $encoding
                  );
  }

  function &add_text_part(&$obj, $text){

    $params['content_type'] = 'text/plain';
    $params['encoding']     = $this->build_params['text_encoding'];
    $params['charset']      = $this->build_params['text_charset'];
    if(is_object($obj)){
      return $obj->addSubpart($text, $params);
    }else{
      return new mime($text, $params);
    }
  }

  function &add_html_part(&$obj){
    $params['content_type'] = 'text/html';
    $params['encoding']     = $this->build_params['html_encoding'];
    $params['charset']      = $this->build_params['html_charset'];
    if(is_object($obj)){
      return $obj->addSubpart($this->html, $params);
    }else{
      return new mime($this->html, $params);
    }
  }

  function &add_mixed_part(){

    $params['content_type'] = 'multipart/mixed';
    return new mime('', $params);
  }

  function &add_alternative_part(&$obj){

    $params['content_type'] = 'multipart/alternative';
    if(is_object($obj)){
      return $obj->addSubpart('', $params);
    }else{
      return new mime('', $params);
    }
  }

  function &add_related_part(&$obj){

    $params['content_type'] = 'multipart/related';
    if(is_object($obj)){
      return $obj->addSubpart('', $params);
    }else{
      return new mime('', $params);
    }
  }

  function &add_html_image_part(&$obj, $value){

    $params['content_type'] = $value['c_type'];
    $params['encoding']     = 'base64';
    $params['disposition']  = 'inline';
    $params['dfilename']    = $value['name'];
    $params['cid']          = $value['cid'];
    $obj->addSubpart($value['body'], $params);
  }

  function &add_attachment_part(&$obj, $value){

    $params['content_type'] = $value['c_type'];
    $params['encoding']     = $value['encoding'];
    $params['disposition']  = 'attachment';
    $params['dfilename']    = $value['name'];
    $obj->addSubpart($value['body'], $params);
  }

  function build_message($params = array()){
    if(count($params) > 0)
      while(list($key, $value) = each($params))
        $this->build_params[$key] = $value;
    if(!empty($this->html_images))
      foreach($this->html_images as $value)
        $this->html = str_replace($value['name'], 'cid:'.$value['cid'], $this->html);

    $null        = NULL;
    $attachments = !empty($this->attachments) ? TRUE : FALSE;
    $html_images = !empty($this->html_images) ? TRUE : FALSE;
    $html        = !empty($this->html)        ? TRUE : FALSE;
    $text        = isset($this->text)         ? TRUE : FALSE;

    switch(TRUE){

      case $text AND !$attachments:
        $message =& $this->add_text_part($null, $this->text);
        break;

      case !$text AND $attachments AND !$html:
        $message =& $this->add_mixed_part();

        for($i=0; $i<count($this->attachments); $i++)
          $this->add_attachment_part($message, $this->attachments[$i]);
        break;

      case $text AND $attachments:
        $message =& $this->add_mixed_part();
        $this->add_text_part($message, $this->text);

        for($i=0; $i<count($this->attachments); $i++)
          $this->add_attachment_part($message, $this->attachments[$i]);
        break;

      case $html AND !$attachments AND !$html_images:
        if(!is_null($this->html_text)){
          $message =& $this->add_alternative_part($null);
          $this->add_text_part($message, $this->html_text);
          $this->add_html_part($message);
        }else{
          $message =& $this->add_html_part($null);
        }
        break;

      case $html AND !$attachments AND $html_images:
        if(!is_null($this->html_text)){
          $message =& $this->add_alternative_part($null);
          $this->add_text_part($message, $this->html_text);
          $related =& $this->add_related_part($message);
        }else{
          $message =& $this->add_related_part($null);
          $related =& $message;
        }
        $this->add_html_part($related);
        for($i=0; $i<count($this->html_images); $i++)
          $this->add_html_image_part($related, $this->html_images[$i]);
        break;

      case $html AND $attachments AND !$html_images:
        $message =& $this->add_mixed_part();
        if(!is_null($this->html_text)){
          $alt =& $this->add_alternative_part($message);
          $this->add_text_part($alt, $this->html_text);
          $this->add_html_part($alt);
        }else{
          $this->add_html_part($message);
        }
        for($i=0; $i<count($this->attachments); $i++)
          $this->add_attachment_part($message, $this->attachments[$i]);
        break;

      case $html AND $attachments AND $html_images:
        $message =& $this->add_mixed_part();
        if(!is_null($this->html_text)){
          $alt =& $this->add_alternative_part($message);
          $this->add_text_part($alt, $this->html_text);
          $rel =& $this->add_related_part($alt);
        }else{
          $rel =& $this->add_related_part($message);
        }
        $this->add_html_part($rel);
        for($i=0; $i<count($this->html_images); $i++)
          $this->add_html_image_part($rel, $this->html_images[$i]);
        for($i=0; $i<count($this->attachments); $i++)
          $this->add_attachment_part($message, $this->attachments[$i]);
        break;

    }

    if(isset($message)){
      $output = $message->encode();
      $this->output = $output['body'];

      foreach($output['headers'] as $key => $value){
        $headers[] = $key.': '.$value;
      }

      $this->headers = array_merge($this->headers, $headers);
      return TRUE;
    }else
      return FALSE;
  }

function send($to_name, $to_addr, $from_name, $from_addr, $subject = '', $headers = ''){

    $to    = ($to_name != '')   ? '"'.$this->translate($to_name).'" <'.$to_addr.'>' : $to_addr;
    $from  = ($from_name != '') ? '"'.$this->translate($from_name).'" <'.$from_addr.'>' : $from_addr;

    if(is_string($headers))
      $headers = explode($this->lf, trim($headers));

    for($i=0; $i<count($headers); $i++){
      if(is_array($headers[$i]))
        for($j=0; $j<count($headers[$i]); $j++)
          if($headers[$i][$j] != '')
            $xtra_headers[] = $headers[$i][$j];

      if($headers[$i] != '')
        $xtra_headers[] = $headers[$i];
    }
    if(!isset($xtra_headers))
      $xtra_headers = array();

    if (EMAIL_TRANSPORT=="smtp") {
      return mail(
        $to_addr, 
        $this->translate($subject), 
        $this->output,
         'From: ' . $from . $this->lf . 'To: ' . $to . $this->lf . implode($this->lf, $this->headers) . $this->lf . implode($this->lf, $xtra_headers));
    } else {
      return mail($to, $this->translate($subject),  $this->output, 'From: '.$from.$this->lf.implode($this->lf, $this->headers).$this->lf.implode($this->lf, $xtra_headers));
    }
  }

  function get_rfc822($to_name, $to_addr, $from_name, $from_addr, $subject = '', $headers = ''){

    $date = 'Date: '.date('D, d M y H:i:s');

    $to   = ($to_name   != '') ? 'To: "'.$to_name.'" <'.$to_addr.'>' : 'To: '.$to_addr;
    $from = ($from_name != '') ? 'From: "'.$from_name.'" <'.$from_addr.'>' : 'From: '.$from_addr;

    if(is_string($subject))
      $subject = 'Subject: '.$subject;

    if(is_string($headers))
      $headers = explode($this->lf, trim($headers));

    for($i=0; $i<count($headers); $i++){
      if(is_array($headers[$i]))
        for($j=0; $j<count($headers[$i]); $j++)
          if($headers[$i][$j] != '')
            $xtra_headers[] = $headers[$i][$j];

      if($headers[$i] != '')
        $xtra_headers[] = $headers[$i];
    }

    if(!isset($xtra_headers))
      $xtra_headers = array();

    $headers = array_merge($this->headers, $xtra_headers);

    return $date.$this->lf.$from.$this->lf.$to.$this->lf.$subject.$this->lf.implode($this->lf, $headers).$this->lf.$this->lf.$this->output;
  }

  function translate($s) {	
return "=?" . $this->build_params['html_charset'] . "?B?" . base64_encode($s) . "?=";
}

	function send_email($mod,$to,$to_email,$from,$from_email,$mail,$attachments = null) {	
		global $wt_template;
		
		$subject = $mail['subject'];
		$template = $mail['template'];
		$content = $mail['content'];
		
		//$email = new email();
		if (wt_not_null($mail['content'])) {
			$message = $mail['content'];
		} else {
			$wt_template->SetTemplateDir('mails' . DIRECTORY_SEPARATOR . $mod . DIRECTORY_SEPARATOR,'',$mod);
			$message = $wt_template->fetch($template,'',$mod);
			if (stripos($message,'warning') && stripos($message,'Smarty error')) {
				return false;
			}
			$wt_template->SetTemplateDir();
		}
		
		$this->add_html($message);
		if (wt_is_valid($attachments,'array')) {
			foreach ($attachments as $attach) {
				$email->add_attachment($attach['file'],$attach['name']);
			}
		}
		$this->build_message();		
	  	return $this->send($to, $to_email, $from, $from_email, $subject);
	}


}
?>