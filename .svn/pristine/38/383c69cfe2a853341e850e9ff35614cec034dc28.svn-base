<?php
//include('includes/session.php');		
session_start();
include("../database.class.php"); 
$database	= new Database();


?>
<!doctype html>
<html ng-app="website">
<head>
<meta charset="utf-8">
<title>Accounts</title>
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
  $(document).ready(function () 
  {         
    var url_check=$('#url_check').val();
  // var new_id=url_check.split('redirect=');
    var firstParameterValue = getFirstParameter(url_check);
   if(firstParameterValue=='redirect_account'){
     $("#pl_btn").prop("checked", true);
     type_of('profit_loss');   
    }   
          
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
        });  
        
  function getFirstParameter(url) 
  {
  var queryString = url.split('?')[1]; // Extract the query string from the URL
  var ampersandExists = checkAmpersandExist(url);
  if(ampersandExists==true){
  var parameters = queryString.split('&'); // Split the query string into individual parameters
  
  if (parameters.length > 0) {
    var firstParameter = parameters[0].split('=')[1]; // Get the value of the first parameter
    return decodeURIComponent(firstParameter); // Decode the parameter value if needed
  }
  }
  return null; // Return null if there are no parameters
}

function checkAmpersandExist(url) {
  return url.indexOf('&') !== -1;
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
.ledger_list_scr{width:100%;height:auto;float:left;height:400px;float:left;margin-top:5px;}
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
.ledger_head_inn{width:100%;height:35px;float:left;line-height:35px;text-align:center;font-size:15px;color:#fff;background-color:#212121}

.ledger_list_scr td{text-align:left !important;padding-left:10px}
#balance_profit_loss_div .ledger_list_scr table tbody {
    display: block;
    min-height: 370px;
    height:70vh;
    overflow-y: scroll;
    width: 100%;
    table-layout: fixed;
    padding-bottom:40px;
}
#balance_sheet_display_div .ledger_list_scr table tbody{
  min-height: 370px;
    height:70vh;
}
#tot_inc{position:absolute;bottom:0;width: 96% !important;}
#ttl_expnce{position:absolute;bottom:0;width: 96% !important;}
#balance_profit_loss_div .ledger_list_scr table tr {
    display: table;
    width: 100%;
}
</style>

<link rel="stylesheet" href="../css/jquery-ui.css">
  <script src="../js/jquery-ui.js"></script>
  <link rel="stylesheet" href="../css/style_date.css">

</head>
<body>
    <input type="hidden" value="<?=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>" id="url_check" >
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
					<li><a style="cursor:pointer">Accounts</a></li>
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
                                <h3 class="ledger_head"> </h3>


                                <div class="acc_add_box" style="width:270px;margin-left: 0px">
                                    
                                   
                                    
                                    <span style="position:relative;top:-8px">PROFIT & LOSS </span> <input id="pl_btn"  checked style="width:10%;height: 25px"   type="radio" value="profit_loss" name="type_view" class="sheet_name" onclick="return type_of('profit_loss');" > 
                                    
                                     <span style="position:relative;top:-8px">BALANCE SHEET</span> <input id="bl_btn" style="width:10%;height: 25px;margin-right: 15px;"  type="radio" name="type_view" value="balance_sheet" class="sheet_name" onclick="return type_of('balance_sheet');" > 
                                    
