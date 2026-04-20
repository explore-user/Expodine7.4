<?php //include('includes/session.php');		// Check session
session_start();
error_reporting(0);
include("database.class.php"); // DB Connection class
$database	= new Database();

if($_REQUEST['set']=="load_piechart")
{
	$string='';
	if($_REQUEST['report']=="m")
	{
	$string.="   between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
	}else  if($_REQUEST['report']=="d")
	{
	$string.=" = '".$_SESSION['date']."'";
	}else  if($_REQUEST['report']=="y")
	{
	$string.="   between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
	}
	$finaldata=array();
   // dine in
	  $final='';
	  $sql_menulists="select  ((sum((bm_finaltotal))))  as tot from tbl_tablebillmaster as tm    where  tm.bm_status='Closed'   AND tm.bm_dayclosedate $string ";
	  $sql_menuss  =  $database->mysqlQuery($sql_menulists); 
	  $num_menuss  = $database->mysqlNumRows($sql_menuss);
	  if($num_menuss){	
	  while($result_menuss  = $database->mysqlFetchArray($sql_menuss)) 
			  {
			  $final=$final + $result_menuss['tot'];
		  }
	   }
	   $finaldata[]=$final;
   // take away
	  $final='';
	  $sql_menulists="select sum( tab_netamt) as tot from tbl_takeaway_billmaster 
          where  tab_status='closed' and tab_payment_settled = 'Y' and tab_mode= 'TA' AND tab_dayclosedate $string";
	  $sql_menuss  =  $database->mysqlQuery($sql_menulists); 
	  $num_menuss  = $database->mysqlNumRows($sql_menuss);
	  if($num_menuss){	
	  while($result_menuss  = $database->mysqlFetchArray($sql_menuss)) 
			  {
			  $final=$final + $result_menuss['tot'];
		  }
	   }
	   $finaldata[]=$final;
  // home
	  $final='';
	  $sql_menulists="select sum( tab_netamt) as tot from tbl_takeaway_billmaster 
          where  tab_status='closed' and tab_payment_settled = 'Y' and tab_mode= 'HD' AND tab_dayclosedate $string";
	  $sql_menuss  =  $database->mysqlQuery($sql_menulists); 
	  $num_menuss  = $database->mysqlNumRows($sql_menuss);
	  if($num_menuss){	
	  while($result_menuss  = $database->mysqlFetchArray($sql_menuss)) 
			  {
			  $final=$final + $result_menuss['tot'];
		  }
	   }
	    $finaldata[]=$final;
	   //cs
	   $final='';
	  $sql_menulists="select sum( tab_netamt) as tot from tbl_takeaway_billmaster 
          where  tab_status='closed' and tab_payment_settled = 'Y' and tab_mode= 'CS' AND tab_dayclosedate $string";
	  $sql_menuss  =  $database->mysqlQuery($sql_menulists); 
	  $num_menuss  = $database->mysqlNumRows($sql_menuss);
	  if($num_menuss){	
	  while($result_menuss  = $database->mysqlFetchArray($sql_menuss)) 
			  {
			  $final=$final + $result_menuss['tot'];
		  }
	   }
	   
	   $finaldata[]=$final;
		$insertion1["json"] = json_encode($finaldata);
		echo json_encode($finaldata);
		
}else if($_REQUEST['set']=="load_noofbills")
{
	$string='';
	if($_REQUEST['report']=="m")
	{
	$string.="   between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
	}else  if($_REQUEST['report']=="d")
	{
	$string.=" = '".$_SESSION['date']."'";
	}else  if($_REQUEST['report']=="y")
	{
	$string.="   between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
	}
	$finaldata=array();
   // dine in
	  $final='';
	  $sql_menulists="select  count(bm_billno)  as tot from tbl_tablebillmaster as tm    where  tm.bm_status='Closed'   AND tm.bm_dayclosedate $string ";
	  $sql_menuss  =  $database->mysqlQuery($sql_menulists); 
	  $num_menuss  = $database->mysqlNumRows($sql_menuss);
	  if($num_menuss){	
	  while($result_menuss  = $database->mysqlFetchArray($sql_menuss)) 
			  {
			  $final=$final + $result_menuss['tot'];
		  }
	   }
	   $finaldata[]=$final;
   // take away
	  $final='';
	  $sql_menulists="select count(tab_billno) as tot from tbl_takeaway_billmaster bm where bm.tab_status = 'Closed' and bm.tab_payment_settled='Y' and bm.tab_mode='TA' and bm.tab_dayclosedate $string";
          
	  $sql_menuss  =  $database->mysqlQuery($sql_menulists); 
	  $num_menuss  = $database->mysqlNumRows($sql_menuss);
	  if($num_menuss){	
	  while($result_menuss  = $database->mysqlFetchArray($sql_menuss)) 
			  {
			  $final=$final + $result_menuss['tot'];
		  }
	   }
	   $finaldata[]=$final;
  // home
	  $final='';
	  $sql_menulists="select count(tab_billno) as tot from tbl_takeaway_billmaster bm where bm.tab_status = 'Closed' and bm.tab_payment_settled='Y' and bm.tab_mode='HD' and bm.tab_dayclosedate $string";
	  $sql_menuss  =  $database->mysqlQuery($sql_menulists); 
	  $num_menuss  = $database->mysqlNumRows($sql_menuss);
	  if($num_menuss){	
	  while($result_menuss  = $database->mysqlFetchArray($sql_menuss)) 
			  {
			  $final=$final + $result_menuss['tot'];
		  }
	   }
	   $finaldata[]=$final;
	//cs   
	   $final='';
	  $sql_menulists="select count(tab_billno) as tot from tbl_takeaway_billmaster bm where bm.tab_status = 'Closed' and bm.tab_payment_settled='Y' and bm.tab_mode='CS' and bm.tab_dayclosedate $string";
	  $sql_menuss  =  $database->mysqlQuery($sql_menulists); 
	  $num_menuss  = $database->mysqlNumRows($sql_menuss);
	  if($num_menuss){	
	  while($result_menuss  = $database->mysqlFetchArray($sql_menuss)) 
			  {
			  $final=$final + $result_menuss['tot'];
		  }
	   }
	   $finaldata[]=$final;
		$insertion1["json"] = json_encode($finaldata);
		echo json_encode($finaldata);
}else if($_REQUEST['set']=="load_monthlybill_dine")
{
	$string='';
	$month=date("m");
	$year=date("Y");
	if($_REQUEST['report']=="m")
	{
	$string.="   between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
	}else  if($_REQUEST['report']=="d")
	{
	$string.=" = '".$_SESSION['date']."'";
	}else  if($_REQUEST['report']=="y")
	{
	$string.="   between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
	}
	$finaldata=array();//select (count(bm_billno)) as tot from tbl_tablebillmaster where bm_status='Closed' AND MONTH(bm_dayclosedate)='02'
	$mainarray=array();
	$days_in_month=cal_days_in_month(CAL_GREGORIAN,$month,$year);
	for($i=1;$i<=$days_in_month;$i++)
	{
		if($i<10)
		{
			$day="0".$i;
		}else
		{
		$day=$i;
		}
		$sql_menulists="select (count(bm_billno)) as tot from tbl_tablebillmaster where bm_status='Closed' AND MONTH(bm_dayclosedate)='".$month."' AND DAY(bm_dayclosedate)='".$day."' AND YEAR(bm_dayclosedate)='".$year."'";
		  $sql_menuss  =  $database->mysqlQuery($sql_menulists); 
		  $num_menuss  = $database->mysqlNumRows($sql_menuss);
		  if($num_menuss){	
		  while($result_menuss  = $database->mysqlFetchArray($sql_menuss)) 
				  {
				  $mainarray[$i]=$result_menuss['tot'];//$i.",".
				  }
		   }
	}
	//print_r($mainarray);
	$insertion1["json"] = json_encode($mainarray);
	echo json_encode($mainarray);
}else if($_REQUEST['set']=="load_monthlybill_ta")
{
	$string='';
	$month=date("m");
	$year=date("Y");
	
	if($_REQUEST['report']=="m")
	{
	$string.="   between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
	}else  if($_REQUEST['report']=="d")
	{
	$string.=" = '".$_SESSION['date']."'";
	}else  if($_REQUEST['report']=="y")
	{
	$string.="   between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
	}
	$finaldata=array();//select (count(bm_billno)) as tot from tbl_tablebillmaster where bm_status='Closed' AND MONTH(bm_dayclosedate)='02'
	$mainarray=array();
	$days_in_month=cal_days_in_month(CAL_GREGORIAN,$month,$year);
	for($i=1;$i<=$days_in_month;$i++)
	{
		if($i<10)
		{
			$day="0".$i;
		}else
		{
		$day=$i;
		}
		$sql_menulists="select  count(tab_billno)  as tot from tbl_takeaway_billmaster    where  MONTH(tab_dayclosedate)='".$month."' AND DAY(tab_dayclosedate)='".$day."' AND YEAR(tab_dayclosedate)='".$year."'";
                //echo "select  ((count((tab_billno))))  as tot from tbl_takeaway_billmaster    where  tab_status='Delivered'   AND MONTH(tab_dayclosedate)='".$month."' AND DAY(tab_dayclosedate)='".$day."' AND YEAR(tab_dayclosedate)='".$year."'";
		$sql_menuss  =  $database->mysqlQuery($sql_menulists); 
		$num_menuss  = $database->mysqlNumRows($sql_menuss);
		if($num_menuss){	
		while($result_menuss  = $database->mysqlFetchArray($sql_menuss)) 
				{
				  $mainarray[$i]=$result_menuss['tot'];//$i.",".
				  }
		   }
	}
	//print_r($mainarray);
	$insertion1["json"] = json_encode($mainarray);
	echo json_encode($mainarray);
}else if($_REQUEST['set']=="load_totalsalemonthly")
{
	$month=date("m");
	$year=date("Y");
	if($_REQUEST['report']=="m")
	{
	$string.="   between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
	}else  if($_REQUEST['report']=="d")
	{
	$string.=" = '".$_SESSION['date']."'";
	}else  if($_REQUEST['report']=="y")
	{
	$string.="   between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
	}
	$finaldata=array();//select (count(bm_billno)) as tot from tbl_tablebillmaster where bm_status='Closed' AND MONTH(bm_dayclosedate)='02'
	$mainarray=array();
	if(isset($_REQUEST['type']))
	{
		
			$days_in_month=cal_days_in_month(CAL_GREGORIAN,$month,$year);
			
			$sql_menulists="SELECT DAY(bm_dayclosedate) as dayv,MONTH(bm_dayclosedate) as monthv,YEAR(bm_dayclosedate) as yearv, COUNT(*) FROM `tbl_tablebillmaster` WHERE DATE(bm_dayclosedate ) > DATE_SUB( '".$_SESSION['date']."' , INTERVAL 1 WEEK ) GROUP BY DAYNAME(bm_dayclosedate) ORDER BY bm_dayclosedate";
				$sql_menuss  =  $database->mysqlQuery($sql_menulists); 
				$num_menuss  = $database->mysqlNumRows($sql_menuss);
				if($num_menuss){unset($mainarray);	
				while($result_menuss  = $database->mysqlFetchArray($sql_menuss)) 
						{
							
							if($result_menuss['dayv']<10)
							{
								$day="0".$result_menuss['dayv'];
							}else
							{
							$day=$result_menuss['dayv'];
							}
							if($result_menuss['monthv']<10)
							{
								$month="0".$result_menuss['monthv'];
							}else
							{
							$month=$result_menuss['monthv'];
							}
							if($_REQUEST['type']=="totalsale")
							{
								$sql_menulists1="SELECT (sum(bm_finaltotal)) as tot FROM tbl_tablebillmaster where bm_status='Closed' AND   MONTH(bm_dayclosedate)='".$month."' AND DAY(bm_dayclosedate)='".$day."' AND YEAR(bm_dayclosedate)='".$result_menuss['yearv']."'";
								$sql_menuss1  =  $database->mysqlQuery($sql_menulists1); 
								$num_menuss1  = $database->mysqlNumRows($sql_menuss1);
								if($num_menuss1){	
								while($result_menuss1  = $database->mysqlFetchArray($sql_menuss1)) 
										{
										  $mainarray[]=$result_menuss1['tot'];
										  }
								   }
							}else if($_REQUEST['type']=="cashsale")
							{
								$sql_menulists1="select (sum(bm_amountpaid) - sum(bm_amountbalace))  as tot FROM tbl_tablebillmaster where bm_status='Closed' AND   MONTH(bm_dayclosedate)='".$month."' AND DAY(bm_dayclosedate)='".$day."' AND YEAR(bm_dayclosedate)='".$result_menuss['yearv']."'";
								$sql_menuss1  =  $database->mysqlQuery($sql_menulists1); 
								$num_menuss1  = $database->mysqlNumRows($sql_menuss1);
								if($num_menuss1){	
								while($result_menuss1  = $database->mysqlFetchArray($sql_menuss1)) 
										{
										  $mainarray[]=$result_menuss1['tot'];
										  }
								   }
								
							}
							else if($_REQUEST['type']=="cardsale")
							{
								$sql_menulists1="select  (sum(bm_transactionamount))  as tot from tbl_tablebillmaster  where bm_status='Closed' AND   MONTH(bm_dayclosedate)='".$month."' AND DAY(bm_dayclosedate)='".$day."' AND YEAR(bm_dayclosedate)='".$result_menuss['yearv']."'";
								$sql_menuss1  =  $database->mysqlQuery($sql_menulists1); 
								$num_menuss1  = $database->mysqlNumRows($sql_menuss1);
								if($num_menuss1){	
								while($result_menuss1  = $database->mysqlFetchArray($sql_menuss1)) 
										{
										  $mainarray[]=$result_menuss1['tot'];
										  }
								   }
								
							}else if($_REQUEST['type']=="creditsale")
							{
								$sql_menulists1="select  (sum(bm_finaltotal))  as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where  tbl_tablebillmaster.bm_status='Closed' AND  tbl_paymentmode.pym_code='credit_person'  AND  MONTH(tbl_tablebillmaster.bm_dayclosedate)='".$month."' AND DAY(tbl_tablebillmaster.bm_dayclosedate)='".$day."' AND YEAR(tbl_tablebillmaster.bm_dayclosedate)='".$result_menuss['yearv']."'";
								$sql_menuss1  =  $database->mysqlQuery($sql_menulists1); 
								$num_menuss1  = $database->mysqlNumRows($sql_menuss1);
								if($num_menuss1){	
								while($result_menuss1  = $database->mysqlFetchArray($sql_menuss1)) 
										{
											if($result_menuss1['tot']=='')
											{
												$mainarray[]='0.00';
											}else
											{
										  $mainarray[]=$result_menuss1['tot'];
											}
										  }
								   }
								
							}else if($_REQUEST['type']=="compsale")
							{
								$sql_menulists1="select  (sum(bm_finaltotal))  as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where  tbl_tablebillmaster.bm_status='Closed' AND  tbl_paymentmode.pym_code='complimentary'  AND  MONTH(tbl_tablebillmaster.bm_dayclosedate)='".$month."' AND DAY(tbl_tablebillmaster.bm_dayclosedate)='".$day."' AND YEAR(tbl_tablebillmaster.bm_dayclosedate)='".$result_menuss['yearv']."'";
								$sql_menuss1  =  $database->mysqlQuery($sql_menulists1); 
								$num_menuss1  = $database->mysqlNumRows($sql_menuss1);
								if($num_menuss1){	
								while($result_menuss1  = $database->mysqlFetchArray($sql_menuss1)) 
										{
											if($result_menuss1['tot']=='')
											{
												$mainarray[]='0.00';
											}else
											{
										  $mainarray[]=$result_menuss1['tot'];
											}
										  }
								   }
								
							}else if($_REQUEST['type']=="totalbills")
							{
								$sql_menulists1="select  (count(bm_billno))  as tot from tbl_tablebillmaster   where  MONTH(tbl_tablebillmaster.bm_dayclosedate)='".$month."' AND DAY(tbl_tablebillmaster.bm_dayclosedate)='".$day."' AND YEAR(tbl_tablebillmaster.bm_dayclosedate)='".$result_menuss['yearv']."'";
								$sql_menuss1  =  $database->mysqlQuery($sql_menulists1); 
								$num_menuss1  = $database->mysqlNumRows($sql_menuss1);
								if($num_menuss1){	
								while($result_menuss1  = $database->mysqlFetchArray($sql_menuss1)) 
										{
											if($result_menuss1['tot']=='')
											{
												$mainarray[]='0.00';
											}else
											{
										  $mainarray[]=$result_menuss1['tot'];
											}
										  }
								   }
								
							}else if($_REQUEST['type']=="totalbillscancled")
							{
								$sql_menulists1="select (count(bm_billno))  as tot from tbl_tablebillmaster  where (tbl_tablebillmaster.bm_status='Cancelled' or tbl_tablebillmaster.bm_status='Cancelled for Split') AND  MONTH(tbl_tablebillmaster.bm_dayclosedate)='".$month."' AND DAY(tbl_tablebillmaster.bm_dayclosedate)='".$day."' AND YEAR(tbl_tablebillmaster.bm_dayclosedate)='".$result_menuss['yearv']."'";
								$sql_menuss1  =  $database->mysqlQuery($sql_menulists1); 
								$num_menuss1  = $database->mysqlNumRows($sql_menuss1);
								if($num_menuss1){	
								while($result_menuss1  = $database->mysqlFetchArray($sql_menuss1)) 
										{
											if($result_menuss1['tot']=='')
											{
												$mainarray[]='0.00';
											}else
											{
										  $mainarray[]=$result_menuss1['tot'];
											}
										  }
								   }
								
							}else if($_REQUEST['type']=="totalitemcancled")
							{
								$sql_menulists1="select (count(bm.bm_billno)) as tot from tbl_tablebilldetails as bd LEFT JOIN tbl_tablebillmaster as bm ON bd.bd_billno=bm.bm_billno where bd.bd_cancelled='Y' AND  MONTH(bm.bm_dayclosedate)='".$month."' AND DAY(bm.bm_dayclosedate)='".$day."' AND YEAR(bm.bm_dayclosedate)='".$result_menuss['yearv']."'";
								$sql_menuss1  =  $database->mysqlQuery($sql_menulists1); 
								$num_menuss1  = $database->mysqlNumRows($sql_menuss1);
								if($num_menuss1){	
								while($result_menuss1  = $database->mysqlFetchArray($sql_menuss1)) 
										{
											if($result_menuss1['tot']=='')
											{
												$mainarray[]='0.00';
											}else
											{
										  $mainarray[]=$result_menuss1['tot'];
											}
										  }
								   }
								
							}
							 
						}
				}
		
		
	}
	$insertion1["json"] = json_encode($mainarray);
	echo json_encode($mainarray);
}
?>