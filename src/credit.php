<?php
header('Content-Type: text/html; charset=utf-8');
include('includes/session.php');		// Check session
//session_start();
include("database.class.php"); // DB Connection class
$database	= new Database();
include('includes/master_settings.php');
require_once("includes/title_settings.php");
//include('includes/menu_settings.php');
include("api_multiplelanguage_link.php");
$other_lang=  trim(json_encode($_SESSION['main_language']),'""');
if(!isset($_SESSION['timeopen']) ){ header("location:index.php?msg=1"); }



if(!isset($_SESSION['creditypeid']))
{
	$_SESSION['creditypeid']='all';
}

$_SESSION['creditypeid']='all';
?>
<!DOCTYPE HTML>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Credit Settle</title>
<link rel="shortcut icon" href="img/favicon.ico">
<link href="css/bootstrap-cerulean.min.css" rel="stylesheet" />
<link href="css/order_new.css" rel="stylesheet" type="text/css">
<link href="css/take_away.css" rel="stylesheet" type="text/css">
<link href="css/billgeneration_new.css" rel="stylesheet" type="text/css">
<link href="css/credit_style.css" rel="stylesheet" type="text/css">
<script src="js/jquery-1.10.2.min.js"></script> 
<script src="js/bill_credit_main.js"></script>
<script type="text/javascript" src="js/bill_credit_select.js"></script>  
<style>
body{font-family:inherit}
.left_contant_container {height: 80vh;padding-bottom:15px;}	
.tax_table td{  padding-left: 12px;text-align: left;}
.tax_textbox {width: 100%;}
.discount_text_cc{text-align:center}
.take_staff_view_cc{width: 32.5%;margin:0px !important;margin-left:0.6% !important;margin-top: 10px !important;}
.billgeneration_head{border:0}
</style>
<script type="text/javascript">
$(document).ready(function(){



 $('#paidamount').bind('keyup paste', function(){
        this.value = this.value.replace(/[^0-9.]/g, '');
 });

 $('#transcationid').bind('keyup paste', function(){
        this.value = this.value.replace(/[^0-9.]/g, '');
 });


	
$(".credit_cc").hide();
$(".coupon_cc").hide();
$(".voucher_cc").hide();
$(".cheque_cc").hide();
$('.closetranscations').css("display","block");
$('.closetranscations_whole').css("display","none");



  $("#payemntmode_sel").change(function(){
            
				var aat=($(this).val());
                                var dec=$('#decimal').val();   
                                
				if(aat=="cash"){
                                    
                                         $('#paidamount').val("");
                                         $('#balanceamout').val("");
                                         $('#transcationid').val("");
                                         $('#transbal').val("");
                                         
					$(".cash_cc").show();
                                        $(".credit_cc").hide();
					$(".credit_cc_normal").hide();
                                        $(".coupon_cc").hide();
					$(".voucher_cc").hide();
					$(".cheque_cc").hide();
					$(".auto1").hide();
					$(".auto").hide();
					$('.paid_amount_cc').css("display","block");
					$('.paid_amount_cc_credit').css("display","none");
					$('.closetranscations').css("display","block");
					$('.closetranscations_whole').css("display","none");
					 
                                         
                       var bill_in=$('.loadpay').attr('billno');
                     
                         var ids=new Array();
			var ratevl=0;
			var selected_activities =$("[name='selectbills[]']:checked");
			selected_activities.each(function(){
			var id_str   =  $(this).attr("bilnos");
                          
			  if(id_str!='undefined' && id_str!='' && id_str!=null){
					  ids.push(id_str);
				  }
                                  
			 var rate_str       =  $(this).attr("rate");
                                 
			  if(rate_str!='undefined' && rate_str!='' && rate_str!=null){
					
				ratevl=parseFloat(ratevl) +  parseFloat(rate_str);
			}  
                        
			});
                     
                     
                        $.post("load_credit.php", {billno:bill_in,set:'load_credit_partail',paymode:'cash',ids:ids},
			function(data)
			{ 
				data=$.trim(data);
				
				$('.paid_crd_partail').html(data);
                                
                                $('.paid_crd_partail').attr('def_paid',data);	
                                
				 var gr=$('.loadpay').text();    
			        $('.bal_pay_crd').html((gr-data).toFixed(dec)); 
                          
			});       
                                         
                                         
                                         
                                         
                }
                if(aat=="credit"){
                    
                    
                
                                        $('#transcationid').val("");
                                        $('#transbal').val("");
					$('#paidamount').val("");
                                        $('#balanceamout').val("");
                                        
					$(".cash_cc").hide();
					$(".credit_cc_normal").show();
                                        $(".credit_cc").hide();
                                        $(".coupon_cc").hide();
					$(".voucher_cc").hide();
					$(".cheque_cc").hide();
					$(".auto1").hide();
					$(".auto").hide();
					$("#transcationid").focus();
					$('.paid_amount_cc').css("display","none");
					$('.paid_amount_cc_credit').css("display","none");
					$('.closetranscations').css("display","block");
					$('.closetranscations_whole').css("display","none");
                                        
                              var bill_in=$('.loadpay').attr('billno');
                     
                      var ids=new Array();
			var ratevl=0;
			var selected_activities =$("[name='selectbills[]']:checked");
			selected_activities.each(function(){
			var id_str   =  $(this).attr("bilnos");
                          
			  if(id_str!='undefined' && id_str!='' && id_str!=null){
					  ids.push(id_str);
				  }
                                  
			 var rate_str       =  $(this).attr("rate");
                                 
			  if(rate_str!='undefined' && rate_str!='' && rate_str!=null){
					
				ratevl=parseFloat(ratevl) +  parseFloat(rate_str);
			}  
                        
			});
                     
                     
                        $.post("load_credit.php", {billno:bill_in,set:'load_credit_partail',paymode:'card',ids:ids},
			function(data)
			{ 
				data=$.trim(data);
				
				$('.paid_crd_partail').html(data);
                                
                                $('.paid_crd_partail').attr('def_paid',data);	
                                
				 var gr=$('.loadpay').text();    
			        $('.bal_pay_crd').html((gr-data).toFixed(dec)); 
                          
			});                 
                                        
                }
                
              if(aat=="coupon"){
				  $(".cash_cc").hide();
                    $(".credit_cc").hide();
					$(".credit_cc_normal").hide();
                    $(".coupon_cc").show();
					$(".voucher_cc").hide();
					$(".cheque_cc").hide();
					$(".auto1").hide();
					$(".auto").hide();
					$('.paid_amount_cc').css("display","block");
					$('.paid_amount_cc_credit').css("display","none");
					$('.closetranscations').css("display","block");
					$('.closetranscations_whole').css("display","none");
                }
				if(aat=="voucher"){
					$(".cash_cc").hide();
                    $(".credit_cc").hide();
					$(".credit_cc_normal").hide();
                    $(".coupon_cc").hide();
					$(".voucher_cc").show();
					$(".cheque_cc").hide();
					$(".auto1").hide();
					$(".auto").hide();
					$('.paid_amount_cc').css("display","block");
					$('.paid_amount_cc_credit').css("display","none");
					$('.closetranscations').css("display","block");
					$('.closetranscations_whole').css("display","none");
                }
				if(aat=="cheque"){
                                    $('#paidamount').val("");
                                        $('#balanceamout').val("");
                                         $('#transcationid').val("");
                                          $('#transbal').val("");
					$(".cash_cc").hide();
                    $(".credit_cc").hide();
					$(".credit_cc_normal").hide();
                    $(".coupon_cc").hide();
					$(".voucher_cc").hide();
					$(".cheque_cc").show();
					$(".auto1").hide();
					$(".auto").hide();
					$('.paid_amount_cc').css("display","block");
					$('.paid_amount_cc_credit').css("display","none");
					$('.closetranscations').css("display","block");
					$('.closetranscations_whole').css("display","none");
                }
				
				if(aat=="credit_person"){
                                    $('#paidamount').val("");
                                        $('#balanceamout').val("");
                                         $('#transcationid').val("");
                                          $('#transbal').val("");
					$(".cash_cc").hide();
                    $(".credit_cc").hide();
					$(".credit_cc_normal").hide();
                    $(".coupon_cc").hide();
					$(".voucher_cc").hide();
					$(".cheque_cc").hide();
					$(".auto1").hide();
					$(".auto").show();
					$('.paid_amount_cc').css("display","none");
					$('.paid_amount_cc_credit').css("display","block");
					$('.closetranscations').css("display","none");
					$('.closetranscations_whole').css("display","block");
                }
				
				if(aat=="complimentary"){
                                    $('#paidamount').val("");
                                        $('#balanceamout').val("");
                                         $('#transcationid').val("");
                                          $('#transbal').val("");
					$(".cash_cc").hide();
                    $(".credit_cc").hide();
					$(".credit_cc_normal").hide();
                    $(".coupon_cc").hide();
					$(".voucher_cc").hide();
					$(".cheque_cc").hide();
					$(".auto").hide();
					$(".auto1").show();
					$('.paid_amount_cc').css("display","none");
					$('.paid_amount_cc_credit').css("display","none");
					$('.closetranscations').css("display","none");
					$('.closetranscations_whole').css("display","block");
                }
				
           //});
        });
	});	
       </script> 
