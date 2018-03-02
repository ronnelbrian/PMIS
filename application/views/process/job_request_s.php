<div id="page-content">
  <div id='wrap'>
    <div id="page-heading">
      <ol class="breadcrumb">
          <li>Job Request</li>
      </ol>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
        	  <div class="panel panel-inverse">
              <div class="panel-heading">
                  <h4>Job Request Form</h4>
                  <div class="options">
                    <a class="panel-collapse" href="#">
                      <i class="fa fa-chevron-down"></i></a>
                  </div>
              </div>
              <div class="panel-body" id="divstyle" style="display:block;">


               

                   <form action="" class="form-horizontal row-border"  method="POST" id="job_request_form">
                      <input type="hidden"  name="add_job_request" id="add_job_request"/>
                      <input type="hidden" id="act" name="act" value="add"/>
                      <div class="form-group">
                          <div class="col-md-2" style="text-align:right; padding-top:8px;">
                            <label><b>Office/Section:</b></label>
                          </div>
                          <div class="col-md-4">
                            <select class="js-example-basic-single form-control" id="office" name="office" required>
                              <option value="">Select Requesting Office</option>
                              <?php foreach($o as $r) echo '<option value="'.$r[0].'">'.$r[1].'</option>';?>
                            </select>
                          </div>
                          <div class="col-md-2" style="text-align:right; padding-top:8px;">
                            <label><b>Fund Cluster</b></label>
                          </div>
                          <div class="col-md-4">
                            <select class="populate" id="fund_cluster" name="fund_cluster" style="width:100%" >
                              <?php foreach($fund_cluster as $r) echo '<option value="'.$r[0].'">'.$r[0].'</option>';?>
                            </select>
                          </div>    
                        </div>
                      <div id="divItems">
                        <input type="hidden" id="ctr" value = "1"/> 
                        <div class="form-group" id="row_1">
                          <div class="col-md-1" style="text-align:right; padding-top:8px;">
                            <label><b>Item Description</b></label>
                          </div>
                          <div class="col-md-2">
                              <textarea class="form-control" rows="2" cols="6" id="item_desc" name="item_desc" required></textarea>
                           </div>  
                          <div class="col-md-1" style="text-align:right; padding-top:8px;">
                            <label><b>Qty</b></label>
                          </div>
                          <div class="col-md-1" id="ctp_1" >
                           <input type="number" class="form-control" name="qty" id="qty" min = "0"  onchange="$('#total_cost').val(($(this).val() * $('#unit_cost').val()).toFixed(2))" placeholder="" required>
                          </div>
                          <div class="col-md-1" style="text-align:right; padding-top:8px;">
                            <label><b>Unit Cost</b></label>
                          </div>
                          <div class="col-md-1" id="ctp_2" >
                            <input type="number" class="form-control" name="unit_cost" min = "0" id="unit_cost" onchange="$('#total_cost').val(($(this).val() * $('#qty').val()).toFixed(2))" placeholder="" required>
                          </div>
                            <div class="col-md-1" style="text-align:right; padding-top:8px;">
                            <label><b>Total Cost</b></label>
                          </div>
                          <div class="col-md-1" id="ctp_2" >
                             <input type="text" class="form-control" name="total_cost" id="total_cost" placeholder="" readonly="readonly">
                          </div>
                             <div class="col-md-1" style="text-align:right; padding-top:8px;">
                            <label><b>Purpose:</b></label>
                          </div>
                          <div class="col-md-1">
                              <textarea class="form-control" rows="2" cols="10"  id="item_desc" required></textarea>
                           </div>  

                            <div class="col-md-1" id="btn_1" >
                            <center><input type="button" class="btn btn-primary" onClick="addNew(); $(this).hide()" id="btnAdd_1" name="btnAdd_[]" value="+"></input></center>
                          </div>  
                        </div><br>
                        
                      </div>
                      <?php if($w_ == 1) { ?>
                      <div class="panel-footer">
                          <div class="row">
                              <div class="col-lg-offset-2 col-lg-10">
                                  <div id="message"></div> 
                                  <div class="btn-toolbar" id = "actionButtons">
                                      <button class="btn-primary btn" type="submit" name="save" id="save">Save</button>
                                      <button class="btn-default btn" type="reset" onclick="clearForm()">Cancel</button>
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
<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/quicksearch/jquery.quicksearch.min.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/form-multiselect/js/jquery.multi-select.min.js'></script>
<script type='text/javascript' src='<?php echo base_url('assets')?>/js/custom.js'></script> 
<script language="JavaScript" type='text/javascript'>


$(document).ready(function(){
  $('.populate').select2();

  <?php if($w_ == 1) { ?>
 /* $("#spmsForm").on('submit',(function(e) {
    e.preventDefault();
    $('#actionButtons').hide();
    $('#message').append("<div id='message2'></div>");
    $('#message2').append("<img src='<?php //echo base_url('assets/img/loading.gif');?>'/>");
    $('#message2').append("    Processing...");
    $.ajax({
      url: '<?php//echo base_url("Process/purchase_request"); ?>', 
      type: "POST",        
      data: new FormData(this), 
      dataType: 'json',
      contentType: false,     
      processData: false,  
      cache: false, 
      success: function(data)   
      {
        if(data['mes'] == 'Success')
        {
          if($('#act').val() == 'add')
            alerts('New Purchase Request has been added.','s');
          else
            alerts('Purchase Request has been updated.','s');
          ($('#_table').val() == "1")?loadtable():null;
          clearForm();
        }
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
    
  })); */

  //new add purchase_order
  $("#job_request_form").on('submit',(function(e){
      e.preventDefault();
   
    $.ajax({
      url: '<?php echo base_url("Process/job_request"); ?>', 
      type:"POST",
      data: new FormData(this), 
      dataType: 'json',
      contentType: false,     
      processData: false,  
      cache: false, 
      success: function(data){
        if(data['mes']=='Success'){
          $('#divstyle1').slideUp();
        }else{
          $('#divstyle1').slideUp();
        }
      }
    });


  }));

  <?php }?>

  $("#searchForm").on('submit',(function(e) {
    e.preventDefault();
    $('#actionButtons2').hide();
    $('#message3').append("<div id='message4'></div>");
    $('#message4').append("<img src='<?php echo base_url('assets/img/loading.gif');?>'/>");
    $('#message4').append("    Processing...");
   loadtable();
    
  }));


});

</script>