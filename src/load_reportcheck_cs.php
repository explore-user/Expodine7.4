

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
    $string="";
    $string.=" tab_status='Closed' AND tab_mode= 'CS' and tab_complimentary!='Y' ";
    
    if($_REQUEST['log_user']!="null")
        $string.=" AND tab_loginid = '".$_REQUEST['log_user']."'";
    
    
//    if($user != "")
        
    
        
				
					if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
					{
						$from=$database->convert_date($_REQUEST['fromdt']);
						$to=$database->convert_date($_REQUEST['todt']);
						$string.= " and tab_dayclosedate between '".$from."' and '".$to."' ";
					}
					else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
					{
						$from=$database->convert_date($_REQUEST['fromdt']);
						$to=date("Y-m-d");
						$string.= " and tab_dayclosedate between '".$from."' and '".$to."'";
					}
					else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
					{
						$from=date("Y-m-d");
						$to=$database->convert_date($_REQUEST['todt']);
						$string.= " and tab_dayclosedate between '".$from."' and '".$to."'";
					}
					
					
				
				
	else 
	{
		
		$bydatz=$_REQUEST['bydate'];
		
		
		
			if($bydatz!="null" && $bydatz!="")
			{
		//$search="";
//        if($login_user!="")
//            $string.=" AND tab_loginid = '$login_user'";
	
	if($bydatz=="Last5days")
	{
		$string.=" and tab_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($bydatz=="Last10days")
	{
		$string.=" and tab_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.=" and tab_dayclosedate = CURDATE() - INTERVAL 1 day";
			  }
	elseif($bydatz=="Last15days")
	{
		$string.=" and tab_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" and tab_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last25days")
	{
		$string.=" and tab_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last30days")
	{
		$string.=" and tab_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	 else if($bydatz=="Last1month")
			  {
				  $string.=" and tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
	else if($bydatz=="Today")
	{
		$string.=" and tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
else if($bydatz=="Last90days")
	{
		$string.=" and tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last180days")
	{
		$string.=" and tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last365days")
	{
		$string.="and  tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}
	}
else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " and  tab_dayclosedate between '".$from."' and '".$to."' ";
	}
		
	
	
	}
	
	
	
	$sql_login1  =  $database->mysqlQuery("select * from tbl_takeaway_billmaster where $string order by tab_billno ASC" ); 
        //echo "select * from tbl_takeaway_billmaster where $string order by tab_billno ASC";
		
	  $num_login   = $database->mysqlNumRows($sql_login1);
		
	  if($num_login)
	  {
	echo  "ok";
	  }else
	  {
            echo  "sorry";
	  }
	  
	

}
/************************summary cs start*****************************/

else if(($_REQUEST['type']=="summary_cs"))
{
	
	$string="";
	$string=" tab_status='Closed' AND tab_mode= 'CS' AND";
	
	
		//echo $_REQUEST['fromdt'] ."--";
		//echo $_REQUEST['todt'] ."<br>";
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
		}
	
	
	else 
	{
		
		$bydatz=$_REQUEST['bydate'];
		
		
		
	if($bydatz!="null" && $bydatz!="")
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
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "tab_dayclosedate between '".$from."' and '".$to."' ";
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



/********************************summary cs end***********************/

/*******************************Summary details cs Start********************/

else if(($_REQUEST['type']=="total_summary_details_cs"))
{
	
	$string="";
	$string=" tab_status='Closed' AND tab_mode= 'CS' AND";
	
	
		//echo $_REQUEST['fromdt'] ."--";
		//echo $_REQUEST['todt'] ."<br>";
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
		}
	
	
	else 
	{
		
		$bydatz=$_REQUEST['bydate'];
		
		
		
			if($bydatz!="null" && $bydatz!="")
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
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "tab_dayclosedate between '".$from."' and '".$to."' ";
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

/*****************************Summary details cs end*************************/


else if(($_REQUEST['type'] == "itemordered_cs"))
{	$string="";
	$string.=" tbm.tab_status = 'Closed' and tbm.tab_mode='CS'";
	
        $addon_head='';
        $stringta_addon='';
        if($_REQUEST['addon']=='N')
            {
                
                $stringta_addon.=" and tbd.tab_bill_addon_slno IS NULL ";
            }
        else if($_REQUEST['addon']=='Y')
            {
                
                $stringta_addon.=" and tbd.tab_bill_addon_slno IS NOT NULL ";
                 $addon_head='-Addon ';
            }

					
					if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
					{
						$from=$database->convert_date($_REQUEST['fromdt']);
						$to=$database->convert_date($_REQUEST['todt']);
						$string.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."'  ";
					}
					else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
					{
						$from=$database->convert_date($_REQUEST['fromdt']);
						$to=date("Y-m-d");
						$string.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
					}
					else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
					{
						$from=date("Y-m-d");
						$to=$database->convert_date($_REQUEST['todt']);
						$string.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."'  ";
					}
					
					
				
	else 
	{
		
		$bydatz=$_REQUEST['bydate'];
		
		
		
			if($bydatz!="null" && $bydatz!="")
			{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($bydatz=="Last10days")
	{
		$string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.=" and tbm.tab_dayclosedate = CURDATE() - INTERVAL 1 day";
			  }
	elseif($bydatz=="Last15days")
	{
		$string.="  and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" and  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last25days")
	{
		$string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last30days")
	{
		$string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	 else if($bydatz=="Last1month")
			  {
				  $string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
	else if($bydatz=="Today")
	{
		$string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
else if($bydatz=="Last90days")
	{
		$string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last180days")
	{
		$string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last365days")
	{
		$string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}
	}
else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
	}
	}
		
	
				
	 	  $sql_login  =  $database->mysqlQuery("SELECT mc.mmy_maincategoryname,ms.msy_subcategoryname,m.mr_menuname,p.pm_portionname,sum(tbd.tab_qty) as qty,ROUND(avg(tbd.tab_rate), 1) as Unit_Price, ((sum(tbd.tab_qty))*(ROUND(avg(tbd.tab_rate), 1))) as Total from tbl_takeaway_billmaster tbm left join tbl_takeaway_billdetails tbd on tbd.tab_billno = tbm.tab_billno left join tbl_menumaster m on m.mr_menuid = tbd.tab_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = m.mr_maincatid left join tbl_menusubcategory ms on ms.msy_subcategoryid = m.mr_subcatid left join tbl_portionmaster p on p.pm_id = tbd.tab_portion where $string $stringta_addon group by m.mr_maincatid ,m.mr_subcatid,tbd.tab_menuid,tbd.tab_portion ORDER BY m.mr_maincatid,m.mr_subcatid  DESC");
                      
                  //echo "SELECT mc.mmy_maincategoryname,ms.msy_subcategoryname,m.mr_menuname,p.pm_portionname,sum(tbd.tab_qty) as qty,ROUND(avg(tbd.tab_rate), 1) as Unit_Price, ((sum(tbd.tab_qty))*(ROUND(avg(tbd.tab_rate), 1))) as Total from tbl_takeaway_billmaster tbm left join tbl_takeaway_billdetails tbd on tbd.tab_billno = tbm.tab_billno left join tbl_menumaster m on m.mr_menuid = tbd.tab_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = m.mr_maincatid left join tbl_menusubcategory ms on ms.msy_subcategoryid = m.mr_subcatid left join tbl_portionmaster p on p.pm_id = tbd.tab_portion where $string $stringta_addon group by m.mr_maincatid ,m.mr_subcatid,tbd.tab_menuid,tbd.tab_portion ORDER BY m.mr_maincatid,m.mr_subcatid  DESC";
                  $num_login   = $database->mysqlNumRows($sql_login);
                        if($num_login)
                         {
			echo "ok";
                          }else
                          {
                           echo "sorry";
                           }

}
if(($_REQUEST['type'] == "discountreport_cs"))
{	$string="";
	$string.=" tab_status='Closed' AND tab_mode= 'CS' AND tab_discountvalue<>'0.00' ";
	
					if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
					{
						$from=$database->convert_date($_REQUEST['fromdt']);
						$to=$database->convert_date($_REQUEST['todt']);
						$string.= " and tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate ";
					}
					else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
					{
						$from=$database->convert_date($_REQUEST['fromdt']);
						$to=date("Y-m-d");
						$string.= " and tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
					}
					else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
					{
						$from=date("Y-m-d");
						$to=$database->convert_date($_REQUEST['todt']);
						$string.= " and tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate ";
					}
					
					
				
	else 
	{
		
		$bydatz=$_REQUEST['bydate'];
		
		
		
			if($bydatz!="null" && $bydatz!="")
			{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.=" and tab_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($bydatz=="Last10days")
	{
		$string.=" and tab_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.=" and tab_dayclosedate = CURDATE() - INTERVAL 1 day";
			  }
	elseif($bydatz=="Last15days")
	{
		$string.="  and tab_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" and  tab_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last25days")
	{
		$string.=" and tab_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last30days")
	{
		$string.=" and tab_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	 else if($bydatz=="Last1month")
			  {
				  $string.=" and tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
	else if($bydatz=="Today")
	{
		$string.=" and tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
else if($bydatz=="Last90days")
	{
		$string.=" and tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last180days")
	{
		$string.=" and tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last365days")
	{
		$string.=" and tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}
	}
else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " and tab_dayclosedate between '".$from."' and '".$to."' ";
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
if(($_REQUEST['type'] == "complimentary_cs"))
{	$string="";
	$string.=" tab_status='Closed' AND tab_mode= 'CS' AND tab_complimentary='Y' ";
		//echo $_REQUEST['fromdt'] ."--";
					//echo $_REQUEST['todt'] ."<br>";
					if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
					{
						$from=$database->convert_date($_REQUEST['fromdt']);
						$to=$database->convert_date($_REQUEST['todt']);
						$string.= " and tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate ";
					}
					else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
					{
						$from=$database->convert_date($_REQUEST['fromdt']);
						$to=date("Y-m-d");
						$string.= " and tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
					}
					else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
					{
						$from=date("Y-m-d");
						$to=$database->convert_date($_REQUEST['todt']);
						$string.= " and tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate ";
					}
					
					
				
		else 
			{
		
		$bydatz=$_REQUEST['bydate'];
		
		
		
			if($bydatz!="null" && $bydatz!="" )
			{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.=" and tab_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($bydatz=="Last10days")
	{
		$string.=" and tab_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.=" and tab_dayclosedate = CURDATE() - INTERVAL 1 day";
			  }
	elseif($bydatz=="Last15days")
	{
		$string.="  and tab_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" and  tab_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last25days")
	{
		$string.=" and tab_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last30days")
	{
		$string.=" and tab_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	 else if($bydatz=="Last1month")
			  {
				  $string.=" and tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
	else if($bydatz=="Today")
	{
		$string.=" and tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
else if($bydatz=="Last90days")
	{
		$string.=" and tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last180days")
	{
		$string.=" and tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last365days")
	{
		$string.=" and tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}
	}
else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " and tab_dayclosedate between '".$from."' and '".$to."' ";
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


if(($_REQUEST['type'] == "billreport_cs"))
{
        $string="";
	$string=" tbm.tab_status='Closed' AND tbm.tab_mode='CS'"; 
	//echo $_REQUEST['fromdt'] ."--";
					//echo $_REQUEST['todt'] ."<br>";
					if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
					{
						$from=$database->convert_date($_REQUEST['fromdt']);
						$to=$database->convert_date($_REQUEST['todt']);
						$string.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."'";
					}
					else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
					{
						$from=$database->convert_date($_REQUEST['fromdt']);
						$to=date("Y-m-d");
						$string.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."'";
					}
					else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
					{
						$from=date("Y-m-d");
						$to=$database->convert_date($_REQUEST['todt']);
						$string.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."'";
					}
					
					
				
		else 
			{
		
		$bydatz=$_REQUEST['bydate'];
		
		
		
			if($bydatz!="null" && $bydatz!="")
			{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.=" and  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($bydatz=="Last10days")
	{
		$string.=" and  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.=" and  tbm.tab_dayclosedate = CURDATE() - INTERVAL 1 day";
			  }
	elseif($bydatz=="Last15days")
	{
		$string.="  and  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" and   tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last25days")
	{
		$string.=" and  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last30days")
	{
		$string.=" and  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	 else if($bydatz=="Last1month")
			  {
				  $string.=" and  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
	else if($bydatz=="Today")
	{
		$string.=" and  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
else if($bydatz=="Last90days")
	{
		$string.=" and  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last180days")
	{
		$string.=" and  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last365days")
	{
		$string.=" and  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}
	}
else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " and  tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
	}
	}
	
   $sql_login1  =  $database->mysqlQuery("SELECT tbm.tab_billno,tbm.tab_dayclosedate,mn.mr_menuname,tbd.tab_rate,tbd.tab_qty,pm.pm_portionname,tbm.tab_discountvalue from tbl_takeaway_billmaster as tbm left join tbl_takeaway_billdetails tbd on tbm.tab_billno=tbd.tab_billno LEFT JOIN tbl_menumaster as mn ON tbd.tab_menuid=mn.mr_menuid LEFT JOIN tbl_portionmaster as pm ON tbd.tab_portion=pm.pm_id  WHERE $string"); 
//   $sql_login1  =  $database->mysqlQuery("SELECT tbm.tab_billno,tbm.tab_dayclosedate,mn.mr_menuname,tbd.tab_rate,tbd.tab_qty,pm.pm_portionname,tbm.tab_discountvalue from tbl_takeaway_billmaster as tbm tbl_takeaway_billdetails tbd on tbm.tab_billno=tbd.tab_billno LEFT JOIN tbl_menumaster as mn ON tbd.tab_menuid=mn.mr_menuid LEFT JOIN tbl_portionmaster as pm ON tbd.tab_portion=pm.pm_id  WHERE $string order by tbm.tab_dayclosedate,tbm.tab_time"); 
		
	  $num_login   = $database->mysqlNumRows($sql_login1);
		
	  if($num_login)
	  {
	echo "ok";
	  }else
	  {
	echo "sorry";
	  }
	  
	

}

else if(($_REQUEST['type']=="paymenttype_cs"))
{
	//$string="";
	$string=" tbm.tab_status='Closed' and tbm.tab_mode='CS' ";
	$fields="";

	if($_REQUEST['typepay']=="cash")
	{
		//$string = " (bm_transactionamount ='' or bm_transactionamount IS NULL) and (bm_couponcompany ='' or bm_couponcompany IS NULL) and bm_voucherid IS NULL and bm_couponamt ='0.00' and  (bm_chequeno ='' or bm_chequeno IS NULL) and (bm_chequebankname='' or bm_chequebankname IS NULL)";
		
		$string.= "";
		$fields="";
	}else if($_REQUEST['typepay']=="credit")
	{
		//$string = " bm_transactionamount <>'' ";
		$string.= " and  p.pym_code='credit' ";
		$fields="<th class='sortable'>Transcation Amount</th>";
		
	}else if($_REQUEST['typepay']=="coupons")
	{
		//$string = " bm_couponcompany <>''  and bm_couponamt <>'0.00'";
		$string = "pym_code='coupon'";
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
			$string.= "  and tbm.tab_dayclosedate between '".$from."' and '".$to."' order by tbm.tab_dayclosedate";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= "  and tbm.tab_dayclosedate between '".$from."' and '".$to."' order by tbm.tab_dayclosedate";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= "  and tbm.tab_dayclosedate between '".$from."' and '".$to."' order by tbm.tab_dayclosedate";
		}
		

    else{
	$paybydate=$_REQUEST['paybydate'];
		if($paybydate!="null" && $paybydate!="")
	{
		
		
	if($paybydate=="Last5days")
	{
		$string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($paybydate=="Last10days")
	{
		$string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	elseif($paybydate=="Last15days")
	{
		$string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($paybydate=="Last20days")
	{
		$string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($paybydate=="Last25days")
	{
		$string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($paybydate=="Last30days")
	{
		$string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	else if($paybydate=="Today")
	{
		$string.=" tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
		else if($paybydate=="Yesterday")
			  {
				  $string.=" and tbm.tab_dayclosedate =CURDATE() - INTERVAL 1 day";
			  }
	else if($paybydate=="Last1month")
	{
		$string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
	}
	else if($paybydate=="Last90days")
	{
		$string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 3 
MONTH AND CURDATE( )";
	}
	else if($paybydate=="Last180days")
	{
		$string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 6 
MONTH AND CURDATE( )";
	}
	else if($paybydate=="Last365days")
	{
		$string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 
YEAR AND CURDATE( )";
	}
	
	}
        else
            {
			
                $from=date("Y-m-d");
		$to=date("Y-m-d");
		$string.= "(tbm.tab_dayclosedate between '".$from."' and '".$to."' )  ";
            }
    }



 	  $sql_login  =  $database->mysqlQuery("select tbm.tab_billno,tbm.tab_dayclosedate,tbm.tab_amountpaid,tbm.tab_amountbalace from tbl_takeaway_billmaster tbm left join tbl_paymentmode p on tbm.tab_paymode=p.pym_id where $string"); 
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
else if(($_REQUEST['type'] == "billcancel_cs"))
{	$string="";
	$string.="tbm.tab_mode='CS' and tbm.tab_status='Cancelled' ";
				
					
					if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
					{
						$from=$database->convert_date($_REQUEST['fromdt']);
						$to=$database->convert_date($_REQUEST['todt']);
						$string.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
					}
					else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
					{
						$from=$database->convert_date($_REQUEST['fromdt']);
						$to=date("Y-m-d");
						$string.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."'";
					}
					else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
					{
						$from=date("Y-m-d");
						$to=$database->convert_date($_REQUEST['todt']);
						$string.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."'";
					}
					
					
				
				
	else 
	{
		
		$bydatz=$_REQUEST['bydate'];
		
		
		
			if($bydatz!="null" && $bydatz!="" )
			{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.=" and tab_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($bydatz=="Last10days")
	{
		$string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.=" and tbm.tab_dayclosedate = CURDATE() - INTERVAL 1 day";
			  }
	elseif($bydatz=="Last15days")
	{
		$string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last25days")
	{
		$string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last30days")
	{
		$string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	 else if($bydatz=="Last1month")
			  {
				  $string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
	else if($bydatz=="Today")
	{
		$string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
else if($bydatz=="Last90days")
	{
		$string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last180days")
	{
		$string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last365days")
	{
		$string.="and  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}
	}
else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
	}
		
	
	
	}
	
	
	
	$sql_login1  =  $database->mysqlQuery("select tbm.tab_billno,tbm.tab_dayclosedate,tbm.tab_cancelledreason,tbm.tab_netamt,ld.ls_staffid,sm.ser_firstname 
from tbl_takeaway_billmaster tbm left join tbl_staffmaster sm on sm.ser_staffid=tbm.tab_cancelledby_careof left join
 tbl_logindetails ld on ld.ls_username=tbm.tab_cancelledlogin where $string order by tbm.tab_billno ASC" ); 
 
       /* echo"select tbm.tab_billno,tbm.tab_dayclosedate,tbm.tab_cancelledreason,tbm.tab_netamt,ld.ls_staffid,sm.ser_firstname 
from tbl_takeaway_billmaster tbm left join tbl_staffmaster sm on sm.ser_staffid=tbm.tab_cancelledby_careof left join
 tbl_logindetails ld on ld.ls_username=tbm.tab_cancelledlogin where $string order by tbm.tab_billno ASC";*/
       
		
	  $num_login   = $database->mysqlNumRows($sql_login1);
		
	  if($num_login)
	  {
	echo  "ok";
	  }else
	  {
echo  "sorry";
	  }
	  
	

}
else if(($_REQUEST['type'] == "cancelhistory_cs"))
{	$string="";
	$string.="tbm.tab_mode='CS'   ";
				
					//echo $_REQUEST['fromdt'] ."--";
					//echo $_REQUEST['todt'] ."<br>";
					if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
					{
						$from=$database->convert_date($_REQUEST['fromdt']);
						$to=$database->convert_date($_REQUEST['todt']);
						$string.= " and ci.tc_dayclosedate between '".$from."' and '".$to."' ";
					}
					else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
					{
						$from=$database->convert_date($_REQUEST['fromdt']);
						$to=date("Y-m-d");
						$string.= " and ci.tc_dayclosedate between '".$from."' and '".$to."'";
					}
					else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
					{
						$from=date("Y-m-d");
						$to=$database->convert_date($_REQUEST['todt']);
						$string.= " and ci.tc_dayclosedate between '".$from."' and '".$to."'";
					}
					
					
				
				
	else 
	{
		
		$bydatz=$_REQUEST['bydate'];
		
		
		
			if($bydatz!="null" && $bydatz!="")
			{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.=" and ci.tc_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($bydatz=="Last10days")
	{
		$string.=" and ci.tc_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.=" and ci.tc_dayclosedate  = CURDATE() - INTERVAL 1 day";
			  }
	elseif($bydatz=="Last15days")
	{
		$string.=" and ci.tc_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" and ci.tc_dayclosedate between  CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last25days")
	{
		$string.=" and ci.tc_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last30days")
	{
		$string.=" and ci.tc_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	 else if($bydatz=="Last1month")
			  {
				  $string.=" and ci.tc_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
	else if($bydatz=="Today")
	{
		$string.=" and ci.tc_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
else if($bydatz=="Last90days")
	{
		$string.=" and ci.tc_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last180days")
	{
		$string.=" and ci.tc_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last365days")
	{
		$string.="and  ci.tc_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}
	}
else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " and  ci.tc_dayclosedate between '".$from."' and '".$to."' ";
	}
		
	
	
	}
	
	
	
	$sql_login1  =  $database->mysqlQuery("select ci.*,sm.ser_firstname, mm.mr_menuname,tbm.tab_billno  FROM tbl_takeaway_cancel_items ci
                                        left join tbl_takeaway_billmaster tbm on tbm.tab_billno = ci.tc_billno
                                        left join tbl_takeaway_billdetails tbd on tbd.tab_billno = ci.tc_billno and ci.tc_bill_slno=tbd.tab_slno
                                        left join tbl_menumaster mm on  mm.mr_menuid = tbd.tab_menuid
                                        left join tbl_staffmaster sm ON sm.ser_staffid = ci.tc_cancelled_by                                        
                                        where $string order by tbm.tab_billno ASC " ); 

		
	  $num_login   = $database->mysqlNumRows($sql_login1);
		
	  if($num_login)
	  {
	echo "ok";
	  }else
	  {
echo  "sorry";
	  }
	  
	

}
else if(($_REQUEST['type'] == "categorywise_report_cs"))
{	$string="";
	$string.=" tbm.tab_status = 'Closed' and tbm.tab_mode='CS'";
				
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
		    $from=$database->convert_date($_REQUEST['fromdt']);
		    $to=$database->convert_date($_REQUEST['todt']);
		    $string.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."'  ";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
                     $from=$database->convert_date($_REQUEST['fromdt']);
		     $to=date("Y-m-d");
		     $string.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
		}
                else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
                {
                     $from=date("Y-m-d");
                     $to=$database->convert_date($_REQUEST['todt']);
                     $string.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."'  ";
                }
					
					
            
	else 
	{
                $bydatz=$_REQUEST['bydate'];
                if($bydatz!="null" && $bydatz!="")
		{
	
                if($bydatz=="Last5days")
                {
                    $string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                }
                elseif($bydatz=="Last10days")
                {
                    $string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                }
                else if($bydatz=="Yesterday")
                {
                    $string.=" and tbm.tab_dayclosedate = CURDATE() - INTERVAL 1 day";
                }
                elseif($bydatz=="Last15days")
                {
                    $string.="  and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                }
                else if($bydatz=="Last20days")
                {
                    $string.=" and  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                }
                else if($bydatz=="Last25days")
                {
                    $string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                }
                else if($bydatz=="Last30days")
                {
                    $string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                }
                else if($bydatz=="Last1month")
                {
                    $string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                }
                else if($bydatz=="Today")
                {
                    $string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                }
                else if($bydatz=="Last90days")
                {
                    $string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
                }
                else if($bydatz=="Last180days")
                {
                    $string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
                }
                else if($bydatz=="Last365days")
                {
                    $string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
                }
                }
                else
                {
		$from=date("Y-m-d");
	        $to=date("Y-m-d");
	        $string.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
                }
	}
        
      $sql_login  =  $database->mysqlQuery("SELECT mc.mmy_maincategoryname,count(distinct(tbd.tab_menuid)) as 'no of items',sum(tbd.tab_qty) as qty ,sum(tbd.tab_qty* tbd.tab_rate) as Total from tbl_takeaway_billmaster tbm left join tbl_takeaway_billdetails tbd on tbd.tab_billno = tbm.tab_billno left join tbl_menumaster on mr_menuid =tbd.tab_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = mr_maincatid where $string group by mr_maincatid ORDER BY mr_maincatid ASC ");
      //echo"SELECT mc.mmy_maincategoryname,count(distinct(tbd.tab_menuid)) as 'no of items',sum(tbd.tab_qty) as qty ,sum(tbd.tab_qty* tbd.tab_rate) as Total from tbl_takeaway_billmaster tbm left join tbl_takeaway_billdetails tbd on tbd.tab_billno = tbm.tab_billno left join tbl_menumaster on mr_menuid =tbd.tab_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = mr_maincatid where $string group by mr_maincatid ORDER BY mr_maincatid ASC ";
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