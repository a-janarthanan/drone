<?php

class Site_setting_model extends CI_Model {
	
    function Site_setting_model()
    {
        parent::__construct();	
    }   
	
	
	/*** admin site setting update function
	* var integer $site_setting_id
	* var integer $site_online
	* var integer $captcha_enable
	* var string $site_name
	* var integer $site_version
	* var integer $site_language
	* var string $currency_code
	* var string $date_format
	* var string $time_format
	* var string $site_tracker
	* var text $how_it_works_video
	* var integer $zipcode_min
	* var integer $zipcode_max
	**/
	function site_setting_update()
	{
		$currency = $this->db->get_where('currency_code',array('currency_code'=>$this->input->post('currency_code')));
		$cur=$currency->row();
		$currency_symbol=$cur->currency_symbol;
		//echo $this->input->post('site_setting_id');
		//echo '<pre>'; print_r($_POST);
		
		
		
		
		$data = array(	
			'site_online' => $this->input->post('site_online'),
			'captcha_enable' => $this->input->post('captcha_enable'),		
			'site_name' => $this->input->post('site_name'),	
			'site_language' => $this->input->post('site_language'),	
			'currency_symbol' => $currency_symbol,
			'currency_code' => $this->input->post('currency_code'),
			'date_format' => $this->input->post('date_format'),	
			'time_format' => $this->input->post('time_format'),
			'date_time_format' => $this->input->post('date_time_format'),
			'site_tracker' => $this->input->post('site_tracker'),
			'how_it_works_video' => $this->input->post('how_it_works_video'),
			'zipcode_min' => $this->input->post('zipcode_min'),	
			'zipcode_max' => $this->input->post('zipcode_max'),		
			'site_timezone' => $this->input->post('site_timezone'),
			'default_longitude'=>trim($this->input->post('default_longitude')),
			'default_latitude'=>trim($this->input->post('default_latitude')),
			'google_map_key'=>trim($this->input->post('google_map_key')),
			'subscription_price'=>trim($this->input->post('subscription_price')),
			'subscription_time'=>trim($this->input->post('subscription_time')),
			'transection_need'=>trim($this->input->post('subscription_need')),
			'credit_need'=>trim($this->input->post('credit_need')),
			
		);
		//print_r($data);// die();
		
		$this->db->where('site_setting_id',$this->input->post('site_setting_id'));
		$this->db->update('site_setting',$data);
		
		
		
		
		/*$supported_cache=check_supported_cache_driver();
		
		if(isset($supported_cache))
		{
			if($supported_cache!='' && $supported_cache!='none')
			{
				////===load cache driver===
				$this->load->driver('cache');				
				
				$query = $this->db->get("site_setting");					
				$this->cache->$supported_cache->save('site_setting', $query->row(),CACHE_VALID_SEC);		
				
			}			
			
		}*/
		
		
		
		
		
		
		
	}
	
	/*** get image size setting details
	*  return single record array
	**/
	function get_one_img_setting()
	{
		$query = $this->db->get_where('image_setting');
		return $query->row();
	}
	
	/*** admin image size setting update function
	* var integer $p_width
	* var integer $p_height
	* var integer $u_width
	* var integer $u_height
	**/
	function img_setting_update()
	{
		$data = array(		
			'user_width' => $this->input->post('user_width'),	
			'user_height' => $this->input->post('user_height'),
			'category_width' => $this->input->post('category_width'),
			'category_height' => $this->input->post('category_height')
		);
		$this->db->where('image_setting_id',$this->input->post('image_setting_id'));
		$this->db->update('image_setting',$data);
	}
}
?>