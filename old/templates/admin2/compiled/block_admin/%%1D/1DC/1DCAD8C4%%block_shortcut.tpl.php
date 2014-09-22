<?php /* Smarty version 2.6.16, created on 2013-04-25 12:56:47
         compiled from blocks/block_admin/block_shortcut.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'wt_mod_id', 'blocks/block_admin/block_shortcut.tpl', 9, false),array('modifier', 'strip_quotas', 'blocks/block_admin/block_shortcut.tpl', 9, false),)), $this); ?>
<table width="200" height="100%" cellpadding="0" cellspacing="0">
<tr>
	<td valign="top" height="100%" id="sT"></td>
</tr>
<?php if ($this->_tpl_vars['structure_modules']): ?>
<tr>
	<td class="sM">
	<?php $_from = $this->_tpl_vars['structure_modules']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['structure'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['structure']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['m']):
        $this->_foreach['structure']['iteration']++;
?>
		<a href="#" onClick="loadModule('<?php echo smarty_function_wt_mod_id(array('m' => $this->_tpl_vars['m']['k']), $this);?>
', '<?php echo $this->_tpl_vars['m']['n']; ?>
'); return false" title=" <?php echo ((is_array($_tmp=$this->_tpl_vars['m']['n'])) ? $this->_run_mod_handler('strip_quotas', true, $_tmp) : smarty_modifier_strip_quotas($_tmp)); ?>
 "><img src="<?php echo $this->_tpl_vars['__imageRoot__']; ?>
/modules/<?php echo $this->_tpl_vars['m']['k']; ?>
_s.gif" align="absmiddle" alt=""><?php echo $this->_tpl_vars['m']['n']; ?>
</a>
	<?php endforeach; endif; unset($_from); ?>
	<span style="float:left;" class="czyIExplorerJestNieNormalny"><b></b></span>
	</td> 
</tr>
<?php endif; ?>
</table>