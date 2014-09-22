<?php


function wt_init_editor($field_array) {

   $ed .= '<script type="text/javascript">' . "\n";

   if(isset($field_array['function_name']) && wt_not_null($field_array['function_name'])) {
   $ed .= $field_array['function_name'] . ' = function () {' . "\n";
   } else {
   $ed .= 'init_editor = function () {' . "\n";
   }

 //	$ed .= 'alert("aaaaa");' . "\n";

   $ed .= ' if(this.fck_loaded != "true") {' . "\n";
   foreach($field_array as $key => $field) {

   $ed .= 'var ' . $field['name'] . '_editor = new FCKeditor( "' . $field['name'] . '" );' . "\n";
   $ed .= $field['name'] . '_editor.BasePath = "' . CFG_WS_PATH_TO_DOCUMENT_ROOT . 'js/editor/fckeditor/";' . "\n";

   $ed .= $field['name'] . '_editor.Width = "' . $field['width'] . '";' . "\n";
   $ed .= $field['name'] . '_editor.Height = "' . $field['height'] . '";' . "\n";
   if(wt_not_null($field['mode'])) {
   $ed .= $field['name'] . '_editor.ToolbarSet = "' . $field['mode'] . '"' . "\n";
   }

   if($key > 0) {
   $ed .= 'setTimeout(function() { ' . "\n";
   $ed .= $field['name'] . '_editor.ReplaceTextarea();' . "\n";
   $ed .= '}, ' . 100*$key . ');' . "\n";
        } else {
    $ed .= $field['name'] . '_editor.ReplaceTextarea();' . "\n";
        }
 }
   $ed .= ' this.fck_loaded = "true";' . "\n";
   $ed .= '}' . "\n";
   $ed .= '}' . "\n";
 /*    $ed .= 'function addEvent(obj, evType, fn)
        {
                if (obj.addEventListener) { obj.addEventListener(evType, fn, true); return true; }
                else if (obj.attachEvent) {  var r = obj.attachEvent("on"+evType, fn);  return r;  }
                else {  return false; }
        }

        addEvent(window, "load", initdocument);' . "\n"; */
     $ed .= '</script>';

 return $ed;


 }
?>
