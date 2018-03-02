<div id="page-content">
  <div id='wrap'>
    <div id="page-heading">
      <ol class="breadcrumb">
        <li>Administrator</li>
          <li>Responsibility Centers</li>
      </ol>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-inverse">
              <div class="panel-heading">
                  <h4>Responsibility Centers Form</h4>
                  <div class="options">
                    <a class="panel-collapse" href="#">
                      <i class="fa fa-chevron-up"></i></a>
                  </div>
              </div>
              <div class="panel-body" id="divstyle" style="display:none;">
                   <form action="" class="form-horizontal row-border"  method="POST" id="spmsForm">
                      <input type="hidden" id="id" name="id"/>
                      <input type="hidden" id="act" name="act" value="add"/>
                      <div class="form-group">
                          <label class="col-sm-1 control-label">RC Division</label>
                          <div class="col-sm-4">
                            <select name="division" id="division" style="width:100%" class="populate" >
                            </select>
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-1 control-label">RC Code<span style="color:red">*</span></label>
                          <div class="col-sm-3">
                             <input type="text" class="form-control" name="code" id="code" placeholder="" required>
                          </div>
                          <label class="col-sm-1 control-label">RC Acronym<span style="color:red">*</span></label>
                          <div class="col-sm-3">
                             <input type="text" class="form-control" name="acronym" id="acronym" placeholder="" required>
                          </div>
                          <label class="col-sm-1 control-label">RC Name<span style="color:red">*</span></label>
                          <div class="col-sm-3">
                             <input type="text" class="form-control" name="name" id="name"placeholder="" required>
                          </div>
                          <input type="hidden" class="form-control" name="oic_name" id="oic_name"placeholder="" required>
                          

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
                  <h4>List of Responsibility Centers</h4>
                  <div class="options">
                    <a class="panel-collapse" href="#">
                    <i class="fa fa-chevron-down"></i></a>
                  </div>
              </div>
              <div class="panel-body collapse in">
                  <table cellpadding="0" cellspacing="0" border="0" width="100%" id="spmsTable" class="table table-striped table-bordered datatables">
                      <thead>
                          <tr>
                              <th style="width : 10%">Code</th>
                              <th style="width : 10%">Division</th>
                              <th style="width : 20%">Acronym</th>
                              <th style="width : 50%">Description</th>
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

<script language="JavaScript" type='text/javascript'>

function loadtable()
{
  $('#spmsTable').dataTable().fnClearTable();
  $('#spmsTable').dataTable().fnDraw();
  $('#spmsTable').dataTable().fnDestroy();

  $('#spmsTable').dataTable({
      "serverSide": true,
      "sAjaxSource": "<?php echo base_url('Admin/department_offices')?>"+"?loadtable=true",
      "deferLoading": 10,
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
  $('#act').val("add");
  $('#name').val("");
  $('#oic_name').val("");
  $('#code').val("");
  $('#acronym').val("");
  $('#division').val("");
  $('#division').select2({setVal:""});
  $('#id').val("");
}

<?php if($w_ == 1) { ?>

function del_(id, name){

  var result = confirm("Do you want to proceed deleting "+name+"?");
  if (result) {
       $.ajax
        ({ type:"POST",
           async: true,
           url:"<?php echo base_url('Admin/department_offices')?>",
           data:{id:id, act:"delete"},
           dataType: 'json',
           cache: false,
           success: function(data)
            {
              if (data['mes'] == "Success")
              {
                alerts('Responsibility Center has been deleted.','s');
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
       url:"<?php echo base_url('Admin/department_offices')?>",
       data:{id:value, getspecific:'true'},
       dataType: 'json',
       cache: false,
       success: function(data)
         {
            $('#id').val(data[0][5]);
            $('#name').val(data[0][3]);
            $('#oic_name').val(data[0][2]);
            $('#division').val(data[0][0]);
            $('#division').select2({setVal:data[0][0]});
            $('#code').val(data[0][1]);
            $('#acronym').val(data[0][2]);
            $('#act').val("save");
            
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

function loadDivision(){
  $('#division').empty();
  $('#division').append('<option value="">Select Division</option>');
  $.ajax
    ({ type:"POST",
       async: true,
       url:"<?php echo base_url('Admin/department_offices')?>",
       data:{getDivision:true},
       dataType: 'json',
       cache: false,
       success: function(data)
         {
            for(var i = 0; i<data.length; i++)
              $('#division').append('<option value="'+data[i][5]+'">'+data[i][6]+'</option>');
            $('#division').val("");
            $('#division').select2({setVal:""});
         },
         error: function(data)
         {
            alerts('An error occured. Please reload the page and try again.','e');
         }
    });
}


$(document).ready(function(){
  loadtable();
  loadDivision();
  <?php if($w_ == 1) { ?>
  $("#spmsForm").on('submit',(function(e) {
    e.preventDefault();
    $('#actionButtons').hide();
    $('#message').append("<div id='message2'></div>");
    $('#message2').append("<img src='<?php echo base_url('assets/img/loading.gif');?>'/>");
    $('#message2').append("    Processing...");
    $.ajax({
      url: '<?php echo base_url("Admin/department_offices"); ?>', 
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
            alerts('New Department/Office has been added.','s');
          else
            alerts('Department/Office has been updated.','s');
          loadtable();
          loadDivision();
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