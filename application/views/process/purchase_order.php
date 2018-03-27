<div id="page-content">
  <div id='wrap'>
    <div id="page-heading">
      <ol class="breadcrumb">
        <li>Administrator</li>
          <li>Purchase Order</li>
      </ol>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-12"> 
         
      <!-- Approved Purchase Request -->
          <div class="panel panel-inverse">
              <div class="panel-heading">
                  <h4>Approved Purchase Request </h4>
                  <div class="options">
                    <a class="panel-collapse" href="#">
                      <i class="fa fa-chevron-up"></i></a>
                  </div>
              </div>
                <div class="panel-body" id="divstyle" >
                       <table style="font-size:12px" cellpadding="0" cellspacing="0" border="0" width="100%" id="approvedPurchaseRequest" class="table table-striped table-bordered datatables">
                      <thead>
                          <tr>
                              <th style="width : 10%">PR #</th>
                              <th style="width : 15%">Responsibility Center</th>
                              <th style="width : 15%">Item</th>
                              <th style="width : 10%">Unit Cost</th>
                              <th style="width : 10%">Total Cost</th>
                              <th style="width : 15%">Requested by</th>
                              <th style="width : 10%">Date Requested</th>
                              <th style="width : 10%">Purpose</th>
                              <!-- <th style="width : 7%; text-align:center">Action</th> -->
                          </tr>
                      </thead>
                      <tbody>
                      
                      </tbody>
                    </table>
                </div>
          </div><!-- Approved Purchase Request -->

          <div class="panel panel-inverse">
              <div class="panel-heading">
                  <h4>Purchase Order Form</h4>
                  <div class="options">
                    <a class="panel-collapse" href="#">
                      <i class="fa fa-chevron-up"></i></a>
                  </div>
              </div>
              <form action="" class="form-horizontal row-border"  method="POST" id="spmsForm">
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
                            <label><b>Supplier</b><span style="color:red">*</span></label>
                          </div>
                          <div class="col-md-3">
                            <select class="populate" style="width:100%" id="supplier" name="supplier" required onchange="if($(this).val() == ''){ clearForm();} else {$('#divItems').show(); clearProducts(); initProduct();}">
                              <!--                             <select class="populate" style="width:100%" id="supplier" name="supplier" required onchange="if($(this).val() == ''){clearForm();} else {$('#divItems').show(); clearProducts(); initProduct();}"> -->
                              <option value="">Select Supplier</option>
                              <?php foreach($supplier as $r) echo '<option value="'.$r[9].'">'.$r[1].'</option>';?>
                            </select>
                          </div>    
                          <div class="col-md-2" style="text-align:right; padding-top:8px;">
                            <label><b>Expected Delivery Date</b><span style="color:red">*</span></label>
                          </div>
                          <div class="col-md-3">
                            <input type="date" class="form-control" name="delivery_date" id="delivery_date" required>
                          </div>   
                        </div>
                        <div class="form-group" id="row_1" style="padding-bottom:0px">
                          <div class="col-md-3" style="text-align:center;font-size:12px">
                            <label><b>Item</b><span style="color:red">*</span></label>
                          </div>
                          <div class="col-md-1" style="text-align:center;font-size:12px">
                            <label><b>Qty</b><span style="color:red">*</span></label>
                          </div>
                          <div class="col-md-2" style="text-align:center;font-size:12px">
                            <label><b>Estimated Unit Price</b><span style="color:red">*</span></label>
                          </div>
                          <div class="col-md-2" style="text-align:center;font-size:12px">
                            <label><b>Discount %</b></label>
                          </div>   
                          <div class="col-md-2" style="text-align:center;font-size:12px">
                            <label><b>Amount</b></label>
                          </div>   
                          <div class="col-md-2" style="text-align:center;font-size:12px">
                            <label><b>Add/Remove</b></label>
                          </div>  
                        </div>

                        <div id="divItems" style="display:none">
                          <input type="hidden" id="ctr" value = "1"/> 
                          <div class="form-group" id="row_1">
                            <div class="col-md-3">
                              <select class="populate"  id="item_1" name="item[]" style="font-size:12px;width:100%" onchange="loadPrice($(this).val(), 1)" required>
                                <option value="">Select an Item</option>
                                
                              </select>
                            </div>  
                            <div class="col-md-1" id="ctp_1" >
                              <input type="number" class="form-control" name="unit[]" id="unit_1" onblur="computeTotal(1)" style="font-size:12px; text-align:right" placeholder="" required>
                            </div>
                            <div class="col-md-2" id="" >
                              <input type="text" class="form-control" name="price[]" id="price_1" onblur="computeTotal(1)" style="font-size:12px; text-align:right" onkeypress="$(this).css('color', '#4d4d4d')" placeholder="0.00" required>
                            </div>
                            <div class="col-md-2" id="" >
                              <input type="text" class="form-control" name="discount[]" id="discount_1" onblur="computeTotal(1)" style="font-size:12px; text-align:right" onkeypress="$(this).css('color', '#4d4d4d')" placeholder="0.00">
                            </div>
                            <div class="col-md-2" style="text-align:right; font-size:12px; padding-top:8px">
                             <label id="amount_1" name="amount[]">Php 0.00</label>
                            </div>
                            <div class="col-md-2" id="btn_1" style="text-align:center">
                              <input type="button" class="btn btn-primary" onClick="addNew(); $(this).hide()" id="btnAdd_1" name="btnAdd_[]" value="+"></input>
                            </div>    
                          </div>
                        </div>
                        <div class="form-group">
                             <div class="col-md-8" style="text-align:right; font-size:12px; padding-top:8px">
                             <label><b>Total Amount</b></label>
                            </div>
                            <div class="col-md-2" style="text-align:right; font-size:12px; padding-top:8px">
                             <b><label id="tot_amount" name="tot_amount[]" style="font-weight:bold">Php 0.00</label></b>
                            </div>
                        </div>
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
                          <label class="col-sm-2 control-label"><b>P.O. #</b></label>
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
                              <?php foreach($p as $r) echo '<option value="'.$r[0].'">'.$r[1].' ('.$r[3].')'.'</option>';?>
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
                              <th style="width : 10%">Created By</th>
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

