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

if($_REQUEST['type']=="tot_sales_hd"){   
    
    $string="";
    $staffsel='';
    $string =" tab_status='closed' AND tab_mode = 'HD' and tab_complimentary!='Y' AND ";
    $typesale=$_REQUEST['type'];
    $staffsel='';
    
    if(isset($_REQUEST['staffsel'])){
        $staffsel = $_REQUEST['staffsel'];
        if($_REQUEST['staffsel']!='null'){
            $string.="tab_assignedto='".$staffsel."' AND ";
        }
    }
    
    if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!=""){
	$from=$database->convert_date($_REQUEST['fromdt']);
	$to=$database->convert_date($_REQUEST['todt']);
	$string.= "tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
    }else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']==""){
        $from=$database->convert_date($_REQUEST['fromdt']);
	$to=date("Y-m-d");
	$string.= "tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
    }else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!=""){
	$from=date("Y-m-d");
	$to=$database->convert_date($_REQUEST['todt']);
	$string.= "tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
    }else{
        $bydatz=$_REQUEST['bydate'];
	if($bydatz!="null" && $bydatz!=""){
		//$search="";
            if($bydatz=="Last5days"){
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
            }elseif($bydatz=="Last10days"){
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
            }else if($bydatz=="Yesterday"){
		$string.="tab_dayclosedate = CURDATE() - INTERVAL 1 DAY " ;
            }elseif($bydatz=="Last15days"){
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
            }else if($bydatz=="Last20days"){
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
            }else if($bydatz=="Last25days"){
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
            }else if($bydatz=="Last30days"){
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
            }else if($bydatz=="Last1month"){
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
            }else if($bydatz=="Today"){
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
            }else if($bydatz=="Last90days"){
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
            }else if($bydatz=="Last180days"){
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
            }else if($bydatz=="Last365days"){
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
            }
        }
	else{
		$from=date("Y-m-d");
		$to=date("Y-m-d");
		$string.= "tab_dayclosedate between '".$from."' and '".$to."' ";
	}
    }
    $sql_login  =  $database->mysqlQuery("select * from tbl_takeaway_billmaster where $string"); 
     //echo "select * from tbl_takeaway_billmaster where $string";
    $num_login   = $database->mysqlNumRows($sql_login);
    if($num_login){
        echo "Ok";
    }else{
	echo "Sorry";
    }

}

else if($_REQUEST['type']=="delivery_report_hd"){   
    
    $string="";
    
    $string =" tab_status !='Cancelled' AND tab_mode = 'HD' and tab_complimentary!='Y' AND ";
    
    
   
    
    if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!=""){
	$from=$database->convert_date($_REQUEST['fromdt']);
	$to=$database->convert_date($_REQUEST['todt']);
	$string.= "tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
    }else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']==""){
        $from=$database->convert_date($_REQUEST['fromdt']);
	$to=date("Y-m-d");
	$string.= "tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
    }else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!=""){
	$from=date("Y-m-d");
	$to=$database->convert_date($_REQUEST['todt']);
	$string.= "tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
    }else{
        $bydatz=$_REQUEST['bydate'];
	if($bydatz!="null" && $bydatz!=""){
		//$search="";
            if($bydatz=="Last5days"){
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
            }elseif($bydatz=="Last10days"){
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
            }else if($bydatz=="Yesterday"){
		$string.="tab_dayclosedate = CURDATE() - INTERVAL 1 DAY " ;
            }elseif($bydatz=="Last15days"){
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
            }else if($bydatz=="Last20days"){
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
            }else if($bydatz=="Last25days"){
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
            }else if($bydatz=="Last30days"){
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
            }else if($bydatz=="Last1month"){
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
            }else if($bydatz=="Today"){
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
            }else if($bydatz=="Last90days"){
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
            }else if($bydatz=="Last180days"){
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
            }else if($bydatz=="Last365days"){
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
            }
        }
	else{
		$from=date("Y-m-d");
		$to=date("Y-m-d");
		$string.= "tab_dayclosedate between '".$from."' and '".$to."' ";
	}
    }
    $sql_login  =  $database->mysqlQuery("select * from tbl_takeaway_billmaster where $string"); 
   
    $num_login   = $database->mysqlNumRows($sql_login);
    if($num_login){
        echo "Ok";
    }else{
	echo "Sorry";
    }

}

