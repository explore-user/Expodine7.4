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
    #leftNavigation #new_tab_btn ul li {margin-top: 0px;height: 35px;padding: 0 !important; width: 100%; display: inherit !important;}
    #leftNavigation #new_tab_btn ul li a{font-size: 12px !important;background-color: transparent !important; color: #000;}
    #leftNavigation > #new_tab_btn ul { border-bottom: 2px #120811 solid; background-color: #fff; width: 96.5%; margin-left: 5px; overflow: hidden;}#leftNavigation > #new_tab_btn a {background-color: #891500;}
    .lab_sts {
    position: absolute;
    height: 63%;
    width: 100px;
    top: -13%;
    left: 0px;
    pointer-events: none;
    opacity: 1.5;
    text-align:left
}
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
.ledger_list_scr{width:100%;height:auto;float:left;height:480px;float:left;margin-top:5px;}
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
.bottom_trn_add_row{width:100%;height:auto;float:left;padding:5px;background-color:#fff;border-top:3px #e5e5e5 solid}
.add_printer_dropdown {
    width: 100%;
    height: 40px;
    background-color: transparent !important;
    color: #000;
    border: 0;
    border-bottom: 1px #9e9e9e solid;
    font-size: 18px;
}
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
                               <h3 style="float: left;margin-top: 10px;margin-left: 10px;">ASSET INVOICE LIST </h3>
                           
                           

                      </div>
                    </div>
           </div>
               
                <div class="content-sec">
                    
                    
                    
                	<div style="  padding: 2px;margin-top:10px;" class="col-lg-12 col-md-12 main_cc">
                     
                        

                        <div class="col-md-12" style="padding:0 5px;">
                           
                            <div class="ledger_list_sec" style="position:relative">
                             
                              <div class="acc_add_box" style="width:20%;">
                                    <label style="margin: 0;">INVOICE NO</label>
                                    <input autocomplete="off" type="text" id="inv_no" onkeyup="return search_invoice();" class="form-control filte_new_box search_name" >
                                    
                                </div>  
                                
                                 <div class="acc_add_box" style="width:20%;">
                                    <label style="margin: 0;">VENDOR NAME</label>
                                    <input autocomplete="off" type="text" id="vendor_no" onkeyup="return search_invoice();" class="form-control filte_new_box search_name" >
                                    
                                </div>  
                                <?php 
                                if (isset($_GET['from'])){
                                    $from = $_GET['from'];
                                }
                                else{
                                    $from = date('Y-m-d');
                                }
                                ?>
                                
                                <div class="acc_add_box" style="width:20%;">
                                    <label style="margin: 0;">From Date</label>
                                    <input autocomplete="off" type="text" value= <?=$from;?> onchange="return search_invoice();" id="date_no"  class="form-control filte_new_box search_name datepicker" >                     
                                </div>
                               <?php if (isset($_GET['to'])){
                                    $to = $_GET['to'];
                                }
                                else{
                                    $to = date('Y-m-d');
                                }
                                ?>
                                <div class="acc_add_box" style="width:20%;">
                                    <label style="margin: 0;">To Date</label>
                                    <input autocomplete="off" value= <?=$to;?> type="text" onchange="return search_invoice();" id="date_no1" class="form-control filte_new_box search_name " >
                                    
                                </div>
                                
                             
                                <div class="ledger_list_scr" >
                                    <table class="">
                                        <thead>
                                            <tr>
                                                 <td style="min-width:50px">Sl</td>
                                                 <td style="min-width:80px">Action</td>
                                                <td style="min-width:100px">Date</td>
                                                 <td style="min-width:150px">Supplier </td>
                                                <td style="min-width:80px">Invoice No</td>
                                               
                                                <td style="min-width:100px">Subtotal</td>  
                                                <td style="min-width:80px">Tax</td>   
                                                <td style="min-width:80px">Discount</td>  
                                                <td style="min-width:100px">Net Amount</td>  
                                                 <td style="min-width:100px">Paid</td>    
                                                <td style="min-width:100px">Credit Amount</td>    
                                                <td style="min-width:150px">Particulars</td>   
                                                <td style="min-width:100px">Entry Date</td>   
                                                
                                            </tr>
                                        </thead>
                                        <tbody id="load_invoice" >
             
                                        
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





<div  class="md-modal md-effect-16 printer_add_popup voucher_div" id="modal-18" style="top:0;width:100%;height:100%">  <!---md-show--->
			<div style="width:800px;top:3%;margin:auto;left:0;right:0" class="md-content">
                            <h3 id='pop_head' style="margin-bottom:0"> BALANCE ASSET PAY </h3>
                            <div onclick="return close_voucher();"  style="background-color:transparent;top: 3px;"  class="md-close close_staff_pop"><img src="img/close_ico.png"></div>
				
                <div class="div">

                        <div class="col-lg-12 col-md-12 no-padding printer_add_text_boxes_cc add_supplier_cnt" style="margin-bottom:5px;">

                     
                        <div class="col-md-4">
                            <div class="group" id="prn_div">   
                                <input type="text"  class="v_date" readonly id="asset_vendor"  >   
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label id="lab_grp"></label>
                             <span style="color:black"  class="lab_sts">Supplier</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="group" id="prn_div">   
                                <input type="text" id="asset_invoice_no"  readonly>   
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label id="lab_grp"></label>
                            <span style="color:black" class="lab_sts">Invoice</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="group" id="prn_div">   
                                <input type="text" id="asset_invoice_amount" readonly >   
                            <span class="highlight"></span>
                            <span class="bar"></span>
                          
                              <span style="color:black" class="lab_sts">Invoice Amount</span>
                            </div>
                        </div>
                      
                        
                            
                            <div class="col-md-4" id="bal_div" style="display:none">
                            <div class="group" id="prn_div">   
                                <input type="text" id="asset_balance" value="0" readonly onkeypress="return numdot(event);"  >   
                            <span class="highlight"></span>
                            <span class="bar"></span>
                           
                              <span style="color:black" class="lab_sts">Balance To Pay</span>
                            </div>
                        </div> 
                            
                        <div class="col-md-4">
                            <div class="group" id="prn_div">   
                            <input type="text" id="asset_bal" readonly >   
                            <span class="highlight"></span>
                            <span class="bar"></span>
                           
                              <span style="color:black" class="lab_sts">Balance to Pay</span>
                            </div>
                        </div>
                            
                            
                            
                            
                            
                            <div class="col-md-4">
                            <div class="group" id="prn_div">   
                                <input type="text" id="asset_paid"  onkeyup="return valid_paid();" onkeypress="return numdot(event);"  >   
                            <span class="highlight"></span>
                            <span class="bar"></span>
                           
                              <span style="color:black" class="lab_sts">Paid Amount</span>
                            </div>
                        </div>
                            
                            
                            <div class="col-md-4">
                            <div class="group" id="prn_div">   
                                <input type="text" id="asset_credit"  readonly  >   
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <span style="color:black" class="lab_sts">Credit Amount </span>
                           
                            </div>
                        </div>
                            
                            
                            <div class="col-md-4">
                            <div class="group" id="prn_div">   
                                <input type="text" id="asset_dis"  readonly  >   
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <span style="color:black" class="lab_sts">Discount Amount </span>
                           
                            </div>
                        </div>
                            
                            <div class="col-md-4">
                            <div class="group" id="prn_div">   
                                <input type="text" id="asset_date" autocomplete="off" class="datepicker" >   
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <span style="color:black" class="lab_sts">Date</span>
                           
                            </div>
                        </div>
                            
                            <div class="col-md-4">
                            <div class="group" id="prn_div">   
                                <select  id="asset_from" class="add_printer_drop add_printer_dropdown"  >  
                                
                                    <option value="">Select From</option>
                                
                                <?php 
                                         $sql_kotlist  =  $database->mysqlQuery("SELECT * from tbl_ledger_master tl left join tbl_ledger_group tg on tl.tlm_group=tg.tlg_id where (tg.tlg_name='Cash in Hand' OR tg.tlg_name='Bank Accounts')  "); 
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
                        </div>
                            
                            <div class="col-md-4">
                            <div class="group" id="prn_div">   
                                <input type="text" id="asset_trans" autocomplete="off">   
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <span style="color:black" class="lab_sts">Trn Details</span>
                           
                            </div>
                        </div>
                            
                            <div class="col-md-4">
                            <div class="group" id="prn_div">   
                                <input type="text" id="asset_particulars" autocomplete="off">   
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <span style="color:black" class="lab_sts">Particulars</span>
                           
                            </div>
                        </div>
                          
                            <a onclick="return  pay_asset_balance();" href="#"><button style="position:relative;top:2px;float:right;right:5px;height: 42px;" class="md-save">PAY</button></a>

                        </div>
                </div>

    </div>

</div>




     
  <div class="md-overlay"></div>      

                  
                 
            <strong class="alert_error_popup" style="display: none" id="error_pop"> </strong>

            
<script src="../master_style/js/classie.js"></script>
<script src="../master_style/js/modalEffects.js"></script>
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="../js/jquery.cookie.js"></script>
<script src="../loyalty/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="../js/jquery.tablesorter.js"></script>
<script type="text/javascript" id="js">
    
    
 $(document).ready(function () {
    search_invoice();   
     
     $( ".datepicker").datepicker({
               changeMonth: true,
               changeYear: true,
               format: 'yyyy-mm-dd',
               endDate: '+0d',
               autoclose: true
           });
           
           $( "#date_no1").datepicker({
               changeMonth: true,
               changeYear: true,
               format: 'yyyy-mm-dd',
               endDate: '+0d',
               autoclose: true
           });
           
           
           
      
    //   var datastringnewcard="set=search_asset_invoice&invoice=&vendor=&fromdt=&todt=";
    //     $.ajax({
    //     type: "POST",
    //     url: "load_accounts_data.php",
    //     data: datastringnewcard,
    //     success: function(data)
    //     {      
         
    //      $('#load_invoice').html(data);
    //     }  
    //    });
   });
    
    
   function valid_paid(){
        var paid = parseFloat($('#asset_paid').val());
       var bal =  parseFloat($('#asset_bal').val());

       if(paid > bal){
            $('#asset_credit').val('');
             $('#asset_paid').val('');
             
           $('#error_pop').show();
            $('#error_pop').css('background-color', 'red');
         $('#error_pop').text('INVALID PAID AMOUNT');
         $('#error_pop').delay(1000).fadeOut('slow'); 
           
       }else{
           
           if(paid>0)
          {
            var crd= bal-paid;          
            $('#asset_credit').val(crd.toFixed(3));
          } 
          else{
            $('#asset_credit').val('');
          }             
       }
        
       
   } 
    
    function search_invoice()
    {
        var inv_no = $('#inv_no').val();
       var vendor =  $('#vendor_no').val();
       var date   =  $('#date_no').val();
        var todate   =  $('#date_no1').val();
      
       
        var datastringnewcard="set=search_asset_invoice&invoice="+inv_no+"&vendor="+vendor+"&fromdt="+date+"&todt="+todate;
        $.ajax({
        type: "POST",
        url: "load_accounts_data.php",
        data: datastringnewcard,
        success: function(data)
        {      
         $('#load_invoice').html(data);
         
        }  
       });
       
       
       
       
        
    }
    
function pay_asset_balance()
{
    var vendor= $('#asset_vendor').attr('vendor_id_new');
    var tax= $('#asset_vendor').attr('tax');
    var subtotal= $('#asset_vendor').attr('subtotal');
    var inv_no=  $('#asset_invoice_no').val();
    var date  =  $('#asset_date').val();
    var credit  =  $('#asset_credit').val();
    var paid  =  $('#asset_paid').val();
    var from  =  $('#asset_from').val();
    var total  =  $('#asset_invoice_amount').val();
    var particulars  =  $('#asset_particulars').val();
    var trans=$('#asset_trans').val();
       
       if(paid !='' && date!='' && particulars!=''  && from!='' ){
           
        var datastringnewcard="set=add_balance_asset&invoice="+inv_no+"&vendor="+vendor+"&date="+date+"&from="+from+"&particulars="+particulars+"&credit="+credit+"&paid="+paid
        +"&tax="+tax+"&subtotal="+subtotal+"&total="+total+"&trans="+trans;
        $.ajax({
        type: "POST",
        url: "load_accounts_data.php",
        data: datastringnewcard,
        success: function(data)
        {     
        $('#error_pop').show();
        $('#error_pop').css('background-color', '#549056');
        $('#error_pop').text('PAID SUCCESSFULLY');
        $('#error_pop').delay(1000).fadeOut('slow'); 
        setInterval(function () {
            location.reload();
        }, 1000); 
         
        
        }  
       });
       
        }else{
            
            
           $('#error_pop').show();
            $('#error_pop').css('background-color', 'red');
            
            
            
            if(particulars==''){
         $('#error_pop').text('ENTER PARTICULARS');
         
         $('#asset_particulars').focus();
          }
            
            
            if(from==''){
         $('#error_pop').text('SELECT FROM ACC');
          $('#asset_from').focus();
          }
          
          
          
             
            
            
             
            
            if(paid==''){
         $('#error_pop').text('ENTER PAID AMOUNT');
          $('#asset_paid').focus();
          }
         
         if(date==''){
         $('#error_pop').text('SELECT DATE');
          $('#asset_date').focus();
          }
         
         
         $('#error_pop').delay(1000).fadeOut('slow');  
            
            
        }
       
       
       
        
    }

function edit_asset_purchase(i,v,d,l){
   
   window.location.href='asset_purchase_voucher.php?invoice_edit=*'+i+"*"+v+"*"+d+"*"+l;
   
   
}


function add_pay(inv,ven,date){
    
    
     $.ajax({
			type: "POST",
			url: "load_accounts_data.php",
			data: "set=check_credit_pay_asset&edit_inv="+inv+"&vendor="+ven,
			success: function(msg1)
			{
     if($.trim(msg1)!='no'){
    
    $('.voucher_div').addClass('md-show');
    
    
     var datastringnewcard="set=asset_check_pay&invoice="+inv+"&vendor="+ven;
        $.ajax({
        type: "POST",
        url: "load_accounts_data.php",
        data: datastringnewcard,
        success: function(data)
        {      
         
    var sel=$.trim(data).split('*');
    
     $('#asset_invoice_amount').val(sel[1]);
     
     $('#asset_vendor').val(sel[3]);
    
    $('#asset_vendor').attr('vendor_id_new',ven);
    
     $('#asset_invoice_no').val(sel[7]);
     
      $('#asset_vendor').attr('tax',sel[8]);
      
      $('#asset_vendor').attr('subtotal',sel[9]);
      
       $('#asset_dis').val(sel[10]);
     
     var datastringnewcard5="set=check_bal_asset&invoice="+inv+"&vendor="+ven;
        $.ajax({
        type: "POST",
        url: "load_accounts_data.php",
        data: datastringnewcard5,
        success: function(data5)
        {      
     
     $('#asset_bal').val($.trim(data5));
     
     
        }  
       });
        
        }  
       });
    
    }else{
             $('#error_pop').show();
        
              
               $('#error_pop').text('ALREADY PAID ALL CREDITS');
             
                $('#error_pop').delay(2000).fadeOut('slow');
        }
                     }
                    });
    
}

function close_voucher(){
    
    $('.voucher_div').removeClass('md-show');
    
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
</script>





<div style="position:fixed;width:auto;right: 20px;bottom:20px;z-index:99999;background-color: #f00;color: white;padding: 10px 20px;display: none;font-size: 15px" id="error_pop_v"> </div>
</body>
</html>
