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
<title>Asset</title>
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
    .tax_add_btn{width:90%;background-color: #8a6602; margin: 0; line-height: 13px;  padding: 10px 15px; margin-top: 20px; float: left; color: #fff !important;text-align:center;margin-left:5%}
    .asset_tbl_inp{height:30px !important;}
    .banq_generate_inv_right_head_btn{width:50px;float:none;display:inline-block;font-weight:bold}
    #leftNavigation #new_tab_btn ul li {margin-top: 0px;height: 35px;padding: 0 !important; width: 100%; display: inherit !important;}
    #leftNavigation #new_tab_btn ul li a{font-size: 12px !important;background-color: transparent !important; color: #000;}
    #leftNavigation > #new_tab_btn ul { border-bottom: 2px #120811 solid; background-color: #fff; width: 96.5%; margin-left: 5px; overflow: hidden;}#leftNavigation > #new_tab_btn a {background-color: #891500;}
    .disablegenerate
        {
            pointer-events: none;
            opacity: 0.8;
            cursor:none;

        }
</style>
<script type="text/javascript" src="../js/jquery-ui-1.8.2.custom.min.js"></script> 
<script src="../js/jquery-1.10.2.js"></script>
<script type="text/javascript">
    //calender//
    $(document).ready(function () {
        
      var datastringnewcard="value=delete_all_asset_purchase";
        $.ajax({
        type: "POST",
        url: "load_accounts_data.php",
        data: datastringnewcard,
        success: function(data)
        {      
         
         
        }  
       });
       
       var datastringnewcard="value=delete_all_asset_purchase_tax";
        $.ajax({
        type: "POST",
        url: "load_accounts_data.php",
        data: datastringnewcard,
        success: function(data)
        {      
         
        }  
       });

 $("#tax_automate").on("change", function() {
    var tax_count=$('#tax_count').val();
    if ($(this).prop("checked")) {

      var  total_asset = $("#total_asset").val(); 
      var dis_asset = $("#dis_asset").val();
     
      var asset = total_asset-dis_asset;
      if(total_asset>0)
      {
         var i; var tot_tax=0;
        for( i = 1; i <= tax_count; i++) {
            $("#tax_amt" + i).css("pointer-events", "none"); 
        var  taxvalue=$('#tax_name'+i).attr('tax_value');
        var tax_amount = ((taxvalue/100)*asset).toFixed(3); 
        $("#tax_amt"+i).val(tax_amount);
        }  
      } 
    }else {
        var i; var tot_tax=0; 
        for( i = 1; i <= tax_count; i++) {
            $("#tax_amt" + i).css("pointer-events", "auto");
        $("#tax_amt"+i).val(0);
        }  
    } 
    });
        
             
    var ctrlKeyDown = false;
       $(document).on("keydown", keydown);
       
       function keydown(e) { 

    if ((e.which || e.keyCode) == 116 || ((e.which || e.keyCode) == 82 && ctrlKeyDown)) {
        // Pressing F5 or Ctrl+R
        e.preventDefault();
    } else if ((e.which || e.keyCode) == 17) {
        // Pressing  only Ctrl
        ctrlKeyDown = true;
    }
};          
             
             
             
  $( ".datepicker").datepicker({
               changeMonth: true,
               changeYear: true,
               format: 'yyyy-mm-dd',
               endDate: '+0d',
               autoclose: true
           });
           
           
           
           
   $(".plus_asset").click(function()
   {    
        
          var asset_name          =  $('#asset_name').val();
          var asset_qty           =  $('#asset_qty').val();
          var asset_unit_rate     =  $('#asset_unit_rate').val(); 
          var asset_total         =  $('#asset_total').val(); 
           
           
           var vendor_no    =  $('#vendor_no').val(); 
           var date_no      =  $('#date_no').val(); 
           var inv_no       =  $('#inv_no').val();
          
          var url_check=$('#url_check').val();
   
   var new_id=url_check.split('invoice_edit=');
   
  
   if(new_id[1]!='' || new_id[1]!='undefined' || new_id[1]!=undefined ){
       
       var mode='update';
   }else{
       var mode='add';
   }
         
        
         
          var datastring23 = "set=check_asset_invoice&asset_inv="+inv_no+"&asset_vendor="+vendor_no+"&mode="+mode;
       $.ajax({
                 type: "POST",
                 url: "load_accounts_data.php",
                 data: datastring23,
                 success: function (data4)
                 { 
         
         if($.trim(data4)!='no'){
         
       var datastring = "asset_name="+asset_name+"&asset_qty="+asset_qty+"&asset_unit_rate="+asset_unit_rate+"&asset_total="+asset_total
       +"&vendor_no="+vendor_no+"&date_no="+date_no+"&inv_no="+inv_no;
            
            
       if(asset_name!='' && asset_qty!='' && asset_unit_rate!='' && vendor_no!='' && date_no!='' && inv_no!='' ){
                  
                 $.ajax({
                 type: "POST",
                 url: "load_accounts_data.php",
                 data: datastring,
                 success: function (data)
                 { 
             
            var a=JSON.parse(data);
                   
            var decimal=$('#decimal').val();
                        
           $('#asset_name').val('');
           $('#asset_qty').val('');
           $('#asset_unit_rate').val(''); 
           $('#asset_total').val(''); 
           
           
                   $.each(a, function(i, record) {
                        
                   var  name=record.tam_name;
                   var  qty=record.tap_qty;
                   var  unit=parseFloat(record.tap_unit_rate).toFixed(decimal);
                   var  total=parseFloat(record.tap_total).toFixed(decimal);
                  
                  
                 
              if($('.append_div_main').find('#del_card' + record.tap_id).length === 0) {
              $(".append_div_main").append("<tr id='second_div_main"+record.tap_id+"' >"+
                                                
                                                 
                                                "<td style='width:20%'><input readonly style='cursor:pointer' type='text' class='form-control filte_new_box asset_tbl_inp' id='asset_name"+record.tap_id+"' value='" + name + "' ></td>"+
                                               "<td style='width:10%'> <input readonly autocomplete='off' type='text' class='form-control filte_new_box search_name asset_tbl_inp' value='" + qty + "' id='asset_qty"+record.tap_id+"' onkeyup='calc_qty();' ></td>"+
                                               "<td style='width:10%'><input readonly type='text' class='form-control filte_new_box asset_tbl_inp' id='asset_unit_rate"+record.tap_id+"'  value='" + unit + "' onkeyup='calc_rate();' ></td>"+
                                               "<td style='width:10%'><input style='cursor: pointer' type='text' readonly class='form-control filte_new_box asset_tbl_inp' value='" + total + "' id='asset_total"+record.tap_id+"'></td>  "+   
                                               "<td style='width:5%'><div class='banq_generate_inv_right_head_btn' id='del_card"+record.tap_id+"' onclick='return deletecard("+record.tap_id+");' >x</div></td>"+                                         
                                           " </tr>"
                        
              
                         );
                                 
                         }
                         
     });
       
       
       var datastring23 = "value=check_total_amount&asset_inv="+inv_no+"&asset_vendor="+vendor_no+"&asset_date="+date_no+"&type_submit=";
       $.ajax({
                 type: "POST",
                 url: "load_accounts_data.php",
                 data: datastring23,
                 success: function (data)
                 { 
                
                var type_tax_check=$('#etax_type').val();
                var type_tax_check1=$('#tax_type').val();
                
               
  if($('input[name="tax_type"]').is(':checked') || $('input[name="etax_type"]').is(':checked'))
 {
  var tax_inclusive='Y';
 }else
 {
 var tax_inclusive='N';
 }
               
        if(tax_inclusive=='N'){
            var tax_calc_asset_chk=parseFloat($('#tax_calc_asset').val());            
            var all_tot=parseFloat($.trim(data));

             $('#total_asset').val($.trim(data));
            $('#net_asset').val((all_tot+tax_calc_asset_chk).toFixed(decimal));

            
        }else{
                $('#total_asset').val($.trim(data));
                $('#net_asset').val($.trim(data))
           }

           $("#paid_asset").val('');
           $("#credit_asset").val(0);
           $("#dis_asset").val('')
           var tax_calc_asset= $("#tax_calc_asset").val();
           if(tax_calc_asset>0)
           {
            $('#net_asset').val((all_tot).toFixed(decimal));
            var tax_count=$('#tax_count').val();
            $("#tax_automate").prop("checked",false);
            for( i = 1; i <= tax_count; i++) {
            $("#tax_amt" + i).css("pointer-events", "auto");
            $("#tax_amt"+i).val(0);
            } 

            $("#tax_calc_asset").val(0);
            $('#load_error').show();
            $('#load_error').text('Please Recalculate TAX').delay(1000).fadeOut('slow');
           }




                  
        }
       });
       
       
       
       
       
   }  });
                   
        }else{
       $('#load_error').show();
       
       if(asset_unit_rate==''){
       $('#load_error').text('ENTER UNIT RATE');
       $("#asset_unit_rate").focus();
       }
        
        if(asset_qty==''){
       $('#load_error').text('ENTER QTY');
        $("#asset_qty").focus();
        }
        
        if(asset_name==''){
       $('#load_error').text('SELECT ASSET NAME');
        $("#asset_name").focus();
       }
        
         if(vendor_no==''){
       $('#load_error').text('SELECT SUPPLIER');
       $("#vendor_no").focus();
        }
        
        if(inv_no==''){
       $('#load_error').text('ENTER INVOICE NO');
       $("#inv_no").focus();
        }
        if(date_no==''){
       $('#load_error').text('SELECT DATE');
       $("#date_no").focus();
        }
        $('#load_error').delay(1000).fadeOut('slow');
                    
        }
        
        
        
      }else{
          $('#load_error').show();
       
       $('#load_error').text('INVOICE NO ALREADY EXIST FOR SUPPLIER');
       $("#inv_no").focus();
        
        $('#load_error').delay(1000).fadeOut('slow');
        
        }
        
        
        
        }
        });
        
        
        
        
        });
        
        
        
        
        
        
        
        
     //////////loading//////////
     
     
      var url_check=$('#url_check').val();
   
   var new_id=url_check.split('invoice_edit=');
   
   if (url_check.indexOf('invoice_edit') !== -1) {
   if(new_id[1]!='' || new_id[1]!='undefined' || new_id[1]!=undefined ){
            var inv_data=new_id[1].split('*');
            
           var invno_set=inv_data[1];
           var vendorno_set=inv_data[2];
           var dateno_set=inv_data[3];
           var ledger_set=inv_data[4];
           
           
        $('#vendor_no').val(vendorno_set); 
        $('#inv_no').val(invno_set); 
        $('#date_no').val(dateno_set); 
        $('#ledger_id').val(ledger_set);
        $('#vendor_no').prop('disabled', true); 
        $('#inv_no').prop('disabled', true); 
        $('#date_no').prop('disabled', true); 
        $('#paid_asset').prop('disabled', true); 
        $('#dis_asset').prop('disabled', true); 
        $('.append_div_main').addClass('disablegenerate');
        $('.tax_add_btn_new').addClass('disablegenerate');
        $('#inv_no').attr('type_submit','edit_invoice');
        $('.reset_btn_new').addClass('disablegenerate');

        if(invno_set!='')
        {
           $('#edit_tax_switch').show();
           $('#add_tax_switch').hide();
           
            var datastring = "set=load_plus_data_invoice&vendor_no="+vendorno_set+"&date_no="+dateno_set+"&inv_no="+invno_set;           
                 $.ajax({
                 type: "POST",
                 url: "load_accounts_data.php",
                 data: datastring,
                 success: function (data)
                 { 
             
            var a=JSON.parse(data);                   
            var decimal=$('#decimal').val();
           
                   $.each(a, function(i, record) {                      
                   var  name=record.tam_name;
                   var  qty=record.tap_qty;
                   var  unit=parseFloat(record.tap_unit_rate).toFixed(decimal);
                   var  total=parseFloat(record.tap_total).toFixed(decimal);  
                 
              if($('.append_div_main').find('#del_card' + record.tap_id).length === 0) {
              $(".append_div_main").append("<tr id='second_div_main"+record.tap_id+"' >"+
                                                                                                
                "<td style='width:20%'><input readonly style='cursor:pointer' type='text' class='form-control filte_new_box asset_tbl_inp' id='asset_name"+record.tap_id+"' value='" + name + "' ></td>"+
               "<td style='width:10%'> <input readonly autocomplete='off' type='text' class='form-control filte_new_box search_name asset_tbl_inp' value='" + qty + "' id='asset_qty"+record.tap_id+"' onkeyup='calc_qty();' ></td>"+
               "<td style='width:10%'><input readonly type='text' class='form-control filte_new_box asset_tbl_inp' id='asset_unit_rate"+record.tap_id+"'  value='" + unit + "' onkeyup='calc_rate();' ></td>"+
               "<td style='width:10%'><input style='cursor: pointer' type='text' readonly class='form-control filte_new_box asset_tbl_inp' value='" + total + "' id='asset_total"+record.tap_id+"'></td>  "+   
               "<td style='width:5%'><div class='banq_generate_inv_right_head_btn' id='del_card"+record.tap_id+"' onclick='return deletecard("+record.tap_id+");' >x</div></td>"+                                         
           " </tr>"
               );
                }          
             });           
           }
           
           });
           
           
           ////bottom data//////
            var datastring23 = "value=check_invoice_edit_load&asset_inv="+invno_set+"&asset_vendor="+vendorno_set+"&asset_date="+dateno_set;
           
             $.ajax({
                 type: "POST",
                 url: "load_accounts_data.php",
                 data: datastring23,
                 success: function (data)
                 { 
                 var data_all=$.trim(data).split('*');
                 
                 $('#total_asset').val(data_all[1]);
                 $('#tax_calc_asset').val(data_all[2]);
                  
                 $('#net_asset').val(data_all[3]);
                 $('#from_acc_asset').val(data_all[4]);
                 $('#paid_asset').val(data_all[5]);
                 $('#asset_tran').val(data_all[6]);
                 $('#asset_remarks').val(data_all[7]);
                   $('#credit_asset').val(data_all[8]);
                   
                 $('#dis_asset').val(data_all[9]);
                  
            }
       });
       
       
       
       ///////////////tax_data////////////
       
       
       
       var datastring232 = "value=load_plus_data_invoice_tax&asset_inv="+invno_set+"&asset_vendor="+vendorno_set+"&asset_date="+dateno_set;
           
             $.ajax({
                 type: "POST",
                 url: "load_accounts_data.php",
                 data: datastring232,
                 success: function (data)
                 { 
               
                 
                var data_tax= JSON.parse(data_tax);
                 //  alert(data_tax);
                
                  
            }
       });
       
           
           
           }
           
   }
}    
        
        
           
      
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
.ledger_list_scr{width:100%;height:auto;float:left;height:350px;float:left;margin-top:5px;}
.ledger_list_scr table{width:100%;height:auto;float:left}
.ledger_list_scr table td{border: solid 1px #ececec;color: #333; text-align: center; font-size: 14px; height: 31px; vertical-align: middle;
font-family: 'CALIBRI_0';padding:5px;}
.ledger_list_scr table thead{background-color:#333}.ledger_list_scr table thead td{color:#fff}
.printer_add_text_boxes_cc input{width:100% !important}
.printer_add_text_boxes_cc .bar{width:100%}
.printer_add_popup .md-content > .div{display:inline-block;width:100%;padding:10px;}
.printer_add_text_boxes_cc .group{width:100%;margin-left:0;}
.printer_add_text_boxes_cc input:focus ~ label, input:valid ~ label{    color: #414141;}
.md-show .md-overlay { opacity: 1;display: block;}
.printer_add_text_boxes_cc .group{margin-bottom:20px}
.bottom_trn_add_row{width:100%;height:auto;float:left;padding:5px;background-color:#fff;border-top:3px #e5e5e5 solid}
</style>

<link rel="stylesheet" href="../css/jquery-ui.css">
  <script src="../js/jquery-ui.js"></script>
  <link rel="stylesheet" href="../css/style_date.css">


</head>
<body>
    <input type="hidden" value="<?=$_SESSION['be_decimal']?>" id='decimal' >
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
            </div>

            <div class="col-md-12">
                        
                      <div style="margin-bottom:0;background: #fff;" class="cc_new">
                       	<div style="border: 0 !important " id="lista1" class="als-container">
                               <h3 style="float: left;margin-top: 10px;margin-left: 10px;">ASSET PURCHASE & VOUCHER</h3>
                           <div style="width: 70px;float: right;top: 3px;height: 33px;margin: 8px 10px;" class="search_btn_member_invoice filte_new_box_btn">
                           
                      </div>
                    </div>
                 </div>
               
                <div class="content-sec">
                	<div style="  padding: 2px;margin-top:10px;" class="col-lg-12 col-md-12 main_cc">
                     
                        

                        <div class="col-md-12" style="padding:0 5px;">
                            <div class="ledger_head_sec" style="">  
                                <!-- <h3 class="ledger_head" style="font-size: 14px;">Filter  <span id="error_ledger" style="float:right;color:black;display: none;font-size: 14px;background-color: #ff4229;border-radius: 5px "></span></h3> -->

                                
                                <div class="acc_add_box" style="width:20%;">
                                    <label style="margin: 0;">DATE</label>
                                    <input autocomplete="off" type="text" id="date_no" class="form-control filte_new_box search_name datepicker" >
                                    
                                </div>
                                
                                <div class="acc_add_box" style="width:20%;">
                                    <label style="margin: 0;">SUPPLIER NAME</label>
                                    
                                    <select id="vendor_no"  class="form-control filte_new_box search_name" onchange="get_ledger_id(this.value);"  >
                                        <option value="">SELECT SUPPLIER </option>
                                      <?php
                                      
                                $sql_kotlist  =  $database->mysqlQuery("SELECT v_id,v_name from tbl_vendor_master where  v_active='Y' "); 
	                            $num_kotlist  = $database->mysqlNumRows($sql_kotlist);
	                            if($num_kotlist){
	                            while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
	                                { ?>                                       
                                        <option value="<?=$result_kotlist['v_id']?>" ><?=$result_kotlist['v_name']?></option>             
                                        <?php } } ?>
                                    </select>
                                </div>

                               <input type="hidden" id='ledger_id' name='ledger_id'>
                                
                                
                                <div class="acc_add_box" style="width:20%;">
                                    <label style="margin: 0;">INVOICE NO</label>
                                    <input autocomplete="off" type="text" id="inv_no" class="form-control filte_new_box search_name" >
                                    
                                </div>
                                
                               
                                
                                
                                <div class="acc_add_box" style="width:10%;background-color: darkred;float: right">
                                  
                                    <a style="background-color: darkred;color: white;font-weight: bold" href="asset_purchase_voucher.php" class="form-control filte_new_box search_name reset_btn_new" >RESET ALL </a>
                                    
                                </div>
                                
                            <div class="ledger_list_sec" style="position:relative">
                             
                                <div class="ledger_list_scr">
                                    <table class="">
                                        <thead>
                                            <tr>
                                                
                                                <td style="width:20%">Asset Name</td>
                                                <td style="width:10%">Qty</td>
                                                <td style="width:10%">Unit Rate</td>
                                                <td style="width:10%">Total</td>    
                                                <td style="width:5%"></td>                                          
                                            </tr>
                                        </thead>
                                        <tbody class='append_div_main' >
                                        
                                             <tr id='second_div_main'>
                                                
                                                 
                                                <td style="width:20%">
                                                    
                                                    <select class="form-control filte_new_box asset_tbl_inp" id="asset_name">
                                                        <option value="">SELECT ASSET  </option>
                                      <?php
                                      
         $sql_kotlist  =  $database->mysqlQuery("SELECT * from tbl_asset_master where  tam_status='Active' order by tam_name asc  "); 
	$num_kotlist  = $database->mysqlNumRows($sql_kotlist);
	if($num_kotlist){
	while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
	           {
                                      
                                      ?>
                                        
                                        <option value="<?=$result_kotlist['tam_id']?>" > <?=$result_kotlist['tam_name']?> </option>             
                                        <?php } } ?>
                                                        
                                                    </select>
                                                    
                                                    
                                                    
<!--                                                    <input type="text" class="form-control filte_new_box asset_tbl_inp" id="asset_name" >-->
                                                </td>
                                                
                                                
                                                
                                                
                                                <td style="width:10%"> <input autocomplete="off" type="text" class="form-control filte_new_box search_name asset_tbl_inp" id="asset_qty" onkeypress="return numdot_dot(this,event);" maxlength="3" onkeyup='calc_qty();' ></td>
                                                <td style="width:10%"><input type="text" class="form-control filte_new_box asset_tbl_inp" id="asset_unit_rate" onkeypress="return numdot_dot(this,event);" onkeyup='calc_rate();' maxlength="7" ></td>
                                                <td style="width:10%"><input style="cursor: pointer " type="text" readonly class="form-control filte_new_box asset_tbl_inp" id="asset_total"></td>     
                                                <td style="width:5%"><div style="background-color: #86a950 " class="banq_generate_inv_right_head_btn plus_asset">+</div></td>                                         
                                            </tr>
                                        
                                     </tbody>
                                    </table>
                                </div>

                                <div class="bottom_trn_add_row">
                                 
                                    <div class="acc_add_box" style="width:10%;">
                                        <label style="margin: 0;">Total Amt</label>
                                        <input value="0" readonly id="total_asset" type="text" class="form-control filte_new_box search_name">
                                    </div>
                                    <div class="acc_add_box" style="width:7%;">
                                        <label style="margin: 0;">Discount</label>
                                        <input   onkeypress="return numdot_dot(this,event);"  id="dis_asset" type="text" class="form-control filte_new_box search_name" onkeyup="calc_paid_asset(this);"  >
                                    </div>
                                    <div class="acc_add_box" style="width:10%;" id="add_tax_switch">
                                        <a  data-modal="modal-18" class="tax_add_btn md-trigger" href="#">TAX</a>
                                    </div>
                                    
                                    <div class="acc_add_box" style="width:13%;display: none" id="edit_tax_switch">
                                        <a onclick="update_tax();"   class="tax_add_btn tax_add_btn_new" href="#">EDIT TAX</a>
                                    </div>
                                    
                                    <div class="acc_add_box" style="width:10%;">
                                        <label style="margin: 0;">Tax Amt</label>
                                        <input value="0" readonly id="tax_calc_asset" type="text" onkeypress="return numdot_dot(event);" class="form-control filte_new_box search_name"  >
                                    </div>
                                    
                                    <div class="acc_add_box" style="width:8%;">
                                        <label style="margin: 0;">Net Amt</label>
                                        <input value="0"  readonly onkeyup="net_chnage()" onkeypress="return numdot_dot(event);"  id="net_asset" type="text" class="form-control filte_new_box search_name"  >
                                    </div>
                                    
                                    
                          
                                     
                                    <div class="acc_add_box" style="width:8%;">
                                        <label style="margin: 0;">From Acc</label>
                                        <select name=""  class="form-control filte_new_box search_name" id="from_acc_asset" onchange="check_ledger_balance();" >
                                            <option value="">Select Acc</option>
                                             <?php 
                                         $sql_kotlist  =  $database->mysqlQuery("SELECT * from tbl_ledger_master tl left join tbl_ledger_group tg on tl.tlm_group=tg.tlg_id where (tg.tlg_name='Cash in Hand' OR tg.tlg_name='Bank Accounts' OR tl.tlm_vendor_id!='')  "); 
					$num_kotlist  = $database->mysqlNumRows($sql_kotlist);
					if($num_kotlist){
						  while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
							  {
                                                      ?>
                                        
                                        
                                          <option value="<?=$result_kotlist['tlm_id'] ?> "><?=$result_kotlist['tlm_ledger_name'] ?> </option>
                                        
                                                      <?php 
                                                  }
                                                  }
                                                ?>
                                        </select>
                                    </div>
                                    <div class="acc_add_box" style="width:8%;">
                                        <label style="margin: 0;">Paid Amt</label>
                                        <input type="text" class="form-control filte_new_box search_name" onkeypress="return numdot_dot(this,event);" id="paid_asset" onkeyup="calc_paid_asset(this);"  >
                                    </div>
                                    
                                     <div class="acc_add_box" style="width:8%;">
                                        <label style="margin: 0;">Credit</label>
                                        <input value="0" readonly type="text" class="form-control filte_new_box search_name" onkeypress="return numdot_dot(this,event);" id="credit_asset"   >
                                    </div>
                                    
                                    <div class="acc_add_box" style="width:10%;">
                                        <label style="margin: 0;">Trn Details</label>
                                        <input type="text" class="form-control filte_new_box search_name" id="asset_tran" >
                                    </div>
                                    <div class="acc_add_box" style="width:10%;">
                                        <label style="margin: 0;">Particulars</label>
                                        <input type="text" class="form-control filte_new_box search_name" id="asset_remarks"  >
                                    </div>
                                    <div class="acc_add_box" style="width:8%;">
                                    <!-- <a onclick="save_invoice_data();" style="background-color: #890000;" class="tax_add_btn" href="#">SAVE</a> -->
                                    <button id="saveButton" onclick="save_invoice_data();" style="background-color: #890000;" class="tax_add_btn">SAVE</button>
                                    
                                    </div>
                                    <span style="color:red;float: left;width: 100%;font-weight: bold;font-size: 12px"> NOTE : Press save button to enter all data to database. </span>
                                </div>

                            </div>

                        </div>
 
                    </div><!--main_cc-->
                </div><!--main content-sec-->
		</div>
	</div>
</div>
</div><!--container-->

 <div  class="md-modal md-effect-16 printer_add_popup edit_tax_cl" id="modal-20" style="top:0;width:100%;height:100%">
			<div style="width:400px;top:3%;margin:auto;left:0;right:0" class="md-content">
                            <h3 id="head_pop" style="margin-bottom:0">EDIT TAX </h3>
                            <div  style="background-color:transparent;top: 3px;"  class="md-close close_staff_pop" onclick="update_tax_close();" ><img src="img/close_ico.png"></div>
				
                            <div id='load_edit_tax' class="div">
                                
                                
                            </div>
                       
            </div>
</div> 

            <div  class="md-modal md-effect-16 printer_add_popup" id="modal-18" style="top:0;width:100%;height:100%">
			<div style="width:400px;top:3%;margin:auto;left:0;right:0" class="md-content">
                            <h3 id="head_pop" style="margin-bottom:0"> TAX </h3>
                                <div  style="background-color:transparent;top: 3px;"  class="md-close close_staff_pop"><img src="img/close_ico.png"></div>
				
                <div class="div">
                    
                    <input type="checkbox" id="tax_type" name="tax_type"  ><span style="color:black;"> Inclusive</span> 
                    <input type="checkbox" id="tax_automate" name="tax_automate" style="margin-left: 40px;"  ><span style="color:black;"> Automate</span> 

                    <div class="col-lg-12 col-md-12 no-padding printer_add_text_boxes_cc add_supplier_cnt" style="margin-bottom:5px;">

                    
                      <?php $taxcount=0;
                       $fnct_menu = $database->mysqlQuery("select count(amc_id) as tax_count from tbl_extra_tax_master where amc_active='Y' ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl > 0) {
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              { 
                $taxcount= $result_fnctvenue['tax_count']; 
                  
              }
              }
                      
                      
                 $ct=0;     
          $fnct_menu = $database->mysqlQuery("select amc_name,amc_id,amc_value from tbl_extra_tax_master where amc_active='Y' ");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl > 0) {
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              { $ct++;
                  ?>
                        <input type="hidden" value="<?=$taxcount?>" id="tax_count" > 
                        
                        
                     <div class="col-md-6">
                     <div class="group" id="prn_div">   
                         <input readonly value="<?=$result_fnctvenue['amc_name'].' ('.$result_fnctvenue['amc_value'].'%)' ?> " tax_value="<?=$result_fnctvenue['amc_value']?>"  tax_id="<?=$result_fnctvenue['amc_id']?>" type="text" id="tax_name<?=$ct?>" >   
                          <span class="highlight"></span>
                          <span class="bar"></span>
                          <label id="lab_grp"></label>
                        </div>
                    </div>

                     <div class="col-md-6">
                     <div class="group" id="prn_div">   
                         <input type="text" value="0" id="tax_amt<?=$ct?>" onkeypress="return numdot_dot(this,event);" >   
                          <span class="highlight"></span>
                          <span class="bar"></span>
                          <label id="lab_grp"></label>
                        </div>
                    </div>
                    
                     <?php } } ?>         
                   
                    
                  
                    </div>
                      
                    <a onclick="add_tax();" href="#"><button style="position:relative;top:2px;float:right;right:5px;height: 42px;" class="md-save">SUBMIT</button></a>
                    

                   

                </div>
                       
            </div>
</div> 




            <div class="md-overlay"></div><!-- the overlay element -->                       
                 
            <strong class="alert_error_popup" style="display: none;top:50px;bottom: inherit;padding: 8px" id="load_error"> </strong>

            
<script src="../master_style/js/classie.js"></script>
<script src="../master_style/js/modalEffects.js"></script>
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="../js/jquery.cookie.js"></script>
<script src="../loyalty/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="../js/jquery.tablesorter.js"></script>
<script type="text/javascript" id="js">

</script>

<script type="text/javascript" >
    
   
   
   
   function net_chnage(){
       $('#paid_asset').val('');
       $('#credit_asset').val(0);
   }
   
  
   
   
   
   
  function calc_qty() {
     
     var qty=$('#asset_qty').val();
     var rate=$('#asset_unit_rate').val();
     
     var decimal=$('#decimal').val();
     var total=(qty*rate);
     
            $('#asset_total').val(parseFloat(total).toFixed(decimal));
     
     
     
  }
   
   
   function calc_rate() {
    
     var qty=$('#asset_qty').val();
     var rate=$('#asset_unit_rate').val();
     
     var decimal=$('#decimal').val();
     var total=(qty*rate);
     
    $('#asset_total').val(parseFloat(total).toFixed(decimal));
    
    
    
  }
  
  function numdot_dot(item,evt) {
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


function deletecard(e){

        var check = confirm("DELETE RECORD ? ");
	if(check==true)
	{
       $('#second_div_main'+e).hide();
       var datastringnewcard="value=delcar&id="+e;
        $.ajax({
        type: "POST",
        url: "load_accounts_data.php",
        data: datastringnewcard,
        success: function(data)
        {
             $('#paid_asset').val('');   
         $('#credit_asset').val('0');   
            
            
            $('#second_div_main'+e).remove();
            var decimal=$('#decimal').val();
            var vendor=$('#vendor_no').val();
            var invoice=$('#inv_no').val();
            var date=$('#date_no').val();
            
            
             var type_submit=$('#inv_no').attr('type_submit');
             
       var datastring23 = "value=check_total_amount&asset_inv="+invoice+"&asset_vendor="+vendor+"&asset_date="+date+"&type_submit="+type_submit;
       $.ajax({
                 type: "POST",
                 url: "load_accounts_data.php",
                 data: datastring23,
                 success: function (data)
                 { 
        
                    
                 
                    $("#dis_asset").val('');    
                    var tax_calc_asset= $("#tax_calc_asset").val();
  if($('input[name="tax_type"]').is(':checked') || $('input[name="etax_type"]').is(':checked'))
 {
  var tax_inclusive='Y';
 }else
 {
 var tax_inclusive='N';
 }
            
        if(tax_inclusive=='N'){
            
          
            var tax_calc_asset_chk=parseFloat($('#tax_calc_asset').val());
            
            if(data>0)
            {
                var all_tot=parseFloat($.trim(data));
            }
            else{
                var all_tot=0;
            }
   
            
             $('#total_asset').val($.trim(data));
             if(all_tot>0){
               
              $('#net_asset').val((all_tot).toFixed(decimal));  
             }          
            else{ 
                 $('#net_asset').val('');
            }          
            $('#tax_calc_asset').val(0);
            
            }else{

            $('#total_asset').val($.trim(data));
            
               $('#net_asset').val($.trim(data))
               $('#tax_calc_asset').val(0);
           }
              
          
           if(tax_calc_asset>0) 
           {
            if(all_tot>0)
            {
              $('#net_asset').val((all_tot).toFixed(decimal));   
            }
            else{
                $('#net_asset').val('');
            }
           
            var tax_count=$('#tax_count').val();
            $("#tax_automate").prop("checked",false);
            for( i = 1; i <= tax_count; i++) {
            $("#tax_amt" + i).css("pointer-events", "auto");
            $("#tax_amt"+i).val(0);
            } 

            $("#tax_calc_asset").val(0);
            $('#load_error').show();
            $('#load_error').text('Please Recalculate TAX').delay(1000).fadeOut('slow');
           }  
           
       
              
              
        }
       });
            
            
            
        }
    });
    }
}




function add_tax(){
    var decimal=$('#decimal').val();
    var total_asset=$('#total_asset').val();
    var discount= $('#dis_asset').val();
    var vendor=$('#vendor_no').val();
    var invoice=$('#inv_no').val();
    var date=$('#date_no').val();
    
    
    if(total_asset!='' && total_asset>0 && vendor!='' && invoice!='' && date!='' ){
        
        
     $('#paid_asset').val('');   
         $('#credit_asset').val('0');   
    
 if($('input[name="tax_type"]').is(':checked'))
 {
  var tax_inclusive='Y';
 }else
 {
 var tax_inclusive='N';
 }
 
 if(tax_inclusive=='Y'){
   
    if(discount){
         var tot_net = parseFloat(total_asset)-parseFloat(discount);  
         $('#net_asset').val(tot_net);
    }
    else{
       $('#net_asset').val(total_asset);    
    }
    $('#tax_calc_asset').val('0');
  
 }
     
 
 
   var taxdata=[];
 
   var tax_count=$('#tax_count').val();
   
   var i; var tot_tax=0;
   for( i = 1; i <= tax_count; i++) {
   var  taxname1=$('#tax_name'+i).attr('tax_id');
   var  taxamount1=$('#tax_amt'+i).val();
   tot_tax += parseFloat($('#tax_amt'+i).val()); 
   taxdata.push({
       taxid:taxname1,
       taxamt:taxamount1
   });
   
   if(taxamount1.length<=0){
       alert('ENTER VALUES');
       exit;
   }
   
    }
    
    if(tax_inclusive=='N'){
        if(discount)
       {
        var tot_all_tax=((parseFloat(total_asset)-parseFloat(discount))+parseFloat(tot_tax));
       } 
        else {
            var tot_all_tax=(parseFloat(total_asset)+parseFloat(tot_tax));
        }
        
        $('#net_asset').val(tot_all_tax.toFixed(decimal)); 
        $('#credit_asset').val(tot_all_tax.toFixed(decimal)); 
        
        $('#tax_calc_asset').val(tot_tax.toFixed(decimal));
    }

    
     var taxdata1= JSON.stringify(taxdata);
 
    var datastringnewcard="set=add_asset_tax&taxdata="+taxdata1+"&tax_inclusive="+tax_inclusive+"&vendor="+vendor+"&invoice="+invoice+"&date="+date;
        $.ajax({
        type: "POST",
        url: "load_accounts_data.php",
        data: datastringnewcard,
        success: function(data)
        {      
         
            
        }
    });
    
     $('.printer_add_popup').removeClass('md-show');
    
        }else{
           alert('ENTER ALL ASSET DETAILS TO ADD TAX '); 
        }
}


function calc_paid_asset(fieldName){ 
var tax_calc_asset= $("#tax_calc_asset").val();
var decimal=$('#decimal').val();
var discount = parseFloat($('#dis_asset').val()); 
var paid=parseFloat($('#paid_asset').val());
var net=parseFloat($('#net_asset').val());
var total_asset=parseFloat($('#total_asset').val());


if(fieldName.id=='dis_asset')
{
    if(tax_calc_asset>0){
            $("#tax_calc_asset").val(0);
            $('#load_error').show();
            $('#load_error').text('Please Recalculate TAX').delay(1000).fadeOut('slow'); 
            }
            if(discount>0)
            {
              $('#net_asset').val((total_asset-discount).toFixed(decimal));  
            }
            else{
                $('#net_asset').val((total_asset).toFixed(decimal));    
            }
            
            $('#credit_asset').val(0);
            $("#paid_asset").val('');
            var tax_count=$('#tax_count').val();
            $("#tax_automate").prop("checked",false);
            for( i = 1; i <= tax_count; i++) {
            $("#tax_amt" + i).css("pointer-events", "auto");
            $("#tax_amt"+i).val(0);
            }  

}


else{
    if((paid>(net)) || paid=='' || discount==''){
        $('#paid_asset').val('');
        $('#credit_asset').val(0);
    }
    else{
        var credit=total_asset;
        
        if(discount>0)
        {
         credit=credit-discount;
        }
        if(paid>0)
        {
         credit=credit-paid;
        }
        if(tax_calc_asset>0)
        {
        credit=parseFloat(credit)+parseFloat(tax_calc_asset);
        }
        $('#credit_asset').val(credit.toFixed(decimal));
    }

}

 
     
    // if((paid>(net-discount)) || paid=='' || discount==''){
    //     $('#paid_asset').val('');
    //      $('#credit_asset').val(0);
    // }else{
    //   var credit=total_asset;
      
    //   if(discount>0)
    //   {
    //      credit=credit-discount;
    //   }

    //   if(paid>0)
    //   {
    //      credit=credit-paid;
    //   }

 

    //    // var crd=(net-paid-discount);
    //    if(credit>=0){
    //     $('#credit_asset').val(credit.toFixed(decimal));
    //    }
    // }
    
    
    
    
    
    
}

 function check_ledger_balance(){
        
    var v_from=$('#from_acc_asset').val();
   
    var data_v="set=check_ledger_balance&ledger="+v_from;
     
    $.ajax({
			type: "POST",
			url: "load_accounts_data.php",
			data: data_v,
			success: function(msg)
			{
                           
          if($.trim(msg)!='ok'){
                               
         $('#from_acc_asset').val('');
                              
         $('#error_pop_v').show();
         $('#error_pop_v').text('NO BALANCE IN LEDGER');
         $('#from_acc_asset').focus();
         $('#error_pop_v').delay(2000).fadeOut('slow');
                              
                  } 
                      
                             
                        }
                    });
         
    }

function save_invoice_data()
{

    var type_submit=$('#inv_no').attr('type_submit');
    var vendor=$('#vendor_no').val();
    var ledger=$('#ledger_id').val();
    var invoice=$('#inv_no').val();
    var date=$('#date_no').val();
    var subtotal=$('#total_asset').val();
    var netamount=$('#net_asset').val();
    var fromacc=$('#from_acc_asset').val();
    var paid_amount=$('#paid_asset').val();
    var tran=$('#asset_tran').val();
    var remarks=$('#asset_remarks').val();  
    var credit_asset=$('#credit_asset').val();
    var dis=$('#dis_asset').val();
    var tax_calc_asset=$('#tax_calc_asset').val();

    var net = netamount;

   if(subtotal >0 && subtotal!='' && netamount!='' && netamount>0 && fromacc!='' && paid_amount!='' && ledger!='' && invoice!='' && date!='' &&  vendor!='' && remarks!='')
   { 
    $('#saveButton').prop("disabled", true);
       if(type_submit !='edit_invoice')
       {
        var datastringnewcard4="set=check_vendor_invoice&vendor="+vendor+"&invoice="+invoice;
        $.ajax({
        type: "POST",
        url: "load_accounts_data.php",
        data: datastringnewcard4,
        success: function(data4)
        {  
        if($.trim(data4) !='yes')
        {
        var datastringnewcard="set=add_invoice_main&vendor="+vendor+"&invoice="+invoice+"&date="+date+"&subtotal="+subtotal
            +"&netamount="+net+"&fromacc="+fromacc+"&paid_amount="+paid_amount+"&tran="+tran+"&remarks="+remarks
            +"&tax_calc_asset="+tax_calc_asset+"&type_submit="+type_submit+"&credit_asset="+credit_asset+"&dis="+dis+"&toacc="+ledger;
    
        $.ajax({
        type: "POST",
        url: "load_accounts_data.php",
        data: datastringnewcard,
        success: function(data)
        {  
        
             $('#load_error').show();
            $('#load_error').css('background-color', '#549056');
         $('#load_error').text('ADDED SUCCESSFULLY');
         $('#load_error').delay(1000).fadeOut('slow'); 

              setInterval(function () {
              location.reload();
        
          }, 1000); 
         
       
        }
    });
    
        }else{
            $('#saveButton').prop("disabled", false);
            $('#load_error').show();
            $('#load_error').css('background-color', 'red');
         $('#load_error').text('INVOICE ALREADY EXIST FOR SUPPLIER');

         $('#load_error').delay(1500).fadeOut('slow'); 
        }
        
        
        }
        });
        
        
        
    }else{
       
          var datastringnewcard="set=add_invoice_main&vendor="+vendor+"&invoice="+invoice+"&date="+date+"&subtotal="+subtotal
            +"&netamount="+netamount+"&fromacc="+fromacc+"&paid_amount="+paid_amount+"&tran="+tran+"&remarks="+remarks+
            "&tax_calc_asset="+tax_calc_asset+"&type_submit="+type_submit+"&credit_asset="+credit_asset+"&toacc="+ledger;
    
        $.ajax({
        type: "POST",
        url: "load_accounts_data.php",
        data: datastringnewcard,
        success: function(data)
        {  
          
             $('#load_error').show();
            $('#load_error').css('background-color', '#549056');
         $('#load_error').text('UPDATED SUCCESSFULLY');
         $('#load_error').delay(1000).fadeOut('slow'); 
              setInterval(function () {
             window.location.href='asset_invoice.php';
        // $('#saveButton').prop('disabled', false);
          }, 1000); 
         
       
        }
    });
          
          
        }


        $.ajax({
                type: "POST",
                url: "load_ledger.php",
                data: "set=open_ledger_daywise&date="+ev_date,
                success: function(msg1)
                {
                                     
                $.ajax({
                type: "POST",
                url: "load_ledger.php",
                data: "set=close_ledger_daywise&date="+ev_date,
                success: function(msg)
                {
                  //  search_contra();                  
                }
                });    
                }
                });
    
    
    
    
    }
    else{
        
     
        $('#load_error').show();
        
         if(vendor==''){
       $('#load_error').text('SELECT SUPPLIER NAME');
       $("#vendor_no").focus();
    
        }
        
         if(remarks==''){
       $('#load_error').text('ENTER PARTICULARS');
       $("#asset_remarks").focus();
        }
        
         if(fromacc==''){
       $('#load_error').text('SELECT FROM ACC');
       $("#from_acc_asset").focus();
        }
        
        if(paid_amount==''){
       $('#load_error').text('ENTER PAID AMOUNT');
       $("#paid_asset").focus();
        }
        
        
        if(netamount=='' || netamount<=0){
       $('#load_error').text('INVALID NETAMOUNT');
       $("#net_asset").focus();
        }
        
        if(subtotal==0){
       $('#load_error').text('TOTAL AMOUNT IS ZERO');
       $("#total_asset").focus();
        }
        
        
         if(subtotal==''){
       $('#load_error').text('INVALID TOTAL AMOUNT');
       $("#total_asset").focus();
        }
        
        
        
         if(invoice==''){
       $('#load_error').text('ENTER INVOICE NO');
       $("#inv_no").focus();
        }
        
        
        if(date==''){
       $('#load_error').text('SELECT DATE');
       $("#date_no").focus();
        }tot_tax
        
        
        
        $('#load_error').delay(1000).fadeOut('slow');
        
        
        
    }
    
}

function update_tax(){
   $('.edit_tax_cl').addClass('md-show');
   
   var vendor=$('#vendor_no').val();
   var invoice=$('#inv_no').val();
   var date=$('#date_no').val();
   var datastringnewcard="set=load_edit_tax&vendor="+vendor+"&invoice="+invoice+"&date="+date;
        $.ajax({
        type: "POST",
        url: "load_accounts_data.php",
        data: datastringnewcard,
        success: function(data)
        {      
         
            $('#load_edit_tax').html(data);
        }
    });
}


function update_tax_close(){
   $('.edit_tax_cl').removeClass('md-show');

   
}


function get_ledger_id(vendor)
{
    if(vendor){
    var datastringnewcard="set=get_ledger_id&vendor="+vendor;
    $.ajax({
        type: "POST",
        url: "load_ledger.php",
        data: datastringnewcard,
        success: function(data)
        {        
           $('#ledger_id').val($.trim(data));
        }
    });
    }
}


function tax_update_all(){
    var decimal=$('#decimal').val();
    var total_asset=$('#total_asset').val();
    
   var vendor=$('#vendor_no').val();
    var invoice=$('#inv_no').val();
    var date=$('#date_no').val();
    
    
    
    if(total_asset!='' && total_asset>0 && vendor!='' && invoice!='' && date!='' ){
        
        
        $('#paid_asset').val('');  
         $('#credit_asset').val('0');  
        
    
 if($('input[name="etax_type"]').is(':checked'))
 {
  var tax_inclusive='Y';
 }else
 {
 var tax_inclusive='N';
 }
 
 if(tax_inclusive=='Y'){
   $('#net_asset').val(total_asset);  
 }
 
 
   var taxdata=[];
 
   var tax_count=$('#etax_count').val();
  
   var i; var tot_tax=0;
   for( i = 1; i <= tax_count; i++) {
    
   var  taxname1=$('#etax_name'+i).attr('etax_id');
    
   var  taxamount1=$('#etax_amt'+i).val();
   
   tot_tax += parseFloat($('#etax_amt'+i).val());
   
   
   taxdata.push({
       taxid:taxname1,
       taxamt:taxamount1
   });
   
   if(taxamount1.length<=0){
       alert('ENTER VALUES');
       exit;
   }
   
   
    }
    
    if(tax_inclusive=='N'){
        
        var tot_all_tax=(parseFloat(total_asset)+parseFloat(tot_tax));
        
        $('#net_asset').val(tot_all_tax.toFixed(decimal)); 
        
        
        $('#tax_calc_asset').val(tot_tax.toFixed(decimal));
    }
    
     var taxdata1= JSON.stringify(taxdata);

    var datastringnewcard="set=update_asset_tax&taxdata="+taxdata1+"&tax_inclusive="+tax_inclusive+"&vendor="+vendor+"&invoice="+invoice+"&date="+date;
        $.ajax({
        type: "POST",
        url: "load_accounts_data.php",
        data: datastringnewcard,
        success: function(data)
        {      
         
           //alert(data);
        }
    });
    
     $('.edit_tax_cl').removeClass('md-show');
    
         }else{
           alert('ENTER ALL ASSET DETAILS TO ADD TAX '); 
         }
}

</script>

<div style="position:fixed;width:auto;right: 20px;bottom:20px;z-index:99999;background-color: #f00;color: white;padding: 10px 20px;display: none;font-size: 15px" id="error_pop_v"> </div>
</body>
</html>
