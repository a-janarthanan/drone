<?php
class Map_model extends CI_Model 
{

	/*
	Function name :Map_model
	Description :its default constuctor which called when map_model object initialzie.its load necesary parent constructor
	*/
	
	function Map_model()
    {
        parent::__construct();	
    } 
	
	/*
	Function name :get_city_alltask()
	Parameter : none 
	Return : array of all city task list
	Use : get all city task list
	
	NOTE : private tasks are include in list if current user is logged in and he/she is a runner
	*/
	function get_city_alltask()
	{
		
			$user_status='visitor';
			
			if(check_user_authentication()) 
			{		
				$check_is_worker=$this->db->get_where('worker',array('user_id'=>get_authenticateUserID(),'worker_status'=>1));
				//echo $this->db->last_query();exit;
				if($check_is_worker->num_rows()>0)
				{
					$user_status='worker';
				}		
			}
			
			
			if($user_status=='worker')
			{	
			
			
		
		
			$query = $this->db->query("select * from ".$this->db->dbprefix('task')." tsk, ".$this->db->dbprefix('city')." cty where tsk.task_city_id = cty.city_id and tsk.task_is_private=0 and tsk.task_activity_status!=4 order by task_id desc");
			//echo $this->db->last_query();
			}
			else
			{
			
					
						$query = $this->db->query("select * from trc_task tsk, trc_city cty where tsk.task_city_id = cty.city_id and tsk.task_is_private=0 and tsk.task_activity_status!=4 and tsk.task_name!='' order by task_id desc");
						//echo $this->db->last_query();
						
			
			}
		
		//echo $this->db->last_query();
		//exit;
		
	
		
		
		return $query->result();	
	}
	
	function get_category_alltask($catid)
	{
		
			$user_status='visitor';
			
			if(check_user_authentication()) 
			{		
				$check_is_worker=$this->db->get_where('worker',array('user_id'=>get_authenticateUserID(),'worker_status'=>1));
				
				if($check_is_worker->num_rows()>0)
				{
					$user_status='worker';
				}		
			}
			
			
			if($user_status=='worker')
			{	
			
			
		
		
			$query = $this->db->query("select * from ".$this->db->dbprefix('task')." tsk, ".$this->db->dbprefix('task_category')." tskcat where tsk.task_category_id = '".$catid."' and  tsk.task_status=1 and tsk.task_is_private=0 and tsk.task_activity_status!=4 order by task_id desc");
			
			}
			else
			{
			
					
						$query = $this->db->query("select * from ".$this->db->dbprefix('task')." tsk, ".$this->db->dbprefix('task_category')." tskcat where tsk.task_category_id = '".$catid."' and  tsk.task_status=1 and tsk.task_is_private=0 and tsk.task_is_private=0 and tsk.task_activity_status!=4 order by task_id desc");
						
						
			
			}
		
		//echo $this->db->last_query();exit;
		
	
		
		
		return $query->result();	
	}
	
	/*
	Function name :get_city_task()
	Parameter : $city (city name)
	Return : array of one city task list
	Use : get one city task list
	
	NOTE : private tasks are include in list if current user is logged in and he/she is a runner
	*/
	function get_city_task($city)
	{
				
			$user_status='visitor';
			
			if(check_user_authentication()) 
			{		
				$check_is_worker=$this->db->get_where('worker',array('user_id'=>get_authenticateUserID(),'worker_status'=>1));
				
				if($check_is_worker->num_rows()>0)
				{
					$user_status='worker';
				}		
			}
			
			
			if($user_status=='worker')
			{	
			
			
		$query = $this->db->query("select * from ".$this->db->dbprefix('task')." tsk , ".$this->db->dbprefix('city')." cty where  tsk.task_city_id = cty.city_id and tsk.task_status=1 and tsk.task_is_private=0 and tsk.task_activity_status!=4  and cty.city_name like '%".$city."%' order by task_id desc");
			
			}
			else
			{
			
					$query = $this->db->query("select * from ".$this->db->dbprefix('task')." tsk , ".$this->db->dbprefix('city')." cty where  tsk.task_city_id = cty.city_id and tsk.task_status=1 and tsk.task_is_private=0 and tsk.task_activity_status!=4 and tsk.task_is_private=0 and cty.city_name like '%".$city."%' order by task_id desc");
					//echo $this->db->last_query();
			}
		
		//echo $this->db->last_query();
		
		return $query->result();	
	}
	
	
	/*
	Function name :get_location()
	Parameter : $taskid (task id)
	Return : array of task all locations
	Use : get task all locations
	*/
	function get_location($taskid)
	{
		$query = $this->db->query("SELECT * FROM ".$this->db->dbprefix('task_location')." where task_id='".$taskid."'");
		if($query->num_rows()>0)
		{
			$location  = $query->result();
	
			return $query->result();	
		}
		return 0;
	
	}
	
}
?>