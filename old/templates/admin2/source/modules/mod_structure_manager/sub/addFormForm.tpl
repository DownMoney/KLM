<div id="newFormContentOption" style="display: none;">

<div id="newFormFieldsDragHead"><span onClick="$('newFormFieldsParams').hide(); Element.toggle('newFormFieldsDrag');" style="cursor: pointer;">ELEMENTY FORMULARZA</span>
<div id="newFormFieldsDrag">
<small>przeciągnij wybrany element na obszar formularza</small>
<ul>
<li id="form_head" class="newFormFields_controls"><img src="{$__imageRoot__}/form_head.gif" width="21" height="16" align="absmiddle" alt="" /> tekst</li>
<li id="form_text" class="newFormFields_controls"><img src="{$__imageRoot__}/form_i_text.gif" width="21" height="16" align="absmiddle" alt="" /> linia tekstu</li>
<li id="form_textarea" class="newFormFields_controls"><img src="{$__imageRoot__}/form_i_textarea.gif" width="21" height="16" align="absmiddle" alt="" /> pole tekstowe</li>
<li id="form_select" class="newFormFields_controls"><img src="{$__imageRoot__}/form_i_select.gif" width="21" height="16" align="absmiddle" alt="" /> lista wyboru</li>
<li id="form_checkbox" class="newFormFields_controls"><img src="{$__imageRoot__}/form_i_checkbox.gif" width="21" height="16" align="absmiddle" alt="" /> checkbox</li>
<li id="form_radio" class="newFormFields_controls"><img src="{$__imageRoot__}/form_i_radio.gif" width="21" height="16" align="absmiddle" alt="" /> radio</li>
<li id="form_pass" class="newFormFields_controls"><img src="{$__imageRoot__}/form_i_pass.gif" width="21" height="16" align="absmiddle" alt="" /> hasło</li>
<li id="form_date" class="newFormFields_controls"><img src="{$__imageRoot__}/form_i_text.gif" width="21" height="16" align="absmiddle" alt="" /> data</li>
</ul>
</div>
</div>

<div id="newFormFieldsParamsHead"><span onClick="$('newFormFieldsDrag').hide(); Element.toggle('newFormFieldsParams');" style="cursor: pointer;">USTAWIENIA ELEMENTU</span>
<div id="newFormFieldsParams" style="display: none;">
kliknij edycję pola aby zobaczyć parametry.
</div>
</div>


</div>
{literal}
<style type="text/css">
	#contactForm_form_list {
		list-style-type: none; 
		margin: 0; 
		background: #FFF; 
		width: 560px; 
		padding: 20px 0;
		float: left;
		clear: both;
	}

	#contactForm_form_list LI {
		padding: 1px 5px;
	}

	#contactForm_form_list TABLE {
		background: #f0f0f0;
	}

	.form_field_label {
		display: block;
		float: left; clear: both;
		font-weight: bold;
	}

	.form_field_desc {
		display: block;
		float: left; 
		clear: both;
		font-style: italic; 
	}

	.form_field_Tdesc {
		width: 225px;
		vertical-align: top;
	}

	.form_field_Tdesc TEXTAREA, .form_field_Tdesc input {
		width: 220px;
	}

	.form_field_fields {
		vertical-align: top;
	}

	.form_field_Top {
		width: 75px;
		text-align: right;
		vertical-align: top;
		white-space: nowrap;
	}

	#newFormFieldsParams {
		float: left;
		clear: both;
		background: #E6F9EC;
		width: 150px;
	}
</style>

<script type="text/javascript">
var fi_id = {/literal}{$fi_id}{literal};
form_fields_array = ['form_head', 'form_checkbox', 'form_pass', 'form_radio', 'form_select', 'form_text', 'form_textarea', 'form_date'];
for (var i=0; i<form_fields_array.length; i++) {
	new Draggable(form_fields_array[i], {revert: true, duration: 0});
}

Droppables.add('contactForm_form_list', {
	accept: 'newFormFields_controls',
	onDrop: function(element, ethelist, ev) {
   		addNewFormField(element.id, undefined, Event.pointerY(ev),undefined,fi_id)
	}
});
var questions = new Array();	
var QD = new Array();
var prop = new Array();	
var field_prop = ['required'];
var field_prop_form_text = ['size', 'asEmail'];
var field_prop_form_date = ['size'];
var field_prop_form_textarea = ['cols', 'rows'];
var field_prop_form_checkbox = ['options'];
var field_prop_form_radio = ['options'];
var field_prop_form_select = ['options'];
var field_prop_form_pass = [];
var field_prop_form_head = [];
   	
