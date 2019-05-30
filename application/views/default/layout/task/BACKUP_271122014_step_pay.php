<script type="text/javascript">
jQuery(document).ready(function() {	
	
	jQuery("#learnmore").fancybox({
				'titlePosition'		: 'inside',
				'transitionIn'		: 'none',
				'transitionOut'		: 'none'
			});
	
  
});

</script>
<div>
<div>

<div class="red-subtitle" style="margin:172px 0 0 0">Review</div>
 <div id="two-columnar-section">
        <div class="task-layout">
        <div class="db-rightinfo" style="width:100%; margin:25px 0 0 0">
        <div class="home-signpost-content">
<?php
$site_setting=site_setting();
 $data['task_detail']=$task_detail;
  $data['site_setting']=$site_setting;

?>
<?php
	$attributes = array('name'=>'frm_pay_task');
	echo form_open('task/pay/'.$task_id,$attributes);
?>

    	<div class="dbleft" style="margin:0 0 0 15px">


<?php if($error != '') { ?>     
<div class="errmsgcl"> 
	<div class="follfi">There were problems with the following fields:</div>
	<?php if($error=='fail') { echo "Unable to verify your credit card."; } else { echo $error; } ?>
</div>
<?php } ?>
<!--<center>
           <img src="<?php echo base_url().getThemeName(); ?>/images/2n.png" alt=""  />
</center>-->   
<div class="fleftfw" style="text-align:center"><img src="<?php echo base_url().getThemeName(); ?>/images/posttask-status22.png"></div>       
           <!--<div id="s1post">Review</div>-->
        