</head>

<body>
<div class="olddiv1 "></div>
<div class="container-fluid no-padding">
 <input type="hidden" value="<?=$_SESSION['be_decimal']?>" id="decimal" >
    <?php include "includes/topbar.php"; ?>

      <div class="middle_container">
      <div style="width:100%;" class="top_site_map_cc ">
      
      <?php if(in_array("Credit Settlement", $_SESSION['menumodarray'])){ ?>
              <a href="<?php if(isset($_SESSION['timeopen']) && !isset($_SESSION['timeclose'])){ ?>credit.php  <?php }else {  ?>#<?php } ?>"><div class="new_tab_btn_credit new_tab_btn_credit_act"><?=$_SESSION['credit_settlement_settlement']?></div></a> 
              <?php } ?> 
              
               <?php if(in_array("Credit Master", $_SESSION['menumodarray'])){ ?>
              <a href="<?php if(isset($_SESSION['timeopen']) && !isset($_SESSION['timeclose'])){ ?>credit_master.php  <?php }else {  ?>#<?php } ?>"><div class="new_tab_btn_credit "><?=$_SESSION['credit_settlement_creditmaster']?></div> </a>
              <?php } ?> 
              <a href="accounts/ledger.php"><div style="background: #77b7b7;color: black " class="new_tab_btn_credit ">ACCOUNTS</div></a> 
              <!--<a href="credit.php"><div class="new_tab_btn_credit new_tab_btn_credit_act">Detail</div></a> 
              <a href="credit_master.php"><div class="new_tab_btn_credit">Credit Master</div> </a>-->
        <?php include"includes/new_right_menu.php"; ?> 
            	<div class="billgeneration_head"><?=$_SESSION['credit_settlement_credit_details']?></div>
                <div class="error_feed" style="color:#F00;font-size: 10px;margin-left: -77px"></div>
                
              
                <div class="top_al_search_cc loaderror" ></div>
            </div>
            
      		<div style="  min-height:480px;width:100%" class="left_contant_container">
                     
                <div class="take_staff_view_cc">
                 
                	<!--<div class="bill_shadow_left"></div>-->
                	<div class="take_staff_view_head">
                    	<div class="bill_head_pin"></div>
                        <div class="staf_view_list_hd"><?=$_SESSION['credit_settlement_credit_details']?></div>
                    </div><!--take_staff_view_head-->
                    
                     
                     
                    <div  class="take_staff_view_cont_cc">	<!--style="height:300px;min-height: 68.5vh;"-->
                    	<div class="floor_sel_in_table_detail">
                     	<div class="floor_area_sel_name"><?=$_SESSION['credit_settlement_credit_types']?></div>
                        <div class="floor_area_sel_textbx">
                        	<select style="width:100%;" class="discount_text_box tax_textbox" id="creditypeslist" name="creditypeslist">
