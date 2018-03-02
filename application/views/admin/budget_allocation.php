<div id="page-content">
  <div id='wrap'>
    <div id="page-heading">
      <ol class="breadcrumb">
        <li>Administrator</li>
          <li>Budget Allocation</li>
      </ol>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-inverse">
              <div class="panel-heading">
                  <h4>Budget Allocation Form</h4>
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
                          <label class="col-sm-2 control-label">Select Year<span style="color:red">*</span></label>
                          <div class="col-sm-4">
                            <select name="year_" id="year_" style="width:100%" class="populate" onchange="loadOffice()" required>
                              <option value="2016">2016</option>
                              <?php $temp  = 2017; while($temp < 2050)
                              {
                                echo '<option value="'.$temp.'">'.$temp.'</option>';
                                $temp++;
                              }
                              ?>
                            </select>
                          </div>
                          <label class="col-sm-2 control-label">Select Office<span style="color:red">*</span></label>
                          <div class="col-sm-4">
                            <select name="office" id="office" style="width:100%" class="populate" required>
                              <option value="">Please Select</option>
                              <?php foreach($office as $r)
                                echo '<option value="'.$r[0].'">'.$r[1].'</option>';?>
                            </select>
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-2 control-label">Budget</label>
                          <div class="col-sm-2">
                             <input type="number" class="form-control" step="0.01" min = "0" name="budget" id="budget" placeholder="" required>
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
                  <h4>Budget Allocation</h4>
                  <div class="options">
                    <a class="panel-collapse" href="#">
                    <i class="fa fa-chevron-up"></i></a>
                  </div>
              </div>
              <div class="panel-body collapse in">
                  <div class="form-group">
                      <label class="col-sm-2 control-label">Select Year<span style="color:red">*</span></label>
                      <div class="col-sm-4">
                        <select name="year2_" id="year2_" style="width:100%" class="populate" onchange="loadtable()" required>
                          <option value="2016">2016</option>
                          <?php $temp  = 2017; while($temp < 2050)
                          {
                            echo '<option value="'.$temp.'">'.$temp.'</option>';
                            $temp++;
                          }
                          ?>
                        </select>
                      </div>
                  </div>
                  <table cellpadding="0" cellspacing="0" border="0" width="100%" id="spmsTable" class="table table-striped table-bordered datatables">
                      <thead>
                          <tr>
                              <th style="width : 5%">Year</th>
                              <th style="width : 40%">Office</th>
                              <th style="width : 15%">Budget Allocation</th>
                              <th style="width : 15%">Consumed Budget</th>
                              <th style="width : 15%">Remaining Budget</th>
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
      "sAjaxSource": "<?php echo base_url('Admin/budget_allocation')?>"+"?loadtable=true&year_="+$('#year2_').val(),
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
  $('#office').val("");
  $('#office').select2({setVal:""});
  $('#budget').val("");
  $('#year_').val("<?php echo date('Y')?>");
  $('#year_').select2({setVal:"<?php echo date('Y')?>"});
  $('#act').val("add");
  loadOffice();
}

<?php if($w_ == 1) { ?>

function del_(id, name){

  var result = confirm("Do you want to proceed deleting "+name+"?");
  if (result) {
       $.ajax
        ({ type:"POST",
           async: true,
           url:"<?php echo base_url('Admin/budget_allocation')?>",
           data:{id:id, act:"delete"},
           dataType: 'json',
           cache: false,
           success: function(data)
            {
              if (data['mes'] == "Success")
              {
                alerts('Budget Allocation has been deleted.','s');
                loadtable();
                loadOffice();
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
       url:"<?php echo base_url('Admin/budget_allocation')?>",
       data:{id:value, getspecific:'true'},
       dataType: 'json',
       cache: false,
       success: function(data)
         {
            $('#id').val(data[0][6]);
            $('#budget').val(data[0][7]);
            loadOffice2(data[0][8]);
            
            $('#year_').val(data[0][0]);
            $('#year_').select2({setVal:data[0][0]});
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


function loadOffice()
{
   $.ajax
    ({ type:"POST",
       async: true,
       url:"<?php echo base_url('Admin/budget_allocation')?>",
       data:{loadOffice:'true', year_:$('#year_').val()},
       dataType: 'json',
       cache: false,
       success: function(data)
         {
            $('#office').empty();
            $('#office').append('<option value="">Please Select</option>');
            for(var i = 0; i <data.length; i++)
              $('#office').append('<option value="'+data[i][0]+'">'+data[i][1]+'</option>');
         },
         error: function(data)
         {
            alerts('An error occured. Please reload the page and try again.','e');
         }
    });
}

function loadOffice2(val)
{
   $.ajax
    ({ type:"POST",
       async: true,
       url:"<?php echo base_url('Admin/budget_allocation')?>",
       data:{loadOffice:'true', id:val, year_:$('#year_').val()},
       dataType: 'json',
       cache: false,
       success: function(data)
         {
            $('#office').empty();
            $('#office').append('<option value="">Please Select</option>');
            for(var i = 0; i <data.length; i++)
              $('#office').append('<option value="'+data[i][0]+'">'+data[i][1]+'</option>');

            $('#office').val(val);
            $('#office').select2({setVal:val});
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

  $('#year_').val("<?php echo date('Y')?>");
  $('#year_').select2({setVal:"<?php echo date('Y')?>"});

  $('#year2_').val("<?php echo date('Y')?>");
  $('#year2_').select2({setVal:"<?php echo date('Y')?>"});

  <?php if($w_ == 1) { ?>
  $("#spmsForm").on('submit',(function(e) {
    e.preventDefault();
    $('#actionButtons').hide();
    $('#message').append("<div id='message2'></div>");
    $('#message2').append("<img src='<?php echo base_url('assets/img/loading.gif');?>'/>");
    $('#message2').append("    Processing...");
    $.ajax({
      url: '<?php echo base_url("Admin/budget_allocation"); ?>', 
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
            alerts('New Budget Allocation has been added.','s');
          else
            alerts('Budget Allocation has been updated.','s');
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