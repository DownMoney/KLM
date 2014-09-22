setCheckBoxByClassName = function(ch,className) {
  list_elems =	$$('input.'+className);	
		for(i=0; i<list_elems.length;i++) {
			if(list_elems[i].checked != ch ) {
				list_elems[i].checked = ch;
			}
		}
}

function in_array(a,s,b,i,t){
for(i in a){t=a[i]==s;b?t=a[i]===s:'';if(t)break}return t||!1
}

var Indicator = Class.create();
Indicator.prototype = {

	initialize: function(options) {
	
	},

  init: function(offsetX, offsetY) {
    this.offsetX = offsetX || 8;
    this.offsetY = offsetY || 5;    
    
    var body = document.getElementsByTagName('body')[0];
    
    new Insertion.Bottom(
      body, 
      '<div id="indicator" style="z-index: 9999; position:absolute; width:20px; height:20px; padding:6px; display: none; "><img src="templates/admin2/media/images/indicator.gif" border="0"></div>' 
    );
    
    this.indicator = $('indicator');
        
    Event.observe(body, "mousemove", this.onMouseMove.bind(this));
  },
  
  onMouseMove: function(event) {
    try {
    this.indicator.style.top    = Event.pointerY(event) + this.offsetY + "px";         
    this.indicator.style.left   = Event.pointerX(event) + this.offsetX + "px"; 
    } catch(e) {}
  },
      
  indicate: function(visible) {
    if(visible) { this.indicator.show() }
    else        { this.indicator.hide() }
  }
}
//var progressIndicator = new Indicator();
//Event.observe(window, "load", function(){ progressIndicator.init(); });


var ADM_TableNavigation = Class.create();

ADM_TableNavigation.prototype = {

initialize: function(options) {
		this.options = {
		};
		this.currentPanel = '';
		  Object.extend(this.options, options || {});
			
		  var elementList = document.getElementsByClassName("topNav");	
			
		  if( elementList.length > 0 ) {
			
		  	for( i=0; i<elementList.length; i++ ) {
				
			  var	item = elementList[i];
				
				if(item.id != '' && $(item.id+'_con')) {
				  					
					Event.observe(item, 'click', function(e) {
					this.togglePanels(e);
					}.bind(this)  );
				}
			}	
		  }	
	},

	togglePanels: function(e) {
		
	  	it = Event.element(e);
		tab = it.id+'_con';
		$(it.id+'_con').style.left = Event.pointerX(e)+'px';	
		
	if( this.currentPanel == tab ) {
		$(this.currentPanel).hide();
		it.style.color = '';
		this.currentPanel = ''; 
		return;
		
	}
	
	if( this.currentPanel != '' ) {
	  Element.toggle(this.currentPanel);	
	  $(this.currentAnchorID).style.color = '';	
	}  
	  Element.toggle(tab);
	  it.style.color = '#F00';  
	  this.currentPanel = tab; 
	  this.currentAnchorID = it.id;
	} //function
	
	

}// class

var ADM_TableList = Class.create();