<div class="tabs2">
            <!-- <h4>Pay  &nbsp;<select name="paymenttype"  id="paymenttype">
							<option value="1">Test Mode</option>
							<option value="0">Live Mode</option>
						</select></h4>-->
                        
                        <input type="hidden" name="paymenttype" id="paymenttype" value="0" />
						
						<input type="hidden" value="<?php echo $task_id;?>" id="task_id" name="task_id" />
            
            <?php if($card_verify_status==0 || $card_verify_status=='') { ?> 

            <div class="borrdercol">
            	<h1 id="bilt">Your Billing Information</h1>
            <h3 class="section-title" style="width:97%;margin-bottom:10px;">Credit card <span id="req" class="crec1" >Your card will not be charged until the Task is complete. <a href="#learnmoreinfo" id="learnmore">Learn more</a></span> </h3>
			
<div style="display: none;">
		<div id="learnmoreinfo" style="width:500px;height:140px;overflow:auto;">
        <div class="clear"></div>
			<div class="fl padTB3 marL5"><h2>Why we need your credit card</h2></div>
			

<div class="clear"></div>
 <ol class="ordlist fs11 LH18">
	<li>We verify your identity using a credit card to protect our <?php echo $site_setting->site_name; ?> against mischievous <?php echo $site_setting->site_name; ?> users. Our background-checked <?php echo $site_setting->site_name; ?> trust us to ensure Tasks are legal and are requested by "neighborly" people.</li>
    <li>The credit card also ensures <?php echo $site_setting->site_name; ?> are paid back any expenses incurred beyond your redeemed credits.</li>
 </ol>
		</div>
	</div>
    
    
<div class="wrap4"></div>             
                
                
            <table width="100%" border="0" cellspacing="0" cellpadding="3">
              <tr>
                 <td><h4 class="fs13">First name</h4></td>
                <td><h4 class="fs13">Last name</h4></td>
              </tr>
              <tr>
                <td><input name="card_first_name" id="card_first_name" type="text" class="ntext" value="<?php echo $card_first_name;?>" /></td>
                <td><input name="card_last_name" id="card_last_name" type="text"  class="ntext" value="<?php echo $card_last_name;?>"  /></td>
              </tr>

              <tr>
                <td><h4 class="fs13">Card number</h4></td>
                <td><h4 class="fs13">Card type <span class="marL57">Expiration Date</span></h4></td>
              </tr>
              <tr>
                <td><input name="cardnumber" id="cardnumber" type="text" value="<?php echo $cardnumber; ?>" class="ntext"  size="19" maxlength="19"  /></td>
                <td>
                    <select name="cardtype" id="cardtype" class="wid120 fs11"  onChange="javascript:generateCC(); return false;">
						<option value='Visa' <?php if($cardtype=='Visa') { ?> selected <?php } ?>>Visa</option>
                        <option value='MasterCard'  <?php if($cardtype=='MasterCard') { ?> selected <?php } ?>>MasterCard</option>
                        <option value='Discover'  <?php if($cardtype=='Discover') { ?> selected <?php } ?>>Discover</option>
                        <option value='Amex'  <?php if($cardtype=='Amex') { ?> selected <?php } ?>>American Express</option>
                    </select>
                    
                    <select name="card_expiration_month" id="card_expiration_month" class="fs11">
						<option value="1" <?php if($card_expiration_month==1) { ?> selected <?php } ?>>1</option>
						<option value="2"  <?php if($card_expiration_month==2) { ?> selected <?php } ?>>2</option>
						<option value="3"  <?php if($card_expiration_month==3) { ?> selected <?php } ?>>3</option>
						<option value="4"  <?php if($card_expiration_month==4) { ?> selected <?php } ?>>4</option>
						<option value="5"  <?php if($card_expiration_month==5) { ?> selected <?php } ?>>5</option>
						<option value="6"  <?php if($card_expiration_month==6) { ?> selected <?php } ?>>6</option>
						<option value="7"  <?php if($card_expiration_month==7) { ?> selected <?php } ?>>7</option>
						<option value="8"  <?php if($card_expiration_month==8) { ?> selected <?php } ?>>8</option>
						<option value="9"  <?php if($card_expiration_month==9) { ?> selected <?php } ?>>9</option>
						<option value="10"  <?php if($card_expiration_month==10) { ?> selected <?php } ?>>10</option>
						<option value="11"  <?php if($card_expiration_month==11) { ?> selected <?php } ?>>11</option>
						<option value="12"  <?php if($card_expiration_month==12) { ?> selected <?php } ?>>12</option>
                    </select>
                    
                    <select name="card_expiration_year" id="card_expiration_year" class="fs11">
						<?php for($i=date('Y');$i<=date('Y')+7;$i++) 
						{ ?>
                                              
                        <option value="<?php echo $i;?>" <?php if($card_expiration_year==$i) { ?> selected <?php } ?>><?php echo $i;?></option>
						<?php } ?>
                    </select>
				</td>
              </tr>

            </table>
 
			<h3 class="section-title" style="width:97%;margin-top:10px;">Billing address <span id="req" class="crec1" >Required for credit card verification.</span> </h3>







<table width="100%" border="0" cellspacing="1" cellpadding="1">
<?php if($user_location) { ?>

  
  <?php foreach($user_location as $location) { ?>
  <tr>
    <td width="20"><input type="radio" name="user_location_id" value="<?php echo $location->user_location_id; ?>" id="user_location_id" <?php if(($location->is_home==1) || $user_location_id==$location->user_location_id ) { ?>checked="checked" <?php } ?>/></td>
                <td><label><?php echo ucfirst($location->location_name);?></label></td>
               </tr>
                <tr>
                <td>&nbsp;</td>
                <td><span>(<?php if($location->location_address!='') { echo $location->location_address.','; }

   if($location->location_city!='') { echo $location->location_city.','; }
   
    if($location->location_state!='') { echo $location->location_state.','; }
	
	 if($location->location_zipcode!='') { echo $location->location_zipcode; }
   
   ?>)</span></td>                
  </tr>
 
 
 
 <?php } ?>

<?php } ?>

 <tr><td colspan="2" height="10">&nbsp;</td></tr>
 
 
 	<tr><td><input type="radio" name="user_location_id" id="user_location_id" value="other" <?php if($user_location_id=='other' || $card_address!='') {  ?> checked <?php } else { if(!$user_location) {  ?> checked <?php } } ?> /></td>
                <td><label>Fill out form</label></td>
                </tr>
                
                
</table>



<table width="100%" border="0" cellspacing="1" cellpadding="3">



  <tr>
    <td><h4 class="fs13">Address</h4></td>
    <td></td>
    <td></td>
   </tr>
  <tr>
    <td><input name="card_address" id="card_address" type="text"  class="ntext" value="<?php echo $card_address; ?>"  /></td>
    <td></td>
    <td></td>
   </tr>
   
  <tr>
    <td><h4 class="fs13">City</h4></td>
    <td><h4 class="fs13">State</h4></td>
    <td><h4 class="fs13">Zip</h4></td>
   </tr>
  <tr>
    <td><input name="card_city"  id="card_city" type="text"  class="ntext" value="<?php echo $card_city; ?>" /></td>
    <td><input name="card_state" id="card_state" type="text"   size="15" value="<?php echo $card_state;?>" /></td>
    <td><input name="card_zipcode" id="card_zipcode" type="text"  size="15"  value="<?php echo $card_zipcode; ?>" /></td>
   </tr>
   
   
    <tr>
  
 
    <td align="left" valign="top" colspan="3"><h4><input name="save_location" type="checkbox" value="1" id="save_location"  <?php if($save_location==1) { ?> checked <?php } ?>/> Save this location</h4></td>
  </tr>

   
</table>   


  <?php  } ?>
  <br>
             
			  
            </div>
            
             
   
              
