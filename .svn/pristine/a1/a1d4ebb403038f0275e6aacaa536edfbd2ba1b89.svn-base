
<?php
include('includes/session.php');		// Check session
//session_start();
include("database.class.php"); // DB Connection class
$database	= new Database(); 		// Create a new instance
error_reporting(0);

if(($_REQUEST['type']=="tot_sales_an"))
{
	$string="";
	if(isset($_REQUEST['set']))
	{
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string= " bm_dayclosedate between '".$from."' and '".$to."' group by bm_dayclosedate order by totamt DESC";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string= " bm_dayclosedate between '".$from."' and '".$to."' group by bm_dayclosedate order by totamt DESC";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string= " bm_dayclosedate between '".$from."' and '".$to."' group by bm_dayclosedate order by totamt DESC";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']=="")
		{
			$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string= " bm_dayclosedate between '".$from."' and '".$to."' group by bm_dayclosedate order by totamt DESC";
		}
	}
	else if(isset($_REQUEST['newsearch']))
	{
		$bydatz=$_REQUEST['paymenttyp'];
		  if($bydatz!="null")
		  {
			  //Today Yesterday Last5days Last10days Last15days Last20days Last25days Last30days Last1month Last3months Last6months Last1year
			  if($bydatz=="Today")
			  {
				  $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( ) "; 
			  }else if($bydatz=="Yesterday")
			  {
				  $string.="bm_dayclosedate = CURDATE() - 1 group by bm_dayclosedate order by totamt DESC";
			  }else if($bydatz=="Last5days")
			  {
				  $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( ) group by bm_dayclosedate order by totamt DESC";
			  }elseif($bydatz=="Last10days")
			  {
				  $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( ) group by bm_dayclosedate order by totamt DESC";
			  }
			  elseif($bydatz=="Last15days")
			  {
				  $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( ) group by bm_dayclosedate order by totamt DESC";
			  }
			  else if($bydatz=="Last20days")
			  {
				  $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( ) group by bm_dayclosedate order by totamt DESC";
			  }
			  else if($bydatz=="Last25days")
			  {
				  $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( ) group by bm_dayclosedate order by totamt DESC";
			  }
			  else if($bydatz=="Last30days")
			  {
				  $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 30  DAY AND CURDATE( ) group by bm_dayclosedate order by totamt DESC";
			  }
			  else if($bydatz=="Last1month")
			  {
				  $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) group by bm_dayclosedate order by totamt DESC";
			  }
			  else if($bydatz=="Last3months")
			  {
				  $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( ) group by bm_dayclosedate order by totamt DESC"; 
			  }
			  else if($bydatz=="Last6months")
			  {
				  $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( ) group by bm_dayclosedate order by totamt DESC"; 
			  }
			  else if($bydatz=="Last1year")
			  {
				  $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( ) group by bm_dayclosedate order by totamt DESC"; 
			  }
		  }
		  else
		  {
			  $from=date("Y-m-d");
			  $to=date("Y-m-d");
			  $string.= "bm_dayclosedate between '".$from."' and '".$to."' group by bm_dayclosedate order by totamt DESC ";
		  }
	}
	else
	{
		$cur=date("Y-m-d");
		$from=$cur;
		$to=$cur;
		$string= " bm_dayclosedate between '".$from."' and '".$to."'  group by bm_dayclosedate order by totamt DESC ";
	}

  $sql_login  =  $database->mysqlQuery("select  bm_dayclosedate as bdate,sum(`bm_finaltotal`) as totamt from tbl_tablebillmaster where $string "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login)
	  {
			echo "ok";
	  }else
	  {
		  echo "sorry";
	  }

}else if(($_REQUEST['type']=="totitemwisechk"))
{
	
	//$sql="SELECT count(*) as ct,mm.mr_menuname FROM tbl_tablebilldetails as bd LEFT JOIN tbl_tablebillmaster as bm ON bd.bd_billno=bm.bm_billno LEFT JOIN tbl_menumaster as mm ON mm.mr_menuid=bd.bd_menuid WHERE bm.bm_dayclosedate = '2015-08-11' Group By mm.mr_menuname order by ct DESC";
	//$sql="SELECT count(*) as ct,mm.mr_menuname FROM tbl_tablebilldetails as bd LEFT JOIN tbl_tablebillmaster as bm ON bd.bd_billno=bm.bm_billno LEFT JOIN tbl_menumaster as mm ON mm.mr_menuid=bd.bd_menuid WHERE bm.bm_dayclosedate between '2015-08-10' and '2015-08-18' Group By mm.mr_menuname order by ct DESC";
	$string="";
	
	if(isset($_REQUEST['set']))
	{
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string= " bm.bm_dayclosedate between '".$from."' and '".$to."' Group By mm.mr_itemshortcode order by ct DESC";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string= " bm.bm_dayclosedate between '".$from."' and '".$to."' Group By mm.mr_itemshortcode order by ct DESC";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string= " bm.bm_dayclosedate between '".$from."' and '".$to."' Group By mm.mr_itemshortcode order by ct DESC";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']=="")
		{
			$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string= " bm.bm_dayclosedate between '".$from."' and '".$to."' Group By mm.mr_itemshortcode order by ct DESC";
		}
	}
	else if(isset($_REQUEST['newsearch']))
	{
		  $bydatz=$_REQUEST['paymenttyp'];
		  if($bydatz!="null")
		  {
			  //Today Yesterday Last5days Last10days Last15days Last20days Last25days Last30days Last1month Last3months Last6months Last1year
			  if($bydatz=="Today")
			  {
				  $string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( ) "; 
			  }else if($bydatz=="Yesterday")
			  {
				  $string.="bm.bm_dayclosedate = CURDATE() - 1 Group By mm.mr_itemshortcode order by ct DESC";
			  }else if($bydatz=="Last5days")
			  {
				  $string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( ) Group By mm.mr_itemshortcode order by ct DESC";
			  }elseif($bydatz=="Last10days")
			  {
				  $string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( ) Group By mm.mr_itemshortcode order by ct DESC";
			  }
			  elseif($bydatz=="Last15days")
			  {
				  $string.=" bm.bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( ) Group By mm.mr_itemshortcode order by ct DESC";
			  }
			  else if($bydatz=="Last20days")
			  {
				  $string.=" bm.bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( ) Group By mm.mr_itemshortcode order by ct DESC";
			  }
			  else if($bydatz=="Last25days")
			  {
				  $string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( ) Group By mm.mr_itemshortcode order by ct DESC";
			  }
			  else if($bydatz=="Last30days")
			  {
				  $string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 30  DAY AND CURDATE( ) Group By mm.mr_itemshortcode order by ct DESC";
			  }
			  else if($bydatz=="Last1month")
			  {
				  $string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) Group By mm.mr_itemshortcode order by ct DESC";
			  }
			  else if($bydatz=="Last3months")
			  {
				  $string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( ) Group By mm.mr_itemshortcode order by ct DESC"; 
			  }
			  else if($bydatz=="Last6months")
			  {
				  $string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( ) Group By mm.mr_itemshortcode order by ct DESC"; 
			  }
			  else if($bydatz=="Last1year")
			  {
				  $string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( ) Group By mm.mr_itemshortcode order by ct DESC"; 
			  }
		  }
		  else
		  {
			  $from=date("Y-m-d");
			  $to=date("Y-m-d");
			  $string.= "bm.bm_dayclosedate between '".$from."' and '".$to."' Group By mm.mr_itemshortcode order by ct DESC";
		  }
	}else
	{
		$cur=date("Y-m-d");
		$from=$cur;
		$to=$cur;
		$string= " bm.bm_dayclosedate between '".$from."' and '".$to."' Group By mm.mr_itemshortcode order by ct DESC";
	}
	
	$sql_login  =  $database->mysqlQuery("SELECT count(*) as ct,mm.mr_itemshortcode FROM tbl_tablebilldetails as bd LEFT JOIN tbl_tablebillmaster as bm ON bd.bd_billno=bm.bm_billno LEFT JOIN tbl_menumaster as mm ON mm.mr_menuid=bd.bd_menuid WHERE $string "); 
	$num_login   = $database->mysqlNumRows($sql_login);
	
	if($num_login)
	{
		  echo "ok";
	}else
	{
		echo "sorry";
	}
}else if(($_REQUEST['type']=="itemwisechk"))
{
	//tbl_tablebilldetails(bd_billno, bd_billslno, bd_menuid, bd_portion, bd_rate, bd_qty, bd_amount, bd_type, bd_printbill)
	//tbl_tablebillmaster(bm_billno, bm_dayclosedate, bm_billtime, bm_branchid, bm_floorid, bm_subtotal, bm_cancelamount, bm_servicecharge, bm_servicetax, bm_vat, bm_finaltotal, bm_paymode, bm_discountid, bm_corporatecode, bm_discountvalue, bm_credit, bm_creditroom, bm_creditstaff, bm_complimentary, bm_complimentaryremark, bm_amountbalace, bm_transactionamount, bm_amountpaid, bm_voucherid, bm_couponcompany, bm_couponamt, bm_chequeno, bm_chequebankname, bm_chequebankamount)
	//tbl_menumaster(mr_menuid, mr_menuname, mr_maincatid, mr_subcatid, mr_description, mr_diet, mr_time_min, mr_active, mr_kotcounter, mr_modifieddate, mr_modifieduser, mr_rating, mr_prepmode, mr_headofficeid, mr_branchadd, mr_branchid, mr_itemshortcode, mr_dailystock)
	
	//$sql="SELECT bm.bm_dayclosedate,mm.mr_menuname FROM tbl_tablebilldetails as bd LEFT JOIN  tbl_tablebillmaster as bm ON bd.bd_billno=bm.bm_billno LEFT JOIN tbl_menumaster as mm ON mm.mr_menuid=bd.bd_menuid WHERE bm.bm_dayclosedate between '2015-08-10' and '2015-08-18'";
	//$sql="SELECT count(*)  as ct,bm.bm_dayclosedate,mm.mr_menuname FROM tbl_tablebilldetails as bd LEFT JOIN  tbl_tablebillmaster as bm ON bd.bd_billno=bm.bm_billno LEFT JOIN tbl_menumaster as mm ON mm.mr_menuid=bd.bd_menuid WHERE bm.bm_dayclosedate between '2015-08-10' and '2015-08-18' group by  mm.mr_menuname order by ct";
	$sql="SELECT count(*) as ct,mm.mr_menuname FROM tbl_tablebilldetails as bd LEFT JOIN tbl_tablebillmaster as bm ON bd.bd_billno=bm.bm_billno LEFT JOIN tbl_menumaster as mm ON mm.mr_menuid=bd.bd_menuid WHERE bm.bm_dayclosedate = '2015-08-11' Group By mm.mr_menuname order by ct DESC";
	$sql="SELECT count(*) as ct,mm.mr_menuname FROM tbl_tablebilldetails as bd LEFT JOIN tbl_tablebillmaster as bm ON bd.bd_billno=bm.bm_billno LEFT JOIN tbl_menumaster as mm ON mm.mr_menuid=bd.bd_menuid WHERE bm.bm_dayclosedate between '2015-08-10' and '2015-08-18' AND mm.mr_menuid='' Group By mm.mr_menuname order by ct DESC";
	$sql="SELECT count(*) as ct,mm.mr_menuname,bm.bm_dayclosedate FROM tbl_tablebilldetails as bd LEFT JOIN tbl_tablebillmaster as bm ON bd.bd_billno=bm.bm_billno LEFT JOIN tbl_menumaster as mm ON mm.mr_menuid=bd.bd_menuid WHERE bm.bm_dayclosedate between '2015-08-10' and '2015-08-18' AND mm.mr_menuid='EX-MENU1' Group By mm.mr_menuname,bm.bm_dayclosedate order by ct DESC";
	$string="";
	$itemid=$_REQUEST['itemid'];
	$string=" mm.mr_menuid='".$itemid."' ";
	if(isset($_REQUEST['set']))
	{
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " AND bm.bm_dayclosedate between '".$from."' and '".$to."' Group By mm.mr_itemshortcode,bm.bm_dayclosedate order by ct DESC";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " AND bm.bm_dayclosedate between '".$from."' and '".$to."' Group By mm.mr_itemshortcode,bm.bm_dayclosedate order by ct DESC";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " AND bm.bm_dayclosedate between '".$from."' and '".$to."' Group By mm.mr_itemshortcode,bm.bm_dayclosedate order by ct DESC";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']=="")
		{
			$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " AND bm.bm_dayclosedate between '".$from."' and '".$to."' Group By mm.mr_menuname,bm.bm_dayclosedate order by ct DESC";
		}
	}
	else if(isset($_REQUEST['newsearch']))
	{

				$bydatz=$_REQUEST['paymenttyp'];
				  if($bydatz!="null")
				  {
					  //Today Yesterday Last5days Last10days Last15days Last20days Last25days Last30days Last1month Last3months Last6months Last1year
					  if($bydatz=="Today")
					  {
						  $statusname="Today";
						  $string.=" AND bm.bm_dayclosedate = (CURDATE( )) Group By mm.mr_itemshortcode,bm.bm_dayclosedate  order by ct DESC"; 
					  }else if($bydatz=="Yesterday")
					  {
						  $statusname="Yesterday";
						  $string.=" AND bm.bm_dayclosedate = (CURDATE( ) - 1  ) Group By mm.mr_itemshortcode,bm.bm_dayclosedate  order by ct DESC";
					  }else if($bydatz=="Last5days")
					  {
						  $statusname="Last 5 days";
						  $string.=" AND bm.bm_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( ) Group By mm.mr_itemshortcode,bm.bm_dayclosedate  order by ct DESC";
					  }elseif($bydatz=="Last10days")
					  {
						  $statusname="Last 10 days";
						  $string.=" AND bm.bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( ) Group By mm.mr_itemshortcode,bm.bm_dayclosedate  order by ct DESC";
					  }
					  elseif($bydatz=="Last15days")
					  {
						  $statusname="Today";
						  $string.=" AND  bm.bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( ) Group By mm.mr_itemshortcode,bm.bm_dayclosedate  order by ct DESC";
					  }
					  else if($bydatz=="Last20days")
					  {
						  $statusname="Last 20 days";
						  $string.=" AND  bm.bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( ) Group By mm.mr_itemshortcode,bm.bm_dayclosedate  order by ct DESC";
					  }
					  else if($bydatz=="Last25days")
					  {
						  $statusname="Last 25 days";
						  $string.=" AND bm.bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( ) Group By mm.mr_itemshortcode,bm.bm_dayclosedate  order by ct DESC";
					  }
					  else if($bydatz=="Last30days")
					  {
						  $statusname="Last 30 days";
						  $string.=" AND bm.bm_dayclosedate between CURDATE( ) - INTERVAL 30  DAY AND CURDATE( ) Group By mm.mr_itemshortcode,bm.bm_dayclosedate  order by ct DESC";
					  }
					  else if($bydatz=="Last1month")
					  {
						  $statusname="Last month";
						  $string.=" AND bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) Group By mm.mr_itemshortcode,bm.bm_dayclosedate  order by ct DESC";
					  }
					  else if($bydatz=="Last3months")
					  {
						  $statusname="Last 3 months";
						  $string.=" AND bm.bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( ) Group By mm.mr_itemshortcode,bm.bm_dayclosedate  order by ct DESC"; 
					  }
					  else if($bydatz=="Last6months")
					  {
						  $statusname="Last 6 months";
						  $string.=" AND bm.bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( ) Group By mm.mr_itemshortcode,bm.bm_dayclosedate  order by ct DESC"; 
					  }
					  else if($bydatz=="Last1year")
					  {
						  $statusname="Last year";
						  $string.=" AND bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( ) Group By mm.mr_itemshortcode,bm.bm_dayclosedate  order by ct DESC"; 
					  }
				  }
				  else
				  {
					  $statusname="Today";
					  $from=date("Y-m-d");
					  $to=date("Y-m-d");
					  $string.= " AND bm.bm_dayclosedate between '".$from."' and '".$to."' Group By mm.mr_itemshortcode,bm.bm_dayclosedate  order by ct DESC ";
				  }
	}else
	{
		$cur=date("Y-m-d");
		$from=$cur;
		$to=$cur;
		$string.= " AND bm.bm_dayclosedate between '".$from."' and '".$to."' Group By mm.mr_itemshortcode,bm.bm_dayclosedate order by ct DESC";
	}
	
	$sql_login  =  $database->mysqlQuery("SELECT count(*) as ct,mm.mr_itemshortcode,bm.bm_dayclosedate FROM tbl_tablebilldetails as bd LEFT JOIN tbl_tablebillmaster as bm ON bd.bd_billno=bm.bm_billno LEFT JOIN tbl_menumaster as mm ON mm.mr_menuid=bd.bd_menuid WHERE $string "); 
	$num_login   = $database->mysqlNumRows($sql_login);
	
	if($num_login)
	{
		  echo "ok";
	}else
	{
		echo "sorry";
	}
	//echo "SELECT count(*) as ct,mm.mr_menuname,bm.bm_dayclosedate FROM tbl_tablebilldetails as bd LEFT JOIN tbl_tablebillmaster as bm ON bd.bd_billno=bm.bm_billno LEFT JOIN tbl_menumaster as mm ON mm.mr_menuid=bd.bd_menuid WHERE $string ";
}else if(($_REQUEST['type']=="totcompare"))
{
	$string="";
	if(isset($_REQUEST['set']))
	{
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string= " bm_dayclosedate between '".$from."' and '".$to."' group by bm_dayclosedate order by totamt DESC";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string= " bm_dayclosedate between '".$from."' and '".$to."' group by bm_dayclosedate order by totamt DESC";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string= " bm_dayclosedate between '".$from."' and '".$to."' group by bm_dayclosedate order by totamt DESC";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']=="")
		{
			$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string= " bm_dayclosedate between '".$from."' and '".$to."' group by bm_dayclosedate order by totamt DESC";
		}
	}
	else if(isset($_REQUEST['newsearch']))
	{
		$bydatz=$_REQUEST['paymenttyp'];
		  if($bydatz!="null")
		  {
			  //Today Yesterday Last5days Last10days Last15days Last20days Last25days Last30days Last1month Last3months Last6months Last1year
			  if($bydatz=="Today")
			  {
				  $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( ) "; 
			  }else if($bydatz=="Yesterday")
			  {
				  $string.="bm_dayclosedate = CURDATE() - 1 group by bm_dayclosedate order by totamt DESC";
			  }else if($bydatz=="Last5days")
			  {
				  $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( ) group by bm_dayclosedate order by totamt DESC";
			  }elseif($bydatz=="Last10days")
			  {
				  $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( ) group by bm_dayclosedate order by totamt DESC";
			  }
			  elseif($bydatz=="Last15days")
			  {
				  $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( ) group by bm_dayclosedate order by totamt DESC";
			  }
			  else if($bydatz=="Last20days")
			  {
				  $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( ) group by bm_dayclosedate order by totamt DESC";
			  }
			  else if($bydatz=="Last25days")
			  {
				  $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( ) group by bm_dayclosedate order by totamt DESC";
			  }
			  else if($bydatz=="Last30days")
			  {
				  $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 30  DAY AND CURDATE( ) group by bm_dayclosedate order by totamt DESC";
			  }
			  else if($bydatz=="Last1month")
			  {
				  $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) group by bm_dayclosedate order by totamt DESC";
			  }
			  else if($bydatz=="Last3months")
			  {
				  $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( ) group by bm_dayclosedate order by totamt DESC"; 
			  }
			  else if($bydatz=="Last6months")
			  {
				  $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( ) group by bm_dayclosedate order by totamt DESC"; 
			  }
			  else if($bydatz=="Last1year")
			  {
				  $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( ) group by bm_dayclosedate order by totamt DESC"; 
			  }
		  }
		  else
		  {
			  $from=date("Y-m-d");
			  $to=date("Y-m-d");
			  $string.= "bm_dayclosedate between '".$from."' and '".$to."' group by bm_dayclosedate order by totamt DESC ";
		  }
	}
	else
	{
		$cur=date("Y-m-d");
		$from=$cur;
		$to=$cur;
		$string= " bm_dayclosedate between '".$from."' and '".$to."'  group by bm_dayclosedate order by totamt DESC ";
	}

      $sql_login  =  $database->mysqlQuery("select  bm_dayclosedate as bdate,sum(`bm_finaltotal`) as totamt from tbl_tablebillmaster where $string "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login)
	  {
			echo "ok";
	  }else
	  {
		  echo "sorry";
	  }

}else if(($_REQUEST['type']=="checkstaffwise"))
{
	$string="";
	if(isset($_REQUEST['set']))
	{
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string= " tm.bm_dayclosedate between '".$from."' and '".$to."' ";
			$string_2= " tbl_takeaway_billmaster.tab_date between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string= " tm.bm_dayclosedate between '".$from."' and '".$to."' ";
			$string_2= " tbl_takeaway_billmaster.tab_date between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string= " tm.bm_dayclosedate between '".$from."' and '".$to."' ";
			$string_2= " tbl_takeaway_billmaster.tab_date between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']=="")
		{
			$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string= " tm.bm_dayclosedate between '".$from."' and '".$to."' ";
			$string_2= " tbl_takeaway_billmaster.tab_date between '".$from."' and '".$to."' ";
		}
	}
	else if(isset($_REQUEST['newsearch']))
	{
		$bydatz=$_REQUEST['paymenttyp'];
		  if($bydatz!="null")
		  {
			  //Today Yesterday Last5days Last10days Last15days Last20days Last25days Last30days Last1month Last3months Last6months Last1year
			  if($bydatz=="Today")
			  {
				  $string.=" tm.bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( ) "; 
				  $string_2= " tbl_takeaway_billmaster.tab_date between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( ) ";
			  }else if($bydatz=="Yesterday")
			  {
				  $string.=" tm.bm_dayclosedate = CURDATE() - 1 ";
				   $string_2= " tbl_takeaway_billmaster.tab_date = CURDATE() - 1  ";
			  }else if($bydatz=="Last5days")
			  {
				  $string.=" tm.bm_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( ) ";
				   $string_2= " tbl_takeaway_billmaster.tab_date between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( ) ";
			  }elseif($bydatz=="Last10days")
			  {
				  $string.=" tm.bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( ) ";
				   $string_2= " tbl_takeaway_billmaster.tab_date between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
			  }
			  elseif($bydatz=="Last15days")
			  {
				  $string.=" tm.bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( ) ";
				   $string_2= " tbl_takeaway_billmaster.tab_date between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( ) ";
			  }
			  else if($bydatz=="Last20days")
			  {
				  $string.=" tm.bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( ) ";
				   $string_2= " tbl_takeaway_billmaster.tab_date between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( ) ";
			  }
			  else if($bydatz=="Last25days")
			  {
				  $string.=" tm.bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( ) ";
				   $string_2= " tbl_takeaway_billmaster.tab_date between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( ) ";
			  }
			  else if($bydatz=="Last30days")
			  {
				  $string.=" tm.bm_dayclosedate between CURDATE( ) - INTERVAL 30  DAY AND CURDATE( ) ";
				   $string_2= " tbl_takeaway_billmaster.tab_date between CURDATE( ) - INTERVAL 30  DAY AND CURDATE( ) ";
			  }
			  else if($bydatz=="Last1month")
			  {
				  $string.=" tm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
				   $string_2= " tbl_takeaway_billmaster.tab_date between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
			  }
			  else if($bydatz=="Last3months")
			  {
				  $string.=" tm.bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( ) "; 
				   $string_2= " tbl_takeaway_billmaster.tab_date between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( ) ";
			  }
			  else if($bydatz=="Last6months")
			  {
				  $string.=" tm.bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( ) ";
				   $string_2= " tbl_takeaway_billmaster.tab_date between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )  "; 
			  }
			  else if($bydatz=="Last1year")
			  {
				  $string.=" tm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( ) "; 
				   $string_2= " tbl_takeaway_billmaster.tab_date between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
			  }
		  }
		  else
		  {
			  $from=date("Y-m-d");
			  $to=date("Y-m-d");
			  $string.= " tm.bm_dayclosedate between '".$from."' and '".$to."'  ";
			   $string_2= " tbl_takeaway_billmaster.tab_date between '".$from."' and '".$to."' ";
		  }
	}
	else
	{
		$cur=date("Y-m-d");
		$from=$cur;
		$to=$cur;
		$string= " tm.bm_dayclosedate between '".$from."' and '".$to."'   ";
		 $string_2= " tbl_takeaway_billmaster.tab_date between '".$from."' and '".$to."' ";
	}
	$finalstring="";
	if($_REQUEST['modetype']=="dinein")
	{
		$stf="";$stfjoin="";
		if(isset($_REQUEST['staffval']))
		{
			if($_REQUEST['staffval']!="")
			{
			$stfjoin=" LEFT JOIN tbl_tableorder as tor ON tor.ter_billnumber=tm.bm_billno";
			$stf=" tor.ter_staff=  '".$_REQUEST['staffval']."' AND ";
			}
		}
		$last=" GROUP BY tm.bm_dayclosedate ";
		$finalstring=$stf.$string.$last;
		$sql_login  =  $database->mysqlQuery("Select SUM(tm.bm_finaltotal),tm.bm_dayclosedate From tbl_tablebillmaster as tm $stfjoin Where $finalstring ");
		
	}else
	{
		$stf="";$stfjoin="";
		if(isset($_REQUEST['staffval']))
		{
			if($_REQUEST['staffval']!="")
			{
			$stfjoin=" Inner Join tbl_staffmaster On tbl_takeaway_billmaster.tab_assignedto = tbl_staffmaster.ser_staffid ";
			$stf=" tbl_takeaway_billmaster.tab_assignedto =  '".$_REQUEST['staffval']."' AND ";
			}
		}
		$last_2="  Group By tbl_takeaway_billmaster.tab_date";
		$finalstring=$stf.$string_2.$last_2;
		$sql_login  =  $database->mysqlQuery("Select sum(tbl_takeaway_billmaster.tab_netamt),tbl_takeaway_billmaster.tab_date From tbl_takeaway_billmaster $stfjoin  Where  $finalstring "); 
		
	}

  
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login)
	  {
		  echo "ok";
	  }else
	  {
		  echo "sorry";
	  }
	  //echo "Select sum(tbl_takeaway_billmaster.tab_netamt),tbl_takeaway_billmaster.tab_date From tbl_takeaway_billmaster $stfjoin  Where  $finalstring ";

}

?>