 <script type="text/javascript">
								   
								   function show_newsletter()
								   {
								   		document.getElementById('all_newsletter').style.display='block';
								   }
								   
								   function unshow_newsletter()
								   {
								   		document.getElementById('all_newsletter').style.display='none';
								   }
								   
								   </script>
<div id="content" align="center">

 	<?php if($error!=''){ ?>
		<div class="column full">
			<span class="message information"><strong><?php echo $error;?></strong></span>
		</div>
    <?php }?>

	<div align="left" class="column half">
		<div class="box">
			<h2 class="box-header">Newletter Settings </h2> 
			<div class="box-content">
			
			  <?php
				$attributes = array('name'=>'frm_spam_setting');
				echo form_open('newsletter/newsletter_setting',$attributes);
			  ?>
			  
			  	  
				  
				  <label class="form-label">From Name </label>
		    	  <input type="text" name="newsletter_from_name" id="newsletter_from_name" value="<?php echo $newsletter_from_name; ?>" class="form-field width40"/>
				  									
				  <label class="form-label">From Email Address </label> 
				  <input type="text" name="newsletter_from_address" id="newsletter_from_address" value="<?php echo $newsletter_from_address; ?>" class="form-field width40"/>
									
			    <!--   <label class="form-label">Total Registration Allow From Same IP </label>
				  <input type="text" name="total_register" id="total_register" value="<?php //echo $total_register; ?>" class="form-field width40"/>-->
				  
				   <label class="form-label">Reply Name </label> 
				  <input type="text" name="newsletter_reply_name" id="newsletter_reply_name" value="<?php echo $newsletter_reply_name; ?>" class="form-field width40"/>
				  
				  <label class="form-label">Reply Email Address</label>
				  <input type="text" name="newsletter_reply_address" id="newsletter_reply_address" value="<?php echo $newsletter_reply_address; ?>" class="form-field width40"/>
				  
				  <label class="form-label">New Subscribe Email</label>
				  <input type="text" name="new_subscribe_email" id="new_subscribe_email" value="<?php echo $new_subscribe_email; ?>" class="form-field width40"/>
				  
				  <label class="form-label">Unsubscriber Email</label>
				  <input type="text" name="unsubscribe_email" id="unsubscribe_email" value="<?php echo $unsubscribe_email; ?>" class="form-field width40"/>

				  <label class="form-label">User Default Newsletter</label>
				  <table border="0" cellpadding="2" cellspacing="2" style="padding:0px; margin:0px;">
									<tr>
									<td align="left" valign="top" style="padding:0px; margin:0px;"><input type="radio" name="new_subscribe_to" value="none" <?php if($new_subscribe_to=='none') { ?> checked="checked" <?php } ?> onClick="unshow_newsletter()" style="width:30px;" /></td><td align="left" valign="top" style="padding:0px; margin:0px;">None</td>
								<td align="left" valign="top" style="padding:0px; margin:0px;"><input type="radio" name="new_subscribe_to" value="all" onClick="unshow_newsletter()" <?php if($new_subscribe_to=='all') { ?> checked="checked" <?php } ?> style="width:30px;" /></td><td align="left" valign="top" style="padding:0px; margin:0px;">All</td>
									<td align="left" valign="top" style="padding:0px; margin:0px;"> <input type="radio" name="new_subscribe_to" value="selected" <?php if($new_subscribe_to=='selected') { ?> checked="checked" <?php } ?> style="width:30px;" onClick="show_newsletter()" /></td><td align="left" valign="top" style="padding:0px; margin:0px;"> Selected</td></tr></table>
                                    
                                    
                                    
                        <br /><div id="all_newsletter" style="display:<?php if($new_subscribe_to=='selected') { echo "block"; } else { echo "none"; } ?>;">
						<label class="form-label">Newsletter </label>
									
                          <select name="selected_newsletter_id" id="selected_newsletter_id" class="form-field settingselectbox required">
						  <?php   
						  		if($all_newsletter) {
						  			foreach($all_newsletter as $news) {  
						  ?>
						  	 <option value="<?php echo $news->newsletter_id; ?>" <?php if($selected_newsletter_id==$news->newsletter_id) { ?> selected="selected" <?php } ?> style="text-transform:capitalize;" ><?php echo $news->subject; ?></option>
						   
						  <?php }  } else { ?>
							 <option value="">No Template </option>
						  <?php } ?>  
                          </select>
									
						</div>
						
								   
									
									
				 <label class="form-label">Number Of Email Send</label>
				  <input type="text" name="number_of_email_send" id="number_of_email_send" value="<?php echo $number_of_email_send; ?>" class="form-field width40"/>
				  
				  <label class="form-label">Break Between No. Email Send</label>
				  <input type="text" name="break_between_email" id="break_between_email" value="<?php echo $break_between_email; ?>" class="form-field width40"/>			
									
				  <label class="form-label">Break Type </label>
                  
				  <select name="break_type" id="break_type" class="form-field settingselectbox required" >
						<option value="minutes" <?php if($break_type  == 'minutes'){ ?> selected="selected" <?php } ?>> Minutes</option>
						<option value="hours" <?php if($break_type  == 'hours'){ ?> selected="selected" <?php } ?>> Hours</option>	 	  				 												
				  </select>
				  
				   <label class="form-label">Mailer </label>
                  
				  <select name="mailer" id="mailer" class="form-field settingselectbox required" >
						<option value="mail" <?php if($mailer  == 'mail'){ ?> selected="selected" <?php } ?>> PHP Mail</option>
						<option value="smtp" <?php if($mailer  == 'smtp'){ ?> selected="selected" <?php } ?>> SMTP</option>	 	
						 <option value="sendmail" <?php if($mailer=='sendmail') { ?> selected="selected" <?php } ?> >sendmail</option>  				 												
				  </select>
				  
				   <label class="form-label">Send Mail Path</label>
				  <input type="text" name="sendmail_path" id="sendmail_path" value="<?php echo $sendmail_path; ?>" class="form-field width40"/>
				  
				   <label class="form-label">SMTP Port</label>
				  <input type="text" name="smtp_port" id="smtp_port" value="<?php echo $smtp_port; ?>" class="form-field width40"/><spam>(465 or 25 or 587)</spam>
				  
				   <label class="form-label">SMTP Host</label>
				  <input type="text" name="smtp_host" id="smtp_host" value="<?php echo $smtp_host; ?>" class="form-field width40"/>(if smtp user is gmail then ssl://smtp.googlemail.com)
				  
				  
				  <label class="form-label">SMTP Email</label>
				  <input type="text" name="smtp_email" id="smtp_email" value="<?php echo $smtp_email; ?>" class="form-field width40"/>
				  
				  <label class="form-label">SMTP Password</label>
				  <input type="password" name="smtp_password" id="smtp_password" value="<?php echo $smtp_password; ?>" class="form-field width40"/>
				  
				  
				  <label class="form-label">&nbsp;</label>
				 <input type="hidden" name="newsletter_setting_id" id="newsletter_setting_id" value="<?php echo $newsletter_setting_id; ?>" />	
				 
				 

				  <input type="submit" class="button themed" name="submit" value="Update" onclick=""/>
				  
			  </form>

			</div>
		</div>
	</div>
	<div class="clear"></div>
</div>