<div class="red-subtitle" style="margin:172px 0 0 0"><?php echo $content->pages_title; ?></div>
<div id="two-columnar-section">
<div class="inside-task">

<div class="db-rightinfo" style="width:100%; margin:25px 0 0 0">
<div class="home-signpost-content">
<p class="normal-text" style="margin:0 0 20px 0; color:#000; line-height:20px">
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