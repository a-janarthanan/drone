<?php
class Worker_task_model extends CI_Model 
{

	/*
	Function name :Worker_task_model
	Description :its default constuctor which called when worker_task_model object initialzie.its load necesary parent constructor
	*/
	function Worker_task_model()
    {
        parent::__construct();	
    } 
	
	
	/*
	Function name :get_task_detail()
	Parameter : $task_id (task id)
	Return : array of task detail
	Use : get task detail
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
	Function name :new_comment_complete()
	Parameter : none
	Return : none
	Use : add new conversation from runner to task poster and complete the task
	*/
	
	
	function new_comment_complete()
	{
		
		
		
		
		$task_detail=$this->get_task_detail($this->input->post('task_id'));
		
		$post_date=date('Y-m-d H:i:s');
		
		$city_detail=get_cityDetail($task_detail->task_city_id);
		
		if($city_detail)
		{	
			$dateTime = new DateTime("now", new DateTimeZone('America/Los_Angeles'));	 
			$task_timezone=tzOffsetToName($city_detail->city_timezone);			
			$dateTimeZone = new DateTimeZone($task_timezone);
			$dateTime->setTimezone($dateTimeZone); 
			$post_date= $dateTime->format("Y-m-d H:i:s");
			
		}
		
		
		
		
		
		if( $this->input->post('accept') == 'Accept Offer') { 
			$is_accept = 1;
			$data = array(
				'task_worker_id' =>$this->input->post('worker_id'),
				'task_assigned_date' => $post_date, 
				'task_activity_status' => 1
			);
			$this->db->where('task_id',$this->input->post('task_id')); 
			$this->db->update('task', $data); 
		
		} 
		
		elseif($this->input->post('complete'))
		{
				
			$data_t = array(
				'worker_agree' =>1,
				'task_activity_status' => 2, 
				'task_complete_date' => $post_date
			);	
			
			$this->db->where('task_id',$this->input->post('task_id')); 
			$this->db->update('task', $data_t); 
			
			$is_accept = 0;
		}
		
		else { $is_accept = 0; }
		
		
		
		$data1 = array(					
			'comment_to_user_id' => $this->input->post('task_user'),
			'task_comment' => $this->input->post('comment'),
			'task_id' => $this->input->post('task_id'),
			'comment_post_user_id' => $this->input->post('post_user_id'),
			'comment_date' => $post_date,		
		);
		
		
		//echo '<pre>'; print_r($data);print_r($data1); die();
		$this->db->insert('worker_comment', $data1); 
		
		
		if($is_accept==1)
		{
			$this->db->where('comment_post_user_id',$this->input->post('task_user'));
			$this->db->where('task_id',$this->input->post('task_id'));
			$this->db->where('offer_amount >',0);
			
			$data_update=array(
				'is_accept'=>1
			) ;
			
			$this->db->update('worker_comment',$data_update);
		}
		
		
		
		$message = array(
			'act' => 'taskcomplete',
			'task_id' => $this->input->post('task_id'),
			'poster_user_id' => get_authenticateUserID(),
			'receiver_user_id' => $this->input->post('task_user'),
			'is_read' => 0,
			'message_date' => $post_date
	    );
	    $this->db->insert('message', $message);

	   
	   
		
		
		
	}
	
	
	/*
	Function name :new_comment()
	Parameter : none
	Return : none
	Use : add new conversation from runner to task poster
	*/
	
	
	function new_comment()
	{
		
		
		$task_detail=$this->get_task_detail($this->input->post('task_id'));
		
		$post_date=date('Y-m-d H:i:s');
		
		$city_detail=get_cityDetail($task_detail->task_city_id);
		
		if($city_detail)
		{	
			$dateTime = new DateTime("now", new DateTimeZone('America/Los_Angeles'));	 
			$task_timezone=tzOffsetToName($city_detail->city_timezone);			
			$dateTimeZone = new DateTimeZone($task_timezone);
			$dateTime->setTimezone($dateTimeZone); 
			$post_date= $dateTime->format("Y-m-d H:i:s");
			
		}
		
		
		
		
		if( $this->input->post('accept') == 'Accept Offer') { 
			$is_accept = 1;
			$data = array(
				'task_worker_id' =>$this->input->post('worker_id'),
				'task_assigned_date' => $post_date, 
				'task_activity_status' => 1
			);
			$this->db->where('task_id',$this->input->post('task_id')); 
			$this->db->update('task', $data); 
		
		} else { $is_accept = 0; }
		
		
		
		$data1 = array(					
			'comment_to_user_id' => $this->input->post('task_user'),
			'task_comment' => $this->input->post('comment'),
			'task_id' => $this->input->post('task_id'),
			'comment_post_user_id' => $this->input->post('post_user_id'),
			'comment_date' => $post_date	
		);
		
		
		//echo '<pre>'; print_r($data);print_r($data1); die();
		$this->db->insert('worker_comment', $data1); 
		
		
		if($is_accept==1)
		{
			$this->db->where('comment_post_user_id',$this->input->post('task_user'));
			$this->db->where('task_id',$this->input->post('task_id'));
			$this->db->where('offer_amount >',0);
			
			$data_update=array(
				'is_accept'=>1
			) ;
			
			$this->db->update('worker_comment',$data_update);
		}
		
		
		
		
		
		
		$message = array(
			'act' => 'newconversation',
			'task_id' => $this->input->post('task_id'),
			'poster_user_id' => get_authenticateUserID(),
			'receiver_user_id' => $this->input->post('task_user'),
			'is_read' => 0,
			'message_date' => $post_date
	   );
	   $this->db->insert('message', $message);

		
		
	}
	
	
	
