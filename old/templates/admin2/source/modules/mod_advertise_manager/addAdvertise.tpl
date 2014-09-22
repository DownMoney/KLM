{$addAdvertise_form}

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
	 
updateForm = function() {

	$('adv_text_subform').hide();
	$('adv_file_subform').hide();
	
	switch( $('ad_type').value ) {
		case 'text':
			$('adv_text_subform').show();
			new Effect.Highlight('adv_text_subform');
		break;	
		case 'flash':
			$('adv_file_subform').show();
			new Effect.Highlight('adv_file_subform');
		break;
		case 'image':
			$('adv_file_subform').show();
			new Effect.Highlight('adv_file_subform');
		break;
	}

}	 

updateForm();	 
	 
{/literal}




		Interface.setEditFormDim();
		addAdvertiseTab = new tabs();
		addAdvertiseTab.cycleTab('tab1');
</script> 