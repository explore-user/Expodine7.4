<?php

include('../includes/session.php');		
//session_start();
include("../database.class.php"); 
$database	= new Database();


    ////////DEFAULT ACCOUNT ADD SETUP //////

    $date_acc=  date('Y-m-d');

    $sql_login  =  $database->mysqlQuery("INSERT INTO tbl_ledger_master (tlm_ledger_name, tlm_group, tlm_open_bal, tlm_type)
    VALUES ('Cash Account','68','1000','Cash_account')");
    
    $sql_login1  =  $database->mysqlQuery("INSERT INTO tbl_ledger_master (tlm_ledger_name, tlm_group, tlm_open_bal, tlm_type)
    VALUES ('Bank Account','69','1000','Bank_account')");
    
    
     $sql_kotlist665  =  $database->mysqlQuery("SELECT v_id from tbl_vendor_master where v_name='Supplier_A' "); 
	$num_kotlist665  = $database->mysqlNumRows($sql_kotlist665);
	if(!$num_kotlist665){
            
            $sql_table=  $database->mysqlQuery("INSERT INTO `tbl_vendor_master`(`v_name`, `v_branchid`, `v_address`,"
                  . " `v_city`, `v_state`, `v_country`, `v_email`, `v_contact_no`, `v_tin_no`, `gst`, `v_srvctax_reg_no`,"
                  . " `v_pan`, `v_bank_name`, `v_branch_name`, `v_acct_no`, `v_ifsc`, `v_mode_of_pay`, `v_credit_period`, "
                  . " `v_favour`, `v_conc_name`, `v_conc_desg`, `v_conc_contact`, `v_conc_email`, `v_active`, `cloud_sync`,v_entry_type,v_entry_date) "
                  . "VALUES ('Supplier_A','1','Test','0','0','0','Test@gmail.com','0','0','0', '0','0','0','0',"
                  . " '0','0','0','0','0', '0','0','0', '0','Y','N','Normal','$date_acc') "); 
    
        $sql_kotlist665  =  $database->mysqlQuery("SELECT MAX(v_id) as v_new_id from tbl_vendor_master "); 
	$num_kotlist665  = $database->mysqlNumRows($sql_kotlist665);
	if($num_kotlist665){
	while($result_kotlist665  = $database->mysqlFetchArray($sql_kotlist665)) 
	{ 
              $cr_vendor=$result_kotlist665['v_new_id'];
        } }
    
       $sql_login2  =  $database->mysqlQuery("INSERT INTO tbl_ledger_master (tlm_ledger_name, tlm_group, tlm_open_bal, tlm_type,tlm_vendor_id)
       VALUES ('Supplier_A','20','0','Normal','$cr_vendor')");
    
        }
    
        
       $sql_login3  =  $database->mysqlQuery("INSERT INTO tbl_ledger_master (tlm_ledger_name, tlm_group, tlm_open_bal, tlm_type)
       VALUES ('Transportation','56','0','Normal')");
       
       $sql_login4  =  $database->mysqlQuery("INSERT INTO tbl_ledger_master (tlm_ledger_name, tlm_group, tlm_open_bal, tlm_type)
       VALUES ('Rent','57','0','Normal')");
       
       
       $sql_login5 =  $database->mysqlQuery("INSERT INTO tbl_ledger_master (tlm_ledger_name, tlm_group, tlm_open_bal, tlm_type)
       VALUES ('Loading-Unloading Charges','56','0','Normal')");
       
       $sql_login6  =  $database->mysqlQuery("INSERT INTO tbl_ledger_master (tlm_ledger_name, tlm_group, tlm_open_bal, tlm_type)
       VALUES ('Electricity Bill','57','0','Normal')");
       
        $led_id=0;
        $sql_kotlist66  =  $database->mysqlQuery("SELECT tlm_id from tbl_ledger_master where  tlm_type='Cash_account' limit 1");
        $num_kotlist66  = $database->mysqlNumRows($sql_kotlist66);
	if($num_kotlist66){
	while($result_kotlist66  = $database->mysqlFetchArray($sql_kotlist66)) 
	{ 
              $led_id=$result_kotlist66['tlm_id'];
        } }
        
       $sql_login7  =  $database->mysqlQuery("INSERT INTO tbl_ledger_master (tlm_ledger_name, tlm_group, tlm_open_bal, tlm_type,tlm_capital_cb)
       VALUES ('Capital Account','62','1000','Capital','$led_id')");
       
       $sql_login8  =  $database->mysqlQuery("INSERT INTO tbl_ledger_master (tlm_ledger_name, tlm_group, tlm_open_bal, tlm_type)
       VALUES ('Staff Wages','56','0','Normal')");
       
        $sql_login9  =  $database->mysqlQuery("INSERT INTO tbl_ledger_master (tlm_ledger_name, tlm_group, tlm_open_bal, tlm_type)
       VALUES ('Advertising-Marketing','57','0','Normal')");
        
         $sql_login10  =  $database->mysqlQuery("INSERT INTO tbl_ledger_master (tlm_ledger_name, tlm_group, tlm_open_bal, tlm_type)
       VALUES ('Goods Purchase','56','0','Normal')");
         
          $sql_login11  =  $database->mysqlQuery("INSERT INTO tbl_ledger_master (tlm_ledger_name, tlm_group, tlm_open_bal, tlm_type)
       VALUES ('Accounts-Software Charges','57','0','Normal')");
         
        
        
       
        
       /////end//////



?>
<!doctype html>
<html ng-app="website">
<head>
<meta charset="utf-8">
<title>Accounts Head</title>
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
.ledger_list_scr table{width:100%;height:auto;float:left;}
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
                                <h3 class="ledger_head">ACCOUNTS HEAD</h3>
                                 
                                <div class="acc_add_box" style="width:30%;">
                             	      NAME
                                    <input type="text" class="form-control filte_new_box" id="group"  onkeyup="list_account_heads();"  placeholder="Acc Head">
                                    
                                    
                                </div>
                                 <div class="acc_add_box" style="width:15%;display: none">
                             	   
                                   
                                    <select id="mode_of_group" class="form-control filte_new_box" >
                                        <option value=""> Mode </option>
                                         <option value="Debit"> Debit </option>
                                          <option value="Credit"> Credit </option>
                                    </select>
                                    
                                    
                                </div>
                                
                                
                                <div class="acc_add_box" style="width:20%;">
                             	   
                                   ASSET-LIABILITY [BL]
                                    <select id="type_of_group" class="form-control filte_new_box" onchange="list_account_heads();" >
                                        <option value=""> Select </option>
                                         <option value="asset"> Asset </option>
                                          <option value="liability"> Liability </option>
                                         
                                    </select>
                                    
                                </div>
                                
                                
                                <div class="acc_add_box" style="width:20%;">
                             	   
                                   EXPENSE-INCOME [P&L]
                                    <select id="type_of_exp_inc" class="form-control filte_new_box"  onchange="list_account_heads();"  >
                                        <option value=""> Select </option>
                                         
                                          <option value="expense"> Expense </option>
                                          <option value="income"> Income </option>
                                    </select>
                                    
                                </div>
                                
                                

                                <div class="acc_add_box" style="width:15%;display: none" id="status_div">
                             	   
                                   
                                    <select id="status_group" class="form-control filte_new_box" style="margin-top: 20px;">
                                        <option value=""> Status </option>
                                         <option value="Y"> Active </option>
                                          <option value="N"> Inactive </option>
                                    </select>
                                    
                                    
                                </div>
                                
                                
                                <div style="margin-left:2%;width:12%;" class="search_btn_member_invoice filte_new_box_btn">
                                    
                                    <a id="add_btn"  style="margin-top:0;cursor: pointer;pointer-events: none;display:none" onclick="return add_group();" >ADD</a>
                                     <a id="upd_btn" href="#" style="margin-top:20px;display: none" onclick="return update_group();" >UPDATE</a>
                                     </div>
                               <strong class="alert_error_popup" style="display: none" id="error_pop"> </strong>

                            </div>  

                            <div class="ledger_list_sec">
                               
                                <div class="ledger_list_scr">
                                    <table class="acc_table_scroll">
                                        <thead>
                                            <tr>
                                                 <td style="width:10%">SL</td>
                                                <td style="width:30%">NAME</td>
                                                
                                                 <td style="width:18%">BL </td>
                                                 <td style="width:18%">P & L</td>
                                                 
                                                 <td style="width:18%">STATUS</td>
                                                <td style="width:25%" >ACTION</td>
                                            </tr>
                                        </thead>
                                        <tbody id="load_acc_heads">
                                      
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
<script type="text/javascript" id="js">

    
$(document).ready(function () 
{
     list_account_heads();
          
//   $("#datepickerfrom").datepicker({
//       changeMonth: true,
//       changeYear: true,
// 	  maxDate: "+0D "
//     });
// 	 $("#datepickertodt").datepicker({
//       changeMonth: true,
//      changeYear: true,
// 	  maxDate: "+0D "
//     });
});  

$(document).ready(function() {
   $("#listall").tablesorter();
   
    
    $('#amount').keypress(function(event) {

     if(event.which == 8 || event.keyCode == 37 || event.keyCode == 39 || event.keyCode == 46) 
          return true;

     else if((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57))
          event.preventDefault();

});
   
   
   
}); 


function ledger_change()
{
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


        
        
    function list_account_heads()
    {
        var group=$('#group').val();
        var type_of_group=$('#type_of_group').val();
        var type_of_exp_inc=$('#type_of_exp_inc').val();
   
        $.ajax({
			type: "POST",
			url: "load_ledger.php",
			data: "set=list_account_heads&group="+group+"&type_of_group="+type_of_group+"&type_of_exp_inc="+type_of_exp_inc,
			success: function(msg)
			{
                $('#load_acc_heads').html(msg);                          
            }
            });
    }
        
    function update_group()
    {
        var group=$('#group').val();
        var status_group=$('#status_group').val();
        var type_of_group=$('#type_of_group').val();
        var type_of_exp_inc=$('#type_of_exp_inc').val();
        var id=$('#upd_btn').attr('grp_id_upd');
    
    if(group!=''  && (type_of_group!='' || type_of_exp_inc!='') && status_group!='')
    { 
     $.ajax({
			type: "POST",
			url: "load_ledger.php",
			data: "set=update_group&group_name="+group+"&status_group="+status_group+"&type_of_group="+type_of_group+"&id="+id+"&type_of_exp_inc="+type_of_exp_inc,
			success: function(msg)
			{
                        $('#error_pop').show();
                        $('#error_pop').text('Group Updated');
                        $('#error_pop').delay(2000).fadeOut('slow');
                      
                         setTimeout(function()
                         {
                           window.location.href='ledger.php';                           
                        }, 500); 
            }
        });
    }else
    {
        $('#error_pop').show();
        if(group=='')
        {
            $('#error_pop').text('Enter Group Name ');
        }else if(type_of_group=='' && type_of_exp_inc=='')
        {
            $('#error_pop').text('Select Any Type');
        }else{
            $('#error_pop').text('Select Status');
        }                     
        $('#error_pop').delay(1000).fadeOut('slow');
    }
    }  
        
        
        
  function add_group()
  {
    var group=$('#group').val();
    var mode_of_group=$('#mode_of_group').val();
    var type_of_group=$('#type_of_group').val();
    var type_of_exp_inc=$('#type_of_exp_inc').val();
    
    if(group!=''  && (type_of_group!='' || type_of_exp_inc!=''))
    {  
     $.ajax({
			type: "POST",
			url: "load_ledger.php",
			data: "set=add_group&group_name="+group+"&group_mode="+mode_of_group+"&type_of_group="+type_of_group+"&type_of_exp_inc="+type_of_exp_inc,
			success: function(msg)
			{
                $('#error_pop').show();
                $('#error_pop').text('Group Added');
                $('#error_pop').delay(2000).fadeOut('slow');
                      
                setTimeout(function(){
                    window.location.href='ledger.php';
                    }, 500);     
            }
            });
    }else{
            $('#error_pop').show();
            if(group=='')
            {
                $('#error_pop').text('Enter Group Name ');
            }else{
                $('#error_pop').text('Select Any Type [BL Or P&L]');
                }
            $('#error_pop').delay(1000).fadeOut('slow');
        }
}


function edit_group(n,t,s,i,nw)
{
    $('#status_div').show();
    $('#add_btn').hide();
    $('#upd_btn').show();
    $('#group').val(n);
    $('#type_of_group').val(t);
    $('#type_of_exp_inc').val(nw);
    $('#status_group').val(s);
    $('#group').prop('disabled', true);
    $('#type_of_group').prop('disabled', true);
    $('#type_of_exp_inc').prop('disabled', true);
    $('#upd_btn').attr('grp_id_upd', i);
}





</script>


<div style="position:fixed;width:100%;left:30%;top:0%;z-index:99999;" class="mynewpopupload"  ></div>
</body>
</html>
