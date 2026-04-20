<?php
include('includes/session.php'); // Check session
//session_start();

include("database.class.php");  // DB Connection class
$database	= new Database();

require_once("includes/title_settings.php");
include('includes/master_settings.php');
include("api_multiplelanguage_link.php");
$other_lang=  trim(json_encode($_SESSION['main_language']),'""');
//include('includes/menu_settings.php');

 if($_REQUEST['set']=='loadtablehead')
 {
	 $_SESSION['creditypeid']=$_REQUEST['type'];
	 
 ?>
     
     <table class="billgenration_new_table" width="100%" border="0">
     <thead>
             <tr>
             <th width="10%"><?=$_SESSION['credit_settlement_slno']?></th>
             <?php if($_SESSION['creditypeid']!='all' ){?>  <th width="60%" ><span class="loadtype"></span></th> <?php } ?>
              <?php if($_SESSION['creditypeid']=='all'){?> <th width="40%"><?=$_SESSION['credit_settlement_name']?></th> <?php } ?>
              <?php if($_SESSION['creditypeid']=='all'){?> <th width="20%"><?=$_SESSION['credit_settlement_type']?></th> <?php } ?>
              <th width="30%"><?=$_SESSION['credit_settlement_amount']?></th>
              
            </tr>
      </thead>
     </table>
     <?php
 }else if($_REQUEST['set']=='loadcreditdetails')
 {
	 $creditype=$_REQUEST['type'];
	 $sqlquery='';
	 if($creditype=='1')
	 {
	    $sqlquery=("SELECT rm.rm_roomno as name,cm.crd_totalamount as amount,ct.ct_labels as label,cm.crd_id as cid,ct.ct_creditid as labellan from tbl_credit_types as ct LEFT JOIN tbl_credit_master as cm ON ct.ct_creditid=cm.crd_type LEFT JOIN tbl_roommaster as rm ON rm.rm_roomid=cm.crd_roomid  WHERE ct.ct_active='Y' AND  ct.ct_creditid='1'");
	 }else if($creditype=='2')
	{
	    $sqlquery=("SELECT sm.ser_firstname as name,sm.ser_lastname  as name2,cm.crd_totalamount as amount,ct.ct_labels as label,cm.crd_id as cid,ct.ct_creditid as labellan,cm.crd_staffid from tbl_credit_types as ct LEFT JOIN tbl_credit_master as cm ON ct.ct_creditid=cm.crd_type  LEFT JOIN tbl_staffmaster as sm ON sm.ser_staffid=cm.crd_staffid WHERE ct.ct_active='Y'  AND ct.ct_creditid='2' AND  sm.ser_employeestatus='Active' order by name asc");
	}else if($creditype=='3')
	{
	     $sqlquery=("SELECT csm.ct_corporatename as name, cm.crd_totalamount as amount,ct.ct_labels as label,cm.crd_id as cid,ct.ct_creditid as labellan,cm.crd_corporateid from tbl_credit_types as ct LEFT JOIN tbl_credit_master as cm ON ct.ct_creditid=cm.crd_type LEFT JOIN tbl_corporatemaster as csm ON csm.ct_corporatecode=cm.crd_corporateid  WHERE ct.ct_active='Y' AND ct.ct_creditid='3' order by name asc");
	}else if($creditype=='4')
	{
	     $sqlquery=("SELECT lr.ly_mobileno as num,lr.ly_firstname as name,lr.ly_lastname as name2,cm.crd_totalamount as amount,ct.ct_labels as label,cm.crd_id as cid,ct.ct_creditid as labellan from tbl_credit_types as ct LEFT JOIN tbl_credit_master as cm ON ct.ct_creditid=cm.crd_type LEFT JOIN tbl_loyalty_reg as lr ON lr.ly_id=cm.crd_guestid  WHERE ct.ct_active='Y'  AND ct.ct_creditid='4' order by name asc");
	}else if($creditype=='all')
	{
              $sqlquery=("SELECT cm.crd_staffid,cm.crd_roomid,cm.crd_corporateid,cm.crd_guestid,cm.crd_totalamount as amount,ct.ct_labels as label,cm.crd_id as cid,ct.ct_creditid as labellan from tbl_credit_types as ct LEFT JOIN tbl_credit_master as cm ON ct.ct_creditid=cm.crd_type LEFT JOIN tbl_loyalty_reg as lr ON lr.ly_id=cm.crd_guestid WHERE ct.ct_active='Y' ");
                
	}
	
	?>
     <table class="billgenration_new_table_content" width="100%" border="0">  
        <tbody >
       <?php
	  if( $creditype !=""){
	   
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
					{
						if(($result_ds['label'])=="Staff name")
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
            
              <tr class="clickeachcredit <?php if(isset($_REQUEST['sel'])){if($_REQUEST['sel']==$result_ds['cid']){ ?> tr_bill_gen_active <?php }} ?>" crdit="<?=$result_ds['cid'] ?>"><!--<tr class="tr_bill_gen_active">-->
              <td width="10%"><?=$i++;?></td>
              <?php if($creditype!='all'){?> <td width="60%"><?=$name .' &nbsp &nbsp '.$num_stfs?></td> <?php } ?>
              <?php if($creditype=='all'){?> <td width="40%"><?=$name .' &nbsp &nbsp '.$num_stfs?></td> <?php } ?>
              <?php if($creditype=='all'){?> <td width="20%" style="font-size:10px"><?=$label?> &nbsp  [ID : <?=$result_ds['cid'] ?>]</td> <?php } ?>
              <?php if($creditype!='all'){?> <td width="20%" style="font-size:10px">[ID : <?=$result_ds['cid'] ?>]</td> <?php } ?>
              
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
                <?php
                   
                } }
                   
                ?>
                
              </tr>
              
            <?php } } } } }  }?>
         
        </tbody>
        
        </table>
        <script type="text/javascript" src="js/bill_credit_select.js"></script>  
        
    <?php 
    
 }else if($_REQUEST['set']=='loadbilldetails')
 {
    $id=$_REQUEST['id'];
	 
     ?>
     <table  class="billgenration_new_table" width="100%" border="0" cellspacing="5">
      <thead>
            <tr>
              <th  width="10%"><input  type="checkbox" id="all_check_credit"> </th>
              <th style="display:none" width="10%">#</th>
              <th width="10%">Mode</th>
              <th width="33%"><?=$_SESSION['credit_settlement_bill_no']?></th>
              <th width="15%"><?=$_SESSION['credit_settlement_date']?></th>
              <th width="22%"><?=$_SESSION['credit_settlement_amount']?></th>
            </tr>
        </thead>
        <tbody> 
            
            <?php 
//$sqlquery1="SELECT date(cd.cd_dateofentry) as dt from tbl_credit_details cd
//left join tbl_tablebillmaster bm on bm.bm_billno= cd.cd_billno
//left join tbl_takeaway_billmaster tbm on tbm.tab_billno =cd.cd_billno
//Where cd.cd_settled='N' AND cd.cd_masterid='".$id."' and (bm.bm_status='Closed' or tbm.tab_status='Closed') group by date(cd.cd_dateofentry) ";
            
             $sqlquery1="SELECT date(cd.cd_dateofentry) as dt from tbl_credit_details cd
                  
             Where cd.cd_settled='N' AND cd.cd_masterid='".$id."'  group by date(cd.cd_dateofentry) ";
             
             $sql_ds1  =  $database->mysqlQuery($sqlquery1); 
	     $num_ds1 = $database->mysqlNumRows($sql_ds1);
	     if($num_ds1){ 
	     while($result_ds1 = $database->mysqlFetchArray($sql_ds1)) {
             ?>
            
            <tr>
                <td style="background-color: #439d98 " width="17%"><?= $result_ds1['dt']?></td>
                
            </tr>
            
        <?php
             
//$total=0;      
//$sqlquery="SELECT cd.cd_modeofentry,cd.cd_billno,date(cd.cd_dateofentry) as dt,cd.cd_amount from tbl_credit_details cd
//left join tbl_tablebillmaster bm on bm.bm_billno= cd.cd_billno
//left join tbl_takeaway_billmaster tbm on tbm.tab_billno =cd.cd_billno
//Where cd.cd_settled='N' and date(cd.cd_dateofentry)='".$result_ds1['dt']."' AND cd.cd_masterid='".$id."' and
// (bm.bm_status='Closed' or tbm.tab_status='Closed') order by cd.cd_dateofentry,cd.cd_modeofentry";

                $sqlquery="SELECT cd.cd_modeofentry,cd.cd_billno,date(cd.cd_dateofentry) as dt,cd.cd_amount from tbl_credit_details cd
                   
                Where cd.cd_settled='N' and date(cd.cd_dateofentry)='".$result_ds1['dt']."' AND "
                        
                . " cd.cd_masterid='".$id."' order by cd.cd_amount asc";
      
		$sql_ds  =  $database->mysqlQuery($sqlquery); 
		$num_ds = $database->mysqlNumRows($sql_ds);
		if($num_ds){ 
		while($result_ds = $database->mysqlFetchArray($sql_ds)) 
		{
                     
		//$total=$total + $result_ds['cd_amount'];
		?>
            
              <tr>
               
              <td width="10%"><input type="checkbox" name="selectbills[]" bilnos="<?=$result_ds['cd_billno']?>" class="selectbillsck" rate="<?=$result_ds['cd_amount']?>"></td>
              
              <td width="10%"><p style="margin-top:9px " class="viewbilpopup12" id="<?=$result_ds['cd_modeofentry']?>"  name="<?=$result_ds['cd_modeofentry']?>"><?=$result_ds['cd_modeofentry']?>  </p></td>
              <td width="33%"><a style="color:#456056;border: solid 1px;padding: 2px;border-radius: 3px;" class="viewbilpopup" id="<?=$result_ds['cd_billno']?>" href="#"><?=$result_ds['cd_billno']?></a></td>
              <td width="17%"><?= date("d-m-Y",strtotime($result_ds['dt']))?></td>
              <td width="21%"><?=  number_format($result_ds['cd_amount'],$_SESSION['be_decimal'])?></td>
            </tr>
            <?php } }
            
            
            
            }}
            
                $sqlquery2="SELECT cd.cd_amount from tbl_credit_details cd
                   
                Where cd.cd_settled='N' and  cd.cd_masterid='".$id."'  order by cd.cd_dateofentry,cd.cd_modeofentry";
                
		$total=0; 
		$sql_ds2  =  $database->mysqlQuery($sqlquery2); 
		$num_ds2 = $database->mysqlNumRows($sql_ds2);
		if($num_ds2){ 
	        while($result_ds2 = $database->mysqlFetchArray($sql_ds2)) 
		  {
			$total=$total + $result_ds2['cd_amount'];
                 }}
            
             $sql_login_tc =  $database->mysqlQuery("update tbl_credit_master set crd_totalamount ='".$total."' where crd_id='".$id."' ");         
                
            ?>
          
         </tbody>
        </table>
         <input type="hidden" value="<?=$total?>" id="tot_click" >
         <input type="hidden" value="<?=$_SESSION['be_decimal']?>" id="decimal" >
          <script>
              //$(document).ready(function(){
              var a=$('#decimal').val();
                    $('.grandtotal').html((<?=$total?>).toFixed(a));
              //});
              </script>
      <script type="text/javascript" src="js/bill_credit_bill.js"></script>   
        
    <?php
	
 }else if($_REQUEST['set']=='loadbillcontents')
 {
	 
 ?>
            <table class="billgenration_new_table " width="100%" border="0" cellspacing="5" style="border-bottom:1px #ccc solid;margin-bottom:10px;">
            <thead>
                  <tr>
                    <th width="10%">Sl No</th>
                    <th width="40%">Item</th>
                    <th width="10%">Qty</th>
                    <th width="15%">Rate</th>
                    <th width="22%">Amount</th>
                  </tr>
              </thead> 
              <tbody style="height:355px;min-height:360px;">
              <?php  
              
               $sql_listall5  =  $database->mysqlQuery("SELECT * from tbl_credit_details  WHERE cd_billno='".$_REQUEST['bilno']."' "); 
		$num_listall5  = $database->mysqlNumRows($sql_listall5);
		if($num_listall5){
		while($row_listall5  = $database->mysqlFetchArray($sql_listall5)) 
		{                                 
                    $crdamount1=$row_listall5['cd_amount'];
                 }
                }
              
              
			 
				 $sql_listall  =  $database->mysqlQuery("SELECT * from tbl_tablebilldetails as td LEFT JOIN tbl_menumaster as mn "
                                 . " ON td.bd_menuid=mn.mr_menuid LEFT JOIN tbl_portionmaster as pm ON td.bd_portion=pm.pm_id left join "
                                 . " tbl_tablebillmaster tbb on tbb.bm_billno=td.bd_billno WHERE td.bd_billno='".$_REQUEST['bilno']."' "
                                 . " order by td.bd_billslno "); 
					$num_listall  = $database->mysqlNumRows($sql_listall);
					if($num_listall){
					while($row_listall  = $database->mysqlFetchArray($sql_listall)) 
					{
                                                      
                                            $amt1=$row_listall['bm_finaltotal'];
                                            $ampaid1=$row_listall['bm_amountpaid'];
				?>
									<tr>
                                    <td width="10%"><?=$row_listall['bd_billslno'] ?></td>
                                    <td width="40%"><?=$row_listall['mr_menuname'] ?></td>
                                    <td width="10%"><?=$row_listall['bd_qty'] ?></td>
                                    <td width="15%"><?=$row_listall['bd_rate'] ?></td>
                                    <td width="22%"><?=($row_listall['bd_amount']) ?></td>
                                  </tr>
                  <?php } } ?>
                                  
             <tr>                
             <td style="text-align: right; padding-right:34px "><span>Total (inc.tax) :</span> <span><?=$amt1?></span></td> 
             </tr>
             
             <tr>
             <td style="text-align: right; padding-right:34px "><span>Paid Amount :</span> <span><?=$ampaid1?></span></td> 
             </tr>
             
             <tr>
             <td style="text-align: right; padding-right:34px "><span>Credit Amount :</span> <span id="crdtotal"><?=$crdamount1?></span></td> 
             </tr>
             
              </tbody>
              </table>
			
     <?php
 }
 else if($_REQUEST['set']=='loadbillcontentsta')
 {
	 
	    ?>
            <table class="billgenration_new_table " width="100%" border="0" cellspacing="5" style="border-bottom:1px #ccc solid;margin-bottom:10px;">
            <thead>
                  <tr>
                    <th width="10%">Sl No</th>
                    <th width="40%">Item</th>
                    <th width="10%">Qty</th>
                    <th width="15%">Rate</th>
                    <th width="22%">Amount</th>
                  </tr>
              </thead> 
              <tbody style="height:355px;min-height:360px;">
                  
               <?php  
               $sql_listall5  =  $database->mysqlQuery("SELECT * from tbl_credit_details  WHERE cd_billno='".$_REQUEST['bilno']."' "); 
					$num_listall5  = $database->mysqlNumRows($sql_listall5);
					if($num_listall5){
						 while($row_listall5  = $database->mysqlFetchArray($sql_listall5)) 
						{
                                                      
                                                    $crdamount=$row_listall5['cd_amount'];
                                                      
                                                 }
                                                          
                                                }
              
              
              
			 
				 $sql_listall  =  $database->mysqlQuery("SELECT * from tbl_takeaway_billdetails as td LEFT JOIN tbl_menumaster as mn "
                                 . " ON td.tab_menuid=mn.mr_menuid LEFT JOIN tbl_portionmaster as pm ON td.tab_portion=pm.pm_id left join "
                                 . " tbl_takeaway_billmaster tmb on td.tab_billno=tmb.tab_billno  WHERE td.tab_billno='".$_REQUEST['bilno']."' "
                                 . " order by td.tab_slno "); 
				 $num_listall  = $database->mysqlNumRows($sql_listall);
					if($num_listall){
					while($row_listall  = $database->mysqlFetchArray($sql_listall)) 
					{
                                                      
                                                     $amt=$row_listall['tab_netamt'];
                                                     $ampaid=$row_listall['tab_amountpaid'];
                                                      
					?>
				    <tr>
                                    <td width="10%"><?=$row_listall['tab_slno'] ?></td>
                                    <td width="40%"><?=$row_listall['mr_menuname'] ?></td>
                                    <td width="10%"><?=$row_listall['tab_qty'] ?></td>
                                    <td width="15%"><?=$row_listall['tab_rate'] ?></td>
                                    <td width="22%"><?=$row_listall['tab_amount'] ?></td>
                                    
                                   </tr>
              
                  <?php } } ?>
                                  
                                  <tr>                
             <td style="text-align: right; padding-right:34px "><span>Total (inc.tax) :</span> <span><?=$amt?></span></td> 
                                  </tr>
                                  <tr>
             <td style="text-align: right; padding-right:34px "><span>Paid Amount :</span> <span><?=$ampaid?></span></td> 
                                  </tr>
                                  <tr>
             <td style="text-align: right; padding-right:34px "><span>Credit Amount :</span> <span><?=$crdamount?></span></td> 
                                  </tr>
                  </tbody>
              </table>
		
 <?php
 }else if($_REQUEST['set']=="credit_settle") 
{
	$billno				=$_REQUEST['billno'];    
	$creditype			=NULL;
	$typenam			=$_REQUEST['typenam'];
	$credit				='N';
	$amountpaid                     =0;
        $amount_bal                     =0;
	$creditno			=$_REQUEST['credino'];
	
	$creditdeatils		        =NULL;
	$paidamount_credit	        =NULL;
	$amount_credit		        =0;
	
	$transactionamount	        =0;
	$card_bank			=0;
	$remark				=NULL;
	$voucherid			=NULL;
	$couponcompany		        =NULL;
	$couponamt			=0;
	$chequeno			=NULL;
	$chequebankname		        =NULL;
	$chequeamount		        =0;
        
	if($_REQUEST['type']=="credit_person")
	{ 
		$creditype		=$_REQUEST['creditype'];
		$creditdeatils		=$_REQUEST['creditdeatils'];
		$paidamount_credit	=$_REQUEST['paidamount_credit'];
		$amountpaid             =$_REQUEST['paidamount_credit'];
		$amount_credit		=$_REQUEST['amount_credit'];
		$credit			='Y';
		
	}else if($_REQUEST['type']=="complimentary")
	{
		$remark=$_REQUEST['comp'];
		
	}else if($_REQUEST['type']=="cash")
	{
		$amountpaid=$_REQUEST['paid'];
                $amount_bal=$_REQUEST['bal'];
                $card_bank=0;
		
	}else if($_REQUEST['type']=="credit")
	{
		$transactionamount =$_REQUEST['trans'];
		$card_bank =$_REQUEST['bank'];
		$amountpaid=$_REQUEST['paid'];
                $amount_bal=$_REQUEST['bal'];
							 
	}else if($_REQUEST['type']=="coupon")
	{
		$couponcompany=$_REQUEST['coup'];
		$couponamt=$_REQUEST['coupamnt'];
		$amountpaid=$_REQUEST['paid'];
		
	}else if($_REQUEST['type']=="voucher")
	{
		$voucherid=$_REQUEST['vouchid'];
		$amountpaid=$_REQUEST['paid'];
		
	}else if($_REQUEST['type']=="cheque")
	{
		$chequeno		=$_REQUEST['cheqname'];
		$chequebankname		=$_REQUEST['cheqbank'];
		$chequeamount		=$_REQUEST['cheqamt'];
			
	}
	 
        echo "ok";

}
else if($_REQUEST['set']=="credit_settle_print_partial") 
{
	$billno				=$_REQUEST['billno'];    
        
	$creditype			=NULL;
	$typenam			=$_REQUEST['typenam'];
	$credit				='N';
	$amountpaid                     =0;
        $amount_bal                     =0;
	$creditno			=$_REQUEST['credino'];
	
	$creditdeatils		        =NULL;
	$paidamount_credit	        =NULL;
	$amount_credit		        =0;
	
	$transactionamount	        =0;
	$card_bank			=0;
	$remark				=NULL;
	$voucherid			=NULL;
	$couponcompany		        =NULL;
	$couponamt			=0;
	$chequeno			=NULL;
	$chequebankname		        =NULL;
	$chequeamount		        =0;
        
	if($_REQUEST['type']=="credit_person")
	{ 
		$creditype		=$_REQUEST['creditype'];
		$creditdeatils		=$_REQUEST['creditdeatils'];
		$paidamount_credit	=$_REQUEST['paidamount_credit'];
		$amountpaid             =$_REQUEST['paidamount_credit'];
		$amount_credit		=$_REQUEST['amount_credit'];
		$credit			='Y';
		
	}else if($_REQUEST['type']=="cash")
	{
		$amountpaid=$_REQUEST['paid'];
                $amount_bal=$_REQUEST['bal'];
                $card_bank=0;
		
	}else if($_REQUEST['type']=="credit")
	{
		$transactionamount =$_REQUEST['trans'];
		$card_bank =$_REQUEST['bank'];
		$amountpaid=$_REQUEST['paid'];
                $amount_bal=$_REQUEST['bal'];
							 
	}
	
        
    $id = $_REQUEST['id'];
    $total=$_REQUEST['bill'];
  
    $master=$_REQUEST['credino'];  
      
    $date=date("Y-m-d H:i:s");
    $rate_new   =$_REQUEST['rates'];
    
    
    $paid=$_REQUEST['paid'];
    $trans =$_REQUEST['trans'];
    
    
    
    for($i=0;$i<count($billno);$i++)
    { 
  
        ///cash////   
       
        if($_REQUEST['mode']=="cash" && ($_REQUEST['bal_partial']>0 || $_REQUEST['paid_partial']>0) )
	{
           
                $tot_part_paid=0;
                $sql_listall5  =  $database->mysqlQuery("SELECT sum(tcp_amount) as amt from tbl_credit_partial_bill WHERE tcp_billno='".$billno[$i]."' "); 
		$num_listall5  = $database->mysqlNumRows($sql_listall5);
		if($num_listall5){
		while($row_listall5  = $database->mysqlFetchArray($sql_listall5)) 
		{
                     $tot_part_paid=$tot_part_paid+$row_listall5['amt'];
                    
                 }
                 
                      $rt=$rate_new[$i]-$tot_part_paid;
                 
                }else{
                    
                      $rt=$rate_new[$i];
                    
                }
                
               
            if($paid>$rt){    
                
              $paid=$paid-$rate_new[$i];    
                
              $sql1=$database->mysqlQuery("INSERT INTO `tbl_credit_partial_bill`(`tcp_billno`, `tcp_mode`, `tcp_amount`,tcp_date,tcp_login)"
              . " VALUES ('".$billno[$i]."','1','$rt','$date','".$_SESSION['expodine_id']."')");   
           
              
            }else{
                
                if($paid>0){
                    
                  //$paid=$rate_new[$i]-$paid;       
                
                 $sql1=$database->mysqlQuery("INSERT INTO `tbl_credit_partial_bill`(`tcp_billno`, `tcp_mode`, `tcp_amount`,tcp_date,tcp_login)"
                 . " VALUES ('".$billno[$i]."','1','$paid','$date','".$_SESSION['expodine_id']."')");  
                 
                 $paid=0;
                 
                 
                }
                
           }
            
            $sql12=$database->mysqlQuery("delete from tbl_credit_partial_bill where tcp_billno like '%Array%' "); 
            
       }
        
        
         ///card/////
       
        if($_REQUEST['mode']=="credit" && ($_REQUEST['bal_partial']>0 || $_REQUEST['paid_partial']>0) )
	{
            
            $tot_part_paid=0;
                $sql_listall5  =  $database->mysqlQuery("SELECT sum(tcp_amount) as amt from tbl_credit_partial_bill  WHERE tcp_billno='".$billno[$i]."' "); 
		$num_listall5  = $database->mysqlNumRows($sql_listall5);
		if($num_listall5){
		while($row_listall5  = $database->mysqlFetchArray($sql_listall5)) 
		{
                     $tot_part_paid=$tot_part_paid+$row_listall5['amt'];
                    
                 }
                 
                    $rt=$rate_new[$i]-$tot_part_paid;
                 
                }else{
                    
                    $rt=$rate_new[$i];
                    
                }
                
               
            if($paid>$rt){    
                
              $paid=$paid-$rate_new[$i];    
                
              $sql1=$database->mysqlQuery("INSERT INTO `tbl_credit_partial_bill`(`tcp_billno`, `tcp_mode`, `tcp_amount`,tcp_date,tcp_login)"
              . " VALUES ('".$billno[$i]."','2','$rt','$date','".$_SESSION['expodine_id']."')");   
           
            }else{
                
                if($paid>0){
                    
                  //$paid=$rate_new[$i]-$paid;       
                
                 $sql1=$database->mysqlQuery("INSERT INTO `tbl_credit_partial_bill`(`tcp_billno`, `tcp_mode`, `tcp_amount`,tcp_date,tcp_login)"
                 . " VALUES ('".$billno[$i]."','2','$paid','$date','".$_SESSION['expodine_id']."')");  
                 
                 $paid=0;
                 
                }
               
           }
            
            $sql12=$database->mysqlQuery("delete from tbl_credit_partial_bill where tcp_billno like '%Array%' "); 
            
        }
        
        
        
                $tot_all_bill=0;
                $sql_listall56  =  $database->mysqlQuery("SELECT sum(tcp_amount) as amt from tbl_credit_partial_bill  WHERE tcp_billno='".$billno[$i]."' "); 
		$num_listall56  = $database->mysqlNumRows($sql_listall56);
		if($num_listall56){
		while($row_listall56  = $database->mysqlFetchArray($sql_listall56)) 
		{
                     $tot_all_bill=$tot_all_bill+$row_listall56['amt'];
                    
                 }
                 
                }
        
        if($tot_all_bill==$rate_new[$i]){
            
             $sql=$database->mysqlQuery("UPDATE tbl_credit_details SET cd_settled='Y' , cd_dateofsettle='$date' "
              . " WHERE cd_billno='".$billno[$i]."'  ");
            
        }
                
        
    }
    
    
    if($amountpaid>0 || is_nan($amountpaid)){
        
    }else{
        $amountpaid=0;
    }
    
    if($amount_bal>0 || is_nan($amount_bal)){
        
    }else{
        $amount_bal=0;
    }
    
   
   $sql1=$database->mysqlQuery("INSERT INTO `tbl_credit_details_payment`(`cdp_master_id`, `cdp_dayclosedate`, `cdp_paid_cash`, `cdp_transaction_amount`, "
   . " `cdp_balance`,`cdp_login_id`,`cdp_bank`) VALUES"
   . " ('$master','".$_SESSION['date']."','$amountpaid','$transactionamount','$amount_bal','".$_SESSION['login_staff_id_expodine']."','$card_bank')");
	
   $sql=$database->mysqlQuery("UPDATE tbl_credit_master SET crd_totalamount=0 WHERE crd_totalamount<0 ");
       
   $sql=$database->mysqlQuery("delete from  tbl_credit_details  WHERE (cd_billno='' or cd_billno is null) ");
   
   $sql=$database->mysqlQuery("delete from tbl_credit_details_payment WHERE (cdp_master_id='' or cdp_master_id is null or cdp_master_id='undefined')");
    
        
        require_once("printer_functions.php");
        $printpage=new PrinterCommonSettings();  
        
        $bill_new=$_REQUEST['billno'];
        
        $bill_in='';
       
        for($j=0;$j<=count($bill_new);$j++)
	 {  
           
              $bill_in.=$bill_new[$j].',';
         }
        
         
      if($_SESSION['s_printst']=='Y'){
        
         $printpage->print_credit_settle($bill_in,$amountpaid,$transactionamount,$_REQUEST['bal_partial']);
    
      }
        

}
else if($_REQUEST['set']=="credit_settle_print") 
{
	$billno				=$_REQUEST['billno'];    
        
	$creditype			=NULL;
	$typenam			=$_REQUEST['typenam'];
	$credit				='N';
	$amountpaid                     =0;
        $amount_bal                     =0;
	$creditno			=$_REQUEST['credino'];
	
	$creditdeatils		        =NULL;
	$paidamount_credit	        =NULL;
	$amount_credit		        =0;
	
	$transactionamount	        =0;
	$card_bank			=0;
	$remark				=NULL;
	$voucherid			=NULL;
	$couponcompany		        =NULL;
	$couponamt			=0;
	$chequeno			=NULL;
	$chequebankname		        =NULL;
	$chequeamount		        =0;
        
	if($_REQUEST['type']=="credit_person")
	{ 
		$creditype		=$_REQUEST['creditype'];
		$creditdeatils		=$_REQUEST['creditdeatils'];
		$paidamount_credit	=$_REQUEST['paidamount_credit'];
		$amountpaid             =$_REQUEST['paidamount_credit'];
		$amount_credit		=$_REQUEST['amount_credit'];
		$credit			='Y';
		
	}else if($_REQUEST['type']=="cash")
	{
		$amountpaid=$_REQUEST['paid'];
                $amount_bal=$_REQUEST['bal'];
                $card_bank=0;
		
	}else if($_REQUEST['type']=="credit")
	{
		$transactionamount =$_REQUEST['trans'];
		$card_bank =$_REQUEST['bank'];
		$amountpaid=$_REQUEST['paid'];
                $amount_bal=$_REQUEST['bal'];
							 
	}
	  
        
    $id = $_REQUEST['id'];
    $total=$_REQUEST['bill'];
  
    $master=$_REQUEST['credino'];  
      
    $date=date("Y-m-d H:i:s");
    $rate_new   =$_REQUEST['rates'];
    
    for($i=0;$i<count($billno);$i++)
    { 
  
   
       if( ($_REQUEST['paid_partial']==$_REQUEST['tot_partial'])){
            
           $sql=$database->mysqlQuery("UPDATE tbl_credit_details SET cd_settled='Y' , cd_dateofsettle='$date' "
           . " WHERE cd_billno='".$billno[$i]."'  ");
         
       }
       
       
        if(count($billno)>1){
            
             $paid=$rate_new[$i];
             $trans =$rate_new[$i];
             
            
             $tot_part_paid=0;
             $sql_listall5  =  $database->mysqlQuery("SELECT sum(tcp_amount) as amt from tbl_credit_partial_bill  WHERE tcp_billno='".$billno[$i]."' "); 
		$num_listall5  = $database->mysqlNumRows($sql_listall5);
		if($num_listall5){
		while($row_listall5  = $database->mysqlFetchArray($sql_listall5)) 
		{
                    
                    $tot_part_paid=$tot_part_paid+$row_listall5['amt'];
                    
                 }
                }
                
            $paid=$paid-$tot_part_paid;
             $trans =$trans-$tot_part_paid;
             
        }else{
            
             $paid=$_REQUEST['paid'];
             $trans =$_REQUEST['trans'];
        }
         
        
      
        if($_REQUEST['mode']=="cash" && ($_REQUEST['bal_partial']>0 || $_REQUEST['paid_partial']>0) )
	{
            $sql1=$database->mysqlQuery("INSERT INTO `tbl_credit_partial_bill`(`tcp_billno`, `tcp_mode`, `tcp_amount`,tcp_date,tcp_login)"
            . " VALUES ('".$billno[$i]."','1','$paid','$date','".$_SESSION['expodine_id']."')");   
           
           
            $sql12=$database->mysqlQuery("delete from tbl_credit_partial_bill where tcp_billno like '%Array%' "); 
            
        }
        
        
        
       
        if($_REQUEST['mode']=="credit" && ($_REQUEST['bal_partial']>0 || $_REQUEST['paid_partial']>0) )
	{
            $sql1=$database->mysqlQuery("INSERT INTO `tbl_credit_partial_bill`(`tcp_billno`, `tcp_mode`, `tcp_amount`,tcp_date,tcp_login)"
            . " VALUES ('".$billno[$i]."','2','$trans','$date','".$_SESSION['expodine_id']."')");   
            
           
            $sql12=$database->mysqlQuery("delete from tbl_credit_partial_bill where tcp_billno like '%Array%' "); 
            
        }
        
        
       
    }
    
    
    if($amountpaid>0 || is_nan($amountpaid)){
        
    }else{
        $amountpaid=0;
    }
    
    if($amount_bal>0 || is_nan($amount_bal)){
        
    }else{
        $amount_bal=0;
    }
    
    
   
   $sql1=$database->mysqlQuery("INSERT INTO `tbl_credit_details_payment`(`cdp_master_id`, `cdp_dayclosedate`, `cdp_paid_cash`, `cdp_transaction_amount`, "
   . " `cdp_balance`,`cdp_login_id`,`cdp_bank`) VALUES"
   . " ('$master','".$_SESSION['date']."','$amountpaid','$transactionamount','$amount_bal','".$_SESSION['login_staff_id_expodine']."','$card_bank')");
	
   
    
   $sql=$database->mysqlQuery("UPDATE tbl_credit_master SET crd_totalamount=0 WHERE crd_totalamount<0 ");
       
   
   $sql=$database->mysqlQuery("delete from  tbl_credit_details  WHERE (cd_billno='' or cd_billno is null) ");
   
     
   $sql=$database->mysqlQuery("delete from tbl_credit_details_payment WHERE (cdp_master_id='' or cdp_master_id is null or cdp_master_id='undefined')");
    
        
          
        require_once("printer_functions.php");
        $printpage=new PrinterCommonSettings();  
        
        $bill_new=$_REQUEST['billno'];
        
        $bill_in='';
       
        for($j=0;$j<=count($bill_new);$j++)
	 {  
           
             $bill_in.=$bill_new[$j].',';
         }
        
     if($_SESSION['s_printst']=='Y'){
        
         $printpage->print_credit_settle($bill_in,$amountpaid,$transactionamount,$_REQUEST['bal_partial']);
    
     }
        

}


