<div id="page-content">
	<div id='wrap'>
		<div id="page-heading">
			<ol class="breadcrumb">
				<li>Admin Dashboard</li>
			</ol>
		</div>
		
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h4>Admin Dashboard</h4>
							<div class="options">
						
							</div>
						</div>
						<div class="panel-body">
							<div class="row">
				                <div class="col-md-12">
				                    <div class="row">
				                        
				                        <div class="col-md-4 col-xs-12 col-sm-6">
				                            <a class="info-tiles tiles-success" href="<?php echo base_url('Process/item_requests')?>">
				                                <div class="tiles-heading">No. of Pending Item Requests</div>
				                                <div class="tiles-body-alt">
				                                    <!--i class="fa fa-bar-chart-o"></i-->
				                                    <div class="text-center"><?php echo $d[1]?></div>
				                                    <small>View Item Requests</small>
				                                </div>
				                                <!-- <div class="tiles-footer">more info</div> -->
				                            </a>
				                        </div>
				                        <div class="col-md-4 col-xs-12 col-sm-6">
				                            <a class="info-tiles tiles-toyo" href="<?php echo base_url('Process/purchase_order')?>">
				                                <div class="tiles-heading">No. of Pending Purchase Orders</div>
				                                <div class="tiles-body-alt">
				                                    <!--i class="fa fa-bar-chart-o"></i-->
				                                    <div class="text-center"><?php echo $d[2]?></div>
				                                    <small>View Puchase Orders</small>
				                                </div>
				                                <!-- <div class="tiles-footer">more info</div> -->
				                            </a>
				                        </div>

				                        <div class="col-md-4 col-xs-12 col-sm-6">
				                            <a class="info-tiles tiles-danger" href="<?php echo base_url('Process/inventory')?>">
				                                <div class="tiles-heading">No. of Products in Critical Stock Level</div>
				                                <div class="tiles-body-alt">
				                                    <!--i class="fa fa-bar-chart-o"></i-->
				                                    <div class="text-center"><?php echo $d[0]?></div>
				                                    <small>View Inventory</small>
				                                </div>
				                                <!-- <div class="tiles-footer">more info</div> -->
				                            </a>
				                        </div>

				                    </div>
				                </div>
				            </div><br/><br/>
							<div class="row">
                            </div>
                            <br/><br/>
                            <div class="row">
                            </div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-info">
								  <div class="panel-heading"><h4>Products in Critical Level</h4></div>
								  <div class="panel-body">	
								  <p>Click the product to Create a Purchase Order</p>
								  <table>
								  	<tr>
								  		<td style="padding-right:10px">
								  			<b>Legend:</b>
								  		</td>
								  		<td><b>Critical</b> - Critical value set for the product. This is the minumum quanity of supply that must be present in the inventory.</td>
								  	</tr>
								  	<tr>
								  		<td></td>
								  		<td><b>Current </b>- This is the Current Stock level of a product in inventory. Current Stock increases when an item is accepted on delivery trigerred by Purchase Order.</td>
								  	</tr>
								  </table>
								 	
								  	<div class="row">
										<?php 
										foreach($c as $r)
											echo '<div class="col-md-4 col-xs-6" style="margin-top:10px">
													<button class="btn btn-brown btn-block" onclick="po_('.$r[1].')" id="c_'.$r[1].'" >'.$r[0].' <br>Critical: '.$r[2].' '.$r[4].' / Current: '.$r[3].' '.$r[4].'</button>
												</div>';
										?>
									</div>
								  </div>
								</div>
							</div>
							
						</div>
						<?php if(sizeof($p) > 0) {?>
						<div class="row">
			                <div class="col-md-12">
			                    <div class="panel panel-info">
			                        <div class="panel-body">
			                            <div class="row">
			                                <div class="col-md-12 clearfix">
			                                    <h4 class="pull-left" style="margin: 0 0 20px;">Inventory Report</h4>
			                                    <!-- <div class="btn-group pull-right">
			                                        <a href="javascript:;" class="btn btn-default btn-sm active">this week</a>
			                                    </div> -->
			                                </div>
			                                <div class="col-md-12" style="width:100%">

			                                    <div id="site-statistics" style="overflow-x:auto; overflow-y:hidden; height: 250px; padding: 0px; position: relative;"><canvas class="flot-base" width="488" height="250" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 488px; height: 250px;"></canvas><div class="flot-text" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; font-size: smaller; color: rgb(84, 84, 84);"><div class="flot-x-axis flot-x1-axis xAxis x1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; display: block;"><div style="position: absolute; max-width: 69px; top: 238px; font-style: normal; font-variant: normal; font-weight: 400; font-stretch: normal; font-size: 12px; line-height: 12.65px; font-family: 'Source Sans Pro', 'Segoe UI', 'Droid Sans', Tahoma, Arial, sans-serif; color: rgb(140, 140, 140); left: 25px; text-align: center;">S</div><div style="position: absolute; max-width: 69px; top: 238px; font-style: normal; font-variant: normal; font-weight: 400; font-stretch: normal; font-size: 12px; line-height: 12.65px; font-family: 'Source Sans Pro', 'Segoe UI', 'Droid Sans', Tahoma, Arial, sans-serif; color: rgb(140, 140, 140); left: 477px; text-align: center;">S</div><div style="position: absolute; max-width: 69px; top: 238px; font-style: normal; font-variant: normal; font-weight: 400; font-stretch: normal; font-size: 12px; line-height: 12.65px; font-family: 'Source Sans Pro', 'Segoe UI', 'Droid Sans', Tahoma, Arial, sans-serif; color: rgb(140, 140, 140); left: 99px; text-align: center;">M</div><div style="position: absolute; max-width: 69px; top: 238px; font-style: normal; font-variant: normal; font-weight: 400; font-stretch: normal; font-size: 12px; line-height: 12.65px; font-family: 'Source Sans Pro', 'Segoe UI', 'Droid Sans', Tahoma, Arial, sans-serif; color: rgb(140, 140, 140); left: 176px; text-align: center;">T</div><div style="position: absolute; max-width: 69px; top: 238px; font-style: normal; font-variant: normal; font-weight: 400; font-stretch: normal; font-size: 12px; line-height: 12.65px; font-family: 'Source Sans Pro', 'Segoe UI', 'Droid Sans', Tahoma, Arial, sans-serif; color: rgb(140, 140, 140); left: 326px; text-align: center;">T</div><div style="position: absolute; max-width: 69px; top: 238px; font-style: normal; font-variant: normal; font-weight: 400; font-stretch: normal; font-size: 12px; line-height: 12.65px; font-family: 'Source Sans Pro', 'Segoe UI', 'Droid Sans', Tahoma, Arial, sans-serif; color: rgb(140, 140, 140); left: 250px; text-align: center;">W</div><div style="position: absolute; max-width: 69px; top: 238px; font-style: normal; font-variant: normal; font-weight: 400; font-stretch: normal; font-size: 12px; line-height: 12.65px; font-family: 'Source Sans Pro', 'Segoe UI', 'Droid Sans', Tahoma, Arial, sans-serif; color: rgb(140, 140, 140); left: 402px; text-align: center;">F</div></div><div class="flot-y-axis flot-y1-axis yAxis y1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; display: block;"><div style="position: absolute; top: 222px; font-style: normal; font-variant: normal; font-weight: 400; font-stretch: normal; font-size: 12px; line-height: 12.65px; font-family: 'Source Sans Pro', 'Segoe UI', 'Droid Sans', Tahoma, Arial, sans-serif; color: rgb(140, 140, 140); left: 12px; text-align: right;">0</div><div style="position: absolute; top: 167px; font-style: normal; font-variant: normal; font-weight: 400; font-stretch: normal; font-size: 12px; line-height: 12.65px; font-family: 'Source Sans Pro', 'Segoe UI', 'Droid Sans', Tahoma, Arial, sans-serif; color: rgb(140, 140, 140); left: 0px; text-align: right;">250</div><div style="position: absolute; top: 112px; font-style: normal; font-variant: normal; font-weight: 400; font-stretch: normal; font-size: 12px; line-height: 12.65px; font-family: 'Source Sans Pro', 'Segoe UI', 'Droid Sans', Tahoma, Arial, sans-serif; color: rgb(140, 140, 140); left: 0px; text-align: right;">500</div><div style="position: absolute; top: 57px; font-style: normal; font-variant: normal; font-weight: 400; font-stretch: normal; font-size: 12px; line-height: 12.65px; font-family: 'Source Sans Pro', 'Segoe UI', 'Droid Sans', Tahoma, Arial, sans-serif; color: rgb(140, 140, 140); left: 0px; text-align: right;">750</div><div style="position: absolute; top: 2px; font-style: normal; font-variant: normal; font-weight: 400; font-stretch: normal; font-size: 12px; line-height: 12.65px; font-family: 'Source Sans Pro', 'Segoe UI', 'Droid Sans', Tahoma, Arial, sans-serif; color: rgb(140, 140, 140); left: 5px; text-align: right;">1K</div></div></div><canvas class="flot-overlay" width="488" height="250" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 488px; height: 250px;"></canvas><div class="legend"><div style="position: absolute; width: 84px; height: 51px; top: 13px; right: 13px; opacity: 0.85; background-color: rgb(255, 255, 255);"> </div><table style="position:absolute;top:13px;right:13px;;font-size:smaller;color:#545454"><tbody><tr><td class="legendColorBox"><div style="border:1px solid transparent;padding:1px"><div style="width:4px;height:0;border:5px solid rgb(166,176,194);overflow:hidden"></div></div></td><td class="legendLabel">View Count</td></tr><tr><td class="legendColorBox"><div style="border:1px solid transparent;padding:1px"><div style="width:4px;height:0;border:5px solid rgb(113,165,231);overflow:hidden"></div></div></td><td class="legendLabel">Unique Views</td></tr><tr><td class="legendColorBox"><div style="border:1px solid transparent;padding:1px"><div style="width:4px;height:0;border:5px solid rgb(170,115,194);overflow:hidden"></div></div></td><td class="legendLabel">User Count</td></tr></tbody></table></div></div>
			                                </div>
			                            </div>
			                        </div>
			                    </div>
			                </div>
			            </div>
			            <?php }?>

			            <div class="row" class="theme-light">
			                <div class="col-md-12">
			                    <div class="panel panel-info">
			                        <div class="panel-body">
			                            <div class="row">
			                                <div class="col-md-12 clearfix">
			                                    <h4 class="pull-left" style="margin:20px;">Office's Budget Allocation</h4>
			                                   <div class="btn-group pull-right">
			                                        <select id="year_" class="form-control" style="width:100px; margin-right:10px" onchange="loadBudget()"><?php if(sizeof($year_) == 0) echo '<option value="'.date('Y').'">'.date('Y').'</option>'; $ctr = 0; foreach($year_ as $r) { ($ctr == 0)?$s = ' selected':$s=""; echo '<option value="'.$r.'"'.$s.'>'.$r.'</option>'; $ctr++;}?></select>
			                                    </div>
			                                </div>
			                                <div class="col-md-12" style="width:100%">
			                                     <div class="col-md-12 col-lg-12">
							                        <div class="panel panel-primary">
							                            <div class="panel-heading">
							                                <h4></h4>
							                                
							                            </div>
							                            <div class="panel-body">
							                              <div id="chart"></div>

							                            </div>
							                        </div>
							                    </div>
			                                </div>
			                            </div>
			                        </div>
			                    </div>
			                </div>
			            </div>
					</div>
				</div>
			</div>

		</div> <!-- container -->
	</div> <!--wrap -->
