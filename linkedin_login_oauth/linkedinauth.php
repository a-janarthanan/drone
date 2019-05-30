<?php
    session_start();
    //include("../includes/config.php"); //// Load site configurations
    require_once('oAuth/config.php');
    require_once('oAuth/linkedinoAuth.php');
    require_once('oAuth/class.linkedClass.php');
    
   // echo $_REQUEST['oauth_verifier'];die;
    $linkedClass   =   new linkedClass();
    
	# First step is to initialize with your consumer key and secret. We'll use an out-of-band oauth_callback
    $linkedin = new LinkedIn($config['linkedin_access'], $config['linkedin_secret']);
    

	if (isset($_REQUEST['oauth_verifier']))
	{
        $_SESSION['oauth_verifier']     = $_REQUEST['oauth_verifier'];

        $linkedin->request_token    =   unserialize($_SESSION['requestToken']);
        $linkedin->oauth_verifier   =   $_SESSION['oauth_verifier'];
        $linkedin->getAccessToken($_REQUEST['oauth_verifier']);
        $_SESSION['oauth_access_token'] = serialize($linkedin->access_token);
	}
   else
   {
        $linkedin->request_token    =   unserialize($_SESSION['requestToken']);
        $linkedin->oauth_verifier   =   $_SESSION['oauth_verifier'];
        $linkedin->access_token     =   unserialize($_SESSION['oauth_access_token']);
   }
   
   $content1 = $linkedClass->linkedinGetUserInfo($_SESSION['requestToken'], $_SESSION['oauth_verifier'], $_SESSION['oauth_access_token']);

    $xml   = simplexml_load_string($content1);
    $array = XML2Array($xml);
    $content = array($xml->getName() => $array);
	$jsn_content = json_encode($content);
//	echo "<pre>";
//    print_r($content);	
//	die();
	header('location: http://www.activainfosolution.com/entowork/index.php/linkedin_signup/'.$jsn_content);
 
//	$get = $content['person']['picture-url'];
//	$promo_img='';
//	if($get!="")
//	{
//		//$promo_img=time().'linkdedin.jpg';
//		//$DIR_DOC = $_SERVER['DOCUMENT_ROOT']."/lab4/carpedu/images/".$promo_img;
//		//$DIR_DOC1 = $_SERVER['DOCUMENT_ROOT']."/lab4/carpedu/images/upload_profile_img/thumb/".$promo_img;
//		//$move = file_put_contents($DIR_DOC,$get);
//		//$move = file_put_contents($DIR_DOC1,$get);
//		
//		//save profile picture from fb to our server
//			$image_name = time().'_proflie_pic.jpg';
//			$save_to = PHYSICAL_PATH.'images/'.$image_name;
//			copy($get,$save_to);
//	}
//	else
//	{
//	  $image_name = 'profile.jpg';
//	 //echo 'okk'.$promo_img; die();
//	}
//	//echo 'okk'.$promo_img; die();
//	
// //echo $content['person']['id'];
//    //$_SESSION['linked_in_session'] = $content;
//    if(!empty($content['person']['id']))
//    {
//        //$register_check_query = 'SELECT * FROM people WHERE social_id="'.$content['person']['id'].'" AND social_type=1 AND email="'.$content['person']['email-address'].'"';
//        $register_check_query = 'SELECT * FROM people WHERE email="'.$content['person']['email-address'].'"';
//        $mysql_query = mysql_query($register_check_query) or die(mysql_error());
//		$count = mysql_num_rows($mysql_query);
//        if($count>0)
//        {
//            $profile_details = mysql_fetch_array($mysql_query);
//			if($profile_details['social_id'] =='')
//			{
//				$_SESSION['error_msg'] = "This email belongs to normal login..";
//				header('Location: '.SITEURL);
//			}
//			else
//			{
//				$update_query = 'UPDATE `people` SET `social_type`=1,`login_now`=1,`social_id`="'.$content['person']['id'].'" WHERE `id`="'.$profile_details['id'].'"';
//				$ex_update_query = mysql_query($update_query);
//				$_SESSION['login_data']['user_id'] = $profile_details['id'];
//				$_SESSION['login_data']['is_logged_in'] = 1;
//				$_SESSION['login_data']['email_id'] = $profile_details['email'];
//				$_SESSION['login_data']['profile_type'] = $profile_details['profile_type'];
//				$_SESSION['login_data']['social_login'] = 'true';
//			}
//        }
//        else
//        {
//           $insert_query = 'INSERT INTO people SET firstname="'.$content['person']['first-name'].'", lastname="'.$content['person']['last-name'].'",
//	    email="'.$content['person']['email-address'].'", social_id="'.$content['person']['id'].'", social_type=1, status="Y",login_now=1,profile_image = "'.$image_name.'"';
//	    mysql_query( $insert_query) or die(mysql_error());
//            $last_insert_id = mysql_insert_id();
//            
//            $_SESSION['login_data']['user_id'] = $last_insert_id;
//            $_SESSION['login_data']['is_logged_in'] = 1;
//            $_SESSION['login_data']['email_id'] = $content['person']['email-address'];
//            $_SESSION['login_data']['profile_type'] = 0;
//            $_SESSION['login_data']['social_login'] = 'true';
//        }
//    }
//    else
//    {
//        session_unset($_SESSION['login_data']);
//        session_destroy($_SESSION['login_data']);
//    }
//	//print_r($_SESSION);die;
//    //header('Location: '.SITEURL);
//		if($_SESSION['login_data']['profile_type'] == '1')
//		{
//		  header('Location: '.SITEURL.'profile-student.php');
//		  //echo SITEURL.'profile-student.php';
//		}
//		else if($_SESSION['login_data']['profile_type'] == '2')
//		{
//		  header('Location: '.SITEURL.'profile-parent.php');
//		  //echo SITEURL.'profile-parent.php';
//		}
//		else if($_SESSION['login_data']['profile_type'] == '3')
//		{
//		  header('Location: '.SITEURL.'profile-educator.php');
//		  //echo SITEURL.'profile-educator.php';
//		}
//		else
//		{
//		 header('Location: '.SITEURL);
//		}
//    include('html.inc');
//    exit;
    
    function XML2Array(SimpleXMLElement $parent)
    {
        $array = array();
        foreach ($parent as $name => $element) {
            ($node = & $array[$name])
                && (1 === count($node) ? $node = array($node) : 1)
                && $node = & $node[];
            $node = $element->count() ? XML2Array($element) : trim($element);
        }
        return $array;
    }
?>