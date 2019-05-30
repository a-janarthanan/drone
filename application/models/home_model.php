<?php
class Home_model extends CI_Model 
{

	/*
	Function name :Home_model
	Description :its default constuctor which called when Home_model object initialzie.its load necesary parent constructor
	*/
	function Home_model()
    {
        parent::__construct();	
    } 


	/*
	Function name :emailTaken()
	Parameter : $email (email address)
	Return : boolen
	Use : check the user unique email address
	*/
	
	function emailTaken($email)
	{
	
		 $query = $this->db->query("select * from ".$this->db->dbprefix('user')." where email='".$email."'");
		 
		 if($query->num_rows()>0)
		 {
			return true;
		 }
		 else 
		 {
			return false;
		 }		
	}

	
	/*
	Function name :check_spam_register()
	Parameter : none
	Return : 1 or 0
	Use : check new register user ip address for spamming
	*/
	
	function check_spam_register()
	{
		$spam_control=$this->db->query("select * from ".$this->db->dbprefix('spam_control')." ");
		$control=$spam_control->row();
		
		$total_register=$control->total_register;
		$register_expire=date('Y-m-d', strtotime('+'.$control->register_expire.' days'));
		
		
		$chk_spam=$this->db->query("select * from ".$this->db->dbprefix('user')." where sign_up_ip='".$this->input->ip_address()."' and DATE(sign_up_date)='".date('Y-m-d')."'");
		
		if($chk_spam->num_rows()>0)
		{	
			$total_posted_register=$chk_spam->num_rows();
			
			if($total_posted_register>=$total_register)
			{
								
				$make_spam=$this->db->query("insert into ".$this->db->dbprefix('spam_ip')."(`spam_ip`,`start_date`,`end_date`)values('".$this->input->ip_address()."','".date('Y-m-d')."','".$register_expire."')");
						
				return 1;				
			}
			else
			{
				return 0;
			}
		
		}
		
		return 0;		
	
	}	

	
	/*
	Function name :check_spam_inquiry()
	Parameter : none
	Return : 1 or 0
	Use : check the inquiry user ip address for spamming
	*/
	
	function check_spam_inquiry()
	{
		$spam_control=$this->db->query("select * from ".$this->db->dbprefix('spam_control')."");
		$control=$spam_control->row();
		
		$total_contact=$control->total_contact;
		$contact_expire=date('Y-m-d', strtotime('+'.$control->contact_expire.' days'));
		
		
		$chk_spam=$this->db->query("select * from ".$this->db->dbprefix('spam_inquiry')." where inquire_spam_ip='".$this->input->ip_address()."' and inquire_date='".date('Y-m-d')."'");
		
		if($chk_spam->num_rows()>0)
		{	
			$total_posted_inquire=$chk_spam->num_rows();
			
			if($total_posted_inquire>=$total_contact)
			{
								
				$make_spam=$this->db->query("insert into ".$this->db->dbprefix('spam_ip')."(`spam_ip`,`start_date`,`end_date`)values('".$this->input->ip_address()."','".date('Y-m-d')."','".$contact_expire."')");
				
				$delete_inquiry=$this->db->query("delete from ".$this->db->dbprefix('spam_inquiry')." where inquire_spam_ip='".$this->input->ip_address()."'");
						
				return 1;				
			}
			else
			{
				return 0;
			}
		
		}
		
		return 0;		
	
	}	
	
	
	
	/*
	Function name :insert_inquiry()
	Parameter : none
	Return : none
	Use : add inquire user ip address for spamming protection
	*/
	function insert_inquiry()
	{
		$query=$this->db->query("insert into ".$this->db->dbprefix('spam_inquiry')."(`inquire_spam_ip`,`inquire_date`)values('".$this->input->ip_address()."','".date('Y-m-d')."')");
	}
	
	
	/*
	Function name :is_login()
	Parameter : none
	Return : 1 or 0
	Use :  check user login information
	*/
	
