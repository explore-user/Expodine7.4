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

if($_REQUEST['type']=="tot_sales")
{
	 $date=date("Ymd");
	 $string=" bm_status='Closed' AND ";
	 
	 if($_REQUEST['floorz'] !='')
	{
		
			$string.=" bm_floorid='".$_REQUEST['floorz']."' AND ";
	}
	
	 
		if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
		}
		else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
		}
		else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
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
				  $string.="bm_dayclosedate = CURDATE() - INTERVAL 1 day";
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


	$cur=date("Y-m-d");
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
else if($_REQUEST['type']=="tax_detailed_cnb")
{
	 $date=date("Ymd");
	 $string=" bm_status='Closed' AND ";
	 
//	 if($_REQUEST['floorz'] !='')
//	{
//		
//			$string.=" bm_floorid='".$_REQUEST['floorz']."' AND ";
//	}
	
	 
		if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
		}
		else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
		}
		else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
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
				  $string.="bm_dayclosedate = CURDATE() - INTERVAL 1 day";
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


	$cur=date("Y-m-d");
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
else if($_REQUEST['type']=="sales_summary_zam")
{
	 $date=date("Ymd");
	 $string=" bm_status='Closed' AND ";
		if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
		}
		else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
		}
		else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
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
				  $string.="bm_dayclosedate = CURDATE() - INTERVAL 1 day";
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


	$cur=date("Y-m-d");
 	  $sql_login  =  $database->mysqlQuery("select * from tbl_tablebillmaster where $string");
//          echo "select * from tbl_tablebillmaster where $string";
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login)
	  {
			echo "ok";
	  }else
	  {
		  echo "sorry";
	  }

	
  
	
}
else if($_REQUEST['type']=="tax_sales_summary")
{
	 $date=date("Ymd");
	 $string=" bm_status='Closed' AND ";
		if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
		}
		else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
		}
		else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
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
				  $string.="bm_dayclosedate = CURDATE() - INTERVAL 1 day";
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


	$cur=date("Y-m-d");
 	  $sql_login  =  $database->mysqlQuery("select * from tbl_tablebillmaster where $string");
//          echo "select * from tbl_tablebillmaster where $string";
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login)
	  {
			echo "ok";
	  }else
	  {
		  echo "sorry";
	  }

	
  
	
}
else if($_REQUEST['type']=="cancel_history")
{
	 $date=date("Ymd");
         $string="";

	 
	
	
	 
		if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " ch.ch_dayclosedate between '".$from."' and '".$to."' order by ch.ch_dayclosedate";
		}
		else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=date("Y-m-d");
			$string.= " ch.ch_dayclosedate between '".$from."' and '".$to."' order by ch.ch_dayclosedate";
		}
		else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " ch.ch_dayclosedate between '".$from."' and '".$to."' order by ch.ch_dayclosedate";
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
		$string.="ch.ch_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($bydatz=="Last10days")
	{
		$string.="ch.ch_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" ch.ch_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" ch.ch_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last25days")
	{
		$string.="ch.ch_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last30days")
	{
		$string.="ch.ch_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Today")
	{
		$string.="ch.ch_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.="ch.ch_dayclosedate = CURDATE() - INTERVAL 1 day";
			  }
			   else if($bydatz=="Last1month")
			  {
				  $string.="ch.ch_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
else if($bydatz=="Last90days")
	{
		$string.="ch.ch_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last180days")
	{
		$string.="ch.ch_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last365days")
	{
		$string.="ch.ch_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}

	}
	else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "ch.ch_dayclosedate between '".$from."' and '".$to."' ";
	}
		
	
	
	
	
	
		
		/*$cur=date("Y-m-d");
		$string=" ch.ch_dayclosedate='".$cur."'";*/
	}


	$cur=date("Y-m-d");
 	$sql_login  =  $database->mysqlQuery("Select  ch.ch_dayclosedate,ch_kotno,ch.ch_entrydate,sm.ser_firstname,ch.ch_orderno,ch.ch_orderslno,ch.ch_cancelled_qty,ch_cancelledreason,ld.ls_username,m.mr_menuname,t.ter_entrytime 
        From tbl_tableorder_changes as ch 
        LEFT JOIN tbl_staffmaster as sm ON sm.ser_staffid=ch.ch_cancelledby_careof 
        left join tbl_logindetails as ld on ld.ls_username=ch.ch_cancelledlogin 
        left join tbl_tableorder as t ON t.ter_orderno = ch.ch_orderno and t.ter_slno = ch_orderslno 
        left join tbl_menumaster as m on m.mr_menuid = t.ter_menuid 
        where $string"); 
        
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
				
				
					//echo $_REQUEST['fromdt'] ."--";
					//echo $_REQUEST['todt'] ."<br>";
					if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
					{
						$from=$database->convert_date($_REQUEST['hidfr']);
						$to=$database->convert_date($_REQUEST['hidto']);
						$string.= "o.ter_dayclosedate between '".$from."' and '".$to."' ";
					}
					else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
					{
						$from=$database->convert_date($_REQUEST['hidfr']);
						$to=date("Y-m-d");
						$string.= " o.ter_dayclosedate between '".$from."' and '".$to."'";
					}
					else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
					{
						$from=date("Y-m-d");
						$to=$database->convert_date($_REQUEST['hidto']);
						$string.= "o.ter_dayclosedate between '".$from."' and '".$to."'";
					}
					
					
				
				
	else 
	{
		
		$bydatz=$_REQUEST['hidbydate'];
		
		
		
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
					//echo $_REQUEST['fromdt'] ."--";
					//echo $_REQUEST['todt'] ."<br>";
					if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
					{
						$from=$database->convert_date($_REQUEST['hidfr']);
						$to=$database->convert_date($_REQUEST['hidto']);
						$string.= " bm.bm_billdate between '".$from."' and '".$to."' ";
					}
					else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
					{
						$from=$database->convert_date($_REQUEST['hidfr']);
						$to=date("Y-m-d");
						$string.= " bm.bm_billdate between '".$from."' and '".$to."'";
					}
					else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
					{
						$from=date("Y-m-d");
						$to=$database->convert_date($_REQUEST['hidto']);
						$string.= " bm.bm_billdate between '".$from."' and '".$to."'";
					}
					
					
				
				
	else
	{
		
		$bydatz=$_REQUEST['hidbydate'];
		
		
		
			if($bydatz!="null")
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
	
	
		
	
	//$sql="select r.re_billno,DATE(r.re_datetime) AS Date, s.ser_firstname,r.re_reason,r.re_loginid from tbl_regenrate_log r left join tbl_staffmaster s on r.re_staffid=s.ser_staffid where $string";
	$sql_login1  =  $database->mysqlQuery("select bm.bm_billdate,bm.bm_finaltotal,bm.bm_billno,r.re_new_bill_no,r.re_billno,r.re_amount,r.re_order_no,DATE(r.re_datetime) AS Date, s.ser_firstname,r.re_reason,r.re_loginid from tbl_regenrate_log r left join tbl_staffmaster s on r.re_staffid=s.ser_staffid left join tbl_tablebillmaster bm on bm.bm_billno=r.re_billno where $string
 order by r.re_billno  ASC"); 

		
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
	
	
	 $date=date("Ymd");
	 $string=" bm_status='Closed' AND ";
	 if($_REQUEST['floorz'] !='')
	{
		
			$string.=" bm_floorid='".$_REQUEST['floorz']."' AND ";
	}
	
	
		if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
		{
			$bydate=$_REQUEST['hidbydate'];
			$from=$_REQUEST['hidfr'];
			$to=$_REQUEST['hidto'];
			$string.= " bm_billtime between '".$from."' and '".$to."'  and bm_billdate  = '".$bydate."'  order by bm_billtime";
		}
		else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
		{
			$bydate=$_REQUEST['hidbydate'];
			$from=$database->convert_date($_REQUEST['hidfr']);
				 $to = date('H:i');
			$string.= " bm_billtime between '".$from."' and '".$to."'  and bm_billdate  = '".$bydate."' order by bm_billtime";
		}
		else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
		{
			$bydate=$_REQUEST['hidbydate'];
			  $from = date('H:i');
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " bm_billtime between '".$from."' and '".$to."' and bm_billdate  = '".$bydate."'  order by bm_billtime";
		}
	

	else
	{
		
		$bydate=$_REQUEST['hidbydate'];
	  $from = date('H:i');
			 $to = date('H:i');
			$string.= " bm_billtime between '".$from."' and '".$to."' and bm_billdate  = '".$bydate."'  ";
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











else if($_REQUEST['type']=="summary")
{
	 $date=date("Ymd");
	 $string=" bm_status='Closed' AND ";
		if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
		}
		else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
		}
		else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
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
				  $string.="bm_dayclosedate = CURDATE() - INTERVAL 1 day";
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


	$cur=date("Y-m-d");
 	  $sql_login  =  $database->mysqlQuery("select * from tbl_tablebillmaster where $string"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login)
	  {
			echo "ok";
	  }else
	  {
		  echo "sorry";
	  }

	
  
	
}else if($_REQUEST['type']=="total_summary_details")
{
	 $date=date("Ymd");
	 $string=" bm_status='Closed' AND ";
		if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
		}
		else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
		}
		else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
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
				  $string.="bm_dayclosedate = CURDATE() - INTERVAL 1 day";
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


	$cur=date("Y-m-d");
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


else if($_REQUEST['type']=="bill_details")
{
	 $date=date("Ymd");
	 $string=" bm.bm_status='Closed' AND ";
		if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " bm.bm_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=date("Y-m-d");
			$string.= " bm.bm_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " bm.bm_dayclosedate between '".$from."' and '".$to."' ";
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
				  $string.="bm.bm_dayclosedate = CURDATE() - INTERVAL 1 day";
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


	$cur=date("Y-m-d");
 	  $sql_login  =  $database->mysqlQuery("SELECT td.bd_billno,bm.bm_dayclosedate,mn.mr_menuname,td.bd_rate,td.bd_qty,pm.pm_portionname from tbl_tablebilldetails as td LEFT JOIN tbl_menumaster as mn ON td.bd_menuid=mn.mr_menuid LEFT JOIN tbl_portionmaster as pm ON td.bd_portion=pm.pm_id LEFT JOIN tbl_tablebillmaster as bm ON bm.bm_billno=td.bd_billno  WHERE $string"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login)
	  {
			echo "ok";
	  }else
	  {
		  echo "sorry";
	  }

	
  
	
}else if($_REQUEST['type']=="discount_report")
{
	 $date=date("Ymd");
	 $string=" bm_status='Closed' AND bm_discountvalue<>'0.00' AND  ";
		if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
		}
		else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
		}
		else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
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
				  $string.="bm_dayclosedate = CURDATE() - INTERVAL 1 day ";
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


	$cur=date("Y-m-d");
 	  $sql_login  =  $database->mysqlQuery("select * from tbl_tablebillmaster where $string"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login)
	  {
			echo "ok";
	  }else
	  {
		  echo "sorry";
	  }

	
  
	
}else if($_REQUEST['type']=="kot_report")
{
	 $date=date("Ymd");
	 $string=" tor.ter_status='Closed' AND ";
		if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " tor.ter_dayclosedate between '".$from."' and '".$to."' order by tor.ter_kotno";
		}
		else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=date("Y-m-d");
			$string.= " tor.ter_dayclosedate between '".$from."' and '".$to."' order by tor.ter_kotno";
		}
		else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " tor.ter_dayclosedate between '".$from."' and '".$to."' order by tor.ter_kotno";
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
				  $string.="tor.ter_dayclosedate =  CURDATE() - INTERVAL 1 day ";
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


	$cur=date("Y-m-d");
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

