<div id="content" align="center" style="width: 1032px;">
	<div align="left" class="column">
		<div class="box">
			<h2 class="box-header"><?php echo $newsletter->subject; ?>r</h2> 
			<div class="box-content">
			<?php 
/*$CI =& get_instance();	
$base_url = $CI->config->slash_item('base_url_site');
$base_path = $CI->config->slash_item('base_path');*/

if($total_send==0 || $total_send=='0' || $total_send=='')
{
	$total_remain_send_perc=100;
	$total_open_perc=100;
}
else
{
	$total_remain_send_perc=($total_send*100)/(100*$total_subscription);
	$total_open_perc=($total_read*100)/(100*$total_send);
}


if($total_remain_send_perc==1) { $total_remain_send_perc=0.1; } 

if($total_open_perc==1) { $total_open_perc=0.1; } 

if($total_remain_send_perc==100) { $total_subscribe=0.1; } else { $total_subscribe=100; } 

if($total_open_perc==100) { $total_send=0.1; } else { $total_send=100; } 
	 
	 

?>
<div class="box-content box-table" style="border: 1px solid #D8D8D8; border-radius:5px; ">
<table class="tablebox">
<tbody class="openable-tbody">
<!--<table border="0" cellpadding="2" cellspacing="2" width="100%">-->
<!--<tr>
<td align="left" valign="top" colspan="2" style="font-size:26px; height:40px; color:#114A75; border-bottom:1px solid #999999; font-weight:bold;"><?php echo $newsletter->subject; ?></td>
</tr>-->

<tr>
	<td style="width:150px; text-align:left;">Job Start Date </td> <td style="text-align:left;">: <?php  echo date($site_setting->date_format,strtotime($job->job_start_date));  ?></td>
</tr>


<tr>
<td style="text-align:left;">Job Create Date </td> <td style="text-align:left;">: <?php echo date($site_setting->date_format,strtotime($job->job_date));  ?></td>
</tr>


<tr>
<td style="text-align:left;">Total Subscriber </td> <td style="text-align:left;">: <?php echo $total_subscription; ?></td>
</tr>


<tr>
<td style="text-align:left;">Total Send </td> <td style="text-align:left;">: <?php echo $total_send; ?></td>
</tr>


<tr>
<td style="text-align:left;">Total Open </td> <td style="text-align:left;">: <?php echo $total_read; ?></td>
</tr>

<tr>
<td style="text-align:left;">Total Fail </td> <td style="text-align:left;">: <?php echo $total_fail; ?></td>
</tr>


 



<!-- 1. Add these JavaScript inclusions in the head of your page -->

<script type="text/javascript" src="<?Php echo base_url().getThemeName(); ?>/js/jquery.min.js"></script>

<script type="text/javascript" src="<?Php echo base_url().getThemeName(); ?>/js/highcharts.js"></script>


<!-- 1b) Optional: the exporting module -->
<script type="text/javascript" src="<?Php echo base_url().getThemeName(); ?>/js/modules/exporting.js"></script>

<script type="text/javascript">
var chart; var chart2;
			$(document).ready(function() {
				chart = new Highcharts.Chart({
					chart: {
						renderTo: 'pie',
						plotBackgroundColor: null,
						plotBorderWidth: null,
						plotShadow: false
					},
					title: {
						text: ''
					},
					tooltip: {
						formatter: function() {
							return '<b>'+ this.point.name +'</b> : '+ this.y+ ' %' ;
						}
					},
					plotOptions: {
						pie: {
							allowPointSelect: true,
							cursor: 'pointer',
							dataLabels: {
								enabled: false
							},
							showInLegend: true
						}
					},
				    series: [{
						type: 'pie',
						name: 'Browser share',
						
						
						data: [
						
									['Total Subscriber ', <?php echo $total_subscribe; ?>    ],
									['Remain Send',      <?php echo $total_remain_send_perc; ?>],
						
						]
						
						
						
					}],
						navigation: {
        buttonOptions: {
            enabled: false
        }
    }	
	
				});
				
				
				
				
				
				chart2 = new Highcharts.Chart({
					chart: {
						renderTo: 'pie2',
						plotBackgroundColor: null,
						plotBorderWidth: null,
						plotShadow: false
					},
					title: {
						text: ''
					},
					tooltip: {
						formatter: function() {
							return '<b>'+ this.point.name +'</b> : '+ this.y+ ' %' ;
						}
					},
					plotOptions: {
						pie: {
							allowPointSelect: true,
							cursor: 'pointer',
							dataLabels: {
								enabled: false
							},
							showInLegend: true
						}
					},
				    series: [{
						type: 'pie',
						name: 'Browser share',
						
						
						data: [
						
									['Total Send ',<?php echo $total_send; ?> ],
									['Remain Open',      <?php echo $total_open_perc; ?>],
						
						]
						
						
						
					}],
						navigation: {
        buttonOptions: {
            enabled: false
        }
    }	
	
				});
				
				
				
				
				
			});
		
			</script>
			
	<tr><td align="left" valign="top" colspan="2">
		<table border="0" cellpadding="3" cellspacing="3" width="100%">
		<tr>
		<td align="center" valign="top">	
			 <div id="pie" style="width:500px;"></div>
		</td>
		<td align="center" valign="top">
		<div id="pie2" style="width:500px;"></div>
		</td>	
		</tr>
		</table> 
			 
		</td></tr>
		</tbody>
	</table>
    </div>
  </div>
    </div>
    </div>
</div>
    