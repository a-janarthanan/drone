<?php
class User_other_model extends CI_Model 
{

	/*
	Function name :User_other_model
	Description :its default constuctor which called when user_other_model object initialzie.its load necesary parent constructor
	*/
	function User_other_model()
    {
        parent::__construct();	
    } 
	
	
	/*
	Function name :get_favorites_list()
	Parameter : $limit(for paging), $offset (for paging)
	Return : array of all user favorite runner list
	Use : get all user favorite runner list
	*/
	
	function get_favorites_list($limit,$offset)
	{	
		$this->db->select('*');
		$this->db->from('user_favorite');
		$this->db->join('user','user_favorite.favorite_user_id=user.user_id');
		$this->db->join('user_profile','user_favorite.favorite_user_id=user_profile.user_id');	
		$this->db->join('worker','worker.user_id=user.user_id');	
		$this->db->where('user_favorite.my_user_id',get_authenticateUserID());	
		$this->db->order_by("user_favorite.favorite_id", "desc"); 
		$this->db->limit($limit,$offset);
		$query = $this->db->get();
		return $query->result();
	}
	
	/*
	Function name :get_total_favorites()
	Parameter : none
	Return : integer, user favorite runner count
	Use : get user total number of favorite runner 
	*/
	
	
	function get_total_favorites()
	{
		$this->db->select('*');
		$this->db->from('user_favorite');
		$this->db->join('user','user_favorite.favorite_user_id=user.user_id');
		$this->db->join('user_profile','user_favorite.favorite_user_id=user_profile.user_id');
		$this->db->join('worker','worker.user_id=user.user_id');			
		$this->db->where('user_favorite.my_user_id',get_authenticateUserID());	
		$this->db->order_by("user_favorite.favorite_id", "asc"); 
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	
	/*
	Function name :get_locations_list()
	Parameter : none
	Return : array of all user locations
	Use : get all user location list
	*/
	function get_locations_list()
	{	
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('user_location','user_location.user_id=user.user_id');
		$this->db->where('user_location.user_id',get_authenticateUserID());	
		$this->db->order_by("user_location.user_location_id", "asc"); 
		$query = $this->db->get();
		return $query->result();
	}
	
	/*
	Function name :get_locations_list()
	Parameter : none
	Return : integer, user all locations count
	Use : get user total number of locations
	*/
	function get_total_locations()
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('user_location','user_location.user_id=user.user_id');
		$this->db->where('user_location.user_id',get_authenticateUserID());	
		$this->db->order_by("user_location.user_location_id", "asc"); 
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	/*
	Function name :locations_home_set()
	Parameter : none
	Return : integer  1 or 0
	Use : set user location as a home location
	*/
	function locations_home_set()
	{
	
		$query = $this->db->query("UPDATE ".$this->db->dbprefix('user_location')." SET  `is_home` =  '0' WHERE `user_id` ='".get_authenticateUserID()."'");
		
		$data = array(					
				'is_home' => 1
		); 
				
		$this->db->where('user_location_id',$this->input->post('location_id'));		
		$this->db->update('user_location', $data);
	}
	
	/*
	Function name :new_location()
	Parameter : none
	Return : none
	Use : add new user location
	*/
	
	function new_location()
	{
		$data = array(					
				'user_id' => get_authenticateUserID(),
				'location_name' => $this->input->post('location_name'),
				'location_address' => $this->input->post('location_address'),
				'location_city' => $this->input->post('location_city'),
				'location_state' => $this->input->post('location_state'),
				'location_zipcode' => $this->input->post('location_zipcode'),
				'location_date' => date('y-m-d H:i:s'),
				'is_home' => 0,				
		);
		$this->db->insert('user_location', $data); 
	}
	
	
	/*
	Function name :delete_favorite()
	Parameter : $favorite_id
	Return : none
	Use : delete user favorite runner
	*/
	
	
	function delete_favorite($favorite_id )
	{
	
		$query=$this->db->get_where('user_favorite',array('favorite_id' =>$favorite_id));
		
		if($query->num_rows()>0)
		{
		$result = $query->row();
		
		
		if($result->favorite_user_id!='')
		{
		$this->db->where('favorite_id',$favorite_id);
		$this->db->delete('user_favorite');
		}
		
		}
	
	}
	/*
	Function name :get_pricing_list()
	Parameter :
	Return : totle record from memebership table
	Use : get membership details
	*/

	function get_pricing_list()
	{
		$this->db->order_by('id','desc');
		$query = $this->db->get('membership');

		if ($query->num_rows() > 0) {
			return $query->result();
		}
		return 0;
	}

	function all_category_worker()
	{
		$this->db->where('category_status',1);
		$query = $this->db->get('task_category');

		if ($query->num_rows() > 0) {
			return $query->result();
		}
		return 0;
	}

	function getNameTable($table,$col,$field,$value){
		$query="SELECT ".$col." FROM ".$table." where ".$field."='".$value."' ";
		$recordSet = $this->db->query($query);
		if($recordSet->num_rows() > 0){
			$row = $recordSet->row_array();
			return $row[$col];
		}else{
			return "";
		}
	}


}
?>