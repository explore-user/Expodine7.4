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

if(($_REQUEST['type']=="sales_summary_report_cr"))
{
	$string="";
	$string=" bm_status='Closed' AND ";
	$stringta="";
	$stringta=" tab_status='Closed' AND ";

		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
                        $stringta.= " tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
                        $stringta.= " tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
                        $stringta.= " tab_dayclosedate between '".$from."' and '".$to."' order tab bm_dayclosedate";
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
                $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 5 
                    
DAY AND CURDATE( )";
                
	}elseif($bydatz=="Last10days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
                $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.="bm_dayclosedate = CURDATE() - INTERVAL 1 day";
                                    $stringta.="tab_dayclosedate = CURDATE() - INTERVAL 1 day";
			  }
	elseif($bydatz=="Last15days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last25days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
                $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last30days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
                $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	 else if($bydatz=="Last1month")
			  {
				  $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                                   $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
	else if($bydatz=="Today")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
else if($bydatz=="Last90days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
                $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last180days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
                $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last365days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
                $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}

	}
	else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.= "tab_dayclosedate between '".$from."' and '".$to."' ";
	}
		
	
	}
	
	
	
	
	
  $sql_login  =  $database->mysqlQuery("select bm_billno from tbl_tablebillmaster where $string"); 
//echo "select * from tbl_tablebillmaster where $string";
  
	  $num_login   = $database->mysqlNumRows($sql_login);
	$sql_loginta  =  $database->mysqlQuery("select tab_billno from tbl_takeaway_billmaster where $stringta"); 

  
	  $num_loginta   = $database->mysqlNumRows($sql_loginta);
	  if($num_login || $num_loginta)
	  {
			echo "ok";
	  }else
	  {
		  echo "sorry";
	  }

}
else if(($_REQUEST['type']=="stock_daywise_report"))
{
    
    	
	$string="";

		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " ts_dayclose between '".$from."' and '".$to."' ";
                       
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " ts_dayclose between '".$from."' and '".$to."' ";
                        
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " ts_dayclose between '".$from."' and '".$to."' ";
                        
		}

	
	else 
	{
		
		$bydatz=$_REQUEST['bydate'];
		
		
		
	if($bydatz!="null" && $bydatz!="")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.=" ts_dayclose between CURDATE( ) - INTERVAL 5 
                    
DAY AND CURDATE( )";
               
                
	}elseif($bydatz=="Last10days")
	{
		$string.=" ts_dayclose between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
                
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.=" ts_dayclose = CURDATE() - INTERVAL 1 day";
                                   
			  }
	elseif($bydatz=="Last15days")
	{
		$string.=" ts_dayclose between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
                
	}
	else if($bydatz=="Last20days")
	{
		$string.=" ts_dayclose between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
               
	}
	else if($bydatz=="Last25days")
	{
		$string.="ts_dayclose between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
               
	}
	else if($bydatz=="Last30days")
	{
		$string.="ts_dayclose between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
                
	}
	 else if($bydatz=="Last1month")
			  {
				  $string.="ts_dayclose between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                                 
			  }
	else if($bydatz=="Today")
	{
		$string.="ts_dayclose between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                
	}
else if($bydatz=="Last90days")
	{
		$string.="ts_dayclose between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
               
	}
else if($bydatz=="Last180days")
	{
		$string.="ts_dayclose between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
                
	}
else if($bydatz=="Last365days")
	{
		$string.="ts_dayclose between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
               
	}

	}
	else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "ts_dayclose between '".$from."' and '".$to."' ";
                       
	}
		
	
	}
	
	
	
	
	
  $sql_login  =  $database->mysqlQuery("select ts_id from tbl_daily_stock_detail where $string"); 
  
	  $num_login   = $database->mysqlNumRows($sql_login);
	
	  if($num_login)
	  {
			echo "ok";
	  }else
	  {
		  echo "sorry";
	  }

}
else if(($_REQUEST['type']=="expense_acc_report"))
{
    
    	
	$string="";
        $stringev="";
        $stringsu="";

		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " ev_date between '".$from."' and '".$to."' ";
                        
                        $stringev.= " ev_date between '".$from."' and '".$to."' ";
                        $stringsu.= " sv_date between '".$from."' and '".$to."' ";
                       
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " ev_date between '".$from."' and '".$to."' ";
                        
                        $stringev.= " ev_date between '".$from."' and '".$to."' ";
                        $stringsu.= " sv_date between '".$from."' and '".$to."' ";
                        
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " ev_date between '".$from."' and '".$to."' ";
                        $stringev.= " ev_date between '".$from."' and '".$to."' ";
                        $stringsu.= " sv_date between '".$from."' and '".$to."' ";
		}

	
	else 
	{
		
		$bydatz=$_REQUEST['bydate'];
		
		
		
	if($bydatz!="null" && $bydatz!="")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.=" ev_date between CURDATE( ) - INTERVAL 5 
                    
DAY AND CURDATE( )";
                
                $stringev.=" ev_date between CURDATE( ) - INTERVAL 5 
                    
DAY AND CURDATE( )";
                
                $stringsu.=" sv_date between CURDATE( ) - INTERVAL 5 
                    
DAY AND CURDATE( )";
               
                
	}elseif($bydatz=="Last10days")
	{
		$string.=" ev_date between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
                
                $stringev.=" ev_date between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
                
                
                $stringsu.=" ev_date between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
                
                
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.=" ev_date = CURDATE() - INTERVAL 1 day";
                                   $stringev.=" ev_date = CURDATE() - INTERVAL 1 day";
                                    $stringsu.=" sv_date = CURDATE() - INTERVAL 1 day";
                                   
			  }
	elseif($bydatz=="Last15days")
	{
		$string.=" ev_date between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
                $stringev.=" ev_date between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
                $stringsu.=" sv_date between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
                
	}
	else if($bydatz=="Last20days")
	{
		$string.=" ev_date between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
                
                $stringev.=" ev_date between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
                
                $stringsu.=" sv_date between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
               
	}
	else if($bydatz=="Last25days")
	{
		$string.="ev_date between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
                $stringev.="ev_date between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
                $stringsu.="sv_date between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
               
	}
	else if($bydatz=="Last30days")
	{
		$string.="ev_date between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
                $stringev.="ev_date between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
                $stringsu.="sv_date between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
                
	}
	 else if($bydatz=="Last1month")
			  {
				  $string.="ev_date between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                                  $stringev.="ev_date between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                                  $stringsu.=" sv_date between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                                 
			  }
	else if($bydatz=="Today")
	{
		$string.="ev_date between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                $stringev.="ev_date between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                $stringsu.="sv_date between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                
                
                
	}
else if($bydatz=="Last90days")
	{
		$string.="ev_date between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
                $stringev.="ev_date between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
               $stringsu.="sv_date between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last180days")
	{
		$string.="ev_date between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
                $stringev.="ev_date between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
                $stringsu.="sv_date between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
                
	}
