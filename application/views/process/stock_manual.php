<div id="page-content">
  <div id='wrap'>
    <div id="page-heading">
      <ol class="breadcrumb">
          <li>Add Stock Manual</li>
      </ol>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-inverse">
              <div class="panel-heading">
                  <h4>Add Stock Manual Form</h4>
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
                          <input name="_table" id="_table" type="hidden"/>
                          <div class="col-md-2" style="text-align:right; padding-top:8px;">
                            <label><b>Item</b></label>
                          </div>
                          <div class="col-md-3">
                            <select class="populate" style="width:100%" id="item" name="item" onchange="if($(this).val() != '') loadInventory();" required>
                              <option value="">Select Item</option>
                             <?php foreach($p as $r) echo '<option value="'.$r[8].'">'.$r[1].' ('.$r[9].')'.'</option>';?>
                              </select>
                          </div>
                          <div class="col-md-3" style="text-align:right; padding-top:8px;">
                            <label><b>Add/Deduct from Inventory</b></label>
                          </div>
                          <div class="col-md-4">
                            <select class="populate" style="width:100%" id="inventory" name="inventory" onchange="if($(this).val() != '') {$('#price').prop('disabled', true); $('#price').val('');} else $('#price').prop('disabled', false);">
                              
                            </select>
                          </div>  
                        </div>
                     
                        <div class="form-group">
                          <div class="col-md-2" style="text-align:right; padding-top:8px;">
                            <label><b>Qty</b></label>
                          </div>
                          <div class="col-md-1">
                            <input type="number" class="form-control" name="qty" id="qty" placeholder="" min = "0"  required>
                          </div> 
                          <div class="col-md-1" style="text-align:right; padding-top:8px;">
                            <label><b>Unit Price</b></label>
                          </div>
                          <div class="col-md-1">
                            <input type="number" step="0.1" min = "0" class="form-control" name="price" id="price" placeholder="" required>
                          </div>  
                          <div class="col-md-3" style="text-align:right; padding-top:8px;">
                            <label><b>Remarks</b></label>
                          </div>
                          <div class="col-md-4">
                            <textarea class="form-control" name="remarks" id="remarks"></textarea>
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
                          <div class="col-md-2" style="text-align:right; padding-top:8px;">
                            <label><b>Item</b></label>
                          </div>
                          <div class="col-md-4">
                            <select class="populate" style="width:100%" id="s_item" name="s_item">
                              <option value="">All Items</option>
                              <?php foreach($p as $r) echo '<option value="'.$r[8].'">'.$r[1].' ('.$r[9].')'.'</option>';?>
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
                              <th style="width : 10%">#</th>
                              <th style="width : 30%">Item</th>
                              <th style="width : 10%">Qty</th>
                              <th style="width : 10%">Unit Price</th>
                              <th style="width : 20%">Remarks</th>
                              <th style="width : 10%">Date Added</th>
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
      "sAjaxSource": "<?php echo base_url('Process/stocks_manual')?>"+"?loadtable=true&"+$('#searchForm').serialize(),
      "deferLoading": 10,
      "bPaginate": false,
      "aaSorting": [[8,'desc'], [4,'desc']],
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
  $('#id').val("");
  $('#item').val("");
  $('#qty').val("");
  $('#price').val("");
  
  $('#remarks').val("");
  $('#price').prop('disabled',false);

  $('#item').select2({setVal:""});
  $('#inventory').empty("");
  $('#inventory').val("");
  $('#inventory').select2({setVal:""});
 
}

function resetForm()
{
  // $('#s_user').val("");
  $('#s_item').val("");
  $('#s_item').select2({setVal:""});
}

<?php if($w_ == 1) { ?>

function del_(id, name){

  var result = confirm("Do you want to proceed deleting "+name+"?");
  if (result) {
       $.ajax
        ({ type:"POST",
           async: true,
           url:"<?php echo base_url('Process/stocks_manual')?>",
           data:{id:id, act:"delete"},
           dataType: 'json',
           cache: false,
           success: function(data)
            {
              if (data['mes'] == "Success")
              {
                alerts('Record has been deleted.','s');
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

function loadInventory(){
   $('#inventory').empty();
   $.ajax
    ({ type:"POST",
       async: true,
       url:"<?php echo base_url('Process/stocks_manual')?>",
       data:{id:$('#item').val(), load:"loadInventory"},
       dataType: 'json',
       cache: false,
       success: function(data)
        {
          if (data['mes'] == "Success")
          {
            $('#inventory').append('<option value="">New Item</option>');
            for(var i = 0; i < data['data'].length; i++)
              $('#inventory').append('<option value="'+data['data'][i][0]+'">'+data['data'][i][1]+'</option>');
            $('#inventory').val("");
            $('#inventory').select2({setVal:""});
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
      url: '<?php echo base_url("Process/stocks_manual"); ?>', 
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
            alerts('New Stock has been added.','s');
          else
            alerts('Stock has been updated.','s');
          ($('#_table').val() == "1")?loadtable():null;
          clearForm();
        }
        else
          alerts(data['mes'],'w');
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