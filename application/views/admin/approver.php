<div id="page-content">
  <div id='wrap'>
    <div id="page-heading">
      <ol class="breadcrumb">
        <li>Administrator</li>
          <li>Approvers</li>
      </ol>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-inverse">
              <div class="panel-heading">
                  <h4>Approver Form</h4>
                  <div class="options">
                    <a class="panel-collapse" href="#">
                      <i class="fa fa-chevron-down"></i></a>
                  </div>
              </div>
              <div class="panel-body" id="divstyle" style="display:none;">
                   <form action="" class="form-horizontal row-border"  method="POST" id="spmsForm">
                      <input type="hidden" id="id" name="id"/>
                      <input type="hidden" id="act" name="act" value = "add"/>
                      <div class="form-group">
                          <label class="col-sm-2 control-label">Transaction<span style="color:red">*</span></label>
                          <div class="col-sm-4">
                             <select name="trans" id="trans" style="width:100%" class="populate" required onchange="($(this).val() != '')?loadH():$('#heirarchy').empty(); ($(this).val() != '')?loadA():$('#approver').empty();">
                               <option value ="">Please Select</option>
                               <option value ="IR">Item Request</option>
                               <option value ="PR">Purchase Request</option>
                               <option value ="JR">Job Request</option>
                               <option value ="FER">Furniture/Equipment Request</option>
                             </select>
                          </div>
                          <label class="col-sm-2 control-label">Hierarchy<span style="color:red">*</span></label>
                          <div class="col-sm-2">
                             <select name="heirarchy" id="heirarchy" style="width:100%" class="populate" required>
                               <option value ="">Please Select</option>
                             </select>
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-2 control-label">Approver<span style="color:red">*</span></label>
                          <div class="col-sm-4">
                             <select name="approver" id="approver" style="width:100%" class="populate" required>
                               <option value ="">Please Select</option>
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
                  <h4>Approvers</h4>
                  <div class="options">
                    <a class="panel-collapse" href="#">
                    <i class="fa fa-chevron-up"></i></a>
                  </div>
              </div>
              <div class="panel-body collapse in">
                  <table cellpadding="0" cellspacing="0" border="0" width="100%" id="spmsTable" class="table table-striped table-bordered datatables">
                      <thead>
                          <tr>
                              <th style="width : 20%">Transaction</th>
                              <th style="width : 60%">Approver</th>
                              <th style="width : 10%">Hierarchy</th>
                              <th style="width : 10%">Action</th>
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
      "sAjaxSource": "<?php echo base_url('Admin/approver')?>"+"?loadtable=true",
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
  $('#approver').empty();
  $('#approver').append('<option value="">Please Select</option>');

  $('#heirarchy').empty();
  $('#heirarchy').append('<option value="">Please Select</option>');

  $('#approver').val("");
  $('#heirarchy').val("");
  $('#trans').val("");

  $('#approver').select2({setVal:""});
  $('#heirarchy').select2({setVal:""});
  $('#trans').select2({setVal:""});


}

<?php if($w_ == 1) { ?>

function del_(id, name){

  var result = confirm("Do you want to proceed deleting "+name+"?");
  if (result) {
       $.ajax
        ({ type:"POST",
           async: true,
           url:"<?php echo base_url('Admin/approver')?>",
           data:{id:id, act:"delete"},
           dataType: 'json',
           cache: false,
           success: function(data)
            {
              if (data['mes'] == "Success")
              {
                alerts('Approver has been deleted.','s');
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
<?php }?>

function loadH(){

   $.ajax
    ({ type:"POST",
         async: true,
         url:"<?php echo base_url('Admin/approver')?>",
         data:{trans:$('#trans').val(), getH:"true"},
         dataType: 'json',
         cache: false,
         success: function(data)
          {
            if (data['mes'] == "Success")
            {
              $('#heirarchy').empty();
              $('#heirarchy').append('<option value="">Please Select</option>');
              for(var i = 0; i<data['h'].length; i++)
                $('#heirarchy').append('<option value = "'+data['h'][i][0]+'">'+data['h'][i][1]+'</option>');
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

function loadA(){

   $.ajax
    ({ type:"POST",
         async: true,
         url:"<?php echo base_url('Admin/approver')?>",
         data:{trans:$('#trans').val(), getA:"true"},
         dataType: 'json',
         cache: false,
         success: function(data)
          {
            if (data['mes'] == "Success")
            {
              $('#approver').empty();
              $('#approver').append('<option value="">Please Select</option>');
              for(var i = 0; i<data['h'].length; i++)
                $('#approver').append('<option value = "'+data['h'][i][0]+'">'+data['h'][i][1]+'</option>');
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
      url: '<?php echo base_url("Admin/approver"); ?>', 
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
          alerts('New Approver has been added.','s');
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