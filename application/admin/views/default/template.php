<?php
$site_setting=site_setting();  
$site_timezone=tzOffsetToName($site_setting->site_timezone);
date_default_timezone_set($site_timezone);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" > 
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>:: Administration ::</title>
		
		<script type="application/javascript">
			var baseUrl='<?php echo base_url(); ?>';
			var baseThemeUrl='<?php echo base_url().getThemeName(); ?>';
		</script>
		
			<link media="all" type="text/css" rel="stylesheet" href="<?php echo base_url().getThemeName(); ?>/css/style.css"  media="screen, projection"/>
		
		
			<link rel="stylesheet" type="text/css" href="<?php echo base_url().getThemeName(); ?>/css/jquery/jquery.ui.all.css" media="screen"/>
			<link rel="stylesheet" type="text/css" href="<?php echo base_url().getThemeName(); ?>/css/table_data.css" media="screen"/>
			<link rel="stylesheet" type="text/css" href="<?php echo base_url().getThemeName(); ?>/css/lightbox/style.css" media="screen"/>
			<!--<link rel="stylesheet" type="text/css" href="<?php echo base_url().getThemeName(); ?>/css/style.css" title="style_blue" media="screen"/>
			<link rel="alternate stylesheet" type="text/css" href="<?php echo base_url().getThemeName(); ?>/css/style_green.css" title="style_green" media="screen" />-->
			<link rel="alternate stylesheet" type="text/css" href="<?php echo base_url().getThemeName(); ?>/css/style_red.css" title="style_red" media="screen" />
			<!--<link rel="alternate stylesheet" type="text/css" href="<?php echo base_url().getThemeName(); ?>/css/style_purple.css" title="style_purple" media="screen" />-->
			
			<!--[if IE]><script type="text/javascript" src="<?php echo base_url().getThemeName(); ?>/js/excanvas.js"></script><![endif]-->
			<script type="text/javascript" src="<?php echo base_url().getThemeName(); ?>/js/jquery-1.4.2.js"></script>
			<script type="text/javascript" src="<?php echo base_url().getThemeName(); ?>/js/jquery-ui-1.8.2.js"></script>
			<script type="text/javascript" src="<?php echo base_url().getThemeName(); ?>/js/jquery.fancybox-1.3.2.js"></script>
			<script type="text/javascript" src="<?php echo base_url().getThemeName(); ?>/js/jquery.validate.js" ></script>
			<script type="text/javascript" src="<?php echo base_url().getThemeName(); ?>/js/jquery.wysiwyg.js" ></script>
			<script type="text/javascript" src="<?php echo base_url().getThemeName(); ?>/js/jquery.dataTables.js"></script>
			<script type="text/javascript" src="<?php echo base_url().getThemeName(); ?>/js/jquery.flot.js"></script>
			<script type="text/javascript" src="<?php echo base_url().getThemeName(); ?>/js/jquery.flot.stack.js"></script>
			<script type="text/javascript" src="<?php echo base_url().getThemeName(); ?>/js/styleswitch.js"></script>
			<script type="text/javascript" src="<?php echo base_url().getThemeName(); ?>/js/custom.js"></script>
            
            <script type="text/javascript" src="<?php echo base_url().getThemeName(); ?>/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="alternate stylesheet" type="text/css" href="<?php echo base_url().getThemeName(); ?>/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
			<link rel="stylesheet" href="<?php echo base_url().getThemeName(); ?>/css/slide.css" type="text/css" media="screen" />
            <script src="<?php echo base_url().getThemeName(); ?>/js/slide.js" type="text/javascript"></script>
	
	</head>
<body>
<div id="wrapper">

	<?php echo $header; ?>
	
	<?php echo $header_menu; ?>
	
	<section>
		<?php echo $center; ?>
	</section>   
	
</div>
<?php echo $footer; ?>
	
</body>
</html>