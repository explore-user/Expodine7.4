<?php
include('includes/session.php');		// Check session
//session_start();
include("database.class.php"); // DB Connection class

$database	= new Database();
include('includes/master_settings.php');
$_SESSION['pagid']=17;
?>
<!DOCTYPE HTML>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="shortcut icon" href="img/favicon.ico">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Email</title>
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
.reporte_min_hieght_1 {min-height:370px;height: 61vh;padding-bottom:20px;}
.email_repor_auto_height{min-height: 440px;height:73vh}
.filter_txt_cc {min-height: 50px;}
.filter_head_1 {height: 35px;line-height: 46px;}
.search_name_box_main{margin: 0.5% 0px 0px 0.2%;}
.email_report_body_section{width:100%;height:80px;float:left;padding:0.5%;display:none}
.email_textarea{height:75px;resize:none;width:100%;border-radius:5px;margin-bottom:2px;padding-left:10px;}
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
	 $("#datepickertodt").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	
  	
	$("#bydate").change(function(){
   	 		$("#datepickerfrom").val('');  
			$("#datepickertodt").val(''); 
    });
	$("#datepickerfrom").change(function(){
    	 	$('#bydate').find('option:first').attr('selected', 'selected');
			var startDate = $('#datepickerfrom').val();
			//alert(startDate);	
	var newdate	= startDate.split("-");
	/*var date		= newdate[0];
	var month		= newdate[1];
	var year		= newdate[2];*/
	
	/*var c_date		= year."-".month."-".date;*/
			var returnDate = new Date(newdate[2], newdate[1] - 1, newdate[0], 0, 0, 0, 0);
var endDate = $('#datepickertodt').val();
//	alert(endDate);	

if(endDate !="")
{

	var newdte	= endDate.split("-");
	/*var date		= newdate[0];
	var month		= newdate[1];
	var year		= newdate[2];*/
	
	/*var c_date		= year."-".month."-".date;*/
			var returnDte = new Date(newdte[2], newdte[1] - 1, newdte[0], 0, 0, 0, 0);
if (returnDate > returnDte){
	//
	//alert('Select a valid date range');
	var msg=$('#msgstatus');
	   msg.css("display","block");
	msg.text('Select a valid date range');
	 $("#msgstatus").delay(1000).fadeOut('slow');
// Do something
}


}
else
{
		var returnDate = new Date(newdate[2], newdate[1] - 1, newdate[0], 0, 0, 0, 0);
		
		$("#datepickertodt").datepicker("setDate", returnDate);
	/*$("#datepickertodt").val('returnDate'); */
}






    });
	$("#datepickertodt").change(function(){
     		$('#bydate').find('option:first').attr('selected', 'selected');
			/*var startDate = new Date($('#datepickerfrom').val());
			alert(startDate);
var endDate = new Date($('#datepickertodt').val());
alert(endDate);
if (startDate > endDate){
	alert('Select a valid date range');
	

}
*/
var startDate = $('#datepickerfrom').val();
			//alert(startDate);	
			
			
			
	var newdate	= startDate.split("-");
	/*var date		= newdate[0];
	var month		= newdate[1];
	var year		= newdate[2];*/
	
	/*var c_date		= year."-".month."-".date;*/
			var returnDate = new Date(newdate[2], newdate[1] - 1, newdate[0], 0, 0, 0, 0);
			
			
			//alert(returnDate);
var endDate = $('#datepickertodt').val();
	//alert(endDate);	
	var newdte	= endDate.split("-");
	/*var date		= newdate[0];
	var month		= newdate[1];
	var year		= newdate[2];*/
	
	/*var c_date		= year."-".month."-".date;*/
			var returnDte = new Date(newdte[2], newdte[1] - 1, newdte[0], 0, 0, 0, 0);
			if(startDate !="")
			{
			//alert(returnDte);
if (returnDate > returnDte){
	//alert('Select a valid date range');
	var msg=$('#msgstatus');
	   msg.css("display","block");
	msg.text('Select a valid date range');
	 $("#msgstatus").delay(1000).fadeOut('slow');
	
// Do something
}
			}
			else
			{	
		
			var return1Dte = new Date(newdte[2], newdte[1] - 1, newdte[0], 0, 0, 0, 0);
			
		$("#datepickerfrom").datepicker("setDate", return1Dte);
				
			}
    });	
	
	
	
	
	$("input:checkbox").on('click', function() {
  // in the handler, 'this' refers to the box clicked on
  var $box = $(this);
  if ($box.is(":checked")) {
    // the name of the box is retrieved using the .attr() method
    // as it is assumed and expected to be immutable
   var group = "input:checkbox[name='" + $box.attr("name") + "']"; 
	 var prfemail = $box.attr("prfmail");
	 if(prfemail=='Y')
	 {
		$('.email_textbox').val(''); 
		 $('.email_textbox').attr("disabled","disabled");
	 }else
	 {
		 $('.email_textbox').removeAttr("disabled"); 
	 }
    // the checked state of the group/box on the other hand will change
    // and the current value is retrieved using .prop() method
   $(group).prop("checked", false);
    $box.prop("checked", true);
  } else {
    $box.prop("checked", false);
  }
});

	
  });
  </script>


 
