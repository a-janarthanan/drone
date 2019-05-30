<style>
.textstyle{
	resize: none;
	height: 200px;
	width: 480px;
	padding: 2px 0 2px 5px;
	border: 1px solid silver;
	border-radius: 5px;
	-webkit-border-radius: 5px;
	color: black;
	font-size: 12px;
}
</style>

<div id="content" align="center">
 	<?php if($error!=''){ ?>
		<div class="column full" >
			<span class="message information"><strong><?php echo $error;?></strong></span>
		</div>
    <?php }?>

	<div align="left" class="column">
		<div class="box">
			<h2 class="box-header">Editing in "<i><?php echo $task;?></i>" Template </h2> 
			<div class="box-content">	
				<div style="margin-left:200px;">
			  <?php
					$attributes = array('name'=>'frm_email_template');
					echo form_open('email_template/add_email_template',$attributes);
			  ?>				
				  <label class="form-label">From Address </label> 
				  <input type="text" name="from_address" id="from_address" value="<?php echo $from_address; ?>" class="form-field width40"/>
                  
									
				  <label class="form-label">Reply Address </label> 
				  <input type="text" name="reply_address" id="reply_address" value="<?php echo $reply_address; ?>" class="form-field width40"/>
				  
				  <label class="form-label">Subject </label>
                  <input type="text" name="subject" id="subject" value="<?php echo $subject; ?>" class="form-field width40"/>
                  
                  <label class="form-label">Message </label>
                  <textarea class="textstyle" name="message" cols="" rows="" id="message"><?php echo $message; ?></textarea>

				  <label class="form-label">&nbsp;</label>
				  <input type="hidden" name="email_template_id" id="email_template_id" value="<?php echo $email_template_id; ?>" />
				  <input type="submit" class="button themed" name="submit" value="Update" onclick=""/>
			  </form>
              </div>
              
               <!--Email Tag -->  
               <table border="0" cellpadding="2" cellspacing="2">
               
               <tr><td align="left" valign="middle" height="70" colspan="3" style="font-size:18px; font-weight:bold;">Email Tag<br />
<span style="font-size:12px; font-weight:normal;">(copy paste the tags with braces into the message part)</span> </td></tr>

               <tr>
               <td align="left" valign="top" style="font-weight:bold;">Welcome Email</td>
               <td align="center" valign="top">:</td>
               <td align="left" valign="top">{user_name}, {email}</td>
               </tr>

               <tr>
               <td align="left" valign="top" style="font-weight:bold;">New User Join</td>
               <td align="center" valign="top">:</td>
               <td align="left" valign="top">{user_name}, {email}, {password}, {login_link}</td>
               </tr>
               
               <tr>
               <td align="left" valign="top" style="font-weight:bold;">Forgot Password</td>
               <td align="center" valign="top">:</td>
               <td align="left" valign="top">{user_name}, {email}, {password}, {login_link}</td>
               </tr>

               <tr>
               <td align="left" valign="top" style="font-weight:bold;">Admin User Active</td>
               <td align="center" valign="top">:</td>
               <td align="left" valign="top">{user_name}, {email}, {password}</td>
               </tr> 
               
               <tr>
               <td align="left" valign="top" style="font-weight:bold;">Admin User Inactive</td>
               <td align="center" valign="top">:</td>
               <td align="left" valign="top">{user_name}, {email}</td>
               </tr>

               <tr>
               <td align="left" valign="top" style="font-weight:bold;">Admin User Delete</td>
               <td align="center" valign="top">:</td>
               <td align="left" valign="top">{user_name}</td>
               </tr>
               
               <tr>
               <td align="left" valign="top" style="font-weight:bold;">Contact Us</td>
               <td align="center" valign="top">:</td>
               <td align="left" valign="top">{name}, {email}, {message}</td>
               </tr>

               <tr>
               <td align="left" valign="top" style="font-weight:bold;">New Project Successful Alert</td>
               <td align="center" valign="top">:</td>
               <td align="left" valign="top">{user_name}, {email}, {project_name},  {project_page_link}</td>
               </tr>

               <tr>
               <td align="left" valign="top" style="font-weight:bold;">Admin Project Activate Alert</td>
               <td align="center" valign="top">:</td>
               <td align="left" valign="top">{user_name}, {email}, {project_name}, {project_page_link}</td>
               </tr>

               <tr>
               <td align="left" valign="top" style="font-weight:bold;">Admin Project Inactivate Alert</td>
               <td align="center" valign="top">:</td>
               <td align="left" valign="top">{user_name}, {email}, {project_name}, {project_page_link}</td>
               </tr>

               <tr>
               <td align="left" valign="top" style="font-weight:bold;">Admin Project Delete Alert</td>
               <td align="center" valign="top">:</td>
               <td align="left" valign="top">{user_name}, {email}, {project_name}</td>
               </tr>

               <tr>
               <td align="left" valign="top" style="font-weight:bold;">New Comment Admin Alert</td>
               <td align="center" valign="top">:</td>
               <td align="left" valign="top">{user_name}, {email}, {project_name}, {project_page_link}, {comment}, {comment_user_name}, {comment_user_profile_link}</td>
               </tr>

               <tr>
               <td align="left" valign="top" style="font-weight:bold;">New Comment Owner Alert</td>
               <td align="center" valign="top">:</td>
               <td align="left" valign="top">{user_name}, {email}, {project_name}, {project_page_link}, {comment}, {comment_user_name}, {comment_user_profile_link}</td>
               </tr>
 
               <tr>
               <td align="left" valign="top" style="font-weight:bold;">New Comment Poster Alert</td>
               <td align="center" valign="top">:</td>
               <td align="left" valign="top">{user_name}, {email}, {project_name}, {project_page_link}, {comment}, {comment_user_name}, {comment_user_profile_link}</td>
               </tr>

               <tr>
               <td align="left" valign="top" style="font-weight:bold;">New Fund Admin Notification</td>
               <td align="center" valign="top">:</td>
               <td align="left" valign="top">{user_name}, {project_name}, {project_page_link}, {donor_name}, {donor_profile_link}, {donote_amount}</td>
               </tr>

               <tr>
               <td align="left" valign="top" style="font-weight:bold;">New Fund Owner Notification</td>
               <td align="center" valign="top">:</td>
               <td align="left" valign="top">{user_name}, {project_name}, {project_page_link}, {donor_name}, {donor_profile_link}, {donote_amount}</td>
               </tr>
               
               <tr>
               <td align="left" valign="top" style="font-weight:bold;">New Fund Donor Notification</td>
               <td align="center" valign="top">:</td>
               <td align="left" valign="top">{user_name}, {project_name}, {project_page_link}, {donor_name}, {donor_profile_link}, {donote_amount}</td>
               </tr>

               <tr>
               <td align="left" valign="top" style="font-weight:bold;">Other HTML Tags</td>
               <td align="center" valign="top">:</td>
               <td align="left" valign="top">{break}</td>
               </tr>

               </table>
              <!--Email Tag -->
              
			</div>
		</div>
	</div>
	<div class="clear"></div>
</div>