else if($bydatz=="Last365days")
	{
		$string.="ev_date between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
                $stringev.="ev_date between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
                $stringsu.="sv_date between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
               
	}

	}
	else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "ev_date between '".$from."' and '".$to."' ";
                        $stringev.= "ev_date between '".$from."' and '".$to."' ";
                        $stringsu.= "sv_date between '".$from."' and '".$to."' ";
                       
	}
		
	
	}
	
	
	
	
	
  $sql_loginex  =  $database->mysqlQuery("select ev_id from tbl_expense_voucher where $string");   
  $num_loginex   = $database->mysqlNumRows($sql_loginex);

    $sql_loginev  =  $database->mysqlQuery("select tab_billno from tbl_takeaway_billmaster where $stringev"); 
	$num_loginev   = $database->mysqlNumRows($sql_loginev); 
                
    $sql_loginsu  =  $database->mysqlQuery("select tab_billno from tbl_takeaway_billmaster where $stringsu"); 
	$num_loginsu   = $database->mysqlNumRows($sql_loginsu); 
          
	  if($num_login || $num_loginev || $num_loginsu )
	  {
			echo "ok";
	  }else
	  {
		  echo "sorry";
	  }

}
else if(($_REQUEST['type']=="summary_report_cr"))
{   	
	$string="";
	$string=" bm_status='Closed' AND ";
	$stringta="";
	$stringta=" tab_status='Closed' AND ";
        
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
                        $stringta.= " tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
                        $stringta.= " tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
                        $stringta.= " tab_dayclosedate between '".$from."' and '".$to."' order tab bm_dayclosedate";
		}
	else 
	{	
		$bydatz=$_REQUEST['bydate'];
		
	if($bydatz!="null" && $bydatz!="")
	{
	
	if($bydatz=="Last5days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 5 
                    
DAY AND CURDATE( )";
                $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 5 
                    
DAY AND CURDATE( )";
                
	}elseif($bydatz=="Last10days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
                $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.="bm_dayclosedate = CURDATE() - INTERVAL 1 day";
                                    $stringta.="tab_dayclosedate = CURDATE() - INTERVAL 1 day";
			  }
	elseif($bydatz=="Last15days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last25days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
                $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last30days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
                $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	 else if($bydatz=="Last1month")
			  {
				  $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                                   $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
	else if($bydatz=="Today")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
else if($bydatz=="Last90days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
                $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last180days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
                $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last365days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
                $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}

	}
	else
	{
		$from=date("Y-m-d");
		$to=date("Y-m-d");
		$string.= "bm_dayclosedate between '".$from."' and '".$to."' ";
        $stringta.= "tab_dayclosedate between '".$from."' and '".$to."' ";
	}
	
	}

  $sql_login  =  $database->mysqlQuery("select bm_billno from tbl_tablebillmaster where $string");   
  $num_login   = $database->mysqlNumRows($sql_login);

  $sql_loginta  =  $database->mysqlQuery("select tab_billno from tbl_takeaway_billmaster where $stringta"); 
  $num_loginta   = $database->mysqlNumRows($sql_loginta);
	  if($num_login || $num_loginta)
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
		
	if($bydatz=="Last5days")
	{
		$string.=" date(lr.ly_entrydatetime) between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";

$st="Last 5 days";
	}elseif($bydatz=="Last10days")
	{
		$string.=" date(lr.ly_entrydatetime) between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
$st="Last 10 days";

	}
	elseif($bydatz=="Last15days")
	{
		$string.=" date(lr.ly_entrydatetime) between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
$st="Last 15 days";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" date(lr.ly_entrydatetime) between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
$st="Last 20 days";
	}
	else if($bydatz=="Last25days")
	{
		$string.=" date(lr.ly_entrydatetime) between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
$st="Last 25 days";

	}
	else if($bydatz=="Last30days")
	{
		$string.=" date(lr.ly_entrydatetime) between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
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
		$string.="  date(lr.ly_entrydatetime) between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
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

	
    

  $sql_login  =  $database->mysqlQuery("select ly_id from tbl_loyalty_reg as lr where $string order by lr.ly_entrydatetime ASC"); 

	  $num_login   = $database->mysqlNumRows($sql_login);

 if($num_login)
	  {
			echo "ok";
	  }else
	  {
		  echo "sorry";
	  }
}
else if(($_REQUEST['type']=="advance_payment_cr"))
{	
	$string="";
	
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " tp_dayclose between '".$from."' and '".$to."' order by bm_dayclosedate";
                       
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " tp_dayclose between '".$from."' and '".$to."' order by bm_dayclosedate";
                        
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " tp_dayclose between '".$from."' and '".$to."' order by bm_dayclosedate";
                       
		}
	
	else 
	{
		
		$bydatz=$_REQUEST['bydate'];
		
	if($bydatz!="null" && $bydatz!="")
	{
	
	if($bydatz=="Last5days")
	{
		$string.="tp_dayclose between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
               
                
	}elseif($bydatz=="Last10days")
	{
		$string.="tp_dayclose between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.="tp_dayclose = CURDATE() - INTERVAL 1 day";                     
			  }
	elseif($bydatz=="Last15days")
	{
		$string.=" tp_dayclose between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                
	}
	else if($bydatz=="Last20days")
	{
		$string.=" tp_dayclose between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                
	}
	else if($bydatz=="Last25days")
	{
		$string.="tp_dayclose between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
               
	}
	else if($bydatz=="Last30days")
	{
		$string.="tp_dayclose between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
               
	}
	 else if($bydatz=="Last1month")
			  {
				  $string.="tp_dayclose between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                                  
			  }
	else if($bydatz=="Today")
	{
		$string.="tp_dayclose between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
               
	}
else if($bydatz=="Last90days")
	{
		$string.="tp_dayclose between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
                
	}
else if($bydatz=="Last180days")
	{
		$string.="tp_dayclose between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
                
	}
else if($bydatz=="Last365days")
	{
		$string.="tp_dayclose between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";             
	}
	}
	else
	{	
		$from=date("Y-m-d");
		$to=date("Y-m-d");
		$string.= "tp_dayclose between '".$from."' and '".$to."' ";                  
	}
	}
	
	
  $sql_login  =  $database->mysqlQuery("select tp_id from tbl_advance_payment where $string"); 
  $num_login   = $database->mysqlNumRows($sql_login);
	
	  $num_loginta   = $database->mysqlNumRows($sql_loginta);
	  if($num_login )
	  {
			echo "ok";
	  }else
	  {
		  echo "sorry";
	  }

}
else if(($_REQUEST['type']=="billwise_item_cr"))
{
     
    	
	$string="";
	$string=" bm_status='Closed' AND ";
	$stringta="";
	$stringta=" tab_status='Closed' AND ";
    
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
                        $stringta.= " tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
                        $stringta.= " tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
            $stringta.= " tab_dayclosedate between '".$from."' and '".$to."' order tab bm_dayclosedate";
		}	
	else 
	{
		$bydatz=$_REQUEST['bydate'];
	
	if($bydatz!="null" && $bydatz!="")
	{
	
	if($bydatz=="Last5days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                
	}elseif($bydatz=="Last10days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
	}
	else if($bydatz=="Yesterday")
			  {
		$string.="bm_dayclosedate = CURDATE() - INTERVAL 1 day";
        $stringta.="tab_dayclosedate = CURDATE() - INTERVAL 1 day";
			  }
	elseif($bydatz=="Last15days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
        $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
        $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
	}
	else if($bydatz=="Last25days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
	}
	else if($bydatz=="Last30days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
         $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
	}
	 else if($bydatz=="Last1month")
		 {
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
    	$stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
	else if($bydatz=="Today")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
else if($bydatz=="Last90days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last180days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last365days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}

	}
	else
	{	
		$from=date("Y-m-d");
		$to=date("Y-m-d");
		$string.= "bm_dayclosedate between '".$from."' and '".$to."' ";
        $stringta.= "tab_dayclosedate between '".$from."' and '".$to."' ";
	}
	}
	
  $sql_login  =  $database->mysqlQuery("select bm_billno from tbl_tablebillmaster where $string"); 
  
	  $num_login   = $database->mysqlNumRows($sql_login);
	$sql_loginta  =  $database->mysqlQuery("select tab_billno from tbl_takeaway_billmaster where $stringta"); 

  
	  $num_loginta   = $database->mysqlNumRows($sql_loginta);
	  if($num_login || $num_loginta)
	  {
			echo "ok";
	  }else
	  {
		  echo "sorry";
	  }

}
else if(($_REQUEST['type']=="bill_cancel_consolidated"))
{   	
	$string="";
	$string=" bm_status='Cancelled' AND ";
	$stringta="";
	$stringta=" tab_status='Cancelled' AND ";
        

		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
            $stringta.= " tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
    		$stringta.= " tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
            $stringta.= " tab_dayclosedate between '".$from."' and '".$to."' order tab bm_dayclosedate";
		}
	
	else 
	{
		
		$bydatz=$_REQUEST['bydate'];
		
	if($bydatz!="null" && $bydatz!="")
	{
		
	if($bydatz=="Last5days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                
	}elseif($bydatz=="Last10days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
	}
	else if($bydatz=="Yesterday")
	{
		$string.="bm_dayclosedate = CURDATE() - INTERVAL 1 day";
        $stringta.="tab_dayclosedate = CURDATE() - INTERVAL 1 day";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
        $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
        $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
	}
	else if($bydatz=="Last25days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
	}
	else if($bydatz=="Last30days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
	}
	 else if($bydatz=="Last1month")
			  {
				$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
	else if($bydatz=="Today")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
else if($bydatz=="Last90days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last180days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last365days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}

	}
	else
	{
		$from=date("Y-m-d");
		$to=date("Y-m-d");
		$string.= "bm_dayclosedate between '".$from."' and '".$to."' ";
        $stringta.= "tab_dayclosedate between '".$from."' and '".$to."' ";
	}
	}
	
  $sql_login  =  $database->mysqlQuery("select bm_billno from tbl_tablebillmaster where $string"); 
  $num_login   = $database->mysqlNumRows($sql_login);

	$sql_loginta  =  $database->mysqlQuery("select tab_billno from tbl_takeaway_billmaster where $stringta"); 
	  $num_loginta   = $database->mysqlNumRows($sql_loginta);
	  if($num_login || $num_loginta)
	  {
			echo "ok";
	  }else
	  {
		  echo "sorry";
	  }

}
else if(($_REQUEST['type']=="summary_specified_consolidated"))
{	
	$string="";
	$string=" bm_status='Closed' AND ";
	$stringta="";
	$stringta=" tab_status='Closed' AND ";
        
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
    		$stringta.= " tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
            $stringta.= " tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
            $stringta.= " tab_dayclosedate between '".$from."' and '".$to."' order tab bm_dayclosedate";
		}
	
	else 
	{
		$bydatz=$_REQUEST['bydate'];	
	if($bydatz!="null" && $bydatz!="")
	{
	
	if($bydatz=="Last5days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                
	}elseif($bydatz=="Last10days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.="bm_dayclosedate = CURDATE() - INTERVAL 1 day";
                  $stringta.="tab_dayclosedate = CURDATE() - INTERVAL 1 day";
			  }
	elseif($bydatz=="Last15days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
        $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
        $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
	}
	else if($bydatz=="Last25days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
	}
	else if($bydatz=="Last30days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
	}
	 else if($bydatz=="Last1month")
			  {
				  $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                  $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
	else if($bydatz=="Today")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
else if($bydatz=="Last90days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last180days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last365days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}

	}
	else
	{
		$from=date("Y-m-d");
		$to=date("Y-m-d");
		$string.= "bm_dayclosedate between '".$from."' and '".$to."' ";
        $stringta.= "tab_dayclosedate between '".$from."' and '".$to."' ";
	}
	}
	
  $sql_login  =  $database->mysqlQuery("select bm_billno from tbl_tablebillmaster where $string"); 
  $num_login   = $database->mysqlNumRows($sql_login);
	$sql_loginta  =  $database->mysqlQuery("select tab_billno from tbl_takeaway_billmaster where $stringta"); 
	$num_loginta   = $database->mysqlNumRows($sql_loginta);
	  if($num_login || $num_loginta)
	  {
			echo "ok";
	  }else
	  {
		  echo "sorry";
	  }

}

else if(($_REQUEST['type']=="consolidated_timely_report"))
{
    	
	$string="";
	$string=" bm_status='Closed' AND ";
	$stringta="";
	$stringta=" tab_status='Closed' AND ";
        
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
            $stringta.= " tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
            $stringta.= " tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
            $stringta.= " tab_dayclosedate between '".$from."' and '".$to."' order tab bm_dayclosedate";
		}
	else 
	{
		$bydatz=$_REQUEST['bydate'];
		
	if($bydatz!="null" && $bydatz!="")
	{
	
	if($bydatz=="Last5days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                
	}elseif($bydatz=="Last10days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.="bm_dayclosedate = CURDATE() - INTERVAL 1 day";
                  $stringta.="tab_dayclosedate = CURDATE() - INTERVAL 1 day";
			  }
	elseif($bydatz=="Last15days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
        $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
        $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
	}
	else if($bydatz=="Last25days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
	}
	else if($bydatz=="Last30days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
	}
	 else if($bydatz=="Last1month")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
    	$stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
	}
	else if($bydatz=="Today")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
    	$stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
else if($bydatz=="Last90days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last180days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last365days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}

	}
	else
	{
		$from=date("Y-m-d");
		$to=date("Y-m-d");
		$string.= "bm_dayclosedate between '".$from."' and '".$to."' ";
        $stringta.= "tab_dayclosedate between '".$from."' and '".$to."' ";
	}
	}

  $sql_login  =  $database->mysqlQuery("select bm_billno from tbl_tablebillmaster where $string"); 
  $num_login   = $database->mysqlNumRows($sql_login);

	$sql_loginta  =  $database->mysqlQuery("select tab_billno from tbl_takeaway_billmaster where $stringta"); 
	$num_loginta   = $database->mysqlNumRows($sql_loginta);
	  if($num_login || $num_loginta)
	  {
			echo "ok";
	  }else
	  {
		  echo "sorry";
	  }
}

 else if(($_REQUEST['type']=="voucher_expense"))
        {
        $from="";
        $to='';
        $string='';
        $voucher=$_REQUEST['voucher'];
       
        if($voucher!="")
        {
            $vouchername="  vh_vouchername='".$voucher."' AND ";
        }
        else
        {
          $vouchername="";  
        }
        $voucher1=$_REQUEST['voucher1'];
         if($voucher1!="")
        {
            $vouchertype=" vp_type='".$voucher1."' AND ";
        } 
        else
        {
          $vouchertype="";  
        }
    
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= "  vp_dayclose_date  between '".$from."' and '".$to."' ";
            $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                        
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " vp_dayclose_date between '".$from."' and '".$to."' ";
            $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                        
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " vp_dayclose_date between '".$from."' and '".$to."' ";
            $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
	else
	{ 
		$bydatz=trim($_REQUEST['bydate']);
		$st='';
		  
	if($bydatz!="null" && $bydatz!="")
	{       
	
	if($bydatz=="Last5days")
	{
		$string.=" vp_dayclose_date between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";  
		$st= " Last 5 days ";
		
	}elseif($bydatz=="Last10days")
	{
		$string.=" vp_dayclose_date between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( )";
    	$st= " Last 10 days ";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" vp_dayclose_date between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
        $st= " Last 15 days ";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" vp_dayclose_date between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
        $st= " Last 20 days ";
	}
	else if($bydatz=="Last25days")
	{
		$string.=" vp_dayclose_date between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
		$st= " Last 25 days ";
	}
	else if($bydatz=="Last30days")
	{
		$string.=" vp_dayclose_date between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
		$st= " Last 30 days ";
	}
	else if($bydatz=="Today")
	{
		$string.=" vp_dayclose_date between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
		$st= " Today ";
	}
	else if($bydatz=="Yesterday")
	{
		$string.=" vp_dayclose_date = CURDATE() - INTERVAL 1 day";
        $st= " Yesterday ";
	}
	else if($bydatz=="Last1month")
	{
		$string.="  vp_dayclose_date between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
		$st= " Last 1 month ";
	}
	else if($bydatz=="Last90days")
	{
		$string.=" vp_dayclose_date between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
		$st= " Last 3 months ";
	}
	else if($bydatz=="Last180days")
	{
		$string.=" vp_dayclose_date between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
		$st= " Last 6 months "; 
	}
	else if($bydatz=="Last365days")
	{
		$string.=" vp_dayclose_date between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
		$st= " Last 1 year "; 
	}
$reporthead=$st;
	}
	else
	{ 
	$from=date("Y-m-d");
	$to=date("Y-m-d");
	$string.= " vp_dayclose_date between '".$from."' and '".$to."' ";
	$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	

	}
	
	}
        $sql_login  =  $database->mysqlQuery("select vp_id from tbl_voucherpayment left join tbl_voucherhead on vh_id=vp_vhid left join tbl_branchmaster on be_branchid=vp_branchid left join tbl_staffmaster on ser_staffid=vp_approvedby where vp_status='Approved' and  $vouchername $vouchertype  $string ");
                  
        $num_login   = $database->mysqlNumRows($sql_login);
    	if($num_login)
	  {
			echo "ok";
	  }else
	  {
		  echo "sorry";
	  }
        }
   
  else if(($_REQUEST['type']=="daily_sales_statement_cr"))
{       
	
        $string="";
        $stringvoucher="";
        $strings="";
        $stringtacshd="";
        $stringstacshd="";
	$reporthead="";
	$strings=" bm_status='Closed' AND ";
        $stringstacshd=" tab_status='Closed' AND ";
	$string1_str=" (sum(bm_amountpaid) - (sum(bm_amountbalace) + sum(bm_roundoff_value))) ";
        $string1_strtacshd=" (sum(tab_amountpaid) - (sum(tab_amountbalace) + sum(tab_roundoff_value))) ";
        $string2_str=" sum(bm_transactionamount) ";
	$string3_str=" sum(bm_finaltotal) ";
        $string3_strtacshd=" sum(tab_netamt) ";
	$string4_str=" sum(bm_finaltotal) ";
	$string5_str=" sum(bm_finaltotal) ";
	$string6_str=" sum(bm_finaltotal)";
	$string7_str=" sum(bm_finaltotal)";
	$string_pax="";
	$string_pax=" bm_status='Closed' AND ";
	$string1 =$strings. " pym_code='cash'  AND ";//bm_paymode='cash' AND//"cash"//(bm_transactionamount ='' or bm_transactionamount IS NULL) and (bm_couponcompany ='' or bm_couponcompany IS NULL) and bm_voucherid IS NULL and bm_couponamt ='0.00' and  (bm_chequeno ='' or bm_chequeno IS NULL) and (bm_chequebankname='' or bm_chequebankname IS NULL)
	//$string1 =$strings. " ((pym_code='cash') or (pym_code='credit') or (pym_code='coupon') or (pym_code='voucher') or (pym_code='cheque') or (pym_code='credit_person') or (pym_code='complimentary')   ) AND ";
	$string1tacshd=$stringstacshd. " pym_code='cash' AND ";	
		
		
	$string2 =$strings." pym_code='credit'  AND";//bm_paymode='credit' AND//"credit"  bm_transactionamount <>''
	$string2tacshd =$stringstacshd." pym_code='credit'  AND";
        $string3 =$strings. " pym_code='coupon'  AND";
        $string3tacshd =$stringstacshd. " pym_code='coupon'  AND";//"coupons"  bm_couponcompany <>''  and bm_couponamt <>'0.00'
	$string4 =$strings. " pym_code='voucher' AND";
        $string4tacshd =$stringstacshd. " pym_code='voucher' AND";//"voucher" bm_voucherid <>''
	$string5 =$strings. " pym_code='cheque' AND";//"cheque" bm_chequeno <>'' and bm_chequebankname<>''
	$string5tacshd =$stringstacshd. " pym_code='cheque' AND";
        $string6=$strings. " pym_code='credit_person' AND ";
        $string6tacshd=$stringstacshd. " pym_code='credit_person' AND ";
	$string7=$strings. " pym_code='complimentary' AND";
        $string7tacshd=$stringstacshd. " pym_code='complimentary' AND";
		
		if($_REQUEST['date']!="")
		{
			$date=$database->convert_date($_REQUEST['date']);
			//$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate='".$date."'";
                        $stringvoucher.= "  CAST(vp_date AS DATE) ='".$date."'";

                        //$string_pax.= "(bm_dayclosedate  between '".$from."' and '".$to."' ) ";
                        $stringtacshd.=" tab_dayclosedate='".$date."'";
                         
		
                        
                }
	
  $final=0;
  $paid=0;
  $bal=0;
  $dsc=0;
  $srvtx=0;
  $subtotal=0;
  $subtotal1=0;
  $subtotalcash=0;
  $subtotalcashta=0;
  $totalcash=0;
  $subtotalcredit=0;
    $subtotalcreditta=0;
    $totalcredit=0;
    $totalcoupon=0;
    $subtotalcoupon=0;
    $subtotalcouponta=0;
    $totalvoucher=0;
    $subtotalvoucher=0;
    $subtotalvoucherta=0;
    $totalcheque=0;
    $subtotalcheque=0;
    $subtotalchequeta=0;
    $totalcp=0;
    $subtotalcp=0;
    $subtotalcpta=0;
    $totalcomp=0;
    $subtotalcomp=0;
    $subtotalcompta=0;
    $finaltotal=0;




          $sql_logincashdi  =  $database->mysqlQuery("select $string1_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string1"."$string order by bm_dayclosedate,bm_billtime ASC"); 
         
	  $num_logincashdi   = $database->mysqlNumRows($sql_logincashdi);
	 
          $sql_logincashta  =  $database->mysqlQuery("select $string1_strtacshd as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $string1tacshd"."$stringtacshd order by tab_dayclosedate,tab_time ASC"); 
         
	  $num_logincashta   = $database->mysqlNumRows($sql_logincashta);
	   
        
 

	 $sql_logincredit  =  $database->mysqlQuery("select bm_name as bank_name, (sum(bm_transactionamount)) as tot from tbl_tablebillmaster tb left join tbl_paymentmode on tb.bm_paymode=tbl_paymentmode.pym_id  , tbl_bankmaster b  where  b.bm_id = tb.bm_transcbank and tb.bm_status='Closed' AND $string2 "."$string group by b.bm_name order by tb.bm_dayclosedate,tb.bm_billtime ASC "); 
	
         $num_logincredit   = $database->mysqlNumRows($sql_logincredit);
	  
          
           $sql_logincreditta  =  $database->mysqlQuery("select bm_name as bank_name, (sum(tab_transactionamount)) as tot from tbl_takeaway_billmaster tbm left join tbl_paymentmode on tbm.tab_paymode=tbl_paymentmode.pym_id  , tbl_bankmaster b  where  b.bm_id = tbm.tab_transcbank and  $string2tacshd "."$stringtacshd group by b.bm_name order by tbm.tab_dayclosedate,tbm.tab_time ASC "); 
          
           $num_logincreditta   = $database->mysqlNumRows($sql_logincreditta);
	  
      		
            $sql_logincoupon  =  $database->mysqlQuery("select $string3_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string3"." $string order by bm_dayclosedate,bm_billtime ASC"); 
           
            $num_logincoupon   = $database->mysqlNumRows($sql_logincoupon);

          $sql_logincouponta  =  $database->mysqlQuery("select $string3_strtacshd as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $string3tacshd"." $stringtacshd order by tab_dayclosedate,tab_time ASC"); 
         
          $num_logincouponta   = $database->mysqlNumRows($sql_logincouponta);

	
		$sql_loginvoucher  =  $database->mysqlQuery("select $string4_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string4"." $string order by bm_dayclosedate,bm_billtime ASC"); 
		
        $num_loginvoucher   = $database->mysqlNumRows($sql_loginvoucher);
                                
        $sql_loginvoucherta  =  $database->mysqlQuery("select $string3_strtacshd as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $string4tacshd"." $stringtacshd order by tab_dayclosedate,tab_time ASC"); 
		$num_loginvoucherta   = $database->mysqlNumRows($sql_loginvoucherta);
                     
            	
            $sql_logincheque  =  $database->mysqlQuery("select $string5_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string5"." $string order by bm_dayclosedate,bm_billtime ASC"); 
          	$num_logincheque   = $database->mysqlNumRows($sql_logincheque);
	  
                        
               $sql_loginchequeta  =  $database->mysqlQuery("select $string3_strtacshd as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $string5tacshd"." $stringtacshd order by tab_dayclosedate,tab_time ASC"); 
              $num_loginchequeta   = $database->mysqlNumRows($sql_loginchequeta);
	               
     
            $sql_logincp  =  $database->mysqlQuery("select $string6_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string6"." $string order by bm_dayclosedate,bm_billtime ASC"); 
		    $num_logincp   = $database->mysqlNumRows($sql_logincp);
	  
          
           $sql_logincpta  =  $database->mysqlQuery("select $string3_strtacshd as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $string6tacshd"." $stringtacshd order by tab_dayclosedate,tab_time ASC"); 
           $num_logincpta   = $database->mysqlNumRows($sql_logincpta);
	   
       	
          $sql_logincomp  =  $database->mysqlQuery("select $string7_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string7"." $string order by bm_dayclosedate,bm_billtime ASC"); 
          $num_logincomp   = $database->mysqlNumRows($sql_logincomp);
	  
             $sql_logincompta  =  $database->mysqlQuery("select $string3_strtacshd as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $string7tacshd"." $stringtacshd order by tab_dayclosedate,tab_time ASC"); 
            echo "select $string3_strtacshd as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $string7tacshd"." $stringtacshd order by tab_dayclosedate,tab_time ASC";
            $num_logincompta   = $database->mysqlNumRows($sql_logincompta);
	  
            $totalcomp= $subtotalcomp+$subtotalcompta;      
              
                   $sql_loginvoucherexpence  =  $database->mysqlQuery("select vp_id from tbl_voucherpayment left join tbl_voucherhead on vh_id=vp_vhid left join tbl_branchmaster on be_branchid=vp_branchid left join tbl_staffmaster on ser_staffid=vp_approvedby where $stringvoucher");
                   $num_loginvoucherexpence   = $database->mysqlNumRows($sql_loginvoucherexpence);
                

      if($num_logincashdi||$num_logincashta||$num_logincredit||$num_logincreditta||$num_logincoupon||$num_logincouponta
         ||$num_loginvoucher||$num_loginvoucherta||$num_logincheque||$num_loginchequeta||$num_logincp||$num_logincpta||$num_logincomp||$num_logincompta||$num_loginvoucherexpence)
                 {       
                echo "ok"; 
            }                 
            else
            {
                echo "sorry";
            }
            
}         
    else if(($_REQUEST['type']=="total_summary_details_cr"))
        {
	$string="";
	$string=" bm_status='Closed' AND ";
    $stringta="";
	$stringta=" tab_status='Closed' AND ";
	
	
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
        	$stringta.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
            $stringta.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
            $stringta.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
		}
	else 
	{
		$bydatz=$_REQUEST['bydate'];

	if($bydatz!="null" && $bydatz!="")
	{
	
	if($bydatz=="Last5days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
	}
        elseif($bydatz=="Last10days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.="bm_dayclosedate = CURDATE() - INTERVAL 1 day";
                  $stringta.="tab_dayclosedate = CURDATE( ) - INTERVAL 1 DAY";
			  }
	elseif($bydatz=="Last15days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
	}
	else if($bydatz=="Last25days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
	}
	else if($bydatz=="Last30days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
	}
	 else if($bydatz=="Last1month")
			  {
				  $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                  $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
			  }
	else if($bydatz=="Today")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
    	$stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
	}
else if($bydatz=="Last90days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
	}
else if($bydatz=="Last180days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
	}
else if($bydatz=="Last365days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
	}
	}
	else
	{
			$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "bm_dayclosedate between '".$from."' and '".$to."' ";
            $stringta.= "tab_dayclosedate between '".$from."' and '".$to."' ";
	}
	}
	
      $sql_login  =  $database->mysqlQuery("select bm_billno from tbl_tablebillmaster where $string"); 
  	  $num_login   = $database->mysqlNumRows($sql_login);
          
      $sql_loginta  =  $database->mysqlQuery("select tab_billno from tbl_takeaway_billmaster where $stringta"); 
  	  $num_loginta   = $database->mysqlNumRows($sql_loginta);
	
	  if($num_login||$num_loginta)
	  {
			echo "ok";
	  }else
	  {
		  echo "sorry";
	  }

}

 else if(($_REQUEST['type']=="totalsales_consolidate_report_cr"))
        { 
	
	$string=""; 
	$string=" bm_status='Closed' AND ";
    $stringta="";
	$stringta=" tab_status='Closed' AND ";
	
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
            $stringta.= " tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
            $stringta.= " tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
            $stringta.= " tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
		}
	else 
	{
		$bydatz=$_REQUEST['bydate'];
			
	if($bydatz!="null" && $bydatz!="")
	{
	
	if($bydatz=="Last5days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
	}
        elseif($bydatz=="Last10days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.="bm_dayclosedate = CURDATE() - INTERVAL 1 day";
                  $stringta.="tab_dayclosedate = CURDATE( ) - INTERVAL 1 DAY";
			  }
	elseif($bydatz=="Last15days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
	}
	else if($bydatz=="Last25days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
	}
	else if($bydatz=="Last30days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
	}
	 else if($bydatz=="Last1month")
			  {
				  $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                  $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
			  }
	else if($bydatz=="Today")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
	}
else if($bydatz=="Last90days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
	}
else if($bydatz=="Last180days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
	}
else if($bydatz=="Last365days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
	}

	}
	else
	{
		$from=date("Y-m-d");
		$to=date("Y-m-d");
		$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
        $stringta.= " tab_dayclosedate between '".$from."' and '".$to."' ";
	}	
	}
	
      $sql_login  =  $database->mysqlQuery("select bm_billno from tbl_tablebillmaster where $string"); 
  	  $num_login   = $database->mysqlNumRows($sql_login);
          
          $sql_loginta  =  $database->mysqlQuery("select tab_billno from tbl_takeaway_billmaster where $stringta"); 
      
  	  $num_loginta   = $database->mysqlNumRows($sql_loginta);
	
	  if($num_login||$num_loginta)
	  {
			echo "ok";
	  }else
	  {
		  echo "sorry";
	  }

}
else if(($_REQUEST['type']=="staff_change_log_report"))
        {
	           $string="";

		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " date(date_time) between '".$from."' and '".$to."' ";      
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= "  date(date_time) between '".$from."' and '".$to."' ";                
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= "  date(date_time) between '".$from."' and '".$to."' ";             
		}
	else 
	{
		$bydatz=$_REQUEST['bydate'];

	if($bydatz!="null" && $bydatz!="")
	{

	if($bydatz=="Last5days")
	{
		$string.=" date(date_time) between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
              
	}
        elseif($bydatz=="Last10days")
	{
		$string.=" date(date_time) between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
               
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.=" date(date_time) = CURDATE() - INTERVAL 1 day";
                                 
			  }
	elseif($bydatz=="Last15days")
	{
		$string.=" date(date_time) between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                
	}
	else if($bydatz=="Last20days")
	{
		$string.=" date(date_time) between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
               
	}
	else if($bydatz=="Last25days")
	{
		$string.=" date(date_time) between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
               
	}
	else if($bydatz=="Last30days")
	{
		$string.=" date(date_time) between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";       
	}
	 else if($bydatz=="Last1month")
	{
		$string.=" date(date_time) between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";                             
	}
	else if($bydatz=="Today")
	{
		$string.=" date(date_time) between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";           
	}
else if($bydatz=="Last90days")
	{
		$string.=" date(date_time) between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";           
	}
else if($bydatz=="Last180days")
	{
		$string.=" date(date_time) between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";            
	}
else if($bydatz=="Last365days")
	{
		$string.=" date(date_time) between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";        
	}

	}
	else
	{
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " date(date_time) between '".$from."' and '".$to."' ";                  
	}
	}
	
     $sql_login  =  $database->mysqlQuery("select id from tbl_staffmaster_logs where $string"); 
  	  $num_login   = $database->mysqlNumRows($sql_login);
               
	  if($num_login)
	  {
			echo "ok";
	  }else
	  {
		  echo "sorry";
	  }

}

    else if(($_REQUEST['type']=="tax_report"))
        {
	
	$string="";
	$string=" bm_status='Closed' AND ";
    $stringta="";
	$stringta=" tab_status='Closed' AND ";
	
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
            $stringta.= " tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
            $stringta.= " tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
            $stringta.= " tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
		}
	else 
	{
		
		$bydatz=$_REQUEST['bydate'];
	
	if($bydatz!="null" && $bydatz!="")
	{
	
	if($bydatz=="Last5days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
	}
        elseif($bydatz=="Last10days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.="bm_dayclosedate = CURDATE() - INTERVAL 1 day ";
                  $stringta.="tab_dayclosedate = CURDATE( ) - INTERVAL 1 DAY ";
			  }
	elseif($bydatz=="Last15days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
	}
	else if($bydatz=="Last25days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
	}
	else if($bydatz=="Last30days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
	}
	 else if($bydatz=="Last1month")
			  {
				  $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                  $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
			  }
	else if($bydatz=="Today")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
	}
else if($bydatz=="Last90days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
	}
else if($bydatz=="Last180days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
	}
else if($bydatz=="Last365days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
	}

	}
	else
	{
		    $from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "bm_dayclosedate between '".$from."' and '".$to."' ";
            $stringta.= "tab_dayclosedate between '".$from."' and '".$to."' ";
	}
		
	}
	
	
     $sql_login  =  $database->mysqlQuery("select bm_billno from tbl_tablebillmaster where $string"); 
  	  $num_login   = $database->mysqlNumRows($sql_login);
          
          $sql_loginta  =  $database->mysqlQuery("select tab_billno from tbl_takeaway_billmaster where $stringta"); 
        
  	  $num_loginta   = $database->mysqlNumRows($sql_loginta);
	
	  if($num_login||$num_loginta)
	  {
			echo "ok";
	  }else
	  {
		  echo "sorry";
	  }
}
else if(($_REQUEST['type']=="counter_shift_cr"))
        {
	
	$string="";
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " sd_day between '".$from."' and '".$to."' order by sd_day";
                       
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " sd_day between '".$from."' and '".$to."' order by sd_day";
                      
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " sd_day between '".$from."' and '".$to."' order by sd_day";
                        
		}
	
	
	else 
	{
		
		$bydatz=$_REQUEST['bydate'];
	
	if($bydatz!="null" && $bydatz!="")
	{
	
	if($bydatz=="Last5days")
	{
		$string.="sd_day between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";           
	}
        elseif($bydatz=="Last10days")
	{
		$string.="sd_day between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.="sd_day = CURDATE() - INTERVAL 1 day ";
                                 
			  }
	elseif($bydatz=="Last15days")
	{
		$string.=" sd_day between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
               
	}
	else if($bydatz=="Last20days")
	{
		$string.=" sd_day between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                
	}
	else if($bydatz=="Last25days")
	{
		$string.="sd_day between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
               
	}
	else if($bydatz=="Last30days")
	{
		$string.="sd_day between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
               
	}
	 else if($bydatz=="Last1month")
			  {
				  $string.="sd_day between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                                  
			  }
	else if($bydatz=="Today")
	{
		$string.="sd_day between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
               
	}
else if($bydatz=="Last90days")
	{
		$string.="sd_day between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                
	}
else if($bydatz=="Last180days")
	{
		$string.="sd_day between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
              
	}
else if($bydatz=="Last365days")
	{
		$string.="sd_day between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                
	}

	}
	else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "sd_day between '".$from."' and '".$to."' ";
                       
	}
		
	
	}
	
	
	
	
      $sql_login  =  $database->mysqlQuery("select sd_id from tbl_shift_details where $string"); 
  	  $num_login   = $database->mysqlNumRows($sql_login);
         
	
	  if($num_login)
	  {
		echo "ok";
	  }else
	  {
		  echo "sorry";
	  }

}
  else if(($_REQUEST['type']=="consolidated_shift_report"))
        {
	
	$string="";
	
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " sd_day between '".$from."' and '".$to."' order by sd_day";
                       
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " sd_day between '".$from."' and '".$to."' order by sd_day";
                      
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " sd_day between '".$from."' and '".$to."' order by sd_day";
                        
		}
	
	
	else 
	{
		
		$bydatz=$_REQUEST['bydate'];
	
	if($bydatz!="null" && $bydatz!="")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.="sd_day between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
               
	}
        elseif($bydatz=="Last10days")
	{
		$string.="sd_day between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.="sd_day = CURDATE() - INTERVAL 1 day ";
                                 
			  }
	elseif($bydatz=="Last15days")
	{
		$string.=" sd_day between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
               
	}
	else if($bydatz=="Last20days")
	{
		$string.=" sd_day between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                
	}
	else if($bydatz=="Last25days")
	{
		$string.="sd_day between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
               
	}
	else if($bydatz=="Last30days")
	{
		$string.="sd_day between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
               
	}
	 else if($bydatz=="Last1month")
			  {
				  $string.="sd_day between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                                  
			  }
	else if($bydatz=="Today")
	{
		$string.="sd_day between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
               
	}
