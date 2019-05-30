<?php
    session_start();
    include_once 'oAuth/config.php';
    include_once 'oAuth/linkedinoAuth.php';
    
    //echo $config['base_url'] . 'linkedin_login_oauth/linkedinauth.php';
    //die();
    
    
//    echo date('l jS \of F Y h:i:s A',"1352203709");
    # First step is to initialize with your consumer key and secret. We'll use an out-of-band oauth_callback
    $linkedin = new LinkedIn($config['linkedin_access'], $config['linkedin_secret'], $config['base_url'] );
//    $linkedin->debug = true;
//echo $config['linkedin_access'];die();
    
    # Now we retrieve a request token. It will be set as $linkedin->request_token
   $check=$linkedin->getRequestToken();
  
    $_SESSION['requestToken'] = serialize($linkedin->request_token);
 // echo new LinkedIn($config['linkedin_secret']);die();
    
    # With a request token in hand, we can generate an authorization URL, which we'll direct the user to
   ## echo "Authorization URL: " . $linkedin->generateAuthorizeUrl() . "\n\n";
  // print_r($_SESSION);die;
  
    header("Location: " . $linkedin->generateAuthorizeUrl());
?>
