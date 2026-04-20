<?php

session_start();

                        require_once("vendor/autoload.php");
                        use Salla\ZATCA\GenerateQrCode;
                        use Salla\ZATCA\Tags\InvoiceDate;
                        use Salla\ZATCA\Tags\InvoiceTaxAmount;
                        use Salla\ZATCA\Tags\InvoiceTotalAmount;
                        use Salla\ZATCA\Tags\Seller;
                        use Salla\ZATCA\Tags\TaxNumber;


if (!isset($_SESSION['db_type']) || $_SESSION['db_type']=='' || !isset($_REQUEST['db_type'])) {
    $_SESSION['db_type'] = 'normal';
}


//if($_SESSION['db_type']=='' || !isset($_REQUEST['db_type'])){
//    $_SESSION['db_type']='normal';
//}
 
if(isset($_REQUEST['set'] ) && ($_REQUEST['set']=="set_normal" )){
   $_SESSION['db_type']='normal';
}

if(isset($_REQUEST['set'] ) && ($_REQUEST['set']=="set_archive" )){
  $_SESSION['db_type']='archive';
}
   

if($_SESSION["archive_enabled"]=='Y'){ 
if($_SESSION['db_type']=='archive'){
        
     include("database.class.reports.php");
    $database	= new Database();  
    
    
      $localhost=mysqli_connect(HOST_NAME, USER_NAME, PASSWORD,DATABASE_NAME_REPORT);
}else{
     include("database.class.php"); 
     $database	= new Database(); 
       $localhost=mysqli_connect(HOST_NAME, USER_NAME, PASSWORD,DATABASE_NAME);
}
}else{
    include("database.class.php"); 
     $database	= new Database();  
       $localhost=mysqli_connect(HOST_NAME, USER_NAME, PASSWORD,DATABASE_NAME);
}



            $sql_gen =  mysqli_query($localhost,"select be_saudi_format from tbl_branchmaster"); 
       
		  $num_gen  = mysqli_num_rows($sql_gen);
		  if($num_gen)
		  {
				while($result_invoice6  = mysqli_fetch_array($sql_gen)) 
					{
                                          
                                           $sa_format_on=$result_invoice6['be_saudi_format'];
                                        }
                  }



?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>.</title>
<link href="css/menu_master_style.css" rel="stylesheet">
<link id="bs-css" href="css/bootstrap-cerulean.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/font-awesome.min.css">
<link href="css/app.css" rel="stylesheet" type="text/css">
<link href="bower_components/chosen/chosen.min.css" rel='stylesheet'>
<link rel="stylesheet" type="text/css" href="mn/css/normalize.css" />
<link rel="stylesheet" type="text/css" href="mn/css/demo.css" />
<link rel="stylesheet" type="text/css" href="mn/css/icons.css" />
<link rel="stylesheet" type="text/css" href="mn/css/component.css" />
<link rel="stylesheet" href="css/tabs_mn_master.css">
<link rel="stylesheet" type="text/css" href="css/turbotabs.css" />
<link rel="stylesheet" type="text/css" href="css/animate.min.css" />
<link rel="stylesheet" type="text/css" href="css/report_styl.css" />

