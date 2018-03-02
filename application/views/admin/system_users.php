<div id="page-content">
  <div id='wrap'>
    <div id="page-heading">
      <ol class="breadcrumb">
        <li>Administrator</li>
          <li>System Users</li>
      </ol>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-inverse">
              <div class="panel-heading">
                  <h4>System Users Form</h4>
                  <div class="options">
                    <a class="panel-collapse" href="#">
                      <i class="fa fa-chevron-down"></i></a>
                  </div>
              </div>
              <div class="panel-body" id="divstyle" style="display:none;">
                   <form action="" class="form-horizontal row-border"  method="POST" id="spmsForm">
                      <input type="hidden" id="id" name="id"/>
                      <input type="hidden" id="act" name="act" value="add"/>

                      <input type="hidden" id="fileprofile" name="fileprofile"/>

                      <div class="form-group">
                        <label class="col-sm-2 control-label">Profile Picture</label>

                        <div class="col-sm-2">
                           <img id="imagepreview" style="width:100px; height:100px" src="<?php echo base_url('assets/img/noprofilepic.png');?>" alt="your image" />
                        </div>
                        <div class="col-md-4">
                          <input type="file" id="profilepic" name="profilepic" accept="image/*">
                          <p class="help-block" id="message 1">
                             Select Profile Pic
                          </p>
                        </div>
                      </div>

                      <div class="form-group">
                          <label class="col-sm-2 control-label">First Name<span style="color:red">*</span></label>
                          <div class="col-sm-2">
                             <input type="text" class="form-control" name="fname" id="fname" required>
                          </div>
                          <label class="col-sm-1 control-label">Middle Name</label>
                          <div class="col-sm-2">
                             <input type="text" class="form-control" name="mname" id="mname">
                          </div>
                          <label class="col-sm-1 control-label">Last Name<span style="color:red">*</span></label>
                          <div class="col-sm-2">
                             <input type="text" class="form-control" name="lname" id="lname" required>
                          </div>
                          <label class="col-sm-1 control-label">Suffix</label>
                          <div class="col-sm-1">
                             <input type="text" class="form-control" name="suffix" id="suffix">
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-2 control-label">Address</label>
                          <div class="col-sm-6">
                             <input type="text" class="form-control" name="address" id="address">
                          </div>
                          <label class="col-sm-2 control-label">Gender<span style="color:red">*</span></label>
                          <div class="col-sm-2">
                             <select name="gender" id="gender" style="width:100%" class="populate" required>
                               <option value ="">Please Select</option>
                               <option value ="0">Male</option>
                               <option value ="1">Female</option>
                             </select>
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-2 control-label">Date of Birth</label>
                          <div class="col-sm-4">
                              <div class="input-group date" id="datepicker-startview1">
                                  <input type="text" class="form-control" class="populateDate" id="bday" name="bday">
                                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                              </div>
                          </div>
                          <label class="col-sm-2 control-label">Place of Birth</label>
                          <div class="col-sm-4">
                             <input type="text" class="form-control" name="bplace" id="bplace">
                          </div>
                      </div> 
                      <div class="form-group">
                          <label class="col-sm-2 control-label">Role<span style="color:red">*</span></label>
                          <div class="col-sm-2">
                             <select name="role" id="role" style="width:100%" class="populate" required>
                               <option value ="">Please Select</option>
                               <?php 
                               foreach($role as $r)
                                  echo '<option value ="'.$r[3].'">'.$r[1].'</option>';
                              ?>
                               
                             </select>
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-2 control-label">Username<span style="color:red">*</span></label>
                          <div class="col-sm-2">
                             <input type="text" class="form-control" name="username" id="username" required>
                          </div>
                          <div id="divChangePass" style="display:none"><a href="javascript:changePass2();" id="passLink">Change Password</a></div>                          
                      </div>
                      <div class="form-group" id="divPass">
                        <label class="col-sm-2 control-label">Password<span style="color:red">*</span></label>
                        <div class="col-sm-2">
                           <input type="password" class="form-control" name="pass" id="pass">
                        </div>
                        <label class="col-sm-2 control-label">Confirm Password<span style="color:red">*</span></label>
                        <div class="col-sm-2">
                           <input type="password" class="form-control" name="confirmpass" id="confirmpass">
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
                  <h4>System Users</h4>
                  <div class="options">
                    <a class="panel-collapse" href="#">
                    <i class="fa fa-chevron-up"></i></a>
                  </div>
              </div>
              <div class="panel-body collapse in">
                  <table cellpadding="0" cellspacing="0" border="0" width="100%" id="spmsTable" class="table table-striped table-bordered datatables">
                      <thead>
                          <tr>
                              <th style="width : 10%">ID</th>
                              <th style="width : 10%">Picture</th>
                              <th style="width : 30%">Name</th>
                              <th style="width : 30%">Username</th>
                              <th style="width : 10%">Role</th>
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
<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/form-typeahead/typeahead.min.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/form-select2/select2.min.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/form-autosize/jquery.autosize-min.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/form-colorpicker/js/bootstrap-colorpicker.min.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/form-stepy/jquery.stepy.js'></script> 

