<div id="page-content">
  <div id='wrap'>
    <div id="page-heading">
      <ol class="breadcrumb">
        <li>Administrator</li>
          <li>Supplier/Vendor</li>
      </ol>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-inverse">
              <div class="panel-heading">
                  <h4>Supplier Form</h4>
                  <div class="options">
                    <a class="panel-collapse" href="#">
                      <i class="fa fa-chevron-down"></i></a>
                  </div>
              </div>
              <div class="panel-body" id="divstyle" style="display:none;">
                   <form action="" class="form-horizontal row-border"  method="POST" id="spmsForm">
                      <input type="hidden" id="id" name="id"/>
                      <input type="hidden" id="act" name="act" value="add"/>
                      <div class="form-group">
                          
                          <div class="col-sm-2">
                            <label class="control-label">Supplier Name<span style="color:red">*</span></label>
                            <input type="text" class="form-control" name="supplier_name" id="supplier_name"placeholder="" required>
                          </div>
                          
                          <div class="col-sm-6">
                            <label class="control-label">Address<span style="color:red">*</span></label>
                            <input type="text" class="form-control" name="address" id="address" placeholder="" required>
                          </div>

                          <div class="col-sm-2">
                            <label class="control-label">Contact Person</label>
                            <input type="text" class="form-control" name="contact_person" id="contact_person"placeholder="">
                          </div>

                          <div class="col-sm-2">
                            <label class="control-label">Tax Identification No.</label>
                            <input type="text" class="form-control" name="tin_no" id="tin_no" placeholder="">
                          </div>
                      </div>
                      <div class="form-group">
                          
                          <div class="col-sm-2">
                            <label class="control-label">Telephone No.<span style="color:red">*</span></label>
                            <input type="text" class="form-control" name="tel_no" id="tel_no"placeholder="">
                          </div>
                          
                          <div class="col-sm-2">
                            <label class="control-label">Mobile No.</label>
                            <input type="text" class="form-control" name="mobile" id="mobile"placeholder="">
                          </div>
                          <div class="col-sm-2">
                            <label class="control-label">Supplier Type</label>
                            <div class="">
                              <select class="populate" style="width:100%" id="supplier_type" name="supplier_type" required>
                                <option value="Supply">Supply</option>
                                <option value="Property">Property</option>
                                <option value="Service">Service</option>
                              </select>
                            </div>
                          </div>
                          
                          <div class="col-sm-4">
                            <label class="control-label">Service Description</label>
                            <input type="text" class="form-control" name="service_desc" id="service_desc" placeholder="">
                            <small>Only if the selected Supplier Type is Service</small>
                          </div>
                      </div>
                      <div class="form-group">
                          
                          <div class="col-sm-10">
                            <label class="control-label">Select Items</label>
                            <select multiple="multiple" id="multi-select" name="product[]" style = "width:100%">

                            </select>
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
                   </form>
              </div>
          </div>

          <div class="panel panel-inverse">
              <div class="panel-heading">
                  <h4>Supplier</h4>
                  <div class="options">
                    <a class="panel-collapse" href="#">
                    <i class="fa fa-chevron-up"></i></a>
                  </div>
              </div>
              <div class="panel-body collapse in">
                  <table cellpadding="0" cellspacing="0" border="0" width="100%" id="spmsTable" class="table table-striped table-bordered datatables">
                      <thead>
                          <tr>
                              <th style="width : 10%">Supplier Name</th>
                              <th style="width : 20%">Address</th>
                              <th style="width : 20%">Phone</th>
                              <th style="width : 10%">TIN No.</th>
                              <th style="width : 10%">Supplier Type</th>
                              <th style="width : 20%">Items</th>
                              <th style="width : 10%; text-align:center">Action</th>
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

function loadtable()
{
  $('#spmsTable').dataTable().fnClearTable();
  $('#spmsTable').dataTable().fnDraw();
  $('#spmsTable').dataTable().fnDestroy();

  $('#spmsTable').dataTable({
      "serverSide": true,
      "sAjaxSource": "<?php echo base_url('Process/supplier_vendor')?>"+"?loadtable=true",
      "deferLoading": 10,
      "bPaginate": false,
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
  $('#id').val("");
  $('#supplier_name').val("");
  $('#address').val("");
  $('#contact_person').val("");
  $('#tel_no').val("");
  $('#mobile').val("");
  $('#act').val("add");
  rebuildSelect(0);
}

<?php if($w_ == 1) { ?>

function del_(id, name){

  var result = confirm("Do you want to proceed deleting "+name+"?");
  if (result) {
       $.ajax
        ({ type:"POST",
           async: true,
           url:"<?php echo base_url('Process/supplier_vendor')?>",
           data:{id:id, act:"delete"},
           dataType: 'json',
           cache: false,
           success: function(data)
            {
              if (data['mes'] == "Success")
              {
                alerts('Supplier/Vendor has been deleted.','s');
                loadtable();
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
       url:"<?php echo base_url('Process/supplier_vendor')?>",
       data:{id:value, getspecific:'true'},
       dataType: 'json',
       cache: false,
       success: function(data)
         {
            $('#id').val(data[0][9]);
            $('#supplier_name').val(data[0][0]);
            $('#address').val(data[0][1]);
            $('#contact_person').val(data[0][2]);
            $('#tel_no').val(data[0][7]);
            $('#mobile').val(data[0][8]);
            $('#supplier_type').val(data[0][4]);
            $('#supplier_type').select2({setVal:data[0][4]});

            $('#tin_no').val(data[0][3]);
            $('#act').val("save");
            rebuildSelect(data[0][10]);
            
            $('#divstyle').slideDown();
            $("html, body").animate({scrollTop: 0}, 1000);
         },
         error: function(data)
         {
            alerts('An error occured. Please reload the page and try again.','e');
         }
    });
}

<?php }?>

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

  $('#multi-select').empty();
  $('#multi-select').multiSelect('refresh'); 
  $.ajax
    ({ type:"POST",
       async: true,
       url:"<?php echo base_url('Process/supplier_vendor')?>",
       data:{loadProducts:"loadProducts", id:0},
       dataType: 'json',
       cache: false,
       success: function(data)
         {
            for(var i =0; i<data.length; i++)
            {
              var s = '';
              
              if(val == 0)
              {
                  $('#multi-select').append('<option value="'+data[i][8]+'">'+data[i][2]+'</option>');

              }
              else
              {
                for(var j = 0; j < val.length; j++)
                {
                  if(val[j][0] == data[i][8])
                  {
                    s = ' selected'; 
                  }
                }
                $('#multi-select').append('<option value="'+data[i][8]+'"'+s+'>'+data[i][2]+'</option>');
              }
             
                            
            }

            $('#multi-select').multiSelect('refresh');        
         },
         error: function(data)
         {
            alerts('An error occured. Please reload the page and try again.','e');
         }
    });
}


$(document).ready(function(){
  loadtable();
  $('.populate').select2();
  rebuildSelect(0);

  <?php if($w_ == 1) { ?>
  $("#spmsForm").on('submit',(function(e) {
    e.preventDefault();
    $('#actionButtons').hide();
    $('#message').append("<div id='message2'></div>");
    $('#message2').append("<img src='<?php echo base_url('assets/img/loading.gif');?>'/>");
    $('#message2').append("    Processing...");
    $.ajax({
      url: '<?php echo base_url("Process/supplier_vendor"); ?>', 
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
            alerts('New Supplier/Vendor has been added.','s');
          else
            alerts('Supplier/Vendor has been updated.','s');
          loadtable();
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

  <?php }?>


});

</script>