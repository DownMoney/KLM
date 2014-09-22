<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<script type="text/javascript">
if( self!=top ) {ldelim}
	parent.document.location.href = '{wt_href_tpl_link mod_key="mod_admin_manager"}';
{rdelim}
</script>
<meta http-equiv="Content-Language" content="pl"> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

	<link rel="stylesheet" href="{$__cssRoot__}/main.css" type="text/css">
	<link rel="SHORTCUT ICON" href="{$__imageRoot__}/favicon.ico" /> 
	<title>{$smarty.const.SITE_NAME} :: PANEL ADMINISTRACYJNY</title>
	<script type="text/javascript" src="{$__BaseJsRoot__}/aculo/prototype.js"></script>
	<script type="text/javascript" src="{$__BaseJsRoot__}/aculo/scriptaculous.js"></script>
	<script type="text/javascript" src="{$__BaseJsRoot__}/aculo/dropdown.js"></script>
	<script type="text/javascript" src="{$__BaseJsRoot__}/admin.js"></script>
	<script type="text/javascript" src="{$__BaseJsRoot__}/flash.js"></script>
	<script type="text/javascript" src="{$__BaseJsRoot__}/editor/fckeditor/fckeditor.js"></script>
	
	
<link rel="stylesheet" href="{$__BaseJsRoot__}/calendar2/calendar-win2k-1.css" type="text/css">
<script type="text/javascript" src="{$__BaseJsRoot__}/calendar2/calendar.js"></script>
<script type="text/javascript" src="{$__BaseJsRoot__}/calendar2/lang/calendar-pl.js"></script>
<script type="text/javascript" src="{$__BaseJsRoot__}/calendar2/calendar-setup.js"></script>
<script type="text/javascript" src="{$__BaseJsRoot__}/windows/window.js"></script> 

<link href="{$__BaseJsRoot__}/windows/themes/def.css" rel="stylesheet" type="text/css">
<link href="{$__BaseJsRoot__}/windows/themes/alphacube.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="{$__jsRoot__}/JSCookTree.js"></script>
<link rel="stylesheet" type="text/css" href="{$__mediaRoot__}/JSCookTree/ThemeXP/theme.css">
<script type="text/javascript" src="{$__mediaRoot__}/JSCookTree/ThemeXP/theme.js"></script>
{if $smarty.const.ADMIN_DEVELOPERS_MODE != "true"}
{literal}
<style type="text/css">
BODY { overflow: hidden; }
</style>
{/literal}
{/if}
{$__header__}

<script type="text/javascript">
{literal}

init_editor = function(options) {

 Interface.enableFormSubmitFields();	

 this.options = {
 	width:Interface.interfaceFormMaxWidth,
	height:Interface.interfaceFormMaxHeight,
	mode:'Default'
 }	
 Object.extend(this.options, options || {});


 if(!this.loaded_editors) {
 	this.loaded_editors = new Array();
 }
 
 var instance = 'WT_editor_'+this.options.id;
 instance = new FCKeditor( this.options.id );
 {/literal}
 instance.BasePath = "{$__BaseJsRoot__}/editor/fckeditor/";

 instance.Width = this.options.width;
 instance.Height = this.options.height;
 instance.ToolbarSet = this.options.mode;
 instance.ReplaceTextarea();
 
 instance.Config['EditorAreaCSS'] = "{$__templatesRoot__}default/css/main.css";
 $(this.options.id+'_link').hide();
 
{literal}
}
{/literal}
</script>


</head>
 
 
<body> 
<table class="mT" cellspacing="0" cellpadding="0">
<tr>
<td colspan="3" class="mT-m">
<table cellpadding="0" cellspacing="0" width="100%" style="border-bottom: 1px solid #ccc;">
<tr>
<td width="100" style="border-right: 1px solid #CCC"><a href="{wt_href_tpl_link mod_key="mod_admin_manager"}"><img src="{$__imageRoot__}/header_logo.png" alt=""></a></td>
<td>{wt_push_column column="101"}</td>
<td id="messagess" width="100%"><table cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td id="system_message" style="display:none;"></td>
		<td id="progress" style="display:none;"><span id="progress_desc">Aktualizuje dane ...</span></td>
		<td id="leftHint" style="display:none;">&nbsp;</td>
	</tr>
