{if $item}
{php}
$item = $this->_tpl_vars['item'];
$mod_structure_add_manager = wt_module::singleton('mod_structure_add_manager');
$aP = array();
$aP['where'] = " sa.it_id = '".$item['it_id']."' AND ";
$aP['limit'] = 1;
$aP['dsplit'] = 1;
$aP['get_array'] = true;
$this->assign('a_item', $a_item = $mod_structure_add_manager->get_added_items(null, $aP));
{/php}
<table width="100%">
	<tr>
		<td width="150">
			{wt_thumb_image
				src="mod_structure/`$item.it_id`/`$item.it_logo`"  
				MAXwidth="150"
				compress="75"
  				show_blank="1"
	 			alt="`$item.it_name`"
	 			class="oSlogo"}
		</td>
		<td>
			<table class="infoTable">
				<tr>
					<td class="infoTableL">Dodał</td>
					<td>
						{$a_item.usr_first_name} {$a_item.usr_last_name}
						{if $a_item.usr_company}
						<br />
						{$a_item.usr_company}<br /><small>(NIP: {$a_item.usr_company_vat_id})</small>
						{/if}
					</td>
				</tr>
				<tr>
					<td class="infoTableL">Adres</td>
					<td>
						{$a_item.usr_address}<br />
						{$a_item.usr_post_code} {$a_item.usr_city}<br />
					</td>
				</tr>
				<tr>
					<td class="infoTableL">E-mail</td>
					<td><a href="mailto:{$a_item.usr_email}">{$a_item.usr_email}</a></td>
				</tr>
				<tr>
					<td class="infoTableL">Data</td>
					<td>{$a_item.date_added}</td>
				</tr>
			</table
		</td>
		<td>
			<table class="infoTable">
				<tr>
					<td class="infoTableL">Nazwa</td>
					<td>{$a_item.it_name}</td>
				</tr>	
				<tr>
					<td class="infoTableL">Notatka</td>
					<td>{$item.a_note}</td>
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
		</td>{*
		<td style="width: 30%">
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
		*}
	</tr>
</table>	

{else}
NIE ZNALEZIONO INFORMACJI O STRONIE
{/if}