<!--                                    <select style="background-color: lightgrey;color: black;font: bold 3px " id="sheet_name" onchange="return type_of();" class="form-control filte_new_box">
                                        <option style="background-color: white"  value="balance_sheet" >BALANCE SHEET</option>
                                          <option style="background-color: white" value="profit_loss" >PROFIT & LOSS</option>
                                    </select>-->
                                </div>
                              <?php
                                if(isset($_GET['from'])){
                                  $fbdate = $_GET['from'];
                                }
                                 else{
                                  $fbdate=date('Y-m-d');
                                 } ?>
                                
                                <div class="acc_add_box" style="width:20%;display: none" id="from_div">
                                    <input type="text"  class="form-control filte_new_box change_date"  value="<?php echo $fbdate;?>"   id="from_date" name="" autocomplete="off" placeholder="From">
                                   
                                </div>

                                <?php 
                                if(isset($_GET['to'])){
                                  $tbdate = $_GET['to'];
                                } else{
                                  $tbdate=date('Y-m-d');
                                 } ?>

                                 <div class="acc_add_box" style="width:20%;display: none" id="to_div">                                  
                                    <input type="text" class="form-control filte_new_box change_date"  value="<?php echo $tbdate;?>"  id="to_date" name="" autocomplete="off" placeholder="To">
                                </div>

                                <?php 
                                if(isset($_GET['from'])){
                                  $fdate = $_GET['from'];
                                }
                                 else{
                                  $fdate=date('Y-m-d');
                                 } 
                                 ?>
                                <div class="acc_add_box" style="width:20%;display: block" id="from_div_pl">
                                    <input type="text" class="form-control filte_new_box change_date" value="<?php echo $fdate;?>"  id="from_date_pl" name="" autocomplete="off" placeholder="From">
                                   
                                </div>
                                <?php 
                                if(isset($_GET['to'])){
                                  $tdate = $_GET['to'];
                                } else{
                                  $tdate=date('Y-m-d');
                                 } ?>

                                 <div class="acc_add_box" style="width:20%;display: block" id="to_div_pl">
                                   
                                    <input type="text" class="form-control filte_new_box change_date" value="<?php echo $tdate;?>"  id="to_date_pl" name="" autocomplete="off" placeholder="To">
                                </div>
                                
                                 <?php  if(in_array("accounts_a4_download", $_SESSION['menusubarray'])) { ?> 
                                <div class="acc_add_box" style="width:10%;display: block;float: right;cursor: pointer" id="download_a4_pl_div">
                                   
                                    <a  class="form-control filte_new_box" style="background-color: #c3cfd6;color: black;font-weight: bold" id="download_a4_pl">  PRINT <i class="fa fa-print"></i></a>
                                </div>
                                
                                
                                <div class="acc_add_box" style="width:10%;display: none;float: right;cursor: pointer" id="download_a4_bl_div">
                                   
                                    <a  class="form-control filte_new_box" style="background-color: #c3cfd6;color: black;font-weight: bold" id="download_a4_bl">  PRINT <i class="fa fa-print"></i></a>
                                </div>
                                <?php } ?> 	
                                
                                
                                 <?php  if(in_array("excel_account_bl_pl", $_SESSION['menusubarray'])) { ?> 
                                <div class="acc_add_box" style="width:10%;display: block;float: right;cursor: pointer" id="download_excel_pl_div">
                                   
                                    <a  class="form-control filte_new_box" style="background-color: #638ea7;color: black;font-weight: bold" id="download_excel_pl">  EXCEL <i class="fa fa-download"></i></a>
                                </div>
                                
                                
                                <div class="acc_add_box" style="width:10%;display: none;float: right;cursor: pointer" id="download_excel_bl_div">
                                   
                                    <a  class="form-control filte_new_box" style="background-color: #638ea7;color: black;font-weight: bold" id="download_excel_bl">  EXCEL <i class="fa fa-download"></i></a>
                                </div>
                                <?php } ?> 	
                               
                                
                                <div style="margin-left:2%;width: 10%;display: none" class="search_btn_member_invoice filte_new_box_btn">
                                <a style="    margin-top: -1px;"  href="#">SUBMIT</a></div>
                            </div>  

                            <div class="ledger_list_sec" style="position:relative;display: none" id="balance_sheet_display_div">

                              <div class="col-md-6" style="padding:5px;">
                                <div class="ledger_head_inn" >LIABILITIES</div>
                                <div class="ledger_list_scr" style="height: auto;">
                                    <table class="">
                                        <tbody id="load_ledger_data_liability">
                                         </tbody>
                                    </table>
                                </div>
                            </div>  
                                
                                
                                
                            <div class="col-md-6" style="padding:5px;">
                                <div class="ledger_head_inn">ASSETS</div>
                                <div class="ledger_list_scr" style="height: auto;">
                                    <table class="">
                                        <tbody id="load_ledger_data_asset">                                           
                                        </tbody>                                       
                                    </table>
                                </div>
                              </div>
                            </div>

                            
                             <div class="ledger_list_sec"  id="balance_profit_loss_div" > 
                               <div class="col-md-6" style="padding:5px;">
                                <div class="ledger_head_inn" > EXPENSE</div>
                                <div class="ledger_list_scr" style="height: auto;">
                                    <table class="">
                                        <tbody id="load_ledger_data_loss">                                            
                                        </tbody>                                      
                                    </table>
                                </div>
                            </div>  
                                 
                                 
                            <div class="col-md-6" style="padding:5px;">
                                <div class="ledger_head_inn" >INCOME</div>
                                <div class="ledger_list_scr" style="height: auto;">
                                    <table class="">
                                        <tbody id="load_ledger_data_profit">                                            
                                        </tbody>
                                        <tbody id="load_ledger_data_profit_sale" style="display: none ">                                            
                                        </tbody>
                                        <tfoot id="profit_loss_calc_div">                                           
                                        </tfoot>
                                    </table>
                                </div>
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
<script src="../assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script>

        $("#from_date").datepicker({
               changeMonth: true,
               changeYear: true,
               dateFormat: 'yy-mm-dd',
                 maxDate: "+0D ",
               autoclose: true
           });
             $("#to_date").datepicker({
               changeMonth: true,
               changeYear: true,
               dateFormat: 'yy-mm-dd',
                 maxDate: "+0D ",
               autoclose: true
           });
           
           
           
            $("#from_date_pl").datepicker({
               changeMonth: true,
               changeYear: true,
               dateFormat: 'yy-mm-dd',
                 maxDate: "+0D ",
               autoclose: true
           });
           
             $("#to_date_pl").datepicker({
               changeMonth: true,
               changeYear: true,
               dateFormat: 'yy-mm-dd',
                 maxDate: "+0D ",
               autoclose: true
           });

   $(function() {
       
        var fromdt=$('#from_date_pl').val();
        var todt=$('#to_date_pl').val();

                        $.ajax({
			type: "POST",
			url: "load_ledger.php",
			data: "set=load_balance_sheet_profit&fromdt="+fromdt+"&todt="+todt,
			success: function(msg)
			{
          $('#load_ledger_data_profit').html(msg);
      }
      });
                        
                        
    $.ajax({
			type: "POST",
			url: "load_ledger.php",
			data: "set=load_balance_sheet_loss&fromdt="+fromdt+"&todt="+todt,
			success: function(msg)
			{
         $('#load_ledger_data_loss').html(msg);
      }
      });
           
           
           
                        $.ajax({
			type: "POST",
			url: "load_ledger.php",
			data: "set=loss_profit_calculator&fromdt="+fromdt+"&todt="+todt,
			success: function(msg)
			{ 
                            
                            
        var calc=$.trim(msg).split('*');
        
        if(calc[0]=='profit'){
            
          $('#profit_div').show();
          $('#profit_val_set').text(calc[1]);
          $('#loss_div').hide();
          $('#loss_val_set').text('');
          
         }                         
       
          if(calc[0]=='loss'){
              
            $('#loss_div').show();
            $('#loss_val_set').text(calc[1]);
            $('#profit_div').hide();
            $('#profit_val_set').text('');
          }
      }
    });
           
           
           
                        $.ajax({
			type: "POST",
			url: "load_ledger.php",
			data: "set=loss_profit_calculator&fromdt="+fromdt+"&todt="+todt,
			success: function(msg)
			{ 
                            
                           var calc=$.trim(msg).split('*')
                     
                           if(calc[0]=='profit'){
                               
                                $('#profit_div1').show();
                                $('#profit_val_set1').text(calc[1]);
                                
                                 $('#loss_div1').hide();
                                 $('#loss_val_set1').text('');
                           }
                           
                           if(calc[0]=='loss'){
                               
                                $('#loss_div1').show();
                                $('#loss_val_set1').text(calc[1]);
                                
                                 $('#profit_div1').hide();
                                 $('#profit_val_set1').text('');
                           }
                           
                         }
                        });   
           
           
                        $.ajax({
			type: "POST",
			url: "load_ledger.php",
			data: "set=load_balance_sheet_asset&fromdt="+fromdt+"&todt="+todt,
			success: function(msg)
			{
                              $('#load_ledger_data_asset').html(msg);
                        }
                        });

                        
                        $.ajax({
			type: "POST",
			url: "load_ledger.php",
			data: "set=load_balance_sheet_liability&fromdt="+fromdt+"&todt="+todt,
			success: function(msg)
			{
                             $('#load_ledger_data_liability').html(msg);
      }
      });
                        
    
           ///exccel dwnld//// 
           
           
    $('#download_excel_pl').click(function(){
        
        var from=$('#from_date_pl').val();
        var to=$('#to_date_pl').val();
        $.ajax({
			type: "POST",
			url: "excel_account_bl_pl.php?a4_pl=a4_pl_print&fromdt="+from+"&todt="+to,
			data: "",
			success: function(msg)
			{
                           window.location.href="excel_account_bl_pl.php?a4_pl=a4_pl_print&fromdt="+from+"&todt="+to;
                        }
                        });
        });   
           
      // ---Excel download---------//   
      
    $('#download_excel_bl').click(function(){       
        
      var from=$('#from_date').val();
      var to=$('#to_date').val();
      $.ajax({
			type: "POST",
			url: "excel_account_bl_pl.php??a4_bl=a4_bl_print&fromdt="+from+"&todt="+to,
			data: "",
			success: function(msg)
			{
         window.location.href="excel_account_bl_pl.php?a4_bl=a4_bl_print&fromdt="+from+"&todt="+to;
      }
      });
      });      
           
      ///------------a4print-------------------//// 

      $('#download_a4_pl').click(function()
      {         
        var from=$('#from_date_pl').val();
        var to=$('#to_date_pl').val();
        $.ajax({
			type: "POST",
			url: "accounts_a4_download.php",
			data: "",
			success: function(msg)
			{
        //  window.location.href="accounts_a4_download.php?a4_pl=a4_pl_print&fromdt="+from+"&todt="+to;
        var url = "accounts_a4_download.php?a4_pl=a4_pl_print&fromdt="+from+"&todt="+to;
        window.open(url, '_blank');
      }
        });
      });   
       
      
        $('#download_a4_bl').click(function(){
            
            var from=$('#from_date').val();
            var to=$('#to_date').val();
                 $.ajax({
			type: "POST",
			url: "accounts_a4_download.php",
			data: "",
			success: function(msg)
			{
       // window.location.href="accounts_a4_download.php?a4_bl=a4_bl_print&fromdt="+from+"&todt="+to;
       var url = "accounts_a4_download.php?a4_bl=a4_bl_print&fromdt=" + from + "&todt=" + to;
        window.open(url, '_blank');
                       }
                        });
        });   
           
           
             $("#from_date").on('change',function(){
                 
                 
                 var from=$('#from_date').val();
                 var to=$('#to_date').val();
                
             
                  $.ajax({
			type: "POST",
			url: "load_ledger.php",
			data: "set=loss_profit_calculator&fromdt="+from+"&todt="+to,
			success: function(msg)
			{
                //alert(msg);           
                         }
                        });
                  
                  
                  
                  
                 $.ajax({
			type: "POST",
			url: "load_ledger.php",
			data: "set=load_balance_sheet_liability&fromdt="+from+"&todt="+to,
			success: function(msg)
			{
                            $('#load_ledger_data_liability').html(msg);
                         }
                        });
                        
                       
                        $.ajax({
			type: "POST",
			url: "load_ledger.php",
			data: "set=load_balance_sheet_asset&fromdt="+from+"&todt="+to,
			success: function(msg)
			{
                            $('#load_ledger_data_asset').html(msg);
                         }
                        });
                        
                        
                        $.ajax({
			type: "POST",
			url: "load_ledger.php",
			data: "set=loss_profit_calculator&fromdt="+from+"&todt="+to,
			success: function(msg)
			{
                           
                           var calc=$.trim(msg).split('*')
                         //  alert(calc[0]);
                           if(calc[0]=='profit'){
                               $('#profit_div').show();
                                $('#profit_val_set').text(calc[1]);
                                
                                
                                 $('#loss_div').hide();
                                $('#loss_val_set').text('');
                           }
                           
                           if(calc[0]=='loss'){
                               $('#loss_div').show();
                                $('#loss_val_set').text(calc[1]);
                                
                                
                                 $('#profit_div').hide();
                                $('#profit_val_set').text('');
                           }
                           
                         }
                        });
                        
               
               
                 
               
               
             });
           
           
    $("#to_date").on('change',function(){
        
        
               var from=$('#from_date').val();
               var to=$('#to_date').val();
               
               $.ajax({
			type: "POST",
			url: "load_ledger.php",
			data: "set=loss_profit_calculator&fromdt="+from+"&todt="+to,
			success: function(msg)
			{
                           
                         }
                        });
               
               
                 $.ajax({
			type: "POST",
			url: "load_ledger.php",
			data: "set=load_balance_sheet_liability&fromdt="+from+"&todt="+to,
			success: function(msg)
			{
                            $('#load_ledger_data_liability').html(msg);
                         }
                        });
                        
                        
                        $.ajax({
			type: "POST",
			url: "load_ledger.php",
			data: "set=load_balance_sheet_asset&fromdt="+from+"&todt="+to,
			success: function(msg)
			{
                            $('#load_ledger_data_asset').html(msg);
                         }
                        });
                        
                        $.ajax({
			type: "POST",
			url: "load_ledger.php",
			data: "set=loss_profit_calculator&fromdt="+from+"&todt="+to,
			success: function(msg)
			{
                          
                             var calc=$.trim(msg).split('*')
                         //  alert(calc[0]);
                           if(calc[0]=='profit'){
                               $('#profit_div').show();
                                $('#profit_val_set').text(calc[1]);
                                
                                
                                 $('#loss_div').hide();
                                $('#loss_val_set').text('');
                           }
                           
                           if(calc[0]=='loss'){
                               $('#loss_div').show();
                                $('#loss_val_set').text(calc[1]);
                                
                                
                                 $('#profit_div').hide();
                                $('#profit_val_set').text('');
                           }
                            
                            
                            
                         }
                        });
                        
                        
                        
                     
                 
                        
                        
                        
             });
           
           
       });
       
