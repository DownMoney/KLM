<link rel="stylesheet" href="{$__BaseJsRoot__}/calendar2/calendar-win2k-1.css" type="text/css">
<script type="text/javascript" src="{$__BaseJsRoot__}/calendar2/calendar.js"></script>
<script type="text/javascript" src="{$__BaseJsRoot__}/calendar2/lang/calendar-pl.js"></script>
<script type="text/javascript" src="{$__BaseJsRoot__}/calendar2/calendar-setup.js"></script>
<script type="text/javascript" src="{$__BaseJsRoot__}/general.js"></script>
<style type="text/css">
{literal}
#data_list_body { background: #FFF; padding: 10px; height: 100%;}
.zestawienie { width: 100%; }
.zestawienie TD { padding: 2px 5px; }
.zestawienie thead TD { background: #DCDCDC; }
.zestawienie tbody .row2 { background: #efefef; }
.zestawienie tbody TD { text-align: right; }
.summary td { font-weight: bold; background-color: #C0C0C0;}


.mainTable { width: 100%; }
.mainTable TD { border-right: 1px solid #c0c0c0; padding: 5px 10px; vertical-align: top; }
.mainTable TD TD { border-right: 0; padding: 2px 5px; }

.mainTable h1 { font-size: 17px; margin: 0; background: #efefef; padding: 5px 5px;}
.mainTable h2 { font-size: 13px; margin: 0; background: #F7F7F7; padding: 5px 5px;}

.mainTable TD.radio { width: 10px; padding: 2px 0;  }
{/literal}
</style>




<table class="mainTable" cellpadding="0" cellspacing="0">
<thead>
	<tr>
		<td><h1>Użytkownik</h1></td>
		<td><h1>Firma</h1></td>		
		<td><h1>Pozostałe</h1></td>
		<td><h1>Opcje</h1></td>
	</tr>
</thead>
<tbody>
	<tr>
		<td>
			{*******		CZAS	*******}
			<table>
				<tr>
					<td>{label for="gSearch"}{input name="gSearch"}</td>
				</tr>
				<tr>
					<td>{label for="usr_first_name"}{input name="usr_first_name"}</td>
				</tr>
				<tr>
					<td>{label for="usr_last_name"}{input name="usr_last_name"}</td>
				</tr>
				<tr>
					<td>{label for="usr_city"}{input name="usr_city"}</td>
				</tr>
				<tr>
					<td>{label for="usr_state"}{input name="usr_state"}</td>
				</tr>
			</table>
		</td>
		<td>
			<table>
			  <tr>
					<td>{label for="usr_company"}{input name="usr_company"}</td>
			  </tr>
			  <tr>
					<td>{label for="usr_company_city"}{input name="usr_company_city"}</td>
			  </tr>
			  <tr>
					<td>{label for="usr_company_state"}{input name="usr_company_state"}</td>
			  </tr>
			</table>
		</td>
		<td>
			<table>
				<tr>
					<td>{label for="status"}{input name="status"}</td>
			  </tr>
			  <tr>	
					<td><label for="">data rejestracji</label>od {input name="date_added_from"} do {input name="date_added_to"}</td>
			  </tr>
			  <tr>	
					<td>{label for="usr_source"}{input name="usr_source"}</td>
			  </tr>
			  <tr>	
					<td>{label for="usr_confirm_sended"}{input name="usr_confirm_sended"}</td>
			  </tr>
			</table>
		</td>
		<td>
			<table>
				<tr>
					<td class="radio">{input name="show_stocks_details"}</td>
					<td>{label for="show_stocks_details"}</td>
				</tr>
				<tr>
					<td class="radio">{input name="show_only_for_products"}</td>
					<td>{label for="show_only_for_products"}</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="4" align="center">{input name="submit_button"}</td>
	</tr>
</tbody>
</table>




<script type="text/javascript">
{literal}
		
	 Calendar.setup({
        inputField     :    "date_added_from",           
        ifFormat       :    "%Y-%m-%d",
        showsTime      :    false,
        button         :    "date_added_from",        
        step           :    1
    });
	 
	Calendar.setup({
        inputField     :    "date_added_to",           
        ifFormat       :    "%Y-%m-%d",
        showsTime      :    false,
        button         :    "date_added_to",        
        step           :    1
    });	 
	 
	 
{/literal}
</script>