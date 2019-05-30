<div class="mconright">
            <div class="marB20">
                <div class="estim marB5">Task Actions</div>
                <ul class="accr">
                    <li><?php $login_worker_id=0;
		    $check_worker_detail=$this->worker_model->check_user_worker_detail(get_authenticateUserID());
			
			if($check_worker_detail) {  $login_worker_id=$check_worker_detail->worker_id; }
			
		   if($task_detail->task_is_private==0 || $task_detail->user_id==get_authenticateUserID() || $task_detail->task_worker_id==$login_worker_id) {  
		   
		   				if($comments) {
						
						echo anchor('tasks/'.$task_detail->task_url_name.'/comments','See conversations','class="b-button"');  } }   ?></li>
                     <li><?php //echo anchor('tasks/'.$task_detail->task_url_name.'/see_activity','See history'); ?></li>
                 
                 
                       <li><?php if(!check_user_authentication()) {  echo anchor('sign_up','Copy Task',' id="newcopytask"','class="b-button"'); } else { echo anchor('task/update_task_step_zero/'.$task_detail->task_id.'/copy','Copy Task',' id="newcopytask"','class="b-button"');?>
                      <script type="text/javascript">
								jQuery(document).ready(function() {	
									jQuery("#newcopytask").fancybox();	
								});
					  </script>
                      
                      <?php } ?>
                      </li>
                      
                </ul>
            </div>
</div>