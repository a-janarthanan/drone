<?php

class Wallet_report_model extends CI_Model {
	
    function Wallet_report_model()
    {
        parent::__construct();	
    }  
	
	function get_daily_result($option)
	{
	
		$start_day = date('Y-m-d H:i:s');
		if($option == 'five') {
			$end_day = date('Y-m-d H:i:s',mktime(0,0,0,date('m'),date('d')-4,date('Y')));
		}
		
		if($option == 'ten') {
			$end_day = date('Y-m-d H:i:s',mktime(0,0,0,date('m'),date('d')-9,date('Y')));
		}
		
		if($option == 'fifteen') {
			$end_day = date('Y-m-d H:i:s',mktime(0,0,0,date('m'),date('d')-14,date('Y')));
		}
		
		if($option == 'thirty') {
			$end_day = date('Y-m-d H:i:s',mktime(0,0,0,date('m'),date('d')-29,date('Y')));
		}
		
		if($option == 'all') {
			$end_day ='';
		}
		
		$this->db->select('*');
		$this->db->from('transaction ts');
		$this->db->join('user ur','ts.user_id=ur.user_id','left');
		$this->db->join('user_profile up','ur.user_id=up.user_id','left');
		$this->db->join('task tk','ts.task_id=tk.task_id');
		if($end_day != '') {
			$this->db->where("ts.transaction_date_time BETWEEN '$end_day' AND '$start_day'");  
		} else {
			//$this->db->where("Month(ts.transaction_date_time) = '".date('m')."'"); 
		}
		$this->db->order_by('ts.transaction_date_time','desc');
		$query=$this->db->get();
		//echo $this->db->last_query(); //die();
		if ($query->num_rows() > 0) {
			return $query->result();
		}
		return 0;

	}
	
	function total_earning($option){
	
		$earning_price = '0.00';
		$end_day ='';
		$month = '';
		$year = '';
		
		$start_day = date('Y-m-d H:i:s');
		if($option == 'five') {
			$end_day = date('Y-m-d H:i:s',mktime(0,0,0,date('m'),date('d')-4,date('Y')));
		}
		
		if($option == 'ten') {
			$end_day = date('Y-m-d H:i:s',mktime(0,0,0,date('m'),date('d')-9,date('Y')));
		}
		
		if($option == 'fifteen') {
			$end_day = date('Y-m-d H:i:s',mktime(0,0,0,date('m'),date('d')-14,date('Y')));
		}
		
		if($option == 'thirty') {
			$end_day = date('Y-m-d H:i:s',mktime(0,0,0,date('m'),date('d')-29,date('Y')));
		}
		
		if($option == 'all') {
			$end_day ='';
		}
		
		if($option == 'one') {$month = '-1'; }
		if($option == 'two') { $month = '-2'; }
		if($option == 'three') { $month = '-3'; }
		if($option == 'six') { $month = '-6'; }
		
		if($option == 'one_year') {$year = '-1'; }
		if($option == 'two_year') { $year = '-2'; }
		if($option == 'three_year') { $year = '-3'; }
		if($option == 'six_year') { $year = '-6'; }
		
		$this->db->select('*');
		$this->db->from('transaction ts');
		$this->db->join('user ur','ts.user_id=ur.user_id','left');
		$this->db->join('user_profile up','ur.user_id=up.user_id','left');
		$this->db->join('task tk','ts.task_id=tk.task_id');
		
		if($end_day != '') { $this->db->where("ts.transaction_date_time BETWEEN '$end_day' AND '$start_day'"); }
		
		elseif($month != ''){
			$this->db->where("ts.transaction_date_time BETWEEN DATE_ADD('".date('Y-m-d')."', INTERVAL '".$month."' MONTH ) AND '".date('Y-m-d')."'"); 
			
		} elseif($year != ''){  
			$this->db->where("ts.transaction_date_time BETWEEN DATE_ADD('".date('Y-m-d')."', INTERVAL '".$year."' YEAR ) AND '".date('Y-m-d')."'"); 
		} else {
		
			if($option == 'current') {
				$this->db->where("Year(ts.transaction_date_time) = '".date('Y')."'"); 
				$this->db->where("Month(ts.transaction_date_time) = '".date('m')."'"); 
				
			} elseif($option == 'current_year') {
				$this->db->where("Year(ts.transaction_date_time) = '".date('Y')."'"); 
				  
			} else {
				//$this->db->where("Month(ts.transaction_date_time) = '".date('m')."'"); 
			}
		}
		$this->db->order_by('ts.transaction_date_time','desc');
		$query=$this->db->get();
		//echo $this->db->last_query(); //die();
		foreach($query->result() as $row){
			if($row->task_worker_id !=0) {
				 $worker_wallet = $this->transaction_model->worker_pay($row->task_worker_id,$row->task_id); 
				 if($worker_wallet) {
					if($worker_wallet->total_cut_price != ''){
						$earning_price = $earning_price + $worker_wallet->total_cut_price;
					} 
				}	 
			}
		}
		
		return number_format($earning_price,'2','.','');
	}
	
