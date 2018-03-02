<div id="page-content">
  <div id='wrap'>
    <div id="page-heading">
      <ol class="breadcrumb">
        <li>Administrator</li>
          <li>Supply</li>
      </ol>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-inverse">
              <div class="panel-heading">
                  <h4>Supply Form</h4>
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
                        <label class="col-sm-2 control-label">Item <span style="color:red">*</span></label>
                          <div class="col-sm-4">
                           <!-- <select name="item" id="item" style="width:100%" class="populate" required>
                              <option value="">Please Select</option>
                              <?php 
                                //foreach($item_name as $r)
                                //{
                               //   echo '<option value="'.$r[0].'">'.$r[01].'</option>';
                               // }
                              ?>
                              
                            </select>-->
                            <input type="text" class="form-control" id="item" name="item" required>
                          </div>
                      <!--  <label class="col-sm-2 control-label">Add Item<span style="color:red">*</span></label>
                          <div class="col-sm-4">
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal"><span class="fa fa-plus"></span> Add New Item</button>

                          </div>-->
                        
                      </div>
                      <!-- Trigger the modal with a button -->

    



                      <div class="form-group">
                          <label class="col-sm-2 control-label">Item Category<span style="color:red">*</span></label>
                          <div class="col-sm-10">
                             <select name="category" id="category" style="width:100%" class="populate" required>
                              <option value="">Please Select</option>
                              <?php 
                                foreach($category as $r)
                                {
                                  echo '<option value="'.$r['id'].'">'.$r['desc'].'</option>';
                                }
                              ?>
                              
                            </select>
                          </div>
                      </div>
                     <div class="form-group">
                          <label class="col-sm-2 control-label">Supply Type<span style="color:red">*</span></label>
                          <div class="col-sm-10">
                             <select name="supply_type" id="supply_type" style="width:100%" class="populate" required>
                              <option value="">Please Select</option>
                              <?php 
                                foreach($article as $r)
                                {
                                  echo '<option value="'.$r[0].'">'.$r[0].'</option>';
                                }
                              ?>
                              
                            </select>
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-2 control-label">Units<span style="color:red">*</span></label>
                          <div class="col-sm-2">
                             <select name="units" id="units" style="width:100%" class="populate" required>
                              <option value="">Please Select</option>
                              <?php 
                                foreach($units as $r)
                                {
                                  echo '<option value="'.$r[0].'">'.$r[1].'</option>';
                                }
                              ?>
                              
                            </select>
                          </div>
                          <label class="col-sm-2 control-label">Estimated Unit Price</label>
                          <div class="col-sm-2">
                             <input type="number" class="form-control" name="unit_price" id="unit_price" step="0.01" placeholder="">
                          </div>
                          <label class="col-sm-2 control-label">Critical Level<span style="color:red">*</span></label>
                          <div class="col-sm-2">
                             <input type="number" class="form-control" name="critical" id="critical" placeholder="" required>
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
                  <h4>LIst of Items</h4>
                  <div class="options">
                    <a class="panel-collapse" href="#">
                    <i class="fa fa-chevron-up"></i></a>
                  </div>
              </div>
              <div class="panel-body collapse in">
                  <table cellpadding="0" cellspacing="0" border="0" width="100%" id="spmsTable" class="table table-striped table-bordered datatables">
                      <thead>
                          <tr>
                           <th style="width : 15%"> Stock Number</th>
                            <!--  <th style="width : 10%">Item ID</th>-->
                              <th style="width : 20%">Item Name</th>
                              <th style="width : 30%">Item Category</th>
                              <th style="width : 10%">Units</th>
                              
                              <th style="width : 10%">Critical Level</th>
                              <th style="width : 10%">Unit Price</th>
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
<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/form-multiselect/js/jquery.multi-select.min.js'></script>
<script type='text/javascript' src='<?php echo base_url('assets')?>/js/custom.js'></script> 