</div> <!-- page-content -->

<!-- default script -->
<script type='text/javascript' src='<?php echo base_url('assets')?>/js/jquery-1.10.2.min.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/js/jqueryui-1.10.3.min.js'></script>
<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/form-select2/select2.min.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/form-multiselect/js/jquery.multi-select.min.js'></script>
<script type='text/javascript' src='<?php echo base_url('assets')?>/js/custom.js'></script>  
	

<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/easypiechart/jquery.easypiechart.min.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/sparklines/jquery.sparklines.min.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/form-toggle/toggle.min.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/fullcalendar/fullcalendar.min.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/form-daterangepicker/daterangepicker.min.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/form-daterangepicker/moment.min.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/charts-flot/jquery.flot.min.js'></script> 

<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/charts-flot/jshashtable-2.1.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/charts-flot/jquery.flot.axislabels.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/charts-flot/jquery.numberformatter-1.2.3.min.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/pulsate/jQuery.pulsate.min.js'></script> 

<script type='text/javascript' src='<?php echo base_url('assets')?>/js/shieldui-all.min.js'></script> 


<script type="text/javascript">
	function loadBudget()
	{
		$.ajax
        ({ type:"POST",
           async: true,
           url:"<?php echo base_url('Admin/admin_dashboard')?>",
           data:{year_:$('#year_').val(), loadBudget:"true"},
           dataType: 'json',
           cache: false,
           success: function(data)
            {
              if (data['mes'] == "Success")
              {
                $("#chart").shieldChart({
		            theme: "bootstrap",
		            isInverted: true,
		            axisX: {
		                categoricalValues: data[0]
		            },
		            axisY: {
		                title: {
		                    text: "Philippine Peso (Php)"
		                }
		            },
		            primaryHeader: {
		                text: "Office's Budget Monitoring"
		            },
		            dataSeries: [ {
		                seriesType: "bar",
		                collectionAlias: "Remaining Budget",
		                data: data[3]
		            }, {
		                seriesType: "bar",
		                collectionAlias: "Consumed Budget",
		                data: data[2]
		            },{
		                seriesType: "bar",
		                collectionAlias: "Total Budget Allocation",
		                data: data[1]
		            }]
		        });
              }
              else
                alerts(data['mes'],'w');
             },
             error: function(data)
             {
                alerts('An error occured. Please reload the page and try again.','e');
             }

    });
		
	}
 
    $(document).ready(function () {
    	loadBudget();
    	<?php 
		foreach($c as $r)
			echo '$("#c_'.$r[1].'").pulsate();';
		?>

    });

	function showTooltip(x, y, contents) {
        $('<div id="tooltip">' + contents + '</div>').css({
            position: 'absolute',
            display: 'none',
            top: y + 5,
            left: x + 5,
            border: '1px solid #fdd',
            padding: '2px',
            'background-color': '#dfeffc',
            opacity: 0.80
        }).appendTo("body").fadeIn(200);
    }

