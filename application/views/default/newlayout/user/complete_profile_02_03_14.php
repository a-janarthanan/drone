<div style="height:250px; width:620px;">
<?php $site_setting=site_setting(); ?>
<center>

<h3 class="whereu">Check <span class="colgreen">Your</span> <span class="colred">Progress</span></h3>


</center>

<div class="marTB10">
    <div class="fl colblack">
    <div class="fs15"><?php echo ucfirst($user_profile->first_name).' '.ucfirst(substr($user_profile->last_name,0,1));?>.</div>
    <div class="fs14">Joined <?php echo $site_setting->site_name;  ?>&nbsp;<?php echo date('m/Y',strtotime($user_profile->sign_up_date)); ?>&nbsp;&nbsp;</div>
    </div>
    <div class="fl">
     <?php
					if($user_profile->profile_image!='') {  
					
						if(file_exists(base_path().'upload/user/'.$user_profile->profile_image)) { ?>
                        
                        <img src="<?php echo base_url(); ?>upload/user/<?php echo $user_profile->profile_image;?>"  alt=""  border="0" width="50" height="50"  />
                        
                        <?php } else { ?>
                        
                  <img src="<?php echo base_url(); ?>upload/no_image.png" border="0" width="50" height="50" alt=""  />
                    
                    <?php } } else { ?>
                    
                    <img src="<?php echo base_url(); ?>upload/no_image.png" border="0" width="50" height="50" alt=""  />
                    
                    <?php } ?>
    </div>
    <div class="clear"></div>
</div>

<?php
 $signup_complete=user_profile_sign_up_complete();
	  $pickcity_complete=user_profile_pick_city_complete();
	  $mobile_complete=user_profile_mobile_complete();
	  $userphoto_complete=user_profile_photo_complete();
	  $userinfo_complete=user_profile_info_complete();
	 
	 $signup_cnt=0;
	 $pickcity_cnt=0;
	  $mobile_cnt=0;  $userphoto_cnt=0;   $userinfo_cnt=0;
	  
	 if($signup_complete==17) { $signup_cnt=1; }
	  if($pickcity_complete==20) { $pickcity_cnt=1; }
	   if($mobile_complete==21) { $mobile_cnt=1; }
	    if($userphoto_complete==21) { $userphoto_cnt=1; }
		 if($userinfo_complete==21) { $userinfo_cnt=1; }
	 
	 $total_complete=$signup_complete+$pickcity_complete+$mobile_complete+$userphoto_complete+$userinfo_complete;
	  
	  ?>
      
      





<div style=" padding:10px; background-color:#7494b4; border-radius:10px;">
<div class="grn_pro" style="width:<?php echo  $total_complete; ?>%;"></div>
</div>
<br/>



<ul class="skkul">
	
    <?php if($signup_cnt==1) { ?>
    
      <li><span class="sky1">Finish signup</span><!-- 17% --></li>
      
    <?php } if($pickcity_cnt==1) { ?>
    
      <li><span class="sky1">Pick a city</span><!-- 37% --></li>    
    
    
     <?php } if($userphoto_cnt==1) {  ?>
     
     <li><span class="sky1">Upload a Photo</span><!-- 58%   21--></li>
     
      <?php } if($mobile_cnt==1) { ?>
      
      <li><span class="sky1">Add a phone</span><!-- 79%   21--></li>	   
      
       <?php } if($userinfo_cnt==1) { ?>
       
       	 <li style="margin:0px;"><span class="sky1">Add profile info</span><!-- 100%  21 --></li> 
      
    <?php } ?>
  
  
  
   <?php if($signup_cnt==0) { ?>
    
      <li><?php echo anchor('account','Finish signup','class="sky2"'); ?><!-- 17% --></li>
      
    <?php } if($pickcity_cnt==0) { ?>
    
      <li><?php echo anchor('account','Pick a city','class="sky2"'); ?><!-- 37% --></li>    
    
    
     <?php } if($userphoto_cnt==0) {  ?>
     
     <li><?php echo anchor('customize_profile','Upload a Photo','class="sky2"'); ?><!-- 58%   21--></li>
     
      <?php } if($mobile_cnt==0) { ?>
      
      <li><?php echo anchor('account','Add a phone','class="sky2"'); ?><!-- 79%   21--></li>	   
      
       <?php } if($userinfo_cnt==0) { ?>
       
       	<li style="margin:0px;"><?php echo anchor('customize_profile','Add profile info','class="sky2"'); ?><!-- 100%  21 --></li> 
      
    <?php } ?>
	
	

    <div class="clear"></div>
</ul>


</div>
