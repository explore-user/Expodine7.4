<?php
//include('includes/session.php');		// Check session
session_start();
include("database.class.php"); // DB Connection class

$database	= new Database();
include('includes/master_settings.php');
$_SESSION['pagid']=7;

$_SESSION['host']=HOST_NAME;
$_SESSION['user']=USER_NAME;
$_SESSION['pas']=PASSWORD;
$_SESSION['db']=DATABASE_NAME;
?>
<!DOCTYPE HTML>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="shortcut icon" href="img/favicon.ico">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Reports</title>
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

<style>.left_list_cc{height: 71vh;min-height: 498px !important}
.search_name_box_main .form-control {    border-radius: 5px !important;}
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

















 <link rel="stylesheet" href="css/jquery-ui.css">
 <script src="js/jquery-1.10.2.js"></script>
  <script src="js/jquery-ui.js"></script>
  <link rel="stylesheet" href="css/style_date.css">
 <script>
 $(document).ready(function() {
	  $("#typeofreport").change(function(){
		  var reporttype=$(this).val();//loadfields
		  var dataString;
		  dataString="checkvalue=fielddefine&reportid="+reporttype;
		  var request=  $.ajax({
			type: "POST",
			url: "load_reportall.php",
			data: dataString,
			success: function(data) {
					$('#loadfields').html(data);
					var vars = [];
					var IDs = [];
						IDs.push('typeofreport'); 
						vars.push(reporttype); 
					var dataString;
					dataString="checkvalue=loadreportdata&type=html&ids="+IDs+"&values="+vars;
					var request=  $.ajax({
					  type: "POST",
					  url: "load_reportall.php",
					  data: dataString,
					  success: function(data) {
							  $('#reportload').html(data);
							  
						  }
					  });
					   data = null;
				   dataString = null;
				  request.onreadystatechange = null;
				  request.abort = null;
				  request = null;
				   return false;
					
				}
	  		});
			 data = null;
		 dataString = null;
		request.onreadystatechange = null;
		request.abort = null;
		request = null;
		 return false;
	  
	 });
	 
	 
	

  });
  </script>

 <script>
