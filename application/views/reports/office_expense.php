<div id="page-content">
  <div id='wrap'>
    <div id="page-heading">
      <ol class="breadcrumb">
        <li>Report</li>
          <li>Office Expense</li>
      </ol>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-inverse">
              <div class="panel-heading">
                  <h4>Office Expense Report Filter/Parameters</h4>
                  <div class="options">
                    <a class="panel-collapse" href="#">
                      <i class="fa fa-chevron-up"></i></a>
                  </div>
              </div>
              <div class="panel-body" id="divstyle" style="display:block;">
                   <form action="" class="form-horizontal row-border"  method="POST" id="spmsForm">
                      <div class="form-group">
                          <label class="col-sm-2 control-label">Select Office</label>
                          <div class="col-sm-10">
                              <select id="office" name="office" style = "width:100%" class="populate">
                                <option value="">All</option>
                                <?php 
                                foreach($o as $r)
                                  echo '<option value="'.$r[1].'">'.$r[3].'</option>';
                                ?>
                              </select>
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-2 control-label">Select Columns</label>
                          <div class="col-sm-10">
                              <select multiple="multiple" id="columns" name="columns[]" style = "width:100%">
                                <option value="item_no" selected>Item #</option>
                                <option value="id">ID</option>
                                <option value="product" selected>Item</option>
                                <option value="office" selected>Office</option>
                                <option value="qty" selected>Qty</option>
                                <option value="price" selected>Unit Price</option>
                                <option value="total_amount" selected>Total Amount</option>
                                <option value="requested_by" selected>Requested By</option>
                                <option value="released_by">Released By</option>
                                <option value="transaction_date" selected>Transaction Date</option>
                              </select>
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-2 control-label">Transaction Dates</label>
                          <div class="col-sm-6">
                              <div class="input-daterange input-group" id="datepicker3">
                                  <input type="text" class="input-small form-control" name="start" id="start" />
                                  <span class="input-group-addon">to</span>
                                  <input type="text" class="input-small form-control" name="end" id="end" />
                              </div>
                          </div>
                      </div>
                      <?php if($w_ == 1) { ?>
                      <div class="panel-footer">
                          <div class="row">
                              <div class="col-lg-offset-2 col-lg-10">
                                  <div id="message"></div> 
                                  <div class="btn-toolbar pull-right" id = "actionButtons">
                                      <button class="btn-primary btn" type="button" onclick="pdf_()">Generate PDF Report</button>
                                      <button class="btn-success btn" type="button" onclick="excel_()">Generate Excel Report</button>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <?php }?>
                   </form>
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


function pdf_()
{
  var data = $('#spmsForm').serialize();
  window.open('<?php echo base_url("Report/office_expense_pdf")?>'+'?'+data);
}

function excel_()
{
  var data = $('#spmsForm').serialize();
  window.open('<?php echo base_url("Report/office_expense_excel")?>'+'?'+data);
}




$(document).ready(function(){
  $('#columns').select2();
  $('.populate').select2();
  $('#datepicker3').datepicker();
});

</script>