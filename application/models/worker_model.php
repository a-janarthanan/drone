<?php
class Worker_model extends CI_Model 
{
	/*
	Function name :Worker_model
	Description :its default constuctor which called when worker_model object initialzie.its load necesary parent constructor
	*/
	
	function Worker_model()
    {
        parent::__construct();	
    } 
	
	
	
	/*
	Function name :get_worker_full_profile()
	Parameter : none 
	Return : array of user information
	Use : get all login user worker profile
	*/
	
	function get_worker_full_profile()
	{
		
		$this->db->select('*');
		$this->db->from('worker');
		$this->db->join('user','worker.user_id=user.user_id');
		$this->db->join('user_profile','worker.user_id=user_profile.user_id');			
		$this->db->where('worker.user_id',get_authenticateUserID());	
		//echo $this->db->get_compiled_select();
		$query = $this->db->get();
		
		if($query->num_rows()>0)
		{
			return $query->row();
		}
		
		return 0;
		
	}
	
	
	
	/*
	Function name :get_worker_document()
	Parameter : $worker_id(worker id) 
	Return : array of worker document
	Use : get worker all document records
	*/
	
	function get_worker_document($worker_id)
	{
		$this->db->select('*');
		$this->db->from('worker_document');
		$this->db->where('worker_id',$worker_id);	
		
		$query = $this->db->get();
		
		if($query->num_rows()>0)
		{
			return $query->result();
		}
		
		return 0;
		
	}
	
	
	
	/*
	Function name :update_worker()
	Parameter : none
	Return : none
	Use : update runner profile information
	*/
	