ADM_TableList.prototype = {

	initialize: function(options) {
		this.options = {
		className: 'tableList',
		rowsName: 'row_',
		statusChangeType: 'base',
		page: '1'
		};
		
		  Object.extend(this.options, options || {});
			
		  if( this.options.cellsEditURL && this.options.cellsEdit ) {
		  		this.prepareCellEdit();	
		  }	
			
	},

prepareCellEdit: function() {
	list_elems = $('data_table_content').getElementsByTagName('TR');
		
		for(i=0; i<list_elems.length;i++) {
		if( list_elems[i].id.substr(0,4) == this.options.rowsName && list_elems[i].hasChildNodes() ) {
				
			 var td_lists = list_elems[i].getElementsByTagName('TD');
					
			  		for(c=0; c<td_lists.length;c++) {
						  var cell = td_lists[c];													
						if( cell.nodeName == 'TD' && this.options.cellsEdit[c] && this.options.cellsEdit[c].length > 0 ) {
						var key = this.options.cellsEdit[c][0];
						var type = this.options.cellsEdit[c][1];
					
Event.observe(cell, 'dblclick', function(e) {
	this.makeCellEdit(e.currentTarget, key, type );							 
							}.bind(this), false  );

						}
					}
			}
	}
	
	
},


makeCellEdit: function(cell, key, type) {
	var val = cell.innerHTML;
	cell.innerHTML = '<input style="width:100%;" type="text" value="'+val+'">';
},
	
loadRowItemInfo: function(id) {


if( $(this.options.rowsName+'info_'+id) ) {

Element.toggle( this.options.rowsName+'info_'+id );

if( Element.visible( this.options.rowsName+'info_'+id ) ) {
$(this.options.rowsName+'make_info_'+id).src = this.options.imageRoot+'/minus.gif';
} else {
$(this.options.rowsName+'make_info_'+id).src = this.options.imageRoot+'/plus.gif';
}


	
} else {
this.makeRowItemInfo(id);
$(this.options.rowsName+'info_'+id).show();
$(this.options.rowsName+'make_info_'+id).src = this.options.imageRoot+'/minus.gif';
}

},



setRowClick: function(id, elem) {
//xshow(elem);
	if( $(this.options.rowsName+'checkbox_'+id).checked == true ) {
		$(this.options.rowsName+'checkbox_'+id).checked = false;
	} else {
		$(this.options.rowsName+'checkbox_'+id).checked = true;
	}
	this.setRowChecked(id);
},

setRowChecked: function(id) {

	if( $(this.options.rowsName+'checkbox_'+id).checked == true ) {
		$(this.options.rowsName+id).addClassName('rowChecked');
	} else {
		$(this.options.rowsName+id).removeClassName('rowChecked');
	}
},

openCloseRowItems: function(o, c) {

	list_elems = $('data_table_content').getElementsByTagName('TR');
		
	for(i=0; i<list_elems.length;i++) {
		
		if( list_elems[i].id.substr(0,4) == this.options.rowsName ) {
			if( o == 'all' ) {
				row_id = list_elems[i].id.replace(this.options.rowsName, '');	
				if( row_id > 0 ) {		
					
					if( c == false ) {				
					if( !$(this.options.rowsName+'info_'+row_id) || !Element.visible($(this.options.rowsName+'info_'+row_id)) ) {
					this.loadRowItemInfo(row_id);
					}
					
					} else {
						if( $(this.options.rowsName+'info_'+row_id) &&  Element.visible($(this.options.rowsName+'info_'+row_id)) ) {
					this.loadRowItemInfo(row_id);
						}
					}
					
				}
			}
		}
	}
},

setALLRowChecked: function(ch) {
  list_elems =	$('data_table_content').getElementsByTagName('INPUT');	
	
		for(i=0; i<list_elems.length;i++) {
			if(list_elems[i].type == 'checkbox' && list_elems[i].className == 'rowCheckbox' && list_elems[i].checked != ch ) {
				list_elems[i].checked = ch;
				this.setRowChecked(list_elems[i].value);
			}
		}
},

setReverseRowChecked: function() {
	list_elems =	$('data_list_body').getElementsByTagName('INPUT');
	
		for(i=0; i<list_elems.length;i++) {
			if(list_elems[i].type == 'checkbox' && list_elems[i].className == 'rowCheckbox') {
			  		if( list_elems[i].checked == true ) {
						list_elems[i].checked = false;
					} else {
						list_elems[i].checked = true;
					}
					this.setRowChecked(list_elems[i].value);
			}
		}
},
	
makeRowItemInfo: function(id) {

cels = $(this.options.rowsName+id).childNodes.length;
arrow_cel = 2;

checkBoxRow = document.getElementsByClassName('rowCheckbox');

if( checkBoxRow.length == 0 ) {
cels = cels-1;
arrow_cel = 1;
}


insert = '<tr id="'+this.options.rowsName+'info_'+id+'" style="display: none;" class="dTRI">';
insert += '<td style="padding-left: 10px;" valign="top"><img src="'+this.options.imageRoot+'/arrow_dr.gif" alt="" align="absmiddle" /></td>';
insert += '<td colspan="'+(cels-2)+'" id="'+this.options.rowsName+'info_con_'+id+'"> Ładuje, proszę czekać ...';
 insert += '</td>';
 insert += '</tr>';	
 
 prev_row_type_img = $(this.options.rowsName+'make_info_'+id).src;
 //$(this.options.rowsName+'type_img_'+id).src = this.options.imageRoot+'/indicator.gif';
 
 new Insertion.After(this.options.rowsName+id, insert);
 
 if( $(this.options.rowsName+'info_con_'+id) ) {
new Ajax.Updater(this.options.rowsName+'info_con_'+id, this.options.itemInfoURL+''+id, {
onLoading:function(){
$(this.options.rowsName+'make_info_'+id).src = this.options.imageRoot+'/indicator.gif';
}.bind(this),
onComplete:function(){
$(this.options.rowsName+'make_info_'+id).src = this.options.imageRoot+'/minus.gif';
}.bind(this),
evalScripts:true, 
asynchronous:true});
 
} 
 
 
}, 

delRowItemInfo: function(id) {
	
	list_elems = $('data_table_content').getElementsByTagName('TR');
	
	for(i=0; i<list_elems.length;i++) {
		if( list_elems[i].id.substr(0,4) == this.options.rowsName) {
			if( id == 'all' ) {
				row_id = list_elems[i].id.replace(this.options.rowsName, '');	
				if( row_id > 0 ) {		
					
						if( $(this.options.rowsName+'info_'+row_id) ) {
					     
						  if( Element.visible($(this.options.rowsName+'info_'+row_id)) )	{
							this.loadRowItemInfo(row_id);
							}
							
							Element.remove($(this.options.rowsName+'info_'+row_id));
						}
				}
			}
		}
	}
	
},

setRowItemStatus: function(id, status, dajaxrequest) {

if( id > 0 && status != '' ) {
  
	if( status == '0' ) {
		status_to_change = '1';
		$(this.options.rowsName+id).className = 'dTR0';
		$(this.options.rowsName+id).onmouseover = "function() { this.className = 'dTRO0'; }";
		$(this.options.rowsName+id).onmouseout = "function() { this.className = 'dTR0'; }";
		
	} else {
		status_to_change = '0';
		$(this.options.rowsName+id).className = 'dTR';
		$(this.options.rowsName+id).onmouseover = "function() { this.className = 'dTRO'; }";
		$(this.options.rowsName+id).onmouseout = "function() { this.className = 'dTR'; }";
	}
	
	switch(this.options.statusChangeType) {
		case 'base':
			this.setRowItemStatusIco(id, status, status_to_change, 'statusL_');
		break;
		case 'full':
			this.setRowItemStatusIco(id, status, status_to_change, 'statusLF_');
		break;
	
	}
	
	if(dajaxrequest != true) {
		new Ajax.Request(this.options.statusChangeURL+id+'&status='+status, {asynchronous:true});
	}
}
},


setRowItemStatusIco: function(id, status, status_to_change, ico) {

	  change = $(this.options.rowsName+'status_'+id).innerHTML;
		
		
		
	  change1 = change.replace("'"+status+"');", "'"+status_to_change+"');");
	  change2 = change1.replace(ico+status_to_change+".gif", ico+status+".gif");		
						
	  $(this.options.rowsName+'status_'+id).innerHTML = change2; 	
		 
	 
	},

delRowItem: function(id, mess, dajaxrequest) {
if(id > 0) {

run = false;
if( mess == 1 ) {
run= true;
} else {

if( confirm('Jesteś pewien że chcesz usunąć ten rekord.\n Pamiętaj, że tej operacji nie można cofnąć !!!') ) {
	run = true;
}

}
	
 if( run ) {
 if($(this.options.rowsName+'make_info_'+id)) {
  	$(this.options.rowsName+'make_info_'+id).src = this.options.imageRoot+'/indicator.gif';
  }	
	if(dajaxrequest == true) {
		Element.remove(this.options.rowsName+id);	
	  	if( $(this.options.rowsName+'info_'+id) ) {
			Element.remove(this.options.rowsName+'info_'+id);
		}	
	   if( $(this.options.rowsName+'tick_'+id) ) {	
			Element.remove(this.options.rowsName+'tick_'+id);
	   }	
  }	
	if(dajaxrequest != true) {
		new Ajax.Request(this.options.delURL+id, {asynchronous:true,
		onSuccess: function(transport) {
		    if (transport.responseText.match(/ok/)) {
			 
		      	Element.remove(this.options.rowsName+id);	
	  				if( $(this.options.rowsName+'info_'+id) ) {
						Element.remove(this.options.rowsName+'info_'+id);
					}	
				   if( $(this.options.rowsName+'tick_'+id) ) {	
						Element.remove(this.options.rowsName+'tick_'+id);
				   }	
		    } else {
			 }
		}.bind(this)

		
		});
	}
 }	
	
 }
	
},

showAdvanceSearch: function() {
	$('listAdvanceSearch').show();
	Interface.setDataTableDim();
},

hideAdvanceSearch: function() {
	$('listAdvanceSearch').hide();
	Interface.setDataTableDim();
},



setSortOrder: function(id, dir) {

 obj = $('data_table_content'); // get parent list
 this.delRowItemInfo('all');
 row_id = this.options.rowsName+id;
// xshow(obj);
 was_run = false;
 
 new_obj = new Object();
 old_obj = new Object();
 
 CN = obj.getElementsByTagName('TR'); // get nodes
  x = 0;
  y = 0;	
  while(x < CN.length){ 
    if(CN[x].id == row_id && CN[x].id.substr(0,4) == this.options.rowsName ){
      new_obj = CN[x].cloneNode(true); 
      break;
    } else {
      x++;
      }
    }
 
	 
  if(new_obj){
    if(dir == 'down'){ 
      y = x + 1;
      while(y < CN.length){ 
        if(CN[y].tagName == 'TR' && CN[y].id.substr(0,4) == this.options.rowsName){ 
          old_obj = CN[y].cloneNode(true);
          break; 
        }else{
          y++;
          }
        }
      }
    if(dir == 'up'){ 
      if(x > 0){
        y = x - 1;
        while(y >= 0){ 
          if(CN[y].tagName == 'TR' && CN[y].id.substr(0,4) == this.options.rowsName){ 
            old_obj = CN[y].cloneNode(true);
            break;
          }else{
            y--;
            }
          }
        }
      }
		
	 if(dir == 'top'){ 
	   new_sort_order = -1;
		obj.insertBefore(CN[x], CN[0]);
		new Effect.Highlight(CN[0], {startcolor:'#339933', endcolor:'#FFFFFF', restorecolor: '#FFFFFF'});
		was_run = true;
	 }
	 
	 if(dir == 'bottom'){ 	  
			new_sort_order = CN.length;
	 	
	 	obj.appendChild(CN[x]);
		new Effect.Highlight(obj.lastChild, {startcolor:'#339933', endcolor:'#FFFFFF', restorecolor: '#FFFFFF'});
		was_run = true;
	 }
	  		
    if(old_obj && x >= 0 && y < CN.length && was_run == false){ // if there is an object to replace, replace it.
      obj.replaceChild(new_obj,CN[y]);
      obj.replaceChild(old_obj,CN[x]);
		if( dir == 'down' ) {
		new_sort_order = y+1;
		} else {
		new_sort_order = y;
		}
		
		new Effect.Highlight(CN[y], {startcolor:'#339933', endcolor:'#FFFFFF', restorecolor: '#FFFFFF'});
      }
    }
	 
	 if( this.options.page > 1) {
	 	new_sort_order = ((this.options.page-1)*this.options.resultsPP)+new_sort_order;
	 } 

	 
	 new Ajax.Request(this.options.sortOrderURL+id+'&sort_order='+new_sort_order+'.5', {asynchronous:true});
	 
 } // function
 	
} //class

