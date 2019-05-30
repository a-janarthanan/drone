<?php
class task_setting_model extends CI_Model
{
    function task_setting_model()
	{
	    parent::__construct();
	}
	
	function get_task_setting()
	{
		$query = $this->db->get_where('task_setting');
		
		if($query->num_rows() > 0){
			return $query->row();
		}
		return 0;
	}
	
	function get_dispute_setting()
	{
		$query = $this->db->get_where('dispute_setting');
		
		if($query->num_rows() > 0){
			return $query->row();
		}
		return 0;
	}
}
?>