	/*
	Function name :get_total_loss_tasks()
	Parameter : none
	Return : integer all runner lost task count
	Use : runner total number of lost tasks
	*/
	
	
	
	function get_total_loss_tasks()
	{
		
		$get_worker_detail=$this->db->get_where('worker',array('user_id'=>get_authenticateUserID()));
		
		if($get_worker_detail)
		{
		
			$worker_detail=$get_worker_detail->row();
			
			
		$this->db->select('*');
		$this->db->from('worker_comment');
		$this->db->join('user','worker_comment.comment_post_user_id=user.user_id');
		$this->db->join('task','worker_comment.task_id=task.task_id');
		$this->db->join('worker','user.user_id=worker.user_id');	
		$this->db->where('user.user_id',get_authenticateUserID());
		$this->db->where('task.task_status',1);
		$this->db->where('task.task_activity_status >',0);
		$this->db->where('task.task_worker_id !=',$worker_detail->worker_id);
		$this->db->where('worker_comment.offer_amount >',0.00);
		
		$query = $this->db->get(); 

		if($query->num_rows > 0) {
		
			return $query->num_rows();
		}
		 return 0;
		 
		  
		 }
		 
		 return 0;
		 
		 
	}
	
	/*
	Function name :get_loss_task_list()
	Parameter : $limit (for paging), $offset (for paging)
	Return : array of all runner lost tasks
	Use : runner all lost tasks
	*/
	
	function get_loss_task_list($limit,$offset)
	{
		$get_worker_detail=$this->db->get_where('worker',array('user_id'=>get_authenticateUserID()));
		
		if($get_worker_detail)
		{
		
			$worker_detail=$get_worker_detail->row();
			
			
		$this->db->select('*');
		$this->db->from('worker_comment');
		$this->db->join('user','worker_comment.comment_post_user_id=user.user_id');
		$this->db->join('task','worker_comment.task_id=task.task_id');
		$this->db->join('worker','user.user_id=worker.user_id');	
		$this->db->where('user.user_id',get_authenticateUserID());
		$this->db->where('task.task_status',1);
		$this->db->where('task.task_activity_status >',0);
		$this->db->where('task.task_worker_id !=',$worker_detail->worker_id);
		$this->db->where('worker_comment.offer_amount >',0.00);
		$this->db->limit($limit,$offset);
		$query = $this->db->get(); 

		if($query->num_rows > 0) {
		
			return $query->result();
		}
		 return 0;
		 
		 }
		 
		 return 0;
		 
	}
	
	
	/*
	Function name :get_task_list()
	Parameter : $limit (for paging), $offset (for paging)
	Return : array of all runner tasks
	Use : runner all tasks
	*/
	function get_task_list($limit,$offset)
	{

	
		$get_worker_detail=$this->db->get_where('worker',array('user_id'=>get_authenticateUserID()));
		
		if($get_worker_detail)
		{
		
		$worker_detail=$get_worker_detail->row();

	    $this->db->select('*');
		$this->db->from('worker_comment');
		$this->db->join('user','worker_comment.comment_post_user_id=user.user_id');
		$this->db->join('task','worker_comment.task_id=task.task_id');
		$this->db->join('worker','user.user_id=worker.user_id');	
		//$this->db->where('task.task_worker_id',$worker_detail->worker_id);
		$this->db->where('user.user_id',get_authenticateUserID());
		$this->db->where('task.task_status',1);
		$this->db->where('worker_comment.offer_amount >',0.00);
		$this->db->order_by('worker_comment.comment_date','desc');
		$this->db->group_by('task.task_id');
		$this->db->limit($limit,$offset);
		//echo $this->db->last_query();exit;
		$query = $this->db->get(); 

		if($query->num_rows > 0) {
		
			return $query->result();
		}
		 return 0;
		 
		 }
		 
		 return 0;
	}
	