function popupWindow(mypage, myname, w, h, scroll) {

   if((w == '' && h == '') || (w == 'undefined' && h == 'undefined') || (w == null && h == null) ) {
	var w = screen.width * 0.8;
	var h = screen.height * 0.8; 
	}
	
	if(scroll == '' || scroll == 'undefined' || scroll == null) {
		var scroll = 'yes';
	}
	

	var winl = (screen.width - w) / 2;
	var wint = (screen.height - h) / 2;
	
	
	winprops = 'height='+h+',width='+w+',top='+wint+',left='+winl+',scrollbars='+scroll+',resizable'
	win = window.open(mypage, myname, winprops)
	if (parseInt(navigator.appVersion) >= 4) { win.window.focus(); }
}

function setCookie(name, value, expires, path, domain, secure) {
	document.cookie= name + "=" + escape(value) +
		((expires) ? "; expires=" + expires.toGMTString() : "") +
		((path) ? "; path=" + path : "") +
		((domain) ? "; domain=" + domain : "") +
		((secure) ? "; secure" : "");
}

function deleteCookie(name, path, domain) {
	if (getCookie(name)) {
		document.cookie = name + "=" + 
			((path) ? "; path=" + path : "") +
			((domain) ? "; domain=" + domain : "") +
			"; expires=Thu, 01-Jan-70 00:00:01 GMT";
	}
}

