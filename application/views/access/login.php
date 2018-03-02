<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Supply and Property Management System</title>
    <!-- <title>Supply and Property Management System</title> -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="MAMS">
    <meta name="author" content="SRG">

    <!-- <link href="assets/less/styles.less" rel="stylesheet/less" media="all"> -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/styles.min.css?=113');?>">
    <link rel="shortcut icon" type="image/ico" href='<?php echo base_url('assets')?>/img/favicon.ico' />
   <!--  <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600' rel='stylesheet' type='text/css'> -->
    
    <!-- <script type="text/javascript" src="assets/js/less.js"></script> -->
</head><body class="focusedform" style="vertical-align: middle; text-align: center;">

<div class="" style="display: block;" > 
	<!-- <a href=""><img src="assets/img/logo-big.png" alt="Logo" class="brand" /></a> -->
	</br></br></br>
	<div class="panel panel-primary" style="width:34%; margin-left:33%">
		<div class="panel-body" style="border-top: 2px solid rgb(127, 0, 0);">
				<div style="width:100%; text-align:center;">
					<img src="<?php echo base_url('assets')?>/img/puplogo.png" style="width:150px" alt="Dangerfield" />
				</div>
				<h5 class="text-center" style="padding-bottom:30px">(Supply and Property Management System)</h5>
				
				<div class="alert alert-success" id="successmessage" style="display:none">
					<button class="close" data-close="alert"></button>
					<span>
					<img src='<?php echo base_url('assets/img/loading.gif');?>'/>  Now redirecting... </span>
				</div>
				<div class="alert alert-danger" id="errormessage" style="display:none">
					<button class="close" data-close="alert"></button>
					<span>
					Incorrect Username/Password. </span>
				</div>
				<form action="#" class="form-horizontal" method="POST" style="margin-bottom: 0px !important;" id="loginform">
						<div class="form-group">
							<div class="col-sm-12">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user"></i></span>
									<input type="text" class="form-control" id="username" name="username" placeholder="Username">
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-12">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock"></i></span>
									<input type="password" class="form-control" id="password" name="password" placeholder="Password">
								</div>
							</div>
						</div>
					
		</div>
		<div class="panel-footer">
			<!-- <a href="extras-forgotpassword.htm" class="pull-left btn btn-link" style="padding-left:0">Forgot password?</a> -->
			<div id="message"></div> 
				<div id="actionButtons">
					<div class="pull-right">
						<button id="reset" type="button" name="reset" class="btn btn-default" onclick="$('#username').val(''); $('#password').val('')">Reset</button>
						<button type="submit" class="btn btn-primary">Log In</button>
					</div>
				</div>
			</div>
		</form>

		</div>
	</div>
 </div>
<script type='text/javascript' src='<?php echo base_url('assets')?>/js/jquery-1.10.2.min.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/js/jqueryui-1.10.3.min.js'></script>
<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/form-select2/select2.min.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/form-multiselect/js/jquery.multi-select.min.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/js/schedTable.js'></script>
<script type="text/javascript" src="<?php echo base_url('assets');?>/js/jquery.validate.min.js"></script> 
<script src="<?php echo base_url('assets');?>/js/validation-init.js"></script>

<script language="JavaScript" type='text/javascript'>
$(document).ready(function () {
	$("#loginform").on('submit',(function(e) {
		if($("#loginform").valid())
		{
			$('#errormessage').hide();
			$('#successmessage').hide();
			e.preventDefault();
			username= $('#username').val();
			password= $('#password').val();
			document.getElementById('actionButtons').style.display = "none";
	        $('#message').append("<div id='message2'></div>");
	        $('#message2').append("<img src='<?php echo base_url('assets/img/loading.gif');?>'/>");
	        $('#message2').append("    Please wait while we check your credentials...");
	        setTimeout(function(){
				$.ajax({
					url: '<?php echo base_url("access/validatecredentials"); ?>', 
					type: "POST",   
					async: true,          
					data: {username:username, password:password}, 
					dataType: 'json',
					cache: false,
					success: function(data)   
					{
						 if (data['IsError'] == 0){
						 	$('#successmessage').show();
						    $('#errormessage').hide();
						 	setTimeout(function(){
								window.location.replace(data['url'])
						    },1000);

					      }else{
					          $('#errormessage').show();
					       }
					       $('#message2').empty();
							document.getElementById('actionButtons').style.display = "block";
					},
					error: function(data)
					{
					    return  $.pnotify({
			                title: "We encountered a problem!",
	      					text: "Please reload the page and try again.",
			                type: "error"
					    });
					    $('#message2').empty();
						document.getElementById('actionButtons').style.display = "block";
					}

				});
				
			},500)
		}
		
	}));

})

</script>

</body>
</html>