<?php
    session_start();
    include("../includes/config.php"); //// Load site configurations
    require_once('oAuth/config.php');
    require_once('oAuth/linkedinoAuth.php');
    require_once('oAuth/class.linkedClass.php');
    
    
    $linkedClass   =   new linkedClass();
    # First step is to initialize with your consumer key and secret. We'll use an out-of-band oauth_callback
    $linkedin = new LinkedIn($config['linkedin_access'], $config['linkedin_secret']);
    //$linkedin->debug = true;

   if (isset($_REQUEST['oauth_verifier'])){
        $_SESSION['oauth_verifier']     = $_REQUEST['oauth_verifier'];

        $linkedin->request_token    =   unserialize($_SESSION['requestToken']);
        $linkedin->oauth_verifier   =   $_SESSION['oauth_verifier'];
        $linkedin->getAccessToken($_REQUEST['oauth_verifier']);
        $_SESSION['oauth_access_token'] = serialize($linkedin->access_token);
   }
   else{
        $linkedin->request_token    =   unserialize($_SESSION['requestToken']);
        $linkedin->oauth_verifier   =   $_SESSION['oauth_verifier'];
        $linkedin->access_token     =   unserialize($_SESSION['oauth_access_token']);
   }
   $content1 = $linkedClass->linkedinGetUserInfo($_SESSION['requestToken'], $_SESSION['oauth_verifier'], $_SESSION['oauth_access_token']);

   
    $xml   = simplexml_load_string($content1);
    $array = XML2Array($xml);
    $content = array($xml->getName() => $array);
    //print_r($content);die();
    //$_SESSION['linked_in_session'] = $content;
    if(!empty($content['person']['id']))
    {
        $register_check_query = 'SELECT * FROM people WHERE social_id="'.$content['person']['id'].'" AND social_type=1 AND email="'.$content['person']['email-address'].'"';
        $mysql_query = mysql_query($register_check_query) or die(mysql_error());
	$count = mysql_num_rows($mysql_query);
        if($count>0)
        {
            $profile_details = mysql_fetch_array($mysql_query);
            $_SESSION['login_data']['user_id'] = $profile_details['id'];
            $_SESSION['login_data']['is_logged_in'] = 1;
            $_SESSION['login_data']['email_id'] = $profile_details['email'];
            $_SESSION['login_data']['profile_type'] = $profile_details['profile_type'];
        }
        else
        {
            $insert_query = 'INSERT INTO people SET email="'.$content['person']['email-address'].'", social_id="'.$content['person']['id'].'", social_type=1';
	    mysql_query( $insert_query) or die(mysql_error());
            $last_insert_id = mysql_insert_id();
            
            $_SESSION['login_data']['user_id'] = $last_insert_id;
            $_SESSION['login_data']['is_logged_in'] = 1;
            $_SESSION['login_data']['email_id'] = $content['person']['email-address'];
            $_SESSION['login_data']['profile_type'] = 0;
        }
    }
    else
    {
        session_destroy();
    }
    header('Location: '.SITEURL);
    include('html.inc');
    exit;
    
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