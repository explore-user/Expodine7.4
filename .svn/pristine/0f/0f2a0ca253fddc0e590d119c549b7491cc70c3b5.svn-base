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
<title>Expense Voucher</title>
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
 
  <link rel="stylesheet" href="../css/style_date.css">
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
    search_expense();      
    var url_check=$('#url_check').val();
    var new_id=url_check.split('redirect=');

     

   
   if(new_id[1]=='profit_loss'){
       $('#pl_page').show();
    //    var data_v="set=search_expense_voucher&type_exp=Direct&fromdt=&todt=&type_src=&toacc=";
    // //alert(data_v);
    // $.ajax({
	// 		type: "POST",
	// 		url: "load_accounts_data.php",
	// 		data: data_v,
	// 		success: function(msg)
	// 		{
    //         $('#load_vendor_data').html(msg);                            
    //         }
    //         });     
       
       
   }else if(new_id[1]=='profit_loss_indirect'){
     
       $('#pl_page').show();
       
    //    var data_v="set=search_expense_voucher&type_exp=Indirect&fromdt=&todt=&type_src=&toacc=";
    // //alert(data_v);
    
    // $.ajax({
	// 		type: "POST",
	// 		url: "load_accounts_data.php",
	// 		data: data_v,
	// 		success: function(msg)
	// 		{
    //         $('#load_vendor_data').html(msg);   
    //         }
    //         });     
   }
   else{
       $('#pl_page').hide();
       
     }               
             
        $('#cv_type').change(function(){
            
            var typ=$(this).val();
            var cv_date_search=$('.search_name').val();
            var todt=$('#search_date_to').val();
            
            var data_typ="set=load_expense_type&typ="+typ+"&fromdt="+cv_date_search+"&todt="+todt;
                    
            $.ajax({
			type: "POST",
			url: "load_accounts_data.php",
			data: data_typ,
			success: function(msg)
			{
             $('.load_expense_type').html(msg);         
                }
                    });     
            
        }) ;    
             
     
             
    //   if(new_id[1]!='profit_loss' && new_id[1]!='profit_loss_indirect'){        
    // var data_v="set=search_expense_voucher&fromdt=&todt=&type_exp=&type_src=&toacc=";
    
    // $.ajax({
	// 		type: "POST",
	// 		url: "load_accounts_data.php",
	// 		data: data_v,
	// 		success: function(msg)
	// 		{ 
    //                     $('#load_vendor_data').html(msg);
                             
    //                     }
    //                 });     
    //             }      
             
  $( "#datepicker").datepicker({
               changeMonth: true,
               changeYear: true,
               format: 'yyyy-mm-dd',
               endDate: '+0d',
               autoclose: true
           });
           
           
           
           $( "#datepicker1").datepicker({
               changeMonth: true,
               changeYear: true,
               format: 'yyyy-mm-dd',
               autoclose: true
            });
    
    $( "#search_date_to").datepicker({
               changeMonth: true,
               changeYear: true,
               format: 'yyyy-mm-dd',
               autoclose: true
              });
    
        });          
        
      

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
.ledger_list_scr{width:100%;height:auto;float:left;height:67vh;float:left;margin-top:5px;}
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
                     
				</ul>
            </div><!-- breadcrumbs -->

            
            
 
            <div class="col-md-12">
                        
                      <div style="margin-bottom:0;background: #fff;" class="cc_new">
                       	<div style="border: 0 !important " id="lista1" class="als-container">
                               <h3 style="float: left;margin-top: 10px;margin-left: 10px;">EXPENSE VOUCHER</h3>
                           <div style="width: 140px;float: right;top: 3px;height: 33px;margin: 8px 10px;" class="search_btn_member_invoice filte_new_box_btn">
                           <a class="md-trigger" style="background-color:#314b6b;margin:0;line-height: 32px;" onclick="pop_on();" href="#">ADD EXPENSE VOUCHER</a>
                           
                           
                           </div>
                          
                         <div style="width: 140px;float: right;top: 3px;height: 33px;margin: 8px 10px;" class="search_btn_member_invoice filte_new_box_btn">
                           
                           
                            <a  id="pl_page" style="background-color:darkred;margin:0;line-height: 32px;display: none"  href="load_ledger_sheet.php?redirect=redirect_account">GO BACK</a>
                           </div>
                      
                      </div>
                    </div>
           </div>
               
                <div class="content-sec">
                	<div style="  padding: 2px;margin-top:10px;" class="col-lg-12 col-md-12 main_cc">
                     
                        

                        <div class="col-md-12" style="padding:0 5px;">
                            <div class="ledger_head_sec" style="">  
                                <!-- <h3 class="ledger_head" style="font-size: 14px;">Filter  <span id="error_ledger" style="float:right;color:black;display: none;font-size: 14px;background-color: #ff4229;border-radius: 5px "></span></h3> -->

                              
                                
                                <div class="acc_add_box" style="width:20%;">
                                    <label style="margin: 0;">Type</label>
                                   
                                    <select id='type_src' class="form-control filte_new_box" onchange="return search_expense();" >
                                        <Option value="">Select Type</Option>
                                        <option value="Direct Expense">Direct Expense</option>
                                           <option value="Indirect Expense">Indirect Expense</option>
                                    </select>
                                </div>
                                
                                <?php if (isset($_GET['from']))
                                {
                                    $fdate = $_GET['from'];
                                }else{
                                    $fdate=date('Y-m-d');
                                }
                                
                                if (isset($_GET['to']))
                                {
                                    $tdate = $_GET['to'];
                                }else{
                                    $tdate=date('Y-m-d');
                                }
                                ?>
                                
                                
                                <div class="acc_add_box" style="width:20%;">
                                    <label style="margin: 0;">From Date</label>
                                    <input autocomplete="off" type="text" value=<?=$fdate;?>  class="form-control filte_new_box search_name" onchange="return datechange();" id="datepicker1"  name="" >
                                </div>
                                
                                 <div class="acc_add_box" style="width:20%;">
                                    <label style="margin: 0;">To Date</label>
                                    <input autocomplete="off" type="text" value=<?=$tdate;?>  class="form-control filte_new_box " onchange="return datechange();" id="search_date_to"  name="" >
                                </div>
                                
                                
                                 <div class="acc_add_box" style="width:20%;">
                                    <label style="margin: 0;">To Acc</label>
                                 <select class="form-control filte_new_box" onchange="return search_expense();" id="toacc_search"> 
                             <option value=""> Select</option>
                           <?php 
                                         $sql_kotlist  =  $database->mysqlQuery("SELECT tlm_id,tlm_ledger_name from tbl_ledger_master tl left join tbl_ledger_group tg on tl.tlm_group=tg.tlg_id where (tg.tlg_name='Direct Expense' or tg.tlg_name='Indirect Expense'  )  "); 
					$num_kotlist  = $database->mysqlNumRows($sql_kotlist);
					if($num_kotlist){
						  while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
							  {?>
                                <option value="<?=$result_kotlist['tlm_id'] ?> "><?=$result_kotlist['tlm_ledger_name'] ?> </option>
                                <?php 
                                 }
                                  }?>
                            </select>
                               </div>  
                                
                                 <div class="acc_add_box" style="width:20%;">
                                    <label style="margin: 0;"></label>
                                    <a class="form-control filte_new_box " style="background-color: #890000;color: white ;width: 65px" href="expense_voucher.php" >REFRESH </a>      
                                    
                                </div>
                                
                                
                                <!-- <div style="margin-left:2%;width: 18%;" class="search_btn_member_invoice filte_new_box_btn">
                                <a id="add_btn_ledger"  style="margin-top:0"  href="#">Filter</a>
                            </div>   -->

                            <div class="ledger_list_sec" style="position:relative">
                             
                                   
                             
                                <div class="ledger_list_scr">
                                    <table class="acc_table_scroll">
                                        <thead>
                                            <tr>
                                                 <td style="width:5%">SL</td>
                                                 <td style="width:10%">Action</td>
                                                <td style="width:10%">Date</td>
                                                <td style="width:10%">From Acc</td>
                                                <td style="width:10%">To Acc</td>
                                                <td style="width:10%">Amount</td>
                                                <td style="width:10%;overflow-wrap: break-word;word-break: break-word; ">Trans Details</td>
                                                  <td style="width:10%">Entry Date</td>
                                                <td style="width:10%;overflow-wrap: break-word;word-break: break-word; ">Remarks</td>
                                                <td style="width:10%">Type</td>
                                                
                                              
                                            </tr>
                                        </thead>
                                        <tbody id='load_vendor_data'>
                                    </tbody>
                                    </table>
                                </div>
                            </div>
                            <div>
                            <div id="show_text"></div>
                            <div id="show_pagination"></div></div>

                        </div>
 
                     
                    </div><!--main_cc-->
                </div><!--main content-sec-->
		</div>
	</div>