addNewFormField = function(type, text, positionY, field, fi_id) {
    var list = $("contactForm_form_list");
    var node = document.createElement("li");
    if(field == undefined) {
        field = $('contactForm_form_list').childNodes.length+1;
    }
	newid = 'thelist_'+field;
    node.setAttribute("id", newid);
    node.innerHTML = makeNewField(type, text, field,fi_id);
    if(positionY>0) {
    	closest = 0;
        closestY = -1;
        for(j=0; j<questions.length-1; j++){
            te = $("thelist_"+j);
            if(te) {
                if(positionY < (list.offsetTop + te.offsetTop)){
                    if(list.offsetTop + te.offsetTop < closestY || closestY == -1){
                        closestY = list.offsetTop + te.offsetTop;
                        closest = j;
                    }
                }
            }
        }
        if(closest==0){
            list.insertBefore(node, $("thelist_0"));
        } else {
            list.insertBefore(node, $("thelist_"+(closest)));
        }
    }else{
        list.insertBefore(node,$(submit_field));
    }
    Sortable.create('contactForm_form_list', {scroll: 'eL_form'});
}	

makeNewField = function(type, text, field, fi_id) {
    //field = questions.length;
    questions[field] = type;
    QD[field] = type;
    if(text == undefined || text == "undefined") {
        label = "kliknij aby edytować";
    }
	r = '<table width="550" style="background: #f0f0f0;" id="rowT_'+field+'">';
	r += '<tr>';
	if( type == 'form_head' ) {
		r += '<td class="form_field_Tdesc" colspan="2">';
	} else {
		r += '<td class="form_field_Tdesc">';	 
	}
	r += '<span id="label_'+field+'" onClick="editField(\''+field+'\'); return false" style="cursor: pointer;" class="form_field_label">'
	r += label;
	r += '</span>';	
	r += '<span id="desc_'+field+'" onClick="editField(\''+field+'\'); return false" style="cursor: pointer;" class="form_field_desc">'
	r += 'text objaśniający';
	r += '</span>';
	r += '<input type="hidden" name="fi['+fi_id+'][form]['+field+'][name]" value="" id="it_value_'+field+'_name" />';
	r += '<input type="hidden" name="fi['+fi_id+'][form]['+field+'][desc]" value="" id="it_value_'+field+'_desc" />';
	r += '<input type="hidden" name="fi['+fi_id+'][form]['+field+'][type]" value="'+type.replace('form_', '')+'" id="it_value_'+field+'_type" />';	 
	r += '</td>';	
	if( type != 'form_head' ) {
		r += '<td class="form_field_fields">';
	 	for(j=0; j<field_prop.length; j++) {
	 		r += '<input type="hidden" name="fi['+fi_id+'][form]['+field+']['+field_prop[j]+']" value="" id="it_value_'+field+'_'+field_prop[j]+'" />';
	 	}
	 	other_op = eval( 'field_prop_'+type );
		if(other_op.length > 0) {
	 		for(n=0; n<other_op.length; n++) {
				r += '<input type="hidden" name="fi['+fi_id+'][form]['+field+']['+other_op[n]+']" value="" id="it_value_'+field+'_'+other_op[n]+'" />';
	  		}	
		}
	}
	r2 = '<span id="form_field_fields_'+field+'">';
	switch(type){
    	case 'form_text':
			r2 += '<input type="text" id="ncFF_'+field+'" />';
		 	break;
		case 'form_textarea':
			r2 += '<textarea id="ncFF_'+field+'"></textarea>';
		 	break;
		case 'form_select':
			r2 += '<select id="ncFF_'+field+'"><option>opcja 1</option><option>opcja 2</option><option>opcja 3</option></select>';
		 	break;
		case 'form_pass':
		 	r2 += '<input type="password" />';
			break;
		case 'form_checkbox':
		 	r2 += '<input type="checkbox" />opcja 1<br /><input type="checkbox" />opcja 2<br /><input type="checkbox" />opcja 3<br />';
			break;
		 case 'form_radio':
		 	r2 += '<input type="radio" name="radio_'+field+'" />opcja 1<br /><input type="radio" name="radio_'+field+'" />opcja 1<br /><input type="radio" name="radio_'+field+'" />opcja 3<br />';
		 	break;
		 case 'form_date':
		 	r2 += '<input type="text" id="ncFF_'+field+'" value="dd-mm-rrrr" /> <img src="{/literal}{$__imageRoot__}{literal}/icons/calendar_add.png" align="absmiddle" alt="" /> ';
		 	break;
	}
	r2 += '</span>';
	r += r2;		 
	r += '</td>';
	{/literal}
	r += '<td class="form_field_Top"><a href="#" onclick="move_li(\'contactForm_form_list\', \'thelist_'+field+'\', \'up\'); return false"><img src="{$__imageRoot__}/order_arrow_up.gif"></a> <a href="#" onclick="move_li(\'contactForm_form_list\', \'thelist_'+field+'\', \'down\'); return false"><img src="{$__imageRoot__}/order_arrow_down.gif"></a> <a href="#" onClick="editField(\''+field+'\'); return false"><img src="{$__imageRoot__}/icons/icon_edit.gif" /></a> <a href="#" onClick="delField(\''+field+'\'); return false"><img src="{$__imageRoot__}/icons/icon_del.gif" /></a></td>';
	{literal}
	r += '</tr>';
	r += '</table>';	 
	return r;
}

