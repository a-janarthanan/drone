<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


	
	
	// --------------------------------------------------------------------

	/**
	 * Site Base Path
	 *
	 * @access	public
	 * @param	string	the Base Path string
	 * @return	string
	 */
	function base_path()
	{		
		$CI =& get_instance();
		return $base_path = $CI->config->slash_item('base_path');		
	}
	
	
	// --------------------------------------------------------------------

	/**
	 * Site Front Url
	 *
	 * @access	public
	 * @param	string	the Front Url string
	 * @return	string
	 */
	function front_base_url()
	{		
		$CI =& get_instance();
		return $base_path = $CI->config->slash_item('base_url_site');		
	}
	
	// --------------------------------------------------------------------

	/**
	 * Site Front ActiveTemplate
	 *
	 * @access	public
	 * @param	string	current theme folder name
	 * @return	string
	 */
	
	function getThemeName()
	{
		
		$default_theme_name='default';
		
		$CI =& get_instance();
		
		
		$supported_cache=check_supported_cache_driver();
		
		if(isset($supported_cache))
		{
			if($supported_cache!='' && $supported_cache!='none')
			{
				////===load cache driver===
				$CI->load->driver('cache');
				
				if($CI->cache->$supported_cache->get('front_theme_name'))
				{
					$theme_name = $CI->cache->$supported_cache->get('front_theme_name');				
				}
				else
				{
					$query = $CI->db->get_where("template_manager",array('active_template'=>1 ,'is_admin_template'=>0));
					$row = $query->row();
					$theme_name=trim($row->template_name);
					
					$CI->cache->$supported_cache->save('front_theme_name', $theme_name,CACHE_VALID_SEC);			
				}
			
			}
			
			else
			{
				$query = $CI->db->get_where("template_manager",array('active_template'=>1 ,'is_admin_template'=>0));
				$row = $query->row();
				$theme_name=trim($row->template_name);
			}
		}
		else
		{
			$query = $CI->db->get_where("template_manager",array('active_template'=>1 ,'is_admin_template'=>0));
			$row = $query->row();
			$theme_name=trim($row->template_name);
		}
		//////////====end cache part
		
		
		
		
		
		
		
		
		if(is_dir(APPPATH.'views/'.$theme_name))
		{
			return $theme_name;
		}
		else
		{
			return $default_theme_name;	
		}
		
		
		
		
		
	}
	
		
	
	/**** get dynamic logo of current theme
	* return array
	***/
	
	function logo_image()
	{	
	
		$CI =& get_instance();
		$query = $CI->db->get_where("template_manager",array('active_template'=>1 ,'is_admin_template'=>0));
		
		if($query->num_rows()>0)
		{
			return $query->row();	
		}
		return 0;	
		
	
	}
	
	
	
	// --------------------------------------------------------------------

	/**
	 * Check user login
	 *
	 * @return	boolen
	 */
	function check_user_authentication()
	{		
		$CI =& get_instance();
		
			if($CI->session->userdata('user_id')!='')
			{
				return true;
			}
			else
			{
				return false;
			}
	
	}
	
	
	// --------------------------------------------------------------------

	/**
	 * get login user id
	 *
	 * @return	integer
	 */
	function get_authenticateUserID()
	{		
		$CI =& get_instance();
		return $CI->session->userdata('user_id');
	}
	
	
	/**** check user online status
	**
	****/
	
	function check_online_user()
	{
		$cur_date_time=date('Y-m-d H:i:s');	
		
		$CI =& get_instance();
		
		$login_details='';
		
		$supported_cache=check_supported_cache_driver();
		
		////===load cache driver===
		$CI->load->driver('cache');
		
		if(isset($supported_cache))
		{
			if($supported_cache!='' && $supported_cache!='none')
			{
				
				
				if($CI->cache->$supported_cache->get('user_login'.get_authenticateUserID()))
				{					
					$login_details=(object)$CI->cache->$supported_cache->get('user_login'.get_authenticateUserID());					
				}
				else
				{
					
					$get_user_login=$CI->db->query("select * from ".$CI->db->dbprefix('user_login')." where DATE(login_date_time)='".date('Y-m-d')."'  and login_status=1 and user_id='".get_authenticateUserID()."' order by login_id desc limit 1");
		
					if($get_user_login->num_rows()>0)
					{					
						$login_details=$get_user_login->row();
						$CI->cache->$supported_cache->save('user_login'.get_authenticateUserID(), $login_details,CACHE_VALID_SEC);								
					}
				
				
				}
			
			}
			
			else
			{
							
				$get_user_login=$CI->db->query("select * from ".$CI->db->dbprefix('user_login')." where DATE(login_date_time)='".date('Y-m-d')."'  and login_status=1 and user_id='".get_authenticateUserID()."' order by login_id desc limit 1");
		
				if($get_user_login->num_rows()>0)
				{					
					$login_details=$get_user_login->row();							
				}					
					
			}
		}
		else
		{
				$get_user_login=$CI->db->query("select * from ".$CI->db->dbprefix('user_login')." where DATE(login_date_time)='".date('Y-m-d')."'  and login_status=1 and user_id='".get_authenticateUserID()."' order by login_id desc limit 1");
		
				if($get_user_login->num_rows()>0)
				{					
					$login_details=$get_user_login->row();							
				}
		}
		//////////====end cache part
		
		
		
		
		if($login_details)
		{
		
			 $login_time=$login_details->login_date_time;						
			 $login_extend_time=date('Y-m-d H:i:s',strtotime(date("Y-m-d H:i:s", strtotime($login_time)) . " +20 minutes"));
			 
			 
			 if(strtotime($cur_date_time)>strtotime($login_extend_time))
			 {
			 	$data_up=array(
					'login_status'=>0
				);
				
			 	$CI->db->where('login_id',$login_details->login_id);
			 	$CI->db->update('user_login',$data_up);
				
				
				
				////==destroy cache====	
			
				
				if(isset($supported_cache))
				{
					if($supported_cache!='' && $supported_cache!='none')
					{	
						if($CI->cache->$supported_cache->get('user_login'.get_authenticateUserID()))
						{								
							$CI->cache->$supported_cache->delete('user_login'.get_authenticateUserID());						
						}
					}
					
				}
				
				
				////==destroy user session===
				$CI->session->set_userdata('user_id', $CI->security->xss_clean(''));	
				$CI->session->set_userdata('full_name', $CI->security->xss_clean(''));	
				
				
			
				
				
			 
			 }
			 else
			 {
			 	
				$data_up=array(
					'login_status'=>1,
					'login_date_time'=>$cur_date_time,
					'login_id'=>$login_details->login_id,
					'user_id'=>get_authenticateUserID(),
					'login_ip'=>$login_details->login_ip,
				);
				
				
				if(isset($supported_cache))
				{
					if($supported_cache!='' && $supported_cache!='none')
					{		 	
						$CI->cache->$supported_cache->save('user_login'.get_authenticateUserID(), $data_up,CACHE_VALID_SEC);	
					}
					else
					{
						$data_sess=array(
						'login_status'=>1,
						'login_date_time'=>$cur_date_time
						);
						
						
						$CI->db->where('login_id',$login_details->login_id);
						$CI->db->update('user_login',$data_sess);
						
					}
				}
				
				else
				{
					$data_sess=array(
					'login_status'=>1,
					'login_date_time'=>$cur_date_time
					);
					
					
					$CI->db->where('login_id',$login_details->login_id);
					$CI->db->update('user_login',$data_sess);
					
				}
				
				
			 	
			 }
			 
			 
		}
			
			else
			{			
				
				
				////==destroy cache====				
				if(isset($supported_cache))
				{
					if($supported_cache!='' && $supported_cache!='none')
					{	
						if($CI->cache->$supported_cache->get('user_login'.get_authenticateUserID()))
						{								
							$CI->cache->$supported_cache->delete('user_login'.get_authenticateUserID());						
						}
					}
					
				}
				
				////==destroy user session===
				$CI->session->set_userdata('user_id', $CI->security->xss_clean(''));	
				$CI->session->set_userdata('full_name', $CI->security->xss_clean(''));
					
			}		
					
					
					
	}
	
	/*** check user suspend 
	*** 1= temprory, 0= none, 2=permanent
	*** return boolean
	***/
	
	function check_user_suspend()
	{
		$CI =& get_instance();
		
		$cur_date=date('Y-m-d H:i:s');
	
		$query=$CI->db->get_where('user',array('user_id'=>get_authenticateUserID()));
		
		if($query->num_rows()>0)
		{
			$result=$query->row();	
			
			if($result->user_status==2)
			{
				return 1;
			}
			
			return 0;
		}
		
		
		/*$query=$CI->db->query("select * from ".$CI->db->dbprefix('user_suspend')." where user_id='".get_authenticateUserID()."' and '".$cur_date."' between suspend_from_date and suspend_to_date order by user_suspend_id desc limit 1");
	
		
		if($query->num_rows()>0)
		{
			return 1;
		}
		else
		{
			
			$query=$CI->db->query("select * from ".$CI->db->dbprefix('user_suspend')." where user_id='".get_authenticateUserID()."' and is_permanent=1 order by user_suspend_id desc limit 1");
			
			if($query->num_rows()>0)
			{
				return 2;
			}
			
		}*/
		
		return 0;
		
	}
	
	// --------------------------------------------------------------------

	/**
	 * get site visitor ip address 
	 *
	 * @return	integer
	 */
	 
	 
	function spam_protection()
	{
		$CI =& get_instance();
		$CI->db->order_by('spam_id','desc');
		$query = $CI->db->get_where("spam_ip",array('spam_ip'=>$_SERVER['REMOTE_ADDR']),1);
		
		if($query->num_rows()>0)
		{
			return 1;
		}
		
		return 0;
			
	}
	
	
	
	/**
	 * get site visitor ip address
	 *
	 * @return	integer
	 */
	 
	 
	
	function email_send($email_address_from,$email_address_reply,$email_to,$email_subject,$str)
	{
				
		$CI =& get_instance();
		$query = $CI->db->get_where("email_setting",array('email_setting_id'=>1));
		$email_set=$query->row();
					
									
		$CI->load->library(array('email'));
			
		///////====smtp====
		
		if($email_set->mailer=='smtp')
		{
		
			$config['protocol']='smtp';  
			$config['smtp_host']=trim($email_set->smtp_host);  
			$config['smtp_port']=trim($email_set->smtp_port);  
			$config['smtp_timeout']='30';  
			$config['smtp_user']=trim($email_set->smtp_email);  
			$config['smtp_pass']=trim($email_set->smtp_password);  
					
		}
		
		/////=====sendmail======
		
		elseif(	$email_set->mailer=='sendmail')
		{	
		
			$config['protocol'] = 'sendmail';
			$config['mailpath'] = trim($email_set->sendmail_path);
			
		}
		
		/////=====php mail default======
		
		else
		{
		
		}
			
			
		$config['wordwrap'] = TRUE;	
		$config['mailtype'] = 'html';
		$config['crlf'] = '\n\n';
		$config['newline'] = '\n\n';
		
		$CI->email->initialize($config);	
				
		
		$CI->email->from($email_address_from);
		$CI->email->reply_to($email_address_reply);
		$CI->email->to($email_to);
		$CI->email->subject($email_subject);
		$CI->email->message($str);
		$CI->email->send();

	}
	
	
	
	
	/**
	 * generate random code
	 *
	 * @return	string
	 */
	
	function randomCode()
	{
		$alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
		$pass = array(); 
		
		for ($i = 0; $i < 12; $i++) {
		$n = rand(0, strlen($alphabet)-1); //use strlen instead of count
		$pass[$i] = $alphabet[$n];
		}
		return implode($pass); //turn the array into a string
	}
	
	
	/*** load site setting
	*  return single record array
	**/
	
	function site_setting()
	{		
		$CI =& get_instance();
		
		
		$supported_cache=check_supported_cache_driver();
		
		if(isset($supported_cache))
		{
			if($supported_cache!='' && $supported_cache!='none')
			{
				////===load cache driver===
				$CI->load->driver('cache');
				
				if($CI->cache->$supported_cache->get('site_setting'))
				{
					return  (object)$CI->cache->$supported_cache->get('site_setting');				
				}
				else
				{
					$query = $CI->db->get("site_setting");
					$CI->cache->$supported_cache->save('site_setting', $query->row(),CACHE_VALID_SEC);	
					return $query->row();						
				}
			
			}
			
			else
			{
				$query = $CI->db->get("site_setting");
				return $query->row();
			}
		}
		else
		{
			$query = $CI->db->get("site_setting");
			return $query->row();
		}
		//////////====end cache part
		
		
		
	
	}
	
	
	
	
	
	
	/*** load user setting
	*  return single record array
	**/
	
	function user_setting()
	{		
		$CI =& get_instance();
		
		
		
		
		$supported_cache=check_supported_cache_driver();
		
		if(isset($supported_cache))
		{
			if($supported_cache!='' && $supported_cache!='none')
			{
				////===load cache driver===
				$CI->load->driver('cache');
				
				if($CI->cache->$supported_cache->get('user_setting'))
				{
					return (object)$CI->cache->$supported_cache->get('user_setting');				
				}
				else
				{
					$query = $CI->db->get("user_setting");
					$CI->cache->$supported_cache->save('user_setting', $query->row(),CACHE_VALID_SEC);	
					return $query->row();						
				}
			
			}
			
			else
			{
				$query = $CI->db->get("user_setting");
				return $query->row();
			}
		}
		else
		{
			$query = $CI->db->get("user_setting");
			return $query->row();
		}
		//////////====end cache part
		
		
		
	
	}
	
	
	/*** load meta setting
	*  return single record array
	**/
	
	function meta_setting()
	{		
		$CI =& get_instance();
		
		
		$supported_cache=check_supported_cache_driver();
		
		if(isset($supported_cache))
		{
			if($supported_cache!='' && $supported_cache!='none')
			{
				////===load cache driver===
				$CI->load->driver('cache');
				
				if($CI->cache->$supported_cache->get('meta_setting'))
				{
					return (object)$CI->cache->$supported_cache->get('meta_setting');				
				}
				else
				{
					$query = $CI->db->get("meta_setting");
					$CI->cache->$supported_cache->save('meta_setting', $query->row(),CACHE_VALID_SEC);	
					return $query->row();						
				}
			
			}
			
			else
			{
				$query = $CI->db->get("meta_setting");
				return $query->row();
			}
		}
		else
		{
			$query = $CI->db->get("meta_setting");
			return $query->row();
		}
		//////////====end cache part
	
	
	}
	
	
	/*** load task setting
	*  return single record array
	**/
	
	function task_setting()
	{		
		$CI =& get_instance();
		$query = $CI->db->get("task_setting");
		return $query->row();	
	}
	
	/*** load image setting
	*  return single record array
	**/
	
	function image_setting()
	{		
		$CI =& get_instance();
		$query = $CI->db->get("image_setting");
		return $query->row();	
	}
	
	
	/*** load facebook setting
	*  return single record array
	**/
	
	function facebook_setting()
	{		
		$CI =& get_instance();
		$query = $CI->db->get("facebook_setting");
		return $query->row();	
	}
	
	
	/*** load twitter setting
	*  return single record array
	**/
	
	function twitter_setting()
	{		
		$CI =& get_instance();
		$query = $CI->db->get("twitter_setting");
		return $query->row();	
	}
	
	
	
	
	/*** load wallet setting
	*  return single record array
	**/
	
	function wallet_setting()
	{		
		$CI =& get_instance();
		
		
		
		$supported_cache=check_supported_cache_driver();
		
		if(isset($supported_cache))
		{
			if($supported_cache!='' && $supported_cache!='none')
			{
				////===load cache driver===
				$CI->load->driver('cache');
				
				if($CI->cache->$supported_cache->get('wallet_setting'))
				{
					return (object)$CI->cache->$supported_cache->get('wallet_setting');				
				}
				else
				{
					$query = $CI->db->get("wallet_setting");
					$CI->cache->$supported_cache->save('wallet_setting', $query->row(),CACHE_VALID_SEC);	
					return $query->row();						
				}
			
			}
			
			else
			{
				$query = $CI->db->get("wallet_setting");
				return $query->row();
			}
		}
		else
		{
			$query = $CI->db->get("wallet_setting");
			return $query->row();
		}
		//////////====end cache part
		
		
	
	}
	
	
	
	/**** get gateway details by id
	**
	***/
	
	function get_payment_gateway_details_by_id($gateway_id)
	{
		
		$CI =& get_instance();
		$query = $CI->db->get_where('payments_gateways',array('id'=>$gateway_id));
		
		if($query->num_rows()>0)
		{
			return $query->row();
		}
		
		return 0;
		
		
	}
	
	
	
	
	/*********detect email address from content
	** return email address array
	***/
	
	function get_emails ($str)
	{
		$emails = array();
		preg_match_all("/\b\w+\@\w+[\.\w+]+\b/", $str, $output);
		
		if(isset($output[0]))
		{
			foreach($output[0] as $email) 
			{
				array_push ($emails, strtolower($email));
			}
			
			if(count ($emails) >= 1) { return $emails; }
			else {  return false; }
		}
		else
		{
			return false;
		}
	}
	
	/*********detect bad words from content
	** return bad words array
	***/
	
	function BadWords($str)
	{
		   global $arrya;
		   
		   $str=strtolower($str);
		   $cleanstr = $str;
		   
		   $badwords=array();
		   
		   $charlist = array("|3"=>"b","13"=>"b","l3"=>"b","|)"=>"d","1)"=>"d","[)"=>"d","|("=>"k","1("=>"k","$"=>"s","("=>"c","1"=>"i","+"=>"t","|"=>"i","!"=>"i","#"=>"h","<"=>"c","@"=>"a","0"=>"o","{"=>"c","["=>"c");
		   
		   foreach($charlist as $char=>$value)
		   {
			 $cleanstr = strtolower(str_replace ($char, $value, $cleanstr));
		   }
		   
				   
		   
		   $badarray = $arrya;
		   
		   foreach ($badarray as $naughty) 
		   {
				   if (preg_match("/$naughty/", $str) or preg_match("/$naughty/", $cleanstr))
				   {
					  //return true;
					  $badwords[]=$naughty;
				   }
		   }
		   return array_unique($badwords);
		   //return false;
		   
   } // end of bad word
     
	 
	  /* $arrya=array("fuck",'fucking');
       $str="you will fuck by him ,do not smash with them fucking";
       $ret=BadWords($str);
       if(is_array($ret))
       {
       echo "Some bad words detected like..".implode(",",$ret);
       }*/
	   
	   

	function load_google_captcha()
	{
		$CI =& get_instance();
		$CI->load->library('simplecaptcha');
	
		$captcha = new SimpleCaptcha();
		
		// Change configuration...
		$captcha->wordsFile = base_path().'captcha/words/es.txt';
		$captcha->session_var = 'secretword';
		$captcha->imageFormat = 'png';
		$captcha->scale = 3; 
		$captcha->blur = true;
				
		return $captcha->CreateImage();		

	}
	
	/*** load captcha
	*  return captcha image
	**/
	
	
	function load_captcha()
	{
		$CI =& get_instance();
		$CI->load->helper('captcha');
			
		$vals = array(
	  
		'img_path'	 => './captcha/',
		'img_url'	 => base_url().'captcha/',
		'font_path'	 => base_path().'captcha/fonts/texb.ttf',
		'img_width'	 => '150',
		'img_height' => 30,
		'expiration' => 7200
		);
	
		$cap = create_captcha($vals);
		
		 if ( $cap ) {
		  $data = array(
			'captcha_id' => '',
			'captcha_time' => $cap['time'],
			'ip_address' => $_SERVER['REMOTE_ADDR'],
			'word' => $cap['word'] ,
			);
		  $query = $CI->db->insert_string( 'captcha', $data );
		  $CI->db->query($query );
		}else {
		  return "Umm captcha not work" ;
		}
		return $cap['image'] ;
	
	}
	
	/*** check captcha validation
	*  return boolen
	**/	
	
	function check_capthca()
    {
		$CI =& get_instance();
		// Delete old data ( 2hours)
		$expiration = time()-7200 ;
		$sql = " DELETE FROM ".$CI->db->dbprefix('captcha')." WHERE captcha_time < ? ";
		$binds = array($expiration);
		$query =$CI->db->query($sql, $binds);
	 
		//checking input
		$sql = "SELECT COUNT(*) AS count FROM  ".$CI->db->dbprefix('captcha')." WHERE word = ? AND ip_address = ? AND captcha_time > ?";
		$binds = array($_POST['captcha'], $_SERVER['REMOTE_ADDR'], $expiration);
		$query = $CI->db->query($sql, $binds);
		$row = $query->row();
	 
	  if ( $row -> count > 0 )
		{
		  return true;
		}
		return false;
	 
  }
  
  
  
  	/****  create seo friendly url 
	* var string $text
	**/ 	  
  
  	function clean_url($text) 
	{ 
	
		$text=strtolower($text); 
		$code_entities_match = array( '&quot;' ,'!' ,'@' ,'#' ,'$' ,'%' ,'^' ,'&' ,'*' ,'(' ,')' ,'+' ,'{' ,'}' ,'|' ,':' ,'"' ,'<' ,'>' ,'?' ,'[' ,']' ,'' ,';' ,"'" ,',' ,'.' ,'_' ,'/' ,'*' ,'+' ,'~' ,'`' ,'=' ,' ' ,'---' ,'--','--','’'); 
		$code_entities_replace = array('' ,'-' ,'-' ,'' ,'' ,'' ,'-' ,'-' ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'-' ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'-' ,'' ,'-' ,'-' ,'' ,'' ,'' ,'' ,'' ,'-' ,'-' ,'-','-'); 
		$text = str_replace($code_entities_match, $code_entities_replace, $text); 
		return $text; 
	} 

	
	
	
	/**
	 * check user favorite asker
	 * var user_id integer
	 * @return	boolen
	 */
	 
	 
	function check_user_favorite($user_id)
	{
		$CI =& get_instance();
		
		$query = $CI->db->get_where("user_favorite",array('my_user_id'=>get_authenticateUserID(),'favorite_user_id'=>$user_id));
		
		if($query->num_rows()>0)
		{
			return true;
		}
		
		return false;
			
	}
	
	
	/****get user profile name
	***
	***/
	
	function getUserProfileName()
	{
		$CI =& get_instance();
		
		$query = $CI->db->get_where("user",array('user_id'=>get_authenticateUserID()));
		
		$result=$query->row();
		
		return $result->profile_name;
		
	}
	
	
	/***** get all city list
	***
	**/
	
	function city_list()
	{
			
		$CI =& get_instance();
		
		
		$supported_cache=check_supported_cache_driver();
		
		if(isset($supported_cache))
		{
			if($supported_cache!='' && $supported_cache!='none')
			{
				////===load cache driver===
				$CI->load->driver('cache');
				
				if($CI->cache->$supported_cache->get('city_list'))
				{
					return (object)$CI->cache->$supported_cache->get('city_list');				
				}
				else
				{
					
					$CI->db->order_by('city_name','asc');
					$query = $CI->db->get_where("city",array('active'=>1));
					
					if($query->num_rows()>0)
					{
						 $CI->cache->$supported_cache->save('city_list', $query->result(),CACHE_VALID_SEC);	
						 return $query->result();
					}
					
					return 0;	
		
							
				}
			
			}
			
			else
			{
				$CI->db->order_by('city_name','asc');
				$query = $CI->db->get_where("city",array('active'=>1));
				
				if($query->num_rows()>0)
				{
					 return $query->result();
				}
				
				return 0;			
			}
			
		}
		else
		{
			$CI->db->order_by('city_name','asc');
			$query = $CI->db->get_where("city",array('active'=>1));
			
			if($query->num_rows()>0)
			{
				 return $query->result();
			}
			
			return 0;	
		}
		//////////====end cache part
		
				
		
		
		return 0;			
	}
	
	
	/*****  get  city name
	* var integer city_id
	**/
	
	function getCityName($city_id)
	{
		$CI =& get_instance();
		
		$supported_cache=check_supported_cache_driver();
		
		if(isset($supported_cache))
		{
			if($supported_cache!='' && $supported_cache!='none')
			{
				////===load cache driver===
				$CI->load->driver('cache');
				
				if($CI->cache->$supported_cache->get('city'.$city_id))
				{
					return $CI->cache->$supported_cache->get('city'.$city_id);				
				}
				else
				{
					$query = $CI->db->get_where("city",array('city_id'=>$city_id));
		
					if($query->num_rows()>0)
					{
						 $result= $query->row();
						 $CI->cache->$supported_cache->save('city'.$city_id, $result->city_name,CACHE_VALID_SEC);	
						 
						 return $result->city_name;
					}
					
					
					return 0;						
				}
			
			}
			
			else
			{
					$query = $CI->db->get_where("city",array('city_id'=>$city_id));
		
					if($query->num_rows()>0)
					{
						 $result= $query->row();						 
						 return $result->city_name;
					}
					
					
					return 0;
			}
		}
		else
		{
					$query = $CI->db->get_where("city",array('city_id'=>$city_id));
		
					if($query->num_rows()>0)
					{
						 $result= $query->row();						 
						 return $result->city_name;
					}
					
					
					return 0;
		}
		//////////====end cache part
		
		
		
		
		
		
		return 0;	
	}
	
	
	/*****  get city name
	* var integer city_id
	**/
	
	function getCurrentCity()
	{
		$CI =& get_instance();
		
		$query = $CI->db->get_where("user_profile",array('user_id'=>get_authenticateUserID()));
		
		if($query->num_rows()>0)
		{
			 $result= $query->row();
			 return $result->current_city;
		}
		
		return 0;	
	}
	
	
	/**** get total task in city
	*** return number of task
	****/
	
	function get_city_total_task($city_id)
	{		
		$CI =& get_instance();
		
		
		$user_status='visitor';
			
			if(check_user_authentication()) 
			{		
				$check_is_worker=$CI->db->get_where('worker',array('user_id'=>get_authenticateUserID(),'worker_status'=>1));
				
				if($check_is_worker->num_rows()>0)
				{
					$user_status='worker';
				}		
			}
			
			
			if($user_status=='worker')
			{	
			
			
		
		
			$query = $CI->db->query("select * from ".$CI->db->dbprefix('task')." tsk, ".$CI->db->dbprefix('city')." cty where tsk.task_city_id = cty.city_id and  tsk.task_status=1 and tsk.task_activity_status!=4 and tsk.task_city_id='".$city_id."'");
			
			}
			else
			{
			
					
						$query = $CI->db->query("select * from ".$CI->db->dbprefix('task')." tsk, ".$CI->db->dbprefix('city')." cty where tsk.task_city_id = cty.city_id and  tsk.task_status=1 and tsk.task_is_private=0 and tsk.task_activity_status!=4  and tsk.task_city_id='".$city_id."'");
						
						
			
			}
		
		
		
		
		if($query->num_rows()>0)
		{
			 return $query->num_rows();
		}
		
		return 0;
	
	}
	
	/**** get total task with city name
	*** return array of city name as a key and total task as a value
	****/
	
	function get_city_with_total_task()
	{		
		$CI =& get_instance();
		
		$user_status='visitor';		
		$task_private="";
		
		$temp=array();
			
			if(check_user_authentication()) 
			{		
				$check_is_worker=$CI->db->get_where('worker',array('user_id'=>get_authenticateUserID(),'worker_status'=>1));
				
				if($check_is_worker->num_rows()>0)
				{
					$user_status='worker';
				}		
			}
			
			
			if($user_status=='visitor')	{			
				$task_private=" and tsk.task_is_private=0 ";	
			}
		
		
		
		 $map_city=city_list();  
		 
		 if($map_city) {   
		 
		 	foreach($map_city as $city) { 
		 
		
		$query = $CI->db->query("select count(*) as total from ".$CI->db->dbprefix('task')." tsk, ".$CI->db->dbprefix('city')." cty where tsk.task_city_id = cty.city_id and  tsk.task_status=1 ".$task_private." and tsk.task_activity_status!=4  and tsk.task_city_id='".$city->city_id."'");
		
					if($query->num_rows()>0)
					{
						 $res=$query->row();
						 
						 if(isset($temp[$city->city_name])) {
							$temp[$city->city_name]= $temp[$city->city_name]+$res->total;
						}
						else
						{
							$temp[$city->city_name]= $res->total;
						}
						
					}			
		
			}
			
			if($temp)
			{
				$temp=array_filter($temp);
				arsort($temp);
			}
		}
		
		
		
				
		return $temp;
	
	}
	
	/**** get all category
	*** return array of category
	****/
	
	function get_all_category()
    {        
	   $CI =& get_instance();
	   
	   $supported_cache=check_supported_cache_driver();
		
		if(isset($supported_cache))
		{
			if($supported_cache!='' && $supported_cache!='none')
			{
				////===load cache driver===
				$CI->load->driver('cache');
				
				if($CI->cache->$supported_cache->get('getallcategory'))
				{
					return (object)$CI->cache->$supported_cache->get('getallcategory');				
				}
				else
				{
					$CI->db->order_by('category_name','asc');
				   $query = $CI->db->get_where("task_category",array('category_status'=>1));
				   
				   if($query->num_rows()>0)
				   {
						 $CI->cache->$supported_cache->save('getallcategory', $query->result(),CACHE_VALID_SEC);	
						 
						 return $query->result();
					}
					
					
					return 0;						
				}
			
			}
			
			else
			{
				  $CI->db->order_by('category_name','asc');
				   $query = $CI->db->get_where("task_category",array('category_status'=>1));
				   
				   if($query->num_rows()>0)
				   {
							return $query->result();
				   }
					
					
					return 0;
			}
		}
		else
		{
			   $CI->db->order_by('category_name','asc');
			   $query = $CI->db->get_where("task_category",array('category_status'=>1));
			   
			   if($query->num_rows()>0)
			   {
						return $query->result();
			   }
			
			
			return 0;
		}
		//////////====end cache part
		
		
	   
	   return 0;        
       
     }
	   
	   
	 /**** get all parent category
	*** return array of category
	****/
	  
	function get_category()
	{	
		$CI =& get_instance();
		
			
		 $supported_cache=check_supported_cache_driver();
		
		if(isset($supported_cache))
		{
			if($supported_cache!='' && $supported_cache!='none')
			{
				////===load cache driver===
				$CI->load->driver('cache');
				
				if($CI->cache->$supported_cache->get('getparentcategory'))
				{
					return (object)$CI->cache->$supported_cache->get('getparentcategory');				
				}
				else
				{
					 $query = $CI->db->get_where("task_category",array('category_status'=>1,'category_parent_id'=>0));
		
					if($query->num_rows()>0)
					{
						$CI->cache->$supported_cache->save('getparentcategory', $query->result(),CACHE_VALID_SEC);	
						 
						 return $query->result();
					}
					
					
					
					return 0;						
				}
			
			}
			
			else
			{
				   $query = $CI->db->get_where("task_category",array('category_status'=>1,'category_parent_id'=>0));
		
				if($query->num_rows()>0)
				{
					 return $query->result();
				}
					
					
					return 0;
			}
		}
		else
		{
			  $query = $CI->db->get_where("task_category",array('category_status'=>1,'category_parent_id'=>0));
		
				if($query->num_rows()>0)
				{
					 return $query->result();
				}
		
			
			
			return 0;
		}

		//////////====end cache part
	
		
		return 0;	
	
	}
	
	/**** get all sub category
	***  integer $pid (parent category id)
	*** return array of category
	****/
	
	/*function sub_category($pid)
	{
		$CI =& get_instance();
		
		 $supported_cache=check_supported_cache_driver();
		
		if(isset($supported_cache))
		{
			if($supported_cache!='' && $supported_cache!='none')
			{
				////===load cache driver===
				$CI->load->driver('cache');
				
				if($CI->cache->$supported_cache->get('getsubcategory'.$pid))
				{
					return (object)$CI->cache->$supported_cache->get('getsubcategory'.$pid);				
				}
				else
				{
					$query = $CI->db->get_where("task_category",array('category_parent_id'=>$pid));
		
					if($query->num_rows()>0)
					{
						$CI->cache->$supported_cache->save('getsubcategory'.$pid, $query->result(),CACHE_VALID_SEC);	
						 
						 return $query->result();
					}			
					
					
					return 0;						
				}
			
			}
			
			else
			{
				 $query = $CI->db->get_where("task_category",array('category_parent_id'=>$pid));
		
				if($query->num_rows()>0)
				{
					 return $query->result();
				}			
					
				return 0;
			}
		}
		else
		{
			  $query = $CI->db->get_where("task_category",array('category_parent_id'=>$pid));
		
				if($query->num_rows()>0)
				{
					 return $query->result();
				}
		
			    return 0;
		}

		//////////====end cache part
		
		
		return 0;	
	}*/
	function sub_category($pid)
	{
		$CI =& get_instance();
		
		

	  $query = $CI->db->get_where("task_category",array('category_parent_id'=>$pid));

		if($query->num_rows()>0)
		{
			 return $query->result();
		}
		
		
		return 0;	
	}
	
	
	
       
	  /***  get  duration between two dates
	  ** $date ( any date), $task_id (task id) 
	  *** compare date difference with task city timezone
       * return string ago
       **/
       function getDuration($date,$task_id='')
       {
            
			$CI =& get_instance();
			
		   $curdate = date('Y-m-d H:i:s');
			
			if($task_id!='' && $task_id>0)
			{ 
			 
				$CI->db->select('*');
				$CI->db->from('task');
				$CI->db->join('task_category','task.task_category_id=task_category.task_category_id');
				$CI->db->join('city','task.task_city_id=city.city_id');
				$CI->db->where('task.task_id',$task_id);
				$query=$CI->db->get();
				
				
				if($query->num_rows()>0)
				{
					$task_detail=  $query->row();
				}
				
				
				$city_detail=get_cityDetail($task_detail->task_city_id);
				
				if($city_detail)
				{	
					$dateTime = new DateTime("now", new DateTimeZone('America/Los_Angeles'));	 
					$task_timezone=tzOffsetToName($city_detail->city_timezone);			
					$dateTimeZone = new DateTimeZone($task_timezone);
					$dateTime->setTimezone($dateTimeZone); 
					$curdate= $dateTime->format("Y-m-d H:i:s");
					
				}
		
		}
		  
			   
			   
               $diff = abs(strtotime($date) - strtotime($curdate));
               $years = floor($diff / (365*60*60*24));
               $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
               $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
               $hours = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 )/ (60*60));
               $mins = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ (60));
               
               $ago = '';
               if($years != 0){ if($years > 1) {$ago =  $years.' years';} else { $ago =  $years.' year';}}
               elseif($months != 0){ if($months > 1) {$ago =  $months.' months';} else { $ago =  $months.' month';}}
               elseif($days != 0) { if($days > 1) {$ago =  $days.' days';} else { $ago =  $days.' day';}}
               elseif($hours != 0){ if($hours > 1) {$ago =  $hours.' hours';} else { $ago =  $hours.' hour';}}
               else{ if($mins > 1) {$ago =  $mins.' minutes';} else { $ago =  $mins.' minute';}}
               return $ago.' ago';
       }
	   
	   
	   
	 
	    /***  get  duration between two dates in reverse count
	  ** $start_date ( any date), $end_date (any date) 
       * return string of hours-minute-sec
       **/
	   
	   function getReverseDuration($start_date,$end_date)
	   {
	   
	   		$auto_complete_date=$end_date;
			$task_timezone_date=$start_date;
			
		   	$dateg=$auto_complete_date;
			$date1 = $auto_complete_date;
			$date2=$task_timezone_date;
			$diff = abs(strtotime($task_timezone_date) - strtotime($auto_complete_date));
			$test = floor($diff / (60*60*24));
			$str = '';
		
	
				
				$hours = 0;
				$minuts = 0;
				$dategg = $dateg;
			

				if(strtotime(date('Y-m-d H:i:s',strtotime($dateg))) > strtotime($task_timezone_date)) 
				{					
					
					//echo $date2;
					$diff2 = abs(strtotime($dategg) - strtotime($date2));
					$day1 = floor($diff2 / (60*60*24));
					
				
					$hours   = floor(($diff2 - $day1*60*60*24)/ (60*60));  
					$minuts  = floor(($diff2 - $day1*60*60*24 - $hours*60*60)/ 60); 
					$seconds = floor(($diff2 - $day1*60*60*24 - $hours*60*60 - $minuts*60)); 
					
					$str = $hours."-". $minuts."-".$seconds;
				}
				
				
			
				return $str;
	 
	 
	 }
	 
	 
	 
	 
	  /***  get  duration between two dates
	  ** $date ( any date), $task_id (task id) 
	  *** compare date difference with task city timezone
       * return string ago
       **/
	 
	    function getAutoDuration($date,$task_id='')
       {
            
			$CI =& get_instance();
			
		   $curdate = date('Y-m-d H:i:s');
			
			if($task_id!='' && $task_id>0)
			{ 
			 
				$CI->db->select('*');
				$CI->db->from('task');
				$CI->db->join('task_category','task.task_category_id=task_category.task_category_id');
				$CI->db->join('city','task.task_city_id=city.city_id');
				$CI->db->where('task.task_id',$task_id);
				$query=$CI->db->get();
				
				
				if($query->num_rows()>0)
				{
					$task_detail=  $query->row();
				}
				
				
				$city_detail=get_cityDetail($task_detail->task_city_id);
				
				if($city_detail)
				{	
					$dateTime = new DateTime("now", new DateTimeZone('America/Los_Angeles'));	 
					$task_timezone=tzOffsetToName($city_detail->city_timezone);			
					$dateTimeZone = new DateTimeZone($task_timezone);
					$dateTime->setTimezone($dateTimeZone); 
					$curdate= $dateTime->format("Y-m-d H:i:s");
					
				}
		
		}
		  
			   
			   
               $diff = abs(strtotime($date) - strtotime($curdate));
               $years = floor($diff / (365*60*60*24));
               $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
               $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
               $hours = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 )/ (60*60));
               $mins = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ (60));
               
               $ago = '';
               if($years != 0){ if($years > 1) {$ago =  $years.' years';} else { $ago =  $years.' year';}}
               elseif($months != 0){ if($months > 1) {$ago =  $months.' months';} else { $ago =  $months.' month';}}
               elseif($days != 0) { if($days > 1) {$ago =  $days.' days';} else { $ago =  $days.' day';}}
               elseif($hours != 0){ if($hours > 1) {$ago =  $hours.' hours';} else { $ago =  $hours.' hour';}}
               else{ if($mins > 1) {$ago =  $mins.' minutes';} else { $ago =  $mins.' minute';}}
               return $ago.' ago';
       }
	   
	 
	 
	   
	   
	   
	   
	   /***  get  city id
       * var integer cityname
       **/
       
       function getCityId($cityname)
       {
               $CI =& get_instance();
               
               $query = $CI->db->get_where("city",array('city_name'=>$cityname));
               
               if($query->num_rows()>0)
               {
                        $result= $query->row();
                        return $result->city_id;
               }
               
               return 0;        
       }
	   
	   
	   /*** get HomeLocation details
		* return single record array
		**/
		
		function getHomeLocation()
		{
			$CI =& get_instance();
			
			$query = $CI->db->get_where("user_location",array('user_id'=>get_authenticateUserID(),'is_home'=>1));
			
			if($query->num_rows()>0)
			{
				return $query->row();
			}
			
			return 0;
		}
		
		
		
		/**** get recent task
		* return array of task
		***/
		
		
		function recent_task()
		{
			
			$CI =& get_instance();
			
			$city_id=0;
			$city_cond='';
			
			if(get_authenticateUserID()!='')
			{
				$city_id = getCurrentCity();					
			}
			
			if($city_id>0)
			{
				$city_cond="and tk.task_city_id='".$city_id."'";
				
			}
				
				
				
				
			$user_status='visitor';
			
			if(check_user_authentication()) 
			{		
				$check_is_worker=$CI->db->get_where('worker',array('user_id'=>get_authenticateUserID(),'worker_status'=>1));
				
				if($check_is_worker->num_rows()>0)
				{
					$user_status='worker';
				}		
			}
			
			
			if($user_status=='worker')
			{	
		
			$query = $CI->db->query("select * from  ".$CI->db->dbprefix('task')." tk,  ".$CI->db->dbprefix('city')." ct,  ".$CI->db->dbprefix('user')." us,  ".$CI->db->dbprefix('user_profile')." up where tk.task_city_id=ct.city_id and tk.user_id=us.user_id and us.user_id=up.user_id and tk.task_status=1 and (tk.task_is_private=0 or tk.task_is_private=1) ".$city_cond." order by tk.task_id desc limit 12 offset 0");
			
			
			}
			 
			 else
			 {
			 	
				$query = $CI->db->query("select * from  ".$CI->db->dbprefix('task')." tk,  ".$CI->db->dbprefix('city')." ct,  ".$CI->db->dbprefix('user')." us,  ".$CI->db->dbprefix('user_profile')." up where tk.task_city_id=ct.city_id and tk.user_id=us.user_id and us.user_id=up.user_id and tk.task_status=1 and tk.task_is_private=0 ".$city_cond." order by tk.task_id desc limit 12 offset 0");
				
			 }
			 
			 
			 
			
			if($query->num_rows()>0)
			{
				return $query->result();
			}
			
			return 0;
			
			
		
		}
		
		
		/*****get top worker 
		* return array of runner
		***/
		
		function get_top_worker($limit)
		{
			
			$CI =& get_instance();
			
			$CI->db->select('*');
			$CI->db->from('worker');
			$CI->db->join('user','worker.user_id=user.user_id');
			$CI->db->join('user_profile','worker.user_id=user_profile.user_id');	
			$CI->db->where('worker.worker_app_approved',1);
		//	$CI->db->where('worker.worker_interview_approved',1);
			//$CI->db->where('worker.worker_background_approved',1);
			$CI->db->where('worker.worker_status',1);	
			$CI->db->order_by("worker.worker_level", "desc");
			$CI->db->limit($limit);
			
			$query = $CI->db->get();
			
			if($query->num_rows()>0)
			{		
				return $query->result();		
			}
			
			return 0;
			
	
		
	
	}
	
	
	
		
		/**** get city latitude and longitude
		* return single array of city detail
		***/
		function get_cityDetail($city_id)
		{
			$CI =& get_instance();
		
			$query = $CI->db->get_where("city",array('city_id'=>$city_id));
			
			if($query->num_rows()>0)
			{
				return $query->row();
			}
			
			return 0;	
		}
		
		
		/**** check login user is worker
		*return boolean
		***/
		
		function check_is_worker($user_id)
		{
			
			
			$CI =& get_instance();
		
			$query = $CI->db->get_where('worker',array('user_id'=>$user_id,'worker_status'=>1));
			
			if($query->num_rows()>0)
			{
				return true;
			}		
			
			return false;
			
		}
		
		
		/**** home page map task display
		* return array of task
		***/
		
		function home_map_tasklists()
		{
			
			$CI =& get_instance();
		
			
			
			$user_status='visitor';
			
			if(check_user_authentication()) 
			{		
				$check_is_worker=$CI->db->get_where('worker',array('user_id'=>get_authenticateUserID(),'worker_status'=>1));
				
				if($check_is_worker->num_rows()>0)
				{
					$user_status='worker';
				}		
			}
			
		
			
			$city_id=0;
			$city_cond='';
			
			if(get_authenticateUserID()!='')
			{
				$city_id = getCurrentCity();					
			}
			
			
			if($city_id>0)
			{			
				$city_cond=" and tk.task_city_id='".$city_id."'";				
			}
			
			
			if($user_status=='worker')
			{				
			$query = $CI->db->query("select * from  ".$CI->db->dbprefix('task')." tk,  ".$CI->db->dbprefix('user')." ur, ".$CI->db->dbprefix('user_profile')." up where tk.user_id = ur.user_id and ur.user_id = up.user_id and tk.task_status = 1  ".$city_cond." order by tk.task_id desc");
			}
			else
			{		
				$query = $CI->db->query("select * from  ".$CI->db->dbprefix('task')." tk,  ".$CI->db->dbprefix('user')." ur, ".$CI->db->dbprefix('user_profile')." up where tk.user_id = ur.user_id and ur.user_id = up.user_id and tk.task_status = 1 and tk.task_is_private=0  ".$city_cond." order by tk.task_id desc ");
			
			}	
			
			
			
			if($query->num_rows()>0)
			{
				return  $query->result();
			}
	
			return 0;
		
		}
			
		
		
		/*** get user task category wise rating
		** var int $user_id (user id), int $task_category_id (task category id)
		** return integer of total rating
		**/
		
		function get_user_total_category_task_rate($user_id,$worker_id,$task_category_id)
		{
			$CI =& get_instance();
			
			$CI->db->select('task_id');
			$CI->db->from('task');
			$CI->db->where('task_category_id',$task_category_id);
			$CI->db->where('task_worker_id',$worker_id);
			
			$get_task=$CI->db->get();
			
			if($get_task->num_rows()>0)
			{
				$result2=$get_task->result();
				
				$task_id='';
				
				
				foreach($result2 as $res)
				{
					$task_id.=$res->task_id.',';
				}
				
				if($task_id!='')
				{
					$im_task_id=substr($task_id,0,-1);
					
					
					///////======
					
					$CI->db->select('SUM(comment_rate) as total_rate,COUNT(*) as total_task');
					$CI->db->from('worker_comment');
					$CI->db->where('is_final',1);
					$CI->db->where('comment_to_user_id',$user_id);		
					$CI->db->where_in('task_id',$im_task_id);		
					$query=$CI->db->get();
					
					if($query->num_rows()>0)
					{
						$result= $query->row();
						
						$total_div=0;
						
						if($result->total_task>0)
						{
							$total_div=number_format($result->total_rate/$result->total_task,2);
						}
						
						return $total_div;
						
					}
					return 0;
						
						////=====
							
							
							
						}
						
				
				return 0;
							
			}
			
			return 0;
			
		}
		
		
		
			
		/*** get user rating
		*** return integer of total rating
		***/
			
		function get_user_rating($user_id)
		{
			$CI =& get_instance();
			
			$query=$CI->db->query("select SUM(comment_rate) as total_rate, count(*) as total from   ".$CI->db->dbprefix('worker_comment')." where  comment_to_user_id='".$user_id."' and  comment_rate > 0");
			
			if($query->num_rows()>0)
			{
				$result=$query->row();
					
				$total_rate=0;
				
				if($result->total>0)
				{		
					$total_rate= $result->total_rate / $result->total;
				}
				
				
				if($total_rate >=5)
				{
					$total_rate=100;
				}
				
				
				return $total_rate;
				
				
			}
			
			
			return 0;
		
		}
		
		
	/**** get user profile complete %
	* return double 
	***/
	function user_profile_complete()
	{
				
		$total=0;
		
		$CI =& get_instance();
		
		$get_user_detail = $CI->db->query("select * from  ".$CI->db->dbprefix('user')." usr,  ".$CI->db->dbprefix('user_profile')." pr where usr.user_id=pr.user_id and usr.user_id='".get_authenticateUserID()."'");		
		$user_detail=$get_user_detail->row();	
		
		
		if($user_detail->email!='' &&  	$user_detail->first_name!='' && $user_detail->last_name!='')
		{
			$total=$total+45;
		}
		else
		{
			if($user_detail->email!='')
			{
				$total=$total+25;
			}
			
			if($user_detail->first_name!='')
			{
				$total=$total+10;
			}
			
			if($user_detail->last_name!='')
			{
				$total=$total+10;
			}
			
		}
		
		
		if($user_detail->about_user!='')
		{
			$total=$total+10;
		}
		
		
		if($user_detail->current_city>0)
		{
			$total=$total+10;
		}
		
		
		if($user_detail->profile_image!='')
		{
			$total=$total+10;
		}
		
		
		if($user_detail->mobile_no!='' || $user_detail->phone_no!='')
		{
			$total=$total+10;
		}
			
		
		//////////====social check	
		
		
		if($user_detail->facebook_link!='')
		{
			$total=$total+1;
		}
		
		if($user_detail->twitter_link!='')
		{
			$total=$total+1;
		}
		
		if($user_detail->own_site_link!='')
		{
			$total=$total+1;
		}
		
		if($user_detail->blog_link!='')
		{
			$total=$total+1;
		}
		
		
		
		if($user_detail->linkedin_link!='' || $user_detail->youtube_link!='' || $user_detail->yelp_link!='')
		{
			$total=$total+1;
		}		
				
				
		////////////===check portfolio===
		
		$get_user_portfolio = $CI->db->query("select * from  ".$CI->db->dbprefix('user_portfolio')." where user_id='".get_authenticateUserID()."'");	
		
			
		if($get_user_portfolio->num_rows()>0)
		{
			$total=$total+10;
		}
				
				
			return $total;	
				
	}	
	
	
	
	
	/****** get user current wallet amount
	*** return double 
	***/
	
	function my_wallet_amount()
	{
	
	  	 $CI =& get_instance();
		 
			 $query = $CI->db->query("SELECT SUM(debit) as sumd,SUM(credit) as sumc FROM  ".$CI->db->dbprefix('wallet')." where admin_status='Confirm' and user_id='".get_authenticateUserID()."'"); 
	 
	 
	 		if($query->num_rows()>0)
			{
			
				 $result = $query->row();
			
				 $debit=$result->sumd;
				 $credit=$result->sumc;
				
				 $total=$debit-$credit;
				
				return $total;
			
			}
			
			return 0;
		
	}
	
	
	/**** check task poster have pay amount for his task before work start task
	* var integer $task_id (task id). integer $user_id (task poster user id)
	* return array
	***/
	
	function check_task_assign_amount_pay($user_id,$task_id)
	{
		
		$CI =& get_instance();
		 
		$query = $CI->db->get_where('transaction',array('user_id'=>$user_id,'task_id'=>$task_id));
		
		if($query->num_rows()>0)
		{
			return $query->row();
		}
		
		return 0;
	}
	
	
	
	/**** get user sign up complete %
	* return integer
	***/
	
	function user_profile_sign_up_complete()
	{
				
		$total=0;
		
		$CI =& get_instance();
		
		$get_user_detail = $CI->db->query("select * from  ".$CI->db->dbprefix('user')." usr,  ".$CI->db->dbprefix('user_profile')." pr where usr.user_id=pr.user_id and usr.user_id='".get_authenticateUserID()."'");		
		$user_detail=$get_user_detail->row();	
		
		
		if($user_detail->email!='' &&  	$user_detail->first_name!='' && $user_detail->last_name!='')
		{
			$total=17;
		}
		else
		{
			if($user_detail->email!='')
			{
				$total=10;
			}
			
			if($user_detail->first_name!='')
			{
				$total=4;
			}
			
			if($user_detail->last_name!='')
			{
				$total=3;
			}
			
		}
		
		
	
				
			return $total;	
				
	}	
	
	/**** get user pick city %
	* return integer
	***/
	
	function user_profile_pick_city_complete()
	{
				
		$total=0;
		
		$CI =& get_instance();
		
		$get_user_detail = $CI->db->query("select * from  ".$CI->db->dbprefix('user')." usr,  ".$CI->db->dbprefix('user_profile')." pr where usr.user_id=pr.user_id and usr.user_id='".get_authenticateUserID()."'");		
		$user_detail=$get_user_detail->row();	
	
		
		if($user_detail->current_city>0)
		{
			$total=20;
		}
		
				
			return $total;	
				
	}	
	
	/**** get user mobile or phone %
	* return integer
	***/
	
	function user_profile_mobile_complete()
	{
				
		$total=0;
		
		$CI =& get_instance();
		
		$get_user_detail = $CI->db->query("select * from  ".$CI->db->dbprefix('user')." usr,  ".$CI->db->dbprefix('user_profile')." pr where usr.user_id=pr.user_id and usr.user_id='".get_authenticateUserID()."'");		
		$user_detail=$get_user_detail->row();	
		
	
		
		
		if($user_detail->mobile_no!='' || $user_detail->phone_no!='')
		{
			$total=21;
		}
			
	
			return $total;	
				
	}	
	
	/**** get user profile photo %
	* return integer
	***/
	function user_profile_photo_complete()
	{
				
		$total=0;
		
		$CI =& get_instance();
		
		$get_user_detail = $CI->db->query("select * from  ".$CI->db->dbprefix('user')." usr,  ".$CI->db->dbprefix('user_profile')." pr where usr.user_id=pr.user_id and usr.user_id='".get_authenticateUserID()."'");		
		$user_detail=$get_user_detail->row();	
		
		
		
		if($user_detail->profile_image!='')
		{
			$total=21;
		}
						
			return $total;	
				
	}	
	
	/**** get user profile complete %
	* return integer
	***/
	function user_profile_info_complete()
	{
				
		$total=0;
		
		$CI =& get_instance();
		
		$get_user_detail = $CI->db->query("select * from  ".$CI->db->dbprefix('user')." usr,  ".$CI->db->dbprefix('user_profile')." pr where usr.user_id=pr.user_id and usr.user_id='".get_authenticateUserID()."'");		
		$user_detail=$get_user_detail->row();	
		
		
		
		
		
		if($user_detail->about_user!='')
		{
			$total=$total+10;
		}
		
		
	
		
	
		
		//////////====social check	
		
		
		if($user_detail->facebook_link!='')
		{
			$total=$total+1;
		}
		
		if($user_detail->twitter_link!='')
		{
			$total=$total+1;
		}
		
		if($user_detail->own_site_link!='')
		{
			$total=$total+1;
		}
		
		if($user_detail->blog_link!='')
		{
			$total=$total+1;
		}
		
		
		
		if($user_detail->linkedin_link!='' || $user_detail->youtube_link!='' || $user_detail->yelp_link!='')
		{
			$total=$total+1;
		}		
				
				
		////////////===check portfolio===
		
		$get_user_portfolio = $CI->db->query("select * from  ".$CI->db->dbprefix('user_portfolio')." where user_id='".get_authenticateUserID()."'");	
		
			
		if($get_user_portfolio->num_rows()>0)
		{
			$total=$total+6;
		}
				
				
			return $total;	
				
	}	
	
	
	
	/****  get user total review
	*	var integer total
	***/
	
	function get_user_total_review($user_id)
	{
		$CI =& get_instance();
		
		$CI->db->select('*');
		$CI->db->from('worker_comment');
		$CI->db->where('is_final',1);
		$CI->db->where('comment_to_user_id',$user_id);		
		$query=$CI->db->get();
		
		return $query->num_rows();
		
	}
	
	
	/****  get user total rate
	*	var integer total
	***/
	
	function get_user_total_rate($user_id)
	{
		$CI =& get_instance();
		
		$CI->db->select('SUM(comment_rate) as total_rate,COUNT(*) as total_task');
		$CI->db->from('worker_comment');
		$CI->db->where('is_final',1);
		$CI->db->where('comment_to_user_id',$user_id);		
		$query=$CI->db->get();
		
		if($query->num_rows()>0)
		{
			$result= $query->row();
			
			$total_div=0;
			
			if($result->total_task>0)
			{
				$total_div=number_format($result->total_rate/$result->total_task,2);
			}
			
			return $total_div;
			
		}
		return 0;
		
	}
	
	
	
	
	
	/*** load user notification setting
	*  return single record array
	**/
	
	function notification_setting($user_id)
	{		
		$CI =& get_instance();
		$query = $CI->db->get_where("user_notification", array('user_id'=>$user_id));
		return $query->row();
	
	}

	
	
	/***  check worker bid on the task
	** var integer $task_id
	** return boolean
	***/
	
	function check_worker_bid_on_task($task_id)
	{
		$CI =& get_instance();
		$query = $CI->db->get_where("worker_comment", array('task_id'=>$task_id,'offer_amount >'=>0,'comment_post_user_id !='=>get_authenticateUserID(),'is_public'=>0));
		
		if($query->num_rows()>0)
		{
			return true;	
		}
		
		return false;
	}
	
	
	/*** get unread notification 
	**	return integer
	***/
	
	function get_user_unread_notification()
	{
		$CI =& get_instance();
		$query = $CI->db->get_where("message",array("receiver_user_id"=>get_authenticateUserID(),'is_read'=>0));
		
		if($query->num_rows()>0)
		{
			return $query->num_rows();	
		}
		
		return 0;
		
	}
		
		
	/*** get Transportation details
	return single array
	**/
	function get_transportation_detail($transportation_id)
	{
		$CI =& get_instance();
		$query = $CI->db->get_where("transportation",array('transportation_id'=>$transportation_id));
		
		if($query->num_rows()>0)
		{
			return $query->row();	
		}
		return 0;
		
	}
	
	/*** get Device details
	return single array
	**/
	function get_device_detail($device_id)
	{	
		$CI =& get_instance();
		$query = $CI->db->get_where("device",array('device_id'=>$device_id));
		
		if($query->num_rows()>0)
		{
			return $query->row();	
		}
		return 0;	
	}
		
	
	/********offset to timezone
	***  var $offset
	** return string timezone name
	***/
	
	function tzOffsetToName($offset, $isDst = null)
    {
        if ($isDst === null)
        {
            $isDst = date('I');
        }

        $offset *= 3600;
        $zone    = timezone_name_from_abbr('', $offset, $isDst);

        if ($zone === false)
        {
            foreach (timezone_abbreviations_list() as $abbr)
            {
                foreach ($abbr as $city)
                {
                    if ((bool)$city['dst'] === (bool)$isDst &&
                        strlen($city['timezone_id']) > 0    &&
                        $city['offset'] == $offset)
                    {
                        $zone = $city['timezone_id'];
                        break;
                    }
                }

                if ($zone !== false)
                {
                    break;
                }
            }
        }
    
        return $zone;
    }
	
	
	/********get withrawal user last withdraw type details
	** integer uid (user id), $type (bank, check, gateway)
	** return array
	***/
	
	function get_detail($uid='',$type)
	{
	  $CI =& get_instance();
	  if($type=="bank")
	  {
	    $query=$CI->db->query("SELECT * FROM trc_wallet_bank b,trc_wallet_withdraw w WHERE b.withdraw_id = w.withdraw_id AND w.user_id = '$uid' AND b.bank_withdraw_type='bank' ORDER BY b.bank_id DESC LIMIT 0 , 1");
		}
	  if($type=="gateway")
		{
		   $query=$CI->db->query("SELECT * FROM trc_wallet_withdraw_gateway b, trc_wallet_withdraw w WHERE b.withdraw_id = w.withdraw_id AND w.user_id = '$uid' ORDER BY b.gateway_withdraw_id desc LIMIT 0 , 1");
		}
	  if($type=="check")
	  {
	       $query=$CI->db->query("SELECT * FROM trc_wallet_bank b, trc_wallet_withdraw w WHERE b.withdraw_id = w.withdraw_id AND w.user_id = '$uid' AND b.bank_withdraw_type='check' ORDER BY b.bank_id desc LIMIT 0 , 1");
	  }
	  
	    if($query->num_rows()>0)
		{
			return $query->row();
		}
		
		return 0;
	}
	
	/********get task location for map
	** integer task_id
	** return string
	***/
	
	function get_map_task_location($task_id)
	{	
		
		 $CI =& get_instance();
		
		$location = '';
		 
		$CI->db->order_by('task_location_id','asc');
		$sql=$CI->db->get_where("task_location",array('task_id'=>$task_id),1);
			
			
		if($sql->num_rows()>0)
		{
			$rowSelect=$sql->row();
				
							
				if($rowSelect->location_address != '')
				{
					$location = $rowSelect->location_address.','.$rowSelect->location_city.','.$rowSelect->location_state;
				} 
						
				else 
				{
					
					
					 $CI->db->order_by('user_location_id','asc');
					 $sql2=$CI->db->get_where("user_location",array('user_location_id'=>$rowSelect->user_location_id),1);
		
									
						if($sql2->num_rows()>0)
						{
							$rowSelect2=$sql2->row();
							$location = $rowSelect2->location_name.','.$rowSelect2->location_city.','.$rowSelect2->location_state;
							
						}
				}
						
		
		} 	
			
		
		return $location;	
	
	}
		
/* End of file custom_helper.php */
/* Location: ./system/application/helpers/custom_helper.php */

?>