	function is_login()
	{
		$this->load->helper('cookie');
		$username = $this->input->post('login_email');
		$password = $this->input->post('login_password');
		
	$query = $this->db->query("select * from ".$this->db->dbprefix('user')." where email='".$username."' and  password='".md5($password)."' ");
		
		if($query->num_rows() > 0)
		{
			$user = $query->row();
			
			
			if($user->verify_email==0)
			{
				return 2;
			}
			else
			{
			
			$data1=array(
					'user_id'=>$user->user_id,
					'login_date_time'=> date('Y-m-d H:i:s'),
					'login_ip'=>$this->input->ip_address()
					); 
			$this->db->insert('user_login',$data1);
			
			$login_id=mysql_insert_id();
			
			
			
			////===load cache driver===
		$login_details='';
		
		$supported_cache=check_supported_cache_driver();	
			
		$this->load->driver('cache');
		
		if(isset($supported_cache))
		{
			if($supported_cache!='' && $supported_cache!='none')
			{
				
				$get_user_login=$this->db->query("select * from ".$this->db->dbprefix('user_login')." where login_id='".$login_id."'");
		
					if($get_user_login->num_rows()>0)
					{					
						$login_details=$get_user_login->row();
						$this->cache->$supported_cache->save('user_login'.$user->user_id, $login_details,CACHE_VALID_SEC);								
					}			
				
			}
		}
		
				////===load cache driver===
				
				
			
			if($this->input->post('remember')=="1")
			{
				set_cookie(true);
			}else{
				set_cookie(false);
			}
			
			$data=array(
					'user_id' => $user->user_id,
					'full_name' => $user->full_name,
					'email'=>$user->email,
					);
			$this->session->set_userdata($data);						
			return "1";			
			
			}
			
		}
		else{
			return "0";
		}		
	}
	
	
	/*
	Function name :check_email()
	Parameter : none
	Return : 1 or 0
	Use :  check user forget password request 
	*/
	
	function check_email()
	{
		$email = $this->input->post('forget_email');
		$query = $this->db->query("select * from ".$this->db->dbprefix('user')." where email='".$email."'");
		
		if($query->num_rows()>0)
		{
			$row = $query->row();			
			
			$forget_password_code=randomCode();
				
				
		
			if($row->email != "")
			{
			
				
				
				$username =$row->full_name;
				$user_id = $row->user_id;
				$email = $row->email;
				
				
				$update_data=array(
				'forget_password_code'=>$forget_password_code,
				'forget_password_request'=>1				
				);	
				
				$this->db->where('user_id',$user_id);
				$this->db->update('user',$update_data);
			
			
				$email_template=$this->db->query("select * from ".$this->db->dbprefix('email_template')." where task='Forgot Password'");
				$email_temp=$email_template->row();				
			
				
				$email_address_from=$email_temp->from_address;
				$email_address_reply=$email_temp->reply_address;
				
				$email_subject=$email_temp->subject;				
				$email_message=$email_temp->message;
				
				
				
				$email_to =$email;
				
				
				$reset_password_link=base_url().'reset_password/'.$user_id.'/'.$forget_password_code;
				
				$email_message=str_replace('{break}','<br/>',$email_message);
				$email_message=str_replace('{user_name}',$username,$email_message);
				$email_message=str_replace('{email}',$email,$email_message);
				$email_message=str_replace('{reset_password_link}',$reset_password_link,$email_message);
				
				$str=$email_message;
				
				/** custom_helper email function **/
									
				email_send($email_address_from,$email_address_reply,$email_to,$email_subject,$str);
				
					
							
				return '1';
				
			}
			else
			{
				return '0';
			}
		}
		else
		{
			return '0';
		}
		
	}
	
	
	/*
	Function name :check_valid_request()
	Parameter : $user_id (user_id), $code (code)
	Return : boolen
	Use :  check user valid forget password request 
	*/
	function check_valid_request($user_id,$code)
	{
		
		$query=$this->db->get_where('user',array('user_id'=>$user_id,'forget_password_code'=>$code,'forget_password_request'=>1));
		
		if($query->num_rows()>0)
		{			
			return true;
			
		} else {
		
			return false;		
		}
	
	}
	
	
	/*
	Function name :check_valid_request()
	Parameter : $user_id (user_id), $code (code)
	Return : boolen
	Use :  reset password
	*/
	function reset_password($user_id,$code)
	{
			
			$data=array(
			'forget_password_request'=>0,
			'forget_password_code'=>'',
			'password'=>md5($this->input->post('new_password'))			
			);
			
			
			$this->db->where('user_id',$user_id);
			$this->db->update('user',$data);
			
			return true;
	}
	
	
	/*
	Function name :register()
	Parameter : none
	Return : 1
	Use :  user sign up or register
	*/
	
