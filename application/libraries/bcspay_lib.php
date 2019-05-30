<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 
/**
 * Code Igniter
 *
 * An open source application development framework for PHP 4.3.2 or newer
 *
 * @package		CodeIgniter
 * @author		Rick Ellis
 * @copyright	Copyright (c) 2006, pMachine, Inc.
 * @license		http://www.codeignitor.com/user_guide/license.html
 * @link		http://www.codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * bcspay_Lib Controller Class (bcspay IPN Class)
 *
 * This CI library is based on the bcspay PHP class by Micah Carrick
 * See www.micahcarrick.com for the most recent version of this class
 * along with any applicable sample files and other documentaion.
 *
 * This file provides a neat and simple method to interface with bcspay and
 * The bcspay Instant Payment Notification (IPN) interface.  This file is
 * NOT intended to make the bcspay integration "plug 'n' play". It still
 * requires the developer (that should be you) to understand the bcspay
 * process and know the variables you want/need to pass to bcspay to
 * achieve what you want.  
 *
 * This class handles the submission of an order to bcspay as well as the
 * processing an Instant Payment Notification.
 * This class enables you to mark points and calculate the time difference
 * between them.  Memory consumption can also be displayed.
 *
 * The class requires the use of the bcspay_Lib config file.
 *
 * @package     CodeIgniter
 * @subpackage  Libraries
 * @category    Commerce
 * @author      Ran Aroussi <ran@aroussi.com>
 * @copyright   Copyright (c) 2006, http://aroussi.com/ci/
 *
 */

// ------------------------------------------------------------------------

class bcspay_lib {

	var $last_error;			// holds the last error encountered
	var $ipn_log;				// bool: log IPN results to text file?

	var $ipn_log_file;			// filename of the IPN log
	var $ipn_response;			// holds the IPN response from bcspay	
	var $ipn_data = array();	// array contains the POST values for IPN
	var $fields = array();		// array holds the fields to submit to bcspay

	var $submit_btn = '';		// Image/Form button
	var $button_path = '';		// The path of the buttons
	
	var $CI;
	
	function bcspay_lib()
	{
		$this->CI =& get_instance();
		$this->CI->load->helper('url');
		$this->CI->load->helper('form');
		$this->CI->load->config('bcspaylib_config');
		
		$this->bcspay_url = 'https://www.vcs.co.za/vvonline/vcspay.aspx';

		$this->last_error = '';
		$this->ipn_response = '';

		$this->ipn_log_file = $this->CI->config->item('bcspay_lib_ipn_log_file');
		$this->ipn_log = $this->CI->config->item('bcspay_lib_ipn_log'); 
		
		$this->button_path = $this->CI->config->item('bcspay_lib_button_path');
		
		// populate $fields array with a few default values.  See the bcspay
		// documentation for a list of fields and their data types. These defaul
		// values can be overwritten by the calling script.
		$this->button('Pay Now!');
	}

	function button($value)
	{
		// changes the default caption of the submit button
		$this->submit_btn = form_submit('pp_submit', $value);
	}

	function image($file)
	{
		$this->submit_btn = '<input type="image" name="add" src="' . site_url($this->button_path .'/'. $file) . '" border="0" />';
	}


	function add_field($field, $value) 
	{
		// adds a key=>value pair to the fields array, which is what will be 
		// sent to bcspay as POST variables.  If the value is already in the 
		// array, it will be overwritten.
		$this->fields[$field] = $value;
	}

	function bcspay_auto_form() 
	{
		// this function actually generates an entire HTML page consisting of
		// a form with hidden elements which is submitted to bcspay via the 
		// BODY element's onLoad attribute.  We do this so that you can validate
		// any POST vars from you custom form before submitting to bcspay.  So 
		// basically, you'll have your own form which is submitted to your script
		// to validate the data, which in turn calls this function to create
		// another hidden form and submit to bcspay.

		$this->button('Click here if you\'re not automatically redirected...');

		echo '<html>' . "\n";
		echo '<head><title>Processing Payment...</title></head>' . "\n";
		echo '<body onLoad="document.bcspay_auto_form.submit();">'."\n";
		echo '<p>Please wait, your order is being processed and you will be redirected to the bcspay website.</p>' . "\n";
		echo $this->bcspay_form('bcspay_auto_form');
		echo '</body></html>';
	}

	function bcspay_form($form_name='bcspay_form') 
	{
		$str = '';
		$str .= '<form method="post" action="'.$this->bcspay_url.'" name="'.$form_name.'"/>' . "\n";
		foreach ($this->fields as $name => $value)
			$str .= form_hidden($name, $value) . "\n";
		$str .= '<p>'. $this->submit_btn . '</p>';
		$str .= form_close() . "\n";

		return $str;
	}

}

?>