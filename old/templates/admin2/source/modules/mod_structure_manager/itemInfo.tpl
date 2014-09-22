{if $item}
<table width="100%">
	<tr>
		<td width="150">
			{wt_getimagesize file="`$__mediaFSRoot__`mod_structure/`$item.media_path`/`$item.it_logo`" assign=im_info}
{if $im_info}<a href="{wt_thumb_image 	
		src="mod_structure/`$item.media_path`/`$item.it_logo`"  
		path_return=true}" target="_blank"  onClick="popupWindow(this.href, 'map', '{$im_info.width+40}', '{$im_info.height+40}', 'yes'); return false;">{/if}{wt_thumb_image 	
		src="mod_structure/`$item.media_path`/`$item.it_logo`"  
		MAXwidth="150"
		compress="75"
		show_blank="1"
		alt="`$item.it_name`"
		class="oSlogo"}{if $im_info}</a>{/if}	
		</td>
		<td>
			<table class="infoTable">
				<tr>
					<td class="infoTableL">Nazwa</td>
					<td>{$item.it_name}</td>
				</tr>	
				<tr>
					<td class="infoTableL">Typ</td>
					<td>{$item.itt_name}</td>
				</tr>	
				<tr>
					<td class="infoTableL">Krótki opis</td>
					<td>{$item.it_desc|strip_tags|truncate:200}</td>
				</tr>
				<tr>
					<td class="infoTableL">Adres dla administratora</td>
					<td><input type="text" value="{wt_href_tpl_link mod_key="mod_structure" parameters="t=iP&cPath=`$item.cPath`&_aCI=1&_aCC=`$item._aCC`" full_url=true search_engine_safe=false}" /> <a href="{wt_href_tpl_link mod_key="mod_structure" parameters="t=iP&cPath=`$item.cPath`&_aCI=1&_aCC=`$item._aCC`" full_url=true search_engine_safe=false}" target="_blank">przejdź &raquo;</a></td>
				</tr>
				<tr>
					<td class="infoTableL">Adres dla użytkownika</td>
					<td><input type="text" value="{wt_href_tpl_link mod_key="mod_structure" parameters="t=iP&cPath=`$item.cPath`" full_url=true}" /> <a href="{wt_href_tpl_link mod_key="mod_structure" parameters="t=iP&cPath=`$item.cPath`"}" target="_blank">przejdź &raquo;</a></td>
				</tr>
			</table>
		</td>
		<td>
			<table class="infoTable">
				<tr>
					<td class="infoTableL">Dodano:</td>
					<td>{$item.date_added}</td>
				</tr>
				<tr>
					<td class="infoTableL">Dodał:</td>
					<td>{$item.added_by|default:"---"}</td>
				</tr>
				<tr>
					<td class="infoTableL">Modyfikowano:</td>
					<td>{$item.last_modified|default:"---"}</td>
				</tr>
				<tr>
					<td class="infoTableL">Modyfikował:</td>
					<td>{$item.modified_by|default:"---"}</td>
				</tr>		
			</table>
		</td>
	</tr>
</table>	

{else}
NIE ZNALEZIONO INFORMACJI O STRONIE
{/if}