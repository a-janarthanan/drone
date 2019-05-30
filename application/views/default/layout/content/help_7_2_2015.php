<div>
<div>
<div class="red-subtitle" style="margin:162px 0 0 0"><?php echo $content->pages_title; ?></div>
<div id="two-columnar-section">
<div class="task-layout">
<div class="db-rightinfo" style="width:100%; margin:25px 0 0 0">
<div class="home-signpost-content">


<div class="box_cont">
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
</div>
</div>
</div>
</div>