<?php

class Pages_model extends CI_Model {
	
    function Pages_model()
    {
       parent::__construct();
    }   
	
	function pages_insert()
	{
		$data = array(
			'pages_title' => $this->input->post('pages_title'),
			'description' => $this->input->post('description'),
			'slug' => $this->input->post('slug'),
			'active' => $this->input->post('active'),
			'meta_keyword' => $this->input->post('meta_keyword'),
			'meta_description' => $this->input->post('meta_description'),
			'header_bar' => $this->input->post('header_bar'),
			'footer_bar' => $this->input->post('footer_bar'),
			'left_side' => $this->input->post('left_side'),
			'right_side' => $this->input->post('right_side'),
			'external_link' => $this->input->post('external_link')
		);		
		$this->db->insert('pages',$data);
	}
	
	function pages_update()
	{
		$data = array(			
			'pages_title' => $this->input->post('pages_title'),
			'description' => $this->input->post('description'),
			'slug' => $this->input->post('slug'),
			'active' => $this->input->post('active'),
			'meta_keyword' => $this->input->post('meta_keyword'),
			'meta_description' => $this->input->post('meta_description'),
			'header_bar' => $this->input->post('header_bar'),
			'footer_bar' => $this->input->post('footer_bar'),
			'left_side' => $this->input->post('left_side'),
			'right_side' => $this->input->post('right_side'),
			'external_link' => $this->input->post('external_link')
		);
		$this->db->where('pages_id',$this->input->post('pages_id'));
		$this->db->update('pages',$data);
	}

	function membership_insert()
	{
		$data = array(
			'title' => $this->input->post('title'),
			'description' => $this->input->post('description'),
			'price' => $this->input->post('price'),
			'numbid' => $this->input->post('numbid'),
			'status' => $this->input->post('active')
			
		);		
		$this->db->insert('membership',$data);
	}
	
	function membership_update()
	{
		$data = array(			
			'title' => $this->input->post('title'),
			'description' => $this->input->post('description'),
			'price' => $this->input->post('price'),
			'numbid' => $this->input->post('numbid'),
			'status' => $this->input->post('active')
		);
		$this->db->where('id',$this->input->post('id'));
		$this->db->update('membership',$data);
	}
	
	function get_one_pages($id)
	{
		$query = $this->db->get_where('pages',array('pages_id'=>$id));
		return $query->row_array();
	}	
	
	function get_total_pages_count()
	{
		return $this->db->count_all('pages');
	}
	
	function get_pages_result($offset, $limit)
	{
			$this->db->order_by('pages_id','desc');
		$query = $this->db->get('pages',$limit,$offset);

		if ($query->num_rows() > 0) {
			return $query->result();
		}
		return 0;
	}
	function get_one_membership($id)
	{
		$query = $this->db->get_where('membership',array('id'=>$id));
		return $query->row_array();
	}
	function get_total_search_pages_count($option,$keyword)
	{
		$keyword=str_replace('"','',str_replace(array("'",",","%","$","&","*","#","(",")",":",";",">","<","/"),'',$keyword));
		
		$this->db->select('pages.*');
		$this->db->from('pages');
		
		if($option=='title')
		{
			$this->db->like('pages.pages_title',$keyword);
			
			if(substr_count($keyword,' ')>=1)
			{
				$ex=explode(' ',$keyword);
				
				foreach($ex as $val)
				{
					$this->db->like('pages.pages_title',$val);
				}	
			}

		}
				
		$this->db->order_by("pages_id", "desc"); 
		
		$query = $this->db->get();
		
		return $query->num_rows();
	}
	
	
	
	function get_search_pages_result($option,$keyword,$offset, $limit)
	{
		
		$keyword=str_replace('"','',str_replace(array("'",",","%","$","&","*","#","(",")",":",";",">","<","/"),'',$keyword));
		
		$this->db->select('pages.*');
		$this->db->from('pages');
		
		if($option=='title')
		{
			$this->db->like('pages.pages_title',$keyword);
			
			if(substr_count($keyword,' ')>=1)
			{
				$ex=explode(' ',$keyword);
				
				foreach($ex as $val)
				{
					$this->db->like('pages.pages_title',$val);
				}	
			}

		}
				
		$this->db->order_by("pages_id", "desc"); 
		
		$query = $this->db->get();
		$this->db->limit($limit,$offset);
		if ($query->num_rows() > 0) {
			
			return $query->result();
		}
		return 0;
	}

