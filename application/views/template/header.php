<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Supply and Property Management System</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="PUPSRG" content="The SRG Team">

   <!-- <link href="<?php echo base_url('assets')?>/less/styles.less" rel="stylesheet/less" media="all">  -->
    <link href="<?php echo base_url('assets')?>/css/styles.min.css?=113"  rel="stylesheet" >
    <link href="<?php echo base_url('assets')?>/demo/variations/default.css" rel='stylesheet' type='text/css' media='all' id='styleswitcher'> 
    <link href="<?php echo base_url('assets')?>/demo/variations/default.css" rel='stylesheet' type='text/css' media='all' id='headerswitcher'> 
    <link href='<?php echo base_url('assets')?>/plugins/codeprettifier/prettify.css'  rel='stylesheet' type='text/css' /> 
    <link  href='<?php echo base_url('assets')?>/plugins/form-toggle/toggles.css' rel='stylesheet' type='text/css'/> 
    <link rel='stylesheet' type='text/css' href='<?php echo base_url('assets')?>/plugins/form-nestable/jquery.nestable.css' /> 
    <link  href='<?php echo base_url('assets')?>/plugins/form-select2/select2.css'  rel='stylesheet' type='text/css' /> 
    <link  href='<?php echo base_url('assets')?>/plugins/form-multiselect/css/multi-select.css'  rel='stylesheet' type='text/css' /> 
    <link  href='<?php echo base_url('assets')?>/plugins/jqueryui-timepicker/jquery.ui.timepicker.css'  rel='stylesheet' type='text/css' /> 
    <link  href='<?php echo base_url('assets')?>/plugins/form-daterangepicker/daterangepicker-bs3.css'  rel='stylesheet' type='text/css' /> 
    <link  rel='stylesheet' type='text/css' href='<?php echo base_url('assets')?>/plugins/pines-notify/jquery.pnotify.default.css' /> 
    <link  href='<?php echo base_url('assets')?>/plugins/form-tokenfield/bootstrap-tokenfield.css'  rel='stylesheet' type='text/css'  /> 
    <link  rel='stylesheet' type='text/css' href='<?php echo base_url('assets')?>/plugins/datatables/dataTables.css' /> 
    <link  href='<?php echo base_url('assets')?>/js/jqueryui.css'  rel='stylesheet' type='text/css' /> 
    <link  href='<?php echo base_url('assets')?>/plugins/codeprettifier/prettify.css'  rel='stylesheet' type='text/css' /> 
    <link  href='<?php echo base_url('assets')?>/plugins/form-toggle/toggles.css' rel='stylesheet' type='text/css'  /> 
    <link  href='<?php echo base_url('assets')?>/plugins/charts-morrisjs/morris.css' rel='stylesheet' type='text/css'  /> 
    <link rel="shortcut icon" type="image/ico" href='<?php echo base_url('assets')?>/img/favicon.ico' />

    <link  href='<?php echo base_url('assets')?>/css/all.min.css' rel='stylesheet' type='text/css'  /> 

    

    <link rel="stylesheet" href="<?php echo base_url('assets')?>/modern/css/global.css"><!-- These styles are irrelevant to the Multi-step Indicator and can be safely ignored. -->
    <link rel="stylesheet" href="<?php echo base_url('assets')?>/modern/css/modern.css">
    <link rel="stylesheet" href="<?php echo base_url('assets')?>/modern/css/color-2.css">
    <!-- <script type="text/javascript" src="<?php echo base_url('assets')?>/js/less.js"></script> -->

</head>
<style type="text/css">
    .hasChild .fa::before{
        color:#4f5259
    }
    .navbar-inverse {
        background-color: #333;
    }

    .navbar-name{
        padding: 10px 15px;
        font-size: 18px;
        line-height: 20px;
        height: 40px;
        vertical-align: middle;
    }
</style>

