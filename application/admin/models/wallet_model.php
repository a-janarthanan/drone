<?php

class Wallet_model  extends CI_Model  {
	
    function Wallet_model()
    {
       /* parent::Model();
		$this->load->helper('url');
		$this->load->database();*/
		parent::__construct();	
    }  
	
	
	function wallet_setting()
	{
		$query=$this->db->get_where('wallet_setting');
		return $query->row();
			
	}
	
	
	
	
	function user_current_wallet_amount($uid) 
	{
		 $query = $this->db->query("SELECT SUM(debit) as sumd,SUM(credit) as sumc FROM ".$this->db->dbprefix('wallet')." where admin_status='Confirm' and user_id='".$uid."'"); 
	 
	 
	 		if($query->num_rows()>0)
			{
			
				 $result = $query->row();
			
				 $debit=$result->sumd;
				 $credit=$result->sumc;
				
				 $total=$debit-$credit;
				
				return $total;
			
			}
			
			return 0;
	}	
	
	function get_total_search_withdraw_count($option,$keyword)
	{
		if($option=='full_name')
		{
			$option='us.full_name';
		}
		if($option=='email')
		{
			$option='us.email';
		}
		if($option=='withdraw_method')
		{
			$option='wt.withdraw_method';
		}
		if($option=='withdraw_status')
		{
			$option='wt.withdraw_status';
		}
		if($option=='withdraw_ip')
		{
			$option='wt.withdraw_ip';
		}
		
		
		
		
		
		$query=$this->db->query("select wt.*, us.full_name,us.last_name,us.email from ".$this->db->dbprefix('wallet_withdraw')." wt left join ".$this->db->dbprefix('user')." us on wt.user_id=us.user_id where ".$option." like '%".$keyword."%'  order by  wt.withdraw_status desc, wt.withdraw_id desc");
		
		if($query->num_rows()>0)
		{	
			return $query->num_rows();
		}
		
		return 0;
	}
	
	
	function get_search_withdraw_result($option,$keyword,$offset, $limit)
	{
		
		if($option=='full_name')
		{
			$option='us.full_name';
		}
		if($option=='email')
		{
			$option='us.email';
		}
		if($option=='withdraw_method')
		{
			$option='wt.withdraw_method';
		}
		if($option=='withdraw_status')
		{
			$option='wt.withdraw_status';
		}
		if($option=='withdraw_ip')
		{
			$option='wt.withdraw_ip';
		}
	
		$query=$this->db->query("select wt.*, us.full_name,us.last_name,us.email from ".$this->db->dbprefix('wallet_withdraw')." wt left join ".$this->db->dbprefix('user')." us on wt.user_id=us.user_id where ".$option." like '%".$keyword."%' order by wt.withdraw_status desc, wt.withdraw_id desc limit ".$limit." offset ".$offset);
		
		if($query->num_rows()>0)
		{	
			return $query->result();
		}
		
		return 0;
	
	}
	
	
	
	
	function get_total_withdraw_count()
	{
		$query=$this->db->query("select wt.*, us.full_name,us.last_name,us.email from ".$this->db->dbprefix('wallet_withdraw')." wt left join ".$this->db->dbprefix('user')." us on wt.user_id=us.user_id  order by  wt.withdraw_status desc, wt.withdraw_id desc");
		
		if($query->num_rows()>0)
		{	
			return $query->num_rows();
		}
		
		return 0;
	}
	
	
	function get_withdraw_result($offset, $limit)
	{
		$query=$this->db->query("select wt.*, us.full_name,us.last_name,us.email from ".$this->db->dbprefix('wallet_withdraw')." wt left join ".$this->db->dbprefix('user')." us on wt.user_id=us.user_id  order by wt.withdraw_status desc, wt.withdraw_id desc limit ".$limit." offset ".$offset);
		
		if($query->num_rows()>0)
		{	
			return $query->result();
		}
		
		return 0;
	
	}
	
	
	
	function get_withdraw_detail($id)
	{
		$query=$this->db->query("select wt.*,us.full_name,us.last_name,us.email from ".$this->db->dbprefix('wallet_withdraw')." wt left join ".$this->db->dbprefix('user')." us on wt.user_id=us.user_id where wt.withdraw_id='".$id."'");
		
		if($query->num_rows()>0)
		{
			return $query->row();
		}
		
		return 0;
		
	}
	
	
	function get_withdraw_method_detail($withdraw_id,$type)
	{
		
		if($type=='bank')
		{
		
	$get_bank_details=$this->db->query("select * from ".$this->db->dbprefix('wallet_bank')." where bank_withdraw_type='bank' and withdraw_id='".$withdraw_id."'");
			
			if($get_bank_details->num_rows()>0)
			{			
				return $get_bank_details->row();
			}
			return 0;
		}
		
		
		if($type=='check')
		{
		
	$get_check_details=$this->db->query("select * from ".$this->db->dbprefix('wallet_bank')." where bank_withdraw_type='check' and withdraw_id='".$withdraw_id."'");
			
			if($get_check_details->num_rows()>0)
			{		
				return $get_check_details->row();
			}
			return 0;
		}
		
		
		
		if($type=='gateway')
		{
			
			$get_gateway_details=$this->db->query("select * from ".$this->db->dbprefix('wallet_withdraw_gateway')." where withdraw_id='".$withdraw_id."'");
			
			if($get_gateway_details->num_rows()>0)
			{	
				return $get_gateway_details->row();
			}
			
			return 0;
		}
		
		return 0;
		
	}
	
	
	
	
	
	
	
	
	