<div class="borrdercol marT10">
 	<div class="abct3">
    <?php
	
	
		$user_detail=$this->user_model->get_user_profile_by_id($task_detail->user_id);
	
	 $user_image= base_url().'upload/no_image.png';
						 
		 if($user_detail->profile_image!='') {  
	
			if(file_exists(base_path().'upload/user/'.$user_detail->profile_image)) {
		
				$user_image=base_url().'upload/user/'.$user_detail->profile_image;
				
			}
			
		}
		
		
		?>
    	<img src="<?php echo $user_image; ?>" width="50" height="50" alt="" />
    </div>
 	<div class="catle3n" >
    	
        <h2 class="col"><?php echo ucfirst($task_detail->task_name);?></h2>
        <p style="float:left; clear:both; width:90%">posted by <?php echo anchor('user/'.getUserProfileName(),$user_info->first_name.' '.substr($user_info->last_name,0,1),'class="fpass"');?> for Worker bee in <?php echo ucfirst($task_detail->city_name); ?></p>
    </div>
    <div class="addtrr" ><?php echo anchor('task/step_one/'.$task_id,'Edit Task', 'class="chbg1 marTB10 chbg"');?></div>
	
	<div class="clear"></div>  
    <div style="height:5px;">&nbsp;</div>
    
  <h3 class="section-title" style="width:97%;margin-bottom:10px;">Details</h3>    
 	<div class="marL15" >
  		<div id="icard"><b>
        
        
       <!-- <?php if($task_detail->task_auto_assignment==2) { ?> 
           
           Let me review the Worker bee
           
            <?php } elseif($task_detail->task_auto_assignment==3) {?>
            
            <?php $worker_detail=$this->worker_model->get_worker_info($task_detail->task_assing_worker);
				
				echo 'We will Notify '. ucfirst($worker_detail->first_name).' '.ucfirst($worker_detail->last_name); ?> first
            
            <?php } else { ?>
            
             We will Auto-assign the Task Worker bee who makes the best offer on your Task
            
            <?php } ?>-->
            
            
        
        
        
         </b></div>
    
  		<div id="dat1" class="marTB5">If unassigned, Task will expire on: <b>
        
      
         <?php	
		 
		 echo date('M d',strtotime(date("Y-m-d", strtotime($task_detail->task_post_date)) . " +".$task_detail->task_start_day."days")).',&nbsp;';	
		
		echo date('h A',mktime(0,$task_detail->task_start_time,0,0,0,0));	
		?>
        
        
        </b><br/> Task should be completed by: <b>
        
        <?php	
			 echo date('M d',strtotime(date("Y-m-d", strtotime($task_detail->task_post_date)) . " +".$task_detail->task_end_day."days")).',&nbsp;';		
		echo date('h A',mktime(0,$task_detail->task_end_time,0,0,0,0));	
		?>
        
        
        
        </b></div>

  		<div id="refresbg" >This Task 
        
          <?php if($task_detail->task_repeat==1) { ?>
               <b> repeats every <?php echo $task_detail->task_repeat_week; ?> weeks</b>
                <?php } else { ?>
               <b>does not repeat</b>
                <?php } ?>
                
                
                
        </div>
    </div>  
    <div class="marTB5">
        <h4 class="fs13">Description:</h4>
        <p><?php  
		
		$task_description= $task_detail->task_description;		
		$task_description=str_replace('KSYDOU','"',$task_description);
		 $task_description=str_replace('KSYSING',"'",$task_description);
		
		echo $task_description;
		 ?></p>
    </div> 
  