function getCookie(name) {
	var dc = document.cookie;
	var prefix = name + "=";
	var begin = dc.indexOf("; " + prefix);
	if (begin == -1) {
		begin = dc.indexOf(prefix);
		if (begin != 0) return null;
	} else {
		begin += 2;
	}
	var end = document.cookie.indexOf(";", begin);
	if (end == -1) {
		end = dc.length;
	}
	return unescape(dc.substring(begin + prefix.length, end));
}


function _gebi(id) {
if(document.getElementById) {
return document.getElementById(id);
} else {
return false;
}

}


function _gsv(id) {
if( _gebi(id).selectedIndex != -1 ) {
selected_value = _gebi(id).selectedIndex;
return parameterVal = _gebi(id)[selected_value].value;
} else {
return false;
}
} 



var Interface = {
 
	toogleCols: function(id) {
	var col = _gebi(id);
	if(!Element.visible(id)) {
		Element.show(id);
		setCookie('Int_Cols_'+id, '1');
	} else {
		Element.hide(id);
	 	deleteCookie('Int_Cols_'+id);
	}
	}, // function

	set_aw_title: function(tit) {
		if( not_null(tit) && _gebi('action_window_title') ) {
			_gebi('action_window_title').innerHTML = tit;
		} else {
			_gebi('action_window_title').innerHTML = '';
		}
	},// function
	
	unload: function() {
	hide_action_form();
	Interface.setLoader('Wczytuje dane ... proszę czekać ...');
	}, // function
	
	setEditFormDim: function(opt) {
		
		this.opt = { hop: 0 };
		Object.extend(this.opt, opt || {});
		
		if( !$('eL_form') ) {
			return;
		}
		if( !$('large_action_form') ) {
			return;
		}
	form_elem = $('large_action_form').getElementsByTagName('FORM');	
	form_elem = form_elem[0];	
		
	if(!$('form_was_changed')) {
		$('eL_form').insert('<input type="hidden" name="form_was_changed" id="form_was_changed" value="">', {position: 'top'});
	}
	
	
	
	
/*
	
if(form_elem) {
 	if($('submit_button'))	{
	 	new Effect.Opacity($('submit_button'), { duration:0, from:1, to:0.3 });
	 	$('submit_button').disabled = true;
		$('submit_button').style.cursor = 'default';
	}
	if($('save_close_button'))	{
	 	new Effect.Opacity($('save_close_button'), { duration:0, from:1, to:0.3 });
	 	$('save_close_button').disabled = true;
		$('save_close_button').style.cursor = 'default';
	}
		
		formelems = Form.getElements(form_elem);
				
		if(formelems && formelems.length > 0) {	
			
	  		for(i=0;i<=formelems.length;i++) {
				if(!formelems[i]) {
					continue;
				}
				
if(formelems[i].type == 'text' || formelems[i].type == 'textarea') {	
					Event.observe(formelems[i], 'keyup', function() { this.enableFormSubmitFields(); }.bind(this) );
				} else if(formelems[i].type == 'select' || formelems[i].type == 'select-one' || formelems[i].type == 'select-multiple') {	
					Event.observe(formelems[i], 'change', function() { this.enableFormSubmitFields(); }.bind(this) );
				} else {	
					Event.observe(formelems[i], 'click', function() { this.enableFormSubmitFields(); }.bind(this) );
				}
			}
		}	
}
	
*/	

	if( $('large_action_form')) {
		eL_dimensions = Element.getDimensions('large_action_form');
		
	   mheight = 55;		
	  		
	  if( $('eL_formSavingOptions') ) {		
	  	mheight += 28;	
	  } 
		
	  if( $('currentItemInfo') ) {	
	  	mheight += Element.getHeight('currentItemInfo');	
	  } 
		
	  if(this.opt.hop) {
		mheight += opt.hop;	
	  }	
		
		
	if(eL_dimensions.height > 0) {
		$('eL_form').style.height = (eL_dimensions.height-mheight)+'px';
		this.interfaceFormMaxHeight = eL_dimensions.height-mheight;
	}
	if(eL_dimensions.width > 0) {
		$('eL_form').style.width = (eL_dimensions.width-160)+'px';
		this.interfaceFormMaxWidth = eL_dimensions.width-223;
		if($('eL_formTitle')) {
		$('eL_formTitle').style.width = (eL_dimensions.width-340)+'px';
		}
			this.setLargeElemsWidth();
	}		
		  
		$('eL_form').style.overflow = 'auto';
	}
}, // function
	
	setLargeElemsWidth: function() {	 
	 
	  var elems = $('eL_form').getElementsByTagName('input'); 		
		for( i=0;i < elems.length; i++ ) {
			if( elems[i].className == 't4') {
				elems[i].style.width = this.interfaceFormMaxWidth+'px';
			}
		}		
		
	  var elems = $('eL_form').getElementsByTagName('textarea'); 
	  	for( i=0;i < elems.length; i++ ) {	
			if( elems[i].className == 't4') {
				elems[i].style.width = this.interfaceFormMaxWidth+'px';
			  //	elems[i].style.height = this.interfaceFormMaxHeight-100+'px';
			}
		}		
		
		
	},// function
	
	enableFormSubmitFields: function() {
		return null;
		
		if($('submit_button')) {
			new Effect.Opacity($('submit_button'), { duration:0, from:0.3, to:1 });
			 	$('submit_button').disabled = false;
				$('submit_button').style.cursor = 'pointer';
				if($('form_was_changed'))	{
					$('form_was_changed').value = '1';
				}
		}
		
		if($('save_close_button')) {
			new Effect.Opacity($('save_close_button'), { duration:0, from:0.3, to:1 });
			 	$('save_close_button').disabled = false;
				$('save_close_button').style.cursor = 'pointer';
				if($('form_was_changed'))	{
					$('form_was_changed').value = '1';
				}
		}
	
	},
	
	textAreaSize: function(id, op) {
		
		if( op == '+' ) {
		
			$(id).rows = $(id).rows+5;
		}
		
		if( op == '-' ) {
			$(id).rows = $(id).rows-5;
		}
		
	}, // function
	
	setDataTableDim: function() {
	
	if( $('data_table_content') ) {
	 
	agt = navigator.userAgent.toLowerCase();
	
	if (agt.indexOf("msie") != -1) {
		return;
	} 
	
	if(agt.indexOf("firefox/3") != -1) {
	var elemscount = $('data_table_content').getElementsByTagName('TR');
	if(elemscount.length < 15) {
		return;
	}
	
	}
	
	
	
  	eL_dimensions = Element.getDimensions( parent.$('module_content') );
	
	if( $('cTO') ) {
		wm = 80;
	} else {
		wm = 45;
	}
	
	if(agt.indexOf("firefox/3") != -1) {
		wm = wm+10;
	}
	
	if( $('listAdvanceSearch') && Element.visible('listAdvanceSearch') ) {
		wm = wm+Element.getHeight('listAdvanceSearch')+8;
	} 
	
	if( $('currentItemInfo') ) {
		wm = wm+Element.getHeight('currentItemInfo')+8;
	} 
	
	$$('.extendHeight').each(function(item) {
  		wm = wm+$(item).getHeight();
	});

	
	$('data_table_content').style.height = (eL_dimensions.height-wm)+'px';
	$('data_table_content').style.overflowY = 'auto';
	$('data_table_content').style.overflowX = 'hidden';
			
		}
	}, // function
	
	setRecordChanges: function(options) {
 		
	if( options.list.length > 0 && $('list_fields_changed') ) {
		for( i=0;i < options.list.length; i++ ) {	
			if( $(options.list[i]) ) {
				Event.observe(options.list[i], 'change', function() { $('list_fields_changed').value = '1'; }  );
			}
		}
	}
	
	if( options.tree.length > 0 && $('tree_fields_changed') ) {
		for( i=0;i < options.tree.length; i++ ) {	
			if( $(options.tree[i]) ) {
				Event.observe(options.tree[i], 'change', function() { $('tree_fields_changed').value = '1'; }  );
			}
		}
	}
		  
 
 
	} // function
	
}


 setActionFormSubmit = function(text) {
 
 t = '<h1 style="color: #F00; text-align:center;">';
 if( !not_null(text)  ) {
 t += 'Zapisuje, proszę czekać ...';
 } else {
 t += text;
 }
 t += '</h1>';
 
 if( $('action_window_content') ) {
	Element.hide('action_window_content');	
 }
 
 if( $('action_window_buttons') ) {
 	Element.hide('action_window_buttons');	
 }
 
 if( $('action_window_title') ) {
 	$('action_window_title').innerHTML = t;
 }
	
 	
 }	
 
 setActionFormSuccess = function(text) {
if( $('action_window_title') ) {
 t = '<h1 style="color: #090; text-align:center;">';
 if( !not_null(text)  ) {
  t += 'Zapisano';
 } else {
 t += text;
 }
 t += '</h1>';
 

 	$('action_window_title').innerHTML = t;
	
	setTimeout(function() {
	hide_action_form();
	}, 1000);
}	
	
 }	

 hide_action_form = function() {
 
if( Dialog != 'undefined' && Dialog != null && Dialog != '') { 
 Dialog.closeInfo();
 $('action_window').remove();
}
 return;
 
 
 if( $('action_window_content') ) {
 $('action_window_content').innerHTML = '';
 Element.hide('action_window');
 }

}


