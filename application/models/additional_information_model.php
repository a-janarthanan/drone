<?php
class Additional_information_model extends CI_Model {

	/*
	Function name :Additional_information_model
	Description :its default constuctor which called when Additional_information_model object initialzie.its load necesary parent constructor
	*/
	
    function Additional_information_model()
    {
        parent::__construct();	
    }   
	
	/*
	Function name :get_all_information()
	Parameter : $task_id (Task unquie ID)
	Return : array of task additional information details
	Use : get all additional information of $task_id this function use on additional information of task page
	*/
	
	function get_all_information($task_id){
	
		$this->db->select('*');
		$this->db->from('additional_information');
		$this->db->where('additional_information.task_id',$task_id);
		$this->db->order_by('additional_information.additional_information_id','asc');	
		$query = $this->db->get(); 
		return $query->result();
	
	}
	
	/*
	Function name :information_add()
	Parameter : none
	Return : none
	Use : add additional information of task this function use on additional information of task page
	*/
	
	function information_add()
	{
	
		$content= strip_tags($this->input->post('information'));		
		$content=str_replace('"','KSYDOU',$content);
		$content=str_replace("'",'KSYSING',$content);
			
			$data= array(
				'information' => $content,
				'task_id' => $this->input->post('task_id'),
				'post_date' => date('Y-m-d H:i:s')
			);
		$this->db->insert('additional_information', $data); 
		

	}

	
}
?>