<!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add New Item</h4>
          </div>
          <div class="modal-body">
          <form action="" class="form-horizontal row-border"  method="POST" id="new_item_form">
                      <input type="hidden" name="add_new_item" id="add_new_item"/>
                      <input type="hidden" id="act" name="act" value="add_new_item"/>
                           <div class="form-group">
                            <label class="col-sm-2 control-label"> New Item <span style="color:red">*</span></label>
                              <div class="col-sm-10">
                               <input type="text" id="new_item" name="new_item" class="form-control" required>
                              </div>
                            </div>
                  
                      </div>
                    <div class="modal-footer">
                       <div class="col-lg-offset-2 col-lg-10">
                                        <div id="message"></div> 
                                        <div class="btn-toolbar" id = "actionButtons">
                                            <button class="btn-primary btn" type="submit" name="save" id="save">Save</button>
                                            <button class="btn-default btn" type="reset" id="reset" data-dismiss="modal">Cancel</button>
                                        </div>
                                    </div>
                    </div>
          </form>
        </div>

      </div>
    </div>

<script language="JavaScript" type='text/javascript'>



function loadtable()
{
  $('#spmsTable').dataTable().fnClearTable();
  $('#spmsTable').dataTable().fnDraw();
  $('#spmsTable').dataTable().fnDestroy();

  $('#spmsTable').dataTable({
      "serverSide": true,
      "sAjaxSource": "<?php echo base_url('Process/product')?>"+"?loadtable=true",
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

function clear(){
  $('#new_item').val("");
}

function clearForm()
{
  $('#item').val("");
  $('#item').val("");
  $('#units').val("");
  $('#units').select2({setVal:""});
  $('#category').val("");
  $('#category').select2({setVal:""});
  $('#critical').val("");
   $('#unit_price').val("");
  $('#act').val("add");
}

<?php if($w_ == 1) { ?>

function del_(id, name){

  var result = confirm("Do you want to proceed deleting "+name+"?");
  if (result) {
       $.ajax
        ({ type:"POST",
           async: true,
           url:"<?php echo base_url('Process/product')?>",
           data:{id:id, act:"delete"},
           dataType: 'json',
           cache: false,
           success: function(data)
            {
              if (data['mes'] == "Success")
              {
                alerts('Item has been deleted.','s');
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
       url:"<?php echo base_url('Process/product')?>",
       data:{id:value, getspecific:'true'},
       dataType: 'json',
       cache: false,
       success: function(data)
         {
        //  alerts(data[0][5]);
         //   var_dump(explode((x.val(data[0][5]),' '));
            $('#id').val(data[0][7]);//[0][7]->[0][0]
            $('#item').val(data[0][1]);//[0][1]->[0][0]
            $('#units').val(data[0][9]);//[0][9]->[0][4]
            $('#units').select2({setVal:data[0][9]});//[0][9]->[0][4]
            $('#category').val(data[0][8]);//[0][8]->[0][3] 
            $('#category').select2({setVal:data[0][8]});//[0][8]->[0][3]
            $('#critical').val(data[0][4]);// [0][4] -> [0][5] 
            $('#unit_price').val(data[0][10]);// [0][5] -> [0][6] 
            $('#act').val("save");
            $('#supply_type').val(data[0][11]);
            
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


$(document).ready(function(){
  loadtable();
  $('.populate').select2();

  <?php if($w_ == 1) { ?>
  $("#spmsForm").on('submit',(function(e) {
    e.preventDefault();
    $('#actionButtons').hide();
    $('#message').append("<div id='message2'></div>");
    $('#message2').append("<img src='<?php echo base_url('assets/img/loading.gif');?>'/>");
    $('#message2').append("    Processing...");
    $.ajax({
      url: '<?php echo base_url("Process/product"); ?>', 
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
            alerts('New Item has been added.','s');
          else
            alerts('Item has been updated.','s');
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



  //add new item

  $("#new_item_form").on('submit',(function(e){
      e.preventDefault();
   
    $.ajax({
      url: '<?php echo base_url("Process/product"); ?>', 
      type:"POST",
      data: new FormData(this), 
      dataType: 'json',
      contentType: false,     
      processData: false,  
      cache: false, 
      success: function(data){
        if(data['mes']=='Success'){
          clear();
          loadtable();
          $('#myModal').modal('hide');
           window.location.reload();

        }else{
        alert('hello');
        }
      }
    });


  }));

   $("#reset").click(function() {
         $('#new_item').val("");
    });


  <?php }?>


});

</script>