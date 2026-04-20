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
<title>Loan&Advance</title>
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
                               <h3 style="float: left;margin-top: 10px;margin-left: 10px;">LOAN VOUCHER</h3>
                           <div style="width: 140px;float: right;top: 3px;height: 33px;margin: 8px 10px;" class="search_btn_member_invoice filte_new_box_btn">
                           <a class="md-trigger" data-modal="modal-17" style="background-color:#314b6b;margin:0;line-height: 32px;" onclick="return pop_on();" href="#">ADD LOAN </a></div>
                           

                      </div>
                    </div>
           </div>
               
                <div class="content-sec">
                	<div style="  padding: 2px;margin-top:10px;" class="col-lg-12 col-md-12 main_cc">
                     
                        

                        <div class="col-md-12" style="padding:0 5px;">
                            <div class="ledger_head_sec" style="">  
                                <!-- <h3 class="ledger_head" style="font-size: 14px;">Filter  <span id="error_ledger" style="float:right;color:black;display: none;font-size: 14px;background-color: #ff4229;border-radius: 5px "></span></h3> -->

                              <?php 
                                if(isset($_GET['from']))
                                {
                                    $from = $_GET['from'];
                                }
                                else {
                                    $from = date('Y-m-d');
                                }
                                
                                ?>

                                <div class="acc_add_box" style="width:20%;">
                                    <label style="margin: 0;">From Date</label>
                                    <input autocomplete="off" type="text" value=<?=$from;?> class="form-control filte_new_box search_name" onchange="return search_contra();" id="datepicker1"  name="" placeholder="Date">
                                    
                                </div>
                                <?php
                                if(isset($_GET['to']))
                                {
                                    $to = $_GET['to'];
                                }
                                else {
                                    $to = date('Y-m-d');
                                }
                                ?>
                                 <div class="acc_add_box" style="width:20%;">
                                    <label style="margin: 0;">To Date</label>
                                    <input autocomplete="off" value=<?=$to;?> type="text" class="form-control filte_new_box " onchange="return search_contra();" id="datepicker2"  name="" placeholder="Date">
                                    
                                </div>
                                
                                 <div class="acc_add_box" style="width:20%;">
                                      <label style="margin: 0;">VOUCHER TYPE</label>
                                 <select class="form-control filte_new_box " onchange="return search_contra();"  id="voucher_type"> 
                             <option value="">Select</option>
                             <option value="Loan" selected=selected> LOAN </option>
                                  <!-- <option value="Advance"> ADVANCE</option> -->
                                 
                                </select>
                                </div> 
                                
                                
                                
                                 <div class="acc_add_box" style="width:20%;">
                                    <label style="margin: 0;"></label>
                                    <a class="form-control filte_new_box " style="background-color: #890000;color: white ;width: 63px" href="loan_advance.php" >REFRESH </a>      
                                    
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
                                                 <td style="width:8%">Action</td>
                                                <td style="width:10%">Date</td>
                                                 <td style="width:10%">Voucher No</td>
                                                 <td style="width:10%"> Type</td>
                                                
                                                <td style="width:10%">From Acc</td>
                                                <td style="width:10%">To Acc</td>
                                                <td style="width:10%">Amount</td>
                                                <td style="width:10%">Paid</td>
                                                <td style="width:10%">Balance</td>
                                                
                                              
                                            </tr>
                                        </thead>
                                        <tbody id='load_vendor_data'>
                                        
                                            
                                        
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








