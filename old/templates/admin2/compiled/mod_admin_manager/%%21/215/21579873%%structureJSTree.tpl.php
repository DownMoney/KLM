<?php /* Smarty version 2.6.16, created on 2013-05-06 10:12:22
         compiled from structureJSTree.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'wt_href_tpl_link', 'structureJSTree.tpl', 32, false),array('modifier', 'truncate', 'structureJSTree.tpl', 48, false),array('modifier', 'escape', 'structureJSTree.tpl', 57, false),)), $this); ?>
<style type="text/css">
<?php echo '
.sTT a {
	color:#FFFFFF;
	font-family:trebuchet MS;
	font-size:12px;
	font-weight:bold;
	text-decoration:none;
	padding: 2px 3px 2px 3px;
}

.sTT a:hover {
	background: #E2E2E2 none repeat scroll 0%;
	border: 1px solid #F1F3F5; 
	padding: 2px 2px 2px 2px;
}
	


'; ?>

</style>

<script language="javascript" type="text/javascript">
<?php echo '
if( $(\'structureJSTreeID\') ) {
$(\'structureJSTreeID\').style.height = Element.getHeight(\'sT\')-48+\'px\';
}
	
	
reloadTree = function(mod) {
setWaitingStatus(\'sT\',true);
	new Ajax.Updater(\'sT\', \'';  echo smarty_function_wt_href_tpl_link(array('mod_key' => 'mod_admin_manager','parameters' => "t=structureJSTree&wm='+mod+'"), $this); echo '\', {
		evalScripts:true, 
		asynchronous:true,
		onComplete: function() { setWaitingStatus(\'sT\',false); }
		});
}
'; ?>

</script>

<table cellspacing="0" cellpadding="0" width="100%">
	<tr>
		<td class="sTT">Menu
	<a href="#" onclick="reloadTree('<?php echo $this->_tpl_vars['mod']['mod_id']; ?>
'); return false"><img src="<?php echo $this->_tpl_vars['__imageRoot__']; ?>
/reload_menu.gif" alt="pd" align="absmiddle"/></a>
	<a href="#" onClick="expandTree();">+</a>/<a href="#" onClick="colapseTree();">-</a></td>
	</tr>
	<tr>
		<td class="sTTs"><a onClick="loadModule('<?php echo $this->_tpl_vars['mod']['mod_id']; ?>
', '<?php echo $this->_tpl_vars['mod']['mod_name']; ?>
'); return false" href="#"><?php if ($this->_tpl_vars['mod']['mod_key'] == 'mod_structure_manager'):  echo ((is_array($_tmp=@SITE_NAME)) ? $this->_run_mod_handler('truncate', true, $_tmp, 18, "") : smarty_modifier_truncate($_tmp, 18, ""));  else:  echo $this->_tpl_vars['mod']['mod_name'];  endif; ?></a></td>
	</tr>
</table>

<?php if ($this->_tpl_vars['structure']): ?>
<script type="text/javascript">
 <?php if (!function_exists('smarty_fun_add_doc')) { function smarty_fun_add_doc(&$smarty, $params) { $_fun_tpl_vars = $smarty->_tpl_vars; $smarty->assign($params);   if ($smarty->_tpl_vars['doc']): ?>
 <?php $_from = $smarty->_tpl_vars['doc']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$smarty->_foreach['docs'] = array('total' => count($_from), 'iteration' => 0);
if ($smarty->_foreach['docs']['total'] > 0):
    foreach ($_from as $smarty->_tpl_vars['d']):
        $smarty->_foreach['docs']['iteration']++;
?>
 ['<?php if ($smarty->_tpl_vars['d']['ico'] == ""): ?><img src="<?php echo $smarty->_tpl_vars['__imageRoot__']; ?>
/tree/e_doc.gif" <?php if ($smarty->_tpl_vars['d']['status'] == '0'): ?>style="opacity: 0.25;filter:alpha(opacity=25);"<?php endif; ?>><?php else: ?><img src="<?php echo $smarty->_tpl_vars['__imageRoot__']; ?>
/tree/<?php echo $smarty->_tpl_vars['d']['ico']; ?>
" <?php if ($smarty->_tpl_vars['d']['status'] == '0'): ?>style="opacity: 0.25;filter:alpha(opacity=25);"<?php endif; ?>><?php endif; ?>', '<span<?php if ($smarty->_tpl_vars['d']['status'] == '0'): ?> style="opacity: 0.25;filter:alpha(opacity=25);"<?php endif; ?>><?php echo ((is_array($_tmp=$smarty->_tpl_vars['d']['name'])) ? $smarty->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
</span>', '<?php echo $smarty->_tpl_vars['d']['url']; ?>
', 'mod_content', '']<?php if (! ($smarty->_foreach['docs']['iteration'] == $smarty->_foreach['docs']['total'])): ?>,<?php endif; ?>
 <?php endforeach; endif; unset($_from); ?>
 <?php endif; ?>
 <?php  $smarty->_tpl_vars = $_fun_tpl_vars; }} smarty_fun_add_doc($this, array('doc'=>$this->_tpl_vars['list2']));  ?>
 
 <?php if (!function_exists('smarty_fun_add_folder')) { function smarty_fun_add_folder(&$smarty, $params) { $_fun_tpl_vars = $smarty->_tpl_vars; $smarty->assign($params);  ?>
 <?php if ($smarty->_tpl_vars['folders']): ?>
 <?php $_from = $smarty->_tpl_vars['folders']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$smarty->_foreach['folders'] = array('total' => count($_from), 'iteration' => 0);
if ($smarty->_foreach['folders']['total'] > 0):
    foreach ($_from as $smarty->_tpl_vars['f']):
        $smarty->_foreach['folders']['iteration']++;
?>
 ['<?php if ($smarty->_tpl_vars['f']['ico'] == ""): ?><img src="<?php echo $smarty->_tpl_vars['__imageRoot__']; ?>
/tree/e_folder.gif" <?php if ($smarty->_tpl_vars['d']['status'] == '0'): ?>style="opacity: 0.25;filter:alpha(opacity=25);"<?php endif; ?>><?php else: ?><img src="<?php echo $smarty->_tpl_vars['__imageRoot__']; ?>
/tree/<?php echo $smarty->_tpl_vars['f']['ico']; ?>
" <?php if ($smarty->_tpl_vars['f']['status'] == '0'): ?>style="opacity: 0.25;filter:alpha(opacity=25);"<?php endif; ?>><?php endif; ?>', '<span<?php if ($smarty->_tpl_vars['f']['status'] == '0'): ?> style="opacity: 0.25;filter:alpha(opacity=25);"<?php endif; ?>><?php echo ((is_array($_tmp=$smarty->_tpl_vars['f']['name'])) ? $smarty->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
</span>', <?php if ($smarty->_tpl_vars['f']['url']): ?>'<?php echo $smarty->_tpl_vars['f']['url']; ?>
'<?php else: ?>null<?php endif; ?>, 'mod_content', '' <?php if ($smarty->_tpl_vars['f']['docs']): ?>, <?php smarty_fun_add_doc($smarty, array('doc'=>$smarty->_tpl_vars['f']['docs']));  ?> <?php endif; ?> <?php if ($smarty->_tpl_vars['f']['children']): ?>, <?php smarty_fun_add_folder($smarty, array('folders'=>$smarty->_tpl_vars['f']['children']));  ?> ], <?php else: ?> ], <?php endif; ?>
 <?php endforeach; endif; unset($_from); ?>
 <?php endif; ?>
 <?php  $smarty->_tpl_vars = $_fun_tpl_vars; }} smarty_fun_add_folder($this, array('folders'=>$this->_tpl_vars['fol']));  ?>

  structureJSTree = 
 [
 <?php if ($this->_tpl_vars['structure']['docs']):  smarty_fun_add_doc($this, array('doc'=>$this->_tpl_vars['structure']['docs']));  ?>, <?php endif; ?>
 <?php if ($this->_tpl_vars['structure']['children']): ?>, <?php smarty_fun_add_folder($this, array('folders'=>$this->_tpl_vars['structure']['children']));  ?> <?php endif; ?>
 ];
 

</script> 
<div id="structureJSTreeID"></div>

<script type="text/javascript">
<?php echo '
_ctIDSubMenuCount = 0;
_ctIDSubMenu = \'ctSubTreeID\';
_ctCurrentItem = null;
_ctNoAction = new Object();
_ctItemList = new Array();
_ctTreeList = new Array();
_ctMenuList = new Array();

tree = ctDraw(\'structureJSTreeID\', structureJSTree, ctThemeXP1, \'ThemeXP\', 0, 0);
;

structureTreeSetItem = function(url) {
	 	treeid = ctExposeItem(tree, url);		
if(treeid) {
 		ctOpenFolder(treeid);
	}
}

expandTree = function() {
	 ctExpandTree(\'structureJSTreeID\', 10); 
}

colapseTree = function() {
	 ctCollapseTree(\'structureJSTreeID\'); 
}

'; ?>

</script>

<?php endif; ?>