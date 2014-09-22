<?php /* Smarty version 2.6.16, created on 2013-04-29 08:38:12
         compiled from /var/www/vhosts/klmchauffeurs.com/httpdocs/templates/admin2/source/modules/mod_languages_manager/sub/currentModInfo.tpl */ ?>
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
					<td class="currentItemInfoT-d">
						<h3><?php echo $this->_tpl_vars['item_data']['mod_title']; ?>
</h3>
					</td>
					<td>&nbsp;</td>
					<td class="currentItemInfoT-t">&nbsp;</td>

					<td class="currentItemInfoT-o">
						<a href="#" onClick="generateFiles(<?php echo $this->_tpl_vars['item_data']['mod_id']; ?>
); return false" onmouseover="parent.displayLeftHint(genFilesHint); return false" onmouseout="parent.hideLeftHint(); return false" title=" generuj "><img src="<?php echo $this->_tpl_vars['__imageRoot__']; ?>
/trash.png" alt=" usuń" border="0" width="16" height="16"> generuj plik</a>
				</tr>
			</table>
		</td>
	</tr>
</table>
<?php endif; ?>