{$addItemCopy_form}

<script language="javascript" type="text/javascript">
{literal}
	  Calendar.setup({
        inputField     :    "date_up",           
        ifFormat       :    "%Y-%m-%d %I:%M:00",
        showsTime      :    true,
		  timeFormat     :    "24",	
        button         :    "date_up_call",        
        step           :    1
    });
	 
	Calendar.setup({
        inputField     :    "date_down",           
        ifFormat       :    "%Y-%m-%d %I:%M:00",
        showsTime      :    true,
		  timeFormat     :    "24",	
        button         :    "date_down_call",        
        step           :    1
    });	 
	
	 Interface.setEditFormDim();
	 addItemTab = new tabs();
	 addItemTab.cycleTab('tab1');
	 var observeFields = new Array('it_name', 'status', 'it_id2');
	 Interface.setRecordChanges({list: observeFields, tree: observeFields});
{/literal}	
</script> 