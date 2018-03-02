<div id="page-content">
  <div id='wrap'>
    <div id="page-heading">
      <ol class="breadcrumb">
        <li>Administrator</li>
          <li>Delivery</li>
      </ol>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <!-- HIDDEN FORM -->
          <div class="panel panel-inverse" style="display: none;">
              <div class="panel-heading">
                  <h4>Delivery Form</h4>
                  <div class="options">
                    <a class="panel-collapse" href="#">
                      <i class="fa fa-chevron-up"></i></a>
                  </div>
              </div>
              <form action="" class="form-horizontal row-border"  method="POST" id="spmsForm">
              <input type="hidden" value="add" name="id" id="id"/>
              <input type="hidden" value="" name="delivery_id" id="delivery_id"/>
              <input type="hidden" value="" name="po_delivery" id="po_delivery"/>
              <div class="panel-body" id="divstyle" >
                   <form action="" class="form-horizontal row-border"  method="POST" id="spmsForm">
                      <input type="hidden" id="id" name="id"/>
                      <div class="form-group">
                          <label class="col-sm-2 control-label">P.O. #</label>
                          <div class="col-sm-4">
                             <input type="text" class="form-control" name="po_no" id="po_no"placeholder="" >
                          </div>
                          <label class="col-sm-2 control-label">Supplier</label>
                          <div class="col-sm-4">
                             <select name="supplier" id="supplier" style="width:100%" class="populate" >
                              <option value="">All</option>
                              <?php 
                                foreach($supplier as $r)
                                {
                                  echo '<option value="'.$r[9].'">'.$r[1].'</option>';
                                }
                              ?>
                            </select>
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-2 control-label">Item</label>
                          <div class="col-sm-10">
                             <select name="product" id="product" style="width:100%" class="populate" >
                              <option value="">All</option>
                              <?php 
                                foreach($product as $r)
                                {
                                  echo '<option value="'.$r[7].'">'.$r[1].'</option>';
                                }
                              ?>
                            </select>
                          </div>
                      </div>
                       <div class="form-group">
                          <div class="col-sm-2"></div>
                          <div class="col-sm-10">
                            <table>
                              <tr>
                                <td style="padding-left:0px"><button type='button' class='btn-sm btn-success' id='select-all1'><span>Select All</span></button></br></br> </td>
                                <td style="padding-left:0px"><button type='button' class='btn-sm btn-success' id='deselect-all1'> <span>Deselect All</span></button></br></br></td>
                              </tr>
                            </table>
                          </div>
                          <label class="col-sm-2 control-label">Item Category</label>
                          <div class="col-sm-10">
                              <select multiple="multiple" name="category[]" id="multi-select" style="width:100%" >
                              <?php 
                                foreach($category as $r)
                                {
                                  echo '<option value="'.$r['id'].'" selected>'.$r['desc'].'</option>';
                                }
                              ?>
                            </select>
                          </div>
                      </div>
                       <div class="form-group">
                          <label class="col-sm-2 control-label">P.O. Status</label>
                          <div class="col-sm-10">
                             <select name="po_status" id="po_status" style="width:100%" class="populate" >
                              <option value="">All</option>
                              <option value="New">New</option>
                              <option value="Released">Released</option>
                              <option value="Partially Received">Partially Received</option>
                              <option value="Received">Received</option>
                              <option value="Changed Order">Changed Order</option>
                              <option value="Cancelled">Cancelled</option>
                            </select>
                          </div>
                      </div>
                      <?php if($w_ == 1) { ?>
                      <div class="panel-footer">
                          <div class="row">
                              <div class="col-lg-offset-2 col-lg-10">
                                  <div id="message"></div> 
                                  <div class="btn-toolbar" id = "actionButtons">
                                      <button class="btn-primary btn" type="submit">Search</button>
                                      <button class="btn-default btn" type="reset" onclick="clearForm()">Reset</button>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <?php }?>
                   </form>
              </div>
          </div>

          <div class="panel panel-inverse">
              <div class="panel-heading">
                  <h4>Purchase Orders</h4>

                  <div class="options">
                    <a class="panel-collapse" href="#">
                    <i class="fa fa-chevron-up"></i></a>
                  </div>
              </div>
              <div class="panel-body collapse in">
                <h4> Stock Legend: </h4>
                <table style="padding:1px" cellspacing="0" cellpadding="0">
                    <tr>
                      <td> <button style = "font-size:16px" class ="btn-primary btn-xs" data-tooltip='Add Delivery'> <i class='fa fa-truck'> </i> <span> </span> 
                      </button> Add Delivery
                    </td>
                  </tr>


                </table>
                <br>

                  <table style="font-size:13px" cellpadding="0" cellspacing="0" border="0" width="100%" id="spmsTable" class="table table-striped table-bordered datatables">
                      <thead>
                          <tr>
                              <th style="width : 10%">P.O. #</th>
                              <th style="width : 15%">Supplier</th>
                              <th style="width : 25%">Item</th>
                              <th style="width : 10%">Total Price</th>
                              <th style="width : 10%">Delivery Date</th>
                              <th style="width : 10%">Created By</th>
                              <th style="width : 10%">Status</th>
                              <th style="width : 5%; text-align:center">Action</th>
                          </tr>
                      </thead>
                      <tbody>
                      
                      </tbody>
                  </table>
              </div>
          </div>

          <div class="panel panel-inverse" id="divDelivery" style="display:none">

              <div class="panel-heading">
                  <h4 id="divDT"></h4>
                  <div class="options">
                    <a class="panel-collapse" href="#">
                    <i class="fa fa-chevron-up"></i></a>
                  </div>
              </div>
              <div class="panel-body collapse in">
                <form action="" class="form-horizontal row-border"  method="POST">

                  <h5 style="padding-left:20px">Record the delivery details for each ordered item below.</h5>
                  <input type="hidden" id="ctr" value = "1"/> 
                   <div class="form-group">
                    <div class="col-md-2" style="text-align:right;">
                      <label><b>Supplier</b></label>
                    </div>
                    <div class="col-md-4">
                      <label name="supplier_" id="supplier_" />
                    </div>    
                    <div class="col-md-2" style="text-align:right;">
                      <label><b>Delivery Date</b></label>
                    </div>
                    <div class="col-md-4">
                      <label name="delivery_date" id="delivery_date" />
                    </div>   
                  </div>
                  <div class="form-group" id="row_1" style="padding-bottom:0px">
                    <div class="col-md-2" style="text-align:center;">
                      <label><b>Item</b></label>
                    </div>
                    <div class="col-md-1" style="text-align:center;">
                      <label><b>Qty</b></label>
                    </div>
                    <div class="col-md-1" style="text-align:center;">
                      <label><b>Unit Price</b></label>
                    </div>
                    <div class="col-md-1" style="text-align:center;">
                      <label><b>Discount %</b></label>
                    </div>   
                    <div class="col-md-2" style="text-align:center;">
                      <label><b>Line Item Amount</b></label>
                    </div>   
                    <div class="col-md-1" style="text-align:center;">
                      <label><b>Delivered</b></label>
                    </div>
                    <div class="col-md-1" style="text-align:center;">
                      <label><b>Returned</b></label>
                    </div>
                    <div class="col-md-1" style="text-align:center;">
                      <label><b>Accepted</b></label>
                    </div>
                    <div class="col-md-2" style="text-align:center;">
                      <label><b>Manage Deliveries</b></label>
                    </div>  
                  </div>
                  <div id="divItems" style="display:none">
                     
                  </div>
                </form>
               
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade modals" id="showDelivery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:95%">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title"><label id="modaltitle"></label></h4>
        </div>
        <form action="" class="form-horizontal" id="spmsForm2"  enctype="multipart/form-data">
          <div class="modal-body">
            <input type="hidden" name="pol_id" id ="pol_id"/>
            <input type="hidden" name="d_id" id ="d_id"/>
            <div class="form-group" id="row_1" style="padding-bottom:0px; border-bottom:1px solid">
              <div class="col-md-2" style="text-align:center;">
                <label><b>Item</b></label>
              </div>
              <div class="col-md-2" style="text-align:center;">
                <label><b>Qty</b></label>
              </div>
              <div class="col-md-2" style="text-align:center;">
                <label><b>Unit Price</b></label>
              </div>
              <div class="col-md-1" style="text-align:center;">
                <label><b>Discount %</b></label>
              </div>   
              <div class="col-md-2" style="text-align:center;">
                <label><b>Line Item Amount</b></label>
              </div>   
              <div class="col-md-1" style="text-align:center;">
                <label><b>Delivered</b></label>
              </div>
              <div class="col-md-1" style="text-align:center;">
                <label><b>Returned</b></label>
              </div>
              <div class="col-md-1" style="text-align:center;">
                <label><b>Accepted</b></label>
              </div>
            </div>
            <div id="divItems2" style="display:none">
                     
            </div>
            <div class="panel-heading" style="margin-bottom:20px; background-color:#4f5259">
                <h4 style="color:white; padding-left:15px" id="delTitle">Add New Delivery</h4>
            </div>
            <input type="hidden" id="id" name="id"/>
            <input type="hidden" id="act" name="act" value="addDelivery"/>
            <div class="form-group">
              <label class="col-sm-2 control-label">No. of Accepted Items<span style="color:red">*</span></label>
              <div class="col-sm-2">
                 <input type="number" class="form-control" name="delivered_item" id="delivered_item" min = "0" placeholder="" onBlur="computeTotal()" required>
              </div>
              <label class="col-sm-2 control-label">No. of Returned Items</label>
              <div class="col-sm-2">
                 <input type="number" class="form-control" name="returned_item" id="returned_item" min = "0" placeholder="" required value="0">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Actual Unit Price<span style="color:red">*</span></label>
              <div class="col-sm-2">
                 <input type="number" class="form-control" name="actual_unit_price" id="actual_unit_price" onBlur="computeTotal()" step="0.01" min = "0" placeholder="" required>
              </div>
              <label class="col-sm-2 control-label">Actual Discount(%)</label>
              <div class="col-sm-2">
                 <input type="number" class="form-control" step="1" max="100" min ="0" name="actual_discount" id="actual_discount" onBlur="computeTotal()" placeholder="" required>
              </div>
              <label class="col-sm-2 control-label">Actual Cost</label>
              <div class="col-sm-2">
                 <label id="actual_amount" class="form-control">Php 0.00</label>
              </div>
            </div>
             <div class="form-group">
              <label class="col-sm-2 control-label">Remarks</label>
              <div class="col-sm-10" style="text-align:right">
                <textarea name="remarks" id="remarks" class="form-control"></textarea>
              </div>
            </div>
             <div class="form-group">
              <label class="col-sm-2 control-label">Received By</label>
              <div class="col-sm-2">
                 <input type="text" class="form-control" name="received_by" id="received_by" placeholder="" value="<?php echo $this->session->userdata('NAME'); ?>" required>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-12" style="text-align:right">
                  <div id="message3"></div> 
                  <div class="btn-toolbar" id = "actionButtons2">
                      <button class="btn-primary btn" type="submit">Submit Delivery and Update Inventory</button>
                      <button class="btn-danger btn" type="button" id="cancelUpdate" onclick="clearForm2()" style="display:none">Cancel Update</button>
                  </div>
              </div>
            </div>
            <table style="margin-top:50px" cellpadding="0" cellspacing="0" border="0" width="100%" id="spmsTable2" class="table table-striped table-bordered datatables">
                <thead>
                    <tr>
                        <th style="width : 5%">ID No.</th>
                        <th style="width : 20%">Item</th>
                        <th style="width : 5%">Delivered</th>
                        <th style="width : 5%">Returned</th>
                        <th style="width : 10%">Unit Price</th>
                        <th style="width : 10%">Discount</th>
                        <th style="width : 10%">Total</th>
                        <th style="width : 10%">Date</th>
                        <th style="width : 10%">Created By</th>
                        <th style="width : 10%">Remarks</th>
                        <th style="width : 5%; text-align:center">Action</th>
                    </tr>
                </thead>
                <tbody>
                
                </tbody>
            </table>
         </form>
          </div>
          <div class="modal-footer">
            <div id="message3"></div> 
            <div class="btn-toolbar" id = "actionButtons2">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
        </form>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
