<?php
class User extends CI_Controller {
	function User()
	{
		 parent::__construct();	
		$this->load->model('user_model');
		//$this->load->model('home_model');
	}
	
	function index()
	{
		redirect('user/list_user');
	}
	
	
	
	
	/*** check the user unique email address
	*	var string $email
	*  return boolen
	**/
		
	function email_check($email)
	{
		$cemail = $this->user_model->emailTaken($email);
		
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
	
	
	function add_user()
	{
	
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$site_setting = site_setting();
		
		
		
		
		
		$this->form_validation->set_rules('first_name', 'First Name', 'required|alpha');
		$this->form_validation->set_rules('last_name', 'Last Name', 'required|alpha');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_email_check');		
		$this->form_validation->set_rules('zip_code', 'Postal Code', 'required|alpha_numeric|min_length['.$site_setting->zipcode_min.']|max_length['.$site_setting->zipcode_max.']');	
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
				
				
				
					$data['first_name']=$this->input->post('first_name');
					$data['last_name']=$this->input->post('last_name');
					$data['email']=$this->input->post('email');
					$data['zip_code']=$this->input->post('zip_code');
					$data['mobile_no']=$this->input->post('mobile_no');
					$data['phone_no']=$this->input->post('phone_no');
					
					$data['is_worker']=$this->input->post('is_worker');
					$data['user_status']=$this->input->post('user_status');
					
					$data['current_city']=$this->input->post('current_city');
					$data['about_user']=$this->input->post('about_user');	
					
					
		} else	{
				
			
			$insert_return_paasword=$this->user_model->add_user();
			
			
			
			
			
					$email=$this->input->post('email');
					$get_user_info=$this->db->get_where('user',array('email'=>$email));
					$user_info=$get_user_info->row();
					
					$username =$user_info->full_name;				
					$email_verification_code=$user_info->email_verification_code;
					$user_id=$user_info->user_id;
					
					$verification_link=front_base_url().'verify/'.$user_id.'/'.$email_verification_code;
				
				
			/////////////============welcome email===========	

				
				$email_template=$this->db->query("select * from ".$this->db->dbprefix('email_template')." where task='Welcome Email'");
				$email_temp=$email_template->row();
				
				
				$email_address_from=$email_temp->from_address;
				$email_address_reply=$email_temp->reply_address;
				
				$email_subject=$email_temp->subject;				
				$email_message=$email_temp->message;			
				
								
				$email_to=$this->input->post('email');		
				
			
				
				$email_message=str_replace('{break}','<br/>',$email_message);
				$email_message=str_replace('{user_name}',$username,$email_message);			
				$email_message=str_replace('{email}',$email,$email_message);
				
				
				$str=$email_message;		
				
					
				/** custom_helper email function **/
					
				email_send($email_address_from,$email_address_reply,$email_to,$email_subject,$str);
				
				
				
				/////////////============new user email===========	


				
				$email_template=$this->db->query("select * from ".$this->db->dbprefix('email_template')." where task='New User Join'");
				$email_temp=$email_template->row();
				
				
				$email_address_from=$email_temp->from_address;
				$email_address_reply=$email_temp->reply_address;
				
				$email_subject=$email_temp->subject;				
				$email_message=$email_temp->message;
				
				$username =$user_info->full_name;
				$password = $insert_return_paasword;
				$email = $this->input->post('email');
				
				$email_to=$this->input->post('email');
				
				$login_link=front_base_url().'sign_up';
				
				$email_message=str_replace('{break}','<br/>',$email_message);
				$email_message=str_replace('{user_name}',$username,$email_message);
				$email_message=str_replace('{password}',$password,$email_message);
				$email_message=str_replace('{email}',$email,$email_message);
				$email_message=str_replace('{login_link}',$login_link,$email_message);
				$email_message=str_replace('{verify_email_link}',$verification_link,$email_message);
				
				
				
				$str=$email_message;
			
				
				/** custom_helper email function **/
				
				email_send($email_address_from,$email_address_reply,$email_to,$email_subject,$str);

				

				/////////////============new user email===========	
			
			
				
				
				
					/////////////============worker email===========	
						
						if($this->input->post('is_worker')==1)
						{

						$email_template=$this->db->query("select * from ".$this->db->dbprefix('email_template')." where task='Worker Apply (Worker)'");
						$email_temp=$email_template->row();
						
						
						$email_address_from=$email_temp->from_address;
						$email_address_reply=$email_temp->reply_address;
						
						$email_subject=$email_temp->subject;				
						$email_message=$email_temp->message;			
						
										
					
						
						$worker_profile_link=front_base_url().'worker/edit';
						
						
						$email_message=str_replace('{break}','<br/>',$email_message);
						$email_message=str_replace('{worker_name}',ucfirst($user_info->full_name),$email_message);		
						$email_message=str_replace('{worker_profile_link}',$worker_profile_link,$email_message);	
						
						
					
						
						$str=$email_message; 
											
						/** custom_helper email function **/
							
						email_send($email_address_from,$email_address_reply,$email_to,$email_subject,$str);
						
					/////////////============Complete time  to poster end===========	
					
					}
					
					
			
			
			
			
			redirect('user/list_user/20/0/insert/');
			
			
			/////===send email and make random password  and auto active worker, user, app approved 
		
			///=====email to user login detail and if worker then worker edit link
				
				
				
				
		}			
			
		
		$data['site_setting'] =	$site_setting;	
		$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
		$this->template->write_view('center',$theme .'/layout/user/add_user',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
		
		
		
		
	}
	
	function list_user($limit=20,$offset=0,$msg='')
	{
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$check_rights=get_rights('list_user');
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		
		
		
		$this->load->library('pagination');

		//$limit = '10';
		//$config['uri_segment']='4';
		if($offset>0)
		{
			 $config['uri_segment']='4';
		}
		else
		{
			 $config['uri_segment']='2';
		}
			
		$config['base_url'] = base_url().'user/list_user/'.$limit.'/';
		$config['total_rows'] = $this->user_model->get_total_user_count();
		$config['per_page'] = $limit;		
		$this->pagination->initialize($config);		
		$data['page_link'] = $this->pagination->create_links();
		
		$data['result'] = $this->user_model->get_user_result($offset, $limit);
		$data['msg'] = $msg;
		$data['offset'] = $offset;
		
		
		$data['limit']=$limit;
		$data['option']='';
		$data['keyword']='';
		$data['search_type']='normal';
		
		$data['site_setting'] = site_setting();

		$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
		$this->template->write_view('center',$theme .'/layout/user/list_user',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
	}
	
	function list_active_user($limit=20,$offset=0,$msg='')
	{
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$check_rights=get_rights('list_user');
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		$this->load->library('pagination');

		//$limit = '10';
		$config['uri_segment']='4';
		$config['base_url'] = base_url().'user/list_active_user/'.$limit.'/';
		$config['total_rows'] = $this->user_model->get_total_active_user_count();
		$config['per_page'] = $limit;		
		$this->pagination->initialize($config);		
		$data['page_link'] = $this->pagination->create_links();
		
		$data['result'] = $this->user_model->get_active_user_result($offset, $limit);
		$data['msg'] = $msg;
		$data['offset'] = $offset;
		
		
		$data['limit']=$limit;
		$data['option']='';
		$data['keyword']='';
		$data['search_type']='normal';
		
		$data['site_setting'] = site_setting();

		$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
		$this->template->write_view('center',$theme .'/layout/user/list_active_user',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
	}
	
	function search_list_user($limit=20,$option='',$keyword='',$offset=0,$msg='')
	{
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$check_rights=get_rights('list_user');
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		
		
		$this->load->library('pagination');
		
		
		if($_POST)
		{		
			$option=$this->input->post('option');
			$keyword=$this->input->post('keyword');
		}
		else
		{
			$option=$option;
			$keyword=$keyword;			
		}
		
		$keyword=str_replace('"','',str_replace(array("'",",","%","$","&","*","#","(",")",":",";",">","<","/"),'',trim($keyword)));
	
		//$config['uri_segment']='5';
		if($keyword=='')
		{
			$config['uri_segment']='4';
		
		} else{
			
			if($offset>0)
			{
				$config['uri_segment']='6';
			}
			else
			{
				$config['uri_segment']='5';
			}
		}	
		
		$config['base_url'] = base_url().'user/search_list_user/'.$limit.'/'.$option.'/'.$keyword.'/';
		$config['total_rows'] = $this->user_model->get_total_search_user_count($option,$keyword);
		$config['per_page'] = $limit;		
		$this->pagination->initialize($config);		
		$data['page_link'] = $this->pagination->create_links();
		
		$data['result'] = $this->user_model->get_search_user_result($option,$keyword,$offset, $limit);
		$data['msg'] = $msg;
		$data['offset'] = $offset;
		
		
		//$data['statelist']=$this->project_category_model->get_state();
		
		$data['site_setting'] = site_setting();
		
		$data['limit']=$limit;
		$data['option']=$option;
		$data['keyword']=$keyword;
		$data['search_type']='search';

		$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
		$this->template->write_view('center',$theme .'/layout/user/list_user',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
	}

	function user_detail($id=0)
	{
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		/*$this->load->library('form_validation');		
		$this->form_validation->set_rules('from_email', 'From Email Address', 'valid_email');
		$this->form_validation->set_rules('subject', 'Subject', 'required');
		$this->form_validation->set_rules('message', 'Message', 'required');
		if($this->form_validation->run() == FALSE){			
			if(validation_errors())
			{
				$data["error"] = validation_errors();
				$data["from_email"] = $this->input->post('from_email');
				$data["subject"] = $this->input->post('subject');
				$data["message"] = $this->input->post('message');
			}else{
				$data["error"] = "";
				$data["from_email"] = "";
				$data["subject"] = "";
				$data["message"] = "";
			}
		}else{
			$this->load->library('email');
			$this->email->from($this->input->post('from_email'));
			$this->email->to($this->input->post('email'));
			$this->email->subject($this->input->post('subject'));
			$this->email->message($this->input->post('message'));
			$this->email->send();
			$data["error"] = $this->email->print_debugger();
			$data["from_email"] = "";
			$data["subject"] = "";
			$data["message"] = "";
		}*/
		
		$data['site_setting'] = site_setting();
		
		$data['one_user'] = $this->user_model->get_one_user($id);
		$data['row'] = $this->user_model->get_one_user($id);
		
		$data['portfolio_photo']=$this->user_model->get_user_portfolio_photo($id);
		$data['portfolio_video']=$this->user_model->get_user_portfolio_video($id);
		
		$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
		$this->template->write_view('center',$theme .'/layout/user/user_detail',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
		
	}
	
	 function action_user()
	{ 
	//echo '<pre>'; print_r($_POST); die();
	
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$check_rights=get_rights('list_user');
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		
		
		
		
		 $offset=$this->input->post('offset');
		 $action=$this->input->post('action');
		 $user_id=$this->input->post('chk');
		 $fname=$this->input->post('fname');
		
		//print_r($trans_id);
		//exit;
		
		
		if($action=='delete')
		{	
			foreach($user_id as $id)
			{
				$this->db->query("update ".$this->db->dbprefix('user')." set user_status='2' where user_id='".$id."'");
			}
			
			redirect('user/'.$fname.'/20/'.$offset.'/delete');
		}
		elseif($action=='edit'){
		
			foreach($user_id as $id)
			{
				
				$user_status = $this->input->post('user_status_'.$id);

				$userdata = array(
						'user_status' => $user_status
				);		
				$this->db->where('user_id',$id);
				$this->db->update('user',$userdata);
				
				if($user_status == 2){

				$day = $this->input->post('no_of_day_'.$id);
				
				$suspend_to_date =date('Y-m-d H:i:s',mktime(date('H'),date('i'),date('s'),date('m'),date('d')+$day,date('Y')));
				
				
					$suspenddata = array(
						'user_id' => $id,
						'suspend_from_date' => date('Y-m-d H:i:s'),
						'suspend_to_date' => $suspend_to_date,
						'suspend_reason' => $this->input->post('suspend_reason_'.$id),
						'is_permanent' => $this->input->post('is_permanent_'.$id),
					);	
					$this->db->insert('user_suspend',$suspenddata);
				}
			}
	
			redirect('user/'.$fname.'/20/'.$offset.'/edit');
		}
		
		
	}
	
	
	function export_active_user($time='')
	{
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$check_rights=get_rights('list_worker');
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		
		$this->load->dbutil();
		$query = $this->db->query("select * from ".$this->db->dbprefix('user')." where user_status='1' order by user_id");		
		
		$delimiter = ",";
		$newline = "\r\n";

		$csv= $this->dbutil->csv_from_result($query, $delimiter, $newline);
		
		 $file_name = "active_user_".date('d-m-Y').".csv";
   		 force_download($file_name,$csv);
		$this->db->cache_delete_all();	
	}
	
	function list_deleted_user($limit=20,$offset=0,$msg='')
	{
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$check_rights=get_rights('list_user');
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		$this->load->library('pagination');

		//$limit = '10';
		$config['uri_segment']='4';
		$config['base_url'] = base_url().'user/list_active_user/'.$limit.'/';
		$config['total_rows'] = $this->user_model->get_total_delete_user_count();
		$config['per_page'] = $limit;		
		$this->pagination->initialize($config);		
		$data['page_link'] = $this->pagination->create_links();
		
		$data['result'] = $this->user_model->get_delete_user_result($offset, $limit);
		$data['msg'] = $msg;
		$data['offset'] = $offset;
		
		
		$data['limit']=$limit;
		$data['option']='';
		$data['keyword']='';
		$data['search_type']='normal';
		
		$data['site_setting'] = site_setting();

		$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
		$this->template->write_view('center',$theme .'/layout/user/list_deleted_user',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
	}
	
	
	function delete_forever()
	{
	     $theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$check_rights=get_rights('list_user');
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
	     
	     $offset=$this->input->post('offset');
		 $action=$this->input->post('action');
		 $user_id=$this->input->post('chk');
	   foreach($user_id as $id)
			{
				$this->db->delete('user',array('user_id' =>$id));
			}
			
			//redirect('task/list_deleted_user/20/'.$offset.'/delete');
			redirect('user/list_deleted_user');
	}
	
	function export_deleted_user($time='')
	{
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$check_rights=get_rights('list_worker');
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		
		$this->load->dbutil();
		$query = $this->db->query("select * from ".$this->db->dbprefix('user')." where user_status='2' order by user_id");		
		
		$delimiter = ",";
		$newline = "\r\n";

		$csv= $this->dbutil->csv_from_result($query, $delimiter, $newline);
		
		 $file_name = "Deleted_user_".date('d-m-Y').".csv";
   		 force_download($file_name,$csv);
		$this->db->cache_delete_all();	
	}
	
	
	function user_login($offset=0,$msg='')
	{
		
		$check_rights=get_rights('user_login');
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$this->load->library('pagination');

		$limit = '20';
		
		$config['base_url'] = base_url().'user/user_login/';
		$config['total_rows'] = $this->user_model->get_total_userlogin_count();
		$config['per_page'] = $limit;		
		$this->pagination->initialize($config);		
		$data['page_link'] = $this->pagination->create_links();
		
		$data['msg']=$msg;
		$data['result'] = $this->user_model->get_userlogin_result($offset, $limit);
		$data['offset'] = $offset;
		
		$data['site_setting'] = site_setting();

		
		$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
		$this->template->write_view('center',$theme .'/layout/user/list_user_login',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
	}
	
	
	function action_login()
	{
		$check_rights=get_rights('user_login');
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		
		
		$offset=$this->input->post('offset');
		$action=$this->input->post('action');
		$login_id=$this->input->post('chk');
			
		
		if($action=='delete')
		{		
			foreach($login_id as $id)
			{			
				$this->db->query("delete from ".$this->db->dbprefix('user_login')." where login_id='".$id."'");
			}
			
			redirect('user/user_login/'.$offset.'/delete');
		}	
		
		
		
	}
	
	
	function list_suspend_user($limit=20,$offset=0,$msg='')
	{
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$check_rights=get_rights('list_user');
		
		if(	$check_rights==0) {			
			redirect('home/dashboard/no_rights');	
		}
		$this->load->library('pagination');

		//$limit = '10';
		$config['uri_segment']='4';
		$config['base_url'] = base_url().'user/list_suspend_user/'.$limit.'/';
		$config['total_rows'] = $this->user_model->get_total_suspend_user_count();
		$config['per_page'] = $limit;		
		$this->pagination->initialize($config);		
		$data['page_link'] = $this->pagination->create_links();
		
		$data['result'] = $this->user_model->get_suspend_user_result($offset, $limit);
		$data['msg'] = $msg;
		$data['offset'] = $offset;
		
		
		$data['limit']=$limit;
		$data['option']='';
		$data['keyword']='';
		$data['search_type']='normal';
		
		$data['site_setting'] = site_setting();

		$this->template->write_view('header_menu',$theme .'/layout/common/header_menu',$data,TRUE);
		$this->template->write_view('center',$theme .'/layout/user/list_suspend_user',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
	}
	
	
	 function edit_status($user_id,$page){
	// echo $page;  die();
	 	if($user_id==0 || $user_id = '') {			
			redirect('user/list_user');	
		}
		
		 //echo '<pre>'; print_r($_POST);
		// die();
		 
		 if($this->input->post('Submit') == 'Submit'){
			$user_status = $this->input->post('user_status');
				
					$userdata = array(
						'user_status' => $user_status
					);		
					$this->db->where('user_id',$this->input->post('user_id'));
					$this->db->update('user',$userdata);
					
					if($user_status == 2){
					
					//echo '<pre>'; print_r($_POST);
					$day = $this->input->post('no_of_day');
					
					$suspend_to_date =date('Y-m-d H:i:s',mktime(date('H'),date('i'),date('s'),date('m'),date('d')+$day,date('Y')));
					
					
						$suspenddata = array(
							'user_id' => $this->input->post('user_id'),
							'suspend_from_date' => date('Y-m-d H:i:s'),
							'suspend_to_date' => $suspend_to_date,
							'suspend_reason' => $this->input->post('suspend_reason'),
							'is_permanent' => $this->input->post('is_permanent'),
						);
						//print_r($suspenddata); die();		
						$this->db->insert('user_suspend',$suspenddata);
					}
				
				
		 }
		 
		if($page == 'all') { redirect('user/list_user');	} 
		if($page == 'suspend') { redirect('user/list_suspend_user');	} 
	 }
	 
	 function change_password($user_id){
 		
		
		$user_info=$this->user_model->get_one_user($user_id);

		$password = rand(0,99999999);

		$data=array(
			'password'=>md5($password)		
		);
		
		$this->db->where('user_id',$user_id);		
		$this->db->update('user', $data); 
		
		///================Send Email To user start
			$email_template=$this->db->query("select * from ".$this->db->dbprefix('email_template')." where task='Change Password By Admin'");
			$email_temp=$email_template->row();
			
			
			$email_address_from=$email_temp->from_address;
			$email_address_reply=$email_temp->reply_address;
			
			$email_subject=$email_temp->subject;				
			$email_message=$email_temp->message;			
			
							
			$email_to=$user_info->email;		
		
			$email_message=str_replace('{break}','<br/>',$email_message);	
			$email_message=str_replace('{user_name}',ucfirst($user_info->full_name),$email_message);		
			$email_message=str_replace('{password}',$password,$email_message);	
			
			$str=$email_message;
			
			/** custom_helper email function **/
				
			email_send($email_address_from,$email_address_reply,$email_to,$email_subject,$str);
		///================Send Email To user end
		redirect('user/list_user/20/0/password/');	

	 }
}
?>