<script language="JavaScript" type='text/javascript'>



function approvePurchaseRequestToPo(id){


 //// if (result) { \
       $.ajax
        ({ type:"POST",
           async: true,
           url:"<?php echo base_url('Process/purchase_request')?>",
           data:{id:id, action:"getspecific"},
           dataType: 'json',
           cache: false,
           success: function(data)
            {
             // var_dump(data);
           //   if (data['mes'] == "Success")
          //    {
            $('#divstyle1').slideDown();
            $product = data[0][15];

            
            $('#requested_item').val(data[0][16]);
            $('#requested_description').val(data[0][15]);
           //  $('#requested_item').select({setVal:data[0][15]});
           //  $('#requested_item').select({setVal:(data[0][14]}); 
            $('#requested_qty').val(data[0][8]);//[0][1]->[0][0]
            $('#requested_unit_price').val(data[0][10]);//[0][4]->[0][4]
            $('#requested_total_amount').val(data[0][11]);//[0][4]->[0][4]
            $('#requested_unit').val(data[0][12]);
            $('#request_item_id').val(data[0][14]);
            $('#requested_item_discount').val(0.0);
            //  }
            //  else
            //    confirm('arzanan');
             },
             error: function(data)
             {
                   alerts('An error occured. Please reload the page and try again.');
          
             }

    });
// } 
}


