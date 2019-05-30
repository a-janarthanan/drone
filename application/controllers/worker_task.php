<?php
class Worker_task extends ROCKERS_Controller 
{
	
	/*
	Function name :Worker_task()
	Description :Its Default Constuctor which called when worker_task object initialzie.its load necesary models
	*/
	
	function Worker_task()
	{
		parent::__construct();	
		$this->load->model('dispute_model');	
		$this->load->model('home_model');	
		$this->load->model('user_model');	
		$this->load->model('task_model');
		$this->load->model('worker_model');
		$this->load->model('user_task_model');
		$this->load->model('worker_task_model');
		$this->load->model('search_model');
	}
	
	/*
	Function name :index()
	Parameter :none
	Return : none
	Use : redirect to user dashboard
	Description : none
	*/
	
	function index()
	{
		redirect('user/dashboard');
	}

	/*
	Function name :loss()
	Parameter :$offset(for paging)
	Return : array of all lost task
	Use : runner all lost task
	Description : list of runner all lost task this function is called by http://hostname/worker_task/loss
	*/
   
	function loss($offset=0)
	{        
		   if(!check_user_authentication()) {  redirect('sign_up'); } 
		   
		   
		   $theme = getThemeName();
		   $this->template->set_master_template($theme .'/template.php');
		   
			$this->load->library('pagination');
	
			$limit = '10';
			//$config['uri_segment']='4';
			$config['base_url'] = site_url('worker_task/loss/');
			$config['total_rows'] = $this->worker_task_model->get_total_loss_tasks();
			$config['per_page'] = $limit;
					
			$this->pagination->initialize($config);		
			
			$data['page_link'] = $this->pagination->create_links();
			$data['result'] = $this->worker_task_model->get_loss_task_list($limit,$offset);
			$data['total_rows']=$config['total_rows'];
	
		   $data['site_setting']=site_setting();
		   $data['theme']=$theme;
		   $meta_setting=meta_setting();
	
		   
		   $pageTitle='Lost Tasks - '.$meta_setting->title;
		   $metaDescription='Lost Tasks - '.$meta_setting->meta_description;
		   $metaKeyword='Lost Tasks - '.$meta_setting->meta_keyword;
		   
		   $this->template->write('pageTitle',$pageTitle,TRUE);
		   $this->template->write('metaDescription',$metaDescription,TRUE);
		   $this->template->write('metaKeyword',$metaKeyword,TRUE);
		   $this->template->write_view('header',$theme .'/layout/common/header_login',$data,TRUE);
		   $this->template->write_view('content_center',$theme .'/layout/worker_task/worker_loss_task',$data,TRUE);
		   $this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		   $this->template->render();        
		   
	}
	
	
	
