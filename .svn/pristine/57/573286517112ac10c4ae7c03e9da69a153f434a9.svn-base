<?php
include('includes/session.php');		// Check session
//session_start();
include("database.class.php"); // DB Connection class
error_reporting(0);
$_SESSION['pagid']=7;
$database	= new Database();
$_SESSION['host']=HOST_NAME;
$_SESSION['user']=USER_NAME;
$_SESSION['pas']=PASSWORD;
$_SESSION['db']=DATABASE_NAME;
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<link rel="shortcut icon" href="img/favicon.ico">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Analytics</title>
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
      changeYear: true,
	  maxDate: "+0D "
    });
	 $("#datepickertodt").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });     
	
	$("#datepickerfromtot").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	 $("#datepickertodttot").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	
	 $("#datepickerfromitem").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	 $("#datepickertodtitem").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	
	$("#datepickerfromcmp").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	 $("#datepickertodtcmp").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	
	
	$("#datepickerfromstf").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	 $("#datepickertodtstf").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	
	
	
	
	/*******************************************date picker change sales starts**********************************************/
	$('#datepickerfrom').change(function () {
		$('#paybydate').find('option:first').attr('selected', 'selected');
		//alert($(this).val());
		$('#ui-datepicker-div').css("display", "none");
		var fromval=$(this).val();
		var tot_to=$('#datepickertodt').val();
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;
		if(tot_to=="")
		{
			tot_to="";
		}
		$.post("load_analyiticscheck.php", {fromdt:fromval,todt:tot_to,type:'tot_sales_an',set:"ft"},
			  function(data)
			  {
				  
					data=$.trim(data);
					
					//alert(data);
					if(data!="sorry")
					  {
						  $('#reportload').empty();
						  $('#reportload').append('<iframe id="reportload_frame" width="100%" height="350px" frameborder="0" style="  margin-left: 15%;"></iframe>');
						  var params ="total_sales_report.php?fromdt="+fromval+"&todt="+tot_to+"&type="+typeval+"&set=ft&model=pie";
						  $('#reportload_frame').attr("src", params);
						  
						  $('#reportload').append('<iframe id="reportload_frame2" width="100%" height="350px" frameborder="0" style="  margin-left: 15%;"></iframe>');
						  var params = "total_sales_report.php?fromdt="+fromval+"&todt="+tot_to+"&type="+typeval+"&set=ft&model=horz";
						  $('#reportload_frame2').attr("src", params);
						  
						  $('#reportload').append('<iframe id="reportload_frame3" width="100%" height="350px" frameborder="0" style="  margin-left: 15%;"></iframe>');
						  var params = "total_sales_report.php?fromdt="+fromval+"&todt="+tot_to+"&type="+typeval+"&set=ft&model=vert";
						  $('#reportload_frame3').attr("src", params);
						  
						  $('#reportload').append('<iframe id="reportload_frame4" width="100%" height="350px" frameborder="0" style="  margin-left: 15%;"></iframe>');
						  var params = "total_sales_report.php?fromdt="+fromval+"&todt="+tot_to+"&type="+typeval+"&set=ft&model=line";
						  $('#reportload_frame4').attr("src", params);
						  
						 
						  
					  }else
					  {
						  $('#reportload').html("<div class='erroranalytics'> No Records found </div>");
						 // $('#reportload').append('<iframe id="reportload_frame" width="100%" height="500px" frameborder="0" style="  margin-left: 15%;">Sorry</iframe>');
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
	$('#paybydate').find('option:first').attr('selected', 'selected');	
		$('#ui-datepicker-div').css("display", "none");
		var tot_to=$(this).val();
		var tot_from=$('#datepickerfrom').val();
		var typeval=$('#typeval').val();
		if(tot_from=="")
		{
			tot_from="";
		}
		$.post("load_analyiticscheck.php", {fromdt:tot_from,todt:tot_to,type:'tot_sales_an',set:"ft"},
			  function(data)
			  {
					data=$.trim(data);
					if(data!="sorry")
					  {
						  $('#reportload').empty();
						  $('#reportload').append('<iframe id="reportload_frame" width="100%" height="350px" frameborder="0" style="  margin-left: 15%;"></iframe>');
						  var params ="total_sales_report.php?fromdt="+tot_from+"&todt="+tot_to+"&type="+typeval+"&set=ft&model=pie";
						  $('#reportload_frame').attr("src", params);
						  
						  $('#reportload').append('<iframe id="reportload_frame2" width="100%" height="350px" frameborder="0" style="  margin-left: 15%;"></iframe>');
						  var params = "total_sales_report.php?fromdt="+tot_from+"&todt="+tot_to+"&type="+typeval+"&set=ft&model=horz";
						  $('#reportload_frame2').attr("src", params);
						  
						  
						  $('#reportload').append('<iframe id="reportload_frame3" width="100%" height="350px" frameborder="0" style="  margin-left: 15%;"></iframe>');
						  var params = "total_sales_report.php?fromdt="+tot_from+"&todt="+tot_to+"&type="+typeval+"&set=ft&model=vert";
						  $('#reportload_frame3').attr("src", params);
						  
						   $('#reportload').append('<iframe id="reportload_frame4" width="100%" height="350px" frameborder="0" style="  margin-left: 15%;"></iframe>');
						  var params = "total_sales_report.php?fromdt="+tot_from+"&todt="+tot_to+"&type="+typeval+"&set=ft&model=line";
						  $('#reportload_frame4').attr("src", params);
						  
						 
					
					  }else
					  {
						 $('#reportload').html("<div class='erroranalytics'> No Records found </div>");
						  //$('#reportload').append('<iframe id="reportload_frame" width="100%" height="500px" frameborder="0" style="  margin-left: 15%;">Sorry</iframe>');
					  }
					
			  });

	});
	/*********************************date picker change sales ends*******************************************************/
	
	/*********************************paybydate starts*******************************************************/
	$('#paybydate').change(function () {
		var typeval=$('#typeval').val();
		var paymentyp=($('#paybydate').val());
		$('#datepickertodt').val('');
		$('#datepickerfrom').val('');
		$.post("load_analyiticscheck.php", {paymenttyp:paymentyp,type:'tot_sales_an',newsearch:"chk"},
			  function(data)
			  {
					data=$.trim(data);
				
					if(data!="sorry")
					  {
						  $('#reportload').empty();
						  $('#reportload').append('<iframe id="reportload_frame" width="100%" height="350px" frameborder="0" style="  margin-left: 15%;"></iframe>');
						  var params ="total_sales_report.php?paymenttyp="+paymentyp+"&type="+typeval+"&newsearch=chk&model=pie";
						 
						  $('#reportload_frame').attr("src", params);
						  
						  $('#reportload').append('<iframe id="reportload_frame2" width="100%" height="350px" frameborder="0" style="  margin-left: 15%;"></iframe>');
						  var params = "total_sales_report.php?paymenttyp="+paymentyp+"&type="+typeval+"&newsearch=chk&model=horz";
						  $('#reportload_frame2').attr("src", params);
						  
						  
						  $('#reportload').append('<iframe id="reportload_frame3" width="100%" height="350px" frameborder="0" style="  margin-left: 15%;"></iframe>');
						  var params = "total_sales_report.php?paymenttyp="+paymentyp+"&type="+typeval+"&newsearch=chk&model=vert";
						  $('#reportload_frame3').attr("src", params);
						  
						  $('#reportload').append('<iframe id="reportload_frame4" width="100%" height="350px" frameborder="0" style="  margin-left: 15%;"></iframe>');
						  var params = "total_sales_report.php?paymenttyp="+paymentyp+"&type="+typeval+"&newsearch=chk&model=line";
						  $('#reportload_frame4').attr("src", params);
						  
						 
					
					  }else
					  {
						  $('#reportload').html("<div class='erroranalytics'> No Records found </div>");
						  //$('#reportload').append('<iframe id="reportload_frame" width="100%" height="500px" frameborder="0" style="  margin-left: 15%;">Sorry</iframe>');
					  }
					
			  });
		
	});
	/*********************************paybydate starts*******************************************************/
	
	//############################################### Item wise starts here############################################################
	
	/*******************************************date picker change item starts**********************************************/
	$('#datepickertodtitem').change(function () {
		$('#paybydateitem').find('option:first').attr('selected', 'selected');
		var tot_to=$('#datepickertodtitem').val();
		var tot_from=$('#datepickerfromitem').val();
		var typeval=$('#typeval').val();
		var itemid=$('#itemlist').val();
		if(tot_from=="")
		{
			tot_from="";
		}
		$.post("load_analyiticscheck.php", {itemid:itemid,fromdt:tot_from,todt:tot_to,type:'itemwisechk',set:"ok"},
		  function(data)
		  {
				data=$.trim(data);
				//alert(data);
				if(data!="sorry")
				  {
					  $('#reportload').empty();
					  $('#reportload').append('<iframe id="reportload_frame" width="100%" height="350px" frameborder="0" style="  margin-left: 15%;"></iframe>');
					  var params ="total_sales_report.php?itemid="+itemid+"&fromdt="+tot_from+"&todt="+tot_to+"&type="+typeval+"&set=chk&model=pie";
					  $('#reportload_frame').attr("src", params);
					  
					  $('#reportload').append('<iframe id="reportload_frame2" width="100%" height="350px" frameborder="0" style="  margin-left: 15%;"></iframe>');
					  var params = "total_sales_report.php?itemid="+itemid+"&fromdt="+tot_from+"&todt="+tot_to+"&type="+typeval+"&set=chk&model=horz";
					  $('#reportload_frame2').attr("src", params);
					  
					  
					  $('#reportload').append('<iframe id="reportload_frame3" width="100%" height="350px" frameborder="0" style="  margin-left: 15%;"></iframe>');
					  var params = "total_sales_report.php?itemid="+itemid+"&fromdt="+tot_from+"&todt="+tot_to+"&type="+typeval+"&set=chk&model=vert";
					  $('#reportload_frame3').attr("src", params);
					  
					  $('#reportload').append('<iframe id="reportload_frame4" width="100%" height="350px" frameborder="0" style="  margin-left: 15%;"></iframe>');
					  var params = "total_sales_report.php?itemid="+itemid+"&fromdt="+tot_from+"&todt="+tot_to+"&type="+typeval+"&set=chk&model=line";
					  $('#reportload_frame4').attr("src", params);
					  
					 
				
				  }else
				  {
					  $('#reportload').html("<div class='erroranalytics'> No Records found </div>");
				  }
				
			  });
		
	});
	$('#datepickerfromitem').click(function () {
		$('#ui-datepicker-div').css("display", "block");
	});	
	
	
	
	$('#datepickerfromitem').click(function () {
		$('#ui-datepicker-div').css("display", "block");
	});	
	$('#datepickerfromitem').change(function () {
		$('#paybydateitem').find('option:first').attr('selected', 'selected');
		var tot_to=$('#datepickerfromitem').val();
		var tot_from=$('#datepickerfromitem').val();
		if(tot_to=="")
		{
			tot_to="";
		}
		var typeval=$('#typeval').val();
		var itemid=$('#itemlist').val();
		$.post("load_analyiticscheck.php", {itemid:itemid,fromdt:tot_from,todt:tot_to,type:'itemwisechk',set:"ok"},
		  function(data)
		  {
				data=$.trim(data);
				//alert(data);
				if(data!="sorry")
				  {
					  $('#reportload').empty();
					  $('#reportload').append('<iframe id="reportload_frame" width="100%" height="350px" frameborder="0" style="  margin-left: 15%;"></iframe>');
					  var params ="total_sales_report.php?itemid="+itemid+"&fromdt="+tot_from+"&todt="+tot_to+"&type="+typeval+"&set=chk&model=pie";
					  $('#reportload_frame').attr("src", params);
					  
					  $('#reportload').append('<iframe id="reportload_frame2" width="100%" height="350px" frameborder="0" style="  margin-left: 15%;"></iframe>');
					  var params = "total_sales_report.php?itemid="+itemid+"&fromdt="+tot_from+"&todt="+tot_to+"&type="+typeval+"&set=chk&model=horz";
					  $('#reportload_frame2').attr("src", params);
					  
					  
					  $('#reportload').append('<iframe id="reportload_frame3" width="100%" height="350px" frameborder="0" style="  margin-left: 15%;"></iframe>');
					  var params = "total_sales_report.php?itemid="+itemid+"&fromdt="+tot_from+"&todt="+tot_to+"&type="+typeval+"&set=chk&model=vert";
					  $('#reportload_frame3').attr("src", params);
					  
					  $('#reportload').append('<iframe id="reportload_frame4" width="100%" height="350px" frameborder="0" style="  margin-left: 15%;"></iframe>');
					  var params = "total_sales_report.php?itemid="+itemid+"&fromdt="+tot_from+"&todt="+tot_to+"&type="+typeval+"&set=chk&model=line";
					  $('#reportload_frame4').attr("src", params);
					  
					 
				
				  }else
				  {
					  $('#reportload').html("<div class='erroranalytics'> No Records found </div>");
				  }
				
			  });
		
	});
	/*******************************************date picker change item ends**********************************************/
		
	/*******************************************items each starts**********************************************/
	$('#itemlist').change(function () {//datepickerfromitem datepickertodtitem paybydateitem
		var tot_to=$('#datepickertodtitem').val();
		var tot_from=$('#datepickerfromitem').val();
		var typeval=$('#typeval').val();
		var itemid=$(this).val();
		if($('#paybydateitem').val()!="")
		{
			var paymentyp=($('#paybydateitem').val());
			$.post("load_analyiticscheck.php", {itemid:itemid,paymenttyp:paymentyp,type:'itemwisechk',newsearch:"ok"},
		  function(data)
		  {
				data=$.trim(data);
				//alert(data);
				if(data!="sorry")
				  {
					  $('#reportload').empty();
					  $('#reportload').append('<iframe id="reportload_frame" width="100%" height="350px" frameborder="0" style="  margin-left: 15%;"></iframe>');
					  var params ="total_sales_report.php?itemid="+itemid+"&paymenttyp="+paymentyp+"&type="+typeval+"&newsearch=chk&model=pie";
					  $('#reportload_frame').attr("src", params);
					  
					  $('#reportload').append('<iframe id="reportload_frame2" width="100%" height="350px" frameborder="0" style="  margin-left: 15%;"></iframe>');
					  var params = "total_sales_report.php?itemid="+itemid+"&paymenttyp="+paymentyp+"&type="+typeval+"&newsearch=chk&model=horz";
					  $('#reportload_frame2').attr("src", params);
					  
					  
					  $('#reportload').append('<iframe id="reportload_frame3" width="100%" height="350px" frameborder="0" style="  margin-left: 15%;"></iframe>');
					  var params = "total_sales_report.php?itemid="+itemid+"&paymenttyp="+paymentyp+"&type="+typeval+"&newsearch=chk&model=vert";
					  $('#reportload_frame3').attr("src", params);
					  
					  $('#reportload').append('<iframe id="reportload_frame4" width="100%" height="350px" frameborder="0" style="  margin-left: 15%;"></iframe>');
					  var params = "total_sales_report.php?itemid="+itemid+"&paymenttyp="+paymentyp+"&type="+typeval+"&newsearch=chk&model=line";
					  $('#reportload_frame4').attr("src", params);
					  
					 
				
				  }else
				  {
					  $('#reportload').html("<div class='erroranalytics'> No Records found </div>");
				  }
				
			  });
		}else
		{
		$.post("load_analyiticscheck.php", {itemid:itemid,fromdt:tot_from,todt:tot_to,type:'itemwisechk',set:"ok"},
		  function(data)
		  {
				data=$.trim(data);
				//alert(data);
				if(data!="sorry")
				  {
					  $('#reportload').empty();
					  $('#reportload').append('<iframe id="reportload_frame" width="100%" height="350px" frameborder="0" style="  margin-left: 15%;"></iframe>');
					  var params ="total_sales_report.php?itemid="+itemid+"&fromdt="+tot_from+"&todt="+tot_to+"&type="+typeval+"&set=chk&model=pie";
					  $('#reportload_frame').attr("src", params);
					  
					  $('#reportload').append('<iframe id="reportload_frame2" width="100%" height="350px" frameborder="0" style="  margin-left: 15%;"></iframe>');
					  var params = "total_sales_report.php?itemid="+itemid+"&fromdt="+tot_from+"&todt="+tot_to+"&type="+typeval+"&set=chk&model=horz";
					  $('#reportload_frame2').attr("src", params);
					  
					  
					  $('#reportload').append('<iframe id="reportload_frame3" width="100%" height="350px" frameborder="0" style="  margin-left: 15%;"></iframe>');
					  var params = "total_sales_report.php?itemid="+itemid+"&fromdt="+tot_from+"&todt="+tot_to+"&type="+typeval+"&set=chk&model=vert";
					  $('#reportload_frame3').attr("src", params);
					  
					  $('#reportload').append('<iframe id="reportload_frame4" width="100%" height="350px" frameborder="0" style="  margin-left: 15%;"></iframe>');
					  var params = "total_sales_report.php?itemid="+itemid+"&fromdt="+tot_from+"&todt="+tot_to+"&type="+typeval+"&set=chk&model=line";
					  $('#reportload_frame4').attr("src", params);
					  
					 
				
				  }else
				  {
					$('#reportload').html("<div class='erroranalytics'> No Records found </div>");
				  }
				
			  });
		}
		
		});
	/*******************************************items each ends**********************************************/
	
	/*********************************paybydate itemvise starts*******************************************************/
	$('#paybydateitem').change(function () {
		var paymentyp=($('#paybydateitem').val());
		$('#datepickertodtitem').val('');
		$('#datepickerfromitem').val('');
		
		var typeval=$('#typeval').val();
		var itemid=$('#itemlist').val();
		$.post("load_analyiticscheck.php", {itemid:itemid,paymenttyp:paymentyp,type:'itemwisechk',newsearch:"ok"},
		  function(data)
		  {
				data=$.trim(data);
				//alert(data);
				if(data!="sorry")
				  {
					  $('#reportload').empty();
					  $('#reportload').append('<iframe id="reportload_frame" width="100%" height="350px" frameborder="0" style="  margin-left: 15%;"></iframe>');
					  var params ="total_sales_report.php?itemid="+itemid+"&paymenttyp="+paymentyp+"&type="+typeval+"&newsearch=chk&model=pie";
					  $('#reportload_frame').attr("src", params);
					  
					  $('#reportload').append('<iframe id="reportload_frame2" width="100%" height="350px" frameborder="0" style="  margin-left: 15%;"></iframe>');
					  var params = "total_sales_report.php?itemid="+itemid+"&paymenttyp="+paymentyp+"&type="+typeval+"&newsearch=chk&model=horz";
					  $('#reportload_frame2').attr("src", params);
					  
					  
					  $('#reportload').append('<iframe id="reportload_frame3" width="100%" height="350px" frameborder="0" style="  margin-left: 15%;"></iframe>');
					  var params = "total_sales_report.php?itemid="+itemid+"&paymenttyp="+paymentyp+"&type="+typeval+"&newsearch=chk&model=vert";
					  $('#reportload_frame3').attr("src", params);
					  
					   $('#reportload').append('<iframe id="reportload_frame4" width="100%" height="350px" frameborder="0" style="  margin-left: 15%;"></iframe>');
					  var params = "total_sales_report.php?itemid="+itemid+"&paymenttyp="+paymentyp+"&type="+typeval+"&newsearch=chk&model=line";
					  $('#reportload_frame4').attr("src", params);
					  
					 
				
				  }else
				  {
					  $('#reportload').html("<div class='erroranalytics'> No Records found </div>");
				  }
				
			  });
		});
	/*********************************paybydate itemvise starts*******************************************************/
	
	//datepickerfromtot    datepickertodttot paybydatetot
	
	//############################################### Total Item wise starts here############################################################
	
	/*******************************************date picker change item starts**********************************************/
	$('#datepickerfromtot').change(function () {
		var repttype=$('#typeval').val();
		$('#paybydatetot').find('option:first').attr('selected', 'selected');
		var tot_to=$('#datepickertodttot').val();
		var tot_from=$('#datepickerfromtot').val();
		if(tot_to=="")
		{
			tot_to="";
		}
		$.post("load_analyiticscheck.php", {fromdt:tot_from,todt:tot_to,type:'totitemwisechk',set:"ok"},
		  function(data)
		  {
		  		data=$.trim(data);
				
				if(data!="sorry")
				{
					$('#reportload').empty();
					$('#reportload').append('<iframe id="reportload_frame" width="100%" height="500px" frameborder="0" style="  margin-left: 15%;"></iframe>');
					var params = "total_sales_report.php?fromdt="+tot_from+"&todt="+tot_to+"&type="+repttype+"&model=pie&set=ok";
					$('#reportload_frame').attr("src", params);
					
					$('#reportload').append('<iframe id="reportload_frame2" width="100%" height="500px" frameborder="0" style="  margin-left: 15%;"></iframe>');
					var params = "total_sales_report.php?fromdt="+tot_from+"&todt="+tot_to+"&type="+repttype+"&model=horz&set=ok";
					$('#reportload_frame2').attr("src", params);
					
					$('#reportload').append('<iframe id="reportload_frame3" width="100%" height="500px" frameborder="0" style="  margin-left: 15%;"></iframe>');
					var params = "total_sales_report.php?fromdt="+tot_from+"&todt="+tot_to+"&type="+repttype+"&model=vert&set=ok";
					$('#reportload_frame3').attr("src", params);
					
					
				}else
				{
					$('#reportload').html("<div class='erroranalytics'> No Records found </div>");
				}
				
		  		//$('#reportload').html(data);
		  }); 
		
	});
	$('#datepickerfromtot').click(function () {
		$('#ui-datepicker-div').css("display", "block");
	});	
	
	
	
	$('#datepickertodttot').click(function () {
		$('#ui-datepicker-div').css("display", "block");
	});	
	$('#datepickertodttot').change(function () {
		var repttype=$('#typeval').val();
		$('#paybydatetot').find('option:first').attr('selected', 'selected');
		var tot_to=$('#datepickertodttot').val();
		var tot_from=$('#datepickerfromtot').val();
		if(tot_from=="")
		{
			tot_from="";
		}
		$.post("load_analyiticscheck.php", {fromdt:tot_from,todt:tot_to,type:'totitemwisechk',set:"ok"},
		  function(data)
		  {
		  		data=$.trim(data);
				
				if(data!="sorry")
				{
					$('#reportload').empty();
					$('#reportload').append('<iframe id="reportload_frame" width="100%" height="500px" frameborder="0" style="  margin-left: 15%;"></iframe>');
					var params = "total_sales_report.php?fromdt="+tot_from+"&todt="+tot_to+"&type="+repttype+"&model=pie&set=ok";
					$('#reportload_frame').attr("src", params);
					
					$('#reportload').append('<iframe id="reportload_frame2" width="100%" height="500px" frameborder="0" style="  margin-left: 15%;"></iframe>');
					var params = "total_sales_report.php?fromdt="+tot_from+"&todt="+tot_to+"&type="+repttype+"&model=horz&set=ok";
					$('#reportload_frame2').attr("src", params);
					
					$('#reportload').append('<iframe id="reportload_frame3" width="100%" height="500px" frameborder="0" style="  margin-left: 15%;"></iframe>');
					var params = "total_sales_report.php?fromdt="+tot_from+"&todt="+tot_to+"&type="+repttype+"&model=vert&set=ok";
					$('#reportload_frame3').attr("src", params);
					
					
				}else
				{
					$('#reportload').html("<div class='erroranalytics'> No Records found </div>");
				}
				
		  		//$('#reportload').html(data);
		  }); 
		
	});
	/*******************************************date picker change item ends**********************************************/
			
	/*********************************paybydate itemvise starts*******************************************************/
	$('#paybydatetot').change(function () {
		
		var paymentyp=($('#paybydatetot').val());
		var repttype=$('#typeval').val();
		$('#datepickerfromtot').val('');
		$('#datepickertodttot').val('');
		$.post("load_analyiticscheck.php", {paymenttyp:paymentyp,type:'totitemwisechk',newsearch:"ok"},
		  function(data)
		  {
		  		data=$.trim(data);
				
				if(data!="sorry")
				{
					$('#reportload').empty();
					$('#reportload').append('<iframe id="reportload_frame" width="100%" height="500px" frameborder="0" style="  margin-left: 15%;"></iframe>');
					var params = "total_sales_report.php?paymenttyp="+paymentyp+"&type="+repttype+"&model=pie&newsearch=ok";
					$('#reportload_frame').attr("src", params);
					
					$('#reportload').append('<iframe id="reportload_frame2" width="100%" height="500px" frameborder="0" style="  margin-left: 15%;"></iframe>');
					var params = "total_sales_report.php?paymenttyp="+paymentyp+"&type="+repttype+"&model=horz&newsearch=ok";
					$('#reportload_frame2').attr("src", params);
					
					$('#reportload').append('<iframe id="reportload_frame3" width="100%" height="500px" frameborder="0" style="  margin-left: 15%;"></iframe>');
					var params = "total_sales_report.php?paymenttyp="+paymentyp+"&type="+repttype+"&model=vert&newsearch=ok";
					$('#reportload_frame3').attr("src", params);
					
					
				}else
				{
					$('#reportload').html("<div class='erroranalytics'> No Records found </div>");
				}
				
		  		//$('#reportload').html(data);
		  }); 
		});
	/*********************************paybydate itemvise starts*******************************************************/
	
	//datepickerfromcmp datepickertodtcmp paybydatecmp
	//###############################################Compare each starts here############################################################
	
	/*******************************************date picker change item starts**********************************************/
	$('#datepickerfromcmp').change(function () {
		var repttype=$('#typeval').val();
		$('#paybydatecmp').find('option:first').attr('selected', 'selected');
		var tot_to=$('#datepickertodtcmp').val();
		var tot_from=$('#datepickerfromcmp').val();
		if(tot_to=="")
		{
			tot_to="";
		}
		$.post("load_analyiticscheck.php", {fromdt:tot_from,todt:tot_to,type:'totcompare',set:"ok"},
		  function(data)
		  {
		  		data=$.trim(data);
				
				if(data!="sorry")
				{
					$('#reportload').empty();
					$('#reportload').append('<iframe id="reportload_frame" width="100%" height="500px" frameborder="0" style="  margin-left: 15%;"></iframe>');
					var params = "total_sales_report.php?fromdt="+tot_from+"&todt="+tot_to+"&type="+repttype+"&model=pie&set=ok";
					$('#reportload_frame').attr("src", params);
					
					$('#reportload').append('<iframe id="reportload_frame2" width="100%" height="500px" frameborder="0" style="  margin-left: 15%;"></iframe>');
					var params = "total_sales_report.php?fromdt="+tot_from+"&todt="+tot_to+"&type="+repttype+"&model=horz&set=ok";
					$('#reportload_frame2').attr("src", params);
					
					$('#reportload').append('<iframe id="reportload_frame3" width="100%" height="500px" frameborder="0" style="  margin-left: 15%;"></iframe>');
					var params = "total_sales_report.php?fromdt="+tot_from+"&todt="+tot_to+"&type="+repttype+"&model=vert&set=ok";
					$('#reportload_frame3').attr("src", params);
					
					
				}else
				{
					$('#reportload').html("<div class='erroranalytics'> No Records found </div>");
				}
				
		  		//$('#reportload').html(data);
		  }); 
		
	});
	$('#datepickerfromcmp').click(function () {
		$('#ui-datepicker-div').css("display", "block");
	});	
	
	
	
	$('#datepickertodtcmp').click(function () {
		$('#ui-datepicker-div').css("display", "block");
	});	
	$('#datepickertodtcmp').change(function () {
		var repttype=$('#typeval').val();
		$('#paybydatecmp').find('option:first').attr('selected', 'selected');
		var tot_to=$('#datepickertodtcmp').val();
		var tot_from=$('#datepickerfromcmp').val();
		if(tot_from=="")
		{
			tot_from="";
		}
		$.post("load_analyiticscheck.php", {fromdt:tot_from,todt:tot_to,type:'totcompare',set:"ok"},
		  function(data)
		  {
		  		data=$.trim(data);
				
				if(data!="sorry")
				{
					$('#reportload').empty();
					$('#reportload').append('<iframe id="reportload_frame" width="100%" height="500px" frameborder="0" style="  margin-left: 15%;"></iframe>');
					var params = "total_sales_report.php?fromdt="+tot_from+"&todt="+tot_to+"&type="+repttype+"&model=pie&set=ok";
					$('#reportload_frame').attr("src", params);
					
					$('#reportload').append('<iframe id="reportload_frame2" width="100%" height="500px" frameborder="0" style="  margin-left: 15%;"></iframe>');
					var params = "total_sales_report.php?fromdt="+tot_from+"&todt="+tot_to+"&type="+repttype+"&model=horz&set=ok";
					$('#reportload_frame2').attr("src", params);
					
					$('#reportload').append('<iframe id="reportload_frame3" width="100%" height="500px" frameborder="0" style="  margin-left: 15%;"></iframe>');
					var params = "total_sales_report.php?fromdt="+tot_from+"&todt="+tot_to+"&type="+repttype+"&model=vert&set=ok";
					$('#reportload_frame3').attr("src", params);
					
					
				}else
				{
					$('#reportload').html("<div class='erroranalytics'> No Records found </div>");
				}
				
		  		//$('#reportload').html(data);
		  }); 
		
	});
	/*******************************************date picker change item ends**********************************************/
			
	/*********************************paybydate itemvise starts*******************************************************/
	$('#paybydatecmp').change(function () {
		
		var paymentyp=($('#paybydatecmp').val());
		var repttype=$('#typeval').val();
		$('#datepickerfromcmp').val('');
		$('#datepickertodtcmp').val('');
		$.post("load_analyiticscheck.php", {paymenttyp:paymentyp,type:'totcompare',newsearch:"ok"},
		  function(data)
		  {
		  		data=$.trim(data);
				
				if(data!="sorry")
				{
					$('#reportload').empty();
					$('#reportload').append('<iframe id="reportload_frame" width="100%" height="500px" frameborder="0" style="  margin-left: 15%;"></iframe>');
					var params = "total_sales_report.php?paymenttyp="+paymentyp+"&type="+repttype+"&model=pie&newsearch=ok";
					$('#reportload_frame').attr("src", params);
					
					$('#reportload').append('<iframe id="reportload_frame2" width="100%" height="500px" frameborder="0" style="  margin-left: 15%;"></iframe>');
					var params = "total_sales_report.php?paymenttyp="+paymentyp+"&type="+repttype+"&model=horz&newsearch=ok";
					$('#reportload_frame2').attr("src", params);
					
					$('#reportload').append('<iframe id="reportload_frame3" width="100%" height="500px" frameborder="0" style="  margin-left: 15%;"></iframe>');
					var params = "total_sales_report.php?paymenttyp="+paymentyp+"&type="+repttype+"&model=vert&newsearch=ok";
					$('#reportload_frame3').attr("src", params);
					
					
				}else
				{
					$('#reportload').html("<div class='erroranalytics'> No Records found </div>");
				}
				
		  		//$('#reportload').html(data);
		  }); 
		});
	/*********************************paybydate itemvise starts*******************************************************/
	
	
	
	//###############################################Staff starts here############################################################
	// datepickerfromstf datepickertodtstf
	/*******************************************date picker change item starts**********************************************/
	$('#datepickerfromstf').change(function () {
		
		$('#ui-datepicker-div').css("display", "none");
		var repttype=$('#typeval').val();
		$('#paybydatestf').find('option:first').attr('selected', 'selected');
		var todt=$('#datepickertodtstf').val();
		var fromdt=$('#datepickerfromstf').val();
		if(todt=="")
		{
			todt="";
		}
		var modetype=$('#modetype').val();
		var staffval=$('.stewardtprpt').val()
		
		var paymentyp=($('#paybydatestf').val());
		var staffval=$('.stewardtprpt').val();
		
		if(staffval=="")
		{staffval="";}
		if(paymentyp=="" || paymentyp=="null")
		{//alert(fromdt);
			$.post("load_analyiticscheck.php", {modetype:modetype,staffval:staffval,fromdt:fromdt,todt:todt,type:'checkstaffwise',set:"chk"},
			  function(data)
			  {//alert("g");
					data=$.trim(data);
					//alert(data)
					//$('.sitemap_cc').html(data);
					if(data!="sorry")
					{
						$('#reportload').empty();
						$('#reportload').append('<iframe id="reportload_frame" width="100%" height="500px" frameborder="0" style="  margin-left: 15%;"></iframe>');
						var params = "total_sales_report.php?modetype="+modetype+"&staffval="+staffval+"&fromdt="+fromdt+"&todt="+todt+"&type=staffwise&model=pie&set=ok";
						$('#reportload_frame').attr("src", params);
						
						$('#reportload').append('<iframe id="reportload_frame2" width="100%" height="500px" frameborder="0" style="  margin-left: 15%;"></iframe>');
						var params = "total_sales_report.php?modetype="+modetype+"&staffval="+staffval+"&fromdt="+fromdt+"&todt="+todt+"&type=staffwise&model=horz&set=ok";
						$('#reportload_frame2').attr("src", params);
						
						$('#reportload').append('<iframe id="reportload_frame3" width="100%" height="500px" frameborder="0" style="  margin-left: 15%;"></iframe>');
						var params = "total_sales_report.php?modetype="+modetype+"&staffval="+staffval+"&fromdt="+fromdt+"&todt="+todt+"&type=staffwise&model=vert&set=ok";
						$('#reportload_frame3').attr("src", params);
						
						
					}else
					{
						$('#reportload').html("<div class='erroranalytics'> No Records found </div>");
					}
					
				
			  });
		}else
		{
			$.post("load_analyiticscheck.php", {modetype:modetype,staffval:staffval,paymenttyp:paymentyp,type:'checkstaffwise',newsearch:"ok"},
			  function(data)
			  {
					data=$.trim(data);
					
					//$('.sitemap_cc').html(data);
					
					if(data!="sorry")
					{
						$('#reportload').empty();
						$('#reportload').append('<iframe id="reportload_frame" width="100%" height="500px" frameborder="0" style="  margin-left: 15%;"></iframe>');
						var params = "total_sales_report.php?modetype="+modetype+"&staffval="+staffval+"&paymenttyp="+paymentyp+"&type=staffwise&model=pie&newsearch=ok";
						$('#reportload_frame').attr("src", params);
						
						$('#reportload').append('<iframe id="reportload_frame2" width="100%" height="500px" frameborder="0" style="  margin-left: 15%;"></iframe>');
						var params = "total_sales_report.php?modetype="+modetype+"&staffval="+staffval+"&paymenttyp="+paymentyp+"&type=staffwise&model=horz&newsearch=ok";
						$('#reportload_frame2').attr("src", params);
						
						$('#reportload').append('<iframe id="reportload_frame3" width="100%" height="500px" frameborder="0" style="  margin-left: 15%;"></iframe>');
						var params = "total_sales_report.php?modetype="+modetype+"&staffval="+staffval+"&paymenttyp="+paymentyp+"&type=staffwise&model=vert&newsearch=ok";
						$('#reportload_frame3').attr("src", params);
						
						
					}else
					{
						$('#reportload').html("<div class='erroranalytics'> No Records found </div>");
					}
					
				
			  });
		}
		
	});
	
	$('#datepickertodtstf').change(function () {
		$('#ui-datepicker-div').css("display", "none");
		var repttype=$('#typeval').val();
		$('#paybydatestf').find('option:first').attr('selected', 'selected');
		var todt=$('#datepickertodtstf').val();
		var fromdt=$('#datepickerfromstf').val();
		if(fromdt=="")
		{
			fromdt="";
		}
		var modetype=$('#modetype').val();
		var staffval=$('.stewardtprpt').val();
		var paymentyp=($('#paybydatestf').val());
		var staffval=$('.stewardtprpt').val();
		
		if(staffval=="")
		{staffval="";}
		if(paymentyp=="" || paymentyp=="null")
		{
			$.post("load_analyiticscheck.php", {modetype:modetype,staffval:staffval,fromdt:fromdt,todt:todt,type:'checkstaffwise',set:"chk"},
			  function(data)
			  {
					data=$.trim(data);
					//alert(data)
					//$('.sitemap_cc').html(data);
					if(data!="sorry")
					{
						$('#reportload').empty();
						$('#reportload').append('<iframe id="reportload_frame" width="100%" height="500px" frameborder="0" style="  margin-left: 15%;"></iframe>');
						var params = "total_sales_report.php?modetype="+modetype+"&staffval="+staffval+"&fromdt="+fromdt+"&todt="+todt+"&type=staffwise&model=pie&set=ok";
						$('#reportload_frame').attr("src", params);
						
						$('#reportload').append('<iframe id="reportload_frame2" width="100%" height="500px" frameborder="0" style="  margin-left: 15%;"></iframe>');
						var params = "total_sales_report.php?modetype="+modetype+"&staffval="+staffval+"&fromdt="+fromdt+"&todt="+todt+"&type=staffwise&model=horz&set=ok";
						$('#reportload_frame2').attr("src", params);
						
						$('#reportload').append('<iframe id="reportload_frame3" width="100%" height="500px" frameborder="0" style="  margin-left: 15%;"></iframe>');
						var params = "total_sales_report.php?modetype="+modetype+"&staffval="+staffval+"&fromdt="+fromdt+"&todt="+todt+"&type=staffwise&model=vert&set=ok";
						$('#reportload_frame3').attr("src", params);
						
						
					}else
					{
						$('#reportload').html("<div class='erroranalytics'> No Records found </div>");
					}
					
				
			  });
		}else
		{
			$.post("load_analyiticscheck.php", {modetype:modetype,staffval:staffval,paymenttyp:paymentyp,type:'checkstaffwise',newsearch:"ok"},
			  function(data)
			  {
					data=$.trim(data);
					
					//$('.sitemap_cc').html(data);
					//alert(data)
					if(data!="sorry")
					{
						$('#reportload').empty();
						$('#reportload').append('<iframe id="reportload_frame" width="100%" height="500px" frameborder="0" style="  margin-left: 15%;"></iframe>');
						var params = "total_sales_report.php?modetype="+modetype+"&staffval="+staffval+"&paymenttyp="+paymentyp+"&type=staffwise&model=pie&newsearch=ok";
						$('#reportload_frame').attr("src", params);
						
						$('#reportload').append('<iframe id="reportload_frame2" width="100%" height="500px" frameborder="0" style="  margin-left: 15%;"></iframe>');
						var params = "total_sales_report.php?modetype="+modetype+"&staffval="+staffval+"&paymenttyp="+paymentyp+"&type=staffwise&model=horz&newsearch=ok";
						$('#reportload_frame2').attr("src", params);
						
						$('#reportload').append('<iframe id="reportload_frame3" width="100%" height="500px" frameborder="0" style="  margin-left: 15%;"></iframe>');
						var params = "total_sales_report.php?modetype="+modetype+"&staffval="+staffval+"&paymenttyp="+paymentyp+"&type=staffwise&model=vert&newsearch=ok";
						$('#reportload_frame3').attr("src", params);
						
						
					}else
					{
						$('#reportload').html("<div class='erroranalytics'> No Records found </div>");
					}
					
				
			  });
		}
		
	});
	/*******************************************date picker change item ends**********************************************/
	/*********************************mode itemvise starts*******************************************************/
	$('#modetype').change(function () {
		$('.stewardtprpt').find('option:first').attr('selected', 'selected');
		var repttype=$('#typeval').val();
		var modetype=$('#modetype').val();
		var fromdt=$('#datepickerfromstf').val();
		var todt=$('#datepickertodtstf').val();
		var paymentyp=($('#paybydatestf').val());
		var staffval=$('.stewardtprpt').val();
		
		if(staffval=="")
		{staffval="";}
		if(paymentyp=="" || paymentyp=="null")
		{
			$.post("load_analyiticscheck.php", {modetype:modetype,staffval:staffval,fromdt:fromdt,todt:todt,type:'checkstaffwise',set:"chk"},
			  function(data)
			  {
					data=$.trim(data);
					//alert(data)
					//$('.sitemap_cc').html(data);
					if(data!="sorry")
					{
						$('#reportload').empty();
						$('#reportload').append('<iframe id="reportload_frame" width="100%" height="500px" frameborder="0" style="  margin-left: 15%;"></iframe>');
						var params = "total_sales_report.php?modetype="+modetype+"&staffval="+staffval+"&fromdt="+fromdt+"&todt="+todt+"&type=staffwise&model=pie&set=ok";
						$('#reportload_frame').attr("src", params);
						
						$('#reportload').append('<iframe id="reportload_frame2" width="100%" height="500px" frameborder="0" style="  margin-left: 15%;"></iframe>');
						var params = "total_sales_report.php?modetype="+modetype+"&staffval="+staffval+"&fromdt="+fromdt+"&todt="+todt+"&type=staffwise&model=horz&set=ok";
						$('#reportload_frame2').attr("src", params);
						
						$('#reportload').append('<iframe id="reportload_frame3" width="100%" height="500px" frameborder="0" style="  margin-left: 15%;"></iframe>');
						var params = "total_sales_report.php?modetype="+modetype+"&staffval="+staffval+"&fromdt="+fromdt+"&todt="+todt+"&type=staffwise&model=vert&set=ok";
						$('#reportload_frame3').attr("src", params);
						
						
					}else
					{
						$('#reportload').html("<div class='erroranalytics'> No Records found </div>");
					}
					
				
			  });
		}else
		{
			$.post("load_analyiticscheck.php", {modetype:modetype,staffval:staffval,paymenttyp:paymentyp,type:'checkstaffwise',newsearch:"ok"},
			  function(data)
			  {
					data=$.trim(data);
					
					//$('.sitemap_cc').html(data);
					//alert(data)
					if(data!="sorry")
					{
						$('#reportload').empty();
						$('#reportload').append('<iframe id="reportload_frame" width="100%" height="500px" frameborder="0" style="  margin-left: 15%;"></iframe>');
						var params = "total_sales_report.php?modetype="+modetype+"&staffval="+staffval+"&paymenttyp="+paymentyp+"&type=staffwise&model=pie&newsearch=ok";
						$('#reportload_frame').attr("src", params);
						
						$('#reportload').append('<iframe id="reportload_frame2" width="100%" height="500px" frameborder="0" style="  margin-left: 15%;"></iframe>');
						var params = "total_sales_report.php?modetype="+modetype+"&staffval="+staffval+"&paymenttyp="+paymentyp+"&type=staffwise&model=horz&newsearch=ok";
						$('#reportload_frame2').attr("src", params);
						
						$('#reportload').append('<iframe id="reportload_frame3" width="100%" height="500px" frameborder="0" style="  margin-left: 15%;"></iframe>');
						var params = "total_sales_report.php?modetype="+modetype+"&staffval="+staffval+"&paymenttyp="+paymentyp+"&type=staffwise&model=vert&newsearch=ok";
						$('#reportload_frame3').attr("src", params);
						
						
					}else
					{
						$('#reportload').html("<div class='erroranalytics'> No Records found </div>");
					}
					
				
			  });
		}
		});
	/*********************************mode itemvise ends*******************************************************/
	/*********************************staff itemvise starts*******************************************************/
	$('.stewardtprpt').change(function () {
		var repttype=$('#typeval').val();
		var modetype=$('#modetype').val();
		var staffval=$('.stewardtprpt').val()
		var fromdt=$('#datepickerfromstf').val();
		var todt=$('#datepickertodtstf').val();
		var paymentyp=($('#paybydatestf').val());
		
		if(paymentyp=="" || paymentyp=="null")
		{
			$.post("load_analyiticscheck.php", {modetype:modetype,staffval:staffval,fromdt:fromdt,todt:todt,type:'checkstaffwise',set:"chk"},
			  function(data)
			  {
					data=$.trim(data);
					//alert(data)
					//$('.sitemap_cc').html(data);
					if(data!="sorry")
					{
						$('#reportload').empty();
						$('#reportload').append('<iframe id="reportload_frame" width="100%" height="500px" frameborder="0" style="  margin-left: 15%;"></iframe>');
						var params = "total_sales_report.php?modetype="+modetype+"&staffval="+staffval+"&fromdt="+fromdt+"&todt="+todt+"&type="+repttype+"&model=pie&set=ok";
						$('#reportload_frame').attr("src", params);
						
						$('#reportload').append('<iframe id="reportload_frame2" width="100%" height="500px" frameborder="0" style="  margin-left: 15%;"></iframe>');
						var params = "total_sales_report.php?modetype="+modetype+"&staffval="+staffval+"&fromdt="+fromdt+"&todt="+todt+"&type="+repttype+"&model=horz&set=ok";
						$('#reportload_frame2').attr("src", params);
						
						$('#reportload').append('<iframe id="reportload_frame3" width="100%" height="500px" frameborder="0" style="  margin-left: 15%;"></iframe>');
						var params = "total_sales_report.php?modetype="+modetype+"&staffval="+staffval+"&fromdt="+fromdt+"&todt="+todt+"&type="+repttype+"&model=vert&set=ok";
						$('#reportload_frame3').attr("src", params);
						
						
					}else
					{
						$('#reportload').html("<div class='erroranalytics'> No Records found </div>");
					}
					
				
			  });
		}else
		{
			$.post("load_analyiticscheck.php", {modetype:modetype,staffval:staffval,paymenttyp:paymentyp,type:'checkstaffwise',newsearch:"ok"},
			  function(data)
			  {
					data=$.trim(data);
					//alert(data)
					//$('.sitemap_cc').html(data);
					
					if(data!="sorry")
					{
						$('#reportload').empty();
						$('#reportload').append('<iframe id="reportload_frame" width="100%" height="500px" frameborder="0" style="  margin-left: 15%;"></iframe>');
						var params = "total_sales_report.php?modetype="+modetype+"&staffval="+staffval+"&paymenttyp="+paymentyp+"&type="+repttype+"&model=pie&newsearch=ok";
						$('#reportload_frame').attr("src", params);
						
						$('#reportload').append('<iframe id="reportload_frame2" width="100%" height="500px" frameborder="0" style="  margin-left: 15%;"></iframe>');
						var params = "total_sales_report.php?modetype="+modetype+"&staffval="+staffval+"&paymenttyp="+paymentyp+"&type="+repttype+"&model=horz&newsearch=ok";
						$('#reportload_frame2').attr("src", params);
						
						$('#reportload').append('<iframe id="reportload_frame3" width="100%" height="500px" frameborder="0" style="  margin-left: 15%;"></iframe>');
						var params = "total_sales_report.php?modetype="+modetype+"&staffval="+staffval+"&paymenttyp="+paymentyp+"&type="+repttype+"&model=vert&newsearch=ok";
						$('#reportload_frame3').attr("src", params);
						
						
					}else
					{
						$('#reportload').html("<div class='erroranalytics'> No Records found </div>");
					}
					
				
			  });
		}
		});
	/*********************************paybydate itemvise starts*******************************************************/
	/*********************************paybydate all starts*******************************************************/
	$('#paybydatestf').change(function () {
		//alert($(this).val());
		var paymentyp=($('#paybydatecmp').val());
		var repttype=$('#typeval').val();
		$('#datepickerfromstf').val('');
		$('#datepickertodtstf').val('');
		
		var modetype=$('#modetype').val();
		var staffval=$('.stewardtprpt').val()
		var fromdt=$('#datepickerfromstf').val();
		var todt=$('#datepickertodtstf').val();
		var paymentyp=($('#paybydatestf').val());
		
		if(paymentyp=="" || paymentyp=="null")
		{
			$.post("load_analyiticscheck.php", {modetype:modetype,staffval:staffval,fromdt:fromdt,todt:todt,type:'checkstaffwise',set:"chk"},
			  function(data)
			  {
					data=$.trim(data);
					
					//alert(data);
					//$('.sitemap_cc').html(data);
					if(data!="sorry")
					{
						$('#reportload').empty();
						$('#reportload').append('<iframe id="reportload_frame" width="100%" height="500px" frameborder="0" style="  margin-left: 15%;"></iframe>');
						var params = "total_sales_report.php?modetype="+modetype+"&staffval="+staffval+"&fromdt="+fromdt+"&todt="+todt+"&type="+repttype+"&model=pie&set=ok";
						$('#reportload_frame').attr("src", params);
						
						$('#reportload').append('<iframe id="reportload_frame2" width="100%" height="500px" frameborder="0" style="  margin-left: 15%;"></iframe>');
						var params = "total_sales_report.php?modetype="+modetype+"&staffval="+staffval+"&fromdt="+fromdt+"&todt="+todt+"&type="+repttype+"&model=pie&set=ok";
						$('#reportload_frame2').attr("src", params);
						
						$('#reportload').append('<iframe id="reportload_frame3" width="100%" height="500px" frameborder="0" style="  margin-left: 15%;"></iframe>');
						var params = "total_sales_report.php?modetype="+modetype+"&staffval="+staffval+"&fromdt="+fromdt+"&todt="+todt+"&type="+repttype+"&model=pie&set=ok";
						$('#reportload_frame3').attr("src", params);
						
						
					}else
					{
						$('#reportload').html("<div class='erroranalytics'> No Records found </div>");
					}
					
				
			  });
		}else
		{
			$.post("load_analyiticscheck.php", {modetype:modetype,staffval:staffval,paymenttyp:paymentyp,type:'checkstaffwise',newsearch:"ok"},
			  function(data)
			  {
					data=$.trim(data);
					//alert(data)
					//$('.sitemap_cc').html(data);
					
					if(data!="sorry")
					{
						$('#reportload').empty();
						$('#reportload').append('<iframe id="reportload_frame" width="100%" height="500px" frameborder="0" style="  margin-left: 15%;"></iframe>');
						var params = "total_sales_report.php?modetype="+modetype+"&staffval="+staffval+"&paymenttyp="+paymentyp+"&type="+repttype+"&model=pie&newsearch=ok";
						$('#reportload_frame').attr("src", params);
						
						$('#reportload').append('<iframe id="reportload_frame2" width="100%" height="500px" frameborder="0" style="  margin-left: 15%;"></iframe>');
						var params = "total_sales_report.php?modetype="+modetype+"&staffval="+staffval+"&paymenttyp="+paymentyp+"&type="+repttype+"&model=horz&newsearch=ok";
						$('#reportload_frame2').attr("src", params);
						
						$('#reportload').append('<iframe id="reportload_frame3" width="100%" height="500px" frameborder="0" style="  margin-left: 15%;"></iframe>');
						var params = "total_sales_report.php?modetype="+modetype+"&staffval="+staffval+"&paymenttyp="+paymentyp+"&type="+repttype+"&model=vert&newsearch=ok";
						$('#reportload_frame3').attr("src", params);
						
						
					}else
					{
						$('#reportload').html("<div class='erroranalytics'> No Records found </div>");
					}
					
				
			  });
		}
		});
	/*********************************paybydate itemvise starts*******************************************************/
	
	

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
 
						
 <div  class="sitemap_cc">Analytics Report-Dine In</div>
 <div id="container">   
<div class="col-md-12 main_contant_container nopaddding">
    <div class="col-lg-12 col-md-12 report_main_cc" style="padding-top:10px; background-color:rgb(208, 208, 208);">
        <div class="col-lg-12 col-md-12 nopadding" style="background-color:#FCFCFC;  margin-bottom: 10px; ">
            <div class="header_main_container">
                <div class="col-lg-12 col-md-12 nopadding">
                    <!-- condition starts -->                         
                    <div class="col-lg-12 col-md-12 nopadding top_main_cc">
                        <div class="col-lg-2 col-md-2 no-padding filter_txt_cc"><div class="filter_heading filter_head_1">Select</div></div>
                        <div class="search_name_box_main report_check_box_cc" style="margin-top: 4px;">
                            <!-- type starts -->
                            <div class="search_name_box_main" style="width: 24%;">
                                <div class="text-selection_name">Type</div>
                                   <div class="input-group" style="width: 84%;">
                                         <select  class="form-control add_new_dropdown_report" onChange="reportcreate(this.value)" name="typeval" id="typeval">
                                              <option value="">Type of report</option>
                                                  <option value="tot_sales">Total sales</option>
                                                  <option value="totitems">Total items</option>
                                                  <option value="itemeach">Each Item</option>
                                                   <option value="compare">Take Away vs Dine In</option>
                                                   <option value="staffwise">Staff Wise</option>
                                                 
                                            </select> 
                                            <!-- <option value="steward">Steward</option>
                                                    <option value="order">Item Ordered</option>
                                                    <option value="type_order">Type of order</option>-->   
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
                                 
                                 <div class="search_name_box_main">
                                  <div class="text-selection_name">By Date</div>
                                    <div class="input-group">
                                  <select class="form-control add_new_dropdown_report" name="paybydate" id="paybydate" >
                                      <option value="null" default>--Select--</option>
                                      <option value="Today" >Today</option>
                                      <option value="Yesterday">Yesterday</option>
                                      <option value="Last5days">Last 5 days</option>
                                      <option value="Last10days">Last 10 days</option>
                                      <option value="Last15days">Last 15 days</option>
                                      <option value="Last20days">Last 20 days</option>
                                      <option value="Last25days">Last 25 days</option>
                                      <option value="Last30days">Last 30 days</option>
                                      <option value="Last1month">Last month</option>
                                      <option value="Last3months">Last 3 months</option>
                                      <option value="Last6months">Last 6 months</option>
                                      <option value="Last1year">Last year</option>
                                      </select>
                                  </div>
                              </div>
                            </div>
                            <!-- date ends -->  
                            
                            <!-- total items starts -->                     
                            <div id="totalitemvise" style="display:none" >
                                 
                                 
                                 <div class="search_name_box_main"> 
                                    <div class="text-selection_name">From:</div>
                                     <div class="input-group">
                                         <input type="text" class="form-control" id="datepickerfromtot" >     
                                    </div>
                                 </div>
                                 
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">To  :</div> 
                                     <div class="input-group"> 
                                         <input type="text" class="form-control" id="datepickertodttot" >        
                                    </div>
                                 </div>
                                 <div class="search_name_box_main">
                                  <div class="text-selection_name">By Date</div>
                                    <div class="input-group">
                                  <select class="form-control add_new_dropdown_report" name="paybydatetot" id="paybydatetot" >
                                      <option value="null" default>--Select--</option>
                                      <option value="Today" >Today</option>
                                      <option value="Yesterday">Yesterday</option>
                                      <option value="Last5days">Last 5 days</option>
                                      <option value="Last10days">Last 10 days</option>
                                      <option value="Last15days">Last 15 days</option>
                                      <option value="Last20days">Last 20 days</option>
                                      <option value="Last25days">Last 25 days</option>
                                      <option value="Last30days">Last 30 days</option>
                                      <option value="Last1month">Last month</option>
                                      <option value="Last3months">Last 3 months</option>
                                      <option value="Last6months">Last 6 months</option>
                                      <option value="Last1year">Last year</option>
                                      </select>
                                  </div>
                              </div>
                                 
                                 
                            </div>
                            <!-- total items ends --> 
                            
                            <!-- each items starts -->                     
                            <div id="eachitemvise" style="display:none" >
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">Item:</div>
                                     <div class="input-group">
                                         <select  class="form-control add_new_dropdown_report" name="itemlist" id="itemlist">
                                              <option value="">---Items---</option>
                                                  <?php  
											  //`tbl_floormaster`(`fr_floorid`, `fr_branchid`, `fr_floorname`, `fr_status`, `fr_servicetax`, `fr_vat`, `fr_servicecharge`)
											  $sql_login  =  $database->mysqlQuery("select * from tbl_menumaster "); 
													$num_login   = $database->mysqlNumRows($sql_login);
													if($num_login){
														while($result_login  = $database->mysqlFetchArray($sql_login)) 
														  { ?>
                                                  <option value="<?=$result_login['mr_menuid']?>"><?=$result_login['mr_menuname']?></option>
                                                  <?php }} ?>
                                            </select>   
                                    </div>
                                 </div>
                                 
                                 <div class="search_name_box_main"> 
                                    <div class="text-selection_name">From:</div>
                                     <div class="input-group">
                                         <input type="text" class="form-control" id="datepickerfromitem" >     
                                    </div>
                                 </div>
                                 
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">To  :</div> 
                                     <div class="input-group">
                                         <input type="text" class="form-control" id="datepickertodtitem" >            
                                    </div>
                                 </div>
                                 <div class="search_name_box_main">
                                  <div class="text-selection_name">By Date</div>
                                    <div class="input-group">
                                  <select class="form-control add_new_dropdown_report" name="paybydateitem" id="paybydateitem" >
                                      <option value="null" default>--Select--</option>
                                      <option value="Today" >Today</option>
                                      <option value="Yesterday">Yesterday</option>
                                      <option value="Last5days">Last 5 days</option>
                                      <option value="Last10days">Last 10 days</option>
                                      <option value="Last15days">Last 15 days</option>
                                      <option value="Last20days">Last 20 days</option>
                                      <option value="Last25days">Last 25 days</option>
                                      <option value="Last30days">Last 30 days</option>
                                      <option value="Last1month">Last month</option>
                                      <option value="Last3months">Last 3 months</option>
                                      <option value="Last6months">Last 6 months</option>
                                      <option value="Last1year">Last year</option>
                                      </select>
                                  </div>
                              </div>
                                 
                                 
                            </div>
                            <!-- each items ends -->  
                            
                            <!-- comparing starts -->                     
                            <div id="compareeach" style="display:none" >
                                 
                                 
                                 <div class="search_name_box_main"> 
                                    <div class="text-selection_name">From:</div>
                                     <div class="input-group">
                                         <input type="text" class="form-control" id="datepickerfromcmp" >     
                                    </div>
                                 </div>
                                 
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">To  :</div> 
                                     <div class="input-group"> 
                                         <input type="text" class="form-control" id="datepickertodtcmp" >        
                                    </div>
                                 </div>
                                 <div class="search_name_box_main">
                                  <div class="text-selection_name">By Date</div>
                                    <div class="input-group">
                                  <select class="form-control add_new_dropdown_report" name="paybydatecmp" id="paybydatecmp" >
                                      <option value="null" default>--Select--</option>
                                      <option value="Today" >Today</option>
                                      <option value="Yesterday">Yesterday</option>
                                      <option value="Last5days">Last 5 days</option>
                                      <option value="Last10days">Last 10 days</option>
                                      <option value="Last15days">Last 15 days</option>
                                      <option value="Last20days">Last 20 days</option>
                                      <option value="Last25days">Last 25 days</option>
                                      <option value="Last30days">Last 30 days</option>
                                      <option value="Last1month">Last month</option>
                                      <option value="Last3months">Last 3 months</option>
                                      <option value="Last6months">Last 6 months</option>
                                      <option value="Last1year">Last year</option>
                                      </select>
                                  </div>
                              </div>
                                 
                                 
                            </div>
                            <!-- comparing ends -->
                            
                            
                              <!-- Staff starts -->                     
                            <div id="staffwise" style="display:none" >
                            	<div class="search_name_box_main" style="width:12%"> 
                                    <div class="text-selection_name">Mode:</div>
                                     <div class="input-group">
                                          <select  class="form-control add_new_dropdown_report" name="modetype" id="modetype" onChange="typechnagesel(this.value)">
                                              <option value="">--Mode--</option>
											  <option  value="dinein">Dine In</option>
											  <option  value="take">Take Away</option>
				
                                            </select>     
                                    </div>
                                 </div>
                                 
                                  <div class="search_name_box_main" style="width:13%;display:none" id="dineinstaff" >
                                    <div class="text-selection_name">Person:</div>
                                     <div class="input-group">
                                         <select  class="form-control add_new_dropdown_report stewardtprpt" name="stewardtprpt">
                                              <option value="">--Person--</option>
					 <?php
					 $sql_ds_nos="select * from tbl_staffmaster as sa LEFT JOIN  tbl_designationmaster as dg ON sa.ser_designation=dg.dr_designationid where  sa.ser_designation IN (".$_SESSION['desgn_takordr'].") ";
                   //$sql_ds_nos="select * from tbl_staffmaster where ser_designation='".$_SESSION['desgn_steward']."' ";
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
                                 
                                  <div class="search_name_box_main" style="width:13%;display:none" id="takeawaystaff">
                                    <div class="text-selection_name">Person:</div>
                                     <div class="input-group">
                                         <select  class="form-control add_new_dropdown_report stewardtprpt" name="stewardtprpt" >
                                              <option value="">--Person--</option>
					 <?php
					 $sql_ds_nos="select * from tbl_staffmaster as sa LEFT JOIN  tbl_designationmaster as dg ON sa.ser_designation=dg.dr_designationid where  sa.ser_designation='".$_SESSION['desgn_deliveryboy']."'";
                   //$sql_ds_nos="select * from tbl_staffmaster where ser_designation='".$_SESSION['desgn_steward']."' ";
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
                                 
                                <!-- <div class="search_name_box_main otherstaf" style="width:13%; display:none"> 
                                    <div class="text-selection_name">Report:</div>
                                     <div class="input-group">
                                          <select  class="form-control add_new_dropdown_report" name="stewardtp" id="stewardtp">
                                              <option value="">--Report--</option>
											  <option  value="dinein">Amount</option>
											  <option  value="take">Numbers</option>
				
                                            </select>     
                                    </div>
                                 </div>-->
                                 
                                 
                                 <div class="search_name_box_main otherstaf" style="width:12%; display:none"> 
                                    <div class="text-selection_name">From:</div>
                                     <div class="input-group" style="width:71%">
                                         <input type="text" class="form-control" id="datepickerfromstf" style="width:104%">     
                                    </div>
                                 </div>
                                 
                                 <div class="search_name_box_main otherstaf" style="width:12%; display:none">
                                    <div class="text-selection_name">To  :</div> 
                                     <div class="input-group" style="width:71%"> 
                                         <input type="text" class="form-control" id="datepickertodtstf" style="width:104%">        
                                    </div>
                                 </div>
                                 <div class="search_name_box_main otherstaf" style=" display:none">
                                  <div class="text-selection_name">By Date</div>
                                    <div class="input-group">
                                  <select class="form-control add_new_dropdown_report" name="paybydatestf" id="paybydatestf" >
                                      <option value="null" default>--Select--</option>
                                      <option value="Today" >Today</option>
                                      <option value="Yesterday">Yesterday</option>
                                      <option value="Last5days">Last 5 days</option>
                                      <option value="Last10days">Last 10 days</option>
                                      <option value="Last15days">Last 15 days</option>
                                      <option value="Last20days">Last 20 days</option>
                                      <option value="Last25days">Last 25 days</option>
                                      <option value="Last30days">Last 30 days</option>
                                      <option value="Last1month">Last month</option>
                                      <option value="Last3months">Last 3 months</option>
                                      <option value="Last6months">Last 6 months</option>
                                      <option value="Last1year">Last year</option>
                                      </select>
                                  </div>
                              </div>
                                 
                                 
                            </div>
                            <!-- comparing ends -->
                            
                            
                            
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
					 $sql_ds_nos="select * from tbl_staffmaster as sa LEFT JOIN  tbl_designationmaster as dg ON sa.ser_designation=dg.dr_designationid where  sa.ser_designation IN (".$_SESSION['desgn_takordr'].") ";
                   //$sql_ds_nos="select * from tbl_staffmaster where ser_designation='".$_SESSION['desgn_steward']."' ";
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
                            
                            
                             <!-- type of Order starts -->                     
                            <div id="typooforder" style="display:none" >
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">Type:</div>
                                     <div class="input-group">
                                         <select  class="form-control add_new_dropdown_report" name="stewardtp" id="stewardtp">
                                              <option value="">Type Of Order</option>
											  <option  value="dinein">Dine In</option>
											  <option  value="take">Take Away</option>
				
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
                                
            <div class="col-lg-12 col-md-12 user_detail_min_hieght" style="background-color:#FCFCFC;  border: 1px solid #BDBDBD;  " id="reportload">
            <iframe id="reportload_frame" width="100%" height="500px" frameborder="0" style="  margin-left: 15%;"></iframe>
                                <!--  report content-->
            </div>
            <!--<div class="col-lg-12 col-md-12 nopadding top_main_cc">
                <form name="submitall" id="submitall"  method="post" action="<?php $_SERVER['PHP_SELF']?>"> 
                    <input type="hidden" name="hidfr" id="hidfr" />
                    <input type="hidden" name="hidto" id="hidto" /> 
                    <input type="hidden" name="hidval" id="hidval" />
                    <input type="hidden" name="hidpaytyp" id="hidpaytyp" />
                    <input type="hidden" name="hidfloor" id="hidfloor" />
                     <input type="hidden" name="hidstw" id="hidstw" />
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
		$('#eachitemvise').css("display", "none");
		$('#totalitemvise').css("display", "none");
		$('#compareeach').css("display", "none");
		$('#staffwise').css("display", "none");
		$.post("load_analyiticscheck.php", {type:'tot_sales_an'},
		  function(data)
		  {
		  		data=$.trim(data);
				if(data!="sorry")
				{
					$('#reportload').empty();
					$('#reportload').append('<iframe id="reportload_frame" width="100%" height="350px" frameborder="0" style="  margin-left: 15%;"></iframe>');
					var params = "total_sales_report.php?type="+repttype+"&model=pie";
					$('#reportload_frame').attr("src", params);
					
					$('#reportload').append('<iframe id="reportload_frame2" width="100%" height="350px" frameborder="0" style="  margin-left: 15%;"></iframe>');
					var params = "total_sales_report.php?type="+repttype+"&model=horz";
					$('#reportload_frame2').attr("src", params);
					
					$('#reportload').append('<iframe id="reportload_frame3" width="100%" height="350px" frameborder="0" style="  margin-left: 15%;"></iframe>');
					var params = "total_sales_report.php?type="+repttype+"&model=vert";
					$('#reportload_frame3').attr("src", params);
					
					$('#reportload').append('<iframe id="reportload_frame4" width="100%" height="350px" frameborder="0" style="  margin-left: 15%;"></iframe>');
					var params = "total_sales_report.php?type="+repttype+"&model=line";
					$('#reportload_frame4').attr("src", params);
					
					
				}else
				{
					$('#reportload').html("<div class='erroranalytics'> No Records found </div>");
				}
				
		  		//$('#reportload').html(data);
		  }); 
	} 
	else if(repttype=="totitems")
	{
		$('#paybydatetot').find('option:first').attr('selected', 'selected');
		$('#datepickerfromtot').val("");
		$('#datepickertodttot').val("");
		$('#eachitemvise').css("display", "none");
		$('#totalsalesdiv').css("display", "none");
		$('#totalorderdiv').css("display", "none");
		$('#itemselectdiv').css("display", "none");
		$('#reportload').html("");
		$('#totalitemvise').css("display", "block");
		$('#eachitemvise').css("display", "none");
		$('#compareeach').css("display", "none");
		$('#staffwise').css("display", "none");
		
		var tot_to=$('#datepickertodttot').val();
		var tot_from=$('#datepickerfromtot').val();
		$.post("load_analyiticscheck.php", {fromdt:tot_from,todt:tot_to,type:'totitemwisechk',set:"ok"},
		  function(data)
		  {
		  		data=$.trim(data);
				
				if(data!="sorry")
				{
					$('#reportload').empty();
					$('#reportload').append('<iframe id="reportload_frame" width="100%" height="500px" frameborder="0" style="  margin-left: 15%;"></iframe>');
					var params = "total_sales_report.php?type="+repttype+"&model=pie";
					$('#reportload_frame').attr("src", params);
					
					$('#reportload').append('<iframe id="reportload_frame2" width="100%" height="500px" frameborder="0" style="  margin-left: 15%;"></iframe>');
					var params = "total_sales_report.php?type="+repttype+"&model=horz";
					$('#reportload_frame2').attr("src", params);
					
					$('#reportload').append('<iframe id="reportload_frame3" width="100%" height="500px" frameborder="0" style="  margin-left: 15%;"></iframe>');
					var params = "total_sales_report.php?type="+repttype+"&model=vert";
					$('#reportload_frame3').attr("src", params);
					
					
				}else
				{
					$('#reportload').html("<div class='erroranalytics'> No Records found </div>");
				}
				
		  		//$('#reportload').html(data);
		  }); 
		
		
	}
	else if(repttype=="itemeach")
	{
		$('#datepickerfrom').val("");
		$('#datepickertodt').val("");
		$('#totalsalesdiv').css("display", "none");
		$('#totalorderdiv').css("display", "none");
		$('#itemselectdiv').css("display", "none");
		$('#reportload').html("");
		$('#eachitemvise').css("display", "block");
		$('#totalitemvise').css("display", "none");
		$('#compareeach').css("display", "none");
		$('#staffwise').css("display", "none");
	}  
	else if(repttype=="compare")
	{//datepickerfromcmp datepickertodtcmp paybydatecmp
		$('#datepickerfrom').val("");
		$('#datepickertodt').val("");
		$('#totalsalesdiv').css("display", "none");
		$('#totalorderdiv').css("display", "none");
		$('#itemselectdiv').css("display", "none");
		$('#reportload').html("");
		$('#eachitemvise').css("display", "none");
		$('#totalitemvise').css("display", "none");
		$('#compareeach').css("display", "block");
		$('#staffwise').css("display", "none");
		
		var tot_to=$('#datepickertodtcmp').val();
		var tot_from=$('#datepickerfromcmp').val();
		$.post("load_analyiticscheck.php", {fromdt:tot_from,todt:tot_to,type:'totcompare',set:"ok"},
		  function(data)
		  {
		  		data=$.trim(data);
				
				if(data!="sorry")
				{
					$('#reportload').empty();
					$('#reportload').append('<iframe id="reportload_frame" width="100%" height="500px" frameborder="0" style="  margin-left: 15%;"></iframe>');
					var params = "total_sales_report.php?type="+repttype+"&model=pie";
					$('#reportload_frame').attr("src", params);
					
					$('#reportload').append('<iframe id="reportload_frame2" width="100%" height="500px" frameborder="0" style="  margin-left: 15%;"></iframe>');
					var params = "total_sales_report.php?type="+repttype+"&model=horz";
					$('#reportload_frame2').attr("src", params);
					
					$('#reportload').append('<iframe id="reportload_frame3" width="100%" height="500px" frameborder="0" style="  margin-left: 15%;"></iframe>');
					var params = "total_sales_report.php?type="+repttype+"&model=vert";
					$('#reportload_frame3').attr("src", params);
					
					
				}else
				{
					$('#reportload').html("<div class='erroranalytics'> No Records found </div>");
				}
				
		  		//$('#reportload').html(data);
		  }); 
		
	} 
	else if(repttype=="staffwise")
	{
		$('#datepickerfrom').val("");
		$('#datepickertodt').val("");
		$('#totalsalesdiv').css("display", "none");
		$('#totalorderdiv').css("display", "none");
		$('#itemselectdiv').css("display", "none");
		$('#reportload').html("");
		$('#totalpaydiv').css("display", "none");
		$('#staffwise').css("display", "block");
		$('#compareeach').css("display", "none");
		
	}
	else if(repttype=="type_pay")
	{
		$('#datepickerfrom').val("");
		$('#datepickertodt').val("");
		$('#totalsalesdiv').css("display", "none");
		$('#totalorderdiv').css("display", "none");
		$('#itemselectdiv').css("display", "none");
		$('#reportload').html("");
		$('#totalpaydiv').css("display", "block");
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
		$('#reportload').html("");
	}
	else if(repttype=="steward")
	{
	
		$('#totalsteward').css("display", "block");
		$('#itemselectdiv').css("display", "none");
		$('#totalorderdiv').css("display", "none");
		$('#totalsalesdiv').css("display", "none");
		$('#totalpaydiv').css("display", "none");
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
		$('#datepickerfromord').val("");
		$('#datepickertodtord').val("");
		$('#reportload').html("");
	}     
	else if(repttype=="type_order")
	{
		$('#typooforder').css("display", "block");
		 $('#totalorderdiv').css("display", "none");
		$('#totalsteward').css("display", "none");
		$('#itemselectdiv').css("display", "none");
		$('#totalsalesdiv').css("display", "none");
		$('#totalpaydiv').css("display", "none");
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
 
 
  //dinein take dineinstaff takeawaystaff
 function typechnagesel(val)
 {
	 if(val=="dinein")
	 {
		$('#dineinstaff').css("display", "block");
		 $('#takeawaystaff').css("display", "none"); 
		 $('.otherstaf').css("display", "block");
	 }else  if(val=="take")
	 {
		 $('#dineinstaff').css("display", "none");
		 $('#takeawaystaff').css("display", "block");
		  $('.otherstaf').css("display", "block"); 
	 }
 }

</script>



</body>
</html>