not_null = function(vars) {
		if( vars == '' || vars == 'undefined' || vars == null ) {
			return false;
		}
			return true;
	} // function

function tabs(options){ 
  
  this.options = {  
	onTabStyle:'ontab',
	offTabStyle: 'offtab',
	tab: 'tab',
	page: 'page'
 }	
 this.activeTab = '';
 
 Object.extend(this.options, options || {});
	
	this.setElemStyle = function(id,style) {
	if($(id)) {
		$(id).blur();
		$(id).className = style;
	}
	}
	
	this.showElem = function(id) {
	if($(id)) {
			$(id).style.visibility = 'visible';
			$(id).style.display = 'block';
	}
	}
	
	this.hideElem = function(id) {
	if($(id)) {
			$(id).style.visibility = 'hidden';
			$(id).style.display = 'none';
	}
	}
	
	this.cycleTab = function(name) {
		
		if (this.activeTab) {
			this.setElemStyle( this.activeTab, this.options.offTabStyle );
			page = this.activeTab.replace( this.options.tab, this.options.page );
			this.hideElem(page);
		}
		this.setElemStyle( name, this.options.onTabStyle );
		this.activeTab = name;
		page = this.activeTab.replace( this.options.tab, this.options.page );
		this.showElem(page);
	}
	return this;
}


