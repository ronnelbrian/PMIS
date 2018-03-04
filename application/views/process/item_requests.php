<style>
.center{
  align: center;
}

</style>
<div id="page-content">
  <div id='wrap'>
    <div id="page-heading">
      <ol class="breadcrumb">
        <li>Administrator</li>
          <li>Item Request</li>
      </ol>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-inverse">
              <div class="panel-heading">
                  <h4>Item Request Form</h4>
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
                          <div class="col-md-2" style="text-align:right; padding-top:8px;">
                            <label><b>Requesting Office <span style="color:red">*</span></b></label>
                          </div>
                          <div class="col-md-4">
                            <select class="js-example-basic-single populate" id="office" name="office" required>
                              <option value="">Select Requesting Office</option>
                              <?php foreach($o as $r) echo '<option value="'.$r[0].'">'.$r[1].'</option>';?>
                            </select>
                          </div>
                          <div class="col-md-2" style="text-align:right; padding-top:8px;">
                            <label><b>Fund Cluster</b></label>
                          </div>
                          <div class="col-md-4">
                            <select class="populate" id="fund_cluster" name="fund_cluster" style="width:100%" >
                              <?php foreach($fund_cluster as $r) echo '<option value="'.$r[0].'">'.$r[0].'</option>';?>
                            </select>
                          </div>    
                        </div>
                      <div id="divItems">
                        <input type="hidden" id="ctr" value = "1"/> 
                        <div class="form-group" id="row_1">


                       <!--  <div class="col-md-1" style="text-align:right; padding-top:8px;">
                            <label><b>Unit</b></label>
                          </div>
                          <div class="col-md-1">
                           <input id="units" class="form-control">
                          </div>  -->
                          



                          <div class="col-md-2" style="text-align:right; padding-top:8px;">
                            <label><b>Item</b><span style="color:red">*</span></label>
                          </div>
                          <div class="col-md-3">
                            <select class="js-example-basic-single populate" id="item_1" name="item[]" style="width:100%" required onChange="showUnit(this.value, 1)"><!--onchange="Onchange()"-->
                              <option value="">Select an Item</option>
                              <?php foreach($p as $r) echo '<option value="'.$r[7].'">'.$r[1].' ('.$r[2].')'.'</option>';?>
                            </select>
                          </div>  
                          <div class="col-md-1" style="text-align:right; padding-top:8px;">
                            <label><b>Qty</b><span style="color:red">*</span></label>
                          </div>
                          <div class="col-md-1" id="ctp_1" >
                            <input type="number" class="form-control" name="unit[]" id="unit" min = "0" placeholder="" required>
                          </div>

                          <div class="col-md-1" style="text-align:right; padding-top:8px;">
                            <label><b>Reason</b></label>
                          </div>
                          <div class="col-md-2" id="ctp_2" >
                            <input type="text" class="form-control" name="reason[]" id="reason" placeholder="">
                          </div>
                          <div class="col-md-2" id="btn_1" >
                            <input type="button" class="btn btn-primary" onClick="addNew(); $(this).hide()" id="btnAdd_1" name="btnAdd_[]" value="+"></input>
                          </div>    
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
                            <label><b>Requesting Office</b></label>
                          </div>
                          <div class="col-md-4">
                            <select class="populate" style="width:100%" id="s_office" name="s_office">
                              <option value="">Select Requesting Office</option>
                              <?php foreach($o as $r) echo '<option value="'.$r[0].'">'.$r[1].'</option>';?>
                            </select>
                          </div>  
                          <div class="col-md-2" style="text-align:right; padding-top:8px;">
                            <label><b>Item</b></label>
                          </div>
                          <div class="col-md-4">
                            <select class="populate" style="width:100%" id="s_item" name="s_item">
                              <option value="">All Items</option>
                              <?php foreach($p as $r) echo '<option value="'.$r[7].'">'.$r[1].' ('.$r[3].')'.'</option>';?>
                            </select>
                          </div>  
                        </div>
                     
                        <div class="form-group" style="padding:0px">
                         
                          <div class="col-md-2" style="text-align:right; padding-top:8px;">
                            <label><b>Date Requested</b></label>
                          </div>
                          <div class="col-md-4">
                            <input type="date" class="form-control" name="s_date" id="s_date">
                          </div>  
                          <div class="col-md-2" style="text-align:right; padding-top:8px;">
                            <label><b>Status</b></label>
                          </div>
                          <div class="col-md-4">
                            <select class="populate" style="width:100%" id="s_status" name="s_status">
                              <option value="">All</option>
                              <option value="Pending">Pending</option>
                              <option value="Approved">Approved</option>
                              <option value="Disapproved">Disapproved</option>
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
                              <th style="width : 10%">IR ID/ RIS NO</th>
                             <!-- <th style="width:5%">Unit</th>
                              <th style="width:7%">Quantity</th>-->
                              <th style="width : 15%">Description</th>
                              <th style="width : 15%">Office</th>
                              <th style="width:10%">Fund Cluster</th>
                              <th style="width : 10%">Requested By</th>
                              <th style="width : 10%">Date Requested</th>                              
                              <th style="width : 5%">Stocks</th>
                              <th style="width : 10%">Status</th>
                            <!--  <th style="width : 10%">Remarks</th>-->
                             <!-- <th style="width : 7%; text-align:center">Action</th>-->
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


