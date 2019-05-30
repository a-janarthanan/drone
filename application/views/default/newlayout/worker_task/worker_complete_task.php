<div>
	<div>
	<div class="page-title mbot20">
		<h1 class="mleft15">Complete Task</h1>
	</div>
    	<div class="mconleft" style="margin:0 0 0 15px;">
                
  <?php //echo '<pre>'; print_r($taskdetail);?>        

           


<?php if($error!='') {  ?><div id="error">
					<ul>
					<?php  echo $error; ?>
					</ul>
				</div> <?php } ?>

<?php 
	$attributes = array('name'=>'frm_complete','class'=>'fdesign');
	echo form_open('worker_task/complete/'.$task_id,$attributes);
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
				
				
				
				echo anchor('tasks/'.$taskdetail->task_url_name,'<img src="'.$user_image.'" alt="" width="50" height="50" />');?>
	        </div>
        	
            <div class="catle3n"> 
                <?php echo anchor('tasks/'.$taskdetail->task_url_name,ucfirst($taskdetail->task_name),' class="fpass fs13"'); ?>      
                <p class="colmark marT5">
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
        <li>
				<table>
                <tr><td valign="middle">
                <?php 
					$asssign_user = $this->worker_model->get_worker_info($taskdetail->task_worker_id);
					
				$user_image2= base_url().'upload/no_image.png';
				 
				 if($asssign_user->profile_image!='') {  
			
					if(file_exists(base_path().'upload/user/'.$asssign_user->profile_image)) {
				
						$user_image2=base_url().'upload/user/'.$asssign_user->profile_image;
						
					}
					
				}
				
				
				?>
                
	            <b>Assigned To:</b></td>
                <td valign="top"><?php echo anchor('user/'.$asssign_user->profile_name,'<img src="'.$user_image2.'" alt="" width="50" height="50" />'); ?></td>
                <td valign="middle"><?php echo anchor('user/'.$asssign_user->profile_name,$asssign_user->first_name.' '.substr($asssign_user->last_name,0,1),'class="fpass"'); ?>
                </td></tr></table>
                
                
    	        <p><b>Assigned :</b> <span class="geo"><?php echo date($site_setting->date_time_format,strtotime($taskdetail->task_assigned_date)); ?></span></p>
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
	}else { 
		document.getElementById("linkdispute").style.display = "none";
	}
}
</script>
        <li class="posrel">
				<p><b>Complete :</b> 
				  <label>
				    <input type="radio" name="complete" value="1" id="complete" checked="checked" onclick="return dispute(1);" />
				    Yes</label>
				 
				  <label>
				    <input type="radio" name="complete" value="2" id="complete" onclick="return dispute(2);"/>
				    No</label>
				 <a href="javascript:void();" id="dispute" class="questions2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
                 
                 <?php 
					if($taskdetail->worker_agree == 0 && $taskdetail->poster_agree ==0 ) {
						echo anchor('dispute/dispute_task/'.$taskdetail->task_id,'Dispute Link','class="fpass" style="padding-left:200px; display:none;" id="linkdispute"'); 					
					}
				?>
                
				</p>

                <div id="dialog-form-dispute">
                    <a href="javascript:void();" class="fr" id="closedispute" title="close" ><div class="closebg" ></div></a><div class="clear"></div>
                    <p class="padTB3">If "No" then task will be disputed. Admin will decide later.</p>
                </div>
                
                
        </li>
    	<?php /*?><li>
        	<b class="fl marR5">Worker bee's Rate:</b>
            
             <select name="comment_rate" id="comment_rate"> 
                <option value="1" <?php if($comment_rate==1) { ?> selected="selected" <?php } ?>>1 - Poor</option>
                <option value="2" <?php if($comment_rate==2) { ?> selected="selected" <?php } ?>>2 - Fair</option>
                <option value="3" <?php if($comment_rate==3) { ?> selected="selected" <?php } ?>>3 - Average</option>
                <option value="4" <?php if($comment_rate==4) { ?> selected="selected" <?php } ?>>4 - Very Good</option>                
                <option value="5" <?php if($comment_rate==5) { ?> selected="selected" <?php } ?>>5 - Excellent</option>
            </select>
                                                
                                                
                                                
          <!--  <div class="strmn"><div style="width: 30%;" class="str_sel"></div></div>-->
          
          
            <div class="clear"></div>
        </li><?php */?>
    	<li>
         	<label class="lab1">Feed back</label><br/>
            <textarea name="comment" cols="75" rows="5"></textarea>
          
		</li>
    
        	<input type="hidden" id="task_id" name="task_id"  value="<?php echo $taskdetail->task_id;?>" />
            <input type="hidden" id="worker_id" name="worker_id"  value="<?php echo $taskdetail->task_worker_id;?>"  />
        	
           	<input type="submit" id="sub_task" name="sub_task" class="chbg fr" value="Submit">

            <div class="clear"></div>
			
        
        </ul>

</form>
    
           
     

		</div>


 <?php echo $this->load->view($theme.'/layout/user/user_sidebar'); ?>
   <div class="clear"></div>     
</div>
</div>

           
          	
