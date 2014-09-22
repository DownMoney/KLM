<?php 


		class wt_debug {
		
		
			function wt_debug() {

			}
			
			
			function debug_header() {
			
			
			$header = '<HTML><HEAD>';
			$header .= '<meta http-equiv="Content-type" content="text/html; charset=iso-8859-2">';
			$header .= '<TITLE>Arena Debug</TITLE>';
			$header .= '<SCRIPT language=javascript>' . "\n\n";
		  	$header .= "function mosDHTML(){ 
	this.ver=navigator.appVersion
	this.agent=navigator.userAgent
	this.dom=document.getElementById?1:0
	this.opera5=this.agent.indexOf('Opera 5')<-1
	this.ie5=(this.ver.indexOf('MSIE 5')<-1 && this.dom && !this.opera5)?1:0; 
	this.ie6=(this.ver.indexOf('MSIE 6')<-1 && this.dom && !this.opera5)?1:0;
	this.ie4=(document.all && !this.dom && !this.opera5)?1:0;
	this.ie=this.ie4||this.ie5||this.ie6
	this.mac=this.agent.indexOf('Mac')<-1
	this.ns6=(this.dom && parseInt(this.ver) <= 5) ?1:0; 
	this.ns4=(document.layers && !this.dom)?1:0;
	this.bw=(this.ie6||this.ie5||this.ie4||this.ns4||this.ns6||this.opera5);

	this.activeTab = '';
	this.onTabStyle = 'ontab';
	this.offTabStyle = 'offtab';

	this.setElemStyle = function(elem,style) {
		document.getElementById(elem).className = style;
	}
	this.showElem = function(id) {
		if (elem = document.getElementById(id)) {
			elem.style.visibility = 'visible';
			elem.style.display = 'block';
		}
	}
	this.hideElem = function(id) {
		if (elem = document.getElementById(id)) {
			elem.style.visibility = 'hidden';
			elem.style.display = 'none';
		}
	}
	this.cycleTab = function(name) {
		if (this.activeTab) {
			this.setElemStyle( this.activeTab, this.offTabStyle );
			page = this.activeTab.replace( 'tab', 'page' );
			this.hideElem(page);
		}
		this.setElemStyle( name, this.onTabStyle );
		this.activeTab = name;
		page = this.activeTab.replace( 'tab', 'page' );
		this.showElem(page);
	}
	return this;
}

var dhtml = new mosDHTML();" . "\n\n";
         $header .= '</script>'; 
		 	$header .= '<style type="text/css">
		 	
.offtab {
	font-family : Arial, Helvetica, sans-serif;
	font-size: 12px;
   background-color : #F0F1F1;
	border-left: solid 1px #C0BCC0;
	border-right: solid 1px #C0BCC0;
	border-top: solid 1px #C0BCC0;
	border-bottom: solid 1px #C0BCC0;
	width: 14%;
	text-align: center;
	cursor: pointer;
	font-weight: normal;
	color: #C0BCC0;
} 

.separator {

border-bottom: solid 1px #888888;
}

.ontab {
	font-family : Arial, Helvetica, sans-serif;
	font-size: 12px;
	background-color: #F0F1F1;
	border-left: solid 1px #888888;
	border-right: solid 1px #888888;
	border-top: solid 3px #FF9900;
	border-bottom: solid 3px #FF9900;
	text-align: center;
	cursor: pointer;
	font-weight: bold;
	color: #000000;
	
	
} 

.pagetext {
	visibility: hidden;
	display: none;
	position: relative;
	top: 0;
}

</style>' . "\n\n"; 
			$header .= '</HEAD><BODY bgcolor="#4682B4">';
			$header .= '<table width="95%" height="95%" bgcolor="#FFFFFF" style="border: 1px solid #000099;" align="center">';
			$header .= '<tr>';
			$header .= '<td valign="top" width="100">';
			
			$header .= '<table cellspacing="0" cellpadding="4" border="0" width="100%" >';
  			$header .= '<tr>';
    		$header .= '';
    		$header .= '<td id="tab1" class="offtab" onClick="dhtml.cycleTab(this.id)">Błędy</td></tr><tr>';
    		
    		$header .= '<td id="tab2" class="offtab" onClick="dhtml.cycleTab(this.id); init_editor();">SQL</td></tr><tr>';
    	
    		$header .= '<td id="tab3" class="offtab" onClick="dhtml.cycleTab(this.id)"><nobr>Template</nobr></td></tr><tr>';
    	
    		$header .= '<td id="tab4" class="offtab" onClick="dhtml.cycleTab(this.id)"><nobr>Bloki</nobr></td></tr><tr>';
    	
    		$header .= '<td id="tab5" class="offtab" onClick="dhtml.cycleTab(this.id)"><nobr>Moduł</nobr></td></tr><tr>';
    		
    		$header .= '<td id="tab6" class="offtab" onClick="dhtml.cycleTab(this.id)"><nobr>Sesja</nobr></td>';
    		
    		$header .= '</tr>';
    		$header .= '</table>';
			$header .= '</td>';
			$header .= '';
			$header .= '<td valign="top">';
		
			return $header;
			}
			
			function debug_footer() {
			
			$footer = '<script language="javascript" type="text/javascript"><!--
dhtml.cycleTab("tab1");

		//-->
</script> </td></tr>' . "\n";
			$footer .= '</table>' . "\n";
			$footer .= '</body>' . "\n";
			$footer .= '</html>' . "\n";
			return $footer;
			}
			
		
			function popup_display() {
				global $wt_module, $wt_sql, $wt_core_error, $wt_block, $wt_template;
		  $string = '<SCRIPT language=javascript>' . "\n\n";
		  $string .= 'if( self.name == "" ) { ' . "\n";
	     $string .= 'var title = "Console";' . "\n";
	     $string .= ' } else { ' . "\n";           
	     $string .= 'var title = "Console_"+ self.name;' . "\n";          
	     $string .= '}' . "\n\n"; 
	     
		  $string .= 'wt_consoleWindow = window.open("",title.value,"width=800,height=600,resizable,scrollbars=yes");' . "\n";	
	  	     
	     $string .= 'wt_consoleWindow.document.write("' . $this->escape_java_chars($this->debug_header()) . '");' . "\n";
	     
	     
	     $string .= 'wt_consoleWindow.document.write("<div class=\\"pagetext\\" id=\\"page1\\"> ' . $this->escape_java_chars($this->debug_print_var($wt_core_error)) . '");' . "\n";
	    
	     $string .= 'wt_consoleWindow.document.write("</div>");' . "\n";	     
	     
	     
	     $string .= 'wt_consoleWindow.document.write("<div class=\\"pagetext\\" id=\\"page2\\"> <b>Zapytań do bazy:</b>' . $this->escape_java_chars($wt_sql->q_count) . '<br>");' . "\n";
	     $string .= 'wt_consoleWindow.document.write("<b>Zapytania:</b><br>");' . "\n";
	     $string .= 'wt_consoleWindow.document.write(" <pre>' . $this->escape_java_chars(print_r($wt_sql->debug, true)) . '</pre>");' . "\n";
	     $string .= 'wt_consoleWindow.document.write("</div>");' . "\n";
	     
	     
	     $string .= 'wt_consoleWindow.document.write("<div class=\\"pagetext\\" id=\\"page3\\"> <pre>' . $this->escape_java_chars(print_r($wt_template, true)) . '</pre>");' . "\n";
	     $string .= 'wt_consoleWindow.document.write("</div>");' . "\n";	
	     
	     
        $string .= 'wt_consoleWindow.document.write("<div class=\\"pagetext\\" id=\\"page4\\"> <pre>' . $this->escape_java_chars(print_r($wt_block, true)) . '</pre>");' . "\n";
	     $string .= 'wt_consoleWindow.document.write("</div>");' . "\n";	
	     
	     $string .= 'wt_consoleWindow.document.write("<div class=\\"pagetext\\" id=\\"page5\\"> <pre>' . $this->escape_java_chars(print_r($wt_module, true)) . '</pre>");' . "\n";
	     $string .= 'wt_consoleWindow.document.write("</div>");' . "\n";	
	     
	      $string .= 'wt_consoleWindow.document.write("<div class=\\"pagetext\\" id=\\"page6\\"> <pre>' . $this->escape_java_chars(print_r($_SESSION, true)) . '</pre>");' . "\n";
	     $string .= 'wt_consoleWindow.document.write("</div>");' . "\n";
	     
	     $string .= 'wt_consoleWindow.document.write("' . $this->escape_java_chars($this->debug_footer()) . '");' . "\n";
		  $string .= '</script>' . "\n";		
					
					
				 return $string;		
			}
			
			
			function debug_print_var($var, $depth = 0, $length = 40)
{
    $_replace = array("\n"=>'<i>&#92;n</i>', "\r"=>'<i>&#92;r</i>', "\t"=>'<i>&#92;t</i>');
    if (is_array($var)) {
        $results = "<b>Array (".count($var).")</b>";
        foreach ($var as $curr_key => $curr_val) {
            $return = $this->debug_print_var($curr_val, $depth+1, $length);
            $results .= "<br>".str_repeat('&nbsp;', $depth*2)."<b>".strtr($curr_key, $_replace)."</b> =&gt; $return";
        }
    } else if (is_object($var)) {
        $object_vars = get_object_vars($var);
        $results = "<b>".get_class($var)." Object (".count($object_vars).")</b>";
        foreach ($object_vars as $curr_key => $curr_val) {
            $return = $this->debug_print_var($curr_val, $depth+1, $length);
            $results .= "<br>".str_repeat('&nbsp;', $depth*2)."<b>$curr_key</b> =&gt; $return";
        }
    } else if (is_resource($var)) {
        $results = '<i>'.(string)$var.'</i>';
    } else if (empty($var) && $var != "0") {
        $results = '<i>empty</i>';
    } else {
        if (strlen($var) > $length ) {
           // $results = substr($var, 0, $length-3).'...';
           $results = $var;
        } else {
            $results = $var;
        }
        $results = htmlspecialchars($results);
        $results = strtr($results, $_replace);
    }
    return $results;
}


   function escape_java_chars($string) {
   
   if($string != '' ) {
   
   return strtr($string, array('\\'=>'\\\\',"'"=>"\\'",'"'=>'\\"',"\r"=>'\\r',"\n"=>'\\n','</'=>'<\/'));
   
   }
   
   }
		
		}




?>
