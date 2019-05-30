<?php
class Assign_model extends CI_Model {

	/*
	Function name :Assign_model
	Description :its default constuctor which called when Assign_model object initialzie.its load necesary parent constructor
	*/
	
	function Assign_model()
    {
        parent::__construct();	
    } 
	
	
	/*
	Function name :get_task()
	Parameter : none
	Return : array of task details
	Use : get task details
	*/
	
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
	
	
	/*
	Function name :get_worker_bid()
	Parameter : $task_id (task id)
	Return : array of runners bid comment of task
	Use : get runners bid comment of task
	*/
	
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
	
	
	/*
	Function name :get_task_detail()
	Parameter : $task_id (task id)
	Return : array of task details
	Use : get task details
	*/

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
	
	
	/*
	Function name :assign_task_worker()
	Parameter : $task_id (task id), $user_id(user id)
	Return : none
	Use : assign runner for task
	*/

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
	
	
	/*
	Function name :close_task()
	Parameter : $task_id (task id)
	Return : none
	Use : close task
	*/
	
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
	
	
	/*
	Function name :get_task_for_close()
	Parameter : none
	Return : array of closed task details
	Use : get task for close who have auto assignment is 3
	*/
	
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
	
	
}

?>