</table></td>
<td align="right" width="100%"><nobr>
{if $__languages__}
<form action="{wt_href_tpl_link mod_key="mod_admin_manager"}">Język:
<input type="hidden" name="mod" value="{wt_mod_id m="mod_admin_manager"}" />
<select name="language" onChange="this.form.submit();">
{foreach from=$__languages__ item="l" key="k"}
<option value="{$k}" {if $__languagesCurLanguage__.id == $l.id}selected="selected"{/if}>{$l.name}</option>
{/foreach}
</select>
</form>
{/if}
</nobr></td>
<td align="right"><nobr><a href="{wt_href_tpl_link mod_key="mod_user" parameters="a=makeLogout&from_admin=1"}" class="logout">wyloguj</a></nobr></td>
</tr>
</table>
</td>
</tr>
<tr>
<td class="mT-l" id="l" width="200">
{wt_push_column column="103"}
</td>
<td class="mT-sep-l" id="sep-l" onClick="Interface.toogleCols('l');" width="10"><img src="{$__imageRoot__}/tpi.gif" width="7" height="100" border="0" alt=" zwiń / rozwiń " /></td>
<td class="mT-c" id="mT-c" width="100%">
<table width="100%" cellpadding="0" cellspacing="0" id="int_mainTable">
	<tr>
		<td class="navTabs" id="navTabs">
<!-- <a class="navTab-off" href="#" id="navTabSite" onClick="navigationTabsTab.cycleTab(this.id); updateSite(); return false;">Podgląd</a> -->

<span class="navTab-off" id="navTabMod" onClick="navigationTabsTab.cycleTab('navTabMod'); updateSite(); return false;"><a href="#" id="navTabModLink">Administracja</a></span>
<!--		<div style="position: absolute; text-align: right;">alsda;sldj</div>-->
		</td>
	</tr>
	<tr>
	<td width="100%" height="100%" colspan="2">
	
<table width="100%" height="100%" cellpadding="0" cellspacing="0" id="navPageSite"  style="display: none;">
<tr>
<td width="100%" class="mT-m2" id="mod_menu">Ładuje menu proszę czekać ...
</td>
</tr>
<tr>
<td width="100%" class="mT-nB" id="navigation_bar"></td>
</tr>
<tr>
<td  width="100%" class="mT-ab"><b>Adres:</b> <input type="text" id="address_bar" value=""> <a href="#" onClick="site._refresh(true); return false;" title=" odśwież stronę "><img src="{$__imageRoot__}/icon_refresh.gif" alt="" align="top" width="17" height="17" /></a> </td>
</tr>
<tr>
<td height="100%" width="100%" valign="top">
<iframe id="site" name="site" frameborder="0" width="100%" height="100%" style="border:0;" marginheight="0" marginwidth="0" ></iframe>
</td>
</tr>
</table>

<table id="navPageForm" height="100%" width="100%" style="display: none;" cellpadding="0" cellspacing="0"  >
	<tr id="large_action_form_tr">
		<td id="large_action_form" width="100%"  valign="top"></td>
	</tr>
</table>

<table id="navPageMod" height="100%" width="100%" style="display: none;" cellpadding="0" cellspacing="0"  >
	<tr>
		<td class="mT-m2" id="mod_menu_admin">&nbsp;</td>
		<td class="mT-m2" width="16" style="width: 16px; text-align: right; padding-right: 10px;"><a href="#" onClick="$('mod_content').contentDocument.location.reload(true); return false;" title=" odśwież stronę "><img src="{$__imageRoot__}/odswiez.gif" alt="" /></a></td>
	</tr>
	<tr>
		<td width="100%" height="100%"  valign="top" id="module_content" colspan="2">			
			<iframe id="mod_content" name="mod_content" frameborder="0" width="100%" height="100%" style="border:0;" marginheight="0" marginwidth="0" ></iframe>
		</td>
	</tr>
</table>
<table id="navPageInfo" height="100%" width="100%" style="display: none;" cellpadding="0" cellspacing="0">
	<tr>
		<td class="mT-m2" id="navPageInfo_title">&nbsp;</td>
		<td class="mT-m2" width="16" style="width: 16px; text-align: right; padding-right: 10px;"><a href="#" onClick="$('mod_content_info').contentDocument.location.reload(true); return false;" title=" odśwież stronę "><img src="{$__imageRoot__}/odswiez.gif" alt="" /></a></td>
	</tr>
	<tr>
		<td width="100%" height="100%"  valign="top" id="module_content_info" colspan="2"> <iframe id="mod_content_info" name="mod_content_info" frameborder="0" width="100%" height="100%" style="border:0;" marginheight="0" marginwidth="0" ></iframe></td>
	</tr>
</table>



	</td>
	</tr>
</table>


</td>
</tr>

