{$addField_form}
<script language="javascript" type="text/javascript">
{literal}
	 Interface.setEditFormDim();
	 addItemTab = new tabs();
	 addItemTab.cycleTab('tab1');
	 var observeFieldsList = new Array('fi_name', 'fi_gr');	 
	 Interface.setRecordChanges({list: observeFieldsList});
{/literal}	
</script> 