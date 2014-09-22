<?php /* Smarty version 2.6.16, created on 2013-05-06 10:12:21
         compiled from /var/www/vhosts/klmchauffeurs.com/httpdocs/templates/admin2/source/modules/mod_structure_manager/sub/currentItemInfo.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'wt_thumb_image', '/var/www/vhosts/klmchauffeurs.com/httpdocs/templates/admin2/source/modules/mod_structure_manager/sub/currentItemInfo.tpl', 11, false),array('function', 'wt_href_tpl_link', '/var/www/vhosts/klmchauffeurs.com/httpdocs/templates/admin2/source/modules/mod_structure_manager/sub/currentItemInfo.tpl', 22, false),array('modifier', 'strip_tags', '/var/www/vhosts/klmchauffeurs.com/httpdocs/templates/admin2/source/modules/mod_structure_manager/sub/currentItemInfo.tpl', 20, false),array('modifier', 'truncate', '/var/www/vhosts/klmchauffeurs.com/httpdocs/templates/admin2/source/modules/mod_structure_manager/sub/currentItemInfo.tpl', 20, false),)), $this); ?>
<?php if ($this->_tpl_vars['item_data']): ?>
<table id="currentItemInfo" class="currentItemInfo" cellspacing="0">
	<tr>
		<td class="navigationBar"><?php echo $this->_tpl_vars['__navigationBar__']; ?>
</td>
	</tr>
	<tr><td class="sep"></td></tr>
	<tr>
		<td>
			<table class="currentItemInfoT" cellspacing="0">
				<tr>
					<td class="currentItemInfoT-i"><?php echo smarty_function_wt_thumb_image(array('src' => "mod_structure/".($this->_tpl_vars['item_data']['it_id'])."/".($this->_tpl_vars['item_data']['it_logo']),'width' => '50','height' => '30','compress' => '75','show_blank' => '1'), $this);?>
</td>
					<td class="currentItemInfoT-d">
						<h3><?php echo $this->_tpl_vars['item_data']['it_name']; ?>
</h3>
						<?php if ($this->_tpl_vars['item_data']['it_desc']): ?>
						<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['item_data']['it_desc'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, '175') : smarty_modifier_truncate($_tmp, '175')); ?>
<br />
						<?php endif; ?>
						<b>Adres WWW:</b> <input type="text" value="<?php echo smarty_function_wt_href_tpl_link(array('mod_key' => 'mod_structure','parameters' => "t=iP&cPath=".($this->_tpl_vars['item_data']['cPath']),'full_url' => true), $this);?>
" /> <a href="<?php echo smarty_function_wt_href_tpl_link(array('mod_key' => 'mod_structure','parameters' => "t=iP&cPath=".($this->_tpl_vars['item_data']['cPath'])), $this);?>
" target="_blank">przejdź &raquo;</a>
					</td>
					<td>&nbsp;</td>
					<td class="currentItemInfoT-t"><img src="<?php echo $this->_tpl_vars['__imageRoot__']; ?>
/tree/<?php echo $this->_tpl_vars['item_data']['itt_ico']; ?>
_s.gif" align="absmiddle" alt="" /><br />
<small><?php if ($this->_tpl_vars['__isRoot__']): ?><a href="<?php echo smarty_function_wt_href_tpl_link(array('parameters' => "m=fields&tID=".($this->_tpl_vars['item_data']['it_type'])), $this);?>
"><?php echo $this->_tpl_vars['item_data']['itt_name']; ?>
</a><?php else:  echo $this->_tpl_vars['item_data']['itt_name'];  endif; ?></small></td>
<?php if ($this->_tpl_vars['item_data']['itt_root_edit'] == '0' || $this->_tpl_vars['__isRoot__']): ?>
					<td class="currentItemInfoT-o">
					  <a href="<?php echo smarty_function_wt_href_tpl_link(array('parameters' => "m=items&t=moveItem&cPath=".($this->_tpl_vars['item_data']['cPath'])."&iID=".($this->_tpl_vars['item_data']['it_id'])), $this);?>
" onclick="parent.action_form(this.href, 'Przenieś wpis'); return false;" title=" przenieś "><img src="<?php echo $this->_tpl_vars['__imageRoot__']; ?>
/move.png" alt="przenieś wpis" align="absmiddle" /> przenieś</a>	
		<a href="<?php echo smarty_function_wt_href_tpl_link(array('parameters' => "m=items&t=addItem&cPath=".($this->_tpl_vars['item_data']['cPath'])."&cID=".($_GET['cID'])."&iID=".($this->_tpl_vars['item_data']['it_id'])."&from=admin_list"), $this);?>
" onclick="parent.action_form_large(this.href, 'Edycja wpisu<?php if ($this->_tpl_vars['__languagesCurLanguage__']): ?> - język: <?php echo $this->_tpl_vars['__languagesCurLanguage__']['name'];  endif; ?>'); return false;" title=" edytuj "><img src="<?php echo $this->_tpl_vars['__imageRoot__']; ?>
/edit.png" alt=" edytuj " align="absmiddle" /> edytuj</a>
		<a href="#" onClick="parent.action_form('<?php echo smarty_function_wt_href_tpl_link(array('mod_key' => 'mod_structure_manager','parameters' => "m=items&t=deleteItem&cID=".($_GET['cID'])."&iID=".($this->_tpl_vars['item_data']['it_id'])."&cPath=".($this->_tpl_vars['item_data']['cPath'])), $this);?>
', 'Usuń wpis')" title=" usuń "><img src="<?php echo $this->_tpl_vars['__imageRoot__']; ?>
/trash.png" alt=" usuń " align="absmiddle" /> usuń</a></td>
<?php endif; ?>
				</tr>
			</table>
		</td>
	</tr>
</table>
<?php endif; ?>