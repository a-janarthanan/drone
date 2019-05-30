<?php
class User_task_model extends CI_Model 
{

	/*
	Function name :User_task_model
	Description :its default constuctor which called when user_task_model object initialzie.its load necesary parent constructor
	*/
	function User_task_model()
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
	Function name :cancel_task()
	Parameter : $task_id (task id)
	Return : none
	Use : task poster can manually cancel the task
	*/
	
	function cancel_task($task_id)
	{
		
		$task_detail=$this->get_task_detail($task_id);
		
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
		
		
		
		$data=array(
		'task_close_date'=>$post_date,
		'task_activity_status'=>3
		);
		
		$this->db->update('task',$data);
	}
	
	
	/*
	Function name :pay_now()
	Parameter : $task_id (task id)
	Return : none
	Use : task poster pay the task final offer price amount to administrator
	*/
	
	
	function pay_now($task_id)
	{
		
		
		$this->db->select('*');
		$this->db->from('task');
		$this->db->join('task_category','task.task_category_id=task_category.task_category_id');
		$this->db->join('city','task.task_city_id=city.city_id');
		$this->db->where('task.task_id',$task_id);
		$query=$this->db->get();
		
		
		if($query->num_rows()>0)
		{
			$task_detail= $query->row();
		}
		
		else
		{
			return false;
		}
		
		
		$task_setting=task_setting();
		
		$total=0;
		
		if($task_detail->extra_cost>0) {
		
		$total=$total+$task_detail->extra_cost;
		
		}
		
		
		
		
		
		 $price = $this->offer_price($task_detail->task_worker_id,$task_id); 
	 
		 $total=$total+$price->offer_amount;
		 
		 
		  $task_site_fee=0;
		  
		 if($task_setting->task_post_fee>0) {
		 
		 $task_site_fee=number_format((($task_setting->task_post_fee*$total) / 100),2); 
	
			 $total=$total+$task_site_fee;
	
		}
		 
		 
		 
		 
		
		
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
		
		
		 
		 $total=number_format($total,2);
		 
		 $total=str_replace(',','',number_format($total,2));
		 
		$trans_id='WL'.randomCode();
		
		$data_transaction=array(
		'user_id'=>get_authenticateUserID(),
		'task_id'=>$task_id,
		'task_amount'=>$total,
		'host_ip'=>$_SERVER['REMOTE_ADDR'],
		'transaction_date_time'=>$post_date,
		'wallet_transaction_id'=>$trans_id,
		
		);
		
		
		$this->db->insert('transaction',$data_transaction);
		
		
		
		$data_wallet=array(
		'credit'=>$total,
		'user_id'=>get_authenticateUserID(),
		'admin_status'=>'Confirm',
		'wallet_date'=>$post_date,
		'wallet_transaction_id'=>$trans_id,
		'wallet_ip'=>$_SERVER['REMOTE_ADDR'],
		'task_id'=>$task_id,	
		'total_cut_price'=> $task_site_fee	
		);
		
		$this->db->insert('wallet',$data_wallet);
		
		
		 
		
	}
	
	
	
	/*
	Function name :get_task_list()
	Parameter : $limit (for paging), $offset (for paging)
	Return : array of all tasks
	Use : user all tasks
	*/
	
	function get_task_list($limit,$offset)
	{

	    $this->db->select('*');
		$this->db->from('task');
		$this->db->join('user','task.user_id=user.user_id');
		$this->db->where('user.user_id',get_authenticateUserID());
		$this->db->where('task.task_status',1);
		$this->db->order_by('task.task_activity_status asc');
		$this->db->limit($limit,$offset);
		$query = $this->db->get(); 
		
		if($query->num_rows > 0) {
			return $query->result();
		}
		 return 0;
	}
	
	/*
	Function name :get_total_tasks()
	Parameter : none
	Return : integer all task count
	Use : user total number of tasks
	*/
	
	function get_total_tasks()
	{
		
		$this->db->select('*');
		$this->db->from('task');
		$this->db->join('user','task.user_id=user.user_id');
		$this->db->where('user.user_id',get_authenticateUserID());
		$this->db->where('task.task_status',1);
		$this->db->order_by('task.task_activity_status asc');
		$query = $this->db->get();
		return $query->num_rows();
	
	}
	
	
	/*
	Function name :get_assigned_task_list()
	Parameter : $limit (for paging), $offset (for paging)
	Return : array of all assigned tasks
	Use : user all assigned tasks
	*/
	
