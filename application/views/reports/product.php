<div id="page-content">
  <div id='wrap'>
    <div id="page-heading">
      <ol class="breadcrumb">
        <li>Report</li>
          <li>Physical count of Supplies and Materials</li>
      </ol>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-inverse">
              <div class="panel-heading">
                  <h4>Report Filter/Parameters</h4>
                  <div class="options">
                    <a class="panel-collapse" href="#">
                      <i class="fa fa-chevron-up"></i></a>
                  </div>
              </div>
              <div class="panel-body" id="divstyle" style="display:block;">
                   <form action="" class="form-horizontal row-border"  method="POST" id="spmsForm">
                      
                      <div class="form-group">
                          <label class="col-sm-2 control-label">Select Columns</label>
                          <div class="col-sm-10">
                              <select multiple="multiple" id="columns" name="columns[]" style = "width:100%">
                                <option value="id" selected>Item ID</option>
                                <option value="category">Category</option>
                                <option value="description" selected>Description</option>
                                <option value="units" selected>Unit of Measurement</option>
                                <option value="critical_level" selected>Critical Level</option>
                                <option value="date_added">Date Added</option>
                                <option value="added_by">Added By</option>
                              </select>
                          </div>
                      </div>
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
                              <select multiple="multiple" name="category[]" id="multi-select" style="width:100%" required>
                              <?php 
                                foreach($category as $r)
                                {
                                  echo '<option value="'.$r['id'].'" selected>'.$r['desc'].'</option>';
                                }
                              ?>
                            </select>
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-sm-2 control-label">Select Status</label>
                          <div class="col-sm-2">
                              <select name="status" id="status" style = "width:100%" class="populate">
                                <option value="active" selected>Active</option>
                                <option value="inactive">Inactive</option>
                                <option value="all">All</option>
                              </select>
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
  window.open('<?php echo base_url("Report/product_pdf")?>'+'?'+data);
}

function excel_()
{
  var data = $('#spmsForm').serialize();
  window.open('<?php echo base_url("Report/product_excel")?>'+'?'+data);
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



$(document).ready(function(){
  $('#columns').select2();
  $('.populate').select2();
  rebuildSelect();
  $('#select-all1').click(function(){
    $('#multi-select').multiSelect('select_all');
  });

  $('#deselect-all1').click(function(){
    $('#multi-select').multiSelect('deselect_all');
  });
});

</script>