<div id="content" align="center">

 	<?php if($error!=''){ ?>
		<div class="column full">
			<span class="message information"><strong><?php echo $error;?></strong></span>
		</div>
    <?php }?>

	<div align="left" class="column half">
		<div class="box">
			<h2 class="box-header">Email Settings </h2> 
			<div class="box-content">
			
			  <?php
				$attributes = array('name'=>'frm_email_setting');
				echo form_open('email_setting/add_email_setting',$attributes);
			  ?>
			  
			  	  <label class="form-label">Mailer </label>
					<select name="mailer" id="mailer" class="form-field settingselectbox required" >
						<option value="mail" <?php if($mailer=='mail') { ?> selected="selected" <?php } ?> >PHP Mail</option>
						<option value="smtp" <?php if($mailer=='smtp') { ?> selected="selected" <?php } ?> >SMTP</option>
						<option value="sendmail" <?php if($mailer=='sendmail') { ?> selected="selected" <?php } ?> >sendmail</option>	
					</select>
				  
				  <label class="form-label">Send Mail Path </label>
		    	  <input type="text" name="sendmail_path" id="sendmail_path" value="<?php echo $sendmail_path; ?>" class="form-field width40"/>(if Mailer is sendmail)
				  									
				  <label class="form-label">SMTP Port </label> 
				  <input type="text" name="smtp_port" id="smtp_port" value="<?php echo $smtp_port; ?>" class="form-field width40"/>(465 or 25 or 587)
									
				  <label class="form-label">SMTP Host </label> 
				  <input type="text" name="smtp_host" id="smtp_host" value="<?php echo $smtp_host; ?>" class="form-field width40" readonly="readonly"/>(if smtp user is gmail then ssl://smtp.googlemail.com)
				  
				  <label class="form-label">SMTP Email </label>
				  <input type="text" name="smtp_email" id="smtp_email" value="<?php echo $smtp_email; ?>" class="form-field width40"/>
				  
				  <label class="form-label">SMTP Password</label>
				  <input type="password" name="smtp_password" id="smtp_password" value="<?php echo $smtp_password; ?>" class="form-field width40"/>

				  <label class="form-label">&nbsp;</label>
				  <input type="hidden" name="email_setting_id" id="email_setting_id" value="<?php echo $email_setting_id; ?>" />

				  <input type="submit" class="button themed" name="submit" value="Update" onclick=""/>
				  
			  </form>

			</div>
		</div>
	</div>
	<div class="clear"></div>
</div>