	function register()
	{	
		
		$email_verification_code=randomCode();
		
		$user_setting=user_setting();
		
		
		$user_status=$user_setting->sign_up_auto_active;
		
		if($this->input->post('fb_id') || $this->input->post('tw_id'))
		{
			$user_status=1;
		}
		
		$first_name=$this->input->post('full_name');
		$last_name=$this->input->post('last_name');
		$fullname=$this->input->post('full_name').' '.$this->input->post('last_name');
		
		/*if(substr_count(trim($this->input->post('full_name')),' ')>=1)
		{
			$ex=explode(' ',$this->input->post('full_name'));
			$first_name=$ex[0];
			$last_name=$ex[1];			
		}*/
		
		if($last_name!='')
		{
			$profile_name=clean_url($first_name.' '.substr($last_name,0,1));
		}
		else
		{
			$profile_name=clean_url($first_name);
		}
		
		
			
	$chk_url_exists=$this->db->query("select MAX(profile_name) as profile_name from ".$this->db->dbprefix('user')." where profile_name like '".$profile_name."%'");
		
		if($chk_url_exists->num_rows()>0)
		{			
				$get_pr=$chk_url_exists->row();					
				
				$strre='0';
				if($get_pr->profile_name!='')
				{
					$strre=str_replace($profile_name,'',$get_pr->profile_name);
				}
				
				if($strre=='0') 
				{					
					$newcnt=''; 
					  				
				} 
				elseif($strre=='') 
				{					
					$newcnt='1';   				
				}
				else
				{				
					$newcnt=(int)$strre+1;			
				}
				
			 	$profile_name=$profile_name.$newcnt;
						
		}
			
			
			
		
		
		
		$data = array(		
				'full_name' => $fullname,		
				'first_name' => $first_name,
				'last_name' => $last_name,	
				'profile_name'=>$profile_name,			
				'email' => $this->input->post('email'),			
				'password' => md5($this->input->post('password')),		
				'sign_up_ip' => $this->input->ip_address(),
				'email_verification_code'=>$email_verification_code,
				'zip_code'=>$this->input->post('zip_code'),
				'mobile_no'=>$this->input->post('mobile_no'),						
				'user_status' => $user_status,
				'sign_up_date' => date('Y-m-d H:i:s'),
				'fb_id' => $this->input->post('fb_id'),		
				'tw_id' => $this->input->post('tw_id'),		
				'twitter_screen_name' => $this->input->post('tw_screen_name'),		
				); 
		$this->db->insert('user', $data);
		$user_id = mysql_insert_id();
		
		
		/*****create profile****/
		$image = '';
		
		if($_FILES) 
			{
			
				if($_FILES['file1']['name']!="")
				{
					$image = $this->upload->file_name;
				}
			}
			$active=0;
			if($this->input->post('fb_img')){$image=$this->input->post('fb_img');$active=1;}
			if($this->input->post('twiter_img')){$image=$this->input->post('twiter_img');$active=1;}
			
			
		
		$data_profile=array(
		'user_id'=>$user_id,
		'profile_image' =>$image
		);

		$this->db->insert('user_profile',$data_profile);
		
		
			/*** user notification ****/
	
		$user_notification=mysql_query("SHOW COLUMNS FROM ".$this->db->dbprefix('user_notification'));
		$res=mysql_fetch_array($user_notification);
		$fields="";
		$values="";
				
		while($res=mysql_fetch_array($user_notification)){
		//print_r($res['Field']);echo '<br>';
		if($fields==""){$fields.="(`".$res['Field']."`"; $values.="('".$user_id."'";}
		else {$fields.=",`".$res['Field']."`";	 $values.=",'1'";}
		}
		$fields.=")";
		 $values.=")";								   
		$insert_val= $fields.' values '.$values;
		
		$this->db->query("insert into ".$this->db->dbprefix('user_notification')." ".$insert_val."");
		
	
		/*******************/
	
	
		return 1;
		
		
	}
	
