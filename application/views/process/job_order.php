<div id="page-content">
  <div id='wrap'>
    <div id="page-heading">
      <ol class="breadcrumb">
        <li>Administrator</li>
          <li>Job Order</li>
      </ol>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-inverse">
              <div class="panel-heading">
                  <h4>Job Order Form</h4>
                  <div class="options">
                    <a class="panel-collapse" href="#">
                      <i class="fa fa-chevron-up"></i></a>
                  </div>
              </div>
              <form action="" class="form-horizontal row-border"  method="POST" id="job_order_form">
              <input type="hidden" name="add_job_order" id="add_job_order"/>
              <input type="hidden" value="add" name="act" id="act"/> 
              <input type="hidden" value="add" name="id" id="id"/>
              <div class="panel-body" id="divstyle" >
                <div class="tab-container tab-left tab-danger">
                  <ul class="nav nav-tabs">
                        <li class="<?php if(isset($_GET['id'])) echo ''; else echo 'active';?>"><a href="#billing" data-toggle="tab">Step 1<br><small style="color:grey; font-size:10px">Billing Information</small></a></a></li>
                        <li class=""><a href="#shipping" data-toggle="tab">Step 2<br><small style="color:grey; font-size:10px">Shipping Information</small></a></a></li>
                        <li class="<?php if(isset($_GET['id'])) echo 'active';?>"><a href="#supplier_" id="sup_" data-toggle="tab">Step 3<br><small style="color:grey; font-size:10px">Supplier and Items</small></a></a></li>
                  </ul>
                  <div class="tab-content" style="overflow:hidden">
                    <div class="tab-pane <?php if(isset($_GET['id'])) echo ''; else echo 'active';?>" id="billing">
                      <h5 style="padding-left:20px">Please fill in the Billing Information below to where the Purchase Order will be billed to.</h5>
                      <hr>
                      <div id="searchResult">
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><b>Company Name</b><span style="color:red">*</span></label>
                            <div class="col-sm-2">
                               <input type="text" class="form-control" name="b_company" id="b_company" required value="<?php if(isset($bs[0][4])) echo $bs[0][4];?>">
                            </div>
                            <label class="col-sm-2 control-label"><b>Billing Address</b><span style="color:red">*</span></label>
                            <div class="col-sm-6">
                               <input type="text" class="form-control" name="b_address" id="b_address" value="<?php if(isset($bs[0][5])) echo $bs[0][5];?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><b>Billing Tel. No.</b><span style="color:red">*</span></label>
                            <div class="col-sm-2">
                               <input type="text" class="form-control" name="b_telno" id="b_telno" required value="<?php if(isset($bs[0][6])) echo $bs[0][6];?>">
                            </div>
                            <label class="col-sm-2 control-label"><b>Billing Mobile No.</b></label>
                            <div class="col-sm-2">
                               <input type="text" class="form-control" name="b_mobile" id="b_mobile" value="<?php if(isset($bs[0][7])) echo $bs[0][7];?>">
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane" id="shipping">
                         <h5 style="padding-left:20px">Please fill in the Shipping Information below to where the Purchase Order will be shipped to.</h5>
                        <hr>
                        <div id="searchResult">
                           <div class="form-group">
                              <label class="col-sm-2 control-label"><b>Company Name</b><span style="color:red">*</span></label>
                              <div class="col-sm-2">
                                 <input type="text" class="form-control" name="s_company" id="s_company" required value="<?php if(isset($bs[0][0])) echo $bs[0][0];?>">
                              </div>
                              <label class="col-sm-2 control-label"><b>Shipping Address</b><span style="color:red">*</span></label>
                              <div class="col-sm-6">
                                 <input type="text" class="form-control" name="s_address" id="s_address" required value="<?php if(isset($bs[0][1])) echo $bs[0][1];?>">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 control-label"><b>Shipping Tel. No.</b><span style="color:red">*</span></label>
                              <div class="col-sm-2">
                                 <input type="text" class="form-control" name="s_telno" id="s_telno" required value="<?php if(isset($bs[0][2])) echo $bs[0][2];?>">
                              </div>
                              <label class="col-sm-2 control-label"><b>Shipping Mobile No.</b></label>
                              <div class="col-sm-2">
                                 <input type="text" class="form-control" name="s_mobile" id="s_mobile" value="<?php if(isset($bs[0][3])) echo $bs[0][3];?>">
                              </div>
                          </div>
                        </div>
                    
                    </div>
                    <div class="tab-pane <?php if(isset($_GET['id'])) echo 'active';?>" id="supplier_">
                      <h5 style="padding-left:20px">Please select the supplier and items that will be included on Purchase Order(PO) below.</h5>
                      <hr>
                      <div id="searchResult">
                         <div class="form-group">
                          <div class="col-md-2" style="text-align:right; padding-top:8px;">
                            <label><b>Supplier</b></label>
                          </div>
                          <div class="col-md-3">
                            <select class="populate" style="width:100%" id="supplier" name="supplier" required >
                              <option value="">Select Supplier</option>
                              <?php foreach($supplier as $r) echo '<option value="'.$r[9].'">'.$r[1].'</option>';?>
                            </select>
                          </div>    
                          <div class="col-md-2" style="text-align:right; padding-top:8px;">
                            <label><b>Expected Delivery Date</b></label>
                          </div>
                          <div class="col-md-3">
                            <input type="date" class="form-control" name="delivery_date" id="delivery_date" required>
                          </div>   
                        </div>
                        <div class="form-group" id="row_1" style="padding-bottom:0px">
                          <div class="col-md-3" style="text-align:center;font-size:12px">
                            <label><b>Item</b></label>
                          </div>
                          <div class="col-md-1" style="text-align:center;font-size:12px">
                            <label><b>Qty</b></label>
                          </div>
                          <div class="col-md-2" style="text-align:center;font-size:12px">
                            <label><b>Estimated Unit Price</b></label>
                          </div>
                          <div class="col-md-2" style="text-align:center;font-size:12px">
                            <label><b>Discount %</b></label>
                          </div>   
                          <div class="col-md-2" style="text-align:center;font-size:12px">
                            <label><b>Purpose</b></label>
                          </div>   
                          <div class="col-md-2" style="text-align:center;font-size:12px">
                            <label><b>Add/Remove</b></label>
                          </div>  
                        </div>

                        <div id="divItems" data-mfield-options='{"section": ".group","btnAdd":"#btnAdd-3","btnRemove":".btnRemove"}'>
                        <div class="col-md-12 group" ><br>
                          <input type="hidden" id="ctr" value = "1"/> 
                          <div class="form-group" id="row_1">
                            <div class="col-md-3">
                              <select class="form-control"  id="item" name="item[]" style="font-size:12px;width:100%;margin:1px;"  required>
                                <option value="">Select an Item</option>
                                 <?php foreach($item as $r) echo '<option value="'.$r[10].'">'.$r[1].'</option>';?>
                              </select>
                            </div>  
                            <div class="col-md-1" id="ctp_1" >
                              <input type="number" class="form-control" name="unit[]" id="unit" min = "0" style="font-size:12px; text-align:right" placeholder="" required>
                            </div>
                            <div class="col-md-2" id="" >
                              <input type="number" class="form-control" name="price[]" id="price" min = "0" style="font-size:12px; text-align:right"  placeholder="0.00" required>
                            </div>
                            <div class="col-md-2" id="" >
                              <input type="number" class="form-control" name="discount[]" id="discount" min = "0" style="font-size:12px; text-align:right"  placeholder="0.00">
                            </div>
                            <div class="col-md-2" >
                            <textarea class="form-control" rows="1" cols="10"  id="purpose" name="purpose[]" required></textarea>
                            </div>
                            <div class="col-md-2" id="btn_1" style="text-align:center">
                             <button type="button" id="btnAdd-3" class="btn btn-primary btnAdd-3" onclick="clearForm()">+</button>
                            <button type="button" class="btn btn-danger btnRemove">x</button>
                            </div>    
                          </div>
                        </div>
                      
                    </div>
                    <?php if($w_ == 1) { ?>
                      <div class="panel-footer">
                          <div class="row">
                              <div class="col-lg-offset-1 col-lg-10">
                                  <div id="message"></div> 
                                  <div class="btn-toolbar" id = "actionButtons">
                                      <button class="btn-primary btn" type="submit" name="save" id="save">Save</button>
                                      <button class="btn-default btn" type="reset" onclick="clearForm()">Cancel</button>
                                  </div>
                              </div>
                          </div>
                      </div>
                    <?php }?>
                      
                    </div>
                  </div>
                </div>
                   
              </form>
              </div>
          </div>
          </div>

          <div class="panel panel-inverse">
               <div class="panel-heading">
              <h4>Search Filter</h4>
              <div class="options">
                <a class="panel-collapse" href="#">
                <i class="fa fa-chevron-up"></i></a>
              </div>
              </div>
              <div class="panel-body">
                   <form action="" class="form-horizontal row-border"  method="POST" id="searchForm">
                      <input name="_table" id="_table" type="hidden"/>
                      
                        <div class="form-group" style="padding:0px">
                          <label class="col-sm-2 control-label"><b>J.O. #</b></label>
                          <div class="col-sm-4">
                             <input type="text" class="form-control" name="s_po" id="s_po">
                          </div>
                          <div class="col-md-2" style="text-align:right; padding-top:8px;">
                            <label><b>Added By</b></label>
                          </div>
                          <div class="col-md-4">
                            <select class="populate" style="width:100%" id="s_user" name="s_user">
                              <option value="">All User</option>
                              <?php foreach($u as $r) echo '<option value="'.$r[6].'">'.$r[2].'</option>';?>
                            </select>
                          </div>
                        </div>
                        <div class="form-group" style="padding:0px">
                          <div class="col-md-2" style="text-align:right; padding-top:8px;">
                            <label><b>Supplier</b></label>
                          </div>
                          <div class="col-md-4">
                            <select class="populate" style="width:100%" id="s_supplier" name="s_supplier">
                              <option value="">Select Supplier</option>
                              <?php foreach($supplier as $r) echo '<option value="'.$r[9].'">'.$r[1].'</option>';?>
                            </select>
                          </div>  
                          <div class="col-md-2" style="text-align:right; padding-top:8px;">
                            <label><b>Item</b></label>
                          </div>
                          <div class="col-md-4">
                            <select class="populate" style="width:100%" id="s_item" name="s_item">
                              <option value="">All Items</option>
                              <?php foreach($p as $r) echo '<option value="'.$r[8].'">'.$r[2].' ('.$r[3].')'.'</option>';?>
                            </select>
                          </div>  
                        </div>
                     
                        <div class="form-group" style="padding:0px">
                         
                          <div class="col-md-2" style="text-align:right; padding-top:8px;">
                            <label><b>Expected Delivery Date</b></label>
                          </div>
                          <div class="col-md-4">
                            <input type="date" class="form-control" name="s_date" id="s_date">
                          </div> 
                          <div class="col-md-2" style="text-align:right; padding-top:8px;">
                            <label><b>Status</b></label>
                          </div>
                          <div class="col-md-4">
                            <select class="populate" style="width:100%" id="s_status" name="s_status">
                              <option value="">All</option>
                              <option value="New">Newly Created</option>
                              <option value="Released">Released (Printed Out)</option>
                              <option value="Changed Order">Changed Order</option>
                              <option value="Received">Received</option>
                              <option value="Partially Received">Partially Received</option>
                              <option value="Closed">Closed</option>
                              <option value="Cancelled">Cancelled</option>

                            </select>
                          </div>   
                        </div>  
                      <?php if($w_ == 1) { ?>
                      <div class="panel-footer" style="margin-top:0px; padding-top:10px; padding-bottom:10px">
                          <div class="row">
                              <div class="pull-right">
                                  <div id="message3"></div> 
                                  <div class="btn-toolbar" id = "actionButtons2">
                                      <button class="btn-primary btn" type="submit" name="save" id="save">Search</button>
                                      <button class="btn-default btn" type="reset" onclick="resetForm()">Reset</button>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <?php }?>
                   </form>
              </div>
              <div class="panel-body collapse in">
                  <table style="font-size:12px" cellpadding="0" cellspacing="0" border="0" width="100%" id="spmsTable" class="table table-striped table-bordered datatables">
                      <thead>
                          <tr>
                              <th style="width : 10%">P.O. #</th>
                              <th style="width : 15%">Supplier</th>
                              <th style="width : 20%">Item</th>
                              <th style="width : 10%">Total Price</th>
                              <th style="width : 10%">Delivery Date</th>
                              <th style="width : 10%">Added By</th>
                              <th style="width : 10%">Status</th>
                              <th style="width : 7%; text-align:center">Action</th>
                          </tr>
                      </thead>
                      <tbody>
                      
                      </tbody>
                  </table>
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
<script type='text/javascript' src='<?php echo base_url('assets')?>/js/jquery.multifield.min.js'></script> 
 <script>
  $('#divItems').multifield();
    </script>
