<?php
class Task_model extends CI_Model 
{
	
	
	/*
	Function name :Task_model
	Description :its default constuctor which called when Task_model object initialzie.its load necesary parent constructor
	*/	
	
	function Task_model()
    {
        parent::__construct();	
    } 
	
	
	/*
	Function name :get_tasks_details()
	Parameter : $task_name (task title seo friendly url unquie name)
	Return : array of task details
	Use : get task details
	*/
	
	function get_tasks_details($task_name)
	{
		
		$this->db->select('*');
		$this->db->from('task');
		$this->db->join('task_category','task.task_category_id=task_category.task_category_id');
		$this->db->join('city','task.task_city_id=city.city_id');
		$this->db->where('task.task_url_name',$task_name);
		$query=$this->db->get();
		
		
		if($query->num_rows()>0)
		{
			return  $query->row();
		}
		
		return 0;
	}
	
	
	
	/*
	Function name :get_tasks_detail_by_id()
	Parameter : $task_id (task id)
	Return : array of task details
	Use : get task details
	*/
	
	
	function get_tasks_detail_by_id($task_id)
	{
		$this->db->select('*');
		$this->db->from('task');
		$this->db->join('task_category','task.task_category_id=task_category.task_category_id');
		$this->db->join('city','task.task_city_id=city.city_id');
		$this->db->where('task.task_id',$task_id);
		$query=$this->db->get();
		
		
		if($query->num_rows()>0)
		{
			return  $query->row();
		}
		
		return 0;
	}
	
	
	
	/*
	Function name :get_similar_tasks()
	Parameter : $task_id (task id), $category_id (task category id)
	Return : array of same gategory tasks
	Use : get all tasks with same category except $task_id this function use on task detail page
	*/
	
	
	function get_similar_tasks($category_id,$task_id)
	{
				
		$this->db->select('*');
		$this->db->from('task');
		$this->db->join('user','task.user_id=user.user_id');		
		$this->db->join('city','task.task_city_id=city.city_id');
		$this->db->where('task.task_category_id',$category_id);
		$this->db->where('task.task_status',1);
		$this->db->where('task.task_id !=',$task_id);
		
		$query=$this->db->get();
		
		if($query->num_rows()>0)
		{	
			return  $query->result();
		}
		
		return 0;
	}
	
	
	
	/*
	Function name :get_comments()
	Parameter : $task_id (task id)
	Return : array of task public message
	Use : get task all public message list this function use on task detail page
	*/
	
	
	function get_comments($taskid)
	{
		$this->db->select('*');
		$this->db->from('worker_comment');
		$this->db->join('user','worker_comment.comment_post_user_id=user.user_id');
		$this->db->where('worker_comment.task_id',$taskid);
		$this->db->where('worker_comment.is_final',0);
		$this->db->where('worker_comment.is_public',1);
		$this->db->where('worker_comment.reply_task_comment_id',0);
		$this->db->order_by('worker_comment.comment_date','ASC');
		
		$query = $this->db->get();
		
		if($query->num_rows > 0) 
		{
			return $query->result();
			
		} 	
		
		return 0;
		
	}
	
	
	
	/*
	Function name :get_final_comment()
	Parameter : $task_id (task id), $user_id(task poster id)
	Return : array of task complete time feedback
	Use : get worker feedback after successfully completing the task this function use on task detail page
	*/
	
	function get_final_comment($task_id,$user_id)
	{
		$this->db->select('*');
		$this->db->from('worker_comment');
		$this->db->where('task_id',$task_id);
		$this->db->where('comment_post_user_id',$user_id);
		$this->db->where('is_final',1);
		$this->db->limit(1);
		
		$query = $this->db->get();
		
		if($query->num_rows > 0) 
		{
			return $query->row();
			
		} 	
		
		return 0;
		
	}
	
	
	
	/*
	Function name :count_total_offer_on_task()
	Parameter : $task_id (task id)
	Return : integer of total of offer on task
	Use : get task total offer this function use on task detail page
	*/
	
	
	
	function count_total_offer_on_task($task_id)
	{
		
		
		$this->db->select('*');
		$this->db->from('worker_comment');
		$this->db->where('task_id',$task_id);
		$this->db->where('offer_amount >',0);
		
		
		$query = $this->db->get();
		
		if($query->num_rows>0) 
		{
			return $query->num_rows();
			
		} 	
		
		return 0;
		
	}
		
		
	
	/*
	Function name :get_task_offer()
	Parameter : $task_id (task id)
	Return : array get task all offers
	Use : get task all offers list this function use on task detail page
	*/
		
		
		
	function get_task_offer($task_id)
	{
		$this->db->select('*');
		$this->db->from('worker_comment');
		$this->db->join('user','worker_comment.comment_post_user_id=user.user_id');
		$this->db->join('user_profile','worker_comment.comment_post_user_id=user_profile.user_id');
		$this->db->join('worker','worker_comment.comment_post_user_id=worker.user_id');
		$this->db->where('worker_comment.task_id',$task_id);
		$this->db->where('worker_comment.offer_amount >',0.00);
		$this->db->where('worker_comment.comment_post_user_id !=',get_authenticateUserID());
		$this->db->order_by('worker_comment.task_comment_id asc');
		$this->db->group_by('worker_comment.comment_post_user_id desc');

		$query = $this->db->get();
		
		if($query->num_rows()>0) 
		{
			return $query->result();
			
		} 	
		
		return 0;
	}
	
	
	
