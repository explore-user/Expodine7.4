<?php
include('../includes/session.php');		
//session_start();
include("../database.class.php"); 
$database	= new Database();


    
     
       
    

?>
<!doctype html>
<html ng-app="website">
<head>
<meta charset="utf-8">
<title>Accounts Name</title>
<meta name="description" content="">
<link href="../images/favicon.png" rel="shortcut icon">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<link rel="shortcut icon" href="../img/favicon.ico">
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
    $(document).ready(function () {
        
    search_acc();   

    var today = $("#today").val();
    $.ajax({
            type: "POST",
            url: "load_ledger.php",
            data: "set=open_ledger_daywise&date="+today,
            success: function(msg1)
            {                           
       $.ajax({
            type: "POST",
            url: "load_ledger.php",
            data: "set=close_ledger_daywise&date="+today,
            success: function(msg)
            {
                               
            }
            });    
            }
          });
    
    
        });          
        
        

function ledger_update()
{
    var group=$('#ledger_group').val();
    var name=$('#ledger_name').val();
    var ledger_balance=$('#ledger_balance').val();
    var old_ledger_balance=$('#old_ledger_balance').val();
    var id=$('#upd_btn_ledger').attr('grp_id_upd_ledger');
    var type=$('#ledger_type').val();        
    var capital_cash_bank=$('#capital_cash_bank').val();
        
    if(group!='' && name!='' && ledger_balance!='')
    {
       
        if(type=='Capital' && capital_cash_bank==''){   
            
            $('#error_pop').show();
            $('#capital_cash_bank').focus();
            $('#error_pop').text('SELECT CAPITAL ACCOUNT BANK OR CASH ');
            $('#error_pop').delay(2000).fadeOut('slow');                       
            exit;   
          } 

          
          $.ajax({
			type: "POST",
			url: "load_accounts_data.php",
			data: "set=check_account_name_cash&type="+type,
			success: function(msg12)
			{ 
                            
                       if($.trim(msg12)!='yes' || type !='Cash_account' || (type =='Cash_account' && old_ledger_balance!=ledger_balance) ){ 
                   
                                    $.ajax({
			            type: "POST",
			            url: "load_accounts_data.php",
			            data: "set=check_account_name_purchase&group="+group,
			            success: function(msg123)
			            {   
                                            $.ajax({
			                    type: "POST",
			                    url: "load_ledger.php",
			                    data: "set=update_ledger&group_id="+group+"&ledger="+name+"&id="+id+"&ledger_balance="+ledger_balance+
                                            "&type="+type+"&capital_cash_bank="+capital_cash_bank+"&old_ledger_balance="+old_ledger_balance,
			                    success: function(msg)
			                    {       
                                    $('#error_pop').show();
                                    $('#error_pop').text('Ledger Updated');
                                    $('#error_pop').delay(2000).fadeOut('slow');
                 
                                    $("#ledger_name").val('');
                                    $("#ledger_group").val('');
                                    $("#ledger_balance").val('');
                                    $("#ledger_type").val('');

                                    $('#ledger_name').prop('disabled',false);
                                    $('#ledger_group').prop('disabled',false);
                                    $('#ledger_type').val('Normal');

                                    $('#add_btn_ledger').show();
                                    $('#upd_btn_ledger').hide();

                                    setTimeout(function(){                  
                                      search_acc();                         
                                    }, 500);                                                         
                                }
                                });
                        }
                    });
                }
                else
                {          
                   $('#error_pop').show();
                   $('#error_pop').text('CASH ACCOUNT ALREADY EXIST');
                   $('#ledger_name').focus(); 
                   $('#error_pop').delay(2000).fadeOut('slow');                      
                }
            }
        });
    
    
    }else{
                    
                $('#error_pop').show();                   
                if(ledger_balance=='')
                {
                    $('#error_pop').text('Enter Balance As Zero or Greater Than Zero ');
                    $('#ledger_balance').focus();
                 }                                                             
                    $('#error_pop').delay(1000).fadeOut('slow');
        }               
}

