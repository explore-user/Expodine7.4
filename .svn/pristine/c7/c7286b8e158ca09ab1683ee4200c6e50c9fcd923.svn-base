<?php
include('includes/session.php');		// Check session
//session_start();
include("database.class.php"); // DB Connection class

$database	= new Database();

?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="shortcut icon" href="img/favicon.ico">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Bill Report</title>
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
    
/*    
$("input[type=range]").bind('mousedown touchstart', function (e) {
    e.stopPropagation();
});
*/


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
<!--
		//$(document).ready(function(){
//    $('table tr').click(function(){
//        window.location = $(this).attr('href');
//        return false;
//    });
//});-->


<script src="js/turbotabs.min.js"></script>
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
      changeYear: true
    });
	 $("#datepickertodt").datepicker({
      changeMonth: true,
      changeYear: true
    }); 
	
	 $("#datepickerfromtyp").datepicker({
      changeMonth: true,
      changeYear: true
    });
	 $("#datepickertodttyp").datepicker({
      changeMonth: true,
      changeYear: true
    });
	
	 
	
	$("#datepickerfromdtstw").datepicker({
      changeMonth: true,
      changeYear: true
    });
	 $("#datepickertodtstw").datepicker({
      changeMonth: true,
      changeYear: true
    });
	 
	
	$("#datepickerfromord").datepicker({
      changeMonth: true,
      changeYear: true
    });
	 $("#datepickertodtord").datepicker({
      changeMonth: true,
      changeYear: true
    });
	
	 
	$("#datepickerfromdttpord").datepicker({
      changeMonth: true,
      changeYear: true
    });
	 $("#datepickertodttpord").datepicker({
      changeMonth: true,
      changeYear: true
    });
	
	$("#datepickerfromdtprtn").datepicker({
      changeMonth: true,
      changeYear: true
    });
	 $("#datepickertodtprtn").datepicker({
      changeMonth: true,
      changeYear: true
    });
	
	
	
	
	/*******************************************date picker change sales starts**********************************************/
	$('#datepickerfrom').change(function () {
		//alert($(this).val());
		$('#ui-datepicker-div').css("display", "none");
		var fromval=$(this).val();
		var tot_to=$('#datepickertodt').val();
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;
		if(tot_to=="")
		{
			tot_to="";
		}
		$.post("load_reportcheck.php", {fromdt:fromval,todt:tot_to,type:typeval,set:"ft"},
			  function(data)
			  {
				
					data=$.trim(data);
				
					if(data!="sorry")
					{
						$.post("load_report.php", {fromdt:fromval,todt:tot_to,type:typeval,set:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
					}else
					{
						//alert("Sorry");
						
					$('#reportload').empty();	
					$('#rptstatus').css("display", "block");
			  var rptstatus=$('#rptstatus');
			 // alert(rptstatus);
		  rptstatus.text('No records to display');	
		$("#rptstatus").delay(1000).fadeOut('slow');
						
					}
			  });
		
		
		
		
	});
	$('#datepickerfrom').click(function () {
		$('#ui-datepicker-div').css("display", "block");
	});	
	
	
	
	$('#datepickertodt').click(function () {
		$('#ui-datepicker-div').css("display", "block");
	});	
	
	$('#datepickertodt').change(function () {
		
		$('#ui-datepicker-div').css("display", "none");
		var tot_to=$(this).val();
		var tot_from=$('#datepickerfrom').val();
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;
		if(tot_from=="")
		{
			tot_from="";
		}
			$.post("load_reportcheck.php", {fromdt:tot_from,todt:tot_to,type:typeval,set:"ft"},
			  function(data)
			  {
					data=$.trim(data);
					if(data!="sorry")
					{
						$.post("load_report.php", {fromdt:tot_from,todt:tot_to,type:typeval,set:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
					}else
					{ 
					$('#reportload').empty();	
						$('#rptstatus').css("display", "block");
			       var rptstatus1=$('#rptstatus');
		           rptstatus1.text('No records to display');	
		           $("#rptstatus").delay(1000).fadeOut('slow');
					}
			  });
	/*	$.post("load_report.php", {fromdt:tot_from,todt:tot_to,type:typeval,set:"ft"},
			  function(data)
			  {
					data=$.trim(data);
					$('#reportload').html(data);
			  });*/

	});
	/*****************************************date picker change sales ends**************************************************/
	
	/*******************************************type of payment starts**********************************************/
	$('#typepay').change(function () {
		
		var typeofpay=$(this).val();
		var typeval=$('#typeval').val(); 
		var tot_from=$('#datepickerfromtyp').val();
		var tot_to=$('#datepickertodttyp').val();
		$.post("load_reportcheck.php", {fromdt:tot_from,todt:tot_to,typepay:typeofpay,type:typeval},
			  function(data)
			  {
			
					data=$.trim(data);
					if(data!="sorry")
					{
						$.post("load_report.php", {fromdt:tot_from,todt:tot_to,typepay:typeofpay,type:typeval},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
					}else
					{
							
							$('#reportload').empty();	
								$('#rptstatus').css("display", "block");
			  var rptstatus2=$('#rptstatus');
		  rptstatus2.text('No records to display');	
		$("#rptstatus").delay(1000).fadeOut('slow');
					
					}
			  });
	/*	$.post("load_report.php", {fromdt:tot_from,todt:tot_to,typepay:typeofpay,type:typeval},
			  function(data)
			  {
					data=$.trim(data);
					$('#reportload').html(data);
			  });
*/
	});
	
	
	
	$('#datepickerfromtyp').change(function () {
		//alert($(this).val());
		$('#ui-datepicker-div').css("display", "none");
		var tot_from=$(this).val();
		var tot_to=$('#datepickertodttyp').val();
		var typeofpay=$('#typepay').val();
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;
		if(tot_to=="")
		{
			tot_to="";
		}
		$.post("load_reportcheck.php", {fromdt:tot_from,todt:tot_to,typepay:typeofpay,type:typeval},
			  function(data)
			  {
					data=$.trim(data);
					if(data!="sorry")
					{
						$.post("load_report.php", {fromdt:tot_from,todt:tot_to,typepay:typeofpay,type:typeval},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
					}else
					{
							$('#reportload').empty();
								$('#rptstatus').css("display", "block");	
			  var rptstatus3=$('#rptstatus');
		  rptstatus3.text('No records to display');	
		$("#rptstatus").delay(1000).fadeOut('slow');
					}
			  });

		
		
	/*	$.post("load_report.php", {fromdt:tot_from,todt:tot_to,typepay:typeofpay,type:typeval},
			  function(data)
			  {
					data=$.trim(data);
					$('#reportload').html(data);
			  });*/
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
		if(tot_from=="")
		{
			tot_from="";
		}
		
		$.post("load_reportcheck.php", {fromdt:tot_from,todt:tot_to,typepay:typeofpay,type:typeval},
			  function(data)
			  {
					data=$.trim(data);
					if(data!="sorry")
					{
						$.post("load_report.php", {fromdt:tot_from,todt:tot_to,typepay:typeofpay,type:typeval},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
					}else
					{	$('#reportload').empty();	
						$('#rptstatus').css("display", "block");
			  var rptstatus4=$('#rptstatus');
			 // alert(rptstatus);
		  rptstatus4.text('No records to display');	
		$("#rptstatus").delay(1000).fadeOut('slow');
					}
			  });

	});
	
	/*****************************************type of payment ends**************************************************************/
	
	/*******************************************Item starts**********************************************/
	$('#floorsel').change(function () {
		
		var floorval=$(this).val();
		var typeval=$('#typeval').val(); 
		
		$.post("load_report.php", {floorvals:floorval,type:typeval},
			  function(data)
			  {
					data=$.trim(data);
					$('#reportload').html(data);
			  });

	});
	
	/*****************************************Item ends**************************************************************/
	
	 /*******************************************Steward starts**********************************************/
		//stewardtp datepickerfromdtstw datepickertodtstw
	
	$('#stewardtp').change(function () {
		
		var stwrdid=$(this).val();
		var typeval=$('#typeval').val(); 
		var tot_from=$('#datepickerfromdtstw').val();
		var tot_to=$('#datepickertodtstw').val();
		$.post("load_reportcheck.php", {fromdt:tot_from,todt:tot_to,stwrd:stwrdid,type:typeval},
			  function(data)
			  {
			
					data=$.trim(data);
					if(data!="sorry")
					{
						$.post("load_report.php", {fromdt:tot_from,todt:tot_to,stwrd:stwrdid,type:typeval},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
					}else
					{
						 	$('#reportload').empty();	
								$('#rptstatus').css("display", "block");
			  var rptstatus5=$('#rptstatus');
			 // alert(rptstatus);
		  rptstatus5.text('No records to display');	
		$("#rptstatus").delay(1000).fadeOut('slow');
					}
			  });
	/*	$.post("load_report.php", {fromdt:tot_from,todt:tot_to,stwrd:stwrdid,type:typeval},
			  function(data)
			  {
					data=$.trim(data);
					$('#reportload').html(data);
			  });*/
	});
	
	
	
	
	
	$('#datepickerfromdtstw').change(function () {
		//alert($(this).val());
		$('#ui-datepicker-div').css("display", "none");
		var tot_from=$(this).val();
		var tot_to=$('#datepickertodtstw').val();
		var stwrdid=$('#stewardtp').val();
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;
		if(tot_to=="")
		{
			tot_to="";
		}
		
			$.post("load_reportcheck.php", {fromdt:tot_from,todt:tot_to,stwrd:stwrdid,type:typeval},
			  function(data)
			  {
			
					data=$.trim(data);
					if(data!="sorry")
					{
						$.post("load_report.php", {fromdt:tot_from,todt:tot_to,stwrd:stwrdid,type:typeval},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
					}else
					{
							$('#reportload').empty();
								$('#rptstatus').css("display", "block");	
			  var rptstatus6=$('#rptstatus');
			 // alert(rptstatus);
		  rptstatus6.text('No records to display');	
		$("#rptstatus").delay(1000).fadeOut('slow');
					}
			  });
		
	/*	$.post("load_report.php", {fromdt:tot_from,todt:tot_to,stwrd:stwrdid,type:typeval},
			  function(data)
			  {
					data=$.trim(data);
					$('#reportload').html(data);
			  });*/
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
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;
		if(tot_from=="")
		{
			tot_from="";
		}
		$.post("load_reportcheck.php", {fromdt:tot_from,todt:tot_to,stwrd:stwrdid,type:typeval},
			  function(data)
			  {
			
					data=$.trim(data);
					if(data!="sorry")
					{
						$.post("load_report.php", {fromdt:tot_from,todt:tot_to,stwrd:stwrdid,type:typeval},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
					}else
					{
						 	$('#reportload').empty();
								$('#rptstatus').css("display", "block");	
			  var rptstatus7=$('#rptstatus');
			 // alert(rptstatus);
		  rptstatus7.text('No records to display');	
		$("#rptstatus").delay(1000).fadeOut('slow');
					}
			  });

	/*	$.post("load_report.php", {fromdt:tot_from,todt:tot_to,stwrd:stwrdid,type:typeval},
			  function(data)
			  {
					data=$.trim(data);
					$('#reportload').html(data);
			  });*/

	});
	 /*****************************************Steward ends**************************************************************/

/*******************************************Item Orderd starts**********************************************/
//// datepickertodtord datepickerfromord
	
	$('#datepickerfromord').change(function () {
		//alert($(this).val());
		$('#ui-datepicker-div').css("display", "none");
		var fromval=$(this).val();
	
		var tot_to=$('#datepickertodtord').val();
		
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;
		
		if(tot_to=="")
		{
			tot_to="";
		}
			$.post("load_reportcheck.php", {fromdt:fromval,todt:tot_to,type:typeval},
			  function(data)
			  {
					data=$.trim(data);
					
					if(data!="sorry")
					{
						$.post("load_report.php", {fromdt:fromval,todt:tot_to,type:typeval},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
					}else
					{
						 	$('#reportload').empty();	
								$('#rptstatus').css("display", "block");
			  var rptstatus8=$('#rptstatus');
			 // alert(rptstatus);
		  rptstatus8.text('No records to display');	
		$("#rptstatus").delay(1000).fadeOut('slow');
					}
			  });
		
	/*	$.post("load_report.php", {fromdt:fromval,todt:tot_to,type:typeval},
			  function(data)
			  {
					data=$.trim(data);
					$('#reportload').html(data);
			  });*/
	});
	$('#datepickerfromord').click(function () {
		$('#ui-datepicker-div').css("display", "block");
	});	
	
	
	
	$('#datepickertodtord').click(function () {
		$('#ui-datepicker-div').css("display", "block");
	});	
	
	$('#datepickertodtord').change(function () {
		
		$('#ui-datepicker-div').css("display", "none");
		var tot_to=$(this).val();
		var tot_from=$('#datepickerfromord').val();
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;
		if(tot_from=="")
		{
			tot_from="";
		}
$.post("load_reportcheck.php", {fromdt:tot_from,todt:tot_to,type:typeval},
			  function(data)
			  {
					data=$.trim(data);
					if(data!="sorry")
					{
						$.post("load_report.php", {fromdt:tot_from,todt:tot_to,type:typeval},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
					}else
					{
						 	$('#reportload').empty();	
								$('#rptstatus').css("display", "block");
			  var rptstatus9=$('#rptstatus');
			 // alert(rptstatus);
		  rptstatus9.text('No records to display');	
		$("#rptstatus").delay(1000).fadeOut('slow');
					}
			  });
	});
	/*****************************************Item Orderd ends**************************************************************/
	
	
	
		/*****************************************Portion orderd starts**************************************************************/
	
	
	$('#datepickerfromdtprtn').change(function () {
		//alert($(this).val());
		$('#ui-datepicker-div').css("display", "none");
		var fromval=$(this).val();
	
		var tot_to=$('#datepickertodtprtn').val();
			var typeval=$('#typeval').val();
		var portion=$('#portiontp').val();//document.getElementById("typeval").value;
		
		if(tot_to=="")
		{
			tot_to="";
		}
			$.post("load_reportcheck.php", {fromdt:fromval,todt:tot_to,type:typeval,portn:portion},
			  function(data)
			  {
					data=$.trim(data);
					
					if(data!="sorry")
					{
						$.post("load_report.php", {fromdt:fromval,todt:tot_to,type:typeval,portn:portion},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
					}else
					{
						 	$('#reportload').empty();	
								$('#rptstatus').css("display", "block");
			  var rptstatus33=$('#rptstatus');
			 // alert(rptstatus);
		  rptstatus33.text('No records to display');	
		$("#rptstatus").delay(1000).fadeOut('slow');
					}
			  });
		
	/*	$.post("load_report.php", {fromdt:fromval,todt:tot_to,type:typeval},
			  function(data)
			  {
					data=$.trim(data);
					$('#reportload').html(data);
			  });*/
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
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;
		var portion=$('#portiontp').val();
		if(tot_from=="")
		{
			tot_from="";
		}
$.post("load_reportcheck.php", {fromdt:tot_from,todt:tot_to,type:typeval,portn:portion},
			  function(data)
			  {
					data=$.trim(data);
					if(data!="sorry")
					{
						$.post("load_report.php", {fromdt:tot_from,todt:tot_to,type:typeval,portn:portion},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
					}else
					{
						 	$('#reportload').empty();	
								$('#rptstatus').css("display", "block");
			  var rptstatus34=$('#rptstatus');
			 // alert(rptstatus);
		  rptstatus34.text('No records to display');	
		$("#rptstatus").delay(1000).fadeOut('slow');
					}
			  });
	});
	
	
		$('#portiontp').change(function () {
		
		var portnid=$(this).val();
		var typeval=$('#typeval').val(); 
		var tot_from=$('#datepickerfromdtstw').val();
		var tot_to=$('#datepickertodtstw').val();
		$.post("load_reportcheck.php", {fromdt:tot_from,todt:tot_to,portn:portnid,type:typeval},
			  function(data)
			  {
			     
					data=$.trim(data);
					if(data!="sorry")
					{
						
						$.post("load_report.php", {fromdt:tot_from,todt:tot_to,portn:portnid,type:typeval},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
					}else
					{
						 	$('#reportload').empty();	
								$('#rptstatus').css("display", "block");
			  var rptstatus44=$('#rptstatus');
			 // alert(rptstatus);
		  rptstatus44.text('No records to display');	
		$("#rptstatus").delay(1000).fadeOut('slow');
					}
			  });
	/*	$.post("load_report.php", {fromdt:tot_from,todt:tot_to,stwrd:stwrdid,type:typeval},
			  function(data)
			  {
					data=$.trim(data);
					$('#reportload').html(data);
			  });*/
	});
	
	
	
	
	
	
	
	
	
	
	/*****************************************Portion orderd ends**************************************************************/
	/*******************************************Type of order starts**********************************************/
////   datepickerfromdttpord datepickertodttpord  ordertyp
	
	$('#datepickerfromdttpord').change(function () {
		//alert($(this).val());
		$('#ui-datepicker-div').css("display", "none");
		var fromval=$(this).val();
		var tot_to=$('#datepickertodttpord').val();
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;
		var ordtype=$('#ordertyp').val();
		if(tot_to=="")
		{
			tot_to="";
		}
		$.post("load_reportcheck.php", {fromdt:fromval,todt:tot_to,type:typeval,ordtype:ordtype},
			  function(data)
			  {
					data=$.trim(data);
					if(data!="sorry")
					{
						$.post("load_report.php", {fromdt:fromval,todt:tot_to,type:typeval,ordtype:ordtype},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
					}else
					{
							$('#reportload').empty();
								$('#rptstatus').css("display", "block");	
			  var rptstatus10=$('#rptstatus');
			 // alert(rptstatus);
		  rptstatus10.text('No records to display');	
		$("#rptstatus").delay(1000).fadeOut('slow');
					}
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
		if(tot_from=="")
		{
			tot_from="";
		}
			$.post("load_reportcheck.php", {fromdt:tot_from,todt:tot_to,type:typeval,ordtype:ordtype},
			  function(data)
			  {
					data=$.trim(data);
					if(data!="sorry")
					{
						$.post("load_report.php", {fromdt:tot_from,todt:tot_to,type:typeval,ordtype:ordtype},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
					}else
					{
							$('#reportload').empty();	
								$('#rptstatus').css("display", "block");
			  var rptstatus11=$('#rptstatus');
			 // alert(rptstatus);
		  rptstatus11.text('No records to display');	
		$("#rptstatus").delay(1000).fadeOut('slow');
					}
			  });	  
		
	});
	/*****************************************Type of order ends**************************************************************/

  });
  </script>


 
</head>
<body>

 <?php  include "includes/topbar_master.php"; ?>

 <?php include "includes/left_menu.php"; ?>
						
 <div  class="sitemap_cc">Report</div>
  <div id="container">  
<div class="col-md-12 main_contant_container nopaddding">
    <div class="col-lg-12 col-md-12 report_main_cc" style="padding-top:10px; background-color:rgb(208, 208, 208);">
        <div class="col-lg-12 col-md-12 nopadding" style="background-color:#FCFCFC;  ">
            <div class="header_main_container">
                <div class="col-lg-12 col-md-12 nopadding">
                    <!-- condition starts -->                         
                    <div class="col-lg-12 col-md-12 nopadding top_main_cc">
                        <div class="col-lg-2 col-md-2 no-padding filter_txt_cc"><div class="filter_heading filter_head_1">Select</div></div>
                        <div class="search_name_box_main report_check_box_cc">
                            <!-- type starts -->
                            <div class="search_name_box_main">
                                <div class="text-selection_name">Type</div>
                                   <div class="input-group">
                                         <select  class="form-control add_new_dropdown_report" onChange="reportcreate(this.value)" name="typeval" id="typeval">
                                              <option value="">Type of report</option>
                                                  <option value="tot_sales">Total sales</option>
                                                   <option value="type_pay">Type Of Payment</option>
                                                    <option value="item">Menu</option>
                                                    <option value="steward">Steward</option>
                                                    <option value="order">Item Ordered</option>
                                                       <option value="portion_order">Item Ordered <?=$_SESSION['s_portionname']?></option>
                                                    <option value="type_order">Type of order</option>
                                            </select>    
                                  </div>
                            </div>
                            <!-- type ends -->
                            
                            <!-- date starts -->                     
                            <div id="totalsalesdiv" style="display:none" >
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
                            </div>
                            <!-- date ends -->  
                            
                             <!-- type of payment starts -->                     
                            <div id="totalpaydiv" style="display:none" >
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">Type:</div>
                                     <div class="input-group">
                                         <select  class="form-control add_new_dropdown_report" name="typepay" id="typepay">
                                              <option value="">Type of report</option>
                                                  <option value="cash">Cash</option>
                                                   <option value="credit">Credit / Debit</option>
                                                    <option value="coupons">Coupons</option>
                                                    <option value="voucher">Voucher</option>
                                                    <option value="cheque">Cheque</option>
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
                                 
                                 
                            </div>
                            <!-- type of payment ends -->  
                            
                            
                            
                              <!-- item starts -->                     
                            <div id="itemselectdiv" style="display:none" >
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">Floor:</div>
                                     <div class="input-group">
                                         <select  class="form-control add_new_dropdown_report" name="floorsel" id="floorsel">
                                              <option value="">Select Floor</option>
                                              <?php  
											  //`tbl_floormaster`(`fr_floorid`, `fr_branchid`, `fr_floorname`, `fr_status`, `fr_servicetax`, `fr_vat`, `fr_servicecharge`)
											  $sql_login  =  $database->mysqlQuery("select * from tbl_floormaster where fr_branchid='".$_SESSION['branchofid']."'"); 
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
                   $sql_ds_nos="select * from tbl_staffmaster where ser_designation='".$_SESSION['desgn_steward']."' ";
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
                                         <input type="text" class="form-control" id="datepickerfromdtstw" >     
                                    </div>
                                 </div>
                                 
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">To  :</div> 
                                     <div class="input-group">
                                         <input type="text" class="form-control" id="datepickertodtstw" >            
                                    </div>
                                 </div>
                                 
                                 
                            </div>
                            <!-- type of Steward ends -->  
                            
                            
                            
                            <!-- Item oredered starts -->                     
                            <div id="totalorderdiv" style="display:none" >
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
                            </div>
                            <!-- Item oredered ends --> 
                            
                            
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
                   $sql_ds_nos="select * from tbl_portionmaster";
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
                                 
                                 
                            </div>
                            <!-- type of Order ends -->  
                            
                              
                                               
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
                    <div class="search_name_box_sub_btn_cc">
                           <div  class="filter_sub_btn ">
                            <a class="btn-setting"  href="#" onclick="print_page()">Print</a>
                            </div>
                     </div>
                     <div class="search_name_box_sub_btn_cc">
                           <div  class="filter_sub_btn ">
                            <a class="btn-setting"  href="#" onclick="pdf_page()">To PDF</a>
                            </div>
                      </div>
                     <div class="search_name_box_sub_btn_cc">
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


<!--<link href="css/resizable.css" rel="stylesheet">
<script src="js/uiresizable.js"></script>
<script>
         $(function() {
            $( "#resizable" ).resizable();
			 $( "#resizable1" ).resizable();
         });
      </script>-->
 
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
/*********************create report on type change starts ********************/
function reportcreate(rpt)
{
	var repttype=rpt;
	if(repttype=="tot_sales")
	{
		$('#totalsalesdiv').css("display", "block");
		$('#totalpaydiv').css("display", "none");
		$('#itemselectdiv').css("display", "none");
		$('#totalorderdiv').css("display", "none");
		$('#totalsteward').css("display", "none");
		$('#typooforder').css("display", "none");
		$('#totalportion').css("display", "none");	
		
		$.post("load_reportcheck.php", {type:repttype},
		  function(data)
		  {
		  		data=$.trim(data);
				if(data!="sorry")
				{
					$.post("load_report.php", {type:repttype},
				  function(data)
				  {
						data=$.trim(data);
						$('#reportload').html(data);
				  });
				}else
				{
						$('#reportload').empty();	
						$('#rptstatus').css("display", "block");
			  var rptstatus20=$('#rptstatus');
			 // alert(rptstatus);
		  rptstatus20.text('No records to display');	
		$("#rptstatus").delay(1000).fadeOut('slow');
			
			
				}
		  		
		  });
		
	}else if(repttype=="type_pay")
	{
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

		
	}
	else if(repttype=="item")
	{//datepickerfromtyp datepickertodttyp
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
		$('#reportload').html("");
	}
	else if(repttype=="steward")
	{
	
		$('#totalsteward').css("display", "block");
		$('#itemselectdiv').css("display", "none");
		$('#totalorderdiv').css("display", "none");
		$('#totalsalesdiv').css("display", "none");
		$('#totalpaydiv').css("display", "none");
        $('#typooforder').css("display", "none");
		$('#totalportion').css("display", "none");	
		$('#datepickerfrom').val("");
		$('#datepickertodt').val("");
		$('#reportload').html("");
	}   
	else if(repttype=="order")
	{
	    $('#totalorderdiv').css("display", "block");
		
		$('#totalsteward').css("display", "none");
		$('#itemselectdiv').css("display", "none");
		$('#totalsalesdiv').css("display", "none");
		$('#totalpaydiv').css("display", "none");
		$('#typooforder').css("display", "none");
		$('#totalportion').css("display", "none");	
		$('#datepickerfromord').val("");
		$('#datepickertodtord').val("");
		$('#reportload').html("");
	} 
	else if(repttype=="portion_order")
	{
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
		
	}
	
	    
	else if(repttype=="type_order")
	{
		$('#typooforder').css("display", "block");
		 $('#totalorderdiv').css("display", "none");
		$('#totalsteward').css("display", "none");
		$('#itemselectdiv').css("display", "none");
		$('#totalsalesdiv').css("display", "none");
		$('#totalpaydiv').css("display", "none");
		$('#totalportion').css("display", "none");	
		$('#datepickerfromord').val("");
		$('#datepickertodtord').val("");
		$('#reportload').html("");
	}
	else
	{
		$('#datepickerfrom').val("");
		$('#datepickertodt').val("");
		$('#totalsalesdiv').css("display", "none");
		$('#reportload').html("");
	}
	
	
}
/*********************create report on type change ends ********************/
 
/*********************create report on total sales from and to change starts ********************/
/*function totalsales_from(fromval)
{
	var tot_to=$('#datepickertodt').val();
	var typeval=document.getElementById("typeval").value;
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
	
	
}
function totalsales_to(toval)
{
	//alert(toval);
	var tot_from=$('#datepickerfrom').val();
	var typeval=document.getElementById("typeval").value;
	if(tot_from=="")
	{
		tot_from="";
	}
	$.post("load_report.php", {fromdt:fromval,todt:tot_to,type:typeval,set:"ft"},
		  function(data)
		  {
		  		data=$.trim(data);
		  		$('#reportload').html(data);
		  });
}*/
/*********************create report on total sales from and to change ends ********************/

function movetoexcelForm()

{
	var check = confirm("Are you sure you want to create excel sheet of these records?");

	if(check==true)
	{
		
		
		var vv=document.getElementById("typeval").value;
		document.getElementById("hidval").value=vv;
		if(vv=="tot_sales")
		{
//			document.getElementById("hidfr").value=$('#datepickerfrom').val();
//			document.getElementById("hidto").value=$('#datepickertodt').val();
			var hidfr=$('#datepickerfrom').val();
			var hidto=$('#datepickertodt').val();
			window.location="excel_download.php?type="+vv+"&hidfr="+hidfr+"&hidto="+hidto;
		}else if(vv=="type_pay")
		{  
//			document.getElementById("hidfr").value=$('#datepickerfromtyp').val();
//			document.getElementById("hidto").value=$('#datepickertodttyp').val();
			var hidfr=$('#datepickerfromtyp').val();
			var hidto=$('#datepickertodttyp').val();
			var tye=document.getElementById("typepay").value; 
			//document.getElementById("hidpaytyp").value=tye;
			window.location="excel_download.php?type="+vv+"&hidfr="+hidfr+"&hidto="+hidto+"&hidpaytyp="+tye;
			
		}else if(vv=="item")
		{ 
		    //document.getElementById("hidfloor").value=$('#floorsel').val();
			var hidfloor=$('#floorsel').val();
			var tye=document.getElementById("typepay").value; 
			//document.getElementById("hidpaytyp").value=tye;
			
			window.location="excel_download.php?type="+vv+"&hidfloor="+hidfloor+"&hidpaytyp="+tye;
		}else if(vv=="steward")
		{ //stewardtp datepickerfromdtstw datepickertodtstw
//			document.getElementById("hidfr").value=$('#datepickerfromdtstw').val();
//			document.getElementById("hidto").value=$('#datepickertodtstw').val();
			var hidfr=$('#datepickerfromdtstw').val();
			var hidto=$('#datepickertodtstw').val();
			var stw=document.getElementById("stewardtp").value; 
			document.getElementById("hidstw").value=stw;
			
			window.location="excel_download.php?type="+vv+"&hidfr="+hidfr+"&hidto="+hidto+"&hidstw="+stw;

		}else if(vv=="order")
		{// datepickertodtord datepickerfromord
	
//			document.getElementById("hidfr").value=$('#datepickerfromord').val();
//			document.getElementById("hidto").value=$('#datepickertodtord').val();
			var hidfr=$('#datepickerfromord').val();
			var hidto=$('#datepickertodtord').val();
			
			window.location="excel_download.php?type="+vv+"&hidfr="+hidfr+"&hidto="+hidto;
			
		}else if(vv=="portion_order")
		{
			var tot_from=$('#datepickerfromdtprtn').val();
			 var tot_to=$('#datepickertodtprtn').val(); 
			 var prtn=document.getElementById("portiontp").value; 
			 window.location="excel_download.php?type="+vv+"&from="+tot_from+"&to="+tot_to+"&prtn="+prtn;
		}
		else if(vv=="type_order")
		{//   datepickerfromdttpord datepickertodttpord  ordertyp
	
			document.getElementById("hidfr").value=$('#datepickerfromdttpord').val();
			document.getElementById("hidto").value=$('#datepickertodttpord').val();
			var ord=document.getElementById("ordertyp").value; 
			document.getElementById("hidord").value=ord;
			
			var tot_from=$('#datepickerfromdttpord').val();
    		var tot_to=$('#datepickertodttpord').val();
			var ordertyp=document.getElementById("ordertyp").value; 
			window.location="excel_download.php?type="+vv+"&from="+tot_from+"&to="+tot_to+"&ordertyp="+ordertyp;
			
		}
		
		//document.submitall.submit();
	}

}
/*function movetoexcelForm()

{
	var check = confirm("Are you sure you want to create excel sheet of these records?");

	if(check==true)
	{
		
		
		var vv=document.getElementById("typeval").value;
		document.getElementById("hidval").value=vv;
		if(vv=="tot_sales")
		{
			document.getElementById("hidfr").value=$('#datepickerfrom').val();
			document.getElementById("hidto").value=$('#datepickertodt').val();
		}else if(vv=="type_pay")
		{  
			document.getElementById("hidfr").value=$('#datepickerfromtyp').val();
			document.getElementById("hidto").value=$('#datepickertodttyp').val();
			var tye=document.getElementById("typepay").value; 
			document.getElementById("hidpaytyp").value=tye;
			
		}else if(vv=="item")
		{ 
		    document.getElementById("hidfloor").value=$('#floorsel').val();
			var tye=document.getElementById("typepay").value; 
			document.getElementById("hidpaytyp").value=tye;
		}else if(vv=="steward")
		{ //stewardtp datepickerfromdtstw datepickertodtstw
			document.getElementById("hidfr").value=$('#datepickerfromdtstw').val();
			document.getElementById("hidto").value=$('#datepickertodtstw').val();
			var stw=document.getElementById("stewardtp").value; 
			document.getElementById("hidstw").value=stw;

		}else if(vv=="order")
		{// datepickertodtord datepickerfromord
	
			document.getElementById("hidfr").value=$('#datepickerfromord').val();
			document.getElementById("hidto").value=$('#datepickertodtord').val();
			
		}else if(vv=="type_order")
		{//   datepickerfromdttpord datepickertodttpord  ordertyp
	
			document.getElementById("hidfr").value=$('#datepickerfromdttpord').val();
			document.getElementById("hidto").value=$('#datepickertodttpord').val();
			var ord=document.getElementById("ordertyp").value; 
			document.getElementById("hidord").value=ord;
			
		}
		
		document.submitall.submit();
	}

}*/
function print_page()
{
	
	var vv=document.getElementById("typeval").value;
	if(vv=="tot_sales")
		{
			var tot_from=$('#datepickerfrom').val();
    		var tot_to=$('#datepickertodt').val();
			window.location="print_bill.php?type="+vv+"&from="+tot_from+"&to="+tot_to+"#print";
		}else if(vv=="type_pay")
		{ 
			 var tot_from=$('#datepickerfromtyp').val();
			 var tot_to=$('#datepickertodttyp').val(); 
			 var typ=document.getElementById("typepay").value; 
			 window.location="print_bill.php?type="+vv+"&from="+tot_from+"&to="+tot_to+"&types="+typ+"#print";
		}
		else if(vv=="item")
		{ 
		     var florvl=$('#floorsel').val();
			 var typ=document.getElementById("typepay").value; 
			 window.location="print_bill.php?type="+vv+"&floorv="+florvl+"#print";
		}else if(vv=="steward")
		{
			var tot_from=$('#datepickerfromdtstw').val();
			 var tot_to=$('#datepickertodtstw').val(); 
			 var stw=document.getElementById("stewardtp").value; 
			 window.loc
			 
			 ation="print_bill.php?type="+vv+"&from="+tot_from+"&to="+tot_to+"&stwr="+stw+"#print";
		}else if(vv=="order")
		{// datepickertodtord datepickerfromord
			var tot_from=$('#datepickerfromord').val();
    		var tot_to=$('#datepickertodtord').val();
			window.location="print_bill.php?type="+vv+"&from="+tot_from+"&to="+tot_to+"#print";
		}else if(vv=="portion_order")
		{
			var tot_from=$('#datepickerfromdtprtn').val();
			 var tot_to=$('#datepickertodtprtn').val(); 
			 var prtn=document.getElementById("portiontp").value; 
			 window.location="print_bill.php?type="+vv+"&from="+tot_from+"&to="+tot_to+"&prtn="+prtn;
		}
		else if(vv=="type_order")
		{//   datepickerfromdttpord datepickertodttpord  ordertyp
			var tot_from=$('#datepickerfromdttpord').val();
    		var tot_to=$('#datepickertodttpord').val();
			var ordertyp=document.getElementById("ordertyp").value; 
			window.location="print_bill.php?type="+vv+"&from="+tot_from+"&to="+tot_to+"&ordertyp="+ordertyp+"#print";
		}
	
	
	
}
function pdf_page()
{
	
	var vv=document.getElementById("typeval").value;
	if(vv=="tot_sales")
		{
			var tot_from=$('#datepickerfrom').val();
    		var tot_to=$('#datepickertodt').val();
			window.location="pdf_bill.php?type="+vv+"&from="+tot_from+"&to="+tot_to;
		}else if(vv=="type_pay")
		{ 
			 var tot_from=$('#datepickerfromtyp').val();
			 var tot_to=$('#datepickertodttyp').val(); 
			 var typ=document.getElementById("typepay").value; 
			 window.location="pdf_bill.php?type="+vv+"&from="+tot_from+"&to="+tot_to+"&types="+typ;
		}
		else if(vv=="item")
		{ 
		     var florvl=$('#floorsel').val();
			 var typ=document.getElementById("typepay").value; 
			 window.location="pdf_bill.php?type="+vv+"&floorv="+florvl;
		}else if(vv=="steward")
		{ //stewardtp datepickerfromdtstw datepickertodtstw
			var tot_from=$('#datepickerfromdtstw').val();
			 var tot_to=$('#datepickertodtstw').val(); 
			 var stwr=document.getElementById("stewardtp").value; 
			 window.location="pdf_bill.php?type="+vv+"&from="+tot_from+"&to="+tot_to+"&stwr="+stwr;
		}else if(vv=="order")
		{
			var tot_from=$('#datepickerfromord').val();
    		var tot_to=$('#datepickertodtord').val();
			window.location="pdf_bill.php?type="+vv+"&from="+tot_from+"&to="+tot_to;
		}else if(vv=="portion_order")
		{
			var tot_from=$('#datepickerfromdtprtn').val();
			 var tot_to=$('#datepickertodtprtn').val(); 
			 var prtn=document.getElementById("portiontp").value; 
			 window.location="pdf_bill.php?type="+vv+"&from="+tot_from+"&to="+tot_to+"&prtn="+prtn;
		}
		else if(vv=="type_order")
		{
			var tot_from=$('#datepickerfromdttpord').val();
    		var tot_to=$('#datepickertodttpord').val();
			 var ordertyp=document.getElementById("ordertyp").value; 
			window.location="pdf_bill.php?type="+vv+"&from="+tot_from+"&to="+tot_to+"&ordertyp="+ordertyp;
		}
	
	
	
}

</script>



</body>
</html>
