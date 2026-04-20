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
	
	$("#datepickerfromdtamt").datepicker({
      changeMonth: true,
      changeYear: true
    });
	$("#datepickertodtamt").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	
	$("#datepickerfromord").datepicker({
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
	
 $("#datepickerfromsales").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	 $("#datepickertodtsales").datepicker({
      changeMonth: true,
      changeYear: true,
	  maxDate: "+0D "
    });
	
	// discountsalesdiv  datepickerfromdisc  datepickertodtdisc bydatedisc 
        $('#typedisc').change(function () {
	var typedisc=$(this).val();
		var fromval=$('#datepickerfromdisc').val();
		var tot_to=$('#datepickertodtdisc').val();
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;		
		var bydate=$('#bydatedisc').val();
						$.post("load_takeawayreport.php", {fromdt:fromval,todt:tot_to,type:typeval,typedisc:typedisc,bydate:bydate,sale:"sl"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});					
	});
        
        $('#datepickerfromdisc').change(function () {
		var fromval=$(this).val();
		var typedisc=$('#typedisc').val();
		var tot_to=$('#datepickertodtdisc').val();
		var typeval=$('#typeval').val();
		$('#bydatedisc').val("null");

						$.post("load_takeawayreport.php", {fromdt:fromval,todt:tot_to,type:typeval,typedisc:typedisc,set:"ft"},
						function(data)
						{
							data=$.trim(data);
							$('#reportload').html(data);
						});					
	});
        
    $('#datepickertodtdisc').change(function () {		
		$('#bydatedisc').val("null");
		$('#ui-datepicker-div').css("display", "none");
		var tot_to=$(this).val();
		var tot_from=$('#datepickerfromdisc').val();
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;
		var typedisc=$('#typedisc').val();
		if(tot_from=="")
		{
			tot_from="";
		}
						$.post("load_takeawayreport.php", {fromdt:tot_from,todt:tot_to,type:typeval,typedisc:typedisc,set:"ft"},
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
        
    $('#bydatedisc').change(function () 
	{
		var bydate=$(this).val();
		var typedisc=$('#typedisc').val();
		var typeval=$('#typeval').val();
	  	$('#datepickerfromdisc').val(""); 
	 	$('#datepickertodtdisc').val("");
						$.post("load_takeawayreport.php", {bydate:bydate,type:typeval,typedisc:typedisc,abc:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});					
		});
        
        

	/*****************************************discount ends**************************************************************/
	
	/*******************************************type  of sales change starts**********************************************/
    $('#staffsel22').change(function () {
        var staffsel=$(this).val();
        var typesale='HD';
		var fromval=$('#datepickerfromsales').val();
		var tot_to=$('#datepickertodt').val();
		var typeval=$('#typeval').val();
		var bydate=$('#bydatesales').val();		
						$.post("load_hdreport.php", {fromdt:fromval,todt:tot_to,type:typeval,typesale:typesale,staffsel:staffsel,bydate:bydate,sale:"sl"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
					
	});
        
    $('#loginstaffsel').change(function () {
        var staffsel=$(this).val();
        var typesale='TA';
		var fromval=$('#datepickerfromsales').val();
		var tot_to=$('#datepickertodtsales').val();
		var typeval=$('#typeval').val();
		var bydate=$('#bydatesales').val();		
						$.post("load_tareport.php", {fromdt:fromval,todt:tot_to,type:typeval,typesale:typesale,loginstaffsel:staffsel,bydate:bydate},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});								
	});
               
    $('#datepickerfromsales').change(function () {
		var fromval=$(this).val();
        var staffsel=$('#staffsel').val();
        var loginstaffsel=$('#loginstaffsel').val();
		var typesale='TA';
		var tot_to=$('#datepickertodtsales').val();
		var typeval=$('#typeval').val();
		$('#bydatesales').val("");
        var bydate=$('#bydatesales').val();
		var addon=$('#menu_type').val();
		var sortby=$('#bill_sort').val();
        var partner=$('#online_partner_id').val();
        var partner_mode=$('#online_partner_mode').val();	
						$.post("load_tareport.php", {fromdt:fromval,todt:tot_to,bydate:bydate,type:typeval,typesale:typesale,staffsel:staffsel,loginstaffsel:loginstaffsel,addon:addon,sortby:sortby,partner:partner,partner_mode:partner_mode},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});				
	});
	
    $('#datepickertodtsales').change(function () {
		var partner=$('#online_partner_id').val();
        var partner_mode=$('#online_partner_mode').val();
		var staffsel=$('#staffsel').val();
        var loginstaffsel=$('#loginstaffsel').val();
		$('#bydatesales').val("");
		$('#ui-datepicker-div').css("display", "none");
		var tot_to=$(this).val();
        var bydate=$('#bydatesales').val();
		var tot_from=$('#datepickerfromsales').val();
		var typeval=$('#typeval').val();
		var typesale='TA';
        var addon=$('#menu_type').val();
		if(tot_from=="")
		{
			tot_from="";
		}
        var sortby=$('#bill_sort').val();
						$.post("load_tareport.php", {fromdt:tot_from,todt:tot_to,bydate:bydate,type:typeval,typesale:typesale,staffsel:staffsel,loginstaffsel:loginstaffsel,addon:addon,sortby:sortby,partner:partner,partner_mode:partner_mode},
						function(data)
						{
							  data=$.trim(data);							
							  $('#reportload').html(data);
						});				
	});
	
    $('#online_partner_mode').change(function () 
        {
		var bydate=$('#bydatesales').val();
		var staffsel=$('#staffsel').val();
        var tot_to=$('#datepickertodtsales').val();
		var tot_from=$('#datepickerfromsales').val();
        var loginstaffsel=$('#loginstaffsel').val();
        var typesale= 'TA';
        var addon=$('#menu_type').val();	
		var typeval=$('#typeval').val();
        var sortby=$('#bill_sort').val();
	    $('#datepickerfromsales').val(""); 
	    $('#datepickertodtsales').val("");
		var partner=$('#online_partner_id').val();
        var partner_mode=$('#online_partner_mode').val();          
						$.post("load_tareport.php", {fromdt:'',todt:'',bydate:bydate,type:typeval,typesale:typesale,staffsel:staffsel,loginstaffsel:loginstaffsel,addon:addon,sortby:sortby,partner:partner,partner_mode:partner_mode},
						function(data)
						{
							data=$.trim(data);
							$('#reportload').html(data);
						});					
		});  
        
    $('#online_partner_id').change(function () 
        {
		var bydate=$('#bydatesales').val();
		var staffsel=$('#staffsel').val();
        var tot_to=$('#datepickertodtsales').val();
		var tot_from=$('#datepickerfromsales').val();
        var loginstaffsel=$('#loginstaffsel').val();
        var typesale= 'TA';
        var addon=$('#menu_type').val();
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;
        var sortby=$('#bill_sort').val();
	  	$('#datepickerfromsales').val(""); 
	 	$('#datepickertodtsales').val("");
		var partner=$('#online_partner_id').val();
        var partner_mode=$('#online_partner_mode').val();            
						$.post("load_tareport.php", {fromdt:'',todt:'',bydate:bydate,type:typeval,typesale:typesale,staffsel:staffsel,loginstaffsel:loginstaffsel,addon:addon,sortby:sortby,partner:partner,partner_mode:partner_mode},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
		});    
        
    $('#bydatesales').change(function () 
        {
		var bydate=$(this).val();
		var staffsel=$('#staffsel').val();
        var tot_to=$('#datepickertodtsales').val();
		var tot_from=$('#datepickerfromsales').val();
        var loginstaffsel=$('#loginstaffsel').val();
        var typesale= 'TA';
        var addon=$('#menu_type').val();
		var partner=$('#online_partner_id').val();
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;
        var sortby=$('#bill_sort').val();
	    $('#datepickerfromsales').val(""); 
	    $('#datepickertodtsales').val("");
		var partner_mode=$('#online_partner_mode').val();		
						$.post("load_tareport.php", {fromdt:'',todt:'',bydate:bydate,type:typeval,typesale:typesale,staffsel:staffsel,loginstaffsel:loginstaffsel,addon:addon,sortby:sortby,partner:partner,partner_mode:partner_mode},
						function(data)
						{
							  data=$.trim(data);						
							  $('#reportload').html(data);
						});
		});
	
	$('#menu_type').change(function () 
	{  
		$('#ui-datepicker-div').css("display", "none");
		var typeval=$('#typeval').val();
        var bydate=$('#bydatesales').val();
        var fromval=$('#datepickerfromsales').val();
        var tot_to=$('#datepickertodtsales').val();
        var addon=$(this).val();	
						$.post("load_tareport.php", {type:typeval,fromdt:fromval,todt:tot_to,bydate:bydate,addon:addon},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
						
	});
	/*******************************************type  of sales change ends**********************************************/
	
	/*******************************************date picker change sales starts**********************************************/
	$('#datepickerfrom').change(function () 
	{		
		$('#ui-datepicker-div').css("display", "none");
		var fromval=$(this).val();
		var tot_to=$('#datepickertodt').val();
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;
		$('#bydate').val("null");
		if(tot_to=="")
		{
			tot_to="";
		}
						$.post("load_takeawayreport.php", {fromdt:fromval,todt:tot_to,type:typeval,set:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
	});

	$('#datepickerfrom').click(function () {
		$('#ui-datepicker-div').css("display", "block");
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
		if(tot_from=="")
		{
			tot_from="";
		}
						$.post("load_takeawayreport.php", {fromdt:tot_from,todt:tot_to,type:typeval,set:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
		}); 

	$('#bydate').change(function () 
	{
		var fromval=$(this).val();
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;
	  	$('#datepickertodt').val(""); 
	 	$('#datepickerfrom').val("");
		var bydate=$('#bydate').val();
		if(tot_to=="")
		{
			tot_to="";
		}
						$.post("load_takeawayreport.php", {bydate:bydate,type:typeval,abc:"ft"},
						function(data)
						{
							data=$.trim(data);
							$('#reportload').html(data);
						});
	});

	$('#bill_sort').change(function () 
	{
		$('#ui-datepicker-div').css("display", "none");
        var sortby=$(this).val();
		var fromval=$('#datepickerfromsales').val();
		var tot_to=$('#datepickertodtsales').val();
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;
		$('#bydatekot').find('option:first').attr('selected', 'selected');
		if(tot_to=="")
		{
			tot_to="";
		}
		var bydate=$('#bydatesales').val();

						$.post("load_tareport.php", {fromdt:fromval,todt:tot_to,sortby:sortby,bydate:bydate,type:typeval,sortby:sortby,set:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
					
	});

	$('#stewardbydate').change(function () 
	{
		var fromval=$(this).val();
		var tot_to=$('#datepickertodt').val();
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;
		var typepay=$('#stewardtp').val();
		var stewardbydate=$('#stewardbydate').val();
		$('#datepickerfromdtstw').val("");
		$('#datepickertodtstw').val("");
		if(tot_to=="")
		{
			tot_to="";
		}

		if(typepay !="")
		{
			$.post("load_takeawayreport.php", {stewardbydate:stewardbydate,type:typeval,stwrd:typepay,abc:"ft"},
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
	
	$('#amtbydate').change(function () 
	{		
		var fromval=$(this).val();
		var tot_to=$('#datepickertodtamt').val();
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;
		var typepay=$('#stewardamt').val();
		var stewardbydate=$('#amtbydate').val();
		$('#datepickerfromdtamt').val("");
		$('#datepickertodtamt').val("");
		if(tot_to=="")
		{
			tot_to="";
		}
		if(typepay !="")
		{		
			$.post("load_takeawayreport.php", {stewardbydate:stewardbydate,type:typeval,stwrd:typepay,abc:"ft"},
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
			var reprtz=$('#rptstatus');
			reprtz.text('Pls select steward');	
			$("#rptstatus").delay(1000).fadeOut('slow');
		}		
	});
	
	$('#orderbydate').change(function () {
		var fromval=$(this).val();
		var tot_to=$('#datepickertodt').val();
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;
		var orderbydate=$('#orderbydate').val();
		$('#datepickerfromord').val("");
		$('#datepickertodtord').val("");
		if(tot_to=="")
		{
			tot_to="";
		}
			$.post("load_takeawayreport.php", {orderbydate:orderbydate,type:typeval,abc:"ft"},
			function(data)
			{
				data=$.trim(data);
				$('#reportload').html(data);
			});
	});
	
	$('#portionbydate').change(function () 
	{
		var fromval=$(this).val();
		var tot_to=$('#datepickertodt').val();
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;	
		var portn=$('#portiontp').val();		
		var portionbydate=$('#portionbydate').val();
		$('#datepickerfromdtprtn').val("");		
		$('#datepickertodtprtn').val("");		
		if(tot_to=="")
		{
			tot_to="";
		}
						$.post("load_takeawayreport.php", {portionbydate:portionbydate,type:typeval,portn:portn,abc:"ft"},
						function(data)
						{
							data=$.trim(data);
							$('#reportload').html(data);
						});
	});
	
	$('#ordertyp').change(function () 
	{
		var fromval=$(this).val();
		var tot_to=$('#datepickertodt').val();
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;
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

	$('#ordertypebydate').change(function () 
	{
		var fromval=$(this).val();
		var tot_to=$('#datepickertodt').val();
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;
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
	
	/*****************************************date picker change sales ends**************************************************/
	
	/*******************************************type of payment starts**********************************************/

    $('#typepaysale').change(function () 
	{
        var typepaysale=$(this).val();
        var typeofpay=$('#typepay').val();
		var fromval=$('#datepickerfromtyp').val();
		var tot_to=$('#datepickertodttyp').val();
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;
		var bydate=$('#paybydate').val();
		
				$.post("load_takeawayreport.php", {fromdt:fromval,todt:tot_to,type:typeval,typepay:typeofpay,typepaysale:typepaysale,bydate:bydate,sale:"sl"},
				function(data)
				{                                        
					data=$.trim(data);
                    $('#reportload').html(data);
				});	
	});
        
    $('#typepay').change(function ()
	{
        var typepaysale=$('#typepaysale').val();
		var typeofpay=$(this).val();
		var typeval=$('#typeval').val(); 
		var paybydate=$('#paybydate').val(); 
		var tot_from=$('#datepickerfromtyp').val();
		var tot_to=$('#datepickertodttyp').val();
		if(typeofpay !="null" && paybydate =="null" )
		{
				$.post("load_takeawayreport.php", {fromdt:tot_from,todt:tot_to,typepay:typeofpay,typepaysale:typepaysale,type:typeval,set:"ft"},
				function(data)
				{
					  data=$.trim(data);
					  $('#reportload').html(data);
				});				
	
		}
		else if(typeofpay !="null" && paybydate !="null" )
		{
				$.post("load_takeawayreport.php", {fromdt:tot_from,todt:tot_to,typepay:typeofpay,type:typeval,typepaysale:typepaysale,paybydate:paybydate,pay:"aft"},
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
	
	$('#datepickerfromtyp').change(function () 
	{
        var typepaysale=$('#typepaysale').val();
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
				$.post("load_takeawayreport.php", {fromdt:tot_from,todt:tot_to,typepay:typeofpay,type:typeval,typepaysale:typepaysale,set:"ft"},
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
	
	$('#datepickertodttyp').change(function () 
	{
		$('#ui-datepicker-div').css("display", "none");
        var typepaysale=$('#typepaysale').val();
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
						$.post("load_takeawayreport.php", {fromdt:tot_from,todt:tot_to,typepay:typeofpay,type:typeval,typepaysale:typepaysale,set:"ft"},
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
        
	$('#paybydate').change(function () 
	{
        var typepaysale=$('#typepaysale').val();
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
				$.post("load_takeawayreport.php", {paybydate:paybydate,type:typeval,typepaysale:typepaysale,typepay:typepay,abc:"ft"},
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
	
	$('#stewardtp').change(function () 
	{
		var stwrdid=$(this).val();
		var typeval=$('#typeval').val(); 
		var tot_from=$('#datepickerfromdtstw').val();
		var tot_to=$('#datepickertodtstw').val();
		var stewardbydate=$('#stewardbydate').val();
		if(stwrdid !="null" && stewardbydate=="null" && tot_from=="" && tot_to=="")
		{
						$.post("load_takeawayreport.php", {fromdt:tot_from,todt:tot_to,stwrd:stwrdid,type:typeval,set:"ft"},
						function(data)
						{
							data=$.trim(data);
							$('#reportload').html(data);
						});
		}
		
		else if(stwrdid !="null" && stewardbydate !="null" )
		{
						$.post("load_takeawayreport.php", {fromdt:tot_from,todt:tot_to,stwrd:stwrdid,type:typeval,stewardbydate:stewardbydate,stwr:"ft"},
						function(data)
						{
							data=$.trim(data);
							$('#reportload').html(data);
						});				
		}
		else if(stwrdid !="null" && stewardbydate=="null" && tot_from !="")
		{
						$.post("load_takeawayreport.php", {fromdt:tot_from,todt:tot_to,stwrd:stwrdid,type:typeval,stewardbydate:stewardbydate},
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
		
	$('#datepickerfromdtstw').change(function () 
	{
		$('#ui-datepicker-div').css("display", "none");
		var tot_from=$(this).val();
		var tot_to=$('#datepickertodtstw').val();
		var stwrdid=$('#stewardtp').val();
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;
		$('#stewardbydate').val("null");
		if(tot_to=="")
		{
			tot_to="";
		}
						$.post("load_takeawayreport.php", {fromdt:tot_from,todt:tot_to,stwrd:stwrdid,type:typeval},
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
	$('#datepickerfromdtamt').click(function () {
		$('#ui-datepicker-div').css("display", "block");
	});
	$('#datepickertodtamt').click(function () {
		$('#ui-datepicker-div').css("display", "block");
	});	
	
	$('#datepickerfromdtamt').change(function () 
	{
		$('#ui-datepicker-div').css("display", "none");
		var tot_from=$(this).val();
		var tot_to=$('#datepickertodtamt').val();
		var stwrdid=$('#stewardamt').val();
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;
		$('#amtbydate').val("null");
		if(tot_to=="")
		{
			tot_to="";
		}
						$.post("load_takeawayreport.php", {fromdt:tot_from,todt:tot_to,stwrd:stwrdid,type:typeval},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
	});
	
	
	$('#datepickertodtamt').change(function () 
	{
		$('#ui-datepicker-div').css("display", "none");
		var tot_to=$(this).val();
		var tot_from=$('#datepickerfromdtamt').val();
		var stwrdid=$('#stewardamt').val();
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;
		$('#amtbydate').val("null");
		if(tot_from=="")
		{
			tot_from="";
		}
						$.post("load_takeawayreport.php", {fromdt:tot_from,todt:tot_to,stwrd:stwrdid,type:typeval},
						function(data)
						{
							data=$.trim(data);
							$('#reportload').html(data);
						});
	});
	
	$('#datepickertodtstw').change(function () 
	{		
		$('#ui-datepicker-div').css("display", "none");
		var tot_to=$(this).val();
		var tot_from=$('#datepickerfromdtstw').val();
		var stwrdid=$('#stewardtp').val();
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;
		$('#stewardbydate').val("null");
	
		if(tot_from=="")
		{
			tot_from="";
		}
						$.post("load_takeawayreport.php", {fromdt:tot_from,todt:tot_to,stwrd:stwrdid,type:typeval},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});					

	});
	 /*****************************************Steward ends**************************************************************/
	 
	 $('#stewardamt').change(function () 
	 {
		var stwrdid=$(this).val();
		var typeval=$('#typeval').val(); 
		var tot_from=$('#datepickerfromdtamt').val();
		var tot_to=$('#datepickertodtamt').val();
		var stewardbydate=$('#amtbydate').val();
		if(stwrdid !="null" && stewardbydate=="null" && tot_from=="" && tot_to=="")
		{
						$.post("load_takeawayreport.php", {fromdt:tot_from,todt:tot_to,stwrd:stwrdid,type:typeval,set:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});				
		}
		else if(stwrdid !="null" && stewardbydate !="null" )
		{
						$.post("load_takeawayreport.php", {fromdt:tot_from,todt:tot_to,stwrd:stwrdid,type:typeval,stewardbydate:stewardbydate,stwr:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
		}
		else if(stwrdid !="null" && stewardbydate=="null" && tot_from !="")
		{		
						$.post("load_takeawayreport.php", {fromdt:tot_from,todt:tot_to,stwrd:stwrdid,type:typeval,stewardbydate:stewardbydate},
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
			var rptstatus22000=$('#rptstatus');
		    rptstatus22000.text('Pls select steward');	
			$("#rptstatus").delay(1000).fadeOut('slow');	
		}
	});
/*******************************************Item Orderd starts**********************************************/
//// datepickertodtord datepickerfromord
	
	$('#datepickerfromord').change(function () 
	{
		$('#orderbydate').val("null");
		$('#ui-datepicker-div').css("display", "none");
		var fromval=$(this).val();
		var tot_to=$('#datepickertodtord').val();
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;
		if(tot_to=="")
		{
			tot_to="";
		}
						$.post("load_takeawayreport.php", {fromdt:fromval,todt:tot_to,type:typeval,set:"ft"},
						function(data)
						{
							data=$.trim(data);
							$('#reportload').html(data);
						});
	});

	$('#datepickerfromord').click(function () {
		$('#ui-datepicker-div').css("display", "block");
	});	
	
	$('#datepickertodtord').click(function () {
		$('#ui-datepicker-div').css("display", "block");
	});	
	
	$('#datepickertodtord').change(function () 
	{
		$('#ui-datepicker-div').css("display", "none");
		$('#orderbydate').val("null");
		var tot_to=$(this).val();
		var tot_from=$('#datepickerfromord').val();
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;
		if(tot_from=="")
		{
			tot_from="";
		}
						$.post("load_takeawayreport.php", {fromdt:tot_from,todt:tot_to,type:typeval,set:"ft"},
						function(data)
						{
							data=$.trim(data);
							$('#reportload').html(data);
						});
	});
	/*****************************************Item Orderd ends**************************************************************/
	
	/*****************************************Portion orderd starts**************************************************************/
	
	$('#datepickerfromdtprtn').change(function () {
		$('#ui-datepicker-div').css("display", "none");
		var fromval=$(this).val();	
		var tot_to=$('#datepickertodtprtn').val();
		var typeval=$('#typeval').val();
		var portion=$('#portiontp').val();//document.getElementById("typeval").value;
		$('#portionbydate').find('option:first').attr('selected', 'selected');
		if(tot_to=="")
		{
			tot_to="";
		}
						$.post("load_takeawayreport.php", {fromdt:fromval,todt:tot_to,type:typeval,portn:portion,set:"ft"},
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
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;
		var portion=$('#portiontp').val();
		$('#portionbydate').find('option:first').attr('selected', 'selected');
		if(tot_from=="")
		{
			tot_from="";
		}
						$.post("load_takeawayreport.php", {fromdt:tot_from,todt:tot_to,type:typeval,portn:portion,set:"ft"},
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

						$.post("load_takeawayreport.php", {fromdt:tot_from,todt:tot_to,portn:portnid,type:typeval,set:"ft"},
						function(data)
						{
							  data=$.trim(data);
							  $('#reportload').html(data);
						});
		}
		
		else 
		{			
						$.post("load_takeawayreport.php", {fromdt:tot_from,todt:tot_to,portn:portnid,type:typeval,portionbydate:portionbydate,port:"ft"},
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
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;
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
						
 <div  class="sitemap_cc">Take Away Report</div>
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
                                   <div class="input-group" style="width: 84%;">
                                         <select  class="form-control add_new_dropdown_report" onChange="reportcreate(this.value)" name="typeval" id="typeval">
                                                 <option value="">Type of report</option>                                        
                                           <?php  
                                         $sql_login  =  $database->mysqlQuery("select rm_reportid,rm_printa4,rm_posprintofanother,rm_reportname from tbl_reportmaster where rm_reportview='Y' and rm_reporttype='TA'"); 
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
                            <!-- date ends --> 
                           
                            
                            
                            
                            
                            
                            
                            
                             <!-- type of sales starts -->                     
                                  <div id="type_salesdiv" style="display:none" >
                                  <div id="stfsel">
                                   <div class="search_name_box_main">
                                    <div class="text-selection_name">Delivery Staff:</div>
                                     <div class="input-group">
                                         <select  class="form-control add_new_dropdown_report" name="staffsel" id="staffsel">
                                              <option value="null" default>All</option>
                                             
                                            <?php
                                            $sql_staff  =  $database->mysqlQuery("SELECT ser_staffid, ser_firstname, ser_lastname FROM tbl_staffmaster sm
                                            left join tbl_designationmaster dm on dm.dr_designationid = sm.ser_designation
                                            WHERE sm.ser_employeestatus = 'Active' AND dm.dr_designationname = 'Delivery Boy'"); 
                                            $num_staff   = $database->mysqlNumRows($sql_staff);
                                            if($num_staff){
                                                while($result_staff  = $database->mysqlFetchArray($sql_staff)) {
                                                    echo '<option value="'.$result_staff['ser_staffid'].'">'.$result_staff['ser_firstname'].'</option>';
                                                }
                                                }
                                            ?>
                                             
                                         </select>   
                                    </div>
                                 </div>
                                  </div>
                                       <div id="userloginstf" style="display:none">
                                      <div class="search_name_box_main">
                                    <div class="text-selection_name">Login Staff:</div>
                                     <div class="input-group">
                                         <select  class="form-control add_new_dropdown_report" name="loginstaffsel" id="loginstaffsel">
                                              <option value="null" default>All</option>
                                             
                                            <?php
                                            $sql_logstaff  =  $database->mysqlQuery("SELECT distinct(tab_loginid) 
                                            FROM tbl_takeaway_billmaster 
                                            WHERE  tab_status='Closed' AND tab_mode= 'TA' order by tab_loginid asc"); 
                                            $num_logstaff   = $database->mysqlNumRows($sql_logstaff);
                                            if($num_logstaff){
                                                while($result_logstaff  = $database->mysqlFetchArray($sql_logstaff)) {
                                                    echo '<option value="'.$result_logstaff['tab_loginid'].'">'.$result_logstaff['tab_loginid'].'</option>';
                                                }
                                                }
                                            ?>
                                             
                                         </select>   
                                    </div>
                                 </div>
                                           </div>
                                      <div id="loginstf" style="display:none">
                                      <div class="search_name_box_main">
                                    <div class="text-selection_name">Login Staff:</div>
                                     <div class="input-group">
                                         <select  class="form-control add_new_dropdown_report" name="loginstaffsel" id="loginstaffsel">
                                              <option value="null" default>All</option>
                                             
                                            <?php
                                            $sql_logstaff  =  $database->mysqlQuery("SELECT distinct(tab_cancelledlogin) 
                                            FROM tbl_takeaway_billmaster 
                                            WHERE  tab_status='cancelled' AND tab_mode= 'TA' order by tab_cancelledlogin asc"); 
                                            $num_logstaff   = $database->mysqlNumRows($sql_logstaff);
                                            if($num_logstaff){
                                                while($result_logstaff  = $database->mysqlFetchArray($sql_logstaff)) {
                                                    echo '<option value="'.$result_logstaff['tab_cancelledlogin'].'">'.$result_logstaff['tab_cancelledlogin'].'</option>';
                                                }
                                                }
                                            ?>
                                             
                                         </select>   
                                    </div>
                                 </div>
                                           </div>
                                  <div id="online_partner_mode_div" style="display:none">
                                      <div class="search_name_box_main">
                                    <div class="text-selection_name">Mode</div>
                                     <div class="input-group">
                                         <select  class="form-control add_new_dropdown_report" id="online_partner_mode">
                                              <option value="" default>All</option>
                                              <option value="TA" >TA</option>
                                             <option value="HD" >HD</option>
                                             
                                         </select>   
                                    </div>
                                 </div>
                                           </div>
                                  
                                  <div id="online_partner" style="display:none">
                                      <div class="search_name_box_main">
                                    <div class="text-selection_name">Online Partners</div>
                                     <div class="input-group">
                                         <select  class="form-control add_new_dropdown_report" name="loginstaffsel" id="online_partner_id">
                                              <option value="" default>All</option>
                                             
                                            <?php
                                            $sql_logstaff2  =  $database->mysqlQuery("SELECT tol_id,tol_name from tbl_online_order WHERE tol_status='Y'"); 
                                            $num_logstaff2   = $database->mysqlNumRows($sql_logstaff2);
                                            if($num_logstaff2){
                                                while($result_logstaff2  = $database->mysqlFetchArray($sql_logstaff2)) {
                                                    ?>
                                              
                                               <option value="<?=$result_logstaff2['tol_id']?>" > <?=$result_logstaff2['tol_name']?> </option>
                                              <?php      
                                                }
                                                }
                                            ?>
                                             
                                         </select>   
                                    </div>
                                 </div>
                                           </div>
                                  
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">From:</div>
                                     <div class="input-group">
                                         <input type="text" class="form-control" id="datepickerfromsales" >     
                                    </div>
                                 </div>
                                 
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">To  :</div>
                                     <div class="input-group">
                                         <input type="text" class="form-control" id="datepickertodtsales" >            
                                    </div>
                                 </div>
                                 
                                         <div class="search_name_box_main">
            	<div class="text-selection_name">By Date</div>
                  <div class="input-group">
                <select class="form-control add_new_dropdown_report" name="bydatesales" id="bydatesales" >
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
             
                             <!-- type of sales starts -->                     
                            
                            
                            
                            
        <!------------------------------------ type of payment starts ------------------------------------------>
        
                            <div id="totalpaydiv" style="display:none" >
                                
                                <div class="search_name_box_main">
                                    <div class="text-selection_name">Type of Sale:</div>
                                     <div class="input-group">
                                         <select  class="form-control add_new_dropdown_report" name="typepaysale" id="typepaysale">
                                              <option value="null" default>Select mode</option>
                                              <option value="">All</option>
                                              <option value="TA">Take Away</option>
                                              <option value="HD">Home Delivery</option>
                                             
                                         </select>   
                                    </div>
                                 </div>
                                
                                
                                
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
                <!-------------------------- type of payment ends ------------------------------------------->  
                              <!-- item starts -->                     
                            <div id="itemselectdiv" style="display:none" >
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">Floor:</div>
                                     <div class="input-group">
                                         <select  class="form-control add_new_dropdown_report" name="floorsel" id="floorsel">
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
                   $sql_ds_nos="select ser_staffid,ser_firstname from tbl_staffmaster where ser_designation='".$_SESSION['desgn_deliveryboy']."' AND  ser_employeestatus='Active'";
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
                             
<!-------------------------------------------- discount starts -------------------------------------------------> 

                            <div id="discountsalesdiv" style="display:none" >
                                
                                <div class="search_name_box_main">
                                    <div class="text-selection_name">Type of Sale:</div>
                                     <div class="input-group">
                                         <select  class="form-control add_new_dropdown_report" name="typedisc" id="typedisc">
                                              <option value="null" default>Select mode</option>
                                              <option value="">All</option>
                                              <option value="TA">Take Away</option>
                                              <option value="HD">Home Delivery</option>
                                             
                                         </select>   
                                    </div>
                                 </div>
                                
                                
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
                            <!-------------------------------------- discount ends -------------------------------------->  
                            
              
                            
                             
                             
                             
                            <!-- type of Order ends -->  
                         <div id="totalamt" style="display:none" >
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">Steward:</div>
                                     <div class="input-group">
                                         <select  class="form-control add_new_dropdown_report" name="stewardamt" id="stewardamt">
                                              <option value="">Steward</option>
					 <?php
                   $sql_ds_nos="select * from tbl_staffmaster where ser_designation='".$_SESSION['desgn_deliveryboy']."' AND  ser_employeestatus='Active'";
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
                                         <input type="text" class="form-control" id="datepickerfromdtamt" >     
                                    </div>
                                 </div>
                                 
                                 <div class="search_name_box_main">
                                    <div class="text-selection_name">To  :</div> 
                                     <div class="input-group">
                                         <input type="text" class="form-control" id="datepickertodtamt" >            
                                    </div>
                                 </div>
                                 
                                        <div class="search_name_box_main">
            	<div class="text-selection_name">By Date</div>
                  <div class="input-group">
                <select class="form-control add_new_dropdown_report" name="amtbydate" id="amtbydate" >
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
                             <div id="bill_sort_div" style="display:none" >
                             <div class="search_name_box_main">
                                <div class="text-selection_name">Sort By</div>
                                   <div class="input-group" style="width: 55%;">
                                         <select  class="form-control add_new_dropdown_report"  name="menu_type" id="bill_sort">
                                                <option value="value_asc">Total Low--to--High</option>
                                              <option value="value_desc">Total High--to--Low</option>  
                                             <option value="bill_asc">Bill No Low--to--High</option>
                                              <option value="bill_desc">Bill No High--to--Low</option>
                                             
                                             
                                           
                                         </select>    
                                  </div>
                            </div>
                            </div>  
                            
                            
                         <input type="hidden" name="hida4settings"  id="hida4settings"    value="<?=$_SESSION['s_a4print']?>"  >
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
                 <input type="hidden" name="hiddelivry" id="hiddelivry" />
                    <div class="search_name_box_sub_btn_cc" id="prnt" style="display:none">
                           <div  class="filter_sub_btn ">
                            <a class="btn-setting"  href="#" onclick="print_page()">Print</a>
                            </div>
                     </div>
                     <!--<div class="search_name_box_sub_btn_cc">
                           <div  class="filter_sub_btn ">
                            <a class="btn-setting"  href="#" onclick="pdf_page()">To PDF</a>
                            </div>
                      </div>-->
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

function clearall()
{
	
	
	$('#typesale').val("null");
        $('#typepaysale').val("null");
        $('#typedisc').val("null");
	$('#datepickerfromsales').val("");
	$('#datepickertodtsales').val("");
        $('#datepickerfromdisc').val("");
        $('#datepickertodtdisc').val("");
        $('$datepickerfromtyp').val("");
        $('#datepickertodttyp').val("");
        $('#paybydaye').val("null");
        $('#typepay').val("null");
	$('#bydatesales').val("null");
	  $('#datepickertodt').val(""); 
	 $('#datepickerfrom').val("");
	 $('#bydate').val("null");
         $('#datepickertodtdisc').val(""); 
	 $('#datepickerfromdisc').val("");
	 $('#bydatedisc').val("null");
//	 $('#datepickerfromtyp').val("");
//	 $('#datepickertodttyp').val("");
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
	$('#datepickerfromdtamt').val("");
	$('#datepickertodtamt').val("");
	$('#stewardamt').val("");
	$('#amtbydate').val("null");
}

/*********************create report on type change starts ********************/
function reportcreate(rpt)
{
	var repttype=rpt;
	if(repttype=="tot_sales_ta")
	{     
        $('#online_partner_mode_div').css("display", "none");
        $('#online_partner').css("display", "none");
        $('#type_salesdiv').css("display", "block");
        $('#stfsel').css("display", "none");
        $('#userloginstf').css("display", "block")
		$('#totalsalesdiv').css("display", "none");               
        $('#loginstf').css("display", "none");
        $('#discountsalesdiv').css("display", "none");
		$('#totalpaydiv').css("display", "none");
		$('#itemselectdiv').css("display", "none");
		$('#totalorderdiv').css("display", "none");
		$('#totalsteward').css("display", "none");
		$('#typooforder').css("display", "none");
		$('#totalportion').css("display", "none");
		$('#totalamt').css("display", "none");	
        $('#prnt').css("display","block");
        $('#menu_typediv').css("display", "none");
        $('#bill_sort_div').css("display", "none");                
		//clearall();
                
        var staffsel=$('#staffsel').val();
        var loginstaffsel=$('#loginstaffsel').val();
        var typesale='';
		var fromval=$('#datepickerfromsales').val();
		var tot_to=$('#datepickertodtsales').val();
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;
		var bydate=$('#bydatesales').val();
				
		$.post("load_tareport.php", {type:repttype,fromdt:fromval,todt:tot_to,bydate,typesale:typesale,staffsel:staffsel,loginstaffsel:loginstaffsel},
		function(data)
		{
		data=$.trim(data);
		$('#reportload').html(data);
		});	
	}
	
        else if(repttype=="billreport_ta")
	{ $('#online_partner_mode_div').css("display", "none");
                 $('#online_partner').css("display", "none");
                $('#type_salesdiv').css("display", "block");
                $('#stfsel').css("display", "none");
                $('#userloginstf').css("display", "none")
		$('#totalsalesdiv').css("display", "none");
                
                $('#loginstf').css("display", "none");
                $('#discountsalesdiv').css("display", "none");
		$('#totalpaydiv').css("display", "none");
		$('#itemselectdiv').css("display", "none");
		$('#totalorderdiv').css("display", "none");
		$('#totalsteward').css("display", "none");
		$('#typooforder').css("display", "none");
		$('#totalportion').css("display", "none");
		$('#totalamt').css("display", "none");	
                $('#prnt').css("display","block");
                $('#menu_typediv').css("display", "none");
                $('#bill_sort_div').css("display", "block");
                 $('#bill_sort').find('option:first').prop('selected','selected');
		//clearall();
                
                var staffsel=$('#staffsel').val();
                var loginstaffsel=$('#loginstaffsel').val();
                var typesale='';
		var fromval=$('#datepickerfromsales').val();
		var tot_to=$('#datepickertodtsales').val();
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;
		var sortby=$('#bill_sort').val();
		var bydate=$('#bydatesales').val();

				$.post("load_tareport.php", {type:repttype,fromdt:fromval,todt:tot_to,bydate,typesale:typesale,staffsel:staffsel,loginstaffsel:loginstaffsel,sortby:sortby},
				  function(data)
				  {
						data=$.trim(data);
						$('#reportload').html(data);
				  });
		
	}
         else if(repttype=="customers_ta")
	{   
            $('#bill_sort_div').css("display", "none");
            $('#online_partner_mode_div').css("display", "none");
                $('#online_partner').css("display", "none");
                $('#type_salesdiv').css("display", "block");
                $('#stfsel').css("display", "none");
                $('#userloginstf').css("display", "none")
		$('#totalsalesdiv').css("display", "none");
                
                $('#loginstf').css("display", "none");
                $('#discountsalesdiv').css("display", "none");
		$('#totalpaydiv').css("display", "none");
		$('#itemselectdiv').css("display", "none");
		$('#totalorderdiv').css("display", "none");
		$('#totalsteward').css("display", "none");
		$('#typooforder').css("display", "none");
		$('#totalportion').css("display", "none");
		$('#totalamt').css("display", "none");	
                $('#prnt').css("display","block");
                $('#menu_typediv').css("display", "none");
                //$('#bill_sort_div').css("display", "block");
                 $('#bill_sort').find('option:first').prop('selected','selected');
		//clearall();
                
                var staffsel=$('#staffsel').val();
                var loginstaffsel=$('#loginstaffsel').val();
                var typesale='';
		var fromval=$('#datepickerfromsales').val();
		var tot_to=$('#datepickertodtsales').val();
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;
		var sortby=$('#bill_sort').val();
		var bydate=$('#bydatesales').val();
		
					$.post("load_tareport.php", {type:repttype,fromdt:fromval,todt:tot_to,bydate,typesale:typesale,staffsel:staffsel,loginstaffsel:loginstaffsel,sortby:sortby},
				  function(data)
				  {
						data=$.trim(data);
						$('#reportload').html(data);
				  });
				
	}
         else if(repttype=="tot_sale_online")
	{     $('#online_partner_mode_div').css("display", "block");
                $('#online_partner').css("display", "block");
                $('#type_salesdiv').css("display", "block");
                $('#stfsel').css("display", "none");
                $('#userloginstf').css("display", "none")
		$('#totalsalesdiv').css("display", "none");
                
                $('#loginstf').css("display", "none");
                $('#discountsalesdiv').css("display", "none");
		$('#totalpaydiv').css("display", "none");
		$('#itemselectdiv').css("display", "none");
		$('#totalorderdiv').css("display", "none");
		$('#totalsteward').css("display", "none");
		$('#typooforder').css("display", "none");
		$('#totalportion').css("display", "none");
		$('#totalamt').css("display", "none");	
                $('#prnt').css("display","block");
                $('#menu_typediv').css("display", "none");
                //$('#bill_sort_div').css("display", "block");
                 $('#bill_sort').find('option:first').prop('selected','selected');
		//clearall();
                 $('#bill_sort_div').css("display", "none");
                var staffsel=$('#staffsel').val();
                var loginstaffsel=$('#loginstaffsel').val();
                var typesale='';
		var fromval=$('#datepickerfromsales').val();
		var tot_to=$('#datepickertodtsales').val();
		var typeval=$('#typeval').val();//document.getElementById("typeval").value;
		var sortby=$('#bill_sort').val();
		var bydate=$('#bydatesales').val();
                var partner=$('#online_partner_id').val();
                 var partner_mode=$('#online_partner_mode').val();
	
				$.post("load_tareport.php", {type:repttype,fromdt:fromval,todt:tot_to,bydate,typesale:typesale,staffsel:staffsel,loginstaffsel:loginstaffsel,sortby:sortby,partner:partner,partner_mode:partner_mode},
				  function(data)
				  {
						data=$.trim(data);
						$('#reportload').html(data);
				  });		
	}
    else if(repttype=="categorywise_report_ta")
	{   
		$('#online_partner_mode_div').css("display", "none");
        $('#online_partner').css("display", "none");
        $('#type_salesdiv').css("display", "block");
        $('#stfsel').css("display", "none");
        $('#userloginstf').css("display", "none")
		$('#totalsalesdiv').css("display", "none");
        $('#loginstf').css("display", "none");
        $('#discountsalesdiv').css("display", "none");
		$('#totalpaydiv').css("display", "none");
		$('#itemselectdiv').css("display", "none");
		$('#totalorderdiv').css("display", "none");
		$('#totalsteward').css("display", "none");
		$('#typooforder').css("display", "none");
		$('#totalportion').css("display", "none");
		$('#totalamt').css("display", "none");	
        $('#prnt').css("display","block");
        $('#menu_typediv').css("display", "none");
        $('#bill_sort_div').css("display", "none");              
        var staffsel=$('#staffsel').val();
        var loginstaffsel=$('#loginstaffsel').val();
        var typesale='';
		var fromval=$('#datepickerfromsales').val();
		var tot_to=$('#datepickertodtsales').val();
		var typeval=$('#typeval').val();
                 
				$.post("load_tareport.php", {type:repttype,fromdt:'',todt:'',bydate:''},
				  function(data)
				  {
						data=$.trim(data);
						$('#reportload').html(data);
				  });				
	}
        
        else if(repttype=="total_summary_details_ta")
	{
        $('#online_partner_mode_div').css("display", "none");
        $('#online_partner').css("display", "none");
        $('#type_salesdiv').css("display", "block");
        $('#stfsel').css("display", "none");
        $('#userloginstf').css("display", "none")
		$('#totalsalesdiv').css("display", "none");
        $('#loginstf').css("display", "none");
        $('#discountsalesdiv').css("display", "none");
		$('#totalpaydiv').css("display", "none");
		$('#itemselectdiv').css("display", "none");
		$('#totalorderdiv').css("display", "none");
		$('#totalsteward').css("display", "none");
		$('#typooforder').css("display", "none");
		$('#totalportion').css("display", "none");
		$('#totalamt').css("display", "none");	
        $('#prnt').css("display","block");
        $('#menu_typediv').css("display", "none");
        $('#bill_sort_div').css("display", "none");
   
				$.post("load_tareport.php", {type:repttype,fromdt:'',todt:'',bydate:''},
				  function(data)
				  {
						data=$.trim(data);
						$('#reportload').html(data);
				  });
	}
	
	 else if(repttype=="summary_ta")
	{
        $('#online_partner_mode_div').css("display", "none");
        $('#online_partner').css("display", "none");
        $('#type_salesdiv').css("display", "block");
        $('#stfsel').css("display", "none");
		$('#totalsalesdiv').css("display", "none");
        $('#userloginstf').css("display", "none")
        $('#loginstf').css("display", "none");
        $('#discountsalesdiv').css("display", "none");
		$('#totalpaydiv').css("display", "none");
		$('#itemselectdiv').css("display", "none");
		$('#totalorderdiv').css("display", "none");
		$('#totalsteward').css("display", "none");
		$('#typooforder').css("display", "none");
		$('#totalportion').css("display", "none");
		$('#totalamt').css("display", "none");	
        $('#prnt').css("display","block");
        $('#menu_typediv').css("display", "none");
        $('#bill_sort_div').css("display", "none");
                 
				$.post("load_tareport.php", {type:repttype,fromdt:'',todt:'',bydate:''},
				  function(data)
				  {
						data=$.trim(data);
						$('#reportload').html(data);
				  });				
	}
	
	else if(repttype=="cancel_history_ta")
	{
        $('#online_partner_mode_div').css("display", "none");
        $('#online_partner').css("display", "none");
        $('#type_salesdiv').css("display", "block");
        $('#stfsel').css("display", "none");
        $('#userloginstf').css("display", "block")
		$('#totalsalesdiv').css("display", "none");
        $('#loginstf').css("display", "none");
        $('#discountsalesdiv').css("display", "none");
		$('#totalpaydiv').css("display", "none");
		$('#itemselectdiv').css("display", "none");
		$('#totalorderdiv').css("display", "none");
		$('#totalsteward').css("display", "none");
		$('#typooforder').css("display", "none");
		$('#totalportion').css("display", "none");
		$('#totalamt').css("display", "none");	
        $('#prnt').css("display","block");
        $('#menu_typediv').css("display", "none");
        $('#bill_sort_div').css("display", "none");
                 
		$.post("load_tareport.php", {type:repttype,fromdt:'',todt:'',bydate:''},
			function(data)
				{
					data=$.trim(data);
					$('#reportload').html(data);
				});
	}
	
    else if(repttype=="order_ta")
	{            
        $('#online_partner_mode_div').css("display", "none");
        $('#online_partner').css("display", "none");
        $('#type_salesdiv').css("display", "block");
        $('#stfsel').css("display", "none");
		$('#totalsalesdiv').css("display", "none");
        $('#loginstf').css("display", "none");
        $('#userloginstf').css("display", "none")
        $('#discountsalesdiv').css("display", "none");
		$('#totalpaydiv').css("display", "none");
		$('#itemselectdiv').css("display", "none");
		$('#totalorderdiv').css("display", "none");
		$('#totalsteward').css("display", "none");
		$('#typooforder').css("display", "none");
		$('#totalportion').css("display", "none");
		$('#totalamt').css("display", "none");	
        $('#prnt').css("display","block");
        $('#menu_typediv').css("display", "block");
        $('#bill_sort_div').css("display", "none");
                 
		//clearall();
			$.post("load_tareport.php", {type:repttype,fromdt:'',todt:'',bydate:'',addon:''},
				  function(data)
				  {
						data=$.trim(data);
						$('#reportload').html(data);
				  });			
	}
	else
	{   $('#online_partner_mode_div').css("display", "none");
		$('#type_salesdiv').css("display", "none");
		$('#datepickerfrom').val("");
		$('#datepickertodt').val("");
		$('#totalsalesdiv').css("display", "none");
		$('#totalsalesdiv').css("display", "none");
		$('#typooforder').css("display", "none");
		$('#totalorderdiv').css("display", "none");
		$('#totalsteward').css("display", "none");
		$('#itemselectdiv').css("display", "none");
		$('#totalpaydiv').css("display", "none");
		$('#totalportion').css("display", "none");
		$('#totalamt').css("display", "none");		
		$('#reportload').html("");
        $('#menu_typediv').css("display", "none");
        $('#bill_sort_div').css("display", "none");
        $('#online_partner').css("display", "none");
	}
	
	
}
/*********************create report on type change ends ********************/
 
/*********************create report on total sales from and to change starts ********************/

/*********************create report on total sales from and to change ends ********************/

function movetoexcelForm()
{
	var check = confirm("Are you sure you want to create excel sheet of these records?");

	if(check==true)
	{
		
		
		var vv=document.getElementById("typeval").value;
		
		document.getElementById("hidval").value=vv;
		
		if(vv=="tot_sales_ta")
		{
			var staffsel = $('#loginstaffsel').val();
            var tot_from=$('#datepickerfromsales').val();
            var tot_to=$('#datepickertodtsales').val();
            var hidbydate=$('#bydatesales').val();

			window.location="taexcel_download.php?type="+vv+"&fromdt="+tot_from+"&todt="+tot_to+"&bydate="+hidbydate+"&staffsel="+staffsel;
		}
                else if(vv=="tot_sale_online")
		{
		var staffsel = $('#loginstaffsel').val();
                var tot_from=$('#datepickerfromsales').val();
                var tot_to=$('#datepickertodtsales').val();
                var hidbydate=$('#bydatesales').val();
                   var partner=$('#online_partner_id').val();  
                     var partner_mode=$('#online_partner_mode').val();

					window.location="taexcel_download.php?type="+vv+"&fromdt="+tot_from+"&todt="+tot_to+"&bydate="+hidbydate+"&staffsel="+staffsel+"&partner="+partner+"&partner_mode="+partner_mode;
		  
		}
                else if(vv=="billreport_ta")
		{
		var staffsel = $('#loginstaffsel').val();
                var tot_from=$('#datepickerfromsales').val();
                var tot_to=$('#datepickertodtsales').val();
                var hidbydate=$('#bydatesales').val();
                var sortby= $('#bill_sort').val();      

					window.location="taexcel_download.php?type="+vv+"&fromdt="+tot_from+"&todt="+tot_to+"&bydate="+hidbydate+"&staffsel="+staffsel+"&sortby="+sortby;				
		  
		}
                 else if(vv=="customers_ta")
		{

				var staffsel = $('#loginstaffsel').val();
                var tot_from=$('#datepickerfromsales').val();
                var tot_to=$('#datepickertodtsales').val();
                var hidbydate=$('#bydatesales').val();
                var sortby= $('#bill_sort').val();      
			window.location="taexcel_download.php?type="+vv+"&fromdt="+tot_from+"&todt="+tot_to+"&bydate="+hidbydate+"&staffsel="+staffsel+"&sortby="+sortby;
 
		}
        else if(vv=="order_ta")
		{                   
            var tot_from=$('#datepickerfromsales').val();
            var tot_to=$('#datepickertodtsales').val();
			var hidbydate=$('#bydatesales').val();
			var addon=$('#menu_type').val();		
			window.location="taexcel_download.php?type="+vv+"&fromdt="+tot_from+"&todt="+tot_to+"&bydate="+hidbydate+"&addon="+addon;							
		}
                
        else if(vv=="total_summary_details_ta")
		{                    
            var tot_from=$('#datepickerfromsales').val();
			var tot_to=$('#datepickertodtsales').val();
			var hidbydate=$('#bydatesales').val();

				window.location="taexcel_download.php?type="+vv+"&fromdt="+tot_from+"&todt="+tot_to+"&bydate="+hidbydate;
			
		}
                
                
        else if(vv=="categorywise_report_ta")
		{                 
            var tot_from=$('#datepickerfromsales').val();
			var tot_to=$('#datepickertodtsales').val();
			var hidbydate=$('#bydatesales').val();
			window.location="taexcel_download.php?type="+vv+"&fromdt="+tot_from+"&todt="+tot_to+"&bydate="+hidbydate;				
		}
                
        else if(vv=="summary_ta")
		{                  
            var tot_from=$('#datepickerfromsales').val();
			var tot_to=$('#datepickertodtsales').val();
			var hidbydate=$('#bydatesales').val();

				window.location="taexcel_download.php?type="+vv+"&fromdt="+tot_from+"&todt="+tot_to+"&bydate="+hidbydate;
				
		}
                
        else if(vv=="cancel_history_ta")
		{
        var staffsel = $('#loginstaffsel').val();
		var tot_from=$('#datepickerfromsales').val();
        var tot_to=$('#datepickertodtsales').val();
		var hidbydate=$('#bydatesales').val();;
			
		window.location="taexcel_download.php?type="+vv+"&fromdt="+tot_from+"&todt="+tot_to+"&bydate="+hidbydate+"&staffsel="+staffsel;
			
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
	
        if(vv=="tot_sales_ta")
            {
                vv=ofprint;
                var staffsel = $('#loginstaffsel').val();
                var tot_from=$('#datepickerfromsales').val();
                var tot_to=$('#datepickertodtsales').val();
                var hidbydate=$('#bydatesales').val();
                var a4paper=$('#hida4settings').val();
  
                                if(printera4=="N")
                                    {
                    			window.open("taprint_bill.php?type="+vv+"&fromdt="+tot_from+"&todt="+tot_to+"&bydate="+hidbydate+"&staffsel="+staffsel+"#print",'_blank');
                                    }
                                else
                                    {
                                        $.post("ta_print_report.php", {type:vv,hidfr:tot_from,hidto:tot_to,hidbydate:hidbydate,staffsel:staffsel},
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
          else if(vv=="tot_sale_online")
            {
                vv=ofprint;
                var staffsel = $('#loginstaffsel').val();
                var tot_from=$('#datepickerfromsales').val();
                var tot_to=$('#datepickertodtsales').val();
                var hidbydate=$('#bydatesales').val();
                var partner=$('#online_partner_id').val();
                var partner_mode=$('#online_partner_mode').val();
                var a4paper=$('#hida4settings').val();

                                if(printera4=="N")
                                    {
                    window.open("taprint_bill.php?type="+vv+"&fromdt="+tot_from+"&todt="+tot_to+"&bydate="+hidbydate+"&partner="+partner+"&partner_mode="+partner_mode+"&staffsel="+staffsel+"#print",'_blank');
                                    }
                                else
                                    {
                                        $.post("ta_print_report.php", {type:vv,hidfr:tot_from,hidto:tot_to,hidbydate:hidbydate,staffsel:staffsel,partner:partner,partner_mode:partner_mode},
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
        else if(vv=="billreport_ta")
            {
                vv=ofprint;
                var staffsel = $('#loginstaffsel').val();
                var tot_from=$('#datepickerfromsales').val();
                var tot_to=$('#datepickertodtsales').val();
                var hidbydate=$('#bydatesales').val();
                var sortby=$('#bill_sort').val();
                var a4paper=$('#hida4settings').val();

                                if(printera4=="N")
                                    {
                    window.open("taprint_bill.php?type="+vv+"&fromdt="+tot_from+"&todt="+tot_to+"&bydate="+hidbydate+"&staffsel="+staffsel+"&sortby="+sortby+"#print",'_blank');
                                    }                          
            }    
            else if(vv=="customers_ta")
            {
                vv=ofprint;
                var staffsel = $('#loginstaffsel').val();
                var tot_from=$('#datepickerfromsales').val();
                var tot_to=$('#datepickertodtsales').val();
                var hidbydate=$('#bydatesales').val();
                var sortby=$('#bill_sort').val();
                var a4paper=$('#hida4settings').val();
      		
                    if(printera4=="N")
                    {
                    window.open("taprint_bill.php?type="+vv+"&fromdt="+tot_from+"&todt="+tot_to+"&bydate="+hidbydate+"&staffsel="+staffsel+"&sortby="+sortby+"#print",'_blank');
                    }       
			
            }
        else if(vv=="total_summary_details_ta")
		{
                   
                   vv=ofprint;

			var tot_from=$('#datepickerfromsales').val();

                        var tot_to=$('#datepickertodtsales').val();

			var hidbydate=$('#bydatesales').val();
                       
                      
                       var a4paper=$('#hida4settings').val();

                                    if(printera4=="N"){
                   window.open("taprint_bill.php?type="+vv+"&fromdt="+tot_from+"&todt="+tot_to+"&bydate="+hidbydate+"#print",'_blank');
				
                                    }else{
                                        $.post("ta_print_report.php", {type:vv,hidfr:tot_from,hidto:tot_to,hidbydate:hidbydate,staffsel:staffsel},
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
                
                
                
                
        else if(vv=="summary_ta")
		{
           vv=ofprint;
			var tot_from=$('#datepickerfromsales').val();
            var tot_to=$('#datepickertodtsales').val();
			var hidbydate=$('#bydatesales').val();                 
            var a4paper=$('#hida4settings').val();
 
            if(printera4=="N"){
                window.open("taprint_bill.php?type="+vv+"&fromdt="+tot_from+"&todt="+tot_to+"&bydate="+hidbydate+"#print",'_blank');
				}else{
                $.post("ta_print_report.php", {type:vv,hidfr:tot_from,hidto:tot_to,hidbydate:hidbydate,staffsel:staffsel},
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
                
        else if(vv=="categorywise_report_ta")
		{
          vv=ofprint;
		  var tot_from=$('#datepickerfromsales').val();
    	  var tot_to=$('#datepickertodtsales').val();
		  var hidbydate=$('#bydatesales').val();
          var a4paper=$('#hida4settings').val();
      			
                    if(printera4=="N")
					{
					window.open("taprint_bill.php?type="+vv+"&fromdt="+tot_from+"&todt="+tot_to+"&bydate="+hidbydate+"#print",'_blank');				
                    }else
					{
                    $.post("ta_print_report.php", {type:vv,hidfr:tot_from,hidto:tot_to,hidbydate:hidbydate,staffsel:staffsel},
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
   
        else if(vv=="cancel_history_ta")
		{
        	vv=ofprint;
            var staffsel = $('#loginstaffsel').val();
			var tot_from=$('#datepickerfromsales').val();
            var tot_to=$('#datepickertodtsales').val();
			var hidbydate=$('#bydatesales').val();
			var a4paper=$('#hida4settings').val();
            
			if(printera4=="N")
			{
                window.open("taprint_bill.php?type="+vv+"&fromdt="+tot_from+"&todt="+tot_to+"&bydate="+hidbydate+"&staffsel="+staffsel+"#print",'_blank');
			}else
			{
                $.post("ta_print_report.php", {type:vv,hidfr:tot_from,hidto:tot_to,hidbydate:hidbydate,cncl:'cncl',loginstf:staffsel},
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
   
        else if(vv=="order_ta")
            {
            vv=ofprint;// datepickertodtord datepickerfromord
			var tot_from=$('#datepickerfromsales').val();
            var tot_to=$('#datepickertodtsales').val();
			var hidbydate=$('#bydatesales').val();
            var addon=$('#menu_type').val();
			
			if(printera4=="N")
					{
				window.open("taprint_bill.php?type="+vv+"&fromdt="+tot_from+"&todt="+tot_to+"&bydate="+hidbydate+"&addon="+addon+"#print",'_blank');
					}
			else				
					{
				$.post("ta_print_report.php", {type:vv,from:tot_from,to:tot_to,hidbydate:hidbydate,staffsel:staffsel,addon:addon},
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
	if(vv=="tot_sales_ta")
		{
			var tot_from=$('#datepickerfrom').val();
    		var tot_to=$('#datepickertodt').val();
			var hidbydate=$('#bydate').val();
        	var loginstaff=$('#userloginsel').val();
						
			window.location="tapdf_bill.php?type="+vv+"&from="+tot_from+"&to="+tot_to+"&hidbydate="+hidbydate;	
		
		}else if(vv=="discount_ta")
		{
			var tot_from=$('#datepickerfrom').val();
    		var tot_to=$('#datepickertodt').val();
		var hidbydate=$('#bydate').val();
			
					window.location="tapdf_bill.php?type="+vv+"&from="+tot_from+"&to="+tot_to+"&hidbydate="+hidbydate;

		}
                else if(vv=="type_pay_ta")
		{ 
			 var tot_from=$('#datepickerfromtyp').val();
			 var tot_to=$('#datepickertodttyp').val(); 
			 var typ=document.getElementById("typepay").value; 
			 var paybydate=document.getElementById("paybydate").value; 
			 
			 if(typ!="null")
			 {
						 window.location="tapdf_bill.php?type="+vv+"&from="+tot_from+"&to="+tot_to+"&types="+typ+"&hidpay="+paybydate;				
			
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
			 window.location="tapdf_bill.php?type="+vv+"&floorv="+florvl;
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
					 window.location="tapdf_bill.php?type="+vv+"&from="+tot_from+"&to="+tot_to+"&stwr="+stwr+"&hidstwbydate="+stewardbydate;			
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
			
			window.location="tapdf_bill.php?type="+vv+"&from="+tot_from+"&to="+tot_to+"&hidbydate="+hidbydate;
	
		}else if(vv=="portion_order")
		{
			var tot_from=$('#datepickerfromdtprtn').val();
			var tot_to=$('#datepickertodtprtn').val(); 
			var prtn=document.getElementById("portiontp").value; 
			var portionbydate=document.getElementById("portionbydate").value; 
					
			window.location="tapdf_bill.php?type="+vv+"&from="+tot_from+"&to="+tot_to+"&prtn="+prtn+"&hidportn="+portionbydate;			
		}
		else if(vv=="delivery_amt")
		{
			var tot_from=$('#datepickerfromdtamt').val();
			 var tot_to=$('#datepickertodtamt').val(); 
			 var stwr=document.getElementById("stewardamt").value; 
			  var stewardbydate=document.getElementById("amtbydate").value; 
			 if(stwr !="")
			 {		 
					 window.location="tapdf_bill.php?type="+vv+"&from="+tot_from+"&to="+tot_to+"&stwr="+stwr+"&hidstwbydate="+stewardbydate;
			 }
			 else
			 {
				('#reportload').empty();	
				$('#rptstatus').css("display", "block");
			  	var rptstcz=$('#rptstatus');
		        rptstcz.text('No records to export');	
	     		$("#rptstatus").delay(1000).fadeOut('slow');
			 }
			}	
}
</script>
</body>
</html>