</div>
</div><!--container-->
<div  class="md-modal md-effect-16 printer_add_popup"  style="top:0;width:100%;height:100%">
			<div style="width:800px;top:3%;margin:auto;left:0;right:0" class="md-content">
                            <h3 id="head_pop" style="margin-bottom:0"> ADD EXPENSE VOUCHER </h3>
                                <div onclick="close_pop();" style="background-color:transparent;top: 3px;"  class="md-close close_staff_pop"><img src="img/close_ico.png"></div>
				
                <div class="div">

                    <div class="col-lg-12 col-md-12 no-padding printer_add_text_boxes_cc add_supplier_cnt" style="margin-bottom:5px;">

                    
                     <div class="col-md-4">
                     <div class="group" id="prn_div">   
                         <input type="text" class="cv_date" autocomplete="off"  id="datepicker" >   
                          <span class="highlight"></span>
                          <span class="bar"></span>
                          <label id="lab_grp">Date</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="group" id="prn_div">   
                           
                          
                          <select class="add_printer_drop" id="cv_from" onchange="check_ledger_balance();"> 
                             <option value="">Select </option>
                             <?php 
                                         $sql_kotlist  =  $database->mysqlQuery("SELECT tlm_id,tlm_ledger_name from tbl_ledger_master tl left join tbl_ledger_group tg on tl.tlm_group=tg.tlg_id where (tg.tlg_name='Cash in Hand' OR tg.tlg_name='Bank Accounts')  "); 
					$num_kotlist  = $database->mysqlNumRows($sql_kotlist);
					if($num_kotlist){
						  while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
							  { ?>
                                          <option value="<?=$result_kotlist['tlm_id'] ?> "><?=$result_kotlist['tlm_ledger_name'] ?> </option>
                               <?php } } ?>
                          </select>
                          <label style="top:-5px;color: #414141;font-size: 14px" id="lab_grp">From ACC</label>
                          
                          
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="group" id="prn_div">   
                          
                            <select class="add_printer_drop" id="cv_type"> 
                             <option value="">Select</option>
                             <option value="Direct Expense"> DIRECT EXPENSE </option>
