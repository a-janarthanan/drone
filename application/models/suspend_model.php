<?php
class Suspend_model extends CI_Model 
{

	/*
	Function name :Suspend_model
	Description :its default constuctor which called when suspend_model object initialzie.its load necesary parent constructor
	*/
	function Suspend_model()
    {
        parent::__construct();	
    } 
	
	/*
	Function name :new_comment()
	Parameter : $user_suspend_id(user suspend id) 
	Return : none
	Use : add new suspend conversation
	*/
	
	function new_comment($user_suspend_id)
	{
	
		$data=array
		(
			'user_suspend_id'=>$this->input->post('user_suspend_id'),
			'is_admin'=>0,
			'message'=>strip_tags($this->input->post('comment')),
			'message_date'=>date('Y-m-d H:i:s'),
			'user_id'=>get_authenticateUserID()		
		);
		
		$this->db->insert('user_suspend_message',$data);
	
	}
	
	
	
	/*
	Function name :get_user_profile_by_id()
	Parameter : $user_id(user suspend id) 
	Return : array of user details
	Use : get user full details
	*/
	
	function get_user_profile_by_id($user_id)
	{
		
		
		$query=$this->db->query("select * from ".$this->db->dbprefix('user')." usr, ".$this->db->dbprefix('user_profile')." pr where usr.user_id=pr.user_id and usr.user_id='".$user_id."'");	
		
		
		return $query->row();
	}
	
	
	/*
	Function name :get_total_message()
	Parameter : none
	Return : integer, count of all suspend conversation
	Use : get total number of suspend time conversations
	*/
	
	
	function get_total_message()
	{
		$cur_date=date('Y-m-d H:i:s');
	
		$query=$this->db->query("select * from ".$this->db->dbprefix('user_suspend')." where user_id='".get_authenticateUserID()."' and '".$cur_date."' between suspend_from_date and suspend_to_date order by user_suspend_id desc limit 1");
	
		
		if($query->num_rows()>0)
		{
			$result=$query->row();
			
			$this->db->order_by('suspend_message_id','desc');
			$message=$this->db->get_where('user_suspend_message',array('user_suspend_id'=>$result->user_suspend_id));
			
			if($message->num_rows()>0)
			{
				return $message->num_rows();
			}
			
		}
		else
		{
			
			$query=$this->db->query("select * from ".$this->db->dbprefix('user_suspend')." where user_id='".get_authenticateUserID()."' and is_permanent=1 order by user_suspend_id desc limit 1");
			
			if($query->num_rows()>0)
			{
				$result=$query->row();
			
				$this->db->order_by('suspend_message_id','desc');
				$message=$this->db->get_where('user_suspend_message',array('user_suspend_id'=>$result->user_suspend_id));
				
				if($message->num_rows()>0)
				{
					return $message->num_rows();
				}
			}
			
		}
		
		return 0;
	}
	
	
	/*
	Function name :get_all_suspend_message()
	Parameter : $limit(for paging), $offset(for paging)
	Return : array of suspend conversation
	Use : get all suspend time conversations
	*/
	
	
	function get_all_suspend_message($limit,$offset)
	{
			$cur_date=date('Y-m-d H:i:s');
	
		$query=$this->db->query("select * from ".$this->db->dbprefix('user_suspend')." where user_id='".get_authenticateUserID()."' and '".$cur_date."' between suspend_from_date and suspend_to_date order by user_suspend_id desc limit 1");
	
		
		if($query->num_rows()>0)
		{
			$result=$query->row();
			
			$this->db->order_by('suspend_message_id','desc');
			$message=$this->db->get_where('user_suspend_message',array('user_suspend_id'=>$result->user_suspend_id),$limit, $offset);
			
			if($message->num_rows()>0)
			{
				return $message->result();
			}
			
		}
		else
		{
			
			$query=$this->db->query("select * from ".$this->db->dbprefix('user_suspend')." where user_id='".get_authenticateUserID()."' and is_permanent=1 order by user_suspend_id desc limit 1");
			
			if($query->num_rows()>0)
			{
				$result=$query->row();
			
				
				$this->db->order_by('suspend_message_id','desc');
				$message=$this->db->get_where('user_suspend_message',array('user_suspend_id'=>$result->user_suspend_id),$limit, $offset);
				
				if($message->num_rows()>0)
				{
					return $message->result();
				}
			}
			
		}
		
		return 0;
	}
	
	/*
	Function name :get_suspend_id()
	Parameter : none
	Return : integer user_suspend_id
	Use : get user current suspend id
	*/
	
	function get_suspend_id()
	{
		
		$cur_date=date('Y-m-d H:i:s');
	
		$query=$this->db->query("select * from ".$this->db->dbprefix('user_suspend')." where user_id='".get_authenticateUserID()."' and '".$cur_date."' between suspend_from_date and suspend_to_date order by user_suspend_id desc limit 1");
	
		
		if($query->num_rows()>0)
		{
			$result=$query->row();
			
				return $result->user_suspend_id;
			
			
		}
		else
		{
			
			$query=$this->db->query("select * from ".$this->db->dbprefix('user_suspend')." where user_id='".get_authenticateUserID()."' and is_permanent=1 order by user_suspend_id desc limit 1");
			
			if($query->num_rows()>0)
			{
				$result=$query->row();
			
				$result=$query->row();
			
				return $result->user_suspend_id;
			
			}
			
		}
		
		return 0;
			
	}
	
	
	/*
	Function name :get_suspend_detail()
	Parameter : $user_suspend_id(user suspend id)
	Return : array of user suspend details
	Use : get user suspend details
	*/
	
	function get_suspend_detail($user_suspend_id)
	{
		
		
		$query=$this->db->get_where('user_suspend',array('user_suspend_id'=>$user_suspend_id));
		
		if($query->num_rows()>0)
		{
			return $query->row();
		}
		return 0;
	}
	
}


?>