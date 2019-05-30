<?php
class Dispute_model extends CI_Model {

	/*
	Function name :Dispute_model
	Description :its default constuctor which called when Dispute_model object initialzie.its load necesary parent constructor
	*/
	
    function Dispute_model()
    {
        parent::__construct();	
    }   
	
	/*
	Function name :get_task_detail()
	Parameter : $task_id (task_id)
	Return : single array of task details
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
	Function name :get_all_dispute_comments()
	Parameter : $task_id (task_id)
	Return : array of all dispute comments of task
	Use : get all dispute comments of task
	*/
	
	function get_all_dispute_comments($task_id){
	
		$this->db->select('*');
		$this->db->from('dispute_comment');
		$this->db->join('dispute','dispute_comment.dispute_id=dispute.dispute_id');
		$this->db->join('task','dispute.task_id=task.task_id');
		$this->db->where('dispute.task_id',$task_id);
		$this->db->order_by('dispute_comment.dispute_comment_id','asc');	
		$query = $this->db->get(); 
		return $query->result();
	
	}
	
	/*
	Function name :get_dispute_setting()
	Parameter : none
	Return : array of dispute setting
	Use : get dispute setting
	*/
	function get_dispute_setting()
	{
		$query = $this->db->get('dispute_setting');
		return $query->row();
	}
	
	
	/*
	Function name :dispute_add()
	Parameter : none
	Return : none
	Use : add dispute record and dispute comment of task
	*/
	
	function dispute_add()
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
		
		
		
		
			$data= array(
				'task_id' => $this->input->post('task_id'),
				'task_user_id' => $this->input->post('task_user_id'),
				'task_assign_user_id' =>$this->input->post('task_assign_user_id'),
				'dispute_date' => $post_date,
				'dispute_ip' =>$this->input->ip_address()
			);
		$this->db->insert('dispute', $data); 
		$dispute_id = mysql_insert_id();	
		
		$data1= array(
				'dispute_id' => $dispute_id,
				'task_id' => $this->input->post('task_id'),
				'task_user_id' => $this->input->post('task_user_id'),
				'task_assign_user_id' => $this->input->post('task_assign_user_id'),
				'comment_post_user_id' =>$this->input->post('comment_post_user_id'),
				'dispute_comment' => $this->input->post('comment'),
				'dispute_comment_date' => $post_date,
				'dispute_comment_ip' =>$this->input->ip_address()
			);
		$this->db->insert('dispute_comment', $data1); 
		
		
		//////====
		
		if(get_authenticateUserID() ==  $this->input->post('task_user_id')){
			$receiver_user_id =  $this->input->post('task_assign_user_id');
		} else {
			$receiver_user_id =  $this->input->post('task_user_id');
		}
		
		$message = array(
			'act' => 'taskdispute',
			'task_id' => $this->input->post('task_id'),
			'poster_user_id' => get_authenticateUserID(),
			'receiver_user_id' => $receiver_user_id,
			'is_read' => 0,
			'message_date' => $post_date
	   );
	   $this->db->insert('message', $message);




	}
	
	
	/*
	Function name :dispute_comment_add()
	Parameter : none
	Return : none
	Use : add dispute comment of task
	*/
	
	function dispute_comment_add()
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
		
		
		
		
			$data1= array(
				'dispute_id' => $this->input->post('dispute_id'),
				'task_id' => $this->input->post('task_id'),
				'task_user_id' => $this->input->post('task_user_id'),
				'task_assign_user_id' => $this->input->post('task_assign_user_id'),
				'comment_post_user_id' =>$this->input->post('comment_post_user_id'),
				'dispute_comment' => $this->input->post('comment'),
				'dispute_comment_date' => $post_date,
				'dispute_comment_ip' =>$this->input->ip_address()
			);
		$this->db->insert('dispute_comment', $data1); 
		
		
		
		if(get_authenticateUserID() ==  $this->input->post('task_user_id')){
			$receiver_user_id =  $this->input->post('task_assign_user_id');
		} else {
			$receiver_user_id =  $this->input->post('task_user_id');
		}
		
		$message = array(
			'act' => 'taskdisputeconversation',
			'task_id' => $this->input->post('task_id'),
			'poster_user_id' => get_authenticateUserID(),
			'receiver_user_id' => $receiver_user_id,
			'is_read' => 0,
			'message_date' => $post_date
	   );
	   $this->db->insert('message', $message);




	
	}
	
	
	/*
	Function name :check_dispute_task()
	Parameter : $task_id (task_id)
	Return : single array of dispute details
	Use : get dispute details
	*/
	
	function check_dispute_task($task_id)
    {
		$query = $this->db->get_where('dispute',array('task_id'=>$task_id,'dispute_status !='=>3));
		if($query->num_rows() >0 )
		{ 
			return  $query->row();
		} else {
			return 0;
		}
    }
}
?>