</head>
<body>

 <?php  include "includes/topbar_master.php"; ?>

 <?php include "includes/left_menu.php"; ?>
						
 <div  class="sitemap_cc">Email Report</div>
  <div id="container">  
<div class="col-md-12 main_contant_container nopaddding">
    <div class="col-lg-12 col-md-12 report_main_cc" style="padding-top:10px; background-color:rgb(208, 208, 208);">
        <div class="col-lg-12 col-md-12 nopadding" style="background-color:#FCFCFC;  ">
            <div class="header_main_container">
                <div class="col-lg-12 col-md-12 nopadding">
                    <!-- condition starts -->                         
                    <div class="col-lg-12 col-md-12 nopadding top_main_cc ">
                        <div class="col-lg-2 col-md-2 no-padding filter_txt_cc"><div class="filter_heading filter_head_1">Select</div></div>
                        <div class="search_name_box_main report_check_box_cc">
                           
                            
                            <!-- date starts -->  
                            <div id="totalsalesdiv" >
                                <!-------kitchen combo---->
                                 <div class="search_name_box_main" id="kitchen_div"> 
                                 <div class="text-selection_name">Kitchen:</div>
                                     <div class="input-group">
                                         <select  class="form-control add_new_dropdown_report" name="kitchen" id="kitchen" onChange="viewstate(this.value)">
                                              <option value="">All</option>
                                              <?php  
											  //`tbl_floormaster`(`fr_floorid`, `fr_branchid`, `fr_floorname`, `fr_status`, `fr_servicetax`, `fr_vat`, `fr_servicecharge`)
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
                                <!-------kitchen combo end---->
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">From:</div>
                                     <div class="input-group">
                                         <input type="text" class="form-control" id="datepickerfrom" value="<?=date('d-m-Y') ?>" >     
                                    </div>
                                 </div>
                                 
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">To  :</div>
                                     <div class="input-group">
                                         <input type="text" class="form-control" id="datepickertodt" value="<?=date('d-m-Y') ?>">            
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
                                
                                                                         
                             <div style="width:50%;float:right;" class="top_validate_inform"><span id="msgstatus" style="padding-left:20px; padding-top:9px;  display: inline-block; color:#ff0000; font-weight:bold; font-size:larger" ></span> 
                              <span id="rptstatus" class="load_error alertsmasters"></span> 
                               </div>                 
                                    
                            </div>
                            <!-- date ends -->  
                            
                           <!--  <div class="top_validate_inform"> </div>-->
                                      
                                               
                        </div>
                    </div>
                    <!-- condition ends -->                    
                </div><!--col-lg-12 col-md-12 nopadding-->
            </div><!--header_main_container-->
            
                                 
           <div class="col-lg-12 col-md-12 user_detail_min_hieght reporte_min_hieght_1 email_repor_auto_height" style="background-color:#FCFCFC;  border-bottom: 1px solid #BDBDBD;  " id="reportload"><!--email_repor_auto_height-->
               
               <table class="emailer_report_table" width="100%" border="0">
               <?php
			   //`tbl_reportmaster`(`rm_id`, `rm_reportid`, `rm_reportname`, `rm_reportview`, `rm_printa4`, `rm_printertype`, `rm_posprintofanother`, `rm_email`)
			    $sql_login  =  $database->mysqlQuery("select * from tbl_reportmaster WHERE rm_email='Y'"); 
				$num_login   = $database->mysqlNumRows($sql_login);
				if($num_login){$i=1;
					while($result_login  = $database->mysqlFetchArray($sql_login)) 
					  {
			   ?>
                  <tr>
                    <td width="5%"><?=$i++?></td>
                    <td width="5%"><input class="eml_chk_bx" type="checkbox" name="report[]" id="<?=$result_login['rm_reportid'] ?>" prfmail="<?=$result_login['rm_predifinedemails']?>" reportemails="<?=$result_login['rm_emaillist']?>"></td>
                    <td><?=$result_login['rm_reportname'] ?></td>
                  </tr>
                  <?php
					  }
				}
				?>
                </table>

                                <!--  report content-->
            </div>
            
            <div class="col-lg-12 col-md-12 nopadding top_main_cc " style="margin-bottom:0">
                <form name="submitall" id="submitall"  method="post" action="<?php $_SERVER['PHP_SELF']?>"> 
                <div class="email_report_body_section " style="display:none">
                	<textarea class="email_textarea" placeholder="Message"></textarea>
                </div>
                    <input type="text" placeholder="Enter Email" class="email_textbox" name="enteremail"  id="enteremail">
                     
                    <div class="email_report_sendbtn">
                           <div  class="filter_sub_btn ">
                            <a class="btn-setting"  href="#" onClick="checksendreport()">Send</a>
                            </div>
                     </div>
                     
                </form> 
            </div>
         
            <!--<div class="col-lg-12 col-md-12 nopadding top_main_cc">
                <form name="submitall" id="submitall"  method="post" action="<?php $_SERVER['PHP_SELF']?>"> 
                    
                     
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
            </div>-->
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
 function checksendreport()
{
	//datepickerfrom datepickertodt bydate eml_chk_bx enteremail
	var datefrom=$('#datepickerfrom').val(); 
	var dateto=$('#datepickertodt').val(); 
	var bydate=$('#bydate').val(); 
        var kitchen=$('#kitchen').val(); 
	//var reportcheckbox=$('#eml_chk_bx').val(); 
	var enteremail=$('#enteremail').val(); 
	var vv="";
	var ids = new Array();
	var countdat=0;var countdrop=0;
	if(datefrom!='')
	{
		countdat++;
	}
	if(dateto!='')
	{
		countdat++;
	}
	if(bydate!='null')
	{
		countdrop++;
	}
	//alert(countdrop)
	//alert(countdat)
	if(countdrop==0 && countdat==0)
	{
		alert("Please select any date fields");
         return false;
	}
	
	var count_checked = $("[name='report[]']:checked").length; // count the checked rows

	
        if(count_checked == 0) 
        {
            alert("Please select any report field");
            return false;
			
        }else
		{
			var selected_activities =$("[name='report[]']:checked");
			selected_activities.each(function(){
			  var id_str       =  $(this).attr("id");
		
			  if(id_str!='undefined' && id_str!='' && id_str!=null){
					  ids.push(id_str);
				  }
			});
			 
			//return true;
		}
   var vv;
 //reportemails
   if(document.getElementById("enteremail").hasAttribute("disabled")) 
   { vv='';
   var selected_activities =$("[name='report[]']:checked");

   var id_str_test;
    var ids_test='';//=new Array();
   selected_activities.each(function(){
     id_str_test       =  $(this).attr("reportemails");
	 if(id_str_test!='undefined' && id_str_test!='' && id_str_test!=null){
					  //ids.push(id_str);
					  if(ids_test=='')
					  {
						  ids_test=id_str_test;
					  }else
					  {
					  ids_test=ids_test+","+id_str_test;
					  }
				  }
	});
	//alert(ids_test)
	var s=ids_test;//id_str;
	var values=s.split(',');
	
	var legt=values.length;

	var nn=0;
	for (var i = 0; i < values.length; i++) 
	{ 
	//alert(values[i]);
	var str=values[i];
	//alert(str);
	
	vv=str.trim() + "," + vv;
	//alert(vv);
		if((emailvalidation(str.trim()))==false)
		{
			nn=1;
		}
	}
	if(nn==1)
	{
		
		alert("Invalid email address! Please Check!");
		document.getElementById("enteremail").select();
		document.getElementById("enteremail").focus();
		return false;
	}
	vv = vv.substring(0, vv.length - 1);
	
	
	//vv=id_str;
	//alert(id_str)
   }
   else{
	if(enteremail=='')
	{
		alert("Please enter any email address");
            return false;
	}else
	{
		var s=enteremail;
		var values=s.split(',');
		
		var legt=values.length;
		
		//alert(legt);
		var nn=0;
		for (var i = 0; i < values.length; i++) 
		{ 
		//alert(values[i]);
		var str=values[i];
		vv=str.trim() + "," + vv;
			if((emailvalidation(str.trim()))==false)
			{
				nn=1;
			}
		}
		if(nn==1)
		{
			
			alert("Invalid email address! Please re-enter!");
			document.getElementById("enteremail").select();
			document.getElementById("enteremail").focus();
			return false;
		}
		vv = vv.substring(0, vv.length - 1);
		
		
		//return true;
	}
   }
	//alert(vv);
//reports with mail ids



//append the ids with mail list
	
	
	
window.location="reports_emailpage.php?mail="+vv+"&from="+datefrom+"&to="+dateto+"&hidbydate="+bydate+"&reports="+ids+"&kitchen="+kitchen;

	
	
	/*if(validate_report())
	{
		document.report.submit();

	}*/
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
function emailvalidation(entered) {

    var email = entered;
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

    if (!filter.test(entered)) 
	{
   // $("#email_div").addClass("has-error");
	//document.staff_master.email.focus();
	return false;
 	}else
	{
		 //$("#email_div").removeClass("has-error");
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
	  
	
}


function pdf_page()
{
	
	var vv=document.getElementById("typeval").value;
	if(vv=="tot_sales")
		{
			var tot_from=$('#datepickerfrom').val();
    		var tot_to=$('#datepickertodt').val();
		var hidbydate=$('#bydate').val();
			
			
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
			
			
			
			
		}//billreportdiv datepickerfrombill datepickertobill bydatebillreport bill_details
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
			
		}else if(vv=="portion_order")
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
	
	
	
}
$('#kitchen_div').css("display", "none");
$('#kitchen_wise').change(function () {
    if (this.checked){
        //alert("hi");
        $('#kitchen_div').css("display", "block");
    }
    });


</script>



</body>
</html>
