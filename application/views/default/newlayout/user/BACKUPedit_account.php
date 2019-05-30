

<div class="main">
<div class="incon">
    	<div class="mconleft">


  <div class="padT10B20">
           <div id="s1postJ">Edit Memeber : <?php echo anchor('user/'.getUserProfileName(),$user_info->first_name.' '.$user_info->last_name,'class="dhan unl"'); ?></div>
          
          	<div class="marTB10">
            
          
	           
  <?php if($error!=''){ 
  
  if($error=='update') {  ?>
  
  	<div id="success">
					<ul>
				<p>Profile has been updated successfully.</p>
					</ul>
				</div>
                
                
  <?php } else { ?>
				<div id="error">
					<ul>
					<?php  echo $error; ?>
					</ul>
				</div>
			<?php }  } ?>
            
              <p>Name shown on public profile: <span style="color:#000000;"><?php echo $user_info->profile_name; ?></span></p>
              
              
 <?php
		$attributes = array('name'=>'editForm','id'=>'editForm','class'=>'form_design');
		echo form_open('user/edit',$attributes);
	?>
            
            
              <fieldset>
         
        
            <table width="100%" border="0" cellspacing="0" cellpadding="5" >
    
            
      <tr id="first_nameTR">
        <td width="28%" valign="top"><label class="lab1" >First Name *</label></td>
        <td width="72%"><input type="text" name="first_name" id="first_name" value="<?php echo $first_name; ?>"  class="ntext"  /><br />
         <span id="first_nameInfo">Please enter your first and last name.</span>
        </td>
      </tr>
      
      
      
        <tr id="last_nameTR">
        <td width="28%" valign="top"><label class="lab1" >Last Name *</label></td>
        <td width="72%"><input type="text" name="last_name" id="last_name" value="<?php echo $last_name; ?>"  class="ntext"  /><br />
         <span id="last_nameInfo">Please enter your first and last name.</span>
        </td>
      </tr>
      
      
        <tr id="emailTR">
        <td valign="top"><label class="lab1" >Email *</label></td>
        <td><input type="text" name="email" id="email" value="<?php echo $email; ?>"  class="ntext"  /><br />
        <span id="emailInfo"></span></td>
      </tr>
      
      
      
      <tr id="zip_codeTR">
        <td valign="top"><label class="lab1"  >Postal Code *</label></td>
        <td><input type="text" name="zip_code" id="zip_code" value="<?php echo $zip_code; ?>"  class="ntext"  /><br />
        
        <span id="zip_codeInfo"></span>
         </td>
      </tr>
      
      
      </table>
        </fieldset>
             
			</div>           
                


<div class="marTB10">

<h3 style="color:#000;"> Phone Number</h3>



           <fieldset>
         
        
            <table width="100%" border="0" cellspacing="0" cellpadding="5">
              
              
                <tr id="mobile_noTR">
        <td valign="top" width="28%"><label class="lab1" >Mobile No.</label></td>
        <td width="72%"><input type="text" name="mobile_no" id="mobile_no" value="<?php echo $mobile_no; ?>"  class="ntext"  /><br />
        <span id="mobile_noInfo"></span>
            <div id="mbs">Adding your mobile phone ensures you will get the latest updates about the Tasks you post.</div>
            
        </td>
      </tr>
      
    
     <tr id="phone_noTR">
        <td valign="top"><label class="lab1" >Phone No.</label></td>
        <td><input type="text" name="phone_no" id="phone_no" value="<?php echo $phone_no; ?>"  class="ntext"  /><br />
        <span id="phone_noInfo"></span>
           
            
        </td>
      </tr>
      
             
            
   			</table>  
             </fieldset> 
                
</div>                

<div class="marTB10">
	           
          <input type="submit" value="Update" class="submbg2" name="editbtn" id="editbtn">     
               
            </form>   
               
</div>            


                


            
            
         
  </div>      
                
                
		</div>
        
        <?php echo $this->load->view($theme.'/layout/user/user_sidebar'); ?>
		
        
        
    </div>
</div>

<script type="text/javascript" src="<?php echo base_url().getThemeName(); ?>/js/validation.js"></script>