<?php
include('includes/session.php');		// Check session
//session_start();
if($_SESSION["archive_enabled"]=='Y'){
    include("database.class.reports.php");  // DB Connection class
    $database	= new Database();
}
else if($_SESSION["archive_enabled"]=='N'){
    include("database.class.php");  // DB Connection class
    $database	= new Database();
}
//include('includes/master_settings.php');
$_SESSION['pagid']=7;




?>
<!DOCTYPE HTML>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="shortcut icon" href="img/favicon.ico">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Report</title>
<link rel="stylesheet" href="css/bootstrap-multiselect.css" type="text/css">
<link href="css/menu_master_style.css" rel="stylesheet">
<link id="bs-css" href="css/bootstrap-cerulean.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/font-awesome.min.css">
<link href="css/app.css" rel="stylesheet" type="text/css">
<link href="bower_components/chosen/chosen.min.css" rel='stylesheet'>

<link rel="stylesheet" type="text/css" href="mn/css/normalize.css" />
<link rel="stylesheet" type="text/css" href="mn/css/demo.css" />
<link rel="stylesheet" type="text/css" href="mn/css/icons.css" />
<link rel="stylesheet" type="text/css" href="mn/css/component.css" />
<link rel="stylesheet" href="css/tabs_mn_master.css">
<link rel="stylesheet" type="text/css" href="css/turbotabs.css" />
<link rel="stylesheet" type="text/css" href="css/animate.min.css" />
<link rel="stylesheet" type="text/css" href="css/report_styl.css" />

<style>.left_list_cc{height: 71vh;min-height: 498px !important}</style>
<script src="js/jquery-1.10.2.min.js"></script>
<script src="mn/js/modernizr.custom.js"></script>
<script src="js/jquery.nicescroll.min.js"></script>
<style>
.report_check_box_cc .btn-group{    background-color: #ececec;
    color: #000;
    padding: 6px;
    width: 100%;
    border-radius: 5px;
    border: solid 1px #ccc;}
.multiselect {box-shadow: none !important;padding-left: 0 !important}
.multiselect-selected-text{   color: #383838;font-size: 14px;}
.dropdown-toggle .caret{ border-top-color: #383838 !important}
 .reporte_min_hieght_1{overflow: visible !important}
 .user_detail_min_hieght{overflow: visible !important}
    .reporte_min_hieght_1  tbody { display: block;min-height: 360px;overflow-y: scroll;height: 57vh}
    .reporte_min_hieght_1 thead,  tfoot,
tbody tr {  display: table; width: 99%; table-layout: fixed;}
.reporte_min_hieght  tbody { display: block;min-height: 360px;overflow-y: scroll;height: 57vh}
    .reporte_min_hieght thead, tfoot,
tbody tr {  display: table; width: 99%; table-layout: fixed; }
    .ui-datepicker-calendar thead,  tfoot, tbody tr{display: table;width: 100%; }
.newconsl_table th, td{white-space: inherit !important}



 /*pagination */
 .pagination>li>a, .pagination>li>span{
color: #000;/* box-shadow: 0px 0px 5px #ccc; */background-color:/* #FFEFDD*/rgba(245, 178, 27, 0.20);border: 1px solid #C1C1C1;font-weight: bold;}
.pagination>li>a:hover,.pagination>li>span:hover,.pagination>li>a:focus,.pagination>li>span:focus,.pagination>li>.active{background-color:bisque}

.pagination{margin:0;margin:5px 5px 5px 0;float:right}
.pagination > li > a, .pagination > li > span {padding: 6px 16px;color: #000000;background-color: rgba(222, 184, 135, 0.42);border: 1px solid rgba(175, 137, 88, 0.69)}
.pagination>.active>a, .pagination>.active>span, .pagination>.active>a:hover, .pagination>.active>span:hover, .pagination>.active>a:focus, .pagination>.active>span:focus{background-color:#A0522D;border-color: #A0522D;color:#fff;}
.pagination> li > a:hover{background-color:#A0522D;border-color: #A0522D;color:#fff;}

</style>
<script>
    
    
 
    
  $(document).ready(function() { 
      
      
      ///cloud check////
   
   var cloud_api_on=$('#cloud_api_on').val();
  
   
    if(cloud_api_on=='Y'){ 
   
       setTimeout(function(){  
        
         $.post("test2.php", {set:'test_api_service_fast'},function(data){ });
      
       }, 1000);   
      
    }
      
     ////////end//////////
      
      
      
  
	 var nice = $("html").niceScroll();  // The document page (body)
	 $("#div1").html($("#div1").html()+' '+nice.version);
         $("#boxscroll").niceScroll({touchbehavior:true}); // First scrollable DIV
	 $("#boxscrol2").niceScroll({touchbehavior:true});
	 $("#left_list_scr").niceScroll({touchbehavior:true});
	 $(".user_detail_min_hieght").niceScroll({touchbehavior:true});
	 $(".report_main_cc").niceScroll({touchbehavior:true});
    // Customizable cursor
    $("#boxscroll2").niceScroll("#contentscroll2",{cursorcolor:"#F00",cursoropacitymax:0.7,boxzoom:true,touchbehavior:true});  // Second scrollable DIV
    $("#boxframe").niceScroll("#boxscroll3",{cursorcolor:"#0F0",cursoropacitymax:0.7,boxzoom:true,touchbehavior:true});  // This is an IFrame (iPad compatible)
    $("#boxscroll4").niceScroll("#boxscroll4 .wrapper",{boxzoom:true});  // hw acceleration enabled when using wrapper
    
$(document).ready(function () {       
        //grab all header rows
        $('th').each(function (column) {
            $(this).addClass('sortable').click(function () {		
                    var findSortKey = function ($cell) {
                        return $cell.find('.sort-key').text().toUpperCase()+ ' ' + $cell.text().toUpperCase();
                    };
                    var sortDirection = $(this).is('.sorted-asc') ? -1 : 1;
                    var $rows = $(this).parent().parent().parent().find('tbody tr').get();
                    var bob = 0;
                    //loop through all the rows and find
                    $.each($rows, function (index, row) {
                        row.sortKey = findSortKey($(row).children('td').eq(column));
                    });
                    //compare and sort the rows alphabetically or numerically
                    $rows.sort(function (a, b) {                       
                        if (a.sortKey.indexOf('-') == -1 && (!isNaN(a.sortKey) && !isNaN(a.sortKey))) {
                             //Rough Numeracy check                                                          
                                if (parseInt(a.sortKey) < parseInt(b.sortKey)) {
                                    return -sortDirection;
                                }
                                if (parseInt(a.sortKey) > parseInt(b.sortKey)) {                                
                                    return sortDirection;
                                }
                        } else {
                            if (a.sortKey < b.sortKey) {
                                return -sortDirection;
                            }
                            if (a.sortKey > b.sortKey) {
                                return sortDirection;
                            }
                        }
                        return 0;
                    });
                    //add the rows in the correct order to the bottom of the table
                    $.each($rows, function (index, row) {
                        $('tbody').append(row);
                        row.sortKey = null;
                    });
                    //identify the collumn sort order
                    $('th').removeClass('sorted-asc sorted-desc');
                    var $sortHead = $('th').filter(':nth-child(' + (column + 1) + ')');
                    sortDirection == 1 ? $sortHead.addClass('sorted-asc') : $sortHead.addClass('sorted-desc');
                    //identify the collum to be sorted by
                    $('td').removeClass('sorted').filter(':nth-child(' + (column + 1) + ')').addClass('sorted');
                });
            });
        });
  });
</script>
<script src="js/turbotabs.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('#myTab').turbotabs({
        animation : 'ScrollUp',
        mode : 'vertical'
    }); 
}); 
</script>
<style>
    .newconsl_table th, td {
      white-space: nowrap;  
    }  
    .user_detail_min_hieght{overflow: auto}
</style>
<script type="text/javascript">
function print_page()
{
 document.getElementById("printbutton").style.display = "none";	
 window.print();
}
</script>
 <link rel="stylesheet" href="css/jquery-ui.css">
 <script src="js/jquery-1.10.2.js"></script>
  <script src="js/jquery-ui.js"></script>
  <link rel="stylesheet" href="css/style_date.css">
 <script>
 $(document).ready(function() {
  $("#datepickerfrom").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	 $("#datepickertodt").datepicker({
      changeMonth: true,
     changeYear: true,
	  maxDate: "+0D "
    }); 
     $("#date").datepicker({
      changeMonth: true,
     changeYear: true,
	  maxDate: "+0D "
    }); 
    
   $('#day').click(function(){
       $("#dayselector").slideToggle();
   });
   
$('#cashierdiv').change(function () { 
         
		$('#ui-datepicker-div').css("display", "none");
		var staff=$('#cashier').val();

        if(staff!="")
        {
            $('.confrmation_overlay_proce').css('display','block');
            $('.confrmation_overlay_proce').html('<img src="img/ajax-loaders/fetch.gif" />');
        }
                var fromval=$('#datepickerfrom').val();              
		var tot_to=$('#datepickertodt').val();              
                var typeval=$('#typeval').val();
                var department=$('#mode').val();
                var bydate=$('#bydate').val();
                      var voucher=$('#voucher').val();              
						$.post("load_consolidatedreport.php", {fromdt:fromval,todt:tot_to,type:typeval,bydate:bydate,voucher:voucher,staff:staff,department:department},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
                              $('.confrmation_overlay_proce').css('display','none'); 
						});
	});
        
        $('#card_name').change(function () {
   
   
   
		$('#ui-datepicker-div').css("display", "none");
		var department=$('#mode').val();
                var typeval=$('#typeval').val();
               var payment=$('#paytype').val();
                var staff=$('#cashier').val();
                var bydate=$('#bydate').val();
                var fromval=$('#datepickerfrom').val();
                var tot_to=$('#datepickertodt').val();
                var voucher=$('#voucher').val();
                var shiftlogin=$('#shiftlogin').val();
                var fromtime=$('#display_timefrom').html();
                var totime=$('#display_timeto').html();
                var day=$('#day').val();
                  var tax = $('#taxtype').val();
             var bank_name=$('#bank_name').val();
             
             
               var card_name=$('#card_name').val();
             
               if(typeval=="mult_card_bank_report")
            {   
                 $('#card_div').css("display", "block");
                 
            }else{
                
                 $('#card_div').css("display", "none");
                
            }
		
						$.post("load_consolidatedreport.php", {fromdt:fromval,todt:tot_to,type:typeval,bydate:bydate,voucher:voucher,staff:staff,department:department,fromtime:fromtime,totime:totime,day:day,tax:tax,shiftlogin:shiftlogin,payment:payment,bank_name:bank_name,card_name:card_name},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
	});
        
        
        
   $('#bank_name').change(function () {
   
   
   
		$('#ui-datepicker-div').css("display", "none");
		var department=$('#mode').val();
                var typeval=$('#typeval').val();
               var payment=$('#paytype').val();
                var staff=$('#cashier').val();
                var bydate=$('#bydate').val();
                var fromval=$('#datepickerfrom').val();
                var tot_to=$('#datepickertodt').val();
                var voucher=$('#voucher').val();
                var shiftlogin=$('#shiftlogin').val();
                var fromtime=$('#display_timefrom').html();
                var totime=$('#display_timeto').html();
                var day=$('#day').val();
                  var tax = $('#taxtype').val();
             var bank_name=$('#bank_name').val();
             
              var card_name=$('#card_name').val();
             
             
            if(typeval=="mult_card_bank_report")
            {   
                 $('#card_div').css("display", "block");
                 
            }else{
                
                 $('#card_div').css("display", "none");
                
            }
		
						$.post("load_consolidatedreport.php", {fromdt:fromval,todt:tot_to,type:typeval,bydate:bydate,voucher:voucher,staff:staff,department:department,fromtime:fromtime,totime:totime,day:day,tax:tax,shiftlogin:shiftlogin,payment:payment,bank_name:bank_name,card_name:card_name},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
	});
        
        
    $('#to_acc').change(function () { 
        
		$('#ui-datepicker-div').css("display", "none");
		var department=$('#mode').val();
                var typeval=$('#typeval').val();
               var payment=$('#paytype').val();
                var staff=$('#cashier').val();
                var bydate=$('#bydate').val();
                var fromval=$('#datepickerfrom').val();
                var tot_to=$('#datepickertodt').val();
                var voucher=$('#voucher').val();
                var shiftlogin=$('#shiftlogin').val();
                var fromtime=$('#display_timefrom').html();
                var totime=$('#display_timeto').html();
                var day=$('#day').val();
                  var tax = $('#taxtype').val();
             var bank_name=$('#bank_name').val();
             if(payment=='2'){
                   $('#bank_div').css("display", "block"); 
             }else{
                   $('#bank_div').css("display", "none"); 
             }
            var acc_type=  $('#exp_type_acc').val();  
            var pur_acc_type=  $('#pur_type_acc').val();  
             var from_all=$('#from_acc').val();
             var ledger=from_all.split('*');
            var from_ledger=ledger[0];
            var  from_vendor=ledger[1];        
            var from_staff=ledger[2];    
              var to_all=$('#to_acc').val();            
             var ledger1=to_all.split('*');          
             var to_ledger=ledger1[0];            
            var  to_vendor=ledger1[1];                    
            var to_staff=ledger1[2];    
						$.post("load_consolidatedreport.php", {fromdt:fromval,todt:tot_to,type:typeval,bydate:bydate,voucher:voucher,staff:staff,department:department,fromtime:fromtime,totime:totime,day:day,tax:tax,shiftlogin:shiftlogin,payment:payment,bank_name:bank_name,from_ledger:from_ledger,from_vendor:from_vendor,from_staff:from_staff,to_ledger:to_ledger,to_vendor:to_vendor,to_staff:to_staff,acc_type:acc_type,pur_acc_type:pur_acc_type},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});	
	});  
        
  $('#from_acc').change(function () { 
		$('#ui-datepicker-div').css("display", "none");
		var department=$('#mode').val();
                var typeval=$('#typeval').val();
               var payment=$('#paytype').val();
                var staff=$('#cashier').val();
                var bydate=$('#bydate').val();
                var fromval=$('#datepickerfrom').val();
                var tot_to=$('#datepickertodt').val();
                var voucher=$('#voucher').val();
                var shiftlogin=$('#shiftlogin').val();
                var fromtime=$('#display_timefrom').html();
                var totime=$('#display_timeto').html();
                var day=$('#day').val();
                  var tax = $('#taxtype').val();
             var bank_name=$('#bank_name').val();
             if(payment=='2'){
                   $('#bank_div').css("display", "block"); 
             }else{
                   $('#bank_div').css("display", "none"); 
             }
              var acc_type=  $('#exp_type_acc').val();    
              var pur_acc_type=  $('#pur_type_acc').val();               
             var from_all=$('#from_acc').val();             
             var ledger=from_all.split('*');            
            var from_ledger=ledger[0];             
            var  from_vendor=ledger[1];                    
            var from_staff=ledger[2];    
            var to_all=$('#to_acc').val();
            var ledger1=to_all.split('*');
            var to_ledger=ledger1[0];
            var  to_vendor=ledger1[1];
            var to_staff=ledger1[2];    
            
						$.post("load_consolidatedreport.php", {fromdt:fromval,todt:tot_to,type:typeval,bydate:bydate,voucher:voucher,staff:staff,department:department,fromtime:fromtime,totime:totime,day:day,tax:tax,shiftlogin:shiftlogin,payment:payment,bank_name:bank_name,from_ledger:from_ledger,from_vendor:from_vendor,from_staff:from_staff,to_ledger:to_ledger,to_vendor:to_vendor,to_staff:to_staff,acc_type:acc_type,pur_acc_type:pur_acc_type},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
	});
        
   $('#phone_order').change(function () {    
             
		$('#ui-datepicker-div').css("display", "none");
		var department=$('#mode').val();
                var typeval=$('#typeval').val();
                var payment=$('#paytype').val();
                var staff=$('#cashier').val();
                var bydate=$('#bydate').val();
                var fromval=$('#datepickerfrom').val();
                var tot_to=$('#datepickertodt').val();
                var voucher=$('#voucher').val();
                var shiftlogin=$('#shiftlogin').val();
                var fromtime=$('#display_timefrom').html();
                var totime=$('#display_timeto').html();
                var day=$('#day').val();
                var tax = $('#taxtype').val();
                var bank_name=$('#bank_name').val();
                var phone_order=$('#phone_order').val();
             
             if(payment=='2'){
                   $('#bank_div').css("display", "block"); 
             }else{
                   $('#bank_div').css("display", "none"); 
             }            
						$.post("load_consolidatedreport.php", {fromdt:fromval,todt:tot_to,type:typeval,bydate:bydate,voucher:voucher,staff:staff,department:department,fromtime:fromtime,totime:totime,day:day,tax:tax,shiftlogin:shiftlogin,payment:payment,bank_name:bank_name,phone_order:phone_order},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});	
	});
        
        
    $('#paytype').change(function () {            
		$('#ui-datepicker-div').css("display", "none");
		var department=$('#mode').val();
                var typeval=$('#typeval').val();
               var payment=$('#paytype').val();
                var staff=$('#cashier').val();
                var bydate=$('#bydate').val();
                var fromval=$('#datepickerfrom').val();
                var tot_to=$('#datepickertodt').val();
                var voucher=$('#voucher').val();
                var shiftlogin=$('#shiftlogin').val();
                var fromtime=$('#display_timefrom').html();
                var totime=$('#display_timeto').html();
                var day=$('#day').val();
                  var tax = $('#taxtype').val();
             var bank_name=$('#bank_name').val();
             
             if(payment=='2'){
                   $('#bank_div').css("display", "block"); 
             }else{
                   $('#bank_div').css("display", "none"); 
             }            
						$.post("load_consolidatedreport.php", {fromdt:fromval,todt:tot_to,type:typeval,bydate:bydate,voucher:voucher,staff:staff,department:department,fromtime:fromtime,totime:totime,day:day,tax:tax,shiftlogin:shiftlogin,payment:payment,bank_name:bank_name},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});	
	});
        
    $('#department').change(function () {
    
     $('.confrmation_overlay_proce').css('display','block');
     $('.confrmation_overlay_proce').html('<img src="img/ajax-loaders/fetch.gif" />');
    
		$('#ui-datepicker-div').css("display", "none");
		var department=$('#mode').val();
                var typeval=$('#typeval').val();
                 var payment=$('#paytype').val();
                  var bank_name=$('#bank_name').val();
                  
                  if(typeval=='discount_report_cr'){
            
               $('#item_disc_div').css("display", "block");
        }else{
              $('#item_disc_div').css("display", "none");
        }
                  
                  
                if(typeval=='tax_report'){
                    $('#tax_all').css("display","block");                   
                }              
               if(typeval=='totalsales_consolidate_report_cr' && department=="DI" ){
                    $('#floor_wise_div').css("display","block");
               }else{
                   $('#floor_wise_div').css("display","none"); 
               }
               
               if(typeval=='totalsales_consolidate_report_cr' && (department=="TA" || department=="CS") ){
                    $('#ta_login_staff_div').css("display","block");
               }else{
                   $('#ta_login_staff_div').css("display","none"); 
               }
               
               if(typeval=='totalsales_consolidate_report_cr' && department=="HD" ){
                    $('#deliveryboy_div_hd').css("display","block");
               }else{
                   $('#deliveryboy_div_hd').css("display","none"); 
               }
               
               var staff_hd=$('#staff_hd').val();
               var loginstaffsel=$('#staff_ta').val();             
                var staff=$('#cashier').val();
                var bydate=$('#bydate').val();
                var fromval=$('#datepickerfrom').val();
                var tot_to=$('#datepickertodt').val();
                var voucher=$('#voucher').val();
                var shiftlogin=$('#shiftlogin').val();
                var fromtime=$('#display_timefrom').html();
                var totime=$('#display_timeto').html();
                var day=$('#day').val();
                  var tax = $('#taxtype').val();                 
                  var floorz= $('#floor_di').val();     
                  
                  
                  if($("#item_disc").prop('checked') == true){
                var item_disc='true'; 
             }else{
               var item_disc='false'; 
           } 
             
             
             var item_disc_type=$('#item_disc_type').val();
                  
						$.post("load_consolidatedreport.php", {fromdt:fromval,todt:tot_to,type:typeval,bydate:bydate,voucher:voucher,staff:staff,department:department,fromtime:fromtime,totime:totime,day:day,tax:tax,shiftlogin:shiftlogin,payment:payment,floorz:floorz,loginstaffsel:loginstaffsel,staff_hd:staff_hd,bank_name:bank_name,item_disc:item_disc,item_disc_type:item_disc_type},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
                                                           $('.confrmation_overlay_proce').css('display','none');
   
						});	
	});
        
   $('#staff_hd').change(function () {
		$('#ui-datepicker-div').css("display", "none");
		var department=$('#mode').val();
                var typeval=$('#typeval').val();
                 var payment=$('#paytype').val();
                if(typeval=='tax_report'){                   
                        $('#tax_all').css("display","block");                    
                }              
               if(typeval=='totalsales_consolidate_report_cr' && department=="DI" ){
                    $('#floor_wise_div').css("display","block");
               }else{
                   $('#floor_wise_div').css("display","none"); 
               }              
               if(typeval=='totalsales_consolidate_report_cr' && (department=="TA" || department=="CS") ){
                    $('#ta_login_staff_div').css("display","block");
               }else{
                   $('#ta_login_staff_div').css("display","none"); 
               }
               if(typeval=='totalsales_consolidate_report_cr' && department=="HD" ){
                    $('#deliveryboy_div_hd').css("display","block");
               }else{
                   $('#deliveryboy_div_hd').css("display","none"); 
               }
               var staff_hd=$('#staff_hd').val();
               var loginstaffsel=$('#staff_ta').val();
               var staff=$('#cashier').val();
                var bydate=$('#bydate').val();
                var fromval=$('#datepickerfrom').val();
                var tot_to=$('#datepickertodt').val();
                var voucher=$('#voucher').val();
                var shiftlogin=$('#shiftlogin').val();
                var fromtime=$('#display_timefrom').html();
                var totime=$('#display_timeto').html();
                var day=$('#day').val();
                 var tax = $('#taxtype').val();
                 var floorz= $('#floor_di').val();
            $.post("load_consolidatedreport.php", {fromdt:fromval,todt:tot_to,type:typeval,bydate:bydate,voucher:voucher,staff:staff,department:department,fromtime:fromtime,totime:totime,day:day,tax:tax,shiftlogin:shiftlogin,payment:payment,floorz:floorz,loginstaffsel:loginstaffsel,staff_hd:staff_hd},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
	});
  $('#floor_di').change(function () {
		$('#ui-datepicker-div').css("display", "none");
		var department=$('#mode').val();
                var typeval=$('#typeval').val();
                 var payment=$('#paytype').val();
                if(typeval=='tax_report'){
                    $('#tax_all').css("display","block");                   
                }            
               var staff_hd=$('#staff_hd').val();               
                var staff=$('#cashier').val();
                var bydate=$('#bydate').val();
                var fromval=$('#datepickerfrom').val();
                var tot_to=$('#datepickertodt').val();
                var voucher=$('#voucher').val();
                var shiftlogin=$('#shiftlogin').val();
                var fromtime=$('#display_timefrom').html();
                var totime=$('#display_timeto').html();
                var day=$('#day').val();
                  var tax = $('#taxtype').val();                  
                  var floorz= $('#floor_di').val();            
						$.post("load_consolidatedreport.php", {fromdt:fromval,todt:tot_to,type:typeval,bydate:bydate,voucher:voucher,staff:staff,department:department,fromtime:fromtime,totime:totime,day:day,tax:tax,shiftlogin:shiftlogin,payment:payment,floorz:floorz},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});	
	});      
  $('#staff_ta').change(function () {
           
		$('#ui-datepicker-div').css("display", "none");
		var department=$('#mode').val();
                var typeval=$('#typeval').val();
                 var payment=$('#paytype').val();
                if(typeval=='tax_report'){                   
                        $('#tax_all').css("display","block");                   
                }
               var loginstaffsel=$('#staff_ta').val();             
                var staff=$('#cashier').val();
                var bydate=$('#bydate').val();
                var fromval=$('#datepickerfrom').val();
                var tot_to=$('#datepickertodt').val();
                var voucher=$('#voucher').val();
                var shiftlogin=$('#shiftlogin').val();
                var fromtime=$('#display_timefrom').html();
                var totime=$('#display_timeto').html();
                var day=$('#day').val();
                  var tax = $('#taxtype').val();                 
                  var floorz= $('#floor_di').val();           	
						$.post("load_consolidatedreport.php", {fromdt:fromval,todt:tot_to,type:typeval,bydate:bydate,voucher:voucher,staff:staff,department:department,fromtime:fromtime,totime:totime,day:day,tax:tax,shiftlogin:shiftlogin,payment:payment,floorz:floorz,loginstaffsel:loginstaffsel},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});	
	});      
         $('#menuname_search').keyup(function () {  
		$('#ui-datepicker-div').css("display", "none");
		var menu_search=$(this).val();
             var category_menu=$('#menucategory').val();
               var typeval=$('#typeval').val();
                 var bydate=$('#bydate').val();
                var fromval=$('#datepickerfrom').val();
                var tot_to=$('#datepickertodt').val();
                var addon=$('#menu_type').val();
               var subcategory=$('#subcategory').val();
                $.post("load_consolidatedreport.php", {menu_search:menu_search,category_menu:category_menu,type:typeval,fromdt:fromval,todt:tot_to,bydate:bydate,addon:addon,subcategory:subcategory},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});	
	});
         $('#subcategory').change(function () {
        $('#ui-datepicker-div').css("display", "none");
		var category_menu=$('#menucategory').val();
               var typeval=$('#typeval').val();
                 var bydate=$('#bydate').val();
                var fromval=$('#datepickerfrom').val();
                var tot_to=$('#datepickertodt').val();
               var menu_search=$('#menuname_search').val();
                var addon=$('#menu_type').val();
                var subcategory=$('#subcategory').val();
                $.post("load_consolidatedreport.php", {menu_search:menu_search,category_menu:category_menu,type:typeval,fromdt:fromval,todt:tot_to,bydate:bydate,addon:addon,subcategory:subcategory},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});	
	});
        $('#menucategory').change(function () {
        $('#ui-datepicker-div').css("display", "none");
		var category_menu=$(this).val();
               var typeval=$('#typeval').val();
                 var bydate=$('#bydate').val();
                var fromval=$('#datepickerfrom').val();
                var tot_to=$('#datepickertodt').val();
               var menu_search=$('#menuname_search').val();
                var addon=$('#menu_type').val();
                var subcategory=$('#subcategory').val();
                $.post("load_consolidatedreport.php", {menu_search:menu_search,category_menu:category_menu,type:typeval,fromdt:fromval,todt:tot_to,bydate:bydate,addon:addon,subcategory:subcategory},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
	});
        $('#menu_type').change(function () {
        $('#ui-datepicker-div').css("display", "none");
		var category_menu=$('#menucategory').val();
               var typeval=$('#typeval').val();
                 var bydate=$('#bydate').val();
                var fromval=$('#datepickerfrom').val();
                var tot_to=$('#datepickertodt').val();
               var menu_search=$('#menuname_search').val();
                var addon=$(this).val();
                var subcategory=$('#subcategory').val();
						$.post("load_consolidatedreport.php", {menu_search:menu_search,category_menu:category_menu,type:typeval,fromdt:fromval,todt:tot_to,bydate:bydate,addon:addon,subcategory:subcategory},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});				
	});
$('#date').change(function () {            
		$('#ui-datepicker-div').css("display", "none");
		var date=$(this).val();               
                var typeval=$('#typeval').val();
                var shiftlogin=$('#shiftlogin').val();		
						$.post("load_consolidatedreport.php", {date:date,type:typeval},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});						
	});
        
$('#datepickerfrom').change(function () { 
    
    var tot_to=$('#datepickertodt').val();
    var fromval=$(this).val();  
    
     var tot_to1=$('#datepickertodt').val();
    if(tot_to1=="")
    { 
	tot_to1= fromval;
    }
    
   
    var datastring = "set=date_diff_check&from="+fromval+"&to="+tot_to1;
    
              $.ajax({
            type: "POST",
            url: "load_index.php",
            data: datastring,
            success: function (data2)
            { 
                
      var data1=$.trim(data2);
			
      if(parseInt(data1)<'366'){
    
    
      var acc_type=  $('#exp_type_acc').val();
      var pur_acc_type=  $('#pur_type_acc').val();
      $('#ui-datepicker-div').css("display", "none");
		           
		
                var typeval=$('#typeval').val();
                var kitchen=$('#kitchen').val();
                var modeofview=$('#summary_detailed').val();
                 var cashcounter=$('#cashcounter').val();
                      var voucher=$('#voucher').val();
                        var voucher1=$('#voucher1').val();
                      var department=$('#mode').val();
                      var creditstaff=$('#bycreditstaff').val();
                      var credit_staff_company='';
                        var payment=$('#paytype').val();
                         var bank_name=$('#bank_name').val();
                if(creditstaff!=''){
                    if(creditstaff==2){
                       credit_staff_company= $('#creditstaff').val();
                    }
                    else if(creditstaff==3){
                      credit_staff_company=$('#creditcompany').val();
                    }
                    else if(creditstaff==4){
                       credit_staff_company=$('#creditguest').val();
                    }
                }
                      var staff=$('#cashier').val();
                      var fromtime=$('#display_timefrom').html();
                      var totime=$('#display_timeto').html();
                      var day=$('#day').val();
                      var shiftlogin=$('#shiftlogin').val();
                      var status='';
                        if($('#credit-outstanding-select').is(":checked")){ status='true' } else{ status='false' };               
                var tax = "";
		var tax = $('#taxtype').val();
                var category_menu=$('#menucategory').val();
                var menu_search=$('#menuname_search').val();
                var floorz= $('#floor_di').val();
                var staff_hd=$('#staff_hd').val();
                var subcategory=$('#subcategory').val();       
                
                $('#bydate').val("");		
		if(tot_to=="")
		{ 
			tot_to="";
		}
            var loginstaffsel=$('#staff_ta').val();
            var addon=$('#menu_type').val();               
            var from_all=$('#from_acc').val();            
            var ledger=from_all.split('*');            
            var from_ledger=ledger[0];
            var  from_vendor=ledger[1];
            var from_staff=ledger[2];    
            var to_all=$('#to_acc').val();          
             var ledger1=to_all.split('*');             
             var to_ledger=ledger1[0];             
            var  to_vendor=ledger1[1];                     
            var to_staff=ledger1[2];        
            
             if($("#tax_adsr").prop('checked') == true){
                var tax_adsr='true'; 
             }else{
               var tax_adsr='false'; 
           } 
           
           if($("#nontax").prop('checked') == true){
                var non_tax='true'; 
             }else{
               var non_tax='false'; 
           } 
            
            if($("#item_disc").prop('checked') == true){
                var item_disc='true'; 
             }else{
               var item_disc='false'; 
           } 
             
             
             var item_disc_type=$('#item_disc_type').val();
             
             var item_disc_type=$('#item_disc_type').val();
                  
                if($("#most_revenue").prop('checked') == true){
                var most_revenue='Y'; 
             }else{
               var most_revenue='N'; 
             } 
             
             
              if($("#best_selling").prop('checked') == true){
                var best_selling='Y'; 
             }else{
               var best_selling='N'; 
             }    
                  
              if($("#comp_item_wise").prop('checked') == true){
                var comp_item_wise='true'; 
             }else{
               var comp_item_wise='false'; 
             } 
             
             var credit_partial_pay='';
                if($('#credit_partial_pay').is(":checked")){ credit_partial_pay='Y' } else{ credit_partial_pay='N' };  
                  
             
      if($('#datepickertodt').val()!='' && $('#datepickerfrom').val()!=''){
          
      $('.confrmation_overlay_proce').css('display','block');
    $('.confrmation_overlay_proce').html('<img src="img/ajax-loaders/fetch.gif" />');      
    
    
    
    
    
						$.post("load_consolidatedreport.php", {pur_acc_type:pur_acc_type,non_tax:non_tax,tax_adsr:tax_adsr,
                                                    menu_search:menu_search,fromdt:fromval,todt:tot_to,type:typeval,voucher:voucher,voucher1:voucher1,
                                                    staff:staff,department:department,creditstaff:creditstaff,fromtime:fromtime,tax:tax,totime:totime,
                                                    day:day,shiftlogin:shiftlogin,checkedstatus:status,credit_staff_company:credit_staff_company,
                                                    kitchen:kitchen,modeofview:modeofview,cashcounter:cashcounter,category_menu:category_menu,
                                                    payment:payment,addon:addon,floorz:floorz,loginstaffsel:loginstaffsel,staff_hd:staff_hd,
                                                    bank_name:bank_name,acc_type:acc_type,from_ledger:from_ledger,from_vendor:from_vendor,
                                                    from_staff:from_staff,to_ledger:to_ledger,to_vendor:to_vendor,to_staff:to_staff,
                                                    subcategory:subcategory,item_disc_type:item_disc_type,item_disc:item_disc,best_selling:best_selling,
                                                    most_revenue:most_revenue,credit_partial_pay:credit_partial_pay,comp_item_wise:comp_item_wise,set:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
                                                           $('.confrmation_overlay_proce').css('display','none');             
						});
                }
                
              }else{
                  
                     $('#datepickerfrom').val('');
                     $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('DATE GAP MUST BE 1 YEAR');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
                }
                }
		});      
                
                
                
	});   
        
        
        
$('#datepickertodt').change(function () {

var tot_to=$(this).val();
var fromval=$('#datepickerfrom').val();

           
    var fromval1=$('#datepickerfrom').val();
    if(fromval1=="")
    { 
	fromval1= tot_to;
    }
       
           
                
		 var datastring = "set=date_diff_check&from="+fromval1+"&to="+tot_to;
   
              $.ajax({
            type: "POST",
            url: "load_index.php",
            data: datastring,
            success: function (data2)
            { 
			var data1=$.trim(data2);
			
                        if(parseInt(data1)<'366'){
                      
                       	
    if(($('#datepickertodt').val()!='' && $('#datepickerfrom').val()!='') || ($('#datepickertodt').val()=='' && $('#datepickerfrom').val()=='')){
    $('.confrmation_overlay_proce').css('display','block');
    $('.confrmation_overlay_proce').html('<img src="img/ajax-loaders/fetch.gif" />');
    }
  
                var acc_type=  $('#exp_type_acc').val();
                var pur_acc_type=  $('#pur_type_acc').val();
		$('#ui-datepicker-div').css("display", "none");
                
		
                
                var modeofview=$('#summary_detailed').val();
                var shiftlogin=$('#shiftlogin').val();
                var cashcounter=$('#cashcounter').val();
		
                var creditstaff=$('#bycreditstaff').val();
                var kitchen=$('#kitchen').val();              
                 var payment=$('#paytype').val();
                var credit_staff_company='';
                  var bank_name=$('#bank_name').val();
                if(creditstaff!=''){
                    if(creditstaff==2){
                       credit_staff_company= $('#creditstaff').val();
                    }
                    else if(creditstaff==3){
                      credit_staff_company=$('#creditcompany').val();
                    }
                    else if(creditstaff==4){
                       credit_staff_company=$('#creditguest').val();
                    }
                } 
                  var menu_search=$('#menuname_search').val();
                  var category_menu=$('#menucategory').val();
                var typeval=$('#typeval').val();
                var voucher=$('#voucher').val();
                  var voucher1=$('#voucher1').val();
                var department=$('#mode').val();
                var staff=$('#cashier').val();
                var fromtime=$('#display_timefrom').html();
                var totime=$('#display_timeto').html();
                var day=$('#day').val();
                var status='';
                  var staff_hd=$('#staff_hd').val();
                 var floorz= $('#floor_di').val();
                if($('#credit-outstanding-select').is(":checked")){ status='true' } else{ status='false' };
               var tax = $('#taxtype').val();
                  var loginstaffsel=$('#staff_ta').val(); 
                $('#bydate').val("");		
		if(fromval=="")
		{
			fromval="";
		}
                
               
                
            var addon=$('#menu_type').val();
            var from_all=$('#from_acc').val();
            var ledger=from_all.split('*');
            var from_ledger=ledger[0];
            var  from_vendor=ledger[1];                    
            var from_staff=ledger[2];    
            var to_all=$('#to_acc').val();
            var ledger1=to_all.split('*');
            var to_ledger=ledger1[0];
            var  to_vendor=ledger1[1];
            var to_staff=ledger1[2];    
            var subcategory=$('#subcategory').val();
            
             if($("#tax_adsr").prop('checked') == true){
                var tax_adsr='true'; 
             }else{
               var tax_adsr='false'; 
           } 
           
           if($("#nontax").prop('checked') == true){
                var non_tax='true'; 
             }else{
               var non_tax='false'; 
           } 
           
           
           if($("#item_disc").prop('checked') == true){
                var item_disc='true'; 
             }else{
               var item_disc='false'; 
           } 
             
             
             var item_disc_type=$('#item_disc_type').val();
                  
                if($("#most_revenue").prop('checked') == true){
                var most_revenue='Y'; 
             }else{
               var most_revenue='N'; 
             } 
             
             
              if($("#best_selling").prop('checked') == true){
                var best_selling='Y'; 
             }else{
               var best_selling='N'; 
             }    
                  
                  
                   
             if($("#comp_item_wise").prop('checked') == true){
                var comp_item_wise='true'; 
             }else{
               var comp_item_wise='false'; 
             } 
                  
                 var credit_partial_pay='';
                if($('#credit_partial_pay').is(":checked")){ credit_partial_pay='Y' } else{ credit_partial_pay='N' };  
                  
            $.post("load_consolidatedreport.php", {pur_acc_type:pur_acc_type,tax_adsr:tax_adsr,non_tax:non_tax,menu_search:menu_search,fromdt:fromval,
                todt:tot_to,type:typeval,voucher:voucher,voucher1:voucher1,staff:staff,department:department,creditstaff:creditstaff,fromtime:fromtime,
                totime:totime,tax:tax,day:day,shiftlogin:shiftlogin,checkedstatus:status,credit_staff_company:credit_staff_company,kitchen:kitchen,
                modeofview:modeofview,category_menu:category_menu,cashcounter:cashcounter,payment:payment,addon:addon,floorz:floorz,
                loginstaffsel:loginstaffsel,staff_hd:staff_hd,bank_name:bank_name, from_ledger:from_ledger,from_vendor:from_vendor,from_staff:from_staff,
                to_ledger:to_ledger,to_vendor:to_vendor,to_staff:to_staff ,acc_type:acc_type,subcategory:subcategory,item_disc_type:item_disc_type,
                item_disc:item_disc,most_revenue:most_revenue,best_selling:best_selling,credit_partial_pay:credit_partial_pay,
                comp_item_wise:comp_item_wise,set:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);                                                      
                                                            $('.confrmation_overlay_proce').css('display','none');              
						});
                                                
                                                
                }else{
                    
                     $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('DATE GAP MUST BE 1 YEAR');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
                     $('#datepickertodt').val('');
                }
                }
		});                                  
                                                
                                                
                                                                                                                                
	});
        
        
        
