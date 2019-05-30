<?php
class Additional_information extends ROCKERS_Controller {

	/*
	Function name :Additional_information()
	Description :Its Default Constuctor which called when additional_information object initialzie.its load necesary models
	*/
	
	function Additional_information()
	{
		 parent::__construct();	
		$this->load->model('additional_information_model');
		$this->load->model('task_model');
		$this->load->model('user_model');
		$this->load->model('worker_model');
		
	}
	
	/*
	Function name :index($task_id)
	Parameter :$task_id (Task unquie ID)
	Return : none
	Use : if someone open this link directly then visitor redirect to information task in Additional_information page
	Description :its default function which called http://hostname/additional_information/index/$task_id
	*/
	
	function index($task_id)
	{
		redirect('additional_information/information/'.$task_id);
	}
	
	
	/*
	Function name :information($task_id)
	Parameter :$task_id (Task unquie ID)
	Return : none
	Use : User can see the additional information of task and also add additional information of task. 
	NOTE : User can add additional information of task until no one can assign on his/her task
	Description : User can see the additional information of task and also add additional information using this function which called 
				  http://hostname/additional_information/information/$task_id
	*/
	function information($task_id)
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
  
			   $this->form_validation->set_rules('information', 'Information', 'required');
			  
			   
			   if($this->form_validation->run() == FALSE){
			
					if(validation_errors())
					{
						$data["error"] = validation_errors();
					}else{
						$data["error"] = "";
					}
					
					$data['information'] = $this->input->post('information');
					$data['task_id'] = $this->input->post('task_id');

				} else {
			
					$dispute_id=$this->additional_information_model->information_add();
					

					$data['comment'] = $this->input->post('comment');
					$data['task_id'] = $this->input->post('task_id');
					
					
					
					 $bids = $this->task_model->get_task_offer($task_id);

			 $user_detail = $this->user_model->get_user_info(get_authenticateUserID());
			 $poster_link ='<a href="'.base_url().'user/'.$user_detail->profile_name.'">'.ucfirst($user_detail->full_name).'</a>';
			 $task_link ='<a href="'.base_url().'tasks/'.$task_detail->task_url_name.'">'.$task_detail->task_name.'</a>';
			
			if($bids) { 
			 foreach($bids as $bid){
			
				$email_template=$this->db->query("select * from ".$this->db->dbprefix('email_template')." where task='Additional Information'");
				$email_temp=$email_template->row();
				
				
				$email_address_from=$email_temp->from_address;
				$email_address_reply=$email_temp->reply_address;
				
				$email_subject=$email_temp->subject;				
				$email_message=$email_temp->message;			
				
								
				$email_to=$bid->email;		
			
				$email_message=str_replace('{break}','<br/>',$email_message);	
				$email_message=str_replace('{worker_name}',ucfirst($bid->full_name),$email_message);			
				$email_message=str_replace('{task_name}',$task_link,$email_message);
				$email_message=str_replace('{poster_name}',$poster_link,$email_message);
				
				$str=$email_message; 
				
				/** custom_helper email function **/
					
				email_send($email_address_from,$email_address_reply,$email_to,$email_subject,$str);
			}
			}
			
			
			
			
			
					redirect('additional_information/information/'.$task_id);
				}
			
			$data['result'] = $this->additional_information_model->get_all_information($task_id);
			$data['task_id']=$task_id;
			
			$data['task_detail']=$task_detail;

			
			
			
			$theme = getThemeName();
			$this->template->set_master_template($theme .'/template.php');
			$data['theme']=$theme;
			
			$data['site_setting']=site_setting();
			$meta_setting=meta_setting();
			
			
			
			$pageTitle='Additional Information  for - '.$meta_setting->title;
			$metaDescription='Additional Information for - '.$meta_setting->meta_description;
			$metaKeyword='Additional Information for - '.$meta_setting->meta_keyword;
			
			$this->template->write('pageTitle',$pageTitle,TRUE);
			$this->template->write('metaDescription',$metaDescription,TRUE);
			$this->template->write('metaKeyword',$metaKeyword,TRUE);
			$this->template->write_view('header',$theme .'/layout/common/header_login',$data,TRUE);
			$this->template->write_view('content_center',$theme .'/layout/additional_information/additional_information',$data,TRUE);
			$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
			$this->template->render();
		
		}
}
?>