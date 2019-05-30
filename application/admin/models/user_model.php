<?php

class User_model extends CI_Model {
	
    function User_model()
    {
        parent::__construct();	
    }   
	
	
	
	
	/*** check the user unique email address
	*	var string $email
	*  return boolen
	**/

	function emailTaken($email)
	{
	
		 $query = $this->db->query("select * from ".$this->db->dbprefix('user')." where email='".$email."'");
		 
		 if($query->num_rows()>0)
		 {
			return true;
		 }
		 else 
		 {
			return false;
		 }		
	}
	
	
	
	
	/**** add user ***/
	
	
	
	function add_user()
	{
	
		$email_verification_code=randomCode();
		
		
		$password=randomCode();
		
		
		
		
		
		$first_name=$this->input->post('first_name');
		$last_name=$this->input->post('last_name');
		
		$profile_name=clean_url($first_name.' '.substr($last_name,0,1));
		
		
			
	$chk_url_exists=$this->db->query("select MAX(profile_name) as profile_name from ".$this->db->dbprefix('user')." where profile_name like '".$profile_name."%'");
		
		if($chk_url_exists->num_rows()>0)
		{			
				$get_pr=$chk_url_exists->row();					
				
				$strre='0';
				if($get_pr->profile_name!='')
				{
					$strre=str_replace($profile_name,'',$get_pr->profile_name);
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
				
			 	$profile_name=$profile_name.$newcnt;
						
		}
			
			
			
		
		
		
		$data = array(		
				'full_name' => $first_name.' '.$last_name,		
				'first_name' => $first_name,
				'last_name' => $last_name,	
				'profile_name'=>$profile_name,			
				'email' => $this->input->post('email'),			
				'password' => md5($password),		
				'sign_up_ip' => $this->input->ip_address(),
				'email_verification_code'=>$email_verification_code,
				'zip_code'=>$this->input->post('zip_code'),
				'mobile_no'=>$this->input->post('mobile_no'),			
				'phone_no'=>$this->input->post('phone_no'),						
				'user_status' =>$this->input->post('user_status'),
				'sign_up_date' => date('Y-m-d H:i:s'),
				); 
		$this->db->insert('user', $data);
		$user_id = mysql_insert_id();
		
		
		/*****create profile****/
		
		$data_profile=array(
		'user_id'=>$user_id,
		'current_city'=>$this->input->post('current_city'),
		'about_user'=>$this->input->post('about_user')
		);
		
		$this->db->insert('user_profile',$data_profile);
		
		
		
		/*****create worker****/
		
		$is_worker=$this->input->post('is_worker');
		
		if($is_worker==1)
		{
		
			$data_worker=array(
			'user_id'=>$user_id,
			'worker_app_approved'=>1,
			'worker_status'=>1,
			'worker_date'=> date('Y-m-d H:i:s'),
			);
			
			$this->db->insert('worker',$data_worker);
			
		
		
		}
		
		
		
			/*** user notification ****/
	
		$user_notification=mysql_query("SHOW COLUMNS FROM ".$this->db->dbprefix('user_notification'));
		$res=mysql_fetch_array($user_notification);
		$fields="";
		$values="";
				
		while($res=mysql_fetch_array($user_notification)){
		//print_r($res['Field']);echo '<br>';
		if($fields==""){$fields.="(`".$res['Field']."`"; $values.="('".$user_id."'";}
		else {$fields.=",`".$res['Field']."`";	 $values.=",'1'";}
		}
		$fields.=")";
		 $values.=")";								   
		$insert_val= $fields.' values '.$values;
		
		$this->db->query("insert into ".$this->db->dbprefix('user_notification')." ".$insert_val."");
		
	
		/*******************/
	
	
	
		return $password;
		
		
		
	}
	
	
	
	
	/*** get single user details
	*  return single record array
	**/
	function get_one_user($id)
	{
		$this->db->select('*');
		$this->db->from('user us');
		$this->db->join('user_profile up','us.user_id=up.user_id');
		$this->db->where('us.user_id',$id);
		$query=$this->db->get();
		if($query->num_rows()>0)
		{		
			return $query->row();
		}
		
		return 0;
	}	
	
	
	/*** get user location details
	*  return single record array
	**/
	function get_user_location($id)
	{
		$query = $this->db->get_where('user_location',array('user_id'=>$id));
		if ($query->num_rows() > 0) {
			return $query->row();
		}
		return 0;
	}	
	
	/*** get total user 
	*  return number
	**/
	function get_total_user_count()
	{
		//return $this->db->count_all('user');
		$query=$this->db->query("select * from ".$this->db->dbprefix('user')." where user_status !='2'");
		
		if($query->num_rows()>0)
		{	
			return $query->num_rows();
		}
		
		return 0;
	}
	
	
	/*** get users details
	*  return multiple records array
	**/
	function get_user_result($offset, $limit)
	{
		//$this->db->order_by('user_id','desc');
         //$query = $this->db->get('user',$limit,$offset);
		
		$query = $this->db->query("select * from ".$this->db->dbprefix('user')." where user_status !='2' order by user_id desc limit ".$limit." offset ".$offset);
		//$query = $this->db->get('user',$limit,$offset);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		}
		return 0;
	}
	
	function get_total_active_user_count()
	{
		$query=$this->db->query("select * from ".$this->db->dbprefix('user')." where user_status='1'");
		
		if ($query->num_rows() > 0) {
			return $query->num_rows();
		}
		return 0;
	}
	
	
	/*** get users details
	*  return multiple records array
	**/
	function get_active_user_result($offset, $limit)
	{
		$query=$this->db->query("select * from ".$this->db->dbprefix('user')." where user_status='1' order by user_id desc limit ".$limit." offset ".$offset);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		}
		return 0;
	}
	