	function linkdinregister($user)
	{	
		
		$email_verification_code=randomCode();
		
		$user_setting=user_setting();
		
		
		$user_status=$user_setting->sign_up_auto_active;
		
		
		$user_status=1;
		
		
		$first_name=$user[ 'firstName' ];
		$last_name=$user[ 'lastName' ];
		$fullname=$first_name.' '.$last_name;
		
		/*if(substr_count(trim($this->input->post('full_name')),' ')>=1)
		{
			$ex=explode(' ',$this->input->post('full_name'));
			$first_name=$ex[0];
			$last_name=$ex[1];			
		}*/
		
		if($last_name!='')
		{
			$profile_name=clean_url($first_name.' '.substr($last_name,0,1));
		}
		else
		{
			$profile_name=clean_url($first_name);
		}
		
		
			
	$chk_url_exists=$this->db->query("select MAX(profile_name) as profile_name from ".$this->db->dbprefix('user')." where profile_name like '".$profile_name."%'");
		
		if($chk_url_exists->num_rows()>0)
		{			
				$get_pr=$chk_url_exists->row();					
				
				$strre='0';
				if($get_pr->profile_name!='')
				{
					$strre=str_replace($profile_name,'',$get_pr->profile_name);
				}
				
				if($strre=='0') 
				{					
					$newcnt=''; 
					  				
				} 
				elseif($strre=='') 
				{					
					$newcnt='1';   				
				}
				else
				{				
					$newcnt=(int)$strre+1;			
				}
				
			 	$profile_name=$profile_name.$newcnt;
						
		}
			
			
			
		
		
		
		$data = array(		
				'full_name' => $fullname,		
				'first_name' => $first_name,
				'last_name' => $last_name,	
				'profile_name'=>$profile_name,			
				'email' => $user[ 'email' ],				
				'sign_up_ip' => $this->input->ip_address(),
				'email_verification_code'=>$email_verification_code,						
				'user_status' => $user_status,
				'sign_up_date' => date('Y-m-d H:i:s'),
				'fb_id' => $user[ 'social_id' ]	
				); 
		$this->db->insert('user', $data);
		$user_id = mysql_insert_id();
		
		
		/*****create profile****/
		$profile_image_url = $user[ 'profile_image_url' ];
			
		$image_name = time().'_proflie_pic.jpg';
		  $save_to = '/upload/user_orig/'.$image_name;
		  
		  copy($profile_image_url,$save_to);
		  
		  if (!file_exists($save_to)) {
			$image_name='user_default.png';
		  }
		
		$data_profile=array(
		'user_id'=>$user_id,
		'profile_image' =>$image_name
		);

		$this->db->insert('user_profile',$data_profile);
		
		
		
			/*** user notification ****/
	
		$user_notification=mysql_query("SHOW COLUMNS FROM ".$this->db->dbprefix('user_notification'));
		$res=mysql_fetch_array($user_notification);
		$fields="";
		$values="";
				
		while($res=mysql_fetch_array($user_notification)){
		//print_r($res['Field']);echo '<br>';
		if($fields==""){$fields.="(`".$res['Field']."`"; $values.="('".$user_id."'";}
		else {$fields.=",`".$res['Field']."`";	 $values.=",'1'";}
		}
		$fields.=")";
		 $values.=")";								   
		$insert_val= $fields.' values '.$values;
		
		$this->db->query("insert into ".$this->db->dbprefix('user_notification')." ".$insert_val."");
		
	
		/*******************/
	
	
		return 1;
		
		
	}
	/*
	Function name :verify_user()
	Parameter : $user_id (user id), $code (email verification code)
	Return : boolen
	Use :  check email account verification
	*/
	function verify_user($user_id,$code)
	{
		
		$query=$this->db->get_where('user',array('user_id'=>$user_id,'email_verification_code'=>$code,'verify_email'=>0));
		
		if($query->num_rows()>0)
		{
			
			$data=array(
			'verify_email'=>1,
			'user_status'=>1,			
			);
			$this->db->where('user_id',$user_id);
			$this->db->update('user',$data);
			
			return true;
			
		} else {
		
			return false;		
		}
		
	}
	
	
	
	
	/////////////////============facebook============
   
