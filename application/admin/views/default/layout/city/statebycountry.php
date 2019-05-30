


<label class="form-label">State </label>
<select name="state_id" id="state_id" class="form-field settingselectbox required">
<option value=""> -- Select State -- </option>
    <?php
        if($state)
        {
            foreach($state as $cnt)
            {
    ?>
        <option value="<?php echo $cnt->state_id; ?>" ><?php echo $cnt->state_name; ?></option>
    <?php
            }
        } else {
        	echo '<option value="">No State</option>';
        }
    ?>										
</select>
