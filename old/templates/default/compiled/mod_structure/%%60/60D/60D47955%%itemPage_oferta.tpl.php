<?php /* Smarty version 2.6.16, created on 2014-03-24 20:11:19
         compiled from modules/mod_structure/itemPage_oferta.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'mailto', 'modules/mod_structure/itemPage_oferta.tpl', 5, false),array('function', 'wt_href_tpl_link', 'modules/mod_structure/itemPage_oferta.tpl', 11, false),array('modifier', 'strip_quotas', 'modules/mod_structure/itemPage_oferta.tpl', 11, false),array('modifier', 'strip_tags', 'modules/mod_structure/itemPage_oferta.tpl', 12, false),array('modifier', 'truncate', 'modules/mod_structure/itemPage_oferta.tpl', 12, false),)), $this); ?>
<div class="mDesc">
	<div class="mDesc_div">
		<div class="phone">
			Call: <?php echo @TEXT_PHONE; ?>

			<span>E-mail: <?php echo smarty_function_mailto(array('address' => @TEXT_MAIL,'encode' => 'hex'), $this);?>
</span>
		</div>
		<br clear="all" />
		<h1><?php echo $this->_tpl_vars['item']['it_name']; ?>
</h1>
		<?php $_from = $this->_tpl_vars['items_listing']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['items_listing'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['items_listing']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['it']):
        $this->_foreach['items_listing']['iteration']++;
?>
		<div class="list <?php if (($this->_foreach['items_listing']['iteration'] == $this->_foreach['items_listing']['total'])): ?>listLast<?php endif; ?>">
			<h2><a href="<?php echo smarty_function_wt_href_tpl_link(array('mod_key' => 'mod_structure','parameters' => "t=iP&cPath=".($this->_tpl_vars['it']['cPath'])), $this);?>
" title=" Zobacz <?php echo ((is_array($_tmp=$this->_tpl_vars['it']['it_name'])) ? $this->_run_mod_handler('strip_quotas', true, $_tmp) : smarty_modifier_strip_quotas($_tmp)); ?>
 "><?php echo $this->_tpl_vars['it']['it_name']; ?>
</a></h2>
			<?php if ($this->_tpl_vars['it']['_desc_short_from_full']):  echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['it']['it_desc_short'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, '240') : smarty_modifier_truncate($_tmp, '240'));  else:  echo $this->_tpl_vars['it']['it_desc_short'];  endif; ?>
			<a class="more" href="<?php echo smarty_function_wt_href_tpl_link(array('mod_key' => 'mod_structure','parameters' => "t=iP&cPath=".($this->_tpl_vars['it']['cPath'])), $this);?>
" title=" Zobacz <?php echo ((is_array($_tmp=$this->_tpl_vars['it']['it_name'])) ? $this->_run_mod_handler('strip_quotas', true, $_tmp) : smarty_modifier_strip_quotas($_tmp)); ?>
 "><?php echo @TEXT_MORE; ?>
 &raquo;</a>
		</div>
		<?php endforeach; endif; unset($_from); ?>
	</div>
</div>