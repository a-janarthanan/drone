<?php

class Worker_model extends CI_Model {
	
    function Worker_model()
    {
        parent::__construct();	
    }   
	
	
	
	
	
	/**** get worker cities
	*
	***/
	
	function get_worker_cities($worker_id)
	{
		
		$this->db->select('*');
		$this->db->from('worker_cities wc');
		$this->db->join('city ct','wc.city_id=ct.city_id');
		$this->db->where('wc.worker_id',$worker_id);
		$this->db->order_by('ct.city_name','asc');
		
		$query=$this->db->get();
		
		
		if($query->num_rows()>0)
		{
			return $query->result();
		}
		
		return 0;
		
	
	}
	
	

	/*** get total worker 
	*  return number
	**/
	function get_total_worker_count()
	{
		
		$query=$this->db->query("select * from ".$this->db->dbprefix('worker')." w, ".$this->db->dbprefix('user')." u where w.user_id = u.user_id and w.worker_status !='3'");
		
		if($query->num_rows()>0)
		{	
			return $query->num_rows();
		}
		
		return 0;
	}
	
	
	/*** get workers details
	*  return multiple records array
	**/
	function get_worker_result($offset, $limit)
	{
		
		
		$query = $this->db->query("select * from ".$this->db->dbprefix('worker')." w, ".$this->db->dbprefix('user')." u where w.user_id = u.user_id and w.worker_status !='3' order by u.user_id desc limit ".$limit ." offset ".$offset);
		if ($query->num_rows() > 0) {
			return $query->result();
		}
		return 0;
	}
	
	//active worker
	function get_total_active_worker_count()
	{
		$query=$this->db->query("select * from ".$this->db->dbprefix('worker')." w, ".$this->db->dbprefix('user')." u where w.user_id = u.user_id and w.worker_app_approved='1' and w.worker_status='1'");
		
		if($query->num_rows()>0)
		{	
			return $query->num_rows();
		}
		
		return 0;
	}
	
	function get_active_worker_result($offset, $limit)
	{
		
		
		$query = $this->db->query("select * from ".$this->db->dbprefix('worker')." w, ".$this->db->dbprefix('user')." u where w.user_id = u.user_id and w.worker_app_approved='1' and w.worker_status='1' order by u.user_id desc limit ".$limit. " offset ".$offset);
		if ($query->num_rows() > 0) {
			return $query->result();
		}
		return 0;
	}
	
	//end active worker
	
	//waiting worker
	
	function get_total_waiting_worker_count()
	{
		$query=$this->db->query("select * from ".$this->db->dbprefix('worker')." w inner join ".$this->db->dbprefix('user')." u on w.user_id = u.user_id and w.worker_status='0'");
		
		if($query->num_rows()>0)
		{	
			return $query->num_rows();
		}
		
		return 0;
	}
	
	function get_waiting_worker_result($offset, $limit)
	{
		
		
		$query = $this->db->query("select * from ".$this->db->dbprefix('worker')." w inner join ".$this->db->dbprefix('user')." u on w.user_id = u.user_id and w.worker_status='0' order by u.user_id desc limit ".$limit." offset ".$offset);
		if ($query->num_rows() > 0) {
			return $query->result();
		}
		return 0;
	}
	
	//reject worker
	
	function get_total_reject_worker_count()
	{
		$query=$this->db->query("select * from ".$this->db->dbprefix('worker')." w, ".$this->db->dbprefix('user')." u where w.user_id = u.user_id and w.worker_status='2'");
		
		if($query->num_rows()>0)
		{	
			return $query->num_rows();
		}
		
		return 0;
	}
	
	function get_reject_worker_result($offset, $limit)
	{
		
		
		$query = $this->db->query("select * from ".$this->db->dbprefix('worker')." w, ".$this->db->dbprefix('user')." u where w.user_id = u.user_id and  w.worker_status='2' order by u.user_id desc limit ".$limit." offset ".$offset);
		if ($query->num_rows() > 0) {
			return $query->result();
		}
		return 0;
	}
	
	function get_total_delete_worker_count()
	{
		$query=$this->db->query("select * from ".$this->db->dbprefix('worker')." w, ".$this->db->dbprefix('user')." u where w.user_id = u.user_id and w.worker_status='3'");
		
		if($query->num_rows()>0)
		{	
			return $query->num_rows();
		}
		
		return 0;
	}
	
