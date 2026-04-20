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


  
<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" data-ng-app="tutorialWebApp"> <!--<![endif]-->

<head>

    <title> Report</title>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Our Website CSS Styles -->
    
    <link rel="stylesheet" href="css/main_report.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/cssCharts.css">
<script src="js/jquery-2.1.3.min.js"></script>
</head>
<body>
<!--[if lt IE 7]>
<![endif]-->

<!-- Our Website Content Goes Here -->
    <div class="ng-scope">
<div class="toggle-content">
    <div class="panel-setting">
        <div class="row">
            <div class="col-md-12 column">
                <div class="custom-text">
                   <div class="left_btm_line_graph_cc">
                        <h2 class="line_chart_head">Chart</h2>
                        <div class="chart dotted" style="width:80% !important;margin-left:14%;">
                          <ul data-cord="[0,90,120,160,200,262,280,340,380,420,460],[40,150,40,90,40,60,120,20,60,90,10]" class="line-chart"></ul>
                        </div>
                    </div><!--left_btm_line_graph_cc-->
                    <div class="left_btm_line_graph_cc">
                        <h2 class="line_chart_head">Chart</h2>
                        <div class="chart" style="float:left;">
          <div class="pie-thychart" data-set='[["people", 20], ["countries",30], ["developers",60], ["New",60] ]' data-colors="#FBE4DB,#F17F49,#BD380F,#6b0101"></div>
        </div>
                    </div><!--left_btm_line_graph_cc-->
                </div>
            </div>
           
        </div>
    </div>
    <span class="fa fa-close"><img src="images/black_cross.png"></span>
</div><!-- Toggle Content -->
<div class="top-bar">
    <div class="logo">
    <div class="menu-options"><span class="menu-action"><i></i></span></div>
        <a href="#/" title=""><i style="margin-right:0" class="fa fa-deviantart"></i><img style="width: 135px;" src="images/logo20.png"></a>
    </div>
  
<div class="quick-links">
        <ul>
            <li>
                <a style="color:#000" class="show-stats red-skin"><img width="25px" src="images/graph.png"></a>
                <span style="position: relative;left: 7px;top: 6px;color:#d8d8d8;"> Graph</span>
            </li>
        </ul>
    </div>   
</div><!-- Top Bar -->
<header class="side-header light-skin opened-menu">
    <div class="admin-details">
        <!--<span><img src="images/logo_layality.png" alt="" /></span>-->
        <h3>Report Main Categories <!--<img style="width: 11px;" src="images/btm-arrrow.png">--></h3>
        <!--<i>Reports</i>-->
        
    </div>
    <div class="menu-scroll">
        <div class="side-menus">
            <nav>
                 
                <ul>
                     <?php
                       $sql_login  =  $database->mysqlQuery("select * from tbl_report_main_category "); 
	               $num_login   = $database->mysqlNumRows($sql_login);
	               if($num_login){
		          while($result_login  = $database->mysqlFetchArray($sql_login)) 
		        {
                              $id=$result_login['rmc_id'];
                        ?>
                    <li class="menu-item-has-children">
                        <a href="#" title=""><i class="fa fa-dashboard"></i> <span><?=$result_login['rmc_catgeory_name']?></span></a>
                         
                        <ul id="typeofreport" class="form-control1">
                         
                            <?php
                       $sql_wholelist  =  $database->mysqlQuery("select * from tbl_reportmaster Where rm_report_main_cat=$id and rm_reportview='Y' and rm_reporttype='DI'"); 
	               $num_wholelist   = $database->mysqlNumRows($sql_wholelist);
	               if($num_wholelist){
		          while($result_wholelist  = $database->mysqlFetchArray($sql_wholelist)) 
		        {
                           $dreporttype= $result_wholelist['rm_reporttype'];
                           
                              ?>
                        <li><a href="#" title="<?=$result_wholelist['rm_reportid']?>" ><i class="fa fa-circle-o-notch"></i><span><?=$result_wholelist['rm_reportname']?></span></a></li>
                         <?php } } ?> 
                        </ul>
                </li>
                     <?php } } ?>
                </ul>
               
            </nav>
        </div>
    </div><!-- Menu Scroll -->
