<?php
include('includes/session.php');		// Check session
//session_start();
include("database.class.php"); // DB Connection class
$database	= new Database();
$_SESSION['pagid']=10;
error_reporting(0);
if(isset($_REQUEST['delete']))
{
   $id=$_REQUEST['id'];
    if($_REQUEST['delete']=="yes")
       {
		$result=$database->mysqlQuery("UPDATE  tbl_voucherpayment SET  vp_status='Added' WHERE vp_id = '" .$_REQUEST['id']."'");
	}else
	{
		$result=$database->mysqlQuery("UPDATE  tbl_voucherpayment SET  vp_status='Cancelled' WHERE vp_id = '" .$_REQUEST['id']."'");
	}
        
        
 //header("location:voucher_master.php?msg=1");
  	 if (!headers_sent())
    {    
        header('Location: voucher_payment.php?msg=3');
        exit;
        }
    else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="voucher_payment.php?msg=3";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=voucher_head.php?msg=3" />';
        echo '</noscript>'; exit;
    }
}

if($_SERVER['REQUEST_METHOD']=='POST' && isset($_REQUEST['vhid'])){
    
    $machineip1= getHostByName(getHostName());
    
        $insertion['vp_vhid'] 	        =  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['vhid']);
        
        if($_REQUEST['amount']!=""){
	$insertion['vp_amount']		= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['amount']);
        }
       
        $insertion['vp_date']           =date("Y-m-d h:i:s");
        
         if($_REQUEST['type1']){
         $insertion['vp_type']	 = mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['type1']);
         }
         if($_REQUEST['paymentmode']!=""){
        $insertion['vp_paymentmode']	= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['paymentmode']);
         }
         if($_REQUEST['paidto']!=""){
        $insertion['vp_paidto']		= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['paidto']);
         }
         if($_REQUEST['chequebank']!=""){
        $insertion['vp_chequebank']	= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['chequebank']);
         }
         if($_REQUEST['chequebranch']!=""){
        $insertion['vp_chequebranch']	= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['chequebranch']);
         }
         if($_REQUEST['chequeleafno']!=""){
        $insertion['vp_chequeleafno']	= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['chequeleafno']);
         }
         if($_REQUEST['receivedby']!=""){
        $insertion['vp_receivedby']	= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['receivedby']);
         }
         if($_REQUEST['voucherbillno']!=""){
         $insertion['vp_voucherno']	= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['voucherbillno']);
         }
         if($_REQUEST['remark']!=""){
         $insertion['vp_add_remark']	= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['remark']);
         }
         
          $insertion['vp_dayclose_date']	= mysqli_real_escape_string($database->DatabaseLink,$_SESSION['date']);
          
         
        $insertion['vp_branchid']       = "1";
        $insertion['vp_system_ip']       = mysqli_real_escape_string($database->DatabaseLink,$machineip1);
        if(isset($_REQUEST['active']))
	{
	 		$insertion['vp_status'] 		=  'Added';
	}else
	{
	 		$insertion['vp_status'] 		=  'Cancelled';
	}
        
        if(isset($_REQUEST['activestatus']))
	{
	 		$insertion['vp_status'] 		=  'Added';
                      //  $insertion['vp_approveddate']           =date("Y-m-d H:i:s");
                       // $staff_details = $database->show_login_ful_details($_SESSION['expodine_id']);
                       // $staff_id = $staff_details['ls_staffid'];
                        $approvedby=$staff_id;
                        //$insertion['vp_approvedby']       =$approvedby; 
	}else
	{
	 		 $insertion['vp_status'] 		=  'Approved';
                         $insertion['vp_approveddate']           =date("Y-m-d H:i:s");
                         $staff_details = $database->show_login_ful_details($_SESSION['expodine_id']);
                         $staff_id = $staff_details['ls_staffid'];
                         $insertion['vp_approvedby']       =$staff_id; 
                        
	}
        
        
        $sql=$database->check_duplicate_entry('tbl_voucherpayment',$insertion);
	 if($sql!=1){
             $insertid              			=  $database->insert('tbl_voucherpayment',$insertion);

         }
        
         
	 if (!headers_sent())
       {    
        header('Location: voucher_payment.php?msg=2');
        exit;
        }
        else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="voucher_payment.php?msg=2";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=voucher_payment.php?msg=2" />';
        echo '</noscript>'; exit;
    }
        
}

