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

function popupWindow(mypage, myname, w, h, scroll) {

   if(w == '' && h == '' || (w == 'undefined' && h == 'undefined') || (w == null && h == null) ) {
	var w = screen.width * 0.8;
	var h = screen.height * 0.8; 
	}
	

	var winl = (screen.width - w) / 2;
	var wint = (screen.height - h) / 2;
	
	
	winprops = 'height='+h+',width='+w+',top='+wint+',left='+winl+',scrollbars='+scroll+',resizable'
	win = window.open(mypage, myname, winprops)
	if (parseInt(navigator.appVersion) >= 4) { win.window.focus(); }
}

function checkAll( n, val, _form, toggle ) {

	if(_form != '' && _form != 'undefined' && _form != null) {
	var f = eval( 'document.' + _form );
	} else {
	var f = document.adminForm;
	}
	
	if(val != '' && val != 'undefined' && val != null) {
	var val2 = 'f.' + val;
	} else {
	var val2 = 'f.cb';
	}
	
	
	for (i=0; i < f.length; i++) {
		if( f[i].name == val ) {
			f[i].checked = toggle.checked;
		}
	}
 } 

function addBookmark(title,url) {

  var msg_netscape = "Wiadomość netscape";
  var msg_opera    = "Ta funkcja nie działa z tą wersją Opery. Dodaj nas do ulubionych ręcznie.";
  var msg_other    = "Twoja przeglądarka nie wspiera automatycznego dodawania do ulubionych. Dodaj nas do ulubionych ręcznie.";
  var agt          = navigator.userAgent.toLowerCase();


  if (agt.indexOf("opera") != -1) 
  {
    if (window.opera && window.print)
    {
      return true;
    } else 
    {
      alert(msg_other);
    }
  }    
  else if (agt.indexOf("firefox") != -1) window.sidebar.addPanel(title,url,"");
  else if ((agt.indexOf("msie") != -1) && (parseInt(navigator.appVersion) >=4)) window.external.AddFavorite(url,title); 
  else if (agt.indexOf("netscape") != -1) window.sidebar.addPanel(title,url,"")         
  else if (window.sidebar && window.sidebar.addPanel) window.sidebar.addPanel(title,url,""); 
  else alert(msg_other);
  
}

function MM_preloadImages() { 
var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

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
		$(id).className = style;
		$(id).blur();
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

function check_vat_id(elem) {
		input_data = $F(elem);
		var my_nums = input_data.replace(/-/g,'');
		my_nums = my_nums.replace(/ /g,'');
		var valid_nums = "657234567";
		var sum=0;
		for (var temp=8;temp>=0;temp--) {
			sum += (parseInt(valid_nums.charAt(temp)) * parseInt(my_nums.charAt(temp)));
		}
		if ( (sum % 11) == 10 ? false : ((sum % 11) == parseInt(my_nums.charAt(9))) )
			return true;
		else
			return false;
}

function compare_date_from_to(elem) {
	date_from_string = $(elem).readAttribute('date_from');
	date_to_string = $(elem).readAttribute('date_to');
	if(date_from_string=='now()') {
		date_from = new Date();
	} else {
		date_from = new Date(date_from_string);
	}	
	if(date_to_string=='now()') {
		date_to = new Date();
	} else {
		date_to = new Date(date_to_string);
	}
	f_date = new Date($F(elem));
	if(f_date!='Invalid Date') {
		if(f_date<=date_from || f_date>=date_to) {
			return false;
		}
		return true;
	}
	return false;
}

function compare_date_from(elem) {
	date_from_string = $(elem).readAttribute('date_from');
	if(date_from_string=='now()') {
		date_from = new Date();
	} else {
		date_from = new Date(date_from_string);
	}
	f_date = new Date($F(elem));
	if(f_date!='Invalid Date') {
		if(f_date<=date_from) {
			return false;
		}
		return true;
	}
	return false;
}

function compare_date_to(elem) {
	date_to_string = $(elem).readAttribute('date_to');
	if(date_to_string=='now()') {
		date_to = new Date();
	} else {
		date_to = new Date(date_to_string);
	}
	f_date = new Date($F(elem));
	if(f_date!='Invalid Date') {
		if(f_date>=date_to) {
			return false;
		}
		return true;
	}
	return false;
}

function xshow(o) { s=''; var _window=window.open("",'aaa',"width=680,height=600,resizable,scrollbars=yes"); for(e in o) { _window.document.write(e+'='+o[e]+'<br>'); } }