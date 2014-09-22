<html>
<head>
<meta http-equiv="Content-Language" content="pl"> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" href="{$__cssRoot__}/main.css" type="text/css">
	<title>Administracja</title>
	<script type="text/javascript" src="{$__BaseJsRoot__}/aculo/prototype.js"></script>
	<script type="text/javascript" src="{$__BaseJsRoot__}/aculo/scriptaculous.js"></script>
	<script type="text/javascript" src="{$__BaseJsRoot__}/admin.js"></script>
	<script type="text/javascript" src="{$__BaseJsRoot__}/editor/fckeditor/fckeditor.js"></script>
	<script type="text/javascript" src="{$__BaseJsRoot__}/flash.js"></script>
<link rel="stylesheet" href="{$__BaseJsRoot__}/calendar2/calendar-win2k-1.css" type="text/css">
<script type="text/javascript" src="{$__BaseJsRoot__}/calendar2/calendar.js"></script>
<script type="text/javascript" src="{$__BaseJsRoot__}/calendar2/lang/calendar-pl.js"></script>
<script type="text/javascript" src="{$__BaseJsRoot__}/calendar2/calendar-setup.js"></script>
<script type="text/javascript" src="{$__BaseJsRoot__}/windows/window.js"></script> 

<link href="{$__BaseJsRoot__}/windows/themes/def.css" rel="stylesheet" type="text/css">
<link href="{$__BaseJsRoot__}/windows/themes/alphacube.css" rel="stylesheet" type="text/css">
</head>
<body>
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
<table width="100%" height="100%" cellpadding="0" cellspacing="0">
<tr>
	<td id="large_action_form" style="padding:0;">{wt_push_module}</td>
</tr>
</table>
<script type="text/javascript">
{literal}
function action_form(url, tit) {
new Dialog.info({
url: url,
options: {
onSuccess: function(t) {
		  setTimeout(function() {t.responseText.evalScripts()}, 10);	
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

}{/literal}
</script>

<div id="operations" style="float: left; clear: both;"></div>
<iframe id="operation2" name="operation2" frameborder="0" width="100%" height="0" style="border:0;" marginheight="0" marginwidth="0" ></iframe>
{$__footer__}
</body>
</html>