<label for="params_type" id="params_type_label">Stanowisko</label>
		<select name="params[type]" id="params_type">
		 	<option value="">--- wybierz ---</option>
		 	<option value="instalator" {if $__userInfo__.usr_params_array.type == "instalator"}selected{/if}>instalator</option>
		 	<option value="sklep_detal" {if $__userInfo__.usr_params_array.type == "sklep_detal"}selected{/if}>pracownik sklepu</option>
		 	<option value="hurt" {if $__userInfo__.usr_params_array.type == "hurt"}selected{/if}>pracownik hurtowni</option>
		 	<option value="architekt" {if $__userInfo__.usr_params_array.type == "architekt"}selected{/if}>architek / projektant</option>
		</select>