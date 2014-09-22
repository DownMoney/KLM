<div class="menu">
	<ul>
		<li class="menuFirst"><a href="{wt_href_tpl_link mod_key="home"}" title=" {$smarty.const.SITE_NAME} ">{$smarty.const.TEXT_MPAGE}</a></li>
		{foreach from="$BCMS_structure" item="it" name="BCMS_structure"}
			<li><a {if $smarty.get.mod == "82" && $smarty.request.cPath == $it.cPath}id="active"{/if} href="{wt_href_tpl_link mod_key="mod_structure" parameters="t=iP&cPath=`$it.cPath`"}" title=" {$it.it_name|strip_quotas} ">{$it.it_name}</a></li>
		{/foreach}
	</ul>{*
	<div class="lang">
		<a href="{wt_href_tpl_link parameters="language=pl" mod_key="home" search_engine_safe=false}" class="fl_pl" {if $__languagesCurLanguage__.code=="pl"}id="lpl_active"{/if}></a>
		<a href="{wt_href_tpl_link parameters="language=en" mod_key="home" search_engine_safe=false}" class="fl_en" {if $__languagesCurLanguage__.code=="en"}id="len_active"{/if}></a>
		<a href="{wt_href_tpl_link parameters="language=de" mod_key="home" search_engine_safe=false}" class="fl_de" {if $__languagesCurLanguage__.code=="de"}id="lde_active"{/if}></a>
		<a href="{wt_href_tpl_link parameters="language=ru" mod_key="home" search_engine_safe=false}" class="fl_ru" {if $__languagesCurLanguage__.code=="ru"}id="lru_active"{/if}></a>
	</div>*}
</div>
