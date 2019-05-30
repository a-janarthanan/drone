<?php
class User_model extends CI_Model 
{

	
	function User_model()
    {
        parent::__construct();	
    } 
	
	/*** get user info 
	* var integer $user_id
	***/
	
	
	function get_user_info($user_id)
	{
		$query=$this->db->get_where('user',array('user_id'=>$user_id));
		return $query->row();
	}
	
	
	/**** get user profile by id
	* var integer $user_id
	****/
	
	
	function get_user_profile_by_id($user_id)
	{
		
		
		$query=$this->db->query("select * from trc_user usr, trc_user_profile pr where usr.user_id=pr.user_id and usr.user_id='".$user_id."' and usr.user_status=1");	
		
		
		return $query->row();
	}
	
	/*** check the user unique email address
	*	var string $email
	*  return boolen
	**/

	function editemailTaken($email)
	{
	
		 $query = $this->db->query("select * from trc_user where user_id!='".get_authenticateUserID()."' and email='".$email."'");
		 
		 if($query->num_rows()>0)
		 {
			return true;
		 }
		 else 
		 {
			return false;
		 }		
	}
	
		/** user edit info
	* var string $first_name
	* var string $last_name
	* var string $email
	* var integer $zip_code
	* var integer $mobile_no
	* var datetime $phone_no	
	**/
	
	function edit_account()
	{	
		
	
		
			
		$first_name=$this->input->post('first_name');
		$last_name=$this->input->post('last_name');
		
		
		if($last_name!='')
		{
			$profile_name=clean_url($first_name.' '.substr($last_name,0,1));
		}
		else
		{
			$profile_name=clean_url($first_name);
		}
		
		
		
		
		
		$profile_name=clean_url($first_name.' '.substr($last_name,0,1));
		
					
			
	$chk_url_exists=$this->db->query("select MAX(profile_name) as profile_name from trc_user where user_id!='".get_authenticateUserID()."' and profile_name like '".$profile_name."%'");
		
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
				'zip_code'=>$this->input->post('zip_code'),
				'mobile_no'=>$this->input->post('mobile_no'),						
				'phone_no' =>$this->input->post('phone_no'),
				); 
				
		$this->db->where('user_id',get_authenticateUserID());		
		$this->db->update('user', $data);
	
