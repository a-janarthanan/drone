<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Ask For Task</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link media="all" type="text/css" rel="stylesheet" href="style.css" />

<!--[if IE]>  
<script src="js/html5.js"></script>
<![endif]-->  
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/njquery.jcarousel.min.js"></script>


<script language="javascript" type="text/javascript" src="js/dhtml.js"></script>

<script type="text/javascript">

jQuery(document).ready(function() {
    jQuery('#mycarousel2').jcarousel();
	

	jQuery('.acc_link').click(function (){			
		jQuery('.acc_div').slideToggle(400);
		jQuery('.wrap').show();
	});	


	
  
});

</script>

<!--[if IE]>
<link media="all" type="text/css" rel="stylesheet" href="iestyle.css" />
<![endif]-->
</head>
<body>

<header>

<div class="main">
	<div class="headbgleft">
    	<a href="#"><img src="images/logo.png" class="clogo" alt="" /></a>
        
        <div class="mcity">
                <select name="" class="selwid150" style="height:28px; font-size:14px;">
                <option value="">New York</option>
                <option value="">Mumbai</option>
                <option value="">Egypt</option>
                <option value="">Delhi</option>
                </select>
        </div>
        
        <div class="hsearch">
                	<form action="" name="serch_task_dash">
                    	<input type="text" name="email" class="hsearchbg" placeholder="Your E-mail address" />
                        <input type="submit" name="sub_email" class="submbgsearch" value="Search">
                    </form>
        </div>
        
    </div>
   <div class="headbgright">

<!--        <div class="hlog">
			<a href="#" class="login">Log In</a>
		</div>-->
        
        <div class="hposttask">
			<a href="#" class="login">Post Task</a>
		</div>

		<div class="my_acc">
        	<a href="#" class="acc_link"><img src="images/user_img.png" alt="" /></a>
            <div class="acc_div">
                <ul>
                    <li>Aditya Dhanraj</li>
                    <li><a href="#">My Profile</a></li>
                    <li><a href="#">My Account</a></li>
                    <li><a href="#">Notifications</a></li>
                    <li><a href="#">My Credit Card</a></li>
                    <li><a href="#">My Tasks</a></li>
                    <li><a href="#">Favorite TaskRobos</a></li>
                    <li><a href="#">Logout</a></li>
                </ul>
            </div>            
        </div>   
      
    </div>
    <div class="clear"></div>
</div>

</header>

<section>

<!-- -->
<!-- -->    

<div class="main">
<div class="incon">
    	