<!--                                  <option value="" selected><?=$_SESSION['credit_settlement_select_credit']?></option>-->
                                   <?php
											  //`tbl_credit_types`(`ct_creditid`, `ct_credit_type`, `ct_active`)
										   $sql_ds_nos="select ct_creditid,ct_credit_type from tbl_credit_types where ct_active='Y' ";
										  $sql_ds  =  $database->mysqlQuery($sql_ds_nos); 
										  $num_ds = $database->mysqlNumRows($sql_ds);
										  if($num_ds){ 
										   while($result_ds = $database->mysqlFetchArray($sql_ds)) 
												  {
													  if(!isset($_SESSION['creditypeid']))
														{
															$_SESSION['creditypeid']='all';
														}

													  
											?>    
                                        
                                  <option value="<?=$result_ds['ct_creditid']?>" label="<?=$result_ds['ct_credit_type']//$result_ds['ct_labels']?>"  <?php if($_SESSION['creditypeid']==$result_ds['ct_creditid']){?>  selected <?php } ?> ><?=$result_ds['ct_credit_type']// $result_ds['ct_credit_type']?></option>
                                      
                                      <?php } } ?> 
                    			  <option value="all" <?php if($_SESSION['creditypeid']=='all'){?>  selected <?php } ?>><?=$_SESSION['credit_settlement_all']?></option>	
                                  </select>
                        </div>
                     </div>
                     
                     <div class="bill_gen_new_table_head" id="loadtablecredithead">
                     <table class="billgenration_new_table" width="100%" border="0">
                      <thead>
                                    <tr>
                                    <th width="10%"><?=$_SESSION['credit_settlement_slno']?></th>
                                    <?php if($_SESSION['creditypeid']!='all'){?>  <th width="20%" ><span class="loadtype"></span></th> <?php } ?>
                                    <?php if($_SESSION['creditypeid']=='all'){?> <th width="20%"><?=$_SESSION['credit_settlement_name']?></th> <?php } ?>
                                    <?php if($_SESSION['creditypeid']=='all'){?> <th width="20%"><?=$_SESSION['credit_settlement_type']?></th> <?php } ?>
                                    <th width="15%"><?=$_SESSION['credit_settlement_amount']?></th>
                                    
                                    </tr>
                      </thead>
                     </table>
                     </div>
                     
                    <div class="billgenration_new_table_content_container loadcreditwholelist" style="min-height:420px;height:68vh;">
     <?php
     
         $creditype=$_SESSION['creditypeid'];
	 $sqlquery='';
	 if($creditype=='1')
	 {
	$sqlquery=("SELECT rm.rm_roomno as name,cm.crd_totalamount as amount,ct.ct_labels as label,cm.crd_id as cid,ct.ct_creditid as labellan from tbl_credit_types as ct LEFT JOIN tbl_credit_master as cm ON ct.ct_creditid=cm.crd_type LEFT JOIN tbl_roommaster as rm ON rm.rm_roomid=cm.crd_roomid  WHERE ct.ct_active='Y'  AND ct.ct_creditid='1'");
	 }else if($creditype=='2')
	{
	$sqlquery=("SELECT sm.ser_firstname as name,sm.ser_lastname  as name2,cm.crd_totalamount as amount,ct.ct_labels as label,cm.crd_id as cid,ct.ct_creditid as labellan,ct.crd_staffid from tbl_credit_types as ct LEFT JOIN tbl_credit_master as cm ON ct.ct_creditid=cm.crd_type  LEFT JOIN tbl_staffmaster as sm ON sm.ser_staffid=cm.crd_staffid WHERE ct.ct_active='Y'  AND ct.ct_creditid='2' AND sm.ser_employeestatus='Active' order by name asc");
	}else if($creditype=='3')
	{
	$sqlquery=("SELECT csm.ct_corporatename as name, cm.crd_totalamount as amount,ct.ct_labels as label,cm.crd_id as cid,ct.ct_creditid as labellan ,cm.crd_corporateid from tbl_credit_types as ct LEFT JOIN tbl_credit_master as cm ON ct.ct_creditid=cm.crd_type LEFT JOIN tbl_corporatemaster as csm ON csm.ct_corporatecode=cm.crd_corporateid  WHERE ct.ct_active='Y' AND ct.ct_creditid='3' order by name asc");
	}else if($creditype=='4')
	{
	$sqlquery=("SELECT lr.ly_mobileno as num,lr.ly_firstname as name,lr.ly_lastname as name2,cm.crd_totalamount as amount,ct.ct_labels as label,cm.crd_id as cid,ct.ct_creditid as labellan from tbl_credit_types as ct LEFT JOIN tbl_credit_master as cm ON ct.ct_creditid=cm.crd_type LEFT JOIN tbl_loyalty_reg as lr ON lr.ly_id=cm.crd_guestid  WHERE ct.ct_active='Y'  AND ct.ct_creditid='4' order by name asc");
	}else if($creditype=='all')
	{
		$sqlquery=("SELECT cm.crd_staffid,cm.crd_roomid,cm.crd_corporateid,cm.crd_guestid,cm.crd_totalamount as amount,ct.ct_labels as label,cm.crd_id as cid,ct.ct_creditid as labellan from tbl_credit_types as ct LEFT JOIN tbl_credit_master as cm ON ct.ct_creditid=cm.crd_type LEFT JOIN tbl_loyalty_reg as lr ON lr.ly_id=cm.crd_guestid WHERE ct.ct_active='Y'  ");
	}
	 
	?>
     <table class="billgenration_new_table_content" width="100%" border="0">  
        <tbody >
       <?php
	    $sql_ds  =  $database->mysqlQuery($sqlquery); 
		$num_ds = $database->mysqlNumRows($sql_ds);
		if($num_ds){ $i=1;
		 while($result_ds = $database->mysqlFetchArray($sql_ds)) 
				{
					
					$wordlist = array("Name", "name", "No", "no");
					foreach ($wordlist as &$word) {
						$word = '/\b' . preg_quote($word, '/') . '\b/';
					}
					$label = preg_replace($wordlist, '', $result_ds['label']);
					//$label=$_SESSION[$result_ds['labellan']]['credittypes_label'];
					$name='';
					if($creditype=='all')
					{
						  if(!is_null($result_ds['crd_staffid']))
						  {
							  $staff=$database->show_masterstaff_details($result_ds['crd_staffid']);
							  $name=$staff['ser_firstname'];
						  }else if(!is_null($result_ds['crd_roomid']))
						  {
							  $staff=$database->show_masterroom_details($result_ds['crd_roomid']);
							  $name=$staff['rm_roomno'];
						  }else if(!is_null($result_ds['crd_corporateid']))
						  {
							  $staff=$database->show_mastercorporate_details($result_ds['crd_corporateid']);
							  $name=$staff['ct_corporatename'];
						  }else if(!is_null($result_ds['crd_guestid']))
						  {
							  $staff=$database->show_masterloyality_details($result_ds['crd_guestid']);
							  $name=$staff['ly_firstname'];
                                                           $num_stfs=$staff['ly_mobileno'];
						  }
					}else
					{//echo "ff".$result_ds['label']."gg";
					//echo $result_ds['crd_staffid']."ll";
						if(trim($result_ds['label'])=="Staff name")
						  {
							  $staff=$database->show_masterstaff_details($result_ds['crd_staffid']);
							  $name=$staff['ser_firstname'];
						  }else if($result_ds['label']=="Room No")
						  {
							  $staff=$database->show_masterroom_details($result_ds['crd_roomid']);
							 $name=$staff['rm_roomno'];
						  }else if($result_ds['label']=="Company Name")
						  {
							  $staff=$database->show_mastercorporate_details($result_ds['crd_corporateid']);
							  $name=$staff['ct_corporatename'];
						  }else if($result_ds['label']=="Guest Name")
						  {
							  $staff=$database->show_masterloyality_details($result_ds['crd_guestid']);
							  $name=$result_ds['name'];
                                                          $num_stfs=$result_ds['num'];
						  }
						//$name=$result_ds['label'];
					}
                                        
                                        
                                        $sqlquery151="SELECT sum(cd_amount) as cd_sum from tbl_credit_details
                    Where cd_settled='N' AND cd_masterid='".$result_ds['cid']."' ";
             
		 $sql_ds15  =  $database->mysqlQuery($sqlquery151); 
		$num_ds15 = $database->mysqlNumRows($sql_ds15);
		if($num_ds15){ 
		 while($result_ds156 = $database->mysqlFetchArray($sql_ds15)) 
				{	
                     
                     if($result_ds156['cd_sum']>0){
							?>
              <tr class="clickeachcredit" crdit="<?=$result_ds['cid'] ?>"><!--<tr class="tr_bill_gen_active">-->
              <td width="10%"><?=$i++;?></td>
              <?php if($creditype!='all'){?> <td width="60%"><?=$name.' &nbsp &nbsp '.$num_stfs ?></td> <?php } ?>
              <?php if($creditype=='all'){?> <td  width="40%"><?=$name.' &nbsp &nbsp '.$num_stfs ?> </td> <?php } ?>
              <?php if($creditype=='all'){?> <td width="20%" style="font-size:10px"><?=$label?> &nbsp  [<?=$result_ds['cid'] ?>]</td> <?php } ?>
              
               <?php 
                    $sqlquery15="SELECT sum(cd_amount) as cd_sum from tbl_credit_details
                    Where cd_settled='N' AND cd_masterid='".$result_ds['cid']."' and cd_billno!='' ";
             
		 $sql_ds15  =  $database->mysqlQuery($sqlquery15); 
		$num_ds15 = $database->mysqlNumRows($sql_ds15);
		if($num_ds15){ 
		 while($result_ds15 = $database->mysqlFetchArray($sql_ds15)) 
				{
                                        ?>
                <td width="30%"><?=number_format($result_ds15['cd_sum'],$_SESSION['be_decimal'])?></td>
                   <?php } } ?>
                
              </tr>
                     <?php } } } } } ?>
         

        </tbody>
        
        </table>
                            </div><!--billgenration_new_table_content_container--->
                            
                    
                            
                            
                    </div>
                </div>
                
                <div class="take_staff_view_cc">
                
                	<div class="take_staff_view_head">
                    	<div class="bill_head_pin"></div>
                        <div class="staf_view_list_hd"><?=$_SESSION['credit_settlement_order_details']?></div>
                    </div><!--take_staff_view_head-->
                  <div class="take_staff_view_cont_cc">
                  <div id="billdetails" class="loadeachcreditbildetails">
                  	
                     
                       </div>       
                      
                  </div><!--take_staff_view_cc-->
                  <div class="take_staff_view_cont_bottom_contain" style="bottom:10px">
                    	<div class="tottal_rate_contain"><?=$_SESSION['credit_settlement_total_rate']?> : <span class="grandtotal">0.000</span></div>
                       
                    </div>
                  </div>
                
                <div style="margin-right: 0;" class="take_staff_view_cc">
                	
                    <div class="take_staff_view_head">
                    	<div class="bill_head_pin"></div>
                        <div class="staf_view_list_hd">
                             
                             <?=$_SESSION['credit_settlement_bill_details']?>
                            
                           
                        <span style="float:right;font-size: 10px;margin-right: 20px"> Balance: <span class="bal_pay_crd">0</span></span>
                            
                        <span style="float:right;font-size: 10px;margin-right: 20px">Paid: <span class="paid_crd_partail">0</span></span>
                            
                        
                            <span style="float:right;font-size: 10px;margin-right: 20px">Total: <span class="loadpay">0</span></span>
                            
                            
                            <span id="view_partial" onclick="view_partial()" style="float:right;font-size: 10px;margin-right: 10px;display: none"><span style="border:solid 1px;padding: 2px;cursor: pointer">INFO</span></span>
                        
                            
                            
                        </div>
                       
                        <div id="view_partial_pays" style="border-radius: 7px;margin-left: 15px;display: none;margin-top: 42px;
                        background-color: white;width: 30.5%;height: auto;color: #1e1c1c;z-index: 9999999 !important;position: fixed;">
                               
                            <h>PAYMENT DETAILS</h><span onclick="close_pop_partial()" style="margin-right: 6px;float: right;border: solid 1px;border-radius: 3px;cursor: pointer;
                            padding-right:5px;padding-left: 5px;color: darkred;margin-top: 5px;">X</span>    <br>
                               
                            <div id="load_pays_partial" style="text-align: left;padding-left: 2px;padding-bottom: 8px;padding-top: 5px;">
                            
                             </div>    
                            
                            </div>
                        
                        
                    </div>
                    
                    
                   
                    
                    <div class="take_staff_view_cont_cc " >
                    <div class="viewpayment" style="display:none">
                	<div style="border-bottom-width: 1px; border-bottom-color: rgb(204, 204, 204); border-bottom-style: solid; height: 48px; margin-top: 0px; display: block;" class="discount_text_box paymentclose">
                       <table class="tax_table" width="100%" border="0" cellspacing="5">
                       		<tbody><tr>
                            	<td width="45%"><?=$_SESSION['credit_settlement_select_payment']?></td>
                                <td width="5%">:</td>
                                <td width="50%">
                                   <select style="width:100%;" class="discount_text_box tax_textbox" id="payemntmode_sel" name="payemntmode_sel">
                                  
                                  <?php
								  $sql_ds_nos="select pym_id,pym_code,pym_name from tbl_paymentmode WHERE pym_credit_view='Y'";
								  $sql_ds  =  $database->mysqlQuery($sql_ds_nos); 
								  $num_ds = $database->mysqlNumRows($sql_ds);
								  if($num_ds){ $i=1;
								   while($result_ds = $database->mysqlFetchArray($sql_ds)) 
										  { ?>
										  <option  value="<?=$result_ds['pym_code']?>" idval="<?=$result_ds['pym_id']?>" <?php if($i==1){ ?> selected <?php } ?> ><?=$result_ds['pym_name']?></option>
					<?php $i++; } }  ?>
                                                                                  
                                   							
                                  </select>
                                </td>
                            </tr>
                       
                       </tbody></table>
                         
                       </div>
                       
                        
                        	<div class="credit_cc_normal" style="display: none;">
                            <div class="discount_text_cc crd_head"><?=$_SESSION['credit_settlement_card']?></div>
                            	<table class="tax_table" width="100%" border="0" cellspacing="5">
                              <tbody>
                              <tr>
                                <td width="35%"><?=$_SESSION['credit_settlement_trans_bank']?></td>
                                <td width="5%">:</td>
                                <td width="50%"><div class="discount_text_box paymod_text_box">
                                        <select id="bankdetails" class=" discount_text_box tax_textbox" >
                                           
                                                
                                     <?php
									$sql_ds_nos="select bm_id,bm_name from tbl_bankmaster where bm_active='Y' ";
									$sql_ds  =  $database->mysqlQuery($sql_ds_nos); 
									$num_ds = $database->mysqlNumRows($sql_ds);
									if($num_ds){ 
									 while($result_ds = $database->mysqlFetchArray($sql_ds)) 
											{
										?>    
                                       <option value="<?=$result_ds['bm_id']?>"><?=$result_ds['bm_name']//$result_ds['bm_name']?></option>
                                      <?php } } ?>
                                        </select>
                                    </div></td>
                              </tr>
                              <tr>
                                <td width="35%"><?=$_SESSION['credit_settlement_trans_amount']?></td>
                                <td width="5%">:</td>
                                <td width="50%"><div class="discount_text_box paymod_text_box">
                                        <input  placeholder="<?=$_SESSION['credit_settlement_placeholder_trans_amount']?>" class="tax_textbox transa_txt" name="transcationid" id="transcationid"  onkeyup="transamountchange(this.event)" >
                                    </div></td>
                              </tr>
                              <tr>
                                <td width="45%"><?=$_SESSION['credit_settlement_balance_pay']?></td>
                                <td width="5%">:</td>
                                <td width="50%"><div class="discount_text_box paymod_text_box">
                                        
                                         <input  placeholder="<?=$_SESSION['credit_settlement_placeholder_balance']?>" class="tax_textbox transa_txt" name="transbal" id="transbal" readonly>
                                    </div></td>
                              	</tr>
                             </tbody></table> 	
                            </div><!--credit_cc-->
                            <div class="coupon_cc" style="display: none;">
                            	 <div class="discount_text_cc crd_head">Coupons</div>
                            	<table class="tax_table" width="100%" border="0" cellspacing="5">
                             	 <tbody><tr>
                                <td width="45%">Coupon Name</td>
                                <td width="5%">:</td>
                                <td width="50%"><div class="discount_text_box paymod_text_box">
                                       <select id="menu05" class="discount_text_box tax_textbox">
                                        <option value="">Coupon Name</option>
                                       
                      <?php
									
	               $sql_ds_nos="select cy_companyname from tbl_couponcompany where cy_active='Yes' and cy_startdate <= '".$_SESSION['date']."' ";
			$sql_ds  =  $database->mysqlQuery($sql_ds_nos); 
			$num_ds = $database->mysqlNumRows($sql_ds);
			if($num_ds){ 
			 while($result_ds = $database->mysqlFetchArray($sql_ds)) 
					{
				?>    
                                        
                                       <option value="<?=$result_ds['cy_companyname']?>"><?=$result_ds['cy_companyname']?></option>
                                      
                                      <?php } } ?>
                                        </select>
                                    </div></td>

                              	</tr>
                                 <tr>
                                <td width="45%">Coupon Amount</td>
                                <td width="5%">:</td>
                                <td width="50%"><div class="discount_text_box paymod_text_box">
                                       <input  placeholder="Enter Coupon Amount" class="tax_textbox transa_txt" name="coupamount" id="coupamount" onChange="couponamountchange()">
                                    </div></td> 
                              	</tr>
                                <tr>
                                <td width="45%">Balance to Pay</td>
                                <td width="5%">:</td>
                                <td width="50%"><div class="discount_text_box paymod_text_box">
                                        <input  placeholder="Balance" class="tax_textbox transa_txt" name="coupbal" id="coupbal" readonly>
                                    </div></td>
                              	</tr>
                             </tbody></table> 
                            </div><!--coupon_cc-->
                            <div class="voucher_cc" style="display: none;">
                            	 <div class="discount_text_cc crd_head">Voucher</div>
                            	<table class="tax_table" width="100%" border="0" cellspacing="5">
                              <tbody><tr>
                                <td width="45%">Voucher ID</td>
                                <td width="5%">:</td>
                                <td width="50%"><div class="discount_text_box paymod_text_box">
                                  <input  placeholder="Enter Voucher ID" class="tax_textbox transa_txt" name="vouchid" id="vouchid" >
                                    </div></td>
                              </tr>
                              <tr>
                                <td width="45%">Voucher Amount</td>
                                <td width="5%">:</td>
                                <td width="50%"><div class="discount_text_box paymod_text_box">
                                        <input  placeholder="Voucher Amount" class="tax_textbox transa_txt" name="vocamount" id="vocamount" readonly >
                                    </div></td> 
                              	</tr>
                              <tr>
                                <td width="45%">Balance to Pay</td>
                                <td width="5%">:</td>
                                <td width="50%"><div class="discount_text_box paymod_text_box">
                                        <input  placeholder="Balance" class="tax_textbox transa_txt" name="vouchbal" id="vouchbal" readonly>
                                    </div></td>
                              	</tr>
                             </tbody></table> 
                            </div><!--voucher_cc-->
                            <div class="cheque_cc" style="display: none;">
                             <div class="discount_text_cc crd_head">Cheque</div>
                            	<table class="tax_table" width="100%" border="0" cellspacing="5">
                              <tbody><tr>
                                <td width="45%">Cheque No</td>
                                <td width="5%">:</td>
                                <td width="50%"><div class="discount_text_box paymod_text_box">
                                        <input  placeholder="Enter Cheque No" class="tax_textbox transa_txt"  name="cheqname" id="cheqname">
                                    </div></td>
                              </tr>
                               <tr>
                                <td width="45%">Bank Name</td>
                                <td width="5%">:</td>
                                <td width="50%"><div class="discount_text_box paymod_text_box">
                                        <input  placeholder="Enter Bank Name" class="tax_textbox transa_txt" name="cheqbank" id="cheqbank">
                                    </div></td>
                              </tr>
                              <tr>
                                <td width="45%">Amount</td>
                                <td width="5%">:</td>
                                <td width="50%"><div class="discount_text_box paymod_text_box">
                                       <input  placeholder="Enter Cheque Amount" class="tax_textbox transa_txt" name="cheqamount" id="cheqamount" onChange="cheqamountchange()">
                                    </div></td>
                              </tr>
                               <tr>
                                <td width="45%">Balance to Pay</td>
                                <td width="5%">:</td>
                                <td width="50%"><div class="discount_text_box paymod_text_box">
                                        <input  placeholder="Balance" class="tax_textbox transa_txt" name="cheqbal" id="cheqbal" readonly>
                                    </div></td>
                              	</tr>
                             </tbody></table> 	
                            </div><!--cheque_cc--><!--cheque_cc-->
                            
                            <input type="hidden" name="credit" id="creditmsg1" value="<?=$_SESSION['credit_settlement_error_select_payment'] ?>">
                             <input type="hidden" name="credit" id="creditmsg2" value="<?=$_SESSION['credit_settlement_error_enter_amount'] ?>">
                             <input type="hidden" name="credit" id="creditmsg3" value="<?=$_SESSION['credit_settlement_error_close'] ?>">
                            <!--credit_ccc-->
                            
                            
                             <div style="display:none" class="complimentrary_cc auto1">
                             <div class="discount_text_cc crd_head">Complimentery</div>
                                  <textarea placeholder="Enter Complimentary" class="room_textarea" ></textarea>
                            </div>
                        
                        
                      <div class="paid_amount_cc" >
                    		<table class="tax_table" width="100%" border="0" cellspacing="5">
                             	 <tbody>
                                     <tr>
                                    <td width="45%"><?=$_SESSION['credit_settlement_amount_paid']?></td>
                                    <td width="5%">:</td>
                                    <td width="50%"><div class="discount_text_box paymod_text_box">
                                            <input  placeholder="Cash Payment" class="tax_textbox transa_txt" autocomplete="off" autofocus id="paidamount" name="paidamount"  onkeyup="enterbalance()"  value="">
                                        </div></td>
                                    </tr>
                                     <tr>
                                    <td width="45%"><?=$_SESSION['credit_settlement_balance_amount']?></td>
                                    <td width="5%">:</td>
                                    <td width="50%"><div class="discount_text_box paymod_text_box">
                                             <input  placeholder="Balance Cash " class="tax_textbox transa_txt" id="balanceamout" name="balanceamout" value="" readonly>
                                        </div></td>
                                    </tr>
                            	 </tbody>
                             </table> 
                             
                    	</div>
                        
                        
                        
                        <div style="display:none" class=" auto">
                            	<div class="discount_text_cc crd_head"><?=$_SESSION['credit_settlement_credit_types']?></div>
                                	<div class="crd_select_head_cc">
                                      <span style="width: 20%" class="room_no_txt">Select :</span>
                                      <span style="width: 78%;float: left" class="room_text_box_cc">
                                          <select class="staff_menu_select" name="selectcreditypes" id="selectcreditypes">
                                          <option value="">Select</option>
                                       <option value="1" label="Room No"><?=$_SESSION['credit_settlement_by_room']?></option>
                                       <option value="2" label="Staff name"><?=$_SESSION['credit_settlement_by_staff']?></option>
                                       <option value="3" label="Company Name"><?=$_SESSION['credit_settlement_by_company']?></option>
                                       <option value="4" label="Guest Name"><?=$_SESSION['credit_settlement_by_guest']?></option>
                                      
                                                                  
                                        </select>
                                      </span>
                                      	</div>
                                      <div class="credit_room_cc credtitypeloads">
                                      		
                                      </div>
                                     
                            	
                        	</div>
                        
                        
                            <div class="take_staff_view_cont_bottom_contain" style="bottom:15px">
                    
                        <a href="#" class="closetranscations22" style="display: none;"><div class="bill_print_btn">A4 Print & <?=$_SESSION['credit_settlement_paid_button']?></div></a>
                        <a href="#" class="closetranscations_whole" style="display:none"><div class="bill_print_btn">Close</div></a>
                        <a class="closetranscations1" href="#" style="display:block;"><div style="width: 30%" class="bill_print_btn">Print & Settle</div></a>
                        <a class="closetranscations5" href="#" style="display:none;"><div style="width: 30%" class="bill_print_btn">Partial Print & Settle</div></a>
                  
                            
                    </div>
                    </div>
                    </div>
                    
                </div>
                
            </div>
    
        
        
        
      </div><!--middle_container-->          
      </div><!--container_fluide-->

