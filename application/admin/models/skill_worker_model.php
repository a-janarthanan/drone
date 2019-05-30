<?php

class Skill_worker_model extends CI_Model {
	
    function Skill_worker_model()
    {
        parent::__construct();	
    }   
	
	
	
	/*** get total worker 
	*  return number
	**/
	function get_total_worker_count($category_id)
	{
		
		$query=$this->db->query("select * from ".$this->db->dbprefix('worker')." w, ".$this->db->dbprefix('user')." u where w.user_id = u.user_id and w.worker_status =1 and w.worker_app_approved=1 and w.worker_task_type like '%".$category_id."%'");
		
		if($query->num_rows()>0)
		{	
			return $query->num_rows();
		}
		
		return 0;
	}
	
	
	/*** get workers details
	*  return multiple records array
	**/
	function get_worker_result($category_id,$offset, $limit)
	{
		
		
		$query = $this->db->query("select * from ".$this->db->dbprefix('worker')." w, ".$this->db->dbprefix('user')." u where w.user_id = u.user_id and  w.worker_status =1 and w.worker_app_approved=1 and w.worker_task_type like '%".$category_id."%' order by w.worker_id desc limit ".$limit." offset ".$offset);
		if ($query->num_rows() > 0) {
			return $query->result();
		}
		return 0;
	}
	
	
	
	
	
	/*** get total user 
	*  return number
	**/
	function get_total_search_worker_count($category_id,$option,$keyword)
	{
		$keyword=str_replace('"','',str_replace(array("'",",","%","$","&","*","#","(",")",":",";",">","<","/"),'',$keyword));
		
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('worker', 'worker.user_id= user.user_id','left');
		$this->db->where('worker.worker_status',1);
		$this->db->where('worker.worker_app_approved',1);
		$this->db->like('worker.worker_task_type',$category_id);
				
		if($option=='city')
		{
			$this->db->join('worker_cities', 'worker.user_id= worker_cities.user_id','left');
			$this->db->like('worker_cities.city_id',$keyword);			
		}
		
		$this->db->order_by("worker.worker_id", "desc"); 
		
		
		$query = $this->db->get();
		
		
		return $query->num_rows();
	}
	
	
	/*** get users details
	*  return multiple records array
	**/
	function get_search_worker_result($category_id,$option,$keyword,$offset, $limit)
	{
		
		$keyword=str_replace('"','',str_replace(array("'",",","%","$","&","*","#","(",")",":",";",">","<","/"),'',$keyword));
		
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('worker', 'worker.user_id= user.user_id','left');
		$this->db->where('worker.worker_status',1);
		$this->db->where('worker.worker_app_approved',1);
		$this->db->like('worker.worker_task_type',$category_id);
		
		
		if($option=='city')
		{
			$this->db->join('worker_cities', 'worker.user_id= worker_cities.user_id','left');
			$this->db->like('worker_cities.city_id',$keyword);			
		}
		
		$this->db->order_by("worker.worker_id", "desc"); 
		
		$this->db->limit($limit,$offset);
		
		$query = $this->db->get();
		
		
		if ($query->num_rows() > 0) {
			
			return $query->result();
		}
		return 0;
	}
	
	/*Search End*/
	
	
	
}

?>