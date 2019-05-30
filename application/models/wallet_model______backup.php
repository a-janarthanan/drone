<?php
class Wallet_model extends CI_Model 
{

	/*
	Function name :wallet_model
	Description :its default constuctor which called when wallet_model object initialzie.its load necesary parent constructor
	*/
	function Wallet_model()
    {
        parent::__construct();	
    } 
	
	
	/*
	Function name :wallet_setting()
	Parameter :none
	Return : none
	Use : get the wallet setting
	*/
	
	function wallet_setting()
	{
		
		$query=$this->db->query("select * from ".$this->db->dbprefix('wallet_setting')." ");
		return $query->row();
	}
	
	/*
	Function name :get_total_my_wallet_list()
	Parameter :none
	Return : integer numbet of records
	Use : get user total wallet transaction count
	*/
	
	function get_total_my_wallet_list()
	{
		$query=$this->db->query("select * from ".$this->db->dbprefix('wallet')." where user_id='".get_authenticateUserID()."' order by id desc ");
		
		
		if($query->num_rows()>0)
		{
			return $query->num_rows();
		}
		
		return 0;
			
	}
	
	/*
	Function name :my_wallet_list()
	Parameter : $offset (for paging starting index of record), $limit (for paging limit of records)
	Return : array of records
	Use : get user total wallet transaction records
	*/
	
	function my_wallet_list($offset,$limit)
	{
		$query=$this->db->query("select * from ".$this->db->dbprefix('wallet')." where user_id='".get_authenticateUserID()."' order by id desc limit ".$limit." offset ".$offset);
		
		if($query->num_rows()>0)
		{
			return $query->result();
		}
		
		return 0;
			
	}
	
	
	/*
	Function name :my_wallet_amount()
	Parameter :none
	Return : double user current wallet amount
	Use : get user total wallet amount from his total credit and total debit
	*/
	
	function my_wallet_amount()
	{
	
	  	 
			 $query = $this->db->query("SELECT SUM(debit) as sumd,SUM(credit) as sumc FROM ".$this->db->dbprefix('wallet')." where admin_status='Confirm' and user_id='".get_authenticateUserID()."'"); 
	 
	 
	 		if($query->num_rows()>0)
			{
			
				 $result = $query->row();
			
				 $debit=$result->sumd;
				 $credit=$result->sumc;
				
				 $total=number_format(($debit-$credit), 2, '.', '');
				
				return $total;
			
			}
			
			return 0;
		
	}
	
	
	/*
	Function name :get_paymentact_result()
	Parameter :none
	Return : array of all payment gateways
	Use : get all active payment gateway list
	*/
	
	function get_paymentact_result()
	{		
		 $query = $this->db->query("SELECT * FROM ".$this->db->dbprefix('payments_gateways')." where status='Active' order by id desc");  
	     if($query->num_rows()>0)
		 {
			return $query->result();
		  }
		return 0;

	}
	
	/*
	Function name :get_paymentid_result()
	Parameter : $id (payment gateway id)
	Return : array of one payment gateway details
	Use : get one payment gateway details
	*/
	
	function get_paymentid_result($id)
	{
		 $query = $this->db->query("SELECT * FROM ".$this->db->dbprefix('payments_gateways')." where id='".$id."' order by id desc");  
	     if($query->num_rows()>0)
		 {
			return $query->row();
		  }
		return 0;
		
	}
	
	
	/*
	Function name :get_gateway_result()
	Parameter : $id (payment gateway id), $name (payment gateway setting key pair name)
	Return :  array payment gateway setting key pair value
	Use : get one payment gateway setting detail 
	*/
	
	function get_gateway_result($id,$name)
	{
		 $query = $this->db->query("SELECT * FROM ".$this->db->dbprefix('gateways_details')." where payment_gateway_id='".$id."' and name='".$name."' order by payment_gateway_id desc");  
	     if($query->num_rows()>0)
		 {
			return $query->row();
		  }
		return 0;	
	}
	
	
	