	/*
	Function name :add_worker_public_question()
	Parameter : $task_id (task id)
	Return : none
	Use : add worker public question this function use on task detail page
	*/
		
		
		
	function add_worker_public_question($task_id)
	{
		$task_detail= $this->get_tasks_detail_by_id($task_id);
		$task_user_id=$task_detail->user_id;
		
		
		
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
		
		
		
		
		$data = array(	
				'task_comment' => strip_tags(trim($this->input->post('task_comment'))),
				'is_public' => 1,
				'task_id' => $task_id,
				'comment_post_user_id' => get_authenticateUserID(),
				'comment_to_user_id'=> $task_user_id,
				'comment_date' =>$post_date
			);
	  
	   $this->db->insert('worker_comment', $data);
	   
	   
	   ///////////======
	   
	   $message = array(
			'act' => 'newmessage',
			'task_id' => $task_id,
			'poster_user_id' => get_authenticateUserID(),
			'receiver_user_id' => $task_user_id,
			'is_read' => 0,
			'message_date' => $post_date
	  );
	  $this->db->insert('message', $message);

	

	}
	
	
	
	/*
	Function name :check_public_message_reply()
	Parameter : $task_comment_id (worker comment id)
	Return : boolean
	Use : check task poster have already reply to the worker public question this function use on task detail page
	*/
	
	
	function check_public_message_reply($task_comment_id)
	{
			$check_comment=$this->db->get_where('worker_comment',array('reply_task_comment_id'=>$task_comment_id));
			
			if($check_comment->num_rows()>0)
			{
				return true;
			}
			
			return false;
	}
	
	
	
	/*
	Function name :get_owner_public_reply()
	Parameter : $taskid, (task id), $task_comment_id (worker comment id)
	Return : array of reply message
	Use : get task poster reply for worker public question this function use on task detail page
	*/
	
	
	function get_owner_public_reply($taskid,$task_comment_id)
	{
						
		$this->db->select('*');
		$this->db->from('worker_comment');
		$this->db->join('user','worker_comment.comment_post_user_id=user.user_id');
		$this->db->where('worker_comment.task_id',$taskid);
		$this->db->where('worker_comment.is_final',0);
		$this->db->where('worker_comment.is_public',1);
		$this->db->where('worker_comment.reply_task_comment_id',$task_comment_id);
		$this->db->order_by('worker_comment.comment_date','ASC');
		
		$query = $this->db->get();
		
		if($query->num_rows > 0) 
		{
			return $query->row();
			
		} 	
		
		return 0;
		
			
	}
	
	
	