	/*
	Function name :get_total_tasks()
	Parameter : none
	Return : integer all runner all task count
	Use : runner total number of all tasks
	*/
	
	function get_total_tasks()
	{
	
		$get_worker_detail=$this->db->get_where('worker',array('user_id'=>get_authenticateUserID()));
		
		if($get_worker_detail)
		{
		
		$worker_detail=$get_worker_detail->row();


		$this->db->select('*');
		$this->db->from('worker_comment');
		$this->db->join('user','worker_comment.comment_post_user_id=user.user_id');
		$this->db->join('task','worker_comment.task_id=task.task_id');
		$this->db->join('worker','user.user_id=worker.user_id');
		$this->db->where('user.user_id',get_authenticateUserID());	
		//$this->db->where('task.task_worker_id',$worker_detail->worker_id);
		$this->db->where('task.task_status',1);
		$this->db->where('worker_comment.offer_amount >',0.00);
		$this->db->order_by('worker_comment.comment_date','desc');
		$this->db->group_by('task.task_id');
		$query = $this->db->get(); 
		
		return $query->num_rows();
		}
		return 0;
	
	}
	
	
	/*
	Function name :get_assigned_task_list()
	Parameter : $limit (for paging), $offset (for paging)
	Return : array of all runner assigned tasks
	Use : runner all assigned tasks
	*/
	
	function get_assigned_task_list($limit,$offset)
	{
		
		$id = array(1,2);
		
		
		$get_worker_detail=$this->db->get_where('worker',array('user_id'=>get_authenticateUserID()));
		
		if($get_worker_detail)
		{
		
		$worker_detail=$get_worker_detail->row();
		
			
		
			$this->db->select('*');
			$this->db->from('worker_comment');
			$this->db->join('user','worker_comment.comment_post_user_id=user.user_id');
			$this->db->join('task','worker_comment.task_id=task.task_id');
			$this->db->join('worker','user.user_id=worker.user_id');	
			$this->db->where('task.task_worker_id',$worker_detail->worker_id);
			$this->db->where('task.task_status',1);
			$this->db->where('worker_comment.offer_amount >',0.00);
			$this->db->where_in('task.task_activity_status',$id);
			$this->db->order_by('task.task_assigned_date','desc');
			$this->db->group_by('task.task_id');
			$this->db->limit($limit,$offset);
			//echo $this->db->last_query();exit;
			$query = $this->db->get(); 
			
			
			
			
			
			if($query->num_rows > 0) {
				return $query->result();
			}
			 return 0;
			 
			}
			
			return 0;
	}
	
	/*
	Function name :get_total_assigned_task()
	Parameter : none
	Return : integer all runner assigned task count
	Use : runner total number of assigned tasks
	*/
	function get_total_assigned_task()
	{
	
		$id = array(1,2);
		
		
		
			$get_worker_detail=$this->db->get_where('worker',array('user_id'=>get_authenticateUserID()));
		
		if($get_worker_detail)
		{
		
		$worker_detail=$get_worker_detail->row();
		
		
		$this->db->select('*');
		$this->db->from('worker_comment');
		$this->db->join('user','worker_comment.comment_post_user_id=user.user_id');
		$this->db->join('task','worker_comment.task_id=task.task_id');
		$this->db->join('worker','user.user_id=worker.user_id');	
			$this->db->where('task.task_worker_id',$worker_detail->worker_id);
		$this->db->where('task.task_status',1);
		$this->db->where('worker_comment.offer_amount >',0.00);
		$this->db->where_in('task.task_activity_status',$id);
			$this->db->order_by('task.task_assigned_date','desc');
			$this->db->group_by('task.task_id');
		$query = $this->db->get();

		return $query->num_rows();
		
		}
		
		return 0;
	
	}
	
	
	
	/*
	Function name :get_closed_task_list()
	Parameter : $limit (for paging), $offset (for paging)
	Return : array of all runner closed tasks
	Use : runner all closed tasks
	*/
	function get_closed_task_list($limit,$offset)
	{

		$get_worker_detail=$this->db->get_where('worker',array('user_id'=>get_authenticateUserID()));
		
		if($get_worker_detail)
		{
		
			$worker_detail=$get_worker_detail->row();

			$this->db->select('*');
			$this->db->from('task');
			$this->db->join('worker','task.task_worker_id=worker.worker_id');
			$this->db->join('user','worker.user_id=user.user_id');
			//$this->db->where('user.user_id',get_authenticateUserID());
			$this->db->where('task.task_worker_id',$worker_detail->worker_id);
			$this->db->where('task.task_status',1);
			$this->db->where('task.task_activity_status',3);
			$this->db->order_by('task.task_activity_status asc');
			$this->db->limit($limit,$offset);
			$query = $this->db->get();
			if($query->num_rows > 0) {
				return $query->result();
			}
		}
		 return 0;
	}
	
