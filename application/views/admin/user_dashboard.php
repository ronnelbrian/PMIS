<div id="page-content">
	<div id='wrap'>
		<div id="page-heading">
			<ol class="breadcrumb">
				<li>User Dashboard</li>
			</ol>
		</div>
		
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h4>User Dashboard</h4>
							<div class="options">
							
							</div>
						</div>
						<div class="panel-body">
							<div class="row">
				                <div class="col-md-12">
				                    <div class="row">
				                    <h2>Welcome <?php echo $this->session->userdata('NAME').'.';?></h2>
				                    <h4>You are logged in as <b><?php echo $this->session->userdata('USERTYPE').'.'?></b></h4>
				                    </div>
				                </div>
				            </div><br/><br/>
							<div class="row">
                            </div>
                            <br/><br/>
                            <div class="row">
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
<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/charts-flot/jquery.flot.min.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/charts-flot/jquery.flot.resize.min.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/charts-flot/jquery.flot.orderBars.min.js'></script> 

<script>
</script>