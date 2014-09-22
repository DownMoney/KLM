<style type="text/css">
{literal}
.sTT a {
	color:#FFFFFF;
	font-family:trebuchet MS;
	font-size:12px;
	font-weight:bold;
	text-decoration:none;
	padding: 2px 3px 2px 3px;
}

.sTT a:hover {
	background: #E2E2E2 none repeat scroll 0%;
	border: 1px solid #F1F3F5; 
	padding: 2px 2px 2px 2px;
}
	


{/literal}
</style>

<script language="javascript" type="text/javascript">
{literal}
if( $('structureJSTreeID') ) {
$('structureJSTreeID').style.height = Element.getHeight('sT')-48+'px';
}
	
	
reloadTree = function(mod) {
setWaitingStatus('sT',true);
	new Ajax.Updater('sT', '{/literal}{wt_href_tpl_link mod_key="mod_admin_manager" parameters="t=structureJSTree&wm='+mod+'"}{literal}', {
		evalScripts:true, 
		asynchronous:true,
		onComplete: function() { setWaitingStatus('sT',false); }
		});
}
{/literal}
</script>

<table cellspacing="0" cellpadding="0" width="100%">
	<tr>
		<td class="sTT">Menu
	<a href="#" onclick="reloadTree('{$mod.mod_id}'); return false"><img src="{$__imageRoot__}/reload_menu.gif" alt="pd" align="absmiddle"/></a>
	<a href="#" onClick="expandTree();">+</a>/<a href="#" onClick="colapseTree();">-</a></td>
	</tr>
	<tr>
		<td class="sTTs"><a onClick="loadModule('{$mod.mod_id}', '{$mod.mod_name}'); return false" href="#">{if $mod.mod_key == "mod_structure_manager"}{$smarty.const.SITE_NAME|truncate:18:""}{else}{$mod.mod_name}{/if}</a></td>
	</tr>
</table>

{if $structure}
<script type="text/javascript">
 {defun name="add_doc" doc=$list2}
{if $doc}
 {foreach item=d from=$doc name="docs"}
 ['{if $d.ico == ""}<img src="{$__imageRoot__}/tree/e_doc.gif" {if $d.status == "0"}style="opacity: 0.25;filter:alpha(opacity=25);"{/if}>{else}<img src="{$__imageRoot__}/tree/{$d.ico}" {if $d.status == "0"}style="opacity: 0.25;filter:alpha(opacity=25);"{/if}>{/if}', '<span{if $d.status == "0"} style="opacity: 0.25;filter:alpha(opacity=25);"{/if}>{$d.name|escape:"javascript"}</span>', '{$d.url}', 'mod_content', '']{if !$smarty.foreach.docs.last},{/if}
 {/foreach}
 {/if}
 {/defun}
 
 {defun name="add_folder" folders=$fol}
 {if $folders}
 {foreach item=f from=$folders name="folders"}
 ['{if $f.ico == ""}<img src="{$__imageRoot__}/tree/e_folder.gif" {if $d.status == "0"}style="opacity: 0.25;filter:alpha(opacity=25);"{/if}>{else}<img src="{$__imageRoot__}/tree/{$f.ico}" {if $f.status == "0"}style="opacity: 0.25;filter:alpha(opacity=25);"{/if}>{/if}', '<span{if $f.status == "0"} style="opacity: 0.25;filter:alpha(opacity=25);"{/if}>{$f.name|escape:"javascript"}</span>', {if $f.url}'{$f.url}'{else}null{/if}, 'mod_content', '' {if $f.docs}, {fun name="add_doc" doc=$f.docs} {/if} {if $f.children}, {fun name="add_folder" folders=$f.children} ], {else} ], {/if}
 {/foreach}
 {/if}
 {/defun}

  structureJSTree = 
 [
 {if $structure.docs}{fun name="add_doc" doc=$structure.docs}, {/if}
 {if $structure.children}, {fun name="add_folder" folders=$structure.children} {/if}
 ];
 

</script> 
<div id="structureJSTreeID"></div>

<script type="text/javascript">
{literal}
_ctIDSubMenuCount = 0;
_ctIDSubMenu = 'ctSubTreeID';
_ctCurrentItem = null;
_ctNoAction = new Object();
_ctItemList = new Array();
_ctTreeList = new Array();
_ctMenuList = new Array();

tree = ctDraw('structureJSTreeID', structureJSTree, ctThemeXP1, 'ThemeXP', 0, 0);
;

structureTreeSetItem = function(url) {
	 	treeid = ctExposeItem(tree, url);		
if(treeid) {
 		ctOpenFolder(treeid);
	}
}

expandTree = function() {
	 ctExpandTree('structureJSTreeID', 10); 
}

colapseTree = function() {
	 ctCollapseTree('structureJSTreeID'); 
}

{/literal}
</script>

{/if}