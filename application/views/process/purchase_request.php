<div id="page-content">
  <div id='wrap'>
    <div id="page-heading">
      <ol class="breadcrumb">
        <li>Administrator</li>
          <li>Purchase Request</li>
      </ol>
    </div>
    <div class="container">
      <div class="row">

               <div class="col-md-12">
          <div class="panel panel-inverse">
              <div class="panel-heading">
                  <h4>Purchase Request Form</h4>
                  <div class="options">
                    <a class="panel-collapse" href="#">
                      <i class="fa fa-chevron-up"></i></a>
                  </div>
              </div>
              <div class="panel-body" id="divstyle" style="display:block;">

                   <form action="" class="form-horizontal row-border"  method="POST" id="spmsForm">
                      <input type="hidden" id="id" name="id"/>
                      <input type="hidden" id="act" name="act" value="add"/>
                      <div class="form-group">
                          <div class="col-md-2" style="text-align:right; padding-top:8px;">
                            <label><b>Responsibility Center</b><span style="color:red">*</span></label>
                          </div>
                          <div class="col-md-4">
                            <select class="populate" id="office" name="office" style="width:100%" required>
                              <option value="">Select Responsibility Center</option>
                              <?php foreach($o as $r) echo '<option value="'.$r[0].'">'.$r[1].'</option>';?>
                            </select>
                          </div>  
                          <div class="col-md-2" style="text-align:right; padding-top:8px;">
                            <label><b>Fund Cluster</b></label>
                          </div>
                          <div class="col-md-4">
                            <select class="populate" id="fund_cluster" name="fund_cluster" style="width:100%" required>
                              <?php foreach($fund_cluster as $r) echo '<option value="'.$r[0].'">'.$r[0].'</option>';?>
                            </select>
                          </div>  
                      </div>
                      <div id="divItems">
                        <input type="hidden" id="ctr" value = "1"/> 
                        <div class="form-group" id="row_1">
                          <div class="col-md-1">
                            <center><label><b>Unit</b></label></center>
                          </div> 
                          <div class="col-md-3">
                            <center><label><b>Item Description</b><span style="color:red">*</span></label></center>
                          </div>  
                          <div class="col-md-1">
                            <center><label><b>Qty</b><span style="color:red">*</span></label></center>
                          </div>
                          <div class="col-md-1">
                            <center><label><b>Unit Cost</b><span style="color:red">*</span></label></center>
                          </div>
                          <div class="col-md-1">
                            <center><label><b>Total Cost</b></label></center>
                          </div>
                          <div class="col-md-3">
                            <center><label><b>Purpose</b></label></center>
                          </div>
                          <div class="col-md-1">
                            <center><label><b>Add/Remove</b></label></center>
                          </div>    
                        </div>
                        <div class="form-group" id="row_1">
                          <div class="col-md-1">
                            <input type="text" class="form-control" name="unit[]" id="unit" readonly>
                            <!--<select name="unit[]" id="unit" style="width:100%" class="populate" required>
                              <option value="">Please Select</option>
                              <?php 
                             /*   foreach($units as $r)
                                {
                                  echo '<option value="'.$r[0].'">'.$r[0].'</option>';
                                }*/
                              ?>-->
                            <!--   
                            </select> -->
                          </div> 
                          <div class="col-md-3">
                            <!--  <input type="text" class="form-control" name="item[]" id="item" placeholder="" required>-->

                              <select class="populate" id="item" name="item[]" style="width:100%" onChange="showUnit(this.value, 1)" required>
                              <option value="">Select an Item</option>
                              <?php foreach($item as $r) echo '<option value="'.$r[7].'">'.$r[1].' ('.$r[2].')'.'</option>';?>

                            </select>

                          </div>  
                          <div class="col-md-1">
                            <input type="number" class="form-control" name="qty[]" id="qty" min = "0"onchange="$('#total_cost').val(($(this).val() * $('#unit_cost').val()).toFixed(2))" placeholder="" required>
                          </div>
                          <div class="col-md-1">
                            <input type="number" class="form-control" step="any" name="unit_cost[]" id="unit_cost" min = "0" onchange="$('#total_cost').val(($(this).val() * $('#qty').val()).toFixed(2))" placeholder="" required>
                          </div>
                          <div class="col-md-1">
                            <input type="text" class="form-control" name="total_cost[]" id="total_cost" placeholder="" readonly="readonly">
                          </div>
                          <div class="col-md-3">
                            <input type="text" class="form-control" name="purpose[]" id="purpose" placeholder="">
                          </div>
                          <div class="col-md-1" id="btn_1" >
                            <center><input type="button" class="btn btn-primary" onClick="addNew(); $(this).hide()" id="btnAdd_1" name="btnAdd_[]" value="+"></input></center>

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
                                      <button class="btn-default btn" type="reset" id="cancel" onclick="clearForm()">Cancel</button>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <?php }?>
                   </form>
              </div>
          </div>



