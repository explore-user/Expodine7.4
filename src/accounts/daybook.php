<?php
// include('includes/session.php');		
session_start();
include("../database.class.php"); 
$database	= new Database();


?>
<!doctype html>
<html ng-app="website">
<head>
<meta charset="utf-8">
<title>Daybook</title>
<meta name="description" content="">
<link href="../images/favicon.png" rel="shortcut icon">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<link rel="shortcut icon" href="img/favicon.ico">
<link rel="stylesheet" href="../master_style/themify-icons.css" type="text/css" /><!-- Icons -->
<link href="../css/menu_master_style.css" rel="stylesheet">
<link id="bs-css" href="../css/bootstrap-cerulean.min.css" rel="stylesheet">
<link rel="stylesheet" href="../master_style/website.css" type="text/css">
<link rel="stylesheet" href="../master_style/responsive.css" type="text/css" /><!-- Responsive -->	
<link rel="stylesheet" href="../css/normal.css" type="text/css" /><!-- Responsive -->
<link rel="stylesheet" href="../master_style/demo.css">	
<link rel="stylesheet" href="../master_style/table_style.css">	
<link rel="stylesheet" type="text/css" href="../master_style/default.css" />
<link rel="stylesheet" type="text/css" href="../master_style/component.css" />
<link rel="stylesheet" type="text/css" href="../master_style/popup/default.css" />
<link rel="stylesheet" type="text/css" href="../master_style/popup/component.css" />
 <link href="../master_style/app.css" rel="stylesheet" type="text/css">
 <link rel="stylesheet" type="text/css" media="screen" href="../css/als_demo.css" />
 <link href="../loyalty/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
 <script src="../js/jquery-1.10.2.min.js"></script>
<script src="../master_style/js/modernizr.custom.js"></script>
<style>#ascrail2002{z-index: 9999999999999999999 !important;left:2px !important } 
.ui-autocomplete{z-index:999999 !important;}.upload_view_img{bottom: 42px;float: right;height: 66px;position: relative;}
	.table_report thead th{height:25px;}.tablesorter tbody{height: 79vh !important;}
</style>
<script type="text/javascript" src="../js/jquery-ui-1.8.2.custom.min.js"></script> 
<script src="../js/jquery-1.10.2.js"></script>
<script type="text/javascript">
    //calender//
            $(document).ready(function () {
                
       var date_from=$('#date_day').val();   
       var type=$('#type_acc').val();   
       var date_to=$('#date_day_to').val();   
      
       
       var datastringnewcard="set=list_day_book&fromdt="+date_from+"&type="+type+"&todt="+date_to;
      // alert(datastringnewcard);
        $.ajax({
        type: "POST",
        url: "load_accounts_data.php",
        data: datastringnewcard,
        success: function(data)
        {      
             
            $('#load_journal_detail').html(data);   
        }
       });     
     
      
      
           $(".dt_gr").datepicker({
               changeMonth: true,
               changeYear: true,
               format: 'yyyy-mm-dd',
                endDate: '+0d',
               autoclose: true
           });
           
           $("#date_day").datepicker({
               changeMonth: true,
               changeYear: true,
               format: 'yyyy-mm-dd',
                endDate: '+0d',
               autoclose: true
           });
           
        });          
      
      
      function datechange(){
      
       var date_from=$('#date_day').val();   
       var type=$('#type_acc').val();   
       var date_to=$('#date_day_to').val();   
      
       
       var datastringnewcard="set=list_day_book&fromdt="+date_from+"&type="+type+"&todt="+date_to;
      // alert(datastringnewcard);
        $.ajax({
        type: "POST",
        url: "load_accounts_data.php",
        data: datastringnewcard,
        success: function(data)
        {      
            
            
            $('#load_journal_detail').html(data);   
        }
       });     
     
      }
      
      
      
      function a4_daybook(){
          
           var date=$('#date_day').val();
           var type=$('#type_acc').val();
           
           var date_to=$('#date_day_to').val(); 
            
          var url="a4_daybook.php?fromdt="+date+"&todt="+date_to+"&a4_daybook=a4_daybook_print&type="+type;
          window.open(url, '_blank');

          
      }
</script>



<style>
.new_overlay{
	 width:100%;
	 height:100%;
	 background-color:rgba(0,0,0,0.8);
	 position:fixed;
	 z-index:999;
	 height: 100%;
	
	 }
