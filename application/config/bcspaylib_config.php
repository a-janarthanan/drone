<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

// ------------------------------------------------------------------------
// Ppal (Paypal IPN Class)
// ------------------------------------------------------------------------

// If (and where) to log ipn to file
$config['bcspay_lib_ipn_log_file'] = BASEPATH . 'logs/bcspay_ipn.log';
$config['bcspay_lib_ipn_log'] = TRUE;

// Where are the buttons located at 
$config['bcspay_lib_button_path'] = 'buttons';


/*$site=mysql_fetch_array(mysql_query("select * from site_setting"));

if($site['currency_code']=='')
{
	$code='USD';
}
else
{
	$code=$site['currency_code'];
}*/
$code='USD';

// What is the default currency?
$config['bcspay_lib_currency_code'] =$code ;

?>