function type_of(type){

    if(type=='balance_sheet')
    {
    $('#from_date_pl').val('');
    $('#to_date_pl').val('');
    $('#from_div_pl').hide();
    $('#to_div_pl').hide();
    $('#download_a4_pl_div').hide();
    $('#download_a4_bl_div').show();
    $('#download_excel_pl_div').hide();
    $('#download_excel_bl_div').show();
    $('#from_div').show();
    $('#to_div').show();
    $('#balance_sheet_display_div').show();
    $('#balance_profit_loss_div').hide();
      
      var from=$('#from_date').val();
     
    
      var to=$('#to_date').val();
                 $.ajax({
			type: "POST",
			url: "load_ledger.php",
			data: "set=load_balance_sheet_liability&fromdt="+from+"&todt="+to,
			success: function(msg)
			{
                            $('#load_ledger_data_liability').html(msg);
                         }
                        });
                        
                        
                        $.ajax({
			type: "POST",
			url: "load_ledger.php",
			data: "set=load_balance_sheet_asset&fromdt="+from+"&todt="+to,
			success: function(msg)
			{
                            $('#load_ledger_data_asset').html(msg);
                         }
                        });
      
      
      
      $.ajax({
			type: "POST",
			url: "load_ledger.php",
			data: "set=loss_profit_calculator&fromdt="+from+"&todt="+to,
			success: function(msg)
			{
                           
                           var calc=$.trim(msg).split('*')
                         //  alert(calc[0]);
                           if(calc[0]=='profit'){
                               $('#profit_div').show();
                                $('#profit_val_set').text(calc[1]);
                                
                                
                                 $('#loss_div').hide();
                                $('#loss_val_set').text('');
                           }
                           
                           if(calc[0]=='loss'){
                               $('#loss_div').show();
                                $('#loss_val_set').text(calc[1]);
                                
                                
                                 $('#profit_div').hide();
                                $('#profit_val_set').text('');
                           }
                           
                         }
                        });
      
      $.ajax({
			type: "POST",
			url: "load_ledger.php",
			data: "set=loss_profit_calculator&fromdt=&todt=",
			success: function(msg)
			{
                           
                           var calc=$.trim(msg).split('*')
                          
                           if(calc[0]=='profit'){
                               $('#profit_div1').show();
                                $('#profit_val_set1').text(calc[1]);
                                
                                
                                 $('#loss_div1').hide();
                                $('#loss_val_set1').text('');
                           }
                           
                           if(calc[0]=='loss'){
                               $('#loss_div1').show();
                                $('#loss_val_set1').text(calc[1]);
                                
                                
                                 $('#profit_div1').hide();
                                $('#profit_val_set1').text('');
                           }
                           
                         }
                        });   
      
      
      
     
             
                
    
     }else if(type=='profit_loss'){
     $('#from_div_pl').show();
     $('#to_div_pl').show();
    
     $('#download_a4_pl_div').show();
      $('#download_a4_bl_div').hide();
      
      
       $('#download_excel_pl_div').show();
      $('#download_excel_bl_div').hide();
    
     $('#from_div').hide();
     $('#to_div').hide();
     
     
     $('#from_date').val('');
       $('#to_date').val('');
     
     
      $('#balance_sheet_display_div').hide();
        $('#balance_profit_loss_div').show();
        
        
        
               var from=$('#from_date_pl').val();
               var to=$('#to_date_pl').val();

              
                 $.ajax({
			type: "POST",
			url: "load_ledger.php",
			data: "set=load_balance_sheet_profit&fromdt="+from+"&todt="+to,
			success: function(msg)
			{
          // alert(msg);               $('#load_ledger_data_profit').html(msg);
                         }
                        });
        
                 $.ajax({
			type: "POST",
			url: "load_ledger.php",
			data: "set=load_balance_sheet_loss&fromdt="+from+"&todt="+to,
			success: function(msg)
			{
                            $('#load_ledger_data_loss').html(msg);
                         }
                        });
                        
                        
                        
                $.ajax({
			type: "POST",
			url: "load_ledger.php",
			data: "set=loss_profit_calculator&fromdt="+from+"&todt="+to,
			success: function(msg)
			{
             // alert(msg);            
                           var calc=$.trim(msg).split('*')
                          // alert(calc[0]);
                           if(calc[0]=='profit'){
                               $('#profit_div').show();
                                $('#profit_val_set').text(calc[1]);
                                
                                
                                 $('#loss_div').hide();
                                $('#loss_val_set').text('');
                           }
                           
                           if(calc[0]=='loss'){
                               $('#loss_div').show();
                                $('#loss_val_set').text(calc[1]);
                                
                                
                                 $('#profit_div').hide();
                                $('#profit_val_set').text('');
                           }
                           
                         }
                        });     
                        
                        
                    $.ajax({
			type: "POST",
			url: "load_ledger.php",
			data: "set=loss_profit_calculator&fromdt=&todt=",
			success: function(msg)
			{
                        
                           var calc=$.trim(msg).split('*')
                         //  alert(calc[0]);
                           if(calc[0]=='profit'){
                               $('#profit_div1').show();
                                $('#profit_val_set1').text(calc[1]);
                                
                                
                                 $('#loss_div1').hide();
                                $('#loss_val_set1').text('');
                           }
                           
                           if(calc[0]=='loss'){
                               $('#loss_div1').show();
                                $('#loss_val_set1').text(calc[1]);
                                
                                
                                 $('#profit_div1').hide();
                                $('#profit_val_set1').text('');
                           }
                           
                         }
                        });       
                        
      
      }
    
    
    
}
      
      
      
   $("#to_date_pl").on('change',function(){
       $('#load_ledger_data_profit_sale').hide(1000);
               var from=$('#from_date_pl').val();
               var to=$('#to_date_pl').val();
               
               
                
               
              
                 $.ajax({
			type: "POST",
			url: "load_ledger.php",
			data: "set=load_balance_sheet_profit&fromdt="+from+"&todt="+to,
			success: function(msg)
			{
                            $('#load_ledger_data_profit').html(msg);
                         }
                        });
                        
                        
                        $.ajax({
			type: "POST",
			url: "load_ledger.php",
			data: "set=load_balance_sheet_loss&fromdt="+from+"&todt="+to,
			success: function(msg)
			{
                            $('#load_ledger_data_loss').html(msg);
                         }
                        });
                        
                         
                      $.ajax({
			type: "POST",
			url: "load_ledger.php",
			data: "set=loss_profit_calculator&fromdt="+from+"&todt="+to,
			success: function(msg)
			{
          //  alert(msg);           
                           var calc=$.trim(msg).split('*')
                         //  alert(calc[0]);
                           if(calc[0]=='profit'){
                               $('#profit_div1').show();
                                $('#profit_val_set1').text(calc[1]);
                                
                                
                                 $('#loss_div1').hide();
                                $('#loss_val_set1').text('');
                           }
                           
                           if(calc[0]=='loss'){
                               $('#loss_div1').show();
                                $('#loss_val_set1').text(calc[1]);
                                
                                
                                 $('#profit_div1').hide();
                                $('#profit_val_set1').text('');
                           }
                           
                         }
                        });   
                         
                         
                         
             });    
      
      
      $("#from_date_pl").on('change',function(){
          $('#load_ledger_data_profit_sale').hide(1000);
               var from=$('#from_date_pl').val();
               var to=$('#to_date_pl').val();
              
               
                 $.ajax({
			type: "POST",
			url: "load_ledger.php",
			data: "set=load_balance_sheet_profit&fromdt="+from+"&todt="+to,
			success: function(msg)
			{
                         $('#load_ledger_data_profit').html(msg);
                         }
                        });
                        
                        
                        $.ajax({
			type: "POST",
			url: "load_ledger.php",
			data: "set=load_balance_sheet_loss&fromdt="+from+"&todt="+to,
			success: function(msg)
			{
                            $('#load_ledger_data_loss').html(msg);
                         }
                        });
                      
                      
                       $.ajax({
			type: "POST",
			url: "load_ledger.php",
			data: "set=loss_profit_calculator&fromdt="+from+"&todt="+to,
			success: function(msg)
			{
                   // alert(msg);
                           var calc=$.trim(msg).split('*');
                         //  alert(calc[0]);
                           if(calc[0]=='profit'){
                               $('#profit_div1').show();
                                $('#profit_val_set1').text(calc[1]);
                                
                                
                                 $('#loss_div1').hide();
                                $('#loss_val_set1').text('');
                           }
                           
                           if(calc[0]=='loss'){
                               $('#loss_div1').show();
                                $('#loss_val_set1').text(calc[1]);
                                
                                
                                 $('#profit_div1').hide();
                                $('#profit_val_set1').text('');
                         }
                           
                         }
                        });   
                      
                      
             });    
      
      function view_employee(){
          $('#employee_section').show(1000);
           $('#employee_section1').show(1000);
             $('#supplier_section').show(1000);
          
          $('#minus_btn').show();
          $('#plus_btn').hide();
          
      }
      
      
      function hide_employee(){
          $('#employee_section').hide(1000);
           $('#employee_section1').hide(1000);
            $('#supplier_section').hide(1000);
          
          $('#minus_btn').hide();
          $('#plus_btn').show();
          
      }
      
      
      
      function view_supplier(){
         
          
          $('#minus_btn_sup').show();
          $('#plus_btn_sup').hide();
          
          
          $('#comp_div').show();
          $('#comp_div1').show();
          
          
      }
      
      
      function hide_supplier(){
          
         
          $('#minus_btn_sup').hide();
          $('#plus_btn_sup').show();
          $('#comp_div').hide(); 
          $('#comp_div1').hide();
      }
      
      function view_sale(){
         
         $('#load_ledger_data_profit_sale').show(1000);
          
          
          $('#minus_btn_sale').show();
          $('#plus_btn_sale').hide();
          
          
           var from=$('#from_date_pl').val();
               var to=$('#to_date_pl').val();
                 $.ajax({
			type: "POST",
			url: "load_ledger.php",
			data: "set=load_profit_loss_sale_bydate&fromdt="+from+"&todt="+to,
			success: function(msg)
			{
                            $('#load_ledger_data_profit_sale').html(msg);
                         }
                        });
          
          
          
      }
       function view_sale1(){
         
         
          
          
          $('#minus_btn_sale1').show();
          $('#plus_btn_sale1').hide();
          
          
            $('#cash_div_view').show();
          
           $('#bank_div_view').show();
           $('#credit_div_view').show();
      }
      
      
      function hide_sale(){
           $('#load_ledger_data_profit_sale').hide(1000);
         
          $('#minus_btn_sale').hide();
          $('#plus_btn_sale').show();
          
          
      }
      
      
      function hide_sale1(){
         
         $('#cash_div_view').hide();
          
           $('#bank_div_view').hide();
           $('#credit_div_view').hide();
          $('#minus_btn_sale1').hide();
          $('#plus_btn_sale1').show();
          
      }
      function view_cash_acc(){
         
        
          $('#cash_acc_div').show();
          
        $('#minus_btn_cash').show();   
         $('#plus_btn_cash').hide();
         
         var from=$('#from_date').val();
               var to=$('#to_date').val();
         $.ajax({
			type: "POST",
			url: "load_ledger.php",
			data: "set=cash_acc_load&fromdt="+from+"&todt="+to,
			success: function(msg)
			{
                            $('#cash_acc_div').html(msg);
                        }
                    });
          
      }
       function close_cash_acc(){
         
        
          $('#cash_acc_div').hide();
            $('#plus_btn_cash').show();
            $('#minus_btn_cash').hide(); 
      }
      
      
     function view_bank_acc()
     {
        $('#bank_acc_div').show();
        $('#minus_btn_bank').show();   
        $('#plus_btn_bank').hide();
         
        var from=$('#from_date').val();
        var to=$('#to_date').val();
         $.ajax({
			    type: "POST",
			    url: "load_ledger.php",
			    data: "set=bank_acc_load&fromdt="+from+"&todt="+to,
			    success: function(msg)
			      {
              $('#bank_acc_div').html(msg);
            }
                    }); 
      }

       function close_bank_acc()
       { 
          $('#bank_acc_div').hide();
          $('#plus_btn_bank').show();
          $('#minus_btn_bank').hide(); 
      } 
      
      
      
      function view_cap_acc(){
         
        
          $('#cap_acc_div').show();
          
        $('#minus_btn_cap').show();   
         $('#plus_btn_cap').hide();
         
         var from=$('#from_date').val();
               var to=$('#to_date').val();
         $.ajax({
			type: "POST",
			url: "load_ledger.php",
			data: "set=cap_acc_load&fromdt="+from+"&todt="+to,
			success: function(msg)
			{
                            $('#cap_acc_div').html(msg);
                        }
                    });
          
      }
       function close_cap_acc(){
         
        
          $('#cap_acc_div').hide();
            $('#plus_btn_cap').show();
            $('#minus_btn_cap').hide(); 
      } 
      
   </script>

</body>
</html>
