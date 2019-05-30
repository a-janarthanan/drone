<?php
class Service_model extends CI_Model 
{

	/*
	Function name :Service_model
	Description :its default constuctor which called when Home_model object initialzie.its load necesary parent constructor
	*/
	function Service_model()
    {
        parent::__construct();	
    } 


	/*
	Function name :get_all_categories()
	Parameter : none
	Return : array of all category
	Use : when new task post at that time task go to particular category
	*/
	
	function get_all_categories()
	{
		  $this->db->order_by('category_name','asc');
	   	  $query = $this->db->get_where("task_category",array('category_status'=>1));
		  if($query->num_rows() > 0){
			return $query->result();
		  } 
		  return 0;
	}

	function perent_category()
	{
		$this->db->select('*');
		$this->db->from('task_category');
		
		$this->db->where('category_parent_id',0);
		$this->db->where('category_status',1);
		
		$query=$this->db->get();
		
		if($query->num_rows()>0)
		{
			return $query->result();
		}
		
		return 0;
	
	
	
	}

	function sub_category($cat_id)
	{
			
			$sql="SELECT * FROM `trc_task_category` WHERE `category_parent_id`='".$cat_id."'";
			$recordSet=$this->db->query($sql);
			$rsc = false;
			if ($recordSet->num_rows() > 0) {
					$rsc = array();
					foreach ($recordSet->result_array() as $row){
						foreach($row as $key=>$val){
							$recordSet_all->fields[$key] = $val;
						}
						$rsc[]	= $recordSet_all->fields;
					}
				}
				return $rsc;
            

	}

	function add_service()
	{
		
        if($this->input->post('gig-title')!=''  && $this->input->post('gig-description')!='')
		{

		$data_service=array(
						'user_id'=>get_authenticateUserID(),				
						'gig_title' => $this->input->post('gig-title'),
						'gig_category' => $this->input->post('gig-category'),
						'gig_description' => $this->input->post('gig-description'),
						'gig_video' => $this->input->post('gig-video'),
						'gig_price' => $this->input->post('gig-price'),
						'gig_date'=>date('Y-m-d H:i:s'),						
					);
					
					$this->db->insert('service_gig',$data_service);

					$gig_id=mysql_insert_id();

					if($_FILES['file_up']['name']!='')
					{
						$cnt=1; 
						$this->load->library('upload');
						$rand=rand(0,100000);
				
				 		for($i=0;$i<count($_FILES['file_up']['name']);$i++)
				 		{
				 
							if($_FILES['file_up']['name'][$i]!='')
							{	
					
								$_FILES['userfile']['name']    =   $_FILES['file_up']['name'][$i];
								$_FILES['userfile']['type']    =   $_FILES['file_up']['type'][$i];
								$_FILES['userfile']['tmp_name'] =   $_FILES['file_up']['tmp_name'][$i];
								$_FILES['userfile']['error']       =   $_FILES['file_up']['error'][$i];
								$_FILES['userfile']['size']    =   $_FILES['file_up']['size'][$i]; 
								  
								
				   
								$config['file_name']     = $rand.'gig_'.$gig_id.'_'.$i;
								$config['upload_path'] =base_path().'upload/gig_img/';					
								$config['allowed_types'] = 'jpg|jpeg|gif|png';
									  
					  
					   			$this->upload->initialize($config);
					 
					 
								if (!$this->upload->do_upload())
								{		
									
								 $error =  $this->upload->display_errors();
								   
								} 
							
								$picture = $this->upload->data();
								
									
											
								
							
								$data_doc=array(
													
								'gig_id'=>$gig_id,
								'gig_img'=>$picture['file_name']	
													
								);
								
								
								$this->db->insert('service_gig_image',$data_doc);
						
						
						
						
						}	
												
				}
	   
   		
			}
		}
	}

	function get_service_details($id)
	{
		
		$query=$this->db->query("SELECT * FROM `trc_service_gig` WHERE id='".$id."'");
		
		if($query->num_rows()>0)
		{
			return $query->row();
		}
		

		
	}
	function all_service_list()
	{
		
					
		    $sql="SELECT * FROM `trc_service_gig`";
			$recordSet=$this->db->query($sql);
			$rsc = false;
			if ($recordSet->num_rows() > 0) {
					$rsc = array();
					foreach ($recordSet->result_array() as $row){
						foreach($row as $key=>$val){
							$recordSet_all->fields[$key] = $val;
							$recordSet_all->fields['gig_user_name'] = $this->getNameTable("trc_user","profile_name","user_id",$row['user_id']);
							$recordSet_all->fields['gig_img'] = $this->getNameTable("trc_service_gig_image","gig_img","gig_id",$row['id']);
		
						}
						$rsc[]	= $recordSet_all->fields;
					}
				}
				return $rsc;
	}

    function service_user($user_id)
    {
    	$query=$this->db->query("select * from ".$this->db->dbprefix('user')." usr, ".$this->db->dbprefix('user_profile')." pr where usr.user_id=pr.user_id and usr.user_id='".$user_id."' and (usr.user_status=1 or usr.user_status=3)");	
		
		
		return $query->row();

    }

	function getNameTable($table,$col,$field,$value)
	{
		$query="SELECT ".$col." FROM ".$table." where ".$field."='".$value."' AND ".$field." IS NOT NULL";
		//echo $query;
		$recordSet = $this->db->query($query);
		if($recordSet->num_rows() > 0)
		{
			$row = $recordSet->row_array();
			return $row[$col];
		}
		else
		{
			return "";
		}
	}
	function user_service_list($userid)
	{
		
			$serviceid=	$this->uri->segment(3);	
		    $sql="SELECT * FROM `trc_service_gig` WHERE user_id='".$userid."' AND id!='".$serviceid."'";
			$recordSet=$this->db->query($sql);
			$rsc = false;
			if ($recordSet->num_rows() > 0) {
					$rsc = array();
					foreach ($recordSet->result_array() as $row){
						foreach($row as $key=>$val){
							$recordSet_all->fields[$key] = $val;
							$recordSet_all->fields['gig_user_name'] = $this->getNameTable("trc_user","profile_name","user_id",$row['user_id']);
							$recordSet_all->fields['gig_img'] = $this->getNameTable("trc_service_gig_image","gig_img","gig_id",$row['id']);
		
						}
						$rsc[]	= $recordSet_all->fields;
					}
				}
				return $rsc;
	}

}