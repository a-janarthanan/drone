
		
				
			<?php 
			
			if($tasklists) {
				
				
				foreach($tasklists as $tasklist){
				

				$user_detail=$this->user_model->get_user_profile_by_id($tasklist->user_id);
				
				$user_image= base_url().'upload/no_image.png';
				 
				 if($user_detail->profile_image!='') {  
			
					if(file_exists(base_path().'upload/user/'.$user_detail->profile_image)) {
				
						$user_image=base_url().'upload/user/'.$user_detail->profile_image;
						
					}
					
				}
						
						
						
				
				$taskid = $tasklist->task_id;
				$task_worker_id=$tasklist->task_worker_id;
				$userid = $tasklist->user_id;
				
				$task_start_date= date('l, M d',strtotime(date("Y-m-d", strtotime($tasklist->task_post_date)) . " +".$tasklist->task_start_day."days")).', '.date('h A',mktime(0,$tasklist->task_start_time,0,0,0,0));	
				
				
				
				$task_url_name = $tasklist->task_url_name;
				$task_activity_status=$tasklist->task_activity_status;
				
				$poster_agree=$tasklist->poster_agree;
				$worker_agree=$tasklist->worker_agree;
				
				
				
		
			
				
				
				
				$worker_name='';
				
				if($task_worker_id>0 && $task_activity_status>0) 
				{
				
					$worker_detail=$this->worker_model->get_worker_info($task_worker_id);
					
					if($worker_detail)
					{
						$worker_name=ucfirst($worker_detail->first_name).' '.ucfirst(substr($worker_detail->last_name,0,1)).'.';
					}
				
				}
				?>
				<li id="lipanel">
				<div id="panel">
				<div id="leftPane1">
					<img class="marT5" src="<?php echo $user_image; ?>" width="50" height="50" border="0">
				</div>
				<div id="rightPane1">
				<a href="<?php echo base_url().getThemeName();?>/tasks/<?php echo $task_url_name;?>">
				<?php echo $task_url_name;?>
				</a>

				<br>
				<p class="colblack fl wid190">
				posted by <b><?php echo ucfirst($user_detail->first_name).' '.ucfirst(substr($user_detail->last_name,0,1)).'.'; ?></b> and<br>needs to be assigned by
				</p>
				<p class="marT5 ita colgrey"><?php echo $task_start_date; ?></p>
				<div class="clear"></div>
				</div><div class="clear"></div>
				</div>
				</li>
				
				
				
			
			
		<?php			
			
			}
			}
			?>
			
				