<tr>
<td colspan="3" class="bottomStatus" id="sep-b">Zalogowany jako: <a href="#" onClick="loadModule('{wt_mod_id m="mod_user_manager"}'); return false">{if $__userInfo__.usr_last_name || $__userInfo__.usr_first_name}{$__userInfo__.usr_last_name} {$__userInfo__.usr_first_name}{elseif $__userInfo__.usr_login}{$__userInfo__.usr_login}{elseif $__userInfo__.usr_email}{$__userInfo__.usr_email}{/if}</a></td>
</tr>

</table>

{if $smarty.const.ADMIN_DEVELOPERS_MODE != 'true'}
<div style="display:none;">
{/if}
<div id="operations" style="width:100%; height:200px; float:left;clear:both;"></div>
<iframe id="operation2" name="operation2" frameborder="0" width="100%" height="200" style="border:0;" marginheight="0" marginwidth="0" ></iframe>
<div style="display: none;">
<img src="{$__imageRoot__}/statusL_1.gif" alt="" />
<img src="{$__imageRoot__}/statusL_0.gif" alt="" />
</div>

{if $smarty.const.ADMIN_DEVELOPERS_MODE != 'true'}
</div>
{/if}

<script type="text/javascript">

{if $smarty.cookies.Int_Cols_ad == "1"}
   	Interface.toogleCols('ad');
{/if}
{literal}

navigationTabsTab = new navTabs();

loadModule = function(mod, name, params) {
	navigationTabsTab.cycleTab('navTabMod');
	
	if( name == null || name == '' || name == 'undefined' ) {
		params = 't=mP';
	}
	$('navTabMod').addClassName('navTab-progress');
	$('mod_content').src = '{/literal}{wt_href_tpl_link mod_key="'+mod+'" search_engine_safe=false parameters="t=mP"}{literal}';
	
	if( name == null || name == '' || name == 'undefined' ) {
		$('navTabModLink').innerHTML = 'Administracja';
	} else {
		$('navTabModLink').innerHTML = name;
	}
}

dialogForm = function(options) {
	this.options = {
 	width:'785',
	height:'500',
	className: 'def',
	method: 'get'
 }	
 
 Object.extend(this.options, options || {});
	
Dialog.info({
url: this.options.url,
options: {
method: this.options.method,
onSuccess: function(t) {
		  setTimeout(function() {t.responseText.evalScripts()}, 10);	  
    },
asynchronous:true
}},
{
windowParameters: 
{
className: this.options.className,
width:this.options.width,
height:this.options.height,
draggable: false,
closable: true,
destroyOnClose:true
}
});

}

submitDialogForm = function() {
Dialog.closeInfo();
//Interface.setLoader('Zapisuje dane, proszę czekać');
}

  

function load_module(value, mod) {


new Ajax.Updater('operations', '{/literal}{wt_href_tpl_link mod_key="mod_admin_manager" parameters="a=uAI"}{literal}', {
onLoading:function(e){
set_progress('uzupełniam menu');
}, 
onComplete:function(e){
del_progress();
},
parameters:'v='+value, 
evalScripts:true, 
asynchronous:true});


setStructureTree(mod);

}


function action_form(url, tit) {

set_progress('ładuje formularz');


Dialog.info({
url: url,
options: {
onSuccess: function(t) {
		  setTimeout(function() {t.responseText.evalScripts()}, 10);	
		  del_progress();	  
    },
asynchronous:true
}},
{
top: 100,
windowParameters: 
{
className: 'def',
width: '580',
destroyOnClose:true
}
});

return;
}

function action_form_large(url, tit) {

if( $('navTabForm') ) {
Element.remove('navTabForm');
}

fl = '<span class="navTab-off navTab-progress" id="navTabForm"><a href="#" onClick="navigationTabsTab.cycleTab(\'navTabForm\'); return false;" id="navTabFormLink">Ładuje formularz ...</a>{/literal}<img class="closeTabImage" src="{$__imageRoot__}/close_tab.gif" onClick="hide_action_form_large(); return false" align="absmiddle">{literal}</span>';
new Insertion.Bottom('navTabs', fl);


$('large_action_form').innerHTML = '';

new Ajax.Updater('large_action_form', url, {
onLoading:function(){
set_progress('wczytuje formularz ... ');
}, 
onComplete:function(){
del_progress();
navigationTabsTab.cycleTab('navTabForm');
$('navTabForm').removeClassName('navTab-progress');
$('navTabFormLink').update(tit);
}, 
evalScripts:true, 
asynchronous:true
});

}