	/*
	Function name :my()
	Parameter :$offset(for paging)
	Return : array of all work task
	Use : runner all work task
	Description : list of runner all work task this function is called by http://hostname/worker_task/my
	*/
   
	
   function my($offset=0)
   {        
		   
		  if(!check_user_authentication()) {  redirect('sign_up'); } 
		  
		  
		   $theme = getThemeName();
		   $this->template->set_master_template($theme .'/template.php');
		   
			$this->load->library('pagination');
	
			$limit = '10';
			//$config['uri_segment']='4';
			$config['base_url'] = site_url('worker_task/my/');
			$config['total_rows'] = $this->worker_task_model->get_total_tasks();
			$config['per_page'] = $limit;
					
			$this->pagination->initialize($config);		
			
			$data['page_link'] = $this->pagination->create_links();
			$data['result'] = $this->worker_task_model->get_task_list($limit,$offset);
			$data['total_rows']=$config['total_rows'];
	
		   $data['site_setting']=site_setting();
		   $data['theme']=$theme;
		   $meta_setting=meta_setting();

		   
		   $pageTitle='My Tasks - '.$meta_setting->title;
		   $metaDescription='My Tasks - '.$meta_setting->meta_description;
		   $metaKeyword='My Tasks - '.$meta_setting->meta_keyword;
		   
		   $this->template->write('pageTitle',$pageTitle,TRUE);
		   $this->template->write('metaDescription',$metaDescription,TRUE);
		   $this->template->write('metaKeyword',$metaKeyword,TRUE);
		   $this->template->write_view('header',$theme .'/layout/common/header_login',$data,TRUE);
		   $this->template->write_view('content_center',$theme .'/layout/worker_task/worker_mytasks',$data,TRUE);
		   $this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		   $this->template->render();        
		   
   }
	
	
	/*
	Function name :all()
	Parameter :$offset(for paging)
	Return : array of all work task
	Use : runner all work task
	Description : list of runner all work task this function is called by http://hostname/worker_task/all
	*/
   
      
   function all($offset=0)
   {        
		   if(!check_user_authentication()) {  redirect('sign_up'); } 
		   $theme = getThemeName();
		   $this->template->set_master_template($theme .'/template.php');
		   
			$this->load->library('pagination');
	
			$limit = '10';
			//$config['uri_segment']='4';
			$config['base_url'] = site_url('worker_task/all/');
			$config['total_rows'] = $this->worker_task_model->get_total_tasks();
			$config['per_page'] = $limit;
					
			$this->pagination->initialize($config);		
			
			$data['page_link'] = $this->pagination->create_links();
			$data['result'] = $this->worker_task_model->get_task_list($limit,$offset);
			$data['total_rows']=$config['total_rows'];
	
		   $data['site_setting']=site_setting();
		   $data['theme']=$theme;
		   $meta_setting=meta_setting();

		   
		   $pageTitle='All Tasks - '.$meta_setting->title;
		   $metaDescription='All Tasks - '.$meta_setting->meta_description;
		   $metaKeyword='All Tasks - '.$meta_setting->meta_keyword;
		   
		   $this->template->write('pageTitle',$pageTitle,TRUE);
		   $this->template->write('metaDescription',$metaDescription,TRUE);
		   $this->template->write('metaKeyword',$metaKeyword,TRUE);
		   $this->template->write_view('header',$theme .'/layout/common/header_login',$data,TRUE);
		   $this->template->write_view('content_center',$theme .'/layout/worker_task/worker_all_tasks',$data,TRUE);
		   $this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		   $this->template->render();        
		   
   }
	
	/*
	Function name :open()
	Parameter :$offset(for paging)
	Return : array of all open task
	Use : runner all open task
	Description : list of runner all open task this function is called by http://hostname/worker_task/open
	*/
   
	   
   function open($offset=0)
   {        
		   if(!check_user_authentication()) {  redirect('sign_up'); } 
		   $theme = getThemeName();
		   $this->template->set_master_template($theme .'/template.php');
		   
			$this->load->library('pagination');
	
			$limit = '10';
			//$config['uri_segment']='4';
			$config['base_url'] = site_url('worker_task/open/');
			$config['total_rows'] = $this->worker_task_model->get_total_open_task();
			$config['per_page'] = $limit;
					
			$this->pagination->initialize($config);		
			
			$data['page_link'] = $this->pagination->create_links();
			$data['result'] = $this->worker_task_model->get_open_task_list($limit,$offset);
			$data['total_rows']=$config['total_rows'];
	
		   $data['site_setting']=site_setting();
		   $data['theme']=$theme;
		   $meta_setting=meta_setting();

		   
		   $pageTitle='Open Tasks - '.$meta_setting->title;
		   $metaDescription='Open Tasks - '.$meta_setting->meta_description;
		   $metaKeyword='Open Tasks - '.$meta_setting->meta_keyword;
		   
		   $this->template->write('pageTitle',$pageTitle,TRUE);
		   $this->template->write('metaDescription',$metaDescription,TRUE);
		   $this->template->write('metaKeyword',$metaKeyword,TRUE);
		   $this->template->write_view('header',$theme .'/layout/common/header_login',$data,TRUE);
		   $this->template->write_view('content_center',$theme .'/layout/worker_task/worker_open_tasks',$data,TRUE);
		   $this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		   $this->template->render();        
		   
   } 
	
