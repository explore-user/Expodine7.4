
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
if(($_REQUEST['type']=="tot_sales"))
{
	$string="";
	$string=" bm_status='Closed' AND ";
	$floorvalue=$_REQUEST['floorz'];
	if($_REQUEST['floorz']!='')
	{
		$string.=" bm_floorid='".$floorvalue."' AND ";
	}
	if(isset($_REQUEST['set']))
	{

		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
		}
	}
	
	else if(isset($_REQUEST['abc']))
	{
		
		$bydatz=$_REQUEST['bydate'];
		
		
		
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
	else if($bydatz=="Yesterday")
			  {
				  $string.="bm_dayclosedate=CURDATE( ) - INTERVAL 1 DAY"; 
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
	 else if($bydatz=="Last1month")
			  {
				  $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
	else if($bydatz=="Today")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
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
		
	
		
		
		
	}
	else if(isset($_REQUEST['flr']))
	{
		
		
		
		
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
		}
		else if($_REQUEST['bydate']!="null")
		{
			$bydatz=$_REQUEST['bydate'];
			
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
	else if($bydatz=="Yesterday")
			  {
				  $string.="bm_dayclosedate=CURDATE( ) - INTERVAL 1 DAY"; 
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
	 else if($bydatz=="Last1month")
			  {
				  $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
	else if($bydatz=="Today")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
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
		
		
	}
	
	
	
	else
	{
		$cur=date("Y-m-d");
		$string.=" bm_dayclosedate='".$cur."'";
	}

  $sql_login  =  $database->mysqlQuery("select * from tbl_tablebillmaster where $string"); 

  
	  $num_login   = $database->mysqlNumRows($sql_login);
	
	  if($num_login)
	  {
	echo "ok";
	  }else
	  {
echo "sorry";
	  }

}
else if(($_REQUEST['type']=="tax_detailed_cnb"))
{
	
	$string="";
	$string=" bm_status='Closed' AND ";
	
	
	
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
		}
	
	
	else 
	{
		
		$bydatz=$_REQUEST['bydate'];
		
		
		
			if($bydatz!="null" && $bydatz!="")
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
	else if($bydatz=="Yesterday")
			  {
				  $string.="bm_dayclosedate=CURDATE( ) - INTERVAL 1 DAY"; 
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
	 else if($bydatz=="Last1month")
			  {
				  $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
	else if($bydatz=="Today")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
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
		
	}
  $sql_login  =  $database->mysqlQuery("select * from tbl_tablebillmaster where $string");
  	  $num_login   = $database->mysqlNumRows($sql_login);
	
	  if($num_login)
	  {
                echo "ok";
	  }else
	  {
                echo "sorry";
	  }

}

else if(($_REQUEST['type'] == "no_sale_report"))
{	
	$string="";
				if(isset($_REQUEST['set']))
				{
					//echo $_REQUEST['fromdt'] ."--";
					//echo $_REQUEST['todt'] ."<br>";
					if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
					{
						$from=$database->convert_date($_REQUEST['fromdt']);
						$to=$database->convert_date($_REQUEST['todt']);
						$string.= "o.ter_dayclosedate between '".$from."' and '".$to."' ";
					}
					else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
					{
						$from=$database->convert_date($_REQUEST['fromdt']);
						$to=date("Y-m-d");
						$string.= " o.ter_dayclosedate between '".$from."' and '".$to."'";
					}
					else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
					{
						$from=date("Y-m-d");
						$to=$database->convert_date($_REQUEST['todt']);
						$string.= "o.ter_dayclosedate between '".$from."' and '".$to."'";
					}
					
					
				}
				
	else if(isset($_REQUEST['abc']))
	{
		
		$bydatz=$_REQUEST['bydate'];
		
		
		
			if($bydatz!="null")
			{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.=" o.ter_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($bydatz=="Last10days")
	{
		$string.=" o.ter_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.=" o.ter_dayclosedate = CURDATE() - INTERVAL 1 day";
			  }
	elseif($bydatz=="Last15days")
	{
		$string.=" o.ter_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last20days")
	{
		$string.="o.ter_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last25days")
	{
		$string.="o.ter_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last30days")
	{
		$string.=" o.ter_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	 else if($bydatz=="Last1month")
			  {
				  $string.=" o.ter_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
	else if($bydatz=="Today")
	{
		$string.=" o.ter_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
else if($bydatz=="Last90days")
	{
		$string.=" o.ter_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last180days")
	{
		$string.=" o.ter_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last365days")
	{
		$string.="  o.ter_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}
	}
else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " o.ter_dayclosedate between '".$from."' and '".$to."' ";
	}
		
	
	
	}
	
	else
	{
		$cur=date("Y-m-d");
		$string.=" o.ter_dayclosedate='".$cur."'";
	}
	
	$sql_login1  =  $database->mysqlQuery("SELECT mc.mmy_maincategoryname,sc.msy_subcategoryname,m.mr_menuname FROM tbl_menumaster m 
LEFT JOIN tbl_menumaincategory mc ON MC.mmy_maincategoryid = m.mr_maincatid
LEFT JOIN tbl_menusubcategory sc ON SC.msy_subcategoryid = m.mr_subcatid
where m.mr_menuid NOT IN(SELECT o.ter_menuid from tbl_tableorder o where $string)
ORDER BY m.mr_maincatid,m.mr_subcatid  DESC"); 

		
	  $num_login   = $database->mysqlNumRows($sql_login1);
		
	  if($num_login)
	  {
	echo "ok";
	}else
	  {
echo "sorry";
	  }
	  
	

}

else if(($_REQUEST['type'] == "regenerate_bill_logs"))
{	
	$string="";
				
					if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
					{
						$from=$database->convert_date($_REQUEST['fromdt']);
						$to=$database->convert_date($_REQUEST['todt']);
						$string.= " bm.bm_billdate between '".$from."' and '".$to."' ";
					}
					else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
					{
						$from=$database->convert_date($_REQUEST['fromdt']);
						$to=date("Y-m-d");
						$string.= " bm.bm_billdate between '".$from."' and '".$to."'";
					}
					else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
					{
						$from=date("Y-m-d");
						$to=$database->convert_date($_REQUEST['todt']);
						$string.= " bm.bm_billdate between '".$from."' and '".$to."'";
					}
					
					
				
				
	else 
	{
		
		$bydatz=$_REQUEST['bydate'];
		
		
		
			if($bydatz!="null" && $bydatz!="")
			{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.=" bm.bm_billdate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($bydatz=="Last10days")
	{
		$string.=" bm.bm_billdate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.=" bm.bm_billdate = CURDATE() - INTERVAL 1 day";
			  }
	elseif($bydatz=="Last15days")
	{
		$string.=" bm.bm_billdate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" bm.bm_billdate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last25days")
	{
		$string.=" bm.bm_billdate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last30days")
	{
		$string.=" bm.bm_billdate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	 else if($bydatz=="Last1month")
			  {
				  $string.=" bm.bm_billdate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
	else if($bydatz=="Today")
	{
		$string.=" bm.bm_billdate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
else if($bydatz=="Last90days")
	{
		$string.=" bm.bm_billdate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last180days")
	{
		$string.=" bm.bm_billdate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last365days")
	{
		$string.="  bm.bm_billdate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}
	}
else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " bm.bm_billdate between '".$from."' and '".$to."' ";
	}
		
	
	
	}
	
	
	
	$sql_login1  =  $database->mysqlQuery("select bm.bm_billdate,bm.bm_finaltotal,bm.bm_billno,r.re_new_bill_no,r.re_billno,r.re_amount,r.re_order_no,DATE(r.re_datetime) AS Date, s.ser_firstname,r.re_reason,r.re_loginid from tbl_regenrate_log r left join tbl_staffmaster s on r.re_staffid=s.ser_staffid left join tbl_tablebillmaster bm on bm.bm_billno=r.re_billno where $string
 order by r.re_billno  ASC "); 

		
	  $num_login   = $database->mysqlNumRows($sql_login1);
		
	  if($num_login)
	  {
	echo "ok";
	}else
	  {
echo "sorry";
	  }
	  
	

}


else if($_REQUEST['type']=="tot_sales_timely")
{
	$string="";
	$string=" bm_status='Closed' AND ";
	$floorvalue=$_REQUEST['floorz'];
	
	if($_REQUEST['floorz']!='')
	{
		$string.=" bm_floorid='".$floorvalue."' AND ";
		
	}
	if(isset($_REQUEST['set']))
	{
		//echo $_REQUEST['fromdt'] ."--";
		//echo $_REQUEST['todt'] ."<br>";
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$bydate=$_REQUEST['bydate'];
			$from=($_REQUEST['fromdt']);
			$to=($_REQUEST['todt']);
			$string.= " bm_billtime between '".$from."' and '".$to."' and bm_billdate  = '".$bydate."'   order by bm_billtime";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$bydate=$_REQUEST['bydate'];
			$from=($_REQUEST['fromdt']);
			 $to = date('H:i');
			$string.= " bm_billtime between '".$from."' and '".$to."' and bm_billdate  = '".$bydate."'  order by bm_billtime";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$bydate=$_REQUEST['bydate'];
			 $from = date('H:i');
			$to=($_REQUEST['todt']);
			$string.= " bm_billtime between '".$from."' and '".$to."' and bm_billdate  = '".$bydate."'  order by bm_billtime";
		}
	}
	
	
	else if(isset($_REQUEST['flr']))
	{
		
		
		
		
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$bydate=$_REQUEST['bydate'];
			$from=($_REQUEST['fromdt']);
			$to=($_REQUEST['todt']);
			$string.= " bm_billtime between '".$from."' and '".$to."' and bm_billdate  = '".$bydate."'  order by bm_billtime";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
					$bydate=$_REQUEST['bydate'];
			$from=$_REQUEST['fromdt'];
			 $to = date('H:i');
			//$to=date("Y-m-d");
			$string.= " bm_billtime between '".$from."' and '".$to."' and bm_billdate  = '".$bydate."'   order by bm_billtime";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
					$bydate=$_REQUEST['bydate'];
		 $from = date('H:i');
		//	$from=date("Y-m-d");
			$to=($_REQUEST['todt']);
			$string.= " bm_billtime between '".$from."' and '".$to."' and bm_billdate  = '".$bydate."'  order by bm_billtime";
		}
		
		else
		{
						$bydate=$_REQUEST['bydate'];
			 $from = date('H:i');
			 $to = date('H:i');
			$string.= "bm_billtime between '".$from."' and '".$to."' and bm_billdate  = '".$bydate."' ";
			
		}
		
		
	}
	
	
	
	else
	{
				$bydate=$_REQUEST['bydate'];
		 $from = date('H:i');
			 $to = date('H:i');
		$string.=" bm_billtime='".$from."' and bm_billdate  = '".$bydate."' ";
	}
	
	


  $sql_login  =  $database->mysqlQuery("select * from tbl_tablebillmaster where $string"); 

  
	  $num_login   = $database->mysqlNumRows($sql_login);
	
	  if($num_login)
	  {
	echo "ok";
	  }else
	  {
echo "sorry";
	  }


}
else if(($_REQUEST['type']=="sales_summary_zam"))
{
	
	$string="";
	$string=" bm_status='Closed' AND ";
	
	
	if(isset($_REQUEST['set']))
	{
		//echo $_REQUEST['fromdt'] ."--";
		//echo $_REQUEST['todt'] ."<br>";
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
		}
	}
	
	else if(isset($_REQUEST['abc']))
	{
		
		$bydatz=$_REQUEST['bydate'];
		
		
		
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
	else if($bydatz=="Yesterday")
			  {
				  $string.="bm_dayclosedate = CURDATE() - INTERVAL 1 day";
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
	 else if($bydatz=="Last1month")
			  {
				  $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
	else if($bydatz=="Today")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
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
		
	
	}
	
	
	
	
	else
	{
		$cur=date("Y-m-d");
		$string.=" bm_dayclosedate='".$cur."'";
	}

  $sql_login  =  $database->mysqlQuery("select * from tbl_tablebillmaster where $string"); 
//  echo "select * from tbl_tablebillmaster where $string";
  
	  $num_login   = $database->mysqlNumRows($sql_login);
	
	  if($num_login)
	  {
			echo "ok";
	  }else
	  {
		  echo "sorry";
	  }

}

else if(($_REQUEST['type']=="sales_summary"))
{
	
	$string="";
	$string=" bm_status='Closed' AND ";
	
	
	if(isset($_REQUEST['set']))
	{
		//echo $_REQUEST['fromdt'] ."--";
		//echo $_REQUEST['todt'] ."<br>";
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
		}
	}
	
	else if(isset($_REQUEST['abc']))
	{
		
		$bydatz=$_REQUEST['bydate'];
		
		
		
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
	else if($bydatz=="Yesterday")
			  {
				  $string.="bm_dayclosedate = CURDATE() - INTERVAL 1 day";
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
	 else if($bydatz=="Last1month")
			  {
				  $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
	else if($bydatz=="Today")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
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
		
	
	}
	
	
	
	
	else
	{
		$cur=date("Y-m-d");
		$string.=" bm_dayclosedate='".$cur."'";
	}

  $sql_login  =  $database->mysqlQuery("select * from tbl_tablebillmaster where $string"); 
//  echo "select * from tbl_tablebillmaster where $string";
  
	  $num_login   = $database->mysqlNumRows($sql_login);
	
	  if($num_login)
	  {
			echo "ok";
	  }else
	  {
		  echo "sorry";
	  }

}

else if(($_REQUEST['type']=="tax_sales_summary"))
{
	
	$string="";
	$string=" bm_status='Closed' AND ";
	
	
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
		}
	
	
	else 
	{
		
		$bydatz=$_REQUEST['bydate'];
		
		
		
			if($bydatz!="null" && $bydatz!="")
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
	else if($bydatz=="Yesterday")
			  {
				  $string.="bm_dayclosedate = CURDATE() - INTERVAL 1 day";
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
	 else if($bydatz=="Last1month")
			  {
				  $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
	else if($bydatz=="Today")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
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
		
	
	}
	
	

  $sql_login  =  $database->mysqlQuery("select * from tbl_tablebillmaster where $string"); 
//  echo "select * from tbl_tablebillmaster where $string";
  
	  $num_login   = $database->mysqlNumRows($sql_login);
	
	  if($num_login)
	  {
			echo "ok";
	  }else
	  {
		  echo "sorry";
	  }

}

else if(($_REQUEST['type']=="summary"))
{
	
	$string="";
	$string=" bm_status='Closed' AND ";
	
	
	if(isset($_REQUEST['set']))
	{
		//echo $_REQUEST['fromdt'] ."--";
		//echo $_REQUEST['todt'] ."<br>";
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
		}
	}
	
	else if(isset($_REQUEST['abc']))
	{
		
		$bydatz=$_REQUEST['bydate'];
		
		
		
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
	else if($bydatz=="Yesterday")
			  {
				  $string.="bm_dayclosedate = CURDATE() - INTERVAL 1 day";
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
	 else if($bydatz=="Last1month")
			  {
				  $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
	else if($bydatz=="Today")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
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
		
	
	}
	
	
	
	
	else
	{
		$cur=date("Y-m-d");
		$string.=" bm_dayclosedate='".$cur."'";
	}

  $sql_login  =  $database->mysqlQuery("select * from tbl_tablebillmaster where $string"); 
  
	  $num_login   = $database->mysqlNumRows($sql_login);
	
	  if($num_login)
	  {
			echo "ok";
	  }else
	  {
		  echo "sorry";
	  }

}
else if(($_REQUEST['type']=="stewards_performance_report"))
{
	
        $stw = $_REQUEST['stwrd'];
	$string="";
	$string=" bm_status='Closed' AND ";
	
	
	if(isset($_REQUEST['set']))
	{
		//echo $_REQUEST['fromdt'] ."--";
		//echo $_REQUEST['todt'] ."<br>";
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
		}
	}
	
	
		
		$bydatz=$_REQUEST['stewardbydate'];
		
		
		
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
	else if($bydatz=="Yesterday")
			  {
				  $string.="bm_dayclosedate = CURDATE() - INTERVAL 1 day";
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
	 else if($bydatz=="Last1month")
			  {
				  $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
	else if($bydatz=="Today")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
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
		
	
	
	
	
	
	

  $sql_login  =  $database->mysqlQuery("select * from tbl_tablebillmaster where $string"); 
  //echo "select * from tbl_tablebillmaster where $string";
	  $num_login   = $database->mysqlNumRows($sql_login);
	
	  if($num_login)
	  {
			echo "ok";
	  }else
	  {
		  echo "sorry";
	  }

}

else if(($_REQUEST['type']=="total_summary_details"))
{
	
	$string="";
	$string=" bm_status='Closed' AND ";
	
	
	
	if(isset($_REQUEST['set']))
	{
		//echo $_REQUEST['fromdt'] ."--";
		//echo $_REQUEST['todt'] ."<br>";
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
		}
	}
	
	else if(isset($_REQUEST['abc']))
	{
		
		$bydatz=$_REQUEST['bydate'];
		
		
		
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
	else if($bydatz=="Yesterday")
			  {
				  $string.="bm_dayclosedate = CURDATE() - INTERVAL 1 day";
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
	 else if($bydatz=="Last1month")
			  {
				  $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
	else if($bydatz=="Today")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
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
		
	
	}
	
	
	
	
	else
	{
		$cur=date("Y-m-d");
		$string.=" bm_dayclosedate='".$cur."'";
	}

  $sql_login  =  $database->mysqlQuery("select * from tbl_tablebillmaster where $string"); 
  
	  $num_login   = $database->mysqlNumRows($sql_login);
	
	  if($num_login)
	  {
			echo "ok";
	  }else
	  {
		  echo "sorry";
	  }

}

else if(($_REQUEST['type']=="discount_report"))
{
	
	$string="";
	$string=" bm_status='Closed' AND bm_discountvalue<>'0.00' AND ";
	if(isset($_REQUEST['set']))
	{
		//echo $_REQUEST['fromdt'] ."--";
		//echo $_REQUEST['todt'] ."<br>";
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
		}
	}
	
	else if(isset($_REQUEST['abc']))
	{
		
		$bydatz=$_REQUEST['bydate'];
		
		
		
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
	else if($bydatz=="Yesterday")
			  {
				  $string.="bm_dayclosedate = CURDATE() - INTERVAL 1 day";
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
	 else if($bydatz=="Last1month")
			  {
				  $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
	else if($bydatz=="Today")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
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
		
	
		
		
		
	}
	
	
	
	
	else
	{
		$cur=date("Y-m-d");
		$string.=" bm_dayclosedate='".$cur."'";
	}





  $sql_login  =  $database->mysqlQuery("select * from tbl_tablebillmaster where $string"); 
  
	  $num_login   = $database->mysqlNumRows($sql_login);
	
	  if($num_login)
	  {
			echo "ok";
	  }else
	  {
		  echo "sorry";
	  }

}else if(($_REQUEST['type']=="bill_details"))
{
//SELECT td.bd_billno,bm.bm_dayclosedate,mn.mr_menuname,td.bd_rate,td.bd_qty,pm.pm_portionname from tbl_tablebilldetails as td LEFT JOIN tbl_menumaster as mn ON td.bd_menuid=mn.mr_menuid LEFT JOIN tbl_portionmaster as pm ON td.bd_portion=pm.pm_id LEFT JOIN tbl_tablebillmaster as bm ON bm.bm_billno=td.bd_billno  WHERE (bm.bm_dayclosedate BETWEEN '2015-10-17' AND '2015-10-17') AND bm.bm_status='Closed' order by bm.bm_dayclosedate,bm.bm_billtime	
	$string="";
	$string=" bm.bm_status='Closed' AND ";
	
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm.bm_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " bm.bm_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm.bm_dayclosedate between '".$from."' and '".$to."'";
		}
	
	
	else 
	{
		
		$bydatz=$_REQUEST['bydate'];
		
		
		
			if($bydatz!="null" && $bydatz!="")
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
	else if($bydatz=="Yesterday")
			  {
				  $string.="bm.bm_dayclosedate = CURDATE() - INTERVAL 1 day";
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
	 else if($bydatz=="Last1month")
			  {
				  $string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
	else if($bydatz=="Today")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
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
		
	
		
		
		
	}
	

  $sql_login  =  $database->mysqlQuery("SELECT td.bd_billno,bm.bm_dayclosedate,mn.mr_menuname,td.bd_rate,td.bd_qty,pm.pm_portionname from tbl_tablebilldetails as td LEFT JOIN tbl_menumaster as mn ON td.bd_menuid=mn.mr_menuid LEFT JOIN tbl_portionmaster as pm ON td.bd_portion=pm.pm_id LEFT JOIN tbl_tablebillmaster as bm ON bm.bm_billno=td.bd_billno  WHERE $string"); 
  //echo "SELECT td.bd_billno,bm.bm_dayclosedate,mn.mr_menuname,td.bd_rate,td.bd_qty,pm.pm_portionname from tbl_tablebilldetails as td LEFT JOIN tbl_menumaster as mn ON td.bd_menuid=mn.mr_menuid LEFT JOIN tbl_portionmaster as pm ON td.bd_portion=pm.pm_id LEFT JOIN tbl_tablebillmaster as bm ON bm.bm_billno=td.bd_billno  WHERE $string";
	  $num_login   = $database->mysqlNumRows($sql_login);
	
	  if($num_login)
	  {
			echo "ok";
	  }else
	  {
		  echo "sorry";
	  }

    
}



else if(($_REQUEST['type']=="bill_cancel"))
{
	
	$string="";
	$string=" bm_status='Cancelled' AND ";
	
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
		}
		
		
	else 
	{
		
		$bydatz=$_REQUEST['bydate'];
		
		
		
			if($bydatz!="null" && $bydatz!="")
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
	else if($bydatz=="Yesterday")
			  {
				  $string.="bm_dayclosedate = CURDATE() - INTERVAL 1 day";
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
	 else if($bydatz=="Last1month")
			  {
				  $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
	else if($bydatz=="Today")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
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
		
	
		
		
		
	}
	
	
	

  $sql_login  =  $database->mysqlQuery("select * from tbl_tablebillmaster where $string"); 
  //echo "select * from tbl_tablebillmaster where $string ";
	  $num_login   = $database->mysqlNumRows($sql_login);
	
	  if($num_login)
	  {
			echo "ok";
	  }else
	  {
		  echo "sorry";
	  }

}
else if(($_REQUEST['type']=="type_pay"))
{
	$string="bm_status='closed' ";
	$fields="";
	if(isset($_REQUEST['set']))
{
	if($_REQUEST['typepay']=="cash")
	{
		//$string = " (bm_transactionamount ='' or bm_transactionamount IS NULL) and (bm_couponcompany ='' or bm_couponcompany IS NULL) and bm_voucherid IS NULL and bm_couponamt ='0.00' and  (bm_chequeno ='' or bm_chequeno IS NULL) and (bm_chequebankname='' or bm_chequebankname IS NULL)";
	
		$string.= "";
		$fields="";
	}else if($_REQUEST['typepay']=="credit")
	{
		//$string = " bm_transactionamount <>'' ";
		$string = " pym_code='credit'";
		$fields="<th class='sortable'>Transcation Amount</th>";
		
	}else if($_REQUEST['typepay']=="coupons")
	{
		//$string = " bm_couponcompany <>''  and bm_couponamt <>'0.00'";
		$string = " pym_code='coupon'";
		$fields="<th class='sortable'>Coupon Company</th>";
		$fields.="<th class='sortable'>Coupon Amount</th>";
	}else if($_REQUEST['typepay']=="voucher")
	{
		//$string = " bm_voucherid <>''";
		$string = " pym_code='voucher'";
		$fields="<th class='sortable'>Voucher</th>";
	}else if($_REQUEST['typepay']=="cheque")
	{
		//$string = " bm_chequeno <>'' and bm_chequebankname<>''";
		$string = " pym_code='cheque'";
		$fields="<th class='sortable'>Cheque No</th>";
		$fields.="<th class='sortable'>Bank Name</th>";
	}
	
	//fromdt todt
	
	if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= "  and bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= "  and bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= "  and bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
		}else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']=="")
		{
			$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " and bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
			$fields="<th class='sortable'>Cheque No</th>";
		    $fields.="<th class='sortable'>Bank Name</th>";
			
		}
}

else if(isset($_REQUEST['pay']))
{
	
	
	if($_REQUEST['typepay']=="cash")
	{
		//$string = " (bm_transactionamount ='' or bm_transactionamount IS NULL) and (bm_couponcompany ='' or bm_couponcompany IS NULL) and bm_voucherid IS NULL and bm_couponamt ='0.00' and  (bm_chequeno ='' or bm_chequeno IS NULL) and (bm_chequebankname='' or bm_chequebankname IS NULL)";
		$string = "";
		$fields="";
	}else if($_REQUEST['typepay']=="credit")
	{
		//$string = " bm_transactionamount <>'' ";
		$string = " pym_code='credit'";
		$fields="<th class='sortable'>Transcation Amount</th>";
		
	}else if($_REQUEST['typepay']=="coupons")
	{
		//$string = " bm_couponcompany <>''  and bm_couponamt <>'0.00'";
		$string = " pym_code='coupon'";
		$fields="<th class='sortable'>Coupon Company</th>";
		$fields.="<th class='sortable'>Coupon Amount</th>";
	}else if($_REQUEST['typepay']=="voucher")
	{
		//$string = " bm_voucherid <>''";
		$string = " pym_code='voucher'";
		$fields="<th class='sortable'>Voucher</th>";
	}else if($_REQUEST['typepay']=="cheque")
	{
		//$string = " bm_chequeno <>'' and bm_chequebankname<>''";
		$string = " pym_code='cheque'";
		$fields="<th class='sortable'>Cheque No</th>";
		$fields.="<th class='sortable'>Bank Name</th>";
	}
	
	//fromdt todt


	$paybydate=$_REQUEST['paybydate'];
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
		$string.=" and bm_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($paybydate=="Last30days")
	{
		$string.=" and bm_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	else if($paybydate=="Today")
	{
		$string.=" and bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
		else if($paybydate=="Yesterday")
			  {
				  $string.=" and bm_dayclosedate =CURDATE() - INTERVAL 1 day";
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
}
else if(isset($_REQUEST['abc']))
{
	
		if($_REQUEST['typepay']=="cash")
	{
		//$string = " (bm_transactionamount ='' or bm_transactionamount IS NULL) and (bm_couponcompany ='' or bm_couponcompany IS NULL) and bm_voucherid IS NULL and bm_couponamt ='0.00' and  (bm_chequeno ='' or bm_chequeno IS NULL) and (bm_chequebankname='' or bm_chequebankname IS NULL)";
		$string = " pym_code='cash'";
		$fields="";
	}else if($_REQUEST['typepay']=="credit")
	{
		//$string = " bm_transactionamount <>'' ";
		$string = " pym_code='credit'";
		$fields="<th class='sortable'>Transcation Amount</th>";
		
	}else if($_REQUEST['typepay']=="coupons")
	{
		//$string = " bm_couponcompany <>''  and bm_couponamt <>'0.00'";
		$string = " pym_code='coupon'";
		$fields="<th class='sortable'>Coupon Company</th>";
		$fields.="<th class='sortable'>Coupon Amount</th>";
	}else if($_REQUEST['typepay']=="voucher")
	{
		//$string = " bm_voucherid <>''";
		$string = " pym_code='voucher'";
		$fields="<th class='sortable'>Voucher</th>";
	}else if($_REQUEST['typepay']=="cheque")
	{
		//$string = " bm_chequeno <>'' and bm_chequebankname<>''";
		$string = " pym_code='cheque'";
		$fields="<th class='sortable'>Cheque No</th>";
		$fields.="<th class='sortable'>Bank Name</th>";
	}
	
	//fromdt todt


	$paybydate=$_REQUEST['paybydate'];
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
	else if($paybydate=="Yesterday")
			  {
				  $string.="and bm_dayclosedate = CURDATE() - INTERVAL 1 day";
			  }
	else if($paybydate=="Last1month")
	{
		$string.=" and bm_dayclosedate between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
	}
	else if($paybydate=="Today")
	{
		$string.="and bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
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
}
else
		{
			
	$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "  ( tbl_tablebillmaster.bm_dayclosedate between '".$from."' and '".$to."' )  ";
			
		}
 	  $sql_login  =  $database->mysqlQuery("select * from tbl_tablebillmaster LEFT JOIN tbl_paymentmode ON  tbl_tablebillmaster.bm_paymode= tbl_paymentmode.pym_id where $string"); 
 //echo "select * from tbl_tablebillmaster where $string";

	
	   $num_login   = $database->mysqlNumRows($sql_login);
	
	  if($num_login)
	  	{
		  echo "ok";
		  }else 
		  {
			 echo "sorry";
		  } 
   
}else if(($_REQUEST['type']=="item"))
{
	$floor=$_REQUEST['floorvals'];
	 $sql_cat  =  $database->mysqlQuery("select distinct(mr.mr_maincatid) as catid from tbl_menumaster as mr LEFT JOIN tbl_menumaincategory as my ON mr.mr_maincatid=my.mmy_maincategoryid where mr.mr_active='Y'  order by my.mmy_displayorder"); 
	$num_cat   = $database->mysqlNumRows($sql_cat);
	if($num_cat){$j=0;
		while($result_cat  = $database->mysqlFetchArray($sql_cat)) 
			{
				$j++;
				
				$menucat=$database->show_category_ful_details($result_cat['catid']);
				if($menucat['mmy_maincategoryname']!="")
				{
					
								  $sql_sub  =  $database->mysqlQuery("select distinct(mr_subcatid) as subid from tbl_menumaster where mr_active='Y' and mr_maincatid='".$result_cat['catid']."' order by mr_maincatid"); 
				$num_sub  = $database->mysqlNumRows($sql_sub);
				if($num_sub)
				{ 
				echo "ok";
				}else
				{
					echo "sorry";
				} 
					
				}
			}
		}else
		{
			echo "sorry";
		}
	
}else if(($_REQUEST['type']=="steward"))
{
		$stw=$_REQUEST['stwrd'];
	$string="";
        
        $string=" bm_status='Closed' ";
        
	if(isset($_REQUEST['abc']))
	{
		$stewardbydate=$_REQUEST['stewardbydate'];
	if($stewardbydate!="null")
	{
		//$search="";
	if($stewardbydate=="Last5days")
	{
		$string.=" and bm_dayclosedate   between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($stewardbydate=="Last10days")
	{
		$string.=" and bm_dayclosedate  between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	elseif($stewardbydate=="Last15days")
	{
		$string.=" and bm_dayclosedate  between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($stewardbydate=="Last20days")
	{
		$string.=" and bm_dayclosedate  between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($stewardbydate=="Last25days")
	{
		$string.=" and bm_dayclosedate  between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($stewardbydate=="Last30days")
	{
		$string.=" and bm_dayclosedate   between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	else if($stewardbydate=="Today")
	{
		$string.=" and bm_dayclosedate   between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	else if($stewardbydate=="Yesterday")
			  {
				  $string.=" and bm_dayclosedate  = CURDATE() - INTERVAL 1 day";
			  }
	else if($stewardbydate=="Last1month")
	{
		$string.=" and bm_dayclosedate  between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
	}
	else if($stewardbydate=="Last90days")
	{
		$string.=" and bm_dayclosedate   between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}

else if($stewardbydate=="Last180days")
	{
		$string.=" and bm_dayclosedate   between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($stewardbydate=="Last365days")
	{
		$string.=" and bm_dayclosedate   between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}


	}
	
	else
	{
		$string.=" and bm_dayclosedate  between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	
	
$sql_stw  =  $database->mysqlQuery("Select * from tbl_tablebillmaster where $string");
$num_stw   = $database->mysqlNumRows($sql_stw);
	  if($num_stw){
		  echo "ok";
	  }else
	  {
		  echo "sorry";
	  }


	}
	
	
	else if(isset($_REQUEST['set']))
{
	
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " and ( bm_dayclosedate between '".$from."' and '".$to."' )  ";
		  $sql_stw  =  $database->mysqlQuery("Select * from tbl_tablebillmaster where $string "); 
	  $num_stw   = $database->mysqlNumRows($sql_stw);
	  if($num_stw){
		  echo "ok";
	  }else
	  {
		  echo "sorry";
	  }
}

else if(isset($_REQUEST['stwr']))
{
	
	
	$stw=$_REQUEST['stwrd'];
	$string="";
	$string=" bm_status='Closed' ";
		$stewardbydate=$_REQUEST['stewardbydate'];
	if($stewardbydate!="null")
	{
		//$search="";
	if($stewardbydate=="Last5days")
	{
		$string.=" and bm_dayclosedate   between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($stewardbydate=="Last10days")
	{
		$string.=" and bm_dayclosedate   between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	elseif($stewardbydate=="Last15days")
	{
		$string.=" and bm_dayclosedate   between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($stewardbydate=="Last20days")
	{
		$string.=" and bm_dayclosedate  between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($stewardbydate=="Last25days")
	{
		$string.=" and bm_dayclosedate   between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($stewardbydate=="Last30days")
	{
		$string.=" and bm_dayclosedate   between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	else if($stewardbydate=="Today")
	{
		$string.=" and bm_dayclosedate   between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	
	else if($stewardbydate=="Yesterday")
			  {
				  $string.=" and bm_dayclosedate  = CURDATE() - INTERVAL 1 day";
			  }
	else if($stewardbydate=="Last1month")
	{
		$string.=" and bm_dayclosedate  between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
	}
	
	else if($stewardbydate=="Last90days")
	{
		$string.=" and bm_dayclosedate  between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}

else if($stewardbydate=="Last180days")
	{
		$string.=" and bm_dayclosedate   between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($stewardbydate=="Last365days")
	{
		$string.=" and bm_dayclosedate  between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}


	}
	
	else
	{
		$string.=" and bm_dayclosedate  between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	
$sql_stw  =  $database->mysqlQuery("Select * from tbl_tablebillmaster where $string");

$num_stw   = $database->mysqlNumRows($sql_stw);

	  if($num_stw){
		  echo "ok";
	  }else
	  {
		  echo "sorry";
	  }
}



else 
	{
	if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " and ( bm_dayclosedate  between '".$from."' and '".$to."' ) ";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " and ( bm_dayclosedate  between '".$from."' and '".$to."' ) ";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " and ( bm_dayclosedate  between '".$from."' and '".$to."' )  ";
		}else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']=="")
		{
			$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " and ( bm_dayclosedate  between '".$from."' and '".$to."' )  ";
		} 
 	  $sql_stw  =  $database->mysqlQuery("Select * from tbl_tablebillmaster where $string "); 
	 // echo "Select count(*)  as ct,tbl_menumaster.mr_menuname as menuname From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid Inner Join tbl_staffmaster On tbl_tableorder.ter_staff = tbl_staffmaster.ser_staffid Where  tbl_tableorder.ter_staff =  '".$stw."' $string Group By tbl_menumaster.mr_menuname order by ct DESC";
	  
	  
	  
	  $num_stw   = $database->mysqlNumRows($sql_stw);
	
	  
	  if($num_stw){
		  echo "ok";
	  }else
	  {
		  echo "sorry";
	  }
	}
	
}

else if($_REQUEST['type'] =="steward_timely")
{
	
		$stw=$_REQUEST['stwrd'];
	$string="";
	
	
	 if(isset($_REQUEST['set']))
{
	$stewardbydate=$_REQUEST['stewardbydate'];
	
	
	
		  if($_REQUEST['stwrd']!='')
	  {
	  
		  $string.="tbl_tableorder.ter_staff =  '".$stw."' and  ";
		  
	  }
	
	if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$_REQUEST['fromdt'];
			$to=$_REQUEST['todt'];
			$string.= "  ( tbl_tableorder.ter_entrytime  between '".$from."' and '".$to."' and tbl_tableorder.ter_entrydate='".$stewardbydate."'  ) ";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$_REQUEST['fromdt'];
			 $to = date('H:i');
			$string.= "  ( tbl_tableorder.ter_entrytime  between '".$from."' and '".$to."' and tbl_tableorder.ter_entrydate='".$stewardbydate."' ) ";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			 $from = date('H:i');
			$to=$_REQUEST['todt'];
			$string.= "  ( tbl_tableorder.ter_entrytime  between '".$from."' and '".$to."' and tbl_tableorder.ter_entrydate='".$stewardbydate."' )  ";
		}else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']=="")
		{
			$from = date('H:i');
			 $to = date('H:i');
		
			$string.= "  ( tbl_tableorder.ter_entrytime  between '".$from."' and '".$to."' and tbl_tableorder.ter_entrydate='".$stewardbydate."' )  ";
		} 
	
	
	
		  $sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_menumaster.mr_menuname as menuname From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid Inner Join tbl_staffmaster On tbl_tableorder.ter_staff = tbl_staffmaster.ser_staffid Where   $string Group By tbl_menumaster.mr_menuname order by ct DESC"); 
	  $num_stw   = $database->mysqlNumRows($sql_stw);
	  if($num_stw){
		  echo "ok";
	  }else
	  {
		  echo "sorry";
	  }
}

else if(isset($_REQUEST['stwr']))
{
	
	
	$stw=$_REQUEST['stwrd'];
	$string="";
		$stewardbydate=$_REQUEST['stewardbydate'];
	if($_REQUEST['stwrd']!='')
	{
	
		$string.="tbl_tableorder.ter_staff =  '".$stw."'  ";
		
	}
		
	
	
	if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$_REQUEST['fromdt'];
			$to=$_REQUEST['todt'];
			$string.= " and ( tbl_tableorder.ter_entrytime  between '".$from."' and '".$to."' and tbl_tableorder.ter_entrydate='".$stewardbydate."'  ) ";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$_REQUEST['fromdt'];
			 $to = date('H:i');
			$string.= " and ( tbl_tableorder.ter_entrytime  between '".$from."' and '".$to."' and tbl_tableorder.ter_entrydate='".$stewardbydate."' ) ";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			 $from = date('H:i');
			$to=$_REQUEST['todt'];
			$string.= " and ( tbl_tableorder.ter_entrytime  between '".$from."' and '".$to."' and tbl_tableorder.ter_entrydate='".$stewardbydate."' )  ";
		}else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']=="")
		{
			$from = date('H:i');
			 $to = date('H:i');
		
			$string.= " and ( tbl_tableorder.ter_entrytime  between '".$from."' and '".$to."' and tbl_tableorder.ter_entrydate='".$stewardbydate."' )  ";
		} 
		
		
/*	echo  "Select count(*)  as ct,tbl_menumaster.mr_menuname as menuname From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid Inner Join tbl_staffmaster On tbl_tableorder.ter_staff = tbl_staffmaster.ser_staffid Where   $string Group By tbl_menumaster.mr_menuname order by ct DESC" ;
die();*/
		
		
		
 	  $sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_menumaster.mr_menuname as menuname From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid Inner Join tbl_staffmaster On tbl_tableorder.ter_staff = tbl_staffmaster.ser_staffid Where   $string Group By tbl_menumaster.mr_menuname order by ct DESC"); 
	 // echo "Select count(*)  as ct,tbl_menumaster.mr_menuname as menuname From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid Inner Join tbl_staffmaster On tbl_tableorder.ter_staff = tbl_staffmaster.ser_staffid Where  tbl_tableorder.ter_staff =  '".$stw."' $string Group By tbl_menumaster.mr_menuname order by ct DESC";
	  
	  
	  
	  $num_stw   = $database->mysqlNumRows($sql_stw);
	
	  
	  if($num_stw){
		  echo "ok";
	  }else
	  {
		  echo "sorry";
	  }
	
	
	
/*$sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_menumaster.mr_menuname as menuname From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid Inner Join tbl_staffmaster On tbl_tableorder.ter_staff = tbl_staffmaster.ser_staffid Where  tbl_tableorder.ter_staff =  '".$stw."' $string Group By tbl_menumaster.mr_menuname order by ct DESC");

$num_stw   = $database->mysqlNumRows($sql_stw);

	  if($num_stw){
		  echo "ok";
	  }else
	  {
		  echo "sorry";
	  }*/
}



else 
	{
$stewardbydate=$_REQUEST['stewardbydate'];
			$from = date('H:i');
			 $to = date('H:i');
			$string.= "  ( tbl_tableorder.ter_entrytime  between '".$from."' and '".$to."' and  tbl_tableorder.ter_entrydate='".$stewardbydate."'   )  ";
		
 	  $sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_menumaster.mr_menuname as menuname From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid Inner Join tbl_staffmaster On tbl_tableorder.ter_staff = tbl_staffmaster.ser_staffid Where $string Group By tbl_menumaster.mr_menuname order by ct DESC"); 
	 // echo "Select count(*)  as ct,tbl_menumaster.mr_menuname as menuname From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid Inner Join tbl_staffmaster On tbl_tableorder.ter_staff = tbl_staffmaster.ser_staffid Where  tbl_tableorder.ter_staff =  '".$stw."' $string Group By tbl_menumaster.mr_menuname order by ct DESC";
	  
	  
	  
	  $num_stw   = $database->mysqlNumRows($sql_stw);
	
	  
	  if($num_stw){
		  echo "ok";
	  }else
	  {
		  echo "sorry";
	  }
	}
	

}

  else if($_REQUEST['type'] =="items_ordered_timely")
	  {
		
		
	/*$string="";
	$string="o.ter_status='Closed' AND ";*/
	$reporthead="";
	$st="";
	if(isset ($_REQUEST['flr']))
	{
		  
		
		$floorval=$_REQUEST['floorval'];
		$string="";
		if($floorval!="")
	{
		$string="bm.bm_status='Closed' AND ";
		$string.="bm.bm_floorid='".$floorval."' ";
	}
		else
		{
			$string="bm.bm_status='Closed' " ;
			
		}
		 
		 
		 if($_REQUEST['time']!="" && $_REQUEST['time2']!="")
		{
			
			$from=$_REQUEST['time'];
			
			$to=$_REQUEST['time2'];
			if($string !="")
			{
			 $string.= " and bm.bm_billtime  between '".$from."' and '".$to."' and bm.bm_billdate='".$_REQUEST['from']."' ";
			
			}
			else
			{

				$string.= "bm.bm_billtime  between '".$from."' and '".$to."' and bm.bm_billdate='".$_REQUEST['from']."' ";
			}
		
			
			
		}
	 else if ($_REQUEST['time']!="" && $_REQUEST['time2']=="")
		{
				
			$from=$_REQUEST['time'];
			 $to = date('H:i');
		
				if($string !="")
			{
			$string.= "and bm.bm_billtime  between '".$from."' and '".$to."' and bm.bm_billdate='".$_REQUEST['from']."'  ";
			}
			else
			{
			$string.= "bm.bm_billtime  between '".$from."' and '".$to."' and bm.bm_billdate='".$_REQUEST['from']."' ";
			}
				
		}
		else if($_REQUEST['time']=="" && $_REQUEST['time2']!="")
		{
				 $from = date('H:i');
		//	$from=$_REQUEST['time'];
			
			$to=$_REQUEST['time2'];
			if($string !="")
			{
			$string.= "and bm.bm_billtime  between '".$from."' and '".$to."' and bm.bm_billdate='".$_REQUEST['from']."' ";
			}
			else
			{
			$string.= "bm.bm_billtime  between '".$from."' and '".$to."' and bm.bm_billdate='".$_REQUEST['from']."' ";
			}
				
		}
		
		
			else
		{
			
			
			
				 $from = date('H:i');
			 $to = date('H:i');
		//	$to=$_REQUEST['time2'];
			if($string !="")
			{
			$string.= " and bm.bm_billtime  between '".$from."' and '".$to."' and bm.bm_billdate='".$_REQUEST['from']."' ";
			}
			else
			{
				$string.= " bm.bm_billtime  between '".$from."' and '".$to."' and bm.bm_billdate='".$_REQUEST['from']."' ";	
			}
			
			
		}
		
		
	}
	else if(isset($_REQUEST['set']))
	{
	$string="";
	
	$string="bm.bm_status='Closed' AND ";

	
		
	if($_REQUEST['timeval']!="" && $_REQUEST['time_new']!="")
		{
			$from=$_REQUEST['timeval'];
			$to=$_REQUEST['time_new'];
			$string.= "  ( bm.bm_billtime  between '".$from."' and '".$to."' and bm.bm_billdate='".$_REQUEST['entrydate']."' ) ";
			//$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['timeval']!="" && $_REQUEST['time_new']=="")
		{
			$from=($_REQUEST['timeval']);
			//$to=date("Y-m-d");
			 $to = date('H:i');
			$string.= "  ( bm.bm_billtime  between '".$from."' and '".$to."' and bm.bm_billdate='".$_REQUEST['entrydate']."' ) ";
		//	$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['timeval']=="" && $_REQUEST['time_new']!="")
		{
				 $from = date('H:i');
			//$from=date("Y-m-d");
			$to=($_REQUEST['time_new']);
		$string.= "  ( bm.bm_billtime  between '".$from."' and '".$to."' and bm.bm_billdate='".$_REQUEST['entrydate']."' ) ";
			//$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}else if($_REQUEST['timeval']=="" && $_REQUEST['time_new']=="")
		{
			 $from = date('H:i');
		 $to = date('H:i');
				$string.= "  ( bm.bm_billtime  between '".$from."' and '".$to."' and bm.bm_billdate='".$_REQUEST['entrydate']."' ) ";
		//	$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		

		
		
		
		
			$floorval=$_REQUEST['floorval'];
			if($floorval !="")
			{
		if($string!="")
	
	{
		
		$string.=" and bm.bm_floorid='".$floorval."' ";
	}
		
		else
		{
			$string.="bm.bm_floorid='".$floorval."' ";
		}
			}
		
		
		
		
	}

	
	else
	{
		
	$string="";
	
	$string="bm.bm_status='Closed' AND ";
		 $from = date('H:i');
		 $to = date('H:i');
			$string.= "  ( bm.bm_billtime  between '".$from."' and '".$to."' and bm.bm_billdate='".$_REQUEST['entrydate']."' )  ";
			
				
			
	}

       

 	  $sql_stw  =  $database->mysqlQuery("SELECT mc.mmy_maincategoryname,ms.msy_subcategoryname,bm.bm_billdate as entrydate,bm.bm_billtime as entrytime,m.mr_menuname,p.pm_portionname,f.fr_floorname,sum(bd.bd_qty) as qty,ROUND(avg(bd.bd_rate), 1) as Unit_Price, ((sum(bd.bd_qty))*(ROUND(avg(bd.bd_rate), 1))) as Total from tbl_tablebilldetails bd left join tbl_tablebillmaster bm on bm.bm_billno=bd.bd_billno left join tbl_menumaster m on m.mr_menuid = bd.bd_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = m.mr_maincatid left join tbl_menusubcategory ms on ms.msy_subcategoryid = m.mr_subcatid left join tbl_portionmaster p on p.pm_id = bd.bd_portion  left join tbl_floormaster f on f.fr_floorid = bm.bm_floorid where $string group by m.mr_maincatid ,m.mr_subcatid,bd.bd_menuid,bd.bd_portion,bm.bm_floorid ORDER BY m.mr_maincatid,m.mr_subcatid  DESC"); 
	 // echo "SELECT mc.mmy_maincategoryname,ms.msy_subcategoryname,bm.bm_billdate as entrydate,bm.bm_billtime as entrytime,m.mr_menuname,p.pm_portionname,f.fr_floorname,sum(bd.bd_qty) as qty,ROUND(avg(bd.bd_rate), 1) as Unit_Price, ((sum(bd.bd_qty))*(ROUND(avg(bd.bd_rate), 1))) as Total from tbl_tablebilldetails bd left join tbl_tablebillmaster bm on bm.bm_billno=bd.bd_billno left join tbl_menumaster m on m.mr_menuid = bd.bd_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = m.mr_maincatid left join tbl_menusubcategory ms on ms.msy_subcategoryid = m.mr_subcatid left join tbl_portionmaster p on p.pm_id = bd.bd_portion  left join tbl_floormaster f on f.fr_floorid = bm.bm_floorid where $string group by m.mr_maincatid ,m.mr_subcatid,bd.bd_menuid,bd.bd_portion,bm.bm_floorid ORDER BY m.mr_maincatid,m.mr_subcatid  DESC";
          $num_stw   = $database->mysqlNumRows($sql_stw);
	  if($num_stw){
                        echo "ok";
                     }  
          else
          {
              echo "sorry";
          }
		  
}

else if($_REQUEST['type'] == "order")
{	 $string="";
        
	$string.="bm.bm_status = 'Closed'";
       
        $string_addon="";
        $stringta_addon="";
        if($_REQUEST['addon']=='N')
	{
            $string_addon.=" and bd.bd_bill_addon_slno IS NULL ";
           
        }
        else if($_REQUEST['addon']=='Y')
	{
            $string_addon.=" and bd.bd_bill_addon_slno IS NOT NULL";
            
        }
        
        if(isset ($_REQUEST['floorz']))
	{
		
		$floorvalue=$_REQUEST['floorz'];
                if($floorvalue!="")
                {
		
		$string.="and bm.bm_floorid='".$floorvalue."'";
                }
	}
       
	
					
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
		    $from=$database->convert_date($_REQUEST['fromdt']);
		    $to=$database->convert_date($_REQUEST['todt']);
		    $string.= " and bm.bm_dayclosedate between '".$from."' and '".$to."'  ";
                    
                    $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
                     $from=$database->convert_date($_REQUEST['fromdt']);
		     $to=date("Y-m-d");
		     $string.= " and bm.bm_dayclosedate between '".$from."' and '".$to."' ";
                     
                     $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
		}
                else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
                {
                     $from=date("Y-m-d");
                     $to=$database->convert_date($_REQUEST['todt']);
                     $string.= " and bm.bm_dayclosedate between '".$from."' and '".$to."'  ";
                    
                     $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
                }
				
					
           
	else 
	{
                $bydatz=$_REQUEST['bydate'];
                
                if($bydatz!="null" && $bydatz!="")
		{
	
                if($bydatz=="Last5days")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                    
                    $st="Last 5 days";
                }
                elseif($bydatz=="Last10days")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                    
                    $st="Last 10 days";
                }
                else if($bydatz=="Yesterday")
                {
                    $string.=" and bm.bm_dayclosedate = CURDATE() - INTERVAL 1 day";
                   
                    $st="Yesterday";
                }
                elseif($bydatz=="Last15days")
                {
                    $string.="  and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                    
                    $st="Last 15 days";
                }
                else if($bydatz=="Last20days")
                {
                    $string.=" and  bm.bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                    
                    $st="Last 20 days";
                }
                else if($bydatz=="Last25days")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                    
                    $st="Last 25 days";
                }
                else if($bydatz=="Last30days")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                    
                    $st="Last 30 days";
                }
                else if($bydatz=="Last1month")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                    
                    $st="Last 1 Month";
                }
                else if($bydatz=="Today")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
                    
                    $st="Today";
                }
                else if($bydatz=="Last90days")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                    
                    $st="Last 90 days";
                }
                else if($bydatz=="Last180days")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                    
                    $st="Last 180 days";
                }
                else if($bydatz=="Last365days")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                    
                    $st="Last 365 days";
                }
                }
                else
                {
		$from=date("Y-m-d");
	        $to=date("Y-m-d");
	        $string.= " and bm.bm_dayclosedate between '".$from."' and '".$to."' ";
                
                $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                
                }
                $reporthead=$st;
	}
        
	
	
        $final=0;
        $qty=0;
        $qty_final=0;
          $sql_stw  =  $database->mysqlQuery(" select mc.mmy_maincategoryname as maincategory, sc.msy_subcategoryname as subcategory,bd.bd_menuid as menuid,mm.mr_menuname as menuname, bd.bd_rate_type as rate_type,
                                        bd.bd_unit_type as unit_type, bd.bd_portion as portionid,pm.pm_portionname as portionname,
                                        bd.bd_unit_weight as weight, bd.bd_unit_id as unitid,um.u_name as unitname,
                                        bd.bd_base_unit_id as baseunitid,bum.bu_name as baseunitname, bd.bd_rate, sum(bd.bd_qty) as qty , sum(bd.bd_rate* bd.bd_qty) as total
                                        FROM tbl_tablebilldetails bd
                                        left join tbl_tablebillmaster bm ON bm.bm_billno = bd.bd_billno
                                        left join tbl_menumaster mm ON mm.mr_menuid = bd.bd_menuid
                                        left join tbl_menumaincategory mc ON mc.mmy_maincategoryid = mm.mr_maincatid
                                        left join tbl_menusubcategory sc ON sc.msy_subcategoryid = mm.mr_subcatid
                                        left join tbl_portionmaster pm ON pm.pm_id = bd.bd_portion
                                        left join  tbl_unit_master um on um.u_id=bd.bd_unit_id
                                        left join tbl_base_unit_master bum on bum.bu_id=bd.bd_base_unit_id
                                        where $string $string_addon
                                        group by bd.bd_menuid,bd.bd_portion,bd.bd_unit_id, bd.bd_base_unit_id,bd.bd_unit_weight  order by maincategory");
                $num_stw   = $database->mysqlNumRows($sql_stw);
                if($num_stw){
	  
			echo "ok";
	  }else
	  {
			echo "sorry";
	  }

}

else if(($_REQUEST['type']=="kitchen_wise"))
{

	if(isset ($_REQUEST['flr']))
	{
			$floorval=$_REQUEST['floorval'];
			$string="";
		if($floorval!="")
                {
		$string="o.ter_status='Closed' AND ";
		$string.=" m.mr_kotcounter='".$floorval."' ";
                $item=$_REQUEST['item'];
		if($item!=""){
                    $string.=" and o.ter_menuid ='".$item."' ";
                }
                }
		else
		{
			$string="o.ter_status='Closed' " ;
			/*$string.="o.ter_floorid='".$floorval."' ";*/
		}
                
		
		
			 
	if($_REQUEST['bydt']!="null" )	 
		 {
			 		
			 
			 $bydatz=$_REQUEST['bydt'];
	if($bydatz=="Last5days")
	{
		if($string !="")
		{
		$string.="and o.ter_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
		}
		else
		{
		$string.="o.ter_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";	
		}



	}elseif($bydatz=="Last10days")
	{
		if($string!="")
		{
		$string.="and o.ter_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
		}
		else
		{
			$string.="o.ter_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
		}

	}
	elseif($bydatz=="Last15days")
	{
		if($string !="")
		{
		$string.=" and o.ter_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
		}
		else
		{
			$string.="o.ter_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
		}

	}
	else if($bydatz=="Last20days")
	{
		if($string !="")
		{
		$string.="and o.ter_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
		}
		else
		{
			$string.="o.ter_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
		}

	}
	else if($bydatz=="Last25days")
	{
		if($string !="")
		{
		$string.="and o.ter_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
		}
		else
		{
			$string.="o.ter_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
		}

	}
	else if($bydatz=="Last30days")
	{
		if($string !="")
		{
		$string.="and o.ter_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
		}
		else
		{
		$string.="o.ter_dayclosedate  between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
		}

	}
	else if($bydatz=="Today")
	{
		if($string !="")
		{
		$string.="and o.ter_dayclosedate  between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
		}
		else
		{
			$string.="o.ter_dayclosedate  between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
		}
		
	}
	

else if($bydatz=="Yesterday")
			  {
				  if($string !="")
				  {
				  $string.="and  o.ter_dayclosedate = CURDATE() - INTERVAL 1 day";//" bm_dayclosedate =CURDATE() - 1  ";
				  }
				  else
				  {
					    $string.=" o.ter_dayclosedate  =CURDATE() - INTERVAL 1 day";
				  }
				  
			  }
	else if($bydatz=="Last1month")
	{
		if($string !="")
		{
		$string.="and o.ter_dayclosedate  between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
		}
		else
		{
	$string.="o.ter_dayclosedate  between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
		}


	}
else if($bydatz=="Last90days")
	{
		if($string !="")
		{
		$string.="and o.ter_dayclosedate  between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
		}
		else
		{
			$string.="o.ter_dayclosedate  between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
		}
	
	}
else if($bydatz=="Last180days")
	{
		if($string !="")
		{
		$string.="and o.ter_dayclosedate  between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
		}
		else
		{
			$string.="o.ter_dayclosedate  between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
		}
	
	}
else if($bydatz=="Last365days")
	{
		if($string !="")
		{
		$string.="and o.ter_dayclosedate  between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
		}
		else
		{
		$string.="o.ter_dayclosedate  between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
		}
			
	}
	

	
		 }
		 
		 
		 
		 
		 
		else if($_REQUEST['from']!="" && $_REQUEST['to']!="")
		{
			
			$from=$database->convert_date($_REQUEST['from']);
			
			$to=$database->convert_date($_REQUEST['to']);
			if($string !="")
			{
			$string.= " and o.ter_dayclosedate  between '".$from."' and '".$to."' ";
			}
			else
			{
				$string.= "o.ter_dayclosedate  between '".$from."' and '".$to."' ";
			}
		
			
			
		}
	 else if ($_REQUEST['from']!="" && $_REQUEST['to']=="")
		{
				
			$from=$database->convert_date($_REQUEST['from']);
			$to=date("Y-m-d");
				if($string !="")
			{
			$string.= "and o.ter_dayclosedate  between '".$from."' and '".$to."' ";
			}
			else
			{
			$string.= "o.ter_dayclosedate  between '".$from."' and '".$to."' ";
			}
				
		}
		else if($_REQUEST['from']=="" && $_REQUEST['to']!="")
		{
				
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['to']);
			if($string !="")
			{
			$string.= "and o.ter_dayclosedate  between '".$from."' and '".$to."' ";
			}
			else
			{
			$string.= "o.ter_dayclosedate  between '".$from."' and '".$to."' ";
			}
				
		}
		
		
			else
		{
			
			
			
				$from=date("Y-m-d");
			$to=date("Y-m-d");
			
			if($string !="")
			{
			$string.= " and o.ter_dayclosedate  between '".$from."' and '".$to."' ";
			}
			else
			{
				$string.= " o.ter_dayclosedate  between '".$from."' and '".$to."' ";	
			}
		
		}
	
	}
	else if(isset($_REQUEST['set']))
	{
	$string="";
	$string="o.ter_status='Closed' AND ";
	if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= "  ( o.ter_dayclosedate  between '".$from."' and '".$to."' ) ";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= "  ( o.ter_dayclosedate  between '".$from."' and '".$to."' ) ";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= "  ( o.ter_dayclosedate  between '".$from."' and '".$to."' )  ";
		}else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']=="")
		{
			$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "  ( o.ter_dayclosedate  between '".$from."' and '".$to."' )  ";
		}
		
			$floorval=$_REQUEST['floorval'];
			if($floorval !="")
			{
		if($string!="")
	
	{
		
		$string.=" and m.mr_kotcounter='".$floorval."' ";
	}
		
		else
		{
			$string.="m.mr_kotcounter='".$floorval."' ";
		}
			}
		
		
		
		
	}
	else if(isset($_REQUEST['abc']))
	{
		
		
	
		
	$string="";
	
	$string="o.ter_status='Closed' AND ";
		
		
			$orderbydate=$_REQUEST['orderbydate'];
	
			if($orderbydate!="null")
			
	{
		//$search="";
	
	if($orderbydate=="Last5days")
	{
		$string.="  o.ter_dayclosedate   between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($orderbydate=="Last10days")
	{
		$string.="  o.ter_dayclosedate   between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	elseif($orderbydate=="Last15days")
	{
		$string.="  o.ter_dayclosedate  between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($orderbydate=="Last20days")
	{
		$string.="  o.ter_dayclosedate   between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($orderbydate=="Last25days")
	{
		$string.=" o.ter_dayclosedate   between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($orderbydate=="Last30days")
	{
		$string.="  o.ter_dayclosedate   between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	else if($orderbydate=="Today")
	{
		$string.="  o.ter_dayclosedate   between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}


else if($orderbydate=="Yesterday")
			  {
				  $string.=" o.ter_dayclosedate  =  CURDATE() - INTERVAL 1 day";
			  }
	else if($orderbydate=="Last1month")
	{
		$string.="  o.ter_dayclosedate  between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
	}
	else if($orderbydate=="Last90days")
	{
		$string.="  o.ter_dayclosedate   between CURDATE( ) - INTERVAL  3 MONTH AND CURDATE( )"; 
	}
		else if($orderbydate=="Last180days")
	{
		$string.="  o.ter_dayclosedate   between CURDATE( ) - INTERVAL  6 MONTH AND CURDATE( )"; 
	}
		else if($orderbydate=="Last365days")
	{
		$string.="  o.ter_dayclosedate   between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}
	}
	else
	{
			$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " o.ter_dayclosedate   between '".$from."' and '".$to."' ";
	}
	
	
		$floorval=$_REQUEST['floorval'];
			if($floorval !="")
			{
		if($string!="")
	
	{
		
		$string.=" and m.mr_kotcounter='".$floorval."' ";
	}
		
		else
		{
			$string.="m.mr_kotcounter='".$floorval."' ";
		}
			}
	
	
	
	
	}
	
	else
	{
		
	$string="";
	
	$string=" o.ter_status='Closed' AND ";
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "  ( o.ter_dayclosedate  between '".$from."' and '".$to."' )  ";
			
					
/*			if($_REQUEST['floorval'] !="")
			{
				$floorval=$_REQUEST['floorval'];
		if($string!="")
	
	{
		
		$string.="and o.ter_floorid='".$floorval."' ";
	}
		
		else
		{
			$string.="o.ter_floorid='".$floorval."' ";
		}
			}*/
			
	}  
		
/*	echo "SELECT mc.mmy_maincategoryname,ms.msy_subcategoryname,m.mr_menuname,p.pm_portionname,f.fr_floorname,sum(o.ter_qty) as qty,ROUND(avg(o.ter_rate), 1) as Unit_Price, ((sum(o.ter_qty))*(ROUND(avg(o.ter_rate), 1))) as Total from tbl_tableorder o left join tbl_menumaster m on m.mr_menuid = o.ter_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = m.mr_maincatid left join tbl_menusubcategory ms on ms.msy_subcategoryid = m.mr_subcatid left join tbl_portionmaster p on p.pm_id = o.ter_portion left join tbl_floormaster f on f.fr_floorid = o.ter_floorid where $string group by m.mr_maincatid ,m.mr_subcatid,o.ter_menuid,o.ter_portion,o.ter_floorid ORDER BY m.mr_maincatid,m.mr_subcatid  DESC";	
		die();  */
	
		
	  $sql_stw  =  $database->mysqlQuery("select m.mr_kotcounter,o.ter_menuid, m.mr_menuname,sum(o.ter_qty) as qty, o.ter_rate*sum(o.ter_qty) as tot from tbl_tableorder o
inner join tbl_menumaster m on m.mr_menuid = o.ter_menuid
where $string
group by o.ter_menuid");
         
	  $num_stw   = $database->mysqlNumRows($sql_stw);	  
		  
		    if($num_stw)
	  {
	 echo "ok";
		  }else
		  {
			 echo "sorry";
		  }

}
else if(($_REQUEST['type']=="portion_order"))

{
	
	$string="";
	//$prtn=$_REQUEST['portn'];
	if(isset($_REQUEST['set']))
	{
		$prtn=$_REQUEST['portn'];
	if($prtn !="null")
	{
		if($string!="")
		{
			$string.=" and  tbl_tableorder.ter_portion  LIKE  '%" . $prtn ."%'";
		}else
		{
			$string.=" tbl_tableorder.ter_portion  LIKE  '%" . $prtn ."%'";
		}
	}
	if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			if($string!="")
			{
			$string.= " and ( tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' ) ";
			}
			
			else
			{
				$string.= "  ( tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' ) ";
				
			}
			
			
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			if($string!="")
			{
			$string.= " and ( tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' ) ";
			}
			else
			{
				$string.= "  ( tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' ) ";
			}
			
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			if($string!="")
			{
			$string.= " and ( tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' )  ";
			}
			else
			{
				$string.= "  ( tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' ) ";
			}
			
		
		}else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']=="")
		{
			$from=date("Y-m-d");
			$to=date("Y-m-d");
			if($string!="")
			{
			$string.= " and ( tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' )  ";
			}
			else
			{
				$string.= "  ( tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' ) ";
			}
			
		} 
		
		
		  $sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_portionmaster.pm_portionname,tbl_menumaster.mr_menuname as menuname From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid Inner Join  tbl_portionmaster ON tbl_tableorder.ter_portion=tbl_portionmaster.pm_id  where $string Group By tbl_menumaster.mr_menuname order by ct DESC");
		
		 $num_stw   = $database->mysqlNumRows($sql_stw);

	  if($num_stw){
		  echo "ok";
	  }else
	  {
		  echo "sorry";
	  }

		
	}
	
	else if(isset($_REQUEST['port']))
	{
		
		$prtn=$_REQUEST['portn'];
		$portionbydate=$_REQUEST['portionbydate'];
	/*if($prtn !="null")
	{
		if($string!="")
		{
			$string.=" and  tbl_tableorder.ter_portion  LIKE  '%" . $prtn ."%'";
		}else
		{
			$string.=" tbl_tableorder.ter_portion  LIKE  '%" . $prtn ."%'";
		}
	}*/

	if($portionbydate!="null")
	{
		if($prtn !="null")
		{
			
		//$search="";
	if($portionbydate=="Last5days")
	{
		$string.="  tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 5 
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
	
else if($portionbydate=="Yesterday")
			  {
				  $string.=" tbl_tableorder.ter_dayclosedate  =CURDATE() - INTERVAL 1 day";
			  }
	else if($portionbydate=="Last1month")
	{
		$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
	}
	else if($portionbydate=="Last90days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}

else if($portionbydate=="Last180days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($portionbydate=="Last365days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}
	  $sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_portionmaster.pm_portionname,tbl_menumaster.mr_menuname as menuname From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid Inner Join  tbl_portionmaster ON tbl_tableorder.ter_portion=tbl_portionmaster.pm_id  where   $string and tbl_tableorder.ter_portion='".$prtn."' Group By tbl_menumaster.mr_menuname order by ct DESC"); 
	//  echo "Select count(*)  as ct,tbl_menumaster.mr_menuname as menuname From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid Inner Join tbl_staffmaster On tbl_tableorder.ter_staff = tbl_staffmaster.ser_staffid where tbl_tableorder.ter_portion='".$prtn."'  $string Group By tbl_menumaster.mr_menuname order by ct DESC";
	 $num_stw   = $database->mysqlNumRows($sql_stw);
	  if($num_stw){
		  echo "ok";
	  }else
	  {
		  echo "sorry";
	  }
	
		}
		
		else
		{
			
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
	

else if($paybydate=="Yesterday")
			  {
				  $string.=" tbl_tableorder.ter_dayclosedate   =CURDATE() - INTERVAL 1 day";
			  }
	else if($paybydate=="Last1month")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
	}
	else if($portionbydate=="Last90days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}

else if($portionbydate=="Last180days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($portionbydate=="Last365days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}
			
			
			  $sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_portionmaster.pm_portionname,tbl_menumaster.mr_menuname as menuname From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid Inner Join  tbl_portionmaster ON tbl_tableorder.ter_portion=tbl_portionmaster.pm_id  where  $string Group By tbl_menumaster.mr_menuname order by ct DESC"); 
	//  echo "Select count(*)  as ct,tbl_menumaster.mr_menuname as menuname From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid Inner Join tbl_staffmaster On tbl_tableorder.ter_staff = tbl_staffmaster.ser_staffid where tbl_tableorder.ter_portion='".$prtn."'  $string Group By tbl_menumaster.mr_menuname order by ct DESC";
	 $num_stw   = $database->mysqlNumRows($sql_stw);

	  if($num_stw){
		  echo "ok";
	  }else
	  {
		  echo "sorry";
	  }
		}
	}
	  else
	  {
		  
		  	$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
			$sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_portionmaster.pm_portionname,tbl_menumaster.mr_menuname as menuname From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid Inner Join  tbl_portionmaster ON tbl_tableorder.ter_portion=tbl_portionmaster.pm_id  where $string Group By tbl_menumaster.mr_menuname order by ct DESC"); 
	//  echo "Select count(*)  as ct,tbl_menumaster.mr_menuname as menuname From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid Inner Join tbl_staffmaster On tbl_tableorder.ter_staff = tbl_staffmaster.ser_staffid where tbl_tableorder.ter_portion='".$prtn."'  $string Group By tbl_menumaster.mr_menuname order by ct DESC";
	 $num_stw   = $database->mysqlNumRows($sql_stw);
//echo $num_stw;
//die();
	  if($num_stw){
		  echo "ok";
	  }else
	  {
		  echo "sorry";
	  }
			
	  }

	
	}
	else if(isset($_REQUEST['abc']))
	{
		$prtn=$_REQUEST['portn'];
			$portionbydate=$_REQUEST['portionbydate'];
	/*		if($prtn !="null")
	{
		if($string!="")
		{
			$string.=" and  tbl_tableorder.ter_portion  LIKE  '%" . $prtn ."%'";
		}else
		{
			$string.=" tbl_tableorder.ter_portion  LIKE  '%" . $prtn ."%'";
		}
	}
		*/
	if($portionbydate!="null")
	{
		if($prtn !="null")
		{
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
	

else if($portionbydate=="Yesterday")
			  {
				  $string.=" tbl_tableorder.ter_dayclosedate  =CURDATE() - INTERVAL 1 day";
			  }
	else if($portionbydate=="Last1month")
	{
		$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
	}
	else if($portionbydate=="Last90days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}

else if($portionbydate=="Last180days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($portionbydate=="Last365days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 1 YEAR
		 AND CURDATE( )"; 
	}
		  $sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_portionmaster.pm_portionname,tbl_menumaster.mr_menuname as menuname From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid Inner Join  tbl_portionmaster ON tbl_tableorder.ter_portion=tbl_portionmaster.pm_id  where tbl_tableorder.ter_portion='".$prtn."'  and $string Group By tbl_menumaster.mr_menuname order by ct DESC"); 
		    $num_stw   = $database->mysqlNumRows($sql_stw);


	  if($num_stw){
		  echo "ok";
	  }else
	  {
		  echo "sorry";
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
				  $string.=" tbl_tableorder.ter_dayclosedate  = CURDATE() - INTERVAL 1 day";
			  }
	else if($portionbydate=="Last1month")
	{
		$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
	}
	
	

else if($portionbydate=="Last180days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($portionbydate=="Last365days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}	
			
		else
		{
			$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
		}
	$sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_portionmaster.pm_portionname,tbl_menumaster.mr_menuname as menuname From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid Inner Join  tbl_portionmaster ON tbl_tableorder.ter_portion=tbl_portionmaster.pm_id  where  $string Group By tbl_menumaster.mr_menuname order by ct DESC"); 
	
		    $num_stw   = $database->mysqlNumRows($sql_stw);

//echo $num_stw;
	  if($num_stw){
		  echo "ok";
	  }else
	  {
		  echo "sorry";
	  }	
	}
	
	
	
	}
	
	
	
	else
	{
			$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
			 $sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_portionmaster.pm_portionname,tbl_menumaster.mr_menuname as menuname From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid Inner Join  tbl_portionmaster ON tbl_tableorder.ter_portion=tbl_portionmaster.pm_id  where   $string Group By tbl_menumaster.mr_menuname order by ct DESC"); 
			   $num_stw   = $database->mysqlNumRows($sql_stw);
//echo $num_stw;

	  if($num_stw){
		  echo "ok";
	  }else
	  {
		  echo "sorry";
	  }
		
	}
	
	
	
	
	 
//echo "Select count(*)  as ct,tbl_menumaster.mr_menuname as menuname From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid Inner Join tbl_staffmaster On tbl_tableorder.ter_staff = tbl_staffmaster.ser_staffid where $string   Group By tbl_menumaster.mr_menuname order by ct DESC";
	
		
		
		
	
	}
	
	
	
	
		else
		{
			
	$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "  ( tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' )  ";
		
			 	  $sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_portionmaster.pm_portionname,tbl_menumaster.mr_menuname as menuname From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid Inner Join  tbl_portionmaster ON tbl_tableorder.ter_portion=tbl_portionmaster.pm_id  where   $string Group By tbl_menumaster.mr_menuname order by ct DESC"); 
				    $num_stw   = $database->mysqlNumRows($sql_stw);


	  if($num_stw){
		  echo "ok";
	  }else
	  {
		  echo "sorry";
	  }
		
		}

	 /* $num_stw   = $database->mysqlNumRows($sql_stw);
echo $num_stw;
die();*/
	 /* if($num_stw){
		  echo "ok";
	  }else
	  {
		  echo "sorry";
	  }*/
		
		
		
		
		
	}	


	 
	





else if(($_REQUEST['type']=="type_order"))
{
	$string="";
	$ordtype=$_REQUEST['ordtype'];
	
	
		if(isset($_REQUEST['set']))
	{
	if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= "  ( tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' ) ";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= "  ( tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' ) ";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= "  ( tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' )  ";
		}else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']=="")
		{
			$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "  ( tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' )  ";
		} 
			  $sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_menumaster.mr_menuname as menuname From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid WHERE  $string and tbl_tableorder.ter_type='".$ordtype."' Group By tbl_menumaster.mr_menuname  DESC"); 
	
		
		
	}
	
else if(isset($_REQUEST['abc']))
	{
		
		$ordtype=$_REQUEST['ordtype'];
	$string="";
	
		$ordertypebydate=$_REQUEST['ordertypebydate'];
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
				  $string.=" tbl_tableorder.ter_dayclosedate  = CURDATE() - INTERVAL 1 day";
			  }
	else if($ordertypebydate=="Last1month")
	{
		$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 1 
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
		
		
		
		
		
		
		
		
		
		/*
		if($_REQUEST['abc']==1)
		{
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " ( tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' )  ";
			
		}
		else
		{
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " ( tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' )  ";
		}
		*/
			  $sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_menumaster.mr_menuname as menuname From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid WHERE  $string and tbl_tableorder.ter_type='".$ordtype."' Group By tbl_menumaster.mr_menuname  DESC"); 
	//echo "Select count(*)  as ct,tbl_menumaster.mr_menuname as menuname From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid WHERE  $string and tbl_tableorder.ter_type='".$ordtype."' Group By tbl_menumaster.mr_menuname  DESC";
	
	}
	
	else if(isset($_REQUEST['typeord']	))

	{
		
	$ordtype=$_REQUEST['ordtype'];
	$string="";
	
		$ordertypebydate=$_REQUEST['ordertypebydate'];
	if($ordertypebydate!="null")
	{
		//$search="";
	if($ordertypebydate=="Last5days")
	{
		$string.=" and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($ordertypebydate=="Last10days")
	{
		$string.=" and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	elseif($ordertypebydate=="Last15days")
	{
		$string.=" and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($ordertypebydate=="Last20days")
	{
		$string.=" and tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($ordertypebydate=="Last25days")
	{
		$string.=" and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($ordertypebydate=="Last30days")
	{
		$string.=" and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	else if($ordertypebydate=="Today")
	{
		$string.=" and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	
else if($ordertypebydate=="Yesterday")
			  {
				  $string.=" and tbl_tableorder.ter_dayclosedate  = CURDATE() - INTERVAL 1 day";
			  }
	else if($ordertypebydate=="Last1month")
	{
		$string.=" and tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
	}
	else if($ordertypebydate=="Last90days")
	{
		$string.=" and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}

else if($ordertypebydate=="Last180days")
	{
		$string.=" and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($ordertypebydate=="Last365days")
	{
		$string.=" and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 1 year AND CURDATE( )"; 
	}


	}
	
	else
	{
		$string.=" and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	  //$sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_menumaster.mr_menuname as menuname From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid WHERE  $string and tbl_tableorder.ter_type='".$ordtype."' Group By tbl_menumaster.mr_menuname  DESC"); 
	
	
$sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_menumaster.mr_menuname as menuname From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid Inner Join tbl_staffmaster On tbl_tableorder.ter_staff = tbl_staffmaster.ser_staffid Where  tbl_tableorder.ter_type =  '".$ordtype."' $string Group By tbl_menumaster.mr_menuname order by ct DESC");
//
//$num_stw   = $database->mysqlNumRows($sql_stw);
//
//
//	  if($num_stw){
//		  echo "ok";
//	  }else
//	  {
//		  echo "sorry";
//	  }
}
	
	
	
	
	else
	{
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " ( tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' )  ";
			  $sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_menumaster.mr_menuname as menuname From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid WHERE  $string and tbl_tableorder.ter_type='".$ordtype."' Group By tbl_menumaster.mr_menuname  DESC"); 
	
	}
	
 	
	  
	  
	  $num_stw   = $database->mysqlNumRows($sql_stw);
	
	  if($num_stw){echo "ok";}else{echo "sorry";}
	 
}


else if(($_REQUEST['type']=="cancel_history"))
{
	$string="";
	//$ordtype=$_REQUEST['ordtype'];
	
	$sql_stw='';
		if(isset($_REQUEST['set']))
	{
	if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= "  ( ch.ch_dayclosedate  between '".$from."' and '".$to."' ) ";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= "  ( ch.ch_dayclosedate  between '".$from."' and '".$to."' ) ";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= "  ( ch.ch_dayclosedate  between '".$from."' and '".$to."' )  ";
		}else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']=="")
		{
			$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "  ( ch.ch_dayclosedate  between '".$from."' and '".$to."' )  ";
		} 
		//Select ch.ch_date,sm.ser_firstname,ch.ch_orderno,ch.ch_orderslno,ch.ch_qty,ch_entrytime From tbl_tablecancelhistory as ch LEFT JOIN tbl_staffmaster as sm ON sm.ser_staffid=ch.ch_staffid WHERE ch.ch_orderno='EX190915-3' AND (ch.ch_date BETWEEN '2015-09-01' AND '2015-09-30')
		
		
	
		
			  $sql_stw  =  $database->mysqlQuery("Select  ch.ch_dayclosedate,ch_kotno,sm.ser_firstname,ch.ch_orderno,ch.ch_orderslno,ch.ch_cancelled_qty,ch_cancelledreason,ld.ls_username,m.mr_menuname From tbl_tableorder_changes as ch LEFT JOIN tbl_staffmaster as sm ON sm.ser_staffid=ch.ch_cancelledby_careof left join tbl_logindetails as ld on ld.ls_username=ch.ch_cancelledlogin left join tbl_tableorder as t ON t.ter_orderno = ch.ch_orderno and t.ter_slno = ch_orderslno left join tbl_menumaster as m on m.mr_menuid = t.ter_menuid  where  $string "); 
	
		
		
	}
	
else if(isset($_REQUEST['abc']))
	{
		
		//$ordtype=$_REQUEST['ordtype'];
	$string="";
	
		$ordertypebydate=$_REQUEST['ordertypebydate'];
	if($ordertypebydate!="null")
	{
		//$search="";
	if($ordertypebydate=="Last5days")
	{
		$string.="  ch.ch_dayclosedate    between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($ordertypebydate=="Last10days")
	{
		$string.="  ch.ch_dayclosedate   between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	elseif($ordertypebydate=="Last15days")
	{
		$string.="  ch.ch_dayclosedate    between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($ordertypebydate=="Last20days")
	{
		$string.="  ch.ch_dayclosedate  between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($ordertypebydate=="Last25days")
	{
		$string.="  ch.ch_dayclosedate   between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($ordertypebydate=="Last30days")
	{
		$string.="  ch.ch_dayclosedate  between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	else if($ordertypebydate=="Today")
	{
		$string.="  ch.ch_dayclosedate    between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	
else if($ordertypebydate=="Yesterday")
			  {
				  $string.="  ch.ch_dayclosedate   = CURDATE() - INTERVAL 1 day";
			  }
	else if($ordertypebydate=="Last1month")
	{
		$string.="  ch.ch_dayclosedate   between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
	}
	
	else if($ordertypebydate=="Last90days")
	{
		$string.="  ch.ch_dayclosedate   between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}

else if($ordertypebydate=="Last180days")
	{
		$string.="  ch.ch_dayclosedate    between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($ordertypebydate=="Last365days")
	{
		$string.="  ch.ch_dayclosedate    between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}


	}
	
	else
	{
		$string.="  ch.ch_dayclosedate    between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
		
		
		
		
		
		
		
		
		
		/*
		if($_REQUEST['abc']==1)
		{
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " ( tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' )  ";
			
		}
		else
		{
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " ( tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' )  ";
		}
		*/
			  $sql_stw  =  $database->mysqlQuery("Select  ch.ch_dayclosedate,ch_kotno,sm.ser_firstname,ch.ch_orderno,ch.ch_orderslno,ch.ch_cancelled_qty,ch_cancelledreason,ld.ls_username,m.mr_menuname From tbl_tableorder_changes as ch LEFT JOIN tbl_staffmaster as sm ON sm.ser_staffid=ch.ch_cancelledby_careof left join tbl_logindetails as ld on ld.ls_username=ch.ch_cancelledlogin left join tbl_tableorder as t ON t.ter_orderno = ch.ch_orderno and t.ter_slno = ch_orderslno left join tbl_menumaster as m on m.mr_menuid = t.ter_menuid where  $string  "); 
	//echo "Select count(*)  as ct,tbl_menumaster.mr_menuname as menuname From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid WHERE  $string and tbl_tableorder.ter_type='".$ordtype."' Group By tbl_menumaster.mr_menuname  DESC";
	
	}
	
	
	
	
	
	
	else
	{
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " ( ch.ch_dayclosedate  between '".$from."' and '".$to."' )  ";
			  $sql_stw  =  $database->mysqlQuery("Select  ch.ch_dayclosedate,ch_kotno,sm.ser_firstname,ch.ch_orderno,ch.ch_orderslno,ch.ch_cancelled_qty,ch_cancelledreason,ld.ls_username,m.mr_menuname From tbl_tableorder_changes as ch LEFT JOIN tbl_staffmaster as sm ON sm.ser_staffid=ch.ch_cancelledby_careof left join tbl_logindetails as ld on ld.ls_username=ch.ch_cancelledlogin left join tbl_tableorder as t ON t.ter_orderno = ch.ch_orderno and t.ter_slno = ch_orderslno left join tbl_menumaster as m on m.mr_menuid = t.ter_menuid where $string  "); 
	
	}

	
 	
	  
	  
	  $num_stw   = $database->mysqlNumRows($sql_stw);
	
	  if($num_stw){echo "ok";}else{echo "Sorry";}
	 
}
else if(($_REQUEST['type']=="kot_report"))
{
	
	$string="";
	$string=" tor.ter_status='Closed' AND ";
	if(isset($_REQUEST['set']))
	{
		//echo $_REQUEST['fromdt'] ."--";
		//echo $_REQUEST['todt'] ."<br>";
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " tor.ter_dayclosedate  between '".$from."' and '".$to."' order by tor.ter_kotno ";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " tor.ter_dayclosedate  between '".$from."' and '".$to."' order by tor.ter_kotno ";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " tor.ter_dayclosedate  between '".$from."' and '".$to."' order by tor.ter_kotno ";
		}
	}
	
	else if(isset($_REQUEST['abc']))
	{
		
		$bydatz=$_REQUEST['bydate'];
		
		
		
			if($bydatz!="null")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.=" tor.ter_dayclosedate  between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($bydatz=="Last10days")
	{
		$string.=" tor.ter_dayclosedate  between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.=" tor.ter_dayclosedate  = CURDATE() - INTERVAL 1 day";
			  }
	elseif($bydatz=="Last15days")
	{
		$string.=" tor.ter_dayclosedate  between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" tor.ter_dayclosedate  between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last25days")
	{
		$string.=" tor.ter_dayclosedate  between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last30days")
	{
		$string.=" tor.ter_dayclosedate  between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	 else if($bydatz=="Last1month")
			  {
				  $string.=" tor.ter_dayclosedate  between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
	else if($bydatz=="Today")
	{
		$string.=" tor.ter_dayclosedate  between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
else if($bydatz=="Last90days")
	{
		$string.=" tor.ter_dayclosedate  between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last180days")
	{
		$string.=" tor.ter_dayclosedate  between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last365days")
	{
		$string.=" tor.ter_dayclosedate  between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}

	}
	else
	{
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " tor.ter_dayclosedate  between '".$from."' and '".$to."' ";
	}
		
 }
	
	
	
	
	else
	{
		$cur=date("Y-m-d");
		$string.=" tor.ter_dayclosedate ='".$cur."'";
	}

  $sql_login  =  $database->mysqlQuery("select tor.ter_kotno,mm.mr_menuname,(tor.ter_rate * tor.ter_qty) as rate from tbl_tableorder as tor LEFT JOIN tbl_menumaster as mm ON tor.ter_menuid=mm.mr_menuid where $string"); 
  
	  $num_login   = $database->mysqlNumRows($sql_login);
	
	  if($num_login)
	  {
			echo "ok";
	  }else
	  {
		  echo "sorry";
	  }

}

else if($_REQUEST['type']=="complementary_report")
{
	
	
	$string="";
	$string=" bm_status='Closed' AND bm_complimentary='Y' AND ";
	if(isset($_REQUEST['set']))
	{
		//echo $_REQUEST['fromdt'] ."--";
		//echo $_REQUEST['todt'] ."<br>";
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
		}
	}
	
	else if(isset($_REQUEST['abc']))
	{
		
		$bydatz=$_REQUEST['bydate'];
		
		
		
			if($bydatz!="null")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($bydatz=="Last10days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.=" bm_dayclosedate =CURDATE() - INTERVAL 1 day";
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
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	 else if($bydatz=="Last1month")
			  {
				  $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
	else if($bydatz=="Today")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
else if($bydatz=="Last90days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last180days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last365days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}

	}
	else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
	}
		
	}
	else
	{
		$cur=date("Y-m-d");
		$string.=" bm_dayclosedate='".$cur."'";
	}

  $sql_login  =  $database->mysqlQuery("select * from tbl_tablebillmaster where $string"); 

     $num_login   = $database->mysqlNumRows($sql_login);

	  if($num_login)
	  {
			echo "ok";
			
			
	  }else
	  {
		  echo "sorry";
		 
		  
	  }


}

else if($_REQUEST['type']=="credit_details")
{
	
	$string="";
	  $reporthead="";
	  $st="";
          if($_REQUEST['catgry']!="")
	    {
		$bycat=$_REQUEST['catgry'];
		$string.=" c.crd_type='".$bycat."' and  ";
            }
	  	if($_REQUEST['from']!="" && $_REQUEST['to']!="")
		{
			$from=$database->convert_date($_REQUEST['from']);
			$to=$database->convert_date($_REQUEST['to']);
			$string.= " (bm.bm_dayclosedate between '".$from."' and '".$to."'  or tbm.tab_dayclosedate between '".$from."' and '".$to."' ) ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                }		
	
		else if($_REQUEST['from']!="" && $_REQUEST['to']=="")
		{
			$from=$database->convert_date($_REQUEST['from']);
			$to=date("Y-m-d");
			$string.= " (bm.bm_dayclosedate between '".$from."' and '".$to."'  or tbm.tab_dayclosedate between '".$from."' and '".$to."' )  ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                }			
		else if($_REQUEST['from']=="" && $_REQUEST['to']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['to']);
			$string.= "  (bm.bm_dayclosedate between '".$from."' and '".$to."'  or tbm.tab_dayclosedate between '".$from."' and '".$to."' ) ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                }	
					
	else
	{
	
            $bydatz=$_REQUEST['hidbydate'];
	if($bydatz!="null" )	 
	{
	if($bydatz=="Last5days")
	{
            $string.="(bm.bm_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( ) or tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( ))";
            $st="Last 5 days";
	}elseif($bydatz=="Last10days")
	{
            $string.=" (bm.bm_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( ) or tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( ))";
            $st="Last 10 days";
	}
	elseif($bydatz=="Last15days")
	{
            $string.=" (bm.bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( ) or tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( ))";
            $st="Last 15 days";
	}
	else if($bydatz=="Last20days")
	{
            $string.=" (bm.bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( ) or tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( ))";
            $st="Last 20 days";
	}
	else if($bydatz=="Last25days")
	{   
            $string.=" (bm.bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( ) or tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( ))";
            $st="Last 25 days";
	}
	else if($bydatz=="Last30days")
	{
            $string.=" (bm.bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( ) or tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( ))";
            $st="Last 30 days";
	}
	else if($bydatz=="Today")
	{
            $string.=" (bm.bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( ) or tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( ))"; 
            $st="Today";
	}
	else if($bydatz=="Yesterday")
	{
            $string.=" (bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 DAY  or tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 DAY )";
            $st="Yesterday";
	}
	else if($bydatz=="Last1month")
	{
            $string.=" (bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) or tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ))";
            $st="Last 1 month";
        }
        else if($bydatz=="Last90days")
	{
            $string.=" (bm.bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( ) or tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( ))"; 
            $st="Last 3 months";
	}
        else if($bydatz=="Last180days")
	{
            $string.=" (bm.bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( ) or tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( ))"; 
            $st="Last 6 months";
	}
        else if($bydatz=="Last365days")
	{
            $string.=" (bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( ) or tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( ))"; 
            $st="Last 1 year";
	}
	$reporthead=$st;
        }
	else
	{
            $from=date("Y-m-d");
            $to=date("Y-m-d");
            $string.= "(bm.bm_dayclosedate between '".$from."' and '".$to."'  or tbm.tab_dayclosedate between '".$from."' and '".$to."' ) ";
            $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
        }		
	}
	

	$print="";
	$final=0;
        
 	  $sql_login  =  $database->mysqlQuery("select * from tbl_credit_master as c left join tbl_credit_details as cd on c.crd_id=cd.cd_masterid left join tbl_staffmaster as s on c.crd_staffid=s.ser_staffid left join tbl_roommaster as r on c.crd_roomid=r.rm_roomid left join tbl_corporatemaster as cm on c.crd_corporateid=cm.ct_corporatecode left join tbl_loyalty_reg  as l on c.crd_guestid=l.ly_id left join tbl_tablebillmaster bm on bm.bm_billno=cd.cd_billno  left join tbl_takeaway_billmaster tbm on tbm.tab_billno=cd.cd_billno  where $string  order by cd.cd_dateofentry ASC"); 
	 // echo "select * from tbl_credit_master as c left join tbl_credit_details as cd on c.crd_id=cd.cd_masterid left join tbl_staffmaster as s on c.crd_staffid=s.ser_staffid left join tbl_roommaster as r on c.crd_roomid=r.rm_roomid left join tbl_corporatemaster as cm on c.crd_corporateid=cm.ct_corporatecode left join tbl_loyalty_reg  as l on c.crd_guestid=l.ly_id left join tbl_tablebillmaster bm on bm.bm_billno=cd.cd_billno  left join tbl_takeaway_billmaster tbm on tbm.tab_billno=cd.cd_billno where $string  order by cd.cd_dateofentry ASC";
          $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login)
	  {
			echo "ok";
	  }else
	  {
		  echo "sorry";
	  }

}

else if($_REQUEST['type']== "daily_cost")
{
	$mnth=$_REQUEST['monthval'];
	$year=$_REQUEST['yrval'];

	$string="";
$search="";
	
	
	
	if(isset($_REQUEST['set']))
	{

	if($_REQUEST['monthval']!="null")
	    {
			   $bymonth=$_REQUEST['monthval'];
			
			if($string !="")
			{
	 
		$string.="and month(b.bm_dayclosedate)='".$bymonth."' ";

		
		
			}
			else
			{
					 
	 $string.="month(b.bm_dayclosedate)='".$bymonth."' ";

			}
			
			if($search !="")
		{
			/*if($string !="")
			{*/
			$search.="and  month(k.kndl_date)=' ".$bymonth."' ";
			/*}
			else
			{
				$search.="month(k.kndl_date)=' ".$bymonth."' ";
			}*/
		}
	      else
		  
		  {
			 	$search.="month(k.kndl_date)=' ".$bymonth."' ";
			  
		  }
	     }
		 
		 
		 if($_REQUEST['yrval']!="")
	    {
			  $yearval=$_REQUEST['yrval'];
			
			if($string !="")
			{
	 
		$string.="and year(b.bm_dayclosedate)='".$yearval."' ";
	
		
			}
			else
			{
					 
		$string.="year(b.bm_dayclosedate)='".$yearval."' ";
			}
			
			
				if($search !="")
		{
			$search.="and year(k.kndl_date)='".$yearval."' ";
		}
		else
		{
			$search.="year(k.kndl_date)='".$yearval."' ";
		}
		
		
	     }
		 
		if ($string !="")
		{
			$string ="where $string";
		} 
		if($search !="")
		{
		$search="where $search";
	}
	
		 	
			
      $sql_login  =  $database->mysqlQuery("select * from tbl_tablebillmaster as b   $string   order by b.bm_dayclosedate ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	
	  $sql_login1  =  $database->mysqlQuery("select * from inv_tbl_dailykitchen as k   $search  order by k.kndl_date ASC"); 
	  $num_login1   = $database->mysqlNumRows($sql_login1);

	   if($num_login == 0 && $num_login1 == 0)
	  {
		echo "sorry";
	
	  }else
	  {
	 echo "ok";
	  }

	}
	else if(isset ($_REQUEST['yr']))
	{
	if($_REQUEST['monthval']!="null")
	    {
			   $bymonth=$_REQUEST['monthval'];
			if($string !="")
			{
	 
		$string.="and month(b.bm_dayclosedate)='".$bymonth."' ";
			}
			else
			{
					 
	 $string.="month(b.bm_dayclosedate)='".$bymonth."' ";

			}
			
			if($search !="")
		{
			/*if($string !="")
			{*/
			$search.="and  month(k.kndl_date)=' ".$bymonth."' ";
			/*}
			else
			{
				$search.="month(k.kndl_date)=' ".$bymonth."' ";
			}*/
		}
	      else
		  
		  {
			 	$search.="month(k.kndl_date)=' ".$bymonth."' ";
			  
		  }
	     }
		 
		 if($_REQUEST['yrval']!="")
	    {
			  $yearval=$_REQUEST['yrval'];
			
			if($string !="")
			{
	 
		$string.="and year(b.bm_dayclosedate)='".$yearval."' ";
	
		
			}
			else
			{
					 
		$string.="year(b.bm_dayclosedate)='".$yearval."' ";
			}
			
			
				if($search !="")
		{
			$search.="and year(k.kndl_date)='".$yearval."' ";
		}
		else
		{
			$search.="year(k.kndl_date)='".$yearval."' ";
		}
		
	     }
		 
		if ($string !="")
		{
			$string ="where $string";
		} 
		if($search !="")
		{
		$search="where $search";
	}
      $sql_login  =  $database->mysqlQuery("select * from tbl_tablebillmaster as b   $string   order by b.bm_dayclosedate ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	
	  $sql_login1  =  $database->mysqlQuery("select * from inv_tbl_dailykitchen as k   $search  order by k.kndl_date ASC"); 
	  $num_login1   = $database->mysqlNumRows($sql_login1);
	
	   
	  
	  
	  
	  
	   if($num_login == 0 && $num_login1 == 0)
	  {
			echo "sorry";
			
			/*echo "select * from tbl_tablebillmaster as b   $string   order by b.bm_dayclosedate ASC ";
			echo "select * from inv_tbl_dailykitchen as k   $search  order by k.kndl_date ASC";*/
			
	
	  }else
	  {
		  echo "ok";
	  }

	}
	
	
}


else if($_REQUEST['type']=='kot_history')
{
	
	
	$string="";

	if(isset($_REQUEST['set']))
	{
		//echo $_REQUEST['fromdt'] ."--";
		//echo $_REQUEST['todt'] ."<br>";
		if($_REQUEST['fromdt']!="" )
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			
			$string.= " k.kr_date = '".$from."' and o.ter_dayclosedate = '".$from."'  ";
		}
		/*else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " kr_date between '".$from."' and '".$to."' order by kr_date";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " kr_date between '".$from."' and '".$to."' order by kr_date";
		}*/
	}
	
	else if(isset($_REQUEST['abc']))
	{/*
		
		$bydatz=$_REQUEST['bydate'];
		
		
		
			if($bydatz!="null")
	{
		$search="";
	
	if($bydatz=="Last5days")
	{
		$string.="kr_date between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($bydatz=="Last10days")
	{
		$string.="kr_date between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.="kr_date=CURDATE( ) - INTERVAL 1 DAY"; 
			  }
	elseif($bydatz=="Last15days")
	{
		$string.=" kr_date between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" kr_date between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last25days")
	{
		$string.="kr_date between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last30days")
	{
		$string.="kr_date between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	 else if($bydatz=="Last1month")
			  {
				  $string.="kr_date between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
	else if($bydatz=="Today")
	{
		$string.="kr_date between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
else if($bydatz=="Last90days")
	{
		$string.="kr_date between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last180days")
	{
		$string.="kr_date between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last365days")
	{
		$string.="kr_date between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}

	}
	else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "kr_date between '".$from."' and '".$to."' ";
	}
	*/}
	
	else
	{
		$cur=date("Y-m-d");
		$string.=" k.kr_date='".$cur."'  and o.ter_dayclosedate = '".$cur."' ";
	}







  $sql_login  =  $database->mysqlQuery("SELECT k.kr_date,k.kr_kotno as KOT ,k.kr_print as printed,o.ter_status as kot_status,mm.mr_menuname as menu ,pm.pm_portionname AS Portion,o.ter_qty as Qty,o.ter_rate as Unit_Rate, ROUND((o.ter_qty*o.ter_rate),2) as Total_Rate ,o.ter_billnumber FROM tbl_kotmaster K left join tbl_tableorder o on o.ter_kotno = k.kr_kotno LEFT JOIN tbl_menumaster mm ON o.ter_menuid=mm.mr_menuid LEFT JOIN tbl_portionmaster pm ON o.ter_portion=pm.pm_id where $string order by k.kr_time asc  "); 
  
	  $num_login   = $database->mysqlNumRows($sql_login);
	
	  if($num_login)
	  {
			echo "ok";
	  }else
	  {
		  echo "sorry";
	  }


	
	
	
	
}


else if($_REQUEST['type']=="loyality_customer")
{
		
	
	
	
	
	$string="";
	$reporthead="";
	$st="";
	
	if(isset($_REQUEST['set']))
	{
		//echo $_REQUEST['fromdt'] ."--";
		//echo $_REQUEST['todt'] ."<br>";
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date(date($_REQUEST['fromdt']));
			$to=$database->convert_date(date($_REQUEST['todt']));
			$string.= " date(lr.ly_entrydatetime) between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date(date($_REQUEST['fromdt']));
			$to=date("Y-m-d");
			$string.= " date(lr.ly_entrydatetime) between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date(date($_REQUEST['todt'] ));
			$string.= " date(lr.ly_entrydatetime) between '".$from."' and '".$to."' ";
		}
		
	$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
		
		
	}
	else if(isset($_REQUEST['abc']))
	{
		 $bydatz=$_REQUEST['bydate'];
	
			if($bydatz!="null")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.=" date(lr.ly_entrydatetime) between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";

$st="Last 5 days";
	}elseif($bydatz=="Last10days")
	{
		$string.=" date(lr.ly_entrydatetime) between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
$st="Last 10 days";

	}
	elseif($bydatz=="Last15days")
	{
		$string.=" date(lr.ly_entrydatetime) between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
$st="Last 15 days";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" date(lr.ly_entrydatetime) between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
$st="Last 20 days";
	}
	else if($bydatz=="Last25days")
	{
		$string.=" date(lr.ly_entrydatetime) between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
$st="Last 25 days";

	}
	else if($bydatz=="Last30days")
	{
		$string.=" date(lr.ly_entrydatetime) between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
$st="Last 30 days";
	}
	else if($bydatz=="Today")
	{
		$string.=" date(lr.ly_entrydatetime) between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
		$st="Today";
	}
	

else if($bydatz=="Yesterday")
			  {
				  $string.=" date(lr.ly_entrydatetime)= CURDATE( ) - INTERVAL 1 day";//" bm_dayclosedate =CURDATE() - 1  ";
				  $st="Yesterday";
			  }
	else if($bydatz=="Last1month")
	{
		$string.="  date(lr.ly_entrydatetime) between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
$st="Last 1 month";
	}
else if($bydatz=="Last90days")
	{
		$string.=" date(lr.ly_entrydatetime) between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
		$st="Last 3 months";
	}
else if($bydatz=="Last180days")
	{
		$string.=" date(lr.ly_entrydatetime) between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
			$st="Last 6 months";
	}
else if($bydatz=="Last365days")
	{
		$string.=" date(lr.ly_entrydatetime) between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
		$st="Last 1 year";
	}	
	$reporthead=$st;

	}
	else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " date(lr.ly_entrydatetime) between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
	}
		
	}
	else
	{
		$cur=date("Y-m-d");
		$string.=" date(lr.ly_entrydatetime)='".$cur."'";
	
	$reporthead="On ".$database->convert_date($cur);	


	}

	
    

  $sql_login  =  $database->mysqlQuery("select * from tbl_loyalty_reg as lr where $string order by lr.ly_entrydatetime ASC"); 
/*  echo "select * from tbl_tablebillmaster where $string";
  die();*/
	  $num_login   = $database->mysqlNumRows($sql_login);

 if($num_login)
	  {
			echo "ok";
	  }else
	  {
		  echo "sorry";
	  }
}



else if($_REQUEST['type']=="feedback_report")
{
	
	
	$string="";
	$string=" ter_feedbackenter='Y' AND ";
	if(isset($_REQUEST['set']))
	{
		//echo $_REQUEST['fromdt'] ."--";
		//echo $_REQUEST['todt'] ."<br>";
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " ter_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " ter_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " ter_dayclosedate between '".$from."' and '".$to."' ";
		}
	}
	
	else if(isset($_REQUEST['abc']))
	{
		
		$bydatz=$_REQUEST['bydate'];
		
		
		
			if($bydatz!="null")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.="ter_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($bydatz=="Last10days")
	{
		$string.="ter_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.="ter_dayclosedate=CURDATE( ) - INTERVAL 1 DAY"; 
			  }
	elseif($bydatz=="Last15days")
	{
		$string.=" ter_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" ter_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last25days")
	{
		$string.="ter_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last30days")
	{
		$string.="ter_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	 else if($bydatz=="Last1month")
			  {
				  $string.="ter_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
	else if($bydatz=="Today")
	{
		$string.="ter_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
else if($bydatz=="Last90days")
	{
		$string.="ter_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last180days")
	{
		$string.="ter_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last365days")
	{
		$string.="ter_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}

	}
	else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "ter_dayclosedate between '".$from."' and '".$to."' ";
	}
		
	
		
		
		
	}
	
	
	
	
	else
	{
		$cur=date("Y-m-d");
		$string.=" ter_dayclosedate='".$cur."'";
	}

  $sql_login  =  $database->mysqlQuery("select * from tbl_tableorder where $string order by ter_dayclosedate"); 
  
  

  
	  $num_login   = $database->mysqlNumRows($sql_login);
	
	  if($num_login)
	  {
			echo "ok";
	  }else
	  {
		  echo "sorry";
	  }


	
	
}


else if($_REQUEST['type']=="general_feedback")
{
	
	$string="";

	if(isset($_REQUEST['set']))
	{
		//echo $_REQUEST['fromdt'] ."--";
		//echo $_REQUEST['todt'] ."<br>";
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " date(f.fbr_entrytime) between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " date(f.fbr_entrytime) between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= "  date(f.fbr_entrytime) between '".$from."' and '".$to."' ";
		}
	}
	
	else if(isset($_REQUEST['abc']))
	{
		
		$bydatz=$_REQUEST['bydate'];
		
		
		
			if($bydatz!="null")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.=" date(f.fbr_entrytime) between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($bydatz=="Last10days")
	{
		$string.=" date(f.fbr_entrytime) between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.=" date(f.fbr_entrytime)=CURDATE( ) - INTERVAL 1 DAY"; 
			  }
	elseif($bydatz=="Last15days")
	{
		$string.=" date(f.fbr_entrytime) between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" date(f.fbr_entrytime) between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last25days")
	{
		$string.=" date(f.fbr_entrytime) between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last30days")
	{
		$string.=" date(f.fbr_entrytime) between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	 else if($bydatz=="Last1month")
			  {
				  $string.=" date(f.fbr_entrytime) between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
	else if($bydatz=="Today")
	{
		$string.=" date(f.fbr_entrytime) between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
else if($bydatz=="Last90days")
	{
		$string.=" date(f.fbr_entrytime) between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last180days")
	{
		$string.=" date(f.fbr_entrytime) between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last365days")
	{
		$string.=" date(f.fbr_entrytime) between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}

	}
	else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " date(f.fbr_entrytime) between '".$from."' and '".$to."' ";
	}
		
	
		
		
		
	}
	
	
	
	
	else
	{
		$cur=date("Y-m-d");
		$string.=" date(f.fbr_entrytime)='".$cur."'";
	}

  $sql_login  =  $database->mysqlQuery("select * from tbl_feedbackmaster fm left join tbl_feedbackrating f on fm.fbm_id=f.fbr_fbm_id  where $string order by date(f.fbr_entrytime)"); 
  
  

  
	  $num_login   = $database->mysqlNumRows($sql_login);
	
	  if($num_login)
	  {
			echo "ok";
	  }else
	  {
		  echo "sorry";
	  }

}
else if($_REQUEST['type']=="feedback_summary")
{
	 $sql_login  =  $database->mysqlQuery("select * from tbl_feedbackmaster as m  order by m.fbm_id"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	
	  if($num_login)
	  {
			echo "ok";
	  }else
	  {
		  echo "sorry";
	  }
}





else if($_REQUEST['type']=="menu_rating")
{
	$string="";
	 if(isset($_REQUEST['abc']))
	{
		$bydatz=$_REQUEST['bydate'];
		
			if($bydatz!="")
	{
		//$search="";
	$string.=" m.mr_menuname LIKE  '%" . $bydatz ."%' and m.mr_rating > '0' ";
	}
	else
	{
			$string= "m.mr_rating > '0'";
	}
	}
	else
	{
			$string= "m.mr_rating > '0'";
	}
	
	if($string !="")
	{
		$string="where $string";
	}
	
	

  $sql_login  =  $database->mysqlQuery("select * from tbl_menumaster as m  left join tbl_menumaincategory as mc on m.mr_maincatid=mc.mmy_maincategoryid left join tbl_menusubcategory as msc on m.mr_subcatid=msc.msy_subcategoryid   $string order by m.mr_menuid"); 
  
  

  
	  $num_login   = $database->mysqlNumRows($sql_login);
	
	  if($num_login)
	  {
			echo "ok";
	  }else
	  {
		  echo "sorry";
	  }
}

else if($_REQUEST['type']=="food_costing")
{
	
	
	$string="";
	 if(isset($_REQUEST['abc']))
	{
		$bydatz=$_REQUEST['bymenu'];
		
			if($bydatz!="")
	{
		//$search="";
	$string.=" rd.fc_menuid ='" . $bydatz ."' ";
	}
	else
	{
			
	}
	}
	else
	{
		
	}
	
	if($string !="")
	{
		//$string="where $string";

  $sql_login  =  $database->mysqlQuery("select * from fc_recipe_details as rd left join tbl_menumaster as m  on rd.fc_menuid=m.mr_menuid left join inv_tbl_productmaster as pm on rd.fc_ingredientid=pm.prm_productid  left join inv_tbl_unitmaster as u on rd.fc_ing_unit=u.um_id where $string order by rd.fc_menuid"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	
	  if($num_login)
	  {
			echo "ok";
	  }else
	  
		  echo "sorry";
	  }

else
{
	echo "sorry";
}
	
	
	
}

else if($_REQUEST['type']=="table_turnoversummary")
{
	
	
	
	
	$string="";
	$string.=" bm_status='Closed' and ";
            
            if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
                    $from=$database->convert_date($_REQUEST['fromdt']);
                    $to=$database->convert_date($_REQUEST['todt']);
                    $string.= " bm_dayclosedate  between '".$from."' and '".$to."' ";
                }
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
                    $from=$database->convert_date($_REQUEST['fromdt']);
                    $to=date("Y-m-d");
                    $string.= " bm_dayclosedate  between '".$from."' and '".$to."' ";
                }
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
                    $from=date("Y-m-d");
                    $to=$database->convert_date($_REQUEST['todt']);
                    $string.= " bm_dayclosedate  between '".$from."' and '".$to."' ";
                }
            
            else {
                
            $bydatz=$_REQUEST['bydate'];
            
            if($bydatz!="null")
            {
		if($bydatz=="Last5days")
                    {       
                        $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                        $st="Last 5 days";
                    }elseif($bydatz=="Last10days")
                    {
                        $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                        $st="Last 10 days";
                    }
                    elseif($bydatz=="Last15days")
                    {
                        $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                        $st="Last 15 days";
                    }
                    else if($bydatz=="Last20days")
                    {
                        $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                        $st="Last 20 days";
                    }
                    else if($bydatz=="Last25days")
                    {
                        $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                        $st="Last 25 days";
                    }else if($bydatz=="Last30days")
                    {
                        $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                        $st="Last 30 days";
                    }
                    else if($bydatz=="Today")
                    {
                        $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                        $st="Today";
                    }
                    else if($bydatz=="Yesterday")
                    {
			$string.=" bm_dayclosedate = CURDATE() - INTERVAL 1 day AND CURDATE( )";
			$st="Yesterday";
                    }
                    else if($bydatz=="Last1month")
                    {
                        $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
                        $st="Last 1 month";
                    }
                    else if($bydatz=="Last90days")
                    {
                        $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
                        $st="Last 3 months";
                    }
                    else if($bydatz=="Last180days")
                    {
                        $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
                        $st="Last 6 months";
                    }
                    else if($bydatz=="Last365days")
                    {
                        $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
			$st="Last 1 year";
                    }
                    
            }
            
	else
	{
            $cur=date("Y-m-d");
            $string.=" bm_dayclosedate='".$cur."'";
            $reporthead="On ".$database->convert_date($cur);		
	}
            }
  $sql_login  =  $database->mysqlQuery("select bm_finaltotal as tot,bm_tableno from tbl_tablebillmaster where $string   order by bm_finaltotal DESC"); 
//echo "select bm_finaltotal as tot,bm_tableno from tbl_tablebillmaster where $string   order by bm_finaltotal DESC";
  
	  $num_login   = $database->mysqlNumRows($sql_login);
	
	  if($num_login)
	  {
			echo "ok";
	  }else
	  {
		  echo "sorry";
	  }

}

else if($_REQUEST['type']=="summary_ham")
{
	$string="";
	$string=" bm_status='Closed' AND ";
	if(isset($_REQUEST['set']))
	{
		//echo $_REQUEST['fromdt'] ."--";
		//echo $_REQUEST['todt'] ."<br>";
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
		}
	}
	
	else if(isset($_REQUEST['abc']))
	{
		
		$bydatz=$_REQUEST['bydate'];
		
		
		
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
	else if($bydatz=="Yesterday")
			  {
				  $string.="bm_dayclosedate = CURDATE() - INTERVAL 1 day";
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
	 else if($bydatz=="Last1month")
			  {
				  $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
	else if($bydatz=="Today")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
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
	}
	else
	{
		$cur=date("Y-m-d");
		$string.=" bm_dayclosedate='".$cur."'";
	}

  $sql_login  =  $database->mysqlQuery("select * from tbl_tablebillmaster where $string"); 
  
	  $num_login   = $database->mysqlNumRows($sql_login);
	
	  if($num_login)
	  {
			echo "ok";
	  }else
	  {
		  echo "sorry";
	  }
	
}






else if($_REQUEST['type']=="checkmenu")
	 {
		$test= $_REQUEST['mid'];
	
	 $sql_login  =  $database->mysqlQuery("select (mr_menuname) from tbl_menumaster where mr_menuname='$test'"); 
	
	  
      $num_login   = $database->mysqlNumRows($sql_login);

	 
	  if($num_login =='1')
	  {
		 echo 'sorry';
	  }
	  else
	  {
		echo 'ok';
	  }
	 }
else if($_REQUEST['type'] == "categorywise_report")
{	$string="";
	$string="bm.bm_status = 'Closed'";
         if(isset ($_REQUEST['floorz']))
	{
	 $floorvalue=$_REQUEST['floorz'];
	if($_REQUEST['floorz']!='')
	{
		$string.=" and bm.bm_floorid='".$floorvalue."'";
		
	}
        }
        
 			
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
		    $from=$database->convert_date($_REQUEST['fromdt']);
		    $to=$database->convert_date($_REQUEST['todt']);
		    $string.= " and bm.bm_dayclosedate between '".$from."' and '".$to."'  ";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
                     $from=$database->convert_date($_REQUEST['fromdt']);
		     $to=date("Y-m-d");
		     $string.= " and bm.bm_dayclosedate between '".$from."' and '".$to."' ";
		}
                
					
					
            
	else 
	{
                $bydatz=$_REQUEST['bydate'];
                
                if($bydatz!="null" && $bydatz!="")
		{
	
                if($bydatz=="Last5days")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                }
                elseif($bydatz=="Last10days")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                }
                else if($bydatz=="Yesterday")
                {
                    $string.=" and bm.bm_dayclosedate = CURDATE() - INTERVAL 1 day";
                }
                elseif($bydatz=="Last15days")
                {
                    $string.="  and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                }
                else if($bydatz=="Last20days")
                {
                    $string.=" and  bm.bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                }
                else if($bydatz=="Last25days")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                }
                else if($bydatz=="Last30days")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                }
                else if($bydatz=="Last1month")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                }
                else if($bydatz=="Today")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                }
                else if($bydatz=="Last90days")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
                }
                else if($bydatz=="Last180days")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
                }
                else if($bydatz=="Last365days")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
                }
                }
                else
                {
		$from=date("Y-m-d");
	        $to=date("Y-m-d");
	        $string.= " and bm.bm_dayclosedate between '".$from."' and '".$to."' ";
                }
	}
        
      $sql_login  =  $database->mysqlQuery("SELECT mc.mmy_maincategoryname,count(distinct(bd.bd_menuid))as 'no of items',sum(bd.bd_qty) as qty ,sum(bd.bd_amount) as Total from tbl_tablebilldetails bd left join tbl_tablebillmaster bm on bm.bm_billno = bd.bd_billno left join tbl_menumaster on mr_menuid=bd.bd_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = mr_maincatid where $string group by mr_maincatid ORDER BY mr_maincatid ASC");
      //echo"SELECT mc.mmy_maincategoryname,count(distinct(bd.bd_menuid))as 'no of items',sum(bd.bd_qty) as qty ,sum(bd.bd_amount) as Total from tbl_tablebilldetails bd left join tbl_tablebillmaster bm on bm.bm_billno = bd.bd_billno left join tbl_menumaster on mr_menuid=bd.bd_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = mr_maincatid where $string group by mr_maincatid ORDER BY mr_maincatid ASC";
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