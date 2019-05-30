<?php

class Country_model extends CI_Model {
	
    function Country_model()
    {
		 parent::__construct();	
    }   
	
	function country_insert()
	{	
	
		$data = array(
			'country_name' => $this->input->post('country_name'),
			
			'active' => $this->input->post('active'),
		);		
		$this->db->insert('country',$data);
	}
	
	function country_update()
	{	
	
		$data = array(			
			'country_name' => $this->input->post('country_name'),
			
			'active' => $this->input->post('active'),
		);
		$this->db->where('country_id',$this->input->post('country_id'));
		$this->db->update('country',$data);
	}
	
	function get_one_country($id)
	{
		$query = $this->db->get_where('country',array('country_id'=>$id));
		return $query->row_array();
	}	
	
	function get_total_country_count()
	{
		return $this->db->count_all('country');
	}
	
	function get_country_result($offset, $limit)
	{
		
			$this->db->order_by('country_name','asc');
			
		$query = $this->db->get('country',$limit,$offset);

		if ($query->num_rows() > 0) {
			return $query->result();
		}
		return 0;
	}
	
	function get_total_search_country_count($option,$keyword)
	{
		$keyword=str_replace('"','',str_replace(array("'",",","%","$","&","*","#","(",")",":",";",">","<","/"),'',$keyword));
		
		$this->db->select('country.*');
		$this->db->from('country');
		
		if($option=='name')
		{
			$this->db->like('country.country_name',$keyword);
			
			if(substr_count($keyword,' ')>=1)
			{
				$ex=explode(' ',$keyword);
				
				foreach($ex as $val)
				{
					$this->db->like('country.country_name',$val);
				}	
			}

			
		}
		
		$this->db->order_by("country.country_id", "desc"); 
		
		$query = $this->db->get();
		
		return $query->num_rows();
	}
	
	
	function get_search_country_result($option,$keyword,$offset, $limit)
	{
		
		$this->db->select('country.*');
		$this->db->from('country');
		
		if($option=='name')
		{
			$this->db->like('country.country_name',$keyword);
			
			if(substr_count($keyword,' ')>=1)
			{
				$ex=explode(' ',$keyword);
				
				foreach($ex as $val)
				{
					$this->db->like('country.country_name',$val);
				}	
			}

			
		}
		
		$this->db->order_by("country.country_id", "desc"); 
		
		$this->db->limit($limit,$offset);
		
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			
			return $query->result();
		}
		return 0;
	}
	
}
?>