.tablesorter tbody{min-height:460px;height: 70vh;}	
.contant_table_cc{height:auto;} 
.md-content button{width: 120px;padding: 0;height: 33px;margin: 3px 2px;}	
.form-control{height: 32px;padding: 0 12px;} 
.form_name_cc{height: 33px;line-height: 17px;width: 40%;text-align: left;}
.first_form_contain{padding:0.3%;}
.md-content h3{margin-bottom:10px;}
.form_textbox_cc {width:59%;}
.md-content .first_form_contain {margin-bottom: 6px;}
.tablesorter td{min-width:130px;}
.tablesorter th{min-width:130px;max-width:inherit !important;}
/*.tablesorter tr{display:block;}*/
.tablesorter tbody{overflow:visible !important}
.md-trigger_vouc img{width:23px;}

.add_printer_drop{height:41px}
 /*pagination */
 .pagination>li>a, .pagination>li>span{
color: #000;/* box-shadow: 0px 0px 5px #ccc; */background-color:/* #FFEFDD*/rgba(245, 178, 27, 0.20);border: 1px solid #C1C1C1;font-weight: bold;}
.pagination>li>a:hover,.pagination>li>span:hover,.pagination>li>a:focus,.pagination>li>span:focus,.pagination>li>.active{background-color:bisque}

.pagination{margin:0;margin:5px 5px 5px 0;float:right}
.pagination > li > a, .pagination > li > span {padding: 6px 16px;color: #000000;background-color: rgba(222, 184, 135, 0.42);border: 1px solid rgba(175, 137, 88, 0.69)}
.pagination>.active>a, .pagination>.active>span, .pagination>.active>a:hover, .pagination>.active>span:hover, .pagination>.active>a:focus, .pagination>.active>span:focus{background-color:#A0522D;border-color: #A0522D;color:#fff;}
.pagination> li > a:hover{background-color:#A0522D;border-color: #A0522D;color:#fff;}
#container{background-color:rgb(237, 237, 237) !important}
.ledger_head_sec{background:#fff; width:100%; height:auto; margin:0 0 5px 1px;padding-right:4px; border:1px #e5e5e5 solid;float:left;padding:10px;}.ledger_head{width:100%;height:auto;float:left;margin-top:0px;margin-bottom:5px;}
.acc_add_box{padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:15%;float:left}
.ledger_list_sec{width:100%;height:auto;float:left;padding:8px;background-color:#fff;margin-bottom:15px;border:1px #e5e5e5 solid;}
.ledger_list_scr{width:100%;height:auto;float:left;height:63vh;float:left;margin-top:5px;}
.ledger_list_scr table{width:100%;height:auto;float:left}
.ledger_list_scr table td{border: solid 1px #DAD4D4;color: #333; text-align: center; font-size: 14px; height: 31px; vertical-align: middle;
font-family: 'CALIBRI_0';}
.ledger_list_scr table thead{background-color:#333}.ledger_list_scr table thead td{color:#fff}
.printer_add_text_boxes_cc input{width:100% !important}
.printer_add_text_boxes_cc .bar{width:100%}
.printer_add_popup .md-content > .div{display:inline-block;width:100%;padding:10px;}
.printer_add_text_boxes_cc .group{width:100%;margin-left:0;}
.printer_add_text_boxes_cc input:focus ~ label, input:valid ~ label{    color: #414141;}
.md-show .md-overlay { opacity: 1;display: block;}
.printer_add_text_boxes_cc .group{margin-bottom:20px}
.journal_opening_blc{width:auto;float:left;padding:10px;color:#fff;background-color:#4CAF50;font-size:16px;margin-bottom:10px}
.acc_table_scroll tbody {height: 56vh;}
</style>

<link rel="stylesheet" href="../css/jquery-ui.css">
  <script src="../js/jquery-ui.js"></script>
  <link rel="stylesheet" href="../css/style_date.css">


</head>
<body>
    
    
    
<div class="olddiv "></div> 
<div id="blr" class="container nopaddding">
 <?php  include "includes/topbar_master.php"; ?>
 <?php include "includes/left_menu_account.php"; ?>
<div class="mian">
	<div class="view-container">
		<div style=" top: 58px;"  id="container">
			<div class="breadcrumbs">
				<ul>
					<li><a href="../index.php" style="cursor:pointer"><i class="ti-home"></i></a>/</li>
					<li><a style="cursor:pointer">Journals</a></li>
                      <?php if(isset($_REQUEST['msg'])){ ?>
                        <div class="load_error alertsmasters"><?=$alert?></div>
                        <script >
                       $(".load_error").delay(2000).fadeOut('slow');
                        </script>
                        <?php } ?>
				</ul>
            </div><!-- breadcrumbs -->


            
                
            

                <div class="content-sec">
                	<div style="  padding: 2px;margin-top:10px;" class="col-lg-12 col-md-12 main_cc">
                     
                        <div class="col-md-12" style="padding:0 5px;">
                            <div class="ledger_head_sec" style="">  
                                <h3 class="ledger_head">
                                    <a href="journals.php"><img src="img/thin_left_arrow_333.png" style="width: 13px;position: relative;top: -2px;"></a>
                                    <span style="padding-left:20px">DAY BOOK</span>
                                </h3>
                                 
                                <div class="acc_add_box" style="width:20%;">
                             	     From Date
                                      <input autocomplete="off" type="text" class="form-control filte_new_box" onchange="return datechange();" id="date_day"  placeholder="Date">
                                </div>
                                 <div class="acc_add_box" style="width:20%;">
                             	     To Date
                                      <input autocomplete="off" type="text" class="form-control filte_new_box dt_gr" onchange="return datechange();" id="date_day_to"  placeholder="Date">
                                </div>
                                
                                
                                 <div class="acc_add_box" style="width:20%;">
                             	        Type
                                      <select class="form-control filte_new_box" id="type_acc" onchange="return datechange();">
                                       
                                           <option value="all">All</option>
                                           <!-- <option value="credit_sale">Credit Sales</option> -->
                                            <option value="credit_purchase">Credit Purchase</option>
                                      </select>
                                </div>
                  <?php  if(in_array("a4_daybook", $_SESSION['menusubarray'])) { ?>  
                                <div class="acc_add_box" style="width:10%;float:right;color: white">
                             	   .
                                   <button style="margin-top: 16px;" onclick="return a4_daybook();" >A4 PRINT</button>
                                      <!-- <input style="background-color: darkred;cursor: pointer;color: white" autocomplete="off" type="text" class="form-control filte_new_box" onclick="return a4_daybook();"   placeholder="A4 PRINT"> -->
                                </div>
                                
                           <?php } ?> 	
                                
                                <div style="margin-left:2%;width:12%;" class="search_btn_member_invoice filte_new_box_btn">
                                 
                                
                                    
                                     </div>
                               <strong class="alert_error_popup" style="display: none" id="error_pop"> </strong>

                            </div>  

                            <div class="ledger_list_sec">


                               
                                <div class="ledger_list_scr">

                               
                                    
                                    

                                    <div style="float: right;font-size: 20px; background-color: lightskyblue;" class="">  <strong id="for_date4" ></strong></div>

                                    <table class="">
                                        <thead>
                                            <tr>
                                            <td style=" min-width: 70px; max-width: 70px"> Date </td>
                                            <td style=" min-width: 100px; max-width: 100px"> Voucher Id </td>
                                                    <td style=" min-width: 100px; max-width: 100px"> Type </td>                                                 
                                                    <td style=" min-width: 100px; max-width: 100px">Account Name</td> 
                                                    <td style="min-width: 150px; max-width: 150px">Particular</td>  
                                                 <td style="min-width: 75px; max-width: 75px">Debit Amt </td>
                                                 <td style="min-width: 75px; max-width: 75px">Credit Amt</td>
                                               
                                            </tr>
                                        </thead>
                                        <thead style="background-color: white ">
                                            <tr>
                                              
                                             
                                                <td style=" min-width: 200px; max-width: 200px"></td>
                                                 <td style="min-width: 100px; max-width: 100px"></td>
                                                    <td style="min-width: 100px; max-width: 100px"> </td>
                                                    <td style="min-width: 100px; max-width: 100px"> </td>
                                                    <td style="min-width: 100px; max-width: 100px"> </td>
                                                 <td style="min-width: 75px; max-width: 75px;color: grey;text-decoration: underline">(inwards Qty) </td>
                                                 <td style="min-width: 75px; max-width: 75px;color: grey;text-decoration: underline">(outwards Qty)</td>
                                               
                                            </tr>
                                        </thead>
                                        <tbody id="load_journal_detail">                                     
                                     </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                                       
                    </div><!--main_cc-->
                </div><!--main content-sec-->
		</div>
	</div>
</div>
</div><!--container-->


               
            <div class="md-overlay"></div><!-- the overlay element -->   


                 

<script src="../master_style/js/classie.js"></script>
<script src="../master_style/js/modalEffects.js"></script>
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="../js/jquery.cookie.js"></script>

<script type="text/javascript" src="../js/jquery.tablesorter.js"></script>

<script src="../loyalty/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

<div style="position:fixed;width:100%;left:30%;top:0%;z-index:99999;" class="mynewpopupload"  ></div>
</body>
</html>