<!-- <script>////
  function Onchange(){
    var x = document.getElementById("item_1").value;

     $.ajax
        ({ type:"POST",
           async: true,
           url:"<?php echo base_url('Process/item_requests')?>",
           data:{id:x, action:"getspecifics"},
           dataType: 'json',
           cache: false,
           success: function(data)
            {
              $('#units').val(data[0][1]);
             },
             error: function(data)
             {
                   alerts('An error occured. Please reload the page and try again.');
          
             }

    });
        
  }</script> -->

<script language="JavaScript" type='text/javascript'>

///
function loadtable()
{
  $('#spmsTable').dataTable().fnClearTable();
  $('#spmsTable').dataTable().fnDraw();
  $('#spmsTable').dataTable().fnDestroy();
  $('#spmsTable').dataTable({
      "serverSide": true,
      "sAjaxSource": "<?php echo base_url('Process/item_requests')?>"+"?loadtable=true&"+$('#searchForm').serialize(),
      "deferLoading": 10,
      "bPaginate": true,
      "aaSorting": [[0,'desc']],
     
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
  $('#office').val("");
  var val = "";
 <?php foreach($p as $r) 
  {
    $val = "'".$r[7]."'";
    echo ' val += "<option value='.$val.'>'.htmlentities($r[1]).' ('.$r[2].')'.'</option>";';
  }
  ?>
  $('#divItems').empty();
  $('#divItems').append(' <input type="hidden" id="ctr" value = "1"/> '+
                        '<div class="form-group" id="row_1">'+
                          '<div class="col-md-2" style="text-align:right; padding-top:8px;">'+
                            '<label><b>Item</b></label>'+
                          '</div>'+
                          '<div class="col-md-3">'+
                            '<select class="populate" id="item_1" name="item[]" style="width:100%"  required>'+
                              '<option value="">Select an Item</option>'+val+'</select>'+
                          '</div>'+
                          '<div class="col-md-1" style="text-align:right; padding-top:8px;">'+
                            '<label><b>Qty</b></label>'+
                          '</div>'+
                          '<div class="col-md-1" id="ctp_1" >'+
                            '<input type="number" class="form-control" name="unit[]" min = "0"  id="unit" placeholder="" required>'+
                          '</div>'+
                          '<div class="col-md-1" style="text-align:right; padding-top:8px;">'+
                            '<label><b>Reason</b></label>'+
                          '</div>'+
                          '<div class="col-md-2" id="ctp_2" >'+
                            '<input type="text" class="form-control" name="reason[]" id="reason" placeholder="">'+
                          '</div>'+
                          '<div class="col-md-2" id="btn_1" >'+
                            '<input type="button" class="btn btn-primary" onClick="addNew(); $(this).hide()" id="btnAdd_1" name="btnAdd_[]" value="+"></input>'+
                          '</div>'+
                        '</div>');
  $("#item_1").select2();
}

function resetForm()
{
  // $('#s_user').val("");
  $('#s_office').val("");
  $('#s_status').val("");
  $('#s_date').val("");
  $('#s_item').val("");
  $('#s_item').select2({setVal:""});
  $('#s_status').select2({setVal:""});
  // $('#s_user').select2({setVal:""});
  $('#s_office').select2({setVal:""});
}

function addNew()
{
  var val = "";
  var ctr = parseInt($('#ctr').val())+1;
  $('#ctr').val(ctr)
  $('#btnAdd_'+(ctr-1)).hide();

  // alert(ctr);
  
  <?php foreach($p as $r) 
  {
    $val = "'".$r[7]."'";
    echo ' val += "<option value='.$val.'>'.htmlentities($r[1]).' ('.$r[2].')'.'</option>";';
  }
  ?>
  $('#divItems').append('<div class="form-group" id="row_'+ctr+'">'+
     
      '<div class="col-md-2" style="text-align:right; padding-top:8px;">'+
      '<label><b>Item</b></label>'+
      '</div>'+
      '<div class="col-md-3">'+
        '<select class="populate" id="item_'+ctr+'" onChange="showUnit(this.value,'+ctr+')" name="item[]"" style="width:100%" required>'+
          '<option value="">Select an Item</option>'+
          val
        +'</select>'+
      '</div>'+
      '<div class="col-md-1" style="text-align:right; padding-top:8px;">'+
        '<label><b>Qty</b></label>'+
      '</div>'+
      '<div class="col-md-1" id="ctp_'+ctr+'" >'+
        '<input type="number" class="form-control" name="unit[]" id="unit_'+ctr+'" min = "0" placeholder="" required>'+
      '</div>'+
      '<div class="col-md-1" style="text-align:right; padding-top:8px;">'+
        '<label><b>Reason</b></label>'+
      '</div>'+
      '<div class="col-md-2" id="ctp_'+ctr+'" >'+
        '<input type="text" class="form-control" name="reason[]" id="reason" placeholder="">'+
      '</div>'+
      '<div class="col-md-2" id="btn_'+ctr+'" >'+

      '</div>'+
  '</div>');
  $("#item_"+ctr).select2();

  var ctr = $('#ctr').val();
  $('#btn_'+ctr).empty();

  var t_c = 0, btn = "";
  $('select[name^="item[]"]').each(function(){
    t_c++;
  });
  (t_c > 1)?btn+='<input type="button" class="btn btn-danger" onClick="removeRow('+ctr+')" value="-" ></input>':null;
  btn+='<input type="button" class="btn btn-primary" onClick="addNew(); $(this).hide()" id="btnAdd_'+ctr+'" name="btnAdd_[]" value="+" ></input>';
  
  $('#btn_'+ctr).append(btn);

  var arr = $('input[name^="btnAdd_[]"]').length;
    var ct = 1;
    $('input[name^="btnAdd_[]"]').each(function(){
      (ct == arr)?$(this).show():$(this).hide();
      ct++;
    });

}

function removeRow(ctr)
{
  $('#num').val(parseInt($('#num').val())-1);
  // var btn='<input type="button" class="btn btn-primary" onClick="addNew()" id="btnAdd_'+(ctr-1)+'" value="+" style="height:28px"></input>';
  
  $('#row_'+ctr).empty();
  $('#row_'+ctr).hide();

  var ct = 0;
  $('input[name^="btnAdd_[]"]').each(function(){
    if($(this).css('display') == 'inline-block' || $(this).css('display') == 'block')
      ct++;
  });
  if(ct == 0)
    $('#btnAdd_'+(ctr-1)).show();

  var ct = 0;
  $('input[name^="btnAdd_[]"]').each(function(){
    if($(this).css('display') == 'inline-block' || $(this).css('display') == 'block')
      ct++;
  });
  if(ct == 0)
    $('#btnAdd_1').show();
}

<?php if($w_ == 1) { ?>

function del_(id, name){

  var result = confirm("Do you want to proceed deleting "+name+"?");
  if (result) {
       $.ajax
        ({ type:"POST",
           async: true,
           url:"<?php echo base_url('Process/item_requests')?>",
           data:{id:id, act:"delete"},
           dataType: 'json',
           cache: false,
           success: function(data)
            {
              if (data['mes'] == "Success")
              {
                alerts('Item Request has been cancelled.','s');
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

function view_ris(id,name){
  
      window.open('<?php echo base_url("Process/view_requisition_and_issue_slip")?>'+'?id='+id);
    
}


<?php }?>

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
      url: '<?php echo base_url("Process/item_requests"); ?>', 
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
            alerts('New Item Request has been added.','s');
          else
            alerts('Item Request has been updated.','s');
          ($('#_table').val() == "1")?loadtable():null;
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

  $("#searchForm").on('submit',(function(e) {
    e.preventDefault();
    $('#actionButtons2').hide();
    $('#message3').append("<div id='message4'></div>");
    $('#message4').append("<img src='<?php echo base_url('assets/img/loading.gif');?>'/>");
    $('#message4').append("    Processing...");
   loadtable();
    
  }));


});


//SETTING MAX FOR QUANTITY
function showUnit(id, counter){
  $.ajax
        ({ type:"POST",
           async: true,
           url:"<?php echo base_url('Process/item_requests')?>",
           data:{id:id, act3:"getData"},
           dataType: 'json',
           cache: false,
           success: function(data)
            {
              if(counter == 1) 
              {
                // $('#unit').val(data[0][0]);
                $('#unit').attr({"max":data[0][1]});
              } 
              else
              {
                // $('#unit_'+counter+'').val(data[0][0]);
                $('#unit_'+counter+'').attr({"max":data[0][1]});
              }
             },
             error: function(data)
             {
                   alerts('An error occured. Please reload the page and try again.');
             }

    });
}

$(document).ready(function(){
  loadtable();
});

</script>