<!--                             <option value="Direct Income"> DIRECT INCOME </option>-->
                              <option value="Indirect Expense"> INDIRECT EXPENSE  </option>
<!--                             <option value="Indirect Income"> INDIRECT INCOME  </option>-->

                            </select>
                            <label style="top:-5px;color: #414141;font-size: 14px" id="lab_grp">ACC Type</label>
                        </div>
                    </div> 
                        <div class="col-md-4">
                        <div class="group load_expense_type" id="prn_div">   
                        <select class="add_printer_drop" id="cv_to"> 
                             <option value="">Select </option>
                              </select>
                              <label style="top:-5px;color: #414141;font-size: 14px" id="lab_grp">To ACC</label>
                          
                        </div>
                    </div> 
                    <div class="col-md-4">
                        <div class="group" id="prn_div">   
                            <input type="text" id="cv_amount" onkeypress="return numdot(this,event);"  >   
                          <span class="highlight"></span>
                          <span class="bar"></span>
                          <label id="lab_grp">Amount</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                    <div class="group" id="prn_div">   
                           <input type="text" id="cv_trans"  >   
                          <span class="highlight"></span>
                          <span class="bar"></span>
                          <label id="lab_grp">Transaction Details</label>
                        </div>
                    </div>                   
                    <div class="col-md-12">
                        <div class="group" id="prn_div">   
                           <input type="text" id="cv_remarks"  >   
                          <span class="highlight"></span>
                          <span class="bar"></span>
                          <label id="lab_grp">Particulars</label>
                        </div>
                    </div>                  
                    </div>                     
                    <a id='add_btn' onclick="return add_expense_voucher();" href="#"><button style="position:relative;top:2px;float:right;right:5px;height: 42px;" class="md-save">SUBMIT</button></a>
                    <a style="display: none " id='upd_btn' onclick="return update_expense_voucher();" href="#"><button style="position:relative;top:2px;float:right;right:5px;height: 42px;" class="md-save">UPDATE</button></a>
                </div>
                       
            </div>
