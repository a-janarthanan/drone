<?php

class Task_model extends CI_Model {
	
    function Task_model()
    {
        parent::__construct();	
    }   

	/*** get total task 
	*  return number
	**/
	function get_total_task_count()
	{
		$query = $this->db->get_where('task',array('task_status'=>1));
		
		 if ($query->num_rows() > 0) {
			return $query->num_rows();
		}
		return 0;    
	}
	
	
	/*** get tasks details
	*  return multiple records array
	**/
	function get_task_result($offset, $limit)
	{
		$this->db->order_by('task_activity_status','asc');
		$query = $this->db->get_where('task',array('task_status'=>1),$limit,$offset);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		}
		return 0;
	}
	
	/*Search Start*/
	
	/*** get total task 
	*  return number
	**/
	function get_total_search_task_count($option,$keyword,$cat,$lbudget,$hbudget)
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
		$this->db->where('tk.task_status !=',2);
		
		
		
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
		if($option=='city')
		{
			$this->db->like('c.city_name',$keyword);
		}
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
		  
		   $this->db->where('ca.category_name',$cat);
			
		}
		
		
		$this->db->order_by('tk.task_id','desc');
		
		
		$query=$this->db->get();
		
		
	
		
		return $query->num_rows();
	}
	
	
	/*** get tasks details
	*  return multiple records array
	**/
	function get_search_task_result($option,$keyword,$offset, $limit,$cat,$lbudget,$hbudget)
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
		$this->db->where('tk.task_status !=',2);
		
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
		if($option=='city')
		{
			$this->db->like('c.city_name',$keyword);
		}
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
		  
		   $this->db->where('ca.category_name',$cat);
			
		}
		
		
		$this->db->order_by('tk.task_id','desc');
		$this->db->limit($limit,$offset);
		
		
		$query=$this->db->get();
		
		
	  
		
		if($query->num_rows()>0)
		{		
			return $query->result();
		}
		
		return 0;
		
	}
	
	
	function get_total_post_task_count()
	{
	   	$query=$this->db->query("select * from ".$this->db->dbprefix('task')." where task_status='1' and task_activity_status='0'");
		
		if($query->num_rows()>0)
		{	
			return $query->num_rows();
		}
		
		return 0;
	}
	
	function get_post_task_result($offset, $limit)
	{
		$query=$this->db->query( "select * from ".$this->db->dbprefix('task')." where task_status='1' and task_activity_status='0' order by task_id limit ".$limit." offset ".$offset);
		
		if($query->num_rows()>0)
		{	
			return $query->result();
		}
		
		return 0;
	}
	
	
	function get_no_of_bids($id)
	{
	   	$query=$this->db->query("select * from ".$this->db->dbprefix('worker_comment')." where	task_id='$id' and offer_amount >'0.00'");
		
		if($query->num_rows()>0)
		{	
			return $query->num_rows();
		}
		
		return 0;
	}
	
	function get_worker_name($id)
	{
	      	$query=$this->db->query("select * from ".$this->db->dbprefix('worker')." w left join ".$this->db->dbprefix('user')." us on w.user_id=us.user_id where w.worker_id ='$id'");
		
		if($query->num_rows()>0)
		{	$res = $query->row();
			return $res->full_name;
		}
		
		return 0;
	}
	/*Search End*/
	
	function get_total_close_task_count()
	{
	   	$query=$this->db->query("select * from ".$this->db->dbprefix('task')." where task_activity_status='3' and task_status !='2'");
		
		if($query->num_rows()>0)
		{	
			return $query->num_rows();
		}
		
		return 0;
	}
	
	function get_close_task_result($offset, $limit)
	{
		$query=$this->db->query( "select * from ".$this->db->dbprefix('task')." where task_activity_status='3' and task_status !='2' order by task_id limit ".$limit." offset ".$offset);
		
		if($query->num_rows()>0)
		{	
			return $query->result();
		}
		
		return 0;
	}
	
	function get_total_complete_task_count()
	{
	   	$query=$this->db->query("select * from ".$this->db->dbprefix('task')." where task_activity_status='2' and task_status !='2'");
		
		if($query->num_rows()>0)
		{	
			return $query->num_rows();
		}
		
		return 0;
	}
	
	function get_complete_task_result($offset, $limit)
	{
		$query=$this->db->query( "select * from ".$this->db->dbprefix('task')." where task_activity_status='2' and task_status !='2' order by task_id desc limit ".$limit." offset ".$offset);
		
		if($query->num_rows()>0)
		{	
			return $query->result();
		}
		
		return 0;
	}
	
	function get_total_suspend_task_count()
	{
	   	$query=$this->db->query("select * from ".$this->db->dbprefix('task')." where task_activity_status='4' and task_status !='2'");
		
		if($query->num_rows()>0)
		{	
			return $query->num_rows();
		}
		
		return 0;
	}
	
	function get_suspend_task_result($offset, $limit)
	{
		$query=$this->db->query( "select * from ".$this->db->dbprefix('task')." where task_activity_status='4' and task_status !='2' order by task_id limit ".$limit." offset ".$offset);
		
		if($query->num_rows()>0)
		{	
			return $query->result();
		}
		
		return 0;
	}
	
	function get_total_running_task_count()
	{
	   	$query=$this->db->query("select * from ".$this->db->dbprefix('task')." where task_activity_status='1' and task_status ='1' and task_worker_id>0");
		
		if($query->num_rows()>0)
		{	
			return $query->num_rows();
		}
		
		return 0;
	}
	
	function get_running_task_result($offset, $limit)
	{
		$query=$this->db->query( "select * from ".$this->db->dbprefix('task')." where task_activity_status =1 and task_status ='1' and task_worker_id>0 order by task_id limit ".$limit." offset ".$offset);
		
		if($query->num_rows()>0)
		{	
			return $query->result();
		}
		
		return 0;
	}
	
	function task_detail($task_id){
		$query=$this->db->query("select * from ".$this->db->dbprefix('task')." where task_id='".$task_id."'");
		
		if($query->num_rows()>0)
		{	
			return $query->row();
		}
		
		return 0;
	}
	
	
	
	
	/********get task bids ***/
	
	
	function get_total_task_offer($task_id,$user_id)
	{
		$this->db->select('*');
		$this->db->from('worker_comment');
		$this->db->join('user','worker_comment.comment_post_user_id=user.user_id');
		$this->db->join('user_profile','worker_comment.comment_post_user_id=user_profile.user_id');
		$this->db->join('worker','worker_comment.comment_post_user_id=worker.user_id');
		$this->db->where('worker_comment.task_id',$task_id);
		$this->db->where('worker_comment.offer_amount >',0.00);
		$this->db->where('worker_comment.is_public',0);
		$this->db->where('worker_comment.comment_post_user_id !=',$user_id);
		$this->db->order_by('worker_comment.task_comment_id','desc');

		$query = $this->db->get();
		
		if($query->num_rows()>0) 
		{
			return $query->num_rows();
			
		} 	
		
		return 0;
	}
	
	
	
	function get_task_offer($task_id,$user_id)
	{
		$this->db->select('*');
		$this->db->from('worker_comment');
		$this->db->join('user','worker_comment.comment_post_user_id=user.user_id');
		$this->db->join('user_profile','worker_comment.comment_post_user_id=user_profile.user_id');
		$this->db->join('worker','worker_comment.comment_post_user_id=worker.user_id');
		$this->db->where('worker_comment.task_id',$task_id);
		$this->db->where('worker_comment.offer_amount >',0.00);
		$this->db->where('worker_comment.is_public',0);
		$this->db->where('worker_comment.comment_post_user_id !=',$user_id);
		$this->db->order_by('worker_comment.task_comment_id','desc');

		$query = $this->db->get();
		
		if($query->num_rows()>0) 
		{
			return $query->result();
			
		} 	
		
		return 0;
	}
	
	
	
	function offer_price($wid,$task_id)
	{
	
	
		$this->db->select('*');
		$this->db->from('worker_comment');
		$this->db->join('user','worker_comment.comment_post_user_id=user.user_id');
		$this->db->join('worker','user.user_id=worker.user_id');
		$this->db->where('worker.worker_id',$wid);
		$this->db->where('worker_comment.task_id',$task_id);
		$this->db->where('worker_comment.offer_amount > ','0.00');
		$query = $this->db->get();
		
		
		return $query->row();	
	}
	
	function get_task_location($task_id)
	{
	
		$query=$this->db->get_where('task_location',array('task_id'=>$task_id));
		
		if($query->num_rows()>0)
		{
			return $query->result();
		}
		
		return 0;
	
	}
	
	function get_user_location_detail($user_location_id)
	{
		$query=$this->db->get_where('user_location',array('user_location_id'=>$user_location_id));
		
		if($query->num_rows()>0)
		{
			return $query->row();
		}
		
		return 0;
			
	}
	function escrow_amount()
	{
		$query=$this->db->query( "SELECT SUM(wc.offer_amount) as offer_amount FROM ".$this->db->dbprefix('worker_comment')." wc, ".$this->db->dbprefix('task')." t, ".$this->db->dbprefix('worker')." w where t.`task_id` = wc.`task_id` and t.task_worker_id =w.worker_id and w.user_id= wc.`comment_post_user_id` and wc.`offer_amount` >'0.00' and t.task_status = 1 and t.task_activity_status =1 and t.task_worker_id>0");
		$result = $query->row();


		return $result->offer_amount;
	}

}
?>