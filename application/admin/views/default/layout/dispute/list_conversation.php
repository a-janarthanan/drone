<script type="text/javascript">
function askfee(u)
{
    //alert(u);
   if(u == 'pay_full')
   {
		document.getElementById("pay_full").style.display="block";
		document.getElementById("pay_partial").style.display="none";
		document.getElementById("resume").style.display="none";
		document.getElementById("payadmin").style.display="none";
		document.getElementById("taskernote").style.display="block";
		
   }
   else if(u == 'pay_partial')
   {
   		document.getElementById("pay_full").style.display="none";
   		document.getElementById("pay_partial").style.display="block";
		document.getElementById("resume").style.display="none";
		document.getElementById("payadmin").style.display="block";
		document.getElementById("taskernote").style.display="block";
   }
   else if(u == 'resume')
   {
   		document.getElementById("pay_full").style.display="none";
   		document.getElementById("pay_partial").style.display="none";
		document.getElementById("resume").style.display="block";
		document.getElementById("payadmin").style.display="none";
		document.getElementById("taskernote").style.display="none";
   }
   else
   {
	   document.getElementById("pay_full").style.display="none";
	   document.getElementById("pay_partial").style.display="none";
	   document.getElementById("resume").style.display="none";
	   document.getElementById("payadmin").style.display="none";
	   document.getElementById("taskernote").style.display="none";
   }
}

function adminfee(u,id)
{
	if(u == 'payadmin' && id == 1){
		document.getElementById("payadmin").style.display="block";
		document.getElementById("taskernote").style.display="none";
	}
	if(u == 'taskernote' && id == 1){
		document.getElementById("payadmin").style.display="none";
	 	document.getElementById("taskernote").style.display="block";
	}
	
}

function check(amount){

	var asker_amount= document.getElementById("asker_amount").value;
	var tasker_amount= document.getElementById("tasker_amount").value;
	
	var radioButtons = document.getElementsByName("win_option");
      for (var x = 0; x < radioButtons.length; x ++) {
        if (radioButtons[x].checked) {
         var win_option = radioButtons[x].value;
        }
      }
	
	
	
	if(asker_amount != '' && asker_amount!= ''){
	
	var total_amount = eval(asker_amount) + eval(tasker_amount);
		
		if(total_amount <= amount){
			return true;
		} else {
			alert('Partial amount total not more than final price.');
			return false;
		}
	} else {
		if(win_option == 'partial_payment'){
			if(asker_amount == ''){ alert("please enter amount of Poster."); }
			if(tasker_amount == ''){ alert("please enter amount of Runner."); }
			return false;
		} else {
			return true;
		}
	}
	return false;
	
}
</script>