</div>       
            <div class="md-overlay"></div><!-- the overlay element -->                       
                 
            <strong class="alert_error_popup" style="display: none" id="error_pop"> </strong>           
<script src="../master_style/js/classie.js"></script>
<script src="../master_style/js/modalEffects.js"></script>
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="../js/jquery.cookie.js"></script>
<script src="../loyalty/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="../js/jquery.tablesorter.js"></script>
<script type="text/javascript" id="js">

</script>

<script type="text/javascript">
  
  function pop_on()
        {
            $('.printer_add_popup').addClass('md-show');
            $('#head_pop').text('ADD EXPENSE VOUCHER');
            $(".cv_date").val('');
            $("#cv_from").val('');
            $("#cv_type").val('');
            $("#cv_amount").val('');
            $("#cv_trans").val('');
            $("#cv_remarks").val('');
            
           // $('.load_expense_type').html('');
            $('#cv_to').val('');
           // $('.cv_date').attr('voucher_update_id');
            $('.cv_date').removeAttr('voucher_update_id');
            $('#add_btn').show();
            $('#upd_btn').hide();

        }

   function check_ledger_balance(){   
    var v_from=$('#cv_from').val();
    var data_v="set=check_ledger_balance&ledger="+v_from;
    $.ajax({
			type: "POST",
			url: "load_accounts_data.php",
			data: data_v,
			success: function(msg)
			{                         
          if($.trim(msg)!='ok'){                              
         $('#cv_from').val('');                           
         $('#error_pop_v').show();
         $('#error_pop_v').text('NO BALANCE IN LEDGER');
         $('#cv_from').focus();
         $('#error_pop_v').delay(2000).fadeOut('slow');                             
                  } 
                   }
                    });
    }
  
function numdot(item,evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode==46)
    {
        var regex = new RegExp(/\./g)
        var count = $(item).val().match(regex).length;
        if (count > 1)
        {
            return false;
        }
    }
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
        }
    function close_pop(){
      //  window.location.href='expense_voucher.php';
      $('.printer_add_popup').removeClass('md-show');
    }
    
    