	/*
	Function name :get_gateway_detailByid()
	Parameter : $id (payment gateway id)
	Return :  array of payment gateway details 
	Use : get one payment gateway details
	*/
	
	function get_gateway_detailByid($id)
	{
		 $query = $this->db->query("SELECT * FROM ".$this->db->dbprefix('gateways_details')." where payment_gateway_id='".$id."' order by payment_gateway_id desc");  
	     if($query->num_rows()>0)
		 {
			return $query->result();
		  }
		return 0;	
	}
	
	
	/*
	Function name :check_unique_transaction()
	Parameter : $txn_id (transaction id)
	Return :  1 or 0
	Use : check for unique transaction ID in the database and stop double entry in the system 
	*/
	
	function check_unique_transaction($txn_id)
	{
		$query=$this->db->query("select * from ".$this->db->dbprefix('wallet')." where wallet_transaction_id='".$txn_id."'");
		
		if($query->num_rows()>0)
		{
			return 1;
		}
		
		return 0;
	
	}
		
		
		
	/*
	Function name :get_withdraw_detail()
	Parameter : $id (withdrawal id)
	Return :  array of one withdrawal details
	Use : get user one withdrawal details from unquie id
	*/
	
	function get_withdraw_detail($id)
	{
		$query=$this->db->query("select * from ".$this->db->dbprefix('wallet_withdraw')." where withdraw_id='".$id."'");
		
		if($query->num_rows()>0)
		{
			return $query->row();
		}
		
		return 0;
		
	}
	
	
	
	/*
	Function name :get_withdraw_method_detail()
	Parameter : $withdraw_id (withdrawal id), $type ( withdrwal type = (bank, check, gateway) )
	Return :  array of withdrawal type details
	Use : get user withdrawal type details
	*/
	
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
	
	
	
	/*
	Function name :add_withdraw_request()
	Parameter : none
	Return :  integer last withdrawal ID
	Use : add user new withdraw request with pending status
	*/
	
	function add_withdraw_request()
	{
	
		$withdraw_method=$this->input->post('withdraw_method');
		$amount=$this->input->post('amount');
		
		$data_withdraw=array(			
			'user_id'=>get_authenticateUserID(),
			'withdraw_date'=>date('Y-m-d H:i:s'),
			'withdraw_ip' => $_SERVER['REMOTE_ADDR'],
			'withdraw_method' => $withdraw_method,
			'withdraw_amount' => $amount,
			'withdraw_status' => 'pending'	
		);
	
		$this->db->insert('wallet_withdraw',$data_withdraw);
		
		$withdraw_id=mysql_insert_id();
		
		
		if($withdraw_method=='bank')
		{
			$data_bank=array(
			'withdraw_id' => $withdraw_id,
			'bank_name'=>$this->input->post('bank_name'),
			'bank_branch'=>$this->input->post('bank_branch'),
			'bank_ifsc_code'=>$this->input->post('bank_ifsc_code'),
			'bank_address'=>$this->input->post('bank_address'),
			'bank_city'=>$this->input->post('bank_city'),
			'bank_state'=>$this->input->post('bank_state'),
			'bank_country'=>$this->input->post('bank_country'),
			'bank_zipcode'=>$this->input->post('bank_zipcode'),
			'bank_account_holder_name'=>$this->input->post('bank_account_holder_name'),
			'bank_account_number'=>$this->input->post('bank_account_number'),
			'bank_withdraw_type' => 'bank'
			);
			
				
				$this->db->insert('wallet_bank',$data_bank);
		
		}
		
		
		if($withdraw_method=='check')
		{
			
			$data_check=array(
			'withdraw_id' => $withdraw_id,
			'bank_name'=>$this->input->post('check_name'),
			'bank_branch'=>$this->input->post('check_branch'),
			'bank_unique_id'=>$this->input->post('check_unique_id'),
			'bank_address'=>$this->input->post('check_address'),
			'bank_city'=>$this->input->post('check_city'),
			'bank_state'=>$this->input->post('check_state'),
			'bank_country'=>$this->input->post('check_country'),
			'bank_zipcode'=>$this->input->post('check_zipcode'),
			'bank_account_holder_name'=>$this->input->post('check_account_holder_name'),
			'bank_account_number'=>$this->input->post('check_account_number'),
			'bank_withdraw_type' => 'check'
			);
			
				
			$this->db->insert('wallet_bank',$data_check);
		
		}
		
		if($withdraw_method=='gateway')
		{
		
			$data_gateway=array(
				'withdraw_id' => $withdraw_id,
				'gateway_name'=>$this->input->post('gateway_name'),
				'gateway_account'=>$this->input->post('gateway_account'),
				'gateway_city'=>$this->input->post('gateway_city'),
				'gateway_state'=>$this->input->post('gateway_state'),
				'gateway_country'=>$this->input->post('gateway_country'),
				'gateway_zip'=>$this->input->post('gateway_zip')			
			);
			
			
			$this->db->insert('wallet_withdraw_gateway',$data_gateway);
			
		
		}
		
		return mysql_insert_id();
	
	
	}

