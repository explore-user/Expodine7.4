<?php
//include('includes/session.php');		// Check session
session_start();
include("database.class.php"); // DB Connection class
$database	= new Database(); 
error_reporting(0);
if($_REQUEST['set']=="billwholeload")
{
	$billno=$_REQUEST['billno'];
	?>
	<table width="100%" class=" " border="0"> <!----bill_history_active--->
	<?php
    $sql_bilhis="select bm_billno  from tbl_tablebillmaster WHERE bm_dayclosedate='".$_SESSION['date']."' ORDER BY bm_billdate,bm_billtime DESC";
    $sql_bilhistory  =  $database->mysqlQuery($sql_bilhis); 
    $num_bilhistory  = $database->mysqlNumRows($sql_bilhistory);
    if($num_bilhistory)
    {$i=1;
        while($result_bilhistory  = $database->mysqlFetchArray($sql_bilhistory)) 
            {
                ?>
      <tr class="bill_history_number <?php if($result_bilhistory['bm_billno']==$billno){ ?> bill_history_active <?php } ?> " billno="<?=$result_bilhistory['bm_billno']?>">
        <td width="10%"><strong><?=$i++?></strong></td>
        <td width="41%"><?=$result_bilhistory['bm_billno']?></td>
       </tr>
       <?php } } ?>
       
     </table> 
     <script src="js/bill_history.js"></script>
     <?php
}
else if($_REQUEST['set']=="billdetailsset1")
{
	$billno=$_REQUEST['billno'];
	//`tbl_tablebillmaster`(`bm_billno`, `bm_billdate`, `bm_billtime`, `bm_branchid`, `bm_floorid`, `bm_subtotal`, `bm_cancelamount`, `bm_servicecharge`, `bm_servicetax`, `bm_vat`, `bm_finaltotal`, `bm_paymode`, `bm_discountid`, `bm_corporatecode`, `bm_discountvalue`, `bm_credit`, `bm_creditroom`, `bm_creditstaff`, `bm_complimentary`, `bm_complimentaryremark`, `bm_amountbalace`, `bm_transactionamount`, `bm_amountpaid`, `bm_voucherid`, `bm_couponcompany`, `bm_couponamt`, `bm_chequeno`, `bm_chequebankname`, `bm_chequebankamount`, `bm_dayclosedate`, `bm_billprinted`, `bm_lastprintime`)
	$bm_billno='';
	$bm_dayclosedate='';
	$bm_billtime='';
	$bm_finaltotal='';
	$bm_cancelamount='';
	$bm_billprinted='';
	$bm_lastprintime='';
	$bm_status='';
	$bm_discountvalue='';
	$sql_billhis="select *  from tbl_tablebillmaster WHERE bm_billno='".$billno."'";
	$sql_billhistory  =  $database->mysqlQuery($sql_billhis); 
	$num_billhistory  = $database->mysqlNumRows($sql_billhistory);
	if($num_billhistory)
	{
		while($result_billhistory  = $database->mysqlFetchArray($sql_billhistory)) 
			{
				$bm_billno=$result_billhistory['bm_billno'];
				$bm_dayclosedate=$result_billhistory['bm_dayclosedate'];
				$bm_billtime=$result_billhistory['bm_billtime'];
				$bm_finaltotal=$result_billhistory['bm_finaltotal'];
				$bm_cancelamount=$result_billhistory['bm_cancelamount'];
				$bm_billprinted=$result_billhistory['bm_billprinted'];
				$bm_lastprintime=$result_billhistory['bm_lastprintime'];
				$bm_status=$result_billhistory['bm_status'];
				$bm_discountvalue=$result_billhistory['bm_discountvalue'];
			}
	}
	?>
    <table width="100%" class="" border="0">
      <tr>
        <td width="18%"><strong>No:</strong></td>
        <td width="35%"><?=$bm_billno?></td>
        <td width="18%"><strong>Date:</strong></td>
        <td width="35%"><?=$bm_dayclosedate?></td>
      </tr>
      <tr>
        <td width="18%"><strong>&nbsp;</strong></td>
        <td width="35%">&nbsp;</td>
        <td width="18%"><strong>&nbsp;</strong></td>
        <td width="35%">&nbsp;</td>
      </tr>
       <tr>
        <td width="18%"><strong>Time:</strong></td>
        <td width="35%"><?=$bm_billtime?></td>
        <td width="18%"><strong>Amount:</strong></td>
        <td width="35%"><?=$bm_finaltotal?></td>
      </tr>
       <tr>
        <td width="18%"><strong>&nbsp;</strong></td>
        <td width="35%">&nbsp;</td>
        <td width="18%"><strong>&nbsp;</strong></td>
        <td width="35%">&nbsp;</td>
      </tr>
       <tr>
        <td width="18%"><strong>Cancel:</strong></td>
        <td width="35%"><?=$bm_cancelamount?></td>
        <td width="18%"><strong>Discount:</strong></td>
        <td width="35%"><?=$bm_discountvalue?></td>
      </tr>
       <tr>
        <td width="18%"><strong>&nbsp;</strong></td>
        <td width="35%">&nbsp;</td>
        <td width="18%"><strong>&nbsp;</strong></td>
        <td width="35%">&nbsp;</td>
      </tr>
      <tr>
        <td width="18%"><strong>Printer:</strong></td>
        <td width="35%"><?=$bm_billprinted?></td>
        <td width="18%"><strong>Last Printed:</strong></td>
        <td width="35%"><?=$bm_lastprintime?></td>
      </tr>
       <tr>
        <td width="18%"><strong>&nbsp;</strong></td>
        <td width="35%">&nbsp;</td>
        <td width="18%"><strong>&nbsp;</strong></td>
        <td width="35%">&nbsp;</td>
      </tr>
       <tr>
        <td width="18%"><strong>Status</strong></td>
        <td width="35%"><?=$bm_status?></td>
        <td width="18%"><strong>&nbsp;</strong></td>
        <td width="35%">&nbsp;</td>
      </tr>
      <tr>
        <td width="18%"><strong>&nbsp;</strong></td>
        <td width="35%">&nbsp;</td>
        <td width="18%"><strong>&nbsp;</strong></td>
        <td width="35%">&nbsp;</td>
      </tr>
    </table>
    <?php
	//`tbl_tableorder`(`ter_orderno`, `ter_slno`, `ter_branchid`, `ter_menuid`, `ter_portion`, `ter_rate`, `ter_qty`, `ter_status`, `ter_preference`, `ter_preferencetext`, `ter_orderfrom`, `ter_entrydate`, `ter_entrytime`, `ter_entryuser`, `ter_esttime`, `ter_staff`, `ter_type`, `ter_kotno`, `ter_billnumber`, `ter_cancel`, `ter_feedbackrating`, `ter_feedbackremarks`, `ter_feedbackenter`, `ter_dayclosedate`)
	$ter_orderno='';
	$ter_kotno='';
	$ter_staff='';
	$sql_billhis="select distinct(tor.ter_kotno),ter_orderno,ter_staff  from tbl_tablebillmaster as bm LEFT JOIN tbl_tableorder as tor ON bm.bm_billno=tor.ter_billnumber  WHERE bm_billno='".$billno."'";
	$sql_billhistory  =  $database->mysqlQuery($sql_billhis); 
	$num_billhistory  = $database->mysqlNumRows($sql_billhistory);
	if($num_billhistory)
	{$k=1;
		while($result_billhistory  = $database->mysqlFetchArray($sql_billhistory)) 
			{
				if($k==1)
				{
					$ter_orderno=$result_billhistory['ter_orderno'];
					$ter_kotno=$result_billhistory['ter_kotno'];
					$staff=$database->show_masterstaff_details($result_billhistory['ter_staff']);
					$ter_staff=$staff['ser_firstname']." ".$staff['ser_lastname'];
				}else
				{
					$ter_orderno=$ter_orderno.",".$result_billhistory['ter_orderno'];
					$ter_kotno=$ter_kotno.",".$result_billhistory['ter_kotno'];
					$staff=$database->show_masterstaff_details($result_billhistory['ter_staff']);
					$staffname=$staff['ser_firstname']." ".$staff['ser_lastname'];
					$ter_staff=$ter_staff.",".$staffname;
				}
				$k++;
				
			}
	}
	$orderno='';
	$ord=explode(",",$ter_orderno);
	$orderns=array_unique($ord);
	if(count($orderns)==1)
	{
		$orderno=$ord[0];
	}else
	{
		$orderno=implode(",",$ord);
	}
	
	$stafnames='';
	$staf=explode(",",$ter_staff);
	$stafns=array_unique($staf);
	if(count($stafns)==1)
	{
		$stafnames=$staf[0];
	}else
	{
		$stafnames=implode(",",$staf);
	}
	
	
	?>
    <table width="100%" class="" border="0">
     <tr>
        <td width="18%"><strong>Order No</strong></td>
        <td width="35%"><?=$orderno?></td>
        <td width="18%"><strong>&nbsp;</strong></td>
        <td width="35%">&nbsp;</td>
      </tr>
       <tr>
        <td width="18%"><strong>&nbsp;</strong></td>
        <td width="35%">&nbsp;</td>
        <td width="18%"><strong>&nbsp;</strong></td>
        <td width="35%">&nbsp;</td>
      </tr>
       <tr>
        <td width="18%"><strong>Kot No's</strong></td>
        <td width="35%"><?=$ter_kotno?></td>
        <td width="18%"><strong>&nbsp;</strong></td>
        <td width="35%">&nbsp;</td>
      </tr>
      <tr>
        <td width="18%"><strong>&nbsp;</strong></td>
        <td width="35%">&nbsp;</td>
        <td width="18%"><strong>&nbsp;</strong></td>
        <td width="35%">&nbsp;</td>
      </tr>
       <tr>
        <td width="18%"><strong>Staff name</strong></td>
        <td width="35%"><?=$stafnames?></td>
        <td width="18%"><strong>&nbsp;</strong></td>
        <td width="35%">&nbsp;</td>
      </tr>
    </table>
    <?php
	
	
}else if($_REQUEST['set']=="billdetailsset2")
{
	$billno=$_REQUEST['billno'];
	$total=0;
	 $sql_listall  =  $database->mysqlQuery("SELECT * from tbl_tablebilldetails as td LEFT JOIN tbl_menumaster as mn 	ON td.bd_menuid=mn.mr_menuid LEFT JOIN tbl_portionmaster as pm ON td.bd_portion=pm.pm_id WHERE td.bd_billno='".$billno."' order by td.bd_billslno "); 
	$num_listall  = $database->mysqlNumRows($sql_listall);
	if($num_listall){$i=1;
		  while($row_listall  = $database->mysqlFetchArray($sql_listall)) 
			  {
				 $total=$total + $row_listall['bd_amount'];
				 ?>
                 <div class="right_bill_history_detail">
                    <div class="bil_his_sl_no"><a class="canceleachitem" billno="<?=$billno ?>" slno="<?=$row_listall['bd_billslno'] ?>" style="cursor:pointer">X</a><?=$i++;?></div>
                    <div class="bil_his_dish_name"><?=$row_listall['mr_menuname'] ?></div>
                    <div class="bil_his_sl_no"><?=$row_listall['pm_portionname'] ?></div>
                    <div class="bil_his_sl_no"><?=$row_listall['bd_qty'] ?></div>
                    <div class="bil_his_sl_no"><?=number_format($row_listall['bd_rate'],$_SESSION['be_decimal'])?></div>
                    
                </div><!--right_bill_history_detail-->
                 <?php
			  }
	}
}else if($_REQUEST['set']=="set_cancel")
{
	$billno=$_REQUEST['billno'];
	$sql_listall  =  $database->mysqlQuery("Update tbl_tablebillmaster set bm_status='Cancelled' Where bm_billno='".$billno."'"); 
	//echo "Update tbl_tablebillmaster set bm_status='Cancelled' Where bm_billno='".$billno."'";
}
?>