if($_SERVER['REQUEST_METHOD']=='POST' && isset($_REQUEST['vhid1change']))
{
     $amt=$_REQUEST['amount1'];
     $id=$_REQUEST['voucherid'];
     
     
     $sql_login  =  $database->mysqlQuery("select * from tbl_voucherpayment  where vp_id='$id'");

$num_cat_s  = $database->mysqlNumRows($sql_login);
if($num_cat_s){
  while($result_cat_s  = $database->mysqlFetchArray($sql_login)) 
	  {
			  $amountall=$result_cat_s['vp_amount'];
                         
	  }			
} 
     
      $tot=$amountall-$amt;
     
       $query3=$database->mysqlQuery("update tbl_voucherpayment set vp_amount='$tot' where vp_id='$id'");

     
    
    
       $insertion['vp_vhid'] 	        = mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['vhid1change']);
	$insertion['vp_amount']		= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['amount1']);
        $insertion['vp_date']           =  date("Y-m-d h:i:sa");
        if($_REQUEST['type2']!=""){
         $insertion['vp_type']	        = mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['type2']);
        }
        if($_REQUEST['paymentmode1']!=""){
        $insertion['vp_paymentmode']	= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['paymentmode1']);
        }
        if($_REQUEST['paidto1']!=""){
        $insertion['vp_paidto']		= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['paidto1']);
        }
        if($_REQUEST['chequebank1']!=""){
        $insertion['vp_chequebank']	= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['chequebank1']);
        }
        if($_REQUEST['chequebranch1']!=""){
        $insertion['vp_chequebranch']	= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['chequebranch1']);
        }
        if($_REQUEST['chequeleafno1']!=""){
        $insertion['vp_chequeleafno']	= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['chequeleafno1']);
        }
        if($_REQUEST['receivedby1']!=""){
        $insertion['vp_receivedby']	= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['receivedby1']);
        }
        if($_REQUEST['voucherbillno1']!=""){
         $insertion['vp_voucherno']	= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['voucherbillno1']);
        }
        if($_REQUEST['remark1']!=""){
        $insertion['vp_add_remark']	= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['remark1']);
        }
      
         $insertion['vp_branchid']       = "1";
                   
        $insertion['vp_status'] 		=  'Added';
	
        $sql=$database->check_duplicate_entry('tbl_voucherpayment',$insertion);
	 if($sql!=1){
             $insertid              			=  $database->insert('tbl_voucherpayment',$insertion);
         
         }
       
	 if (!headers_sent())
    {    
        header('Location: voucher_payment.php?msg=2');
        exit;
        }
    else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="voucher_payment.php?msg=2";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=voucher_payment.php?msg=2" />';
        echo '</noscript>'; exit;
    }
    
    
    
    
    
    
 }




if($_SERVER['REQUEST_METHOD']=='POST' && isset($_REQUEST['vhid1']))
{
   
    
    
        $id=$_REQUEST['voucherid'];
        $vtype1=$_REQUEST['type2'];
        $vhid=$_REQUEST['vhid1'];
        $amount=$_REQUEST['amount1'];
        $date = date("Y-m-d h:i:s");
        $paymentmode=$_REQUEST['paymentmode1'];
        $paidto=$_REQUEST['paidto1'];
        $chequebank=$_REQUEST['chequebank1'];
        $chequebranch=$_REQUEST['chequebranch1'];
        $chequeleafno=$_REQUEST['chequeleafno1'];
        $receivedby=$_REQUEST['receivedby1'];
        $branchid=$_SESSION['branchofid'];
        $vno=$_REQUEST['voucherbillno1'];
         $addremark=$_REQUEST['remark1'];
        $query3=$database->mysqlQuery("update tbl_voucherpayment set vp_vhid='$vhid',vp_type='$vtype1',vp_amount='$amount', vp_date='$date', vp_paymentmode='$paymentmode',vp_paidto='$paidto',vp_chequebank='$chequebank',vp_chequebranch='$chequebranch',vp_chequeleafno='$chequeleafno',vp_receivedby='$receivedby',vp_branchid='$branchid',vp_voucherno='$vno',vp_add_remark='$addremark' where vp_id='$id'");
        
 if (!headers_sent())
    {    
        header('Location: voucher_payment.php?msg=3');
        exit;
        }
    else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="voucher_payment.php?msg=3";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=voucher_payment.php?msg=3" />';
        echo '</noscript>'; exit;
    }
 }
 
 //approved start
 
 if($_SERVER['REQUEST_METHOD']=='POST' && isset($_REQUEST['vhid2']))
{     
    $staff_details = $database->show_login_ful_details($_SESSION['expodine_id']);
    $staff_id = $staff_details['ls_staffid'];
     
     $approvedby=$staff_id;
   //  echo $approvedby;
   // exit;
     
     if(isset($_REQUEST['active1']))
	{
		$active='Approved';
	}
        else 
         {
	$active='Approved';
        }
     
     
         $id1=$_REQUEST['voucherid'];
         $remarks=$_REQUEST['vhid2'];
         $approvedby=$staff_id;
        $approveddate = date("Y-m-d H:i:s");
        $query4=$database->mysqlQuery("update tbl_voucherpayment set vp_approvedby='$approvedby',vp_approveddate='$approveddate',vp_remarks='$remarks',vp_status='$active' where vp_id='$id1'");
       
//header("location: voucher_payment.php?msg=3");
 if (!headers_sent())
    {    
        header('Location: voucher_payment.php?msg=4');
        exit;
        }
    else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="voucher_payment.php?msg=4";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=voucher_payment.php?msg=4" />';
        echo '</noscript>'; exit;
    }
 }
 //approved end
 
 
 
 $alert="";
