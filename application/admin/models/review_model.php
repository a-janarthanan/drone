<?php
class Review_model extends CI_Model
{
    function Review_model()
	{
	    parent::__construct();
	}
	
	function get_total_review_count(){
	
		$this->db->select('*');
		$this->db->from('worker_comment wc');
		$this->db->join('task tk','wc.task_id=tk.task_id');
		$this->db->join('user ur','wc.comment_post_user_id=ur.user_id','left');
		$this->db->join('city c','tk.task_city_id=c.city_id','left');
		$this->db->where('is_final',1);
		$this->db->order_by('wc.task_comment_id','asc');
		
		$query=$this->db->get();
		return $query->num_rows();
		
	
	}
	
	function get_all_review($offset, $limit){
	
		$this->db->select('*');
		$this->db->from('worker_comment wc');
		$this->db->join('task tk','wc.task_id=tk.task_id');
		$this->db->join('user ur','wc.comment_post_user_id=ur.user_id','left');
		$this->db->join('city c','tk.task_city_id=c.city_id','left');
		$this->db->where('is_final',1);
		$this->db->order_by('wc.task_comment_id','asc');
		$this->db->limit($limit,$offset);
		
		$query=$this->db->get();

		if($query->num_rows()>0)
		{		
			return $query->result();
		}
		
		return 0;
	
	}
	
	function get_one_review($cid){
	
		$this->db->select('*');
		$this->db->from('worker_comment wc');
		$this->db->join('task tk','wc.task_id=tk.task_id');
		$this->db->join('user ur','wc.comment_post_user_id=ur.user_id','left');
		$this->db->join('city c','tk.task_city_id=c.city_id','left');
		$this->db->where('wc.is_final',1);
		$this->db->where('wc.task_comment_id',$cid);
		$this->db->order_by('wc.task_comment_id','asc');
		
		$query=$this->db->get();

		if($query->num_rows()>0)
		{		
			return $query->row();
		}
		
		return 0;
	}
	
	function edit_review(){
	
		$data = array(
			'task_comment' => $this->input->post('task_comment')
		);
		$this->db->where('task_comment_id',$this->input->post('task_comment_id'));
		$this->db->update('worker_comment',$data);
	}

}
?>