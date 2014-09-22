<?php /* Smarty version 2.6.16, created on 2013-04-29 08:42:53
         compiled from modules/mod_admin_manager/formSaved.tpl */ ?>
<script type="text/javascript">
<?php if ($this->_tpl_vars['_formType'] == 'popup'): ?>
	
	<?php if ($this->_tpl_vars['op'] != 'save'): ?>
		<?php if ($_GET['_return2']): ?>
			parent.document.location.href = '<?php echo $this->_tpl_vars['site_url']; ?>
';
		<?php else: ?>
			parent.window.close();
		<?php endif; ?>
	<?php endif; ?>

	<?php if ($this->_tpl_vars['opA'] == 'add' && $this->_tpl_vars['form_url'] && $this->_tpl_vars['op'] != 'save_close'): ?>
		parent.document.location.href = '<?php echo $this->_tpl_vars['form_url']; ?>
';
	<?php endif; ?>

<?php else:  if ($this->_tpl_vars['op'] != 'save'): ?>
parent.hide_action_form_large(1);
<?php endif; ?>

<?php if ($this->_tpl_vars['opA'] == 'add' && $this->_tpl_vars['form_url'] && $this->_tpl_vars['op'] != 'save_close'): ?>
tit = parent.$('navTabForm').innerHTML;
parent.action_form_large('<?php echo $this->_tpl_vars['form_url']; ?>
', tit.stripTags());
<?php endif; ?>

parent.set_success();
<?php if (! $this->_tpl_vars['dRT'] || $this->_tpl_vars['dRT'] != '1'): ?>
parent.setStructureTree();
<?php endif; ?>

<?php if (! $this->_tpl_vars['dRL'] || $this->_tpl_vars['dRL'] != '1'): ?>
parent.updateSite('<?php echo $this->_tpl_vars['site_url']; ?>
');
<?php endif; ?>


<?php if ($this->_tpl_vars['system_message']): ?>
	parent.$('system_message').update('<?php echo $this->_tpl_vars['system_message']['title']; ?>
');
	parent.$('system_message').show();
	<?php echo '
	
	parent.Effect.Pulsate(\'system_message\', {duration: 1, pulses:1});
	setTimeout(function() { parent.Effect.Fade(\'system_message\'); }, 5000);
	'; ?>

<?php endif;  endif; ?>
</script>