   /*
	Function name :remove_fb()
	Parameter : none
	Return : none
	Use :  remove facebook connection
	*/
   function remove_fb()
   {
   		$data=array(
			'fb_id'=>''
		);
		
   		$this->db->where('user_id',get_authenticateUserID());
   		$this->db->update('user',$data);   
   }
   
	/*
	Function name :validate_user_facebook()
	Parameter : $uid (user id), $email (email id)
	Return : boolean or 2
	Use :  check facebook details validate or not
	*/
	
	function validate_user_facebook($uid = 0,$email='') {
		//confirm that facebook session data is still valid and matches
		$this->load->library('fb_connect');
		
   		//see if the facebook session is valid and the user id in the sesison is equal to the user_id you want to validate
		//$session_uid = $this->fb_connect->fbSession['uid'];
		if(!$this->fb_connect->fbSession) {
   	  		return false;
		}
        
   	  	//Receive Data
      	 $this->user_id    = $uid;

      
	  if($email!=''){
	  
		 $query = $this->db->get_where('user',array('email'=>$email,'user_status'=>'1'));
		
		if($query->num_rows() > 0)
		{
			$this->db->query("Update ".$this->db->dbprefix('user')." set fb_id='".$this->user_id."' where email='".$email."' and user_status='1'");
			$user = $query->row();
			
			$data1=array(
					'user_id'=>$user->user_id,
					'login_date_time'=> date('Y-m-d H:i:s'),
					'login_ip'=>$this->input->ip_address()
					); 
			$this->db->insert('user_login',$data1);
					
			
					
			
			
			$data=array(
					'user_id' => $user->user_id,
					'full_name' => $user->full_name,
					'facebook_id' => $this->user_id,
					'email'=>$user->email,	
					);
			$this->session->set_userdata($data);

			
			return "2";			
		}	
		else{
			
	  //See if User exists
      $this->db->where('fb_id', $this->user_id);
      $q = $this->db->get('user');

      if($q->num_rows == 1) {
         //yes, a user exists,
		 
		 $query = $this->db->get_where('user',array('fb_id'=>$this->user_id,'user_status'=>'1'));
		
		if($query->num_rows() > 0)
		{
			$user = $query->row();
			
			
			
			
			
			$data1=array(
					'user_id'=>$user->user_id,
					'login_date_time'=> date('Y-m-d H:i:s'),
					'login_ip'=>$this->input->ip_address()
					); 
			$this->db->insert('user_login',$data1);		

			
			$data=array(
					'user_id' => $user->user_id,
					'full_name' => $user->full_name,
					'facebook_id' => $this->user_id,
					'email'=>$user->email,	
					);
			$this->session->set_userdata($data);

					
						
			return "2";			
		}	
		
		
		 return true;
      }

      //no user exists
      return false;
	  
	  
		}
	
	  }
	  else{
	  //See if User exists
      $this->db->where('fb_id', $this->user_id);
      $q = $this->db->get('user');

      if($q->num_rows == 1) {
         //yes, a user exists,
		 
		 $query = $this->db->getwhere('user',array('fb_id'=>$this->user_id,'user_status'=>'1'));
		
		if($query->num_rows() > 0)
		{
			$user = $query->row();
			
			
			
			
			
			$data1=array(
					'user_id'=>$user->user_id,
					'login_date_time'=> date('Y-m-d H:i:s'),
					'login_ip'=>$this->input->ip_address()
					); 
			$this->db->insert('user_login',$data1);
			
			
			
					
			$data=array(
					'user_id' => $user->user_id,
					'full_name' => $user->full_name,
					'facebook_id' => $this->user_id,
					'email'=>$user->email,	
					);
			$this->session->set_userdata($data);

					
						
			return "2";			
		}	
		
		
		 return true;
      }

      //no user exists
      return false;
	  
	  }
   }
   
   
   	/*
	Function name :get_user_by_fb_uid()
	Parameter : $fb_id (facebook id), $email (email id)
	Return : array of user details
	Use :  get array of user details
	*/
    function get_user_by_fb_uid($fb_id = 0,$email='') {
	
	   	//returns the facebook user as an array.
	   		$sql = " SELECT * FROM ".$this->db->dbprefix('user')." WHERE fb_id ='".$fb_id."'";
		
		if($email != ''){
			$sql = " SELECT * FROM ".$this->db->dbprefix('user')." WHERE fb_id ='".$fb_id."' or email='".$email."'";
		}
		
	
		
	   	$usr_qry = $this->db->query($sql);
		
	   	if($usr_qry->num_rows() > 0) {
		//yes, a user exists
			$user = $usr_qry->row();
			
			
			
			
			if($user->fb_id == 0){
				$data2 = array(					
						'fb_id' => $fb_id	
				);
						
				$this->db->where('email', $email);
				$this->db->update('user', $data2);
				
			}
			
			$data1=array(
					'user_id'=>$user->user_id,
					'login_date_time'=> date('Y-m-d H:i:s'),
					'login_ip'=>$this->input->ip_address()
					); 
			$this->db->insert('user_login',$data1);
			
			
			$data=array(
					'user_id' => $user->user_id,
					'full_name' => $user->full_name,
					'email'=>$email,
					'fb_id' =>$fb_id,
					);
			$this->session->set_userdata($data);
//			print_r($data1); print_r($data); die();
	   		
	   		return $user;
	   	} else {
	   		// no user exists
	   		return false;
	   	}
	
	   		
   }
   
 
	