function navTabs(options){ 
  
  this.options = {  
	onTabStyle:'navTab-on',
	offTabStyle: 'navTab-off',
	tab: 'navTab',
	page: 'navPage'
 }	
 this.activeTab = '';
 
 Object.extend(this.options, options || {});
	
	this.setElemStyle = function(id,style) {
	if($(id)) {
		
	}
	}
	
	this.showElem = function(id) {
	if($(id)) {
			$(id).show();
	}
	}
	
	this.hideElem = function(id) {
	if($(id)) {
			$(id).hide();
	}
	}
	
	this.cycleTab = function(name) {
		
		if (this.activeTab) {
			$(this.activeTab).addClassName(this.options.offTabStyle);
			$(this.activeTab).removeClassName(this.options.onTabStyle);
		
			page = this.activeTab.replace( this.options.tab, this.options.page );
			this.hideElem(page);
		}		
		
		this.activeTab = name;
	
		if($(this.activeTab)) {
		$(this.activeTab).removeClassName(this.options.offTabStyle);
		$(this.activeTab).addClassName(this.options.onTabStyle);
		}
		page = this.activeTab.replace( this.options.tab, this.options.page );
		this.showElem(page);
	}
	return this;
}

 
function xshow(o) {
	s = '';
	var _window = window.open("",'aaa',"width=680,height=600,resizable,scrollbars=yes");
	for(e in o) {
	_window.document.write(e+'='+o[e]+'<br>');
//s += e+'='+o[e]+'<br>';
	}
  //	document.write( s );
 //	alert( s );
 
}

