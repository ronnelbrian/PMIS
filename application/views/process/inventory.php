<div id="page-content">
  <div id='wrap'>
    <div id="page-heading">
      <ol class="breadcrumb">
        <li>Administrator</li>
          <li>Inventory</li>
      </ol>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-inverse">
              <div class="panel-heading">
                  <h4>Inventory</h4>
                  <div class="options">
                    <a class="panel-collapse" href="#">
                    <i class="fa fa-chevron-up"></i></a>
                  </div>
              </div>
              <div class="panel-body collapse in">
                  <!-- <h4>Stock Legend:</h4> -->
                  <!-- <table style="padding:0px" cellspacing="0" cellpadding="0">
                    <tr>
                      <td> <button class='btn-info btn-xs '  data-tooltip='Create Purchase Request'> 
                             <i class='fa fa-arrow-right'></i>
                             <span></span></button></td>
                      <td style="padding-left:5px"><h5>Create Purchase Request</h5></td>
                    
                      <td style="padding-left:70px"><button class='btn-success btn-xs '  data-tooltip='Create Purchase Order'> 
                             <i class='fa fa-arrow-right'></i>
                             <span></span></button></td>
                      <td style="padding-left:5px"><h5>Create Purchase Order</h5></td>
                    </tr> -->
                  </table>

                  <table cellpadding="0" cellspacing="0" border="0" width="100%" id="spmsTable" class="table table-striped table-bordered datatables">
                      <thead>
                          <tr>
                             <th style="width : 10%">Item ID</th>
                              <th style="width : 10%">Item</th>
                              <th style="width : 3%">Unit</th>
                              <th style="width : 3%">Current Stock</th>
                              <th style="width : 3%">Critical Level</th>
                            <!--   <th style="width : 10%">Date Updated</th>
                              <th style="width : 10%">Username</th> -->
                              <!--<th style="width : 5%; text-align:center">Action</th>-->
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
      "sAjaxSource": "<?php echo base_url('Process/inventory')?>"+"?loadtable=true",
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
  
}

function po_(id, name)
{
  var result = confirm("You will now be redirected to the Purchase Order form for the Product "+name+". Would you like to proceed?");
  if(result)
  {
    window.location.replace('<?php echo base_url("Process/purchase_order")?>');
  }
}
function pr_(id,name){
  var result = confirm("You will now be redirected to the Purchase Request form for the Product"+name+". Would you like to proceed?");
  if(result){
    window.location.replace('<?php echo base_url("Process/purchase_request")?>');
  }
}


$(document).ready(function(){
  loadtable();
});

</script>