{input name="action"}
{input name="submit_type"}
{input name="list_fields_changed"}
{input name="tree_fields_changed"}

{if $action == "edit"}
{input name="tID"}
{/if}

<style type="text/css">
{literal}
	#unique_message {
		border: 1px solid #F00;
		background-color: #FFC0C0;
		padding: 15px 15px 15px 15px;
		margin-top: 10px;
		text-align: center;
		width: 467px;
	}

{/literal}
</style>

<script language="javascript" type="text/javascript">


var modules_keys = new Array();
{foreach from=$modules_keys key=mod_id item=mod_key}
modules_keys[{$mod_id}] = '{$mod_key}';
{/foreach}

{literal}


updateKey = function(v) {
	//v.value = v.value.toUpperCase().gsub('[^a-zA-Z0-9_]','_');
	v.value = v.value.toUpperCase().gsub(' ','_');
}

updateTxtKey = function(v) {
	if (v.options[v.selectedIndex].value=='-1') {
		$('key_prefix').update('TEXT_');
	} else {
		var mod = modules_keys[v.options[v.selectedIndex].value].toUpperCase();
		$('key_prefix').update('TEXT_'+mod+'_');
	}
}

checkValues = function(v) {
	var elements = $$('#languages_values textarea');
	var nr = elements.length;
	for(i=0;i<nr;i++) {
		if ($(elements[i].id).value!='')  {
			return true;
		}
	}
	return false;
}


Event.observe('addText', 'submit', checkValues);

checkUnique = function() {
	if (observer) clearTimeout(observer);
	observer = setTimeout(checkUniqueKey,1000);
}

Event.observe('txt_key','keydown',checkUnique);
Event.observe('mod_id','change',checkUnique);


var observer;



checkUniqueKey = function() {
	
	
	var val = $('txt_key').value;
	var txt_ids = '';
	
	if ($('action_save').options[$('action_save').selectedIndex].value=='save') {
		var elements = $$('#languages_values input[type="hidden"]');
		var nr = elements.length;
		for(i=0;i<nr;i++) {
			if (elements[i].id.match('txt_id_')!=null && $('txt_id_'+elements[i].value)==null) {
				txt_ids += elements[i].value+',';
			}
		}
		txt_ids = txt_ids.substr(0,txt_ids.length-1);
	}
	new Ajax.Request('{/literal}{wt_href_tpl_link mod_key="mod_languages_manager" parameters="a=checkUniqueKey&key='+val+'&ignore='+txt_ids+'&mod_id='+$('mod_id').value+'"}{literal}', {asynchronous:true,
	onComplete: function(t) {
		var data = t.responseText;
		var message = '';
		if (data=='ok') {
			$('unique_message').hide();
			message = 'Wpisany klucz jest unikalny.';
		} else if (data=='not_unique') {
			message = 'Wpisany klucz NIE jest unikalny. Wpisz inny klucz.';
			$('unique_message').show();
		} else if (data=='no_key') {
			message = 'Należy podać klucz do wpisania';
			$('unique_message').show();
		} else {
			message = 'Wystąpił błąd podczas sprawdzania';
			$('unique_message').show();
		}
		$('unique_message').update(message);
	//	alert(message);
	}
	});
}

updateTxtKey($('mod_id'));
{/literal}
</script>
<table cellpadding="0" cellspacing="0" width="100%" height="100%" class="eL">
	<tr>
		<td colspan="2" class="mT-m2 eL_h">
			<div id="eL_formTitle">
				{if $action == "edit"}
				 #{$item.txt_id} - {$item.txt_key}
				{elseif $action == "add"}
				NOWY WPIS
				{/if}
			</div>
			<div class="eL_but">{input name="submit_button"} {input name="save_close_button"} {input name="cancel_button"}
			</div>
		</td>
	</tr>
	<tr> 
		<td colspan="2" class="eL_formOptions">
			<table cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td id="eL_formSavingOptions" class="eL_formSavingOptions" align="right">najpierw {input name="action_save"} potem {input name="action_after"}</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr> 
		<td class="eL_nav">
			<a href="#" class="offtab" onClick="addTextTab.cycleTab(this.id); return false" id="tab1">Dane ogólne</a>
			<!--<a href="#" class="offtab" onClick="addTextTab.cycleTab(this.id); return false" id="tab2">Wartości</a>-->
		</td>
		<td class="eL_form" valign="top"><div id="eL_form">
			<div class="eL_formC">
				<div class="hide" id="page1">
					<h1>[DANE OGÓLNE]</h1>
						{label for="txt_key"}
						<span id="key_prefix"></span>&nbsp;{input name="txt_key"}<br />
						<div id="unique_message" style="display:none;"></div>
						{label for="mod_id"}
						{input name="mod_id"}
						<span id="languages_values">
						{foreach from=$languages key=lnid item=ln}
							<!--<img src="{$__imageRoot__}/flags/{$ln.code}.gif" alt="{$ln.name}" align="absmiddle" />{$ln.name}-->
							{label for="txt_value_$lnid"}
							{input name="txt_value_$lnid"}
							
							{input name="ln_id_$lnid"}
							{input name="txt_id_$lnid"}
						{/foreach}
						</span>
				</div>
				
				<!--<div class="hide" id="page2">
					<h1>[PRODUKTY]</h1>
					
				</div>-->

</div></div></td>
</table>