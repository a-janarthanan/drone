<div class="banner-contain" id="acc-banners-ph"></div>
<div>
	<div>
	
     <div class="red-subtitle top-red-subtitle" style="margin:0px 0 0 0">Avsluta och betygsätt</div>
    	<div class="profile_back">
        <div class="container">
        <div class="db-rightinfo db-rightinfo-inner" style="width:100%; margin:0px 0 0 0">
        <div class="home-signpost-content"> 
    	<div class="dbleft dbleft-main">
    	
                
  <?php //echo '<pre>'; print_r($taskdetail);?>        


<?php if($error!='') {  ?><div id="error">
					<ul>
					<?php  echo $error; ?>
					</ul>
				</div> <?php } ?>


<?php 
	$attributes = array('name'=>'frm_complete','class'=>'fdesign');
	echo form_open('user_task/complete/'.$task_id,$attributes);
?>  
    <ul class="padli10">
    	<li>
        	<div class="abct3">    
                <?php 
				
				
				$user_detail=$this->user_model->get_user_profile_by_id($taskdetail->user_id);
				$user_image= base_url().'upload/no_image.png';
				 
				 if($user_detail->profile_image!='') {  
			
					if(file_exists(base_path().'upload/user/'.$user_detail->profile_image)) {
				
						$user_image=base_url().'upload/user/'.$user_detail->profile_image;
						
					}
					
				}
				
				echo anchor('tasks/'.$taskdetail->task_url_name,'<img src="'.$user_image.'" alt="" width="50" height="50" class="round-corner" />');?>
	        </div>
        	
            <div class="catle3n"> 
                <?php echo anchor('tasks/'.$taskdetail->task_url_name,ucfirst($taskdetail->task_name),' class="fpass fs22"'); ?>      
                <p class="colmark marT5 fs15">
                	<?php   $task_description= $taskdetail->task_description;		
							$task_description=str_replace('KSYDOU','"',$task_description);
							$task_description=str_replace('KSYSING',"'",$task_description);
		
							$strlen = strlen($task_description);
							if($strlen > 50) { echo substr($task_description,0,80).' ...';}
							else { echo $task_description; } 	                                   
                    ?>
                </p>
            </div> 
            <div class="clear"></div>
        </li>
        <li style="padding-bottom:10px;">
				<table>
                <tr>
                	<td valign="middle" width="100">
						<?php 
                            $asssign_user = $this->worker_model->get_worker_info($taskdetail->task_worker_id);
                            
                            $user_image2= base_url().'upload/no_image.png';
                         
                         if($asssign_user->profile_image!='') {  
                    
                            if(file_exists(base_path().'upload/user/'.$asssign_user->profile_image)) {
                        
                                $user_image2=base_url().'upload/user/'.$asssign_user->profile_image;
                                
                            }
                            
                        }
                        ?>
                        <b style="padding-right:3px;" class="fs14">Tilldelad : </b>
                    </td>
                    <td valign="top"><?php echo anchor('user/'.$asssign_user->profile_name,'<img src="'.$user_image2.'" alt="" width="50" height="50" class="round-corner" />'); ?></td>
                    <td valign="middle" style="padding-left:5px;"><?php echo anchor('user/'.$asssign_user->profile_name,$asssign_user->first_name.' '.substr($asssign_user->last_name,0,1),'class="fpass"'); ?>
                	</td>
                </tr>
                <tr>
                	<td style="padding-top:5px;"><b class="fs14">Datum : </b></td>
                    <td style="padding-top:5px;" colspan="2"><span class="geo geo-2" style="font-size:14px !important; color:#444 !important;"><?php echo date($site_setting->date_time_format,strtotime($taskdetail->task_assigned_date)); ?></span></td>
                </tr>
                <tr>
                	<td style="padding-top:5px;"><b class="fs14">Avslutad : </b> </td>
                    <td style="padding-top:10px;" colspan="2">
                      <label>
                        <input type="radio" name="complete" value="1" id="complete" checked="checked" onclick="return dispute(1);"/>
                        Ja</label>
                     
                      <label>
                        <input type="radio" name="complete" value="2" id="complete" onclick="return dispute(2);"/>
                        Nej</label>
	                     <a href="javascript:void();" id="dispute" class="questions2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
                     
                     
						 <?php 
                            if($taskdetail->worker_agree == 1 && $taskdetail->poster_agree ==0 ) {
                                echo anchor('dispute/dispute_task/'.$taskdetail->task_id,'Dispute Job','class="fpass chbg" style="margin-left:200px; display:none;width:150px;" id="linkdispute"'); 					
                            }
                        ?>
                    </td>
                </tr>
                </table>
                
        </li>