else if($_REQUEST['type']=="categorywise_report_hd"){
	
    $string="";
    $staffsel='';
    $string =" tbm.tab_status='closed' AND  tbm.tab_mode = 'HD' AND ";
    
    if(isset($_REQUEST['staffsel'])){
        $staffsel = $_REQUEST['staffsel'];
        if($_REQUEST['staffsel']!='null'){
            $string.="tab_assignedto='".$staffsel."' AND ";
        }
    }
    
	if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!=""){
            $from=$database->convert_date($_REQUEST['fromdt']);
            $to=$database->convert_date($_REQUEST['todt']);
            $string.= "tab_dayclosedate between '".$from."' and '".$to."'";
	}else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']==""){
            $from=$database->convert_date($_REQUEST['fromdt']);
            $to=date("Y-m-d");
            $string.= "tab_dayclosedate between '".$from."' and '".$to."'";
        }else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!=""){
            $from=date("Y-m-d");
            $to=$database->convert_date($_REQUEST['todt']);
            $string.= "tab_dayclosedate between '".$from."' and '".$to."'";
	}
    else {
	$bydatz=$_REQUEST['bydate'];
	if($bydatz!="null" && $bydatz!=""){
            //$search="";
            if($bydatz=="Last5days"){
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
            }elseif($bydatz=="Last10days"){
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
            }else if($bydatz=="Yesterday"){
		$string.="tab_dayclosedate = CURDATE() - INTERVAL 1 DAY " ;
            }elseif($bydatz=="Last15days"){
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
            }else if($bydatz=="Last20days"){
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
            }else if($bydatz=="Last25days"){
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
            }else if($bydatz=="Last30days"){
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
            }else if($bydatz=="Last1month"){
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
            }else if($bydatz=="Today"){
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
            }else if($bydatz=="Last90days"){
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
            }else if($bydatz=="Last180days"){
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
            }else if($bydatz=="Last365days"){
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
            }
        }
	else{
            $from=date("Y-m-d");
            $to=date("Y-m-d");
            $string.= "tab_dayclosedate between '".$from."' and '".$to."' ";
	}
    }
    

    $sql_login  =  $database->mysqlQuery("SELECT mc.mmy_maincategoryname,count(distinct(tbd.tab_menuid)) as 'no of items',sum(tbd.tab_qty) as qty ,sum(tbd.tab_qty* tbd.tab_rate) as Total from tbl_takeaway_billmaster tbm left join tbl_takeaway_billdetails tbd on tbd.tab_billno = tbm.tab_billno left join tbl_menumaster on mr_menuid =tbd.tab_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = mr_maincatid where $string group by mr_maincatid ORDER BY mr_maincatid ASC "); 
    //echo "SELECT mc.mmy_maincategoryname,count(distinct(tbd.tab_menuid)) as 'no of items',sum(tbd.tab_qty) as qty ,sum(tbd.tab_qty* tbd.tab_rate) as Total from tbl_takeaway_billmaster tbm left join tbl_takeaway_billdetails tbd on tbd.tab_billno = tbm.tab_billno left join tbl_menumaster on mr_menuid =tbd.tab_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = mr_maincatid where $string group by mr_maincatid ORDER BY mr_maincatid ASC  ";
    $num_login   = $database->mysqlNumRows($sql_login);
    if($num_login){
        echo "Ok";
    }else{
	echo "Sorry";
    }
}

else if($_REQUEST['type']=="total_summary_details_hd"){
	
    $string="";
    $string.=" tab_status='closed' AND  tab_mode = 'HD' AND ";
    
    if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!=""){
        $from=$database->convert_date($_REQUEST['fromdt']);
	$to=$database->convert_date($_REQUEST['todt']);
	$string.= " tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
    }else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']==""){
	$from=$database->convert_date($_REQUEST['fromdt']);
	$to=date("Y-m-d");
	$string.= " tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
    }else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!=""){
	$from=date("Y-m-d");
	$to=$database->convert_date($_REQUEST['todt']);
	$string.= " tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
    }else{
	$bydatz=$_REQUEST['bydate'];
	if($bydatz!="null" && $bydatz!=""){
            //$search="";
            if($bydatz=="Last5days"){
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
            }elseif($bydatz=="Last10days"){
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
            }else if($bydatz=="Yesterday"){
		$string.="tab_dayclosedate = CURDATE() - INTERVAL 1 day";
            }elseif($bydatz=="Last15days"){
		$string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
            }else if($bydatz=="Last20days"){
		$string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
            }else if($bydatz=="Last25days"){
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
            }else if($bydatz=="Last30days"){
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
            }else if($bydatz=="Last1month"){
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
            }else if($bydatz=="Today"){
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
            }else if($bydatz=="Last90days"){
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
            }else if($bydatz=="Last180days"){
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
            }else if($bydatz=="Last365days"){
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
            }
        }
	else{
            $from=date("Y-m-d");
            $to=date("Y-m-d");
            $string.= "tab_dayclosedate between '".$from."' and '".$to."' ";
	}
    }
    $sql_login  =  $database->mysqlQuery("select * from tbl_takeaway_billmaster where $string"); 
    //echo"select * from tbl_takeaway_billmaster where $string";
    $num_login   = $database->mysqlNumRows($sql_login);
    if($num_login){
        echo "Ok";
    }else{
	echo "Sorry";
    }
}

