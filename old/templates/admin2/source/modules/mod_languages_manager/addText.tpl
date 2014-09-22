{$addText_form}

<script language="javascript" type="text/javascript">
		Interface.setEditFormDim();
		addTextTab = new tabs();
		addTextTab.cycleTab('tab1');
		var observeFieldsList = new Array('txt_key', 'mod_id', 'txt_value_{$__languagesCurLanguage__.id}');  
		var observeFieldsTree = new Array();
		
		{literal}	 
	 Interface.setRecordChanges({list: observeFieldsList, tree: observeFieldsTree});
	 {/literal}
</script> 