	function get_total_members_count()
	{
		return $this->db->count_all('membership');
	}
	
	function get_members_result($offset, $limit)
	{
			$this->db->order_by('id','desc');
		$query = $this->db->get('membership',$limit,$offset);

		if ($query->num_rows() > 0) {
			return $query->result();
		}
		return 0;
	}

	function addbanner_insert()
	{
         $category_image='no_image.png';
         $image_settings=image_setting();
		 
         if($_FILES['file_up']['name']!='')
         {
             $this->load->library('upload');
             $rand=rand(0,100000); 
			  
             $_FILES['userfile']['name']     =   $_FILES['file_up']['name'];
             $_FILES['userfile']['type']     =   $_FILES['file_up']['type'];
             $_FILES['userfile']['tmp_name'] =   $_FILES['file_up']['tmp_name'];
             $_FILES['userfile']['error']    =   $_FILES['file_up']['error'];
             $_FILES['userfile']['size']     =   $_FILES['file_up']['size'];
  
             $file_name=get_authenticateUserID().$rand.$_FILES['userfile']['name'];	

			 $config =  array(
			                  'upload_path'     => '/home/saivisiontech/public_html/newsite/upload/banner',
							  'file_name'		=>$file_name,
			                  'allowed_types'   => "*",
			                  'overwrite'       => TRUE
			 );
			$this->load->library('upload', $config);
			$this->upload->initialize($config); //Make this line must be here.
							
			if($this->upload->do_upload())
			{
					//echo "file upload";exit;
			}
			else
			{
				echo $this->upload->display_errors();
				echo "file upload failed";exit;
			}
 
			
	 }
	 //echo $category_image;exit;
         $data = array(
			'title' => $this->input->post('title'),
			'description' => $this->input->post('description'),
			'link' => $this->input->post('link'),
			'image_name'=>$file_name
			
		);		
		$this->db->insert('banner',$data);
		
		
		$pid=mysql_insert_id();
		

		
	}

	function addbanner_update()
	{
		

		
		 $category_image='no_image.png';
         $image_settings=image_setting();
          if($_FILES['file_up']['name']!='')
         {
             //echo "hi";

             $this->load->library('upload');
             $rand=rand(0,100000); 
			  
             $_FILES['userfile']['name']     =   $_FILES['file_up']['name'];
             $_FILES['userfile']['type']     =   $_FILES['file_up']['type'];
             $_FILES['userfile']['tmp_name'] =   $_FILES['file_up']['tmp_name'];
             $_FILES['userfile']['error']    =   $_FILES['file_up']['error'];
             $_FILES['userfile']['size']     =   $_FILES['file_up']['size'];
  
             $file_name=get_authenticateUserID().$rand.$_FILES['userfile']['name'];	

			 $config =  array(
			                  'upload_path'     => '/home/saivisiontech/public_html/newsite/upload/banner',
							  'file_name'		=>$file_name,
			                  'allowed_types'   => "*",
			                  'overwrite'       => TRUE
			 );
			$this->load->library('upload', $config);
			$this->upload->initialize($config); //Make this line must be here.
							
			if($this->upload->do_upload())
			{
					//echo "file upload";exit;
			}
			else
			{
				echo $this->upload->display_errors();
				echo "file upload failed";exit;
			}
 
			
	 }
	
		
		
		
		else
		{

			$file_name=$this->input->post('prev_category_image');
		}
		$data = array(		
			'title' => $this->input->post('title'),
			'description' => $this->input->post('description'),
			'link' => $this->input->post('link'),
			'image_name' => $file_name,
			
		);
		$this->db->where('id',$this->input->post('id'));
		$this->db->update('banner',$data);
		

		
		
	}

	function get_total_banner_count()
	{
		return $this->db->count_all('banner');
	}

	function get_one_banner($id)
	{
		$query = $this->db->get_where('banner',array('id'=>$id));
		return $query->row_array();
	}

	function get_banner_result($offset, $limit)
	{
			$this->db->order_by('id','desc');
		$query = $this->db->get('banner',$limit,$offset);

		if ($query->num_rows() > 0) {
			return $query->result();
		}
		return 0;
	}
	
	
}
?>