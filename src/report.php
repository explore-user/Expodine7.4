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
$_SESSION['pagid']=7;
?>
<!DOCTYPE HTML>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="shortcut icon" href="img/favicon.ico">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Report</title>
<link href="css/menu_master_style.css" rel="stylesheet">
<link id="bs-css" href="css/bootstrap-cerulean.min.css" rel="stylesheet">
<!--<link rel="stylesheet" href="css/font-awesome.min.css">-->
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

<style>.left_list_cc{height: 71vh;min-height: 498px !important}
.search_name_box_main .form-control {    border-radius: 5px !important;}
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
    $("#boxscroll2").niceScroll("#contentscroll2",{cursorcolor:"#F00",cursoropacitymax:0.7,boxzoom:true,touchbehavior:true});  // Second scrollable DIV
    $("#boxframe").niceScroll("#boxscroll3",{cursorcolor:"#0F0",cursoropacitymax:0.7,boxzoom:true,touchbehavior:true});  // This is an IFrame (iPad compatible)
    $("#boxscroll4").niceScroll("#boxscroll4 .wrapper",{boxzoom:true});  // hw acceleration enabled when using wrapper   
/*   sorting in order starts   */
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
/*   sorting in order ends   */
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
	  $("#datepickerfromsummaryham").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	 $("#datepickertosummaryham").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
     $("#datepickerfromtotalsummarydetails").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	 $("#datepickertototalsummarydetails").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	$("#datepickerfromturnoversummary").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	$("#datepickertoturnoversummary").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	$("#datepickerfromturnover").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	$("#datepickertoturnover").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	$("#datepickerfromgeneralrating").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	$("#datepickertogeneralrating").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	  $("#datepickerfromenurating").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	 $("#datepickertomenurating").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	  $("#datepickerfromfeedback").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	 $("#datepickertofeedback").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
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
	$("#datepickerfromdisc").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	 $("#datepickertodtdisc").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });    
    $("#datepickerfromturn").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	 $("#datepickertodtturn").datepicker({
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
	$("#datepickerfromdtstw").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	 $("#datepickertodtstw").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	$("#datepickerfromord").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
    $("#datepickerfromktc").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	 $("#datepickertodtktc").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	$("#datepickeritemtimely").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	 $("#datepickertodtord").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	$("#datepickerfromdttpord").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	 $("#datepickertodttpord").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	$("#datepickerfromdtprtn").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	 $("#datepickertodtprtn").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	$("#datepickerfromcancel").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	 $("#datepickertodtcancel").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	$("#datepickerfrom_cl").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	 $("#datepickertodt_cl").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	$("#datepickerfromkot").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	 $("#datepickertodtkot").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	$("#datepickerfrombill").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	 $("#datepickertobill").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	$("#datepickerfromsummary").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	 $("#datepickertosummary").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	 $("#datepickercompfrom").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	 $("#datepickercomptodt").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	 $("#datepickercrdtfrom").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	 $("#datepickercrdttodt").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	$("#datepickerfromkot").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	$("#datepickerfromkothis").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	$("#datepickerfromloyality").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	$("#datepickertoloyality").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	$("#datepickerfromnewsale").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	$("#datepickertonewsale").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	$("#datepickerfromregenerate").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	$("#datepickertoregenerate").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
    $("#datepickerfromdtstwprf").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
    $("#datepickertodtstwprf").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
     $("#datepickerfromcategory_wise").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
    $("#datepickertocategory_wise").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	/*******************date picker change summary_ham starts********************************************************************/
        $('#condition_type').change(function () {
		$('#ui-datepicker-div').css("display", "none");
		var fromval=$(this).val();
		var tot_to=$('#datepickertosummaryham').val();
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;
        var floorvals=$('#floorsel').val();
        var condition=$('#condition_type').val();   
        var mode=$('#mode_sec').val();
        $('#bydatesummaryham').val("null");
		
		if(tot_to=="")
		{
			tot_to="";
		}
						$.post("load_report.php", {fromdt:fromval,todt:tot_to,type:typeval,condition:condition,mode:mode,set:"ft"},
						function(data)
						{
							  data=$.trim(data);			
					 $('#reportload').html(data);
						});

	});
	
		$('#datepickerfromsummaryham').change(function () {
		$('#ui-datepicker-div').css("display", "none");
		var fromval=$(this).val();
		var tot_to=$('#datepickertosummaryham').val();
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;
		
        $('#bydatesummaryham').val("null");
		
		if(tot_to=="")
		{
			tot_to="";
		}
						$.post("load_report.php", {fromdt:fromval,todt:tot_to,type:typeval,set:"ft"},
						function(data)
						{
						data=$.trim(data);				
					 	$('#reportload').html(data);
						});	
	});
	
	
		$('#datepickertosummaryham').change(function () {
		$('#bydatesummaryham').val("null");
		$('#ui-datepicker-div').css("display", "none");
		var tot_to=$(this).val();
		var tot_from=$('#datepickerfromsummaryham').val();
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;
		if(tot_from=="")
		{
			tot_from="";
		}
						$.post("load_report.php", {fromdt:tot_from,todt:tot_to,type:typeval,set:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
	});
	$('#bydatesummaryham').change(function () {
	var typeval=$('#typeval').val();
	  $('#datepickerfromsummaryham').val(""); 
	 $('#datepickertosummaryham').val("");
		var bydate=$('#bydatesummaryham').val();

						$.post("load_report.php", {bydate:bydate,type:typeval,abc:"ft"},
						function(data)
						{
							  data=$.trim(data);						
							  $('#reportload').html(data);
						});
	});
		
/******************* summary_ham ends********************************************************************/

$('#datepickerfromnewsale').change(function () {
		$('#ui-datepicker-div').css("display", "none");
		var fromval=$(this).val();
		var tot_to=$('#datepickertonewsale').val();
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;
		
        $('#bynewsale').val("null");
		
		if(tot_to=="")
		{
			tot_to="";
		}
						$.post("load_report.php", {fromdt:fromval,todt:tot_to,type:typeval,set:"ft"},
						function(data)
						{
						data=$.trim(data);					
					 $('#reportload').html(data);
						});
	});
		$('#datepickertonewsale').change(function () {
		$('#bynewsale').val("null");
		$('#ui-datepicker-div').css("display", "none");
		var tot_to=$(this).val();
		var tot_from=$('#datepickerfromnewsale').val();
		var typeval=$('#typeval').val();
		if(tot_from=="")
		{
			tot_from="";
		}
						$.post("load_report.php", {fromdt:tot_from,todt:tot_to,type:typeval,set:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
	});	
		$('#bynewsale').change(function () {
		var typeval=$('#typeval').val();
	  $('#datepickertonewsale').val(""); 
	 $('#datepickerfromnewsale').val("");
		var bydate=$('#bynewsale').val();
	
						$.post("load_report.php", {bydate:bydate,type:typeval,abc:"ft"},
						function(data)
						{
							  data=$.trim(data);							
							  $('#reportload').html(data);
						});
                      });

$('#datepickerfromregenerate').change(function () {
		$('#ui-datepicker-div').css("display", "none");
		var fromval=$(this).val();
		var tot_to=$('#datepickertoregenerate').val();
		var typeval=$('#typeval').val();	
        $('#bydateregenerate').val("null");
		
		if(tot_to=="")
		{
			tot_to="";
		}
						$.post("load_report.php", {fromdt:fromval,todt:tot_to,type:typeval,set:"ft"},
						function(data)
						{
							  data=$.trim(data);					
					 $('#reportload').html(data);
						});
	});
	
		$('#datepickertoregenerate').change(function () {
		$('#bydateregenerate').val("null");
		$('#ui-datepicker-div').css("display", "none");
		var tot_to=$(this).val();
		var tot_from=$('#datepickerfromregenerate').val();
		var typeval=$('#typeval').val();
		if(tot_from=="")
		{
			tot_from="";
		}			
						$.post("load_report.php", {fromdt:tot_from,todt:tot_to,type:typeval,set:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
	});
			$('#bydateregenerate').change(function () {

	var typeval=$('#typeval').val();
	  $('#datepickertoregenerate').val(""); 
	 $('#datepickerfromregenerate').val("");
		var bydate=$('#bydateregenerate').val();
		
						$.post("load_report.php", {bydate:bydate,type:typeval,abc:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
	});

/*******************date picker change kot history starts********************************************************************/

$('#datepickerfromkothis').change(function () {
		$('#ui-datepicker-div').css("display", "none");
		var fromval=$(this).val();
		var typeval=$('#typeval').val();
		$('#kotbydate').val("null");
						$.post("load_report.php", {fromdt:fromval,type:typeval,set:"ft"},
						function(data)
						{
							  data=$.trim(data);						
							  $('#reportload').html(data);
						});	
});
	$('#datepickertokot').change(function () {
		$('#ui-datepicker-div').css("display", "none");
		var fromval=$('#datepickerfromkothis').val();
		var tot_to=$(this).val();
		var typeval=$('#typeval').val();	
$('#kotbydate').val("null");
		if(tot_to=="")
		{
			tot_to="";
		}
						$.post("load_report.php", {fromdt:fromval,todt:tot_to,type:typeval,set:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});	
});


/********************************general feedback rating starts*************************************************************/
		$('#datepickerfromgeneralrating').change(function () {
		$('#ui-datepicker-div').css("display", "none");
		var fromval=$(this).val();
		var tot_to=$('#datepickertogeneralrating').val();
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;
		
$('#byratingdate').val("null");
		
		if(tot_to=="")
		{
			tot_to="";
		}
						$.post("load_report.php", {fromdt:fromval,todt:tot_to,type:typeval,set:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});	
	});
		$('#datepickertogeneralrating').change(function () {
		$('#byratingdate').val("null");
		$('#ui-datepicker-div').css("display", "none");
		var tot_to=$(this).val();
		var tot_from=$('#datepickerfromgeneralrating').val();
		var typeval=$('#typeval').val();
		if(tot_from=="")
		{
			tot_from="";
		}
						$.post("load_report.php", {fromdt:tot_from,todt:tot_to,type:typeval,set:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
	});
			$('#byratingdate').change(function () {
		var typeval=$('#typeval').val();
	  $('#datepickerfromgeneralrating').val(""); 
	 $('#datepickertogeneralrating').val("");
		var bydate=$('#byratingdate').val();
	
						$.post("load_report.php", {bydate:bydate,type:typeval,abc:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
	});
	
/*******************************general feedback rating ends****************************************************************/
/*******************************table turnover starts****************************************************************/
		$('#datepickerfromturnover').change(function () {
		$('#ui-datepicker-div').css("display", "none");
		var fromval=$(this).val();
		var tot_to=$('#datepickertoturnover').val();
		var typeval=$('#typeval').val();		
$('#byturnover').val("null");
		
		if(tot_to=="")
		{
			tot_to="";
		}
						$.post("load_report.php", {fromdt:fromval,todt:tot_to,type:typeval,set:"ft"},
						function(data)
						{
							  data=$.trim(data);					
							  $('#reportload').html(data);
						});
	});
		$('#datepickertoturnover').change(function () {
		$('#byturnover').val("null");
		$('#ui-datepicker-div').css("display", "none");
		var tot_to=$(this).val();
		var tot_from=$('#datepickerfromturnover').val();
		var typeval=$('#typeval').val();
		if(tot_from=="")
		{
			tot_from="";
		}
						$.post("load_report.php", {fromdt:tot_from,todt:tot_to,type:typeval,set:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
	});
		$('#byturnover').change(function () {
		var typeval=$('#typeval').val();
	  $('#datepickerfromturnover').val(""); 
	 $('#datepickertoturnover').val("");
		var bydate=$('#byturnover').val();
						$.post("load_report.php", {bydate:bydate,type:typeval,abc:"ft"},
						function(data)
						{
							  data=$.trim(data);						
							  $('#reportload').html(data);
						});
			  });
/*******************************table turnover ends****************************************************************/
/*******************************table turnover summary starts****************************************************************/

		$('#datepickerfromturnoversummary').change(function () {
		$('#ui-datepicker-div').css("display", "none");
		var fromval=$(this).val();
		var tot_to=$('#datepickertoturnoversummary').val();
		var typeval=$('#typeval').val();
$('#byturnoversummary').val("null");
		
		if(tot_to=="")
		{
			tot_to="";
		}
						$.post("load_report.php", {fromdt:fromval,todt:tot_to,type:typeval,set:"ft"},
						function(data)
						{
							  data=$.trim(data);					
							  $('#reportload').html(data);
						});
	});
        $('#datepickertoturnoversummary').change(function () {
		$('#byturnover').val("null");
		$('#ui-datepicker-div').css("display", "none");
		var tot_to=$(this).val();
		var tot_from=$('#datepickerfromturnoversummary').val();
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;
		if(tot_from=="")
		{
			tot_from="";
		}
						$.post("load_report.php", {fromdt:tot_from,todt:tot_to,type:typeval,set:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
	});
                
        $('#byturnoversummary').change(function () {
		var typeval=$('#typeval').val();
		var typeval=typeval.trim();
                $('#datepickerfromturnoversummary').val(""); 
                $('#datepickertoturnoversummary').val("");
		var bydate=$('#byturnoversummary').val();
	
						$.post("load_report.php", {bydate:bydate,type:typeval,abc:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
	});
	/*******************************table turnover summary ends****************************************************************/
	/*****************************Feedbackfromdate  starts*******************************************************************/
		$('#datepickerfromfeedback').change(function () {
		$('#ui-datepicker-div').css("display", "none");
		var fromval=$(this).val();
		var tot_to=$('#datepickertofeedback').val();
		var typeval=$('#typeval').val();
$('#byfeedback').val("null");
		if(tot_to=="")
		{
			tot_to="";
		}	
						$.post("load_report.php", {fromdt:fromval,todt:tot_to,type:typeval,set:"ft"},
						function(data)
						{
							  data=$.trim(data);							  
							  $('#reportload').html(data);
						});

	});
	/*****************************Feedbackfromdate  ends*******************************************************************/

	/*****************************Feedbacktodate  starts*******************************************************************/
	$('#datepickertofeedback').change(function () {
		$('#byfeedback').val("null");
		$('#ui-datepicker-div').css("display", "none");
		var tot_to=$(this).val();
		var tot_from=$('#datepickerfromfeedback').val();
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;
		if(tot_from=="")
		{
			tot_from="";
		}
						$.post("load_report.php", {fromdt:tot_from,todt:tot_to,type:typeval,set:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
	});
	/*****************************Feedbacktodate  ends*******************************************************************/

/***************************feedbackbydate starts*************************************************************************/	
		$('#byfeedback').change(function () {
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;
	  $('#datepickerfromfeedback').val(""); 
	 $('#datepickertofeedback').val("");
		var bydate=$('#byfeedback').val();
						$.post("load_report.php", {bydate:bydate,type:typeval,abc:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
	});
/***************************feedbackbydate ends*************************************************************************/	
/********************************menu rating  starts***********************************************************************/
	
		$('#bymenurating').change(function () {
		var typeval=$('#typeval').val();
		var bydate=$(this).val();
						$.post("load_report.php", {bydate:bydate,type:typeval,abc:"ft"},
						function(data)
						{
							  data=$.trim(data);
				
							  $('#reportload').html(data);
						});
	});
		/********************************menu rating bydt ends***********************************************************************/
	
		/************************foodcosting report starts***************************************************************************/
			$('#byfoodcosting').change(function () {
		var typeval=$('#typeval').val();
		var bymenu=$(this).val();
						$.post("load_report.php", {bymenu:bymenu,type:typeval,abc:"ft"},
						function(data)
						{
							  data=$.trim(data);					 
							  $('#reportload').html(data);
						});
	});
/************************foodcosting report ends***************************************************************************/
//summarydiv  datepickerfromsummary datepickertosummary bydatesummary summary	
	/*******************************************date picker change sales starts**********************************************/
	$('#datepickerfrom').change(function () {
		$('#ui-datepicker-div').css("display", "none");
		var fromval=$(this).val();
		var tot_to=$('#datepickertodt').val();
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;
		var floorz=$('#floorwise').val();
                $('#bydate').val("null");
		var addon=$('#menu_type').val();
		if(tot_to=="")
		{
			tot_to="";
		}
						$.post("load_report.php", {fromdt:fromval,todt:tot_to,type:typeval,floorz:floorz,addon:addon,set:"ft"},
						function(data)
						{
							data=$.trim(data);						
							 $('#reportload').html(data);
						});	
	});
	$('#datepickerfrom').click(function () {
		$('#ui-datepicker-div').css("display", "block");
	});	
	
		$('#bydate').change(function () {
		var fromval=$(this).val();
		var floorz=$('#floorwise').val();
		var tot_to=$('#datepickertodt').val();
		var typeval=$('#typeval').val();
		var addon=$('#menu_type').val();
	  $('#datepickertodt').val(""); 
	 $('#datepickerfrom').val("");
		var bydate=$('#bydate').val();
		if(tot_to=="")
		{
			tot_to="";
		}
						$.post("load_report.php", {bydate:bydate,type:typeval,fromdt:'',todt:'',floorz:floorz,addon:addon,abc:"ft"},
						function(data)
						{
							  data=$.trim(data);					
							  $('#reportload').html(data);
						});
	});
		$('#floorwise').change(function () {
		var floorvalue=$(this).val();
		var bydate=$('#bydate').val();
		var from=$('#datepickerfrom').val();
		var to=$('#datepickertodt').val();
		var typeval=$('#typeval').val();
                var addon=$('#menu_type').val();
		if(floorvalue=="")
		{

		}
						$.post("load_report.php", {floorz:floorvalue,type:typeval,bydate:bydate,fromdt:from,todt:to,addon:addon,flr:"fl"},
						function(data)
						{
							  data=$.trim(data);						
							  $('#reportload').html(data);
						});
	});
	/***********************Floorwise -Total sales timely************************/
	$('#floor_sales').change(function () { 
		var floorvalue=$(this).val();
		var bydate=$('#datepickersalestimely').val();
		var from=$('#timeopen').val();
		var to=$('#timeclose').val();
		var typeval=$('#typeval').val(); 
		if(floorvalue=="")
		{
		}
						$.post("load_report.php", {floorvalue:floorvalue,type:typeval,bydate:bydate,from:from,to:to,flr:"fl"},
						function(data)
						{
							  data=$.trim(data);							
							  $('#reportload').html(data);
						});	  
	});
	
	$('#timeopen').change(function () { 
		$('#ui-datepicker-div').css("display", "none");
		var fromval=$(this).val();
		var tot_to=$('#timeclose').val();
		var typeval=$('#typeval').val();
		var floorz=$('#floor_sales').val();
		var bydate=$('#datepickersalestimely').val();
		if(fromval > tot_to  && tot_to !="")
		{
			alert('Select a valid time range');
		}
		if(tot_to=="")
		{
			tot_to="";
		}
						$.post("load_report.php", {fromdt:fromval,todt:tot_to,type:typeval,floorz:floorz,bydate:bydate,set:"ft"},
						function(data)
						{
							  data=$.trim(data);						
							 $('#reportload').html(data);
						});

	});
	$('#timeclose').change(function () {
		$('#ui-datepicker-div').css("display", "none");
		var bydate=$('#datepickersalestimely').val();
		var tot_to=$(this).val();
		var tot_from=$('#timeopen').val();
		var typeval=$('#typeval').val();
		var floorz=$('#floor_sales').val();
		if(tot_from=="")
		{
			tot_from="";
		}
	  if(tot_from > tot_to  && tot_from !="")
		{
			alert('Select a valid time range');
		}
						$.post("load_report.php", {fromdt:tot_from,todt:tot_to,type:typeval,floorz:floorz,bydate:bydate,set:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
		});
		$('#paybydate').change(function () {
		var fromval=$(this).val();
		var tot_to=$('#datepickertodt').val();
		var typeval=$('#typeval').val();
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
						$.post("load_report.php", {paybydate:paybydate,type:typeval,typepay:typepay,abc:"ft"},
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
	
			$('#stewardbydate').change(function () {
		var fromval=$(this).val();
		var tot_to=$('#datepickertodt').val();
		var typeval=$('#typeval').val();
		var typepay=$('#stewardtp').val();
		var stewardbydate=$('#stewardbydate').val();
		$('#datepickerfromdtstw').val("");
		$('#datepickertodtstw').val("");
                var steward_type=$('#steward_type').val(); 
		if(tot_to=="")
		{ 
			tot_to="";
		}
	if(typepay !="")
	{
						$.post("load_report.php", {stewardbydate:stewardbydate,type:typeval,stwrd:typepay,abc:"ft",steward_type:steward_type},
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
			  var reprtstatus12304=$('#rptstatus');
		  reprtstatus12304.text('Pls select steward');	
		$("#rptstatus").delay(1000).fadeOut('slow');
	}
	});
        //steward performance start

		$('#stewardperfobydate').change(function () {
		var fromval=$(this).val();
		var tot_to=$('#datepickertodt').val();
		var typeval=$('#typeval').val();
		var typepay=$('#stewardperfo').val();
		var stewardbydate=$('#stewardperfobydate').val();
		$('#datepickerfromdtstwprf').val("");
		$('#datepickertodtstwprf').val("");
		if(tot_to=="")
		{
			tot_to="";
		}
	if(typepay !="")
	{
						$.post("load_report.php", {stewardbydate:stewardbydate,type:typeval,stwrd:typepay,abc:"ft"},
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
			  var reprtstatus12304=$('#rptstatus');
		  reprtstatus12304.text('Pls select steward');	
		$("#rptstatus").delay(1000).fadeOut('slow');
	}	
		
	});
        //steward performance end
		$('#orderbydate').change(function () {
		var fromval=$(this).val();
		var tot_to=$('#datepickertodt').val();
		var typeval=$('#typeval').val();
		var orderbydate=$('#orderbydate').val();
		$('#datepickerfromord').val("");
		$('#datepickertodtord').val("");
		
		if(tot_to=="")
		{
			tot_to="";
		}
						$.post("load_report.php", {orderbydate:orderbydate,type:typeval,abc:"ft"},
						function(data)
						{
							  data=$.trim(data);
							 $('#reportload').html(data);
						});
	});
	//-----------------kitchen wise
        $('#kitchenorderbydate').change(function () {
		var fromval=$(this).val();
		var tot_to=$('#datepickertodtktc').val();
		var typeval=$('#typeval').val();
		var flr=$('#kitchen').val();
		var orderbydate=$('#kitchenorderbydate').val();
        var item = $('#item').val();
		$('#datepickerfromktc').val("");
		$('#datepickertodtktc').val("");
		if(tot_to=="")
		{
			tot_to="";
		}
						$.post("load_report.php", {orderbydate:orderbydate,type:typeval,floorval:flr,item:item,abc:"ft"},
						function(data)
						{
							 data=$.trim(data);
							 $('#reportload').html(data);
						});
	});
        //-----------------------
	$('#portionbydate').change(function () {
		var fromval=$(this).val();
		var tot_to=$('#datepickertodt').val();
		var typeval=$('#typeval').val();
		var portn=$('#portiontp').val();
		var portionbydate=$('#portionbydate').val();
		$('#datepickerfromdtprtn').val("");		
				$('#datepickertodtprtn').val("");		
		if(tot_to=="")
		{
			tot_to="";
		}
						$.post("load_report.php", {portionbydate:portionbydate,type:typeval,portn:portn,abc:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});	
	});
		$('#ordertyp').change(function () {
		var fromval=$(this).val();
		var tot_to=$('#datepickertodt').val();
		var typeval=$('#typeval').val();
		var ordtype=$('#ordertyp').val();
		var ordertypebydate=$('#ordertypebydate').val();
		$('#datepickerfromdttpord').val("");
		$('#datepickertodttpord').val("");
		if(tot_to=="")
		{
			tot_to="";
		}
	var a;
	if(ordertypebydate ==null)
	{
	 a=1;
	}
	else
	{
		a=0;
	}
						$.post("load_report.php", {ordertypebydate:ordertypebydate,type:typeval,ordtype:ordtype,typeord:"aa"},
						function(data)
						{
							  data=$.trim(data);						
							  $('#reportload').html(data);
						});	
	});
	$('#ordertypebydate').change(function () {
		var fromval=$(this).val();
		var tot_to=$('#datepickertodt').val();
		var typeval=$('#typeval').val();
		var ordtype=$('#ordertyp').val();
		var ordertypebydate=$('#ordertypebydate').val();
		$('#datepickerfromdttpord').val("");
		$('#datepickertodttpord').val("");
		if(tot_to=="")
		{
			tot_to="";
		}
	var a;
	if(ordertypebydate ==null)
	{
	 a=1;
	}
	else
	{
		a=0;
	}
						$.post("load_report.php", {ordertypebydate:ordertypebydate,type:typeval,ordtype:ordtype,abc:a},
						function(data)
						{
							  data=$.trim(data);
						
							  $('#reportload').html(data);
						});
	});
	
	$('#datepickertodt').click(function () {
		$('#ui-datepicker-div').css("display", "block");
	});	
	
	$('#datepickertodt').change(function () {
		$('#bydate').val("null");
		$('#ui-datepicker-div').css("display", "none");
		var tot_to=$(this).val();
		var tot_from=$('#datepickerfrom').val();
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;
		var floorz=$('#floorwise').val();
                var addon=$('#menu_type').val();
		if(tot_from=="")
		{
			tot_from="";
		}
		$.post("load_report.php", {fromdt:tot_from,todt:tot_to,type:typeval,floorz:floorz,addon:addon,set:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
	});
	/*****************************************date picker change sales ends**************************************************/
	/*******************************************type of payment starts**********************************************/
	$('#typepay').change(function () {
		var typeofpay=$(this).val();
		var typeval=$('#typeval').val(); 
		
		var paybydate=$('#paybydate').val(); 
		
		var tot_from=$('#datepickerfromtyp').val();
		var tot_to=$('#datepickertodttyp').val();
	if(typeofpay !="null" && paybydate =="null" )
		{
						$.post("load_report.php", {fromdt:tot_from,todt:tot_to,typepay:typeofpay,type:typeval,set:"ft"},
						function(data)
						{
							  data=$.trim(data);							
							  $('#reportload').html(data);
						});
		}
		
		
		else if(typeofpay !="null" && paybydate !="null" )
		{
						$.post("load_report.php", {fromdt:tot_from,todt:tot_to,typepay:typeofpay,type:typeval,paybydate:paybydate,pay:"aft"},
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
		var typeval=$('#typeval').val();
		$('#paybydate').val("null");
		if(tot_to=="")
		{
			tot_to="";
		}
		if(typeofpay !="null")
		{
						$.post("load_report.php", {fromdt:tot_from,todt:tot_to,typepay:typeofpay,type:typeval,set:"ft"},
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
		var typeval=$('#typeval').val();
		$('#paybydate').val("null");
		if(typeofpay !="null")
		{
		if(tot_from=="")
		{
			tot_from="";
		}
						$.post("load_report.php", {fromdt:tot_from,todt:tot_to,typepay:typeofpay,type:typeval,set:"ft"},
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
	
	/*****************************************type of payment ends**************************************************************/
	/*******************************************Item starts**********************************************/
	$('#floorsel').change(function () {
           var mode=$('#mode_sec').val();
            var condition=$('#condition_type').val();
		var floorval=$(this).val();
		var typeval=$('#typeval').val(); 
  
		$.post("load_report.php", {floorvals:floorval,type:typeval,condition:condition,mode:mode},
			  function(data)
			  {
					data=$.trim(data);
					$('#reportload').html(data);
			  });
	});

        $('#mode_sec').change(function () {
           var mode=$('#mode_sec').val();
            var condition=$('#condition_type').val();
		var floorval=$('#floorsel').val();
		var typeval=$('#typeval').val();   
                if(mode=='DI'){
                    $('#itemselectdiv').show();
                }else{
                    $('#itemselectdiv').hide(); 
                }

		$.post("load_report.php", {floorvals:floorval,type:typeval,condition:condition,mode:mode},
			  function(data)
			  {
					data=$.trim(data);
					$('#reportload').html(data);
			  });
	});
	
	/*****************************************Item ends**************************************************************/
	
	/*****************************************Steward_timely starts**************************************************************/
	$('#stewardtimely').change(function () {
		var stwrdid=$(this).val();
		var typeval=$('#typeval').val(); 
		var tot_from=$('#stewardtimeopen').val();
		var tot_to=$('#stewardtimeclose').val();
		var stewardbydate=$('#stewardbydatetimely').val();
		
						$.post("load_report.php", {fromdt:tot_from,todt:tot_to,stwrd:stwrdid,type:typeval,stewardbydate:stewardbydate,stwr:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
	});
	
	$('#stewardtimeopen').change(function () {
		$('#ui-datepicker-div').css("display", "none");
		var tot_from=$(this).val();
		var tot_to=$('#stewardtimeclose').val();
		var stwrdid=$('#stewardtimely').val();
		var typeval=$('#typeval').val();
		var stewardbydate=$('#stewardbydatetimely ').val();
		if(tot_to=="")
		{
			tot_to="";
		}
						$.post("load_report.php", {fromdt:tot_from,todt:tot_to,stwrd:stwrdid,stewardbydate:stewardbydate,type:typeval,set:"st"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
	});
	$('#stewardtimeclose').change(function () {
		
		var tot_to=$(this).val();
		var tot_from=$('#stewardtimeopen').val();
		var stwrdid=$('#stewardtimely').val();
		var typeval=$('#typeval').val();
			var stewardbydate=$('#stewardbydatetimely ').val();
		if(tot_from=="")
		{
			tot_from="";
		}
						$.post("load_report.php", {fromdt:tot_from,todt:tot_to,stwrd:stwrdid,stewardbydate:stewardbydate,type:typeval,set:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
	});
	
	 /*******************************************Steward starts**********************************************/
		//stewardtp datepickerfromdtstw datepickertodtstw
        $('#steward_type').change(function () {
             var steward_type=$('#steward_type').val(); 
            if(steward_type=='Detailed'){
                $('#steward_mode').hide();
            }else{
                  $('#steward_mode').show();
            }
            var stw_mode=$('#stw_mode').val();
		var stwrdid=$('#stewardtp').val();
		var typeval=$('#typeval').val(); 
		var tot_from=$('#datepickerfromdtstw').val();
		var tot_to=$('#datepickertodtstw').val();
		var stewardbydate=$('#stewardbydate').val();       
		if(stwrdid !="null" && stewardbydate=="null" && tot_from=="" && tot_to=="")
		{
						$.post("load_report.php", {fromdt:tot_from,todt:tot_to,stwrd:stwrdid,type:typeval,steward_type:steward_type,stw_mode:stw_mode,set:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
		}
		
		else if(stwrdid !="null" && stewardbydate !="null" )
		{
			$.post("load_report.php", {fromdt:tot_from,todt:tot_to,stwrd:stwrdid,type:typeval,stewardbydate:stewardbydate,steward_type:steward_type,stw_mode:stw_mode,stwr:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});	
		}
		else if(stwrdid !="null" && stewardbydate=="null" && tot_from !=" ")
		{			
						$.post("load_report.php", {fromdt:tot_from,todt:tot_to,stwrd:stwrdid,type:typeval,steward_type:steward_type,stw_mode:stw_mode},
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
			  var rptstatus220=$('#rptstatus');
		  rptstatus220.text('Pls select steward');	
		$("#rptstatus").delay(1000).fadeOut('slow');
			
		}
	});

        $('#stw_mode').change(function () {
		var stwrdid=$('#stewardtp').val();
		var typeval=$('#typeval').val(); 
		var tot_from=$('#datepickerfromdtstw').val();
		var tot_to=$('#datepickertodtstw').val();
		var stewardbydate=$('#stewardbydate').val();
                 var stw_mode=$('#stw_mode').val();
                var steward_type=$('#steward_type').val();
		if(stwrdid !="null" && stewardbydate=="null" && tot_from=="" && tot_to=="")
		{
	
						$.post("load_report.php", {fromdt:tot_from,todt:tot_to,stwrd:stwrdid,type:typeval,steward_type:steward_type,stw_mode:stw_mode,set:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
		}
		
		else if(stwrdid !="null" && stewardbydate !="null" )
		{
						$.post("load_report.php", {fromdt:tot_from,todt:tot_to,stwrd:stwrdid,type:typeval,stewardbydate:stewardbydate,steward_type:steward_type,stw_mode:stw_mode,stwr:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});	
		}
		else if(stwrdid !="null" && stewardbydate=="null" && tot_from !=" ")
		{
						$.post("load_report.php", {fromdt:tot_from,todt:tot_to,stwrd:stwrdid,type:typeval,steward_type:steward_type,stw_mode:stw_mode},
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
			  var rptstatus220=$('#rptstatus');
		  rptstatus220.text('Pls select steward');	
		$("#rptstatus").delay(1000).fadeOut('slow');
	}
	});
	$('#stewardtp').change(function () {
		var stwrdid=$(this).val();
		var typeval=$('#typeval').val(); 
		var tot_from=$('#datepickerfromdtstw').val();
		var tot_to=$('#datepickertodtstw').val();
		var stewardbydate=$('#stewardbydate').val();
                
                 var stw_mode=$('#stw_mode').val();
                var steward_type=$('#steward_type').val();
                
		if(stwrdid !="null" && stewardbydate=="null" && tot_from=="" && tot_to=="")
		{
						$.post("load_report.php", {fromdt:tot_from,todt:tot_to,stwrd:stwrdid,type:typeval,steward_type:steward_type,stw_mode:stw_mode,set:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
		}
		
		else if(stwrdid !="null" && stewardbydate !="null" )
		{			
						$.post("load_report.php", {fromdt:tot_from,todt:tot_to,stwrd:stwrdid,type:typeval,stewardbydate:stewardbydate,steward_type:steward_type,stw_mode:stw_mode,stwr:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
		}
		else if(stwrdid !="null" && stewardbydate=="null" && tot_from !=" ")
		{
						$.post("load_report.php", {fromdt:tot_from,todt:tot_to,stwrd:stwrdid,type:typeval,steward_type:steward_type,stw_mode:stw_mode},
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
			  var rptstatus220=$('#rptstatus');
		  rptstatus220.text('Pls select steward');	
		$("#rptstatus").delay(1000).fadeOut('slow');
		}
	});
	$('#datepickerfromdtstw').change(function () {
		$('#ui-datepicker-div').css("display", "none");
		var tot_from=$(this).val();
		var tot_to=$('#datepickertodtstw').val();
		var stwrdid=$('#stewardtp').val();
		var typeval=$('#typeval').val();
		$('#stewardbydate').val("null");
                  var steward_type=$('#steward_type').val(); 
		if(tot_to=="")
		{
			tot_to="";
		}
						$.post("load_report.php", {fromdt:tot_from,todt:tot_to,stwrd:stwrdid,type:typeval,steward_type:steward_type},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
	});
	$('#datepickerfromdtstw').click(function () {
		$('#ui-datepicker-div').css("display", "block");
	});	
	
	$('#datepickertodtstw').click(function () {
		$('#ui-datepicker-div').css("display", "block");
	});	
	
	$('#datepickertodtstw').change(function () {
		
		$('#ui-datepicker-div').css("display", "none");
		var tot_to=$(this).val();
		var tot_from=$('#datepickerfromdtstw').val();
		var stwrdid=$('#stewardtp').val();
		var typeval=$('#typeval').val();
		$('#stewardbydate').val("null");
		var steward_type=$('#steward_type').val(); 
	
		if(tot_from=="")
		{
			tot_from="";
		}
						$.post("load_report.php", {fromdt:tot_from,todt:tot_to,stwrd:stwrdid,type:typeval,steward_type:steward_type},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
	});
	 /*****************************************Steward ends**************************************************************/
	 /*******************************************Steward performance starts**********************************************/
		//stewardtp datepickerfromdtstw datepickertodtstw
	
	$('#stewardperfo').change(function () {
		
		var stwrdid=$(this).val();
		var typeval=$('#typeval').val(); 
		var tot_from=$('#datepickerfromdtstwprf').val();
		var tot_to=$('#datepickertodtstwprf').val();
		var stewardbydate=$('#stewardperfobydate').val();
		if(stwrdid !="null" || stwrdid!='' )
		{
						$.post("load_report.php", {fromdt:tot_from,todt:tot_to,stwrd:stwrdid,type:typeval,stewardbydate:stewardbydate,set:"ft"},
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
			  var rptstatus220=$('#rptstatus');
		  rptstatus220.text('Pls select steward');	
		$("#rptstatus").delay(1000).fadeOut('slow');		
		}
	});

	$('#datepickerfromdtstwprf').change(function () {
		$('#ui-datepicker-div').css("display", "none");
		var tot_from=$(this).val();
		var tot_to=$('#datepickertodtstwprf').val();
		var stwrdid=$('#stewardperfo').val();
		var typeval=$('#typeval').val();
		$('#stewardperfobydate').val("null");
		if(tot_to=="")
		{
			tot_to="";
		}	
						$.post("load_report.php", {fromdt:tot_from,todt:tot_to,stwrd:stwrdid,type:typeval,set:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
	});
	$('#datepickerfromdtstwprf').click(function () {
		$('#ui-datepicker-div').css("display", "block");
	});	
	$('#datepickertodtstwprf').click(function () {
		$('#ui-datepicker-div').css("display", "block");
	});	
	
	$('#datepickertodtstwprf').change(function () {
		
		$('#ui-datepicker-div').css("display", "none");
		var tot_to=$(this).val();
		var tot_from=$('#datepickerfromdtstwprf').val();
		var stwrdid=$('#stewardperfo').val();
		var typeval=$('#typeval').val();
		$('#stewardperfobydate').val("null");
		if(tot_from=="")
		{
			tot_from="";
		}
						$.post("load_report.php", {fromdt:tot_from,todt:tot_to,stwrd:stwrdid,type:typeval,set:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
	});
	 /*****************************************Steward performance ends**************************************************************/

        /*******************************************kitchen wise starts**********************************************/
//// datepickerfromktc datepickerfromord
	
	$('#datepickerfromktc').change(function () {
	
		$('#kitchenorderbydate').val("null");
		$('#ui-datepicker-div').css("display", "none");
		var fromval=$(this).val();
                
                var item = $('#item').val();
		var tot_to=$('#datepickertodtktc').val();
		
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;
		var floorval=$('#kitchen').val();
		if(tot_to=="")
		{
			tot_to="";
		}

						$.post("load_report.php", {fromdt:fromval,todt:tot_to,type:typeval,floorval:floorval,item:item,set:"ft"},
						function(data)
						{
							  data=$.trim(data);						
							  $('#reportload').html(data);
						});

	});
	
	$('#datepickertodtktc').change(function () {
		$('#ui-datepicker-div').css("display", "none");
			$('#kitchenorderbydate').val("null");
		var tot_to=$(this).val();
                
                var item = $('#item').val();
		var tot_from=$('#datepickerfromktc').val();
		var typeval=$('#typeval').val();
		var floorval=$('#kitchen').val();
		if(tot_from=="")
		{
			tot_from="";
		}
						$.post("load_report.php", {fromdt:tot_from,todt:tot_to,type:typeval,floorval:floorval,item:item,set:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
	});
	
        $('#kitchen').change(function () {
		var floorval=$(this).val();
                if(floorval!=""){
                    $('#menuitem').css("display", "block");
                }else{
                    $('#menuitem').css("display", "none");
                }
		var bydt=$('#kitchenorderbydate').val();
		var from=$('#datepickerfromktc').val();
		var to=$('#datepickertodtktc').val();
		var item = $('#item').val();
                var flrval="";
		var typeval=$('#typeval').val(); 
		if(floorval=="")
		{
			
		}
						$.post("load_report.php", {floorval:floorval,item:item,type:typeval,bydt:bydt,from:from,to:to,flr:"ktc"},
						function(data)
						{                   
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
	});
        
        $('#item').change(function () {        
		var item=$(this).val();
                var floorval=$('#kitchen').val();
		var bydt=$('#kitchenorderbydate').val();
		var from=$('#datepickerfromktc').val();
		var to=$('#datepickertodtktc').val();
                var flrval="";
		var typeval=$('#typeval').val(); 
		if(floorval=="")
		{
			//flrval=
		}
						$.post("load_report.php", {floorval:floorval,item:item,type:typeval,bydt:bydt,from:from,to:to,flr:"ktc"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
	});
	/*****************************************Item Orderd ends**************************************************************/
	
		/*****************************************Item Orderd-Timely starts**************************************************************/
		
		$('#time').change(function () {
		var entrydate=$('#datepickeritemtimely').val();
		var timeval=$(this).val();
		var time_new=$('#time2').val();
		var typeval=$('#typeval').val();
		var floorval=$('#floortimely').val();
		if(timeval >time_new &&  time_new!="")
		{
			alert('Select a valid time');
		}	
						$.post("load_report.php", {timeval:timeval,time_new:time_new,type:typeval,floorval:floorval,entrydate:entrydate,set:"ft"},
						function(data)
						{
							  data=$.trim(data);					
							  $('#reportload').html(data);
						});	
		});
		$('#floortimely').change(function () {
		var floorval=$(this).val();
		var from=$('#datepickeritemtimely').val();
		var time=$('#time').val();
		var time2=$('#time2').val();
		var typeval=$('#typeval').val(); 
		
						$.post("load_report.php", {floorval:floorval,type:typeval,from:from,time:time,time2:time2,flr:"fl"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
		});

			/*****************************************Item Orderd-Timely ends**************************************************************/
		/*****************************************Portion orderd starts**************************************************************/
	
	$('#datepickerfromdtprtn').change(function () {
		$('#ui-datepicker-div').css("display", "none");
		var fromval=$(this).val();
		var tot_to=$('#datepickertodtprtn').val();
			var typeval=$('#typeval').val();
		var portion=$('#portiontp').val();
		$('#portionbydate').find('option:first').attr('selected', 'selected');
		if(tot_to=="")
		{
			tot_to="";
		}
						$.post("load_report.php", {fromdt:fromval,todt:tot_to,type:typeval,portn:portion,set:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
	});
	$('#datepickerfromdtprtn').click(function () {
		$('#ui-datepicker-div').css("display", "block");
	});	
	
	$('#datepickertodtprtn').click(function () {
		$('#ui-datepicker-div').css("display", "block");
	});	
	
	$('#datepickertodtprtn').change(function () {
		
		$('#ui-datepicker-div').css("display", "none");
		var tot_to=$(this).val();
		var tot_from=$('#datepickerfromdtprtn').val();
		var typeval=$('#typeval').val();
		var portion=$('#portiontp').val();
		$('#portionbydate').find('option:first').attr('selected', 'selected');
		if(tot_from=="")
		{
			tot_from="";
		}

						$.post("load_report.php", {fromdt:tot_from,todt:tot_to,type:typeval,portn:portion,set:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
	});
	
	
		$('#portiontp').change(function () {
		
		var portnid=$(this).val();
		var typeval=$('#typeval').val(); 
		var tot_from=$('#datepickerfromdtprtn').val();
		var tot_to=$('#datepickertodtprtn').val();
    	var	portionbydate=$('#portionbydate').val();
		if ($('#portionbydate :selected').text()=="--Select--")
		{
						$.post("load_report.php", {fromdt:tot_from,todt:tot_to,portn:portnid,type:typeval,set:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
		}
		
		else 
		{
						$.post("load_report.php", {fromdt:tot_from,todt:tot_to,portn:portnid,type:typeval,portionbydate:portionbydate,port:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
		}
	});

	/*****************************************Portion orderd ends**************************************************************/
	/*******************************************Type of order starts**********************************************/
////   datepickerfromdttpord datepickertodttpord  ordertyp
	
	$('#datepickerfromdttpord').change(function () {
		$('#ui-datepicker-div').css("display", "none");
		var fromval=$(this).val();
		var tot_to=$('#datepickertodttpord').val();
		var typeval=$('#typeval').val();
		var ordtype=$('#ordertyp').val();
$('#ordertypebydate').find('option:first').attr('selected', 'selected');
		if(tot_to=="")
		{
			tot_to="";
		}
						$.post("load_report.php", {fromdt:fromval,todt:tot_to,type:typeval,ordtype:ordtype},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});	  
	});
	$('#datepickerfromdttpord').click(function () {
		$('#ui-datepicker-div').css("display", "block");
	});	

	$('#datepickertodttpord').click(function () {
		$('#ui-datepicker-div').css("display", "block");
	});	
	
	$('#datepickertodttpord').change(function () {
		
		$('#ui-datepicker-div').css("display", "none");
		
		var tot_to=$(this).val();
		var tot_from=$('#datepickerfromdttpord').val();
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;
		var ordtype=$('#ordertyp').val();		
			$('#ordertypebydate').find('option:first').attr('selected', 'selected');
		if(tot_from=="")
		{
			tot_from="";
		}
						$.post("load_report.php", {fromdt:tot_from,todt:tot_to,type:typeval,ordtype:ordtype},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});	
	});
	/*****************************************Type of order ends**************************************************************/
//datepickerfromcancel datepickertodtcancel orderbydatecancel

	/*******************************************Cancel starts**********************************************/
$('#datepickerfromcancel').change(function () {
	
		$('#ui-datepicker-div').css("display", "none");
		var fromval=$(this).val();
		var tot_to=$('#datepickertodtcancel').val();
		var typeval=$('#typeval').val();
		$('#orderbydatecancel').find('option:first').attr('selected', 'selected');
		if(tot_to=="")
		{
			tot_to="";
		}
						$.post("load_report.php", {fromdt:fromval,todt:tot_to,type:typeval,set:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});	  
	});
	$('#datepickerfromcancel').click(function () {
		$('#ui-datepicker-div').css("display", "block");
	});	
	
	$('#datepickertodtcancel').click(function () {
		$('#ui-datepicker-div').css("display", "block");
	});	
	
	$('#datepickertodtcancel').change(function () {
		
		$('#ui-datepicker-div').css("display", "none");
		
		var tot_to=$(this).val();
		var tot_from=$('#datepickerfromcancel').val();
		var typeval=$('#typeval').val();
		$('#orderbydatecancel').find('option:first').attr('selected', 'selected');
		if(tot_from=="")
		{
			tot_from="";
		}
						$.post("load_report.php", {fromdt:tot_from,todt:tot_to,type:typeval,set:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});	
	});
	
	$('#orderbydatecancel').change(function () {
		var typeval=$('#typeval').val();
		$('#datepickerfromcancel').val('');
		$('#datepickertodtcancel').val('');
		var tp=$(this).val();
						$.post("load_report.php", {bydate:tp,type:typeval,abc:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});  
	});
	/*****************************************Cancel ends**************************************************************/
	/*****************************************Bill Cancel starts**************************************************************/
	$('#datepickerfrom_cl').change(function () {
		$('#ui-datepicker-div').css("display", "none");
		var fromval=$(this).val();
		var tot_to=$('#datepickertodt_cl').val();
		var typeval=$('#typeval').val();
		
$('#bydate_cl').val("null");
		
		if(tot_to=="")
		{
			tot_to="";
		}

						$.post("load_report.php", {fromdt:fromval,todt:tot_to,type:typeval,bydate:'',set:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
	});
	$('#datepickerfrom_cl').click(function () {
		$('#ui-datepicker-div').css("display", "block");
	});	
	$('#datepickertodt_cl').click(function () {
		$('#ui-datepicker-div').css("display", "block");
	});	
	
	$('#datepickertodt_cl').change(function () {
		$('#bydate_cl').val("null");
		$('#ui-datepicker-div').css("display", "none");
		var tot_to=$(this).val();
		var tot_from=$('#datepickerfrom_cl').val();
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;
		if(tot_from=="")
		{
			tot_from="";
		}
						$.post("load_report.php", {fromdt:tot_from,todt:tot_to,type:typeval,set:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
	});
	
	
	$('#bydate_cl').change(function () {
		var fromval=$(this).val();
		
		var tot_to=$('#datepickertodt_cl').val();
		var typeval=$('#typeval').val();
	  $('#datepickertodt_cl').val(""); 
	 $('#datepickerfrom_cl').val("");
		var bydate=$('#bydate_cl').val();
		
		if(tot_to=="")
		{
			tot_to="";
		}
						$.post("load_report.php", {bydate:bydate,type:typeval,fromdt:'',todt:'',abc:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
	});
	
	/*****************************************Bill Cancel ends**************************************************************/
	
	/*******************************************Discount starts**********************************************/
	// discountsalesdiv  datepickerfromdisc  datepickertodtdisc bydatedisc 
$('#datepickerfromdisc').change(function () {
		$('#ui-datepicker-div').css("display", "none");
		var fromval=$(this).val();
		var tot_to=$('#datepickertodtdisc').val();
		var typeval=$('#typeval').val();
		$('#bydatedisc').find('option:first').attr('selected', 'selected');
		if(tot_to=="")
		{
			tot_to="";
		}

						$.post("load_report.php", {fromdt:fromval,todt:tot_to,type:typeval,set:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});  
	});
	$('#datepickerfromdisc').click(function () {
		$('#ui-datepicker-div').css("display", "block");
	});	
	$('#datepickertodtdisc').click(function () {
		$('#ui-datepicker-div').css("display", "block");
	});	
	$('#datepickertodtdisc').change(function () {
		$('#ui-datepicker-div').css("display", "none");
		var tot_to=$(this).val();
		var tot_from=$('#datepickerfromdisc').val();
		var typeval=$('#typeval').val();
		$('#bydatedisc').find('option:first').attr('selected', 'selected');
		if(tot_from=="")
		{
			tot_from="";
		}
						$.post("load_report.php", {fromdt:tot_from,todt:tot_to,type:typeval,set:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});	
	});
	
	$('#bydatedisc').change(function () {
		var typeval=$('#typeval').val();
		$('#datepickerfromdisc').val('');
		$('#datepickertodtdisc').val('');
		var tp=$(this).val();

						$.post("load_report.php", {bydate:tp,type:typeval,abc:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
		  
	});
	/*****************************************discount ends**************************************************************/
	
        /*******************************************Turnover starts**********************************************/
	// discountsalesdiv  datepickerfromdisc  datepickertodtdisc bydatedisc 
$('#datepickerfromturn').change(function () {
	
		$('#ui-datepicker-div').css("display", "none");
		var fromval=$(this).val();
                
                var tot_to=$('#datepickertodtturn').val();
		var typeval=$('#typeval').val();
		$('#bydateturn').find('option:first').attr('selected', 'selected');
		if(tot_to=="")
		{
			tot_to="";
		}
		
						$.post("load_report.php", {fromdt:fromval,todt:tot_to,type:typeval,set:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
				  
	});
	$('#datepickerfromturn').click(function () {
		$('#ui-datepicker-div').css("display", "block");
	});	
	
	
	
	$('#datepickertodtturn').click(function () {
		$('#ui-datepicker-div').css("display", "block");
	});	
	
	$('#datepickertodtturn').change(function () {
		
		$('#ui-datepicker-div').css("display", "none");
		
		var tot_to=$(this).val();
		var tot_from=$('#datepickerfromturn').val();
               
		var typeval=$('#typeval').val();
		$('#bydateturn').find('option:first').attr('selected', 'selected');
		if(tot_from=="")
		{
			tot_from="";
		}
						$.post("load_report.php", {fromdt:tot_from,todt:tot_to,type:typeval,set:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});	
	});
	
	$('#bydateturn').change(function () {
	
		var typeval=$('#typeval').val();
		$('#datepickerfromturn').val('');
		$('#datepickertodtturn').val('');
               
		var tp=$(this).val();
		
						$.post("load_report.php", {bydate:tp,type:typeval,abc:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
	  
	});
        
        
       
        

        
	/*****************************************turnover ends**************************************************************/
        
	/*******************************************KOT starts**********************************************/
	// kot_report kotsalesdiv datepickerfromkot datepickertodtkot bydatekot
$('#datepickerfromkot').change(function () {
	
		$('#ui-datepicker-div').css("display", "none");
		var fromval=$(this).val();
		var tot_to=$('#datepickertodtkot').val();
		var typeval=$('#typeval').val();
		$('#bydatekot').find('option:first').attr('selected', 'selected');
		if(tot_to=="")
		{
			tot_to="";
		}

						$.post("load_report.php", {fromdt:fromval,todt:tot_to,type:typeval,set:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});	  
	});
	$('#datepickerfromkot').click(function () {
		$('#ui-datepicker-div').css("display", "block");
	});	
	
	
	
	$('#datepickertodtkot').click(function () {
		$('#ui-datepicker-div').css("display", "block");
	});	
	
	$('#datepickertodtkot').change(function () {
		
		$('#ui-datepicker-div').css("display", "none");
		
		var tot_to=$(this).val();
		var tot_from=$('#datepickerfromkot').val();
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;
		//var ordtype=$('#ordertyp').val();
			//$('#ordertypebydate').val("null");
		//	$('#ordertypebydate').find('option:first').attr('selected', 'selected');
		$('#bydatekot').find('option:first').attr('selected', 'selected');
		if(tot_from=="")
		{
			tot_from="";
		}

						$.post("load_report.php", {fromdt:tot_from,todt:tot_to,type:typeval,set:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});  
		
	});
	
	$('#bydatekot').change(function () {

		var typeval=$('#typeval').val();
		$('#datepickerfromkot').val('');
		$('#datepickertodtkot').val('');
		var tp=$(this).val();
		

						$.post("load_report.php", {bydate:tp,type:typeval,abc:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
	  
	});
	/*****************************************KOT ends**************************************************************/
	
	//billreportdiv datepickerfrombill datepickertobill bydatebillreport bill_details
	
	/*******************************************Bill Details starts**********************************************/
	// kot_report kotsalesdiv datepickerfromkot datepickertodtkot bydatekot
$('#datepickerfrombill').change(function () {
		$('#ui-datepicker-div').css("display", "none");
		var fromval=$(this).val();
                var sortby=$('#bill_sort').val();
		var tot_to=$('#datepickertobill').val();
		var typeval=$('#typeval').val();
		$('#bydatekot').find('option:first').attr('selected', 'selected');
		if(tot_to=="")
		{
			tot_to="";
		}
		
						$.post("load_report.php", {fromdt:fromval,bydate:'',sortby:sortby,todt:tot_to,type:typeval,set:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
  
	});

$('#bill_sort').change(function () {
		$('#ui-datepicker-div').css("display", "none");
                var sortby=$(this).val();
		var fromval=$('#datepickerfrombill').val();
		var tot_to=$('#datepickertobill').val();
		var typeval=$('#typeval').val();
		$('#bydatekot').find('option:first').attr('selected', 'selected');
		if(tot_to=="")
		{
			tot_to="";
		}
		var bydate=$('#bydatebillreport').val();
						$.post("load_report.php", {fromdt:fromval,todt:tot_to,bydate:bydate,type:typeval,sortby:sortby,set:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
  
	});
        
        
        
	$('#datepickerfrombill').click(function () {
		$('#ui-datepicker-div').css("display", "block");
	});	
	
	
	
	$('#datepickertobill').click(function () {
		$('#ui-datepicker-div').css("display", "block");
	});	
	
	$('#datepickertobill').change(function () {
		
		$('#ui-datepicker-div').css("display", "none");
		
		var tot_to=$(this).val();
                var sortby=$('#bill_sort').val();
		var tot_from=$('#datepickerfrombill').val();
		var typeval=$('#typeval').val();
		$('#bydatekot').find('option:first').attr('selected', 'selected');
		if(tot_from=="")
		{
			tot_from="";
		}
						$.post("load_report.php", {fromdt:tot_from,sortby:sortby,bydate:'',todt:tot_to,type:typeval,set:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
	});
	
	$('#bydatebillreport').change(function () {
	
		var typeval=$('#typeval').val();
		$('#datepickerfrombill').val('');
		$('#datepickertobill').val('');
		var tp=$(this).val();
		var sortby=$('#bill_sort').val();
						$.post("load_report.php", {fromval:'',toval:'',bydate:tp,sortby:sortby,type:typeval,abc:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});	  
	});
	/*****************************************Bill Details ends**************************************************************/

	/*******************************************Summary starts**********************************************/
	//summarydiv  datepickerfromsummary datepickertosummary bydatesummary summary	
$('#datepickerfromsummary').change(function () {
	
		$('#ui-datepicker-div').css("display", "none");
                $('#bydatesummary').val('null');
		var fromval=$(this).val();
		var tot_to=$('#datepickertosummary').val();
		var typeval=$('#typeval').val();
		$('#bydatekot').find('option:first').attr('selected', 'selected');
		if(tot_to=="")
		{
			tot_to="";
		}
						$.post("load_report.php", {fromdt:fromval,todt:tot_to,bydate:'',type:typeval,set:"ft"},
						function(data)
						{
							  data=$.trim(data);						
							$('#reportload').html(data);
						});
		  
	});
	$('#datepickerfromsummary').click(function () {
		$('#ui-datepicker-div').css("display", "block");
	});	
	
	
	
	$('#datepickertosummary').click(function () {
		$('#ui-datepicker-div').css("display", "block");
	});	
	
	$('#datepickertosummary').change(function () {
		
		$('#ui-datepicker-div').css("display", "none");
		$('#bydatesummary').val('null');
		var tot_to=$(this).val();
		var tot_from=$('#datepickerfromsummary').val();
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;
		
		$('#bydatekot').find('option:first').attr('selected', 'selected');
		if(tot_from=="")
		{
			tot_from="";
		}
						$.post("load_report.php", {fromdt:tot_from,todt:tot_to,bydate:'',type:typeval,set:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
	});
	
	$('#bydatesummary').change(function () {
		
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;
                $('#datepickerfromsummary').val('');
		$('#datepickertosummary').val('');
		var tp=$(this).val();
	
						$.post("load_report.php", {bydate:tp,type:typeval,abc:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
  
	});
	/*****************************************Summary ends**************************************************************/
       
               /*******************************************Category wise starts**********************************************/
		
$('#datepickerfromcategory_wise').change(function () {
	
		$('#ui-datepicker-div').css("display", "none");
		var fromval=$(this).val();
		var tot_to=$('#datepickertocategory_wise').val();
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;
                var floorz=$('#floorwisecategorywise').val();
              
		$('#bydatecategorywise').find('option:first').attr('selected', 'selected');
		if(tot_to=="")
		{
			tot_to="";
		}

						$.post("load_report.php", {fromdt:fromval,todt:tot_to,type:typeval,floorz:floorz,set:"ft"},
						function(data)
						{
							  data=$.trim(data);
						
							$('#reportload').html(data);
						});
			  
	});
	$('#datepickerfromcategory_wise').click(function () {
		$('#ui-datepicker-div').css("display", "block");
	});	
	
	
	
	$('#datepickertocategory_wise').click(function () {
		$('#ui-datepicker-div').css("display", "block");
	});	
	
	$('#datepickertocategory_wise').change(function () {
		
		$('#ui-datepicker-div').css("display", "none");
		
		var tot_to=$(this).val();
		var tot_from=$('#datepickerfromcategory_wise').val();
                var typeval=$('#typeval').val();//document.getElementById("typeval").value;
                 var floorz=$('#floorwisecategorywise').val();
                 //var typeval="summary";
		//var ordtype=$('#ordertyp').val();
			//$('#ordertypebydate').val("null");
		//	$('#ordertypebydate').find('option:first').attr('selected', 'selected');
		$('#bydatecategorywise').find('option:first').attr('selected', 'selected');
		if(tot_from=="")
		{
			tot_from="";
		}

						$.post("load_report.php", {fromdt:tot_from,todt:tot_to,type:typeval,floorz:floorz,set:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});

	});
	
	$('#bydatecategorywise').change(function () {

		var typeval=$('#typeval').val();
		$('#datepickerfromcategory_wise').val('');
		$('#datepickertocategory_wise').val('');
		var tp=$(this).val();
                var floorz=$('#floorwisecategorywise').val();

						$.post("load_report.php", {bydate:tp,type:typeval,floorz:floorz,fromdt:'',todt:'',abc:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
				  
	});
        
        $('#floorwisecategorywise').change(function () {
		
		var floorz=$(this).val();
		var bydate=$('#bydatecategorywise').val();
	
		var from=$('#datepickerfromcategory_wise').val();
		var to=$('#datepickertocategory_wise').val();
		var typeval=$('#typeval').val();
                var addon=$('#menu_type').val();
		if(floorz=="")
		{
		//flrval=
		}
		
						$.post("load_report.php", {floorz:floorz,type:typeval,bydate:bydate,from:from,to:to,addon:addon,flr:"fl"},
						function(data)
						{
							  data=$.trim(data);
							
							  $('#reportload').html(data);
						});

	});
	
        
        
        
	/*****************************************Categorywise report ends**************************************************************/
 
        /*******************************************Total Summary details starts**********************************************/
	//summarydiv  datepickerfromsummary datepickertosummary bydatesummary summary	
$('#datepickerfromtotalsummarydetails').change(function () {
	
		$('#ui-datepicker-div').css("display", "none");
		var fromval=$(this).val();
		var tot_to=$('#datepickertototalsummarydetails').val();
		var typeval=$('#typeval').val();
		$('#bydatekot').find('option:first').attr('selected', 'selected');
		if(tot_to=="")
		{
			tot_to="";
		}

						$.post("load_report.php", {fromdt:fromval,todt:tot_to,type:typeval,set:"ft"},
						function(data)
						{
							  data=$.trim(data);
						
							$('#reportload').html(data);
						});
				  
	});
	$('#datepickerfromtotalsummarydetails').click(function () {
		$('#ui-datepicker-div').css("display", "block");
	});	
	
	
	
	$('#datepickertototalsummarydetails').click(function () {
		$('#ui-datepicker-div').css("display", "block");
	});	
	
	$('#datepickertototalsummarydetails').change(function () {
		
		$('#ui-datepicker-div').css("display", "none");
		
		var tot_to=$(this).val();
		var tot_from=$('#datepickerfromtotalsummarydetails').val();
                var typeval=$('#typeval').val();//document.getElementById("typeval").value;
                //var typeval="summary";
		//var ordtype=$('#ordertyp').val();
			//$('#ordertypebydate').val("null");
		//	$('#ordertypebydate').find('option:first').attr('selected', 'selected');
		$('#bydatekot').find('option:first').attr('selected', 'selected');
		if(tot_from=="")
		{
			tot_from="";
		}

						$.post("load_report.php", {fromdt:tot_from,todt:tot_to,type:typeval,set:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
		
	});
	
	$('#bydatetotalsummarydetails').change(function () {
	
		var typeval=$('#typeval').val();
		$('#datepickerfromtotalsummarydetails').val('');
		$('#datepickertototalsummarydetails').val('');
		var tp=$(this).val();
		
						$.post("load_report.php", {bydate:tp,type:typeval,abc:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
				  
	});
	/*****************************************Total Summary details ends**************************************************************/
        
        
	/*****************************************complementary report starts***********************************************/
	
	
	
	$('#datepickercompfrom').change(function () {
	
		$('#ui-datepicker-div').css("display", "none");
		var fromval=$(this).val();
		var tot_to=$('#datepickercomptodt').val();
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;
		
$('#bycompdate').val("null");
		
		if(tot_to=="")
		{
			tot_to="";
		}
						$.post("load_report.php", {fromdt:fromval,todt:tot_to,type:typeval,set:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
	});
	
	
	
	$('#datepickercomptodt').change(function () {
		$('#bycompdate').val("null");
		$('#ui-datepicker-div').css("display", "none");
		var tot_to=$(this).val();
		var tot_from=$('#datepickercompfrom').val();
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;
		if(tot_from=="")
		{
			tot_from="";
		}
						$.post("load_report.php", {fromdt:tot_from,todt:tot_to,type:typeval,set:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
	});
	
	
	
	
	
	
		$('#bycompdate').change(function () {

	
		var typeval=$('#typeval').val();
	  $('#datepickercomptodt').val(""); 
	 $('#datepickercompfrom').val("");
		var bydate=$('#bycompdate').val();
		

						$.post("load_report.php", {bydate:bydate,type:typeval,abc:"ft"},
						function(data)
						{
							  data=$.trim(data);
						   
							  $('#reportload').html(data);
						});
	});
	
	
	
	
	$('#datepickercrdtfrom').change(function () {

		$('#ui-datepicker-div').css("display", "none");
		var fromval=$(this).val();
		var tot_to=$('#datepickercrdttodt').val();
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;
		var catg=$('#bycat').val();
		
$('#bycrdtdate').val("null");
		
		if(tot_to=="")
		{
			tot_to="";
		}
						$.post("load_report.php", {from:fromval,to:tot_to,type:typeval,catgry:catg,set:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
	});
	
	
	
	
	
	
	$('#datepickercrdttodt').change(function () {
		$('#bycrdtdate').val("null");
		$('#ui-datepicker-div').css("display", "none");
		var tot_to=$(this).val();
		var tot_from=$('#datepickercrdtfrom').val();
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;
		var catg=$('#bycat').val();
		if(tot_from=="")
		{
			tot_from="";
		}

						$.post("load_report.php", {from:tot_from,to:tot_to,type:typeval,catgry:catg,set:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});

	});
	
	
	
		$('#bycrdtdate').change(function () {

		var typeval=$('#typeval').val();
	  $('#datepickercrdttodt').val(""); 
	 $('#datepickercrdtfrom').val("");
		var bydate=$('#bycrdtdate').val();
		var catg=$('#bycat').val();
		

						$.post("load_report.php", {hidbydate:bydate,from:"",to:"",type:typeval,catgry:catg,abc:"ft"},
						function(data)
						{
							  data=$.trim(data);
							
							  $('#reportload').html(data);
						});
	});
	
	$('#bycat').change(function () {
		
		var catval=$(this).val();
		
	
	 
		var typeval=$('#typeval').val(); 
		
		var bycrdate=$('#bycrdtdate').val();
		
		var from=$('#datepickercrdtfrom').val();
		
		var to=$('#datepickercrdttodt').val();
		
		if(catval=="")
		{
			//flrval=
		}

							$.post("load_report.php", {catgry:catval,type:typeval,hidbydate:bycrdate,from:from,to:to},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});

			});

		
			/********************************** Daily cost report***********************************************/
		
		
		
		$('#bymonth').change(function () {
		
	
		$('#ui-datepicker-div').css("display", "none");
		var monthval=$(this).val();
		
		var yrval=$('#byear').val();
		
		
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;
		
		
		if(monthval !="null" && yrval =="")
		{
	
						$.post("load_report.php", {monthval:monthval,yrval:yrval,type:typeval,set:"ft"},
						function(data)
						{
							  data=$.trim(data);
						$('#reportload').html(data);
						});	  
		}
		
		
		else if(monthval !="null" && yrval !="")
		{
						$.post("load_report.php", {monthval:monthval,yrval:yrval,type:typeval,setyr:"ft"},
						function(data)
						{
							 data=$.trim(data);
						$('#reportload').html(data);
						});
		}
		

	});
		$('#byear').change(function () {
		
	
		$('#ui-datepicker-div').css("display", "none");
		var monthval=$('#bymonth').val();
		var yrval=$(this).val();
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;
		
	
		
		
		if(yrval !="" && monthval =="null"  )
		{
						$.post("load_report.php", {monthval:monthval,yrval:yrval,type:typeval,yr:"ft"},
						function(data)
						{
							  data=$.trim(data);
						$('#reportload').html(data);
						});					
		}
		
		else if(yrval !="" && monthval !="null")
		{
						$.post("load_report.php", {monthval:monthval,yrval:yrval,type:typeval,setmnth:"ft"},
						function(data)
						{
						data=$.trim(data);
						$('#reportload').html(data);
						});
	
		}
		
		
	});
	
	
$('#datepickerfromloyality').change(function () {
	
		$('#ui-datepicker-div').css("display", "none");
		var fromval=$(this).val();
		var tot_to=$('#datepickertoloyality').val();
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;
		
$('#byloyalitydate').val("null");
		
		if(tot_to=="")
		{
			tot_to="";
		}

						$.post("load_report.php", {fromdt:fromval,todt:tot_to,type:typeval,set:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
	
});
	
	
	$('#datepickertoloyality').change(function () {

		$('#ui-datepicker-div').css("display", "none");
		var fromval=$('#datepickerfromloyality').val();
		var tot_to=$(this).val();
		
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;
		
$('#byloyalitydate').val("null");
		
		if(tot_to=="")
		{
			tot_to="";
		}
						$.post("load_report.php", {fromdt:fromval,todt:tot_to,type:typeval,set:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});

});


$('#byloyalitydate').change(function () {
		
	
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;
		
	
	  $('#datepickerfromloyality').val(""); 
	 $('#datepickertoloyality').val("");
		var bydate=$(this).val();


						$.post("load_report.php", {bydate:bydate,type:typeval,abc:"ft"},
						function(data)
						{
							  data=$.trim(data);
							
							  $('#reportload').html(data);
						});

	});
 $('#menu_type').change(function () {           
		$('#ui-datepicker-div').css("display", "none");
               var floors=$('#floorwise').val();
                var typeval=$('#typeval').val();
                 var bydate=$('#bydate').val();
                var fromval=$('#datepickerfrom').val();
                var tot_to=$('#datepickertodt').val();
               
                var addon=$(this).val();

						$.post("load_report.php", {floorz:floors,type:typeval,fromdt:fromval,todt:tot_to,bydate:bydate,addon:addon},
						function(data)
						{  
							  data=$.trim(data);
							  $('#reportload').html(data);
						});

	});

  });
               

  </script>


 
</head>
<body>

 <?php  include "includes/topbar_master.php"; ?>

 <?php include "includes/left_menu.php"; ?>
						
 <div  class="sitemap_cc">Dinein Report</div>
  <div id="container">  
<div class="col-md-12 main_contant_container nopaddding">
    <div class="col-lg-12 col-md-12 report_main_cc" style="padding-top:10px; background-color:rgb(208, 208, 208);">
        <div class="col-lg-12 col-md-12 nopadding" style="background-color:#FCFCFC;  ">
            <div class="header_main_container">
                <div class="col-lg-12 col-md-12 nopadding">
                    <!-- condition starts -->                         
                    <div class="col-lg-12 col-md-12 nopadding top_main_cc">
                        <div class="col-lg-2 col-md-2 no-padding filter_txt_cc"><div class="filter_heading filter_head_1">Select</div></div>
                        <div class="search_name_box_main report_check_box_cc" style="margin-top: 4px;">
                            <!-- type starts -->
                            <div class="search_name_box_main" style="width: 24%;">
                                <div class="text-selection_name">Type</div>
                                   <div class="input-group">
                                         <select  class="form-control add_new_dropdown_report" onChange="reportcreate(this.value)" name="typeval" id="typeval">
                                              <option value="">Type of report</option>                                           
								   <?php  
								   $sql_login  =  $database->mysqlQuery("select rm_reportid,rm_printa4,rm_posprintofanother,rm_reportname from tbl_reportmaster where rm_reportview='Y' and rm_reporttype='DI'"); 
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
                            
                            
                            
                            
                            
                            
                            <div id="totalsalesdiv" style="display:none" >
                            
                            <div class="search_name_box_main"> 
                                 <div class="text-selection_name">Floor:</div>
                                     <div class="input-group">
                                         <select  class="form-control add_new_dropdown_report" name="floorwise" id="floorwise">
                                              <option value="">All</option>
                                              <?php  
											  $sql_login  =  $database->mysqlQuery("select fr_floorid,fr_floorname from tbl_floormaster where fr_branchid='".$_SESSION['branchofid']."'"); 
													$num_login   = $database->mysqlNumRows($sql_login);
													if($num_login){
														while($result_login  = $database->mysqlFetchArray($sql_login)) 
														  { ?>
                                                  <option value="<?=$result_login['fr_floorid']?>"><?=$result_login['fr_floorname']?></option>
                                                  <?php }} ?>
                                                   
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
                                    <div class="text-selection_name">To  :</div>
                                     <div class="input-group">
                                         <input type="text" class="form-control" id="datepickertodt" >            
                                    </div>
                                 </div>
                                 
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">By Date</div>
                                      <div class="input-group">
                                    <select class="form-control add_new_dropdown_report" name="bydate" id="bydate" >
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
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            <div id="generalratingdiv" style="display:none" >
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">From:</div>
                                     <div class="input-group">
                                         <input type="text" class="form-control" id="datepickerfromgeneralrating" >     
                                    </div>
                                 </div>
                                 
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">To  :</div>
                                     <div class="input-group">
                                         <input type="text" class="form-control" id="datepickertogeneralrating" >            
                                    </div>
                                 </div>
                                 
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">By Date</div>
                                      <div class="input-group">
                                    <select class="form-control add_new_dropdown_report" name="byratingdate" id="byratingdate" >
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
                            
                            
                            
                            
                            
                            
                              <!-- total_sales_ timely div -->  
                              
                              
                              
                              <div id="tot_sales_timelydiv" style="display:none" >
                            
                            <div class="search_name_box_main"> 
                                 <div class="text-selection_name">Floor:</div>
                                     <div class="input-group">
                                         <select  class="form-control add_new_dropdown_report" name="floor_sales" id="floor_sales">
                                              <option value="">All</option>
                                              <?php  
											  $sql_login  =  $database->mysqlQuery("select fr_floorid,fr_floorname from tbl_floormaster where fr_branchid='".$_SESSION['branchofid']."'"); 
													$num_login   = $database->mysqlNumRows($sql_login);
													if($num_login){
														while($result_login  = $database->mysqlFetchArray($sql_login)) 
														  { ?>
                                                  <option value="<?=$result_login['fr_floorid']?>"><?=$result_login['fr_floorname']?></option>
                                                  <?php }} ?>
                                                   
                                            </select>   
                                    </div>
                                    </div>
                            
                            
                                         <div class="search_name_box_main" style="width:19%">
                             	<div class="text-selection_name">From Time</div>
                               	 <div  class="input-group">
                                  <input type="text" class="form-control time" tabindex="5" name="timeopen"  id="timeopen" data-toggle="tooltip" title="timeopen"  ></div>
                               </div>
                               
                                <div  class="search_name_box_main" style="width:19%">
                             	<div class="text-selection_name">To Time</div>
                               	 <div class="input-group">
                                  <input type="text" class="form-control time" tabindex="5" name="timeclose"  id="timeclose" data-toggle="tooltip" title="timeclose"  ></div>
                            
                            </div>
                            
                                  <div class="search_name_box_main"> 
                                    <div class="text-selection_name">Date:</div> 
                                     <div class="input-group">
                                         <input type="text" class="form-control" id="datepickersalestimely"  value="<?=date('Y-m-d')?>" readonly disabled>     
                                    </div>
                                 </div>
                            
                            
                           </div> 
                            
                           <!--      <div class="search_name_box_main">
                                    <div class="text-selection_name">From:</div>
                                     <div class="input-group">
                                         <input type="text" class="form-control" id="datepickerfromtime" >     
                                    </div>
                                 </div>
                                 
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">To  :</div>
                                     <div class="input-group">
                                         <input type="text" class="form-control" id="datepickertodttime" >            
                                    </div>
                                 </div>-->
                                 
<!-------------Regenerate bill logs----------------------------------------->

								<div id="regeneratebilllogs" style="display:none" >
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">From:</div>
                                     <div class="input-group">
                                         <input type="text" class="form-control" id="datepickerfromregenerate" >     
                                    </div>
                                 </div>
                                 
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">To  :</div>
                                     <div class="input-group">
                                         <input type="text" class="form-control" id="datepickertoregenerate" >            
                                    </div>
                                 </div>
                                 
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">By Date</div>
                                      <div class="input-group">
                                    <select class="form-control add_new_dropdown_report" name="bydateregenerate" id="bydateregenerate" >
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

<!------------Regenerate bill logs ends------------------------------------------->
							 
                         
                              
                              
                              
                              
                              
                              
                              
                              
                              
                            
                            
                            <!-- date starts -->  
                            
                            <!-- date ends -->  
                            
                             <!-- discount starts -->  
                            <div id="discountsalesdiv" style="display:none" >
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">From:</div>
                                     <div class="input-group">
                                         <input type="text" class="form-control" id="datepickerfromdisc" >     
                                    </div>
                                 </div>
                              
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">To  :</div>
                                     <div class="input-group">
                                         <input type="text" class="form-control" id="datepickertodtdisc" >            
                                    </div>
                                 </div>
                                 
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">By Date</div>
                                      <div class="input-group">
                                    <select class="form-control add_new_dropdown_report" name="bydatedisc" id="bydatedisc" >
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
                            <!-- discount ends -->  
                            
                            
                            
                            
                            
                            
                            
                           <!-- Turnover starts -->  
                            <div id="turnoverdiv" style="display:none" >
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">From:</div>
                                     <div class="input-group">
                                         <input type="text" class="form-control" id="datepickerfromturn" >     
                                    </div>
                                 </div>
                              
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">To  :</div>
                                     <div class="input-group">
                                         <input type="text" class="form-control" id="datepickertodtturn" >            
                                    </div>
                                 </div>
                                 
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">By Date</div>
                                      <div class="input-group">
                                    <select class="form-control add_new_dropdown_report" name="bydateturn" id="bydateturn" >
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
                            <!-- Turnover ends -- 
                            
                            
                            
                            
                            
                            
                             <!-- kot starts -->
                            <div id="kotsalesdiv" style="display:none" >
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">From:</div>
                                     <div class="input-group">
                                         <input type="text" class="form-control" id="datepickerfromkot" >     
                                    </div>
                                 </div>
                              
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">To  :</div>
                                     <div class="input-group">
                                         <input type="text" class="form-control" id="datepickertodtkot" >            
                                    </div>
                                 </div>
                                 
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">By Date</div>
                                      <div class="input-group">
                                    <select class="form-control add_new_dropdown_report" name="bydatekot" id="bydatekot" >
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
                            <!-- kot ends --> 
                            
                            
                            
                            <div id="summary_hamdiv" style="display:none" >
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">From:</div>
                                     <div class="input-group">
                                         <input type="text" class="form-control" id="datepickerfromsummaryham" >     
                                    </div>
                                 </div>
                                 
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">To  :</div>
                                     <div class="input-group">
                                         <input type="text" class="form-control" id="datepickertosummaryham" >            
                                    </div>
                                 </div>
                                 
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">By Date</div>
                                      <div class="input-group">
                                    <select class="form-control add_new_dropdown_report" name="bydatesummaryham" id="bydatesummaryham" >
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
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            <!-- summary starts --> 
                            <div id="summarydiv" style="display:none" >
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">From:</div>
                                     <div class="input-group">
                                         <input type="text" class="form-control" id="datepickerfromsummary" >     
                                    </div>
                                 </div>
                                 
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">To  :</div>
                                     <div class="input-group">
                                         <input type="text" class="form-control" id="datepickertosummary" >            
                                    </div>
                                 </div>
                                 
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">By Date</div>
                                      <div class="input-group">
                                    <select class="form-control add_new_dropdown_report" name="bydatesummary" id="bydatesummary" >
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
                            
                            
                            <!-- category wise starts --> 
                            <div id="categorywise_reportdiv" style="display:none" >
                               
                                
                                <div class="search_name_box_main"> 
                                 <div class="text-selection_name">Floor:</div>
                                     <div class="input-group">
                                         <select  class="form-control add_new_dropdown_report" name="floorwisecategorywise" id="floorwisecategorywise">
                                              <option value="">All</option>
                                              <?php  
											   $sql_login  =  $database->mysqlQuery("select fr_floorid,fr_floorname from tbl_floormaster where fr_branchid='".$_SESSION['branchofid']."'"); 
													$num_login   = $database->mysqlNumRows($sql_login);
													if($num_login){
														while($result_login  = $database->mysqlFetchArray($sql_login)) 
														  { ?>
                                                  <option value="<?=$result_login['fr_floorid']?>"><?=$result_login['fr_floorname']?></option>
                                                  <?php }} ?>
                                                   
                                            </select>   
                                    </div>
                                    </div>

                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">From:</div>
                                     <div class="input-group">
                                         <input type="text" class="form-control" id="datepickerfromcategory_wise" >     
                                    </div>
                                 </div>
                                 
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">To  :</div>
                                     <div class="input-group">
                                         <input type="text" class="form-control" id="datepickertocategory_wise" >            
                                    </div>
                                 </div>
                                 
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">By Date</div>
                                      <div class="input-group">
                                    <select class="form-control add_new_dropdown_report" name="bydatecatogorywise" id="bydatecategorywise" >
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
                            <!-- category wise ends -->  
          
                              <!-- total summary details starts --> 
                            <div id="totalsummarydetailsdiv" style="display:none" >
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">From:</div>
                                     <div class="input-group">
                                         <input type="text" class="form-control" id="datepickerfromtotalsummarydetails" >     
                                    </div>
                                 </div>
                                 
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">To  :</div>
                                     <div class="input-group">
                                         <input type="text" class="form-control" id="datepickertototalsummarydetails" >            
                                    </div>
                                 </div>
                                 
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">By Date</div>
                                      <div class="input-group">
                                    <select class="form-control add_new_dropdown_report" name="bydatetotalsummarydetails" id="bydatetotalsummarydetails" >
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
                            
                             <!-- bill report starts -->  
                            <div id="billreportdiv" style="display:none" >
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">From:</div>
                                     <div class="input-group">
                                         <input type="text" class="form-control" id="datepickerfrombill" >     
                                    </div>
                                 </div>
                                 
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">To  :</div>
                                     <div class="input-group">
                                         <input type="text" class="form-control" id="datepickertobill" >            
                                    </div>
                                 </div>
                                 
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">By Date</div>
                                      <div class="input-group">
                                    <select class="form-control add_new_dropdown_report" name="bydatebillreport" id="bydatebillreport" >
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
                            <!-- bill report ends -->  
                            
                             <!-- date starts -->
                            <div id="totalcancelbilldiv" style="display:none" >
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">From:</div>
                                     <div class="input-group">
                                         <input type="text" class="form-control" id="datepickerfrom_cl" >     
                                    </div>
                                 </div>
                                 
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">To  :</div>
                                     <div class="input-group">
                                         <input type="text" class="form-control" id="datepickertodt_cl" >            
                                    </div>
                                 </div>
                                 
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">By Date</div>
                                      <div class="input-group">
                                    <select class="form-control add_new_dropdown_report" name="bydate_cl" id="bydate_cl" >
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
                            <!-- date ends -->  
                            
                             <!-- type of payment starts -->                     
                            <div id="totalpaydiv" style="display:none" >
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">Type:</div>
                                     <div class="input-group">
                                         <select  class="form-control add_new_dropdown_report" name="typepay" id="typepay">
                                              <option value="null" default>Select mode</option>
                                              <option value="cash">Cash</option>
                                              <option value="credit">Credit / Debit</option>
                                              <option value="coupons">Coupons</option>
                                              <option value="voucher">Voucher</option>
                                              <option value="cheque">Cheque</option>
                                         
                                              
                                              
                                         </select>   
                                    </div>
                                 </div>
                                 
                                 <div id="test">
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
                            <!-- type of payment ends -->  
                            
                            
                            
                            
                            <div id="complementarydiv" style="display:none" >
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">From:</div>
                                     <div class="input-group">
                                         <input type="text" class="form-control" id="datepickercompfrom" >     
                                    </div>
                                 </div>
                                 
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">To  :</div>
                                     <div class="input-group">
                                         <input type="text" class="form-control" id="datepickercomptodt" >            
                                    </div>
                                 </div>
                                 
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">By Date</div>
                                      <div class="input-group">
                                    <select class="form-control add_new_dropdown_report" name="bycompdate" id="bycompdate" >
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
                            
                            
                            
                            <div id="creditdetailsdiv" style="display:none" >
                            
                            
                               <div style="width: 20%;" class="search_name_box_main">
                                    <div class="text-selection_name">Category:</div>
                                     <div class="input-group">
                                         <select  class="form-control add_new_dropdown_report" name="bycat" id="bycat">
                                              <option value="">Select Category</option>
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
                            
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">From:</div>
                                     <div class="input-group">
                                         <input type="text" class="form-control" id="datepickercrdtfrom" >     
                                    </div>
                                 </div>
                                 
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">To  :</div>
                                     <div class="input-group">
                                         <input type="text" class="form-control" id="datepickercrdttodt" >            
                                    </div>
                                 </div>
                                 
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">By Date</div>
                                      <div class="input-group">
                                    <select class="form-control add_new_dropdown_report" name="bycrdtdate" id="bycrdtdate" >
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
                            
                            
                       
                                   <div id="dailycostdiv" style="display:none" >
                                     <div class="search_name_box_main">
                                    <div class="text-selection_name">By Month</div>
                                      <div class="input-group">
                                    <select class="form-control add_new_dropdown_report" name="bymonth" id="bymonth" >
                                          <option value="null" default>--Select--</option>
                                          <option value="01" >January</option>
                                          <option value="02" >February</option>
                                          <option value="03">March</option>
                                          <option value="04">April</option>
                                          <option value="05">May</option>
                                          <option value="06">June</option>
                                          <option value="07">July</option>
                                          <option value="08">August</option>
                                          <option value="09">September</option>
                                          <option value="10">October</option>
                                          <option value="11">November</option>
                                          <option value="12">December</option>
                                        </select>
                                    </div>
                                </div> 
                                           <div class="search_name_box_main">
                                    <div class="text-selection_name">By Year</div>
                                      <div class="input-group">
                                  
                                     <select class="form-control add_new_dropdown_report"   name="byear" id="byear"  >
<option value="">Year</option>
<?php
for ($i=2015; $i<=2021; $i++) {
?>
<option value="<?php echo $i; ?>">
<?php echo $i; ?>
</option>
<?php
}
?>
</select>
                                    </div>
                                </div> 
                            </div>
                            
                            
                            
                            
                            <div id="steward_detail" style="display:none" >
                             <div class="search_name_box_main">
                                <div class="text-selection_name">Type</div>
                                   <div class="input-group" style="width: 55%;">
                                         <select  class="form-control add_new_dropdown_report"  name="steward_type" id="steward_type">
                                             
                                              <option value="Detailed">Detailed</option>
                                               <option value="Summary">Summary</option>
                                              
                                         </select>    
                                  </div>
                            </div>
                            </div>  
                            
                            <div id="steward_mode" style="display:none" >
                             <div class="search_name_box_main">
                                <div class="text-selection_name">Type</div>
                                   <div class="input-group" style="width: 55%;">
                                         <select  class="form-control add_new_dropdown_report"  name="stw_mode" id="stw_mode">
                                             
                                              <option value="Sale">Sales</option>
                                               <option value="Cancel">Bill Cancelled</option>
                                               <option value="Kot_cancel">Kot Cancelled</option>
                                         </select>    
                                  </div>
                            </div>
                            </div>  
                            
                            
                            
                            <div id="condition" style="display:none" >
                             <div class="search_name_box_main">
                                <div class="text-selection_name">Conditions</div>
                                   <div class="input-group" style="width: 55%;">
                                         <select  class="form-control add_new_dropdown_report"  name="condition_type" id="condition_type">
                                              <option value="">Select</option>
                                             <option value="dynamic">Dynamic price menus</option>
                                              <option value="tax_excempt">Tax excempted menus</option>    
                                             <option value="addon">Add on menus</option>
                                              <option value="no_print"> No print</option>
                                              
                                             
                                         
                                         </select>    
                                  </div>
                            </div>
                            </div>  
                                
                            
                              <!-- item starts -->                     
                            <div id="itemselectdiv" style="display:none" >
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">Floor:</div>
                                     <div class="input-group">
                                         <select  class="form-control add_new_dropdown_report" name="floorsel" id="floorsel">
                                              <option value="">Select Floor</option>
                                               
                                              <?php  
											  $sql_login  =  $database->mysqlQuery("select fr_floorid,fr_floorname from tbl_floormaster  "); 
													$num_login   = $database->mysqlNumRows($sql_login);
													if($num_login){
														while($result_login  = $database->mysqlFetchArray($sql_login)) 
														  { ?>
                                                  <option value="<?=$result_login['fr_floorid']?>"><?=$result_login['fr_floorname']?></option>
                                                  <?php }} ?>
                                                   
                                            </select>   
                                    </div>
                                 </div>
                           </div>
                            <!-- item ends -->  
                             <!-- type of Steward starts -->                     
                            <div id="totalsteward" style="display:none" >
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">Steward:</div>
                                     <div class="input-group">
                                         <select  class="form-control add_new_dropdown_report" name="stewardtp" id="stewardtp">
                                              <option value="">Steward</option>
					 <?php
     $sql_ds_nos="select ser_staffid,ser_firstname from tbl_staffmaster as sa LEFT JOIN  tbl_designationmaster as dg ON sa.ser_designation=dg.dr_designationid where  sa.ser_designation IN (".$_SESSION['desgn_takordr'].")  AND  sa.ser_employeestatus='Active'"	;		 
                          $sql_ds  =  $database->mysqlQuery($sql_ds_nos); 
                          $num_ds = $database->mysqlNumRows($sql_ds);
                          if($num_ds){ 
                           while($result_ds = $database->mysqlFetchArray($sql_ds)) 
                                  { ?>
					<option  value="<?=$result_ds['ser_staffid']?>"><?=$result_ds['ser_firstname']?></option>			
				<?php }  ?>
                 <?php } ?>
                                            </select>   
                                    </div>
                                 </div>
                                 
                                 <div class="search_name_box_main"> 
                                    <div class="text-selection_name">From:</div>
                                     <div class="input-group">
                                         <input type="text" class="form-control" id="datepickerfromdtstw" >     
                                    </div>
                                 </div>
                                 
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">To  :</div> 
                                     <div class="input-group">
                                         <input type="text" class="form-control" id="datepickertodtstw" >            
                                    </div>
                                 </div>
                                 
                                        <div class="search_name_box_main">
            	<div class="text-selection_name">By Date</div>
                  <div class="input-group">
                <select class="form-control add_new_dropdown_report" name="stewardbydate" id="stewardbydate" >
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
                            <!-- type of Steward ends -->  
                            
                            
                            <!-- type of Steward performance starts -->                     
                            <div id="stewardperformance" style="display:none" >
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">Steward:</div>
                                     <div class="input-group">
                                         <select  class="form-control add_new_dropdown_report" name="stewardperfo" id="stewardperfo">
                                              <option value="">Steward</option>
					 <?php
     $sql_ds_nos="select ser_staffid,ser_firstname from tbl_staffmaster as sa LEFT JOIN  tbl_designationmaster as dg ON sa.ser_designation=dg.dr_designationid where  sa.ser_designation IN (".$_SESSION['desgn_takordr'].")  AND  sa.ser_employeestatus='Active'"	;		 
                          $sql_ds  =  $database->mysqlQuery($sql_ds_nos); 
                          $num_ds = $database->mysqlNumRows($sql_ds);
                          if($num_ds){ 
                           while($result_ds = $database->mysqlFetchArray($sql_ds)) 
                                  {
				?>
					<option  value="<?=$result_ds['ser_staffid']?>"><?=$result_ds['ser_firstname']?></option>
			
				<?php }  ?>
                 <?php } ?>
                                            </select>   
                                    </div>
                                 </div>
                                 
                                 <div class="search_name_box_main"> 
                                    <div class="text-selection_name">From:</div>
                                     <div class="input-group">
                                         <input type="text" class="form-control" id="datepickerfromdtstwprf" >     
                                    </div>
                                 </div>
                                 
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">To  :</div> 
                                     <div class="input-group">
                                         <input type="text" class="form-control" id="datepickertodtstwprf" >            
                                    </div>
                                 </div>
                                 
                                        <div class="search_name_box_main">
            	<div class="text-selection_name">By Date</div>
                  <div class="input-group">
                <select class="form-control add_new_dropdown_report" name="stewardperfobydate" id="stewardperfobydate" >
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
                            <!-- type of Steward performance ends -->  
                            
                            
                            
                             <!--  Steward timely report starts -->  
                            
                            
                            
                            <div id="stewardtimelydiv" style="display:none" >
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">Steward:</div>
                                     <div class="input-group">
                                         <select  class="form-control add_new_dropdown_report" name="stewardtimely" id="stewardtimely">
                                              <option value="">Steward</option>
					 <?php
      $sql_ds_nos="select ser_staffid,ser_firstname from tbl_staffmaster as sa LEFT JOIN  tbl_designationmaster as dg ON sa.ser_designation=dg.dr_designationid where  sa.ser_designation IN (".$_SESSION['desgn_takordr'].")  AND  sa.ser_employeestatus='Active'"	;		 
                          $sql_ds  =  $database->mysqlQuery($sql_ds_nos); 
                          $num_ds = $database->mysqlNumRows($sql_ds);
                          if($num_ds){ 
                           while($result_ds = $database->mysqlFetchArray($sql_ds)) 
                                  {
				?>
					<option  value="<?=$result_ds['ser_staffid']?>"><?=$result_ds['ser_firstname']?></option>
			
				<?php }  ?>
                 <?php } ?>
                                            </select>   
                                    </div>
                                 </div>
                                 
                                 
                                                    
                                         <div class="search_name_box_main" style="width:19%">
                             	<div class="text-selection_name">From Time</div>
                               	 <div  class="input-group">
                                  <input type="text" class="form-control time" tabindex="5" name="stewardtimeopen"  id="stewardtimeopen" data-toggle="tooltip" title="timeopen"  ></div>
                               </div>
                               
                                <div  class="search_name_box_main" style="width:19%">
                             	<div class="text-selection_name">To Time</div>
                               	 <div class="input-group">
                                  <input type="text" class="form-control time" tabindex="5" name="stewardtimeclose"  id="stewardtimeclose" data-toggle="tooltip" title="timeclose"  ></div>
                            
                            </div>
                            
                                  <div class="search_name_box_main"> 
                                    <div class="text-selection_name">Date:</div> 
                                     <div class="input-group">
                                         <input type="text" class="form-control" id="stewardbydatetimely"  value="<?=date('Y-m-d')?>" readonly disabled>     
                                    </div>
                                 </div>
                                 
                                 
                                 
                                 
                                 
                                 
                                 
                              
                                 

                            </div>
                            
                            
                            
                            
                            
                            
                            
                             <!--  Steward timely report ends -->  
                            
                            
                            
                            
                            
                            
                            
                            <!-- Item oredered starts -->                     
                            <div id="totalorderdiv" style="display:none" >
                            
                            
                             <div class="search_name_box_main"> 
                                 <div class="text-selection_name">Floor:</div>
                                     <div class="input-group">
                                         <select  class="form-control add_new_dropdown_report" name="floorsel23" id="floorsel23">
                                              <option value="">All</option>
                                              <?php  
											  $sql_login  =  $database->mysqlQuery("select fr_floorid,fr_floorname from tbl_floormaster where fr_branchid='".$_SESSION['branchofid']."'"); 
													$num_login   = $database->mysqlNumRows($sql_login);
													if($num_login){
														while($result_login  = $database->mysqlFetchArray($sql_login)) 
														  { ?>
                                                  <option value="<?=$result_login['fr_floorid']?>"><?=$result_login['fr_floorname']?></option>
                                                  <?php }} ?>
                                                   
                                            </select>   
                                    </div>
                                    </div>
                                 <div class="search_name_box_main"> 
                                    <div class="text-selection_name">From:</div> 
                                     <div class="input-group">
                                         <input type="text" class="form-control" id="datepickerfromord" >     
                                    </div>
                                 </div>
                                 
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">To  :</div>
                                     <div class="input-group">
                                         <input type="text" class="form-control" id="datepickertodtord" >            
                                    </div>
                                 </div>
                                       <div class="search_name_box_main">
            	<div class="text-selection_name">By Date</div>
                  <div class="input-group">
                <select class="form-control add_new_dropdown_report" name="orderbydate" id="orderbydate" >
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
                            <!-- Item oredered ends --> 
                            
                            <!-- kitchen wise report starts -->                     
                            <div id="kitchenorderdiv" style="display:none" >
                            
                            
                             <div class="search_name_box_main"> 
                                 <div class="text-selection_name">Kitchen:</div>
                                     <div class="input-group">
                                         <select  class="form-control add_new_dropdown_report" name="kitchen" id="kitchen" onChange="viewstate(this.value)">
                                              <option value="">All</option>
                                              <?php  
											  $sql_login  =  $database->mysqlQuery("select kr_kotcode, kr_kotname from tbl_kotcountermaster where kr_branchid='".$_SESSION['branchofid']."'"); 
													$num_login   = $database->mysqlNumRows($sql_login);
													if($num_login){
														while($result_login  = $database->mysqlFetchArray($sql_login)) 
														  { ?>
                                                  <option value="<?=$result_login['kr_kotcode']?>"><?=$result_login['kr_kotname']?></option>
                                                  <?php }} ?>
                                                   
                                            </select>   
                                    </div>
                                    </div>
                               <!----------->
                                <div class="search_name_box_main" id="menuitem">
                                 	<div class="form_name_cc">Item</div>
                                  <div class="form_textbox_cc"> <div class="form-group statename" id="state_div">
                                          <select  id="item" name="item" class="form-control add_new_dropdown_report">
                                        <option value=""></option>
                                         <optgroup label="">
                                         </optgroup>
                                    	 </select>
                                         </div>
                                   	    </div><!--form_textbox_cc-->
                                    </div><!--first_form_contain--> 
                               <!-------------->
                                 <div class="search_name_box_main" style="width: 13%;"> 
                                    <div class="text-selection_name">From:</div> 
                                     <div class="input-group">
                                         <input type="text" class="form-control" id="datepickerfromktc" >     
                                    </div>
                                 </div>
                                 
                                 <div class="search_name_box_main"  style="width: 13%;">
                                    <div class="text-selection_name">To  :</div>
                                     <div class="input-group">
                                         <input type="text" class="form-control" id="datepickertodtktc" >            
                                    </div>
                                 </div>
                                       <div class="search_name_box_main">
            	<div class="text-selection_name">By Date</div>
                  <div class="input-group">
                <select class="form-control add_new_dropdown_report" name="kitchenorderbydate
                        " id="kitchenorderbydate" >
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
                            <!-- kitchen wise report ends --> 
                            
                            
                            
                            <div id="timelyitemorderdiv" style="display:none" >
                            
                            
                             <div class="search_name_box_main"> 
                                 <div class="text-selection_name">Floor:</div>
                                     <div class="input-group">
                                         <select  class="form-control add_new_dropdown_report" name="floortimely" id="floortimely">
                                              <option value="">Select Floor</option>
                                              <?php  
											$sql_login  =  $database->mysqlQuery("select fr_floorid,fr_floorname from tbl_floormaster where fr_branchid='".$_SESSION['branchofid']."'"); 
													$num_login   = $database->mysqlNumRows($sql_login);
													if($num_login){
														while($result_login  = $database->mysqlFetchArray($sql_login)) 
														  { ?>
                                                  <option value="<?=$result_login['fr_floorid']?>"><?=$result_login['fr_floorname']?></option>
                                                  <?php }} ?>
                                                   
                                            </select>   
                                    </div>
                                    </div>
                                    
                                      
                                         <div class="search_name_box_main" style="width:19%">
                             	<div class="text-selection_name">From Time</div>
                               	 <div  class="input-group">
                                  <input type="text" class="form-control time" tabindex="5" name="time"  id="time" data-toggle="tooltip" title="timeopen"  ></div>
                               </div>
                               
                                <div  class="search_name_box_main" style="width:19%">
                             	<div class="text-selection_name">To Time</div>
                               	 <div class="input-group">
                                  <input type="text" class="form-control time" tabindex="5" name="time2"  id="time2" data-toggle="tooltip" title="timeclose"  ></div>
                            
                            </div>
                                    
                                    
                                    
                                    
                                
                                            
                                            
                                            
                                            
                                            
                                 
                                   <div class="search_name_box_main"> 
                                    <div class="text-selection_name">Date:</div> 
                                     <div class="input-group">
                                         <input type="text" class="form-control" id="datepickeritemtimely"  value="<?=date('Y-m-d')?>" readonly disabled>     
                                    </div>
                                 </div>
                            </div>
                            
                                      <!-- type of portion starts -->                     
                            <div id="totalportion" style="display:none" >
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name"><?=$_SESSION['s_portionname']?>:</div>
                                     <div class="input-group">
                                         <select  class="form-control add_new_dropdown_report" name="portiontp" id="portiontp">
                                            <!--  <option value="">Portion</option>-->
                                                 <option value="null" default>All</option>
					 <?php
					 // where ser_designation='".$_SESSION['desgn_steward']."'
                   $sql_ds_nos="select pm_id,pm_portionname from tbl_portionmaster";
                          $sql_ds  =  $database->mysqlQuery($sql_ds_nos); 
                          $num_ds = $database->mysqlNumRows($sql_ds);
                          if($num_ds){ 
                           while($result_ds = $database->mysqlFetchArray($sql_ds)) 
                                  {
				?>
					<option  value="<?=$result_ds['pm_id']?>"><?=$result_ds['pm_portionname']?></option>
			
				<?php }  ?>
                 <?php } ?>
                   <!--   <option value="null" default>All</option>-->
              
                                            </select>   
                                    </div>
                                 </div>
                                 
                                 <div class="search_name_box_main"> 
                                    <div class="text-selection_name">From:</div>
                                     <div class="input-group">
                                         <input type="text" class="form-control" id="datepickerfromdtprtn" >     
                                    </div>
                                 </div>
                                 
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">To  :</div> 
                                     <div class="input-group">
                                         <input type="text" class="form-control" id="datepickertodtprtn" >            
                                    </div>
                                 </div>
                                 
                                    <div class="search_name_box_main">
            	<div class="text-selection_name">By Date</div>
                  <div class="input-group">
                <select class="form-control add_new_dropdown_report" name="portionbydate" id="portionbydate" >
                        <option value="Today" default>--Select--</option>
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
                            <!-- type of portion ends -->  
                            
                             <!-- type of Order starts -->                     
                            <div id="typooforder" style="display:none" >
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">Type:</div>
                                     <div class="input-group">
                                         <select  class="form-control add_new_dropdown_report" name="ordertyp" id="ordertyp">
                                              <option value="">Type Of Order</option>
											  <option  value="Dinein">Dine In</option>
											  <option  value="TakeAway">Take Away</option>
				
                                            </select>
                                    </div>
                                 </div>
                                 
                                 <div class="search_name_box_main"> 
                                    <div class="text-selection_name">From:</div>
                                     <div class="input-group">
                                         <input type="text" class="form-control" id="datepickerfromdttpord" >     
                                    </div>
                                 </div>
                                 
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">To  :</div> 
                                     <div class="input-group">
                                         <input type="text" class="form-control" id="datepickertodttpord" >            
                                    </div>
                                 </div>
                                 
                                   <div class="search_name_box_main">
            	<div class="text-selection_name">By Date</div>
                  <div class="input-group">
                <select class="form-control add_new_dropdown_report" name="ordertypebydate" id="ordertypebydate" >
                        <option value="Today" default>--Select--</option>
                        <option value="Today" >Today</option>
                        <option value="Yesterday">Yesterday</option>
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
                            <!-- type of Order ends -->  
                            
                                      <!-- kot_history starts-->  
                            
                           <div id="kothistorydiv" style="display:none">
                           
                           
                               <div class="search_name_box_main"> 
                                    <div class="text-selection_name">Date:</div> 
                                     <div class="input-group">
                                         <input type="text" class="form-control" id="datepickerfromkothis" >     
                                    </div>
                                 </div>
                                 
                               
                           
                           
                           
                           
                           </div>
                           
                           
                                      
                                      <div id="module_div" style="display:none">
                           
                           
                               <div class="search_name_box_main"> 
                                    <div class="text-selection_name">Mode</div> 
                                     <div class="input-group">
                                        <select  class="form-control add_new_dropdown_report" name="mode_sec" id="mode_sec">
                                              
						<option  value="DI">Dine In</option>
						<option  value="TA">Take Away</option>
				<option  value="CS">Counter Sale</option>
                                            </select> 
                                    </div>
                                 </div>
                                 
                               
                           
                           
                           
                           
                           </div>
                                      
                                      
                                     <!-- kot_history ends -->  
                                               <!--registration starts -->  
                           
                            <div id="loyalitydiv" style="display:none" >
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">From:</div>
                                     <div class="input-group">
                                         <input type="text" class="form-control" id="datepickerfromloyality" >     
                                    </div>
                                 </div>
                                 
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">To  :</div>
                                     <div class="input-group">
                                         <input type="text" class="form-control" id="datepickertoloyality" >            
                                    </div>
                                 </div>
                                 
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">By Date</div>
                                      <div class="input-group">
                                    <select class="form-control add_new_dropdown_report" name="byloyalitydate" id="byloyalitydate" >
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
                           
                           
                           
                           
                                     <!-- registration ends -->  
                           
                           
                           
                           <div id="feedbackdiv" style="display:none" >
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">From:</div>
                                     <div class="input-group">
                                         <input type="text" class="form-control" id="datepickerfromfeedback" >     
                                    </div>
                                 </div>
                                 
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">To  :</div>
                                     <div class="input-group">
                                         <input type="text" class="form-control" id="datepickertofeedback" >            
                                    </div>
                                 </div>
                                 
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">By Date</div>
                                      <div class="input-group">
                                    <select class="form-control add_new_dropdown_report" name="byfeedback" id="byfeedback" >
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
                           
                           
                           
                           
                             <!-- menu raring starts -->   
                           
                           
                           <div id="menuratingdiv" style="display:none" >
                                
                             <div class="search_name_box_main">
                                    <div class="text-selection_name">Menu</div>
                                      <div class="input-group">
                                      
                         <input type="text" class="form-control filte_new_box" id="bymenurating" name="bymenurating" placeholder="Menu"  >             
                                      
                                
                                    </div>
                                </div> 
                                
                                
                                
                                
                                
                                
                                <!---->
                                
                                
                                 
                            
                            </div>
                           
                           
                              <!-- menu rating ends -->   
                              
                              
                              
                       <!-- feedback summary ends -->          
                              
                              
                       
                           <div id="feedbacksummarydiv" style="display:none" >
                                 
                                 
                                 
                                
                            </div>
                                     
                              
                              
                              
                         <!-- feedback summary ends -->   
                         
                             <!-- foodcosting starts------>   
                         
                         
                           <div id="foodcostingdiv" style="display:none" >
                             <div class="search_name_box_main">
                                    <div class="text-selection_name">Menu</div>
                                      <div class="input-group">
                                      
                                        <select  class="form-control add_new_dropdown_report" name="byfoodcosting" id="byfoodcosting">
                                              <option value="">Select Menu</option>
                                              <?php  
											  $sql_login  =  $database->mysqlQuery("select mr_menuid,mr_menuname from tbl_menumaster "); 
													$num_login   = $database->mysqlNumRows($sql_login);
													if($num_login){
														while($result_login  = $database->mysqlFetchArray($sql_login)) 
														  { ?>
                                                  <option value="<?=$result_login['mr_menuid']?>"><?=$result_login['mr_menuname']?></option>
                                                  <?php }} ?>
                                                   
                                            </select>   
                                      
                                
                                    </div>
                                </div> 
                                
                                 
                                 
                                 
                                 
                                 
                                 
                                
                            </div>
                         
                         
                             <!-- foodcosting  ends -->   
                             
                             
                              <div id="tableturnoverdiv" style="display:none" >
                                  <div class="search_name_box_main">
                                    <div class="text-selection_name">From:</div>
                                     <div class="input-group">
                                         <input type="text" class="form-control" id="datepickerfromturnover" >     
                                    </div>
                                 </div>
                                 
                                   <div class="search_name_box_main">
                                    <div class="text-selection_name">To  :</div>
                                     <div class="input-group">
                                         <input type="text" class="form-control" id="datepickertoturnover" >            
                                    </div>
                                 </div>
                                 
                                 
                                   <div class="search_name_box_main">
                                    <div class="text-selection_name">By Date</div>
                                      <div class="input-group">
                                       <select class="form-control add_new_dropdown_report" name="byturnover" id="byturnover" >
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
                             
							<!------------------End Of sale Report----------------------------->
							 <div id="endof_sale_report" style="display:none" >
                                  <div class="search_name_box_main">
                                    <div class="text-selection_name">From:</div>
                                     <div class="input-group">
                                         <input type="text" class="form-control" id="datepickerfromnewsale" >     
                                    </div>
                                 </div>
                                 
                                   <div class="search_name_box_main">
                                    <div class="text-selection_name">To  :</div>
                                     <div class="input-group">
                                         <input type="text" class="form-control" id="datepickertonewsale" >            
                                    </div>
                                 </div>
                                 
                                 
                                   <div class="search_name_box_main">
                                    <div class="text-selection_name">By Date</div>
                                      <div class="input-group">
                                       <select class="form-control add_new_dropdown_report" name="bynewsale" id="bynewsale" >
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
							<!-------------------------------------------------------------->
                             
                             
                             
                             
                             <div id="tableturnoversummarydiv" style="display:none" >
                                  <div class="search_name_box_main">
                                    <div class="text-selection_name">From:</div>
                                     <div class="input-group">
                                         <input type="text" class="form-control" id="datepickerfromturnoversummary" >     
                                    </div>
                                 </div>
                                 
                                   <div class="search_name_box_main">
                                    <div class="text-selection_name">To  :</div>
                                     <div class="input-group">
                                         <input type="text" class="form-control" id="datepickertoturnoversummary" >            
                                    </div>
                                 </div>
                                 
                                 
                                   <div class="search_name_box_main">
                                    <div class="text-selection_name">By Date</div>
                                      <div class="input-group">
                                       <select class="form-control add_new_dropdown_report" name="byturnoversummary" id="byturnoversummary" >
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
                             
                             
                             
                             
                             
                             
                             
                             
                             
                             
                             
                             <!-- cancel starts -->   
                            
                             <div id="cancelhistorydiv" style="display:none" >
                                 <div class="search_name_box_main"> 
                                    <div class="text-selection_name">From:</div> 
                                     <div class="input-group">
                                         <input type="text" class="form-control" id="datepickerfromcancel" >     
                                    </div>
                                 </div>
                                 
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">To  :</div>
                                     <div class="input-group">
                                         <input type="text" class="form-control" id="datepickertodtcancel" >            
                                    </div>
                                 </div>
                                    <div class="search_name_box_main">
            	<div class="text-selection_name">By Date</div>
                  <div class="input-group">
                <select class="form-control add_new_dropdown_report" name="orderbydatecancel" id="orderbydatecancel" >
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
              </div>                    <div id="menu_typediv" style="display:none" >
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
                           
                        <input type="hidden" name="hida4settings"  id="hida4settings"    value="<?=$_SESSION['s_a4print']?>"  >      
                             	
                     <!--cancel ends-->             
                                               
                        </div>
                    </div>
                    <!-- condition ends -->                    
                </div><!--col-lg-12 col-md-12 nopadding-->
            </div><!--header_main_container-->
             <div class="top_validate_inform"> <span id="rptstatus" class="load_error alertsmasters"></span>  </div>
                                 
            <div class="col-lg-12 col-md-12 user_detail_min_hieght reporte_min_hieght_1" style="background-color:#FCFCFC;  border-bottom: 1px solid #BDBDBD;  " id="reportload">
               
                                <!--  report content-->
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
                     
                    <div class="search_name_box_sub_btn_cc" id="prnt" style="display:none">
                           <div  class="filter_sub_btn ">
                            <a class="btn-setting"  href="#" onclick="print_page()">Print</a>
                            </div>
                     </div>
                  <!--   <div class="search_name_box_sub_btn_cc">
                           <div  class="filter_sub_btn ">
                            <a class="btn-setting"  href="#" onclick="pdf_page()">To Text</a>
                            </div>
                      </div>-->
                     <div class="search_name_box_sub_btn_cc" id="excel" style="display:block">
                           <div  class="filter_sub_btn ">
                            <a class="btn-setting"  href="#" onclick="movetoexcelForm()">TO Excel</a>
                            </div>
                      </div>
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
	  $('#datepickertodt').val(""); 
	 $('#datepickerfrom').val("");
	 $('#bydate').val("null");
	 $('#datepickerfromtyp').val("");
	 $('#datepickertodttyp').val("");
	$('#paybydate').val("null");
	$('#typepay').val("null");
	$('#datepickerfromdtstw').val("");
    $('#datepickertodtstw').val("");
	$('#stewardbydate').val("null");
	$('#stewardtp').val("");
	$('#datepickerfromord').val("");
	$('#datepickertodtord').val("");
	$('#orderbydate').val("null");
	$('#portiontp').val("null");
	$('#datepickerfromdtprtn').val("");
	$('#datepickertodtprtn').val("");
	$('#portionbydate').find('option:first').attr('selected', 'selected');
	$('#floorsel').val("");
	$('#ordertyp').val("");
	$('#datepickerfromdttpord').val("");
	$('#datepickertodttpord').val("");
	$('#ordertypebydate').find('option:first').attr('selected', 'selected');
	$('#datepickerfromcancel').val("");
	$('#datepickertodtcancel').val("");
	$('#orderbydatecancel').find('option:first').attr('selected', 'selected');
	$('#bymenurating').val("");
	$('#datepickerfromfeedback').val("");
		$('#datepickertofeedback').val("");
		$('#byfeedback').val("null");
		$('#datepickerfromkothis').val("");
	  $('#datepickerfromgeneralrating').val("");
	  $('#datepickertogeneralrating').val("");
	  $('#byratingdate').val("null");
          $('#bydatebillreport').val('');

	
}

/*********************create report on type change starts ********************/
function reportcreate(rpt)
{
	
	var repttype=rpt;//summarydiv  datepickerfromsummary datepickertosummary bydatesummary summary
	

	
        if(repttype=="steward")
	{
            $('#steward_detail').show();
        }else{
            $('#steward_detail').hide(); 
        }
        
        
	
	if(repttype=="tot_sales")
	{   
		$('#module_div').hide();
		$('#stewardtimelydiv').css("display","none");
		$('#regeneratebilllogs').css("display","none");
		$('#totalsalesdiv').css("display", "block");
		$('#endof_sale_report').css("display","none");
		$('#summary_hamdiv').css("display","none");
		$('#tableturnoversummarydiv').css("display","none");
		$('#tableturnoverdiv').css("display","none");
		$('#foodcostingdiv').css("display","none");
		$('#feedbacksummarydiv').css("display","none");
		$('#excel').css("display","block");
		$('#prnt').css("display","block");
		$('#menuratingdiv').css("display","none");
		$('#feedbackdiv').css("display","none");
		$('#loyalitydiv').css("display","none");
		$('#kothistorydiv').css("display","none");
		$('#dailycostdiv').css("display","none");
		$('#creditdetailsdiv').css("display","none");
		$('#billreportdiv').css("display", "none");
		$('#summarydiv').css("display", "none");
		$('#kotsalesdiv').css("display", "none");
		$('#totalcancelbilldiv').css("display", "none");
        $('#stewardperformance').css("display", "none");
		$('#totalpaydiv').css("display", "none");
		$('#itemselectdiv').css("display", "none");
		$('#totalorderdiv').css("display", "none");
		$('#totalsteward').css("display", "none");
		$('#typooforder').css("display", "none");
		$('#totalportion').css("display", "none");
		$('#cancelhistorydiv').css("display", "none");	
		$('#discountsalesdiv').css("display", "none");
        $('#turnoverdiv').css("display", "none");
		$('#complementarydiv').css("display", "none");
		$('#generalratingdiv').css("display","none");
		$('#timelyitemorderdiv').css("display","none");
		$('#tot_sales_timelydiv').css("display","none");
        $('#totalsummarydetailsdiv').css("display", "none");
        $('#kitchenorderdiv').css("display", "none");
        $('#categorywise_reportdiv').css("display","none");
        $('#menu_typediv').css("display", "none");
        $('#bill_sort_div').css("display", "none");
        $('#condition').css("display", "none");

		clearall();
		var floorwise=$('#floorwise').val();		
		$.post("load_report.php", {type:repttype,floorz:floorwise,fromdt:'',todt:'',bydate:''},
			function(data)
			{
				data=$.trim(data);
				$('#reportload').html(data);
			});
	} 
    
	else if(repttype=="sales_summary_zam")
	{ 
		$('#module_div').hide();
		$('#stewardtimelydiv').css("display","none");
		$('#regeneratebilllogs').css("display","none");
		$('#tot_sales_timelydiv').css("display","none");
		$('#timelyitemorderdiv').css("display","none");
		$('#summary_hamdiv').css("display","none");
		$('#tableturnoversummarydiv').css("display","none");
		$('#tableturnoverdiv').css("display","none");
		$('#foodcostingdiv').css("display","none");
		$('#prnt').css("display","block");
		$('#endof_sale_report').css("display","none");
		$('#feedbacksummarydiv').css("display","none");
		$('#excel').css("display","block");
        $('#stewardperformance').css("display", "none");
		$('#menuratingdiv').css("display","none");
		$('#feedbackdiv').css("display","none");
		$('#loyalitydiv').css("display","none");
		$('#kothistorydiv').css("display","none");
		$('#dailycostdiv').css("display","none");
		$('#creditdetailsdiv').css("display","none");
		$('#summarydiv').css("display", "block");
		$('#billreportdiv').css("display", "none");
		$('#kotsalesdiv').css("display", "none");
		$('#totalcancelbilldiv').css("display", "none");
		$('#totalsalesdiv').css("display", "none");
		$('#totalpaydiv').css("display", "none");
		$('#itemselectdiv').css("display", "none");
		$('#totalorderdiv').css("display", "none");
		$('#totalsteward').css("display", "none");
		$('#typooforder').css("display", "none");
		$('#totalportion').css("display", "none");
		$('#cancelhistorydiv').css("display", "none");	
		$('#discountsalesdiv').css("display", "none");
        $('#turnoverdiv').css("display", "none");
		$('#complementarydiv').css("display", "none");
		$('#generalratingdiv').css("display","none");
    	$('#totalsummarydetailsdiv').css("display", "none");
        $('#kitchenorderdiv').css("display", "none");
        $('#categorywise_reportdiv').css("display","none");
        $('#menu_typediv').css("display", "none");
        $('#bill_sort_div').css("display", "none");
        $('#condition').css("display", "none");

		clearall();
		$.post("load_report.php", {type:repttype},
				function(data)
				{
					data=$.trim(data);
					$('#reportload').html(data);
				});

    }
    
	else if(repttype=="sales_summary")
	{ 
		$('#module_div').hide();
		$('#stewardtimelydiv').css("display","none");
		$('#regeneratebilllogs').css("display","none");
		$('#tot_sales_timelydiv').css("display","none");
		$('#timelyitemorderdiv').css("display","none");
		$('#summary_hamdiv').css("display","none");
		$('#tableturnoversummarydiv').css("display","none");
		$('#tableturnoverdiv').css("display","none");
		$('#foodcostingdiv').css("display","none");
		$('#prnt').css("display","block");
		$('#endof_sale_report').css("display","none");
		$('#feedbacksummarydiv').css("display","none");
		$('#excel').css("display","block");
        $('#stewardperformance').css("display", "none");
		$('#menuratingdiv').css("display","none");
		$('#feedbackdiv').css("display","none");
		$('#loyalitydiv').css("display","none");
		$('#kothistorydiv').css("display","none");
		$('#dailycostdiv').css("display","none");
		$('#creditdetailsdiv').css("display","none");
		$('#summarydiv').css("display", "block");
		$('#billreportdiv').css("display", "none");
		$('#kotsalesdiv').css("display", "none");
		$('#totalcancelbilldiv').css("display", "none");
		$('#totalsalesdiv').css("display", "none");
		$('#totalpaydiv').css("display", "none");
		$('#itemselectdiv').css("display", "none");
		$('#totalorderdiv').css("display", "none");
		$('#totalsteward').css("display", "none");
		$('#typooforder').css("display", "none");
		$('#totalportion').css("display", "none");
		$('#cancelhistorydiv').css("display", "none");	
		$('#discountsalesdiv').css("display", "none");
    	$('#turnoverdiv').css("display", "none");
		$('#complementarydiv').css("display", "none");
		$('#generalratingdiv').css("display","none");
    	$('#totalsummarydetailsdiv').css("display", "none");
        $('#kitchenorderdiv').css("display", "none");
        $('#categorywise_reportdiv').css("display","none");
        $('#menu_typediv').css("display", "none");
        $('#bill_sort_div').css("display", "none");
        $('#condition').css("display", "none");
		clearall();

		$.post("load_report.php", {type:repttype},
			function(data)
				{
					data=$.trim(data);
					$('#reportload').html(data);
				});
    }
    else if(repttype=="tax_sales_summary")
	{ 
		$('#module_div').hide();
		$('#stewardtimelydiv').css("display","none");
		$('#regeneratebilllogs').css("display","none");
		$('#tot_sales_timelydiv').css("display","none");
		$('#timelyitemorderdiv').css("display","none");
		$('#summary_hamdiv').css("display","none");
		$('#tableturnoversummarydiv').css("display","none");
		$('#tableturnoverdiv').css("display","none");
		$('#foodcostingdiv').css("display","none");
		$('#prnt').css("display","block");
		$('#endof_sale_report').css("display","none");
		$('#feedbacksummarydiv').css("display","none");
		$('#excel').css("display","block");
        $('#stewardperformance').css("display", "none");
		$('#menuratingdiv').css("display","none");
		$('#feedbackdiv').css("display","none");
		$('#loyalitydiv').css("display","none");
		$('#kothistorydiv').css("display","none");
		$('#dailycostdiv').css("display","none");
		$('#creditdetailsdiv').css("display","none");
		$('#summarydiv').css("display", "block");
		$('#billreportdiv').css("display", "none");
		$('#kotsalesdiv').css("display", "none");
		$('#totalcancelbilldiv').css("display", "none");
		$('#totalsalesdiv').css("display", "none");
		$('#totalpaydiv').css("display", "none");
		$('#itemselectdiv').css("display", "none");
		$('#totalorderdiv').css("display", "none");
		$('#totalsteward').css("display", "none");
		$('#typooforder').css("display", "none");
		$('#totalportion').css("display", "none");
		$('#cancelhistorydiv').css("display", "none");	
		$('#discountsalesdiv').css("display", "none");
        $('#turnoverdiv').css("display", "none");
		$('#complementarydiv').css("display", "none");
		$('#generalratingdiv').css("display","none");
        $('#totalsummarydetailsdiv').css("display", "none");
        $('#kitchenorderdiv').css("display", "none");
        $('#categorywise_reportdiv').css("display","none");
        $('#menu_typediv').css("display", "none");
        $('#bill_sort_div').css("display", "none");
        $('#condition').css("display", "none");

		clearall();
		$.post("load_report.php", {type:repttype,fromdt:'',todt:'',bydate:''},
			function(data)
				{
					data=$.trim(data);
					$('#reportload').html(data);
				});
    }
    else if(repttype=="tax_detailed_cnb")
	{   $('#module_div').hide();
		$('#stewardtimelydiv').css("display","none");
		$('#regeneratebilllogs').css("display","none");
		$('#tot_sales_timelydiv').css("display","none");
		$('#timelyitemorderdiv').css("display","none");
		$('#summary_hamdiv').css("display","none");
		$('#tableturnoversummarydiv').css("display","none");
		$('#tableturnoverdiv').css("display","none");
		$('#foodcostingdiv').css("display","none");
		$('#prnt').css("display","block");
		$('#endof_sale_report').css("display","none");
		$('#feedbacksummarydiv').css("display","none");
		$('#excel').css("display","block");
        $('#stewardperformance').css("display", "none");
		$('#menuratingdiv').css("display","none");
		$('#feedbackdiv').css("display","none");
		$('#loyalitydiv').css("display","none");
		$('#kothistorydiv').css("display","none");
		$('#dailycostdiv').css("display","none");
		$('#creditdetailsdiv').css("display","none");
		$('#summarydiv').css("display", "block");
		$('#billreportdiv').css("display", "none");
		$('#kotsalesdiv').css("display", "none");
		$('#totalcancelbilldiv').css("display", "none");
		$('#totalsalesdiv').css("display", "none");
		$('#totalpaydiv').css("display", "none");
		$('#itemselectdiv').css("display", "none");
		$('#totalorderdiv').css("display", "none");
		$('#totalsteward').css("display", "none");
		$('#typooforder').css("display", "none");
		$('#totalportion').css("display", "none");
		$('#cancelhistorydiv').css("display", "none");	
		$('#discountsalesdiv').css("display", "none");
        $('#turnoverdiv').css("display", "none");
		$('#complementarydiv').css("display", "none");
		$('#generalratingdiv').css("display","none");
        $('#totalsummarydetailsdiv').css("display", "none");
        $('#kitchenorderdiv').css("display", "none");
        $('#categorywise_reportdiv').css("display","none");
        $('#menu_typediv').css("display", "none");
        $('#bill_sort_div').css("display", "none");
        $('#condition').css("display", "none");

		clearall();

		$.post("load_report.php", {type:repttype,fromdt:'',todt:'',bydate:''},
			function(data)
				{
					data=$.trim(data);
					$('#reportload').html(data);
				});
    }
	else if(repttype=="no_sale_report")
	{   
		$('#module_div').hide();
		$('#endof_sale_report').css("display","block");
		$('#regeneratebilllogs').css("display","none");
		$('#stewardtimelydiv').css("display","none");
		$('#totalsalesdiv').css("display", "none");
		$('#summary_hamdiv').css("display","none");
		$('#tableturnoversummarydiv').css("display","none");
		$('#tableturnoverdiv').css("display","none");
		$('#foodcostingdiv').css("display","none");
		$('#feedbacksummarydiv').css("display","none");
		$('#excel').css("display","block");
		$('#prnt').css("display","block");
		$('#menuratingdiv').css("display","none");
		$('#feedbackdiv').css("display","none");
		$('#loyalitydiv').css("display","none");
        $('#stewardperformance').css("display", "none");
		$('#kothistorydiv').css("display","none");
		$('#dailycostdiv').css("display","none");
		$('#creditdetailsdiv').css("display","none");
		$('#billreportdiv').css("display", "none");
		$('#summarydiv').css("display", "none");
		$('#kotsalesdiv').css("display", "none");
		$('#totalcancelbilldiv').css("display", "none");
		$('#totalpaydiv').css("display", "none");
		$('#itemselectdiv').css("display", "none");
		$('#totalorderdiv').css("display", "none");
		$('#totalsteward').css("display", "none");
		$('#typooforder').css("display", "none");
		$('#totalportion').css("display", "none");
		$('#cancelhistorydiv').css("display", "none");	
		$('#discountsalesdiv').css("display", "none");
        $('#turnoverdiv').css("display", "none");
		$('#complementarydiv').css("display", "none");
		$('#generalratingdiv').css("display","none");
		$('#timelyitemorderdiv').css("display","none");
		$('#tot_sales_timelydiv').css("display","none");
        $('#totalsummarydetailsdiv').css("display", "none");
        $('#kitchenorderdiv').css("display", "none");
        $('#categorywise_reportdiv').css("display","none");
        $('#menu_typediv').css("display", "none");
        $('#bill_sort_div').css("display", "none");
        $('#condition').css("display", "none");

		clearall();
		var floorwise=$('#floorwise').val();
		$.post("load_report.php", {type:repttype},
			function(data)
				{
					data=$.trim(data);
					$('#reportload').html(data);
				});	
	}

	else if(repttype=="tot_sales_timely")
	{   
		$('#module_div').hide();
		$('#tot_sales_timelydiv').css("display","block");
		$('#regeneratebilllogs').css("display","none");
		$('#endof_sale_report').css("display","none");
		$('#stewardtimelydiv').css("display","none");
		$('#summary_hamdiv').css("display","none");
		$('#tableturnoversummarydiv').css("display","none");
		$('#tableturnoverdiv').css("display","none");
		$('#foodcostingdiv').css("display","none");
		$('#prnt').css("display","block");
		$('#feedbacksummarydiv').css("display","none");
		$('#excel').css("display","block");
        $('#stewardperformance').css("display", "none");
		$('#menuratingdiv').css("display","none");
		$('#feedbackdiv').css("display","none");
		$('#loyalitydiv').css("display","none");
		$('#kothistorydiv').css("display","none");
		$('#dailycostdiv').css("display","none");
		$('#creditdetailsdiv').css("display","none");
		$('#summarydiv').css("display", "none");
		$('#billreportdiv').css("display", "none");
		$('#kotsalesdiv').css("display", "none");
		$('#totalcancelbilldiv').css("display", "none");
		$('#totalsalesdiv').css("display", "none");
		$('#totalpaydiv').css("display", "none");
		$('#itemselectdiv').css("display", "none");
		$('#totalorderdiv').css("display", "none");
		$('#totalsteward').css("display", "none");
		$('#typooforder').css("display", "none");
		$('#totalportion').css("display", "none");
		$('#cancelhistorydiv').css("display", "none");	
		$('#discountsalesdiv').css("display", "none");
		$('#turnoverdiv').css("display", "none");
		$('#complementarydiv').css("display", "none");
		$('#generalratingdiv').css("display","none");
		$('#timelyitemorderdiv').css("display","none");
        $('#totalsummarydetailsdiv').css("display", "none");
        $('#kitchenorderdiv').css("display", "none");
        $('#categorywise_reportdiv').css("display","none");
        $('#menu_typediv').css("display", "none");
        $('#bill_sort_div').css("display", "none");
		$('#condition').css("display", "none");
	}
	else if(repttype=="items_ordered_timely")
	{   
		$('#module_div').hide();
		$('#stewardtimelydiv').css("display","none");
		$('#regeneratebilllogs').css("display","none");
		$('#tot_sales_timelydiv').css("display","none");
		$('#summary_hamdiv').css("display","none");
		$('#tableturnoversummarydiv').css("display","none");
		$('#tableturnoverdiv').css("display","none");
		$('#foodcostingdiv').css("display","none");
		$('#prnt').css("display","block");
		$('#feedbacksummarydiv').css("display","none");
		$('#excel').css("display","block");
		$('#menuratingdiv').css("display","none");
		$('#feedbackdiv').css("display","none");
		$('#loyalitydiv').css("display","none");
		$('#kothistorydiv').css("display","none");
		$('#dailycostdiv').css("display","none");
        $('#stewardperformance').css("display", "none");
		$('#creditdetailsdiv').css("display","none");
		$('#summarydiv').css("display", "none");
		$('#billreportdiv').css("display", "none");
		$('#kotsalesdiv').css("display", "none");
		$('#totalcancelbilldiv').css("display", "none");
		$('#totalsalesdiv').css("display", "none");
		$('#totalpaydiv').css("display", "none");
		$('#itemselectdiv').css("display", "none");
		$('#totalorderdiv').css("display", "none");
		$('#totalsteward').css("display", "none");
		$('#typooforder').css("display", "none");
		$('#totalportion').css("display", "none");
		$('#cancelhistorydiv').css("display", "none");	
		$('#discountsalesdiv').css("display", "none");
        $('#turnoverdiv').css("display", "none");
		$('#complementarydiv').css("display", "none");
		$('#generalratingdiv').css("display","none");
		$('#timelyitemorderdiv').css("display","block");
		$('#endof_sale_report').css("display","none");
        $('#totalsummarydetailsdiv').css("display", "none");
        $('#kitchenorderdiv').css("display", "none");
        $('#categorywise_reportdiv').css("display","none");
        $('#menu_typediv').css("display", "none");
        $('#bill_sort_div').css("display", "none");
    	$('#condition').css("display", "none");	
	}
	else if(repttype=="complementary_report")
	{   
		$('#module_div').hide();
		$('#stewardtimelydiv').css("display","none");
		$('#regeneratebilllogs').css("display","none");
		$('#tot_sales_timelydiv').css("display","none");
		$('#timelyitemorderdiv').css("display","none");
		$('#summary_hamdiv').css("display","none");
		$('#tableturnoversummarydiv').css("display","none");
		$('#tableturnoverdiv').css("display","none");
		$('#foodcostingdiv').css("display","none");
		$('#prnt').css("display","block");
		$('#feedbacksummarydiv').css("display","none");
		$('#excel').css("display","block");
        $('#stewardperformance').css("display", "none");
		$('#menuratingdiv').css("display","none");
		$('#feedbackdiv').css("display","none");
		$('#loyalitydiv').css("display","none");
		$('#kothistorydiv').css("display","none");
		$('#dailycostdiv').css("display","none");
		$('#creditdetailsdiv').css("display","none");
		$('#summarydiv').css("display", "none");
		$('#billreportdiv').css("display", "none");
		$('#kotsalesdiv').css("display", "none");
		$('#totalcancelbilldiv').css("display", "none");
		$('#totalsalesdiv').css("display", "none");
		$('#totalpaydiv').css("display", "none");
		$('#itemselectdiv').css("display", "none");
		$('#totalorderdiv').css("display", "none");
		$('#totalsteward').css("display", "none");
		$('#typooforder').css("display", "none");
		$('#totalportion').css("display", "none");
		$('#cancelhistorydiv').css("display", "none");	
		$('#discountsalesdiv').css("display", "none");
        $('#turnoverdiv').css("display", "none");
		$('#complementarydiv').css("display", "block");
		$('#generalratingdiv').css("display","none");
		$('#endof_sale_report').css("display","none");
    	$('#totalsummarydetailsdiv').css("display", "none");
        $('#kitchenorderdiv').css("display", "none");
        $('#categorywise_reportdiv').css("display","none");
        $('#menu_typediv').css("display", "none");
        $('#bill_sort_div').css("display", "none");
        $('#condition').css("display", "none");
	}
	else if(repttype=="summary")
	{   
		$('#module_div').hide();
		$('#stewardtimelydiv').css("display","none");
		$('#regeneratebilllogs').css("display","none");
		$('#tot_sales_timelydiv').css("display","none");
		$('#timelyitemorderdiv').css("display","none");
		$('#summary_hamdiv').css("display","none");
		$('#tableturnoversummarydiv').css("display","none");
		$('#tableturnoverdiv').css("display","none");
		$('#foodcostingdiv').css("display","none");
		$('#prnt').css("display","block");
		$('#endof_sale_report').css("display","none");
		$('#feedbacksummarydiv').css("display","none");
		$('#excel').css("display","block");
        $('#stewardperformance').css("display", "none");
		$('#menuratingdiv').css("display","none");
		$('#feedbackdiv').css("display","none");
		$('#loyalitydiv').css("display","none");
		$('#kothistorydiv').css("display","none");
		$('#dailycostdiv').css("display","none");
		$('#creditdetailsdiv').css("display","none");
		$('#summarydiv').css("display", "block");
		$('#billreportdiv').css("display", "none");
		$('#kotsalesdiv').css("display", "none");
		$('#totalcancelbilldiv').css("display", "none");
		$('#totalsalesdiv').css("display", "none");
		$('#totalpaydiv').css("display", "none");
		$('#itemselectdiv').css("display", "none");
		$('#totalorderdiv').css("display", "none");
		$('#totalsteward').css("display", "none");
		$('#typooforder').css("display", "none");
		$('#totalportion').css("display", "none");
		$('#cancelhistorydiv').css("display", "none");	
		$('#discountsalesdiv').css("display", "none");
        $('#turnoverdiv').css("display", "none");
		$('#complementarydiv').css("display", "none");
		$('#generalratingdiv').css("display","none");
        $('#totalsummarydetailsdiv').css("display", "none");
        $('#kitchenorderdiv').css("display", "none");
        $('#categorywise_reportdiv').css("display","none");
        $('#menu_typediv').css("display", "none");
        $('#bill_sort_div').css("display", "none");
        $('#condition').css("display", "none");
		clearall();
		$.post("load_report.php", {type:repttype},
			function(data)
				{
					data=$.trim(data);
					$('#reportload').html(data);
				});
        }
        
    else if(repttype=="categorywise_report")
	{   
		$('#module_div').hide();
		$('#stewardtimelydiv').css("display","none");
		$('#regeneratebilllogs').css("display","none");
		$('#tot_sales_timelydiv').css("display","none");
		$('#timelyitemorderdiv').css("display","none");
		$('#summary_hamdiv').css("display","none");
		$('#tableturnoversummarydiv').css("display","none");
		$('#tableturnoverdiv').css("display","none");
		$('#foodcostingdiv').css("display","none");
		$('#prnt').css("display","block");
		$('#endof_sale_report').css("display","none");
		$('#feedbacksummarydiv').css("display","none");
		$('#excel').css("display","block");
        $('#stewardperformance').css("display", "none");
		$('#menuratingdiv').css("display","none");
		$('#feedbackdiv').css("display","none");
		$('#loyalitydiv').css("display","none");
		$('#kothistorydiv').css("display","none");
		$('#dailycostdiv').css("display","none");
		$('#creditdetailsdiv').css("display","none");
		$('#totalsummarydetailsdiv').css("display", "none");
		$('#billreportdiv').css("display", "none");
		$('#kotsalesdiv').css("display", "none");
		$('#totalcancelbilldiv').css("display", "none");
		$('#totalsalesdiv').css("display", "none");
		$('#totalpaydiv').css("display", "none");
		$('#itemselectdiv').css("display", "none");
		$('#totalorderdiv').css("display", "none");
		$('#totalsteward').css("display", "none");
		$('#typooforder').css("display", "none");
		$('#totalportion').css("display", "none");
		$('#cancelhistorydiv').css("display", "none");	
		$('#discountsalesdiv').css("display", "none");
        $('#turnoverdiv').css("display", "none");
		$('#complementarydiv').css("display", "none");
		$('#generalratingdiv').css("display","none");
   	    $('#summarydiv').css("display", "none");
        $('#kitchenorderdiv').css("display", "none");
        $('#categorywise_reportdiv').css("display","block");
        $('#menu_typediv').css("display", "none");
        $('#bill_sort_div').css("display", "none");
        $('#condition').css("display", "none");              
		clearall();
		$.post("load_report.php", {type:repttype,fromdt:'',todt:'',bydate:''},
			function(data)
				{ 
					data=$.trim(data);
					$('#reportload').html(data);
				});	
	}
    else if(repttype=="total_summary_details")
	{
        $('#module_div').hide();
		$('#stewardtimelydiv').css("display","none");
		$('#regeneratebilllogs').css("display","none");
		$('#tot_sales_timelydiv').css("display","none");
		$('#timelyitemorderdiv').css("display","none");
		$('#summary_hamdiv').css("display","none");
		$('#tableturnoversummarydiv').css("display","none");
		$('#tableturnoverdiv').css("display","none");
		$('#foodcostingdiv').css("display","none");
		$('#prnt').css("display","block");
		$('#endof_sale_report').css("display","none");
		$('#feedbacksummarydiv').css("display","none");
		$('#excel').css("display","block");
        $('#stewardperformance').css("display", "none");
		$('#menuratingdiv').css("display","none");
		$('#feedbackdiv').css("display","none");
		$('#loyalitydiv').css("display","none");
		$('#kothistorydiv').css("display","none");
		$('#dailycostdiv').css("display","none");
		$('#creditdetailsdiv').css("display","none");
		$('#totalsummarydetailsdiv').css("display", "block");
		$('#billreportdiv').css("display", "none");
		$('#kotsalesdiv').css("display", "none");
		$('#totalcancelbilldiv').css("display", "none");
		$('#totalsalesdiv').css("display", "none");
		$('#totalpaydiv').css("display", "none");
		$('#itemselectdiv').css("display", "none");
		$('#totalorderdiv').css("display", "none");
		$('#totalsteward').css("display", "none");
		$('#typooforder').css("display", "none");
		$('#totalportion').css("display", "none");
		$('#cancelhistorydiv').css("display", "none");	
		$('#discountsalesdiv').css("display", "none");
        $('#turnoverdiv').css("display", "none");
		$('#complementarydiv').css("display", "none");
		$('#generalratingdiv').css("display","none");
        $('#summarydiv').css("display", "none");
        $('#kitchenorderdiv').css("display", "none");
        $('#categorywise_reportdiv').css("display","none");
        $('#menu_typediv').css("display", "none");
        $('#bill_sort_div').css("display", "none");
        $('#condition').css("display", "none");
		clearall();
		$.post("load_report.php", {type:repttype},
			function(data)
				{
					data=$.trim(data);
					$('#reportload').html(data);
				});
	}
    else if(repttype=="discount_report")
	{
        $('#module_div').hide();
		$('#stewardtimelydiv').css("display","none");
		$('#regeneratebilllogs').css("display","none");
		$('#endof_sale_report').css("display","none");
	    $('#tot_sales_timelydiv').css("display","none"); 
		$('#timelyitemorderdiv').css("display","none");
		$('#summary_hamdiv').css("display","none");
		$('#tableturnoversummarydiv').css("display","none");
		$('#tableturnoverdiv').css("display","none");
		$('#foodcostingdiv').css("display","none");
		$('#prnt').css("display","block");
        $('#stewardperformance').css("display", "none");
		$('#feedbacksummarydiv').css("display","none");
		$('#excel').css("display","block");
		$('#menuratingdiv').css("display","none");
		$('#feedbackdiv').css("display","none");
		$('#loyalitydiv').css("display","none");
		$('#kothistorydiv').css("display","none");
		$('#dailycostdiv').css("display","none");
		$('#creditdetailsdiv').css("display","none");
		$('#summarydiv').css("display", "none");
		$('#billreportdiv').css("display", "none");
		$('#kotsalesdiv').css("display", "none");
		$('#totalcancelbilldiv').css("display", "none");
		$('#totalsalesdiv').css("display", "none");
		$('#discountsalesdiv').css("display", "block");
		$('#totalpaydiv').css("display", "none");
		$('#itemselectdiv').css("display", "none");
		$('#totalorderdiv').css("display", "none");
		$('#totalsteward').css("display", "none");
		$('#typooforder').css("display", "none");
		$('#totalportion').css("display", "none");
		$('#cancelhistorydiv').css("display", "none");	
		$('#complementarydiv').css("display", "none");
		$('#generalratingdiv').css("display","none");
        $('#totalsummarydetailsdiv').css("display", "none");
        $('#kitchenorderdiv').css("display", "none");
        $('#categorywise_reportdiv').css("display","none");
        $('#menu_typediv').css("display", "none");
        $('#bill_sort_div').css("display", "none");
        $('#condition').css("display", "none");
		clearall();
		$.post("load_report.php", {type:repttype},
			function(data)
				{
					data=$.trim(data);
					$('#reportload').html(data);
				});	
	}  
	else if(repttype=="regenerate_bill_logs")
	{
		$('#regeneratebilllogs').css("display","block");
		$('#module_div').hide();
		$('#stewardtimelydiv').css("display","none");
		$('#endof_sale_report').css("display","none");
		$('#tot_sales_timelydiv').css("display","none"); 
		$('#timelyitemorderdiv').css("display","none");
		$('#summary_hamdiv').css("display","none");
		$('#tableturnoversummarydiv').css("display","none");
		$('#tableturnoverdiv').css("display","none");
		$('#foodcostingdiv').css("display","none");
		$('#prnt').css("display","block");
        $('#stewardperformance').css("display", "none");
		$('#feedbacksummarydiv').css("display","none");
		$('#excel').css("display","block");
		$('#menuratingdiv').css("display","none");
		$('#feedbackdiv').css("display","none");
		$('#loyalitydiv').css("display","none");
		$('#kothistorydiv').css("display","none");
		$('#dailycostdiv').css("display","none");
		$('#creditdetailsdiv').css("display","none");
		$('#summarydiv').css("display", "none");
		$('#billreportdiv').css("display", "none");
		$('#kotsalesdiv').css("display", "none");
		$('#totalcancelbilldiv').css("display", "none");
		$('#totalsalesdiv').css("display", "none");
		$('#discountsalesdiv').css("display", "none");
		$('#totalpaydiv').css("display", "none");
		$('#itemselectdiv').css("display", "none");
		$('#totalorderdiv').css("display", "none");
		$('#totalsteward').css("display", "none");
		$('#typooforder').css("display", "none");
		$('#totalportion').css("display", "none");
		$('#cancelhistorydiv').css("display", "none");	
		$('#complementarydiv').css("display", "none");
		$('#generalratingdiv').css("display","none");
        $('#totalsummarydetailsdiv').css("display", "none");
        $('#kitchenorderdiv').css("display", "none");
        $('#categorywise_reportdiv').css("display","none");
        $('#menu_typediv').css("display", "none");
        $('#bill_sort_div').css("display", "none");
        $('#condition').css("display", "none");
		clearall();
		$.post("load_report.php", {type:repttype,fromdt:'',todt:'',bydate:''},
			function(data)
				{
					data=$.trim(data);
					$('#reportload').html(data);
				});	
	}
	else if(repttype=="kot_report")
	{
        $('#module_div').hide();
		$('#stewardtimelydiv').css("display","none");
		$('#regeneratebilllogs').css("display","none");
		$('#tot_sales_timelydiv').css("display","none");
		$('#timelyitemorderdiv').css("display","none");
		$('#summary_hamdiv').css("display","none");
		$('#tableturnoversummarydiv').css("display","none");
		$('#tableturnoverdiv').css("display","none");
		$('#foodcostingdiv').css("display","none");
		$('#prnt').css("display","block");
        $('#stewardperformance').css("display", "none");
		$('#endof_sale_report').css("display","none");
		$('#feedbacksummarydiv').css("display","none");
		$('#excel').css("display","block");
		$('#menuratingdiv').css("display","none");
		$('#feedbackdiv').css("display","none");
		$('#loyalitydiv').css("display","none");
		$('#kothistorydiv').css("display","none");
		$('#dailycostdiv').css("display","none");
		$('#creditdetailsdiv').css("display","none");
		$('#billreportdiv').css("display", "none");
		$('#summarydiv').css("display", "none");
	    $('#kotsalesdiv').css("display", "block");
		$('#totalcancelbilldiv').css("display", "none");
		$('#totalsalesdiv').css("display", "none");
		$('#discountsalesdiv').css("display", "none");
		$('#totalpaydiv').css("display", "none");
		$('#itemselectdiv').css("display", "none");
		$('#totalorderdiv').css("display", "none");
		$('#totalsteward').css("display", "none");
		$('#typooforder').css("display", "none");
		$('#totalportion').css("display", "none");
		$('#cancelhistorydiv').css("display", "none");	
		$('#complementarydiv').css("display", "none");
		$('#generalratingdiv').css("display","none");
        $('#totalsummarydetailsdiv').css("display", "none");
        $('#kitchenorderdiv').css("display", "none");
        $('#categorywise_reportdiv').css("display","none");
        $('#menu_typediv').css("display", "none");
        $('#bill_sort_div').css("display", "none");
        $('#condition').css("display", "none");
		clearall();
		$.post("load_report.php", {type:repttype},
			function(data)
				{
					data=$.trim(data);
					$('#reportload').html(data);
				});
	}
	else if(repttype=="bill_cancel")
	{ 	
		$('#module_div').hide();
		$('#stewardtimelydiv').css("display","none");
		$('#tot_sales_timelydiv').css("display","none");
		$('#regeneratebilllogs').css("display","none");
		$('#timelyitemorderdiv').css("display","none");
		$('#summary_hamdiv').css("display","none");
		$('#tableturnoversummarydiv').css("display","none");
		$('#tableturnoverdiv').css("display","none");
		$('#foodcostingdiv').css("display","none");
		$('#endof_sale_report').css("display","none");
		$('#prnt').css("display","block");
		$('#feedbacksummarydiv').css("display","none");
		$('#excel').css("display","block");
		$('#menuratingdiv').css("display","none");
		$('#feedbackdiv').css("display","none");
		$('#loyalitydiv').css("display","none");
		$('#kothistorydiv').css("display","none");
		$('#dailycostdiv').css("display","none");
        $('#stewardperformance').css("display", "none");
		$('#creditdetailsdiv').css("display","none");
		$('#billreportdiv').css("display", "none");
		$('#summarydiv').css("display", "none");
		$('#kotsalesdiv').css("display", "none");
		$('#discountsalesdiv').css("display", "none");
		$('#totalsalesdiv').css("display", "none");
		$('#totalcancelbilldiv').css("display", "block");
		$('#totalpaydiv').css("display", "none");
		$('#itemselectdiv').css("display", "none");
		$('#totalorderdiv').css("display", "none");
		$('#totalsteward').css("display", "none");
		$('#typooforder').css("display", "none");
		$('#totalportion').css("display", "none");
		$('#cancelhistorydiv').css("display", "none");	
		$('#complementarydiv').css("display", "none");
		$('#generalratingdiv').css("display","none");
        $('#totalsummarydetailsdiv').css("display", "none");
        $('#kitchenorderdiv').css("display", "none");
        $('#categorywise_reportdiv').css("display","none");
        $('#menu_typediv').css("display", "none");
        $('#bill_sort_div').css("display", "none");
        $('#condition').css("display", "none");
		clearall();
		$.post("load_report.php", {type:repttype,fromdt:'',todt:'',bydate:''},
			function(data)
				{
					data=$.trim(data);
					$('#reportload').html(data);
				});	
	}
	else if(repttype=="bill_details")
	{ 
		$('#module_div').hide();
		$('#stewardtimelydiv').css("display","none");
		$('#tot_sales_timelydiv').css("display","none");
		$('#timelyitemorderdiv').css("display","none");
		$('#regeneratebilllogs').css("display","none");
		$('#summary_hamdiv').css("display","none");
		$('#tableturnoversummarydiv').css("display","none");
		$('#tableturnoverdiv').css("display","none");
		$('#foodcostingdiv').css("display","none");
		$('#prnt').css("display","block");
		$('#endof_sale_report').css("display","none");
		$('#feedbacksummarydiv').css("display","none");
		$('#excel').css("display","block");
        $('#stewardperformance').css("display", "none");
		$('#menuratingdiv').css("display","none");
		$('#feedbackdiv').css("display","none");
		$('#loyalitydiv').css("display","none");
		$('#kothistorydiv').css("display","none");
		$('#dailycostdiv').css("display","none");
		$('#creditdetailsdiv').css("display","none");
		$('#billreportdiv').css("display", "block");
		$('#summarydiv').css("display", "none");
	    $('#kotsalesdiv').css("display", "none");
		$('#totalcancelbilldiv').css("display", "none");
		$('#totalsalesdiv').css("display", "none");
		$('#discountsalesdiv').css("display", "none");
		$('#totalpaydiv').css("display", "none");
		$('#itemselectdiv').css("display", "none");
		$('#totalorderdiv').css("display", "none");
		$('#totalsteward').css("display", "none");
		$('#typooforder').css("display", "none");
		$('#totalportion').css("display", "none");
		$('#cancelhistorydiv').css("display", "none");	
		$('#complementarydiv').css("display", "none");
		$('#generalratingdiv').css("display","none");
        $('#totalsummarydetailsdiv').css("display", "none");
        $('#kitchenorderdiv').css("display", "none");
        $('#categorywise_reportdiv').css("display","none");
        $('#menu_typediv').css("display", "none");
        $('#bill_sort_div').css("display", "block");
        $('#bill_sort').find('option:first').prop('selected','selected');
        $('#condition').css("display", "none");
        var sortby=$('#bill_sort').val();
		clearall();
		$.post("load_report.php", {type:repttype,fromdt:'',bydate:'',todt:'',sortby:sortby},
		function(data)
			{
				data=$.trim(data);
				$('#reportload').html(data);
			});
	}
	else if(repttype=="type_pay")
	{    
		$('#module_div').hide();
		$('#stewardtimelydiv').css("display","none");
		$('#tot_sales_timelydiv').css("display","none");
		$('#timelyitemorderdiv').css("display","none");
		$('#regeneratebilllogs').css("display","none");
		$('#summary_hamdiv').css("display","none");
		$('#tableturnoversummarydiv').css("display","none");
		$('#tableturnoverdiv').css("display","none");
		$('#foodcostingdiv').css("display","none");
		$('#prnt').css("display","block");
        $('#stewardperformance').css("display", "none");
		$('#feedbacksummarydiv').css("display","none");
		$('#endof_sale_report').css("display","none");
		$('#excel').css("display","block");
		$('#menuratingdiv').css("display","none");
		$('#feedbackdiv').css("display","none");
		$('#loyalitydiv').css("display","none");
		$('#kothistorydiv').css("display","none");
		$('#dailycostdiv').css("display","none");
		$('#creditdetailsdiv').css("display","none");
		$('#billreportdiv').css("display", "none");
		$('#summarydiv').css("display", "none");
		$('#kotsalesdiv').css("display", "none");
		$('#discountsalesdiv').css("display", "none");
		$('#totalcancelbilldiv').css("display", "none");
		$('#datepickerfrom').val("");
		$('#datepickertodt').val("");
		$('#totalsalesdiv').css("display", "none");
		$('#totalorderdiv').css("display", "none");
		$('#itemselectdiv').css("display", "none");
		$('#reportload').html("");
		$('#totalpaydiv').css("display", "block");
		$('#totalsteward').css("display", "none");
		$('#typooforder').css("display", "none");
		$('#totalportion').css("display", "none");	
		$('#cancelhistorydiv').css("display", "none");
		$('#complementarydiv').css("display", "none");
		$('#generalratingdiv').css("display","none");
    	$('#totalsummarydetailsdiv').css("display", "none");
        $('#kitchenorderdiv').css("display", "none");
        $('#categorywise_reportdiv').css("display","none");
        $('#menu_typediv').css("display", "none");
        $('#bill_sort_div').css("display", "none");
        $('#condition').css("display", "none");
		clearall();
	}
	else if(repttype=="item")
	{
        $('#module_div').show();
		$('#stewardtimelydiv').css("display","none");
		$('#tot_sales_timelydiv').css("display","none");
		$('#regeneratebilllogs').css("display","none");
		$('#timelyitemorderdiv').css("display","none");
		$('#endof_sale_report').css("display","none");
		$('#summary_hamdiv').css("display","none");
		$('#tableturnoversummarydiv').css("display","none");
		$('#tableturnoverdiv').css("display","none");
		$('#foodcostingdiv').css("display","none");
		$('#prnt').css("display","block");
        $('#stewardperformance').css("display", "none");
		$('#feedbacksummarydiv').css("display","none");
		$('#excel').css("display","block");
		$('#menuratingdiv').css("display","none");
		$('#feedbackdiv').css("display","none");
		$('#loyalitydiv').css("display","none");
		$('#kothistorydiv').css("display","none");
		$('#dailycostdiv').css("display","none");
		$('#creditdetailsdiv').css("display","none");
		$('#billreportdiv').css("display", "none");
		$('#kotsalesdiv').css("display", "none");
		$('#discountsalesdiv').css("display", "none");
		$('#totalcancelbilldiv').css("display", "none");
		$('#itemselectdiv').css("display", "block");
		$('#totalorderdiv').css("display", "none");
		$('#datepickerfrom').val("");
		$('#datepickertodt').val("");
		$('#datepickerfromtyp').val("");
		$('#datepickertodttyp').val("");
		$('#totalsalesdiv').css("display", "none");
		$('#totalpaydiv').css("display", "none");
		$('#totalsteward').css("display", "none");
		$('#typooforder').css("display", "none");
		$('#totalportion').css("display", "none");
		$('#cancelhistorydiv').css("display", "none");	
		$('#complementarydiv').css("display", "none");
		$('#generalratingdiv').css("display","none");
        $('#totalsummarydetailsdiv').css("display", "none");
        $('#kitchenorderdiv').css("display", "none");
		$('#reportload').html("");
        $('#categorywise_reportdiv').css("display","none");
        $('#menu_typediv').css("display", "none");
        $('#bill_sort_div').css("display", "none");
        $('#condition').css("display", "block");
		clearall();
        var mode=$('#mode_sec').val();                
        $.post("load_report.php", {type:repttype,floorvals:'',fromdt:'',bydate:'',todt:'',mode:mode},
			function(data)
				{
					data=$.trim(data);
					$('#reportload').html(data);
				});                     
	}
	else if(repttype=="steward")
	{   
		$('#module_div').hide();
		$('#stewardtimelydiv').css("display","none");
		$('#tot_sales_timelydiv').css("display","none");
		$('#regeneratebilllogs').css("display","none");
		$('#timelyitemorderdiv').css("display","none");
		$('#summary_hamdiv').css("display","none");
		$('#endof_sale_report').css("display","none");
		$('#tableturnoversummarydiv').css("display","none");
		$('#tableturnoverdiv').css("display","none");
		$('#foodcostingdiv').css("display","none");
		$('#prnt').css("display","block");
        $('#stewardperformance').css("display", "none");
		$('#feedbacksummarydiv').css("display","none");
		$('#excel').css("display","block");
		$('#menuratingdiv').css("display","none");
		$('#feedbackdiv').css("display","none");
		$('#loyalitydiv').css("display","none");
		$('#kothistorydiv').css("display","none");
		$('#dailycostdiv').css("display","none");
		$('#creditdetailsdiv').css("display","none");
		$('#billreportdiv').css("display", "none");
		$('#summarydiv').css("display", "none");
		$('#kotsalesdiv').css("display", "none");
		$('#discountsalesdiv').css("display", "none");
		$('#totalcancelbilldiv').css("display", "none");
		$('#totalsteward').css("display", "block");
		$('#itemselectdiv').css("display", "none");
		$('#totalorderdiv').css("display", "none");
		$('#totalsalesdiv').css("display", "none");
		$('#totalpaydiv').css("display", "none");
        $('#typooforder').css("display", "none");
		$('#totalportion').css("display", "none");	
		$('#cancelhistorydiv').css("display", "none");
		$('#complementarydiv').css("display", "none");
		$('#generalratingdiv').css("display","none");
        $('#totalsummarydetailsdiv').css("display", "none");
        $('#kitchenorderdiv').css("display", "none");
		$('#datepickerfrom').val("");
		$('#datepickertodt').val("");
		$('#reportload').html("");
        $('#categorywise_reportdiv').css("display","none");
        $('#menu_typediv').css("display", "none");
        $('#bill_sort_div').css("display", "none");
        $('#condition').css("display", "none");
		clearall();
		$.post("load_report.php", {type:repttype},
		function(data)
		{
			data=$.trim(data);
			$('#reportload').html(data);
		});
	}   
    else if(repttype=="stewards_performance_report")
	{ 
        $('#module_div').hide();
		$('#stewardtimelydiv').css("display","none");
		$('#tot_sales_timelydiv').css("display","none");
		$('#regeneratebilllogs').css("display","none");
		$('#timelyitemorderdiv').css("display","none");
		$('#summary_hamdiv').css("display","none");
		$('#endof_sale_report').css("display","none");
		$('#tableturnoversummarydiv').css("display","none");
		$('#tableturnoverdiv').css("display","none");
		$('#foodcostingdiv').css("display","none");
		$('#prnt').css("display","block");
        $('#stewardperformance').css("display", "none");
		$('#feedbacksummarydiv').css("display","none");
		$('#excel').css("display","block");
		$('#menuratingdiv').css("display","none");
		$('#feedbackdiv').css("display","none");
		$('#loyalitydiv').css("display","none");
		$('#kothistorydiv').css("display","none");
		$('#dailycostdiv').css("display","none");
		$('#creditdetailsdiv').css("display","none");
		$('#billreportdiv').css("display", "none");
		$('#summarydiv').css("display", "none");
		$('#kotsalesdiv').css("display", "none");
		$('#discountsalesdiv').css("display", "none");
        $('#totalcancelbilldiv').css("display", "none");
		$('#totalsteward').css("display", "none");
        $('#stewardperformance').css("display", "block");
		$('#itemselectdiv').css("display", "none");
		$('#totalorderdiv').css("display", "none");
		$('#totalsalesdiv').css("display", "none");
		$('#totalpaydiv').css("display", "none");
        $('#typooforder').css("display", "none");
		$('#totalportion').css("display", "none");	
		$('#cancelhistorydiv').css("display", "none");
		$('#complementarydiv').css("display", "none");
		$('#generalratingdiv').css("display","none");
        $('#totalsummarydetailsdiv').css("display", "none");
        $('#kitchenorderdiv').css("display", "none");
		$('#datepickerfrom').val("");
		$('#datepickertodt').val("");
		$('#reportload').html("");
        $('#categorywise_reportdiv').css("display","none");
        $('#menu_typediv').css("display", "none");
        $('#bill_sort_div').css("display", "none");
        $('#condition').css("display", "none");
		clearall();
		$.post("load_report.php", {type:repttype},
		function(data)
		{
			data=$.trim(data);
			$('#reportload').html(data);
		});
	}  
	else if(repttype =="steward_timely")
	{
        $('#module_div').hide();
		$('#stewardtimelydiv').css("display","block");
		$('#endof_sale_report').css("display","none");
		$('#tot_sales_timelydiv').css("display","none");
		$('#regeneratebilllogs').css("display","none");
		$('#timelyitemorderdiv').css("display","none");
		$('#summary_hamdiv').css("display","none");
		$('#tableturnoversummarydiv').css("display","none");
		$('#tableturnoverdiv').css("display","none");
		$('#foodcostingdiv').css("display","none");
		$('#prnt').css("display","block");
		$('#feedbacksummarydiv').css("display","none");
		$('#excel').css("display","block");
        $('#stewardperformance').css("display", "none");
		$('#menuratingdiv').css("display","none");
		$('#feedbackdiv').css("display","none");
		$('#loyalitydiv').css("display","none");
		$('#kothistorydiv').css("display","none");
		$('#dailycostdiv').css("display","none");
		$('#creditdetailsdiv').css("display","none");
		$('#billreportdiv').css("display", "none");
		$('#summarydiv').css("display", "none");
		$('#kotsalesdiv').css("display", "none");
		$('#discountsalesdiv').css("display", "none");
		$('#totalcancelbilldiv').css("display", "none");
		$('#totalsteward').css("display", "none");
		$('#itemselectdiv').css("display", "none");
		$('#totalorderdiv').css("display", "none");
		$('#totalsalesdiv').css("display", "none");
		$('#totalpaydiv').css("display", "none");
        $('#typooforder').css("display", "none");
		$('#totalportion').css("display", "none");	
		$('#cancelhistorydiv').css("display", "none");
		$('#complementarydiv').css("display", "none");
		$('#generalratingdiv').css("display","none");
        $('#totalsummarydetailsdiv').css("display", "none");
        $('#kitchenorderdiv').css("display", "none");
		$('#datepickerfrom').val("");
		$('#datepickertodt').val("");
		$('#reportload').html("");
        $('#categorywise_reportdiv').css("display","none");
        $('#menu_typediv').css("display", "none");
        $('#bill_sort_div').css("display", "none");
        $('#condition').css("display", "none");
		clearall();
		$.post("load_report.php", {type:repttype},
		function(data)
		{
			data=$.trim(data);
			$('#reportload').html(data);
		});
	}
    else if(repttype=="order")
	{
        $('#module_div').hide();
		$('#stewardtimelydiv').css("display","none");
		$('#regeneratebilllogs').css("display","none");
		$('#tot_sales_timelydiv').css("display","none");
		$('#timelyitemorderdiv').css("display","none");
		$('#summary_hamdiv').css("display","none");
		$('#tableturnoversummarydiv').css("display","none");
		$('#tableturnoverdiv').css("display","none");
		$('#foodcostingdiv').css("display","none");
		$('#prnt').css("display","block");
		$('#endof_sale_report').css("display","none");
		$('#feedbacksummarydiv').css("display","none");
		$('#excel').css("display","block");
        $('#stewardperformance').css("display", "none");
		$('#menuratingdiv').css("display","none");
		$('#feedbackdiv').css("display","none");
		$('#loyalitydiv').css("display","none");
		$('#kothistorydiv').css("display","none");
		$('#dailycostdiv').css("display","none");
		$('#creditdetailsdiv').css("display","none");
		$('#totalsummarydetailsdiv').css("display", "none");
		$('#billreportdiv').css("display", "none");
		$('#kotsalesdiv').css("display", "none");
		$('#totalcancelbilldiv').css("display", "none");
		$('#totalsalesdiv').css("display", "block");
		$('#totalpaydiv').css("display", "none");
		$('#itemselectdiv').css("display", "none");
		$('#totalorderdiv').css("display", "none");
		$('#totalsteward').css("display", "none");
		$('#typooforder').css("display", "none");
		$('#totalportion').css("display", "none");
		$('#cancelhistorydiv').css("display", "none");	
		$('#discountsalesdiv').css("display", "none");
        $('#turnoverdiv').css("display", "none");
		$('#complementarydiv').css("display", "none");
		$('#generalratingdiv').css("display","none");
        $('#summarydiv').css("display", "none");
        $('#kitchenorderdiv').css("display", "none");
        $('#categorywise_reportdiv').css("display","none");
        $('#menu_typediv').css("display", "block");
        $('#bill_sort_div').css("display", "none");
        $('#condition').css("display", "none");
		$.post("load_report.php", {type:repttype,fromdt:'',todt:'',bydate:'',addon:''},
			function(data)
				{
					data=$.trim(data);
					$('#reportload').html(data);
				});	
	}
    else if(repttype=="total_summary_details")
	{
        $('#module_div').hide();
		$('#stewardtimelydiv').css("display","none");
		$('#regeneratebilllogs').css("display","none");
		$('#tot_sales_timelydiv').css("display","none");
		$('#timelyitemorderdiv').css("display","none");
		$('#summary_hamdiv').css("display","none");
		$('#tableturnoversummarydiv').css("display","none");
		$('#tableturnoverdiv').css("display","none");
		$('#foodcostingdiv').css("display","none");
		$('#prnt').css("display","block");
		$('#endof_sale_report').css("display","none");
		$('#feedbacksummarydiv').css("display","none");
		$('#excel').css("display","block");
        $('#stewardperformance').css("display", "none");
		$('#menuratingdiv').css("display","none");
		$('#feedbackdiv').css("display","none");
		$('#loyalitydiv').css("display","none");
		$('#kothistorydiv').css("display","none");
		$('#dailycostdiv').css("display","none");
		$('#creditdetailsdiv').css("display","none");
		$('#totalsummarydetailsdiv').css("display", "block");
		$('#billreportdiv').css("display", "none");
		$('#kotsalesdiv').css("display", "none");
		$('#totalcancelbilldiv').css("display", "none");
		$('#totalsalesdiv').css("display", "none");
		$('#totalpaydiv').css("display", "none");
		$('#itemselectdiv').css("display", "none");
		$('#totalorderdiv').css("display", "none");
		$('#totalsteward').css("display", "none");
		$('#typooforder').css("display", "none");
		$('#totalportion').css("display", "none");
		$('#cancelhistorydiv').css("display", "none");	
		$('#discountsalesdiv').css("display", "none");
        $('#turnoverdiv').css("display", "none");
		$('#complementarydiv').css("display", "none");
		$('#generalratingdiv').css("display","none");
        $('#summarydiv').css("display", "none");
        $('#kitchenorderdiv').css("display", "none");
        $('#categorywise_reportdiv').css("display","none");
        $('#menu_typediv').css("display", "none");
        $('#bill_sort_div').css("display", "none");
        $('#condition').css("display", "none");
		clearall();
		$.post("load_report.php", {type:repttype},
			function(data)
				{
					data=$.trim(data);
					$('#reportload').html(data);
				});	
	}
    else if(repttype=="kitchen_wise")
	{
        $('#module_div').hide();
		$('#stewardtimelydiv').css("display","none");
		$('#tot_sales_timelydiv').css("display","none");
		$('#timelyitemorderdiv').css("display","none");
		$('#regeneratebilllogs').css("display","none");
		$('#summary_hamdiv').css("display","none");
		$('#endof_sale_report').css("display","none");
		$('#tableturnoversummarydiv').css("display","none");
		$('#tableturnoverdiv').css("display","none");
		$('#foodcostingdiv').css("display","none");
		$('#prnt').css("display","block");
		$('#feedbacksummarydiv').css("display","none");
		$('#excel').css("display","block");
        $('#stewardperformance').css("display", "none");
		$('#menuratingdiv').css("display","none");
		$('#feedbackdiv').css("display","none");
		$('#loyalitydiv').css("display","none");
		$('#dailycostdiv').css("display","none");
		$('#creditdetailsdiv').css("display","none");
		$('#billreportdiv').css("display", "none");
		$('#summarydiv').css("display", "none");
		$('#kotsalesdiv').css("display", "none");
		$('#discountsalesdiv').css("display", "none");
		$('#totalcancelbilldiv').css("display", "none");
        $('#totalorderdiv').css("display", "none");
        $('#kitchenorderdiv').css("display", "block");
		$('#kothistorydiv').css("display","none");
		$('#totalsteward').css("display", "none");
		$('#itemselectdiv').css("display", "none");
		$('#totalsalesdiv').css("display", "none");
		$('#totalpaydiv').css("display", "none");
		$('#typooforder').css("display", "none");
		$('#totalportion').css("display", "none");	
		$('#cancelhistorydiv').css("display", "none");
		$('#complementarydiv').css("display", "none");
		$('#generalratingdiv').css("display","none");
        $('#totalsummarydetailsdiv').css("display", "none");
        $('#menuitem').css("display", "none");
        $('#categorywise_reportdiv').css("display","none");
        $('#menu_typediv').css("display", "none");
        $('#bill_sort_div').css("display", "none");
        $('#condition').css("display", "none");;
        clearall();
		$.post("load_report.php", {type:repttype},
			function(data)
				{
					data=$.trim(data);
					$('#reportload').html(data);
				});	
	} 
	else if(repttype=="portion_order")
	{
        $('#module_div').hide();
	$('#stewardtimelydiv').css("display","none");
		$('#tot_sales_timelydiv').css("display","none");
		$('#timelyitemorderdiv').css("display","none");
		$('#endof_sale_report').css("display","none");
		$('#regeneratebilllogs').css("display","none");
		$('#summary_hamdiv').css("display","none");
		$('#tableturnoversummarydiv').css("display","none");
		$('#tableturnoverdiv').css("display","none");
		$('#foodcostingdiv').css("display","none");
		$('#prnt').css("display","block");
        $('#stewardperformance').css("display", "none");
		$('#feedbacksummarydiv').css("display","none");
		$('#excel').css("display","block");
		$('#menuratingdiv').css("display","none");
		$('#feedbackdiv').css("display","none");
		$('#loyalitydiv').css("display","none");
		$('#kothistorydiv').css("display","none");
		$('#dailycostdiv').css("display","none");
		$('#creditdetailsdiv').css("display","none");
		$('#billreportdiv').css("display", "none");
		$('#summarydiv').css("display", "none");
		$('#kotsalesdiv').css("display", "none");
		$('#discountsalesdiv').css("display", "none");
		$('#totalcancelbilldiv').css("display", "none");
		$('#datepickerfromdtprtn').val("");
		$('#datepickertodtprtn').val("");
		$('#totalsalesdiv').css("display", "none");
		$('#totalorderdiv').css("display", "none");
		$('#itemselectdiv').css("display", "none");
		$('#reportload').html("");
		$('#totalpaydiv').css("display", "none");
		$('#totalsteward').css("display", "none");
		$('#typooforder').css("display", "none");
		$('#totalportion').css("display", "block");	
		$('#cancelhistorydiv').css("display", "none");
		$('#complementarydiv').css("display", "none");
		$('#generalratingdiv').css("display","none");
        $('#totalsummarydetailsdiv').css("display", "none");
        $('#kitchenorderdiv').css("display", "none");
        $('#categorywise_reportdiv').css("display","none");
        $('#menu_typediv').css("display", "none");
        $('#bill_sort_div').css("display", "none");
        $('#condition').css("display", "none");
		clearall();
		$.post("load_report.php", {type:repttype},
		function(data)
		{
			data=$.trim(data);
			$('#reportload').html(data);
		});

	}
	
	    
	else if(repttype=="type_order")
	{
        $('#module_div').hide();
		$('#stewardtimelydiv').css("display","none");
		$('#tot_sales_timelydiv').css("display","none");
		$('#timelyitemorderdiv').css("display","none");
		$('#endof_sale_report').css("display","none");
		$('#regeneratebilllogs').css("display","none");
		$('#summary_hamdiv').css("display","none");
		$('#tableturnoversummarydiv').css("display","none");
		$('#tableturnoverdiv').css("display","none");
		$('#foodcostingdiv').css("display","none");
		$('#prnt').css("display","block");
		$('#feedbacksummarydiv').css("display","none");
		$('#excel').css("display","block");
        $('#stewardperformance').css("display", "none");
		$('#menuratingdiv').css("display","none");
		$('#feedbackdiv').css("display","none");
		$('#loyalitydiv').css("display","none");
		$('#kothistorydiv').css("display","none");
		$('#dailycostdiv').css("display","none");
		$('#creditdetailsdiv').css("display","none");
		$('#billreportdiv').css("display", "none");
		$('#summarydiv').css("display", "none");
		$('#kotsalesdiv').css("display", "none");
		$('#discountsalesdiv').css("display", "none");
		$('#totalcancelbilldiv').css("display", "none");
		$('#typooforder').css("display", "block");
		$('#totalorderdiv').css("display", "none");
		$('#totalsteward').css("display", "none");
		$('#itemselectdiv').css("display", "none");
		$('#totalsalesdiv').css("display", "none");
		$('#totalpaydiv').css("display", "none");
		$('#totalportion').css("display", "none");
		$('#cancelhistorydiv').css("display", "none");	
		$('#complementarydiv').css("display", "none");
		$('#generalratingdiv').css("display","none");
        $('#totalsummarydetailsdiv').css("display", "none");
        $('#kitchenorderdiv').css("display", "none");
		$('#datepickerfromord').val("");
		$('#datepickertodtord').val("");
		$('#reportload').html("");
        $('#categorywise_reportdiv').css("display","none");
        $('#menu_typediv').css("display", "none");
        $('#bill_sort_div').css("display", "none");
        $('#condition').css("display", "none");
		clearall();
	}
	else if(repttype=="cancel_history")
	{
        $('#module_div').hide();
		$('#stewardtimelydiv').css("display","none");
		$('#tot_sales_timelydiv').css("display","none");
		$('#regeneratebilllogs').css("display","none");
		$('#timelyitemorderdiv').css("display","none");
		$('#summary_hamdiv').css("display","none");
		$('#tableturnoversummarydiv').css("display","none");
		$('#tableturnoverdiv').css("display","none");
		$('#foodcostingdiv').css("display","none");
		$('#prnt').css("display","block");
		$('#feedbacksummarydiv').css("display","none");
		$('#excel').css("display","block");
        $('#stewardperformance').css("display", "none");
		$('#endof_sale_report').css("display","none");
		$('#menuratingdiv').css("display","none");
		$('#feedbackdiv').css("display","none");
		$('#loyalitydiv').css("display","none");
		$('#dailycostdiv').css("display","none");
		$('#creditdetailsdiv').css("display","none");
		$('#billreportdiv').css("display", "none");
		$('#summarydiv').css("display", "none");
		$('#kotsalesdiv').css("display", "none");
		$('#discountsalesdiv').css("display", "none");
		$('#totalcancelbilldiv').css("display", "none");
	    $('#cancelhistorydiv').css("display", "block");
		$('#kothistorydiv').css("display","none");
		$('#typooforder').css("display", "none");
		$('#totalorderdiv').css("display", "none");
		$('#totalsteward').css("display", "none");
		$('#itemselectdiv').css("display", "none");
		$('#totalsalesdiv').css("display", "none");
		$('#totalpaydiv').css("display", "none");
		$('#totalportion').css("display", "none");	
		$('#complementarydiv').css("display", "none");
		$('#generalratingdiv').css("display","none");
        $('#totalsummarydetailsdiv').css("display", "none");
        $('#kitchenorderdiv').css("display", "none");
		$('#datepickerfromord').val("");
		$('#datepickertodtord').val("");
		$('#reportload').html("");
        $('#categorywise_reportdiv').css("display","none");
        $('#menu_typediv').css("display", "none");
        $('#bill_sort_div').css("display", "none");
        $('#condition').css("display", "none");
		clearall();
		$.post("load_report.php", {type:repttype},
		function(data)
		{
			data=$.trim(data);
			$('#reportload').html(data);
		});
		
	}
	else if(repttype =="credit_details")
	{
        $('#module_div').hide();
		$('#stewardtimelydiv').css("display","none");
		$('#tot_sales_timelydiv').css("display","none");
		$('#timelyitemorderdiv').css("display","none");
		$('#regeneratebilllogs').css("display","none");
		$('#endof_sale_report').css("display","none");
		$('#summary_hamdiv').css("display","none");
		$('#tableturnoversummarydiv').css("display","none");
		$('#tableturnoverdiv').css("display","none");
		$('#foodcostingdiv').css("display","none");
		$('#prnt').css("display","block");
		$('#feedbacksummarydiv').css("display","none");
		$('#excel').css("display","block");
        $('#stewardperformance').css("display", "none");
		$('#menuratingdiv').css("display","none");
		$('#feedbackdiv').css("display","none");
		$('#loyalitydiv').css("display","none");
		$('#creditdetailsdiv').css("display","block");
		$('#kothistorydiv').css("display","none");
		$('#dailycostdiv').css("display","none");
		$('#billreportdiv').css("display", "none");
		$('#summarydiv').css("display", "none");
		$('#kotsalesdiv').css("display", "none");
		$('#discountsalesdiv').css("display", "none");
		$('#totalcancelbilldiv').css("display", "none");
	    $('#cancelhistorydiv').css("display", "none");
		$('#typooforder').css("display", "none");
		$('#totalorderdiv').css("display", "none");
		$('#totalsteward').css("display", "none");
		$('#itemselectdiv').css("display", "none");
		$('#totalsalesdiv').css("display", "none");
		$('#totalpaydiv').css("display", "none");
		$('#totalportion').css("display", "none");	
		$('#complementarydiv').css("display", "none");
		$('#generalratingdiv').css("display","none");
        $('#totalsummarydetailsdiv').css("display", "none");
        $('#kitchenorderdiv').css("display", "none");
		$('#datepickerfromord').val("");
		$('#datepickertodtord').val("");
		$('#reportload').html("");
        $('#categorywise_reportdiv').css("display","none");
        $('#menu_typediv').css("display", "none");
        $('#bill_sort_div').css("display", "none");
        $('#condition').css("display", "none");
		clearall();
		$.post("load_report.php", {type:repttype},
		function(data)
		{
			data=$.trim(data);
			$('#reportload').html(data);
		});
	}
	else if(repttype == "daily_cost")
	{
        $('#module_div').hide();
		$('#stewardtimelydiv').css("display","none");
		$('#tot_sales_timelydiv').css("display","none");
		$('#timelyitemorderdiv').css("display","none"); 
		$('#endof_sale_report').css("display","none");
		$('#summary_hamdiv').css("display","none");
		$('#tableturnoversummarydiv').css("display","none");
		$('#regeneratebilllogs').css("display","none");
		$('#tableturnoverdiv').css("display","none");
		$('#foodcostingdiv').css("display","none");
		$('#prnt').css("display","block");
		$('#feedbacksummarydiv').css("display","none");
		$('#excel').css("display","block");
        $('#stewardperformance').css("display", "none");
		$('#menuratingdiv').css("display","none");
		$('#feedbackdiv').css("display","none");
		$('#loyalitydiv').css("display","none");
		$('#dailycostdiv').css("display","block");
		$('#kothistorydiv').css("display","none");
		$('#creditdetailsdiv').css("display","none");
		$('#billreportdiv').css("display", "none");
		$('#summarydiv').css("display", "none");
		$('#kotsalesdiv').css("display", "none");
		$('#discountsalesdiv').css("display", "none");
		$('#totalcancelbilldiv').css("display", "none");
	    $('#cancelhistorydiv').css("display", "none");
		$('#typooforder').css("display", "none");
		$('#totalorderdiv').css("display", "none");
		$('#totalsteward').css("display", "none");
		$('#itemselectdiv').css("display", "none");
		$('#totalsalesdiv').css("display", "none");
		$('#totalpaydiv').css("display", "none");
		$('#totalportion').css("display", "none");	
		$('#complementarydiv').css("display", "none");
		$('#generalratingdiv').css("display","none");
        $('#totalsummarydetailsdiv').css("display", "none");
        $('#kitchenorderdiv').css("display", "none");
		$('#datepickerfromord').val("");
		$('#datepickertodtord').val("");
		$('#reportload').html("");
        $('#condition').css("display", "none");
        $('#categorywise_reportdiv').css("display","none");
        $('#menu_typediv').css("display", "none");
        $('#bill_sort_div').css("display", "none");
		clearall();
	}
	
	else if(repttype=="kot_history")
	{
        $('#module_div').hide();
		$('#stewardtimelydiv').css("display","none");
		$('#endof_sale_report').css("display","none");
		$('#tot_sales_timelydiv').css("display","none");
		$('#regeneratebilllogs').css("display","none");
		$('#timelyitemorderdiv').css("display","none");
		$('#summary_hamdiv').css("display","none");
		$('#tableturnoversummarydiv').css("display","none");
		$('#tableturnoverdiv').css("display","none");
		$('#foodcostingdiv').css("display","none");
		$('#prnt').css("display","block");
		$('#feedbacksummarydiv').css("display","none");
		$('#excel').css("display","block");
		$('#menuratingdiv').css("display","none");
		$('#feedbackdiv').css("display","none");
	    $('#loyalitydiv').css("display","none");
        $('#stewardperformance').css("display", "none");
		$('#kothistorydiv').css("display","block");
		$('#dailycostdiv').css("display","none");
		$('#creditdetailsdiv').css("display","none");
		$('#billreportdiv').css("display", "none");
		$('#summarydiv').css("display", "none");
		$('#kotsalesdiv').css("display", "none");
		$('#discountsalesdiv').css("display", "none");
		$('#totalcancelbilldiv').css("display", "none");
	    $('#cancelhistorydiv').css("display", "none");
		$('#typooforder').css("display", "none");
		$('#totalorderdiv').css("display", "none");
		$('#totalsteward').css("display", "none");
		$('#itemselectdiv').css("display", "none");
		$('#totalsalesdiv').css("display", "none");
		$('#totalpaydiv').css("display", "none");
		$('#totalportion').css("display", "none");	
		$('#complementarydiv').css("display", "none");
		$('#generalratingdiv').css("display","none");
        $('#totalsummarydetailsdiv').css("display", "none");
        $('#kitchenorderdiv').css("display", "none");
		$('#datepickerfromord').val("");
		$('#datepickertodtord').val("");
		$('#reportload').html("");
        $('#categorywise_reportdiv').css("display","none");
        $('#menu_typediv').css("display", "none");
        $('#bill_sort_div').css("display", "none");
        $('#condition').css("display", "none");
		clearall();
	}
	else if(repttype =="loyality_customer")
	{
        $('#module_div').hide();
		$('#stewardtimelydiv').css("display","none");
		$('#tot_sales_timelydiv').css("display","none");
		$('#timelyitemorderdiv').css("display","none");
		$('#endof_sale_report').css("display","none");
		$('#summary_hamdiv').css("display","none");
		$('#tableturnoversummarydiv').css("display","none");
		$('#tableturnoverdiv').css("display","none");
		$('#regeneratebilllogs').css("display","none");
		$('#foodcostingdiv').css("display","none");
		$('#prnt').css("display","block");
		$('#feedbacksummarydiv').css("display","none");
		$('#excel').css("display","block");
		$('#menuratingdiv').css("display","none");
		$('#feedbackdiv').css("display","none");
		$('#loyalitydiv').css("display","block");
        $('#stewardperformance').css("display", "none");
		$('#kothistorydiv').css("display","none");
		$('#dailycostdiv').css("display","none");
		$('#creditdetailsdiv').css("display","none");
		$('#billreportdiv').css("display", "none");
		$('#summarydiv').css("display", "none");
		$('#kotsalesdiv').css("display", "none");
		$('#discountsalesdiv').css("display", "none");
		$('#totalcancelbilldiv').css("display", "none");
	    $('#cancelhistorydiv').css("display", "none");
		$('#typooforder').css("display", "none");
		$('#totalorderdiv').css("display", "none");
		$('#totalsteward').css("display", "none");
		$('#itemselectdiv').css("display", "none");
		$('#totalsalesdiv').css("display", "none");
		$('#totalpaydiv').css("display", "none");
		$('#totalportion').css("display", "none");	
		$('#complementarydiv').css("display", "none");
		$('#generalratingdiv').css("display","none");
        $('#totalsummarydetailsdiv').css("display", "none");
        $('#kitchenorderdiv').css("display", "none");
		$('#datepickerfromord').val("");
		$('#datepickertodtord').val("");
        $('#condition').css("display", "none");
		$('#reportload').html("");
		clearall();
        $('#categorywise_reportdiv').css("display","none");
        $('#menu_typediv').css("display", "none");
        $('#bill_sort_div').css("display", "none");

		$.post("load_report.php", {type:repttype},
		function(data)
		{
			data=$.trim(data);
			$('#reportload').html(data);
		});
	}
	else if(repttype =="feedback_report")
	{
        $('#module_div').hide();
		$('#stewardtimelydiv').css("display","none");
		$('#tot_sales_timelydiv').css("display","none");
		$('#timelyitemorderdiv').css("display","none");
		$('#summary_hamdiv').css("display","none");
		$('#tableturnoversummarydiv').css("display","none");
		$('#tableturnoverdiv').css("display","none");
		$('#endof_sale_report').css("display","none");
		$('#regeneratebilllogs').css("display","none");
		$('#foodcostingdiv').css("display","none");
		$('#prnt').css("display","block");
		$('#feedbacksummarydiv').css("display","none");
		$('#excel').css("display","block");
		$('#menuratingdiv').css("display","none");
        $('#stewardperformance').css("display", "none");
		$('#feedbackdiv').css("display","block");
		$('#loyalitydiv').css("display","none");
		$('#kothistorydiv').css("display","none");
		$('#dailycostdiv').css("display","none");
		$('#creditdetailsdiv').css("display","none");
		$('#billreportdiv').css("display", "none");
		$('#summarydiv').css("display", "none");
		$('#kotsalesdiv').css("display", "none");
		$('#discountsalesdiv').css("display", "none");
		$('#totalcancelbilldiv').css("display", "none");
	    $('#cancelhistorydiv').css("display", "none");
		$('#typooforder').css("display", "none");
		$('#totalorderdiv').css("display", "none");
		$('#totalsteward').css("display", "none");
		$('#itemselectdiv').css("display", "none");
		$('#totalsalesdiv').css("display", "none");
		$('#totalpaydiv').css("display", "none");
		$('#totalportion').css("display", "none");	
		$('#complementarydiv').css("display", "none");
		$('#generalratingdiv').css("display","none");
        $('#totalsummarydetailsdiv').css("display", "none");
        $('#kitchenorderdiv').css("display", "none");
		$('#datepickerfromord').val("");
		$('#datepickertodtord').val("");
		$('#reportload').html("");
        $('#bill_sort_div').css("display", "none");
		clearall();
        $('#categorywise_reportdiv').css("display","none");
        $('#menu_typediv').css("display", "none");
        $('#condition').css("display", "none");
		$.post("load_report.php", {type:repttype},
		function(data)
		{
			data=$.trim(data);
			$('#reportload').html(data);
		});
	}
	else if(repttype=="menu_rating")
	{
        $('#module_div').hide();
		$('#stewardtimelydiv').css("display","none");
		$('#tot_sales_timelydiv').css("display","none");
		$('#timelyitemorderdiv').css("display","none");
		$('#summary_hamdiv').css("display","none");
		$('#tableturnoversummarydiv').css("display","none");
		$('#tableturnoverdiv').css("display","none");
		$('#foodcostingdiv').css("display","none");
		$('#prnt').css("display","block");
		$('#regeneratebilllogs').css("display","none");
		$('#endof_sale_report').css("display","none");
		$('#excel').css("display","none");
		$('#menuratingdiv').css("display","block");
		$('#generalratingdiv').css("display","none");
		$('#feedbackdiv').css("display","none");
		$('#loyalitydiv').css("display","none");
		$('#kothistorydiv').css("display","none");
        $('#stewardperformance').css("display", "none");
		$('#dailycostdiv').css("display","none");
		$('#creditdetailsdiv').css("display","none");
		$('#billreportdiv').css("display", "none");
		$('#summarydiv').css("display", "none");
		$('#kotsalesdiv').css("display", "none");
		$('#discountsalesdiv').css("display", "none");
		$('#totalcancelbilldiv').css("display", "none");
	    $('#cancelhistorydiv').css("display", "none");
		$('#typooforder').css("display", "none");
		$('#totalorderdiv').css("display", "none");
		$('#totalsteward').css("display", "none");
		$('#itemselectdiv').css("display", "none");
		$('#totalsalesdiv').css("display", "none");
		$('#totalpaydiv').css("display", "none");
		$('#totalportion').css("display", "none");	
		$('#complementarydiv').css("display", "none");
        $('#totalsummarydetailsdiv').css("display", "none");
        $('#kitchenorderdiv').css("display", "none");
		$('#datepickerfromord').val("");
		$('#datepickertodtord').val("");
		$('#reportload').html("");
		$('#feedbacksummarydiv').css("display","none");
        $('#categorywise_reportdiv').css("display","none");
        $('#menu_typediv').css("display", "none");
        $('#bill_sort_div').css("display", "none");
        $('#condition').css("display", "none");
		$.post("load_report.php", {bydate:null,type:"menu_rating"},
		function(data)
		{
			data=$.trim(data);	
			$('#reportload').html(data);
		});
		clearall();
	}
	else if(repttype =="general_feedback")
	{
        $('#module_div').hide();
		$('#stewardtimelydiv').css("display","none");
		$('#tot_sales_timelydiv').css("display","none");
		$('#timelyitemorderdiv').css("display","none");
		$('#summary_hamdiv').css("display","none");
		$('#tableturnoversummarydiv').css("display","none");
		$('#tableturnoverdiv').css("display","none");
		$('#regeneratebilllogs').css("display","none");
		$('#foodcostingdiv').css("display","none");
		$('#prnt').css("display","block");
		$('#endof_sale_report').css("display","none");
		$('#excel').css("display","none");
		$('#menuratingdiv').css("display","none");
		$('#feedbackdiv').css("display","none");
        $('#stewardperformance').css("display", "none");
		$('#loyalitydiv').css("display","none");
		$('#kothistorydiv').css("display","none");
		$('#dailycostdiv').css("display","none");
		$('#creditdetailsdiv').css("display","none");
		$('#billreportdiv').css("display", "none");
		$('#summarydiv').css("display", "none");
		$('#kotsalesdiv').css("display", "none");
		$('#discountsalesdiv').css("display", "none");
		$('#totalcancelbilldiv').css("display", "none");
	    $('#cancelhistorydiv').css("display", "none");
		$('#typooforder').css("display", "none");
		$('#totalorderdiv').css("display", "none");
		$('#totalsteward').css("display", "none");
		$('#itemselectdiv').css("display", "none");
		$('#totalsalesdiv').css("display", "none");
		$('#totalpaydiv').css("display", "none");
		$('#totalportion').css("display", "none");	
		$('#complementarydiv').css("display", "none");
		$('#generalratingdiv').css("display","block");
		$('#kothistorydiv').css("display","none");
		$('#feedbacksummarydiv').css("display","none");
        $('#totalsummarydetailsdiv').css("display", "none");
        $('#kitchenorderdiv').css("display", "none");
		$('#datepickerfromord').val("");
		$('#datepickertodtord').val("");
		$('#reportload').html("");
        $('#categorywise_reportdiv').css("display","none");
        $('#condition').css("display", "none");
        $('#menu_typediv').css("display", "none");
        $('#bill_sort_div').css("display", "none");
		clearall();
		$.post("load_report.php", {type:repttype},
		function(data)
		{
			data=$.trim(data);
			$('#reportload').html(data);
		});
	}
	
	else if(repttype=="feedback_summary")
	{
        $('#module_div').hide();
		$('#stewardtimelydiv').css("display","none");
		$('#tot_sales_timelydiv').css("display","none");
		$('#timelyitemorderdiv').css("display","none");
		$('#summary_hamdiv').css("display","none");
		$('#tableturnoversummarydiv').css("display","none");
		$('#tableturnoverdiv').css("display","none");
		$('#foodcostingdiv').css("display","none");
		$('#regeneratebilllogs').css("display","none");
		$('#prnt').css("display","block");
		$('#endof_sale_report').css("display","none");
		$('#excel').css("display","none");
		$('#menuratingdiv').css("display","none");
		$('#feedbackdiv').css("display","none");
		$('#loyalitydiv').css("display","none");
		$('#kothistorydiv').css("display","none");
		$('#dailycostdiv').css("display","none");
		$('#creditdetailsdiv').css("display","none");
		$('#billreportdiv').css("display", "none");
        $('#stewardperformance').css("display", "none");
		$('#summarydiv').css("display", "none");
		$('#kotsalesdiv').css("display", "none");
		$('#discountsalesdiv').css("display", "none");
		$('#totalcancelbilldiv').css("display", "none");
	    $('#cancelhistorydiv').css("display", "none");
		$('#typooforder').css("display", "none");
		$('#totalorderdiv').css("display", "none");
		$('#totalsteward').css("display", "none");
		$('#itemselectdiv').css("display", "none");
		$('#totalsalesdiv').css("display", "none");
		$('#totalpaydiv').css("display", "none");
		$('#totalportion').css("display", "none");	
		$('#complementarydiv').css("display", "none");
		$('#generalratingdiv').css("display","none");
		$('#kothistorydiv').css("display","none");
		$('#feedbacksummarydiv').css("display","block");
		$('#totalsummarydetailsdiv').css("display", "none");
        $('#kitchenorderdiv').css("display", "none");
        $('#menu_typediv').css("display", "none");
        $('#bill_sort_div').css("display", "none");
	 	$('#condition').css("display", "none");
		$('#reportload').html("");
        $('#categorywise_reportdiv').css("display","none");
		clearall();
		$.post("load_report.php", {type:repttype},
		function(data)
			{
				data=$.trim(data);
				$('#reportload').html(data);
			});
	}
	else if(repttype=="food_costing")
	{
        $('#module_div').hide();
		$('#stewardtimelydiv').css("display","none");
		$('#tot_sales_timelydiv').css("display","none");
		$('#timelyitemorderdiv').css("display","none");
		$('#summary_hamdiv').css("display","none");
		$('#tableturnoversummarydiv').css("display","none");
		$('#tableturnoverdiv').css("display","none");
		$('#endof_sale_report').css("display","none");
		$('#foodcostingdiv').css("display","block");
		$('#prnt').css("display","block");
		$('#excel').css("display","none");
		$('#regeneratebilllogs').css("display","none");
		$('#menuratingdiv').css("display","none");
        $('#stewardperformance').css("display", "none");
		$('#feedbackdiv').css("display","none");
		$('#loyalitydiv').css("display","none");
		$('#kothistorydiv').css("display","none");
		$('#dailycostdiv').css("display","none");
		$('#creditdetailsdiv').css("display","none");
		$('#billreportdiv').css("display", "none");
		$('#summarydiv').css("display", "none");
		$('#kotsalesdiv').css("display", "none");
		$('#discountsalesdiv').css("display", "none");
		$('#totalcancelbilldiv').css("display", "none");
	    $('#cancelhistorydiv').css("display", "none");
		$('#typooforder').css("display", "none");
		$('#totalorderdiv').css("display", "none");
		$('#totalsteward').css("display", "none");
		$('#itemselectdiv').css("display", "none");
		$('#totalsalesdiv').css("display", "none");
		$('#totalpaydiv').css("display", "none");
		$('#totalportion').css("display", "none");	
		$('#complementarydiv').css("display", "none");
		$('#generalratingdiv').css("display","none");
		$('#kothistorydiv').css("display","none");
		$('#feedbacksummarydiv').css("display","none");
        $('#totalsummarydetailsdiv').css("display", "none");
        $('#kitchenorderdiv').css("display", "none");
		$('#datepickerfromord').val("");
		$('#datepickertodtord').val("");
		$('#reportload').html("");
        $('#categorywise_reportdiv').css("display","none");
        $('#menu_typediv').css("display", "none");
        $('#bill_sort_div').css("display", "none");
        $('#condition').css("display", "none");
		clearall();
	}
	else if(repttype =="table_turnover")
	{
        $('#module_div').hide();
		$('#stewardtimelydiv').css("display","none");
		$('#tot_sales_timelydiv').css("display","none");
		$('#timelyitemorderdiv').css("display","none");
		$('#endof_sale_report').css("display","none");
		$('#summary_hamdiv').css("display","none");
		$('#tableturnoversummarydiv').css("display","none");
		$('#foodcostingdiv').css("display","none");
        $('#stewardperformance').css("display", "none");
		$('#prnt').css("display","block");
		$('#excel').css("display","block");
		$('#menuratingdiv').css("display","none");
		$('#feedbackdiv').css("display","none");
		$('#regeneratebilllogs').css("display","none");
		$('#loyalitydiv').css("display","none");
		$('#kothistorydiv').css("display","none");
		$('#dailycostdiv').css("display","none");
		$('#creditdetailsdiv').css("display","none");
		$('#billreportdiv').css("display", "none");
		$('#summarydiv').css("display", "none");
		$('#kotsalesdiv').css("display", "none");
		$('#discountsalesdiv').css("display", "none");
		$('#totalcancelbilldiv').css("display", "none");
	    $('#cancelhistorydiv').css("display", "none");
		$('#typooforder').css("display", "none");
		$('#totalorderdiv').css("display", "none");
		$('#totalsteward').css("display", "none");
		$('#itemselectdiv').css("display", "none");
		$('#totalsalesdiv').css("display", "none");
		$('#totalpaydiv').css("display", "none");
		$('#totalportion').css("display", "none");	
		$('#complementarydiv').css("display", "none");
		$('#generalratingdiv').css("display","none");
	    $('#kothistorydiv').css("display","none");
		$('#feedbacksummarydiv').css("display","none");
		$('#tableturnoverdiv').css("display","block");
        $('#totalsummarydetailsdiv').css("display", "none");
        $('#kitchenorderdiv').css("display", "none");
		$('#datepickerfromord').val("");
		$('#datepickertodtord').val("");
		$('#reportload').html("");
        $('#categorywise_reportdiv').css("display","none");
        $('#menu_typediv').css("display", "none");
    	$('#bill_sort_div').css("display", "none");
        $('#condition').css("display", "none");
		clearall();
	}
	
	else if(repttype=="table_turnoversummary")
	{
        $('#module_div').hide();
		$('#stewardtimelydiv').css("display","none");
		$('#tot_sales_timelydiv').css("display","none");
		$('#timelyitemorderdiv').css("display","none");
		$('#summary_hamdiv').css("display","none");
		$('#foodcostingdiv').css("display","none");
		$('#prnt').css("display","block");
		$('#endof_sale_report').css("display","none");
		$('#regeneratebilllogs').css("display","none");
		$('#excel').css("display","block");
		$('#menuratingdiv').css("display","none");
		$('#feedbackdiv').css("display","none");
        $('#stewardperformance').css("display", "none");
		$('#loyalitydiv').css("display","none");
		$('#kothistorydiv').css("display","none");
		$('#dailycostdiv').css("display","none");
		$('#creditdetailsdiv').css("display","none");
		$('#billreportdiv').css("display", "none");
		$('#summarydiv').css("display", "none");
		$('#kotsalesdiv').css("display", "none");
		$('#discountsalesdiv').css("display", "none");
		$('#totalcancelbilldiv').css("display", "none");
	    $('#cancelhistorydiv').css("display", "none");
		$('#typooforder').css("display", "none");
		$('#totalorderdiv').css("display", "none");
		$('#totalsteward').css("display", "none");
		$('#itemselectdiv').css("display", "none");
		$('#totalsalesdiv').css("display", "none");
		$('#totalpaydiv').css("display", "none");
		$('#totalportion').css("display", "none");	
		$('#complementarydiv').css("display", "none");
		$('#generalratingdiv').css("display","none");
	    $('#kothistorydiv').css("display","none");
		$('#feedbacksummarydiv').css("display","none");
		$('#tableturnoverdiv').css("display","none");
		$('#tableturnoversummarydiv').css("display","block");
        $('#totalsummarydetailsdiv').css("display", "none");
        $('#kitchenorderdiv').css("display", "none");
        $('#condition').css("display", "none");
		$('#datepickerfromord').val("");
		$('#datepickertodtord').val("");
		$('#reportload').html("");
        $('#categorywise_reportdiv').css("display","none");
        $('#menu_typediv').css("display", "none");
        $('#bill_sort_div').css("display", "none");
		clearall();
        var typeval=$('#typeval').val();
		var typeval=typeval.trim(); 
		$.post("load_report.php", {type:typeval},
		function(data)
		{
			data=$.trim(data);						
			$('#reportload').html(data);
		});   
	}
	else if(repttype =="summary_ham")
	{
        $('#module_div').hide();
		$('#stewardtimelydiv').css("display","none");
		$('#tot_sales_timelydiv').css("display","none");
		$('#timelyitemorderdiv').css("display","none");
		$('#endof_sale_report').css("display","none");
		$('#summary_hamdiv').css("display","block");
		$('#foodcostingdiv').css("display","none");
		$('#regeneratebilllogs').css("display","none");
		$('#prnt').css("display","block");
        $('#stewardperformance').css("display", "none");
		$('#excel').css("display","block");
		$('#menuratingdiv').css("display","none");
		$('#feedbackdiv').css("display","none");
		$('#loyalitydiv').css("display","none");
		$('#kothistorydiv').css("display","none");
		$('#dailycostdiv').css("display","none");
		$('#creditdetailsdiv').css("display","none");
		$('#billreportdiv').css("display", "none");
        $('#condition').css("display", "none");
		$('#summarydiv').css("display", "none");
		$('#kotsalesdiv').css("display", "none");
		$('#discountsalesdiv').css("display", "none");
		$('#totalcancelbilldiv').css("display", "none");
	    $('#cancelhistorydiv').css("display", "none");
		$('#typooforder').css("display", "none");
		$('#totalorderdiv').css("display", "none");
		$('#totalsteward').css("display", "none");
		$('#itemselectdiv').css("display", "none");
		$('#totalsalesdiv').css("display", "none");
		$('#totalpaydiv').css("display", "none");
		$('#totalportion').css("display", "none");	
		$('#complementarydiv').css("display", "none");
		$('#generalratingdiv').css("display","none");
		$('#kothistorydiv').css("display","none");
		$('#feedbacksummarydiv').css("display","none");
		$('#tableturnoverdiv').css("display","none");
		$('#tableturnoversummarydiv').css("display","none");
        $('#totalsummarydetailsdiv').css("display", "none");
        $('#kitchenorderdiv').css("display", "none");
		$('#datepickerfromord').val("");
		$('#datepickertodtord').val("");
		$('#reportload').html("");
        $('#categorywise_reportdiv').css("display","none");
        $('#menu_typediv').css("display", "none");
        $('#bill_sort_div').css("display", "none");
		clearall();	
	}
	else
	{
        $('#module_div').hide();
		$('#stewardtimelydiv').css("display","none");
		$('#tot_sales_timelydiv').css("display","none");
		$('#timelyitemorderdiv').css("display","none");
		$('#summary_hamdiv').css("display","none");
		$('#tableturnoversummarydiv').css("display","none");
		$('#tableturnoverdiv').css("display","none");
		$('#foodcostingdiv').css("display","none");
		$('#feedbacksummarydiv').css("display","none");
		$('#generalratingdiv').css("display","none");
		$('#menuratingdiv').css("display","none");
		$('#feedbackdiv').css("display","none");
		$('#endof_sale_report').css("display","none");
		$('#loyalitydiv').css("display","none");
		$('#kothistorydiv').css("display","none");
		$('#dailycostdiv').css("display","none");
		$('#creditdetailsdiv').css("display","none");
		$('#billreportdiv').css("display", "none");
		$('#summarydiv').css("display", "none");
		$('#kotsalesdiv').css("display", "none");
        $('#condition').css("display", "none");
		$('#discountsalesdiv').css("display", "none");
		$('#totalcancelbilldiv').css("display", "none");
		$('#datepickerfrom').val("");
		$('#datepickertodt').val("");
        $('#stewardperformance').css("display", "none");
		$('#totalsalesdiv').css("display", "none");
		$('#regeneratebilllogs').css("display","none");
		$('#totalsalesdiv').css("display", "none");
		$('#typooforder').css("display", "none");
		$('#totalorderdiv').css("display", "none");
		$('#totalsteward').css("display", "none");
		$('#itemselectdiv').css("display", "none");
		$('#totalpaydiv').css("display", "none");
		$('#totalportion').css("display", "none");	
		$('#cancelhistorydiv').css("display", "none");
		$('#complementarydiv').css("display", "none");
		$('#excel').css("display","none");
		$('#prnt').css("display","none");
        $('#totalsummarydetailsdiv').css("display", "none");
        $('#kitchenorderdiv').css("display", "none");
		$('#reportload').html("");
        $('#categorywise_reportdiv').css("display","none");
        $('#menu_typediv').css("display", "none");
        $('#bill_sort_div').css("display", "none");
	}
}
/*********************create report on type change ends ********************/
function movetoexcelForm()
{
	var check = confirm("Are you sure you want to create excel sheet of these records?");
	if(check==true)
	{
		var vv=document.getElementById("typeval").value;
		document.getElementById("hidval").value=vv;
		if(vv=="tot_sales")
		{
			var hidfr=$('#datepickerfrom').val();
			var hidto=$('#datepickertodt').val();
			var hidbydate=$('#bydate').val();
			var floorz=$('#floorwise').val();
			window.location="excel_download.php?type="+vv+"&hidfr="+hidfr+"&hidto="+hidto+"&hidbydate="+hidbydate+"&floorz="+floorz;
		//summarydiv  datepickerfromsummary datepickertosummary bydatesummary summary	
		}
        
		if(vv=="categorywise_report")
		{
			var hidfr=$('#datepickerfromcategory_wise').val();
			var hidto=$('#datepickertocategory_wise').val();
			var hidbydate=$('#bydatecategorywise').val();
			var floorz=$('#floorwisecategorywise').val();
			window.location="excel_download.php?type="+vv+"&fromdt="+hidfr+"&todt="+hidto+"&bydate="+hidbydate+"&floorz="+floorz;
		//summarydiv  datepickerfromsummary datepickertosummary bydatesummary summary	
		}
		else if(vv=="tot_sales_timely")
		{
			var hidfr=$('#timeopen').val();
			var hidto=$('#timeclose').val();
			var hidbydate=$('#datepickersalestimely').val();		
			var floorz=$('#floor_sales').val();
			window.location="excel_download.php?type="+vv+"&hidfr="+hidfr+"&hidto="+hidto+"&hidbydate="+hidbydate+"&floorz="+floorz;
		//summarydiv  datepickerfromsummary datepickertosummary bydatesummary summary	
		}
        else if(vv=="sales_summary")
		{
            var hidfr=$('#datepickerfromsummary').val();
			var hidto=$('#datepickertosummary').val();
			var hidbydate=$('#bydatesummary').val();
			window.location="excel_download.php?type="+vv+"&fromdt="+hidfr+"&todt="+hidto+"&bydate="+hidbydate;                                                               }
        else if(vv=="tax_detailed_cnb")
		{
            var hidfr=$('#datepickerfromsummary').val();
			var hidto=$('#datepickertosummary').val();
			var hidbydate=$('#bydatesummary').val();

			window.location="excel_download.php?type="+vv+"&hidfr="+hidfr+"&hidto="+hidto+"&hidbydate="+hidbydate;
         }
        else if(vv=="tax_sales_summary")
        {
         	var hidfr=$('#datepickerfromsummary').val();
			var hidto=$('#datepickertosummary').val();
			var hidbydate=$('#bydatesummary').val();
			window.location="excel_download.php?type="+vv+"&hidfr="+hidfr+"&hidto="+hidto+"&hidbydate="+hidbydate;
		}
		else if(vv=="summary")
		{
			var hidfr=$('#datepickerfromsummary').val();
			var hidto=$('#datepickertosummary').val();
			var hidbydate=$('#bydatesummary').val();
			window.location="excel_download.php?type="+vv+"&hidfr="+hidfr+"&hidto="+hidto+"&hidbydate="+hidbydate;
		}
        else if(vv=="total_summary_details")
		{
			var hidfr=$('#datepickerfromtotalsummarydetails').val();
			var hidto=$('#datepickertototalsummarydetails').val();
			var hidbydate=$('#bydatetotalsummarydetails').val();
			window.location="excel_download.php?type="+vv+"&hidfr="+hidfr+"&hidto="+hidto+"&hidbydate="+hidbydate;		
		 //billreportdiv datepickerfrombill datepickertobill bydatebillreport bill_details
		}   
        else if(vv=="bill_details")
		{
			var hidfr=$('#datepickerfrombill').val();
			var hidto=$('#datepickertobill').val();
			var hidbydate=$('#bydatebillreport').val();
            var sort=$('#bill_sort').val();
			window.location="excel_download.php?type="+vv+"&hidfr="+hidfr+"&hidto="+hidto+"&hidbydate="+hidbydate+"&sortby="+sort;
		  // discountsalesdiv  datepickerfromdisc  datepickertodtdisc bydatedisc 
		}
		else if(vv=="discount_report")
		{
			var hidfr=$('#datepickerfromdisc').val();
			var hidto=$('#datepickertodtdisc').val();
			var hidbydate=$('#bydatedisc').val();
			window.location="excel_download.php?type="+vv+"&hidfr="+hidfr+"&hidto="+hidto+"&hidbydate="+hidbydate;
		  // kot_report kotsalesdiv datepickerfromkot datepickertodtkot bydatekot
		}
		else if(vv=="kot_report")
		{
			var hidfr=$('#datepickerfromkot').val();
			var hidto=$('#datepickertodtkot').val();
			var hidbydate=$('#bydatekot').val();
			window.location="excel_download.php?type="+vv+"&hidfr="+hidfr+"&hidto="+hidto+"&hidbydate="+hidbydate;  
		}
                
        else if(vv=="bill_cancel")//bill_cancel  totalcancelbilldiv datepickerfrom_cl datepickertodt_cl bydate_cl
		{
			var hidfr=$('#datepickerfrom_cl').val();
			var hidto=$('#datepickertodt_cl').val();
			var hidbydate=$('#bydate_cl').val();
			window.location="excel_download.php?type="+vv+"&hidfr="+hidfr+"&hidto="+hidto+"&hidbydate="+hidbydate;
		}
		
		
		
		else if(vv=="no_sale_report")//bill_cancel  totalcancelbilldiv datepickerfrom_cl datepickertodt_cl bydate_cl
		{
			var hidfr=$('#datepickerfromnewsale').val();
			var hidto=$('#datepickertonewsale').val();
			var hidbydate=$('#bynewsale').val();
			window.location="excel_download.php?type="+vv+"&hidfr="+hidfr+"&hidto="+hidto+"&hidbydate="+hidbydate;
		}
		else if(vv=="regenerate_bill_logs")//bill_cancel  totalcancelbilldiv datepickerfrom_cl datepickertodt_cl bydate_cl
		{
			var hidfr=$('#datepickerfromregenerate').val();
			var hidto=$('#datepickertoregenerate').val();
			var hidbydate=$('#bydateregenerate').val();
			window.location="excel_download.php?type="+vv+"&hidfr="+hidfr+"&hidto="+hidto+"&hidbydate="+hidbydate; 
		}
		else if(vv=="type_pay")
		{  
			var hidfr=$('#datepickerfromtyp').val();
			var hidto=$('#datepickertodttyp').val();
			var tye=document.getElementById("typepay").value; 
			var paybydate=document.getElementById("paybydate").value; 

			if(tye!="null")
			{
				window.location="excel_download.php?type="+vv+"&hidfr="+hidfr+"&hidto="+hidto+"&hidpaytyp="+tye+"&hidpay="+paybydate;	
			}
			else
			{
				$('#reportload').empty();	
				$('#rptstatus').css("display", "block");
			    var rptstatus245=$('#rptstatus');
		        rptstatus245.text('No records to export');	
		        $("#rptstatus").delay(1000).fadeOut('slow');
			}
			
		}
		else if(vv=="item")
		{ 
			var hidfloor=$('#floorsel').val();
            var mode=$('#mode_sec').val();
			var tye=document.getElementById("typepay").value; 
			var condition_type=$('#condition_type').val();			
			window.location="excel_download.php?type="+vv+"&floorvals="+hidfloor+"&hidpaytyp="+tye+"&mode="+mode+"&condition="+condition_type;
			
		}
		else if(vv=="steward")
		{ 
			var hidfr=$('#datepickerfromdtstw').val();
			var hidto=$('#datepickertodtstw').val();
            var steward_type=$('#steward_type').val();
            var stw_mode=$('#stw_mode').val();           
			var stw=document.getElementById("stewardtp").value; 
			document.getElementById("hidstw").value=stw;
			var stwbydate=document.getElementById("stewardbydate").value; 
			if(stw !="")
			{
				window.location="excel_download.php?type="+vv+"&hidfr="+hidfr+"&hidto="+hidto+"&hidstw="+stw+"&hidstwdate="+stwbydate+"&steward_type="+steward_type+"&stw_mode="+stw_mode;
			}
			else
			{
			$('#reportload').empty();	
			$('#rptstatus').css("display", "block");
			var rptstatus155=$('#rptstatus');
		    rptstatus155.text('No records to export');	
		    $("#rptstatus").delay(1000).fadeOut('slow');					
			}
		}              
        else if(vv=="stewards_performance_report")
		{ 
			var hidfr=$('#datepickerfromdtstwprf').val();
			var hidto=$('#datepickertodtstwprf').val();
			var stw=document.getElementById("stewardperfo").value; 
			document.getElementById("hidstw").value=stw;
			var stwbydate=document.getElementById("stewardperfobydate").value; 
			if(stw !="")
			{
				window.location="excel_download.php?type="+vv+"&hidfr="+hidfr+"&hidto="+hidto+"&hidstw="+stw+"&hidstwdate="+stwbydate;
			}
		}
		else
		{
			$('#reportload').empty();	
			$('#rptstatus').css("display", "block");
			var rptstatus155=$('#rptstatus');
		    rptstatus155.text('No records to export');	
			$("#rptstatus").delay(1000).fadeOut('slow');					
		}
		}  
		else if(vv =="steward_timely")
		{
			var hidfr=$('#stewardtimeopen ').val();
			var hidto=$('#stewardtimeclose').val();
			var hidstw=$('#stewardtimely').val();
			var stwbydate=document.getElementById("stewardbydatetimely").value; 
			window.location="excel_download.php?type="+vv+"&hidfr="+hidfr+"&hidto="+hidto+"&hidstw="+hidstw+"&hidstwdate="+stwbydate;	
		}     
        if(vv=="order")
		{
			var hidfr=$('#datepickerfrom').val();
			var hidto=$('#datepickertodt').val();
			var hidbydate=$('#bydate').val();
			var floorz=$('#floorwise').val();
			var addon=$('#menu_type').val();
			window.location="excel_download.php?type="+vv+"&fromdt="+hidfr+"&todt="+hidto+"&bydate="+hidbydate+"&floorz="+floorz+"&addon="+addon;		
		}                          
        else if(vv=="kitchen_wise")
		{
			var hidfr=$('#datepickerfromktc').val();
			var hidto=$('#datepickertodtktc').val();
			var hidbydate=$('#kitchenorderbydate').val();
			var byflr=$('#kitchen').val();
            var item=$('#item').val();
			window.location="excel_download.php?type="+vv+"&hidfr="+hidfr+"&hidto="+hidto+"&hidbydate="+hidbydate+"&byflr="+byflr+"&item="+item;	
		}          
        else if(vv=="portion_order")
		{
			var tot_from=$('#datepickerfromdtprtn').val();
			var tot_to=$('#datepickertodtprtn').val(); 
			var prtn=document.getElementById("portiontp").value; 
			var portnbydate=document.getElementById("portionbydate").value; 	
			window.location="excel_download.php?type="+vv+"&from="+tot_from+"&to="+tot_to+"&prtn="+prtn+"&hidportn="+portnbydate;	
		}
		else if(vv=="type_order")
		{
			document.getElementById("hidfr").value=$('#datepickerfromdttpord').val();
			document.getElementById("hidto").value=$('#datepickertodttpord').val();
			var ord=document.getElementById("ordertyp").value; 
			document.getElementById("hidord").value=ord;
			var hidorderby=document.getElementById("ordertypebydate").value; 
			if(ord !="")
			{
			var tot_from=$('#datepickerfromdttpord').val();
    		var tot_to=$('#datepickertodttpord').val();
			var ordertyp=document.getElementById("ordertyp").value; 
			window.location="excel_download.php?type="+vv+"&from="+tot_from+"&to="+tot_to+"&ordertyp="+ordertyp+"&hidorderby="+hidorderby;
			}
			else
			{
			  $('#reportload').empty();	
			  $('#rptstatus').css("display", "block");
			  var rptstatus855=$('#rptstatus');
			  rptstatus855.text('No records to export');	
			  $("#rptstatus").delay(1000).fadeOut('slow');			  
			}
		}else if(vv=="cancel_history")
		{
			var fromdt=$('#datepickerfromcancel').val();
			var todt=$('#datepickertodtcancel').val();
			var ord=document.getElementById("orderbydatecancel").value;
			if(ord=='null')
			{
				window.location="excel_download.php?type="+vv+"&from="+fromdt+"&to="+todt;				
			}else
			{
				window.location="excel_download.php?type="+vv+"&from="+fromdt+"&to="+todt+"&ordertyp="+ord;
			}
		}
		else if(vv=="complementary_report")
		{
			var hidfr=$('#datepickercompfrom').val();
			var hidto=$('#datepickercomptodt').val();
			var hidbydate=$('#bycompdate').val();
			window.location="excel_download.php?type="+vv+"&hidfr="+hidfr+"&hidto="+hidto+"&hidbydate="+hidbydate;
		}
		else if(vv=="credit_details")
		{
			var hidfr=$('#datepickercrdtfrom').val();
			var hidto=$('#datepickercrdttodt').val();
			var hidbydate=$('#bycrdtdate').val();
			var hidcat=$('#bycat').val();
			window.location="excel_download.php?type="+vv+"&from="+hidfr+"&to="+hidto+"&hidbydate="+hidbydate+"&catgry="+hidcat;
		}
		
		else if(vv =="daily_cost")
		{
			var monthval=$('#bymonth').val();	
			var yrval=$('#byear').val();		
			var cat='a';				
			if(monthval!="null" && yrval =="")	
			{		
				window.location="excel_download.php?type="+vv+"&monthval="+monthval+"&yrval="+yrval+"&set="+cat;					
			}
			else if(monthval =="null" && yrval !="")
			{
				window.location="excel_download.php?type="+vv+"&monthval="+monthval+"&yrval="+yrval+"&yr="+cat;
			}
			else if(monthval !="null" && yrval !="")
			{
				window.location="excel_download.php?type="+vv+"&monthval="+monthval+"&yrval="+yrval+"&setyr="+cat;
			}
		}
		else if(vv =="kot_history")
		{
			var hidfr=$('#datepickerfromkothis').val();
			window.location="excel_download.php?type="+vv+"&hidfr="+hidfr;
		}
		else if(vv =="loyality_customer")
		{
			var hidfr=$('#datepickerfromloyality').val();
			var hidto=$('#datepickertoloyality').val();
			var hidbydate=$('#byloyalitydate').val();
			window.location="excel_download.php?type="+vv+"&hidfr="+hidfr+"&hidto="+hidto+"&hidbydate="+hidbydate;
     	}
		
		else if(vv=="feedback_report")
		{
			var hidfr=$('#datepickerfromfeedback').val();
			var hidto=$('#datepickertofeedback').val();
			var hidbydate=$('#byfeedback').val();
			window.location="excel_download.php?type="+vv+"&hidfr="+hidfr+"&hidto="+hidto+"&hidbydate="+hidbydate;
		}
		else if(vv=="menu_rating")
		{
			var hidbydate=$('#bymenurating').val();
			window.location="excel_download.php?type="+vv+"&hidbymenu="+hidbydate;
		}
		else if(vv=="table_turnover")
		{
			var hidfr=$('#datepickerfromturnover').val();
			var hidto=$('#datepickertoturnover').val();
			var hidbydate=$('#byturnover').val();

		window.location="excel_download.php?type="+vv+"&hidfr="+hidfr+"&hidto="+hidto+"&hidbydate="+hidbydate;
		}
		else if(vv =="table_turnoversummary")
		{			
			var hidfr=$('#datepickerfromturnoversummary').val();
			var hidto=$('#datepickertoturnoversummary').val();
			var hidbydate=$('#byturnoversummary').val();
			window.location="excel_download.php?type="+vv+"&fromdt="+hidfr+"&todt="+hidto+"&bydate="+hidbydate;	
		}
		else if(vv =="summary_ham")
		{
			var hidfr=$('#datepickerfromsummaryham').val();
			var hidto=$('#datepickertosummaryham').val();
			var hidbydate=$('#bydatesummaryham').val();
			window.location="excel_download.php?type="+vv+"&hidfr="+hidfr+"&hidto="+hidto+"&hidbydate="+hidbydate;		
		}
		else if(vv =="items_ordered_timely")
		{
			var hidfr=$('#time').val();
			var hidto=$('#time2').val();
			var byflr=$('#floortimely').val();
			var entrydate=$('#datepickeritemtimely').val();
			window.location="excel_download.php?type="+vv+"&hidfr="+hidfr+"&hidto="+hidto+"&entrydate="+entrydate+"&byflr="+byflr;
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
	if(vv=="tot_sales")
	{
			vv=ofprint;
			var tot_from=$('#datepickerfrom').val();
    		var tot_to=$('#datepickertodt').val();			
			var floorz=$('#floorwise').val();
			var hidbydate=$('#bydate').val();
			var a4paper=$('#hida4settings').val();                
            var tot_sales="tot_sales";
    
				if(printera4=="N")
				{
				window.open("print_bill.php?type="+vv+"&from="+tot_from+"&to="+tot_to+"&hidbydate="+hidbydate+"&floorz="+floorz+"#print", '_blank');
				}
				else
				{
                $.post("print_report.php", {type:vv,hidfr:tot_from,hidto:tot_to,hidbydate:hidbydate,floorz:floorz},
                    function(data)
                    {
                        data=$.trim(data);
                        data=data.split('**');
                        if(data[1]=='failed')
						{
						$('#rptstatus').css("display", "block");
                        var rptstatuschk=$('#rptstatus');
                        rptstatuschk.text(data[2]);	
                        $("#rptstatus").delay(1000).fadeOut('slow');
                        }
                    });            		
				}	
		}      
        else if(vv=="categorywise_report")
		{
			vv=ofprint;
			var tot_from=$('#datepickerfromcategory_wise').val();
    		var tot_to=$('#datepickertocategory_wise').val();
			var floorz=$('#floorwisecategorywise').val();
			var hidbydate=$('#bydatecategorywise').val();
			var a4paper=$('#hida4settings').val();
            var tot_sales="categorywise_report";
            var floorz=$('#floorwisecategorywise').val();
			if(printera4=="N")
			{
			window.open("print_bill.php?type="+vv+"&from="+tot_from+"&to="+tot_to+"&hidbydate="+hidbydate+"&floorz="+floorz+"#print", '_blank');
			}
			else
			{                                         
            $.post("print_report.php", {type:vv,from:tot_from,to:tot_to,hidbydate:hidbydate,floorz:floorz},
                function(data)
                    {
                        data=$.trim(data);
                        data=data.split('**');
                        if(data[1]=='failed')
						{
					    $('#rptstatus').css("display", "block");
                    	var rptstatuschk=$('#rptstatus');
                     	rptstatuschk.text(data[2]);	
                        $("#rptstatus").delay(1000).fadeOut('slow');
                    	}
					});                                   	
			}
		}  
 
        else if(vv=="tax_detailed_cnb")
		{
			vv=ofprint;
			var tot_from=$('#datepickerfromsummary').val();
    		var tot_to=$('#datepickertosummary').val();
			var floorz=$('#floorwise').val();
			var hidbydate=$('#bydatesummary').val();
			var a4paper=$('#hida4settings').val();   
            var tot_sales="tot_sales";
			if(printera4=="N")
			{
			window.open("print_bill.php?type="+vv+"&from="+tot_from+"&to="+tot_to+"&hidbydate="+hidbydate+"&floorz="+floorz+"#print", '_blank');
			}else
			{
    			$.post("print_report.php", {type:vv,hidfr:tot_from,hidto:tot_to,hidbydate:hidbydate},
                function(data)
                    {
                    data=$.trim(data);
                    data=data.split('**');
                    if(data[1]=='failed')
					{
					$('#rptstatus').css("display", "block");
                    var rptstatuschk=$('#rptstatus');
                    rptstatuschk.text(data[2]);	
                    $("#rptstatus").delay(1000).fadeOut('slow');
                    }
					});
            }
		}         
        else if(vv=="sales_summary_zam")
		{
			vv=ofprint;
			var tot_from=$('#datepickerfromsummary').val();
    		var tot_to=$('#datepickertosummary').val();
			var hidbydate=$('#bydatesummary').val();
			var a4paper=$('#hida4settings').val();

			if(printera4=="N")
			{
			window.open("print_bill.php?type="+vv+"&from="+tot_from+"&to="+tot_to+"&hidbydate="+hidbydate+"#print", '_blank');
			}else
			{
						
				$.post("print_report.php", {type:vv,hidfr:tot_from,hidto:tot_to,hidbydate:hidbydate},
					function(data)
					{
					data=$.trim(data);
                    data=data.split('**');
                    if(data[1]=='failed')
					{
						$('#rptstatus').css("display", "block");
                        var rptstatuschk=$('#rptstatus');
                        rptstatuschk.text(data[2]);	
                        $("#rptstatus").delay(1000).fadeOut('slow');
                    }
					});		
			}
		} 
		else if(vv=="tax_sales_summary")
		{
			vv=ofprint;
			var tot_from=$('#datepickerfromsummary').val();
    		var tot_to=$('#datepickertosummary').val();
			var hidbydate=$('#bydatesummary').val();
			var a4paper=$('#hida4settings').val();
		
			if(printera4=="N")
			{
			window.open("print_bill.php?type="+vv+"&from="+tot_from+"&to="+tot_to+"&hidbydate="+hidbydate+"#print", '_blank');
			}else
			{						
				$.post("print_report.php", {type:vv,hidfr:tot_from,hidto:tot_to,hidbydate:hidbydate},
					function(data)
					{
					data=$.trim(data);
                    data=data.split('**');
                    if(data[1]=='failed')
					{
					$('#rptstatus').css("display", "block");
                    var rptstatuschk=$('#rptstatus');
                    rptstatuschk.text(data[2]);	
                    $("#rptstatus").delay(1000).fadeOut('slow');
                    }							
					});
			}						
		} 
		else if(vv=="tot_sales_timely")
		{
			vv=ofprint;
			var tot_from=$('#timeopen').val();
    		var tot_to=$('#timeclose').val();
			var floorz=$('#floor_sales').val();
			var hidbydate=$('#datepickersalestimely').val();
			var a4paper=$('#hida4settings').val();
			if(printera4=="N")
				{
				window.open("print_bill.php?type="+vv+"&from="+tot_from+"&to="+tot_to+"&hidbydate="+hidbydate+"&floorz="+floorz+"#print", '_blank');
				}
				else
				{						
				$.post("print_report.php", {type:vv,hidfr:tot_from,hidto:tot_to,hidbydate:hidbydate},
					function(data)
					{
					data=$.trim(data);
                    data=data.split('**');
                    if(data[1]=='failed')
					{
						$('#rptstatus').css("display", "block");
                        var rptstatuschk=$('#rptstatus');
                        rptstatuschk.text(data[2]);	
                        $("#rptstatus").delay(1000).fadeOut('slow');
                    }						
					});						
				}
						
		}
		//summarydiv  datepickerfromsummary datepickertosummary bydatesummary summary	
		else if(vv=="summary")
		{
			vv=ofprint;
			var tot_from=$('#datepickerfromsummary').val();
    		var tot_to=$('#datepickertosummary').val();
			var hidbydate=$('#bydatesummary').val();
			var a4paper=$('#hida4settings').val();
			if(printera4=="N")
			{
			window.open("print_bill.php?type="+vv+"&from="+tot_from+"&to="+tot_to+"&hidbydate="+hidbydate+"#print", '_blank');
			}else
			{						
				$.post("print_report.php", {type:vv,hidfr:tot_from,hidto:tot_to,hidbydate:hidbydate},
				function(data)
				{
				data=$.trim(data);
                data=data.split('**');
                if(data[1]=='failed')
				{
				$('#rptstatus').css("display", "block");
                var rptstatuschk=$('#rptstatus');
                rptstatuschk.text(data[2]);	
                $("#rptstatus").delay(1000).fadeOut('slow');
                }
				});					
			}						
		}  
        else if(vv=="table_turnoversummary")
		{   
			vv=ofprint;
			var tot_from=$('#datepickerfromturnoversummary').val();
            var tot_to=$('#datepickertoturnoversummary').val();		
			var hidbydate=$('#byturnoversummary').val();
			var a4paper=$('#hida4settings').val();
           	var tot_sales="tot_sales";  	                                     
			if(printera4=="N")
			{
				window.open("print_bill.php?type="+vv+"&from="+tot_from+"&to="+tot_to+"&bydate="+hidbydate+"#print", '_blank');
			}
			else
			{
                $.post("print_report.php", {type:vv,fromdt:tot_from,todt:tot_to,bydate:hidbydate},
                function(data)
                {
                    data=$.trim(data);
                    data=data.split('**');
                    if(data[1]=='failed')
					{
					$('#rptstatus').css("display", "block");
                    var rptstatuschk=$('#rptstatus');
                    rptstatuschk.text(data[2]);	
                    $("#rptstatus").delay(1000).fadeOut('slow');
                    }                                              
                });
            }  		
		}   
        else if(vv=="bill_details")
		{
			vv=ofprint;
			var tot_from=$('#datepickerfrombill').val();
    		var tot_to=$('#datepickertobill').val();
			var hidbydate=$('#bydatebillreport').val();
			var sort=$('#bill_sort').val();
			if(printera4=="N")
			{
				window.open("print_bill.php?type="+vv+"&from="+tot_from+"&to="+tot_to+"&hidbydate="+hidbydate+"&sortby="+sort+"#print", '_blank');
			}
			else
			{
			}			
		}
		else if(vv=="discount_report")
		{
			vv=ofprint;
			var tot_from=$('#datepickerfromdisc').val();
    		var tot_to=$('#datepickertodtdisc').val();
			var hidbydate=$('#bydatedisc').val();
			if(printera4=="N")
			{
				window.open("print_bill.php?type="+vv+"&from="+tot_from+"&to="+tot_to+"&hidbydate="+hidbydate+"#print", '_blank');
			}
		}
		else if(vv=="kot_report")
		{
			vv=ofprint;
			var tot_from=$('#datepickerfromkot').val();
    		var tot_to=$('#datepickertodtkot').val();						
			var hidbydate=$('#bydatekot').val();
			if(printera4=="N")
			{
				window.open("print_bill.php?type="+vv+"&from="+tot_from+"&to="+tot_to+"&hidbydate="+hidbydate+"#print", '_blank');
			}
		}
		else if(vv=="bill_cancel")
		{
			vv=ofprint;
			var tot_from=$('#datepickerfrom_cl').val();
    		var tot_to=$('#datepickertodt_cl').val();
			var hidbydate=$('#bydate_cl').val();
			var a4paper=$('#hida4settings').val();
			if(printera4=="N")
			{
				window.open("print_bill.php?type="+vv+"&from="+tot_from+"&to="+tot_to+"&hidbydate="+hidbydate+"#print", '_blank');
			}
			else
			{						
				$.post("print_report.php", {type:vv,hidfr:tot_from,hidto:tot_to,hidbydate:hidbydate},
				function(data)
					{
					data=$.trim(data);
                    data=data.split('**');
                    if(data[1]=='failed')
					{
					$('#rptstatus').css("display", "block");
                    var rptstatuschk=$('#rptstatus');
                    rptstatuschk.text(data[2]);	
                    $("#rptstatus").delay(1000).fadeOut('slow');
                    }							
					});						
			}
		}
		
		
		else if(vv=="no_sale_report")////bill_cancel  totalcancelbilldiv datepickerfrom_cl datepickertodt_cl bydate_cl
		{
			var tot_from=$('#datepickerfromnewsale').val();
    		var tot_to=$('#datepickertonewsale').val();
			var hidbydate=$('#bynewsale').val();
			var a4paper=$('#hida4settings').val();
			if(printera4=="N")
			{
				window.open("print_bill.php?type="+vv+"&from="+tot_from+"&to="+tot_to+"&hidbydate="+hidbydate+"#print", '_blank');
			}else
			{
				$.post("print_report.php", {type:vv,hidfr:tot_from,hidto:tot_to,hidbydate:hidbydate},
				function(data)
				{
				data=$.trim(data);
                data=data.split('**');
                if(data[1]=='failed')
				{
				$('#rptstatus').css("display", "block");
                var rptstatuschk=$('#rptstatus');
                rptstatuschk.text(data[2]);	
                $("#rptstatus").delay(1000).fadeOut('slow');
                }
				});						
			}	
		}
		else if(vv=="regenerate_bill_logs")////bill_cancel  totalcancelbilldiv datepickerfrom_cl datepickertodt_cl bydate_cl
		{
			var tot_from=$('#datepickerfromregenerate').val();
    		var tot_to=$('#datepickertoregenerate').val();
			var hidbydate=$('#bydateregenerate').val();
			var a4paper=$('#hida4settings').val();
			if(printera4=="N")
			{
			window.open("print_bill.php?type="+vv+"&from="+tot_from+"&to="+tot_to+"&hidbydate="+hidbydate+"#print", '_blank');
			}else
			{
			$.post("print_report.php", {type:vv,hidfr:tot_from,hidto:tot_to,hidbydate:hidbydate},
			function(data)
			{
			data=$.trim(data);
            data=data.split('**');
            if(data[1]=='failed')
			{
			$('#rptstatus').css("display", "block");
            var rptstatuschk=$('#rptstatus');
            rptstatuschk.text(data[2]);	
            $("#rptstatus").delay(1000).fadeOut('slow');
            }							
			});
			}	
		}
		
		else if(vv=="type_pay")
		{
			vv=ofprint;
			var tot_from=$('#datepickerfromtyp').val();
			var tot_to=$('#datepickertodttyp').val(); 
			var typ=document.getElementById("typepay").value; 
			var paybydate=document.getElementById("paybydate").value; 
			if(typ !="null")
			{
				if(printera4=="N")
				{
					window.open("print_bill.php?type="+vv+"&from="+tot_from+"&to="+tot_to+"&types="+typ+"&hidpay="+paybydate+"#print",'_blank');
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
		else if(vv=="item")
		{ 
			vv=ofprint;
		    var florvl=$('#floorsel').val();
			var typ=document.getElementById("typepay").value;
			var mode=$('#mode_sec').val(); 
			var condition_type=$('#condition_type').val();
			if(printera4=="N")
			{
			 	window.open("print_bill.php?type="+vv+"&floorvals="+florvl+"&condition="+condition_type+"&mode="+mode+"#print",'_blank');					
			}
			else
			{
			$('#reportload').empty();	
			$('#rptstatus').css("display", "block");
			var rpts1=$('#rptstatus');
		    rpts1.text('A4 Print is Off');	
	     	$("#rptstatus").delay(1000).fadeOut('slow');
			}
		}
		else if(vv=="steward")
		{ 
            vv=ofprint;
			var tot_from=$('#datepickerfromdtstw').val();
			var tot_to=$('#datepickertodtstw').val(); 
            var hidbydate = $('#stewardbydate').val(); 
			var stw=document.getElementById("stewardtp").value; 
			var stwbydate=document.getElementById("stewardbydate").value; 
            var steward_type=$('#steward_type').val();
            var stw_mode=$('#stw_mode').val();                        
			if(stw!="")
			{
				if(printera4=="N")
					{
				 window.open("print_bill.php?type="+vv+"&from="+tot_from+"&to="+tot_to+"&stwr="+stw+"&stw_mode="+stw_mode+"&steward_type="+steward_type+"&hidstwdate="+stwbydate+"#print",'_blank');
					}else
					{
                    $.post("print_report.php", {type:vv,from:tot_from,to:tot_to,hidbydate:hidbydate,stwrd:stw,stw_mode:stw_mode,steward_type:steward_type},
						function(data)
						{
						data=$.trim(data);
                        data=data.split('**');
                        if(data[1]=='failed')
						{
						$('#rptstatus').css("display", "block");
                        var rptstatuschk=$('#rptstatus');
                        rptstatuschk.text(data[2]);	
                        $("#rptstatus").delay(1000).fadeOut('slow');
                        }							
						});
                    }
			}
			else
			{
				('#reportload').empty();	
				$('#rptstatus').css("display", "block");
				var rpts2=$('#rptstatus');
		        rpts1.text('No records to export');	
	     	    $("#rptstatus").delay(1000).fadeOut('slow');
			}
		}
		else if(vv=="steward_timely")
		{
			vv=ofprint;
			var tot_from=$('#stewardtimeopen').val();
			var tot_to=$('#stewardtimeclose').val(); 
			var stw=document.getElementById("stewardtimely").value; 
			var stwbydate=document.getElementById("stewardbydatetimely").value; 
			if(printera4=="N")
			{
			window.open("print_bill.php?type="+vv+"&hidfr="+tot_from+"&hidto="+tot_to+"&hidstw="+stw+"&hidstwdate="+stwbydate+"#print",'_blank');
			}
		}
		else if(vv=="items_ordered_timely")
		{
			vv=ofprint;
			var tot_from=$('#time').val();
    		var tot_to=$('#time2').val();
			var hidbydate=$('#datepickeritemtimely').val();
			var byflr=$('#floortimely').val();
			if(printera4=="N")
				{
				window.open("print_bill.php?type="+vv+"&hidfr="+tot_from+"&hidto="+tot_to+"&entrydate="+hidbydate+"&byflr="+byflr+"#print",'_blank');
				}
				else					
				{
				$.post("print_report.php", {type:vv,from:tot_from,to:tot_to,hidbydate:hidbydate},
				function(data)
				{
					data=$.trim(data);							
				});						
				}					
		}
        else if(vv=="order")
		{
			vv=ofprint;
			var tot_from=$('#datepickerfrom').val();
    		var tot_to=$('#datepickertodt').val();			
			var floorz=$('#floorwise').val();
			var hidbydate=$('#bydate').val();
			var a4paper=$('#hida4settings').val();
            var tot_sales="order";
            var addon=$('#menu_type').val();
			if(printera4=="N")
			{
			window.open("print_bill.php?type="+vv+"&fromdt="+tot_from+"&todt="+tot_to+"&bydate="+hidbydate+"&floorz="+floorz+"&addon="+addon+"#print", '_blank');
			}
			else
			{
                $.post("print_report.php", {type:vv,from:tot_from,to:tot_to,hidbydate:hidbydate,floorvalue:floorz,addon:addon},
                function(data)
                {
                data=$.trim(data);
                data=data.split('**');
                if(data[1]=='failed')
				{
					$('#rptstatus').css("display", "block");
                    var rptstatuschk=$('#rptstatus');
                    rptstatuschk.text(data[2]);	
                    $("#rptstatus").delay(1000).fadeOut('slow');
                }
				});	
			}	
		}  
        else if(vv=="kitchen_wise")
		{
			vv=ofprint;
			var tot_from=$('#datepickerfromktc').val();
    		var tot_to=$('#datepickertodtktc').val();
			var hidbydate=$('#kitchenorderbydate').val();
			var byflr=$('#kitchen').val();
            var item=$('#item').val();
			if(printera4=="N")
			{
			window.open("print_bill.php?type="+vv+"&from="+tot_from+"&to="+tot_to+"&hidbydate="+hidbydate+"&byflr="+byflr+"&item="+item+"#print",'_blank');
			}
			else
			{
			$.post("print_report.php", {type:vv,from:tot_from,to:tot_to,hidbydate:hidbydate},
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
        //------------kitche wise ends------
        else if(vv=="portion_order")
		{
			vv=ofprint;
			var tot_from=$('#datepickerfromdtprtn').val();
			var tot_to=$('#datepickertodtprtn').val(); 
			var prtn=document.getElementById("portiontp").value; 
			var portnbydate=document.getElementById("portionbydate").value; 
			if(printera4=="N")
			{
			window.open("print_bill.php?type="+vv+"&from="+tot_from+"&to="+tot_to+"&prtn="+prtn+"&hidportn="+portnbydate+"#print",'_blank');
			}		
			 
		}
		else if(vv=="type_order")
		{	
			vv=ofprint;
			var tot_from=$('#datepickerfromdttpord').val();
    		var tot_to=$('#datepickertodttpord').val();
			var ordertyp=document.getElementById("ordertyp").value; 
			var hidorderby=document.getElementById("ordertypebydate").value; 
			if(ordertyp!="")
			{	
				if(printera4=="N")
				{
				window.open("print_bill.php?type="+vv+"&from="+tot_from+"&to="+tot_to+"&ordertyp="+ordertyp+"&hidorderby="+hidorderby+"#print",'_blank')
				}	
			}
			else
			{
				('#reportload').empty();	
				$('#rptstatus').css("display", "block");
			    var rpts5=$('#rptstatus');
		        rpts5.text('No records to export');	
	     	    $("#rptstatus").delay(1000).fadeOut('slow');
			}
		}
		else if(vv=="cancel_history")
		{
			vv=ofprint;
			var tot_from=$('#datepickerfromcancel').val();
            var tot_to=$('#datepickertodtcancel').val();
			var hidbydate=$('#orderbydatecancel').val();
			var a4paper=$('#hida4settings').val();         
				if(printera4=="N")
				{
				window.open("print_bill.php?type="+vv+"&from="+tot_from+"&to="+tot_to+"&hidbydate="+hidbydate+"&floorz="+floorz+"#print", '_blank');
				}
				else
				{
                $.post("print_report.php", {type:vv,from:tot_from,to:tot_to,hidbydate:hidbydate},
                function(data)
                {
                data=$.trim(data);
                data=data.split('**');
                if(data[1]=='failed')
				{
				$('#rptstatus').css("display", "block");
                var rptstatuschk=$('#rptstatus');
                rptstatuschk.text(data[2]);	
                $("#rptstatus").delay(1000).fadeOut('slow');
                }
				});
                }
		} 
		else if(vv =="complementary_report")
		{
			vv=ofprint;
			var tot_from=$('#datepickercompfrom').val();
    		var tot_to=$('#datepickercomptodt').val();
			var hidbydate=$('#bycompdate').val();
			var a4paper=$('#hida4settings').val();			
			if(printera4=="N")
				{
				window.open("print_bill.php?type="+vv+"&from="+tot_from+"&to="+tot_to+"&hidbydate="+hidbydate+"#print", '_blank');
				}else
				{						
				$.post("print_report.php", {type:vv,hidfr:tot_from,hidto:tot_to,hidbydate:hidbydate},
				function(data)
				{
					data=$.trim(data);
                    data=data.split('**');
                    if(data[1]=='failed')
					{
					$('#rptstatus').css("display", "block");
                    var rptstatuschk=$('#rptstatus');
                    rptstatuschk.text(data[2]);	
                    $("#rptstatus").delay(1000).fadeOut('slow');
                    }							
				});
				}
		}
	
	else if(vv=="credit_details")
	{
			vv=ofprint;
			var tot_from=$('#datepickercrdtfrom').val();
    		var tot_to=$('#datepickercrdttodt').val();
			var hidbydate=$('#bycrdtdate').val();
			var a4paper=$('#hida4settings').val();
			var cat=$('#bycat').val();
			if(printera4=="N")
			{
			window.open("print_bill.php?type="+vv+"&from="+tot_from+"&to="+tot_to+"&hidbydate="+hidbydate+"&catgry="+cat+"#print", '_blank');
			}else
			{
				$.post("print_report.php", {type:vv,from:tot_from,to:tot_to,hidbydate:hidbydate,catgry:cat},
					function(data)
					{
					data=$.trim(data);
                    data=data.split('**');
                    if(data[1]=='failed')
					{
					$('#rptstatus').css("display", "block");
                    var rptstatuschk=$('#rptstatus');
                    rptstatuschk.text(data[2]);	
                    $("#rptstatus").delay(1000).fadeOut('slow');
                    }
					});
			}
	}
	else if(vv =="daily_cost")
	{	
		vv=ofprint;
		var monthval=$('#bymonth').val();
    	var yrval=$('#byear').val();
		var cat='a';			
		if(printera4=="N")
			{					
			if(monthval!="null" && yrval =="")	
				{
				window.open("print_bill.php?type="+vv+"&monthval="+monthval+"&yrval="+yrval+"&set="+cat+"#print", '_blank');
				}
				else if(monthval =="null" && yrval !="")
				{
				window.open("print_bill.php?type="+vv+"&monthval="+monthval+"&yrval="+yrval+"&yr="+cat+"#print", '_blank');
				}
				else if(monthval !="null" && yrval !="")
				{
				window.open("print_bill.php?type="+vv+"&monthval="+monthval+"&yrval="+yrval+"&setyr="+cat+"#print", '_blank');
				}
			}else
			{
				$.post("print_report.php", {type:vv,hidfr:tot_from,hidto:tot_to,hidbydate:hidbydate},
				function(data)
				{
				data=$.trim(data);
                data=data.split('**');
                if(data[1]=='failed')
				{
				$('#rptstatus').css("display", "block");
                var rptstatuschk=$('#rptstatus');
                rptstatuschk.text(data[2]);	
                $("#rptstatus").delay(1000).fadeOut('slow');
                }
				});
			}	
	}
	else if(vv =="kot_history")
	{
		vv=ofprint;
		var tot_from=$('#datepickerfromkothis').val();
    	var a4paper=$('#hida4settings').val();
		if(printera4=="N")
		{
		window.open("print_bill.php?type="+vv+"&from="+tot_from+"#print", '_blank');
		}else
		{
		$.post("print_report.php", {type:vv,hidfr:tot_from},
		function(data)
		{
			data=$.trim(data);
            data=data.split('**');
            if(data[1]=='failed')
			{
			$('#rptstatus').css("display", "block");
            var rptstatuschk=$('#rptstatus');
            rptstatuschk.text(data[2]);	
            $("#rptstatus").delay(1000).fadeOut('slow');
            }
		});
		}		
	}
	else if(vv =="loyality_customer")
	{
		vv=ofprint;
		var tot_from=$('#datepickerfromloyality').val();
    	var tot_to=$('#datepickertoloyality').val();
		var hidbydate=$('#byloyalitydate').val();
		var a4paper=$('#hida4settings').val();
	
		if(printera4=="N")
		{
		window.open("print_bill.php?type="+vv+"&from="+tot_from+"&to="+tot_to+"&hidbydate="+hidbydate+"#print", '_blank');
		}else
		{
		$.post("print_report.php", {type:vv,hidfr:tot_from,hidto:tot_to,hidbydate:hidbydate},
		function(data)
		{
			data=$.trim(data);
            data=data.split('**');
            if(data[1]=='failed')
			{
			$('#rptstatus').css("display", "block");
            var rptstatuschk=$('#rptstatus');
            rptstatuschk.text(data[2]);	
            $("#rptstatus").delay(1000).fadeOut('slow');
            }
		});
		}					
	}
	else if(vv =="feedback_report")
		{
			vv=ofprint;
			var tot_from=$('#datepickerfromfeedback').val();
    		var tot_to=$('#datepickertofeedback').val();
			var hidbydate=$('#byfeedback').val();
			var a4paper=$('#hida4settings').val();		
			if(printera4=="N")
			{
			window.open("print_bill.php?type="+vv+"&hidfr="+tot_from+"&hidto="+tot_to+"&hidbydate="+hidbydate+"#print", '_blank');
			}else
			{
			$.post("print_report.php", {type:vv,hidfr:tot_from,hidto:tot_to,hidbydate:hidbydate},
			function(data)
			{
				data=$.trim(data);
                data=data.split('**');
                if(data[1]=='failed')
				{
				$('#rptstatus').css("display", "block");
                var rptstatuschk=$('#rptstatus');
                rptstatuschk.text(data[2]);	
                $("#rptstatus").delay(1000).fadeOut('slow');
                }
			});					
			}	
		}
	else if(vv =="menu_rating")
		{
			vv=ofprint;
			var hidbydate=$('#bymenurating').val();
			var a4paper=$('#hida4settings').val();
			if(printera4=="N")
				{
				window.open("print_bill.php?type="+vv+"&hidbydate="+hidbydate+"#print", '_blank');
				}else
				{
				$.post("print_report.php", {type:vv,hidbydate:hidbydate},
				function(data)
				{
				data=$.trim(data);
                data=data.split('**');
                if(data[1]=='failed')
				{
				$('#rptstatus').css("display", "block");
                var rptstatuschk=$('#rptstatus');
                rptstatuschk.text(data[2]);	
                $("#rptstatus").delay(1000).fadeOut('slow');
                }
				});
				}	
		}
	else if(vv =="general_feedback")
		{
		vv=ofprint;
		var tot_from=$('#datepickerfromgeneralrating').val();
    	var tot_to=$('#datepickertogeneralrating').val();
		var hidbydate=$('#byratingdate').val();
		var a4paper=$('#hida4settings').val();

			if(printera4=="N")
			{
			window.open("print_bill.php?type="+vv+"&hidfr="+tot_from+"&hidto="+tot_to+"&hidbydate="+hidbydate+"#print", '_blank');
			}else
			{
			$.post("print_report.php", {type:vv,hidfr:tot_from,hidto:tot_to,hidbydate:hidbydate},
			function(data)
				{
				data=$.trim(data);
                data=data.split('**');
                if(data[1]=='failed')
				{
				$('#rptstatus').css("display", "block");
                var rptstatuschk=$('#rptstatus');
                rptstatuschk.text(data[2]);	
                $("#rptstatus").delay(1000).fadeOut('slow');
                }
				});						
			}					
		}
	else if(vv =="feedback_summary")
		{
			vv=ofprint;
			var tot_from=$('#datepickerfromgeneralrating').val();
    		var tot_to=$('#datepickertogeneralrating').val();
			var hidbydate=$('#byratingdate').val();
			var a4paper=$('#hida4settings').val();
			if(printera4=="N")
				{
				window.open("print_bill.php?type="+vv+"&hidfr="+tot_from+"&hidto="+tot_to+"&hidbydate="+hidbydate+"#print", '_blank');
				}else
				{
				$.post("print_report.php", {type:vv,hidfr:tot_from,hidto:tot_to,hidbydate:hidbydate},
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
	else if(vv=="food_costing")
		{
	     	vv=ofprint;
	     	var tot_from=$('#byfoodcosting').val();
	     	var a4paper=$('#hida4settings').val();
				if(printera4=="N")
					{
					window.open("print_bill.php?type="+vv+"&from="+tot_from+"#print", '_blank');
					}else
					{
					$.post("print_report.php", {type:vv,hidfr:tot_from},
						function(data)
						{
						   data=$.trim(data);
                           data=data.split('**');
                           if(data[1]=='failed')
						   {
						   $('#rptstatus').css("display", "block");
                           var rptstatuschk=$('#rptstatus');
                           rptstatuschk.text(data[2]);	
                           $("#rptstatus").delay(1000).fadeOut('slow');
                           }							
						});				
					}						
		}
	else if(vv =="table_turnover")
		{
			vv=ofprint;
			var tot_from=$('#datepickerfromturnover').val();
    		var tot_to=$('#datepickertoturnover').val();
			var hidbydate=$('#byturnover ').val();
			var a4paper=$('#hida4settings').val();
			if(printera4=="N")
				{
					window.open("print_bill.php?type="+vv+"&hidfr="+tot_from+"&hidto="+tot_to+"&hidbydate="+hidbydate+"#print", '_blank');
				}else
				{
					$.post("print_report.php", {type:vv,hidfr:tot_from,hidto:tot_to,hidbydate:hidbydate},
					function(data)
					{
						data=$.trim(data);
                        data=data.split('**');
                        if(data[1]=='failed')
						{
						$('#rptstatus').css("display", "block");
                        var rptstatuschk=$('#rptstatus');
                        rptstatuschk.text(data[2]);	
                        $("#rptstatus").delay(1000).fadeOut('slow');
                        }							
					});
				}					
		}
	else if(vv=="table_turnoversummary")
		{
			vv=ofprint;
			var tot_from=$('#datepickerfromturnoversummary').val();
    		var tot_to=$('#datepickertoturnoversummary').val();
			var hidbydate=$('#byturnoversummary ').val();
			var a4paper=$('#hida4settings').val();
				if(printera4=="N")
				{
				window.open("print_bill.php?type="+vv+"&hidfr="+tot_from+"&hidto="+tot_to+"&hidbydate="+hidbydate+"#print", '_blank');
				}else
				{
					$.post("print_report.php", {type:vv,hidfr:tot_from,hidto:tot_to,hidbydate:hidbydate},
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
	
	else if(vv =="summary_ham")
		{
			vv=ofprint;
			var tot_from=$('#datepickerfromsummaryham').val();
    		var tot_to=$('#datepickertosummaryham').val();
			var hidbydate=$('#bydatesummaryham ').val();
			var a4paper=$('#hida4settings').val();
			if(printera4=="N")
			{
				window.open("print_bill.php?type="+vv+"&from="+tot_from+"&to="+tot_to+"&hidbydate="+hidbydate+"#print", '_blank');
			}else
			{
				$.post("print_report.php", {type:vv,hidfr:tot_from,hidto:tot_to,hidbydate:hidbydate},
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
    else if(vv=="total_summary_details")
		{
			vv=ofprint;
            var hidfr=$('#datepickerfromtotalsummarydetails').val();
			var hidto=$('#datepickertototalsummarydetails').val();
			var hidbydate=$('#bydatetotalsummarydetails').val();
			var a4paper=$('#hida4settings').val();			
			if(printera4=="N")
				{
					window.open("print_bill.php?type="+vv+"&fromdt="+hidfr+"&todt="+hidto+"&bydate="+hidbydate+"#print", '_blank');
				}else
				{
					$.post("print_report.php", {type:vv,hidfr:tot_from,hidto:tot_to,hidbydate:hidbydate},
					function(data)
					{
						data=$.trim(data);
                        data=data.split('**');
                        if(data[1]=='failed')
						{
						$('#rptstatus').css("display", "block");
                        var rptstatuschk=$('#rptstatus');
                        rptstatuschk.text(data[2]);	
                        $("#rptstatus").delay(1000).fadeOut('slow');
                        }							
					});											
				}		
		}
    else if(vv=="sales_summary")
	   {
            vv=ofprint;
            var hidfr=$('#datepickerfromsummary').val();
			var hidto=$('#datepickertosummary').val();
			var hidbydate=$('#bydatesummary').val();
			var a4paper=$('#hida4settings').val();
			if(printera4=="N")					
			{
				window.open("print_bill.php?type="+vv+"&fromdt="+hidfr+"&todt="+hidto+"&bydate="+hidbydate+"#print", '_blank');
			}else
			{
				$.post("print_report.php", {type:vv,hidfr:tot_from,hidto:tot_to,hidbydate:hidbydate},
				function(data)
				{
				data=$.trim(data);
                data=data.split('**');
                if(data[1]=='failed')
				{
				$('#rptstatus').css("display", "block");
                var rptstatuschk=$('#rptstatus');
                rptstatuschk.text(data[2]);	
                $("#rptstatus").delay(1000).fadeOut('slow');
                }
				});
			}
		}
    else if(vv=="stewards_performance_report")
		{ 
			var hidfr=$('#datepickerfromdtstwprf').val();
			var hidto=$('#datepickertodtstwprf').val();
			var stw=document.getElementById("stewardperfo").value; 
			document.getElementById("hidstw").value=stw;
			var stwbydate=document.getElementById("stewardperfobydate").value; 
			if(stw !="")
			{	
                 window.open("print_bill.php?type="+vv+"&fromdt="+hidfr+"&todt="+hidto+"&stwrd="+stw+"&bydate="+stwbydate+"#print", '_blank');		
			}
			else
			{
			$('#reportload').empty();	
			$('#rptstatus').css("display", "block");
			var rptstatus155=$('#rptstatus');
		    rptstatus155.text('No records to export');	
		    $("#rptstatus").delay(1000).fadeOut('slow');				
			}
		}
}
function pdf_page()
{
	var vv=document.getElementById("typeval").value;
	if(vv=="tot_sales")
		{
			var tot_from=$('#datepickerfrom').val();
    		var tot_to=$('#datepickertodt').val();
			var mail="ambili@exploreitsolutions.com";
		
		}//summarydiv  datepickerfromsummary datepickertosummary bydatesummary summary	
		else if(vv=="summary")
		{
			var tot_from=$('#datepickerfromsummary').val();
    		var tot_to=$('#datepickertosummary').val();
			var hidbydate=$('#bydatesummary').val();			
		}		
		else if(vv=="bill_details") 
		{
			var tot_from=$('#datepickerfrombill').val();
    		var tot_to=$('#datepickertobill').val();
		    var hidbydate=$('#bydatebillreport').val();
			window.location="pdf_bill.php?type="+vv+"&from="+tot_from+"&to="+tot_to+"&hidbydate="+hidbydate;
		}//// discountsalesdiv  datepickerfromdisc  datepickertodtdisc bydatedisc  discount_report
		else if(vv=="discount_report")
		{
			var tot_from=$('#datepickerfromdisc').val();
    		var tot_to=$('#datepickertodtdisc').val();
			var hidbydate=$('#bydatedisc').val();
			window.location="pdf_bill.php?type="+vv+"&from="+tot_from+"&to="+tot_to+"&hidbydate="+hidbydate;		
		}
		else if(vv=="kot_report")
		{
			var tot_from=$('#datepickerfromkot').val();
    		var tot_to=$('#datepickertodtkot').val();
			var hidbydate=$('#bydatekot').val();			
			window.location="pdf_bill.php?type="+vv+"&from="+tot_from+"&to="+tot_to+"&hidbydate="+hidbydate;

		}
		else if(vv=="bill_cancel")
		{
			var tot_from=$('#datepickerfrom_cl').val();
    		var tot_to=$('#datepickertodt_cl').val();
			var hidbydate=$('#bydate_cl').val();
			window.location="pdf_bill.php?type="+vv+"&from="+tot_from+"&to="+tot_to+"&hidbydate="+hidbydate;
		}
		else if(vv=="type_pay")
		{ 
			 var tot_from=$('#datepickerfromtyp').val();
			 var tot_to=$('#datepickertodttyp').val(); 
			 var typ=document.getElementById("typepay").value; 
			 var paybydate=document.getElementById("paybydate").value; 
			 if(typ!="null")
			 {
				window.location="pdf_bill.php?type="+vv+"&from="+tot_from+"&to="+tot_to+"&types="+typ+"&hidpay="+paybydate;
			 }
			 else
			 {
				('#reportload').empty();	
				$('#rptstatus').css("display", "block");
			    var rpts1=$('#rptstatus');
		        rpts1.text('No records to export');	
	     		$("#rptstatus").delay(1000).fadeOut('slow');
			 }
		}
		else if(vv=="item")
		{ 
		     var florvl=$('#floorsel').val();
			 var typ=document.getElementById("typepay").value;
			 if(florvl!="")
			 {
			 window.location="pdf_bill.php?type="+vv+"&floorv="+florvl;
			 }
			 else
			 {
				('#reportload').empty();	
				$('#rptstatus').css("display", "block");
			    var rpts8=$('#rptstatus');
		        rpts8.text('No records to export');	
	     	   $("#rptstatus").delay(1000).fadeOut('slow');
			 }
		}
		else if(vv=="steward")
		{ 
			var tot_from=$('#datepickerfromdtstw').val();
			var tot_to=$('#datepickertodtstw').val(); 
			var stwr=document.getElementById("stewardtp").value; 
			var stewardbydate=document.getElementById("stewardbydate").value; 
			if(stwr !="")
			{
				window.location="pdf_bill.php?type="+vv+"&from="+tot_from+"&to="+tot_to+"&stwr="+stwr+"&hidstwbydate="+stewardbydate;
			}
			else
			{
				('#reportload').empty();	
				$('#rptstatus').css("display", "block");
			  	var rpts7=$('#rptstatus');
		       	rpts7.text('No records to export');	
	     		$("#rptstatus").delay(1000).fadeOut('slow');
			}
		}
		else if(vv=="order")
		{
			var tot_from=$('#datepickerfromord').val();
    		var tot_to=$('#datepickertodtord').val();
			var mail="ambili@exploreitsolutions.com";
			window.location="text.php?type="+vv+"&from="+tot_from+"&to="+tot_to+"&mail="+mail;			
		}
		else if(vv=="portion_order")
		{
			var tot_from=$('#datepickerfromdtprtn').val();
			var tot_to=$('#datepickertodtprtn').val(); 
			var prtn=document.getElementById("portiontp").value; 
			var portionbydate=document.getElementById("portionbydate").value; 
			window.location="pdf_bill.php?type="+vv+"&from="+tot_from+"&to="+tot_to+"&prtn="+prtn+"&hidportn="+portionbydate;	
		}
		else if(vv=="type_order")
		{
			var tot_from=$('#datepickerfromdttpord').val();
    		var tot_to=$('#datepickertodttpord').val();
			var ordertyp=document.getElementById("ordertyp").value; 
			var ordertypebydate=document.getElementById("ordertypebydate").value; 
			if(ordertyp !="")
			{
				window.location="pdf_bill.php?type="+vv+"&from="+tot_from+"&to="+tot_to+"&ordertyp="+ordertyp+"&hidorderby="+ordertypebydate;	
			}
			else
			{
				('#reportload').empty();	
				$('#rptstatus').css("display", "block");
			    var rpts6=$('#rptstatus');
		        rpts6.text('No records to export');	
	     	    $("#rptstatus").delay(1000).fadeOut('slow');
			}
		}
		else if(vv=="cancel_history")
		{
			var fromdt=$('#datepickerfromcancel').val();
			var todt=$('#datepickertodtcancel').val();
			var ord=document.getElementById("orderbydatecancel").value;
			if(ord=='null')
			{
				window.location="pdf_bill.php?type="+vv+"&from="+fromdt+"&to="+todt;					
			}else
			{
				window.location="pdf_bill.php?type="+vv+"&from="+fromdt+"&to="+todt+"&ordertyp="+ord;					 			
			}		
		}
		else if(vv=="complementary_report")
		{
			var tot_from=$('#datepickercompfrom').val();
    		var tot_to=$('#datepickercomptodt').val();
			var hidbydate=$('#bycompdate').val();
			window.location="pdf_bill.php?type="+vv+"&from="+tot_from+"&to="+tot_to+"&hidbydate="+hidbydate;				
		}
}
//-----------load menu item
function viewstate(val)
{   
	$.ajax({
		  type: "POST",
		  url: "load_divmaster.php",
		  data: "value=loadmenuitem&kitchenid="+val,
		  success: function(msg)
		  {
			  $('#item').html(msg);
		  }
	  }); 
}

</script>
<script type="text/javascript" src="js/jquery.timepicker.js"></script>
  <link rel="stylesheet" type="text/css" href="css/jquery.timepicker.css" />
<script type="text/javascript" >
$(document).ready(function() {
   $('.time').timepicker({
        'timeFormat': 'H:i:s (g:ia)'
    });
}); 
</script>

</body>
</html>
