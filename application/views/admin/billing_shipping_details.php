<div id="page-content">
  <div id='wrap'>
    <div id="page-heading">
      <ol class="breadcrumb">
        <li>Administrator</li>
          <li>Billing/Shipping Details</li>
      </ol>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-inverse">
              <div class="panel-heading">
                  <h4>Billing/Shipping Details Form</h4>
              </div>
              <div class="panel-body" id="divstyle">
                   <form action="" class="form-horizontal row-border"  method="POST" id="spmsForm">
                      <input type="hidden" id="id" name="id"/>
                      <input type="hidden" id="act" name="act" value="add"/>
                      <h3>Billing Details</h3>
                      <div class="form-group">
                          <label class="col-sm-2 control-label">Billing Company Name<span style="color:red">*</span></label>
                          <div class="col-sm-2">
                             <input type="text" class="form-control" name="b_company" id="b_company" required value="<?php if(isset($bs[0][4])) echo $bs[0][4];?>">
                          </div>
                          <label class="col-sm-2 control-label">Billing Address<span style="color:red">*</span></label>
                          <div class="col-sm-6">
                             <input type="text" class="form-control" name="b_address" id="b_address" value="<?php if(isset($bs[0][5])) echo $bs[0][5];?>">
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-2 control-label">Billing Tel. No.<span style="color:red">*</span></label>
                          <div class="col-sm-2">
                             <input type="text" class="form-control" name="b_telno" id="b_telno" required value="<?php if(isset($bs[0][6])) echo $bs[0][6];?>">
                          </div>
                          <label class="col-sm-2 control-label">Billing Mobile No.</label>
                          <div class="col-sm-2">
                             <input type="text" class="form-control" name="b_mobile" id="b_mobile" value="<?php if(isset($bs[0][7])) echo $bs[0][7];?>">
                          </div>
                      </div>
                      <hr>
                      <h3>Shipping Details</h3>
                      <div class="form-group">
                          <label class="col-sm-2 control-label">Shipping Company Name<span style="color:red">*</span></label>
                          <div class="col-sm-2">
                             <input type="text" class="form-control" name="s_company" id="s_company" required value="<?php if(isset($bs[0][0])) echo $bs[0][0];?>">
                          </div>
                          <label class="col-sm-2 control-label">Shipping Address<span style="color:red">*</span></label>
                          <div class="col-sm-6">
                             <input type="text" class="form-control" name="s_address" id="s_address" required value="<?php if(isset($bs[0][1])) echo $bs[0][1];?>">
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-2 control-label">Shipping Tel. No.<span style="color:red">*</span></label>
                          <div class="col-sm-2">
                             <input type="text" class="form-control" name="s_telno" id="s_telno" required value="<?php if(isset($bs[0][2])) echo $bs[0][2];?>">
                          </div>
                          <label class="col-sm-2 control-label">Shipping Mobile No.</label>
                          <div class="col-sm-2">
                             <input type="text" class="form-control" name="s_mobile" id="s_mobile" value="<?php if(isset($bs[0][3])) echo $bs[0][3];?>">
                          </div>
                      </div>
                      <?php if($w_ == 1) { ?>
                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <div id="message"></div> 
                                    <div class="btn-toolbar" id = "actionButtons">
                                        <button class="btn-primary btn" type="submit" name="save" id="save">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                      <?php }?>
                   </form>
              </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
<script type='text/javascript' src='<?php echo base_url('assets')?>/js/jquery-1.10.2.min.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/js/jqueryui-1.10.3.min.js'></script>
<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/form-select2/select2.min.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/form-multiselect/js/jquery.multi-select.min.js'></script>
<script type='text/javascript' src='<?php echo base_url('assets')?>/js/custom.js'></script>   
<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/form-typeahead/typeahead.min.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/form-select2/select2.min.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/form-autosize/jquery.autosize-min.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/form-colorpicker/js/bootstrap-colorpicker.min.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/form-stepy/jquery.stepy.js'></script> 

<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/jqueryui-timepicker/jquery.ui.timepicker.min.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/form-daterangepicker/daterangepicker.min.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/form-datepicker/js/bootstrap-datepicker.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/form-daterangepicker/moment.min.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/form-jasnyupload/fileinput.min.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/jqueryui-timepicker/jquery.ui.timepicker.min.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/demo/demo-formwizard.js'></script> 

<script language="JavaScript" type='text/javascript'>

function alerts(m, s)
{
  if(s == 'e')
    $.pnotify({
              title:"Error",
              text: m,
              type: "error"
    });
  else if(s == 'w')
    $.pnotify({
              title:"Warning",
              text: m,
              type: "info"
    });
  else if(s == 's')
    $.pnotify({
              title:"Success",
              text: m,
              type: "success"
    });
}


$(document).ready(function(){
  <?php if($w_ == 1) { ?>
  $("#spmsForm").on('submit',(function(e) {
    e.preventDefault();
    
    $('#actionButtons').hide();
    $('#message').append("<div id='message2'></div>");
    $('#message2').append("<img src='<?php echo base_url('assets/img/loading.gif');?>'/>");
    $('#message2').append("    Processing...");
    $.ajax({
      url: '<?php echo base_url("Admin/billing_shipping_details"); ?>', 
      type: "POST",        
      data: new FormData(this), 
      dataType: 'json',
      contentType: false,     
      processData: false,  
      cache: false, 
      success: function(data)   
      {
        if(data['mes'] == 'Success')          
          alerts('Billing/Shipping Detail has been updated.','s');          
        else
          alerts(data['mes'],'s');
        $('#message').empty();
        $('#actionButtons').show();
      },
      error: function(data)
      {
        $('#message').empty();
        $('#actionButtons').show();
        alerts('An error occured. Please reload the page and try again.','e');
      }

    });
    
    }));
  <?php }?>
});

</script>