/*function printdiv(printpage)
{
var headstr = "<html><head><title></title></head><body>";
var footstr = "</body>";
var newstr = document.all.item(printpage).innerHTML;
var oldstr = document.body.innerHTML;
document.body.innerHTML = headstr+newstr+footstr;
window.print();
document.body.innerHTML = oldstr;
return false;
}*/
	$(document).ready(function() {
		$('#prnt').css("display", "block");
		$('#excel').css("display", "block");
		
		$('#prnt').click(function (){
			var vars = [];
			var IDs = [];
			$(".form-control").each(function(){ 
				IDs.push(this.id); 
				vars.push($('#'+this.id).val()); 
			});
			//printdiv('reportload');
			w=window.open();
w.document.write($('#reportload').html());
w.print();
w.close();
			
		});
		
		$('#excel').click(function (){
			var vars = [];
			var IDs = [];
			$(".form-control").each(function(){ 
				IDs.push(this.id); 
				vars.push($('#'+this.id).val()); 
			});
			//alert(IDs)
			//alert(vars)
			window.location="load_reportall.php?checkvalue=loadreportdata&type=excel&ids="+IDs+"&values="+vars;
			/*var dataString;
			  dataString="checkvalue=loadreportdata&type=excel&ids="+IDs+"&values="+vars;
			  var request=  $.ajax({
				type: "POST",
				url: "load_reportdata.php",
				data: dataString,
				success: function(data) {
						//$('#reportload').html(data);
						
					}
				});
				 data = null;
			 dataString = null;
			request.onreadystatechange = null;
			request.abort = null;
			request = null;
			 return false;*/
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
                        <div class="search_name_box_main report_check_box_cc" style="margin-top: 3px;">
                            <!-- type starts -->
                            <div class="search_name_box_main">
                                <div class="text-selection_name">Type</div>
                                   <div class="input-group">
                                         <select  class="form-control add_new_dropdown_report"  name="typeval" id="typeofreport">
                                              <option value="">Type of report</option>
                                            
								   <?php  
								   //`tbl_reportmaster`(`rm_id`, `rm_reportid`, `rm_reportname`, `rm_reportview`, `rm_printa4`, `rm_printertype`)
                                       $sql_login  =  $database->mysqlQuery("select * from tbl_reportmaster where rm_reportview='Y' and rm_reporttype='DI'"); 
                                        $num_login   = $database->mysqlNumRows($sql_login);
                                        if($num_login){
                                            while($result_login  = $database->mysqlFetchArray($sql_login)) 
                                              { 
											  if($result_login['rm_reportid']=="portion_order")
											  {?>
                                               <option value="<?=$result_login['rm_reportid']?>" printtype="<?=$result_login['rm_printa4']?>" printername="<?=$result_login['rm_printertype']?>" printof="<?=$result_login['rm_posprintofanother']?>"><?=$_SESSION['s_portionname']?> Ordered</option>
                                              <?php
											  }else{
											  ?>
                                      		  <option value="<?=$result_login['rm_reportid']?>" printtype="<?=$result_login['rm_printa4']?>" printername="<?=$result_login['rm_printertype']?>" printof="<?=$result_login['rm_posprintofanother']?>"><?=$result_login['rm_reportname']?></option>
                                      		<?php } ?>
                                          <?php }} ?>
                                              
                                     </select> 
                                  </div>
                            </div>
                            <!-- type ends -->
                            <div id="loadfields" >
                            
                            </div>
                                     
                                               
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
                            <a class="btn-setting" target="_blank" >Print</a>
                            </div>
                     </div>
                  <!--   <div class="search_name_box_sub_btn_cc">
                           <div  class="filter_sub_btn ">
                            <a class="btn-setting"  href="#" onclick="pdf_page()">To Text</a>
                            </div>
                      </div>-->
                     <div class="search_name_box_sub_btn_cc" id="excel" style="display:none">
                           <div  class="filter_sub_btn ">
                            <a class="btn-setting"  >TO Excel</a>
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
/*	$('#bymonth').val("null");
	$('#byear').val("null");*/
	
}








/*********************create report on type change starts ********************/

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

function pdf_page()
{
	
	var vv=document.getElementById("typeval").value;
	if(vv=="tot_sales")
		{
			var tot_from=$('#datepickerfrom').val();
    		var tot_to=$('#datepickertodt').val();
		//var hidbydate=$('#bydate').val();
			
			var mail="ambili@exploreitsolutions.com";
			/*$.post("load_pdfexcelcheck.php", {type:vv,hidfr:tot_from,hidto:tot_to,hidbydate:hidbydate},
		  function(data)
		  {
			  	data=$.trim(data);
			
				if(data !="sorry")
				{*/
					//window.location="text.php?type="+vv+"&from="+tot_from+"&to="+tot_to+"&mail="+mail;
				/*}
				else
				{
					$('#reportload').empty();	
						$('#rptstatus').css("display", "block");
			  var rptstatuschk112=$('#rptstatus');
			 // alert(rptstatus);
		  rptstatuschk112.text('No records to export');	
		$("#rptstatus").delay(1000).fadeOut('slow');
				}
		  });
			*/
			
			
			
		}//summarydiv  datepickerfromsummary datepickertosummary bydatesummary summary	
		else if(vv=="summary")
		{
				var tot_from=$('#datepickerfromsummary').val();
    		var tot_to=$('#datepickertosummary').val();
		var hidbydate=$('#bydatesummary').val();
			
			
			$.post("load_pdfexcelcheck.php", {type:vv,hidfr:tot_from,hidto:tot_to,hidbydate:hidbydate},
		  function(data)
		  {
			  	data=$.trim(data);
			
				if(data !="sorry")
				{
					//	$.post("text.php", {type:vv,from:tot_from,to:tot_to,hidbydate:hidbydate},
					
			//window.location="text.php?type="+vv+"&from="+tot_from+"&to="+tot_to+"&hidbydate="+hidbydate;		
					//  function(data)
		//  {
			  
			  
			  
		//  }
					
				//	);
				}
		  });
			
			
		}
			/*
			var tot_from=$('#datepickerfromsummary').val();
    		var tot_to=$('#datepickertosummary').val();
		var hidbydate=$('#bydatesummary').val();
			
			
			$.post("load_pdfexcelcheck.php", {type:vv,hidfr:tot_from,hidto:tot_to,hidbydate:hidbydate},
		  function(data)
		  {
			  	data=$.trim(data);
			
				if(data !="sorry")
				{
					window.location="pdf_bill.php?type="+vv+"&from="+tot_from+"&to="+tot_to+"&hidbydate="+hidbydate;
				}
				else
				{
					$('#reportload').empty();	
						$('#rptstatus').css("display", "block");
			  var rptstatuschk112=$('#rptstatus');
			 // alert(rptstatus);
		  rptstatuschk112.text('No records to export');	
		$("#rptstatus").delay(1000).fadeOut('slow');
				}
		  });
			
			
			
			
		*///billreportdiv datepickerfrombill datepickertobill bydatebillreport bill_details
		else if(vv=="bill_details") 
		{
			var tot_from=$('#datepickerfrombill').val();
    		var tot_to=$('#datepickertobill').val();
		var hidbydate=$('#bydatebillreport').val();
			
			
			$.post("load_pdfexcelcheck.php", {type:vv,hidfr:tot_from,hidto:tot_to,hidbydate:hidbydate},
		  function(data)
		  {
			  	data=$.trim(data);
			
				if(data !="sorry")
				{
					window.location="pdf_bill.php?type="+vv+"&from="+tot_from+"&to="+tot_to+"&hidbydate="+hidbydate;
				}
				else
				{
					$('#reportload').empty();	
						$('#rptstatus').css("display", "block");
			  var rptstatuschk112=$('#rptstatus');
			 // alert(rptstatus);
		  rptstatuschk112.text('No records to export');	
		$("#rptstatus").delay(1000).fadeOut('slow');
				}
		  });
			
			
			
			
		}//// discountsalesdiv  datepickerfromdisc  datepickertodtdisc bydatedisc  discount_report
		else if(vv=="discount_report")
		{
			var tot_from=$('#datepickerfromdisc').val();
    		var tot_to=$('#datepickertodtdisc').val();
		var hidbydate=$('#bydatedisc').val();
			
			
			$.post("load_pdfexcelcheck.php", {type:vv,hidfr:tot_from,hidto:tot_to,hidbydate:hidbydate},
		  function(data)
		  {
			  	data=$.trim(data);
			
				if(data !="sorry")
				{
					window.location="pdf_bill.php?type="+vv+"&from="+tot_from+"&to="+tot_to+"&hidbydate="+hidbydate;
				}
				else
				{
					$('#reportload').empty();	
						$('#rptstatus').css("display", "block");
			  var rptstatuschk112=$('#rptstatus');
			 // alert(rptstatus);
		  rptstatuschk112.text('No records to export');	
		$("#rptstatus").delay(1000).fadeOut('slow');
				}
		  });
			
			
			
		// kot_report kotsalesdiv datepickerfromkot datepickertodtkot bydatekot		
		}
		else if(vv=="kot_report")
		{
			var tot_from=$('#datepickerfromkot').val();
    		var tot_to=$('#datepickertodtkot').val();
		var hidbydate=$('#bydatekot').val();
			
			
			$.post("load_pdfexcelcheck.php", {type:vv,hidfr:tot_from,hidto:tot_to,hidbydate:hidbydate},
		  function(data)
		  {
			  	data=$.trim(data);
			
				if(data !="sorry")
				{
					window.location="pdf_bill.php?type="+vv+"&from="+tot_from+"&to="+tot_to+"&hidbydate="+hidbydate;
				}
				else
				{
					$('#reportload').empty();	
						$('#rptstatus').css("display", "block");
			  var rptstatuschk112=$('#rptstatus');
			 // alert(rptstatus);
		  rptstatuschk112.text('No records to export');	
		$("#rptstatus").delay(1000).fadeOut('slow');
				}
		  });
			
			
			
		
		}
		else if(vv=="bill_cancel")
		{
			var tot_from=$('#datepickerfrom_cl').val();
    		var tot_to=$('#datepickertodt_cl').val();
		var hidbydate=$('#bydate_cl').val();
			
			
			$.post("load_pdfexcelcheck.php", {type:vv,hidfr:tot_from,hidto:tot_to,hidbydate:hidbydate},
		  function(data)
		  {
			  	data=$.trim(data);
			
				if(data !="sorry")
				{
					window.location="pdf_bill.php?type="+vv+"&from="+tot_from+"&to="+tot_to+"&hidbydate="+hidbydate;
				}
				else
				{
					$('#reportload').empty();	
						$('#rptstatus').css("display", "block");
			  var rptstatuschk112=$('#rptstatus');
			 // alert(rptstatus);
		  rptstatuschk112.text('No records to export');	
		$("#rptstatus").delay(1000).fadeOut('slow');
				}
		  });
			
			
			
			
		}
		else if(vv=="type_pay")
		{ 
			 var tot_from=$('#datepickerfromtyp').val();
			 var tot_to=$('#datepickertodttyp').val(); 
			 var typ=document.getElementById("typepay").value; 
			 var paybydate=document.getElementById("paybydate").value; 
			 
			 if(typ!="null")
			 {
			 $.post("load_pdfexcelcheck.php", {type:vv,hidfr:tot_from,hidto:tot_to,hidpaytyp:typ,hidpay:paybydate},
		  function(data)
		  {
			  	data=$.trim(data);
			//alert(data);
				if(data !="sorry")
				{
						 window.location="pdf_bill.php?type="+vv+"&from="+tot_from+"&to="+tot_to+"&types="+typ+"&hidpay="+paybydate;
				}
				else
				{
					$('#reportload').empty();	
						$('#rptstatus').css("display", "block");
			  var rptstatuschk15=$('#rptstatus');
			 // alert(rptstatus);
		  rptstatuschk15.text('No records to export');	
		$("#rptstatus").delay(1000).fadeOut('slow');
				}
		  });
			 
			 
			 
			 
			 
			 
			 
			 
			 
			 
			 
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
		}else if(vv=="steward")
		{ //stewardtp datepickerfromdtstw datepickertodtstw
			var tot_from=$('#datepickerfromdtstw').val();
			 var tot_to=$('#datepickertodtstw').val(); 
			 var stwr=document.getElementById("stewardtp").value; 
			  var stewardbydate=document.getElementById("stewardbydate").value; 
			 if(stwr !="")
			 {
			
			 
			 
			 	$.post("load_pdfexcelcheck.php", {type:vv,hidfr:tot_from,hidto:tot_to,hidstw:stwr,hidstwdate:stewardbydate},
		  function(data)
		  {
			  	data=$.trim(data);
		
				if(data !="sorry")
				{
					 window.location="pdf_bill.php?type="+vv+"&from="+tot_from+"&to="+tot_to+"&stwr="+stwr+"&hidstwbydate="+stewardbydate;
				}
				else
				{
					$('#reportload').empty();	
						$('#rptstatus').css("display", "block");
			  var rptstatuschk123344=$('#rptstatus');
			 // alert(rptstatus);
		  rptstatuschk123344.text('No records to export');	
		$("#rptstatus").delay(1000).fadeOut('slow');
				}
		  });	
			
			 
			 
			 
			 
			 
			 
			 
			 
			 }
			 else
			 {
				  ('#reportload').empty();	
				$('#rptstatus').css("display", "block");
			  var rpts7=$('#rptstatus');
		       rpts7.text('No records to export');	
	     	$("#rptstatus").delay(1000).fadeOut('slow');
			 }
		}else if(vv=="order")
		{
			
					var tot_from=$('#datepickerfromord').val();
    		var tot_to=$('#datepickertodtord').val();
			
				var mail="ambili@exploreitsolutions.com";
			/*$.post("load_pdfexcelcheck.php", {type:vv,hidfr:tot_from,hidto:tot_to,hidbydate:hidbydate},
		  function(data)
		  {
			  	data=$.trim(data);
			
				if(data !="sorry")
				{*/
					window.location="text.php?type="+vv+"&from="+tot_from+"&to="+tot_to+"&mail="+mail;
			
			
			/*
			var tot_from=$('#datepickerfromord').val();
    		var tot_to=$('#datepickertodtord').val();
				var hidbydate=$('#orderbydate').val();
			
			
			
				$.post("load_pdfexcelcheck.php", {type:vv,hidfr:tot_from,hidto:tot_to,hidbydate:hidbydate},
		  function(data)
		  {
			  	data=$.trim(data);
		
				if(data !="sorry")
				{
				window.location="pdf_bill.php?type="+vv+"&from="+tot_from+"&to="+tot_to+"&hidbydate="+hidbydate;
				}
				else
				{
					$('#reportload').empty();	
						$('#rptstatus').css("display", "block");
			  var rptstatuschk123456=$('#rptstatus');
			 // alert(rptstatus);
		  rptstatuschk123456.text('No records to export');	
		$("#rptstatus").delay(1000).fadeOut('slow');
				}
		  });	
			
		*/}else if(vv=="portion_order")
		{
			var tot_from=$('#datepickerfromdtprtn').val();
			 var tot_to=$('#datepickertodtprtn').val(); 
			 var prtn=document.getElementById("portiontp").value; 
			var portionbydate=document.getElementById("portionbydate").value; 
			
			  $.post("load_pdfexcelcheck.php", {type:vv,from:tot_from,to:tot_to,prtn:prtn,hidportn:portionbydate},
		  function(data)
		  {
			  	data=$.trim(data);
		
				if(data !="sorry")
				{
					 window.location="pdf_bill.php?type="+vv+"&from="+tot_from+"&to="+tot_to+"&prtn="+prtn+"&hidportn="+portionbydate;
				}
				else
				{
					$('#reportload').empty();	
						$('#rptstatus').css("display", "block");
			  var rptstatuschk12399=$('#rptstatus');
			 // alert(rptstatus);
		  rptstatuschk12399.text('No records to export');	
		$("#rptstatus").delay(1000).fadeOut('slow');
				}
		  });	
		}
		else if(vv=="type_order")
		{
			var tot_from=$('#datepickerfromdttpord').val();
    		var tot_to=$('#datepickertodttpord').val();
			 var ordertyp=document.getElementById("ordertyp").value; 
			  var ordertypebydate=document.getElementById("ordertypebydate").value; 
			 if(ordertyp !="")
			 {
			
			 $.post("load_pdfexcelcheck.php", {type:vv,from:tot_from,to:tot_to,ordertyp:ordertyp,hidorderby:ordertypebydate},
		  function(data)
		  {
			  	data=$.trim(data);
		
				if(data !="sorry")
				{
					window.location="pdf_bill.php?type="+vv+"&from="+tot_from+"&to="+tot_to+"&ordertyp="+ordertyp+"&hidorderby="+ordertypebydate;
			
				}
				else
				{
					$('#reportload').empty();	
						$('#rptstatus').css("display", "block");
			  var rptstatuschk1234567=$('#rptstatus');
			 // alert(rptstatus);
		  rptstatuschk1234567.text('No records to export');	
		$("#rptstatus").delay(1000).fadeOut('slow');
				}
		  });		
			
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
		{////datepickerfromcancel datepickertodtcancel orderbydatecancel
		var fromdt=$('#datepickerfromcancel').val();
			var todt=$('#datepickertodtcancel').val();
			var ord=document.getElementById("orderbydatecancel").value;//alert(ord)
			if(ord=='null')
			{
				$.post("load_reportcheck.php", {fromdt:fromdt,todt:todt,type:vv,set:"ft"},
			  function(data)
			  {
					data=$.trim(data);
					if(data!="sorry")
					{
						//
						//window.open("print_bill.php?type="+vv+"&from="+fromdt+"&to="+todt+"#print",'_blank')
						window.location="pdf_bill.php?type="+vv+"&from="+fromdt+"&to="+todt;
						//window.location="excel_download.php?type="+vv+"&from="+fromdt+"&to="+todt;
						/*$.post("load_report.php", {fromdt:tot_from,todt:tot_to,type:typeval,set:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});*/
					}else
					{
						  $('#reportload').empty();	
						  $('#rptstatus').css("display", "block");
						  var rptstatus11=$('#rptstatus');
						  rptstatus11.text('No records to Print');	
						  $("#rptstatus").delay(1000).fadeOut('slow');
					}
			  });
				
			}else
			{
				$.post("load_reportcheck.php", {ordertypebydate:ord,type:vv,abc:"ft"},
			  function(data)
			  {
					data=$.trim(data);
					if(data!="sorry")
					{
						//window.location="excel_download.php?type="+vv+"&from="+fromdt+"&to="+todt+"&ordertyp="+ord;
						//window.open("print_bill.php?type="+vv+"&from="+fromdt+"&to="+todt+"&ordertyp="+ord+"#print",'_blank')
						window.location="pdf_bill.php?type="+vv+"&from="+fromdt+"&to="+todt+"&ordertyp="+ord;
					}else
					{
					  $('#reportload').empty();
					  $('#rptstatus').css("display", "block");	
					  var rptstatus10=$('#rptstatus');
					  // alert(rptstatus);
					  rptstatus10.text('No records to Print');	
					  $("#rptstatus").delay(1000).fadeOut('slow');
					}
			  });	 
				
			}
			
		}
		
		else if(vv=="complementary_report")
		{
			var tot_from=$('#datepickercompfrom').val();
    		var tot_to=$('#datepickercomptodt').val();
		var hidbydate=$('#bycompdate').val();
			
			
			$.post("load_pdfexcelcheck.php", {type:vv,hidfr:tot_from,hidto:tot_to,hidbydate:hidbydate},
		  function(data)
		  {
			  	data=$.trim(data);
			
				if(data !="sorry")
				{
					window.location="pdf_bill.php?type="+vv+"&from="+tot_from+"&to="+tot_to+"&hidbydate="+hidbydate;
				}
				else
				{
					$('#reportload').empty();	
						$('#rptstatus').css("display", "block");
			  var rptstatuschk112=$('#rptstatus');
			 // alert(rptstatus);
		  rptstatuschk112.text('No records to export');	
		$("#rptstatus").delay(1000).fadeOut('slow');
				}
		  });
			
}








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