<div style="display: none;" class="index_popup_confrm">
 	<div class="index_popup_contant">
    <h3 class="pop_h3_bill"><?=$_SESSION['credit_settlement_bill_no']?> - <span class="loadbilnos"> </span></h3>
    <div class="listbilnodetails">
       
              </div>
    </div>
    <div class="index_popup_contant">
    	<!--<div class="btn_index_popup"><a href="#" class="yes">Yes</a></div>-->
        <div class="btn_index_popup"><a href="#" class="no">Close</a></div>
    </div>
 </div>


<div style="display: none;" class="confrmation_overlay"></div>

    
   
<script>
$(".no").click(function() {
    $(".index_popup_confrm").fadeOut(0, function() {
        $(".confrmation_overlay").hide();
    });
 
});
</script>
 <style>

 .confrmation_overlay{
	width:100%;
	height:100%;
	position:fixed;
	z-index:999;
	background-color:rgba(0,0,0,0.8);
	top:0;
		}
.index_popup_contant{
	width:100%;
	height:auto;
	float:left;
	text-align:center;
	line-height:25px;
	font-size: 16px;
	}			
.index_popup_reg{
		width:35%;
	height:80px;
	position:absolute;
	margin:auto;
	background-color:#fff;
	border-radius:2px;
	box-shadow:0 0 5px #ccc;
	right:0;
	left:0;
	top:0;
	bottom:0;
	z-index:9999;
	overflow:hidden;
}
 .index_popup_1{
	width:35%;
	height:180px;
	position:absolute;
	margin:auto;
	background-color:#fff;
	border-radius:2px;
	box-shadow:0 0 5px #ccc;
	right:0;
	left:0;
	top:0;
	bottom:0;
	z-index:9999;
	overflow:hidden;
	}