		return 1;
		
		
	}
	
	
	
	function change_password()
	{
		
		$data=array(
			'password'=>md5($this->input->post('password'))		
		);
		
		$this->db->where('user_id',get_authenticateUserID());		
		$this->db->update('user', $data);
		
	}
	
	
	
	function get_user_notification($user_id)
	{
		$query=$this->db->get_where('user_notification',array('user_id'=>$user_id));
		return $query->row();
	}	
	
	
	function change_notification()
	{
		
		$data=array(
		'on_post_task'=>$this->input->post('on_post_task'),
		'on_comment_or_offer_task'=>$this->input->post('on_comment_or_offer_task'),
		'on_assign_task'=>$this->input->post('on_assign_task'),
		'on_complete_task'=>$this->input->post('on_complete_task'),
		'on_expire_task'=>$this->input->post('on_expire_task'),
		'on_promotions'=>$this->input->post('on_promotions'),		
		);
		
		$this->db->where('user_id',get_authenticateUserID());		
		$this->db->update('user_notification', $data);
		
	}
	
	
	function check_user_profile_exists($profile_name)
	{
		
		$query=$this->db->get_where('user',array('profile_name'=>$profile_name,'user_status'=>1));
		
		if($query->num_rows()>0)
		{
			return true;
		}
		else
		{
			return false;		
		}
		
	
	}
	function get_user_profile($profile_name)
	{
		
		$query=$this->db->query("select * from trc_user usr, trc_user_profile pr where usr.user_id=pr.user_id and usr.profile_name='".$profile_name."' and usr.user_status=1");		
		return $query->row();
	
	}
	
	
	/*** make user favorite
	*	 var interger $user_id
	**/
	
	
	function make_favorite($user_id)
	{
		
		$data=array(
		'my_user_id'=>get_authenticateUserID(),
		'favorite_user_id'=>$user_id,
		'favorite_date'=>date('Y-m-d H:i:s')				
		);
		
		$this->db->insert('user_favorite',$data);
		
	}
	
	/*** make user un favorite
	*	 var interger $user_id
	**/
	
	
	function un_favorite($user_id)
	{
		
		$data=array(
		'my_user_id'=>get_authenticateUserID(),
		'favorite_user_id'=>$user_id		
		);
		
		$this->db->delete('user_favorite',$data);
		
	}
	
	
	/*****   update profile
	*
	***/
	
	function update_profile()
	{
		$content= $this->input->post('about_user');
		
		$content=str_replace('"','KSYDOU',$content);
		$content=str_replace("'",'KSYSING',$content);
	
		$data=array(
		'current_city'=>$this->input->post('current_city'),
		'about_user'=>$content,
		'facebook_link'=>$this->input->post('facebook_link'),
		'linkedin_link'=>$this->input->post('linkedin_link'),
		'twitter_link'=>$this->input->post('twitter_link'),
		'youtube_link'=>$this->input->post('youtube_link'),
		'own_site_link'=>$this->input->post('own_site_link'),
		'blog_link'=>$this->input->post('blog_link'),
		'yelp_link'=>$this->input->post('yelp_link'),
		
		);	
		
		$data_insert=array(
		'current_city'=>$this->input->post('current_city'),
		'about_user'=>$content,
		'facebook_link'=>$this->input->post('facebook_link'),
		'linkedin_link'=>$this->input->post('linkedin_link'),
		'twitter_link'=>$this->input->post('twitter_link'),
		'youtube_link'=>$this->input->post('youtube_link'),
		'own_site_link'=>$this->input->post('own_site_link'),
		'blog_link'=>$this->input->post('blog_link'),
		'yelp_link'=>$this->input->post('yelp_link'),
		'user_id'=>get_authenticateUserID()
		);	
		
		
		$chk_user_profile_exists=$this->db->get_where('user_profile',array('user_id'=>get_authenticateUserID()));
		
		if($chk_user_profile_exists->num_rows()>0)
		{
			$this->db->where('user_id',get_authenticateUserID());		
			$this->db->update('user_profile', $data);
		}
		else
		{		
			$this->db->insert('user_profile', $data_insert);
		}
		
		
		
	}
	
	

	/*** update city in profile table
	* var integer city_id
	**/
	
	function update_city($city_id)
	{
		
		$data=array(
		'current_city'=>$city_id,
		'update_date'=>date('Y-m-d H:i:s')
		);
		$this->db->where('user_id',get_authenticateUserID());
		$this->db->update('user_profile',$data);
	}
	
	
	
	
	/*****upload user profile image
	*
	***/
	
	function upload_photo()
	{
	
		$profile_image='no_image.png';
		
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
		   
				$config['file_name']     = $rand.'user_'.get_authenticateUserID();
				$config['upload_path'] = base_path().'upload/user_orig/';					
				$config['allowed_types'] = 'jpg|jpeg|gif|png|bmp';					  
			  
			   $this->upload->initialize($config);
			 
			 
					if (!$this->upload->do_upload())
					{								
						 $error =  $this->upload->display_errors();	   
					} 
					
						$picture = $this->upload->data();
												
						$this->load->library('image_lib');					
						
						$this->image_lib->clear();
						
						$this->image_lib->initialize(array(
						'image_library' => 'gd2',
						'source_image' => base_path().'upload/user_orig/'.$picture['file_name'],
						'new_image' => base_path().'upload/user/'.$picture['file_name'],
						'maintain_ratio' => TRUE,
						'quality' => '100%',
						'width' => $image_settings->user_width,
						'height' => $image_settings->user_height
						));
									
									
						if(!$this->image_lib->resize())
						{					
							$error = $this->image_lib->display_errors();								
						}
						
						$profile_image=$picture['file_name'];
						
						
						
						
						
						if($this->input->post('prev_image')!='')
						{
							
							if(file_exists(base_path().'upload/user/'.$this->input->post('prev_image')))
							{
								$link=base_path().'upload/user/'.$this->input->post('prev_image');
								unlink($link);
							}
							
							if(file_exists(base_path().'upload/user_orig/'.$this->input->post('prev_image')))
							{
								$link2=base_path().'upload/user_orig/'.$this->input->post('prev_image');
								unlink($link2);
							}						
						
						}
						
			
		} else {
				
					
					if($this->input->post('prev_image')!='')
					{
						$profile_image=$this->input->post('prev_image');
					}
					
									
				}		
					
					
					
		
		$data=array(
			'profile_image'=>$profile_image
		);
		
		$this->db->where('user_id',get_authenticateUserID());
		$this->db->update('user_profile',$data);
		
	}
	
	
	/**** upload photo portfolio
	*
	***/
	
	
	function upload_portfolio()
	{
	
		$profile_image='';
		
		$image_settings=image_setting();
		
		
		
		if($_FILES['file_up']['name']!='')
		{
			$this->load->library('upload');
			$rand=rand(0,100000);	
			
			$_FILES['userfile']['name'] = $_FILES['file_up']['name'];
			$_FILES['userfile']['type'] = $_FILES['file_up']['type'];
			$_FILES['userfile']['tmp_name'] = $_FILES['file_up']['tmp_name'];
			$_FILES['userfile']['error'] = $_FILES['file_up']['error'];
			$_FILES['userfile']['size'] = $_FILES['file_up']['size'];	
			
			$config['file_name'] = $rand.'portfolio_'.get_authenticateUserID();
			$config['upload_path'] = base_path().'upload/user_orig/';	
			$config['allowed_types'] = 'jpg|jpeg|gif|png|bmp';	
			
			$this->upload->initialize($config);
			
			
			if (!$this->upload->do_upload())
			{	
			$error = $this->upload->display_errors();	
			} 
			
			$picture = $this->upload->data();
			
			$this->load->library('image_lib');	
			
			$this->image_lib->clear();
			
			$this->image_lib->initialize(array(
			'image_library' => 'gd2',
			'source_image' => base_path().'upload/user_orig/'.$picture['file_name'],
			'new_image' => base_path().'upload/user/'.$picture['file_name'],
			'maintain_ratio' => TRUE,
			'quality' => '100%',
			'width' => $image_settings->user_width,
			'height' => $image_settings->user_height
			));
		
			if(!$this->image_lib->resize())
			{	
			$error = $this->image_lib->display_errors();	
			}
			
			$profile_image=$picture['file_name'];
		}
		
		
		if($profile_image !='')
		{
			$data = array(	
				'user_id' => get_authenticateUserID(),
				'portfolio_image' => $profile_image,
			);
			$this->db->insert('user_portfolio', $data); 
			
		}
	
	}

	
	
	/*** upload video
	*
	***/
	
	function user_video()
	{
		if(trim($this->input->post('uservideo'))!='') 
		{
			$data = array(	
			'user_id' => get_authenticateUserID(),
			'portfolio_video' => $this->input->post('uservideo'),
			);
			
			$this->db->insert('user_portfolio', $data); 
		}
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
	
	
	/***** get portfolio id
	*N
	***/
	function get_portfolio_by_id($portfolio_id)
	{
		$query=$this->db->get_where('user_portfolio',array('portfolio_id' =>$portfolio_id));
		
		if($query->num_rows()>0)
		{
			return $query->row();
		}
		
		return 0;
	
	}
	
	/***	delete portfolio image
	**/
	
	function delete_portfolio()
	{
	
		$query=$this->db->get_where('user_portfolio',array('portfolio_id' =>$this->input->post('portfolio_id')));
		
		if($query->num_rows()>0)
		{
			$result = $query->row();
		
		
			if($result->portfolio_image!='')
			{
			
			
				if(file_exists(base_path().'upload/user/'.$result->portfolio_image))
				{
				$link=base_path().'upload/user/'.$result->portfolio_image;
				unlink($link);
				}
				
				if(file_exists(base_path().'upload/user_orig/'.$result->portfolio_image))
				{
				$link2=base_path().'upload/user_orig/'.$result->portfolio_image;
				unlink($link2);
				}
			
			
			
				$this->db->where('portfolio_id',$this->input->post('portfolio_id'));
				$this->db->delete('user_portfolio');
			}
		
		}
		
	}
	
	
	
	/*** delete portfolio video
	**/
	
	function delete_video($portfolio_id)
	{
	
		$query=$this->db->get_where('user_portfolio',array('portfolio_id' =>$portfolio_id));
		
		if($query->num_rows()>0)
		{
			$result = $query->row();
		
		
			if($result->portfolio_video!='')
			{
				$this->db->where('portfolio_id',$portfolio_id);
				$this->db->delete('user_portfolio');
			}
		
		}
		
	}


	
	
	/****  get user locations
	* var integer $user_id
	**/
	
	
	function get_user_location($user_id)
	{
		$query=$this->db->get_where('user_location',array('user_id'=>$user_id));
		
		if($query->num_rows()>0)
		{
			return $query->result();
		}
		
		return 0;
	}
	
	/*** get single location details
	* var interget location id
	***/
	
	function get_user_location_detail($user_location_id)
	{
		$query=$this->db->get_where('user_location',array('user_location_id'=>$user_location_id));
		
		if($query->num_rows()>0)
		{
			return $query->row();
		}
		
		return 0;
			
	}
	
	
	
	/***** get dashboard my task
	* var integer $my_task_limit
	***/
	
	function my_task($my_task_limit)
	{
		
		$this->db->select('*');
		$this->db->from('task');
		$this->db->where('user_id',get_authenticateUserID());
		$this->db->where('task_status !=',3);
		$this->db->order_by('task_id','desc');
		$this->db->limit($my_task_limit);
	
		$query=$this->db->get();
		
		if($query->num_rows()>0)
		{
			return $query->result();
		}
		
		return 0;
		
	}
	
	
	/**** top task
	* var integer $mt_top_limit
	***/
	
	function top_task($top_task_limit)
	{
	
		$user_status='visitor';
			
		if(check_user_authentication()) 
		{		
			$check_is_worker=$this->db->get_where('worker',array('user_id'=>get_authenticateUserID(),'worker_status'=>1));
			
			if($check_is_worker->num_rows()>0)
			{
				$user_status='worker';
			}		
		}
		
	
		
		$city_id=0;
		$city_cond='';
		
		if(get_authenticateUserID()!='')
		{
			$city_id = getCurrentCity();					
		}
		
		if($city_id>0)
		{
			$city_cond=" and tk.task_city_id='".$city_id."'";
			
		}
		
		
		if($user_status=='worker')
		{				
		$query = $this->db->query("select * from trc_task tk, trc_user ur,trc_user_profile up where tk.user_id = ur.user_id and ur.user_id = up.user_id and (tk.task_is_private=1 or tk.task_is_private=0) and tk.task_status = 1 and tk.task_activity_status > 0 ".$city_cond." order by tk.task_id desc limit ".$top_task_limit);
		}
		else
		{		
			$query = $this->db->query("select * from trc_task tk, trc_user ur,trc_user_profile up where tk.user_id = ur.user_id and ur.user_id = up.user_id and tk.task_status = 1 and tk.task_is_private=0 and tk.task_activity_status > 0 ".$city_cond." order by tk.task_id desc limit ".$top_task_limit);
		
		}	
		
		if($query->num_rows()>0)
		{
			return  $query->result();
		}

		return 0;
		
		
	}
	
	
	/**** newset task
	* var integer $new_task_limit
	***/
	
	function new_task($new_task_limit)
	{
	
		$user_status='visitor';
			
		if(check_user_authentication()) 
		{		
			$check_is_worker=$this->db->get_where('worker',array('user_id'=>get_authenticateUserID(),'worker_status'=>1));
			
			if($check_is_worker->num_rows()>0)
			{
				$user_status='worker';
			}		
		}
		
		
		
		
		$city_id=0;
		
		$city_id=0;
		$city_cond='';
		
		if(get_authenticateUserID()!='')
		{
			$city_id = getCurrentCity();					
		}
		
		if($city_id>0)
		{
			$city_cond=" and tk.task_city_id='".$city_id."'";
			
		}
		
		
		if($user_status=='worker')
		{				
		$query = $this->db->query("select * from trc_task tk, trc_user ur,trc_user_profile up where tk.user_id = ur.user_id and ur.user_id = up.user_id and (tk.task_is_private=1 or tk.task_is_private=0) and tk.task_status = 1 and DATE(tk.task_post_date)='".date('Y-m-d')."' and tk.task_activity_status >= 0 ".$city_cond." order by tk.task_id desc limit ".$new_task_limit);
		}
		else
		{		
			$query = $this->db->query("select * from trc_task tk, trc_user ur,trc_user_profile up where tk.user_id = ur.user_id and ur.user_id = up.user_id and tk.task_status = 1 and DATE(tk.task_post_date)='".date('Y-m-d')."' and tk.task_is_private=0 and tk.task_activity_status >= 0 ".$city_cond." order by tk.task_id desc limit ".$new_task_limit);
		
		}	
		
		
	
		if($query->num_rows()>0)
		{
			return  $query->result();
		}

		return 0;
		
		
	}
	
	
	
	/**** get user city task for map
	*
	**/
	
	function get_map_city_task()
	{
		$user_status='visitor';
			
		if(check_user_authentication()) 
		{		
			$check_is_worker=$this->db->get_where('worker',array('user_id'=>get_authenticateUserID(),'worker_status'=>1));
			
			if($check_is_worker->num_rows()>0)
			{
				$user_status='worker';
			}		
		}
		
	
		
		$city_id=0;
		$city_cond='';
		
		if(get_authenticateUserID()!='')
		{
			$city_id = getCurrentCity();					
		}
		
		
		
			$city_cond=" and tk.task_city_id='".$city_id."'";
			
	
		
		
		if($user_status=='worker')
		{				
		$query = $this->db->query("select * from trc_task tk, trc_user ur,trc_user_profile up where tk.user_id = ur.user_id and ur.user_id = up.user_id and (tk.task_is_private=1 or tk.task_is_private=0) and tk.task_status = 1  ".$city_cond." order by tk.task_id desc");
		}
		else
		{		
			$query = $this->db->query("select * from trc_task tk, trc_user ur,trc_user_profile up where tk.user_id = ur.user_id and ur.user_id = up.user_id and tk.task_status = 1 and tk.task_is_private=0  ".$city_cond." order by tk.task_id desc ");
		
		}	
		
		if($query->num_rows()>0)
		{
			return  $query->result();
		}

		return 0;
	}
	
	
	/*** review part 
	*
	***/
	
	function get_user_recent_reviews($user_id,$reviews_limit)
	{
		
		$this->db->select('*');
		$this->db->from('worker_comment cm');
		$this->db->join('task tk','cm.task_id=tk.task_id');
		$this->db->join('user us','cm.comment_post_user_id=us.user_id');
		$this->db->join('user_profile up','us.user_id=up.user_id');
		$this->db->where('cm.is_final',1);
		$this->db->where('cm.comment_to_user_id',$user_id);
		$this->db->order_by('cm.comment_date','desc');
		$this->db->limit($reviews_limit);
		
		$query=$this->db->get();
		
		if($query->num_rows()>0)
		{
			return $query->result();
		}

		return 0;
		
		
	}
	
	
	function get_user_total_reviews($user_id)
	{
		
		$this->db->select('*');
		$this->db->from('worker_comment cm');
		$this->db->join('task tk','cm.task_id=tk.task_id');
		$this->db->join('user us','cm.comment_post_user_id=us.user_id');
		$this->db->join('user_profile up','us.user_id=up.user_id');
		$this->db->where('cm.is_final',1);
		$this->db->where('cm.comment_to_user_id',$user_id);
		
		
		$query=$this->db->get();
		
		
		return $query->num_rows();
		
	}
	
	
	function get_user_all_reviews($user_id,$limit,$offset)
	{
		
		$this->db->select('*');
		$this->db->from('worker_comment cm');
		$this->db->join('task tk','cm.task_id=tk.task_id');
		$this->db->join('user us','cm.comment_post_user_id=us.user_id');
		$this->db->join('user_profile up','us.user_id=up.user_id');
		$this->db->where('cm.is_final',1);
		$this->db->where('cm.comment_to_user_id',$user_id);
		$this->db->order_by('cm.comment_date','desc');
		$this->db->limit($limit,$offset);
		
		$query=$this->db->get();
		
		if($query->num_rows()>0)
		{
			return $query->result();
		}

		return 0;
		
		
	}
	
	
	
	
	/***** profile page recent activities
	* var int $user_id
	* var int $activities_limit
	***/
	
	function get_user_recent_activities($user_id,$activities_limit)
	{
		
		$worker_id=0;
			
			
			
			
			
		$supported_cache=check_supported_cache_driver();
		
		if(isset($supported_cache))
		{
			if($supported_cache!='' && $supported_cache!='none')
			{
				////===load cache driver===
				$this->load->driver('cache');
				
				if($this->cache->$supported_cache->get('user_recent_activity'.$user_id))
				{
					return  (object)$this->cache->$supported_cache->get('user_recent_activity'.$user_id);				
				}
				else
				{
					$check_is_worker=$this->db->get_where('worker',array('user_id'=>$user_id,'worker_status'=>1));
			
					if($check_is_worker->num_rows()>0)
					{
				$worker_res=$check_is_worker->row();
				$worker_id=$worker_res->worker_id;
				
				
				
				
					$query=$this->db->query("select * from (  
		(select us.full_name as activity_name, 'activity_url_name' as activity_url_name, 'signup' as act, us.sign_up_date as activity_date,us.user_id as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name, up.profile_image as profile_user_image, (select worker_level as msg from trc_user cnus left join trc_worker cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id='".$user_id."')  as custom_msg, 'custom_msg2' as custom_msg2  from trc_user us, trc_user_profile up where us.user_id=up.user_id and us.user_id='".$user_id."') union 
			
		
		(select full_name as activity_name, 'activity_url_name' as activity_url_name, 'workersignup' as act, wrk.worker_date as activity_date,us.user_id as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name, up.profile_image as profile_user_image, (select worker_level as msg from trc_user cnus left join trc_worker cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id='".$user_id."') as custom_msg, 'custom_msg2' as custom_msg2  from trc_user us, trc_user_profile up, trc_worker wrk where us.user_id=up.user_id and wrk.user_id=us.user_id and us.user_id='".$user_id."') union 
		
		
		(select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'posttask' as act, tk.task_post_date as activity_date, (select worker_level as msg from trc_user cnus left join trc_worker cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id='".$user_id."') as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name,  up.profile_image as profile_user_image,  (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from trc_worker cnwrk, trc_user cnus, trc_user_profile cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_assing_worker) as custom_msg,  CONCAT_WS(',',tk.task_start_day,tk.task_start_time) as custom_msg2  from trc_task tk, trc_user us, trc_user_profile up where tk.user_id=us.user_id and us.user_id=up.user_id and tk.task_status=1 and tk.task_post_date!='0000-00-00 00:00:00' and tk.user_id='".$user_id."') union	
		
		
		(select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'workerposttask' as act, tk.task_post_date as activity_date, (select worker_level as msg from trc_user cnus left join trc_worker cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id=tk.user_id) as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name,  up.profile_image as profile_user_image,  (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from trc_worker cnwrk, trc_user cnus, trc_user_profile cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_assing_worker) as custom_msg,  CONCAT_WS(',',tk.task_start_day,tk.task_start_time) as custom_msg2  from trc_task tk, trc_user us, trc_user_profile up where tk.user_id=us.user_id and us.user_id=up.user_id and tk.task_status=1 and tk.task_post_date!='0000-00-00 00:00:00' and tk.task_assing_worker='".$worker_id."') union	
		
		
		( select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'assigntask' as act, tk.task_assigned_date as activity_date, (select worker_level as msg from trc_user cnus left join trc_worker cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id='".$user_id."') as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name, up.profile_image as profile_user_image, (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from trc_worker cnwrk, trc_user cnus, trc_user_profile cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_worker_id)  as custom_msg, 'custom_msg2' as custom_msg2 from trc_task tk,  trc_user us, trc_user_profile up where tk.task_assigned_date!='0000-00-00 00:00:00' and tk.task_status=1 and tk.task_worker_id>0 and tk.user_id=us.user_id and us.user_id=up.user_id and tk.user_id='".$user_id."')  union 
		
			( select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'workerassigntask' as act, tk.task_assigned_date as activity_date, (select worker_level as msg from trc_user cnus left join trc_worker cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id=tk.user_id) as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name, up.profile_image as profile_user_image, (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from trc_worker cnwrk, trc_user cnus, trc_user_profile cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_worker_id)  as custom_msg, 'custom_msg2' as custom_msg2 from trc_task tk,  trc_user us, trc_user_profile up where tk.task_assigned_date!='0000-00-00 00:00:00' and tk.task_status=1 and tk.task_worker_id>0 and tk.user_id=us.user_id and us.user_id=up.user_id and tk.task_worker_id='".$worker_id."')  union 
			
			
		
		(select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'completetask' as act, tk.task_complete_date as activity_date, tk.task_worker_id as key_id, wrkus.profile_name as profile_user_url_name, wrkus.full_name as profile_user_name,  wrkup.profile_image as profile_user_image, (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from trc_worker cnwrk, trc_user cnus, trc_user_profile cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_worker_id) as custom_msg, 'custom_msg2' as custom_msg2  from trc_task tk, trc_worker wrk, trc_user wrkus, trc_user_profile wrkup where tk.task_worker_id=wrk.worker_id and wrk.user_id=wrkus.user_id and wrkus.user_id=wrkup.user_id and tk.task_complete_date!='0000-00-00 00:00:00'  and tk.worker_agree=1 and tk.task_status=1 and tk.user_id='".$user_id."')   union
		
		
		(select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'workercompletetask' as act, tk.task_complete_date as activity_date, tk.task_worker_id as key_id, wrkus.profile_name as profile_user_url_name, wrkus.full_name as profile_user_name,  wrkup.profile_image as profile_user_image, (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from trc_worker cnwrk, trc_user cnus, trc_user_profile cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_worker_id) as custom_msg, 'custom_msg2' as custom_msg2  from trc_task tk, trc_worker wrk, trc_user wrkus, trc_user_profile wrkup where tk.task_worker_id=wrk.worker_id and wrk.user_id=wrkus.user_id and wrkus.user_id=wrkup.user_id and tk.task_complete_date!='0000-00-00 00:00:00'  and tk.worker_agree=1 and tk.task_status=1 and tk.task_worker_id='".$worker_id."')   union
		
		
		
		(select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'finishtask' as act, tk.task_close_date as activity_date, tk.task_worker_id as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name,  up.profile_image as profile_user_image , (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from trc_worker cnwrk, trc_user cnus, trc_user_profile cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_worker_id)  as custom_msg, 'custom_msg2' as custom_msg2 from trc_task tk, trc_user us, trc_user_profile up where tk.user_id=us.user_id and us.user_id=up.user_id and tk.task_close_date!='0000-00-00 00:00:00'  and  tk.poster_agree=1 and tk.task_status=1 and tk.user_id='".$user_id."')   union	
		
		
		(select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'workerfinishtask' as act, tk.task_close_date as activity_date, (select worker_level as msg from trc_user cnus left join trc_worker cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id=tk.user_id) as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name,  up.profile_image as profile_user_image , (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from trc_worker cnwrk, trc_user cnus, trc_user_profile cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_worker_id)  as custom_msg, 'custom_msg2' as custom_msg2 from trc_task tk, trc_user us, trc_user_profile up where tk.user_id=us.user_id and us.user_id=up.user_id and tk.task_close_date!='0000-00-00 00:00:00'  and  tk.poster_agree=1 and tk.task_status=1 and tk.task_worker_id='".$worker_id."')   union	
		
		
		
		 (select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'newcomment' as act, cm.comment_date as activity_date, (select worker_level as msg from trc_user cnus left join trc_worker cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id=cm.comment_post_user_id) as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name,  up.profile_image as profile_user_image, (select CONCAT_WS(',',cnus.profile_name,cnus.first_name,cnus.last_name,cnup.profile_image,cnwrk.worker_level) as msg from trc_user cnus left join trc_user_profile cnup on cnus.user_id=cnup.user_id left join trc_worker cnwrk on cnus.user_id=cnwrk.user_id where cnus.user_id=tk.user_id) as custom_msg, cm.task_comment as custom_msg2  from trc_worker_comment cm, trc_user us, trc_user_profile up, trc_task tk where cm.task_id=tk.task_id and cm.comment_post_user_id=us.user_id and us.user_id= up.user_id and (cm.offer_amount=0 or cm.offer_amount=0.00) and cm.is_accept=0 and cm.is_public=1 and cm.comment_post_user_id='".$user_id."')  union 
		 
		  (select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'newreply' as act, cm.comment_date as activity_date, (select worker_level as msg from trc_user cnus left join trc_worker cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id=cm.comment_post_user_id) as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name,  up.profile_image as profile_user_image, (select CONCAT_WS(',',cnus.profile_name,cnus.first_name,cnus.last_name,cnup.profile_image,cnwrk.worker_level) as msg from trc_user cnus left join trc_user_profile cnup on cnus.user_id=cnup.user_id left join trc_worker cnwrk on  cnus.user_id=cnwrk.user_id where cnus.user_id=tk.user_id) as custom_msg, cm.task_comment as custom_msg2  from trc_worker_comment cm, trc_user us, trc_user_profile up, trc_task tk where cm.task_id=tk.task_id and cm.comment_post_user_id=us.user_id and us.user_id= up.user_id and (cm.offer_amount=0 or cm.offer_amount=0.00) and cm.is_accept=0 and cm.is_public=1 and cm.comment_to_user_id='".$user_id."')   
		 
		 
		 
		 
		 
		 
		 ) tbl order by activity_date desc limit ".$activities_limit);
		 
		 
	
		 
		 
			}
		
					else {
	

	
		$query=$this->db->query("select * from (  
		(select us.full_name as activity_name, 'activity_url_name' as activity_url_name, 'signup' as act, us.sign_up_date as activity_date,us.user_id as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name, up.profile_image as profile_user_image, (select worker_level as msg from trc_user cnus left join trc_worker cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id='".$user_id."') as custom_msg, 'custom_msg2' as custom_msg2  from trc_user us, trc_user_profile up where us.user_id=up.user_id and us.user_id='".$user_id."') union 
		
		
		(select full_name as activity_name, 'activity_url_name' as activity_url_name, 'workersignup' as act, wrk.worker_date as activity_date,us.user_id as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name, up.profile_image as profile_user_image, (select worker_level as msg from trc_user cnus left join trc_worker cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id='".$user_id."') as custom_msg, 'custom_msg2' as custom_msg2  from trc_user us, trc_user_profile up, trc_worker wrk where us.user_id=up.user_id and wrk.user_id=us.user_id and us.user_id='".$user_id."') union 
		
		(select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'posttask' as act, tk.task_post_date as activity_date, (select worker_level as msg from trc_user cnus left join trc_worker cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id='".$user_id."') as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name,  up.profile_image as profile_user_image,  (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from trc_worker cnwrk, trc_user cnus, trc_user_profile cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_assing_worker) as custom_msg, CONCAT_WS(',',tk.task_start_day,tk.task_start_time) as custom_msg2  from trc_task tk, trc_user us, trc_user_profile up where tk.user_id=us.user_id and us.user_id=up.user_id and tk.task_status=1 and tk.task_post_date!='0000-00-00 00:00:00' and tk.user_id='".$user_id."') union	
		
		
		( select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'assigntask' as act, tk.task_assigned_date as activity_date, (select worker_level as msg from trc_user cnus left join trc_worker cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id='".$user_id."') as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name, up.profile_image as profile_user_image, (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from trc_worker cnwrk, trc_user cnus, trc_user_profile cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_worker_id)  as custom_msg, 'custom_msg2' as custom_msg2 from trc_task tk,  trc_user us, trc_user_profile up where tk.task_assigned_date!='0000-00-00 00:00:00' and tk.task_status=1 and tk.task_worker_id>0 and tk.user_id=us.user_id and us.user_id=up.user_id and tk.user_id='".$user_id."')  union 
		
		(select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'completetask' as act, tk.task_complete_date as activity_date, tk.task_worker_id as key_id, wrkus.profile_name as profile_user_url_name, wrkus.full_name as profile_user_name,  wrkup.profile_image as profile_user_image, (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from trc_worker cnwrk, trc_user cnus, trc_user_profile cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_worker_id) as custom_msg, 'custom_msg2' as custom_msg2  from trc_task tk, trc_worker wrk, trc_user wrkus, trc_user_profile wrkup where tk.task_worker_id=wrk.worker_id and wrk.user_id=wrkus.user_id and wrkus.user_id=wrkup.user_id and tk.task_complete_date!='0000-00-00 00:00:00'  and tk.worker_agree=1 and tk.task_status=1 and tk.user_id='".$user_id."')   union
		
		
		
		(select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'finishtask' as act, tk.task_close_date as activity_date, (select worker_level as msg from trc_user cnus left join trc_worker cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id='".$user_id."') as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name,  up.profile_image as profile_user_image , (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from trc_worker cnwrk, trc_user cnus, trc_user_profile cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_worker_id)  as custom_msg, 'custom_msg2' as custom_msg2 from trc_task tk, trc_user us, trc_user_profile up where tk.user_id=us.user_id and us.user_id=up.user_id and tk.task_close_date!='0000-00-00 00:00:00'  and  tk.poster_agree=1 and tk.task_status=1 and tk.user_id='".$user_id."')   union	
		
		
		
		 (select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'newcomment' as act, cm.comment_date as activity_date, (select worker_level as msg from trc_user cnus left join trc_worker cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id=cm.comment_post_user_id) as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name,  up.profile_image as profile_user_image, (select CONCAT_WS(',',cnus.profile_name,cnus.first_name,cnus.last_name,cnup.profile_image,cnwrk.worker_level) as msg from trc_user cnus left join trc_user_profile cnup on cnus.user_id=cnup.user_id left join trc_worker cnwrk on cnus.user_id=cnwrk.user_id where cnus.user_id=tk.user_id) as custom_msg, cm.task_comment as custom_msg2  from trc_worker_comment cm, trc_user us, trc_user_profile up, trc_task tk where cm.task_id=tk.task_id and cm.comment_post_user_id=us.user_id and us.user_id= up.user_id and (cm.offer_amount=0 or cm.offer_amount=0.00) and cm.is_accept=0 and cm.is_public=1 and cm.comment_post_user_id='".$user_id."')  union 
		 
		  (select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'newreply' as act, cm.comment_date as activity_date, (select worker_level as msg from trc_user cnus left join trc_worker cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id=cm.comment_post_user_id) as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name,  up.profile_image as profile_user_image, (select CONCAT_WS(',',cnus.profile_name,cnus.first_name,cnus.last_name,cnup.profile_image,cnwrk.worker_level) as msg from trc_user cnus left join trc_user_profile cnup on cnus.user_id=cnup.user_id left join trc_worker cnwrk on cnus.user_id=cnwrk.user_id where cnus.user_id=tk.user_id) as custom_msg, cm.task_comment as custom_msg2  from trc_worker_comment cm, trc_user us, trc_user_profile up, trc_task tk where cm.task_id=tk.task_id and cm.comment_post_user_id=us.user_id and us.user_id= up.user_id and (cm.offer_amount=0 or cm.offer_amount=0.00) and cm.is_accept=0 and cm.is_public=1 and cm.comment_to_user_id='".$user_id."')   
		 
		 
		 
		 
		 
		 
		 ) tbl order by activity_date desc limit ".$activities_limit);
	
	
	}
	
	
					if($query->num_rows()>0)
					{
						
						$this->cache->$supported_cache->save('user_recent_activity'.$user_id,$query->result(),864000);	
						return $query->result();	
					}
					
					
					return 0;
							
					
					
				}
			
			}
			
			else
			{
				$check_is_worker=$this->db->get_where('worker',array('user_id'=>$user_id,'worker_status'=>1));
			
				if($check_is_worker->num_rows()>0)
				{
				$worker_res=$check_is_worker->row();
				$worker_id=$worker_res->worker_id;
				
				
				
				
					$query=$this->db->query("select * from (  
		(select us.full_name as activity_name, 'activity_url_name' as activity_url_name, 'signup' as act, us.sign_up_date as activity_date,us.user_id as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name, up.profile_image as profile_user_image, (select worker_level as msg from trc_user cnus left join trc_worker cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id='".$user_id."')  as custom_msg, 'custom_msg2' as custom_msg2  from trc_user us, trc_user_profile up where us.user_id=up.user_id and us.user_id='".$user_id."') union 
			
		
		(select full_name as activity_name, 'activity_url_name' as activity_url_name, 'workersignup' as act, wrk.worker_date as activity_date,us.user_id as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name, up.profile_image as profile_user_image, (select worker_level as msg from trc_user cnus left join trc_worker cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id='".$user_id."') as custom_msg, 'custom_msg2' as custom_msg2  from trc_user us, trc_user_profile up, trc_worker wrk where us.user_id=up.user_id and wrk.user_id=us.user_id and us.user_id='".$user_id."') union 
		
		
		(select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'posttask' as act, tk.task_post_date as activity_date, (select worker_level as msg from trc_user cnus left join trc_worker cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id='".$user_id."') as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name,  up.profile_image as profile_user_image,  (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from trc_worker cnwrk, trc_user cnus, trc_user_profile cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_assing_worker) as custom_msg,  CONCAT_WS(',',tk.task_start_day,tk.task_start_time) as custom_msg2  from trc_task tk, trc_user us, trc_user_profile up where tk.user_id=us.user_id and us.user_id=up.user_id and tk.task_status=1 and tk.task_post_date!='0000-00-00 00:00:00' and tk.user_id='".$user_id."') union	
		
		
		(select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'workerposttask' as act, tk.task_post_date as activity_date, (select worker_level as msg from trc_user cnus left join trc_worker cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id=tk.user_id) as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name,  up.profile_image as profile_user_image,  (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from trc_worker cnwrk, trc_user cnus, trc_user_profile cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_assing_worker) as custom_msg,  CONCAT_WS(',',tk.task_start_day,tk.task_start_time) as custom_msg2  from trc_task tk, trc_user us, trc_user_profile up where tk.user_id=us.user_id and us.user_id=up.user_id and tk.task_status=1 and tk.task_post_date!='0000-00-00 00:00:00' and tk.task_assing_worker='".$worker_id."') union	
		
		
		( select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'assigntask' as act, tk.task_assigned_date as activity_date, (select worker_level as msg from trc_user cnus left join trc_worker cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id='".$user_id."') as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name, up.profile_image as profile_user_image, (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from trc_worker cnwrk, trc_user cnus, trc_user_profile cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_worker_id)  as custom_msg, 'custom_msg2' as custom_msg2 from trc_task tk,  trc_user us, trc_user_profile up where tk.task_assigned_date!='0000-00-00 00:00:00' and tk.task_status=1 and tk.task_worker_id>0 and tk.user_id=us.user_id and us.user_id=up.user_id and tk.user_id='".$user_id."')  union 
		
			( select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'workerassigntask' as act, tk.task_assigned_date as activity_date, (select worker_level as msg from trc_user cnus left join trc_worker cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id=tk.user_id) as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name, up.profile_image as profile_user_image, (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from trc_worker cnwrk, trc_user cnus, trc_user_profile cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_worker_id)  as custom_msg, 'custom_msg2' as custom_msg2 from trc_task tk,  trc_user us, trc_user_profile up where tk.task_assigned_date!='0000-00-00 00:00:00' and tk.task_status=1 and tk.task_worker_id>0 and tk.user_id=us.user_id and us.user_id=up.user_id and tk.task_worker_id='".$worker_id."')  union 
			
			
		
		(select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'completetask' as act, tk.task_complete_date as activity_date, tk.task_worker_id as key_id, wrkus.profile_name as profile_user_url_name, wrkus.full_name as profile_user_name,  wrkup.profile_image as profile_user_image, (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from trc_worker cnwrk, trc_user cnus, trc_user_profile cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_worker_id) as custom_msg, 'custom_msg2' as custom_msg2  from trc_task tk, trc_worker wrk, trc_user wrkus, trc_user_profile wrkup where tk.task_worker_id=wrk.worker_id and wrk.user_id=wrkus.user_id and wrkus.user_id=wrkup.user_id and tk.task_complete_date!='0000-00-00 00:00:00'  and tk.worker_agree=1 and tk.task_status=1 and tk.user_id='".$user_id."')   union
		
		
		(select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'workercompletetask' as act, tk.task_complete_date as activity_date, tk.task_worker_id as key_id, wrkus.profile_name as profile_user_url_name, wrkus.full_name as profile_user_name,  wrkup.profile_image as profile_user_image, (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from trc_worker cnwrk, trc_user cnus, trc_user_profile cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_worker_id) as custom_msg, 'custom_msg2' as custom_msg2  from trc_task tk, trc_worker wrk, trc_user wrkus, trc_user_profile wrkup where tk.task_worker_id=wrk.worker_id and wrk.user_id=wrkus.user_id and wrkus.user_id=wrkup.user_id and tk.task_complete_date!='0000-00-00 00:00:00'  and tk.worker_agree=1 and tk.task_status=1 and tk.task_worker_id='".$worker_id."')   union
		
		
		
		(select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'finishtask' as act, tk.task_close_date as activity_date, tk.task_worker_id as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name,  up.profile_image as profile_user_image , (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from trc_worker cnwrk, trc_user cnus, trc_user_profile cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_worker_id)  as custom_msg, 'custom_msg2' as custom_msg2 from trc_task tk, trc_user us, trc_user_profile up where tk.user_id=us.user_id and us.user_id=up.user_id and tk.task_close_date!='0000-00-00 00:00:00'  and  tk.poster_agree=1 and tk.task_status=1 and tk.user_id='".$user_id."')   union	
		
		
		(select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'workerfinishtask' as act, tk.task_close_date as activity_date, (select worker_level as msg from trc_user cnus left join trc_worker cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id=tk.user_id) as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name,  up.profile_image as profile_user_image , (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from trc_worker cnwrk, trc_user cnus, trc_user_profile cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_worker_id)  as custom_msg, 'custom_msg2' as custom_msg2 from trc_task tk, trc_user us, trc_user_profile up where tk.user_id=us.user_id and us.user_id=up.user_id and tk.task_close_date!='0000-00-00 00:00:00'  and  tk.poster_agree=1 and tk.task_status=1 and tk.task_worker_id='".$worker_id."')   union	
		
		
		
		 (select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'newcomment' as act, cm.comment_date as activity_date, (select worker_level as msg from trc_user cnus left join trc_worker cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id=cm.comment_post_user_id) as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name,  up.profile_image as profile_user_image, (select CONCAT_WS(',',cnus.profile_name,cnus.first_name,cnus.last_name,cnup.profile_image,cnwrk.worker_level) as msg from trc_user cnus left join trc_user_profile cnup on cnus.user_id=cnup.user_id left join trc_worker cnwrk on cnus.user_id=cnwrk.user_id where cnus.user_id=tk.user_id) as custom_msg, cm.task_comment as custom_msg2  from trc_worker_comment cm, trc_user us, trc_user_profile up, trc_task tk where cm.task_id=tk.task_id and cm.comment_post_user_id=us.user_id and us.user_id= up.user_id and (cm.offer_amount=0 or cm.offer_amount=0.00) and cm.is_accept=0 and cm.is_public=1 and cm.comment_post_user_id='".$user_id."')  union 
		 
		  (select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'newreply' as act, cm.comment_date as activity_date, (select worker_level as msg from trc_user cnus left join trc_worker cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id=cm.comment_post_user_id) as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name,  up.profile_image as profile_user_image, (select CONCAT_WS(',',cnus.profile_name,cnus.first_name,cnus.last_name,cnup.profile_image,cnwrk.worker_level) as msg from trc_user cnus left join trc_user_profile cnup on cnus.user_id=cnup.user_id left join trc_worker cnwrk on  cnus.user_id=cnwrk.user_id where cnus.user_id=tk.user_id) as custom_msg, cm.task_comment as custom_msg2  from trc_worker_comment cm, trc_user us, trc_user_profile up, trc_task tk where cm.task_id=tk.task_id and cm.comment_post_user_id=us.user_id and us.user_id= up.user_id and (cm.offer_amount=0 or cm.offer_amount=0.00) and cm.is_accept=0 and cm.is_public=1 and cm.comment_to_user_id='".$user_id."')   
		 
		 
		 
		 
		 
		 
		 ) tbl order by activity_date desc limit ".$activities_limit);
		 
		 
	
		 
		 
			}
		
				else {
	

	
		$query=$this->db->query("select * from (  
		(select us.full_name as activity_name, 'activity_url_name' as activity_url_name, 'signup' as act, us.sign_up_date as activity_date,us.user_id as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name, up.profile_image as profile_user_image, (select worker_level as msg from trc_user cnus left join trc_worker cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id='".$user_id."') as custom_msg, 'custom_msg2' as custom_msg2  from trc_user us, trc_user_profile up where us.user_id=up.user_id and us.user_id='".$user_id."') union 
		
		
		(select full_name as activity_name, 'activity_url_name' as activity_url_name, 'workersignup' as act, wrk.worker_date as activity_date,us.user_id as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name, up.profile_image as profile_user_image, (select worker_level as msg from trc_user cnus left join trc_worker cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id='".$user_id."') as custom_msg, 'custom_msg2' as custom_msg2  from trc_user us, trc_user_profile up, trc_worker wrk where us.user_id=up.user_id and wrk.user_id=us.user_id and us.user_id='".$user_id."') union 
		
		(select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'posttask' as act, tk.task_post_date as activity_date, (select worker_level as msg from trc_user cnus left join trc_worker cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id='".$user_id."') as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name,  up.profile_image as profile_user_image,  (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from trc_worker cnwrk, trc_user cnus, trc_user_profile cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_assing_worker) as custom_msg, CONCAT_WS(',',tk.task_start_day,tk.task_start_time) as custom_msg2  from trc_task tk, trc_user us, trc_user_profile up where tk.user_id=us.user_id and us.user_id=up.user_id and tk.task_status=1 and tk.task_post_date!='0000-00-00 00:00:00' and tk.user_id='".$user_id."') union	
		
		
		( select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'assigntask' as act, tk.task_assigned_date as activity_date, (select worker_level as msg from trc_user cnus left join trc_worker cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id='".$user_id."') as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name, up.profile_image as profile_user_image, (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from trc_worker cnwrk, trc_user cnus, trc_user_profile cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_worker_id)  as custom_msg, 'custom_msg2' as custom_msg2 from trc_task tk,  trc_user us, trc_user_profile up where tk.task_assigned_date!='0000-00-00 00:00:00' and tk.task_status=1 and tk.task_worker_id>0 and tk.user_id=us.user_id and us.user_id=up.user_id and tk.user_id='".$user_id."')  union 
		
		(select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'completetask' as act, tk.task_complete_date as activity_date, tk.task_worker_id as key_id, wrkus.profile_name as profile_user_url_name, wrkus.full_name as profile_user_name,  wrkup.profile_image as profile_user_image, (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from trc_worker cnwrk, trc_user cnus, trc_user_profile cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_worker_id) as custom_msg, 'custom_msg2' as custom_msg2  from trc_task tk, trc_worker wrk, trc_user wrkus, trc_user_profile wrkup where tk.task_worker_id=wrk.worker_id and wrk.user_id=wrkus.user_id and wrkus.user_id=wrkup.user_id and tk.task_complete_date!='0000-00-00 00:00:00'  and tk.worker_agree=1 and tk.task_status=1 and tk.user_id='".$user_id."')   union
		
		
		
		(select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'finishtask' as act, tk.task_close_date as activity_date, (select worker_level as msg from trc_user cnus left join trc_worker cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id='".$user_id."') as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name,  up.profile_image as profile_user_image , (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from trc_worker cnwrk, trc_user cnus, trc_user_profile cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_worker_id)  as custom_msg, 'custom_msg2' as custom_msg2 from trc_task tk, trc_user us, trc_user_profile up where tk.user_id=us.user_id and us.user_id=up.user_id and tk.task_close_date!='0000-00-00 00:00:00'  and  tk.poster_agree=1 and tk.task_status=1 and tk.user_id='".$user_id."')   union	
		
		
		
		 (select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'newcomment' as act, cm.comment_date as activity_date, (select worker_level as msg from trc_user cnus left join trc_worker cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id=cm.comment_post_user_id) as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name,  up.profile_image as profile_user_image, (select CONCAT_WS(',',cnus.profile_name,cnus.first_name,cnus.last_name,cnup.profile_image,cnwrk.worker_level) as msg from trc_user cnus left join trc_user_profile cnup on cnus.user_id=cnup.user_id left join trc_worker cnwrk on cnus.user_id=cnwrk.user_id where cnus.user_id=tk.user_id) as custom_msg, cm.task_comment as custom_msg2  from trc_worker_comment cm, trc_user us, trc_user_profile up, trc_task tk where cm.task_id=tk.task_id and cm.comment_post_user_id=us.user_id and us.user_id= up.user_id and (cm.offer_amount=0 or cm.offer_amount=0.00) and cm.is_accept=0 and cm.is_public=1 and cm.comment_post_user_id='".$user_id."')  union 
		 
		  (select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'newreply' as act, cm.comment_date as activity_date, (select worker_level as msg from trc_user cnus left join trc_worker cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id=cm.comment_post_user_id) as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name,  up.profile_image as profile_user_image, (select CONCAT_WS(',',cnus.profile_name,cnus.first_name,cnus.last_name,cnup.profile_image,cnwrk.worker_level) as msg from trc_user cnus left join trc_user_profile cnup on cnus.user_id=cnup.user_id left join trc_worker cnwrk on cnus.user_id=cnwrk.user_id where cnus.user_id=tk.user_id) as custom_msg, cm.task_comment as custom_msg2  from trc_worker_comment cm, trc_user us, trc_user_profile up, trc_task tk where cm.task_id=tk.task_id and cm.comment_post_user_id=us.user_id and us.user_id= up.user_id and (cm.offer_amount=0 or cm.offer_amount=0.00) and cm.is_accept=0 and cm.is_public=1 and cm.comment_to_user_id='".$user_id."')   
		 
		 
		 
		 
		 
		 
		 ) tbl order by activity_date desc limit ".$activities_limit);
	
	
	}
	
	
				if($query->num_rows()>0)
				{
					return $query->result();	
				}
				
				return 0;
			}
		}
		else
		{
			$check_is_worker=$this->db->get_where('worker',array('user_id'=>$user_id,'worker_status'=>1));
			
			if($check_is_worker->num_rows()>0)
			{
				$worker_res=$check_is_worker->row();
				$worker_id=$worker_res->worker_id;
				
				
				
				
					$query=$this->db->query("select * from (  
		(select us.full_name as activity_name, 'activity_url_name' as activity_url_name, 'signup' as act, us.sign_up_date as activity_date,us.user_id as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name, up.profile_image as profile_user_image, (select worker_level as msg from trc_user cnus left join trc_worker cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id='".$user_id."')  as custom_msg, 'custom_msg2' as custom_msg2  from trc_user us, trc_user_profile up where us.user_id=up.user_id and us.user_id='".$user_id."') union 
			
		
		(select full_name as activity_name, 'activity_url_name' as activity_url_name, 'workersignup' as act, wrk.worker_date as activity_date,us.user_id as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name, up.profile_image as profile_user_image, (select worker_level as msg from trc_user cnus left join trc_worker cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id='".$user_id."') as custom_msg, 'custom_msg2' as custom_msg2  from trc_user us, trc_user_profile up, trc_worker wrk where us.user_id=up.user_id and wrk.user_id=us.user_id and us.user_id='".$user_id."') union 
		
		
		(select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'posttask' as act, tk.task_post_date as activity_date, (select worker_level as msg from trc_user cnus left join trc_worker cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id='".$user_id."') as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name,  up.profile_image as profile_user_image,  (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from trc_worker cnwrk, trc_user cnus, trc_user_profile cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_assing_worker) as custom_msg,  CONCAT_WS(',',tk.task_start_day,tk.task_start_time) as custom_msg2  from trc_task tk, trc_user us, trc_user_profile up where tk.user_id=us.user_id and us.user_id=up.user_id and tk.task_status=1 and tk.task_post_date!='0000-00-00 00:00:00' and tk.user_id='".$user_id."') union	
		
		
		(select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'workerposttask' as act, tk.task_post_date as activity_date, (select worker_level as msg from trc_user cnus left join trc_worker cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id=tk.user_id) as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name,  up.profile_image as profile_user_image,  (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from trc_worker cnwrk, trc_user cnus, trc_user_profile cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_assing_worker) as custom_msg,  CONCAT_WS(',',tk.task_start_day,tk.task_start_time) as custom_msg2  from trc_task tk, trc_user us, trc_user_profile up where tk.user_id=us.user_id and us.user_id=up.user_id and tk.task_status=1 and tk.task_post_date!='0000-00-00 00:00:00' and tk.task_assing_worker='".$worker_id."') union	
		
		
		( select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'assigntask' as act, tk.task_assigned_date as activity_date, (select worker_level as msg from trc_user cnus left join trc_worker cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id='".$user_id."') as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name, up.profile_image as profile_user_image, (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from trc_worker cnwrk, trc_user cnus, trc_user_profile cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_worker_id)  as custom_msg, 'custom_msg2' as custom_msg2 from trc_task tk,  trc_user us, trc_user_profile up where tk.task_assigned_date!='0000-00-00 00:00:00' and tk.task_status=1 and tk.task_worker_id>0 and tk.user_id=us.user_id and us.user_id=up.user_id and tk.user_id='".$user_id."')  union 
		
			( select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'workerassigntask' as act, tk.task_assigned_date as activity_date, (select worker_level as msg from trc_user cnus left join trc_worker cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id=tk.user_id) as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name, up.profile_image as profile_user_image, (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from trc_worker cnwrk, trc_user cnus, trc_user_profile cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_worker_id)  as custom_msg, 'custom_msg2' as custom_msg2 from trc_task tk,  trc_user us, trc_user_profile up where tk.task_assigned_date!='0000-00-00 00:00:00' and tk.task_status=1 and tk.task_worker_id>0 and tk.user_id=us.user_id and us.user_id=up.user_id and tk.task_worker_id='".$worker_id."')  union 
			
			
		
		(select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'completetask' as act, tk.task_complete_date as activity_date, tk.task_worker_id as key_id, wrkus.profile_name as profile_user_url_name, wrkus.full_name as profile_user_name,  wrkup.profile_image as profile_user_image, (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from trc_worker cnwrk, trc_user cnus, trc_user_profile cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_worker_id) as custom_msg, 'custom_msg2' as custom_msg2  from trc_task tk, trc_worker wrk, trc_user wrkus, trc_user_profile wrkup where tk.task_worker_id=wrk.worker_id and wrk.user_id=wrkus.user_id and wrkus.user_id=wrkup.user_id and tk.task_complete_date!='0000-00-00 00:00:00'  and tk.worker_agree=1 and tk.task_status=1 and tk.user_id='".$user_id."')   union
		
		
		(select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'workercompletetask' as act, tk.task_complete_date as activity_date, tk.task_worker_id as key_id, wrkus.profile_name as profile_user_url_name, wrkus.full_name as profile_user_name,  wrkup.profile_image as profile_user_image, (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from trc_worker cnwrk, trc_user cnus, trc_user_profile cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_worker_id) as custom_msg, 'custom_msg2' as custom_msg2  from trc_task tk, trc_worker wrk, trc_user wrkus, trc_user_profile wrkup where tk.task_worker_id=wrk.worker_id and wrk.user_id=wrkus.user_id and wrkus.user_id=wrkup.user_id and tk.task_complete_date!='0000-00-00 00:00:00'  and tk.worker_agree=1 and tk.task_status=1 and tk.task_worker_id='".$worker_id."')   union
		
		
		
		(select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'finishtask' as act, tk.task_close_date as activity_date, tk.task_worker_id as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name,  up.profile_image as profile_user_image , (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from trc_worker cnwrk, trc_user cnus, trc_user_profile cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_worker_id)  as custom_msg, 'custom_msg2' as custom_msg2 from trc_task tk, trc_user us, trc_user_profile up where tk.user_id=us.user_id and us.user_id=up.user_id and tk.task_close_date!='0000-00-00 00:00:00'  and  tk.poster_agree=1 and tk.task_status=1 and tk.user_id='".$user_id."')   union	
		
		
		(select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'workerfinishtask' as act, tk.task_close_date as activity_date, (select worker_level as msg from trc_user cnus left join trc_worker cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id=tk.user_id) as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name,  up.profile_image as profile_user_image , (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from trc_worker cnwrk, trc_user cnus, trc_user_profile cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_worker_id)  as custom_msg, 'custom_msg2' as custom_msg2 from trc_task tk, trc_user us, trc_user_profile up where tk.user_id=us.user_id and us.user_id=up.user_id and tk.task_close_date!='0000-00-00 00:00:00'  and  tk.poster_agree=1 and tk.task_status=1 and tk.task_worker_id='".$worker_id."')   union	
		
		
		
		 (select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'newcomment' as act, cm.comment_date as activity_date, (select worker_level as msg from trc_user cnus left join trc_worker cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id=cm.comment_post_user_id) as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name,  up.profile_image as profile_user_image, (select CONCAT_WS(',',cnus.profile_name,cnus.first_name,cnus.last_name,cnup.profile_image,cnwrk.worker_level) as msg from trc_user cnus left join trc_user_profile cnup on cnus.user_id=cnup.user_id left join trc_worker cnwrk on cnus.user_id=cnwrk.user_id where cnus.user_id=tk.user_id) as custom_msg, cm.task_comment as custom_msg2  from trc_worker_comment cm, trc_user us, trc_user_profile up, trc_task tk where cm.task_id=tk.task_id and cm.comment_post_user_id=us.user_id and us.user_id= up.user_id and (cm.offer_amount=0 or cm.offer_amount=0.00) and cm.is_accept=0 and cm.is_public=1 and cm.comment_post_user_id='".$user_id."')  union 
		 
		  (select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'newreply' as act, cm.comment_date as activity_date, (select worker_level as msg from trc_user cnus left join trc_worker cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id=cm.comment_post_user_id) as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name,  up.profile_image as profile_user_image, (select CONCAT_WS(',',cnus.profile_name,cnus.first_name,cnus.last_name,cnup.profile_image,cnwrk.worker_level) as msg from trc_user cnus left join trc_user_profile cnup on cnus.user_id=cnup.user_id left join trc_worker cnwrk on  cnus.user_id=cnwrk.user_id where cnus.user_id=tk.user_id) as custom_msg, cm.task_comment as custom_msg2  from trc_worker_comment cm, trc_user us, trc_user_profile up, trc_task tk where cm.task_id=tk.task_id and cm.comment_post_user_id=us.user_id and us.user_id= up.user_id and (cm.offer_amount=0 or cm.offer_amount=0.00) and cm.is_accept=0 and cm.is_public=1 and cm.comment_to_user_id='".$user_id."')   
		 
		 
		 
		 
		 
		 
		 ) tbl order by activity_date desc limit ".$activities_limit);
		 
		 
	
		 
		 
			}
		
			else {
	

	
		$query=$this->db->query("select * from (  
		(select us.full_name as activity_name, 'activity_url_name' as activity_url_name, 'signup' as act, us.sign_up_date as activity_date,us.user_id as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name, up.profile_image as profile_user_image, (select worker_level as msg from trc_user cnus left join trc_worker cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id='".$user_id."') as custom_msg, 'custom_msg2' as custom_msg2  from trc_user us, trc_user_profile up where us.user_id=up.user_id and us.user_id='".$user_id."') union 
		
		
		(select full_name as activity_name, 'activity_url_name' as activity_url_name, 'workersignup' as act, wrk.worker_date as activity_date,us.user_id as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name, up.profile_image as profile_user_image, (select worker_level as msg from trc_user cnus left join trc_worker cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id='".$user_id."') as custom_msg, 'custom_msg2' as custom_msg2  from trc_user us, trc_user_profile up, trc_worker wrk where us.user_id=up.user_id and wrk.user_id=us.user_id and us.user_id='".$user_id."') union 
		
		(select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'posttask' as act, tk.task_post_date as activity_date, (select worker_level as msg from trc_user cnus left join trc_worker cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id='".$user_id."') as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name,  up.profile_image as profile_user_image,  (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from trc_worker cnwrk, trc_user cnus, trc_user_profile cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_assing_worker) as custom_msg, CONCAT_WS(',',tk.task_start_day,tk.task_start_time) as custom_msg2  from trc_task tk, trc_user us, trc_user_profile up where tk.user_id=us.user_id and us.user_id=up.user_id and tk.task_status=1 and tk.task_post_date!='0000-00-00 00:00:00' and tk.user_id='".$user_id."') union	
		
		
		( select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'assigntask' as act, tk.task_assigned_date as activity_date, (select worker_level as msg from trc_user cnus left join trc_worker cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id='".$user_id."') as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name, up.profile_image as profile_user_image, (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from trc_worker cnwrk, trc_user cnus, trc_user_profile cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_worker_id)  as custom_msg, 'custom_msg2' as custom_msg2 from trc_task tk,  trc_user us, trc_user_profile up where tk.task_assigned_date!='0000-00-00 00:00:00' and tk.task_status=1 and tk.task_worker_id>0 and tk.user_id=us.user_id and us.user_id=up.user_id and tk.user_id='".$user_id."')  union 
		
		(select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'completetask' as act, tk.task_complete_date as activity_date, tk.task_worker_id as key_id, wrkus.profile_name as profile_user_url_name, wrkus.full_name as profile_user_name,  wrkup.profile_image as profile_user_image, (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from trc_worker cnwrk, trc_user cnus, trc_user_profile cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_worker_id) as custom_msg, 'custom_msg2' as custom_msg2  from trc_task tk, trc_worker wrk, trc_user wrkus, trc_user_profile wrkup where tk.task_worker_id=wrk.worker_id and wrk.user_id=wrkus.user_id and wrkus.user_id=wrkup.user_id and tk.task_complete_date!='0000-00-00 00:00:00'  and tk.worker_agree=1 and tk.task_status=1 and tk.user_id='".$user_id."')   union
		
		
		
		(select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'finishtask' as act, tk.task_close_date as activity_date, (select worker_level as msg from trc_user cnus left join trc_worker cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id='".$user_id."') as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name,  up.profile_image as profile_user_image , (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from trc_worker cnwrk, trc_user cnus, trc_user_profile cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_worker_id)  as custom_msg, 'custom_msg2' as custom_msg2 from trc_task tk, trc_user us, trc_user_profile up where tk.user_id=us.user_id and us.user_id=up.user_id and tk.task_close_date!='0000-00-00 00:00:00'  and  tk.poster_agree=1 and tk.task_status=1 and tk.user_id='".$user_id."')   union	
		
		
		
		 (select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'newcomment' as act, cm.comment_date as activity_date, (select worker_level as msg from trc_user cnus left join trc_worker cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id=cm.comment_post_user_id) as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name,  up.profile_image as profile_user_image, (select CONCAT_WS(',',cnus.profile_name,cnus.first_name,cnus.last_name,cnup.profile_image,cnwrk.worker_level) as msg from trc_user cnus left join trc_user_profile cnup on cnus.user_id=cnup.user_id left join trc_worker cnwrk on cnus.user_id=cnwrk.user_id where cnus.user_id=tk.user_id) as custom_msg, cm.task_comment as custom_msg2  from trc_worker_comment cm, trc_user us, trc_user_profile up, trc_task tk where cm.task_id=tk.task_id and cm.comment_post_user_id=us.user_id and us.user_id= up.user_id and (cm.offer_amount=0 or cm.offer_amount=0.00) and cm.is_accept=0 and cm.is_public=1 and cm.comment_post_user_id='".$user_id."')  union 
		 
		  (select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'newreply' as act, cm.comment_date as activity_date, (select worker_level as msg from trc_user cnus left join trc_worker cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id=cm.comment_post_user_id) as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name,  up.profile_image as profile_user_image, (select CONCAT_WS(',',cnus.profile_name,cnus.first_name,cnus.last_name,cnup.profile_image,cnwrk.worker_level) as msg from trc_user cnus left join trc_user_profile cnup on cnus.user_id=cnup.user_id left join trc_worker cnwrk on cnus.user_id=cnwrk.user_id where cnus.user_id=tk.user_id) as custom_msg, cm.task_comment as custom_msg2  from trc_worker_comment cm, trc_user us, trc_user_profile up, trc_task tk where cm.task_id=tk.task_id and cm.comment_post_user_id=us.user_id and us.user_id= up.user_id and (cm.offer_amount=0 or cm.offer_amount=0.00) and cm.is_accept=0 and cm.is_public=1 and cm.comment_to_user_id='".$user_id."')   
		 
		 
		 
		 
		 
		 
		 ) tbl order by activity_date desc limit ".$activities_limit);
	
	
	}
	
	
			if($query->num_rows()>0)
			{
				return $query->result();	
			}
			
			return 0;
		}
		//////////====end cache part
		
		
		
		
			
			
			
			
			return 0;
			
	
	}
	
	
	function get_user_total_activities($user_id)
	{
	
	
		
		$worker_id=0;
		
		$check_is_worker=$this->db->get_where('worker',array('user_id'=>$user_id,'worker_status'=>1));
			
			if($check_is_worker->num_rows()>0)
			{
				$worker_res=$check_is_worker->row();
				$worker_id=$worker_res->worker_id;
				
				
				
				
					$query=$this->db->query("select * from (  
						(select us.full_name as activity_name, 'activity_url_name' as activity_url_name, 'signup' as act, us.sign_up_date as activity_date,us.user_id as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name, up.profile_image as profile_user_image, (select worker_level as msg from trc_user cnus left join trc_worker cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id='".$user_id."')  as custom_msg, 'custom_msg2' as custom_msg2  from trc_user us, trc_user_profile up where us.user_id=up.user_id and us.user_id='".$user_id."') union 
							
						
						(select full_name as activity_name, 'activity_url_name' as activity_url_name, 'workersignup' as act, wrk.worker_date as activity_date,us.user_id as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name, up.profile_image as profile_user_image, (select worker_level as msg from trc_user cnus left join trc_worker cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id='".$user_id."') as custom_msg, 'custom_msg2' as custom_msg2  from trc_user us, trc_user_profile up, trc_worker wrk where us.user_id=up.user_id and wrk.user_id=us.user_id and us.user_id='".$user_id."') union 
						
						
						(select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'posttask' as act, tk.task_post_date as activity_date, (select worker_level as msg from trc_user cnus left join trc_worker cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id='".$user_id."') as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name,  up.profile_image as profile_user_image,  (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from trc_worker cnwrk, trc_user cnus, trc_user_profile cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_assing_worker) as custom_msg,  CONCAT_WS(',',tk.task_start_day,tk.task_start_time) as custom_msg2  from trc_task tk, trc_user us, trc_user_profile up where tk.user_id=us.user_id and us.user_id=up.user_id and tk.task_status=1 and tk.task_post_date!='0000-00-00 00:00:00' and tk.user_id='".$user_id."') union	
						
						
						(select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'workerposttask' as act, tk.task_post_date as activity_date, (select worker_level as msg from trc_user cnus left join trc_worker cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id=tk.user_id) as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name,  up.profile_image as profile_user_image,  (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from trc_worker cnwrk, trc_user cnus, trc_user_profile cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_assing_worker) as custom_msg,  CONCAT_WS(',',tk.task_start_day,tk.task_start_time) as custom_msg2  from trc_task tk, trc_user us, trc_user_profile up where tk.user_id=us.user_id and us.user_id=up.user_id and tk.task_status=1 and tk.task_post_date!='0000-00-00 00:00:00' and tk.task_assing_worker='".$worker_id."') union	
						
						
						( select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'assigntask' as act, tk.task_assigned_date as activity_date, (select worker_level as msg from trc_user cnus left join trc_worker cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id='".$user_id."') as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name, up.profile_image as profile_user_image, (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from trc_worker cnwrk, trc_user cnus, trc_user_profile cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_worker_id)  as custom_msg, 'custom_msg2' as custom_msg2 from trc_task tk,  trc_user us, trc_user_profile up where tk.task_assigned_date!='0000-00-00 00:00:00' and tk.task_status=1 and tk.task_worker_id>0 and tk.user_id=us.user_id and us.user_id=up.user_id and tk.user_id='".$user_id."')  union 
						
							( select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'workerassigntask' as act, tk.task_assigned_date as activity_date, (select worker_level as msg from trc_user cnus left join trc_worker cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id=tk.user_id) as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name, up.profile_image as profile_user_image, (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from trc_worker cnwrk, trc_user cnus, trc_user_profile cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_worker_id)  as custom_msg, 'custom_msg2' as custom_msg2 from trc_task tk,  trc_user us, trc_user_profile up where tk.task_assigned_date!='0000-00-00 00:00:00' and tk.task_status=1 and tk.task_worker_id>0 and tk.user_id=us.user_id and us.user_id=up.user_id and tk.task_worker_id='".$worker_id."')  union 
							
							
						
						(select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'completetask' as act, tk.task_complete_date as activity_date, tk.task_worker_id as key_id, wrkus.profile_name as profile_user_url_name, wrkus.full_name as profile_user_name,  wrkup.profile_image as profile_user_image, (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from trc_worker cnwrk, trc_user cnus, trc_user_profile cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_worker_id) as custom_msg, 'custom_msg2' as custom_msg2  from trc_task tk, trc_worker wrk, trc_user wrkus, trc_user_profile wrkup where tk.task_worker_id=wrk.worker_id and wrk.user_id=wrkus.user_id and wrkus.user_id=wrkup.user_id and tk.task_complete_date!='0000-00-00 00:00:00'  and tk.worker_agree=1 and tk.task_status=1 and tk.user_id='".$user_id."')   union
						
						
						(select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'workercompletetask' as act, tk.task_complete_date as activity_date, tk.task_worker_id as key_id, wrkus.profile_name as profile_user_url_name, wrkus.full_name as profile_user_name,  wrkup.profile_image as profile_user_image, (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from trc_worker cnwrk, trc_user cnus, trc_user_profile cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_worker_id) as custom_msg, 'custom_msg2' as custom_msg2  from trc_task tk, trc_worker wrk, trc_user wrkus, trc_user_profile wrkup where tk.task_worker_id=wrk.worker_id and wrk.user_id=wrkus.user_id and wrkus.user_id=wrkup.user_id and tk.task_complete_date!='0000-00-00 00:00:00'  and tk.worker_agree=1 and tk.task_status=1 and tk.task_worker_id='".$worker_id."')   union
						
						
						
						(select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'finishtask' as act, tk.task_close_date as activity_date, tk.task_worker_id as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name,  up.profile_image as profile_user_image , (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from trc_worker cnwrk, trc_user cnus, trc_user_profile cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_worker_id)  as custom_msg, 'custom_msg2' as custom_msg2 from trc_task tk, trc_user us, trc_user_profile up where tk.user_id=us.user_id and us.user_id=up.user_id and tk.task_close_date!='0000-00-00 00:00:00'  and  tk.poster_agree=1 and tk.task_status=1 and tk.user_id='".$user_id."')   union	
						
						
						(select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'workerfinishtask' as act, tk.task_close_date as activity_date, (select worker_level as msg from trc_user cnus left join trc_worker cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id=tk.user_id) as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name,  up.profile_image as profile_user_image , (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from trc_worker cnwrk, trc_user cnus, trc_user_profile cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_worker_id)  as custom_msg, 'custom_msg2' as custom_msg2 from trc_task tk, trc_user us, trc_user_profile up where tk.user_id=us.user_id and us.user_id=up.user_id and tk.task_close_date!='0000-00-00 00:00:00'  and  tk.poster_agree=1 and tk.task_status=1 and tk.task_worker_id='".$worker_id."')   union	
						
						
						
						 (select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'newcomment' as act, cm.comment_date as activity_date, (select worker_level as msg from trc_user cnus left join trc_worker cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id=cm.comment_post_user_id) as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name,  up.profile_image as profile_user_image, (select CONCAT_WS(',',cnus.profile_name,cnus.first_name,cnus.last_name,cnup.profile_image,cnwrk.worker_level) as msg from trc_user cnus left join trc_user_profile cnup on cnus.user_id=cnup.user_id left join trc_worker cnwrk on cnus.user_id=cnwrk.user_id where cnus.user_id=tk.user_id) as custom_msg, cm.task_comment as custom_msg2  from trc_worker_comment cm, trc_user us, trc_user_profile up, trc_task tk where cm.task_id=tk.task_id and cm.comment_post_user_id=us.user_id and us.user_id= up.user_id and (cm.offer_amount=0 or cm.offer_amount=0.00) and cm.is_accept=0 and cm.is_public=1 and cm.comment_post_user_id='".$user_id."')  union 
		 
		  (select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'newreply' as act, cm.comment_date as activity_date, (select worker_level as msg from trc_user cnus left join trc_worker cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id=cm.comment_post_user_id) as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name,  up.profile_image as profile_user_image, (select CONCAT_WS(',',cnus.profile_name,cnus.first_name,cnus.last_name,cnup.profile_image,cnwrk.worker_level) as msg from trc_user cnus left join trc_user_profile cnup on cnus.user_id=cnup.user_id left join trc_worker cnwrk on  cnus.user_id=cnwrk.user_id where cnus.user_id=tk.user_id) as custom_msg, cm.task_comment as custom_msg2  from trc_worker_comment cm, trc_user us, trc_user_profile up, trc_task tk where cm.task_id=tk.task_id and cm.comment_post_user_id=us.user_id and us.user_id= up.user_id and (cm.offer_amount=0 or cm.offer_amount=0.00) and cm.is_accept=0 and cm.is_public=1 and cm.comment_to_user_id='".$user_id."')   
						 
						 
						 
						 
						 
						 
						 ) tbl order by activity_date desc");
						 
						 
							}
						
						else {
					
				
					
						$query=$this->db->query("select * from (  
						(select us.full_name as activity_name, 'activity_url_name' as activity_url_name, 'signup' as act, us.sign_up_date as activity_date,us.user_id as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name, up.profile_image as profile_user_image, (select worker_level as msg from trc_user cnus left join trc_worker cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id='".$user_id."') as custom_msg, 'custom_msg2' as custom_msg2  from trc_user us, trc_user_profile up where us.user_id=up.user_id and us.user_id='".$user_id."') union 
						
						
						(select full_name as activity_name, 'activity_url_name' as activity_url_name, 'workersignup' as act, wrk.worker_date as activity_date,us.user_id as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name, up.profile_image as profile_user_image, (select worker_level as msg from trc_user cnus left join trc_worker cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id='".$user_id."') as custom_msg, 'custom_msg2' as custom_msg2  from trc_user us, trc_user_profile up, trc_worker wrk where us.user_id=up.user_id and wrk.user_id=us.user_id and us.user_id='".$user_id."') union 
						
						(select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'posttask' as act, tk.task_post_date as activity_date, (select worker_level as msg from trc_user cnus left join trc_worker cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id='".$user_id."') as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name,  up.profile_image as profile_user_image,  (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from trc_worker cnwrk, trc_user cnus, trc_user_profile cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_assing_worker) as custom_msg, CONCAT_WS(',',tk.task_start_day,tk.task_start_time) as custom_msg2  from trc_task tk, trc_user us, trc_user_profile up where tk.user_id=us.user_id and us.user_id=up.user_id and tk.task_status=1 and tk.task_post_date!='0000-00-00 00:00:00' and tk.user_id='".$user_id."') union	
						
						
						( select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'assigntask' as act, tk.task_assigned_date as activity_date, (select worker_level as msg from trc_user cnus left join trc_worker cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id='".$user_id."') as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name, up.profile_image as profile_user_image, (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from trc_worker cnwrk, trc_user cnus, trc_user_profile cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_worker_id)  as custom_msg, 'custom_msg2' as custom_msg2 from trc_task tk,  trc_user us, trc_user_profile up where tk.task_assigned_date!='0000-00-00 00:00:00' and tk.task_status=1 and tk.task_worker_id>0 and tk.user_id=us.user_id and us.user_id=up.user_id and tk.user_id='".$user_id."')  union 
						
						(select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'completetask' as act, tk.task_complete_date as activity_date, tk.task_worker_id as key_id, wrkus.profile_name as profile_user_url_name, wrkus.full_name as profile_user_name,  wrkup.profile_image as profile_user_image, (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from trc_worker cnwrk, trc_user cnus, trc_user_profile cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_worker_id) as custom_msg, 'custom_msg2' as custom_msg2  from trc_task tk, trc_worker wrk, trc_user wrkus, trc_user_profile wrkup where tk.task_worker_id=wrk.worker_id and wrk.user_id=wrkus.user_id and wrkus.user_id=wrkup.user_id and tk.task_complete_date!='0000-00-00 00:00:00'  and tk.worker_agree=1 and tk.task_status=1 and tk.user_id='".$user_id."')   union
						
						
						
						(select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'finishtask' as act, tk.task_close_date as activity_date, (select worker_level as msg from trc_user cnus left join trc_worker cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id='".$user_id."') as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name,  up.profile_image as profile_user_image , (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from trc_worker cnwrk, trc_user cnus, trc_user_profile cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_worker_id)  as custom_msg, 'custom_msg2' as custom_msg2 from trc_task tk, trc_user us, trc_user_profile up where tk.user_id=us.user_id and us.user_id=up.user_id and tk.task_close_date!='0000-00-00 00:00:00'  and  tk.poster_agree=1 and tk.task_status=1 and tk.user_id='".$user_id."')   union	
						
						
						
				
		 (select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'newcomment' as act, cm.comment_date as activity_date, (select worker_level as msg from trc_user cnus left join trc_worker cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id=cm.comment_post_user_id) as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name,  up.profile_image as profile_user_image, (select CONCAT_WS(',',cnus.profile_name,cnus.first_name,cnus.last_name,cnup.profile_image,cnwrk.worker_level) as msg from trc_user cnus left join trc_user_profile cnup on cnus.user_id=cnup.user_id left join trc_worker cnwrk on cnus.user_id=cnwrk.user_id where cnus.user_id=tk.user_id) as custom_msg, cm.task_comment as custom_msg2  from trc_worker_comment cm, trc_user us, trc_user_profile up, trc_task tk where cm.task_id=tk.task_id and cm.comment_post_user_id=us.user_id and us.user_id= up.user_id and (cm.offer_amount=0 or cm.offer_amount=0.00) and cm.is_accept=0 and cm.is_public=1 and cm.comment_post_user_id='".$user_id."')  union 
		 
		  (select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'newreply' as act, cm.comment_date as activity_date, (select worker_level as msg from trc_user cnus left join trc_worker cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id=cm.comment_post_user_id) as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name,  up.profile_image as profile_user_image, (select CONCAT_WS(',',cnus.profile_name,cnus.first_name,cnus.last_name,cnup.profile_image,cnwrk.worker_level) as msg from trc_user cnus left join trc_user_profile cnup on cnus.user_id=cnup.user_id left join trc_worker cnwrk on cnus.user_id=cnwrk.user_id where cnus.user_id=tk.user_id) as custom_msg, cm.task_comment as custom_msg2  from trc_worker_comment cm, trc_user us, trc_user_profile up, trc_task tk where cm.task_id=tk.task_id and cm.comment_post_user_id=us.user_id and us.user_id= up.user_id and (cm.offer_amount=0 or cm.offer_amount=0.00) and cm.is_accept=0 and cm.is_public=1 and cm.comment_to_user_id='".$user_id."')   
		 
						 
						 
						 
						 
						 
						 
						 ) tbl order by activity_date desc");
					
					
					}
					
					
					
								return $query->num_rows();	
					
	}
	
	
	function get_user_all_activities($user_id,$limit,$offset)
	{
	
		
		
		$worker_id=0;
		
		$check_is_worker=$this->db->get_where('worker',array('user_id'=>$user_id,'worker_status'=>1));
			
			if($check_is_worker->num_rows()>0)
			{
				$worker_res=$check_is_worker->row();
				$worker_id=$worker_res->worker_id;
				
				
				
				
					$query=$this->db->query("select * from (  
		(select us.full_name as activity_name, 'activity_url_name' as activity_url_name, 'signup' as act, us.sign_up_date as activity_date,us.user_id as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name, up.profile_image as profile_user_image, (select worker_level as msg from trc_user cnus left join trc_worker cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id='".$user_id."')  as custom_msg, 'custom_msg2' as custom_msg2  from trc_user us, trc_user_profile up where us.user_id=up.user_id and us.user_id='".$user_id."') union 
			
		
		(select full_name as activity_name, 'activity_url_name' as activity_url_name, 'workersignup' as act, wrk.worker_date as activity_date,us.user_id as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name, up.profile_image as profile_user_image, (select worker_level as msg from trc_user cnus left join trc_worker cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id='".$user_id."') as custom_msg, 'custom_msg2' as custom_msg2  from trc_user us, trc_user_profile up, trc_worker wrk where us.user_id=up.user_id and wrk.user_id=us.user_id and us.user_id='".$user_id."') union 
		
		
		(select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'posttask' as act, tk.task_post_date as activity_date, (select worker_level as msg from trc_user cnus left join trc_worker cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id='".$user_id."') as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name,  up.profile_image as profile_user_image,  (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from trc_worker cnwrk, trc_user cnus, trc_user_profile cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_assing_worker) as custom_msg,  CONCAT_WS(',',tk.task_start_day,tk.task_start_time) as custom_msg2  from trc_task tk, trc_user us, trc_user_profile up where tk.user_id=us.user_id and us.user_id=up.user_id and tk.task_status=1 and tk.task_post_date!='0000-00-00 00:00:00' and tk.user_id='".$user_id."') union	
		
		
		(select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'workerposttask' as act, tk.task_post_date as activity_date, (select worker_level as msg from trc_user cnus left join trc_worker cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id=tk.user_id) as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name,  up.profile_image as profile_user_image,  (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from trc_worker cnwrk, trc_user cnus, trc_user_profile cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_assing_worker) as custom_msg,  CONCAT_WS(',',tk.task_start_day,tk.task_start_time) as custom_msg2  from trc_task tk, trc_user us, trc_user_profile up where tk.user_id=us.user_id and us.user_id=up.user_id and tk.task_status=1 and tk.task_post_date!='0000-00-00 00:00:00' and tk.task_assing_worker='".$worker_id."') union	
		
		
		( select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'assigntask' as act, tk.task_assigned_date as activity_date, (select worker_level as msg from trc_user cnus left join trc_worker cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id='".$user_id."') as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name, up.profile_image as profile_user_image, (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from trc_worker cnwrk, trc_user cnus, trc_user_profile cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_worker_id)  as custom_msg, 'custom_msg2' as custom_msg2 from trc_task tk,  trc_user us, trc_user_profile up where tk.task_assigned_date!='0000-00-00 00:00:00' and tk.task_status=1 and tk.task_worker_id>0 and tk.user_id=us.user_id and us.user_id=up.user_id and tk.user_id='".$user_id."')  union 
		
			( select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'workerassigntask' as act, tk.task_assigned_date as activity_date, (select worker_level as msg from trc_user cnus left join trc_worker cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id=tk.user_id) as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name, up.profile_image as profile_user_image, (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from trc_worker cnwrk, trc_user cnus, trc_user_profile cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_worker_id)  as custom_msg, 'custom_msg2' as custom_msg2 from trc_task tk,  trc_user us, trc_user_profile up where tk.task_assigned_date!='0000-00-00 00:00:00' and tk.task_status=1 and tk.task_worker_id>0 and tk.user_id=us.user_id and us.user_id=up.user_id and tk.task_worker_id='".$worker_id."')  union 
			
			
		
		(select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'completetask' as act, tk.task_complete_date as activity_date, tk.task_worker_id as key_id, wrkus.profile_name as profile_user_url_name, wrkus.full_name as profile_user_name,  wrkup.profile_image as profile_user_image, (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from trc_worker cnwrk, trc_user cnus, trc_user_profile cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_worker_id) as custom_msg, 'custom_msg2' as custom_msg2  from trc_task tk, trc_worker wrk, trc_user wrkus, trc_user_profile wrkup where tk.task_worker_id=wrk.worker_id and wrk.user_id=wrkus.user_id and wrkus.user_id=wrkup.user_id and tk.task_complete_date!='0000-00-00 00:00:00'  and tk.worker_agree=1 and tk.task_status=1 and tk.user_id='".$user_id."')   union
		
		
		(select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'workercompletetask' as act, tk.task_complete_date as activity_date, tk.task_worker_id as key_id, wrkus.profile_name as profile_user_url_name, wrkus.full_name as profile_user_name,  wrkup.profile_image as profile_user_image, (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from trc_worker cnwrk, trc_user cnus, trc_user_profile cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_worker_id) as custom_msg, 'custom_msg2' as custom_msg2  from trc_task tk, trc_worker wrk, trc_user wrkus, trc_user_profile wrkup where tk.task_worker_id=wrk.worker_id and wrk.user_id=wrkus.user_id and wrkus.user_id=wrkup.user_id and tk.task_complete_date!='0000-00-00 00:00:00'  and tk.worker_agree=1 and tk.task_status=1 and tk.task_worker_id='".$worker_id."')   union
		
		
		
		(select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'finishtask' as act, tk.task_close_date as activity_date, tk.task_worker_id as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name,  up.profile_image as profile_user_image , (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from trc_worker cnwrk, trc_user cnus, trc_user_profile cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_worker_id)  as custom_msg, 'custom_msg2' as custom_msg2 from trc_task tk, trc_user us, trc_user_profile up where tk.user_id=us.user_id and us.user_id=up.user_id and tk.task_close_date!='0000-00-00 00:00:00'  and  tk.poster_agree=1 and tk.task_status=1 and tk.user_id='".$user_id."')   union	
		
		
		(select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'workerfinishtask' as act, tk.task_close_date as activity_date, (select worker_level as msg from trc_user cnus left join trc_worker cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id=tk.user_id) as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name,  up.profile_image as profile_user_image , (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from trc_worker cnwrk, trc_user cnus, trc_user_profile cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_worker_id)  as custom_msg, 'custom_msg2' as custom_msg2 from trc_task tk, trc_user us, trc_user_profile up where tk.user_id=us.user_id and us.user_id=up.user_id and tk.task_close_date!='0000-00-00 00:00:00'  and  tk.poster_agree=1 and tk.task_status=1 and tk.task_worker_id='".$worker_id."')   union	
		
		
		
			 (select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'newcomment' as act, cm.comment_date as activity_date, (select worker_level as msg from trc_user cnus left join trc_worker cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id=cm.comment_post_user_id) as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name,  up.profile_image as profile_user_image, (select CONCAT_WS(',',cnus.profile_name,cnus.first_name,cnus.last_name,cnup.profile_image,cnwrk.worker_level) as msg from trc_user cnus left join trc_user_profile cnup on cnus.user_id=cnup.user_id left join trc_worker cnwrk on cnus.user_id=cnwrk.user_id where cnus.user_id=tk.user_id) as custom_msg, cm.task_comment as custom_msg2  from trc_worker_comment cm, trc_user us, trc_user_profile up, trc_task tk where cm.task_id=tk.task_id and cm.comment_post_user_id=us.user_id and us.user_id= up.user_id and (cm.offer_amount=0 or cm.offer_amount=0.00) and cm.is_accept=0 and cm.is_public=1 and cm.comment_post_user_id='".$user_id."')  union 
		 
		  (select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'newreply' as act, cm.comment_date as activity_date, (select worker_level as msg from trc_user cnus left join trc_worker cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id=cm.comment_post_user_id) as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name,  up.profile_image as profile_user_image, (select CONCAT_WS(',',cnus.profile_name,cnus.first_name,cnus.last_name,cnup.profile_image,cnwrk.worker_level) as msg from trc_user cnus left join trc_user_profile cnup on cnus.user_id=cnup.user_id left join trc_worker cnwrk on  cnus.user_id=cnwrk.user_id where cnus.user_id=tk.user_id) as custom_msg, cm.task_comment as custom_msg2  from trc_worker_comment cm, trc_user us, trc_user_profile up, trc_task tk where cm.task_id=tk.task_id and cm.comment_post_user_id=us.user_id and us.user_id= up.user_id and (cm.offer_amount=0 or cm.offer_amount=0.00) and cm.is_accept=0 and cm.is_public=1 and cm.comment_to_user_id='".$user_id."')  
		 
		 
		 
		 
		 
		 
		 ) tbl order by activity_date desc limit ".$limit. " offset ".$offset);
		 
		 
			}
		
		else {
	

	
		$query=$this->db->query("select * from (  
		(select us.full_name as activity_name, 'activity_url_name' as activity_url_name, 'signup' as act, us.sign_up_date as activity_date,us.user_id as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name, up.profile_image as profile_user_image, (select worker_level as msg from trc_user cnus left join trc_worker cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id='".$user_id."') as custom_msg, 'custom_msg2' as custom_msg2  from trc_user us, trc_user_profile up where us.user_id=up.user_id and us.user_id='".$user_id."') union 
		
		
		(select full_name as activity_name, 'activity_url_name' as activity_url_name, 'workersignup' as act, wrk.worker_date as activity_date,us.user_id as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name, up.profile_image as profile_user_image, (select worker_level as msg from trc_user cnus left join trc_worker cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id='".$user_id."') as custom_msg, 'custom_msg2' as custom_msg2  from trc_user us, trc_user_profile up, trc_worker wrk where us.user_id=up.user_id and wrk.user_id=us.user_id and us.user_id='".$user_id."') union 
		
		(select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'posttask' as act, tk.task_post_date as activity_date, (select worker_level as msg from trc_user cnus left join trc_worker cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id='".$user_id."') as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name,  up.profile_image as profile_user_image,  (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from trc_worker cnwrk, trc_user cnus, trc_user_profile cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_assing_worker) as custom_msg, CONCAT_WS(',',tk.task_start_day,tk.task_start_time) as custom_msg2  from trc_task tk, trc_user us, trc_user_profile up where tk.user_id=us.user_id and us.user_id=up.user_id and tk.task_status=1 and tk.task_post_date!='0000-00-00 00:00:00' and tk.user_id='".$user_id."') union	
		
		
		( select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'assigntask' as act, tk.task_assigned_date as activity_date, (select worker_level as msg from trc_user cnus left join trc_worker cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id='".$user_id."') as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name, up.profile_image as profile_user_image, (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from trc_worker cnwrk, trc_user cnus, trc_user_profile cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_worker_id)  as custom_msg, 'custom_msg2' as custom_msg2 from trc_task tk,  trc_user us, trc_user_profile up where tk.task_assigned_date!='0000-00-00 00:00:00' and tk.task_status=1 and tk.task_worker_id>0 and tk.user_id=us.user_id and us.user_id=up.user_id and tk.user_id='".$user_id."')  union 
		
		(select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'completetask' as act, tk.task_complete_date as activity_date, tk.task_worker_id as key_id, wrkus.profile_name as profile_user_url_name, wrkus.full_name as profile_user_name,  wrkup.profile_image as profile_user_image, (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from trc_worker cnwrk, trc_user cnus, trc_user_profile cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_worker_id) as custom_msg, 'custom_msg2' as custom_msg2  from trc_task tk, trc_worker wrk, trc_user wrkus, trc_user_profile wrkup where tk.task_worker_id=wrk.worker_id and wrk.user_id=wrkus.user_id and wrkus.user_id=wrkup.user_id and tk.task_complete_date!='0000-00-00 00:00:00'  and tk.worker_agree=1 and tk.task_status=1 and tk.user_id='".$user_id."')   union
		
		
		
		(select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'finishtask' as act, tk.task_close_date as activity_date, (select worker_level as msg from trc_user cnus left join trc_worker cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id='".$user_id."') as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name,  up.profile_image as profile_user_image , (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from trc_worker cnwrk, trc_user cnus, trc_user_profile cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_worker_id)  as custom_msg, 'custom_msg2' as custom_msg2 from trc_task tk, trc_user us, trc_user_profile up where tk.user_id=us.user_id and us.user_id=up.user_id and tk.task_close_date!='0000-00-00 00:00:00'  and  tk.poster_agree=1 and tk.task_status=1 and tk.user_id='".$user_id."')   union	
		
		
		
		 
		 (select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'newcomment' as act, cm.comment_date as activity_date, (select worker_level as msg from trc_user cnus left join trc_worker cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id=cm.comment_post_user_id) as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name,  up.profile_image as profile_user_image, (select CONCAT_WS(',',cnus.profile_name,cnus.first_name,cnus.last_name,cnup.profile_image,cnwrk.worker_level) as msg from trc_user cnus left join trc_user_profile cnup on cnus.user_id=cnup.user_id left join trc_worker cnwrk on cnus.user_id=cnwrk.user_id where cnus.user_id=tk.user_id) as custom_msg, cm.task_comment as custom_msg2  from trc_worker_comment cm, trc_user us, trc_user_profile up, trc_task tk where cm.task_id=tk.task_id and cm.comment_post_user_id=us.user_id and us.user_id= up.user_id and (cm.offer_amount=0 or cm.offer_amount=0.00) and cm.is_accept=0 and cm.is_public=1 and cm.comment_post_user_id='".$user_id."')  union 
		 
		  (select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'newreply' as act, cm.comment_date as activity_date, (select worker_level as msg from trc_user cnus left join trc_worker cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id=cm.comment_post_user_id) as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name,  up.profile_image as profile_user_image, (select CONCAT_WS(',',cnus.profile_name,cnus.first_name,cnus.last_name,cnup.profile_image,cnwrk.worker_level) as msg from trc_user cnus left join trc_user_profile cnup on cnus.user_id=cnup.user_id left join trc_worker cnwrk on cnus.user_id=cnwrk.user_id where cnus.user_id=tk.user_id) as custom_msg, cm.task_comment as custom_msg2  from trc_worker_comment cm, trc_user us, trc_user_profile up, trc_task tk where cm.task_id=tk.task_id and cm.comment_post_user_id=us.user_id and us.user_id= up.user_id and (cm.offer_amount=0 or cm.offer_amount=0.00) and cm.is_accept=0 and cm.is_public=1 and cm.comment_to_user_id='".$user_id."')   
		 
		 
		 
		 
		 
		 
		 
		 ) tbl order by activity_date desc limit ".$limit. " offset ".$offset);
	
	
	}
	
	
	
			if($query->num_rows()>0)
			{
				return $query->result();	
			}
			
			return 0;
			
	
	
	}
	
	
	
}
?>