	/*
	Function name :assigned()
	Parameter :$offset(for paging)
	Return : array of all assigned task
	Use : runner all assigned task
	Description : list of runner all assigned task this function is called by http://hostname/worker_task/assigned
	*/
	   
   function assigned($offset=0)
   {        
		  if(!check_user_authentication()) {  redirect('sign_up'); } 
		  
		   
		   $theme = getThemeName();
		   $this->template->set_master_template($theme .'/template.php');
		   
			$this->load->library('pagination');
	
			$limit = '10';
			//$config['uri_segment']='4';
			$config['base_url'] = site_url('worker_task/assigned/');
			$config['total_rows'] = $this->worker_task_model->get_total_assigned_task();
			$config['per_page'] = $limit;
					
			$this->pagination->initialize($config);		
			
			$data['page_link'] = $this->pagination->create_links();
			$data['result'] = $this->worker_task_model->get_assigned_task_list($limit,$offset);
			$data['total_rows']=$config['total_rows'];
	
		   $data['site_setting']=site_setting();
		   $data['theme']=$theme;
		   $meta_setting=meta_setting();

		   
		   $pageTitle='Assigned Tasks - '.$meta_setting->title;
		   $metaDescription='Assigned Tasks - '.$meta_setting->meta_description;
		   $metaKeyword='Assigned Tasks - '.$meta_setting->meta_keyword;
		   
		   $this->template->write('pageTitle',$pageTitle,TRUE);
		   $this->template->write('metaDescription',$metaDescription,TRUE);
		   $this->template->write('metaKeyword',$metaKeyword,TRUE);
		   $this->template->write_view('header',$theme .'/layout/common/header_login',$data,TRUE);
		   $this->template->write_view('content_center',$theme .'/layout/worker_task/worker_assigned_task',$data,TRUE);
		   $this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		   $this->template->render();        
		   
   }
	   
	/*
	Function name :closed()
	Parameter :$offset(for paging)
	Return : array of all closed task
	Use : runner all closed task
	Description : list of runner all closed task this function is called by http://hostname/worker_task/closed
	*/
	
   function closed($offset=0)
   {        
		   
		  if(!check_user_authentication()) {  redirect('sign_up'); } 
		  
		   $theme = getThemeName();
		   $this->template->set_master_template($theme .'/template.php');
		   
			$this->load->library('pagination');
	
			$limit = '10';
			//$config['uri_segment']='4';
			$config['base_url'] = site_url('worker_task/closed/');
			$config['total_rows'] = $this->worker_task_model->get_total_closed_task();
			$config['per_page'] = $limit;
					
			$this->pagination->initialize($config);		
			
			$data['page_link'] = $this->pagination->create_links();
			$data['result'] = $this->worker_task_model->get_closed_task_list($limit,$offset);
			$data['total_rows']=$config['total_rows'];
	
		   $data['site_setting']=site_setting();          
		   $data['theme']=$theme;
		   $meta_setting=meta_setting();

		   
		   $pageTitle='Closed Tasks - '.$meta_setting->title;
		   $metaDescription='Closed Tasks - '.$meta_setting->meta_description;
		   $metaKeyword='Closed Tasks - '.$meta_setting->meta_keyword;
		   
		   $this->template->write('pageTitle',$pageTitle,TRUE);
		   $this->template->write('metaDescription',$metaDescription,TRUE);
		   $this->template->write('metaKeyword',$metaKeyword,TRUE);
		   $this->template->write_view('header',$theme .'/layout/common/header_login',$data,TRUE);
		   $this->template->write_view('content_center',$theme .'/layout/worker_task/worker_closed_tasks',$data,TRUE);
		   $this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		   $this->template->render();        
		   
   }
	
	
	/*
	Function name :recurring()
	Parameter :$offset(for paging)
	Return : array of all recurring task
	Use : runner all recurring task
	Description : list of runner all recurring task this function is called by http://hostname/worker_task/recurring
	*/
	
	
   function recurring($offset=0)
   {        
		   
		 if(!check_user_authentication()) {  redirect('sign_up'); } 
		 
		   $theme = getThemeName();
		   $this->template->set_master_template($theme .'/template.php');
		   
			$this->load->library('pagination');
	
			$limit = '10';
			//$config['uri_segment']='4';
			$config['base_url'] = site_url('worker_task/recurring');
			$config['total_rows'] = $this->worker_task_model->get_total_recurring();
			$config['per_page'] = $limit;
					
			$this->pagination->initialize($config);		
			
			$data['page_link'] = $this->pagination->create_links();
			$data['result'] = $this->worker_task_model->get_recurring_list($limit,$offset);
			$data['total_rows']=$config['total_rows'];
		   
		   $data['site_setting']=site_setting();
		   $data['theme']=$theme;
		   $meta_setting=meta_setting();
		   
		   $pageTitle='My Recurring Tasks - '.$meta_setting->title;
		   $metaDescription='My Recurring Tasks - '.$meta_setting->meta_description;
		   $metaKeyword='My Recurring Tasks - '.$meta_setting->meta_keyword;
		   
		   $this->template->write('pageTitle',$pageTitle,TRUE);
		   $this->template->write('metaDescription',$metaDescription,TRUE);
		   $this->template->write('metaKeyword',$metaKeyword,TRUE);
		   $this->template->write_view('header',$theme .'/layout/common/header_login',$data,TRUE);
		   $this->template->write_view('content_center',$theme .'/layout/worker_task/worker_ recurring',$data,TRUE);
		   $this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		   $this->template->render();        
		   
   }
	
	
	/*
	Function name :scheduled()
	Parameter :$offset(for paging)
	Return : array of all scheduled task
	Use : runner all scheduled task
	Description : list of runner all scheduled task this function is called by http://hostname/worker_task/scheduled
	*/
	