<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/jqueryui-timepicker/jquery.ui.timepicker.min.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/form-daterangepicker/daterangepicker.min.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/form-datepicker/js/bootstrap-datepicker.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/form-daterangepicker/moment.min.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/form-jasnyupload/fileinput.min.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/jqueryui-timepicker/jquery.ui.timepicker.min.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/demo/demo-formwizard.js'></script> 

<script language="JavaScript" type='text/javascript'>

function loadtable()
{
  $('#spmsTable').dataTable().fnClearTable();
  $('#spmsTable').dataTable().fnDraw();
  $('#spmsTable').dataTable().fnDestroy();

  $('#spmsTable').dataTable({
      "serverSide": true,
      "sAjaxSource": "<?php echo base_url('Admin/system_users')?>"+"?loadtable=true",
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

function changePass2()
{
  $('#pass').val("");
  $('#confirmpass').val("");
  if($('#passLink').text() == 'Change Password')
  {
    $('#divPass').slideDown();
    $('#passLink').text("Cancel changing password");
  }
  else
  {
    $('#divPass').slideUp();
    $('#passLink').text("Change Password");
  }
}
function clearForm()
{
  $('#id').val("");
  $('#act').val("add");
  $('#fname').val("");
  $('#mname').val("");
  $('#lname').val("");
  $('#suffix').val("");
  $('#bday').val("");
  $('#bplace').val("");
  $('#gender').val("");
  $('#role').val("");
  $('#address').val("");
  $('#username').val("");
  $('#pass').val("");
  $('#confirmpass').val("");
  $('#gender').select2({
      setVal:""
  });
  $('#role').select2({
      setVal:""
  });
  $('#imagepreview').attr('src', "<?php echo base_url('assets/uploads/noprofilepic.png');?>");
  $('#profilepic').val("");
  $('#divPass').slideDown();
  $('#divChangePass2').slideUp();
}

<?php if($w_ == 1) { ?>

function del_(id, name){

  var result = confirm("Do you want to proceed deleting "+name+"?");
  if (result) {
       $.ajax
        ({ type:"POST",
           async: true,
           url:"<?php echo base_url('Admin/system_users')?>",
           data:{id:id, act:"delete"},
           dataType: 'json',
           cache: false,
           success: function(data)
            {
              if (data['mes'] == "Success")
              {
                alerts('User has been deleted.','s');
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
       url:"<?php echo base_url('Admin/system_users')?>",
       data:{id:value, getspecific:'true'},
       dataType: 'json',
       cache: false,
       success: function(data)
         {
            $('#id').val(data[0][6]);
            $('#fname').val(data[0][7]);
            $('#mname').val(data[0][8]);
            $('#lname').val(data[0][9]);
            $('#suffix').val(data[0][10]);
            $('#bday').val(data[0][11]);
            $('#bplace').val(data[0][12]);
            $('#gender').val(data[0][13]);
            $('#gender').select2({
                setVal:data[0][13]
            });
            $('#address').val(data[0][14]);
            $('#role').val(data[0][15]);
            $('#role').select2({
                setVal:data[0][15]
            });
            $('#username').val(data[0][16]);
            $('#act').val("save");

            $('#divPass').slideUp();
            $('#divChangePass').slideDown();
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

function readURL(input) 
{
  if (input.files && input.files[0]) 
  {
    var reader = new FileReader();
    reader.onload = function (e) {
        $('#imagepreview').attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
  }
}

$(document).ready(function(){
  $("#profilepic").change(function(){
      readURL(this);
  });
  $('.populate').select2();
  $('#bday').datepicker({startView: 3});
  loadtable();

  <?php if($w_ == 1) { ?>
  $("#spmsForm").on('submit',(function(e) {
    e.preventDefault();
    if($('#pass').val() == $('#confirmpass').val())
    {
      $('#actionButtons').hide();
      $('#message').append("<div id='message2'></div>");
      $('#message2').append("<img src='<?php echo base_url('assets/img/loading.gif');?>'/>");
      $('#message2').append("    Processing...");
      $.ajax({
        url: '<?php echo base_url("Admin/system_users"); ?>', 
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
              alerts('New user has been added.','s');
            else
              alerts('User has been updated.','s');
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
    }
    else
      alerts('Please confirm your password correctly.', 'w');
    }));
  <?php }?>
});

</script>