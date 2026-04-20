<?php
//include('includes/session.php');		// Check session
session_start();
if($_SESSION["archive_enabled"]=='Y'){
    include("database.class.reports.php");  // DB Connection class
    $database	= new Database();
    
}
else if($_SESSION["archive_enabled"]=='N'){
    include("database.class.php");  // DB Connection class
    $database	= new Database();
    
}

 if(($_REQUEST['type'] == "totalsales_cs"))
{	
	 $date=date("Ymd"); 
	$string=" tab_mode='CS' AND tab_status='Closed' AND ";
				
					//echo $_REQUEST['fromdt'] ."--";
					//echo $_REQUEST['todt'] ."<br>";
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
		
		$bydatz=$_REQUEST['hidbydate'];
		
			if($bydatz!="null")
			{

	if($bydatz=="Last5days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($bydatz=="Last10days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.="tab_dayclosedate = CURDATE() - INTERVAL 1 day";
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
	 else if($bydatz=="Last1month")
			  {
				  $string.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
	else if($bydatz=="Today")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
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
		
		
	
					$cur=date("Y-m-d");
				$string.=" tab_dayclosedate='".$cur."'";
	
	}
		
	
	}
	
	

	$sql_login1  =  $database->mysqlQuery("select * from tbl_takeaway_billmaster where $string"); 

		
	  $num_login   = $database->mysqlNumRows($sql_login1);
		
	  if($num_login)
	  {
	echo "ok";
	  }else
	  {
	echo "sorry";
	  }
	  
	

}
else if(($_REQUEST['type'] == "billcancel_cs"))
{	
	 $date=date("Ymd"); 
	$string= " tbm.tab_mode='CS' and tbm.tab_status='Cancelled' and tbm.tab_cancelled='Y' and ";
				
					//echo $_REQUEST['fromdt'] ."--";
					//echo $_REQUEST['todt'] ."<br>";
					if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
					{
						$from=$database->convert_date($_REQUEST['hidfr']);
						$to=$database->convert_date($_REQUEST['hidto']);
						$string.= " tbm.tab_dayclosedate between '".$from."' and '".$to."' order by tbm.tab_dayclosedate";
					}
					else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
					{
						$from=$database->convert_date($_REQUEST['hidfr']);
						$to=date("Y-m-d");
						$string.= " tbm.tab_dayclosedate between '".$from."' and '".$to."' order by tbm.tab_dayclosedate";
					}
					else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
					{
						$from=date("Y-m-d");
						$to=$database->convert_date($_REQUEST['hidto']);
						$string.= " tbm.tab_dayclosedate between '".$from."' and '".$to."' order by tbm.tab_dayclosedate";
					}
				
                                        else
                                        {
		
                                            $bydatz=$_REQUEST['hidbydate'];
		
                                            if($bydatz!="null")
                                            {

	if($bydatz=="Last5days")
	{
		$string.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($bydatz=="Last10days")
	{
		$string.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.="tbm.tab_dayclosedate = CURDATE() - INTERVAL 1 day";
			  }
	elseif($bydatz=="Last15days")
	{
		$string.=" tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last25days")
	{
		$string.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last30days")
	{
		$string.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	 else if($bydatz=="Last1month")
			  {
				  $string.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
	else if($bydatz=="Today")
	{
		$string.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
else if($bydatz=="Last90days")
	{
		$string.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last180days")
	{
		$string.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last365days")
	{
		$string.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}

	}
	else
	{
		
		
	
					$cur=date("Y-m-d");
				$string.=" tbm.tab_dayclosedate='".$cur."'";
	
	}
		
	
	}
	
	

	$sql_login1  =  $database->mysqlQuery("select tbm.tab_billno,tbm.tab_dayclosedate,tbm.tab_time,tbm.tab_cancelledtime,tbm.tab_paymode,tbm.tab_cancelledreason,tbm.tab_cancelledlogin,tbm.tab_netamt,ld.ls_staffid,sm.ser_firstname,sm.ser_lastname 
from tbl_takeaway_billmaster tbm left join tbl_staffmaster sm on sm.ser_staffid=tbm.tab_cancelledby_careof left join
 tbl_logindetails ld on ld.ls_username=tbm.tab_cancelledlogin where $string order by tbm.tab_billno ASC");

		
	  $num_login   = $database->mysqlNumRows($sql_login1);
		
	  if($num_login)
	  {
	echo "ok";
	  }else
	  {
	echo "sorry";
	  }
	  
	

}

else if(($_REQUEST['type'] == "cancelhistory_cs"))
{	
	 $date=date("Ymd"); 
	$string= " tbm.tab_mode='CS' and tbm.tab_status='Cancelled' and ";
				
					//echo $_REQUEST['fromdt'] ."--";
					//echo $_REQUEST['todt'] ."<br>";
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
						$string.= " tbm.tab_dayclosedate between '".$from."' and '".$to."' order by tbm.tab_dayclosedate";
					}
					
					
			
				
	else
	{
		
		$bydatz=$_REQUEST['hidbydate'];
		
			if($bydatz!="null")
			{

	if($bydatz=="Last5days")
	{
		$string.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($bydatz=="Last10days")
	{
		$string.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.="tbm.tab_dayclosedate = CURDATE() - INTERVAL 1 day";
			  }
	elseif($bydatz=="Last15days")
	{
		$string.=" tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last25days")
	{
		$string.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last30days")
	{
		$string.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	 else if($bydatz=="Last1month")
			  {
				  $string.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
	else if($bydatz=="Today")
	{
		$string.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
else if($bydatz=="Last90days")
	{
		$string.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last180days")
	{
		$string.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last365days")
	{
		$string.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}

	}
	else
	{
		
		
	
					$cur=date("Y-m-d");
				$string.=" tbm.tab_dayclosedate='".$cur."'";
	
	}
		
	
	}
	
	

	$sql_login1  =  $database->mysqlQuery("select tbm.tab_billno,ld.ls_staffid,mm.mr_menuname,sm.ser_firstname,tbm.tab_dayclosedate,tbm.tab_kotno,tbm.tab_cancelledreason from tbl_takeaway_billmaster tbm left join tbl_takeaway_billdetails tbd on tbm.tab_billno=tbd.tab_billno left join tbl_menumaster mm on mm.mr_menuid=tbd.tab_menuid left join tbl_staffmaster sm on sm.ser_staffid=tbm.tab_cancelledby_careof left join tbl_logindetails ld on ld.ls_username=tbm.tab_cancelledlogin where $string " ); 

		
	  $num_login   = $database->mysqlNumRows($sql_login1);
		
	  if($num_login)
	  {
	echo "ok";
	  }else
	  {
	echo "sorry";
	  }
	  
	

}
else if(($_REQUEST['type'] == "itemordered_cs"))
{	
	$string.=" tbm.tab_status = 'Closed' and tbm.tab_mode='CS' and ";
	
	
	
					//echo $_REQUEST['fromdt'] ."--";
					//echo $_REQUEST['todt'] ."<br>";
					if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
					{
						$from=$database->convert_date($_REQUEST['hidfr']);
						$to=$database->convert_date($_REQUEST['hidto']);
						$string.= "  tbm.tab_dayclosedate between '".$from."' and '".$to."'  ";
					}
					else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
					{
						$from=$database->convert_date($_REQUEST['hidfr']);
						$to=date("Y-m-d");
						$string.= "  tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
					}
					else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
					{
						$from=date("Y-m-d");
						$to=$database->convert_date($_REQUEST['hidto']);
						$string.= " tbm.tab_dayclosedate between '".$from."' and '".$to."'  ";
					}
					
					
				
	
		else{
		$bydatz=$_REQUEST['hidbydate'];
		
		
		
			if($bydatz!="null")
			{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.=" tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($bydatz=="Last10days")
	{
		$string.="  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.=" tbm.tab_dayclosedate = CURDATE() - INTERVAL 1 day";
			  }
	elseif($bydatz=="Last15days")
	{
		$string.="  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last20days")
	{
		$string.="   tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last25days")
	{
		$string.="  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last30days")
	{
		$string.=" tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	 else if($bydatz=="Last1month")
			  {
				  $string.="  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
	else if($bydatz=="Today")
	{
		$string.="  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
else if($bydatz=="Last90days")
	{
		$string.="  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last180days")
	{
		$string.=" tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last365days")
	{
		$string.="  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}
	}

	
		
	
				else{
					
					$cur=date("Y-m-d");
				$string.="   tbm.tab_dayclosedate='".$cur."'";
				}
		}

	
  $sql_login  =  $database->mysqlQuery("SELECT mc.mmy_maincategoryname,ms.msy_subcategoryname,m.mr_menuname,p.pm_portionname,tbm.tab_netamt,sum(tbd.tab_qty) as qty,ROUND(avg(tbd.tab_rate), 1) as Unit_Price, ((sum(tbd.tab_qty))*(ROUND(avg(tbd.tab_rate), 1))) as Sub_Total from tbl_takeaway_billmaster tbm left join tbl_takeaway_billdetails tbd on tbd.tab_billno = tbm.tab_billno left join tbl_menumaster m on m.mr_menuid = tbd.tab_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = m.mr_maincatid left join tbl_menusubcategory ms on ms.msy_subcategoryid = m.mr_subcatid left join tbl_portionmaster p on p.pm_id = tbd.tab_portion where $string group by m.mr_maincatid ,m.mr_subcatid,tbd.tab_menuid,tbd.tab_portion ORDER BY m.mr_maincatid,m.mr_subcatid  DESC"); 

	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login)
	  {
			echo "ok";
	  }else
	  {
		  echo "sorry";
	  }

}




else if(($_REQUEST['type'] == "discountreport_cs"))
{	$string="";
	$string.=" tab_status='Closed' AND tab_mode= 'CS' AND tab_discountvalue<>'0.00' AND";
	
					//echo $_REQUEST['fromdt'] ."--";
					//echo $_REQUEST['todt'] ."<br>";
					if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
					{
						$from=$database->convert_date($_REQUEST['hidfr']);
						$to=$database->convert_date($_REQUEST['hidto']);
						$string.= " tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate ";
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
						$string.= " tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate ";
					}
					
					
				
	else 
	{
		
		$bydatz=$_REQUEST['hidbydate'];
		
		
		
			if($bydatz!="null")
			{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.="  tab_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($bydatz=="Last10days")
	{
		$string.="  tab_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.="  tab_dayclosedate = CURDATE() - INTERVAL 1 day";
			  }
	elseif($bydatz=="Last15days")
	{
		$string.="   tab_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last20days")
	{
		$string.="  tab_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last25days")
	{
		$string.="  tab_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last30days")
	{
		$string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	 else if($bydatz=="Last1month")
			  {
				  $string.="  tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
	else if($bydatz=="Today")
	{
		$string.="  tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
else if($bydatz=="Last90days")
	{
		$string.="  tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last180days")
	{
		$string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last365days")
	{
		$string.="  tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}
	}

	
	else{
	
					$cur=date("Y-m-d");
				$string.="  tab_dayclosedate='".$cur."'";
	}
	}
	$sql_login1  =  $database->mysqlQuery("select * from tbl_takeaway_billmaster where $string"); 

		
	  $num_login   = $database->mysqlNumRows($sql_login1);
		
	  if($num_login)
	  {
	echo "ok";
	  }else
	  {
	echo "sorry";
	  }
	  
	

}

else if(($_REQUEST['type'] == "complimentary_cs"))
{	$string="";
	$string.=" tab_status='Closed' AND tab_mode= 'CS' AND tab_complimentary='Y' AND ";
	
				
					//echo $_REQUEST['fromdt'] ."--";
					//echo $_REQUEST['todt'] ."<br>";
					if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
					{
						$from=$database->convert_date($_REQUEST['hidfr']);
						$to=$database->convert_date($_REQUEST['hidto']);
						$string.= "  tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate ";
					}
					else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
					{
						$from=$database->convert_date($_REQUEST['hidfr']);
						$to=date("Y-m-d");
						$string.= "  tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
					}
					else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
					{
						$from=date("Y-m-d");
						$to=$database->convert_date($_REQUEST['hidto']);
						$string.= "  tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate ";
					}
					
					
				
		else 
			{
		
		$bydatz=$_REQUEST['hidbydate'];
		
		
		
			if($bydatz!="null")
			{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.="  tab_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($bydatz=="Last10days")
	{
		$string.="  tab_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.="  tab_dayclosedate = CURDATE() - INTERVAL 1 day";
			  }
	elseif($bydatz=="Last15days")
	{
		$string.="   tab_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last20days")
	{
		$string.="  tab_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last25days")
	{
		$string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last30days")
	{
		$string.="  tab_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	 else if($bydatz=="Last1month")
			  {
				  $string.="  tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
	else if($bydatz=="Today")
	{
		$string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
else if($bydatz=="Last90days")
	{
		$string.="  tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last180days")
	{
		$string.="  tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last365days")
	{
		$string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}
	}

	
	else{
	
					$cur=date("Y-m-d");
				$string.=" tab_dayclosedate='".$cur."'";
	}
			}
	
	$sql_login1  =  $database->mysqlQuery("select * from tbl_takeaway_billmaster where $string"); 

		
	  $num_login   = $database->mysqlNumRows($sql_login1);
		
	  if($num_login)
	  {
	echo "ok";
	  }else
	  {
	echo "sorry";
	  }
	  
	

}



else if(($_REQUEST['type'] == "billreport_cs"))
{	$string="";
	$string.="tbm.tab_mode='CS' and tbm.tab_status='Closed' AND ";
	
					//echo $_REQUEST['fromdt'] ."--";
					//echo $_REQUEST['todt'] ."<br>";
					if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
					{
						$from=$database->convert_date($_REQUEST['hidfr']);
						$to=$database->convert_date($_REQUEST['hidto']);
						$string.= "  tbm.tab_dayclosedate between '".$from."' and '".$to."' order by tbm.tab_dayclosedate ";
					}
					else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
					{
						$from=$database->convert_date($_REQUEST['hidfr']);
						$to=date("Y-m-d");
						$string.= "  tbm.tab_dayclosedate between '".$from."' and '".$to."' order by tbm.tab_dayclosedate";
					}
					else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
					{
						$from=date("Y-m-d");
						$to=$database->convert_date($_REQUEST['hidto']);
						$string.= "  tbm.tab_dayclosedate between '".$from."' and '".$to."' order by tbm.tab_dayclosedate ";
					}
					
					
				
		else{
		
		$bydatz=$_REQUEST['hidbydate'];
		
		
		
			if($bydatz!="null")
			{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.="  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($bydatz=="Last10days")
	{
		$string.="  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.="   tbm.tab_dayclosedate = CURDATE() - INTERVAL 1 day";
			  }
	elseif($bydatz=="Last15days")
	{
		$string.="   tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last20days")
	{
		$string.="   tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last25days")
	{
		$string.=" tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last30days")
	{
		$string.="   tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	 else if($bydatz=="Last1month")
			  {
				  $string.="  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
	else if($bydatz=="Today")
	{
		$string.="  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
else if($bydatz=="Last90days")
	{
		$string.="  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last180days")
	{
		$string.="   tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last365days")
	{
		$string.="   tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}
	}

	
	else{
	
					$cur=date("Y-m-d");
				$string.="  tbm.tab_dayclosedate='".$cur."'";
	}
		}
	$sql_login1  =  $database->mysqlQuery("select tbm.tab_billno,tbm.tab_dayclosedate,mm.mr_menuname,tbd.tab_qty,tbd.tab_rate,p.pm_portionname from tbl_takeaway_billmaster tbm left join tbl_takeaway_billdetails tbd on tbm.tab_billno=tbd.tab_billno left join tbl_menumaster mm on mm.mr_menuid=tbd.tab_menuid left join tbl_portionmaster p on p.pm_id=tbd.tab_portion where $string"); 

		
	  $num_login   = $database->mysqlNumRows($sql_login1);
		
	  if($num_login)
	  {
	echo "ok";
	  }else
	  {
	echo "sorry";
	  }
	  
	

}


else if($_REQUEST['type']=="paymenttype_cs")
{
	 $date=date("Ymd");

//$string="tbm.tab_status='closed' and tbm.tab_mode='CS'";
if($_REQUEST['hidpaytyp']=="cash")
	{
		//$string = " (bm_transactionamount ='' or bm_transactionamount IS NULL) and (bm_couponcompany ='' or bm_couponcompany IS NULL) and bm_voucherid IS NULL and bm_couponamt ='0.00' and  (bm_chequeno ='' or bm_chequeno IS NULL) and (bm_chequebankname='' or bm_chequebankname IS NULL)";
		$string ="tbm.tab_status='Closed' and tbm.tab_mode='CS' AND";
		
	/*	 xlsWriteLabel(0,3,"Final");
 		 xlsWriteLabel(0,4,"Paid");
 		 xlsWriteLabel(0,5,"Balance");*/
		 $data['Final']="";
		 $data['Paid']="";
		 $data['Balance']="";
		 
	}else if($_REQUEST['hidpaytyp']=="credit")
	{
		//$string = " bm_transactionamount <>'' ";
		$string = " p.pym_code='credit' and tbm.tab_status='Closed' and tbm.tab_mode='CS' AND ";
		
			 $data['Transaction Amount']="";
		 	 $data['Final']="";
		     $data['Paid']="";
		     $data['Balance']="";
	}else if($_REQUEST['hidpaytyp']=="cheque")
	{
		//$string = " bm_chequeno <>'' and bm_chequebankname<>''";
		$string = " pym_code='cheque'";
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
			$string.= " tbm.tab_dayclosedate between '".$from."' and '".$to."' order by tbm.tab_dayclosedate";
		}
		else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= "tbm.tab_dayclosedate between '".$from."' and '".$to."' order by tbm.tab_dayclosedate";
		}
		/*$cur=date("Y-m-d");
			$string.=" and  bm_dayclosedate='".$cur."'";*/
	else
	{
				$paybydate=$_REQUEST['hidpay'];
	if($paybydate!="null")
	{
		
		
	if($paybydate=="Last5days")
	{
		$string.= " tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}else if($paybydate=="Last10days")
	{
		$string.=" tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	else if($paybydate=="Last15days")
	{
		$string.=" tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($paybydate=="Last20days")
	{
		$string.="  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($paybydate=="Last25days")
	{
		$string.=" tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($paybydate=="Last30days")
	{
		$string.="  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	else if($paybydate=="Today")
	{
		$string.=" tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	
		else if($paybydate=="Yesterday")
			  {
				  $string.=" tbm.tab_dayclosedate =  CURDATE() - INTERVAL 1 day ";
			  }
	else if($paybydate=="Last1month")
	{
		$string.="  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
	}
	
	else if($paybydate=="Last90days")
	{
		$string.="  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 3 
MONTH AND CURDATE( )";
	}
	else if($paybydate=="Last180days")
	{
		$string.="  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 6 
MONTH AND CURDATE( )";
	}
	else if($paybydate=="Last365days")
	{
		$string.=" tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 
YEAR AND CURDATE( )";
	}
	
	
	
	}
	else
	{
			$cur=date("Y-m-d");
			$string.=" tbm.tab_dayclosedate='".$cur."'";
	}
	
	}
	
	$sql_login  =  $database->mysqlQuery("select tbm.tab_billno,tbm.tab_dayclosedate,tbm.tab_amountpaid,tbm.tab_amountbalace from tbl_takeaway_billmaster tbm left join tbl_paymentmode p on tbm.tab_paymode=p.pym_id where  $string "); 
	
	  $num_login   = $database->mysqlNumRows($sql_login);
	  
	 if($num_login)
	  {
			echo "ok";
	  }else
	  {
		  echo "sorry";
	  }

		
		
}

    elseif(($_REQUEST['type'] == "summary_cs"))
        {	
	 $date=date("Ymd"); 
	$string=" tab_mode='CS' AND tab_status='Closed' AND ";
				
					//echo $_REQUEST['fromdt'] ."--";
					//echo $_REQUEST['todt'] ."<br>";
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
		
		$bydatz=$_REQUEST['hidbydate'];
		
			if($bydatz!="null")
			{

	if($bydatz=="Last5days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($bydatz=="Last10days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.="tab_dayclosedate = CURDATE() - INTERVAL 1 day";
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
	 else if($bydatz=="Last1month")
			  {
				  $string.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
	else if($bydatz=="Today")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
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
		
		
	
					$cur=date("Y-m-d");
				$string.=" tab_dayclosedate='".$cur."'";
	
	}
		
	
	}
	
	

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
        
        
        elseif(($_REQUEST['type'] =="categorywise_report_cs"))
        {	
	 $date=date("Ymd"); 
	$string=" tbm.tab_mode='CS' AND tbm.tab_status='Closed' AND ";
				
					//echo $_REQUEST['fromdt'] ."--";
					//echo $_REQUEST['todt'] ."<br>";
					if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
					{
						$from=$database->convert_date($_REQUEST['hidfr']);
						$to=$database->convert_date($_REQUEST['hidto']);
						$string.= " tab_dayclosedate between '".$from."' and '".$to."'";
					}
					else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
					{
						$from=$database->convert_date($_REQUEST['hidfr']);
						$to=date("Y-m-d");
						$string.= " tab_dayclosedate between '".$from."' and '".$to."'";
					}
					else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
					{
						$from=date("Y-m-d");
						$to=$database->convert_date($_REQUEST['hidto']);
						$string.= " tab_dayclosedate between '".$from."' and '".$to."'";
					}
					
					
			
				
	else
	{
		
		$bydatz=$_REQUEST['hidbydate'];
		
			if($bydatz!="null")
			{

	if($bydatz=="Last5days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($bydatz=="Last10days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.="tab_dayclosedate = CURDATE() - INTERVAL 1 day";
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
	 else if($bydatz=="Last1month")
			  {
				  $string.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
	else if($bydatz=="Today")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
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
		
		
	
					$cur=date("Y-m-d");
				$string.=" tab_dayclosedate='".$cur."'";
	
	}
		
	
	}
	
	

	$sql_login  =  $database->mysqlQuery("SELECT mc.mmy_maincategoryname,count(distinct(tbd.tab_menuid)) as 'no of items',sum(tbd.tab_qty) as qty ,sum(tbd.tab_qty* tbd.tab_rate) as Total from tbl_takeaway_billmaster tbm left join tbl_takeaway_billdetails tbd on tbd.tab_billno = tbm.tab_billno left join tbl_menumaster on mr_menuid =tbd.tab_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = mr_maincatid where $string group by mr_maincatid ORDER BY mr_maincatid ASC "); 
 // echo "SELECT mc.mmy_maincategoryname,count(distinct(tbd.tab_menuid)) as 'no of items',sum(tbd.tab_qty) as qty ,sum(tbd.tab_qty* tbd.tab_rate) as Total from tbl_takeaway_billmaster tbm left join tbl_takeaway_billdetails tbd on tbd.tab_billno = tbm.tab_billno left join tbl_menumaster on mr_menuid =tbd.tab_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = mr_maincatid where $string group by mr_maincatid ORDER BY mr_maincatid ASC ";
		
	  $num_login   = $database->mysqlNumRows($sql_login);
		
	  if($num_login)
	  {
	echo "ok";
	  }else
	  {
	echo "sorry";
	  }
        }  
?>










































	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	