else if($bydatz=="Last90days")
	{
		$string.="sd_day between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                
	}
else if($bydatz=="Last180days")
	{
		$string.="sd_day between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
              
	}
else if($bydatz=="Last365days")
	{
		$string.="sd_day between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                
	}

	}
	else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "sd_day between '".$from."' and '".$to."' ";
                       
	}
		
	
	}
	
	
	
	
          $sql_login  =  $database->mysqlQuery("select sd_id from tbl_shift_details where $string"); 
  	  $num_login   = $database->mysqlNumRows($sql_login);
         
	
	  if($num_login)
	  {
		echo "ok";
	  }else
	  {
		  echo "sorry";
	  }

}

  else if(($_REQUEST['type']=="consolidated_payment_cr"))
        {
	
	$string="";
	$stringta="";
		
	if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
		    $from=$database->convert_date($_REQUEST['fromdt']);
		    $to=$database->convert_date($_REQUEST['todt']);
		    $string.= "  bm_dayclosedate between '".$from."' and '".$to."'  ";
            $stringta.= "  tab_dayclosedate between '".$from."' and '".$to."'  ";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
            $from=$database->convert_date($_REQUEST['fromdt']);
		    $to=date("Y-m-d");
		    $string.= "  bm_dayclosedate between '".$from."' and '".$to."'  ";
            $stringta.= "  tab_dayclosedate between '".$from."' and '".$to."'  ";
		}
                else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
                {
                    $from=date("Y-m-d");
                    $to=$database->convert_date($_REQUEST['todt']);
                    $string.= "  bm_dayclosedate between '".$from."' and '".$to."'  ";
                    $stringta.= "  tab_dayclosedate between '".$from."' and '".$to."'  ";
                }
					        
	else 
	{
                $bydatz=$_REQUEST['bydate'];
                
                if($bydatz!="null" && $bydatz!="")
		{
                if($bydatz=="Last5days")
                {
                    $string.="  bm_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                    $stringta.="  tab_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                }
                elseif($bydatz=="Last10days")
                {
                    $string.="  bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                    $stringta.="  tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                }
                else if($bydatz=="Yesterday")
                {
                    $string.="  bm_dayclosedate = CURDATE() - INTERVAL 1 day";
                    $stringta.="  tab_dayclosedate = CURDATE() - INTERVAL 1 day";
                }
                elseif($bydatz=="Last15days")
                {
                    $string.="   bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                    $stringta.="   tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                }
                else if($bydatz=="Last20days")
                {
                    $string.="   bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                    $stringta.="   tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                }   
                else if($bydatz=="Last25days")
                {
                    $string.="  bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                    $stringta.="  tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                }
                else if($bydatz=="Last30days")
                {
                    $string.="  bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                    $stringta.="  tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                }
                else if($bydatz=="Last1month")
                {
                    $string.="  bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                    $stringta.="  tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                }
                else if($bydatz=="Today")
                {
                    $string.="  bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                    $stringta.="  tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                }
                else if($bydatz=="Last90days")
                {
                    $string.="  bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                    $stringta.="  tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
                }
                else if($bydatz=="Last180days")
                {
                    $string.="  bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
                    $stringta.="  tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
                }
                else if($bydatz=="Last365days")
                {
                    $string.="  bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                    $stringta.="  tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                }
                }
                else
                {
		$from=date("Y-m-d");
	        $to=date("Y-m-d");
	        $string.= "  bm_dayclosedate between '".$from."' and '".$to."' ";
                $stringta.= "  tab_dayclosedate between '".$from."' and '".$to."' ";
                }
	}
	
	
	  $sql_login  =  $database->mysqlQuery("select bm_billno from  tbl_tablebillmaster where $string"); 
         
  	  $num_login   = $database->mysqlNumRows($sql_login);
         
           $sql_loginta  =  $database->mysqlQuery("select tab_billno from tbl_takeaway_billmaster where $stringta"); 
           
            $num_loginta   = $database->mysqlNumRows($sql_loginta);
	
	  if($num_login || $num_loginta)
	  {
		echo "ok";
	  }else
	  {
		  echo "sorry";
	  }

}

  else if(($_REQUEST['type']=="consolidated_cancel_report"))
        {
	
	$string="";
	$stringta="";
		
	if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
		    $from=$database->convert_date($_REQUEST['fromdt']);
		    $to=$database->convert_date($_REQUEST['todt']);
		    $string.= "  ch_dayclosedate between '".$from."' and '".$to."'  ";
                    $stringta.= "  tc_dayclosedate between '".$from."' and '".$to."'  ";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
                     $from=$database->convert_date($_REQUEST['fromdt']);
		     $to=date("Y-m-d");
		     $string.= "  ch_dayclosedate between '".$from."' and '".$to."' ";
                     $stringta.= "  tc_dayclosedate between '".$from."' and '".$to."' ";
		}
                else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
                {
                     $from=date("Y-m-d");
                     $to=$database->convert_date($_REQUEST['todt']);
                     $string.= "  ch_dayclosedate between '".$from."' and '".$to."'  ";
                     $stringta.= "  tc_dayclosedate between '".$from."' and '".$to."'  ";
                }
					
					
            
	else 
	{
                $bydatz=$_REQUEST['bydate'];
                
                if($bydatz!="null" && $bydatz!="")
		{
	
                if($bydatz=="Last5days")
                {
                    $string.="  ch_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                    $stringta.="  tc_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                }
                elseif($bydatz=="Last10days")
                {
                    $string.="  ch_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                    $stringta.="  tc_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                }
                else if($bydatz=="Yesterday")
                {
                    $string.="  ch_dayclosedate = CURDATE() - INTERVAL 1 day";
                    $stringta.="  tc_dayclosedate = CURDATE() - INTERVAL 1 day";
                }
                elseif($bydatz=="Last15days")
                {
                    $string.="   ch_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                    $stringta.="   tc_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                }
                else if($bydatz=="Last20days")
                {
                    $string.="   ch_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                    $stringta.="   tc_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                }   
                else if($bydatz=="Last25days")
                {
                    $string.="  ch_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                    $stringta.="  tc_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                }
                else if($bydatz=="Last30days")
                {
                    $string.="  ch_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                    $stringta.="  tc_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                }
                else if($bydatz=="Last1month")
                {
                    $string.="  ch_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                    $stringta.="  tc_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                }
                else if($bydatz=="Today")
                {
                    $string.="  ch_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                    $stringta.="  tc_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                }
                else if($bydatz=="Last90days")
                {
                    $string.="  ch_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                    $stringta.="  tc_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
                }
                else if($bydatz=="Last180days")
                {
                    $string.="  ch_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
                    $stringta.="  tc_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
                }
                else if($bydatz=="Last365days")
                {
                    $string.="  ch_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                    $stringta.="  tc_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                }
                }
                else
                {
		$from=date("Y-m-d");
	        $to=date("Y-m-d");
	        $string.= "  ch_dayclosedate between '".$from."' and '".$to."' ";
                $stringta.= "  tc_dayclosedate between '".$from."' and '".$to."' ";
                }
	}
	
	
	  $sql_login  =  $database->mysqlQuery("select ch_kot_cancel_id from  tbl_tableorder_changes where $string"); 
       
  	  $num_login   = $database->mysqlNumRows($sql_login);
         
           $sql_loginta  =  $database->mysqlQuery("select tc_cancel_id from tbl_takeaway_cancel_items where $stringta"); 
    
            $num_loginta   = $database->mysqlNumRows($sql_loginta);
	
	  if($num_login || $num_loginta)
	  {
		echo "ok";
	  }else
	  {
		  echo "sorry";
	  }

}

