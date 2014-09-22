{if !$params_prefix || $params_prefix == ""}
	{assign var="params_prefix" value="params"}
{/if}

{foreach name=params_groups from=$params item=group key=id}
<div class="formParamsGroup" onClick="Element.toggle('formParams_{$id}');">{$group.name} &raquo;</div>
<div class="formParamsGroupContent" id="formParams_{$id}" style="display: none;">
{foreach name=params from=$group.params item=param key=param_id}
<h2>{label for=`$params_prefix`_$param_id}
{if $param.warning_message}
<img align="absmiddle" src="{$__imageRoot__}/icons/warning.png"> <span style="color: #FF0; font-weight: bold;">UWAGA:</span> {$param.warning_message}
{/if}
{if $param.tip_message}
<img align="absmiddle" src="{$__imageRoot__}/remember_to.png"> {$param.tip_message}
{/if}
</h2>

{if $param.special == "theme"}
<h2 style="font-size: 1.2em;">Ustawienia wyglądu</h2>
{foreach from=$param.values item=tm key=k}

<fieldset>
<legend>{$tm.name}</legend>

{foreach from=$tm.files item=th}
<div style="width: 250px; float: left; clear: none;"><input type="radio" name="params[{$param_id}]" value="{$th.formated}" {if $item_params.$param_id == $th.formated}checked="checked"{/if}  />{$th.name}<br />
{wt_thumb_image 	
		src="`$th.path`.jpg"     		   
		width="240"
		height="240"
		compress="100"
		show_blank="1"
		watermark=""
		dir="`$smarty.const.CFGF_DIR_FS_TEMPLATES`"
		style="margin: 5px 0;"}<br />

{wt_getimagesize file="`$smarty.const.CFGF_DIR_FS_TEMPLATES``$th.path`.jpg" assign=th_info}		
		
		
{if $th_info}
<a class="ag" href="{$smarty.const.CFGF_DIR_WS_TEMPLATES}{$th.path}.jpg" target="_blank" onclick="popupWindow(this.href, 'img_prev', '{$th_info.width+20}', '{$th_info.height+20}', 'yes'); return false;">
				<img src="{$__imageRoot__}/icon_preview.gif" align="absmiddle" alt="" />
			powiększ</a>
{/if}
	
{if $action == "edit"}
<a href="{$item_url}&th={$th.formated}" target="_blank">podgląd</a>
{/if}
</div>
{/foreach}

</fieldset>


{/foreach}

{else}
{input name=`$params_prefix`_`$param_id`} 
{/if}



{if $param.info_icon}
<img align="absmiddle" style="cursor: help;" src="{$__imageRoot__}/icon_info.png" {popup text=$param.info_icon}>
{/if}

{/foreach} 

</div>
{/foreach}