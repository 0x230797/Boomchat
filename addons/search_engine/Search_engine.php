<?php include('../../system/config.php'); ?>
<div class="Search_engine_container">

<!-- your content here -->
<div id="search_engine_search">
	<select>
		<option><?php echo 'Both'; ?></option>
		<option><?php echo $lang_male; ?></option>
		<option><?php echo $lang_female; ?></option>
	</select>
	<select>
		<?php
			for($value = $setting['min_age']; $value <= 99; $value++){
						echo "<option value=\"$value\">$value</option>";
			}
		?>
	</select>
	<select>
		<?php
			for($value = $setting['min_age']; $value <= 99; $value++){
						echo "<option value=\"$value\">$value</option>";
			}
		?>
	</select>
	<select>
		<option><?php echo 'World'; ?></option>
		<option><?php echo 'My region'; ?></option>
		<option><?php echo 'My country'; ?></option>
	</select>
</div>
<div id="search_engine_result">
</div>
</div>