<!--purchase_order-->
   <form action="" class="form-horizontal row-border"  method="POST" id="spmsForm123">
              <input type="hidden" value="add_po" name="action_to_po" id="action_to_po"/>
               <input type="hidden" value="add" name="id" id="id"/>
               <div id="divstyle1" style="display:none;">
                    <div class="panel panel-inverse">
                          <div class="panel-heading">
                           <h4 >Purchase Order Form</h4> 
                           </div>
                       <div class="panel-body" id="searchResult">
             
                  <div class="tab-container tab-left tab-danger">
                      <ul class="nav nav-tabs">
                            <li class=""><a href="#billing" data-toggle="tab">Step 1<br><small style="color:grey; font-size:10px">Billing Information</small></a></a></li>
                            <li class=""><a href="#shipping" data-toggle="tab">Step 2<br><small style="color:grey; font-size:10px">Shipping Information</small></a></a></li>
                            <li class="active"><a href="#supplier_" id="sup_" data-toggle="tab">Step 3<br><small style="color:grey; font-size:10px">Supplier and Items</small></a></a></li>
                      </ul>   

                       <div class="tab-content">
                           <div class="tab-pane " id="billing">
                               <h5 style="padding-left:20px">Please fill in the Billing Information below to where the Purchase Order will be billed to.</h5>
                                <hr>
                                <div id="searchResult">
                                  <div class="form-group">
                                      <label class="col-sm-2 control-label"><b>Company Name</b><span style="color:red">*</span></label>
                                      <div class="col-sm-4">
                                         <input type="text" class="form-control" name="b_company" id="b_company" required value="<?php if(isset($bs[0][4])) echo $bs[0][4];?>">
                                      </div>
                                      <label class="col-sm-2 control-label"><b>Billing Address</b><span style="color:red">*</span></label>
                                      <div class="col-sm-4">
                                         <input type="text" class="form-control" name="b_address" id="b_address" value="<?php if(isset($bs[0][5])) echo $bs[0][5];?>">
                                      </div>
                                    </div>
                                  
                                <div class="form-group">
                                      <label class="col-sm-2 control-label"><b>Billing Tel. No.</b><span style="color:red">*</span></label>
                                      <div class="col-sm-4">
                                         <input type="text" class="form-control" name="b_telno" id="b_telno" required value="<?php if(isset($bs[0][6])) echo $bs[0][6];?>">
                                      </div>
                                      <label class="col-sm-2 control-label"><b>Billing Mobile No.</b></label>
                                      <div class="col-sm-4">
                                         <input type="text" class="form-control" name="b_mobile" id="b_mobile" value="<?php if(isset($bs[0][7])) echo $bs[0][7];?>">
                                      </div>
                                  </div>
                                </div>

                           </div>
                           <div class="tab-pane " id="shipping">
                                       <h5 style="padding-left:20px">Please fill in the Shipping Information below to where the Purchase Order will be shipped to.</h5>
                                      <hr>
                                      <div id="searchResult">
                                         <div class="form-group">
                                            <label class="col-sm-2 control-label"><b>Company Name</b><span style="color:red">*</span></label>
                                            <div class="col-sm-4">
                                               <input type="text" class="form-control" name="s_company" id="s_company" required value="<?php if(isset($bs[0][0])) echo $bs[0][0];?>">
                                            </div>
                                            <label class="col-sm-2 control-label"><b>Shipping Address</b><span style="color:red">*</span></label>
                                            <div class="col-sm-4">
                                               <input type="text" class="form-control" name="s_address" id="s_address" required value="<?php if(isset($bs[0][1])) echo $bs[0][1];?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"><b>Shipping Tel. No.</b><span style="color:red">*</span></label>
                                            <div class="col-sm-4">
                                               <input type="text" class="form-control" name="s_telno" id="s_telno" required value="<?php if(isset($bs[0][2])) echo $bs[0][2];?>">
                                            </div>
                                            <label class="col-sm-2 control-label"><b>Shipping Mobile No.</b></label>
                                            <div class="col-sm-4">
                                               <input type="text" class="form-control" name="s_mobile" id="s_mobile" value="<?php if(isset($bs[0][3])) echo $bs[0][3];?>">
                                            </div>
                                        </div>
                                      </div>
                    
                           </div>
                           <div class="tab-pane active" id="supplier_"> <h5 style="padding-left:20px">Please select the supplier and items that will be included on Purchase Order(PO) below.</h5>
                            <hr>
                                <div class="form-group">
                                  <div class="col-sm-12">
                                      <div class="col-md-2" style="text-align:right; padding-top:8px;">
                                        <label><b>Supplier</b></label>
                                      </div>
                                      <div class="col-md-3">
                                        <select class="populate" style="width:100%" id="supplier" name="supplier" >
                                          <option value="">Select Supplier</option>
                                          <?php foreach($supplier as $r) echo '<option value="'.$r[9].'">'.$r[1].'</option>';?>
                                        </select>
                                      </div>    
                                      <div class="col-md-3" style="text-align:right; padding-top:8px;">
                                        <label><b>Expected Delivery Date</b></label>
                                      </div>
                                       <div class="col-md-3">
                                        <input type="date" class="form-control" name="delivery_date" id="delivery_date" required>
                                      </div> 
                                    </div>
                                 </div><br>
                                 
                                 <div class="form-group"> 
                                     <div class="col-sm-12">
                                             <div class="col-offset-2 col-md-1">
                                              <br>
                                             <label><strong>Unit</strong></label>
                                              <br>
                                              <input type="text" class="form-control" id="requested_unit" name="requested_unit" readonly>
                                              <!--  <select class="populate" id="requested_item" name="requested_item" style="width:100%" required>
                                                  <option value="">Select an Item</option>
                                                  <?php //foreach($item as $r) echo '<option value="'.$r[0].'">'.$r[1].' ('.$r[2].')'.'</option>';?>
                                                </select>-->
                                                <input type="hidden"  name="request_item_id" id="request_item_id">
                                             </div> 
                                             <div class="col-offset-2 col-md-3">
                                              <br>
                                              <!-- <label><strong>Description</strong></label>
                                              <br>
                                              <input type="text" class="form-control" name="requested_description" id="requested_description" readonly> -->
                                              <label><strong>Item </strong></label>
                                              <br>
                                              <input type="text" class="form-control" id="requested_item" name="requested_item" readonly>
                                            </div>
                                             <div class="col-offset-2 col-md-1">
                                              <br>
                                              <label><strong>Quantity</strong></label>
                                              <br>
                                              <input type="text" class="form-control" id="requested_qty" name="requested_qty" readonly>
                                            </div>
                                           <div class="col-offset-2 col-md-1">
                                        
                                              <label style="text-align: center;"><strong>Discount<br>(%)</strong></label>
                                              <br>
                                              <input type="text" class="form-control" id="requested_discount" name="requested_discount" onblur="computeTotal()">
                                            </div>
                                            <div class="col-offset-2 col-md-1">
                                              <label><strong> Unit Price</strong></label>
                                              <br>
                                              <input type="text" class="form-control" id="requested_unit_price" name="requested_unit_price" readonly>
                                             </div> 
                                           
                                            <!--<div class="col-offset-2 col-md-2">
                                              <label><strong>Discount %</strong></label>
                                              <input type="number" class="form-control" name="requested_item_discount" id="requested_item_discount">
                                            </div>
                                          -->
                                             <div class="col-offset-2 col-md-1">
                                              <label><strong>Total Price </strong></label>
                                              <br>
                                              <input class="form-control" id="requested_total_amount" name="requested_total_amount" readonly>
                                            </div> 
                                           <div class="col-offset-2 col-md-4">
                                            <br>
                                            <label><strong><span style="text-align: center;">&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Action</span></strong></label><br>
                                              <button type="submit" class="btn btn-info" style="width:70px;">Save</button><button type="button" class="btn btn-default" style="width:70px; margin-left: 5px;" onclick="cancel_order()">Cancel</button>
                                            </div>
                                      </div>
                                 </div>

                           </div>



                      </div>
                  </div>

                  </div>
                </div>
              </div>
