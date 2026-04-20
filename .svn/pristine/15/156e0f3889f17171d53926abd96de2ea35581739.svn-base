<?php
//include('includes/session.php');		// Check session
 include("database.class.php"); // DB Connection class
$database	= new Database(); 		// Create a new instance
$branchname='';
//session_start();
 $sql_branch =  $database->mysqlQuery("Select be_branchname,be_address,be_email,be_phone,be_others1,be_others2,be_others3,be_footer1,be_footer2,be_footer3,be_footer4 from tbl_branchmaster where be_branchid='".$_SESSION['branchofid']."'"); 
		  $num_branch  = $database->mysqlNumRows($sql_branch);
		  if($num_branch)
		  {
				while($result_branch  = $database->mysqlFetchArray($sql_branch)) 
					{
						 $branchname=$result_branch['be_branchname'];
						
					}
		  }


?>


<page backtop="10mm" backbottom="10mm" backleft="10mm" backright="10mm" >
<!--<table style="text-align: center;  background: #60497b;height:100px; width: 100%" align="center">
    <tr>
        <td style="width: 50%"><img src="images/since_pdf.jpg" alt="Since" width="50" /></td>
        <td style="width: 50%"><img src="images/logo_head.jpg" alt="Logo" width="150" /></td>
    </tr>
</table>-->
<br />
 <?php if($_REQUEST['type']=="tot_sales") { 
 
 $servicetax_stats='N';
	 $sql_login  =  $database->mysqlQuery("SELECT * FROM `tbl_floormaster` WHERE `fr_status`='Active' AND `fr_servicetax`<>''"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		 $servicetax_stats='Y';
	  }
 ?> 
    <table style="width: 100%; margin-bottom:50px; " align="center">
    <tr>
            <td style="width: 100%;height:40px; text-align: center;margin-bottom:50px; font-weight:bold ;background: #900;color:#FFF; font-size:20px;"><?=$branchname?></td>
        </tr>
        <tr>
            <td style="width: 100%;height:40px; text-align: center;margin-bottom:50px; font-weight:bold ;background: #900;color:#FFF; font-size:20px;">Total sales Report</td>
        </tr>
        
    </table>
 <table cellspacing="0" style="width: 100%; font-size:9px; " align="center" cellpadding="0"  >
    <col style="width: 10%" class="col1">
    <col style="width: 5%">
    <col style="width: 10%">
    <col style="width: 10%">
    <col style="width: 10%">
    <col style="width: 10%">
    <col style="width: 10%">
    <col style="width: 10%">
    <col style="width: 10%">
    <col style="width: 10%">
    <tr >
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Sl no</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Date</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Bill no</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Table</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Sub Total</td>
    <?php if($servicetax_stats=='Y'){ ?><td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Service Tax</td><?php } ?>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Discount</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Final</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Paid</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Balance</td>
  </tr>
  <?php
  $string=" bm_status='Closed' AND ";
   if($_SESSION['fromdt']!="" && $_SESSION['todt']!="")
		{
			$from=$database->convert_date($_SESSION['fromdt']);
			$to=$database->convert_date($_SESSION['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_SESSION['fromdt']!="" && $_SESSION['todt']=="")
		{
			$from=$database->convert_date($_SESSION['fromdt']);
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['from']=="" && $_REQUEST['to']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_SESSION['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
		}
	
	else
	{
		/*$cur=date("Y-m-d");
		$string=" bm_dayclosedate='".$cur."'";*/
		
		
	//$bydate=$_REQUEST['hidbydate'];
	
		$bydatz=$_REQUEST['hidbydate'];
		
		
		
			if($bydatz!="null")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($bydatz=="Last10days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last25days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last30days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	
	else if($bydatz=="Today")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.="bm_dayclosedate =  CURDATE() - INTERVAL 1 day";
			  }
			   else if($bydatz=="Last1month")
			  {
				  $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
	
	
else if($bydatz=="Last90days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last180days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last365days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}

	}
	else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "bm_dayclosedate between '".$from."' and '".$to."' ";
	}
		
	
	
	
	
	
		
		/*$cur=date("Y-m-d");
		$string=" bm_dayclosedate='".$cur."'";*/
	
		
		
		
	}
	
	
  $final=0;
  $paid=0;
  $bal=0;
  $dsc=0;
  $srvtx=0;
  $subtotal=0;
       $cur=date("Y-m-d");
 	  $sql_login  =  $database->mysqlQuery("select * from tbl_tablebillmaster where $string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{// bm_finaltotal  bm_amountpaid bm_amountbalace
			$final=$final + $result_login['bm_finaltotal'];
			$paid=$paid +$result_login['bm_amountpaid'];
			$bal=$bal + $result_login['bm_amountbalace'];
			$dsc=$dsc + $result_login['bm_discountvalue'];
			$srvtx=$srvtx + $result_login['bm_servicetax'];
			$subtotal=$subtotal + $result_login['bm_subtotal'];
			
	 ?>
  <tr class="main" style="width:100px">
    <td style=" border: solid 1px #CCC;padding:3px;"><?=$i?></td>
    <td style=" border: solid 1px #CCC;padding:3px;"><?=$database->convert_date($result_login['bm_dayclosedate'])?> </td>
    <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['bm_billno']?> </td>
    <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['bm_tableno']?> </td>
    <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['bm_subtotal']?></td>
    <?php if($servicetax_stats=='Y'){ ?><td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['bm_servicetax']?></td><?php } ?>
    <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['bm_discountvalue']?></td>
    <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['bm_finaltotal']?></td>
    <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['bm_amountpaid']?></td>
    <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['bm_amountbalace']?></td>
  </tr>
  <?php $i++;} } ?> 
  <!-- -------------------------------------- footer starts --------------------------------- -->
  <tr>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
      <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
    <?php if($servicetax_stats=='Y'){ ?><td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td><?php } ?>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
     <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
      <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
  </tr>
  <tr class="main">
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;">TOTAL</td>
    <td style=" border: solid 1px #CCC;padding:3px;"></td>
      <td style=" border: solid 1px #CCC;padding:3px;"></td>
     <td style=" border: solid 1px #CCC;padding:3px;"></td>
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;"><?=$subtotal?></td>
    <?php if($servicetax_stats=='Y'){ ?><td style="font-weight:bold; border: solid 1px #CCC;padding:3px;"><?=$srvtx?></td><?php } ?>
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;"><?=$dsc?></td>
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;"><?=$final?></td>
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;"><?=$paid?></td>
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;"><?=$bal?></td>
  </tr>

  <!-- -------------------------------------- footer ends --------------------------------- -->
</table> 
 <?php }else if($_REQUEST['type']=="summary") { 
 if(isset($_REQUEST['from']))
 {
	 $_SESSION['fromdt']=$_REQUEST['from'];
 }
 if(isset($_REQUEST['to']))
 {
	 $_SESSION['todt']=$_REQUEST['to'];
 }
  if(isset($_REQUEST['hidbydate']))
 {
	 $_SESSION['hidbydate']=$_REQUEST['hidbydate'];
 }
 $reporthead='';
 $servicetax_stats='N';
	 $sql_login  =  $database->mysqlQuery("SELECT * FROM `tbl_floormaster` WHERE `fr_status`='Active' AND `fr_servicetax`<>''"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		 $servicetax_stats='Y';
	  }
 ?> 
    <table style="width: 100%; margin-bottom:50px; " align="center">
    <tr>
            <td style="width: 100%;height:40px; text-align: center;margin-bottom:50px; font-weight:bold ;background: #900;color:#FFF; font-size:20px;"><?=$branchname?></td>
        </tr>
        <tr>
            <td style="width: 100%;height:40px; text-align: center;margin-bottom:50px; font-weight:bold ;background: #900;color:#FFF; font-size:20px;">Summary</td>
        </tr>
        
    </table>
 <table cellspacing="0" style="width: 100%; font-size:9px; " align="center" cellpadding="0"  >
    <col style="width: 50%" class="col1">
    <col style="width: 50%">
  
   
  <?php
  
  $string='';
  $reporthead="";
	$strings=" bm_status='Closed' AND ";
	$string1_str=" (sum(bm_amountpaid) - sum(bm_amountbalace)) ";
	$string2_str=" sum(bm_transactionamount) ";
	$string3_str=" sum(bm_finaltotal) ";
	$string4_str=" sum(bm_finaltotal) ";
	$string5_str=" sum(bm_finaltotal) ";
	
	
	$string1 =$strings. " ";//"cash"//(bm_transactionamount ='' or bm_transactionamount IS NULL) and (bm_couponcompany ='' or bm_couponcompany IS NULL) and bm_voucherid IS NULL and bm_couponamt ='0.00' and  (bm_chequeno ='' or bm_chequeno IS NULL) and (bm_chequebankname='' or bm_chequebankname IS NULL)
		$string2 =$strings. " ";//"credit"  bm_transactionamount <>''
		$string3 =$strings. " bm_paymode='coupon'  AND";//"coupons"  bm_couponcompany <>''  and bm_couponamt <>'0.00'
		$string4 =$strings. " bm_paymode='voucher' AND";//"voucher" bm_voucherid <>''
		$string5 =$strings. " bm_paymode='cheque' AND";//"cheque" bm_chequeno <>'' and bm_chequebankname<>''
	

   if($_SESSION['fromdt']!="" && $_SESSION['todt']!="")
		{
			$from=$database->convert_date($_SESSION['fromdt']);
			$to=$database->convert_date($_SESSION['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to) ; 
		}
		else if($_SESSION['fromdt']!="" && $_SESSION['todt']=="")
		{
			$from=$database->convert_date($_SESSION['fromdt']);
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to) ; 
		}
		else if($_SESSION['fromdt']=="" && $_SESSION['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_SESSION['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to) ; 
		}
	
	else
	{
		$bydatz=$_SESSION['hidbydate'];
		$st='';
			if($bydatz!="null")
			{
		//$search="";
				  if($bydatz=="Last5days")
				  {
					  $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
					  $st= " Last 5 days ";
				  }elseif($bydatz=="Last10days")
				  {
					  $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
					  $st= " Last 10 days ";
				  }
				  elseif($bydatz=="Last15days")
				  {
					  $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
					  $st= " Last 15 days ";
				  }
				  else if($bydatz=="Last20days")
				  {
					  $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
					  $st= " Last 20 days ";
				  }
				  else if($bydatz=="Last25days")
				  {
					  $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
					  $st= " Last 25 days ";
				  }
				  else if($bydatz=="Last30days")
				  {
					  $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
					  $st= " Last 30 days ";
				  }
				  else if($bydatz=="Today")
				  {
					  $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
					  $st= " Today ";
				  }
				  else if($bydatz=="Yesterday")
				  {
					  $string.=" bm_dayclosedate =  CURDATE() - INTERVAL 1 day";
					  $st= "  Yesterday ";
				  }
				   else if($bydatz=="Last1month")
				  {
					  $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
					  $st= " Last 1 month ";
				  }
				  else if($bydatz=="Last90days")
				  {
					  $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
					  $st= " Last 3 months ";
				  }
				  else if($bydatz=="Last180days")
				  {
					  $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
					  $st= " Last 6 months ";
				  }
				  else if($bydatz=="Last365days")
				  {
					  $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
					  $st= " Last 1 Year "; 
				  }
				$reporthead=$st;
			}
			else
			{
			$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
			}
	}
	?>
      <tr >
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold; text-align:center;font-size:15px" colspan="2">Report - <?=$reporthead?></td>
  </tr>
  <tr >
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold; text-align:center; font-size:12px" >Type</td>
     <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold; text-align:center;font-size:12px" >Value</td>
  </tr>
  <?php
	
  $final=0;
  $paid=0;
  $bal=0;
  $dsc=0;
  $srvtx=0;
  $subtotal=0;
       $cur=date("Y-m-d");
	// echo "select $string1_str as tot from tbl_tablebillmaster where $string1"."$string order by bm_dayclosedate,bm_billtime ASC";
 	  $sql_login  =  $database->mysqlQuery("select $string1_str as tot from tbl_tablebillmaster where $string1"."$string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$subtotal =$subtotal + $result_login['tot'];
	 ?>
  <tr class="main" style="width:100px">
    <td style=" border: solid 1px #CCC;padding:3px;">Cash</td>
    <td style=" border: solid 1px #CCC;padding:3px;"><?=round($result_login['tot'])?> </td>
    
  </tr>
  <?php } }
  
  
  
  $sql_login  =  $database->mysqlQuery("select $string2_str as tot from tbl_tablebillmaster where $string2"."$string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$subtotal =$subtotal + $result_login['tot'];
	 ?>
  <tr class="main" style="width:100px">
    <td style=" border: solid 1px #CCC;padding:3px;">Credit</td>
    <td style=" border: solid 1px #CCC;padding:3px;"><?=round($result_login['tot'])?> </td>
    
  </tr>
  <?php } }
  
  $sql_login  =  $database->mysqlQuery("select $string3_str as tot from tbl_tablebillmaster where $string3"."$string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$subtotal =$subtotal + $result_login['tot'];
	 ?>
  <tr class="main" style="width:100px">
    <td style=" border: solid 1px #CCC;padding:3px;">Coupons</td>
    <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['tot']?> </td>
    
  </tr>
  <?php } }
  
  $sql_login  =  $database->mysqlQuery("select $string4_str as tot from tbl_tablebillmaster where $string4"."$string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$subtotal =$subtotal + $result_login['tot'];
	 ?>
  <tr class="main" style="width:100px">
    <td style=" border: solid 1px #CCC;padding:3px;">Voucher</td>
    <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['tot']?> </td>
    
  </tr>
  <?php } }
  
  $sql_login  =  $database->mysqlQuery("select $string5_str as tot from tbl_tablebillmaster where $string5"."$string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$subtotal =$subtotal + $result_login['tot'];
	 ?>
  <tr class="main" style="width:100px">
    <td style=" border: solid 1px #CCC;padding:3px;">Cheque</td>
    <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['tot']?> </td>
    
  </tr>
  <?php } }
  
   ?> 
  <!-- -------------------------------------- footer starts --------------------------------- -->
  <tr>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
    
  </tr>
  <tr class="main">
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;">TOTAL</td>
    <td style=" border: solid 1px #CCC;padding:3px;"><?=$subtotal?></td>
    
  </tr>

  <!-- -------------------------------------- footer ends --------------------------------- -->