	/*
	Function name :add_task_owner_public_message()
	Parameter : $taskid, (task id), $task_comment_id (worker comment id)
	Return : none
	Use : add task poster reply for worker public question this function use on task detail page
	*/
	
	
	function add_task_owner_public_message($task_id,$task_comment_id)
	{
		
		$task_detail= $this->get_tasks_detail_by_id($task_id);
		$task_user_id=$task_detail->user_id;
		
		
		$comment_to_user_id=0;
		
		if($task_comment_id>0 && $task_comment_id!='')
		{
			$check_comment=$this->db->get_where('worker_comment',array('task_comment_id'=>$task_comment_id));
			
			if($check_comment->num_rows()>0)
			{
				$res=$check_comment->row();
				$comment_to_user_id=$res->comment_post_user_id;
				
			}
			
			
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
		
		
		
		$data = array(	
				'task_comment' => strip_tags(trim($this->input->post('task_comment'))),
				'is_public' => 1,
				'task_id' => $task_id,
				'comment_post_user_id' => get_authenticateUserID(),
				'comment_to_user_id' => $comment_to_user_id,
				'comment_date' =>$post_date,
				'reply_task_comment_id'=>$task_comment_id
			);
	  
	   $this->db->insert('worker_comment', $data);
	}
	
	
	
	
	/*
	Function name :add_worker_offer()
	Parameter : $taskid, (task id)
	Return : none
	Use : add worker offer for task this function use on task detail page
	*/
	
	
	function add_worker_offer($task_id)
	{
		
		$task_detail= $this->get_tasks_detail_by_id($task_id);
		$task_user_id=$task_detail->user_id;
		
		
		
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
		
		
		
		$data = array(	
				'task_comment' => strip_tags(trim($this->input->post('task_comment'))),
				'offer_amount' => $this->input->post('offer_amount'),
				'task_id' => $task_id,
				'comment_post_user_id' => get_authenticateUserID(),
				'comment_to_user_id'=> $task_user_id,
				'comment_date' => $post_date
			);
	  
	   $this->db->insert('worker_comment', $data);
	
		
		///////===
		$message = array(
	  	'act' => 'newoffer',
		'task_id' => $task_id,
		'poster_user_id' => get_authenticateUserID(),
		'receiver_user_id' => $task_user_id,
		'is_read' => 0,
		'message_date' =>$post_date
	  );
	  $this->db->insert('message', $message);

		
		
		
	}
	
	
	
	
	/*
	Function name :remove_offer_on_task()
	Parameter : $taskid, (task id)
	Return : 1 or 0
	Use : remove worker offer for task this function use on task detail page
	*/
	
	
	function remove_offer_on_task($task_id)
	{
	
		$this->db->select('*');
		$this->db->from('worker_comment');
		$this->db->where('task_id',$task_id);
		$this->db->where('comment_post_user_id',get_authenticateUserID());
		$this->db->where('offer_amount > ',0);
		$this->db->where('is_public',0);
		$this->db->limit(1);
		
		$query=$this->db->get();
		
		if($query->num_rows()>0)
		{
			$res=$query->row();
			
			$this->db->delete('worker_comment',array('task_comment_id'=>$res->task_comment_id));
			return 1;			
		}
			
			return 0;
	
	
	}
	
	
	
	/*
	Function name :get_offer_detail_by_id()
	Parameter : $taskid, (task id), $task_comment_id (task comment id)
	Return : array of worker offer details
	Use : get worker offer details this function use on task detail page
	*/
	
	
	
	
	
	function get_offer_detail_by_id($taskid,$task_comment_id)
	{
		$this->db->select('*');
		$this->db->from('worker_comment');
		$this->db->join('user','worker_comment.comment_post_user_id=user.user_id');
		$this->db->where('worker_comment.task_id',$taskid);
		$this->db->where('offer_amount > ',0);
		$this->db->where('worker_comment.is_final',0);
		$this->db->where('worker_comment.is_public',0);
		$this->db->where('worker_comment.task_comment_id',$task_comment_id);
		$this->db->order_by('worker_comment.comment_date','ASC');
		
		$query = $this->db->get();
		
		if($query->num_rows > 0) 
		{
			return $query->row();
			
		} 	
		
		return 0;
		
	}
	
	
	
	/*
	Function name :edit_worker_offer()
	Parameter : $taskid, (task id), $task_comment_id (task comment id)
	Return : 1 or 0
	Use : edit worker offer details this function use on task detail page
	*/
	
	
	function edit_worker_offer($task_id,$task_comment_id)
	{
		$data=array(
			'task_comment' => strip_tags(trim($this->input->post('task_comment'))),
			'offer_amount' => $this->input->post('offer_amount')		
		);
		
		$this->db->where('task_comment_id',$task_comment_id);
		if($this->db->update('worker_comment',$data))
		{
			return 1;
		}
		return 0;
			
	}
	
	
	/*
	Function name :get_worker_bid_on_task()
	Parameter : $taskid, (task id)
	Return : array of worker offer details
	Use : get worker offer details this function use on task detail page
	*/
	
	
	
	function get_worker_bid_on_task($task_id)
	{
		
		$this->db->select('*');
		$this->db->from('worker_comment');
		$this->db->where('task_id',$task_id);
		$this->db->where('comment_post_user_id',get_authenticateUserID());
		$this->db->where('offer_amount > ',0);
		$this->db->limit(1);
		
		$query=$this->db->get();
		
		if($query->num_rows()>0)
		{
			return $query->row();
		}
			
			return 0;
	}
	
	
	
	/*
	Function name :assing_task_worker_on_detail_page()
	Parameter : $taskid, (task id), $task_comment_id (worker offer comment id)
	Return : boolean
	Use : assign task to worker this function use on task detail page
	*/
	
	
	function assing_task_worker_on_detail_page($task_id,$task_comment_id)
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
		
		
		
		
			////===get worker offer price=====
		
		$worker_id='';
		
		$get_worker_detail=$this->db->query("select * from ".$this->db->dbprefix('user')." us, ".$this->db->dbprefix('user_profile')." up, ".$this->db->dbprefix('worker')." wrk, ".$this->db->dbprefix('worker_comment')." cmt where cmt.comment_post_user_id=us.user_id and us.user_id=up.user_id and us.user_id=wrk.user_id and cmt.task_comment_id='".$task_comment_id."'");
		
		$worker_user_id=0;
		
		if($get_worker_detail->num_rows()>0)
		{
	 	
			$comment_detail=$get_worker_detail->row();
			
			$worker_id=$comment_detail->worker_id;
			
			$worker_user_id=$comment_detail->comment_post_user_id;
		
		}
		 
		 ///////=======
		 
		
			///////====update task status=========
		
		if($worker_id!='' && $worker_id>0)
		{
		
				$data_task=array(
				'task_worker_id'=>$worker_id,
				//'task_activity_status'=>1,
				'task_assigned_date'=>$post_date			
				);
				
				$this->db->where('task_id',$task_id);
				$this->db->update('task',$data_task);
				
				$data_accept=array(
					'is_accept'=>1
				);
				
				
				$this->db->where('task_id',$task_id);
				$this->db->where('task_comment_id',$task_comment_id);
				
				$this->db->update('worker_comment',$data_accept);
				
		}
			
			
			
			///////======
			
			$message = array(
					'act' => 'offeraccept',
					'task_id' => $task_id,
					'poster_user_id' => get_authenticateUserID(),
					'receiver_user_id' => $worker_user_id,
					'is_read' => 0,
					'message_date' => $post_date
			  	 );
			  	 $this->db->insert('message', $message);

		
		
		return true;
		
		
	}
	
	
	