else if($_REQUEST['type'] == "item_ordered_cr")
{	$string="";
        $stringta="";
        $string_combo="";
	$string.="bm.bm_status = 'Closed'";
        $stringta.="bm.tab_status = 'Closed'";
        $string_addon="";
        $stringta_addon="";
        if($_REQUEST['addon']=='N')
	{
            $string_addon.=" and bd.bd_bill_addon_slno IS NULL ";
            $stringta_addon.=" and bd.tab_bill_addon_slno IS NULL ";
        }
        else if($_REQUEST['addon']=='Y')
	{
            $string_addon.=" and bd.bd_bill_addon_slno IS NOT NULL";
            $stringta_addon.=" and bd.tab_bill_addon_slno IS NOT NULL ";
        }
        
        if($_REQUEST['category_menu']!="" ){
            $string.= " and mm.mr_maincatid='".$_REQUEST['category_menu']."'";
             $stringta.= " and mm.mr_maincatid='".$_REQUEST['category_menu']."'";
        }
        
        
        if(isset($_REQUEST['menu_search']) && $_REQUEST['menu_search']!="" ){
            $string.= " and mm.mr_menuname LIKE '%".$_REQUEST['menu_search']."%'";
            $stringta.= " and mm.mr_menuname LIKE '%".$_REQUEST['menu_search']."%'";
            $string_combo.= " cn.cn_name LIKE '%".$_REQUEST['menu_search']."%' and ";
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
                    $stringta.= " and bm.tab_dayclosedate between '".$from."' and '".$to."'  ";
                    $string_combo.= " cbd.cbd_dayclosedate between '".$from."' and '".$to."'  ";
                    
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
                     $from=$database->convert_date($_REQUEST['fromdt']);
		     $to=date("Y-m-d");
		     $string.= " and bm.bm_dayclosedate between '".$from."' and '".$to."' ";
                     $stringta.= " and bm.tab_dayclosedate between '".$from."' and '".$to."' ";
                     $string_combo.= " cbd.cbd_dayclosedate between '".$from."' and '".$to."'  ";
                     
		}
                else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
                {
                     $from=date("Y-m-d");
                     $to=$database->convert_date($_REQUEST['todt']);
                     $string.= " and bm.bm_dayclosedate between '".$from."' and '".$to."'  ";
                     $stringta.= " and bm.tab_dayclosedate between '".$from."' and '".$to."'  ";
                     $string_combo.= " cbd.cbd_dayclosedate between '".$from."' and '".$to."'  ";
                     
                }
				
					
           
	else 
	{
                $bydatz=$_REQUEST['bydate'];
                
                if($bydatz!="null" && $bydatz!="")
		{
	
                if($bydatz=="Last5days")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                    $stringta.=" and bm.tab_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                    $string_combo.= " cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                    
                }
                elseif($bydatz=="Last10days")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                    $stringta.=" and bm.tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                     $string_combo.= " cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                    
                }
                else if($bydatz=="Yesterday")
                {
                    $string.=" and bm.bm_dayclosedate = CURDATE() - INTERVAL 1 day";
                    $stringta.=" and bm.tab_dayclosedate = CURDATE() - INTERVAL 1 day";
                    $string_combo.= " cbd.cbd_dayclosedate = CURDATE() - INTERVAL 1 day";
                   
                }
                elseif($bydatz=="Last15days")
                {
                    $string.="  and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                    $stringta.="  and bm.tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                    $string_combo.= " cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                    
                }
                else if($bydatz=="Last20days")
                {
                    $string.=" and  bm.bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                    $stringta.=" and  bm.tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                     $string_combo.= " cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                    
                }
                else if($bydatz=="Last25days")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                    $stringta.=" and bm.tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                    $string_combo.= " cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                    
                }
                else if($bydatz=="Last30days")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                    $stringta.=" and bm.tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                    $string_combo.= " cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                    
                }
                else if($bydatz=="Last1month")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                    $stringta.=" and bm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                    $string_combo.= " cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                    
                }
                else if($bydatz=="Today")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
                    $stringta.=" and bm.tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
                    $string_combo.= " cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
                    
                }
                else if($bydatz=="Last90days")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                    $stringta.=" and bm.tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                    $string_combo.= " cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                    
                }
                else if($bydatz=="Last180days")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                    $stringta.=" and bm.tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                    $string_combo.= " cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                    
                }
                else if($bydatz=="Last365days")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                    $stringta.=" and bm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                    $string_combo.= " cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                    
                }
                }
                else
                {
		$from=date("Y-m-d");
	        $to=date("Y-m-d");
	        $string.= " and bm.bm_dayclosedate between '".$from."' and '".$to."' ";
                $stringta.= " and bm.tab_dayclosedate between '".$from."' and '".$to."' ";
                $string_combo.= " cbd.cbd_dayclosedate between '".$from."' and '".$to."' ";
                
                
                }
                
	}
        $num_combo='';$num_login='';
            if(($_REQUEST['addon']=='' ||$_REQUEST['addon']=='combo') &&($_REQUEST['category_menu']=="")){
            $sql_combo  =  $database->mysqlQuery("select combo,comboid,combopackid, sum(qty) as qty, rate as rate, sum(total) as total from (
                                                    select CONCAT(cn.cn_name,' ',cp.cp_pack_name ) AS combo,cbd.cbd_combo_id as comboid, cbd.cbd_combo_pack_id combopackid, cbd.cbd_combo_qty as qty, cbd.cbd_combo_pack_rate as rate, cbd.cbd_combo_total_rate as total 
                                                    FROM tbl_combo_bill_details cbd 
                                                    left join tbl_combo_name cn on cn.cn_id=cbd.cbd_combo_id
                                                    left join tbl_combo_packs cp on cp.cp_id=cbd.cbd_combo_pack_id
                                                    LEFT JOIN tbl_tablebillmaster bm on bm.bm_billno = cbd.cbd_billno
                                                    where $string_combo and bm.bm_status='Closed' group by cbd.cbd_combo_id, cbd.cbd_combo_pack_id,cbd.cbd_billno union all
                                                
                                                select CONCAT(cn.cn_name,' ',cp.cp_pack_name ) AS combo,cbd.cbd_combo_id, cbd.cbd_combo_pack_id, cbd.cbd_combo_qty as qty, cbd.cbd_combo_pack_rate as rate, cbd.cbd_combo_total_rate as total 
                                                    FROM tbl_combo_bill_details_ta cbd 
                                                    left join tbl_combo_name cn on cn.cn_id=cbd.cbd_combo_id
                                                    left join tbl_combo_packs cp on cp.cp_id=cbd.cbd_combo_pack_id
                                                    LEFT JOIN tbl_takeaway_billmaster bm on bm.tab_billno = cbd.cbd_billno
                                                    where $string_combo and bm.tab_status='Closed' group by cbd.cbd_combo_id, cbd.cbd_combo_pack_id,cbd.cbd_billno ) x group by x.comboid, x.combopackid");
            $num_combo   = $database->mysqlNumRows($sql_combo);
        }
         if($_REQUEST['addon']=='' || $_REQUEST['addon']=='N'|| $_REQUEST['addon']=='Y'){
      $sql_login  =  $database->mysqlQuery("select maincategory,subcategory,menuid,menuname, rate_type,unit_type,portionid,portionname,sum(weight)as weight,unitid,unitname,baseunitid,baseunitname,sum(qty)as qty,sum(total)as total from ( 
                                        select mc.mmy_maincategoryname as maincategory, sc.msy_subcategoryname as subcategory,bd.bd_menuid as menuid,mm.mr_menuname as menuname, bd.bd_rate_type as rate_type,
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
                                        group by bd.bd_menuid,bd.bd_portion,bd.bd_unit_id, bd.bd_base_unit_id,bd.bd_unit_weight

                                        union all 
                                        
                                        select mc.mmy_maincategoryname as maincategory, sc.msy_subcategoryname as subcategory,bd.tab_menuid as menuid,mm.mr_menuname as menuname, bd.tab_rate_type as rate_type,
                                        bd.tab_unit_type as unit_type, bd.tab_portion as portionid,pm.pm_portionname as portionname,
                                        bd.tab_unit_weight as weight, bd.tab_unit_id as unitid,um.u_name as unitname,
                                        bd.tab_base_unit_id as baseunitid,bum.bu_name as baseunitname, bd.tab_rate, sum(bd.tab_qty) as qty , sum(bd.tab_rate* bd.tab_qty) as total
                                        FROM tbl_takeaway_billdetails bd
                                        left join tbl_takeaway_billmaster bm ON bm.tab_billno = bd.tab_billno
                                        left join tbl_menumaster mm ON mm.mr_menuid = bd.tab_menuid
                                        left join tbl_menumaincategory mc ON mc.mmy_maincategoryid = mm.mr_maincatid
                                        left join tbl_menusubcategory sc ON sc.msy_subcategoryid = mm.mr_subcatid
                                        left join tbl_portionmaster pm ON pm.pm_id = bd.tab_portion
                                        left join  tbl_unit_master um on um.u_id=bd.tab_unit_id
                                        left join tbl_base_unit_master bum on bum.bu_id=bd.tab_base_unit_id
                                        where $stringta $stringta_addon
                                        group by bd.tab_menuid,bd.tab_portion,bd.tab_unit_id, bd.tab_base_unit_id, bd.tab_unit_weight 
                                        )x group by menuid,portionid,unitid,baseunitid,weight order by maincategory ");
     
      $num_login   = $database->mysqlNumRows($sql_login);
         }
	  if($num_login || $num_combo)
	  {
			echo "ok";
	  }else
	  {
			echo "sorry";
	  }

}
else if($_REQUEST['type'] == "categorywise_report_cr")
{	$string="";
	$string="bm.bm_status = 'Closed'";
        $stringta="";
	$stringta="tbm.tab_status = 'Closed'";
        
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
                    $stringta.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."'  ";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
                     $from=$database->convert_date($_REQUEST['fromdt']);
		     $to=date("Y-m-d");
		     $string.= " and bm.bm_dayclosedate between '".$from."' and '".$to."' ";
                     $stringta.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
		}
                else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
                {
                     $from=date("Y-m-d");
                     $to=$database->convert_date($_REQUEST['todt']);
                     $string.= " and bm.bm_dayclosedate between '".$from."' and '".$to."'  ";
                     $stringta.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."'  ";
                }
					
					
            
	else 
	{
                $bydatz=$_REQUEST['bydate'];
                
                if($bydatz!="null" && $bydatz!="")
		{
	
                if($bydatz=="Last5days")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                    $stringta.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                }
                elseif($bydatz=="Last10days")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                    $stringta.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                }
                else if($bydatz=="Yesterday")
                {
                    $string.=" and bm.bm_dayclosedate = CURDATE() - INTERVAL 1 day";
                    $stringta.=" and tbm.tab_dayclosedate = CURDATE() - INTERVAL 1 day";
                }
                elseif($bydatz=="Last15days")
                {
                    $string.="  and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                    $stringta.="  and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                }
                else if($bydatz=="Last20days")
                {
                    $string.=" and  bm.bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                    $stringta.=" and  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                }
                else if($bydatz=="Last25days")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                    $stringta.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                }
                else if($bydatz=="Last30days")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                    $stringta.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                }
                else if($bydatz=="Last1month")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                    $stringta.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                }
                else if($bydatz=="Today")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                }
                else if($bydatz=="Last90days")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
                    $stringta.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
                }
                else if($bydatz=="Last180days")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
                    $stringta.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
                }
                else if($bydatz=="Last365days")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                    $stringta.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                }
                }
                else
                {
		$from=date("Y-m-d");
	        $to=date("Y-m-d");
	        $string.= " and bm.bm_dayclosedate between '".$from."' and '".$to."' ";
                $stringta.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
                }
	}
       
      $sql_login  =  $database->mysqlQuery(" SELECT mmy_maincategoryname,count(distinct(mr_menuid)) as noofitems,sum(qty + qty1) as qty,sum(Total) as Total From ( SELECT m.mr_menuid,mc.mmy_maincategoryname,ms.msy_subcategoryname,m.mr_menuname,p.pm_portionname,sum(bd.bd_qty) as qty,sum(0) as qty1,bd.bd_rate as Unit_Price, sum(bd.bd_amount) as Total from tbl_tablebilldetails bd left join tbl_menumaster m on m.mr_menuid = bd.bd_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = m.mr_maincatid left join tbl_menusubcategory ms on ms.msy_subcategoryid = m.mr_subcatid left join tbl_portionmaster p on p.pm_id = bd.bd_portion left join tbl_tablebillmaster bm on bm.bm_billno=bd.bd_billno where $string group by m.mr_menuid,mc.mmy_maincategoryname,ms.msy_subcategoryname union all 
                     SELECT m.mr_menuid ,mc.mmy_maincategoryname,ms.msy_subcategoryname,m.mr_menuname,p.pm_portionname,sum(0) as qty,sum(tbd.tab_qty) as qty1 ,tbd.tab_rate as Unit_Price ,sum(tbd.tab_amount) as Total from tbl_takeaway_billdetails tbd left join tbl_menumaster m on m.mr_menuid = tbd.tab_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = m.mr_maincatid left join tbl_menusubcategory ms on ms.msy_subcategoryid = m.mr_subcatid left join tbl_portionmaster p on p.pm_id = tbd.tab_portion left join tbl_takeaway_billmaster tbm on tbm.tab_billno=tbd.tab_billno where $stringta group by m.mr_menuid,mc.mmy_maincategoryname,ms.msy_subcategoryname) x group by mmy_maincategoryname ORDER BY mmy_maincategoryname ASC ");
