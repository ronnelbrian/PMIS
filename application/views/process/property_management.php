<div id="page-content">
  <div id='wrap'>
    <div id="page-heading">
      <ol class="breadcrumb">
        <li>Property Management</li>
      </ol>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-inverse">
              <div class="panel-heading">
                  <h4>Property Assignment Form</h4>
                  <div class="options">
                    <a class="panel-collapse" href="#">
                      <i class="fa fa-chevron-up"></i></a>
                  </div>
              </div>
              <div class="panel-body" id="divstyle" >
                   <form action="" class="form-horizontal row-border"  method="POST" id="spmsForm2">
                      <input type="hidden" id="id" name="id"/>
                      <input type="hidden" id="act2" name="act2"/>
                      <div class="form-group">
                          <label class="col-sm-2 control-label">Item from Inventory<span style="color:red">*</span></label>
                          <div class="col-sm-10">
                             <select name="n_product" id="n_product" style="width:100%" class="populate" required >
                              <option value="">Please Select</option>
                              <?php foreach($i as $r) echo '<option value="'.$r[0].'">'.$r[1].'</option>';?>
                            </select>
                          </div>
                      </div>
                       <div class="form-group">
                          <label class="col-sm-2 control-label">Office<span style="color:red">*</span></label>
                          <div class="col-sm-4">
                             <select name="n_office" id="n_office" style="width:100%" class="populate" onchange="loadEmployee2()" required >
                              <option value="">Please Select</option>
                              <?php foreach($o as $r) echo '<option value="'.$r[0].'">'.$r[1].'</option>';?>
                            </select>
                          </div>
                          <label class="col-sm-2 control-label">Employee<span style="color:red">*</span></label>
                          <div class="col-sm-4">
                             <select name="n_employee" id="n_employee" style="width:100%" class="populate" required>
                              <option value="">Please Select</option>
                              <?php foreach($e as $r) echo '<option value="'.$r[6].'">'.$r[2].'</option>';?>
                            </select>
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-2 control-label">Property SN</label>
                          <div class="col-sm-4">
                            <input type="text" class="form-control" name="n_sn" id="n_sn" style="width:100%"></input>
                          </div>
                          <label class="col-sm-2 control-label">Remarks</label>
                          <div class="col-sm-4">
                            <textarea name="n_remarks" id="n_remarks" style="width:100%"></textarea>
                          </div>
                      </div>
                      <?php if($w_ == 1) { ?>
                      <div class="panel-footer">
                          <div class="row">
                              <div class="col-lg-offset-2 col-lg-10">
                                  <div id="message5"></div> 
                                  <div class="btn-toolbar" id = "actionButtons3">
                                      <button class="btn-primary btn" type="submit">Save</button>
                                      <button class="btn-default btn" type="reset" onclick="clearForm()">Clear</button>
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
                  <h4>Property Management</h4>
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
                            <label><b>Office</b></label>
                          </div>
                          <div class="col-md-4">
                            <select class="populate" style="width:100%" id="s_office" name="s_office" onchange="loadEmployee()">
                              <option value="">Select Office</option>
                              <?php foreach($o as $r) echo '<option value="'.$r[0].'">'.$r[1].'</option>';?>
                            </select>
                          </div>  
                          <div class="col-md-2" style="text-align:right; padding-top:8px;">
                            <label><b>Employee</b></label>
                          </div>
                          <div class="col-md-4">
                            <select class="populate" style="width:100%" id="s_employee" name="s_employee">
                              <option value="">All Employees</option>
                              <?php foreach($e as $r) echo '<option value="'.$r[6].'">'.$r[2].'</option>';?>
                            </select>
                          </div>  
                        </div>
                        <div class="form-group" style="padding:0px">
                          <div class="col-md-2" style="text-align:right; padding-top:8px;">
                            <label><b>Item</b></label>
                          </div>
                          <div class="col-md-4">
                            <select class="populate" style="width:100%" id="s_item" name="s_item">
                              <option value="">All Items</option>
                              <?php foreach($p as $r) echo '<option value="'.$r[8].'">'.$r[3].' ('.$r[4].')'.'</option>';?>
                            </select>
                          </div>  
                          <div class="col-md-2" style="text-align:right; padding-top:8px;">
                            <label><b>Serial No.</b></label>
                          </div>
                          <div class="col-md-4">
                            <input type="text" class="form-control" name="s_serial" id="s_serial">
                          </div>  
                        </div>
                     
                        <div class="form-group" style="margin-top:10px">
                          <div class="col-sm-2"></div>
                          <div class="col-sm-10">
                            <table style="margin:0px">
                              <tr>
                                <td style="padding-left:0px"><button type='button' class='btn-sm btn-success' id='select-all1'><span>Select All</span></button></br></br> </td>
                                <td style="padding-left:0px"><button type='button' class='btn-sm btn-success' id='deselect-all1'> <span>Deselect All</span></button></br></br></td>
                              </tr>
                            </table>
                          </div>
                          <label class="col-sm-2 control-label">Select Category</label>
                          <div class="col-sm-10">
                              <select multiple="multiple" name="s_category[]" id="multi-select" style="width:100%">
                              <?php 
                                foreach($category as $r)
                                {
                                  echo '<option value="'.$r['id'].'" selected>'.$r['desc'].'</option>';
                                }
                              ?>
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
                              <th style="width : 10%">Property ID</th>
                              <th style="width : 25%">Property Description</th>
                              <th style="width : 20%">Serial No.</th>
                              <th style="width : 20%">Assigned to</th>
                              <th style="width : 15%">Office</th>
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

<div class="modal fade modals" id="spmsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:65%">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title"><label id="modaltitle"></label></h4>
        </div>
        <form action="" class="form-horizontal" id="spmsForm"  enctype="multipart/form-data">
          <div class="modal-body">
            <input type="hidden" name="p_id" id ="p_id"/>
            <input type="hidden" name="temp_office" id ="temp_office"/>
            <input type="hidden" name="temp_user" id ="temp_user"/>
            <input type="hidden" name="temp_prop_code" id ="temp_prop_code"/>
           
            <div class="panel-heading" style="margin-bottom:20px; background-color:#4f5259">
                <h4 style="color:white; padding-left:15px" id="delTitle">Property Assignment</h4>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Select Employee<span style="color:red">*</span></label>
                <div class="col-sm-10">
                  <select name="user" id="user" style="width:100%" class="populate" required onchange="loadOffice($(this).val(), 0)">
                    <option value="">Please Select</option>
                    <?php foreach($user as $r)
                      echo '<option value="'.$r[6].'">'.$r[2].'</option>';?>
                  </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Select Office<span style="color:red">*</span></label>
                <div class="col-sm-10">
                  <select name="office" id="office" style="width:100%" class="populate" required>
                    <option value="" selected>Please Select</option>
                    
                  </select>
                </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Property SN<span style="color:red">*</span></label>
              <div class="col-sm-10">
                 <input id="property" name="property" class="form-control" required></input>
              </div>
            </div>
            <input type="hidden" id="act" name="act" value="add"/>
           
            <div class="form-group">
              <div class="col-sm-12" style="text-align:right">
                  <div id="message"></div> 
                  <div class="btn-toolbar" id = "actionButtons">
                      <button class="btn-primary btn" type="submit">Submit Changes</button>
                  </div>
              </div>
            </div>
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
  $('#spmsTable').dataTable().fnClearTable();
  $('#spmsTable').dataTable().fnDraw();
  $('#spmsTable').dataTable().fnDestroy();

  $('#spmsTable').dataTable({
      "serverSide": true,
      "sAjaxSource": "<?php echo base_url('Process/property_management')?>"+"?loadtable=true&"+$('#searchForm').serialize(),
      "deferLoading": 10,
      "bPaginate": false,
      "fnInitComplete": function(){
        $('#_table').val("1");
        $('#message3').empty();
        $('#actionButtons2').show();
        var n = $(document).height();
        //$('html, body').animate({ scrollTop: n }, 1000);
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

function loadEmployee(){
  $('#spmsForm').serialize();
  $('#s_employee').empty();
  $('#s_employee').append('<option value="">All Employees</option>');
  $.ajax
    ({ type:"GET",
       async: true,
       url:"<?php echo base_url('Process/property_management')?>"+"?loadEmployee=true&office="+$('#s_office').val(),
       data:{},
       dataType: 'json',
       cache: false,
       success: function(data)
         {
            for(var i = 0; i<data.length; i++)
              $('#s_employee').append('<option value="'+data[i][0]+'">'+data[i][1]+'</option>');
            $('#s_employee').val("");
            $('#s_employee').select2({setVal:""});
         },
         error: function(data)
         {
            alerts('An error occured. Please reload the page and try again.','e');
         }
    });
}

function loadEmployee2(){
  $('#n_employee').empty();
  $('#n_employee').append('<option value="">Please Select</option>');
  $.ajax
    ({ type:"GET",
       async: true,
       url:"<?php echo base_url('Process/property_management')?>"+"?loadEmployee=true&office="+$('#n_office').val(),
       data:{},
       dataType: 'json',
       cache: false,
       success: function(data)
         {
            for(var i = 0; i<data.length; i++)
              $('#n_employee').append('<option value="'+data[i][0]+'">'+data[i][1]+'</option>');
            $('#n_employee').val("");
            $('#n_employee').select2({setVal:""});
         },
         error: function(data)
         {
            alerts('An error occured. Please reload the page and try again.','e');
         }
    });
}

function loadInventory(){
  $('#n_product').empty();
  $('#n_product').append('<option value="">Please Select</option>');
  $.ajax
    ({ type:"GET",
       async: true,
       url:"<?php echo base_url('Process/property_management')?>"+"?loadInventory=true",
       data:{},
       dataType: 'json',
       cache: false,
       success: function(data)
         {
            for(var i = 0; i<data.length; i++)
              $('#n_product').append('<option value="'+data[i][0]+'">'+data[i][1]+'</option>');
            $('#n_product').val("");
            $('#n_product').select2({setVal:""});
         },
         error: function(data)
         {
            alerts('An error occured. Please reload the page and try again.','e');
         }
    });
}


function clearForm()
{
  $('#id').val("");
  $('#user').val("");
  $('#user').select2({setVal:""});
  $('#office').val("");
  $('#office').select2({setVal:""});
  $('#property').val("");
  $('#act').val("add");

  $('#n_office').val("");
  $('#n_office').select2({setVal:""});
  $('#n_employee').val("");
  $('#n_employee').select2({setVal:""});
  $('#n_product').val("");
  $('#n_product').select2({setVal:""});
  $('#n_remarks').val("");
  ($('#_table').val() == "1")?loadtable():null;

  loadInventory();
}

<?php if($w_ == 1) { ?>

function del_(id, name){

  var result = confirm("Do you want to proceed removing the assigment of an employee to the property code "+name+"?");
  if (result) {
       $.ajax
        ({ type:"POST",
           async: true,
           url:"<?php echo base_url('Process/property_management')?>",
           data:{id:id, act:"delete"},
           dataType: 'json',
           cache: false,
           success: function(data)
            {
              if (data['mes'] == "Success")
              {
                alerts('Property Assignment has been updated.','s');
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

function edit_(id)
{
  $('#p_id').val(id);
  $.ajax
    ({ type:"POST",
       async: false,
       url:"<?php echo base_url('Process/property_management')?>",
       data:{id:id, loadSpecific:"loadSpecific"},
       dataType: 'json',
       cache: false,
       success: function(data)
        {
          $('#user').val(data[0][2]);
          $('#user').select2({setVal:data[0][2]});
          $('#temp_user').val(data[0][5]);
          loadOffice(data[0][2], data[0][3]);
          $('#property').val(data[0][7]);
          $('#temp_prop_code').val(data[0][7]);
          $('#modaltitle').text("Property ID: "+data[0][4]);
          $('#spmsModal').modal('show');
         },
         error: function(data)
         {
            alerts('An error occured. Please reload the page and try again.','e');
         }
  });
  
}

<?php }?>

function loadOffice(id, office)
{
  $('#office').empty();
  $('#office').append("<option value=''>Please Select</option>");
  $.ajax
    ({ type:"POST",
       async: false,
       url:"<?php echo base_url('Process/property_management')?>",
       data:{id:id, loadOffice:"loadOffice"},
       dataType: 'json',
       cache: false,
       success: function(data)
        {
          for(var i = 0; i< data.length; i++)
            $('#office').append("<option value='"+data[i][0]+"'>"+data[i][1]+"</option>");

          if(office == 0)
          {
              $('#office').val("");
              $('#office').select2({setVal:""});
          }
          else
          {
              $('#office').val(office);
              $('#office').select2({setVal:office});
              $('#temp_office').val($('#office :selected').text());
          }
        },
        error: function(data)
        {
          alerts('An error occured. Please reload the page and try again.','e');
        }
  });
  
}



$(document).ready(function(){
  
  $('.populate').select2();

  rebuildSelect();
  $('#select-all1').click(function(){
    $('#multi-select').multiSelect('select_all');
  });

  $('#deselect-all1').click(function(){
    $('#multi-select').multiSelect('deselect_all');
  });

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
    var mes = "";
    var ctr = 1;
    if($('#temp_user').val() != "" && $('#user :selected').text() != $('#temp_user').val())
    {
      mes+=ctr+". Your are transferring the Property from "+$('#temp_user').val()+" to "+$('#user :selected').text()+"\n";
      ctr++;
    }
    else if($('#temp_user').val() == "")
    {
      mes+=ctr+". Your are assigning the Property to "+$('#user :selected').text()+"\n";
      ctr++;
    }
    if($('#temp_office').val() != "Please Select" && $('#office :selected').text() != $('#temp_office').val())
    {
      mes+=ctr+". Your are transferring the Property from "+$('#temp_office').val()+" to "+$('#office :selected').text()+"\n";
      ctr++;
    }
    else if($('#temp_office').val() == "Please Select")
    {
      mes+=ctr+". Your are assigning the Property to "+$('#office :selected').text()+"\n";
      ctr++;
    }
    if($('#temp_prop_code').val() != "" && $('#property').val() != $('#temp_prop_code').val())
    {
      mes+=ctr+". Your are changing the Property Code from "+$('#temp_prop_code').val()+" to "+$('#property').val()+"\n";
      ctr++;
    }
    else if($('#temp_prop_code').val() == "")
    {
      mes+=ctr+". Your are assigning Property Code "+$('#property').val()+" to the property\n";
      ctr++;
    }
    (mes != "")?header = "Do you want to proceed doing the following:":header = "No changes has been made.";
    var res = confirm(header+'\n\n'+mes);
    if(res && mes != "")
    {
      $('#actionButtons').hide();
      $('#message').append("<div id='message2'></div>");
      $('#message2').append("<img src='<?php echo base_url('assets/img/loading.gif');?>'/>");
      $('#message2').append("    Processing...");
      $.ajax({
        url: '<?php echo base_url("Process/property_management"); ?>', 
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
              alerts('Property Assignment has been updated.','s');
            ($('#_table').val() == "1")?loadtable():null;
            clearForm();
            $('#spmsModal').modal('hide');
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

$("#spmsForm2").on('submit',(function(e) {
      e.preventDefault();
      $('#act2').val("add");
      $('#actionButtons3').hide();
      $('#message5').append("<div id='message6'></div>");
      $('#message6').append("<img src='<?php echo base_url('assets/img/loading.gif');?>'/>");
      $('#message6').append("    Processing...");
      $.ajax({
        url: '<?php echo base_url("Process/property_management"); ?>', 
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
              alerts('Property Assignment has been updated.','s');
            loadtable();
            clearForm();
          }
          else
            alerts(data['mes'],'w');
          $('#message5').empty();
          $('#actionButtons3').show();
        },
        error: function(data)
        {
          $('#message3').empty();
          $('#actionButtons5').show();
          alerts('An error occured. Please reload the page and try again.','e');
        }

      });
    
  }));

  <?php }?>


});
$(document).ready(function(){
  loadtable();
});

</script>