function approvedPurchaseRequestTable(){
 $('#approvedPurchaseRequest').dataTable().fnClearTable();
  $('#approvedPurchaseRequest').dataTable().fnDraw();
  $('#approvedPurchaseRequest').dataTable().fnDestroy();

  $('#approvedPurchaseRequest').dataTable({
      "serverSide": true,
      "sAjaxSource": "<?php echo base_url('Process/purchase_order')?>"+"?loadtableApprovePurchase=true",
      "deferLoading": 10,
      "fnInitComplete": function(){
        $('#_table').val("1");
        $('#message3').empty();
        $('#actionButtons2').show();
      }
  });

}

////////////////
function loadtable()
{
  $('#spmsTable').dataTable().fnClearTable();
  $('#spmsTable').dataTable().fnDraw();
  $('#spmsTable').dataTable().fnDestroy();

  $('#spmsTable').dataTable({
      "serverSide": true,
      "sAjaxSource": "<?php echo base_url('Process/purchase_order')?>"+"?loadtable=true&"+$('#searchForm').serialize(),
      "deferLoading": 10,
      "fnInitComplete": function(){
        $('#_table').val("1");
        $('#message3').empty();
        $('#actionButtons2').show();
      }
  });

}

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


function clearForm()
{
  $('#divItems').hide();
  $('#id').val("");
  $('#act').val("add");
  $('#ctr').val("1");
  $('#supplier').val("");
  $('#supplier').select2({setVal:""});
  $('#delivery_date').val("");
  $('#tot_amount').text('Php 0.00');
  $('#divItems').empty();
  $('#divItems').append(' <input type="hidden" id="ctr" value = "1"/> '+
                        '<div class="form-group" id="row_1">'+
                          '<div class="col-md-3">'+
                            '<select class="populate" id="item_1" name="item[]" onchange="loadPrice($(this).val(),1)" style="font-size:13px; width:100%" required>'+
                              '<option value="">Select an Item</option></select>'+
                          '</div>'+
                          '<div class="col-md-1" id="ctp_1" >'+
                            '<input type="number" class="form-control" name="unit[]" id="unit_1" onchange="computeTotal(1)" placeholder="" style="font-size:12px; text-align:right" required>'+
                          '</div>'+
                          '<div class="col-md-2" id="" >'+
                            '<input type="text" class="form-control" name="price[]" id="price_1" onchange="computeTotal(1)" placeholder="0.00" style="font-size:12px; text-align:right" required>'+
                          '</div>'+
                          '<div class="col-md-2" id="" >'+
                            '<input type="text" class="form-control" name="discount[]" id="discount_1" onchange="computeTotal(1)" placeholder="0.00" style="font-size:12px; text-align:right">'+
                          '</div>'+
                          '<div class="col-md-2" style="text-align:right; font-size:12px; padding-top:8px">'+
                            '<label id="amount_1" name="amount[]">Php 0.00</label>'+
                          '</div>'+
                          '<div class="col-md-2" id="btn_1" style="text-align:center">'+
                            '<input type="button" class="btn btn-primary" onClick="addNew(); $(this).hide()" id="btnAdd_1" name="btnAdd_[]" value="+"></input>'+
                          '</div>'+
                        '</div>');
  $("#item_1").select2();

}

function resetForm()
{
  $('#s_user').val("");
  $('#s_supplier').val("");
  $('#s_status').val("");
  $('#s_date').val("");
  $('#s_item').val("");
  $('#s_po').val("");
  $('#s_item').select2({setVal:""});
  $('#s_status').select2({setVal:""});
  $('#s_user').select2({setVal:""});
  $('#s_supplier').select2({setVal:""});
}

