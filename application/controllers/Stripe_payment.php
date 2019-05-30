<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Stripe_payment extends CI_Controller {
 
	public function __construct() {
 
		parent::__construct();
 
		}
 
          public function index()
         {
             $theme = getThemeName();
		$this->template->set_master_template($theme .'/template.php');
		
		$data['theme']=$theme;
		$meta_setting=meta_setting();
		
		$pageTitle='Dashboard - '.$meta_setting->title;
		$metaDescription='Dashboard - '.$meta_setting->meta_description;
		$metaKeyword='Dashboard - '.$meta_setting->meta_keyword;
		
		$this->template->write('pageTitle',$pageTitle,TRUE);
		$this->template->write('metaDescription',$metaDescription,TRUE);
		$this->template->write('metaKeyword',$metaKeyword,TRUE);
		$this->template->write_view('header',$theme .'/layout/common/header_login',$data,TRUE);
		$this->template->write_view('content_center',$theme .'/layout/wallet/strip',$data,TRUE);
		$this->template->write_view('footer',$theme .'/layout/common/footer',$data,TRUE);
		$this->template->render();	
          }
 
	public function checkout()
	{
		try {	
			require_once(APPPATH.'libraries/Stripe/lib/Stripe.php');//or you
			Stripe::setApiKey("YOUR_SECRET_KEY"); //Replace with your Secret Key
 
			$charge = Stripe_Charge::create(array(
				"amount" => 10000,
				"currency" => "usd",
				"card" => $_POST['stripeToken'],
				"description" => "Demo Transaction"
			));
			echo "<h1>Your payment has been completed.</h1>";	
		}
 
		catch(Stripe_CardError $e) {
 
		}
		catch (Stripe_InvalidRequestError $e) {
 
		} catch (Stripe_AuthenticationError $e) {
		} catch (Stripe_ApiConnectionError $e) {
		} catch (Stripe_Error $e) {
		} catch (Exception $e) {
		}
	}
 
}