	/*
	Function name :get_total_closed_task()
	Parameter : none
	Return : integer all runner closed task count
	Use : runner total number of closed tasks
	*/
	function get_total_closed_task()
	{

		$get_worker_detail=$this->db->get_where('worker',array('user_id'=>get_authenticateUserID()));
		
		if($get_worker_detail)
		{
		$worker_detail=$get_worker_detail->row();

		$this->db->select('*');
		$this->db->from('task');
		$this->db->join('worker','task.task_worker_id=worker.worker_id');
		$this->db->join('user','worker.user_id=user.user_id');
		//$this->db->where('user.user_id',get_authenticateUserID());
		$this->db->where('task.task_worker_id',$worker_detail->worker_id);
		$this->db->where('task.task_status',1);
		$this->db->where('task.task_activity_status',3);
		$this->db->order_by('task.task_activity_status asc');
		$query = $this->db->get();
		
		return $query->num_rows();
		}
	
	}
	
	
	/*
	Function name :get_open_task_list()
	Parameter : $limit (for paging), $offset (for paging)
	Return : array of all runner open tasks
	Use : runner all open tasks
	*/
	function get_open_task_list($limit,$offset)
	{
		$get_worker_detail=$this->db->get_where('worker',array('user_id'=>get_authenticateUserID()));
		
		if($get_worker_detail)
		{

		$worker_detail=$get_worker_detail->row();

		$this->db->select('*');
		$this->db->from('worker_comment');
		$this->db->join('user','worker_comment.comment_post_user_id=user.user_id');
		$this->db->join('task','worker_comment.task_id=task.task_id');
		$this->db->join('worker','user.user_id=worker.user_id');	
		$this->db->where('user.user_id',get_authenticateUserID());
		//$this->db->where('task.task_worker_id',$worker_detail->worker_id);
		$this->db->where('task.task_status',1);
		$this->db->where('task.task_activity_status',0);
		$this->db->where('worker_comment.offer_amount >',0.00);
		$this->db->order_by('worker_comment.comment_date','desc');
		$this->db->group_by('task.task_id');
		$this->db->limit($limit,$offset);
		
		
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
		
		if($query->num_rows > 0) {
			return $query->result();
		}
	}
		 return 0;
	}
	
	/*
	Function name :get_total_open_task()
	Parameter : none
	Return : integer all runner open task count
	Use : runner total number of open tasks
	*/
	function get_total_open_task()
	{

		$get_worker_detail=$this->db->get_where('worker',array('user_id'=>get_authenticateUserID()));
		
		if($get_worker_detail)
		{
			
		$worker_detail=$get_worker_detail->row();

		$this->db->select('*');
		$this->db->from('worker_comment');
		$this->db->join('user','worker_comment.comment_post_user_id=user.user_id');
		$this->db->join('task','worker_comment.task_id=task.task_id');
		$this->db->join('worker','user.user_id=worker.user_id');	
		$this->db->where('user.user_id',get_authenticateUserID());
		//$this->db->where('task.task_worker_id',$worker_detail->worker_id);
		$this->db->where('task.task_status',1);
		$this->db->where('task.task_activity_status',0);
		$this->db->where('worker_comment.offer_amount >',0.00);
		$query = $this->db->get();
		
		return $query->num_rows();
		}
	}
	
	
	/*
	Function name :get_recurring_list()
	Parameter : $limit (for paging), $offset (for paging)
	Return : array of all runner recurring tasks
	Use : runner all recurring tasks
	*/
	function get_recurring_list($limit,$offset)
	{	

		$this->db->select('*');
		$this->db->from('task');
		$this->db->join('worker','task.task_worker_id=worker.worker_id');
		$this->db->join('user','worker.user_id=user.user_id');
		$this->db->where('user.user_id',get_authenticateUserID());
		$this->db->where('task.task_status',1);
		$this->db->where('task.task_repeat',1);
		$this->db->order_by('task.task_activity_status asc');
		$this->db->limit($limit,$offset);
		$query = $this->db->get();
		
		return $query->result();
	}
	
