<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" href="{$__cssRoot__}/theme_list.css" type="text/css" />
	<script type="text/javascript" src="{$__BaseJsRoot__}/aculo/prototype.js"></script>
	<script type="text/javascript" src="{$__BaseJsRoot__}/aculo/scriptaculous.js"></script>
	<script type="text/javascript" src="{$__BaseJsRoot__}/admin.js"></script>

<script type="text/javascript" src="{$__BaseJsRoot__}/windows/window.js"> </script> 
<link href="{$__BaseJsRoot__}/windows/themes/default.css" rel="stylesheet" type="text/css" />
<link href="{$__BaseJsRoot__}/windows/themes/alphacube.css" rel="stylesheet" type="text/css" />
{$__header__}
<script type="text/javascript">parent.del_progress();</script>
</head>
<body id="body"> 
<table id="data_list_body" cellpadding="0" cellspacing="0">
<tr><td valign="top">{wt_push_module}</td></tr>
</table>
{$__footer__}
<script type="text/javascript">
{literal}
$('body').setStyle({ width: parent.$('mod_content').getWidth()-10+'px' } );
{/literal}
</script> 
</body>
</html>