</table> 
 <?php }else if($_REQUEST['type']=="kot_report") { ?> 
    <table style="width: 100%; margin-bottom:50px; " align="center">
    <tr>
            <td style="width: 100%;height:40px; text-align: center;margin-bottom:50px; font-weight:bold ;background: #900;color:#FFF; font-size:20px;"><?=$branchname?></td>
        </tr>
        <tr>
            <td style="width: 100%;height:40px; text-align: center;margin-bottom:50px; font-weight:bold ;background: #900;color:#FFF; font-size:20px;">KOT Report</td>
        </tr>
        
    </table>
 <table cellspacing="0" style="width: 100%; font-size:9px; " align="center" cellpadding="0"  >
    <col style="width: 10%" class="col1">
    <col style="width: 15%">
    <col style="width: 30%">
    <col style="width: 20%">
    <col style="width: 10%">
    <col style="width: 15%">
    <tr >
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Sl No</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Date</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">KOT No</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Items</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Quantity</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Rate</td>
   
  </tr>
  <?php
  $string=" tor.ter_status='Closed' AND ";
   if($_SESSION['fromdt']!="" && $_SESSION['todt']!="")
		{
			$from=$database->convert_date($_SESSION['fromdt']);
			$to=$database->convert_date($_SESSION['todt']);
			$string.= " tor.ter_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_SESSION['fromdt']!="" && $_SESSION['todt']=="")
		{
			$from=$database->convert_date($_SESSION['fromdt']);
			$to=date("Y-m-d");
			$string.= " tor.ter_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['from']=="" && $_REQUEST['to']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_SESSION['todt']);
			$string.= " tor.ter_dayclosedate between '".$from."' and '".$to."' ";
		}
	
	else
	{
		/*$cur=date("Y-m-d");
		$string=" bm_dayclosedate='".$cur."'";*/
		
		
	//$bydate=$_REQUEST['hidbydate'];
	
		$bydatz=$_REQUEST['hidbydate'];
		
		
		
			if($bydatz!="null")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.="tor.ter_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($bydatz=="Last10days")
	{
		$string.="tor.ter_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" tor.ter_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" tor.ter_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last25days")
	{
		$string.="tor.ter_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last30days")
	{
		$string.="tor.ter_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	
	else if($bydatz=="Today")
	{
		$string.="tor.ter_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.="tor.ter_dayclosedate =  CURDATE() - INTERVAL 1 day";
			  }
			   else if($bydatz=="Last1month")
			  {
				  $string.="tor.ter_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
	
	
else if($bydatz=="Last90days")
	{
		$string.="tor.ter_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last180days")
	{
		$string.="tor.ter_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last365days")
	{
		$string.="tor.ter_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}

	}
	else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "tor.ter_dayclosedate between '".$from."' and '".$to."' ";
	}
		
	
	
	
	
	
		
		/*$cur=date("Y-m-d");
		$string=" bm_dayclosedate='".$cur."'";*/
	
		
		
		
	}
  $final=0;$old='';$new='';
       $cur=date("Y-m-d");
 	  $sql_login  =  $database->mysqlQuery("select tor.ter_kotno,tor.ter_dayclosedate,mm.mr_menuname,(tor.ter_rate * tor.ter_qty) as rate,tor.ter_qty from tbl_tableorder as tor LEFT JOIN tbl_menumaster as mm ON tor.ter_menuid=mm.mr_menuid where $string order by tor.ter_dayclosedate,tor.ter_entrytime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1;$k=1;$each=0;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{// bm_finaltotal  bm_amountpaid bm_amountbalace
			$final=$final + $result_login['rate'];
			if($i==1)
				{
					$each=$each + $result_login['rate'];
					$old=$result_login['ter_kotno'];
					$new=$result_login['ter_kotno'];
					?>
                     <tr class="main" style="width:100px">
                      <td style=" border: solid 1px #CCC;padding:3px;"><?=$k++?></td>
                      <td style=" border: solid 1px #CCC;padding:3px;"><?=$database->convert_date($result_login['ter_dayclosedate'])?> </td>
                      <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['ter_kotno']?> </td>
                      <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['mr_menuname']?> </td>
                      <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['ter_qty']?> </td>
                      <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['rate']?></td>
                    </tr>
                  <?php
				  
				}else
				{
					$old=$new;
					$new=$result_login['ter_kotno'];
					if($new==$old)
					{$each=$each + $result_login['rate'];
						?>
                      <tr class="main" style="width:100px">
                        <td style=" border: solid 1px #CCC;padding:3px;"></td>
                        <td style=" border: solid 1px #CCC;padding:3px;"></td>
                        <td style=" border: solid 1px #CCC;padding:3px;"></td>
                        <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['mr_menuname']?> </td>
                        <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['ter_qty']?> </td>
                        <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['rate']?></td>
                      </tr>
                      <?php
					}else
					{
						?>
                          <tr class="main" style="width:100px">
                      <td style=" border: solid 1px #CCC;padding:3px;"></td>
                      <td style=" border: solid 1px #CCC;padding:3px;"></td>
                      <td style=" border: solid 1px #CCC;padding:3px;"></td>
                      <td style=" border: solid 1px #CCC;padding:3px;">Total</td>
                      <td style=" border: solid 1px #CCC;padding:3px;"></td>
                      <td style=" border: solid 1px #CCC;padding:3px;"><?=$each?></td>
                    </tr>
                  <?php $each=0;
				  $each=$each + $result_login['rate'];
				   ?>
                     <tr class="main" style="width:100px">
                      <td style=" border: solid 1px #CCC;padding:3px;"><?=$k++?></td>
                      <td style=" border: solid 1px #CCC;padding:3px;"><?=$database->convert_date($result_login['ter_dayclosedate'])?> </td>
                      <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['ter_kotno']?> </td>
                      <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['mr_menuname']?> </td>
                      <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['ter_qty']?> </td>
                      <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['rate']?></td>
                    </tr>
                  <?php
					}
				}
			
	 ?>
 
  <?php $i++;} 
  ?>
                          <tr class="main" style="width:100px">
                      <td style=" border: solid 1px #CCC;padding:3px;"></td>
                      <td style=" border: solid 1px #CCC;padding:3px;"></td>
                      <td style=" border: solid 1px #CCC;padding:3px;"></td>
                      <td style=" border: solid 1px #CCC;padding:3px;">Total</td>
                      <td style=" border: solid 1px #CCC;padding:3px;"></td>
                      <td style=" border: solid 1px #CCC;padding:3px;"><?=$each?></td>
                    </tr>
                  <?php
  } ?> 
  <!-- -------------------------------------- footer starts --------------------------------- -->
  <tr>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
  </tr>
  <tr class="main">
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;">TOTAL</td>
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;"></td>
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;"></td>
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;"></td>
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;"></td>
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;"><?=$final?></td>
  </tr>

  <!-- -------------------------------------- footer ends --------------------------------- -->
</table> 
 <?php }else if($_REQUEST['type']=="bill_details") { ?> 
    <table style="width: 100%; margin-bottom:50px; " align="center">
    <tr>
            <td style="width: 100%;height:40px; text-align: center;margin-bottom:50px; font-weight:bold ;background: #900;color:#FFF; font-size:20px;"><?=$branchname?></td>
        </tr>
        <tr>
            <td style="width: 100%;height:40px; text-align: center;margin-bottom:50px; font-weight:bold ;background: #900;color:#FFF; font-size:20px;">Bill Report</td>
        </tr>
        
    </table>
 <table cellspacing="0" style="width: 100%; font-size:9px; " align="center" cellpadding="0"  >
    <col style="width: 10%" class="col1">
    <col style="width: 10%">
    <col style="width: 10%">
    <col style="width: 40%">
     <col style="width: 10%">
    <col style="width: 10%">
     <col style="width: 10%">
    <tr >
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Sl No</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Date</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Bill No</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Items</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Quantity</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Rate</td>
   <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Discount</td>
  </tr>
  <?php
  $string=" bm.bm_status='Closed' AND ";
   if($_SESSION['fromdt']!="" && $_SESSION['todt']!="")
		{
			$from=$database->convert_date($_SESSION['fromdt']);
			$to=$database->convert_date($_SESSION['todt']);
			$string.= " bm.bm_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_SESSION['fromdt']!="" && $_SESSION['todt']=="")
		{
			$from=$database->convert_date($_SESSION['fromdt']);
			$to=date("Y-m-d");
			$string.= " bm.bm_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['from']=="" && $_REQUEST['to']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_SESSION['todt']);
			$string.= " bm.bm_dayclosedate between '".$from."' and '".$to."' ";
		}
	
	else
	{
		/*$cur=date("Y-m-d");
		$string=" bm_dayclosedate='".$cur."'";*/
		
		
	//$bydate=$_REQUEST['hidbydate'];
	
		$bydatz=$_REQUEST['hidbydate'];
		
		
		
			if($bydatz!="null")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($bydatz=="Last10days")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" bm.bm_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" bm.bm_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last25days")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last30days")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	
	else if($bydatz=="Today")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.="bm.bm_dayclosedate=  CURDATE() - INTERVAL 1 day";
			  }
			   else if($bydatz=="Last1month")
			  {
				  $string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
	
	
else if($bydatz=="Last90days")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last180days")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last365days")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}

	}
	else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "bm.bm_dayclosedate between '".$from."' and '".$to."' ";
	}
		
	
	
	
	
	
		
		/*$cur=date("Y-m-d");
		$string=" bm_dayclosedate='".$cur."'";*/
	
		
		
		
	}
  $final=0;$old='';$new='';
  $dsc=0;
 $dscfinal=0;
       $cur=date("Y-m-d");
 	  $sql_login  =  $database->mysqlQuery("SELECT td.bd_billno,bm.bm_dayclosedate,mn.mr_menuname,td.bd_rate,td.bd_qty,pm.pm_portionname,bm.bm_discountvalue from tbl_tablebilldetails as td LEFT JOIN tbl_menumaster as mn ON td.bd_menuid=mn.mr_menuid LEFT JOIN tbl_portionmaster as pm ON td.bd_portion=pm.pm_id LEFT JOIN tbl_tablebillmaster as bm ON bm.bm_billno=td.bd_billno where $string order by bm.bm_dayclosedate,bm.bm_billtime"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1;$k=1;$each=0;$dsc=0;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{// bm_finaltotal  bm_amountpaid bm_amountbalace
			$final=$final + ($result_login['bd_rate'] * $result_login['bd_qty']);
			if($i==1)
				{
					$dscfinal=$dscfinal+($result_login['bm_discountvalue']);
					$dsc=$dsc + ($result_login['bm_discountvalue']);
					$each=$each + ($result_login['bd_rate'] * $result_login['bd_qty']);
					$old=$result_login['bd_billno'];
					$new=$result_login['bd_billno'];
					?>
                     <tr class="main" style="width:100px">
                      <td style=" border: solid 1px #CCC;padding:3px;"><?=$k++?></td>
                      <td style=" border: solid 1px #CCC;padding:3px;"><?=$database->convert_date($result_login['bm_dayclosedate'])?> </td>
                      <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['bd_billno']?> </td>
                      <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['mr_menuname']?> </td>
                      <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['bd_qty']?></td>
                      <td style=" border: solid 1px #CCC;padding:3px;"><?=($result_login['bd_rate'] * $result_login['bd_qty'])?></td>
                      <td style=" border: solid 1px #CCC;padding:3px;"></td>
                    </tr>
                  <?php
				  
				}else
				{
					$old=$new;
					$new=$result_login['bd_billno'];
					if($new==$old)
					{$each=$each + ($result_login['bd_rate'] * $result_login['bd_qty']);
						?>
                      <tr class="main" style="width:100px">
                        <td style=" border: solid 1px #CCC;padding:3px;"></td>
                        <td style=" border: solid 1px #CCC;padding:3px;"></td>
                        <td style=" border: solid 1px #CCC;padding:3px;"></td>
                        <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['mr_menuname']?> </td>
                        <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['bd_qty']?></td>
                        <td style=" border: solid 1px #CCC;padding:3px;"><?=($result_login['bd_rate'] * $result_login['bd_qty'])?></td>
                        <td style=" border: solid 1px #CCC;padding:3px;"></td>
                      </tr>
                      <?php
					}else
					{
						?>
                          <tr class="main" style="width:100px">
                      <td style=" border: solid 1px #CCC;padding:3px;"></td>
                      <td style=" border: solid 1px #CCC;padding:3px;"></td>
                      <td style=" border: solid 1px #CCC;padding:3px;"></td>
                      <td style=" border: solid 1px #CCC;padding:3px;">Total</td>
                      <td style=" border: solid 1px #CCC;padding:3px;"></td>
                      <td style=" border: solid 1px #CCC;padding:3px;"><?=$each?></td>
                      <td style=" border: solid 1px #CCC;padding:3px;"><?=$dsc?></td>
                    </tr>
                  <?php $each=0;$dsc=0;
				  $each=$each + ($result_login['bd_rate'] * $result_login['bd_qty']);
				  $dsc=$dsc + ($result_login['bm_discountvalue']);
				  $dscfinal=$dscfinal+($result_login['bm_discountvalue']);
				  
				   ?>
                     <tr class="main" style="width:100px">
                      <td style=" border: solid 1px #CCC;padding:3px;"><?=$k++?></td>
                      <td style=" border: solid 1px #CCC;padding:3px;"><?=$database->convert_date($result_login['bm_dayclosedate'])?> </td>
                      <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['bd_billno']?> </td>
                      <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['mr_menuname']?> </td>
                      <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['bd_qty']?></td>
                      <td style=" border: solid 1px #CCC;padding:3px;"><?=($result_login['bd_rate'] * $result_login['bd_qty'])?></td>
                       <td style=" border: solid 1px #CCC;padding:3px;"></td>
                    </tr>
                  <?php
					}
				}
			
	 ?>
 
  <?php $i++;} 
  ?>
                          <tr class="main" style="width:100px">
                      <td style=" border: solid 1px #CCC;padding:3px;"></td>
                      <td style=" border: solid 1px #CCC;padding:3px;"></td>
                      <td style=" border: solid 1px #CCC;padding:3px;"></td>
                      <td style=" border: solid 1px #CCC;padding:3px;">Total</td>
                      <td style=" border: solid 1px #CCC;padding:3px;"></td>
                      <td style=" border: solid 1px #CCC;padding:3px;"><?=$each?></td>
                      <td style=" border: solid 1px #CCC;padding:3px;"><?=$dsc?></td>
                    </tr>
                  <?php
  } ?> 
  <!-- -------------------------------------- footer starts --------------------------------- -->
  <tr>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
     <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
  </tr>
  <tr class="main">
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;"></td>
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;"></td>
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;">TOTAL</td>
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;"></td>
     <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;"><?=$final?></td>
     <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;"><?=$dscfinal?></td>
  </tr>
  
   <tr class="main">
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;"></td>
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;"></td>
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;">GRAND TOTAL</td>
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;"></td>
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;"></td>
     <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;"><?=($final-$dscfinal)?></td>
     <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
  </tr>

  <!-- -------------------------------------- footer ends --------------------------------- -->
