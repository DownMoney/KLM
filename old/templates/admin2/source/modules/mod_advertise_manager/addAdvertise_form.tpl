{input name="action"}
{input name="submit_type"}
{input name="language_id"}


{if $action == "edit"}
{input name="aID"}
{/if}

<table cellpadding="0" cellspacing="0" width="100%" height="100%" class="eL">
<tr>
<td colspan="2" class="mT-m2 eL_h">
<div id="eL_formTitle">
			{if $action == "edit"}
			<img src="{$__imageRoot__}/tree/advertise.gif" align="absmiddle" alt="reklama" /> {$item.ad_name}
			{elseif $action == "add"}
			<img src="{$__imageRoot__}/tree/advertise.gif" align="absmiddle" /> NOWA REKLAMA
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
				<td class="eL_formOptions-lng">
					{if $__languages__}
					Publikuj w języku:
					{foreach from=$__languages__ item="l" key="k"}
					
					{input name="languages_status_`$l.id`"}					
					<a {if $language_id == $l.id}class="cl"{/if} href="{wt_href_tpl_link get_params="language_id" parameters="language_id=`$l.id`"}" onClick="action_form_large(this.href, '{if $action == "edit"}Edycja wpisu{else}Nowy wpis{/if} - język: {$l.name}'); return false"><img src="{$__imageRoot__}/flags/{$l.code}.gif" alt="{$l.name}" align="absmiddle" />{$l.code}</a>
					{/foreach} 
					{/if}
				</td>
				<td id="eL_formSavingOptions" class="eL_formSavingOptions" align="right">&nbsp;</td>
			</tr>
		</table>
	</td>
	</tr>
<tr> 
<td class="eL_nav">
<a href="#" class="offtab" onClick="addAdvertiseTab.cycleTab(this.id); return false" id="tab1">Ustawienia</a>
<a href="#" class="offtab" onClick="addAdvertiseTab.cycleTab(this.id); return false" id="tab3">Miejsca wyświet.</a>
<a href="#" class="offtab" onClick="addAdvertiseTab.cycleTab(this.id); return false" id="tab4">Gdzie wyświetlać</a>
<a href="#" class="offtab" onClick="addAdvertiseTab.cycleTab(this.id); return false" id="tab2">Publikacja</a><div style="float:left;" class="piperzoneIE"></div></td>

<td class="eL_form" valign="top"><div id="eL_form">
<div class="eL_formC">

<div class="hide" id="page1">
<h1>[USTAWIENIA]</h1>
{label for="ad_name"}
{input name="ad_name"}

{label for="ad_url"}
{input name="ad_url"}

{label for="ad_type"}
{input name="ad_type"}

{label for="ad_target"}
{input name="ad_target"}

<div id="adv_text_subform" style="display:none;">
<h1>[TREŚĆ]</h1>
{label for="ad_title"}
{input name="ad_title"}

<h2>{label for="ad_desc"} <br />
{wt_init_editor id="ad_desc"}</h2>
<div >{input name="ad_desc"}</div>
<div class="eL_tao">
<b>potrzeba:</b> <a href="#" onClick="Interface.textAreaSize('ad_desc', '+'); return false">więcej</a> <a href="#" onClick="Interface.textAreaSize('ad_desc', '-'); return false">mniej</a> miejsca</div>
</div>

<div id="adv_file_subform" style="display:none;">
<h1>[PLIK]</h1>
<table width="90%">
<tbody>
<tr>
	<td width="250" align="center">{wt_thumb_image 	
			src="mod_advertise/`$item.ad_image`" 
			width="250"
			height="250"
			compress="100"
			show_blank="1"
			watermark=""}</td>
	<td valign="top">
		
		<table>
		<tbody>
		<tr>
			<td><b>Wgraj nowy plik:</b></td>
		</tr>
		<tr>
			<td>{input name="ad_image"}</td>
		</tr>
		{if $action == "edit" && $item.ad_image}
		<tr>
			<td>{input name="delete_ad_image"} {input name="previus_ad_image"}<b style="color: #F00;">usuń</b></td>
		</tr>
		{wt_getimagesize file="`$__mediaFSRoot__`mod_advertise/`$item.ad_image`" assign=ad_image_info}
		{if $ad_image_info}
		<tr>
			<td><a class="ag" href="{$__BaseMediaRoot__}/mod_news/topics/{$item.ad_image}" target="_blank" onclick="popupWindow(this.href, 'img_prev', '{$ad_image_info.width+20}', '{$ad_image_info.height+20}', 'yes'); return false;">
				<img src="{$__imageRoot__}/icon_preview.gif" align="absmiddle" alt="" />
			powiększ</a></td>
		</tr>
		{/if}
		{/if}
		{if $__languages__}
			 <tr>
			 	<td>{input name="ad_image_multilng"} <b>Ten sam plik we wszystkich językach</b></td>
			 </tr>
		{/if}		
		</tbody>
		</table>
		
	</td>
</tr>
</tbody>
</table>
</div>

</div>

<div class="hide" id="page2">
<h1>[PUBLIKACJA]</h1>

{label for="status"}
{input name="status"}

{label for="date_up"}
{input name="date_up"}&nbsp;{input name="date_up_call"}

{label for="date_down"}
{input name="date_down"}&nbsp;{input name="date_down_call"}

{label for="ad_expire_display"}
{input name="ad_expire_display"} wyświetleniach

{label for="ad_expire_clicks"}
{input name="ad_expire_clicks"} kliknięciach


</div>

<div class="hide" id="page3">
<h1>[MIEJSCA WYŚWIETLANIA]</h1>
<table cellpadding="0" cellspacing="0" width="95%" style="margin-top: 20px;">
{foreach from=$groups_tree item=group}
<tr>
<td width="10" style="border-bottom: 1px #c0c0c0 solid;">{input name="groups_`$group`"}</td>
<td valign="middle" style="border-bottom: 1px #c0c0c0 solid;">{label for="groups_`$group`"}</td>
</tr>
{/foreach}
</table>
</div>

<div class="hide" id="page4">
<h1>[GDZIE WYSWIETLAĆ]</h1>
<br /><br />
{include file="`$__templateFSRoot__`admin2/source/modules/mod_modules_manager/sub/showon_form.tpl"}
</div>

</div></div></td>
</table>