$('#datepickerfrom').click(function () {
    $('#ui-datepicker-div').css("display", "block");
});


$('#datepickertodt').click(function () {
    $('#ui-datepicker-div').css("display", "block");
});


   $('#exp_type_acc').change(function () {
       
                 var acc_type=  $('#exp_type_acc').val();                  
		var shiftlogin=$('#shiftlogin').val();
		var bydate=$('#bydate').val();
                var modeofview=$('#summary_detailed').val();
                 var cashcounter=$('#cashcounter').val();
                // $('#datepickerfrom').val("");
                // $('#datepickertodt').val("");
		var menu_search=$('#menuname_search').val();
		var status='';
                if($('#credit-outstanding-select').is(":checked")){ status='true' } else{ status='false' };
		var typeval=$('#typeval').val();
	        var fromval=$('#datepickerfrom').val();
		var tot_to=$('#datepickertodt').val();
                var creditstaff=$('#bycreditstaff').val();
                var credit_staff_company='';
                if(creditstaff!=''){
                    if(creditstaff==2){
                       credit_staff_company= $('#creditstaff').val();
                    }
                    else if(creditstaff==3){
                      credit_staff_company=$('#creditcompany').val();
                    }
                    else if(creditstaff==4){
                       credit_staff_company=$('#creditguest').val();
                    }
                }
                var voucher=$('#voucher').val();
                var voucher1=$('#voucher1').val();
                   var staff_hd=$('#staff_hd').val();
                var department=$('#mode').val();
                var staff=$('#cashier').val();
                var fromtime=$('#display_timefrom').html();
                var totime=$('#display_timeto').html();
                var day=$('#day').val();
                  var category_menu=$('#menucategory').val();
                 var payment=$('#paytype').val();
                 var kitchen=$('#kitchen').val();
                 var floorz= $('#floor_di').val();
                  var loginstaffsel=$('#staff_ta').val(); 
		  var tax = $('#taxtype').val();
		var addon=$('#menu_type').val();
                var bank_name=$('#bank_name').val();
                var from_all=$('#from_acc').val();
             var ledger=from_all.split('*');
            var from_ledger=ledger[0];
            var  from_vendor=ledger[1];
            var from_staff=ledger[2];    
              var to_all=$('#to_acc').val();
             var ledger1=to_all.split('*');
             var to_ledger=ledger1[0];
            var  to_vendor=ledger1[1];
            var to_staff=ledger1[2];    
             $.post("load_consolidatedreport.php", {menu_search:menu_search,fromdt:fromval,todt:tot_to,type:typeval,bydate:bydate,voucher1:voucher1,voucher:voucher,staff:staff,department:department,creditstaff:creditstaff,fromtime:fromtime,totime:totime,tax:tax,day:day,shiftlogin:shiftlogin,checkedstatus:status,credit_staff_company:credit_staff_company,modeofview:modeofview,cashcounter:cashcounter,payment:payment,category_menu:category_menu,kitchen:kitchen,addon:addon,floorz:floorz,loginstaffsel:loginstaffsel,staff_hd:staff_hd,bank_name:bank_name,acc_type:acc_type,from_ledger:from_ledger,from_vendor:from_vendor,from_staff:from_staff,to_ledger:to_ledger,to_vendor:to_vendor,to_staff:to_staff ,abc:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
	});   
    
    $('#pur_type_acc').change(function () {
        
                 var pur_acc_type=  $('#pur_type_acc').val();                  
		var shiftlogin=$('#shiftlogin').val();
		var bydate=$('#bydate').val();
                var modeofview=$('#summary_detailed').val();
                 var cashcounter=$('#cashcounter').val();
                // $('#datepickerfrom').val("");
                // $('#datepickertodt').val("");
		var menu_search=$('#menuname_search').val();
		var status='';
                if($('#credit-outstanding-select').is(":checked")){ status='true' } else{ status='false' };
		var typeval=$('#typeval').val();
	  var fromval=$('#datepickerfrom').val();
		var tot_to=$('#datepickertodt').val();
                var creditstaff=$('#bycreditstaff').val();
                var credit_staff_company='';
                if(creditstaff!=''){
                    if(creditstaff==2){
                       credit_staff_company= $('#creditstaff').val();
                    }
                    else if(creditstaff==3){
                      credit_staff_company=$('#creditcompany').val();
                    }
                    else if(creditstaff==4){
                       credit_staff_company=$('#creditguest').val();
                    }
                }
                var voucher=$('#voucher').val();
                var voucher1=$('#voucher1').val();
                   var staff_hd=$('#staff_hd').val();
                var department=$('#mode').val();
                var staff=$('#cashier').val();
                var fromtime=$('#display_timefrom').html();
                var totime=$('#display_timeto').html();
                var day=$('#day').val();
                  var category_menu=$('#menucategory').val();
                 var payment=$('#paytype').val();
                 var kitchen=$('#kitchen').val();
                 var floorz= $('#floor_di').val();
                  var loginstaffsel=$('#staff_ta').val(); 
		  var tax = $('#taxtype').val();
		var addon=$('#menu_type').val();
                var bank_name=$('#bank_name').val();
                var from_all=$('#from_acc').val();
             var ledger=from_all.split('*');
            var from_ledger=ledger[0];
            var  from_vendor=ledger[1];
            var from_staff=ledger[2];    
              var to_all=$('#to_acc').val();
             var ledger1=to_all.split('*');
             var to_ledger=ledger1[0];
            var  to_vendor=ledger1[1];
            var to_staff=ledger1[2];    
             $.post("load_consolidatedreport.php", {menu_search:menu_search,fromdt:fromval,todt:tot_to,type:typeval,bydate:bydate,voucher1:voucher1,voucher:voucher,staff:staff,department:department,creditstaff:creditstaff,fromtime:fromtime,totime:totime,tax:tax,day:day,shiftlogin:shiftlogin,checkedstatus:status,credit_staff_company:credit_staff_company,modeofview:modeofview,cashcounter:cashcounter,payment:payment,category_menu:category_menu,kitchen:kitchen,addon:addon,floorz:floorz,loginstaffsel:loginstaffsel,staff_hd:staff_hd,bank_name:bank_name,pur_acc_type:pur_acc_type,from_ledger:from_ledger,from_vendor:from_vendor,from_staff:from_staff,to_ledger:to_ledger,to_vendor:to_vendor,to_staff:to_staff ,abc:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
	});
        
 $('#comp_item').change(function () {
     
                var shiftlogin=$('#shiftlogin').val();
		var bydate=$('#bydate').val();
                var modeofview=$('#summary_detailed').val();
                var cashcounter=$('#cashcounter').val();
                $('#datepickerfrom').val("");
                $('#datepickertodt').val("");
		var menu_search=$('#menuname_search').val();
		var status='';
                if($('#credit-outstanding-select').is(":checked")){ status='true' } else{ status='false' };
		var typeval=$('#typeval').val();		
	        var fromval=$('#datepickerfrom').val();       
		var tot_to=$('#datepickertodt').val();
                var creditstaff=$('#bycreditstaff').val();
                var credit_staff_company='';
                if(creditstaff!=''){
                    if(creditstaff==2){
                       credit_staff_company= $('#creditstaff').val();
                    }
                    else if(creditstaff==3){
                      credit_staff_company=$('#creditcompany').val();
                    }
                    else if(creditstaff==4){
                       credit_staff_company=$('#creditguest').val();
                    }
                }
                var voucher=$('#voucher').val();
                var voucher1=$('#voucher1').val();
                   var staff_hd=$('#staff_hd').val();
                var department=$('#mode').val();
                var staff=$('#cashier').val();
                var fromtime=$('#display_timefrom').html();
                var totime=$('#display_timeto').html();
                var day=$('#day').val();
                  var category_menu=$('#menucategory').val();
                 var payment=$('#paytype').val();
                 var kitchen=$('#kitchen').val();
                var acc_type=  $('#exp_type_acc').val();
                var pur_acc_type=  $('#pur_type_acc').val();
                 var floorz= $('#floor_di').val();
                  var loginstaffsel=$('#staff_ta').val(); 
		  var tax = $('#taxtype').val();
		var addon=$('#menu_type').val();
                var bank_name=$('#bank_name').val();
                 var subcategory=$('#subcategory').val();
                var comp_item=$('#comp_item').val();              
						$.post("load_consolidatedreport.php", {pur_acc_type:pur_acc_type,menu_search:menu_search,fromdt:fromval,todt:tot_to,type:typeval,bydate:bydate,voucher1:voucher1,voucher:voucher,staff:staff,department:department,creditstaff:creditstaff,fromtime:fromtime,totime:totime,tax:tax,day:day,shiftlogin:shiftlogin,checkedstatus:status,credit_staff_company:credit_staff_company,modeofview:modeofview,cashcounter:cashcounter,payment:payment,category_menu:category_menu,kitchen:kitchen,addon:addon,floorz:floorz,loginstaffsel:loginstaffsel,staff_hd:staff_hd,bank_name:bank_name,acc_type:acc_type,subcategory:subcategory,comp_item:comp_item ,abc:"ft"},
						function(data)
						{
							  data=$.trim(data);					
							  $('#reportload').html(data);
                                                          $('.confrmation_overlay_proce').css('display','none');
						});			
	});  
      
      
    $('#comp_item_wise').change(function () {  
    
    
               $('.confrmation_overlay_proce').css('display','block');
               $('.confrmation_overlay_proce').html('<img src="img/ajax-loaders/fetch.gif" />');
		var shiftlogin=$('#shiftlogin').val();
		var bydate=$('#bydate').val();
               
                
                var modeofview=$('#summary_detailed').val();
                 var cashcounter=$('#cashcounter').val();
                $('#datepickerfrom').val("");
                $('#datepickertodt').val("");
		var menu_search=$('#menuname_search').val();
		var status='';
                if($('#credit-outstanding-select').is(":checked")){ status='true' } else{ status='false' };
		var typeval=$('#typeval').val();
	        var fromval=$('#datepickerfrom').val();            
		var tot_to=$('#datepickertodt').val();
                var creditstaff=$('#bycreditstaff').val();
                var credit_staff_company='';
                if(creditstaff!=''){
                    if(creditstaff==2){
                       credit_staff_company= $('#creditstaff').val();
                    }
                    else if(creditstaff==3){
                      credit_staff_company=$('#creditcompany').val();
                    }
                    else if(creditstaff==4){
                       credit_staff_company=$('#creditguest').val();
                    }
                }
                var voucher=$('#voucher').val();
                var voucher1=$('#voucher1').val();
                   var staff_hd=$('#staff_hd').val();
                var department=$('#mode').val();
                var staff=$('#cashier').val();
                var fromtime=$('#display_timefrom').html();
                var totime=$('#display_timeto').html();
                var day=$('#day').val();
                  var category_menu=$('#menucategory').val();
                 var payment=$('#paytype').val();
                 var kitchen=$('#kitchen').val();              
                  var acc_type=  $('#exp_type_acc').val();
                  var pur_acc_type=  $('#pur_type_acc').val();
                 var floorz= $('#floor_di').val();
                  var loginstaffsel=$('#staff_ta').val(); 
		  var tax = $('#taxtype').val();
		var addon=$('#menu_type').val();
                var bank_name=$('#bank_name').val();
                var from_all=$('#from_acc').val();
             var ledger=from_all.split('*');
            var from_ledger=ledger[0];
            var  from_vendor=ledger[1];
            var from_staff=ledger[2];      
            var to_all=$('#to_acc').val();            
            var ledger1=to_all.split('*');            
            var to_ledger=ledger1[0];            
            var  to_vendor=ledger1[1];                     
            var to_staff=ledger1[2];                               
            var subcategory=$('#subcategory').val();
            
             if($("#tax_adsr").prop('checked') == true){
                var tax_adsr='true'; 
             }else{
               var tax_adsr='false'; 
           } 
           
           if($("#nontax").prop('checked') == true){
                var non_tax='true'; 
             }else{
               var non_tax='false'; 
           } 
           
            
             
               if($("#item_disc").prop('checked') == true){
                var item_disc='true'; 
             }else{
               var item_disc='false'; 
           } 
           
             if($("#comp_item_wise").prop('checked') == true){
                var comp_item_wise='true'; 
             }else{
               var comp_item_wise='false'; 
           } 
           
             
             
             if($("#most_revenue").prop('checked') == true){
                var most_revenue='Y'; 
             }else{
               var most_revenue='N'; 
             } 
             
             
              if($("#best_selling").prop('checked') == true){
                var best_selling='Y'; 
             }else{
               var best_selling='N'; 
             } 
             
             
              var credit_partial_pay='';
                if($('#credit_partial_pay').is(":checked")){ credit_partial_pay='Y' } else{ credit_partial_pay='N' };
             
             
             var item_disc_type=$('#item_disc_type').val();
        
                       $.post("load_consolidatedreport.php", {pur_acc_type:pur_acc_type,tax_adsr:tax_adsr,non_tax:non_tax,menu_search:menu_search,
                           fromdt:fromval,todt:tot_to,type:typeval,bydate:bydate,voucher1:voucher1,voucher:voucher,staff:staff,department:department,
                           creditstaff:creditstaff,fromtime:fromtime,totime:totime,tax:tax,day:day,shiftlogin:shiftlogin,checkedstatus:status,
                           credit_staff_company:credit_staff_company,modeofview:modeofview,cashcounter:cashcounter,payment:payment,
                           category_menu:category_menu,kitchen:kitchen,addon:addon,floorz:floorz,loginstaffsel:loginstaffsel,staff_hd:staff_hd,
                           bank_name:bank_name,acc_type:acc_type, from_ledger:from_ledger,from_vendor:from_vendor,from_staff:from_staff,
                           to_ledger:to_ledger,to_vendor:to_vendor,to_staff:to_staff,subcategory:subcategory,item_disc_type:item_disc_type,
                           item_disc:item_disc,best_selling:best_selling,most_revenue:most_revenue ,
                           credit_partial_pay:credit_partial_pay,comp_item_wise:comp_item_wise,abc:"ft"},
						function(data)
						{    
                                                        $('.confrmation_overlay_proce').css('display','none');
							data=$.trim(data);							
							$('#reportload').html(data);      
                                                          
						});
                 
                    
                     
   });  
      
      
        
$('#bydate').change(function () {  
    
    
               $('.confrmation_overlay_proce').css('display','block');
               $('.confrmation_overlay_proce').html('<img src="img/ajax-loaders/fetch.gif" />');
		var shiftlogin=$('#shiftlogin').val();
		var bydate=$(this).val();
                var modeofview=$('#summary_detailed').val();
                 var cashcounter=$('#cashcounter').val();
                $('#datepickerfrom').val("");
                $('#datepickertodt').val("");
		var menu_search=$('#menuname_search').val();
		var status='';
                if($('#credit-outstanding-select').is(":checked")){ status='true' } else{ status='false' };
		var typeval=$('#typeval').val();
	        var fromval=$('#datepickerfrom').val();            
		var tot_to=$('#datepickertodt').val();
                var creditstaff=$('#bycreditstaff').val();
                var credit_staff_company='';
                if(creditstaff!=''){
                    if(creditstaff==2){
                       credit_staff_company= $('#creditstaff').val();
                    }
                    else if(creditstaff==3){
                      credit_staff_company=$('#creditcompany').val();
                    }
                    else if(creditstaff==4){
                       credit_staff_company=$('#creditguest').val();
                    }
                }
                var voucher=$('#voucher').val();
                var voucher1=$('#voucher1').val();
                   var staff_hd=$('#staff_hd').val();
                var department=$('#mode').val();
                var staff=$('#cashier').val();
                var fromtime=$('#display_timefrom').html();
                var totime=$('#display_timeto').html();
                var day=$('#day').val();
                  var category_menu=$('#menucategory').val();
                 var payment=$('#paytype').val();
                 var kitchen=$('#kitchen').val();              
                  var acc_type=  $('#exp_type_acc').val();
                  var pur_acc_type=  $('#pur_type_acc').val();
                 var floorz= $('#floor_di').val();
                  var loginstaffsel=$('#staff_ta').val(); 
		  var tax = $('#taxtype').val();
		var addon=$('#menu_type').val();
                var bank_name=$('#bank_name').val();
                var from_all=$('#from_acc').val();
             var ledger=from_all.split('*');
            var from_ledger=ledger[0];
            var  from_vendor=ledger[1];
            var from_staff=ledger[2];      
            var to_all=$('#to_acc').val();            
            var ledger1=to_all.split('*');            
            var to_ledger=ledger1[0];            
            var  to_vendor=ledger1[1];                     
            var to_staff=ledger1[2];                               
            var subcategory=$('#subcategory').val();
            
             if($("#tax_adsr").prop('checked') == true){
                var tax_adsr='true'; 
             }else{
               var tax_adsr='false'; 
           } 
           
           if($("#nontax").prop('checked') == true){
                var non_tax='true'; 
             }else{
               var non_tax='false'; 
           } 
           
            
             
               if($("#item_disc").prop('checked') == true){
                var item_disc='true'; 
             }else{
               var item_disc='false'; 
           } 
             
             
             if($("#most_revenue").prop('checked') == true){
                var most_revenue='Y'; 
             }else{
               var most_revenue='N'; 
             } 
             
             
              if($("#best_selling").prop('checked') == true){
                var best_selling='Y'; 
             }else{
               var best_selling='N'; 
             } 
             
             
              var credit_partial_pay='';
                if($('#credit_partial_pay').is(":checked")){ credit_partial_pay='Y' } else{ credit_partial_pay='N' };
             
             
             if($("#comp_item_wise").prop('checked') == true){
                var comp_item_wise='true'; 
             }else{
               var comp_item_wise='false'; 
             } 
             
             
             var item_disc_type=$('#item_disc_type').val();
        
                       $.post("load_consolidatedreport.php", {pur_acc_type:pur_acc_type,tax_adsr:tax_adsr,non_tax:non_tax,menu_search:menu_search,
                           fromdt:fromval,todt:tot_to,type:typeval,bydate:bydate,voucher1:voucher1,voucher:voucher,staff:staff,department:department,
                           creditstaff:creditstaff,fromtime:fromtime,totime:totime,tax:tax,day:day,shiftlogin:shiftlogin,checkedstatus:status,
                           credit_staff_company:credit_staff_company,modeofview:modeofview,cashcounter:cashcounter,payment:payment,
                           category_menu:category_menu,kitchen:kitchen,addon:addon,floorz:floorz,loginstaffsel:loginstaffsel,staff_hd:staff_hd,
                           bank_name:bank_name,acc_type:acc_type, from_ledger:from_ledger,from_vendor:from_vendor,from_staff:from_staff,
                           to_ledger:to_ledger,to_vendor:to_vendor,to_staff:to_staff,subcategory:subcategory,item_disc_type:item_disc_type,
                           item_disc:item_disc,best_selling:best_selling,most_revenue:most_revenue ,credit_partial_pay:credit_partial_pay,
                           comp_item_wise:comp_item_wise,abc:"ft"},
						function(data)
						{    
                                                        $('.confrmation_overlay_proce').css('display','none');
							data=$.trim(data);							
							$('#reportload').html(data);      
                                                          
						});
                 
                    
                     
   });
 
 
 $('#most_revenue').change(function () 
 { 
     
     $('#best_selling').prop('checked', false);
                   $('.confrmation_overlay_proce').css('display','block');
                   $('.confrmation_overlay_proce').html('<img src="img/ajax-loaders/fetch.gif" />');
		var shiftlogin=$('#shiftlogin').val();
		var bydate=$('#bydate').val();
                var modeofview=$('#summary_detailed').val();
                 var cashcounter=$('#cashcounter').val();
                $('#datepickerfrom').val("");
                $('#datepickertodt').val("");
		var menu_search=$('#menuname_search').val();
		var status='';
                if($('#credit-outstanding-select').is(":checked")){ status='true' } else{ status='false' };
		var typeval=$('#typeval').val();
	        var fromval=$('#datepickerfrom').val();            
		var tot_to=$('#datepickertodt').val();
                var creditstaff=$('#bycreditstaff').val();
                var credit_staff_company='';
                if(creditstaff!=''){
                    if(creditstaff==2){
                       credit_staff_company= $('#creditstaff').val();
                    }
                    else if(creditstaff==3){
                      credit_staff_company=$('#creditcompany').val();
                    }
                    else if(creditstaff==4){
                       credit_staff_company=$('#creditguest').val();
                    }
                }
                var voucher=$('#voucher').val();
                var voucher1=$('#voucher1').val();
                   var staff_hd=$('#staff_hd').val();
                var department=$('#mode').val();
                var staff=$('#cashier').val();
                var fromtime=$('#display_timefrom').html();
                var totime=$('#display_timeto').html();
                var day=$('#day').val();
                  var category_menu=$('#menucategory').val();
                 var payment=$('#paytype').val();
                 var kitchen=$('#kitchen').val();              
                  var acc_type=  $('#exp_type_acc').val();
                  var pur_acc_type=  $('#pur_type_acc').val();
                 var floorz= $('#floor_di').val();
                  var loginstaffsel=$('#staff_ta').val(); 
		  var tax = $('#taxtype').val();
		var addon=$('#menu_type').val();
                var bank_name=$('#bank_name').val();
                var from_all=$('#from_acc').val();
             var ledger=from_all.split('*');
            var from_ledger=ledger[0];
            var  from_vendor=ledger[1];
            var from_staff=ledger[2];      
            var to_all=$('#to_acc').val();            
            var ledger1=to_all.split('*');            
            var to_ledger=ledger1[0];            
            var  to_vendor=ledger1[1];                     
            var to_staff=ledger1[2];                               
            var subcategory=$('#subcategory').val();
            
             if($("#tax_adsr").prop('checked') == true){
                var tax_adsr='true'; 
             }else{
               var tax_adsr='false'; 
           } 
           
           if($("#nontax").prop('checked') == true){
                var non_tax='true'; 
             }else{
               var non_tax='false'; 
           } 
           
            
             
               if($("#item_disc").prop('checked') == true){
                var item_disc='true'; 
             }else{
               var item_disc='false'; 
           } 
             
             
             if($("#most_revenue").prop('checked') == true){
                var most_revenue='Y'; 
             }else{
               var most_revenue='N'; 
             } 
             
             
              if($("#best_selling").prop('checked') == true){
                var best_selling='Y'; 
             }else{
               var best_selling='N'; 
             } 
            
             
             var item_disc_type=$('#item_disc_type').val();
        
                       $.post("load_consolidatedreport.php", {pur_acc_type:pur_acc_type,tax_adsr:tax_adsr,non_tax:non_tax,menu_search:menu_search,fromdt:fromval,todt:tot_to,type:typeval,bydate:bydate,voucher1:voucher1,voucher:voucher,staff:staff,department:department,creditstaff:creditstaff,fromtime:fromtime,totime:totime,tax:tax,day:day,shiftlogin:shiftlogin,checkedstatus:status,credit_staff_company:credit_staff_company,modeofview:modeofview,cashcounter:cashcounter,payment:payment,category_menu:category_menu,kitchen:kitchen,addon:addon,floorz:floorz,loginstaffsel:loginstaffsel,staff_hd:staff_hd,bank_name:bank_name,acc_type:acc_type, from_ledger:from_ledger,from_vendor:from_vendor,from_staff:from_staff,to_ledger:to_ledger,to_vendor:to_vendor,to_staff:to_staff,subcategory:subcategory,item_disc_type:item_disc_type,item_disc:item_disc,best_selling:best_selling,most_revenue:most_revenue ,abc:"ft"},
						function(data)
						{    
                                                        $('.confrmation_overlay_proce').css('display','none');
							data=$.trim(data);							
							$('#reportload').html(data);      
                                                          
						});
                 
                    
                     
   });
 
 
     $('#best_selling').change(function () { 
         
         
         $('#most_revenue').prop('checked', false);
     
                $('.confrmation_overlay_proce').css('display','block');
                $('.confrmation_overlay_proce').html('<img src="img/ajax-loaders/fetch.gif" />');
		var shiftlogin=$('#shiftlogin').val();
		var bydate=$('#bydate').val();
                var modeofview=$('#summary_detailed').val();
                 var cashcounter=$('#cashcounter').val();
                $('#datepickerfrom').val("");
                $('#datepickertodt').val("");
		var menu_search=$('#menuname_search').val();
		var status='';
                if($('#credit-outstanding-select').is(":checked")){ status='true' } else{ status='false' };
		var typeval=$('#typeval').val();
	        var fromval=$('#datepickerfrom').val();            
		var tot_to=$('#datepickertodt').val();
                var creditstaff=$('#bycreditstaff').val();
                var credit_staff_company='';
                if(creditstaff!=''){
                    if(creditstaff==2){
                       credit_staff_company= $('#creditstaff').val();
                    }
                    else if(creditstaff==3){
                      credit_staff_company=$('#creditcompany').val();
                    }
                    else if(creditstaff==4){
                       credit_staff_company=$('#creditguest').val();
                    }
                }
                var voucher=$('#voucher').val();
                var voucher1=$('#voucher1').val();
                   var staff_hd=$('#staff_hd').val();
                var department=$('#mode').val();
                var staff=$('#cashier').val();
                var fromtime=$('#display_timefrom').html();
                var totime=$('#display_timeto').html();
                var day=$('#day').val();
                  var category_menu=$('#menucategory').val();
                 var payment=$('#paytype').val();
                 var kitchen=$('#kitchen').val();              
                  var acc_type=  $('#exp_type_acc').val();
                  var pur_acc_type=  $('#pur_type_acc').val();
                 var floorz= $('#floor_di').val();
                  var loginstaffsel=$('#staff_ta').val(); 
		  var tax = $('#taxtype').val();
		var addon=$('#menu_type').val();
                var bank_name=$('#bank_name').val();
                var from_all=$('#from_acc').val();
             var ledger=from_all.split('*');
            var from_ledger=ledger[0];
            var  from_vendor=ledger[1];
            var from_staff=ledger[2];      
            var to_all=$('#to_acc').val();            
            var ledger1=to_all.split('*');            
            var to_ledger=ledger1[0];            
            var  to_vendor=ledger1[1];                     
            var to_staff=ledger1[2];                               
            var subcategory=$('#subcategory').val();
            
             if($("#tax_adsr").prop('checked') == true){
                var tax_adsr='true'; 
             }else{
               var tax_adsr='false'; 
           } 
           
           if($("#nontax").prop('checked') == true){
                var non_tax='true'; 
             }else{
               var non_tax='false'; 
           } 
           
            
             
               if($("#item_disc").prop('checked') == true){
                var item_disc='true'; 
             }else{
               var item_disc='false'; 
           } 
             
             
             if($("#most_revenue").prop('checked') == true){
                var most_revenue='Y'; 
             }else{
               var most_revenue='N'; 
             } 
             
             
              if($("#best_selling").prop('checked') == true){
                var best_selling='Y'; 
             }else{
               var best_selling='N'; 
             } 
            
             
             var item_disc_type=$('#item_disc_type').val();
        
                       $.post("load_consolidatedreport.php", {pur_acc_type:pur_acc_type,tax_adsr:tax_adsr,non_tax:non_tax,menu_search:menu_search,fromdt:fromval,todt:tot_to,type:typeval,bydate:bydate,voucher1:voucher1,voucher:voucher,staff:staff,department:department,creditstaff:creditstaff,fromtime:fromtime,totime:totime,tax:tax,day:day,shiftlogin:shiftlogin,checkedstatus:status,credit_staff_company:credit_staff_company,modeofview:modeofview,cashcounter:cashcounter,payment:payment,category_menu:category_menu,kitchen:kitchen,addon:addon,floorz:floorz,loginstaffsel:loginstaffsel,staff_hd:staff_hd,bank_name:bank_name,acc_type:acc_type, from_ledger:from_ledger,from_vendor:from_vendor,from_staff:from_staff,to_ledger:to_ledger,to_vendor:to_vendor,to_staff:to_staff,subcategory:subcategory,item_disc_type:item_disc_type,item_disc:item_disc,best_selling:best_selling,most_revenue:most_revenue ,abc:"ft"},
						function(data)
						{    
                                                        $('.confrmation_overlay_proce').css('display','none');
							data=$.trim(data);							
							$('#reportload').html(data);      
                                                          
						});
                 
                    
                     
   });
   
 $('#voucher_login').change(function () {
        var bydate=$('#bydate').val();
        var shiftlogin=$('#shiftlogin').val();
		var typeval=$('#typeval').val();
		var fromval=$('#datepickerfrom').val();
        var tot_to=$('#datepickertodt').val();
		var voucher=$('#voucher').val();
                var voucher1=$('#voucher1').val();
                var voucher_login=$('#voucher_login').val();
                var department=$('#mode').val();
                var staff=$('#cashier').val();
                var fromtime=$('#display_timefrom').html();
                var totime=$('#display_timeto').html();
                var day=$('#day').val();
            $.post("load_consolidatedreport.php", { type:typeval,fromdt:fromval,todt:tot_to,voucher:voucher,voucher1:voucher1,bydate:bydate,voucher_login:voucher_login},
                  function(data)
						{
							  data=$.trim(data);							
							  $('#reportload').html(data);
						});				
	});
$('#voucher1').change(function () {
        var bydate=$('#bydate').val();
        var shiftlogin=$('#shiftlogin').val();
		var typeval=$('#typeval').val();
	  var fromval=$('#datepickerfrom').val();               
		var tot_to=$('#datepickertodt').val();
		var voucher=$('#voucher').val();
                var voucher1=$('#voucher1').val();
              var department=$('#mode').val();
                var staff=$('#cashier').val();
                var fromtime=$('#display_timefrom').html();
                var totime=$('#display_timeto').html();
                var day=$('#day').val();              
						$.post("load_consolidatedreport.php", { type:typeval,fromdt:fromval,todt:tot_to,voucher:voucher,voucher1:voucher1,bydate:bydate},                                              
						function(data)
						{
							  data=$.trim(data);							
							  $('#reportload').html(data);
						});				
	});
$('#bycreditstaff').change(function() {
		var creditstaff=$(this).val();
                if(creditstaff!=''){
                    $('#creditperson-companydiv').css('display','block');
                if(creditstaff==2){
                    $('#creditstaff').css('display','block');
                    $('#creditstaff').val('');
                    $('#creditcompany').css('display','none');
                    $('#creditguest').css('display','none');
                }
                else if(creditstaff==3){
                    $('#creditstaff').css('display','none');
                    $('#creditcompany').css('display','block');
                    $('#creditcompany').val('');
                    $('#creditguest').css('display','none');
                }
                else if(creditstaff==4){
                    $('#creditstaff').css('display','none');
                    $('#creditcompany').css('display','none');
                    $('#creditguest').css('display','block');
                    $('#creditguest').val('');
                }
            }
            else{
                $('#creditperson-companydiv').css('display','none');
                $('#creditstaff').css('display','none');
                    $('#creditcompany').css('display','none');
                    $('#creditguest').css('display','none');
            }              
                var credit_staff_company='';
                if(creditstaff!=''){
                    if(creditstaff==2){
                       credit_staff_company= $('#creditstaff').val();
                    }
                    else if(creditstaff==3){
                      credit_staff_company=$('#creditcompany').val();
                    }
                    else if(creditstaff==4){
                       credit_staff_company=$('#creditguest').val();
                    }
                }
                var status='';
                if($('#credit-outstanding-select').is(":checked")){ status='true' } else{ status='false' };    
		var fromval=$('#datepickerfrom').val();
                var typeval=$('#typeval').val();
		var tot_to=$('#datepickertodt').val();
                var bydate=$('#bydate').val();
                if(typeval=='credit_summary_client'){
                    $('#creditperson-companydiv').hide();
                }else{
                    $('#creditperson-companydiv').show();
                }
				$.post("load_consolidatedreport.php", {type:typeval,fromdt:fromval,todt:tot_to,creditstaff:creditstaff,bydate:bydate,checkedstatus:status,credit_staff_company:credit_staff_company},
				function(data)
				   {
					data=$.trim(data);
					$('#reportload').html(data);
				   });
});
$('#taxtype').change(function () {
      var bydate=$('#bydate').val();
        var typeval=$('#typeval').val();
		 var fromval=$('#datepickerfrom').val();
        var tot_to=$('#datepickertodt').val();
		var voucher=$('#voucher').val();
                var voucher1=$('#voucher1').val();
                var tax = $('#taxtype').val();
              var department=$('#mode').val();
                var staff=$('#cashier').val();
                var fromtime=$('#display_timefrom').html();
                var totime=$('#display_timeto').html();
                var day=$('#day').val();
            $.post("load_consolidatedreport.php", { type:typeval,fromdt:fromval,todt:tot_to,voucher:voucher,voucher1:voucher1,bydate:bydate,tax:tax,department:department},
                    function(data)
						{
							  data=$.trim(data);
							$('#reportload').html(data);
						});				
	});
        
        
$('#shiftlogin').change(function () {
                    var bydate=$('#bydate').val();
                var modeofview=$('#summary_detailed').val();
		var typeval=$('#typeval').val();
                var fromval=$('#datepickerfrom').val();
                 var tot_to=$('#datepickertodt').val();
		var shiftlogin=$('#shiftlogin').val();
		 var cashcounter=$('#cashcounter').val();
		$.post("load_consolidatedreport.php", { type:typeval,fromdt:fromval,todt:tot_to,bydate:bydate,shiftlogin:shiftlogin,modeofview:modeofview,cashcounter:cashcounter},
                        function(data)
						{
							  data=$.trim(data);
							$('#reportload').html(data);
						});				
	});
        
        
      $('#hsn_billwise').change(function () {
  
    $('.confrmation_overlay_proce').css('display','block');
    $('.confrmation_overlay_proce').html('<img src="img/ajax-loaders/fetch.gif" />');
    
		var modeofview=$('#summary_detailed').val();
                var typeval=$('#typeval').val();   
                 var department=$('#mode').val();
              
               if(modeofview=='summary'){
                  $('#menuname_search_div').hide(); 
                   $('#menucategory_div').hide(); 
                    $('#menu_typediv').hide(); 
                     $('#department').show(); 
                     $('#menusubcategory_div').hide();  
                     
            if(typeval=="totalsales_consolidate_report_cr")
            {   
                $('#department').show(); 
                 $('#nontax_div').css("display", "block");
                  $('#tax_adsr_div').css("display", "block");
            }else{
                 $('#department').hide();
                 $('#nontax_div').css("display", "none");
                  $('#tax_adsr_div').css("display", "none");
            }
                     
                     
               }else if(modeofview=='item_wise'){
                   $('#menuname_search_div').hide(); 
                   $('#menucategory_div').hide(); 
                    $('#menu_typediv').hide(); 
                     $('#department').hide(); 
                      $('#menusubcategory_div').hide();  
                      
                    $('#hsn_code_div').css("display", "block");  
         
               }else{
                    $('#hsn_code_div').css("display", "none");
                   $('#menuname_search_div').hide(); 
                   $('#menucategory_div').hide(); 
                    $('#menu_typediv').hide(); 
                      $('#department').hide(); 
                     $('#menusubcategory_div').hide();    
               }
               
            if($("#hsn_billwise").prop('checked') == true){
                
                var hsn_billwise='true'; 
                
                
             }else{
                var hsn_billwise='false'; 
                
             } 
           
            if($("#hsn_code").prop('checked') == true){
                
                var hsn_code='true'; 
                
             }else{
                 
               var hsn_code='false'; 
                
           } 
           
              
		var bydate=$('#bydate').val();
		var fromval=$('#datepickerfrom').val();
		var tot_to=$('#datepickertodt').val();
		var shiftlogin=$('#shiftlogin').val();
                var cashcounter=$('#cashcounter').val();
		var subcategory=$('#subcategory').val();
                
          $.post("load_consolidatedreport.php", { type:typeval,fromdt:fromval,todt:tot_to,bydate:bydate,shiftlogin:shiftlogin,modeofview:modeofview,
          cashcounter:cashcounter,subcategory:subcategory,hsn_code:hsn_code,hsn_billwise:hsn_billwise},                      
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
                                                          $('.confrmation_overlay_proce').css('display','none');
						});		
	});    
        
        
        
        
        
        
    $('#hsn_code').change(function () {
  
    $('.confrmation_overlay_proce').css('display','block');
    $('.confrmation_overlay_proce').html('<img src="img/ajax-loaders/fetch.gif" />');
    
		var modeofview=$('#summary_detailed').val();
                var typeval=$('#typeval').val();   
                 var department=$('#mode').val();
              
               if(modeofview=='summary'){
                  $('#menuname_search_div').hide(); 
                   $('#menucategory_div').hide(); 
                    $('#menu_typediv').hide(); 
                     $('#department').show(); 
                     $('#menusubcategory_div').hide();  
                     
            if(typeval=="totalsales_consolidate_report_cr")
            {   
                $('#department').show(); 
                 $('#nontax_div').css("display", "block");
                  $('#tax_adsr_div').css("display", "block");
            }else{
                 $('#department').hide();
                 $('#nontax_div').css("display", "none");
                  $('#tax_adsr_div').css("display", "none");
            }
                     
                     
               }else if(modeofview=='item_wise'){
                   $('#menuname_search_div').hide(); 
                   $('#menucategory_div').hide(); 
                    $('#menu_typediv').hide(); 
                     $('#department').hide(); 
                      $('#menusubcategory_div').hide();  
                      
                    $('#hsn_code_div').css("display", "block");  
         
               }else{
                    $('#hsn_code_div').css("display", "none");
                   $('#menuname_search_div').hide(); 
                   $('#menucategory_div').hide(); 
                    $('#menu_typediv').hide(); 
                      $('#department').hide(); 
                     $('#menusubcategory_div').hide();    
               }
               
                if($("#hsn_code").prop('checked') == true){
                var hsn_code='true'; 
                
                $('#hsn_search').show();
                $('#hsn_bill_code_div').show();
                
                
                
             }else{
                var hsn_code='false'; 
                $('#hsn_search').hide();
                $('#hsn_bill_code_div').hide(); 
                
           } 
           
           if($("#hsn_billwise").prop('checked') == true){
                var hsn_billwise='true'; 
                
                
             }else{
                var hsn_billwise='false'; 
                
             } 
           
           
              
		var bydate=$('#bydate').val();
		var fromval=$('#datepickerfrom').val();
		var tot_to=$('#datepickertodt').val();
		var shiftlogin=$('#shiftlogin').val();
                var cashcounter=$('#cashcounter').val();
		var subcategory=$('#subcategory').val();
                
          $.post("load_consolidatedreport.php", { type:typeval,fromdt:fromval,todt:tot_to,bydate:bydate,shiftlogin:shiftlogin,modeofview:modeofview,
              cashcounter:cashcounter,subcategory:subcategory,hsn_code:hsn_code,hsn_billwise:hsn_billwise},                      
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
                                                          $('.confrmation_overlay_proce').css('display','none');
						});		
	});  
        
    $('#hsn_code_search').keyup(function () { 
  
    $('.confrmation_overlay_proce').css('display','block');
    $('.confrmation_overlay_proce').html('<img src="img/ajax-loaders/fetch.gif" />');
    
		var modeofview=$('#summary_detailed').val();
                var typeval=$('#typeval').val();   
                 var department=$('#mode').val();
              
               if(modeofview=='summary'){
                  $('#menuname_search_div').hide(); 
                   $('#menucategory_div').hide(); 
                    $('#menu_typediv').hide(); 
                     $('#department').show(); 
                     $('#menusubcategory_div').hide();  
                     
            if(typeval=="totalsales_consolidate_report_cr")
            {   
                $('#department').show(); 
                 $('#nontax_div').css("display", "block");
                  $('#tax_adsr_div').css("display", "block");
            }else{
                 $('#department').hide();
                 $('#nontax_div').css("display", "none");
                  $('#tax_adsr_div').css("display", "none");
            }
                     
                     
               }else if(modeofview=='item_wise'){
                   $('#menuname_search_div').hide(); 
                   $('#menucategory_div').hide(); 
                    $('#menu_typediv').hide(); 
                     $('#department').hide(); 
                      $('#menusubcategory_div').hide();  
                      
                    $('#hsn_code_div').css("display", "block");  
         
               }else{
                    $('#hsn_code_div').css("display", "none");
                   $('#menuname_search_div').hide(); 
                   $('#menucategory_div').hide(); 
                    $('#menu_typediv').hide(); 
                      $('#department').hide(); 
                     $('#menusubcategory_div').hide();    
               }
               
                if($("#hsn_code").prop('checked') == true){
                var hsn_code='true'; 
                
                $('#hsn_search').show();
                
             }else{
               var hsn_code='false'; 
                $('#hsn_search').hide();
           } 
           
           
           var hsn_code_search=  $('#hsn_code_search').val();
              
		var bydate=$('#bydate').val();
		var fromval=$('#datepickerfrom').val();
		var tot_to=$('#datepickertodt').val();
		var shiftlogin=$('#shiftlogin').val();
                var cashcounter=$('#cashcounter').val();
		var subcategory=$('#subcategory').val();
                
          $.post("load_consolidatedreport.php", { type:typeval,fromdt:fromval,todt:tot_to,bydate:bydate,shiftlogin:shiftlogin,modeofview:modeofview,
              cashcounter:cashcounter,subcategory:subcategory,hsn_code:hsn_code,hsn_code_search:hsn_code_search},                      
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
                                                          $('.confrmation_overlay_proce').css('display','none');
						});		
	});   
        
         
 $('#summary_detailed').change(function () {
  
     $('.confrmation_overlay_proce').css('display','block');
     $('.confrmation_overlay_proce').html('<img src="img/ajax-loaders/fetch.gif" />');
     
	     var modeofview=$(this).val();
             var typeval=$('#typeval').val();   
              var department=$('#mode').val();
              
               if(modeofview=='summary'){
                   
                     $('#menuname_search_div').hide(); 
                     $('#menucategory_div').hide(); 
                     $('#menu_typediv').hide(); 
                     $('#department').show(); 
                     $('#menusubcategory_div').hide();  
                     
            if(typeval=="totalsales_consolidate_report_cr")
            {   
                  $('#department').show(); 
                  $('#nontax_div').css("display", "block");
                  $('#tax_adsr_div').css("display", "block");
            }else{
                
                  $('#department').hide();
                  $('#nontax_div').css("display", "none");
                  $('#tax_adsr_div').css("display", "none");
            }
                     
                     
               }else if(modeofview=='item_wise'){
                   
                     $('#menuname_search_div').hide(); 
                     $('#menucategory_div').hide(); 
                     $('#menu_typediv').hide(); 
                     $('#department').hide(); 
                     $('#menusubcategory_div').hide();  
                      
                    $('#hsn_code_div').css("display", "block");  
         
         
               }else{
                   
                    $('#hsn_code_div').css("display", "none");
                    $('#menuname_search_div').hide(); 
                    $('#menucategory_div').hide(); 
                    $('#menu_typediv').hide(); 
                    $('#department').hide(); 
                    $('#menusubcategory_div').hide();    
               }
               
                if($("#hsn_code").prop('checked') == true){
                    
                var hsn_code='true'; 
             }else{
               var hsn_code='false'; 
           } 
           
               
		var bydate=$('#bydate').val();
		var fromval=$('#datepickerfrom').val();
		var tot_to=$('#datepickertodt').val();
		var shiftlogin=$('#shiftlogin').val();
                var cashcounter=$('#cashcounter').val();
		  var subcategory=$('#subcategory').val();
               $.post("load_consolidatedreport.php", { type:typeval,fromdt:fromval,todt:tot_to,bydate:bydate,shiftlogin:shiftlogin,modeofview:modeofview,
              cashcounter:cashcounter,subcategory:subcategory,hsn_code:hsn_code},                      
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
                              $('.confrmation_overlay_proce').css('display','none');
						});		
	});        
 
    
    
    $('#cashcounter').change(function () {              
		var modeofview=$('#summary_detailed').val();
		var bydate=$('#bydate').val();
        var typeval=$('#typeval').val();
		var fromval=$('#datepickerfrom').val();
		var tot_to=$('#datepickertodt').val();
		var shiftlogin=$('#shiftlogin').val();
        var cashcounter=$('#cashcounter').val();
		$.post("load_consolidatedreport.php", { type:typeval,fromdt:fromval,todt:tot_to,bydate:bydate,shiftlogin:shiftlogin,modeofview:modeofview,cashcounter:cashcounter},                                              
						function(data)
						{
							  data=$.trim(data);						 
							  $('#reportload').html(data);
						});
	});


