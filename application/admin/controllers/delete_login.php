<?php
class Delete_login extends CI_Controller
{
     
  	function Delete_login()
    {
    	parent::__construct();
 	}
  

	function cron_delete_user_login()
 	{
		/////===== get user setting details
			$user_setting = user_setting();
			$user_day_limit = $user_setting->delete_user_login_day;
			
		/////===== get all user details
			$user = $this->db->get("user");
			$users = $user->result();
			if($users){
				foreach($users as $user){
					
					/////===== get last user login details
						$this->db->order_by('login_date_time','desc');
						$this->db->limit('1','0');
						$user_login  = $this->db->get_where('user_login',array('user_id'=>$user->user_id));
						
						if($user_login->num_rows >0) {
							$user_logins = $user_login->row();
		
							$date = $user_logins->login_date_time;
							$user_limit_date =date('Y-m-d H:i:s',mktime(0,0,0,date('m',strtotime($date)),date('d',strtotime($date))-$user_day_limit,date('Y',strtotime($date))));
							
							/////=====delete user login details
							$this->db->query("Delete from ".$this->db->dbprefix('user_login')." where login_date_time <= '".$user_limit_date."' and user_id = '".$user_logins->user_id."'");	
							
		
						}
				}
				
				/////////// save cron job run time
				$data = array(
							'user_id' => 0,
							'cronjob' => 'delete_user_login',
							'date_run' =>date('Y-m-d H:i:s'),
							'status' => '1',
						);
				$this->db->insert('cronjob', $data);
	
				exit;
				
			} else {
			
				/////////// save cron job run time
				$data = array(
							'user_id' => 0,
							'cronjob' => 'delete_user_login',
							'date_run' =>date('Y-m-d H:i:s'),
							'status' => '0',
						);
				$this->db->insert('cronjob', $data);
	
				exit;
			
			}
	}
	
	
	
	function cron_delete_admin_login()
 	{
		
		/////===== get user setting details
			$user_setting = user_setting();
			$admin_day_limit = $user_setting->delete_admin_login_day;
			
		/////===== get all admin details
			$admin = $this->db->get("admin");
			$admins = $admin->result();
			if($admins) {
				foreach($admins as $admin){
					
					/////===== get last admin login details
						$this->db->order_by('login_date','desc');
						$this->db->limit('1','0');
						$admin_login  = $this->db->get_where('admin_login',array('admin_id'=>$admin->admin_id));
						
						if($admin_login->num_rows >0) {
							$admin_logins = $admin_login->row();
							
		
							$date = $admin_logins->login_date;
							$admin_limit_date =date('Y-m-d H:i:s',mktime(0,0,0,date('m',strtotime($date)),date('d',strtotime($date))-$admin_day_limit,date('Y',strtotime($date))));
							
							/////=====delete admin login details
							$this->db->query("Delete from ".$this->db->dbprefix('admin_login')." where login_date <= '".$admin_limit_date."' and admin_id = '".$admin_logins->admin_id."'");
	
						}
				}
			/////////// save cron job run time
				$data = array(
							'user_id' => 0,
							'cronjob' => 'delete_admin_login',
							'date_run' =>date('Y-m-d H:i:s'),
							'status' => '1',
						);
				$this->db->insert('cronjob', $data);
	
				exit;
				
			} else {
			
				/////////// save cron job run time
				$data = array(
							'user_id' => 0,
							'cronjob' => 'delete_admin_login',
							'date_run' =>date('Y-m-d H:i:s'),
							'status' => '0',
						);
				$this->db->insert('cronjob', $data);
	
				exit;
			
			}
		
	}

}
?>