	function get_delete_worker_result($offset, $limit)
	{

		$query = $this->db->query("select * from ".$this->db->dbprefix('worker')." w, ".$this->db->dbprefix('user')." u where w.user_id = u.user_id and w.worker_status='3' order by u.user_id desc limit ".$limit. " offset ".$offset);
		if ($query->num_rows() > 0) {
			return $query->result();
		}
		return 0;
	}
	
	//end reject worker
	//end waiting worker
	/*Search Start*/
	
	/*** get total user 
	*  return number
	**/
	function get_total_search_worker_count($option,$keyword)
	{
		$keyword=str_replace('"','',str_replace(array("'",",","%","$","&","*","#","(",")",":",";",">","<","/"),'',$keyword));
		
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('worker', 'worker.user_id= user.user_id','left');
		
				
		if($option=='username')
		{
			$this->db->like('user.full_name	',$keyword);
			
			if(substr_count($keyword,' ')>=1)
			{
				$ex=explode(' ',$keyword);
				
				foreach($ex as $val)
				{
					$this->db->like('user.full_name	',$val);
				}	
			}

			
		}
		
		$this->db->order_by("user.user_id", "desc"); 
		
		
		$query = $this->db->get();
		
		
		return $query->num_rows();
	}
	
	
	/*** get users details
	*  return multiple records array
	**/
	function get_search_worker_result($option,$keyword,$offset, $limit)
	{
		
		$keyword=str_replace('"','',str_replace(array("'",",","%","$","&","*","#","(",")",":",";",">","<","/"),'',$keyword));
		
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('worker', 'worker.user_id= user.user_id','left');

		if($option=='username')
		{
			$this->db->like('user.full_name	',$keyword);
			
			if(substr_count($keyword,' ')>=1)
			{
				$ex=explode(' ',$keyword);
				
				foreach($ex as $val)
				{
					$this->db->like('user.full_name	',$val);
				}	
			}

			
		}
		
		$this->db->order_by("user.user_id", "desc"); 
		$this->db->limit($limit,$offset);
		
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			//return $query->result_array();
			return $query->result();
		}
		return 0;
	}
	
	/*Search End*/
	
	function view_worker_count($id='')
	{
	 
	    $this->db->select('wrk.*,us.*,up.*');
		$this->db->from('worker wrk');
		$this->db->join('user us','wrk.user_id=us.user_id');
		$this->db->join('user_profile up','wrk.user_id=up.user_id');
		//$this->db->join('task tk','wrk.worker_id=tk.task_worker_id','left');
		$this->db->where('wrk.worker_id',$id);
		$query=$this->db->get();
		if($query->num_rows()>0)
		{		
			return $query->num_rows();
		}
		
		return 0;
		  
	}
	
	function view_worker_result($id='')
	{
	 
	    $this->db->select('wrk.*,us.*,up.*');
		$this->db->from('worker wrk');
		$this->db->join('user us','wrk.user_id=us.user_id');
		$this->db->join('user_profile up','wrk.user_id=up.user_id');
		//$this->db->join('task tk','wrk.worker_id=tk.task_worker_id','left');
		$this->db->where('wrk.worker_id',$id);
		$query=$this->db->get();
		if($query->num_rows()>0)
		{		
			return $query->row();
		}
		
		return 0;
		  
	}
	
	function get_sum_received_amount($user_id)
	{
		$this->db->select('SUM(total_user_price) as total');
		$this->db->from('wallet');
		$this->db->where('wallet.user_id',$user_id);
		$this->db->where('wallet.admin_status','Confirm');
		$query=$this->db->get();
		$result = $query->row();
		
		if($result->total == '' || $result->total == '0'){
			return '0.00';
		} else {
		 	return $result->total;
		}
		
	}
	
	function get_sum_fees_paid($user_id){
	
		$this->db->select('SUM(total_cut_price) as total');
		$this->db->from('wallet');
		$this->db->where('wallet.user_id',$user_id);
		$this->db->where('wallet.admin_status','Confirm');
		$query=$this->db->get();
		$result = $query->row();
		
		if($result->total == '' || $result->total == '0'){
			return '0.00';
		} else {
		 	return $result->total;
		}
	
	}
	
	
}
?>