    <footer role="contentinfo">
        <div class="clearfix">
            <ul class="list-unstyled list-inline">
                <li>Copyright &copy; 2016 <b>MTRCB</b>. All Rights Reserved.</li>
                <button class="pull-right btn btn-inverse-alt btn-xs hidden-print" id="back-to-top"><i class="fa fa-arrow-up"></i></button>
            </ul>
        </div>
    </footer>
</div> <!-- page-container -->



<script type='text/javascript' src='<?php echo base_url('assets')?>/js/bootstrap.min.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/js/enquire.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/js/jquery.cookie.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/js/jquery.nicescroll.min.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/codeprettifier/prettify.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/form-toggle/toggle.min.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/js/placeholdr.js'></script>
<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/pines-notify/jquery.pnotify.min.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/form-tokenfield/bootstrap-tokenfield.min.js'></script> 
<script type="text/javascript" src="<?php echo base_url('assets');?>/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets');?>/js/charts.js"></script>
<script type='text/javascript' src='<?php echo base_url('assets')?>/js/application.js'></script>
<script src="<?php echo base_url('assets');?>/js/validation-init.js"></script>

<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/form-daterangepicker/daterangepicker.min.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/form-datepicker/js/bootstrap-datepicker.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/form-daterangepicker/moment.min.js'></script> 

<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/datatables/jquery.dataTables.min.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/datatables/dataTables.bootstrap.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/form-jasnyupload/fileinput.min.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/form-datepicker/js/bootstrap-datepicker.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/plugins/form-datetimepicker/bootstrap-datetimepicker.js'></script> 
<script type='text/javascript' src='<?php echo base_url('assets')?>/js/shieldui-all.min.js'></script> 

<input type="hidden" id="SecondsUntilExpire" name="SecondsUntilExpire">

<script type="text/javascript">
function changePass()
{
    $('#changePass_').modal('show');
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
$(document).ready(function(){
    $('.dropdown-toggle').removeClass();

    $("#spmsChangePass").on('submit',(function(e) {
            e.preventDefault();
            $('#cpactionButtons').hide();
            $('#cpmessage').append("<div id='cpmessage2'></div>");
            $('#cpmessage2').append("<img src='<?php echo base_url('assets/img/loading.gif');?>'/>");
            $('#cpmessage2').append("    Processing...");
            $.ajax({
              url: '<?php echo base_url("access/changepass"); ?>', 
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
                  alerts('Password has been updated.','s');
                  $('#changePass_').modal('hide');
                  window.location.reload();
                }
                else
                  alerts(data['mes'],'s');
                $('#cpmessage').empty();
                $('#cpactionButtons').show();
              },
              error: function(data)
              {
                $('#cpmessage').empty();
                $('#cpactionButtons').show();
                alerts('An error occured. Please reload the page and try again.','e');
              }

            });
        
    }));
  showNotif();
  
    
});

</script>
</body>
</html>