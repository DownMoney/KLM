var Application = Class.create();

Application.prototype = {

	initialize: function() {
		this.miniHelp();
		this.detectLiveForms(); 
		this.structure_columns = Application.detectStructureEdit();	
		this.createStructureEdit();	
		
	},
	
	createStructureEdit: function() {
	
		for (var i=0; i<this.structure_columns.length; i++) {	    
Sortable.create(this.structure_columns[i], {
      constraint:false, 
      //scroll: true,
      containment:this.structure_columns,
      dropOnEmpty:true,
      ghosting:true,
      handle:'structureEdit_move_handler',
      hoverclass:'structureEditHover',
      onUpdate:(function(sort_element){
        new Ajax.Request('?mod=mod_blocks_manager&a=saveBlockOrder', {
          asynchronous:true,
          onComplete:(function(element){
              Application.detectStructureEdit();
              new Effect.Highlight(sort_element,{
              startcolor:'#FF0000'
              });
          }).bind(this),
        parameters:Sortable.serialize(sort_element)});
        }).bind(this)
      }
    );
	    
	    
		 }
	},
	
	detectLiveForms: function() {
		list = document.getElementsByClassName('LiveForms');
		
		for (var i=0; i<list.length; i++) {
	    var item = list[i];  
		 	
			if( item.nodeName == 'FORM' ) {
			
			live_forms_ap = item.id+'_LF';
			
new APP_LiveForms(
{formID:item.id,
formProgress:item.id+'_progress',
formSubmit:item.id+'_submit',
formSuccess:item.id+'_success'
			 }
			);
			}		
		 }
	},
	
	miniHelp: function() {
		list = document.getElementsByClassName('minihelp');
		
		for (var i=0; i<list.length; i++) {
	    var item = list[i];  
		 	
			if( $(item.id + '_con') ) {
				Event.observe(item,'mouseover', this.showHelper.bind(this));	
				Event.observe(item,'mouseout', this.hideHelper.bind(this));	
			}
			
		 }
		
		
	
	},

	showHelper: function(item) {
		helperLink = Event.element(item);
		helper_content_id = helperLink.id + '_con';
		
		helperLinkPos = Position.cumulativeOffset(helperLink.parentNode);
		
    		$(helper_content_id).style.left = (helperLinkPos[0]) + 'px';
    		$(helper_content_id).style.display = 'block';
    		$(helper_content_id).style.top = (helperLinkPos[1] - Element.getHeight(helper_content_id)) + 'px';
			
	},
	
	hideHelper: function(item) {
	var helperLink = Event.element(item);
	helper_content_id = helperLink.id + '_con';	
  	$(helper_content_id).style.display = 'none';
		
	}
}


Application.detectStructureEdit = function() {
		list = document.getElementsByClassName('structureEdit');
		
		var structure_columns = new Array();
		
		for (var i=0; i<list.length; i++) {
	    var item = list[i];  
		 	
			if( item.nodeName == 'UL' ) {
				
			  if( item.id == 'wt_column-99' && item.innerHTML == '' ) {
			  	Element.remove(item.id);
				continue;
				}	
				
			  structure_columns.push(item.id);	
				   
				if( item.innerHTML == '' ) {
					item.style.border = '1px dashed #c0c0c0';
				 //	item.style.padding = '5px;';
					var dim = Element.getDimensions(item.parentNode);	
				  //	item.style.width = dim.width+'px';
				  //	item.style.height = dim.height+'px';
				} else {
				  //	item.style.border = '';
				}
			
			} 
			
}
		 return structure_columns;	
	}
	
Application.setStructureEditOptions = function(item, die) {

	if( item != '' && $(item+'_options') ) {
		var op = item+'_options';
		if( die ) {
			Element.hide(op);
			$(item).style.border='';
		} else {
			Element.show(op);
			$(item).style.border='1px dashed #F00';
		}
		
	}
	

}	 	
	
var APP_LiveForms = Class.create();

APP_LiveForms.prototype = {

	initialize: function(options) {
			
			this.isProgress = false;
			this.isSuccess = false;
			this.isContainer = false;
			this.options = options;
			this.form = $(options.formID);
			this.url = this.form.action;
			
		if( options.formProgress && $(options.formProgress) ) {
			$(options.formProgress).hide();
			
			if( $(options.formProgress).className == 'alias' ) {
				options.formProgress = $(options.formProgress).innerHTML;
			}
			
			
			if( $(options.formProgress).className == '' ) {
				$(options.formProgress).className = 'LiveFormsProgress';
			}
			
			this.isProgress = true;
		}
		
		if( options.formSuccess && $(options.formSuccess) ) {
		
			$(options.formSuccess).hide();
			
			if( $(options.formSuccess).className == '' ) {
				$(options.formSuccess).className = 'LiveFormsSuccess';
			}
			
			this.isSuccess = true;
		}
		
		if( this.form.target != '' && $(this.form.target) ) {
			this.isContainer = true;
			this.Container = this.form.target;
		}
		
		
		
		Event.observe($(options.formSubmit),'click', this.sendForm.bind(this));
		Event.observe(this.form,'submit', this.sendForm.bind(this));  
				
	},
	
	sendForm: function(e) {
	
	if( this.isContainer == true ) {
		
		new Ajax.Updater(
			this.Container,
			this.url,
			{
				parameters: Form.serialize(this.form)+'&ajax=y',
				onLoading: this.setProgress.bind(this),
				onComplete: this.sendComplete.bind(this),
				evalScripts:true, 
				asynchronous:true
			});
		
	} else {
	
  new Ajax.Request(
			this.url,
			{
				parameters: Form.serialize(this.form)+'&ajax=y',
				onLoading: this.setProgress.bind(this),
				onComplete: this.sendComplete.bind(this)
			});
}	
		Event.stop(e);

	},
	
	setProgress: function() {
	
		if( this.isContainer == true ) {	
			$(this.Container).hide();
			$(this.Container).innerHTML = '';
		}
	
	  $(this.options.formSubmit).style.visibility = 'hidden';
		
	  if ( this.isProgress == true ) {
			$(this.options.formProgress).show();
		}
		
	  Form.disable(this.form);	
	},
	
	sendComplete: function() {
		if ( this.isProgress == true ) {
			$(this.options.formProgress).hide();
		}
		
		if( this.isContainer == true ) {	
			$(this.Container).show();
		}
		
		
		if ( this.isSuccess == true ) {	
	  		 this.setSuccess();	
		}
		
	  $(this.options.formSubmit).style.visibility = 'visible';
		
	  document.body.style.cursor = 'default';
	  if( this.isContainer == false ) {	
	  Form.reset(this.form);	
	  }
	  Form.enable(this.form);	
	},
	
	setSuccess: function() {
		$(this.options.formSuccess).show();
 	setTimeout(function(){Effect.Fade(this.options.formSuccess)}.bind(this), 3000);
	}
	
}
