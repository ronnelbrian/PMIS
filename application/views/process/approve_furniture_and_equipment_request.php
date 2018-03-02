
<div id="page-content">
  <div id='wrap'>
    <div id="page-heading">
      <ol class="breadcrumb">
        <li>Administrator</li>
          <li>Approve Furniture/Equipment Request</li>
      </ol>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-12">

          <div class="panel panel-inverse">
              <div class="panel-heading">
                  <h4>Approve Furniture/Equipment Request</h4>
                  <div class="options">
                    <a class="panel-collapse" href="#">
                    <i class="fa fa-chevron-up"></i></a>
                  </div>
              </div>
              <div class="panel-body collapse in">
                  <!-- <h4>Stock Legend:</h4>
                  <table style="padding:0px" cellspacing="0" cellpadding="0">
                    <tr>
                      <td><span><i class='fa fa-square' style="color:#df1b1b"></i></span></td>
                      <td style="padding-left:5px"><h5>Critical Stock Level</h5></td>
                    
                      <td style="padding-left:70px"><span><i class='fa fa-square' style="color:#2d78d5"></i></span></td>
                      <td style="padding-left:5px"><h5>Normal Stock Level</h5></td>
                    </tr>
                  </table> -->
                  
                  <table cellpadding="0" cellspacing="0" border="0" width="100%" id="spmsTable" class="table table-striped table-bordered datatables">
                      <thead>
                          <tr>
                              <th style="width : 10%">FER No.</th>
                              <th style="width : 10%">Responsibility Center</th>
                              <th style="width : 10%">Item Description</th>
                              <th style="width : 5%">Unit</th>
                              <th style="width : 5%">Qty</th>
                              <th style="width : 5%">Unit Cost</th>
                              <th style="width : 20%">Purpose</th>
                              <th style="width : 10%">Date Requested</th>
                              <th style="width : 20%">Status</th>
                              <th style="width : 5%; text-align:center">Action</th>
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

<div class="modal fade modals" id="wfmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:80%">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h3 class="modal-title"><label id="modaltitle"></label></h3>
        </div>
        <form action="" class="form-horizontal" id="apform"  enctype="multipart/form-data">
          
          <table style="padding:0px; margin-left:22px" cellspacing="0" cellpadding="0">
            <tr>
              <td style="padding-right:10px"><h4>Workflow Legend:</h4></td>
              <td><span><i class='fa fa-square' style="color:#E3E0CC"></i></span></td>
              <td style="padding-left:5px"><h5>Current Process</h5></td>
            
              <td style="padding-left:10px"><span><i class='fa fa-square' style="color:#E2E2E2"></i></span></td>
              <td style="padding-left:5px"><h5>Next Process</h5></td>
            </tr>
          </table>
          <div class="modal-body" id="wf">
          </div>
          <div class="modal-footer">
            <div id="message3"></div> 
            <div class="btn-toolbar" id = "actionButtons2">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
        </form>
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
      "sAjaxSource": "<?php echo base_url('Process/approve_furniture_and_equipment_request')?>"+"?loadtable=true",
      "deferLoading": 10,
      "bPaginate": true,
      "aaSorting": [[8,'desc'], [0,'desc']],
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

<?php if($w_ == 1) { ?>

function approve_(id, name){

  var result = confirm("Do you want to proceed approving the request for "+name+"?");
  if (result) {
       $.ajax
        ({ type:"POST",
           async: true,
           url:"<?php echo base_url('Process/approve_furniture_and_equipment_request')?>",
           data:{id:id, act:"approve"},
           dataType: 'json',
           cache: false,
           success: function(data)
            {
              if (data['mes'] == "Success")
              {
                if (data['message'] == "")
                  alerts('Item Request has been approved.','s');
                else
                  alerts(data['message'],'s');
                loadtable();
              }
              else
                alerts(data['mes'],'w');
             },
             error: function(data)
             {
                alerts('An error occured. Please reload the page and try again.','e');
             }

    });
 } 
}


function disapprove_(id, name){

  var result = confirm("Do you want to proceed disapproving the request for "+name+"?");
  if (result) {
      var remarks = prompt('Enter Remarks: ');
       $.ajax
        ({ type:"POST",
           async: true,
           url:"<?php echo base_url('Process/approve_furniture_and_equipment_request')?>",
           data:{id:id, act:"disapprove", remarks:remarks},
           dataType: 'json',
           cache: false,
           success: function(data)
            {
              if (data['mes'] == "Success")
              {
                alerts('Item Request has been disapproved.','s');
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


<?php }?>

function wf_(id, name)
{
   $.ajax
    ({ type:"POST",
       async: true,
       url:"<?php echo base_url('Process/approve_furniture_and_equipment_request')?>",
       data:{id:id, wf:"wf"},
       dataType: 'json',
       cache: false,
       success: function(data)
        {
          $('#modaltitle').empty();
          $('#wf').empty();
          if(data['mes'] == "Success")
          {
            var check = 0;
            var content  = "";
            $('#modaltitle').append("Workflow for Requested Item ["+name+"]");
            for(var i = 0; i < data['data'].length; i++)
            {
              var stat = "";
              (data['data'][i][2] == 2)?stat = "current" : stat = "wrap";
              if(data['data'][i][2] == 2)
              {
                check = 1;
                (data['data'].length - 1 == i)?
                content+='<li class="'+stat+'"><div class="wrap"><p class="title">'+data['data'][i][1]+'`s Approval</p><p class="subtitle">Approval and Releasing process of '+data['data'][i][1]+'.</p></div></li>':
                content+='<li class="'+stat+'"><div class="wrap"><p class="title">'+data['data'][i][1]+'`s Approval</p><p class="subtitle">Approval and Review process of '+data['data'][i][1]+'.</p></div></li>';;
              }
              else if(data['data'][i][2] == 1)
              {
                (data['data'].length - 1 == i)?
                content+='<li class="'+stat+'"><div class="wrap"><p class="title">'+data['data'][i][1]+'`s Approval</p><p class="subtitle">Approved and Released by '+data['data'][i][1]+'.</p></div></li>':
                content+='<li class="'+stat+'"><div class="wrap"><p class="title">'+data['data'][i][1]+'`s Approval</p><p class="subtitle">Reviewed and Approved by '+data['data'][i][1]+'.</p></div></li>';;
              }
              else
              {
                check = 1;
                content+='<li class="'+stat+'"><div class="wrap"><p class="title">'+data['data'][i][1]+'`s Approval</p><p class="subtitle">Request was rejected by '+data['data'][i][1]+'. This request can no longer proceed to the next approver.</p></div></li>';
              }
            }
            if(check == 0)
                content+='<li class="current"><div class="wrap"><p class="title">Item Released</p><p class="subtitle">The Purchase request has been approved and released.</p></div></li>';
            $('#wf').append('<div class="multi-step"><ol>'+content+'</ol></div>');
            $('#wfmodal').modal("show");
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

$(document).ready(function(){
  loadtable();
  $('.populate').select2();

});

</script>