	function get_assigned_task_list($limit,$offset)
	{
		$id = array(1,2);
		
		$this->db->select('*');
		$this->db->from('task');
		$this->db->join('user','task.user_id=user.user_id');
		$this->db->where('user.user_id',get_authenticateUserID());
		$this->db->where('task.task_status',1);
		$this->db->where_in('task.task_activity_status',$id);
		$this->db->order_by('task.task_activity_status asc');
		$this->db->limit($limit,$offset);
		$query = $this->db->get();

		if($query->num_rows > 0) {
			return $query->result();
		}
		 return 0;
	}
	
	/*
	Function name :get_total_assigned_task()
	Parameter : none
	Return : integer all assigned task count
	Use : user total number of assigned tasks
	*/
	
	function get_total_assigned_task()
	{

		$id = array(1,2);
		
		$this->db->select('*');
		$this->db->from('task');
		$this->db->join('user','task.user_id=user.user_id');
		$this->db->where('user.user_id',get_authenticateUserID());
		$this->db->where('task.task_status',1);
		$this->db->where_in('task.task_activity_status',$id);
		$this->db->order_by('task.task_activity_status asc');
		$query = $this->db->get();

		return $query->num_rows();
	
	}
	
	/*
	Function name :get_closed_task_list()
	Parameter : $limit (for paging), $offset (for paging)
	Return : array of all closed tasks
	Use : user all closed tasks
	*/
	
	function get_closed_task_list($limit,$offset)
	{
		
		$this->db->select('*');
		$this->db->from('task');
		$this->db->join('user','task.user_id=user.user_id');
		$this->db->where('user.user_id',get_authenticateUserID());
		$this->db->where('task.task_status',1);
		$this->db->where('task.task_activity_status',3);
		$this->db->order_by('task.task_activity_status asc');
		$this->db->limit($limit,$offset);
		$query = $this->db->get();
		
		if($query->num_rows > 0) {
			return $query->result();
		}
		 return 0;
	}
	
	/*
	Function name :get_total_closed_task()
	Parameter : none
	Return : integer all closed task count
	Use : user total number of closed tasks
	*/
	function get_total_closed_task()
	{

		$this->db->select('*');
		$this->db->from('task');
		$this->db->join('user','task.user_id=user.user_id');
		$this->db->where('user.user_id',get_authenticateUserID());
		$this->db->where('task.task_status',1);
		$this->db->where('task.task_activity_status',3);
		$this->db->order_by('task.task_activity_status asc');
		$query = $this->db->get();

		return $query->num_rows();
	
	}
	
	
	/*
	Function name :get_open_task_list()
	Parameter : $limit (for paging), $offset (for paging)
	Return : array of all open tasks
	Use : user all open tasks
	*/
	
	function get_open_task_list($limit,$offset)
	{
		
		$this->db->select('*');
		$this->db->from('task');
		$this->db->join('user','task.user_id=user.user_id');
		$this->db->where('user.user_id',get_authenticateUserID());
		$this->db->where('task.task_status',1);
		$this->db->where('task.task_activity_status',0);
		$this->db->order_by('task.task_activity_status asc');
		$this->db->limit($limit,$offset);
		$query = $this->db->get();
		if($query->num_rows > 0) {
			return $query->result();
		}
		 return 0;
	}
	
	/*
	Function name :get_total_open_task()
	Parameter : none
	Return : integer all open task count
	Use : user total number of open tasks
	*/
	
	function get_total_open_task()
	{

		$this->db->select('*');
		$this->db->from('task');
		$this->db->join('user','task.user_id=user.user_id');
		$this->db->where('user.user_id',get_authenticateUserID());
		$this->db->where('task.task_status',1);
		$this->db->where('task.task_activity_status',0);
		$this->db->order_by('task.task_activity_status asc');
		$query = $this->db->get();

		return $query->num_rows();
	
	}
	
	
	/*
	Function name :get_recurring_list()
	Parameter : $limit (for paging), $offset (for paging)
	Return : array of all recurring tasks
	Use : user all recurring tasks
	*/
	
