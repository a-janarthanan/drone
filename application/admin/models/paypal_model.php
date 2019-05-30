<?php

class Paypal_model extends CI_Model {
	
    function Paypal_model()
    {
       parent::__construct();	
    }   
	
/*********paypal********/

	function get_total_paypal_count()
	{
		return $this->db->count_all('paypal');
	}
	
	function get_paypal_result($offset, $limit)
	{	
		$this->db->from('paypal');
		$this->db->order_by('paypal.id','desc');
		$this->db->limit($limit,$offset);
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return $query->result();
		}
		return 0;
	}	
	
	function paypal_insert()
	{
		$data = array(
			'site_status' => $this->input->post('site_status'),
			'application_id' => $this->input->post('application_id'),
			'paypal_email' => $this->input->post('paypal_email'),
			'paypal_username' => $this->input->post('paypal_username'),
			'paypal_password' => $this->input->post('paypal_password'),
			'paypal_signature' => $this->input->post('paypal_signature'),
			'preapproval' => $this->input->post('preapproval'),
			'fees_taken_from' => $this->input->post('fees_taken_from'),
			'transaction_fees' => $this->input->post('transaction_fees'),
			'gateway_status' => $this->input->post('gateway_status'),
		);		
		$this->db->insert('paypal',$data);
	}
	
	function paypal_update()
	{
	
		$data = array(			
			'site_status' => $this->input->post('site_status'),
			'application_id' => $this->input->post('application_id'),
			'paypal_email' => $this->input->post('paypal_email'),
			'paypal_username' => $this->input->post('paypal_username'),
			'paypal_password' => $this->input->post('paypal_password'),
			'paypal_signature' => $this->input->post('paypal_signature'),
			'preapproval' => $this->input->post('preapproval'),
			'fees_taken_from' => $this->input->post('fees_taken_from'),
			'transaction_fees' => $this->input->post('transaction_fees'),
			'gateway_status' => $this->input->post('gateway_status'),
		);
		$this->db->where('id',$this->input->post('id'));
		$this->db->update('paypal',$data);
		
	}
	
	function get_one_paypal($id)
	{
		$query = $this->db->get_where('paypal',array('id'=>$id));
		return $query->row_array();
	}	

	
}
?>