</form>
          <br>

<!--purchase_order-->
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
                      <div class="form-group" style="padding:0px">
                          <input name="_table" id="_table" type="hidden"/>
                          <div class="col-md-4">
                            <label><b>Responsibility Center</b></label>
                            <select class="populate" style="width:100%" id="s_office" name="s_office">
                              <option value="">Select Responsibility Center</option>
                              <?php foreach($o as $r) echo '<option value="'.$r[0].'">'.$r[1].'</option>';?>
                            </select>
                          </div>  
                           <div class="col-md-4">
                            <label><b>Date Requested</b></label>
                            <input type="date" class="form-control" name="s_date" id="s_date">
                          </div>  
                          <div class="col-md-4">
                            <label><b>Status</b></label>
                            <select class="populate" style="width:100%" id="s_status" name="s_status">
                              <option value="">All</option>
                              <option value="Pending">Pending</option>
                              <option value="Approved">Approved</option>
                              <option value="Disapproved">Disapproved</option>
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
                  <table cellpadding="0" cellspacing="0" border="0" width="100%" id="spmsTable" class="table table-striped table-bordered datatables">
                      <thead>
                          <tr>
                              <th style="width : 10%">PR No.</th>
                              <th style="width : 13%">Responsibility Center</th>
                              <th style="width : 15%">Item Description</th>
                             <!-- <th style="width : 5%">Qty</th>
                              <th style="width : 5%">Unit</th>-->
                              <th style="width : 7%">Unit Cost</th>                              
                              <th style="width : 7%">Total Cost</th>
                              <th style="width:10%">Requested by</th>
                              <th style="width : 7%">Date Requested</th>
                              <th style="width : 10%">Purpose</th>
                              <th style="width : 15%; text-align:center">Remarks</th>
                              <th style="width : 10%">Status</th>
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