function add_expense_voucher(){   
  var cv_date=$('.cv_date').val();
  var cv_amount=$('#cv_amount').val();
  var cv_from=$('#cv_from').val();
  var cv_to=$('#cv_to').val();
  var cv_trans=$('#cv_trans').val();
  var cv_remarks=$('#cv_remarks').val();
  var cv_type=$('#cv_type').val();
              
   if(cv_amount!='' && cv_date!='' && cv_from!='' && cv_to!='' && cv_type!='' ){
        var data_v="set=add_expense_voucher&cv_date="+cv_date+"&cv_amount="+cv_amount+"&cv_from="+cv_from+"&cv_to="+cv_to+"&cv_trans="+cv_trans+
          "&cv_remarks="+cv_remarks+"&cv_type="+cv_type;
        $.ajax({
			type: "POST",
			url: "load_accounts_data.php",
			data: data_v,
			success: function(msg)
			{
                         $('#error_pop_v').show();
                         $('#error_pop_v').css('background-color', '#549056');
                         $('#error_pop_v').text('ADDED SUCCESSFULLY');
                         $('#error_pop_v').delay(2000).fadeOut('slow'); 
                         $('.printer_add_popup').removeClass('md-show');                     
                    //      setTimeout(function(){                            
                    //    //   window.location.href='expense_voucher.php';
                    //    search_expense();
                    //     }, 100); 
                             
                      search_expense();  
                    $.ajax({
                type: "POST",
                url: "load_ledger.php",
                data: "set=open_ledger_daywise&date="+cv_date,
                success: function(msg1)
                {
                                     
                $.ajax({
                type: "POST",
                url: "load_ledger.php",
                data: "set=close_ledger_daywise&date="+cv_date,
                success: function(msg)
                {
                                  
                }
                });    
                }
                });
                             
                        }
                    });
        
        
    }else{
        
        $('#error_pop_v').show();
        
        
          if(cv_amount==''){
        $('#error_pop_v').text('ENTER AMOUNT');
        $('#cv_amount').focus();
         }
         
          if(cv_to==''){
        $('#error_pop_v').text('SELECT TO ACC ');
        $('#cv_to').focus();
         }
         
         if(cv_type==''){
        $('#error_pop_v').text('SELECT ACC TYPE');
        $('#cv_type').focus();
         }
         
         
         if(cv_from==''){
        $('#error_pop_v').text('SELECT FROM ACC AMOUNT');
        $('#cv_from').focus();
         }
         
         if(cv_date==''){
        $('#error_pop_v').text('SELECT DATE');
        $('.cv_date').focus();
         }
          
        $('#error_pop_v').delay(2000).fadeOut('slow');
    }
        
    }
    
   function search_expense(n){
      
       var cv_date_search=$('#datepicker1').val();
       var type_src=$('#type_src').val();
       var todt=$('#search_date_to').val();
       var toacc_search=$('#toacc_search').val();
       
        if(!n){
            n=1;
        }
       var data_v="set=search_expense_voucher&fromdt="+cv_date_search+"&type_src="+type_src+"&type_exp=&todt="+todt+"&toacc="+toacc_search;

    $.ajax({
			type: "POST",
			url: "load_accounts_data.php?page="+n,
			data: data_v,
            dataType: 'json',
			success: function(msg)
			{
            $('#load_vendor_data').html(msg.data);  
            $('#show_text').html(msg.show);
            $('#show_pagination').html(msg.pagination); 
            $('.confrmation_overlay_proce').css('display','none');                  
            }
        });    
   } 
    
function datechange()
{
    if($('#datepicker1').val()!='' && $('#search_date_to').val()!='')
    {
      $('.confrmation_overlay_proce').css('display','block');
      $('.confrmation_overlay_proce').html('<img src="img/ajax-loaders/fetch.gif" />'); 
      search_expense();
    }
}
   
  function delete_expense_voucher(vid,date){
    
      var confirm1=confirm(" DELETE VOUCHER ?");
      if(confirm1===true){
          $('#error_pop_v').show();
                         $('#error_pop_v').css('background-color', 'red');
                         $('#error_pop_v').text('DELETING');
                         $('#error_pop_v').delay(5000).fadeOut('slow');
      $.ajax({
			type: "POST",
			url: "load_accounts_data.php",
			data: "set=delete_expense_voucher&vid="+vid,
			success: function(msg)
			{
                search_expense();

                $.ajax({
                type: "POST",
                url: "load_ledger.php",
                data: "set=open_ledger_daywise&date="+date,
                success: function(msg1)
                {
                                     
                $.ajax({
                type: "POST",
                url: "load_ledger.php",
                data: "set=close_ledger_daywise&date="+date,
                success: function(msg)
                {
                                 
                }
                });    
                }
                });
                            
                        }
                    });
                }
}
    
    function edit_expense_voucher(vid)
    {    //alert(vid);
        $('#add_btn').hide();
        $('#upd_btn').show();
        $('.printer_add_popup').addClass('md-show');
        $('#head_pop').text('UPDATE EXPENSE VOUCHER');
    
    $.ajax({
			type: "POST",
			url: "load_accounts_data.php",
			data: "set=edit_expense_voucher&edit_id="+vid,
			success: function(msg)
			{  
                var ed1=$.trim(msg);
                var ed=ed1.split('*');
                         
  $('.cv_date').attr('voucher_update_id',vid);
  $('.cv_date').val(ed[0]);
  $('#cv_from').val(ed[1]);
  $('#cv_amount').val(ed[3]);
  $('#cv_trans').val(ed[4]);
  $('#cv_remarks').val(ed[5]);
  $('#cv_type').val(ed[6]);
  
  var data_typ="set=load_expense_type&typ="+ed[6];
                    
            $.ajax({
			type: "POST",
			url: "load_accounts_data.php",
			data: data_typ,
			success: function(msg)
			{
                        $('.load_expense_type').html(msg);
                             $('#cv_to').val(ed[2]);    
                        }
                    });                             
                        }
                    });
       
}

