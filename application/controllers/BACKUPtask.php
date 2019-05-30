<?php
class Task extends ROCKERS_Controller {
	
	
	/*
	Function name :Task()
	Description :Its Default Constuctor which called when task object initialzie.its load necesary models
	*/
	
	
	function Task()
	{
		parent::__construct();	
		$this->load->model('task_model');
		$this->load->model('worker_model');	
		$this->load->model('user_model');	
		$this->load->model('user_task_model');	
		$this->load->model('stored_card_model');
		$this->load->model('wallet_model');	
		$this->load->model('additional_information_model');	
	}
	
	
	/*
	Function name :index()
	Parameter :none
	Return : none
	Use : if someone open this link directly then visitor redirect to browse task in map page
	Description :its default function which called http://hostname/task	
	*/
	
	
	public function index()
	{
		redirect('map');
	}
	
	
	
	/*
	Function name :task_detail()
	Parameter : $task_name (Posted Task SEO friendly URL name), $msg (cusotm message), $task_comment_id (use for getting runner offer price)
	Return : none
	Use : User can see the task detail page with full information, offer on task, public conversation on task. 
	Description : user can see the task detail page using this function which called http://hostname/task/task_detail/$task_name  or 
	              SEO friendly URL which is declare in config route.php file  http://hostname/tasks/$task_name
	*/
	
	
	function task_detail($task_name,$msg='',$task_comment_id='')
	{
	
		
		if($task_name=='')
		{
			redirect('map');
		}
				
		
		 $task_detail = $this->task_model->get_tasks_details($task_name);
		
		if(is_numeric($task_detail))
		{
			if($task_detail=='' || $task_detail==0)
			{
				redirect('map');
			}
		}
		
		$data['task_detail']=$task_detail;
		
		
		
		
		
		
		
		$data['task_name']=$task_name;
				
		$task_id=$task_detail->task_id;		
		$data['task_id'] = $task_id;
		
		$data['msg']=$msg;
		$data['task_comment_id']=$task_comment_id;
		
		$user_id = $task_detail->user_id;
		$task_user_detail = $this->user_model->get_user_info($user_id);
		$data['task_user_detail']=$task_user_detail;
		
		$comments=$this->task_model->get_comments($task_id);
		$data['comments']=$comments;	
		
		$offers_on_task=$this->task_model->get_task_offer($task_id);
		$data['offers_on_task']=$offers_on_task;	
		
		
		
		$data['additional_information']  = $this->additional_information_model->get_all_information($task_id);



		$category_id = $task_detail->task_category_id;
		
		$similar_tasks = $this->task_model->get_similar_tasks($category_id,$task_id);
		$data['similar_tasks']=$similar_tasks;
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		
		
		$data['theme']=$theme;
		$meta_setting=meta_setting();
		$pageTitle=ucfirst($task_detail->task_name).' - '.$meta_setting->title;
		$metaDescription=ucfirst($task_detail->task_name).' - '.$meta_setting->meta_description;
		$metaKeyword=ucfirst($task_detail->task_name).' - '.$meta_setting->meta_keyword;
		
		$this->template->write('pageTitle',$pageTitle,TRUE);
		$this->template->write('metaDescription',$metaDescription,TRUE);
		$this->template->write('metaKeyword',$metaKeyword,TRUE);
		$this->template->write_view('header',$theme .'/layout/common/header_home',$data,TRUE);
		$this->template->write_view('content_center',$theme .'/layout/task/task_detail',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
	}
	
	
	/*
	Function name :task_detail_comment()
	Parameter : $task_name (Posted Task SEO friendly URL name), 
	Return : none
	Use : User can see the task public conversation page with . 
	Description : user can see the public conversation page using this function which called http://hostname/task/task_detail_comment/$task_name                  or 
	              SEO friendly URL which is declare in config route.php file  http://hostname/tasks/$task_name/comments
	*/
	
	function task_detail_comment($task_name)
	{
	
		
		if($task_name=='')
		{
			redirect('map');
		}
				
		
		 $task_detail = $this->task_model->get_tasks_details($task_name);
		
		if(is_numeric($task_detail))
		{
			if($task_detail=='' || $task_detail==0)
			{
				redirect('map');
			}
		}
		
		$data['task_detail']=$task_detail;
		
		$data['task_name']=$task_name;
				
		$task_id=$task_detail->task_id;		
		$data['task_id'] = $task_id;
		
		
		$user_id = $task_detail->user_id;
		$task_user_detail = $this->user_model->get_user_info($user_id);
		$data['task_user_detail']=$task_user_detail;
		
		$comments=$this->task_model->get_comments($task_id);
		$data['comments']=$comments;	
		
		
		$offers_on_task=$this->task_model->get_task_offer($task_id);
		$data['offers_on_task']=$offers_on_task;	
		
		
		$data['additional_information']  = $this->additional_information_model->get_all_information($task_id);
			
			
		$data['msg']='';
		$data['task_comment_id']='';
		
		$category_id = $task_detail->task_category_id;
		
		$similar_tasks = $this->task_model->get_similar_tasks($category_id,$task_id);
		$data['similar_tasks']=$similar_tasks;
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		
		
		$data['theme']=$theme;
		$meta_setting=meta_setting();
		$pageTitle=ucfirst($task_detail->task_name).' - '.$meta_setting->title;
		$metaDescription=ucfirst($task_detail->task_name).' - '.$meta_setting->meta_description;
		$metaKeyword=ucfirst($task_detail->task_name).' - '.$meta_setting->meta_keyword;
		
		$this->template->write('pageTitle',$pageTitle,TRUE);
		$this->template->write('metaDescription',$metaDescription,TRUE);
		$this->template->write('metaKeyword',$metaKeyword,TRUE);
		$this->template->write_view('header',$theme .'/layout/common/header_home',$data,TRUE);
		$this->template->write_view('content_center',$theme .'/layout/task/task_detail_comment',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
	}
	
	
	/*
	Function name :checkcontentemail()
	Parameter : $task_comment (Posted comment), 
	Return : boolean
	Use : system check that no one can send the email address in message untill the task assigned. 
	Description : system check that no one can send the email address in message using this function which called by JQUERY AJAX function in validation.js file  http://hostname/task/checkcontentemail
	*/
	
	
	
	function checkcontentemail()
	{
		
		  echo json_encode($this->detectContentEmail( $_POST['task_comment']));
   		 exit; // only print out the json version of the response
	
	}
	
	
	/*
	Function name :detectContentEmail()
	Parameter : $task_comment (Posted comment), 
	Return : boolean
	Use : system check that no one can send the email address in message untill the task assigned. 
	Description : system check that no one can send the email address in message 
	*/
	
	function detectContentEmail($task_comment) 
	{

		  $task_comment = trim($task_comment); // strip any white space
		  $response = array(); // our response
		  
		  
		  
		  
		  // if the username is blank
		  if (!$task_comment) {
			$response = array(
			  'ok' => false, 
			 );
			 
			 
			  
		  // if the username does not match a-z or '.', '-', '_' then it's not valid
		  }  else {
			
			
			$detect_emails = get_emails($task_comment);
				
				if($detect_emails)
				{
					$response = array(
					  'ok' => false, 
					  );
				}
				else
				{
					$response = array(
					  'ok' => true, 
					  );
				}
		  }
		
		  return $response;        
	}
	
	

	
	/*
	Function name :ask_question()
	Parameter : $task_id (Posted task ID), 
	Return : boolean
	Use : runner can ask public question untill task is not assign.
	Description : runner ask question to task poster from task detail page which open in fancybox iframe this function which called by http://hostname/task/ask_question/$task_id
	*/
	
	
	function ask_question($task_id)
	{
		if(!check_user_authentication()) {  redirect('sign_up'); }
		
		
		if($task_id=='' || $task_id==0)
		{
			echo '<script>jQuery("#askquestion").onload(function(){
  		 jQuery.fancybox.close();
    });</script>';
			redirect('home');
		}
		
		
		
		$data['task_id'] = $task_id;
		
		$get_task_detail=$this->task_model->get_tasks_detail_by_id($task_id);
		
		$task_name=$get_task_detail->task_url_name;
		
		 $task_detail = $this->task_model->get_tasks_details($task_name);
		 $data['task_detail']=$task_detail;
		 
		 
		$user_detail = $this->user_model->get_user_info($task_detail->user_id);
		
		
		$site_setting=site_setting();
		
		
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		
		
		
		$data['theme']=$theme;
				
		
		$this->form_validation->set_rules('task_comment', 'Comment', 'required');
		
				
		$detect=0;
		
		if($_POST)
		{
			if($this->input->post('task_comment')!='')
			{
				$detect_emails = get_emails($this->input->post('task_comment'));
				
				if($detect_emails)
				{
					$detect=1;	
				}	
			}
		}
		
		
		if($this->form_validation->run() == FALSE || $detect==1){
			
				if(validation_errors() || $detect==1)
				{
					if($detect==1)
					{
						$detect_error='<p>You can not add email address in the comment.</p>';
					}
					
					$data["error"] = validation_errors().$detect_error;
				}else{
					$data["error"] = "";
				}
				
			
				$data['task_comment'] = $this->input->post('task_comment');
		} else {
		
				$apply = $this->task_model->add_worker_public_question($task_id);
			    $data["error"] = "Added Comment";
				$data['task_comment'] = $this->input->post('task_comment');
				
				
				
			
				
				redirect('tasks/'.$task_name);
		}

		
		
		
		$this->load->view($theme .'/layout/task/ask_question',$data);
	}
	
	

	
	/*
	Function name :post_message()
	Parameter : $task_id (Posted task ID), $task_comment_id (runner question ID) 
	Return : boolean
	Use : task poster reply to runner question.
	Description : task poster reply to runner question from task detail page which open in fancybox iframe this function which called by http://hostname/task/post_message/$task_id
	*/
	
	
	
