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
		$query = $CI->db->get_where("template_manager",array('active_template'=>1 ,'is_admin_template'=>1));
		$row = $query->row();
		
		$theme_name=trim($row->template_name);
		
		if(is_dir(APPPATH.'views/'.$theme_name))
		{
			return $theme_name;
		}
		else
		{
			return $default_theme_name;	
		}
		
	}
	
		
	
	// --------------------------------------------------------------------

	/**
	 * Check user login
	 *
	 * @return	boolen
	 */
	function check_admin_authentication()
	{		
		$CI =& get_instance();
		
			if($CI->session->userdata('admin_id')!='')
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
	
	
	/***** get last admin login detail
	**
	***/
	
	function get_last_admin_login_detail()
	{
		$CI =& get_instance();
		
		$CI->db->select('adl.*,ad.username,ad.email,ad.admin_type');
		$CI->db->from('admin_login adl');
		$CI->db->join('admin ad','adl.admin_id=ad.admin_id','left');
		$CI->db->order_by('adl.login_id','desc');
		$CI->db->limit(1);
		
		$query=$CI->db->get();
		
		if($query->num_rows()>0)
		{
			$res=$query->row();
			
			return $res->login_ip.'('.date('d M, Y h:i:s A',strtotime($res->login_date)).')';
		}
	
		return $_SERVER['REMOTE_ADDR'].'('.date('d M, Y h:i:s A').')';
		
	}
	
	
	/*** get total task
	*
	**/
	
	function get_total_task()
	{
		
		$CI =& get_instance();
		
		$CI->db->select('*');
		$CI->db->from('task');
		$CI->db->where_in('task_status','1','2');
		
		$query=$CI->db->get();
		
		if($query->num_rows()>0)
		{
			return $query->num_rows();
		}
		
		return 0;
	
	}
	
	
	/*** get total user
	*
	**/
	
	function get_total_user()
	{
		$CI =& get_instance();
		
		$CI->db->select('*');
		$CI->db->from('user');
		
		$query=$CI->db->get();
		
		if($query->num_rows()>0)
		{
			return $query->num_rows();
		}
		
		return 0;
	}
	
	
	
	/*** get total worker
	*
	**/
	
	function get_total_worker()
	{
		$CI =& get_instance();
		
		$CI->db->select('*');
		$CI->db->from('user');
		$CI->db->join('worker','user.user_id=worker.user_id');
		$CI->db->where('worker_status',1);
		$CI->db->where('worker_app_approved',1);
		
		$query=$CI->db->get();
		
		if($query->num_rows()>0)
		{
			return $query->num_rows();
		}
		
		return 0;
	}
	
	
	/**** current login user
	**
	***/
	
	function get_current_login_user()
	{
		
		$CI =& get_instance();
		
		$CI->db->select('*');
		$CI->db->from('user_login');
		$CI->db->where('DATE(login_date_time)',date('Y-m-d'));
		$CI->db->where('login_status',1);
		
		$query=$CI->db->get();
		
		
		
		if($query->num_rows()>0)
		{
			return $query->num_rows();
		}
		
		return 0;
	
	}
	
	
	/*** daily login user
	**
	**/
	
	function get_daily_login_user()
	{	
		$CI =& get_instance();
		
		$CI->db->select('*');
		$CI->db->from('user_login');
		$CI->db->join('user','user_login.user_id=user.user_id','left');
		$CI->db->where('DATE(login_date_time)',date('Y-m-d'));	
		
		$query=$CI->db->get();
		
		if($query->num_rows()>0)
		{
			return $query->num_rows();
		}
		
		return 0;
		
	}
	
	
	/*** get total number of city
	**
	**/
	
	function get_total_city()
	{
		$CI =& get_instance();
		
		$CI->db->select('*');
		$CI->db->from('city');
		
		$query=$CI->db->get();
		
		if($query->num_rows()>0)
		{
			return $query->num_rows();
		}
		
		return 0;
	}
	
	
	/*** get total number of state
	**
	**/
	
	function get_total_state()
	{
		$CI =& get_instance();
		
		$CI->db->select('*');
		$CI->db->from('state');
		
		$query=$CI->db->get();
		
		if($query->num_rows()>0)
		{
			return $query->num_rows();
		}
		
		return 0;
	}
	
	
	/*** get total number of country
	**
	**/
	
	function get_total_country()
	{
		$CI =& get_instance();
		
		$CI->db->select('*');
		$CI->db->from('country');
		
		$query=$CI->db->get();
		
		if($query->num_rows()>0)
		{
			return $query->num_rows();
		}
		
		return 0;
	}
	
	
	
	/*** get total earning by posting task
	**
	**/
	
	function get_total_earning_post_task()
	{
		$CI =& get_instance();
		
		$CI->db->select('SUM(total_cut_price) as fees');
		$CI->db->from('wallet');
		$CI->db->where('credit >',0);
		$CI->db->where('credit !=',0);
		$CI->db->where('total_cut_price >',0);
		$CI->db->where('task_id !=',0);
		
		$query=$CI->db->get();
		
		if($query->num_rows()>0)
		{
			$res=$query->row();
			
			if($res->fees>0)
			{
				return $res->fees;
			}
			
			return 0.00;
		}
		
		return 0.00;
		
	}
	
	
	/*** get total earning by runner pay
	** when runner complete task at that time admn cut the fees
	** from total task price
	**/
	
	function get_total_earning_runner_pay()
	{
		$CI =& get_instance();
		
		$CI->db->select('SUM(total_cut_price) as fees');
		$CI->db->from('wallet');
		$CI->db->where('debit >',0);
		$CI->db->where('debit !=',0);
		$CI->db->where('total_cut_price >',0);
		$CI->db->where('task_id !=',0);
		
		$query=$CI->db->get();
		
		if($query->num_rows()>0)
		{
			$res=$query->row();
			
			if($res->fees>0)
			{
				return $res->fees;
			}
			
			return 0.00;
		}
		
		return 0.00;
		
	}
	
	
	
	/*** get total escrow amount
	**
	**/
	
	function get_total_escrow_pay()
	{
		$CI =& get_instance();
		
		$CI->db->select('SUM(credit) as fees');
		$CI->db->from('wallet');
		$CI->db->where('credit >',0);
		$CI->db->where('debit =',0);
		$CI->db->where('task_id !=',0);
		
		$query=$CI->db->get();
			
		if($query->num_rows()>0)
		{
			$res=$query->row();
			
			if($res->fees>0)
			{
				return $res->fees;
			}
			
			return 0.00;
		}
		
		return 0.00;	
	}
	
	/*** get total runner pay
	**
	**/
	
	function get_total_runner_pay()
	{
		$CI =& get_instance();
		
		$CI->db->select('SUM(debit) as fees');
		$CI->db->from('wallet');
		$CI->db->where('debit >',0);
		$CI->db->where('credit =',0);
		$CI->db->where('task_id !=',0);
		
		$query=$CI->db->get();
			
		if($query->num_rows()>0)
		{
			$res=$query->row();
			
			if($res->fees>0)
			{
				return $res->fees;
			}
			
			return 0.00;
		}
		
			return 0.00;	
	}
	
	
	
	/*****************************************dashboard report*************************/
	
	//////====daily===
	
	function get_daily_earning_on_post_task()
	{		
		
		$CI =& get_instance();
		
		$CI->db->select('SUM(total_cut_price) as fees');
		$CI->db->from('wallet');
		$CI->db->where('credit >',0);
		$CI->db->where('credit !=',0);
		$CI->db->where('total_cut_price >',0);
		$CI->db->where('task_id !=',0);
		$CI->db->where('DATE(wallet_date)',date('Y-m-d'));
		
		$query=$CI->db->get();
		
		if($query->num_rows()>0)
		{
			$res=$query->row();
			
			if($res->fees>0)
			{
				return $res->fees;
			}
			
			return 0.00;
		}
		
		return 0.00;
		
		
	}
	
	
	function get_daily_earning_on_runner_pay()
	{
		
		$CI =& get_instance();
		
		$CI->db->select('SUM(total_cut_price) as fees');
		$CI->db->from('wallet');
		$CI->db->where('debit >',0);
		$CI->db->where('debit !=',0);
		$CI->db->where('total_cut_price >',0);
		$CI->db->where('task_id !=',0);
		$CI->db->where('DATE(wallet_date)',date('Y-m-d'));
		
		$query=$CI->db->get();
		
		if($query->num_rows()>0)
		{
			$res=$query->row();
			
			if($res->fees>0)
			{
				return $res->fees;
			}
			
			return 0.00;
		}
		
		return 0.00;
		
	
	}
	
	
	
	//////====weekly===
	
	function get_weekly_earning_on_post_task()
	{		
		
		$CI =& get_instance();
		
		
		$date=date('Y-m-d');
		
		$first_date= get_first_day_of_week($date);
		$last_date= get_last_day_of_week($date);
		
		
		$CI->db->select('SUM(total_cut_price) as fees');
		$CI->db->from('wallet');
		$CI->db->where('credit >',0);
		$CI->db->where('credit !=',0);
		$CI->db->where('total_cut_price >',0);
		$CI->db->where('task_id !=',0);
		$CI->db->where('DATE(wallet_date) >=',$first_date);
		$CI->db->where('DATE(wallet_date) <=',$last_date);
		
		$query=$CI->db->get();
		
		if($query->num_rows()>0)
		{
			$res=$query->row();
			
			if($res->fees>0)
			{
				return $res->fees;
			}
			
			return 0.00;
		}
		
		return 0.00;
		
		
	}
	
	
	function get_weekly_earning_on_runner_pay()
	{
		
		$CI =& get_instance();
		
		$date=date('Y-m-d');
		
		$first_date= get_first_day_of_week($date);
		$last_date= get_last_day_of_week($date);
		
		
		$CI->db->select('SUM(total_cut_price) as fees');
		$CI->db->from('wallet');
		$CI->db->where('debit >',0);
		$CI->db->where('debit !=',0);
		$CI->db->where('total_cut_price >',0);
		$CI->db->where('task_id !=',0);
		$CI->db->where('DATE(wallet_date) >=',$first_date);
		$CI->db->where('DATE(wallet_date) <=',$last_date);
		
		$query=$CI->db->get();
		
		if($query->num_rows()>0)
		{
			$res=$query->row();
			
			if($res->fees>0)
			{
				return $res->fees;
			}
			
			return 0.00;
		}
		
		return 0.00;
		
	
	}
	
	
	
	//////====monthly===
	
	function get_monthly_earning_on_post_task()
	{		
		
		$CI =& get_instance();
		
		$CI->db->select('SUM(total_cut_price) as fees');
		$CI->db->from('wallet');
		$CI->db->where('credit >',0);
		$CI->db->where('credit !=',0);
		$CI->db->where('total_cut_price >',0);
		$CI->db->where('task_id !=',0);
		$CI->db->where('MONTH(wallet_date)',date('m'));
		$CI->db->where('YEAR(wallet_date) ',date('Y'));
		
		$query=$CI->db->get();
		
		if($query->num_rows()>0)
		{
			$res=$query->row();
			
			if($res->fees>0)
			{
				return $res->fees;
			}
			
			return 0.00;
		}
		
		return 0.00;
		
		
	}
	
	
	function get_monthly_earning_on_runner_pay()
	{
		
		$CI =& get_instance();
		
		$CI->db->select('SUM(total_cut_price) as fees');
		$CI->db->from('wallet');
		$CI->db->where('debit >',0);
		$CI->db->where('debit !=',0);
		$CI->db->where('total_cut_price >',0);
		$CI->db->where('task_id !=',0);
		$CI->db->where('MONTH(wallet_date)',date('m'));
		$CI->db->where('YEAR(wallet_date) ',date('Y'));
		
		$query=$CI->db->get();
		
		if($query->num_rows()>0)
		{
			$res=$query->row();
			
			if($res->fees>0)
			{
				return $res->fees;
			}
			
			return 0.00;
		}
		
		return 0.00;
		
	
	}
	
	
	//////====yearly===
	
	function get_yearly_earning_on_post_task()
	{		
		
		$CI =& get_instance();
		
		$CI->db->select('SUM(total_cut_price) as fees');
		$CI->db->from('wallet');
		$CI->db->where('credit >',0);
		$CI->db->where('credit !=',0);
		$CI->db->where('total_cut_price >',0);
		$CI->db->where('task_id !=',0);
		$CI->db->where('YEAR(wallet_date)',date('Y'));
		
		$query=$CI->db->get();
		
		if($query->num_rows()>0)
		{
			$res=$query->row();
			
			if($res->fees>0)
			{
				return $res->fees;
			}
			
			return 0.00;
		}
		
		return 0.00;
		
		
	}
	
	
	function get_yearly_earning_on_runner_pay()
	{
		
		$CI =& get_instance();
		
		$CI->db->select('SUM(total_cut_price) as fees');
		$CI->db->from('wallet');
		$CI->db->where('debit >',0);
		$CI->db->where('debit !=',0);
		$CI->db->where('total_cut_price >',0);
		$CI->db->where('task_id !=',0);
		$CI->db->where('YEAR(wallet_date)',date('Y'));
		
		$query=$CI->db->get();
		
		if($query->num_rows()>0)
		{
			$res=$query->row();
			
			if($res->fees>0)
			{
				return $res->fees;
			}
			
			return 0.00;
		}
		
		return 0.00;
		
	
	}
	
	
	
	/**************************************escrow calculation ************************/
	
	function get_daily_escrow_pay()
	{
		$CI =& get_instance();
		
		$CI->db->select('SUM(credit) as fees');
		$CI->db->from('wallet');
		$CI->db->where('credit >',0);
		$CI->db->where('debit =',0);
		$CI->db->where('task_id !=',0);
		$CI->db->where('DATE(wallet_date)',date('Y-m-d'));
		
		$query=$CI->db->get();
			
		if($query->num_rows()>0)
		{
			$res=$query->row();
			
			if($res->fees>0)
			{
				return $res->fees;
			}
			
			return 0.00;
		}
		
		return 0.00;	
	}
	
	function get_weekly_escrow_pay()
	{
		$CI =& get_instance();
		
		$date=date('Y-m-d');
		
		$first_date= get_first_day_of_week($date);
		$last_date= get_last_day_of_week($date);
		
		$CI->db->select('SUM(credit) as fees');
		$CI->db->from('wallet');
		$CI->db->where('credit >',0);
		$CI->db->where('debit =',0);
		$CI->db->where('task_id !=',0);
		$CI->db->where('DATE(wallet_date) >=',$first_date);
		$CI->db->where('DATE(wallet_date) <=',$last_date);
		
		$query=$CI->db->get();
			
		if($query->num_rows()>0)
		{
			$res=$query->row();
			
			if($res->fees>0)
			{
				return $res->fees;
			}
			
			return 0.00;
		}
		
		return 0.00;	
	}
	
	function get_monthly_escrow_pay()
	{
		$CI =& get_instance();
		
		$CI->db->select('SUM(credit) as fees');
		$CI->db->from('wallet');
		$CI->db->where('credit >',0);
		$CI->db->where('debit =',0);
		$CI->db->where('task_id !=',0);
		$CI->db->where('MONTH(wallet_date)',date('m'));
		$CI->db->where('YEAR(wallet_date) ',date('Y'));
		
		$query=$CI->db->get();
		
		if($query->num_rows()>0)
		{
			$res=$query->row();
			
			if($res->fees>0)
			{
				return $res->fees;
			}
			
			return 0.00;
		}
		
		return 0.00;	
	}
	
	function get_yearly_escrow_pay()
	{
		$CI =& get_instance();
		
		$CI->db->select('SUM(credit) as fees');
		$CI->db->from('wallet');
		$CI->db->where('credit >',0);
		$CI->db->where('debit =',0);
		$CI->db->where('task_id !=',0);
		$CI->db->where('YEAR(wallet_date)',date('Y'));
		
		$query=$CI->db->get();
			
		
		if($query->num_rows()>0)
		{
			$res=$query->row();
			
			if($res->fees>0)
			{
				return $res->fees;
			}
			
			return 0.00;
		}
		
		return 0.00;	
	}
	
	
	/**************************************runner calculation ************************/
	
	
	function get_daily_runner_pay()
	{
		$CI =& get_instance();
		
		$CI->db->select('SUM(debit) as fees');
		$CI->db->from('wallet');
		$CI->db->where('debit >',0);
		$CI->db->where('credit =',0);
		$CI->db->where('task_id !=',0);
		$CI->db->where('DATE(wallet_date)',date('Y-m-d'));
		
		$query=$CI->db->get();
			
		if($query->num_rows()>0)
		{
			$res=$query->row();
			
			if($res->fees>0)
			{
				return $res->fees;
			}
			
			return 0.00;
		}
		
			return 0.00;	
	}
	
	
	function get_weekly_runner_pay()
	{
		$CI =& get_instance();
		
		
		$date=date('Y-m-d');
		
		$first_date= get_first_day_of_week($date);
		$last_date= get_last_day_of_week($date);
		
		
		
		$CI->db->select('SUM(debit) as fees');
		$CI->db->from('wallet');
		$CI->db->where('debit >',0);
		$CI->db->where('credit =',0);
		$CI->db->where('task_id !=',0);
		$CI->db->where('DATE(wallet_date) >=',$first_date);
		$CI->db->where('DATE(wallet_date) <=',$last_date);
		
		$query=$CI->db->get();
			
		if($query->num_rows()>0)
		{
			$res=$query->row();
			
			if($res->fees>0)
			{
				return $res->fees;
			}
			
			return 0.00;
		}
		
			return 0.00;	
	}
	
	
	function get_monthly_runner_pay()
	{
		$CI =& get_instance();
		
		$CI->db->select('SUM(debit) as fees');
		$CI->db->from('wallet');
		$CI->db->where('debit >',0);
		$CI->db->where('credit =',0);
		$CI->db->where('task_id !=',0);
		$CI->db->where('MONTH(wallet_date)',date('m'));
		$CI->db->where('YEAR(wallet_date) ',date('Y'));
		
		$query=$CI->db->get();
			
		if($query->num_rows()>0)
		{
			$res=$query->row();
			
			if($res->fees>0)
			{
				return $res->fees;
			}
			
			return 0.00;
		}
		
			return 0.00;	
	}
	
	function get_yearly_runner_pay()
	{
		$CI =& get_instance();
		
		$CI->db->select('SUM(debit) as fees');
		$CI->db->from('wallet');
		$CI->db->where('debit >',0);
		$CI->db->where('credit =',0);
		$CI->db->where('task_id !=',0);
		$CI->db->where('YEAR(wallet_date)',date('Y'));
		
		$query=$CI->db->get();
		
		if($query->num_rows()>0)
		{
			$res=$query->row();
			
			if($res->fees>0)
			{
				return $res->fees;
			}
			
			return 0.00;
		}
		
			return 0.00;	
	}
	
	
	
	/**
	 * @param DateTime $date A given date
	 * @param int $firstDay 0-6, Sun-Sat respectively
	 * @return DateTime
	 */
	function get_first_day_of_week($date) 
	{
		 $day_of_week = date('N', strtotime($date)); 
		 $week_first_day = date('Y-m-d', strtotime($date . " - " . ($day_of_week - 1) . " days")); 
		 return $week_first_day;
	}

	
	function get_last_day_of_week($date)
	{
		 $day_of_week = date('N', strtotime($date)); 
		 $week_last_day = date('Y-m-d', strtotime($date . " + " . (7 - $day_of_week) . " days"));   
    	 return $week_last_day;
	}
	
	/************************************************report end****************************/
	
	/** send email
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
		$query = $CI->db->get("site_setting");
		return $query->row();
	
	}
	
	/*** load user setting
	*  return single record array
	**/
	
	function user_setting()
	{		
		$CI =& get_instance();
		$query = $CI->db->get("user_setting");
		return $query->row();
	
	}
	
	/*** get all currency code details
	*  return all record array
	**/
	
	function get_currency()
	{		
		$CI =& get_instance();
		$query = $CI->db->get('currency_code');
		return $query->result();
	
	}
	
	/*** get all timezone details
	*  return all record array
	**/
	
	function get_timezone()
	{		
		$CI =& get_instance();
		$query = $CI->db->get('timezone');
		return $query->result();
	
	}
	
	/*** get all languages details
	*  return all record array
	**/
	
	function get_languages()
	{		
		$CI =& get_instance();
		$query = $CI->db->get('language');
		return $query->result();
	
	}
	
	/*** load assigns right setting
	*  return number 1 or 0
	**/
	function get_rights($rights_name)
	{
		$CI =& get_instance();
		$right_detail = $CI->db->get_where("rights",array('rights_name'=>trim($rights_name)));
		
		if($right_detail->num_rows()>0)
			{
			
				$right_result=$right_detail->row();
				$rights_id=$right_result->rights_id;

			$query=$CI->db->get_where("rights_assign",array('rights_id'=>$rights_id,'admin_id'=>$CI->session->userdata('admin_id')));
			
			if($query->num_rows()>0)
			{
				$result=$query->row();
				
				if($result->rights_set=='1' || $result->rights_set==1)
				{
					return 1;
				}
				else
				{
					return 0;
				}					
			}
			else
			{
				return 0;
			}	
		}
		else
		{
			return 0;		
		}
	
	}
	
	/*** load meta setting
	*  return single record array
	**/
	
	function page_title()
	{		
		$CI =& get_instance();
		$query = $CI->db->get("meta_setting");
		$title = $query->row();
		return $title->title;
	
	}
	
	/*** get category name
	*  return string categoryname
	**/
	
	function get_category_name($cid)
	{		
		$CI =& get_instance();
		$query = $CI->db->get_where("task_category",array('task_category_id'=>$cid));
		if($query->num_rows>0){
			$name = $query->row();
			
				return $name->category_name;
			
		}
	}
	
	/*** get taskuser name
	*  return string username
	**/
	
	function get_user_name($uid)
	{		
		$CI =& get_instance();
		$query = $CI->db->get_where("user",array('user_id'=>$uid));
		$user = $query->row();
		return anchor(front_base_url().'user/'.$user->profile_name,ucfirst($user->first_name).' '.ucfirst(substr($user->last_name,0,1)),' style="color:#004C7A;" target="_blank"');
	}
	
	/*** get taskworker name
	*  return string workername
	**/
	
	function get_worker_name($wid)
	{	
		$CI =& get_instance();
		$query = $CI->db->query("select * from ".$this->db->dbprefix('user')." u, ".$this->db->dbprefix('worker')." w where u.user_id= w.user_id and w.worker_id = '".$wid."'");
		if($query->num_rows() > 0) {
			$name = $query->row();
			return $name->full_name;
		} else { 
			return 0;
		}
	}
	
	
	/***** get all city list
	***
	**/
	
	function city_list()
	{
			
		$CI =& get_instance();
		
		$CI->db->order_by('city_name','asc');
		$query = $CI->db->get_where("city",array('active'=>1));
		
		if($query->num_rows()>0)
		{
			 return $query->result();
		}
		
		return 0;			
	}
	
	
	/***** get all city list
	***
	**/
	
	function state_list()
	{
			
		$CI =& get_instance();
		
		$CI->db->order_by('state_name','asc');
		$query = $CI->db->get_where("state",array('active'=>1));
		
		if($query->num_rows()>0)
		{
			 return $query->result();
		}
		
		return 0;			
	}
	
	/*** get city name
	*  return string cityname
	**/
	
	function get_city_name($cid)
	{		
		$CI =& get_instance();
		$query = $CI->db->get_where("city",array('city_id'=>$cid));
		$name = $query->row();
		return $name->city_name;
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
	
	/*** load task setting
	*  return single record array
	**/
	
	function task_setting()
	{		
		$CI =& get_instance();
		$query = $CI->db->get("task_setting");
		return $query->row();
	
	}
	
	/*** get force_download 
	*  return string cityname
	**/
	
	function force_download($filename = '', $data = false, $enable_partial = true, $speedlimit = 0)
    {
        if ($filename == '')
        {
            return FALSE;
        }
        
        if($data === false && !file_exists($filename))
            return FALSE;

        // Try to determine if the filename includes a file extension.
        // We need it in order to set the MIME type
        if (FALSE === strpos($filename, '.'))
        {
            return FALSE;
        }
    
        // Grab the file extension
        $x = explode('.', $filename);
        $extension = end($x);

        // Load the mime types
        @include(APPPATH.'config/mimes'.EXT);
    
        // Set a default mime if we can't find it
        if ( ! isset($mimes[$extension]))
        {
            if (ereg('Opera(/| )([0-9].[0-9]{1,2})', $_SERVER['HTTP_USER_AGENT']))
                $UserBrowser = "Opera";
            elseif (ereg('MSIE ([0-9].[0-9]{1,2})', $_SERVER['HTTP_USER_AGENT']))
                $UserBrowser = "IE";
            else
                $UserBrowser = '';
            
            $mime = ($UserBrowser == 'IE' || $UserBrowser == 'Opera') ? 'application/octetstream' : 'application/octet-stream';
        }
        else
        {
            $mime = (is_array($mimes[$extension])) ? $mimes[$extension][0] : $mimes[$extension];
        }
        
        $size = $data === false ? filesize($filename) : strlen($data);
        
        if($data === false)
        {
            $info = pathinfo($filename);
            $name = $info['basename'];
        }
        else
        {
            $name = $filename;
        }
        
        // Clean data in cache if exists
        @ob_end_clean();
        
        // Check for partial download
        if(isset($_SERVER['HTTP_RANGE']) && $enable_partial)
        {
            list($a, $range) = explode("=", $_SERVER['HTTP_RANGE']);
            list($fbyte, $lbyte) = explode("-", $range);
            
            if(!$lbyte)
                $lbyte = $size - 1;
            
            $new_length = $lbyte - $fbyte;
            
            header("HTTP/1.1 206 Partial Content", true);
            header("Content-Length: $new_length", true);
            header("Content-Range: bytes $fbyte-$lbyte/$size", true);
        }
        else
        {
            header("Content-Length: " . $size);
        }
        
        // Common headers
        header('Content-Type: ' . $mime, true);
        header('Content-Disposition: attachment; filename="' . $name . '"', true);
        header("Expires: 0", true);
        header('Accept-Ranges: bytes', true);
        header("Cache-control: private", true);
        header('Pragma: private', true);header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        
        // Open file
        if($data === false) {
            $file = fopen($filename, 'r');
            
            if(!$file)
                return FALSE;
        }
        
        // Cut data for partial download
        if(isset($_SERVER['HTTP_RANGE']) && $enable_partial)
            if($data === false)
                fseek($file, $range);
            else
                $data = substr($data, $range);
        
        // Disable script time limit
        @set_time_limit(0);
        
        // Check for speed limit or file optimize
        if($speedlimit > 0 || $data === false)
        {
            if($data === false)
            {
                $chunksize = $speedlimit > 0 ? $speedlimit * 1024 : 512 * 1024;
            
                while(!feof($file) and (connection_status() == 0))
                {
                    $buffer = fread($file, $chunksize);
                    echo $buffer;
                    flush();
                    
                    if($speedlimit > 0)
                        sleep(1);
                }
                
                fclose($file);
            }
            else
            {
                $index = 0;
                $speedlimit *= 1024; //convert to kb
                
                while($index < $size and (connection_status() == 0))
                {
                    $left = $size - $index;
                    $buffersize = min($left, $speedlimit);
                    
                    $buffer = substr($data, $index, $buffersize);
                    $index += $buffersize;
                    
                    echo $buffer;
                    flush();
                    sleep(1);
                }
            }
        }
        else
        {
            echo $data;
        }
		
		//$this->db->cache_delete_all();
		ob_clean();
        flush();
		
    }
	
	/*** get transportation name
	*  return string categoryname
	**/
	
	function get_transportation_name($tid)
	{		
		$CI =& get_instance();
		$query = $CI->db->get_where("transportation",array('transportation_id'=>$tid));
		$name = $query->row();
		return $name->name;
	}
	
	/*** get device name
	*  return string categoryname
	**/
	
	function get_device_name($did)
	{		
		$CI =& get_instance();
		$query = $CI->db->get_where("device",array('device_id'=>$did));
		$name = $query->row();
		return $name->device_name;
	}
	
	/*** get device name
	*  return string categoryname
	**/
	
	function get_worker_document($wid)
	{		
		$CI =& get_instance();
		$query = $CI->db->get_where("worker_document",array('worker_id'=>$wid));
		$name = $query->row();
		if ($query->num_rows() > 0) {
			return $query->result();
		}
		return 0;
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
	
	
	
	function get_parent_category()
	{	
		$CI =& get_instance();
		
		
	  $query = $CI->db->get_where("task_category",array('category_status'=>1,'category_parent_id'=>0));

		if($query->num_rows()>0)
		{
			 return $query->result();
		}

		return 0;

	}
	
	
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
	
	
	function get_skill_worker($task_category_id,$city_id=0)
	{
		$CI =& get_instance();
		
		
		$CI->db->select('*');
		$CI->db->from('worker');
		$CI->db->like('worker_task_type',$task_category_id);
		
		if($city_id>0)
		{
			$CI->db->join('worker_cities', 'worker.user_id= worker_cities.user_id','left');
			$CI->db->like('worker_cities.city_id',$city_id);			
		}
		
		$query=$CI->db->get();

		if($query->num_rows()>0)
		{
			 return $query->num_rows();
		}
		
		
		return 0;	
		
	}
	
	
	/**
 * Array to CSV
 *
 * download == "" -> return CSV string
 * download == "toto.csv" -> download file toto.csv
 */
	

    function array_to_csv($array, $download = "")
    {
        if ($download != "")
        {    
            header('Content-Type: application/csv');
            header('Content-Disposition: attachement; filename="' . $download . '"');
        }        

        ob_start();
        $f = fopen('php://output', 'w') or show_error("Can't open php://output");
        $n = 0;        
        foreach ($array as $line)
        {
            $n++;
            if (!fputcsv($f, $line))
            {
                show_error("Can't write line $n: $line");
            }
        }
        fclose($f) or show_error("Can't close php://output");
        $str = ob_get_contents();
        ob_end_clean();

        if ($download == "")
        {
            return $str;    
        }
        else
        {    
            echo $str;
        }        
    }


// ------------------------------------------------------------------------

/**
 * Query to CSV
 *
 * download == "" -> return CSV string
 * download == "toto.csv" -> download file toto.csv
 */

    function query_to_csv($query, $headers = TRUE, $download = "")
    {
        if ( ! is_object($query) OR ! method_exists($query, 'list_fields'))
        {
            show_error('invalid query');
        }
        
        $array = array();
        
        if ($headers)
        {
            $line = array();
            foreach ($query->list_fields() as $name)
            {
                $line[] = $name;
            }
            $array[] = $line;
        }
        
        foreach ($query->result_array() as $row)
        {
            $line = array();
            foreach ($row as $item)
            {
                $line[] = $item;
            }
            $array[] = $line;
        }

        echo array_to_csv($array, $download);
    }


	
	
		
	/**** get city latitude and longitude
		*
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
	
	/*** load user notification setting
	*  return single record array
	**/
	
	function notification_setting($user_id)
	{		
		$CI =& get_instance();
		$query = $CI->db->get_where("user_notification", array('user_id'=>$user_id));
		return $query->row();
	
	}



/* End of file custom_helper.php */
/* Location: ./system/application/helpers/custom_helper.php */

?>