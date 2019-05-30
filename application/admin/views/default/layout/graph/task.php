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
                renderTo: 'weeklytask',
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
                name: 'New',
				color: '#4572A7',
                data: [<?php if($weekly_new_task) {  foreach($weekly_new_task as $date => $total) { echo $total.','; } } ?>]
            }, {
                name: 'Open',
				color: '#89A54E',
                data: [<?php if($weekly_open_task) {  foreach($weekly_open_task as $date => $total) { echo $total.','; } } ?>]
            }, {
                name: 'Complete',
				color: '#80699B',
                data: [<?php if($weekly_close_task) {  foreach($weekly_close_task as $date => $total) { echo $total.','; } } ?>]
            }, {
                name: 'Cancel',
				color: '#AA4643',
                data: [<?php if($weekly_cancel_task) {  foreach($weekly_cancel_task as $date => $total) { echo $total.','; } } ?>]
            }]
        });
		
		
		
		chart1 = new Highcharts.Chart({
            chart: {
                renderTo: 'monthlytask',
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
                name: 'New',
				color: '#4572A7',
                data: [<?php if($monthly_new_task) {  foreach($monthly_new_task as $date => $total) { echo $total.','; } } ?>]
            }, {
                name: 'Open',
				color: '#89A54E',
                data: [<?php if($monthly_open_task) {  foreach($monthly_open_task as $date => $total) { echo $total.','; } } ?>]
            }, {
                name: 'Complete',
				color: '#80699B',
                data: [<?php if($monthly_close_task) {  foreach($monthly_close_task as $date => $total) { echo $total.','; } } ?>]
            }, {
                name: 'Cancel',
				color: '#AA4643',
                data: [<?php if($monthly_cancel_task) {  foreach($monthly_cancel_task as $date => $total) { echo $total.','; } } ?>]
            }]
        });
		
		
		
		chart2 = new Highcharts.Chart({
            chart: {
                renderTo: 'yearlytask',
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
                name: 'New',
				color: '#4572A7',
                data: [<?php if($yearly_new_task) {  foreach($yearly_new_task as $date => $total) { echo $total.','; } } ?>]
            }, {
                name: 'Open',
				color: '#89A54E',
                data: [<?php if($yearly_open_task) {  foreach($yearly_open_task as $date => $total) { echo $total.','; } } ?>]
            }, {
                name: 'Complete',
				color: '#80699B',
                data: [<?php if($yearly_close_task) {  foreach($yearly_close_task as $date => $total) { echo $total.','; } } ?>]
            }, {
                name: 'Cancel',
				color: '#AA4643',
                data: [<?php if($yearly_cancel_task) {  foreach($yearly_cancel_task as $date => $total) { echo $total.','; } } ?>]
            }]
        });
		
		
		


		
		chart3 = new Highcharts.Chart({
            chart: {
                renderTo: 'weeklytaskbar',
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
                name: 'New',
				color: '#4572A7',
                data: [<?php if($weekly_new_task) {  foreach($weekly_new_task as $date => $total) { echo $total.','; } } ?>]
            }, {
                name: 'Open',
				color: '#89A54E',
                data: [<?php if($weekly_open_task) {  foreach($weekly_open_task as $date => $total) { echo $total.','; } } ?>]
            }, {
                name: 'Close',
				color: '#80699B',
                data: [<?php if($weekly_close_task) {  foreach($weekly_close_task as $date => $total) { echo $total.','; } } ?>]
            }, {
                name: 'Cancel',
				color: '#AA4643',
                data: [<?php if($weekly_cancel_task) {  foreach($weekly_cancel_task as $date => $total) { echo $total.','; } } ?>]
            }]
        });
		
		
		
		chart4 = new Highcharts.Chart({
            chart: {
                renderTo: 'monthlytaskbar',
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
                name: 'New',
				color: '#4572A7',
                data: [<?php if($monthly_new_task) {  foreach($monthly_new_task as $date => $total) { echo $total.','; } } ?>]
            }, {
                name: 'Open',
				color: '#89A54E',
                data: [<?php if($monthly_open_task) {  foreach($monthly_open_task as $date => $total) { echo $total.','; } } ?>]
            }, {
                name: 'Complete',
				color: '#80699B',
                data: [<?php if($monthly_close_task) {  foreach($monthly_close_task as $date => $total) { echo $total.','; } } ?>]
            }, {
                name: 'Cancel',
				color: '#AA4643',
                data: [<?php if($monthly_cancel_task) {  foreach($monthly_cancel_task as $date => $total) { echo $total.','; } } ?>]
            }]
        });
		
		
		
		
		
		
		chart5 = new Highcharts.Chart({
            chart: {
                renderTo: 'yearlytaskbar',
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
                name: 'New',
				color: '#4572A7',
                data: [<?php if($yearly_new_task) {  foreach($yearly_new_task as $date => $total) { echo $total.','; } } ?>]
            }, {
                name: 'Open',
				color: '#89A54E',
                data: [<?php if($yearly_open_task) {  foreach($yearly_open_task as $date => $total) { echo $total.','; } } ?>]
            }, {
                name: 'Complete',
				color: '#80699B',
                data: [<?php if($yearly_close_task) {  foreach($yearly_close_task as $date => $total) { echo $total.','; } } ?>]
            }, {
                name: 'Cancel',
				color: '#AA4643',
                data: [<?php if($yearly_cancel_task) {  foreach($yearly_cancel_task as $date => $total) { echo $total.','; } } ?>]
            }]
        });
		
		
		
		
		

		
    });
    
});
		</script>
        

    
    
		<div class="column half fl">
		
			<div class="box">
			<h2 class="box-header">Weekly Average Task(Line)</h2>
			<div class="box-content">
				
                
                <div id="weeklytask" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
                
			</div>
			</div>
			
		</div>
		
		
        
        <div class="column half fr">
		
			<div class="box">
			<h2 class="box-header">Weekly Average Task(Bar)</h2>
			<div class="box-content">
				
                
                <div id="weeklytaskbar" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
                
			</div>
			</div>
			
		</div>
        
        
		
		
       <div class="column half fl">
		
			<div class="box">
			<h2 class="box-header">Monthly Average Task(Line)</h2>
			<div class="box-content">
				
                  <div id="monthlytask" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
                
			</div>
			</div>
			
		</div>
       
       
       <div class="column half fr">
		
			<div class="box">
			<h2 class="box-header">Monthly Average Task(Bar)</h2>
			<div class="box-content">
				
                  <div id="monthlytaskbar" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
                
			</div>
			</div>
			
		</div> 
        
        
        
        
        
        <div class="column half fl">
		
			<div class="box">
			<h2 class="box-header">Yearly Average Task(Line)</h2>
			<div class="box-content">
				
                  <div id="yearlytask" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
                
			</div>
			</div>
			
		</div>
        
        
        
        <div class="column half fr">
		
			<div class="box">
			<h2 class="box-header">Yearly Average Task(Bar)</h2>
			<div class="box-content">
				
                  <div id="yearlytaskbar" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
                
			</div>
			</div>
			
		</div>
        
        
        
        
        
        
        
	<div class="clear"></div>
	</div>