</header>

 <?php
                       $sql_wholelist  =  $database->mysqlQuery("select * from tbl_reportmaster Where rm_report_main_cat=$id and rm_reportview='Y' and rm_reporttype='CS'"); 
	               $num_wholelist   = $database->mysqlNumRows($sql_wholelist);
	               if($num_wholelist){
		          while($result_wholelist  = $database->mysqlFetchArray($sql_wholelist)) 
		        {
                           $creporttype= $result_wholelist['rm_reporttype'];
                              
}}?>
 <?php
                       $sql_wholelist  =  $database->mysqlQuery("select * from tbl_reportmaster Where rm_report_main_cat=$id and rm_reportview='Y' and rm_reporttype='TA'"); 
	               $num_wholelist   = $database->mysqlNumRows($sql_wholelist);
	               if($num_wholelist){
		          while($result_wholelist  = $database->mysqlFetchArray($sql_wholelist)) 
		        {
                           $treporttype= $result_wholelist['rm_reporttype'];
                              
}}?>
  
</div> 



<div class="main-content ng-scope" data-ng-view="">
 
<!--<div class="breadcrumbs ng-scope">
	<ul>
		<li><a  title="">Dine in - Total Sales</a></li>
	</ul>
</div>--><!--breadcrumbs-->

<div class="report_contant_area">

	<div class="date_base_filter_cc" style="padding-top:3px;">  
        <div class="filter_by_date_textbox_cc seprate_brd">
       <div class="filter_date_textbox_name">Order From</div>
            <div style="width: 62%;" class="filter_date_textbox_input">
        	<select>
                <option value="All">All</option>
                <option value="<?=$dreporttype?>">Dine-In</option>
                <option value="<?=$creporttype?>">Counter</option>
                <option value="<?=$treporttype?>">TA/HD</option>
            </select>
            </div>
        </div><!---filter_by_date_textbox_cc-->
       
        
    </div><!--filter_by_date_textbox_cc-->
    
<!--    <div class="date_base_filter_cc" style="height:40px;padding-top: 3px;">-->
        
        
        
        
    	
      
        <div class="" id="loadfields" >
        <div class="date_base_filter_head">Select by Date</div>
                            
        </div>
       
<!--        <div class="filter_date_textbox_cc"> 
        	<div class="filter_date_textbox_one">
            	<div class="filter_date_textbox_name">From</div>
                <div class="filter_date_textbox_input"><input name="" type="text" id="datepickerfrom"></div>
            </div>
            <div class="filter_date_textbox_one">
            	<div class="filter_date_textbox_name">To</div>
                <div class="filter_date_textbox_input"><input name="" id="datepickerto" type="text"></div>
                <span style="line-height:30px;float: right;width: 3%;"><strong>OR</strong></span>
            </div>
           
        </div>-->
        <!--filter_date_textbox_cc-->
        
<!--        <div class="filter_by_date_textbox_cc">
        <div class="filter_date_textbox_name">By Date</div>
            <div style="width: 64%;" class="filter_date_textbox_input">
        	<select>
            	<option value="Today">Today</option>
                <option value="Yesterday">Yesterday</option>
                <option value="Last5days">Last 5 days</option>
                <option value="Last5days">Last 5 months</option>
            </select>
            </div>
        </div>-->
        <!--filter_by_date_textbox_cc-->
<!--        <a href="#" class="reportsubmit"><div class="filter_sub_btn_cc">Submit</div></a>
        -->
<!--    </div>-->
    <!--filter_by_date_textbox_cc-->
    
    
    <div class="col-lg-12 col-md-12 user_detail_min_hieght reporte_min_hieght_1" style="background-color:#FCFCFC;  border-bottom: 1px solid #BDBDBD;  " id="reportload">
               
                                <!--  report content-->
            </div>
    
    
<!--    <div class="report_new_contant">
    	<table class="report_new_contant_table" width="100%" border="0">
           <thead>
              <tr>
                <th scope="col">Head</th>
                <th scope="col">Head 1</th>
                <th scope="col">Head 2</th>
                <th scope="col">Head 3</th>
                <th scope="col">Head 4</th>
              </tr>
            </thead>  
            <tbody>  
              <tr>
                <td>1</td>
                <td>2</td>
                <td>3</td>
                <td>4</td>
                <td>5</td>
              </tr>

             
             </tbody> 
        </table>

    </div>-->

</div>



</div><!--md-contant-->




<div  class="ng-scope"><footer class="ng-scope">
    <div class="container">
        <p style="line-height: 34px;padding-left: 35.5%;">Powered by Software </p>
        <ul>
        	<span>
            <p class="report_export_to_txt">Export to</p>
            <select class="export_select_drop">
            	<option>PDF</option>
                <option>Excel</option>
                <option>Excel</option>
            </select>
            </span>
            <a id="excel"><div class="export_select_drop_go_btn">GO</div></a>
        	<!--<li><a href="#/" title="">Export to PDF</a></li>-->
                <li><a title="" id="prnt" target="_blank">Print</a></li>
        </ul>
    </div>
