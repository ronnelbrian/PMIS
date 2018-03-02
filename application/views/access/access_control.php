<div id="page-content">
	<div id='wrap'>
		<div id="page-heading">
			<ol class="breadcrumb">
                <li>Access Control</li>
			</ol>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-md-12">

                    <?php if(isset($user_id)){ ?>
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <h4>Access Control Form</h4>
                            <div class="options">
                              <a class="panel-collapse" href="#">
                                <i class="fa fa-chevron-up"></i></a>
                            </div>
                        </div>

                        <div class="panel-body" id="divstyle" style="display : none;">
                            <!-- here goes the body -->
                             <form action="" class="form-horizontal row-border"  method="POST" id="setupForm">
                                <input type="hidden" id="id" name="id" value="<?php echo($user_id);?>"/>
                                <input type="hidden" id="save_type" name="save_type">
								<div class="form-group">
                                    <div class="col-md-3"><b>Name:</b></div>
                                    <div class="col-md-9"><?php echo($user[0][3].", ".$user[0][1]." ".$user[0][2]);?></div>
                                </div>
								<div class="form-group">
                                    <div class="col-md-3"><b>Username:</b></div>
                                    <div class="col-md-9"><?php echo($user[0][28]);?></div>
                                </div>
								<div class="form-group">
                                    <div class="col-md-3"><b>User Type:</b></div>
                                    <div class="col-md-9"><?php echo($user[0][27]);?></div>
                                </div>
                                <div class="form-group">
                                <?php
                                	$user_type = "";
                                	foreach($access as $i => $a){
                                		if($user_type != $a["USER_TYPE"]){
	                                		echo('
	                                			<div class="panel panel-inverse">
							                        <div class="panel-heading">
							                            <h4>'.$a["USER_TYPE"].'</h4>
							                            <div class="options">
							                              <a class="panel-collapse" href="#">
							                                <i class="fa fa-chevron-up"></i></a>
							                            </div>
							                        </div>
							                        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered datatables">
							                        <thead>
							                        	<tr>
							                        		<th width="70%">Transaction Name</th>
							                        		<th width="10%" style="text-align:center;">No Access<br/><input type="radio" name="header" value="none" /></th>
							                        		<th width="10%" style="text-align:center;">R<br/><input type="radio" name="header" value="r" /></th>
							                        		<th width="10%" style="text-align:center;">R/W<br/><input type="radio" name="header" value="r/w" /></th>
							                        	</tr>
							                        </thead>
							                        <tbody>
	                                		');
	                                		$user_type = $a["USER_TYPE"];
	                                	}
	                                	echo('<tr>
	                                		<td>'.$a["NAVIGATION_NAME"].'</td>');
	                                	$chk = (!isset($a["ACCESS"]))?"checked":"";
	                                	echo('<td style="text-align:center;"><input type="radio" name="access['.$a["ID"].']" value="none" '.$chk.'/></td>');
	                                	$chk = ($a["ACCESS"] == "r")?"checked":"";
	                                	echo('<td style="text-align:center;"><input type="radio" name="access['.$a["ID"].']" value="r" '.$chk.'/></td>');
	                                	$chk = ($a["ACCESS"] == "r/w")?"checked":"";
	                                	echo('<td style="text-align:center;"><input type="radio" name="access['.$a["ID"].']" value="r/w" '.$chk.'/></td>');
	                                	echo('</tr>');

                                		if((!isset($access[$i+1]["USER_TYPE"]) || $a["USER_TYPE"] != $access[$i+1]["USER_TYPE"]) && $user_type != ""){
                                			echo('
                                				</tbody>
                                				</table>
                                				</div>
                                			');
                                		}
                                	}
                                ?>
                                </div>
                                <div class="panel-footer">
                                    <div class="row">
                                        <div class="col-lg-offset-2 col-lg-10">
											<div id="message" style="display:none">
												<div id='message2'></div>
												<img src='<?php echo base_url('assets/img/loading.gif');?>'/>
													Please wait while we process your request...
											</div>
                                            <div class="btn-toolbar">
                                                 <?php 

								                  if ($accesses == 'r/w'){
								                  
								                  ?> 
                                                <button class="btn-primary btn" type="submit" name="save" id="save">Save</button>
                                                   <?php } ?>
                                                <a class="btn-default btn" href="<?php echo(base_url('access/access_control'));?>">Cancel</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                             </form>
                        </div>
                    </div>
                    <?php } ?>

                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <h4>User/s</h4>
                            <div class="options">
                                      <a class="panel-collapse" href="#">
                                        <i class="fa fa-chevron-down"></i></a>
                            </div>
                        </div>
                        <div class="panel-body collapse in">
                            <table cellpadding="0" cellspacing="0" border="0" id="data_table" class="table table-striped table-bordered datatables">
                                <thead>
                                    <tr>
                                        <th style="width : 50%">Name</th>
                                        <th style="width : 15%">Username</th>
                                        <th style="width: 25%">User Type</th>
										<th style="width : 10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
				</div>
			</div>
		</div> <!-- container -->
	</div> <!--wrap -->
</div> <!-- page-content -->
<form method="post" id="access_form">
<input type="hidden" name="user_id" id="user_id"/>
</form>
<div class="modal fade modals" id="loadingModal" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="text-align:center; margin-top:200px">
        <img style="width:50px" src='<?php echo base_url('assets/img/loading_apple.gif');?>'/> 
        <h1 style="color:white" id="message">Please Wait</h1>
    </div>
</div>
<!-- default script -->
<script type='text/javascript' src='<?php echo base_url('assets')?>/js/jquery-1.10.2.min.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/js/jqueryui-1.10.3.min.js'></script>
<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/form-select2/select2.min.js'></script> 

<script language="JavaScript" type='text/javascript'>
$(document).ready(function(){
	if($("#id").val() != ""){
		$("#divstyle").slideDown("slow");
	}
	//data table
	$('#data_table').dataTable( {
  	 	"sDom": "<'row'<'col-xs-6'l><'col-xs-6'f>r>t<'row'<'col-xs-6'i><'col-xs-6'p>>",
        "sPaginationType": "bootstrap",
        "oLanguage": {
            "sLengthMenu": "_MENU_ records per page",
            "sSearch": ""
        },
        "processing": true,
        "serverSide": true,
        "sAjaxSource": '../access/loadAccessControl',
        "deferLoading": 10
    });

    $("input[name='header']").on('change', function(){
    	if($(this).prop("checked")){
	    	var table = $(this).parent().parent().parent().parent();
	    	var val = $(this).attr('value');
	    	table.find("input").each(function(){
	    		if($(this).attr('value')== val)
	    			$(this).prop("checked", true);
	    	});
	    }
    });
});

$("#setupForm").submit(function(e){
	e.preventDefault();
	if($(this).valid()){
		$("#loadingModal").modal('show');
		$.ajax({
			type: "post",
			data: $(this).serializeArray(),
			dataType: "JSON",
			success: function(data){
				if(data == "Success")
					$.pnotify({
						title: "Success!",
						text: "Successfully saved Access Control",
						type: "success"
					});
				$("#loadingModal").modal('hide');
			}
		});
	}
});
$("[type='reset']").click(function(){
	$("#id").val('');
});

function Success(){
	$('[type="text"], [type="hidden"], [type="number"], [type="email"]').each(function(){
		$(this).val('');
	});
	
	$('#data_table').dataTable().fnClearTable();
	$('#data_table').dataTable().fnDraw();
	$('#data_table').dataTable().fnDestroy();
	$('#data_table').dataTable( {
		"serverSide": true,
		"sAjaxSource": '../access/loadAccessControl',
		"deferLoading": 10
	});
}

function Error(){
	$.pnotify({
		title: "Uh Oh!",
		text: "Something really terrible happened. Please check the data you have submitted..",
		type: "error"
	});
}
function access(id){
	$("#user_id").val(id);
	$("#access_form").submit();
}
</script>