<?php
class Stored_card_model extends CI_Model 
{

	/*
	Function name :Stored_card_model
	Description :its default constuctor which called when stored_card_model object initialzie.its load necesary parent constructor
	*/
	function Stored_card_model()
    {
        parent::__construct();	
    } 
	
	
	/*
	Function name :get_user_card_info()
	Parameter : none 
	Return : array of user card information
	Use : get user credit card information
	*/
	
	function get_user_card_info()
	{
		
		$query=$this->db->get_where('user_card_info',array('user_id'=>get_authenticateUserID()));
		
		if($query->num_rows()>0)
		{
			return $query->row();
		}
		
		return 0;
		
	}
	
}

?>