<script type="text/javascript">
$(document).ready(function(){
	jQuery('#dispute').click(function (){
		jQuery('#dialog-form-dispute').fadeIn("fast");
		jQuery('.wrap').show();
	});
	jQuery('#closedispute').click(function (){
		jQuery('#dialog-form-dispute').fadeOut("fast");
		jQuery('.wrap').hide();	
	});
});	


function dispute(ID) {

	if(ID == 2){ 
		document.getElementById("linkdispute").style.display = "block";
		document.getElementById("rate").style.display = "none";
		
	}else { 
		document.getElementById("linkdispute").style.display = "none";
		document.getElementById("rate").style.display = "block";
	}
}

</script>
        <span id="rate" style="padding-top:3px;">
    	<li>
         <!--<div id="dialog-form-dispute" style="padding-bottom:5px;">
                    <a href="javascript:void();" class="fr" id="closedispute" title="close" ><div class="closebg" ></div></a><div class="clear"></div>
                    <p class="padTB3 fs13">If "No" then job will be disputed. Admin will decide later.</p>
                </div>-->
        	<b class="fl marR5 fs14" style="width:100px;">Betygsätt :  </b>
           <!-- <div class="strmn"><div style="width: 30%;" class="str_sel"></div></div>-->
            
            <select name="comment_rate" id="comment_rate"> 
                <option value="1" <?php if($comment_rate==1) { ?> selected="selected" <?php } ?>>1 - Dålig</option>
                <option value="2" <?php if($comment_rate==2) { ?> selected="selected" <?php } ?>>2 - Godkänd</option>
                <option value="3" <?php if($comment_rate==3) { ?> selected="selected" <?php } ?>>3 - Helt ok</option>
                <option value="4" <?php if($comment_rate==4) { ?> selected="selected" <?php } ?>>4 - Bra</option>                
                <option value="5" <?php if($comment_rate==5) { ?> selected="selected" <?php } ?>>5 - Utmärkt</option>
            </select>
                            
            <div class="clear"></div>
        </li>
    	<li>
         	<label class="lab1" style="margin:0px; width:100px;	"><b class="fs14">Feedback :</b></label>
            <textarea name="comment" class="text-ar text-ar-480" cols="75" rows="5"></textarea>
          
		</li>
    
        	<input type="hidden" id="task_id" name="task_id"  value="<?php echo $taskdetail->task_id;?>" />
            <input type="hidden" id="worker_id" name="worker_id"  value="<?php echo $taskdetail->task_worker_id;?>"  />
        	
           <!--	<input type="submit" id="sub_task" name="sub_task" class="chbg fl marT5" value="Submit">-->
        	<input type="submit" id="sub_task" name="sub_task" class="btn btn-default" value="Stäng & Avsluta" style="margin-left: 100px;">
          </span>
            <div class="clear"></div>
			
        
        </ul>

</form>
    
           
     

		</div>
        </div>
        <div class="dbright-task dbright-task-main">
         <?php echo $this->load->view($theme.'/layout/user/user_sidebar'); ?>
         </div>
           <div class="clear"></div>     
        </div>
        <div class="clear"></div>     
</div>
<div class="clear"></div>     
</div>
</div>

           
          	