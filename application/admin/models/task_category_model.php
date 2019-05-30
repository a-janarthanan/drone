<?php
class Task_category_model extends CI_Model {
	
    function Task_category_model()
    {
       parent::__construct();
		
    }   
	
	
	
	function check_category_have_sub_category($category_id)
	{
		$query = $this->db->get_where('task_category',array('category_parent_id '=>$category_id));
		if ($query->num_rows() > 0) {
			return 1;
		}
		return 0;	
	}
	
	
	
	function get_total_task_category_count()
	{
		return $this->db->count_all('task_category');
	}
	
	function get_task_category_result($offset, $limit)
	{		
		$query=$this->db->query("select c.* , (select COUNT(*) as total from ".$this->db->dbprefix('task')." where task_category_id=c.task_category_id and task_status!=3) as total_task from ".$this->db->dbprefix('task_category')." c order by task_category_id desc limit ".$limit." offset ".$offset);
		

		if ($query->num_rows() > 0) {
			return $query->result();
		}
		return 0;
	}	
	
	function get_parent_category()
	{
		$query = $this->db->get_where('task_category',array('category_parent_id '=>'0'));
		if ($query->num_rows() > 0) {
			return $query->result();
		}
		return 0;
	}
	
	function task_category_insert()
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
  
             

			 
		 	 $config['file_name']     = $rand.'category_'.$_FILES['userfile']['name'];
             $config['upload_path'] = base_path().'upload/category/';
             $config['allowed_types'] = 'jpg|jpeg|gif|png|bmp';  
 
             $this->upload->initialize($config);
 
              if (!$this->upload->do_upload())
			  {
				$error =  $this->upload->display_errors();   
			  } 
			   
			   
           	  $picture = $this->upload->data();
		   
              $this->load->library('image_lib');
		   
              $this->image_lib->clear();
		   	
			
					$gd_var='gd';
				
				
		   if ($_FILES["file_up"]["type"]!= "image/png" and $_FILES["file_up"]["type"] != "image/x-png") {
		  
		   	$gd_var='gd2';
			
			
			}
			
					
		   if ($_FILES["file_up"]["type"] != "image/gif") {
		   
		    	$gd_var='gd';
		   }
		   
		   
		    if ($_FILES["file_up"]["type"] != "image/jpeg" and $_FILES["file_up"]["type"] != "image/pjpeg" ) {
		   
		    	$gd_var='gd';
		   }
		   
              $this->image_lib->initialize(array(
				'image_library' => $gd_var,
				'source_image' => base_path().'upload/category/'.$picture['file_name'],
				'new_image' => base_path().'upload/category/'.$picture['file_name'],
				'maintain_ratio' => TRUE,
				'quality' => '100%',
				'width' => $image_settings->category_width,
				'height' => $image_settings->category_height
			 ));
			
			
			if(!$this->image_lib->resize())
			{
				$error = $this->image_lib->display_errors();
			}
			
			$category_image=$picture['file_name'];
			
			
			
		
			
			
			
			
			