<body class="">

    <header class="navbar navbar-inverse navbar-fixed-top" role="banner">
        <!-- <div class="navbar-header pull-left">
            <img src="<?php echo base_url('assets')?>/img/puplogo.png" style="width:30px; margin:5px" alt="Dangerfield" />
            
        </div> -->
        <div class="navbar-header pull-left" style="padding-left:20px">
            <!-- <a class="navbar-brand" style="width:100%; padding-left:0px; padding-top:10px; color:white; font-family: 'Source Sans Pro','Segoe UI','Droid Sans',Tahoma,Arial,sans-serif;" href="#">Divine Word College of Calapan</a> -->
            <a class="navbar-brand" style="width:100%; padding-left:0px; padding-top:10px; color:white; font-family: 'Source Sans Pro','Segoe UI','Droid Sans',Tahoma,Arial,sans-serif;" href="#">Supply and Property Management System</a>
        </div>

        <ul class="nav navbar-nav pull-right toolbar">
            
            <li class="dropdown">
                <a href="#" class="dropdown-toggle username" data-toggle="dropdown"><span class="hidden-xs"><?php echo $this->session->userdata('NAME');?><i class="fa fa-caret-down"></i></span>
                <ul class="dropdown-menu userinfo arrow">
                    <li class="username">
                        <a href="#">
                            <div class="pull-left"><img class="userimg" src="<?php echo base_url('assets/uploads').'/'.$this->session->userdata('IMAGE_PATH');?>"/></div>
                            <div class="pull-right"><h5><?php echo strtoupper($this->session->userdata('USERNAME'));?></h5><small><span><?php echo $this->session->userdata('USERTYPE')?></span></small></div>
                        </a>
                    </li>
                     <li class="userlinks">
                        <ul class="dropdown-menu">
                            <li><a href="javascript:changePass();" >Change Password <i class="pull-right fa fa-pencil"></i></a></li>
                            <li class="divider"></li>
                            <li><a href="<?php echo base_url('access/logout');?>" class="text-right">Sign Out</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="dropdown" id="notifDiv">
                <a href="#" onclick="viewNotif()" class="hasnotifications dropdown-toggle" data-toggle='dropdown'><i class="fa fa-bell"></i><span class="badge" id="notifBadge"></span></a>
                <ul class="dropdown-menu messages arrow">
                    <li class="dd-header">
                        <span id="notifMessage"></span>
                    </li>
                    <div class="scrollthis" id="notifPanel">
                        <center><img src='<?php echo base_url('assets/img/loading.gif');?>'/></center>
                    </div>
                    <li class="dd-footer"><a href="<?php echo base_url('Process/notifications')?>">View All Notifications</a></li>
                </ul>
            </li>
        
        </ul>
    </header>

    <div id="page-container">
        <!-- BEGIN SIDEBAR -->

        <nav id="page-leftbar" role="navigation">
            
                <!-- BEGIN SIDEBAR MENU -->
           
            <ul class="acc-menu" id="sidebar">
                 <li id="search" style="text-align:center">
                    <img src="<?php echo base_url('assets')?>/img/puplogo.png" style="width:150px" alt="Dangerfield" />
                </li>
                <li class="divider"></li>
                <?php if(in_array('AD', $ac) || in_array('UD', $ac)){?>
                
                    <?php if(in_array('AD', $ac)){?>
                        <li <?php if($menu == "admin_dashboard") echo 'class = "active"'; ?>><a href="<?php echo base_url(); ?>Admin/admin_dashboard"><span>Admin Dashboard</span></a></li>
                    <?php }?>
                    <?php if(in_array('UD', $ac)){?>
                    <li <?php if($menu == "user_dashboard") echo 'class = "active"'; ?>><a href="<?php echo base_url(); ?>Admin/user_dashboard"><span>User Dashboard</span></a></li>
                    <?php }?>
                   
                 <?php }?>
                <?php if(in_array('UM', $ac) || in_array('PC', $ac) || in_array('BS', $ac) || in_array('DO', $ac) || in_array('A', $ac)){?>
                <li><a href="javascript:;">System Configuration</a>
                    <ul class="acc-menu">
                        <?php if(in_array('UM', $ac)){?>
                            <li <?php if($menu == "units_of_measurement") echo 'class = "active"'; ?>><a href="<?php echo base_url(); ?>Admin/units_of_measurement"><span>Units of Measurement</span></a></li>
                        <?php }?>
                        <?php if(in_array('PC', $ac)){?>
                        <li <?php if($menu == "product_category") echo 'class = "active"'; ?>><a href="<?php echo base_url(); ?>Admin/product_category"><span>Supply Category</span></a></li>
                        <?php }?>
                        <?php if(in_array('PROPC', $ac)){?>
                        <li <?php if($menu == "property_category") echo 'class = "active"'; ?>><a href="<?php echo base_url(); ?>Admin/property_category"><span>Property Category</span></a></li>
                        <?php }?>
                        <?php if(in_array('BS', $ac)){?>
                        <li <?php if($menu == "billing_shipping_details") echo 'class = "active"'; ?>><a href="<?php echo base_url(); ?>Admin/billing_shipping_details"><span>Billing/Shipping Info</span></a></li>
                        <?php }?>
                        <?php if(in_array('DO', $ac)){?>
                        <li <?php if($menu == "department_offices") echo 'class = "active"'; ?>><a href="<?php echo base_url(); ?>Admin/department_offices"><span>Department/Offices</span></a></li>
                        <?php }?>
                        <?php if(in_array('A', $ac)){?>
                        <li <?php if($menu == "approver") echo 'class = "active"'; ?>><a href="<?php echo base_url(); ?>Admin/approver"><span>Approver</span></a></li>
                        <?php }?>
                    </ul>
                 </li>
                 <?php }?>
                 <?php if(in_array('UR', $ac) || in_array('SU', $ac) || in_array('AC', $ac) || in_array('UOA', $ac)){?>
                 <li><a href="javascript:;">User Management</a>
                    <ul class="acc-menu">
                        <?php if(in_array('UR', $ac)){?>
                        <li <?php if($menu == "user_roles") echo 'class = "active"'; ?>><a href="<?php echo base_url(); ?>Admin/user_roles"><span>User Roles</span></a></li>
                        <?php }?>
                        <?php if(in_array('SU', $ac)){?>
                        <li <?php if($menu == "system_users") echo 'class = "active"'; ?>><a href="<?php echo base_url(); ?>Admin/system_users"><span>System Users</span></a></li>
                        <?php }?>
                        <?php if(in_array('UOA', $ac)){?>
                        <li <?php if($menu == "user_office_assignment") echo 'class = "active"'; ?>><a href="<?php echo base_url(); ?>Admin/user_office_assignment"><span>User - Office Assignment</span></a></li>
                        <?php }?>
                        <?php if(in_array('AC', $ac)){?>
                        <li <?php if($menu == "access_control") echo 'class = "active"'; ?>><a href="<?php echo base_url(); ?>Admin/access_control"><span>Access Control</span></a></li>
                        <?php }?>
                    </ul>
                 </li>
                 <?php }?>
                  <?php if(in_array('BA', $ac)){?>
                 <li><a href="<?php echo base_url('Admin/budget_allocation');?>"><span>Budget Allocation</span></a></li>
                 <?php }?>


                 <!--may 16,2017-->
                 <?php if(in_array('P', $ac)){?>
                 <li><a href="<?php echo base_url('Process/product');?>"><span>Supply</span></a></li>
                 <?php }?>

               
                 


                 <?php if(in_array('PROP', $ac)){?>
                 <li><a href="<?php echo base_url('Process/property');?>"><span>Property</span></a></li>
                 <?php }?>






                 <?php if(in_array('SV', $ac)){?>
                 <li><a href="<?php echo base_url('Process/supplier_vendor');?>"><span>Supplier</span></a></li>
                 <?php }?>
                 <?php if(in_array('I', $ac)){?>
                 <li><a href="<?php echo base_url('Process/inventory');?>"><span>Inventory</span></a></li>
                 <?php }?>
                 <?php if(in_array('SM', $ac)){?>
                 <!--<li><a href="<?php echo base_url('Process/stocks_manual');?>"><span>Add Stocks Manually</span></a></li>-->
                 <?php }?>
                 <?php if(in_array('IR', $ac)){?>
                 <li><a href="<?php echo base_url('Process/item_requests');?>"><span>Requisition Issue Slip</span></a></li>
                 <?php }?>
                 <?php if(in_array('PR', $ac)){?>
                 <li><a href="<?php echo base_url('Process/purchase_request');?>"><span>Purchase Requests</span></a></li>
                 <?php }?>
                 <?php if(in_array('AIR', $ac)){?>
                 <li><a href="<?php echo base_url('Process/approve_item_requests');?>"><span>Approve Item Requests</span></a></li>
                 <?php }?>
                  <?php if(in_array('APR', $ac)){?>
                 <li><a href="<?php echo base_url('Process/approve_purchase_requests');?>"><span>Approve Purchase Requests</span></a></li>
                 <?php }?>
                 <?php if(in_array('IRM', $ac)){?>
                 <li><a href="<?php echo base_url('Process/item_requests_monitoring');?>"><span>Item Request Monitoring</span></a></li>
                 <?php }?>
                 <?php if(in_array('PO', $ac)){?>
                 <li><a href="<?php echo base_url('Process/purchase_order');?>"><span>Purchase Order</span></a></li>
                 <?php }?>
                 <?php if(in_array('D', $ac)){?>
                 <li><a href="<?php echo base_url('Process/delivery');?>"><span>Delivery</span></a></li>
                 <?php }?>
                 <?php if(in_array('PM', $ac)){?>
                 <li><a href="<?php echo base_url('Process/property_management');?>"><span>Property Management</span></a></li>
                 <?php }?>
                 <?php if(in_array('RD', $ac)){?>
                 <li><a href="<?php echo base_url('Process/returns/defective');?>"><span>Returns/Defective Items</span></a></li>
                 <?php }?>
                 <?php if(in_array('MN', $ac) || in_array('AN', $ac)){?>
                 <li><a href="javascript:;">Notification</a>
                    <ul class="acc-menu">
                        <?php if(in_array('MN', $ac)){?>
                        <li <?php if($menu == "notifications") echo 'class = "active"'; ?>><a href="<?php echo base_url(); ?>Process/notifications"><span>My Notifications</span></a></li>
                        <?php }?>
                        <?php if(in_array('AN', $ac)){?>
                        <li <?php if($menu == "all_notifications") echo 'class = "active"'; ?>><a href="<?php echo base_url(); ?>Process/all_notifications"><span>All Notifications</span></a></li>
                        <?php }?>
                    </ul>
                 </li>
                 <?php }?>
                 
                 <?php if(in_array('RP', $ac) || in_array('RI', $ac)){?>
                 <li><a href="javascript:;">Reports</a>
                    <ul class="acc-menu">
                        <?php if(in_array('RP', $ac)){?>
                        <li <?php if($menu == "r_product") echo 'class = "active"'; ?>><a href="<?php echo base_url(); ?>Report/product"><span>Reports on the Physical count of Supplies and Materials</span></a></li>
                        <?php }?>
                        <?php if(in_array('RPROP', $ac)){?>
                        <li <?php if($menu == "r_property") echo 'class = "active"'; ?>><a href="<?php echo base_url(); ?>Report/property"><span>Rerport on the Physical count of Property, Plant and Equipment</span></a></li>
                        <?php }?>
                        <?php if(in_array('RI', $ac)){?>
                        <li <?php if($menu == "r_inventory") echo 'class = "active"'; ?>><a href="<?php echo base_url(); ?>Report/inventory"><span>Report on the Physical count of Inventories</span></a></li>
                        <?php }?>
                        <?php if(in_array('SL', $ac)){?>
                        <li <?php if($menu == "r_stock_ledger") echo 'class = "active"'; ?>><a href="<?php echo base_url(); ?>Report/stock_ledger"><span>Stock Ledger</span></a></li>
                        <?php }?>
                        <?php if(in_array('OBER', $ac)){?>
                        <li <?php if($menu == "r_office_expense") echo 'class = "active"'; ?>><a href="<?php echo base_url(); ?>Report/office_expense"><span>Office Expense</span></a></li>
                        <?php }?>

                         <?php if(in_array('OBER', $ac)){?>
                        <li <?php if($menu == "r_office_expense") echo 'class = "active"'; ?>><a href="<?php echo base_url(); ?>Report/office_expense"><span>Stock Card</span></a></li>
                        <?php }?>
                        <?php if(in_array('OBER', $ac)){?>
                        <li <?php if($menu == "r_office_expense") echo 'class = "active"'; ?>><a href="<?php echo base_url(); ?>Report/office_expense"><span>Property Card</span></a></li>
                        <?php }?>
                         <?php if(in_array('OBER', $ac)){?>
                        <li <?php if($menu == "r_office_expense") echo 'class = "active"'; ?>><a href="<?php echo base_url(); ?>Report/office_expense"><span> Card</span></a></li>
                        <?php }?>
                    </ul>
                 </li>
                 <?php }?>
                 <?php if(in_array('AT', $ac)){?>
                 <li><a href="<?php echo base_url('Admin/audit_trail');?>"><span>Audit Trail</span></a></li>
                 <?php }?>

        <!--New- Job Request-->
                 <?php if(in_array('JR', $ac)){?>
                 <li <?php if($menu == "job request") echo 'class = "active"'; ?>><a href="<?php echo base_url('Process/job_request');?>"><span>Job Request</span></a></li>
                 <?php }?>
                 <?php if(in_array('AJR', $ac)){?>
                 <li <?php if($menu == "approve job request") echo 'class = "active"'; ?>><a href="<?php echo base_url('Process/approve_job_request');?>"><span>Approve Job Request</span></a></li>
                 <?php }?>
                 <?php if(in_array('JO', $ac)){?>
                 <li  <?php if($menu == "job order") echo 'class = "active"'; ?>><a href="<?php echo base_url('Process/job_order');?>"><span>Job Order</span></a></li>
                 <?php }?>
       <!--New- Furniture/Equipment Request-->
                  <?php if(in_array('FER', $ac)){?>
                 <li  <?php if($menu == "furniture request") echo 'class = "active"'; ?>><a href="<?php echo base_url('Process/furniture_and_equipment_request');?>"><span>Furniture/Equipment Request</span></a></li>
                 <?php }?>
                  <?php if(in_array('AFER', $ac)){?>
                 <li  <?php if($menu == "approve furniture request") echo 'class = "active"'; ?>><a href="<?php echo base_url('Process/approve_furniture_and_equipment_request');?>"><span>Approve Furniture/Equipment Request</span></a></li>
                 <?php }?>
                  <?php if(in_array('FEO', $ac)){?>
                 <li  <?php if($menu == "furniture order") echo 'class = "active"'; ?>><a href="<?php echo base_url('Process/furniture_and_equipment_order');?>"><span>Furniture/Equipment Order</span></a></li>
                 <?php }?>
        <!--New Stock Card-->
                  <?php if(in_array('SC', $ac)){?>
                 <li  <?php if($menu == "stock card") echo 'class = "active"'; ?>><a href="<?php echo base_url('Process/stock_card');?>"><span>Stock Card</span></a></li>
                 <?php }?>






            </ul>
            <!-- END SIDEBAR MENU -->
        </nav>

    <div class="modal fade modals" id="changePass_" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="width:35%">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title"><label id="cpmodaltitle"><b>Change Password</b></label></h4>
            </div>
            <form action="" class="form-horizontal" id="spmsChangePass"  enctype="multipart/form-data">
              <div class="modal-body">
                <div class="form-group">
                  <label class="col-sm-4 control-label"><b>Username</b></label>
                  <label class="col-sm-8 control-label" style="text-align:left"><?php echo $this->session->userdata('USERNAME');?></label>
                </div>
                <div class="form-group">
                  <label class="col-sm-4 control-label"><b>New Password</b></label>
                  <div class="col-sm-8">
                     <input type="password" class="form-control" name="pass_" id="pass_" placeholder="" required>
                  </div>
                </div>
                 <div class="form-group">
                  <label class="col-sm-4 control-label"><b>Confirm Password</b></label>
                  <div class="col-sm-8">
                     <input type="password" class="form-control" name="confirm_pass_" id="confirm_pass_" placeholder="" required>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <div id="cpmessage"></div> 
                <div class="btn-toolbar" id = "cpactionButtons">
                    <button class="btn-primary btn" type="submit" name="save" id="save">Save Password</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>
            </form>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