	/*
	Function name :get_user_by_fb_uid()
	Parameter : $fb_values (array of facebook user details),
	Return : integer of user id
	Use :  user sign up or register using facebook
	*/
	function add_fbdata($fb_values) {
		$first_name=$fb_values['first_name'];
		$last_name=$fb_values['last_name'];

		
		$profile_name=clean_url($fb_values['full_name']);
		
					
			
	$chk_url_exists=$this->db->query("select MAX(profile_name) as profile_name from ".$this->db->dbprefix('user')." where profile_name like '".$profile_name."%'");
		
		if($chk_url_exists->num_rows()>0)
		{			
				$get_pr=$chk_url_exists->row();					
				
				$strre='0';
				if($get_pr->profile_name!='')
				{
					$strre=str_replace($profile_name,'',$get_pr->profile_name);
				}
				
				if($strre=='0') 
				{					
					$newcnt=''; 
					  				
				} 
				elseif($strre=='') 
				{					
					$newcnt='1';   				
				}
				else
				{				
					$newcnt=(int)$strre+1;			
				}
				
			 	$profile_name=$profile_name.$newcnt;
						
		}

		
		$data = array(		
				'full_name' => $fb_values['full_name'],	
				'first_name' => $first_name,
				'last_name' => $last_name,	
				'profile_name'=>$profile_name,			
				'email' => $fb_values['email'],		
				'sign_up_ip' => $this->input->ip_address(),					
				'user_status' => 0,
				'sign_up_date' => date('Y-m-d H:i:s'),
				'fb_id' =>$fb_values['fb_id'],
				); 
		$this->db->insert('user', $data);
		$user_id = mysql_insert_id();
		return $user_id;
	}
	
	
	/*
	Function name :fb_register()
	Parameter : $user_id (user id),
	Return : 1 or 0
	Use :  user sign up or update user details using facebook
	*/
	function fb_register($user_id) {	

		$email_verification_code=randomCode();
		
		$data = array(					
				'password' => md5($this->input->post('password')),		
				'sign_up_ip' => $this->input->ip_address(),
				'email_verification_code'=>$email_verification_code,
				'zip_code'=>$this->input->post('zip_code'),
				'mobile_no'=>$this->input->post('mobile_no'),						
				'user_status' => 1,
				'sign_up_date' => date('Y-m-d H:i:s'),
				); 
		$this->db->where('user_id', $user_id);
		$this->db->update('user', $data);
		
		
		/*****create profile****/
		
		$data_profile=array(
		'user_id'=>$user_id
		);
		
		$this->db->insert('user_profile',$data_profile);
		
		
			/*** user notification ****/
	
		$user_notification=mysql_query("SHOW COLUMNS FROM ".$this->db->dbprefix('user_notification')." ");
		$res=mysql_fetch_array($user_notification);
		$fields="";
		$values="";
				
		while($res=mysql_fetch_array($user_notification)){
		//print_r($res['Field']);echo '<br>';
		if($fields==""){$fields.="(`".$res['Field']."`"; $values.="('".$user_id."'";}
		else {$fields.=",`".$res['Field']."`";	 $values.=",'1'";}
		}
		$fields.=")";
		 $values.=")";								   
		$insert_val= $fields.' values '.$values;
		
		$this->db->query("insert into ".$this->db->dbprefix('user_notification')." ".$insert_val."");
		
	
		/*******************/

		
		$query = $this->db->query("select * from ".$this->db->dbprefix('user')." where user_id = '".$user_id."' and user_status=1");
		
		if($query->num_rows() > 0)
		{
			$user = $query->row();
			$data1=array(
					'user_id'=>$user->user_id,
					'login_date_time'=> date('Y-m-d H:i:s'),
					'login_ip'=>$this->input->ip_address()
					); 
			$this->db->insert('user_login',$data1);
			
			
			$data=array(
					'user_id' => $user->user_id,
					'full_name' => $user->full_name,
					'email'=>$user->email,
					'fb_id' =>$user->fb_id,
					);
			$this->session->set_userdata($data);						
			return "1";			
		}
		else{
			return "0";
		}		
		
		
	}
	
	
	///////////////============twitter ================
   
