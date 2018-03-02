<div id="page-content">
  <div id='wrap'>
    <div id="page-heading">
      <ol class="breadcrumb">
        <li>Administrator</li>
          <li>User - Office Assignment</li>
      </ol>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-inverse">
              <div class="panel-heading">
                  <h4>User - Office Assignment Form</h4>
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
                          <label class="col-sm-2 control-label">Select User<span style="color:red">*</span></label>
                          <div class="col-sm-4">
                            <select name="user" id="user" style="width:100%" class="populate" onchange="loadtable()" required>
                              <option value="">Please Select</option>
                              <?php foreach($user as $r)
                                echo '<option value="'.$r[0].'">'.$r[1].'</option>';?>
                            </select>
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-2 control-label">Select Offices<span style="color:red">*</span></label>
                          <div class="col-sm-10">
                              <select multiple="multiple" id="multi-select" name="office[]" style = "width:100%" required>

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
                  <h4>User - Office Assignment</h4>
                  <div class="options">
                    <a class="panel-collapse" href="#">
                    <i class="fa fa-chevron-up"></i></a>
                  </div>
              </div>
              <div class="panel-body collapse in">
                  <table cellpadding="0" cellspacing="0" border="0" width="100%" id="spmsTable" class="table table-striped table-bordered datatables">
                      <thead>
                          <tr>
                              <th style="width : 20%">User</th>
                              <th style="width : 70%">Office</th>
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
      "sAjaxSource": "<?php echo base_url('Admin/user_office_assignment')?>"+"?loadtable=true",
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
  $('#user').val("");
  $('#user').select2({setVal:""});
  $('#act').val("add");
  loadUser();
  rebuildSelect(0);
}

<?php if($w_ == 1) { ?>

function del_(id, name){

  var result = confirm("Do you want to proceed deleting "+name+"?");
  if (result) {
       $.ajax
        ({ type:"POST",
           async: true,
           url:"<?php echo base_url('Admin/user_office_assignment')?>",
           data:{id:id, act:"delete"},
           dataType: 'json',
           cache: false,
           success: function(data)
            {
              if (data['mes'] == "Success")
              {
                alerts('User - Office Assignment has been deleted.','s');
                loadtable();
                loadUser();
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
       url:"<?php echo base_url('Admin/user_office_assignment')?>",
       data:{id:value, getspecific:'true'},
       dataType: 'json',
       cache: false,
       success: function(data)
         {
            $('#id').val(data[0][4]);
            loadUser2(data[0][4]);
            $('#act').val("save");
            rebuildSelect(data[0][3]);
            
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


function loadUser()
{
   $.ajax
    ({ type:"POST",
       async: true,
       url:"<?php echo base_url('Admin/user_office_assignment')?>",
       data:{loadUser:'true'},
       dataType: 'json',
       cache: false,
       success: function(data)
         {
            $('#user').empty();
            $('#user').append('<option value="">Please Select</option>');
            for(var i = 0; i <data.length; i++)
              $('#user').append('<option value="'+data[i][0]+'">'+data[i][1]+'</option>');
            $('#user').val("");
         },
         error: function(data)
         {
            alerts('An error occured. Please reload the page and try again.','e');
         }
    });
}

function loadUser2(val)
{
   $.ajax
    ({ type:"POST",
       async: true,
       url:"<?php echo base_url('Admin/user_office_assignment')?>",
       data:{loadUser:'true', id:val},
       dataType: 'json',
       cache: false,
       success: function(data)
         {
            $('#user').empty();
            $('#user').append('<option value="">Please Select</option>');
            for(var i = 0; i <data.length; i++)
              $('#user').append('<option value="'+data[i][0]+'">'+data[i][1]+'</option>');

            $('#user').val(val);
            $('#user').select2({setVal:val});
         },
         error: function(data)
         {
            alerts('An error occured. Please reload the page and try again.','e');
         }
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

  $('#multi-select').empty();
  $('#multi-select').multiSelect('refresh'); 
  $.ajax
    ({ type:"POST",
       async: true,
       url:"<?php echo base_url('Admin/user_office_assignment')?>",
       data:{loadOffice:"loadOffice", id:0},
       dataType: 'json',
       cache: false,
       success: function(data)
         {
            for(var i =0; i<data.length; i++)
            {
              var s = ''
              for(var j = 0; j < val.length; j++)
              {
                // alert(val[j][0]+''+data[i][6]);
                if(val[j][0] == data[i][4])
                {
                  // alert(val[j]+''+data[i][6]);
                  s = ' selected'; 
                }
              }
              $('#multi-select').append('<option value="'+data[i][4]+'"'+s+'>'+data[i][1]+'</option>');              
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
      url: '<?php echo base_url("Admin/user_office_assignment"); ?>', 
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
            alerts('New User - Office Assignment has been added.','s');
          else
            alerts('User - Office Assignment has been updated.','s');
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