function clearProducts()
{
  $('#ctr').val("1");
  $('#tot_amount').text('Php 0.00');
  $('#divItems').empty();
  $('#divItems').append(' <input type="hidden" id="ctr" value = "1"/> '+
                        '<div class="form-group" id="row_1">'+
                          '<div class="col-md-3">'+
                            '<select class="populate" id="item_1" name="item[]" onchange="loadPrice($(this).val(),1)" style="font-size:13px; width:100%" required>'+
                              '<option value="">Select an Item</option></select>'+
                          '</div>'+
                          '<div class="col-md-1" id="ctp_1" >'+
                            '<input type="number" class="form-control" name="unit[]" id="unit_1" onchange="computeTotal(1)" placeholder="" style="font-size:12px; text-align:right" required>'+
                          '</div>'+
                          '<div class="col-md-2" id="" >'+
                            '<input type="text" class="form-control" name="price[]" id="price_1" onchange="computeTotal(1)" placeholder="0.00" style="font-size:12px; text-align:right" required>'+
                          '</div>'+
                          '<div class="col-md-2" id="" >'+
                            '<input type="text" class="form-control" name="discount[]" id="discount_1" onchange="computeTotal(1)" placeholder="0.00" style="font-size:12px; text-align:right">'+
                          '</div>'+
                          '<div class="col-md-2" style="text-align:right; font-size:12px; padding-top:8px">'+
                            '<label id="amount_1" name="amount[]">Php 0.00</label>'+
                          '</div>'+
                          '<div class="col-md-2" id="btn_1" style="text-align:center">'+
                            '<input type="button" class="btn btn-primary" onClick="addNew(); $(this).hide()" id="btnAdd_1" name="btnAdd_[]" value="+"></input>'+
                          '</div>'+
                        '</div>');
  $("#item_1").select2();

}

