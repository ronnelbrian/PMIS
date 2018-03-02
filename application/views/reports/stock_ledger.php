<div id="page-content">
  <div id='wrap'>
    <div id="page-heading">
      <ol class="breadcrumb">
        <li>Report</li>
          <li>Stock Ledger</li>
      </ol>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-inverse">
              <div class="panel-heading">
                  <h4>Stock Ledger Report Filter/Parameters</h4>
                  <div class="options">
                    <a class="panel-collapse" href="#">
                      <i class="fa fa-chevron-up"></i></a>
                  </div>
              </div>
              <div class="panel-body" id="divstyle" style="display:block;">
                   <form action="" class="form-horizontal row-border"  method="POST" id="spmsForm">
                      <div class="form-group">
                          <div class="col-sm-2"></div>
                          <div class="col-sm-10">
                            <table>
                              <tr>
                                <td style="padding-left:0px"><button type='button' class='btn-sm btn-success' id='select-all1'><span>Select All</span></button></br></br> </td>
                                <td style="padding-left:0px"><button type='button' class='btn-sm btn-success' id='deselect-all1'> <span>Deselect All</span></button></br></br></td>
                              </tr>
                            </table>
                          </div>
                          <label class="col-sm-2 control-label">Select Category</label>
                          <div class="col-sm-10">
                              <select multiple="multiple" name="category[]" id="multi-select" style="width:100%" required onchange="loadProducts()">
                              <?php 
                                foreach($category as $r)
                                {
                                  echo '<option value="'.$r['id'].'">'.$r['desc'].'</option>';
                                }
                              ?>
                            </select>
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-2 control-label">Select Item</label>
                          <div class="col-sm-10">
                              <select id="product" name="product" style = "width:100%" class="populate" required>
                                <option value="">Please Select</option>
                                <?php 
                                foreach($p as $r)
                                {
                                  echo '<option value="'.$r[7].'">'.$r[1].'</option>';
                                }
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
                                <option value="product">Item</option>
                                <option value="qty" selected>Qty</option>
                                <option value="delivered" selected>Delivered/Added</option>
                                <option value="released" selected>Released</option>
                              </select>
                          </div>
                      </div>
                      
                      <div class="form-group">
                          <label class="col-sm-2 control-label">Select Legder Status</label>
                          <div class="col-sm-2">
                              <select name="status" id="status" style = "width:100%" class="populate">
                                <option value="all" selected>All (Delivered & Released)</option>
                                <option value="in">Delivered/Added</option>
                                <option value="out">Released</option>
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
  ($('#product').val() != "")?
  window.open('<?php echo base_url("Report/stock_ledger_pdf")?>'+'?'+data):alert('Please select an Item from the Report Filter.');
}

function excel_()
{
  var data = $('#spmsForm').serialize();
  ($('#product').val() != "")?
  window.open('<?php echo base_url("Report/stock_ledger_excel")?>'+'?'+data):alert('Please select an Item from the Report Filter.');
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

function loadProducts(){
  $('#spmsForm').serialize();
  $('#product').empty();
  $('#product').append('<option value="">Please Select</option>');
  $.ajax
    ({ type:"GET",
       async: true,
       url:"<?php echo base_url('Report/stock_ledger')?>"+"?loadProduct=true&"+$('#spmsForm').serialize(),
       data:{},
       dataType: 'json',
       cache: false,
       success: function(data)
         {
            for(var i = 0; i<data.length; i++)
              $('#product').append('<option value="'+data[i][0]+'">'+data[i][1]+'</option>');
            $('#product').val("");
            $('#product').select2({setVal:""});
         },
         error: function(data)
         {
            alerts('An error occured. Please reload the page and try again.','e');
         }
    });
}



$(document).ready(function(){
  $('#columns').select2();
  $('.populate').select2();
  $('#datepicker3').datepicker();
  rebuildSelect();
  $('#select-all1').click(function(){
    $('#multi-select').multiSelect('select_all');
  });

  $('#deselect-all1').click(function(){
    $('#multi-select').multiSelect('deselect_all');
  });
});

</script>