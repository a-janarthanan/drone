<?php

class Twitter_setting_model extends CI_Model {
	
    function Twitter_setting_model()
    {
        parent::__construct();	
    }   
	
	/** admin twitter setting update function
	* var integer $twitter_setting_id
	* var integer $twitter_login_enable
	* var string $consumer_key
	* var string $consumer_secret
	* var string $twitter_url
	**/
	function twitter_setting_update()
	{
		$data = array(			
			'twitter_login_enable' => $this->input->post('twitter_login_enable'),
			'consumer_key' => $this->input->post('consumer_key'),
			'consumer_secret' => $this->input->post('consumer_secret'),
			'twitter_url' => $this->input->post('twitter_url'),
		);
		$this->db->where('twitter_setting_id',$this->input->post('twitter_setting_id'));
		$this->db->update('twitter_setting',$data);
	}
	
	/*** get twitter setting details
	*  return single record array
	**/
	function get_one_twitter_setting()
	{
		$query = $this->db->get_where('twitter_setting');
		return $query->row();
	}
}
?>