<div  class="md-modal md-effect-16 printer_add_popup" id="modal-17" style="top:0;width:100%;height:100%">
			<div style="width:800px;top:3%;margin:auto;left:0;right:0" class="md-content">
                            <h3 id="head_pop" style="margin-bottom:0"> ADD LOAN-ADVANCE VOUCHER </h3>
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
                         <input type="text" class="" autocomplete="off"  id="vouch_no" >   
                          <span class="highlight"></span>
                          <span class="bar"></span>
                          <label style="top:-5px;color: #414141;font-size: 14px" id="lab_grp">Voucher No</label>
                        </div>
                    </div>
                        
                        <div class="col-md-4">
                        <div class="group to_select" id="prn_div">   
                          
                            <select class="add_printer_drop" id="acc_type" onchange=" change_loan_adv();">
                                <option value=""> Select voucher type</option>
                                 <option value="Loan" > LOAN </option>
                                  <!-- <option value="Advance"> ADVANCE</option> -->
                                
                                  
                                     
                            </select>
                            <label style="top:-5px;color: #414141;font-size: 14px" id="lab_grp">Voucher Type</label>
                          
                          
                        </div>
                    </div>
                        
                        
                    <div class="col-md-4">
                        <div class="group" id="prn_div">   
                          
                            <select class="add_printer_drop" id="from_acc"  onchange="check_ledger_balance();" >
                                <option value="">Select </option>
                                
                                <?php 
                                         $sql_kotlist  =  $database->mysqlQuery("SELECT * from tbl_ledger_master tl left join tbl_ledger_group tg on tl.tlm_group=tg.tlg_id where (tg.tlg_name='Cash in Hand' OR  tg.tlg_name='Bank Accounts')  "); 
					$num_kotlist  = $database->mysqlNumRows($sql_kotlist);
					if($num_kotlist){
						  while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
							  {?>
                             <option value="<?=$result_kotlist['tlm_id']?>"><?=$result_kotlist['tlm_ledger_name'] ?> </option>
                             <?php 
                                 }}
                              ?>                   
                            </select>
                            <label style="top:-5px;color: #414141;font-size: 14px" id="lab_grp">From ACC</label>
                          
                          
                        </div>
                    </div>
                        
                        
                        <div class="col-md-4 adv_div" style="display:none">
                        <div class="group to_select" id="prn_div">   
                          
                            <select class="add_printer_drop" id="advance_type" onchange="change_adv_type();">
                                <option value=""> ADVANCE TYPE</option>
                                 <option value="Fixed_asset"> Fixed Asset </option>
                                  <option value="Direct_expense"> Direct Expense</option>
                                   <option value="Indirect_expense"> Indirect Expense</option>
                            </select>
                          
                        </div>
                       </div>
                        
                        
                        <div class="col-md-4 first_div" >
                        <div class="group to_select" id="prn_div">   
                          
                            <select class="add_printer_drop">
                                <option>Select </option>
                            </select>
                            <label style="top:-5px;color: #414141;font-size: 14px" id="lab_grp">To ACC</label>
                          
                        </div>
                    </div> 
                        
                    <div class="col-md-4 second_div" style="display:none;pointer-events: none">
                        <div class="group to_select select_to_acc" id="prn_div">   
                          
                            
                          
                        </div>
                    </div>
                        
                        
                        
                        
                        <div class="col-md-4 loan_div" style="display:none">
                        <div class="group to_select" id="prn_div">   
                          
                            <select class="add_printer_drop" id="loan_type" >
                                <option value=""> LOAN TYPE</option>
                                 <option value="Loan_advance"> LOAN & ADVANCE </option>
                                 
                                  
                            </select>
                          
                        </div>
                       </div>
                        
                        
                        
                        
                        
                        
                        
                    <div class="col-md-4">
                        <div class="group" id="prn_div">   
                            <input type="text" id="amount" onkeypress="return numdot(this,event);"  >   
                          <span class="highlight"></span>
                          <span class="bar"></span>
                          <label style="display:block !important" class="amount_div_show" id="lab_grp">Amount</label>
                        </div>
                    </div>
                    <div class="col-md-8">
                    <div class="group" id="prn_div">   
                           <input type="text" id="trans"  >   
                          <span class="highlight"></span>
                          <span class="bar"></span>
                          <label id="lab_grp">Transaction Details</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="group" id="prn_div">   
                           <input type="text" id="received"  >   
                          <span class="highlight"></span>
                          <span class="bar"></span>
                          <label id="lab_grp">Received By</label>
                        </div>
                    </div>
                        
                    <div class="col-md-6">
                        <div class="group" id="prn_div">   
                           <input type="text" id="remarks"  >   
                          <span class="highlight"></span>
                          <span class="bar"></span>
                          <label id="lab_grp">Particulars</label>
                        </div>
                    </div>

                  
                    </div>
                      
                    <a id='add_btn' onclick="return add_contra_voucher();" href="#"><button style="position:relative;top:2px;float:right;right:5px;height: 42px;" class="md-save">SUBMIT</button></a>
                    <a style="display: none " id='upd_btn' onclick="return update_contra_voucher();" href="#"><button style="position:relative;top:2px;float:right;right:5px;height: 42px;" class="md-save">UPDATE</button></a>

                   

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
<script type="text/javascript" id="js"></script>

