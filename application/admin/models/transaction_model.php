<?php

class Transaction_model extends CI_Model {
	
    function Transaction_model()
    {
       parent::__construct();	
    } 
	
	/*** get total transaction 
	*  return number
	**/
	function get_total_transaction_count()
	{
		$this->db->select('*');
		$this->db->from('transaction ts');
		$this->db->join('user ur','ts.user_id=ur.user_id','left');
		$this->db->join('user_profile up','ur.user_id=up.user_id','left');
		$this->db->join('task tk','ts.task_id=tk.task_id');
		$this->db->order_by('ts.transaction_id','desc');
		$query=$this->db->get();
		
		return $query->num_rows(); 
	}
	
	
	/*** get transaction details
	*  return multiple records array
	**/
	function get_transaction_result($offset, $limit)
	{
		$this->db->select('*');
		$this->db->from('transaction ts');
		$this->db->join('user ur','ts.user_id=ur.user_id','left');
		$this->db->join('user_profile up','ur.user_id=up.user_id','left');
		$this->db->join('task tk','ts.task_id=tk.task_id');
		$this->db->order_by('ts.transaction_id','desc');
		$this->db->limit($limit,$offset);
		$query=$this->db->get();
		
		if ($query->num_rows() > 0) {
			return $query->result();
		}
		return 0;
	} 
	 
	/*** get wallet transaction details
	*  return single records array
	**/
	function worker_pay($worker_id,$task_id){

		$this->db->select('*');
		$this->db->from('worker wrk');
		$this->db->join('user us','wrk.user_id=us.user_id');
		$this->db->join('user_profile up','wrk.user_id=up.user_id');
		$this->db->join('wallet wl','us.user_id=wl.user_id','left');
		$this->db->where('wrk.worker_id',$worker_id);
		$this->db->where('wl.task_id',$task_id);
		$query=$this->db->get();
		//echo $this->db->last_query(); die();
		if($query->num_rows()>0)
		{		
			return $query->row();
		}
		
		return 0;
	}
	
	
	/*** get total refund transaction 
	*  return number
	**/
	function get_total_refund_count()
	{
		$this->db->select('*');
		$this->db->from('dispute dsp');
		$this->db->join('task tk','dsp.task_id=tk.task_id');
		$this->db->join('user us','tk.user_id = us.user_id');
		$this->db->join('user_profile up','us.user_id=up.user_id');
		$this->db->join('wallet wl','us.user_id=wl.user_id','left');
		$this->db->join('transaction tr','wl.user_id=tr.user_id','left');
		$this->db->where('wl.task_id = tr.task_id');
		$this->db->where('tk.task_id = wl.task_id');
		$this->db->where('dsp.dispute_status !=','1');
		$this->db->where('wl.debit !=','');
		$query=$this->db->get();
		
		return $query->num_rows();
	}
	
	
	/*** get refund transaction details
	*  return multiple records array
	**/
	function get_refund_result($offset, $limit)
	{
		$this->db->select('*');
		$this->db->from('dispute dsp');
		$this->db->join('task tk','dsp.task_id=tk.task_id');
		$this->db->join('user us','tk.user_id = us.user_id');
		$this->db->join('user_profile up','us.user_id=up.user_id');
		$this->db->join('wallet wl','us.user_id=wl.user_id','left');
		$this->db->join('transaction tr','wl.user_id=tr.user_id','left');
		$this->db->where('wl.task_id = tr.task_id');
		$this->db->where('tk.task_id = wl.task_id');
		$this->db->where('dsp.dispute_status !=','1');
		$this->db->where('wl.debit !=','');
		
		$this->db->limit($limit,$offset);
		$query=$this->db->get();
		
		//echo $this->db->last_query(); //die();
		
		if($query->num_rows()>0)
		{		
			return $query->result();
		}
		
		return 0;
	}
	
	
	function get_total_search_escrow_count($option,$keyword){
	
		$keyword=str_replace('"','',str_replace(array("'",",","%","$","&","*","#","(",")",":",";",">","<","/"),'',$keyword));

		if($option=='taskername')
		{
		
		    $this->db->select('*');
			$this->db->from('transaction ts');
			$this->db->join('task tk','ts.task_id=tk.task_id');
			$this->db->join('worker wr','tk.task_worker_id=wr.worker_id','left');
			$this->db->join('user ur','wr.user_id=ur.user_id','left');
			$this->db->join('user_profile up','ur.user_id=up.user_id','left');
			
			$this->db->like('ur.full_name',$keyword);
		    $this->db->or_like('ur.first_name',$keyword);
		    $this->db->or_like('ur.last_name',$keyword);
		}
		
		if($option=='askername' || $option=='taskname')
		{
			$this->db->select('*');
			$this->db->from('transaction ts');
			$this->db->join('task tk','ts.task_id=tk.task_id');
		    $this->db->join('user ur','ts.user_id=ur.user_id','left');
		    $this->db->join('user_profile up','ur.user_id=up.user_id','left');
		
			if($option=='askername'){
			   $this->db->like('ur.full_name',$keyword);
			   $this->db->or_like('ur.first_name',$keyword);
			   $this->db->or_like('ur.last_name',$keyword);
			}
			
			if($option=='taskname')
			{
			   $this->db->like('tk.task_name',$keyword);
			}
		}
		
		
		$this->db->order_by('ts.transaction_id','desc');
		
		$query=$this->db->get();
		
		return $query->num_rows();
	}
	
