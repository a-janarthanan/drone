<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	require_once(APPPATH.'helpers/language_helper'.EXT);
	require_once(APPPATH.'helpers/custom_helper'.EXT);
	
	
class  ROCKERS_Controller  extends  CI_Controller  {


	
    public function __construct()
	{
	
		// get the CI superobject
		$CI =& get_instance();
		parent::__construct();
		
		
		/***** check user online status*****/ 
		if(get_authenticateUserID()>0)
		{
			check_online_user();
		}
		
		
		/* google map setting **/
		
		$site_setting=site_setting();
		
		define('GOOGLE_MAP_KEY','');
		define('DEFAULT_CITY_LAT','');
		define('DEFAULT_CITY_LANG','');



		/***** language *****/
		
		$supported_language=get_supported_lang();
		$default_language=get_current_language();
			
		$default_folder=$supported_language[$default_language];
			
			
			// Whatever we decided the lang was, save it for next time to avoid working it out again
		   $lang = $_SESSION['lang_code'];
		   
		   
			// If no language has been worked out - or it is not supported - use the default
			if(empty($lang) or !in_array($lang, array_keys($supported_language)))
			{
				$lang = $default_language;
			}
			
			
			
			////////======check for $lang set====
			
			
			if(isset($lang))
			{
				if($lang!='')
				{
					$change_folder=$supported_language[$lang];
				}
			}
		
			
			
			////////======check for language folder exists====
			
			if(file_exists(base_path().SYSDIR.'/language/'.$change_folder))
			{
				if(file_exists(base_path().APPPATH.'/language/'.$change_folder))
				{
					
				}
				else
				{
					$change_folder=$default_folder;
					$_SESSION['lang_code'] = $default_language;
				}				
			}
			else
			{
				$change_folder=$default_folder;
				$_SESSION['lang_code'] = $default_language;
			}
			
			
			 $_SESSION['lang_folder'] = $change_folder;
			 
			 
			/////===lock front side language=======
				
			//$CI->config->set_item('language', $change_folder);			
			//echo $CI->config->item('language');	 
			
			
	       $this->lang->load('user',$_SESSION['lang_folder']); 
		 
		 
		 /***** language *****/
		 
		 
		    
	
      }
		
	
} 

// END MY_Controller class

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */