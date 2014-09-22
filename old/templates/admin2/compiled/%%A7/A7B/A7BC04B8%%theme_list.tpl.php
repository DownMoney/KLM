<?php /* Smarty version 2.6.16, created on 2013-05-06 10:12:21
         compiled from theme_list.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'wt_push_module', 'theme_list.tpl', 17, false),)), $this); ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" href="<?php echo $this->_tpl_vars['__cssRoot__']; ?>
/theme_list.css" type="text/css" />
	<script type="text/javascript" src="<?php echo $this->_tpl_vars['__BaseJsRoot__']; ?>
/aculo/prototype.js"></script>
	<script type="text/javascript" src="<?php echo $this->_tpl_vars['__BaseJsRoot__']; ?>
/aculo/scriptaculous.js"></script>
	<script type="text/javascript" src="<?php echo $this->_tpl_vars['__BaseJsRoot__']; ?>
/admin.js"></script>

<script type="text/javascript" src="<?php echo $this->_tpl_vars['__BaseJsRoot__']; ?>
/windows/window.js"> </script> 
<link href="<?php echo $this->_tpl_vars['__BaseJsRoot__']; ?>
/windows/themes/default.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $this->_tpl_vars['__BaseJsRoot__']; ?>
/windows/themes/alphacube.css" rel="stylesheet" type="text/css" />
<?php echo $this->_tpl_vars['__header__']; ?>

<script type="text/javascript">parent.del_progress();</script>
</head>
<body id="body"> 
<table id="data_list_body" cellpadding="0" cellspacing="0">
<tr><td valign="top"><?php echo smarty_function_wt_push_module(array(), $this);?>
</td></tr>
</table>
<?php echo $this->_tpl_vars['__footer__']; ?>

<script type="text/javascript">
<?php echo '
$(\'body\').setStyle({ width: parent.$(\'mod_content\').getWidth()-10+\'px\' } );
'; ?>

</script> 
</body>
</html>