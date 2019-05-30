<?php

class City_model extends CI_Model {
	
    function City_model()
    {
		  parent::__construct();	
    }   
	
	function city_insert()
	{	
		
			
		$data = array(
			'country_id' => $this->input->post('country_id'),
			'state_id' => $this->input->post('state_id'),
			'city_name' => $this->input->post('city_name'),
			'city_latitude' => $this->input->post('city_latitude'),
			'city_longitude' => $this->input->post('city_longitude'),
			'city_timezone' => $this->input->post('city_timezone'),
			'active' => $this->input->post('active'),
		);		
		$this->db->insert('city',$data);
		
		
		$city_id=mysql_insert_id();
		
		
		
		$supported_cache=check_supported_cache_driver();
		
		if(isset($supported_cache))
		{
			if($supported_cache!='' && $supported_cache!='none')
			{
				////===load cache driver===
				$this->load->driver('cache');				
				
				
				/*********create city cache**********/
				$query = $this->db->get_where("city",array('city_id'=>$city_id));
		
					if($query->num_rows()>0)
					{
						 $result= $query->row();
						 $this->cache->$supported_cache->save('city'.$city_id, $result->city_name,CACHE_VALID_SEC);	
						 
						
					}
					
				
					
					/*********update city list**********/
					
					
					$this->db->order_by('city_name','asc');
					$query = $this->db->get_where("city",array('active'=>1));
					
					if($query->num_rows()>0)
					{
						 $this->cache->$supported_cache->save('city_list', $query->result(),CACHE_VALID_SEC);	
						
					}		
				
			}			
			
		}
		
		
		
	}
	
	function city_update()
	{	

		$data = array(			
			'country_id' => $this->input->post('country_id'),
			'state_id' => $this->input->post('state_id'),
			'city_name' => $this->input->post('city_name'),	
			'city_latitude' => $this->input->post('city_latitude'),		
			'city_longitude' => $this->input->post('city_longitude'),
			'city_timezone' => $this->input->post('city_timezone'),				
			'active' => $this->input->post('active'),
		);
		$this->db->where('city_id',$this->input->post('city_id'));
		$this->db->update('city',$data);
		
		
		
		$supported_cache=check_supported_cache_driver();
		
		if(isset($supported_cache))
		{
			if($supported_cache!='' && $supported_cache!='none')
			{
				////===load cache driver===
				$this->load->driver('cache');				
				
					/*********update city cache**********/
					
					$query = $this->db->get_where("city",array('city_id'=>$this->input->post('city_id')));
		
					if($query->num_rows()>0)
					{
						 $result= $query->row();
						 $this->cache->$supported_cache->save('city'.$this->input->post('city_id'), $result->city_name,CACHE_VALID_SEC);	
						 
						
					}
					
					/*********update city list**********/
					
					$this->db->order_by('city_name','asc');
					$query = $this->db->get_where("city",array('active'=>1));
					
					if($query->num_rows()>0)
					{
						 $this->cache->$supported_cache->save('city_list', $query->result(),CACHE_VALID_SEC);	
						
					}		
				
			}			
			
		}
		
		
		
		
	}
	
	function get_one_city($id)
	{
		$query = $this->db->get_where('city',array('city_id'=>$id));
		return $query->row_array();
	}	
	
	function get_total_city_count()
	{
		return $this->db->count_all('city');
	}
	
	function get_city_result($offset, $limit)
	{				   
						   
		$this->db->select('city.city_id, 
						   city.state_id,
						   city.country_id,
						   city.city_name, 
						   city.city_latitude,
						   city.city_longitude,
						   city.city_timezone,
						   city.active, 
						   state.state_name,
						   country.country_name');
		$this->db->from('city');
		$this->db->join('state', 'city.state_id= state.state_id','left');
		$this->db->join('country', 'city.country_id= country.country_id','left');
			$this->db->order_by('city.city_name','asc');
		$this->db->limit($limit,$offset);
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return $query->result();
		}
		return 0;
	}
	
	function get_country_result()
	{
		$query = $this->db->get('country');

		if ($query->num_rows() > 0) {
			return $query->result();
		}
		return 0;
	}
	
	function get_state_result()
	{
		$query = $this->db->get('state');

		if ($query->num_rows() > 0) {
			return $query->result();
		}
		return 0;
	}
	
	function get_total_search_city_count($option,$keyword)
	{
		$keyword=str_replace('"','',str_replace(array("'",",","%","$","&","*","#","(",")",":",";",">","<","/"),'',$keyword));
		
		$this->db->select('city.*,country.country_name,state.state_name');
		$this->db->from('city');
		$this->db->join('state','city.state_id = state.state_id','left');
		$this->db->join('country','city.country_id = country.country_id','left');
		
		if($option=='statename')
		{
			$this->db->like('state.state_name',$keyword);
			
			if(substr_count($keyword,' ')>=1)
			{
				$ex=explode(' ',$keyword);
				
				foreach($ex as $val)
				{
					$this->db->like('state.state_name',$val);
				}	
			}

		}
		if($option=='countryname')
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
		
		if($option=='cityname')
		{
			$this->db->like('city.city_name',$keyword);
			
			if(substr_count($keyword,' ')>=1)
			{
				$ex=explode(' ',$keyword);
				
				foreach($ex as $val)
				{
					$this->db->like('city.city_name',$val);
				}	
			}

		}
		
		
		$this->db->order_by("city.city_id", "desc"); 
		
		$query = $this->db->get();
		
		return $query->num_rows();
	}
	
	
	
	function get_search_city_result($option,$keyword,$offset, $limit)
	{
		
		$keyword=str_replace('"','',str_replace(array("'",",","%","$","&","*","#","(",")",":",";",">","<","/"),'',$keyword));
		
		$this->db->select('city.*,country.country_name,state.state_name');
		$this->db->from('city');
		$this->db->join('state','city.state_id = state.state_id','left');
		$this->db->join('country','city.country_id = country.country_id','left');
		
		if($option=='statename')
		{
			$this->db->like('state.state_name',$keyword);
			
			if(substr_count($keyword,' ')>=1)
			{
				$ex=explode(' ',$keyword);
				
				foreach($ex as $val)
				{
					$this->db->like('state.state_name',$val);
				}	
			}

			
		}
		
		if($option=='countryname')
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
		if($option=='cityname')
		{
			$this->db->like('city.city_name',$keyword);
			
			if(substr_count($keyword,' ')>=1)
			{
				$ex=explode(' ',$keyword);
				
				foreach($ex as $val)
				{
					$this->db->like('city.city_name',$val);
				}	
			}

		}
		$this->db->order_by("city.city_id", "desc"); 
		$this->db->limit($limit,$offset);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			
			return $query->result();
		}
		return 0;
	}
	
	function statebycountry($country_id)
	{
		$query = $this->db->get_where('state',array('country_id' =>$country_id));
		if ($query->num_rows() > 0) {
		//echo '<pre>'; print_r($query->result());
			return $query->result();
		}
		return 0;
	}
	
}
?>