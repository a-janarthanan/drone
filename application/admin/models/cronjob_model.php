<?php
class Cronjob_model extends CI_Model {
	
    function Cronjob_model()
    {
       parent::__construct();
		
    }   
	
	function get_total_cronjob_count()
	{
		//return $this->db->count_all('cronjob');
		$this->db->select('cronjob.*,admin.username,crons.cron_title');
		$this->db->from('cronjob');
		$this->db->join('admin', 'cronjob.user_id= admin.admin_id','left');
		$this->db->join('crons', 'cronjob.cronjob= crons.cron_function','left');
		$this->db->order_by("cronjob.cronjob_id", "desc"); 
		$query = $this->db->get();

		return $query->num_rows();
	}
	
	function get_cronjob_result($offset, $limit)
	{
		
		//$this->db->order_by('cronjob_id','desc');
			
		//$query = $this->db->get('cronjob',$limit,$offset);
		
		$this->db->select('cronjob.*,admin.username,crons.cron_title');
		$this->db->from('cronjob');
		$this->db->join('admin', 'cronjob.user_id= admin.admin_id','left');
		$this->db->join('crons', 'cronjob.cronjob= crons.cron_function','left');
		$this->db->order_by("cronjob.cronjob_id", "desc"); 
		$this->db->limit($limit,$offset);
		$query = $this->db->get();
		
		if ($query->num_rows() > 0) {
			return $query->result();
		}
		return 0;
	}
	
	function get_cron_function(){
		$query = $this->db->get('crons');
		if($query->num_rows() > 0){
			return $query->result();
		}
		return 0;
	}
	
	//assign task function
	function get_task()
	{
		$this->db->select('*');
		$this->db->from('task');
		$this->db->where('task_status',1);
		$this->db->where('task_activity_status',0);
		
		$this->db->where('task_auto_assignment',1);
		$this->db->or_where('task_auto_assignment',2);
		$this->db->order_by('task_id','ASC');
		
		
		$query=$this->db->get();
				
		if($query->num_rows()>0)
		{
			return $query->result();
		}
		
		return 0;
			
	}
	
	function get_task_detail($task_id)
	{
		$this->db->select('*');
		$this->db->from('task');
		$this->db->join('task_category','task.task_category_id=task_category.task_category_id');
		$this->db->join('city','task.task_city_id=city.city_id');
		$this->db->where('task_id',$task_id);
		$query=$this->db->get();
		return $query->row();
	}
	
	function get_worker_bid($task_id)
	{
		$this->db->select('*');
		$this->db->from('worker_comment');
		$this->db->where('offer_amount >',0);
		$this->db->where('task_id',$task_id);		
		$this->db->order_by('comment_date','ASC');
		
		
		$query=$this->db->get();
		
		if($query->num_rows()>0)
		{
			return $query->result();
		}
		
		return 0;	
	}
	
	function assign_task_worker($task_id,$user_id)
	{
		
		
		$task_detail=$this->get_task_detail($task_id);
		
		
		/////===set time zone for task assign==========
				
				
		$task_assigned_date=date('Y-m-d H:i:s');

		$city_detail=get_cityDetail($task_detail->task_city_id);
		
		if($city_detail)
		{	
			$dateTime = new DateTime("now", new DateTimeZone('America/Los_Angeles'));	 
			$task_timezone=tzOffsetToName($city_detail->city_timezone);			
			$dateTimeZone = new DateTimeZone($task_timezone);
			$dateTime->setTimezone($dateTimeZone); 
			$task_assigned_date= $dateTime->format("Y-m-d H:i:s");
			
		}
				
				
				
				
		$this->db->select('*');
		$this->db->from('worker');
		$this->db->join('user','worker.user_id=user.user_id');
		$this->db->join('user_profile','worker.user_id=user_profile.user_id');			
		$this->db->where('worker.user_id',$user_id);	
		
		$query = $this->db->get();
		
		if($query->num_rows()>0)
		{
			$result=$query->row();
			
			
			$data=array(
			'task_worker_id'=>$result->worker_id,
			'task_activity_status'=>1,
			'task_assigned_date'=>$task_assigned_date			
			);
			
			$this->db->where('task_id',$task_id);
			$this->db->update('task',$data);
			
			$data_accept=array(
				'is_accept'=>1
			);
			
			
			$this->db->where('task_id',$task_id);
			$this->db->where('comment_post_user_id',$user_id);
			
			$this->db->update('worker_comment',$data_accept);
			
			
			
			//////====
			
			$task = $this->db->get_where('task',array('task_id'=>$task_id));
			$task_detail = $task->row();
			
			$message = array(
				'act' => 'taskassign',
				'task_id' => $task_id,
				'poster_user_id' => $task_detail->user_id,
				'receiver_user_id' => $user_id,
				'is_read' => 0,
				'message_date' => $task_assigned_date
	   		);
	    	$this->db->insert('message', $message);


			
			
		}	
	
	}
	
