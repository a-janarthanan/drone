<div class="page-title mbot20">
<h1 class="mleft15"><?php echo $content->pages_title; ?></h1>
</div>
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