$('#voucher').change(function () {
        var bydate=$('#bydate').val();
       var typeval=$('#typeval').val();
	  var fromval=$('#datepickerfrom').val();   
		var tot_to=$('#datepickertodt').val();	
                var voucher=$('#voucher').val();
                var voucher1=$('#voucher1').val();             
                var department=$('#mode').val();
                var staff=$('#cashier').val();
                var fromtime=$('#display_timefrom').html();
                var totime=$('#display_timeto').html();
                var day=$('#day').val();
						$.post("load_consolidatedreport.php", { type:typeval,fromdt:fromval,todt:tot_to,voucher:voucher,voucher1:voucher1,bydate:bydate},                                             
						function(data)
						{
							  data=$.trim(data);
						$('#reportload').html(data);
						});
					
	});

$('#creditstaff').change(function() {
		var creditstaff=$('#bycreditstaff').val();
                var credit_staff_company='';
                credit_staff_company= $('#creditstaff').val();
                var status='';
                if($('#credit-outstanding-select').is(":checked")){ status='true' } else{ status='false' };
        var fromval=$('#datepickerfrom').val();
                var typeval=$('#typeval').val();
		var tot_to=$('#datepickertodt').val();
                var bydate=$('#bydate').val();
     $.post("load_consolidatedreport.php", {type:typeval,fromdt:fromval,todt:tot_to,creditstaff:creditstaff,bydate:bydate,checkedstatus:status,credit_staff_company:credit_staff_company},
				function(data)
				   {
					data=$.trim(data);
					$('#reportload').html(data);
				   });
                           
            });
$('#creditcompany').change(function() {
		var creditstaff=$('#bycreditstaff').val();
                var credit_staff_company='';
                credit_staff_company= $('#creditcompany').val();
                var status='';
                if($('#credit-outstanding-select').is(":checked")){ status='true' } else{ status='false' };
       var fromval=$('#datepickerfrom').val();
                var typeval=$('#typeval').val();
		var tot_to=$('#datepickertodt').val();
                var bydate=$('#bydate').val();
    $.post("load_consolidatedreport.php", {type:typeval,fromdt:fromval,todt:tot_to,creditstaff:creditstaff,bydate:bydate,checkedstatus:status,credit_staff_company:credit_staff_company},
				function(data)
				   {
					data=$.trim(data);
					$('#reportload').html(data);
				   });
            });
$('#creditguest').change(function() {
		var creditstaff=$('#bycreditstaff').val();
                var credit_staff_company='';
                credit_staff_company= $('#creditguest').val();
                var status='';
                if($('#credit-outstanding-select').is(":checked")){ status='true' } else{ status='false' };
        var fromval=$('#datepickerfrom').val();
                var typeval=$('#typeval').val();
		var tot_to=$('#datepickertodt').val();
                var bydate=$('#bydate').val();
        $.post("load_consolidatedreport.php", {type:typeval,fromdt:fromval,todt:tot_to,creditstaff:creditstaff,bydate:bydate,checkedstatus:status,credit_staff_company:credit_staff_company},
				function(data)
				   {
					data=$.trim(data);
					$('#reportload').html(data);
				   });                          		
            });            
$('#kitchen').change(function() {
		var fromval=$('#datepickerfrom').val();
                var tot_to=$('#datepickertodt').val();
                var typeval=$('#typeval').val();
		var kitchen=$('#kitchen').val();
                var bydate=$('#bydate').val();
            $.post("load_consolidatedreport.php", {type:typeval,fromdt:fromval,todt:tot_to,kitchen:kitchen,bydate:bydate},
				function(data)
				   {
					data=$.trim(data);
					$('#reportload').html(data);
				   });                          
            });
});
  
  function selectday(d){
      var day="";
        var feildday=$('#day').val();
        if($('#'+d).is(":checked")){
         day=d+',';
        }
        else{
            feildday= feildday.split(d+',').join("");
        }
        if(feildday==""){
        $('#day').val(day);
        }
        else{
             $('#day').val(feildday+day);
        }
                var repttype=$('#typeval').val();
                var tot_to=$('#datepickertodt').val(); 
                var fromval=$('#datepickerfrom').val();
                var fromtime=$('#fromtime').val(); 
                var voucher=$('#voucher').val();
                var mode=$('#mode').val();
                var totime=$('#totime').val();
                var bydate=$('#bydate').val();
                var day=$('#day').val();
                var fromtime=$('#display_timefrom').html();
                var totime=$('#display_timeto').html();
            $.post("load_consolidatedreport.php", {type:repttype,fromdt:fromval,todt:tot_to,bydate:bydate,department:mode,fromtime:fromtime,totime:totime,day:day},
				function(data)
				   {
					data=$.trim(data);
					$('#reportload').html(data);
				   });                      
    }
    function fromtime(time) {

if (time.value !== "") {
  var hours = time.split(":")[0];
  var minutes = time.split(":")[1];
  var suffix = hours >= 12 ? "pm" : "am";
  hours = hours % 12 || 12;
  hours = hours < 10 ? "0" + hours : hours;

  var displayTime = hours + ":" + minutes + " " + suffix;
  document.getElementById("display_timefrom").innerHTML = displayTime;
}

              var repttype=$('#typeval').val();
              var tot_to=$('#datepickertodt').val(); 
              var fromval=$('#datepickerfrom').val();
              var fromtime=$('#fromtime').val(); 
              var voucher=$('#voucher').val();
              var mode=$('#mode').val();
              var totime=$('#totime').val();
              var bydate=$('#bydate').val();
              var day=$('#day').val();
              var fromtime=$('#display_timefrom').html();
              var totime=$('#display_timeto').html();
            
      $.post("load_consolidatedreportcheck.php", {type:repttype,fromdt:fromval,todt:tot_to,bydate:bydate,department:mode,fromtime:fromtime,totime:totime,day:day},
        function(data)
                  {
                    
            data=$.trim(data);
          if(data!="sorry")
                          {
              $.post("load_consolidatedreport.php", {type:repttype,fromdt:fromval,todt:tot_to,bydate:bydate,department:mode,fromtime:fromtime,totime:totime,day:day},
              function(data)
                 {
                  data=$.trim(data);
                  $('#reportload').html(data);
                 });
                          }
                      else
              {
              $('#reportload').empty();	
              $('#rptstatus').css("display", "block");
                  var rptstatus20=$('#rptstatus');
                           
                              rptstatus20.text('No records to display');	
                              $("#rptstatus").delay(1000).fadeOut('slow');
                          }
                
                  });
      


}    
function totime(time1) {
  if (time1.value !== "") {
    var hours = time1.split(":")[0];
    var minutes = time1.split(":")[1];
    var suffix = hours >= 12 ? "pm" : "am";
    hours = hours % 12 || 12;
    hours = hours < 10 ? "0" + hours : hours;
    var displayTime = hours + ":" + minutes + " " + suffix;
    document.getElementById("display_timeto").innerHTML = displayTime;
  }
  var repttype=$('#typeval').val();
                var tot_to=$('#datepickertodt').val(); 
                var fromval=$('#datepickerfrom').val();
                var fromtime=$('#fromtime').val(); 
                var voucher=$('#voucher').val();
                var mode=$('#mode').val();
                var totime=$('#totime').val();
                var bydate=$('#bydate').val();
                var day=$('#day').val();
                var fromtime=$('#display_timefrom').html();
                var totime=$('#display_timeto').html();
				$.post("load_consolidatedreport.php", {type:repttype,fromdt:fromval,todt:tot_to,bydate:bydate,department:mode,fromtime:fromtime,totime:totime,day:day},
				function(data)
				   {
					data=$.trim(data);
					$('#reportload').html(data);
				   });                  
} 



function nontax(status){
    $('.confrmation_overlay_proce').css('display','block');
            $('.confrmation_overlay_proce').html('<img src="img/ajax-loaders/fetch.gif" />');
     		var creditstaff=$('#bycreditstaff').val();
                var credit_staff_company='';
                if(creditstaff!=''){
                    if(creditstaff==2){
                       credit_staff_company= $('#creditstaff').val();
                    }
                    else if(creditstaff==3){
                      credit_staff_company=$('#creditcompany').val();
                    }
                    else if(creditstaff==4){
                       credit_staff_company=$('#creditguest').val();
                    }
                }
		var fromval=$('#datepickerfrom').val();
                var typeval=$('#typeval').val();
		var tot_to=$('#datepickertodt').val();
                var bydate=$('#bydate').val();
                 var modeofview=$('#summary_detailed').val();
               
               if($("#tax_adsr").prop('checked') == true){
                var tax_adsr='true'; 
             }else{
               var tax_adsr='false'; 
           } 
           
          
          
               
         $.post("load_consolidatedreport.php", {modeofview:modeofview,type:typeval,fromdt:fromval,todt:tot_to,creditstaff:creditstaff,bydate:bydate,non_tax:status,credit_staff_company:credit_staff_company,tax_adsr:tax_adsr},
				function(data)
				   {
					data=$.trim(data);
					$('#reportload').html(data);
                                        $('.confrmation_overlay_proce').css('display','none');
          
				   });
 } 
 
 
 function item_disc(status){
     
                $('.confrmation_overlay_proce').css('display','block');
                $('.confrmation_overlay_proce').html('<img src="img/ajax-loaders/fetch.gif" />');
     		var creditstaff=$('#bycreditstaff').val();
                var credit_staff_company='';
                
                if(creditstaff!=''){
                    if(creditstaff==2){
                       credit_staff_company= $('#creditstaff').val();
                    }
                    else if(creditstaff==3){
                      credit_staff_company=$('#creditcompany').val();
                    }
                    else if(creditstaff==4){
                       credit_staff_company=$('#creditguest').val();
                    }
                }
		var fromval=$('#datepickerfrom').val();
                var typeval=$('#typeval').val();
		var tot_to=$('#datepickertodt').val();
                var bydate=$('#bydate').val();
                
                var modeofview=$('#summary_detailed').val();
                
           
           if($("#nontax").prop('checked') == true){
                var non_tax='true'; 
             }else{
                
                non_tax='false'; 
           } 
        
        
     if(status==true){ 
         $('#item_disc_type_div').show();      
   
    }else{
        
         $('#item_disc_type_div').hide();
        }
          
          var department=$('#mode').val();
          
         $.post("load_consolidatedreport.php", {non_tax:non_tax,modeofview:modeofview,type:typeval,fromdt:fromval,todt:tot_to,creditstaff:creditstaff,bydate:bydate,item_disc:status,credit_staff_company:credit_staff_company,department:department},
				function(data)
				   {
					data=$.trim(data);
					$('#reportload').html(data);
                                        $('.confrmation_overlay_proce').css('display','none');
          
				   });
 } 
 
 function item_disc_type(){
     
                $('.confrmation_overlay_proce').css('display','block');
                $('.confrmation_overlay_proce').html('<img src="img/ajax-loaders/fetch.gif" />');
     		var creditstaff=$('#bycreditstaff').val();
                var credit_staff_company='';
                
                if(creditstaff!=''){
                    if(creditstaff==2){
                       credit_staff_company= $('#creditstaff').val();
                    }
                    else if(creditstaff==3){
                      credit_staff_company=$('#creditcompany').val();
                    }
                    else if(creditstaff==4){
                       credit_staff_company=$('#creditguest').val();
                    }
                }
		var fromval=$('#datepickerfrom').val();
                var typeval=$('#typeval').val();
		var tot_to=$('#datepickertodt').val();
                var bydate=$('#bydate').val();
                
                var modeofview=$('#summary_detailed').val();
                
           
           if($("#nontax").prop('checked') == true){
                var non_tax='true'; 
             }else{
                
                non_tax='false'; 
           } 
        
        if($("#item_disc").prop('checked') == true){
                var status='true'; 
             }else{
                
                status='false'; 
           } 
           
         var status1=$('#item_disc_type').val();
         
         var department=$('#mode').val();
         
         $.post("load_consolidatedreport.php", {non_tax:non_tax,modeofview:modeofview,type:typeval,fromdt:fromval,todt:tot_to,creditstaff:creditstaff,bydate:bydate,item_disc:status,credit_staff_company:credit_staff_company,item_disc_type:status1,department:department},
				function(data)
				   {
					data=$.trim(data);
					$('#reportload').html(data);
                                        $('.confrmation_overlay_proce').css('display','none');
          
				   });
 } 
 
 function tax_adsr(status){
     
     $('.confrmation_overlay_proce').css('display','block');
            $('.confrmation_overlay_proce').html('<img src="img/ajax-loaders/fetch.gif" />');
     		var creditstaff=$('#bycreditstaff').val();
                var credit_staff_company='';
                if(creditstaff!=''){
                    if(creditstaff==2){
                       credit_staff_company= $('#creditstaff').val();
                    }
                    else if(creditstaff==3){
                      credit_staff_company=$('#creditcompany').val();
                    }
                    else if(creditstaff==4){
                       credit_staff_company=$('#creditguest').val();
                    }
                }
		var fromval=$('#datepickerfrom').val();
                var typeval=$('#typeval').val();
		var tot_to=$('#datepickertodt').val();
                var bydate=$('#bydate').val();
                
                  var modeofview=$('#summary_detailed').val();
                
           
           if($("#nontax").prop('checked') == true){
                var non_tax='true'; 
             }else{
                
                non_tax='false'; 
           } 
          
                  
         $.post("load_consolidatedreport.php", {non_tax:non_tax,modeofview:modeofview,type:typeval,fromdt:fromval,todt:tot_to,creditstaff:creditstaff,bydate:bydate,tax_adsr:status,credit_staff_company:credit_staff_company},
				function(data)
				   {
					data=$.trim(data);
					$('#reportload').html(data);
                                        $('.confrmation_overlay_proce').css('display','none');
          
				   });
 } 
  function credit_partial_pay(status){
      
       $('#credit-outstanding-select').prop('checked', false);
      
     		var creditstaff=$('#bycreditstaff').val();
                var credit_staff_company='';
                if(creditstaff!=''){
                    if(creditstaff==2){
                       credit_staff_company= $('#creditstaff').val();
                    }
                    else if(creditstaff==3){
                      credit_staff_company=$('#creditcompany').val();
                    }
                    else if(creditstaff==4){
                       credit_staff_company=$('#creditguest').val();
                    }
                }
		var fromval=$('#datepickerfrom').val();
                var typeval=$('#typeval').val();
		var tot_to=$('#datepickertodt').val();
                var bydate=$('#bydate').val();
                
                var status1='false';
                
                var credit_partial_pay='';
              
               if(status==true){
                   
                   credit_partial_pay='Y';
               }else{
                   
                 credit_partial_pay='N';  
               }
      
                
         $.post("load_consolidatedreport.php", {type:typeval,fromdt:fromval,todt:tot_to,creditstaff:creditstaff,bydate:bydate,checkedstatus:status1,
            credit_partial_pay:credit_partial_pay, credit_staff_company:credit_staff_company},
				function(data)
				   {
					data=$.trim(data);
					$('#reportload').html(data);
				   });
 }
 
 
 
 function checkstatus(status){
   
      $('#credit_partial_pay').prop('checked', false);
      
     		var creditstaff=$('#bycreditstaff').val();
                var credit_staff_company='';
                if(creditstaff!=''){
                    if(creditstaff==2){
                       credit_staff_company= $('#creditstaff').val();
                    }
                    else if(creditstaff==3){
                      credit_staff_company=$('#creditcompany').val();
                    }
                    else if(creditstaff==4){
                       credit_staff_company=$('#creditguest').val();
                    }
                }
		var fromval=$('#datepickerfrom').val();
                var typeval=$('#typeval').val();
		var tot_to=$('#datepickertodt').val();
                var bydate=$('#bydate').val();
                
               var credit_partial_pay='N'; 
                
                
         $.post("load_consolidatedreport.php", {type:typeval,fromdt:fromval,todt:tot_to,creditstaff:creditstaff,bydate:bydate,
             credit_partial_pay:credit_partial_pay,checkedstatus:status,credit_staff_company:credit_staff_company},
				function(data)
				   {
					data=$.trim(data);
					$('#reportload').html(data);
				   });
 }   
  </script>
