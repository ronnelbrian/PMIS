<div id="page-content">
  <div id='wrap'>
    <div id="page-heading">
      <ol class="breadcrumb">
        <li>Administrator</li>
          <li>Access Control</li>
      </ol>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-inverse">
              <div class="panel-heading">
                  <h4>Select Transaction</h4>
              </div>
              <div class="panel-body" id="divstyle">
                   <form action="" class="form-horizontal row-border"  method="POST" id="spmsForm">
                      <input type="hidden" id="id" name="id"/>
                      <input type="hidden" id="act" name="act" value="add"/>
                      <div class="form-group">
                          <label class="col-sm-2 control-label">Select Transaction</label>
                          <div class="col-sm-4">
                            <select name="trans" id="trans" style="width:100%" class="populate" onchange="loadtable()">
                              <option value="">Please Select</option>
                              <option value="AD">Dashboard - Admin Dashboard</option>
                              <option value="UD">Dashboard - User Dashboard</option>

                              <option value="UM">System Config - Units of Measurement</option>
                              <option value="PC">System Config - Product Category</option>
                              <option value="PROPC">System Config - Property Category</option>
                              <option value="BS">System Config - Billing/Shipping Info</option>
                              <option value="DO">System Config - Department/Offices</option>
                              <option value="A">System Config - Approvers</option>
                              <option value="UR">User Management - User Roles</option>
                              <option value="SU">User Management - System Users</option>
                              <option value="AC">User Management - Access Control</option>
                              <option value="UOA">User Management - User - Office Assignment</option>

                              <option value="BA">Budget Allocation</option>
                              <option value="P">Product</option>
                              <option value="PROP">Property</option>

                              <option value="SV">Supplier/Vendor</option>
                              <option value="I">Inventory</option>
                              <option value="SM">Add Stocks Manuually</option>
                              <option value="IR">Item Requests</option>
                              <option value="PR">Purchase Request</option>
                              <option value="AIR">Approve Item Requests</option>                              
                              <option value="APR">Approve Purchase Requests</option>
                              <option value="IRM">Item Request Monitoring</option>
                              <option value="PO">Purchase Order</option>

                              <option value="D">Delivery</option>
                              <option value="PM">Property Management</option>
                              <option value="RDI">Returns/Defective Items</option>

                              <option value="MN">Notification - My Notifications</option>
                              <option value="AN">Notification - All Notifications</option>

                              <option value="RP">Reports - List of Products</option>
                              <option value="RPROP">Reports - List of Property</option>
                              <option value="RI">Reports - Inventory Report</option>
                              <option value="SL">Reports - Stock Ledger</option>
                              <option value="OE">Reports - Office Expense Report</option>

                              <option value="AT">Audit Trail</option>

                              <!--nEW aCCESS CONTROL-->
                                <option value="JR">Job Request</option>
                               <option value="AJR">Approve Job Request</option>
                               <option value="JO">Job Order</option>
                               <option value="FER">Furniture/Equipment Request</option>
                               <option value="AFER">Approve Furniture/Equipment Request</option>
                              <option value="FEO">Furniture/Equipment Order</option>
                              <!--New JUne-->
                              <option value="SC">Stock Card</option>
                            </select>
                          </div>
                      </div>
                   </form>
              </div>
          </div>

          <div class="panel panel-inverse">
              <div class="panel-heading">
                  <h4>Access Control</h4>
                  <div class="options">
                    <a class="panel-collapse" href="#">
                    <i class="fa fa-chevron-up"></i></a>
                  </div>
              </div>
              <div class="panel-body collapse in">
                  <table cellpadding="0" cellspacing="0" border="0" width="100%" id="spmsTable" class="table table-striped table-bordered datatables">
                      <thead>
                          <tr>
                              <th width="60%">Name</th>
                              <th width="20%">Role</th>
                              <th width="10%" style="text-align:center">Read</th>
                              <th width="10%" style="text-align:center">Write</th>
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
      "sAjaxSource": "<?php echo base_url('Admin/access_control')?>"+"?loadtable=true&trans="+$('#trans').val(),
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
  $('#desc').val("");
  $('#id').val("");
}

function u_r(id)
  {
    $.ajax
        ({ type:"POST",
           async: true,
           url:"<?php echo base_url('Admin/access_control')?>",
           data:{id:id, val:$('#r_'+id).prop('checked'), act:"u_r", tid: $('#trans').val()},
           dataType: 'json',
           cache: false,
           success: function(data)
             {
              if (data == "Success")
                alerts('Access control [Read] for the user has been updated.','s');
              else
              {
                ($('#r_'+id).prop('checked'))?$('#r_'+id).prop('checked',false):$('#r_'+id).prop('checked',true);
                alerts('Change has not beed saved. Please try again.','w');
              }

             },
             error: function(data)
             {
                alerts('Please try again.','e');
             }

      });
  }

  function u_w(id)
  {
    $.ajax
        ({ type:"POST",
           async: true,
           url:"<?php echo base_url('Admin/access_control')?>",
           data:{id:id, val:$('#w_'+id).prop('checked'), act:"u_w", tid: $('#trans').val()},
           dataType: 'json',
           cache: false,
           success: function(data)
             {
              if (data == "Success")
                alerts('Access control [Write] for the user has been updated.','s');
              else
              {
                ($('#w_'+id).prop('checked'))?$('#w_'+id).prop('checked',false):$('#w_'+id).prop('checked',true);
                alerts('Change has not beed saved. Please try again.','w');
              }

             },
             error: function(data)
             {
                alerts('Please try again.','e');
             }

      });
  }


$(document).ready(function(){
  loadtable();
  $('.populate').select2();

});

</script>