	function update_worker()
	{
		
		
		$query = $this->db->get_where("worker",array('user_id'=>get_authenticateUserID()));
		
		if($query->num_rows()> 0) {
		
			$res=$query->row();
			
			$worker_task_types ='';
			$task_types = $this->input->post('worker_task_type');
			foreach($task_types as $task_type){
				$worker_task_types .=  $task_type.',';
			}
			
			$worker_transportation ='';
			$transportations = $this->input->post('worker_transportation');
			foreach($transportations as $transportation){
				$worker_transportation .=  $transportation.',';
			}
			
		
			$worker_devices ='';
			$devices = $this->input->post('worker_devices');
			foreach($devices as $device){
				$worker_devices .=  $device.',';
			}
			
			$worker_available_day ='';
			$days = $this->input->post('worker_available_day');
			foreach($days as $day){
				$worker_available_day .=  $day.',';
			}
			
			$worker_available_time ='';
			$times = $this->input->post('worker_available_time');
			foreach($times as $time){
				$worker_available_time .=  $time.',';
			}
			
			$worker_hear_about ='';
			$hearabout = $this->input->post('worker_hear_about');
			foreach($hearabout as $hearabout){
				$worker_hear_about .=  $hearabout.',';
			}
			
			
			
			
			
			
			
			
		
			$data = array(	
			
				'worker_location_name' => $this->input->post('worker_location_name'),
				'worker_address' => $this->input->post('worker_address'),
				'worker_city' => $this->input->post('worker_city'),
				'task_state_id' => $this->input->post('task_state_id'),
				'worker_state' => $this->input->post('worker_state'),
				'worker_zipcode' => $this->input->post('worker_zipcode'),
				'worker_home_neighborhood' => $this->input->post('worker_home_neighborhood'),
				'worker_work_neighborhood' => $this->input->post('worker_work_neighborhood'),
				'worker_task_type' => substr($worker_task_types,'0',-1),
				'worker_transportation' => substr($worker_transportation,'0',-1),
				'worker_skills' => $this->input->post('worker_skills'),
				'worker_devices' => substr($worker_devices,'0',-1),
				'worker_Internet' => $this->input->post('worker_Internet'),
				'worker_available_day' =>substr( $worker_available_day,'0',-1),
				'worker_available_time' => substr($worker_available_time,'0',-1),
				'worker_availability' => $this->input->post('worker_availability'),
				'worker_hear_about' => substr($worker_hear_about,'0',-1),
				'worker_securitynum'=>$this->input->post('worker_securitynum'),
				'worker_birthdate' => $this->input->post('bobyear').'-'.$this->input->post('bobmonth').'-'.$this->input->post('bobday'),
				
			); 
	
			$this->db->where('user_id',get_authenticateUserID());
			$this->db->update('worker', $data);
			
			
			$worker_id=$res->worker_id;
			
			
			
			
			
			
			
			
			///////====enter cities=======
			
			$worker_city=$this->get_worker_cities($worker_id);
			
			if($worker_city)
			{
				$this->db->delete('worker_cities',array('worker_id'=>$worker_id));
			}
			
			$worker_cities=$this->input->post('worker_cities');
			
			if($worker_cities)
			{			
				foreach($worker_cities as $city)
				{					
					$data_cities=array(
					'city_id'=>$city,
					'worker_id'=>$worker_id,
					'user_id'=>get_authenticateUserID()
					);
					$this->db->insert('worker_cities',$data_cities);				
				}			
			}
			
			
			/*******bg upload ****/
			
			
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
						  
								
				   
						$config['file_name']     = $rand.'worker_'.$worker_id.'_'.$i;
						$config['upload_path'] =base_path().'upload/worker_doc/';					
						$config['allowed_types'] = 'jpg|jpeg|gif|png|pdf';
							  
					  
					   $this->upload->initialize($config);
					 
					 
							if (!$this->upload->do_upload())
							{		
								
							 $error =  $this->upload->display_errors();
							   
							} 
							
								$picture = $this->upload->data();
								
									
											
								
							
							$data_doc=array(
												
							'worker_id'=>$worker_id,
							'worker_document'=>$picture['file_name']	
												
							);
							
							
							$this->db->insert('worker_document',$data_doc);
						
						
						
						
						}	
												
				}
	   
   		
		}
			
			
			/****bg upload ****/
		}
		
	}
	
	
	
	
	
	/*
	Function name :get_task_type()
	Parameter : none
	Return : array of all task type
	Use : get all task types
	*/
	
	function get_task_type(){
		$query = $this->db->get_where("task_type");
		return $query->result();	
	}
	
	/*
	Function name :get_transportation()
	Parameter : none
	Return : array of all transportations 
	Use : get all transportations details
	*/
	
	function get_transportation(){
		$query = $this->db->get_where("transportation");
		return $query->result();	
	}
	
	/*
	Function name :get_device()
	Parameter : none
	Return : array of all device 
	Use : get all device details
	*/
	
	function get_device(){
		$query = $this->db->get_where("device");
		return $query->result();	
	}
	
	
	/*
	Function name :add_worker()
	Parameter : none
	Return : integer $worker_id 
	Use : add new runner profile information
	*/
	
	
	function add_worker(){
		$query = $this->db->get_where("worker",array('user_id'=>get_authenticateUserID()));
		
		if($query->num_rows() == 0) {
			$worker_task_types ='';
			$task_types = $this->input->post('worker_task_type');
			foreach($task_types as $task_type){
				$worker_task_types .=  $task_type.',';
			}
			
			$worker_transportation ='';
			$transportations = $this->input->post('worker_transportation');
			foreach($transportations as $transportation){
				$worker_transportation .=  $transportation.',';
			}
			
		
			$worker_devices ='';
			$devices = $this->input->post('worker_devices');
			foreach($devices as $device){
				$worker_devices .=  $device.',';
			}
			
			$worker_available_day ='';
			$days = $this->input->post('worker_available_day');
			foreach($days as $day){
				$worker_available_day .=  $day.',';
			}
			
			$worker_available_time ='';
			$times = $this->input->post('worker_available_time');
			foreach($times as $time){
				$worker_available_time .=  $time.',';
			}
			
			$worker_hear_about ='';
			$hearabout = $this->input->post('worker_hear_about');
			foreach($hearabout as $hearabout){
				$worker_hear_about .=  $hearabout.',';
			}
			
			
			
			
			
			
			
			
		
			$data = array(	
				'user_id' => get_authenticateUserID(),	
				'worker_location_name' => $this->input->post('worker_location_name'),
				'worker_address' => $this->input->post('worker_address'),
				'worker_city' => $this->input->post('worker_city'),
				'worker_state' => $this->input->post('worker_state'),
				'task_state_id' => $this->input->post('task_state_id'),
				'worker_zipcode' => $this->input->post('worker_zipcode'),
				'worker_home_neighborhood' => $this->input->post('worker_home_neighborhood'),
				'worker_work_neighborhood' => $this->input->post('worker_work_neighborhood'),
				'worker_task_type' => substr($worker_task_types,'0',-1),
				'worker_transportation' => substr($worker_transportation,'0',-1),
				'worker_skills' => $this->input->post('worker_skills'),
				'worker_devices' => substr($worker_devices,'0',-1),
				'worker_Internet' => $this->input->post('worker_Internet'),
				'worker_available_day' =>substr( $worker_available_day,'0',-1),
				'worker_available_time' => substr($worker_available_time,'0',-1),
				'worker_availability' => $this->input->post('worker_availability'),
				'worker_hear_about' => substr($worker_hear_about,'0',-1),
				'worker_background' => $this->input->post('worker_background'),
				'worker_securitynum'=>$this->input->post('worker_securitynum'),
				'worker_birthdate' => $this->input->post('bobyear').'-'.$this->input->post('bobmonth').'-'.$this->input->post('bobday'),
				'worker_app_approved' =>0,
				'worker_date'=>date('Y-m-d H:i:s'),
				'worker_status'=>0
			); 
	
			$this->db->insert('worker', $data);
			
			
			$worker_id=mysql_insert_id();
			
			
			
			
			$save_location=$this->input->post('save_location');
			
			if($save_location==1)
			{
			
				$data_location=array(
					'user_id'=>get_authenticateUserID(),				
					'location_name' => $this->input->post('worker_location_name'),
					'location_address' => $this->input->post('worker_address'),
					'location_city' => $this->input->post('worker_city'),
					'location_state' => $this->input->post('worker_state'),
					'location_zipcode' => $this->input->post('worker_zipcode'),	
					'location_date'=>date('Y-m-d H:i:s'),
					'is_home'=>0			
				);
				
				$this->db->insert('user_location',$data_location);
			
			}
			
			
			
			
			///////====enter cities=======
			
			$worker_cities=$this->input->post('worker_cities');
			
			if($worker_cities)
			{			
				foreach($worker_cities as $city)
				{					
					$data_cities=array(
					'city_id'=>$city,
					'worker_id'=>$worker_id,
					'user_id'=>get_authenticateUserID()
					);
					$this->db->insert('worker_cities',$data_cities);				
				}			
			}
			
			
			/*******bg upload ****/
			
			
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
						  
								
				   
						$config['file_name']     = $rand.'worker_'.$worker_id.'_'.$i;
						$config['upload_path'] =base_path().'upload/worker_doc/';					
						$config['allowed_types'] = 'jpg|jpeg|gif|png|pdf';
							  
					  
					   $this->upload->initialize($config);
					 
					 
							if (!$this->upload->do_upload())
							{		
								
							 $error =  $this->upload->display_errors();
							   
							} 
							
								$picture = $this->upload->data();
								
									
											
								
							
							$data_doc=array(
												
							'worker_id'=>$worker_id,
							'worker_document'=>$picture['file_name']	
												
							);
							
							
							$this->db->insert('worker_document',$data_doc);
						
						
						
						
						}	
												
				}
	   
   		
		}
			
			
			/****bg upload ****/
		}
		
	}
	
	
	

	
	
	
	
	/*
	Function name :get_total_category_taskers()
	Parameter : $category_id(category id)
	Return : integer, get particular category runner count
	Use : get total number of particular category runner 
	*/
	
	
	function get_total_category_taskers($category_id)
	{
		$this->db->select('*');
		$this->db->from('worker');
		$this->db->join('user','worker.user_id=user.user_id');
		$this->db->join('user_profile','worker.user_id=user_profile.user_id');
		$this->db->where('worker.worker_app_approved',1);
		//$this->db->where('worker.worker_interview_approved',1);
		//$this->db->where('worker.worker_background_approved',1);
		$this->db->where('worker.worker_status',1);
		
		if($category_id > 0)
		{
			$this->db->like('worker.worker_task_type',$category_id);
		}
		
		
		$this->db->order_by("worker.worker_level", "desc");
		
		
		$query = $this->db->get();
		
		return $query->num_rows();
		
		
	}
	
	
	
	/*
	Function name :get_all_category_taskers()
	Parameter : $category_id(category id), $offset(for paging), $limit(for paging)
	Return : array of particular category runner 
	Use : get all runner of particular category 
	*/
	
	
	function get_all_category_taskers($category_id,$offset, $limit)
	{
		
$sql="SELECT * FROM (`trc_worker`) JOIN `trc_user` ON `trc_worker`.`user_id`=`trc_user`.`user_id` JOIN `trc_user_profile` ON `trc_worker`.`user_id`=`trc_user_profile`.`user_id` WHERE `trc_worker`.`worker_app_approved` = 1 AND `trc_worker`.`worker_status` = 1 AND FIND_IN_SET($category_id,`trc_worker`.`worker_task_type`) ORDER BY `trc_worker`.`worker_level` desc";
		//echo $this->db->last_query();exit;
		$query = $this->db->query($sql);
		
		
		if($query->num_rows()>0)
		{
		return $query->result();
		}
		
		return 0;
	}
	
	
	/*
	Function name :get_total_taskers()
	Parameter : $city_id(city id)
	Return : integer, get particular city runner count
	Use : get total number of particular city runner 
	*/
	
	
	function get_total_taskers($city_id)
	{
		$this->db->select('*');
		$this->db->from('worker');
		$this->db->join('user','worker.user_id=user.user_id');
		$this->db->join('user_profile','worker.user_id=user_profile.user_id');
		$this->db->where('worker.worker_app_approved',1);
		//$this->db->where('worker.worker_interview_approved',1);
		//$this->db->where('worker.worker_background_approved',1);
		$this->db->where('worker.worker_status',1);
		
		if($city_id > 0)
		{
			$this->db->join('worker_cities','worker.user_id=worker_cities.user_id');
			$this->db->where('worker_cities.city_id',$city_id);
		}
		
		$this->db->order_by("worker.worker_level", "desc");
		
		
		$query = $this->db->get();
		
		return $query->num_rows();
	
	
	}
	
	
	
	/*
	Function name :get_all_taskers()
	Parameter : $city_id(city id), $offset(for paging), $limit(for paging)
	Return : array of particular city runner 
	Use : get all runner of particular city 
	*/
	
	function get_all_taskers($city_id,$offset, $limit)
	{
		$this->db->select('*');
		$this->db->from('worker');
		$this->db->join('user','worker.user_id=user.user_id');
		$this->db->join('user_profile','worker.user_id=user_profile.user_id');
		$this->db->where('worker.worker_app_approved',1);
		//$this->db->where('worker.worker_interview_approved',1);
		//$this->db->where('worker.worker_background_approved',1);
		$this->db->where('worker.worker_status',1);
		
		
		if($city_id>0)
		{
			$this->db->join('worker_cities','worker.user_id=worker_cities.user_id');
			$this->db->where('worker_cities.city_id',$city_id);
		}
		
		
		
		$this->db->order_by("worker.worker_level", "desc");
		$this->db->limit($limit, $offset);
		
		$query = $this->db->get();
		
		if($query->num_rows()>0)
		{
		return $query->result();
		}
		
		return 0;
	}
	
	function get_allrelatedtotal_taskers($city_id)
	{
		$this->db->select('*');
		$this->db->from('worker');
		$this->db->join('user','worker.user_id=user.user_id');
		$this->db->join('user_profile','worker.user_id=user_profile.user_id');
		$this->db->where('worker.worker_app_approved',1);
		//$this->db->where('worker.worker_interview_approved',1);
		//$this->db->where('worker.worker_background_approved',1);
		$this->db->where('worker.worker_status',1);
		
		if($city_id > 0)
		{
			$this->db->join('worker_cities','worker.user_id=worker_cities.user_id');
			$this->db->where('worker_cities.city_id',$city_id);
		}
		
		$this->db->order_by("worker.worker_level", "desc");
		
		
	
		
		$query = $this->db->get();
		return $query->num_rows();
	
	
	}

	function get_allrelated_taskers($city_id,$offset, $limit)
	{
		$this->db->select('*');
		$this->db->from('worker');
		$this->db->join('user','worker.user_id=user.user_id');
		$this->db->join('user_profile','worker.user_id=user_profile.user_id');
		$this->db->where('worker.worker_app_approved',1);
		//$this->db->where('worker.worker_interview_approved',1);
		//$this->db->where('worker.worker_background_approved',1);
		$this->db->where('worker.worker_status',1);
		
		
		if($city_id>0)
		{
			$this->db->join('worker_cities','worker.user_id=worker_cities.user_id');
			$this->db->where('worker_cities.city_id',$city_id);
		}
		
		
		
		$this->db->order_by("worker.worker_level", "desc");
		$this->db->limit($limit, $offset);
		
		$query = $this->db->get();
		
		if($query->num_rows()>0)
		{
		return $query->result();
		}
		
		return 0;
	}
	function get_relatedtotal_taskers($city_id,$data)
	{
		/*$this->db->select('*');
		$this->db->from('worker');
		$this->db->join('user','worker.user_id=user.user_id');
		$this->db->join('user_profile','worker.user_id=user_profile.user_id');
		$this->db->where('worker.worker_app_approved',1);
		$this->db->or_where('worker.worker_zipcode',$data['zip']);
		$this->db->or_like(concat(',','worker.worker_available_day',','),$data['day_task']);
		//$this->db->where('worker.worker_interview_approved',1);
		//$this->db->where('worker.worker_background_approved',1);
		$this->db->where('worker.worker_status',1);
		
		if($city_id > 0)
		{
			$this->db->join('worker_cities','worker.user_id=worker_cities.user_id');
			$this->db->where('worker_cities.city_id',$city_id);
		}
		
		$this->db->order_by("worker.worker_level", "desc");*/
		
		
		$query = $this->db->query("SELECT * FROM (`trc_worker`) JOIN `trc_user` ON `trc_worker`.`user_id`=`trc_user`.`user_id` JOIN `trc_user_profile` ON `trc_worker`.`user_id`=`trc_user_profile`.`user_id` JOIN `trc_worker_cities` ON `trc_worker`.`user_id`=`trc_worker_cities`.`user_id` WHERE `trc_worker`.`worker_app_approved` = 1 AND `trc_worker`.`worker_status` = 1 AND FIND_IN_SET('".$data['day_task']."',trc_worker.worker_available_day) AND FIND_IN_SET('".$data['cat']."',trc_worker.worker_task_type) ORDER BY `trc_worker`.`worker_level` desc");
		
		//$query = $this->db->get();
		return $query->num_rows();
	
	
	}

	function get_related_taskers($city_id,$offset, $limit,$data)
	{
		/*$this->db->select('*');
		$this->db->from('worker');
		$this->db->join('user','worker.user_id=user.user_id');
		$this->db->join('user_profile','worker.user_id=user_profile.user_id');
		$this->db->where('worker.worker_app_approved',1);
		$this->db->or_where('worker.worker_zipcode',$data['zip']);
		$this->db->or_like(concat(',','worker.worker_available_day',','),$data['day_task']);
		//$this->db->where('worker.worker_interview_approved',1);
		//$this->db->where('worker.worker_background_approved',1);
		$this->db->where('worker.worker_status',1);
		
		
		if($city_id>0)
		{
			$this->db->join('worker_cities','worker.user_id=worker_cities.user_id');
			$this->db->where('worker_cities.city_id',$city_id);
		}
		
		
		
		$this->db->order_by("worker.worker_level", "desc");
		$this->db->limit($limit, $offset);*/
		
		
		$query = $this->db->query("SELECT * FROM (`trc_worker`) JOIN `trc_user` ON `trc_worker`.`user_id`=`trc_user`.`user_id` JOIN `trc_user_profile` ON `trc_worker`.`user_id`=`trc_user_profile`.`user_id` JOIN `trc_worker_cities` ON `trc_worker`.`user_id`=`trc_worker_cities`.`user_id` WHERE `trc_worker`.`worker_app_approved` = 1 AND `trc_worker`.`worker_status` = 1 AND `trc_worker_cities`.`city_id` = '".$data['taskcity']."' AND FIND_IN_SET('".$data['day_task']."',trc_worker.worker_available_day) AND FIND_IN_SET('".$data['cat']."',trc_worker.worker_task_type) ORDER BY `trc_worker`.`worker_level` desc");
		
		//echo $this->db->last_query();
		
		//$query = $this->db->get();
		
		if($query->num_rows()>0)
		{
		return $query->result();
		}
		
		return 0;
	}
	
	
	
	
	/*
	Function name :get_taskers()
	Parameter : none
	Return : array of runner 
	Use : get all runner 
	*/
	
	function get_taskers()
	{
		$query = $this->db->get_where("worker",array('user_id'=>get_authenticateUserID()));
		if( $query->num_rows > 0){
		$taskers_info = $query->row();
		$taskers = array('worker_app_approved'=>$taskers_info->worker_app_approved,
						 'worker_interview_approved'=>$taskers_info->worker_interview_approved,
						 'worker_background_approved'=>$taskers_info->worker_background_approved
						);
			return $taskers;
		}else{ 
		$taskers = array('worker_app_approved'=>0,
						 'worker_interview_approved'=>0,
						 'worker_background_approved'=>0
						);
			return $taskers;
		}
	}
	
	
	
	/*
	Function name :get_top_worker()
	Parameter : $limit(limit for top runner)
	Return : array of top runners
	Use : get all top runners list
	*/
	
	function get_top_worker($limit)
	{
			
		$this->db->select('user.*,worker.*');
		$this->db->from('user');
		$this->db->join('worker','user.user_id=worker.user_id');
		$this->db->join('user_profile','user.user_id=user_profile.user_id');	
		$this->db->join('task','worker.worker_id=task.task_worker_id');
		$this->db->where('task.user_id',get_authenticateUserID());
		$this->db->order_by("worker.worker_level", "desc");
		$this->db->group_by('task.task_worker_id');
		$this->db->limit($limit);
		
		$query=$this->db->get();
		
		
		if($query->num_rows()>0)
		{
			return $query->result();
		}
		else
		{
				
			$this->db->select('*');
			$this->db->from('worker');
			$this->db->join('user','worker.user_id=user.user_id');
			$this->db->join('user_profile','worker.user_id=user_profile.user_id');	
			$this->db->where('worker.worker_app_approved',1);
		//	$this->db->where('worker.worker_interview_approved',1);
			//$this->db->where('worker.worker_background_approved',1);
			$this->db->where('worker.worker_status',1);	
			$this->db->order_by("worker.worker_level", "desc");
			$this->db->limit($limit);
			
			$query2 = $this->db->get();
			
			if($query2->num_rows()>0)
			{		
				return $query2->result();		
			}
			
			return 0;
			
		}
		
	
	}
	
	
	/*
	Function name :get_top_worker_rand()
	Parameter : $limit(limit for top runner)
	Return : array of top runners random
	Use : get all top runners list
	*/
	
	function get_top_worker_new($limit)
	{
			
		$this->db->select('user.*,worker.*');
		$this->db->from('user');
		$this->db->join('worker','user.user_id=worker.user_id');
		$this->db->join('user_profile','user.user_id=user_profile.user_id');	
		$this->db->join('task','worker.worker_id=task.task_worker_id');
		$this->db->where('task.user_id',get_authenticateUserID());
		$this->db->order_by("worker.worker_level", "RANDOM");
		$this->db->group_by('task.task_worker_id');
		$this->db->limit($limit);
		
		$query=$this->db->get();
		
		
		if($query->num_rows()>0)
		{
			return $query->result();
		}
		else
		{
				
			$this->db->select('*');
			$this->db->from('worker');
			$this->db->join('user','worker.user_id=user.user_id');
			$this->db->join('user_profile','worker.user_id=user_profile.user_id');	
			$this->db->where('worker.worker_app_approved',1);
		//	$this->db->where('worker.worker_interview_approved',1);
			//$this->db->where('worker.worker_background_approved',1);
			$this->db->where('worker.worker_status',1);	
			$this->db->order_by("worker.worker_level", "RANDOM");
			$this->db->limit($limit);
			
			$query2 = $this->db->get();
			
			if($query2->num_rows()>0)
			{		
				return $query2->result();		
			}
			
			return 0;
			
		}
		
	
	}
	
	
	
	/*
	Function name :check_user_worker_detail()
	Parameter : $user_id(user id)
	Return : array of runner detail
	Use : get runner details
	*/
	
	function check_user_worker_detail($user_id)
	{
		//$query=$this->db->get_where('worker',array('user_id'=>$user_id,'worker_status'=>1,'worker_background_approved'=>1,'worker_app_approved'=>1));
		
		
		$query=$this->db->get_where('worker',array('user_id'=>$user_id,'worker_status'=>1,'worker_app_approved'=>1));
		
		if($query->num_rows()>0)
		{
			return $query->row();
		}
		
		return 0;
		
	}
	
	function get_skilname($cat_id)
	{
		//$query=$this->db->get_where('worker',array('user_id'=>$user_id,'worker_status'=>1,'worker_background_approved'=>1,'worker_app_approved'=>1));
		
		
		$query=$this->db->get_where('task_category',array('task_category_id'=>$cat_id));
		
		if($query->num_rows()>0)
		{
			return $query->row();
		}
		
		return 0;
		
	}
	
	
	
	/*
	Function name :get_worker_info()
	Parameter : $worker_id(worker id)
	Return : array of runner detail
	Use : get runner details
	*/
	function get_worker_info($worker_id)
	{
		$this->db->select('*');
		$this->db->from('worker');
		$this->db->join('user','worker.user_id=user.user_id');
		$this->db->join('user_profile','worker.user_id=user_profile.user_id');			
		$this->db->where('worker.worker_id',$worker_id);	
		
		$query = $this->db->get();
		
		return $query->row();
	}
	
	
	/*
	Function name :get_worker_category_task()
	Parameter : $worker_id(worker id)
	Return : array of runner work category total task
	Use : get runner category wise total task
	*/
	
	function get_worker_category_task($worker_id)
	{
		
		$query=$this->db->query("SELECT count(tk.task_category_id) as total_task, tc.* FROM ".$this->db->dbprefix('task')." tk, ".$this->db->dbprefix('task_category')." tc where tk.task_category_id=tc.task_category_id and tk.task_worker_id='".$worker_id."' group by tk.task_category_id");
		
		if($query->num_rows()>0)
		{
			return $query->result();
		}
		
		return 0;
		
	}
	
	
	/*
	Function name :get_worker_cities()
	Parameter : $worker_id(worker id)
	Return : array of runner work cities
	Use : get all cities where runner can work
	*/
	
	function get_worker_cities($worker_id)
	{
		
		$this->db->select('*');
		$this->db->from('worker_cities wc');
		$this->db->join('city ct','wc.city_id=ct.city_id');
		$this->db->where('wc.worker_id',$worker_id);
		$this->db->order_by('ct.city_name','asc');
		
		$query=$this->db->get();
		
		
		if($query->num_rows()>0)
		{
			return $query->result();
		}
		
		return 0;
		
	
	}
	
	/*
	Function name :get_task_type_detail()
	Parameter : $type_id(type id)
	Return : array of runner work types
	Use : get all types where runner can work
	*/
	
	function get_task_type_detail($type_id)
	{
		
		$query = $this->db->query("select category_name as task_name from ".$this->db->dbprefix('task_category')." where task_category_id = '".$type_id."' ");
	
		if($query->num_rows()>0)
		{
		 	return $query->row();
		}
		
		return 0;


	
	}
	
	
	/*
	Function name :getCategoryId()
	Parameter : $categoryname(category name)
	Return : integer category id
	Use : get category id from category name
	*/

	  function getCategoryId($categoryname)
	  {  
		  $query = $this->db->get_where("task_category",array('category_url_name'=>$categoryname));
		  
		  //echo $this->db->last_query();

		  if($query->num_rows()>0)
		  {
			   $result= $query->row();
			   return $result->task_category_id;
		  }
		  
		  return 0;        
	  }
	  
	  function check_is_worker_new($user_id)
	  {
		  $query = $this->db->get_where("trc_worker",array('user_id'=>$user_id,'worker_status'=>1));
		  //echo $this->db->last_query();
		  if($query->num_rows()>0)
		  {
			  return true;
		  }
		  
		  return 0;
		  	
	  }
	function get_state_list()
	{
		$sql="select * from trc_state where active ='1'";
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

	function getCityList($sate_id)
	{
			
			$sql="SELECT * FROM `trc_city` WHERE `state_id`='".$sate_id."'";
			$recordSet=$this->db->query($sql);
            if($recordSet->num_rows()>0){
                    foreach ($recordSet->result_array() as $row){
						
						$output .= '<option value="'.$row['city_id'].'">'.ucfirst($row['city_name']).'</option>';
						
						
					}
            }
            else
            {
            	$output .= '<option value="">No record found</option>';
            }
            return $output;

	}
	function getCityList1($sate_id)
	{
			
			$sql="SELECT * FROM `trc_city` WHERE `state_id`='".$sate_id."'";
			$recordSet=$this->db->query($sql);
            if($recordSet->num_rows()>0){
                    foreach ($recordSet->result_array() as $row){
						
						foreach($row as $key=>$val){
						$recordSet_all->fields[$key] = $val;
					}
					$rsc[]	= $recordSet_all->fields;;
						
						
					}
            }
            
            return $rsc;

	}

	function get_top_worker_by_cat($limit1,$category_id)
		{
			
			
$sql="SELECT * FROM (`trc_worker`) JOIN `trc_user` ON `trc_worker`.`user_id`=`trc_user`.`user_id` JOIN `trc_user_profile` ON `trc_worker`.`user_id`=`trc_user_profile`.`user_id` WHERE `trc_worker`.`worker_app_approved` = 1 AND `trc_worker`.`worker_status` = 1 AND  FIND_IN_SET($category_id,trc_worker.worker_task_type) ORDER BY `trc_worker`.`worker_level` desc LIMIT 10";



//echo $this->db->last_query();exit;

			$query = $this->db->query($sql);
			
			if($query->num_rows()>0)
			{		
				return $query->result();		
			}
			
			return 0;
			
	
		
	
	}

	function get_complete_task_list($category_id)
	{
		$this->db->select('*');
		$this->db->from('task');
		$this->db->join('user','task.user_id=user.user_id');
		$this->db->where('task.task_category_id',$category_id);
		$this->db->where('task.task_status',1);
		//$this->db->where('task.task_activity_status',3);
		$this->db->order_by('task.task_id desc');
		$this->db->limit(10);
		$query = $this->db->get();

		//echo $this->db->last_query();
		
		if($query->num_rows > 0) {
			return $query->result();
		}
		 return 0;
	}
	
	
}
?>