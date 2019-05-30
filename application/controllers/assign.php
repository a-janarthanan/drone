<?php
class Assign extends ROCKERS_Controller {
	
	/*
	Function name :Assign()
	Description :Its Default Constuctor which called when assign object initialzie.its load necesary models
	*/
	
	function Assign()
	{
		parent::__construct();	
		$this->load->model('task_model');
		$this->load->model('worker_model');	
		$this->load->model('user_model');	
		$this->load->model('assign_model');	
	}
	
	/*
	Function name :index()
	Parameter : none
	Return : none
	Use : assign task automatically(using cron job)
	Description :its default function of assign task automatically(using cron job) which called http://hostname/assign	
	*/
	
	function index()
	{
		
		///===get the task which are active(task_active=1) and task are in posted status(task_activitity_status=0) 
		$get_task=$this->assign_model->get_task();
		
		
		if($get_task)
		{
			
			foreach($get_task as $task)
			{
				 $task_id=$task->task_id;
				
				$task_post_date=$task->task_post_date;
				
				$task_start_day=$task->task_start_day;
				$task_start_time=$task->task_start_time;
				
				$task_start_date=date('Y-m-d',strtotime(date("Y-m-d", strtotime($task_post_date)) . " +".$task_start_day."days"));				
				$task_start_hour=date('H',mktime(0,$task_start_time,0,0,0,0));	
				
			
				$task_end_day=$task->task_end_day;
				$task_end_time=$task->task_end_time;				
				
				$task_end_date=date('Y-m-d',strtotime(date("Y-m-d", strtotime($task_post_date)) . " +".$task_end_day."days"));				
				$task_end_hour=date('H',mktime(0,$task_end_time,0,0,0,0));	
				
				
				//===and check task start time is not past
				//echo date('Y-m-d-H')."====".$task_start_date.'-'.$task_start_hour.'==='.$task_id.'<br/>';
				
				
				
				/////===set time zone for task assign==========
				
				
				$task_timezone_date=date('Y-m-d-H');
		
				$city_detail=get_cityDetail($task->task_city_id);
				
				if($city_detail)
				{	
					$dateTime = new DateTime("now", new DateTimeZone('America/Los_Angeles'));	 
					$task_timezone=tzOffsetToName($city_detail->city_timezone);			
					$dateTimeZone = new DateTimeZone($task_timezone);
					$dateTime->setTimezone($dateTimeZone); 
					$task_timezone_date= $dateTime->format("Y-m-d-H");
					
				}
		
				
				
				
				
				/*****===for auto assign 
				* if task auto assignment is 1 and task is start_date is match with current date time
				* and if no one assign then system automatically assign task to the best offer worker
				* if no offer on this task then close the task
				* for this user can not see ant offer on his dashboard
				**/
				
				
				if((strtotime($task_timezone_date)==strtotime($task_start_date.'-'.$task_start_hour)) && $task->task_auto_assignment==1  && ($task->task_worker_id=='' || $task->task_worker_id==0))
				{
						
					
						
						$get_worker_bid=$this->assign_model->get_worker_bid($task_id);
						
						$worker_offer=array();						
						$lower_offer=array();
						
						$user_id=0;
						
						
						if($get_worker_bid)
						{
						
							foreach($get_worker_bid as $offer)
							{
								$worker_offer[$offer->comment_post_user_id]=$offer->offer_amount;
							}
							
						///	echo '<pre>';
						///	print_r($worker_offer);
							///====get minimum amount 
							$min_offer_amount = min($worker_offer);
							
							
							///===check for more than one same lower amount
							foreach($worker_offer as $user_id=>$offer_price)
							{
								if($offer_price==$min_offer_amount)
								{
									$lower_offer[$user_id]=$min_offer_amount;
								}
							}
							
							///===if have more than one assign to FIFO
							if($lower_offer)
							{
								
								foreach($lower_offer as $userid=>$lower)
								{
									$user_id=$userid;
									break;
								}								
									
							}
							
							if($user_id>0)
							{
								 $this->assign_model->assign_task_worker($task_id,$user_id);
								 
								 $notification = notification_setting($task->user_id);
								$worker_notification = notification_setting($user_id);
								//echo '<pre>'; print_r($notification); print_r($worker_notification); die();
								
								$user_detail = $this->user_model->get_user_info($task->user_id);
			   					$worker_detail = $this->user_model->get_user_info($user_id);
								//echo '<pre>'; print_r($user_detail); print_r($worker_detail); die();
			   
								$worker_link ='<a href="'.base_url().'user/'.$worker_detail->profile_name.'">'.ucfirst($worker_detail->full_name).'</a>';
								$task_link ='<a href="'.base_url().'tasks/'.$task->task_url_name.'">'.$task->task_name.'</a>';
							
								/////////////============Assign time  to poster start===========
									
								if(isset($notification->on_assign_task)) {  
		
									if($notification->on_assign_task==1) { 
									
										$email_template=$this->db->query("select * from ".$this->db->dbprefix('email_template')." where task='Assign Time (Poster)'");
										$email_temp=$email_template->row();
										
										
										$email_address_from=$email_temp->from_address;
										$email_address_reply=$email_temp->reply_address;
										
										$email_subject=$email_temp->subject;				
										$email_message=$email_temp->message;			
										
														
										$email_to=$user_detail->email;		
				
										
										$email_message=str_replace('{break}','<br/>',$email_message);
										$email_message=str_replace('{poster_name}',ucfirst($user_detail->full_name),$email_message);		
										$email_message=str_replace('{worker_name}',$worker_link,$email_message);		
										$email_message=str_replace('{task_name}',$task_link,$email_message);
										
										$str=$email_message; 
															
										/** custom_helper email function **/
											
										email_send($email_address_from,$email_address_reply,$email_to,$email_subject,$str);
									}
								}
								
								/////////////============Assign time  to poster end===========	
								
								/////////////============Assign time  to worker start===========
									
								if(isset($worker_notification->on_assign_task)) {  
		
									if($worker_notification->on_assign_task==1) { 
									
										$email_template=$this->db->query("select * from ".$this->db->dbprefix('email_template')." where task='Assign Time (Worker)'");
										$email_temp=$email_template->row();
										
										
										$email_address_from=$email_temp->from_address;
										$email_address_reply=$email_temp->reply_address;
										
										$email_subject=$email_temp->subject;				
										$email_message=$email_temp->message;			
										
														
										$email_to=$worker_detail->email;		
									
										$email_message=str_replace('{break}','<br/>',$email_message);	
										$email_message=str_replace('{worker_name}',ucfirst($worker_detail->full_name),$email_message);			
										$email_message=str_replace('{task_name}',$task_link,$email_message);
										
										$str=$email_message;
										
										/** custom_helper email function **/
											
										email_send($email_address_from,$email_address_reply,$email_to,$email_subject,$str);
									}
								}
								
								/////////////============Assign time  to worker end===========
								
								
								
							}
							
							////===if no user bid then close task
							else
							{
								////set expire task
								$this->assign_model->close_task($task_id);
								
								
									/////////////============Close task poster start===========	
							
								$user_detail = $this->user_model->get_user_info($task->user_id);
								$task_link ='<a href="'.base_url().'tasks/'.$task->task_url_name.'">'.$task->task_name.'</a>';
								$notification = notification_setting($task->user_id);
								
								if(isset($notification->on_expire_task)) {  
				
									 if($notification->on_expire_task==1) {   
									 
										$email_template=$this->db->query("select * from ".$this->db->dbprefix('email_template')." where task='Expire Task (Poster)'");
										$email_temp=$email_template->row();
										
										
										$email_address_from=$email_temp->from_address;
										$email_address_reply=$email_temp->reply_address;
										
										$email_subject=$email_temp->subject;				
										$email_message=$email_temp->message;			
										
						
										$email_to=$user_detail->email;
											
									
										$email_message=str_replace('{break}','<br/>',$email_message);
										$email_message=str_replace('{poster_name}',$user_detail->full_name,$email_message);				
										$email_message=str_replace('{task_name}',$task_link,$email_message);
										
										
										$str=$email_message; 
															
										/** custom_helper email function **/
											
										email_send($email_address_from,$email_address_reply,$email_to,$email_subject,$str);
									}
								}
								 
								/////////////============Close task poster end===========
								
								/////////////============Close task admin start===========	
					
									$email_template=$this->db->query("select * from ".$this->db->dbprefix('email_template')." where task='Expire Task (Admin)'");
									$email_temp=$email_template->row();
									
									
									$email_address_from=$email_temp->from_address;
									$email_address_reply=$email_temp->reply_address;
									
									$email_subject=$email_temp->subject;				
									$email_message=$email_temp->message;			
									
					
									$email_to=$email_temp->from_address;
									$poster_link = '<a href="'.base_url().'user/'.$user_detail->profile_name.'">'.ucfirst($user_detail->full_name).'</a>';
												
									$email_message=str_replace('{break}','<br/>',$email_message);
									$email_message=str_replace('{poster_name}',$poster_link,$email_message);				
									$email_message=str_replace('{task_name}',$task_link,$email_message);
									
									
									$str=$email_message;
														
									/** custom_helper email function **/
										
									email_send($email_address_from,$email_address_reply,$email_to,$email_subject,$str);
										
								/////////////============Close task admin end===========
								
								
							}
							
						}
						
						/////===if no bid then close the task
						else
						{
							////set expire task
							$this->assign_model->close_task($task_id);
							
							
										/////////////============Close task poster start===========	
							
								$user_detail = $this->user_model->get_user_info($task->user_id);
								$task_link ='<a href="'.base_url().'tasks/'.$task->task_url_name.'">'.$task->task_name.'</a>';
								$notification = notification_setting($task->user_id);
								
								if(isset($notification->on_expire_task)) {  
				
									 if($notification->on_expire_task==1) {   
									 
										$email_template=$this->db->query("select * from ".$this->db->dbprefix('email_template')." where task='Expire Task (Poster)'");
										$email_temp=$email_template->row();
										
										
										$email_address_from=$email_temp->from_address;
										$email_address_reply=$email_temp->reply_address;
										
										$email_subject=$email_temp->subject;				
										$email_message=$email_temp->message;			
										
						
										$email_to=$user_detail->email;
											
									
										$email_message=str_replace('{break}','<br/>',$email_message);
										$email_message=str_replace('{poster_name}',$user_detail->full_name,$email_message);				
										$email_message=str_replace('{task_name}',$task_link,$email_message);
										
										
										$str=$email_message; 
															
										/** custom_helper email function **/
											
										email_send($email_address_from,$email_address_reply,$email_to,$email_subject,$str);
									}
								}
								 
							/////////////============Close task poster end===========
							
							/////////////============Close task admin start===========	
				
								$email_template=$this->db->query("select * from ".$this->db->dbprefix('email_template')." where task='Expire Task (Admin)'");
								$email_temp=$email_template->row();
								
								
								$email_address_from=$email_temp->from_address;
								$email_address_reply=$email_temp->reply_address;
								
								$email_subject=$email_temp->subject;				
								$email_message=$email_temp->message;			
								
				
								$email_to=$email_temp->from_address;
								$poster_link = '<a href="'.base_url().'user/'.$user_detail->profile_name.'">'.ucfirst($user_detail->full_name).'</a>';
											
								$email_message=str_replace('{break}','<br/>',$email_message);
								$email_message=str_replace('{poster_name}',$poster_link,$email_message);				
								$email_message=str_replace('{task_name}',$task_link,$email_message);
								
								
								$str=$email_message;
													
								/** custom_helper email function **/
									
								email_send($email_address_from,$email_address_reply,$email_to,$email_subject,$str);
									
							/////////////============Close task admin end===========
							
							
						}
						
						
				}////===date check condition
				
				
				
				
				
				/*****===for let me review 
				* if task auto assignment is 2 and task is start_date is match with current date time
				* and if no one assign then system automatically assign task to the best offer worker
				* if no offer on this task then close the task
				* task user can select manually to the best offer person
				**/
				
				
				if( (strtotime($task_timezone_date)==strtotime($task_start_date.'-'.$task_start_hour)) && $task->task_auto_assignment==2 && ($task->task_worker_id=='' || $task->task_worker_id==0))
				{
						
						$get_worker_bid=$this->assign_model->get_worker_bid($task_id);
						
						$worker_offer=array();						
						$lower_offer=array();
						
						$user_id=0;
						
						
						if($get_worker_bid)
						{
						
							foreach($get_worker_bid as $offer)
							{
								$worker_offer[$offer->comment_post_user_id]=$offer->offer_amount;
							}
							
						///	echo '<pre>';
						///	print_r($worker_offer);
							///====get minimum amount 
							$min_offer_amount = min($worker_offer);
							
							
							///===check for more than one same lower amount
							foreach($worker_offer as $user_id=>$offer_price)
							{
								if($offer_price==$min_offer_amount)
								{
									$lower_offer[$user_id]=$min_offer_amount;
								}
							}
							
							///===if have more than one assign to FIFO
							if($lower_offer)
							{
								
								foreach($lower_offer as $userid=>$lower)
								{
									$user_id=$userid;
									break;
								}								
									
							}
							
							if($user_id>0)
							{
								 $this->assign_model->assign_task_worker($task_id,$user_id);
								 
								 
								 			 
								$notification = notification_setting($task->user_id);
								$worker_notification = notification_setting($user_id);
								//echo '<pre>'; print_r($notification); print_r($worker_notification); die();
								
								$user_detail = $this->user_model->get_user_info($task->user_id);
			   					$worker_detail = $this->user_model->get_user_info($user_id);
								//echo '<pre>'; print_r($user_detail); print_r($worker_detail); die();
			   
								$worker_link ='<a href="'.base_url().'user/'.$worker_detail->profile_name.'">'.ucfirst($worker_detail->full_name).'</a>';
								$task_link ='<a href="'.base_url().'tasks/'.$task->task_url_name.'">'.$task->task_name.'</a>';
							
								/////////////============Assign time  to poster start===========
									
								if(isset($notification->on_assign_task)) {  
		
									if($notification->on_assign_task==1) { 
									
										$email_template=$this->db->query("select * from ".$this->db->dbprefix('email_template')." where task='Assign Time (Poster)'");
										$email_temp=$email_template->row();
										
										
										$email_address_from=$email_temp->from_address;
										$email_address_reply=$email_temp->reply_address;
										
										$email_subject=$email_temp->subject;				
										$email_message=$email_temp->message;			
										
														
										$email_to=$user_detail->email;		
				
										
										$email_message=str_replace('{break}','<br/>',$email_message);
										$email_message=str_replace('{poster_name}',ucfirst($user_detail->full_name),$email_message);		
										$email_message=str_replace('{worker_name}',$worker_link,$email_message);		
										$email_message=str_replace('{task_name}',$task_link,$email_message);
										
										$str=$email_message; 
															
										/** custom_helper email function **/
											
										email_send($email_address_from,$email_address_reply,$email_to,$email_subject,$str);
									}
								}
								
								/////////////============Assign time  to poster end===========	
								
								/////////////============Assign time  to worker start===========
									
								if(isset($worker_notification->on_assign_task)) {  
		
									if($worker_notification->on_assign_task==1) { 
									
										$email_template=$this->db->query("select * from ".$this->db->dbprefix('email_template')." where task='Assign Time (Worker)'");
										$email_temp=$email_template->row();
										
										
										$email_address_from=$email_temp->from_address;
										$email_address_reply=$email_temp->reply_address;
										
										$email_subject=$email_temp->subject;				
										$email_message=$email_temp->message;			
										
														
										$email_to=$worker_detail->email;		
									
										$email_message=str_replace('{break}','<br/>',$email_message);	
										$email_message=str_replace('{worker_name}',ucfirst($worker_detail->full_name),$email_message);			
										$email_message=str_replace('{task_name}',$task_link,$email_message);
										
										$str=$email_message;
										
										/** custom_helper email function **/
											
										email_send($email_address_from,$email_address_reply,$email_to,$email_subject,$str);
									}
								}
								
								/////////////============Assign time  to worker end===========
								
								
								
							}
							
							////===if no user bid then close task
							else
							{
								////set expire task
								$this->assign_model->close_task($task_id);
								
								
								/////////////============Close task poster start===========	
							
								$user_detail = $this->user_model->get_user_info($task->user_id);
								$task_link ='<a href="'.base_url().'tasks/'.$task->task_url_name.'">'.$task->task_name.'</a>';
								$notification = notification_setting($task->user_id);
								
								if(isset($notification->on_expire_task)) {  
				
									 if($notification->on_expire_task==1) {   
									 
										$email_template=$this->db->query("select * from ".$this->db->dbprefix('email_template')." where task='Expire Task (Poster)'");
										$email_temp=$email_template->row();
										
										
										$email_address_from=$email_temp->from_address;
										$email_address_reply=$email_temp->reply_address;
										
										$email_subject=$email_temp->subject;				
										$email_message=$email_temp->message;			
										
						
										$email_to=$user_detail->email;
											
									
										$email_message=str_replace('{break}','<br/>',$email_message);
										$email_message=str_replace('{poster_name}',$user_detail->full_name,$email_message);				
										$email_message=str_replace('{task_name}',$task_link,$email_message);
										
										
										$str=$email_message; 
															
										/** custom_helper email function **/
											
										email_send($email_address_from,$email_address_reply,$email_to,$email_subject,$str);
									}
								}
								 
								/////////////============Close task poster end===========
								
								/////////////============Close task admin start===========	
					
									$email_template=$this->db->query("select * from ".$this->db->dbprefix('email_template')." where task='Expire Task (Admin)'");
									$email_temp=$email_template->row();
									
									
									$email_address_from=$email_temp->from_address;
									$email_address_reply=$email_temp->reply_address;
									
									$email_subject=$email_temp->subject;				
									$email_message=$email_temp->message;			
									
					
									$email_to=$email_temp->from_address;
									$poster_link = '<a href="'.base_url().'user/'.$user_detail->profile_name.'">'.ucfirst($user_detail->full_name).'</a>';
												
									$email_message=str_replace('{break}','<br/>',$email_message);
									$email_message=str_replace('{poster_name}',$poster_link,$email_message);				
									$email_message=str_replace('{task_name}',$task_link,$email_message);
									
									
									$str=$email_message;
														
									/** custom_helper email function **/
										
									email_send($email_address_from,$email_address_reply,$email_to,$email_subject,$str);
										
								/////////////============Close task admin end===========
								
								
							}
							
						}
						
						/////===if no bid then close the task
						else
						{
							////set expire task
							$this->assign_model->close_task($task_id);
							
							/////////////============Close task poster start===========	
							
								$user_detail = $this->user_model->get_user_info($task->user_id);
								$task_link ='<a href="'.base_url().'tasks/'.$task->task_url_name.'">'.$task->task_name.'</a>';
								$notification = notification_setting($task->user_id);
								
								if(isset($notification->on_expire_task)) {  
				
									 if($notification->on_expire_task==1) {   
									 
										$email_template=$this->db->query("select * from ".$this->db->dbprefix('email_template')." where task='Expire Task (Poster)'");
										$email_temp=$email_template->row();
										
										
										$email_address_from=$email_temp->from_address;
										$email_address_reply=$email_temp->reply_address;
										
										$email_subject=$email_temp->subject;				
										$email_message=$email_temp->message;			
										
						
										$email_to=$user_detail->email;
											
									
										$email_message=str_replace('{break}','<br/>',$email_message);
										$email_message=str_replace('{poster_name}',$user_detail->full_name,$email_message);				
										$email_message=str_replace('{task_name}',$task_link,$email_message);
										
										
										$str=$email_message; 
															
										/** custom_helper email function **/
											
										email_send($email_address_from,$email_address_reply,$email_to,$email_subject,$str);
									}
								}
								 
							/////////////============Close task poster end===========
							
							/////////////============Close task admin start===========	
				
								$email_template=$this->db->query("select * from ".$this->db->dbprefix('email_template')." where task='Expire Task (Admin)'");
								$email_temp=$email_template->row();
								
								
								$email_address_from=$email_temp->from_address;
								$email_address_reply=$email_temp->reply_address;
								
								$email_subject=$email_temp->subject;				
								$email_message=$email_temp->message;			
								
				
								$email_to=$email_temp->from_address;
								$poster_link = '<a href="'.base_url().'user/'.$user_detail->profile_name.'">'.ucfirst($user_detail->full_name).'</a>';
											
								$email_message=str_replace('{break}','<br/>',$email_message);
								$email_message=str_replace('{poster_name}',$poster_link,$email_message);				
								$email_message=str_replace('{task_name}',$task_link,$email_message);
								
								
								$str=$email_message;
													
								/** custom_helper email function **/
									
								email_send($email_address_from,$email_address_reply,$email_to,$email_subject,$str);
									
							/////////////============Close task admin end===========

						}
						
						
				}
				
				
				///====finish let me review part=====
				
				
				
				
			
				
			
			} ///=== foreach  get_task	
			
			/////////// save cron job run time
			$data = array(
						'user_id' => 0,
						'cronjob' => 'assign_task',
						'date_run' =>date('Y-m-d H:i:s'),
						'status' => '1',
					);
			$this->db->insert('cronjob', $data);

			exit;
			
		
		} ///===get task if
		else {
			/////////// save cron job run time
			$data = array(
						'user_id' => 0,
						'cronjob' => 'assign_task',
						'date_run' =>date('Y-m-d H:i:s'),
						'status' => '0',
					);
			$this->db->insert('cronjob', $data);

			exit;
		}	
			
	}
	

	
	/*
	Function name :close_task()
	Parameter : none
	Return : none
	Use : close task automatically(using cron job)
		  task which have auto assignment is 3 then no one offer on it or not assigned on the start date then close task
	Description :its default function of close task automatically(using cron job) which called http://hostname/assign/close_task
	*/