<style>
.search_name_box_main .form-control {
    border-radius: 5px !important;
}
</style>	
</head>
<body>
 <?php  include "includes/topbar_master.php"; ?>

 <?php include "includes/left_menu.php"; ?>
	
   <input type="hidden" id="cloud_api_on" value="<?=$_SESSION['cloud_enable_sync']?>" > 
    
  <div  class="sitemap_cc">Consolidated Reports</div>
  <div id="container">  
  <div class="col-md-12 main_contant_container nopaddding">
    <div class="col-lg-12 col-md-12 report_main_cc" style="padding-top:0px; background-color:rgb(208, 208, 208);">
        <div class="col-lg-12 col-md-12 nopadding" style="background-color:#FCFCFC;  ">
            <div class="header_main_container" style="overflow: visible">
                <div class="col-lg-12 col-md-12 nopadding">
                    <!-- condition starts -->                         
                    <div class="col-lg-12 col-md-12 nopadding top_main_cc">
                        <div class="col-lg-2 col-md-2 no-padding filter_txt_cc"><div class="filter_heading filter_head_1">Select</div></div>
                        <div class="search_name_box_main report_check_box_cc" style="margin-top: 2px;">
                            <!-- type starts -->
                            <div class="search_name_box_main" style="width: 21%;">
                                <div class="text-selection_name">Type</div>
                                   <div class="input-group" style="width: 96%;">
                                         <select  class="form-control add_new_dropdown_report" name="typeval" id="typeval" onChange="reportcreate(this.value)" >
                                                 <option value="">Type of report</option>                                      
                                           <?php  
                                         $sql_login  =  $database->mysqlQuery("select rm_reportid,rm_printa4,rm_posprintofanother,rm_reportname from tbl_reportmaster where rm_reportview='Y' and rm_reporttype='CR'"); 
                                        $num_login   = $database->mysqlNumRows($sql_login);
                                        if($num_login){
                                            while($result_login  = $database->mysqlFetchArray($sql_login)) 
                                              { 
											  if($result_login['rm_reportid']=="portion_order")
											  {?>
                                               <option value="<?=$result_login['rm_reportid']?>" printtype="<?=$result_login['rm_printa4']?>" printername="" printof="<?=$result_login['rm_posprintofanother']?>"><?=$_SESSION['s_portionname']?> Ordered</option>
                                              <?php
											  }else{
											  ?>
                                      		  <option value="<?=$result_login['rm_reportid']?>" printtype="<?=$result_login['rm_printa4']?>" printername="" printof="<?=$result_login['rm_posprintofanother']?>"><?=$result_login['rm_reportname']?></option>
                                      		<?php } ?>
                                          <?php }} ?>
                                         </select>    
                                  </div>
                            </div>
                            <!-- type ends -->                         
                            <div id="cashierdiv" style="display:none" >
                             <div class="search_name_box_main">
                                <div class="text-selection_name">Settling Staff</div>
                                   <div class="input-group" style="width: 55%;">
                                         <select  class="form-control add_new_dropdown_report" onChange="reportcreate(this.value)" name="cashier" id="cashier">
                                                 <option value="">All</option>                                        
                                           <?php  
                                         $sql_loginstaff  =  $database->mysqlQuery("select ls_username as login from tbl_logindetails "); 
                                        
                                         $num_loginstaff   = $database->mysqlNumRows($sql_loginstaff);
                                        if($num_loginstaff){
                                            while($result_loginstaff  = $database->mysqlFetchArray($sql_loginstaff)) 
                                              { 
						?>					
                                               <option value="<?=$result_loginstaff['login']?>" ><?=$result_loginstaff['login']?></option>
                                           <?php
                                        }}
                                              ?>
                                         </select>    
                                  </div>
                            </div>
                            </div>
                            
                             <div id="bank_div" style="display:none" >
                             <div class="search_name_box_main">
                                <div class="text-selection_name">Bank</div>
                                   <div class="input-group" style="width: 55%;">
                                         <select  class="form-control add_new_dropdown_report" onChange="reportcreate(this.value)" name="bank_name" id="bank_name">
                                                 <option value="">All</option>                                                 
                        <?php  
                        $sql_login  =  $database->mysqlQuery("select bm_id,bm_name from tbl_bankmaster where bm_active='Y'"); 
						$num_login   = $database->mysqlNumRows($sql_login);
						if($num_login){
                             while($result_login  = $database->mysqlFetchArray($sql_login)) 
                                { ?>
                                <option value="<?=$result_login['bm_id']?>"><?=$result_login['bm_name']?></option>
                                <?php }} ?>         
                                         </select>    
                                  </div>
                            </div>
                            </div>
                            
                            <div id="card_div" style="display:none" >
                             <div class="search_name_box_main">
                                <div class="text-selection_name">Card</div>
                                   <div class="input-group" style="width: 55%;">
                                         <select  class="form-control add_new_dropdown_report" onChange="reportcreate(this.value)" name="card_name" id="card_name">
                                                 <option value="">All</option>                                                 
                        <?php  
                        $sql_login  =  $database->mysqlQuery("select crd_id,crd_name from tbl_cardmaster"); 
						$num_login   = $database->mysqlNumRows($sql_login);
						if($num_login){
                             while($result_login  = $database->mysqlFetchArray($sql_login)) 
                                { ?>
                                <option value="<?=$result_login['crd_id']?>"><?=$result_login['crd_name']?></option>
                                <?php }} ?>         
                                         </select>    
                                  </div>
                            </div>
                            </div>
                            
                            <div id="department" style="display:none" >
                             <div class="search_name_box_main">
                                <div class="text-selection_name">Mode</div>
                                   <div class="input-group" style="width: 55%;">
                                         <select  class="form-control add_new_dropdown_report" onChange="reportcreate(this.value)" name="mode" id="mode">
                                                 <option value="">All</option>
                                                 <option value="DI">Dine In</option>
                                                 <option value="TA">Take Away</option>
                                                 <option value="CS">Counter Sale</option>
                                                 <option value="HD">Home Delivery</option>
                                         </select>    
                                  </div>
                            </div>
                            </div>
                            <div id="creditdetailsdiv" style="display:none" >
                                <div style="width: 20%;" class="search_name_box_main">
                                    <div class="text-selection_name">Category:</div>
                                        <div class="input-group">
                                            <select  class="form-control add_new_dropdown_report" name="bycreditstaff" id="bycreditstaff">
                                              <option value="">All</option>
                                                <?php  
                        $sql_login  =  $database->mysqlQuery("select ct_creditid,ct_credit_type from tbl_credit_types where ct_active='Y'"); 
						$num_login   = $database->mysqlNumRows($sql_login);
						if($num_login){
                        while($result_login  = $database->mysqlFetchArray($sql_login)) 
                                                    { ?>
                                                  <option value="<?=$result_login['ct_creditid']?>"><?=$result_login['ct_credit_type']?></option>
                                                <?php }} ?>
                                            </select>   
                                        </div>
                                </div>
                            </div>                        
                            <div id="menuname_search_div" style="display:none" >
                                <div style="width: 20%;" class="search_name_box_main">
                                    <div class="text-selection_name">Menu:</div>
                                        <div class="input-group">
                                            <input class="form-control add_new_dropdown_report" type="text" id="menuname_search" name="menuname_search" >
                                        </div>
                                </div>
                            </div>                            
                             <div id="menucategory_div" style="display:none" >
                                <div style="width: 17%;" class="search_name_box_main">
                                    <div class="text-selection_name">Main Category:</div>
                                        <div class="input-group">
                                            <select  class="form-control add_new_dropdown_report" name="menucategory" id="menucategory">
                                              <option value="">All</option>
                                                <?php  
                        $sql_login_ct  =  $database->mysqlQuery("select mmy_maincategoryid,mmy_maincategoryname from tbl_menumaincategory where mmy_active='Y'"); 
						$num_login_ct   = $database->mysqlNumRows($sql_login_ct);
						if($num_login_ct){
                                                    while($result_login_ct  = $database->mysqlFetchArray($sql_login_ct)) 
                                                    { ?>
                                                  <option value="<?=$result_login_ct['mmy_maincategoryid']?>"><?=$result_login_ct['mmy_maincategoryname']?></option>
                                                <?php }} ?>
                                            </select>   
                                        </div>
                                </div>
                            </div>                          
                            <div id="menusubcategory_div" style="display:none" >
                                <div style="width: 17%;" class="search_name_box_main">
                                    <div class="text-selection_name">Sub Category:</div>
                                        <div class="input-group">
                                            <select  class="form-control add_new_dropdown_report" name="subcategory" id="subcategory">
                                              <option value="">All</option>
                                                <?php  
                        $sql_login_ct  =  $database->mysqlQuery("select msy_subcategoryid,msy_subcategoryname from tbl_menusubcategory where msy_active='Y'"); 
						$num_login_ct   = $database->mysqlNumRows($sql_login_ct);
						if($num_login_ct){
                                 while($result_login_ct  = $database->mysqlFetchArray($sql_login_ct)) 
                                                    { ?>
                                      <option value="<?=$result_login_ct['msy_subcategoryid']?>"><?=$result_login_ct['msy_subcategoryname']?></option>
                                                <?php }} ?>
                                            </select>   
                                        </div>
                                </div>
                            </div>                           
                            <div id="creditperson-companydiv" style="display:none" >
                                <div style="width: 20%;" class="search_name_box_main">
                                    <div class="text-selection_name">Credit Person/Company</div>
                                        <div class="input-group">
                                            <select  class="form-control add_new_dropdown_report" name="creditstaff" id="creditstaff" style="display:none">
                                              <option value="">Select Credit Person</option>
                                                <?php  
                                                $sql_login_staff  =  $database->mysqlQuery("select distinct(crd_staffid),ser_firstname from tbl_credit_master left join tbl_staffmaster on ser_staffid=crd_staffid where crd_staffid !='' "); 
						$num_login_staff   = $database->mysqlNumRows($sql_login_staff);
						if($num_login_staff){
                                                    while($result_login_staff  = $database->mysqlFetchArray($sql_login_staff)) 
                                                    { ?>
                                                  <option value="<?=$result_login_staff['crd_staffid']?>"><?=$result_login_staff['ser_firstname']?></option>
                                                <?php }} ?>
                                            </select>
                                            
                                            <select  class="form-control add_new_dropdown_report" name="creditcompany" id="creditcompany" style="display:none">
                                              <option value="">Select Credit Company </option>
                                                <?php  
                                                $sql_login_company  =  $database->mysqlQuery("select distinct(crd_corporateid),ct_corporatename from tbl_credit_master left join tbl_corporatemaster on ct_corporatecode=crd_corporateid where crd_corporateid !=''"); 
						$num_login_company   = $database->mysqlNumRows($sql_login_company);
						if($num_login_company){
                                                    while($result_login_company  = $database->mysqlFetchArray($sql_login_company)) 
                                                    { ?>
                                                  <option value="<?=$result_login_company['crd_corporateid']?>"><?=$result_login_company['ct_corporatename']?></option>
                                                <?php }} ?>
                                            </select>
                                            
                                            <select  class="form-control add_new_dropdown_report" name="creditguest" id="creditguest" style="display:none">
                                              <option value="">Select Credit Guest</option>
                                                <?php  
                                                $sql_login_guest  =  $database->mysqlQuery("select distinct(crd_guestid),ly_mobileno,ly_firstname from tbl_credit_master left join tbl_loyalty_reg on ly_id=crd_guestid where crd_guestid !='' "); 
						$num_login_guest   = $database->mysqlNumRows($sql_login_guest);
						if($num_login_guest){
                                                    while($result_login_guest  = $database->mysqlFetchArray($sql_login_guest)) 
                                                    { ?>
                                                  <option value="<?=$result_login_guest['crd_guestid']?>"><?=$result_login_guest['ly_firstname'].' - '.$result_login_guest['ly_mobileno']?></option>
                                                <?php }} ?>
                                            </select>
                                        </div>
                                </div>
                            </div>                           
                                <div id="kitchen-div" style="display:none" >
                                <div class="search_name_box_main">
                                <div class="text-selection_name">Kitchen</div>
                                   <div class="input-group" style="width: 55%;">
                                         <select  class="form-control add_new_dropdown_report" onChange="reportcreate(this.value)" name="kitchen" id="kitchen">                                               
                                             <option value="">All</option>
                                           <?php  
                                         $sql_kitchen  =  $database->mysqlQuery("select kr_kotcode,kr_kotname from tbl_kotcountermaster  order by kr_kotname ASC  "); 
                                        
                                         $num_kitchen   = $database->mysqlNumRows($sql_kitchen);
                                        if($num_kitchen){
                                            while($result_kitchen  = $database->mysqlFetchArray($sql_kitchen)) 
                                              {
						?>					
                                               <option value="<?=$result_kitchen['kr_kotcode']?>" > <?=$result_kitchen['kr_kotname']?></option>
                                           <?php
                                        }}
                                              ?>
                                         </select>    
                                  </div>
                            </div>
                            </div>       
                            <div id="exp_div_acc" style="display:none" >
                                <div class="search_name_box_main">
                                <div class="text-selection_name">Type</div>
                                   <div class="input-group" style="width: 55%;">
                                         <select  class="form-control add_new_dropdown_report"  name="exp_type_acc" id="exp_type_acc">
                                             <option value="">All</option>                                           
                                              <option value="exp_acc">Expense Voucher</option>
                                              <option value="sup_acc">Supplier Voucher</option>
                                               <option value="emp_acc">Employee Voucher</option>
                                               <option value="asset_acc">Asset Supplier Voucher</option>
                                               <option value="loan_acc">Loan Voucher</option>
                                         </select>    
                                  </div>
                            </div>
                            </div>

                            <div id="pur_div_acc" style="display:none" >
                                <div class="search_name_box_main">
                                <div class="text-selection_name">Type</div>
                                   <div class="input-group" style="width: 55%;">
                                         <select  class="form-control add_new_dropdown_report"  name="pur_type_acc" id="pur_type_acc">
                                             <option value="">All</option>                                                                                        
                                              <option value="sup_acc">Supplier Voucher</option>
                                               <option value="asset_acc">Asset Supplier Voucher</option>
                                         </select>    
                                  </div>
                            </div>
                            </div>

                            <div id="comp_item_div" style="display:none" >
                                <div class="search_name_box_main">
                                <div class="text-selection_name">Type</div>
                                   <div class="input-group" style="width: 55%;">
                                         <select  class="form-control add_new_dropdown_report"  name="comp_item" id="comp_item">
                                           <option value="normal">Normal Items</option>
                                            <option value="comp">Complimentory Items</option>
                                            </select>    
                                  </div>
                            </div>
                            </div>
                            <div id="taxtypediv" style="display:none" >
                                 <div class="search_name_box_main" style="width: 17%;">
                                <div class="text-selection_name">Tax Type</div>
                              <div class="input-group" style="width:80%;float: left;display:none" id="tax_all">
                                        <select multiple="multiple"   class="form-control add_new_dropdown_report multi_sel_report" onChange="reportcreate(this.value)" name="taxtype" id="taxtype">                                            
                                           <?php  
                                         $sql_logintaxall  =  $database->mysqlQuery(" SELECT amc_id,amc_name,amc_value FROM tbl_extra_tax_master ");                                         
                                         $num_logintaxall   = $database->mysqlNumRows($sql_logintaxall);
                                        if($num_logintaxall){
                                            while($result_logintaxall  = $database->mysqlFetchArray($sql_logintaxall)) 
                                              { ?>					
                                               <option value="<?=$result_logintaxall['amc_id']?>" > <?=$result_logintaxall['amc_name']?> ( <?=$result_logintaxall['amc_value']?>%)  </option>
                                           <?php
                                        }} ?>
                                         </select>    
                                  </div>
                             </div>
                            </div>
                            <div id="payment_div" style="display:none" >
                             <div class="search_name_box_main">
                                <div class="text-selection_name">Payment Type</div>
                               <div class="input-group" style="width:40%;float: left;">
                                        <select    class="form-control add_new_dropdown_report multi_sel_report" onChange="reportcreate(this.value)" name="paytype" id="paytype">
                                            <option value="all">All</option>   
                                           <?php  
                                         $sql_pay  =  $database->mysqlQuery(" SELECT pym_id,pym_name FROM tbl_paymentmode where pym_active='Y' "); 
                                        
                                         $num_pay   = $database->mysqlNumRows($sql_pay);
                                        if($num_pay){
                                            while($result_pay  = $database->mysqlFetchArray($sql_pay)) 
                                              {  ?>					
                                               <option value="<?=$result_pay['pym_id']?>" > <?=$result_pay['pym_name']?>   </option>
                                           <?php
                                        }} ?>
                                         </select>    
                                  </div>                        
                            </div>
                            </div>
                            <div id="from_acc_div" style="display:none" >
                             <div class="search_name_box_main">
                                <div class="text-selection_name">From Acc</div>
                               <div class="input-group" style="width:40%;float: left;">
                                        <select    class="form-control "  name="from_acc" id="from_acc">
                                            <option value="">All</option>   
                                           <?php  
                                         $sql_pay  =  $database->mysqlQuery(" SELECT tlm_id,tlm_vendor_id,tlm_staff_id,tlm_ledger_name FROM tbl_ledger_master  ");                                       
                                         $num_pay   = $database->mysqlNumRows($sql_pay);
                                        if($num_pay){
                                            while($result_pay  = $database->mysqlFetchArray($sql_pay)) 
                                              { ?>					
                                               <option value="<?=$result_pay['tlm_id'].'*'.$result_pay['tlm_vendor_id'].'*'.$result_pay['tlm_staff_id']?>" > <?=$result_pay['tlm_ledger_name']?>   </option>
                                           <?php
                                        }} ?>
                                         </select>    
                                  </div>
                             </div>
                            </div>
                            <div id="to_acc_div" style="display:none" >
                             <div class="search_name_box_main">
                                <div class="text-selection_name">To Acc</div>
                               <div class="input-group" style="width:40%;float: left;">
                                        <select    class="form-control" name="to_acc" id="to_acc">
                                            <option value="">All</option>   
                                           <?php  
                                         $sql_pay  =  $database->mysqlQuery(" SELECT tlm_id,tlm_vendor_id,tlm_staff_id,tlm_ledger_name FROM tbl_ledger_master  "); 
                                        
                                         $num_pay   = $database->mysqlNumRows($sql_pay);
                                        if($num_pay){
                                            while($result_pay  = $database->mysqlFetchArray($sql_pay)) 
                                              { ?>					
                                               <option value="<?=$result_pay['tlm_id'].'*'.$result_pay['tlm_vendor_id'].'*'.$result_pay['tlm_staff_id']?>" > <?=$result_pay['tlm_ledger_name']?>   </option>
                                           <?php
                                        }}?>
                                         </select>    
                                  </div>
                            </div>
                            </div>
                            <div id="cashcounterdiv" style="display:none" >
                             <div class="search_name_box_main">
                                <div class="text-selection_name">Cash Counter</div>
                                   <div class="input-group" style="width: 55%;">
                                         <select  class="form-control add_new_dropdown_report" onChange="reportcreate(this.value)" name="cashcounter" id="cashcounter">
                                             <option value="">All</option>
                                           <?php  
						$sql_login_counter  =  $database->mysqlQuery("select distinct( sd.sd_open_machineid),em.cm_ip_address,cm_ip_remarks from tbl_shift_details sd left join tbl_expodine_machines em  on em.cm_ip_address=sd.sd_open_machineid order by cm_id "); 
						$num_login_counter   = $database->mysqlNumRows($sql_login_counter);
						if($num_login_counter){
                                                    while($result_login_counter  = $database->mysqlFetchArray($sql_login_counter)) 
                                                    { ?>
                                                        <option value="<?=$result_login_counter['cm_ip_address']?>"><?=$result_login_counter['cm_ip_remarks']?></option>
                                                  <?php }} ?>
                                         </select>    
                                  </div>
                            </div>
                            </div>
                           <div id="shiftlogindiv" style="display:none" >
                             <div class="search_name_box_main">
                                <div class="text-selection_name">Shift Login</div>
                                   <div class="input-group" style="width: 55%;">
                                         <select  class="form-control add_new_dropdown_report" onChange1="reportcreate(this.value)" name="shiftlogin" id="shiftlogin">
                                             <option value="all">All</option>
                                           <?php  
											  $sql_login_st  =  $database->mysqlQuery("select ser_staffid,ser_firstname from tbl_staffmaster where ser_shift_permission='Y'"); 
													$num_login_st   = $database->mysqlNumRows($sql_login_st);
													if($num_login_st){
														while($result_login_st  = $database->mysqlFetchArray($sql_login_st)) 
														  { ?>
                                                  <option value="<?=$result_login_st['ser_staffid']?>"><?=$result_login_st['ser_firstname']?></option>
                                                  <?php }} ?>
                                         </select>    
                                  </div>
                            </div>
                            </div>
                            <!-- date starts --> 
                            <div id="voucherdiv" style="display:none" >
                             <div class="search_name_box_main">
                                <div class="text-selection_name">Voucher Head</div>
                                   <div class="input-group" style="width: 55%;">
                                         <select  class="form-control add_new_dropdown_report" onChange="reportcreate(this.value)" name="voucher" id="voucher">
                                                 <option value="">All</option>
                                         <?php  
                                         $sql_login  =  $database->mysqlQuery("select distinct(vh_vouchername) from tbl_voucherhead left join tbl_voucherpayment on vp_vhid= vh_id"); 
                                        $num_login   = $database->mysqlNumRows($sql_login);
                                        if($num_login){
                                            while($result_login  = $database->mysqlFetchArray($sql_login)) 
                                              { ?>					
                                               <option value="<?=$result_login['vh_vouchername']?>" ><?=$result_login['vh_vouchername']?></option>
                                           <?php
                                        }}?>
                                         </select>    
                                  </div>
                            </div>
                            </div>
                            <div id="voucherdiv1" style="display:none" >
                             <div class="search_name_box_main">
                                <div class="text-selection_name">Voucher Type</div>
                                   <div class="input-group" style="width: 55%;">
                                         <select  class="form-control add_new_dropdown_report" onChange="reportcreate(this.value)" name="voucher1" id="voucher1">
                                           <?php  
                                         $sql_login3  =  $database->mysqlQuery("select distinct(vp_type) from  tbl_voucherpayment"); 
                                        $num_login3   = $database->mysqlNumRows($sql_login3);
                                        if($num_login3){
                                            while($result_login  = $database->mysqlFetchArray($sql_login3)) 
                                              { ?>					
                                               <option value="<?=$result_login['vp_type']?>" ><?=$result_login['vp_type']?></option>
                                           <?php
                                        }}?>
                                         </select>    
                                  </div>
                            </div>
                            </div>
                            <div id="voucher_login_div" style="display:none" >
                             <div class="search_name_box_main">
                                <div class="text-selection_name">Approved By</div>
                                   <div class="input-group" style="width: 55%;">
                                         <select  class="form-control add_new_dropdown_report" onChange="reportcreate(this.value)" name="voucher_login" id="voucher_login">
                                             <option value="">All</option>
                                           <?php  
                                         $sql_login3  =  $database->mysqlQuery("select distinct(vp_approvedby),ser_firstname from  tbl_voucherpayment  left join tbl_staffmaster on ser_staffid=vp_approvedby "); 
                                        $num_login3   = $database->mysqlNumRows($sql_login3);
                                        if($num_login3){
                                            while($result_login  = $database->mysqlFetchArray($sql_login3)) 
                                              { ?>					
                                               <option value="<?=$result_login['vp_approvedby']?>" ><?=$result_login['ser_firstname']?></option>
                                           <?php
                                        }}?>
                                         </select>    
                                  </div>
                            </div>
                            </div>
                            <div id="floor_wise_div" style="display:none" >
                             <div class="search_name_box_main">
                                <div class="text-selection_name">Floor</div>
                                   <div class="input-group" style="width: 55%;">
                                         <select  class="form-control add_new_dropdown_report" onChange="reportcreate(this.value)" name="floor_di" id="floor_di">
                                            <option value="">All</option>
                                           <?php  
                                         $sql_login3  =  $database->mysqlQuery("select fr_floorid,fr_floorname from tbl_floormaster where fr_status='Active' "); 
                                        $num_login3   = $database->mysqlNumRows($sql_login3);
                                        if($num_login3){
                                            while($result_login  = $database->mysqlFetchArray($sql_login3)) 
                                              { ?>					
                                               <option value="<?=$result_login['fr_floorid']?>"><?=$result_login['fr_floorname']?></option>
                                           <?php
                                        }}?>
                                         </select>    
                                  </div>
                            </div>
                            </div>
                            
                            <div id="deliveryboy_div_hd" style="display:none">
                                   <div class="search_name_box_main">
                                    <div class="text-selection_name">Delivery Staff</div>
                                     <div class="input-group">
                                         <select  class="form-control add_new_dropdown_report" name="staff_hd" id="staff_hd">
                                              <option value="null" default>All</option>
                                            <?php
                                            $sql_staff  =  $database->mysqlQuery("SELECT ser_staffid, ser_firstname, ser_lastname 
                                            FROM tbl_staffmaster sm
                                            left join tbl_designationmaster dm on dm.dr_designationid = sm.ser_designation
                                            WHERE sm.ser_employeestatus = 'Active' AND dm.dr_designationname = 'Delivery Boy'"); 
                                            $num_staff   = $database->mysqlNumRows($sql_staff);
                                            if($num_staff){
                                                while($result_staff  = $database->mysqlFetchArray($sql_staff)) {
                                                    echo '<option value="'.$result_staff['ser_staffid'].'">'.$result_staff['ser_firstname'].'</option>';
                                                }
                                                } ?>
                                          </select>   
                                    </div>
                                 </div>
                                  </div>
                            
                            <div id="ta_login_staff_div" style="display:none" >
                             <div class="search_name_box_main">
                                <div class="text-selection_name">Login Staff</div>
                                   <div class="input-group" style="width: 55%;">
                                         <select  class="form-control add_new_dropdown_report" onChange="reportcreate(this.value)" name="staff_ta" id="staff_ta">
                                             <option value="">All</option>
                                          <?php
                                            $sql_logstaff  =  $database->mysqlQuery("select ls_username as login from tbl_logindetails"); 
                                            $num_logstaff   = $database->mysqlNumRows($sql_logstaff);
                                            if($num_logstaff){
                                                while($result_logstaff  = $database->mysqlFetchArray($sql_logstaff)) {
                                                    echo '<option value="'.$result_logstaff['login'].'">'.$result_logstaff['login'].'</option>';
                                                }
                                                } ?>
                                         </select>    
                                  </div>
                            </div>
                            </div>
                            
                            <div id="dailysalesstatmentdate" style="display:none">
                             <div class="search_name_box_main">
                                    <div class="text-selection_name">Date:</div>
                                     <div class="input-group">
                                         <input type="text" class="form-control" id="date" >     
                                    </div>
                                 </div>   
                            </div>
                           <div id="totalsalesdiv" style="display:none" >
                            <div class="search_name_box_main" id="datepickerfromdiv" style="display:block;width: 10%;">
                                    <div class="text-selection_name">Date From:</div>
                                     <div class="input-group">
                                         <input style="cursor:pointer" readonly onclick="this.removeAttribute('readonly');"  type="text" class="form-control" id="datepickerfrom" >     
                                    </div>
                                 </div>
                                 <div class="search_name_box_main" id="datepickertodtdiv" style="display:block;width: 10%;">
                                    <div class="text-selection_name">Date To  :</div>
                                     <div class="input-group">
                                         <input style="cursor:pointer" readonly onclick="this.removeAttribute('readonly');" type="text" class="form-control" id="datepickertodt" >            
                                    </div>
                                 </div>
                <div class="search_name_box_main" id="bydatediv" style="display:block;width: 10%;">
            	<div class="text-selection_name">By Date</div>
                  <div class="input-group">
                <select class="form-control add_new_dropdown_report" name="bydate" id="bydate" >
               <option value="" default>--Select--</option>
                <option value="Today" >Today</option>
                 <option value="Yesterday" >Yesterday</option>
                    <option value="Last5days">Last 5 days</option>
                        <option value="Last10days">Last 10 days</option>
                         <option value="Last15days">Last 15 days</option>
                          <option value="Last20days">Last 20 days</option>
                           <option value="Last25days">Last 25 days</option>
                            <option value="Last30days">Last 30 days</option>
                              <option value="Last1month">Last 1 month</option>
                            <option value="Last90days">Last 3 months</option>
                                <option value="Last180days">Last 6 months</option>
                                <option style="display: none " value="Last365days">Last 1 year</option>
                    </select>
                </div>
            </div> 
                                <div id="summary_detaileddiv" style="display:none" >
                             <div class="search_name_box_main">
                                <div class="text-selection_name">View Mode</div>
                                   <div class="input-group" style="width: 55%;">
                                         <select  class="form-control add_new_dropdown_report" onChange="reportcreate(this.value)" name="summary_detailed" id="summary_detailed">
                                               <option value="detailed">Detailed</option>   
                                             <option value="summary">Summary</option>
                                             <option value="item_wise">Item Wise</option>
                                         </select>    
                                  </div>
                            </div>
                            </div>
                               
                               
                               <div id="phone_order_div"  style="display:none" >
                             <div class="search_name_box_main">
                                <div class="text-selection_name">Type</div>
                                   <div class="input-group" style="width: 55%;">
                                         <select  class="form-control add_new_dropdown_report" name="phone_order" id="phone_order">
                                             <option value="N">Normal</option>
                                             <option value="P">Phone order</option>
                                         </select>    
                                  </div>
                            </div>
                            </div>
                               
                               
                            <div id="menu_typediv" style="display:none;" >
                             <div class="search_name_box_main" style="width: 10%;">
                                <div class="text-selection_name">Menu Type</div>
                                   <div class="input-group" style="width: 55%;">
                                         <select  class="form-control add_new_dropdown_report" onChange="reportcreate(this.value)" name="menu_type" id="menu_type">
                                              <option value="">All</option>
                                              <option value="N">Normal Menus</option>
                                             <option value="Y">Addon Menus</option>
                                             <option value="combo">Combo Menus</option>
                                         </select>    
                                  </div>
                            </div>
                            </div>
                               
                              <div class="search_name_box_main" id="credit-outstanding" style="display:none;    margin-top: 13px;">
                                    <p><strong>Credit Outstanding :</strong>
                                    <input type="checkbox" id="credit-outstanding-select"  onclick="return checkstatus(this.checked)"></p> 
                                </div> 
                              
                                <div class="search_name_box_main" id="credit_partial_pay_div" style="display:none;    margin-top: 13px;">
                                    <p><strong>Credit Partial Pay :</strong>
                                    <input type="checkbox" id="credit_partial_pay"  onclick="return credit_partial_pay(this.checked)"></p> 
                                </div> 
                               
                                <div class="search_name_box_main" id="nontax_div" style="display:none;    margin-top: 13px;">
                                    <p><strong>Non Taxable :</strong>
                                    <input type="checkbox" id="nontax"  onclick="return nontax(this.checked)"></p> 
                                </div>  
                               
                                <div class="search_name_box_main" id="tax_adsr_div" style="display:none;margin-top: 13px;margin-left: -25px;">
                                    <p><strong>Tax :</strong>
                                    <input type="checkbox" id="tax_adsr"  onclick="return tax_adsr(this.checked)"></p> 
                                </div>   
                               
                               
                                <div class="search_name_box_main" id="item_disc_div" style="display:none;margin-top: 13px;margin-left: 5px;">
                                    <p><strong>Item Wise Discount :</strong>
                                    <input type="checkbox" id="item_disc"  onclick="return item_disc(this.checked)"></p> 
                                </div>   
                               
                               
                                <div class="search_name_box_main" id="revenue_best" style="display:none;margin-top: 13px;margin-left: 5px;">
                                    <p><strong> Most Revenue : </strong>
                                        <input type="checkbox" id="most_revenue" checked onclick="return revenue_best(this.checked)"></p> 
                                   
                                </div>  
                               
                               
                               <div class="search_name_box_main" id="revenue_best1" style="display:none;margin-top: 13px;margin-left: 5px;">
                                   
                                    <p><strong> &nbsp;Best Selling : </strong>
                                    <input type="checkbox" id="best_selling"  onclick="return revenue_best(this.checked)"></p> 
                                    
                                    
                                </div>  
                               
                               
                               <div class="search_name_box_main" id="comp_item_wise_div" style="display:none;margin-top: 13px;margin-left: 5px;">
                                   
                                    <p><strong> &nbsp;Item Wise: </strong>
                                    <input type="checkbox" id="comp_item_wise"  onclick="return comp_item_wise(this.checked)"></p> 
                                    
                                    
                                </div> 
                               
                               
                               <div class="search_name_box_main" id="hsn_code_div" style="display:none;margin-top: 13px;margin-left: 5px;">
                                   
                                    <p><strong> &nbsp;HSN: </strong>
                                    <input type="checkbox" id="hsn_code"  onclick="return hsn_code(this.checked)"></p> 
                                    
                                    
                                </div> 
                               
                               <div class="search_name_box_main" id="hsn_bill_code_div" style="display:none;margin-top: 13px;margin-left: -28px;">
                                   
                                    <p><strong> &nbsp;HSN Bill Wise: </strong>
                                    <input type="checkbox" id="hsn_billwise"  onclick="return hsn_code(this.checked)"></p> 
                                    
                                    
                                </div> 
                               
                             <div id="hsn_search" style="display:none" >
                             <div class="search_name_box_main">
                                <div class="text-selection_name">HSN Code</div>
                                   <div class="input-group" style="width: 55%;">
                                         <input  class="form-control add_new_dropdown_report"  name="hsn_code_search" id="hsn_code_search">
                                                
                                  </div>
                            </div>
                            </div>
                               
                               
                               
                               
                               
                               <div id="item_disc_type_div" style="display:none;" >
                             <div class="search_name_box_main" style="width: 10%;">
                                <div class="text-selection_name">Item Discount</div>
                                   <div class="input-group" style="width: 55%;">
                                         <select  class="form-control add_new_dropdown_report" onChange="item_disc_type()" name="item_disc_type" id="item_disc_type">
                                              <option value="">All</option>
                                             <?php
                                            $sql_logstaff  =  $database->mysqlQuery("select * from tbl_discountmaster where ds_item_discount='Y'"); 
                                            $num_logstaff   = $database->mysqlNumRows($sql_logstaff);
                                            if($num_logstaff){
                                                while($result_logstaff  = $database->mysqlFetchArray($sql_logstaff)) {
                                                    echo '<option value="'.$result_logstaff['ds_discountid'].'">'.$result_logstaff['ds_discountname'].'</option>';
                                                }
                                                } ?>
                                         </select>    
                                  </div>
                            </div>
                            </div>
                               
                               
                               
                               
                <div class="search_name_box_main" id="daydiv" style="display:none">
            	<div class="text-selection_name">Day:</div>
                  <div class="input-group">
                      <input type="text" class="form-control add_new_dropdown_report" name="day" id="day" value="" placeholder="Click to select day">
                <div class="mutliSelect" id="dayselector" style="display:none">
            <ul>
                <li>
                    <input type="checkbox" value="Sunday" id="Sunday" onClick="return selectday(this.value)"/>Sunday</li>
                <li>
                    <input type="checkbox" value="Monday" id="Monday" onClick="return selectday(this.value)"/>Monday</li>
                <li>
                    <input type="checkbox" value="Tuesday"  id="Tuesday"onClick="return selectday(this.value)"/>Tuesday</li>
                <li>
                    <input type="checkbox" value="Wednesday"  id="Wednesday"onClick="return selectday(this.value)" />Wednesday</li>
                <li>
                    <input type="checkbox" value="Thursdy"  id="Thursdy" onClick="return selectday(this.value)"/>Thursday</li>
                <li>
                    <input type="checkbox" value="Friday" id="Friday"  onClick="return selectday(this.value,this.status)"/>Friday</li>
                <li>
                    <input type="checkbox" value="Saturday" id="Saturday"  onClick="return selectday(this.value,this.status)"/>Saturday</li>
            </ul>
        </div>
               </div>
                </div>
                <div class="search_name_box_main" id="fromtimediv" style="display:none">
            	<div class="text-selection_name">From Time:</div>
                  <div class="input-group">
                <input type="time" class="form-control add_new_dropdown_report" name="fromtime" id="fromtime" onchange="fromtime(this.value)">
                <span id="display_timefrom" style="display:none"></span>
                  </div>
                </div>         
                <div class="search_name_box_main" id="totimediv" style="display:none">
            	<div class="text-selection_name">To Time:</div>
                  <div class="input-group">
                <input type="time" class="form-control add_new_dropdown_report" name="totime" id="totime" onchange="totime(this.value)" >
                <span id="display_timeto" style="display:none"></span>
                  </div>
                </div> 
                     </div>
                            <!-- date ends --> 
                        <input type="hidden" name="hida4settings"  id="hida4settings"    value="<?=$_SESSION['s_a4print']?>"  >
                        </div>
                    </div>
                    <!-- condition ends -->                    
                </div><!--col-lg-12 col-md-12 nopadding-->
            </div><!--header_main_container-->
            <div class="top_validate_inform" style="display:none"> <span id="rptstatus" class="load_error alertsmasters"></span>  </div>
                                 
            <div class="col-lg-12 col-md-12 user_detail_min_hieght reporte_min_hieght_1"  id="reportload" style="background-color:#FCFCFC;  border-bottom: 1px solid #BDBDBD;padding:0;min-height:480px;height:76.5vh !important;overflow:scroll1 !important;" >
            
        </div>
         <div class="col-lg-12 col-md-12 nopadding top_main_cc">
                <form name="submitall" id="submitall"  method="post" action="<?php $_SERVER['PHP_SELF']?>"> 
                    <input type="hidden" name="hidfr" id="hidfr" />
                    <input type="hidden" name="hidto" id="hidto" /> 
                    <input type="hidden" name="hidval" id="hidval" />
                    <input type="hidden" name="hidpaytyp" id="hidpaytyp" />
                    <input type="hidden" name="hidfloor" id="hidfloor" />
                     <input type="hidden" name="hidstw" id="hidstw" />
                     <input type="hidden" name="hidord" id="hidord" />
                     <input type="hidden" name="hidbydate" id="hidbydate"/>
                 <input type="hidden" name="hiddelivry" id="hiddelivry" />
                 
                    <div class="search_name_box_sub_btn_cc" id="prnt" style="display:none">
                           <div  class="filter_sub_btn ">
                            <a class="btn-setting"  href="#" onclick="print_page()">Print</a>
                            </div>
                     </div>
                 
                        <div class="search_name_box_sub_btn_cc">
                           <div  class="filter_sub_btn ">
                            <a class="btn-setting"  href="#" onclick="movetoexcelForm()">TO Excel</a>
                            </div>
                      </div>
                 
                 <div class="search_name_box_sub_btn_cc mail_report_div" style="display: none ">
                           <div  class="filter_sub_btn ">
                            <a class="btn-setting"  href="#" onclick="mail_report()">MAIL</a>
                            </div>
                      </div>
                 
                 
                </form> 
            </div>
        </div>
    </div>
</div>
</div>
 
	

<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/bootstrap-multiselect.js"></script>
<!-- library for cookie management -->
<script src="js/jquery.cookie.js"></script>
<!-- calender plugin -->
<script src='bower_components/moment/min/moment.min.js'></script>
<script src='bower_components/fullcalendar/dist/fullcalendar.min.js'></script>
<!-- data table plugin -->
<script src='js/jquery.dataTables.min.js'></script>

<!-- select or dropdown enhancer -->
<script src="bower_components/chosen/chosen.jquery.min.js"></script>
<!-- plugin for gallery image view -->
<script src="bower_components/colorbox/jquery.colorbox-min.js"></script>
<!-- notification plugin -->
<!--<script src="js/jquery.noty.js"></script>-->
<!-- library for making tables responsive -->
<!--<script src="bower_components/responsive-tables/responsive-tables.js"></script>-->
<!-- tour plugin -->
<script src="bower_components/bootstrap-tour/build/js/bootstrap-tour.min.js"></script>
<!-- star rating plugin -->
<script src="js/jquery.raty.min.js"></script>
<!-- for iOS style toggle switch -->
<script src="js/jquery.iphone.toggle.js"></script>
<!-- autogrowing textarea plugin -->
<script src="js/jquery.autogrow-textarea.js"></script>
<!-- multiple file upload plugin -->
<script src="js/jquery.uploadify-3.1.min.js"></script>
<!-- history.js for cross-browser state change on ajax -->
<script src="js/jquery.history.js"></script>
<!-- application script for Charisma demo -->
<script src="js/charisma.js"></script>

<script src="mn/js/classie.js"></script>

<script type="text/javascript">
$(document).ready(function() {
	$('.multi_sel_report').multiselect({
           
	});
});
</script>
		<script src="mn/js/mlpushmenu.js"></script>
		<script>
			new mlPushMenu( document.getElementById( 'mp-menu' ), document.getElementById( 'trigger' ), {
				type : 'cover'
			} );
		</script>
 <script type="text/javascript">
 function validate_reportmaster()
    {
	if(validate_report())
            {
		document.report.submit();
            }
    }
function validate_report()   
{
	if(document.getElementById("reportname").value=="")
            {
		$("#report_div").addClass("has-error");
		document.report.reportname.focus();
		return false;
            }
        else
	    {
		$("#report_div").removeClass("has-error");
		$(this).addClass("has-success");
		return true;		
	    }
}

function clearall()
    {
	$('#datepickertodt').val(""); 
	$('#datepickerfrom').val("");
	$('#bydate').val("");
         $('#voucher').val("");
    }




function mail_report()
{
    
    var check = confirm("Send Mail?");
    if(check==true)
            {
                
		var vv=document.getElementById("typeval").value;
                
	   if(vv=="totalsales_consolidate_report_cr")
           {
               
            var loginstaffsel = $('#staff_ta').val();
            var tot_from=$('#datepickerfrom').val();
            var tot_to=$('#datepickertodt').val();
            var department=$('#mode').val();
            var hidbydate=$('#bydate').val();
            var a4paper=$('#hida4settings').val();
            var view_mode=$('#summary_detailed').val();
            var staff_hd=$('#staff_hd').val();
            var floorz=$('#floor_di').val();     
          
            
          if($("#tax_adsr").prop('checked') == true){
                var tax_adsr='true'; 
          }else{
               var tax_adsr='false'; 
          } 
           
           if($("#nontax").prop('checked') == true){
                var non_tax='true'; 
             }else{
               var non_tax='false'; 
           } 
          
          
            $('.confrmation_overlay_proce').css('display','block');
            $('.confrmation_overlay_proce').html('<img src="img/ajax-loaders/pls_wait.gif" />');
            
            window.location="consolidatedexcel_download.php?type="+vv+"&fromdt="+tot_from+"&todt="+tot_to+"&bydate="+hidbydate+"&floorz="+floorz+"&staff_hd="+staff_hd+"&loginstaffsel="+loginstaffsel+"&department="+department+"&modeofview="+view_mode+"&non_tax="+non_tax+"&tax_adsr="+tax_adsr;
           
           
     
       setTimeout(function(){
     
       var dd=$('#mailhead').val();
    
       var data1="value=mail_adsr&mail_name="+dd+"&mode=adsr";

       $.ajax({
        type: "POST",
        url: "load_consolidatedreport.php",
        data: data1,
        success: function(data2)
        { 
         
          alert('MAIL SEND');
          $('.confrmation_overlay_proce').css('display','none'); 
          
          
        }
        });    
     
        }, 5000); 
     
   
    }
    
    
    
    if(vv=="sales_summary_report_cr")
     {  
                
                       var fromval=$('#datepickerfrom').val();
			var tot_to=$('#datepickertodt').val();
			var bydate=$('#bydate').val();
                          var voucher="";    
                          
                          $('.confrmation_overlay_proce').css('display','block');
                         $('.confrmation_overlay_proce').html('<img src="img/ajax-loaders/pls_wait.gif" />');
                          
                          
                          
			window.location="consolidatedexcel_download.php?type="+vv+"&fromdt="+fromval+"&todt="+tot_to+"&bydate="+bydate;	
                        
                        
                        
      setTimeout(function(){
     
       var dd=$('#mailhead').val();
    
       var data1="value=mail_adsr&mail_name="+dd+"&mode=sales";

       $.ajax({
        type: "POST",
        url: "load_consolidatedreport.php",
        data: data1,
        success: function(data2)
        { 
         
          alert('MAIL SEND');
          $('.confrmation_overlay_proce').css('display','none'); 
          
          
        }
        });    
     
        }, 5000); 
                        
     } 
    
    
    
   }
     
}

function reportcreate(rpt)
{
   
	var repttype=rpt;
        if(rpt=='')
        {
            $('#reportload').html('');
        }
        
         $('#hsn_search').hide();
         
         if(rpt=="totalsales_consolidate_report_cr")
            {   
                 $('#department').css("display", "none");
                // $('#nontax_div').css("display", "block");
                 // $('#tax_adsr_div').css("display", "block");
                
                 if($('#summary_detailed').val()=='item_wise'){
                     
                    $('#hsn_code_div').css("display", "block");  
            }else{
                 $('#hsn_code_div').css("display", "none");
            }
                 
                 
                 
            }else{
                
                 $('#nontax_div').css("display", "none");
                  $('#tax_adsr_div').css("display", "none");
            }
        
         if(rpt=="expense_acc_report" || rpt=="purchase_acc_report")
            {   
                 $('#to_acc_div').css("display", "block");
                   $('#from_acc_div').css("display", "block");
            }else{
                
                 $('#to_acc_div').css("display", "none");
                 $('#from_acc_div').css("display", "none");       
            }


            if(rpt=="mult_card_bank_report")
            {   
                 $('#card_div').css("display", "block");
                 
            }else{
                
                 $('#card_div').css("display", "none");
                
            }
            
            
            if(rpt=="most_revenue_generated_item_cr")
            {   
                 $('#revenue_best').css("display", "block");
                  $('#revenue_best1').css("display", "block");
                 
                 
            }else{
                
                 $('#revenue_best').css("display", "none");
                  $('#revenue_best1').css("display", "none");
                
            }
            
             if(rpt=="complimentary_cr")
            {   
                 $('#comp_item_wise_div').css("display", "block");
                
                  
            }else{
                
               
              if(rpt!="shift_detail_cr")
             {  
                 $('#comp_item_wise_div').css("display", "none");
             }else{
                   $('#comp_item_wise_div').css("display", "block");
             }
             
            }
            
            
            
            
            if(rpt=='consolidated_credit_summury'){
                $('#credit_partial_pay_div').css("display", "block");
                
            }else{
                 $('#credit_partial_pay_div').css("display", "none");
            }
                
            
            
            

            var typevalrpt=$('#typeval').val();
            var summary_detailed=$('#summary_detailed').val();
                         
            if(typevalrpt=="sales_summary_report_cr" || (typevalrpt=="totalsales_consolidate_report_cr" && summary_detailed=='summary' ) )
            {   
                 $('.mail_report_div').css("display", "block");
                
            }else{
                
                 $('.mail_report_div').css("display", "none");
                
            }

        if(repttype=='discount_report_cr'){
            
               $('#item_disc_div').css("display", "block");
        }else{
              $('#item_disc_div').css("display", "none");
        }
  
            
            
        if(repttype=='item_ordered_cr'){
            
               $('#menusubcategory_div').css("display", "block");
        }else{
              $('#menusubcategory_div').css("display", "none");
        }
        
        
        if(repttype=="billwise_item_cr")
            {    $('#comp_item_div').css("display", "block");  
            }else{
                  $('#comp_item_div').css("display", "none");
            }




        if(repttype=="bill_wise_lukado")
        { 
             $('#phone_order_div').css("display", "block");     
        }else{
            $('#phone_order_div').css("display", "none");  
        }
        
        
        
        

        if(repttype=="sales_summary_report_cr")
            {   
                $('#exp_div_acc').css("display", "none");
                $('#pur_div_acc').css("display", "none");
                $('#voucher_login_div').css("display", "none");
                $('#payment_div').css("display", "none"); 
                $('#bank_div').css("display", "none");  
                $('#menuname_search_div').css("display", "none");  
                $('#menucategory_div').css("display", "none");
                $('#voucherdiv').css("display", "none");
                $('#voucherdiv1').css("display", "none");
		        $('#totalsalesdiv').css("display", "block");
                $('#bydatediv').css("display", "block");
                $('#datepickerfromdiv').css("display", "block");
                $('#datepickertodtdiv').css("display", "block");
                $('#dailysalesstatmentdate').css("display", "none");
                $('#prnt').css("display","block");
                $('#cashierdiv').css("display", "none");
                $('#department').css("display", "none");
                $('#creditcategory').css("display", "none");
                $('#taxtypediv').css("display", "none");
                $('#creditdetailsdiv').css("display", "none");
                $('#shiftlogindiv').css("display", "none");
                $('#credit-outstanding').css("display","none");
                $('#creditperson-companydiv').css('display','none');
                $('#creditstaff').css('display','none');
                $('#creditcompany').css('display','none');
                $('#creditguest').css('display','none');
                $('#kitchen-div').css('display','none');
                 $('#summary_detaileddiv').css('display','none');
                $('#cashcounterdiv').css('display','none');
                $('#menu_typediv').css("display", "none");              
                clearall();
                var tot_to=$('#datepickertodt').val(); 
                var fromval=$('#datepickerfrom').val();
                var bydate=$('#bydate').val();
                var voucher=$('#voucher').val();
 
				$.post("load_consolidatedreport.php", {type:repttype,fromdt:fromval,todt:tot_to,voucher:voucher,bydate:bydate},
				function(data)
				   {
					data=$.trim(data);              
					$('#reportload').html(data);
				   });
                        
            }
           else if(repttype=="expense_acc_report")
            {   
                $('#voucher_login_div').css("display", "none");
                $('#payment_div').css("display", "none"); 
                $('#bank_div').css("display", "none"); 
                $('#exp_div_acc').css("display", "block");
                $('#pur_div_acc').css("display", "none");
                $('#menuname_search_div').css("display", "none");  
                $('#menucategory_div').css("display", "none");
                $('#voucherdiv').css("display", "none");
                $('#voucherdiv1').css("display", "none");
		        $('#totalsalesdiv').css("display", "block");
                $('#bydatediv').css("display", "block");
                $('#datepickerfromdiv').css("display", "block");
                $('#datepickertodtdiv').css("display", "block");
                $('#dailysalesstatmentdate').css("display", "none");
                $('#prnt').css("display","block");
                $('#cashierdiv').css("display", "none");
                $('#department').css("display", "none");
                $('#creditcategory').css("display", "none");
                $('#taxtypediv').css("display", "none");
                $('#creditdetailsdiv').css("display", "none");
                $('#shiftlogindiv').css("display", "none");
                $('#credit-outstanding').css("display","none");
                $('#creditperson-companydiv').css('display','none');
                $('#creditstaff').css('display','none');
                $('#creditcompany').css('display','none');
                $('#creditguest').css('display','none');
                $('#kitchen-div').css('display','none');
                 $('#summary_detaileddiv').css('display','none');
                $('#cashcounterdiv').css('display','none');
                $('#menu_typediv').css("display", "none");
                clearall();
                var tot_to=$('#datepickertodt').val(); 
                var fromval=$('#datepickerfrom').val();
                var bydate=$('#bydate').val();
                var voucher=$('#voucher').val();
				$.post("load_consolidatedreport.php", {type:repttype,fromdt:fromval,todt:tot_to,voucher:voucher,bydate:bydate},
				function(data)
				   {
					data=$.trim(data);
					$('#reportload').html(data);
				   });             
            }

            else if(repttype=="purchase_acc_report")
            {   
                $('#voucher_login_div').css("display", "none");
                $('#payment_div').css("display", "none"); 
                $('#bank_div').css("display", "none"); 
                $('#exp_div_acc').css("display", "none");
                $('#pur_div_acc').css("display", "block");
                $('#menuname_search_div').css("display", "none");  
                $('#menucategory_div').css("display", "none");
                $('#voucherdiv').css("display", "none");
                $('#voucherdiv1').css("display", "none");
		        $('#totalsalesdiv').css("display", "block");
                $('#bydatediv').css("display", "block");
                $('#datepickerfromdiv').css("display", "block");
                $('#datepickertodtdiv').css("display", "block");
                $('#dailysalesstatmentdate').css("display", "none");
                $('#prnt').css("display","block");
                $('#cashierdiv').css("display", "none");
                $('#department').css("display", "none");
                $('#creditcategory').css("display", "none");
                $('#taxtypediv').css("display", "none");
                $('#creditdetailsdiv').css("display", "none");
                $('#shiftlogindiv').css("display", "none");
                $('#credit-outstanding').css("display","none");
                $('#creditperson-companydiv').css('display','none');
                $('#creditstaff').css('display','none');
                $('#creditcompany').css('display','none');
                $('#creditguest').css('display','none');
                $('#kitchen-div').css('display','none');
                 $('#summary_detaileddiv').css('display','none');
                $('#cashcounterdiv').css('display','none');
                $('#menu_typediv').css("display", "none");
                $('#daydiv').css("display", "none");
                $('#fromtimediv').css("display", "none");
                $('#totimediv').css("display", "none");
                clearall();
                var tot_to=$('#datepickertodt').val(); 
                var fromval=$('#datepickerfrom').val();
                var bydate=$('#bydate').val();
                var voucher=$('#voucher').val();
				$.post("load_consolidatedreport.php", {type:repttype,fromdt:fromval,todt:tot_to,voucher:voucher,bydate:bydate},
				function(data)
				   {
					data=$.trim(data);
					$('#reportload').html(data);
				   });             
            }
            
             else if(repttype=="mult_card_bank_report")
            {   
                $('#voucher_login_div').css("display", "none");
                $('#payment_div').css("display", "none"); 
                $('#bank_div').css("display", "block"); 
                $('#exp_div_acc').css("display", "none");
                $('#pur_div_acc').css("display", "none");
                $('#menuname_search_div').css("display", "none");  
                $('#menucategory_div').css("display", "none");
                $('#voucherdiv').css("display", "none");
                $('#voucherdiv1').css("display", "none");
		$('#totalsalesdiv').css("display", "block");
                $('#bydatediv').css("display", "block");
                $('#datepickerfromdiv').css("display", "block");
                $('#datepickertodtdiv').css("display", "block");
                $('#dailysalesstatmentdate').css("display", "none");
                $('#prnt').css("display","block");
                $('#cashierdiv').css("display", "none");
                $('#department').css("display", "none");
                $('#creditcategory').css("display", "none");
                $('#taxtypediv').css("display", "none");
                $('#creditdetailsdiv').css("display", "none");
                $('#shiftlogindiv').css("display", "none");
                $('#credit-outstanding').css("display","none");
                $('#creditperson-companydiv').css('display','none');
                $('#creditstaff').css('display','none');
                $('#creditcompany').css('display','none');
                $('#creditguest').css('display','none');
                $('#kitchen-div').css('display','none');
                 $('#summary_detaileddiv').css('display','none');
                $('#cashcounterdiv').css('display','none');
                $('#menu_typediv').css("display", "none");
                $('#daydiv').css("display", "none");
                $('#fromtimediv').css("display", "none");
                $('#totimediv').css("display", "none");
                clearall();
                var tot_to=$('#datepickertodt').val(); 
                var fromval=$('#datepickerfrom').val();
                var bydate=$('#bydate').val();
                var bank=$('#bank_name').val();
                
                 var card=$('#card_name').val();
                
				$.post("load_consolidatedreport.php", {type:repttype,fromdt:fromval,todt:tot_to,voucher:voucher,bydate:bydate,bank_name:bank,card_name:card},
				function(data)
				   {
					data=$.trim(data);
					$('#reportload').html(data);
				   });             
            }
          
            else if(repttype=="bill_wise_lukado")
            {   
                $('#voucher_login_div').css("display", "none");
                $('#payment_div').css("display", "none"); 
                $('#bank_div').css("display", "none"); 
                $('#exp_div_acc').css("display", "none");
                $('#pur_div_acc').css("display", "none");
                $('#menuname_search_div').css("display", "none");  
                $('#menucategory_div').css("display", "none");
                $('#voucherdiv').css("display", "none");
                $('#voucherdiv1').css("display", "none");
		        $('#totalsalesdiv').css("display", "block");
                $('#bydatediv').css("display", "block");
                $('#datepickerfromdiv').css("display", "block");
                $('#datepickertodtdiv').css("display", "block");
                $('#dailysalesstatmentdate').css("display", "none");
                $('#prnt').css("display","block");
                $('#cashierdiv').css("display", "none");
                $('#department').css("display", "none");
                $('#creditcategory').css("display", "none");
                $('#taxtypediv').css("display", "none");
                $('#creditdetailsdiv').css("display", "none");
                $('#shiftlogindiv').css("display", "none");
                $('#credit-outstanding').css("display","none");
                $('#creditperson-companydiv').css('display','none');
                $('#creditstaff').css('display','none');
                $('#creditcompany').css('display','none');
                $('#creditguest').css('display','none');
                $('#kitchen-div').css('display','none');
                 $('#summary_detaileddiv').css('display','none');
                $('#cashcounterdiv').css('display','none');
                $('#menu_typediv').css("display", "none");
                clearall();
                var tot_to=$('#datepickertodt').val(); 
                var fromval=$('#datepickerfrom').val();
                var bydate=$('#bydate').val();
                var voucher=$('#voucher').val();
				$.post("load_consolidatedreport.php", {type:repttype,fromdt:fromval,todt:tot_to,voucher:voucher,bydate:bydate},
				function(data)
				   {
					data=$.trim(data);
					$('#reportload').html(data);
				   });             
            }
            else if(repttype=="reprint_report")
            {   
                 $('#voucher_login_div').css("display", "none");
                $('#payment_div').css("display", "none"); 
                $('#bank_div').css("display", "none"); 
                $('#exp_div_acc').css("display", "none");
                $('#pur_div_acc').css("display", "none");
              $('#menuname_search_div').css("display", "none");  
                $('#menucategory_div').css("display", "none");
                $('#voucherdiv').css("display", "none");
                $('#voucherdiv1').css("display", "none");
		        $('#totalsalesdiv').css("display", "block");
                $('#bydatediv').css("display", "block");
                $('#datepickerfromdiv').css("display", "block");
                $('#datepickertodtdiv').css("display", "block");
                $('#dailysalesstatmentdate').css("display", "none");
                $('#prnt').css("display","block");
                $('#cashierdiv').css("display", "none");
                $('#department').css("display", "none");
                $('#creditcategory').css("display", "none");
                $('#taxtypediv').css("display", "none");
                $('#creditdetailsdiv').css("display", "none");
                $('#shiftlogindiv').css("display", "none");
                $('#credit-outstanding').css("display","none");
                $('#creditperson-companydiv').css('display','none');
                $('#creditstaff').css('display','none');
                $('#creditcompany').css('display','none');
                $('#creditguest').css('display','none');
                $('#kitchen-div').css('display','none');
                 $('#summary_detaileddiv').css('display','none');
                $('#cashcounterdiv').css('display','none');
                $('#menu_typediv').css("display", "none");
                clearall();
                var tot_to=$('#datepickertodt').val(); 
                var fromval=$('#datepickerfrom').val();
                var bydate=$('#bydate').val();
                var voucher=$('#voucher').val();
                $.post("load_consolidatedreport.php", {type:repttype,fromdt:fromval,todt:tot_to,voucher:voucher,bydate:bydate},
				function(data)
				   {
					data=$.trim(data);
					$('#reportload').html(data);
				   });
            }
            else if(repttype=="counter_shift_cr")
            {   
                $('#voucher_login_div').css("display", "none");
                $('#payment_div').css("display", "none"); 
                $('#bank_div').css("display", "none"); 
                $('#exp_div_acc').css("display", "none");
                $('#pur_div_acc').css("display", "none");
                $('#menuname_search_div').css("display", "none");  
                $('#menucategory_div').css("display", "none");
                $('#voucherdiv').css("display", "none");
                $('#voucherdiv1').css("display", "none");
		        $('#totalsalesdiv').css("display", "block");
                $('#bydatediv').css("display", "block");
                $('#datepickerfromdiv').css("display", "block");
                $('#datepickertodtdiv').css("display", "block");
                $('#dailysalesstatmentdate').css("display", "none");
                $('#prnt').css("display","block");
                $('#cashierdiv').css("display", "none");
                $('#department').css("display", "none");
                $('#creditcategory').css("display", "none");
                $('#taxtypediv').css("display", "none");
                $('#creditdetailsdiv').css("display", "none");
                $('#shiftlogindiv').css("display", "block");
                $('#credit-outstanding').css("display","none");
                $('#creditperson-companydiv').css('display','none');
                $('#creditstaff').css('display','none');
                $('#creditcompany').css('display','none');
                $('#creditguest').css('display','none');
                $('#kitchen-div').css('display','none');
                $('#summary_detaileddiv').css('display','none');
                $('#cashcounterdiv').css('display','none');
                $('#menu_typediv').css("display", "none");             
                clearall();
                var tot_to=$('#datepickertodt').val(); 
                var fromval=$('#datepickerfrom').val();
                var bydate=$('#bydate').val();
                var voucher=$('#voucher').val();               
				$.post("load_consolidatedreport.php", {type:repttype,fromdt:fromval,todt:tot_to,voucher:voucher,bydate:bydate},
				function(data)
				   {
					data=$.trim(data);
					$('#reportload').html(data);
				   });       
            }
             else if(repttype=="shift_detail_cr")
            {   
                $('#voucher_login_div').css("display", "none");
                $('#payment_div').css("display", "none"); 
                $('#bank_div').css("display", "none"); 
                $('#exp_div_acc').css("display", "none");
                $('#pur_div_acc').css("display", "none");
                $('#menuname_search_div').css("display", "none");  
                $('#menucategory_div').css("display", "none");
                $('#voucherdiv').css("display", "none");
                $('#voucherdiv1').css("display", "none");
		        $('#totalsalesdiv').css("display", "block");
                $('#bydatediv').css("display", "block");
                $('#datepickerfromdiv').css("display", "block");
                $('#datepickertodtdiv').css("display", "block");
                $('#dailysalesstatmentdate').css("display", "none");
                $('#prnt').css("display","block");
                $('#cashierdiv').css("display", "none");
                $('#department').css("display", "none");
                $('#creditcategory').css("display", "none");
                $('#taxtypediv').css("display", "none");
                $('#creditdetailsdiv').css("display", "none");
                $('#shiftlogindiv').css("display", "block");
                $('#credit-outstanding').css("display","none");
                $('#creditperson-companydiv').css('display','none');
                $('#creditstaff').css('display','none');
                $('#creditcompany').css('display','none');
                $('#creditguest').css('display','none');
                $('#kitchen-div').css('display','none');
                $('#summary_detaileddiv').css('display','none');
                $('#cashcounterdiv').css('display','none');
                $('#menu_typediv').css("display", "none");   
                
                $('#shiftlogin').find('option:contains("All")').hide(); 
                $("#shiftlogin option:first").attr('selected','selected');
                
               $('#shift_item_wise_div').css("display", "block"); 
                
                
                clearall();
                var tot_to=$('#datepickertodt').val(); 
                var fromval=$('#datepickerfrom').val();
                var bydate=$('#bydate').val();
                var voucher=$('#voucher').val();               
				$.post("load_consolidatedreport.php", {type:repttype,fromdt:fromval,todt:tot_to,voucher:voucher,bydate:bydate},
				function(data)
				   {
					data=$.trim(data);
					$('#reportload').html(data);
				   });       
            }
             else if(repttype=="loyalty_staff_cr")
            {   
                $('#voucher_login_div').css("display", "none");
                $('#payment_div').css("display", "none"); 
                $('#bank_div').css("display", "none"); 
                $('#menuname_search_div').css("display", "none");  
                $('#menucategory_div').css("display", "none");
                $('#voucherdiv').css("display", "none");
                $('#voucherdiv1').css("display", "none");
		        $('#totalsalesdiv').css("display", "block");
                $('#bydatediv').css("display", "block");
                $('#datepickerfromdiv').css("display", "block");
                $('#datepickertodtdiv').css("display", "block");
                $('#dailysalesstatmentdate').css("display", "none");
                $('#prnt').css("display","block");
                $('#cashierdiv').css("display", "none");
                $('#department').css("display", "none");
                $('#creditcategory').css("display", "none");
                $('#taxtypediv').css("display", "none");
                $('#creditdetailsdiv').css("display", "none");
                $('#shiftlogindiv').css("display", "none");
                $('#credit-outstanding').css("display","none");
                $('#creditperson-companydiv').css('display','none');
                $('#creditstaff').css('display','none');
                $('#creditcompany').css('display','none');
                $('#creditguest').css('display','none');
                $('#kitchen-div').css('display','none');
                $('#summary_detaileddiv').css('display','none');
                $('#cashcounterdiv').css('display','none');
                $('#menu_typediv').css("display", "none");
                $('#exp_div_acc').css("display", "none"); 
                 $('#pur_div_acc').css("display", "none");              
                clearall();
                var tot_to=$('#datepickertodt').val(); 
                var fromval=$('#datepickerfrom').val();
                var bydate=$('#bydate').val();
                var voucher=$('#voucher').val();                
				$.post("load_consolidatedreport.php", {type:repttype,fromdt:fromval,todt:tot_to,voucher:voucher,bydate:bydate},
				function(data)
				   {
					data=$.trim(data);
					$('#reportload').html(data);
				   });
            }
           else if(repttype=="advance_payment_cr")
            {   
                $('#voucher_login_div').css("display", "none");
                $('#payment_div').css("display", "none"); 
                $('#bank_div').css("display", "none"); 
                $('#menuname_search_div').css("display", "none");  
                $('#menucategory_div').css("display", "none");
                $('#voucherdiv').css("display", "none");
                $('#voucherdiv1').css("display", "none");
		        $('#totalsalesdiv').css("display", "block");
                $('#bydatediv').css("display", "block");
                $('#datepickerfromdiv').css("display", "block");
                $('#datepickertodtdiv').css("display", "block");
                $('#dailysalesstatmentdate').css("display", "none");
                $('#prnt').css("display","block");
                $('#cashierdiv').css("display", "none");
                $('#department').css("display", "none");
                $('#creditcategory').css("display", "none");
                $('#taxtypediv').css("display", "none");
                $('#creditdetailsdiv').css("display", "none");
                $('#shiftlogindiv').css("display", "none");
                $('#credit-outstanding').css("display","none");
                $('#creditperson-companydiv').css('display','none');
                $('#creditstaff').css('display','none');
                $('#creditcompany').css('display','none');
                $('#creditguest').css('display','none');
                $('#kitchen-div').css('display','none');
                $('#summary_detaileddiv').css('display','none');
                $('#cashcounterdiv').css('display','none');
                $('#menu_typediv').css("display", "none");
                $('#exp_div_acc').css("display", "none");  
                $('#pur_div_acc').css("display", "none");             
                clearall();
                var tot_to=$('#datepickertodt').val(); 
                var fromval=$('#datepickerfrom').val();
                var bydate=$('#bydate').val();
                var voucher=$('#voucher').val();              
				$.post("load_consolidatedreport.php", {type:repttype,fromdt:fromval,todt:tot_to,voucher:voucher,bydate:bydate},
				function(data)
				   {
					data=$.trim(data);
					$('#reportload').html(data);
				   });
            }
           else if(repttype=="consolidated_cancel_report")
            {  
                 $('#voucher_login_div').css("display", "none");
                $('#payment_div').css("display", "none"); 
                 $('#bank_div').css("display", "none"); 
              $('#menuname_search_div').css("display", "none");  
                $('#menucategory_div').css("display", "none");
                $('#voucherdiv').css("display", "none");
                $('#voucherdiv1').css("display", "none");
		$('#totalsalesdiv').css("display", "block");
                $('#bydatediv').css("display", "block");
                $('#datepickerfromdiv').css("display", "block");
                $('#datepickertodtdiv').css("display", "block");
                $('#dailysalesstatmentdate').css("display", "none");
                $('#prnt').css("display","block");
                $('#cashierdiv').css("display", "none");
                $('#department').css("display", "block");
                $('#creditcategory').css("display", "none");
                $('#taxtypediv').css("display", "none");
                $('#creditdetailsdiv').css("display", "none");
                $('#shiftlogindiv').css("display", "none");
                $('#credit-outstanding').css("display","none");
                $('#creditperson-companydiv').css('display','none');
                $('#creditstaff').css('display','none');
                $('#creditcompany').css('display','none');
                $('#creditguest').css('display','none');
                $('#kitchen-div').css('display','none');
                 $('#summary_detaileddiv').css('display','none');
                $('#cashcounterdiv').css('display','none');
                $('#menu_typediv').css("display", "none");
                 $('#fromtimediv').css("display","none");
                $('#totimediv').css("display","none");
                 $('#exp_div_acc').css("display", "none");   
                 $('#pur_div_acc').css("display", "none");         
                clearall();
                var tot_to=$('#datepickertodt').val(); 
                var fromval=$('#datepickerfrom').val();
                var bydate=$('#bydate').val();
                var department=$('#mode').val();
	            $.post("load_consolidatedreport.php", {type:repttype,fromdt:fromval,todt:tot_to,bydate:bydate,mode:mode},
				function(data)
				   {
					data=$.trim(data);
					$('#reportload').html(data);
				   });
            }
             else if(repttype=="summary_specified_consolidated")
            {   
                $('#voucher_login_div').css("display", "none");
                $('#payment_div').css("display", "none"); 
                 $('#bank_div').css("display", "none"); 
                $('#menuname_search_div').css("display", "none");  
                $('#menucategory_div').css("display", "none");
                $('#voucherdiv').css("display", "none");
                $('#voucherdiv1').css("display", "none");
		$('#totalsalesdiv').css("display", "block");
                $('#bydatediv').css("display", "block");
                $('#datepickerfromdiv').css("display", "block");
                $('#datepickertodtdiv').css("display", "block");
                $('#dailysalesstatmentdate').css("display", "none");
                $('#prnt').css("display","block");
                $('#cashierdiv').css("display", "none");
                $('#department').css("display", "none");
                $('#creditcategory').css("display", "none");
                $('#taxtypediv').css("display", "none");
                $('#creditdetailsdiv').css("display", "none");
                $('#shiftlogindiv').css("display", "none");
                $('#credit-outstanding').css("display","none");
                $('#creditperson-companydiv').css('display','none');
                $('#creditstaff').css('display','none');
                $('#creditcompany').css('display','none');
                $('#creditguest').css('display','none');
                $('#kitchen-div').css('display','none');
                 $('#summary_detaileddiv').css('display','none');
                $('#cashcounterdiv').css('display','none');
                $('#menu_typediv').css("display", "none");
                 $('#fromtimediv').css("display","none");
                $('#totimediv').css("display","none");
                 $('#exp_div_acc').css("display", "none");  
                 $('#pur_div_acc').css("display", "none");             
                clearall();
                var tot_to=$('#datepickertodt').val(); 
                var fromval=$('#datepickerfrom').val();
                var bydate=$('#bydate').val();
                var department=$('#mode').val();
		$.post("load_consolidatedreport.php", {type:repttype,fromdt:fromval,todt:tot_to,bydate:bydate},
				function(data)
				   {
					data=$.trim(data);
					$('#reportload').html(data);
				   });
            }
           else if(repttype=="consolidated_payment_cr")
            {   
                 $('#voucher_login_div').css("display", "none");
                 $('#fromtimediv').css("display","none");
                $('#totimediv').css("display","none");
                 $('#payment_div').css("display", "block");  
                  $('#bank_div').css("display", "none"); 
              $('#menuname_search_div').css("display", "none");  
                $('#menucategory_div').css("display", "none");
                $('#voucherdiv').css("display", "none");
                $('#voucherdiv1').css("display", "none");
		$('#totalsalesdiv').css("display", "block");
                $('#bydatediv').css("display", "block");
                $('#datepickerfromdiv').css("display", "block");
                $('#datepickertodtdiv').css("display", "block");
                $('#dailysalesstatmentdate').css("display", "none");
                $('#prnt').css("display","block");
                $('#cashierdiv').css("display", "none");
                $('#department').css("display", "block");
                $('#creditcategory').css("display", "none");
                $('#taxtypediv').css("display", "none");
                $('#creditdetailsdiv').css("display", "none");
                $('#shiftlogindiv').css("display", "none");
                $('#credit-outstanding').css("display","none");
                $('#creditperson-companydiv').css('display','none');
                $('#creditstaff').css('display','none');
                $('#creditcompany').css('display','none');
                $('#creditguest').css('display','none');
                $('#kitchen-div').css('display','none');
                 $('#summary_detaileddiv').css('display','none');
                $('#cashcounterdiv').css('display','none');
                $('#menu_typediv').css("display", "none");
                 $('#exp_div_acc').css("display", "none");  
                 $('#pur_div_acc').css("display", "none");             
                clearall();
                var tot_to=$('#datepickertodt').val(); 
                var fromval=$('#datepickerfrom').val();
                var bydate=$('#bydate').val();
                var department=$('#mode').val();
                  var payment=$('#paytype').val();                  
                  var bank_name=$('#bank_name').val();           	
				$.post("load_consolidatedreport.php", {type:repttype,fromdt:fromval,todt:tot_to,bydate:bydate,mode:department,payment:payment,bank_name:bank_name},
				function(data)
				   {
					data=$.trim(data);
					$('#reportload').html(data);
				   });                        		
            }
            
            else if(repttype=="tax_report")
            {     $('#exp_div_acc').css("display", "none");
                $('#pur_div_acc').css("display", "none");
                 $('#voucher_login_div').css("display", "none");
               $('#payment_div').css("display", "none");   
            $('#menuname_search_div').css("display", "none");  
                $('#menucategory_div').css("display", "none");
                 $('#bank_div').css("display", "none"); 
                $('#voucherdiv').css("display", "none");
                  $('#voucherdiv1').css("display", "none");
		$('#totalsalesdiv').css("display", "block");
                $('#bydatediv').css("display", "block");
                $('#datepickerfromdiv').css("display", "block");
                $('#datepickertodtdiv').css("display", "block");
                $('#dailysalesstatmentdate').css("display", "none");
                $('#prnt').css("display","block");
                $('#cashierdiv').css("display", "none");
                $('#department').css("display", "block");
                $('#creditcategory').css("display", "none");
                 $('#taxtypediv').css("display", "block");
                 $('#creditdetailsdiv').css("display", "none");
                  $('#shiftlogindiv').css("display", "none");
                   $('#fromtimediv').css("display","none");
                $('#totimediv').css("display","none");
               $('#daydiv').css("display","none");
               $('#credit-outstanding').css("display","none");
               $('#creditperson-companydiv').css('display','none');
                $('#creditstaff').css('display','none');
                $('#creditcompany').css('display','none');
                $('#creditguest').css('display','none');
                $('#kitchen-div').css('display','none');
                 $('#summary_detaileddiv').css('display','none');
                  $('#cashcounterdiv').css('display','none');
                  $('#menu_typediv').css("display", "none");
                clearall();
                var tot_to=$('#datepickertodt').val(); 
                var fromval=$('#datepickerfrom').val();
                var bydate=$('#bydate').val();
                var department=$('#mode').val();               
                var tax = $('#taxtype').val();             
                  if(department=='' && repttype=='tax_report' ){                       
                        $('#tax_di').css("display","none");
                        $('#tax_tahd').css("display","none");
                        $('#tax_cs').css("display","none");
                        $('#tax_all').css("display","block");
                    }
				$.post("load_consolidatedreport.php", {type:repttype,fromdt:fromval,todt:tot_to,voucher:voucher,bydate:bydate,tax:tax,},
				function(data)
				   {
					data=$.trim(data);
					$('#reportload').html(data);
				   });
            }
            
//            else if(repttype=="consolidated_timely_report")
//            {  
//                 $('#voucher_login_div').css("display", "none");
//                 $('#payment_div').css("display", "none"); 
//            $('#menuname_search_div').css("display", "none");  
//                 $('#menucategory_div').css("display", "none");
//            $('#voucherdiv').css("display", "none");
//                  $('#voucherdiv1').css("display", "none");
//		$('#totalsalesdiv').css("display", "none");
//                $('#bydatediv').css("display", "none");
//                $('#datepickerfromdiv').css("display", "none");
//                $('#datepickertodtdiv').css("display", "none");
//                $('#dailysalesstatmentdate').css("display", "none");
//                $('#prnt').css("display","none");
//                $('#cashierdiv').css("display", "none");
//                $('#department').css("display", "none");
//                $('#creditcategory').css("display", "none");
//                 $('#taxtypediv').css("display", "none");
//                 $('#creditdetailsdiv').css("display", "none");
//               $('#fromtimediv').css("display","none");
//                $('#totimediv').css("display","none");
//               $('#daydiv').css("display","none");
//                 $('#shiftlogindiv').css("display", "none");
//                 $('#credit-outstanding').css("display","none");
//                 $('#creditperson-companydiv').css('display','none');
//                $('#creditstaff').css('display','none');
//                $('#creditcompany').css('display','none');
//                $('#creditguest').css('display','none');
//                $('#kitchen-div').css('display','none');
//                 $('#summary_detaileddiv').css('display','none');
//                  $('#cashcounterdiv').css('display','none');
//                  $('#menu_typediv').css("display", "none");
//                
//                $('#reportload').html('');
//            }
            
   else if(repttype=="consolidated_shift_report")
            {  
                 $('#voucher_login_div').css("display", "none");
                 $('#payment_div').css("display", "none"); 
                $('#menucategory_div').css("display", "none");
                 $('#bank_div').css("display", "none"); 
                $('#voucherdiv').css("display", "none");
                  $('#voucherdiv1').css("display", "none");
		    $('#totalsalesdiv').css("display", "block");
                $('#bydatediv').css("display", "block");
                $('#datepickerfromdiv').css("display", "block");
                $('#datepickertodtdiv').css("display", "block");
                $('#dailysalesstatmentdate').css("display", "none");
                $('#prnt').css("display","block");
                $('#cashierdiv').css("display", "none");
                $('#department').css("display", "none");
                $('#creditcategory').css("display", "none");
                 $('#taxtypediv').css("display", "none");
                 $('#creditdetailsdiv').css("display", "none");
                  $('#shiftlogindiv').css("display", "block");
                   $('#fromtimediv').css("display","none");
                $('#totimediv').css("display","none");
               $('#daydiv').css("display","none");
               $('#credit-outstanding').css("display","none");
               $('#creditperson-companydiv').css('display','none');
                $('#creditstaff').css('display','none');
                $('#creditcompany').css('display','none');
                $('#creditguest').css('display','none');
                $('#kitchen-div').css('display','none');
                $('#summary_detaileddiv').css('display','block');
                var item_wise='item_wise';
                $("#summary_detailed option[value=" + item_wise + "]").hide();
                 $('#cashcounterdiv').css('display','block');
                 $('#menu_typediv').css("display", "none");
                  $('#exp_div_acc').css("display", "none");
                  $('#pur_div_acc').css("display", "none");
                clearall();
                var tot_to=$('#datepickertodt').val(); 
                var fromval=$('#datepickerfrom').val();
                var bydate=$('#bydate').val();
                var voucher=$('#voucher').val();
                var modeofview=$('#summary_detailed').val();
                var shiftlogin=$('#shiftlogin').val();
                var cashcounter=$('#cashcounter').val();
                $.post("load_consolidatedreport.php", {type:repttype,fromdt:fromval,todt:tot_to,voucher:voucher,bydate:bydate,shiftlogin:shiftlogin,modeofview:modeofview,cashcounter:cashcounter},
				function(data)
				   {
					data=$.trim(data);
					$('#reportload').html(data);
				   });
             }
     else if(repttype=="consolidated_timely_report")
            {                
                 $('#voucher_login_div').css("display", "none");
                 $('#payment_div').css("display", "none"); 
                $('#menucategory_div').css("display", "none");
                $('#voucherdiv').css("display", "none");
                  $('#voucherdiv1').css("display", "none");
                   $('#bank_div').css("display", "none"); 
		$('#totalsalesdiv').css("display", "block");
                $('#bydatediv').css("display", "none");
                $('#datepickerfromdiv').css("display", "block");
                $('#datepickertodtdiv').css("display", "none");
                $('#dailysalesstatmentdate').css("display", "none");
                $('#prnt').css("display","block");
                $('#cashierdiv').css("display", "none");
                $('#department').css("display", "none");
                $('#creditcategory').css("display", "none");
                 $('#taxtypediv').css("display", "none");
                 $('#creditdetailsdiv').css("display", "none");
                   $('#fromtimediv').css("display","none");
                $('#totimediv').css("display","none");
               $('#daydiv').css("display","none");
               $('#credit-outstanding').css("display","none");
               $('#creditperson-companydiv').css('display','none');
                $('#creditstaff').css('display','none');
                $('#creditcompany').css('display','none');
                $('#creditguest').css('display','none');
                $('#kitchen-div').css('display','none');
                 $('#menu_typediv').css("display", "none");
                  $('#exp_div_acc').css("display", "none");
                  $('#pur_div_acc').css("display", "none");
                clearall();
                var tot_to=$('#datepickertodt').val(); 
                var fromval=$('#datepickerfrom').val();
                var bydate=$('#bydate').val();
                var voucher=$('#voucher').val();
                var modeofview=$('#summary_detailed').val();
                var shiftlogin=$('#shiftlogin').val();
                var cashcounter=$('#cashcounter').val();
				$.post("load_consolidatedreport.php", {type:repttype,fromdt:fromval,todt:tot_to,voucher:voucher,bydate:bydate,shiftlogin:shiftlogin,modeofview:modeofview,cashcounter:cashcounter},
				function(data)
				   {
					data=$.trim(data);
					$('#reportload').html(data);
				   });
            }       
             else if(repttype=="summary_report_cr")
            {   $('#exp_div_acc').css("display", "none");
                $('#pur_div_acc').css("display", "none");
                $('#voucher_login_div').css("display", "none");
                $('#payment_div').css("display", "none"); 
                $('#bank_div').css("display", "none"); 
                $('#menuname_search_div').css("display", "none");  
                $('#menucategory_div').css("display", "none");
                $('#voucherdiv').css("display", "none");
                $('#voucherdiv1').css("display", "none");
		        $('#totalsalesdiv').css("display", "block");
                $('#bydatediv').css("display", "block");
                $('#datepickerfromdiv').css("display", "block");
                $('#datepickertodtdiv').css("display", "block");
                $('#dailysalesstatmentdate').css("display", "none");
                $('#prnt').css("display","block");
                $('#cashierdiv').css("display", "none");
                $('#department').css("display", "none");
                $('#creditcategory').css("display", "none");
                $('#taxtypediv').css("display", "none");
                $('#creditdetailsdiv').css("display", "none");
                $('#shiftlogindiv').css("display", "none");
                $('#credit-outstanding').css("display","none");
                $('#creditperson-companydiv').css('display','none');
                $('#creditstaff').css('display','none');
                $('#creditcompany').css('display','none');
                $('#creditguest').css('display','none');
                $('#kitchen-div').css('display','none');
                $('#summary_detaileddiv').css('display','none');
                $('#cashcounterdiv').css('display','none');
                $('#menu_typediv').css("display", "none");
                clearall();
                var tot_to=$('#datepickertodt').val(); 
                var fromval=$('#datepickerfrom').val();
                var bydate=$('#bydate').val();
                var voucher=$('#voucher').val();
				$.post("load_consolidatedreport.php", {type:repttype,fromdt:fromval,todt:tot_to,voucher:voucher,bydate:bydate},
				function(data)
				   {
					data=$.trim(data);
					$('#reportload').html(data);
				   });          		
            }           
            else if(repttype=="total_summary_details_cr")
            {     $('#exp_div_acc').css("display", "none");
                $('#pur_div_acc').css("display", "none");
                 $('#voucher_login_div').css("display", "none");
                $('#payment_div').css("display", "none");  
            $('#menuname_search_div').css("display", "none");  
             $('#bank_div').css("display", "none"); 
                 $('#menucategory_div').css("display", "none");
                $('#voucherdiv').css("display", "none");
                  $('#voucherdiv1').css("display", "none");
		$('#totalsalesdiv').css("display", "block");
                $('#bydatediv').css("display", "block");
                $('#datepickerfromdiv').css("display", "block");
                $('#datepickertodtdiv').css("display", "block");
                $('#dailysalesstatmentdate').css("display", "none");
                $('#prnt').css("display","block");
                $('#cashierdiv').css("display", "none");
                $('#department').css("display", "none");
                $('#creditcategory').css("display", "none");
                $('#taxtypediv').css("display", "none");
                $('#creditdetailsdiv').css("display", "none");
                 $('#shiftlogindiv').css("display", "none");
                 $('#credit-outstanding').css("display","none");
                 $('#creditperson-companydiv').css('display','none');
                $('#creditstaff').css('display','none');
                $('#creditcompany').css('display','none');
                $('#creditguest').css('display','none');
                $('#kitchen-div').css('display','none');
                 $('#summary_detaileddiv').css('display','block');
                  $('#cashcounterdiv').css('display','none');
                  $('#menu_typediv').css("display", "none");
                clearall();
                $('#summary_detailed').val('detailed');
                var tot_to=$('#datepickertodt').val(); 
                var fromval=$('#datepickerfrom').val();
                var bydate=$('#bydate').val();
                var voucher=$('#voucher').val();
                var view_mode=$('#summary_detailed').val();
		
				$.post("load_consolidatedreport.php", {type:repttype,fromdt:fromval,todt:tot_to,voucher:voucher,bydate:bydate,modeofview:view_mode},
				function(data)
				   {
					data=$.trim(data);
					$('#reportload').html(data);
				   });
            }           
        else if(repttype=="totalsales_consolidate_report_cr")
            {   
                
                  
                
                
                $('#voucher_login_div').css("display", "none");
                $('#payment_div').css("display", "none");  
                $('#menuname_search_div').css("display", "none");  
                $('#menucategory_div').css("display", "none");
                $('#bank_div').css("display", "none"); 
                $('#voucherdiv').css("display", "none");
                $('#voucherdiv1').css("display", "none");
		        $('#totalsalesdiv').css("display", "block");
                $('#bydatediv').css("display", "block");
                $('#datepickerfromdiv').css("display", "block");
                $('#datepickertodtdiv').css("display", "block");
                $('#dailysalesstatmentdate').css("display", "none");
                $('#prnt').css("display","block");
                $('#cashierdiv').css("display", "none");
                $('#department').css("display", "none");
                $('#creditcategory').css("display", "none");
                $('#taxtypediv').css("display", "none");
                $('#creditdetailsdiv').css("display", "none");
                $('#shiftlogindiv').css("display", "none");
                $('#credit-outstanding').css("display","none");
                $('#creditperson-companydiv').css('display','none');
                $('#creditstaff').css('display','none');
                $('#creditcompany').css('display','none');
                $('#creditguest').css('display','none');
                $('#kitchen-div').css('display','none');
                $('#summary_detaileddiv').css('display','block');
                $('#cashcounterdiv').css('display','none');
                $('#menu_typediv').css("display", "none");
                clearall();
                $('#exp_div_acc').css("display", "none");
                $('#pur_div_acc').css("display", "none");
                var tot_to=$('#datepickertodt').val(); 
                var fromval=$('#datepickerfrom').val();
                var bydate=$('#bydate').val();
                var mode=$('#mode').val();
                 var modeofview=$('#summary_detailed').val();		
				$.post("load_consolidatedreport.php", {type:repttype,fromdt:fromval,todt:tot_to,voucher:voucher,bydate:bydate,mode:mode,view_mode:view_mode,modeofview:modeofview},
				function(data)
				   {
					data=$.trim(data);
					$('#reportload').html(data);
				   });
            }
            else if(repttype=="billwise_item_cr")
            {   
                $('#voucher_login_div').css("display", "none");
                $('#payment_div').css("display", "none");  
                $('#menuname_search_div').css("display", "none");  
                $('#menucategory_div').css("display", "none");
                $('#voucherdiv').css("display", "none");
                $('#bank_div').css("display", "none"); 
                $('#voucherdiv1').css("display", "none");
		        $('#totalsalesdiv').css("display", "block");
                $('#bydatediv').css("display", "block");
                $('#datepickerfromdiv').css("display", "block");
                $('#datepickertodtdiv').css("display", "block");
                $('#dailysalesstatmentdate').css("display", "none");
                $('#prnt').css("display","block");
                $('#cashierdiv').css("display", "none");
                $('#department').css("display", "none");
                $('#creditcategory').css("display", "none");
                $('#taxtypediv').css("display", "none");
                $('#creditdetailsdiv').css("display", "none");
                $('#shiftlogindiv').css("display", "none");
                $('#credit-outstanding').css("display","none");
                $('#creditperson-companydiv').css('display','none');
                $('#creditstaff').css('display','none');
                $('#creditcompany').css('display','none');
                $('#creditguest').css('display','none');
                $('#kitchen-div').css('display','none');
                $('#summary_detaileddiv').css('display','none');
                $('#cashcounterdiv').css('display','none');
                $('#menu_typediv').css("display", "none");
                clearall();
                $('#exp_div_acc').css("display", "none");
                $('#pur_div_acc').css("display", "none");
                var tot_to=$('#datepickertodt').val(); 
                var fromval=$('#datepickerfrom').val();
                var bydate=$('#bydate').val();
                var mode=$('#mode').val();
				$.post("load_consolidatedreport.php", {type:repttype,fromdt:fromval,todt:tot_to,voucher:voucher,bydate:bydate,mode:mode},
				function(data)
				   {
					data=$.trim(data);
					$('#reportload').html(data);
				   });
            }
            else if(repttype=="bill_cancel_consolidated")
            {   
                $('#exp_div_acc').css("display", "none"); 
                $('#pur_div_acc').css("display", "none");
                $('#voucher_login_div').css("display", "none");
                $('#payment_div').css("display", "none");  
                $('#menuname_search_div').css("display", "none");  
                $('#menucategory_div').css("display", "none");
                $('#voucherdiv').css("display", "none");
                $('#bank_div').css("display", "none"); 
                $('#voucherdiv1').css("display", "none");
		        $('#totalsalesdiv').css("display", "block");
                $('#bydatediv').css("display", "block");
                $('#datepickerfromdiv').css("display", "block");
                $('#datepickertodtdiv').css("display", "block");
                $('#dailysalesstatmentdate').css("display", "none");
                $('#prnt').css("display","block");
                $('#cashierdiv').css("display", "none");
                $('#department').css("display", "block");
                $('#creditcategory').css("display", "none");
                $('#taxtypediv').css("display", "none");
                $('#creditdetailsdiv').css("display", "none");
                $('#shiftlogindiv').css("display", "none");
                $('#credit-outstanding').css("display","none");
                $('#creditperson-companydiv').css('display','none');
                $('#creditstaff').css('display','none');
                $('#creditcompany').css('display','none');
                $('#creditguest').css('display','none');
                $('#kitchen-div').css('display','none');
                $('#summary_detaileddiv').css('display','none');
                $('#cashcounterdiv').css('display','none');
                $('#menu_typediv').css("display", "none");
                clearall();              
                var tot_to=$('#datepickertodt').val(); 
                var fromval=$('#datepickerfrom').val();
                var bydate=$('#bydate').val();
                var mode=$('#mode').val();              		
				$.post("load_consolidatedreport.php", {type:repttype,fromdt:fromval,todt:tot_to,voucher:voucher,bydate:bydate,mode:mode},
				function(data)
				   {
					data=$.trim(data);
					$('#reportload').html(data);
				   });
            }
            else if(repttype=="staff_change_log_report")
            {   
                $('#voucher_login_div').css("display", "none");
                $('#payment_div').css("display", "none");  
                $('#menuname_search_div').css("display", "none");  
                $('#menucategory_div').css("display", "none");
                $('#voucherdiv').css("display", "none");
                $('#voucherdiv1').css("display", "none");
                $('#bank_div').css("display", "none"); 
		        $('#totalsalesdiv').css("display", "block");
                $('#bydatediv').css("display", "block");
                $('#datepickerfromdiv').css("display", "block");
                $('#datepickertodtdiv').css("display", "block");
                $('#dailysalesstatmentdate').css("display", "none");
                $('#prnt').css("display","block");
                $('#cashierdiv').css("display", "none");
                $('#department').css("display", "none");
                $('#creditcategory').css("display", "none");
                $('#taxtypediv').css("display", "none");
                $('#creditdetailsdiv').css("display", "none");
                $('#shiftlogindiv').css("display", "none");
                $('#credit-outstanding').css("display","none");
                $('#creditperson-companydiv').css('display','none');
                $('#creditstaff').css('display','none');
                $('#creditcompany').css('display','none');
                $('#creditguest').css('display','none');
                $('#kitchen-div').css('display','none');
                $('#summary_detaileddiv').css('display','none');
                $('#cashcounterdiv').css('display','none');
                $('#menu_typediv').css("display", "none");
                $('#pur_div_acc').css("display", "none");
                clearall();
                var tot_to=$('#datepickertodt').val(); 
                var fromval=$('#datepickerfrom').val();
                var bydate=$('#bydate').val();
                var mode=$('#mode').val();              
				$.post("load_consolidatedreport.php", {type:repttype,fromdt:fromval,todt:tot_to,voucher:voucher,bydate:bydate,mode:mode},
				function(data)
				   {
					data=$.trim(data);
					$('#reportload').html(data);
				   });
            }
            else if(repttype=="voucher_expense")
            { 
                $('#payment_div').css("display", "none");  
            $('#menuname_search_div').css("display", "none");  
                 $('#menucategory_div').css("display", "none");
            $('#taxtypediv').css("display", "none");          
                $('#voucherdiv').css("display", "block");
                  $('#voucherdiv1').css("display", "block");
                   $('#bank_div').css("display", "none"); 
		$('#totalsalesdiv').css("display", "block");
                $('#bydatediv').css("display", "block");
                $('#datepickerfromdiv').css("display", "block");
                $('#datepickertodtdiv').css("display", "block");
                $('#dailysalesstatmentdate').css("display", "none");
                $('#prnt').css("display","block");
                $('#cashierdiv').css("display", "none");
                $('#department').css("display", "none");
                $('#creditcategory').css("display", "none");
                $('#creditdetailsdiv').css("display", "none");
                 $('#shiftlogindiv').css("display", "none");
                 $('#credit-outstanding').css("display","none");
                 $('#creditperson-companydiv').css('display','none');
                $('#creditstaff').css('display','none');
                $('#creditcompany').css('display','none');
                $('#creditguest').css('display','none');
                $('#kitchen-div').css('display','none');
                 $('#summary_detaileddiv').css('display','none');
                  $('#cashcounterdiv').css('display','none');
                  $('#menu_typediv').css("display", "none");
                   $('#fromtimediv').css("display","none");
                $('#totimediv').css("display","none");
                $('#voucher_login_div').css("display", "block");
                  $('#exp_div_acc').css("display", "none");
                  $('#pur_div_acc').css("display", "none");
                clearall();
                 var tot_to=$('#datepickertodt').val(); 
                var fromval=$('#datepickerfrom').val();
                var bydate=$('#bydate').val();
                var voucher=$('#voucher').val();
                 var voucher1=$('#voucher1').val();
                 var voucher_login=$('#voucher_login').val();      
				$.post("load_consolidatedreport.php", {type:repttype,fromdt:fromval,todt:tot_to,voucher:voucher,voucher1:voucher1,voucher_login:voucher_login,bydate:bydate},
				function(data)
				   {
					data=$.trim(data);
					$('#reportload').html(data);
				   });
         }
         else if(repttype=="stock_daywise_report")
            {    
                 $('#voucher_login_div').css("display", "none");
                 $('#payment_div').css("display", "none"); 
                 $('#menuname_search_div').css("display", "block");
                $('#menucategory_div').css("display", "none");
                $('#voucherdiv').css("display", "none");
                  $('#voucherdiv1').css("display", "none");
		$('#totalsalesdiv').css("display", "block");
                $('#bydatediv').css("display", "block");
                 $('#bank_div').css("display", "none"); 
                $('#datepickerfromdiv').css("display", "block");
                $('#datepickertodtdiv').css("display", "block");
                $('#dailysalesstatmentdate').css("display", "none");
                $('#prnt').css("display","block");
                $('#cashierdiv').css("display", "none");
                $('#department').css("display", "none");
                $('#creditcategory').css("display", "none");
                $('#taxtypediv').css("display", "none");
                $('#creditdetailsdiv').css("display", "none");
                 $('#shiftlogindiv').css("display", "none");
                 $('#credit-outstanding').css("display","none");
                 $('#creditperson-companydiv').css('display','none');
                $('#creditstaff').css('display','none');
                $('#creditcompany').css('display','none');
                $('#creditguest').css('display','none');
                $('#kitchen-div').css('display','none');
                 $('#summary_detaileddiv').css('display','none');
                  $('#cashcounterdiv').css('display','none');
                  $('#menu_typediv').css("display", "none");
                    $('#exp_div_acc').css("display", "none");
                    $('#pur_div_acc').css("display", "none");
                clearall();
                 var tot_to=$('#datepickertodt').val(); 
                var fromval=$('#datepickerfrom').val();
                var bydate=$('#bydate').val();
                var voucher=$('#voucher').val();
                var category_menu;	
				$.post("load_consolidatedreport.php", {type:repttype,fromdt:fromval,todt:tot_to,category_menu:'',voucher:voucher,bydate:bydate,addon:''},
				function(data)
				   {
					data=$.trim(data);
					$('#reportload').html(data);
				   });
         }
            else if(repttype=="item_ordered_cr")
            {  
                 $('#voucher_login_div').css("display", "none");
                 $('#payment_div').css("display", "none"); 
                 $('#menuname_search_div').css("display", "block");
                $('#menucategory_div').css("display", "block");
                $('#voucherdiv').css("display", "none");
                  $('#voucherdiv1').css("display", "none");
		$('#totalsalesdiv').css("display", "block");
                $('#bydatediv').css("display", "block");
                 $('#bank_div').css("display", "none"); 
                $('#datepickerfromdiv').css("display", "block");
                $('#datepickertodtdiv').css("display", "block");
                $('#dailysalesstatmentdate').css("display", "none");
                $('#prnt').css("display","block");
                $('#cashierdiv').css("display", "block");
                $('#department').css("display", "none");
                $('#creditcategory').css("display", "none");
                $('#taxtypediv').css("display", "none");
                $('#creditdetailsdiv').css("display", "none");
                 $('#shiftlogindiv').css("display", "none");
                 $('#credit-outstanding').css("display","none");
                 $('#creditperson-companydiv').css('display','none');
                $('#creditstaff').css('display','none');
                $('#creditcompany').css('display','none');
                $('#creditguest').css('display','none');
                $('#kitchen-div').css('display','none');
                 $('#summary_detaileddiv').css('display','block');
                  $('#cashcounterdiv').css('display','none');
                  $('#menu_typediv').css("display", "block");
                    $('#exp_div_acc').css("display", "none");
                    $('#pur_div_acc').css("display", "none");
                    
                clearall();
                 var tot_to=$('#datepickertodt').val(); 
                var fromval=$('#datepickerfrom').val();
                var bydate=$('#bydate').val();
                var voucher=$('#voucher').val();
                var category_menu;
                 var view_mode=$('#summary_detailed').val();                
                 var subcategory=$('#subcategory').val();
                 
                  var staff=$('#cashier').val();
                 
                $.post("load_consolidatedreport.php", {type:repttype,fromdt:fromval,todt:tot_to,category_menu:'',voucher:voucher,bydate:bydate,addon:'',modeofview:view_mode,staff:staff},
				function(data)
				   {
					data=$.trim(data);
					$('#reportload').html(data);
				   });
         }
            else if(repttype=="daily_sales_statement_cr")
            {  
                 $('#voucher_login_div').css("display", "none");
                 $('#payment_div').css("display", "none"); 
            $('#menuname_search_div').css("display", "none");  
                $('#menucategory_div').css("display", "none");          
                $('#voucherdiv').css("display", "none");
                  $('#voucherdiv1').css("display", "none");
                $('#dailysalesstatmentdate').css("display", "block");
                $('#totalsalesdiv').css("display", "none");
                $('#bydatediv').css("display", "block");
                 $('#bank_div').css("display", "none"); 
                $('#datepickerfromdiv').css("display", "block");
                $('#datepickertodtdiv').css("display", "block");
                $('#prnt').css("display","block");
                $('#cashierdiv').css("display", "none");
                $('#department').css("display", "none");
                $('#creditcategory').css("display", "none");
                $('#taxtypediv').css("display", "none");
                $('#creditdetailsdiv').css("display", "none");
                 $('#shiftlogindiv').css("display", "none");
                 $('#credit-outstanding').css("display","none");
                 $('#creditperson-companydiv').css('display','none');
                $('#creditstaff').css('display','none');
                $('#creditcompany').css('display','none');
                $('#creditguest').css('display','none');
                $('#kitchen-div').css('display','none');
                 $('#summary_detaileddiv').css('display','none');
                  $('#cashcounterdiv').css('display','none');
                  $('#menu_typediv').css("display", "none");
                    $('#exp_div_acc').css("display", "none");
                    $('#pur_div_acc').css("display", "none");
                  
                clearall();
                 var tot_to=$('#datepickertodt').val(); 
                var fromval=$('#datepickerfrom').val();
                var bydate=$('#bydate').val();
                var voucher=$('#voucher').val();
                var date=$('#date').val();
				$.post("load_consolidatedreport.php", {type:repttype,date:date,set:"ft"},
				function(data)
				   {
					data=$.trim(data);
					$('#reportload').html(data);
				   });
         }
        
            else if(repttype=="categorywise_report_cr")
            { 
                $('#voucher_login_div').css("display", "none");
                $('#payment_div').css("display", "none");   
                $('#menuname_search_div').css("display", "none");  
                $('#menucategory_div').css("display", "none");           
                $('#voucherdiv').css("display", "none");
                $('#voucherdiv1').css("display", "none");
                $('#dailysalesstatmentdate').css("display", "none");
                $('#totalsalesdiv').css("display", "block");
                $('#bydatediv').css("display", "block");
                $('#datepickerfromdiv').css("display", "block");
                $('#bank_div').css("display", "none"); 
                $('#datepickertodtdiv').css("display", "block");
                $('#cashierdiv').css("display", "none");
                $('#department').css("display", "none");
                $('#prnt').css("display","block");
                $('#creditcategory').css("display", "none");
                $('#taxtypediv').css("display", "none");
                $('#creditdetailsdiv').css("display", "none");
                $('#shiftlogindiv').css("display", "none");
                $('#credit-outstanding').css("display","none");
                $('#creditperson-companydiv').css('display','none');
                $('#creditstaff').css('display','none');
                $('#creditcompany').css('display','none');
                $('#creditguest').css('display','none');
                $('#kitchen-div').css('display','none');
                $('#summary_detaileddiv').css('display','none');
                $('#cashcounterdiv').css('display','none');
                $('#menu_typediv').css("display", "none");
                $('#exp_div_acc').css("display", "none");
                $('#pur_div_acc').css("display", "none");

                clearall();
                var tot_to=$('#datepickertodt').val(); 
                var fromval=$('#datepickerfrom').val();
                var bydate=$('#bydate').val();		
				$.post("load_consolidatedreport.php", {type:repttype,fromdt:fromval,todt:tot_to,voucher:voucher,bydate:bydate},
				function(data)
				   {
					data=$.trim(data);
					$('#reportload').html(data);
				   });         		
         }
            else if(repttype=="cash_settling_report_cr")
            {
                $('#voucher_login_div').css("display", "none");
                $('#payment_div').css("display", "none"); 
                $('#menuname_search_div').css("display", "none");  
                $('#menucategory_div').css("display", "none");
                $('#voucherdiv').css("display", "none");
                $('#voucherdiv1').css("display", "none");
		        $('#totalsalesdiv').css("display", "block");
                $('#cashierdiv').css("display", "block");
                $('#department').css("display", "block");
                $('#bank_div').css("display", "none"); 
                $('#bydatediv').css("display", "block");
                $('#datepickerfromdiv').css("display", "block");
                $('#datepickertodtdiv').css("display", "block");
                $('#taxtypediv').css("display", "none"); 
                $('#dailysalesstatmentdate').css("display", "none");
                $('#prnt').css("display","block");
                $('#creditcategory').css("display", "none");
                $('#shiftlogindiv').css("display", "none");
                $('#creditdetailsdiv').css("display", "none");
                $('#credit-outstanding').css("display","none");
                $('#creditperson-companydiv').css('display','none');
                $('#creditstaff').css('display','none');
                $('#creditcompany').css('display','none');
                $('#creditguest').css('display','none');
                $('#kitchen-div').css('display','none');
                $('#summary_detaileddiv').css('display','none');
                $('#cashcounterdiv').css('display','none');
                $('#menu_typediv').css("display", "none");
                $('#exp_div_acc').css("display", "none");
                $('#pur_div_acc').css("display", "none");
                clearall();
                var tot_to=$('#datepickertodt').val(); 
                var fromval=$('#datepickerfrom').val();
                var bydate=$('#bydate').val();
                var voucher=$('#voucher').val();
                var staff=$('#cashier').val();
                var department=$('#mode').val();
                $("#mode option[value='HD']").hide();
               $.post("load_consolidatedreport.php", {type:repttype,fromdt:fromval,todt:tot_to,voucher:voucher,bydate:bydate,staff:staff,department:department},
				function(data)
				   {                 
					data=$.trim(data);
					$('#reportload').html(data);
				   });        
            }     
            else if(repttype=="kitchen_wise_report_cr")
            {   
                $('#voucher_login_div').css("display", "none");
                $('#fromtimediv').css("display","none");
                $('#totimediv').css("display","none");
                $('#payment_div').css("display", "none"); 
                $('#bank_div').css("display", "none"); 
                $('#menuname_search_div').css("display", "none");  
                $('#menucategory_div').css("display", "none");
                $('#taxtypediv').css("display", "none");
                $('#voucherdiv').css("display", "none");
                $('#voucherdiv1').css("display", "none");
		        $('#totalsalesdiv').css("display", "block");
                $('#bydatediv').css("display", "block");
                $('#datepickerfromdiv').css("display", "block");
                $('#datepickertodtdiv').css("display", "block");
                $('#cashierdiv').css("display", "none");
                $('#department').css("display", "none");
                $('#creditdetailsdiv').css("display", "none");
                $('#shiftlogindiv').css("display", "none");
                $('#credit-outstanding').css("display","none");
                $('#dailysalesstatmentdate').css("display", "none");
                $('#prnt').css("display","block");
                $('#creditcategory').css("display", "none");
                $('#creditperson-companydiv').css('display','none');
                $('#creditstaff').css('display','none');
                $('#creditcompany').css('display','none');
                $('#creditguest').css('display','none');
                $('#kitchen-div').css('display','block');
                $('#summary_detaileddiv').css('display','none');
                $('#cashcounterdiv').css('display','none');
                $('#menu_typediv').css("display", "none");
                $('#exp_div_acc').css("display", "none");
                $('#pur_div_acc').css("display", "none");
                clearall();
                var tot_to=$('#datepickertodt').val(); 
                var fromval=$('#datepickerfrom').val();
                var bydate=$('#bydate').val();
                var department=$('#mode').val();
                var kitchen=$('#kitchen').val();
				$.post("load_consolidatedreport.php", {type:repttype,fromdt:fromval,todt:tot_to,kitchen:kitchen,bydate:bydate},
				function(data)
				   {
					data=$.trim(data);
					$('#reportload').html(data);
				   });           
            }     
            else if(repttype=="discount_report_cr")
            {   
                 $('#voucher_login_div').css("display", "none");
               $('#payment_div').css("display", "none");   
                $('#bank_div').css("display", "none"); 
            $('#menuname_search_div').css("display", "none");  
                $('#menucategory_div').css("display", "none");
                $('#taxtypediv').css("display", "none");
                $('#voucherdiv').css("display", "none");
                  $('#voucherdiv1').css("display", "none");
		$('#totalsalesdiv').css("display", "block");
                $('#bydatediv').css("display", "block");
                $('#datepickerfromdiv').css("display", "block");
                $('#datepickertodtdiv').css("display", "block");
                $('#dailysalesstatmentdate').css("display", "none");
                $('#prnt').css("display","block");
                $('#cashierdiv').css("display", "none");
                $('#department').css("display", "block");
                $('#creditcategory').css("display", "none");
                $('#creditdetailsdiv').css("display", "none");
                 $('#shiftlogindiv').css("display", "none");
                 $('#credit-outstanding').css("display","none");
                 $('#creditperson-companydiv').css('display','none');
                $('#creditstaff').css('display','none');
                $('#creditcompany').css('display','none');
                $('#creditguest').css('display','none');
                $('#kitchen-div').css('display','none');
                 $('#summary_detaileddiv').css('display','none');
                  $('#cashcounterdiv').css('display','none');
                  $('#menu_typediv').css("display", "none");
                    $('#exp_div_acc').css("display", "none");
                    $('#pur_div_acc').css("display", "none");
                clearall();
                var tot_to=$('#datepickertodt').val(); 
                var fromval=$('#datepickerfrom').val();
                var bydate=$('#bydate').val();
                var voucher=$('#voucher').val();
                
                
                if($("#item_disc").prop('checked') == true){
                var item_disc='true'; 
             }else{
               var item_disc='false'; 
           } 
             
             
             var item_disc_type=$('#item_disc_type').val();
              
				$.post("load_consolidatedreport.php", {type:repttype,fromdt:fromval,todt:tot_to,voucher:voucher,bydate:bydate,item_disc_type:item_disc_type,item_disc:item_disc},
				function(data)
				   {
					data=$.trim(data);
					$('#reportload').html(data);
				   });                           
            }
            else if(repttype=="complimentary_cr")
            {  
               $('#voucher_login_div').css("display", "none");
               $('#payment_div').css("display", "none"); 
               $('#bank_div').css("display", "none"); 
               $('#menuname_search_div').css("display", "none");  
               $('#menucategory_div').css("display", "none");
               $('#taxtypediv').css("display", "none");
               $('#voucherdiv').css("display", "none");
                $('#voucherdiv1').css("display", "none");
		$('#totalsalesdiv').css("display", "block");
                $('#bydatediv').css("display", "block");
                $('#datepickerfromdiv').css("display", "block");
                $('#datepickertodtdiv').css("display", "block");
                $('#dailysalesstatmentdate').css("display", "none");
                $('#prnt').css("display","block");
                $('#cashierdiv').css("display", "none");
                $('#department').css("display", "block");
                $('#creditcategory').css("display", "none");
                $('#creditdetailsdiv').css("display", "none");
                 $('#shiftlogindiv').css("display", "none");
                 $('#credit-outstanding').css("display","none");
                 $('#creditperson-companydiv').css('display','none');
                $('#creditstaff').css('display','none');
                $('#creditcompany').css('display','none');
                $('#creditguest').css('display','none');
                $('#kitchen-div').css('display','none');
                 $('#summary_detaileddiv').css('display','none');
                  $('#cashcounterdiv').css('display','none');
                  $('#menu_typediv').css("display", "none");
                    $('#exp_div_acc').css("display", "none");
                    $('#pur_div_acc').css("display", "none");
                clearall();
                var tot_to=$('#datepickertodt').val(); 
                var fromval=$('#datepickerfrom').val();
                var bydate=$('#bydate').val();
                var department=$('#mode').val();
				$.post("load_consolidatedreport.php", {type:repttype,fromdt:fromval,todt:tot_to,voucher:voucher,bydate:bydate,department:department},
				function(data)
				   {
					data=$.trim(data);
					$('#reportload').html(data);
				   });
            }
            else if(repttype=="most_revenue_generated_item_cr")
            {   
                $('#voucher_login_div').css("display", "none");
                 $('#fromtimediv').css("display","none");
                $('#totimediv').css("display","none");
                 $('#payment_div').css("display", "none"); 
                  $('#bank_div').css("display", "none"); 
                $('#menuname_search_div').css("display", "none");   
            $('#menucategory_div').css("display", "none");
                $('#voucherdiv').css("display", "none");
                  $('#voucherdiv1').css("display", "none");
		$('#totalsalesdiv').css("display", "block");
                $('#bydatediv').css("display", "block");
                $('#datepickerfromdiv').css("display", "block");
                $('#datepickertodtdiv').css("display", "block");
                $('#dailysalesstatmentdate').css("display", "none");
                $('#prnt').css("display","block");
                $('#cashierdiv').css("display", "none");
                $('#department').css("display", "block");
                $('#creditcategory').css("display", "none");
               $('#taxtypediv').css("display", "none");
               $('#creditdetailsdiv').css("display", "none");
                $('#shiftlogindiv').css("display", "none");
                $('#credit-outstanding').css("display","none");
                $('#creditperson-companydiv').css('display','none');
                $('#creditstaff').css('display','none');
                $('#creditcompany').css('display','none');
                $('#creditguest').css('display','none');
                $('#kitchen-div').css('display','none');
                 $('#summary_detaileddiv').css('display','none');
                  $('#cashcounterdiv').css('display','none');
                  $('#menu_typediv').css("display", "none");
                    $('#exp_div_acc').css("display", "none");
                    $('#pur_div_acc').css("display", "none");
                clearall();
                var tot_to=$('#datepickertodt').val(); 
                var fromval=$('#datepickerfrom').val();
                var bydate=$('#bydate').val();
                var voucher=$('#voucher').val();
                var mode=$('#mode').val();
                
                
              if($("#most_revenue").prop('checked') == true){
                var most_revenue='Y'; 
             }else{
               var most_revenue='N'; 
             } 
             
             
              if($("#best_selling").prop('checked') == true){
                var best_selling='Y'; 
             }else{
               var best_selling='N'; 
             } 
                
                $.post("load_consolidatedreport.php", {type:repttype,fromdt:fromval,todt:tot_to,bydate:bydate,department:mode,most_revenue:most_revenue,best_selling:best_selling},
				function(data)
				   {
					data=$.trim(data);
					$('#reportload').html(data);
				   });
             }
               
        
            else if(repttype=="hourlywise_report_cr")
            { 
            $('#voucher_login_div').css("display", "none");
             $('#payment_div').css("display", "none");    
              $('#bank_div').css("display", "none"); 
            $('#menuname_search_div').css("display", "none");  
                $('#menucategory_div').css("display", "none");
                $('#taxtypediv').css("display", "none");
                $('#voucherdiv').css("display", "none");
                  $('#voucherdiv1').css("display", "none");
		$('#totalsalesdiv').css("display", "block");
                $('#bydatediv').css("display", "none");
                $('#datepickerfromdiv').css("display", "block");
                $('#datepickertodtdiv').css("display", "block");
                $('#dailysalesstatmentdate').css("display", "none");
                $('#prnt').css("display","block");
                $('#cashierdiv').css("display", "none");
                $('#department').css("display", "block");
                $('#creditcategory').css("display", "none");
                $('#fromtimediv').css("display","block");
                $('#totimediv').css("display","block");
               $('#daydiv').css("display","block");
               $('#creditdetailsdiv').css("display", "none");
                $('#shiftlogindiv').css("display", "none");
                $('#credit-outstanding').css("display","none");
                $('#creditperson-companydiv').css('display','none');
                $('#creditstaff').css('display','none');
                $('#creditcompany').css('display','none');
                $('#creditguest').css('display','none');
                $('#kitchen-div').css('display','none');
                 $('#summary_detaileddiv').css('display','none');
                  $('#cashcounterdiv').css('display','none');
                  $('#menu_typediv').css("display", "none");
                clearall();
                var tot_to=$('#datepickertodt').val(); 
                var fromval=$('#datepickerfrom').val();
                  $('#exp_div_acc').css("display", "none"); 
                  $('#pur_div_acc').css("display", "none");
                var voucher=$('#voucher').val();
                var mode=$('#mode').val();               
                var bydate=$('#bydate').val();
                var day=$('#day').val();
                var fromtime=$('#display_timefrom').html();
                var totime=$('#display_timeto').html();
                $.post("load_consolidatedreport.php", {type:repttype,fromdt:fromval,todt:tot_to,bydate:bydate,department:mode,fromtime:fromtime,totime:totime,day:day},
				function(data)
				   {
					data=$.trim(data);
					$('#reportload').html(data);
				   });           
            }        
else if(repttype=="credit_summary_client")
            { 
                 $('#voucher_login_div').css("display", "none");
             $('#payment_div').css("display", "none"); 
              $('#bank_div').css("display", "none"); 
            $('#menuname_search_div').css("display", "none");  
                $('#menucategory_div').css("display", "none");
                $('#voucherdiv').css("display", "none");
                  $('#voucherdiv1').css("display", "none");
		$('#totalsalesdiv').css("display", "block");
                $('#bydatediv').css("display", "block");
                $('#datepickerfromdiv').css("display", "block");
                $('#datepickertodtdiv').css("display", "block");
                $('#dailysalesstatmentdate').css("display", "none");
                $('#prnt').css("display","block");
                $('#cashierdiv').css("display", "none");
                $('#department').css("display", "none");
                $('#creditcategory').css("display", "none");
                $('#taxtypediv').css("display", "none");
                $('#creditdetailsdiv').css("display", "block");
                $('#fromtimediv').css("display","none");
                $('#totimediv').css("display","none");
                 $('#shiftlogindiv').css("display", "none");
               $('#daydiv').css("display","none");
               $('#credit-outstanding').css("display","none");
               $('#kitchen-div').css('display','none');
                $('#summary_detaileddiv').css('display','none');
                 $('#cashcounterdiv').css('display','none');
                 $('#menu_typediv').css("display", "none");
                   $('#exp_div_acc').css("display", "none");
                   $('#pur_div_acc').css("display", "none");
                clearall();
                var tot_to=$('#datepickertodt').val(); 
                var fromval=$('#datepickerfrom').val();
                var bydate=$('#bydate').val();
                var creditstaff=$('#bycreditstaff').val();
                 var status='';
                 var credit_staff_company='';
                if($('#credit-outstanding-select').is(":checked")){ status='true' } else{ status='false' };		
				$.post("load_consolidatedreport.php", {type:repttype,fromdt:fromval,todt:tot_to,creditstaff:creditstaff,bydate:bydate,checkedstatus:status,credit_staff_company:credit_staff_company},
				function(data)
				   {
					data=$.trim(data);
					$('#reportload').html(data);
				   });
            }
            else if(repttype=="consolidated_credit_summury")
            { 
                 $('#voucher_login_div').css("display", "none");
             $('#payment_div').css("display", "none"); 
              $('#bank_div').css("display", "none"); 
            $('#menuname_search_div').css("display", "none");  
                $('#menucategory_div').css("display", "none");
                $('#voucherdiv').css("display", "none");
                  $('#voucherdiv1').css("display", "none");
		$('#totalsalesdiv').css("display", "block");
                $('#bydatediv').css("display", "block");
                $('#datepickerfromdiv').css("display", "block");
                $('#datepickertodtdiv').css("display", "block");
                $('#dailysalesstatmentdate').css("display", "none");
                $('#prnt').css("display","block");
                $('#cashierdiv').css("display", "none");
                $('#department').css("display", "none");
                $('#creditcategory').css("display", "none");
                $('#taxtypediv').css("display", "none");
                $('#creditdetailsdiv').css("display", "block");
                $('#fromtimediv').css("display","none");
                $('#totimediv').css("display","none");
                 $('#shiftlogindiv').css("display", "none");
               $('#daydiv').css("display","none");
               $('#credit-outstanding').css("display","block");
               $('#kitchen-div').css('display','none');
                $('#summary_detaileddiv').css('display','none');
                 $('#cashcounterdiv').css('display','none');
                 $('#menu_typediv').css("display", "none");
                   $('#exp_div_acc').css("display", "none");
                   $('#pur_div_acc').css("display", "none");
                clearall();
                var tot_to=$('#datepickertodt').val(); 
                var fromval=$('#datepickerfrom').val();
                var bydate=$('#bydate').val();
                var creditstaff=$('#bycreditstaff').val();
                 var status='';
                 var credit_staff_company='';
                 
                if($('#credit-outstanding-select').is(":checked")){ status='true' } else{ status='false' };
                
                var credit_partial_pay='';
                if($('#credit_partial_pay').is(":checked")){ credit_partial_pay='Y' } else{ credit_partial_pay='N' };
                
				$.post("load_consolidatedreport.php", {type:repttype,fromdt:fromval,todt:tot_to,creditstaff:creditstaff,bydate:bydate,
                                 credit_partial_pay:credit_partial_pay,checkedstatus:status,credit_staff_company:credit_staff_company},
				function(data)
				   {
					data=$.trim(data);
					$('#reportload').html(data);
				   });
            }
            else if(repttype=="tips_collected_consolidated")
            {   
                $('#voucher_login_div').css("display", "none");
                $('#payment_div').css("display", "none"); 
                 $('#bank_div').css("display", "none"); 
                $('#menuname_search_div').css("display", "none");  
                $('#menucategory_div').css("display", "none");
                $('#voucherdiv').css("display", "none");
                $('#voucherdiv1').css("display", "none");
		$('#totalsalesdiv').css("display", "block");
                $('#bydatediv').css("display", "block");
                $('#datepickerfromdiv').css("display", "block");
                $('#datepickertodtdiv').css("display", "block");
                $('#dailysalesstatmentdate').css("display", "none");
                $('#prnt').css("display","block");
                $('#cashierdiv').css("display", "none");
                $('#department').css("display", "none");
                $('#creditcategory').css("display", "none");
                $('#taxtypediv').css("display", "none");
                $('#creditdetailsdiv').css("display", "none");
                $('#shiftlogindiv').css("display", "none");
                $('#credit-outstanding').css("display","none");
                $('#creditperson-companydiv').css('display','none');
                $('#creditstaff').css('display','none');
                $('#creditcompany').css('display','none');
                $('#creditguest').css('display','none');
                $('#kitchen-div').css('display','none');
                 $('#summary_detaileddiv').css('display','block');
                $('#cashcounterdiv').css('display','none');
                $('#menu_typediv').css("display", "none");              
                  $('#exp_div_acc').css("display", "none");
                  $('#pur_div_acc').css("display", "none");
                clearall();
                var tot_to=$('#datepickertodt').val(); 
                var fromval=$('#datepickerfrom').val();
                var bydate=$('#bydate').val();
                var view_mode=$('#summary_detailed').val();
                $.post("load_consolidatedreport.php", {type:repttype,fromdt:fromval,todt:tot_to,bydate:bydate,modeofview:view_mode},
				function(data)
				   {
					data=$.trim(data);
					$('#reportload').html(data);
				   });
              }
}
function movetoexcelForm()
{
    
    
    var check = confirm("Are you sure you want to create excel sheet of these records?");
    if(check==true)
            {
		var vv=document.getElementById("typeval").value;
		if(vv=="sales_summary_report_cr")
            {  
                
            var fromval=$('#datepickerfrom').val();
			var tot_to=$('#datepickertodt').val();
			var bydate=$('#bydate').val();
            var voucher="";                               
			window.location="consolidatedexcel_download.php?type="+vv+"&fromdt="+fromval+"&todt="+tot_to+"&bydate="+bydate;			
                    } 
                    
            if(vv=="counter_shift_cr")
             {                      
            var fromval=$('#datepickerfrom').val();
			var tot_to=$('#datepickertodt').val();
			var bydate=$('#bydate').val();
            var voucher="";
             window.location="consolidatedexcel_download.php?type="+vv+"&fromdt="+fromval+"&todt="+tot_to+"&bydate="+bydate+"&shiftlogin=all";
	   }
               
               
             if(vv=="bill_wise_lukado")
             {                      
            var fromval=$('#datepickerfrom').val();
			var tot_to=$('#datepickertodt').val();
			var bydate=$('#bydate').val();
            var voucher="";
            
            var phone_order=$('#phone_order').val();
            
             window.location="consolidatedexcel_download.php?type="+vv+"&fromdt="+fromval+"&todt="+tot_to+"&bydate="+bydate+"&phone_order="+phone_order+"&shiftlogin=all";
             
	   }
                        
             if(vv=="tax_report")
                    {                       
             var fromval=$('#datepickerfrom').val();
			var tot_to=$('#datepickertodt').val();
			var bydate=$('#bydate').val();
                        var voucher="";
                        var department=$('#mode').val();
                        var tax = $('#taxtype').val();
                 window.location="consolidatedexcel_download.php?type="+vv+"&fromdt="+fromval+"&todt="+tot_to+"&bydate="+bydate+"&tax="+tax+"&department="+department;
			}
                        
                        
           if(vv=="totalsales_consolidate_report_cr")
           {
               
            var loginstaffsel = $('#staff_ta').val();
            var tot_from=$('#datepickerfrom').val();
            var tot_to=$('#datepickertodt').val();
            var department=$('#mode').val();
            var hidbydate=$('#bydate').val();
            var a4paper=$('#hida4settings').val();
            var view_mode=$('#summary_detailed').val();
            var staff_hd=$('#staff_hd').val();
            var floorz=$('#floor_di').val();     
          
            
          if($("#tax_adsr").prop('checked') == true){
                var tax_adsr='true'; 
             }else{
               var tax_adsr='false'; 
           } 
           
           if($("#nontax").prop('checked') == true){
                var non_tax='true'; 
             }else{
               var non_tax='false'; 
           } 
          
           if($("#hsn_code").prop('checked') == true){
                var hsn_code='true'; 
                
               
                
             }else{
               var hsn_code='false'; 
               
           } 
          
           if($("#hsn_billwise").prop('checked') == true){
                var hsn_billwise='true'; 
                
                
             }else{
                var hsn_billwise='false'; 
                
             } 
          
          
          
          
          
           var hsn_code_search=  $('#hsn_code_search').val();
          
            $('.confrmation_overlay_proce').css('display','block');
            $('.confrmation_overlay_proce').html('<img src="img/ajax-loaders/fetch.gif" />');
            
            window.location="consolidatedexcel_download.php?type="+vv+"&fromdt="+tot_from+"&todt="+tot_to+"&bydate="+hidbydate+
            "&floorz="+floorz+"&staff_hd="+staff_hd+"&loginstaffsel="+loginstaffsel+"&department="+department+
            "&modeofview="+view_mode+"&non_tax="+non_tax+"&tax_adsr="+tax_adsr+"&hsn_code="+hsn_code+
            "&hsn_code_search="+hsn_code_search+"&hsn_billwise="+hsn_billwise;
    
            $('.confrmation_overlay_proce').css('display','none');
     
          
           }
            if(vv=="billwise_item_cr")
                    {
                        
                        var fromval=$('#datepickerfrom').val();
			var tot_to=$('#datepickertodt').val();
			var bydate=$('#bydate').val();
                        var voucher="";
                        var department=$('#mode').val();
                        var tax = $('#taxtype').val();
                        var comp_item=$('#comp_item').val();
                        
                    window.location="consolidatedexcel_download.php?type="+vv+"&fromdt="+fromval+"&todt="+tot_to+"&bydate="+bydate+
                            "&tax="+tax+"&department="+department+"&comp_item="+comp_item;
                   
                   
                   
                   }
                    if(vv=="consolidated_timely_report")
                    {                      
                        var fromval=$('#datepickerfrom').val();
			var tot_to=$('#datepickertodt').val();
			var bydate=$('#bydate').val();
                        var voucher="";
                        var department=$('#mode').val();
                        var tax = $('#taxtype').val();          
                        
			window.location="consolidatedexcel_download.php?type="+vv+"&fromdt="+fromval+"&todt="+tot_to+"&bydate="+bydate+"&tax="+tax+"&department="+department;
			
                      }                   
                     if(vv=="consolidated_cancel_report")
                    {                      
                            var fromval=$('#datepickerfrom').val();
			var tot_to=$('#datepickertodt').val();
			var bydate=$('#bydate').val();
                        var voucher="";
                        var department=$('#mode').val();                      
					window.location="consolidatedexcel_download.php?type="+vv+"&fromdt="+fromval+"&todt="+tot_to+"&bydate="+bydate+"&department="+department;
			}
                 if(vv=="consolidated_payment_cr")
                    {                      
                          var fromval=$('#datepickerfrom').val();
			var tot_to=$('#datepickertodt').val();
			var bydate=$('#bydate').val();
                        var voucher="";
                        var department=$('#mode').val();
                         var payment=$('#paytype').val();
                          var bank_name=$('#bank_name').val();
            window.location="consolidatedexcel_download.php?type="+vv+"&fromdt="+fromval+"&todt="+tot_to+"&bydate="+bydate+"&department="+department+"&payment="+payment+"&bank_name="+bank_name;
		}      
        if(vv=="consolidated_shift_report")
                    {                      
                        var fromval=$('#datepickerfrom').val();
			var tot_to=$('#datepickertodt').val();
			var bydate=$('#bydate').val();
                        var voucher="";
                        var department=$('#mode').val();
                 var shiftlogin=$('#shiftlogin').val();              
					window.location="consolidatedexcel_download.php?type="+vv+"&fromdt="+fromval+"&todt="+tot_to+"&bydate="+bydate+"&department="+department+"&shiftlogin="+shiftlogin;
                    }
                   else if(vv=="summary_report_cr")
                    {                        
                                   var fromval=$('#datepickerfrom').val();
			            var tot_to=$('#datepickertodt').val();
			            var bydate=$('#bydate').val();
                                     var voucher="";               
					window.location="consolidatedexcel_download.php?type="+vv+"&fromdt="+fromval+"&todt="+tot_to+"&bydate="+bydate;
                    }
                    else if(vv=="categorywise_report_cr")
                    {                       
                        var fromval=$('#datepickerfrom').val();
			var tot_to=$('#datepickertodt').val();
			var bydate=$('#bydate').val();
                        var voucher="";               
					window.location="consolidatedexcel_download.php?type="+vv+"&fromdt="+fromval+"&todt="+tot_to+"&bydate="+bydate;					  
                    }
                       else if(vv=="expense_acc_report")
                    {
                var category_menu=$('#menucategory').val();
                  var menu_search=$('#menuname_search').val();
            var fromval=$('#datepickerfrom').val();
			var tot_to=$('#datepickertodt').val();
			var bydate=$('#bydate').val();
                        var voucher="";
                        var addon=$('#menu_type').val();
                         var acc_type=  $('#exp_type_acc').val();
                          var from_all=$('#from_acc').val();
            var ledger=from_all.split('*');
           var from_ledger=ledger[0];
            var  from_vendor=ledger[1];
            var from_staff=ledger[2];    
            var to_all=$('#to_acc').val();
             var ledger1=to_all.split('*');
             var to_ledger=ledger1[0];
              var  to_vendor=ledger1[1];
             var to_staff=ledger1[2];    
              window.location="consolidatedexcel_download.php?type="+vv+"&fromdt="+fromval+"&todt="+tot_to+"&bydate="+bydate+"&menu_search="+menu_search+"&category_menu="+category_menu+"&addon="+addon+"&acc_type="+acc_type+"&from_ledger="+from_ledger+"&from_vendor="+from_vendor+"&from_staff="+from_staff+"&to_ledger="+to_ledger+"&to_vendor="+to_vendor+"&to_staff="+to_staff;
			}
            else if(vv=="purchase_acc_report")
            {
            var category_menu=$('#menucategory').val();
            var menu_search=$('#menuname_search').val();
            var fromval=$('#datepickerfrom').val();
			var tot_to=$('#datepickertodt').val();
			var bydate=$('#bydate').val();
            var voucher="";
            var addon=$('#menu_type').val();
            var pur_acc_type=  $('#pur_type_acc').val();
            var from_all=$('#from_acc').val();
            var ledger=from_all.split('*');
            var from_ledger=ledger[0];
            var  from_vendor=ledger[1];
            var from_staff=ledger[2];    
            var to_all=$('#to_acc').val();
            var ledger1=to_all.split('*');
            var to_ledger=ledger1[0];
            var  to_vendor=ledger1[1];
            var to_staff=ledger1[2];    
              window.location="consolidatedexcel_download.php?type="+vv+"&fromdt="+fromval+"&todt="+tot_to+"&bydate="+bydate+"&menu_search="+menu_search+"&category_menu="+category_menu+"&addon="+addon+"&pur_acc_type="+pur_acc_type+"&from_ledger="+from_ledger+"&from_vendor="+from_vendor+"&from_staff="+from_staff+"&to_ledger="+to_ledger+"&to_vendor="+to_vendor+"&to_staff="+to_staff;
			}
             else if(vv=="stock_daywise_report")
                    {
                var category_menu=$('#menucategory').val();
                  var menu_search=$('#menuname_search').val();
                        var fromval=$('#datepickerfrom').val();
			var tot_to=$('#datepickertodt').val();
			var bydate=$('#bydate').val();
                        var voucher="";
                        var addon=$('#menu_type').val();
                  window.location="consolidatedexcel_download.php?type="+vv+"&fromdt="+fromval+"&todt="+tot_to+"&bydate="+bydate+"&menu_search="+menu_search+"&category_menu="+category_menu+"&addon="+addon;		  
                    }
                    else if(vv=="item_ordered_cr")
                    {
                     var category_menu=$('#menucategory').val();
                  var menu_search=$('#menuname_search').val();
                        var fromval=$('#datepickerfrom').val();
			var tot_to=$('#datepickertodt').val();
			var bydate=$('#bydate').val();
                        var voucher="";
                        var addon=$('#menu_type').val();
                          var view_mode=$('#summary_detailed').val();
                           var subcategory=$('#subcategory').val();
                           
                            var staff=$('#cashier').val(); 
                   window.location="consolidatedexcel_download.php?type="+vv+"&fromdt="+fromval+"&todt="+tot_to+"&bydate="+bydate+"&menu_search="+menu_search+"&category_menu="+category_menu+"&addon="+addon+"&modeofview="+view_mode+"&subcategory="+subcategory+"&staff="+staff;
	                 }
             else if(vv=="total_summary_details_cr")
                    {
                   var fromval=$('#datepickerfrom').val();
			var tot_to=$('#datepickertodt').val();
			var bydate=$('#bydate').val();
                        var voucher="";
                        var view_mode=$('#summary_detailed').val();
                   window.location="consolidatedexcel_download.php?type="+vv+"&fromdt="+fromval+"&todt="+tot_to+"&bydate="+bydate+"&modeofview="+view_mode;
		            }
             else if(vv=="voucher_expense")
                    {
             var fromval=$('#datepickerfrom').val();
			var tot_to=$('#datepickertodt').val();
			var bydate=$('#bydate').val();
                        var voucher=$('#voucher').val();
                        var voucher1=$('#voucher1').val();
                          var voucher_login=$('#voucher_login').val();
             window.location="consolidatedexcel_download.php?type="+vv+"&fromdt="+fromval+"&todt="+tot_to+"&voucher1="+voucher1+"&bydate="+bydate+"&voucher="+voucher+"&voucher_login="+voucher_login;
		}      
             else if(vv=="cash_settling_report_cr")
                    {
                 var tot_to=$('#datepickertodt').val(); 
                var fromval=$('#datepickerfrom').val();
                var bydate=$('#bydate').val();
                var voucher=$('#voucher').val();
                var staff=$('#cashier').val();
                var department=$('#mode').val();
          window.location="consolidatedexcel_download.php?type="+vv+"&fromdt="+fromval+"&todt="+tot_to+"&bydate="+bydate+"&staff="+staff+"&department="+department;                                        
			}  
            else if(vv=="kitchen_wise_report_cr")
                    {
                 var tot_to=$('#datepickertodt').val(); 
                var fromval=$('#datepickerfrom').val();
                var kitchen=$('#kitchen').val();
                var bydate=$('#bydate').val();
           window.location="consolidatedexcel_download.php?type="+vv+"&fromdt="+fromval+"&todt="+tot_to+"&kitchen="+kitchen+"&bydate="+bydate;                                        
			}
              else if(vv=="discount_report_cr")
                    {
              var fromval=$('#datepickerfrom').val();
			var tot_to=$('#datepickertodt').val();
			var bydate=$('#bydate').val();
                var department=$('#mode').val();
                        var voucher="";
                        
                          if($("#item_disc").prop('checked') == true){
                var item_disc='true'; 
             }else{
               var item_disc='false'; 
           } 
             
             
             var item_disc_type=$('#item_disc_type').val();
                        
                        
            window.location="consolidatedexcel_download.php?type="+vv+"&fromdt="+fromval+"&todt="+tot_to+"&bydate="+bydate+"&department="+department+"&item_disc_type="+item_disc_type+"&item_disc="+item_disc;
			}
             else if(vv=="complimentary_cr")
                    {
                    var fromval=$('#datepickerfrom').val();
			var tot_to=$('#datepickertodt').val();
			var bydate=$('#bydate').val();
                        var department=$('#mode').val();
                        var voucher="";
                        
             if($("#comp_item_wise").prop('checked') == true){
                var comp_item_wise='true'; 
             }else{
               var comp_item_wise='false'; 
             } 
           
                   window.location="consolidatedexcel_download.php?type="+vv+"&fromdt="+fromval+"&todt="+tot_to+"&bydate="+bydate+"&department="+department+"&comp_item_wise="+comp_item_wise;
                
                }
                    else if(vv=="most_revenue_generated_item_cr")
                    {
                     var fromval=$('#datepickerfrom').val();
			var tot_to=$('#datepickertodt').val();
			var bydate=$('#bydate').val();
                        var mode=$('#mode').val();
                        
             if($("#most_revenue").prop('checked') == true){
                var most_revenue='Y'; 
             }else{
               var most_revenue='N'; 
             } 
             
             
              if($("#best_selling").prop('checked') == true){
                var best_selling='Y'; 
             }else{
               var best_selling='N'; 
             } 
                        
                    window.location="consolidatedexcel_download.php?type="+vv+"&fromdt="+fromval+"&todt="+tot_to+"&bydate="+bydate+"&department="+mode+"&most_revenue="+most_revenue+"&best_selling="+best_selling;
		            }
                    else if(vv=="hourlywise_report_cr")
                    {
                     var fromval=$('#datepickerfrom').val();
			var tot_to=$('#datepickertodt').val();
			var bydate=$('#bydate').val();
                        var mode=$('#mode').val();
                        var day=$('#day').val();
                        var fromtime=$('#display_timefrom').html();
                        var totime=$('#display_timeto').html();
                    window.location="consolidatedexcel_download.php?type="+vv+"&fromdt="+fromval+"&todt="+tot_to+"&bydate="+bydate+"&department="+mode+"&fromtime="+fromtime+"&totime="+totime+"&day="+day;
		}
                    else if(vv=="credit_summary_client")
                    {
            var fromval=$('#datepickerfrom').val();
			var tot_to=$('#datepickertodt').val();
			var bydate=$('#bydate').val();
                        var creditstaff=$('#bycreditstaff').val();
                        var status='';
                        if($('#credit-outstanding-select').is(":checked")){ status='true' } else{ status='false' };
                        var credit_staff_company='';
                            if(creditstaff!=''){
                                if(creditstaff==2){
                                   credit_staff_company= $('#creditstaff').val();
                                }
                                else if(creditstaff==3){
                                  credit_staff_company=$('#creditcompany').val();
                                }
                                else if(creditstaff==4){
                                   credit_staff_company=$('#creditguest').val();
                                }
                        }
                 window.location="consolidatedexcel_download.php?type="+vv+"&fromdt="+fromval+"&todt="+tot_to+"&bydate="+bydate+"&creditstaff="+creditstaff+"&credit_staff_company="+credit_staff_company+"&checkedstatus="+status;
			}
                    else if(vv=="consolidated_credit_summury")
                    {
                        var fromval=$('#datepickerfrom').val();
			var tot_to=$('#datepickertodt').val();
			var bydate=$('#bydate').val();
                        var creditstaff=$('#bycreditstaff').val();
                        var status='';
                        if($('#credit-outstanding-select').is(":checked")){ status='true' } else{ status='false' };
                        
                var credit_partial_pay='';
                if($('#credit_partial_pay').is(":checked")){ credit_partial_pay='Y' } else{ credit_partial_pay='N' };
                        
                            var credit_staff_company='';
                            if(creditstaff!=''){
                                if(creditstaff==2){
                                   credit_staff_company= $('#creditstaff').val();
                                }
                                else if(creditstaff==3){
                                  credit_staff_company=$('#creditcompany').val();
                                }
                                else if(creditstaff==4){
                                   credit_staff_company=$('#creditguest').val();
                                }
                        }
                              window.location="consolidatedexcel_download.php?type="+vv+"&fromdt="+fromval+"&todt="+tot_to+"&bydate="+bydate+
                              "&creditstaff="+creditstaff+"&credit_staff_company="+credit_staff_company+"&checkedstatus="+status+"&credit_partial_pay="+credit_partial_pay;
			}
                    else if(vv=="tips_collected_consolidated")
                    {
                        var fromval=$('#datepickerfrom').val();
			var tot_to=$('#datepickertodt').val();
			var bydate=$('#bydate').val();
                        var view_mode=$('#summary_detailed').val();
                          window.location="consolidatedexcel_download.php?type="+vv+"&fromdt="+fromval+"&todt="+tot_to+"&bydate="+bydate+"&modeofview="+view_mode;
		   }
            }
}

function print_page()
{ 
    var vv=document.getElementById("typeval").value;
    var printera4 = $('#typeval').find('option:selected').attr('printtype');
    var printername='';
    var ofprint='';
    if(printera4=='N')
	{
            printername = $('#typeval').find('option:selected').attr('printername');
	}
	ofprint = $('#typeval').find('option:selected').attr('printof');
        
        if(vv=="sales_summary_report_cr")
	     { 
            vv=ofprint;
            var tot_from=$('#datepickerfrom').val();
            var tot_to=$('#datepickertodt').val();
            var hidbydate=$('#bydate').val();
            var a4paper=$('#hida4settings').val();        
                if(printera4=="N")
                {
                     window.open("consolidated_a4print.php?type="+vv+"&fromdt="+tot_from+"&todt="+tot_to+"&bydate="+hidbydate+"#print",'_blank');
				}
                else
                {
                $.post("consolidatedreport_print.php", {type:vv,fromdt:tot_from,todt:tot_to,bydate:hidbydate},
                function(data)
                {
                    data=$.trim(data);
                    data=data.split('**');
                    if(data[1]=='failed'){
					    $('#rptstatus').css("display", "block");
                        var rptstatuschk=$('#rptstatus');
                        rptstatuschk.text(data[2]);	
                        $("#rptstatus").delay(1000).fadeOut('slow');
                        }
                });
                }
	}
         else if(vv=="loyalty_staff_cr")
	     {
            vv=ofprint;
            var tot_from=$('#datepickerfrom').val();
            var tot_to=$('#datepickertodt').val();
            var hidbydate=$('#bydate').val();
            var a4paper=$('#hida4settings').val();        
                            if(printera4=="N")
                                {
                                    window.open("consolidated_a4print.php?type="+vv+"&fromdt="+tot_from+"&todt="+tot_to+"&bydate="+hidbydate+"#print",'_blank');
				}
                            else
                                {
                                    $.post("consolidatedreport_print.php", {type:vv,fromdt:tot_from,todt:tot_to,bydate:hidbydate},
                                    function(data)
                                    {
                                        data=$.trim(data);
                                        data=data.split('**');
                                                if(data[1]=='failed'){
							$('#rptstatus').css("display", "block");
                                                        var rptstatuschk=$('#rptstatus');
                                                        rptstatuschk.text(data[2]);	
                                                        $("#rptstatus").delay(1000).fadeOut('slow');
                                                        }
                                    });
                                }
	}  else if(vv=="shift_detail_cr")
	     {
                 
            vv=ofprint;
            var tot_from=$('#datepickerfrom').val();
            var tot_to=$('#datepickertodt').val();
            var hidbydate=$('#bydate').val();
            var a4paper=$('#hida4settings').val();   
            var shiftlogin=$('#shiftlogin').val();    
            
             if($("#comp_item_wise").prop('checked') == true){
                var comp_item_wise='true'; 
             }else{
               var comp_item_wise='false'; 
             } 
            
                            if(printera4=="N")
                                {
                                  window.open("consolidated_a4print.php?type="+vv+"&fromdt="+tot_from+"&todt="+tot_to+"&comp_item_wise="+comp_item_wise
                                  +"&shiftlogin="+shiftlogin+"&bydate="+hidbydate+"#print",'_blank');
				}
                                else
                                {
                                    $.post("consolidatedreport_print.php", {type:vv,fromdt:tot_from,todt:tot_to,bydate:hidbydate},
                                    function(data)
                                    {
                                        data=$.trim(data);
                                        data=data.split('**');
                                                if(data[1]=='failed'){
							$('#rptstatus').css("display", "block");
                                                        var rptstatuschk=$('#rptstatus');
                                                        rptstatuschk.text(data[2]);	
                                                        $("#rptstatus").delay(1000).fadeOut('slow');
                                                        }
                                    });
                                }
	}
        else if(vv=="expense_acc_report")
	     { 
            vv=ofprint;
             var acc_type=  $('#exp_type_acc').val();
            var tot_from=$('#datepickerfrom').val();
            var tot_to=$('#datepickertodt').val();
            var hidbydate=$('#bydate').val();
            var a4paper=$('#hida4settings').val();
            var from_all=$('#from_acc').val();
             var ledger=from_all.split('*');
            var from_ledger=ledger[0];
            var  from_vendor=ledger[1];
             var from_staff=ledger[2];    
             var to_all=$('#to_acc').val();
             var ledger1=to_all.split('*');
             var to_ledger=ledger1[0];
             var  to_vendor=ledger1[1];
            var to_staff=ledger1[2];    
                 if(printera4=="N")
                                { 
                                    window.open("consolidated_a4print.php?type="+vv+"&fromdt="+tot_from+"&todt="+tot_to+"&bydate="+hidbydate+"&acc_type="+acc_type+"&from_ledger="+from_ledger+"&from_vendor="+from_vendor+"&from_staff="+from_staff+"&to_ledger="+to_ledger+"&to_vendor="+to_vendor+"&to_staff="+to_staff+"#print",'_blank');
				}
                            else
                                {
                                    $.post("consolidatedreport_print.php", {type:vv,fromdt:tot_from,todt:tot_to,bydate:hidbydate,acc_type:acc_type,from_ledger:from_ledger,from_vendor:from_vendor,from_staff:from_staff,to_ledger:to_ledger,to_vendor:to_vendor,to_staff:to_staff},
                                    function(data)
                                    {
                                        data=$.trim(data);
                                        data=data.split('**');
                                                if(data[1]=='failed'){
							$('#rptstatus').css("display", "block");
                                                        var rptstatuschk=$('#rptstatus');
                                                        rptstatuschk.text(data[2]);	
                                                        $("#rptstatus").delay(1000).fadeOut('slow');
                                                        }
                                    });
                                }		
	}

 else if(vv=="mult_card_bank_report")
  { 
            vv=ofprint;
             var pur_acc_type=  $('#pur_type_acc').val();
            var tot_from=$('#datepickerfrom').val();
            var tot_to=$('#datepickertodt').val();
            var hidbydate=$('#bydate').val();
            var a4paper=$('#hida4settings').val();
            var from_all=$('#from_acc').val();
             var ledger=from_all.split('*');
            var from_ledger=ledger[0];
            var  from_vendor=ledger[1];
             var from_staff=ledger[2];    
             var to_all=$('#to_acc').val();
             var ledger1=to_all.split('*');
             var to_ledger=ledger1[0];
             var  to_vendor=ledger1[1];
            var to_staff=ledger1[2];    
            
             var card=$('#card_name').val();
               var bank=$('#bank_name').val();
               
                 if(printera4=="N")
                                { 
                                    window.open("consolidated_a4print.php?card_name="+card+"&bank_name="+bank+"&type="+vv+"&fromdt="+tot_from+"&todt="+tot_to+"&bydate="+hidbydate+"&pur_acc_type="+pur_acc_type+"&from_ledger="+from_ledger+"&from_vendor="+from_vendor+"&from_staff="+from_staff+"&to_ledger="+to_ledger+"&to_vendor="+to_vendor+"&to_staff="+to_staff+"#print",'_blank');
				}
                            else
                                {
                                    $.post("consolidatedreport_print.php", {type:vv,fromdt:tot_from,todt:tot_to,bydate:hidbydate,pur_acc_type:pur_acc_type,from_ledger:from_ledger,from_vendor:from_vendor,from_staff:from_staff,to_ledger:to_ledger,to_vendor:to_vendor,to_staff:to_staff},
                                    function(data)
                                    {
                                        data=$.trim(data);
                                        data=data.split('**');
                                                if(data[1]=='failed'){
							$('#rptstatus').css("display", "block");
                                                        var rptstatuschk=$('#rptstatus');
                                                        rptstatuschk.text(data[2]);	
                                                        $("#rptstatus").delay(1000).fadeOut('slow');
                                                        }
                                    });
                                }		
	}
    else if(vv=="purchase_acc_report")
	     { 
            vv=ofprint;
             var pur_acc_type=  $('#pur_type_acc').val();
            var tot_from=$('#datepickerfrom').val();
            var tot_to=$('#datepickertodt').val();
            var hidbydate=$('#bydate').val();
            var a4paper=$('#hida4settings').val();
            var from_all=$('#from_acc').val();
             var ledger=from_all.split('*');
            var from_ledger=ledger[0];
            var  from_vendor=ledger[1];
             var from_staff=ledger[2];    
             var to_all=$('#to_acc').val();
             var ledger1=to_all.split('*');
             var to_ledger=ledger1[0];
             var  to_vendor=ledger1[1];
            var to_staff=ledger1[2];    
                 if(printera4=="N")
                                { 
                                    window.open("consolidated_a4print.php?type="+vv+"&fromdt="+tot_from+"&todt="+tot_to+"&bydate="+hidbydate+"&pur_acc_type="+pur_acc_type+"&from_ledger="+from_ledger+"&from_vendor="+from_vendor+"&from_staff="+from_staff+"&to_ledger="+to_ledger+"&to_vendor="+to_vendor+"&to_staff="+to_staff+"#print",'_blank');
				}
                            else
                                {
                                    $.post("consolidatedreport_print.php", {type:vv,fromdt:tot_from,todt:tot_to,bydate:hidbydate,pur_acc_type:pur_acc_type,from_ledger:from_ledger,from_vendor:from_vendor,from_staff:from_staff,to_ledger:to_ledger,to_vendor:to_vendor,to_staff:to_staff},
                                    function(data)
                                    {
                                        data=$.trim(data);
                                        data=data.split('**');
                                                if(data[1]=='failed'){
							$('#rptstatus').css("display", "block");
                                                        var rptstatuschk=$('#rptstatus');
                                                        rptstatuschk.text(data[2]);	
                                                        $("#rptstatus").delay(1000).fadeOut('slow');
                                                        }
                                    });
                                }		
	}
        else if(vv=="reprint_report")
	     {
            vv=ofprint;
            var tot_from=$('#datepickerfrom').val();
            var tot_to=$('#datepickertodt').val();
            var hidbydate=$('#bydate').val();
            var a4paper=$('#hida4settings').val();       
             if(printera4=="N")
               { 
                window.open("consolidated_a4print.php?type="+vv+"&fromdt="+tot_from+"&todt="+tot_to+"&bydate="+hidbydate+"#print",'_blank');
				}
            else
           {                               
            $.post("consolidatedreport_print.php", {type:vv,fromdt:tot_from,todt:tot_to,bydate:hidbydate},
            function(data)
            {
                data=$.trim(data);
                data=data.split('**');
                if(data[1]=='failed'){
	            $('#rptstatus').css("display", "block");
                var rptstatuschk=$('#rptstatus');
                rptstatuschk.text(data[2]);	
                $("#rptstatus").delay(1000).fadeOut('slow');
                }
            });
        }	
	}
       else if(vv=="advance_payment_cr")
	     { 
            vv=ofprint;
            var tot_from=$('#datepickerfrom').val();
            var tot_to=$('#datepickertodt').val();
            var hidbydate=$('#bydate').val();
            var a4paper=$('#hida4settings').val();       
                            if(printera4=="N")
                                {
                                    window.open("consolidated_a4print.php?type="+vv+"&fromdt="+tot_from+"&todt="+tot_to+"&bydate="+hidbydate+"#print",'_blank');
				}
                            else
                                {
                                    $.post("consolidatedreport_print.php", {type:vv,fromdt:tot_from,todt:tot_to,bydate:hidbydate},
                                    function(data)
                                    {
                                        data=$.trim(data);
                                        data=data.split('**');
                                                if(data[1]=='failed'){
							$('#rptstatus').css("display", "block");
                                                        var rptstatuschk=$('#rptstatus');
                                                        rptstatuschk.text(data[2]);	
                                                        $("#rptstatus").delay(1000).fadeOut('slow');
                                                        }
                                    });
                                }
   }
         else if(vv=="consolidated_timely_report")
	     { 
            vv=ofprint;
            var tot_from=$('#datepickerfrom').val();
            var tot_to=$('#datepickertodt').val();
            var hidbydate=$('#bydate').val();
            var a4paper=$('#hida4settings').val();
            if(printera4=="N")
                 {
                  window.open("consolidated_a4print.php?type="+vv+"&fromdt="+tot_from+"&todt="+tot_to+"&bydate="+hidbydate+"#print",'_blank');
				}
                    else
                       {
                         $.post("consolidatedreport_print.php", {type:vv,fromdt:tot_from,todt:tot_to,bydate:hidbydate},
                                    function(data)
                                    {
                                        data=$.trim(data);
                                        data=data.split('**');
                                                if(data[1]=='failed'){
							$('#rptstatus').css("display", "block");
                                                        var rptstatuschk=$('#rptstatus');
                                                        rptstatuschk.text(data[2]);	
                                                        $("#rptstatus").delay(1000).fadeOut('slow');
                                                        }
                                    });
                                }	
	} 
      else if(vv=="summary_specified_consolidated")
	     { 
            vv=ofprint;
            var tot_from=$('#datepickerfrom').val();
            var tot_to=$('#datepickertodt').val();
            var hidbydate=$('#bydate').val();
            var a4paper=$('#hida4settings').val();     
                if(printera4=="N")
                    {
                       window.open("consolidated_a4print.php?type="+vv+"&fromdt="+tot_from+"&todt="+tot_to+"&bydate="+hidbydate+"#print",'_blank');
				    }
                 else
                    {
                       $.post("consolidatedreport_print.php", {type:vv,fromdt:tot_from,todt:tot_to,bydate:hidbydate},
                       function(data)
                       {
                        data=$.trim(data);
                        data=data.split('**');
                        if(data[1]=='failed'){
						$('#rptstatus').css("display", "block");
                        var rptstatuschk=$('#rptstatus');
                        rptstatuschk.text(data[2]);	
                        $("#rptstatus").delay(1000).fadeOut('slow');
                        }
                        });
                        }		
	}
 else if(vv=="tax_report")
	     { 
            vv=ofprint;
            var tot_from=$('#datepickerfrom').val();
            var tot_to=$('#datepickertodt').val();
            var hidbydate=$('#bydate').val();
            var a4paper=$('#hida4settings').val();
              var tax = $('#taxtype').val();
             var department=$('#mode').val();
           if(printera4=="N") 
                                {
                                    window.open("consolidated_a4print.php?type="+vv+"&fromdt="+tot_from+"&todt="+tot_to+"&tax="+tax+"&bydate="+hidbydate+"&department="+department+"#print",'_blank');
				                }
                            else
                                {
                                    $.post("consolidatedreport_print.php", {type:vv,fromdt:tot_from,todt:tot_to,bydate:hidbydate},
                                    function(data)
                                    {
                                        data=$.trim(data);
                                        data=data.split('**');
                                                if(data[1]=='failed'){
							$('#rptstatus').css("display", "block");
                                                        var rptstatuschk=$('#rptstatus');
                                                        rptstatuschk.text(data[2]);	
                                                        $("#rptstatus").delay(1000).fadeOut('slow');
                                                        }
                                    });
                                }
 	
	}
        else if(vv=="consolidated_cancel_report")
	     { 
            vv=ofprint;
            var tot_from=$('#datepickerfrom').val();
            var tot_to=$('#datepickertodt').val();
            var hidbydate=$('#bydate').val();
            var a4paper=$('#hida4settings').val();
            var department=$('#mode').val();
                    if(printera4=="N") 
                                {
                                    window.open("consolidated_a4print.php?type="+vv+"&fromdt="+tot_from+"&todt="+tot_to+"&bydate="+hidbydate+"&department="+department+"#print",'_blank');
				}
                            else
                                {
                                    $.post("consolidatedreport_print.php", {type:vv,fromdt:tot_from,todt:tot_to,bydate:hidbydate,department:department},
                                    function(data)
                                    {
                                        data=$.trim(data);
                                        data=data.split('**');
                                                if(data[1]=='failed'){
							$('#rptstatus').css("display", "block");
                                                        var rptstatuschk=$('#rptstatus');
                                                        rptstatuschk.text(data[2]);	
                                                        $("#rptstatus").delay(1000).fadeOut('slow');
                                                        }
                                    });
                                }		
	}
          else if(vv=="consolidated_payment_cr")
	     { 
            vv=ofprint;
            var tot_from=$('#datepickerfrom').val();
            var tot_to=$('#datepickertodt').val();
            var hidbydate=$('#bydate').val();
            var a4paper=$('#hida4settings').val();
            var department=$('#mode').val();
         var payment=$('#paytype').val();
        var bank_name=$('#bank_name').val();
          if(printera4=="N") 
                                {
                                    window.open("consolidated_a4print.php?type="+vv+"&fromdt="+tot_from+"&todt="+tot_to+"&bydate="+hidbydate+"&department="+department+"&bank_name="+bank_name+"&payment="+payment+"#print",'_blank');
				}
                            else
                                {
                                    $.post("consolidatedreport_print.php", {type:vv,fromdt:tot_from,todt:tot_to,bydate:hidbydate,department:department,payment:payment,bank_name:bank_name},
                                    function(data)
                                    {
                                        data=$.trim(data);
                                        data=data.split('**');
                                                if(data[1]=='failed'){
							$('#rptstatus').css("display", "block");
                                                        var rptstatuschk=$('#rptstatus');
                                                        rptstatuschk.text(data[2]);	
                                                        $("#rptstatus").delay(1000).fadeOut('slow');
                                                        }
                                    });
                                }
    }
         else if(vv=="consolidated_shift_report")
	     { 
            vv=ofprint;
            var tot_from=$('#datepickerfrom').val();
            var tot_to=$('#datepickertodt').val();
            var modeofview=$('#summary_detailed').val();
            var hidbydate=$('#bydate').val();
            var a4paper=$('#hida4settings').val();
            var department=$('#mode').val();
            var shiftlogin=$('#shiftlogin').val();
            var cashcounter=$('#cashcounter').val();
                    if(printera4=="N") 
                                {
                                    window.open("consolidated_a4print.php?type="+vv+"&fromdt="+tot_from+"&todt="+tot_to+"&bydate="+hidbydate+"&department="+department+"&shiftlogin="+shiftlogin+"&modeofview="+modeofview+"&cashcounter="+cashcounter+"#print",'_blank');
				}
                            else
                                {
                                    $.post("consolidatedreport_print.php", {type:vv,fromdt:tot_from,todt:tot_to,bydate:hidbydate,shiftlogin:shiftlogin,modeofview:modeofview,cashcounter:cashcounter},
                                    function(data)
                                    {
                                        data=$.trim(data);
                                        data=data.split('**');
                                                if(data[1]=='failed'){
							$('#rptstatus').css("display", "block");
                                                        var rptstatuschk=$('#rptstatus');
                                                        rptstatuschk.text(data[2]);	
                                                        $("#rptstatus").delay(1000).fadeOut('slow');
                                                        }
                                    });
                }
    }
        
        else if(vv=="summary_report_cr")
	     { 
            vv=ofprint;
            var tot_from=$('#datepickerfrom').val();
            var tot_to=$('#datepickertodt').val();
            var hidbydate=$('#bydate').val();
            var a4paper=$('#hida4settings').val();
                    if(printera4=="N")
                                {
                                    window.open("consolidated_a4print.php?type="+vv+"&fromdt="+tot_from+"&todt="+tot_to+"&bydate="+hidbydate+"#print",'_blank');
				                    }
                            else
                                {
                                    $.post("consolidatedreport_print.php", {type:vv,fromdt:tot_from,todt:tot_to,bydate:hidbydate},
                                    function(data)
                                    {
                                        data=$.trim(data);
                                        data=data.split('**');
                                                if(data[1]=='failed'){
							$('#rptstatus').css("display", "block");
                                                        var rptstatuschk=$('#rptstatus');
                                                        rptstatuschk.text(data[2]);	
                                                        $("#rptstatus").delay(1000).fadeOut('slow');
                                                        }
                                    });

                                }
 
			
	}
        
        else if(vv=="total_summary_details_cr")
	     {
            vv=ofprint;
            var tot_from=$('#datepickerfrom').val();
            var tot_to=$('#datepickertodt').val();
            var hidbydate=$('#bydate').val();
            var a4paper=$('#hida4settings').val();
            var view_mode=$('#summary_detailed').val();
                            if(printera4=="N")
                                {
                                    window.open("consolidated_a4print.php?type="+vv+"&fromdt="+tot_from+"&todt="+tot_to+"&bydate="+hidbydate+"&modeofview="+view_mode+"#print",'_blank');
				                    }
                            else
                                {
                                    $.post("consolidatedreport_print.php", {type:vv,fromdt:tot_from,todt:tot_to,bydate:hidbydate},
                                    function(data)
                                    {
                                        data=$.trim(data);
                                        data=data.split('**');
                                                if(data[1]=='failed'){
							                $('#rptstatus').css("display", "block");
                                                        var rptstatuschk=$('#rptstatus');
                                                        rptstatuschk.text(data[2]);	
                                                        $("#rptstatus").delay(1000).fadeOut('slow');
                                                        }
                                    });
                                }         	
	}
        
        else if(vv=="totalsales_consolidate_report_cr")
	     { 
            vv=ofprint;
            var loginstaffsel = $('#staff_ta').val();
            var tot_from=$('#datepickerfrom').val();
            var tot_to=$('#datepickertodt').val();
            var department=$('#mode').val();
            var hidbydate=$('#bydate').val();
            var a4paper=$('#hida4settings').val();
            var view_mode=$('#summary_detailed').val();
            var staff_hd=$('#staff_hd').val();
            var floorz=$('#floor_di').val();   
            
              if($("#tax_adsr").prop('checked') == true){
                var tax_adsr='true'; 
             }else{
               var tax_adsr='false'; 
           } 
           
           if($("#nontax").prop('checked') == true){
                var non_tax='true'; 
             }else{
               var non_tax='false'; 
           } 
            
            if($("#hsn_code").prop('checked') == true){
                var hsn_code='true'; 
                
                $('#hsn_search').show();
                
             }else{
               var hsn_code='false'; 
                $('#hsn_search').hide();
           } 
           
           
           var hsn_code_search=  $('#hsn_code_search').val();
            
                            if(printera4=="N")
                                {
                                    window.open("consolidated_a4print.php?non_tax="+non_tax+"&tax_adsr="+tax_adsr+"&type="+vv+"&fromdt="+tot_from
                                            +"&todt="+tot_to+"&bydate="+hidbydate+
                                            "&floorz="+floorz+"&staff_hd="+staff_hd+"&loginstaffsel="+loginstaffsel+"&department="+department+
                                            "&hsn_code_search="+hsn_code_search+"&hsn_code="+hsn_code+"&modeofview="+view_mode+"#print",'_blank');
				}
                                else
                                {
                                    $.post("consolidatedreport_print.php", {non_tax:non_tax ,tax_adsr:tax_adsr,type:vv,fromdt:tot_from,todt:tot_to,bydate:hidbydate,loginstaffsel:loginstaffsel,floorz:floorz,staff_hd:staff_hd,department:department},
                                    function(data)
                                    {
                                        data=$.trim(data);
                                        data=data.split('**');
                                                if(data[1]=='failed'){
							$('#rptstatus').css("display", "block");
                                                        var rptstatuschk=$('#rptstatus');
                                                        rptstatuschk.text(data[2]);	
                                                        $("#rptstatus").delay(1000).fadeOut('slow');
                                                        }
                                    });
                                }
                        
			
	}
        else if(vv=="staff_change_log_report")
	     { 
            vv=ofprint;
            var loginstaffsel = $('#staff_ta').val();
            var tot_from=$('#datepickerfrom').val();
            var tot_to=$('#datepickertodt').val();
            var department=$('#mode').val();
            var hidbydate=$('#bydate').val();
            var a4paper=$('#hida4settings').val();
            var view_mode=$('#summary_detailed').val();
            var staff_hd=$('#staff_hd').val();
            var floorz=$('#floor_di').val();         
                            if(printera4=="N")
                                {                
                                    window.open("consolidated_a4print.php?type="+vv+"&fromdt="+tot_from+"&todt="+tot_to+"&bydate="+hidbydate+"&floorz="+floorz+"&staff_hd="+staff_hd+"&loginstaffsel="+loginstaffsel+"&department="+department+"&modeofview="+view_mode+"#print",'_blank');
				}
                            else
                                {
                                    $.post("consolidatedreport_print.php", {type:vv,fromdt:tot_from,todt:tot_to,bydate:hidbydate,loginstaffsel:loginstaffsel,floorz:floorz,staff_hd:staff_hd,department:department},
                                    function(data)
                                    {
                                        data=$.trim(data);
                                        data=data.split('**');
                                                if(data[1]=='failed'){
							$('#rptstatus').css("display", "block");
                                                        var rptstatuschk=$('#rptstatus');
                                                        rptstatuschk.text(data[2]);	
                                                        $("#rptstatus").delay(1000).fadeOut('slow');
                                                        }
                                    });
                                }		
	}
        else if(vv=="billwise_item_cr")
	     {
            vv=ofprint;
            var loginstaffsel = $('#staff_ta').val();
            var tot_from=$('#datepickerfrom').val();
            var tot_to=$('#datepickertodt').val();
            var department=$('#mode').val();
            var hidbydate=$('#bydate').val();
            var a4paper=$('#hida4settings').val();
            var view_mode=$('#summary_detailed').val();
            var staff_hd=$('#staff_hd').val();
            var floorz=$('#floor_di').val();
             var comp_item=$('#comp_item').val();
                            if(printera4=="N")
                                {
                                    window.open("consolidated_a4print.php?type="+vv+"&fromdt="+tot_from+"&todt="+tot_to+"&bydate="+hidbydate+"&floorz="+floorz+"&staff_hd="+staff_hd+"&loginstaffsel="+loginstaffsel+"&department="+department+"&modeofview="+view_mode+"&comp_item="+comp_item+"#print",'_blank');
				}
                            else
                                {
                                    $.post("consolidatedreport_print.php", {type:vv,fromdt:tot_from,todt:tot_to,bydate:hidbydate,loginstaffsel:loginstaffsel,floorz:floorz,staff_hd:staff_hd,department:department,comp_item:comp_item},
                                    function(data)
                                    {
                                        data=$.trim(data);
                                        data=data.split('**');
                                                if(data[1]=='failed'){
							$('#rptstatus').css("display", "block");
                                                        var rptstatuschk=$('#rptstatus');
                                                        rptstatuschk.text(data[2]);	
                                                        $("#rptstatus").delay(1000).fadeOut('slow');
                                                        }
                                    });

                                }	
	}
         else if(vv=="bill_cancel_consolidated")
	     { 
            vv=ofprint;
            var loginstaffsel = $('#staff_ta').val();
            var tot_from=$('#datepickerfrom').val();
            var tot_to=$('#datepickertodt').val();
            var department=$('#mode').val();
            var hidbydate=$('#bydate').val();
            var a4paper=$('#hida4settings').val();
            var view_mode=$('#summary_detailed').val();
            var staff_hd=$('#staff_hd').val();
            var floorz=$('#floor_di').val();
      
                            if(printera4=="N")
                                {
                                    window.open("consolidated_a4print.php?type="+vv+"&fromdt="+tot_from+"&todt="+tot_to+"&bydate="+hidbydate+"&floorz="+floorz+"&staff_hd="+staff_hd+"&loginstaffsel="+loginstaffsel+"&department="+department+"&modeofview="+view_mode+"#print",'_blank');
				}
                            else
                                {
                                    $.post("consolidatedreport_print.php", {type:vv,fromdt:tot_from,todt:tot_to,bydate:hidbydate,loginstaffsel:loginstaffsel,floorz:floorz,staff_hd:staff_hd,department:department},
                                    function(data)
                                    {
                                        data=$.trim(data);
                                        data=data.split('**');
                                                if(data[1]=='failed'){
							$('#rptstatus').css("display", "block");
                                                        var rptstatuschk=$('#rptstatus');
                                                        rptstatuschk.text(data[2]);	
                                                        $("#rptstatus").delay(1000).fadeOut('slow');
                                                        }
                                    });
                                }	
	}
        else if(vv=="voucher_expense")
	     { 
            vv=ofprint;
            var tot_from=$('#datepickerfrom').val();
            var tot_to=$('#datepickertodt').val();
             var voucher=$('#voucher').val();
             var voucher_login=$('#voucher_login').val();
            var hidbydate=$('#bydate').val();
            var a4paper=$('#hida4settings').val();
            var voucher1=$('#voucher1').val();       
                            if(printera4=="N")
                                {
                             window.open("consolidated_a4print.php?type="+vv+"&fromdt="+tot_from+"&todt="+tot_to+"&bydate="+hidbydate+"&voucher1="+voucher1+"&voucher_login="+voucher_login+"&voucher="+voucher+"#print",'_blank');
				}
                            else
                                {
                                    $.post("consolidatedreport_print.php", {type:vv,fromdt:tot_from,todt:tot_to,bydate:hidbydate,voucher1:voucher1,voucher_login:voucher_login,voucher:voucher},
                                    function(data)
                                    {
                                        data=$.trim(data);
                                        data=data.split('**');
                                                if(data[1]=='failed'){
							$('#rptstatus').css("display", "block");
                                                        var rptstatuschk=$('#rptstatus');
                                                        rptstatuschk.text(data[2]);	
                                                        $("#rptstatus").delay(1000).fadeOut('slow');
                                                        }
                                    });

                       
			
	}
}
        else if(vv=="daily_sales_statement_cr")
	     { 
            vv=ofprint;
            
            var date=$('#date').val();
  
            var a4paper=$('#hida4settings').val();
                     if(printera4=="N")
                                {
                                    window.open("consolidated_a4print.php?type="+vv+"&date="+date+"#print",'_blank');
				}
                            else
                                {
                                    $.post("consolidatedreport_print.php", {type:vv,date:date},
                                    function(data)
                                    {
                                        data=$.trim(data);
                                        data=data.split('**');
                                                if(data[1]=='failed'){
							$('#rptstatus').css("display", "block");
                                                        var rptstatuschk=$('#rptstatus');
                                                        rptstatuschk.text(data[2]);	
                                                        $("#rptstatus").delay(1000).fadeOut('slow');
                                                        }
                                    });

                                }

			
	}
        else if(vv=="stock_daywise_report")
	     {
            vv=ofprint;
            var tot_from=$('#datepickerfrom').val();
            var tot_to=$('#datepickertodt').val();
            var hidbydate=$('#bydate').val();
            var a4paper=$('#hida4settings').val();
             var category_menu=$('#menucategory').val();
                  var menu_search=$('#menuname_search').val();
                  var addon=$('#menu_type').val();
         
                            if(printera4=="N")
                                {
                                    window.open("consolidated_a4print.php?type="+vv+"&fromdt="+tot_from+"&todt="+tot_to+"&bydate="+hidbydate+"&menu_search="+menu_search+"&category_menu="+category_menu+"&addon="+addon+"#print",'_blank');
                                    
				}
                            else
                                {
                                    $.post("consolidatedreport_print.php", {type:vv,fromdt:tot_from,todt:tot_to,bydate:hidbydate,menu_search:menu_search,category_menu:category_menu,addon:addon},
                                    function(data)
                                    {
                                        data=$.trim(data);
                                        data=data.split('**');
                                                if(data[1]=='failed'){
							$('#rptstatus').css("display", "block");
                                                        var rptstatuschk=$('#rptstatus');
                                                        rptstatuschk.text(data[2]);	
                                                        $("#rptstatus").delay(1000).fadeOut('slow');
                                                        }
                                    });

                                }		
	}
        else if(vv=="item_ordered_cr")
	     { 
            vv=ofprint;
            var tot_from=$('#datepickerfrom').val();
            var tot_to=$('#datepickertodt').val();
            var hidbydate=$('#bydate').val();
            var a4paper=$('#hida4settings').val();
             var category_menu=$('#menucategory').val();
                  var menu_search=$('#menuname_search').val();
                  var addon=$('#menu_type').val();
                   var view_mode=$('#summary_detailed').val();
                   var subcategory=$('#subcategory').val();
            var staff=$('#cashier').val(); 
                            if(printera4=="N")
                                {
                                    window.open("consolidated_a4print.php?type="+vv+"&fromdt="+tot_from+"&todt="+tot_to+"&bydate="+hidbydate+"&menu_search="+menu_search+"&subcategory="+subcategory+"&modeofview="+view_mode+"&category_menu="+category_menu+"&addon="+addon+"&staff="+staff+"#print",'_blank');
                                    
				                }
                            else
                                {
                                    $.post("consolidatedreport_print.php", {type:vv,fromdt:tot_from,todt:tot_to,bydate:hidbydate,menu_search:menu_search,category_menu:category_menu,addon:addon,modeofview:view_mode,subcategory:subcategory,staff:staff},
                                    function(data)
                                    {
                                        data=$.trim(data);
                                        data=data.split('**');
                                                if(data[1]=='failed'){
							$('#rptstatus').css("display", "block");
                                                        var rptstatuschk=$('#rptstatus');
                                                        rptstatuschk.text(data[2]);	
                                                        $("#rptstatus").delay(1000).fadeOut('slow');
                                                        }
                                    });
                         }		
	}
      else if(vv=="categorywise_report_cr")
	     { 
            vv=ofprint;
            var tot_from=$('#datepickerfrom').val();
            var tot_to=$('#datepickertodt').val();
            var hidbydate=$('#bydate').val();
            var a4paper=$('#hida4settings').val();
            if(printera4=="N")
                { 
                    window.open("consolidated_a4print.php?type="+vv+"&fromdt="+tot_from+"&todt="+tot_to+"&bydate="+hidbydate+"#print",'_blank');
				}
                else
                { 
                                    $.post("consolidatedreport_print.php", {type:vv,fromdt:tot_from,todt:tot_to,bydate:hidbydate},
                                    function(data)
                                    {
                                        data=$.trim(data);
                                        data=data.split('**');
                                                if(data[1]=='failed'){
							$('#rptstatus').css("display", "block");
                                                        var rptstatuschk=$('#rptstatus');
                                                        rptstatuschk.text(data[2]);	
                                                        $("#rptstatus").delay(1000).fadeOut('slow');
                                                        }
                                    });
                                }
     }   	
     else if(vv=="cash_settling_report_cr")
	     { 
            vv=ofprint;
            var tot_from=$('#datepickerfrom').val();
            var tot_to=$('#datepickertodt').val();
            var hidbydate=$('#bydate').val();
            var a4paper=$('#hida4settings').val();
            var staff=$('#cashier').val();
            var department=$('#mode').val();
            if(printera4=="N")
                {
                                    window.open("consolidated_a4print.php?type="+vv+"&fromdt="+tot_from+"&todt="+tot_to+"&bydate="+hidbydate+"&staff="+staff+"&department="+department+"#print",'_blank');
				}
                            else
                                {
                                    $.post("consolidatedreport_print.php", {type:vv,fromdt:tot_from,todt:tot_to,bydate:hidbydate,staff:staff,department:department},
                                    function(data)
                                    {
                                        data=$.trim(data);
                                        if(data=='a4print'){
                                            window.open("consolidated_a4print.php?type="+vv+"&fromdt="+tot_from+"&todt="+tot_to+"&bydate="+hidbydate+"&staff="+staff+"&department="+department+"#print",'_blank');
                                        }
                                        else{
                                            data=data.split('**');
                                                if(data[1]=='failed'){
							$('#rptstatus').css("display", "block");
                                                        var rptstatuschk=$('#rptstatus');
                                                        rptstatuschk.text(data[2]);	
                                                        $("#rptstatus").delay(1000).fadeOut('slow');
                                                        }
                                        }
                                    });

                                }
       
			
	}  
        
        
         else if(vv=="kitchen_wise_report_cr")
	     { 
            vv=ofprint;
            var tot_from=$('#datepickerfrom').val();
            var tot_to=$('#datepickertodt').val();
            var bydate=$('#bydate').val();
            var a4paper=$('#hida4settings').val();
            var kitchen=$('#kitchen').val();
                            if(printera4=="N")
                                {
                                    window.open("consolidated_a4print.php?type="+vv+"&fromdt="+tot_from+"&todt="+tot_to+"&kitchen="+kitchen+"&bydate="+bydate+"#print",'_blank');
				}
                            else
                                {
                                    $.post("consolidatedreport_print.php", {type:vv,fromdt:tot_from,todt:tot_to,kitchen:kitchen,bydate:bydate},
                                    function(data)
                                    {
                                        data=$.trim(data);
                                        data=data.split('**');
                                                if(data[1]=='failed'){
							$('#rptstatus').css("display", "block");
                                                        var rptstatuschk=$('#rptstatus');
                                                        rptstatuschk.text(data[2]);	
                                                        $("#rptstatus").delay(1000).fadeOut('slow');
                                                        }
                                    });
                                }		
	}
         else if(vv=="discount_report_cr")
	     { 
            vv=ofprint;
            var tot_from=$('#datepickerfrom').val();
            var tot_to=$('#datepickertodt').val();
            var hidbydate=$('#bydate').val();
            var a4paper=$('#hida4settings').val();
            var department=$('#mode').val();
        
        if($("#item_disc").prop('checked') == true){
                var item_disc='true'; 
             }else{
               var item_disc='false'; 
           } 
             
             
             var item_disc_type=$('#item_disc_type').val();
        
        
                            if(printera4=="N")
                                {
                                    window.open("consolidated_a4print.php?type="+vv+"&fromdt="+tot_from+"&todt="+tot_to+"&bydate="+hidbydate+"&department="+department+"&item_disc_type="+item_disc_type+"&item_disc="+item_disc+"#print",'_blank');
				}
                            else
                                {
                                    $.post("consolidatedreport_print.php", {type:vv,fromdt:tot_from,todt:tot_to,bydate:hidbydate,department:department,item_disc_type:item_disc_type,item_disc:item_disc},
                                    function(data)
                                    {
                                        data=$.trim(data);
                                        data=data.split('**');
                                                if(data[1]=='failed'){
							$('#rptstatus').css("display", "block");
                                                        var rptstatuschk=$('#rptstatus');
                                                        rptstatuschk.text(data[2]);	
                                                        $("#rptstatus").delay(1000).fadeOut('slow');
                                                        }
                                    });
                                }		
	}
        else if(vv=="complimentary_cr")
	     { 
            vv=ofprint;          
            var tot_from=$('#datepickerfrom').val();
            var tot_to=$('#datepickertodt').val();
            var hidbydate=$('#bydate').val();
            var a4paper=$('#hida4settings').val();
            var department=$('#mode').val();
            
            
            if($("#comp_item_wise").prop('checked') == true){
                var comp_item_wise='true'; 
             }else{
               var comp_item_wise='false'; 
             } 
            
                            if(printera4=="N")
                                {
                                    window.open("consolidated_a4print.php?type="+vv+"&fromdt="+tot_from+"&todt="+tot_to+"&bydate="+hidbydate+"&department="+department+"&comp_item_wise="+comp_item_wise+"#print",'_blank');
				}
                            else
                                {
                                    $.post("consolidatedreport_print.php", {type:vv,fromdt:tot_from,todt:tot_to,bydate:hidbydate,department:department,comp_item_wise:comp_item_wise},
                                    function(data)
                                    {
                                        data=$.trim(data);
                                        data=data.split('**');
                                                if(data[1]=='failed'){
							$('#rptstatus').css("display", "block");
                                                        var rptstatuschk=$('#rptstatus');
                                                        rptstatuschk.text(data[2]);	
                                                        $("#rptstatus").delay(1000).fadeOut('slow');
                                                        }
                                    });
                                }
	}
          else if(vv=="most_revenue_generated_item_cr")
	     { 
            vv=ofprint;
            var tot_from=$('#datepickerfrom').val();
            var tot_to=$('#datepickertodt').val();
            var hidbydate=$('#bydate').val();
            var a4paper=$('#hida4settings').val();
            var mode=$('#mode').val();
            
            if($("#most_revenue").prop('checked') == true){
                var most_revenue='Y'; 
             }else{
               var most_revenue='N'; 
             } 
             
             
              if($("#best_selling").prop('checked') == true){
                var best_selling='Y'; 
             }else{
               var best_selling='N'; 
             } 
            
                            if(printera4=="N")
                            {
                                    window.open("consolidated_a4print.php?type="+vv+"&fromdt="+tot_from+"&todt="+tot_to+"&bydate="+hidbydate+"&department="+mode+"&best_selling="+best_selling+"&most_revenue="+most_revenue+"#print",'_blank');
				}
                            else
                            {
                                    $.post("consolidatedreport_print.php", {type:vv,fromdt:tot_from,todt:tot_to,bydate:hidbydate,department:mode,most_revenue:most_revenue,best_selling:best_selling},
                                    function(data)
                                    {
                                        data=$.trim(data);
                                        data=data.split('**');
                                                if(data[1]=='failed'){
							$('#rptstatus').css("display", "block");
                                                        var rptstatuschk=$('#rptstatus');
                                                        rptstatuschk.text(data[2]);	
                                                        $("#rptstatus").delay(1000).fadeOut('slow');
                                                        }
                                    });
                                }
	}
 else if(vv=="hourlywise_report_cr")
	     { 
            vv=ofprint;
            var tot_from=$('#datepickerfrom').val();
            var tot_to=$('#datepickertodt').val();
            var hidbydate=$('#bydate').val();
            var a4paper=$('#hida4settings').val();
            var mode=$('#mode').val();
            var day=$('#day').val();
            var fromtime=$('#display_timefrom').html();
            var totime=$('#display_timeto').html();     
                            if(printera4=="N")
                                {
                                    window.open("consolidated_a4print.php?type="+vv+"&fromdt="+tot_from+"&todt="+tot_to+"&bydate="+hidbydate+"&department="+mode+"&fromtime="+fromtime+"&totime="+totime+"&day="+day+"#print",'_blank');
				}
                            else
                                {
                                    $.post("consolidatedreport_print.php", {type:vv,fromdt:tot_from,todt:tot_to,bydate:hidbydate,department:mode,fromtime:fromtime,totime:totime,day:day},
                                    function(data)
                                    {
                                        data=$.trim(data);
                                        data=data.split('**');
                                                if(data[1]=='failed'){
							$('#rptstatus').css("display", "block");
                                                        var rptstatuschk=$('#rptstatus');
                                                        rptstatuschk.text(data[2]);	
                                                        $("#rptstatus").delay(1000).fadeOut('slow');
                                                        }
                                    });
                                }		
	}
        
        else if(vv=="consolidated_credit_summury")
	     { 
            vv=ofprint;
            var tot_from=$('#datepickerfrom').val();
            var tot_to=$('#datepickertodt').val();
            var a4paper=$('#hida4settings').val();
            var tot_to=$('#datepickertodt').val(); 
            var fromval=$('#datepickerfrom').val();
            var bydate=$('#bydate').val();
            var creditstaff=$('#bycreditstaff').val();
            var status='';
            if($('#credit-outstanding-select').is(":checked")){ status='true' } else{ status='false' };
            var credit_staff_company='';
                if(creditstaff!=''){
                    if(creditstaff==2){
                    credit_staff_company= $('#creditstaff').val();
                    }
                    else if(creditstaff==3){
                        credit_staff_company=$('#creditcompany').val();
                    }
                    else if(creditstaff==4){
                        credit_staff_company=$('#creditguest').val();
                    }
                    
                }
                
                var credit_partial_pay='';
                if($('#credit_partial_pay').is(":checked")){ credit_partial_pay='Y' } else{ credit_partial_pay='N' };
                
                            if(printera4=="N")
                                {
                                    window.open("consolidated_a4print.php?type="+vv+"&fromdt="+fromval+"&todt="+tot_to+"&bydate="+bydate+
                                    "&creditstaff="+creditstaff+"&checkedstatus="+status+"&credit_staff_company="+credit_staff_company+
                                    "&credit_partial_pay="+credit_partial_pay+"#print",'_blank');
				}
                            else
                                {
                                    $.post("consolidatedreport_print.php", {type:vv,fromdt:fromval,todt:tot_to,creditstaff:creditstaff,bydate:bydate,
                                        credit_staff_company:credit_staff_company,checkedstatus:status,credit_partial_pay:credit_partial_pay},
                                    function(data)
                                    {
                                        data=$.trim(data);
                                        data=data.split('**');
                                                if(data[1]=='failed'){
							$('#rptstatus').css("display", "block");
                                                        var rptstatuschk=$('#rptstatus');
                                                        rptstatuschk.text(data[2]);	
                                                        $("#rptstatus").delay(1000).fadeOut('slow');
                                                        }
                                    });

                                }

			
	}
        else if(vv=="credit_summary_client")
	     { 
            vv=ofprint;
            var tot_from=$('#datepickerfrom').val();
            var tot_to=$('#datepickertodt').val();
            var a4paper=$('#hida4settings').val();
            var tot_to=$('#datepickertodt').val(); 
            var fromval=$('#datepickerfrom').val();
            var bydate=$('#bydate').val();
            var creditstaff=$('#bycreditstaff').val();
            var status='';
            if($('#credit-outstanding-select').is(":checked")){ status='true' } else{ status='false' };
            var credit_staff_company='';
                if(creditstaff!=''){
                    if(creditstaff==2){
                    credit_staff_company= $('#creditstaff').val();
                    }
                    else if(creditstaff==3){
                        credit_staff_company=$('#creditcompany').val();
                    }
                    else if(creditstaff==4){
                        credit_staff_company=$('#creditguest').val();
                    }
                }     
                            if(printera4=="N")
                                {
                                    window.open("consolidated_a4print.php?type="+vv+"&fromdt="+fromval+"&todt="+tot_to+"&bydate="+bydate+"&creditstaff="+creditstaff+"&checkedstatus="+status+"&credit_staff_company="+credit_staff_company+"#print",'_blank');
				}
                            else
                                {
                                    $.post("consolidatedreport_print.php", {type:vv,fromdt:fromval,todt:tot_to,creditstaff:creditstaff,bydate:bydate,credit_staff_company:credit_staff_company,checkedstatus:status},
                                    function(data)
                                    {
                                        data=$.trim(data);
                                        data=data.split('**');
                                                if(data[1]=='failed'){
							$('#rptstatus').css("display", "block");
                                                        var rptstatuschk=$('#rptstatus');
                                                        rptstatuschk.text(data[2]);	
                                                        $("#rptstatus").delay(1000).fadeOut('slow');
                                                        }
                                    });		
	}
}
        else if(vv=="tips_collected_consolidated")
	    { 
            vv=ofprint;
            var tot_from=$('#datepickerfrom').val();
            var tot_to=$('#datepickertodt').val();
            var hidbydate=$('#bydate').val();
            var a4paper=$('#hida4settings').val();
            var view_mode=$('#summary_detailed').val();
            if(printera4=="N")
                {
                 window.open("consolidated_a4print.php?type="+vv+"&fromdt="+tot_from+"&todt="+tot_to+"&bydate="+hidbydate+"&modeofview="+view_mode+"#print",'_blank');
				}
            else
                {
                $.post("consolidatedreport_print.php", {type:vv,fromdt:tot_from,todt:tot_to,bydate:hidbydate,modeofview:view_mode},
                function(data)
                {
                    data=$.trim(data);
                    data=data.split('**');
                    if(data[1]=='failed'){
					$('#rptstatus').css("display", "block");
                    var rptstatuschk=$('#rptstatus');
                    rptstatuschk.text(data[2]);	
                    $("#rptstatus").delay(1000).fadeOut('slow');
                    }
                });
                }	
	    }   
}
function pdf_page()
{
	var vv=document.getElementById("typeval").value;
	if(vv=="sales_summary_report_cr")
		{
                    var tot_from=$('#datepickerfrom').val();
                    var tot_to=$('#datepickertodt').val();
                    var hidbydate=$('#bydate').val();
                    var loginstaff=$('#userloginsel').val();
                    window.location="tapdf_bill.php?type="+vv+"&from="+tot_from+"&to="+tot_to+"&bydate="+hidbydate;
		}        	
}


 function pagination(p,q)
 {
     var s=$('#recordcount').val();

     if(q==1)
     {
     var m= q;
     var j=parseInt(q)+6;
     }
     else if(q==2)
     {
     var m= parseInt(q)-1;
     var j=parseInt(q)+5;
     }
     else if(q==3)
     {
       var m= parseInt(q)-2;
       var j= parseInt(q)+4;
     }
     else 
     {
       var m= parseInt(q)-3;
       var j= parseInt(q)+3;
     }

    
     var o=0;
     var w=0;
      var n=0;
     
    for(w=1;w<=m;w++)
     {
         
         $('#pagi'+w).hide();
     } 
     for(n=m;n<=j;n++)
     {
         
         $('#pagi'+n).show();
     } 
     for(o=j;o<=s;o++)
     {
         
         $('#pagi'+o).hide();
     } 
     
     var recordcount=parseInt(p);
  
    
    
       $('.confrmation_overlay_proce').css('display','block');
       $('.confrmation_overlay_proce').html('<img src="img/ajax-loaders/fetch.gif" />');
                   
		var shiftlogin=$('#shiftlogin').val();
		var bydate=$('#bydate').val();
                var modeofview=$('#summary_detailed').val();
                var cashcounter=$('#cashcounter').val();
              
		var menu_search=$('#menuname_search').val();
		var status='';
                if($('#credit-outstanding-select').is(":checked")){ status='true' } else{ status='false' };
		var typeval=$('#typeval').val();
	        var fromval=$('#datepickerfrom').val();            
		var tot_to=$('#datepickertodt').val();
                var creditstaff=$('#bycreditstaff').val();
                var credit_staff_company='';
                if(creditstaff!=''){
                    if(creditstaff==2){
                       credit_staff_company= $('#creditstaff').val();
                    }
                    else if(creditstaff==3){
                      credit_staff_company=$('#creditcompany').val();
                    }
                    else if(creditstaff==4){
                       credit_staff_company=$('#creditguest').val();
                    }
                }
                var voucher=$('#voucher').val();
                var voucher1=$('#voucher1').val();
                var staff_hd=$('#staff_hd').val();
                var department=$('#mode').val();
                var staff=$('#cashier').val();
                var fromtime=$('#display_timefrom').html();
                var totime=$('#display_timeto').html();
                var day=$('#day').val();
                var category_menu=$('#menucategory').val();
                var payment=$('#paytype').val();
                var kitchen=$('#kitchen').val();              
                var acc_type=  $('#exp_type_acc').val();
                var pur_acc_type=  $('#pur_type_acc').val();
                var floorz= $('#floor_di').val();
                var loginstaffsel=$('#staff_ta').val(); 
		var tax = $('#taxtype').val();
           var addon=$('#menu_type').val();
            var bank_name=$('#bank_name').val();
            var from_all=$('#from_acc').val();
            var ledger=from_all.split('*');
            var from_ledger=ledger[0];
            var  from_vendor=ledger[1];
            var from_staff=ledger[2];      
            var to_all=$('#to_acc').val();            
            var ledger1=to_all.split('*');            
            var to_ledger=ledger1[0];            
            var  to_vendor=ledger1[1];                     
            var to_staff=ledger1[2];                               
            var subcategory=$('#subcategory').val();
            
           if($("#nontax").prop('checked') == true){
                var non_tax='true'; 
             }else{
                
                non_tax='false'; 
           } 
           
            if($("#tax_adsr").prop('checked') == true){
                var tax_adsr='true'; 
             }else{
                
                tax_adsr='false'; 
           } 
           
           
            if($("#hsn_billwise").prop('checked') == true){
                var hsn_billwise='true'; 
                
                
             }else{
                var hsn_billwise='false'; 
                
             } 
           
            if($("#hsn_code").prop('checked') == true){
                var hsn_code='true'; 
                
             }else{
               var hsn_code='false'; 
                
           } 
           
           
           
           
                       $.post("load_consolidatedreport.php", {pagination:p,recordcount:recordcount,menu_search:menu_search,fromdt:fromval,
                           todt:tot_to,type:typeval,bydate:bydate,voucher1:voucher1,voucher:voucher,staff:staff,department:department,
                           creditstaff:creditstaff,fromtime:fromtime,totime:totime,tax:tax,day:day,shiftlogin:shiftlogin,tax_adsr:tax_adsr,
                           checkedstatus:status,credit_staff_company:credit_staff_company,modeofview:modeofview,cashcounter:cashcounter,
                           payment:payment,category_menu:category_menu,kitchen:kitchen,addon:addon,floorz:floorz,loginstaffsel:loginstaffsel,
                           staff_hd:staff_hd,bank_name:bank_name,acc_type:acc_type,pur_acc_type:pur_acc_type, 
                           from_ledger:from_ledger,from_vendor:from_vendor,non_tax:non_tax,
                           from_staff:from_staff,to_ledger:to_ledger,to_vendor:to_vendor,to_staff:to_staff,subcategory:subcategory ,
                           hsn_billwise:hsn_billwise,hsn_code:hsn_code,    abc:"ft"},
						function(data)
						{    
                                                        $('.confrmation_overlay_proce').css('display','none');
							data=$.trim(data);							
							$('#reportload').html(data);    
                                                        
                                                for(w=1;w<=m;w++)
                                               {

                                                   $('#pagi'+w).hide();
                                               } 
                                               for(n=m;n<=j;n++)
                                               {

                                                   $('#pagi'+n).show();
                                               } 
                                               for(o=j;o<=s;o++)
                                               {

                                                   $('#pagi'+o).hide();
                                               } 

                                               });
     
 } 
 
</script>
<div style="display:none" class="confrmation_overlay_proce"></div>
<style>
      .confrmation_overlay_proce{
	width:100%;
	height:100%;
	position:fixed;
	z-index:999;
	background-color:rgba(0,0,0,0.8);
	top:0;
	text-align:center;
	line-height: 40;
		}
.confrmation_overlay_proce img{width:100px;height:100px;}
    </style>
</body>
</html>