if(isset($_REQUEST['msg']))
{
	if($_REQUEST['msg']=="1")
	{
	$alert="Deleted...";
	}else if($_REQUEST['msg']=="2")
	{
	$alert="Added...";
	}else if($_REQUEST['msg']=="3")
	{
	$alert="Updated...";
	}
        else if($_REQUEST['msg']=="4")
	{
	$alert="Approved...";
	}
        
}

?>
<!doctype html>
<html ng-app="website">
<head>
<meta charset="utf-8">
<title>Voucher</title>
<meta name="description" content="">
<link href="images/favicon.png" rel="shortcut icon">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<link rel="shortcut icon" href="img/favicon.ico">
<link rel="stylesheet" href="master_style/themify-icons.css" type="text/css" /><!-- Icons -->
<link href="css/menu_master_style.css" rel="stylesheet">
<link id="bs-css" href="css/bootstrap-cerulean.min.css" rel="stylesheet">
<link rel="stylesheet" href="master_style/website.css" type="text/css">
<link rel="stylesheet" href="master_style/responsive.css" type="text/css" /><!-- Responsive -->	
<link rel="stylesheet" href="css/normal.css" type="text/css" /><!-- Responsive -->
<link rel="stylesheet" href="master_style/demo.css">	
<link rel="stylesheet" href="master_style/table_style.css">	
<link rel="stylesheet" type="text/css" href="master_style/default.css" />
<link rel="stylesheet" type="text/css" href="master_style/component.css" />
<link rel="stylesheet" type="text/css" href="master_style/popup/default.css" />
<link rel="stylesheet" type="text/css" href="master_style/popup/component.css" />
 <link href="master_style/app.css" rel="stylesheet" type="text/css">
 <link rel="stylesheet" type="text/css" media="screen" href="css/als_demo.css" />
 <script src="js/jquery-1.10.2.min.js"></script>
<script src="master_style/js/modernizr.custom.js"></script>
<style>#ascrail2002{z-index: 9999999999999999999 !important;left:2px !important } 
.ui-autocomplete{z-index:999999 !important;}.upload_view_img{bottom: 42px;float: right;height: 66px;position: relative;}
	.table_report thead th{height:25px;}.tablesorter tbody{height: 79vh !important;}
