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
                  <h4>Approve Item Request</h4>
                  <div class="options">
                    <a class="panel-collapse" href="#">
                    <i class="fa fa-chevron-down"></i></a>
                  </div>
              </div>
              <div class="panel-body collapse in">
                  <h4>Stock Legend:</h4>
                  <table style="padding:0px" cellspacing="0" cellpadding="0">
                    <tr>
                      <td><span><i class='fa fa-square' style="color:#df1b1b"></i></span></td>
                      <td style="padding-left:5px"><h5>Critical Stock Level</h5></td>
                    
                      <td style="padding-left:70px"><span><i class='fa fa-square' style="color:#2d78d5"></i></span></td>
                      <td style="padding-left:5px"><h5>Normal Stock Level</h5></td>
                    </tr>
                  </table>
                  
                  <table cellpadding="0" cellspacing="0" border="0" width="100%" id="spmsTable" class="table table-striped table-bordered datatables">
                      <thead>
                          <tr>
                              <th style="width : 5%">APR ID</th>
                              <th style="width : 10%">Requested Item</th>
                              <th style="width : 10%">Office</th>
                              <th style="width : 10%">Requested By</th>
                              <th style="width : 10%">Date Requested</th>
                              <th style="width : 20%">Remarks</th>
                              <th style="width : 20%">Status</th>
                              <th style="width : 5%; text-align:center">Stock</th>
                              <th style="width : 5%; text-align:center">Action</th>
                          </tr>
                      </thead>
                      <tbody>
                        <td>1</td>
                        <td>2</td>
                        <td>3</td>
                        <td>4</td>
                        <td>5</td>
                        <td>6</td>
                        <td>7</td>
                        <td>8</td>                        
                        <td>9</td>
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
<script language="JavaScript" type='text/javascript'>


$(document).ready(function(){
  $('#spmsTable').dataTable();

});

</script>