</table> 
 <?php }else if($_REQUEST['type']=="discount_report") { ?> 
    <table style="width: 100%; margin-bottom:50px; " align="center">
    <tr>
            <td style="width: 100%;height:40px; text-align: center;margin-bottom:50px; font-weight:bold ;background: #900;color:#FFF; font-size:20px;"><?=$branchname?></td>
        </tr>
        <tr>
            <td style="width: 100%;height:40px; text-align: center;margin-bottom:50px; font-weight:bold ;background: #900;color:#FFF; font-size:20px;">Discount Report</td>
        </tr>
        
    </table>
 <table cellspacing="0" style="width: 100%; font-size:9px; " align="center" cellpadding="0"  >
    <col style="width: 10%" class="col1">
    <col style="width: 10%">
    <col style="width: 10%">
    <col style="width: 15%">
    <col style="width: 10%">
    <col style="width: 15%">
    <col style="width: 10%">
    <col style="width: 15%">
    <tr >
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Sl no</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Date</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Bill no</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Sub Total</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Discount</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Final</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Paid</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Balance</td>
  </tr>
  <?php
  $string=" bm_status='Closed' AND bm_discountvalue<>'0.00' AND  ";
   if($_SESSION['fromdt']!="" && $_SESSION['todt']!="")
		{
			$from=$database->convert_date($_SESSION['fromdt']);
			$to=$database->convert_date($_SESSION['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_SESSION['fromdt']!="" && $_SESSION['todt']=="")
		{
			$from=$database->convert_date($_SESSION['fromdt']);
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['from']=="" && $_REQUEST['to']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_SESSION['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
		}
	
	else
	{
		/*$cur=date("Y-m-d");
		$string=" bm_dayclosedate='".$cur."'";*/
		
		
	//$bydate=$_REQUEST['hidbydate'];
	
		$bydatz=$_REQUEST['hidbydate'];
		
		
		
			if($bydatz!="null")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($bydatz=="Last10days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last25days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last30days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	
	else if($bydatz=="Today")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.="bm_dayclosedate =  CURDATE() - INTERVAL 1 day";
			  }
			   else if($bydatz=="Last1month")
			  {
				  $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
	
	
else if($bydatz=="Last90days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last180days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last365days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}

	}
	else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "bm_dayclosedate between '".$from."' and '".$to."' ";
	}
		
	
	
	
	
	
		
		/*$cur=date("Y-m-d");
		$string=" bm_dayclosedate='".$cur."'";*/
	
		
		
		
	}
  $final=0;
  $paid=0;
  $bal=0;
       $cur=date("Y-m-d");
 	  $sql_login  =  $database->mysqlQuery("select * from tbl_tablebillmaster where $string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{// bm_finaltotal  bm_amountpaid bm_amountbalace
			$final=$final + $result_login['bm_finaltotal'];
			$paid=$paid +$result_login['bm_amountpaid'];
			$bal=$bal + $result_login['bm_amountbalace'];
			
	 ?>
  <tr class="main" style="width:100px">
    <td style=" border: solid 1px #CCC;padding:3px;"><?=$i?></td>
    <td style=" border: solid 1px #CCC;padding:3px;"><?=$database->convert_date($result_login['bm_dayclosedate'])?> </td>
    <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['bm_billno']?> </td>
    <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['bm_subtotal']?></td>
    <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['bm_discountvalue']?></td>
    <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['bm_finaltotal']?></td>
    <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['bm_amountpaid']?></td>
    <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['bm_amountbalace']?></td>
  </tr>
  <?php $i++;} } ?> 
  <!-- -------------------------------------- footer starts --------------------------------- -->
  <tr>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
     <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
  </tr>
  <tr class="main">
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;">TOTAL</td>
    <td style=" border: solid 1px #CCC;padding:3px;"></td>
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;"></td>
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;"></td>
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;"></td>
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;"><?=$final?></td>
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;"><?=$paid?></td>
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;"><?=$bal?></td>
  </tr>

  <!-- -------------------------------------- footer ends --------------------------------- -->
</table> 
 <?php }else if($_REQUEST['type']=="bill_cancel") { ?> 
    <table style="width: 100%; margin-bottom:50px; " align="center">
    <tr>
            <td style="width: 100%;height:40px; text-align: center;margin-bottom:50px; font-weight:bold ;background: #900;color:#FFF; font-size:20px;"><?=$branchname?></td>
        </tr>
        <tr>
            <td style="width: 100%;height:40px; text-align: center;margin-bottom:50px; font-weight:bold ;background: #900;color:#FFF; font-size:20px;">Bill Cancel Report</td>
        </tr>
        
    </table>
 <table cellspacing="0" style="width: 100%; font-size:9px; " align="center" cellpadding="0"  >
    <col style="width: 10%" class="col1">
    <col style="width: 10%">
    <col style="width: 20%">
    <col style="width: 20%">
    <col style="width: 20%">
    <col style="width: 20%">
    <tr >
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold; width:5px;">Sl no</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold; width:12px;">Date</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold; width:12px;">Bill no</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Reason</td> 
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold; width:12;">Final</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold; width:12px;">Paid</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold; width:12px;">Balance</td>
  </tr>
  <?php
  $string=" bm_status='Cancelled' AND ";
   if($_SESSION['fromdt']!="" && $_SESSION['todt']!="")
		{
			$from=$database->convert_date($_SESSION['fromdt']);
			$to=$database->convert_date($_SESSION['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
		}
		else if($_SESSION['fromdt']!="" && $_SESSION['todt']=="")
		{
			$from=$database->convert_date($_SESSION['fromdt']);
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
		}
		else if($_REQUEST['from']=="" && $_REQUEST['to']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_SESSION['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
		}
	
	else
	{
		/*$cur=date("Y-m-d");
		$string=" bm_dayclosedate='".$cur."'";*/
		
		
	//$bydate=$_REQUEST['hidbydate'];
	
		$bydatz=$_REQUEST['hidbydate'];
		
		
		
			if($bydatz!="null")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($bydatz=="Last10days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last25days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last30days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	
	else if($bydatz=="Today")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.="bm_dayclosedate =  CURDATE() - INTERVAL 1 day";
			  }
			   else if($bydatz=="Last1month")
			  {
				  $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
	
	
else if($bydatz=="Last90days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last180days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last365days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}

	}
	else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "bm_dayclosedate between '".$from."' and '".$to."' ";
	}
		
	
	
	
	
	
		
		/*$cur=date("Y-m-d");
		$string=" bm_dayclosedate='".$cur."'";*/
	
		
		
		
	}
  $final=0;
  $paid=0;
  $bal=0;

       $cur=date("Y-m-d");
// 	  $sql_login  =  $database->mysqlQuery("select * from tbl_tablebillmaster LEFT JOIN tbl_tablebilldetails ON tbl_tablebillmaster.bm_billno=tbl_tablebilldetails.bd_billno  where $string"); 
	  $sql_login  =  $database->mysqlQuery("select DISTINCT b.bm_dayclosedate,b.bm_billno,b.ter_cancelledreason,b.bm_finaltotal,b.ter_cancelledlogin,s.ser_firstname,s.ser_lastname from tbl_tablebillmaster b left join tbl_staffmaster s on b.ter_cancelledby_careof=s.ser_staffid where $string order by b.bm_dayclosedate");  
       $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{// bm_finaltotal  bm_amountpaid bm_amountbalace
			$final=$final + $result_login['bm_finaltotal'];
			$paid=$paid +$result_login['bm_amountpaid'];
			$bal=$bal + $result_login['bm_amountbalace'];
			
	 ?>
  <tr class="main" style="width:100px">
    <td style=" border: solid 1px #CCC;padding:3px; width:5px;"><?=$i?></td>
    <td style=" border: solid 1px #CCC;padding:3px; width:12px;"><?=$database->convert_date($result_login['bm_dayclosedate'])?> </td>
    <td style=" border: solid 1px #CCC;padding:3px; width:12px;"><?=$result_login['bm_billno']?> </td>
       <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['ter_cancelledreason']?> </td>
    <td style=" border: solid 1px #CCC;padding:3px; width:12px;"><?=$result_login['bm_finaltotal']?></td>
    <td style=" border: solid 1px #CCC;padding:3px; width:12px;"><?=$result_login['bm_amountpaid']?></td>
    <td style=" border: solid 1px #CCC;padding:3px; width:12px;"><?=$result_login['bm_amountbalace']?></td>
  </tr>
  <?php $i++;} } ?> 
  <!-- -------------------------------------- footer starts --------------------------------- -->
  <tr>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
      <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
  </tr>
  <tr class="main">
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;">TOTAL</td>
    <td style=" border: solid 1px #CCC;padding:3px;"></td>
      <td style=" border: solid 1px #CCC;padding:3px;"></td>
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;"></td>
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;"><?=$final?></td>
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;"><?=$paid?></td>
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;"><?=$bal?></td>
  </tr>

  <!-- -------------------------------------- footer ends --------------------------------- -->
</table> 
 <?php }else if($_REQUEST['type']=="type_pay") {   ?> 
 
 <table style="width: 100%; margin-bottom:50px; " align="center">
    <tr>
            <td style="width: 100%;height:40px; text-align: center;margin-bottom:50px; font-weight:bold ;background: #900;color:#FFF; font-size:20px;"><?=$branchname?></td>
        </tr>
        <tr>
            <td style="width: 100%;height:40px; text-align: center;margin-bottom:50px; font-weight:bold ;background: #900;color:#FFF; font-size:20px;">Payment Report</td>
        </tr>
        
    </table>
     <?php
  
  $string="";
	$fields="";
	if($_SESSION['types']=="cash")
	{
		//$string = " bm_transactionid ='' and bm_couponcompany ='' and bm_voucherid ='' and bm_chequeno ='' and bm_chequebankname=''";
		//$string = " (bm_transactionamount ='' or bm_transactionamount IS NULL) and (bm_couponcompany ='' or bm_couponcompany IS NULL) and bm_voucherid IS NULL and bm_couponamt ='0.00' and  (bm_chequeno ='' or bm_chequeno IS NULL) and (bm_chequebankname='' or bm_chequebankname IS NULL)";
		$string = " bm_paymode='cash'";
		$fields="";
	}else if($_SESSION['types']=="credit")
	{
		//$string = " bm_transactionamount <>'' ";
		$string = " bm_paymode='credit'";
		$fields="<td style=' border: solid 1px #CCC;padding:3px; font-weight:bold;'>Transaction Amount</td>";
		
	}else if($_SESSION['types']=="coupons")
	{
		//$string = " bm_couponcompany <>''  and bm_couponamt <>'0.00'";
		$string = " bm_paymode='coupons'";
		$fields="<td style=' border: solid 1px #CCC;padding:3px; font-weight:bold;'>Coupon Company</td>";
		$fields.="<td style=' border: solid 1px #CCC;padding:3px; font-weight:bold;'>Coupon Amount</td>";
	}else if($_SESSION['types']=="voucher")
	{
		//$string = " bm_voucherid <>''";
		$string = " bm_paymode='voucher'";
		$fields="<td style=' border: solid 1px #CCC;padding:3px; font-weight:bold;'>Voucher</td>";
	}else if($_SESSION['types']=="cheque")
	{
		//$string = " bm_chequeno <>'' and bm_chequebankname<>''";
		$string = " bm_paymode='cheque'";
		$fields="<td style=' border: solid 1px #CCC;padding:3px; font-weight:bold;'>Cheque No</td>";
		$fields.="<td style=' border: solid 1px #CCC;padding:3px; font-weight:bold;'>Bank Name</td>";
	}
  
   if($_SESSION['fromdt']!="" && $_SESSION['todt']!="")
		{
			$from=$database->convert_date($_SESSION['fromdt']);
			$to=$database->convert_date($_SESSION['todt']);
			$string.= " and  bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
		}
		else if($_SESSION['fromdt']!="" && $_SESSION['todt']=="")
		{
			$from=$database->convert_date($_SESSION['fromdt']);
			$to=date("Y-m-d");
			$string.= " and  bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
		}
		else if($_REQUEST['from']=="" && $_REQUEST['to']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_SESSION['todt']);
			$string.= " and  bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
		}
		else
		{
			
			
			
			/*$cur=date("Y-m-d");
			$string.=" and  bm_dayclosedate='".$cur."'";*/
			
				$paybydate=$_REQUEST['hidpay'];
		if($paybydate!="null")
	{
		
		
	if($paybydate=="Last5days")
	{
		$string.=" and bm_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($paybydate=="Last10days")
	{
		$string.=" and bm_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	elseif($paybydate=="Last15days")
	{
		$string.=" and bm_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($paybydate=="Last20days")
	{
		$string.=" and bm_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($paybydate=="Last25days")
	{
		$string.="and bm_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($paybydate=="Last30days")
	{
		$string.=" and bm_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	else if($paybydate=="Today")
	{
		$string.="and bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	else if($paybydate=="Yesterday")
			  {
				  $string.="and bm_dayclosedate =  CURDATE() - INTERVAL 1 day";
			  }
	else if($paybydate=="Last1month")
	{
		$string.=" and bm_dayclosedate between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
	}
	
	else if($paybydate=="Last90days")
	{
		$string.=" and bm_dayclosedate between CURDATE( ) - INTERVAL 3 
MONTH AND CURDATE( )";
	}
	else if($paybydate=="Last180days")
	{
		$string.=" and bm_dayclosedate between CURDATE( ) - INTERVAL 6 
MONTH AND CURDATE( )";
	}
	else if($paybydate=="Last365days")
	{
		$string.=" and bm_dayclosedate between CURDATE( ) - INTERVAL 1 
YEAR AND CURDATE( )";
	}
	
	
	
	}
	else
	{
			$cur=date("Y-m-d");
			$string.=" and  bm_dayclosedate='".$cur."'";
	}
			
			
			
			
			
			
			
			
			
			
		
			
			/*$cur=date("Y-m-d");
			$string.=" and  bm_dayclosedate='".$cur."'";*/
		}
    ?>
 <table cellspacing="0" style="width: 100%; font-size:9px; " align="center" cellpadding="0"  >
    <col style="width: 10%" class="col1">
    <col style="width: 20%">
    <col style="width: 20%">
    <col style="width: 10%">
    <col style="width: 10%">
    <col style="width: 10%">
    <col style="width: 10%">
    <col style="width: 10%">
    <tr >
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Sl no</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Date</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Bill no</td>
     <?=$fields ?>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Final</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Paid</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Balance</td>
  </tr>
 <?php
  $final=0;
  $paid=0;
  $bal=0;
  $coup=0;
       $cur=date("Y-m-d");
 	  $sql_login  =  $database->mysqlQuery("select * from tbl_tablebillmaster where $string"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$final=$final + $result_login['bm_finaltotal'];
			$paid=$paid +$result_login['bm_amountpaid'];
			$bal=$bal + $result_login['bm_amountbalace'];
			
	 ?>
  <tr class="main" style="width:100px">
    <td style=" border: solid 1px #CCC;padding:3px;"><?=$i?></td>
    <td style=" border: solid 1px #CCC;padding:3px;"><?=$database->convert_date($result_login['bm_dayclosedate'])?> </td>
    <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['bm_billno']?> </td>
    
     <?php
		 if($_SESSION['types']=="credit")
		{
			?>
			<td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['bm_transactionamount']?></td>
			<?php
			
		}else if($_SESSION['types']=="coupons")
		{ $coup=$coup + $result_login['bm_couponamt'];
			?>
			<td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['bm_couponcompany']?></td>
			<td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['bm_couponamt']?></td>
			<?php
		}else if($_SESSION['types']=="voucher")
		{
			?>
			<td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['bm_voucherid']?></td>
			<?php
		}else if($_SESSION['types']=="cheque")
		{
			?>
			<td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['bm_chequeno']?></td>
			<td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['bm_chequebankname']?></td>
			<?php
		}
		?>
    
    <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['bm_finaltotal']?></td>
    <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['bm_amountpaid']?></td>
    <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['bm_amountbalace']?></td>
  </tr>
  <?php $i++;} } ?> 
  <!-- -------------------------------------- footer starts --------------------------------- -->
  <tr>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
     <?php
	   if($_SESSION['types']=="credit")
	  {
		  ?>
		  <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
		  <?php
		  
	  }else if($_SESSION['types']=="coupons")
	  {
		  ?>
		  <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
		  <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
		  <?php
	  }else if($_SESSION['types']=="voucher")
	  {
		  ?>
		  <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
		  <?php
	  }else if($_SESSION['types']=="cheque")
	  {
		  ?>
		  <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
		  <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
		  <?php
	  }
	  ?>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
  </tr>
  <tr class="main">
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;">TOTAL</td>
    <td style=" border: solid 1px #CCC;padding:3px;"></td>
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;"></td>
     <?php
	   if($_SESSION['types']=="credit")
	  {
		  ?>
		  <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
		  <?php
		  
	  }else if($_SESSION['types']=="coupons")
	  {
		  ?>
		  <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
		  <td style=" border: solid 1px #CCC;padding:3px;"><?=$coup?></td>
		  <?php
	  }else if($_SESSION['types']=="voucher")
	  {
		  ?>
		  <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
		  <?php
	  }else if($_SESSION['types']=="cheque")
	  {
		  ?>
		  <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
		  <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
		  <?php
	  }
	  ?>
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;"><?=$final?></td>
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;"><?=$paid?></td>
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;"><?=$bal?></td>
  </tr>

  <!-- -------------------------------------- footer ends --------------------------------- -->
</table> 
 
 
 
 <?php }else if($_REQUEST['type']=="item") {  
 
	$floor=$_SESSION['floorv'];
	
	?>
    <table style="width: 100%; margin-bottom:50px; " align="center">
    <tr>
            <td style="width: 100%;height:40px; text-align: center;margin-bottom:50px; font-weight:bold ;background: #900;color:#FFF; font-size:20px;"><?=$branchname?></td>
        </tr>
        <tr>
            <td style="width: 100%;height:40px; text-align: center;margin-bottom:50px; font-weight:bold ;background: #900;color:#FFF; font-size:20px;">Total sales Report</td>
        </tr>
        
    </table>
    
    <table cellspacing="0" style="width: 100%; font-size:9px; " align="center" cellpadding="0"  >
    <col style="width: 10%" class="col1">
    <col style="width: 20%">
    <col style="width: 20%">
    <col style="width: 25%">
    <col style="width: 25%">
   
    <tr >
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;font-size:15px">Category</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;font-size:15px">Sub Category</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;font-size:15px">Items</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;font-size:15px">Dine In</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;font-size:15px">Take Away</td>
  </tr>
  
    <?php
	 $sql_cat  =  $database->mysqlQuery("select distinct(mr.mr_maincatid) as catid from tbl_menumaster as mr LEFT JOIN tbl_menumaincategory as my ON mr.mr_maincatid=my.mmy_maincategoryid where mr.mr_active='Y'  order by my.mmy_displayorder"); 
	$num_cat   = $database->mysqlNumRows($sql_cat);
	if($num_cat){$j=0;
		while($result_cat  = $database->mysqlFetchArray($sql_cat)) 
			{
				$j++;
				
				$menucat=$database->show_category_ful_details($result_cat['catid']);
				if($menucat['mmy_maincategoryname']!="")
				{
					?>
								  
                                  <tr>
                                  	<td colspan="1" style="text-align:left; border: solid 1px #CCC;padding:3px;"><strong><?=$menucat['mmy_maincategoryname']?></strong></td>
                                  	<td colspan="4" style="text-align:left; border: solid 1px #CCC;padding:3px; "></td>
                                  </tr>
                                  <?php
								  $sql_sub  =  $database->mysqlQuery("select distinct(mr_subcatid) as subid from tbl_menumaster where mr_active='Y' and mr_maincatid='".$result_cat['catid']."' order by mr_maincatid"); 
				$num_sub  = $database->mysqlNumRows($sql_sub);
				if($num_sub){$k=0;
					while($result_sub  = $database->mysqlFetchArray($sql_sub)) 
						{$k++; 
							$menusub=$database->show_subcategory_ful_details($result_sub['subid']);
						 ?> 
                                 <tr>
                                  	<td colspan="1" style="text-align:left;border: solid 1px #CCC;padding:3px;"></td>
                                  	<td colspan="1" style="text-align:left;border: solid 1px #CCC;padding:3px;"><?=$menusub['msy_subcategoryname']?></td>
                                    <td colspan="3" style="text-align:left;border: solid 1px #CCC;padding:3px;"> </td>
                                  </tr> 
                                  
                                  <?php
		
									
$sql_menulist_dine= "select mr_menuid,mr_menuname  from tbl_menumaster  WHERE  mr_active='Y' and  mr_maincatid='".$result_cat['catid']."' and (mr_subcatid='".$result_sub['subid']."' OR  mr_subcatid IS NULL)  order by mr_subcatid ";
		
				$sql_menus  =  $database->mysqlQuery($sql_menulist_dine); 
				$num_menus  = $database->mysqlNumRows($sql_menus);
				if($num_menus){$l=0;$old="";
					while($result_menus  = $database->mysqlFetchArray($sql_menus)) 
						{$l++; 
							//menuname
							  if($l==0)
							  {
								  $old=$result_menus['mr_menuname'];
								  $menuname=$result_menus['mr_menuname'];
							  }else if($l>0)
							  {
								  if($result_menus['mr_menuname']==$old)
								  {
									  $menuname="";
								  }else
								  {
									  $old=$result_menus['mr_menuname'];
									  $menuname=$result_menus['mr_menuname'];
								  }
							  }
						      //Dine Away
							  $dinein="";
							   $sql_menulist_din="SELECT mt.mmr_rate,pm.pm_portionname FROM tbl_menuratemaster as mt LEFT JOIN tbl_portionmaster as pm ON pm.pm_id=mt.mmr_portion WHERE mt.mmr_menuid='".$result_menus['mr_menuid']."'  and mt.mmr_floorid='".$floor."'";//and mt.mta_portion='".$result_menus['pm_id']."'
							  $sql_dn=$database->mysqlQuery($sql_menulist_din); 
							  $num_dn  = $database->mysqlNumRows($sql_dn);$f=0;
								if($num_dn)
								{
									
									while($result_dn  = $database->mysqlFetchArray($sql_dn)) 
									{
										if($f==0)
										{
										$dinein=$result_dn['mmr_rate']."(".$result_dn['pm_portionname'].")";
										}else
										{
											$dinein=$dinein." , ". $result_dn['mmr_rate']."(".$result_dn['pm_portionname'].")";
										}
										$f++;
									}
								}else
								{
									$dinein="";
								}
							  
							  
							  //take away
							  
							  $sql_menulist_tak="SELECT mt.mta_rate,pm.pm_portionname FROM tbl_menuratetakeaway as mt LEFT JOIN tbl_portionmaster as pm ON pm.pm_id=mt.mta_portion WHERE mt.mta_menuid='".$result_menus['mr_menuid']."' ";//and mt.mta_portion='".$result_menus['pm_id']."'
							  $sql_take=$database->mysqlQuery($sql_menulist_tak); 
							  $num_take  = $database->mysqlNumRows($sql_take);
								if($num_take)
								{
									$tak_portion="";$tak_rate="";
									while($result_take  = $database->mysqlFetchArray($sql_take)) 
									{
									$takeaway=$result_take['mta_rate']."(".$result_take['pm_portionname'].")";
									}
								}else
								{
									$takeaway="N/A";
								}
								 //$result_menus['mmr_rate']."(".$result_menus['pm_portionname'].")"
								 if($dinein!=""){
						 ?>
                            <tr>
                                  	<td colspan="1" style="text-align:left;border: solid 1px #CCC;padding:3px;"></td>
                                  	<td colspan="1" style="text-align:left;border: solid 1px #CCC;padding:3px;"></td>
                                    <td colspan="1" style="text-align:left;border: solid 1px #CCC;padding:3px;"><?=$menuname?> </td>
                                  	<td colspan="1" style="text-align:left;border: solid 1px #CCC;padding:3px;"><?=$dinein?></td>
                                    <td colspan="1" style="text-align:left;border: solid 1px #CCC;padding:3px;"><?=$takeaway?></td>
                                  </tr>
                           <?php } ?>
                         <?php } } ?>    
                           
                <?php } } ?>
                                
                                 
                                  <?php
					
				}
			}
		}
	
	?>
     </table>
 
 <?php }else if($_REQUEST['type']=="steward") {   ?>
  <table style="width: 100%; margin-bottom:50px; " align="center">
    <tr>
            <td style="width: 100%;height:40px; text-align: center;margin-bottom:50px; font-weight:bold ;background: #900;color:#FFF; font-size:20px;"><?=$branchname?></td>
        </tr>
        <tr>
            <td style="width: 100%;height:40px; text-align: center;margin-bottom:50px; font-weight:bold ;background: #900;color:#FFF; font-size:20px;">Steward Report</td>
        </tr>
        
    </table>
    
    <?php
	$string="";
	$stw=$_SESSION['stwr'];
	 if($_SESSION['fromdt']!="" && $_SESSION['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['from']);
			$to=$database->convert_date($_REQUEST['to']);
			$string.= " and ( tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' ) ";
		} 
		else if($_SESSION['fromdt']!="" && $_SESSION['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['from']);
			$to=date("Y-m-d");
			$string.= " and ( tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' ) ";
		}
		else if($_SESSION['fromdt']=="" && $_SESSION['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['to']);
			$string.= " and ( tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' )  ";
		}/*else if($_SESSION['fromdt']=="" && $_SESSION['todt']=="")
		{
			$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " and ( tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' )  ";
		} */
		
		else
		{
			
			
				$stewardbydate=$_REQUEST['hidstwbydate'];
	if($stewardbydate!="null")
	{
		//$search="";
	if($stewardbydate=="Last5days")
	{
		$string.="and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($stewardbydate=="Last10days")
	{
		$string.="and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	elseif($stewardbydate=="Last15days")
	{
		$string.="and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($stewardbydate=="Last20days")
	{
		$string.="and tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($stewardbydate=="Last25days")
	{
		$string.="and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($stewardbydate=="Last30days")
	{
		$string.="and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	else if($stewardbydate=="Today")
	{
		$string.="and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
		else if($stewardbydate=="Yesterday")
			  {
				  $string.="and tbl_tableorder.ter_dayclosedate  =  CURDATE() - INTERVAL 1 day";
			  }
	else if($stewardbydate=="Last1month")
	{
		$string.=" and tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
	}
	
	
	else if($stewardbydate=="Last90days")
	{
		$string.="and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}

else if($stewardbydate=="Last180days")
	{
		$string.="and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($stewardbydate=="Last365days")
	{
		$string.="and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}


	}
	
	else
	{
		$string.="and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
			
			
		
		}
		
		
		
		
		
    ?>
 <table cellspacing="0" style="width: 100%; font-size:9px; " align="center" cellpadding="0"  >
    <col style="width: 10%" class="col1">
    <col style="width: 20%">
    <col style="width: 20%">
    <tr >
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Sl no</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Item</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Count</td>
  </tr>
  
    <?php
 	  $sql_stw  =  $database->mysqlQuery("Select sum(tbl_tableorder.ter_qty) as ct,tbl_menumaster.mr_menuname as menuname From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid Inner Join tbl_staffmaster On tbl_tableorder.ter_staff = tbl_staffmaster.ser_staffid Where  tbl_tableorder.ter_staff =  '".$stw."' $string Group By tbl_menumaster.mr_menuname order by ct DESC"); 
	  $num_stw   = $database->mysqlNumRows($sql_stw);
	  if($num_stw){$i=1;
		  while($result_stw  = $database->mysqlFetchArray($sql_stw)) 
			{
				?>
  
 			 <tr>
              <td colspan="1" style="text-align:left;border: solid 1px #CCC;padding:3px;"><?=$i++?> </td>
              <td colspan="1" style="text-align:left;border: solid 1px #CCC;padding:3px;"><?=$result_stw['menuname']?></td>
              <td colspan="1" style="text-align:left;border: solid 1px #CCC;padding:3px;"><?=$result_stw['ct']?></td>
            </tr>
                                  <?php  }} ?>
                                  </table>
  
  
 
 <?php }else if($_REQUEST['type']=="order") { ?>
  <table style="width: 100%; margin-bottom:50px; " align="center">
    <tr>
            <td style="width: 100%;height:40px; text-align: center;margin-bottom:50px; font-weight:bold ;background: #900;color:#FFF; font-size:20px;"><?=$branchname?></td>
        </tr>
        <tr>
            <td style="width: 100%;height:40px; text-align: center;margin-bottom:50px; font-weight:bold ;background: #900;color:#FFF; font-size:20px;">Item Ordered</td>
        </tr>
        
    </table>
    <table cellspacing="0" style="width: 100%; font-size:9px; " align="center" cellpadding="0"  >
    <col style="width: 10%" class="col1">
    <col style="width: 40%">
    <col style="width: 20%">
   
    <tr >
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Sl no</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Menu</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Count</td>
   
  </tr>
  <?php
  $string="";
   if($_SESSION['fromdt']!="" && $_SESSION['todt']!="")
		{
			$from=$database->convert_date($_SESSION['fromdt']);
			$to=$database->convert_date($_SESSION['todt']);
			$string= " tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' ";
		}
		else if($_SESSION['fromdt']!="" && $_SESSION['todt']=="")
		{
			$from=$database->convert_date($_SESSION['fromdt']);
			$to=date("Y-m-d");
			$string= " tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['from']=="" && $_REQUEST['to']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_SESSION['todt']);
			$string= " tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' ";
		}
	
	else
	{
		/*$cur=date("Y-m-d");
		$string=" tbl_tableorder.ter_dayclosedate ='".$cur."'";*/
		
		
			$orderbydate=$_REQUEST['hidbydate'];
	
			if($orderbydate!="null")
	{
		//$search="";
	
	if($orderbydate=="Last5days")
	{
		$string.="  tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($orderbydate=="Last10days")
	{
		$string.="  tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	elseif($orderbydate=="Last15days")
	{
		$string.="  tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($orderbydate=="Last20days")
	{
		$string.="  tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($orderbydate=="Last25days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($orderbydate=="Last30days")
	{
		$string.="  tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	else if($orderbydate=="Today")
	{
		$string.="  tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	else if($orderbydate=="Yesterday")
			  {
				  $string.=" tbl_tableorder.ter_dayclosedate  =  CURDATE() - INTERVAL 1 day";
			  }
	else if($orderbydate=="Last1month")
	{
		$string.="  tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
	}

	else if($orderbydate=="Last90days")
	{
		$string.="  tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}
		else if($orderbydate=="Last180days")
	{
		$string.="  tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
		else if($orderbydate=="Last365days")
	{
		$string.="  tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}
	}
	else
	{
			$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " tbl_tableorder.ter_dayclosedate   between '".$from."' and '".$to."' ";
	}
		
	} ?>
    							  <tbody>
       <?php
	   
 	  $sql_stw  =  $database->mysqlQuery("Select sum(tbl_tableorder.ter_qty) as ct,tbl_menumaster.mr_menuname as menuname From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid  Where tbl_tableorder.ter_qty<>'0' and tbl_tableorder.ter_status='Closed' AND   $string Group By tbl_menumaster.mr_menuname order by ct DESC"); 
	  $num_stw   = $database->mysqlNumRows($sql_stw);
	  if($num_stw){$i=1;
		  while($result_stw  = $database->mysqlFetchArray($sql_stw)) 
			{
				?>
                 <tr>
                  <td colspan="1" style="text-align:left;border: solid 1px #CCC;padding:3px;"><?=$i++?> </td>
                  <td colspan="1" style="text-align:left;border: solid 1px #CCC;padding:3px;"><?=$result_stw['menuname']?></td>
                  <td colspan="1" style="text-align:left;border: solid 1px #CCC;padding:3px;"><?=$result_stw['ct']?></td>
                </tr>
                <?php } } ?>
                </tbody>
                </table>
	
	
 <?php }else if($_REQUEST['type']=="portion_order") {   ?>
  <table style="width: 100%; margin-bottom:50px; " align="center">
    <tr>
            <td style="width: 100%;height:40px; text-align: center;margin-bottom:50px; font-weight:bold ;background: #900;color:#FFF; font-size:20px;"><?=$branchname?></td>
        </tr>
        <tr>
            <td style="width: 100%;height:40px; text-align: center;margin-bottom:50px; font-weight:bold ;background: #900;color:#FFF; font-size:20px;"><?=$_SESSION['s_portionname']?> Order Report</td>
        </tr>
        
    </table>
    
    <?php
	$string="";
	$prt=$_SESSION['prtn'];
	
	if($prt !="null")
	{
		if($string!="")
		{
			$string.=" and  tbl_tableorder.ter_portion  LIKE  '%" . $prt ."%'";
		}else
		{
			$string.=" tbl_tableorder.ter_portion  LIKE  '%" . $prt ."%'";
		}
	}
	
	
	
	 if($_SESSION['fromdt']!="" && $_SESSION['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['from']);
			$to=$database->convert_date($_REQUEST['to']);
			if($string!="")
			{
			$string.= " and ( tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' ) ";
			}
			else
			{
				$string.= "  ( tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' ) ";
			}
		} 
		else if($_SESSION['fromdt']!="" && $_SESSION['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['from']);
			$to=date("Y-m-d");
			if($string !="")
			{
			$string.= " and ( tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' ) ";
			}
			else
			{
			$string.= "  ( tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' ) ";
			}

		
		}
		else if($_SESSION['fromdt']=="" && $_SESSION['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['to']);
			if($string!="")
			{
			$string.= " and ( tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' )  ";
			}
			else
			{
				$string.= "  ( tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' )  ";	
			}
		}else 
		//if($_SESSION['fromdt']=="" && $_SESSION['todt']=="")
		{
			/*$from=date("Y-m-d");
			$to=date("Y-m-d");
			if($string !="")
			{
			$string.= " and ( tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' )  ";
			}
			else
			{
				$string.= "  ( tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' )  ";
			}*/
			

			/*$from=date("Y-m-d");
			$to=date("Y-m-d");
			if($string!="")
			{
			$string.= " and ( tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' )  ";
			}
			else
			{
				$string.= "(tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' )  ";
				
			}*/
			$prtn=$_REQUEST['prtn'];
			$portionbydate=$_REQUEST['hidportn'];
	
	if($portionbydate!="null")
	{
		if($prtn !="null")
		{
	if($portionbydate=="Last5days")
	
	{
			if($string!="")
			{
		
		$string.=" and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";


			}
			else
			{
				$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
			}
	}elseif($portionbydate=="Last10days")
	{
		
			if($string!="")
			{
		$string.="and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
			}
			else
			{
				$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
			}
	}
	elseif($portionbydate=="Last15days")
	{
		if($string!="")
			{
		$string.="and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
			}
			else
			{
					$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
			}
	}
	else if($portionbydate=="Last20days")
	{
		if($string!="")
			{
		$string.="and tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
			}
			else
			{
					$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
			}
	}
	else if($portionbydate=="Last25days")
	{
		if($string!="")
			{
		$string.="and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 25 
			
DAY AND CURDATE( )";
			}
			else
			{
					$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 25 
			
DAY AND CURDATE( )";
			}
	}
	else if($portionbydate=="Last30days")
	{
		if($string!="")
			{
		$string.="and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
			}
			else
			{
				$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
			}
	}
	else if($portionbydate=="Today")
	{
			if($string!="")
			{
		$string.="and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
			}
			else
			{
				$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
			}
	}
	
	
	else if($portionbydate=="Yesterday")
			  {
				  
				  
				  if($string!="")
			{
		 $string.="and tbl_tableorder.ter_dayclosedate  =  CURDATE() - INTERVAL 1 day";
			}
			else
			{
				$string.=" tbl_tableorder.ter_dayclosedate   =  CURDATE() - INTERVAL 1 day"; 
			}
				 
			  }
	else if($portionbydate=="Last1month")
	{
  if($string!="")
			{
		 $string.="and tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 1  MONTH AND CURDATE( ) ";
			}
			else
			{
					$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
			}
				 
	}

	
	else if($portionbydate=="Last90days")
	{
		if($string!="")
			{
		$string.="and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
			}
			else
			{
					$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
			}
			
	}

else if($portionbydate=="Last180days")
	{
		if($string!="")
			{
		$string.="and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
			}
			else
			{
				$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
			}
			
	}
else if($portionbydate=="Last365days")
	{
		if($string!="")
			{
		$string.="and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
			}
			else
			{
				$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
			}
	}
			
			
			
		}
		else
		{
			//$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
			
			
			
		
			
				if($portionbydate=="Last5days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($portionbydate=="Last10days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	elseif($portionbydate=="Last15days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($portionbydate=="Last20days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($portionbydate=="Last25days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($portionbydate=="Last30days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	else if($portionbydate=="Today")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	else if($portionbydate=="Last90days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}
	
	
	else if($portionbydate=="Yesterday")
			  {
		 $string.=" tbl_tableorder.ter_dayclosedate  =  CURDATE() - INTERVAL 1 day";
			  }
	else if($portionbydate=="Last1month")
	{
		 $string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 1  MONTH AND CURDATE( ) ";
	}
	
	

else if($portionbydate=="Last180days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($portionbydate=="Last365days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}
			
		
			
			
			
			
			
			
			
			
			
			
			
			
		}
			
			
	}
	else
	{
		
	}
			
					
			
			
			
			
			
		} 
    ?>
 <table cellspacing="0" style="width: 100%; font-size:9px; " align="center" cellpadding="0"  >
    <col style="width: 10%" class="col1">
    <col style="width: 20%">
    <col style="width: 20%">
    <tr >
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Sl no</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Item</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Count</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;"><?=$_SESSION['s_portionname']?></td>
  </tr>
  
    <?php
 	  $sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_portionmaster.pm_portionname,tbl_menumaster.mr_menuname as menuname From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid Inner Join tbl_staffmaster On tbl_tableorder.ter_staff = tbl_staffmaster.ser_staffid inner join tbl_portionmaster ON tbl_tableorder.ter_portion=tbl_portionmaster.pm_id where  $string Group By tbl_menumaster.mr_menuname,tbl_portionmaster.pm_portionname order by ct DESC"); 
	  $num_stw   = $database->mysqlNumRows($sql_stw);
	  if($num_stw){$i=1;
		  while($result_stw  = $database->mysqlFetchArray($sql_stw)) 
			{
				?>
  
 			 <tr>
              <td colspan="1" style="text-align:left;border: solid 1px #CCC;padding:3px;"><?=$i++?> </td>
              <td colspan="1" style="text-align:left;border: solid 1px #CCC;padding:3px;"><?=$result_stw['menuname']?></td>
              <td colspan="1" style="text-align:left;border: solid 1px #CCC;padding:3px;"><?=$result_stw['ct']?></td>
                <td colspan="1" style="text-align:left;border: solid 1px #CCC;padding:3px;"><?=$result_stw['pm_portionname']?></td>
            </tr>
                                  <?php  }} ?>
                                  </table>
  
  
 
 <?php }
 else if($_REQUEST['type']=="type_order") { ?>
  <table style="width: 100%; margin-bottom:50px; " align="center">
    <tr>
            <td style="width: 100%;height:40px; text-align: center;margin-bottom:50px; font-weight:bold ;background: #900;color:#FFF; font-size:20px;"><?=$branchname?></td>
        </tr>
        <tr>
            <td style="width: 100%;height:40px; text-align: center;margin-bottom:50px; font-weight:bold ;background: #900;color:#FFF; font-size:20px;">Type of order</td>
        </tr>
        
    </table>
    <table cellspacing="0" style="width: 100%; font-size:9px; " align="center" cellpadding="0"  >
    <col style="width: 10%" class="col1">
    <col style="width: 40%">
    <col style="width: 20%">
   
    <tr >
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Sl no</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Menu</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Count</td>
   
  </tr>
  <?php
  $string="";
  $ordertyp=$_SESSION['ordertyp'];
   if($_SESSION['fromdt']!="" && $_SESSION['todt']!="")
		{
			$from=$database->convert_date($_SESSION['fromdt']);
			$to=$database->convert_date($_SESSION['todt']);
			$string= " tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' ";
		}
		else if($_SESSION['fromdt']!="" && $_SESSION['todt']=="")
		{
			$from=$database->convert_date($_SESSION['fromdt']);
			$to=date("Y-m-d");
			$string= " tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['from']=="" && $_REQUEST['to']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_SESSION['todt']);
			$string= " tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' ";
		}
	
	else
	{
		/*$cur=date("Y-m-d");
		$string=" tbl_tableorder.ter_dayclosedate ='".$cur."'";*/
		
		
		/*$cur=date("Y-m-d");
		$string=" tbl_tableorder.ter_dayclosedate ='".$cur."'";*/
		
		
		
	$string="";
	
		$ordertypebydate=$_REQUEST['hidorderby'];
	if($ordertypebydate!="null")
	{
		//$search="";
	if($ordertypebydate=="Last5days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($ordertypebydate=="Last10days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	elseif($ordertypebydate=="Last15days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($ordertypebydate=="Last20days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($ordertypebydate=="Last25days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($ordertypebydate=="Last30days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	else if($ordertypebydate=="Today")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
		else if($ordertypebydate=="Yesterday")
			  {
				  $string.="tbl_tableorder.ter_dayclosedate   =  CURDATE() - INTERVAL 1 day";
			  }
	else if($ordertypebydate=="Last1month")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
	}
	
	
	
	else if($ordertypebydate=="Last90days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}

else if($ordertypebydate=="Last180days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($ordertypebydate=="Last365days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}

	}
	
	else
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
		
	
	} ?>
    							  <tbody>
       <?php
	  
 	  $sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_menumaster.mr_menuname as menuname From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid WHERE  $string and tbl_tableorder.ter_type='".$ordertyp."' Group By tbl_menumaster.mr_menuname  DESC"); 
	  $num_stw   = $database->mysqlNumRows($sql_stw);
	  if($num_stw){$i=1;
		  while($result_stw  = $database->mysqlFetchArray($sql_stw)) 
			{
				?>
                 <tr>
                  <td colspan="1" style="text-align:left;border: solid 1px #CCC;padding:3px;"><?=$i++?> </td>
                  <td colspan="1" style="text-align:left;border: solid 1px #CCC;padding:3px;"><?=$result_stw['menuname']?></td>
                  <td colspan="1" style="text-align:left;border: solid 1px #CCC;padding:3px;"><?=$result_stw['ct']?></td>
                </tr>
                <?php } } ?>
                </tbody>
                </table>
	
	
 <?php } else if($_REQUEST['type']=="cancel_history") { ?>
  <table style="width: 100%; margin-bottom:50px; " align="center">
    <tr>
            <td style="width: 100%;height:40px; text-align: center;margin-bottom:50px; font-weight:bold ;background: #900;color:#FFF; font-size:20px;"><?=$branchname?></td>
        </tr>
        <tr>
            <td style="width: 100%;height:40px; text-align: center;margin-bottom:50px; font-weight:bold ;background: #900;color:#FFF; font-size:20px;">Item Cancel Log</td>
        </tr>
        
    </table>
    <table cellspacing="0" style="width: 100%; font-size:9px; " align="center" cellpadding="0"  >
      <col style="width: 10%" class="col1">
      <col style="width: 10%">
      <col style="width: 15%">
      <col style="width: 15%">
      <col style="width:25%">
      <col style="width: 10%">
      <col style="width: 10%">
    <tr >    
      <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Slno</td>
      <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Date</td>
      <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Staff name</td>
      <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Order NO</td>
      <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Menu</td>
      <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Qty</td>
      <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Entry Time</td>
  </tr>
  <?php
  $string="";
  $ordertyp=$_SESSION['ordertyp'];
   if($_SESSION['fromdt']!="" && $_SESSION['todt']!="")
		{
			$from=$database->convert_date($_SESSION['fromdt']);
			$to=$database->convert_date($_SESSION['todt']);
			$string= " ch.ch_date  between '".$from."' and '".$to."' ";
		}
		else if($_SESSION['fromdt']!="" && $_SESSION['todt']=="")
		{
			$from=$database->convert_date($_SESSION['fromdt']);
			$to=date("Y-m-d");
			$string= " ch.ch_date  between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['from']=="" && $_REQUEST['to']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_SESSION['todt']);
			$string= " ch.ch_date  between '".$from."' and '".$to."' ";
		}
	
	else
	{
		/*$cur=date("Y-m-d");
		$string=" ch.ch_date ='".$cur."'";*/
		
		
		/*$cur=date("Y-m-d");
		$string=" ch.ch_date ='".$cur."'";*/
		
		
		
	$string="";
	
		$ordertypebydate=$ordertyp;
	if($ordertypebydate!="null")
	{
		//$search="";
	if($ordertypebydate=="Last5days")
	{
		$string.=" ch.ch_date   between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($ordertypebydate=="Last10days")
	{
		$string.=" ch.ch_date   between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	elseif($ordertypebydate=="Last15days")
	{
		$string.=" ch.ch_date   between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($ordertypebydate=="Last20days")
	{
		$string.=" ch.ch_date  between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($ordertypebydate=="Last25days")
	{
		$string.=" ch.ch_date   between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($ordertypebydate=="Last30days")
	{
		$string.=" ch.ch_date   between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	else if($ordertypebydate=="Today")
	{
		$string.=" ch.ch_date   between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
		else if($ordertypebydate=="Yesterday")
			  {
				  $string.="ch.ch_date   =  CURDATE() - INTERVAL 1 day";
			  }
	else if($ordertypebydate=="Last1month")
	{
		$string.=" ch.ch_date   between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
	}
	
	
	
	else if($ordertypebydate=="Last90days")
	{
		$string.=" ch.ch_date   between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}

else if($ordertypebydate=="Last180days")
	{
		$string.=" ch.ch_date   between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($ordertypebydate=="Last365days")
	{
		$string.=" ch.ch_date   between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}

	}
	
	else
	{
		$string.=" ch.ch_date   between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
		
	
	} ?>
    							  <tbody>
       <?php
	  
 	  $sql_stw  =  $database->mysqlQuery("Select  ch.ch_date,sm.ser_firstname,ch.ch_orderno,ch.ch_orderslno,ch.ch_qty,ch_entrytime From tbl_tablecancelhistory as ch LEFT JOIN tbl_staffmaster as sm ON sm.ser_staffid=ch.ch_staffid WHERE $string "); 
	  $num_stw   = $database->mysqlNumRows($sql_stw);
	  if($num_stw){$i=1;
		  while($result_stw  = $database->mysqlFetchArray($sql_stw)) 
			{$fuldet=$database->show_tableorder_ful_details($result_stw['ch_orderno']);
				?>
                 <tr>
                   <td colspan="1" style="text-align:left;border: solid 1px #CCC;padding:3px;"><?=$i++?></td>
                   <td colspan="1" style="text-align:left;border: solid 1px #CCC;padding:3px;"><?=$database->convert_date($result_stw['ch_date'])?></td>
                     <td colspan="1" style="text-align:left;border: solid 1px #CCC;padding:3px;"><?=$result_stw['ser_firstname']?></td>
                    <td colspan="1" style="text-align:left;border: solid 1px #CCC;padding:3px;"><?=$result_stw['ch_orderno']?></td>
                    <td colspan="1" style="text-align:left;border: solid 1px #CCC;padding:3px;"><?=$fuldet['mr_menuname']?></td>
                    <td colspan="1" style="text-align:left;border: solid 1px #CCC;padding:3px;"><?=$result_stw['ch_qty']?></td>
                    <td colspan="1" style="text-align:left;border: solid 1px #CCC;padding:3px;"><?=$result_stw['ch_entrytime']?></td>
                    
                 
                </tr>
                <?php } } ?>
                </tbody>
                </table>
	
	
 <?php }
 
 else if($_REQUEST['type']=="complementary_report")
 {
	  
 

 ?> 
    <table style="width: 100%; margin-bottom:50px; " align="center">
    <tr>
            <td style="width: 100%;height:40px; text-align: center;margin-bottom:50px; font-weight:bold ;background: #900;color:#FFF; font-size:20px;"><?=$branchname?></td>
        </tr>
        <tr>
            <td style="width: 100%;height:40px; text-align: center;margin-bottom:50px; font-weight:bold ;background: #900;color:#FFF; font-size:20px;">Complementary Report</td>
        </tr>
        
    </table>
 <table cellspacing="0" style="width: 100%; font-size:9px; " align="center" cellpadding="0"  >
    <col style="width: 8%" class="col1">
    <col style="width: 12%">
    <col style="width: 12%">
    <col style="width: 12%">
    <col style="width: 40%">

    
    <tr >
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Sl no</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Bill Date</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Bill no</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Amount</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Remarks</td>

  </tr>
  <?php
  $string=" bm_status='Closed' AND bm_complimentary='Y' AND ";
   if($_SESSION['fromdt']!="" && $_SESSION['todt']!="")
		{
			$from=$database->convert_date($_SESSION['fromdt']);
			$to=$database->convert_date($_SESSION['todt']);
			$string.= " bm_billdate between '".$from."' and '".$to."' ";
		}
		else if($_SESSION['fromdt']!="" && $_SESSION['todt']=="")
		{
			$from=$database->convert_date($_SESSION['fromdt']);
			$to=date("Y-m-d");
			$string.= " bm_billdate between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['from']=="" && $_REQUEST['to']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_SESSION['todt']);
			$string.= " bm_billdate between '".$from."' and '".$to."' ";
		}
	
	else
	{
		/*$cur=date("Y-m-d");
		$string=" bm_dayclosedate='".$cur."'";*/
		
		
	//$bydate=$_REQUEST['hidbydate'];
	
		$bydatz=$_REQUEST['hidbydate'];
		
		
		
			if($bydatz!="null")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.="bm_billdate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($bydatz=="Last10days")
	{
		$string.="bm_billdate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" bm_billdate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" bm_billdate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last25days")
	{
		$string.="bm_billdate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last30days")
	{
		$string.="bm_billdate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	
	else if($bydatz=="Today")
	{
		$string.="bm_billdate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.="bm_billdate =  CURDATE() - INTERVAL 1 day";
			  }
			   else if($bydatz=="Last1month")
			  {
				  $string.="bm_billdate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
	
	
else if($bydatz=="Last90days")
	{
		$string.="bm_billdate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last180days")
	{
		$string.="bm_billdate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last365days")
	{
		$string.="bm_billdate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}

	}
	else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "bm_billdate between '".$from."' and '".$to."' ";
	}
		
	
	
	
	
	
		
		/*$cur=date("Y-m-d");
		$string=" bm_dayclosedate='".$cur."'";*/
	
		
		
		
	}
	
	
  $final=0;
  $paid=0;
  $bal=0;
  $dsc=0;
  $srvtx=0;
  $subtotal=0;
       $cur=date("Y-m-d");
 	  $sql_login  =  $database->mysqlQuery("select * from tbl_tablebillmaster where $string order by bm_billdate,bm_billtime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{// bm_finaltotal  bm_amountpaid bm_amountbalace
			$final=$final + $result_login['bm_finaltotal'];
			
		
			
	 ?>
  <tr class="main" style="width:100px">
    <td style=" border: solid 1px #CCC;padding:3px;"><?=$i?></td>
    <td style=" border: solid 1px #CCC;padding:3px;"><?=$database->convert_date($result_login['bm_billdate'])?> </td>
    <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['bm_billno']?> </td>
    <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['bm_finaltotal']?> </td>

    <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['bm_complimentaryremark']?></td>

  </tr>
  <?php $i++;} } ?> 
  <!-- -------------------------------------- footer starts --------------------------------- -->
  <tr>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
      <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>
    <td style=" border: solid 1px #CCC;padding:3px;">&nbsp;</td>

  </tr>
  <tr class="main">
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;">TOTAL</td>
    <td style=" border: solid 1px #CCC;padding:3px;"></td>
      <td style=" border: solid 1px #CCC;padding:3px;"></td>
          <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;"><?=$final?></td>
     <td style=" border: solid 1px #CCC;padding:3px;"></td>
   

   
  </tr>

  <!-- -------------------------------------- footer ends --------------------------------- -->
</table> 
 <?php 
	 
 }
 
 
 
 
 
 
 
 ?>
<table style="text-align: center;  background: #900;width: 100%; font-size:8px; color:#FFF;" align="center">
    <tr>
        <td style="width:100%" >Bill</td>
    </tr>
</table>

</page>