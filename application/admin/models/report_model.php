<?php
class Report_model extends CI_Model {
	
    function Report_model()
    {
        parent::__construct();	
    }  	
	
	function get_total_search_task_count($option,$keyword,$cat='',$lbudget='',$hbudget='',$cityname='',$statename='')
	{
		$keyword=str_replace('"','',str_replace(array("'",",","%","$","&","*","#","(",")",":",";",">","<","/"),'',$keyword));
		
		$this->db->select('tk.*,us.*,c.*,ca.*');
		$this->db->from('task tk');
		$this->db->join('user us','tk.user_id=us.user_id');
		$this->db->join('worker wrk','tk.task_worker_id=wrk.worker_id','left');
		$this->db->join('user uswrk','wrk.user_id=uswrk.user_id','left');
		$this->db->join('city c','tk.task_city_id=c.city_id','left');
		$this->db->join('task_category ca','tk.task_category_id=ca.task_category_id','left');
		$this->db->where('tk.task_status',1);
		
		if($option=='username')
		{
		   $this->db->like('us.full_name',$keyword);
		   $this->db->or_like('us.first_name',$keyword);
		   $this->db->or_like('us.last_name',$keyword);
		}
		if($option=='taskname')
		{
		   $this->db->like('tk.task_name',$keyword);
		  
		}
		/*if($option=='city')
		{
			$this->db->like('c.city_name',$keyword);
		}*/
		if($option=='date')
		{		    
		     $keyword=date('Y-m-d', strtotime($keyword));
			 $this->db->like('tk.task_post_date',$keyword);
	  }		
		if($option=='budget')
		{
		   
			$this->db->where('tk.task_price >=',$lbudget);
			$this->db->where('tk.task_price <=',$hbudget);
	   }
		if($option=='ip')
		{		   
		   $this->db->where('tk.task_ip',$keyword);			
		}		
		if($option=='category')
		{		  
		   $this->db->like('ca.category_name',$keyword);			
		}		
		if($option=='city')
		{		  
		   $this->db->like('c.city_name',$keyword);			
		}		
		if($option=='state')
		{
			$state = $this->db->query("SELECT * FROM  ".$this->db->dbprefix('state')." st, ".$this->db->dbprefix('city')." c WHERE st.`state_name` =  '".$statename."' AND st.`state_id` = c.`state_id`");
			
			if($state->num_rows> 0){
			
				$state_city = $state->result();
				
				foreach($state_city as $st)
				{
					$cityname = $st->city_name;
					$this->db->like('c.city_name',$cityname);
				}
			}else {
				
				$this->db->like('c.city_name',$statename);
			}		
		}		
		$this->db->order_by('tk.task_activity_status','asc');
		$this->db->order_by('tk.task_id','desc');			
		
		$query=$this->db->get();		
		
		if($query->num_rows()>0)
		{		
			return $query->num_rows();
		}		
		return 0;		
	}
		
	/*** get tasks details
	*  return multiple records array
	**/
	function get_search_task_result($option,$keyword,$offset, $limit,$cat='',$lbudget='',$hbudget='',$cityname='',$statename='')
	{

		$keyword=str_replace('"','',str_replace(array("'",",","%","$","&","*","#","(",")",":",";",">","<","/"),'',$keyword));
		
		$this->db->select('tk.*,us.*,c.*,ca.*');
		$this->db->from('task tk');
		$this->db->join('user us','tk.user_id=us.user_id');
		$this->db->join('worker wrk','tk.task_worker_id=wrk.worker_id','left');
		$this->db->join('user uswrk','wrk.user_id=uswrk.user_id','left');
		$this->db->join('city c','tk.task_city_id=c.city_id','left');
		$this->db->join('task_category ca','tk.task_category_id=ca.task_category_id','left');
		$this->db->where('tk.task_status',1);
		
		if($option=='username')
		{
		   $this->db->like('us.full_name',$keyword);
		   $this->db->or_like('us.first_name',$keyword);
		   $this->db->or_like('us.last_name',$keyword);
		}
		if($option=='taskname')
		{
		   $this->db->like('tk.task_name',$keyword);		  
		}
		/*if($option=='city')
		{
			$this->db->like('c.city_name',$keyword);
		}*/
		if($option=='date')
		{		    
		     $keyword=date('Y-m-d', strtotime($keyword));
			 $this->db->like('tk.task_post_date',$keyword);
		 }		
		if($option=='budget')
		{		   
			$this->db->where('tk.task_price >=',$lbudget);
			$this->db->where('tk.task_price <=',$hbudget);
	   }
		if($option=='ip')
		{		   
		   $this->db->where('tk.task_ip',$keyword);			
		}		
		if($option=='category')
		{		  
		   $this->db->like('ca.category_name',$keyword);			
		}		
		if($option=='city')
		{		  
		   $this->db->like('c.city_name',$keyword);			
		}		
		if($option=='state')
		{
			$state = $this->db->query("SELECT * FROM  ".$this->db->dbprefix('state')." st, ".$this->db->dbprefix('city')." c WHERE st.`state_name` =  '".$statename."' AND st.`state_id` = c.`state_id`");
			
			if($state->num_rows> 0){
			
				$state_city = $state->result();
				
				foreach($state_city as $st)
				{
					$cityname = $st->city_name;
					$this->db->like('c.city_name',$cityname);
				}
			} else {
				
				$this->db->like('c.city_name',$statename);
			}		
		}		
		$this->db->order_by('tk.task_activity_status','asc');
		$this->db->order_by('tk.task_id','desc');
		$this->db->limit($limit,$offset);
		
		$query=$this->db->get();
		
		if($query->num_rows()>0)
		{		
			return $query->result();
		}		
		return 0;		
	}
		
		
	function get_category()
	{	   
	     $query = $this->db->get('task_category');
		 if ($query->num_rows() > 0) 
		{		
			return $query->result();
		}	
		return 0;
	} 
	
}	
?>