function initProduct()
{
  if($('#supplier').val() != "")
  {
    $('#item_1').empty();
    $('#item_1').append('<option value="">Select an Item</option>');
    $.ajax
      ({ type:"POST",
         async: false,
         url:"<?php echo base_url('Process/purchase_order')?>",
         data:{id:$('#supplier').val(), initProduct:"initProduct"},
         dataType: 'json',
         cache: false,
         success: function(data)
          {
            if (data['mes'] == "Success")
              for(var i = 0; i<data['data'].length; i++)
                $('#item_1').append('<option value="'+data['data'][i][0]+'">'+data['data'][i][2]+' ('+data['data'][i][1]+')'+'</option>');
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

function loadPrice(val, id)
{
  if(val != "")
  $.ajax
    ({ type:"POST",
       async: false,
       url:"<?php echo base_url('Process/purchase_order')?>",
       data:{id:val, loadPrice:"loadPrice"},
       dataType: 'json',
       cache: false,
       success: function(data)
         {  
            $('#price_' + id).val(data); 
         },
       error: function(data)
         {
            alerts('An error occured. Please reload the page and try again.','e');
         }

    });
  else
    $('#price_'+id).val(""); 
} 

function computeTotal(ctr)
{
  var price = 0;
  var qty = 0;
  var discount = 0;

  ($('#price_'+ctr).val() != "")?price = $('#price_'+ctr).val():null;
  ($('#discount_'+ctr).val() != "")?discount = $('#discount_'+ctr).val():null;
  ($('#unit_'+ctr).val() != "")?qty = $('#unit_'+ctr).val():null;

  tp = price*qty;
  td = (price*(discount/100))*qty;
  $('#amount_'+ctr).text('Php '+(tp-td).toFixed(2));

  var tot = 0;

  $('label[name^="amount[]"]').each(function(){
    tot+=parseFloat(($(this).text()).substring(4));
  });


  
  $('#tot_amount').text('Php '+tot.toLocaleString("en-US"));

}


function addNew()
{
  if($('#supplier').val() != "")
  {
    $.ajax
      ({ type:"POST",
         async: false,
         url:"<?php echo base_url('Process/purchase_order')?>",
         data:{id:$('#supplier').val(), initProduct:"initProduct"},
         dataType: 'json',
         cache: false,
         success: function(data)
          {
            var val = "";
            if (data['mes'] == "Success")
              for(var i = 0; i<data['data'].length; i++)
                val += '<option value="'+data['data'][i][0]+'">'+data['data'][i][1]+'</option>';
            else
              alerts('An error occured. Please reload the page and try again.','w');
            var ctr = parseInt($('#ctr').val())+1;
            $('#ctr').val(ctr)
            $('#btnAdd_'+(ctr-1)).hide();

            $('#divItems').append('<div class="form-group" id="row_'+ctr+'">'+
                '<div class="col-md-3">'+
                  '<select class="populate" id="item_'+ctr+'" name="item[]" onchange="loadPrice($(this).val(), '+ctr+')" style="font-size:13px;width:100%" required>'+
                    '<option value="">Select an Item</option>'+
                    val
                  +'</select>'+
                '</div>'+
                '<div class="col-md-1" id="ctp_'+ctr+'" >'+
                  '<input type="number" class="form-control" name="unit[]" id="unit_'+ctr+'" onchange="computeTotal('+ctr+')" placeholder="" style="font-size:12px; text-align:right" required>'+
                '</div>'+
                '<div class="col-md-2" >'+
                  '<input type="text" class="form-control" name="price[]" id="price_'+ctr+'" onchange="computeTotal('+ctr+')" placeholder="0.00" style="font-size:12px; text-align:right" required>'+
                '</div>'+
                '<div class="col-md-2" >'+
                  '<input type="text" class="form-control" name="discount[]" id="discount_'+ctr+'" onchange="computeTotal('+ctr+')" placeholder="0.00" style="font-size:12px; text-align:right">'+
                '</div>'+
                '<div class="col-md-2" style="text-align:right; font-size:12px; padding-top:8px">'+
                  '<label id="amount_'+ctr+'" name="amount[]">Php 0.00</label>'+
                '</div>'+
                '<div class="col-md-2" id="btn_'+ctr+'" style="text-align:center">'+

                '</div>'+
            '</div>');
            $("#item_"+ctr).select2();

            var ctr = $('#ctr').val();

            $('#btn_'+ctr).empty();

            var t_c = 0, btn = "";
            $('select[name^="item[]"]').each(function(){
              t_c++;
            });
            (t_c > 1)?btn+='<input type="button" class="btn btn-danger" onClick="removeRow('+ctr+')" value="-" ></input>':null;
            btn+='<input type="button" class="btn btn-primary" onClick="addNew(); $(this).hide()" id="btnAdd_'+ctr+'" name="btnAdd_[]" value="+" ></input>';
            
            $('#btn_'+ctr).append(btn);



            var arr = $('input[name^="btnAdd_[]"]').length;
              var ct = 1;
              $('input[name^="btnAdd_[]"]').each(function(){
                (ct == arr)?$(this).show():$(this).hide();
                ct++;
              });
           },
           error: function(data)
           {
              alerts('An error occured. Please reload the page and try again.','e');
           }

      });
  }
  

}

function removeRow(ctr)
{
  $('#num').val(parseInt($('#num').val())-1);
  // var btn='<input type="button" class="btn btn-primary" onClick="addNew()" id="btnAdd_'+(ctr-1)+'" value="+" style="height:28px"></input>';
  
  $('#row_'+ctr).empty();
  $('#row_'+ctr).hide();

  var ct = 0;
  $('input[name^="btnAdd_[]"]').each(function(){
    if($(this).css('display') == 'inline-block' || $(this).css('display') == 'block')
      ct++;
  });
  if(ct == 0)
    $('#btnAdd_'+(ctr-1)).show();

  var ct = 0;
  $('input[name^="btnAdd_[]"]').each(function(){
    if($(this).css('display') == 'inline-block' || $(this).css('display') == 'block')
      ct++;
  });
  if(ct == 0)
    $('#btnAdd_1').show();

  computeTotal();
}

<?php if($w_ == 1) { ?>

function cancel_(id, name){

  var result = confirm("Do you want to proceed cancelling "+name+"?");
  if (result) {
       $.ajax
        ({ type:"POST",
           async: true,
           url:"<?php echo base_url('Process/purchase_order')?>",
           data:{id:id, act:"delete"},
           dataType: 'json',
           cache: false,
           success: function(data)
            {
              if (data['mes'] == "Success")
              {
                alerts('Purchase Order has been cancelled.','s');
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
    var result = confirm('This Purchase Order ('+name+') will now be tagged released. Do you want to proceed?');
    if(result)
        window.open('<?php echo base_url("Process/view_po")?>'+'?id='+id);
    ($('#_table').val() == "1")?loadtable():null;
  }
  else
    window.open('<?php echo base_url("Process/view_po")?>'+'?id='+id);
  
}

function co_(id, name){
  clearForm();
  $("html, body").animate({scrollTop: 600}, 100);
  
  $('#id').val(id);
  $('#act').val('save');
   $.ajax
    ({ type:"POST",
       async: false,
       url:"<?php echo base_url('Process/purchase_order')?>",
       data:{id:id, loadSpecific:"loadSpecific"},
       dataType: 'json',
       cache: false,
       success: function(data)
        {

          $('#supplier').val(data[0]['s_id']);
          $('#supplier').select2({setVal:data[0]['s_id']});
          $('#b_company').val(data[0]['b_company']);
          $('#b_address').val(data[0]['b_address']);
          $('#b_telno').val(data[0]['b_telno']);
          $('#b_mobile').val(data[0]['b_mobile']);
          $('#s_company').val(data[0]['s_company']);
          $('#s_address').val(data[0]['s_address']);
          $('#s_telno').val(data[0]['s_telno']);
          $('#s_mobile').val(data[0]['s_mobile']);
          $('#delivery_date').val(data[0]['delivery_date_']);
          $('#divItems').show(); 
          initProduct();
          for(var i = 0; i < data.length; i++)
          {
            if(i!=data.length-1)
              addNew();

            $('#item_'+parseInt(i+1)).val(data[i]['p_id']);
            $('#item_'+parseInt(i+1)).select2({setVal:data[i]['p_id']});
            $('#unit_'+parseInt(i+1)).val(data[i]['qty']);
            $('#price_'+parseInt(i+1)).val(data[i]['unit_price']);
            $('#discount_'+parseInt(i+1)).val(data[i]['discount']);

            $('#amount_'+parseInt(i+1)).text('Php '+data[i]['amount']);
          }

          $('#tot_amount').text(data[0]['total_price']);

          $('a[href="#supplier_"]').click();
         },
         error: function(data)
         {
            alerts('An error occured. Please reload the page and try again.','e');
         }

  });
}

$(document).ready(function(){
///
  approvedPurchaseRequestTable();

///
  $('.populate').select2();

  $("#searchForm").on('submit',(function(e) {
    e.preventDefault();
    $('#actionButtons2').hide();
    $('#message3').append("<div id='message4'></div>");
    $('#message4').append("<img src='<?php echo base_url('assets/img/loading.gif');?>'/>");
    $('#message4').append("    Processing...");
   loadtable();
  }));



  <?php if($w_ == 1) { ?>
  $("#spmsForm").on('submit',(function(e) {
    e.preventDefault();
    var check = 0;
    $('input[name^="price[]"]').each(function(){
      if($(this).val() > 0.1 && $(this).val() < 999999999)
      {
        
      }
      else
      {
        check = 1;
        $(this).css('color', 'red');
        return alerts('Please enter a valid value for the price.','w');
      }
        
    });

    if(check == 0)
    {
      $('#actionButtons').hide();
        $('#message').append("<div id='message2'></div>");
        $('#message2').append("<img src='<?php echo base_url('assets/img/loading.gif');?>'/>");
        $('#message2').append("    Processing...");
        $.ajax({
          url: '<?php echo base_url("Process/purchase_order"); ?>', 
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
                alerts('New Purchase Order has been added.','s');
              else
                alerts('Purchase Order has been updated.','s');
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
    }

   
  }));

  <?php }?>


}); 


$(document).ready(function(){
  loadtable();
});

</script>