<script type="text/javascript">
 {literal}	 
updateItemInfo = function(url) {
  	
if( not_null(url) && this._url != url ) {
this._url = url;
}


	
if( Element.visible('ad') && this.loaded_url != this._url ) {
	  
new Ajax.Updater('ad', this._url, {	
onLoading:function(){
set_progress('uzupełniam szczegółowe dane');
}, 
onComplete:function(){
del_progress();
this.loaded_url=this._url;
},
evalScripts:true, 
asynchronous:true}); 

}

} 

{/literal}

updateItemInfo('{$item_url}');

</script>