function po_form_(id, name){

 // var result = confirm("Do you want to XD request for "+id+"?");
 //// if (result) {
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
function cancel_order(){
  $('#divstyle1').slideUp();
}



function loadtable()
{ 
  $('#spmsTable').dataTable().fnClearTable();
  $('#spmsTable').dataTable().fnDraw();
  $('#spmsTable').dataTable().fnDestroy();
  $('#spmsTable').dataTable({
      "serverSide": true,
      "sAjaxSource": "<?php echo base_url('Process/purchase_request')?>"+"?loadtable=true&"+$('#searchForm').serialize(),
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
  var val = "";
  <?php
   foreach($item as $r) 
  {
    $val = "'".$r[7]."'";
    echo ' val += "<option value='.$val.'>'.htmlentities($r[1]).' ('.$r[2].')'.'</option>";';
  }
  ?>

  $('#id').val("");
  $('#office').val("");
  var comp_tot_cost = "'#total_cost'";
  var comp_qty = "'#qty'";
  var comp_unit = "'#unit_cost'";
  $('#divItems').empty();
  $('#divItems').append(' <input type="hidden" id="ctr" value = "1"/> '+
                       '<div class="form-group" id="row_1">'+ '<div class="col-md-1">'+'<center>'+'<label>'+'<b>Unit</b>'+'</label'+'</center>'+'</div>'+
                          '<div class="col-md-3">'+'<center>'+'<label>'+'<b>Item Description</b>'+'</label>'+'</center>'+'</div>'+
                          '<div class="col-md-1">'+'<center>'+'<label>'+'<b>Qty</b>'+'</label>'+'</center>'+'</div>'+
                          '<div class="col-md-1">'+'<center>'+'<label>'+'<b>Unit</b>'+'</label>'+'</center>'+'</div>'+
                          '<div class="col-md-1">'+'<center>'+'<label>'+'<b>Total Cost</b>'+'</label>'+'</center>'+'</div>'+
                          '<div class="col-md-3">'+'<center>'+'<label>'+'<b>Purpose</b>'+'</label>'+'</center>'+'</div>'+
                          '<div class="col-md-1">'+'<center>'+'<label>'+'<b>Add/Remove</b>'+'</label>'+'</center>'+'</div>'+
                        '</div>'+
                        '<div class="form-group" id="row_1">'+
                          '<div class="col-md-1">'+
                            '<input type="text" class="form-control" name="unit[]" id="unit" placeholder="" readonly>'+
                          '</div>'+
                          '<div class="col-md-3">'+
                            '<select class="populate" id="item" name="item[]" style="width:100%" onChange="showUnit(this.value, 1)" required>'+ '<option value="">Select an Item</option>'+val+'</select>'+
                          '</div>'+
                          '<div class="col-md-1">'+
                            '<input type="number" class="form-control" name="qty[]" id="qty" min="0" onchange="$('+comp_tot_cost+').val(($(this).val() * $('+comp_unit+').val())..toFixed(2))" placeholder="" required>'+
                          '</div>'+
                          '<div class="col-md-1">'+
                            '<input type="number" class="form-control" name="unit_cost[]" id="unit_cost" min="0" onchange="$('+comp_tot_cost+').val(($(this).val() * $('+comp_qty+').val()).toFixed(2))" placeholder="" required>'+
                          '</div>'+
                          '<div class="col-md-1">'+
                            '<input type="text" class="form-control" name="total_cost[]" id="total_cost" placeholder="" readonly>'+
                          '</div>'+
                          '<div class="col-md-3">'+
                            '<input type="text" class="form-control" name="purpose[]" id="purpose" placeholder="">'+
                          '</div>'+
                          '<div class="col-md-1" id="btn_1" >'+
                            '<center><input type="button" class="btn btn-primary" onClick="addNew(); $(this).hide()" id="btnAdd_1" name="btnAdd_[]" value="+"></input></center>'+
                          '</div>'+
                        '</div>');
  $("#item").select2();
}

function resetForm()
{
  // $('#s_user').val("");
  $('#s_office').val("");
  $('#s_status').val("");
  $('#s_date').val("");
  $('#s_status').select2({setVal:""});
  // $('#s_user').select2({setVal:""});
  $('#s_office').select2({setVal:""});
}

function computeTotal()
{
  var price = 0;
  var qty = 0;
  var discount = 0;

  ($('#requested_unit_price').val() != "")?price = $('#requested_unit_price').val():null;
  ($('#requested_discount').val() != "")?discount = $('#requested_discount').val():null;
  ($('#requested_qty').val() != "")?qty = $('#requested_qty').val():null;

  var tp = price*qty;
  var td = (price*(discount/100))*qty;
  $('#requested_total_amount').val((tp-td).toFixed(2));

  // var tot = 0;

  // $('label[name^="amount[]"]').each(function(){
  //   tot+=parseFloat(($(this).text()).substring(4));
  // });
  // $('#tot_amount').text('Php '+tot.toLocaleString("en-US"));

}

function addNew()
{ 
  //init += 1;  
  var val = "";
  var ctr = parseInt($('#ctr').val())+1;
  init = ctr; 
  $('#ctr').val(ctr)
  $('#btnAdd_'+(ctr-1)).hide();
  
  <?php
//<option></option>
   foreach($item as $r) 
  {
    $val = "'".$r[7]."'";
    echo ' val += "<option value='.$val.'>'.htmlentities($r[1]).' ('.$r[2].')'.'</option>";';
  }


  ?>
  var comp_tot_cost = "'#total_cost_"+ctr+"'";
  var comp_qty = "'#qty_"+ctr+"'";
  var comp_unit = "'#unit_cost_"+ctr+"'";
  $('#divItems').append('<div class="form-group" id="row_'+ctr+'">'+
      '<div class="col-md-1">'+
        '<input type="text" class="form-control" name="unit[]" id="unit_'+ctr+'" readonly>'+
      '</div>'+
      '<div class="col-md-3">'+
       '<select class="populate" id="item_'+ctr+'" name="item[]" onChange="showUnit(this.value, '+ctr+')" style="font-size:13px;width:100%" required>'+ '<option value="">Select an Item</option>'+
          val+'</select>'+
      '</div>'+
      '<div class="col-md-1">'+
        '<input type="number" class="form-control" name="qty[]" min = "0"  id="qty_'+ctr+'" onchange="$('+comp_tot_cost+').val(($(this).val() * $('+comp_unit+').val()).toFixed(2))" placeholder="" required>'+
      '</div>'+
      '<div class="col-md-1">'+
        '<input type="text" class="form-control" name="unit_cost[]" id="unit_cost_'+ctr+'" onchange="$('+comp_tot_cost+').val(($(this).val() * $('+comp_qty+').val()).toFixed(2))" placeholder="" required>'+
      '</div>'+
      '<div class="col-md-1">'+
        '<input type="text" class="form-control" name="total_cost[]" id="total_cost_'+ctr+'" placeholder="" readonly="readonly">'+
      '</div>'+
      '<div class="col-md-3">'+
        '<input type="text" class="form-control" name="purpose[]" id="purpose_'+ctr+'" placeholder="">'+
      '</div>'+
      '<div class="col-md-2" id="btn_'+ctr+'" >'+

      '</div>'+
  '</div>');
  $("#item_"+ctr).select2();

  var ctr = $('#ctr').val();
  $('#btn_'+ctr).empty();

  var t_c = 0, btn = "";
  $('select[name^="item[]"]').each(function(){
    t_c++;
  });
  // alert(t_c);
  (t_c > 1)?btn+='<input type="button" class="btn btn-danger" onClick="removeRow('+ctr+')" value="-" ></input>':null;
  btn+='<input type="button" class="btn btn-primary" style = "margin-left:2px;" onClick="addNew(); $(this).hide()" id="btnAdd_'+ctr+'" name="btnAdd_[]" value="+" ></input>';
  
  $('#btn_'+ctr).append(btn);

  var arr = $('input[name^="btnAdd_[]"]').length;
    var ct = 1;
    $('input[name^="btnAdd_[]"]').each(function(){
      (ct == arr)?$(this).show():$(this).hide();
      ct++;
    });

}

function removeRow(ctr)
{ 
  //init -= 1; 
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
}

<?php if($w_ == 1) { ?>

function del_(id, name){

  var result = confirm("Do you want to cancel request for "+name+"?");
  if (result) {
       $.ajax
        ({ type:"POST",
           async: true,
           url:"<?php echo base_url('Process/purchase_request')?>",
           data:{id:id, act:"delete"},
           dataType: 'json',
           cache: false,
           success: function(data)
            {
              if (data['mes'] == "Success")
              {
                alerts('Purchase Request has been cancelled.','s');
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

$(document).ready(function(){
  $('.populate').select2();

  <?php if($w_ == 1) { ?>
  $("#spmsForm").on('submit',(function(e) {
    e.preventDefault();
    $('#actionButtons').hide();
    $('#message').append("<div id='message2'></div>");
    $('#message2').append("<img src='<?php echo base_url('assets/img/loading.gif');?>'/>");
    $('#message2').append("    Processing...");
    $.ajax({
      url: '<?php echo base_url("Process/purchase_request"); ?>', 
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
    
  }));

  //new add purchase_order
  $("#spmsForm123").on('submit',(function(e){
      e.preventDefault();
   
    $.ajax({
      url: '<?php echo base_url("Process/purchase_request"); ?>', 
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

//trylanggg
function showUnit(id, counter){
  $.ajax
        ({ type:"POST",
           async: true,
           url:"<?php echo base_url('Process/purchase_request')?>",
           data:{id:id, act2:"getData"},
           dataType: 'json',
            cache: false,
           success: function(data)
            {
              if(counter == 1) 
              {
                $('#unit').val(data[0][0]);
                // $('#qty').attr({"max":data[0][1]});
              } 
              else
              {
                $('#unit_'+counter+'').val(data[0][0]);
                // $('#qty_'+counter+'').attr({"max":data[0][1]});
              }
              $value.val(data[0][0]);
              alert($value);
             },
             error: function(data)
             {
                   alerts('An error occured. Please reload the page and try again.');
             }

    });
}

$(document).ready(function(){
  loadtable();
});

</script>