//  function isNumberKey(evt){
//             var charCode = (evt.which) ? evt.which : event.keyCode
//             if (charCode > 31 && (charCode < 48 || charCode > 57))
//                 return false;
//             return true;
//  }


//   $(document).ready(function() {

//   	$('#sytable').dataTable( {
//   	 	"sDom": "<'row'<'col-xs-6'l><'col-xs-6'f>r>t<'row'<'col-xs-6'i><'col-xs-6'p>>",
//         "sPaginationType": "bootstrap",
//         "oLanguage": {
//             "sLengthMenu": "_MENU_ records per page",
//             "sSearch": ""
//         },
//         "processing": true,
//         "serverSide": true,
//         "sAjaxSource": '../mams/loadsy',
//         "deferLoading": 10
   
//     });

    

//   	 $('#mytable').dataTable( {
//   	 	"sDom": "<'row'<'col-xs-6'l><'col-xs-6'f>r>t<'row'<'col-xs-6'i><'col-xs-6'p>>",
//         "sPaginationType": "bootstrap",
//         "oLanguage": {
//             "sLengthMenu": "_MENU_ records per page",
//             "sSearch": ""
//         }
   
//     });


//     $('.dataTables_filter input').addClass('form-control').attr('placeholder','Search...');
//     $('.dataTables_length select').addClass('form-control');


//     // multi select   




// //     $('#mytable').DataTable({
    
// // 		    "bServerSide": true,
// // 		    "sAjaxSource": "../mams/loadsy",
// // 		    "bProcessing": true,
// // 		    "bDestroy": true
// // });

//   // var oTable = $('#mytable').dataTable({
//   //           "bProcessing": true,
//   //           "bServerSide": true,
//   //           "sAjaxSource": '../mams/loadsy',
//   //           "bJQueryUI": true,
     
//   //           "fnInitComplete": function () {
//   //               oTable.fnAdjustColumnSizing();
//   //           },
//   //           'fnServerData': function (sSource, aoData, fnCallback) {
//   //               $.ajax
//   //               ({
//   //                   'dataType': 'json',
//   //                   'type': 'POST',
//   //                   'url': sSource,
//   //                   'data': aoData,
//   //                   'success': fnCallback
//   //               });
//   //           }
//   //       });

// });