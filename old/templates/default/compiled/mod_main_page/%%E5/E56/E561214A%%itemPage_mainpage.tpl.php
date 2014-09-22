<?php /* Smarty version 2.6.16, created on 2014-04-01 21:27:55
         compiled from /var/www/vhosts/klmchauffeurs.com/httpdocs/templates/default/source/modules/mod_structure/itemPage_mainpage.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'mailto', '/var/www/vhosts/klmchauffeurs.com/httpdocs/templates/default/source/modules/mod_structure/itemPage_mainpage.tpl', 5, false),array('function', 'wt_thumb_image', '/var/www/vhosts/klmchauffeurs.com/httpdocs/templates/default/source/modules/mod_structure/itemPage_mainpage.tpl', 8, false),)), $this); ?>
<?php if ($this->_tpl_vars['item']['it_logo'] || $this->_tpl_vars['item']['it_desc']): ?>
	<div class="mDesc">
		<div class="phone">
		Call: <?php echo @TEXT_PHONE; ?>

		<span>E-mail: <?php echo smarty_function_mailto(array('address' => @TEXT_MAIL,'encode' => 'hex'), $this);?>
</span>
		</div>
		<div class="mDesc_div">
		<?php echo smarty_function_wt_thumb_image(array('src' => "mod_structure/".($this->_tpl_vars['item']['media_path'])."/".($this->_tpl_vars['item']['it_logo']),'width' => '240','class' => 'logoPds','compress' => '85','show_blank' => '0','alt' => ($this->_tpl_vars['item']['it_name'])), $this); echo $this->_tpl_vars['item']['it_desc']; ?>

		</div>
	</div>
<?php endif; ?>