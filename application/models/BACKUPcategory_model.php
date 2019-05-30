<?php
class Category_model extends CI_Model 
{

	/*
	Function name :Category_model
	Description :its default constuctor which called when Category_model object initialzie.its load necesary parent constructor
	*/
	
	function Category_model()
    {
        parent::__construct();	
    } 
	
	/*
	Function name :browse_all_category()
	Parameter : none
	Return : array of browse all category
	Use : get browse all category
	*/

	function browse_all_category()
	{
		$this->db->select('*');
		$this->db->from('task_category');
		
		$this->db->where('category_parent_id',0);
		$this->db->where('category_status',1);
		
		$query=$this->db->get();
		
		if($query->num_rows()>0)
		{
			return $query->result();
		}
		
		return 0;
	
	
	
	}


	/*
	Function name :get_category_info()
	Parameter : $name (category url name)
	Return : single array of category details
	Use : get category details
	*/

	function get_category_info($name){
		$query = $this->db->get_where("task_category",array('category_url_name'=>$name));
		$category_info = $query->row();
		$pid = $category_info->category_parent_id;
		if($pid == 0){ 
			return $category_info;
		} else {  
			$query = $this->db->get_where("task_category",array('task_category_id'=>$pid));
			$category_info = $query->row();
			return $category_info;
		}
			
	}
	
	/*
	Function name :get_category_name()
	Parameter : $name (category url name)
	Return : single array of category details
	Use : get category details
	*/
	
	function get_category_name($name){
		$query = $this->db->get_where("task_category",array('category_url_name'=>$name));
		return $query->row();
	}
	
	/*
	Function name :gel_all_category()
	Parameter : $name (category url name)
	Return : array of parent category details
	Use : get parent category details
	*/
	
	function gel_all_category($name){
		$query = $this->db->get_where("task_category",array('category_url_name'=>$name));
		$category_info = $query->row();
		$pid = $category_info->category_parent_id;
		$cid = $category_info->task_category_id;
		
		if($pid == 0){ 
			$query = $this->db->get_where("task_category",array('category_parent_id'=>$cid));
			$category_info = $query->result();
			return $category_info;
		} else {  
			$query = $this->db->get_where("task_category",array('category_parent_id'=>$pid));
			$category_info = $query->result();
			return $category_info;
		}
		
		//return  $query->result();
	}
	
	
	/*
	Function name :get_total_category_task_list()
	Parameter : $category_id (category id), $city_id (City id)
	Return : integer of task total in category
	Use : get user total task request records in category
	*/
	
	function get_total_category_task_list($category_id,$city_id)
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
		
		$city_cond='';
		
		if($city_id>0)
		{
				$city_cond=" and tk.task_city_id='".$city_id."'";			
		}
		
		
		
		if($user_status=='worker')
		{				
		$query = $this->db->query("select * from  ".$this->db->dbprefix('task')." tk, ".$this->db->dbprefix('user')." ur,".$this->db->dbprefix('user_profile')." up where tk.task_category_id='".$category_id."' and tk.user_id = ur.user_id and ur.user_id = up.user_id and (tk.task_is_private=1 or tk.task_is_private=0) and tk.task_status = 1 ".$city_cond);
		}
		else
		{		
			$query = $this->db->query("select * from ".$this->db->dbprefix('task')." tk, ".$this->db->dbprefix('user')." ur, ".$this->db->dbprefix('user_profile')." up where tk.task_category_id='".$category_id."' and tk.user_id = ur.user_id and ur.user_id = up.user_id and tk.task_status = 1 and tk.task_is_private=0 ".$city_cond);
		
		}	
		
			return  $query->num_rows();
		
	}
	
	
	/*
	Function name :get_category_task_list()
	Parameter : $category_id (category id), $city_id (City id)
	Return : array of task details in category
	Use : get task details in category
	*/
	
	function get_category_task_list($category_id,$city_id,$limit,$offset)
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
		
		
		$city_cond='';
		
		if($city_id>0)
		{
				$city_cond=" and tk.task_city_id='".$city_id."'";			
		}
		
		
		if($user_status=='worker')
		{				
		$query = $this->db->query("select * from ".$this->db->dbprefix('task')." tk, ".$this->db->dbprefix('user')." ur, ".$this->db->dbprefix('user_profile')." up where tk.task_category_id='".$category_id."' and tk.user_id = ur.user_id and ur.user_id = up.user_id and (tk.task_is_private=1 or tk.task_is_private=0) and tk.task_status = 1 ".$city_cond." order by tk.task_id desc limit ".$limit." offset ".$offset);
		
		}
		else
		{		
			$query = $this->db->query("select * from ".$this->db->dbprefix('task')." tk, ".$this->db->dbprefix('user')." ur, ".$this->db->dbprefix('user_profile')." up where tk.task_category_id='".$category_id."' and tk.user_id = ur.user_id and ur.user_id = up.user_id and tk.task_status = 1 and tk.task_is_private=0 ".$city_cond." order by tk.task_id desc limit ".$limit." offset ".$offset);
		
		}	
		
		if($query->num_rows()>0)
		{
			return  $query->result();
		}

		return 0;
	}
	
	
	
	
}
?>