   function scheduled($offset=0)
   {        
		  if(!check_user_authentication()) {  redirect('sign_up'); }  
		   $theme = getThemeName();
		   $this->template->set_master_template($theme .'/template.php');
		   
			$this->load->library('pagination');
	
			$limit = '10';
			//$config['uri_segment']='4';
			$config['base_url'] = site_url('worker_task/scheduled');
			$config['total_rows'] = $this->worker_task_model->get_total_scheduled();
			$config['per_page'] = $limit;
					
			$this->pagination->initialize($config);		
			
			$data['page_link'] = $this->pagination->create_links();
			$data['result'] = $this->worker_task_model->get_scheduled_list($limit,$offset);
			$data['total_rows']=$config['total_rows'];
		   
		   $data['site_setting']=site_setting();
		   $data['theme']=$theme;
		   $meta_setting=meta_setting();
		   
		   $pageTitle='Scheduled Tasks - '.$meta_setting->title;
		   $metaDescription='Scheduled Tasks - '.$meta_setting->meta_description;
		   $metaKeyword='Scheduled Tasks - '.$meta_setting->meta_keyword;
		   
		   $this->template->write('pageTitle',$pageTitle,TRUE);
		   $this->template->write('metaDescription',$metaDescription,TRUE);
		   $this->template->write('metaKeyword',$metaKeyword,TRUE);
		   $this->template->write_view('header',$theme .'/layout/common/header_login',$data,TRUE);
		   $this->template->write_view('content_center',$theme .'/layout/worker_task/worker_scheduled_tasks',$data,TRUE);
		   $this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		   $this->template->render();        
		   
   }
 	
	
	
	  
	/*
	Function name :complete()
	Parameter : $task_id(task id)
	Return : none
	Use : runner complete the current running or working task 
	Description : runner complete the current running or working task this function is called by http://hostname/worker_task/complete
	*/ 	
	
	
	function complete($task_id='')
   {        
   
   
	if(!check_user_authentication()) {  redirect('sign_up'); } 
	
	
   if($task_id=='' || $task_id==0)
   {
		redirect('worker_task/assigned');
   }
		   
		   
			$task_detail=$this->task_model->get_tasks_detail_by_id($task_id);


	if(!$task_detail)
	{
		redirect('worker_task/assigned');
	}		
			
			
		   $user_detail = $this->user_model->get_user_info($task_detail->user_id);
		   $worker_detail = $this->user_model->get_user_info(get_authenticateUserID());
		   
		   
		   $theme = getThemeName();
		   $this->template->set_master_template($theme .'/template.php');
		   
		   $this->form_validation->set_rules('comment', 'Comment', 'required');
		  
			$detect=0;
	
		if($_POST)
		{
			if($this->input->post('comment')!='')
			{
				$detect_emails = get_emails($this->input->post('comment'));
				
				if($detect_emails)
				{
					$detect=1;	
				}	
			}
		}
		
		
		
	if($task_detail->task_activity_status>0)
	{
		  $detect=0;
	}
	
	
	
	
			if($this->form_validation->run() == FALSE || $detect==1)
			{
		
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
				
				$data['comment'] = $this->input->post('comment');
				$data['complete'] = $this->input->post('complete');
				$data['task_id'] = $this->input->post('task_id');
				$data['comment_rate'] = $this->input->post('comment_rate');
				

			} else {
		
				$apply=$this->worker_task_model->complete();

				$data['comment'] = $this->input->post('comment');
				$data['complete'] = $this->input->post('complete');
				$data['task_id'] = $this->input->post('task_id');
				$data['comment_rate'] = $this->input->post('comment_rate');
		
		
					$notification = notification_setting($task_detail->user_id);
				$worker_notification = notification_setting(get_authenticateUserID());
		
				/////////////============Complete time  to poster start===========	
					
				if(isset($notification->on_complete_task)) {  

					if($notification->on_complete_task==1) {  

						$email_template=$this->db->query("select * from `trc_email_template` where task='Complete Task by worker (Poster)'");
						$email_temp=$email_template->row();
						
						
						$email_address_from=$email_temp->from_address;
						$email_address_reply=$email_temp->reply_address;
						
						$email_subject=$email_temp->subject;				
						$email_message=$email_temp->message;			
						
										
						$email_to=$user_detail->email;		
						
						$poster_link ='<a href="'.base_url().'user/'.$user_detail->profile_name.'">'.ucfirst($user_detail->full_name).'</a>';
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
					
				/////////////============Complete time  to poster end===========	
					
				/////////////============Complete time  to worker start===========	
				if(isset($worker_notification->on_complete_task)) {  

					if($worker_notification->on_complete_task==1) {  
					
						$email_template=$this->db->query("select * from `trc_email_template` where task='Complete Task by worker (Worker)'");
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
					
				/////////////============Complete time  to worker end===========
				
				
				/////////////============Complete time  to admin start===========	

					$email_template=$this->db->query("select * from `trc_email_template` where task='Complete Task by worker (Admin)'");
					$email_temp=$email_template->row();
					
					
					$email_address_from=$email_temp->from_address;
					$email_address_reply=$email_temp->reply_address;
					
					$email_subject=$email_temp->subject;				
					$email_message=$email_temp->message;			
					
									
					$email_to=$email_temp->from_address;
					
					
					$email_message=str_replace('{break}','<br/>',$email_message);
					$email_message=str_replace('{poster_name}',$poster_link,$email_message);		
					$email_message=str_replace('{worker_name}',$worker_link,$email_message);		
					$email_message=str_replace('{task_name}',$task_link,$email_message);
					
					$str=$email_message; 
										
					/** custom_helper email function **/
						
					email_send($email_address_from,$email_address_reply,$email_to,$email_subject,$str);
					
				/////////////============Complete time  to admin end===========
		
					
				redirect('worker_task/assigned');
			}

			
			$data['task_id']=$task_id;
			
		   $data['taskdetail'] = $this->task_model->get_tasks_detail_by_id($task_id);
		   $data['site_setting']=site_setting();
		   $data['theme']=$theme;
		   $meta_setting=meta_setting();
		   
		   $pageTitle='Complete Tasks - '.$meta_setting->title;
		   $metaDescription='Complete Tasks - '.$meta_setting->meta_description;
		   $metaKeyword='Complete Tasks - '.$meta_setting->meta_keyword;
		   
		   $this->template->write('pageTitle',$pageTitle,TRUE);
		   $this->template->write('metaDescription',$metaDescription,TRUE);
		   $this->template->write('metaKeyword',$metaKeyword,TRUE);
		   $this->template->write_view('header',$theme .'/layout/common/header_login',$data,TRUE);
		   $this->template->write_view('content_center',$theme .'/layout/worker_task/worker_complete_task',$data,TRUE);
		   $this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		   $this->template->render();        
		   
   }
	   
	   
	   
	/*
	Function name :conversation()
	Parameter : $worker_id(worker id), $task_id(task id)
	Return : array of all private conversations 
	Use : all private conversations between task poster and runner
	Description : list of all private conversations  this function is called by http://hostname/worker_task/conversation
	*/ 	
		
	function conversation($worker_id='',$task_id='')
    {
		
				if(!check_user_authentication()) { redirect('sign_up'); }
				
				if($task_id=='' || $task_id==0 || $worker_id=='' || $worker_id==0)
				{
					redirect('worker_task/mytasks');
				}
				
				// worker details
				$worker_details = $this->worker_model->get_worker_info($worker_id);
				
				if(!$worker_details)
				{
					redirect('worker_task/assigned');
				}
				
				// task details
				$task_detail=$this->task_model->get_tasks_detail_by_id($task_id);
				
				if(!$task_detail)
				{
					redirect('worker_task/assigned');
				}
				
				// task poster details
				$user_detail = $this->user_model->get_user_info($task_detail->user_id);
				
				if(!$user_detail)
				{
					redirect('worker_task/assigned');
				}
				
				
				
				
				$theme = getThemeName();
				$this->template->set_master_template($theme .'/template.php');
				
				$this->form_validation->set_rules('comment', 'Comment', 'required');
				
					
		$detect=0;
		
		if($_POST)
		{
			if($this->input->post('comment')!='')
			{
				$detect_emails = get_emails($this->input->post('comment'));
				
				if($detect_emails)
				{
					$detect=1;	
				}	
			}
		}
		
		if($task_detail->task_activity_status>0)
		{
			  $detect=0;
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
				
				$data['comment'] = $this->input->post('comment');
				
				
				} else {
					$data["error"] = "";
				
				if($this->input->post('complete'))
				{
				$apply=$this->worker_task_model->new_comment_complete();
				}
				elseif($this->input->post('send'))
				{
				$apply=$this->worker_task_model->new_comment();
				}
				else
				{
				$apply=$this->worker_task_model->new_comment();
				}
				
				$data['comment'] = $this->input->post('comment');
				
				$poster_link ='<a href="'.base_url().'user/'.$user_detail->profile_name.'">'.ucfirst($user_detail->full_name).'</a>';
				$worker_link ='<a href="'.base_url().'user/'.$worker_details->profile_name.'">'.ucfirst($worker_details->full_name).'</a>';
				$task_link ='<a href="'.base_url().'tasks/'.$task_detail->task_url_name.'">'.$task_detail->task_name.'</a>';
				$from_name = $worker_link;
				
				if($this->input->post('complete'))
				{
				
				$notification = notification_setting($task_detail->user_id);
				$worker_notification = notification_setting(get_authenticateUserID());
				
				
				
				/////////////============Complete time to poster start===========
				
				if(isset($notification->on_complete_task)) {
				
				if($notification->on_complete_task==1) {
				
				$email_template=$this->db->query("select * from `trc_email_template` where task='Complete Task by worker (Poster)'");
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
				
				/////////////============Complete time to poster end===========
				
				/////////////============Complete time to worker start===========
				if(isset($worker_notification->on_complete_task)) {
				
				if($worker_notification->on_complete_task==1) {
				
				$email_template=$this->db->query("select * from `trc_email_template` where task='Complete Task by worker (Worker)'");
				$email_temp=$email_template->row();
				
				
				$email_address_from=$email_temp->from_address;
				$email_address_reply=$email_temp->reply_address;
				
				$email_subject=$email_temp->subject;
				$email_message=$email_temp->message;
				
				
				$email_to=$worker_details->email;
				
				$email_message=str_replace('{break}','<br/>',$email_message);
				$email_message=str_replace('{worker_name}',ucfirst($worker_details->full_name),$email_message);
				$email_message=str_replace('{task_name}',$task_link,$email_message);
				
				$str=$email_message;
				
				/** custom_helper email function **/
				
				email_send($email_address_from,$email_address_reply,$email_to,$email_subject,$str);
				}
				}
				
				/////////////============Complete time to worker end===========
				
				
				/////////////============Complete time to admin start===========
				
				$email_template=$this->db->query("select * from `trc_email_template` where task='Complete Task by worker (Admin)'");
				$email_temp=$email_template->row();
				
				
				$email_address_from=$email_temp->from_address;
				$email_address_reply=$email_temp->reply_address;
				
				$email_subject=$email_temp->subject;
				$email_message=$email_temp->message;
				
				
				$email_to=$email_temp->from_address;
				
				
				$email_message=str_replace('{break}','<br/>',$email_message);
				$email_message=str_replace('{poster_name}',$poster_link,$email_message);
				$email_message=str_replace('{worker_name}',$worker_link,$email_message);
				$email_message=str_replace('{task_name}',$task_link,$email_message);
				
				$str=$email_message;
				
				/** custom_helper email function **/
				
				email_send($email_address_from,$email_address_reply,$email_to,$email_subject,$str);
				
				/////////////============Complete time to admin end===========
				
				}
				
				else {
				
				
				/////////////============Conversation start===========
				
				$email_template=$this->db->query("select * from `trc_email_template` where task='Conversation Message'");
				$email_temp=$email_template->row();
				
				
				$email_address_from=$email_temp->from_address;
				$email_address_reply=$email_temp->reply_address;
				
				$email_subject=$email_temp->subject;
				$email_message=$email_temp->message;
				
				
				$email_to=$worker_details->email;
				
				
				
				$email_message=str_replace('{break}','<br/>',$email_message);
				$email_message=str_replace('{user_name}',ucfirst($worker_details->full_name),$email_message);
				$email_message=str_replace('{from_name}',$from_name,$email_message);
				$email_message=str_replace('{task_name}',$task_link,$email_message);
				$email_message=str_replace('{message}',$this->input->post('comment'),$email_message);
				
				$str=$email_message;
				
				/** custom_helper email function **/
				
				email_send($email_address_from,$email_address_reply,$email_to,$email_subject,$str);
				
				/////////////============Conversation end===========
				
				
				}
				
				
				
				
				echo "<script>window.location.href='".site_url('worker_task/conversation/'.$worker_id.'/'.$task_id)."'</script>";
				
				
				}
				
				
				
				$data['worker_id']=$worker_id;
				$data['task_id']=$task_id;
				$data['task_user_id'] = $this->user_task_model->get_task_user($task_id);
				
				
				
				//Task details
				$data['task_detail']=$task_detail;
				$data['task_location']=$this->task_model->get_task_location($task_id);
				
				//worker Details
				$data['user_worker_id'] =$worker_id;
				$data['worker_user_id'] = $worker_details->user_id;
				
				
				
				$data['site_setting']=site_setting();
				
				$data['result'] = $this->user_task_model->get_all_comments($worker_details->user_id,$task_id,$data['task_user_id']);
				
				$data['theme']=$theme;
				$meta_setting=meta_setting();
				
				$pageTitle='Conversation for - '.$meta_setting->title;
				$metaDescription='Conversation for - '.$meta_setting->meta_description;
				$metaKeyword='Conversation for - '.$meta_setting->meta_keyword;
				
				$this->template->write('pageTitle',$pageTitle,TRUE);
				$this->template->write('metaDescription',$metaDescription,TRUE);
				$this->template->write('metaKeyword',$metaKeyword,TRUE);
				$this->template->write_view('header',$theme .'/layout/common/header_login',$data,TRUE);
				$this->template->write_view('content_center',$theme .'/layout/worker_task/worker_conversation',$data,TRUE);
				$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
				$this->template->render();
				
		}
		
		

	
}

?>