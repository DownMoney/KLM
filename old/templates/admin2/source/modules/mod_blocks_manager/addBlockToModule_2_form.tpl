{input name="action"} 
{input name="block_id"} 
{input name="language_id"} 

{if $action == "edit"}
{input name="btm_id"}
{/if}

{input name="task"} 
<table class="EditTable">
<tr><td class="EditTable-buttons" colspan="3">
{if $action == "add"}
{input name="prev_button"} 
{/if}
{input name="cancel_button"}&nbsp;{input name="reset_button"}&nbsp;{input name="submit_button"}&nbsp;{input name="doit"}
</td></tr>

<tr>
<td>

<div id="page3" class="hide">

<table class="EditTable">
<tr>
<td class="EditTable-l">{label for="bd_title"}</td>
<td>{input name="bd_title"}</td>
</tr>
<tr>
<td class="EditTable-l">{label for="btm_theme"}</td>
<td>{input name="btm_theme"}</td>
</tr>

{if $__languages__}
<tr>
<td class="EditTable-l">
Języki</td>
<td>
{foreach from=$__languages__ item="l" key="k"}
{input name="languages_status_`$l.id`"}{$l.code}<br />
{/foreach} 
</td></tr>
{/if}

<tr>
<td class="EditTable-l">{label for="btm_column"}</td>
<td>{input name="btm_column"}</td>
</tr>
<tr>
<td class="EditTable-l">{label for="sort_order"}</td>
<td>{input name="sort_order"}</td>
</tr>

<tr>
<td class="EditTable-l">{label for="btm_module_id"}</td>
<td>{input name="btm_module_id"}</td>
</tr>

<tr>
<td colspan="3">

<table class="EditTable" width="100%">
<tr>
<td width="50%">{input name="btm_mod_task"}</td>
<td width="30">{input name="btm_mod_task_add"}</td>
<td rowspan="3" width="50%">
<select name="btm_view[]" multiple="multiple" id="btm_view" size="22" class="text_area2" style="width: 100%">
{foreach from=$btm_view item=data key=mod_id}

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
<br />

{label for="btm_view_manual"} (każdy wpis w nowej linii w formacie: 
mod=ID_MODUŁU|t=TASK <i>np.: mod=6|t=all</i><br />
mod=ID_MODUŁU|op=OPCJA_Z_URL  <i>np.: mod=82|op=cPath=68</i><br />
{input name="btm_view_manual"}
</td>
</tr>
<tr>
<td width="50%"></td>
<td width="30">{input name="btm_view_del"}</td>
</tr>
<tr>
<td width="50%">{input name="btm_mod_option_id"}</td>
<td width="30">{input name="btm_mod_option_id_add"}<br />
{input name="btm_mod_option_id_add_wchildren"}
</td>
</tr>

</table>

</td>
</tr>

</table>

</div>

<div id="page4" class="hide">
<table class="EditTable"> 

 
{foreach name=params_groups from=$params item=group key=id}
<td class="EditTable-l" colspan="3">{$group.name}<br>
{if $group.desc}
<br><i>{$group.desc}</i>
{/if}
</td>

{foreach name=params from=$group.params item=param key=param_id}

{if $param.type == "separator"}
<tr><td colspan="3" height="1"><hr class="paramsSeparator"></td></tr>
{else}
<tr>
<td class="EditTable-l">{label for=params_$param_id}
{if $param.warning_message}
<br>
<div align="left" style="font-weight: normal;" ><img align="absmiddle" src="{$__imageRoot__}/icons/warning.png"> <span style="color: #Ff0000; font-weight: bold;">UWAGA:</span><br>
{$param.warning_message}</div>
{/if}
{if $param.tip_message}
<br>
<div align="left" style="font-weight: normal;" ><img align="absmiddle" src="{$__imageRoot__}/remember_to.png"> {$param.tip_message}</div>
{/if}
</td>
<td>{if $param.info_icon}
<img align="absmiddle" style="cursor: help;" src="{$__imageRoot__}/icon_info.png" {popup text=$param.info_icon}>
{/if}</td>

<td>{input name=params_$param_id}</td>
</tr>
{/if}
{/foreach}
{/foreach}

</table>

</div>



</td>
</tr>



<tr><td class="EditTable-buttons" colspan="3">
{if $action == "add"}
{input name="prev_button"} 
{/if}
{input name="cancel_button"}&nbsp;{input name="reset_button"}&nbsp;{input name="submit_button"}&nbsp;{input name="doit"}
</td></tr>
</table> 