//            echo "SELECT mmy_maincategoryname,count(distinct(mr_menuid)) as noofitems,sum(qty + qty1) as qty,sum(Total) as Total From ( SELECT m.mr_menuid,mc.mmy_maincategoryname,ms.msy_subcategoryname,m.mr_menuname,p.pm_portionname,sum(bd.bd_qty) as qty,sum(0) as qty1,bd.bd_rate as Unit_Price, sum(bd.bd_amount) as Total from tbl_tablebilldetails bd left join tbl_menumaster m on m.mr_menuid = bd.bd_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = m.mr_maincatid left join tbl_menusubcategory ms on ms.msy_subcategoryid = m.mr_subcatid left join tbl_portionmaster p on p.pm_id = bd.bd_portion left join tbl_tablebillmaster bm on bm.bm_billno=bd.bd_billno where $string group by m.mr_menuid,mc.mmy_maincategoryname,ms.msy_subcategoryname union all 
//                     SELECT m.mr_menuid ,mc.mmy_maincategoryname,ms.msy_subcategoryname,m.mr_menuname,p.pm_portionname,sum(0) as qty,sum(tbd.tab_qty) as qty1 ,tbd.tab_rate as Unit_Price ,sum(tbd.tab_amount) as Total from tbl_takeaway_billdetails tbd left join tbl_menumaster m on m.mr_menuid = tbd.tab_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = m.mr_maincatid left join tbl_menusubcategory ms on ms.msy_subcategoryid = m.mr_subcatid left join tbl_portionmaster p on p.pm_id = tbd.tab_portion left join tbl_takeaway_billmaster tbm on tbm.tab_billno=tbd.tab_billno where $stringta group by m.mr_menuid,mc.mmy_maincategoryname,ms.msy_subcategoryname) x group by mmy_maincategoryname ORDER BY mmy_maincategoryname ASC";
      $num_login   = $database->mysqlNumRows($sql_login);
	 
         if($num_login)
	  {
			echo "ok";
	  }else
	  {
			echo "sorry";
	  }

}
else if(($_REQUEST['type']=="cash_settling_report_cr"))
{
     	$staff=$_REQUEST['staff'];
        $department=$_REQUEST['department'];
	$string="";
        $stringta="";
	$string.=" bm_status='Closed' AND ";
        $stringta.=" tab_status='Closed' AND ";
         if($staff!="")
        {
           $string.="bm_settlement_login='".$staff."' AND ";
           $stringta.=" tab_settlement_login='".$staff."' AND ";
                
        }
	if($department!=""&&$department!='DI')
        {
           
             $stringta.=" tab_mode='".$department."' AND ";
                
            }
		
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
            $stringta.= " tab_dayclosedate between '".$from."' and '".$to."'";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
            $stringta.= " tab_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
            $stringta.= " tab_dayclosedate between '".$from."' and '".$to."' ";
		}
				
	 else 
	{
                $bydatz=$_REQUEST['bydate'];

	if($bydatz=="Last5days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
        $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
	}elseif($bydatz=="Last10days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.="bm_dayclosedate = CURDATE() - INTERVAL 1 day";
                  $stringta.=" tab_dayclosedate = CURDATE() - INTERVAL 1 day";
			  }
	elseif($bydatz=="Last15days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
        $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
        $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
	}
	else if($bydatz=="Last25days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
        $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
	}
	else if($bydatz=="Last30days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
        $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
	}
	 else if($bydatz=="Last1month")
			  {
				  $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                 $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
	else if($bydatz=="Today")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
        $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
else if($bydatz=="Last90days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
        $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
	}
else if($bydatz=="Last180days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
	}
else if($bydatz=="Last365days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
	}
        else
	{
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.= " tab_dayclosedate between '".$from."' and '".$to."' ";
	}

        }
    
	
  $sql_login  =  $database->mysqlQuery("select distinct(bm_settlement_login),sum(bm_finaltotal) from tbl_tablebillmaster where $string"); 

   $num_login   = $database->mysqlNumRows($sql_login);
  $sql_loginta=$database->mysqlQuery("select distinct(tab_settlement_login),sum(tab_netamt) from tbl_takeaway_billmaster where $stringta");

  $num_loginta   = $database->mysqlNumRows($sql_loginta);
	
	  if($num_login||$num_loginta)
	  {
			echo "ok";
	  }else
	  {
		  echo "sorry";
	  }
}