			if($this->input->post('prev_category_image')!='')
				{
					if(file_exists(base_path().'upload/category/'.$this->input->post('prev_category_image')))
					{
						$link=base_path().'upload/category/'.$this->input->post('prev_category_image');
						unlink($link);
					}
					if(file_exists(base_path().'upload/category/'.$this->input->post('prev_category_image')))
					{
						$link2=base_path().'upload/category/'.$this->input->post('prev_category_image');
						unlink($link2);
					}
				}
			} else {
				if($this->input->post('prev_category_image')!='')
				{
					$category_image=$this->input->post('prev_category_image');
				}
			}
			
			$category_url_name = clean_url($this->input->post('category_name'));
               
                                       
                       
      		 $chk_url_exists=$this->db->query("select MAX(category_url_name) as category_url_name from ".$this->db->dbprefix('task_category')." where category_url_name like '".$category_url_name."%'");
               
               if($chk_url_exists->num_rows()>0)
               {                        
                               $get_pr=$chk_url_exists->row();                                        
                               
                               $strre='0';
                               if($get_pr->category_url_name!='')
                               {
                                       $strre=str_replace($category_url_name,'',$get_pr->category_url_name);
                               }
                               
                               if($strre=='0') 
                               {                                        
                                       $newcnt=''; 
                                                                         
                               } 
                               elseif($strre=='') 
                               {                                        
                                       $newcnt='1';                                   
                               }
                               else
                               {                                
                                       $newcnt=(int)$strre+1;                        
                               }
                               
                                $category_url_name=$category_url_name.$newcnt;
                                               
               }
	
         $data = array(
			'category_name' => $this->input->post('category_name'),
			'category_parent_id' => $this->input->post('category_parent_id'),
			'category_status' => $this->input->post('category_status'),
			'category_url_name' => $category_url_name,
			'category_description' => $this->input->post('category_description'),
		    'category_average_price' => $this->input->post('category_average_price'),
			'category_image'=>$category_image
			
		);		
		$this->db->insert('task_category',$data);
		
		
		$pid=mysql_insert_id();
		
		$cid=$this->input->post('category_parent_id');
		
		
		
		$supported_cache=check_supported_cache_driver();
		
		if(isset($supported_cache))
		{
			if($supported_cache!='' && $supported_cache!='none')
			{
				////===load cache driver===
				$this->load->driver('cache');				
				
				
				/********update sub category list********/
				
				$query = $this->db->get_where("task_category",array('category_parent_id'=>$pid));
		
					if($query->num_rows()>0)
					{
						$this->cache->$supported_cache->save('getsubcategory'.$pid, $query->result(),CACHE_VALID_SEC);	
						 
					}	
				
				/********update sub category list********/
				
				$query = $this->db->get_where("task_category",array('category_parent_id'=>$cid));
		
					if($query->num_rows()>0)
					{
						$this->cache->$supported_cache->save('getsubcategory'.$cid, $query->result(),CACHE_VALID_SEC);	
						 
					}	
				
				
				/********update parent category list********/
				
				 $query = $this->db->get_where("task_category",array('category_status'=>1,'category_parent_id'=>0));
		
					if($query->num_rows()>0)
					{
						$this->cache->$supported_cache->save('getparentcategory', $query->result(),CACHE_VALID_SEC);	
					
					}
					
					
				
				/********update all category list********/
				
					$this->db->order_by('category_name','asc');
				   $query = $this->db->get_where("task_category",array('category_status'=>1));
				   
				   if($query->num_rows()>0)
				   {
						 $this->cache->$supported_cache->save('getallcategory', $query->result(),CACHE_VALID_SEC);	

					}		
				
			}			
			
		}
		
		
		
		
		
		
	}
	
	function task_category_update()
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
  
             $config['file_name']     = $rand.'category_'.$_FILES['userfile']['name'];
             $config['upload_path'] = base_path().'upload/category/';
             $config['allowed_types'] = '*';  
 
             $this->upload->initialize($config);
 
 
              if ($this->upload->do_upload())
			  {
					//$error =  $this->upload->display_errors();   
			  }
			  else{
			  	echo $this->upload->display_errors();
				echo "file upload failed";exit;
			  } 
			   
			   
              $picture = $config['file_name'];

             // echo "<pre>";print_r($picture);
		   
            /*$this->load->library('image_lib');
		   
              $this->image_lib->clear();
		   
		   
		    	$gd_var='gd';
				
				
			
		   if ($_FILES["file_up"]["type"]!= "image/png" and $_FILES["file_up"]["type"] != "image/x-png") {
		  
		   	$gd_var='gd2';
			
			
			}
			
					
		   if ($_FILES["file_up"]["type"] != "image/gif") {
		   
		    	$gd_var='gd';
		   }
		   
		   
		    if ($_FILES["file_up"]["type"] != "image/jpeg" and $_FILES["file_up"]["type"] != "image/pjpeg" ) {
		   
		    	$gd_var='gd';
		   }
		   
              $this->image_lib->initialize(array(
				'source_image' => base_path().'upload/category/'.$picture,
				'new_image' => base_path().'upload/category/'.$picture,
				'maintain_ratio' => TRUE,
				 'quality' => '100%',
				'width' => $image_settings->category_width,
				'height' => $image_settings->category_height
			   ));
			
			
				 if(!$this->image_lib->resize())
				{
					$error = $this->image_lib->display_errors();
				}*/
			
				$category_image=$picture;
			
				if($this->input->post('prev_category_image')!='')
				{
					if(file_exists(base_path().'upload/category/'.$this->input->post('prev_category_image')))
					{
						$link=base_path().'upload/category/'.$this->input->post('prev_category_image');
						unlink($link);
					}
					if(file_exists(base_path().'upload/category/'.$this->input->post('prev_category_image')))
					{
						$link2=base_path().'upload/category/'.$this->input->post('prev_category_image');
						unlink($link2);
					}
				}
			} else {
				if($this->input->post('prev_category_image')!='')
				{
					$category_image=$this->input->post('prev_category_image');
				}
			}
	
		
			$category_url_name=clean_url($this->input->post('category_name'));
	
			
			$chk_url_exists=$this->db->query("select MAX(category_url_name) as category_url_name from ".$this->db->dbprefix('task_category')." where task_category_id!='".$this->input->post('task_category_id')."' and category_url_name like '".$category_url_name."%'");
		
			if($chk_url_exists->num_rows()>0)
			{			
					$get_pr=$chk_url_exists->row();					
					
					$strre='0';
					if($get_pr->category_url_name!='')
					{
						$strre=str_replace($category_url_name,'',$get_pr->category_url_name);
					}
					
					if($strre=='0') 
					{					
						$newcnt=''; 
										
					} 
					elseif($strre=='') 
					{					
						$newcnt='1';   				
					}
					else
					{				
						$newcnt=(int)$strre+1;			
					}
					
					$category_url_name=$category_url_name.$newcnt;
							
			}
		
		
		$data = array(		
			'category_name' => $this->input->post('category_name'),
			'category_parent_id' => $this->input->post('category_parent_id'),
			'category_status' => $this->input->post('category_status'),
			'category_url_name' => $category_url_name,
			'category_description' => $this->input->post('category_description'),
		    'category_average_price' => $this->input->post('category_average_price'),
			'category_image' => $category_image,
			
		);
		$this->db->where('task_category_id',$this->input->post('task_category_id'));
		$this->db->update('task_category',$data);
		
		
		
		
		
		$pid=$this->input->post('task_category_id');
		$cid=$this->input->post('category_parent_id');
		
		
		
		$supported_cache=check_supported_cache_driver();
		
		if(isset($supported_cache))
		{
			if($supported_cache!='' && $supported_cache!='none')
			{
				////===load cache driver===
				$this->load->driver('cache');				
				
				
				/********update sub category list********/
				
				$query = $this->db->get_where("task_category",array('category_parent_id'=>$pid));
		
					if($query->num_rows()>0)
					{
						$this->cache->$supported_cache->save('getsubcategory'.$pid, $query->result(),CACHE_VALID_SEC);	
						 
					}	
				
				
				/********update sub category list********/
				
				$query = $this->db->get_where("task_category",array('category_parent_id'=>$cid));
		
					if($query->num_rows()>0)
					{
						$this->cache->$supported_cache->save('getsubcategory'.$cid, $query->result(),CACHE_VALID_SEC);	
						 
					}	
				
				/********update parent category list********/
				
				 $query = $this->db->get_where("task_category",array('category_status'=>1,'category_parent_id'=>0));
		
					if($query->num_rows()>0)
					{
						$this->cache->$supported_cache->save('getparentcategory', $query->result(),CACHE_VALID_SEC);	
					
					}
					
					
				
				/********update all category list********/
				
					$this->db->order_by('category_name','asc');
				   $query = $this->db->get_where("task_category",array('category_status'=>1));
				   
				   if($query->num_rows()>0)
				   {
						 $this->cache->$supported_cache->save('getallcategory', $query->result(),CACHE_VALID_SEC);	

					}		
				
			}			
			
		}
		
		
		
		
	}
	
	function get_one_task_category($id)
	{
		$query = $this->db->get_where('task_category',array('task_category_id'=>$id));
		return $query->row_array();
	}	

}

?>