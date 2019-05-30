<?php
class Search_model extends CI_Model 
{

	/*
	Function name :Search_model
	Description :its default constuctor which called when search_model object initialzie.its load necesary parent constructor
	*/
	function Search_model()
    {
        parent::__construct();	
    } 
	
	
	
	/*
	Function name :get_search_result()
	Parameter : $keyword(search word), $city_id(city id), $offset(for paging), $limit(for paging) 
	Return : array of all task list
	Use : get all searched task list
	*/
	
	function get_search_result($keyword,$city_id,$offset,$limit)
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
			
	
		
		$this->db->select('tk.*,us.*');
		$this->db->from('task tk');
		$this->db->join('user us','tk.user_id=us.user_id');
		$this->db->join('worker wrk','tk.task_worker_id=wrk.worker_id','left');
		$this->db->join('user uswrk','wrk.user_id=uswrk.user_id','left');
		$this->db->where('tk.task_status',1);
		
		
		if($user_status=='visitor')
		{
			$this->db->where('tk.task_is_private',0);		
		}
		
		if($city_id>0)
		{
			$this->db->where('tk.task_city_id',$city_id);
		}
		
		if($keyword!='') 
		{
		
			$this->db->like('tk.task_name',$keyword);
		$this->db->or_like('tk.task_description',$keyword);
		$this->db->or_like('uswrk.first_name',$keyword);
		$this->db->or_like('uswrk.last_name',$keyword);
		
		
			if(substr_count($keyword,' ')>=1)
			{
			
				$ex=explode(' ',$keyword);
				
				foreach($ex as $val)
				{
					$this->db->or_like('tk.task_name',$val);
					$this->db->or_like('tk.task_description',$val);
					$this->db->or_like('uswrk.first_name',$val);
					$this->db->or_like('uswrk.last_name',$val);
				}
			
			}

		}

		
		$this->db->order_by('tk.task_id','desc');
		$this->db->limit($limit,$offset);
		
		
		$query=$this->db->get();
		
		
	  // echo $this->db->last_query();
	  /* 
	   echo '<pre>';
	   print_r($query->result());
	   die();*/
		
		if($query->num_rows()>0)
		{		
			return $query->result();
		}
		
		return 0;
		
	
		
		
	}
	
	/*
	Function name :get_count_search_result()
	Parameter : $keyword(search word), $city_id(city id)
	Return : integer, count of all tasks
	Use : get total number of all searched tasks
	*/
	
	
	function get_count_search_result($keyword,$city_id)
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
			
	
		
		$this->db->select('tk.*,us.*');
		$this->db->from('task tk');
		$this->db->join('user us','tk.user_id=us.user_id');
		$this->db->join('worker wrk','tk.task_worker_id=wrk.worker_id','left');
		$this->db->join('user uswrk','wrk.user_id=uswrk.user_id','left');
		$this->db->where('tk.task_status',1);
		
		
		if($user_status=='visitor')
		{
			$this->db->where('tk.task_is_private',0);		
		}
		
		if($city_id>0)
		{
			$this->db->where('tk.task_city_id',$city_id);
		}
		
		
		if($keyword!='') 
		{
		
			$this->db->like('tk.task_name',$keyword);
		$this->db->or_like('tk.task_description',$keyword);
		$this->db->or_like('uswrk.first_name',$keyword);
		$this->db->or_like('uswrk.last_name',$keyword);
		
		
			if(substr_count($keyword,' ')>=1)
			{
			
				$ex=explode(' ',$keyword);
				
				foreach($ex as $val)
				{
					$this->db->or_like('tk.task_name',$val);
					$this->db->or_like('tk.task_description',$val);
					$this->db->or_like('uswrk.first_name',$val);
					$this->db->or_like('uswrk.last_name',$val);
				}
			
			}

		}


		
		$query=$this->db->get();
		
		
	
		
		if($query->num_rows()>0)
		{		
			return $query->num_rows();
		}
		
		return 0;
	}
	
	/*
	Function name :get_tasktypename()
	Parameter : $tasktypeid(task type id),
	Return : string  task type name
	Use : get task type name
	*/
	
	function get_tasktypename($tasktypeid){
		$query = $this->db->get_where("task_type",array('task_type_id'=>$tasktypeid));
		$result = $query->row();
		return  $result->task_name;
	}
	
	

}
?>