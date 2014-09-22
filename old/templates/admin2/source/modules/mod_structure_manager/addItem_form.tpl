{input name="action"}
{input name="submit_type"}
{if !$__isRoot__}
{input name="it_type"}
{/if}
{input name="parent_id"}
{input name="list_fields_changed"}
{input name="tree_fields_changed"}
{input name="language_id"}
{input name="_return2"}
{input name="_formType"}

{if $action == "edit"}
{input name="iID"}
{/if}

<table cellpadding="0" cellspacing="0" width="100%" height="100%" class="eL">
	<tr>
		<td colspan="2" class="mT-m2 eL_h">
			<div id="eL_formTitle">
			{if $action == "edit"}
			<img src="{$__imageRoot__}/tree/{$item.itt_ico}.gif" align="absmiddle" alt="{$type.itt_name|strip_quotas}" /> {$item.it_name}
			{elseif $action == "add"}
			<img src="{$__imageRoot__}/tree/{$item_type.itt_ico}.gif" align="absmiddle" /> NOWY: {$item_type.itt_name}
			{/if}
			</div>
			<div class="eL_but">{input name="submit_button"} {input name="save_close_button"} {input name="cancel_button"}</div>
		</td>
	</tr>
	<tr>
	<td colspan="2" class="eL_formOptions">
		<table cellpadding="0" cellspacing="0" width="100%">
			<tr>
				<td class="eL_formOptions-lng">
					{if $__languages__ && $item_type.itt_disable_languages != "1"}
					<table>
						<tr>
					<td>Publikuj w:</td>
					<td style="background:#E1E1E1"><input type="checkbox" id="setAllLanguageStatusCheckbox" onClick="setCheckBoxByClassName(this.checked,'languageStatus');" />wsz</td>
					{assign var="selected_language_visible" value="0"}
					{foreach from=$__languages__ item="l" key="k" name="__languages__"}
					{if $smarty.foreach.__languages__.iteration <= 5}
					{if $language_id == $l.id}{assign var="selected_language_visible" value="1"}{/if}
					<td>{input name="languages_status_`$l.id`"}<a {if $language_id == $l.id}class="cl"{/if} href="{wt_href_tpl_link get_params="language_id" parameters="language_id=`$l.id`"}" onClick="if(($('form_was_changed').value == '1' && confirm('NIE ZAPISANO ZMIAN !!! \n\nJesteś pewien, że chcesz zmienić język edycji ?\n\nJeżeli nie chcesz zapisywać zmian i przejść do edycji innej wersji językowej kliknij przycik OK.\nJeżeli chcesz zapisać swoje zmiany kliknij na przycisk ANULUJ a następnie ZAPISZ w prawym górnym rogu. \n\nPamiętaj, że nie zapisane zmiany zostaną utracone na zawsze !!!')) || !$('form_was_changed') || $('form_was_changed').value != '1') {ldelim} action_form_large(this.href, '{if $action == "edit"}Edycja wpisu{else}Nowy wpis{/if} - język: {$l.name}'); {rdelim} return false"><img src="{$__imageRoot__}/flags/{$l.code}.gif" alt="{$l.name}" align="absmiddle" />{$l.code}</a></td>
					{/if}
					{/foreach}
					{if count($__languages__) > 5}
					{if $selected_language_visible == 0}
						{foreach from=$__languages__ item="l" key="k" name="__languages__"}
						{if $language_id == $l.id}
						<td>| {input name="languages_status_`$l.id`"}<a {if $language_id == $l.id}class="cl"{/if} href="{wt_href_tpl_link get_params="language_id" parameters="language_id=`$l.id`"}" onClick="if(($('form_was_changed').value == '1' && confirm('NIE ZAPISANO ZMIAN !!! \n\nJesteś pewien, że chcesz zmienić język edycji ?\n\nJeżeli nie chcesz zapisywać zmian i przejść do edycji innej wersji językowej kliknij przycik OK.\nJeżeli chcesz zapisać swoje zmiany kliknij na przycisk ANULUJ a następnie ZAPISZ w prawym górnym rogu. \n\nPamiętaj, że nie zapisane zmiany zostaną utracone na zawsze !!!')) || !$('form_was_changed') || $('form_was_changed').value != '1') {ldelim} action_form_large(this.href, '{if $action == "edit"}Edycja wpisu{else}Nowy wpis{/if} - język: {$l.name}'); {rdelim} return false"><img src="{$__imageRoot__}/flags/{$l.code}.gif" alt="{$l.name}" align="absmiddle" />{$l.code}</a></td>
						{/if}
						{/foreach}
					{/if}
					<td><nobr><ul class="dropDownMenu" id="languageMenu" style="display:none;">
					<li>|więcej &raquo;<ul>
					{foreach from=$__languages__ item="l" key="k" name="__languages__"}
					{if $smarty.foreach.__languages__.iteration > 5}
					<li>{input name="languages_status_`$l.id`"}<a {if $language_id == $l.id}class="cl"{/if} href="javascript:action_form_large('{wt_href_tpl_link get_params="language_id" parameters="language_id=`$l.id`"}', '{if $action == "edit"}Edycja wpisu{else}Nowy wpis{/if} - język: {$l.name}');"><img src="{$__imageRoot__}/flags/{$l.code}.gif" alt="{$l.name}" align="absmiddle" />{$l.name}</a></li>
					{/if}
					{/foreach}
					</ul></li>
					</ul>
					{/if}
					</nobr></td>
					</tr>
					</table>

					{/if}
				</td>
				<td id="eL_formSavingOptions" class="eL_formSavingOptions" align="right"><nobr>najpierw {input name="action_save"} potem {input name="action_after"}</nobr></td>
			</tr>
		</table>

	</td>
	</tr>
	<tr>
		<td class="eL_nav"><a href="#" class="offtab" onClick="addItemTab.cycleTab(this.id); return false" id="tab1">Treść</a>{foreach from="$fields" item="fi"}{if $fi.fi_root_show == "0" || $__isRoot__}<a href="#" class="offtab" onClick="addItemTab.cycleTab(this.id); return false" id="tab_{$fi.fi_gr}">{$fi.fi_name_short|default:$fi.fi_name}</a>{/if}{/foreach}{if $item_type_params.itemAdd_status != "0" || $item_type_params.itemAdd_dateupdown != "0" || $item_type_params.itemAdd_parent_id != "0"}<a href="#" class="offtab" onClick="addItemTab.cycleTab(this.id); return false" id="tab2">Publikacja</a>{/if}{if $params}<a href="#" class="offtab" onClick="addItemTab.cycleTab(this.id); return false" id="tab3">Parametry</a>{/if}{*if $__isRoot__}<a href="#" class="offtab" onClick="addItemTab.cycleTab(this.id); return false" id="tab5">Parametry typu</a>{/if*}{if $item_type_params.itemAdd_meta != "0"}<a href="#" class="offtab" onClick="addItemTab.cycleTab(this.id); return false" id="tab4">Optymalizacja - SEO</a>{/if}{if $__isRoot__}<a href="#" class="offtab" onClick="addItemTab.cycleTab(this.id); return false" id="tab6">ROOT</a></a>{/if}
	{if $add_form_section!=0}
		<script language="javascript" type="text/javascript">
			{literal}
			add_events_to_tabs = function() {
				var links_td = $$('td.eL_nav');
				var links_tabs = links_td[0].select('a');
				var i = 0;
				for(i=0;i<links_tabs.length;i++) {
					links_tabs[i].observe('click', function(e) {
						if (e.target.id=='tab_form') {
							$('newFormContentOption').show();
						} else {
							$('newFormContentOption').hide();
						}
					});
				}
			}
			{/literal}
			add_events_to_tabs();
		</script>
		{* assign var=fi_id value=fi_id *}
		{include file="`$__templateFSRoot__`admin2/source/modules/mod_structure_manager/sub/addFormForm.tpl"}
		{/if}
		</td>
		<td class="eL_form" valign="top"><div id="eL_form"><div class="eL_formC">
			<div class="hide" id="page1">
				<h1>[TREŚĆ]</h1>

				{label for="it_name"}
				{input name="it_name"}

				{if $item_type_params.itemAdd_it_name_short != "0"}
				{label for="it_name_short"}
				{input name="it_name_short"}
				{/if}

				{if $item_type_params.itemAdd_tags != "0"}
				{label for="tags"}
				{input name="tags"}
				{/if}

				{if $item_type_params.itemAdd_it_desc_short != "0"}
				<h2>{label for="it_desc_short"} {*<span class="minihelp">(?)</span>*}
				<span><input type="checkbox" checked="checked" onClick="Element.toggle('g_it_desc_short_i');" id="g_it_desc_short_c" /> twórz automatycznie</span> </h2>
				<div id="g_it_desc_short_i" style="display: none;" class="eL_hec">
				{wt_init_editor id="it_desc_short"}<br />
				{input name="it_desc_short"}
				<div class="eL_tao">
					<b>potrzeba:</b> <a href="#" onClick="Interface.textAreaSize('it_desc_short', '+'); return false">więcej</a> <a href="#" onClick="Interface.textAreaSize('it_desc_short', '-'); return false">mniej</a> miejsca</div>
				</div>

				<script type="text/javascript">
					{literal}
						if( $('it_desc_short').innerHTML != '' ) {
							$('g_it_desc_short_i').show();
							$('g_it_desc_short_c').checked = false;
						}
					{/literal}
				</script>
				{/if}

				{if $item_type_params.itemAdd_it_desc != "0"}
				<h2>{label for="it_desc"} <br />
				{wt_init_editor id="it_desc"}</h2>
				<div >{input name="it_desc"}</div>
				<div class="eL_tao">
				<b>potrzeba:</b> <a href="#" onClick="Interface.textAreaSize('it_desc', '+'); return false">więcej</a> <a href="#" onClick="Interface.textAreaSize('it_desc', '-'); return false">mniej</a> miejsca</div>
				{/if}

				{if $item_type_params.itemAdd_it_logo != "0"}
				<h2>{$item_type_params.itemAdd_it_logo_label|default:"Logo główne"}</h2>
				<table>
					<tbody>
						<tr>
							<td width="170" align="center">{wt_thumb_image
								src="mod_structure/`$item.media_path`/`$item.it_logo`"
								width="150"
								height="150"
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
										<td>{input name="it_logo"}</td>
									</tr>
									{if $action == "edit" && $item.it_logo}
									<tr>
										<td>{input name="delete_it_logo"} {input name="previus_it_logo"}<b style="color: #F00;">usuń</b></td>
									</tr>
									{wt_getimagesize file="`$__mediaFSRoot__`mod_structure/`$item.media_path`/`$item.it_logo`" assign=logo_info}
									{if $logo_info}
									<tr>
										<td><a class="ag" href="{wt_thumb_image
		src="mod_structure/`$item.media_path`/`$item.it_logo`"
		path_return=true}" target="_blank" onclick="popupWindow(this.href, 'img_prev', '{$logo_info.width+20}', '{$logo_info.height+20}', 'yes'); return false;">
										<img src="{$__imageRoot__}/icon_preview.gif" align="absmiddle" alt="" />
										powiększ</a></td>
									</tr>
									{/if}
									{/if}
									{if $__languages__}
									<tr>
										<td>{input name="it_logo_multilng"} <b>To samo logo we wszystkich językach</b></td>
									</tr>
									{/if}
								</tbody>
							</table>
						</td>
					</tr>
				</tbody>
			</table>
			{/if}
			{if $item_type_params.itemAdd_it_logo_large != "0"}
			<h2>{$item_type_params.itemAdd_it_logo_large_label|default:"Duże logo"}</h2>
			<table>
				<tbody>
					<tr>
						<td width="170" align="center">{wt_thumb_image
							src="mod_structure/`$item.media_path`/`$item.it_logo_large`"
							width="150"
							height="150"
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
										<td>{input name="it_logo_large"}</td>
									</tr>
									{if $action == "edit" && $item.it_logo_large}
									<tr>
										<td>{input name="delete_it_logo_large"} {input name="previus_it_logo_large"}<b style="color: #F00;">usuń</b></td>
									</tr>
									{wt_getimagesize file="`$__mediaFSRoot__`mod_structure/`$item.media_path`/`$item.it_logo_large`" assign=logo_info}
									{if $logo_info}
									<tr>
										<td><a class="ag" href="{$__BaseMediaRoot__}/mod_structure/{$item.media_path}/{$item.it_logo_large}" target="_blank" onclick="popupWindow(this.href, 'img_prev', '{$logo_info.width+20}', '{$logo_info.height+20}', 'yes'); return false;">
										<img src="{$__imageRoot__}/icon_preview.gif" align="absmiddle" alt="" />
										powiększ</a></td>
									</tr>
									{/if}
									{/if}
									{if $__languages__}
									<tr>
										<td>{input name="it_logo_large_multilng"} <b>To samo logo we wszystkich językach</b></td>
									</tr>
									{/if}
								</tbody>
							</table>
						</td>
					</tr>
				</tbody>
			</table>
		{/if}

	</div>

	<div class="hide" id="page2">
	<h1>[PUBLIKACJA]</h1>
	 {if $item_type_params.itemAdd_status != "0"}
		{label for="status"}
		{input name="status"}
	 {else}
	 	<input type="hidden" name="status" value="1" id="status" />
	 {/if}

	 {if $item_type_params.itemAdd_dateupdown != "0"}
	 <table>
	 	<tr>
			<td>{label for="date_up"}</td>
			<td>{label for="date_down"}</td>
		</tr>
	 	<tr>
			<td>{input name="date_up"}</td>
			<td>{input name="date_down"}</td>
		</tr>

	 </table>






		<style type="text/css">

		#date_up, #date_down {ldelim} 	background: #FFF url('{$__imageRoot__}/icons/calendar.gif') 3px 4px no-repeat;
					padding-left: 24px;
					 width: 190px; {rdelim}
		</style>

		{*<div id="sl_div"></div>

		<script language="javascript" type="text/javascript">
			{literal}
			new Ajax.Updater('sl_div','{/literal}{wt_href_tpl_link parameters="items&t=getSortList&iID='+$('parent_id').value+'"}{literal}',
					{asynchronous: true, evalScripts: true});
			{/literal}
		</script>*}
	{/if}

		{input name="sort_order"}
	</div>




	{foreach from="$fields" item="fi"}
	<div class="hide" id="page_{$fi.fi_gr}">
		<h1>[{$fi.fi_name|upper}]{if $fi.fi_type == "multi_select_group"} <a href="#" onClick="addNewField('{$fi.fi_id}'); return false">[ dodaj / zmień / usuń ]</a>{/if}{if $__isRoot__}{if $fi.fi_root_show == "1"}<img align="absmiddle" src="{$__imageRoot__}/root_view.gif" alt="ROOT VIEW" /> {/if}{if $fi.fi_root_edit == "1"}<img align="absmiddle" src="{$__imageRoot__}/root_edit.gif" alt="ROOT EDIT" /> {/if}{/if}</h1>
		{assign var="maintab_field" value=$fi}
		<input type="hidden" name="fi[{$fi.fi_id}]"  value="" />
		{if $fi.fi_type == "multi_select_group"}
		<span id="multi_select_{$fi.fi_id}"></span>
		{/if}
		{foreach from=$fi.children item=fic}

		{if $fic.fi_gr != ""}
			{assign var="field_id" value="fi_`$fic.fi_gr`"}
		{else}
			{assign var="field_id" value="fi_`$fic.fi_id`"}
		{/if}

		{if $fic.fi_type != "hidden"}

		{if $fic.fi_type == "head"}<h1>[{$fic.fi_name|upper}]</h1>{/if}

		{if ($fic.fi_root_show == "0" || $__isRoot__) && $fic.fi_type != "multi_select"}<h2> {label for="`$field_id`"} {if $fic.fi_type == "select"}
		{if ($fic.fi_root_edit == 1 && $__isRoot__) || $fic.fi_root_edit == 0}
		<a href="#" onClick="fieldValues('{$fic.fi_id}'); return false">[ dodaj / zmień / usuń ]</a>
		{/if}
		{/if}{if $__isRoot__}{if $fic.fi_root_show == "1"}<img align="absmiddle" src="{$__imageRoot__}/root_view.gif" alt="ROOT VIEW" /> {/if}{if $fic.fi_root_edit == "1"}<img align="absmiddle" src="{$__imageRoot__}/root_edit.gif" alt="ROOT EDIT" /> {/if}{/if}
		{/if}	</h2>{/if}

		{if $fic.fi_type == "gallery" || $fic.fi_type == "files"}

		{include file="`$__templateFSRoot__`admin2/source/modules/mod_structure_manager/sub/filesForm.tpl"}
		{/if}

		{if $fic.fi_type == "googlemaps"}
		{include file="`$__templateFSRoot__`admin2/source/modules/mod_structure_manager/sub/googleMapForm.tpl"}
		{/if}

		{if $fic.fi_type == "multi_select_item" || $fic.fi_type == "select_item"}
		{include file="`$__templateFSRoot__`admin2/source/modules/mod_structure_manager/sub/selectItemForm.tpl"}
		{/if}

		{if $fic.fi_type == "file"}
		{if $action=="add"}
		Pliki można dodawać dopiero po zapisaniu elementu, kliknij {input name="submit_button"}.
		{else}
		{include file="`$__templateFSRoot__`admin2/source/modules/mod_structure_manager/sub/fileForm.tpl"}
		{/if}
		{/if}

		{if $fic.fi_type == "form"}
			{label for="`$field_id`_email_title"} {input name="`$field_id`_email_title"}
			{label for="`$field_id`_email_addresses"} {input name="`$field_id`_email_addresses"}

			{include file="`$__templateFSRoot__`admin2/source/modules/mod_structure_manager/sub/contactForm.tpl"}

		{/if}

		{if $fic.fi_type == "data_table"}
		{include file="`$__templateFSRoot__`admin2/source/modules/mod_structure_manager/sub/dataTableForm.tpl"}
		{/if}

		{if $fic.fi_type == "user_defined"}
		{include file="`$__templateFSRoot__`admin2/source/modules/mod_structure_manager/addons/fFuser_`$fic.fi_gr`.tpl"}
		{/if}

		{if $fic.fi_type == "multi_select"}
		{include file="`$__templateFSRoot__`admin2/source/modules/mod_structure_manager/sub/multiSelectForm.tpl"}
		<br style="clear:both;" />
		{/if}

		{if $fic.fi_type == "select"}<span id="fi_edit_{$fic.fi_id}">{/if}
		{input name="`$field_id`"}

		{if $fic.fi_root_edit == "1" && !$__isRoot__ && $fic.fi_root_show == "0"}
			{if $fic.fi_type == "select"}
			{assign var="select_id" value=$fields_value[$fic.fi_id]}
			<select disabled="disabled" readonly="readonly" class="t3">
				<option>{if $select_id}{php}echo $this->_tpl_vars['fic']['children'][$this->_tpl_vars['select_id']]['fi_name'];{/php}{else}---{/if}</option>
			</select>
			{elseif $fic.fi_type == "textarea"}
			<textarea class="t3" disabled="disabled" readonly="readonly" cols="40" rows="3">{$fields_value[$fic.fi_id]}</textarea>
			{else}
			<input type="text" value="{$fields_value[$fic.fi_id]}" class="t3" disabled="disabled" readonly="readonly" />
			{/if}

		{/if}

		{if $fic.fi_type == "select" || $fic.fi_type == "multi_select"}</span>{/if}

		{if $fic.fi_type == "datetime"}
	   	{literal}
			<script type="text/javascript">
			Calendar.setup({	inputField     :    "{/literal}{$field_id}{literal}",
									ifFormat       :    "%Y-%m-%d %H:%M:00",
						     		showsTime      :    true,
									timeFormat     :    "24",
								   button         :    "{/literal}{$field_id}{literal}",
								   step           :    1
						    	});
			</script>
			{/literal}
			<style type="text/css">
				#{$field_id} {ldelim}
					background: #FFF url('{$__imageRoot__}/icons/calendar.gif') 3px 4px no-repeat;
					padding-left: 24px;
					 width: 190px;
				{rdelim}
			</style>

		{/if}

		{if $fic.fi_type == "date"}
	   	{literal}
			<script type="text/javascript">
			Calendar.setup({	inputField     :    "{/literal}{$field_id}{literal}",
									ifFormat       :    "%Y-%m-%d",
						     		showsTime      :    false,
								   button         :    "{/literal}{$field_id}{literal}",
								   step           :    1
						    	});
			</script>
			{/literal}
			<style type="text/css">
				#{$field_id} {ldelim}
					background: #FFF url('{$__imageRoot__}/icons/calendar.gif') 3px 4px no-repeat;
					padding-left: 24px;
					 width: 130px;
				{rdelim}
			</style>
		{/if}

		{if $fic.fi_depends_on}
		<script type="text/javascript">

			{assign var="fID" value="`$fic.fi_depends_on`"}

			$$('#fi_edit_{$fic.fi_depends_on} tr').each(function(elem) {ldelim}
			Event.observe(elem, 'click', function() {ldelim} updateDependsField{$fic.fi_id}() {rdelim});
			{rdelim});

		updateDependsField{$fic.fi_id} = function() {ldelim}

			var selected_field_values = new Array();
			$$('#fi_edit_{$fic.fi_depends_on} input').each(function(elem) {ldelim}
			if(elem.checked === true) {ldelim}
				selected_field_values.push(elem.value);
			{rdelim}
			{rdelim});
			new Ajax.Updater('fi_edit_{$fic.fi_id}', '{wt_href_tpl_link parameters="m=items&t=updateFieldDepends&language_id=`$language_id`&fID=`$fic.fi_id`&fVAL="}'+selected_field_values.toString(), {ldelim}
			evalScripts:true,
			asynchronous:true,
			onLoading:function(){ldelim}
		  //	  	$('{$field_id}').disable();
			{rdelim},
			onComplete:function(){ldelim}
		  //		$('{$field_id}').enable();
		 //		setFieldSelectedValue{$fic.fi_id}();
			{rdelim}
			{rdelim});
		{rdelim}

  //		updateDependsField{$fic.fi_id}();

		setFieldSelectedValue{$fic.fi_id} = function() {ldelim}
				{assign var="fvid" value="`$fic.fi_id`"}
				$('{$field_id}').value = '{$fields_value.$fvid}';
				var op = $('{$field_id}').options;
				for(i=0;i<op.length;i++) {ldelim}
					if(op[i].value == '{$fields_value.$fvid}') {ldelim}
						op[i].selected = true;
					{rdelim}
				{rdelim}
		{rdelim}

		</script>
		{/if}
		<br style="clear:both;" />
		{/foreach}
	</div>
	{/foreach}


 {if $params}
	<div class="hide" id="page3">
		<h1>[PARAMETRY]</h1>
		{include file="`$__templateFSRoot__`admin2/source/params.tpl"}
	</div>
 {/if}

 {if $__isRoot__}
	<div class="hide" id="page5">
		<h1>[PARAMETRY TYPU - NA RAZIE NIE DZIAŁA!!!]</h1>
		{assign var="params" value=$params_type}
		{assign var="params_prefix" value="params_type"}
		<label for="it_use_item_type_params">Nadpisz parametry typu dla tego elementu</label>
		<input type="checkbox" class="t4checkbox" value="1" name="it_use_item_type_params"{if $item.params_type} checked="checked"{/if}>

		{label for="params_type_itt_sefu_id"}
		{input name="params_type_itt_sefu_id"}

		{label for="params_type_itt_ico"}
		{input name="params_type_itt_ico"}
		<br clear="both"  />

		<table cellspacing="0" class="typeOptions">
			 	<tr>
					<td>{label for="params_type_itt_nochildren"}</td>
					<td style="background: #F0F0F0;">{label for="params_type_itt_root_show"}</td>
					<td>{label for="params_type_itt_root_edit"}</td>
					<td style="background: #F0F0F0;">{label for="params_type_itt_root_addchildren"}</td>
					<td>{label for="params_type_itt_disable_languages"}</td>
					<td style="background: #F0F0F0;">{label for="params_type_itt_mod_structure_add_show"}</td>
				</tr>
				<tr>
					<td align="center">{input name="params_type_itt_nochildren"}</td>
					<td align="center" style="background: #F0F0F0;">{input name="params_type_itt_root_show"}</td>
					<td align="center">{input name="params_type_itt_root_edit"}</td>
					<td align="center" style="background: #F0F0F0;">{input name="params_type_itt_root_addchildren"}</td>
					<td align="center">{input name="params_type_itt_disable_languages"}</td>
					<td align="center">{input name="params_type_itt_mod_structure_add_show"}</td>
				</tr>
			 </table>

			  <style type="text/css">
			  	{literal}
					.typeOptions { float: left; margin: 10px 0 0 0; clear:both; }
					.typeOptions TD { padding: 0 10px; }
				{/literal}
			  </style>
<br class="c" />


				<table cellspacing="0" class="typeOptions">
			 	<tr>
					<td>{label for="params_type_itt_children_only"}</td>
					<td>{label for="params_type_itt_children_only_tree"}</td>
				</tr>
				<tr>
					<td align="center">{input name="params_type_itt_children_only"}</td>
					<td align="center">{input name="params_type_itt_children_only_tree"}</td>
				</tr>
			 </table>
		<br clear="both"  />
		{include file="`$__templateFSRoot__`admin2/source/params.tpl"}
	</div>
 {/if}

 {if $item_type_params.itemAdd_meta != "0"}
 <div class="hide" id="page4">
	<h1>[SEO]</h1>

		{label for="sefu_link"}
		{input name="sefu_link"}

		{label for="meta_title"}
		{input name="meta_title"}

		{label for="meta_keys"}
		{input name="meta_keys"}

		{label for="meta_desc"}
		{input name="meta_desc"}
	</div>
 {/if}

 {if $__isRoot__}
 <div class="hide" id="page6">
	<h1>[ROOT]</h1>

		{label for="import_id"}
		{input name="import_id"}

		{label for="it_type"}
		{input name="it_type"}



	</div>
 {/if}



</div></div></td>
</tr>

<tr>
	<td colspan="2" class="addItemMetaData">#{$item.it_id|default:"nowy"} | Dodano: {$item.date_added|date_format:"%a, %d %b %Y @ %T"},  przez: --- | Modyfikowano: {$item.last_modified|date_format:"%a, %d %b %Y @ %T"}, przez: --- | Wersja: {$item.version}</td>
</tr>

</table>
<script type="text/javascript">
{literal}
fieldValues = function(fi_id) {
{/literal} urlF = '{wt_href_tpl_link mod_key="mod_structure_manager"  parameters="t=fieldValues&fID='+fi_id+'&language_id=`$language_id`&iID=`$item.it_id`"}'; {literal}
	dialogForm({url: urlF});
}

addNewField = function(fi_id) {
{/literal} urlF = '{wt_href_tpl_link mod_key="mod_structure_manager"  parameters="t=addNewField&parent_id='+fi_id+'&language_id=`$language_id`&iID=`$item.it_id`"}'; {literal}
	dialogForm({url: urlF});
}

{/literal}
</script>

{if file_exists("`$__templateFSRoot__`admin2/source/modules/mod_structure_manager/addons/addItem/`$item_type.itt_key`.tpl")}
{include file="`$__templateFSRoot__`admin2/source/modules/mod_structure_manager/addons/addItem/`$item_type.itt_key`.tpl"}
{/if}
