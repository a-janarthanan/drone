<?php
class User extends ROCKERS_Controller 
{
	
	/*
	Function name :User()
	Description :Its Default Constuctor which called when user object initialzie.its load necesary models
	*/
	function User()
	{
		parent::__construct();	
		$this->load->model('home_model');	
		$this->load->model('user_model');	
		$this->load->model('task_model');
		$this->load->model('worker_model');
		$this->load->model('user_task_model');
		$this->load->model('worker_task_model');
		$this->load->model('user_other_model');
		$this->load->model('message_model');
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
	Function name :dashboard()
	Parameter :none
	Return : none
	Use : display user dashboard
	Description : get user dashboard which is called by this function http://hostname/user/dashboard or 
	              SEO friendly url for http://hostname/dashboard
	*/
		
		
	function dashboard()
	{	
		  if(!check_user_authentication()) {  redirect('sign_up'); } 
		  
		  $user_info=$this->user_model->get_user_info(get_authenticateUserID());
		$data['user_info']=$user_info;
		$user_profile=$this->user_model->get_user_profile_by_id(get_authenticateUserID());
		$data['user_profile']=$user_profile;
		$my_task_limit=7;
		$top_task_limit=10;
		$new_task_limit=10;
		
		$data['my_task']=$this->user_model->my_task($my_task_limit);
		
		$data['top_task']=$this->user_model->top_task($top_task_limit);		
		$data['new_task']=$this->user_model->new_task($new_task_limit);	

		$data['total_assigned_task']=$this->user_task_model->get_total_assigned_task();
		$data['total_draft_task']=$this->user_task_model->get_total_draft_task();
		$data['total_open_task']=$this->user_task_model->get_total_open_task();
		$data['total_complete_task']=$this->user_task_model->get_total_closed_task();

		$data['total_bid_task']=$this->worker_task_model->get_total_open_task();
		$data['total_assign_task']=$this->worker_task_model->get_total_assigned_task();
		$data['total_close_task']=$this->worker_task_model->get_total_closed_task();
		
		
		$map_tasklists=$this->user_model->get_map_city_task();
		$data['map_tasklists']=$map_tasklists;
		
				
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$data['theme']=$theme;
		$meta_setting=meta_setting();
		
		$pageTitle='Dashboard - '.$meta_setting->title;
		$metaDescription='Dashboard - '.$meta_setting->meta_description;
		$metaKeyword='Dashboard - '.$meta_setting->meta_keyword;
		
		$this->template->write('pageTitle',$pageTitle,TRUE);
		$this->template->write('metaDescription',$metaDescription,TRUE);
		$this->template->write('metaKeyword',$metaKeyword,TRUE);
		$this->template->write_view('header',$theme .'/layout/common/header_login',$data,TRUE);
		$this->template->write_view('content_center',$theme .'/layout/user/dashboard',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();	
		
	}
	
	
	/*
	Function name :my_account()
	Parameter :none
	Return : none
	Use : display user account
	Description : get user account view which is called by this function http://hostname/user/my_account or 
	              SEO friendly url for http://hostname/account
	*/
	
	function my_account($msg='')
	{
		  if(!check_user_authentication()) {  redirect('sign_up'); } 
		  
		  
		$user_info=$this->user_model->get_user_info(get_authenticateUserID());
		$data['user_info']=$user_info;
		
		$data['location']= $this->user_other_model->get_locations_list();
		
		$activities_limit=15;
		$data['activities']=$this->user_model->get_user_recent_activities(get_authenticateUserID(),$activities_limit);
		
		
		$data['msg']=$msg;
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$data['theme']=$theme;
		
		$meta_setting=meta_setting();
		
		$pageTitle=$user_info->first_name.' '.substr($user_info->last_name,0,1).' - '.$meta_setting->title;
		$metaDescription=$user_info->first_name.' '.substr($user_info->last_name,0,1).' - '.$meta_setting->meta_description;
		$metaKeyword=$user_info->first_name.' '.substr($user_info->last_name,0,1).' - '.$meta_setting->meta_keyword;
		
		
		$this->template->write('pageTitle',$pageTitle,TRUE);
		$this->template->write('metaDescription',$metaDescription,TRUE);
		$this->template->write('metaKeyword',$metaKeyword,TRUE);
		$this->template->write_view('header',$theme .'/layout/common/header_login',$data,TRUE);
		$this->template->write_view('content_center',$theme .'/layout/user/my_account',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();	
	}
	
	
	
	/*
	Function name :email_check()
	Parameter : $email
	Return : boolean
	Use : check user unquie email address in the system
	Description : check user unquie email address
	*/
	
		
	function email_check($email)
	{
		$cemail = $this->user_model->editemailTaken($email);
		
		if($cemail)
		{
			$this->form_validation->set_message('email_check', 'There is an existing account associated with this email');
			return FALSE;
		}
		else
		{
				return TRUE;
		}
	}	
	
	
	/*
	Function name :edit()
	Parameter :none
	Return : none
	Use : edit user account information
	Description : edit user account information which is called by this function http://hostname/user/edit
	*/
	
	function edit()
	{
		
		  if(!check_user_authentication()) {  redirect('sign_up'); } 
		  
		  
		$user_info=$this->user_model->get_user_info(get_authenticateUserID());
		$data['user_info']=$user_info;
		
		
		$site_setting=site_setting();
		
		$this->form_validation->set_rules('first_name', 'First Name', 'required|alpha');
		$this->form_validation->set_rules('last_name', 'Last Name', 'required|alpha');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_email_check');		
		//$this->form_validation->set_rules('zip_code', 'Postal Code', 'required|alpha_numeric|min_length['.$site_setting->zipcode_min.']|max_length['.$site_setting->zipcode_max.']');	
		$this->form_validation->set_rules('mobile_no', 'Mobile No.', 'numeric|exact_length[10]');	
		$this->form_validation->set_rules('phone_no', 'Phone No.', 'numeric|min_length[9]|max_length[12]');	
		
		if($this->form_validation->run() == FALSE)
		{
				if(validation_errors())
				{													
					$data["error"] = validation_errors();
				}
				else
				{		
					$data["error"] = "";							
				}
				
				
				if($_POST)
				{
				
					$data['first_name']=$this->input->post('first_name');
					$data['last_name']=$this->input->post('last_name');
					$data['email']=$this->input->post('email');
					$data['zip_code']=$this->input->post('zip_code');
					$data['mobile_no']=$this->input->post('mobile_no');
					$data['phone_no']=$this->input->post('phone_no');		
				
				}
				
				else
				{
					
					$data['first_name']=$user_info->first_name;
					$data['last_name']=$user_info->last_name;
					$data['email']=$user_info->email;
					$data['zip_code']=$user_info->zip_code;
					$data['mobile_no']=$user_info->mobile_no;
					$data['phone_no']=$user_info->phone_no;
					
				}
				
		
				
		} else	{
							
			$reset_password = $this->user_model->edit_account();
			$data['error']="update";
			
			$this->load->helper('security');
			
			$this->session->set_userdata('full_name', $this->security->xss_clean($this->input->post('first_name').' '.$this->input->post('last_name')));	
		
		
			$user_info=$this->user_model->get_user_info(get_authenticateUserID());
		    $data['user_info']=$user_info;
		
		
			
				$data['first_name']=$user_info->first_name;
				$data['last_name']=$user_info->last_name;
				$data['email']=$user_info->email;
				$data['zip_code']=$user_info->zip_code;
				$data['mobile_no']=$user_info->mobile_no;
				$data['phone_no']=$user_info->phone_no;
			
			
	   }	
			   
			   
			   
		
		$data['location']='';
		$data['activities']='';
			
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$data['theme']=$theme;
		
		$meta_setting=meta_setting();
		
		$pageTitle='Edit Memebr : '.$user_info->first_name.' '.substr($user_info->last_name,0,1).' - '.$meta_setting->title;
		$metaDescription='Edit Memebr : '.$user_info->first_name.' '.substr($user_info->last_name,0,1).' - '.$meta_setting->meta_description;
		$metaKeyword='Edit Memebr : '.$user_info->first_name.' '.substr($user_info->last_name,0,1).' - '.$meta_setting->meta_keyword;
		
		
		$this->template->write('pageTitle',$pageTitle,TRUE);
		$this->template->write('metaDescription',$metaDescription,TRUE);
		$this->template->write('metaKeyword',$metaKeyword,TRUE);
		$this->template->write_view('header',$theme .'/layout/common/header_login',$data,TRUE);
		$this->template->write_view('content_center',$theme .'/layout/user/edit_account',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();	
		
	}
	
	/*
	Function name :change_password()
	Parameter :none
	Return : none
	Use : change the user current password
	Description : change the user current password which is called by this function http://hostname/user/change_password or 
	              SEO friendly url for http://hostname/change_password
	*/
	
	function change_password()
	{
		
		  if(!check_user_authentication()) {  redirect('sign_up'); } 
		  
		  
		$user_info=$this->user_model->get_user_info(get_authenticateUserID());
		$data['user_info']=$user_info;
		$data['current_password']=$this->input->post('current_password');
		
		$site_setting=site_setting();
		
		$this->form_validation->set_rules('current_password', 'Old Password', 'required');
		$this->form_validation->set_rules('password', 'New Password', 'required|min_length[8]|matches[confirm_password]');
		$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required');
		if($this->form_validation->run() == FALSE)
		{
				if(validation_errors())
				{													
					$data["error"] = validation_errors();
				}
				else
				{		
					$data["error"] = "";							
				}
				
				
				
				
		
				
		} else	{
							
			$reset_password = $this->user_model->change_password();
			$data['error']="update";
			
			redirect('account/password_change');	
			
	   }	
			   
			   
			   
		
		$data['location']='';
		$data['activities']='';
			
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$data['theme']=$theme;
		
		$meta_setting=meta_setting();
		
		$pageTitle='Change Password : '.$user_info->first_name.' '.substr($user_info->last_name,0,1).' - '.$meta_setting->title;
		$metaDescription='Change Password : '.$user_info->first_name.' '.substr($user_info->last_name,0,1).' - '.$meta_setting->meta_description;
		$metaKeyword='Change Password : '.$user_info->first_name.' '.substr($user_info->last_name,0,1).' - '.$meta_setting->meta_keyword;
		
		
		$this->template->write('pageTitle',$pageTitle,TRUE);
		$this->template->write('metaDescription',$metaDescription,TRUE);
		$this->template->write('metaKeyword',$metaKeyword,TRUE);
		$this->template->write_view('header',$theme .'/layout/common/header_login',$data,TRUE);
		$this->template->write_view('content_center',$theme .'/layout/user/change_password',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();	
		
		
	}
	
	
	/*
	Function name :notifications()
	Parameter :none
	Return : none
	Use : change the user notifications
	Description : change the user notifications which is called by this function http://hostname/user/notifications or 
	              SEO friendly url for http://hostname/notifications
	*/
	
	
	function notifications()
	{
		
		
		  if(!check_user_authentication()) {  redirect('sign_up'); } 
		
		$user_info=$this->user_model->get_user_info(get_authenticateUserID());
		$data['user_info']=$user_info;
		
		
		$site_setting=site_setting();
		
		$this->form_validation->set_rules('on_assign_task', 'On Assing Task', 'required');
		$this->form_validation->set_rules('on_expire_task', 'On Expire Task', 'required');

		
		if($this->form_validation->run() == FALSE)
		{
				if(validation_errors())
				{													
					$data["error"] = validation_errors();
				}
				else
				{		
					$data["error"] = "";							
				}
				
			
				$user_notification=$this->user_model->get_user_notification(get_authenticateUserID());
		    	$data['user_notification']=$user_notification;
				
		
				
		} else	{
							
			$change_notification = $this->user_model->change_notification();
			$data['error']="update";
			
			
			$user_notification=$this->user_model->get_user_notification(get_authenticateUserID());
		    $data['user_notification']=$user_notification;
		
	   }	
			   
			   
			   
		
		$data['location']='';
		$data['activities']='';
			
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$data['theme']=$theme;
		
		$meta_setting=meta_setting();
		
		$pageTitle='Notifications : '.$user_info->first_name.' '.substr($user_info->last_name,0,1).' - '.$meta_setting->title;
		$metaDescription='Notifications : '.$user_info->first_name.' '.substr($user_info->last_name,0,1).' - '.$meta_setting->meta_description;
		$metaKeyword='Notifications : '.$user_info->first_name.' '.substr($user_info->last_name,0,1).' - '.$meta_setting->meta_keyword;
		
		
		$this->template->write('pageTitle',$pageTitle,TRUE);
		$this->template->write('metaDescription',$metaDescription,TRUE);
		$this->template->write('metaKeyword',$metaKeyword,TRUE);
		$this->template->write_view('header',$theme .'/layout/common/header_login',$data,TRUE);
		$this->template->write_view('content_center',$theme .'/layout/user/notification',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();	
		
	}
	
	
	/*
	Function name :profile()
	Parameter : $profile_name(user seo friendly name), $msg(custom message)
	Return : none
	Use : display user profile
	Description : display user profile which is called by this function http://hostname/user/profile/profile-name or 
	              SEO friendly url for http://hostname/profile/profile-name
	*/
	
	function profile($profile_name,$msg='')
	{
			
		$check_user_profile=$this->user_model->check_user_profile_exists($profile_name);
		
		
	
		if(!$check_user_profile) { redirect('home'); }
		
		
		
		
		$user_profile=$this->user_model->get_user_profile($profile_name);
		$data['user_profile']=$user_profile;
		
		
		$reviews_limit=15;
		$data['reviews']=$this->user_model->get_user_recent_reviews($user_profile->user_id,$reviews_limit);
		
		$empreviews_limit=15;
		$data['emplye_reviews']=$this->user_model->get_employer_recent_reviews($user_profile->user_id,$empreviews_limit);
		

		
		$activities_limit=15;
		$data['activities']=$this->user_model->get_user_recent_activities($user_profile->user_id,$activities_limit);
			
		$data['msg']=$msg;
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$data['theme']=$theme;
		
		$meta_setting=meta_setting();
		
		$data['portfolio_photo']=$this->user_model->get_user_portfolio_photo($user_profile->user_id);
		$data['portfolio_video']=$this->user_model->get_user_portfolio_video($user_profile->user_id);

	
		$pageTitle=$user_profile->first_name.' '.substr($user_profile->last_name,0,1).' - '.$meta_setting->title;
		$metaDescription=$user_profile->first_name.' '.substr($user_profile->last_name,0,1).' - '.$meta_setting->meta_description;
		$metaKeyword=$user_profile->first_name.' '.substr($user_profile->last_name,0,1).' - '.$meta_setting->meta_keyword;
		
		
		$this->template->write('pageTitle',$pageTitle,TRUE);
		$this->template->write('metaDescription',$metaDescription,TRUE);
		$this->template->write('metaKeyword',$metaKeyword,TRUE);
		$this->template->write_view('header',$theme .'/layout/common/header_home',$data,TRUE);
		$this->template->write_view('content_center',$theme .'/layout/user/profile',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();	
	
	}
	
	
	
	/*
	Function name :activities()
	Parameter : $profile_name(user seo friendly name), $offset(for paging)
	Return : none
	Use : display user activities
	Description : display user profile activities which is called by this function http://hostname/user/activities/profile-name/ or 
	              SEO friendly url for http://hostname/profile/profile-name/activities
	*/
	
	function activities($profile_name,$offset=0)
   {        
		   
		  
		   $check_user_profile=$this->user_model->check_user_profile_exists($profile_name);
	
			if(!$check_user_profile) { redirect('home'); }
			
			
			
			
			$user_profile=$this->user_model->get_user_profile($profile_name);
			$data['user_profile']=$user_profile;
			
			$reviews_limit=15;
			$data['reviews']=$this->user_model->get_user_recent_reviews($user_profile->user_id,$reviews_limit);
			
			$empreviews_limit=15;
			$data['emplye_reviews']=$this->user_model->get_employer_recent_reviews($user_profile->user_id,$empreviews_limit);
		
			
			$this->load->library('pagination');
			
			$limit=10;
			
			if($offset>0)
			{
				$config['uri_segment']='4';
			}
			else
			{
				$config['uri_segment']='3';
			}
			
			 
			$config['base_url'] = site_url('user/'.$profile_name.'/activities');
			$config['total_rows'] = $this->user_model->get_user_total_activities($user_profile->user_id);
			$config['per_page'] = $limit;
					
			$this->pagination->initialize($config);		
			
			$data['page_link'] = $this->pagination->create_links();
			$data['activities'] = $this->user_model->get_user_all_activities($user_profile->user_id,$limit,$offset);
			
			$data['total_rows']=$config['total_rows'];				
			$data['limit']=$limit;
			
		 //echo "hi";exit;
			
		   $theme = getThemeName();
		   $this->template->set_master_template($theme .'/template.php');
		   
		   
		   $data['theme']=$theme;
		   $meta_setting=meta_setting();
		   
		   $pageTitle='Activities for - '.$user_profile->first_name.' '.substr($user_profile->last_name,0,1);
		   $metaDescription='Activities for - '.$user_profile->first_name.' '.substr($user_profile->last_name,0,1);
		   $metaKeyword='Activities for - '.$user_profile->first_name.' '.substr($user_profile->last_name,0,1);
		   
		   $this->template->write('pageTitle',$pageTitle,TRUE);
		   $this->template->write('metaDescription',$metaDescription,TRUE);
		   $this->template->write('metaKeyword',$metaKeyword,TRUE);
		   $this->template->write_view('header',$theme .'/layout/common/header_home',$data,TRUE);
		   $this->template->write_view('content_center',$theme .'/layout/user/activities',$data,TRUE);
		   $this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		   $this->template->render();        
		   
   }
	   
	   
	
	
	/*
	Function name :reviews()
	Parameter : $profile_name(user seo friendly name), $offset(for paging)
	Return : none
	Use : display user reviews
	Description : display user profile reviews which is called by this function http://hostname/user/reviews/profile-name/ or 
	              SEO friendly url for http://hostname/profile/profile-name/reviews
	*/
	
	function reviews($profile_name,$offset=0)
   {        
		   
		   $check_user_profile=$this->user_model->check_user_profile_exists($profile_name);
	
			if(!$check_user_profile) { redirect('home'); }
			
			
			
			
			$user_profile=$this->user_model->get_user_profile($profile_name);
			$data['user_profile']=$user_profile;
			
			$reviews_limit=15;
			$data['reviews']=$this->user_model->get_user_recent_reviews($user_profile->user_id,$reviews_limit);
	

			$activities_limit=15;
			$data['activities']=$this->user_model->get_user_recent_activities($user_profile->user_id,$activities_limit);
		
			$empreviews_limit=15;
			$data['emplye_reviews']=$this->user_model->get_employer_recent_reviews($user_profile->user_id,$empreviews_limit);
		
		
			
			$this->load->library('pagination');
			
			$limit=10;
			
			if($offset>0)
			{
				$config['uri_segment']='4';
			}
			else
			{
				$config['uri_segment']='3';
			}
			
			
			$config['base_url'] = site_url('user/'.$profile_name.'/reviews');
			$config['total_rows'] = $this->user_model->get_user_total_reviews($user_profile->user_id);
			$config['per_page'] = $limit;
					
			$this->pagination->initialize($config);		
			
			$data['page_link'] = $this->pagination->create_links();
			$data['result'] = $this->user_model->get_user_all_reviews($user_profile->user_id,$limit,$offset);
			
			$data['total_rows']=$config['total_rows'];				
			$data['limit']=$limit;
			
			
			
			
		   $theme = getThemeName();
		   $this->template->set_master_template($theme .'/template.php');
		   
		   
		   $data['theme']=$theme;
		   $meta_setting=meta_setting();
		   
		   $pageTitle='Reviews for - '.$user_profile->first_name.' '.substr($user_profile->last_name,0,1);
		   $metaDescription='Reviews for - '.$user_profile->first_name.' '.substr($user_profile->last_name,0,1);
		   $metaKeyword='Reviews for - '.$user_profile->first_name.' '.substr($user_profile->last_name,0,1);
		   
		   $this->template->write('pageTitle',$pageTitle,TRUE);
		   $this->template->write('metaDescription',$metaDescription,TRUE);
		   $this->template->write('metaKeyword',$metaKeyword,TRUE);
		   $this->template->write_view('header',$theme .'/layout/common/header_home',$data,TRUE);
		   $this->template->write_view('content_center',$theme .'/layout/user/reviews',$data,TRUE);
		   $this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		   $this->template->render();        
		   
   }

 function emplye_reviews($profile_name,$offset=0)
   {        
		   
		   $check_user_profile=$this->user_model->check_user_profile_exists($profile_name);
	
			if(!$check_user_profile) { redirect('home'); }
			
			
			
			
			$user_profile=$this->user_model->get_user_profile($profile_name);
			$data['user_profile']=$user_profile;
			
			$reviews_limit=15;
			$data['reviews']=$this->user_model->get_user_recent_reviews($user_profile->user_id,$reviews_limit);
	

			$activities_limit=15;
			$data['activities']=$this->user_model->get_user_recent_activities($user_profile->user_id,$activities_limit);
		
		
			
			$this->load->library('pagination');
			
			$limit=10;
			
			if($offset>0)
			{
				$config['uri_segment']='4';
			}
			else
			{
				$config['uri_segment']='3';
			}
			
			
			$config['base_url'] = site_url('user/'.$profile_name.'/reviews');
			$config['total_rows'] = $this->user_model->get_employe_total_reviews($user_profile->user_id);
			$config['per_page'] = $limit;
					
			$this->pagination->initialize($config);		
			
			$data['page_link'] = $this->pagination->create_links();
			$data['result'] = $this->user_model->get_emp_all_reviews($user_profile->user_id,$limit,$offset);
			
			$data['total_rows']=$config['total_rows'];				
			$data['limit']=$limit;
			
			
			
			
		   $theme = getThemeName();
		   $this->template->set_master_template($theme .'/template.php');
		   
		   
		   $data['theme']=$theme;
		   $meta_setting=meta_setting();
		   
		   $pageTitle='Reviews for - '.$user_profile->first_name.' '.substr($user_profile->last_name,0,1);
		   $metaDescription='Reviews for - '.$user_profile->first_name.' '.substr($user_profile->last_name,0,1);
		   $metaKeyword='Reviews for - '.$user_profile->first_name.' '.substr($user_profile->last_name,0,1);
		   
		   $this->template->write('pageTitle',$pageTitle,TRUE);
		   $this->template->write('metaDescription',$metaDescription,TRUE);
		   $this->template->write('metaKeyword',$metaKeyword,TRUE);
		   $this->template->write_view('header',$theme .'/layout/common/header_home',$data,TRUE);
		   $this->template->write_view('content_center',$theme .'/layout/user/employeereviews',$data,TRUE);
		   $this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		   $this->template->render();        
		   
   }
 
	
	/*
	Function name :make_favorite()
	Parameter : $user_id(user id)
	Return : string 
	Use : user can make runner favorite
	Description : user can make runner favorite which is called by this function http://hostname/user/make_favorite/ from AJAX
	*/
	
	function make_favorite($user_id)
	{
		
		if(get_authenticateUserID()=='')
		{
			echo "login_failed";
			die();
		}
		else
		{
			$this->user_model->make_favorite($user_id);
			
			?>
            	<input name="" type="submit" class="btn btn-default btn-profile btn-profile15 btn-profile156" onClick="un_favorite(<?php echo $user_id;?>)" value="Un Favorite" style="width:200px" />
              
             <?php
			
		}
	}
	
	
	/*
	Function name :un_favorite()
	Parameter : $user_id(user id)
	Return : string 
	Use : user can make runner unfavorite
	Description : user can make runner unfavorite which is called by this function http://hostname/user/un_favorite/ from AJAX
	*/
	
	
	function un_favorite($user_id)
	{
		
		if(get_authenticateUserID()=='')
		{
			echo "login_failed";
			die();
		}
		else
		{
			$this->user_model->un_favorite($user_id);
			
			?>
            <input name="" type="submit" class="btn btn-default btn-profile btn-profile15 btn-profile156" onClick="make_favorite(<?php echo $user_id;?>)" value="Add as Favorite" style="width:200px" />
              
             <?php
		}
	}
	
	
	
	/*
	Function name :customize_profile()
	Parameter :  $msg(for cusotm message)
	Return : none
	Use : update user profile information
	Description : update user profile information which is called by this function http://hostname/user/customize_profile/ or 
	              SEO friendly url for http://hostname/customize_profile
	*/
	
	
	function customize_profile($msg='')
	{
		
		
		  if(!check_user_authentication()) {  redirect('sign_up'); } 
		  
		  
		$user_profile=$this->user_model->get_user_profile(getUserProfileName());
		$data['user_profile']=$user_profile;
		
		$data['portfolio_photo']=$this->user_model->get_user_portfolio_photo(get_authenticateUserID());
 		$data['portfolio_video']=$this->user_model->get_user_portfolio_video(get_authenticateUserID());


		
		$site_setting=site_setting();
		
		
		$this->form_validation->set_rules('facebook_link', 'Facebook Link', 'valid_url');		
		$this->form_validation->set_rules('linkedin_link', 'Linkedin Link', 'valid_url');
		$this->form_validation->set_rules('twitter_link', 'Twitter Link', 'valid_url');
		$this->form_validation->set_rules('youtube_link', 'Youtube Link', 'valid_url');
		$this->form_validation->set_rules('own_site_link', 'Home Link', 'valid_url');
		$this->form_validation->set_rules('blog_link', 'Blog Link', 'valid_url');
		$this->form_validation->set_rules('yelp_link', 'Yelp Link', 'valid_url');
		
		if($this->form_validation->run() == FALSE)
		{
				if(validation_errors())
				{													
					$data["error"] = validation_errors();
				}
				else
				{		
					$data["error"] = "";							
				}
				
				
				if($_POST)
				{
					
					
					$data['current_city']=$this->input->post('current_city');
					$data['about_user']=$this->input->post('about_user');
					$data['facebook_link']=$this->input->post('facebook_link');
					$data['linkedin_link']=$this->input->post('linkedin_link');
					$data['twitter_link']=$this->input->post('twitter_link');
					$data['youtube_link']=$this->input->post('youtube_link');	
					$data['own_site_link']=$this->input->post('own_site_link');						
					$data['yelp_link']=$this->input->post('yelp_link');		
					$data['blog_link']=$this->input->post('blog_link');		
				
				}
				
				else
				{
					
					
						$content=$user_profile->about_user;
						$content=str_replace('KSYDOU','"',$content);
						$content=str_replace('KSYSING',"'",$content);
		
		
					$data['current_city']=$user_profile->current_city;
					$data['about_user']=$content;
					$data['facebook_link']=$user_profile->facebook_link;
					$data['linkedin_link']=$user_profile->linkedin_link;
					$data['twitter_link']=$user_profile->twitter_link;
					$data['youtube_link']=$user_profile->youtube_link;
					
					$data['own_site_link']=$user_profile->own_site_link;
					$data['yelp_link']=$user_profile->yelp_link;
					$data['blog_link']=$user_profile->blog_link;
					
				}
				
		
				
		} else	{
							
			$update_profile = $this->user_model->update_profile();
			$data['error']="update";
			
			redirect('user/'.getUserProfileName().'/update');
					
			$user_profile=$this->user_model->get_user_profile(getUserProfileName());
			$data['user_profile']=$user_profile;
			
		
			$data['current_city']=$user_profile->current_city;
			$data['about_user']=$user_profile->about_user;
			$data['facebook_link']=$user_profile->facebook_link;
			$data['linkedin_link']=$user_profile->linkedin_link;
			$data['twitter_link']=$user_profile->twitter_link;
			$data['youtube_link']=$user_profile->youtube_link;
			
			$data['own_site_link']=$user_profile->own_site_link;
			$data['yelp_link']=$user_profile->yelp_link;
			$data['blog_link']=$user_profile->blog_link;
			
			
	   }	
			   
		
		$user_info=$this->user_model->get_user_info(get_authenticateUserID());
		$data['user_info']=$user_info;
		
		
			   
		
		$data['msg']=$msg;	   
		
		$data['location']='';
		$data['activities']='';
			
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$data['theme']=$theme;
		
		$meta_setting=meta_setting();
		
		$pageTitle='Customize Profile : '.$user_profile->first_name.' '.substr($user_profile->last_name,0,1).' - '.$meta_setting->title;
		$metaDescription='Customize Profile : '.$user_profile->first_name.' '.substr($user_profile->last_name,0,1).' - '.$meta_setting->meta_description;
		$metaKeyword='Customize Profile : '.$user_profile->first_name.' '.substr($user_profile->last_name,0,1).' - '.$meta_setting->meta_keyword;
		
		
		$this->template->write('pageTitle',$pageTitle,TRUE);
		$this->template->write('metaDescription',$metaDescription,TRUE);
		$this->template->write('metaKeyword',$metaKeyword,TRUE);
		$this->template->write_view('header',$theme .'/layout/common/header_login',$data,TRUE);
		$this->template->write_view('content_center',$theme .'/layout/user/customize_profile',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();	
		
	
		
	}
	
	
	
	
	/*
	Function name :upload_photo()
	Parameter :  $ref_link(any refresnce url from where this function called)
	Return : string
	Use : user can update his profile photo
	Description : user can update his profile photo which is called by this function http://hostname/user/upload_photo/ open in pop-up
	*/
	
	
	function upload_photo($ref_link='')
	{
		if(!check_user_authentication()) { redirect('sign_up'); }
		
		
		$msg='fail';
		
		if($_FILES)
		{
			$this->user_model->upload_photo();
			$msg='success';
			$data['ref_link']=$this->input->post('ref_link');
		}
		
		$data['msg']=$msg;
		
		$user_profile=$this->user_model->get_user_profile_by_id(get_authenticateUserID());
		$data['user_profile']=$user_profile;	
		
		
		$theme = getThemeName();
		$this->template->set_master_template($theme . '/template.php');
		$data['theme'] = $theme;
		
		$data['ref_link']=$ref_link;
				
			
		$this->load->view( $theme . '/layout/user/upload_photo', $data);
		
	
	}



	
	/*
	Function name :pick_city()
	Parameter :  none
	Return : none
	Use : user can see the supported city list
	Description : user can see the supported city list which is called by this function http://hostname/user/pick_city/ open in pop-up
	*/
	
	
	function pick_city()
	{
		if(!check_user_authentication()) {  redirect('sign_up'); }	
	   
		
		$theme = getThemeName();
		$this->template->set_master_template($theme . '/template.php');
		$data['theme'] = $theme;
		
	
		$meta_setting = meta_setting();
		
		$this->load->view( $theme . '/layout/user/pick_city', $data);
		
	
	}
	
	/*
	Function name :update_city()
	Parameter :  $city_id(city id)
	Return : string
	Use : user can change his current city
	Description : user can change his current city which is called by this function http://hostname/user/update_city/ open in pop-up
	*/
	
	
	function update_city($city_id)
	{
	
		if(get_authenticateUserID()=='')
		{
			echo "login_failed";
			die();
		}
		else
		{
			$this->user_model->update_city($city_id);
			echo "success";
			die();
		}
	
	}
	
	
	
	/*
	Function name :user_video()
	Parameter : none
	Return : string
	Use : user can add video to his portfolio
	Description : user can add video to his portfolio which is called by this function http://hostname/user/user_video/ open in pop-up
	*/
	
	function user_video()
	{
		if(!check_user_authentication()) { redirect('sign_up'); }
		
		$msg='fail';
		
		if($_POST)
		{
			$this->user_model->user_video();
			$msg='success';
		}
		
		$data['msg']=$msg;
		
		$user_profile=$this->user_model->get_user_profile_by_id(get_authenticateUserID());
		$data['user_profile']=$user_profile;
		
		$theme = getThemeName();
		$this->template->set_master_template($theme . '/template.php');
		$data['theme'] = $theme;
		
		$this->load->view( $theme . '/layout/user/user_video', $data);
	}
	
	
	
	/*
	Function name :upload_portfolio()
	Parameter : none
	Return : string
	Use : user can add photo to his portfolio
	Description : user can add photo to his portfolio which is called by this function http://hostname/user/upload_portfolio/ open in pop-up
	*/
	
	
	function upload_portfolio()
	{
		if(!check_user_authentication()) { redirect('sign_up'); }
		
		
		$msg='fail';
		
		if($_FILES)
		{
			$this->user_model->upload_portfolio();
			$msg='success';
		}
		
		$data['msg']=$msg;
		
		$user_profile=$this->user_model->get_user_profile_by_id(get_authenticateUserID());
		$data['user_profile']=$user_profile;
		
		
		$theme = getThemeName();
		$this->template->set_master_template($theme . '/template.php');
		$data['theme'] = $theme;
		
		
		$this->load->view( $theme . '/layout/user/upload_portfolio', $data);
		
	
	}
	
	
   /*
	Function name :portfolio_view()
	Parameter : $portfolio_id(protfolio id)
	Return : string
	Use : user can view or delete photo to his portfolio
	Description : user can view or delete photo to his portfolio which is called by this function http://hostname/user/portfolio_view/ open in pop-up
	*/
	
   function portfolio_view($portfolio_id)
   {
		   if(!check_user_authentication()) { redirect('sign_up'); }
		   
		   $msg='fail';
		   
		   if($_POST)
		   {
				   $this->user_model->delete_portfolio();
				   $msg='success';
				   redirect('customize_profile/photo_delete');

		   }
		   
		   
		   

		   $data['msg']=$msg;
		   
		   
		   $user_portfolio=$this->user_model->get_portfolio_by_id($portfolio_id);
		   $data['user_portfolio']=$user_portfolio;        
		   
		   $theme = getThemeName();
		   $this->template->set_master_template($theme . '/template.php');
		   $data['theme'] = $theme;
				   
		   $this->load->view( $theme . '/layout/user/portfolio_view', $data);
   }
   
   
   /*
	Function name :delete_video()
	Parameter : $portfolio_id(protfolio id)
	Return : string
	Use : user can  delete video to his portfolio
	Description : user can delete video to his portfolio which is called by this function http://hostname/user/delete_video/ open in pop-up
	*/
	
	function delete_video($portfolio_id)
	{
		if(!check_user_authentication()) { redirect('sign_up'); }
		
		$this->user_model->delete_video($portfolio_id);
		$msg="video_delete";
		redirect('customize_profile/'.$msg);
	
	}


     /*
	Function name :complete_profile()
	Parameter : none
	Return : none
	Use : user can see his/her profile complate %
	Description : user can see how many % profile need to complete which is called by this function http://hostname/user/complete_profile/ open in pop-up
	*/
	
   
    function complete_profile()
	{
		if(!check_user_authentication()) { redirect('sign_up'); }
		
		
		
		$user_profile=$this->user_model->get_user_profile_by_id(get_authenticateUserID());
		$data['user_profile']=$user_profile;	
		
		$theme = getThemeName();
		$this->template->set_master_template($theme . '/template.php');
		$data['theme'] = $theme;
		$meta_setting = meta_setting();
		$this->load->view( $theme . '/layout/user/complete_profile', $data);
	}

	

	
}

?>