   /*
	Function name :check_twitter_exists()
	Parameter : $twitter_id (twitter id),
	Return : boolen
	Use :  check tweeter user account
	*/
   function check_twitter_exists($twitter_id)
   {
   		$query=$this->db->query("select * from ".$this->db->dbprefix('user')." where tw_id='".$twitter_id."'  ");
		
		
		
		if($query->num_rows()>0)
		{
			return true;
		}
		else
		{
			return false;
		}
   
   }
   
   /*
	Function name :get_twitter_user_detail()
	Parameter : $twitter_id (twitter id),
	Return : array of tweeter user details
	Use :  get tweeter user details
	*/
   function get_twitter_user_detail($twitter_id)
   {
   		$query=$this->db->query("select * from ".$this->db->dbprefix('user')." where tw_id='".$twitter_id."'  ");
		
		if($query->num_rows()>0)
		{
			return $query->row_array();
		}
		
		return 0;
   
   
   }
   
	/*
	Function name :add_twitter()
	Parameter : $twitter_id (twitter id), $screen_name (tweeter screen name)
	Return : none
	Use :  update tweeter user details
	*/
	function add_twitter($twitter_id,$screen_name)
	{
		$data=array(
			'tw_id'=>$twitter_id,
			'twitter_screen_name'=>$screen_name
		);
		
		$this->db->where('user_id',get_authenticateUserID());
		$this->db->update('user',$data);  
	}
	
	
	/*
	Function name :remove_tw()
	Parameter : none
	Return : none
	Use :  remove tweeter connection
	*/
	function remove_tw()
   {
		$data=array(
			'tw_id'=>'',
			'twitter_screen_name'=>''
		);
		
		$this->db->where('user_id',get_authenticateUserID());
		$this->db->update('user',$data);   
   }

   function bannerlist()
	{

	
		$query = $this->db->query("select * from trc_banner");
		
		if($query->num_rows()>0)
			{
				return $query->result();	
			}
			
		return 0;
	}

}

?>