else if($_REQUEST['set']=="load_credit_partail") 
{
    
    $tot_pay=0;
    
    $billno= $_REQUEST['ids'];   
    
     for($i=0;$i<count($billno);$i++)
    { 
     
             $sql_listall  =  $database->mysqlQuery("SELECT sum(tcp_amount) as amount from tbl_credit_partial_bill WHERE tcp_billno='$billno[$i]'  "); 
		$num_listall  = $database->mysqlNumRows($sql_listall);
		if($num_listall){
		while($row_listall  = $database->mysqlFetchArray($sql_listall)) 
		{
                                                      
                    $tot_pay=$tot_pay+$row_listall['amount'];
                                                      
                    }
                    }
    }
    
    echo $tot_pay;
    
}
else if($_REQUEST['set']=="load_credit_partail_pays") 
{
    
    $tot=0;
    $sql_listall  =  $database->mysqlQuery("SELECT * from tbl_credit_partial_bill WHERE tcp_billno='".$_REQUEST['billno']."'  "); 
					$num_listall  = $database->mysqlNumRows($sql_listall);
					if($num_listall){
						  while($row_listall  = $database->mysqlFetchArray($sql_listall)) 
							  {
                                              $tot=$tot+$row_listall['tcp_amount'];                                
                                                      
                                              if($row_listall['tcp_mode']=='1'){
                                                  $mode='Cash';
                                              }else{
                                                  $mode='Card';
                                              }       
                                                      
                                            ?>
      
      <span style="padding-left: 3px" > <?=$_SESSION['base_currency']?> <?=$row_listall['tcp_amount']?>  | <?=$row_listall['tcp_date']?> | <?=$row_listall['tcp_login']?> | <?=$mode?></span><br>
           
      <?php } ?>
      
      <span style="margin-top: 9px;padding-left: 3px;font-weight: bold;position: fixed;" > Total Paid : <?=$tot?> </span><br>
         
       <?php
       
       }else{
           
        echo 'NO PAYMENTS FOUND';
          
       }
    
}

?> 