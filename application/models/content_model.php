<?php
class Content_model extends CI_Model 
{

	/*
	Function name :Content_model
	Description :its default constuctor which called when Content_model object initialzie.its load necesary parent constructor
	*/
	function Content_model()
    {
        parent::__construct();	
    } 
	
	/*
	Function name :browse_all_category()
	Parameter : $page_id (page id)
	Return : single array of page details
	Use : get page details
	*/
	function get_content_by_id($page_id)
	{
		
		$this->db->select('*');
		$this->db->from('pages');
		$this->db->where('pages_id',$page_id);
		
		$query=$this->db->get();
		
		if($query->num_rows()>0)
		{
			return $query->row();
		}
		
		return 0;
		
	}
	
}
?>