<style>.left_list_cc{height: 71vh;min-height: 498px !important}</style>
<script src="js/jquery-1.10.2.min.js"></script>
<script src="mn/js/modernizr.custom.js"></script>
<script src="js/jquery.nicescroll.min.js"></script>
<style>
    .table-font {
  
    font-size: 15px;
}
    .newconsl_table th, td{padding: 3px !important;}
    ::-webkit-scrollbar {
    width: 16px;
    height: auto;
}
.back-button-print{width: 100px;height: 30px;float: left;background: #1a1a1a;text-align: center;line-height:  30px;font-size: 14px;color: #fff !important}
.print_button_main{float: left;margin-right: 10px;height: 30px;width: 100px}
</style>
</head>
<body style="overflow-y:scroll !important">

    
   <input type="hidden"  id="whatsapp_num" value="<?=$_REQUEST['num']?>"> 
    
    
 <div class="section_content" id="div_list">
<div class="print_content">  
    <div class="estimate_cnt_wrapper_print">  
        <div class="table_wrapper" style="background-color: white ">
        <table border="0" cellpadding="1" cellspacing="3" width="100%"style="float:left">
        <tbody>
            
          <tr> 
              <td width="120px" id="printbutton"> <input type="submit" value="Print | Save Pdf"  style="margin-right:55px;border: 0px" class="back-button-print print_button_main" onclick="return print_page()" />
              </td>
              
            <?php  if($_SESSION['s_sms_bill']=="N") { ?>
              <td width="150px" id="whatsappbutton"> <input type="submit" value="Download & Share In Whatsapp"  style="width: 205px;margin-right:55px;border: 0px" class="back-button-print print_button_main" onclick="return share_page()" />
              </td>  
              
            <?php } ?>
              
              
           <td>
           <a class="back-button-print" onclick="return close_page() ">Close</a>
          </td>
          </tr>
            
          <tr> 
          <td>&nbsp;</td>
          </tr>
          
        </tbody>
        </table>
          <div id="my-node" >

         <table class="table table-bordered table-font user_shadow newconsl_table"  >
        <thead>
        <tr>
             
        <th style="font-size:20px;color:#000;background-color:#FFF;border-bottom:1px #ccc solid " colspan="17">
            <img style="display:none" width="80px" src="img/report-logo/reportlogo.png" /> <br>
                
            <?php 
             $branchothers1=''; $branchothers2=''; $branchothers4=''; $branchothers3='';
             $sql_branch1 =  mysqli_query($localhost,"Select * from tbl_branchmaster  "); 
		  $num_branch1  = mysqli_num_rows($sql_branch1);
		  if($num_branch1)
		  {
				while($result_branch1  = mysqli_fetch_array($sql_branch1)) 
					{
                                    
						 $br=$result_branch1['be_branchname'];
                                                 $addr=$result_branch1['be_address'];
                                                 
                                                 $branchothers1=$result_branch1['be_others1'];
                                                 
                                                  if($result_branch1['be_others2']!=''){
                                                      
                                                     if($branchothers1!=''){  
						        $branchothers2=' , '.$result_branch1['be_others2'];
                                                     }else{
                                                        $branchothers2=$result_branch1['be_others2'];  
                                                     }
                                                     
                                                  }
                                                  
						 $branchothers3=$result_branch1['be_others3'];
                                                 
                                                 if($result_branch1['be_others4']!=''){
                                                    
                                                     if($branchothers3!=''){
                                                          $branchothers4=' , '.$result_branch1['be_others4'];
                                                     }else{
                                                          $branchothers4=$result_branch1['be_others4'];
                                                     }
                                                     
                                                 }
					}
		  }   
            
            ?>
                
                
           <strong ><?=$br?></strong>  
               
            <h5><?=$addr?></h5>  
                
            <h5><?=$branchothers1.$branchothers2?></h5>  
                  
            <h5><?=$branchothers3.$branchothers4?></h5>  
                    
            <strong style="font-size:13px"><?=$_REQUEST['mode']?></strong>
        
        </th>
             
      </tr>
            <tr >
      <th style="font-size:18px;color:#000;background-color:#FFF; " colspan="6"><strong></strong></th>
      </tr>

      
    </thead>
    </table>                   
                            
                            
<?php 

if(isset($_REQUEST['set']) && $_REQUEST['set']=="bill_view_di")
{
    
   
    $billhistory_billno=$_REQUEST['billno'];
    $kot_nos=array();
    $combo_entry_count=array();
    $combo_qty=0;
    $slno=0;
    $i=0;  $bill_gen=''; $bank_id=''; $bm_lukado_response='';  $cst=''; $cst1='';   $cst2='';
    $amount_sum=0;
                    $sql_billhistory_qry = $database->mysqlQuery("select bm_lukado_response, bm_floorid,bm_transcbank,bm_dayclosedate,
                        bm_tips_given,bm_orderno,bm_cnumber,bm_gst,bm_cname,
                        sm.ser_firstname as steward,sm1.ser_firstname as cancelledcareoff,bm_paymode,bm_lastprintime,bm_cname,
                        bm_cnumber,bm_gst,bm_tableno,bm_bill_ref,bm_billdate,bm_billtime,bm_status,bm_finaltotal,bm_amountpaid,
                        bm_amountbalace,bm_transactionamount,ter_cancelledreason,ter_cancelledlogin,ter_cancelledby_careof,
                        bm_bill_printed_by,bm_billprinted from tbl_tablebillmaster 
                                                    left join tbl_staffmaster sm on sm.ser_staffid =bm_steward
                                                    left join tbl_staffmaster sm1 on sm1.ser_staffid =ter_cancelledby_careof
                                                    where bm_billno = '".$billhistory_billno."' ");
                        
                    
                   
                    
                   $num_billhistory_rows  = $database->mysqlNumRows($sql_billhistory_qry);
                   if($num_billhistory_rows){
                       $result_billhistory_row  = $database->mysqlFetchArray($sql_billhistory_qry);
                      
                               $billhistory_paymode_selcted =$result_billhistory_row['bm_paymode'];
                       
                               $billhistory_bill_tableno =$result_billhistory_row['bm_tableno'];
                               $billhistory_bill_ref =$result_billhistory_row['bm_bill_ref'];
                               $billhistory_bill_date =$result_billhistory_row['bm_billdate'].' '.$result_billhistory_row['bm_billtime'];
                               $billhistory_bill_status =$result_billhistory_row['bm_status'];
                                $billhistory_bill_dayclosedate =$result_billhistory_row['bm_dayclosedate'];
                               $billhistroy_bill_finaltotal=number_format(str_replace(',','',$result_billhistory_row['bm_finaltotal']),$_SESSION['be_decimal']);
                               $billhistroy_bill_amountpaid=number_format(str_replace(',','',$result_billhistory_row['bm_amountpaid']),$_SESSION['be_decimal']);
                               $billhistroy_bill_amountbalance=number_format(str_replace(',','',$result_billhistory_row['bm_amountbalace']),$_SESSION['be_decimal']);
                               $billhistroy_bill_amountcard=number_format(str_replace(',','',$result_billhistory_row['bm_transactionamount']),$_SESSION['be_decimal']);
                               $cancel_reason=$result_billhistory_row['ter_cancelledreason'];
                               $orderno=$result_billhistory_row['bm_orderno'];
                               $cancelled_login=$result_billhistory_row['ter_cancelledlogin'];
                               $cancel_careof=$result_billhistory_row['cancelledcareoff'];
                               $bill_first_printed=$result_billhistory_row['bm_bill_printed_by'];
                               $bm_lukado_response=$result_billhistory_row['bm_lukado_response'];
                               $bank_id=$result_billhistory_row['bm_transcbank'];
                               $tip_amount=number_format(str_replace(',','',$result_billhistory_row['bm_tips_given']),$_SESSION['be_decimal']);
                              
                               
                                $print_datedi=$result_billhistory_row['bm_billdate'];
                                $print_timedi  =$result_billhistory_row['bm_billtime'];
                               
                               
                              if($result_billhistory_row['bm_cname']!=''){ 
                              $cst=' Name: '.$result_billhistory_row['bm_cname'];
                              }
                              
                              
                              if($result_billhistory_row['bm_cnumber']!=''){ 
                              $cst1=' Number: '.$result_billhistory_row['bm_cnumber']; 
                                }
                              
                              if($result_billhistory_row['bm_gst']!=''){ 
                              $cst2=' Gst/Trn/Vat: '.$result_billhistory_row['bm_gst']; 
                              }
                              
                  $sql_branch =  mysqli_query($localhost,"Select ter_entryuser from tbl_tableorder where ter_billnumber='$billhistory_billno'"); 
		  $num_branch  = mysqli_num_rows($sql_branch);
		  if($num_branch)
		  {
				while($result_branch  = mysqli_fetch_array($sql_branch)) 
					{
						 $bill_gen=$result_branch['ter_entryuser'];
					}
		  }
             
                  
            $bankname='';    
           
            $sql_branch1 =  mysqli_query($localhost,"Select bm_name from tbl_bankmaster where bm_id='$bank_id' "); 
		  $num_branch1  = mysqli_num_rows($sql_branch1);
		  if($num_branch1)
		  {
				while($result_branch1  = mysqli_fetch_array($sql_branch1)) 
					{
						 $bankname=$result_branch1['bm_name'];
					}
		  }    
                  
                  
                   $sql_branch12 =  mysqli_query($localhost,"Select fr_floorname from tbl_floormaster where fr_floorid='".$result_billhistory_row['bm_floorid']."' "); 
		  $num_branch12  = mysqli_num_rows($sql_branch12);
		  if($num_branch12)
		  {
				while($result_branch12  = mysqli_fetch_array($sql_branch12)) 
					{
						 $floor_di_bill=$result_branch12['fr_floorname'];
					}
		  }    
                  
                  
                  $di_tx_amt='0.000';
                  $sql_payment_mode_ta =  mysqli_query($localhost,"select sum(bem_total_value) as tot_tax from tbl_tablebill_extra_tax_master where"
                  . " bem_billno='$billhistory_billno' "); 
		  $num_payment_mode_ta  = mysqli_num_rows($sql_payment_mode_ta);
		  if($num_payment_mode_ta)
		  {
			while($result_branchtx_ta  = mysqli_fetch_array($sql_payment_mode_ta)) 
			 {
                            $di_tx_amt       =$result_branchtx_ta['tot_tax'];
                                                                
			}
		  }     
                  
                 if($di_tx_amt=='' || $di_tx_amt=='null' || $di_tx_amt==NULL ){
                     $di_tx_amt='0.000';
                  }
                  
                  
   ?>


                        
     <div class="container">
    <div class="row">
        <div class="col-xs-12">
    		
    		
    		<div class="row" style="    padding-top:0px;margin-left: -13px;margin-right: -10px;">
    			<div class="col-xs-6">
    				<address style="text-align: left">
                                    <strong>Bill No : <span id="billno"><?=$billhistory_billno?></span></strong><br>    
    				<strong>Steward : <?=$result_billhistory_row['steward']?></strong><br>
    				
                                <strong>Table : <span> <?=$billhistory_bill_tableno?></span> &nbsp; | &nbsp; Floor : <?=$floor_di_bill?>	</strong><br>
                               
                                
    				</address>
    			</div>
    			<div class="col-xs-6 text-right">
    				<address style="text-align: right">
        			<strong>REF NO : <span><?=$billhistory_bill_ref?></span></strong><br>
    				<strong>Date : <span><?=$billhistory_bill_date?></span></strong>	<br>
    				
                                <strong>Bill Generated By : <span><?=$bill_gen?></span></strong>
                                </address>
    			</div>
    			
    		</div>
    		
    	</div>
    </div>
    
    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
    			
    			<div class="panel-body">
    				<div class="table-responsive">
                                    
                                <?php 
                                
                                
                                $otherlang='';
		  $sql_branch =  mysqli_query($localhost,"Select * from tbl_branch_settings_printer where bp_branchid='1'"); 
		  $num_branch  = mysqli_num_rows($sql_branch);
		  if($num_branch)
		  {
				while($result_branch  = mysqli_fetch_array($sql_branch)) 
					{
						 $otherlang=$result_branch['bp_item_other_lang'];
					}
		  }
                    ?>            
                                        <table class="table table-condensed">
                                            <thead>
                                                <tr>
                                                     <td width="10%"><strong>SL</strong></td>
                                                    <td width="40%"><strong>PRODUCT</strong></td>
                                                    <td width="10%" class="text-center"><strong>QTY</strong></td>
                                                    <td width="15%" class="text-center"><strong>RATE</strong></td>
                                                    <td width="20%" class="text-right"><strong>AMOUNT</strong></td>
                                                   
                                                   
                                                </tr>
                                            </thead>
					</table>
                                        <div class="item_table_scr">
                                            <table class="table table-condensed">
                                            <tbody class="bill_scroll_tbl">
                  
                 <?php 
                  $sql_combo_list  =  $database->mysqlQuery("select distinct(cbd.cbd_count_combo_ordering) as cbd_count_combo_ordering,cbd.cbd_combo_id, cbd.cbd_combo_pack_rate, cbd.cbd_combo_total_rate, cbd.cbd_combo_qty, cn.cn_name,cp.cp_pack_name   FROM tbl_combo_bill_details cbd
                                                            left join tbl_combo_name cn on cn.cn_id=cbd.cbd_combo_id
                                                            left join tbl_combo_packs cp on cp.cp_id=cbd.cbd_combo_pack_id
                                                            where cbd.cbd_billno='".$billhistory_billno."' order by cbd.cbd_count_combo_ordering asc "); 
				$num_combo_list  = $database->mysqlNumRows($sql_combo_list);
				if($num_combo_list){
                                    while($result_combo_list  = $database->mysqlFetchArray($sql_combo_list)) 
                                    {   $slno++;  
                                        $combo_menu_array=array();
                                        if(!in_array($result_combo_list['cbd_count_combo_ordering'],$combo_entry_count)){
                                            $combo_entry_count[]=$result_combo_list['cbd_count_combo_ordering'];
                                            $amount_sum=$amount_sum+$result_combo_list['cbd_combo_total_rate'];
                                              $combo_qty=$combo_qty+$result_combo_list['cbd_combo_qty'];                 
                                            $sql_combomenu_list  =  $database->mysqlQuery("select mm.mr_menuname  FROM tbl_combo_bill_details cbd
                                                               left join tbl_menumaster mm on mm.mr_menuid=cbd.cbd_menu_id
                                                               where cbd.cbd_count_combo_ordering='".$result_combo_list['cbd_count_combo_ordering']."' and cbd.cbd_billno='".$billhistory_billno."'");
                                                               $num_combomenu_list  = $database->mysqlNumRows($sql_combomenu_list);
                                                                if($num_combomenu_list){
                                                                    while($result_combomenu_list  = $database->mysqlFetchArray($sql_combomenu_list)) 
                                                                        {
                                                                        $combo_menu_array[]=$result_combomenu_list['mr_menuname'];
                                                                        }
                                                                }
                                        ?>
                                        <tr>
                                            
                                            <td width="40%"><span>[Combo] </span>
                                                 <?=$result_combo_list['cn_name'].' '.$result_combo_list['cp_pack_name']?>
                                                <span class="combo_tbl_lst"><?=implode(',',array_unique($combo_menu_array));?></span>
                                            </td>
                                            <td width="10%" class="text-center"><?= $result_combo_list['cbd_combo_qty'] ?></td>
                                            <td width="15%" class="text-center"><?=number_format($result_combo_list['cbd_combo_pack_rate'],$_SESSION['be_decimal'])?></td>
                                            <td width="20%" class="text-right"><?=number_format($result_combo_list['cbd_combo_total_rate'],$_SESSION['be_decimal'])?></td>
                                          
                                           
                                            
                                        </tr>
                                        
                                        
                                        
                                        <?php
                                                  $sql_b= $database->mysqlQuery("select cod_combo_preference  FROM  tbl_combo_ordering_details where  cod_count_combo_ordering='".$result_combo_list['cbd_count_combo_ordering']."' and cod_combo_id='".$result_combo_list['cbd_combo_id']."' ");    
                                                        $num_b  = $database->mysqlNumRows($sql_b);
                                                       $result_b  = $database->mysqlFetchArray($sql_b);
                                                 
                                                 
                                                 if($result_b['cod_combo_preference']!=''){
                                                   ?>
                                                   <tr>
                                                     <td colspan="5" style="text-transform: lowercase">
                                                   Pref :  <?=$result_b['cod_combo_preference']?> 
                                                     </td>
                                                   </tr>
                                                 <?php } ?>
                                        
                                        
                                        
                                        
                                        
                                        <?php
                                            }
                                        }
                                    }
                                    
                  $sql_rep = $database->mysqlQuery("select bd.bd_billslno,bd.bd_menuid,bd.bd_bill_addon_slno,bd.bd_rate_type,bd.bd_unit_type,bd.bd_portion,bd.bd_unit_weight,bd.bd_unit_id,bd.bd_base_unit_id,bd.bd_rate,sum(bd.bd_qty) as bd_qty,sum(bd.bd_amount) as bd_amount,bd.bd_bill_addon_slno,
                                                                                mm.mr_menuname,mm.mr_itemshortcode FROM tbl_tablebilldetails bd  left join tbl_menumaster mm on mm.mr_menuid=bd.bd_menuid  where bd.bd_billno='".$billhistory_billno."' group by bd.bd_menuid,bd.bd_rate ");

                                    $num_rep  = $database->mysqlNumRows($sql_rep);
                                    if($num_rep){ $item_count_replace=0;
                                    
                                    while($result_rep  = $database->mysqlFetchArray($sql_rep)){
                                        $item_count_replace++;
                                    }
                                    }
                                    
                  
                  $sql_billhistory_billdetails_qry = $database->mysqlQuery("select bd.bd_billslno,bd.bd_menuid,bd.bd_bill_addon_slno,bd.bd_rate_type,bd.bd_unit_type,bd.bd_portion,bd.bd_unit_weight,bd.bd_unit_id,bd.bd_base_unit_id,bd.bd_rate,sum(bd.bd_qty) as bd_qty,sum(bd.bd_amount) as bd_amount,bd.bd_bill_addon_slno,
                                                                                mm.mr_menuname,mm.mr_itemshortcode FROM tbl_tablebilldetails bd  left join tbl_menumaster mm on mm.mr_menuid=bd.bd_menuid  where bd.bd_billno='".$billhistory_billno."' group by bd.bd_menuid,bd.bd_rate ");

                                    $num_billhistory_billdetails_rows  = $database->mysqlNumRows($sql_billhistory_billdetails_qry);
                                    if($num_billhistory_billdetails_rows){
                                        
                                
                                    $portion='';
                                    $unit='';
                                   $sl=1;
                                   
                                    while($result_billhistory_billdetails_row  = $database->mysqlFetchArray($sql_billhistory_billdetails_qry)){
                                        $i++;
                                        
                                         $localhost=mysqli_connect(HOST_NAME, USER_NAME, PASSWORD,DATABASE_NAME);
                                         $itemotherlangname='';
                                        if($otherlang=="Y"){
									  mysqli_query($localhost,"SET NAMES 'utf8'");
									  mysqli_query($localhost,'SET CHARACTER SET utf8');
									  $sql_othlamg  =  mysqli_query($localhost,"Select lm_menu_print from tbl_language_menu_master  Where lm_menu_id='".$result_billhistory_billdetails_row['bd_menuid']."' AND lm_language_id='2'");
									  $num_othlamg  = mysqli_num_rows($sql_othlamg);
									  if($num_othlamg)
									  {
											  while($result_othlamg  = mysqli_fetch_array($sql_othlamg)) 
											  {
												$itemotherlangname=($result_othlamg['lm_menu_print']);
											  }
									  }
                            	                                     
                                        }
                                        
                                        
                                        
                                        if($result_billhistory_billdetails_row['bd_rate_type']=='Portion'){
                                            $sql_portion_billhistory= $database->mysqlQuery("select pm_portionshortcode FROM tbl_portionmaster where pm_id='".$result_billhistory_billdetails_row['bd_portion']."'");
                                            $num_portion_billhistory  = $database->mysqlNumRows($sql_portion_billhistory);
                                            $result_portion_billhistory  = $database->mysqlFetchArray($sql_portion_billhistory);
                                            $portion="[".$result_portion_billhistory['pm_portionshortcode']."]";
                                            $unit='';
                                        }
                                        else{
                                                if($result_billhistory_billdetails_row['bd_unit_type']=='Packet'){ 
                                                        $sql_unit_billhistory= $database->mysqlQuery(" select u_name FROM tbl_unit_master  where u_id='".$result_billhistory_billdetails_row['bd_unit_id']."' ");
                                                        $num_unit_billhistory  = $database->mysqlNumRows($sql_unit_billhistory);
                                                        $result_unit_billhistory  = $database->mysqlFetchArray($sql_unit_billhistory);
                                                        
                                                        $portion='';
                                                        $unit=number_format($result_billhistory_billdetails_row['bd_unit_weight'],$_SESSION['be_decimal']).' '.$result_unit_billhistory['u_name'];
                                                        
                                                }
                                                else{
                                                    $sql_baseunit_billhistory= $database->mysqlQuery("select bu_name FROM tbl_base_unit_master where bu_id='".$result_billhistory_billdetails_row['bd_base_unit_id']."'");
                                                    $num_baseunit_billhistory  = $database->mysqlNumRows($sql_baseunit_billhistory);
                                                    $result_baseunit_billhistory  = $database->mysqlFetchArray($sql_baseunit_billhistory);
                                                
                                                    $portion='';
                                                     $unit=number_format($result_billhistory_billdetails_row['bd_unit_weight'],$_SESSION['be_decimal']).' '.$result_baseunit_billhistory['bu_name'];
                                                }
                                        }
                                        $amount_sum=$amount_sum+$result_billhistory_billdetails_row['bd_amount'];
                                        ?>
                                                
                                                <tr>
                                                    <td width="10%"><?=$sl++?></td>
                                                    
                                                    <td width="40%">
                                                        <?php if($result_billhistory_billdetails_row['bd_bill_addon_slno']!='') { ?>
                                                        <span style="color: #f00">(AD) </span>
                                                        <?php } ?>
                                                        
                                                        <?=$result_billhistory_billdetails_row['mr_itemshortcode'].' '.$portion?>
                                                        <span class="bill_histo_gram"><?=$unit?></span><br>
                                                         <span><?=$itemotherlangname?></span>
                                                    </td>
                                                   
                                                    <td width="10%" class="text-center"><?=$result_billhistory_billdetails_row['bd_qty']?></td>
                                                    <td width="15%" class="text-center"><?=number_format($result_billhistory_billdetails_row['bd_rate'],$_SESSION['be_decimal'])?></td>
                                                    <td width="20%" class="text-right"><?=number_format($result_billhistory_billdetails_row['bd_amount'],$_SESSION['be_decimal'])?></td>
                                                  
                                               
                                                 
                                                 </tr>
                                                
                                                
                                                
                                                    
                                                <?php
                                                  $sql_b= $database->mysqlQuery("select ter_preferencetext  FROM  tbl_tableorder where  ter_billnumber='".$billhistory_billno."' and ter_menuid='".$result_billhistory_billdetails_row['bd_menuid']."' ");    
                                                        $num_b  = $database->mysqlNumRows($sql_b);
                                                       $result_b  = $database->mysqlFetchArray($sql_b);
                                                 
                                                 
                                                 if($result_b['ter_preferencetext']!=''){
                                                   ?>
                                                   <tr>
                                                     <td colspan="5" style="text-transform: lowercase">
                                                   Pref :  <?=$result_b['ter_preferencetext']?> 
                                                     </td>
                                                   </tr>
                                                 <?php } ?>
                                                 
                                               
                                                 
                                                 
                                                
                                    <?php }} ?>
                                                
                                                    
                                                
						</table>
						</div>
                                    <input type="hidden" name="bill_paymode" id="bill_paymode" value="<?=$result_billhistory_row['bm_paymode']?>">
                                                    <table class="table table-condensed">
    							
    							<tbody>
                                                            
                                                          
                                                            
                                                            
    							<tr>
    								
    								
                                                            <td style="width: 79%;" class="thick-line text-right">Sub Total</td>
                                                                <td style="width: 23.5%;"  class="thick-line text-right"><?=number_format(str_replace(',','',$amount_sum),$_SESSION['be_decimal'])?></td>
    							</tr>
                                                        <?php
                                                        $sql_billhistory_billtax = $database->mysqlQuery("select   bem_label, bem_total_value FROM  tbl_tablebill_extra_tax_master where  bem_billno='".$billhistory_billno."'");    
                                                        $num_billhistory_billtax  = $database->mysqlNumRows($sql_billhistory_billtax);
                                                            if($num_billhistory_billtax){
                                                                while($result_billhistory_billtax  = $database->mysqlFetchArray($sql_billhistory_billtax)){
                                                        ?>
    							<tr>
    								<td  class="thick-line"><?=$result_billhistory_billtax['bem_label']?></td>
    								
    								
    								<td style="width: 23.5%;" class="thick-line text-right"><?=number_format(str_replace(',','',$result_billhistory_billtax['bem_total_value']),$_SESSION['be_decimal'])?></td>
    							</tr>
                                                        <?php 
                                                                }
                                                            }
                                                        ?>
    							
    							<tr>
    								<td class="thick-line"><strong>GRAND TOTAL</strong></td>
    								
    								
    								<td style="width: 23.5%;" class="thick-line text-right"><strong id="grand_total"><?=$billhistroy_bill_finaltotal;?></strong></td>
    							</tr>
                                                            
                                                        <?php if($billhistroy_bill_amountpaid>0){ ?>
    							<tr>
    								<td class="no-line">PAID CASH</td>
    								
    								
    								<td style="width: 23.5%;" class="no-line text-right"><?=$billhistroy_bill_amountpaid?></td>
    							</tr>
                                                        <?php }
                                                        if($billhistroy_bill_amountcard>0){
                                                            ?>
                                                        
                                                        <tr>
    								<td class="no-line">PAID CARD</td>
    								
    								
    								<td style="width: 23.5%;" class="no-line text-right"><?=$billhistroy_bill_amountcard?></td>
    							</tr>
                                                        <?php }
                                                        if($billhistroy_bill_amountpaid>0 || $billhistroy_bill_amountcard>0){
                                                            ?>
                                                        
    							<tr>
    								<td class="no-line">BALANCE</td>
    								
    								
    								<td style="width: 23.5%;" class="no-line text-right"><?=$billhistroy_bill_amountbalance?></td>
    							</tr>
                                                        <?php }
                                                        ?>
                                                        
                                                        
                                                       <?php if($billhistory_paymode_selcted=='6'){  ?>
                                                        <tr>
                                                            <td class="no-line"><strong style="color:#b55a5a">CREDIT BILL</strong></td>
    								
    								
    								<td style="width: 23.5%;" class="no-line text-right"><?=($billhistroy_bill_finaltotal-$billhistroy_bill_amountpaid)?></td>
    							</tr>
                                                        <?php }  ?>
                                                       
                                                        
                                                        <?php  if($billhistory_paymode_selcted=='7'){  ?>
                                                        <tr>
    								<td class="no-line"><strong style="color:#b55a5a">COMPLIMENTARY BILL</strong></td>
    								
    								
    								<td style="width: 23.5%;" class="no-line text-right"><strong></strong></td>
    							</tr>
                                                        <?php }  ?>
                                                        
                                                        
                                                        
                                                        
                                                    </tbody>
                                                </table>
    				</div>
    				
    				
    			</div>
    			
    		</div>
    		
    	</div>
    </div>
    <div class="bill_his_order_btm_detail">
        <?php 
                $sql_billhistory_kot = $database->mysqlQuery("select  distinct(ter_kotno) as kot FROM tbl_tableorder    left join tbl_tablebillmaster "
                . "  on tbl_tableorder.ter_orderno  in($orderno) where bm_billno = '".$billhistory_billno."' ");
                   
                   $num_billhistory_kot  = $database->mysqlNumRows($sql_billhistory_kot);
                   if($num_billhistory_kot){$kotno='';
                       while( $result_billhistory_kot  = $database->mysqlFetchArray($sql_billhistory_kot)){
    	              $kot_nos[]=$result_billhistory_kot['kot'];
                    }
                   }
                   
                   $kotno=implode(',',$kot_nos);
        ?>                      
                       <div class="col-xs-12" style="padding-left: 5px">
    			<address style="text-align: left">
                            <strong>KOT :<span><?=implode(',',$kot_nos)?></span>	</strong> <br>
                        
                        <strong><?=$cst?></span>	</strong><br>
                        
                        <strong><?=$cst1?></span>	</strong><br>
                        <strong><?=$cst2?></span>	</strong>
                        
    			</address>
		        </div>
		
        
                <?php
                if($sa_format_on=='Y'){
                    
                ////saudi qr code///
                $displayQRCodeAsBase64 = GenerateQrCode::fromArray([
                new Seller($br), // seller name        
                new TaxNumber($branchothers3), // seller tax number
                new InvoiceDate($print_datedi.'T'.$print_timedi.'Z'), // invoice date 
                new InvoiceTotalAmount($billhistroy_bill_finaltotal), // invoice total amount
                new InvoiceTaxAmount($di_tx_amt) // invoice tax amount
                // TODO :: Support others tags
                ])->render();
                copy($displayQRCodeAsBase64, 'qr_zatca/qr.png');
                ////saudi qr code end///
            
                ?>
         <div class="bill_history_tax_btm_cc">
             <div class="col-xs-11 no-padding"     style="margin-left: 520px;">
              <img src="qr_zatca/qr.png" >
                     </div> <br>
        </div>
              <?php } ?>
            
            
            
         <div class="bill_history_tax_btm_cc">
        
		<div class="col-xs-11 no-padding"     style="margin-left: 560px;">
			<div class="col-xs-4" style="padding-left: 0">
                            <span class="bill_story_center_top_txt" >THANK YOU . VISIT AGAIN </span>
			</div>
			
                </div> <br>
                    
		<div class="col-xs-11 no-padding"  style="margin-left: 565px;">
			<div class="col-xs-4" style="padding-left: 0">
				<span class="bill_story_center_top_txt" style="font-weight:bold ">POWERED BY SOFTWARE</span>
			</div>
			
                </div>
       </div>
        
        
        
	</div>
     
 <?php  
    
}
	
}


if(isset($_REQUEST['set']) && $_REQUEST['set']=="bill_view_ta_hd_cs")
{
    
   
    $billhistory_billno=$_REQUEST['billno'];
    $kot_nos=array();
    $combo_entry_count=array();
    $combo_qty=0;
    $slno=0;
    $i=0;  $bill_gen=''; $bank_id=''; $bm_lukado_response='';
    $amount_sum=0;
    
    $cst=''; $cst1='';   $cst2='';
    
            
                        $sql_billhistory_qry = $database->mysqlQuery("select tab_transcbank,tab_dayclosedate,tab_tips_given,
                        tab_paymode,tab_name,tab_loginid,tab_food_partner,tab_name,tab_phone,tab_gst,
                        tab_phone,tab_gst,tab_bill_ref,tab_date,tab_time,tab_status,tab_netamt,tab_amountpaid,
                        tab_amountbalace,tab_transactionamount,
                        tab_bill_printed_by,tbl_takeaway_printed from  tbl_takeaway_billmaster 
                                                   
                        where tab_billno = '".$billhistory_billno."' ");
                        
                       $num_billhistory_rows  = $database->mysqlNumRows($sql_billhistory_qry);
                       if($num_billhistory_rows){
                       $result_billhistory_row  = $database->mysqlFetchArray($sql_billhistory_qry);
                      
                               $billhistory_paymode_selcted =$result_billhistory_row['tab_paymode'];
                       
                            
                               $billhistory_bill_ref =$result_billhistory_row['tab_bill_ref'];
                               $billhistory_bill_date =$result_billhistory_row['tab_date'].' '.$result_billhistory_row['tab_time'];
                               $billhistory_bill_status =$result_billhistory_row['tab_status'];
                                $billhistory_bill_dayclosedate =$result_billhistory_row['tab_dayclosedate'];
                               $billhistroy_bill_finaltotal=number_format(str_replace(',','',$result_billhistory_row['tab_netamt']),$_SESSION['be_decimal']);
                               $billhistroy_bill_amountpaid=number_format(str_replace(',','',$result_billhistory_row['tab_amountpaid']),$_SESSION['be_decimal']);
                               $billhistroy_bill_amountbalance=number_format(str_replace(',','',$result_billhistory_row['tab_amountbalace']),$_SESSION['be_decimal']);
                               $billhistroy_bill_amountcard=number_format(str_replace(',','',$result_billhistory_row['tab_transactionamount']),$_SESSION['be_decimal']);
                              
                               $billby=$result_billhistory_row['tab_loginid'];
                              
                               $bank_id=$result_billhistory_row['tab_transcbank'];
                               $tip_amount=number_format(str_replace(',','',$result_billhistory_row['tab_tips_given']),$_SESSION['be_decimal']);
                      
            
                                if($result_billhistory_row['tab_name']!=''){ 
                              $cst=' Name: '.$result_billhistory_row['tab_name'];
                              }
                              
                              
                              if($result_billhistory_row['tab_phone']!=''){ 
                              $cst1=' Number: '.$result_billhistory_row['tab_phone']; 
                                }
                              
                              if($result_billhistory_row['tab_gst']!=''){ 
                              $cst2=' Gst/Trn/Vat: '.$result_billhistory_row['tab_gst']; 
                              }
                              
                              
                              
                               $print_dateta=$result_billhistory_row['tab_date'];
                               $print_timeta=$result_billhistory_row['tab_time'];
                  
                  $onl='CS';
                  $sql_branch1 =  mysqli_query($localhost,"Select tol_name from tbl_online_order where tol_id='".$result_billhistory_row['tab_food_partner']."' "); 
		  $num_branch1  = mysqli_num_rows($sql_branch1);
		  if($num_branch1)
		  {
				while($result_branch1  = mysqli_fetch_array($sql_branch1)) 
					{
						 $onl=$result_branch1['tol_name'];
					}
		  }    
                    
                  
                  $ta_tx_amt='0.000';
                  $sql_payment_mode_ta =  mysqli_query($localhost,"select sum(tbe_total_value) as tot_tax from tbl_takeaway_bill_extra_tax_master "
                  . " where tbe_billno='$billhistory_billno' limit 50"); 
		  $num_payment_mode_ta  = mysqli_num_rows($sql_payment_mode_ta);
		  if($num_payment_mode_ta)
		  {
			while($result_branchtx_ta  = mysqli_fetch_array($sql_payment_mode_ta)) 
			 {
                            $ta_tx_amt       =$result_branchtx_ta['tot_tax'];
                                                                
			}
		  }     
                  
                  
                 if($ta_tx_amt=='' || $ta_tx_amt=='null' || $ta_tx_amt==NULL ){
                     $ta_tx_amt='0.000';
                 }
                   
                  
   ?>


                        
     <div class="container">
    <div class="row">
        <div class="col-xs-12">
    		
    		
    		<div class="row" style="    padding-top:0px;margin-left: -13px;margin-right: -10px;">
    			<div class="col-xs-6">
    				<address style="text-align: left">
                                    <strong>Bill No : <span id="billno"><?=$billhistory_billno?></span></strong><br>    
    				<strong>Partner : <span> <?=$onl?></span></strong><br>    
    				
    				</address>
    			</div>
    			<div class="col-xs-6 text-right">
    				<address style="text-align: right">
        			<strong>REF NO : <span><?=$billhistory_bill_ref?></span></strong><br>
    				<strong>Date : <span><?=$billhistory_bill_date?></span></strong>	<br>
    				
                                <strong>Bill Generated By : <span><?=$billby?></span></strong>
                                </address>
    			</div>
    			
    		</div>
    		
    	</div>
    </div>
    
    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
    			
    			<div class="panel-body">
    				<div class="table-responsive">
                                    
                                <?php 
                                
                                
                                $otherlang='';
		  $sql_branch =  mysqli_query($localhost,"Select * from tbl_branch_settings_printer where bp_branchid='1'"); 
		  $num_branch  = mysqli_num_rows($sql_branch);
		  if($num_branch)
		  {
				while($result_branch  = mysqli_fetch_array($sql_branch)) 
					{
						 $otherlang=$result_branch['bp_item_other_lang'];
					}
		  }
                    ?>            
                                        <table class="table table-condensed">
                                            <thead>
                                                <tr>
                                                     <td width="10%"><strong>SL</strong></td>
                                                    <td width="40%"><strong>PRODUCT</strong></td>
                                                    <td width="10%" class="text-center"><strong>QTY</strong></td>
                                                    <td width="15%" class="text-center"><strong>RATE</strong></td>
                                                    <td width="20%" class="text-right"><strong>AMOUNT</strong></td>
                                                   
                                                   
                                                </tr>
                                            </thead>
					</table>
                                        <div class="item_table_scr">
                                            <table class="table table-condensed">
                                            <tbody class="bill_scroll_tbl">
                  
                 <?php 
                  $sql_combo_list  =  $database->mysqlQuery("select  cbd.cbd_combo_preference,cbd.cbd_id, cbd.cbd_count_combo_ordering,
                      cbd.cbd_billno, cbd.cbd_combo_id, cbd.cbd_combo_pack_id, cbd.cbd_slno, cbd.cbd_combo_qty, cbd.cbd_combo_pack_rate,
                      cbd.cbd_combo_total_rate, cbd.cbd_menu_id, cbd.cbd_menu_qty, cbd.cbd_combo_preference, cbd.cbd_entry_date, cbd.cbd_dayclosedate,
                      cbd.cbd_order_status, cbd.cloud_sync, 
                cbd.cbd_kot_no, cbd.cbd_cancel, cn.cn_name ,cn.cn_stock_check, cp.cp_pack_name
                FROM tbl_combo_bill_details_ta cbd
                left join tbl_combo_name cn on cn.cn_id=cbd.cbd_combo_id
                left join tbl_combo_packs cp on cp.cp_id=cbd.cbd_combo_pack_id
                where cbd.cbd_billno='".$billhistory_billno."' group by cbd.cbd_count_combo_ordering order by cbd.cbd_count_combo_ordering asc "); 
                  
				$num_combo_list  = $database->mysqlNumRows($sql_combo_list);
				if($num_combo_list){
                                    while($result_combo_list  = $database->mysqlFetchArray($sql_combo_list)) 
                                    {   $slno++;  
                                        $combo_menu_array=array();
                                        if(!in_array($result_combo_list['cbd_count_combo_ordering'],$combo_entry_count)){
                                            $combo_entry_count[]=$result_combo_list['cbd_count_combo_ordering'];
                                            $amount_sum=$amount_sum+$result_combo_list['cbd_combo_total_rate'];
                                              $combo_qty=$combo_qty+$result_combo_list['cbd_combo_qty'];                 
                                            $sql_combomenu_list  =  $database->mysqlQuery("select mm.mr_menuname  FROM tbl_combo_bill_details cbd
                                                               left join tbl_menumaster mm on mm.mr_menuid=cbd.cbd_menu_id
                                                               where cbd.cbd_count_combo_ordering='".$result_combo_list['cbd_count_combo_ordering']."' and cbd.cbd_billno='".$billhistory_billno."'");
                                                               $num_combomenu_list  = $database->mysqlNumRows($sql_combomenu_list);
                                                                if($num_combomenu_list){
                                                                    while($result_combomenu_list  = $database->mysqlFetchArray($sql_combomenu_list)) 
                                                                        {
                                                                        $combo_menu_array[]=$result_combomenu_list['mr_menuname'];
                                                                        }
                                                                }
                                        ?>
                                        <tr>
                                            
                                            <td width="40%"><span style="">[Combo] </span>
                                                <?=$result_combo_list['cn_name'].' '.$result_combo_list['cp_pack_name']?>
                                                <span class="combo_tbl_lst"><?=implode(',',array_unique($combo_menu_array));?></span>
                                            </td>
                                            <td width="10%" class="text-center"><?= $result_combo_list['cbd_combo_qty'] ?></td>
                                            <td width="15%" class="text-center"><?=number_format($result_combo_list['cbd_combo_pack_rate'],$_SESSION['be_decimal'])?></td>
                                            <td width="20%" class="text-right"><?=number_format($result_combo_list['cbd_combo_total_rate'],$_SESSION['be_decimal'])?></td>
                                          
                                           
                                        </tr>
                                        
                                        
                                        
                                        <?php
                                                  $sql_b= $database->mysqlQuery("select cod_combo_preference  FROM  tbl_combo_ordering_details where  cod_count_combo_ordering='".$result_combo_list['cbd_count_combo_ordering']."' and cod_combo_id='".$result_combo_list['cbd_combo_id']."' ");    
                                                        $num_b  = $database->mysqlNumRows($sql_b);
                                                       $result_b  = $database->mysqlFetchArray($sql_b);
                                                 
                                                 
                                                 if($result_b['cod_combo_preference']!=''){
                                                   ?>
                                                   <tr>
                                                     <td colspan="5" style="text-transform: lowercase">
                                                   Pref :  <?=$result_b['cod_combo_preference']?> 
                                                     </td>
                                                   </tr>
                                                 <?php } ?>
                                        
                                        
                                        
                                        
                                        
                                        <?php
                                            }
                                        }
                                    }
                                    
                
                                    
                  $l=1;
                  $sql_billhistory_billdetails_qry = $database->mysqlQuery("SELECT *,mn.mr_menuid,mr_menuname  from tbl_takeaway_billdetails as bd"
                          . " LEFT JOIN tbl_menumaster as mn 	ON bd.tab_menuid=mn.mr_menuid LEFT JOIN tbl_portionmaster as pm ON "
                          . " bd.tab_portion=pm.pm_id left join tbl_unit_master um on um.u_id=bd.tab_unit_id left join tbl_base_unit_master bum on"
                          . " bum.bu_id=bd.tab_base_unit_id WHERE bd.tab_billno='".$billhistory_billno."' and tab_count_combo_ordering IS NULL order by bd.tab_slno  ");

                                    $num_billhistory_billdetails_rows  = $database->mysqlNumRows($sql_billhistory_billdetails_qry);
                                    if($num_billhistory_billdetails_rows){
                                        
                                
                                    $portion='';
                                    $unit='';
                                   
                                   
                                    while($result_billhistory_billdetails_row  = $database->mysqlFetchArray($sql_billhistory_billdetails_qry)){
                                        $i++;
                                        
                                         $localhost=mysqli_connect(HOST_NAME, USER_NAME, PASSWORD,DATABASE_NAME);
                                         $itemotherlangname='';
                                        if($otherlang=="Y"){
									  mysqli_query($localhost,"SET NAMES 'utf8'");
									  mysqli_query($localhost,'SET CHARACTER SET utf8');
									  $sql_othlamg  =  mysqli_query($localhost,"Select lm_menu_print from tbl_language_menu_master  Where lm_menu_id='".$result_billhistory_billdetails_row['tab_menuid']."' AND lm_language_id='2'");
									  $num_othlamg  = mysqli_num_rows($sql_othlamg);
									  if($num_othlamg)
									  {
											  while($result_othlamg  = mysqli_fetch_array($sql_othlamg)) 
											  {
												$itemotherlangname=($result_othlamg['lm_menu_print']);
											  }
									  }
                            	                                     
                                        }
                                        
                                        
                                        
                                        if($result_billhistory_billdetails_row['tab_rate_type']=='Portion'){
                                            $sql_portion_billhistory= $database->mysqlQuery("select pm_portionshortcode FROM tbl_portionmaster where pm_id='".$result_billhistory_billdetails_row['tab_portion']."'");
                                            $num_portion_billhistory  = $database->mysqlNumRows($sql_portion_billhistory);
                                            $result_portion_billhistory  = $database->mysqlFetchArray($sql_portion_billhistory);
                                            $portion="(".$result_portion_billhistory['pm_portionshortcode'].")";
                                            $unit='';
                                        }
                                        else{
                                                if($result_billhistory_billdetails_row['tab_unit_type']=='Packet'){ 
                                                        $sql_unit_billhistory= $database->mysqlQuery(" select u_name FROM tbl_unit_master  where u_id='".$result_billhistory_billdetails_row['tab_unit_id']."' ");
                                                        $num_unit_billhistory  = $database->mysqlNumRows($sql_unit_billhistory);
                                                        $result_unit_billhistory  = $database->mysqlFetchArray($sql_unit_billhistory);
                                                        
                                                        $portion='';
                                                        $unit=number_format($result_billhistory_billdetails_row['tab_unit_weight'],$_SESSION['be_decimal']).' '.$result_unit_billhistory['u_name'];
                                                        
                                                }
                                                else{
                                                    $sql_baseunit_billhistory= $database->mysqlQuery("select bu_name FROM tbl_base_unit_master where bu_id='".$result_billhistory_billdetails_row['tab_base_unit_id']."'");
                                                    $num_baseunit_billhistory  = $database->mysqlNumRows($sql_baseunit_billhistory);
                                                    $result_baseunit_billhistory  = $database->mysqlFetchArray($sql_baseunit_billhistory);
                                                
                                                    $portion='';
                                                     $unit=number_format($result_billhistory_billdetails_row['tab_unit_weight'],$_SESSION['be_decimal']).' '.$result_baseunit_billhistory['bu_name'];
                                                }
                                        }
                                        $amount_sum=$amount_sum+$result_billhistory_billdetails_row['tab_amount'];
                                        ?>
                                                
                                                <tr>
                                                    
                                                    <td width="10%"><?=$l++?></td>
                                                    
                                                    
                                                    <td width="40%">
                                                        <?php if($result_billhistory_billdetails_row['tab_bill_addon_slno']!='') { ?>
                                                        <span style="color: #f00">(AD) </span>
                                                        <?php } ?>
                                                                <?=$result_billhistory_billdetails_row['mr_itemshortcode'].$portion?>
                                                        <span class="bill_histo_gram"><?=$unit?></span><br>
                                                         <span><?=$itemotherlangname?></span>
                                                    </td>
                                                   
                                                    <td width="10%" class="text-center"><?=$result_billhistory_billdetails_row['tab_qty']?></td>
                                                    <td width="15%" class="text-center"><?=number_format($result_billhistory_billdetails_row['tab_rate'],$_SESSION['be_decimal'])?></td>
                                                    <td width="20%" class="text-right"><?=number_format($result_billhistory_billdetails_row['tab_amount'],$_SESSION['be_decimal'])?></td>
                                                  
                                                 </tr>
                                                  
                                                <?php
                                                
                                                 
                                                 
                                                 if($result_billhistory_billdetails_row['tab_preferencetext']!=''){
                                                   ?>
                                                   <tr>
                                                     <td colspan="5" style="text-transform: lowercase">
                                                   Pref :  <?=$result_b['tab_preferencetext']?> 
                                                     </td>
                                                   </tr>
                                                 <?php } ?>
                                                 
                                               
                                                 
                                                 
                                                
                                    <?php }} ?>
						</table>
						</div>
                                  
                                                    <table class="table table-condensed">
    							
    							<tbody>
    							<tr>
    								
    								
    								<td  style="width: 79%;" class="thick-line text-right">Sub Total</td>
                                                                <td style="width: 23.5%;"  class="thick-line text-right"><?=number_format(str_replace(',','',$amount_sum),$_SESSION['be_decimal'])?></td>
    							</tr>
                                                        <?php
                                                        $sql_billhistory_billtax = $database->mysqlQuery("select   tbe_label, tbe_total_value FROM  tbl_takeaway_bill_extra_tax_master where  tbe_billno='".$billhistory_billno."'");    
                                                        $num_billhistory_billtax  = $database->mysqlNumRows($sql_billhistory_billtax);
                                                            if($num_billhistory_billtax){
                                                                while($result_billhistory_billtax  = $database->mysqlFetchArray($sql_billhistory_billtax)){
                                                        ?>
    							<tr>
    								<td  class="thick-line"><?=$result_billhistory_billtax['tbe_label']?></td>
    								
    								
    								<td style="width: 23.5%;" class="thick-line text-right"><?=number_format(str_replace(',','',$result_billhistory_billtax['tbe_total_value']),$_SESSION['be_decimal'])?></td>
    							</tr>
                                                        <?php 
                                                                }
                                                            }
                                                        ?>
    							
    							<tr>
    								<td class="thick-line"><strong>GRAND TOTAL</strong></td>
    								
    								
    								<td style="width: 23.5%;" class="thick-line text-right"><strong id="grand_total"><?=$billhistroy_bill_finaltotal;?></strong></td>
    							</tr>
                                                            
                                                        <?php if($billhistroy_bill_amountpaid>0){ ?>
    							<tr>
    								<td class="no-line">PAID CASH</td>
    								
    								
    								<td style="width: 23.5%;" class="no-line text-right"><?=$billhistroy_bill_amountpaid?></td>
    							</tr>
                                                        <?php }
                                                        if($billhistroy_bill_amountcard>0){
                                                            ?>
                                                        
                                                        <tr>
    								<td class="no-line">PAID CARD</td>
    								
    								
    								<td style="width: 23.5%;" class="no-line text-right"><?=$billhistroy_bill_amountcard?></td>
    							</tr>
                                                        <?php }
                                                        if($billhistroy_bill_amountpaid>0 || $billhistroy_bill_amountcard>0){
                                                            ?>
                                                        
    							<tr>
    								<td class="no-line">BALANCE</td>
    								
    								
    								<td style="width: 23.5%;" class="no-line text-right"><?=$billhistroy_bill_amountbalance?></td>
    							</tr>
                                                        <?php }
                                                        ?>
                                                        
                                                        
                                                       <?php if($billhistory_paymode_selcted=='6'){  ?>
                                                        <tr>
                                                            <td class="no-line"><strong style="color:#b55a5a">CREDIT BILL</strong></td>
    								
    								
    								<td style="width: 23.5%;" class="no-line text-right"><?=($billhistroy_bill_finaltotal-$billhistroy_bill_amountpaid)?></td>
    							</tr>
                                                        <?php }  ?>
                                                       
                                                        
                                                        <?php  if($billhistory_paymode_selcted=='7'){  ?>
                                                        <tr>
    								<td class="no-line"><strong style="color:#b55a5a">COMPLIMENTARY BILL</strong></td>
    								
    								
    								<td style="width: 23.5%;" class="no-line text-right"><strong></strong></td>
    							</tr>
                                                        <?php }  ?>
                                                        
                                                        
                                                        
                                                        
                                                    </tbody>
                                                </table>
    				</div>
    				
    				
    			</div>
    			
    		</div>
    		
    	</div>
    </div>
    <div class="bill_his_order_btm_detail">
        <?php 
        $sql_billhistory_kot = $database->mysqlQuery("select  distinct(tab_kotno) as kot FROM tbl_takeaway_billmaster    
                                                    where tab_billno = '".$billhistory_billno."' ");
                   
                   $num_billhistory_kot  = $database->mysqlNumRows($sql_billhistory_kot);
                   if($num_billhistory_kot){$kotno='';
                       while( $result_billhistory_kot  = $database->mysqlFetchArray($sql_billhistory_kot)){
    	                 $kot_nos[]=$result_billhistory_kot['kot'];
                    }
                   }
                   
                   $kotno=implode(',',$kot_nos);
        ?>                      
                       <div class="col-xs-12" style="padding-left: 5px">
    			<address style="text-align: left">
    			<strong>KOT :<span><?=implode(',',$kot_nos)?></span>	</strong><br>
                        
                         <strong><?=$cst?></span>	</strong><br>
                        
                        <strong><?=$cst1?></span>	</strong><br>
                        <strong><?=$cst2?></span>	</strong>
                        
                        
    			</address>
		</div>
		
        
        <?php
                if($sa_format_on=='Y'){
                    
                ////saudi qr code///
                $displayQRCodeAsBase64 = GenerateQrCode::fromArray([
                new Seller($br), // seller name        
                new TaxNumber($branchothers3), // seller tax number
                new InvoiceDate($print_dateta.'T'.$print_timeta.'Z'), // invoice date 
                new InvoiceTotalAmount($billhistroy_bill_finaltotal), // invoice total amount
                new InvoiceTaxAmount($ta_tx_amt) // invoice tax amount
                // TODO :: Support others tags
                ])->render();
                copy($displayQRCodeAsBase64, 'qr_zatca/qr.png');
                ////saudi qr code end///
            
                ?>
         <div class="bill_history_tax_btm_cc">
             <div class="col-xs-11 no-padding"     style="margin-left: 520px;">
              <img src="qr_zatca/qr.png" >
                     </div> <br>
        </div>
              <?php } ?>
        
        
        
        
         <div class="bill_history_tax_btm_cc">
        
		<div class="col-xs-11 no-padding"     style="margin-left: 560px;">
			<div class="col-xs-4" style="padding-left: 0">
                            <span class="bill_story_center_top_txt" >THANK YOU . VISIT AGAIN </span>
			</div>
			
                </div> <br>
                    
		<div class="col-xs-11 no-padding"  style="margin-left: 565px;">
			<div class="col-xs-4" style="padding-left: 0">
				<span class="bill_story_center_top_txt" style="font-weight:bold ">POWERED BY SOFTWARE</span>
			</div>
			
                </div>
       </div>
        
       </div> 
        
	</div>
     
 <?php  
    
}
	
}


if(isset($_REQUEST['set']) && $_REQUEST['set']=="share_ebill")
{
  
    
    
    $billno= $_REQUEST['billno']; 
    
    $customer='';  $number=''; 

    
    
    if($_REQUEST['mode']=='DI'){
        
    $loy_qry1 = $database->mysqlQuery("select lr.ly_firstname,lr.ly_mobileno from tbl_loyalty_pointadd_bill lb"
     . " left join tbl_loyalty_reg lr on lr.ly_id=lb.lob_loyalty_customer where lb.lob_billno='".$billno."'");
   
     $num_loy = $database->mysqlNumRows($loy_qry1);
     if($num_loy)
     {
      while($loyalty_listing = $database->mysqlFetchArray($loy_qry1))
      {
             $customer=$loyalty_listing['ly_firstname'];
             $number=$loyalty_listing['ly_mobileno'];
             
     }}
     
    }else{
        
    $loy_qry1 = $database->mysqlQuery("select tab_phone,tab_name  from  tbl_takeaway_billmaster where tab_billno='".$billno."'");
   
     $num_loy = $database->mysqlNumRows($loy_qry1);
     if($num_loy)
     {
      while($loyalty_listing = $database->mysqlFetchArray($loy_qry1))
      {
             $customer=$loyalty_listing['tab_name'];
             $number=$loyalty_listing['tab_phone'];
             
     }}
        
    }
     
   
     ///encode///
    $secret_key = 'my_simple_secret_key';
    $secret_iv = 'my_simple_secret_iv';

    $conv1 = false;
    
    
    $encrypt_method = "AES-256-CBC";
    $key = hash( 'sha256', $secret_key );
    $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );

    $conv=$billno.','.$_SESSION['firebase_id'];
    
    $conv1 = base64_encode( openssl_encrypt( $conv, $encrypt_method, $key, 0, $iv ) );
    
     ////encode_end////
     
     $var2= "https://www.expodinereports.com/ebill/ebill.php?b_id=$conv1";
     
     $api_short=''; $api_token='';
     $loy_qry16 = $database->mysqlQuery("select shortlink_api,shortlink_token  from  tbl_generalsettings ");
   
     $num_loy6 = $database->mysqlNumRows($loy_qry16);
     if($num_loy6)
     {
      while($loyalty_listing6 = $database->mysqlFetchArray($loy_qry16))
      {
             $api_short=$loyalty_listing6['shortlink_api'];
             $api_token=$loyalty_listing6['shortlink_token'];
             
     }}
     
 if($api_short!=''){
         
     $longUrl="https://www.expodinereports.com/ebill/ebill.php?b_id=$conv1";
 
    $data = [
        "long_url" => $longUrl,
    ];

    $ch = curl_init($api_short);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: Bearer " . $api_token,
        "Content-Type: application/json",
    ]);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode == 200) {
        $responseData = json_decode($response, true);
        $var2= $responseData['link']; // Shortened URL
    } else {
        echo "Error: Unable to shorten URL. HTTP Code " . $httpCode;
    }
         
     }
     
     
     echo '##'.$var2.'##';
     
     
     $var1=$_SESSION['s_branchname'];
     
    if($_SESSION['s_sms_bill']=="Y") {
        
    $data = file_get_contents("https://bhashsms.com/api/sendmsg.php?user=ExploreITBW&pass=123456&sender=BUZWAP&phone=$number"
     . "&text=bill_new2&priority=wa&"
     . "stype=normal&Params=$var1,$var2");
    
     }


}

?>
         
         
         

 </div>
 </div>
 </div>
 </div>
 </body>
 </html>
  <script src="js/dom-to-image.min.js"></script>
<script src="js/FileSaver.min.js"></script>
 <script type="text/javascript">
     
    function share_page(){
        
          var whatsapp_num=$('#whatsapp_num').val();
          
          var billno=$('#billno').text();
          
          var time=new Date();
          
         var node = document.getElementById('my-node');
         var rect = node.getBoundingClientRect();
         
         
          domtoimage.toBlob(node, {
            width: rect.width,
            height: rect.height,
            style: {
              transform: "scale(1)",
              transformOrigin: "top left",
              left: "0px",
              top: "0px"
             }
            })
            .then(function(blob) {
                     window.saveAs(blob, billno+'_'+whatsapp_num+'_'+time+'.png');

                     });
        
                    setTimeout(function(){
                           
                     window.open('https://wa.me/'+whatsapp_num+'?text=This Is Your Ebill.', '_blank'); 
                     
                     
                    }, 1000);
                    
                  setTimeout(function(){
                           
                     window.close();
                     
                     
                    }, 2000);        
                    
        
        
    }
     
     
function print_page()
{
  document.getElementById("printbutton").style.display = "none";	
  window.print();
}
function close_page(){
   window.top.close();
}
</script>  