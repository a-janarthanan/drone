

<div id="content-login">
	
    
    
     <?php
										  
										  if($error!='')
										  {
										  
										  	if($error == 'success')
											{
												echo "<span class='message information' style='top:7px;'>Password is send to your email address.</span>";
											}
											
											elseif($error == 'email_not_found')
											{
												echo "<span class='message warning' style='top:7px;'>User Email address is not found.</span>";
											}
											
											
											elseif($error == 'record_not_found')
											{
												echo "<span class='message warning' style='top:7px;'>User recode is not found.</span>";
											}
											else
											{
												echo "<span class='message warning' style='top:7px; display:block;'>".$error."</span>";
											}
											
															
											
											
										}
									
										  ?>
                                          
                                          
                                          
	
	<!--<div class="logo"></div>-->
	

    
      <?php if($error == 'success') { ?>
      
      
      <p>
		  <?php echo anchor(base_url(),'Back to Login',' title="Login" class="forgot"');?>	
		</p>
      
      
      <?php } else { ?>
	
    
    	<h2 class="header-login">Forget Password </h2>
	
      <?php
			$attributes = array('name'=>'frm_forgot_password','id'=>'box-login');
			echo form_open('home/forgot_password',$attributes);
		  ?>
										
                                        
                                        
		<p>
			<label class="req"> Email : </label>
			<br/>
			<input type="text" name="email" value="" id="forgot_email" />
		</p>
		
		
		<p class="fr">
			
			<input type="submit" name="Login" value="Send" class="button themed" id="login"/>
            <input type="reset" value="Reset" class="button black" />
		</p>
		
		<div class="clear"></div>
	</form>
    <?php echo anchor(base_url(),'Back to Login',' title="Login" class="forgot"');?>
	
    
    <?php } ?>
    
</div>