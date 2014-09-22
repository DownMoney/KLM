<table width="500">
<tr>
<td colspan="3"><strong>Część strony:</strong><br />{input name="showon_module_id"}</td>
</tr>
<tr>
<td width="230"><strong>Widok:</strong>
{input name="showon_mod_task"}</td>
<td width="30" align="center">{input name="showon_mod_task_add"}</td>
<td rowspan="3" width="50%"><strong>Wybrane elementy:</strong>
<select name="showon[]" multiple="multiple" id="showon" size="23" style="width: 100%">
{foreach from=$showon item=data key=mod_id}
{if $data.t}
<optgroup label="{$data.name}" id="ov_mod_{$mod_id}">
{foreach from=$data.t item=tv key=tk}
<option value="{$tk}" id="ov_task_{$tk}">{$tv}</option>
{/foreach}
</optgroup>
{/if}
{if $data.o}
<optgroup label="{$data.name} - elementy" id="ov_mod_elems_{$mod_id}" style="background: #DFFFDF;">
{foreach from=$data.o item=ov key=ok}
<option value="{$ok}" id="ov_option_{$ok}">{$ov}</option>
{/foreach}
</optgroup>
{/if}
{/foreach}
</select>
</td>
</tr>
<tr>
<td width="230"></td>
<td width="30" align="center">{input name="showon_view_del"}</td>
</tr>
<tr>
<td width="230"><strong>Elementy:</strong><br />{input name="showon_mod_option_id"}</td>
<td width="30" align="center">{input name="showon_mod_option_id_add"}<br />
</td>
</tr>
</table>



<script language="javascript" type="text/javascript">
	  
 {literal}	
  updateView = function()	{	
  		
  new Ajax.Updater('operations', '{/literal}{wt_href_tpl_link mod_key="mod_modules_manager" parameters="a=getShowonStruture&mod_id='+$('showon_module_id').value+'"}{literal}', {	
onLoading:function(){
set_progress();
}, 
onComplete:function(t){
setTimeout('setView()', 50);
del_progress();
}, 
evalScripts:true, 
asynchronous:true
});	

}

setView = function() {

if( this._task != task) {
this._task = task;
$('showon_mod_task').innerHTML = '';
for (i=0; i < this._task.length; i++) {
	new Insertion.Bottom('showon_mod_task', '<option value="'+this._task[i][0]+'">'+this._task[i][1]+'</option>');
				}

} else if( !task ) {
$('showon_mod_task').innerHTML = '';
}


if( this._options != options) {
this._options = options;
$('showon_mod_option_id').innerHTML = '';
	for (i=0; i < this._options.length; i++) {
	
new Insertion.Bottom('showon_mod_option_id', '<option value="'+this._options[i][0]+'" rel="'+this._options[i][2]+'">'+this._options[i][1]+'</option>');
				}

} else if( !options ) {
$('showon_mod_option_id').innerHTML = '';
}

}


addModOPT = function() {
if( $('showon_module_id').selectedIndex ) {

mod_name = $('showon_module_id')[$('showon_module_id').selectedIndex].text;
mod_id = $('showon_module_id').value;

if( !$('ov_mod_'+mod_id) ) {
new Insertion.Bottom('showon', '<optgroup label="'+mod_name+'" id="ov_mod_'+mod_id+'"></optgroup>');
}

}

}

addTask = function() {

task_elem = $('showon_mod_task');

if( !task_elem[$('showon_mod_task').selectedIndex] ) {
alert('nic nie wybrałeś');
return;
}

mod_id = $('showon_module_id').value;

for (i=0; i < task_elem.options.length; i++) {
		if (task_elem.options[i].selected) {
						
			if( !$('ov_mod_'+mod_id)  ) {
			addModOPT();
			}
			
			task_id = task_elem.options[i].value;
			task_name = task_elem.options[i].text;
			
if( $('ov_task_mod='+mod_id+'|t='+task_id) ) {
new Effect.Highlight('ov_task_mod='+mod_id+'|t='+task_id,{
              startcolor:'#FF0000'
              });
} else {

new Insertion.After('ov_mod_'+mod_id, '<option value="mod='+mod_id+'|t='+task_id+'" id="ov_task_mod='+mod_id+'|t='+task_id+'">'+task_name+'</option>');
}

		}
	 }
	  
}

addModOptionsOPT = function() {

mod_id = _gsv('showon_module_id');
mod_name = $('showon_module_id')[$('showon_module_id').selectedIndex].text;

if( !$('ov_mod_'+mod_id)  ) {
			addModOPT();
}



if( !$('ov_mod_elems_'+mod_id) ) {
new Insertion.After('ov_mod_'+mod_id, '<optgroup label="'+mod_name+' - elementy" id="ov_mod_elems_'+mod_id+'" style="background: #DFFFDF;"></optgroup>');

new Effect.Highlight('ov_mod_elems_'+mod_id,{
              startcolor:'#FFFF00'
              });
					
}

}

addOptions = function(wchildren) {


options_elem = $('showon_mod_option_id');

if( !options_elem[$('showon_mod_option_id').selectedIndex] ) {
alert('nic nie wybrałeś');
return;
}

mod_id = $('showon_module_id').value;

for (i=0; i < options_elem.options.length; i++) {
		if (options_elem.options[i].selected) {
						
			if( !$('ov_mod_elems_'+mod_id)  ) {
			addModOptionsOPT();
			}
			
			op_id = options_elem.options[i].value;
			op_id2 = op_id;
			op_name = options_elem.options[i].text;
			
		  //	xshow(options_elem.options[i]);
			if(options_elem.options[i].getAttribute('rel')) {
			op_name = options_elem.options[i].getAttribute('rel');
			}
			
			if( wchildren == true ) {
				op_id2 += '[!!!]';
				op_name += ' [!!!]';
			}
			
			
if( $('ov_option_mod='+mod_id+'|op='+op_id) ) {
new Effect.Highlight('ov_option_mod='+mod_id+'|op='+op_id,{
              startcolor:'#FF0000'
              });
} else {
new Insertion.After('ov_mod_elems_'+mod_id, '<option value="mod='+mod_id+'|op='+op_id2+'" id="ov_option_mod='+mod_id+'|op='+op_id+'" style="backround:#DFFFDF;">'+op_name+'</optgroup>');
new Effect.Highlight('ov_option_mod='+mod_id+'|op='+op_id,{
              startcolor:'#FFFF00'
              });
}

		}
	 }
	  
}

delView = function() {
form_element = $('showon');

	for (i=0; i < form_element.options.length; i++) {
		if (form_element.options[i].selected) {
			form_element.options[i] = null;
			i=i - 1;
		}
	}
		
}

{/literal}	
</script>