function ledger_add()
{
    var name=$('#ledger_name').val();
    var group=$('#ledger_group').val();
    var ledger_balance=$('#ledger_balance').val();
    var type=$('#ledger_type').val();
    var capital_cash_bank=$('#capital_cash_bank').val();
      
    if(group!='' && name!='' && ledger_balance!='' )
    {                  
        if(type=='Capital' && capital_cash_bank=='')
        {
        $('#error_pop').show();
        $('#capital_cash_bank').focus();
        $('#error_pop').text('SELECT CAPITAL ACCOUNT BANK OR CASH ');
        $('#error_pop').delay(2000).fadeOut('slow');
        exit;   
        }
          
        $.ajax({
			type: "POST",
			url: "load_accounts_data.php",
			data: "set=check_account_name&name="+name,
			success: function(msg1)
			{
                            
        if($.trim(msg1)!='yes'){ //account name not exist
     
        $.ajax({
			type: "POST",
			url: "load_accounts_data.php",
			data: "set=check_account_name_cash&type="+type,
			success: function(msg12)
			{                                                     
                if($.trim(msg12)!='yes' || type !='Cash_account' ){  //account type exist/not exist and type!=Cash_account      
                    $.ajax({
			            type: "POST",
			            url: "load_accounts_data.php",
			            data: "set=check_account_name_purchase&group="+group,
			            success: function(msg123)
			            {                                
                        if($.trim(msg123)!='yes' || group!='66' ){
                            $.ajax({
			                    type: "POST",
			                    url: "load_ledger.php",
			                    data: "set=add_ledger&group_id="+group+"&ledger="+name+"&ledger_balance="+ledger_balance+"&type="+type+"&capital_cash_bank="+capital_cash_bank,
			                    success: function(msg)
			                    {
                        $('#error_pop').show();                         
                        $('#error_pop').text('Account Created');
                        $('#error_pop').delay(2000).fadeOut('slow');

                        $("#ledger_name").val('');
                        $("#ledger_group").val('');
                        $("#ledger_balance").val('');
                        $("#ledger_type").val('Normal');
                      
                         setTimeout(function(){
                        
                         search_acc();
                         
                        }, 500); 
                             
                             
                        }
                    });
                    
                    }else{
                        
                         $('#error_pop').show();
                         $('#error_pop').text('PURCHASE RETURN ALREADY EXIST');
                         $('#ledger_name').focus(); 
                         $('#error_pop').delay(2000).fadeOut('slow');
                       
                    } 
                    }
                    });
                     }else
                     {
                        
                        $('#error_pop').show();
                        $('#error_pop').text('CASH ACCOUNT ALREADY EXIST');
                        $('#ledger_name').focus(); 
                        $('#error_pop').delay(2000).fadeOut('slow');                      
                    } 
                    
                     }
                    });  
                    
                    
                    }
                    else{ 
                        
                      $('#error_pop').show();
                      $('#error_pop').text('ACC NAME ALREADY EXIST ');
                      $('#ledger_name').focus(); 
                      $('#error_pop').delay(2000).fadeOut('slow');
                       
                    }                    
                    
                    }
                    });  
                     
                    
                    
                }else{
                    
                    $('#error_pop').show();
                    
                if(ledger_balance==''){
                       $('#error_pop').text('Enter Balance As Zero or Greater Than Zero ');
                       $('#ledger_balance').focus();
                 }
                 if(group==''){
                      $('#error_pop').text('Select Group ');
                      $('#ledger_group').focus();
                 }
                 
                if(name==''){
                     $('#error_pop').text('Enter Account Name');
                     $('#ledger_name').focus();
                 }
                 
                      $('#error_pop').delay(2000).fadeOut('slow');
                }
      
      
    
}