else if(($_REQUEST['type']=="kitchen_wise_report_cr"))
{ 
	$string="";
	$stringta="";
    $kitchen=$_REQUEST['kitchen'];
	$string.=" bm.bm_status='Closed' AND ";
    $stringta.=" tbm.tab_status='Closed' AND ";
        if($kitchen!=''){
            $string.=" km.kr_kotcode='".$kitchen."' AND ";
            $stringta.=" km.kr_kotcode='".$kitchen."' AND ";
        }
         
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm.bm_dayclosedate between '".$from."' and '".$to."' ";
            $stringta.= " tbm.tab_dayclosedate between '".$from."' and '".$to."'";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " bm.bm_dayclosedate between '".$from."' and '".$to."' ";
            $stringta.= " tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm.bm_dayclosedate between '".$from."' and '".$to."' ";
            $stringta.= " tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
		}
                else 
	{
                $bydatz=$_REQUEST['bydate'];
         
	if($bydatz=="Last5days")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                $stringta.=" tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
	}elseif($bydatz=="Last10days")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                $stringta.=" tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.="bm.bm_dayclosedate = CURDATE() - INTERVAL 1 day";
                    $stringta.=" tbm.tab_dayclosedate = CURDATE() - INTERVAL 1 day";
			  }
	elseif($bydatz=="Last15days")
	{
		$string.=" bm.bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                $stringta.=" tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" bm.bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                $stringta.=" tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
	}
	else if($bydatz=="Last25days")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                $stringta.=" tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
	}
	else if($bydatz=="Last30days")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                $stringta.=" tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
	}
	 else if($bydatz=="Last1month")
			  {
				  $string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                                  $stringta.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
	else if($bydatz=="Today")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
                $stringta.=" tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
else if($bydatz=="Last90days")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                $stringta.=" tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
	}
