<?php

class Gateways_detail_model  extends CI_Model  {
	
    function Gateways_detail_model()
    {
		parent::__construct();
    }   
	
	function detail_insert()
	{	
		
		
						$settings = array(
							'payment_gateway_id' => $this->input->post('payment_gateway_id'),
							'name' => $this->input->post('name'),
							'value' => $this->input->post('value'),
							'label' =>$this->input->post('label'),
							
							'description' => $this->input->post('description'),
							
							
						);		
						$this->db->insert('gateways_details',$settings);
										
						
	}
	
	function detail_update()
	{	
		
			
		
						$settings = array(
							'payment_gateway_id' => $this->input->post('payment_gateway_id'),
							'name' => $this->input->post('name'),
							'value' => $this->input->post('value'),
							'label' =>$this->input->post('label'),
							
							'description' => $this->input->post('description'),
							
							
						);			
							$this->db->where('id',$this->input->post('id'));
							$this->db->update('gateways_details',$settings);
										
					
	
	}
	
	function get_one_detail($id)
	{
		$query = $this->db->get_where('gateways_details',array('id'=>$id));
		return $query->row_array();
	}	
	
	function get_total_detail_count($id)
	{
		$query=$this->db->query("select get_det.id, 
						   get_det.payment_gateway_id,
						   get_det.name, 
						   get_det.value,
						   get_det.label,
						   get_det.description,
						   
						   pay_gat.name as payname 
						   
						   from ".$this->db->dbprefix('gateways_details')." as get_det left join ".$this->db->dbprefix('payments_gateways')." as pay_gat on 
						   get_det.payment_gateway_id= pay_gat.id where get_det.payment_gateway_id=".$id." order by get_det.id desc");
						   
						   
		
		return $query->num_rows();
		
	}
	
	function get_detail_result($id,$offset, $limit)
	{

						   $query=$this->db->query("select get_det.id, 
						   get_det.payment_gateway_id,
						   get_det.name, 
						   get_det.value,
						   get_det.label,
						   get_det.description,
						   
						   pay_gat.name as payname 
						   
						   from ".$this->db->dbprefix('gateways_details')." as get_det left join ".$this->db->dbprefix('payments_gateways')." as pay_gat on 
						   get_det.payment_gateway_id= pay_gat.id where get_det.payment_gateway_id=".$id." order by get_det.id desc limit ".$limit." offset ".$offset);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		}
		return 0;
	}
	
	function get_payment_result($id)
	{
		$query = $this->db->get_where('payments_gateways',array('id'=>$id));

		return $query->row_array();
	}
	
	
}
?>