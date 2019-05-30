<div id="content">
	
    <?php $site_setting=site_setting(); ?>
    	
<!-- 1. Add these JavaScript inclusions in the head of your page -->

<script type="text/javascript" src="<?Php echo base_url().getThemeName(); ?>/js/jquery.min.js"></script>

<script type="text/javascript" src="<?Php echo base_url().getThemeName(); ?>/js/highcharts.js"></script>


<!-- 1b) Optional: the exporting module -->
<script type="text/javascript" src="<?Php echo base_url().getThemeName(); ?>/js/modules/exporting.js"></script>


		<script type="text/javascript">
$(function () {
    var chart, chart1, chart2, chart3, chart4, chart5;
	
			/*exporting: {
				enabled: true
			  },
		*/
		
	
	
    $(document).ready(function() {
        
		
		
		chart = new Highcharts.Chart({
            chart: {
                renderTo: 'weeklyregistration',
                type: 'line',
                marginRight: 0,
                marginBottom: 25
            },
            title: {
                text: '',
                x: -20 //center
            },
            subtitle: {
                text: '',
                x: -20
            },
            xAxis: {
                categories: ['Mon', 'Tue', 'Wen', 'Thur', 'Fri', 'Sat', 'Sun']
            },
            yAxis: {
                title: {
                    text: 'Total'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                formatter: function() {
                        return '<b>'+ this.series.name +'</b><br/>'+
                        this.x +': ' +this.y;
                }
            },
			
			
			
            legend: {
                layout: 'horizontal',
                align: 'center',
                verticalAlign: 'top',
                x: 10,
                y: 0,
                borderWidth: 0
            },
            series: [{
                name: 'Registration',
                data: [<?php if($weekly_registration) {  foreach($weekly_registration as $date => $total) { echo $total.','; } } ?>]
            }, {
                name: 'Facebook',
                data: [<?php if($weekly_fb_registration) {  foreach($weekly_fb_registration as $date => $total) { echo $total.','; } } ?>]
            }, {
                name: 'Twitter',
                data: [<?php if($weekly_tw_registration) {  foreach($weekly_tw_registration as $date => $total) { echo $total.','; } } ?>]
            }, {
                name: 'Runner Application',
                data: [<?php if($weekly_runner_registration) {  foreach($weekly_runner_registration as $date => $total) { echo $total.','; } } ?>]
            }]
        });
		
		
		
		chart1 = new Highcharts.Chart({
            chart: {
                renderTo: 'monthlyregistration',
                type: 'line',
                marginRight: 0,
                marginBottom: 25
            },
            title: {
                text: '',
                x: -20 //center
            },
            subtitle: {
                text: '',
                x: -20
            },
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },
            yAxis: {
                title: {
                    text: 'Total'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                formatter: function() {
                        return '<b>'+ this.series.name +'</b><br/>'+
                         this.x +': ' +this.y;
                }
            },
			
			
            legend: {
                layout: 'horizontal',
                align: 'center',
                verticalAlign: 'top',
                x: 10,
                y: 0,
                borderWidth: 0
            },
              series: [{
                name: 'Registration',
                data: [<?php if($monthly_registration) {  foreach($monthly_registration as $date => $total) { echo $total.','; } } ?>]
            }, {
                name: 'Facebook',
                data: [<?php if($monthly_fb_registration) {  foreach($monthly_fb_registration as $date => $total) { echo $total.','; } } ?>]
            }, {
                name: 'Twitter',
                data: [<?php if($monthly_tw_registration) {  foreach($monthly_tw_registration as $date => $total) { echo $total.','; } } ?>]
            }, {
                name: 'Runner Application',
                data: [<?php if($monthly_runner_registration) {  foreach($monthly_runner_registration as $date => $total) { echo $total.','; } } ?>]
            }]
        });
		
		
		
		chart2 = new Highcharts.Chart({
            chart: {
                renderTo: 'yearlyregistration',
                type: 'line',
                marginRight: 0,
                marginBottom: 25
            },
            title: {
                text: '',
                x: -20 //center
            },
            subtitle: {
                text: '',
                x: -20
            },
            xAxis: {
                categories: [<?php for($i=$year_first;$i<=$year_last;$i++) { echo "'".$i."',"; } ?>]
            },
            yAxis: {
                title: {
                    text: 'Total'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                formatter: function() {
                        return '<b>'+ this.series.name +'</b><br/>'+
                        this.x +': '+this.y;
                }
            },
			
			
            legend: {
                layout: 'horizontal',
                align: 'center',
                verticalAlign: 'top',
                x: 10,
                y: 0,
                borderWidth: 0
            },
             series: [{
                name: 'Registration',
                data: [<?php if($yearly_registration) {  foreach($yearly_registration as $date => $total) { echo $total.','; } } ?>]
            }, {
                name: 'Facebook',
                data: [<?php if($yearly_fb_registration) {  foreach($yearly_fb_registration as $date => $total) { echo $total.','; } } ?>]
            }, {
                name: 'Twitter',
                data: [<?php if($yearly_tw_registration) {  foreach($yearly_tw_registration as $date => $total) { echo $total.','; } } ?>]
            }, {
                name: 'Runner Application',
                data: [<?php if($yearly_runner_registration) {  foreach($yearly_runner_registration as $date => $total) { echo $total.','; } } ?>]
            }]
        });
		
		
		


		
		chart3 = new Highcharts.Chart({
            chart: {
                renderTo: 'weeklyregistrationbar',
                type: 'column',
                marginRight: 0,
                marginBottom: 25
            },
            title: {
                text: '',
                x: -20 //center
            },
            subtitle: {
                text: '',
                x: -20
            },
            xAxis: {
                categories: ['Mon', 'Tue', 'Wen', 'Thur', 'Fri', 'Sat', 'Sun']
            },
            yAxis: {
				 min: 0,
                title: {
                    text: 'Total'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                formatter: function() {
                        return this.x +': ' +this.y;
                }
            },
			
			
			
            legend: {
                layout: 'horizontal',
                align: 'center',
                verticalAlign: 'top',
                x: 10,
                y: 0,
                borderWidth: 0,
				floating: true,
                shadow: true
            },
			
			 plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
			
			
            series: [{
                name: 'Registration',
                data: [<?php if($weekly_registration) {  foreach($weekly_registration as $date => $total) { echo $total.','; } } ?>]
            }, {
                name: 'Facebook',
                data: [<?php if($weekly_fb_registration) {  foreach($weekly_fb_registration as $date => $total) { echo $total.','; } } ?>]
            }, {
                name: 'Twitter',
                data: [<?php if($weekly_tw_registration) {  foreach($weekly_tw_registration as $date => $total) { echo $total.','; } } ?>]
            }, {
                name: 'Runner Application',
                data: [<?php if($weekly_runner_registration) {  foreach($weekly_runner_registration as $date => $total) { echo $total.','; } } ?>]
            }]
        });
		
		
		
		chart4 = new Highcharts.Chart({
            chart: {
                renderTo: 'monthlyregistrationbar',
                type: 'column',
                marginRight: 0,
                marginBottom: 25
            },
            title: {
                text: '',
                x: -20 //center
            },
            subtitle: {
                text: '',
                x: -20
            },
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },
            yAxis: {
				 min: 0,
                title: {
                    text: 'Total'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                formatter: function() {
                        return this.x +': ' +this.y;
                }
            },
			
			
            legend: {
                layout: 'horizontal',
                align: 'center',
                verticalAlign: 'top',
                x: 10,
                y: 0,
                 borderWidth: 0,
				floating: true,
                shadow: true
            },
			
			
			plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
			
			
              series: [{
                name: 'Registration',
                data: [<?php if($monthly_registration) {  foreach($monthly_registration as $date => $total) { echo $total.','; } } ?>]
            }, {
                name: 'Facebook',
                data: [<?php if($monthly_fb_registration) {  foreach($monthly_fb_registration as $date => $total) { echo $total.','; } } ?>]
            }, {
                name: 'Twitter',
                data: [<?php if($monthly_tw_registration) {  foreach($monthly_tw_registration as $date => $total) { echo $total.','; } } ?>]
            }, {
                name: 'Runner Application',
                data: [<?php if($monthly_runner_registration) {  foreach($monthly_runner_registration as $date => $total) { echo $total.','; } } ?>]
            }]
        });
		
		
		
		
		
		
		chart5 = new Highcharts.Chart({
            chart: {
                renderTo: 'yearlyregistrationbar',
                type: 'column',
                marginRight: 0,
                marginBottom: 25
            },
            title: {
                text: '',
                x: -20 //center
            },
            subtitle: {
                text: '',
                x: -20
            },
            xAxis: {
                categories: [<?php for($i=$year_first;$i<=$year_last;$i++) { echo "'".$i."',"; } ?>]
            },
            yAxis: {
			
				 min: 0,
                title: {
                    text: 'Total'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                formatter: function() {
                        return this.x +': ' +this.y;
                }
            },
			
			
            legend: {
                layout: 'horizontal',
                align: 'center',
                verticalAlign: 'top',
                x: 10,
                y: 0,
                 borderWidth: 0,
				floating: true,
                shadow: true
            },
			
			plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
			
            series: [{
                name: 'Registration',
                data: [<?php if($yearly_registration) {  foreach($yearly_registration as $date => $total) { echo $total.','; } } ?>]
            }, {
                name: 'Facebook',
                data: [<?php if($yearly_fb_registration) {  foreach($yearly_fb_registration as $date => $total) { echo $total.','; } } ?>]
            }, {
                name: 'Twitter',
                data: [<?php if($yearly_tw_registration) {  foreach($yearly_tw_registration as $date => $total) { echo $total.','; } } ?>]
            }, {
                name: 'Runner Application',
                data: [<?php if($yearly_runner_registration) {  foreach($yearly_runner_registration as $date => $total) { echo $total.','; } } ?>]
            }]
        });
		
		
		
		
		

		
    });
    
});
		</script>
        

    
    
		<div class="column half fl">
		
			<div class="box">
			<h2 class="box-header">Weekly Average Registration(Line)</h2>
			<div class="box-content">
				
                
                <div id="weeklyregistration" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
                
			</div>
			</div>
			
		</div>
		
		
        
        <div class="column half fr">
		
			<div class="box">
			<h2 class="box-header">Weekly Average Registration(Bar)</h2>
			<div class="box-content">
				
                
                <div id="weeklyregistrationbar" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
                
			</div>
			</div>
			
		</div>
        
        
		
		
       <div class="column half fl">
		
			<div class="box">
			<h2 class="box-header">Monthly Average Registration(Line)</h2>
			<div class="box-content">
				
                  <div id="monthlyregistration" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
                
			</div>
			</div>
			
		</div>
       
       
       <div class="column half fr">
		
			<div class="box">
			<h2 class="box-header">Monthly Average Registration(Bar)</h2>
			<div class="box-content">
				
                  <div id="monthlyregistrationbar" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
                
			</div>
			</div>
			
		</div> 
        
        
        
        
        
        <div class="column half fl">
		
			<div class="box">
			<h2 class="box-header">Yearly Average Registration(Line)</h2>
			<div class="box-content">
				
                  <div id="yearlyregistration" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
                
			</div>
			</div>
			
		</div>
        
        
        
        <div class="column half fr">
		
			<div class="box">
			<h2 class="box-header">Yearly Average Registration(Bar)</h2>
			<div class="box-content">
				
                  <div id="yearlyregistrationbar" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
                
			</div>
			</div>
			
		</div>
        
        
        
        
        
        
        
	<div class="clear"></div>
	</div>