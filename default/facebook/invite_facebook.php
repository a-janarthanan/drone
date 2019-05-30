<?php
session_start();
print_r($_REQUEST["to"]);
include_once("facebook.php"); 
$facebook = new Facebook(array(
  'appId'  => "1682994578600469",
  'secret' => "281ba1b7f553fac1c1600cbe8438c570",
  'cookie' => true,
  'domain' => "http://taskit.co.za/"
));
if(is_array($_REQUEST["to"]) && count($_REQUEST["to"])>0){
	foreach($_REQUEST["to"] as $to){
		$facebook->api($to.'/feed', 'post', array(
              'message' => 'test message',
              'link' => 'http://google.com',
              'name' => 'test name',
              'caption' => 'test caption',
              'description' => 'test long description',
         ));
	}
}
?>