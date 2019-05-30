<?php 

mysql_connect('localhost','root','');
mysql_select_db('ask_for_task');

function check_email($email) {

  $email = trim($email); // strip any white space
  $response = array(); // our response
  
  // if the username is blank
  if (!$email) {
    $response = array(
      'ok' => false, 
     );
      
  // if the username does not match a-z or '.', '-', '_' then it's not valid
  } else if (!preg_match('^[a-zA-Z0-9]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$^', $email)) {
    $response = array(
      'ok' => false, 
      );
      
  // this would live in an external library just to check if the username is taken
  } else if (email_taken($email)) {
    $response = array(
      'ok' => false, 
      );
      
  // it's all good
  } else {
    $response = array(
      'ok' => true, 
      );
  }

  return $response;        
}


function email_taken($email)
{
	$sql=mysql_query("select * from trc_user where email='".$email."'");
	
	if(mysql_num_rows($sql)>0)
	{
		return true;
	}
	return false;
}

if (@$_REQUEST['action'] == 'check_email' && isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
    echo json_encode(check_email($_REQUEST['email']));
    exit; // only print out the json version of the response
}

?>