delField = function(id) {
	if(id && confirm('Jesteś pewien, że chcesz usunąć to pole formularza ?\n Pamiętaj, że ta operacja jest nieodwracalna.') ) {
		Element.remove('thelist_'+id);
	}
}

editField = function(f) {
	$('newFormFieldsDrag').hide();
	$('newFormFieldsParams').show();
	if( not_null(this.last_edited) && $('rowT_'+this.last_edited) ) {
		$('rowT_'+this.last_edited).style.background = '';
	}
	$('rowT_'+f).style.background = '#E6F9EC';
	this.last_edited = f;
	
	r = '<table width="140" align="left">';
	
	r += '<tr>';
	r += '<td colspan="2"><b>Tytuł:</b></td>';
	r += '</tr>';
	r += '<tr>';
	r += '<td colspan="2"><input type="text" value="'+$('it_value_'+f+'_name').value+'" id="prop_'+f+'_name" onKeyUp="updateFieldProp(\''+f+'\', \'name\', this);"></td>';
	r += '</tr>';
	
    r += '<tr>';
	r += '<td colspan="2"><b>Opis:</b></td>';
	r += '</tr>';
	r += '<tr>';
	r += '<td colspan="2"><textarea style="width: 140px;" id="prop_'+f+'_desc" onKeyUp="updateFieldProp(\''+f+'\', \'desc\', this);">'+$('it_value_'+f+'_desc').value+'</textarea></td>';
	r += '</tr>';
	if( $('it_value_'+f+'_type').value != 'head' ) {
		r += '<tr>';
		r += '<td><b>Wymagane:</b></td>';
		r += '<td><input value="1" type="checkbox" id="prop_'+f+'_required" onClick="updateFieldProp(\''+f+'\', \'required\', this);" value="1"';
		if( $('it_value_'+f+'_required').value == '1' ) {
			r += 'checked="checked"';
		}
		r += '>';
		r += '</td></tr>';
	}
	switch($('it_value_'+f+'_type').value){
		case 'head':
		 	r2 += 'kliknij aby wstawic tekst';
			break;
    	case 'text':
			r += '<tr>';
			r += '<td><b>Rozmiar:</b></td>';
			r += '<td><input type="text" style="width: 50px;" id="prop_'+f+'_size" onKeyUp="updateFieldProp(\''+f+'\', \'size\', this);" value="'+$('it_value_'+f+'_size').value+'"></td>';
			r += '</tr>';
			
			r += '<tr>';
			r += '<td><b>Wer. jako e-mail:</b></td>';
			r += '<td><input type="checkbox" id="prop_'+f+'_asEmail" onChange="updateFieldProp(this);" value="'+$('it_value_'+f+'_asEmail').value+'"></td>';
			r += '</tr>';
			break;
       case 'date':
		 	r += '<tr>';
			r += '<td><b>Rozmiar:</b></td>';
			r += '<td><input type="text" style="width: 50px;" id="prop_'+f+'_size" onKeyUp="updateFieldProp(\''+f+'\', \'size\', this);" value="'+$('it_value_'+f+'_size').value+'"></td>';
			r += '</tr>';
		 	break; 
		 case 'textarea':
		 	r += '<tr>';
			r += '<td><b>Kolumn (szer.):</b></td>';
			r += '<td><input type="text" style="width: 50px;" id="prop_'+f+'_cols" onKeyUp="updateFieldProp(\''+f+'\', \'cols\', this);"  value="'+$('it_value_'+f+'_cols').value+'"></td>';
			r += '</tr>';
			
			r += '<tr>';
			r += '<td><b>Wierszy (wys.):</b></td>';
			r += '<td><input type="text" style="width: 50px;" id="prop_'+f+'_rows" onKeyUp="updateFieldProp(\''+f+'\', \'rows\', this);" value="'+$('it_value_'+f+'_rows').value+'"></td>';
			r += '</tr>';
		 	break;
		 case 'select':
		 case 'checkbox':
		 case 'radio':
		 	r += '<tr>';
			r += '<td colspan="2"><b>Opcje:</b></td>';
			r += '</tr>';
			r += '<tr>';
			r += '<td colspan="2"><textarea style="width: 140px;" id="prop_'+f+'_options" onKeyUp="updateFieldProp(\''+f+'\', \'options\', this, \''+$('it_value_'+f+'_type').value+'\');">'+$('it_value_'+f+'_options').value+'</textarea></td>';
			r += '</tr>';
		 	break;
	}
	r += '</td>';
	r += '</tr>';
	r += '</table>';
	$('newFormFieldsParams').innerHTML = r;
}

