<?php /* Smarty version 2.6.16, created on 2014-04-01 21:27:56
         compiled from blocks/block_structure/block_items_oferta.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'wt_href_tpl_link', 'blocks/block_structure/block_items_oferta.tpl', 4, false),array('modifier', 'strip_quotas', 'blocks/block_structure/block_items_oferta.tpl', 4, false),)), $this); ?>
<div class="bl_offer">
<?php $_from = $this->_tpl_vars['BL_items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['BL_items'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['BL_items']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['it']):
        $this->_foreach['BL_items']['iteration']++;
?>
	<div class="bl_offer_div <?php if (($this->_foreach['BL_items']['iteration'] <= 1)): ?>offFirst<?php endif; ?>">
		<h3><a href="<?php echo smarty_function_wt_href_tpl_link(array('mod_key' => 'mod_structure','parameters' => "t=iP&cPath=".($this->_tpl_vars['it']['cPath'])), $this);?>
" title=" <?php echo ((is_array($_tmp=$this->_tpl_vars['it']['it_name'])) ? $this->_run_mod_handler('strip_quotas', true, $_tmp) : smarty_modifier_strip_quotas($_tmp)); ?>
 "><?php echo $this->_tpl_vars['it']['it_name']; ?>
</a></h3>
		<a class="bl_<?php echo $this->_tpl_vars['it']['it_id']; ?>
" href="<?php echo smarty_function_wt_href_tpl_link(array('mod_key' => 'mod_structure','parameters' => "t=iP&cPath=".($this->_tpl_vars['it']['cPath'])), $this);?>
" title=" <?php echo ((is_array($_tmp=$this->_tpl_vars['it']['it_name'])) ? $this->_run_mod_handler('strip_quotas', true, $_tmp) : smarty_modifier_strip_quotas($_tmp)); ?>
 "><img src="<?php echo $this->_tpl_vars['__imageRoot__']; ?>
/bl_<?php echo $this->_tpl_vars['it']['it_id']; ?>
.jpg" alt=""></a>
	</div>
<?php endforeach; endif; unset($_from); ?>