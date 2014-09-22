{$addItem_form}

<script language="javascript" type="text/javascript">
{*
sort_order_a = new Array();
{foreach from=$sort_order key=cat_id item=con} 
sort_order_a[{$cat_id}] = new Array();	
{assign var="no" value="0"}
{foreach from=$con key=sort item=title}
sort_order_a[{$cat_id}][{$no}] = new Array('{$sort}', '{$title|escape:"javascript"|truncate:"100":" ..."}');
{assign var="no" value=$no+1}
{/foreach}
{/foreach}

populate(document.addItem.cat_id, document.addItem.elements['sort_order'], sort_order_a);
*}
{if $item_type_params.itemAdd_dateupdown != "0"}
{literal}

	  Calendar.setup({
        inputField     :    "date_up",           
        ifFormat       :    "%Y-%m-%d %H:%M:00",
        showsTime      :    true,
		  timeFormat     :    "24",	
        button         :    "date_up",        
        step           :    1
    });
	 
	Calendar.setup({
        inputField     :    "date_down",           
        ifFormat       :    "%Y-%m-%d %H:%M:00",
        showsTime      :    true,
		  timeFormat     :    "24",	
        button         :    "date_down",        
        step           :    1
    });	 
{/literal}	
{/if}
	{literal} 
	if($('parentItemDetails')) {
	 hop = Element.getHeight('parentItemDetails');
	} else {
		hop = 0;
	}
	 Interface.setEditFormDim({hop: hop});
	{/literal} 
	
	 addItemTab = new tabs();
	 addItemTab.cycleTab('tab1');
	 
	 var observeFieldsList = new Array('it_name', 'status', 'it_logo', 'it_desc');  
	 {foreach from=$__languages__ item="l" key="k"}
	 observeFieldsList.push('languages_status_{$l.id}'); 
	 {/foreach} 
	 {if !$smarty.get.language_id || $__languagesCurLanguage__ == $smarty.get.language_id} 
	 var observeFieldsTree = new Array('it_name');
	 {else}	 
	 var observeFieldsTree = new Array();
	 {/if}
{literal}	 
	 Interface.setRecordChanges({list: observeFieldsList, tree: observeFieldsTree});
{/literal}	

{if count($__languages__) > 5}
	  	new DropDownMenu($('languageMenu'));
		$('languageMenu').show();
{/if}

{if $_formType == "popup"}
	Event.observe(window, 'unload', function() {ldelim} window.opener.location.href = window.opener.location.href+'&loadItem={$smarty.get.cPath}' {rdelim} );
{/if}

</script> 