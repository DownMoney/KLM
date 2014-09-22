<?php /* Smarty version 2.6.16, created on 2013-04-25 12:56:47
         compiled from blocks/block_menu/block_JSCookMenu.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'wt_mod_id', 'blocks/block_menu/block_JSCookMenu.tpl', 16, false),)), $this); ?>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['__jsRoot__']; ?>
/JSCookMenu.js">
</script>
<link rel="stylesheet" href="<?php echo $this->_tpl_vars['__mediaRoot__']; ?>
/jsCookMenu/ThemeOffice/theme.css" type="text/css">
<script type="text/javascript" src="<?php echo $this->_tpl_vars['__mediaRoot__']; ?>
/jsCookMenu/ThemeOffice/theme.js"></script>

</script>

<script language="JavaScript" type="text/javascript">
	var adminMenu = 
	[
	<?php if (!function_exists('smarty_fun_JSCookMenu')) { function smarty_fun_JSCookMenu(&$smarty, $params) { $_fun_tpl_vars = $smarty->_tpl_vars; $smarty->assign($params);  ?>
	<?php $_from = $smarty->_tpl_vars['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $smarty->_tpl_vars['link']):
?>
	<?php if ($smarty->_tpl_vars['link']['type'] == 'separator'): ?>
	_cmSplit,
	<?php else: ?> 
	['<?php if ($smarty->_tpl_vars['link']['icon_left']): ?><img src="<?php echo $smarty->_tpl_vars['__imageRoot__']; ?>
/icons/<?php echo $smarty->_tpl_vars['link']['icon_left']; ?>
" alt=" <?php echo $smarty->_tpl_vars['link']['name']; ?>
 " width="16" height="16"><?php endif; ?>', '<?php echo $smarty->_tpl_vars['link']['name']; ?>
', '<?php if ($smarty->_tpl_vars['link']['type'] == 'mod_link'): ?>javascript:loadModule(\'<?php echo smarty_function_wt_mod_id(array('m' => $smarty->_tpl_vars['link']['module']), $smarty);?>
\', \'<?php echo $smarty->_tpl_vars['link']['name']; ?>
\');<?php elseif ($smarty->_tpl_vars['link']['type'] == 'outside_link'):  echo $smarty->_tpl_vars['link']['link'];  elseif ($smarty->_tpl_vars['link']['type'] == 'javascript'): ?>javascript:<?php echo $smarty->_tpl_vars['link']['link'];  endif; ?>', '', '' <?php if ($smarty->_tpl_vars['link']['children']): ?>, <?php smarty_fun_JSCookMenu($smarty, array('list'=>$smarty->_tpl_vars['link']['children']));  ?> ], <?php else: ?> ], <?php endif; ?>
	<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
	<?php  $smarty->_tpl_vars = $_fun_tpl_vars; }} smarty_fun_JSCookMenu($this, array('list'=>$this->_tpl_vars['block_menu_tree']));  ?>
	<?php if ($this->_tpl_vars['__isRoot__']): ?>
	, ['<img src="<?php echo $this->_tpl_vars['__imageRoot__']; ?>
/root_view.gif" width="16" height="16">', '', '', '', '', ['', 'Bloki', 'javascript:loadModule("<?php echo smarty_function_wt_mod_id(array('m' => 'mod_blocks_manager'), $this);?>
", "Bloki");'], ['', 'Moduły', 'javascript:loadModule("<?php echo smarty_function_wt_mod_id(array('m' => 'mod_modules_manager'), $this);?>
", "Moduły");'], ['', 'Menu', 'javascript:loadModule("<?php echo smarty_function_wt_mod_id(array('m' => 'mod_menu_manager'), $this);?>
", "Menu");'], ['', 'Konfiguracja', 'javascript:loadModule("<?php echo smarty_function_wt_mod_id(array('m' => 'mod_configuration_manager'), $this);?>
", "Konfiguracja");'], ['', 'Użytkownicy', 'javascript:loadModule("<?php echo smarty_function_wt_mod_id(array('m' => 'mod_user_manager'), $this);?>
", "Użytkownicy");'] ]
	<?php endif; ?>
	];

</script>

<div id="adminMenu">
</div>

<script type="text/javascript">
	cmDraw ('adminMenu', adminMenu, 'hbr', cmThemeOffice, 'ThemeOffice');
</script>