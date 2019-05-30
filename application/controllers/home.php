<?php
error_reporting(0);
class Home extends ROCKERS_Controller {
	
	/*
	Function name :Home()
	Description :Its Default Constuctor which called when home object initialzie.its load necesary models
	*/
	
	function __construct()
	{
		parent::__construct();	
		$this->load->model('home_model');	
		$this->load->model('user_model');		
		$this->load->model('worker_model');			
	}
	
	
	/*
	Function name :index()
	Parameter :none
	Return : none
	Use : user can see category list, map, recent tasks, top runners and other details
	Description : site home page its default function which called http://hostname/home
				  SEO friendly URL which is declare in config route.php file  http://hostname/
	*/
	
	public function index()
	{
		$data=array();
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$meta_setting=meta_setting();
		
		$pageTitle=$meta_setting->title;
		$metaDescription=$meta_setting->meta_description;
		$metaKeyword=$meta_setting->meta_keyword;
		$this->template->write('pageTitle',$pageTitle,TRUE);
		$this->template->write('metaDescription',$metaDescription,TRUE);
		$this->template->write('metaKeyword',$metaKeyword,TRUE);
		$this->template->write_view('header',$theme .'/layout/common/header_home',$data,TRUE);
		//$this->template->write_view('banner',$theme .'/layout/common/home_banner',$data,TRUE);
		$this->template->write_view('campaign_box',$theme .'/layout/common/campaign_box',$data,TRUE);
		$this->template->write_view('activity_box',$theme .'/layout/common/activity_box',$data,TRUE);
		$this->template->write_view('footer_capaign',$theme .'/layout/common/footer_capaign',$data,TRUE);
		$this->template->write_view('press_release',$theme .'/layout/common/press_release',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
	}
	
	public function business()
	{
		$data=array();
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$meta_setting=meta_setting();
		
		$pageTitle=$meta_setting->title;
		$metaDescription=$meta_setting->meta_description;
		$metaKeyword=$meta_setting->meta_keyword;
		$this->template->write('pageTitle',$pageTitle,TRUE);
		$this->template->write('metaDescription',$metaDescription,TRUE);
		$this->template->write('metaKeyword',$metaKeyword,TRUE);
		$this->template->write_view('header',$theme .'/layout/common/header_home',$data,TRUE);
		$this->template->write_view('press_release',$theme .'/layout/common/business',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
	}
	function business_con(){
        $output = '';
        $data['controller'] = "home";
        //$id = $this->uri->segment(3, 0);
        if(isset($_POST)){
            $to  = 'gaumji009@gmail.com'; // note the comma 


			// subject
			$subject = 'New message';

			// message
			$message = '
			<html>
			<body>
			  <table>
			    <tr>
			      <td>Name</td>
			      <td>First Name'.$_REQUEST['fname'].'Last Name'.$_REQUEST['lname'].'</td>
			    </tr>
			     <tr>
			      <td>Email</td>
			      <td>'.$_REQUEST['email'].'</td>
			    </tr>
			     <tr>
			      <td>Subject</td>
			      <td>'.$_REQUEST['sub'].'</td>
			    </tr>
			     <tr>
			      <td>Message</td>
			      <td>'.$_REQUEST['msg'].'</td>
			    </tr>
			     
			  </table>
			</body>
			</html>
			';

			// To send HTML mail, the Content-type header must be set
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

			$headers .= "Reply-To: The Sender <noreplay@camellar.com>\r\n"; 
			$headers .= "Return-Path: The Sender <noreplay@camellar.com>\r\n"; 
			$headers .= "From: The Sender <noreplay@camellar.com>\r\n";



			// Mail it
			if(mail($to, $subject, $message, $headers))
			{
				$output ="Thank you for submitting your details.A member of the camellar team will be in contact with you soon.";
			}
        }
        
        echo $output;die();
    }
	
	public function contact_us()
	{
		$data=array();
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$meta_setting=meta_setting();
		
		$pageTitle=$meta_setting->title;
		$metaDescription=$meta_setting->meta_description;
		$metaKeyword=$meta_setting->meta_keyword;
		$this->template->write('pageTitle',$pageTitle,TRUE);
		$this->template->write('metaDescription',$metaDescription,TRUE);
		$this->template->write('metaKeyword',$metaKeyword,TRUE);
		$this->template->write_view('header',$theme .'/layout/common/header_home',$data,TRUE);
		$this->template->write_view('press_release',$theme .'/layout/common/contact_us',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
	}
	
	/*
	Function name :email_check()
	Parameter : $email (email id)
	Return : boolen
	Use : check the user unique email address
	Description : check the user unique email address
	*/
		
	function email_check($email)
	{
		$cemail = $this->home_model->emailTaken($email);
		
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
	Function name :sign_up()
	Parameter : $msg (cusotm message)
	Return : none
	Use : user can register in this site, login in this site and send request to forget password
	Description : user can register in this site, login in this site and send request to forget password using this function 
				  which called http://hostname/home/sign_up  or 
	              SEO friendly URL which is declare in config route.php file  http://hostname/sign_up
	*/
	
	function sign_up($msg='')
	{
	
		
		if(check_user_authentication())
		{
			redirect('dashboard'); //CHANGED HERE
		}
		
		
					 	$cryptinstall = 'code/cryptographp.fct.php';
						include $cryptinstall; 
		
		
		
		$chk_user='false';
		$spamer=spam_protection();
      	if($spamer==1 || $spamer=='1') {	$chk_user='true';	}
		
		$site_setting=site_setting();
			
		if($this->input->post('register')) 
		{
		
				
				$this->form_validation->set_rules('full_name', 'First Name', 'required');
				$this->form_validation->set_rules('last_name', 'Last Name', 'required');
				$this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_email_check');		
				$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|matches[cpassword]');
				$this->form_validation->set_rules('cpassword', 'Confirm Password', 'required');
				//$this->form_validation->set_rules('zip_code', 'Postal Code', 'required|alpha_numeric|min_length['.$site_setting->zipcode_min.']|max_length['.$site_setting->zipcode_max.']');	
				//$this->form_validation->set_rules('mobile_no', 'Mobile No.', 'numeric|exact_length[10]');	
				
				$this->form_validation->set_rules('agree','Agree on Terms of use','required');
				
				
				if($site_setting->captcha_enable==1)
				{		
				
					 if ($this->input->post('register')) 
					 {	
					 
						 /* if (check_capthca()) 
						  {
							$captcha_result = '';
							
						  } else {
							$captcha_result = '<p>Image verification is Wrong.</p>';
						  }*/
						  
						  
							
							if (!chk_crypt($_POST['captcha'])) 
							{
								$captcha_result = '<p>Image verification is Wrong.</p>';
							} else {
								$captcha_result = ''; 
							}


					 }
						$error = $captcha_result;
					
					
				} else {
				
					$error ='';
				}
				
				
				
				
				
					
					
					if($this->form_validation->run() == FALSE || $error != "" || $chk_user=='true')
					{	
				
					
					if(validation_errors() || $error != "")
					{
						$spam_message='';
						
						if($chk_user=='true')
						{
							$spam_message='<p>Your IP has been Band due to Spam.You can not Register Now.</p>';
						}
						
						$data["error"] = $spam_message.validation_errors().$error;
						
					}else{
						
						if($chk_user=='true')
						{
							$data["error"] = '<p>Your IP has been Band due to Spam.You can not Register Now.</p>';
						}
						else
						{				
							$data["error"] = "";
						}
						
					}
			
			
				
					$data['full_name'] = $this->input->post('full_name');	
					$data['last_name'] = $this->input->post('last_name');				
					$data['email'] = $this->input->post('email');
					$data['password'] = $this->input->post('password');
					$data['zip_code'] = $this->input->post('zip_code');					
					$data['mobile_no'] = $this->input->post('mobile_no');				
				
					
					$data['login_email']='';
					$data['login_password']='';
					
					
					$data['view']='login';
					$data['msg']=$msg;
				
					
			
		} else {			
		
		
			
			$chk_spam_register=$this->home_model->check_spam_register();
				
			if($chk_spam_register==1)
			{
				
				$data["error"] = '<p>Your IP has been Band due to Spam.You can not Register Now.</p>';	
				
				
				$data['full_name'] = $this->input->post('full_name');
				$data['last_name'] = $this->input->post('last_name');					
				$data['email'] = $this->input->post('email');
				$data['password'] = $this->input->post('password');
				$data['zip_code'] = $this->input->post('zip_code');					
				$data['mobile_no'] = $this->input->post('mobile_no');				
			
				
				$data['login_email']='';
				$data['login_password']='';
				
				
				$data['view']='login';
				$data['msg']=$msg;
			
			
						
			}
			else
			{
							
				$sign=$this->home_model->register();
				
				if($sign=='1')
				{
			
					$email=$this->input->post('email');
					$get_user_info=$this->db->get_where('user',array('email'=>$email));
					$user_info=$get_user_info->row();
					
					$username =$user_info->full_name;				
					$email_verification_code=$user_info->email_verification_code;
					$user_id=$user_info->user_id;
					
					$verification_link1=base_url().'verify/'.$user_id.'/'.$email_verification_code;
                                        $verification_link='<a href='.$verification_link1.'>'.$verification_link1.'</a>';
				
				
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
				
				$username =$this->input->post('user_name');
				$password = $this->input->post('password');
				$email = $this->input->post('email');
				
				$email_to=$this->input->post('email');
				
				$login_link=base_url().'sign_up';
				
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
			
				
						
					redirect('home/thank_you/sign_up');
					
			
				}
				else
				{
					redirect('home/sign_up/fail');
				}
			
			
			
			}
			
			
			
					
			
			
		}
		
		
		}
		
		
		
		
		
		
		
		else
		{
			
			
			$data['msg']=$msg;
			$data['view']='login';
			$data['error']='';
			
			$data['full_name'] = '';					
			$data['email'] = '';
			$data['password'] = '';
			$data['zip_code'] = '';					
			$data['mobile_no'] = '';	
			
			
			$data['login_email']='';
			$data['login_password']='';
						
			
			
		}
		
			
		
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
	
		
		$meta_setting=meta_setting();
		
		$pageTitle='Sign Up - '.$meta_setting->title;
		$metaDescription='Sign Up - '.$meta_setting->meta_description;
		$metaKeyword='Sign Up - '.$meta_setting->meta_keyword;
		
		
		$this->template->write('pageTitle',$pageTitle,TRUE);
		$this->template->write('metaDescription',$metaDescription,TRUE);
		$this->template->write('metaKeyword',$metaKeyword,TRUE);
		$this->template->write_view('header',$theme .'/layout/common/header_home',$data,TRUE);
		$this->template->write_view('content_center',$theme .'/layout/common/sign_up',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
	
	}
	
	/*
	Function name :login()
	Parameter : none
	Return : none
	Use : its use for separate login
	Description : login page with out registration
	*/
	
	function login($msg='')
	{
		if(check_user_authentication())
		{
			redirect('dashboard'); //CHANGED HERE
		}
		
		
					 	$cryptinstall = 'code/cryptographp.fct.php';
						include $cryptinstall; 
		
		
		
		$chk_user='false';
		$spamer=spam_protection();
      	if($spamer==1 || $spamer=='1') {	$chk_user='true';	}
		
		$site_setting=site_setting();
		
		if($this->input->post('clogin')) 
		{
		
				
		
				$this->form_validation->set_rules('login_email', 'Email', 'trim|required|valid_email');
				$this->form_validation->set_rules('login_password', 'Password', 'trim|required');
				
				if($this->form_validation->run() == FALSE || $chk_user=='true')
				{
					
						if(validation_errors() || $chk_user=='true')
						{
							$spam_message='';
							
							if($chk_user=='true')
							{
								$spam_message='<p>Your IP has been Band due to Spam.You can not take Login.</p>';
							}
							
							$data["error"] = validation_errors().$spam_message;
						}
						else
						{
							if($chk_user=='true')
							{
								$data["error"] = '<p>Your IP has been Band due to Spam.You can not take Login.</p>';
							}
							else
							{				
								$data["error"] = "";
							}
						}
						
						
						
						$data['msg']=$msg;
						$data['view']='login';
						
						
						
						$data['full_name'] = '';					
						$data['email'] = '';
						$data['password'] = '';
						$data['zip_code'] = '';					
						$data['mobile_no'] = '';	
						
						
						$data['login_email']=$this->input->post('login_email');
						$data['login_password']=$this->input->post('login_password');
						
					
					}
					else
					{
						$login = $this->home_model->is_login();
						if($login == '1')
						{							
							redirect('dashboard');		//CHANGED HERE			
							
						}
						else
						{
							if($login==2)
							{
								$data['error']="Email address is not verified.";
							}
							else
							{
								$data['error']="Email or Password is wrong,please try again";
							}
							
							$data['msg']=$msg;
							$data['view']='login';
							
							$data['full_name'] = '';					
							$data['email'] = '';
							$data['password'] = '';
							$data['zip_code'] = '';					
							$data['mobile_no'] = '';	
							
							
							$data['login_email']=$this->input->post('login_email');
							$data['login_password']=$this->input->post('login_password');
							
						
						
						}
					}	
		
		}
		
		elseif($this->input->post('cforget')) 
		{
		
				$this->form_validation->set_rules('forget_email', 'Email', 'trim|required|valid_email');
								
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
						
						
						
						$data['msg']=$msg;
						$data['view']='cforget';
						
						$data['full_name'] = '';					
						$data['email'] = '';
						$data['password'] = '';
						$data['zip_code'] = '';					
						$data['mobile_no'] = '';	
						
						
						$data['login_email']='';
						$data['login_password']='';
						
					
						
						
					}
					else
					{
					
						
						$f_p = $this->home_model->check_email();
						if($f_p == "1")
						{
						
							
						
							$data['error']="<p>Your account details is sent to your Email Address.</p>";
												
							
							$data['msg']=$msg;
							$data['view']='login';
							
							$data['full_name'] = '';					
							$data['email'] = '';
							$data['password'] = '';
							$data['zip_code'] = '';					
							$data['mobile_no'] = '';	
							
							
							$data['login_email']='';
							$data['login_password']='';
							
													
						}
						else
						{ 

							$data['error']="<p>No Email Address found.</p>";					
							
							
							$data['msg']=$msg;
							$data['view']='cforget';
							
							$data['full_name'] = '';					
							$data['email'] = '';
							$data['password'] = '';
							$data['zip_code'] = '';					
							$data['mobile_no'] = '';	
							
							
							$data['login_email']='';
							$data['login_password']='';
						
						
						
						
							
						}
					
				 }	
		
		}
		else
		{
			
			
			$data['msg']=$msg;
			$data['view']='login';
			$data['error']='';
			
			$data['full_name'] = '';					
			$data['email'] = '';
			$data['password'] = '';
			$data['zip_code'] = '';					
			$data['mobile_no'] = '';	
			
			
			$data['login_email']='';
			$data['login_password']='';
						
			
			
		}
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
	
		
		$meta_setting=meta_setting();
		
		$pageTitle='Login - '.$meta_setting->title;
		$metaDescription='Login - '.$meta_setting->meta_description;
		$metaKeyword='Login - '.$meta_setting->meta_keyword;
		
		
		$this->template->write('pageTitle',$pageTitle,TRUE);
		$this->template->write('metaDescription',$metaDescription,TRUE);
		$this->template->write('metaKeyword',$metaKeyword,TRUE);
		$this->template->write_view('header',$theme .'/layout/common/header_home',$data,TRUE);
		$this->template->write_view('content_center',$theme .'/layout/common/login',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
	}
	
	
	/*
	Function name :logout()
	Parameter : none
	Return : none
	Use : destroy user login session and redirect to home page
	Description : destroy user login session and redirect to home page
	*/
	
	function logout()
	{
			
			
			$this->load->helper('cookie');
				
				////==destroy cache====	
				$this->load->driver('cache');			
				
				$supported_cache=check_supported_cache_driver();
				
				////==destroy now====		
				if(isset($supported_cache))
				{
					if($supported_cache!='' && $supported_cache!='none')
					{	
						if($this->cache->$supported_cache->get('user_login'.get_authenticateUserID()))
						{								
							$this->cache->$supported_cache->delete('user_login'.get_authenticateUserID());						
						}
					}
					
				}
				
				$data_up=array(
					'login_status'=>0
				);
				
			 	$this->db->where('user_id',get_authenticateUserID());
			 	$this->db->update('user_login',$data_up);
				
				
				
				
				////==destroy user session===
				$this->session->set_userdata('user_id', $this->security->xss_clean(''));	
				$this->session->set_userdata('full_name', $this->security->xss_clean(''));	
				
				
				
				
				
				
				
			$this->session->sess_destroy();
		
		
			delete_cookie('fbs_'.$this->fb_connect->appkey, '', '', '');
			if (isset($_COOKIE['fbs_'.$this->fb_connect->appkey]))
			{
			unset($_COOKIE['fbs_'.$this->fb_connect->appkey]);
			}
			
			
			delete_cookie('fbsr_'.$this->fb_connect->appkey, '', '', '');
			if (isset($_COOKIE['fbsr_'.$this->fb_connect->appkey]))
			{
			unset($_COOKIE['fbsr_'.$this->fb_connect->appkey]);
			}
			
			
			 $data['logged_out'] = TRUE;
			
			redirect("home/");
	}
	
	
	
	/*
	Function name :verify()
	Parameter : $user_id (user id), $code (Email verify code)
	Return : none
	Use : verify user email accounts
	Description : user can verify email accounts using this function 
				  which called http://hostname/home/verify/$user_id/$code  or 
	              SEO friendly URL which is declare in config route.php file  http://hostname/verify/$user_id/$code
	*/
	
	function verify($user_id,$code)
	{
		$status='fail';
		
		$verify_user=$this->home_model->verify_user($user_id,$code);
		
		if($verify_user)
		{		
			$status='success';
		}
		
		$data['status']=$status;
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$meta_setting=meta_setting();
		
		$pageTitle='Verify Account - '.$meta_setting->title;
		$metaDescription='Verify Account - '.$meta_setting->meta_description;
		$metaKeyword='Verify Account - '.$meta_setting->meta_keyword;
		
		$this->template->write('pageTitle',$pageTitle,TRUE);
		$this->template->write('metaDescription',$metaDescription,TRUE);
		$this->template->write('metaKeyword',$metaKeyword,TRUE);
		$this->template->write_view('header',$theme .'/layout/common/header_home',$data,TRUE);
		$this->template->write_view('content_center',$theme .'/layout/common/verify_account',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
		
	}

	
	/*
	Function name :reset_password()
	Parameter : $user_id (user id), $code (code)
	Return : none
	Use : user can reset password request
	Description : user can reset password using this function 
				  which called http://hostname/home/reset_password/$user_id/$code  or 
	              SEO friendly URL which is declare in config route.php file  http://hostname/reset_password/$user_id/$code
	*/
	
	function reset_password($user_id,$code)
	{
		$status='fail';
		
		$check_valid_request=$this->home_model->check_valid_request($user_id,$code);
		
		if($check_valid_request)
		{
			$status='valid';	
		}
		
		
		
		
			
		$this->form_validation->set_rules('new_password', 'New Password', 'required|matches[confirm_password]|min_length[8]|max_length[12]');
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
									
					$reset_password = $this->home_model->reset_password($user_id,$code);
					$data['error']="reset_success";
					
			   }	
		
		
		
		$data['user_id']=$user_id;
		$data['code']=$code;	
		
		$data['status']=$status;
		
		
		
		
		
		
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$meta_setting=meta_setting();
		
		$pageTitle='Reset Password - '.$meta_setting->title;
		$metaDescription='Reset Password - '.$meta_setting->meta_description;
		$metaKeyword='Reset Password - '.$meta_setting->meta_keyword;
		
		$this->template->write('pageTitle',$pageTitle,TRUE);
		$this->template->write('metaDescription',$metaDescription,TRUE);
		$this->template->write('metaKeyword',$metaKeyword,TRUE);
		$this->template->write_view('header',$theme .'/layout/common/header_home',$data,TRUE);
		$this->template->write_view('content_center',$theme .'/layout/common/reset_password',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
		
		
		
		
	
	}
	
	
	/*
	Function name :checkemailavailability()
	Parameter : none
	Return : none
	Use : user can check email address is available ajax
	Description : user can check email address is available for unique user registration using this function 			  
	*/
	
	function checkemailavailability()
	{
		
		  echo json_encode($this->checkUserEmail( $_POST['email']));
   		 exit; // only print out the json version of the response
	
	}
	
	
	/*
	Function name :checkUserEmail()
	Parameter : $email (email id)
	Return : single array of boolen
	Use : check email address is valid or not
	Description : user can check email address is valid or not using this function 			  
	*/
	
	function checkUserEmail($email) 
	{

		  $email = trim($email); // strip any white space
		  $response = array(); // our response
		  
		  // if the username is blank
		  if (!$email) {
			$response = array(
			  'ok' => false, 
			 );
			 
			 
			  
		  // if the username does not match a-z or '.', '-', '_' then it's not valid
		  } else if (!preg_match('^[a-zA-Z0-9]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$^', $email)) {
			$response = array(
			  'ok' => false, 
			  );
			  
		  // this would live in an external library just to check if the username is taken
		  } else if ($this->home_model->emailTaken($email)) {
			$response = array(
			  'ok' => false, 
			  );
			  
		  // it's all good
		  } else {
			
			$response = array(
			  'ok' => true, 
			  );
		  }
		
		  return $response;        
	}

	
	/*
	Function name :thank_you()
	Parameter : $msg (Custom msg)
	Return : none
	Use : Custom thank you page
	Description : user can see Custom thank you page using this function 
				  which called http://hostname/home/checkUserEmail/$email		  
	*/
	
	function thank_you($msg='')
	{
		
		$data['msg']=$msg;
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$meta_setting=meta_setting();
		
		$pageTitle=$meta_setting->title;
		$metaDescription=$meta_setting->meta_description;
		$metaKeyword=$meta_setting->meta_keyword;
		
		
		$this->template->write('pageTitle',$pageTitle,TRUE);
		$this->template->write('metaDescription',$metaDescription,TRUE);
		$this->template->write('metaKeyword',$metaKeyword,TRUE);
		$this->template->write_view('header',$theme .'/layout/common/header_home',$data,TRUE);
		$this->template->write_view('content_center',$theme .'/layout/common/thank_you',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
	
	}
	
	
	
	//////////////============facebook authentication==================
	
	/*
	Function name :_facebook_validate()
	Parameter : $uid (user unquie ID), $email (email addrress)
	Return : redirect to account/dashboard  page
	Use : check user facebook details
	Description : user can check facebook details using this function 
	*/
	
	function _facebook_validate($uid = 0,$email='') 
	{
   		//this query basically sees if the users facebook user id is associated with a user.
   		$bQry = $this->home_model->validate_user_facebook($uid,$email);
		
		
		//echo $bQry;
      	if($bQry=='2'){
		 	redirect('account');
		
		}elseif($bQry) { // if the user's credentials validated...
		
			 redirect('dashboard');	
	 
			 
      	} else {
        	// incorrect username or password
		
        	$data = array();
         	$data["login_failed"] = TRUE;
         	$this->index($data);
      	}
   }
   
   /*
	Function name :facebook()
	Parameter : none
	Return : array of facebook user details
	Use : login using facebook
	Description : user can login using facebook
	*/
	
   function facebook() 
   {
   		//1. Check to see if the facebook session has been declared
   		
   		if(!$this->fb_connect->fbSession) {
   			//2. If No, bounce back to login   			
			redirect('sign_up');
			
   		} else {
   			
   			 
			 $fb_uid = $this->fb_connect->user_id;			
   			 $fb_usr = $this->fb_connect->user;
			
			//echo var_dump($fb_usr);exit;
			//echo '<pre>'; print_r($fb_usr); exit;
			if($fb_uid != ''){
				$this->session->set_userdata(array("facebook_id"=>$fb_uid));
					
			}
		
   			if($fb_uid != false) {
	   			//3. If yes, see if the facebook id is associated with any existing account
	   				if(isset($fb_usr["email"]))
					{
						 $email = $fb_usr["email"];
					}
					else
					{
						 $email='';
					}
				$usr = $this->home_model->get_user_by_fb_uid($fb_uid,$email);
	   			
							
	   			if($usr) {
				
	   				//3.a. if yes, log the person in
					
	   				
					$this->_facebook_validate($fb_uid,$email);
										
	   			} else {

				
					/////======redirect for sign up===========
				
	   				//3.b. if no, register the new user.
	   				
	   				 $fname = $fb_usr["first_name"]; 
	   				 $lname = $fb_usr["last_name"];
	   				 $fullname = $fb_usr["name"];
	   				 $pwd = ''; //left blank so user can modify this later
	   				if(isset($fb_usr["email"]))
					{
						 $email = $fb_usr["email"];
					}
					else
					{
						 $email='';
					}
					
					$fb_img='';
	   				if(isset($fb_usr["picture"]))
					{
							
							$base_path = base_path();
							$image_settings = image_setting();
							$inPath=$fb_usr["picture"];
							$outPath= $base_path.'upload/user/'.$fb_uid.'.jpg';
							$in=    fopen($inPath, "rb");
							$out=   fopen($outPath, "wb");
							while ($chunk = fread($in,8192))
							{
								fwrite($out, $chunk, 8192);
							}
							fclose($in);
							fclose($out);
							$fb_img=$fb_uid.'.jpg';
							$config['upload_path'] = $base_path.'upload/user/';
							$config['allowed_types'] = 'jpg|jpeg|gif|png|bmp';
							//$config['max_size']	= '100';// in KB
							$this->load->library('upload', $config);
							$config['source_image'] = $this->upload->upload_path.$fb_img;
							$config['new_image'] = $base_path."upload/user_orig/";
							$config['thumb_marker'] = "";
							//$config['maintain_ratio'] = $image_settings['u_ratio'];
							$config['create_thumb'] = TRUE;
							$config['width'] = $image_settings->user_width;
							$config['height'] = $image_settings->user_height;
							$this->load->library('image_lib', $config);
					
							if(!$this->image_lib->resize()){
								$error = $this->image_lib->display_errors();				
							}
							
					}
					
					
					$fb_values = array (                    
						'fb_id' => "".$fb_uid,
						'first_name' => strtolower(str_replace (" ", "",$fname)),
						'last_name' => strtolower(str_replace (" ", "",$lname)),                    
						'email'=>$email,
						'tw_id'=>'',
						'fb_img'=>$fb_img,
						'tw_screen_name'=>''
					);
           			 
           			//data ready, try to create the new user 
					
	   				
						//$user_id = $this->home_model->add_fbdata($fb_values);
					
						$this->social_signup($fb_values);

	   			}
	   		} 
   		}
   } 
   
   /*
	Function name :social_signup()
	Parameter : $social_data (array of user details)
	Return : none
	Use : user can sign up if his/her login using social site 
	Description : user can add details when his/her login using social site 
	*/
   
   function social_signup($social_data=array())
	{
		
		$data['fb_img']='';
		$data['twiter_img']='';
		
		$theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		$site_setting=site_setting();
		$meta_setting=meta_setting();
		
		$pageTitle='Facebook Register for - '.$meta_setting->title;
		$metaDescription='Facebook Register for - '.$meta_setting->meta_description;
		$metaKeyword='Facebook Register for - '.$meta_setting->meta_keyword;
		
		
		if($social_data)
		{
			$data['full_name']= $social_data['first_name'].' '.$social_data['last_name'];
			$data['zip_code']= '';
			$data['mobile_no']='';
			$data['email']= $social_data['email'];
			$data['password']= '';
			$data['fb_id']= $social_data['fb_id'];
			$data['tw_id']=$social_data['tw_id'];
			$data['tw_screen_name']=$social_data['tw_screen_name'];
			
			if(isset($social_data['fb_img']))$data['fb_img']=$social_data['fb_img'];
			if(isset($social_data['twiter_img']))$data['twiter_img']=$social_data['twiter_img'];
		}
		else
		{
			$data['full_name']= '';
			$data['zip_code']= '';
			$data['mobile_no']= '';
			$data['email']= '';
			$data['password']= '';
			$data['fb_id']= '';
			$data['tw_id']='';
			$data['tw_screen_name']='';
			
			$data['fb_img']=$this->input->post('fb_img');
			$data['twiter_img']=$this->input->post('twiter_img');
		}
		
		$chk_user='false';
		$spamer=spam_protection();
      	if($spamer==1 || $spamer=='1') {	$chk_user='true';	}
		
		if($this->input->post('register')) 
		{
		
				
				$this->form_validation->set_rules('full_name', 'Full Name', 'required|alpha_space');
				$this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_email_check');		
				$this->form_validation->set_rules('password', 'Password', 'required|min_length[8]|max_length[12]');
				$this->form_validation->set_rules('zip_code', 'Postal Code', 'required|alpha_numeric|min_length['.$site_setting->zipcode_min.']|max_length['.$site_setting->zipcode_max.']');	
			//	$this->form_validation->set_rules('mobile_no', 'Mobile No.', 'numeric|exact_length[10]');	
			
				$this->form_validation->set_rules('agree','Agree on Terms of use','required');
				
				
				if($site_setting->captcha_enable==1)
				{		
					$captcha_result='';
					 if ($this->input->post('register')) 
					 {
						 /* if (check_capthca()) 
						  {
							$captcha_result = '';
							
						  } else {
							$captcha_result = '<p>Image verification is Wrong.</p>';
						  }*/
						  
						  
							
							
							if (!empty($_REQUEST['captcha'])) 
							{
								if (empty($_SESSION['captcha']) || trim(strtolower($_REQUEST['captcha'])) != $_SESSION['captcha']) {
								   $captcha_result = '<p>Image verification is Wrong.</p>';
								   
								} else {
								  $captcha_result = '';
									
								}

 									 $captcha_result = '';
									unset($_SESSION['captcha']);
								}


					 }
						$error = $captcha_result;
					
					
				} else {
				
					$error ='';
				}
				
				
				
				

					
					if($this->form_validation->run() == FALSE || $error != "" || $chk_user=='true')
					{	
				
					
					if(validation_errors() || $error != "")
					{
						$spam_message='';
						
						if($chk_user=='true')
						{
							$spam_message='<p>Your IP has been Band due to Spam.You can not Register Now.</p>';
						}
						
						$data["error"] = $spam_message.validation_errors().$error;
						
					}else{
						
						if($chk_user=='true')
						{
							$data["error"] = '<p>Your IP has been Band due to Spam.You can not Register Now.</p>';
						}
						else
						{				
							$data["error"] = "";
						}
						
					}
			
			
				
					$data['full_name'] = $this->input->post('full_name');					
					$data['email'] = $this->input->post('email');
					$data['password'] = $this->input->post('password');
					$data['zip_code'] = $this->input->post('zip_code');					
					$data['mobile_no'] = $this->input->post('mobile_no');
					
					$data['fb_id'] = $this->input->post('fb_id');
					$data['tw_id'] = $this->input->post('tw_id');
					$data['tw_screen_name'] = $this->input->post('tw_screen_name');				
					
			
		} else {			
		
		
			
			$chk_spam_register=$this->home_model->check_spam_register();
				
			if($chk_spam_register==1)
			{
				
				$data["error"] = '<p>Your IP has been Band due to Spam.You can not Register Now.</p>';	
				
				
				$data['full_name'] = $this->input->post('full_name');					
				$data['email'] = $this->input->post('email');
				$data['password'] = $this->input->post('password');
				$data['zip_code'] = $this->input->post('zip_code');					
				$data['mobile_no'] = $this->input->post('mobile_no');
				
				$data['fb_id'] = $this->input->post('fb_id');
				$data['tw_id'] = $this->input->post('tw_id');
				$data['tw_screen_name'] = $this->input->post('tw_screen_name');								

						
			}
			else
			{
							
				$sign=$this->home_model->register();
				
				if($sign=='1')
				{
			
					$email=$this->input->post('email');
					$get_user_info=$this->db->get_where('user',array('email'=>$email));
					$user_info=$get_user_info->row();
					
					$username =$user_info->full_name;				
					$email_verification_code=$user_info->email_verification_code;
					$user_id=$user_info->user_id;
					
					$verification_link=base_url().'verify/'.$user_id.'/'.$email_verification_code;
				
				
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
					
					$username =$this->input->post('user_name');
					$password = $this->input->post('password');
					$email = $this->input->post('email');
					
					$email_to=$this->input->post('email');
					
					$login_link=base_url().'sign_up';
					
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
			
				$data_login=array(
						'user_id'=>$user_id,
						'login_date_time'=> date('Y-m-d H:i:s'),
						'login_ip'=>$_SERVER['REMOTE_ADDR']
						); 
				$this->db->insert('user_login',$data_login);
				
				$data_sess=array(
						'user_id' => $user_id,
						'full_name' => $user_info->full_name,
						'email'=>$user_info->email,
						);
				$this->session->set_userdata($data_sess);	
						
					redirect('dashboard');
					
			
				}
				else
				{
					redirect('home/social_signup/fail');
				}
			
			
			
			}
			
			
			
					
			
			
		}
		
		
		}
		
		$this->template->write('pageTitle',$pageTitle,TRUE);
		$this->template->write('metaDescription',$metaDescription,TRUE);
		$this->template->write('metaKeyword',$metaKeyword,TRUE);
		$this->template->write_view('header',$theme .'/layout/common/header_home',$data,TRUE);
		$this->template->write_view('content_center',$theme .'/layout/common/fb_sign_up',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();
	}
	
	
	/*
	Function name :remove_fb()
	Parameter : $loc
	Return : redirect to account/customize profile page
	Use : remove facebook connection
	Description : user can remove facebook connection using this function 
	*/
	function remove_fb($loc=0)
	{
		$this->home_model->remove_fb();
		
		if($loc==1)
		{
			redirect('customize_profile');
		}
		
		redirect('account');
	}
	
	
	
	  //////////////============twitter authentication==================
   
   /*
	Function name :twitter_auth()
	Parameter : none
	Return : redirect to auth function
	Use : get user tweeter details
	Description : user can get tweeter details using this function 
	*/
	
   function twitter_auth()
	{
		$this->load->library('tweet');
		
		if ( !$this->tweet->logged_in() )
		{
			$this->tweet->set_callback(site_url('home/auth'));
			$this->tweet->login();
			
		}
		else{
				
				// $tokens = $this->tweet->get_tokens();
				
				//echo $tokens['oauth_token'];
				//echo $tokens['oauth_token_secret'];
				
				 redirect('home/auth');		
				
				// These can be saved in a db alongside a user record
				// if you already have your own auth system.
			}
	
	}
	
	
	/*
	Function name :auth()
	Parameter : none
	Return : array of tweeter user details
	Use : login using tweeter
	Description : user can login using tweeter
	*/
	
	function auth()
	{
		$this->load->library('tweet');
			//select from data if already register otherwise create new
					
			$tokens = $this->tweet->get_tokens();
			$user = $this->tweet->call('get', 'account/verify_credentials');
			
			//echo '<pre>'; print_r($user); die();
			
			
			$twitter_id= $user->id;			
			$first_name='';
			$last_name='';
			$twiter_img_url='';
			
	if(isset($user->screen_name) && $twitter_id>0) {

			
			$screen_name=$user->screen_name;
			
			$twiter_img_url=$user->profile_image_url_https;
			
			if(isset($user->name))
			{
				$first_name=$user->name;
				
				if(substr_count($first_name,' ')>=1)
				{
					$ex=explode(' ',$first_name);
					
					$first_name=$ex[0];
					$last_name=$ex[1];
				}
				
				
			}
			
			$name=$user->name;
		
			$check_twitter_exists=$this->home_model->check_twitter_exists($twitter_id);
				
			if($check_twitter_exists)
			{
				$get_twitter_user_detail=$this->home_model->get_twitter_user_detail($twitter_id);
								
				
					
			
			$data1=array(
					'user_id'=>$get_twitter_user_detail['user_id'],
					'login_date_time'=> date('Y-m-d H:i:s'),
					'login_ip'=>$_SERVER['REMOTE_ADDR']
					); 
			$this->db->insert('user_login',$data1);
			
			
			
			
		
			
			$data_tw=array(
					'user_id'=>$get_twitter_user_detail['user_id'],
					'full_name' => $get_twitter_user_detail['full_name'],
					'email'=>$get_twitter_user_detail['email'],
					'tw_id' =>$get_twitter_user_detail['tw_id'],
					);
			$this->session->set_userdata($data_tw);
			
			
			
			

			
			
	
	 		redirect('account');	
	 

				
				
				
				
							
			}
			else
			{
			
			
				if(get_authenticateUserID()>0)
				{
					
					$this->home_model->add_twitter($twitter_id,$screen_name);
		
					redirect('account');
					
					
				}
				else
				{
				
			
				/////======redirect for sign up===========
				
				 $twiter_img='';
	   				if(isset($twiter_img_url))
					{
							
							$base_path = base_path();
							$image_settings = image_setting();
							$inPath=$twiter_img_url;
							$outPath= $base_path.'upload/user/'.$screen_name.'.jpg';
							$in=    fopen($inPath, "rb");
							$out=   fopen($outPath, "wb");
							while ($chunk = fread($in,8192))
							{
								fwrite($out, $chunk, 8192);
							}
							fclose($in);
							fclose($out);
							$twiter_img=$screen_name.'.jpg';
							$config['upload_path'] = $base_path.'upload/user/';
							$config['allowed_types'] = 'jpg|jpeg|gif|png|bmp';
							//$config['max_size']	= '100';// in KB
							$this->load->library('upload', $config);
							$config['source_image'] = $this->upload->upload_path.$twiter_img;
							$config['new_image'] = $base_path."upload/user_orig/";
							$config['thumb_marker'] = "";
							//$config['maintain_ratio'] = $image_settings['u_ratio'];
							$config['create_thumb'] = TRUE;
							$config['width'] = $image_settings->user_width;
							$config['height'] = $image_settings->user_height;
							$this->load->library('image_lib', $config);
					
							if(!$this->image_lib->resize()){
								$error = $this->image_lib->display_errors();				
							}
							
					}	
					
				
				 $db_values = array (                    
						'fb_id' => '',
						'first_name' =>strtolower(str_replace (" ", "",$first_name)),
						'last_name' =>strtolower(str_replace (" ", "",$last_name)),                    
						'email'=>'',
						'tw_id'=>$twitter_id,
						'twiter_img'=>$twiter_img,
						'tw_screen_name'=>$screen_name
					);
					
				
				$this->social_signup($db_values);
			
	
				}
				 
				 
				 
			}
			
			
		}
		else
		{
			redirect('home/sign_up');		
		}	
			
	
	}
	
	/*
	Function name :remove_tw()
	Parameter : $loc
	Return : redirect to account/customize profile page
	Use : remove tweeter connection
	Description : user can remove tweeter connection using this function 
	*/
	function remove_tw($loc=0)
	{
		$this->home_model->remove_tw();
		
		if($loc==1)
		{
			redirect('customize_profile');
		}
		
		redirect('account');
	}
   
   
	
}

?>