	function get_total_delete_user_count()
	{
		$query=$this->db->query("select * from ".$this->db->dbprefix('use')."r where user_status='2'");
		
		if ($query->num_rows() > 0) {
			return $query->num_rows();
		}
		return 0;
	}
	
	
	/*** get users details
	*  return multiple records array
	**/
	function get_delete_user_result($offset, $limit)
	{
		$query=$this->db->query("select * from ".$this->db->dbprefix('user')." where user_status='2' order by user_id desc limit ".$limit." offset ".$offset);
		
		if ($query->num_rows() > 0) {
			return $query->result();
		}
		return 0;
	}
	/*Search Start*/
	
	/*** get total user 
	*  return number
	**/
	function get_total_search_user_count($option,$keyword)
	{
		
		$keyword=str_replace('"','',str_replace(array("'",",","%","$","&","*","#","(",")",":",";",">","<","/"),'',$keyword));
		
		$this->db->select('user.*');
		$this->db->from('user');
		
		
				
		if($option=='username')
		{
			$this->db->like('user.full_name	',$keyword);
			$this->db->or_like('user.first_name',$keyword);
			$this->db->or_like('user.last_name',$keyword);
			
			if(substr_count($keyword,' ')>=1)
			{
				$ex=explode(' ',$keyword);
				
				foreach($ex as $val)
				{
					$this->db->or_like('user.full_name	',$val);
					$this->db->or_like('user.first_name',$val);
					$this->db->or_like('user.last_name',$val);
				}	
			}

			
		}
		if($option=='email')
		{
			$this->db->like('user.email',$keyword);
			
			if(substr_count($keyword,' ')>=1)
			{
				$ex=explode(' ',$keyword);
				
				foreach($ex as $val)
				{
					$this->db->like('user.email',$val);
				}	
			}

			
		}
		
		if($option=='city')
		{
			$this->db->like('user.city',$keyword);
			
			if(substr_count($keyword,' ')>=1)
			{
				$ex=explode(' ',$keyword);
				
				foreach($ex as $val)
				{
					$this->db->like('user.city',$val);
				}	
			}

		}
		if($option=='state')
		{
			$this->db->like('user.state',$keyword);
			
			if(substr_count($keyword,' ')>=1)
			{
				$ex=explode(' ',$keyword);
				
				foreach($ex as $val)
				{
					$this->db->like('user.state',$val);
				}	
			}

		}
		
		if($option=='country')
		{
			$this->db->like('user.country',$keyword);
			
			if(substr_count($keyword,' ')>=1)
			{
				$ex=explode(' ',$keyword);
				
				foreach($ex as $val)
				{
					$this->db->like('user.country',$val);
				}	
			}

		}
		
		
		
		$this->db->order_by("user.user_id", "desc"); 
		
		
		$query = $this->db->get();
		
		
		return $query->num_rows();
	}
	
	
	/*** get users details
	*  return multiple records array
	**/
	function get_search_user_result($option,$keyword,$offset, $limit)
	{
		
		$keyword=str_replace('"','',str_replace(array("'",",","%","$","&","*","#","(",")",":",";",">","<","/"),'',$keyword));
		
		$this->db->select('user.*');
		$this->db->from('user');
		
		
		
		
		
		if($option=='username')
		{
			$this->db->like('user.full_name	',$keyword);
			$this->db->or_like('user.first_name',$keyword);
			$this->db->or_like('user.last_name',$keyword);
			
			if(substr_count($keyword,' ')>=1)
			{
				$ex=explode(' ',$keyword);
				
				foreach($ex as $val)
				{
					$this->db->or_like('user.full_name	',$val);
					$this->db->or_like('user.first_name',$val);
					$this->db->or_like('user.last_name',$val);
				}	
			}

			
		}
		if($option=='email')
		{
			
			$this->db->like('user.email',$keyword);
			
			if(substr_count($keyword,' ')>=1)
			{
				$ex=explode(' ',$keyword);
				
				foreach($ex as $val)
				{
					$this->db->like('user.email',$val);
				}	
			}

			
		}
		
		if($option=='city')
		{
			$this->db->like('user.city',$keyword);
			
			if(substr_count($keyword,' ')>=1)
			{
				$ex=explode(' ',$keyword);
				
				foreach($ex as $val)
				{
					$this->db->like('user.city',$val);
				}	
			}

			
		}
		
		if($option=='state')
		{
			$this->db->like('user.state',$keyword);
			
			if(substr_count($keyword,' ')>=1)
			{
				$ex=explode(' ',$keyword);
				
				foreach($ex as $val)
				{
					$this->db->like('user.state',$val);
				}	
			}

		}
		
		if($option=='country')
		{
			$this->db->like('user.country',$keyword);
			
			if(substr_count($keyword,' ')>=1)
			{
				$ex=explode(' ',$keyword);
				
				foreach($ex as $val)
				{
					$this->db->like('user.country',$val);
				}	
			}

		}
		
		/*if($option=='ip')
		{
			$this->db->like('project.host_ip',$keyword);
			
		}
		
		if($option=='cat')
		{
			$this->db->like('project_category.project_category_name',$keyword);
			
			if(substr_count($keyword,' ')>=1)
			{
				$ex=explode(' ',$keyword);
				
				foreach($ex as $val)
				{
					$this->db->or_like('project_category.project_category_name',$val);
				}	
			}

			
		}*/
		
		
		
		$this->db->order_by("user.user_id", "desc"); 
		$this->db->limit($limit,$offset);
		
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			//return $query->result_array();
			return $query->result();
		}
		return 0;
	}
	
	/*Search End*/
	
	
	/***** show all uploaded photos of a user
	*N
	***/
	
	function get_user_portfolio_photo($user_id)
	{
		$query=$this->db->get_where('user_portfolio',array('user_id' => $user_id,'portfolio_image !=' => ''));
		
		if($query->num_rows()>0)
		{
			return $query->result();
		}
		
		return 0;
		
	}
	
	
	/***** show all uploaded photos of a user
	*N
	***/
	
	function get_user_portfolio_video($user_id)
	{
		$query=$this->db->get_where('user_portfolio',array('user_id' => $user_id,'portfolio_video !=' => ''));
		
		if($query->num_rows()>0)
		{
			return $query->result();
		}
		
		return 0;
		
	}
	
	function get_total_userlogin_count()
	{
		$this->db->select('*');
		$this->db->from('user_login');
		$this->db->join('user', 'user_login.user_id= user.user_id','left');
	
		$this->db->order_by('user_login.login_id','desc');
		$query = $this->db->get();


		if ($query->num_rows() > 0) {
			return $query->num_rows();
		}
		return 0;
	}
	
	function get_userlogin_result($offset, $limit)
	{
		//$query = $this->db->get('user_login',$limit,$offset);
		$this->db->select('*');
		$this->db->from('user_login');
		$this->db->join('user', 'user_login.user_id= user.user_id','left');
		$this->db->limit($limit,$offset);
		$this->db->order_by('user_login.login_id','desc');
		$query = $this->db->get();


		if ($query->num_rows() > 0) {
			return $query->result();
		}
		return 0;
	}
	
	
	function check_worker($user_id){
	
		$this->db->select('*');
		$this->db->from('worker');
		$this->db->where('worker.user_id',$user_id);
		$this->db->join('user', 'user.user_id= worker.user_id','left');
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return $query->row();
		}
		return 0;
	}
	
	
	/*** get total suspend user 
	*  return number
	**/
	
	function get_total_suspend_user_count()
	{
		$this->db->select('*');
		$this->db->from('user us');
		$this->db->join('user_profile up','us.user_id=up.user_id');
		$this->db->join('user_suspend spu','us.user_id=spu.user_id');
		$this->db->where('us.user_status',2);
		$this->db->group_by('spu.user_id');
		$this->db->order_by('spu.user_suspend_id','desc');
		$query=$this->db->get();
		return $query->num_rows();
		
	}
	
	
	/*** get suspend users details
	*  return multiple records array
	**/
	function get_suspend_user_result($offset, $limit)
	{
		$this->db->select('*');
		$this->db->from('user us');
		$this->db->join('user_profile up','us.user_id=up.user_id');
		$this->db->join('user_suspend spu','us.user_id=spu.user_id');
		$this->db->where('us.user_status',2);
		$this->db->group_by('spu.user_id');
		$this->db->order_by('spu.user_suspend_id','desc');
		$this->db->limit($limit,$offset);
		$query=$this->db->get();
		
		if ($query->num_rows() > 0) {
			return $query->result();
		}
		return 0;
	}
	
	function get_suspend_user_count($user_id){
	
		$this->db->select('*');
		$this->db->from('user_suspend us');
		$this->db->where('us.user_id',$user_id);
		$query=$this->db->get();
		return $query->num_rows();
	}
}
?>