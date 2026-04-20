<?php
//include('includes/session.php');		// Check session
session_start();
if($_SESSION["archive_enabled"]=='Y'){
    include("database.class.reports.php");  // DB Connection class
    $database	= new Database();
    
}
else if($_SESSION["archive_enabled"]=='N'){
    include("database.class.php");  // DB Connection class
    $database	= new Database();
    
}
//include('includes/master_settings.php');
//$_SESSION['pagid']=7;

?>
<!DOCTYPE HTML>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="shortcut icon" href="img/favicon.ico">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>CS</title>
<link href="css/menu_master_style.css" rel="stylesheet">
<link id="bs-css" href="css/bootstrap-cerulean.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/report_styl.css" />



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


<style>.left_list_cc{height: 71vh;min-height: 498px !important}
.reporte_min_hieght_1 {min-height: 478px;height: 76.5vh;}
     .reporte_min_hieght_1{overflow: visible !important}
 .user_detail_min_hieght{overflow: visible !important}
    .reporte_min_hieght_1  tbody { display: block;min-height: 380px;overflow-y: scroll;height: 62vh}
    .reporte_min_hieght_1 thead,
tbody tr {  display: table; width: 99%; table-layout: fixed;}
.reporte_min_hieght  tbody { display: block;min-height: 380px;overflow-y: scroll;height: 62vh}
    .reporte_min_hieght thead,
tbody tr {  display: table; width: 99%; table-layout: fixed;}
    .ui-datepicker-calendar thead, tbody tr{display: table;width: 100%;}