	function get_search_escrow_result($option,$keyword,$offset,$limit)
	{
		$keyword=str_replace('"','',str_replace(array("'",",","%","$","&","*","#","(",")",":",";",">","<","/"),'',$keyword));

		if($option=='taskername')
		{
		
		    $this->db->select('*');
			$this->db->from('transaction ts');
			$this->db->join('task tk','ts.task_id=tk.task_id');
			$this->db->join('worker wr','tk.task_worker_id=wr.worker_id','left');
			$this->db->join('user ur','wr.user_id=ur.user_id','left');
			$this->db->join('user_profile up','ur.user_id=up.user_id','left');
			
			$this->db->like('ur.full_name',$keyword);
		    $this->db->or_like('ur.first_name',$keyword);
		    $this->db->or_like('ur.last_name',$keyword);
		}
		
		if($option=='askername' || $option=='taskname')
		{
			$this->db->select('*');
			$this->db->from('transaction ts');
			$this->db->join('task tk','ts.task_id=tk.task_id');
		    $this->db->join('user ur','ts.user_id=ur.user_id','left');
		    $this->db->join('user_profile up','ur.user_id=up.user_id','left');
		
			if($option=='askername'){
			   $this->db->like('ur.full_name',$keyword);
			   $this->db->or_like('ur.first_name',$keyword);
			   $this->db->or_like('ur.last_name',$keyword);
			}
			
			if($option=='taskname')
			{
			   $this->db->like('tk.task_name',$keyword);
			}
		}

		$this->db->order_by('ts.transaction_id','desc');
		$this->db->limit($limit,$offset);
		$query=$this->db->get();

		if ($query->num_rows() > 0) {
			return $query->result();
		}
		return 0;
	}
	
	
	function get_user_by_task($task_id)
	{
		$this->db->select('*');
		$this->db->from('task tk');
		$this->db->join('user ur','tk.user_id=ur.user_id');
		$this->db->join('user_profile up','ur.user_id=up.user_id','left');	
		$this->db->where('tk.task_id',$task_id);
		$query=$this->db->get();
		if ($query->num_rows() > 0) {
			return $query->row();
		}
		return 0;
	}
	
	
	/*** get total worker pay
	*  return number
	**/
	function get_total_paying_count()
	{
		$this->db->select('*');
		$this->db->from('wallet wl');
		$this->db->join('task tk','wl.task_id=tk.task_id');
		$this->db->join('user ur','wl.user_id=ur.user_id','left');
		$this->db->join('user_profile up','ur.user_id=up.user_id','left');
		$this->db->where('wl.debit >',0);
		$this->db->where('wl.credit =',0);
		$this->db->where('wl.task_id !=',0);
		$this->db->order_by('wl.id','desc');
		$query=$this->db->get();
		
		return $query->num_rows(); 
	}
	
	
	/*** get transaction details
	*  return multiple records array
	**/
	function get_paying_result($offset, $limit)
	{	
		$this->db->select('*');
		$this->db->from('wallet wl');
		$this->db->join('task tk','wl.task_id=tk.task_id');
		$this->db->join('user ur','wl.user_id=ur.user_id','left');
		$this->db->join('user_profile up','ur.user_id=up.user_id','left');
		$this->db->where('wl.debit >',0);
		$this->db->where('wl.credit =',0);
		$this->db->where('wl.task_id !=',0);
		$this->db->order_by('wl.id','desc');		
		$this->db->limit($limit,$offset);
		$query=$this->db->get();
		
		
		
		if ($query->num_rows() > 0) {
			return $query->result();
		}
		return 0;
	} 
	
