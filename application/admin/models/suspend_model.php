<?php

class Suspend_model extends CI_Model 
{

	
	function Suspend_model()
    {
        parent::__construct();	
    } 
	
	
	function new_comment($user_id,$user_suspend_id)
	{
	
		$data=array
		(
			'user_suspend_id'=>$this->input->post('user_suspend_id'),
			'is_admin'=>1,
			'message'=>strip_tags($this->input->post('comment')),
			'message_date'=>date('Y-m-d H:i:s'),
			'user_id'=>$user_id		
		);
		
		$this->db->insert('user_suspend_message',$data);
	
	}
	
	
	function remove_suspend($user_id,$user_suspend_id)
	{
		$data=array('user_status'=>1);
		$this->db->where('user_id',$user_id);
		$this->db->update('user',$data);
		
		
		$data2=array('is_permanent'=>0);
		$this->db->where('user_suspend_id',$user_suspend_id);
		$this->db->update('user_suspend',$data2);
		
		
	}
	
	
	function make_permanent_suspend($user_id,$user_suspend_id)
	{
		$data=array('user_status'=>2);
		$this->db->where('user_id',$user_id);
		$this->db->update('user',$data);
		
		
		$data2=array('is_permanent'=>1);
		$this->db->where('user_suspend_id',$user_suspend_id);
		$this->db->update('user_suspend',$data2);
		
		
	}
	
	
	function check_suspend_live($user_id)
	{
		
		$cur_date=date('Y-m-d H:i:s');
	
		$query=$this->db->query("select * from ".$this->db->dbprefix('user_suspend')." where user_id='".$user_id."' and '".$cur_date."' between suspend_from_date and suspend_to_date order by user_suspend_id desc limit 1");
	
		
		if($query->num_rows()>0)
		{
			return true;
			
		}
		else
		{
			
			$query=$this->db->query("select * from ".$this->db->dbprefix('user_suspend')." where user_id='".$user_id."' and is_permanent=1 order by user_suspend_id desc limit 1");
			
			if($query->num_rows()>0)
			{
				return true;
			}
			
		}
		
		return false;
	
	}
	
	
	/**** get user profile by id
	* var integer $user_id
	****/
	
	
	function get_user_profile_by_id($user_id)
	{
		
		
		$query=$this->db->query("select * from ".$this->db->dbprefix('user')." usr, ".$this->db->dbprefix('user_profile')." pr where usr.user_id=pr.user_id and usr.user_id='".$user_id."'");	
		
		
		return $query->row();
	}
	
	function get_total_message($user_id)
	{
		$cur_date=date('Y-m-d H:i:s');
	
		$query=$this->db->query("select * from ".$this->db->dbprefix('user_suspend')." where user_id='".$user_id."' order by user_suspend_id desc limit 1");
	
		
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
			
			$query=$this->db->query("select * from ".$this->db->dbprefix('user_suspend')." where user_id='".$user_id."' and is_permanent=1 order by user_suspend_id desc limit 1");
			
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
	
	function get_all_suspend_message($user_id,$limit,$offset)
	{
			$cur_date=date('Y-m-d H:i:s');
	
		$query=$this->db->query("select * from ".$this->db->dbprefix('user_suspend')." where user_id='".$user_id."'  order by user_suspend_id desc limit 1");
	
		
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
			
			$query=$this->db->query("select * from ".$this->db->dbprefix('user_suspend')." where user_id='".$user_id."' and is_permanent=1 order by user_suspend_id desc limit 1");
			
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
	
	
	
	function get_suspend_id($user_id)
	{
		
		$cur_date=date('Y-m-d H:i:s');
	
		$query=$this->db->query("select * from ".$this->db->dbprefix('user_suspend')." where user_id='".$user_id."'  order by user_suspend_id desc limit 1");
	
		
		if($query->num_rows()>0)
		{
			$result=$query->row();
			
				return $result->user_suspend_id;
			
			
		}
		else
		{
			
			$query=$this->db->query("select * from ".$this->db->dbprefix('user_suspend')." where user_id='".$user_id."' and is_permanent=1 order by user_suspend_id desc limit 1");
			
			if($query->num_rows()>0)
			{
				$result=$query->row();
			
				$result=$query->row();
			
				return $result->user_suspend_id;
			
			}
			
		}
		
		return 0;
			
	}
	
	
	
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