else if(($_REQUEST['type']=="turnover_report"))
{
    $string="";
	 $date=date("Ymd");
	$date = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') +0 , date('Y')));
                $parts = explode('-', $date);
                $string12 = date(
                    'd-m-Y', 
                    mktime(0, 0, 0, $parts[1], $parts[2] + 0, $parts[0])
                    //              ^ Month    ^ Day       ^ Year
                );
                
                       $start = $string12;
                    for($i=0; $i < 1; $i++) {
                     $string13= date("d-m-Y", strtotime("$start - " . ($i*1) . " day")) . "<br>
                    ";
                    // echo $string13;
                    }            

	$string_pax=" bm_status='Closed' AND ";
        
         $fromdatz=$_REQUEST['hidfr'];
            $todatz=$_REQUEST['hidto'];
		
		
			if($fromdatz!="" && $todatz!="")
	{
 
                    $string12=$fromdatz;
                    $string13=$todatz;
           
 
        }
               else if($fromdatz!="" && $todatz=="")
		
		{
                    
		    $string12=$fromdatz;
                   
                    
		}
                 else if($fromdatz=="" && $todatz!="")
		
		{
                 
		    $string12=$_REQUEST['hidfr'];
                    $string13=$_REQUEST['hidto'];
		}
                   
		//$reporthead="From ".$string12."- To ".$string13;
	
	
	else
	{
		$bydatz=$_REQUEST['hidbydate'];
		$st='';
		
		
			if($bydatz!="null")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
            
            
		$date = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') +0 , date('Y')));
                $parts = explode('-', $date);
                $string13 = date(
                    'd-m-Y', 
                    mktime(0, 0, 0, $parts[1], $parts[2] + 0, $parts[0])
                    //              ^ Month    ^ Day       ^ Year
                );
//                $date = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') +0 , date('Y')));
//                $parts = explode('-', $date);
//                $string131 = date(
//                    'Y-m-d', 
//                    mktime(0, 0, 0, $parts[1], $parts[2] - 5, $parts[0])
//                    //              ^ Month    ^ Day       ^ Year
//                );
                
                       $start = $string13;
                    for($i=0; $i < 5; $i++) {
                     $string12= date("d-m-Y", strtotime("$start - " . ($i*1) . " day")) . "<br>
                    ";
                    // echo $string13;
                    }
               
		$st= " Last 5 days ";
                
       
                
		//$string_pax.= " bm_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
        }
		elseif($bydatz=="Last10days")
	{
                    
                    
                  	$date = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') +0 , date('Y')));
                $parts = explode('-', $date);
                $string13= date(
                    'd-m-Y', 
                    mktime(0, 0, 0, $parts[1], $parts[2] + 0, $parts[0])
                    //              ^ Month    ^ Day       ^ Year
                );
//                $date = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') +0 , date('Y')));
//                $parts = explode('-', $date);
//                $string131 = date(
//                    'Y-m-d', 
//                    mktime(0, 0, 0, $parts[1], $parts[2] - 5, $parts[0])
//                    //              ^ Month    ^ Day       ^ Year
//                );
                //echo $string13;
                       $start = $string13;
                    for($i=0; $i < 10; $i++) {
                     $string12= date("d-m-Y", strtotime("$start - " . ($i*1) . " day")) . "<br>
                    ";
                    // echo $string13;
                    }  
//echo $string13;
		$st= " Last 10 days ";
	}
	elseif($bydatz=="Last15days")
	{
                       	$date = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') +0 , date('Y')));
                $parts = explode('-', $date);
                $string13 = date(
                    'd-m-Y', 
                    mktime(0, 0, 0, $parts[1], $parts[2] + 0, $parts[0])
                    //              ^ Month    ^ Day       ^ Year
                );
//                $date = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') +0 , date('Y')));
//                $parts = explode('-', $date);
//                $string131 = date(
//                    'Y-m-d', 
//                    mktime(0, 0, 0, $parts[1], $parts[2] - 5, $parts[0])
//                    //              ^ Month    ^ Day       ^ Year
//                );
                
                       $start = $string13;
                    for($i=0; $i < 15; $i++) {
                     $string12= date("d-m-Y", strtotime("$start - " . ($i*1) . " day")) . "<br>
                    ";
                    // echo $string13;
                    } 
  
		$st= " Last 15 days ";
	}
	else if($bydatz=="Last20days")
	{
            
            	$date = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') +0 , date('Y')));
                $parts = explode('-', $date);
                $string13 = date(
                    'd-m-Y', 
                    mktime(0, 0, 0, $parts[1], $parts[2] + 0, $parts[0])
                    //              ^ Month    ^ Day       ^ Year
                );

                       $start = $string13;
                    for($i=0; $i < 20; $i++) {
                     $string12= date("d-m-Y", strtotime("$start - " . ($i*1) . " day")) . "<br>
                    ";
                    // echo $string13;
                    } 
            
		$st= " Last 20 days ";
	}
	else if($bydatz=="Last25days")
	{
            
            $date = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') +0 , date('Y')));
                $parts = explode('-', $date);
                $string13 = date(
                    'd-m-Y', 
                    mktime(0, 0, 0, $parts[1], $parts[2] + 0, $parts[0])
                    //              ^ Month    ^ Day       ^ Year
                );
//                $date = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') +0 , date('Y')));
//                $parts = explode('-', $date);
//                $string131 = date(
//                    'd-m-Y', 
//                    mktime(0, 0, 0, $parts[1], $parts[2] - 5, $parts[0])
//                    //              ^ Month    ^ Day       ^ Year
//                );
                
                       $start = $string13;
                    for($i=0; $i < 25; $i++) {
                     $string12= date("d-m-Y", strtotime("$start - " . ($i*1) . " day")) . "<br>
                    ";
                    // echo $string13;
                    } 
            
		$st= " Last 25 days ";
	}
	else if($bydatz=="Last30days")
	{
            $date = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') +0 , date('Y')));
                $parts = explode('-', $date);
                $string13 = date(
                    'd-m-Y', 
                    mktime(0, 0, 0, $parts[1], $parts[2] + 0, $parts[0])
                    //              ^ Month    ^ Day       ^ Year
                );
//                $date = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') +0 , date('Y')));
//                $parts = explode('-', $date);
//                $string131 = date(
//                    'Y-m-d', 
//                    mktime(0, 0, 0, $parts[1], $parts[2] - 5, $parts[0])
//                    //              ^ Month    ^ Day       ^ Year
//                );
                
                       $start = $string13;
                    for($i=0; $i < 30; $i++) {
                     $string12= date("d-m-Y", strtotime("$start - " . ($i*1) . " day")) . "<br>
                    ";
                    // echo $string13;
                    } 
 
		$st= " Last 30 days ";
	}
	else if($bydatz=="Today")
	{
            $date = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') +0 , date('Y')));
                $parts = explode('-', $date);
                $string13 = date(
                    'd-m-Y', 
                    mktime(0, 0, 0, $parts[1], $parts[2] + 0, $parts[0])
                    //              ^ Month    ^ Day       ^ Year
                );
//                $date = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') +0 , date('Y')));
//                $parts = explode('-', $date);
//                $string131 = date(
//                    'Y-m-d', 
//                    mktime(0, 0, 0, $parts[1], $parts[2] - 5, $parts[0])
//                    //              ^ Month    ^ Day       ^ Year
//                );
                
                       $start = $string13;
                    for($i=0; $i < 1; $i++) {
                     $string12= date("d-m-Y", strtotime("$start - " . ($i*1) . " day")) . "<br>
                    ";
                    // echo $string13;
                    } 

		$st= " Today ";
	}
	else if($bydatz=="Yesterday")
	{
            $date = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') +0 , date('Y')));
                $parts = explode('-', $date);
                $string121 = date(
                    'd-m-Y', 
                    mktime(0, 0, 0, $parts[1], $parts[2] + 0, $parts[0])
                    //              ^ Month    ^ Day       ^ Year
                );
                $date = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') +0 , date('Y')));
                $parts = explode('-', $date);
                $string12 = date(
                    'Y-m-d', 
                    mktime(0, 0, 0, $parts[1], $parts[2] - 1, $parts[0])
                    //              ^ Month    ^ Day       ^ Year
                );
                
                       $start = $string12;
                    for($i=0; $i < 1; $i++) {
                     $string13= date("d-m-Y", strtotime("$start - " . ($i*1) . " day")) . "<br>
                    ";
                     //echo $string13;
                    } 
 
		$st= " Yesterday ";
	}
	else if($bydatz=="Last1month")
	{
        $date = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') +0 , date('Y')));
                $parts = explode('-', $date);
                $string13 = date(
                    'd-m-Y', 
                    mktime(0, 0, 0, $parts[1], $parts[2] + 0, $parts[0])
                    //              ^ Month    ^ Day       ^ Year
                );
//                $date = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') +0 , date('Y')));
//                $parts = explode('-', $date);
//                $string131 = date(
//                    'Y-m-d', 
//                    mktime(0, 0, 0, $parts[1], $parts[2] - 1, $parts[0])
//                    //              ^ Month    ^ Day       ^ Year
//                );
                
                       $start = $string13;
                    for($i=0; $i < 30; $i++) {
                     $string12= date("d-m-Y", strtotime("$start - " . ($i*1) . " day")) . "<br>
                    ";
                     //echo $string13;
                    } 
            
		$st= " Last 1 month ";
	}
	else if($bydatz=="Last90days")
	{
            $date = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') +0 , date('Y')));
                $parts = explode('-', $date);
                $string13 = date(
                    'd-m-Y', 
                    mktime(0, 0, 0, $parts[1], $parts[2] + 0, $parts[0])
                    //              ^ Month    ^ Day       ^ Year
                );
//                $date = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') +0 , date('Y')));
//                $parts = explode('-', $date);
//                $string131 = date(
//                    'Y-m-d', 
//                    mktime(0, 0, 0, $parts[1], $parts[2] - 1, $parts[0])
//                    //              ^ Month    ^ Day       ^ Year
//                );
//                
                       $start = $string13;
                    for($i=0; $i < 90; $i++) {
                     $string12= date("d-m-Y", strtotime("$start - " . ($i*1) . " day")) . "<br>
                    ";
                     //echo $string13;
                    } 
         
		$st= " Last 3 months ";
	}
	else if($bydatz=="Last180days")
	{
            
             $date = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') +0 , date('Y')));
                $parts = explode('-', $date);
                $string13 = date(
                    'd-m-Y', 
                    mktime(0, 0, 0, $parts[1], $parts[2] + 0, $parts[0])
                    //              ^ Month    ^ Day       ^ Year
                );
//                $date = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') +0 , date('Y')));
//                $parts = explode('-', $date);
//                $string131 = date(
//                    'Y-m-d', 
//                    mktime(0, 0, 0, $parts[1], $parts[2] - 1, $parts[0])
//                    //              ^ Month    ^ Day       ^ Year
//                );
//                
                       $start = $string13;
                    for($i=0; $i < 180; $i++) {
                     $string12= date("d-m-Y", strtotime("$start - " . ($i*1) . " day")) . "<br>
                    ";
                     //echo $string13;
                    } 
            

		$st= " Last 6 months "; 
	}
	else if($bydatz=="Last365days")
	{
             $date = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') +0 , date('Y')));
                $parts = explode('-', $date);
                $string13 = date(
                    'd-m-Y', 
                    mktime(0, 0, 0, $parts[1], $parts[2] + 0, $parts[0])
                    //              ^ Month    ^ Day       ^ Year
                );
//                $date = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') +0 , date('Y')));
//                $parts = explode('-', $date);
//                $string131 = date(
//                    'Y-m-d', 
//                    mktime(0, 0, 0, $parts[1], $parts[2] - 1, $parts[0])
//                    //              ^ Month    ^ Day       ^ Year
//                );
//                
                       $start = $string13;
                    for($i=0; $i < 365; $i++) {
                     $string12= date("d-m-Y", strtotime("$start - " . ($i*1) . " day")) . "<br>
                    ";
                     //echo $string13;
                    } 
	
		$st= " Last 1 year ";
	}
$reporthead=$st;
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

      $database->mysqlQuery("SET @fromdate = " . "'" . $string12 . "'");
		$database->mysqlQuery("SET @todate = " . "'" . $string13 . "'");
		//$database->mysqlQuery("SET @total_vat = " . "'" . $total_vat . "'");
		//$database->mysqlQuery("SET @net_turnover = " . "'" . $net_turnover . "'");   
		 $cur=date("Y-m-d"); 
                $gross_turnover='';
        $gross_turnover='';
        $total_ser_tax='';
        $total_vat='';
        $net_turnover='';
      	$sq=$database->mysqlQuery("CALL proc_total_turnover(@fromdate,@todate,@gross_turnover,@total_ser_tax,@total_vat,@total_tax,@net_turnover)");
	$rs = $database->mysqlQuery( 'SELECT @gross_turnover AS gross_turnover');
        $rs1 = $database->mysqlQuery( 'SELECT  @total_ser_tax AS total_ser_tax ');
        $rs2 = $database->mysqlQuery( 'SELECT  @net_turnover AS net_turnover');
        $num_login   = $database->mysqlNumRows($rs);
        if($num_login)
	  {
			echo "ok";
	  }else
	  {
		  echo "sorry";
	  }
          

}



