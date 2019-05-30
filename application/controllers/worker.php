<?php
class Worker extends ROCKERS_Controller 
{
	
	/*
	Function name :Worker()
	Description :Its Default Constuctor which called when worker object initialzie.its load necesary models
	*/
		
	function Worker()
	{
		parent::__construct();	
		$this->load->model('user_model');
		$this->load->model('worker_model');	
	}
	
	/*
	Function name :edit()
	Parameter :none
	Return : none
	Use : update runner application
	Description : edit runner application by this function which is called by http://hostname/worker/edit
	*/
	
	function edit()
	{
	
			
	
		if(!check_user_authentication()) {  redirect('sign_up'); }
		
		$taskers_info=$this->worker_model->get_worker_full_profile();
		
		
		if(!$taskers_info)
		{
			redirect('dashboard');
		}
		
		$worker_cities=array();

		$data['worker_citys']=$this->worker_model->get_worker_cities($taskers_info->worker_id);
		$data['worker_sate_citys']=$this->worker_model->getCityList1($taskers_info->task_state_id);
		
		$worker_city=$this->worker_model->get_worker_cities($taskers_info->worker_id);
		
		if($worker_city)
		{
			foreach($worker_city as $city)
			{
				$worker_cities[]=$city->city_id;
			}
		}
		
		
		$data['worker_document']=$this->worker_model->get_worker_document($taskers_info->worker_id);
		
		$task_types =  $this->worker_model->get_task_type();
		$data['task_types']=$task_types;
		
		$transportations =  $this->worker_model->get_transportation();
		$data['transportations']=$transportations; 
		
		$devices =  $this->worker_model->get_device();
		$data['devices']=$devices; 

		$data['state_list'] =$this->worker_model->get_state_list();
		
		$site_setting=site_setting();
		
		$this->form_validation->set_rules('worker_cities', 'Cities', 'required');
		$this->form_validation->set_rules('worker_location_name', 'Location name', 'required');
		$this->form_validation->set_rules('worker_address', 'Address', 'required');
		$this->form_validation->set_rules('worker_city', 'City', 'required');
		//$this->form_validation->set_rules('worker_state', 'State', 'required');
		//$this->form_validation->set_rules('worker_zipcode', 'Postal Code', 'required|min_length['.$site_setting->zipcode_min.']|max_length['.$site_setting->zipcode_max.']');
		
		
		//$this->form_validation->set_rules('worker_home_neighborhood', 'Home neighborhood', 'required');
		//$this->form_validation->set_rules('worker_work_neighborhood', 'Work neighborhood', 'required');
		
		$this->form_validation->set_rules('worker_task_type', 'Task types', 'required');
		$this->form_validation->set_rules('worker_transportation', 'Transportation', 'required');
		$this->form_validation->set_rules('worker_skills', 'Talents, skills, and qualities contribute', 'required');
		//$this->form_validation->set_rules('worker_devices', 'Devices', 'required');
		//$this->form_validation->set_rules('worker_Internet', 'Comfortable Internet', 'required');
		$this->form_validation->set_rules('worker_available_day', 'Available Day', 'required');
		$this->form_validation->set_rules('worker_available_time', 'Available Time', 'required');
		$this->form_validation->set_rules('worker_securitynum', 'Worker Security Number', 'required');
		//$this->form_validation->set_rules('worker_hear_about', 'How did you hear about us,', 'required');
		//$this->form_validation->set_rules('worker_background', 'Background check,', 'required');
		
			if($this->form_validation->run() == FALSE){
			
				if(validation_errors())
				{
					$data["error"] = validation_errors();
				}else{
					$data["error"] = "";
				}
				
				
				if($_POST)
				{
				
				$data['worker_cities'] = $this->input->post('worker_cities');
				$data['task_state_id'] = $this->input->post('task_state_id');
				$data['worker_location_name'] = $this->input->post('worker_location_name');
				$data['worker_address'] = $this->input->post('worker_address');
				$data['worker_city'] = $this->input->post('worker_city');
				$data['worker_state'] = $this->input->post('worker_state');
				$data['worker_zipcode'] = $this->input->post('worker_zipcode');
				
				$data['save_location']=$this->input->post('save_location');
				
				$data['worker_home_neighborhood'] = $this->input->post('worker_home_neighborhood');
				$data['worker_work_neighborhood'] = $this->input->post('worker_work_neighborhood');
				
				$data['worker_task_type'] = $this->input->post('worker_task_type');
				$data['worker_transportation'] = $this->input->post('worker_transportation');
				$data['worker_skills'] = $this->input->post('worker_skills');
				$data['worker_devices'] = $this->input->post('worker_devices');
				$data['worker_Internet'] = $this->input->post('worker_Internet');
				$data['worker_available_day'] = $this->input->post('worker_available_day');
				$data['worker_available_time'] = $this->input->post('worker_available_time');
				$data['worker_availability'] = $this->input->post('worker_availability');
				$data['worker_hear_about'] = $this->input->post('worker_hear_about');
				$data['worker_background'] = $this->input->post('worker_background');
				$data['worker_securitynum'] = $this->input->post('worker_securitynum');
				$data['bobyear'] = $this->input->post('bobyear');
				$data['bobmonth'] = $this->input->post('bobmonth');
				$data['bobday'] = $this->input->post('bobday');
				
				}
				
				else
				{
					
					
					$data['worker_cities'] = $worker_cities;
					$data['worker_location_name'] = $taskers_info->worker_location_name;
					$data['worker_address'] = $taskers_info->worker_address;
					$data['worker_city'] = $taskers_info->worker_city;
					$data['worker_state'] = $taskers_info->worker_state;
					$data['worker_zipcode'] = $taskers_info->worker_zipcode;
					$data['task_state_id'] = $taskers_info->task_state_id;
					
					$data['save_location']='';
					
					$data['worker_home_neighborhood'] = $taskers_info->worker_home_neighborhood;
					$data['worker_work_neighborhood'] = $taskers_info->worker_work_neighborhood;
					
					$ex_task_type=array();
					if($taskers_info->worker_task_type!='')
					{
						if(substr_count($taskers_info->worker_task_type,',')>0)
						{
							$ex_task_type=explode(',',$taskers_info->worker_task_type);					
						}
						else
						{
							$ex_task_type[]=$taskers_info->worker_task_type;
						}
					
					}
					
					
					
					$data['worker_task_type'] = $ex_task_type;
					
					
					$ex_worker_transportation=array();
					if($taskers_info->worker_transportation!='')
					{
						if(substr_count($taskers_info->worker_transportation,',')>0)
						{
							$ex_worker_transportation=explode(',',$taskers_info->worker_transportation);					
						}
						else
						{
							$ex_worker_transportation[]=$taskers_info->worker_transportation;
						}
					
					}
					
					
					$data['worker_transportation'] = $ex_worker_transportation;
					$data['worker_skills'] = $taskers_info->worker_skills;
					
					
					$ex_worker_devices=array();
					if($taskers_info->worker_devices!='')
					{
						if(substr_count($taskers_info->worker_devices,',')>0)
						{
							$ex_worker_devices=explode(',',$taskers_info->worker_devices);					
						}
						else
						{
							$ex_worker_devices[]=$taskers_info->worker_devices;
						}
					
					}
					
					$data['worker_devices'] = $ex_worker_devices;
				
					$data['worker_Internet'] = $taskers_info->worker_Internet;
					
					
					
					$ex_worker_available_day=array();
					if($taskers_info->worker_available_day!='')
					{
						if(substr_count($taskers_info->worker_available_day,',')>0)
						{
							$ex_worker_available_day=explode(',',$taskers_info->worker_available_day);					
						}
						else
						{
							$ex_worker_available_day[]=$taskers_info->worker_available_day;
						}
					
					}
					
					
					$data['worker_available_day'] = $ex_worker_available_day;
					
					
					$ex_worker_available_time=array();
					if($taskers_info->worker_available_time!='')
					{
						if(substr_count($taskers_info->worker_available_time,',')>0)
						{
							$ex_worker_available_time=explode(',',$taskers_info->worker_available_time);					
						}
						else
						{
							$ex_worker_available_time[]=$taskers_info->worker_available_time;
						}
					
					}
					
					
					$data['worker_available_time'] = $ex_worker_available_time;
					$data['worker_availability'] = $taskers_info->worker_availability;
					
					
					$ex_worker_hear_about=array();
					if($taskers_info->worker_hear_about!='')
					{
						if(substr_count($taskers_info->worker_hear_about,',')>0)
						{
							$ex_worker_hear_about=explode(',',$taskers_info->worker_hear_about);					
						}
						else
						{
							$ex_worker_hear_about[]=$taskers_info->worker_hear_about;
						}
					
					}
					
					
					$data['worker_hear_about'] = $taskers_info->worker_hear_about;
					
					$data['worker_background'] =  $taskers_info->worker_background;
					$data['worker_securitynum'] = $taskers_info->worker_securitynum;
					
					
					$ex_year='';				

					$ex_month='';
					$ex_day='';
					
					if($taskers_info->worker_birthdate!='')
					{
						if(substr_count($taskers_info->worker_birthdate,'-')>0)
						{
							$ex_worker_birthdate=explode('-',$taskers_info->worker_birthdate);	
							
							$ex_year=$ex_worker_birthdate[0];							
							$ex_month=$ex_worker_birthdate[1];			
							$ex_day=$ex_worker_birthdate[2];			
											
						}						
					}
					
					
					
					$data['bobyear'] = $ex_year;
					$data['bobmonth'] = $ex_month;
					$data['bobday'] = $ex_day;
					
				}
				
				
			
			} else {
			
				$apply=$this->worker_model->update_worker();
			    $data["error"] = "updated";
				
				$data['worker_cities'] = $this->input->post('worker_cities');
				$data['task_state_id'] = $this->input->post('task_state_id');
				$data['worker_location_name'] = $this->input->post('worker_location_name');
				$data['worker_address'] = $this->input->post('worker_address');
				$data['worker_city'] = $this->input->post('worker_city');
				$data['worker_state'] = $this->input->post('worker_state');
				$data['worker_zipcode'] = $this->input->post('worker_zipcode');
				
				$data['save_location']=$this->input->post('save_location');
				
				$data['worker_home_neighborhood'] = $this->input->post('worker_home_neighborhood');
				$data['worker_work_neighborhood'] = $this->input->post('worker_work_neighborhood');
				
				$data['worker_task_type'] = $this->input->post('worker_task_type');
				$data['worker_transportation'] = $this->input->post('worker_transportation');
				$data['worker_skills'] = $this->input->post('worker_skills');
				$data['worker_devices'] = $this->input->post('worker_devices');
				$data['worker_Internet'] = $this->input->post('worker_Internet');
				$data['worker_available_day'] = $this->input->post('worker_available_day');
				$data['worker_available_time'] = $this->input->post('worker_available_time');
				$data['worker_availability'] = $this->input->post('worker_availability');
				$data['worker_hear_about'] = $this->input->post('worker_hear_about');
				$data['worker_background'] = $this->input->post('worker_background');
				$data['worker_securitynum'] = $this->input->post('worker_securitynum');
				$data['bobyear'] = $this->input->post('bobyear');
				$data['bobmonth'] = $this->input->post('bobmonth');
				$data['bobday'] = $this->input->post('bobday');
								
				
				redirect('worker/edit/msg');
			}
		
		
		
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$data['theme']=$theme;
		$meta_setting=meta_setting();
		
		$user_info=$this->user_model->get_user_info(get_authenticateUserID());
		$data['user_info']=$user_info;
		
		$pageTitle='Edit Application - '.$user_info->profile_name.' - '.$meta_setting->title;
		$metaDescription='Edit Application - '.$meta_setting->meta_description;
		$metaKeyword='Edit Application - '.$meta_setting->meta_keyword;
		
		$this->template->write('pageTitle',$pageTitle,TRUE);
		$this->template->write('metaDescription',$metaDescription,TRUE);
		$this->template->write('metaKeyword',$metaKeyword,TRUE);
		$this->template->write_view('header',$theme .'/layout/common/header_login',$data,TRUE);
		$this->template->write_view('content_center',$theme .'/layout/worker/edit_worker',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();	
		
	
	
	}
	
	
	
	/*
	Function name :index()
	Parameter :none
	Return : none
	Use : display the who are the runner page
	Description : display the who are the runner page by this function which is called by http://hostname/worker/index
	              or seo friendly url http://hostname/who-are-the-tasker
	*/
	
	public function index()
	{
				
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$user_info=$this->user_model->get_user_info(get_authenticateUserID());
		$data['user_info']=$user_info;
		
		$taskers_info=$this->worker_model->get_taskers();
		$data['taskers']=$taskers_info;
		
		$data['theme']=$theme;
		$meta_setting=meta_setting();
		$pageTitle='Who are the Taskers? - '.$meta_setting->title;
		$metaDescription='Who are the Taskers? - '.$meta_setting->meta_description;
		$metaKeyword='Who are the Taskers? - '.$meta_setting->meta_keyword;
		
		$this->template->write('pageTitle',$pageTitle,TRUE);
		$this->template->write('metaDescription',$metaDescription,TRUE);
		$this->template->write('metaKeyword',$metaKeyword,TRUE);
		$this->template->write_view('header',$theme .'/layout/common/header_home',$data,TRUE);
		$this->template->write_view('content_center',$theme .'/layout/worker/who_are_taskers',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
	}
	
	
	/*
	Function name :apply()
	Parameter :none
	Return : none
	Use : add new runner application
	Description : add new runner application by this function which is called by http://hostname/worker/apply
	*/
		
	function apply()
	{	
	
		if(!check_user_authentication()) {  redirect('sign_up'); }
		
		$taskers_info=$this->worker_model->get_taskers();
		//print_r($taskers_info);
		if($taskers_info['worker_app_approved'] != 0) { redirect('who-are-the-taskers'); }
		
		
		
		$task_types =  $this->worker_model->get_task_type();
		$data['task_types']=$task_types;
		
		$transportations =  $this->worker_model->get_transportation();
		$data['transportations']=$transportations; 
		$site_setting=site_setting();
		$devices =  $this->worker_model->get_device();
		$data['state_list'] =$this->worker_model->get_state_list();
		$data['devices']=$devices; 
		
		
		$this->form_validation->set_rules('worker_cities', 'Cities', 'required');
		$this->form_validation->set_rules('worker_location_name', 'Location name', 'required');
		$this->form_validation->set_rules('worker_address', 'Address', 'required');
		$this->form_validation->set_rules('worker_city', 'City', 'required');
		//$this->form_validation->set_rules('worker_state', 'State', 'required');
		//$this->form_validation->set_rules('worker_zipcode', 'Postal Code', 'required|min_length['.$site_setting->zipcode_min.']|max_length['.$site_setting->zipcode_max.']');
		
		
		//$this->form_validation->set_rules('worker_home_neighborhood', 'Home neighborhood', 'required');
		//$this->form_validation->set_rules('worker_work_neighborhood', 'Work neighborhood', 'required');
		
		$this->form_validation->set_rules('worker_task_type', 'Task types', 'required');
		$this->form_validation->set_rules('worker_transportation', 'Transportation', 'required');
		$this->form_validation->set_rules('worker_skills', 'Talents, skills, and qualities contribute', 'required');
		//$this->form_validation->set_rules('worker_devices', 'Devices', 'required');
		//$this->form_validation->set_rules('worker_Internet', 'Comfortable Internet', 'required');
		$this->form_validation->set_rules('worker_available_day', 'Available Day', 'required');
		$this->form_validation->set_rules('worker_available_time', 'Available Time', 'required');
		$this->form_validation->set_rules('worker_securitynum', 'Worker Security Number', 'required');
		//$this->form_validation->set_rules('worker_availability', 'Know about your availability', 'required');
		//$this->form_validation->set_rules('worker_hear_about', 'How did you hear about us,', 'required');
		//$this->form_validation->set_rules('worker_background', 'Background check,', 'required');
		
			if($this->form_validation->run() == FALSE){
			
				if(validation_errors())
				{
					$data["error"] = validation_errors();
				}else{
					$data["error"] = "";
				}
				
				$data['worker_cities'] = $this->input->post('worker_cities');
				$data['task_state_id'] = $this->input->post('task_state_id');
				$data['worker_location_name'] = $this->input->post('worker_location_name');
				$data['worker_address'] = $this->input->post('worker_address');
				$data['worker_city'] = $this->input->post('worker_city');
				$data['worker_state'] = $this->input->post('worker_state');
				$data['worker_zipcode'] = $this->input->post('worker_zipcode');
				
				$data['save_location']=$this->input->post('save_location');
				
				$data['worker_home_neighborhood'] = $this->input->post('worker_home_neighborhood');
				$data['worker_work_neighborhood'] = $this->input->post('worker_work_neighborhood');
				
				$data['worker_task_type'] = $this->input->post('worker_task_type');
				$data['worker_transportation'] = $this->input->post('worker_transportation');
				$data['worker_skills'] = $this->input->post('worker_skills');
				$data['worker_devices'] = $this->input->post('worker_devices');
				$data['worker_Internet'] = $this->input->post('worker_Internet');
				$data['worker_available_day'] = $this->input->post('worker_available_day');
				$data['worker_available_time'] = $this->input->post('worker_available_time');
				$data['worker_availability'] = $this->input->post('worker_availability');
				$data['worker_hear_about'] = $this->input->post('worker_hear_about');
				$data['worker_background'] = $this->input->post('worker_background');
				$data['worker_securitynum'] = $this->input->post('worker_securitynum');
				$data['bobyear'] = $this->input->post('bobyear');
				$data['bobmonth'] = $this->input->post('bobmonth');
				$data['bobday'] = $this->input->post('bobday');
			
			} else {
			
				$apply=$this->worker_model->add_worker();
			    $data["error"] = "updated";
				
				$data['worker_cities'] = $this->input->post('worker_cities');
				$data['task_state_id'] = $this->input->post('task_state_id');
				
				$data['worker_location_name'] = $this->input->post('worker_location_name');
				$data['worker_address'] = $this->input->post('worker_address');
				$data['worker_city'] = $this->input->post('worker_city');
				$data['worker_state'] = $this->input->post('worker_state');
				$data['worker_zipcode'] = $this->input->post('worker_zipcode');
				
				$data['save_location']=$this->input->post('save_location');
				
				$data['worker_home_neighborhood'] = $this->input->post('worker_home_neighborhood');
				$data['worker_work_neighborhood'] = $this->input->post('worker_work_neighborhood');
				
				$data['worker_task_type'] = $this->input->post('worker_task_type');
				$data['worker_transportation'] = $this->input->post('worker_transportation');
				$data['worker_skills'] = $this->input->post('worker_skills');
				$data['worker_devices'] = $this->input->post('worker_devices');
				$data['worker_Internet'] = $this->input->post('worker_Internet');
				$data['worker_available_day'] = $this->input->post('worker_available_day');
				$data['worker_available_time'] = $this->input->post('worker_available_time');
				$data['worker_availability'] = $this->input->post('worker_availability');
				$data['worker_hear_about'] = $this->input->post('worker_hear_about');
				$data['worker_background'] = $this->input->post('worker_background');
				$data['worker_securitynum'] = $this->input->post('worker_securitynum');
				$data['bobyear'] = $this->input->post('bobyear');
				$data['bobmonth'] = $this->input->post('bobmonth');
				$data['bobday'] = $this->input->post('bobday');
				
				
				
				
				
				
				
				/////////////============Complete time  to poster start===========	
						$user_detail = $this->user_model->get_user_info(get_authenticateUserID());

						$email_template=$this->db->query("select * from ".$this->db->dbprefix('email_template')." where task='Worker Apply (Worker)'");
						$email_temp=$email_template->row();
						
						
						$email_address_from=$email_temp->from_address;
						$email_address_reply=$email_temp->reply_address;
						
						$email_subject=$email_temp->subject;				
						$email_message=$email_temp->message;			
						
										
						$email_to=$user_detail->email;		
						
						
						$email_message=str_replace('{break}','<br/>',$email_message);
						$email_message=str_replace('{worker_name}',ucfirst($user_detail->full_name),$email_message);		
						
						
						$str=$email_message; 
											
						/** custom_helper email function **/
							
						email_send($email_address_from,$email_address_reply,$email_to,$email_subject,$str);
						
					/////////////============Complete time  to poster end===========	
	
					
					/////////////============Complete time  to admin start===========	

						$email_template=$this->db->query("select * from ".$this->db->dbprefix('email_template')." where task='Worker Apply (Admin)'");
						$email_temp=$email_template->row();
						
						
						$email_address_from=$email_temp->from_address;
						$email_address_reply=$email_temp->reply_address;
						
						$email_subject=$email_temp->subject;				
						$email_message=$email_temp->message;			
						
										
						$email_to=$email_temp->from_address;
						
						
						$email_message=str_replace('{break}','<br/>',$email_message);
						$email_message=str_replace('{worker_name}',ucfirst($user_detail->full_name),$email_message);		
						
						
						$str=$email_message;
											
						/** custom_helper email function **/
							
						email_send($email_address_from,$email_address_reply,$email_to,$email_subject,$str);
						
					/////////////============Complete time  to admin end===========
					
					
					
					
					
					
					
				redirect('worker/thanks');
			}
		
		
		
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$data['theme']=$theme;
		$meta_setting=meta_setting();
		
		$user_info=$this->user_model->get_user_info(get_authenticateUserID());
		$data['user_info']=$user_info;
		
		$pageTitle='Taskers Application - '.$user_info->profile_name.' - '.$meta_setting->title;
		$metaDescription='Taskers Application - '.$meta_setting->meta_description;
		$metaKeyword='Taskers Application - '.$meta_setting->meta_keyword;
		
		$this->template->write('pageTitle',$pageTitle,TRUE);
		$this->template->write('metaDescription',$metaDescription,TRUE);
		$this->template->write('metaKeyword',$metaKeyword,TRUE);
		$this->template->write_view('header',$theme .'/layout/common/header_home',$data,TRUE);
		$this->template->write_view('content_center',$theme .'/layout/worker/apply',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();	
		
	}
	
	
	/*
	Function name :thanks()
	Parameter :none
	Return : none
	Use : after successfully submit new runner application user redirect to this page
	Description : successfully submit new runner application user redirect to this page this function which is called by http://hostname/worker/thanks
	*/
	
	function thanks()
	{
	
		if(!check_user_authentication()) {  redirect('sign_up'); }
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$user_info=$this->user_model->get_user_info(get_authenticateUserID());
		$data['user_info']=$user_info;
		
		$data['theme']=$theme;
		$data['error'] = 'Your application has been sent. Thank you!';
		$meta_setting=meta_setting();
		$pageTitle='Thanks for applying - '.$meta_setting->title;
		$metaDescription='Dashboard - '.$meta_setting->meta_description;
		$metaKeyword='Dashboard - '.$meta_setting->meta_keyword;
		
		$this->template->write('pageTitle',$pageTitle,TRUE);
		$this->template->write('metaDescription',$metaDescription,TRUE);
		$this->template->write('metaKeyword',$metaKeyword,TRUE);
		$this->template->write_view('header',$theme .'/layout/common/header_home',$data,TRUE);
		$this->template->write_view('content_center',$theme .'/layout/worker/thanks',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
	}
	
	
	
	
	
	
	
	/*
	Function name : taskers()
	Parameter : $city(city name), $offset(for paging)
	Return : array of all runner list
	Use : search or display all runner list
	Description : user can see all runner list by this function which is called by http://hostname/worker/taskers
	              or SEO friendly URL for this http://hostname/taskers
	*/
	
		function taskers($city='', $offset=0)
		{
		
			$data['cityname'] ='';
			$data['categoryname'] ='';
			
			$city_id='';
			
			if($city != '')
			{
				if($city == 'all'){
					$city_id='';
					$data['cityname'] = 'all';
				} else {
					$city_id = getCityId(urldecode($city));
					$data['cityname'] = urldecode($city);
				}
			
				} else {
				
					if(get_authenticateUserID()!='')
					{
						$city_id=getCurrentCity();
						$current_city_name=getCityName($city_id);
					
						if(isset($current_city_name)) { $data['cityname']=$current_city_name; }
					}
				}
				
				if(trim($data['cityname'])!='')
				{
					$city=urldecode(trim($data['cityname']));
				}
				else
				{
					$city='all';
				}
	
			
			
			$this->load->library('pagination');
			
			$limit = '10';
			
			if($offset>0)
			{
			$config['uri_segment']='3';
			}
			else
			{
			$config['uri_segment']='2';
			}
			
		
			
			$config['base_url'] = site_url('taskers/'.$city.'/');
			$config['total_rows'] = $this->worker_model->get_total_taskers($city_id);
			$config['per_page'] = $limit;
			
			$this->pagination->initialize($config);
			
			$data['page_link'] = $this->pagination->create_links();
			$data['taskers'] =$this->worker_model->get_all_taskers($city_id,$offset,$limit);
			$data['total_rows']=$config['total_rows'];
			
			$theme = getThemeName();
			$this->template->set_master_template($theme .'/template.php');
			
			$data['theme']=$theme;
			$meta_setting=meta_setting();
			
			$pageTitle='Taskers - '.$meta_setting->title;
			$metaDescription='Taskers - '.$meta_setting->meta_description;
			$metaKeyword='Taskers - '.$meta_setting->meta_keyword;
			
			$this->template->write('pageTitle',$pageTitle,TRUE);
			$this->template->write('metaDescription',$metaDescription,TRUE);
			$this->template->write('metaKeyword',$metaKeyword,TRUE);
			$this->template->write_view('header',$theme .'/layout/common/header_home',$data,TRUE);
			$this->template->write_view('content_center',$theme .'/layout/worker/taskers',$data,TRUE);
			$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
			$this->template->render();
		}


		/*
		Function name : category()
		Parameter : $category(category name), $offset(for paging)
		Return : array of particular category all runner list
		Use : search or display particular category all runner list
		Description : user can see particular category all runner list by this function which is called by http://hostname/worker/category
					  or SEO friendly URL for this http://hostname/taskers/category
		*/

		function category($category='', $offset=0)
		{
		
			$data['cityname'] ='';
			$data['categoryname'] ='';
			
			
			if(get_authenticateUserID()!='')
			{
			$city_id=getCurrentCity();
			$current_city_name=getCityName($city_id);
			if(isset($current_city_name)) { $data['cityname']=$current_city_name; }
			}
			
			$category_id='';

			//echo $category;
			
			if($category != '')
			{
			if($category == 'all'){
			$category_id='0';
			$data['categoryname'] = 'all';
			} else {
			$category_id = $this->worker_model->getCategoryId(urldecode($category));
			$data['categoryname'] = $category;
			}
			
			} else {
			
			$category_id='0';
			$data['categoryname'] = 'all';
			}
			
			
			$category=urldecode($data['categoryname']);
			
			
			$this->load->library('pagination');
			
			$limit = '10';
			
			
			
			if($offset>0)
			{
			$config['uri_segment']='4';
			}
			else
			{
			$config['uri_segment']='3';
			}
			
			
			$config['base_url'] = site_url('worker/category/'.$category.'/');
			$config['total_rows'] = $this->worker_model->get_total_category_taskers($category_id);
			$config['per_page'] = $limit;
			
			$this->pagination->initialize($config);

			$limit1='5';
			
			$data['page_link'] = $this->pagination->create_links();
			$data['taskers'] =$this->worker_model->get_all_category_taskers($category_id,$offset,$limit);
			$data['toptaskers'] =$this->worker_model->get_top_worker_by_cat($limit1,$category_id);
			
			$data['tasklist'] =$this->worker_model->get_complete_task_list($category_id);
			$data['total_rows']=$config['total_rows'];
			
			$theme = getThemeName();
			$this->template->set_master_template($theme .'/template.php');
			
			$data['theme']=$theme;
			$meta_setting=meta_setting();
			
			$pageTitle='Taskers - '.$meta_setting->title;
			$metaDescription='Taskers - '.$meta_setting->meta_description;
			$metaKeyword='Taskers - '.$meta_setting->meta_keyword;
			
			$this->template->write('pageTitle',$pageTitle,TRUE);
			$this->template->write('metaDescription',$metaDescription,TRUE);
			$this->template->write('metaKeyword',$metaKeyword,TRUE);
			$this->template->write_view('header',$theme .'/layout/common/header_home',$data,TRUE);
			$this->template->write_view('content_center',$theme .'/layout/worker/taskers',$data,TRUE);
			$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
			$this->template->render();
		}

	
	
		/*
		Function name : how_it_works()
		Parameter : none
		Return : none
		Use : display how its work page
		Description : user can see how its work page by this function which is called by http://hostname/worker/how_it_works
					  or SEO friendly URL for this http://hostname/how_it_works
		*/
	
		function how_it_works()
		{
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		
		$data['theme']=$theme;
		$meta_setting=meta_setting();
		$pageTitle='How it works - '.$meta_setting->title;
		$metaDescription='How it works - '.$meta_setting->meta_description;
		$metaKeyword='How it works - '.$meta_setting->meta_keyword;
		
		$this->template->write('pageTitle',$pageTitle,TRUE);
		$this->template->write('metaDescription',$metaDescription,TRUE);
		$this->template->write('metaKeyword',$metaKeyword,TRUE);
		$this->template->write_view('header',$theme .'/layout/common/header_home',$data,TRUE);
		$this->template->write_view('content_center',$theme .'/layout/worker/how_it_works',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
	}
	function task_city(){
        $output = '';
        $data['controller'] = "worker";
        //$id = $this->uri->segment(3, 0);
        if(isset($_POST)){
            //$output = $this->modelorderutilities->getMachineList($_POST['search_rotate_dept']);
            $output = $this->worker_model->getCityList($_POST['state_id']);
        }
        if($output) echo $output;die();
    }
}

?>