function set_progress(desc) {
	
	elems = $('messagess').getElementsByTagName('td');
   for(i=0; i<elems.length;i++) {
		if(elems[i].style.display != 'none') {
			return;
		}
	}
	
	if( $('progress') ) {
	if( desc ) {
		$('progress_desc').innerHTML = desc;
	}
	Element.show('progress');
	}

}

function del_progress() {
	if( $('progress') ) {
	Element.hide('progress');
	}
	$('progress_desc').innerHTML = 'aktualizuje dane ...';	
	
}

function set_success() {

if( $('success_mess') ) {
	Element.remove( 'success_mess' );
}
//new Insertion.After('progress', '<span id="success_mess">Formularz pomyślnie zapisany </span>');
//setTimeout("Element.remove( 'success_mess' );",5000);
}

function populate(parent_form_element, child_form_element, src_array) {
	
	if (parent_form_element.selectedIndex >= 0) {
		var parent_id = parent_form_element.options[parent_form_element.selectedIndex].value;
		depopulate(child_form_element);
	  
		if (src_array[parent_id]) {
			for (i=0; i < src_array[parent_id].length; i++) {
				child_form_element.options[i] = new Option(src_array[parent_id][i][1], src_array[parent_id][i][0]);
				if( src_array[parent_id][i][2] ) {
				child_form_element.options[i].style.backgroundColor = src_array[parent_id][i][2];
				}
			}
		}
	}
	
}

