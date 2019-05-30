<?php
class User_task extends ROCKERS_Controller 
{
	
	/*
	Function name :User_task()
	Description :Its Default Constuctor which called when user_task object initialzie.its load necesary models
	*/
	function User_task()
	{
		parent::__construct();	
		$this->load->model('dispute_model');	
		$this->load->model('home_model');	
		$this->load->model('user_model');	
		$this->load->model('task_model');
		$this->load->model('worker_model');
		$this->load->model('user_task_model');
		$this->load->model('search_model');
		$this->load->model('autocomplete_model');
	}
	
	
	/*
	Function name :index()
	Parameter :none
	Return : none
	Use : redirect to user dashboard
	Description : none
	*/
	
	public function index()
	{
		redirect('user/dashboard');
	}
	
	
	/*
	Function name :cancel_task()
	Parameter :$task_id(task id)
	Return : none
	Use : cancel the task
	Description : task poster can manually cancel the task until no one have bid on the task this function is called by http://hostname/user_task/cancel_task
	*/
	
	function cancel_task($task_id)
	{
		if(!check_user_authentication()) {  redirect('sign_up'); } 
		$this->user_task_model->cancel_task($task_id);	
		
		redirect('user_task/closed_tasks');
	}
	
	/*
	Function name :pay_now()
	Parameter :$task_id(task id)
	Return : none
	Use : pay the amount of task final price
	Description : task poster pay the task final offer price when task assign to runner this function is called by http://hostname/user_task/pay_now
	*/
	
	function pay_now($task_id)
	{
		if(!check_user_authentication()) {  redirect('sign_up'); } 	
		if($task_id=='' || $task_id==0)
		{
			redirect('user_task/assigned_task');
		}		
		
		
	   
	   $task_detail=$this->task_model->get_tasks_detail_by_id($task_id);
	   
	   
	    if(!$task_detail)
		{
			redirect('user_task/assigned_task');
		}
		
		
		
		
		
		$data['task_detail']=$task_detail;
		
		$data['task_id']=$task_id;


		
		
		
		$task_setting=task_setting();
		
		$total=0;
		
		if($task_detail->extra_cost>0) {
		
		$total=$total+$task_detail->extra_cost;
		
		}
		
		
		
		 $price = $this->user_task_model->offer_price($task_detail->task_worker_id,$task_id); 
	 
		 $total=$total+$price->offer_amount;
		 
		 
		 
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
			$assign_pay_status=0;
			$assign_time_pay_amount=$check_amount_pay->task_amount;
			
			if($assign_time_pay_amount>=$total)
			{
				$check_already_pay=1;
			}
		}
		
					
					
		
		
		$error='';
		
		/*if($total>$wallet_amount)
		{
			$error='<p>You have not sufficient amount to pay.<a href="'.base_url().'wallet/add_wallet" style="color:black;font-weight:bold;padding-left: 30px;">Deposit fund</a> </p>';
		}*/
		
		$this->form_validation->set_rules('task_id', 'Task', 'required');
		
		if($this->form_validation->run() == FALSE || $error!='')
		{
				if(validation_errors() || $error!='')
				{													
					$data["error"] = validation_errors().$error;
				}
				else
				{		
					$data["error"] = "";							
				}
				
		}
		
		 else
		{
			
		
			$this->user_task_model->pay_now($task_id,$task_detail->task_worker_id);
			
			
			
			
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
										
					/** custom_helper email function **/
						
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
									
				/** custom_helper email function **/
					
				email_send($email_address_from,$email_address_reply,$email_to,$email_subject,$str);
					
			/////////////============Post task admin end===========
			
			
			
			
			$newtot=filter_var($total, FILTER_SANITIZE_NUMBER_INT);
			$newwalt=filter_var($wallet_amount, FILTER_SANITIZE_NUMBER_INT);
			
			if($newtot>$newwalt)
			{
				
			//$error='<p>You have not sufficient amount to pay.<a href="'.base_url().'wallet/add_wallet" style="color:black;font-weight:bold;padding-left: 30px;">Deposit fund</a> </p>';
			echo "<script>window.location.href='".site_url('wallet/add_wallet')."'</script>";
			}
			elseif($newtot<=$newwalt)
			{
				
			echo "<script>window.location.href='".site_url('user_task/assigned_task')."'</script>";
			}
		}
	   
	   
	   
