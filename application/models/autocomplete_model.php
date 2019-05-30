<?php
class Autocomplete_model extends CI_Model {
	
	/*
	Function name :Autocomplete_model
	Description :its default constuctor which called when Autocomplete_model object initialzie.its load necesary parent constructor
	*/
	
	function Autocomplete_model()
    {
        parent::__construct();	
    } 
	
	/*
	Function name :get_task()
	Parameter : none
	Return : array of task details
	Use : get task details
	*/
	function get_task()
	{
		$this->db->select('*');
		$this->db->from('task');
		$this->db->where('task_status',1);
		$this->db->where('task_activity_status',2);
		$this->db->where('task_worker_id >',0);
		$this->db->where('worker_agree',1);
		$this->db->or_where('poster_agree',0);
		$this->db->order_by('task_id','ASC');
		
		
		$query=$this->db->get();
				
		if($query->num_rows()>0)
		{
			return $query->result();
		}
		
		return 0;
			
	}
	
	
	/*
	Function name :user_added_task_price()
	Parameter : $user_id (user id), $task_id (task id)
	Return : array details of task price in wallet list
	Use : get details of task price in wallet list
	*/
	function user_added_task_price($user_id,$task_id)
	{
	
	
		$this->db->select('*');
		$this->db->from('wallet');
		$this->db->where('user_id',$user_id);
		$this->db->where('task_id',$task_id);
		$this->db->where('credit >',0);
		$this->db->order_by('id','DESC');
		
		$query=$this->db->get();
				
		if($query->num_rows()>0)
		{
			return $query->row();
		}
		
		return 0;
		
	
	}
}
?>	