	/*
	Function name :assign_now()
	Parameter : $taskid, (task id), $task_comment_id (worker offer comment id)
	Return : boolean
	Use : assign task to worker this function use on task detail page
	*/
	
	
	function assign_now($task_id,$task_comment_id)
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
		
		
		
		////===get worker offer price=====
		
		$worker_id='';
		
		$get_worker_detail=$this->db->query("select * from ".$this->db->dbprefix('user')." us, ".$this->db->dbprefix('user_profile')." up, ".$this->db->dbprefix('worker')." wrk, ".$this->db->dbprefix('worker_comment')." cmt where cmt.comment_post_user_id=us.user_id and us.user_id=up.user_id and us.user_id=wrk.user_id and cmt.task_comment_id='".$task_comment_id."'");
		
		$worker_user_id=0;
		
		if($get_worker_detail->num_rows()>0)
		{
	 	
			$comment_detail=$get_worker_detail->row();
			
			$worker_id=$comment_detail->worker_id;
			
			$worker_user_id=$comment_detail->comment_post_user_id;
		
			$total=$total+$comment_detail->offer_amount;
		 
		}
		 
		 ///////=======
		 
		 
		 
		 
		  $task_site_fee=0;
		  
		 if($task_setting->task_post_fee>0) {
		 
		 $task_site_fee=number_format((($task_setting->task_post_fee*$total) / 100),2); 
	
			 $total=$total+$task_site_fee;
	
		}
		 
		 
		 $total=number_format($total,2);
		 
		$trans_id='WL'.randomCode();
		
		
		
		
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
		
		
		
		
		////////====add transaction
		
		
		$data_transaction=array(
		'user_id'=>get_authenticateUserID(),
		'task_id'=>$task_id,
		'task_amount'=>$total,
		'host_ip'=>$_SERVER['REMOTE_ADDR'],
		'transaction_date_time'=>$post_date,
		'wallet_transaction_id'=>$trans_id,
		
		);
		
		
		$this->db->insert('transaction',$data_transaction);
		
		
		///////=====addd credit to user wallet====
		
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
		
		
		///////====update task status=========
		
		if($worker_id!='' && $worker_id>0)
		{
		
				$data_task=array(
				'task_worker_id'=>$worker_id,
				'task_activity_status'=>1,
				'task_assigned_date'=>$post_date			
				);
				
				$this->db->where('task_id',$task_id);
				$this->db->update('task',$data_task);
				
				$data_accept=array(
					'is_accept'=>1
				);
				
				
				$this->db->where('task_id',$task_id);
				$this->db->where('task_comment_id',$task_comment_id);
				
				$this->db->update('worker_comment',$data_accept);
				
		}
			
			
			
			///////======
			
