<h1>
{if $action eq "edit"}
Edycja bloku #{$block_data.btm_id} - {$block_data.bd_title} (utworzonego z pliku #{$main_block_data.block_id} - {$main_block_data.block_name})
{else}
Nowy blok ( z pliku #{$main_block_data.block_id} - {$main_block_data.block_name})
{/if}
</h1>
    <a href="#" id="tab3" class="offtab" onClick="tab.cycleTab(this.id); return false">Wyświetlanie</a>
    <a href="#" id="tab4" class="offtab" onClick="tab.cycleTab(this.id); return false">Parametry</a>
    
{$addBlockToModule_2_form} 

<script language="javascript" type="text/javascript">
		tab = new tabs();
		tab.cycleTab('tab3');
 {literal}	
  updateView = function()	{	
  		
  new Ajax.Updater('operations', '{/literal}{wt_href_tpl_link mod_key="mod_blocks_manager" parameters="a=getStruture&mod_id='+_gsv('btm_module_id')+'"}{literal}', {	
onLoading:function(){

}, 
onComplete:function(t){
setTimeout('setView()', 50);
}, 
evalScripts:true, 
asynchronous:true
});	

}

setView = function() {

if( this._task != task) {
this._task = task;
_gebi('btm_mod_task').innerHTML = '';
for (i=0; i < this._task.length; i++) {
	new Insertion.Bottom('btm_mod_task', '<option value="'+this._task[i][0]+'">'+this._task[i][1]+'</option>');
				}

} else if( !task ) {
_gebi('btm_mod_task').innerHTML = '';
}


if( this._options != options) {
this._options = options;
_gebi('btm_mod_option_id').innerHTML = '';
	for (i=0; i < this._options.length; i++) {
new Insertion.Bottom('btm_mod_option_id', '<option value="'+this._options[i][0]+'">'+this._options[i][1]+'</option>');
				}

} else if( !options ) {
_gebi('btm_mod_option_id').innerHTML = '';
}

}


addModOPT = function() {
if( _gebi('btm_module_id').selectedIndex ) {

mod_name = _gebi('btm_module_id')[_gebi('btm_module_id').selectedIndex].text;
mod_id = _gsv('btm_module_id');

if( !_gebi('ov_mod_'+mod_id) ) {
new Insertion.Bottom('btm_view', '<optgroup label="'+mod_name+'" id="ov_mod_'+mod_id+'"></optgroup>');
}

}

}

addTask = function() {

task_elem = _gebi('btm_mod_task');

if( !task_elem[_gebi('btm_mod_task').selectedIndex] ) {
alert('nic nie wybrałeś');
return;
}

mod_id = _gsv('btm_module_id');

for (i=0; i < task_elem.options.length; i++) {
		if (task_elem.options[i].selected) {
						
			if( !_gebi('ov_mod_'+mod_id)  ) {
			addModOPT();
			}
			
			task_id = task_elem.options[i].value;
			task_name = task_elem.options[i].text;
			
			
if( _gebi('ov_task_mod='+mod_id+'|t='+task_id) ) {
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

mod_id = _gsv('btm_module_id');
mod_name = _gebi('btm_module_id')[_gebi('btm_module_id').selectedIndex].text;

if( !_gebi('ov_mod_'+mod_id)  ) {
			addModOPT();
}



if( !_gebi('ov_mod_elems_'+mod_id) ) {
new Insertion.After('ov_mod_'+mod_id, '<optgroup label="'+mod_name+' - elementy" id="ov_mod_elems_'+mod_id+'" style="background: #DFFFDF;"></optgroup>');


}

}

addOptions = function(wchildren) {


options_elem = _gebi('btm_mod_option_id');

if( !options_elem[_gebi('btm_mod_option_id').selectedIndex] ) {
alert('nic nie wybrałeś');
return;
}

mod_id = _gsv('btm_module_id');

for (i=0; i < options_elem.options.length; i++) {
		if (options_elem.options[i].selected) {
						
			if( !_gebi('ov_mod_elems_'+mod_id)  ) {
			addModOptionsOPT();
			}
			
			op_id = options_elem.options[i].value;
			op_id2 = op_id;
			op_name = options_elem.options[i].text;
			
			if( wchildren == true ) {
				op_id2 += '[!!!]';
				op_name += ' [!!!]';
			}
			
			
if( _gebi('ov_option_mod='+mod_id+'|op='+op_id) ) {
new Effect.Highlight('ov_option_mod='+mod_id+'|op='+op_id,{
              startcolor:'#FF0000'
              });
} else {
new Insertion.After('ov_mod_elems_'+mod_id, '<option value="mod='+mod_id+'|op='+op_id2+'" id="ov_option_mod='+mod_id+'|op='+op_id+'">'+op_name+'</optgroup>');
}

		}
	 }
	  
}

delView = function() {
form_element = _gebi('btm_view');

	for (i=0; i < form_element.options.length; i++) {
		if (form_element.options[i].selected) {
			form_element.options[i] = null;
			i=i - 1;
		}
	}
		
}

{/literal}	
</script>