<div id="content"> 

	<?php 
		if($error != ""){ 
        	echo '<div class="column full"><span class="message information"><strong>'.$error.'</strong></span></div>';
    	} 
	?>       
	
	<div class="clear"></div>
	<div class="column full">
	
	<div class="box">		
		<!--<div class="box themed_box">-->
		<h2 class="box-header">Dispute Conversation Between 
		
		<?php if($result['0']->dispute_status==2 && $result['0']->win_user_id>0 && $result['0']->dispute_win_type==1) { ?> 
        :: <span style="color:#009900;">Win By :</span> <?php echo get_user_name($result['0']->win_user_id);?> (Full Payment)
		<?php } ?>
        
        
          
          
           <?php  if($result['0']->dispute_status==2 && $result['0']->win_user_id==0 && $result['0']->dispute_win_type==2) {  ?>  :: <span style="color:#009900;">Partial Payment</span> <?php }  ?>
        
        
           <?php if($result['0']->dispute_status==3 && $result['0']->win_user_id==0 && $result['0']->dispute_win_type==3) { ?> :: <span style="color:#009900;">Task Resumed</span> <?php } ?>
        
         
        
        </h2>
			
			<div class="box-content box-table">
			<table class="tablebox">
            <thead class="table-header">
            
					<tr>
                        <th colspan="3" style="text-align:left; padding-left:10px;">
                    
                         <table width="100%">
                             <tr>
                                 <th>Task Name : <?php echo anchor(front_base_url().'tasks/'.$task_details->task_url_name,ucfirst($task_details->task_name),' style="color:#004C7A;" target="_blank"'); ?></th>
                            
                                 <th>Poster Name :  <?php echo get_user_name($task_details->user_id);?>
                                </th>
                            
                                <th>Runner Name : 
                                    <?php  
                                            if($task_details->task_worker_id != 0) { 
                                                $worker = $this->worker_model->view_worker_result($task_details->task_worker_id);

													echo anchor(front_base_url().'user/'.$worker->profile_name,ucfirst($worker->first_name).' '.ucfirst(substr($worker->last_name,0,1)),' style="color:#004C7A;" target="_blank"');
                                             
                                                 
                                                }
                                            ?> 
                                    </th>
                                    <th> Dispute Rise By : <?php echo get_user_name($result['0']->comment_post_user_id);?> </th>
                                    <th> Final Price :  <span style="color:#FF0000;"><?php echo $site_setting->currency_symbol.$this->dispute_model->offer_price($task_details->task_worker_id,$task_details->task_id);?></span></th>
                                </tr>
                            </table>
                        </th>
                    </tr>
				</thead>	
                
                <tr><th colspan="3"><hr/></th></tr>
                
                <thead class="table-header">
					<tr> 
                        <th class="first tc" width="180">Posted By </th>   
                        <th>Comment</th>
                                                        
					</tr>
			
				</thead>
                
                
				<tbody class="openable-tbody">
				<?php
                    if($result)
                    {
                        $i=0;
                        foreach($result as $row)
                        {
						
                            if($i%2=="0")
                            {
                                $cl = "odd";	
                            }else{	
                                $cl = "even";	
                       		}
							
								 $user_name='';
								 $assign_user_name='';
								 $task_id='';
								 $assign_user_id='';
								 
								$user = $this->user_model->get_one_user($row->task_user_id);  
								$assign_user = $this->user_model->get_one_user($row->task_assign_user_id); 
								
								
								$user_name = ucfirst($user->first_name).' '.ucfirst(substr($user->last_name,0,1));
								$assign_user_name = ucfirst($assign_user->first_name).' '.ucfirst(substr($assign_user->last_name,0,1));
								$task_id = $row->task_id;
								$user_id =$row->task_user_id;
								$assign_user_id = $row->task_assign_user_id;
                  ?>
					<tr class="<?php echo $cl; ?>">    
                        <td class="tc"><?php echo get_user_name($row->comment_post_user_id);?></td>
                        
                        <td style="text-align:left; padding:10px; text-align:justify;"><?php echo $row->dispute_comment;?>
						
						<p><i style="color:#999999;"><?php echo date($site_setting->date_time_format,strtotime($row->dispute_comment_date)); ?></i></p>
                        
                        </td>
                  	</tr>
				  <?php
                            $i++;
                        }
                    }
                  ?>	
                 
                        
				</tbody>
			</table>
            <hr/>
            <?php
			
			if($result['0']->dispute_status!=3 && $result['0']->dispute_status!=2) { 
			
				$attributes = array('name'=>'frm_dispute_win');
				echo form_open_multipart('dispute/dispute_win/'.$task_id,$attributes);
			?>
             
                <label class="form-label" style="padding:10px 0 0 10px;">Payment Options</label>
                <div class="radiocheck" style="padding:0 10px 10px 10px;" >
                    <input id="radio1" type="radio" value="full_payment" name="win_option" onclick="askfee('<?php echo 'pay_full';?>');"/><label for="radio1">Make 100% Payment</label>
                     <input id="radio2" type="radio" value="partial_payment" name="win_option" onclick="askfee('<?php echo 'pay_partial';?>');"/><label for="radio2">Make Partial Payment</label>
                     <input id="radio3" type="radio" value="resume" name="win_option" onclick="askfee('<?php echo 'resume';?>');"/><label for="radio3">Resume Task</label>  
                </div>
            
            
            
                  <span id="pay_full" style="display:none; padding:15px 10px 10px 50px;" class="radiocheck">
                        <input id="radio4" type="radio" value="<?php echo $user_id; ?>" name="user_id"  onclick="adminfee('payadmin','1');"/><label for="radio4"><?php echo 'To '.$user_name;?></label>
                        &nbsp;OR
                        <input id="radio5" type="radio" value="<?php echo $assign_user_id; ?>" name="user_id" onclick="adminfee('taskernote','1');" checked="checked" onclick="adminfee('payadmin','0');"/><label for="radio5"><?php echo 'To '.$assign_user_name;?></label></label>        
                  </span>
                  
    
    
                  <span id="pay_partial" style="display:none; padding:15px 10px 10px 50px;">
                         <p><strong> Task Final Price : 
						 <?php 
						 	$final_price = $this->dispute_model->offer_price($task_details->task_worker_id,$task_id);
						 	echo $site_setting->currency_symbol.$final_price; 
						 ?> </strong></p>
                         <strong><?php echo 'To '.$user_name;?></strong> 
                         <?php echo $site_setting->currency_symbol;?> <input id="asker_amount" type="text" name="asker_amount" value="" class="form-field width10"/>&nbsp;&nbsp;AND&nbsp;&nbsp;
                        
                         <strong><?php echo 'To '.$assign_user_name;?></strong>
                         <?php echo $site_setting->currency_symbol;?> <input id="tasker_amount" type="text" name="tasker_amount" value="" class="form-field width10"/>
                  </span>
                  
                  
                  
                  
                  <span id="resume" style="display:none; padding:15px 10px 10px 50px;">
                         <strong>Use this option if Poster and Runner both happy to resume task.</strong>             
                  </span>
                  
                  
                  
                  <span id="payadmin" style="display:none; padding:5px 10px 10px 50px;" class="radiocheck">
                        <strong  style="float:left;">Deduct Admin Refund Fees From Poster?</strong>&nbsp;&nbsp;&nbsp;
                        <?php echo anchor('task_setting/add_task_setting','<img src="'.front_base_url().'default/images/ques.png" style="float:left;margin: -24px;"/>','style="border:0px;height:0px;" '); ?>

                        <input id="radio6" type="radio" value="yes" name="cutfee" checked="checked"/><label for="radio6">YES</label>
                        <input id="radio7" type="radio" value="no" name="cutfee"/><label for="radio7">NO</label>        
                  </span>
                  <div style="clear:both;"></div>
                  
                  <span id="taskernote" style="display:none; padding:5px 10px 10px 50px;" class="radiocheck">
                        <strong>Note : </strong>Runner will be automatically deducted Admin fee.&nbsp; <?php echo anchor('task_setting/add_task_setting','<img src="'.front_base_url().'default/images/ques.png" style="float:left;margin: -18px;"/>','style="border:0px;height:0px;" '); ?>
                  </span>
                  
                  
                <input type="hidden" name="task_id" value="<?php echo $task_id;?>" class="button themed" id="task_id">
                <input type="hidden" name="task_user_id" value="<?php echo $user_id;?>" class="button themed" id="task_user_id">
                <input type="hidden" name="worker_user_id" value="<?php echo $assign_user_id;?>" class="button themed" id="worker_user_id">
                &nbsp;&nbsp;&nbsp;<input type="submit" name="Submit" value="Submit" class="button themed" id="Submit" onclick="return check('<?php echo $final_price; ?>');" style="margin-top:10px;">
            <form> 
            
            <?php } ?>
            
            
            <ul class="pagination">
					<?php echo $page_link; ?>
                </ul>
		
		</div>
	</div>
</div>