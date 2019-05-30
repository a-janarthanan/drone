<!--banner start-->
<div id="acc-banners-ph" class="banner-contain"></div>
<!--banner ends-->

<div>
<div>
<div class="red-subtitle top-red-subtitle">Edit Member  : <?php echo anchor('user/'.getUserProfileName(),$user_info->first_name.' '.$user_info->last_name,'style="color:#fff"'); ?></div>
<div class="profile_back">
<div class="container">
<div class="db-rightinfo db-rightinfo-inner" style="width:100%; margin:0px 0 0 0">
<div class="home-signpost-content home-signpost-content-new-section">
    	<div class="dbleft dbleft-main">

 <?php
		$attributes = array('name'=>'editForm','id'=>'editForm','class'=>'form_design');
		echo form_open('user/edit',$attributes);
	?>
  <div class="padB20">
           
          
          	<div class="marB10">
            
          
	           
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
            
              <p style="font-size:24px; color:#ec6600; text-decoration:underline;"><strong>Name shown on public profile: <span style="color:#ec6600;"><?php echo $user_info->profile_name; ?></span></strong></p>
              
              

            
            
              <fieldset>
         
        
<table width="275" border="0" cellspacing="0" cellpadding="5" class="fl" style="margin-right:30px;" >
     <tr id="first_nameTR" >
        <td valign="top" class="first_nameTD"><label class="first-name-title">First Name *</label></td>
     </tr>
     <tr>
        <td ><input type="text" name="first_name" id="first_name" value="<?php echo $first_name; ?>"  class="form-control form-control-1"  />
        <span id="first_name_symbol" style="float:left; height:30px; margin-left:5px;"></span><br />
        <span id="first_nameInfo" style="height:5px;"></span>
        </td>
      </tr>
      
   	 
      
      
      <tr id="emailTR">
        <td valign="top" class="first_nameTD"><label class="first-name-title" >Email *</label></td>
      </tr>
      <tr>
        <td><input type="text" name="email" id="email" value="<?php echo $email; ?>"  class="form-control form-control-1"  />
        <span id="email_symbol" style="float:left; height:30px; margin-left:5px;"></span><br />
        <span id="emailInfo" style="height:5px;"></span>
        </td>
      </tr>
      <tr><td colspan="2" style="height:5px;"></td></tr>
      
      
      
</table>
<table width="275" border="0" cellspacing="0" cellpadding="5" class="fl" >
     
      
   	 <tr id="last_nameTR">
        <td valign="top" class="first_nameTD"><label class="first-name-title" >Last Name *</label></td>
     </tr>
     <tr>
        <td><input type="text" name="last_name" id="last_name" value="<?php echo $last_name; ?>"  class="form-control form-control-1"  />
        <span id="last_name_symbol" style="float:left; height:30px; margin-left:5px;"></span><br />
        <span id="last_nameInfo" style="height:5px;"></span>
        </td>
     </tr>
      
      
      
      <tr id="zip_codeTR">
        <td valign="top" class="first_nameTD"><label class="first-name-title"  >Document Id</label></td>
      </tr>
      <tr>
        <td><input type="text" name="zip_code" id="zip_code" value="<?php echo $zip_code; ?>"  class="form-control form-control-1"  />
        <span id="zip_code_symbol" style="float:left; height:30px; margin-left:5px;"></span><br />
        <span id="zip_codeInfo" style="height:5px; float:left;"></span>
         </td>
      </tr>
      
      </table>      
        </fieldset>
             
			</div>           
                


<div class="marTB10">

<h3 style="color:#585858;"> Phone Number</h3>



           <fieldset>
<table width="275" border="0" cellspacing="0" cellpadding="5" class="fl" style="margin-right:30px;" >
     <tr id="first_nameTR" >
        <td valign="top" class="first_nameTD"><label class="first-name-title">Mobile No.</label></td>
     </tr>
     <tr>
        <td ><input type="text" name="mobile_no" id="mobile_no" value="<?php echo $mobile_no; ?>"  class="form-control form-control-1"  /><br />
        <span id="mobile_noInfo"></span>
        </td>
      </tr>
      
   	 </table>
 <table width="275" border="0" cellspacing="0" cellpadding="5" class="fl" style="margin-right:30px;" >     
      
      <tr id="emailTR">
        <td valign="top" class="first_nameTD"><label class="first-name-title" >Phone No.</label></td>
      </tr>
      <tr>
        <td><input type="text" name="phone_no" id="phone_no" value="<?php echo $phone_no; ?>"  class="form-control form-control-1"  /><br />
        <span id="phone_noInfo"></span></td>
      </tr>
      <tr><td colspan="2" style="height:5px;"></td></tr>
      
      
      
</table>
          
             </fieldset> 
                
</div>                
<div style="text-align:center; margin-bottom:30px; width:590px;" class="marTB10 width_wallet">
                    				            
          <input type="submit" value="Update" class="btn btn-default btn-default-join btn-app" name="editbtn" id="editbtn">               				
                   			 	</div>
	           
          
               
            
               
</div>            


                

</form>   
            
            
         
  </div>      
                
                
		</div>
        <div class="dbright-task dbright-task-main">
        <?php echo $this->load->view($theme.'/layout/user/user_sidebar'); ?>
		</div>
</div>
</div>     
<div class="clear"></div>  
</div>
</div>        
        
    </div>
</div>

<script type="text/javascript" src="<?php echo base_url().getThemeName(); ?>/js/validation.js"></script>