else if($_REQUEST['type']=="bill_cancel")
{
	 $date=date("Ymd");
	 $string=" bm_status='Cancelled' AND ";
		if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
		}
		else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
		}
		else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
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
				  $string.="bm_dayclosedate =  CURDATE() - INTERVAL 1 day ";
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


	$cur=date("Y-m-d");
 	  $sql_login  =  $database->mysqlQuery("select DISTINCT b.bm_dayclosedate,b.bm_billno,b.ter_cancelledreason,b.bm_finaltotal,b.ter_cancelledlogin,s.ser_firstname,s.ser_lastname from tbl_tablebillmaster b left join tbl_staffmaster s on b.ter_cancelledby_careof=s.ser_staffid where $string"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login)
	  {
			echo "ok";
	  }else
	  {
		  echo "sorry";
	  }

	
  
	
}
else if($_REQUEST['type']=="type_pay")
{
	 $date=date("Ymd");

$string="bm_status='closed' ";
if($_REQUEST['hidpaytyp']=="cash")
	{
		//$string = " (bm_transactionamount ='' or bm_transactionamount IS NULL) and (bm_couponcompany ='' or bm_couponcompany IS NULL) and bm_voucherid IS NULL and bm_couponamt ='0.00' and  (bm_chequeno ='' or bm_chequeno IS NULL) and (bm_chequebankname='' or bm_chequebankname IS NULL)";
		$string = " pym_code='cash'";
	/*	 xlsWriteLabel(0,3,"Final");
 		 xlsWriteLabel(0,4,"Paid");
 		 xlsWriteLabel(0,5,"Balance");*/
		 $data['Final']="";
		 $data['Paid']="";
		 $data['Balance']="";
		 
	}else if($_REQUEST['hidpaytyp']=="credit")
	{
		//$string = " bm_transactionamount <>'' ";
		$string = " pym_code='credit' and bm_transcbank <> '0'";
			 $data['Transaction Amount']="";
		 	 $data['Final']="";
		     $data['Paid']="";
		     $data['Balance']="";
	}else if($_REQUEST['hidpaytyp']=="coupons")
	{
		//$string = " bm_couponcompany <>''  and bm_couponamt <>'0.00'";
		$string = " pym_code='coupon'";
		
			 $data['Coupon Company']="";
		 $data['Coupon Amount']="";
		 $data['Final']="";
		  $data['Paid']="";
		   $data['Balance']="";
	}else if($_REQUEST['hidpaytyp']=="voucher")
	{
		//$string = " bm_voucherid <>''";
		$string = " pym_code='voucher'";
		 $data['Voucher']="";
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
			$string.= " and  bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
		}
		else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=date("Y-m-d");
			$string.= " and  bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
		}
		else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " and  bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
		}else
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
				  $string.="and bm_dayclosedate =  CURDATE() - INTERVAL 1 day ";
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
		}
	
	
	$sql_login  =  $database->mysqlQuery("select * from tbl_tablebillmaster LEFT JOIN tbl_bankmaster ON tbl_tablebillmaster.bm_transcbank=tbl_bankmaster.bm_id LEFT JOIN tbl_paymentmode ON  tbl_tablebillmaster.bm_paymode= tbl_paymentmode.pym_id   where $string"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	 if($num_login)
	  {
			echo "ok";
	  }else
	  {
		  echo "sorry";
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
{
    /***********************************************steward***************************************************/
 $date=date("Ymd");

		$stw=$_REQUEST['hidstw'];
		$string="";
		if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " and ( tbl_tableorder.ter_dayclosedate between '".$from."' and '".$to."' ) ";
		}
		else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=date("Y-m-d");
			$string.= " and ( tbl_tableorder.ter_dayclosedate between '".$from."' and '".$to."' ) ";
		}
		else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " and ( bl_tableorder.ter_dayclosedate between '".$from."' and '".$to."' )  ";
		}/*else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']=="")
		{
			$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " and ( tbl_tableorder.ter_dayclosedate between '".$from."' and '".$to."' )  ";
		}*/
		else
		{
			
				$stewardbydate=$_REQUEST['hidstwdate'];
	if($stewardbydate!="null")
	{
		//$search="";
	if($stewardbydate=="Last5days")
	{
		$string.="and tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($stewardbydate=="Last10days")
	{
		$string.="and tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	elseif($stewardbydate=="Last15days")
	{
		$string.="and tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($stewardbydate=="Last20days")
	{
		$string.="and tbl_tableorder.ter_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($stewardbydate=="Last25days")
	{
		$string.="and tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($stewardbydate=="Last30days")
	{
		$string.="and tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	else if($stewardbydate=="Today")
	{
		$string.="and tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	else if($stewardbydate=="Yesterday")
			  {
				  $string.="and tbl_tableorder.ter_dayclosedate =  CURDATE() - INTERVAL 1 day ";
			  }
	else if($stewardbydate=="Last1month")
	{
		$string.=" and tbl_tableorder.ter_dayclosedate between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
	}
	else if($stewardbydate=="Last90days")
	{
		$string.="and tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}

else if($stewardbydate=="Last180days")
	{
		$string.="and tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($stewardbydate=="Last365days")
	{
		$string.="and tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}


	}
	
	else
	{
		$string.="and tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
			
			
		}
		

	  

	  
	  $sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_menumaster.mr_menuname as menuname,sum(tbl_tableorder.ter_rate * tbl_tableorder.ter_qty) as amnt From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid Inner Join tbl_staffmaster On tbl_tableorder.ter_staff = tbl_staffmaster.ser_staffid Where  tbl_tableorder.ter_staff =  '".$stw."' $string Group By tbl_menumaster.mr_menuname order by ct DESC"); 
	  $num_stw   = $database->mysqlNumRows($sql_stw);
	  
	  
	  	 if($num_stw)
	  {
			echo "ok";
	  }else
	  {
		  echo "sorry";
	  }

		
	  
	 
}
 else if($_REQUEST['type']=="stewards_performance_report")
{
     /***********************************************steward***************************************************/
 $date=date("Ymd");

		$stw=$_REQUEST['hidstw'];
		$string="";
		if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " and ( tbl_tableorder.ter_dayclosedate between '".$from."' and '".$to."' ) ";
		}
		else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=date("Y-m-d");
			$string.= " and ( tbl_tableorder.ter_dayclosedate between '".$from."' and '".$to."' ) ";
		}
		else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " and ( bl_tableorder.ter_dayclosedate between '".$from."' and '".$to."' )  ";
		}/*else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']=="")
		{
			$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " and ( tbl_tableorder.ter_dayclosedate between '".$from."' and '".$to."' )  ";
		}*/
		else
		{
			
				$stewardbydate=$_REQUEST['hidstwdate'];
	if($stewardbydate!="null")
	{
		//$search="";
	if($stewardbydate=="Last5days")
	{
		$string.="and tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($stewardbydate=="Last10days")
	{
		$string.="and tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	elseif($stewardbydate=="Last15days")
	{
		$string.="and tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($stewardbydate=="Last20days")
	{
		$string.="and tbl_tableorder.ter_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($stewardbydate=="Last25days")
	{
		$string.="and tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($stewardbydate=="Last30days")
	{
		$string.="and tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	else if($stewardbydate=="Today")
	{
		$string.="and tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	else if($stewardbydate=="Yesterday")
			  {
				  $string.="and tbl_tableorder.ter_dayclosedate =  CURDATE() - INTERVAL 1 day ";
			  }
	else if($stewardbydate=="Last1month")
	{
		$string.=" and tbl_tableorder.ter_dayclosedate between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
	}
	else if($stewardbydate=="Last90days")
	{
		$string.="and tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}

else if($stewardbydate=="Last180days")
	{
		$string.="and tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($stewardbydate=="Last365days")
	{
		$string.="and tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}


	}
	
	else
	{
		$string.="and tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
			
			
		}
		

	  

	  
	    $sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_menumaster.mr_menuname as menuname,sum(tbl_tableorder.ter_rate * tbl_tableorder.ter_qty) as amnt From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid Inner Join tbl_staffmaster On tbl_tableorder.ter_staff = tbl_staffmaster.ser_staffid Where  tbl_tableorder.ter_staff =  '".$stw."' $string Group By tbl_menumaster.mr_menuname order by ct DESC"); 
	  $num_stw   = $database->mysqlNumRows($sql_stw);
	  
	  
	  	 if($num_stw)
	  {
			echo "ok";
	  }else
	  {
		  echo "sorry";
	  }

		
	  
	 
}

else if($_REQUEST['type']=="steward_timely")
{
	
	
	/***********************************************steward***************************************************/
 

	
		$string="";
		$stewardbydate=$_REQUEST['hidstwdate'];
		if($_REQUEST['hidstw']!='')
		{
			$stw=$_REQUEST['hidstw'];
			
				$string.="tbl_tableorder.ter_staff =  '".$stw."'    ";
			
		}
		
		if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
		{
			$from=$_REQUEST['hidfr'];
			$to=$_REQUEST['hidto'];
			if($string !="")
			{
			$string.= " and ( tbl_tableorder.ter_entrytime between '".$from."' and '".$to."'  and tbl_tableorder.ter_entrydate='".$stewardbydate."' ) ";
			}
			else
			{
$string.= "  ( tbl_tableorder.ter_entrytime between '".$from."' and '".$to."'  and tbl_tableorder.ter_entrydate='".$stewardbydate."' ) ";				
			}
		}
		else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
		{
			$from=$_REQUEST['hidfr'];
			 $to = date('H:i');
			 if($string !="")
			 {
			$string.= " and ( tbl_tableorder.ter_entrytime between '".$from."' and '".$to."'  and tbl_tableorder.ter_entrydate='".$stewardbydate."'  ) ";
			 }
			 else
			 {
				 $string.= "  ( tbl_tableorder.ter_entrytime between '".$from."' and '".$to."'  and tbl_tableorder.ter_entrydate='".$stewardbydate."' ) ";	
			 }
		}
		else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
		{
			$from = date('H:i');
			$to=$_REQUEST['hidto'];
			if($string !="")
			{
			$string.= " and ( tbl_tableorder.ter_entrytime between '".$from."' and '".$to."'  and tbl_tableorder.ter_entrydate='".$stewardbydate."'  )  ";
			}
			else
			{
				$string.= "  ( tbl_tableorder.ter_entrytime between '".$from."' and '".$to."'  and tbl_tableorder.ter_entrydate='".$stewardbydate."' ) ";	
			}
		}/*else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']=="")
		{
			$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " and ( tbl_tableorder.ter_dayclosedate between '".$from."' and '".$to."' )  ";
		}*/
		else
		{$from = date('H:i');
			 $to = date('H:i');
			 if($string !="")
			 {
			 		$string.= " and ( tbl_tableorder.ter_entrytime between '".$from."' and '".$to."'  and tbl_tableorder.ter_entrydate='".$stewardbydate."'  )  ";
			 }
			 else
			 {
				 $string.= "  ( tbl_tableorder.ter_entrytime between '".$from."' and '".$to."'  and tbl_tableorder.ter_entrydate='".$stewardbydate."' ) ";	
			 }
			}
		

	  

	  
	    $sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_menumaster.mr_menuname as menuname From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid Inner Join tbl_staffmaster On tbl_tableorder.ter_staff = tbl_staffmaster.ser_staffid Where  $string Group By tbl_menumaster.mr_menuname order by ct DESC"); 
	  $num_stw   = $database->mysqlNumRows($sql_stw);
	  
	  
	  	 if($num_stw)
	  {
			echo "ok";
	  }else
	  {
		  echo "sorry";
	  }

		
	  
	 

	
	
	
}





else if($_REQUEST['type']=="items_ordered_timely")
{
	/***********************************************Ordered*************************************************************************/

	 
		$string ="o.ter_status='Closed'";		 
										  
	  if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
		{
		  
			$from=$_REQUEST['hidfr'];
			$to=$_REQUEST['hidto'];
			
			
			
								if($_REQUEST['byflr']!="")
	    {
			   $bycat=$_REQUEST['byflr'];
			if($string !="")
			{
	 
		$string.=" and o.ter_floorid='".$bycat."' ";
			}
			else
			{
					 
		$string.="o.ter_floorid='".$bycat."' ";
			}
			
	     }
			
			if($string !="")
			{
			 $string.= " and o.ter_entrytime  between '".$from."' and '".$to."' and o.ter_entrydate='".$_REQUEST['entrydate']."' ";
			}
			else
			{
	$string.= "o.ter_entrytime  between '".$from."' and '".$to."' and o.ter_entrydate='".$_REQUEST['entrydate']."' ";
			}
			
		}
		else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
		{
			// $string ="o.ter_status='Closed'";
		$from=$_REQUEST['hidfr'];
			 $to = date('H:i');
		
		if($string !="")
			{
				$string.= "and o.ter_entrytime  between '".$from."' and '".$to."' and o.ter_entrydate='".$_REQUEST['entrydate']."'  ";
			}
			else
			{
				$string.= "o.ter_entrytime  between '".$from."' and '".$to."' and o.ter_entrydate='".$_REQUEST['entrydate']."' ";
			}
			
						
								if($_REQUEST['byflr']!="")
	    {
			   $bycat=$_REQUEST['byflr'];
			if($string !="")
			{
	 
		$string.=" and o.ter_floorid='".$bycat."' ";
			}
			else
			{
					 
		$string.="o.ter_floorid='".$bycat."' ";
			}
			
	     }
		}
		else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
		{
		$from = date('H:i');
			$to=$_REQUEST['hidto'];
			if($string !="")
			{
		$string.= "and o.ter_entrytime  between '".$from."' and '".$to."' and o.ter_entrydate='".$_REQUEST['entrydate']."' ";
			}
			else
			{
				$string.= "o.ter_entrytime  between '".$from."' and '".$to."' and o.ter_entrydate='".$_REQUEST['entrydate']."' ";
			}
			
						
									if($_REQUEST['byflr']!="")
	    {
			   $bycat=$_REQUEST['byflr'];
			if($string !="")
			{
	 
		$string.=" and o.ter_floorid='".$bycat."' ";
			}
			else
			{
					 
		$string.="o.ter_floorid='".$bycat."' ";
			}
			
	     }
		}
		
		else{
			
				 $from = date('H:i');
			 $to = date('H:i');
		//	$to=$_REQUEST['time2'];
			if($string !="")
			{
			$string.= " and o.ter_entrytime  between '".$from."' and '".$to."' and o.ter_entrydate='".$_REQUEST['entrydate']."' ";
			}
			else
			{
				$string.= " o.ter_entrytime  between '".$from."' and '".$to."' and o.ter_entrydate='".$_REQUEST['entrydate']."' ";	
			}
			
	/*	$cur=date("Y-m-d");
		$string=" bm_dayclosedate='".$cur."'";*/
		
		/*$cur=date("Y-m-d");
		$string=" bm_dayclosedate='".$cur."'";*/
		
		
	//$bydate=$_REQUEST['hidbydate'];
	
									if($_REQUEST['byflr']!="")
	    {
			   $bycat=$_REQUEST['byflr'];
			if($string !="")
			{
	 
		$string.=" and o.ter_floorid='".$bycat."' ";
			}
			else
			{
					 
		$string.="o.ter_floorid='".$bycat."' ";
			}
			
	     }
			}
		
		
		
	//else
	//{
			//$orderbydate=$_REQUEST['hidbydate'];
	
			//if($orderbydate!="null")
	/*{
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
		$string.="  o.ter_dayclosedate   between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}
		else if($orderbydate=="Last180days")
	{
		$string.="  o.ter_dayclosedate   between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
		else if($orderbydate=="Last365days")
	{
		$string.="  o.ter_dayclosedate   between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}
	*/
	//}
/*	else
	{
			$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " o.ter_dayclosedate   between '".$from."' and '".$to."' ";
	}*/
	//}  
/*	
		 $byflr=$_REQUEST['byflr'];

		if($byflr !="")
	{
		if($string!="")
		{
			$string.=" and  o.ter_floorid LIKE  '%" . $byflr ."%'";
		}else
		{
			$string.=" o.ter_floorid  LIKE  '%" . $byflr ."%'";
		}
	}	*/ 

	

 	  $sql_stw  =  $database->mysqlQuery("SELECT mc.mmy_maincategoryname,ms.msy_subcategoryname,m.mr_menuname,p.pm_portionname,f.fr_floorname,sum(o.ter_qty) as qty,ROUND(avg(o.ter_rate), 1) as Unit_Price, ((sum(o.ter_qty))*(ROUND(avg(o.ter_rate), 1))) as Total from tbl_tableorder o left join tbl_menumaster m on m.mr_menuid = o.ter_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = m.mr_maincatid left join tbl_menusubcategory ms on ms.msy_subcategoryid = m.mr_subcatid left join tbl_portionmaster p on p.pm_id = o.ter_portion left join tbl_floormaster f on f.fr_floorid = o.ter_floorid where $string group by m.mr_maincatid ,m.mr_subcatid,o.ter_menuid,o.ter_portion,o.ter_floorid ORDER BY m.mr_maincatid,m.mr_subcatid  DESC"); 
	  $num_stw   = $database->mysqlNumRows($sql_stw);

	 if($num_stw)
	  {
			echo "ok";
	  }else
	  {
		echo "sorry";
	  }


	
	
	
}

else if($_REQUEST['type']=="order")
	{
            $string ="";
            $string="bm.bm_status = 'Closed'";
            $from='';
            $to='';
            $reporthead="";
            $st="";
            
            if($_REQUEST['floorz'] !='')
	{
		
			$string.=" and bm.bm_floorid='".$_REQUEST['floorz']."'";
	}
	
										  
	  if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
		{
		  
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=$database->convert_date($_REQUEST['hidto']);
                        $string.= "and bm.bm_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
			
		}
		else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=date("Y-m-d");
                        $string.= "and bm.bm_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
			
		}
		else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=$database->convert_date($_REQUEST['hidto']);
                        $string.= "and bm.bm_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		
		}
                else{
                    
                    $bydatz=$_REQUEST['hidbydate'];
	
		    if($bydatz!="null")
                    {
                        if($bydatz=="Last5days")
                        {
                            $string.="and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                            $st="Last5days";
                        }    
                        elseif($bydatz=="Last10days")
                        {   
                            $string.="and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";

                            $st="Last 10 days";
                        }
                        elseif($bydatz=="Last15days")
                        {
                            $string.="and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";

                            $st="Last 15 days";
                        }
                        else if($bydatz=="Last20days")
                        {
                            $string.="and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";

                            $st="Last 20 days";
                        }
                        else if($bydatz=="Last25days")
                        {
                            $string.="and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";

                            $st="Last 25 days";
                        }
                        else if($bydatz=="Last30days")
                        {
                            $string.="and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                            $st="Last 30 days";
                        }
                        else if($bydatz=="Today")
                        {
                            $string.="and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
                            $st="Today";
                        }

                        else if($bydatz=="Yesterday")
			{
                            $string.="and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 DAY  AND CURDATE( )";
                            $st="Yesterday";
			}
                        else if($bydatz=="Last1month")
                        {
                           $string.="and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
                           $st="Last 1 Month"; 
                        }
                        else if($bydatz=="Last90days")
                        {
                            $string.="and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                            $st="Last 90 months";
                        }
                        else if($bydatz=="Last180days")
                        {
                            $string.="and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                            $st="Last 180 days";
                        }
                        else if($bydatz=="Last365days")
                        {
                            $string.="and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                            $st="Last 365 days";
                        }
                        $reporthead=$st;
                    }
                    else
                    {
                        $from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " and bm.bm_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                    }        
                    }  
    
	$final=0;

 	  $sql_login  =  $database->mysqlQuery("SELECT mc.mmy_maincategoryname,ms.msy_subcategoryname,m.mr_menuname,p.pm_portionname,sum(bd.bd_qty) as qty,ROUND(avg(bd.bd_rate), 1) as Unit_Price, sum(bd.bd_amount) as Total from tbl_tablebilldetails bd left join tbl_menumaster m on m.mr_menuid = bd.bd_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = m.mr_maincatid left join tbl_menusubcategory ms on ms.msy_subcategoryid = m.mr_subcatid left join tbl_portionmaster p on p.pm_id = bd.bd_portion left join tbl_tablebillmaster bm on bm.bm_billno=bd.bd_billno where $string group by m.mr_maincatid ,m.mr_subcatid,bd.bd_menuid ORDER BY mc.mmy_maincategoryname,m.mr_menuname ASC");
     //echo"SELECT mc.mmy_maincategoryname,ms.msy_subcategoryname,m.mr_menuname,p.pm_portionname,sum(bd.bd_qty) as qty,ROUND(avg(bd.bd_rate), 1) as Unit_Price, sum(bd.bd_amount) as Total from tbl_tablebilldetails bd left join tbl_menumaster m on m.mr_menuid = bd.bd_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = m.mr_maincatid left join tbl_menusubcategory ms on ms.msy_subcategoryid = m.mr_subcatid left join tbl_portionmaster p on p.pm_id = bd.bd_portion left join tbl_tablebillmaster bm on bm.bm_billno=bd.bd_billno where $string group by m.mr_maincatid ,m.mr_subcatid,bd.bd_menuid ORDER BY mc.mmy_maincategoryname,m.mr_menuname ASC";
	  $num_login   = $database->mysqlNumRows($sql_login);
	
	if($num_login)
        {
            echo "ok";
        }
	
        else
            {
            echo "sorry";
            }
	
        }



//---------kitchen_wise--------
else if($_REQUEST['type']=="kitchen_wise")
{
    /***********************************************Ordered*************************************************************************/

	 
		$string ="o.ter_status='Closed'";		 
										  
	  if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
		{
		  
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=$database->convert_date($_REQUEST['hidto']);
			
			
			
								if($_REQUEST['byflr']!="")
	    {
			   $bycat=$_REQUEST['byflr'];
			if($string !="")
			{
	 
		$string.=" and m.mr_kotcounter='".$bycat."' ";
			}
			else
			{
					 
		$string.="m.mr_kotcounter='".$bycat."' ";
			}
			
	     }
			
			
			
			
			
			
			if($string !="")
			{
				$string.= "and o.ter_dayclosedate  between '".$from."' and '".$to."' ";
			}
			else
			{
				$string.= " o.ter_dayclosedate  between '".$from."' and '".$to."' ";
			}
			
		}
		else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
		{
			// $string ="o.ter_status='Closed'";
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=date("Y-m-d");
		if($string !="")
			{
				$string.= "and o.ter_dayclosedate  between '".$from."' and '".$to."' ";
			}
			else
			{
				$string.= " o.ter_dayclosedate  between '".$from."' and '".$to."' ";
			}
			
						
								if($_REQUEST['byflr']!="")
	    {
			   $bycat=$_REQUEST['byflr'];
			if($string !="")
			{
	 
		$string.=" and m.mr_kotcounter='".$bycat."' ";
			}
			else
			{
					 
		$string.="m.mr_kotcounter='".$bycat."' ";
			}
			
	     }
		}
		else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['hidto']);
			if($string !="")
			{
				$string.= "and o.ter_dayclosedate  between '".$from."' and '".$to."' ";
			}
			else
			{
				$string.= " o.ter_dayclosedate  between '".$from."' and '".$to."' ";
			}
			
						
									if($_REQUEST['byflr']!="")
	    {
			   $bycat=$_REQUEST['byflr'];
			if($string !="")
			{
	 
		$string.=" and m.mr_kotcounter='".$bycat."' ";
			}
			else
			{
					 
		$string.="m.mr_kotcounter='".$bycat."' ";
			}
			
	     }
		}
		
		else{
			
			
	/*	$cur=date("Y-m-d");
		$string=" bm_dayclosedate='".$cur."'";*/
		
		/*$cur=date("Y-m-d");
		$string=" bm_dayclosedate='".$cur."'";*/
		
		
	//$bydate=$_REQUEST['hidbydate'];
	
	
		$bydatz=$_REQUEST['hidbydate'];
			if($bydatz!="null")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		if($string !="")
		{
		
		$string.=" and o.ter_dayclosedate  between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
		}
		else
		{
				$string.="o.ter_dayclosedate  between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
		}
	}elseif($bydatz=="Last10days")
	{

if($string !="")
{
	
		$string.=" and  o.ter_dayclosedate  between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
}
else
{
		$string.=" o.ter_dayclosedate  between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
}
	}
	elseif($bydatz=="Last15days")
	{
		if($string !="")
		{
			$string.="  and o.ter_dayclosedate  between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
		}
		else
		{
		$string.=" o.ter_dayclosedate  between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
		}
	}
	else if($bydatz=="Last20days")
	{
		if($string !="")
		{
				$string.=" and o.ter_dayclosedate  between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
		}
		else
		{
		$string.=" o.ter_dayclosedate  between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
		}
	}
	else if($bydatz=="Last25days")
	{
		if($string !="")
		{
			$string.=" and o.ter_dayclosedate  between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
		}
		else{
		$string.=" o.ter_dayclosedate  between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
		}
	}
	else if($bydatz=="Last30days")
	{
		if($string !="")
		{
				$string.=" and o.ter_dayclosedate  between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
		}
		else
		{
		$string.=" o.ter_dayclosedate  between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
		}
	}
	else if($bydatz=="Today")
	{
		if($string !="")
		{
		$string.=" and o.ter_dayclosedate  between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
		}
		else
		{
			$string.=" o.ter_dayclosedate  between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 		
		}
	}
	
	else if($bydatz=="Yesterday")
			  {
				  if($string !="")
				  {
					    $string.=" and o.ter_dayclosedate  =  CURDATE() - INTERVAL 1 day";
				  }
				  else
				  {
					    $string.=" o.ter_dayclosedate  =  CURDATE() - INTERVAL 1 day";
				  }
				
			  }
			   else if($bydatz=="Last1month")
			  {
				
				  
				  if($string !="")
				  {
					    $string.=" and o.ter_dayclosedate  between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
				  }
				  else
				  {
					    $string.=" o.ter_dayclosedate  between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
				  }
				 
				  
			  }
else if($bydatz=="Last90days")
	{
		if($string !="")
		{
		$string.=" and o.ter_dayclosedate  between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
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
		$string.=" and o.ter_dayclosedate  between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
		}
		else
		{
			$string.=" o.ter_dayclosedate  between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
		}
	
	}
else if($bydatz=="Last365days")
	{
	
		if($string !="")
		{	
		$string.=" and o.ter_dayclosedate  between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
			
		}
		else
		{
			$string.="o.ter_dayclosedate  between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
		}
	}
	
	
			if($_REQUEST['byflr']!="")
	    {
			   $bycat=$_REQUEST['byflr'];
			if($string !="")
			{
	 
		$string.=" and m.mr_kotcounter='".$bycat."' ";
			}
			else
			{
					 
		$string.="m.mr_kotcounter='".$bycat."' ";
			}
			
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
			
		
					if($_REQUEST['byflr']!="")
	    {
			   $bycat=$_REQUEST['byflr'];
			if($string !="")
			{
	 
		$string.=" and m.mr_kotcounter='".$bycat."' ";
			}
			else
			{
					 
		$string.="m.mr_kotcounter='".$bycat."' ";
			}
			
	     }
	}
	
	
		}
		
		
		
	//else
	//{
			//$orderbydate=$_REQUEST['hidbydate'];
	
			//if($orderbydate!="null")
	/*{
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
		$string.="  o.ter_dayclosedate   between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}
		else if($orderbydate=="Last180days")
	{
		$string.="  o.ter_dayclosedate   between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
		else if($orderbydate=="Last365days")
	{
		$string.="  o.ter_dayclosedate   between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}
	*/
	//}
/*	else
	{
			$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " o.ter_dayclosedate   between '".$from."' and '".$to."' ";
	}*/
	//}  
/*	
		 $byflr=$_REQUEST['byflr'];

		if($byflr !="")
	{
		if($string!="")
		{
			$string.=" and  o.ter_floorid LIKE  '%" . $byflr ."%'";
		}else
		{
			$string.=" o.ter_floorid  LIKE  '%" . $byflr ."%'";
		}
	}	*/ 

	

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
//-------------------------------
else if($_REQUEST['type']=="portion_order")
{
    /***********************************************steward***************************************************/
 $date=date("Ymd");

		$portion=$_REQUEST['prtn'];
		$string="";
		if($portion !="null")
	{
		if($string!="")
		{
			$string.=" and  tbl_tableorder.ter_portion  LIKE  '%" . $portion ."%'";
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
			$string.= " and ( tbl_tableorder.ter_dayclosedate between '".$from."' and '".$to."' ) ";
			}
			else
			{
					$string.= "(tbl_tableorder.ter_dayclosedate between '".$from."' and '".$to."' ) ";
			}
		}
		else if($_REQUEST['from']!="" && $_REQUEST['to']=="")
		{
			$from=$database->convert_date($_REQUEST['from']);
			$to=date("Y-m-d");
			if($string!="")
			{
			$string.= " and ( tbl_tableorder.ter_dayclosedate between '".$from."' and '".$to."' ) ";
			}
			else
			{
					$string.= "(tbl_tableorder.ter_dayclosedate between '".$from."' and '".$to."' ) ";
			}
		}
		else if($_REQUEST['from']=="" && $_REQUEST['to']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['to']);
			if($string!="")
			{
			$string.= " and ( tbl_tableorder.ter_dayclosedate between '".$from."' and '".$to."' )  ";
			}
			else
			{
				$string.= "(tbl_tableorder.ter_dayclosedate between '".$from."' and '".$to."' )  ";
			}
		}else 
		{
			/*$from=date("Y-m-d");
			$to=date("Y-m-d");
			if($string!="")
			{
			$string.= " and ( tbl_tableorder.ter_dayclosedate between '".$from."' and '".$to."' )  ";
			}
			else
			{
				$string.= "(tbl_tableorder.ter_dayclosedate between '".$from."' and '".$to."' )  ";
				
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
		
		$string.=" and tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";


			}
			else
			{
				$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
			}
	}elseif($portionbydate=="Last10days")
	{
		
			if($string!="")
			{
		$string.="and tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
			}
			else
			{
				$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
			}
	}
	elseif($portionbydate=="Last15days")
	{
		if($string!="")
			{
		$string.="and tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
			}
			else
			{
					$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
			}
	}
	else if($portionbydate=="Last20days")
	{
		if($string!="")
			{
		$string.="and tbl_tableorder.ter_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
			}
			else
			{
					$string.=" tbl_tableorder.ter_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
			}
	}
	else if($portionbydate=="Last25days")
	{
		if($string!="")
			{
		$string.="and tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 25 
			
DAY AND CURDATE( )";
			}
			else
			{
					$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 25 
			
DAY AND CURDATE( )";
			}
	}
	else if($portionbydate=="Last30days")
	{
		if($string!="")
			{
		$string.="and tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
			}
			else
			{
				$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
			}
	}
	else if($portionbydate=="Today")
	{
			if($string!="")
			{
		$string.="and tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
			}
			else
			{
				$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
			}
	}
	
	
	else if($portionbydate=="Yesterday")
			  {
				  
				  
				  if($string!="")
			{
		 $string.="and tbl_tableorder.ter_dayclosedate =  CURDATE() - INTERVAL 1 day ";
			}
			else
			{
				$string.=" tbl_tableorder.ter_dayclosedate  =  CURDATE() - INTERVAL 1 day"; 
			}
				 
			  }
	else if($portionbydate=="Last1month")
	{
  if($string!="")
			{
		 $string.="and tbl_tableorder.ter_dayclosedate between CURDATE( ) - INTERVAL 1  MONTH AND CURDATE( ) ";
			}
			else
			{
					$string.=" tbl_tableorder.ter_dayclosedate between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
			}
				 
	}
	
	
	
	else if($portionbydate=="Last90days")
	{
		if($string!="")
			{
		$string.="and tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
			}
			else
			{
					$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
			}
			
	}

else if($portionbydate=="Last180days")
	{
		if($string!="")
			{
		$string.="and tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
			}
			else
			{
				$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
			}
			
	}
else if($portionbydate=="Last365days")
	{
		if($string!="")
			{
		$string.="and tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
			}
			else
			{
				$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
			}
	}
			
			
			
		}
		else
		{
			//$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
			
			
			
		
			
				if($portionbydate=="Last5days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($portionbydate=="Last10days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	elseif($portionbydate=="Last15days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($portionbydate=="Last20days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($portionbydate=="Last25days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($portionbydate=="Last30days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	else if($portionbydate=="Today")
	{
		$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	else if($portionbydate=="Yesterday")
			  {
		 $string.=" tbl_tableorder.ter_dayclosedate =  CURDATE() - INTERVAL 1 day ";
				 
			  }
	else if($portionbydate=="Last1month")
	{
		 $string.=" tbl_tableorder.ter_dayclosedate between CURDATE( ) - INTERVAL 1  MONTH AND CURDATE( ) ";
	}
	
	else if($portionbydate=="Last90days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}

else if($portionbydate=="Last180days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($portionbydate=="Last365days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}
			
		}
			
			
	}
	else
	{
		
	}
			
		}
		
		
	  

	  
	    $sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_portionmaster.pm_portionname,tbl_menumaster.mr_menuname as menuname From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid Inner Join tbl_staffmaster On tbl_tableorder.ter_staff = tbl_staffmaster.ser_staffid inner join tbl_portionmaster ON tbl_tableorder.ter_portion=tbl_portionmaster.pm_id where  $string Group By tbl_menumaster.mr_menuname order by ct DESC"); 
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
{
    /***********************************************Type of item**********************************************************/
 $date=date("Ymd");
$string="";
$ordtype=$_REQUEST['ordertyp'];
if($_REQUEST['from']!="" && $_REQUEST['to']!="")
		{
			$from=$database->convert_date($_REQUEST['from']);
			$to=$database->convert_date($_REQUEST['to']);
			$string= " tbl_tableorder.ter_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['from']!="" && $_REQUEST['to']=="")
		{
			$from=$database->convert_date($_REQUEST['from']);
			$to=date("Y-m-d");
			$string= " tbl_tableorder.ter_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['from']=="" && $_REQUEST['to']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['to']);
			$string= " tbl_tableorder.ter_dayclosedate between '".$from."' and '".$to."' ";
		}
	
	else
	{
		/*$cur=date("Y-m-d");
		$string=" tbl_tableorder.ter_dayclosedate='".$cur."'";*/
		
		
		
	$string="";
	
		$ordertypebydate=$_REQUEST['hidorderby'];
	if($ordertypebydate!="null")
	{
		//$search="";
	if($ordertypebydate=="Last5days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($ordertypebydate=="Last10days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	elseif($ordertypebydate=="Last15days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($ordertypebydate=="Last20days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($ordertypebydate=="Last25days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($ordertypebydate=="Last30days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	else if($ordertypebydate=="Today")
	{
		$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	else if($ordertypebydate=="Yesterday")
			  {
				  $string.="tbl_tableorder.ter_dayclosedate  =  CURDATE() - INTERVAL 1 day ";
			  }
	else if($ordertypebydate=="Last1month")
	{
		$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
	}
	
	
	
	
	else if($ordertypebydate=="Last90days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}

else if($ordertypebydate=="Last180days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($ordertypebydate=="Last365days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}

	}
	
	else
	{
		$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
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

else if($_REQUEST['type']=="complementary_report")
{
	
//`tbl_tablebillmaster`(`bm_billno`, `bm_dayclosedate`, `bm_billtime`, `bm_branchid`, `bm_subtotal`, `bm_paymode`, `bm_cancelamount`, `bm_discountid`, `bm_corporatecode`, `bm_discountvalue`, `bm_servicetax`, `bm_vat`, `bm_servicecharge`, `bm_credit`, `bm_creditroom`, `bm_creditstaff`, `bm_complimentary`, `bm_complimentaryremark`, `bm_finaltotal`, `bm_amountpaid`, `bm_amountbalace`, `bm_transactionid`, `bm_voucherid`, `bm_couponcompany`, `bm_couponamt`, `bm_chequeno`, `bm_chequebankname`)	
	  //$cur=date("Y-m-d");
	  $string=" bm_status='Closed' AND  bm_complimentary='Y' AND ";
	  if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " bm_billdate between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=date("Y-m-d");
			$string.= " bm_billdate between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " bm_billdate between '".$from."' and '".$to."' ";
		}
	else
	{
	/*	$cur=date("Y-m-d");
		$string=" bm_dayclosedate='".$cur."'";*/
		
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
	
 	  $sql_login  =  $database->mysqlQuery("select * from tbl_tablebillmaster where $string order by bm_billdate,bm_billtime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
		 if($num_stw)
	  {
			echo "ok";
	  }else
	  {
		  echo "sorry";
	  }
	
}


else if($_REQUEST['type']=="loyality_customer")
{
	
	
	 $date=date("Ymd");
	 $string=" ";
		if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=$database->convert_date($_REQUEST['hidto']);
	$string.= " ly_entrydatetime between '".$from."' and '".$to."' ";
	
		}
		else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=date("Y-m-d");
			$string.= " ly_entrydatetime between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " ly_entrydatetime between '".$from."' and '".$to."' ";
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
		$string.="ly_entrydatetime between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($bydatz=="Last10days")
	{
		$string.="ly_entrydatetime between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" ly_entrydatetime between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" ly_entrydatetime between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last25days")
	{
		$string.="ly_entrydatetime between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last30days")
	{
		$string.="ly_entrydatetime between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Today")
	{
		$string.="ly_entrydatetime between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.="ly_entrydatetime = CURDATE() - INTERVAL 1 day";
			  }
			   else if($bydatz=="Last1month")
			  {
				  $string.="ly_entrydatetime between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
else if($bydatz=="Last90days")
	{
		$string.="ly_entrydatetime between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last180days")
	{
		$string.="ly_entrydatetime between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last365days")
	{
		$string.="ly_entrydatetime between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}

	}
	else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "ly_entrydatetime between '".$from."' and '".$to."' ";
	}
		
	
	
	
	
	
		
		/*$cur=date("Y-m-d");
		$string=" bm_dayclosedate='".$cur."'";*/
	}


	$cur=date("Y-m-d");
 	  $sql_login  =  $database->mysqlQuery("select * from tbl_loyalty_reg where $string order by ly_entrydatetime ASC"); 
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
	
	
//`tbl_tablebillmaster`(`bm_billno`, `bm_dayclosedate`, `bm_billtime`, `bm_branchid`, `bm_subtotal`, `bm_paymode`, `bm_cancelamount`, `bm_discountid`, `bm_corporatecode`, `bm_discountvalue`, `bm_servicetax`, `bm_vat`, `bm_servicecharge`, `bm_credit`, `bm_creditroom`, `bm_creditstaff`, `bm_complimentary`, `bm_complimentaryremark`, `bm_finaltotal`, `bm_amountpaid`, `bm_amountbalace`, `bm_transactionid`, `bm_voucherid`, `bm_couponcompany`, `bm_couponamt`, `bm_chequeno`, `bm_chequebankname`)	
	  //$cur=date("Y-m-d");
	  $string="";
	  	  if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=$database->convert_date($_REQUEST['hidto']);
		
			
					if($_REQUEST['cat']!="")
	    {
			   $bycat=$_REQUEST['cat'];
			if($string !="")
			{
	 
		$string.=" and c.crd_type='".$bycat."' ";
			}
			else
			{
					 
		$string.="c.crd_type='".$bycat."' ";
			}
			
	     }
		}
		else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=date("Y-m-d");
			$string.= "date(cd.cd_dateofentry) between '".$from."' and '".$to."' ";
					if($_REQUEST['cat']!="")
	    {
			   $bycat=$_REQUEST['cat'];
			if($string !="")
			{
	 
		$string.=" and c.crd_type='".$bycat."' ";
			}
			else
			{
					 
		$string.="c.crd_type='".$bycat."' ";
			}
			
	     }
		}
		else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= "date(cd.cd_dateofentry) between '".$from."' and '".$to."' ";
					if($_REQUEST['cat']!="")
	    {
			   $bycat=$_REQUEST['cat'];
			if($string !="")
			{
	 
		$string.=" and c.crd_type='".$bycat."' ";
			}
			else
			{
					 
		$string.="c.crd_type='".$bycat."' ";
			}
			
	     }
		}
	else
	{
	/*	$cur=date("Y-m-d");
		$string=" bm_dayclosedate='".$cur."'";*/
		
		/*$cur=date("Y-m-d");
		$string=" bm_dayclosedate='".$cur."'";*/
		
		
	//$bydate=$_REQUEST['hidbydate'];
	
		$bydatz=$_REQUEST['hidbydate'];
			if($bydatz!="null")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.="date(cd.cd_dateofentry) between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($bydatz=="Last10days")
	{
		$string.="date(cd.cd_dateofentry) between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	elseif($bydatz=="Last15days")
	{
		$string.="date(cd.cd_dateofentry) between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last20days")
	{
		$string.="date(cd.cd_dateofentry) between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last25days")
	{
		$string.="date(cd.cd_dateofentry) between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last30days")
	{
		$string.="date(cd.cd_dateofentry) between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Today")
	{
		$string.="date(cd.cd_dateofentry) between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	
	else if($bydatz=="Yesterday")
			  {
				  $string.="date(cd.cd_dateofentry) =  CURDATE() - INTERVAL 1 day";
			  }
			   else if($bydatz=="Last1month")
			  {
				  $string.="date(cd.cd_dateofentry) between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
else if($bydatz=="Last90days")
	{
		$string.="date(cd.cd_dateofentry) between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last180days")
	{
		$string.="date(cd.cd_dateofentry) between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last365days")
	{
		$string.="date(cd.cd_dateofentry) between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}
	
	
			if($_REQUEST['cat']!="")
	    {
			   $bycat=$_REQUEST['cat'];
			if($string !="")
			{
	 
		$string.=" and c.crd_type='".$bycat."' ";
			}
			else
			{
					 
		$string.="c.crd_type='".$bycat."' ";
			}
			
	     }

	}
	else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "date(cd.cd_dateofentry) between '".$from."' and '".$to."' ";
					if($_REQUEST['cat']!="")
	    {
			   $bycat=$_REQUEST['cat'];
			if($string !="")
			{
	 
		$string.=" and c.crd_type='".$bycat."' ";
			}
			else
			{
					 
		$string.="c.crd_type='".$bycat."' ";
			}
			
	     }
	}
	
	}
	
 	  $sql_login  =  $database->mysqlQuery("select * from tbl_credit_master as c left join tbl_credit_details as cd on c.crd_id=cd.cd_masterid left join tbl_staffmaster as s on c.crd_staffid=s.ser_staffid left join tbl_roommaster as r on c.crd_roomid=r.rm_roomid left join tbl_corporatemaster as cm on c.crd_corporateid=cm.ct_corporatecode left join tbl_loyalty_reg  as l on c.crd_guestid=l.ly_id where $string order by cd.cd_dateofentry ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
		 if($num_login)
	  {
			echo "ok";
	  }else
	  {
		  echo "sorry";
	  }
}


else if($_REQUEST['type']=="kot_history")
{
	
	
	
//`tbl_tablebillmaster`(`bm_billno`, `bm_dayclosedate`, `bm_billtime`, `bm_branchid`, `bm_subtotal`, `bm_paymode`, `bm_cancelamount`, `bm_discountid`, `bm_corporatecode`, `bm_discountvalue`, `bm_servicetax`, `bm_vat`, `bm_servicecharge`, `bm_credit`, `bm_creditroom`, `bm_creditstaff`, `bm_complimentary`, `bm_complimentaryremark`, `bm_finaltotal`, `bm_amountpaid`, `bm_amountbalace`, `bm_transactionid`, `bm_voucherid`, `bm_couponcompany`, `bm_couponamt`, `bm_chequeno`, `bm_chequebankname`)	
	  //$cur=date("Y-m-d");
	  $string="";
	  if($_REQUEST['hidfr']!="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
		
			$string.= " k.kr_date = '".$from."' and o.ter_dayclosedate = '".$from."' ";
		}
		
	else
	{
	/*	$cur=date("Y-m-d");
		$string=" bm_dayclosedate='".$cur."'";*/
		
		/*$cur=date("Y-m-d");
		$string=" bm_dayclosedate='".$cur."'";*/
		
		
	//$bydate=$_REQUEST['hidbydate'];
	
	
		
	
	
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "k.kr_date between '".$from."' and o.ter_dayclosedate = '".$from."'  ";
	}
		

	
 	  $sql_login  =  $database->mysqlQuery("SELECT k.kr_date,k.kr_kotno as KOT ,k.kr_print as printed,o.ter_status as kot_status,mm.mr_menuname as menu ,pm.pm_portionname AS Portion,o.ter_qty as Qty,o.ter_rate as Unit_Rate, ROUND((o.ter_qty*o.ter_rate),2) as Total_Rate ,o.ter_billnumber FROM `tbl_kotmaster` K left join tbl_tableorder o on o.ter_kotno = k.kr_kotno LEFT JOIN tbl_menumaster mm ON o.ter_menuid=mm.mr_menuid LEFT JOIN tbl_portionmaster pm ON o.ter_portion=pm.pm_id where $string order by k.kr_time asc"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
		 if($num_stw)
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
	
		//echo $_REQUEST['fromdt'] ."--";
		//echo $_REQUEST['todt'] ."<br>";
		if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " ter_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=date("Y-m-d");
			$string.= " ter_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " ter_dayclosedate between '".$from."' and '".$to."' ";
		}
	
	
	else
	{
		
		$bydatz=$_REQUEST['hidbydate'];
		
		
		
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
else if($_REQUEST['type']=="menu_rating")
{
	$string="";
	 
		$bydatz=$_REQUEST['hidbydate'];
		
		
		
			if($bydatz!="")
	{
		//$search="";
	$string.=" m.mr_menuname LIKE  '%" . $bydatz ."%' and m.mr_rating > '0' ";
	

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
	else if($_REQUEST['type']=="general_feedback")
	{
	$string="";

	
		//echo $_REQUEST['fromdt'] ."--";
		//echo $_REQUEST['todt'] ."<br>";
		if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " date(f.fbr_entrytime) between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=date("Y-m-d");
			$string.= " date(f.fbr_entrytime) between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= "  date(f.fbr_entrytime) between '".$from."' and '".$to."' ";
		}

	
	else 
	{
		
		$bydatz=$_REQUEST['hidbydate'];
		
		
		
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
	else if($_REQUEST['type']=="food_costing")
	{
	
	
	$string="";
	 
		$bydatz=$_REQUEST['hidfr'];
		
		
		
			if($bydatz!="")
	{
		//$search="";
	$string.=" rd.fc_menuid='".$bydatz."' ";
	

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
	  {
		  echo "sorry";
	  }
	}
	else
	{
				  echo "sorry";

	}
	}
	else if($_REQUEST['type']=="table_turnover" || $_REQUEST['type']=="table_turnoversummary")
	{
	$string="";
		//echo $_REQUEST['fromdt'] ."--";
		//echo $_REQUEST['todt'] ."<br>";
		if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " tor_date between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=date("Y-m-d");
			$string.= " tor_date between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " tor_date between '".$from."' and '".$to."' ";
		}

	
	else 
	{
		
		$bydatz=$_REQUEST['hidbydate'];
		
		
		
			if($bydatz!="null")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.="  tor_date between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($bydatz=="Last10days")
	{
		$string.="  tor_date between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.="  tor_date=CURDATE( ) - INTERVAL 1 DAY"; 
			  }
	elseif($bydatz=="Last15days")
	{
		$string.="  tor_date between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last20days")
	{
		$string.="  tor_date between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last25days")
	{
		$string.="  tor_date between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last30days")
	{
		$string.="  tor_date between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	 else if($bydatz=="Last1month")
			  {
				  $string.="  tor_date between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
	else if($bydatz=="Today")
	{
		$string.="  tor_date between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
else if($bydatz=="Last90days")
	{
		$string.="  tor_date between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last180days")
	{
		$string.="  tor_date between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last365days")
	{
		$string.="  tor_date between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}

	}
	else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "  tor_date between '".$from."' and '".$to."' ";
	}
	}
	
  $sql_login  =  $database->mysqlQuery("select * from tbl_tableturnover where $string order by tor_date ASC"); 
  
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
		
	 $date=date("Ymd");
	 $string=" bm_status='Closed' AND ";
		if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
		}
		else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
		}
		else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
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
				  $string.="bm_dayclosedate = CURDATE() - INTERVAL 1 day";
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


	$cur=date("Y-m-d");
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
	else if($_REQUEST['type']=="categorywise_report")
	{
            $string ="";
            $string="bm.bm_status = 'Closed'";
            $from='';
            $to='';
            $reporthead="";
            $st="";
		 if($_REQUEST['floorz'] !='')
	{
		
			$string.=" and bm.bm_floorid='".$_REQUEST['floorz']."'";
	}
									  
	  if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
		{
		  
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=$database->convert_date($_REQUEST['hidto']);
                        $string.= "and bm.bm_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
			
		}
		else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=date("Y-m-d");
                        $string.= "and bm.bm_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
			
		}
		else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=$database->convert_date($_REQUEST['hidto']);
                        $string.= "and bm.bm_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		
		}
                else{
                    
                    $bydatz=$_REQUEST['hidbydate'];
	
		    if($bydatz!="null")
                    {
                        if($bydatz=="Last5days")
                        {
                            $string.="and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                            $st="Last5days";
                        }    
                        elseif($bydatz=="Last10days")
                        {   
                            $string.="and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";

                            $st="Last 10 days";
                        }
                        elseif($bydatz=="Last15days")
                        {
                            $string.="and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";

                            $st="Last 15 days";
                        }
                        else if($bydatz=="Last20days")
                        {
                            $string.="and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";

                            $st="Last 20 days";
                        }
                        else if($bydatz=="Last25days")
                        {
                            $string.="and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";

                            $st="Last 25 days";
                        }
                        else if($bydatz=="Last30days")
                        {
                            $string.="and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                            $st="Last 30 days";
                        }
                        else if($bydatz=="Today")
                        {
                            $string.="and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
                            $st="Today";
                        }

                        else if($bydatz=="Yesterday")
			{
                            $string.="and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 DAY  AND CURDATE( )";
                            $st="Yesterday";
			}
                        else if($bydatz=="Last1month")
                        {
                           $string.="and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
                           $st="Last 1 Month"; 
                        }
                        else if($bydatz=="Last90days")
                        {
                            $string.="and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                            $st="Last 90 months";
                        }
                        else if($bydatz=="Last180days")
                        {
                            $string.="and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                            $st="Last 180 days";
                        }
                        else if($bydatz=="Last365days")
                        {
                            $string.="and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                            $st="Last 365 days";
                        }
                        $reporthead=$st;
                    }
                    else
                    {
                        $from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " and bm.bm_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                    }        
                    }  
    
	$final=0;

 	  $sql_login  =  $database->mysqlQuery("SELECT mc.mmy_maincategoryname,count(distinct(bd.bd_menuid))as 'no of items',sum(bd.bd_qty) as qty ,sum(bd.bd_amount) as Total from tbl_tablebilldetails bd left join tbl_tablebillmaster bm on bm.bm_billno = bd.bd_billno left join tbl_menumaster on mr_menuid=bd.bd_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = mr_maincatid where $string group by mr_maincatid ORDER BY mr_maincatid ASC");
      //echo"SELECT mc.mmy_maincategoryname,count(distinct(bd.bd_menuid))as 'no of items',sum(bd.bd_qty) as qty ,sum(bd.bd_amount) as Total from tbl_tablebilldetails bd left join tbl_tablebillmaster bm on bm.bm_billno = bd.bd_billno left join tbl_menumaster on mr_menuid=bd.bd_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = mr_maincatid where $string group by mr_maincatid ORDER BY mr_maincatid ASC";
	  $num_login   = $database->mysqlNumRows($sql_login);
	
	if($num_login)
        {
            echo "ok";
        }
	
        else
            {
            echo "sorry";
            }
	
        }
	
	
	
	
	
	
	
	



?>