function update_expense_voucher()
{
  var cv_date=$('.cv_date').val();
  var cv_amount=$('#cv_amount').val();
  var cv_from=$('#cv_from').val();
  var cv_to=$('#cv_to').val();
  var cv_trans=$('#cv_trans').val();
  var cv_remarks=$('#cv_remarks').val();
  var cv_type=$('#cv_type').val();

  var update_id=$('.cv_date').attr('voucher_update_id');
           
    if(cv_amount!='' && cv_date!='' && cv_from!='' && cv_to!='' && cv_type!=''  ){
        
        var data_v="set=update_expense_voucher&cv_date="+cv_date+"&cv_amount="+cv_amount+"&cv_from="+cv_from+"&cv_to="+cv_to+"&cv_trans="+cv_trans+
          "&cv_remarks="+cv_remarks+"&update_id="+update_id+"&cv_type="+cv_type;
        
        $.ajax({
			type: "POST",
			url: "load_accounts_data.php",
			data: data_v,
			success: function(msg)
			{
                         $('#error_pop_v').show();
                         $('#error_pop_v').css('background-color', '#549056');
                         $('#error_pop_v').text('UPDATED SUCCESSFULLY');
                         $('#error_pop_v').delay(2000).fadeOut('slow');
                                 $('.printer_add_popup').removeClass('md-show'); 
                    //      setTimeout(function(){
                    //         search_expense();
                    //    //  window.location.href='expense_voucher.php';
                                      
                    //     }, 500);    

                        search_expense();  
                    
                    $.ajax({
                type: "POST",
                url: "load_ledger.php",
                data: "set=open_ledger_daywise&date="+cv_date,
                success: function(msg1)
                {
                                     
                $.ajax({
                type: "POST",
                url: "load_ledger.php",
                data: "set=close_ledger_daywise&date="+cv_date,
                success: function(msg)
                {
                                    
                }
                });    
                }
                });

                        }
                    }); 
    }else{
        
        $('#error_pop_v').show();
            if(cv_amount==''){
        $('#error_pop_v').text('ENTER AMOUNT');
        $('#cv_amount').focus();
         }         
          if(cv_to==''){
        $('#error_pop_v').text('SELECT TO ACC ');
        $('#cv_to').focus();
         }        
         if(cv_type==''){
        $('#error_pop_v').text('SELECT  ACC TYPE');
        $('#cv_type').focus();
         }
         if(cv_from==''){
        $('#error_pop_v').text('SELECT FROM ACC AMOUNT');
        $('#cv_from').focus();
         }        
         if(cv_date==''){
        $('#error_pop_v').text('SELECT DATE');
        $('.cv_date').focus();
         }         
        $('#error_pop_v').delay(2000).fadeOut('slow');
    }
    }
    </script>
<div style="position:fixed;width:auto;right: 20px;bottom:20px;z-index:99999;background-color: #f00;color: white;padding: 10px 20px;display: none;font-size: 15px" id="error_pop_v"> </div>

<div style="display:none" class="confrmation_overlay_proce"></div>
<style>
      .confrmation_overlay_proce{
	width:100%;
	height:100%;
	position:fixed;
	z-index:999;
	background-color:rgba(0,0,0,0.8);
	top:0;
	text-align:center;
	line-height: 40;
		}
.confrmation_overlay_proce img{width:100px;height:100px;}
    </style>

</body>
</html>