<script type='text/javascript' src='<?php echo base_url('assets')?>/js/jquery-1.10.2.min.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/js/jqueryui-1.10.3.min.js'></script>
<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/form-select2/select2.min.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/quicksearch/jquery.quicksearch.min.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/form-multiselect/js/jquery.multi-select.min.js'></script>
<script type='text/javascript' src='<?php echo base_url('assets')?>/js/custom.js'></script> 

<script language="JavaScript" type='text/javascript'>

function loadtable()
{
  var data = $('#spmsForm').serialize();
  $('#spmsTable').dataTable().fnClearTable();
  $('#spmsTable').dataTable().fnDraw();
  $('#spmsTable').dataTable().fnDestroy();

  $('#spmsTable').dataTable({
      "serverSide": true,
      "sAjaxSource": "<?php echo base_url('Process/delivery')?>"+"?loadtable=true&"+data,
      "deferLoading": 10,
      "bPaginate": true,
      "fnInitComplete": function(){
          $('#message').empty();
          $('#actionButtons').show();
      }
  });
}

function loadtable2()
{
  var data = $('#spmsForm2').serialize();
  $('#spmsTable2').dataTable().fnClearTable();
  $('#spmsTable2').dataTable().fnDraw();
  $('#spmsTable2').dataTable().fnDestroy();

  $('#spmsTable2').dataTable({
      "serverSide": true,
      "sAjaxSource": "<?php echo base_url('Process/delivery')?>"+"?loaddelivery=true&"+data,
      "deferLoading": 10,
      "bPaginate": true,
      "aoColumns" : [ { sWidth: "5%" }, { sWidth: "20%" }, { sWidth: "5%" }, 
      { sWidth: "5%" },{ sWidth: "10%" },{ sWidth: "10%" },{ sWidth: "10%" },
      { sWidth: "10%" },{ sWidth: "10%" },{ sWidth: "10%" }, { sWidth: "5%","bSearchable": false }],
      "fnInitComplete": function(){
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
  $('#divDelivery').hide();
  $('#id').val("");
  $('#act').val("addDelivery");
  $('#divItems2').empty(); 
  $('#ctr').val("1");
  $('#supplier').val("");
  $('#supplier').select2({setVal:""});
  $('#supplier_').val("");
  $('#delivery_id').val("");
  $('#po_delivery').val("");
  $('#delivery_date').val("");
  $('#tot_amount').text('Php 0.00');
  $('#divItems').empty();
  $('#divItems').append(' <input type="hidden" id="ctr" value = "1"/> '+
                        '<div class="form-group" id="row_1" style="padding:0px; padding-top:12px">'+
                          '<div class="col-md-2">'+
                            '<label id="item_1" name="item[]" style=" text-align:right">'+
                          '</div>'+
                          '<div class="col-md-1" id="ctp_1"style=" text-align:left" >'+
                            '<label name="unit[]" id="unit_1" style=" text-align:left">'+
                          '</div>'+
                          '<div class="col-md-1" style=" text-align:right">'+
                            '<label name="price[]" id="price_1" style=" text-align:right">'+
                          '</div>'+
                          '<div class="col-md-1" style=" text-align:right">'+
                            '<label name="discount[]" id="discount_1"  style=" text-align:right">'+
                          '</div>'+
                          '<div class="col-md-2" style="text-align:right; padding-right:20px">'+
                            '<label id="amount_1" name="amount[]">Php 0.00</label>'+
                          '</div>'+
                          '<div class="col-md-1" style="text-align:right; padding-right:20px">'+
                            '<label id="delivered_1" name="delivered[]"></label>'+
                          '</div>'+
                          '<div class="col-md-1" style="text-align:right; padding-right:20px">'+
                            '<label id="returned_1" name="returned[]"></label>'+
                          '</div>'+
                          '<div class="col-md-1" style="text-align:right; padding-right:20px">'+
                            '<label id="accepted_1" name="accepted[]"></label>'+
                          '</div>'+
                          '<div class="col-md-2" id="btn_1" style="text-align:center">'+
                          '</div>'+
                        '</div>');

}

function clearForm2()
{
  $('#d_id').val("");
  $('#act').val("addDelivery");
  $('#returned_item').val("0");
  $('#delivered_item').val("");
  $('#received_by').val("<?php echo $this->session->userdata('NAME')?>");
  $('#remarks').val("");
  $('#delTitle').text("Add New Delivery");
  $('#cancelUpdate').hide();
 
}

function rebuildSelect(val)
{
  $('#multi-select').multiSelect({
  selectableHeader: "<input type='text' class='form-control' style='margin-bottom: 10px;'  autocomplete='off' placeholder='Filter entries...'>",
  selectionHeader: "<input type='text' class='form-control' style='margin-bottom: 10px;' autocomplete='off' placeholder='Filter entries...'>",
  afterInit: function(ms){
    var that = this,
        $selectableSearch = that.$selectableUl.prev(),
        $selectionSearch = that.$selectionUl.prev(),
        selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
        selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';

    that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
    .on('keydown', function(e){
      if (e.which === 40){
        that.$selectableUl.focus();
        return false;
      }
    });

    that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
    .on('keydown', function(e){
      if (e.which == 40){
        that.$selectionUl.focus();
        return false;
      }
    });
  },
  afterSelect: function(){
    this.qs1.cache();
    this.qs2.cache();
  },
  afterDeselect: function(){
    this.qs1.cache();
    this.qs2.cache();
  }
  });

$('#multi-select').multiSelect('refresh');

}

<?php if($w_ == 1) { ?>

  function del_(id, name){

  var result = confirm("Do you want to proceed deleting "+name+"?");
  if (result) {
       $.ajax
        ({ type:"POST",
           async: true,
           url:"<?php echo base_url('Process/delivery')?>",
           data:{id:id, act:"delete"},
           dataType: 'json',
           cache: false,
           success: function(data)
            {
              if (data['mes'] == "Success")
              {
                alerts('Delivery has been deleted.','s');
                delivery_($('#delivery_id').val(), $('#po_delivery').val());
                $('#showDelivery').modal('hide');

                loadtable();
                clearForm2();

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

function edit_(value){
  $.ajax
    ({ type:"POST",
       async: true,
       url:"<?php echo base_url('Process/delivery')?>",
       data:{id:value, loadspecific:'true'},
       dataType: 'json',
       cache: false,
       success: function(data)
         {
            $('#d_id').val(data[0][11]);
            $('#delivered_item').val(data[0][12]);
            $('#returned_item').val(data[0][13]);
            $('#remarks').val(data[0][9]);
            $('#received_by').val(data[0][7]);

            $('#actual_unit_price').val(data[0][4]);
            $('#actual_discount').val(data[0][5]);
            $('#actual_amount').text('Php '+data[0][6]);
            $('#act').val("saveDelivery");

            $('#delTitle').text("Update Delivery Details");
            $('#cancelUpdate').show();

            $('#showDelivery').animate({ scrollTop: 0 }, 'slow');
            
         },
         error: function(data)
         {
            alerts('An error occured. Please reload the page and try again.','e');
         }
    });
}

function addNew(id)
{
  
    $.ajax
      ({ type:"POST",
         async: false,
         url:"<?php echo base_url('Process/purchase_order')?>",
         data:{id:id, initProduct:"initProduct"},
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

            $('#divItems').append('<div class="form-group" style="padding:0px; padding-top:12px" id="row_'+ctr+'">'+
                '<div class="col-md-2">'+
                  '<label id="item_'+ctr+'" name="item[]"/>'+
                '</div>'+
                '<div class="col-md-1" id="ctp_'+ctr+'" style=" text-align:left">'+
                  '<label name="unit[]" id="unit_'+ctr+'" style=" text-align:left">'+
                '</div>'+
                '<div class="col-md-1" style=" text-align:right">'+
                  '<label name="price[]" id="price_'+ctr+'" style=" text-align:right">'+
                '</div>'+
                '<div class="col-md-1" style=" text-align:right">'+
                  '<label name="discount[]" id="discount_'+ctr+'" style=" text-align:right">'+
                '</div>'+
                '<div class="col-md-2" style="text-align:right;padding-right:20px ">'+
                  '<label id="amount_'+ctr+'" name="amount[]">Php 0.00</label>'+
                '</div>'+
                '<div class="col-md-1" style="text-align:right; padding-right:20px">'+
                  '<label id="delivered_'+ctr+'" name="delivered[]"></label>'+
                '</div>'+
                '<div class="col-md-1" style="text-align:right; padding-right:20px">'+
                  '<label id="returned_'+ctr+'" name="returned[]"></label>'+
                '</div>'+
                '<div class="col-md-1" style="text-align:right; padding-right:20px">'+
                  '<label id="accepted_'+ctr+'" name="accepted[]"></label>'+
                '</div>'+
                '<div class="col-md-2" id="btn_'+ctr+'" style="text-align:center">'+
                '</div>'+
                
            '</div>');


           },
           error: function(data)
           {
              alerts('An error occured. Please reload the page and try again.','e');
           }

      });
  
  

}

function delivery_(id, name){

  clearForm();
  $('#divDelivery').slideDown();
  $('#divDT').text("Add New Delivery for "+name);
  $('#id').val(id);
  $('#delivery_id').val(id);
  $('#po_delivery').val(name);
   $.ajax
    ({ type:"POST",
       async: false,
       url:"<?php echo base_url('Process/delivery')?>",
       data:{id:id, loadSpecific:"loadSpecific"},
       dataType: 'json',
       cache: false,
       success: function(data)
        {
          $('#supplier_').text(data[0]['supplier_name']);
          $('#delivery_date').text(data[0]['delivery_date_']);
          $('#divItems').show(); 
          for(var i = 0; i < data.length; i++)
          {
            if(i!=data.length-1)
              addNew(data[0]['s_id']);
            if(data[i]['qty'] > data[i]['accepted'])
              $('#btn_'+parseInt(i+1)).append('<button type="button" data-tooltip="Add/Remove Delivery" class="btn btn-primary" onClick="showDelivery('+data[i]['polid']+');">+/-</button><button type="button" style="margin-left:10px" class="btn btn-danger" data-tooltip="Out of Stock" onClick="outOfStock('+data[i]['polid']+');">X</button>');
            else
              $('#btn_'+parseInt(i+1)).append('<button type="button" data-tooltip="Add/Remove Delivery" class="btn btn-primary" onClick="showDelivery('+data[i]['polid']+');">+/-</button>');
            $('#item_'+parseInt(i+1)).text(data[i]['product']);
            $('#unit_'+parseInt(i+1)).text(data[i]['qty_']);
            $('#price_'+parseInt(i+1)).text(data[i]['unit_price_']);
            $('#discount_'+parseInt(i+1)).text(data[i]['discount_']);
            $('#amount_'+parseInt(i+1)).text(data[i]['amount_']);
            $('#delivered_'+parseInt(i+1)).text(data[i]['delivered']);
            $('#accepted_'+parseInt(i+1)).text(data[i]['accepted']);
            $('#returned_'+parseInt(i+1)).text(data[i]['returned']);

            var n = $(document).height();
            $('html, body').animate({ scrollTop: n }, 1000);
          }

          $('#tot_amount').text(data[0]['total_price_']);

         },
         error: function(data)
         {
            alerts('An error occured. Please reload the page and try again.','e');
         }

  });
}

function showDelivery(id)
{
  $('#divItems2').empty(); 
  $('#pol_id').val(id);
  $.ajax
    ({ type:"POST",
       async: false,
       url:"<?php echo base_url('Process/delivery')?>",
       data:{id:id, loadSpecific:"loadSpecific", loadPOL:'loadPOL'},
       dataType: 'json',
       cache: false,
       success: function(data)
        {
          $('#modaltitle').text(data[0]['po_no']+' | Supplier: '+data[0]['supplier_name']+' | Expected Delivery Date:'+data[0]['delivery_date']);
          $('#divItems2').show(); 
          $('#divItems2').append(' <input type="hidden" id="ctr" value = "1"/> '+
                        '<div class="form-group" id="row_1" style="padding:0px; border-bottom:1px solid">'+
                          '<div class="col-md-2">'+
                            '<label style="text-align:right">'+data[0]['product']+'</label>'+
                          '</div>'+
                          '<div class="col-md-2" id="ctp_1"style=" text-align:left" >'+
                            '<label style=" text-align:left">'+data[0]['qty_']+'</label>'+
                          '</div>'+
                          '<div class="col-md-2" style=" text-align:right">'+
                            '<label text-align:right">'+data[0]['unit_price_']+'</label>'+
                          '</div>'+
                          '<div class="col-md-1" style=" text-align:right">'+
                            '<label style=" text-align:right">'+data[0]['discount_']+'</label>'+
                          '</div>'+
                          '<div class="col-md-2" style="text-align:right; padding-right:20px">'+
                            '<label >'+data[0]['amount_']+'</label>'+
                          '</div>'+
                          '<div class="col-md-1" style="text-align:right; padding-right:20px">'+
                            '<label >'+data[0]['delivered']+'</label>'+
                          '</div>'+
                          '<div class="col-md-1" style="text-align:right; padding-right:20px">'+
                            '<label >'+data[0]['returned']+'</label>'+
                          '</div>'+
                          '<div class="col-md-1" style="text-align:right; padding-right:20px">'+
                            '<label>'+data[0]['accepted']+'</label>'+
                          '</div>'+
                        '</div>');

          $('#actual_unit_price').val(data[0]['unit_price_'].substr(4));
          $('#actual_discount').val(data[0]['discount_']);
          $('#delivered_item').attr({"max":data[0]['qty'] - data[0]['accepted']});
          $('#actual_amount').text("Php 0.00");
          $('#showDelivery').modal('show');
          loadtable2();
         },
         error: function(data)
         {
            alerts('An error occured. Please reload the page and try again.','e');
         }

  });
  
}

function outOfStock(id)
{
  var r = confirm("You are tagging the Purchase Order Line Item as Closed due to Out of Stock status. Partially accepted deliveries will not be deleted. This change will not affect the existing values in the inventory. \n\nDo you want to proceed?");
 
  if (r == true)
  {
    $('#pol_id').val(id);
    $.ajax
      ({ type:"POST",
         async: false,
         url:"<?php echo base_url('Process/delivery')?>",
         data:{id:id, act:"outOfStock"},
         dataType: 'json',
         cache: false,
         success: function(data)
          {
              if (data['mes'] == "Success")
                {
                  alerts('Puchase Order has been updated.','s');
                  loadtable();
                  clearForm();
                }
           },
           error: function(data)
           {
              alerts('An error occured. Please reload the page and try again.','e');
           }

    });
  }
}

function computeTotal()
{
  if($('#delivered_item').val() != "" && $('#actual_unit_price').val() != "" && $('#actual_discount').val() != "")
  {
    di = parseFloat($('#delivered_item').val());
    up = parseFloat($('#actual_unit_price').val());
    d = parseFloat($('#actual_discount').val());
  
    $('#actual_amount').text("Php "+(((di*up)-((di*up)*(d/100))).toFixed(2)).toLocaleString("en-US", {minimumFractionDigits: 2,maximumFractionDigits: 2}));
  }
}

function submitDelivery_(id){

  var result = confirm("Do you want to proceed saving the changes for this Purchase Order?");
  if (result == true) {
       $.ajax
        ({ type:"POST",
           async: true,
           url:"<?php echo base_url('Process/delivery')?>",
           data:{id:id, act:"submitDelivery"},
           dataType: 'json',
           cache: false,
           success: function(data)
            {
              if (data['mes'] == "Success")
              {
                alerts('Delivery details has been saved.','s');
                loadtable();
                clearForm();
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
  
  rebuildSelect();
  $('.populate').select2();
  $('#select-all1').click(function(){
    $('#multi-select').multiSelect('select_all');
  });

  $('#deselect-all1').click(function(){
    $('#multi-select').multiSelect('deselect_all');
  });

  <?php if($w_ == 1) { ?>
  $("#spmsForm").on('submit',(function(e) {
    e.preventDefault();
    $('#actionButtons').hide();
    $('#message').append("<div id='message2'></div>");
    $('#message2').append("<img src='<?php echo base_url('assets/img/loading.gif');?>'/>");
    $('#message2').append("    Searching...");
    loadtable(); 
    var n = $(document).height();
    $('html, body').animate({ scrollTop: n }, 1000);
  }));

  $("#spmsForm2").on('submit',(function(e) {
    e.preventDefault();
    $('#actionButtons2').hide();
    $('#message3').append("<div id='message4'></div>");
    $('#message4').append("<img src='<?php echo base_url('assets/img/loading.gif');?>'/>");
    $('#message4').append("    Processing...");
    $.ajax
      ({ 
          url:"<?php echo base_url('Process/delivery')?>",
          type: "POST",        
          data: new FormData(this), 
          dataType: 'json',
          contentType: false,     
          processData: false,  
          cache: false, 
         success: function(data)
          {
            if (data['mes'] == "Success")
            {
              alerts('Delivery details has been saved.','s');
              loadtable();
              loadtable2();
              clearForm2();
              delivery_($('#delivery_id').val(), $('#po_delivery').val());
            }
            else
              alerts(data['mes'],'w');
            $('#message3').empty();
            $('#actionButtons2').show();
            $('#showDelivery').modal('hide');
           },
           error: function(data)
           {
              alerts('An error occured. Please reload the page and try again.','e');
              $('#message3').empty();
              $('#actionButtons2').show();
           }

      });
    loadtable(); 
  }));

  <?php }?>


});

$(document).ready(function(){
  loadtable();
});

</script>