	/*
	Function name :get_total_recurring()
	Parameter : none
	Return : integer all runner recurring task count
	Use : runner total number of recurring tasks
	*/
	function get_total_recurring()
	{
		
		$this->db->select('*');
		$this->db->from('task');
		$this->db->join('worker','task.task_worker_id=worker.worker_id');
		$this->db->join('user','worker.user_id=user.user_id');
		$this->db->where('user.user_id',get_authenticateUserID());
		$this->db->where('task.task_status',1);
		$this->db->where('task.task_repeat',1);
		$this->db->order_by('task.task_activity_status asc');
		$query = $this->db->get();
		
		return $query->num_rows();
	}
	
	
	/*
	Function name :get_scheduled_list()
	Parameter : $limit (for paging), $offset (for paging)
	Return : array of all runner scheduled tasks
	Use : runner all scheduled tasks
	*/
	function get_scheduled_list($limit,$offset)
	{	
		
		$this->db->select('*');
		$this->db->from('task');
		$this->db->join('worker','task.task_worker_id=worker.worker_id');
		$this->db->join('user','worker.user_id=user.user_id');
		$this->db->where('user.user_id',get_authenticateUserID());
		$this->db->where('task.task_status',1);
		$this->db->where('task.task_online',1);
		$this->db->order_by('task.task_activity_status asc');
		$this->db->limit($limit,$offset);
		$query = $this->db->get();
		return $query->result();
	}
	
	/*
	Function name :get_total_recurring()
	Parameter : none
	Return : integer all runner scheduled task count
	Use : runner total number of scheduled tasks
	*/
	function get_total_scheduled()
	{
	
		$this->db->select('*');
		$this->db->from('task');
		$this->db->join('worker','task.task_worker_id=worker.worker_id');
		$this->db->join('user','worker.user_id=user.user_id');
		$this->db->where('user.user_id',get_authenticateUserID());
		$this->db->where('task.task_status',1);
		$this->db->where('task.task_online',1);
		$this->db->order_by('task.task_activity_status asc');
		$query = $this->db->get();
		
		return $query->num_rows();
	}
	
	
	/*
	Function name :complete()
	Parameter : none
	Return : none
	Use : runner complete the task 
	*/
	
	function complete()
	{
		
		$task_detail=$this->get_task_detail($this->input->post('task_id'));
		
		$post_date=date('Y-m-d H:i:s');
		
		$city_detail=get_cityDetail($task_detail->task_city_id);
		
		if($city_detail)
		{	
			$dateTime = new DateTime("now", new DateTimeZone('America/Los_Angeles'));	 
			$task_timezone=tzOffsetToName($city_detail->city_timezone);			
			$dateTimeZone = new DateTimeZone($task_timezone);
			$dateTime->setTimezone($dateTimeZone); 
			$post_date= $dateTime->format("Y-m-d H:i:s");
			
		}
		
		
		
		
		
		if( $this->input->post('sub_task') == 'Submit') { 
		
			if($this->input->post('complete') == 1) { 
				$task_activity_status = 2;
				$worker_agree = 1;
			} else {
				$task_activity_status = 4;
				$worker_agree = 0;
			}
			$data = array(
				'worker_agree' =>$worker_agree,
				'task_activity_status' => $task_activity_status, 
				'task_complete_date' => $post_date
			);	
		
		} elseif($this->input->post('sub_task') == 'Submit & Closed') { 
		
			if($this->input->post('complete') == 1) { 
				$task_activity_status = 3;
				$worker_agree = 1;
			} else {
				$task_activity_status = 4;
				$worker_agree = 0;
			}
			$data = array(
				'worker_agree' =>$worker_agree,
				'task_activity_status' => $task_activity_status, 
				'task_close_date' => $post_date
			);
		}
		
		
		
		$this->db->where('task_id',$this->input->post('task_id')); 
		$this->db->update('task', $data); 
		
		$worker_id = $this->input->post('worker_id');
		$task_id = $this->input->post('task_id');
		$query = $this->db->get_where('task',array('task_worker_id'=>$worker_id,'task_id'=>$task_id));
		$task = $query->row();

		
		$data1 = array(					
			'comment_to_user_id' => $task->user_id,
			'task_comment' =>strip_tags($this->input->post('comment')),
			'comment_rate'=>$this->input->post('comment_rate'),
			'task_id' => $task_id,
			'comment_post_user_id' => get_authenticateUserID(),
			'comment_date' => $post_date,
			'is_final' => 1				
		);
		//echo '<pre>'; print_r($data);print_r($data1); die();
		$this->db->insert('worker_comment', $data1); 
	}
	
}
?>