function action_info_tab(url, tit) {

if( $('navTabInfo') ) {
Element.remove('navTabInfo');
}

fl = '<span class="navTab-off navTab-progress" id="navTabInfo"><a href="#" onClick="navigationTabsTab.cycleTab(\'navTabInfo\'); return false;">'+tit+'</a>{/literal}<img class="closeTabImage" src="{$__imageRoot__}/close_tab.gif" onClick="hide_action_info_tab(); return false" align="absmiddle">{literal}</span>';
new Insertion.After('navTabMod', fl);
navigationTabsTab.cycleTab('navTabInfo'); 
$("navTabInfo").addClassName("navTab-progress");

if( (url != '' && url != 'undefined' && url != null && this.url != url) ) {
		 this.url = url;
		 this.loaded = false;
	} else {
		return;
	}
	
set_progress('ładuje dane');
$('mod_content_info').hide();
$('navPageInfo_title').update('Ładowanie danych ... proszę czekać');
$('mod_content_info').src = this.url;
this.loaded = true;
this.url = '';

}

function hide_action_info_tab(mess) {
navigationTabsTab.cycleTab('navTabMod');
Element.remove('navTabInfo');
}


function hide_action_form_large(mess) {
var a = false;
if($('form_was_changed') && $('form_was_changed').value != '1') {
mess = 1;
}

if( mess == 1 ) {
a= true;
} else {
if( confirm('NIE ZAPISANO ZMIAN !!! \n\nJesteś pewien, że chcesz zamknąć formularz ?\n\nJeżeli nie chcesz zapisywać zmian i chcesz zamknąć formularz kliknij przycik OK.\nJeżeli chcesz zapisać swoje zmiany kliknij na przycisk ANULUJ a następnie ZAPISZ w prawym górnym rogu. \n\nPamiętaj, że nie zapisane zmiany zostaną utracone na zawsze !!!') ) {
a = true;
}
}
if( a == true) {
navigationTabsTab.cycleTab('navTabMod');
Element.remove('navTabForm');
$('large_action_form').innerHTML = '';
}
}


function save_action_form(form, url) {

new Ajax.Updater('operations', url, {onComplete:function(request){hide_action_form()}, parameters: Form.serialize(form), evalScripts:true, asynchronous:true});

}

function save_form(form, url) {

var updateForm = eval( 'document.forms.' + form );

new Ajax.Updater('operations', url, {
onLoading:function(){
set_progress('zapisuje ... ');
}, 
onComplete:function(){
del_progress();
set_success();
}, 
parameters: Form.serialize(updateForm), 
evalScripts:true, 
asynchronous:true,
onFailure: function(t) {
        alert('Error ' + t.status + ' -- ' + t.statusText);
    }
});

}

updateSite = function(url) {
	
	if( (url != '' && url != 'undefined' && url != null && this.url != url) ) {
		 this.url = url;
		 this.loaded = false;
	} else {
		return;
	}
	
/*
 if( (Element.visible('navPageMod') && this.loaded == false)  ) {
		set_progress('ładuje dane');
		$('mod_content').src = this.url;
		this.loaded = true;
		this.url = '';
 }
*/

set_progress('ładuje dane');
$('mod_content').src = this.url;
this.loaded = true;
this.url = '';
}

setStructureTree = function(mod) { 

reload = false;
if( mod == '' && mod == 'undefined' ) {
mod = this.mod;
reload = true;
} else if( mod != '' && this.mod != mod ) {
reload = true;
}

if(  reload == true  ) {

setWaitingStatus('sT',true);
new Ajax.Updater('sT', '{/literal}{wt_href_tpl_link mod_key="mod_admin_manager" parameters="t=structureJSTree&wm='+mod+'"}{literal}', {
evalScripts:true, 
asynchronous:true,
onComplete: function() { setWaitingStatus('sT',false); }   
});
this.mod = mod;
}

}

setWaitingStatus = function(id,init) {
	if(init == true) {
		new Effect.Opacity(id, { from: 1.0, to: 0.2, duration: 0});
		$(id).className = 'bigWaiting';
	} else {
		new Effect.Opacity(id, { from: 0.2, to: 1, duration: 0});
		$(id).className = '';
	}
}

 $('int_mainTable').setStyle({ height: $('mT-c').getHeight()-5+'px' } );
  
{/literal}


Event.observe(window, 'load', function() {literal} { {/literal}
{if $smarty.const.CFGDB_START_ADMIN_MODULE && $smarty.const.CFGDB_START_ADMIN_MODULE != "CFGDB_START_ADMIN_MODULE"}
 loadModule('{wt_mod_id m="`$smarty.const.CFGDB_START_ADMIN_MODULE`"}', '');
{else}
loadModule('{wt_mod_id m="mod_structure_manager"}', '');
{/if}
{literal} } {/literal} );

</script>
	{$__footer__}
</body>
</html>