<script type="text/javascript">
    //calender//
            $(document).ready(function () {
             
                search_contra();
    // var data_v="set=search_loan_adv_voucher&fromdt=&todt=&voucher_type=";
    
   
    // $.ajax({
	// 		type: "POST",
	// 		url: "load_accounts_data.php",
	// 		data: data_v,
	// 		success: function(msg)
	// 		{    
    //             $('#load_vendor_data').html(msg);
    //         }
    //     });     
             
             
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
    
    
    $( "#datepicker2").datepicker({
               changeMonth: true,
               changeYear: true,
               format: 'yyyy-mm-dd',
               autoclose: true
           });
           
        });          
        
    

    function pop_on()
    {
        $("#datepicker").val('');
        $("#vouch_no").val('');
        $("#acc_type").val('');
        $("#from_acc").val('');
        $("#loan_type").val('');
        $("#to_acc").val('');
        $("#amount").val('');
        $("#trans").val('');
        $("#received").val('');
        $("#remarks").val('');
        $('#head_pop').text('ADD LOAN-ADVANCE VOUCHER');
        $('#add_btn').show();
        $('#upd_btn').hide();
        $('.first_div').show();
        $('.second_div').hide();
        $('#acc_type').prop('disabled',false);
        $('#from_acc').prop('disabled',false);
        $('#loan_type').prop('disabled',false);
        $('#amount').prop('disabled',false);
        $('#vouch_no').prop('disabled',false);
        $('#to_acc').prop('disabled',false);
        $('#advance_type').prop('disabled',false);
        $('.amount_div_show').show();
        
    }
    
     function check_ledger_balance(){
        
    var v_from=$('#from_acc').val();
   
    var data_v="set=check_ledger_balance&ledger="+v_from;
     
    $.ajax({
			type: "POST",
			url: "load_accounts_data.php",
			data: data_v,
			success: function(msg)
			{
                           
          if($.trim(msg)!='ok'){
                               
         $('#from_acc').val('');
                              
         $('#error_pop_v').show();
         $('#error_pop_v').text('NO BALANCE IN LEDGER');
         $('#from_acc').focus();
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
        //window.location.href='loan_advance.php';
        $('.printer_add_popup').removeClass('md-show');
    }
    
    
    function change_adv_type(){
         var type1=$('#advance_type').val();
         
         var type=$('#acc_type').val();
        var data_v="set=check_loan_to_acc&type="+type+"&adv_typ="+type1;
     
        $.ajax({
			type: "POST",
			url: "load_accounts_data.php",
			data: data_v,
			success: function(msg)
			{ 
                            $('.second_div').css('pointer-events','');
                            
                            $('.select_to_acc').html(msg);
                        }
                    });
    }
    
    
    
  function change_loan_adv(){
      
    $('.second_div').show();
    $('.first_div').hide();
    
      var type=$('#acc_type').val();
              
        var data_v="set=check_loan_to_acc&type="+type+"&adv_typ=";
     
        $.ajax({
			type: "POST",
			url: "load_accounts_data.php",
			data: data_v,
			success: function(msg)
			{ 
                            
                            $('.select_to_acc').html(msg);
                        }
                    });
      
     
      if($('#acc_type').val()=='Loan'){
          
          $('.loan_div').show();
          $('.adv_div').hide();
          $('#loan_type').val('');
         $('#advance_type').val('');
          $('.second_div').css('pointer-events','');
         
      }else{
          $('.loan_div').hide();
          $('.adv_div').show();
          $('#loan_type').val('');
         $('#advance_type').val('');
         
         
      }
      
      
      
      
  }
    
    
    
    
function add_contra_voucher()
{      
  var cv_date=$('.cv_date').val();
  var cv_amount=$('#amount').val();
  var cv_from=$('#from_acc').val();
  var cv_to=$('#to_acc').val();
  var cv_trans=$('#trans').val();
  var cv_remarks=$('#remarks').val();
  var cv_type=$('#acc_type').val();       
  var cv_receive=$('#received').val();     
  var cv_type_loan=$('#loan_type').val();     
  var cv_type_adv=$('#advance_type').val();    
     
     if(cv_type_adv!=''){
         
        var  type_l=$('#advance_type').val();    
     }else{
         
         type_l=$('#loan_type').val();  
         
     }
     
     var vouch_no=$('#vouch_no').val();  
           
    if(cv_amount!='' && cv_date!='' && cv_from!='' && cv_to!='' && cv_remarks!='' && cv_type!='' &&  (cv_type_loan!='' || cv_type_adv!='') && vouch_no!='' ){
         
         
         var data_v="set=search_vouch_no&vouch_no="+vouch_no;
      
        $.ajax({
			type: "POST",
			url: "load_accounts_data.php",
			data: data_v,
			success: function(msg1)
			{
                            if($.trim(msg1)!='no'){
                            
                            
        var data_v="set=add_loan_adv_voucher&cv_date="+cv_date+"&cv_amount="+cv_amount+"&cv_from="+cv_from+"&cv_to="+cv_to+"&cv_trans="+cv_trans+
          "&cv_remarks="+cv_remarks+"&cv_type="+cv_type+"&cv_receive="+cv_receive+"&cv_tpe_l="+type_l+"&vouch_no="+vouch_no;
      
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
                        //  setTimeout(function(){
                        //     search_contra();
                        //  // window.location.href='loan_advance.php';                           
                        // }, 500); 
                    
                    search_contra();
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
        $('#error_pop_v').text('VOUCHER NO ALREADY EXIST');
        $('#vouch_no').focus();
        $('#error_pop_v').delay(2000).fadeOut('slow');
    }

                        }
                    });
        
        
    }else{
        
        $('#error_pop_v').show();
        if(cv_remarks==''){
        $('#error_pop_v').text('ENTER PARTICULARS');
        $('#cv_remarks').focus();
         }
         
        if(cv_amount==''){
        $('#error_pop_v').text('ENTER AMOUNT');
        $('#cv_amount').focus();
        }
         
        if(cv_type_adv=='' && cv_type=='Advance' ){            
        $('#error_pop_v').text('SELECT ADVANCE TYPE ');
        $('#advance_type').focus();
         }
         
        if(cv_type_loan=='' && cv_type=='Loan' ){   
        $('#error_pop_v').text('SELECT LOAN TYPE ');
        $('#loan_type').focus();
         }

        if(cv_type==''){            
        $('#error_pop_v').text('SELECT VOUCHER TYPE ');
        $('#acc_type').focus();
         }

        if(cv_to==''){              
        $('#error_pop_v').text('SELECT TO ACCOUNT');
        $('#to_acc').focus();
         }
         
        if(cv_from==''){          
        $('#error_pop_v').text('SELECT FROM ACCOUNT');
        $('#from_acc').focus();
         }
         
        if(vouch_no==''){
        $('#error_pop_v').text('ENTER VOUCHER NO');
        $('#vouch_no').focus();
         }
         
        if(cv_date==''){
        $('#error_pop_v').text('SELECT DATE');
        $('.cv_date').focus();
         }
        $('#error_pop_v').delay(2000).fadeOut('slow');
    }
        
    }
    
   function search_contra()
   {  
       var cv_date_search=$('.search_name').val();
       var cv_date_search_to=$('#datepicker2').val();
       var voucher_type=$('#voucher_type').val();
       var data_v="set=search_loan_adv_voucher&fromdt="+cv_date_search+"&todt="+cv_date_search_to+"&voucher_type="+voucher_type;
    $.ajax({
			type: "POST",
			url: "load_accounts_data.php",
			data: data_v,
			success: function(msg)
			{                         
                $('#load_vendor_data').html(msg);
           }
    });    
   } 
    

    function edit_contra_voucher(vid,to1){
        
        $('#add_btn').hide();
        $('#upd_btn').show();    
        $('.first_div').hide();
        $('.second_div').show();
          
    $('.printer_add_popup').addClass('md-show');
    $('#head_pop').text('UPDATE LOAN-ADVANCE VOUCHER');
    
    $.ajax({
			type: "POST",
			url: "load_accounts_data.php",
			data: "set=edit_loan_adv_voucher&edit_id="+vid,
			success: function(msg)
			{
                            
                       var ed1=$.trim(msg);                   
                       var ed=ed1.split('*');
                         
  $('.cv_date').attr('voucher_update_id',vid);
  $('.cv_date').val(ed[0]);
  $('#from_acc').val(ed[1]);
  $('#amount').val(ed[3]);
  $('#trans').val(ed[4]);
  $('#remarks').val(ed[5]);
  $('#received').val(ed[6]);       
  $('#acc_type').val(ed[7]);
    
    
    if(ed[7]=='Loan'){
        $('.loan_div').show();
        $('.adv_div').hide();
        
         $('#loan_type').val(ed[8]);
         $('#advance_type').val('');
    }else{
        
        $('.loan_div').hide();
        $('.adv_div').show();
        $('#loan_type').val('');
        $('#advance_type').val(ed[8]);
    }
    
     $('#vouch_no').val(ed[9]);
     $('#vouch_no').prop('disabled',true);
     $('#acc_type').prop('disabled',true);    
     $('#from_acc').prop('disabled',true);     
     $('#to_acc').prop('disabled',true);
     $('#advance_type').prop('disabled',true);    
     $('#loan_type').prop('disabled',true);    
      $('#amount').prop('disabled',true);
      $('.amount_div_show').hide();
     //$('#to_acc').val(to1);

    var data_v="set=check_loan_to_acc&type="+ed[7]+"&adv_typ="+ed[8];
   
        $.ajax({
			type: "POST",
			url: "load_accounts_data.php",
			data: data_v,
			success: function(msg)
			{                        
                $('.select_to_acc').html(msg);
                $('#to_acc').val(to1);
            }
         });
         }
        });    
}

function update_contra_voucher(){
     
  var cv_date=$('.cv_date').val();
  var cv_amount=$('#amount').val();
  var cv_from=$('#from_acc').val();
  var cv_to=$('#to_acc').val();
  var cv_trans=$('#trans').val();
  var cv_remarks=$('#remarks').val();
  var cv_type=$('#acc_type').val();       
  var cv_receive=$('#received').val();
  var update_id=$('.cv_date').attr('voucher_update_id');
  var cv_type_loan=$('#loan_type').val();     
     
  var cv_type_adv=$('#advance_type').val();    
     
    
     if(cv_type_adv!=''){
         
        var  type_l=$('#advance_type').val();    
     }else{
         
         type_l=$('#loan_type').val();  
         
     }
    
           
    if(cv_amount!='' && cv_date!='' && cv_from!='' && cv_to!='' && cv_remarks!='' && cv_type!='' && (cv_type_loan!='' || cv_type_adv!='')  ){
        
        var data_v="set=update_loan_adv_voucher&cv_date="+cv_date+"&cv_amount="+cv_amount+"&cv_from="+cv_from+"&cv_to="+cv_to+"&cv_trans="+cv_trans+
          "&cv_remarks="+cv_remarks+"&update_id="+update_id+"&cv_type="+cv_type+"&cv_receive="+cv_receive+"&cv_type_l="+type_l;
        
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

                        //  setTimeout(function(){
                        //     search_contra();  
                        //  //window.location.href='loan_advance.php';
                            
                        // }, 100); 
                        
                        search_contra();
                        
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
        
        if(cv_remarks==''){
        $('#error_pop_v').text('ENTER PARTICULARS');
        $('#cv_remarks').focus();
         }
        
        
        if(cv_amount==''){
        $('#error_pop_v').text('ENTER AMOUNT');
        $('#cv_amount').focus();
         }
         
         if(cv_type_adv=='' && cv_type=='Advance' ){
        $('#error_pop_v').text('SELECT ADVANCE TYPE ');
        $('#advance_type').focus();
         }
         
         if(cv_type_loan=='' && cv_type=='Loan' ){
        $('#error_pop_v').text('SELECT LOAN TYPE ');
        $('#loan_type').focus();
         }
         
         
         
         if(cv_type==''){
        $('#error_pop_v').text('SELECT ACC TYPE');
        $('#acc_type').focus();
         }
         
        if(cv_to==''){
        $('#error_pop_v').text('SELECT TO ACC ');
        $('#cv_to').focus();
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
</body>
</html>