	function post_message($task_id,$task_comment_id='')
	{
		if(!check_user_authentication()) {  redirect('sign_up'); }
		
		
		if($task_id=='' || $task_id==0)
		{
			echo '<script>jQuery("#postmessage'.$task_comment_id.'").onload(function(){
  		 jQuery.fancybox.close();
    });</script>';
			redirect('home');
		}
		
		
		$data['task_comment_id']=$task_comment_id;
		
		$data['task_id'] = $task_id;
		
		$get_task_detail=$this->task_model->get_tasks_detail_by_id($task_id);
		
		$task_name=$get_task_detail->task_url_name;
		
		 $task_detail = $this->task_model->get_tasks_details($task_name);
		 $data['task_detail']=$task_detail;
		 
		 
		$user_detail = $this->user_model->get_user_info($task_detail->user_id);
		
		
		$site_setting=site_setting();
		
		
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		
		
		
		$data['theme']=$theme;
				
		
		$this->form_validation->set_rules('task_comment', 'Comment', 'required');
		
		if($this->form_validation->run() == FALSE){
			
				if(validation_errors())
				{
					$data["error"] = validation_errors();
				}else{
					$data["error"] = "";
				}
				
			
				$data['task_comment'] = $this->input->post('task_comment');
		} else {
		
				$apply = $this->task_model->add_task_owner_public_message($task_id,$task_comment_id);
			    $data["error"] = "Added Comment";
				$data['task_comment'] = $this->input->post('task_comment');
				
				
				
			
				
				redirect('tasks/'.$task_name);
		}

		
		
		
		$this->load->view($theme .'/layout/task/post_message',$data);
	}
	
	
	
	/*
	Function name :offer_task()
	Parameter : $task_id (Posted task ID)
	Return : boolean
	Use : runner offer on task untill the task is not assign
	Description : runner offer on task from task detail page which open in fancybox iframe this function which called by http://hostname/task/offer_task/$task_id
	*/
	
	
	function offer_task($task_id=0)
	{

		if(!check_user_authentication()) {  redirect('sign_up'); }
		
		
		if($task_id=='' || $task_id==0)
		{
			echo '<script>jQuery("#offer_task").onload(function(){
  		 jQuery.fancybox.close();
    });</script>';
			redirect('home');
		}
		
		
		
		$data['task_id'] = $task_id;
		
		$get_task_detail=$this->task_model->get_tasks_detail_by_id($task_id);
		
		$task_name=$get_task_detail->task_url_name;
		
		 $task_detail = $this->task_model->get_tasks_details($task_name);
		 $data['task_detail']=$task_detail;
		 
		 
			$user_detail = $this->user_model->get_user_info($task_detail->user_id);
		$offer_user_detail = $this->user_model->get_user_info(get_authenticateUserID());
		
		$site_setting=site_setting();
		
		
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		
		
		
		$data['theme']=$theme;
		$meta_setting=meta_setting();
		
		$this->form_validation->set_rules('offer_amount', 'Offer Amount', 'required|numeric');
		$this->form_validation->set_rules('task_comment', 'Comment', 'required');
		
		if($this->form_validation->run() == FALSE){
			
				if(validation_errors())
				{
					$data["error"] = validation_errors();
				}else{
					$data["error"] = "";
				}
				
				$data['offer_amount'] = $this->input->post('offer_amount');
				$data['task_comment'] = $this->input->post('task_comment');
		} else {
		
				$apply = $this->task_model->add_worker_offer($task_id);
			    $data["error"] = "Added Comment";
				$data['offer_amount'] = $this->input->post('offer_amount');
				$data['task_comment'] = $this->input->post('task_comment');
				
				
				
				
					$notification = notification_setting($task_detail->user_id);
				$worker_notification = notification_setting(get_authenticateUserID());
				
				$offer_user_link ='<a href="'.base_url().'user/'.$offer_user_detail->profile_name.'">'.ucfirst($offer_user_detail->full_name).'</a>';
				$task_link ='<a href="'.base_url().'tasks/'.$task_detail->task_url_name.'">'.$task_detail->task_name.'</a>';
				
				/////////////============offer time  to poster start===========	
				if(isset($notification->on_comment_or_offer_task)) {  

					if($notification->on_comment_or_offer_task==1) { 
					
						$email_template=$this->db->query("select * from ".$this->db->dbprefix('email_template')." where task='Offer Time (Poster)'");
						$email_temp=$email_template->row();
						
						
						$email_address_from=$email_temp->from_address;
						$email_address_reply=$email_temp->reply_address;
						
						$email_subject=$email_temp->subject;				
						$email_message=$email_temp->message;			
						
										
						$email_to=$user_detail->email;		
	
						
						$email_message=str_replace('{break}','<br/>',$email_message);
						$email_message=str_replace('{poster_name}',ucfirst($user_detail->full_name),$email_message);		
						$email_message=str_replace('{worker_name}',$offer_user_link,$email_message);		
						$email_message=str_replace('{offer_price}',$site_setting->currency_symbol.$this->input->post('offer_amount'),$email_message);
						$email_message=str_replace('{task_name}',$task_link,$email_message);
						
						$str=$email_message;
											
						/** custom_helper email function **/
							
						email_send($email_address_from,$email_address_reply,$email_to,$email_subject,$str);
					}
				}
					
				/////////////============offer time  to poster end===========	
				
				/////////////============offer time  to worker start===========	
				if(isset($worker_notification->on_comment_or_offer_task)) {  

					if($worker_notification->on_comment_or_offer_task==1) {
					
						$email_template=$this->db->query("select * from ".$this->db->dbprefix('email_template')." where task='Offer Time (Worker)'");
						$email_temp=$email_template->row();
						
						
						$email_address_from=$email_temp->from_address;
						$email_address_reply=$email_temp->reply_address;
						
						$email_subject=$email_temp->subject;				
						$email_message=$email_temp->message;			
						
										
						$email_to=$offer_user_detail->email;		
						
						$email_message=str_replace('{break}','<br/>',$email_message);	
						$email_message=str_replace('{worker_name}',ucfirst($offer_user_detail->full_name),$email_message);		
						$email_message=str_replace('{offer_price}',$site_setting->currency_symbol.$this->input->post('offer_amount'),$email_message);
						$email_message=str_replace('{task_name}',$task_link,$email_message);
						
						$str=$email_message; 
						
						/** custom_helper email function **/
							
						email_send($email_address_from,$email_address_reply,$email_to,$email_subject,$str);
					}
				}
				
				/////////////============offer time  to worker end===========	
				
				
				
				redirect('tasks/'.$task_name);
		}

		
		
		
		$this->load->view($theme .'/layout/task/offer_task',$data);
		
	}
	
	
	
	
	/*
	Function name :edit_offer_on_task()
	Parameter : $task_id (Posted task ID), $task_comment_id (task offer id)
	Return : boolean
	Use : runner can edit his/her offer on task untill the task is not assign
	Description : runner can edit offer on task from task detail page which open in fancybox iframe this function which called by http://hostname/task/edit_offer_on_task/$task_id/$task_comment_id
	*/
	
	function edit_offer_on_task($task_id,$task_comment_id)
	{
		
		if(!check_user_authentication()) {  redirect('sign_up'); }
		
		
		if($task_id=='' || $task_id==0 || $task_comment_id==0 || $task_comment_id=='')
		{
			
					echo '<script>jQuery("#edit_offer").onload(function(){
				 jQuery.fancybox.close();
			});</script>';
	
	
			redirect('home');
		}
		
	
		$get_task_detail=$this->task_model->get_tasks_detail_by_id($task_id);
		
		
		if(!$get_task_detail)
		{
					echo '<script>jQuery("#edit_offer").onload(function(){
				 jQuery.fancybox.close();
			});</script>';
	
			redirect('home');
		}
		
		
		
		$get_offer_detail=$this->task_model->get_offer_detail_by_id($task_id,$task_comment_id);
		
		
		if(!$get_offer_detail)
		{
					echo '<script>jQuery("#edit_offer").onload(function(){
				 jQuery.fancybox.close();
			});</script>';
	
			redirect('home');
		}
		
		
		
		$data['task_comment_id']=$task_comment_id;
		$data['get_offer_detail']=$get_offer_detail;
		
		$data['task_id'] = $task_id;
		
		$get_task_detail=$this->task_model->get_tasks_detail_by_id($task_id);
		
		$task_name=$get_task_detail->task_url_name;
		
		 $task_detail = $this->task_model->get_tasks_details($task_name);
		 $data['task_detail']=$task_detail;
		 
		 
			$user_detail = $this->user_model->get_user_info($task_detail->user_id);
		$offer_user_detail = $this->user_model->get_user_info(get_authenticateUserID());
		
		$site_setting=site_setting();
		
		
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		
		
		
		$data['theme']=$theme;
		$meta_setting=meta_setting();
		
		$this->form_validation->set_rules('offer_amount', 'Offer Amount', 'required|numeric');
		$this->form_validation->set_rules('task_comment', 'Comment', 'required');
		
		if($this->form_validation->run() == FALSE){
			
				if(validation_errors())
				{
					$data["error"] = validation_errors();
				}else{
					$data["error"] = "";
				}
				
				
				if($_POST)
				{
					$data['offer_amount'] = $this->input->post('offer_amount');
					$data['task_comment'] = $this->input->post('task_comment');
				}
				
				else
				{
					$data['offer_amount']=$get_offer_detail->offer_amount;
					$data['task_comment']=$get_offer_detail->task_comment;
				}
				
		} else {
		
				$update_offer = $this->task_model->edit_worker_offer($task_id,$task_comment_id);
				
				
			    $data["error"] = "Offer Updated.";
				$data['offer_amount'] = $this->input->post('offer_amount');
				$data['task_comment'] = $this->input->post('task_comment');
				
				
				
				
				$notification = notification_setting($task_detail->user_id);
				$worker_notification = notification_setting(get_authenticateUserID());
				
				$offer_user_link ='<a href="'.base_url().'user/'.$offer_user_detail->profile_name.'">'.ucfirst($offer_user_detail->full_name).'</a>';
				$task_link ='<a href="'.base_url().'tasks/'.$task_detail->task_url_name.'">'.$task_detail->task_name.'</a>';
				
				/////////////============offer time  to poster start===========	
				if(isset($notification->on_comment_or_offer_task)) {  

					if($notification->on_comment_or_offer_task==1) {
					
					
					$email_template=$this->db->query("select * from ".$this->db->dbprefix('email_template')." where task='Edit Offer Time (Poster)'");
						$email_temp=$email_template->row();
						
						
						$email_address_from=$email_temp->from_address;
						$email_address_reply=$email_temp->reply_address;
						
						$email_subject=$email_temp->subject;				
						$email_message=$email_temp->message;			
						
										
						$email_to=$user_detail->email;		
	
						
						$email_message=str_replace('{break}','<br/>',$email_message);
						$email_message=str_replace('{poster_name}',ucfirst($user_detail->full_name),$email_message);		
						$email_message=str_replace('{worker_name}',$offer_user_link,$email_message);		
						$email_message=str_replace('{offer_price}',$site_setting->currency_symbol.$this->input->post('offer_amount'),$email_message);
						$email_message=str_replace('{task_name}',$task_link,$email_message);
						
						$str=$email_message;
											
						/** custom_helper email function **/
							
						email_send($email_address_from,$email_address_reply,$email_to,$email_subject,$str);
					
					}
				}
					
				/////////////============offer time  to poster end===========	
				
				/////////////============offer time  to worker start===========	
				if(isset($worker_notification->on_comment_or_offer_task)) {  

					if($worker_notification->on_comment_or_offer_task==1) {
					
					
					
					$email_template=$this->db->query("select * from ".$this->db->dbprefix('email_template')." where task='Edit Offer Time (Worker)'");
						$email_temp=$email_template->row();
						
						
						$email_address_from=$email_temp->from_address;
						$email_address_reply=$email_temp->reply_address;
						
						$email_subject=$email_temp->subject;				
						$email_message=$email_temp->message;			
						
										
						$email_to=$offer_user_detail->email;		
						
						$email_message=str_replace('{break}','<br/>',$email_message);	
						$email_message=str_replace('{worker_name}',ucfirst($offer_user_detail->full_name),$email_message);		
						$email_message=str_replace('{offer_price}',$site_setting->currency_symbol.$this->input->post('offer_amount'),$email_message);
						$email_message=str_replace('{task_name}',$task_link,$email_message);
						
						$str=$email_message; 
						
						/** custom_helper email function **/
							
						email_send($email_address_from,$email_address_reply,$email_to,$email_subject,$str);
					
					
					
					}
				}
				
				/////////////============offer time  to worker end===========	
				
		
				
		
				$msg='fail_update';
				if($update_offer==1)
				{
					$msg='offer_update';
				}			
				
				redirect('tasks/'.$task_name.'/'.$msg);
				
		}

		
		
		
		$this->load->view($theme .'/layout/task/edit_offer_task',$data);
		
		
	}
	
	
	/*
	Function name :remove_offer_on_task()
	Parameter : $task_id (Posted task ID)
	Return : boolean
	Use : runner can remove his/her offer on task untill the task is not assign
	Description : runner can remove offer on task from task detail page which open in fancybox iframe this function which called by http://hostname/task/remove_offer_on_task/$task_id/
	*/
	
	
	function remove_offer_on_task($task_id)
	{
		
		if(!check_user_authentication()) {  redirect('sign_up'); }
		
		
		if($task_id=='' || $task_id==0)
		{
			redirect('home');
		}
		
	
		$get_task_detail=$this->task_model->get_tasks_detail_by_id($task_id);
		
		
		if(!$get_task_detail)
		{
			redirect('home');
		}
		
		$remove=$this->task_model->remove_offer_on_task($task_id);
		
		$msg='fail_remove';
		if($remove==1)
		{
			$msg='remove';
		}
		
		
		redirect('tasks/'.$get_task_detail->task_url_name.'/'.$msg);
	
	}
	
	
	
	
	
	/*
	Function name :accept_offer()
	Parameter : $task_id (Posted task ID), $task_comment_id (runner offer ID)
	Return : boolean
	Use : task poster accept the runner offer from task detail page and assign the task to runner.
	Description : task poster accept the runner offer from task detail page this function which called by http://hostname/task/accept_offer/$task_id/$task_comment_id
	*/
	
	
	
	function accept_offer($task_id,$task_comment_id)
	{
		
		if(!check_user_authentication()) {  redirect('sign_up'); }
		
		if($task_id=='' || $task_id==0)
		{
			redirect('home');
		}
		
			
		if($task_comment_id=='' || $task_comment_id==0)
		{
			redirect('home');
		}
		
				
		$data['task_id'] = $task_id;
		
		$get_task_detail=$this->task_model->get_tasks_detail_by_id($task_id);
		
		$task_name=$get_task_detail->task_url_name;
		
		 $task_detail = $this->task_model->get_tasks_details($task_name);
		 $data['task_detail']=$task_detail;
		 
		 
		$user_detail = $this->user_model->get_user_info($task_detail->user_id);
		
		
		
				///////==========total amount====
				
				$task_setting=task_setting();
				
				$total=0;
				
				if($task_detail->extra_cost>0) {
				
				$total=$total+$task_detail->extra_cost;
				
				}
				
				
				
				////===get worker offer price=====
		
		$worker_id='';
		
		$get_worker_detail=$this->db->query("select * from ".$this->db->dbprefix('user')." us, ".$this->db->dbprefix('user_profile')." up, ".$this->db->dbprefix('worker')." wrk, ".$this->db->dbprefix('worker_comment')." cmt where cmt.comment_post_user_id=us.user_id and us.user_id=up.user_id and us.user_id=wrk.user_id and cmt.task_comment_id='".$task_comment_id."'");
		
		
		if($get_worker_detail->num_rows()>0)
		{
	 	
			$comment_detail=$get_worker_detail->row();
			
			$worker_id=$comment_detail->worker_id;
		
				
			$total=$total+$comment_detail->offer_amount;
		 
		}
		 
		 ///////=======
		 
				 
				 
				 if($task_setting->task_post_fee>0) {
				 
				 $task_site_fee=number_format((($task_setting->task_post_fee*$total) / 100),2); 
			
					 $total=$total+$task_site_fee;
			
				}
				 
				 
				  $total=number_format($total,2);
				
				
				
				
				 
				  $wallet_amount=my_wallet_amount();
				
				
				
				
				
				$check_already_pay=0;
				
				
					
					$check_amount_pay=check_task_assign_amount_pay($task_detail->user_id,$task_detail->task_id);
					
					if($check_amount_pay)
					{
						$assign_pay_status=1;
						$assign_time_pay_amount=$check_amount_pay->task_amount;
						
						if($assign_time_pay_amount>=$total)
						{
							$check_already_pay=1;
						}
					}
				
				
				
				/*****************pay now  and open slip type page*****/	
				
				if($check_already_pay==1)
				{
					redirect('tasks/'.$task_name);
				}	
				else
				{
					$this->task_model->assing_task_worker_on_detail_page($task_id,$task_comment_id);
					
					echo "<script>window.location.href='".site_url('user_task/pay_now/'.$task_id)."'</script>";
				}
				
				/*****************end pay now  *****/	
				
				
				/*****************direct accpet or open pop up page for add amount *****/
				
			/*	if($total>$wallet_amount)
				{
						redirect('tasks/'.$task_name.'/no/'.$task_comment_id);
				}
				elseif($check_already_pay==1)
				{
					redirect('tasks/'.$task_name);
				}	
				
				
						
				
				else
				{
					
					
				
					$this->task_model->assign_now($task_id,$task_comment_id);
					
					
					$site_setting=site_setting();
					$user_detail = $this->user_model->get_user_info(get_authenticateUserID());
					$poster_link = '<a href="'.base_url().'user/'.$user_detail->profile_name.'">'.ucfirst($user_detail->full_name).'</a>';
					$task_link ='<a href="'.base_url().'tasks/'.$task_detail->task_url_name.'">'.$task_detail->task_name.'</a>';
						
					$notification = notification_setting(get_authenticateUserID());
					
					
					/////////////============Post task start===========	
					if(isset($notification->on_assign_task)) {  
		
						if($notification->on_assign_task==1) {  	
						
							$email_template=$this->db->query("select * from ".$this->db->dbprefix('email_template')." where task='Pay amount of Task (Poster)'");
							$email_temp=$email_template->row();
							
							
							$email_address_from=$email_temp->from_address;
							$email_address_reply=$email_temp->reply_address;
							
							$email_subject=$email_temp->subject;				
							$email_message=$email_temp->message;			
							
			
							$email_to=$user_detail->email;
						
							$email_message=str_replace('{break}','<br/>',$email_message);
							$email_message=str_replace('{pay}',$site_setting->currency_symbol.$total,$email_message);
							$email_message=str_replace('{poster_name}',$user_detail->full_name,$email_message);				
							$email_message=str_replace('{task_name}',$task_link,$email_message);
							
							
							$str=$email_message; 
												
							
								
							email_send($email_address_from,$email_address_reply,$email_to,$email_subject,$str);
						}
					}
							
					/////////////============Post task end===========
					
					/////////////============Post task admin start===========	
		
						$email_template=$this->db->query("select * from ".$this->db->dbprefix('email_template')." where task='Pay amount of Task (Admin)'");
						$email_temp=$email_template->row();
						
						
						$email_address_from=$email_temp->from_address;
						$email_address_reply=$email_temp->reply_address;
						
						$email_subject=$email_temp->subject;				
						$email_message=$email_temp->message;			
						
		
						$email_to=$email_temp->reply_address;
						
									
						$email_message=str_replace('{break}','<br/>',$email_message);
						$email_message=str_replace('{poster_name}',$poster_link,$email_message);
						$email_message=str_replace('{pay}',$site_setting->currency_symbol.$total,$email_message);				
						$email_message=str_replace('{task_name}',$task_link,$email_message);
						
						
						$str=$email_message; 
													
						email_send($email_address_from,$email_address_reply,$email_to,$email_subject,$str);
							
					/////////////============Post task admin end===========
					
					
					
					
					
						redirect('tasks/'.$task_name.'/assign');
		
				}
				
			*/
		
				/////===total amount==========
				
				
				/*****************end   direct accpet or open pop up for add amount *****/
		
	
	}	
	
	
	
	/*
	Function name :add_amount()
	Parameter : $task_id (Posted task ID), $task_comment_id (runner offer ID)
	Return : boolean
	Use : task poster can add amount in his/her wallet if task poster have not sufficient amount in his wallet at the time of accept offer
	Description : task poster can add amount from task detail page this function which called by http://hostname/task/add_amount/$task_id/$task_comment_id
	*/
	
	
	function add_amount($task_id,$task_comment_id)
	{
	
			
	    $site_setting=site_setting();
		$wallet_setting=$this->wallet_model->wallet_setting();		
		if($wallet_setting->wallet_enable==0)
		{
			redirect('dashboard');
		}		
		
			
			
			$data['task_id'] = $task_id;
			$data['task_comment_id']=$task_comment_id;
		
		$get_task_detail=$this->task_model->get_tasks_detail_by_id($task_id);
		
		$task_name=$get_task_detail->task_url_name;
		
		 $task_detail = $this->task_model->get_tasks_details($task_name);
		 $data['task_detail']=$task_detail;
		 
		 
		$user_detail = $this->user_model->get_user_info($task_detail->user_id);
		
		
			///////==========total amount====
				
			$task_setting=task_setting();
			
			$total=0;
			
			if($task_detail->extra_cost>0) {
			
			$total=$total+$task_detail->extra_cost;
			
			}
			
			
			
			////===get worker offer price=====
	
			$worker_id='';
			
			$get_worker_detail=$this->db->query("select * from ".$this->db->dbprefix('user')." us, ".$this->db->dbprefix('user_profile')." up, ".$this->db->dbprefix('worker')." wrk, ".$this->db->dbprefix('worker_comment')." cmt where cmt.comment_post_user_id=us.user_id and us.user_id=up.user_id and us.user_id=wrk.user_id and cmt.task_comment_id='".$task_comment_id."'");
			
			
			if($get_worker_detail->num_rows()>0)
			{
			
				$comment_detail=$get_worker_detail->row();
				
				$worker_id=$comment_detail->worker_id;
			
					
				$total=$total+$comment_detail->offer_amount;
			 
			}
			 
			 ///////=======
	 
			 
			 
			 if($task_setting->task_post_fee>0) {
			 
			 $task_site_fee=number_format((($task_setting->task_post_fee*$total) / 100),2); 
		
				 $total=$total+$task_site_fee;
		
			}
				 
				 
				  $total=number_format($total,2);
				
				
		
				$minimum_amount=$total;		
		
		
				///////==========total amount====
				
				
		
		$chk_amt=$this->input->post('credit');		
		$amount_error='success';		
		if($this->input->post('credit')) 
		{
		
			if($chk_amt<$minimum_amount)
			{
				$amount_error='fail';			
			}
		
		}
		
		$this->load->library('form_validation');		
		$this->form_validation->set_rules('credit', "Amount", 'required|numeric');
		$this->form_validation->set_rules('gateway_type', "Gateway Type", 'required');
		
		if($this->form_validation->run() == FALSE || $amount_error=='fail')
		{	
				if($amount_error=='fail')
				{
					$amount_error="<p>"."You can not add less then amount ".$site_setting->currency_symbol.$minimum_amount." in wallet.</p>";
				}
				else
				{
					$amount_error='';
				}	
			
				if(validation_errors() || $amount_error!='')
				{
					$data['error'] = validation_errors().$amount_error;
							
				} else{
					$data["error"] = "";
				}	
		
				$data['payment'] = $this->wallet_model->get_paymentact_result();				
				$data['wallet_setting']=$wallet_setting;		
				$data["credit"] = $minimum_amount;
				$data["gateway_type"] = $this->input->post('gateway_type');				
				$data['total_wallet_amount']=$this->wallet_model->my_wallet_amount(); 			
				
			
				$theme = getThemeName();
				$data['site_setting']=site_setting();
				$this->template->set_master_template($theme .'/template.php');				
				$data['theme']=$theme;				
				$meta_setting=meta_setting();
				$user_info = $this->user_model->get_user_info(get_authenticateUserID());				
				$pageTitle='Deposit-'.$user_info->first_name.' '.substr($user_info->last_name,0,1).' - '.$meta_setting->title;
				$metaDescription='Deposit-'.$user_info->first_name.' '.substr($user_info->last_name,0,1).' - '.$meta_setting->meta_description;
				$metaKeyword='Deposit-'.$user_info->first_name.' '.substr($user_info->last_name,0,1).' - '.$meta_setting->meta_keyword;	
			
				$this->load->view($theme .'/layout/task/add_wallet',$data);
			
			}
			else
			{	
				$gateway_id=$this->input->post('gateway_type');	
				$wallet_add_fees=$wallet_setting->wallet_add_fees;
				$amount=$this->input->post('credit');
		    	//$add_fees= number_format((($amount * $wallet_add_fees)/100),2);
				//$total= number_format(($add_fees + $amount),2);				
				
				$total=$amount;
				
				$total= str_replace(',','',$total);
				
				$modname='wallet';
			    $pay=$this->wallet_model->get_paymentid_result($gateway_id);	
				//var_dump($pay);exit;
				redirect('/wallet/'.trim($pay->function_name).'/'.$pay->id.'/'.$total.'/'.$task_id.'/'.$task_comment_id);		
				
			}
	
	}
	
	
	
	
	////-----------------TASK POSTING PART--------------------------
	
	
	/*
	Function name :new_task()
	Parameter : $task_assign_worker (runner ID)
	Return : integer $task_id
	Use : user can post new task by clicking on the "Post Task" button or "Hire" button.
	Description : user can post new task at that time task save as a status = 3(as a spam) and  this function which called by http://hostname/task/new_task/
	*/
	
	
	function new_task($task_assign_worker='')
	{
		$task_assign_worker;
		if(!check_user_authentication()) { redirect('sign_up'); }
		
		
		$data['task_detail']='';
		$data['task_id']='';
		$data['task_assign_worker']='';
		
		if($task_assign_worker != '' && $task_assign_worker !=0)
		{
			$data['task_assign_worker'] = $task_assign_worker;
		}
		
		$task_id= $this->task_model->save_step_zero();
		if($task_id != 0) { redirect('task/step_one/'.$task_id); }
		
		
		
		
		$data['copy']= '';
		$theme = getThemeName();
		$this->template->set_master_template($theme . '/template.php');
		$data['theme'] = $theme;
		$limit=5;
		$data['taskers'] = $this->worker_model->get_top_worker($limit);
		$data['categories'] = $this->task_model->get_all_categories();
		
		$meta_setting = meta_setting();
		
		$this->load->view($theme . '/layout/task/new_task', $data);
	
	}
	
	
	
	/*
	Function name :update_task_step_zero()
	Parameter : $task_id (newly posted task ID), $copy (already posted task ID)
	Return : integer $task_id
	Use : user can update task by clicking on the "Change" button or Post same task that already post by other user by clicking on "Use Template" button or "Copy" button.
	Description : user can update task detail or post same task that already post by other user at that time task save as a status = 3 and  this function which called by http://hostname/task/update_task_step_zero/$task_id/$copy
	*/
	
	
	function update_task_step_zero($task_id, $copy='')
	{
	
		if(!check_user_authentication()) { redirect('sign_up'); }
		if(($task_id == 0) && ($task_id = '')) { redirect('dashboard'); }
		
		if($_POST)
		{
			if($this->input->post('copy') != ''){
			$task_id= $this->task_model->save_step_zero($task_id);
			} else {
			$this->task_model->update_task_step_zero($task_id);
		}
			redirect('task/step_one/'.$task_id);
		
		}
		
		$task_detail=$this->task_model->get_task_detail($task_id);
		$data['task_detail']=$task_detail;
		$data['task_id']=$task_id;
		$data['copy'] = $copy;
		$data['task_assign_worker']='';
		
		$theme = getThemeName();
		$this->template->set_master_template($theme . '/template.php');
		$data['theme'] = $theme;
		$limit=5;
		
		$data['taskers'] = $this->worker_model->get_top_worker($limit);
		
		
		$data['categories'] = $this->task_model->get_all_categories();
		
		$meta_setting = meta_setting();
		
		$this->load->view($theme.'/layout/task/new_task', $data);
	
	
	}
		
	
	
	/*
	Function name :step_one()
	Parameter : $task_id (newly posted task ID)
	Return : integer $task_id
	Use : user can update task detail step 1.
	Description : user can update task detail at that time task save as a status = 2 (as a draft) and  this function which called by http://hostname/task/step_one/$task_id/.
	*/
	
	
	function step_one($task_id)
	{
		
		if(!check_user_authentication()) {  redirect('sign_up'); }
		if(($task_id == 0) && ($task_id = '')) {  redirect('dashboard'); }	
		
		$check_task_exsits=$this->task_model->check_user_task($task_id);
		
		if(!$check_task_exsits) { redirect('dashboard'); }	
		
			$site_setting=site_setting();
		$data['task_id'] = $task_id;
		
		$task_detail=$this->task_model->get_task_detail($task_id);
		$data['task_detail']=$task_detail;
		
		$this->form_validation->set_rules('task_name', 'Task Title', 'required|min_length[10]');
	  	$this->form_validation->set_rules('task_description', 'Task Description', 'required|min_length[15]'); 
		$this->form_validation->set_rules('task_price', 'From Amount', 'required|number');
		$this->form_validation->set_rules('task_to_price', 'To Amount', 'required|number');
		
		if($this->input->post('task_online')==0 || $this->input->post('task_online')=='')
		{
			
			if($this->input->post('user_location_id'))
			{
			
			}
			else
			{
			
			$this->form_validation->set_rules('address1', 'Address', 'required|trim');
			$this->form_validation->set_rules('zipcode', 'Postal Code', 'trim|required|alpha_numeric|min_length['.$site_setting->zipcode_min.']|max_length['.$site_setting->zipcode_max.']');	
			$this->form_validation->set_rules('locationname', 'Location Name', 'required|trim');
			
			}
			
		}
		
		
		if($this->input->post('extra_cost')>0)
		{
			$this->form_validation->set_rules('extra_cost_description', 'Extra Cost Description', 'required');
		}
		
		
		if($this->input->post('other_cost')>0)
		{
			$this->form_validation->set_rules('other_cost_description', 'Other Cost Description', 'required');
		}
		
		
		
		
		
		
		$day_error='';
		
		if($this->input->post('task_start_day')>$this->input->post('task_end_day'))
		{
				$day_error='<p>Task End date must be greater or equal to the start date.</p>';
		}
		
		
		
		if($this->form_validation->run() == FALSE || $day_error!=''){
				
			if(validation_errors() || $day_error!='')
			{
				$data["error"] = validation_errors().$day_error;
			}else{
				$data["error"] = "";
			}
			
			
			if($_POST)
			{
				$data['task_name'] = $this->input->post('task_name');
				$data['task_description'] = $this->input->post('task_description');
				$data['task_price'] = $this->input->post('task_price');
				$data['more_details'] = $this->input->post('more_details');
				$data['task_price'] = $this->input->post('task_price');
				$data['task_to_price'] = $this->input->post('task_to_price');
				
				$data['task_start_day'] = $this->input->post('task_start_day');
				$data['task_start_time'] = $this->input->post('task_start_time');
				$data['task_end_day'] = $this->input->post('task_end_day');
				$data['task_end_time'] = $this->input->post('task_end_time');
				
				$data['task_is_private'] = $this->input->post('task_is_private');
				$data['task_large_vehicals'] = $this->input->post('task_large_vehicals');
				$data['task_online'] = $this->input->post('task_online');
				
				$data['extra_cost']=$this->input->post('extra_cost');
				$data['extra_cost_description']=$this->input->post('extra_cost_description');
				$data['other_cost']=$this->input->post('other_cost');
				$data['other_cost_description']=$this->input->post('other_cost_description');
			}
			
			else
			{
			
				$data['task_name'] = $task_detail->task_name;
				$data['task_description'] = $task_detail->task_description;
				$data['task_price'] = $task_detail->task_price;
				$data['more_details'] = $task_detail->more_details;
				$data['task_price'] = $task_detail->task_price;
				$data['task_to_price'] = $task_detail->task_to_price;
				
				$data['task_start_day'] = $task_detail->task_start_day;
				$data['task_start_time'] = $task_detail->task_start_time;
				$data['task_end_day'] =$task_detail->task_end_day;
				$data['task_end_time'] = $task_detail->task_end_time;
				
				$data['task_is_private'] = $task_detail->task_is_private;
				$data['task_large_vehicals'] = $task_detail->task_large_vehicals;
				$data['task_online'] = $task_detail->task_online;
				
				$data['extra_cost']=$task_detail->extra_cost;
				$data['extra_cost_description']=$task_detail->extra_cost_description;
				$data['other_cost']=$task_detail->other_cost;
				$data['other_cost_description']=$task_detail->other_cost_description;
			
			}	
			
			
			
		} else {
		
		
			$apply=$this->task_model->save_step_one();
			
			$data["error"] = "updated";
			$data['task_name'] = $this->input->post('task_name');
			$data['task_description'] = $this->input->post('task_description');
			$data['task_price'] = $this->input->post('task_price');
			$data['more_details'] = $this->input->post('more_details');
			$data['task_price'] = $this->input->post('task_price');		
			$data['task_to_price'] = $this->input->post('task_to_price');
			
			$data['task_start_day'] = $this->input->post('task_start_day');
			$data['task_start_time'] = $this->input->post('task_start_time');
			$data['task_end_day'] = $this->input->post('task_end_day');
			$data['task_end_time'] = $this->input->post('task_end_time');
			
			
			$data['task_is_private'] = $this->input->post('task_is_private');
			$data['task_large_vehicals'] = $this->input->post('task_large_vehicals');
			$data['task_online'] = $this->input->post('task_online');
			
			$data['extra_cost']=$this->input->post('extra_cost');
			$data['extra_cost_description']=$this->input->post('extra_cost_description');
			$data['other_cost']=$this->input->post('other_cost');
			$data['other_cost_description']=$this->input->post('other_cost_description');
			
				
			redirect('task/pay/'.$task_id);
		}
		
		
		$data['task_location']=$this->task_model->get_task_location($task_id);
		
		$data['user_location']=$this->user_model->get_user_location(get_authenticateUserID());
		
		$data['categories'] = $this->task_model->get_all_categories();
		
		
		
		
		$theme = getThemeName();
		$this->template->set_master_template($theme . '/template.php');
		$data['theme'] = $theme;
	
		$meta_setting = meta_setting();
		
		$pageTitle = 'Post New Task - ' . $meta_setting->title;
		$metaDescription = 'Post New Task - ' . $meta_setting->meta_description;
		$metaKeyword = 'Post New Task - ' . $meta_setting->meta_keyword;
		$this->template->write('pageTitle', $pageTitle, TRUE);
		$this->template->write('metaDescription', $metaDescription, TRUE);
		$this->template->write('metaKeyword', $metaKeyword, TRUE);
		$this->template->write_view('header', $theme . '/layout/common/header_login', $data, TRUE);
		$this->template->write_view('content_center', $theme . '/layout/task/step_one', $data, TRUE);
		$this->template->write_view('footer', $theme . '/layout/common/footer', $data, TRUE);
		$this->template->render();
	}
	
	
	
	
	
	/*
	Function name :pay()
	Parameter : $task_id (newly posted task ID)
	Return : integer $task_id
	Use : user can post the task in step 2. User must have to verify his/her identity using a credit card to protect our runner against mischievous users.
	Description : user can update task detail at that time task save as a status = 1 (posted status) and  this function which called by http://hostname/task/pay/$task_id/.
	*/
	
	function pay($task_id)
	{
	
	
		if(($task_id == 0) && ($task_id = '')) {  redirect('dashboard'); }	
		if(!check_user_authentication()) {  redirect('sign_up'); }	
			
		$check_task_exsits=$this->task_model->check_user_task($task_id);
		
		if(!$check_task_exsits) { redirect('dashboard'); }	
		
			
		$data['task_id'] = $task_id;
		
		
		
		$task_detail=$this->task_model->get_task_detail($task_id);
		$data['task_detail']=$task_detail;
		
		$data['task_location']=$this->task_model->get_task_location($task_id);
		
		$data['user_location']=$this->user_model->get_user_location(get_authenticateUserID());
		
		$user_info=$this->user_model->get_user_info(get_authenticateUserID());
		$data['user_info']=$user_info;		
		
		
		$site_setting=site_setting();
		
		$card_info=$this->stored_card_model->get_user_card_info();		
		$data['card_info']=$card_info;
		
		
		$this->form_validation->set_rules('paymenttype', 'Pay', 'required');
		$this->form_validation->set_rules('task_id', 'Task ID', 'required|integer');
		
		$card_verify_status=0;
		
		if($card_info)
		{
		
		$card_verify_status= $card_info->card_verify_status;
		}
		
		
		/////====if credit card verify required then remove below line
		
		//$card_verify_status=1;
		
		
		if($card_verify_status==0 || $card_verify_status=='') 
		{
		
			$this->form_validation->set_rules('card_first_name', 'First Name', 'required|alpha');
			$this->form_validation->set_rules('card_last_name', 'Last Name', 'required|alpha');
			$this->form_validation->set_rules('cardnumber', 'Card Number', 'required|integer|numeric');	
			$this->form_validation->set_rules('cardtype', 'Card Type', 'required|alpha');
			
			$this->form_validation->set_rules('card_expiration_month', 'Expiration Month', 'required|integer');
			$this->form_validation->set_rules('card_expiration_year', 'Expiration Year', 'required|integer');
			
			if($this->input->post('user_location_id')!='' && $this->input->post('user_location_id')>0 && $this->input->post('user_location_id')!='other')
			{
			
			}
			
			else
			{
				$this->form_validation->set_rules('card_address', 'Address', 'required');
				$this->form_validation->set_rules('card_city', 'City', 'required|alpha_space');
				$this->form_validation->set_rules('card_state', 'State', 'required|alpha_space');
				$this->form_validation->set_rules('card_zipcode', 'Postal Code', 'required|alpha_numeric|min_length['.$site_setting->zipcode_min.']|max_length['.$site_setting->zipcode_max.']');	
				
			}
			
			
		}
		
			
			

		if($this->form_validation->run() == FALSE){
				
			if(validation_errors())
			{
				$data["error"] = validation_errors();
			}else{
				$data["error"] = "";
			}
			
			
			
			
			
			
				if($_POST)
				{
				
					$data['card_first_name']=$this->input->post('card_first_name');
					$data['card_last_name']=$this->input->post('card_last_name');
					$data['cardnumber']=$this->input->post('cardnumber');
					$data['cardtype']=$this->input->post('cardtype');
					$data['card_expiration_month']=$this->input->post('card_expiration_month');
					$data['card_expiration_year']=$this->input->post('card_expiration_year');	
					
					$data['user_location_id']=$this->input->post('user_location_id');	
					$data['card_address']=$this->input->post('card_address');	
					$data['card_city']=$this->input->post('card_city');	
					$data['card_state']=$this->input->post('card_state');	
					$data['card_zipcode']=$this->input->post('card_zipcode');					
					
					$data['card_verify_status']=$card_verify_status;
					
					$data['save_location']=$this->input->post('save_location');	
						
				
				}
				
				else
				{
					
					if($card_info)
					{	
						$data['card_first_name']=$card_info->card_first_name;
						$data['card_last_name']=$card_info->card_last_name;
						$data['cardnumber']=$card_info->card_number;
						$data['cardtype']=$card_info->card_type;
						$data['card_expiration_month']=$card_info->card_expiration_month;
						$data['card_expiration_year']=$card_info->card_expiration_year;						
						
						$data['user_location_id']=$card_info->user_location_id;
						$data['card_address']=$card_info->card_address;
						$data['card_city']=$card_info->card_city;
						$data['card_state']=$card_info->card_state;
						$data['card_zipcode']=$card_info->card_zipcode;
						$data['card_expiration_year']=$card_info->card_expiration_year;
						$data['card_verify_status']=$card_verify_status;
						
						$data['save_location']='';
						
						
					}
					
					else
					{
						
						$data['card_first_name']=$this->input->post('card_first_name');
						$data['card_last_name']=$this->input->post('card_last_name');
						$data['cardnumber']=$this->input->post('cardnumber');
						$data['cardtype']=$this->input->post('cardtype');
						$data['card_expiration_month']=$this->input->post('card_expiration_month');
						$data['card_expiration_year']=$this->input->post('card_expiration_year');	
						
						$data['user_location_id']=$this->input->post('user_location_id');	
						$data['card_address']=$this->input->post('card_address');	
						$data['card_city']=$this->input->post('card_city');	
						$data['card_state']=$this->input->post('card_state');	
						$data['card_zipcode']=$this->input->post('card_zipcode');	
						
						$data['card_verify_status']=$card_verify_status;				
						
						$data['save_location']=$this->input->post('save_location');	
						
					}
					
				}
				
				
			
			
		} else {
		
		
		
		
		if($card_verify_status==0 || $card_verify_status=='') 
		{
		
		$paymentType='Authorization';
		$gateway_id='3';
		$amount=0.1;
		
		////////////////////=============authorize part================
		
		
			$this->load->library('creditcard');		
			$gateways=$this->wallet_model->get_gateway_detailByid($gateway_id);	
			$config=array();		
			
			foreach($gateways as $gatewaydetail)
			{
			$gatewaydetail1=(array) $gatewaydetail;
			$config[$gatewaydetail1["name"]]=$gatewaydetail1["value"];
			
			}
			
			
			$crditobj=$this->creditcard->config($config);
			
			
			/**
			 * Get required parameters from the web form for the request
			 */
			$paymentType =urlencode( $paymentType);
			$firstName =urlencode( $_POST['card_first_name']);
			$lastName =urlencode( $_POST['card_last_name']);
			$creditCardType =urlencode( $_POST['cardtype']);
			$creditCardNumber = urlencode($_POST['cardnumber']);
			$expDateMonth =urlencode( $_POST['card_expiration_month']);
			
			// Month must be padded with leading zero
			$padDateMonth = str_pad($expDateMonth, 2, '0', STR_PAD_LEFT);
			
			$expDateYear =urlencode( $_POST['card_expiration_year']);
			//$cvv2Number = urlencode($_POST['cvv2Number']);
			$cvv2Number='';
			
			
			
			///////===location part====
			
			if($this->input->post('user_location_id')!='' && $this->input->post('user_location_id')>0)
			{
			
				$location_detail=$this->user_model->get_user_location_detail($this->input->post('user_location_id'));
				
				if($location_detail)
				{
					$address1 = urlencode($location_detail->location_address);		
					$city = urlencode($location_detail->location_city);
					$state =urlencode( $location_detail->location_state);
					$zip = urlencode($location_detail->location_zipcode);				
				}
				
				else
				{
				
					$address1 = urlencode($_POST['card_address']);		
					$city = urlencode($_POST['card_city']);
					$state =urlencode( $_POST['card_state']);
					$zip = urlencode($_POST['card_zipcode']);
				
				}
			
			}
			
			else
			{
			
				$address1 = urlencode($_POST['card_address']);		
				$city = urlencode($_POST['card_city']);
				$state =urlencode( $_POST['card_state']);
				$zip = urlencode($_POST['card_zipcode']);
			
			}
			
			
			
			$amount = urlencode($amount);
			$currencyCode="USD";
			$paymentType=urlencode($paymentType);
			
			/* Construct the request string that will be sent to PayPal.
			   The variable $nvpstr contains all the variables and is a
			   name value pair string with & as a delimiter */
			$nvpstr="&PAYMENTACTION=$paymentType&AMT=$amount&CREDITCARDTYPE=$creditCardType&ACCT=$creditCardNumber&EXPDATE=".         $padDateMonth.$expDateYear."&CVV2=$cvv2Number&FIRSTNAME=$firstName&LASTNAME=$lastName&STREET=$address1&CITY=$city&STATE=$state".
			"&ZIP=$zip&COUNTRYCODE=US&CURRENCYCODE=$currencyCode";
			
			
			
			/* Make the API call to PayPal, using API signature.
			   The API response is stored in an associative array called $resArray */
			$resArray=$this->creditcard->hash_call("doDirectPayment",$nvpstr);
		//	var_dump($resArray);
			//exit;
			/* Display the API response back to the browser.
			   If the response from PayPal was a success, display the response parameters'
			   If the response was an error, display the errors received using APIError.php.
			   */
			$ack = strtoupper($resArray["ACK"]);
			
			  if($ack!="SUCCESS") 
			  {
				  		$data['error']="fail";
					
						$data['card_first_name']=$this->input->post('card_first_name');
						$data['card_last_name']=$this->input->post('card_last_name');
						$data['cardnumber']=$this->input->post('cardnumber');
						$data['cardtype']=$this->input->post('cardtype');
						$data['card_expiration_month']=$this->input->post('card_expiration_month');
						$data['card_expiration_year']=$this->input->post('card_expiration_year');	
						
						$data['user_location_id']=$this->input->post('user_location_id');	
						$data['card_address']=$this->input->post('card_address');	
						$data['card_city']=$this->input->post('card_city');	
						$data['card_state']=$this->input->post('card_state');	
						$data['card_zipcode']=$this->input->post('card_zipcode');					
						
						$data['save_location']=$this->input->post('save_location');	
						$data['card_verify_status']='';
			   }
			   else
			   {
				  
							
					$txnid=$resArray['TRANSACTIONID'];
				
				 $user_location_id='';
					 
					if($this->input->post('user_location_id')!='' && $this->input->post('user_location_id')>0 && $this->input->post('user_location_id')!='other') 
					{
				 		 $user_location_id=$this->input->post('user_location_id');
				  }
				  
				  
					
				 	 $data_card=array(
						'card_first_name' => $firstName,
						'user_id'=>get_authenticateUserID(),
						'card_last_name' =>  $lastName,
						'card_type' => $creditCardType,
						'card_number' => $creditCardNumber,
						'card_expiration_month' => $expDateMonth,
						'card_expiration_year' => $expDateYear,
						'user_location_id'=>$user_location_id,
						'card_address' => urldecode($address1),
						'card_city' => urldecode($city),
						'card_state' => urldecode($state),
						'card_zipcode'=>urldecode($zip),
						'card_transaction_id'=>$txnid,
						'card_verify_status'=>1,
						'card_date'=>date('Y-m-d H:i:s'),
						'card_ip'=>$_SERVER['REMOTE_ADDR']
					);	
					
					
					$check_record=$this->db->get_where('user_card_info',array('user_id'=>get_authenticateUserID()));
					
					if($check_record->num_rows()>0)
					{		
						$this->db->where('user_id',get_authenticateUserID());
						$update_card=$this->db->update('user_card_info',$data_card);		
					}
					else
					{
						$add_card=$this->db->insert('user_card_info',$data_card);		
					}
					
					
					
					$save_location=$this->input->post('save_location');
			
					if($save_location==1)
					{
					
						$data_location2=array(
							'user_id'=>get_authenticateUserID(),				
							'location_name' => 'Billing',
							'location_address' => urldecode($address1),
							'location_city' => urldecode($city),
							'location_state' => urldecode($state),
							'location_zipcode' => $zip,
							'location_date'=>date('Y-m-d H:i:s'),						
						);
						
						$this->db->insert('user_location',$data_location2);
					
					}
						
					
					
					
		    }
		
		
		}
		
		////////////////////=============authorize part================
		
	
			
			$apply=$this->task_model->pay();
			
			$task_detail=$this->task_model->get_task_detail($task_id);
			
			
					
				
			
			/////////////============Post task start===========	
 				$user_detail = $this->user_model->get_user_info(get_authenticateUserID());
				$task_link ='<a href="'.base_url().'tasks/'.$task_detail->task_url_name.'">'.$task_detail->task_name.'</a>';
				$notification = notification_setting(get_authenticateUserID());
				
				if(isset($notification->on_post_task)) {  

        			 if($notification->on_post_task==1) {   
					 
						$email_template=$this->db->query("select * from ".$this->db->dbprefix('email_template')." where task='Post New Task (Poster)'");
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
				 
			/////////////============Post task end===========
			
			/////////////============Post task admin start===========	

				$email_template=$this->db->query("select * from ".$this->db->dbprefix('email_template')." where task='Post New Task (Admin)'");
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
					
			/////////////============Post task admin end===========
			
			
			
			/////////////============Post task workers start===========
			
			$workers_detail=$this->task_model->get_worker_by_category($task_detail->task_category_id);
			$category_detail=$this->task_model->get_category_by_id($task_detail->task_category_id);
			$poster_link = '<a href="'.base_url().'user/'.$user_detail->profile_name.'">'.ucfirst($user_detail->full_name).'</a>';
			
			if(!empty($workers_detail)){
			foreach($workers_detail as $worker){
			
			$workers_notification = notification_setting($worker->user_id);
			
				if(isset($workers_notification->on_post_task)) {  

        			if($workers_notification->on_post_task==1) {   
			
						$email_template=$this->db->query("select * from ".$this->db->dbprefix('email_template')." where task='Post New Task by Category (Worker)'");
						$email_temp=$email_template->row();
						
						
						$email_address_from=$email_temp->from_address;
						$email_address_reply=$email_temp->reply_address;
						
						$email_subject=$email_temp->subject;	
						$email_message=$email_temp->message;	
						
						
						$email_to=$worker->email;
						
						
						$email_message=str_replace('{break}','<br/>',$email_message);
						$email_message=str_replace('{worker_name}',$worker->full_name,$email_message);	
						$email_message=str_replace('{category_name}',$category_detail->category_name,$email_message);	
						$email_message=str_replace('{poster_name}',$poster_link,$email_message);	
						$email_message=str_replace('{task_name}',$task_link,$email_message);
						
						
						$str=$email_message;
						
						
						/** custom_helper email function */
						
						email_send($email_address_from,$email_address_reply,$email_to,$email_subject,$str);
					
					}
				}
			
			}
			}
			
			
			/////////////============Post task workers end===========
			
			/////////////============Post task auto assign workers start===========
			
			if(($task_detail->task_auto_assignment == 3) && ($task_detail->task_assing_worker > 0)){
			
			$worker_detail = $this->worker_model->get_worker_info($task_detail->task_assing_worker);
			$worker_notification = notification_setting($worker_detail->user_id);
			
			
				if(isset($worker_notification->on_post_task)) {  
	
					if($worker_notification->on_post_task==1) {  
					 
			
						$email_template=$this->db->query("select * from ".$this->db->dbprefix('email_template')." where task='First Dibs When Post New Task (Worker)'");
						$email_temp=$email_template->row();
						
						
						$email_address_from=$email_temp->from_address;
						$email_address_reply=$email_temp->reply_address;
						
						$email_subject=$email_temp->subject;	
						$email_message=$email_temp->message;	
						
						
						$email_to=$worker_detail->email;
						
						$email_message=str_replace('{break}','<br/>',$email_message);
						$email_message=str_replace('{worker_name}',$worker_detail->full_name,$email_message);
						$email_message=str_replace('{poster_name}',$poster_link,$email_message);	
						$email_message=str_replace('{task_name}',$task_link,$email_message);
						
						
						$str=$email_message;
						
						/* custom_helper email function **/
						
						email_send($email_address_from,$email_address_reply,$email_to,$email_subject,$str);
					}
				}
			
			}
			
			
			/////////////============Post task auto assign workers end===========
  

			
			
			
			
			
			$data["error"] = "Your Task Posted successfully";
			redirect('task/done/'.$task_id);
		}
		
		
		
		$theme = getThemeName();
		$this->template->set_master_template($theme . '/template.php');
		$data['theme'] = $theme;
		
		$meta_setting = meta_setting();
		$pageTitle = 'Pay For New Task - ' . $meta_setting->title;
		$metaDescription = 'Pay For New Task - ' . $meta_setting->meta_description;
		$metaKeyword = 'Pay For New Task - ' . $meta_setting->meta_keyword;
		$this->template->write('pageTitle', $pageTitle, TRUE);
		$this->template->write('metaDescription', $metaDescription, TRUE);
		$this->template->write('metaKeyword', $metaKeyword, TRUE);
		$this->template->write_view('header', $theme . '/layout/common/header_login', $data, TRUE);
		$this->template->write_view('content_center', $theme . '/layout/task/step_pay', $data, TRUE);
		$this->template->write_view('footer', $theme . '/layout/common/footer', $data, TRUE);
		$this->template->render();
	
	}
	
	
	/*
	Function name :done()
	Parameter : $task_id (newly posted task ID)
	Return : integer $task_id
	Use : user can see the task preview and amount he have to pay when task assign to runner.
	Description : user can see the task detail by this function which called by http://hostname/task/done/$task_id/.
	*/
	
	
	function done($task_id)
	{
	
	
		if(($task_id == 0) && ($task_id = '')) {  redirect('dashboard'); }	
		if(!check_user_authentication()) {  redirect('sign_up'); }	
			
		$check_task_exsits=$this->task_model->check_user_task($task_id);
		
		if(!$check_task_exsits) { redirect('dashboard'); }	
		
			
		$data['task_id'] = $task_id;
		
		
		
		$task_detail=$this->task_model->get_task_detail($task_id);
		$data['task_detail']=$task_detail;
		
		$data['task_location']=$this->task_model->get_task_location($task_id);
		
		$data['user_location']=$this->user_model->get_user_location(get_authenticateUserID());
		
		$user_info=$this->user_model->get_user_info(get_authenticateUserID());
		$data['user_info']=$user_info;		
		
		
		$site_setting=site_setting();
		
		
		
	
	
		
		
		
		$theme = getThemeName();
		$this->template->set_master_template($theme . '/template.php');
		$data['theme'] = $theme;
		
		$meta_setting = meta_setting();
		$pageTitle = 'Done For New Task - ' . $meta_setting->title;
		$metaDescription = 'Done For New Task - ' . $meta_setting->meta_description;
		$metaKeyword = 'Done For New Task - ' . $meta_setting->meta_keyword;
		$this->template->write('pageTitle', $pageTitle, TRUE);
		$this->template->write('metaDescription', $metaDescription, TRUE);
		$this->template->write('metaKeyword', $metaKeyword, TRUE);
		$this->template->write_view('header', $theme . '/layout/common/header_login', $data, TRUE);
		$this->template->write_view('content_center', $theme . '/layout/task/step_done', $data, TRUE);
		$this->template->write_view('footer', $theme . '/layout/common/footer', $data, TRUE);
		$this->template->render();
	
	}
	
	
	
	//--------------------edit task-------------------
	
	
	
	
	/*
	Function name :edit_task_top()
	Parameter : $task_id (task ID), $copy (already posted task ID)
	Return : integer $task_id
	Use : user can update task by clicking on the "Change" button.
	Description : user can update task detail by this function which called by http://hostname/task/edit_task_top/$task_id/$copy
	*/
	
	
		
	function edit_task_top($task_id, $copy='')
	{
	
		if(!check_user_authentication()) { redirect('sign_up'); }
		if(($task_id == 0) && ($task_id = '')) { redirect('dashboard'); }
		
		if($_POST)
		{
			
			$this->task_model->edit_task_top($task_id);
			
			redirect('task/edit_task/'.$task_id);
		
		}
		
		$task_detail=$this->task_model->get_task_detail($task_id);
		$data['task_detail']=$task_detail;
		$data['task_id']=$task_id;
		$data['copy'] = $copy;
		$data['task_assign_worker']='';
		
		$theme = getThemeName();
		$this->template->set_master_template($theme . '/template.php');
		$data['theme'] = $theme;
		$limit=5;
		
		$data['taskers'] = $this->worker_model->get_top_worker($limit);
		
		
		$data['categories'] = $this->task_model->get_all_categories();
		
		$meta_setting = meta_setting();
		
		$this->load->view($theme.'/layout/task/edit_task_top', $data);
	
	
	}
		
		
		
	/*
	Function name :edit_task()
	Parameter : $task_id (task ID)
	Return : integer $task_id
	Use : user can update task detail .
	Description : user can update task detail by this function which called by http://hostname/task/edit_task/$task_id/
	*/
		
	function edit_task($task_id)
	{
		
		if(!check_user_authentication()) {  redirect('sign_up'); }
		if(($task_id == 0) && ($task_id = '')) {  redirect('dashboard'); }	
		
		$check_task_exsits=$this->task_model->check_user_task($task_id);
		
		if(!$check_task_exsits) { redirect('dashboard'); }	
		
		
		$chk_worker_bid=check_worker_bid_on_task($task_id);
						
		if($chk_worker_bid)
		{
			redirect('dashboard');
		}
			
		$data['task_id'] = $task_id;
		
		$task_detail=$this->task_model->get_task_detail($task_id);
		$data['task_detail']=$task_detail;
		
		$this->form_validation->set_rules('task_name', 'Task Title', 'required|min_length[10]');
	$this->form_validation->set_rules('task_description', 'Task Description', 'required|min_length[15]'); 
		$this->form_validation->set_rules('task_price', 'From Amount', 'required|number');
		$this->form_validation->set_rules('task_to_price', 'To Amount', 'required|number');
		
		
		if($this->input->post('extra_cost')>0)
		{
			$this->form_validation->set_rules('extra_cost_description', 'Extra Cost Description', 'required');
		}
		
		
		if($this->input->post('other_cost')>0)
		{
			$this->form_validation->set_rules('other_cost_description', 'Other Cost Description', 'required');
		}
		
		
		
		
		
		
		$day_error='';
		
		if($this->input->post('task_start_day')>$this->input->post('task_end_day'))
		{
				$day_error='<p>Task End date must be greater or equal to the start date.</p>';
		}
		
		
		
		if($this->form_validation->run() == FALSE || $day_error!=''){
				
			if(validation_errors() || $day_error!='')
			{
				$data["error"] = validation_errors().$day_error;
			}else{
				$data["error"] = "";
			}
			
			
			if($_POST)
			{
				$data['task_name'] = $this->input->post('task_name');
				$data['task_description'] = $this->input->post('task_description');
				$data['task_price'] = $this->input->post('task_price');
				$data['more_details'] = $this->input->post('more_details');
				$data['task_price'] = $this->input->post('task_price');
				$data['task_to_price'] = $this->input->post('task_to_price');
				
				$data['task_start_day'] = $this->input->post('task_start_day');
				$data['task_start_time'] = $this->input->post('task_start_time');
				$data['task_end_day'] = $this->input->post('task_end_day');
				$data['task_end_time'] = $this->input->post('task_end_time');
				
				$data['task_is_private'] = $this->input->post('task_is_private');
				$data['task_large_vehicals'] = $this->input->post('task_large_vehicals');
				$data['task_online'] = $this->input->post('task_online');
				
				$data['extra_cost']=$this->input->post('extra_cost');
				$data['extra_cost_description']=$this->input->post('extra_cost_description');
				$data['other_cost']=$this->input->post('other_cost');
				$data['other_cost_description']=$this->input->post('other_cost_description');
			}
			
			else
			{
				
				
				$content=  $task_detail->task_description;		
				$content=str_replace('KSYDOU','"',$content);
				$content=str_replace('KSYSING',"'",$content);
				
				$more_details= $task_detail->more_details;
				$more_details=str_replace('KSYDOU','"',$more_details);
				$more_details=str_replace('KSYSING',"'",$more_details);
				
				$extra_cost_description= $task_detail->extra_cost_description;
				$extra_cost_description=str_replace('KSYDOU','"',$extra_cost_description);
				$extra_cost_description=str_replace('KSYSING',"'",$extra_cost_description);
				
				
				$other_cost_description= $task_detail->other_cost_description;
				$other_cost_description=str_replace('KSYDOU','"',$other_cost_description);
				$other_cost_description=str_replace('KSYSING',"'",$other_cost_description);
	
	
	
				$data['task_name'] = $task_detail->task_name;
				$data['task_description'] = $content;
				$data['task_price'] = $task_detail->task_price;
				$data['more_details'] = $more_details;
				$data['task_price'] = $task_detail->task_price;
				$data['task_to_price'] = $task_detail->task_to_price;
				
				$data['task_start_day'] = $task_detail->task_start_day;
				$data['task_start_time'] = $task_detail->task_start_time;
				$data['task_end_day'] =$task_detail->task_end_day;
				$data['task_end_time'] = $task_detail->task_end_time;
				
				$data['task_is_private'] = $task_detail->task_is_private;
				$data['task_large_vehicals'] = $task_detail->task_large_vehicals;
				$data['task_online'] = $task_detail->task_online;
				
				$data['extra_cost']=$task_detail->extra_cost;
				$data['extra_cost_description']=$extra_cost_description;
				$data['other_cost']=$task_detail->other_cost;
				$data['other_cost_description']=$other_cost_description;
			
			}	
			
			
			
		} else {
		
			$apply=$this->task_model->edit_task();
			$data["error"] = "updated";
			$data['task_name'] = $this->input->post('task_name');
			$data['task_description'] = $this->input->post('task_description');
			$data['task_price'] = $this->input->post('task_price');
			$data['more_details'] = $this->input->post('more_details');
			$data['task_price'] = $this->input->post('task_price');	
			$data['task_to_price'] = $this->input->post('task_to_price');		
			
			$data['task_start_day'] = $this->input->post('task_start_day');
			$data['task_start_time'] = $this->input->post('task_start_time');
			$data['task_end_day'] = $this->input->post('task_end_day');
			$data['task_end_time'] = $this->input->post('task_end_time');
			
			
			$data['task_is_private'] = $this->input->post('task_is_private');
			$data['task_large_vehicals'] = $this->input->post('task_large_vehicals');
			$data['task_online'] = $this->input->post('task_online');
			
			$data['extra_cost']=$this->input->post('extra_cost');
			$data['extra_cost_description']=$this->input->post('extra_cost_description');
			$data['other_cost']=$this->input->post('other_cost');
			$data['other_cost_description']=$this->input->post('other_cost_description');
			
			$task_detail=$this->task_model->get_task_detail($task_id);
			
					
			redirect('tasks/'.$task_detail->task_url_name);
		}
		
		
		$data['task_location']=$this->task_model->get_task_location($task_id);
		
		$data['user_location']=$this->user_model->get_user_location(get_authenticateUserID());
		
		$data['categories'] = $this->task_model->get_all_categories();
		
		
		
		
		$theme = getThemeName();
		$this->template->set_master_template($theme . '/template.php');
		$data['theme'] = $theme;
	
		$meta_setting = meta_setting();
		
		$pageTitle = 'Edit Task - ' . $meta_setting->title;
		$metaDescription = 'Edit Task - ' . $meta_setting->meta_description;
		$metaKeyword = 'Edit Task - ' . $meta_setting->meta_keyword;
		$this->template->write('pageTitle', $pageTitle, TRUE);
		$this->template->write('metaDescription', $metaDescription, TRUE);
		$this->template->write('metaKeyword', $metaKeyword, TRUE);
		$this->template->write_view('header', $theme . '/layout/common/header_login', $data, TRUE);
		$this->template->write_view('content_center', $theme . '/layout/task/edit_task', $data, TRUE);
		$this->template->write_view('footer', $theme . '/layout/common/footer', $data, TRUE);
		$this->template->render();
	}
		
	
	
	
}

?>