else if($_REQUEST['type']=="summary_hd"){
    $string="";
    $string=" tab_status='closed' AND tab_mode!= 'CS' AND tab_mode = 'HD' AND ";
   
    if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!=""){
	$from=$database->convert_date($_REQUEST['fromdt']);
        $to=$database->convert_date($_REQUEST['todt']);
	$string.= " tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
    }else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']==""){
	$from=$database->convert_date($_REQUEST['fromdt']);
	$to=date("Y-m-d");
	$string.= " tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
    }else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!=""){
	$from=date("Y-m-d");
	$to=$database->convert_date($_REQUEST['todt']);
	$string.= " tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
    }else{
	$bydatz=$_REQUEST['bydate'];
	if($bydatz!="null" && $bydatz!=""){
            //$search="";
            if($bydatz=="Last5days"){
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
            }elseif($bydatz=="Last10days"){
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
            }else if($bydatz=="Yesterday"){
		$string.="tab_dayclosedate = CURDATE() - INTERVAL 1 day";
            }elseif($bydatz=="Last15days"){
		$string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
            }else if($bydatz=="Last20days"){
		$string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
            }else if($bydatz=="Last25days"){
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
            }else if($bydatz=="Last30days"){
                $string.="tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
            }else if($bydatz=="Last1month"){
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
            }else if($bydatz=="Today"){
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
            }else if($bydatz=="Last90days"){
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
            }else if($bydatz=="Last180days"){
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
            }else if($bydatz=="Last365days"){
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
            }
        }else{
		$from=date("Y-m-d");
		$to=date("Y-m-d");
		$string.= "tab_dayclosedate between '".$from."' and '".$to."' ";
	}
    }
    $sql_login  =  $database->mysqlQuery("select * from tbl_takeaway_billmaster where $string"); 
    //  echo "select * from tbl_takeaway_billmaster where $string";
    $num_login   = $database->mysqlNumRows($sql_login);
    if($num_login){
        echo "Ok";
    }else{
	echo "Sorry";
    }
}