	function close_task($task_id)
	{
		
		
		
		$task_detail=$this->get_task_detail($task_id);
		
		
		/////===set time zone for task assign==========
				
				
		$task_close_date=date('Y-m-d H:i:s');

		$city_detail=get_cityDetail($task_detail->task_city_id);
		
		if($city_detail)
		{	
			$dateTime = new DateTime("now", new DateTimeZone('America/Los_Angeles'));	 
			$task_timezone=tzOffsetToName($city_detail->city_timezone);			
			$dateTimeZone = new DateTimeZone($task_timezone);
			$dateTime->setTimezone($dateTimeZone); 
			$task_close_date= $dateTime->format("Y-m-d H:i:s");
			
		}
				
				
				
				
		$data=array(
			'task_activity_status'=>3,
			'task_close_date'=>$task_close_date			
		);
			
			$this->db->where('task_id',$task_id);
			$this->db->update('task',$data);
		
	}
	
	
	//close task function
	/***** get task for close
	* who have auto assignment is 3
	***/
	function get_task_for_close()
	{
		$this->db->select('*');
		$this->db->from('task');
		$this->db->where('task_status',1);
		$this->db->where('task_activity_status',0);		
		$this->db->where('task_auto_assignment',3);
		$this->db->where('task_worker_id = ',0);
		$this->db->order_by('task_id','ASC');
		
		$query=$this->db->get();
		
		if($query->num_rows()>0)
		{
			return $query->result();
		}
		
		return 0;
	}
	
	
	//autocomplte task function
	function get_auto_task()
	{
		$this->db->select('*');
		$this->db->from('task');
		$this->db->where('task_status',1);
		$this->db->where('task_activity_status',2);
		$this->db->where('task_worker_id >',0);
		$this->db->where('worker_agree',1);
		$this->db->or_where('poster_agree',0);
		$this->db->order_by('task_id','ASC');
		
		
		$query=$this->db->get();
				
		if($query->num_rows()>0)
		{
			return $query->result();
		}
		
		return 0;
			
	}
	
	function user_added_task_price($user_id,$task_id)
	{
	
	
		$this->db->select('*');
		$this->db->from('wallet');
		$this->db->where('user_id',$user_id);
		$this->db->where('task_id',$task_id);
		$this->db->where('credit >',0);
		$this->db->order_by('id','DESC');
		
		$query=$this->db->get();
				
		if($query->num_rows()>0)
		{
			return $query->row();
		}
		
		return 0;
		
	
	}
	
	
	//user login function
	function get_all_login_user()
	{
		
		$get_user_login=$this->db->query("select * from ".$this->db->dbprefix('user_login')." where DATE(login_date_time)='".date('Y-m-d')."'  and login_status=1 group by user_id order by login_id desc");
		
			if($get_user_login->num_rows()>0)
			{					
				return $get_user_login->result();															
			}
		
		return 0;
	}
	
	
}	