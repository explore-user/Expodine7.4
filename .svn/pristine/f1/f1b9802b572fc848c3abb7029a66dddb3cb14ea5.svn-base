<?php
include('includes/session.php');		// Check session
//session_start();
if($_SESSION["archive_enabled"]=='Y'){
    include("database.class.reports.php");  // DB Connection class
    $database	= new Database();
    $con=mysqli_connect(HOST_NAME, USER_NAME, PASSWORD,DATABASE_NAME_REPORT);
}
else if($_SESSION["archive_enabled"]=='N'){
    include("database.class.php");  // DB Connection class
    $database	= new Database();
    $con=mysqli_connect(HOST_NAME, USER_NAME, PASSWORD,DATABASE_NAME);
}
//include('includes/master_settings.php');
$_SESSION['pagid']=20;
?>
<!DOCTYPE HTML>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="shortcut icon" href="img/favicon.ico">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Dayclose</title>
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

	
	$('#datepickerfrom').change(function () {
            //alert('ssss');
		//alert($(this).val());
		$('#ui-datepicker-div').css("display", "none");
		var fromval=$(this).val();
                //alert(fromval);
		var tot_to=$('#datepickertodt').val();
                   
            $('#bydate').val("null");
		
		if(tot_to=="")
		{ //alert(fromval)
			tot_to="";
		}
		
                $.post("load_dayclosedetails.php", {fromdt:fromval,todt:tot_to,ft:"set"},
		function(data)
		{
                    data=$.trim(data);
                    if(data!="sorry")
                    {
                    $('#reportload').html(data);
                    }
                    else{
                           $('#reportload').empty();	
			  $('#rptstatus').css("display", "block");
			  var rptstatus=$('#rptstatus');
			 // alert(rptstatus);
		  rptstatus.text('No records to display');	
		$("#rptstatus").delay(1000).fadeOut('slow');
            }
                });
                
	});
		
		
		
		

        
       $('#datepickertodt').change(function () {
            //alert('ssss');
		//alert($(this).val());
		$('#ui-datepicker-div').css("display", "none");
		var tot_to=$(this).val();
                //alert(tot_to);
		var fromval=$('#datepickerfrom').val();
                
                     
                
                  
                //alert(tot_to);
		//var typeval=$('#typeval').val();//document.getElementById("typeval").value;
		
            $('#bydate').val("null");
		
		if(fromval=="")
		{
			fromval="";
		}
		
						$.post("load_dayclosedetails.php", {fromdt:fromval,todt:tot_to,ft:"set"},
						function(data)
						{
							  data=$.trim(data);
                                                          if(data!="sorry")
                                                        {
							  $('#reportload').html(data);
                                                        
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
	
		$('#bydate').change(function () {
                    //alert('haiiii');
		
		var bydate=$(this).val();
                //alert(bydate);
		
		
		
	  $('#datepickertodt').val(""); 
           $('#datepickerfrom').val("");
		//var bydate=$('#bydate').val();
               
                  
		
		

						$.post("load_dayclosedetails.php", { bydate:bydate,ft:"abc"},
						function(data)
						{
							  data=$.trim(data);
                                                          if(data!="sorry")
					{
							 // alert(data);
							  $('#reportload').html(data);
						}
					else
					{
						//alert("Sorry");
						
					$('#reportload').empty();	
					$('#rptstatus').css("display", "block");
			  var reptstatus=$('#rptstatus');
			 // alert(rptstatus);
		  reptstatus.text('No records to display');	
		$("#rptstatus").delay(1000).fadeOut('slow');
						
					}
			  });
	});



  });
//   $('.dayclosedetails').click(function()
// {
//     alert("hii");
// });
function dayclose(date,dateclose)
{
  //alert(dateclose);
  
  
  
  if(dateclose=="")
  {
                         $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Please day close to print ');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
  }
  else
  {
      
                $("#showmsg").css("display","block");
    
		$("#showmsg").text("Printing");
		$("#showmsg").delay(6000).fadeOut('slow');
                
    $.ajax({
                type: "POST",
                url: "dayclosedetails_print.php",
                data: "date="+date,
                success: function(data)
            {
                
          //alert(data);
           
        }
        });
}
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
						
 <div  class="sitemap_cc">Day Close Details</div>
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
                         
                            <!-- type ends -->
                            
                            <!-- date starts --> 
                
                            
                           
                          
                            <div id="totalsalesdiv" style="display:block" >
                                 
                                
                                
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">From:</div>
                                     <div class="input-group">
                                         <input type="text"  autocomplete="off" class="form-control" id="datepickerfrom" >     
                                    </div>
                                 </div>
                                 
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">To  :</div>
                                     <div class="input-group">
                                         <input type="text" autocomplete="off" class="form-control" id="datepickertodt" >            
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
                                 
                                <span style="float:right;color: red;font-weight: bold;font-size: 16px" id="showmsg"></span>            
                                 
                            </div>
                            <!-- date ends --> 
                           
                         
                       
                         <input type="hidden" name="hida4settings"  id="hida4settings"    value="<?=$_SESSION['s_a4print']?>"  >
                        </div>
                    </div>
                    <!-- condition ends -->                    
                </div><!--col-lg-12 col-md-12 nopadding-->
            </div><!--header_main_container-->
             <div class="top_validate_inform"> <span id="rptstatus" class="load_error alertsmasters"></span>  </div>
                                 
            <div class="col-lg-12 col-md-12 user_detail_min_hieght reporte_min_hieght_1" style="background-color:#FCFCFC;  border-bottom: 1px solid #BDBDBD;  " id="reportload">
              
                                
            </div>
         
            
             
             
             
             
             <div class="col-lg-12
                 col-md-12 nopadding top_main_cc">
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



function clearall()
    {
	$('#datepickertodt').val(""); 
	$('#datepickerfrom').val("");
	$('#bydate').val("null");
        
 	
    }



</script>



</body>
</html>