	function close_task()
	{
	
	
		
		///===get the task which are active(task_active=1) and task are in posted status(task_activitity_status=0) 
		$get_task=$this->assign_model->get_task_for_close();
		
		
		if($get_task)
		{
			
			foreach($get_task as $task)
			{
				 $task_id=$task->task_id;
				
				$task_post_date=$task->task_post_date;
				
				$task_start_day=$task->task_start_day;
				$task_start_time=$task->task_start_time;
				
				$task_start_date=date('Y-m-d',strtotime(date("Y-m-d", strtotime($task_post_date)) . " +".$task_start_day."days"));				
				$task_start_hour=date('H',mktime(0,$task_start_time,0,0,0,0));	
				
			
				$task_end_day=$task->task_end_day;
				$task_end_time=$task->task_end_time;				
				
				$task_end_date=date('Y-m-d',strtotime(date("Y-m-d", strtotime($task_post_date)) . " +".$task_end_day."days"));				
				$task_end_hour=date('H',mktime(0,$task_end_time,0,0,0,0));	
				
				
				//===and check task start time is not past
				//echo date('Y-m-d-H')."====".$task_start_date.'-'.$task_start_hour.'==='.$task_id.'<br/>';
				
				
				
				
				/*****===for close task which is not assign on the start date 
				* if task auto assignment is 3 and task is start_date is match with current date time
				* and if no one assign then system close the task
				**/
				
				
				if((strtotime(date('Y-m-d-H'))==strtotime($task_start_date.'-'.$task_start_hour)) && ($task->task_worker_id=='' || $task->task_worker_id==0))
				{
								////set expire task
								$this->assign_model->close_task($task_id);
								
								
								
								
									/////////////============Close task poster start===========	
							
								$user_detail = $this->user_model->get_user_info($task->user_id);
								$task_link ='<a href="'.base_url().'tasks/'.$task->task_url_name.'">'.$task->task_name.'</a>';
								$notification = notification_setting($task->user_id);
								
								if(isset($notification->on_expire_task)) {  
				
									 if($notification->on_expire_task==1) {   
									 
										$email_template=$this->db->query("select * from ".$this->db->dbprefix('email_template')." where task='Expire Task (Poster)'");
										$email_temp=$email_template->row();
										
										
										$email_address_from=$email_temp->from_address;
										$email_address_reply=$email_temp->reply_address;
										
										$email_subject=$email_temp->subject;				
										$email_message=$email_temp->message;			
										
						
										$email_to=$user_detail->email;
											
									
										$email_message=str_replace('{break}','<br/>',$email_message);
										$email_message=str_replace('{poster_name}',$user_detail->full_name,$email_message);				
										$email_message=str_replace('{task_name}',$task_link,$email_message);
										
										
										$str=$email_message; 
															
										/** custom_helper email function **/
											
										email_send($email_address_from,$email_address_reply,$email_to,$email_subject,$str);
									}
								}
								 
								/////////////============Close task poster end===========
								
								/////////////============Close task admin start===========	
					
									$email_template=$this->db->query("select * from ".$this->db->dbprefix('email_template')." where task='Expire Task (Admin)'");
									$email_temp=$email_template->row();
									
									
									$email_address_from=$email_temp->from_address;
									$email_address_reply=$email_temp->reply_address;
									
									$email_subject=$email_temp->subject;				
									$email_message=$email_temp->message;			
									
					
									$email_to=$email_temp->from_address;
									$poster_link = '<a href="'.base_url().'user/'.$user_detail->profile_name.'">'.ucfirst($user_detail->full_name).'</a>';
												
									$email_message=str_replace('{break}','<br/>',$email_message);
									$email_message=str_replace('{poster_name}',$poster_link,$email_message);				
									$email_message=str_replace('{task_name}',$task_link,$email_message);
									
									
									$str=$email_message;
														
									/** custom_helper email function **/
										
									email_send($email_address_from,$email_address_reply,$email_to,$email_subject,$str);
										
								/////////////============Close task admin end===========
					
						
				}////===date check condition
				
				
				
				
			
			
				
			
			} ///=== foreach  get_task	
			
		/////////// save cron job run time
			$data = array(
						'user_id' => 0,
						'cronjob' => 'close_task',
						'date_run' =>date('Y-m-d H:i:s'),
						'status' => '1',
					);
			$this->db->insert('cronjob', $data);

			exit;
			
		
		} ///===get task if
		else {
			/////////// save cron job run time
			$data = array(
						'user_id' => 0,
						'cronjob' => 'close_task',
						'date_run' =>date('Y-m-d H:i:s'),
						'status' => '0',
					);
			$this->db->insert('cronjob', $data);

			exit;
		}	
	
	}
	
	
}

?>