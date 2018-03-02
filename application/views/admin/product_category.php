<div id="page-content">
  <div id='wrap'>
    <div id="page-heading">
      <ol class="breadcrumb">
        <li>Administrator</li>
          <li>Supply Category</li>
      </ol>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-inverse">
              <div class="panel-heading">
                  <h4>Supply Category Form</h4>
                  <div class="options">
                    <a class="panel-collapse" href="#">
                      <i class="fa fa-chevron-down"></i></a>
                  </div>
              </div>
              <div class="panel-body" id="divstyle" style="display:none;">
                   <form action="" class="form-horizontal row-border"  method="POST" id="spmsForm">
                      <input type="hidden" id="id" name="id"/>
                      <input type="hidden" id="act" name="act" value="c"/>
                      <div class="form-group">
                          <label class="col-sm-2 control-label">Supply Category Name<span style="color:red">*</span></label>
                          <div class="col-sm-4">
                             <input type="text" class="form-control" name="c_name" id="c_name"placeholder="" required>
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
                  <h4>Supply Category</h4>
                  <div class="options">
                    <a class="panel-collapse" href="#">
                    <i class="fa fa-chevron-up"></i></a>
                  </div>
              </div>
              <div class="panel-body collapse in">
                  <table cellpadding="0" cellspacing="0" border="0" width="100%" id="spmsTable" class="table table-striped table-bordered datatables">
                      <thead>
                          <tr>
                              <th style="width : 10%">Category ID</th>
                              <th style="width : 20%">Supply Category</th>
                              <th style="width : 70%">Supply Subcategory</th>
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
<div class="modal fade modals" id="addSub" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:800px">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h3 class="modal-title">Add Supply Subcategory</h3>
        </div>
        <form action="" class="form-horizontal" id="spmsForm2"  enctype="multipart/form-data">
          <input type="hidden" id="parent" name="parent"/>
          <input type="hidden" id="master" name="master"/>
          <input type="hidden" id="act" name="act" value="sc"/>
          <div class="modal-body" id="appendList">
            <div class="form-group">
                <label class="col-sm-4 control-label">Supply Subcategory Description<span style="color:red">*</span></label>
                <div class="col-sm-8">
                   <input type="text" class="form-control" name="sc_name" id="sc_name"placeholder="" required>
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <?php if($w_ == 1) { ?>
              <div id="message3"></div> 
              <div class="btn-toolbar" id = "actionButtons2">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Add Subcategory</button>
                
              </div>
            <?php }?>
          </div>
        </form>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type='text/javascript' src='<?php echo base_url('assets')?>/js/jquery-1.10.2.min.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/js/jqueryui-1.10.3.min.js'></script>
<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/form-select2/select2.min.js'></script> 
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
      "sAjaxSource": "<?php echo base_url('Admin/product_category')?>"+"?loadtable=true",
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
  $('#sc_name').val("");
  $('#c_name').val("");
  $('#master').val("");
  $('#parent').val("");
  $('#addSub').modal("hide");
}

<?php if($w_ == 1) { ?>

function delC(id, name){

  var result = confirm("Do you want to proceed deleting "+name+"?");
  if (result) {
       $.ajax
        ({ type:"POST",
           async: true,
           url:"<?php echo base_url('Admin/product_category')?>",
           data:{id:id, act:"delete"},
           dataType: 'json',
           cache: false,
           success: function(data)
            {
              if (data['mes'] == "Success")
              {
                alerts('Category has been deleted.','s');
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

function addSub(id, master_id){

  $('#parent').val(id);
  $('#master').val(master_id);
  $('#addSub').modal('show');
        
}

<?php }?>


$(document).ready(function(){
  loadtable();

  <?php if($w_ == 1) { ?>
  $("#spmsForm").on('submit',(function(e) {
    e.preventDefault();
    $('#actionButtons').hide();
    $('#message').append("<div id='message2'></div>");
    $('#message2').append("<img src='<?php echo base_url('assets/img/loading.gif');?>'/>");
    $('#message2').append("    Processing...");
    $.ajax({
      url: '<?php echo base_url("Admin/product_category"); ?>', 
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
          
          alerts('New Product Category has been added.','s');
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

  $("#spmsForm2").on('submit',(function(e) {
    e.preventDefault();
    $('#actionButtons2').hide();
    $('#message3').append("<div id='message4'></div>");
    $('#message4').append("<img src='<?php echo base_url('assets/img/loading.gif');?>'/>");
    $('#message4').append("    Processing...");
    $.ajax({
      url: '<?php echo base_url("Admin/product_category"); ?>', 
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
          alerts('New Sub-category has been added.','s');
          loadtable();
          clearForm();
        }
        else
          alerts(data['mes'],'s');
        $('#message3').empty();
        $('#actionButtons2').show();
      },
      error: function(data)
      {
        $('#message3').empty();
        $('#actionButtons2').show();
        alerts('An error occured. Please reload the page and try again.','e');
      }

    });
    
  }));
  <?php }?>


});

</script>