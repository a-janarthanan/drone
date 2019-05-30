<?php

class Dispute_model extends CI_Model {
	
    function Dispute_model()
    {
        parent::__construct();	
    }   

	/*** get total task 
	*  return number
	**/
	function get_total_dispute_count()
	{
		//return $this->db->count_all('dispute');
		$this->db->select('*');
		$this->db->from('dispute');
		$this->db->join('task','dispute.task_id=task.task_id');
		//$this->db->where('dispute.dispute_status !=','3');
		$this->db->order_by('dispute.dispute_id','desc');	
		$query = $this->db->get(); 
	
		return $query->num_rows();
	
	}
	
	
	/*** get dispute details
	*  return multiple records array
	**/
	function get_dispute_result($offset, $limit)
	{
	
		$this->db->select('*');
		$this->db->from('dispute');
		$this->db->join('task','dispute.task_id=task.task_id');
		//$this->db->where('dispute.dispute_status !=','3');
		$this->db->order_by('dispute.dispute_id','desc');	
		$query = $this->db->get(); 
	
		if ($query->num_rows() > 0) {
			return $query->result();
		}
		return 0;
	}
	
	/*** get task offer price of worker
	return single array  record
	**/
	
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
		$row = $query->row();
		
		if ($query->num_rows() > 0) 
		{
		return $row->offer_amount;	
		}
	}
	
	/*** get total task 
	*  return number
	**/
	function get_total_conversation_count($task_id)
	{
		$this->db->select('*');
		$this->db->from('dispute_comment');
		$this->db->join('dispute','dispute_comment.dispute_id=dispute.dispute_id');
		$this->db->join('task','dispute.task_id=task.task_id');
		$this->db->where('dispute.task_id',$task_id);
		$this->db->order_by('dispute_comment.dispute_comment_id','asc');	
		$query = $this->db->get(); 

		if ($query->num_rows() > 0) {
			return $query->num_rows();
		}
		return 0;
	}
	
	
	/*** get dispute details
	*  return multiple records array
	**/
	function get_conversation_result($task_id,$offset, $limit)
	{
	
		$this->db->select('*');
		$this->db->from('dispute_comment');
		$this->db->join('dispute','dispute_comment.dispute_id=dispute.dispute_id');
		$this->db->join('task','dispute.task_id=task.task_id');
		$this->db->where('dispute.task_id',$task_id);
		$this->db->order_by('dispute_comment.dispute_comment_id','asc');	
		$query = $this->db->get(); 

		if ($query->num_rows() > 0) {
			return $query->result();
		}
		return 0;
	}
	
	function payment_dispute($taskid,$cutfee='',$winid,$total)
	{
	           
	       $cut=task_setting();
	       if($cutfee=='yes')
			{
			    
				$total_per=$cut->task_post_refund_fee;
				
				$total_cut_price=0;
				
				if($total_per>0 && $total_per>0.00) 
				{ 
					 $total_cut_price=($total*$total_per)/100;
				}
				
				 $total_price=$total-$total_cut_price;
				  
				  $total_cut_price=number_format($total_cut_price,2);
				  $total_price=number_format($total_price,2);
				 
				 return  $total_cut_price.",".$total_price;
				//exit;
			}
			elseif($cutfee=='no')
			{
			  
			     $total_cut_price='0.00';
				 $total_price=$total;
				 
				  $total_cut_price=number_format($total_cut_price,2);
				  $total_price=number_format($total_price,2);
				  
				 return  $total_cut_price.",".$total_price;
				
			}
		
		   else
		     {
			      
		       $total_per=$cut->task_worker_fee;
				
				$total_cut_price=0;
				
				if($total_per>0 && $total_per>0.00) 
				{ 	
		      		 $total_cut_price=($total*$total_per)/100;
				}
				
			    $total_price=$total-$total_cut_price;
				
				 $total_cut_price=number_format($total_cut_price,2);
				 $total_price=number_format($total_price,2);
			   
			    return  $total_cut_price.",".$total_price;
				
		     }
		
		
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
	   
	 function get_first_dispute_comment($dispute_id)
	 {
	 
	 	$this->db->select('*');
		$this->db->from('dispute_comment');
		$this->db->where('dispute_comment.dispute_id',$dispute_id);
		$this->db->order_by('dispute_comment.dispute_comment_id','asc');	
		$query = $this->db->get(); 
		return $query->row();
		
	 }
	 
	 function wallet_payment($task_user_id,$task_id,$cutfee,$win_user_id,$amount)
	{
	 //echo $amount;
		if($amount == ''){
			////////////============total
			$total=0;
			 
			$price = $this->user_added_task_price($task_user_id,$task_id);
			   
				if(isset($price))
				 {
					if(isset($price->credit))
					   {
						  if($price->credit>0)
						   {
							  $total=$total+$price->credit;
							}
						}
				 }
			 $total=number_format($total,2);
			
			////////////============end total
		} else {
			 $total=number_format($amount,2);
		}
		
		//echo $total; 
		
		$calculation=$this->payment_dispute($task_id,$cutfee,$win_user_id,$total);
		
		$a=explode(',',$calculation);
		
		
		  $cut_price=$a[0];
		  $total_price=$a[1];
		
		 
		$wallet_transaction_id ='WL'.randomCode();
		
		
		$wallete_data = array(
			 'debit' => $total_price,
			 'total_user_price'=>$total,
			 'total_cut_price'=>$cut_price,
			 'user_id'=>$win_user_id,
			  'wallet_date'=>date('Y-m-d H:i:s'),
             'admin_status'=>'Confirm',
             'wallet_transaction_id'=>$wallet_transaction_id,
			 'task_id'=>$task_id
		);
		$this->db->insert('wallet',$wallete_data);
		//echo '<pre>'; print_r($wallete_data);

	}


}
?>