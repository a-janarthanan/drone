<?php
class User_model extends CI_Model 
{

	/*
	Function name :User_model
	Description :its default constuctor which called when user_model object initialzie.its load necesary parent constructor
	*/
	function User_model()
    {
        parent::__construct();	
    } 
	
	/*
	Function name :get_user_info()
	Parameter : $user_id(user id) 
	Return : array of user details
	Use : get user information
	*/
	
	
	function get_user_info($user_id)
	{
		$query=$this->db->get_where('user',array('user_id'=>$user_id));
		return $query->row();
	}
	
	
	/*
	Function name :get_user_profile_by_id()
	Parameter : $user_id(user id) 
	Return : array of user profile details
	Use : get user profile information
	*/
	
	
	
	function get_user_profile_by_id($user_id)
	{
		
		
		$query=$this->db->query("select * from ".$this->db->dbprefix('user')." usr, ".$this->db->dbprefix('user_profile')." pr where usr.user_id=pr.user_id and usr.user_id='".$user_id."' and (usr.user_status=1 or usr.user_status=3)");	
		
		
		return $query->row();
	}
	
	/*
	Function name :editemailTaken()
	Parameter : $email(user email address) 
	Return : boolean
	Use : check user unquie email address in the system
	*/

	function editemailTaken($email)
	{
	
		 $query = $this->db->query("select * from ".$this->db->dbprefix('user')." where user_id!='".get_authenticateUserID()."' and email='".$email."'");
		 
		 if($query->num_rows()>0)
		 {
			return true;
		 }
		 else 
		 {
			return false;
		 }		
	}
	
	/*
	Function name :edit_account()
	Parameter : none
	Return : integer 1
	Use : update user account
	*/
	
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
		
		
		
		
					
			
	$chk_url_exists=$this->db->query("select MAX(profile_name) as profile_name from ".$this->db->dbprefix('user')." where user_id!='".get_authenticateUserID()."' and profile_name like '".$profile_name."%'");
		
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
	
	/*
	Function name :change_password()
	Parameter : none
	Return : none
	Use : update user current password
	*/
	
	function change_password()
	{
		
		
		//echo $currentpassword;exit; 
		$data=array(
			'password'=>md5($this->input->post('password'))		
		);
		//echo "select * from ".$this->db->dbprefix('user')." where user_id='".get_authenticateUserID()."' and password='".$currentpassword."'";exit;
		$query = $this->db->query("select * from ".$this->db->dbprefix('user')." where user_id='".get_authenticateUserID()."' and password='".md5($this->input->post('current_password'))."'");
		 
		if($query->num_rows()>0)
		{
		//echo "found";exit;
		$this->db->where('user_id',get_authenticateUserID());		
		$this->db->update('user', $data);
		}
		else{
		$data['error']="Current Password not match";
		redirect('change_password');
		
		}
		
	
		
	}
	
	
	
	/*
	Function name :get_user_notification()
	Parameter : $user_id(user id)
	Return : array of user notification information
	Use : get user notification details
	*/
	
	function get_user_notification($user_id)
	{
		$query=$this->db->get_where('user_notification',array('user_id'=>$user_id));
		return $query->row();
	}	
	
	
	
	/*
	Function name :change_notification()
	Parameter : none
	Return : none
	Use : update user notification details
	*/
	
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
	
	
	/*
	Function name :check_user_profile_exists()
	Parameter : $profile_name (user seo friendly url name)
	Return : boolean
	Use : check user profile exists in the system 
	*/
	
	function check_user_profile_exists($profile_name)
	{
		
		
		
		$query=$this->db->query("select * from ".$this->db->dbprefix('user')." where profile_name='".$profile_name."' and (user_status=1 or user_status=3)");
		
		if($query->num_rows()>0)
		{
			return true;
		}
		else
		{
			return false;		
		}
		
	
	}
	
	
	/*
	Function name :get_user_profile()
	Parameter : $profile_name (user seo friendly url name)
	Return : array of user details
	Use : get user profile information
	*/
	
	function get_user_profile($profile_name)
	{
		
		$query=$this->db->query("select * from ".$this->db->dbprefix('user')." usr, ".$this->db->dbprefix('user_profile')." pr where usr.user_id=pr.user_id and usr.profile_name='".$profile_name."' and (usr.user_status=1 or usr.user_status=3)");		
		return $query->row();
	
	}
	
	
	/*
	Function name :make_favorite()
	Parameter : $user_id (user id)
	Return : none
	Use : add new favorite user
	*/
	
	
	function make_favorite($user_id)
	{
		
		$data=array(
		'my_user_id'=>get_authenticateUserID(),
		'favorite_user_id'=>$user_id,
		'favorite_date'=>date('Y-m-d H:i:s')				
		);
		
		$this->db->insert('user_favorite',$data);
		
	}
	
	/*
	Function name :un_favorite()
	Parameter : $user_id (user id)
	Return : none
	Use : remove favorite user
	*/
	
	function un_favorite($user_id)
	{
		
		$data=array(
		'my_user_id'=>get_authenticateUserID(),
		'favorite_user_id'=>$user_id		
		);
		
		$this->db->delete('user_favorite',$data);
		
	}
	
	
	/*
	Function name :update_profile()
	Parameter : none
	Return : none
	Use : update user profile information
	*/
	
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
	
	

	
	/*
	Function name :update_city()
	Parameter : $city_id(city id)
	Return : none
	Use : update user current city
	*/
	
	function update_city($city_id)
	{
		
		$data=array(
		'current_city'=>$city_id,
		'update_date'=>date('Y-m-d H:i:s')
		);
		$this->db->where('user_id',get_authenticateUserID());
		$this->db->update('user_profile',$data);
	}
	
	
	
	
	/*
	Function name :upload_photo()
	Parameter : none
	Return : none
	Use : update user profile photo
	*/
	
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
	
	
	/*
	Function name :upload_portfolio()
	Parameter : none
	Return : none
	Use : add user portfolio photo
	*/
	
	
	
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

	
	
	/*
	Function name :user_video()
	Parameter : none
	Return : none
	Use : add user portfolio video
	*/
	
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

	
	/*
	Function name :get_user_portfolio_video()
	Parameter : $user_id(user id)
	Return : array of user portfolio video
	Use : get user all portfolio videos
	*/
	
	
	function get_user_portfolio_video($user_id)
	{
		$query=$this->db->get_where('user_portfolio',array('user_id' => $user_id,'portfolio_video !=' => ''));
		
		if($query->num_rows()>0)
		{
			return $query->result();
		}
		
		return 0;
		
	}



	
	
	/*
	Function name :get_user_portfolio_photo()
	Parameter : $user_id(user id)
	Return : array of user portfolio photo
	Use : get user all portfolio photo
	*/
	
	function get_user_portfolio_photo($user_id)
	{
		$query=$this->db->get_where('user_portfolio',array('user_id' => $user_id,'portfolio_image !=' => ''));
		
		if($query->num_rows()>0)
		{
			return $query->result();
		}
		
		return 0;
		
	}
	
	
	/*
	Function name :get_portfolio_by_id()
	Parameter : $portfolio_id(portfolio id)
	Return : array of user portfolio photo detail
	Use : get user portfolio photo details
	*/
	
	function get_portfolio_by_id($portfolio_id)
	{
		$query=$this->db->get_where('user_portfolio',array('portfolio_id' =>$portfolio_id));
		
		if($query->num_rows()>0)
		{
			return $query->row();
		}
		
		return 0;
	
	}
	
	/*
	Function name :delete_portfolio()
	Parameter : none
	Return : none
	Use : delete user portfolio photo
	*/
	
	
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
	
	
	
	/*
	Function name :delete_video()
	Parameter : $portfolio_id(portfolio id)
	Return : none
	Use : delete user portfolio video
	*/
	
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


	
	
	/*
	Function name :get_user_location()
	Parameter : $user_id(user id)
	Return : array of user all location
	Use : get user all location list
	*/
	
	
	function get_user_location($user_id)
	{
		$query=$this->db->get_where('user_location',array('user_id'=>$user_id));
		
		if($query->num_rows()>0)
		{
			return $query->result();
		}
		
		return 0;
	}
	
	/*
	Function name :get_user_location_detail()
	Parameter : $user_location_id(user location id)
	Return : array of one location details
	Use : get user one location details
	*/
	
	function get_user_location_detail($user_location_id)
	{
		$query=$this->db->get_where('user_location',array('user_location_id'=>$user_location_id));
		
		if($query->num_rows()>0)
		{
			return $query->row();
		}
		
		return 0;
			
	}
	
	
	
