<?php
class User_login extends ROCKERS_Controller 
{
	
	/*
	Function name :User_login()
	Description :Its Default Constuctor which called when user_login object initialzie.its load necesary models
	*/
	function User_login()
	{
		parent::__construct();		
		$this->load->model('user_model');	
		$this->load->model('user_login_model');	
	}
	
	
	/*
	Function name :index()
	Parameter :none
	Return : none
	Use : check user ideal stat for who-is-online module
	Description : if user is in ideal stat more than 20 minutes or other specified time then make user logout this function used in cron job
	              for that create cron job on user server with following function which is called by http://hostname/user_login
	*/
	
	
	function index()
	{
		$this->load->driver('cache');			
		$supported_cache=check_supported_cache_driver();
		
		$cur_date_time=date('Y-m-d H:i:s');	
				
		$get_login_user=$this->user_login_model->get_all_login_user();	
		
		if($get_login_user)
		{
			foreach($get_login_user as $login_details)
			{
				
				
				if(isset($supported_cache))
				{
					if($supported_cache!='' && $supported_cache!='none')
					{
						
						
						if($this->cache->$supported_cache->get('user_login'.$login_details->user_id))
						{					
							$login_details=(object)$this->cache->$supported_cache->get('user_login'.$login_details->user_id);					
						}
					}
				}
				
				/////////==========
				
				if($login_details)
				{
		
					 $login_time=$login_details->login_date_time;						
					 $login_extend_time=date('Y-m-d H:i:s',strtotime(date("Y-m-d H:i:s", strtotime($login_time)) . " +20 minutes"));
					 
					 
					 if(strtotime($cur_date_time)>strtotime($login_extend_time))
					 {
						
						
							$data_up=array(
								'login_status'=>0
							);
							
							$this->db->where('login_id',$login_details->login_id);
							$this->db->update('user_login',$data_up);
							
							
							
							////==destroy cache====	
						
							
							if(isset($supported_cache))
							{
								if($supported_cache!='' && $supported_cache!='none')
								{	
									if($this->cache->$supported_cache->get('user_login'.$login_details->user_id))
									{								
										$this->cache->$supported_cache->delete('user_login'.$login_details->user_id);						
									}
								}
								
							}
							
						
							////==destroy cache====	
					 
					 }
			 
				}
			
					
				
				///////////=========
			}
			/////////// save cron job run time
			$data = array(
						'user_id' => 0,
						'cronjob' => 'user_login',
						'date_run' =>date('Y-m-d H:i:s'),
						'status' => '1',
					);
			$this->db->insert('cronjob', $data);

			exit;
		} else {
		
			/////////// save cron job run time
			$data = array(
						'user_id' => 0,
						'cronjob' => 'user_login',
						'date_run' =>date('Y-m-d H:i:s'),
						'status' => '0',
					);
			$this->db->insert('cronjob', $data);

			exit;
		}
		
	}
	
}

?>