/*.index_popup_contant{
	width:100%;
	height:auto;
	float:left;
	text-align:center;
	line-height:40px;
	font-size: 16px;
	}*/
.index_popup_confrm{
	width:35%;
	height:475px;
	position:absolute;
	margin:auto;
	background-color:#fff;
	border-radius:2px;
	box-shadow:0 0 5px #ccc;
	right:0;
	left:0;
	top:0;
	bottom:0;
	z-index:9999;
	overflow:hidden;
}
.index_popup_2{
	width:35%;
	height:270px;
	position:absolute;
	margin:auto;
	background-color:#fff;
	border-radius:5px;
	box-shadow:0 0 5px #ccc;
	right:0;
	left:0;
	top:0;
	bottom:0;
	z-index:9999;
	overflow:hidden;
	}			
.btn_index_popup{
	width:15%;
	display:inline-block;
	height:25px;
	line-height:25px;
	background-color: #FF2306;
	text-align:center;
	margin-right:1%;
	border-radius:5px;
	transition:all 0.2s ease;
	}
.btn_index_popup a{
	color:#fff !important;
	font-size:15px;	
	text-decoration:none;
	display:block;
	}		
.btn_index_popup:hover{background-color:#333;}	
.btn_index_popup a:hover{color:#fff;}

	</style>

 <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
 <!-- library for cookie management -->
 <script src="js/jquery.cookie.js"></script> 

</body>

</html>