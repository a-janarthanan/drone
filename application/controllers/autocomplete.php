<?php
class Autocomplete extends ROCKERS_Controller {
	
	/*
	Function name :Autocomplete()
	Description :Its Default Constuctor which called when autocomplete object initialzie.its load necesary models
	*/
	function Autocomplete()
	{
		parent::__construct();	
		$this->load->model('task_model');
		$this->load->model('worker_model');	
		$this->load->model('user_model');	
		$this->load->model('autocomplete_model');	
		$this->load->model('user_task_model');
	}
	
	
	/*
	Function name :index()
	Parameter : none
	Return : none
	Use : complete task automatically(using cron job)
	Description :its default function of complete task automatically(using cron job) which called http://hostname/autocomplete	
	*/ 
	
	function index()
	{
			
			
		$task_setting=task_setting();
		
		$task_auto_complete_hour=$task_setting->task_auto_complete_hour;
		$task_worker_fee=$task_setting->task_worker_fee;
		
		$current_date=date('Y-m-d H:i:s');
		
		$task_list=$this->autocomplete_model->get_task();
		
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
						
						 $price = $this->autocomplete_model->user_added_task_price($task_detail->user_id,$task_id); 
					 
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
					
						
						$worker_detail=$this->worker_model->get_worker_info($task_detail->task_worker_id);
						
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
								
								$user_detail = $this->user_model->get_user_info($task_detail->user_id);
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
							'user_id' => 0,
							'cronjob' => 'autocomplete_task',
							'date_run' =>date('Y-m-d H:i:s'),
							'status' => '1',
						);
				$this->db->insert('cronjob', $data);
	
				exit;
					
			} else {
			
				/////////// save cron job run time
				$data = array(
							'user_id' => 0,
							'cronjob' => 'autocomplete_task',
							'date_run' =>date('Y-m-d H:i:s'),
							'status' => '0',
						);
				$this->db->insert('cronjob', $data);
	
				exit;	
			}
	
			
	}
	
}

?>