	   $theme = getThemeName();
	   $this->template->set_master_template($theme .'/template.php');
	   		
	   $data['theme']=$theme;
	   $meta_setting=meta_setting();

	   
	   $pageTitle='Pay Now - '.$meta_setting->title;
	   $metaDescription='Pay Now - '.$meta_setting->meta_description;
	   $metaKeyword='Pay Now - '.$meta_setting->meta_keyword;
	   
	   $this->template->write('pageTitle',$pageTitle,TRUE);
	   $this->template->write('metaDescription',$metaDescription,TRUE);
	   $this->template->write('metaKeyword',$metaKeyword,TRUE);
	   $this->template->write_view('header',$theme .'/layout/common/header_login',$data,TRUE);
	   $this->template->write_view('content_center',$theme .'/layout/user_task/pay_now',$data,TRUE);
	   $this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
	   $this->template->render();        
		
		
		
		
	}
	
	
	/*
	Function name :mytasks()
	Parameter :$offset(for paging)
	Return : array of all posted task
	Use : user all posted task
	Description : list of user all posted task this function is called by http://hostname/user_task/mytasks
	*/
	 function mytasks($offset=0)
     {        
            if(!check_user_authentication()) {  redirect('sign_up'); }    
               $theme = getThemeName();
               $this->template->set_master_template($theme .'/template.php');
			   
			    $this->load->library('pagination');
		
				$limit = '10';
				//$config['uri_segment']='4';
				$config['base_url'] = site_url('user_task/mytasks/');
				$config['total_rows'] = $this->user_task_model->get_total_tasks();
				$config['per_page'] = $limit;
						
				$this->pagination->initialize($config);		
				
				$data['page_link'] = $this->pagination->create_links();
				$data['result'] = $this->user_task_model->get_task_list($limit,$offset);
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
               $this->template->write_view('content_center',$theme .'/layout/user_task/mytasks',$data,TRUE);
               $this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
               $this->template->render();        
               
       }
	 
	 
	 /*
	Function name :all_tasks()
	Parameter :$offset(for paging)
	Return : array of all posted task
	Use : user all posted task
	Description : list of user all posted task this function is called by http://hostname/user_task/all_tasks
	*/  
	
	function all_tasks($offset=0)
    {        
               
             if(!check_user_authentication()) {  redirect('sign_up'); } 
			 
			   $theme = getThemeName();
               $this->template->set_master_template($theme .'/template.php');
			   
			    $this->load->library('pagination');
		
				$limit = '10';
				//$config['uri_segment']='4';
				$config['base_url'] = site_url('user_task/all_tasks/');
				$config['total_rows'] = $this->user_task_model->get_total_tasks();
				$config['per_page'] = $limit;
						
				$this->pagination->initialize($config);		
				
				$data['page_link'] = $this->pagination->create_links();
				$data['result'] = $this->user_task_model->get_task_list($limit,$offset);
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
               $this->template->write_view('content_center',$theme .'/layout/user_task/all_tasks',$data,TRUE);
               $this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
               $this->template->render();        
               
       }
	
	
	 /*
	Function name :open_tasks()
	Parameter :$offset(for paging)
	Return : array of all open task
	Use : user all newly posted task
	Description : list of user all newly posted(not assigned) task this function is called by http://hostname/user_task/open_tasks
	*/     
   function open_tasks($offset=0)
   {        
             if(!check_user_authentication()) {  redirect('sign_up'); }   
               $theme = getThemeName();
               $this->template->set_master_template($theme .'/template.php');
			   
			    $this->load->library('pagination');
		
				$limit = '10';
				//$config['uri_segment']='4';
				$config['base_url'] = site_url('user_task/open_tasks/');
				$config['total_rows'] = $this->user_task_model->get_total_open_task();
				$config['per_page'] = $limit;
						
				$this->pagination->initialize($config);		
				
				$data['page_link'] = $this->pagination->create_links();
				$data['result'] = $this->user_task_model->get_open_task_list($limit,$offset);
				$data['total_rows']=$config['total_rows'];
		
		
				$data['offset']=$offset;
				
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
               $this->template->write_view('content_center',$theme .'/layout/user_task/open_tasks',$data,TRUE);
               $this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
               $this->template->render();        
               
       }
	   
	
	 /*
	Function name :assigned_task()
	Parameter :$offset(for paging)
	Return : array of all running task
	Use : user all current running task
	Description : list of user all currently running tasks this function is called by http://hostname/user_task/assigned_task
	*/  
		   
   function assigned_task($offset=0)
   {        
              if(!check_user_authentication()) {  redirect('sign_up'); }  
               $theme = getThemeName();
               $this->template->set_master_template($theme .'/template.php');
			   
			    $this->load->library('pagination');
		
				$limit = '10';
				//$config['uri_segment']='4';
				$config['base_url'] = site_url('user_task/assigned_task/');
				$config['total_rows'] = $this->user_task_model->get_total_assigned_task();
				$config['per_page'] = $limit;
						
				$this->pagination->initialize($config);		
				
				$data['page_link'] = $this->pagination->create_links();
				$data['result'] = $this->user_task_model->get_assigned_task_list($limit,$offset);
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
               $this->template->write_view('content_center',$theme .'/layout/user_task/assigned_task',$data,TRUE);
               $this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
               $this->template->render();        
               
       }
	
	
	 /*
	Function name :closed_tasks()
	Parameter :$offset(for paging)
	Return : array of all closed or cancel task
	Use : user all closed task
	Description : list of user all closed or cancel tasks this function is called by http://hostname/user_task/closed_tasks
	*/ 
	   
   function closed_tasks($offset=0)
   {        
              if(!check_user_authentication()) {  redirect('sign_up'); }  
               $theme = getThemeName();
               $this->template->set_master_template($theme .'/template.php');
			   
			    $this->load->library('pagination');
		
				$limit = '10';
				//$config['uri_segment']='4';
				$config['base_url'] = site_url('user_task/closed_tasks/');
				$config['total_rows'] = $this->user_task_model->get_total_closed_task();
				$config['per_page'] = $limit;
						
				$this->pagination->initialize($config);		
				
				$data['page_link'] = $this->pagination->create_links();
				$data['result'] = $this->user_task_model->get_closed_task_list($limit,$offset);
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
               $this->template->write_view('content_center',$theme .'/layout/user_task/closed_tasks',$data,TRUE);
               $this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
               $this->template->render();        
               
       }
	 /*
	Function name :draft_tasks()
	Parameter :$offset(for paging)
	Return : array of all draft task
	Use : user all draft posted task
	Description : list of user all draft posted(not assigned) task this function is called by http://hostname/user_task/open_tasks
	*/     
   function draft_tasks($offset=0)
   {        
             if(!check_user_authentication()) {  redirect('sign_up'); }   
               $theme = getThemeName();
               $this->template->set_master_template($theme .'/template.php');
			   
			    $this->load->library('pagination');
		
				$limit = '10';
				//$config['uri_segment']='4';
				$config['base_url'] = site_url('user_task/draft_tasks/');
				$config['total_rows'] = $this->user_task_model->get_total_draft_task();
				$config['per_page'] = $limit;
						
				$this->pagination->initialize($config);		
				
				$data['page_link'] = $this->pagination->create_links();
				$data['result'] = $this->user_task_model->get_draft_task_list($limit,$offset);
				$data['total_rows']=$config['total_rows'];
		
		
				$data['offset']=$offset;
				
               $data['site_setting']=site_setting();
               $data['theme']=$theme;
               $meta_setting=meta_setting();

               
               $pageTitle='Draft Tasks - '.$meta_setting->title;
               $metaDescription='Draft Tasks - '.$meta_setting->meta_description;
               $metaKeyword='Draft Tasks - '.$meta_setting->meta_keyword;
               
               $this->template->write('pageTitle',$pageTitle,TRUE);
               $this->template->write('metaDescription',$metaDescription,TRUE);
               $this->template->write('metaKeyword',$metaKeyword,TRUE);
               $this->template->write_view('header',$theme .'/layout/common/header_login',$data,TRUE);
               $this->template->write_view('content_center',$theme .'/layout/user_task/draft_tasks',$data,TRUE);
               $this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
               $this->template->render();        
               
       }
	 
	 /*
	Function name :recurring()
	Parameter :$offset(for paging)
	Return : array of all recurring task
	Use : user all recurring task
	Description : list of user all recurring tasks this function is called by http://hostname/user_task/recurring
	*/ 
	
    function recurring($offset=0)
    {        
              if(!check_user_authentication()) {  redirect('sign_up'); }  
               $theme = getThemeName();
               $this->template->set_master_template($theme .'/template.php');
               
			  	$this->load->library('pagination');
		
				$limit = '10';
				//$config['uri_segment']='4';
				$config['base_url'] = site_url('user_task/recurring');
				$config['total_rows'] = $this->user_task_model->get_total_recurring();
				$config['per_page'] = $limit;
						
				$this->pagination->initialize($config);		
				
				$data['page_link'] = $this->pagination->create_links();
				$data['result'] = $this->user_task_model->get_recurring_list($limit,$offset);
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
               $this->template->write_view('content_center',$theme .'/layout/user_task/recurring',$data,TRUE);
               $this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
               $this->template->render();        
               
       }
       
       
	/*
	Function name :scheduled()
	Parameter :$offset(for paging)
	Return : array of all scheduled task
	Use : user all scheduled(online) task
	Description : list of user all scheduled(online) tasks this function is called by http://hostname/user_task/scheduled
	*/ 
    
	
	function scheduled($offset=0)
    {        
             if(!check_user_authentication()) {  redirect('sign_up'); }   
               $theme = getThemeName();
               $this->template->set_master_template($theme .'/template.php');
               
			  	$this->load->library('pagination');
		
				$limit = '10';
				//$config['uri_segment']='4';
				$config['base_url'] = site_url('user_task/scheduled');
				$config['total_rows'] = $this->user_task_model->get_total_scheduled();
				$config['per_page'] = $limit;
						
				$this->pagination->initialize($config);		
				
				$data['page_link'] = $this->pagination->create_links();
				$data['result'] = $this->user_task_model->get_scheduled_list($limit,$offset);
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
               $this->template->write_view('content_center',$theme .'/layout/user_task/scheduled_tasks',$data,TRUE);
               $this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
               $this->template->render();        
               
       }
	  
	  
	/*
	Function name :worker_offer()
	Parameter : $task_id(task id), $offset(for paging)
	Return : array of all worker offer
	Use : all runner offer list on newly posted task
	Description : list of all runner offer on newly posted tasks this function is called by http://hostname/user_task/worker_offer
	*/ 
	
	 
	function worker_offer($task_id,$offset=0)
	{
		
		if(!check_user_authentication()) {  redirect('sign_up'); } 
		
		
		if($task_id=='' || $task_id==0)
		{
			redirect('user_task/open_tasks');
		}		
		
		
	   
	   $task_detail=$this->task_model->get_tasks_detail_by_id($task_id);
	   
	   
	    if(!$task_detail)
		{
			redirect('user_task/open_tasks');
		}
		
		
		
		$this->load->library('pagination');
		
		$limit = '10';
		$config['uri_segment']='4';
		$config['base_url'] = site_url('user_task/worker_offer/'.$task_id);
		$config['total_rows'] = $this->user_task_model->get_total_offer_on_task($task_id);
		$config['per_page'] = $limit;
		
		$data['task_id'] = $task_id;
		
		$data['task_detail']=$task_detail;
		$data['task_location']=$this->task_model->get_task_location($task_id);
		$data['result'] = $this->user_task_model->get_all_offer_on_task($task_id,$limit,$offset);
		$data['site_setting']=site_setting();
		
		$this->pagination->initialize($config);
		
		$data['page_link'] = $this->pagination->create_links();
		
		$data['total_rows']=$config['total_rows'];
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$data['theme']=$theme;
		$meta_setting=meta_setting();
		
		$pageTitle='Offers - '.$meta_setting->title;
		$metaDescription='Offers - '.$meta_setting->meta_description;
		$metaKeyword='Offers - '.$meta_setting->meta_keyword;
		
		$this->template->write('pageTitle',$pageTitle,TRUE);
		$this->template->write('metaDescription',$metaDescription,TRUE);
		$this->template->write('metaKeyword',$metaKeyword,TRUE);
		$this->template->write_view('header',$theme .'/layout/common/header_home',$data,TRUE);
		$this->template->write_view('content_center',$theme .'/layout/user_task/worker_offer',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
		
		}
		
		
		
	/*
	Function name :conversation()
	Parameter : $worker_id(worker id), $task_id(task id)
	Return : array of all private conversations 
	Use : all private conversations between task poster and runner
	Description : list of all private conversations  this function is called by http://hostname/user_task/conversation
	*/ 	
			
	function conversation($worker_id='',$task_id='')
	{
			if(!check_user_authentication()) {  echo "<script>window.location.href='".site_url('sign_up')."'</script>"; } 
			
			
			if($task_id=='' || $task_id==0 || $worker_id=='' || $worker_id==0)
		   {
				echo "<script>window.location.href='".site_url('user_task/mytasks')."'</script>";
		   }
		 	// worker details  
		 	$worker_details = $this->worker_model->get_worker_info($worker_id);
			
			if(!$worker_details)
			{
				redirect('user_task/assigned');
			}
			
		   // task poster details

		   $user_detail = $this->user_model->get_user_info(get_authenticateUserID());
			
			if(!$user_detail)
			{
				redirect('user_task/assigned');
			}
			
			// task details
			$task_detail=$this->task_model->get_tasks_detail_by_id($task_id);
			
			if(!$task_detail)
			{
				redirect('user_task/assigned');
			}
			
			
			
		   
			$theme = getThemeName();
			$this->template->set_master_template($theme .'/template.php');
			
			$data['worker_id']=$worker_id;
			$data['task_id']=$task_id;
			$data['task_user_id'] = $this->user_task_model->get_task_user($task_id);
			
			
			
			
			$data['task_detail']=$task_detail;
			$data['task_location']=$this->task_model->get_task_location($task_id);

			$limit = '10';
		   $offset ='0';

		   $data['result_new'] = $this->user_task_model->get_all_offer_on_task($task_id,$limit,$offset);
			
			$data["error"] = "";

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
			$this->template->write_view('content_center',$theme .'/layout/user_task/conversation',$data,TRUE);
			$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
			$this->template->render();
		
		}
	
	
	
	/*
	Function name :new_comment()
	Parameter : $worker_id(worker id), $task_id(task id)
	Return : array of all private conversations 
	Use : add new private conversations from task poster to runner
	Description : add new private conversations from task poster to runner this function is called by http://hostname/user_task/new_comment
	*/ 	
	
		
    function new_comment($worker_id='',$task_id='')
    {        
               
               
			  if(!check_user_authentication()) {  redirect('sign_up'); } 

			  //echo $this->input->post('accept1');exit;
			  
			 


			 if($task_id=='' || $task_id==0 || $worker_id=='' || $worker_id==0)
		   {
				redirect('user_task/mytasks');
		   }
		 	// worker details  
		 	$worker_details = $this->worker_model->get_worker_info($worker_id);
			
			if(!$worker_details)
			{
				redirect('user_task/assigned');
			}
			
		   // task poster details
		   $user_detail = $this->user_model->get_user_info(get_authenticateUserID());
			
			if(!$user_detail)
			{
				redirect('user_task/assigned');
			}
			
			// task details
			$task_detail=$this->task_model->get_tasks_detail_by_id($task_id);
			
			if(!$task_detail)
			{
				redirect('user_task/assigned');
			}
			
			
				$theme = getThemeName();
               $this->template->set_master_template($theme .'/template.php');
               $site_setting=site_setting();
			   
			     

			$theme = getThemeName();
			$this->template->set_master_template($theme .'/template.php');
			
			$data['worker_id']=$worker_id;
			$data['task_id']=$task_id;
			$data['task_user_id'] = $this->user_task_model->get_task_user($task_id);
			
			
			
			
			$data['task_detail']=$task_detail;
			$data['task_location']=$this->task_model->get_task_location($task_id);

			$limit = '10';
		   $offset ='0';

		   $data['result_new'] = $this->user_task_model->get_all_offer_on_task($task_id,$limit,$offset);
			

			//worker Details
			$data['user_worker_id'] =$worker_id;
			$data['worker_user_id'] = $worker_details->user_id;
			
			$data['site_setting']=site_setting();
			
			$data['result'] = $this->user_task_model->get_all_comments($worker_details->user_id,$task_id,$data['task_user_id']);
			
			
			
			   
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
					

				} else {
			
					$apply=$this->user_task_model->new_comment();
					
					
					$data['error']='';
					

					$data['comment'] = $this->input->post('comment');
					
					
					
					$notification = notification_setting($user_detail->user_id);
					$worker_notification = notification_setting($worker_details->user_id);
					
					$task_link ='<a href="'.base_url().'tasks/'.$task_detail->task_url_name.'">'.$task_detail->task_name.'</a>';
					$worker_link ='<a href="'.base_url().'user/'.$worker_details->profile_name.'">'.ucfirst($worker_details->full_name).'</a>';
					$poster_link ='<a href="'.base_url().'user/'.$user_detail->profile_name.'">'.ucfirst($user_detail->full_name).'</a>';
					$from_name = $poster_link;
						
					
					/////////////============Conversation start===========	
					if(isset($worker_notification->on_conversation)) {  

        				if($worker_notification->on_conversation==1) { 
							$email_template=$this->db->query("select * from ".$this->db->dbprefix('email_template')." where task='Conversation Message'");
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
						}
					}
					
					/////////////============Conversation end===========	
					
					
					
					
					
					
					
					
					if( $this->input->post('accept1') == 'Accept Offer') { 
						
						
						
						
						
						///////////////////////=============add amount==================
						
						
						
						///////==========total amount====
				
				$task_setting=task_setting();
				
				$total=0;
				
				if($task_detail->extra_cost>0) {
				
				$total=$total+$task_detail->extra_cost;
				
				}
				
				
				
				////===get worker offer price=====
		
		
		
		
		  $get_offfer_amount = $this->user_task_model->offer_price($worker_id, $task_id);
		  
		  
		
	
		
		
		if($get_offfer_amount)
		{	
			$total=$total+$get_offfer_amount->offer_amount;	 
		}
		 
		 ///////=======
		 
				 
				 
				 if($task_setting->task_post_fee>0) {
				 
				 $task_site_fee=number_format((($task_setting->task_post_fee*$total) / 100),2); 
			
					 $total=$total+$task_site_fee;
			
				}
				 
				 
				  $total=number_format($total,2);
				
				
				
				
				 
				  $wallet_amount=my_wallet_amount();
				
				
					/*****************pay now  and open slip type page*****/	
				
					if($site_setting->transection_need==1)
					{
					echo "<script>window.location.href='".site_url('user_task/pay_now/'.$task_id)."'</script>";
					}
					
								/*****************end pay now  *****/	
				
				
				/*****************direct accpet or open pop up page for add amount *****/
				
			
			
			//if($total>$wallet_amount)
				//{
						
						
						//echo "<script>window.location.href='".site_url('tasks/'.$task_detail->task_url_name.'/no/'.$get_offfer_amount->task_comment_id)."'</script>";
					
						
				//}
				
				else
				{
					
					
				
					$this->task_model->assign_now($task_id,$get_offfer_amount->task_comment_id);
					
					
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
												
						
								
							//email_send($email_address_from,$email_address_reply,$email_to,$email_subject,$str);
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
					
					
					
					
					
						
		
				}
						
						
						///////////////////////=============add amount==================
						
						
						
						
					
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
								
												
								$email_to=$worker_details->email;		
							
								$email_message=str_replace('{break}','<br/>',$email_message);	
								$email_message=str_replace('{worker_name}',ucfirst($worker_details->full_name),$email_message);			
								$email_message=str_replace('{task_name}',$task_link,$email_message);
								
								$str=$email_message;
								
								
									
								email_send($email_address_from,$email_address_reply,$email_to,$email_subject,$str);
							}
						}
						
						/////////////============Assign time  to worker end===========
						
						/////////////============Assign time  to admin start===========	

							$email_template=$this->db->query("select * from ".$this->db->dbprefix('email_template')." where task='Assign Time (Admin)'");
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
											
						
							
						email_send($email_address_from,$email_address_reply,$email_to,$email_subject,$str);
						
						/////////////============Assign time  to admin end===========	
					
					
					
					/*****************end   direct accpet or open pop up for add amount *****/
					
					
					
					
					} 
					
				//redirect('tasks/'.$task_name.'/assign');	
					if( $this->input->post('accept1') == 'Accept Offer') { 
						echo "<script>window.location.href='".site_url('user_task/assigned_task/')."'</script>";
					}
					else
					{
						echo "<meta http-equiv='refresh' content='0'>";
					}
				}

			   
               
               $data['theme']=$theme;
               $meta_setting=meta_setting();
               
               $pageTitle='Conversation for - '.$meta_setting->title;
               $metaDescription='Conversation for - '.$meta_setting->meta_description;
               $metaKeyword='Conversation for - '.$meta_setting->meta_keyword;
               
               $this->template->write('pageTitle',$pageTitle,TRUE);
               $this->template->write('metaDescription',$metaDescription,TRUE);
               $this->template->write('metaKeyword',$metaKeyword,TRUE);
               $this->template->write_view('header',$theme .'/layout/common/header_login',$data,TRUE);
               $this->template->write_view('content_center',$theme .'/layout/user_task/conversation',$data,TRUE);
               $this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
               $this->template->render(); 

       }
	   
	   
	  
	/*
	Function name :complete()
	Parameter : $task_id(task id)
	Return : none
	Use : add runner rating and review and close the task by task poster
	Description : add runner rating and review and close the task by task poster this function is called by http://hostname/user_task/complete
	*/ 	
	
	   
     function complete($task_id='')
     {        
             if(!check_user_authentication()) {  redirect('sign_up'); } 
			 
			   
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
			   $worker_detail = $this->worker_model->get_worker_info($task_detail->task_worker_id);
			   
			   $data['task_detail']=$task_detail;
			   
	   
               $theme = getThemeName();
               $this->template->set_master_template($theme .'/template.php');
               
			   $this->form_validation->set_rules('comment', 'Comment', 'required');
			  
			   
			   if($this->form_validation->run() == FALSE){
			
					if(validation_errors())
					{
						$data["error"] = validation_errors();
					}else{
						$data["error"] = "";
					}
					
					$data['comment'] = $this->input->post('comment');
					$data['complete'] = $this->input->post('complete');
					$data['task_id'] = $this->input->post('task_id');
					$data['comment_rate'] = $this->input->post('comment_rate');

				} else {
			
					$apply=$this->user_task_model->complete();

					$data['comment'] = $this->input->post('comment');
					$data['complete'] = $this->input->post('complete');
					$data['task_id'] = $this->input->post('task_id');
					$data['comment_rate'] = $this->input->post('comment_rate');
					
					
					
						////////============	if poster agree on complete
						
						
						
					if($this->input->post('complete')==1)
					{
					///////////////========addd money to worker wallet
					
							/////===add cdoe from here in submit and close
							
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
							 
							$task_setting=task_setting();
							$task_worker_fee=$task_setting->task_worker_fee;
							
							 //$total=number_format($total,2);
						
						//$total=str_replace(',','',number_format($total,2));

						$total=number_format($total,2,'.','');
							//$worker_fee=number_format((($total*$task_worker_fee)/100),2);
							
							
							
							 $worker_fee=0;
						 
							 if($task_worker_fee>0)
							 {
						
								 //$worker_fee=str_replace(',','',number_format((($total*$task_worker_fee)/100),2));
						
								$worker_fee=number_format((($total*$task_worker_fee)/100),2,'.','');

							}
					
						
							//$amount_pay=str_replace(',','',number_format(($total- $worker_fee),2));
						
							
							
							 $amount_pay=number_format(($total- $worker_fee),2,'.','');
							

							$worker_detail=$this->worker_model->get_worker_info($task_detail->task_worker_id);
							
							$worker_user_id=$worker_detail->user_id;
							
							//exit;
							
							$trans_id='WL'.randomCode();
							
							$worker_wallet_data=array(
								'debit'=>$amount_pay,
								'total_user_price'=>$total,
								'total_cut_price'=>$worker_fee,
								'user_id'=>$worker_user_id,
								'wallet_transaction_id'=>$trans_id,
								'wallet_date'=>date('Y-m-d H:i:s'),
								'admin_status'=>'Confirm',
								'task_id'=>$task_id
							);
							$this->db->insert('wallet',$worker_wallet_data);
							
							
							
							/////=====
							
							$message = array(
								'act' => 'workerwallet',
								'task_id' => $task_id,
								'poster_user_id' => get_authenticateUserID(),
								'receiver_user_id' => $worker_user_id,
								'is_read' => 0,
								'message_date' => date('Y-m-d H:i:s')
							);
							$this->db->insert('message', $message);




							
							////////////====addd email for worker amount add to his wallet====
									
									$site_setting=site_setting();
									$notification = notification_setting($task_detail->user_id);
									$worker_notification = notification_setting($worker_user_id);
									//echo '<pre>'; print_r($notification); print_r($worker_notification); die();

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
									
									
									//////////////////====worker money add part
									
									
									
									
						}
						
						
						////////============	if poster agree on complete
									
									
									
									
									
					
	if( $this->input->post('sub_task') == 'Submit & Closed'){

				
							
							//////==============
					
					} 
					else {
					
						$task_link ='<a href="'.base_url().'tasks/'.$task_detail->task_url_name.'">'.$task_detail->task_name.'</a>';
						$poster_link ='<a href="'.base_url().'user/'.$user_detail->profile_name.'">'.ucfirst($user_detail->full_name).'</a>';				
						
						$notification = notification_setting($user_detail->user_id);
						$worker_notification = notification_setting($worker_detail->user_id);
						
						/////////////============Complete time  to poster start===========	
						if(isset($notification->on_complete_task)) {  
	
							if($notification->on_complete_task==1) { 
							
								$email_template=$this->db->query("select * from ".$this->db->dbprefix('email_template')." where task='Complete Task by User (Poster)'");
								$email_temp=$email_template->row();
								
								
								$email_address_from=$email_temp->from_address;
								$email_address_reply=$email_temp->reply_address;
								
								$email_subject=$email_temp->subject;				
								$email_message=$email_temp->message;			
								
												
								$email_to=$user_detail->email;		
	
								
								$email_message=str_replace('{break}','<br/>',$email_message);
								$email_message=str_replace('{poster_name}',ucfirst($user_detail->full_name),$email_message);		
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
							
								$email_template=$this->db->query("select * from ".$this->db->dbprefix('email_template')." where task='Complete Task by User (Worker)'");
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
							
						/////////////============Complete time  to worker end===========
						
						/////////////============Complete time  to admin start===========	
	
							$email_template=$this->db->query("select * from ".$this->db->dbprefix('email_template')." where task='Complete Task by User (Admin)'");
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
						
					}
					
					
					
					
					
					echo "<script>window.location.href='".site_url('user_task/assigned_task')."'</script>";
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
               $this->template->write_view('content_center',$theme .'/layout/user_task/complete_task',$data,TRUE);
               $this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
               $this->template->render();        
               
       }
       function review_employer($task_id='')
 {
 			if(!check_user_authentication()) {  redirect('sign_up'); } 
			 
			   
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
			   $worker_detail = $this->worker_model->get_worker_info($task_detail->task_worker_id);
			   
			   $data['task_detail']=$task_detail;
			   
	   
               $theme = getThemeName();
               $this->template->set_master_template($theme .'/template.php');
               
			   $this->form_validation->set_rules('comment', 'Comment', 'required');

			   if($this->form_validation->run() == FALSE){
			
					if(validation_errors())
					{
						$data["error"] = validation_errors();
					}else{
						$data["error"] = "";
					}
					
					

				}
				else
				{
					$data['comment'] = $this->input->post('comment');
					$data['task_id'] = $this->input->post('task_id');
					$data['employer_id'] = $this->input->post('employer_id');
					$data['comment_rate'] = $this->input->post('comment_rate');
					$this->user_task_model->employer_review($data);

					echo "<script>window.location.href='".site_url('user_task/assigned_task')."'</script>";

				}
 			

 			$data['task_id']=$task_id;
			$data['taskdetail'] = $this->task_model->get_tasks_detail_by_id($task_id);
			$data['site_setting']=site_setting();
            $data['theme']=$theme;
            $meta_setting=meta_setting();
               
            $pageTitle='Employer Review - '.$meta_setting->title;
            $metaDescription='Employer Review - '.$meta_setting->meta_description;
            $metaKeyword='Employer Review - '.$meta_setting->meta_keyword;
               
            $this->template->write('pageTitle',$pageTitle,TRUE);
            $this->template->write('metaDescription',$metaDescription,TRUE);
            $this->template->write('metaKeyword',$metaKeyword,TRUE);
            $this->template->write_view('header',$theme .'/layout/common/header_login',$data,TRUE);
            $this->template->write_view('content_center',$theme .'/layout/user_task/review_employer',$data,TRUE);
            $this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
            $this->template->render();

 }

	
}

?>