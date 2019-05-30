<?php

class Payments_gateway_model extends CI_Model {
	
    function Payments_gateway_model()
    {
		parent::__construct();
    }   
	
	function payment_insert()
	{	

		$image_name='';
		
		
		

if($_FILES['image']['name']!='')
	{
		    	
		$this->load->library('upload');
		$rand=rand(0,100000);

		
		  
			
				$_FILES['userfile']['name']     =   $_FILES['image']['name'];
				$_FILES['userfile']['type']     =   $_FILES['image']['type'];
				$_FILES['userfile']['tmp_name'] =   $_FILES['image']['tmp_name'];
				$_FILES['userfile']['error']    =   $_FILES['image']['error'];
				$_FILES['userfile']['size']     =   $_FILES['image']['size']; 
				  
						
		   
				$config['file_name']     = $rand.'gateway_'.$this->input->post('name');
				$config['upload_path'] = base_path().'upload/';					
				$config['allowed_types'] = 'jpg|jpeg|gif|png|bmp';
					  
			  
			   $this->upload->initialize($config);
			 
			 
					if (!$this->upload->do_upload())
					{		
						
					  $error =  $this->upload->display_errors();
								   
					} 
					
						$picture = $this->upload->data();
						
								
					
					$image_name=$picture['file_name'];
					
						
				
			   
   		
		} 
				
				
				
					
		
		$settings = array(
			'name' => $this->input->post('name'),
			'status' => $this->input->post('status'),
			'image' =>$image_name,
			
			'auto_confirm' => $this->input->post('auto_confirm')
		);		
		$this->db->insert('payments_gateways',$settings);
						
		return TRUE;
			
	
	}
	
	function payment_update()
	{	
		

		$image_name='';
		
		
		

if($_FILES['image']['name']!='')
	{
		    	
		$this->load->library('upload');
		$rand=rand(0,100000);

		
		  
			
				$_FILES['userfile']['name']     =   $_FILES['image']['name'];
				$_FILES['userfile']['type']     =   $_FILES['image']['type'];
				$_FILES['userfile']['tmp_name'] =   $_FILES['image']['tmp_name'];
				$_FILES['userfile']['error']    =   $_FILES['image']['error'];
				$_FILES['userfile']['size']     =   $_FILES['image']['size']; 
				  
						
		   
				$config['file_name']     = $rand.'gateway_'.$this->input->post('name');
				$config['upload_path'] = base_path().'upload/';					
				$config['allowed_types'] = 'jpg|jpeg|gif|png|bmp';
					  
			  
			   $this->upload->initialize($config);
			 
			 
					if (!$this->upload->do_upload())
					{		
						
					 $error =  $this->upload->display_errors();
					 
					
					   
					} 
					
						$picture = $this->upload->data();
						
								
					
					$image_name=$picture['file_name'];
					
						
				
			   
   		
		} else {
				
					if($this->input->post('prev_image')!='')
					{
						$image_name=$this->input->post('prev_image');
					}
					
									
				}
				
				
				
				
		
						$settings = array(
							'name' => $this->input->post('name'),
							'status' => $this->input->post('status'),
							'image' =>$image_name,
							'auto_confirm' => $this->input->post('auto_confirm'), 
							
							
						);		
							$this->db->where('id',$this->input->post('id'));
							$this->db->update('payments_gateways',$settings);
										
						
			
	}
	
	function get_one_payment($id)
	{
		$query = $this->db->get_where('payments_gateways',array('id'=>$id));
		return $query->row_array();
	}	
	
	function get_total_payment_count()
	{
		return $this->db->count_all('payments_gateways');
	}
	
	function get_payment_result($offset, $limit)
	{
		
			$this->db->order_by('id','desc');
			
		$query = $this->db->get('payments_gateways',$limit,$offset);

		if ($query->num_rows() > 0) {
			return $query->result();
		}
		return 0;
	}
	
	
	
	
	function delete_payment_gateway($id)
	{
	
		$chk_details=$this->db->query("select * from ".$this->db->dbprefix('gateways_details')." where payment_gateway_id='".$id."'");
		
		if($chk_details->num_rows()>0)
		{
			$this->db->delete('gateways_details',array('payment_gateway_id'=>$id));	
		}		
		$this->db->delete('payments_gateways',array('id'=>$id));
	}
	
	
	
	
}
?>