else if($bydatz=="Last180days")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                $stringta.=" tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
	}
else if($bydatz=="Last365days")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                $stringta.=" tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
	}
        else
	{
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " bm.bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.= " tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
	}

        }

        
    $sql_login  =  $database->mysqlQuery("select kitchen,sum(qty) as qty,menu,category,sum(amount) as tot from( SELECT mc.mmy_maincategoryname as category,km.kr_kotname as kitchen,mm.mr_menuname menu,mm.mr_kotcounter,bd.bd_menuid as menuid,sum(bd_qty)as qty,sum(bd_rate*bd_qty)as amount from tbl_tablebilldetails bd left join tbl_tablebillmaster bm on bm.bm_billno=bd.bd_billno LEFT JOIN tbl_menumaster mm on mm.mr_menuid= bd.bd_menuid
                                          LEFT JOIN tbl_kotcountermaster km on km.kr_kotcode=mm.mr_kotcounter left join tbl_menumaincategory mc on mc.mmy_maincategoryid=mm.mr_maincatid where $string group by bd_menuid union SELECT mc.mmy_maincategoryname as category,km.kr_kotname as kitchen,mm.mr_menuname menu,mm.mr_kotcounter,tbd.tab_menuid as menuid,sum(tab_qty)as qty,sum(tab_rate*tab_qty)as amount from tbl_takeaway_billdetails tbd 
                                           left join tbl_takeaway_billmaster tbm on tbm.tab_billno=tbd.tab_billno LEFT JOIN tbl_menumaster mm on mm.mr_menuid= tbd.tab_menuid LEFT JOIN tbl_kotcountermaster km on km.kr_kotcode=mm.mr_kotcounter left join tbl_menumaincategory mc on mc.mmy_maincategoryid=mm.mr_maincatid where $stringta  group by tbd.tab_menuid)x group by kitchen,menu,category order by category"); 
    
   $num_login   = $database->mysqlNumRows($sql_login);	
	  if($num_login)
	  {
			echo "ok";
	  }else
	  {
		  echo "sorry";
	  }

}
else if(($_REQUEST['type']=="discount_report_cr"))
{
    	
	$string="";
        $stringta="";
	$string=" bm_status='Closed' AND  bm.bm_discountvalue>0 and  ";
        $stringta=" tab_status='Closed' AND  tbm.tab_discountvalue>0 and  ";
	
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.= " tab_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.= " tab_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.= " tab_dayclosedate between '".$from."' and '".$to."' ";
		}
	
	
	else 
	{
		
		$bydatz=$_REQUEST['bydate'];
		
			if($bydatz!="null" && $bydatz!="")
	{
	
	if($bydatz=="Last5days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
	}elseif($bydatz=="Last10days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.="bm_dayclosedate = CURDATE() - INTERVAL 1 day";
                                  $stringta.="tab_dayclosedate = CURDATE() - INTERVAL 1 day";
			  }
	elseif($bydatz=="Last15days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
	}
	else if($bydatz=="Last25days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
	}
	else if($bydatz=="Last30days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
	}
	 else if($bydatz=="Last1month")
			  {
				  $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
	else if($bydatz=="Today")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
	}
else if($bydatz=="Last90days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last180days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                $stringta.="bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
	}
else if($bydatz=="Last365days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                $stringta.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
	}

	}
	else
	{
		$from=date("Y-m-d");
		$to=date("Y-m-d");
		$string.= "bm_dayclosedate between '".$from."' and '".$to."' ";
        $stringta.= "tab_dayclosedate between '".$from."' and '".$to."' ";
	}
	}
	
$discountdine=0;
$discountta=0;
    $sql_login  =  $database->mysqlQuery("select * from ( select  bm.bm_billno as bill,bm.bm_discountvalue as discount, bm.bm_finaltotal as amount,'DI' AS mode FROM tbl_tablebillmaster bm
                                                        where $string union all
                                                        select tbm.tab_billno as bill, tbm.tab_discountvalue as discount, tbm.tab_netamt as amount, tbm.tab_mode as mode FROM tbl_takeaway_billmaster tbm
                                                        where $stringta ) x order by   mode"); 

    $num_login   = $database->mysqlNumRows($sql_login);
          if($num_login)
	  {
			echo "ok";
	  }else
	  {
		  echo "sorry";
	  }
}
else if(($_REQUEST['type']=="complimentary_cr"))
{
    	
	$string="";
    $stringta="";
	$string.=" bm.bm_status='Closed' AND bm.bm_complimentary='Y' and  ";
    $stringta.=" tbm.tab_status='Closed' AND tbm.tab_complimentary='Y' and  ";
	
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.= " tab_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.= " tab_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.= " tab_dayclosedate between '".$from."' and '".$to."' ";
		}
	
	
	else 
	{
		
		$bydatz=$_REQUEST['bydate'];
		
	if($bydatz!="null" && $bydatz!="")
	{
	
	if($bydatz=="Last5days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
	}elseif($bydatz=="Last10days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.="bm_dayclosedate = CURDATE() - INTERVAL 1 day";
                  $stringta.="tab_dayclosedate = CURDATE() - INTERVAL 1 day";
			  }
	elseif($bydatz=="Last15days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
	}
	else if($bydatz=="Last25days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
	}
	else if($bydatz=="Last30days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
	}
	 else if($bydatz=="Last1month")
			  {
				  $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                    $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
	else if($bydatz=="Today")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
	}
else if($bydatz=="Last90days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last180days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
	}
else if($bydatz=="Last365days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
	}
        else{
           
		$cur=date("Y-m-d");
		$string.=" bm_dayclosedate='".$cur."'";
        $stringta.=" tab_dayclosedate between '".$cur."' and '".$cur."'";
                
		$reporthead="On ".$database->convert_date($cur);	
	
        }
	}	
	
	}
	
	