<div class="browseall">
			<form>
            <table width="100%" border="0" cellspacing="1" cellpadding="5">
              <tr>
                <td align="left"><div id="s1post">Browse Tasks</div> <h1 id="bilt">We can do just about anything!</h1>
                </td>
                <td align="right"><a class="login" href="#">Post Task</a></td>
              </tr>
            </table>

            <div class="mostpop marTB10">
            
            <ul class="mc">
                <li>
                    <img src="images/bx.png" width="94" height="94" alt="" />
                    <h3><a href="#">Delivery</a></h3>
                    <ul class="mch4">
                        <li><a href="#">Restaurant Delivery</a></li>
                        <li><a href="#">Shipping</a></li>
                        <li><a href="#">IKEA Delivery</a></li>
                        <li><a href="#">Courier</a></li>
                        <li><a href="#">Target Delivery</a></li>
                        <li><a href="#">Dry Cleaning Delivery</a></li>
                        <li><a href="#">Other Delivery Tasks</a></li>
                    </ul>    
                    <a class="more expanded-links" href="#">Fewer</a>
                </li>
                <li>
                    <img src="images/homeb.png" width="94" height="94" alt="" />
                    <h3><a href="#">House Chores</a></h3>
                    <ul class="mch4">
                        <li><a href="#">House Cleaning</a></li>
                        <li><a href="#">Donation Pickup</a></li>
                        <li><a href="#">Laundry</a></li>
                        <li><a href="#">Cooking/Baking</a></li>
                        <li><a href="#">Organization</a></li>
                        <li><a href="#">Administrative</a></li>
                        <li><a href="#">Recycling</a></li>
                        <li><a href="#">Spring Cleaning</a></li>
                        <li><a href="#">Junk Removal</a></li>
                        <li><a href="#">Technical Help</a></li>
                        <li><a href="#">Other House Chores Tasks</a></li>
                    </ul>
                </li>
                <li>
                    <img src="images/shopcart.png" width="94" height="94" alt="" />
                    <h3><a href="#">Shopping</a></h3>
                    <ul class="mch4">
                        <li><a href="#">Grocery Delivery</a></li>
                        <li><a href="#">IKEA Delivery</a></li>
                        <li><a href="#">Whole Foods Delivery</a></li>
                        <li><a href="#">Target Delivery</a></li>
                        <li><a href="#">Apple Store Delivery</a></li>
                        <li><a href="#">Other Store Delivery</a></li>
                        <li><a href="#">Tasks</a></li>
                    </ul>            
                </li>
                <li>
                    <img src="images/office-help.png" width="94" height="94" alt="" />
                    <h3><a href="#">Office Help</a></h3>
                    <ul class="mch4">
                        <li><a href="#">Organization</a></li>
                        <li><a href="#">Administrative</a></li>
                        <li><a href="#">Accounting</a></li>
                        <li><a href="#">Data Entry</a></li>
                        <li><a href="#">Office Cleaning</a></li>
                        <li><a href="#">Usability Testing</a></li>
                        <li><a href="#">Other Office Help Tasks</a>></li>
                    </ul>            
                </li>
                <li>
                    <img src="images/tool.png" width="94" height="94" alt="" />
                    <h3><a href="#">Handyman</a></h3>
                    <ul class="mch4">
                        <li><a href="#">Assembly & Repair</a></li>
                        <li><a href="#">Carpentry</a></li>
                        <li><a href="#">IKEA Assembly</a></li>
                        <li><a href="#">Other Handyman Tasks</a></li>
                    </ul>            
                </li>
                <div class="clear"></div>
            </ul>
            
            </div>
            
			<div class="mostpop mtopbot10">
            
            <ul class="mc">
                <li>
                    
                    <h3><a href="#">Child Care</a></h3>
                    <ul class="mch4">
                        <li><a href="#">All Child Care Tasks</a></li>
                    </ul>    
                </li>
                <li>
                  
                    <h3><a href="#">Computer Help</a></h3>
                    <ul class="mch4">
                        <li><a href="#">Website Design</a></li>
                        <li><a href="#">HTML Coding</a></li>
                        <li><a href="#">Computer Engineering</a></li>
                        <li><a href="#">Other Computer Help Tasks</a></li>
                    </ul>
                </li>
                <li>
                   
                    <h3><a href="#">Creative</a></h3>
                    <ul class="mch4">
                        <li><a href="#">Writing</a></li>
                        <li><a href="#">Graphic Design</a></li>
                        <li><a href="#">Photography</a></li>
                        <li><a href="#">Videography</a></li>
                        <li><a href="#">Other Creative Tasks</a></li>
                    </ul>            
                </li>
                <li>
                   
                    <h3><a href="#">Event Help</a></h3>
                    <ul class="mch4">
                        <li><a href="#">Holiday Party Help</a></li>
                        <li><a href="#">Photography</a></li>
                        <li><a href="#">Catering</a></li>
                        <li><a href="#">Videography</a></li>
                        <li><a href="#">Office Cleaning</a></li>
                        <li><a href="#">Marketing</a></li>
                        <li><a href="#">Other Event Help Tasks</a></li>
                    </ul>            
                </li>
                <li>
                    
                    <h3><a href="#">Health & Medical</a></h3>
                    <ul class="mch4">
                        <li><a href="#">Yoga</a></li>
                        <li><a href="#">Other Health & Medical Tasks</a></li>
                    </ul>            
                </li>
                <div class="clear"></div>
            </ul>
            
            </div>

           <div class="mostpop mtopbot10">
            
            <ul class="mc">
                <li>
                    
                    <h3><a href="#">Instruction</a></h3>
                    <ul class="mch4">
                        <li><a href="#">Tutor</a></li>
                        <li><a href="#">Yoga</a></li>
                        <li><a href="#">Other Instruction Tasks</a></li>
                    </ul>    
                </li>
                <li>
                  
                    <h3><a href="#">Moving Help</a></h3>
                    <ul class="mch4">
                        <li><a href="#">Heavy Lifting</a></li>
                        <li><a href="#">Packing</a></li>
                        <li><a href="#">Storage Transportation</a></li>
                        <li><a href="#">Other Moving Help Tasks</a></li>
                    </ul>
                </li>
                <li>
                   
                    <h3><a href="#">Personal Care</a></h3>
                    <ul class="mch4">
                        <li><a href="#">All Personal Care Tasks</a></li>
                    </ul>            
                </li>
                <li>
                   
                    <h3><a href="#">Pet Care</a></h3>
                    <ul class="mch4">
                        <li><a href="#">Dog Walking</a></li>
                        <li><a href="#">Pet Sitting</a></li>
                        <li><a href="#">Other Pet Care Tasks</a></li>
                    </ul>            
                </li>
                <li>
                    
                    <h3><a href="#">Seasonal</a></h3>
                    <ul class="mch4">
                        <li><a href="#">Holiday Party Help</a></li>
                        <li><a href="#">Snow Removal</a></li>
                        <li><a href="#">Gift Shopping & Wrapping</a></li>
                        <li><a href="#">Other Seasonal Tasks</a></li>
                    </ul>            
                </li>
                <div class="clear"></div>
            </ul>
            
            </div>
           
           <div class="mostpop mtopbot10">
            
            <ul class="mc">
                <li>
                    
                    <h3><a href="#">Selling</a></h3>
                    <ul class="mch4">
                        <li><a href="#">eBay Help</a></li>
                        <li><a href="#">Craigslist Help</a></li>
                        <li><a href="#">Other Selling Tasks</a></li>
                    </ul>    
                </li>
                <li>
                  
                    <h3><a href="#">Skilled</a></h3>
                    <ul class="mch4">
                        <li><a href="#">Electrical Work</a></li>
                        <li><a href="#">Carpentry</a></li>
                        <li><a href="#">Construction</a></li>
                        <li><a href="#">Sewing</a></li>
                        <li><a href="#">Notary</a></li>
                        <li><a href="#">Plumbing</a></li>
                        <li><a href="#">Automotive</a></li>
                        <li><a href="#">Painting</a></li>
                        <li><a href="#">Mechanic</a></li>
                        <li><a href="#">Technical Help</a></li>
                        <li><a href="#">Other Skilled Tasks</a></li>
                    </ul>
                </li>
                <li>
                   
                    <h3><a href="#">Transport</a></h3>
                    <ul class="mch4">
                        <li><a href="#">All Transport Tasks</a></li>
                    </ul>            
                </li>
                <li>
                   
                    <h3><a href="#">Unique</a></h3>
                    <ul class="mch4">
                        <li><a href="#">Outrageous</a></li>
                        <li><a href="#">Funny</a></li>
                        <li><a href="#">Warm & Fuzzy</a></li>
                        <li><a href="#">Clever</a></li>
                        <li><a href="#">Other Unique Tasks</a></li>
                    </ul>            
                </li>
                <li>
                    
                    <h3><a href="#">Virtual Assistance</a></h3>
                    <ul class="mch4">
                        <li><a href="#">Research</a></li>
                        <li><a href="#">Craigslist Help</a></li>
                        <li><a href="#">Usability Testing</a></li>
                        <li><a href="#">Vacation Planning</a></li>
                        <li><a href="#">Other Virtual Assistance Tasks</a></li>
                    </ul>            
                </li>
                <div class="clear"></div>
            </ul>
            
            </div>
           
<div class="mostpop mtopbot10">
            
            <ul class="mc">
                <li>
                    
                    <h3><a href="#">Yard Work</a></h3>
                    <ul class="mch4">
                        <li><a href="#">Snow Removal</a></li>
                        <li><a href="#">Gardening</a></li>
                        <li><a href="#">Landscaping</a></li>
                        <li><a href="#">Lawn Mowing</a></li>
                        <li><a href="#">Other Yard Work Tasks</a></li>
                    </ul>    
                </li>
                <div class="clear"></div>
            </ul>
            
            </div>           
           
			</form>
                      
           </div>        


    </div>
</div>



</section>

<?php require('footer.php'); ?>


</body>
</html>
