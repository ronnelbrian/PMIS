<div id="page-content">
    <div id="wrap">
        <div id="page-heading">

            <ol class="breadcrumb">
              <li><a href="#">Account</a></li>
              <li class="active">Password</li>
            </ol>

            <h1>Change Password</h1>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h4>Password Form</h4>
                        </div>
                        <div class="panel-body">
                           <form action="" class="form-horizontal row-border"  method="POST" id="setupForm">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Old Password: </label>
                                    <div class="col-sm-4">
                                       <input type="password" class="form-control" required id="old_pass">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">New Password: </label>
                                    <div class="col-sm-4">
                                       <input type="password" class="form-control" required id="new_pass">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Confirm Password: </label>
                                    <div class="col-sm-4">
                                       <input type="password" class="form-control" required id="new_pass_conf">
                                    </div>
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
                                                <button class="btn-primary btn" type="submit" name="save" id="save">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- container -->
    </div> <!-- #wrap -->
</div> <!-- page-content -->

<script type='text/javascript' src='<?php echo base_url('assets')?>/js/jquery-1.10.2.min.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/js/jqueryui-1.10.3.min.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/bootbox/bootbox.min.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/js/bootstrap.min.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/js/enquire.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/js/jquery.cookie.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/js/jquery.nicescroll.min.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/codeprettifier/prettify.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/form-toggle/toggle.min.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/js/placeholdr.js'></script>
<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/pines-notify/jquery.pnotify.min.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/form-tokenfield/bootstrap-tokenfield.min.js'></script> 
<script type="text/javascript" src="<?php echo base_url('assets');?>/js/jquery.validate.min.js"></script>
<script type='text/javascript' src='<?php echo base_url('assets')?>/js/application.js'></script>
<script src="<?php echo base_url('assets');?>/js/validation-init.js"></script>
<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/datatables/jquery.dataTables.min.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/datatables/dataTables.bootstrap.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/form-jasnyupload/fileinput.min.js'></script> 

<script>
    $("#setupForm").submit(function(e){
        $("#message").show();
        e.preventDefault();
        if($(this).valid()){
            var re = /[a-zA-Z0-9]{3,15}$/;
             if (!re.test($('#new_pass').val())){
                return  $.pnotify({
                          title: "Password Error!",
                          text: "Password must be alphanumeric only. At least 3-15 characters.",
                          type: "error"
                  });
             }
            if($("#new_pass").val() == $("#new_pass_conf").val()){
                $.ajax({
                    type: "post",
                    data: {set_password: true, 'old': $("#old_pass").val(), 'new': $("#new_pass").val()},
                    async: true,
                    dataType: "JSON",
                    success: function(data){
                        if(data == "Success")
                            $.pnotify({
                                title:"Success",
                                text: "Password has been successfully updated!",
                                type: "success"
                            });
                        else
                            $.pnotify({
                                  title: "Invalid!",
                                  text: data,
                                  type: "error"
                              });
                        $('input').val('');
                    }
                });
            }else{
                bootbox.alert('Password did not match!');
            }
        }
        $("#message").hide();
    });
</script>