$discountdine=0;
$discountta=0;
  $sql_login  =  $database->mysqlQuery("select * from (select tbm.tab_billno as bill ,tbm.tab_date as billdate,tbm.tab_mode as mode,tbm.tab_netamt as amount FROM tbl_takeaway_billmaster tbm where $stringta union all
                                        select bm.bm_billno as bill,bm.bm_billdate as billdate,'DI' AS mode,bm.bm_finaltotal as amount FROM tbl_tablebillmaster bm where $string )x order by x.mode asc "); 

	  $num_login   = $database->mysqlNumRows($sql_login);
          
	  if($num_login)
	  {
			echo "ok";
	  }else
	  {
		  echo "sorry";
	  }

}
else if(($_REQUEST['type']=="most_revenue_generated_item_cr"))
{
     	
	$string="";
	$string=" bm.bm_status='Closed' AND bm.bm_complimentary!='Y' and ";
    $stringta="";
	$stringta=" tbm.tab_status='Closed' AND tbm.tab_complimentary!='Y' and ";
	
	
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
            $stringta.= " tab_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
            $stringta.= " tab_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
            $stringta.= " tab_dayclosedate between '".$from."' and '".$to."' ";
		}

	
	else 
	{
	
		$bydatz=$_REQUEST['bydate'];
	
	if($bydatz!="null" && $bydatz!="")
	{
	
	if($bydatz=="Last5days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                
	}elseif($bydatz=="Last10days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.="bm_dayclosedate = CURDATE() - INTERVAL 1 day";
                 $stringta.="tab_dayclosedate = CURDATE() - INTERVAL 1 day";
			  }
	elseif($bydatz=="Last15days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
	}
	else if($bydatz=="Last25days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
	}
	else if($bydatz=="Last30days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
	}
	 else if($bydatz=="Last1month")
			  {
				  $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
	else if($bydatz=="Today")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
else if($bydatz=="Last90days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
                $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last180days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
                $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last365days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
                $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}

	}
	else
	{
			$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "bm_dayclosedate between '".$from."' and '".$to."' ";
            $stringta.= "tab_dayclosedate between '".$from."' and '".$to."' ";
	}
		
	}
	
  	  $sql_login  =  $database->mysqlQuery("select distinct(bd.bd_menuid),mr.mr_menuname as menu,sum(bd.bd_qty) as totqty,sum(bd.bd_amount) as totamt from tbl_tablebilldetails bd left join tbl_tablebillmaster bm on bm.bm_billno=bd.bd_billno left join tbl_menumaster mr on mr.mr_menuid=bd.bd_menuid where $string  group by bd.bd_menuid order by totamt  DESC LIMIT 0,10"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
                    
      $sql_loginta  =  $database->mysqlQuery("select distinct(tbd.tab_menuid),mr.mr_menuname as menu,sum(tbd.tab_qty) as totqty,sum(tbd.tab_amount) as totamt from  tbl_takeaway_billdetails tbd left join tbl_takeaway_billmaster tbm on tbm.tab_billno=tbd.tab_billno left join tbl_menumaster mr on mr.mr_menuid=tbd.tab_menuid where $stringta  group by tbd.tab_menuid order by totamt  DESC LIMIT 0,10"); 
	  $num_loginta   = $database->mysqlNumRows($sql_loginta);   
                
	
	  if($num_login || $num_loginta)
	  {
			echo "ok";
	  }else
	  {
		  echo "sorry";
	  }

}
else if(($_REQUEST['type']=="hourlywise_report_cr"))
{   
     	$days=trim($_REQUEST['day'],",");
        $fromtime=$_REQUEST['fromtime'];
        if($fromtime!=""){
        $newfromtime="'".date("H:i:s", strtotime($fromtime))."'";
        }
        else{
           $newfromtime="'00:00:00'"; 
        }
        
        $totime=$_REQUEST['totime'];
        if($totime!=""){
        $newtotime="'".date("H:i:s", strtotime($totime))."'";
        } 
        else{
          $newtotime  ="'23:59:59'";
        }
       $string="";
       $stringta="";
        
       if($days!=""){
           
        $days1="";
        $days1=explode(',',$days);
        $days2="";
        
        for($i=0;$i<count($days1);$i++){
        $days2.="'".$days1[$i]."',";    
        }
          $days2=trim($days2,",");
          
        if(($days2)!=""){
            $string .=" DAYNAME(bm.bm_billdate) IN ($days2) and  ";
            $stringta.="  DAYNAME(tbm.tab_date) IN ($days2) and ";
        }
       }
      
	$string.=" bm.bm_status='Closed'   ";
        $stringta.=" tbm.tab_status='Closed'  ";
	
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " and  bm_dayclosedate between '".$from."' and '".$to."' ";
             $stringta.= " and  tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " and  bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.= " and  tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " and  bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.= " and  tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
		}

	
	
	else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " and bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
	}
	
	
    $sql_login  =  $database->mysqlQuery("select bm_billno,pm.pym_name from tbl_tablebillmaster bm left join tbl_paymentmode pm on pm.pym_id=bm.bm_paymode where $string  and bm.bm_billtime between $newfromtime and $newtotime  " ); 
    $num_login   = $database->mysqlNumRows($sql_login);
    
    $sql_loginta  =  $database->mysqlQuery("select tab_billno,pm.pym_name from tbl_takeaway_billmaster tbm left join tbl_paymentmode pm on pm.pym_id=tbm.tab_paymode  where $stringta and tbm.tab_time between $newfromtime and $newtotime   " ); 
  
    $num_loginta   = $database->mysqlNumRows($sql_loginta);
	
	  if($num_login||$num_loginta)
	  {
			echo "ok";
	  }else
	  {
		  echo "sorry";
	  }

}
else if(($_REQUEST['type']=="credit_summary_client"))
{    	
        $string="";
       
	$creditsataff='';
	$creditstaff=$_REQUEST['creditstaff'];
        if($creditstaff!=''){
           $string.=" crd_type='$creditstaff' and ";
        }
	
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " cd_dayclosedate between '".$from."' and '".$to."' ";
                        
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " cd_dayclosedate between '".$from."' and '".$to."' ";
                        
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= "  cd_dayclosedate between '".$from."' and '".$to."' ";
                       
		}

	else 
	{
		$bydatz=$_REQUEST['bydate'];
		$st='';
	if($bydatz!=null && $bydatz!="")
	{
	if($bydatz=="Last5days")
	{
          
		$string.=" cd_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
                
		$st= " Last 5 days ";
		
	}elseif($bydatz=="Last10days")
	{
		$string.=" cd_dayclosedate between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( )";
               
		$st= " Last 10 days ";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" cd_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
               
		$st= " Last 15 days ";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" cd_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
               
		$st= " Last 20 days ";
	}
	else if($bydatz=="Last25days")
	{
		$string.=" cd_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                
		$st= " Last 25 days ";
	}
	else if($bydatz=="Last30days")
	{
		$string.=" cd_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
               
		$st= " Last 30 days ";
	}
	else if($bydatz=="Today")
	{
		$string.=" cd_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                
		$st= " Today ";
	}
	else if($bydatz=="Yesterday")
	{
		$string.=" cd_dayclosedate = CURDATE() - INTERVAL 1 DAY ";
                
		$st= " Yesterday ";
	}
	else if($bydatz=="Last1month")
	{
		$string.="  cd_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
                
		$st= " Last 1 month ";
	}
	else if($bydatz=="Last90days")
	{
		$string.=" cd_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
                
		$st= " Last 3 months ";
	}
	else if($bydatz=="Last180days")
	{
		$string.=" cd_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                
		$st= " Last 6 months "; 
	}
	else if($bydatz=="Last365days")
	{
		$string.=" cd_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                
		$st= " Last 1 year "; 
		
		
		
	}
$reporthead=$st;
	}
	else
	{
		
		
		$from=date("Y-m-d");
		$to=date("Y-m-d");
		$string.= " cd_dayclosedate between '".$from."' and '".$to."' ";
        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
			
	}
	
	}
		
	$sql_login  =  $database->mysqlQuery("select cd_slno from tbl_credit_details where $string " );
        
    $num_login   = $database->mysqlNumRows($sql_login);
    if($num_login)
        {
            echo "ok";
	}else
	{
            echo "ok";
	}

}
else if(($_REQUEST['type']=="consolidated_credit_summury"))
{   
     	
        $string="";
       
	$creditsataff='';
	$creditstaff=$_REQUEST['creditstaff'];
        if($creditstaff!=''){
           $string.=" crd_type='$creditstaff' and ";
        }
	
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " cd_dayclosedate between '".$from."' and '".$to."' ";
                        
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " cd_dayclosedate between '".$from."' and '".$to."' ";
                        
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= "  cd_dayclosedate between '".$from."' and '".$to."' ";
                       
		}

	
	
	else 
	{
		$bydatz=$_REQUEST['bydate'];
		$st='';
		
		
	if($bydatz!=null && $bydatz!="")
	{
		
	
	if($bydatz=="Last5days")
	{
          
		$string.=" cd_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
                
		$st= " Last 5 days ";
		
	}elseif($bydatz=="Last10days")
	{
		$string.=" cd_dayclosedate between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( )";
               
		$st= " Last 10 days ";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" cd_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
               
		$st= " Last 15 days ";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" cd_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
               
		$st= " Last 20 days ";
	}
	else if($bydatz=="Last25days")
	{
		$string.=" cd_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                
		$st= " Last 25 days ";
	}
	else if($bydatz=="Last30days")
	{
		$string.=" cd_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
               
		$st= " Last 30 days ";
	}
	else if($bydatz=="Today")
	{
		$string.=" cd_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                
		$st= " Today ";
	}
	else if($bydatz=="Yesterday")
	{
		$string.=" cd_dayclosedate = CURDATE() - INTERVAL 1 DAY ";
                
		$st= " Yesterday ";
	}
	else if($bydatz=="Last1month")
	{
		$string.="  cd_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
                
		$st= " Last 1 month ";
	}
	else if($bydatz=="Last90days")
	{
		$string.=" cd_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
                
		$st= " Last 3 months ";
	}
	else if($bydatz=="Last180days")
	{
		$string.=" cd_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                
		$st= " Last 6 months "; 
	}
	else if($bydatz=="Last365days")
	{
		$string.=" cd_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                
		$st= " Last 1 year "; 	
		
	}
$reporthead=$st;
	}
	else
	{
		$from=date("Y-m-d");
		$to=date("Y-m-d");
		$string.= " cd_dayclosedate between '".$from."' and '".$to."' ";
        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
			
	}
	
	}
		
	$sql_login  =  $database->mysqlQuery("select cd_slno from tbl_credit_details where $string " );
    $num_login   = $database->mysqlNumRows($sql_login);
    if($num_login)
        {
            echo "ok";
	}else
	{
            echo "ok";
	}

}
else if(($_REQUEST['type']=="tips_collected_consolidated"))
{
     	
	$string="";
	$string=" bm_status='Closed' AND ";
	$stringta="";
	$stringta=" tab_status='Closed' AND tab_payment_settled='Y' AND ";
        
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.= " tab_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.= " tab_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.= " tab_dayclosedate between '".$from."' and '".$to."' ";
		}

	
	else 
	{
		
		$bydatz=$_REQUEST['bydate'];
		
		
		
	if($bydatz!="null" && $bydatz!="")
	{
	
	
	if($bydatz=="Last5days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                
	}elseif($bydatz=="Last10days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.="bm_dayclosedate = CURDATE() - INTERVAL 1 day";
                $stringta.="tab_dayclosedate = CURDATE() - INTERVAL 1 day";
			  }
	elseif($bydatz=="Last15days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
        $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
	}
	else if($bydatz=="Last25days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
	}
	else if($bydatz=="Last30days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
	}
	 else if($bydatz=="Last1month")
			  {
				  $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
	else if($bydatz=="Today")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
else if($bydatz=="Last90days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
            $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last180days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
                $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last365days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
                $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}
	}
	else
	{
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "bm_dayclosedate between '".$from."' and '".$to."' ";
            $stringta.= "tab_dayclosedate between '".$from."' and '".$to."' ";
	}
	}
            $sql_tip  =  $database->mysqlQuery("select sum(tip) as tip,mode from(
                                                select sum( bm_tips_given) as tip,bm_tips_mode as mode FROM tbl_tablebillmaster where $string group by bm_tips_mode  union all
                                                select sum(tab_tips_given) as tip,tab_tips_mode as mode  FROM tbl_takeaway_billmaster  where $stringta group by tab_tips_mode
                                                )x where tip>0 group by mode order by mode"); 
            $num_tip   = $database->mysqlNumRows($sql_tip);
            if($num_tip)
            {
			echo "ok";
            }else
            {
		  echo "sorry";
            }
}
?>                       
