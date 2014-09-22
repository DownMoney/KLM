<?php /* Smarty version 2.6.16, created on 2013-05-06 10:12:22
         compiled from mod_menu.tpl */ ?>
<script type="text/javascript"> 
 setAdminMenu = function() {
    		   menu = '<table cellspacing="0" cellpadding="0">';
				menu += '<tr>';
			<?php if ($this->_tpl_vars['menu_data']): ?>
			
			<?php $_from = $this->_tpl_vars['menu_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['menu_data'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['menu_data']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['m']):
        $this->_foreach['menu_data']['iteration']++;
?>
			<?php if ($this->_tpl_vars['m']['sep']): ?>
			menu += '<td class="mm_sep">&nbsp;</td>';
						<?php else: ?>
			menu += '<td<?php if ($this->_tpl_vars['m']['class']): ?> class="<?php echo $this->_tpl_vars['m']['class']; ?>
"<?php endif; ?>>';
			menu += '<a href="<?php echo $this->_tpl_vars['m']['href']; ?>
" <?php if ($this->_tpl_vars['m']['action_form']): ?>onClick="action_form(this.href, \'<?php echo $this->_tpl_vars['m']['awt']; ?>
\'); return false;" <?php elseif ($this->_tpl_vars['m']['action_form_large']): ?>onClick="action_form_large(this.href, \'<?php echo $this->_tpl_vars['m']['awt']; ?>
\'); return false;"<?php endif; ?> <?php if ($this->_tpl_vars['m']['target']): ?>target="<?php echo $this->_tpl_vars['m']['target']; ?>
"<?php endif; ?>><span>';
			<?php if ($this->_tpl_vars['m']['ico']): ?>
			menu += '<img src="<?php echo $this->_tpl_vars['__imageRoot__']; ?>
/icons/<?php echo $this->_tpl_vars['m']['ico']; ?>
.gif" align="absmiddle"   />';
			<?php endif; ?>
			menu += '<?php echo $this->_tpl_vars['m']['name']; ?>
</span></a>'
			menu += '</td>';
			<?php endif; ?>
			<?php endforeach; endif; unset($_from); ?>
			
			<?php else: ?>
			menu += "<td>nie zdefiniowano menu</td>";
			<?php endif; ?>
			menu += '</tr>';
    		menu += '</table>';
			<?php if ($this->_tpl_vars['admin_mode']): ?>
			$('mod_menu_admin').innerHTML = menu;
			<?php else: ?>
    		$('mod_menu').innerHTML = menu;
			<?php endif; ?>
			del_progress();
}
setAdminMenu();    		
</script>