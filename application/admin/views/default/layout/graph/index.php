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
                renderTo: 'weeklytransaction',
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
                    text: 'Amount (<?php echo mb_convert_encoding($site_setting->currency_symbol, 'UTF-8', 'HTML-ENTITIES'); ?>)'
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
                        this.x +': '+'<?php echo mb_convert_encoding($site_setting->currency_symbol, 'UTF-8', 'HTML-ENTITIES'); ?>' +this.y;
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
                name: 'Escrow',
                data: [<?php if($weekly_escrow) {  foreach($weekly_escrow as $date => $fees) { echo $fees.','; } } ?>]
            }, {
                name: 'Total Pay',
                data: [<?php if($weekly_runner_pay) {  foreach($weekly_runner_pay as $date => $fees) { echo $fees.','; } } ?>]
            }, {
                name: 'Commission',
                data: [<?php if($weekly_earning) {  foreach($weekly_earning as $date => $fees) { echo $fees.','; } } ?>]
            }]
        });
		
		
		
		chart1 = new Highcharts.Chart({
            chart: {
                renderTo: 'monthlytransaction',
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
                    text: 'Amount (<?php echo mb_convert_encoding($site_setting->currency_symbol, 'UTF-8', 'HTML-ENTITIES'); ?>)'
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
                         this.x +': '+'<?php echo mb_convert_encoding($site_setting->currency_symbol, 'UTF-8', 'HTML-ENTITIES'); ?>' +this.y;
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
                name: 'Escrow',
                data: [<?php if($monthly_escrow) {  foreach($monthly_escrow as $date => $fees) { echo $fees.','; } } ?>]
            }, {
                name: 'Total Pay',
                data: [<?php if($monthly_runner_pay) {  foreach($monthly_runner_pay as $date => $fees) { echo $fees.','; } } ?>]
            }, {
                name: 'Commission',
                data: [<?php if($monthly_earning) {  foreach($monthly_earning as $date => $fees) { echo $fees.','; } } ?>]
            }]
        });
		
		
		
		
		
		
		chart2 = new Highcharts.Chart({
            chart: {
                renderTo: 'yearlytransaction',
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
                    text: 'Amount (<?php echo mb_convert_encoding($site_setting->currency_symbol, 'UTF-8', 'HTML-ENTITIES'); ?>)'
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
                        this.x +': '+'<?php echo mb_convert_encoding($site_setting->currency_symbol, 'UTF-8', 'HTML-ENTITIES'); ?>' +this.y;
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
                name: 'Escrow',
                data: [<?php if($yearly_escrow) {  foreach($yearly_escrow as $date => $fees) { echo $fees.','; } } ?>]
            }, {
                name: 'Total Pay',
                data: [<?php if($yearly_runner_pay) {  foreach($yearly_runner_pay as $date => $fees) { echo $fees.','; } } ?>]
            }, {
                name: 'Commission',
                data: [<?php if($yearly_earning) {  foreach($yearly_earning as $date => $fees) { echo $fees.','; } } ?>]
            }]
        });
		
		
		


		
		chart3 = new Highcharts.Chart({
            chart: {
                renderTo: 'weeklytransactionbar',
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
                    text: 'Amount (<?php echo mb_convert_encoding($site_setting->currency_symbol, 'UTF-8', 'HTML-ENTITIES'); ?>)'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                formatter: function() {
                        return this.x +': '+'<?php echo mb_convert_encoding($site_setting->currency_symbol, 'UTF-8', 'HTML-ENTITIES'); ?>' +this.y;
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
                name: 'Escrow',
                data: [<?php if($weekly_escrow) {  foreach($weekly_escrow as $date => $fees) { echo $fees.','; } } ?>]
            }, {
                name: 'Total Pay',
                data: [<?php if($weekly_runner_pay) {  foreach($weekly_runner_pay as $date => $fees) { echo $fees.','; } } ?>]
            }, {
                name: 'Commission',
                data: [<?php if($weekly_earning) {  foreach($weekly_earning as $date => $fees) { echo $fees.','; } } ?>]
            }]
        });
		
		
		
		chart4 = new Highcharts.Chart({
            chart: {
                renderTo: 'monthlytransactionbar',
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
                    text: 'Amount (<?php echo mb_convert_encoding($site_setting->currency_symbol, 'UTF-8', 'HTML-ENTITIES'); ?>)'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                formatter: function() {
                        return this.x +': '+'<?php echo mb_convert_encoding($site_setting->currency_symbol, 'UTF-8', 'HTML-ENTITIES'); ?>' +this.y;
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
                name: 'Escrow',
                data: [<?php if($monthly_escrow) {  foreach($monthly_escrow as $date => $fees) { echo $fees.','; } } ?>]
            }, {
                name: 'Total Pay',
                data: [<?php if($monthly_runner_pay) {  foreach($monthly_runner_pay as $date => $fees) { echo $fees.','; } } ?>]
            }, {
                name: 'Commission',
                data: [<?php if($monthly_earning) {  foreach($monthly_earning as $date => $fees) { echo $fees.','; } } ?>]
            }]
        });
		
		
		
		
		
		
		chart5 = new Highcharts.Chart({
            chart: {
                renderTo: 'yearlytransactionbar',
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
                    text: 'Amount (<?php echo mb_convert_encoding($site_setting->currency_symbol, 'UTF-8', 'HTML-ENTITIES'); ?>)'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                formatter: function() {
                        return this.x +': '+'<?php echo mb_convert_encoding($site_setting->currency_symbol, 'UTF-8', 'HTML-ENTITIES'); ?>' +this.y;
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
                name: 'Escrow',
                data: [<?php if($yearly_escrow) {  foreach($yearly_escrow as $date => $fees) { echo $fees.','; } } ?>]
            }, {
                name: 'Total Pay',
                data: [<?php if($yearly_runner_pay) {  foreach($yearly_runner_pay as $date => $fees) { echo $fees.','; } } ?>]
            }, {
                name: 'Commission',
                data: [<?php if($yearly_earning) {  foreach($yearly_earning as $date => $fees) { echo $fees.','; } } ?>]
            }]
        });
		
		
		
		
		

		
    });
    
});
		</script>
        

    
    
		<div class="column half fl">
		
			<div class="box">
			<h2 class="box-header">Weekly Average Transactions(Line)</h2>
			<div class="box-content">
				
                
                <div id="weeklytransaction" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
                
			</div>
			</div>
			
		</div>
		
		
        
        <div class="column half fr">
		
			<div class="box">
			<h2 class="box-header">Weekly Average Transactions(Bar)</h2>
			<div class="box-content">
				
                
                <div id="weeklytransactionbar" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
                
			</div>
			</div>
			
		</div>
        
        
		
		
       <div class="column half fl">
		
			<div class="box">
			<h2 class="box-header">Monthly Average Transactions(Line)</h2>
			<div class="box-content">
				
                  <div id="monthlytransaction" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
                
			</div>
			</div>
			
		</div>
       
       
       <div class="column half fr">
		
			<div class="box">
			<h2 class="box-header">Monthly Average Transactions(Bar)</h2>
			<div class="box-content">
				
                  <div id="monthlytransactionbar" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
                
			</div>
			</div>
			
		</div> 
        
        
        
        
        
        <div class="column half fl">
		
			<div class="box">
			<h2 class="box-header">Yearly Average Transactions(Line)</h2>
			<div class="box-content">
				
                  <div id="yearlytransaction" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
                
			</div>
			</div>
			
		</div>
        
        
        
        <div class="column half fr">
		
			<div class="box">
			<h2 class="box-header">Yearly Average Transactions(Bar)</h2>
			<div class="box-content">
				
                  <div id="yearlytransactionbar" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
                
			</div>
			</div>
			
		</div>
        
        
        
        
        
        
        
	<div class="clear"></div>
	</div>