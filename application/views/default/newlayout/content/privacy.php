<div id="acc-banners-ph" class="banner-contain">
</div>
<div>
<div>
<div class="red-subtitle top-red-subtitle" style="margin:0px 0 0 0"><?php echo $content->pages_title; ?></div>
<div class="profile_back">
<div class="container">
<div class="db-rightinfo db-rightinfo-inner" style="width:100%; margin:0px 0 0 0">
<div class="home-signpost-content" style="min-height:330px;">


<div class="box_cont box_cont-1">
<p class="LH18">
<?php  
		
		$content= $content->description;		
		$content=str_replace('KSYDOU','"',$content);
		$content=str_replace('KSYSING',"'",$content);
		
		echo $content;
?>
</p>
</div>
</div>
</div>
<div class="clear"></div>
</div>
<div class="clear"></div>
</div>
<div class="clear"></div>
</div>
</div>