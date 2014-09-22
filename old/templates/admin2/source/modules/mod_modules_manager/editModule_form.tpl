<table style="width: 100%" class="EditTable">
<tr><td class="AdminFormButtons">
{hiddeninput name="action"} 
{hiddeninput name="mID"}
{input name="cancel_button"}&nbsp;{input name="reset_button"}&nbsp;{input name="submit_button"}
</td></tr>
<tr><td><br> 
<div class="pagetext" id="page1"> 

<table class="adminForm">
<tr><td colspan="2" class="AdminFormHeading">Publikacja</td></tr>
<tr>
<td class="AdminFormTitle">{label for="status"}</td>
<td>{input name="status"}</td>
</tr>
<tr>
<td class="AdminFormTitle">{label for="mod_home"}</td>
<td>{input name="mod_home"}</td>
</tr>
<tr><td colspan="2"><br></td></tr>
<tr><td colspan="2" class="AdminFormHeading">DostéŽ</td></tr>
<tr>
<td class="AdminFormTitle" valign="top">{label for="access"}</td>
<td>{input name="access"}</td>
</tr>

<tr><td colspan="2" class="AdminFormHeading">Szablon</td></tr>
<tr>
<td class="AdminFormTitle" valign="top">{label for="theme"}</td>
<td>{input name="theme"}</td>
</tr>

</table>
</div>


{**************	TREÂŚc	************************************}

<div class="pagetext" id="page2">

<table>
<tr>
<td>

<table class="adminForm">
<tr>
<td class="AdminFormTitle">{label for="mod_title"}</td>
<td>{input name="mod_title"}</td>
</tr>
</table>

</td>
</tr></table>

</div>


<div class="pagetext" id="page4">

<table>
<tr>
<td>

<table class="adminForm"> 

 
{foreach name=params_groups from=$params item=group key=id}
<tr>
<td colspan="2"><br></td>
</tr>
<tr>
<td colspan="2" class="AdminFormHeading" valign="top">{$group.name}</td>
</tr>
{if $group.desc}
<tr>
<td colspan="2" class="main" valign="top">{$group.desc}</td>
</tr>
<tr>
<td colspan="2" class="main" valign="top"><BR></td>
</tr>
{/if}


{foreach name=params from=$group.params item=param key=param_id}
{if $param.type == "separator"}
<tr><td colspan="2" height="1"><hr class="paramsSeparator"></td></tr>
{else}
<tr>
<td class="AdminFormTitle" valign="top">{label for=params_$param_id}
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
<td valign="top">{input name=params_$param_id}&nbsp;
{if $param.info_icon}
<img align="absmiddle" style="cursor: help;" src="{$__imageRoot__}/icon_info.png" {popup text=$param.info_icon}>
{/if}
</td>
</tr>
{if $param.special == "theme"}
<tr>
<td id="{$param_id}_desc"></td>
<td><img name="{$param_id}_screenshot" src="{$item_theme_files_image_root}" alt=""> 

</td>
</tr> 
{/if}

{/if}

{/foreach}




{/foreach}

</table>

</td>
</tr></table>

</div>

<div class="pagetext" id="page5">

<table>
<tr>
<td>

<table class="adminForm">
<tr>
<td class="AdminFormTitle" valign="top">{label for="meta_keys"}</td>
<td>{input name="meta_keys"}</td>
</tr>
<tr>
<td class="AdminFormTitle" valign="top">{label for="meta_desc"}</td>
<td>{input name="meta_desc"}</td>
</tr>
</table>

</td>
</tr></table>

</div>



</td></tr>

<tr><td class="AdminFormButtons">
{input name="cancel_button"}&nbsp;{input name="reset_button"}&nbsp;{input name="submit_button"}&nbsp;{input name="doit"}
</td></tr>
</form>
</table>