<br />

    <div class="marTB5">
    	
                      
            <h4 class="fs13">Location:</h4><br />

            
            <?php 
			if($task_location)
			{
				foreach($task_location as $loc) 
				{
					
					
					
					if($loc->user_location_id>0)
					{
						
						$get_user_location=$this->user_model->get_user_location_detail($loc->user_location_id);
						
						if($get_user_location) 
						{
							echo '<div class="fl" style="width:275px;">';
							
							$loc_full='';
							
							echo '<p>';
							if($get_user_location->location_name!='') { echo $get_user_location->location_name; }
							echo '</p>';
							
							echo '<p>';
							if($get_user_location->location_address!='') { $loc_full.=$get_user_location->location_address.','; }
	
						 //  if($get_user_location->location_city!='') { $loc_full.=$get_user_location->location_city.','; }
						   
							//if($get_user_location->location_state!='') { $loc_full.=$get_user_location->location_state.','; }
							
							 if($get_user_location->location_zipcode!='') { $loc_full.=$get_user_location->location_zipcode; }
							 
							 echo $loc_full.'</p><p>&nbsp;</p>';
							
							echo '</div>';
							
							 echo '<div class="fr">
        
       

        
         <iframe width="350" height="150" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?key='.GOOGLE_MAP_KEY.'&output=embed&q='.urlencode(utf8_encode($loc_full)).'"></iframe>';     
         
        	  
        echo '<br />      
        </div>
        <div class="clear"></div>';
		
							
						}
						
						
					}
					else
					{
						
						echo '<div class="fl" style="width:275px;">';
							
						$loc_full='';
							
						echo '<p>';
						if($loc->location_name!='') { echo $loc->location_name; }
						echo '</p>';
						
						echo '<p>';
						if($loc->location_address!='') { $loc_full.=$loc->location_address.','; }

					  // if($loc->location_city!='') { $loc_full.=$loc->location_city.','; }
					   
						//if($loc->location_state!='') { $loc_full.=$loc->location_state.','; }
						
						 if($loc->location_zip!='') { $loc_full.=$loc->location_zip; }
						 
						 echo $loc_full.'</p><p>&nbsp;</p>';
						 
						 echo '</div>';
							
							 echo '<div class="fr">
        
       

        
         <iframe width="350" height="150" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?key='.GOOGLE_MAP_KEY.'&output=embed&q='.urlencode(utf8_encode($loc_full)).'"></iframe>';     
         
        	  
        echo '<br />      
        </div>
        <div class="clear"></div>';
		
		
						 
					}
					
					
					
				
				}
				
			}
			?>
            
            <table width="100%" border="0" cellspacing="1" cellpadding="3" style="padding-top:10px;">
             <tbody><tr><td align="center">
			 <input type="submit" value="Post Task" class="submbg2 chbg" name="sub_step2 ">
               </td></tr>
  <tr><td>
			<!--<p>You can review your Task and make changes before Posting. </p>-->
    </td></tr>
</tbody></table>
            
            
            
            
            
            
            
      
      
    </div> 
    
</div>





			</div>                
		</div>
        <div class="dbright-task">
         <?php 
		
		 echo $this->load->view($theme.'/layout/task/step_pay_side_bar',$data); ?>  
         </div>
        <div class="clear"></div>

</form>

    </div>
</div>



</section>