<script language="JavaScript" type='text/javascript'>
///
function loadtable()
{
  $('#spmsTable').dataTable().fnClearTable();
  $('#spmsTable').dataTable().fnDraw();
  $('#spmsTable').dataTable().fnDestroy();
  $('#spmsTable').dataTable({
      "serverSide": true,
      "sAjaxSource": "<?php echo base_url('Process/job_order')?>"+"?loadtable=true&"+$('#searchForm').serialize(),
      "deferLoading": 10,
      "bPaginate": true,
      "aaSorting": [[0,'desc']],
     
      "fnInitComplete": function(){
        $('#_table').val("1");
        $('#message3').empty();
        $('#actionButtons2').show();
      }
  });
}

<?php if($w_ == 1) { ?>

function cancel_(id, name){

  var result = confirm("Do you want to proceed cancelling "+name+"?");
  if (result) {
       $.ajax
        ({ type:"POST",
           async: true,
           url:"<?php echo base_url('Process/job_order')?>",
           data:{id:id, act:"delete"},
           dataType: 'json',
           cache: false,
           success: function(data)
            {
              if (data['mes'] == "Success")
              {
                alerts('Job Order has been cancelled.','s');
                ($('#_table').val() == "1")?loadtable():null;
              }
              else
                alerts('An error occured. Please reload the page and try again.','w');
             },
             error: function(data)
             {
                alerts('An error occured. Please reload the page and try again.','e');
             }

    });
 } 
}


<?php }?>

function view_(id, name, status)
{
  if(status == 'New' || status == 'Changed Order')
  {
    var result = confirm('This Job Order ('+name+') will now be tagged released. Do you want to proceed?');
    if(result)
        window.open('<?php echo base_url("Process/view_jo")?>'+'?id='+id);
    ($('#_table').val() == "1")?loadtable():null;
  }
  else
    window.open('<?php echo base_url("Process/view_jo")?>'+'?id='+id);
  
}

$(document).ready(function(){
 $('.populate').select2();

  <?php if($w_ == 1) { ?>
 
  $("#job_order_form").on('submit',(function(e){
      e.preventDefault();
   
    $.ajax({
      url: '<?php echo base_url("Process/job_order"); ?>', 
      type:"POST",
      data: new FormData(this), 
      dataType: 'json',
      contentType: false,     
      processData: false,  
      cache: false, 
      success: function(data){
        if (data['mes'] == "Success"){
          
         confirm('New JOb Order has been added.');
    
         loadtable();
        }
       
      },  error: function(data)
             {
                alerts('An error occured. Please reload the page and try again.','e');
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

$(document).ready(function(){
  loadtable();
});


</script>