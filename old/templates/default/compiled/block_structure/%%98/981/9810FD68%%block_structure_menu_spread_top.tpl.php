<?php /* Smarty version 2.6.16, created on 2014-04-01 21:27:55
         compiled from blocks/block_structure/block_structure_menu_spread_top.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'wt_href_tpl_link', 'blocks/block_structure/block_structure_menu_spread_top.tpl', 3, false),array('modifier', 'strip_quotas', 'blocks/block_structure/block_structure_menu_spread_top.tpl', 5, false),)), $this); ?>
<div class="menu">
	<ul>
		<li class="menuFirst"><a href="<?php echo smarty_function_wt_href_tpl_link(array('mod_key' => 'home'), $this);?>
" title=" <?php echo @SITE_NAME; ?>
 "><?php echo @TEXT_MPAGE; ?>
</a></li>
		<?php $_from = ($this->_tpl_vars['BCMS_structure']); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['BCMS_structure'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['BCMS_structure']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['it']):
        $this->_foreach['BCMS_structure']['iteration']++;
?>
			<li><a <?php if ($_GET['mod'] == '82' && $_REQUEST['cPath'] == $this->_tpl_vars['it']['cPath']): ?>id="active"<?php endif; ?> href="<?php echo smarty_function_wt_href_tpl_link(array('mod_key' => 'mod_structure','parameters' => "t=iP&cPath=".($this->_tpl_vars['it']['cPath'])), $this);?>
" title=" <?php echo ((is_array($_tmp=$this->_tpl_vars['it']['it_name'])) ? $this->_run_mod_handler('strip_quotas', true, $_tmp) : smarty_modifier_strip_quotas($_tmp)); ?>
 "><?php echo $this->_tpl_vars['it']['it_name']; ?>
</a></li>
		<?php endforeach; endif; unset($_from); ?>
	</ul></div>