	function get_recurring_list($limit,$offset)
	{	
		
		$this->db->select('*');
		$this->db->from('task');
		$this->db->join('user','task.user_id=user.user_id');
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
	Return : integer all recurring task count
	Use : user total number of recurring tasks
	*/
	
	function get_total_recurring()
	{
		$this->db->select('*');
		$this->db->from('task');
		$this->db->join('user','task.user_id=user.user_id');
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
	Return : array of all scheduled tasks
	Use : user all scheduled tasks
	*/
	
	function get_scheduled_list($limit,$offset)
	{	
		
		$this->db->select('*');
		$this->db->from('task');
		$this->db->join('user','task.user_id=user.user_id');
		$this->db->where('user.user_id',get_authenticateUserID());
		$this->db->where('task.task_status',1);
		$this->db->where('task.task_online',1);
		$this->db->order_by('task.task_activity_status asc');
		$this->db->limit($limit,$offset);
		$query = $this->db->get();
		return $query->result();
	}
	
	/*
	Function name :get_total_scheduled()
	Parameter : none
	Return : integer all scheduled task count
	Use : user total number of scheduled tasks
	*/
	function get_total_scheduled()
	{
		$this->db->select('*');
		$this->db->from('task');
		$this->db->join('user','task.user_id=user.user_id');
		$this->db->where('user.user_id',get_authenticateUserID());
		$this->db->where('task.task_status',1);
		$this->db->where('task.task_online',1);
		$this->db->order_by('task.task_activity_status asc');
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	
	/*
	Function name :get_all_offer_on_task()
	Parameter : $task_id(task id), $limit (for paging), $offset (for paging)
	Return : array of all runners offers on task
	Use : runners list of offers on one task 
	*/
	
	
	function get_all_offer_on_task($task_id,$limit,$offset)
	{
		$this->db->select('*');
		$this->db->from('worker_comment');
		$this->db->join('user','worker_comment.comment_post_user_id=user.user_id');
		$this->db->join('user_profile','worker_comment.comment_post_user_id=user_profile.user_id');
		$this->db->join('worker','worker_comment.comment_post_user_id=worker.user_id');
		$this->db->where('worker_comment.task_id',$task_id);
		$this->db->where('worker_comment.offer_amount >',0.00);
		$this->db->where('worker_comment.comment_post_user_id !=',get_authenticateUserID());
		$this->db->order_by('worker_comment.task_comment_id desc');
		$this->db->group_by('worker_comment.comment_post_user_id desc');
			$this->db->limit($limit,$offset);
		$query = $this->db->get();
		
		if($query->num_rows>0) 
		{
			return $query->result();
			
		} 	
		
		return 0;
		
	}
	
	
	/*
	Function name :get_total_offer_on_task()
	Parameter :  $task_id(task id)
	Return : integer all runners offers on task count
	Use : total number of runners list of offers on one task 
	*/
	function get_total_offer_on_task($task_id)
	{
		$this->db->select('*');
		$this->db->from('worker_comment');
		$this->db->join('user','worker_comment.comment_post_user_id=user.user_id');
		$this->db->join('worker','worker_comment.comment_post_user_id=worker.user_id');
		$this->db->where('worker_comment.task_id',$task_id);
		$this->db->where('worker_comment.offer_amount >',0.00);
		$this->db->where('worker_comment.comment_post_user_id !=',get_authenticateUserID());
		$this->db->order_by('worker_comment.task_comment_id desc');
		$this->db->group_by('worker_comment.comment_post_user_id desc');
		$query = $this->db->get();
		
		
			return $query->num_rows();
		
	}
	
	
	
	
	/*
	Function name :offer_price()
	Parameter : $uid(user id), $task_id(task id)
	Return : array of runner offer detail
	Use : get runner offer details
	*/
	
	function offer_price($uid,$task_id)
	{
	
	
		$this->db->select('*');
		$this->db->from('worker_comment');
		$this->db->join('user','worker_comment.comment_post_user_id=user.user_id');
		$this->db->join('worker','user.user_id=worker.user_id');
		$this->db->where('worker.worker_id',$uid);
		$this->db->where('worker_comment.task_id',$task_id);
		$this->db->where('worker_comment.offer_amount > ','0.00');
		$query = $this->db->get();
		
		
		return $query->row();	
	}
	
	/*
	Function name :get_all_comments()
	Parameter : $uid(user id), $task_id(task id), $task_user_id (task poster user id)
	Return : array of all private comments on task
	Use : get all private conversations on task between runner and task poster
	*/
	
	function get_all_comments($uid,$task_id,$task_user_id)
	{
		$ids= $uid.','.$task_user_id;

		$query = $this->db->query("select * from ".$this->db->dbprefix('worker_comment')." where is_public=0 and task_id = '".$task_id."' and (comment_post_user_id in (".$ids.") and comment_to_user_id in (".$ids.") ) order by task_comment_id asc");
		
		return $query->result();
	}
	
	
	/*
	Function name :new_comment()
	Parameter : none
	Return : none
	Use : add new conversation from task poster to runner
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
		
		
		
		
		$act = 'newconversation';
		
		if( $this->input->post('accept') == 'Accept Offer') { 
			$is_accept = 1;
			$data = array(
				'task_worker_id' =>$this->input->post('worker_id'),
				'task_assigned_date' => $post_date, 
				'task_activity_status' => 1
			);
			$this->db->where('task_id',$this->input->post('task_id')); 
			$this->db->update('task', $data); 
			
			$act = 'offeraccept';
			
			
		
		} else { $is_accept = 0; }
		
		
		
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
		
		
		
		/////////======
		
		$message = array(
			'act' => $act,
			'task_id' => $this->input->post('task_id'),
			'poster_user_id' => get_authenticateUserID(),
			'receiver_user_id' => $this->input->post('task_user'),
			'is_read' => 0,
			'message_date' => $post_date
	   );
	   $this->db->insert('message', $message);

		
		
	}
	
	
	/*
	Function name :get_task_user()
	Parameter : $task_id(task id)
	Return : integer user id
	Use : get task poster user id
	*/
	
	function get_task_user($task_id)
	{
		$query = $this->db->get_where("task",array('task_id'=>$task_id));
		$task = $query->row();
		return $task->user_id;
	}
	
	/*
	Function name :get_task_worker()
	Parameter : $user_id(user id)
	Return : integer user id
	Use : get task runner user id
	*/
	
	function get_task_worker($user_id)
	{
		$this->db->select('*');
		$this->db->from('task');
		$this->db->join('worker','task.task_worker_id=worker.worker_id');
		$this->db->join('user','worker.user_id=user.user_id');
		$this->db->where('task.task_worker_id',$user_id);
		$query = $this->db->get(); 
		$task = $query->row();
		return $task->user_id;
	}
	
	/*
	Function name :get_last_comment()
	Parameter : $task_id(task id), $user_id(user id)
	Return : string comment
	Use : get runner feedback on complete task
	*/
	
	function get_last_comment($task_id,$user_id)
	{
		
		$ids = $user_id;
		$query = $this->db->query("select * from ".$this->db->dbprefix('worker_comment')." where task_id = '".$task_id."' and (comment_post_user_id = '".$ids."') order by task_comment_id desc");
		
		if($query->num_rows>0) 
		{
			$comment = $query->row();
			return $comment->task_comment;
			
		} 	
		
		return 0;
		
		
	}
	
	
	
	/*
	Function name :complete()
	Parameter : none
	Return : none
	Use : task poster can give feedback and rating to runner and complete - close the task 
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
				$poster_agree = 1;
				$worker_agree = 1;
			} else {
				$task_activity_status = 4;
				$poster_agree = 0;
				$worker_agree = 1;
			}
			$data = array(
				'poster_agree' =>$poster_agree,
				'worker_agree' => $worker_agree,
				'task_activity_status' => $task_activity_status, 
				'task_complete_date' => $post_date
			);
			
			$act='taskcomplete';	
		
		} elseif($this->input->post('sub_task') == 'Submit & Closed') { 
		
			if($this->input->post('complete') == 1) { 
				$task_activity_status = 3;
				$poster_agree = 1;
				$worker_agree = 1;
			} else {
				$task_activity_status = 4;
				$poster_agree = 0;
				$worker_agree = 1;
			}
			$data = array(
				'poster_agree' =>$poster_agree,
				'worker_agree' => $worker_agree,
				'task_activity_status' => $task_activity_status, 
				'task_close_date' => $post_date,
				'task_complete_date' => $post_date
			);
			
			$act='taskfinish';	
		}
		
		$this->db->where('task_id',$this->input->post('task_id')); 
		$this->db->update('task', $data); 
		
		
		$worker_id = $this->input->post('worker_id');
		$query = $this->db->get_where('worker',array('worker_id'=>$worker_id));
		$worker = $query->row();
		
		$data1 = array(					
			'comment_to_user_id' => $worker->user_id,
			'task_comment' =>strip_tags($this->input->post('comment')),
			'comment_rate'=>$this->input->post('comment_rate'),
			'task_id' => $this->input->post('task_id'),
			'comment_post_user_id' => get_authenticateUserID(),
			'comment_date' => $post_date,
			'is_final'=>1
		);
		//echo '<pre>'; print_r($data);print_r($data1); die();
		
		$this->db->insert('worker_comment', $data1);
		
		
		/////////===
		
		
		$message = array(
			'act' => $act,
			'task_id' => $this->input->post('task_id'),
			'poster_user_id' => get_authenticateUserID(),
			'receiver_user_id' => $worker->user_id,
			'is_read' => 0,
			'message_date' => $post_date
	    );
	    $this->db->insert('message', $message);


 
	}
	
	
	/*
	Function name :get_worker_info()
	Parameter : $user_id(user id)
	Return : array of user detail
	Use : get runner details
	*/
	
	function get_worker_info($user_id)
	{
		$this->db->select('*');
		$this->db->from('worker');
		$this->db->join('user','worker.user_id=user.user_id');
		$this->db->join('user_profile','worker.user_id=user_profile.user_id');			
		$this->db->where('user.user_id',$user_id);	
		
		$query = $this->db->get();
		
		return $query->row();
	}
	
}
?>