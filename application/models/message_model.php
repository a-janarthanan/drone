<?php
class Message_model extends CI_Model 
{
	
	/*
	Function name :Message_model
	Description :its default constuctor which called when Message_model object initialzie.its load necesary parent constructor
	*/
    function Message_model()
    {
        parent::__construct();	
    }   
	
	/*
	Function name :get_message_by_id()
	Parameter : none 
	Return : array of all message
	Use : get user all unread messages
	*/
	
	function get_message_by_id()
	{

	
		$query = $this->db->query("select DISTINCT m.poster_user_id,m.act,m.message_id,t.task_name from ".$this->db->dbprefix('message')." m, ".$this->db->dbprefix('task')." t, ".$this->db->dbprefix('user')." u where m.receiver_user_id = '".get_authenticateUserID()."' and m.task_id = t.task_id and m.receiver_user_id = u.user_id and m.is_read=0 order by m.message_date desc , m.is_read asc limit 6");
		
		if($query->num_rows()>0)
			{
				return $query->result();	
			}
			
		return 0;
	}
	
	
	/*
	Function name :get_all_message()
	Parameter : $offset (for paging), $limit(for paging)
	Return : array of all messages
	Use : get user all unread and read messages default ordering is unread come first in the list
	*/
	
	
	function get_all_message($offset,$limit)
	{

	
		$query = $this->db->query("select * from ".$this->db->dbprefix('message')." m, ".$this->db->dbprefix('task')." t, ".$this->db->dbprefix('user')." u where m.receiver_user_id = '".get_authenticateUserID()."' and m.task_id = t.task_id and m.receiver_user_id = u.user_id order by  m.is_read asc ,m.message_date desc LIMIT ".$limit." OFFSET ".$offset);
		
		if($query->num_rows()>0)
			{
				return $query->result();	
			}
			
		return 0;
	}
	
	
	/*
	Function name :get_count_message()
	Parameter : none
	Return : integer count of all messafes
	Use : get user all unread and read total messages
	*/
	
	
	function get_count_message()
	{

	
		$query = $this->db->query("select * from ".$this->db->dbprefix('message')." m, ".$this->db->dbprefix('task')." t, ".$this->db->dbprefix('user')." u where m.receiver_user_id = '".get_authenticateUserID()."' and m.task_id = t.task_id and m.receiver_user_id = u.user_id order by  m.is_read asc ,m.message_date desc");
			
		return $query->num_rows();
	}
	
	
	/*
	Function name :get_worker_details()
	Parameter : $user_id(user id)
	Return : array of runner details
	Use : get user worker details
	*/
	function get_worker_details($user_id)
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('user_profile','user.user_id=user_profile.user_id','left');		
		$this->db->join('worker','worker.user_id=user.user_id','left');		
		$this->db->where('user.user_id',$user_id);	
		
		$query = $this->db->get();
		
		return $query->row();
	}
	
	
	/*
	Function name :get_message_detail()
	Parameter : $id(message id)
	Return : array of message details
	Use : get message details
	*/
	
	function get_message_detail($id)
	{
		$query = $this->db->query("select * from ".$this->db->dbprefix('message')." m, ".$this->db->dbprefix('task')." t, ".$this->db->dbprefix('user')." u where m.receiver_user_id = '".get_authenticateUserID()."' and m.task_id = t.task_id and m.receiver_user_id = u.user_id and m.message_id ='".$id."'");
		
		if($query->num_rows()>0)
			{
				return $query->row();	
			}
			
		return 0;
	}
}
?>