	function get_gateway_name($id)
	{
		$query = $this->db->get_where('payments_gateways',array('id'=>$id));
		return $query->row();
	}
	
	
	function get_total_wallet_review_count()
	{
		$query=$this->db->query("select wt.*, us.full_name,us.last_name,us.email from ".$this->db->dbprefix('wallet')." wt left join ".$this->db->dbprefix('user')." us on wt.user_id=us.user_id  where (wt.credit='' or wt.credit=0) order by  wt.admin_status desc, wt.id desc");
		
		if($query->num_rows()>0)
		{	
			return $query->num_rows();
		}
		
		return 0;
	}
	
	
	function get_wallet_review_result($offset, $limit)
	{
		$query=$this->db->query("select wt.*, us.full_name,us.last_name,us.email from ".$this->db->dbprefix('wallet')." wt left join ".$this->db->dbprefix('user')." us on wt.user_id=us.user_id  where (wt.credit='' or wt.credit=0) order by wt.admin_status desc, wt.id desc limit ".$limit." offset ".$offset);
		
		if($query->num_rows()>0)
		{	
			return $query->result();
		}
		
		return 0;
	
	}

	function get_total_buy_credit_count()
	{
		$query=$this->db->query("select * from trc_credit_bankinfo");
		
		if($query->num_rows()>0)
		{	
			return $query->num_rows();
		}
		
		return 0;
	}
	function get_buy_credit_result($offset, $limit)
	{
		$query=$this->db->query("select * from trc_credit_bankinfo order by id desc limit ".$limit." offset ".$offset);
		
		if($query->num_rows()>0)
		{	
			return $query->result();
		}
		
		return 0;
	
	}

	function get_total_buy_onlinecredit_count()
	{
		$query=$this->db->query("select * from trc_online_credit");
		
		if($query->num_rows()>0)
		{	
			return $query->num_rows();
		}
		
		return 0;
	}
	function get_buy_onlinecredit_result($offset, $limit)
	{
		$query=$this->db->query("select * from trc_online_credit order by id desc limit ".$limit." offset ".$offset);
		
		if($query->num_rows()>0)
		{	
			return $query->result();
		}
		
		return 0;
	
	}
	
	
	function get_total_search_wallet_review_count($option,$keyword)
	{
		if($option=='full_name')
		{
			$option='us.full_name';
		}
		if($option=='email')
		{
			$option='us.email';
		}
		if($option=='wallet_payee_email')
		{
			$option='wt.wallet_payee_email';
		}
		if($option=='wallet_transaction_id')
		{
			$option='wt.wallet_transaction_id';
		}
		if($option=='admin_status')
		{
			$option='wt.admin_status';
		}
		if($option=='wallet_ip')
		{
			$option='wt.wallet_ip';
		}
		
		
		$query=$this->db->query("select wt.*, us.full_name,us.last_name,us.email from ".$this->db->dbprefix('wallet')." wt left join ".$this->db->dbprefix('user')." us on wt.user_id=us.user_id  where (wt.credit='' or wt.credit=0) and  ".$option." like '%".$keyword."%' order by  wt.admin_status desc, wt.id desc");
		
				
		if($query->num_rows()>0)
		{	
			return $query->num_rows();
		}
		
		return 0;
	}
	
	
	function get_search_wallet_review_result($option,$keyword,$offset, $limit)
	{
		
		if($option=='full_name')
		{
			$option='us.full_name';
		}
		if($option=='email')
		{
			$option='us.email';
		}
		if($option=='wallet_payee_email')
		{
			$option='wt.wallet_payee_email';
		}
		if($option=='wallet_transaction_id')
		{
			$option='wt.wallet_transaction_id';
		}
		if($option=='admin_status')
		{
			$option='wt.admin_status';
		}
		if($option=='wallet_ip')
		{
			$option='wt.wallet_ip';
		}
	
		
		$query=$this->db->query("select wt.*, us.full_name,us.last_name,us.email from ".$this->db->dbprefix('wallet')." wt left join ".$this->db->dbprefix('user')." us on wt.user_id=us.user_id  where (wt.credit='' or wt.credit=0) and ".$option." like '%".$keyword."%'  order by wt.admin_status desc, wt.id desc limit ".$limit." offset ".$offset);
		
		
		if($query->num_rows()>0)
		{	
			return $query->result();
		}
		
		return 0;
	
	}

	function getNameTable($table,$col,$field,$value)
	{
		$query="SELECT ".$col." FROM ".$table." where ".$field."='".$value."' AND ".$field." IS NOT NULL";
		//echo $query;
		$recordSet = $this->db->query($query);
		if($recordSet->num_rows() > 0)
		{
			$row = $recordSet->row_array();
			return $row[$col];
		}
		else
		{
			return "";
		}
	}
	
	
}

?>