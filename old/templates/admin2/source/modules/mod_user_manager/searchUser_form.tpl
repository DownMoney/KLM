<link rel="stylesheet" href="{$__BaseJsRoot__}/calendar2/calendar-win2k-1.css" type="text/css">
<script type="text/javascript" src="{$__BaseJsRoot__}/calendar2/calendar.js"></script>
<script type="text/javascript" src="{$__BaseJsRoot__}/calendar2/lang/calendar-pl.js"></script>
<script type="text/javascript" src="{$__BaseJsRoot__}/calendar2/calendar-setup.js"></script>
<script type="text/javascript" src="{$__BaseJsRoot__}/general.js"></script>
{input name="mod"}
{input name="m"}
{input name="t"}
<table class="searchTable" cellpadding="0" cellspacing="0">
<thead>
	<tr>
		<td width="33%"><h2>Użytkownik</h1></td>
		<td width="33%"><h2>Firma</h2></td>		
		<td width="33%" class="last"><h2>Pozostałe</h2></td>
	</tr>
</thead>
<tbody>
	<tr>
		<td>
			{label for="usr_first_name"}{input name="usr_first_name"}
			{label for="usr_last_name"}{input name="usr_last_name"}
			{label for="usr_city"}{input name="usr_city"}
			{label for="usr_state"}{input name="usr_state"}
		</td>
		<td>
			{label for="usr_company"}{input name="usr_company"}
			{label for="usr_company_city"}{input name="usr_company_city"}
			{label for="usr_company_state"}{input name="usr_company_state"}
		</td>
		<td class="last">
			{label for="status"}{input name="status"}
			<label for="">data rejestracji</label>od {input name="date_added_from"} do {input name="date_added_to"}
			{label for="usr_source"}{input name="usr_source"}
			{label for="usr_confirm_sended"}{input name="usr_confirm_sended"}			
		</td>
	</tr>
	<tr>
		<td colspan="4" class="submit">{input name="submit_button"}</td>
	</tr>
</tbody>
</table>
{literal}
<style type="text/css">
	#date_added_from, #date_added_to { width: 80px; float:none; clear:none; }
</style>
<script type="text/javascript">
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