<div id="page-content">
  <div id='wrap'>
    <div id="page-heading">
      <ol class="breadcrumb">
        <li>Administrator</li>
          <li>Audit Trail</li>
      </ol>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-inverse">
              <div class="panel-heading">
                  <h4>Audit Trail</h4>
                  <div class="options">
                    <a class="panel-collapse" href="#">
                    <i class="fa fa-chevron-up"></i></a>
                  </div>
              </div>
              <div class="panel-body collapse in">
                  <table cellpadding="0" cellspacing="0" border="0" width="100%" id="spmsTable" class="table table-striped table-bordered datatables">
                      <thead>
                          <tr>
                              <th style="width : 10%">Audit Trail ID</th>
                              <th style="width : 65%">Action</th>
                              <th style="width : 10%">User</th>
                              <th style="width : 15%">Date</th>
                          </tr>
                      </thead>
                      <tbody>
                      <?php 
                          foreach($data as $r)
                            echo '<tr>
                                    <td>'.$r[0].'</td>
                                    <td>'.$r[1].'</td>
                                    <td>'.$r[2].'</td>
                                    <td>'.$r[3].'</td>
                                  </tr>';

                      ?>
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


$(document).ready(function(){
  $('#spmsTable').dataTable();

});

</script>