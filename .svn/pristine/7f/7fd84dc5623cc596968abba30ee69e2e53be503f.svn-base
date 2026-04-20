<?php
include('includes/session.php');		// Check session
//session_start();
if($_SESSION["archive_enabled"]=='Y'){
    include("database.class.reports.php");  // DB Connection class
    $database	= new Database();
    
}
else if($_SESSION["archive_enabled"]=='N'){
    include("database.class.php");  // DB Connection class
    $database	= new Database();
    
}

if($_REQUEST['type']=="tot_sales_ta")
{
//    $string="";
    $string=" tab_status='closed' AND tab_mode!= 'CS' and tab_complimentary!='Y' AND ";
    if($_REQUEST['typesale'] !='')
	{
		
			$string.="tab_mode='".$_REQUEST['typesale']."' AND ";
	}
	 $date=date("Ymd");
		if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= "tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
		}
		else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=date("Y-m-d");
			$string.= "tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
		}
		else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= "tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
		}
	
	else
	{
		
	//$bydate=$_REQUEST['hidbydate'];
	
		$bydatz=$_REQUEST['hidbydate'];
		
		
		
			if($bydatz!="null")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($bydatz=="Last10days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	elseif($bydatz=="Last15days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last20days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last25days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last30days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Today")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.="tab_dayclosedate = CURDATE() - 1 ";
			  }
			   else if($bydatz=="Last1month")
			  {
				  $string.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
else if($bydatz=="Last90days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last180days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last365days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
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


	$cur=date("Y-m-d");
 	  $sql_login  =  $database->mysqlQuery("select * from tbl_takeaway_billmaster where $string"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login)
	  {
			echo $string;
	  }else
	  {
		  echo $string;
	  }

	
  
	
}

else if($_REQUEST['type']=="type_sale")
{
	
	 $date=date("Ymd");
	 
	 $string="";
	 if($_REQUEST['typesale']!='null')
	{
		$string.=" tab_mode='".$_REQUEST['typesale']."' AND ";
		
	}
	 
	 
	 
		if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
		}
		else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=date("Y-m-d");
			$string.= " tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
		}
		else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
		}
	
	else
	{
		
	//$bydate=$_REQUEST['hidbydate'];
	
		$bydatz=$_REQUEST['hidbydate'];
		
		
		
			if($bydatz!="null")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($bydatz=="Last10days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last25days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last30days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Today")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.="tab_dayclosedate = CURDATE() - 1 ";
			  }
			   else if($bydatz=="Last1month")
			  {
				  $string.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
else if($bydatz=="Last90days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last180days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last365days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}

	}
	else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "tab_dayclosedate between '".$from."' and '".$to."' ";
	}
		
	
	
	
	
	
		
		/*$cur=date("Y-m-d");
		$string=" bm_billdate='".$cur."'";*/
	}


	$cur=date("Y-m-d");
 	  $sql_login  =  $database->mysqlQuery("select * from tbl_takeaway_billmaster where $string"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login)
	  {
			echo "ok";
	  }else
	  {
		  echo "sorry";
	  }
	
}
/**discount**/
else if($_REQUEST['type']=="discount_ta")
{
    $string=" tab_status='closed' AND tab_mode!='CS' AND tab_discountvalue!='0.00' AND ";
//    $string="";
    $typedisc=$_REQUEST['typedisc'];
    if($_REQUEST['typedisc'] !='')
	{
		$string.="tab_mode='".$typedisc."'  AND ";
			
	}
     
	 $date=date("Ymd");
		if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= "tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
		}
		else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=date("Y-m-d");
			$string.= "tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
		}
		else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= "tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
		}
	
	else
	{
		
	//$bydate=$_REQUEST['hidbydate'];
	
		$bydatz=$_REQUEST['hidbydate'];
		
		
		
			if($bydatz!="null")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($bydatz=="Last10days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	elseif($bydatz=="Last15days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last20days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last25days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last30days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Today")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.="tab_dayclosedate = CURDATE() - 1 ";
			  }
			   else if($bydatz=="Last1month")
			  {
				  $string.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
else if($bydatz=="Last90days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last180days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last365days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
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


	$cur=date("Y-m-d");
 	  $sql_login  =  $database->mysqlQuery("select * from tbl_takeaway_billmaster where $string"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login)
	  {
			echo $string;
	  }else
	  {
		  echo $string;
	  }


}

else if($_REQUEST['type']=="type_pay_ta")
{
	 $date=date("Ymd");

$string=" tbm.tab_status='closed'";

$typepaysale=$_REQUEST['typepaysale'];
	
	if($_REQUEST['typepaysale']!='')
	{
	
		$string.=" AND tbm.tab_mode='".$typepaysale."' AND ";
	}
if($_REQUEST['hidpaytyp']=="cash")
    	{
    $string ="";
   
//		$string = " (tab_transactionamount ='' or tab_transactionamount IS NULL) and (tab_couponcompany ='' or tab_couponcompany IS NULL) and tab_voucherid IS NULL and tab_couponamt ='0.00' and  (tab_chequeno ='' or tab_chequeno IS NULL) and (tab_chequebankname='' or tab_chequebankname IS NULL)";
	/*	 xlsWriteLabel(0,3,"Final");
 		 xlsWriteLabel(0,4,"Paid");
 		 xlsWriteLabel(0,5,"Balance");*/
		 $data['Final']="";
		 $data['Paid']="";
		 $data['Balance']="";
		 
	}else if($_REQUEST['hidpaytyp']=="credit")
	{
//            $string = " pym_code='credit' and AND ";
              $string = " p.pym_code='credit'";
			 $data['Transaction Amount']="";
		 	 $data['Final']="";
		     $data['Paid']="";
		     $data['Balance']="";
	}else if($_REQUEST['hidpaytyp']=="coupons")
	{
            $string = " pym_code='coupon'";
//		$string = " tab_couponcompany <>''  and tab_couponamt <>'0.00'";
		
			 $data['Coupon Company']="";
		 $data['Coupon Amount']="";
		 $data['Final']="";
		  $data['Paid']="";
		   $data['Balance']="";
	}else if($_REQUEST['hidpaytyp']=="voucher")
	{
            $string = " pym_code='voucher'";
//		$string = " tab_voucherid <>''";
		 $data['Voucher']="";
		  $data['Final']="";
		   $data['Paid']="";
		    $data['Balance']="";
		
	}else if($_REQUEST['hidpaytyp']=="cheque")
	{
            $string = " pym_code='cheque'";
//		$string = " tab_chequeno <>'' and tab_chequebankname<>''";
		  $data['Cheque No']="";
	      $data['Bank Name']="";
	     $data['Final']="";
	     $data['Paid']="";
		 $data['Balance']="";
	}
	

	if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= "tbm.tab_dayclosedate between '".$from."' and '".$to."' order by tbm.tab_dayclosedate";
		}
		else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=date("Y-m-d");
			$string.= "tbm.tab_dayclosedate between '".$from."' and '".$to."' order by tbm.tab_dayclosedate";
		}
		else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= "tbm.tab_dayclosedate between '".$from."' and '".$to."' order by tbm.tab_dayclosedate";
		}else
		{
			/*$cur=date("Y-m-d");
			$string.=" and  bm_billdate='".$cur."'";*/
			
				$paybydate=$_REQUEST['hidpay'];
		if($paybydate!="null")
	{
		
		
	if($paybydate=="Last5days")
	{
		$string.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($paybydate=="Last10days")
	{
		$string.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	elseif($paybydate=="Last15days")
	{
		$string.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($paybydate=="Last20days")
	{
		$string.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($paybydate=="Last25days")
	{
		$string.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($paybydate=="Last30days")
	{
		$string.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	else if($paybydate=="Today")
	{
		$string.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	
		else if($paybydate=="Yesterday")
			  {
				  $string.="tbm.tab_dayclosedate = CURDATE() - 1 ";
			  }
	else if($paybydate=="Last1month")
	{
		$string.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
	}
	
	else if($paybydate=="Last90days")
	{
		$string.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 3 
MONTH AND CURDATE( )";
	}
	else if($paybydate=="Last180days")
	{
		$string.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 6 
MONTH AND CURDATE( )";
	}
	else if($paybydate=="Last365days")
	{
		$string.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 
YEAR AND CURDATE( )";
	}
	
	
	
	}
	else
	{
			$cur=date("Y-m-d");
			$string.="tbm.tab_dayclosedate='".$cur."'";
	}
		}
	
	
	$sql_login  =  $database->mysqlQuery("select tbm.tab_billno,tbm.tab_dayclosedate,tbm.tab_amountpaid,tbm.tab_amountbalace from tbl_takeaway_billmaster tbm left join tbm.tbl_paymentmode p on tbm.tab_paymode=p.pym_id where  $string"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	 if($num_login)
	  {
			echo $string;
	  }else
	  {
		  echo $string;
	  }

		

	
}else if($_REQUEST['type']=="item")
{
	/**********************************************ITEM *****************************************************************/
	 $date=date("Ymd");
	$floor=$_REQUEST['hidfloor'];
	$data=array();
$data1=array();
$xlsRow=1;  
$dinein=0;
$takeaway=0; 

	 $sql_cat  =  $database->mysqlQuery("select distinct(mr.mr_maincatid) as catid from tbl_menumaster as mr LEFT JOIN tbl_menumaincategory as my ON mr.mr_maincatid=my.mmy_maincategoryid where mr.mr_active='Y'  order by my.mmy_displayorder"); 
	$num_cat   = $database->mysqlNumRows($sql_cat);
	if($num_cat){
		
		
		while($result_cat  = $database->mysqlFetchArray($sql_cat)) 
			{
				$menucat=$database->show_category_ful_details($result_cat['catid']);
				if($menucat['mmy_maincategoryname']!="")
				{
					$data['Category']=$menucat['mmy_maincategoryname'];
					$data['SubCategory']="";
					$data['Items']="";
					$data['DineIn']="";
					$data['Take Away']="";
					array_push($data1,$data);
			unset($data);
    $xlsRow++; 
					 
								  $sql_sub  =  $database->mysqlQuery("select distinct(mr_subcatid) as subid from tbl_menumaster where mr_active='Y' and mr_maincatid='".$result_cat['catid']."' order by mr_maincatid"); 
				$num_sub  = $database->mysqlNumRows($sql_sub);
				if($num_sub){
					while($result_sub  = $database->mysqlFetchArray($sql_sub)) 
						{
							$menusub=$database->show_subcategory_ful_details($result_sub['subid']);
							
							$data['Category']="";
							$data['SubCategory']=$menusub['msy_subcategoryname'];
		                    $data['Items']="";
					        $data['DineIn']="";
				        	$data['Take Away']="";
				        	array_push($data1,$data);
			                unset($data);
                            $xlsRow++; 
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
						      //Dine 
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
								 if($dinein!=""){
								
							$data['Category']="";
							$data['SubCategory']="";
		                    $data['Items']=$menuname;
					        $data['DineIn']=$dinein;
				        	$data['Take Away']=$takeaway;
				        	array_push($data1,$data);
			                unset($data);
                            $xlsRow++; 
						
								 }
						 } }    
                           
                 } } 
                                 
					
				}
			}
		}
	
		$data[]="";
										$data[]="";
											$data[]="";
												$data[]="";
													$data[]="";
													array_push($data1,$data);
	unset($data);	
						
						$filename = "Menu_report_" . date('Y-m-d') . ".xls";
  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel");

  $flag = false;
  foreach($data1 as $row) {
    if(!$flag) {
      echo implode("\t", array_keys($row)) . "\n";
      $flag = true;
    }
    array_walk($row, 'cleanData');
    echo implode("\t", array_values($row)) . "\n";
  }
  unset($data);
  unset($data1);
  exit;								

	
} else if($_REQUEST['type']=="steward")
{/***********************************************steward***************************************************/
 $date=date("Ymd");

		$stw=$_REQUEST['hidstw'];
		$string="";
		if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " and ( tbl_takeaway_billmaster.tab_dayclosedate between '".$from."' and '".$to."' ) ";
		}
		else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=date("Y-m-d");
			$string.= " and (  tbl_takeaway_billmaster.tab_dayclosedate between '".$from."' and '".$to."' ) ";
		}
		else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " and ( tbl_takeaway_billmaster.tab_dayclosedate between '".$from."' and '".$to."' )  ";
		}/*else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']=="")
		{
			$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " and ( tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' )  ";
		}*/
		else
		{
			
				$stewardbydate=$_REQUEST['hidstwdate'];
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
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($stewardbydate=="Last20days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($stewardbydate=="Last25days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($stewardbydate=="Last30days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	else if($stewardbydate=="Today")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	else if($stewardbydate=="Yesterday")
			  {
				  $string.="and tbl_takeaway_billmaster.tab_dayclosedate = CURDATE() - 1 ";
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
		

	  

	  
	    $sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_menumaster.mr_menuname as menuname From tbl_takeaway_billmaster  Inner Join tbl_takeaway_billdetails ON tbl_takeaway_billmaster.tab_billno=tbl_takeaway_billdetails.tab_billno INNER JOIN  tbl_menumaster On tbl_menumaster.mr_menuid = tbl_takeaway_billdetails.tab_menuid Inner Join tbl_staffmaster On tbl_takeaway_billmaster.tab_assignedto = tbl_staffmaster.ser_staffid Where tbl_takeaway_billmaster.tab_assignedto  =  '".$stw."' $string Group By tbl_menumaster.mr_menuname order by ct DESC"); 
	  $num_stw   = $database->mysqlNumRows($sql_stw);
	  
	  
	  	 if($num_stw)
	  {
			echo "ok";
	  }else
	  {
		  echo "sorry";
	  }

		
	  
	 
}else if($_REQUEST['type']=="order")
{/***********************************************Ordered*************************************************************************/
 $date=date("Ymd");
$string="";
if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=$database->convert_date($_REQUEST['hidto']);
			$string= " tbl_takeaway_billmaster.tab_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=date("Y-m-d");
			$string= "tbl_takeaway_billmaster.tab_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['hidto']);
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
		$string.=" tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	elseif($orderbydate=="Last15days")
	{
		$string.="  tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($orderbydate=="Last20days")
	{
		$string.=" tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 20 
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
				  $string.=" tbl_takeaway_billmaster.tab_dayclosedate= CURDATE() - 1 ";
			  }
	else if($orderbydate=="Last1month")
	{
		$string.=" tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 1 
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
		$string.="  tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}
	}
	else
	{
			$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " tbl_takeaway_billmaster.tab_dayclosedate  between '".$from."' and '".$to."' ";
	}
	
	
	
	
	
		
	
		
		
		
		
		
		
	}
	
	
$data=array();
$data1=array();
$xlsRow=1;  
	$sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_menumaster.mr_menuname as menuname From tbl_takeaway_billmaster Inner join tbl_takeaway_billdetails ON tbl_takeaway_billmaster.tab_billno=tbl_takeaway_billdetails. tab_billno Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_takeaway_billdetails.tab_menuid  Where   $string Group By tbl_menumaster.mr_menuname order by ct DESC"); 
	  $num_stw   = $database->mysqlNumRows($sql_stw);
	 	 if($num_stw)
	  {
			echo "ok";
	  }else
	  {
		  echo "sorry";
	  }

		
} else if($_REQUEST['type']=="portion_order")
{/***********************************************steward***************************************************/
 $date=date("Ymd");

		$portion=$_REQUEST['prtn'];
		$string="";
		if($portion !="null")
	{
		if($string!="")
		{
			$string.=" and  tbl_takeaway_billdetails.tab_portion  LIKE  '%" . $portion ."%'";
		}else
		{
			//$string.=" tbl_tableorder.ter_portion  LIKE  '%" . $portion ."%'";
		}
	}
		if($_REQUEST['from']!="" && $_REQUEST['to']!="")
		{
			$from=$database->convert_date($_REQUEST['from']);
			$to=$database->convert_date($_REQUEST['to']);
			if($string !="")
			{
			$string.= " and ( tbl_takeaway_billmaster.tab_dayclosedate between '".$from."' and '".$to."' ) ";
			}
			else
			{
					$string.= "(tbl_takeaway_billmaster.tab_dayclosedate between '".$from."' and '".$to."' ) ";
			}
		}
		else if($_REQUEST['from']!="" && $_REQUEST['to']=="")
		{
			$from=$database->convert_date($_REQUEST['from']);
			$to=date("Y-m-d");
			if($string!="")
			{
			$string.= " and ( tbl_takeaway_billmaster.tab_dayclosedate between '".$from."' and '".$to."' ) ";
			}
			else
			{
					$string.= "(tbl_takeaway_billmaster.tab_dayclosedate between '".$from."' and '".$to."' ) ";
			}
		}
		else if($_REQUEST['from']=="" && $_REQUEST['to']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['to']);
			if($string!="")
			{
			$string.= " and ( tbl_takeaway_billmaster.tab_dayclosedate between '".$from."' and '".$to."' )  ";
			}
			else
			{
				$string.= "(tbl_takeaway_billmaster.tab_dayclosedate between '".$from."' and '".$to."' )  ";
			}
		}else 
		{
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
		
		$string.=" and tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";


			}
			else
			{
				$string.=" tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
			}
	}elseif($portionbydate=="Last10days")
	{
		
			if($string!="")
			{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
			}
			else
			{
				$string.=" tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
			}
	}
	elseif($portionbydate=="Last15days")
	{
		if($string!="")
			{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
			}
			else
			{
					$string.=" tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
			}
	}
	else if($portionbydate=="Last20days")
	{
		if($string!="")
			{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 20 
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
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 25 
			
DAY AND CURDATE( )";
			}
			else
			{
					$string.=" tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 25 
			
DAY AND CURDATE( )";
			}
	}
	else if($portionbydate=="Last30days")
	{
		if($string!="")
			{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 30 
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
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
			}
			else
			{
				$string.="tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
			}
	}
	
	
	else if($portionbydate=="Yesterday")
			  {
				  
				  
				  if($string!="")
			{
		 $string.="and tbl_takeaway_billmaster.tab_dayclosedate= CURDATE() - 1 ";
			}
			else
			{
				$string.=" tbl_takeaway_billmaster.tab_dayclosedate  = CURDATE() - 1"; 
			}
				 
			  }
	else if($portionbydate=="Last1month")
	{
  if($string!="")
			{
		 $string.="and tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 1  MONTH AND CURDATE( ) ";
			}
			else
			{
					$string.=" tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
			}
				 
	}
	
	
	
	else if($portionbydate=="Last90days")
	{
		if($string!="")
			{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
			}
			else
			{
					$string.="tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
			}
			
	}

else if($portionbydate=="Last180days")
	{
		if($string!="")
			{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
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
				$string.=" tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
			}
	}
			
			
			
		}
		else
		{
			//$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
			
			
			
		
			
				if($portionbydate=="Last5days")
	{
		$string.="tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($portionbydate=="Last10days")
	{
		$string.=" tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	elseif($portionbydate=="Last15days")
	{
		$string.="tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($portionbydate=="Last20days")
	{
		$string.=" tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($portionbydate=="Last25days")
	{
		$string.=" tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($portionbydate=="Last30days")
	{
		$string.=" tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	else if($portionbydate=="Today")
	{
		$string.=" tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	else if($portionbydate=="Yesterday")
			  {
		 $string.=" tbl_takeaway_billmaster.tab_dayclosedate = CURDATE() - 1 ";
				 
			  }
	else if($portionbydate=="Last1month")
	{
		 $string.="tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 1  MONTH AND CURDATE( ) ";
	}
	
	else if($portionbydate=="Last90days")
	{
		$string.=" tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}

else if($portionbydate=="Last180days")
	{
		$string.="tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
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
		
		
	  

	  
	    $sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_portionmaster.pm_portionname,tbl_menumaster.mr_menuname as menuname From tbl_takeaway_billmaster Inner Join tbl_takeaway_billdetails ON tbl_takeaway_billmaster.tab_billno= tbl_takeaway_billdetails.tab_billno  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_takeaway_billdetails.tab_menuid Inner Join  tbl_portionmaster ON tbl_takeaway_billdetails.tab_portion=tbl_portionmaster.pm_id  where $string Group By tbl_menumaster.mr_menuname order by ct DESC"); 
	  $num_stw   = $database->mysqlNumRows($sql_stw);
		 if($num_stw)
	  {
			echo "ok";
	  }else
	  {
		  echo "sorry";
	  }

		
}


else if($_REQUEST['type']=="type_order")
{/***********************************************Type of item**********************************************************/
 $date=date("Ymd");
$string="";
$ordtype=$_REQUEST['ordertyp'];
if($_REQUEST['from']!="" && $_REQUEST['to']!="")
		{
			$from=$database->convert_date($_REQUEST['from']);
			$to=$database->convert_date($_REQUEST['to']);
			$string= " tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['from']!="" && $_REQUEST['to']=="")
		{
			$from=$database->convert_date($_REQUEST['from']);
			$to=date("Y-m-d");
			$string= " tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['from']=="" && $_REQUEST['to']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['to']);
			$string= " tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' ";
		}
	
	else
	{
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
				  $string.="tbl_tableorder.ter_dayclosedate   = CURDATE() - 1 ";
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
		
	}
	


    
	$sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_menumaster.mr_menuname as menuname From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid WHERE  $string and tbl_tableorder.ter_type='".$ordtype."' Group By tbl_menumaster.mr_menuname  DESC"); 
	  $num_stw   = $database->mysqlNumRows($sql_stw);
	 	 if($num_stw)
	  {
			echo "ok";
	  }else
	  {
		  echo "sorry";
	  }

		
  
	

}


else if($_REQUEST['type']=="delivery_amt")
{
	/***********************************************steward***************************************************/
 $date=date("Ymd");

		$stw=$_REQUEST['hidstw'];
		$string="";
		if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " and ( tbl_takeaway_billmaster.tab_dayclosedate between '".$from."' and '".$to."' ) ";
		}
		else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=date("Y-m-d");
			$string.= " and (  tbl_takeaway_billmaster.tab_dayclosedate between '".$from."' and '".$to."' ) ";
		}
		else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " and ( tbl_takeaway_billmaster.tab_dayclosedate between '".$from."' and '".$to."' )  ";
		}/*else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']=="")
		{
			$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " and ( tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' )  ";
		}*/
		else
		{
			
				$stewardbydate=$_REQUEST['hidstwdate'];
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
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($stewardbydate=="Last20days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($stewardbydate=="Last25days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($stewardbydate=="Last30days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	else if($stewardbydate=="Today")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	else if($stewardbydate=="Yesterday")
			  {
				  $string.="and tbl_takeaway_billmaster.tab_dayclosedate = CURDATE() - 1 ";
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
		

	  

	  
	    $sql_stw  =  $database->mysqlQuery("Select sum(tbl_takeaway_billmaster.tab_netamt) as amt,tbl_takeaway_billmaster.tab_dayclosedate as tabdate From tbl_takeaway_billmaster Inner Join tbl_staffmaster On tbl_takeaway_billmaster.tab_assignedto = tbl_staffmaster.ser_staffid Where tbl_takeaway_billmaster.tab_assignedto ='".$stw."' $string Group By tbl_takeaway_billmaster.tab_dayclosedate"); 
	  $num_stw   = $database->mysqlNumRows($sql_stw);
	  
	  
	  	 if($num_stw)
	  {
			echo "ok";
	  }else
	  {
		  echo "sorry";
	  }

		
	  
	 

}








?>