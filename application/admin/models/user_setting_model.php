<?php
class user_setting_model extends CI_Model
{
    function user_setting_model()
	{
	    parent::__construct();
	}
	
	function get_user_setting()
	{
		$query = $this->db->get_where('user_setting');
		
		if($query->num_rows() > 0)
		{
			return $query->row();
		}
		return 0;
	}
function user_setting_update()
	{
	    
		$data = array(			
			'user_setting_id' => $this->input->post('user_setting_id'),
			'sign_up_auto_active' => $this->input->post('sign_up_auto_active'),
			'user_task_auto_active' => $this->input->post('user_task_auto_active'),
			'no_task_after_auto_active' => $this->input->post('no_task_after_auto_active'),
			'delete_user_login_day' => $this->input->post('delete_user_login_day'),
			'delete_admin_login_day' => $this->input->post('delete_admin_login_day'),
			);
		$this->db->where('user_setting_id',$this->input->post('user_setting_id'));
		$this->db->update('user_setting',$data);
	
	
	
	
	
	$supported_cache=check_supported_cache_driver();
		
		if(isset($supported_cache))
		{
			if($supported_cache!='' && $supported_cache!='none')
			{
				echo "edede"; die();
				////===load cache driver===
				$this->load->driver('cache');				
				
				$query = $this->db->get("user_setting");
									
				$this->cache->$supported_cache->save('user_setting', $query->row(),CACHE_VALID_SEC);		
				
			}			
			
		}
		
	
	
	
	}

}
?>