	function add_credit_request()
	{
	
		$withdraw_method=$this->input->post('withdraw_method');
		$amount=$this->input->post('amount');
		
		
		
		
		if($withdraw_method=='bank')
		{
			$data_bank=array(
			'user_id'=>get_authenticateUserID(),
			'withdraw_date'=>date('Y-m-d H:i:s'),
			'withdraw_ip' => $_SERVER['REMOTE_ADDR'],
			'withdraw_method' => $withdraw_method,
			'withdraw_amount' => $amount,
			'package_id' => $this->input->post('packid'),
			'bank_name'=>$this->input->post('bank_name'),
			'bank_branch'=>$this->input->post('bank_branch'),
			'bank_ifsc_code'=>$this->input->post('bank_ifsc_code'),
			'bank_address'=>$this->input->post('bank_address'),
			'bank_city'=>$this->input->post('bank_city'),
			'bank_state'=>$this->input->post('bank_state'),
			'bank_country'=>$this->input->post('bank_country'),
			'bank_zipcode'=>$this->input->post('bank_zipcode'),
			'bank_account_holder_name'=>$this->input->post('bank_account_holder_name'),
			'bank_account_number'=>$this->input->post('bank_account_number'),
			'bank_doc'=>$data['bank_doc'],
			'bank_withdraw_type' => 'bank'
			);
			
				
				$this->db->insert('credit_bankinfo',$data_bank);
		
		}
		
		
		if($withdraw_method=='check')
		{
			
			$data_check=array(
			'withdraw_id' => $withdraw_id,
			'bank_name'=>$this->input->post('check_name'),
			'bank_branch'=>$this->input->post('check_branch'),
			'bank_unique_id'=>$this->input->post('check_unique_id'),
			'bank_address'=>$this->input->post('check_address'),
			'bank_city'=>$this->input->post('check_city'),
			'bank_state'=>$this->input->post('check_state'),
			'bank_country'=>$this->input->post('check_country'),
			'bank_zipcode'=>$this->input->post('check_zipcode'),
			'bank_account_holder_name'=>$this->input->post('check_account_holder_name'),
			'bank_account_number'=>$this->input->post('check_account_number'),
			'bank_withdraw_type' => 'check'
			);
			
				
			$this->db->insert('wallet_bank',$data_check);
		
		}
		
		if($withdraw_method=='gateway')
		{
		
			$data_gateway=array(
				'withdraw_id' => $withdraw_id,
				'gateway_name'=>$this->input->post('gateway_name'),
				'gateway_account'=>$this->input->post('gateway_account'),
				'gateway_city'=>$this->input->post('gateway_city'),
				'gateway_state'=>$this->input->post('gateway_state'),
				'gateway_country'=>$this->input->post('gateway_country'),
				'gateway_zip'=>$this->input->post('gateway_zip')			
			);
			
			
			$this->db->insert('wallet_withdraw_gateway',$data_gateway);
			
		
		}
		
		return mysql_insert_id();
	
	
	}
	
	
	/*
	Function name :update_withdraw_request()
	Parameter : none
	Return :  integer last updated withdrawal ID
	Use : update user withdraw request until administrator have not confirm the request
	*/
	