function edit_ledger(n,g,i,open,type,cb){
  
       $('#add_btn_ledger').hide();
       $('#upd_btn_ledger').show();
              
       $('#ledger_name').val(n);
       $('#ledger_group').val(g);      
       
       if(type=='Capital'){
           $('.bank_cash_div').show();
       }else{
           $('.bank_cash_div').hide();
       }
             
       $('#capital_cash_bank').val(cb);
       $('#ledger_type').val(type);
       $('#ledger_name').prop('disabled',true);
       $('#ledger_group').prop('disabled',true);
       $('#ledger_balance').val(open);
       $('#old_ledger_balance').val(open);
       $('#ledger_balance').focus();
       $('#upd_btn_ledger').attr('grp_id_upd_ledger', i);             
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
.acc_table_scroll tbody {height: 56vh;}
</style>

<link rel="stylesheet" href="../css/jquery-ui.css">
  <!-- <script src="js/jquery-ui.js"></script> -->
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
                                <h3 class="ledger_head">ACCOUNTS NAME  <span style="font-size:13px;font-weight: bold"> . Start Date : <?=$_SESSION['be_accounts_start_date']?></span>
    <span class="dashed-blink" id="error_ledger" style="font-weight: bold;float:right;color:black;display: block;font-size: 12px;background-color: #ff4229;border-radius: 8px;padding: 4px ">
        PLEASE ADD ACCOUNTS OPENING BALANCE FOR PAYMENTS
    </span>
                                </h3>
                                
                        <style>
                        .dashed-blink{
                                padding: 12px 18px;
                                border: 3px dashed #ffb400;
                                display: inline-block;
                                animation: dashedBlink 1s steps(2, start) infinite;
                              }

                              @keyframes dashedBlink {
                                0%   { border-color: white; opacity: 5; }
                                50%  { border-color: transparent; opacity: 0.9; }
                                100% { border-color: black; opacity: 5; }
                              }
                        </style>

                                <div class="acc_add_box" style="width:20%;">
                             	   
                                    <input type="text" class="form-control filte_new_box" id="ledger_name"  name="" placeholder="Account Name">
                                </div>
                                <div class="acc_add_box" style="width:16%;">
                             	    
                                    <select id="ledger_group" class="form-control filte_new_box">
                                        <option value="">Select Group </option>
                                         <?php
                                       
                    $sql_login  =  $database->mysqlQuery("select tlg_id,tlg_name from tbl_ledger_group where tlg_status='Y' "); 
					$num_login   = $database->mysqlNumRows($sql_login);
					if($num_login){
					while($result_login  = $database->mysqlFetchArray($sql_login)) 
					{?>   
                                        <option value="<?=$result_login['tlg_id']?>"><?=$result_login['tlg_name'] ?></option>
                                        <?php } } ?>
                                        
                                    </select>
                                </div>
                                
                                <div class="acc_add_box" style="width:16%;">
                             	   
                                    <input type="text" class="form-control filte_new_box" maxlength="15" id="ledger_balance" name="" placeholder="Opening Balance">
                                </div>
                                
                                <input type="hidden" id="old_ledger_balance" name="old_ledger_balance">

                                <div class="acc_add_box" style="width:15%;">
                             	    
                                    <select id="ledger_type" class="form-control filte_new_box" onchange="change_type();">
                                        <option value="Normal">Normal </option>
                                        <option value="Cash_account">Cash Acc</option>
                                         <option value="Bank_account">Bank Acc</option>
                                         <option value="Sales">Sales</option>
                                        <option value="Credit">Credit </option>
                                        <option value="Complimentary">Complimentary</option>
                                        <option value="Capital">Capital</option>
                                       
                                        
                                    </select>
                                </div>
                                
                                <div class="acc_add_box bank_cash_div" style="width:10%;display: none">
                             	    
                                    <select id="capital_cash_bank" class="form-control filte_new_box">
                                        <option value="">SELECT</option>
                                        <?php
                                       
                    $sql_login  =  $database->mysqlQuery("select tlm_id,tlm_ledger_name from tbl_ledger_master where (tlm_type='Cash_account' or tlm_type='Bank_account')  "); 
					$num_login   = $database->mysqlNumRows($sql_login);
					if($num_login){
					while($result_login  = $database->mysqlFetchArray($sql_login)) 
					{?>   
                                        <option value="<?=$result_login['tlm_id']?>"><?=$result_login['tlm_ledger_name'] ?></option>
                                        <?php } } ?>
                                    </select>
                                </div>
                                
                                
                                
                                <div style="margin-left:2%;width: 18%;" class="search_btn_member_invoice filte_new_box_btn">
                                <a id="add_btn_ledger" onclick="return ledger_add();" style="margin-top:0;cursor: pointer;width: 50px;"  >ADD</a>
                                <a id="upd_btn_ledger" onclick="return ledger_update();" style="margin-top:0;display: none;width: 50px; "  href="#">UPDATE</a></div>
                            </div>  

                            
                            <div class="ledger_head_sec" style="">  
                                <h5 class="ledger_head">Search </h5>
                             <div class="acc_add_box" style="width:20%;">
                             	   
                                 <input type="text" class="form-control filte_new_box" onkeyup="search_acc();" id="search_name" name="" placeholder="Acc Name">
                                </div>
                                
                                
                                 <div class="acc_add_box" style="width:20%;">
                             	    
                                     <select id="search_group" onchange="search_acc();" class="form-control filte_new_box">
                                        <option value="">Search Group </option>
                                         <?php
                                       
                                          $sql_login  =  $database->mysqlQuery("select tlg_id,tlg_name from tbl_ledger_group where tlg_status='Y' "); 
					$num_login   = $database->mysqlNumRows($sql_login);
					if($num_login){
					while($result_login  = $database->mysqlFetchArray($sql_login)) 
					{?>   
                                        <option value="<?=$result_login['tlg_id']?>"><?=$result_login['tlg_name'] ?></option>
                                        <?php } } ?>
                                        
                                    </select>
                                </div>
                                <div class="acc_add_box" style="width:15%;">                            	    
                                    <select id="search_type" class="form-control filte_new_box" onchange="search_acc();">
                                        <option value="">Search Type </option>
                                        <option value="Normal">Normal </option>
                                        <option value="Cash_account">Cash Acc</option>
                                        <option value="Bank_account">Bank Acc</option>
                                        <option value="Sales">Sales</option>
                                        <option value="Credit">Credit </option>
                                        <option value="Complimentary">Complimentary</option>
                                        <option value="Capital">Capital</option>
                                    </select>
                                </div>
                              
                                <?php if($_SESSION['expodine_id']=='admin') {  ?>  
                                <i onclick="set_acc_date()"  title="ACCOUNTS START DATE" class="fa fa-calendar" style="font-size: 15px;float: right;margin-right: 295px;margin-top: 10px;cursor: pointer"></i>                          
                                <?php }else{  ?>  
                                 <i  title="ACCOUNTS START DATE IS <?=$_SESSION['be_accounts_start_date']?> . CAN BE CHANGE TO TODAY BY ADMIN LOGIN ONLY" class="fa fa-calendar" style="font-size: 15px;float: right;margin-right: 300px;margin-top: 10px;cursor: pointer"></i>                          
                               
                                 <?php }  ?>  
                                
                                <span class="dashed-blink" id="error_ledger" style="margin-top: -25px;font-weight: bold;float:right;color:black;display: block;font-size: 12px;background-color: #ff4229;border-radius: 8px;padding: 4px ">
                                     PLEASE SET  ACCOUNTS START DATE FOR  PAYMENTS
                                 </span>


                                </div>
                            
                            <div class="ledger_list_sec" style="position:relative">
                                <!-- <h3 style="font-size:18px" class="ledger_head"> &nbsp;</h3> -->
                                <div style="position:absolute;width: 120px;right:9px;top:3px;height: 33px;float: left" class="search_btn_member_invoice filte_new_box_btn">
                                   
                                    <a class="md-trigger" data-modal="modal-17" style="background-color:#314b6b;margin:0;line-height: 32px;display: none" onclick="return pop_on();" href="#">ADD PAYMENT</a></div>
                             
                                <div class="ledger_list_scr">
                                    <table class="acc_table_scroll">
                                        <thead>
                                            <tr>
                                                 <td style="min-width:10px;max-width:10px">SL</td>
                                                <td style="min-width:25px;max-width:25px">Account Name</td>
                                                <td style="min-width:25px;max-width:25px">Group Name</td>
                                                <td style="min-width:25px;max-width:25px">Type</td>
                                                <td style="min-width:25px;max-width:25px">Opening Balance</td>
                                                <td style="min-width:15px;max-width:15px">Action</td>
                                             
                                            </tr>
                                        </thead>
                                        <tbody id="load_acc_new">

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
                 
            <strong class="alert_error_popup" style="display: none" id="error_pop"> </strong>

            
<script src="../master_style/js/classie.js"></script>
<script src="../master_style/js/modalEffects.js"></script>
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="../js/jquery.cookie.js"></script>

<script type="text/javascript" src="../js/jquery.tablesorter.js"></script>
<script type="text/javascript" id="js">
$(document).ready(function() {
    

    
    
    
    //  $.ajax({
	// 		type: "POST",
	// 		url: "load_ledger.php",
	// 		data: "set=serach_acc_name&acc_name=&acc_group=&type=",
	// 		success: function(msg)
	// 		{
    //                         $('#load_acc_new').html(msg);
                            
    //                     }
    //                 });
    
    
   $("#listall").tablesorter();
   
    
    $('#ledger_balance').keypress(function(event) {

     if(event.which == 8 || event.keyCode == 37 || event.keyCode == 39 || event.keyCode == 46) 
          return true;

     else if((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57))
          event.preventDefault();

});
   
   
   
}); 

function set_acc_date(){
    
    
    if (confirm("Are you sure you want to set today's date as accounting module start date ?")) {
        
        
         $.ajax({
			type: "POST",
			url: "load_ledger.php",
			data: "set=set_acc_date_new",
			success: function(msg)
			{
                                 location.reload();             
            }
            });
        
    }
    
}



function change_type(){
    
    
    var typ=$('#ledger_type').val();
    
    
    if(typ=='Capital'){
        
        $('.bank_cash_div').show();
        
    }else{
          $('.bank_cash_div').hide();
    }
    
}

function search_acc(){

   var name=$('#search_name').val();
   var group=$('#search_group').val();
   var type=$('#search_type').val();
   
        $.ajax({
			type: "POST",
			url: "load_ledger.php",
			data: "set=serach_acc_name&acc_name="+name+"&acc_group="+group+"&type="+type,
			success: function(msg)
			{
                $('#load_acc_new').html(msg);                           
            }
            });
}

function ledger_change(){
    
   var ledger_id=$('#ledger_change').val();
   
        $.ajax({
			type: "POST",
			url: "load_ledger.php",
			data: "set=ledger_change&ledger_id="+ledger_id,
			success: function(msg)
			{
                            
                var typ=$.trim(msg);                           
                var typ1=typ.split('*');
                            
                $('#group_name').focus();
                $('#lab_grp').hide();
                $('#lab_type_pay').hide();
                $('#group_name').val(typ1[0]);
                $('#group_type_pay').val(typ1[1]);                            
                $('#group_name').attr('grp_id', typ1[2]);
                                                         
                if(ledger_id==''){
                   $('#lab_grp').show();
                   $('#lab_type_pay').show();
                }                          
            }
            });
   
   
}


function voucher_change(){
    
    var v_type=$('#voucher_type').val();
    
    if(v_type=='journal_voucher'){
        
        $('#mode_of_pay').val('Credit');
        $("#mode_of_pay").prop("disabled", true);  
    }else{
         $('#mode_of_pay').val('');
         $("#mode_of_pay").prop("disabled", false);  
    }
    
    
    if(v_type=='contra_voucher'){
           $('#contra_dep_withdraw').show();
            $('#cheq_dd_div').show();
        
    }else{
         $('#contra_dep_withdraw').hide();
         $('#cheq_dd_div').hide();
    }
    
    
     
}


function pay_change(){
    
    var mode= $('#mode_of_pay').val();
    
    if(mode=='Bank'){
        $('#bank_div').show();
    }else{
        $('#bank_div').hide();
    }
    
    
    
}


function cheq_dd_change(){
    
    var type1=$('#contra_type_pay').val();
  
  
  if(type1!=''){
      
    if(type1=='cheque'){
       
        $('#cheque_div').show();
          $('#dd_div').hide();
            $('#cheque_no').val('');
          
    }else{
        $('#cheque_div').hide();
          $('#dd_div').show();
           $('#dd_no').val('');
    }
    }else{
        $('#cheque_div').hide();
          $('#dd_div').hide();
    }
}


function pop_on(){
    
    $('#ledger_change').val('');
    $('#group_name').val('');
     $('#voucher_type').val('');
      $('#mode_of_pay').val('');
       $('#contra_type').val('');
        $('#contra_type_pay').val('');
         $('#group_type_pay').val('');
          $('#bank_acc_no').val('');
           $('#amount').val('');
            $('#cheque_no').val(''); 
            $('#dd_no').val('');
             $('#voucher_no').val('');
             $('#narration').val('');
             $('#dd_no').val('');
             
             
               $('#bank_div').hide();
              $('#lab_grp').show();
              $('#lab_type_pay').show();
              
              
                 $('#contra_dep_withdraw').hide();
                 $('#cheq_dd_div').hide();
                    $('#cheque_div').hide();
                     $('#dd_div').hide();
            
            
    
}

function submit_ledger(){
    var ledger=$('#ledger_change').val();
     var group=$('#group_name').attr("grp_id");
     var amount= $('#amount').val();
       var voucher= $('#voucher_type').val();
        var mode_of_pay= $('#mode_of_pay').val();
         var bank_acc_no = $('#bank_acc_no').val();
         var voucher_no = $('#voucher_no').val();
         var entry_type=   $('#contra_type').val();
          var entry_type_pay = $('#contra_type_pay').val();
          var cheq_no  = $('#cheque_no').val();
           var dd_no  = $('#dd_no').val();
           var group_type_pay  = $('#group_type_pay').val();
           var remark= $('#narration').val();
          
    
    if(ledger!=''){
        
         if(voucher==''){ $('#error_pop').show(); $('#error_pop').text('Select Voucher '); $('#error_pop').delay(2000).fadeOut('slow'); exit(); }
         
         if(mode_of_pay==''){ $('#error_pop').show(); $('#error_pop').text('Select Transaction Mode'); $('#error_pop').delay(2000).fadeOut('slow'); exit(); }
        
         if(mode_of_pay=='Bank' && bank_acc_no==''){$('#bank_acc_no').focus(); $('#error_pop').show(); $('#error_pop').text('Enter Bank Acc No'); $('#error_pop').delay(2000).fadeOut('slow'); exit(); }
           
         if(voucher=='contra_voucher' && entry_type=='' ){ $('#error_pop').show(); $('#error_pop').text('Select Entry Type'); $('#error_pop').delay(2000).fadeOut('slow'); exit(); }
         
          if(voucher=='contra_voucher' && entry_type_pay=='' ){ $('#error_pop').show(); $('#error_pop').text('Select Payment Type'); $('#error_pop').delay(2000).fadeOut('slow'); exit(); }
        
        if(entry_type_pay=='dd' && dd_no=='' ){ $('#dd_no').focus(); $('#error_pop').show(); $('#error_pop').text('  Enter DD No'); $('#error_pop').delay(2000).fadeOut('slow'); exit(); }
            
        if(entry_type_pay=='cheque' && cheq_no=='' ){ $('#cheque_no').focus();  $('#error_pop').show(); $('#error_pop').text('Enter Cheque No'); $('#error_pop').delay(2000).fadeOut('slow'); exit(); }   
            
        if(amount==''){ $('#amount').focus(); $('#error_pop').show(); $('#error_pop').text('Enter Amount'); $('#error_pop').delay(2000).fadeOut('slow'); exit(); }
        
        if(voucher_no==''){ $('#voucher_no').focus(); $('#error_pop').show(); $('#error_pop').text('Enter Voucher No'); $('#error_pop').delay(2000).fadeOut('slow'); exit(); }
        
     $.ajax({
			type: "POST",
			url: "load_ledger.php",
			data: "set=submit_ledger&ledger="+ledger+"&group="+group+"&amount="+amount+"&voucher="+voucher+
                                "&mode_of_pay="+mode_of_pay+"&bank_acc_no="+bank_acc_no+"&voucher_no="+voucher_no+
                                "&entry_type="+entry_type+"&entry_type_pay="+entry_type_pay+"&cheq_no="+cheq_no+
                                "&dd_no="+dd_no+"&group_type_pay="+group_type_pay+"&remark="+remark,
			success: function(msg)
			{
                        $('#error_pop').show();
                        $('#error_pop').text('Ledger Created');
                        $('#error_pop').delay(2000).fadeOut('slow');
                      
                         setTimeout(function(){
                           window.location.href='accounts_name.php';
                            
                        }, 500); 
                             
                             
                        }
                    });
                }else{
                    $('#error_pop').show();
                    $('#error_pop').text('Select Ledger');
                    $('#error_pop').delay(1000).fadeOut('slow');
                }
}
</script>

<div style="position:fixed;width:100%;left:30%;top:0%;z-index:99999;" class="mynewpopupload"  ></div>
</body>
</html>
