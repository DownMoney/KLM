<?php /* Smarty version 2.6.16, created on 2013-04-29 08:34:16
         compiled from addItem.tpl */ ?>
<?php echo $this->_tpl_vars['addItem_form']; ?>


<script language="javascript" type="text/javascript">
<?php if ($this->_tpl_vars['item_type_params']['itemAdd_dateupdown'] != '0'):  echo '

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
'; ?>
	
<?php endif; ?>
	<?php echo ' 
	if($(\'parentItemDetails\')) {
	 hop = Element.getHeight(\'parentItemDetails\');
	} else {
		hop = 0;
	}
	 Interface.setEditFormDim({hop: hop});
	'; ?>
 
	
	 addItemTab = new tabs();
	 addItemTab.cycleTab('tab1');
	 
	 var observeFieldsList = new Array('it_name', 'status', 'it_logo', 'it_desc');  
	 <?php $_from = $this->_tpl_vars['__languages__']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['l']):
?>
	 observeFieldsList.push('languages_status_<?php echo $this->_tpl_vars['l']['id']; ?>
'); 
	 <?php endforeach; endif; unset($_from); ?> 
	 <?php if (! $_GET['language_id'] || $this->_tpl_vars['__languagesCurLanguage__'] == $_GET['language_id']): ?> 
	 var observeFieldsTree = new Array('it_name');
	 <?php else: ?>	 
	 var observeFieldsTree = new Array();
	 <?php endif;  echo '	 
	 Interface.setRecordChanges({list: observeFieldsList, tree: observeFieldsTree});
'; ?>
	

<?php if (count ( $this->_tpl_vars['__languages__'] ) > 5): ?>
	  	new DropDownMenu($('languageMenu'));
		$('languageMenu').show();
<?php endif; ?>

<?php if ($this->_tpl_vars['_formType'] == 'popup'): ?>
	Event.observe(window, 'unload', function() { window.opener.location.href = window.opener.location.href+'&loadItem=<?php echo $_GET['cPath']; ?>
' } );
<?php endif; ?>

</script> 