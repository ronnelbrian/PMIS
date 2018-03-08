<div id="page-content">
  <div id='wrap'>
    <div id="page-heading">
      <ol class="breadcrumb">
          <li>Furniture/ Equipment Request</li>
      </ol>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
            <div class="panel panel-inverse">
              <div class="panel-heading">
                  <h4>Furniture/ Equipment Request Form</h4>
                  <div class="options">
                    <a class="panel-collapse" href="#">
                      <i class="fa fa-chevron-up"></i></a>
                  </div>
              </div>
              <div class="panel-body" id="divstyle" style="display:block;">

                   <form action="" class="form-horizontal row-border"  method="POST" id="furniture_request_form">
                      <input type="hidden"  name="add_furniture_request" id="add_furniture_request"/> 
                      <input type="hidden" value="add" name="id" id="id"/>
                      <div class="form-group">
                          <div class="col-md-2" style="text-align:right; padding-top:8px;">
                            <label><b>Office/Section:</b><span style="color:red">*</span></label>
                          </div>
                          <div class="col-md-4">
                            <select class="js-example-basic-single form-control" id="office" name="office" required>
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
                       <div class="form-group">                                            
                          <div class="col-md-11 group" >
                              <div class="col-md-2" style="text-align: center; padding-top:8px;">
                            <label><b>Item Description</b><span style="color:right; color: red;">*</span></label>
                              </div>
                           <div class="col-md-2" style="text-align:center; padding-top:8px;">
                            <label><b>Unit</b><span style="color:red; text-align: center;">*</span></label>
                          </div>
                          <div class="col-md-2" style="text-align:center; padding-top:8px;">
                            <label><b>Quantity</b><span style="color:red">*</span></label>
                          </div>
                          <div class="col-md-2" style="text-align:center; padding-top:8px;">
                            <label><b>Unit Cost</b><span style="color:red">*</span></label>
                          </div>
                          <div class="col-md-2" style="text-align:center; padding-top:8px;">
                            <label><b>Purpose:</b><span style="color:red">*</span></label>
                          </div>
                          <div class="col-md-2" style="text-align:center; padding-top:8px;">
                            <label><b>Action:</b></label>
                          </div>
                            </div>

                      </div> 

                       <div class="form-group" id="example-3" data-mfield-options='{"section": ".group","btnAdd":"#btnAdd-3","btnRemove":".btnRemove"}'>                                            
                          <div class="col-md-11 group" ><br>
                          <div class="col-md-2">
                              <textarea style="height: 40px;" class="form-control" rows="2" cols="6" id="item_desc" name="item_desc[]" required></textarea>
                           </div> 
                          <div class="col-md-2" id="ctp_1" >
                           <input type="text" class="form-control" name="unit[]" id="unit"  placeholder="pc(s)" required>
                          </div> 
                          <div class="col-md-2" id="ctp_1">
                           <input type="number" class="form-control" name="qty[]" id="qty" min = "0" onchange="$('#total_cost').val(($(this).val() * $('#unit_cost').val()).toFixed(2))" placeholder="" required>
                          </div>
                          <div class="col-md-2" id="ctp_2" >
                            <input type="number" class="form-control" name="unit_cost[]" id="unit_cost" min = "0" onchange="$('#total_cost').val(($(this).val() * $('#qty').val()).toFixed(2))" placeholder="" required>
                          </div>
                          <div class="col-md-2">
                              <textarea style="height: 40px;" class="form-control" rows="2" cols="10"  id="purpose" name="purpose[]" required></textarea>
                           </div>  

                            <div class="col-md-2"  >
                              <center>
                            <button type="button" class="btn btn-danger btnRemove">-</button>
                            <button type="button" id="btnAdd-3" class="btn btn-primary btnAdd-3">+</button>
                              </center>
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
                          <div class="col-md-4">
                            <label><b>Responsibility Center</b></label>
                            <select class="populate" style="width:100%" id="s_office" name="s_office">
                              <option value="">Select Responsibility Center</option>
                              <?php foreach($o as $r) echo '<option value="'.$r[0].'">'.$r[1].'</option>';?>
                            </select>
                          </div>  
                           <div class="col-md-4">
                            <label><b>Date Requested</b></label>
                            <input type="date" class="form-control" name="s_date" id="s_date">
                          </div>  
                          <div class="col-md-4">
                            <label><b>Status</b></label>
                            <select class="populate" style="width:100%" id="s_status" name="s_status">
                              <option value="">All</option>
                              <option value="Pending">Pending</option>
                              <option value="Approved">Approved</option>
                              <option value="Disapproved">Disapproved</option>
                              <option value="Cancelled">Cancelled</option>
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
              </div></div>

               <div class="panel-body collapse in">
                  <table cellpadding="0" cellspacing="0" border="0" width="100%" id="spmsTable" class="table table-striped table-bordered datatables">
                      <thead>
                          <tr>
                              <th style="width : 10%">FR No.</th>
                              <th style="width : 13%">Description</th>
                              <th style="width : 15%">Responsibility Center</th>
                             <!-- <th style="width : 5%">Qty</th>
                              <th style="width : 5%">Unit</th>-->
                              <th style="width: 5% ">Unit</th>      
                              <th style="width : 5%">Quantity</th>                        
                              <th style="width : 10%">Unit Cost</th>
                              <th style="width:10%">Total Cost</th>
                              <th style="width : 7%">Date Requested</th>
                              <th style="width : 10%">Requested by</th>
                              <th style="width : 10%">Status</th>
                           <!--   <th style="width : 17%; text-align:center">Action</th>-->
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
<script type='text/javascript' src='<?php echo base_url('assets')?>/js/jquery-1.10.2.min.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/js/jqueryui-1.10.3.min.js'></script>
<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/form-select2/select2.min.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/quicksearch/jquery.quicksearch.min.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/form-multiselect/js/jquery.multi-select.min.js'></script>
<script type='text/javascript' src='<?php echo base_url('assets')?>/js/custom.js'></script> 

<script type='text/javascript' src='<?php echo base_url('assets')?>/js/jquery.multifield.min.js'></script> 


  <script>
  $('#example-3').multifield();
    </script>

<script language="JavaScript" type='text/javascript'>


///
function loadtable()
{
  $('#spmsTable').dataTable().fnClearTable();
  $('#spmsTable').dataTable().fnDraw();
  $('#spmsTable').dataTable().fnDestroy();
  $('#spmsTable').dataTable({
      "serverSide": true,
      "sAjaxSource": "<?php echo base_url('Process/furniture_and_equipment_request')?>"+"?loadtable=true&"+$('#searchForm').serialize(),
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


$(document).ready(function(){
  $('.populate').select2();

  <?php if($w_ == 1) { ?>
 
  $("#furniture_request_form").on('submit',(function(e){
      e.preventDefault();
   
    $.ajax({
      url: '<?php echo base_url("Process/furniture_and_equipment_request"); ?>', 
      type:"POST",
      data: new FormData(this), 
      dataType: 'json',
      contentType: false,     
      processData: false,  
      cache: false, 
      success: function(data){
        if (data['mes'] == "Success"){
          
         confirm('New Furniture Request has been added.');
       
         loadtable();
        }
       
      },  error: function(data)
             {
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

$(document).ready(function(){
  loadtable();
});

</script>