</style>
<script src="js/jquery-1.10.2.min.js"></script>
<script src="mn/js/modernizr.custom.js"></script>
<script src="js/jquery.nicescroll.min.js"></script>
 <script>
  $(document).ready(function() {
  
	var nice = $("html").niceScroll();  // The document page (body)
	
	$("#div1").html($("#div1").html()+' '+nice.version);
    
    $("#boxscroll").niceScroll({touchbehavior:true}); // First scrollable DIV
	 $("#boxscrol2").niceScroll({touchbehavior:true});
	 $("#left_list_scr").niceScroll({touchbehavior:true});
	 $(".user_detail_min_hieght").niceScroll({touchbehavior:true});
	 $(".report_main_cc").niceScroll({touchbehavior:true});
    
    // Customizable cursor
    // $("#boxscroll").niceScroll({touchbehavior:false,cursorcolor:"#00F",cursoropacitymax:0.7,cursorwidth:11,cursorborder:"1px solid #2848BE",cursorborderradius:"8px"}).cursor.css({"background-image":"url(img/mac6scroll.png)"}); // MAC like scrollbar

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
<script src="js/turbotabs.min.js"></script>

<!--<script src="js/jquery.timepicker.min.js"></script>-->



<script type="text/javascript">
$(document).ready(function(){
    $('#myTab').turbotabs({
        animation : 'ScrollUp',
        mode : 'vertical'
    }); 
}); 
</script>
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
	 $("#datepickerto").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	$("#datepickeritemorderedfrom").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	$("#datepickeritemorderedto").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	$("#datepickerdiscountfrom").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	$("#datepickerdiscountto").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	$("#datepickercomplimentaryfrom").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	$("#datepickercomplimentaryto").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	$("#datepickerbillfrom").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	$("#datepickerbillto").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	$("#datepickerfromtyp").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	$("#datepickertodttyp").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	$("#datepickerbillcancelfrom").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	$("#datepickerbillcancelto").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	
	$("#datepickercancelhistoryfrom").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	$("#datepickercancelhistoryto").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
    
    $("#datepickerfromsummarycs").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	 $("#datepickertosummarycs").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
    
    $("#datepickerfromtotalsummarydetailscs").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	 $("#datepickertototalsummarydetailscs").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
    
     $("#datepickercategoryreport_csfrom").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	 $("#datepickercategoryreport_csto").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
 
$('#users').change(function () {
		$('#ui-datepicker-div').css("display", "none");
		var fromval=$('#datepickerfrom').val();
		var tot_to=$('#datepickerto').val();
                var typeval=$('#typeval').val();
                var log_user = $('#users').val();
		var bydate=$('#bydate').val();
        
              
		//------------from date start
		if(tot_to=="")
		{
			tot_to="";
		}
                if(fromval=="")
		{
			fromval="";
		}

						$.post("load_report_cs.php", {log_user:log_user,bydate:bydate,fromdt:fromval,todt:tot_to,type:typeval,set:"ft"},
						function(data)
						{
							  data=$.trim(data);
							
					$('#reportload').html(data);
						});				
	});
 $('#datepickerfrom').change(function () {

		$('#ui-datepicker-div').css("display", "none");
		var fromval=$(this).val();
		var tot_to=$('#datepickerto').val();
		
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;
                var log_user = $('#users').val();
		
        $('#bydate').val("null");
		
		if(tot_to=="")
		{
			tot_to="";
		}
						$.post("load_report_cs.php", {log_user:log_user,fromdt:fromval,todt:tot_to,type:typeval,set:"ft"},
						function(data)
						{
							data=$.trim(data);						
							$('#reportload').html(data);
						});	
	});
	
	
	$('#datepickerto').change(function () {
		$('#bydate').val("null");
		$('#ui-datepicker-div').css("display", "none");
		var tot_to=$(this).val();
		var tot_from=$('#datepickerfrom').val();
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;
                var log_user = $('#users').val();
		if(tot_from=="")
		{
			tot_from="";
		}		
						$.post("load_report_cs.php", {log_user:log_user,fromdt:tot_from,todt:tot_to,type:typeval,set:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});				
	});
	$('#bydate').change(function () {
		
		$('#ui-datepicker-div').css("display", "none");

		var typeval=$('#typeval').val();			
	  $('#datepickerfrom').val(""); 
	 $('#datepickerto').val("");
                var log_user = $('#users').val();
		var bydate=$('#bydate').val();
	
						$.post("load_report_cs.php", {log_user:log_user,fromdt:'',todt:'',bydate:bydate,type:typeval,abc:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});				
	});
	
	$('#datepickeritemorderedfrom').change(function () {
		$('#ui-datepicker-div').css("display", "none");
		var fromval=$(this).val();
		var tot_to=$('#datepickeritemorderedto').val();
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;

                var addon=$('#menu_type').val();
        $('#bydate').val("null");
		
		if(tot_to=="")
		{
			tot_to="";
		}
						$.post("load_report_cs.php", {fromdt:fromval,todt:tot_to,type:typeval,addon:addon,set:"ft"},
						function(data)
						{
							data=$.trim(data);
							$('#reportload').html(data);
						});						
	});
	

	$('#datepickeritemorderedto').change(function () {
		$('#bydate').val("null");
		$('#ui-datepicker-div').css("display", "none");
		var tot_to=$(this).val();
	var tot_from=$('#datepickeritemorderedfrom').val();
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;
                 var addon=$('#menu_type').val();
		if(tot_from=="")
		{
			tot_from="";
		}
						$.post("load_report_cs.php", {fromdt:tot_from,todt:tot_to,type:typeval,addon:addon,set:"ft"},
						function(data)
						{
							  data=$.trim(data);							
							  $('#reportload').html(data);
						});				
});
$('#bydateitemordered').change(function () {
		
		$('#ui-datepicker-div').css("display", "none");
	
		
	
		var typeval=$('#typeval').val();
	  $('#datepickeritemorderedfrom').val(""); 
	 $('#datepickeritemorderedto').val("");
		var bydate=$('#bydateitemordered').val();
		var addon=$('#menu_type').val();

						$.post("load_report_cs.php", {bydate:bydate,addon:addon,fromdt:'',todt:'',type:typeval,abc:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});					
	});
	
	$('#datepickerdiscountfrom').change(function () {
		$('#bydate').val("null");
		$('#ui-datepicker-div').css("display", "none");
		var tot_from=$(this).val();
		var tot_to=$('#datepickerdiscountto').val();
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;
		if(tot_from=="")
		{
			tot_from="";
		}
						$.post("load_report_cs.php", {fromdt:tot_from,todt:tot_to,type:typeval,set:"ft"},
						function(data)
						{
							  data=$.trim(data);
							 $('#reportload').html(data);
						});				
});
$('#datepickerdiscountto').change(function () {
		$('#bydate').val("null");
		$('#ui-datepicker-div').css("display", "none");
		var tot_to=$(this).val();
	var tot_from=$('#datepickerdiscountfrom').val();
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;
		if(tot_from=="")
		{
			tot_from="";
		}
						$.post("load_report_cs.php", {fromdt:tot_from,todt:tot_to,type:typeval,set:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});				
});
$('#bydatediscount').change(function () {
	$('#ui-datepicker-div').css("display", "none");
	var typeval=$('#typeval').val();		
	$('#datepickerdiscountfrom').val(""); 
	$('#datepickerdiscountto').val("");
		var bydate=$('#bydatediscount').val();
	
						$.post("load_report_cs.php", {bydate:bydate,type:typeval,abc:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});					
	});
	
	$('#datepickercomplimentaryfrom').change(function () {
		$('#bydatecomplimentary').val("null");
		$('#ui-datepicker-div').css("display", "none");
		var tot_from=$(this).val();
		var tot_to=$('#datepickercomplimentaryto').val();
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;
		if(tot_from=="")
		{
			tot_from="";
		}
						$.post("load_report_cs.php", {fromdt:tot_from,todt:tot_to,type:typeval,set:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
});
$('#datepickercomplimentaryto').change(function () {
		$('#bydatecomplimentary').val("null");
		$('#ui-datepicker-div').css("display", "none");
		var tot_to=$(this).val();
		var tot_from=$('#datepickercomplimentaryfrom').val();
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;
		if(tot_from=="")
		{
			tot_from="";
		}
	
						$.post("load_report_cs.php", {fromdt:tot_from,todt:tot_to,type:typeval,set:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});				
});

$('#bydatecomplimentary').change(function () {
		$('#ui-datepicker-div').css("display", "none");
	
		
	
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;
		
		
	  $('#datepickercomplimentaryfrom').val(""); 
	 $('#datepickercomplimentaryto').val("");
		var bydate=$('#bydatecomplimentary').val();
		
						$.post("load_report_cs.php", {bydate:bydate,type:typeval,abc:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});					
	});
	
$('#datepickerbillfrom').change(function () {
		$('#bydatebill').val("null");
		$('#ui-datepicker-div').css("display", "none");
		var tot_from=$(this).val();
		var tot_to=$('#datepickerbillto').val();
                 var sortby=$('#bill_sort').val();
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;
		if(tot_from=="")
		{
			tot_from="";
		}
						$.post("load_report_cs.php", {fromdt:tot_from,sortby:sortby,bydate:'',todt:tot_to,type:typeval,set:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});				
});
$('#datepickerbillto').change(function () {
		$('#bydatebill').val("null");
		$('#ui-datepicker-div').css("display", "none");
		var tot_to=$(this).val();
		var tot_from=$('#datepickerbillfrom').val();
                var sortby=$('#bill_sort').val();
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;
		if(tot_from=="")
		{
			tot_from="";
		}
						$.post("load_report_cs.php", {fromdt:tot_from,todt:tot_to,bydate:'',sortby:sortby,type:typeval,set:"ft"},
						function(data)
						{
							  data=$.trim(data);
						
							  $('#reportload').html(data);
						});					
});
$('#bydatebill').change(function () {
		$('#ui-datepicker-div').css("display", "none");
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;
	  $('#datepickerbillfrom').val(""); 
	 $('#datepickerbillto').val("");
		var bydate=$('#bydatebill').val();
		var sortby=$('#bill_sort').val();
	
						$.post("load_report_cs.php", {bydate:bydate,sortby:sortby,fromdt:'',todt:'',type:typeval,abc:"ft"},
						function(data)
						{
							  data=$.trim(data);						
							  $('#reportload').html(data);
						});
					
	});
$('#bill_sort').change(function () {
		$('#ui-datepicker-div').css("display", "none");
                var sortby=$(this).val();
		var fromval=$('#datepickerbillfrom').val();
		var tot_to=$('#datepickerbillto').val();
		var typeval=$('#typeval').val();
		$('#bydatekot').find('option:first').attr('selected', 'selected');
		if(tot_to=="")
		{
			tot_to="";
		}
		var bydate=$('#bydatebill').val();

						$.post("load_report_cs.php", {fromdt:fromval,todt:tot_to,sortby:sortby,bydate:bydate,type:typeval,sortby:sortby,set:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});					
	});	
	$('#typepay').change(function () {
		
		var typeofpay=$(this).val();

		var typeval=$('#typeval').val(); 
	
		var paybydate=$('#paybydate').val(); 
	
		var tot_from=$('#datepickerfromtyp').val();
		var tot_to=$('#datepickertodttyp').val();
	if(typeofpay!="null" && paybydate=="null")
		{
						$.post("load_report_cs.php", {fromdt:tot_from,todt:tot_to,typepay:typeofpay,type:typeval,set:"ft"},
						function(data)
						{
							  data=$.trim(data);						
							  $('#reportload').html(data);
						});					
		}
		
		
		else if(typeofpay!="null" && paybydate!="null" )
		{
						$.post("load_report_cs.php", {fromdt:tot_from,todt:tot_to,typepay:typeofpay,type:typeval,paybydate:paybydate,pay:"aft"},
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
			  var rptstatus200=$('#rptstatus');
		
		  rptstatus200.text('Pls select payment mode');	
		$("#rptstatus").delay(1000).fadeOut('slow');
		}
	});
	
	
	
	$('#datepickerfromtyp').change(function () {
	
		$('#ui-datepicker-div').css("display", "none");
		var tot_from=$(this).val();
		var tot_to=$('#datepickertodttyp').val();
		var typeofpay=$('#typepay').val();
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;
               
		$('#paybydate').val("null");
		if(tot_to=="")
		{
			tot_to="";
		}
		
		if(typeofpay !="null")
		{
						$.post("load_report_cs.php", {fromdt:tot_from,todt:tot_to,typepay:typeofpay,type:typeval,set:"ft"},
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
		 var rptstatus300=$('#rptstatus');
		 rptstatus300.text('Pls select payment mode');	
		$("#rptstatus").delay(1000).fadeOut('slow');
	}
		

	});
	$('#datepickerfromtyp').click(function () {
		$('#ui-datepicker-div').css("display", "block");
	});	
	
	
	
	$('#datepickertodttyp').click(function () {
		$('#ui-datepicker-div').css("display", "block");
	});	
	
	$('#datepickertodttyp').change(function () {
		
		$('#ui-datepicker-div').css("display", "none");
		var tot_to=$(this).val();
		var tot_from=$('#datepickerfromtyp').val();
		var typeofpay=$('#typepay').val();
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;
                
		$('#paybydate').val("null");
		if(typeofpay !="null")
		{
		if(tot_from=="")
		{
			tot_from="";
		}

						$.post("load_report_cs.php", {fromdt:tot_from,todt:tot_to,typepay:typeofpay,type:typeval,set:"ft"},
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
			var rptstatus400=$('#rptstatus');		
		  rptstatus400.text('Pls select payment mode');	
		$("#rptstatus").delay(1000).fadeOut('slow');
		}

	});
	
		$('#paybydate').change(function () {
		
		var fromval=$(this).val();
		var tot_to=$('#datepickertodt').val();
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;
		var typepay=$('#typepay').val();
		var paybydate=$('#paybydate').val();
		$('#datepickerfromtyp').val("");
		$('#datepickertodttyp').val("");
		if(tot_to=="")
		{
			tot_to="";
		}
		if(typepay !="null" )
		{

						$.post("load_report_cs.php", {paybydate:paybydate,type:typeval,typepay:typepay,abc:"ft"},
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
			  var reptstatus500=$('#rptstatus');
		  reptstatus500.text('Pls select payment mode');	
		$("#rptstatus").delay(1000).fadeOut('slow');
		}
		
		
	});
	
	
	$('#datepickerbillcancelfrom').change(function () {
		$('#ui-datepicker-div').css("display", "none");
		var fromval=$(this).val();
		var tot_to=$('#datepickerbillcancelto').val();
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;
		
        $('#bydatebillcancel').val("null");
		
		if(tot_to=="")
		{
			tot_to="";
		}
						$.post("load_report_cs.php", {fromdt:fromval,todt:tot_to,bydate:'',type:typeval,set:"ft"},
						function(data)
						{
							data=$.trim(data);
					 		$('#reportload').html(data);
						});
	});
	
	
	$('#datepickerbillcancelto').change(function () {
		$('#bydatebillcancel').val("null");
		$('#ui-datepicker-div').css("display", "none");
		var tot_to=$(this).val();
		var tot_from=$('#datepickerbillcancelfrom').val();
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;
		if(tot_from=="")
		{
			tot_from="";
		}
						$.post("load_report_cs.php", {fromdt:tot_from,todt:tot_to,type:typeval,bydate:'',set:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});					
	});
	$('#bydatebillcancel').change(function () {
		
		$('#ui-datepicker-div').css("display", "none");
	
		
	
		var typeval=$('#typeval').val();
	  $('#datepickerbillcancelfrom').val(""); 
	 $('#datepickerbillcancelto').val("");
		var bydate=$('#bydatebillcancel').val();
						$.post("load_report_cs.php", {bydate:bydate,fromdt:'',todt:'',type:typeval,abc:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});					
	});
        
        
        	/*******************************************Summary starts**********************************************/
	//summarydiv  datepickerfromsummary datepickertosummary bydatesummary summary	
$('#datepickerfromsummarycs').change(function () {
		$('#ui-datepicker-div').css("display", "none");
		var fromval=$(this).val();
		var tot_to=$('#datepickertosummarycs').val();
		var typeval=$('#typeval').val();
		$('#bydatekot').find('option:first').attr('selected', 'selected');
		if(tot_to=="")
		{
			tot_to="";
		}		
						$.post("load_report_cs.php", {fromdt:fromval,todt:tot_to,type:typeval,set:"ft"},
						function(data)
						{
							  data=$.trim(data);						
							$('#reportload').html(data);
						});
					  
	});
	$('#datepickerfromsummarycs').click(function () {
		$('#ui-datepicker-div').css("display", "block");
	});	
	
	
	
	$('#datepickertosummarycs').click(function () {
		$('#ui-datepicker-div').css("display", "block");
	});	
	
	$('#datepickertosummarycs').change(function () {
		
		$('#ui-datepicker-div').css("display", "none");
		
		var tot_to=$(this).val();
		var tot_from=$('#datepickerfromsummarycs').val();
		var typeval=$('#typeval').val();
		$('#bydatekot').find('option:first').attr('selected', 'selected');
		if(tot_from=="")
		{
			tot_from="";
		}
						$.post("load_report_cs.php", {fromdt:tot_from,todt:tot_to,type:typeval,set:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});					
	});
	
	$('#bydatesummarycs').change(function () {
		
		var typeval=$('#typeval').val();
		$('#datepickerfromsummarycs').val('');
		$('#datepickertosummarycs').val('');
		var tp=$(this).val();
						$.post("load_report_cs.php", {bydate:tp,type:typeval,abc:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
					
	});
	/*****************************************Summary ends**************************************************************/
        
        
         /*******************************************Total Summary details starts**********************************************/
	//summarydiv  datepickerfromsummary datepickertosummary bydatesummary summary	
$('#datepickerfromtotalsummarydetailscs').change(function () {
		
		$('#ui-datepicker-div').css("display", "none");
		var fromval=$(this).val();
		var tot_to=$('#datepickertototalsummarydetailscs').val();
		var typeval=$('#typeval').val();
                
		$('#bydatekot').find('option:first').attr('selected', 'selected');
		if(tot_to=="")
		{
			tot_to="";
		}
						$.post("load_report_cs.php", {fromdt:fromval,todt:tot_to,type:typeval,set:"ft"},
						function(data)
						{
							  data=$.trim(data);
						
							$('#reportload').html(data);
						});	  
	});
	$('#datepickerfromtotalsummarydetailscs').click(function () {
		$('#ui-datepicker-div').css("display", "block");
	});	
	
	
	
	$('#datepickertototalsummarydetailscs').click(function () {
		$('#ui-datepicker-div').css("display", "block");
	});	
	
	$('#datepickertototalsummarydetailscs').change(function () {
		
		$('#ui-datepicker-div').css("display", "none");
		
		var tot_to=$(this).val();
		var tot_from=$('#datepickerfromtotalsummarydetailscs').val();
                var typeval=$('#typeval').val();
		$('#bydatekot').find('option:first').attr('selected', 'selected');
		if(tot_from=="")
		{
			tot_from="";
		}
						$.post("load_report_cs.php", {fromdt:tot_from,todt:tot_to,type:typeval,set:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});					
	});
	
	$('#bydatetotalsummarydetailscs').change(function () {
	
		var typeval=$('#typeval').val();
		$('#datepickerfromtotalsummarydetailscs').val('');
		$('#datepickertototalsummarydetailscs').val('');
		var tp=$(this).val();
		
						$.post("load_report_cs.php", {bydate:tp,type:typeval,abc:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});					
	});
	/*****************************************Total Summary details ends**************************************************************/
        
	
	$('#datepickercancelhistoryfrom').change(function () {
	
		$('#ui-datepicker-div').css("display", "none");
		var fromval=$(this).val();
		var tot_to=$('#datepickercancelhistoryto').val();
	
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;
		
        $('#bydatecancelhistory').val("null");
		
		if(tot_to=="")
		{
			tot_to="";
		}
						$.post("load_report_cs.php", {fromdt:fromval,todt:tot_to,type:typeval,set:"ft"},
						function(data)
						{
						data=$.trim(data);							
					 $('#reportload').html(data);
						});				
	});
	
	
	$('#datepickercancelhistoryto').change(function () {
	
		$('#bydatecancelhistory').val("null");
		$('#ui-datepicker-div').css("display", "none");
		var tot_to=$(this).val();
	
		var tot_from=$('#datepickercancelhistoryfrom').val();

		var typeval=$('#typeval').val();//document.getElementById("typeval").value;
		if(tot_from=="")
		{
			tot_from="";
		}
						$.post("load_report_cs.php", {fromdt:tot_from,todt:tot_to,type:typeval,set:"ft"},
						function(data)
						{
							  data=$.trim(data);
							 
							  $('#reportload').html(data);
						});				
	});
	$('#bydatecancelhistory').change(function () {
		
		$('#ui-datepicker-div').css("display", "none");
	
		
	
		var typeval=$('#typeval').val();
		
		
	  $('#datepickercancelhistoryfrom').val(""); 
	 $('#datepickercancelhistoryto').val("");
		var bydate=$('#bydatecancelhistory').val();
		
	
						$.post("load_report_cs.php", {bydate:bydate,fromdt:'',todt:'',type:typeval,abc:"ft"},
						function(data)
						{
							  data=$.trim(data);
							
							  $('#reportload').html(data);
						});				
	});
	
	
	$('#datepickercategoryreport_csfrom').change(function () {
	
		$('#ui-datepicker-div').css("display", "none");
		var fromval=$(this).val();
		var tot_to=$('#datepickercategoryreport_csto').val();
	
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;
		
        $('#bydatecategoryreport_cs').val("null");
		
		if(tot_to=="")
		{
			tot_to="";
		}
	
						$.post("load_report_cs.php", {fromdt:fromval,todt:tot_to,type:typeval,set:"ft"},
						function(data)
						{
						data=$.trim(data);							
					 	$('#reportload').html(data);
						});
	});
	
	
	$('#datepickercategoryreport_csto').change(function () {
	
		$('#bydatecategoryreport_cs').val("null");
		$('#ui-datepicker-div').css("display", "none");
		var tot_to=$(this).val();

		var tot_from=$('#datepickercategoryreport_csfrom').val();
	
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;
		if(tot_from=="")
		{
			tot_from="";
		}
						$.post("load_report_cs.php", {fromdt:tot_from,todt:tot_to,type:typeval,set:"ft"},
						function(data)
						{
							  data=$.trim(data);							
							  $('#reportload').html(data);
						});				
	});
	$('#bydatecategoryreport_cs').change(function () {
		
		$('#ui-datepicker-div').css("display", "none");
		var typeval=$('#typeval').val();
	  $('#datepickercategoryreport_csfrom').val(""); 
	 $('#datepickercategoryreport_csto').val("");
		var bydate=$('#bydatecategoryreport_cs').val();

						$.post("load_report_cs.php", {bydate:bydate,type:typeval,abc:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
	
	});
	 $('#menu_type').change(function () {
            
		$('#ui-datepicker-div').css("display", "none");
		
               
                var typeval=$('#typeval').val();
                 var bydate=$('#bydateitemordered').val();
                var fromval=$('#datepickeritemorderedfrom').val();
                var tot_to=$('#datepickeritemorderedto').val();
               
                var addon=$(this).val();
						$.post("load_report_cs.php", {type:typeval,fromdt:fromval,todt:tot_to,bydate:bydate,addon:addon},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
					
	});
	
 });
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
						
 <div  class="sitemap_cc">Counter Sales Report</div>
  <div id="container">  
<div class="col-md-12 main_contant_container nopaddding">
    <div class="col-lg-12 col-md-12 report_main_cc" style="padding-top:10px; background-color:rgb(208, 208, 208);">
        <div class="col-lg-12 col-md-12 nopadding" style="background-color:#FCFCFC;">
    <div class="header_main_container">
        <div class="col-lg-12 col-md-12 nopadding">
            <!-- condition starts -->
            <div class="col-lg-12 col-md-12 nopadding top_main_cc">
                <div class="col-lg-2 col-md-2 no-padding filter_txt_cc">
                    <div class="filter_heading filter_head_1">Select</div>
                </div>
                <div class="search_name_box_main report_check_box_cc" style="margin-top: 4px;">
                    <!-- type starts -->
                    <div class="search_name_box_main"  style="width: 24%;">
                        <div class="text-selection_name">Type</div>
                        <div class="input-group" style="width: 84%;">
						
                            <select class="form-control add_new_dropdown_report" onChange="reportcreate(this.value)" name="typeval" id="typeval">
                                <option value="">Type of report</option>
								
								<?php 
                                $sql_login  =  $database->mysqlQuery("select rm_reportname,rm_posprintofanother,rm_reportid,rm_printa4 from tbl_reportmaster where rm_reporttype='CS'"); 
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

                    <!-- date starts -->

                    
                    <div id="counter_sale" style="display:none">
                         <div class="search_name_box_main">
                            <div class="text-selection_name">User</div>
                            <div class="input-group">
                                  <select class="form-control add_new_dropdown_report" name="users" id="users" >
                                          <option value="null" default >All</option>
                                        <?php 
                                        $sql_login  =  $database->mysqlQuery("SELECT DISTINCT(tab_loginid) FROM tbl_takeaway_billmaster WHERE tab_mode = 'cs'"); 
                                        $num_login   = $database->mysqlNumRows($sql_login);
                                        if($num_login){
                                            while($result_login  = $database->mysqlFetchArray($sql_login)) 
                                            { 
                                                if($result_login['tab_loginid']!="")
                                                {?>
                                                    <option value="<?=$result_login['tab_loginid']?>" default ><?=$result_login['tab_loginid']?></option>
                                               <?PHP }
                                            }
                                        }
                                            ?>
                                          
                                        </select>
                            </div>
                        </div>
                        <div class="search_name_box_main">
                            <div class="text-selection_name">From:</div>
                            <div class="input-group">
                                <input type="text" class="form-control" id="datepickerfrom" >
                            </div>
                        </div>

                        <div class="search_name_box_main">
                            <div class="text-selection_name">To :</div>
                            <div class="input-group">
                                <input type="text" class="form-control" id="datepickerto">
                            </div>
                        </div>

                        <div class="search_name_box_main">
                            <div class="text-selection_name">By Date</div>
                            <div class="input-group">
                                  <select class="form-control add_new_dropdown_report" name="bydate" id="bydate" >
                                          <option value="null" default >--Select--</option>
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
                                          <option value="Last365days">Last 1 year</option>
                                        </select>
                            </div>
                        </div>

                         
 

                   </div>
			<div id="menu_typediv" style="display:none" >
                             <div class="search_name_box_main">
                                <div class="text-selection_name">Menu Type</div>
                                   <div class="input-group" style="width: 55%;">
                                         <select  class="form-control add_new_dropdown_report"  name="menu_type" id="menu_type">
                                                 
                                             <option value="">All</option>
                                              <option value="N">Normal Menus</option>
                                             <option value="Y">Addon Menus</option>
                                           
                                         </select>    
                                  </div>
                            </div>
                            </div>	   
				   
                   <!--------------------------------item ordered---------------------------------------->
              
					<div id="item_ordered" style="display:none">
                        <div class="search_name_box_main">
                            <div class="text-selection_name">From:</div>
                            <div class="input-group">
                                <input type="text" class="form-control" id="datepickeritemorderedfrom">
                            </div>
                        </div>

                        <div class="search_name_box_main">
                            <div class="text-selection_name">To :</div>
                            <div class="input-group">
                                <input type="text" class="form-control" id="datepickeritemorderedto">
                            </div>
                        </div>

                        <div class="search_name_box_main">
                            <div class="text-selection_name">By Date</div>
                            <div class="input-group">
                                  <select class="form-control add_new_dropdown_report" id="bydateitemordered" >
                                          <option value="null" default>--Select--</option>
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
                                          <option value="Last365days">Last 1 year</option>
                                        </select>
                            </div>
                        </div>


 

                   </div>


                  
                  
				  
				  
				  
				  
				  
				  <!----------------------item order ends--------------------------------------->
				<!----------------------------Discount report----------------------------------->
				<div id="discount_report" style="display:none">
                        <div class="search_name_box_main">
                            <div class="text-selection_name">From:</div>
                            <div class="input-group">
                                <input type="text" class="form-control" id="datepickerdiscountfrom">
                            </div>
                        </div>

                        <div class="search_name_box_main">
                            <div class="text-selection_name">To :</div>
                            <div class="input-group">
                                <input type="text" class="form-control" id="datepickerdiscountto">
                            </div>
                        </div>

                        <div class="search_name_box_main">
                            <div class="text-selection_name">By Date</div>
                            <div class="input-group">
                                  <select class="form-control add_new_dropdown_report" id="bydatediscount" >
                                          <option value="null" default>--Select--</option>
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
                                          <option value="Last365days">Last 1 year</option>
                                        </select>
                            </div>
                        </div>


 

                   </div>
				<!-------------------------discount report ends---------------------------------->
				<!--------------------------------Complimentary Reoort---------------------------->
				<div id="complimentary_report" style="display:none">
                        <div class="search_name_box_main">
                            <div class="text-selection_name">From:</div>
                            <div class="input-group">
                                <input type="text" class="form-control" id="datepickercomplimentaryfrom">
                            </div>
                        </div>

                        <div class="search_name_box_main">
                            <div class="text-selection_name">To :</div>
                            <div class="input-group">
                                <input type="text" class="form-control" id="datepickercomplimentaryto">
                            </div>
                        </div>

                        <div class="search_name_box_main">
                            <div class="text-selection_name">By Date</div>
                            <div class="input-group">
                                  <select class="form-control add_new_dropdown_report" id="bydatecomplimentary" >
                                          <option value="null" default>--Select--</option>
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
                                          <option value="Last365days">Last 1 year</option>
                                        </select>
                            </div>
                        </div>


 

                   </div>
				<!-------------------------------Complimentary Report Ends------------------------>
				<!-------------------------Bill report-------------------------------------------->
				<div id="billreport" style="display:none">
                        <div class="search_name_box_main">
                            <div class="text-selection_name">From:</div>
                            <div class="input-group">
                                <input type="text" class="form-control" id="datepickerbillfrom">
                            </div>
                        </div>

                        <div class="search_name_box_main">
                            <div class="text-selection_name">To :</div>
                            <div class="input-group">
                                <input type="text" class="form-control" id="datepickerbillto">
                            </div>
                        </div>

                        <div class="search_name_box_main">
                            <div class="text-selection_name">By Date</div>
                            <div class="input-group">
                                  <select class="form-control add_new_dropdown_report" id="bydatebill" >
                                          <option value="null" default>--Select--</option>
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
                                          <option value="Last365days">Last 1 year</option>
                                        </select>
                            </div>
                        </div>


 

                   </div>
				
				<!----------------------------Bill Report Ends------------------------------------->
				<!---------------------------Type oF payment---------------------------------------->
				<div id="typeofpay" style="display:none" >
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">Type:</div>
                                     <div class="input-group">
                                         <select  class="form-control add_new_dropdown_report" name="typepay" id="typepay">
                                              <option value="null" default>Select mode</option>
                                              <option value="cash">Cash</option>
                                              <option value="credit">Credit / Debit</option>
                                              
                                         
                                              
                                              
                                         </select>   
                                    </div>
                                 </div>
                                 
                                
                                 <div class="search_name_box_main"> 
                                    <div class="text-selection_name">From:</div>
                                     <div class="input-group">
                                         <input type="text" class="form-control" id="datepickerfromtyp" >     
                                    </div>
                                 </div>
                                 
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">To  :</div> 
                                     <div class="input-group">
                                         <input type="text" class="form-control" id="datepickertodttyp" >            
                                    </div>
                                 </div>
                                
                                
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">By Date</div>
                                      <div class="input-group">
                                    <select class="form-control add_new_dropdown_report" name="paybydate" id="paybydate" >
                          <option value="null" default>--Select--</option>
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
                          <option value="Last365days">Last 1 year</option>
                                        </select>
                                    </div>
                                </div> 
                            </div>
				<!----------------------------Type of payment ends----------------------------------->
				<!-----------------------Bill Cancel-------------------------------------------------->
				<div id="billcancel_report" style="display:none">
                        <div class="search_name_box_main">
                            <div class="text-selection_name">From:</div>
                            <div class="input-group">
                                <input type="text" class="form-control" id="datepickerbillcancelfrom">
                            </div>
                        </div>

                        <div class="search_name_box_main">
                            <div class="text-selection_name">To :</div>
                            <div class="input-group">
                                <input type="text" class="form-control" id="datepickerbillcancelto">
                            </div>
                        </div>

                        <div class="search_name_box_main">
                            <div class="text-selection_name">By Date</div>
                            <div class="input-group">
                                  <select class="form-control add_new_dropdown_report" id="bydatebillcancel" >
                                          <option value="null" default>--Select--</option>
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
                                          <option value="Last365days">Last 1 year</option>
                                        </select>
                            </div>
                        </div>

                   </div>
				<!-----------------------Bill Cancel Ends---------------------------------------------->
				
                                
                                
                                
                               <!-- summary starts --> 
                            <div id="summarydivcs" style="display:none" >
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">From:</div>
                                     <div class="input-group">
                                         <input type="text" class="form-control" id="datepickerfromsummarycs" >     
                                    </div>
                                 </div>
                                 
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">To  :</div>
                                     <div class="input-group">
                                         <input type="text" class="form-control" id="datepickertosummarycs" >            
                                    </div>
                                 </div>
                                 
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">By Date</div>
                                      <div class="input-group">
                                    <select class="form-control add_new_dropdown_report" name="bydatesummary" id="bydatesummarycs" >
                                          <option value="null" default>--Select--</option>
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
                                          <option value="Last365days">Last 1 year</option>
                                        </select>
                                    </div>
                                </div> 
                            </div>
                            <!-- summary ends -->  
                                
                                
                                
                               <!-- total summary details starts --> 
                            <div id="totalsummarydetailsdivcs" style="display:none" >
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">From:</div>
                                     <div class="input-group">
                                         <input type="text" class="form-control" id="datepickerfromtotalsummarydetailscs" >     
                                    </div>
                                 </div>
                                 
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">To  :</div>
                                     <div class="input-group">
                                         <input type="text" class="form-control" id="datepickertototalsummarydetailscs" >            
                                    </div>
                                 </div>
                                 
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">By Date</div>
                                      <div class="input-group">
                                    <select class="form-control add_new_dropdown_report" name="bydatetotalsummarydetails" id="bydatetotalsummarydetailscs" >
                                          <option value="null" default>--Select--</option>
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
                                          <option value="Last365days">Last 1 year</option>
                                        </select>
                                    </div>
                                </div> 
                            </div>
                            <!-- total summary details ends -->   
                                
                                
                                
                                
                                
                                <!---------------------------Item Cancel History--------------------------------------------->
				<div id="cancel_history" style="display:none">
                        <div class="search_name_box_main">
                            <div class="text-selection_name">From:</div>
                            <div class="input-group">
                                <input type="text" class="form-control" id="datepickercancelhistoryfrom">
                            </div>
                        </div>

                        <div class="search_name_box_main">
                            <div class="text-selection_name">To :</div>
                            <div class="input-group">
                                <input type="text" class="form-control" id="datepickercancelhistoryto">
                            </div>
                        </div>

                        <div class="search_name_box_main">
                            <div class="text-selection_name">By Date</div>
                            <div class="input-group">
                                  <select class="form-control add_new_dropdown_report" id="bydatecancelhistory" >
                                          <option value="null" default>--Select--</option>
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
                                          <option value="Last365days">Last 1 year</option>
                                        </select>
                            </div>
                        </div>


 

                   </div>
				<!---------------------------Cancel History Ends-------------------------------------->
                
                                  <!-- category wise _report starts --> 
                            <div id="categorywise_report_cs" style="display:none" >
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">From:</div>
                                     <div class="input-group">
                                         <input type="text" class="form-control" id="datepickercategoryreport_csfrom" >     
                                    </div>
                                 </div>
                                 
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">To  :</div>
                                     <div class="input-group">
                                         <input type="text" class="form-control" id="datepickercategoryreport_csto" >            
                                    </div>
                                 </div>
                                 
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">By Date</div>
                                      <div class="input-group">
                                    <select class="form-control add_new_dropdown_report" name="bydatecategoryreport_cs" id="bydatecategoryreport_cs" >
                                          <option value="null" default>--Select--</option>
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
                                          <option value="Last365days">Last 1 year</option>
                                        </select>
                                    </div>
                                </div> 
                            </div>
                            <!-- category wise_report ends --> 
                            <div id="bill_sort_div" style="display:none" >
                             <div class="search_name_box_main">
                                <div class="text-selection_name">Sort By</div>
                                   <div class="input-group" style="width: 55%;">
                                         <select  class="form-control add_new_dropdown_report"  name="menu_type" id="bill_sort">
                                                 <option value="value_asc">Total Low--to--High</option>
                                              <option value="value_desc">Total High--to--Low</option>
                                             <option value="bill_asc">Bill No first--to--last</option>
                                              <option value="bill_desc">Bill No last--to--first</option>
                                              
                                             
                                           
                                         </select>    
                                  </div>
                            </div>
                            </div>  
                
                
                
                
                
                </div>
            </div>
            <!-- condition ends -->
        </div>
        <!--col-lg-12 col-md-12 nopadding-->
    </div>
    <!--header_main_container-->
    <div class="top_validate_inform"></div>
<div class="top_validate_inform"> <span id="rptstatus" class="load_error alertsmasters"></span>  </div>
   <div class="col-lg-12 col-md-12 user_detail_min_hieght reporte_min_hieght_1" style="background-color:#FCFCFC;border-bottom: 1px solid #BDBDBD;" id="reportload">
        <!--  report content-->
    </div>

     <div class="col-lg-12 col-md-12 nopadding top_main_cc">
                <form name="submitall" id="submitall"  method="post" action="<?php $_SERVER['PHP_SELF']?>"> 
                    <input type="hidden" name="hidfr" id="hidfr" />
                    <input type="hidden" name="hidto" id="hidto" /> 
                    <input type="hidden" name="hidval" id="hidval" />
                    <input type="hidden" name="hidpaytyp" id="hidpaytyp" />
                   
                     <input type="hidden" name="hidstw" id="hidstw" />
                     <input type="hidden" name="hidord" id="hidord" />
                     <input type="hidden" name="hidbydate" id="hidbydate"/>
                     
                    <div class="search_name_box_sub_btn_cc" id="prnt" style="display:none">
                           <div  class="filter_sub_btn ">
                            <a class="btn-setting"  href="#" onclick="print_page()">Print</a>
                            </div>
                     </div>
                      <div class="search_name_box_sub_btn_cc" id="excel" style="display:block">
                           <div  class="filter_sub_btn ">
                            <a class="btn-setting"  href="#" onclick="movetoexcelForm()">TO Excel</a>
                            </div>
                      </div>
                     
                  <!--   <div class="search_name_box_sub_btn_cc">
                           <div  class="filter_sub_btn ">
                            <a class="btn-setting"  href="#" onclick="pdf_page()">To Text</a>
                            </div>
                      </div>-->
                    
                </form> 
            </div>
</div>
    </div>
</div>
</div>
 
	
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

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
}//   kotcounter maincat subcat diet desc timem prepmode actives
function validate_report()   
{
	if(document.getElementById("reportname").value=="")
	{
		$("#report_div").addClass("has-error");
			  document.report.reportname.focus();
			  return false;
	}else
		 {
			$("#report_div").removeClass("has-error");
				$(this).addClass("has-success");
				 return true;
			
		 }
}
function clearall()
{
 $('#datepickerfrom').val(""); 
 $('#datepickerto').val("");
 //$('#bydate').val("");
 $('#datepickeritemorderedfrom').val("");
  $('#datepickeritemorderedto').val("");

	//$('#bydateitemordered').val("");
	$('#datepickerdiscountfrom').val("");
	$('#datepickerdiscountto').val("");
	//$('#bydatediscount').val("");
	$('#datepickercomplimentaryfrom').val("");
	$('#datepickercomplimentaryto').val("");
		//$('#bydatecomplimentary').val("");
	$('#datepickerbillfrom').val("");
	$('#datepickerbillto').val("");
	//$('#bydatebill').val("");
	//$('#typepay').val("");
	$('#datepickerfromtyp').val("");
	$('#datepickertodttyp').val("");
	
	//$('#paybydate').val("");
	$('#datepickercategoryreport_csfrom').val("");
        $('#datepickercategoryreport_csto').val("");
}
function reportcreate(rpt)
{
var repttype=rpt;

if(repttype == "totalsales_cs")
	{
            $('#summarydivcs').css("display", "none");
            $('#totalsummarydetailsdivcs').css("display", "none");			
			$('#counter_sale').css("display", "block");
            $('#summarydivcs').css("display", "none");
			$('#billcancel_report').css("display", "none");
			$('#typeofpay').css("display", "none");
			$('#billreport').css("display", "none");
			$('#complimentary_report').css("display", "none");
			$('#item_ordered').css("display", "none");
			$('#discount_report').css("display", "none");
			$('#stewardtimelydiv').css("display","none");
			$('#cancel_history').css("display", "none");
            $('#prnt').css("display","block");
            $('#categorywise_report_cs').css("display", "none");
            $('#excel').css("display","block");
            $('#menu_typediv').css("display", "none");
            $('#bill_sort_div').css("display", "none");
					
		$('#reportload1').html("");
		clearall();
		var log_user = $('#users').val();
				$.post("load_report_cs.php",{log_user:log_user,type:repttype,fromdt:'',todt:'',bydate:''},
				  function(data)
				  {		
					data=$.trim(data);
					$('#reportload').html(data);						
				  });	
	}
	else if(repttype == "itemordered_cs")
	{
            $('#summarydivcs').css("display", "none");
            $('#totalsummarydetailsdivcs').css("display", "none");
			$('#item_ordered').css("display", "block");
            $('#summarydivcs').css("display", "none");
			$('#billcancel_report').css("display", "none");
			$('#billreport').css("display", "none");
			$('#typeofpay').css("display", "none");
			$('#complimentary_report').css("display", "none");
			$('#counter_sale').css("display", "none");
			$('#discount_report').css("display", "none");
			$('#cancel_history').css("display", "none");
            $('#prnt').css("display","block");
            $('#categorywise_report_cs').css("display", "none");
            $('#excel').css("display","block");
            $('#menu_typediv').css("display", "block");
            $('#bill_sort_div').css("display", "none");
			
			$('#reportload1').html("");
		clearall();
		
				$.post("load_report_cs.php",{type:repttype,fromdt:'',todt:'',bydate:'',addon:''},
				  function(data)
				  {		
					data=$.trim(data);
					$('#reportload').html(data);						
				  });	
	}
	else if(repttype == "discountreport_cs")
	{
            
        $('#summarydivcs').css("display", "none");
        $('#totalsummarydetailsdivcs').css("display", "none");
		$('#discount_report').css("display", "block");
        $('#summarydivcs').css("display", "none");
		$('#billcancel_report').css("display", "none");
		$('#typeofpay').css("display", "none");
		$('#billreport').css("display", "none");
		$('#complimentary_report').css("display", "none");
		$('#item_ordered').css("display", "none");
		$('#counter_sale').css("display", "none");
		$('#cancel_history').css("display", "none");
		$('#prnt').css("display","block");
		$('#categorywise_report_cs').css("display", "none");
        $('#excel').css("display","block");
        $('#menu_typediv').css("display", "none");
        $('#bill_sort_div').css("display", "none");
		
		$('#reportload1').html("");
		clearall();
				$.post("load_report_cs.php",{type:repttype,fromdt:'',todt:'',bydate:''},
				  function(data)
				  {		
					data=$.trim(data);
					$('#reportload').html(data);						
				  });
	}
	else if(repttype == "complimentary_cs")
	{
        $('#summarydivcs').css("display", "none");
        $('#totalsummarydetailsdivcs').css("display", "none");
        $('#billreport').css("display", "none");
        $('#summarydivcs').css("display", "none");
		$('#billcancel_report').css("display", "none");
		$('#typeofpay').css("display", "none");
		$('#complimentary_report').css("display", "block");
		$('#discount_report').css("display", "none");
		$('#item_ordered').css("display", "none");
		$('#counter_sale').css("display", "none");
		$('#cancel_history').css("display", "none");
		$('#categorywise_report_cs').css("display", "none");
		$('#prnt').css("display","block");
        $('#excel').css("display","block");
        $('#menu_typediv').css("display", "none");
        $('#bill_sort_div').css("display", "none");
		
		$('#reportload1').html("");
		clearall();
			
					$.post("load_report_cs.php",{type:repttype,fromdt:'',todt:'',bydate:''},
				  function(data)
				  {		
						data=$.trim(data);
						$('#reportload').html(data);
						
				  });
		
		
	}
	else if(repttype == "billreport_cs")
	{
        $('#summarydivcs').css("display", "none");
        $('#totalsummarydetailsdivcs').css("display", "none");
        $('#billcancel_report').css("display", "none");
		$('#billreport').css("display", "block");
        $('#summarydivcs').css("display", "none");
		$('#typeofpay').css("display", "none");
		$('#complimentary_report').css("display", "none");
		$('#discount_report').css("display", "none");
		$('#item_ordered').css("display", "none");
		$('#counter_sale').css("display", "none");
		$('#cancel_history').css("display", "none");
		$('#prnt').css("display","block");
        $('#categorywise_report_cs').css("display", "none");
		$('#reportload1').html("");
        $('#excel').css("display","block");
        $('#menu_typediv').css("display", "none");
        $('#bill_sort_div').css("display", "block");
        $('#bill_sort').find('option:first').prop('selected','selected');
        var sortby=$('#bill_sort').val();
		clearall();

					$.post("load_report_cs.php",{type:repttype,fromdt:'',todt:'',bydate:'',sortby:sortby},
				  function(data)
				  {		
						data=$.trim(data);					
						$('#reportload').html(data);						
				  });			
	}
	else if(repttype == "paymenttype_cs")
	{
        $('#summarydivcs').css("display", "none");
        $('#totalsummarydetailsdivcs').css("display", "none");
        $('#billcancel_report').css("display", "none");
		$('#typeofpay').css("display", "block");
        $('#summarydivcs').css("display", "none");
		$('#billreport').css("display", "none");
		$('#complimentary_report').css("display", "none");
		$('#discount_report').css("display", "none");
		$('#item_ordered').css("display", "none");
		$('#counter_sale').css("display", "none");
		$('#cancel_history').css("display", "none");
		$('#prnt').css("display","block");
		$('#categorywise_report_cs').css("display", "none");	
		$('#reportload1').html("");
        $('#excel').css("display","block");
        $('#menu_typediv').css("display", "none");
        $('#bill_sort_div').css("display", "none");
		clearall();
	}
	
	else if(repttype == "billcancel_cs")
	{
        $('#summarydivcs').css("display", "none");
        $('#totalsummarydetailsdivcs').css("display", "none");
		$('#billcancel_report').css("display", "block");
		$('#billreport').css("display", "none");
		$('#typeofpay').css("display", "none");
        $('#summarydivcs').css("display", "none");
		$('#complimentary_report').css("display", "none");
		$('#discount_report').css("display", "none");
		$('#item_ordered').css("display", "none");
		$('#counter_sale').css("display", "none");
		$('#cancel_history').css("display", "none");
		$('#prnt').css("display","block");
        $('#categorywise_report_cs').css("display", "none");
		$('#reportload1').html("");
        $('#excel').css("display","block");
        $('#menu_typediv').css("display", "none");
        $('#bill_sort_div').css("display", "none");
		clearall();
	
		$.post("load_report_cs.php",{type:repttype,fromdt:'',todt:'',bydate:''},
		function(data)
			{		
				data=$.trim(data);					
				$('#reportload').html(data);						
			});
	}
        
        
    else if(repttype == "summary_cs")
	{	
		$('#billcancel_report').css("display", "none");
        $('#summarydivcs').css("display", "block");
        $('#totalsummarydetailsdivcs').css("display", "none");
		$('#billreport').css("display", "none");
		$('#typeofpay').css("display", "none");
		$('#complimentary_report').css("display", "none");
		$('#discount_report').css("display", "none");
		$('#item_ordered').css("display", "none");
		$('#counter_sale').css("display", "none");
		$('#cancel_history').css("display", "none");
		$('#prnt').css("display","block");
        $('#categorywise_report_cs').css("display", "none");
		$('#reportload1').html("");
        $('#excel').css("display","block");
        $('#menu_typediv').css("display", "none");
        $('#bill_sort_div').css("display", "none");
		clearall();
					$.post("load_report_cs.php",{type:repttype,fromdt:'',todt:'',bydate:''},
				  function(data)
				  {		
						data=$.trim(data);
						$('#reportload').html(data);					
				  });		
	}
        
        
     else if(repttype == "total_summary_details_cs")
	{	
        $('#totalsummarydetailsdivcs').css("display", "block");
        $('#summarydivcs').css("display", "none");
		$('#billcancel_report').css("display", "none");
        $('#summarydivcs').css("display", "none");
		$('#billreport').css("display", "none");
		$('#typeofpay').css("display", "none");
		$('#complimentary_report').css("display", "none");
		$('#discount_report').css("display", "none");
		$('#item_ordered').css("display", "none");
		$('#counter_sale').css("display", "none");
		$('#cancel_history').css("display", "none");
		$('#prnt').css("display","block");
        $('#categorywise_report_cs').css("display", "none");
		$('#reportload1').html("");
        $('#excel').css("display","block");
        $('#menu_typediv').css("display", "none");
        $('#bill_sort_div').css("display", "none");
				clearall();		
					$.post("load_report_cs.php",{type:repttype,fromdt:'',todt:'',bydate:''},
				  function(data)
				  {		
						data=$.trim(data);
						$('#reportload').html(data);						
				  });	
	}
        
        
        
	else if(repttype == "cancelhistory_cs")
	{
        $('#summarydivcs').css("display", "none");
        $('#totalsummarydetailsdivcs').css("display", "none");
		$('#cancel_history').css("display", "block");
		$('#billcancel_report').css("display", "none");
		$('#billreport').css("display", "none");
		$('#typeofpay').css("display", "none");
		$('#complimentary_report').css("display", "none");
		$('#discount_report').css("display", "none");
        $('#item_ordered').css("display", "none");
		$('#counter_sale').css("display", "none");
		$('#categorywise_report_cs').css("display", "none");	
		$('#prnt').css("display","block");
        $('#excel').css("display","block");
        $('#menu_typediv').css("display", "none");
        $('#bill_sort_div').css("display", "none");
	
		$('#reportload1').html("");
		clearall();

		$.post("load_report_cs.php",{type:repttype,fromdt:'',todt:'',bydate:''},
		function(data)
		{	
			data=$.trim(data);
			$('#reportload').html(data);
		});				
	}
        
    else if(repttype == "categorywise_report_cs")
	{       
        $('#categorywise_report_cs').css("display", "block");
        $('#summarydivcs').css("display", "none");
        $('#totalsummarydetailsdivcs').css("display", "none");
		$('#cancel_history').css("display", "none");
		$('#billcancel_report').css("display", "none");
		$('#billreport').css("display", "none");
		$('#typeofpay').css("display", "none");
		$('#complimentary_report').css("display", "none");
		$('#discount_report').css("display", "none");
        $('#item_ordered').css("display", "none");
		$('#counter_sale').css("display", "none");
		$('#prnt').css("display","block");
	    $('#reportload1').html("");
        $('#excel').css("display","block");
        $('#menu_typediv').css("display", "none");
        $('#bill_sort_div').css("display", "none");
		
            clearall();
	
				$.post("load_report_cs.php",{type:repttype,fromdt:'',todt:'',bydate:''},
				  function(data)
				  {		
					data=$.trim(data);
					$('#reportload').html(data);
				  });	
	}
	else{
            $('#summarydivcs').css("display", "none");
                $('#totalsummarydetailsdivcs').css("display", "none");
			$('#billcancel_report').css("display", "none");
			$('#cancel_history').css("display", "none");
			$('#counter_sale').css("display", "none");
				$('#typeofpay').css("display", "none");
			$('#billreport').css("display", "none");
			$('#complimentary_report').css("display", "none");
			$('#item_ordered').css("display", "none");
			$('#discount_report').css("display", "none");
			$('#stewardtimelydiv').css("display","none");
                        $('#excel').css("display","block");
                        $('#menu_typediv').css("display", "none");
                        $('#bill_sort_div').css("display", "none");
			clearall();
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
         
	if(vv=="totalsales_cs")
		{vv=ofprint;
	
			var tot_from=$('#datepickerfrom').val();
    		var tot_to=$('#datepickerto').val();
            var log_user = $('#users').val();
			var hidbydate=$('#bydate').val();
			var a4paper=$('#hida4settings').val();

			if(printera4=="N")
				{
                window.open("print_bill_cs.php?type="+vv+"&from="+tot_from+"&to="+tot_to+"&hidbydate="+hidbydate+"&log_user="+log_user+"#print", '_blank');
				}
			else
				{
				$.post("print_report_countersale.php", {type:vv,hidfr:tot_from,hidto:tot_to,hidbydate:hidbydate,log_user:log_user},
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
		
	else if(vv=="itemordered_cs")
		{
			var tot_from=$('#datepickeritemorderedfrom').val();
    		var tot_to=$('#datepickeritemorderedto').val();
			var hidbydate=$('#bydateitemordered').val();
			var a4paper=$('#hida4settings').val();
            var addon=$('#menu_type').val();

					if(printera4=="N")
					{
					window.open("print_bill_cs.php?type="+vv+"&from="+tot_from+"&to="+tot_to+"&hidbydate="+hidbydate+"&addon="+addon+"#print", '_blank');
					}else
					{						
						$.post("print_report_countersale.php", {type:vv,hidfr:tot_from,hidto:tot_to,hidbydate:hidbydate,addon:addon},
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
	
	
	else if(vv=="discountreport_cs")
		{
			var tot_from=$('#datepickerdiscountfrom').val();
    		var tot_to=$('#datepickerdiscountto').val();
			var hidbydate=$('#bydatediscount').val();
			var a4paper=$('#hida4settings').val();

					if(printera4=="N")
					{
					window.open("print_bill_cs.php?type="+vv+"&from="+tot_from+"&to="+tot_to+"&hidbydate="+hidbydate+"#print", '_blank');
					}else
					{
						
						$.post("print_report_countersale.php", {type:vv,hidfr:tot_from,hidto:tot_to,hidbydate:hidbydate},
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
	else if(vv=="complimentary_cs")
		{
			var tot_from=$('#datepickercomplimentaryfrom').val();
            var tot_to=$('#datepickercomplimentaryto').val();
			var hidbydate=$('#bydatecomplimentary').val();
			var a4paper=$('#hida4settings').val();	

					if(printera4=="N")
					{
					window.open("print_bill_cs.php?type="+vv+"&from="+tot_from+"&to="+tot_to+"&hidbydate="+hidbydate+"#print", '_blank');
					}else
					{
						
						$.post("print_report_countersale.php", {type:vv,hidfr:tot_from,hidto:tot_to,hidbydate:hidbydate},
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
	else if(vv=="billreport_cs")
		{
			var tot_from=$('#datepickerbillfrom').val();
    		var tot_to=$('#datepickerbillto').val();

			var hidbydate=$('#bydatebill').val();
			var a4paper=$('#hida4settings').val();
            var sortby=$('#bill_sort').val();
		
					if(printera4=="N")
					{
					window.open("print_bill_cs.php?type="+vv+"&from="+tot_from+"&to="+tot_to+"&hidbydate="+hidbydate+"&sortby="+sortby+"#print", '_blank');
					}else
					{
						
						$.post("print_report_countersale.php", {type:vv,hidfr:tot_from,hidto:tot_to,hidbydate:hidbydate,sortby:sortby},
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
		else if(vv=="paymenttype_cs")
		{ 
			 var tot_from=$('#datepickerfromtyp').val();
	
			 var tot_to=$('#datepickertodttyp').val(); 
	
			 var typ=document.getElementById("typepay").value; 
	
			var paybydate=document.getElementById("paybydate").value; 
			 if(typ !="null")
			 {			
					if(printera4=="N")
					{
					window.open("print_bill_cs.php?type="+vv+"&from="+tot_from+"&to="+tot_to+"&types="+typ+"&hidpay="+paybydate+"#print",'_blank');
					}				
			 }
			 else
			 
			 {
				 ('#reportload').empty();	
				$('#rptstatus').css("display", "block");
			  var rpts=$('#rptstatus');
		       rpts.text('No records to print');	
	     	$("#rptstatus").delay(1000).fadeOut('slow');
			 }
		}
	else if(vv=="billcancel_cs")
		{
			var tot_from=$('#datepickerbillcancelfrom').val();
            var tot_to=$('#datepickerbillcancelto').val();		
			var hidbydate=$('#bydatebillcancel').val();
			var a4paper=$('#hida4settings').val();

					if(printera4=="N")
					{
					window.open("print_bill_cs.php?type="+vv+"&from="+tot_from+"&to="+tot_to+"&hidbydate="+hidbydate+"#print", '_blank');
					}else
					{						
						$.post("print_report_countersale.php", {type:vv,hidfr:tot_from,hidto:tot_to,hidbydate:hidbydate},
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
		
                
        else if(vv=="summary_cs")
		{                   
            var tot_from=$('#datepickerfromsummarycs').val();
    		var tot_to=$('#datepickertosummarycs').val();
			var hidbydate=$('#bydatesummarycs').val();
			var a4paper=$('#hida4settings').val();
                                   
                    if(printera4=="N")
					{
					window.open("print_bill_cs.php?type="+vv+"&from="+tot_from+"&to="+tot_to+"&hidbydate="+hidbydate+"#print", '_blank');
					}else
					{						
						$.post("print_report_countersale.php", {type:vv,hidfr:tot_from,hidto:tot_to,hidbydate:hidbydate},
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

        else if(vv=="total_summary_details_cs")
		{
                   var tot_from=$('#datepickerfromtotalsummarydetailscs').val();
    		var tot_to=$('#datepickertototalsummarydetailscs').val();
			
			var hidbydate=$('#bydatetotalsummarydetailscs').val();
			var a4paper=$('#hida4settings').val(); 
                                  
                    if(printera4=="N")
					{
					window.open("print_bill_cs.php?type="+vv+"&from="+tot_from+"&to="+tot_to+"&hidbydate="+hidbydate+"#print", '_blank');
					}else
					{
						
						$.post("print_report_countersale.php", {type:vv,hidfr:tot_from,hidto:tot_to,hidbydate:hidbydate},
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
                
                
           
		else if(vv=="cancelhistory_cs")
		{			
			var tot_from=$('#datepickercancelhistoryfrom').val();
    		var tot_to=$('#datepickercancelhistoryto').val();		
			var hidbydate=$('#bydatecancelhistory').val();
			var a4paper=$('#hida4settings').val();

					if(printera4=="N")
					{
					window.open("print_bill_cs.php?type="+vv+"&from="+tot_from+"&to="+tot_to+"&hidbydate="+hidbydate+"#print", '_blank');
					}else
					{
						
						$.post("print_report_countersale.php", {type:vv,hidfr:tot_from,hidto:tot_to,hidbydate:hidbydate},
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
                
        else if(vv=="categorywise_report_cs")
		{			
			var tot_from=$('#datepickercategoryreport_csfrom').val();
            var tot_to=$('#datepickercategoryreport_csto').val();
			var hidbydate=$('#bydatecategoryreport_cs').val();
			var a4paper=$('#hida4settings').val();

					if(printera4=="N")
					{
					window.open("print_bill_cs.php?type="+vv+"&fromdt="+tot_from+"&todt="+tot_to+"&bydate="+hidbydate+"#print", '_blank');
					}else
					{						
						$.post("print_report_countersale.php", {type:vv,hidfr:tot_from,hidto:tot_to,hidbydate:hidbydate},
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
 
 function movetoexcelForm()
    {
	var check = confirm("Are you sure you want to create excel sheet of these records?");
   
	if(check==true)
	{
            var vv=document.getElementById("typeval").value;
           
            document.getElementById("hidval").value=vv;
            	
        if(vv=="totalsales_cs")
		{
            var hidfr=$('#datepickerfrom').val();
    		var hidto=$('#datepickerto').val();
			var log_user = $('#users').val();
			var hidbydate=$('#bydate').val();

			window.location="taexcel_download.php?type="+vv+"&hidfr="+hidfr+"&hidto="+hidto+"&hidbydate="+hidbydate+"&log_user="+log_user;
	
		}
                
        else if(vv=="itemordered_cs")
		{      
            var hidfr=$('#datepickeritemorderedfrom').val();
            var hidto=$('#datepickeritemorderedto').val();
			var hidbydate=$('#bydateitemordered').val();		
			var addon=$('#menu_type').val();	
			window.location="taexcel_download.php?type="+vv+"&hidfr="+hidfr+"&hidto="+hidto+"&hidbydate="+hidbydate+"&addon="+addon;				 
		} 
                      
        else if(vv=="categorywise_report_cs")
            {                    
                var hidfr=$('#datepickercategoryreport_csfrom').val();
                var hidto=$('#datepickercategoryreport_csto').val();
				var hidbydate=$('#bydatecategoryreport_cs').val();	
				window.location="taexcel_download.php?type="+vv+"&fromdt="+hidfr+"&todt="+hidto+"&bydate="+hidbydate;			
		}  
        else if(vv=="billcancel_cs")
        {                     
            var tot_from=$('#datepickerbillcancelfrom').val();
            var tot_to=$('#datepickerbillcancelto').val();
            var hidbydate=$('#bydatebillcancel').val();			      
			window.location="taexcel_download.php?type="+vv+"&fromdt="+tot_from+"&todt="+tot_to+"&bydate="+hidbydate;
		}
                
        else if(vv=="cancelhistory_cs")
        {                   
            var tot_from=$('#datepickercancelhistoryfrom').val();
            var tot_to=$('#datepickercancelhistoryto').val();
			var hidbydate=$('#bydatecancelhistory').val();			
			window.location="taexcel_download.php?type="+vv+"&fromdt="+tot_from+"&todt="+tot_to+"&bydate="+hidbydate;		
		}    
    else if(vv=="total_summary_details_cs")
        {
            var tot_from=$('#datepickerfromtotalsummarydetailscs').val();
            var tot_to=$('#datepickertototalsummarydetailscs').val();
            var hidbydate=$('#bydatetotalsummarydetailscs').val();		
			window.location="taexcel_download.php?type="+vv+"&fromdt="+tot_from+"&todt="+tot_to+"&bydate="+hidbydate;	
		} 
           
      else if(vv=="summary_cs")
        {
            var tot_from=$('#datepickerfromsummarycs').val();
            var tot_to=$('#datepickertosummarycs').val();
            var hidbydate=$('#bydatesummarycs').val();			
			window.location="taexcel_download.php?type="+vv+"&fromdt="+tot_from+"&todt="+tot_to+"&bydate="+hidbydate;				
		}             
     else if(vv=="complimentary_cs")
        {
            var tot_from=$('#datepickercomplimentaryfrom').val();
            var tot_to=$('#datepickercomplimentaryto').val();
			var hidbydate=$('#bydatecomplimentary').val();
			window.location="taexcel_download.php?type="+vv+"&fromdt="+tot_from+"&todt="+tot_to+"&bydate="+hidbydate;				
		}                    
    else if(vv=="billreport_cs")
        {
            var tot_from=$('#datepickerbillfrom').val();
    		var tot_to=$('#datepickerbillto').val();
			var hidbydate=$('#bydatebill').val();
		 	var sortby=$('#bill_sort').val();	
			window.location="taexcel_download.php?type="+vv+"&fromdt="+tot_from+"&todt="+tot_to+"&bydate="+hidbydate+"&sortby="+sortby;	
		}        
           
    else if(vv=="paymenttype_cs")
        {
        var tot_from=$('#datepickerfromtyp').val();
		var tot_to=$('#datepickertodttyp').val(); 
		var typ=document.getElementById("typepay").value; 
        var bydate=document.getElementById("paybydate").value;
		window.location="taexcel_download.php?type="+vv+"&fromdt="+tot_from+"&todt="+tot_to+"&bydate="+bydate+"&types="+typ;
		}                  
        }
    }
 
</script>
<script type="text/javascript" >
$(document).ready(function() {
   $('.time').timepicker({
        'timeFormat': 'H:i:s (g:ia)'
    });
}); 
</script>
</body>
</html>