else if($_REQUEST['type']=="cancel_history_hd"){
	
    $string="";
    $string=" tab_status='Cancelled' AND tab_mode = 'HD' AND ";
    $loginstaffsel = '';
    if(isset($_REQUEST['staffsel'])){
        $loginstaffsel = $_REQUEST['staffsel'];
        if($_REQUEST['staffsel']!='null'){
            $string.="tab_assignedto='".$loginstaffsel."' AND ";
        }
    }
    
    
    if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!=""){
	$from=$database->convert_date($_REQUEST['fromdt']);
	$to=$database->convert_date($_REQUEST['todt']);
	$string.= " tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
    }else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']==""){
	$from=$database->convert_date($_REQUEST['fromdt']);
	$to=date("Y-m-d");
	$string.= " tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
    }else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!=""){
	$from=date("Y-m-d");
	$to=$database->convert_date($_REQUEST['todt']);
	$string.= " tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
    }else{
	$bydatz=$_REQUEST['bydate'];
	if($bydatz!="null" && $bydatz!=""){
            //$search="";
            if($bydatz=="Last5days"){
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
            }elseif($bydatz=="Last10days"){
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
            }else if($bydatz=="Yesterday"){
		$string.="tab_dayclosedate = CURDATE() - INTERVAL 1 day";
            }elseif($bydatz=="Last15days"){
		$string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
            }else if($bydatz=="Last20days"){
		$string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
            }else if($bydatz=="Last25days"){
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
            }else if($bydatz=="Last30days"){
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
            }else if($bydatz=="Last1month"){
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
            }else if($bydatz=="Today"){
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
            }else if($bydatz=="Last90days"){
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
            }else if($bydatz=="Last180days"){
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
            }else if($bydatz=="Last365days"){
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
    //  echo "select * from tbl_takeaway_billmaster where $string";
    $num_login   = $database->mysqlNumRows($sql_login);
    if($num_login){
	echo "Ok";
    }else{
	echo "Sorry";
    }
}

else if($_REQUEST['type']=="order_hd"){
    $string="";
    $staffsel='';
    $string.="tbl_takeaway_billmaster.tab_status='Closed' AND tbl_takeaway_billmaster.tab_mode='HD' AND ";
    if(isset($_REQUEST['staffsel'])){
        $staffsel = $_REQUEST['staffsel'];
        if($_REQUEST['staffsel']!='null'){
            $string.="tab_assignedto='".$staffsel."' AND ";
        }
    }
    
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
    if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!=""){
	$from=$database->convert_date($_REQUEST['fromdt']);
	$to=$database->convert_date($_REQUEST['todt']);
	$string.= "  ( tbl_takeaway_billmaster.tab_dayclosedate between '".$from."' and '".$to."' ) ";
    }else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']==""){
	$from=$database->convert_date($_REQUEST['fromdt']);
	$to=date("Y-m-d");
	$string.= "  (  tbl_takeaway_billmaster.tab_dayclosedate between '".$from."' and '".$to."' ) ";
    }else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!=""){
	$from=date("Y-m-d");
	$to=$database->convert_date($_REQUEST['todt']);
	$string.= "  ( tbl_takeaway_billmaster.tab_dayclosedate between '".$from."' and '".$to."' )  ";
    }else{
	$bydatz=$_REQUEST['bydate'];
	if($bydatz!="null" && $bydatz!=""){
            //$search="";
            if($bydatz=="Last5days"){
		$string.=" tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
            }elseif($bydatz=="Last10days"){
		$string.=" tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
            }elseif($bydatz=="Last15days"){
		$string.=" tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
            }else if($bydatz=="Last20days"){
		$string.="  tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
            }else if($bydatz=="Last25days"){
		$string.=" tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
            }else if($bydatz=="Last30days"){
		$string.=" tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
            }else if($bydatz=="Today"){
		$string.=" tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
            }else if($bydatz=="Yesterday"){
		$string.="  tbl_takeaway_billmaster.tab_dayclosedate = CURDATE() - INTERVAL 1 DAY " ;
            }else if($bydatz=="Last1month"){
		$string.="  tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
            }else if($bydatz=="Last90days"){
		$string.=" tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
            }else if($bydatz=="Last180days"){
		$string.=" tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
            }else if($bydatz=="Last365days"){
		$string.=" tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
            }
        }else{
            $from=date("Y-m-d");
            $to=date("Y-m-d");
            $string.= " tbl_takeaway_billmaster.tab_dayclosedate between '".$from."' and '".$to."' ";
	}
    }
    $sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_menumaster.mr_menuname as menuname From tbl_takeaway_billmaster left join tbl_takeaway_billdetails tbd ON tbl_takeaway_billmaster.tab_billno=tbd. tab_billno left Join tbl_menumaster On tbl_menumaster.mr_menuid = tbd.tab_menuid  Where   $string $stringta_addon Group By tbl_menumaster.mr_menuname order by ct DESC");
   //echo "Select count(*)  as ct,tbl_menumaster.mr_menuname as menuname From tbl_takeaway_billmaster left join tbl_takeaway_billdetails tbd ON tbl_takeaway_billmaster.tab_billno=tbd. tab_billno left Join tbl_menumaster On tbl_menumaster.mr_menuid = tbd.tab_menuid  Where   $string $stringta_addon Group By tbl_menumaster.mr_menuname order by ct DESC ";
    $num_stw   = $database->mysqlNumRows($sql_stw);
    if($num_stw){
        echo "Ok";
    }else{
	echo "Sorry";
    }
}
else if(($_REQUEST['type'] == "billreport_hd"))
{
        $string="";
	$string=" tbm.tab_status='Closed' AND tbm.tab_mode='HD'"; 
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
	echo "Sorry";
	  }
	  
	

}
?>