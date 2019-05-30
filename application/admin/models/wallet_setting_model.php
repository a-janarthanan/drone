<?php

class Wallet_setting_model extends CI_Model {
	
    function Wallet_setting_model()
    {
       parent::__construct();	
    }   
	
	function wallet_setting_update()
	{
		$data = array(			
			'wallet_add_fees' => $this->input->post('wallet_add_fees'),
			'wallet_donation_fees' => $this->input->post('wallet_donation_fees'),
			'wallet_enable' => $this->input->post('wallet_enable'),	
			'wallet_minimum_amount' => $this->input->post('wallet_minimum_amount'),
			'no_payment_after_auto_confirm' => $this->input->post('no_payment_after_auto_confirm')		
		);
		$this->db->where('wallet_id',$this->input->post('wallet_id'));
		$this->db->update('wallet_setting',$data);
		
		
		$supported_cache=check_supported_cache_driver();
		
		if(isset($supported_cache))
		{
			if($supported_cache!='' && $supported_cache!='none')
			{
			
				////===load cache driver===
				$this->load->driver('cache');				
				
				$query = $this->db->get("wallet_setting");
									
				$this->cache->$supported_cache->save('wallet_setting', $query->row(),CACHE_VALID_SEC);		
				
			}			
			
		}
		
		
		
		
	}
	
	function get_one_wallet_setting()
	{
		$query = $this->db->get_where('wallet_setting');
		return $query->row_array();
	}
	
	
}
?>