	/*
	Function name :my_task()
	Parameter : $my_task_limit(for limit purpose)
	Return : array of user recent posted task
	Use : get user recent posted task list
	*/
	
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
	
	
	/*
	Function name :top_task()
	Parameter : $top_task_limit(for limit purpose)
	Return : array of top tasks
	Use : get top tasks list
	*/
	
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
		$query = $this->db->query("select * from ".$this->db->dbprefix('task')." tk, ".$this->db->dbprefix('user')." ur,".$this->db->dbprefix('user_profile')." up where tk.user_id = ur.user_id and ur.user_id = up.user_id and (tk.task_is_private=1 or tk.task_is_private=0) and tk.task_status = 1 and tk.task_activity_status > 0 ".$city_cond." order by tk.task_id desc limit ".$top_task_limit);
		}
		else
		{		
			$query = $this->db->query("select * from ".$this->db->dbprefix('task')." tk, ".$this->db->dbprefix('user')." ur, ".$this->db->dbprefix('user_profile')." up where tk.user_id = ur.user_id and ur.user_id = up.user_id and tk.task_status = 1 and tk.task_is_private=0 and tk.task_activity_status > 0 ".$city_cond." order by tk.task_id desc limit ".$top_task_limit);
		
		}	
		
		if($query->num_rows()>0)
		{
			return  $query->result();
		}

		return 0;
		
		
	}
	
	
	/*
	Function name :new_task()
	Parameter : $new_task_limit(for limit purpose)
	Return : array of newset tasks
	Use : get top newset list
	*/
	
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
		$query = $this->db->query("select * from ".$this->db->dbprefix('task')." tk, ".$this->db->dbprefix('user')." ur, ".$this->db->dbprefix('user_profile')." up where tk.user_id = ur.user_id and ur.user_id = up.user_id and (tk.task_is_private=1 or tk.task_is_private=0) and tk.task_status = 1 and DATE(tk.task_post_date)='".date('Y-m-d')."' and tk.task_activity_status >= 0 ".$city_cond." order by tk.task_id desc limit ".$new_task_limit);
		}
		else
		{		
			$query = $this->db->query("select * from ".$this->db->dbprefix('task')." tk, ".$this->db->dbprefix('user')." ur, ".$this->db->dbprefix('user_profile')." up where tk.user_id = ur.user_id and ur.user_id = up.user_id and tk.task_status = 1 and DATE(tk.task_post_date)='".date('Y-m-d')."' and tk.task_is_private=0 and tk.task_activity_status >= 0 ".$city_cond." order by tk.task_id desc limit ".$new_task_limit);
		
		}	
		
		
	
		if($query->num_rows()>0)
		{
			return  $query->result();
		}

		return 0;
		
		
	}
	
	
	
	/*
	Function name :get_map_city_task()
	Parameter : none
	Return : array of task list
	Use : get array list in the user current list which used on the uaser dashboard
	*/
	
	
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
		$query = $this->db->query("select * from ".$this->db->dbprefix('task')." tk, ".$this->db->dbprefix('user')." ur, ".$this->db->dbprefix('user_profile')." up where tk.user_id = ur.user_id and ur.user_id = up.user_id and (tk.task_is_private=1 or tk.task_is_private=0) and tk.task_status = 1  ".$city_cond." order by tk.task_id desc");
		}
		else
		{		
			$query = $this->db->query("select * from ".$this->db->dbprefix('task')." tk, ".$this->db->dbprefix('user')." ur, ".$this->db->dbprefix('user_profile')." up where tk.user_id = ur.user_id and ur.user_id = up.user_id and tk.task_status = 1 and tk.task_is_private=0  ".$city_cond." order by tk.task_id desc ");
		
		}	
		
		if($query->num_rows()>0)
		{
			return  $query->result();
		}

		return 0;
	}
	
	
	/*
	Function name :get_user_recent_reviews()
	Parameter : $user_id(user id), $reviews_limit(review limits)
	Return : array of user latest review
	Use : get list of user latest review 
	*/
	
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
	
	
	/*
	Function name :get_user_total_reviews()
	Parameter : $user_id(user id)
	Return : integer, count of all reviews
	Use : get total number of reivew
	*/
	
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
	
	
	/*
	Function name :get_user_all_reviews()
	Parameter : $user_id(user id), $limit(for paging), $offset(for paging)
	Return : array of user all reviews
	Use : get user all reviews
	*/
	
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
	
	
	
	
	/*
	Function name :get_user_recent_activities()
	Parameter : $user_id(user id), $activities_limit(for paging)
	Return : array of user all recent activities
	Use : get user all recent activities
	*/
	
	function get_user_recent_activities($user_id,$activities_limit)
	{
		
		$worker_id=0;
		
	
		$check_is_worker=$this->db->get_where('worker',array('user_id'=>$user_id,'worker_status'=>1));
			
			if($check_is_worker->num_rows()>0)
			{
				$worker_res=$check_is_worker->row();
				$worker_id=$worker_res->worker_id;
				
				
				
				
					$query=$this->db->query("select * from (  
		(select us.full_name as activity_name, 'activity_url_name' as activity_url_name, 'signup' as act, us.sign_up_date as activity_date,us.user_id as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name, up.profile_image as profile_user_image, (select worker_level as msg from ".$this->db->dbprefix('user')." cnus left join ".$this->db->dbprefix('worker')." cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id='".$user_id."')  as custom_msg, 'custom_msg2' as custom_msg2  from ".$this->db->dbprefix('user')." us, ".$this->db->dbprefix('user_profile')." up where us.user_id=up.user_id and us.user_id='".$user_id."') union 
			
		
		(select full_name as activity_name, 'activity_url_name' as activity_url_name, 'workersignup' as act, wrk.worker_date as activity_date,us.user_id as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name, up.profile_image as profile_user_image, (select worker_level as msg from ".$this->db->dbprefix('user')." cnus left join ".$this->db->dbprefix('worker')." cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id='".$user_id."') as custom_msg, 'custom_msg2' as custom_msg2  from ".$this->db->dbprefix('user')." us, ".$this->db->dbprefix('user_profile')." up, ".$this->db->dbprefix('worker')." wrk where us.user_id=up.user_id and wrk.user_id=us.user_id and us.user_id='".$user_id."') union 
		
		
		(select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'posttask' as act, tk.task_post_date as activity_date, (select worker_level as msg from ".$this->db->dbprefix('user')." cnus left join ".$this->db->dbprefix('worker')." cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id='".$user_id."') as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name,  up.profile_image as profile_user_image,  (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from ".$this->db->dbprefix('worker')." cnwrk, ".$this->db->dbprefix('user')." cnus, ".$this->db->dbprefix('user_profile')." cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_assing_worker) as custom_msg,  CONCAT_WS(',',tk.task_start_day,tk.task_start_time) as custom_msg2  from ".$this->db->dbprefix('task')." tk, ".$this->db->dbprefix('user')." us, ".$this->db->dbprefix('user_profile')." up where tk.user_id=us.user_id and us.user_id=up.user_id and tk.task_status=1 and tk.task_post_date!='0000-00-00 00:00:00' and tk.user_id='".$user_id."') union	
		
		
		(select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'workerposttask' as act, tk.task_post_date as activity_date, (select worker_level as msg from  ".$this->db->dbprefix('user')." cnus left join ".$this->db->dbprefix('worker')." cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id=tk.user_id) as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name,  up.profile_image as profile_user_image,  (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from ".$this->db->dbprefix('worker')." cnwrk, ".$this->db->dbprefix('user')." cnus, ".$this->db->dbprefix('user_profile')." cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_assing_worker) as custom_msg,  CONCAT_WS(',',tk.task_start_day,tk.task_start_time) as custom_msg2  from ".$this->db->dbprefix('task')." tk, ".$this->db->dbprefix('user')." us, ".$this->db->dbprefix('user_profile')." up where tk.user_id=us.user_id and us.user_id=up.user_id and tk.task_status=1 and tk.task_post_date!='0000-00-00 00:00:00' and tk.task_assing_worker='".$worker_id."') union	
		
		
		( select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'assigntask' as act, tk.task_assigned_date as activity_date, (select worker_level as msg from ".$this->db->dbprefix('user')." cnus left join ".$this->db->dbprefix('worker')." cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id='".$user_id."') as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name, up.profile_image as profile_user_image, (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from ".$this->db->dbprefix('worker')." cnwrk, ".$this->db->dbprefix('user')." cnus, ".$this->db->dbprefix('user_profile')." cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_worker_id)  as custom_msg, 'custom_msg2' as custom_msg2 from ".$this->db->dbprefix('task')." tk,  ".$this->db->dbprefix('user')." us, ".$this->db->dbprefix('user_profile')." up where tk.task_assigned_date!='0000-00-00 00:00:00' and tk.task_status=1 and tk.task_worker_id>0 and tk.user_id=us.user_id and us.user_id=up.user_id and tk.user_id='".$user_id."')  union 
		
			( select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'workerassigntask' as act, tk.task_assigned_date as activity_date, (select worker_level as msg from ".$this->db->dbprefix('user')." cnus left join ".$this->db->dbprefix('worker')." cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id=tk.user_id) as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name, up.profile_image as profile_user_image, (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from ".$this->db->dbprefix('worker')." cnwrk, ".$this->db->dbprefix('user')." cnus, ".$this->db->dbprefix('user_profile')." cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_worker_id)  as custom_msg, 'custom_msg2' as custom_msg2 from ".$this->db->dbprefix('task')." tk,  ".$this->db->dbprefix('user')." us, ".$this->db->dbprefix('user_profile')." up where tk.task_assigned_date!='0000-00-00 00:00:00' and tk.task_status=1 and tk.task_worker_id>0 and tk.user_id=us.user_id and us.user_id=up.user_id and tk.task_worker_id='".$worker_id."')  union 
			
			
		
		(select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'completetask' as act, tk.task_complete_date as activity_date, tk.task_worker_id as key_id, wrkus.profile_name as profile_user_url_name, wrkus.full_name as profile_user_name,  wrkup.profile_image as profile_user_image, (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from ".$this->db->dbprefix('worker')." cnwrk, ".$this->db->dbprefix('user')." cnus, ".$this->db->dbprefix('user_profile')." cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_worker_id) as custom_msg, 'custom_msg2' as custom_msg2  from ".$this->db->dbprefix('task')." tk, ".$this->db->dbprefix('worker')." wrk, ".$this->db->dbprefix('user')." wrkus, ".$this->db->dbprefix('user_profile')." wrkup where tk.task_worker_id=wrk.worker_id and wrk.user_id=wrkus.user_id and wrkus.user_id=wrkup.user_id and tk.task_complete_date!='0000-00-00 00:00:00'  and tk.worker_agree=1 and tk.task_status=1 and tk.user_id='".$user_id."')   union
		
		
		(select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'workercompletetask' as act, tk.task_complete_date as activity_date, tk.task_worker_id as key_id, wrkus.profile_name as profile_user_url_name, wrkus.full_name as profile_user_name,  wrkup.profile_image as profile_user_image, (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from ".$this->db->dbprefix('worker')." cnwrk, ".$this->db->dbprefix('user')." cnus,".$this->db->dbprefix('user_profile')." cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_worker_id) as custom_msg, 'custom_msg2' as custom_msg2  from ".$this->db->dbprefix('task')." tk, ".$this->db->dbprefix('worker')." wrk, ".$this->db->dbprefix('user')." wrkus, ".$this->db->dbprefix('user_profile')." wrkup where tk.task_worker_id=wrk.worker_id and wrk.user_id=wrkus.user_id and wrkus.user_id=wrkup.user_id and tk.task_complete_date!='0000-00-00 00:00:00'  and tk.worker_agree=1 and tk.task_status=1 and tk.task_worker_id='".$worker_id."')   union
		
		
		
		(select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'finishtask' as act, tk.task_close_date as activity_date, tk.task_worker_id as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name,  up.profile_image as profile_user_image , (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from ".$this->db->dbprefix('worker')." cnwrk, ".$this->db->dbprefix('user')." cnus, ".$this->db->dbprefix('user_profile')." cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_worker_id)  as custom_msg, 'custom_msg2' as custom_msg2 from ".$this->db->dbprefix('task')." tk, ".$this->db->dbprefix('user')." us, ".$this->db->dbprefix('user_profile')." up where tk.user_id=us.user_id and us.user_id=up.user_id and tk.task_close_date!='0000-00-00 00:00:00'  and  tk.poster_agree=1 and tk.task_status=1 and tk.user_id='".$user_id."')   union	
		
		
		(select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'workerfinishtask' as act, tk.task_close_date as activity_date, (select worker_level as msg from ".$this->db->dbprefix('user')." cnus left join ".$this->db->dbprefix('worker')." cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id=tk.user_id) as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name,  up.profile_image as profile_user_image , (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from ".$this->db->dbprefix('worker')." cnwrk, ".$this->db->dbprefix('user')." cnus, ".$this->db->dbprefix('user_profile')." cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_worker_id)  as custom_msg, 'custom_msg2' as custom_msg2 from ".$this->db->dbprefix('task')." tk, ".$this->db->dbprefix('user')." us, ".$this->db->dbprefix('user_profile')." up where tk.user_id=us.user_id and us.user_id=up.user_id and tk.task_close_date!='0000-00-00 00:00:00'  and  tk.poster_agree=1 and tk.task_status=1 and tk.task_worker_id='".$worker_id."')   union	
		
		
		
		 (select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'newcomment' as act, cm.comment_date as activity_date, (select worker_level as msg from ".$this->db->dbprefix('user')." cnus left join ".$this->db->dbprefix('worker')." cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id=cm.comment_post_user_id) as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name,  up.profile_image as profile_user_image, (select CONCAT_WS(',',cnus.profile_name,cnus.first_name,cnus.last_name,cnup.profile_image,cnwrk.worker_level) as msg from ".$this->db->dbprefix('user')." cnus left join ".$this->db->dbprefix('user_profile')." cnup on cnus.user_id=cnup.user_id left join ".$this->db->dbprefix('worker')." cnwrk on cnus.user_id=cnwrk.user_id where cnus.user_id=tk.user_id) as custom_msg, cm.task_comment as custom_msg2  from ".$this->db->dbprefix('worker_comment')." cm, ".$this->db->dbprefix('user')." us, ".$this->db->dbprefix('user_profile')." up, ".$this->db->dbprefix('task')." tk where cm.task_id=tk.task_id and cm.comment_post_user_id=us.user_id and us.user_id= up.user_id and (cm.offer_amount=0 or cm.offer_amount=0.00) and cm.is_accept=0 and cm.is_public=1 and cm.comment_post_user_id='".$user_id."')  union 
		 
		  (select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'newreply' as act, cm.comment_date as activity_date, (select worker_level as msg from ".$this->db->dbprefix('user')." cnus left join ".$this->db->dbprefix('worker')." cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id=cm.comment_post_user_id) as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name,  up.profile_image as profile_user_image, (select CONCAT_WS(',',cnus.profile_name,cnus.first_name,cnus.last_name,cnup.profile_image,cnwrk.worker_level) as msg from ".$this->db->dbprefix('user')." cnus left join ".$this->db->dbprefix('user_profile')." cnup on cnus.user_id=cnup.user_id left join ".$this->db->dbprefix('worker')." cnwrk on  cnus.user_id=cnwrk.user_id where cnus.user_id=tk.user_id) as custom_msg, cm.task_comment as custom_msg2  from ".$this->db->dbprefix('worker_comment')." cm, ".$this->db->dbprefix('user')." us, ".$this->db->dbprefix('user_profile')." up, ".$this->db->dbprefix('task')." tk where cm.task_id=tk.task_id and cm.comment_post_user_id=us.user_id and us.user_id= up.user_id and (cm.offer_amount=0 or cm.offer_amount=0.00) and cm.is_accept=0 and cm.is_public=1 and cm.comment_to_user_id='".$user_id."')   
		 
		 
		 
		 
		 
		 
		 ) tbl order by activity_date desc limit ".$activities_limit);
		 
		 
	
		 
		 
			}
		
		else {
	

	
		$query=$this->db->query("select * from (  
		(select us.full_name as activity_name, 'activity_url_name' as activity_url_name, 'signup' as act, us.sign_up_date as activity_date,us.user_id as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name, up.profile_image as profile_user_image, (select worker_level as msg from  ".$this->db->dbprefix('user')." cnus left join  ".$this->db->dbprefix('worker')." cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id='".$user_id."') as custom_msg, 'custom_msg2' as custom_msg2  from  ".$this->db->dbprefix('user')." us,  ".$this->db->dbprefix('user_profile')." up where us.user_id=up.user_id and us.user_id='".$user_id."') union 
		
		
		(select full_name as activity_name, 'activity_url_name' as activity_url_name, 'workersignup' as act, wrk.worker_date as activity_date,us.user_id as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name, up.profile_image as profile_user_image, (select worker_level as msg from  ".$this->db->dbprefix('user')." cnus left join  ".$this->db->dbprefix('worker')." cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id='".$user_id."') as custom_msg, 'custom_msg2' as custom_msg2  from  ".$this->db->dbprefix('user')." us,  ".$this->db->dbprefix('user_profile')." up,  ".$this->db->dbprefix('worker')." wrk where us.user_id=up.user_id and wrk.user_id=us.user_id and us.user_id='".$user_id."') union 
		
		(select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'posttask' as act, tk.task_post_date as activity_date, (select worker_level as msg from  ".$this->db->dbprefix('user')." cnus left join  ".$this->db->dbprefix('worker')." cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id='".$user_id."') as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name,  up.profile_image as profile_user_image,  (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from  ".$this->db->dbprefix('worker')." cnwrk,  ".$this->db->dbprefix('user')." cnus,  ".$this->db->dbprefix('user_profile')." cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_assing_worker) as custom_msg, CONCAT_WS(',',tk.task_start_day,tk.task_start_time) as custom_msg2  from  ".$this->db->dbprefix('task')." tk,  ".$this->db->dbprefix('user')." us,  ".$this->db->dbprefix('user_profile')." up where tk.user_id=us.user_id and us.user_id=up.user_id and tk.task_status=1 and tk.task_post_date!='0000-00-00 00:00:00' and tk.user_id='".$user_id."') union	
		
		
		( select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'assigntask' as act, tk.task_assigned_date as activity_date, (select worker_level as msg from  ".$this->db->dbprefix('user')." cnus left join  ".$this->db->dbprefix('worker')." cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id='".$user_id."') as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name, up.profile_image as profile_user_image, (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from  ".$this->db->dbprefix('worker')." cnwrk,  ".$this->db->dbprefix('user')." cnus,  ".$this->db->dbprefix('user_profile')." cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_worker_id)  as custom_msg, 'custom_msg2' as custom_msg2 from  ".$this->db->dbprefix('task')." tk,   ".$this->db->dbprefix('user')." us,  ".$this->db->dbprefix('user_profile')." up where tk.task_assigned_date!='0000-00-00 00:00:00' and tk.task_status=1 and tk.task_worker_id>0 and tk.user_id=us.user_id and us.user_id=up.user_id and tk.user_id='".$user_id."')  union 
		
		(select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'completetask' as act, tk.task_complete_date as activity_date, tk.task_worker_id as key_id, wrkus.profile_name as profile_user_url_name, wrkus.full_name as profile_user_name,  wrkup.profile_image as profile_user_image, (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from  ".$this->db->dbprefix('worker')." cnwrk,  ".$this->db->dbprefix('user')." cnus,  ".$this->db->dbprefix('user_profile')." cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_worker_id) as custom_msg, 'custom_msg2' as custom_msg2  from  ".$this->db->dbprefix('task')." tk,  ".$this->db->dbprefix('worker')." wrk,  ".$this->db->dbprefix('user')." wrkus,  ".$this->db->dbprefix('user_profile')." wrkup where tk.task_worker_id=wrk.worker_id and wrk.user_id=wrkus.user_id and wrkus.user_id=wrkup.user_id and tk.task_complete_date!='0000-00-00 00:00:00'  and tk.worker_agree=1 and tk.task_status=1 and tk.user_id='".$user_id."')   union
		
		
		
		(select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'finishtask' as act, tk.task_close_date as activity_date, (select worker_level as msg from  ".$this->db->dbprefix('user')." cnus left join  ".$this->db->dbprefix('worker')." cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id='".$user_id."') as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name,  up.profile_image as profile_user_image , (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from  ".$this->db->dbprefix('worker')." cnwrk,  ".$this->db->dbprefix('user')." cnus,  ".$this->db->dbprefix('user_profile')." cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_worker_id)  as custom_msg, 'custom_msg2' as custom_msg2 from  ".$this->db->dbprefix('task')." tk,  ".$this->db->dbprefix('user')." us,  ".$this->db->dbprefix('user_profile')." up where tk.user_id=us.user_id and us.user_id=up.user_id and tk.task_close_date!='0000-00-00 00:00:00'  and  tk.poster_agree=1 and tk.task_status=1 and tk.user_id='".$user_id."')   union	
		
		
		
		 (select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'newcomment' as act, cm.comment_date as activity_date, (select worker_level as msg from  ".$this->db->dbprefix('user')." cnus left join  ".$this->db->dbprefix('worker')." cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id=cm.comment_post_user_id) as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name,  up.profile_image as profile_user_image, (select CONCAT_WS(',',cnus.profile_name,cnus.first_name,cnus.last_name,cnup.profile_image,cnwrk.worker_level) as msg from  ".$this->db->dbprefix('user')." cnus left join  ".$this->db->dbprefix('user_profile')." cnup on cnus.user_id=cnup.user_id left join  ".$this->db->dbprefix('worker')." cnwrk on cnus.user_id=cnwrk.user_id where cnus.user_id=tk.user_id) as custom_msg, cm.task_comment as custom_msg2  from  ".$this->db->dbprefix('worker_comment')." cm,  ".$this->db->dbprefix('user')." us,  ".$this->db->dbprefix('user_profile')." up,  ".$this->db->dbprefix('task')." tk where cm.task_id=tk.task_id and cm.comment_post_user_id=us.user_id and us.user_id= up.user_id and (cm.offer_amount=0 or cm.offer_amount=0.00) and cm.is_accept=0 and cm.is_public=1 and cm.comment_post_user_id='".$user_id."')  union 
		 
		  (select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'newreply' as act, cm.comment_date as activity_date, (select worker_level as msg from  ".$this->db->dbprefix('user')." cnus left join  ".$this->db->dbprefix('worker')." cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id=cm.comment_post_user_id) as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name,  up.profile_image as profile_user_image, (select CONCAT_WS(',',cnus.profile_name,cnus.first_name,cnus.last_name,cnup.profile_image,cnwrk.worker_level) as msg from  ".$this->db->dbprefix('user')." cnus left join  ".$this->db->dbprefix('user_profile')." cnup on cnus.user_id=cnup.user_id left join  ".$this->db->dbprefix('worker')." cnwrk on cnus.user_id=cnwrk.user_id where cnus.user_id=tk.user_id) as custom_msg, cm.task_comment as custom_msg2  from  ".$this->db->dbprefix('worker_comment')." cm,  ".$this->db->dbprefix('user')." us,  ".$this->db->dbprefix('user_profile')." up,  ".$this->db->dbprefix('task')." tk where cm.task_id=tk.task_id and cm.comment_post_user_id=us.user_id and us.user_id= up.user_id and (cm.offer_amount=0 or cm.offer_amount=0.00) and cm.is_accept=0 and cm.is_public=1 and cm.comment_to_user_id='".$user_id."')   
		 
		 
		 
		 
		 
		 
		 ) tbl order by activity_date desc limit ".$activities_limit);
	
	
	}
	
	
	
	
			if($query->num_rows()>0)
			{
				return $query->result();	
			}
			
			return 0;
	
		
			
			
	
	}
	
	
	/*
	Function name :get_user_total_activities()
	Parameter : $user_id(user id)
	Return : integer, user total activities count
	Use : get user total number of activities
	*/
	
	function get_user_total_activities($user_id)
	{
	
	
		
		$worker_id=0;
		
		$check_is_worker=$this->db->get_where('worker',array('user_id'=>$user_id,'worker_status'=>1));
			
			if($check_is_worker->num_rows()>0)
			{
				$worker_res=$check_is_worker->row();
				$worker_id=$worker_res->worker_id;
				
				
				
				
					$query=$this->db->query("select * from (  
		(select us.full_name as activity_name, 'activity_url_name' as activity_url_name, 'signup' as act, us.sign_up_date as activity_date,us.user_id as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name, up.profile_image as profile_user_image, (select worker_level as msg from ".$this->db->dbprefix('user')." cnus left join ".$this->db->dbprefix('worker')." cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id='".$user_id."')  as custom_msg, 'custom_msg2' as custom_msg2  from ".$this->db->dbprefix('user')." us, ".$this->db->dbprefix('user_profile')." up where us.user_id=up.user_id and us.user_id='".$user_id."') union 
			
		
		(select full_name as activity_name, 'activity_url_name' as activity_url_name, 'workersignup' as act, wrk.worker_date as activity_date,us.user_id as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name, up.profile_image as profile_user_image, (select worker_level as msg from ".$this->db->dbprefix('user')." cnus left join ".$this->db->dbprefix('worker')." cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id='".$user_id."') as custom_msg, 'custom_msg2' as custom_msg2  from ".$this->db->dbprefix('user')." us, ".$this->db->dbprefix('user_profile')." up, ".$this->db->dbprefix('worker')." wrk where us.user_id=up.user_id and wrk.user_id=us.user_id and us.user_id='".$user_id."') union 
		
		
		(select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'posttask' as act, tk.task_post_date as activity_date, (select worker_level as msg from ".$this->db->dbprefix('user')." cnus left join ".$this->db->dbprefix('worker')." cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id='".$user_id."') as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name,  up.profile_image as profile_user_image,  (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from ".$this->db->dbprefix('worker')." cnwrk, ".$this->db->dbprefix('user')." cnus, ".$this->db->dbprefix('user_profile')." cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_assing_worker) as custom_msg,  CONCAT_WS(',',tk.task_start_day,tk.task_start_time) as custom_msg2  from ".$this->db->dbprefix('task')." tk, ".$this->db->dbprefix('user')." us, ".$this->db->dbprefix('user_profile')." up where tk.user_id=us.user_id and us.user_id=up.user_id and tk.task_status=1 and tk.task_post_date!='0000-00-00 00:00:00' and tk.user_id='".$user_id."') union	
		
		
		(select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'workerposttask' as act, tk.task_post_date as activity_date, (select worker_level as msg from  ".$this->db->dbprefix('user')." cnus left join ".$this->db->dbprefix('worker')." cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id=tk.user_id) as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name,  up.profile_image as profile_user_image,  (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from ".$this->db->dbprefix('worker')." cnwrk, ".$this->db->dbprefix('user')." cnus, ".$this->db->dbprefix('user_profile')." cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_assing_worker) as custom_msg,  CONCAT_WS(',',tk.task_start_day,tk.task_start_time) as custom_msg2  from ".$this->db->dbprefix('task')." tk, ".$this->db->dbprefix('user')." us, ".$this->db->dbprefix('user_profile')." up where tk.user_id=us.user_id and us.user_id=up.user_id and tk.task_status=1 and tk.task_post_date!='0000-00-00 00:00:00' and tk.task_assing_worker='".$worker_id."') union	
		
		
		( select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'assigntask' as act, tk.task_assigned_date as activity_date, (select worker_level as msg from ".$this->db->dbprefix('user')." cnus left join ".$this->db->dbprefix('worker')." cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id='".$user_id."') as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name, up.profile_image as profile_user_image, (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from ".$this->db->dbprefix('worker')." cnwrk, ".$this->db->dbprefix('user')." cnus, ".$this->db->dbprefix('user_profile')." cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_worker_id)  as custom_msg, 'custom_msg2' as custom_msg2 from ".$this->db->dbprefix('task')." tk,  ".$this->db->dbprefix('user')." us, ".$this->db->dbprefix('user_profile')." up where tk.task_assigned_date!='0000-00-00 00:00:00' and tk.task_status=1 and tk.task_worker_id>0 and tk.user_id=us.user_id and us.user_id=up.user_id and tk.user_id='".$user_id."')  union 
		
			( select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'workerassigntask' as act, tk.task_assigned_date as activity_date, (select worker_level as msg from ".$this->db->dbprefix('user')." cnus left join ".$this->db->dbprefix('worker')." cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id=tk.user_id) as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name, up.profile_image as profile_user_image, (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from ".$this->db->dbprefix('worker')." cnwrk, ".$this->db->dbprefix('user')." cnus, ".$this->db->dbprefix('user_profile')." cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_worker_id)  as custom_msg, 'custom_msg2' as custom_msg2 from ".$this->db->dbprefix('task')." tk,  ".$this->db->dbprefix('user')." us, ".$this->db->dbprefix('user_profile')." up where tk.task_assigned_date!='0000-00-00 00:00:00' and tk.task_status=1 and tk.task_worker_id>0 and tk.user_id=us.user_id and us.user_id=up.user_id and tk.task_worker_id='".$worker_id."')  union 
			
			
		
		(select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'completetask' as act, tk.task_complete_date as activity_date, tk.task_worker_id as key_id, wrkus.profile_name as profile_user_url_name, wrkus.full_name as profile_user_name,  wrkup.profile_image as profile_user_image, (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from ".$this->db->dbprefix('worker')." cnwrk, ".$this->db->dbprefix('user')." cnus, ".$this->db->dbprefix('user_profile')." cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_worker_id) as custom_msg, 'custom_msg2' as custom_msg2  from ".$this->db->dbprefix('task')." tk, ".$this->db->dbprefix('worker')." wrk, ".$this->db->dbprefix('user')." wrkus, ".$this->db->dbprefix('user_profile')." wrkup where tk.task_worker_id=wrk.worker_id and wrk.user_id=wrkus.user_id and wrkus.user_id=wrkup.user_id and tk.task_complete_date!='0000-00-00 00:00:00'  and tk.worker_agree=1 and tk.task_status=1 and tk.user_id='".$user_id."')   union
		
		
		(select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'workercompletetask' as act, tk.task_complete_date as activity_date, tk.task_worker_id as key_id, wrkus.profile_name as profile_user_url_name, wrkus.full_name as profile_user_name,  wrkup.profile_image as profile_user_image, (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from ".$this->db->dbprefix('worker')." cnwrk, ".$this->db->dbprefix('user')." cnus,".$this->db->dbprefix('user_profile')." cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_worker_id) as custom_msg, 'custom_msg2' as custom_msg2  from ".$this->db->dbprefix('task')." tk, ".$this->db->dbprefix('worker')." wrk, ".$this->db->dbprefix('user')." wrkus, ".$this->db->dbprefix('user_profile')." wrkup where tk.task_worker_id=wrk.worker_id and wrk.user_id=wrkus.user_id and wrkus.user_id=wrkup.user_id and tk.task_complete_date!='0000-00-00 00:00:00'  and tk.worker_agree=1 and tk.task_status=1 and tk.task_worker_id='".$worker_id."')   union
		
		
		
		(select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'finishtask' as act, tk.task_close_date as activity_date, tk.task_worker_id as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name,  up.profile_image as profile_user_image , (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from ".$this->db->dbprefix('worker')." cnwrk, ".$this->db->dbprefix('user')." cnus, ".$this->db->dbprefix('user_profile')." cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_worker_id)  as custom_msg, 'custom_msg2' as custom_msg2 from ".$this->db->dbprefix('task')." tk, ".$this->db->dbprefix('user')." us, ".$this->db->dbprefix('user_profile')." up where tk.user_id=us.user_id and us.user_id=up.user_id and tk.task_close_date!='0000-00-00 00:00:00'  and  tk.poster_agree=1 and tk.task_status=1 and tk.user_id='".$user_id."')   union	
		
		
		(select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'workerfinishtask' as act, tk.task_close_date as activity_date, (select worker_level as msg from ".$this->db->dbprefix('user')." cnus left join ".$this->db->dbprefix('worker')." cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id=tk.user_id) as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name,  up.profile_image as profile_user_image , (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from ".$this->db->dbprefix('worker')." cnwrk, ".$this->db->dbprefix('user')." cnus, ".$this->db->dbprefix('user_profile')." cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_worker_id)  as custom_msg, 'custom_msg2' as custom_msg2 from ".$this->db->dbprefix('task')." tk, ".$this->db->dbprefix('user')." us, ".$this->db->dbprefix('user_profile')." up where tk.user_id=us.user_id and us.user_id=up.user_id and tk.task_close_date!='0000-00-00 00:00:00'  and  tk.poster_agree=1 and tk.task_status=1 and tk.task_worker_id='".$worker_id."')   union	
		
		
		
		 (select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'newcomment' as act, cm.comment_date as activity_date, (select worker_level as msg from ".$this->db->dbprefix('user')." cnus left join ".$this->db->dbprefix('worker')." cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id=cm.comment_post_user_id) as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name,  up.profile_image as profile_user_image, (select CONCAT_WS(',',cnus.profile_name,cnus.first_name,cnus.last_name,cnup.profile_image,cnwrk.worker_level) as msg from ".$this->db->dbprefix('user')." cnus left join ".$this->db->dbprefix('user_profile')." cnup on cnus.user_id=cnup.user_id left join ".$this->db->dbprefix('worker')." cnwrk on cnus.user_id=cnwrk.user_id where cnus.user_id=tk.user_id) as custom_msg, cm.task_comment as custom_msg2  from ".$this->db->dbprefix('worker_comment')." cm, ".$this->db->dbprefix('user')." us, ".$this->db->dbprefix('user_profile')." up, ".$this->db->dbprefix('task')." tk where cm.task_id=tk.task_id and cm.comment_post_user_id=us.user_id and us.user_id= up.user_id and (cm.offer_amount=0 or cm.offer_amount=0.00) and cm.is_accept=0 and cm.is_public=1 and cm.comment_post_user_id='".$user_id."')  union 
		 
		  (select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'newreply' as act, cm.comment_date as activity_date, (select worker_level as msg from ".$this->db->dbprefix('user')." cnus left join ".$this->db->dbprefix('worker')." cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id=cm.comment_post_user_id) as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name,  up.profile_image as profile_user_image, (select CONCAT_WS(',',cnus.profile_name,cnus.first_name,cnus.last_name,cnup.profile_image,cnwrk.worker_level) as msg from ".$this->db->dbprefix('user')." cnus left join ".$this->db->dbprefix('user_profile')." cnup on cnus.user_id=cnup.user_id left join ".$this->db->dbprefix('worker')." cnwrk on  cnus.user_id=cnwrk.user_id where cnus.user_id=tk.user_id) as custom_msg, cm.task_comment as custom_msg2  from ".$this->db->dbprefix('worker_comment')." cm, ".$this->db->dbprefix('user')." us, ".$this->db->dbprefix('user_profile')." up, ".$this->db->dbprefix('task')." tk where cm.task_id=tk.task_id and cm.comment_post_user_id=us.user_id and us.user_id= up.user_id and (cm.offer_amount=0 or cm.offer_amount=0.00) and cm.is_accept=0 and cm.is_public=1 and cm.comment_to_user_id='".$user_id."')   
		 
		 
		 
		 
		 
		 
		 ) tbl order by activity_date desc");
		 
		 
	
		 
		 
			}
						
						else {
	

	
		$query=$this->db->query("select * from (  
		(select us.full_name as activity_name, 'activity_url_name' as activity_url_name, 'signup' as act, us.sign_up_date as activity_date,us.user_id as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name, up.profile_image as profile_user_image, (select worker_level as msg from  ".$this->db->dbprefix('user')." cnus left join  ".$this->db->dbprefix('worker')." cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id='".$user_id."') as custom_msg, 'custom_msg2' as custom_msg2  from  ".$this->db->dbprefix('user')." us,  ".$this->db->dbprefix('user_profile')." up where us.user_id=up.user_id and us.user_id='".$user_id."') union 
		
		
		(select full_name as activity_name, 'activity_url_name' as activity_url_name, 'workersignup' as act, wrk.worker_date as activity_date,us.user_id as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name, up.profile_image as profile_user_image, (select worker_level as msg from  ".$this->db->dbprefix('user')." cnus left join  ".$this->db->dbprefix('worker')." cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id='".$user_id."') as custom_msg, 'custom_msg2' as custom_msg2  from  ".$this->db->dbprefix('user')." us,  ".$this->db->dbprefix('user_profile')." up,  ".$this->db->dbprefix('worker')." wrk where us.user_id=up.user_id and wrk.user_id=us.user_id and us.user_id='".$user_id."') union 
		
		(select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'posttask' as act, tk.task_post_date as activity_date, (select worker_level as msg from  ".$this->db->dbprefix('user')." cnus left join  ".$this->db->dbprefix('worker')." cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id='".$user_id."') as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name,  up.profile_image as profile_user_image,  (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from  ".$this->db->dbprefix('worker')." cnwrk,  ".$this->db->dbprefix('user')." cnus,  ".$this->db->dbprefix('user_profile')." cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_assing_worker) as custom_msg, CONCAT_WS(',',tk.task_start_day,tk.task_start_time) as custom_msg2  from  ".$this->db->dbprefix('task')." tk,  ".$this->db->dbprefix('user')." us,  ".$this->db->dbprefix('user_profile')." up where tk.user_id=us.user_id and us.user_id=up.user_id and tk.task_status=1 and tk.task_post_date!='0000-00-00 00:00:00' and tk.user_id='".$user_id."') union	
		
		
		( select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'assigntask' as act, tk.task_assigned_date as activity_date, (select worker_level as msg from  ".$this->db->dbprefix('user')." cnus left join  ".$this->db->dbprefix('worker')." cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id='".$user_id."') as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name, up.profile_image as profile_user_image, (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from  ".$this->db->dbprefix('worker')." cnwrk,  ".$this->db->dbprefix('user')." cnus,  ".$this->db->dbprefix('user_profile')." cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_worker_id)  as custom_msg, 'custom_msg2' as custom_msg2 from  ".$this->db->dbprefix('task')." tk,   ".$this->db->dbprefix('user')." us,  ".$this->db->dbprefix('user_profile')." up where tk.task_assigned_date!='0000-00-00 00:00:00' and tk.task_status=1 and tk.task_worker_id>0 and tk.user_id=us.user_id and us.user_id=up.user_id and tk.user_id='".$user_id."')  union 
		
		(select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'completetask' as act, tk.task_complete_date as activity_date, tk.task_worker_id as key_id, wrkus.profile_name as profile_user_url_name, wrkus.full_name as profile_user_name,  wrkup.profile_image as profile_user_image, (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from  ".$this->db->dbprefix('worker')." cnwrk,  ".$this->db->dbprefix('user')." cnus,  ".$this->db->dbprefix('user_profile')." cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_worker_id) as custom_msg, 'custom_msg2' as custom_msg2  from  ".$this->db->dbprefix('task')." tk,  ".$this->db->dbprefix('worker')." wrk,  ".$this->db->dbprefix('user')." wrkus,  ".$this->db->dbprefix('user_profile')." wrkup where tk.task_worker_id=wrk.worker_id and wrk.user_id=wrkus.user_id and wrkus.user_id=wrkup.user_id and tk.task_complete_date!='0000-00-00 00:00:00'  and tk.worker_agree=1 and tk.task_status=1 and tk.user_id='".$user_id."')   union
		
		
		
		(select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'finishtask' as act, tk.task_close_date as activity_date, (select worker_level as msg from  ".$this->db->dbprefix('user')." cnus left join  ".$this->db->dbprefix('worker')." cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id='".$user_id."') as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name,  up.profile_image as profile_user_image , (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from  ".$this->db->dbprefix('worker')." cnwrk,  ".$this->db->dbprefix('user')." cnus,  ".$this->db->dbprefix('user_profile')." cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_worker_id)  as custom_msg, 'custom_msg2' as custom_msg2 from  ".$this->db->dbprefix('task')." tk,  ".$this->db->dbprefix('user')." us,  ".$this->db->dbprefix('user_profile')." up where tk.user_id=us.user_id and us.user_id=up.user_id and tk.task_close_date!='0000-00-00 00:00:00'  and  tk.poster_agree=1 and tk.task_status=1 and tk.user_id='".$user_id."')   union	
		
		
		
		 (select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'newcomment' as act, cm.comment_date as activity_date, (select worker_level as msg from  ".$this->db->dbprefix('user')." cnus left join  ".$this->db->dbprefix('worker')." cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id=cm.comment_post_user_id) as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name,  up.profile_image as profile_user_image, (select CONCAT_WS(',',cnus.profile_name,cnus.first_name,cnus.last_name,cnup.profile_image,cnwrk.worker_level) as msg from  ".$this->db->dbprefix('user')." cnus left join  ".$this->db->dbprefix('user_profile')." cnup on cnus.user_id=cnup.user_id left join  ".$this->db->dbprefix('worker')." cnwrk on cnus.user_id=cnwrk.user_id where cnus.user_id=tk.user_id) as custom_msg, cm.task_comment as custom_msg2  from  ".$this->db->dbprefix('worker_comment')." cm,  ".$this->db->dbprefix('user')." us,  ".$this->db->dbprefix('user_profile')." up,  ".$this->db->dbprefix('task')." tk where cm.task_id=tk.task_id and cm.comment_post_user_id=us.user_id and us.user_id= up.user_id and (cm.offer_amount=0 or cm.offer_amount=0.00) and cm.is_accept=0 and cm.is_public=1 and cm.comment_post_user_id='".$user_id."')  union 
		 
		  (select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'newreply' as act, cm.comment_date as activity_date, (select worker_level as msg from  ".$this->db->dbprefix('user')." cnus left join  ".$this->db->dbprefix('worker')." cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id=cm.comment_post_user_id) as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name,  up.profile_image as profile_user_image, (select CONCAT_WS(',',cnus.profile_name,cnus.first_name,cnus.last_name,cnup.profile_image,cnwrk.worker_level) as msg from  ".$this->db->dbprefix('user')." cnus left join  ".$this->db->dbprefix('user_profile')." cnup on cnus.user_id=cnup.user_id left join  ".$this->db->dbprefix('worker')." cnwrk on cnus.user_id=cnwrk.user_id where cnus.user_id=tk.user_id) as custom_msg, cm.task_comment as custom_msg2  from  ".$this->db->dbprefix('worker_comment')." cm,  ".$this->db->dbprefix('user')." us,  ".$this->db->dbprefix('user_profile')." up,  ".$this->db->dbprefix('task')." tk where cm.task_id=tk.task_id and cm.comment_post_user_id=us.user_id and us.user_id= up.user_id and (cm.offer_amount=0 or cm.offer_amount=0.00) and cm.is_accept=0 and cm.is_public=1 and cm.comment_to_user_id='".$user_id."')   
		 
		 
		 
		 
		 
		 
		 ) tbl order by activity_date desc");
	
	
	}
					
					
					
								return $query->num_rows();	
					
	}
	
	
	/*
	Function name :get_user_all_activities()
	Parameter : $user_id(user id), $limit(for paging), $offset(for paging)
	Return : array, user all activities records
	Use : get user all activities records
	*/
	
	function get_user_all_activities($user_id,$limit,$offset)
	{
	
		
		
		$worker_id=0;
		
		$check_is_worker=$this->db->get_where('worker',array('user_id'=>$user_id,'worker_status'=>1));
			
			if($check_is_worker->num_rows()>0)
			{
				
		 
		 
		 
		 
				$worker_res=$check_is_worker->row();
				$worker_id=$worker_res->worker_id;
				
				
				
				
					$query=$this->db->query("select * from (  
		(select us.full_name as activity_name, 'activity_url_name' as activity_url_name, 'signup' as act, us.sign_up_date as activity_date,us.user_id as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name, up.profile_image as profile_user_image, (select worker_level as msg from ".$this->db->dbprefix('user')." cnus left join ".$this->db->dbprefix('worker')." cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id='".$user_id."')  as custom_msg, 'custom_msg2' as custom_msg2  from ".$this->db->dbprefix('user')." us, ".$this->db->dbprefix('user_profile')." up where us.user_id=up.user_id and us.user_id='".$user_id."') union 
			
		
		(select full_name as activity_name, 'activity_url_name' as activity_url_name, 'workersignup' as act, wrk.worker_date as activity_date,us.user_id as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name, up.profile_image as profile_user_image, (select worker_level as msg from ".$this->db->dbprefix('user')." cnus left join ".$this->db->dbprefix('worker')." cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id='".$user_id."') as custom_msg, 'custom_msg2' as custom_msg2  from ".$this->db->dbprefix('user')." us, ".$this->db->dbprefix('user_profile')." up, ".$this->db->dbprefix('worker')." wrk where us.user_id=up.user_id and wrk.user_id=us.user_id and us.user_id='".$user_id."') union 
		
		
		(select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'posttask' as act, tk.task_post_date as activity_date, (select worker_level as msg from ".$this->db->dbprefix('user')." cnus left join ".$this->db->dbprefix('worker')." cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id='".$user_id."') as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name,  up.profile_image as profile_user_image,  (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from ".$this->db->dbprefix('worker')." cnwrk, ".$this->db->dbprefix('user')." cnus, ".$this->db->dbprefix('user_profile')." cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_assing_worker) as custom_msg,  CONCAT_WS(',',tk.task_start_day,tk.task_start_time) as custom_msg2  from ".$this->db->dbprefix('task')." tk, ".$this->db->dbprefix('user')." us, ".$this->db->dbprefix('user_profile')." up where tk.user_id=us.user_id and us.user_id=up.user_id and tk.task_status=1 and tk.task_post_date!='0000-00-00 00:00:00' and tk.user_id='".$user_id."') union	
		
		
		(select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'workerposttask' as act, tk.task_post_date as activity_date, (select worker_level as msg from  ".$this->db->dbprefix('user')." cnus left join ".$this->db->dbprefix('worker')." cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id=tk.user_id) as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name,  up.profile_image as profile_user_image,  (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from ".$this->db->dbprefix('worker')." cnwrk, ".$this->db->dbprefix('user')." cnus, ".$this->db->dbprefix('user_profile')." cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_assing_worker) as custom_msg,  CONCAT_WS(',',tk.task_start_day,tk.task_start_time) as custom_msg2  from ".$this->db->dbprefix('task')." tk, ".$this->db->dbprefix('user')." us, ".$this->db->dbprefix('user_profile')." up where tk.user_id=us.user_id and us.user_id=up.user_id and tk.task_status=1 and tk.task_post_date!='0000-00-00 00:00:00' and tk.task_assing_worker='".$worker_id."') union	
		
		
		( select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'assigntask' as act, tk.task_assigned_date as activity_date, (select worker_level as msg from ".$this->db->dbprefix('user')." cnus left join ".$this->db->dbprefix('worker')." cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id='".$user_id."') as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name, up.profile_image as profile_user_image, (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from ".$this->db->dbprefix('worker')." cnwrk, ".$this->db->dbprefix('user')." cnus, ".$this->db->dbprefix('user_profile')." cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_worker_id)  as custom_msg, 'custom_msg2' as custom_msg2 from ".$this->db->dbprefix('task')." tk,  ".$this->db->dbprefix('user')." us, ".$this->db->dbprefix('user_profile')." up where tk.task_assigned_date!='0000-00-00 00:00:00' and tk.task_status=1 and tk.task_worker_id>0 and tk.user_id=us.user_id and us.user_id=up.user_id and tk.user_id='".$user_id."')  union 
		
			( select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'workerassigntask' as act, tk.task_assigned_date as activity_date, (select worker_level as msg from ".$this->db->dbprefix('user')." cnus left join ".$this->db->dbprefix('worker')." cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id=tk.user_id) as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name, up.profile_image as profile_user_image, (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from ".$this->db->dbprefix('worker')." cnwrk, ".$this->db->dbprefix('user')." cnus, ".$this->db->dbprefix('user_profile')." cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_worker_id)  as custom_msg, 'custom_msg2' as custom_msg2 from ".$this->db->dbprefix('task')." tk,  ".$this->db->dbprefix('user')." us, ".$this->db->dbprefix('user_profile')." up where tk.task_assigned_date!='0000-00-00 00:00:00' and tk.task_status=1 and tk.task_worker_id>0 and tk.user_id=us.user_id and us.user_id=up.user_id and tk.task_worker_id='".$worker_id."')  union 
			
			
		
		(select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'completetask' as act, tk.task_complete_date as activity_date, tk.task_worker_id as key_id, wrkus.profile_name as profile_user_url_name, wrkus.full_name as profile_user_name,  wrkup.profile_image as profile_user_image, (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from ".$this->db->dbprefix('worker')." cnwrk, ".$this->db->dbprefix('user')." cnus, ".$this->db->dbprefix('user_profile')." cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_worker_id) as custom_msg, 'custom_msg2' as custom_msg2  from ".$this->db->dbprefix('task')." tk, ".$this->db->dbprefix('worker')." wrk, ".$this->db->dbprefix('user')." wrkus, ".$this->db->dbprefix('user_profile')." wrkup where tk.task_worker_id=wrk.worker_id and wrk.user_id=wrkus.user_id and wrkus.user_id=wrkup.user_id and tk.task_complete_date!='0000-00-00 00:00:00'  and tk.worker_agree=1 and tk.task_status=1 and tk.user_id='".$user_id."')   union
		
		
		(select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'workercompletetask' as act, tk.task_complete_date as activity_date, tk.task_worker_id as key_id, wrkus.profile_name as profile_user_url_name, wrkus.full_name as profile_user_name,  wrkup.profile_image as profile_user_image, (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from ".$this->db->dbprefix('worker')." cnwrk, ".$this->db->dbprefix('user')." cnus,".$this->db->dbprefix('user_profile')." cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_worker_id) as custom_msg, 'custom_msg2' as custom_msg2  from ".$this->db->dbprefix('task')." tk, ".$this->db->dbprefix('worker')." wrk, ".$this->db->dbprefix('user')." wrkus, ".$this->db->dbprefix('user_profile')." wrkup where tk.task_worker_id=wrk.worker_id and wrk.user_id=wrkus.user_id and wrkus.user_id=wrkup.user_id and tk.task_complete_date!='0000-00-00 00:00:00'  and tk.worker_agree=1 and tk.task_status=1 and tk.task_worker_id='".$worker_id."')   union
		
		
		
		(select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'finishtask' as act, tk.task_close_date as activity_date, tk.task_worker_id as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name,  up.profile_image as profile_user_image , (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from ".$this->db->dbprefix('worker')." cnwrk, ".$this->db->dbprefix('user')." cnus, ".$this->db->dbprefix('user_profile')." cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_worker_id)  as custom_msg, 'custom_msg2' as custom_msg2 from ".$this->db->dbprefix('task')." tk, ".$this->db->dbprefix('user')." us, ".$this->db->dbprefix('user_profile')." up where tk.user_id=us.user_id and us.user_id=up.user_id and tk.task_close_date!='0000-00-00 00:00:00'  and  tk.poster_agree=1 and tk.task_status=1 and tk.user_id='".$user_id."')   union	
		
		
		(select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'workerfinishtask' as act, tk.task_close_date as activity_date, (select worker_level as msg from ".$this->db->dbprefix('user')." cnus left join ".$this->db->dbprefix('worker')." cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id=tk.user_id) as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name,  up.profile_image as profile_user_image , (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from ".$this->db->dbprefix('worker')." cnwrk, ".$this->db->dbprefix('user')." cnus, ".$this->db->dbprefix('user_profile')." cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_worker_id)  as custom_msg, 'custom_msg2' as custom_msg2 from ".$this->db->dbprefix('task')." tk, ".$this->db->dbprefix('user')." us, ".$this->db->dbprefix('user_profile')." up where tk.user_id=us.user_id and us.user_id=up.user_id and tk.task_close_date!='0000-00-00 00:00:00'  and  tk.poster_agree=1 and tk.task_status=1 and tk.task_worker_id='".$worker_id."')   union	
		
		
		
		 (select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'newcomment' as act, cm.comment_date as activity_date, (select worker_level as msg from ".$this->db->dbprefix('user')." cnus left join ".$this->db->dbprefix('worker')." cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id=cm.comment_post_user_id) as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name,  up.profile_image as profile_user_image, (select CONCAT_WS(',',cnus.profile_name,cnus.first_name,cnus.last_name,cnup.profile_image,cnwrk.worker_level) as msg from ".$this->db->dbprefix('user')." cnus left join ".$this->db->dbprefix('user_profile')." cnup on cnus.user_id=cnup.user_id left join ".$this->db->dbprefix('worker')." cnwrk on cnus.user_id=cnwrk.user_id where cnus.user_id=tk.user_id) as custom_msg, cm.task_comment as custom_msg2  from ".$this->db->dbprefix('worker_comment')." cm, ".$this->db->dbprefix('user')." us, ".$this->db->dbprefix('user_profile')." up, ".$this->db->dbprefix('task')." tk where cm.task_id=tk.task_id and cm.comment_post_user_id=us.user_id and us.user_id= up.user_id and (cm.offer_amount=0 or cm.offer_amount=0.00) and cm.is_accept=0 and cm.is_public=1 and cm.comment_post_user_id='".$user_id."')  union 
		 
		  (select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'newreply' as act, cm.comment_date as activity_date, (select worker_level as msg from ".$this->db->dbprefix('user')." cnus left join ".$this->db->dbprefix('worker')." cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id=cm.comment_post_user_id) as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name,  up.profile_image as profile_user_image, (select CONCAT_WS(',',cnus.profile_name,cnus.first_name,cnus.last_name,cnup.profile_image,cnwrk.worker_level) as msg from ".$this->db->dbprefix('user')." cnus left join ".$this->db->dbprefix('user_profile')." cnup on cnus.user_id=cnup.user_id left join ".$this->db->dbprefix('worker')." cnwrk on  cnus.user_id=cnwrk.user_id where cnus.user_id=tk.user_id) as custom_msg, cm.task_comment as custom_msg2  from ".$this->db->dbprefix('worker_comment')." cm, ".$this->db->dbprefix('user')." us, ".$this->db->dbprefix('user_profile')." up, ".$this->db->dbprefix('task')." tk where cm.task_id=tk.task_id and cm.comment_post_user_id=us.user_id and us.user_id= up.user_id and (cm.offer_amount=0 or cm.offer_amount=0.00) and cm.is_accept=0 and cm.is_public=1 and cm.comment_to_user_id='".$user_id."')   
		 
		 
		 
		 
		 
		 
		 ) tbl order by activity_date desc limit ".$limit. " offset ".$offset);
		 
		 
	
		 
		 
			
			
			
			
			
			
			
			
		 
			}
		
		else {
	

	
		$query=$this->db->query("select * from (  
		(select us.full_name as activity_name, 'activity_url_name' as activity_url_name, 'signup' as act, us.sign_up_date as activity_date,us.user_id as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name, up.profile_image as profile_user_image, (select worker_level as msg from  ".$this->db->dbprefix('user')." cnus left join  ".$this->db->dbprefix('worker')." cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id='".$user_id."') as custom_msg, 'custom_msg2' as custom_msg2  from  ".$this->db->dbprefix('user')." us,  ".$this->db->dbprefix('user_profile')." up where us.user_id=up.user_id and us.user_id='".$user_id."') union 
		
		
		(select full_name as activity_name, 'activity_url_name' as activity_url_name, 'workersignup' as act, wrk.worker_date as activity_date,us.user_id as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name, up.profile_image as profile_user_image, (select worker_level as msg from  ".$this->db->dbprefix('user')." cnus left join  ".$this->db->dbprefix('worker')." cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id='".$user_id."') as custom_msg, 'custom_msg2' as custom_msg2  from  ".$this->db->dbprefix('user')." us,  ".$this->db->dbprefix('user_profile')." up,  ".$this->db->dbprefix('worker')." wrk where us.user_id=up.user_id and wrk.user_id=us.user_id and us.user_id='".$user_id."') union 
		
		(select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'posttask' as act, tk.task_post_date as activity_date, (select worker_level as msg from  ".$this->db->dbprefix('user')." cnus left join  ".$this->db->dbprefix('worker')." cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id='".$user_id."') as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name,  up.profile_image as profile_user_image,  (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from  ".$this->db->dbprefix('worker')." cnwrk,  ".$this->db->dbprefix('user')." cnus,  ".$this->db->dbprefix('user_profile')." cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_assing_worker) as custom_msg, CONCAT_WS(',',tk.task_start_day,tk.task_start_time) as custom_msg2  from  ".$this->db->dbprefix('task')." tk,  ".$this->db->dbprefix('user')." us,  ".$this->db->dbprefix('user_profile')." up where tk.user_id=us.user_id and us.user_id=up.user_id and tk.task_status=1 and tk.task_post_date!='0000-00-00 00:00:00' and tk.user_id='".$user_id."') union	
		
		
		( select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'assigntask' as act, tk.task_assigned_date as activity_date, (select worker_level as msg from  ".$this->db->dbprefix('user')." cnus left join  ".$this->db->dbprefix('worker')." cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id='".$user_id."') as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name, up.profile_image as profile_user_image, (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from  ".$this->db->dbprefix('worker')." cnwrk,  ".$this->db->dbprefix('user')." cnus,  ".$this->db->dbprefix('user_profile')." cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_worker_id)  as custom_msg, 'custom_msg2' as custom_msg2 from  ".$this->db->dbprefix('task')." tk,   ".$this->db->dbprefix('user')." us,  ".$this->db->dbprefix('user_profile')." up where tk.task_assigned_date!='0000-00-00 00:00:00' and tk.task_status=1 and tk.task_worker_id>0 and tk.user_id=us.user_id and us.user_id=up.user_id and tk.user_id='".$user_id."')  union 
		
		(select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'completetask' as act, tk.task_complete_date as activity_date, tk.task_worker_id as key_id, wrkus.profile_name as profile_user_url_name, wrkus.full_name as profile_user_name,  wrkup.profile_image as profile_user_image, (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from  ".$this->db->dbprefix('worker')." cnwrk,  ".$this->db->dbprefix('user')." cnus,  ".$this->db->dbprefix('user_profile')." cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_worker_id) as custom_msg, 'custom_msg2' as custom_msg2  from  ".$this->db->dbprefix('task')." tk,  ".$this->db->dbprefix('worker')." wrk,  ".$this->db->dbprefix('user')." wrkus,  ".$this->db->dbprefix('user_profile')." wrkup where tk.task_worker_id=wrk.worker_id and wrk.user_id=wrkus.user_id and wrkus.user_id=wrkup.user_id and tk.task_complete_date!='0000-00-00 00:00:00'  and tk.worker_agree=1 and tk.task_status=1 and tk.user_id='".$user_id."')   union
		
		
		
		(select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'finishtask' as act, tk.task_close_date as activity_date, (select worker_level as msg from  ".$this->db->dbprefix('user')." cnus left join  ".$this->db->dbprefix('worker')." cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id='".$user_id."') as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name,  up.profile_image as profile_user_image , (select CONCAT_WS(',',profile_name,first_name,last_name,profile_image,worker_level) as msg from  ".$this->db->dbprefix('worker')." cnwrk,  ".$this->db->dbprefix('user')." cnus,  ".$this->db->dbprefix('user_profile')." cnup where cnwrk.user_id=cnus.user_id and cnus.user_id=cnup.user_id and  cnwrk.worker_id=tk.task_worker_id)  as custom_msg, 'custom_msg2' as custom_msg2 from  ".$this->db->dbprefix('task')." tk,  ".$this->db->dbprefix('user')." us,  ".$this->db->dbprefix('user_profile')." up where tk.user_id=us.user_id and us.user_id=up.user_id and tk.task_close_date!='0000-00-00 00:00:00'  and  tk.poster_agree=1 and tk.task_status=1 and tk.user_id='".$user_id."')   union	
		
		
		
		 (select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'newcomment' as act, cm.comment_date as activity_date, (select worker_level as msg from  ".$this->db->dbprefix('user')." cnus left join  ".$this->db->dbprefix('worker')." cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id=cm.comment_post_user_id) as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name,  up.profile_image as profile_user_image, (select CONCAT_WS(',',cnus.profile_name,cnus.first_name,cnus.last_name,cnup.profile_image,cnwrk.worker_level) as msg from  ".$this->db->dbprefix('user')." cnus left join  ".$this->db->dbprefix('user_profile')." cnup on cnus.user_id=cnup.user_id left join  ".$this->db->dbprefix('worker')." cnwrk on cnus.user_id=cnwrk.user_id where cnus.user_id=tk.user_id) as custom_msg, cm.task_comment as custom_msg2  from  ".$this->db->dbprefix('worker_comment')." cm,  ".$this->db->dbprefix('user')." us,  ".$this->db->dbprefix('user_profile')." up,  ".$this->db->dbprefix('task')." tk where cm.task_id=tk.task_id and cm.comment_post_user_id=us.user_id and us.user_id= up.user_id and (cm.offer_amount=0 or cm.offer_amount=0.00) and cm.is_accept=0 and cm.is_public=1 and cm.comment_post_user_id='".$user_id."')  union 
		 
		  (select tk.task_name as activity_name, tk.task_url_name as activity_url_name, 'newreply' as act, cm.comment_date as activity_date, (select worker_level as msg from  ".$this->db->dbprefix('user')." cnus left join  ".$this->db->dbprefix('worker')." cnwrk on cnwrk.user_id=cnus.user_id where cnus.user_id=cm.comment_post_user_id) as key_id, us.profile_name as profile_user_url_name, us.full_name as profile_user_name,  up.profile_image as profile_user_image, (select CONCAT_WS(',',cnus.profile_name,cnus.first_name,cnus.last_name,cnup.profile_image,cnwrk.worker_level) as msg from  ".$this->db->dbprefix('user')." cnus left join  ".$this->db->dbprefix('user_profile')." cnup on cnus.user_id=cnup.user_id left join  ".$this->db->dbprefix('worker')." cnwrk on cnus.user_id=cnwrk.user_id where cnus.user_id=tk.user_id) as custom_msg, cm.task_comment as custom_msg2  from  ".$this->db->dbprefix('worker_comment')." cm,  ".$this->db->dbprefix('user')." us,  ".$this->db->dbprefix('user_profile')." up,  ".$this->db->dbprefix('task')." tk where cm.task_id=tk.task_id and cm.comment_post_user_id=us.user_id and us.user_id= up.user_id and (cm.offer_amount=0 or cm.offer_amount=0.00) and cm.is_accept=0 and cm.is_public=1 and cm.comment_to_user_id='".$user_id."')   
		 
		 
		 
		 
		 
		 
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