function depopulate(form_element) {
	if (form_element.options.length > 0) {
		form_element.innerHTML = '';
	}
}

function select_item(parent_form_element, src_form_element, dst_form_element) {
	found_dup=false;
	for (i=0; i < src_form_element.options.length; i++) {
		if (src_form_element.options[i].selected) {
			for (n=0; n < dst_form_element.options.length; n++) {
				if ( src_form_element.options[i].value == dst_form_element.options[n].value) {
					found_dup=true;
				}
			}
			
			if (!found_dup) {
				src_id = src_form_element.options[i].value;
				src_text = src_form_element.options[i].text;
				
				src_section_id = parent_form_element.options[parent_form_element.selectedIndex].value;
				src_section_text = parent_form_element.options[parent_form_element.selectedIndex].text;
				
				options_length = dst_form_element.options.length;
				dst_form_element.options[options_length] = new Option(src_section_text + ' > ' + src_text, + src_id);
				dst_form_element.options[options_length].selected = true;
			}
		}
		
		found_dup=false;
	}
}

function deselect_item(form_element) {
	for (i=0; i < form_element.options.length; i++) {
		if (form_element.options[i].selected) {
			form_element.options[i] = null;
			i=i - 1;
		}
	}
}

function unselect_all(form_element) {
	for (i=0; i < form_element.options.length; i++) {
		form_element.options[i].selected = false;
	}
}

function select_all(select_box) {
	for (i=0; i < select_box.options.length; i++) {
		select_box.options[i].selected = true;
	}
}	

convertPrice = function(v) {
	var price = $(v).value;
	/*while (price.indexOf(',')!=-1) {
		price = price.sub(',','|');
	}*/
	while ((commaPos=price.indexOf(','))!=-1) {
		if (commaPos == price.length-3) {
			price = price.sub(',','.');
		} else if (commaPos > price.length-3 && commaPos <= price.length) {
			break;
		} else {
			price = price.sub(',','');
		}
	}
	$(v).value = price;
}

displayLeftHint = function(text) {
	elems = $('messagess').getElementsByTagName('td');
   for(i=0; i<elems.length;i++) {
		if(elems[i].style.display != 'none') {
			return;
		}
	}
	
	if ($('leftHint')) {
		$('leftHint').update(text);
		$('leftHint').show();
	}
}

hideLeftHint = function() {
	if ($('leftHint')) {
		$('leftHint').update();
		$('leftHint').hide();
	}
}

displaySystemMessage = function(text) {
	if ($('system_message')) {
		$('system_message').update(text);
		$('system_message').show();
	}
}

hideSystemMessage = function() {
	if ($('system_message')) {
		$('system_message').update();
		$('system_message').hide();
	}
}