	function get_total_search_paying_count($option,$keyword)
	{
		$keyword=str_replace('"','',str_replace(array("'",",","%","$","&","*","#","(",")",":",";",">","<","/"),'',$keyword));

		if($option=='taskername')
		{
		
		    $this->db->select('*');
			$this->db->from('wallet wl');
			$this->db->join('task tk','wl.task_id=tk.task_id');
			$this->db->join('worker wr','tk.task_worker_id=wr.worker_id','left');
			$this->db->join('user ur','wr.user_id=ur.user_id','left');
			$this->db->join('user_profile up','ur.user_id=up.user_id','left');
			
			$this->db->like('ur.full_name',$keyword);
		    $this->db->or_like('ur.first_name',$keyword);
		    $this->db->or_like('ur.last_name',$keyword);
		}
		
		if($option=='askername' || $option=='taskname')
		{
			$this->db->select('*');
			$this->db->from('wallet wl');
			$this->db->join('task tk','wl.task_id=tk.task_id');
		    $this->db->join('user ur','wl.user_id=ur.user_id','left');
		    $this->db->join('user_profile up','ur.user_id=up.user_id','left');
		
			if($option=='askername'){
			   $this->db->like('ur.full_name',$keyword);
			   $this->db->or_like('ur.first_name',$keyword);
			   $this->db->or_like('ur.last_name',$keyword);
			}
			
			if($option=='taskname')
			{
			   $this->db->like('tk.task_name',$keyword);
			}
		}
		
		$this->db->where('wl.debit >',0);
		$this->db->where('wl.credit =',0);
		$this->db->where('wl.task_id !=',0);
			
		$this->db->order_by('wl.id','desc');
		$query=$this->db->get();

		
		return $query->num_rows();
	}
	
	function get_search_paying_result($option,$keyword,$offset,$limit)
	{
		$keyword=str_replace('"','',str_replace(array("'",",","%","$","&","*","#","(",")",":",";",">","<","/"),'',$keyword));

		if($option=='taskername')
		{
		
		    $this->db->select('*');
			$this->db->from('wallet wl');
			$this->db->join('task tk','wl.task_id=tk.task_id');
			$this->db->join('worker wr','tk.task_worker_id=wr.worker_id','left');
			$this->db->join('user ur','wr.user_id=ur.user_id','left');
			$this->db->join('user_profile up','ur.user_id=up.user_id','left');
			
			$this->db->like('ur.full_name',$keyword);
		    $this->db->or_like('ur.first_name',$keyword);
		    $this->db->or_like('ur.last_name',$keyword);
		}
		
		if($option=='askername' || $option=='taskname')
		{
			$this->db->select('*');
			$this->db->from('wallet wl');
			$this->db->join('task tk','wl.task_id=tk.task_id');
		    $this->db->join('user ur','wl.user_id=ur.user_id','left');
		    $this->db->join('user_profile up','ur.user_id=up.user_id','left');
		
			if($option=='askername'){
			   $this->db->like('ur.full_name',$keyword);
			   $this->db->or_like('ur.first_name',$keyword);
			   $this->db->or_like('ur.last_name',$keyword);
			}
			
			if($option=='taskname')
			{
			   $this->db->like('tk.task_name',$keyword);
			}
		}
		
		$this->db->where('wl.debit >',0);
		$this->db->where('wl.credit =',0);
		$this->db->where('wl.task_id !=',0);
			
		$this->db->order_by('wl.id','desc');
		$this->db->limit($limit,$offset);
		$query=$this->db->get();

		if ($query->num_rows() > 0) {
			return $query->result();
		}
		return 0;
	}
	
	
	
		
	
	
}
?>