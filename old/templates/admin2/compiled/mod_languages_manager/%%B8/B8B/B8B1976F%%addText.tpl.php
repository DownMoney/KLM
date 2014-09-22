<?php /* Smarty version 2.6.16, created on 2013-04-29 08:42:49
         compiled from addText.tpl */ ?>
<?php echo $this->_tpl_vars['addText_form']; ?>


<script language="javascript" type="text/javascript">
		Interface.setEditFormDim();
		addTextTab = new tabs();
		addTextTab.cycleTab('tab1');
		var observeFieldsList = new Array('txt_key', 'mod_id', 'txt_value_<?php echo $this->_tpl_vars['__languagesCurLanguage__']['id']; ?>
');  
		var observeFieldsTree = new Array();
		
		<?php echo '	 
	 Interface.setRecordChanges({list: observeFieldsList, tree: observeFieldsTree});
	 '; ?>

</script> 