			$message = array(
					'act' => 'offeraccept',
					'task_id' => $task_id,
					'poster_user_id' => get_authenticateUserID(),
					'receiver_user_id' => $worker_user_id,
					'is_read' => 0,
					'message_date' => $post_date
			  	 );
			  	 $this->db->insert('message', $message);


			
			
		
	
	}
	
	
	
	
	//////////=====================post task process==============
	
	
	
	/*
	Function name :get_all_categories()
	Parameter : none
	Return : array of all category
	Use : when new task post at that time task go to particular category
	*/
	
	function get_all_categories()
	{
		  $this->db->order_by('category_name','asc');
	   $query = $this->db->get_where("task_category",array('category_status'=>1));
		if($query->num_rows() > 0){
			return $query->result();
		}
		return 0;
	}
	
	
	/*
	Function name :get_task_location()
	Parameter : $task_id (task id)
	Return : array of task location record
	Use : get task all location where this task to be done
	*/
	
	
	function get_task_location($task_id)
	{
	
		$query=$this->db->get_where('task_location',array('task_id'=>$task_id));
		
		if($query->num_rows()>0)
		{
			return $query->result();
		}
		
		return 0;
	
	}
	

	
	/*
	Function name :save_step_zero()
	Parameter : $task_id (task id)
	Return : integer task_id
	Use : add new task from pop-up 
	*/
	
		
	function save_step_zero($task_id = ''){
	
		$post_date=date('Y-m-d H:i:s');
		
		$city_detail=get_cityDetail($this->input->post('task_city_id'));
		
		if($city_detail)
		{	
			$dateTime = new DateTime("now", new DateTimeZone('America/Los_Angeles'));	 
			$task_timezone=tzOffsetToName($city_detail->city_timezone);			
			$dateTimeZone = new DateTimeZone($task_timezone);
			$dateTime->setTimezone($dateTimeZone); 
			$post_date= $dateTime->format("Y-m-d H:i:s");
			
		}
		
				

		if($this->input->post('sub_step') != ''){
			$autoassign = 0; $repeat = 0; $worker = 0; $repeat_week=0;
			if($this->input->post('autoassign') == 1) { $autoassign = 1; }
			if($this->input->post('autoassign') == 2) { $autoassign = 2; }
			if($this->input->post('repeatenable') == 1) { $repeat = 1;   $repeat_week=$this->input->post('task_repeat_week'); }
			if($this->input->post('autoassign') == 3) { $autoassign = 3; $worker = $this->input->post('worker'); }
			
			if($task_id !='' && $task_id !=0){
		
				$task_detail = $this->get_tasks_detail_by_id($task_id);
				//echo '<pre>'; print_r($task_detai); die();
				$data= array(
				'task_name' => $task_detail->task_name,
				'task_url_name'=> $task_detail->task_url_name,
				'task_description' => $task_detail->task_description,
				'task_price' => $task_detail->task_price,
				'more_details' => $task_detail->more_details,
				'extra_cost' => $task_detail->extra_cost,
				'extra_cost_description' => $task_detail->extra_cost_description,
				'other_cost' => $task_detail->other_cost,
				'other_cost_description' => $task_detail->other_cost_description,
				
					'task_category_id' => trim(str_replace('c','',$this->input->post('task_category_id'))),
					'task_city_id' => $this->input->post('task_city_id'),
					'user_id' => get_authenticateUserID(),	
					'task_auto_assignment' => $autoassign,
					'task_repeat' =>$repeat,
					'task_repeat_week' =>$repeat_week,
					'task_assing_worker'=>$worker,
					'task_post_date' =>$post_date,
					'task_status'=>3,
					'task_ip'=>$_SERVER['REMOTE_ADDR']
				);
			} else {
				$data= array(
					'task_category_id' => trim(str_replace('c','',$this->input->post('task_category_id'))),
					'task_city_id' => $this->input->post('task_city_id'),
					'user_id' => get_authenticateUserID(),	
					'task_auto_assignment' => $autoassign,
					'task_repeat' =>$repeat,
					'task_repeat_week' =>$repeat_week,
					'task_assing_worker'=>$worker,
					'task_post_date' =>$post_date,
					'task_status'=>3,
					'task_ip'=>$_SERVER['REMOTE_ADDR']
			   );
		  }
			
			
			if($this->db->insert('task', $data))
			{ 
				$task_id = mysql_insert_id();
				return $task_id; 
			}
			else { return 0; }
		} else { return 0; }
	}

	
	
	/*
	Function name :update_task_step_zero()
	Parameter : $task_id (task id)
	Return : integer task_id
	Use : update newly task from pop-up 
	*/
	
	
	function update_task_step_zero($task_id)
	{
	
		if($this->input->post('task_id') != ''){
			
			$autoassign = 0; $repeat = 0; $worker = 0; $repeat_week=0;
			
			if($this->input->post('autoassign') == 1) { $autoassign = 1; }
			if($this->input->post('autoassign') == 2) { $autoassign = 2; }
			
			if($this->input->post('repeatenable') == 1) { $repeat = 1;   $repeat_week=$this->input->post('task_repeat_week'); }
			
			if($this->input->post('autoassign') == 3) { $autoassign = 3;  $worker = $this->input->post('worker'); }
			
			$data= array(
				'task_category_id' => trim(str_replace('c','',$this->input->post('task_category_id'))),
				'task_city_id' => $this->input->post('task_city_id'),
				'user_id' => get_authenticateUserID(),	
				'task_auto_assignment' => $autoassign,
				'task_repeat' =>$repeat,
				'task_repeat_week' =>$repeat_week,
				'task_assing_worker'=>$worker
			);
			
		
			$this->db->where('task_id',$task_id);
			$this->db->update('task', $data);
			 
				return $task_id; 
			
		} else { return 0; }
	}
	
	
	
	/*
	Function name :check_user_task()
	Parameter : $task_id (task id)
	Return : boolean
	Use : check task owner is current login user or not
	*/
	
	
	
	function check_user_task($task_id)
	{
		$query=$this->db->get_where('task',array('task_id'=>$task_id,'user_id'=>get_authenticateUserID()));	
		
		if($query->num_rows()>0)
		{
			return true;
		}
		
		return false;
	}
	
	
	
	/*
	Function name :get_task_detail()
	Parameter : $task_id (task id)
	Return : array of task detail
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
	Function name :save_step_one()
	Parameter : none
	Return : integer task_id
	Use : update task details from step 1
	*/
	
	
	function save_step_one()
	{
		
		$task_id = $this->input->post('task_id');
		
		$task_status=2;
		
	
		
		
		$content= $this->input->post('task_description');		
		$content=str_replace('"','KSYDOU',$content);
		$content=str_replace("'",'KSYSING',$content);
		
		$more_details= $this->input->post('more_details');		
		$more_details=str_replace('"','KSYDOU',$more_details);
		$more_details=str_replace("'",'KSYSING',$more_details);
		
		$extra_cost_description= $this->input->post('extra_cost_description');		
		$extra_cost_description=str_replace('"','KSYDOU',$extra_cost_description);
		$extra_cost_description=str_replace("'",'KSYSING',$extra_cost_description);
		
		
		$other_cost_description= $this->input->post('other_cost_description');		
		$other_cost_description=str_replace('"','KSYDOU',$other_cost_description);
		$other_cost_description=str_replace("'",'KSYSING',$other_cost_description);
		
		
		$task_url_name=clean_url($this->input->post('task_name'));
		
		
		
		$chk_url_exists=$this->db->query("select MAX(task_url_name) as task_url_name from ".$this->db->dbprefix('task')." where task_id!='".$task_id."' and   task_url_name like '".$task_url_name."%'");
		
		if($chk_url_exists->num_rows()>0)
		{			
				$get_pr=$chk_url_exists->row();					
				
				$strre=0;
				
				if($get_pr->task_url_name!='')
				{
					$strre=str_replace($task_url_name,'',$get_pr->task_url_name);
				}
				
				if($strre=='0') 
				{					
					$newcnt=''; 
					  				
				} 
				elseif($strre=='') 
				{					
					$newcnt='1';   				
				}
				else
				{				
					$newcnt=(int)$strre+1;			
				}
				
			 	$task_url_name=$task_url_name.$newcnt;
						
		}
		
		
		
		
			$data = array(
				'task_name' =>$this->input->post('task_name'),
				'task_url_name' =>$task_url_name,
				'task_description' =>$content,
				'more_details' =>$more_details,
				'task_price' =>$this->input->post('task_price'),
				'task_to_price' =>$this->input->post('task_to_price'),
				'extra_cost' =>$this->input->post('extra_cost'),
				'extra_cost_description' =>$extra_cost_description,
				'other_cost' =>$this->input->post('other_cost'),
				'other_cost_description' =>$other_cost_description,					
				'task_status' => $task_status,
				'task_start_day' =>$this->input->post('task_start_day'),
				'task_start_time' =>$this->input->post('task_start_time'),
				'task_end_day' =>$this->input->post('task_end_day'),
				'task_end_time' =>$this->input->post('task_end_time'),
				'task_is_private'=>$this->input->post('task_is_private'),
				'task_large_vehicals'=>$this->input->post('task_large_vehicals'),
				'task_online'=>$this->input->post('task_online')
			);
			$this->db->where('task_id',$task_id);		
			$this->db->update('task', $data);
			
			
		
			
			if($this->input->post('locationname')!='' && $this->input->post('address1')!=''  && $this->input->post('zipcode')!='')
			{
				$data_location=array(
					'task_id'=>$task_id,				
					'location_name' => $this->input->post('locationname'),
					'location_address' => $this->input->post('address1'),
					'location_city' => $this->input->post('location_city'),
					'location_state' => $this->input->post('location_state'),
					'location_zip' => $this->input->post('zipcode'),						
				);
				
				$this->db->insert('task_location',$data_location);
				
			}
			
			
				
			
			$user_location_id = $this->input->post('user_location_id');
			
			if($user_location_id)
			{
				foreach($user_location_id as $loc_id)
				{				
					
					if($loc_id!='' && $loc_id>0)
					{
						
						$check_location_id_exists=$this->db->get_where('task_location',array('user_location_id'=>$loc_id,'task_id'=>$task_id));
						if($check_location_id_exists->num_rows()>0)
						{
						
						}
						else
						{
						
							$data_user_location=array(
							'task_id'=>$task_id,				
							'user_location_id' => $loc_id,					
							);				
							$this->db->insert('task_location',$data_user_location);	
						}
						
					
						
					}			
					
				}
			}
			
			else
			{
				$this->db->where('user_location_id >',0);
				$this->db->where('task_id',$task_id);
				$this->db->delete('task_location');	
			}	
				
				
				
				
						////////==delete other location
				
				$db_location_id=array();
				
				
					$check_location_id_get=$this->db->get_where('task_location',array('user_location_id !='=>0,'task_id'=>$task_id));
						
						if($check_location_id_get->num_rows()>0)
						{
							$all_location=$check_location_id_get->result();
							
							foreach($all_location as $loc_id)
							{
								$db_location_id[]=$loc_id->user_location_id;
							}							
						}
						
						
				
						
							$diff=array();
							
							if($user_location_id)
							{
								$diff=array_diff($db_location_id, $user_location_id);
							}
							
							
											
							if($diff)
							{
								
								foreach($diff as $loc_id)
								{
									$this->db->delete('task_location',array('user_location_id'=>$loc_id,'task_id'=>$task_id));						
								}
							
							}
							
					////////====end===		
							
				
			$save_location=$this->input->post('savelocation');
			
			if($save_location==1)
			{
				
				if($this->input->post('locationname')!='' && $this->input->post('address1')!=''  && $this->input->post('zipcode')!='')
				{
					$data_location2=array(
						'user_id'=>get_authenticateUserID(),				
						'location_name' => $this->input->post('locationname'),
						'location_address' => $this->input->post('address1'),
						'location_city' => $this->input->post('location_city'),
						'location_state' => $this->input->post('location_state'),
						'location_zipcode' => $this->input->post('zipcode'),
						'location_date'=>date('Y-m-d H:i:s'),						
					);
					
					$this->db->insert('user_location',$data_location2);
				}
			
			}
			
			return $task_url_name;
			
			
	}
	
	
	/*
	Function name :pay()
	Parameter : none
	Return : integer task_id
	Use : post task for publicly from step 2
	*/
	
	function pay()
	{
		$task_id = $this->input->post('task_id');
		
		$task_status=1;
		
		$user_setting=user_setting();
		
		if($user_setting->user_task_auto_active==1)
		{
			$total_allow=$user_setting->no_task_after_auto_active;
			$user_task=$this->count_user_task(get_authenticateUserID());
			
			if($user_task>=$total_allow)
			{
				$task_status=1;
			}
			
		}
		
		
		///====  for test mode==
		
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
		
		
		
		
			$data = array(
				'task_status' => $task_status,
				'task_post_date'=>$post_date
			);
			$this->db->where('task_id',$task_id);		
			$this->db->update('task', $data);
	}
	
	
	
	/////-----------------edit task---------------------------
	
	
	
	/*
	Function name :edit_task_top()
	Parameter : $task_id (task id)
	Return : integer task_id
	Use : edit task details from pop-up 
	
	NOTE : user can edit task details until no one can offer on his/her task
	*/
	
	
	
	function edit_task_top($task_id)
	{
	
		if($this->input->post('task_id') != ''){
			
			$autoassign = 0; $repeat = 0; $worker = 0; $repeat_week=0;
			
			if($this->input->post('autoassign') == 1) { $autoassign = 1; }
			if($this->input->post('autoassign') == 2) { $autoassign = 2; }
			
			if($this->input->post('repeatenable') == 1) { $repeat = 1;   $repeat_week=$this->input->post('task_repeat_week'); }
			
			if($this->input->post('autoassign') == 3) { $autoassign = 3;  $worker = $this->input->post('worker'); }
			
			$data= array(
				'task_category_id' => trim(str_replace('c','',$this->input->post('task_category_id'))),
				'task_city_id' => $this->input->post('task_city_id'),
				'user_id' => get_authenticateUserID(),	
				'task_auto_assignment' => $autoassign,
				'task_repeat' =>$repeat,
				'task_repeat_week' =>$repeat_week,
				'task_assing_worker'=>$worker
			);
			
		
			$this->db->where('task_id',$task_id);
			$this->db->update('task', $data);
			 
				return $task_id; 
			
		} else { return 0; }
	}
	
	
	
	/*
	Function name :edit_task()
	Parameter : $task_id (task id)
	Return : integer task_id
	Use : edit task details  
	
	NOTE : user can edit task details until no one can offer on his/her task
	*/
	
	function edit_task()
	{
		
		$task_id = $this->input->post('task_id');
		
		$task_status=1;
		
	
		
		
		$content= $this->input->post('task_description');		
		$content=str_replace('"','KSYDOU',$content);
		$content=str_replace("'",'KSYSING',$content);
		
		$more_details= $this->input->post('more_details');		
		$more_details=str_replace('"','KSYDOU',$more_details);
		$more_details=str_replace("'",'KSYSING',$more_details);
		
		$extra_cost_description= $this->input->post('extra_cost_description');		
		$extra_cost_description=str_replace('"','KSYDOU',$extra_cost_description);
		$extra_cost_description=str_replace("'",'KSYSING',$extra_cost_description);
		
		
		$other_cost_description= $this->input->post('other_cost_description');		
		$other_cost_description=str_replace('"','KSYDOU',$other_cost_description);
		$other_cost_description=str_replace("'",'KSYSING',$other_cost_description);
		
		
		$task_url_name=clean_url($this->input->post('task_name'));
		
		
		
		$chk_url_exists=$this->db->query("select MAX(task_url_name) as task_url_name from ".$this->db->dbprefix('task')." where task_id!='".$task_id."' and   task_url_name like '".$task_url_name."%'");
		
		if($chk_url_exists->num_rows()>0)
		{			
				$get_pr=$chk_url_exists->row();					
				
				$strre=0;
				
				if($get_pr->task_url_name!='')
				{
					$strre=str_replace($task_url_name,'',$get_pr->task_url_name);
				}
				
				if($strre=='0') 
				{					
					$newcnt=''; 
					  				
				} 
				elseif($strre=='') 
				{					
					$newcnt='1';   				
				}
				else
				{				
					$newcnt=(int)$strre+1;			
				}
				
			 	$task_url_name=$task_url_name.$newcnt;
						
		}
		
		
		
		
			$data = array(
				'task_name' =>$this->input->post('task_name'),
				'task_url_name' =>$task_url_name,
				'task_description' =>$content,
				'more_details' =>$more_details,
				'task_price' =>$this->input->post('task_price'),
				'task_to_price' =>$this->input->post('task_to_price'),
				'extra_cost' =>$this->input->post('extra_cost'),
				'extra_cost_description' =>$extra_cost_description,
				'other_cost' =>$this->input->post('other_cost'),
				'other_cost_description' =>$other_cost_description,					
				'task_status' => $task_status,
				'task_start_day' =>$this->input->post('task_start_day'),
				'task_start_time' =>$this->input->post('task_start_time'),
				'task_end_day' =>$this->input->post('task_end_day'),
				'task_end_time' =>$this->input->post('task_end_time'),
				'task_is_private'=>$this->input->post('task_is_private'),
				'task_large_vehicals'=>$this->input->post('task_large_vehicals'),
				'task_online'=>$this->input->post('task_online')
			);
			$this->db->where('task_id',$task_id);		
			$this->db->update('task', $data);
			
			
		if($this->input->post('locationname')!='' && $this->input->post('address1')!=''  && $this->input->post('zipcode')!='')
			{
				$data_location=array(
					'task_id'=>$task_id,				
					'location_name' => $this->input->post('locationname'),
					'location_address' => $this->input->post('address1'),
					'location_city' => $this->input->post('location_city'),
					'location_state' => $this->input->post('location_state'),
					'location_zip' => $this->input->post('zipcode'),						
				);
				
				$this->db->insert('task_location',$data_location);
				
			}
			
			
				
			
			$user_location_id = $this->input->post('user_location_id');
			
			if($user_location_id)
			{
				foreach($user_location_id as $loc_id)
				{				
					
					if($loc_id!='' && $loc_id>0)
					{
						
						$check_location_id_exists=$this->db->get_where('task_location',array('user_location_id'=>$loc_id,'task_id'=>$task_id));
						if($check_location_id_exists->num_rows()>0)
						{
						
						}
						else
						{
						
							$data_user_location=array(
							'task_id'=>$task_id,				
							'user_location_id' => $loc_id,					
							);				
							$this->db->insert('task_location',$data_user_location);	
						}
						
						
						
						
						
					}			
					
				}
			}
			
			else
			{
				$this->db->where('user_location_id >',0);
				$this->db->where('task_id',$task_id);
				$this->db->delete('task_location');	
			}	
				
				
				
				
				
				////////==delete other location
				
				$db_location_id=array();
				
				
					$check_location_id_get=$this->db->get_where('task_location',array('user_location_id !='=>0,'task_id'=>$task_id));
						
						if($check_location_id_get->num_rows()>0)
						{
							$all_location=$check_location_id_get->result();
							
							foreach($all_location as $loc_id)
							{
								$db_location_id[]=$loc_id->user_location_id;
							}							
						}
						
						////////====end===
				
						
							
							
							
							$diff=array();
							
							if($user_location_id)
							{
								$diff=array_diff($db_location_id, $user_location_id);
							}
							
							
							
							
											
							if($diff)
							{
								
								foreach($diff as $loc_id)
								{
									$this->db->delete('task_location',array('user_location_id'=>$loc_id,'task_id'=>$task_id));						
								}
							
							}
							
									
				
				
			$save_location=$this->input->post('savelocation');
			
			if($save_location==1)
			{
				
				if($this->input->post('locationname')!='' && $this->input->post('address1')!=''  && $this->input->post('zipcode')!='')
				{
					$data_location2=array(
						'user_id'=>get_authenticateUserID(),				
						'location_name' => $this->input->post('locationname'),
						'location_address' => $this->input->post('address1'),
						'location_city' => $this->input->post('location_city'),
						'location_state' => $this->input->post('location_state'),
						'location_zipcode' => $this->input->post('zipcode'),
						'location_date'=>date('Y-m-d H:i:s'),						
					);
					
					$this->db->insert('user_location',$data_location2);
				}
			
			}
			
			return $task_url_name;
			
			
	}
	
	
	
	/*
	Function name :count_user_task()
	Parameter : $user_id (user id)
	Return : integer number of task
	Use : get user total posted task
	*/
	
	
	function count_user_task($user_id)
	{
		$query=$this->db->get_where('task',array('user_id'=>$user_id));
		
		return $query->num_rows();
	}
	
	
	
	/*
	Function name : get_worker_by_category()
	Parameter : $category_id (category id)
	Return : array of worker list
	Use : get worker list who work in this category
	*/
	
	
	function get_worker_by_category($category_id)
	{
	
		$workers = $this->db->query("SELECT * FROM ".$this->db->dbprefix('worker')." w, ".$this->db->dbprefix('user')." u WHERE w.`worker_task_type` in (".$category_id.") and u.user_id = w.user_id");
		
		return $workers->result();
		
	}
	
	
	/*
	Function name : get_category_by_id()
	Parameter : $category_id (category id)
	Return : array of category detail
	Use : get category detail
	*/
	
	
	function get_category_by_id($category_id)
	{
	
		$category = $this->db->query("SELECT * FROM ".$this->db->dbprefix('task_category')." WHERE task_category_id = '".$category_id."'");
		return $category->row();
	}
				
}
?>