<?php
class Cronjob extends CI_Controller {
	function Cronjob()
	{
		parent::__construct();
		$this->load->model('cronjob_model');
		$this->load->model('user_model');
		$this->load->model('worker_model');
	}
	
	function index()
	{
		redirect('cronjob/list_cronjob');
	}
	
	function list_cronjob($limit=20,$offset=0,$msg='')
	{
		
		$data = array();
	    $theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
	
		$check_rights= get_rights('list_cronjob'); 
		
		/*if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}*/
		
		$this->load->library('pagination');

		//$limit = '10';
		$config['uri_segment']='4';
		$config['base_url'] = base_url().'cronjob/list_cronjob/'.$limit.'/';	
		$config['total_rows'] = $this->cronjob_model->get_total_cronjob_count();
		$config['per_page'] = $limit;		
		$this->pagination->initialize($config);		
		$data['page_link'] = $this->pagination->create_links();
		
		$data['site_setting'] = site_setting();
		
		$data['result'] = $this->cronjob_model->get_cronjob_result($offset, $limit);
		$data['msg'] = $msg;
		$data['offset'] = $offset;
		$data['search_type']='normal';
	
		$data['limit']=$limit;
		$data['option']='';
	
		$data['crons'] = $this->cronjob_model->get_cron_function();
	
		$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
	    $this->template->write_view('center',$theme .'/layout/cronjob/list_cronjob',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
		
		
	}
	
	function run()
	{
		$check_rights= get_rights('list_cronjob'); 
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		$function = $this->input->post('option');

		redirect('cronjob/'.$function);
	
	}
	
	function delete_user_login()
 	{
		////////// check rights of cronjob
			$check_rights= get_rights('list_cronjob'); 
		
			if(	$check_rights==0) {			
				redirect('home/dashboard/no_rights');	
			}
				
		/////===== get user setting details
			$user_setting = user_setting();
			$user_day_limit = $user_setting->delete_user_login_day;
			
		/////===== get all user details
			$user = $this->db->get("user");
			$users = $user->result();
			if($users){
				foreach($users as $user){
					
					/////===== get last user login details
						$this->db->order_by('login_date_time','desc');
						$this->db->limit('1','0');
						$user_login  = $this->db->get_where('user_login',array('user_id'=>$user->user_id));
						
						if($user_login->num_rows >0) {
							$user_logins = $user_login->row();
		
							$date = $user_logins->login_date_time;
							$user_limit_date =date('Y-m-d H:i:s',mktime(0,0,0,date('m',strtotime($date)),date('d',strtotime($date))-$user_day_limit,date('Y',strtotime($date))));
							
							/////=====delete user login details
							$this->db->query("Delete from ".$this->db->dbprefix('user_login')." where login_date_time <= '".$user_limit_date."' and user_id = '".$user_logins->user_id."'");	
							
		
						}
						
				}
				
				/////////// save cron job run time
				$data = array(
							'user_id' => $this->session->userdata('admin_id'),
							'cronjob' => 'delete_user_login',
							'date_run' =>date('Y-m-d H:i:s'),
							'status' => '1',
						);
				$this->db->insert('cronjob', $data);
	
				redirect('cronjob/list_cronjob');
					
			} else {
			
				/////////// save cron job run time
				$data = array(
							'user_id' => $this->session->userdata('admin_id'),
							'cronjob' => 'delete_user_login',
							'date_run' =>date('Y-m-d H:i:s'),
							'status' => '0',
						);
				$this->db->insert('cronjob', $data);
	
				redirect('cronjob/list_cronjob');	
			}
	}
	
	function delete_admin_login()
 	{
		////////// check rights of cronjob
			$check_rights= get_rights('list_cronjob'); 
		
			if(	$check_rights==0) {			
				redirect('home/dashboard/no_rights');	
			}
		/////===== get user setting details
			$user_setting = user_setting();
			$admin_day_limit = $user_setting->delete_admin_login_day;
			
		/////===== get all admin details
			$admin = $this->db->get("admin");
			$admins = $admin->result();
			if($admins){
				foreach($admins as $admin){
					
					/////===== get last admin login details
						$this->db->order_by('login_date','desc');
						$this->db->limit('1','0');
						$admin_login  = $this->db->get_where('admin_login',array('admin_id'=>$admin->admin_id));
						
						if($admin_login->num_rows >0) {
							$admin_logins = $admin_login->row();
							
		
							$date = $admin_logins->login_date;
							$admin_limit_date =date('Y-m-d H:i:s',mktime(0,0,0,date('m',strtotime($date)),date('d',strtotime($date))-$admin_day_limit,date('Y',strtotime($date))));
							
							/////=====delete admin login details
							$this->db->query("Delete from ".$this->db->dbprefix('admin_login')." where login_date <= '".$admin_limit_date."' and admin_id = '".$admin_logins->admin_id."'");
	
						}
				}
				
				/////////// save cron job run time
				$data = array(
							'user_id' => $this->session->userdata('admin_id'),
							'cronjob' => 'delete_admin_login',
							'date_run' =>date('Y-m-d H:i:s'),
							'status' => '1',
						);
				$this->db->insert('cronjob', $data);
	
				redirect('cronjob/list_cronjob');
			
			} else {
				/////////// save cron job run time
				$data = array(
							'user_id' => $this->session->userdata('admin_id'),
							'cronjob' => 'delete_admin_login',
							'date_run' =>date('Y-m-d H:i:s'),
							'status' => '0',
						);
				$this->db->insert('cronjob', $data);
	
				redirect('cronjob/list_cronjob');
			}			
	}
	
	function assign_task()
	{
		////////// check rights of cronjob
			$check_rights= get_rights('list_cronjob'); 
		
			if(	$check_rights==0) {			
				redirect('home/dashboard/no_rights');	
			}
			
		///===get the task which are active(task_active=1) and task are in posted status(task_activitity_status=0) 
		$get_task=$this->cronjob_model->get_task();
		
		
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
						
					
						
						$get_worker_bid=$this->cronjob_model->get_worker_bid($task_id);
						
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
								 $this->cronjob_model->assign_task_worker($task_id,$user_id);
								 
								 $notification = notification_setting($task->user_id);
								$worker_notification = notification_setting($user_id);
								//echo '<pre>'; print_r($notification); print_r($worker_notification); die();
								
								$user_detail = $this->user_model->get_one_user($task->user_id);
			   					$worker_detail = $this->user_model->get_one_user($user_id);
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
								$this->cronjob_model->close_task($task_id);
								
								
									/////////////============Close task poster start===========	
							
								$user_detail = $this->user_model->get_one_user($task->user_id);
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
							$this->cronjob_model->close_task($task_id);
							
							
										/////////////============Close task poster start===========	
							
								$user_detail = $this->user_model->get_one_user($task->user_id);
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
						
						$get_worker_bid=$this->cronjob_model->get_worker_bid($task_id);
						
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
								 $this->cronjob_model->assign_task_worker($task_id,$user_id);
								 
								 
								 			 
								$notification = notification_setting($task->user_id);
								$worker_notification = notification_setting($user_id);
								//echo '<pre>'; print_r($notification); print_r($worker_notification); die();
								
								$user_detail = $this->user_model->get_one_user($task->user_id);
			   					$worker_detail = $this->user_model->get_one_user($user_id);
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
								$this->cronjob_model->close_task($task_id);
								
								
								/////////////============Close task poster start===========	
							
								$user_detail = $this->user_model->get_one_user($task->user_id);
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
							$this->cronjob_model->close_task($task_id);
							
							/////////////============Close task poster start===========	
							
								$user_detail = $this->user_model->get_one_user($task->user_id);
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
						'user_id' => $this->session->userdata('admin_id'),
						'cronjob' => 'assign_task',
						'date_run' =>date('Y-m-d H:i:s'),
						'status' => '1',
					);
			$this->db->insert('cronjob', $data);

			redirect('cronjob/list_cronjob');
			
		
		} ///===get task if
		else {
			/////////// save cron job run time
			$data = array(
						'user_id' => $this->session->userdata('admin_id'),
						'cronjob' => 'assign_task',
						'date_run' =>date('Y-m-d H:i:s'),
						'status' => '0',
					);
			$this->db->insert('cronjob', $data);

			redirect('cronjob/list_cronjob');
		}
			
			
	}
	
	/*** task which have auto assignment is 3 then
	* no one offer on it or not assigned on the start date then close task
	**/
	function close_task()
	{
		////////// check rights of cronjob
			$check_rights= get_rights('list_cronjob'); 
		
			if(	$check_rights==0) {			
				redirect('home/dashboard/no_rights');	
			}
	
		
		///===get the task which are active(task_active=1) and task are in posted status(task_activitity_status=0) 
		$get_task=$this->cronjob_model->get_task_for_close();
		
		
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
	
				
				/*****===for close task which is not assign on the start date 
				* if task auto assignment is 3 and task is start_date is match with current date time
				* and if no one assign then system close the task
				**/
				
				
				if((strtotime(date('Y-m-d-H'))==strtotime($task_start_date.'-'.$task_start_hour)) && ($task->task_worker_id=='' || $task->task_worker_id==0))
				{
								////set expire task
								$this->assign_model->cronjob_model($task_id);
								
								
								
								
									/////////////============Close task poster start===========	
							
								$user_detail = $this->user_model->get_one_user($task->user_id);
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
						'user_id' => $this->session->userdata('admin_id'),
						'cronjob' => 'close_task',
						'date_run' =>date('Y-m-d H:i:s'),
						'status' => '1',
					);
			$this->db->insert('cronjob', $data);

			redirect('cronjob/list_cronjob');	
			
		
		} ///===get task if
		else {
			/////////// save cron job run time
			$data = array(
						'user_id' => $this->session->userdata('admin_id'),
						'cronjob' => 'close_task',
						'date_run' =>date('Y-m-d H:i:s'),
						'status' => '0',
					);
			$this->db->insert('cronjob', $data);

			redirect('cronjob/list_cronjob');	
		}	

	}
	
	function autocomplete_task()
	{
		////////// check rights of cronjob
			$check_rights= get_rights('list_cronjob'); 
		
			if(	$check_rights==0) {			
				redirect('home/dashboard/no_rights');	
			}	
			
		$task_setting=task_setting();
		
		$task_auto_complete_hour=$task_setting->task_auto_complete_hour;
		$task_worker_fee=$task_setting->task_worker_fee;
		
		$current_date=date('Y-m-d H:i:s');
		
		$task_list=$this->cronjob_model->get_auto_task();
		
		if($task_list)
		{
			
			foreach($task_list as $task_detail)
			{
		
		/////===set time zone for task assign==========
				
				
		$task_timezone_date=date('Y-m-d H:i:s');

		$city_detail=get_cityDetail($task_detail->task_city_id);
		
		if($city_detail)
		{	
			$dateTime = new DateTime("now", new DateTimeZone('America/Los_Angeles'));	 
			$task_timezone=tzOffsetToName($city_detail->city_timezone);			
			$dateTimeZone = new DateTimeZone($task_timezone);
			$dateTime->setTimezone($dateTimeZone); 
			$task_timezone_date= $dateTime->format("Y-m-d H:i:s");
			
		}
		
		
		
		
				
				$complete_date=$task_detail->task_complete_date;
				
				if($complete_date!='0000-00-00 00:00:00')
				{
					 $task_id=$task_detail->task_id;
					
				
					 $auto_complete_date= date('Y-m-d H:i:s',strtotime(date("Y-m-d H:i:s", strtotime($complete_date)) . " +".$task_auto_complete_hour." hours"));	
					
					
					if(strtotime($task_timezone_date)>=strtotime($auto_complete_date))
					{
					
					/////===addc doe from herer in submit and close
						
						$total=0;		
						
						 $price = $this->cronjob_model->user_added_task_price($task_detail->user_id,$task_id); 
					 
					 	if(isset($price))
						{
							if(isset($price->credit))
							{
								if($price->credit>0)
								{
									 $total=$total+$price->credit;
								}
							}
						}
						 
						
						 $total=number_format($total,2);
						
						
						 $worker_fee=0;
						 
						 if($task_worker_fee>0)
						 {
					
							 $worker_fee=number_format((($total*$task_worker_fee)/100),2);
					
						}
						
						
							
					 $amount_pay=number_format(($total- $worker_fee),2);
					
						
						$worker_detail=$this->worker_model->view_worker_result($task_detail->task_worker_id);
						
						 $worker_user_id=$worker_detail->user_id;
						
						
						
						$trans_id='WL'.randomCode();
						
						$worker_wallet_data=array(
							'debit'=>$amount_pay,
							'total_user_price'=>$total,
							'total_cut_price'=>$worker_fee,
							'user_id'=>$worker_user_id,
							'wallet_transaction_id'=>$trans_id,
							'wallet_date'=>$task_timezone_date,
							'admin_status'=>'Confirm',
							'task_id'=>$task_id
						);
						
						$this->db->insert('wallet',$worker_wallet_data);
						
						
						
						$update_task=array(
						'task_close_date'=>$task_timezone_date,
						'task_activity_status'=>3,
						'poster_agree'=>1,
						'worker_agree'=>1
						);
						
						$this->db->where('task_id',$task_id);
						$this->db->update('task',$update_task);
						
						
						
						////////========msg
						
						$message = array(
								'act' => 'workerwallet',
								'task_id' => $task_id,
								'poster_user_id' => $task_detail->user_id,
								'receiver_user_id' => $worker_user_id,
								'is_read' => 0,
								'message_date' => $task_timezone_date
						);
						$this->db->insert('message', $message);
						
						$message = array(
								'act' => 'taskfinish',
								'task_id' => $task_id,
								'poster_user_id' => $task_detail->user_id,
								'receiver_user_id' => $worker_user_id,
								'is_read' => 0,
								'message_date' => $task_timezone_date
						);
						$this->db->insert('message', $message);




						
						////////////====addd email for worker amount add to his wallet====
							////////////====addd email for worker amount add to his wallet====
								
								$site_setting=site_setting();
								$notification = notification_setting($task_detail->user_id);
								$worker_notification = notification_setting($worker_user_id);
								//echo '<pre>'; print_r($notification); print_r($worker_notification); die();
								
								$user_detail = $this->user_model->get_one_user($task_detail->user_id);
								//echo '<pre>'; print_r($user_detail); print_r($worker_detail); die();
			   
								$user_link ='<a href="'.base_url().'user/'.$user_detail->profile_name.'">'.ucfirst($user_detail->full_name).'</a>';
								$worker_link ='<a href="'.base_url().'user/'.$worker_detail->profile_name.'">'.ucfirst($worker_detail->full_name).'</a>';
								$task_link ='<a href="'.base_url().'tasks/'.$task_detail->task_url_name.'">'.$task_detail->task_name.'</a>';
								$price = ($price->credit) - ($price->total_cut_price);

							
								/////////////============Auto Complete time  to poster start===========
									
								if(isset($notification->on_expire_task)) {  
		
									if($notification->on_expire_task==1) { 
									
										$email_template=$this->db->query("select * from ".$this->db->dbprefix('email_template')." where task='AutoComplete Task (Poster)'");
										$email_temp=$email_template->row();
										
										
										$email_address_from=$email_temp->from_address;
										$email_address_reply=$email_temp->reply_address;
										
										$email_subject=$email_temp->subject;				
										$email_message=$email_temp->message;			
										
														
										$email_to=$user_detail->email;		
				
										
										$email_message=str_replace('{break}','<br/>',$email_message);
										$email_message=str_replace('{poster_name}',ucfirst($user_detail->full_name),$email_message);	
										$email_message=str_replace('{user_link}',$user_link,$email_message);			
										$email_message=str_replace('{worker_link}',$worker_link,$email_message);
										$email_message=str_replace('{task_name}',$task_link,$email_message);
										$email_message=str_replace('{price}',$site_setting->currency_symbol.$price,$email_message);
										$email_message=str_replace('{admin_fee}',$site_setting->currency_symbol.$worker_fee,$email_message);
										$email_message=str_replace('{amount_pay}',$site_setting->currency_symbol.$amount_pay,$email_message);
										
										$str=$email_message;
															
										/** custom_helper email function **/
											
										email_send($email_address_from,$email_address_reply,$email_to,$email_subject,$str);
									}
								}
								
								/////////////============Auto Complete time  to poster end===========	
								
								/////////////============Auto Complete time  to worker start===========
									
								if(isset($worker_notification->on_expire_task)) {  
		
									if($worker_notification->on_expire_task==1) { 
									
										$email_template=$this->db->query("select * from ".$this->db->dbprefix('email_template')." where task='AutoComplete Task (Worker)'");
										$email_temp=$email_template->row();
										
										
										$email_address_from=$email_temp->from_address;
										$email_address_reply=$email_temp->reply_address;
										
										$email_subject=$email_temp->subject;				
										$email_message=$email_temp->message;			
										
														
										$email_to=$worker_detail->email;		
									
										$email_message=str_replace('{break}','<br/>',$email_message);	
										$email_message=str_replace('{worker_name}',ucfirst($worker_detail->full_name),$email_message);			
										$email_message=str_replace('{user_link}',$user_link,$email_message);			
										$email_message=str_replace('{worker_link}',$worker_link,$email_message);
										$email_message=str_replace('{task_name}',$task_link,$email_message);
										$email_message=str_replace('{price}',$site_setting->currency_symbol.$price,$email_message);
										$email_message=str_replace('{admin_fee}',$site_setting->currency_symbol.$worker_fee,$email_message);
										$email_message=str_replace('{amount_pay}',$site_setting->currency_symbol.$amount_pay,$email_message);
										
										$str=$email_message; 
										
										/** custom_helper email function **/
											
										email_send($email_address_from,$email_address_reply,$email_to,$email_subject,$str);
									}
								}
								
								/////////////============Auto Complete time  to worker end===========
								
								/////////////============Auto Complete task admin start===========	
					
									$email_template=$this->db->query("select * from ".$this->db->dbprefix('email_template')." where task='AutoComplete Task (Admin)'");
									$email_temp=$email_template->row();
									
									
									$email_address_from=$email_temp->from_address;
									$email_address_reply=$email_temp->reply_address;
									
									$email_subject=$email_temp->subject;				
									$email_message=$email_temp->message;			
									
					
									$email_to=$email_temp->from_address;
									$poster_link = '<a href="'.base_url().'user/'.$user_detail->profile_name.'">'.ucfirst($user_detail->full_name).'</a>';
												
									$email_message=str_replace('{break}','<br/>',$email_message);	
									$email_message=str_replace('{worker_name}',ucfirst($worker_detail->full_name),$email_message);			
									$email_message=str_replace('{user_link}',$user_link,$email_message);			
									$email_message=str_replace('{worker_link}',$worker_link,$email_message);
									$email_message=str_replace('{task_name}',$task_link,$email_message);
									$email_message=str_replace('{price}',$site_setting->currency_symbol.$price,$email_message);
									$email_message=str_replace('{admin_fee}',$site_setting->currency_symbol.$worker_fee,$email_message);
									$email_message=str_replace('{amount_pay}',$site_setting->currency_symbol.$amount_pay,$email_message);
									
									
									$str=$email_message;
														
									/** custom_helper email function **/
										
									email_send($email_address_from,$email_address_reply,$email_to,$email_subject,$str);
										
								/////////////============Auto Complete task admin end===========
						
						//////==============
						
												
					}	
					
						
					
				}
			
			
			}
			
			/////////// save cron job run time
				$data = array(
							'user_id' => $this->session->userdata('admin_id'),
							'cronjob' => 'autocomplete_task',
							'date_run' =>date('Y-m-d H:i:s'),
							'status' => '1',
						);
				$this->db->insert('cronjob', $data);
	
				redirect('cronjob/list_cronjob');
					
			} else {
			
				/////////// save cron job run time
				$data = array(
							'user_id' => $this->session->userdata('admin_id'),
							'cronjob' => 'autocomplete_task',
							'date_run' =>date('Y-m-d H:i:s'),
							'status' => '0',
						);
				$this->db->insert('cronjob', $data);
	
				redirect('cronjob/list_cronjob');	
			}
			
	}
	
	function newsletter_send()
	{
		////////// check rights of cronjob
			$check_rights= get_rights('list_cronjob'); 
		
			if(	$check_rights==0) {			
				redirect('home/dashboard/no_rights');	
			}
		
		$CI =& get_instance();
		$base_path = $CI->config->slash_item('base_path');
		
		
		$newsletter_control=$this->db->query("select * from ".$this->db->dbprefix('newsletter_setting'));
		$newsletter_setting=$newsletter_control->row();
				
		
			
				///////////////////============Email Setting===================================
							
			$this->load->library('email');
				
			
			///////====smtp====
			
			if($newsletter_setting->mailer=='smtp')
			{
			
				$config['protocol']='smtp';  
				$config['smtp_host']=trim($newsletter_setting->smtp_host);  
				$config['smtp_port']=trim($newsletter_setting->smtp_port);  
				$config['smtp_timeout']='30';  
				$config['smtp_user']=trim($newsletter_setting->smtp_email);  
				$config['smtp_pass']=trim($newsletter_setting->smtp_password);  
						
			}
			
			/////=====sendmail======
			
			elseif(	$newsletter_setting->mailer=='sendmail')
			{	
			
				$config['protocol'] = 'sendmail';
				$config['mailpath'] = trim($newsletter_setting->sendmail_path);
				
			}
			
			/////=====php mail default======
			
			else
			{
			
			}
				
				
			$config['wordwrap'] = TRUE;	
			$config['mailtype'] = 'html';
			$config['crlf'] = '\n\n';
			$config['newline'] = '\n\n';
			
			$this->email->initialize($config);
			
			$email_address_from=$newsletter_setting->newsletter_from_address;
			$email_from_name=$newsletter_setting->newsletter_from_name;
			
			$email_address_reply=$newsletter_setting->newsletter_reply_name;
			$email_reply_name=$newsletter_setting->newsletter_reply_address;
			
			
		
		///////////////////============Email Setting===================================
		
		
		
				
		$chk_job=$this->db->query("select * from ".$this->db->dbprefix('newsletter_job')." where job_start_date='".date('Y-m-d')."'");
		
		if($chk_job->num_rows()>0)
		{
			
			$job_list=$chk_job->result();
			
						
			foreach($job_list as $job)
			{
			
				///////////================job details===============	
				$get_job_details=$this->db->query("select * from ".$this->db->dbprefix('newsletter_job')." where job_id='".$job->job_id."'");
				$job_details=$get_job_details->row();
				
				if($job_details->newsletter_id!='' && $job_details->newsletter_id > 0)
				{ 
					///////////================newsletter details===============
					$get_newsletter_details=$this->db->query("select * from ".$this->db->dbprefix('newsletter_template')." where newsletter_id='".$job_details->newsletter_id."'");					
					$newsletter_details=$get_newsletter_details->row();
					
					
					
					///////////================subscriber details===============									
					$chk_newsletter_subscriber=$this->db->query("select * from ".$this->db->dbprefix('newsletter_subscribe')." where newsletter_id='".$job_details->newsletter_id."'");	
					$count_total_subscriber=$chk_newsletter_subscriber->num_rows();
					
					if($count_total_subscriber>0)
					{
					
					//////////////==========check sending total if send all then stop otherwise continue
					if($job_details->send_total<$count_total_subscriber)
					{
						$get_newsletter_subscriber=$this->db->query("select * from ".$this->db->dbprefix('newsletter_subscribe')." where newsletter_id='".$job_details->newsletter_id."' LIMIT ".$newsletter_setting->number_of_email_send." OFFSET ".$job_details->send_total);
						
						
						if($get_newsletter_subscriber->num_rows()>0)
						{
							$newsletter_subscriber=$get_newsletter_subscriber->result();
							$cnt=0;
							foreach($newsletter_subscriber as $subscribe)
							{
								
								////get user email details and newsletter template and add track code and subscibe,unscribe link make report id and status fail and sucess and generate 
								
								$get_newsletter_user_details=$this->db->query("select * from ".$this->db->dbprefix('newsletter_user')." where newsletter_user_id='".$subscribe->newsletter_user_id."'");
								
								if($get_newsletter_user_details->num_rows()>0)
								{
									$newsletter_user_details=$get_newsletter_user_details->row();
									
									if($newsletter_user_details->email!='')
									{
										
										$email_subject=$newsletter_details->subject;				
										$email_message=$newsletter_details->template_content;
										$attach_file=$newsletter_details->attach_file;
										$allow_subscribe_link=$newsletter_details->allow_subscribe_link;
										$allow_unsubscribe_link=$newsletter_details->allow_unsubscribe_link;
										
										$subscribe_link='<a href="'.base_url().'/newsletter/subscribe/'.$newsletter_user_details->email.'/'.$job_details->newsletter_id.'" style="color:#666666;">Subscribe</a>';
										
										
										$unsubscribe_link='<a href="'.base_url().'/newsletter/unsubscribe/'.$newsletter_user_details->email.'/'.$job_details->newsletter_id.'" style="color:#666666;">UnSubscribe</a>';
										
										
										if($allow_subscribe_link==1 || $allow_subscribe_link=='1')
										{
											$email_message.='<div style="clear:both;">'.$subscribe_link.'</div>';									
										}
										
										if($allow_unsubscribe_link==1 || $allow_unsubscribe_link=='1')
										{
											$email_message.='<div style="clear:both;">'.$unsubscribe_link.'</div>';									
										}
										
										
										$insert_report=$this->db->query("insert into ".$this->db->dbprefix('newsletter_report')."(`newsletter_user_id`,`job_id`)values('".$subscribe->newsletter_user_id."','".$job->job_id."')");	
										
										$report_id=mysql_insert_id();
										
										$track_link='<img src="'.base_url().'/newsletter/open/'.$report_id.'" width="1" height="1" />';
										
										$email_message.=$track_link;
										
																	
										
																
 										
										$this->email->from($email_address_from);
										$this->email->reply_to($email_address_reply);
										$this->email->to($newsletter_user_details->email);
										$this->email->subject($email_subject);
										$this->email->message($email_message);
										
										if(file_exists($base_path.'upload/newsletter/'.$attach_file))
										{										
											$this->email->attach($base_path.'upload/newsletter/'.$attach_file);										
										}
										
										if($this->email->send())
										{
											////insert success details=====
										
										//*$make_success=$this->db->query("insert into newsletter_report(`newsletter_user_id`,`job_id`,`is_fail`)values('".$subscribe->newsletter_user_id."','".$job->job_id."','1')");*/
										
											
										}
										else
										{
											////insert fail details=====
										
										$make_fail=$this->db->query("insert into ".$this->db->dbprefix('newsletter_report')."(`newsletter_user_id`,`job_id`,`is_fail`)values('".$subscribe->newsletter_user_id."','".$job->job_id."','1')");
										
										}
										
										$cnt++;
										
									}
									else
									{
										////insert fail details=====
										
										$make_fail=$this->db->query("insert into ".$this->db->dbprefix('newsletter_report')."(`newsletter_user_id`,`job_id`,`is_fail`)values('".$subscribe->newsletter_user_id."','".$job->job_id."','1')");									
																			
									}
																	
								
								}///////////===check user exists			
													
								
															
							}
							
							
							
						$all_send=(int)$job_details->send_total+(int)$cnt;
							
				$update_send_total=$this->db->query("update ".$this->db->dbprefix('newsletter_job')." set send_total='".$all_send."' where job_id='".$job->job_id."'");
						
						
							
							
						}
							
						
											
					}			
					
					 
					 } //////====count check for greater 0
				
				}///////==check newsletter==			
			
			}
			
			/////////// save cron job run time
			$data = array(
						'user_id' => $this->session->userdata('admin_id'),
						'cronjob' => 'newsletter_send',
						'date_run' =>date('Y-m-d H:i:s'),
						'status' => '1',
					);
			$this->db->insert('cronjob', $data);

			redirect('cronjob/list_cronjob');

		} else {
		
			/////////// save cron job run time
			$data = array(
						'user_id' => $this->session->userdata('admin_id'),
						'cronjob' => 'newsletter_send',
						'date_run' =>date('Y-m-d H:i:s'),
						'status' => '0',
					);
			$this->db->insert('cronjob', $data);

			redirect('cronjob/list_cronjob');	
		
		}

	
	///////=======subscribe link base_url().'/subscribe/'.$newsletter_user_email.'/'.$newsletter_id
	
	///////=======unsubscribe link base_url().'/unsubscribe/'.$newsletter_user_email.'/'.$newsletter_id
	
	///======put the tracking code url base_url().'/newsletter/open/'.$report_id (get from last insert id)
	
	}
	
	function user_login()
	{
		////////// check rights of cronjob
			$check_rights= get_rights('list_cronjob'); 
		
			if(	$check_rights==0) {			
				redirect('home/dashboard/no_rights');	
			}
			
		$this->load->driver('cache');			
		$supported_cache=check_supported_cache_driver();
		
		$cur_date_time=date('Y-m-d H:i:s');	
				
		$get_login_user=$this->cronjob_model->get_all_login_user();	
		
		if($get_login_user)
		{
			foreach($get_login_user as $login_details)
			{
				
				
				if(isset($supported_cache))
				{
					if($supported_cache!='' && $supported_cache!='none')
					{
						
						
						if($this->cache->$supported_cache->get('user_login'.$login_details->user_id))
						{					
							$login_details=(object)$this->cache->$supported_cache->get('user_login'.$login_details->user_id);					
						}
					}
				}
				
				/////////==========
				
				if($login_details)
				{
		
					 $login_time=$login_details->login_date_time;						
					 $login_extend_time=date('Y-m-d H:i:s',strtotime(date("Y-m-d H:i:s", strtotime($login_time)) . " +10 minutes"));
					 
					 
					 if(strtotime($cur_date_time)>strtotime($login_extend_time))
					 {
						
						
							$data_up=array(
								'login_status'=>0
							);
							
							$this->db->where('login_id',$login_details->login_id);
							$this->db->update('user_login',$data_up);
							
							
							
							////==destroy cache====	
						
							
							if(isset($supported_cache))
							{
								if($supported_cache!='' && $supported_cache!='none')
								{	
									if($this->cache->$supported_cache->get('user_login'.$login_details->user_id))
									{								
										$this->cache->$supported_cache->delete('user_login'.$login_details->user_id);						
									}
								}
								
							}
							
						
							////==destroy cache====	
					 
					 }
			 
				}
			
					
				
				///////////=========
			}
			
			/////////// save cron job run time
			$data = array(
						'user_id' => $this->session->userdata('admin_id'),
						'cronjob' => 'user_login',
						'date_run' =>date('Y-m-d H:i:s'),
						'status' => '1',
					);
			$this->db->insert('cronjob', $data);

			redirect('cronjob/list_cronjob');
		} else {
		
			/////////// save cron job run time
			$data = array(
						'user_id' => $this->session->userdata('admin_id'),
						'cronjob' => 'user_login',
						'date_run' =>date('Y-m-d H:i:s'),
						'status' => '0',
					);
			$this->db->insert('cronjob', $data);

			redirect('cronjob/list_cronjob');	
		}
		
	}
}
?>