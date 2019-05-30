<?php
class User_login_model extends CI_Model 
{

	/*
	Function name :User_login_model
	Description :its default constuctor which called when user_login_model object initialzie.its load necesary parent constructor
	*/
	function User_login_model()
    {
        parent::__construct();	
    } 
	
	/*
	Function name :get_all_login_user()
	Parameter : none 
	Return : array of all current login user list
	Use : get all current login user list
	*/
	function get_all_login_user()
	{
		
		$get_user_login=$this->db->query("select * from ".$this->db->dbprefix('user_login')." where DATE(login_date_time)='".date('Y-m-d')."'  and login_status=1 group by user_id order by login_id desc");
		
			if($get_user_login->num_rows()>0)
			{					
				return $get_user_login->result();															
			}
		
		return 0;
	}
	
	
}

?>