</style>
<script type="text/javascript" src="js/jquery-ui-1.8.2.custom.min.js"></script> 
<script src="js/jquery-1.10.2.js"></script>
<script type="text/javascript">
    //calender//
    $(document).ready(function () {
                
             var from=$('#from_dt_new').val();
                
             var to=$('#to_dt_new').val();
              
               
             if(from!='' || to !=''){  
                 
                 
               $("#datepickerfrom").val(from);
               $("#datepickertodt").val(to);
                 
          $.post("pagination_functions.php", {value:'load_voucherpayment',from:from,to:to},
          function (data){
          $("#vouchpmt" ).html( data);
         

         });
     
     }else{
         
     
     $("#vouchpmt" ).load( "pagination_functions.php?value=load_voucherpayment"); //load initial records
	
	//executes code below when user click on pagination links
	$("#vouchpmt").on( "click", ".pagination a", function (e){
          
		e.preventDefault();
		//$(".loading-div").show(); //show loading element
		var page = $(this).attr("data-page"); //get page number from link
                 var from=$("#datepickerfrom").val();
                    var to=$("#datepickertodt").val();
		$("#vouchpmt").load("pagination_functions.php",{"value":'load_voucherpayment',"page":page,"from":from,"to":to}, function(){ //get content from PHP page
			//$(".loading-div").hide(); //once done, hide loading element
		});
		
	});
     
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
    
     $("#datepickerfrom").change(function () {
         var  from=($(this).val());
        var to=$("#datepickertodt").val();
        if(to==""){
            var  to="";
        }
         $.post("pagination_functions.php", {value:'load_voucherpayment',from:from,to:to},
         function (data){
             $("#vouchpmt" ).html( data);
         

     });
          });
      $("#datepickertodt").change(function () {
         var  to=($(this).val());
        var from=$("#datepickerfrom").val();
         $.post("pagination_functions.php", {value:'load_voucherpayment',from:from,to:to},
         function (data){
             $("#vouchpmt" ).html( data);
         

     });
     });
    
                $("#paymentmode").change(function () {
                var aat1 = ($(this).val());
                if (aat1 == "Cheque") {

                       $(".cheque_cc").show();
                       $('.cheque_cash').css("display", "none");

                    }
                    if (aat1 == "Cash") {
                       $("#chequebranch").val("");
                       $("#chequebank").val("");
                        $("#chequeleafno").val("");
                        $(".cheque_cash").show();
                      $('.cheque_cc').css("display", "none");
                    }

                    });
            });



</script>
<script type="text/javascript">
$(document).ready(function() {
    
	
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
.tablesorter td{min-width:130px;max-width:inherit;}
.tablesorter th{min-width:130px;max-width:inherit !important;}
/*.tablesorter tr{display:block;}*/
.tablesorter tbody{overflow:visible !important}
.md-trigger_vouc img{width:23px;}


 /*pagination */
 .pagination>li>a, .pagination>li>span{
color: #000;/* box-shadow: 0px 0px 5px #ccc; */background-color:/* #FFEFDD*/rgba(245, 178, 27, 0.20);border: 1px solid #C1C1C1;font-weight: bold;}
.pagination>li>a:hover,.pagination>li>span:hover,.pagination>li>a:focus,.pagination>li>span:focus,.pagination>li>.active{background-color:bisque}

.pagination{margin:0;margin:5px 5px 5px 0;float:right}
.pagination > li > a, .pagination > li > span {padding: 6px 16px;color: #000000;background-color: rgba(222, 184, 135, 0.42);border: 1px solid rgba(175, 137, 88, 0.69)}
.pagination>.active>a, .pagination>.active>span, .pagination>.active>a:hover, .pagination>.active>span:hover, .pagination>.active>a:focus, .pagination>.active>span:focus{background-color:#A0522D;border-color: #A0522D;color:#fff;}
.pagination> li > a:hover{background-color:#A0522D;border-color: #A0522D;color:#fff;}
</style>



<!--<script>
$(document).ready(function(){
	$('.table_report tr').click(function() {
     	var id_str   =  $(this).attr("id");
		 var id_arr	  =	 id_str.split("_");
		 var selval       =  id_arr[1];
		$('.table_report tr').removeClass('table_active');
		$(this).addClass('table_active');
		$('#hiddenmenuid').val(selval);
    });
	$('.md-trigger_vouc').click( function() { 
			var id_str   =  $(this).attr("id");
			var id_arr	  =	 id_str.split("_");
			var selval       =  id_arr[1];
			$('.table_report tr').removeClass('table_active');
			$(this).parent().parent().addClass('table_active');
			$('#hiddenmenuid').val(selval);
			$('.mynewpopupload').css("display","block"); 
			$(".olddiv").addClass("new_overlay");
			var menuid=$('#hiddenmenuid').val();
			  $.post("popup/vouchpayment_edit.php", {menu:menuid},
				  function(data)
				  {
				  data=$.trim(data);
				  
				  $('.mynewpopupload').html(data);
				  });  
	});
});
</script>-->
<link rel="stylesheet" href="css/jquery-ui.css">
  <script src="js/jquery-ui.js"></script>
  <link rel="stylesheet" href="css/style_date.css">
    <script>
// $(document).ready(function() {
//	  /* date picker */
//  $("#date").datepicker({
//      changeMonth: true,
//      changeYear: true
//    });
//     $("#date1").datepicker({
//      changeMonth: true,
//      changeYear: true
//    });
    </script>

</head>
<body>
    
      <input type="hidden" value="<?=$_REQUEST['from']?>" id="from_dt_new" >
      <input type="hidden" value="<?=$_REQUEST['to']?>" id="to_dt_new" >
    
    
<div class="olddiv "></div> 
<div id="blr" class="container nopaddding">
 <?php  include "includes/topbar_master.php"; ?>
 <?php include "includes/left_menu.php"; ?>
<div class="mian">
	<div class="view-container">
		<div style=" top: 58px;"  id="container">
			<div class="breadcrumbs">
				<ul>
					<li><a href="index.php" style="cursor:pointer"><i class="ti-home"></i></a>/</li>
					<li><a style="cursor:pointer">Voucher Bill</a></li>
                      <?php if(isset($_REQUEST['msg'])){ ?>
                        <div class="load_error alertsmasters"><?=$alert?></div>
                        <script >
                       $(".load_error").delay(2000).fadeOut('slow');
                        </script>
                        <?php } ?>
				</ul>
			</div><!-- breadcrumbs -->
                <div class="content-sec">
                	<div style="  padding: 2px;" class="col-lg-12 col-md-12 main_cc">
                       <div class="cc_new_main">
                       
                     <div style="  border: 0px #B6B6B6 solid;" class="cc_new">
                       	<div  id="lista1" class="als-container">
                            <div class="pagination_voucher" style="height: 36px ">
                            <a class="md-trigger" data-modal="modal-17" href="#" onClick="voucherpaymentclr()"><div class="voucher_bill_add_btn">Add</div></a>
                            	<nav style="margin:2px 3px 0 0;float:right;">

                                    <!--                                  <ul style="margin:0;" class="pagination">
                                    <li>
                                      <a href="#" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                      </a>
                                    </li>
                                    <li><a href="#">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">4</a></li>
                                    <li><a href="#">5</a></li>
                                    <li>
                                      <a href="#" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                      </a>
                                    </li>
                                  </ul>-->
                                </nav>
                            
                                <!-- //calender//-->
                                
                            <div  id="totalsalesdiv" style="display:block;float:left; margin-left: 110px;width: 41%;" >
                                <div style="width: 49%;"  class="search_name_box_main">
                                     <div  style="color: #fff" class="text-selection_name">From:</div>
                                     <div class="input-group">
                                         <input  style="margin: 1px;height: 28px !important;border-radius: 5px;" type="text" class="form-control" id="datepickerfrom" >     
                                    </div>
                                 </div>
                                 
                                 <div  style="width: 49%;" class="search_name_box_main">
                                     <div style="color: #fff" class="text-selection_name">To  :</div>
                                     <div class="input-group">
                                         <input style="margin: 1px;height: 28px !important;border-radius: 5px;"  type="text" class="form-control" id="datepickertodt" >            
                                    </div>
                                 </div>
                            </div>

      <span style=" position: relative;top: 7px !important;margin-left: 15px;color: white;"> VOUCHER PAYMENTS  </span>      
      
      <a href="voucher_head.php" style='background-color:darkred;color: white;margin-left: 35px;border: 1px solid;border-radius: 3px;margin-top: 2px;position: absolute;padding: 2px '>VOUCHER HEAD</a>
      
      <?php if(in_array("advance", $_SESSION['menumodarray'])){ ?> 
      <a href="advance_pay_bill.php" style='background-color:darkred;color: white;margin-left: 125px;border: 1px solid;border-radius: 3px;margin-top: 2px;position: absolute;padding: 2px '>ADVANCE PAY</a>
       <?php } ?>  
      
                            </div>
                        </div>
                     </div>
            
                   </div><!--cc_new-->
                   
                   <div class="col-md-12 contant_table_cc" id="vouchpmt">
  
                   </div>
                     
                    </div><!--main_cc-->
                </div><!--main content-sec-->
		</div>
	</div>
</div>
</div><!--container-->
 <div style="width:700px;" class="md-modal md-effect-16" id="modal-17">
			<div class="md-content">
				<h3>Add New</h3>
				<div>
                    <div class="col-lg-12 col-md-12 no-padding" style="margin-bottom:10px;">
                        <form role="form"  action="voucher_payment.php"  method="post"  name="voucher_payment">
                        <span id="voucherchk" class="load_error alertsmaster" style="color:#F00" ></span> 	 
                            <div style="width:49%" class="first_form_contain">
                             	<div class="form_name_cc">Account Head<span style="color:#F00">*</span></div>
                                <div class="form_textbox_cc" id="menumaincategory_div"><div class="form-group" id="voucher_div">
                                          <?php
                                        $sql_login  =  $database->mysqlQuery("select * from tbl_voucherhead where vh_active='Y'"); 
                                        $num_login   = $database->mysqlNumRows($sql_login);
                                        if($num_login){ ?>
                                        <select class="form-control vhname" data-placeholder="Enter Voucher Name" id="vouchername" name="vhid" data-rel="chosen" tabindex="1" autofocus title="Voucher Name" left"." data-toggle="tooltip" class="form-control add_new_dropdown2">
                                          <option value="">SELECT HEAD</option>
                                          <optgroup label="    - - - - - - -"> 
                                            <?php 
                                            while($result_login  = $database->mysqlFetchArray($sql_login)) 
                                                    {  ?>
                                           
                                        <option value="<?=$result_login['vh_id']?>" id="<?=$result_login['vh_id']?>"><?=$result_login['vh_vouchername']?></option>
                                             <?php } ?> 
                                          </optgroup>

                                    </select>
                                      <?php } ?>
                                     </div>
                                 </div>
                               </div>
                        <div style="width:49%"  class="first_form_contain">	
                               	<div class="form_name_cc">Type</div>
                                 <div class="form_textbox_cc" id="type_div">
                                     <select class="form-control paymentmode" id="type1" name="type1" data-rel="chosen" tabindex="3" title="Type" left"." data-toggle="tooltip" class="form-control add_new_dropdown2">
                                        <option value="Expense">Expense</option>
                                   	<option value="Income">Income</option><!--
                                         <option value="Credit Income">Credit Income</option>
                                   	<option value="Credit Expense">Credit Expense</option>-->
                               	    </select>
                                </div>
                                
                                </div>
                                  

                                 <div style="width:49%"  class="first_form_contain">	
                               	<div class="form_name_cc">Amount</div>
                                  	 <div class="form_textbox_cc" id="vamount_div">
                                             <input type="text" class="form-control amount" onkeypress='return event.charCode == 46 || (event.charCode >= 48 && event.charCode <= 57)' id="voucheramount" name="amount"  placeholder="Amount" tabindex="2"  data-toggle="tooltip" title="Amount"></div>
<!--                                             <input type="text" name="amount" id="amount" class="form-control amount" placeholder="Amount"></div>-->
                                          </div>
                            
                                <input type="hidden"  name="branch" id="branch" value="<?=$_SESSION['branchofid']?>">

                                <input type="hidden" class="form-control" id="date" name="date" ame="date" placeholder="Date">
<!--                                <input type="hidden" class="form-control" id="date1" name="approveddate" ame="date" placeholder="Date">-->
                                
                                 <div style="width:49%"  class="first_form_contain">	
                               	<div class="form_name_cc">Payment Mode</div>
                                 <div class="form_textbox_cc" id="paymentmode_div">
                                     <select class="form-control paymentmode" id="paymentmode" name="paymentmode" data-rel="chosen" tabindex="3" title="Type" left"." data-toggle="tooltip" class="form-control add_new_dropdown2">
                                        <option value="Cash">Cash</option>
                                         <option value="Card">Card</option>
-->                                   	<option value="Cheque">Cheque</option>
                               	    </select>
                                </div>
                                
                                </div>
                                <div style="width:49%"  class="first_form_contain">	
                               	<div class="form_name_cc">Paid To</div>
                                  	 <div class="form_textbox_cc" id="paidto_div">
                                <input type="text" name="paidto" id="paidto" class="form-control paidto" placeholder="Paid To" tabindex="4"  data-toggle="tooltip"></div>
                                </div>
                                <div class="cheque_cc" style="display:none">
                                 <div style="width:49%"  class="first_form_contain">	
                               	<div class="form_name_cc">Cheque Bank Name</div>
                                  	 <div class="form_textbox_cc" id="chequebank_div">
                                <input type="text" name="chequebank" id="chequebank" class="form-control chequebank" placeholder="Bank Name" tabindex="5"  data-toggle="tooltip"></div>
                                </div>
                                
                                 <div style="width:49%"  class="first_form_contain">	
                               	<div class="form_name_cc">Cheque Branch Name</div>
                                  	 <div class="form_textbox_cc" id="chequebranch_div">
                                             <input type="text" name="chequebranch" id="chequebranch" class="form-control chequebranch" placeholder="Branch Name" tabindex="6"  data-toggle="tooltip"></div>
                                </div>
                                <div style="width:49%"  class="first_form_contain">	
                               	<div class="form_name_cc">Cheque Leaf Number</div>
                                  	 <div class="form_textbox_cc" id="chequeleafno_div">
                                <input type="text" name="chequeleafno" id="chequeleafno" class="form-control chequeleafno" placeholder="Cheque Leaf Number" tabindex="7"  data-toggle="tooltip"></div>
                                </div>
                                </div>
                                
                                 <!--cash-->
                            <div class="cheque_cash" style="display:none">
                            <div class="first_form_contain" style="width:49%">
                                <span id="vouchereditchk" class="load_error alertsmaster" style="color:#F00" ></span>
                             	<div class="form_name_cc">Cheque Bank Name</div>
                               	<div class="form_textbox_cc" id="chequebank_divs">
                                    <input type="text" class="form-control" disabled="disabled" id="chequebank11" name="chequebank1"  placeholder="Cheque Bank Name" tabindex="8"  data-toggle="tooltip" title="Cheque Bank Name" value="">
                                </div>
                               </div>
                            
                            <div class="first_form_contain" style="width:49%">
                                <span id="vouchereditchk" class="load_error alertsmaster" style="color:#F00" ></span>
                             	<div class="form_name_cc">Cheque Branch Name</div>
                               	<div class="form_textbox_cc" id="chequebranch_divs">
                                    <input type="text" class="form-control" disabled="disabled" id="chequebranch11" name="chequebranch1"  placeholder="Cheque Branch Name" tabindex="9"  data-toggle="tooltip" title="Cheque Branch Name" value="">
                                </div>
                               </div>
                            
                            <div class="first_form_contain" style="width:49%">
                                <span id="vouchereditchk" class="load_error alertsmaster" style="color:#F00" ></span>
                             	<div class="form_name_cc">Cheque Leaf Number</div>
                               	<div class="form_textbox_cc" id="chequeleafno_divs">
                                    <input type="text" class="form-control" disabled="disabled" id="chequeleafno11" name="chequeleafno1"  placeholder="Cheque Leaf Number " tabindex="10"  data-toggle="tooltip" title="Cheque Leaf Number" value="">
                                </div>
                               </div>
                            </div>
                            <!-- cash end -->
                                
                        
                                 <input type="hidden"  name="approvedby" id="approvedby" value="<?=$_SESSION['expodine_id']?>">
                                <div style="width:49%"  class="first_form_contain">	
                               	<div class="form_name_cc">Received by</div>
                                  	 <div class="form_textbox_cc" id="receivedby_div">
                                             <input type="text" id="receivedby" name="receivedby" class="form-control receivedby" placeholder="Received by" tabindex="11"  data-toggle="tooltip"></div>
                                </div>
                            
                                 <div style="width:49%"  class="first_form_contain">	
                               	<div class="form_name_cc">Journal No </div>
                                  	 <div class="form_textbox_cc" id="receivedby_div">
                                             <input type="text" id="voucherbillno" name="voucherbillno" class="form-control receivedby" placeholder="No" tabindex="11"  data-toggle="tooltip"></div>
                                </div>
                                 
                          
                                 <input type="hidden" value="2" tabindex="5" name="active"  id="status" data-toggle="tooltip" title="Status">
                        
                       <?php
                                        $sql_login  =  $database->mysqlQuery("select * from tbl_branchmaster where be_voucher_pay_approve_default='Y'"); 
                                        $num_login   = $database->mysqlNumRows($sql_login);
                                        if($num_login){         
                                  while($result_login  = $database->mysqlFetchArray($sql_login)) 
                                                    { ?>
                               
                                  <input type="hidden" value="2" tabindex="5" name="activestatus"  id="status" data-toggle="tooltip" title="Status">
                                 
                                        <?php } } ?>
<!--                               </form> -->
                    
                    <div style="width:100%"  class="first_form_contain">	
                        <div style="width:19%;" class="form_name_cc">Remark </div>
                                <div style="height: auto;width: 78%;" class="form_textbox_cc" id="receivedby_div">
                                             <textarea id="remark" name="remark" class="form-control receivedby" placeholder="remark" tabindex="11"  data-toggle="tooltip"></textarea></div>
                                </div>
                    </div>
                                    
                         <input type="hidden" name="voucherid" id="voucherid" class="menuname" style="color:black" value="<?=$result_login['vp_id']?>">       
                         <a  href="#" class="entersubmit" onClick="validate_pmnt()" tabindex="12"><span class="md-save newbut">Save</span></a>
<!--                       <a href="#" ><span class="md-close newbut" tabindex="13">Close me!</span></a>-->
                       </form> 
                        <a href="#" ><button style="width: 10%;height: 10%;" class="md-close newbut" tabindex="13">Close</button></a>
				</div>
                             </div>
                </div>
<div class="md-overlay"></div><!-- the overlay element -->


<script src="master_style/js/classie.js"></script>
<script src="master_style/js/modalEffects.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="js/jquery.cookie.js"></script>


<script type="text/javascript" src="js/jquery.tablesorter.js"></script>
<script type="text/javascript" id="js">
$(document).ready(function() {
   $("#listall").tablesorter();
}); 
</script>

<div style="position:fixed;width:100%;left:30%;top:0%;z-index:99999;" class="mynewpopupload"  ></div>
</body>
</html>

<script type="text/javascript">
   $('.entersubmit').ready(function () {
    
        $("input:text").keypress(function(event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
        }); 
        
   function numonly(evt)
{
evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        
        return false;
      
    }
    return true;
} 
        
        
function delete_confirm(status,id)
{
	var check = confirm("Are you sure you want to Change Status?");
	if(check==true)
	{
		if(status=="ToYes")
		{
		window.location="voucher_payment.php?id="+id+"&delete=yes";
		}else
		{window.location="voucher_payment.php?id="+id+"&delete=no";
		}
	}
	
} 

function delete_confirm1(status,id)
{
	var check = confirm("Are you sure you want to Change Status?");
	if(check==true)
	{
		if(status=="ToYes")
		{
		window.location="voucher_payment.php?id="+id+"&delete1=yes";
		}else
		{window.location="voucher_payment.php?id="+id+"&delete1=no";
		}
	}
	
}



 
  function voucherpaymentclr()
{
    
	document.getElementById('vouchername').value = '';
	document.getElementById('voucheramount').value = '';
//        document.getElementById('paymentmode').value = '';
        document.getElementById('paidto').value = '';
        document.getElementById('chequebank').value = '';
        document.getElementById('chequebranch').value = '';
        document.getElementById('chequeleafno').value = '';
        document.getElementById('receivedby').value = '';
     	$('#voucherchk').text('');
		$("#voucher_div").removeClass("has-error");
                $("#vamount_div").removeClass("has-error");
//                $("#paymentmode_div").removeClass("has-error");
                $("#paidto_div").removeClass("has-error");
                $("#chequebank_div").removeClass("has-error");
                $("#chequebranch_div").removeClass("has-error");
                $("#chequeleafno_div").removeClass("has-error");
                $("#receivedby_div").removeClass("has-error");
}  
  
  
    function validate_all()
{
	var a=$("#voucherid").val().trim();
	//alert(a);
			$.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checkvoucherpayment&mid="+a,
			success: function(data)
			{
			data=$.trim(data);
		        //alert(data);
			var namechk=$('#voucherchk');
                       if(data=="sorry")
			{
		 namechk.text('Already exists');
		   $("#menumaincategory_div").addClass("has-error");
	  $("#voucherid").focus();
	return false;
			}
			else
			{
		namechk.text('');
		 $("#menumaincategory_div").removeClass("has-error");
	   $("#menumaincategory_div").addClass("has-success");
	  	document.voucher_payment.submit();

			}
			}
		});

	
}
		function validate_pmnt()
                
			{
                            if(validate_voucher())
				                          {
                          			 
                                   
                                                   
//                                      if(validate_paymentmode())
//				                          {  
                                                           
                                           
                                                 
//                                            if(validate_chequebank())
//				                          {  
                                                    
//                                                if(validate_chequebranch())
//				                          { 
                                                 
//                                      if(validate_chequeleafno()){
                                          
                                                   
				       
                                            
                                              
                                            if(validate_amount())
				                          {
                                                                                        
                                    if(validate_all())
                                                    {
                                        
				                    }
                                                
                                            }
//                                        }
//                                    }
//                                }
		            
//			 }
                    
                }
            }  
                
                
		function validate_voucher()   
			{
				if($(".vhname").val()=="")
				{
					$("#menumaincategory_div").addClass("has-error");
					document.voucher_payment.vhid.focus();
                                        alert("Select Voucher Head");
					return false;
				}
                                var alphanumers = /^[a-zA-Z0-9 ]+$/;
                                 if(!alphanumers.test($("#vhid").val())){
                                 $("#menumaincategory_div").addClass("has-error");
                                document.voucher_payment.vhid.focus();
                                 alert("Special charecter Not Allowed.");
                              }
                                   else
				 {
					 $("#menumaincategory_div").removeClass("has-error");
					 $(this).addClass("has-success");
					 return true;
				 }
			}
                        
                        function validate_paidto()   
			
                            {
				if($("#paidto").val()=="")
				{
					$("#paidto_div").addClass("has-error");
					document.voucher_payment.paidto.focus();
                                        alert("Enter Paid To");
					return false;
				}
                                var alphanumers = /^[a-zA-Z0-9 ]+$/;
                                 if(!alphanumers.test($("#paidto").val())){
                                 $("#paidto_div").addClass("has-error");
                               document.voucher_payment.paidto.focus();
                                            alert("Special charecter Not Allowed.");
                              }
                               else
				 {
					 $("#paidto_div").removeClass("has-error");
					 $(this).addClass("has-success");
					 return true;
				 }
			}
                            
                            
      
                        
                        function validate_paymentmode()   
			{
				if($("#paymentmode").val()=="")
				{
					$("#paymentmode_div").addClass("has-error");
					document.voucher_payment.paymentmode.focus();
					return false;
				}else
				 {
					 $("#paymentmode_div").removeClass("has-error");
					 $(this).addClass("has-success");
					 return true;
				 }
			}
                        
                        
                        function validate_chequebank()   
			{
				if($("#chequebank").val()=="")
				{
					$("#chequebank_div").addClass("has-error");
					document.voucher_payment.chequebank.focus();
					return false;
				}else
				 {
					 $("#chequebank_div").removeClass("has-error");
					 $(this).addClass("has-success");
					 return true;
				 }
			}
                        
                        function validate_chequebranch()   
			{
				if($("#chequebranch").val()=="")
				{
					$("#chequebranch_div").addClass("has-error");
					document.voucher_payment.chequebranch.focus();
					return false;
				}else
				 {
					 $("#chequebranch_div").removeClass("has-error");
					 $(this).addClass("has-success");
					 return true;
				 }
			}

                        function validate_chequeleafno()   
			{
				if($("#chequeleafno").val()=="")
				{
					$("#chequeleafno_div").addClass("has-error");
					document.voucher_payment.chequeleafno.focus();
					return false;
				}else
				 {
					 $("#chequeleafno_div").removeClass("has-error");
					 $(this).addClass("has-success");
					 return true;
				 }
			}
                        
                        function validate_receivedby()   
			{
				if($("#receivedby").val()=="")
				{
					$("#receivedby_div").addClass("has-error");
					document.voucher_payment.receivedby.focus();
                                         alert("Enter Received by");
					return false;
				}
                                 var alphanumers = /^[a-zA-Z0-9 ]+$/;
                                 if(!alphanumers.test($("#receivedby").val())){
                                 $("#receivedby_div").addClass("has-error");
                                 document.voucher_payment.receivedby.focus();
                                 alert("Special charecter Not Allowed.");
                              }
        
                               else
				 {
					 $("#receivedby_div").removeClass("has-error");
					 $(this).addClass("has-success");
					 return true;
				 }
			}
		

			
			  function validate_amount()   
			{
			
                         if($("#voucheramount").val()=="")
				{
                                    
					$("#vamount_div").addClass("has-error");
					//document.voucher_payment.amount.focus();
                                        alert("Enter Amount");
					return false;
				}
                                    var val = parseFloat($('#voucheramount').val());
                                  if (isNaN(val) || (val === 0))
                                    {
                                       $("#vamount_div").addClass("has-error");
					//document.voucher_payment.amount.focus();
                                        alert("Enter Numeric Value and Does not start with zero.")
//                                        namechk1.text('Does not start with zero');
					return false;
                                    }
                                
//                                var alphanumers = /^[a-zA-Z0-9 ]+$/;
//                                 if(!alphanumers.test($("#amount").val())){
//                                 $("#vamount_div").addClass("has-error");
//                              document.voucher_payment.amount.focus();
//                //                            alert("Special charecter Not Allowed.");
//                              }
        
        
				 {
					 var isvalid = $.isNumeric($("#voucheramount").val()) 
						if(isvalid)
						{
							 $("#vamount_div").removeClass("has-error");
							 $(this).addClass("has-success");
							 return true;
						}else
						{
							$("#vamount_div").addClass("has-error");
							//document.voucher_payment.amount.focus();
                                                        alert("Enter Numeric Value and Does not start with zero");
							return false;
						}
				 }
			}
			
                        
                     

</script>