	function total_daily_earning($date)
	{
		
		$date = explode('-',$date);
		$earning_price = '0.00';
		
		$this->db->select('*');
		$this->db->from('transaction ts');
		$this->db->join('user ur','ts.user_id=ur.user_id','left');
		$this->db->join('user_profile up','ur.user_id=up.user_id','left');
		$this->db->join('task tk','ts.task_id=tk.task_id');	
		$this->db->where("Year(ts.transaction_date_time) = '".$date['0']."'"); 
		if(array_key_exists('1',$date)){
			$this->db->where("Month(ts.transaction_date_time) = '".$date['1']."'"); 
		}
		
		if(array_key_exists('2',$date)){
			$this->db->where("Day(ts.transaction_date_time) = '".$date['2']."'"); 
		}
		
		$this->db->order_by('ts.transaction_date_time','desc');
		$query=$this->db->get();
		
		foreach($query->result() as $row){
			if($row->task_worker_id !=0) {
				 $worker_wallet = $this->transaction_model->worker_pay($row->task_worker_id,$row->task_id); 
				 if($worker_wallet) {
					if($worker_wallet->total_cut_price != ''){
						$earning_price = $earning_price + $worker_wallet->total_cut_price;
					} 
				}	 
			}
		}
		
		return number_format($earning_price,'2','.','');
	}
	
	
	function get_monthly_result($option)
	{
		
		
		if($option == 'one') {$month = '-1'; }
		
		if($option == 'two') { $month = '-2'; }
		
		if($option == 'three') { $month = '-3'; }
		
		if($option == 'six') { $month = '-6'; }

		$this->db->select('*');
		$this->db->from('transaction ts');
		$this->db->join('user ur','ts.user_id=ur.user_id','left');
		$this->db->join('user_profile up','ur.user_id=up.user_id','left');
		$this->db->join('task tk','ts.task_id=tk.task_id');
		
		if($option == 'current') {
			$this->db->where("Year(ts.transaction_date_time) = '".date('Y')."'"); 
			$this->db->where("Month(ts.transaction_date_time) = '".date('m')."'");
			  
		} elseif($option == 'all') {
		
		} else {
			$this->db->where("ts.transaction_date_time BETWEEN DATE_ADD('".date('Y-m-d')."', INTERVAL '".$month."' MONTH ) AND '".date('Y-m-d')."'"); 
		}
			
		$this->db->order_by('ts.transaction_date_time','desc');
		$query=$this->db->get();
		//echo $this->db->last_query(); //die();
		if ($query->num_rows() > 0) {
			return $query->result();
		}
		return 0;

	}
	
	function get_yearly_result($option)
	{
		if($option == 'one_year') {$year = '-1'; }
		
		if($option == 'two_year') { $year = '-2'; }
		
		if($option == 'three_year') { $year = '-3'; }
		
		if($option == 'six_year') { $year = '-6'; }

		$this->db->select('*');
		$this->db->from('transaction ts');
		$this->db->join('user ur','ts.user_id=ur.user_id','left');
		$this->db->join('user_profile up','ur.user_id=up.user_id','left');
		$this->db->join('task tk','ts.task_id=tk.task_id');
		
		if($option == 'current_year') {
			$this->db->where("Year(ts.transaction_date_time) = '".date('Y')."'");   
		} elseif($option == 'all') {
		
		} else {
			$this->db->where("ts.transaction_date_time BETWEEN DATE_ADD('".date('Y-m-d')."', INTERVAL '".$year."' YEAR ) AND '".date('Y-m-d')."'"); 
		}
			
		$this->db->order_by('ts.transaction_date_time','desc');
		$query=$this->db->get();
		//echo $this->db->last_query(); //die();
		if ($query->num_rows() > 0) {
			return $query->result();
		}
		return 0;

	}

}	