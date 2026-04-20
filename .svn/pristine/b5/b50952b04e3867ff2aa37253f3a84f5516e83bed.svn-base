<?php

//include('includes/session.php');		// Check session
include("database.class.php"); // DB Connection class
$database	= new Database(); 		// Create a new instance



?>


<page backtop="10mm" backbottom="10mm" backleft="10mm" backright="10mm" >
<!--<table style="text-align: center;  background: #60497b;height:100px; width: 100%" align="center">
    <tr>
        <td style="width: 50%"><img src="images/since_pdf.jpg" alt="Since" width="50" /></td>
        <td style="width: 50%"><img src="images/logo_head.jpg" alt="Logo" width="150" /></td>
    </tr>
</table>-->
<br />
 <?php if($_REQUEST['type']=="tot_sales_ta") { ?> 
    <table style="width: 100%; margin-bottom:50px; " align="center">
    <tr>
            <td style="width: 100%;height:40px; text-align: center;margin-bottom:50px; font-weight:bold ;background: #900;color:#FFF; font-size:20px;">Hotel Name</td>
        </tr>
        <tr>
            <td style="width: 100%;height:40px; text-align: center;margin-bottom:50px; font-weight:bold ;background: #900;color:#FFF; font-size:20px;">Total sales Report</td>
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
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Sl no</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Date</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Bill no</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Final</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Paid</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Balance</td>
  </tr>
  <?php
  
   if($_SESSION['fromdt']!="" && $_SESSION['todt']!="")
		{
			$from=$database->convert_date($_SESSION['fromdt']);
			$to=$database->convert_date($_SESSION['todt']);
			$string= " tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
		}
		else if($_SESSION['fromdt']!="" && $_SESSION['todt']=="")
		{
			$from=$database->convert_date($_SESSION['fromdt']);
			$to=date("Y-m-d");
			$string= " tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
		}
		else if($_REQUEST['from']=="" && $_REQUEST['to']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_SESSION['todt']);
			$string= " tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
		}
	
	else
	{
		/*$cur=date("Y-m-d");
		$string=" bm_billdate='".$cur."'";*/
		
		
	//$bydate=$_REQUEST['hidbydate'];
	
		$bydatz=$_REQUEST['hidbydate'];
		
		
		
			if($bydatz!="null")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string="tab_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($bydatz=="Last10days")
	{
		$string="tab_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	elseif($bydatz=="Last15days")
	{
		$string=" tab_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last20days")
	{
		$string=" tab_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last25days")
	{
		$string="tab_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last30days")
	{
		$string="tab_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	
	else if($bydatz=="Today")
	{
		$string="tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	else if($bydatz=="Yesterday")
			  {
				  $string="tab_dayclosedate = CURDATE() - INTERVAL 1 day ";
			  }
			   else if($bydatz=="Last1month")
			  {
				  $string="tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
	
	
else if($bydatz=="Last90days")
	{
		$string="tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last180days")
	{
		$string="tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last365days")
	{
		$string="tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}

	}
	else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string= "tab_dayclosedate between '".$from."' and '".$to."' ";
	}
		
	
	
	
	
	
		
		/*$cur=date("Y-m-d");
		$string=" bm_billdate='".$cur."'";*/
	
		
		
		
	}
  $final=0;
  $paid=0;
  $bal=0;
       $cur=date("Y-m-d");
 	  $sql_login  =  $database->mysqlQuery("select * from tbl_takeaway_billmaster where $string"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{// bm_finaltotal  bm_amountpaid bm_amountbalace
			$final=$final + $result_login['tab_netamt'];
			$paid=$paid +$result_login['tab_amountpaid'];
			$bal=$bal + $result_login['tab_amountbalace'];
			
	 ?>
  <tr class="main" style="width:100px">
    <td style=" border: solid 1px #CCC;padding:3px;"><?=$i?></td>
    <td style=" border: solid 1px #CCC;padding:3px;"><?=$database->convert_date($result_login['tab_dayclosedate'])?> </td>
    <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['tab_billno']?> </td>
    <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['tab_netamt']?></td>
    <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['tab_amountpaid']?></td>
    <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['tab_amountbalace']?></td>
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
  </tr>
  <tr class="main">
    <td style="font-weight:bold; border: solid 1px #CCC;padding:3px;">TOTAL</td>
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
            <td style="width: 100%;height:40px; text-align: center;margin-bottom:50px; font-weight:bold ;background: #900;color:#FFF; font-size:20px;">Hotel Name</td>
        </tr>
        <tr>
            <td style="width: 100%;height:40px; text-align: center;margin-bottom:50px; font-weight:bold ;background: #900;color:#FFF; font-size:20px;">Total sales Report</td>
        </tr>
        
    </table>
     <?php
  
  $string="";
	$fields="";
	if($_SESSION['types']=="cash")
	{
		//$string = " bm_transactionid ='' and bm_couponcompany ='' and bm_voucherid ='' and bm_chequeno ='' and bm_chequebankname=''";
		$string = " (tab_transactionamount ='' or tab_transactionamount IS NULL) and (tab_couponcompany ='' or tab_couponcompany IS NULL) and tab_voucherid IS NULL and tab_couponamt ='0.00' and  (tab_chequeno ='' or tab_chequeno IS NULL) and (tab_chequebankname='' or tab_chequebankname IS NULL)";
		$fields="";
	}else if($_SESSION['types']=="credit")
	{
		$string = " tab_transactionamount <>'' ";
		$fields="<td style=' border: solid 1px #CCC;padding:3px; font-weight:bold;'>Transcation Id</td>";
		
	}else if($_SESSION['types']=="coupons")
	{
		$string = " tab_couponcompany <>''  and tab_couponamt <>'0.00'";
		$fields="<td style=' border: solid 1px #CCC;padding:3px; font-weight:bold;'>Coupon Company</td>";
		$fields.="<td style=' border: solid 1px #CCC;padding:3px; font-weight:bold;'>Coupon Amount</td>";
	}else if($_SESSION['types']=="voucher")
	{
		$string = " tab_voucherid <>''";
		$fields="<td style=' border: solid 1px #CCC;padding:3px; font-weight:bold;'>Voucher</td>";
	}else if($_SESSION['types']=="cheque")
	{
		$string = " tab_chequeno <>'' and tab_chequebankname<>''";
		$fields="<td style=' border: solid 1px #CCC;padding:3px; font-weight:bold;'>Cheque No</td>";
		$fields.="<td style=' border: solid 1px #CCC;padding:3px; font-weight:bold;'>Bank Name</td>";
	}
  
   if($_SESSION['fromdt']!="" && $_SESSION['todt']!="")
		{
			$from=$database->convert_date($_SESSION['fromdt']);
			$to=$database->convert_date($_SESSION['todt']);
			$string.= " and  tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
		}
		else if($_SESSION['fromdt']!="" && $_SESSION['todt']=="")
		{
			$from=$database->convert_date($_SESSION['fromdt']);
			$to=date("Y-m-d");
			$string.= " and  tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
		}
		else if($_REQUEST['from']=="" && $_REQUEST['to']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_SESSION['todt']);
			$string.= " and  tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
		}
		else
		{
			
			
			
			/*$cur=date("Y-m-d");
			$string.=" and  bm_billdate='".$cur."'";*/
			
				$paybydate=$_REQUEST['hidpay'];
		if($paybydate!="null")
	{
		
		
	if($paybydate=="Last5days")
	{
		$string.=" and tab_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($paybydate=="Last10days")
	{
		$string.=" and tab_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	elseif($paybydate=="Last15days")
	{
		$string.=" and tab_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($paybydate=="Last20days")
	{
		$string.=" and tab_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($paybydate=="Last25days")
	{
		$string.="and tab_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($paybydate=="Last30days")
	{
		$string.=" and tab_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	else if($paybydate=="Today")
	{
		$string.="and tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	else if($paybydate=="Yesterday")
			  {
				  $string.="and tab_dayclosedate = CURDATE() - INTERVAL 1 day ";
			  }
	else if($paybydate=="Last1month")
	{
		$string.=" and tab_dayclosedate between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
	}
	
	else if($paybydate=="Last90days")
	{
		$string.=" and tab_dayclosedate between CURDATE( ) - INTERVAL 3 
MONTH AND CURDATE( )";
	}
	else if($paybydate=="Last180days")
	{
		$string.=" and tab_dayclosedate between CURDATE( ) - INTERVAL 6 
MONTH AND CURDATE( )";
	}
	else if($paybydate=="Last365days")
	{
		$string.=" and tab_dayclosedate between CURDATE( ) - INTERVAL 1 
YEAR AND CURDATE( )";
	}
	
	
	
	}
	else
	{
			$cur=date("Y-m-d");
			$string.=" and  tab_dayclosedate='".$cur."'";
	}
			
			
			
			
			
			
			
			
			
			
		
			
			/*$cur=date("Y-m-d");
			$string.=" and  bm_billdate='".$cur."'";*/
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
 	  $sql_login  =  $database->mysqlQuery("select * from tbl_takeaway_billmaster where $string"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$final=$final + $result_login['tab_netamt'];
			$paid=$paid +$result_login['tab_amountpaid'];
			$bal=$bal + $result_login['tab_amountbalace'];
			
	 ?>
  <tr class="main" style="width:100px">
    <td style=" border: solid 1px #CCC;padding:3px;"><?=$i?></td>
    <td style=" border: solid 1px #CCC;padding:3px;"><?=$database->convert_date($result_login['tab_dayclosedate'])?> </td>
    <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['tab_billno']?> </td>
    
     <?php
		 if($_SESSION['types']=="credit")
		{
			?>
			<td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['tab_transactionamount']?></td>
			<?php
			
		}else if($_SESSION['types']=="coupons")
		{ $coup=$coup + $result_login['tab_couponamt'];
			?>
			<td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['tab_couponcompany']?></td>
			<td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['tab_couponamt']?></td>
			<?php
		}else if($_SESSION['types']=="voucher")
		{
			?>
			<td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['tab_voucherid']?></td>
			<?php
		}else if($_SESSION['types']=="cheque")
		{
			?>
			<td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['tab_chequeno']?></td>
			<td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['tab_chequebankname']?></td>
			<?php
		}
		?>
    
    <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['tab_netamt']?></td>
    <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['tab_amountpaid']?></td>
    <td style=" border: solid 1px #CCC;padding:3px;"><?=$result_login['tab_amountbalace']?></td>
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
            <td style="width: 100%;height:40px; text-align: center;margin-bottom:50px; font-weight:bold ;background: #900;color:#FFF; font-size:20px;">Hotel Name</td>
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
								
								  $sql_menulist_dine= "select mr_menuid,mr_menuname  from tbl_menumaster  WHERE  mr_active='Y' and  mr_maincatid='".$result_cat['catid']."' and mr_subcatid='".$result_sub['subid']."'  order by mr_subcatid ";
		
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
            <td style="width: 100%;height:40px; text-align: center;margin-bottom:50px; font-weight:bold ;background: #900;color:#FFF; font-size:20px;">Hotel Name</td>
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
			$string.= " and (tbl_takeaway_billmaster.tab_dayclosedate between '".$from."' and '".$to."' ) ";
		} 
		else if($_SESSION['fromdt']!="" && $_SESSION['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['from']);
			$to=date("Y-m-d");
			$string.= " and ( tbl_takeaway_billmaster.tab_dayclosedate between '".$from."' and '".$to."' ) ";
		}
		else if($_SESSION['fromdt']=="" && $_SESSION['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['to']);
			$string.= " and (tbl_takeaway_billmaster.tab_dayclosedate between '".$from."' and '".$to."' )  ";
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
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($stewardbydate=="Last10days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	elseif($stewardbydate=="Last15days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($stewardbydate=="Last20days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($stewardbydate=="Last25days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($stewardbydate=="Last30days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	else if($stewardbydate=="Today")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
		else if($stewardbydate=="Yesterday")
			  {
				  $string.="and tbl_takeaway_billmaster.tab_dayclosedate = CURDATE() - INTERVAL 1 day ";
			  }
	else if($stewardbydate=="Last1month")
	{
		$string.=" and tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
	}
	
	
	else if($stewardbydate=="Last90days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}

else if($stewardbydate=="Last180days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($stewardbydate=="Last365days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}


	}
	
	else
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
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
 	  $sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_menumaster.mr_menuname as menuname From tbl_takeaway_billmaster  Inner Join tbl_takeaway_billdetails ON tbl_takeaway_billmaster.tab_billno=tbl_takeaway_billdetails.tab_billno INNER JOIN  tbl_menumaster On tbl_menumaster.mr_menuid = tbl_takeaway_billdetails.tab_menuid Inner Join tbl_staffmaster On tbl_takeaway_billmaster.tab_assignedto = tbl_staffmaster.ser_staffid Where tbl_takeaway_billmaster.tab_assignedto  =  '".$stw."' $string Group By tbl_menumaster.mr_menuname order by ct DESC"); 
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
            <td style="width: 100%;height:40px; text-align: center;margin-bottom:50px; font-weight:bold ;background: #900;color:#FFF; font-size:20px;">Hotel Name</td>
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
			$string= "tbl_takeaway_billmaster.tab_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_SESSION['fromdt']!="" && $_SESSION['todt']=="")
		{
			$from=$database->convert_date($_SESSION['fromdt']);
			$to=date("Y-m-d");
			$string= " tbl_takeaway_billmaster.tab_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['from']=="" && $_REQUEST['to']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_SESSION['todt']);
			$string= " tbl_takeaway_billmaster.tab_dayclosedate between '".$from."' and '".$to."' ";
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
		$string.=" tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($orderbydate=="Last10days")
	{
		$string.="  tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	elseif($orderbydate=="Last15days")
	{
		$string.=" tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($orderbydate=="Last20days")
	{
		$string.=" tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($orderbydate=="Last25days")
	{
		$string.=" tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($orderbydate=="Last30days")
	{
		$string.="  tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	else if($orderbydate=="Today")
	{
		$string.="  tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	else if($orderbydate=="Yesterday")
			  {
				  $string.=" tbl_takeaway_billmaster.tab_dayclosedate = CURDATE() - INTERVAL 1 day ";
			  }
	else if($orderbydate=="Last1month")
	{
		$string.="  tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
	}

	else if($orderbydate=="Last90days")
	{
		$string.="  tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}
		else if($orderbydate=="Last180days")
	{
		$string.="  tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
		else if($orderbydate=="Last365days")
	{
		$string.=" tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}
	}
	else
	{
			$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " tbl_takeaway_billmaster.tab_dayclosedate  between '".$from."' and '".$to."' ";
	}
		
	} ?>
    							  <tbody>
       <?php
	   
 	  $sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_menumaster.mr_menuname as menuname From tbl_takeaway_billmaster Inner join tbl_takeaway_billdetails ON tbl_takeaway_billmaster.tab_billno=tbl_takeaway_billdetails. tab_billno Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_takeaway_billdetails.tab_menuid  Where   $string Group By tbl_menumaster.mr_menuname order by ct DESC"); 
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
            <td style="width: 100%;height:40px; text-align: center;margin-bottom:50px; font-weight:bold ;background: #900;color:#FFF; font-size:20px;">Hotel Name</td>
        </tr>
        <tr>
            <td style="width: 100%;height:40px; text-align: center;margin-bottom:50px; font-weight:bold ;background: #900;color:#FFF; font-size:20px;">Portion Order Report</td>
        </tr>
        
    </table>
    
    <?php
	  
    $portion=$_REQUEST['prtn'];
	$string="";
		if($portion !="null")
	{
		if($string!="")
		{
			$string.=" and tbl_takeaway_billdetails.tab_portion  LIKE  '%" . $portion ."%'";
		}else
		{
			$string.=" tbl_takeaway_billdetails.tab_portion  LIKE  '%" . $portion ."%'";
		}
	}
	if($_REQUEST['from']!="" && $_REQUEST['to']!="")
		{
			$from=$database->convert_date($_REQUEST['from']);
			$to=$database->convert_date($_REQUEST['to']);
			if($string!="")
			{
			$string.= " and (  tbl_takeaway_billmaster.tab_dayclosedate between '".$from."' and '".$to."' ) ";
			}
			else
			{
					$string.= " (  tbl_takeaway_billmaster.tab_dayclosedate between '".$from."' and '".$to."' ) ";
			}
		}
		else if($_REQUEST['from']!="" && $_REQUEST['to']=="")
		{
			$from=$database->convert_date($_REQUEST['from']);
			$to=date("Y-m-d");
			if($string !="")
			{
			$string.= " and (  tbl_takeaway_billmaster.tab_dayclosedate between '".$from."' and '".$to."' ) ";
			}
			else
			{
				$string.= "  (  tbl_takeaway_billmaster.tab_dayclosedate between '".$from."' and '".$to."' ) ";
			}
		}
		else if($_REQUEST['from']=="" && $_REQUEST['to']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['to']);
		if($string !="")
			{
			$string.= " and (  tbl_takeaway_billmaster.tab_dayclosedate between '".$from."' and '".$to."' )  ";
			}
			else
			{
					$string.= "(  tbl_takeaway_billmaster.tab_dayclosedate between '".$from."' and '".$to."' )  ";
				
			}
		}else if($_REQUEST['from']=="" && $_REQUEST['to']=="")
		{
			/*$from=date("Y-m-d");
			$to=date("Y-m-d");
			if($string!="")
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
		
		$string.=" and  tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";


			}
			else
			{
				$string.="  tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
			}
	}elseif($portionbydate=="Last10days")
	{
		
			if($string!="")
			{
		$string.="and  tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
			}
			else
			{
				$string.="  tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
			}
	}
	elseif($portionbydate=="Last15days")
	{
		if($string!="")
			{
		$string.="and  tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
			}
			else
			{
					$string.="  tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
			}
	}
	else if($portionbydate=="Last20days")
	{
		if($string!="")
			{
		$string.="and  tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
			}
			else
			{
					$string.=" tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
			}
	}
	else if($portionbydate=="Last25days")
	{
		if($string!="")
			{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 25 
			
DAY AND CURDATE( )";
			}
			else
			{
					$string.="  tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 25 
			
DAY AND CURDATE( )";
			}
	}
	else if($portionbydate=="Last30days")
	{
		if($string!="")
			{
		$string.="and  tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
			}
			else
			{
				$string.=" tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
			}
	}
	else if($portionbydate=="Today")
	{
			if($string!="")
			{
		$string.="and  tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
			}
			else
			{
				$string.="  tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
			}
	}
	
	else if($portionbydate=="Yesterday")
			  {
				  
				  
				  if($string!="")
			{
		 $string.="and tbl_takeaway_billmaster.tab_dayclosedate= CURDATE() - INTERVAL 1 day";
			}
			else
			{
				$string.="  tbl_takeaway_billmaster.tab_dayclosedate  = CURDATE() - INTERVAL 1 day"; 
			}
				 
			  }
	else if($portionbydate=="Last1month")
	{
  if($string!="")
			{
		 $string.="and  tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 1  MONTH AND CURDATE( ) ";
			}
			else
			{
					$string.="  tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
			}
				 
	}
	
	
	
	
	else if($portionbydate=="Last90days")
	{
		if($string!="")
			{
		$string.="and  tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
			}
			else
			{
					$string.=" tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL  3 MONTH AND CURDATE( )"; 
			}
			
	}

else if($portionbydate=="Last180days")
	{
		if($string!="")
			{
		$string.="and  tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
			}
			else
			{
				$string.=" tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
			}
			
	}
else if($portionbydate=="Last365days")
	{
		if($string!="")
			{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
			}
			else
			{
				$string.="  tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
			}
	}
			
			
			
		}
		else
		{
			//$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
			
			
			
		
			
				if($portionbydate=="Last5days")
	{
		$string.="  tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($portionbydate=="Last10days")
	{
		$string.=" tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	elseif($portionbydate=="Last15days")
	{
		$string.=" tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($portionbydate=="Last20days")
	{
		$string.=" tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($portionbydate=="Last25days")
	{
		$string.="  tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($portionbydate=="Last30days")
	{
		$string.=" tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	else if($portionbydate=="Today")
	{
		$string.="  tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	
	else if($portionbydate=="Yesterday")
			  {
		 $string.=" tbl_takeaway_billmaster.tab_dayclosedate = CURDATE() - INTERVAL 1 day ";
			  }
	else if($portionbydate=="Last1month")
	{
		 $string.="  tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 1  MONTH AND CURDATE( ) ";
	}
	
	else if($portionbydate=="Last90days")
	{
		$string.="  tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}

else if($portionbydate=="Last180days")
	{
		$string.=" tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($portionbydate=="Last365days")
	{
		$string.=" tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
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
 	  $sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_portionmaster.pm_portionname,tbl_menumaster.mr_menuname as menuname From tbl_takeaway_billmaster Inner Join tbl_takeaway_billdetails ON tbl_takeaway_billmaster.tab_billno= tbl_takeaway_billdetails.tab_billno  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_takeaway_billdetails.tab_menuid Inner Join  tbl_portionmaster ON tbl_takeaway_billdetails.tab_portion=tbl_portionmaster.pm_id  where   $string Group By tbl_menumaster.mr_menuname,tbl_portionmaster.pm_portionname order by ct DESC"); 
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
 else if($_REQUEST['type']=="delivery_amt") {
	 
	 
	 
	    ?>
  <table style="width: 100%; margin-bottom:50px; " align="center">
    <tr>
            <td style="width: 100%;height:40px; text-align: center;margin-bottom:50px; font-weight:bold ;background: #900;color:#FFF; font-size:20px;">Hotel Name</td>
        </tr>
        <tr>
            <td style="width: 100%;height:40px; text-align: center;margin-bottom:50px; font-weight:bold ;background: #900;color:#FFF; font-size:20px;">Collection Report</td>
        </tr>
        
    </table>
    
    <?php
	$string="";
	$stw=$_SESSION['stwr'];
	 if($_SESSION['fromdt']!="" && $_SESSION['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['from']);
			$to=$database->convert_date($_REQUEST['to']);
			$string.= " and (tbl_takeaway_billmaster.tab_dayclosedate between '".$from."' and '".$to."' ) ";
		} 
		else if($_SESSION['fromdt']!="" && $_SESSION['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['from']);
			$to=date("Y-m-d");
			$string.= " and ( tbl_takeaway_billmaster.tab_dayclosedate between '".$from."' and '".$to."' ) ";
		}
		else if($_SESSION['fromdt']=="" && $_SESSION['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['to']);
			$string.= " and (tbl_takeaway_billmaster.tab_dayclosedate between '".$from."' and '".$to."' )  ";
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
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($stewardbydate=="Last10days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	elseif($stewardbydate=="Last15days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($stewardbydate=="Last20days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($stewardbydate=="Last25days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($stewardbydate=="Last30days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	else if($stewardbydate=="Today")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
		else if($stewardbydate=="Yesterday")
			  {
				  $string.="and tbl_takeaway_billmaster.tab_dayclosedate = CURDATE() - INTERVAL 1 day ";
			  }
	else if($stewardbydate=="Last1month")
	{
		$string.=" and tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
	}
	
	
	else if($stewardbydate=="Last90days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}

else if($stewardbydate=="Last180days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($stewardbydate=="Last365days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}


	}
	
	else
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
			
			
		
		}
		
		
		
		
		
    ?>
 <table cellspacing="0" style="width: 100%; font-size:9px; " align="center" cellpadding="0"  >
    <col style="width: 10%" class="col1">
    <col style="width: 20%">
    <col style="width: 20%">
    <tr >
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Sl no</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Date</td>
    <td style=" border: solid 1px #CCC;padding:3px; font-weight:bold;">Total Amount</td>
  </tr>
  
    <?php
 	  $sql_stw  =  $database->mysqlQuery("Select sum(tbl_takeaway_billmaster.tab_netamt) as amt,tbl_takeaway_billmaster.tab_dayclosedate as tabdate From tbl_takeaway_billmaster Inner Join tbl_staffmaster On tbl_takeaway_billmaster.tab_assignedto = tbl_staffmaster.ser_staffid Where tbl_takeaway_billmaster.tab_assignedto ='".$stw."' $string Group By tbl_takeaway_billmaster.tab_dayclosedate"); 
	  $num_stw   = $database->mysqlNumRows($sql_stw);
	  if($num_stw){$i=1;
		  while($result_stw  = $database->mysqlFetchArray($sql_stw)) 
			{
				?>
  
 			 <tr>
              <td colspan="1" style="text-align:left;border: solid 1px #CCC;padding:3px;"><?=$i++?> </td>
              <td colspan="1" style="text-align:left;border: solid 1px #CCC;padding:3px;"><?=$database->convert_date($result_stw['tabdate'])?></td>
              <td colspan="1" style="text-align:left;border: solid 1px #CCC;padding:3px;"><?=$result_stw['amt']?></td>
            </tr>
                                  <?php  }} ?>
                                  </table>
  
  
 
 <?php 
	 
	 
	 
	 
	 
	 
	 
	 
	 } ?>
<table style="text-align: center;  background: #900;width: 100%; font-size:8px; color:#FFF;" align="center">
    <tr>
        <td style="width:100%" >Bill</td>
    </tr>
</table>

</page>