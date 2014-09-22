<?php /* Smarty version 2.6.16, created on 2014-03-29 03:31:32
         compiled from modules/mod_structure/itemPage_ofepds.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'mailto', 'modules/mod_structure/itemPage_ofepds.tpl', 5, false),array('function', 'wt_thumb_image', 'modules/mod_structure/itemPage_ofepds.tpl', 10, false),)), $this); ?>

	<div class="mDesc">
		<div class="phone">
			Call: <?php echo @TEXT_PHONE; ?>

			<span>E-mail: <?php echo smarty_function_mailto(array('address' => @TEXT_MAIL,'encode' => 'hex'), $this);?>
</span>
		</div>
		<br clear="all" />
		<h1><?php echo $this->_tpl_vars['item']['it_name']; ?>
</h1>
		<div class="mDesc_div">
		<?php echo smarty_function_wt_thumb_image(array('src' => "mod_structure/".($this->_tpl_vars['item']['media_path'])."/".($this->_tpl_vars['item']['it_logo']),'width' => '240','class' => 'logoPds','compress' => '85','show_blank' => '0','alt' => ($this->_tpl_vars['item']['it_name'])), $this); echo $this->_tpl_vars['item']['it_desc']; ?>

		</div>
	</div>