<script type="text/javascript">
   
    function viewNotif()
    {
        if($('#notifDiv').attr('class') == 'dropdown')
        {
            $.ajax
            ({ type:"POST",
               async: true,
               url:"<?php echo base_url('Process/showNotif')?>",
               data:{saveNotif:'true'},
               dataType: 'json',
               cache: false
            });
            $('#notifMessage').empty("");
            $('#notifBadge').empty("");
            $('#notifMessage').append("You have 0 new notification/s");
            $('#notifBadge').append("0");
        }
    }
    function showNotif()
    {
       
            $.ajax
            ({ type:"POST",
               async: true,
               url:"<?php echo base_url('Process/showNotif')?>",
               data:{getNotif:'true'},
               dataType: 'json',
               cache: false,
               success: function(data)
                 {
                    if(data[0] == 1)
                    {
                        if($('#notifDiv').attr('class') == 'dropdown')
                        {
                            var text = "";
                            $('#notifBadge').empty();
                            $('#notifPanel').empty();
                            $('#notifMessage').empty();
                            $('#notifBadge').append(data[1]);
                            for(var i = 0; i<data[2].length; i++)
                            {
                                var color ="";
                                (data[2][i][4] == 'active')?color = "background-color:hsla(133,53%,79%,0.42)":null;
                                text += ' <li style="'+color+'"><a href="'+data[2][i][5]+'" class="'+data[2][i][4]+'">'+
                                            '<span class="time">'+data[2][i][0]+'</span>'+
                                            '<img src="'+data[2][i][1]+'" alt="avatar" />'+
                                            '<div><span class="name">'+data[2][i][2]+'</span></div><div><span class="msg">'+data[2][i][3]+'</span></div>'+
                                        '</a></li>';
                            }
                            $('#notifPanel').append(text);
                            $('#notifMessage').append("You have "+data[1]+" new notification/s");
                        }
                        setTimeout("showNotif()", 5000)
                    }
                    else if(data[0] == 2)
                    {
                        window.location.replace("<?php echo base_url(); ?>");
                    }
                    else
                    {
                        $('#notifPanel').empty();
                        $('#notifPanel').append("Notifications cannot be loaded.");
                        alerts('Notifications cannot be loaded.','e');
                    }

                 },
                 error: function(data)
                 {
                    alerts('An error occured. Please reload the page and try again.','e');
                 }
            });
    }


    
</script>