<?php if(sizeof($p) > 0) {?>
	var plot_statistics = $.plot($("#site-statistics"), [
<?php $ctr = 0; foreach(array_reverse($p) as $r) { if($ctr == 0) echo '{data:'.json_encode($r[1]).',label:"Remaining Stock/s"}'; $ctr++;}?>
	], {
        series: {
            lines: {
                show: true,
                lineWidth: 1.5,
                fill: 0.05
            },
            points: {
                show: true
            },
            shadowSize: 0
        },
        grid: {
            labelMargin: 10,
            hoverable: true,
            clickable: true,
            borderWidth: 0
        },
        colors: ["#aa73c2"],
        xaxis: {
            tickColor: "transparent",
            ticks: <?php $ctr = 0; foreach(array_reverse($p) as $r){ if($ctr == 0) echo json_encode($r[2]);$ctr++;} ?>,
            tickDecimals: 0,
            autoscaleMargin: 0,
            font: {
                color: '#8c8c8c',
                size: 12
            }
        },
        yaxis: {
            ticks: 4,
            tickDecimals: 0,
            tickColor: "#e3e4e6",
            font: {
                color: '#8c8c8c',
                size: 12
            },
            tickFormatter: function (val, axis) {
                if (val>999) {return (val/1000) + "K";} else {return val;}
            }
        },
        legend : {
            labelBoxBorderColor: 'transparent'
        }
    });
 	var previousPoint = null;
	$("#site-statistics").bind("plothover", function (event, pos, item) {
	    $("#x").text(pos.x.toFixed(2));
	    $("#y").text(pos.y.toFixed(2));
	    if (item) {
	        if (previousPoint != item.dataIndex) {
	            previousPoint = item.dataIndex;

	            $("#tooltip").remove();
	            var x = item.datapoint[0].toFixed(2),
	                y = item.datapoint[1].toFixed(2);

	            showTooltip(item.pageX, item.pageY-7, item.series.label + ": " + Math.round(y));

	        }
	    } else {
	        $("#tooltip").remove();
	        previousPoint = null;
	    }

    });
<?php }?>
    function po_(id)
    {
    	window.location.replace('<?php echo base_url("Process/purchase_order")?>'+'?id='+id);
    }
</script>

<script>
</script>