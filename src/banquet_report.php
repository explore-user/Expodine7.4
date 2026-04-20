<?php
include('includes/session.php');		
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
<title>Banquet</title>
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
    .reporte_min_hieght_1  tbody { display: block;min-height: inherit;overflow-y: scroll;max-height: 62vh}
    .reporte_min_hieght_1 thead,
tbody tr {  display: table; width: 99%; table-layout: fixed;}
.reporte_min_hieght  tbody { display: block;min-height: inherit;overflow-y: scroll;max-height: 62vh}
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
    
    $("#boxscroll2").niceScroll("#contentscroll2",{cursorcolor:"#F00",cursoropacitymax:0.7,boxzoom:true,touchbehavior:true});  // Second scrollable DIV
    $("#boxframe").niceScroll("#boxscroll3",{cursorcolor:"#0F0",cursoropacitymax:0.7,boxzoom:true,touchbehavior:true});  // This is an IFrame (iPad compatible)
	
    $("#boxscroll4").niceScroll("#boxscroll4 .wrapper",{boxzoom:true});  // hw acceleration enabled when using wrapper
    

$(document).ready(function () {

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

                    $.each($rows, function (index, row) {
                        $('tbody').append(row);
                        row.sortKey = null;
                    });

                    $('th').removeClass('sorted-asc sorted-desc');
                    var $sortHead = $('th').filter(':nth-child(' + (column + 1) + ')');
                    sortDirection == 1 ? $sortHead.addClass('sorted-asc') : $sortHead.addClass('sorted-desc');

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
    
  
$('#datepickerfrom').change(function () {
            var extra= $('#extra').val();
		$('#ui-datepicker-div').css("display", "none");
		var fromval=$(this).val();
                var tot_to=$('#datepickertodt').val();
                var typeval=$('#typeval').val();
                var tot_to=$('#datepickertodt').val(); 
                var bydate=$('#bydate').val();
                var banquet_type=$('#mode').val();
                var fun_type=$('#fun_type').val();
                var venue=$('#venue').val();
                 var mode=   $('#mode_pay').val(); 
                 
		$('#bydate').val("");
		if(tot_to=="")
		{ 
			tot_to="";
		}
		$.post("load_banquet_report.php", {fromdt:fromval,todt:tot_to,type:typeval,banquet_type:banquet_type,bydate:bydate,fun_type:fun_type,venue:venue,extra:extra,mode:mode},
			  function(data)
			  {  
					data=$.trim(data);
				        if(data!="")
					{
					data=$.trim(data);
					$('#reportload').html(data);
					}else
					{
					$('#reportload').empty();	
					$('#rptstatus').css("display", "block");
			                var rptstatus=$('#rptstatus');
			                rptstatus.text('No records to display');	
		                        $("#rptstatus").delay(1000).fadeOut('slow');
					}
			  });
		
	});
        
$('#datepickertodt').change(function () {
     var extra= $('#extra').val();
      var venue=$('#venue').val();
            var fun_type=$('#fun_type').val();
		$('#ui-datepicker-div').css("display", "none");
		var tot_to=$(this).val();
                var fromval=$('#datepickerfrom').val();
                var typeval=$('#typeval').val();
                var banquet_type=$('#mode').val();
                 var mode=   $('#mode_pay').val(); 
                
                
                $('#bydate').val("");
		if(fromval=="")
		{
			fromval="";
		}
		$.post("load_banquet_report.php", {fromdt:fromval,todt:tot_to,type:typeval,banquet_type:banquet_type,fun_type:fun_type,venue:venue,extra:extra,mode:mode},
                    function(data)
                        {
                            data=$.trim(data);
                            if(data!="")
                                {
                                    data=$.trim(data);
                                    $('#reportload').html(data);
				}
                                else
                                {
                                   $('#reportload').empty();	
                                   $('#rptstatus').css("display", "block");
                                   var rptstatus=$('#rptstatus');
                                   rptstatus.text('No records to display');	
                                   $("#rptstatus").delay(1000).fadeOut('slow');
				}
			});
		
		
		
		
	});
$('#department').change(function () {
     var extra= $('#extra').val();
      var venue=$('#venue').val();
               var fun_type=$('#fun_type').val();
		$('#ui-datepicker-div').css("display", "none");
		var banquet_type=$('#mode').val();
                var typeval=$('#typeval').val();
                var bydate=$('#bydate').val();
                var fromval=$('#datepickerfrom').val();
                var tot_to=$('#datepickertodt').val();
             var mode=   $('#mode_pay').val(); 
            
            
                $.post("load_banquet_report.php", {fromdt:fromval,todt:tot_to,type:typeval,bydate:bydate,banquet_type:banquet_type,fun_type:fun_type,venue:venue,extra:extra,mode:mode},
                    function(data)
                        { 
                            data=$.trim(data);
                            if(data!="")
                                {   
                                    data=$.trim(data);
                                    $('#reportload').html(data);
				}
                            else
                                {
                                    $('#reportload').empty();	
                                    $('#rptstatus').css("display", "block");
                                    var rptstatus=$('#rptstatus');
                                    rptstatus.text('No records to display');	
                                    $("#rptstatus").delay(1000).fadeOut('slow');
				}
			  });
		
            });


$('#function_type').change(function () {
     var extra= $('#extra').val();
      var venue=$('#venue').val();
               var fun_type=$('#fun_type').val();
		$('#ui-datepicker-div').css("display", "none");
		var banquet_type=$('#mode').val();
                var typeval=$('#typeval').val();
                var bydate=$('#bydate').val();
                var fromval=$('#datepickerfrom').val();
                var tot_to=$('#datepickertodt').val();
               var mode=   $('#mode_pay').val(); 
               
                $.post("load_banquet_report.php", {fromdt:fromval,todt:tot_to,type:typeval,bydate:bydate,banquet_type:banquet_type,fun_type:fun_type,venue:venue,extra:extra,mode:mode},
                    function(data)
                        { 
                            data=$.trim(data);
                            if(data!="")
                                {   
                                    data=$.trim(data);
                                    $('#reportload').html(data);
				}
                            else
                                {
                                    $('#reportload').empty();	
                                    $('#rptstatus').css("display", "block");
                                    var rptstatus=$('#rptstatus');
                                    rptstatus.text('No records to display');	
                                    $("#rptstatus").delay(1000).fadeOut('slow');
				}
			  });
		
            });
 
 
 $('#extra_type').change(function () {
     
                var venue=$('#venue').val();
                var fun_type=$('#fun_type').val();
		$('#ui-datepicker-div').css("display", "none");
		var banquet_type=$('#mode').val();
                var typeval=$('#typeval').val();
                var bydate=$('#bydate').val();
                var fromval=$('#datepickerfrom').val();
                var tot_to=$('#datepickertodt').val();
                var extra= $('#extra').val();
          var mode=   $('#mode_pay').val(); 
          
                $.post("load_banquet_report.php", {fromdt:fromval,todt:tot_to,type:typeval,bydate:bydate,banquet_type:banquet_type,fun_type:fun_type,venue:venue,extra:extra,mode:mode},
                    function(data)
                        { 
                            data=$.trim(data);
                            if(data!="")
                                {   
                                    data=$.trim(data);
                                    $('#reportload').html(data);
				}
                            else
                                {
                                    $('#reportload').empty();	
                                    $('#rptstatus').css("display", "block");
                                    var rptstatus=$('#rptstatus');
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


$('#venue_type').change(function () {
                var extra= $('#extra').val();
                var venue=$('#venue').val();
                var fun_type=$('#fun_type').val();
		$('#ui-datepicker-div').css("display", "none");
		var banquet_type=$('#mode').val();
                var typeval=$('#typeval').val();
                var bydate=$('#bydate').val();
                var fromval=$('#datepickerfrom').val();
                var tot_to=$('#datepickertodt').val();
              var mode=   $('#mode_pay').val(); 
              
                $.post("load_banquet_report.php", {fromdt:fromval,todt:tot_to,type:typeval,bydate:bydate,banquet_type:banquet_type,fun_type:fun_type,venue:venue,extra:extra,mode:mode},
                    function(data)
                        { 
                            data=$.trim(data);
                            if(data!="")
                                {   
                                    data=$.trim(data);
                                    $('#reportload').html(data);
				}
                            else
                                {
                                    $('#reportload').empty();	
                                    $('#rptstatus').css("display", "block");
                                    var rptstatus=$('#rptstatus');
                                    rptstatus.text('No records to display');	
                                    $("#rptstatus").delay(1000).fadeOut('slow');
				}
			  });
		
            });
	
$('#bydate').change(function () {
     var extra= $('#extra').val();
      var venue=$('#venue').val();
                var fun_type=$('#fun_type').val();
		var bydate=$(this).val();
                $('#datepickerfrom').val("");
                $('#datepickertodt').val("");
		var typeval=$('#typeval').val();
		var fromval=$('#datepickerfrom').val();
                var tot_to=$('#datepickertodt').val();
		var banquet_type=$('#mode').val();
                 var mode=   $('#mode_pay').val(); 
                 
		$.post("load_banquet_report.php", {fromdt:fromval,todt:tot_to,type:typeval,bydate:bydate,banquet_type:banquet_type,fun_type:fun_type,venue:venue,extra:extra,mode:mode},
			  function(data)
			  { 
                              
					data=$.trim(data);
					if(data!="")
					{
					
					data=$.trim(data);
					$('#reportload').html(data);
					
					}else
					{
					
					$('#reportload').empty();	
					$('#rptstatus').css("display", "block");
			                var reptstatus=$('#rptstatus');
		                        reptstatus.text('No records to display');	
		                        $("#rptstatus").delay(1000).fadeOut('slow');
						
					}
			  });
	});



$('#mode_pay').change(function () {
     var extra= $('#extra').val();
      var venue=$('#venue').val();
                var fun_type=$('#fun_type').val();
		var bydate=$('#bydate').val();
                $('#datepickerfrom').val("");
                $('#datepickertodt').val("");
		var typeval=$('#typeval').val();
		var fromval=$('#datepickerfrom').val();
                var tot_to=$('#datepickertodt').val();
		var banquet_type=$('#mode').val();
                 var mode=   $('#mode_pay').val(); 
                
		$.post("load_banquet_report.php", {fromdt:fromval,todt:tot_to,type:typeval,bydate:bydate,banquet_type:banquet_type,fun_type:fun_type,venue:venue,extra:extra,mode:mode},
			  function(data)
			  { 
                              
					data=$.trim(data);
					if(data!="")
					{
					
					data=$.trim(data);
					$('#reportload').html(data);
					
					}else
					{
					
					$('#reportload').empty();	
					$('#rptstatus').css("display", "block");
			                var reptstatus=$('#rptstatus');
		                        reptstatus.text('No records to display');	
		                        $("#rptstatus").delay(1000).fadeOut('slow');
						
					}
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
						
 <div  class="sitemap_cc">Banquet Reports</div>
  <div id="container">  
<div class="col-md-12 main_contant_container nopaddding">
    <div class="col-lg-12 col-md-12 report_main_cc" style="padding-top:10px; background-color:rgb(208, 208, 208);">
        <div class="col-lg-12 col-md-12 nopadding" style="background-color:#FCFCFC;  ">
            <div class="header_main_container" style="overflow: visible">
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
                                             <option>Select Report</option>
                                           <?php  
                                         $sql_login  =  $database->mysqlQuery("select rm_reportid,rm_printa4,rm_posprintofanother,rm_reportname from tbl_reportmaster where rm_reportview='Y' and rm_reporttype='BQ'"); 
                                        $num_login   = $database->mysqlNumRows($sql_login);
                                        if($num_login){
                                            while($result_login  = $database->mysqlFetchArray($sql_login)) 
                                              { 
											  
											  ?>
                                      		  <option value="<?=$result_login['rm_reportid']?>" printtype="<?=$result_login['rm_printa4']?>" printername="" printof="<?=$result_login['rm_posprintofanother']?>"><?=$result_login['rm_reportname']?></option>
                                        <?php } }?>
                                          
                                         </select>    
                                  </div>
                            </div>
                            <!-- type ends -->
                            
                            
                             <div id="mode_pay_div" style="display:none" >
                                <div class="search_name_box_main" style="width:10%">
                                <div class="text-selection_name">Pay Mode</div>
                                   <div class="input-group" style="width: 55%;">
                                         <select  class="form-control add_new_dropdown_report" onChange="reportcreate(this.value)" name="mode_pay" id="mode_pay">
                                                 <option value="all">ALL</option>
                                                 <option value="Cash">CASH</option>
                                                 <option value="Credit">CARD</option>
                                                 
                                         </select>    
                                  </div>
                                  </div>
                            </div>
                            
                            
                            
                            
                            <div id="department" style="display:none" >
                                <div class="search_name_box_main" style="width:10%">
                                <div class="text-selection_name">Mode</div>
                                   <div class="input-group" style="width: 55%;">
                                         <select  class="form-control add_new_dropdown_report" onChange="reportcreate(this.value)" name="mode" id="mode">
                                                 <option value="">All</option>
                                                 <?php
                                                 $sql_bnqttype  =  $database->mysqlQuery("select distinct(fd_reg_type) from tbl_function_details "); 
                                                $num_bnqttype   = $database->mysqlNumRows($sql_bnqttype);
                                                if($num_bnqttype){
                                                    while($result_bnqttype  = $database->mysqlFetchArray($sql_bnqttype)) 
                                                      { 
                                                    ?>
                                                          <option value="<?=$result_bnqttype['fd_reg_type']?>"><?=$result_bnqttype['fd_reg_type']?></option>
                                                <?php } } ?>
                                                 
                                                 
                                                 
                                         </select>    
                                  </div>
                            </div>
                            </div>
                            
                            <div id="function_type" style="display:none" >
                             <div class="search_name_box_main">
                                <div class="text-selection_name">Function Type</div>
                                   <div class="input-group" style="width: 55%;">
                                         <select  class="form-control add_new_dropdown_report" onChange="reportcreate(this.value)" name="fun_type" id="fun_type">
                                                 <option value="">All</option>
                                                 <?php
                                                 $sql_bnqttype  =  $database->mysqlQuery("select distinct(fd_function_type),ft_name from tbl_function_details tfd left join tbl_function_type tft on tft.ft_id=tfd.fd_function_type "); 
                                                $num_bnqttype   = $database->mysqlNumRows($sql_bnqttype);
                                                if($num_bnqttype){
                                                    while($result_bnqttype  = $database->mysqlFetchArray($sql_bnqttype)) 
                                                      { 
                                                    ?>
                                                          <option value="<?=$result_bnqttype['fd_function_type']?>"><?=$result_bnqttype['ft_name']?></option>
                                                <?php } }?>
                                                  
                                         </select>    
                                  </div>
                            </div>
                            </div>
                            <div id="venue_type" style="display:none" >
                             <div class="search_name_box_main">
                                <div class="text-selection_name">Venue</div>
                                   <div class="input-group" style="width: 55%;">
                                         <select  class="form-control add_new_dropdown_report" onChange="reportcreate(this.value)" name="venue" id="venue">
                                                 <option value="">All</option>
                                                 <?php
                                                 $sql_bnqttype  =  $database->mysqlQuery("select distinct(fd_venue),fv_name from tbl_function_details tfd left join tbl_function_venue tft on tft.fv_id=tfd.fd_venue "); 
                                                $num_bnqttype   = $database->mysqlNumRows($sql_bnqttype);
                                                if($num_bnqttype){
                                                    while($result_bnqttype  = $database->mysqlFetchArray($sql_bnqttype)) 
                                                      { 
                                                    ?>
                                                          <option value="<?=$result_bnqttype['fd_venue']?>"><?=$result_bnqttype['fv_name']?></option>
                                                <?php } }?>
                                                 
                                                 
                                                 
                                         </select>    
                                  </div>
                            </div>
                            </div>
                            
                            
                            <div id="extra_type" style="display:none" >
                                <div class="search_name_box_main" style="margin-right: 1%">
                                <div class="text-selection_name">Extra Type</div>
                                   <div class="input-group" style="width: 55%;">
                                       <select  multiple="multiple" class="form-control add_new_dropdown_report multi_sel_report" onChange="reportcreate(this.value)" name="extra" id="extra">
                                              
                                                 <?php
                                                 $sql_bnqttype  =  $database->mysqlQuery("select * from  tbl_function_extra_costs "); 
                                                $num_bnqttype   = $database->mysqlNumRows($sql_bnqttype);
                                                if($num_bnqttype){
                                                    while($result_bnqttype  = $database->mysqlFetchArray($sql_bnqttype)) 
                                                      { 
                                                    ?>
                                                          <option value="<?=$result_bnqttype['fec_id']?>"><?=$result_bnqttype['fec_name']?></option>
                                                <?php } }?>
                                                  
                                         </select>    
                                  </div>
                            </div>
                            </div>
                            
                            <!-- date starts --> 
                           
                            
                           
                          
                            <div id="totalsalesdiv" style="display:none" >
                                 
                                
                                
                                 <div class="search_name_box_main" id="datepickerfromdiv" style="display:block;width: 80px">
                                    <div class="text-selection_name">Date From:</div>
                                    <div class="input-group" >
                                         <input type="text" class="form-control" id="datepickerfrom" >     
                                    </div>
                                 </div>
                                 
                                 <div class="search_name_box_main" id="datepickertodtdiv" style="display:block;width: 80px">
                                    <div class="text-selection_name">Date To  :</div>
                                     <div class="input-group">
                                         <input type="text" class="form-control" id="datepickertodt" >            
                                    </div>
                                 </div>
                                 
                 <div class="search_name_box_main" id="bydatediv" style="display:block">
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
                                 <option value="Last365days">Last 1 year</option>
                    </select>
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

		<script src="mn/js/mlpushmenu.js"></script>
		<script>
			new mlPushMenu( document.getElementById( 'mp-menu' ), document.getElementById( 'trigger' ), {
				type : 'cover'
			} );
		</script>

<script>
    
    $(document).ready(function() {
	$('.multi_sel_report').multiselect({
          
	});
	
});
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

function reportcreate(rpt)
{
	var repttype=rpt;
	if(repttype=="banquet_sales_report")
            {   
                $('#mode_pay_div').css("display", "block");
		$('#totalsalesdiv').css("display", "block");
                $('#bydatediv').css("display", "block");
                $('#datepickerfromdiv').css("display", "block");
                $('#datepickertodtdiv').css("display", "block");
                $('#prnt').css("display","block");
                $('#department').css("display", "block");
                $('#function_type').css("display", "block");
                 $('#venue_type').css("display", "block");
                 $('#extra_type').css("display", "none");
                clearall();
                var tot_to=$('#datepickertodt').val(); 
                var fromval=$('#datepickerfrom').val();
                var bydate=$('#bydate').val();
                var banquet_type=$('#department').val();
		var fun_type=$('#function_type').val();
                var venue=   $('#venue_type').val();     
                 var mode=   $('#mode_pay').val(); 
                 
                    $.post("load_banquet_report.php", {type:repttype,fromdt:fromval,todt:tot_to,banquet_type:banquet_type,bydate:bydate,fun_type:fun_type,venue:venue,extra:extra,mode:mode},
                    function(data)
                        {    data=$.trim(data);
                            //(data);
                            if(data!="")
                                {
                                    data=$.trim(data);
                                    $('#reportload').html(data);
                                }
                            else
                                {
				$('#reportload').empty();	
				$('#rptstatus').css("display", "block");
			        var rptstatus20=$('#rptstatus');
                                // alert(rptstatus);
                                rptstatus20.text('No records to display');	
                                $("#rptstatus").delay(1000).fadeOut('slow');
                                }
		  		
                            });
            }else if(repttype=="banquet_extracost_report")
            {   
                
		$('#totalsalesdiv').css("display", "block");
                $('#bydatediv').css("display", "block");
                $('#datepickerfromdiv').css("display", "block");
                $('#datepickertodtdiv').css("display", "block");
                $('#prnt').css("display","block");
                $('#department').css("display", "block");
                $('#function_type').css("display", "none");
                 $('#venue_type').css("display", "none");
               $('#extra_type').css("display", "block");
               
                clearall();
                var tot_to=$('#datepickertodt').val(); 
                var fromval=$('#datepickerfrom').val();
                var bydate=$('#bydate').val();
                var banquet_type=$('#department').val();
		var fun_type=$('#function_type').val();
                var venue=   $('#venue_type').val();   
                
                var extra= $('#extra').val();
               
                    $.post("load_banquet_report.php", {type:repttype,fromdt:fromval,todt:tot_to,banquet_type:banquet_type,bydate:bydate,fun_type:fun_type,venue:venue,extra:extra},
                    function(data)
                        {    data=$.trim(data);
                            //(data);
                            if(data!="")
                                {
                                    data=$.trim(data);
                                    $('#reportload').html(data);
                                }
                            else
                                {
				$('#reportload').empty();	
				$('#rptstatus').css("display", "block");
			        var rptstatus20=$('#rptstatus');
                                // alert(rptstatus);
                                rptstatus20.text('No records to display');	
                                $("#rptstatus").delay(1000).fadeOut('slow');
                                }
		  		
                            });
            }
}

function movetoexcelForm()
{
    var check = confirm("Confirm to download Excel Sheet?");
    if(check==true)
            {
		var vv=document.getElementById("typeval").value;
		if(vv=="banquet_sales_report")
                    {
                var tot_to=$('#datepickertodt').val(); 
                var fromval=$('#datepickerfrom').val();
                var bydate=$('#bydate').val();
                var banquet_type=$('#mode').val();
		var fun_type=$('#fun_type').val();
                var venue=   $('#venue').val();   
                   var mode= $('#mode_pay').val();  
                   
		window.location="banquet_excel_download.php?type="+vv+"&fromdt="+fromval+"&todt="+tot_to+"&bydate="+bydate+"&banquet_type="+banquet_type+"&venue="+venue+"&fun_type="+fun_type+"&mode="+mode;
		
            }else if(vv=="banquet_extracost_report")
                    {
                var tot_to=$('#datepickertodt').val(); 
                var fromval=$('#datepickerfrom').val();
                var bydate=$('#bydate').val();
                var banquet_type=$('#mode').val();
		var fun_type=$('#fun_type').val();
                var venue=   $('#venue').val();   
                  var extra= $('#extra').val();  
		window.location="banquet_excel_download.php?type="+vv+"&fromdt="+fromval+"&todt="+tot_to+"&bydate="+bydate+"&banquet_type="+banquet_type+"&venue="+venue+"&fun_type="+fun_type+"&extra="+extra;
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
    
        if(vv=="banquet_sales_report")
	     {
            vv=ofprint;
            var a4paper=$('#hida4settings').val();
            var tot_to=$('#datepickertodt').val(); 
            var fromval=$('#datepickerfrom').val();
            var bydate=$('#bydate').val();
            var banquet_type=$('#mode').val();
	    var fun_type=$('#fun_type').val();
            var venue=   $('#venue').val();   
              var mode= $('#mode_pay').val();  
            if(printera4=="N")
                                {
                                 window.open("banquet_a4print.php?type="+vv+"&fromdt="+fromval+"&todt="+tot_to+"&bydate="+bydate+"&banquet_type="+banquet_type+"&venue="+venue+"&mode="+mode+"&fun_type="+fun_type+"#print",'_blank');
				}
                            else
                                {
                                 alert('Enable A4 Print');
                                }
    }else if(vv=='banquet_extracost_report'){
        
        
            vv=ofprint;
            var a4paper=$('#hida4settings').val();
            var tot_to=$('#datepickertodt').val(); 
            var fromval=$('#datepickerfrom').val();
            var bydate=$('#bydate').val();
            var banquet_type=$('#mode').val();
	    var fun_type=$('#fun_type').val();
            var venue=   $('#venue').val();   
              var extra= $('#extra').val();
         
            if(printera4=="N")
                                {
                                 window.open("banquet_a4print.php?type="+vv+"&fromdt="+fromval+"&todt="+tot_to+"&bydate="+bydate+"&banquet_type="+banquet_type+"&venue="+venue+"&fun_type="+fun_type+"&extra="+extra+"#print",'_blank');
				}
                            else
                                {
                                 alert('Enable A4 Print');
                                }
                        }
          
}

</script>

</body>
</html>