</footer>
</div><!--footer--->



<!-- Vendor: Javascripts -->
<script type="text/javascript">
    $(document).ready(function(){
    
    "use strict";
    //***** Side Menu *****//
      $(".side-menus li.menu-item-has-children > a").on("click",function(){
          $(this).parent().siblings().children("ul").slideUp();
          $(this).parent().siblings().removeClass("active");
          $(this).parent().children("ul").slideToggle();
          $(this).parent().toggleClass("active");
          return false;
      });

      //***** Side Menu Option *****//
      $('.menu-options').on("click", function(){
        $(".side-header.opened-menu").toggleClass('slide-menu');
        $(".main-content").toggleClass('wide-content');
        $("footer").toggleClass('wide-footer');
        $(".menu-options").toggleClass('active');
      });

    /*** FIXED Menu APPEARS ON SCROLL DOWN ***/   
    $(window).scroll(function() {    
        var scroll = $(window).scrollTop();
        if (scroll >= 10) {
        $(".side-header").addClass("sticky");
        }
        else{
        $(".side-header").removeClass("sticky");
        $(".side-header").addClass("");
        }
    }); 

    $(".side-menus nav > ul > li ul li > a").on("click", function(){
        $(".side-header").removeClass("slide-menu");
        $(".menu-options").removeClass("active");
    });

      //***** Quick Stats *****//
      $('.show-stats').on("click", function(){
        $(".toggle-content").addClass('active');
      });
     
       //***** Quick Stats *****//
      $('.toggle-content > span').on("click", function(){
        $(".toggle-content").removeClass('active');
      });

      //***** Quick Stats *****//
      $('.quick-links > ul > li > a').on("click", function(){
        $(this).parent().siblings().find('.dialouge').fadeOut();
        $(this).next('.dialouge').fadeIn();
        return false;
      });

     
      //***** Side Menu *****//
      $(function(){
          $('.side-menus').slimScroll({
              height: '400px',
              wheelStep: 10,
              size: '2px'
          });
      });


      $(".data-attributes span").peity("donut");
	 
});

</script>

 <script src="js/jquery-ui.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/app.js"></script>
<script src="js/jquery.chart.js"></script>
 <script>
        $(function() {
            $('.bar-chart').cssCharts({type:"bar"});
            $('.donut-chart').cssCharts({type:"donut"}).trigger('show-donut-chart');
            $('.line-chart').cssCharts({type:"line"});

            $('.pie-thychart').cssCharts({type:"pie"});
        });
      </script>
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

	  $("#typeofreport li a").click(function(){
                 // alert("a");
		  var reporttype=$(this).attr('title');//loadfields
//                  alert(reporttype);
		  var dataString;
		  dataString="checkvalue=fielddefine&reportid="+reporttype;
                  //alert(dataString);
		  var request=  $.ajax({
			type: "POST",
			url: "load_newreports.php",
			data: dataString,
			success: function(data) {
					$('#loadfields').html(data);
//					var vars = [];
//					var IDs = [];
//						IDs.push('typeofreport'); 
//						vars.push(reporttype); 
//					var dataString;
//					dataString="checkvalue=loadreportdata&type=html&ids="+IDs+"&values="+vars;
                                       // alert(dataString);
//					var request=  $.ajax({
//					  type: "POST",
//					  url: "load_newreports.php",
//					  data: dataString,
//					  success: function(data) {
//                                              //alert(data);
//							  $('#reportload').html(data);
//							  
//						  }
//					  });
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
//	  
	 });
		$('#prnt').click(function (){
			var vars = [];
			var IDs = [];
			$(".form-control1").each(function(){ 
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
			$(".form-control1").each(function(){ 
				IDs.push(this.id); 
				vars.push($('#'+this.id).val()); 
			});
			//alert(IDs)
			//alert(vars)
			window.location="load_newreports.php?checkvalue=loadreportdata&type=excel&ids="+IDs+"&values="+vars;
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

<!--<script >
$(document).ready(function() {
   var pageHeight = $("body").height();
   pageHeight -= 80; // Whatever the height of your footer is. Make sure to subtract that out
   $(".report_new_contant_table tbody").css("min-height", pageHeight + "px");
});

</script>-->
<style>
.sheet0 td	{border-bottom: solid 1px #d4d4d4 !important;border-top: solid 0px #dcdcdc !important;border-left:none !important; border-right:none !important;vertical-align: middle;}
.row3 td{border: none !important;}
td.style10{border: none !important;}

</style>


</body>

</html>