	function update_withdraw_request()
	{
	
		$withdraw_method=$this->input->post('withdraw_method');
		$amount=$this->input->post('amount');
		
		$withdraw_id=$this->input->post('withdraw_id');
		
		
		$data_withdraw=array(			
			'user_id'=>get_authenticateUserID(),
			'withdraw_date'=>date('Y-m-d H:i:s'),
			'withdraw_ip' => $_SERVER['REMOTE_ADDR'],
			'withdraw_method' => $withdraw_method,
			'withdraw_amount' => $amount,
			'withdraw_status' => 'pending'	
		);
	
		$this->db->where('withdraw_id',$withdraw_id);
		$this->db->update('wallet_withdraw',$data_withdraw);
		
		
		
		if($withdraw_method=='bank')
		{
		
			$get_bank_details=$this->db->query("select * from ".$this->db->dbprefix('wallet_bank')." where bank_withdraw_type='bank' and withdraw_id='".$withdraw_id."'");
			
			if($get_bank_details->num_rows()>0)
			{
				
					$data_bank=array(
					'withdraw_id' => $withdraw_id,
					'bank_name'=>$this->input->post('bank_name'),
					'bank_branch'=>$this->input->post('bank_branch'),
					'bank_ifsc_code'=>$this->input->post('bank_ifsc_code'),
					'bank_address'=>$this->input->post('bank_address'),
					'bank_city'=>$this->input->post('bank_city'),
					'bank_state'=>$this->input->post('bank_state'),
					'bank_country'=>$this->input->post('bank_country'),
					'bank_zipcode'=>$this->input->post('bank_zipcode'),
					'bank_account_holder_name'=>$this->input->post('bank_account_holder_name'),
					'bank_account_number'=>$this->input->post('bank_account_number'),
					'bank_withdraw_type' => 'bank'
					);
					
						$this->db->where('withdraw_id',$withdraw_id);
						$this->db->update('wallet_bank',$data_bank);
			
			}
			else
			{
					$data_bank=array(
					'withdraw_id' => $withdraw_id,
					'bank_name'=>$this->input->post('bank_name'),
					'bank_branch'=>$this->input->post('bank_branch'),
					'bank_ifsc_code'=>$this->input->post('bank_ifsc_code'),
					'bank_address'=>$this->input->post('bank_address'),
					'bank_city'=>$this->input->post('bank_city'),
					'bank_state'=>$this->input->post('bank_state'),
					'bank_country'=>$this->input->post('bank_country'),
					'bank_zipcode'=>$this->input->post('bank_zipcode'),
					'bank_account_holder_name'=>$this->input->post('bank_account_holder_name'),
					'bank_account_number'=>$this->input->post('bank_account_number'),
					'bank_withdraw_type' => 'bank'
					);
				
					
					$this->db->insert('wallet_bank',$data_bank);
			
			}
			
			
		
		}
		
		
		if($withdraw_method=='check')
		{
			
			
			$get_check_details=$this->db->query("select * from ".$this->db->dbprefix('wallet_bank')." where bank_withdraw_type='check' and withdraw_id='".$withdraw_id."'");
			
			if($get_check_details->num_rows()>0)
			{
				
				$data_check=array(
				'withdraw_id' => $withdraw_id,
				'bank_name'=>$this->input->post('check_name'),
				'bank_branch'=>$this->input->post('check_branch'),
				'bank_unique_id'=>$this->input->post('check_unique_id'),
				'bank_address'=>$this->input->post('check_address'),
				'bank_city'=>$this->input->post('check_city'),
				'bank_state'=>$this->input->post('check_state'),
				'bank_country'=>$this->input->post('check_country'),
				'bank_zipcode'=>$this->input->post('check_zipcode'),
				'bank_account_holder_name'=>$this->input->post('check_account_holder_name'),
				'bank_account_number'=>$this->input->post('check_account_number'),
				'bank_withdraw_type' => 'check'
				);
				
				
				$this->db->where('withdraw_id',$withdraw_id);	
				$this->db->update('wallet_bank',$data_check);
			
			}
			
			else
			{
				$data_check=array(
				'withdraw_id' => $withdraw_id,
				'bank_name'=>$this->input->post('check_name'),
				'bank_branch'=>$this->input->post('check_branch'),
				'bank_unique_id'=>$this->input->post('check_unique_id'),
				'bank_address'=>$this->input->post('check_address'),
				'bank_city'=>$this->input->post('check_city'),
				'bank_state'=>$this->input->post('check_state'),
				'bank_country'=>$this->input->post('check_country'),
				'bank_zipcode'=>$this->input->post('check_zipcode'),
				'bank_account_holder_name'=>$this->input->post('check_account_holder_name'),
				'bank_account_number'=>$this->input->post('check_account_number'),
				'bank_withdraw_type' => 'check'
				);
				
				
			
				$this->db->insert('wallet_bank',$data_check);
			
			}
			
			
		
		}
		
		if($withdraw_method=='gateway')
		{
			
			$get_gateway_details=$this->db->query("select * from ".$this->db->dbprefix('wallet_withdraw_gateway')." where withdraw_id='".$withdraw_id."'");
			
			if($get_gateway_details->num_rows()>0)
			{
				
				$data_gateway=array(
					'withdraw_id' => $withdraw_id,
					'gateway_name'=>$this->input->post('gateway_name'),
					'gateway_account'=>$this->input->post('gateway_account'),
					'gateway_city'=>$this->input->post('gateway_city'),
					'gateway_state'=>$this->input->post('gateway_state'),
					'gateway_country'=>$this->input->post('gateway_country'),
					'gateway_zip'=>$this->input->post('gateway_zip')			
				);
			
				$this->db->where('withdraw_id',$withdraw_id);	
				$this->db->update('wallet_withdraw_gateway',$data_gateway);
			
			}
			
			else
			{
			
				$data_gateway=array(
					'withdraw_id' => $withdraw_id,
					'gateway_name'=>$this->input->post('gateway_name'),
					'gateway_account'=>$this->input->post('gateway_account'),
					'gateway_city'=>$this->input->post('gateway_city'),
					'gateway_state'=>$this->input->post('gateway_state'),
					'gateway_country'=>$this->input->post('gateway_country'),
					'gateway_zip'=>$this->input->post('gateway_zip')			
				);
				
				
				$this->db->insert('wallet_withdraw_gateway',$data_gateway);
			
			
			}
			
		
		}
		
		
	
	
	}
	
	
	/*
	Function name :get_total_my_withdraw_list()
	Parameter : none
	Return :  integer of user total withdrawal request record
	Use : get user total withdrawal request records
	*/
	
	
	function get_total_my_withdraw_list()
	{
		$query=$this->db->query("select * from ".$this->db->dbprefix('wallet_withdraw')." where user_id='".get_authenticateUserID()."' order by withdraw_id desc");
		
		if($query->num_rows()>0)
		{
			return $query->num_rows();
		}
		
		return 0;
		
	}
	
	
	/*
	Function name :my_withdraw_list()
	Parameter : $offset (for paging starting index of record), $limit (for paging limit of records)
	Return : array of records
	Use : get user total wallet withdrawal list
	*/
	
	function my_withdraw_list($offset,$limit)
	{
		$query=$this->db->query("select * from ".$this->db->dbprefix('wallet_withdraw')." where user_id='".get_authenticateUserID()."' order by withdraw_id desc limit ".$limit." offset ".$offset);
		
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