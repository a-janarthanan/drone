<?php
class Dispute extends ROCKERS_Controller {
	
	/*
	Function name :Dispute()
	Description :Its Default Constuctor which called when dispute object initialzie.its load necesary models
	*/
	function Dispute()
	{
		 parent::__construct();	
		$this->load->model('dispute_model');
		$this->load->model('user_task_model');
		$this->load->model('task_model');
		$this->load->model('worker_model');
		$this->load->model('user_task_model');
		$this->load->model('search_model');
		$this->load->model('home_model');	
		$this->load->model('user_model');
		error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
	}
	
	
	/*
	Function name :index()
	Parameter :$task_id (task id)
	Return : none
	Use : if someone open this link directly then visitor redirect to dispute task page
	Description :its default function which called http://hostname/dispute/dispute_task/$task_id
	*/
	
	function index($task_id)
	{
		redirect('dispute/dispute_task');
	}
	
	
	/*
	Function name :dispute_task()
	Parameter : $task_id (task id)
	Return : none
	Use : user can see task details, all dispute conversation message, also add dispute conversation message
	Description : user can see task details, all dispute conversation message, also add dispute conversation message
				  which called http://hostname/dispute/dispute_task/$task_id 
	*/
	
	function dispute_task($task_id)
		{
			if($task_id=='' || $task_id==0)
			   {
					redirect('dashboard');
			   }
			   
			   
			   $task_detail=$this->task_model->get_tasks_detail_by_id($task_id);
			   if(!$task_detail)
			   {
					redirect('dashboard');
			   }
			   
			   
			   
			$user_detail = $this->user_model->get_user_info($task_detail->user_id);
				
				if(!$user_detail)
			   {
					redirect('dashboard');
			   }
			   
			   
			$worker_detail = $this->worker_model->get_worker_info($task_detail->task_worker_id);	
				if(!$worker_detail)
			   {
					redirect('dashboard');
			   }
			   
			   
			   
			   
			   $data['worker_detail']=$worker_detail;
			    $data['user_detail']=$user_detail;

			

			$theme = getThemeName();
			$this->template->set_master_template($theme .'/template.php');	
					
			$data['result'] = $this->dispute_model->get_all_dispute_comments($task_id);
			 
			   $this->form_validation->set_rules('comment', 'Comment', 'required');
			  
			   
			   if($this->form_validation->run() == FALSE){
			
					if(validation_errors())
					{
						$data["error"] = validation_errors();
					}else{
						$data["error"] = "";
					}
					
					$data['comment'] = $this->input->post('comment');
					$data['task_id'] = $this->input->post('task_id');

				} else {
			
					if(!empty($data['result'])) {
						$dispute_id=$this->dispute_model->dispute_comment_add();
					} else {
						$dispute_id=$this->dispute_model->dispute_add();
						
					$notification = notification_setting($task_detail->user_id);
						$worker_notification = notification_setting($worker_detail->user_id);
						
						
						if($worker_detail->user_id == get_authenticateUserID()){	
						
							
							 /////////////============Dispute time  to poster start===========	
		
							if(isset($notification->on_dispute)) {  

        						if($notification->on_dispute==1) {  
								
									$email_template=$this->db->query("select * from ".$this->db->dbprefix('email_template')." where task='Dispute Task by Worker (Poster)'");
									$email_temp=$email_template->row();
									
									
									$email_address_from=$email_temp->from_address;
									$email_address_reply=$email_temp->reply_address;
									
									$email_subject=$email_temp->subject;				
									$email_message=$email_temp->message;			
									
													
									$email_to=$user_detail->email;		
									
									
									$worker_link ='<a href="'.base_url().'user/'.$worker_detail->profile_name.'">'.ucfirst($worker_detail->full_name).'</a>';
									$task_link ='<a href="'.base_url().'tasks/'.$task_detail->task_url_name.'">'.$task_detail->task_name.'</a>';
								
									
									$email_message=str_replace('{break}','<br/>',$email_message);
									$email_message=str_replace('{poster_name}',ucfirst($user_detail->full_name),$email_message);		
									$email_message=str_replace('{worker_name}',$worker_link,$email_message);		
									$email_message=str_replace('{task_name}',$task_link,$email_message);
									
									$str=$email_message; 
														
									/** custom_helper email function **/
										
									email_send($email_address_from,$email_address_reply,$email_to,$email_subject,$str);
								}
							}
								
							/////////////============Dispute time  to poster end===========	
								
							/////////////============Dispute time  to worker start===========	
				
							
							if(isset($worker_notification->on_dispute)) {  

        						if($worker_notification->on_dispute==1) {  
								
									$email_template=$this->db->query("select * from ".$this->db->dbprefix('email_template')." where task='Dispute Task by Worker (Worker)'");
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
								
							/////////////============Dispute time  to worker end===========
							
							/////////////============Dispute time  to admin start===========	

								$email_template=$this->db->query("select * from ".$this->db->dbprefix('email_template')." where task='Dispute Task by Worker (Admin)'");
								$email_temp=$email_template->row();
								
								
								$email_address_from=$email_temp->from_address;
								$email_address_reply=$email_temp->reply_address;
								
								$email_subject=$email_temp->subject;				
								$email_message=$email_temp->message;			
								
												
								$email_to=$email_temp->from_address;
								
								
								$poster_link ='<a href="'.base_url().'user/'.$user_detail->profile_name.'">'.ucfirst($user_detail->full_name).'</a>';
								
							
								
								$email_message=str_replace('{break}','<br/>',$email_message);
								$email_message=str_replace('{poster_name}',poster_link,$email_message);		
								$email_message=str_replace('{worker_name}',$worker_link,$email_message);		
								$email_message=str_replace('{task_name}',$task_link,$email_message);
								
								$str=$email_message; 
													
								/** custom_helper email function **/
									
								email_send($email_address_from,$email_address_reply,$email_to,$email_subject,$str);
								
							/////////////============Dispute time  to admin end===========	

							
						} 
						
						elseif($task_detail->user_id == get_authenticateUserID()) {
						
							 /////////////============Dispute time  to poster start===========	
		
							if(isset($notification->on_dispute)) {  

        						if($notification->on_dispute==1) {  
								
									$email_template=$this->db->query("select * from ".$this->db->dbprefix('email_template')." where task='Dispute Task by User (Poster)'");
									$email_temp=$email_template->row();
									
									
									$email_address_from=$email_temp->from_address;
									$email_address_reply=$email_temp->reply_address;
									
									$email_subject=$email_temp->subject;				
									$email_message=$email_temp->message;			
									
													
									$email_to=$user_detail->email;		
									
									
									
									$worker_link ='<a href="'.base_url().'user/'.$worker_detail->profile_name.'">'.ucfirst($worker_detail->full_name).'</a>';
									$poster_link ='<a href="'.base_url().'user/'.$user_detail->profile_name.'">'.ucfirst($user_detail->full_name).'</a>';
									$task_link ='<a href="'.base_url().'tasks/'.$task_detail->task_url_name.'">'.$task_detail->task_name.'</a>';
								
									
									$email_message=str_replace('{break}','<br/>',$email_message);
									$email_message=str_replace('{poster_name}',ucfirst($user_detail->full_name),$email_message);		
									$email_message=str_replace('{worker_name}',$worker_link,$email_message);		
									$email_message=str_replace('{task_name}',$task_link,$email_message);
									
									$str=$email_message; 
														
									/** custom_helper email function **/
										
									email_send($email_address_from,$email_address_reply,$email_to,$email_subject,$str);
								}
							}
								
							/////////////============Dispute time  to poster end===========	
								
							/////////////============Dispute time  to worker start===========
							if(isset($worker_notification->on_dispute)) {  

        						if($worker_notification->on_dispute==1) {  	
				
									$email_template=$this->db->query("select * from ".$this->db->dbprefix('email_template')." where task='Dispute Task by User (Worker)'");
									$email_temp=$email_template->row();
									
									
									$email_address_from=$email_temp->from_address;
									$email_address_reply=$email_temp->reply_address;
									
									$email_subject=$email_temp->subject;				
									$email_message=$email_temp->message;			
									
													
									$email_to=$worker_detail->email;		
								
									$email_message=str_replace('{break}','<br/>',$email_message);	
									$email_message=str_replace('{worker_name}',ucfirst($worker_detail->full_name),$email_message);			
									$email_message=str_replace('{task_name}',$task_link,$email_message);
									$email_message=str_replace('{poster_name}',$poster_link,$email_message);
									
									$str=$email_message; 
									
									/** custom_helper email function **/
										
									email_send($email_address_from,$email_address_reply,$email_to,$email_subject,$str);
								}
							}
								
							/////////////============Dispute time  to worker end===========
							
							/////////////============Dispute time  to admin start===========	

								$email_template=$this->db->query("select * from ".$this->db->dbprefix('email_template')." where task='Dispute Task by User (Admin)'");
								$email_temp=$email_template->row();
								
								
								$email_address_from=$email_temp->from_address;
								$email_address_reply=$email_temp->reply_address;
								
								$email_subject=$email_temp->subject;				
								$email_message=$email_temp->message;			
								
												
								$email_to=$email_temp->from_address;
								
								
								$poster_link ='<a href="'.base_url().'user/'.$user_detail->profile_name.'">'.ucfirst($user_detail->full_name).'</a>';
								
							
								
								$email_message=str_replace('{break}','<br/>',$email_message);
								$email_message=str_replace('{poster_name}',poster_link,$email_message);		
								$email_message=str_replace('{worker_name}',$worker_link,$email_message);		
								$email_message=str_replace('{task_name}',$task_link,$email_message);
								
								$str=$email_message; 
													
								/** custom_helper email function **/
									
								email_send($email_address_from,$email_address_reply,$email_to,$email_subject,$str);
								
							/////////////============Dispute time  to admin end===========

						}
						
						
						
					}

					$data['comment'] = $this->input->post('comment');
					$data['task_id'] = $this->input->post('task_id');
					
					
					
					
					
					
						/////////////============Conversation start===========	
						
					
						$task_link ='<a href="'.base_url().'tasks/'.$task_detail->task_url_name.'">'.$task_detail->task_name.'</a>';
						
						$email_template=$this->db->query("select * from ".$this->db->dbprefix('email_template')." where task='Conversation Message'");
						$email_temp=$email_template->row();
						
						
						//$email_address_from=$email_temp->from_address;
						//$email_address_reply=$email_temp->reply_address;
						
						$email_subject=$email_temp->subject;				
						$email_message=$email_temp->message;			

							
						if($task_detail->user_id == get_authenticateUserID()) {
						
							if(isset($worker_notification->on_conversation)) {  

        						if($worker_notification->on_conversation==1) { 
						
						
									$email_address_from=$user_detail->email;
									$email_address_reply=$user_detail->email;
									
									$email_to=$worker_detail->email;
									
									$user_name = ucfirst($worker_detail->full_name);	
									$from_name ='<a href="'.base_url().'user/'.$user_detail->profile_name.'">'.ucfirst($user_detail->full_name).'</a>';
									$email_message=str_replace('{break}','<br/>',$email_message);
									$email_message=str_replace('{user_name}',$user_name,$email_message);		
									$email_message=str_replace('{from_name}',$from_name,$email_message);		
									$email_message=str_replace('{task_name}',$task_link,$email_message);
									$email_message=str_replace('{message}',$this->input->post('comment'),$email_message);
									
									$str=$email_message;
														
									/** custom_helper email function **/
										
									email_send($email_address_from,$email_address_reply,$email_to,$email_subject,$str);
								}
							}
							
							
						} else {
						
							if(isset($notification->on_conversation)) {  

        						if($notification->on_conversation==1) { 
						
									$email_address_from=$worker_detail->email;
									$email_address_reply=$worker_detail->email;
									
									$email_to=$user_detail->email;
									
									$user_name = ucfirst($user_detail->full_name);	
									$from_name ='<a href="'.base_url().'user/'.$worker_detail->profile_name.'">'.ucfirst($worker_detail->full_name).'</a>';
									
									$email_message=str_replace('{break}','<br/>',$email_message);
									$email_message=str_replace('{user_name}',$user_name,$email_message);		
									$email_message=str_replace('{from_name}',$from_name,$email_message);		
									$email_message=str_replace('{task_name}',$task_link,$email_message);
									$email_message=str_replace('{message}',$this->input->post('comment'),$email_message);
									
									$str=$email_message;
														
									/** custom_helper email function **/
										
									email_send($email_address_from,$email_address_reply,$email_to,$email_subject,$str);
								}
							}
							
						}
		
					
						/////////////============Conversation end===========
					
					
					echo "<script>window.location.href='".site_url('dispute/dispute_task/'.$task_id)."'</script>";
					
					
				}
			
			$data['dispute_id'] = '';
			$data['task_id']=$task_id;
			$data['task_user_id'] = $this->user_task_model->get_task_user($task_id);			
			
			
			
			$data['task_detail']=$task_detail;
			$data['task_location']=$this->task_model->get_task_location($task_id);
			
			
			$data['dispute_setting'] =  $this->dispute_model->get_dispute_setting();
			
			$data['site_setting']=site_setting();
			$data['theme']=$theme;
			$meta_setting=meta_setting();
			
			$pageTitle='Dispute Conversation  for - '.$meta_setting->title;
			$metaDescription='Dispute Conversation for - '.$meta_setting->meta_description;
			$metaKeyword='Dispute Conversation for - '.$meta_setting->meta_keyword;
			
			$this->template->write('pageTitle',$pageTitle,TRUE);
			$this->template->write('metaDescription',$metaDescription,TRUE);
			$this->template->write('metaKeyword',$metaKeyword,TRUE);
			$this->template->write_view('header',$theme .'/layout/common/header_login',$data,TRUE);
			$this->template->write_view('content_center',$theme .'/layout/dispute/dispute_task',$data,TRUE);
			$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
			$this->template->render();
		
		}
}
?>