updateFieldProp = function(id, type, prop, options_type) {
	switch(type) {
		case 'name':
			val = prop.value;
			$('label_'+id).innerHTML = val;
			$('it_value_'+id+'_'+type).value = val;
			break;
		case 'desc':
			val = prop.value;
			val2 = val.replace(/\n/g, '<br />');
			$('desc_'+id).innerHTML = val2;
			$('it_value_'+id+'_'+type).value = val;
			break;
		case 'required':
			val = (prop.checked) ? '1' : '0';
			if( val == '1' ) {
				$('label_'+id).style.color = '#F00';
			} else {
				$('label_'+id).style.color = '';
			}
			$('it_value_'+id+'_'+type).value = val;
			break;
		case 'size':
			val = prop.value;
			$('ncFF_'+id).size = val;
			$('it_value_'+id+'_'+type).value = val;
			break;
		case 'cols':
			val = prop.value;
			$('ncFF_'+id).cols = val;
			$('it_value_'+id+'_'+type).value = val;
			break;
		case 'rows':
			val = prop.value;
			$('ncFF_'+id).rows = val;
			$('it_value_'+id+'_'+type).value = val;
			break;
		case 'options':	
	   		val = prop.value;
	   		vals = prop.value.split("\n");
			if(vals.length > 0) {
				if( options_type == 'select' ) {
					i = '<select>';	
					i += '<option value="">--- wybierz ---</option>';
				} else {
					i = '';
				}
		 		for(n=0; n<vals.length; n++) {
		 			$('it_value_'+id+'_'+type).value = val;
					switch( options_type ) {
						case 'checkbox':
							i += '<input type="checkbox" />'+vals[n]+'<br />';
							break;
						case 'radio':
							i += '<input type="radio" name="radio_'+id+'" />'+vals[n]+'<br />';
							break;
						case 'select':
							i += '<option value="'+vals[n]+'">'+vals[n]+'</option>';
							break;
					}
	  		 	}	
		 		if( options_type == 'form_select' ) {	
					i += '</select>';	
				}
				for(n=0; n<vals.length; n++) {
					i += '<input id="it_value_'+id+'_'+type+'_'+n+'" type="hidden" value="'+vals[n]+'" name="fi['+fi_id+'][form]['+id+'][options]['+n+']" />';
				}
				$('form_field_fields_'+id).innerHTML = i;
	 		}
			break;
	}
}

move_li = function(list_id,li_id,dir){
	obj = document.getElementById(list_id); // get parent list
	CN = obj.childNodes; // get nodes
	x = 0;
	while(x < CN.length){ // loop through elements for the desired one
		if(CN[x].id == li_id){
			new_obj = CN[x].cloneNode(true); //create copy of node
			break; // End the loop since we found the element
		}else{
			x++;
		}
	}
	if(new_obj){
		if(dir == 'down'){ // Count up, as the higher the number, the lower on the page
			y = x + 1;
			while(y < CN.length){ // loop trhough elements from past the point of the desired element
				if(CN[y].tagName == 'LI'){ // check if node is the right kind
					old_obj = CN[y].cloneNode(true);
					break; // End the loop
				}else{
					y++;
				}
			}
		}
		if(dir == 'up'){ // Count down, as the lower the number, the higher on the page
			if(x > 0){
				y = x - 1;
				while(y >= 0){ // loop trhough elements from past the point of the desired element
					if(CN[y].tagName == 'LI'){ // check if node is the right kind
						old_obj = CN[y].cloneNode(true);
						break; // End the loop
					}else{
						y--;
					}
				}
			}
		}
		if(old_obj){ // if there is an object to replace, replace it.
			obj.replaceChild(new_obj,CN[y]);
			obj.replaceChild(old_obj,CN[x]);
		}
	}
}

Sortable.create('contactForm_form_list', {scroll: 'eL_form'});
{/literal}
</script>

<style type="text/css">
{literal}
#newFormFieldsDrag {
float: left; clear: both; width: 140px; padding: 5px;
}

#newFormFieldsDrag UL {
list-style-type: none; margin: 0; padding: 0;
}

#newFormFieldsDrag UL LI {
padding: 5px 0;
cursor: move;
}

{/literal}
</style>
