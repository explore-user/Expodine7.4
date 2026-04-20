<?php
session_start();
if($_SESSION["archive_enabled"]=='Y'){
    include("database.class.reports.php");  // DB Connection class
    $database	= new Database();
    $con=mysqli_connect(HOST_NAME, USER_NAME, PASSWORD,DATABASE_NAME_REPORT);
}
else if($_SESSION["archive_enabled"]=='N'){
    include("database.class.php");  // DB Connection class
    $database	= new Database();
    $con=mysqli_connect(HOST_NAME, USER_NAME, PASSWORD,DATABASE_NAME);
}

$rn=chr(13).chr(10); 
$esc=chr(27); 
$cutpaper=$esc."m";
$bold_on=$esc."E1";
$bold_off=$esc."E0";
$reset=pack('n', 0x1B30);
/*$right=$esc."a2";
$left=$esc."a0";
$center=$esc."a1";*/
$right=$esc."a".chr(2);
$left=$esc."a".chr(0);
$center=$esc."a".chr(1);
$underlineon=$esc."-1";
$underlineofn=$esc."-0";
//$chewdth=$esc."GS ( Q <fn=48>";

date_default_timezone_set("Asia/Kolkata");

$branchname='';
$sql_branch =  $database->mysqlQuery("Select be_branchname,be_address,be_email,be_phone,be_others1,be_others2,be_others3,be_footer1,be_footer2,be_footer3,be_footer4 from tbl_branchmaster where be_branchid='".$_SESSION['branchofid']."'"); 
		  $num_branch  = $database->mysqlNumRows($sql_branch);
		  if($num_branch)
		  {
				while($result_branch  = $database->mysqlFetchArray($sql_branch)) 
					{
						 $branchname=$result_branch['be_branchname'];
						
					}
		  }
                  
                  $printer_style='';
$sql_kots1="Select * From tbl_printersettings  Where pr_branchid ='".$_SESSION['branchofid']."' and pr_printertype='".$_SESSION['reportprint_tp']."' ";
            $sql_kotss1  =  mysqli_query($con,$sql_kots1); 
            $num_kots1  = mysqli_num_rows($sql_kotss1);
            if($num_kots1){	
                $result_kots1  = mysqli_fetch_array($sql_kotss1);
		$printer_style=$result_kots1['pr_style'];
            }
//printer setup
if($_SESSION['s_printst']=="Y") // printer ye or no
{
	$printer_kotip_bill=array();
	$printer_kotport_bill=array(); 
	$bill_ok=0;
	$bill_sorry=1;
	$sql_kots="Select pr_defaultusb,pr_printerip,pr_printerport,pr_printername From tbl_printersettings  Where pr_branchid ='1' and pr_printertype= '3' and  pr_enable='Y'  group by pr_printerip ";
	
        //echo "Select pr_printerip,pr_printerport,pr_printername From tbl_printersettings  Where pr_branchid ='".$_SESSION['branchofid']."' and pr_printertype=1";
        $sql_kotss  =  mysqli_query($con,$sql_kots); 
	$num_kots  = mysqli_num_rows($sql_kotss);
	if($num_kots)
	{	
	while($result_kots  = mysqli_fetch_array($sql_kotss)) 
			{
                                $printer_kotname_bill[]=$result_kots['pr_printername'];
				$printer_kotip_bill[]=$result_kots['pr_printerip'];
				$printer_kotport_bill[]=$result_kots['pr_printerport'];
                                $printer_kotusb_bill[]=$result_kots['pr_defaultusb'];
			}
			foreach ($printer_kotport_bill as $key=>$port)
			{
                             if($printer_kotusb_bill[$key]=='N'){
                          if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
                            exec("ping -n 1 -w 1 ".$printer_kotip_bill[$key], $output, $result);               
                            
                           
                          } else if (strtoupper(substr(PHP_OS, 0, 3)) === 'LIN')
                                {
                                exec("ping -c 1 -w 1 ".$printer_kotip_bill[$key], $output, $result);
                                
                               
                                }
                            
                             }else{
                                $result=0;
                             }
                                   //echo  $result;
                            if ($result == 0)
                            {
	if($_REQUEST['type']=="totalsales_cs")
	{
		$string='';
		$print='';
		$from='';
		$to='';
                $user='';
		$typestring='';
		 $date=date("Ymd");
		 $string="tab_status='Closed' AND tab_mode='CS' and tab_complimentary!='Y' and ";
                 if($_REQUEST['log_user']!="null"){
                        $string.="  tab_loginid = '".$_REQUEST['log_user']."' and ";
                        $user=$_REQUEST['log_user'];
                    }
			if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
			{
				$from=$database->convert_date($_REQUEST['hidfr']);
				$to=$database->convert_date($_REQUEST['hidto']);
				$string.= " tab_dayclosedate between '".$from."' and '".$to."' ";
			}
			else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
			{
				$from=$database->convert_date($_REQUEST['hidfr']);
				$to=date("Y-m-d");
				$string.= "tab_dayclosedate between '".$from."' and '".$to."' ";
			}
			else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
			{
				$from=date("Y-m-d");
				$to=$database->convert_date($_REQUEST['hidto']);
				$string.= "tab_dayclosedate between '".$from."' and '".$to."' ";
			}
		
		else
		{
			$bydatz=$_REQUEST['hidbydate'];
			if($bydatz!="null")
			{
			//$search="";
		
		if($bydatz=="Last5days")
		{
			$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
			$typestring="Last 5 days";
		}elseif($bydatz=="Last10days")
		{
			$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
			$typestring="Last 10 days";
		}
		elseif($bydatz=="Last15days")
		{
			$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
			$typestring="Last 15 days";
		}
		else if($bydatz=="Last20days")
		{
			$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
			$typestring="Last 20 days";
		}
		else if($bydatz=="Last25days")
		{
			$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
			$typestring="Last 25 days";
		}
		else if($bydatz=="Last30days")
		{
			$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
			$typestring="Last 30 days";
		}
		else if($bydatz=="Today")
		{
			$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
			$typestring="Today";
		}
		else if($bydatz=="Yesterday")
		{
			$string.="tab_dayclosedate = CURDATE() - INTERVAL 1 DAY  ";
			$typestring="Yesterday";
		}
		 else if($bydatz=="Last1month")
		{
			$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			$typestring="Last 1 month";
		}
		else if($bydatz=="Last90days")
			{
				$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
				$typestring="Last 90 days"; 
			}
		else if($bydatz=="Last180days")
			{
				$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
				$typestring="Last 180 days";
			}
		else if($bydatz=="Last365days")
			{
				$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
				$typestring="Last 365 days";
			}
		}
		else
		{
			$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "tab_dayclosedate between '".$from."' and '".$to."' ";
		}
		}
		  $cur=date("Y-m-d");
		  $sql_login  =  $database->mysqlQuery("select tab_netamt,tab_dayclosedate,tab_billno from tbl_takeaway_billmaster where $string order by tab_dayclosedate"); 
		  $num_login   = $database->mysqlNumRows($sql_login);
		  if($num_login)
		  {
			    $print .= $center.$bold_on."COUNTER SALE".$bold_off."\n";                                
				$print .= $center.$bold_on."Total Sales Report".$bold_off."\n";
				if($from=='' && $to=='')
				{
					$print .= $center.$bold_on.$typestring.$bold_off."\n";
				}
				else
				{
				$print .= $center.$bold_on.$from." To ".$to.$bold_off."\n";
				}                              
            	if($user!='')
				{
				$print .= $center.$bold_on." User :".$user.$bold_off."\n";
				}        
				/*$print .= "------------------------------------------------\n";
				$print .= "Slno    Date           Bilno               Final\n";
				$print .= "------------------------------------------------\n";*/
				
				if($printer_style=='1'){
                                    $vv=str_pad("-",  '46%', "-");//46

                                    }
                                    else if($printer_style=='2'){
                                         $vv=str_pad("-",  '42%', "-");
                                    }
				$print .= $left.$vv."\n";//ojin
				//$print .= $left."Slno  Date        Bilno              Final\n";
				
				
				$menulist= array(
					new menulist("Slno","Date","Bilno", "Final",$printer_style),
				);
				foreach($menulist as $menulist) {
					$print .=$left.($bold_on.$menulist.$bold_off);
				}
				//$print .= $left."------------------------------------------\n";
				$print .= $left.$vv."\n";//ojin
				
				$final=0;$i=1;
				while($result_report  = mysqli_fetch_array($sql_login)) 
				{
					$final=$final + $result_report['tab_netamt'];
					$dt=explode("-",$result_report['tab_dayclosedate']);
					$date=$dt[2]."-".$dt[1]."-".$dt[0];
					
					$menulist= array(
						new menulist($i,$date,$result_report['tab_billno'],number_format($result_report['tab_netamt'],$_SESSION['be_decimal']),$printer_style),
					);
					foreach($menulist as $menulist) {
						$print .=$left.($menulist);
					}

					$i++;
				}
				$print .= $left.$vv."\n";//ojin
                                $menulist= array(
					new menulist("Total","","",number_format($final,$_SESSION['be_decimal']),$printer_style),
				);
				foreach($menulist as $menulist) {
					$print .=$left.($bold_on.$menulist.$bold_off);
				}
				
				$print .= $left.$vv."\n";//ojin
				
				
				
				$print .="\n\n\n\n\n";
				$print.=$cutpaper;
				
				//And pr_floorid='".$florrid."'
				$sql_kots="Select * From tbl_printersettings  Where pr_branchid ='".$_SESSION['branchofid']."' and pr_printertype='".$_SESSION['reportprint_tp']."' ";
				$sql_kotss  =  mysqli_query($con,$sql_kots); 
				$num_kots  = mysqli_num_rows($sql_kotss);
				if($num_kots){	
				while($result_kots  = mysqli_fetch_array($sql_kotss)) 
						{
							if($result_kots['pr_defaultusb']=='Y')
							{
							  $printer="\\\\".$result_kots['pr_usbprinterip']."\\".$result_kots['pr_usbprinter'];
							  $fp=fopen($printer, 'w');
							  fwrite($fp,$print);
							  fclose($fp);
							}else
							{
								$fp = fsockopen($result_kots['pr_printerip'], $result_kots['pr_printerport'], $errno, $errstr, 10);
							  fwrite($fp,$print);
							  fclose($fp);
							}
						}
				}
				
				
		  }
	}
	
else if($_REQUEST['type']=="billcancel_cs")
	{
		$string='';
		$print='';
		$from='';
		$to='';
		$typestring='';
		 $date=date("Ymd");
		$string.="tbm.tab_mode='CS' and tbm.tab_status='Cancelled' and tbm.tab_cancelled='Y' and ";
			if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
			{
				$from=$database->convert_date($_REQUEST['hidfr']);
				$to=$database->convert_date($_REQUEST['hidto']);
				$string.= " tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
			}
			else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
			{
				$from=$database->convert_date($_REQUEST['hidfr']);
				$to=date("Y-m-d");
				$string.= " tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
			}
			else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
			{
				$from=date("Y-m-d");
				$to=$database->convert_date($_REQUEST['hidto']);
				$string.= " tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
			}
		
		else
		{
			$bydatz=$_REQUEST['hidbydate'];
			if($bydatz!="null")
			{
			//$search="";
		
		if($bydatz=="Last5days")
		{
			$string.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
			$typestring="Last 5 days";
		}elseif($bydatz=="Last10days")
		{
			$string.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
			$typestring="Last 10 days";
		}
		elseif($bydatz=="Last15days")
		{
			$string.=" tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
			$typestring="Last 15 days";
		}
		else if($bydatz=="Last20days")
		{
			$string.=" tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
			$typestring="Last 20 days";
		}
		else if($bydatz=="Last25days")
		{
			$string.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
			$typestring="Last 25 days";
		}
		else if($bydatz=="Last30days")
		{
			$string.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
			$typestring="Last 30 days";
		}
		else if($bydatz=="Today")
		{
			$string.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
			$typestring="Today";
		}
		else if($bydatz=="Yesterday")
		{
			$string.="tab_dayclosedate = CURDATE() - INTERVAL 1 DAY " ;
			$typestring="Yesterday";
		}
		 else if($bydatz=="Last1month")
		{
			$string.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			$typestring="Last 1 month";
		}
		else if($bydatz=="Last90days")
			{
				$string.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
				$typestring="Last 90 days"; 
			}
		else if($bydatz=="Last180days")
			{
				$string.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
				$typestring="Last 180 days";
			}
		else if($bydatz=="Last365days")
			{
				$string.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
				$typestring="Last 365 days";
			}
		}
		else
		{
			$from=date("Y-m-d");
				$to=date("Y-m-d");
				$string.= "tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
		}
		}
		  $cur=date("Y-m-d");
		  $sql_login  =  $database->mysqlQuery("select tbm.tab_billno,tbm.tab_dayclosedate,tbm.tab_cancelledreason,tbm.tab_netamt,ld.ls_staffid,sm.ser_firstname 
                            from tbl_takeaway_billmaster tbm left  join tbl_staffmaster sm on sm.ser_staffid=tbm.tab_cancelledby_careof left join
                            tbl_logindetails ld on ld.ls_username=tbm.tab_cancelledlogin where $string order by tbm.tab_dayclosedate"); 
		  $num_login   = $database->mysqlNumRows($sql_login);
		  if($num_login)
		  {
                                $print .= $center.$bold_on."Counter Sale".$bold_off."\n";
				$print .= $center.$bold_on."Total Cancelled Bill Report".$bold_off."\n";
				if($from=='' && $to=='')
				{
					$print .= $center.$bold_on.$typestring.$bold_off."\n";
				}
				else
				{
				$print .= $center.$bold_on.$from." To ".$to.$bold_off."\n";
				}
				/*$print .= "------------------------------------------------\n";
				$print .= "Slno    Date           Bilno               Final\n";
				$print .= "------------------------------------------------\n";*/
				
				$vv=str_pad("-",  '44%', "-");//46
				$print .= $left.$vv."\n";//ojin
				//$print .= $left."Slno  Date        Bilno              Final\n";
				
				
				$menulist= array(
					new menulist("Slno","Date","Bilno", "Final"),
				);
				foreach($menulist as $menulist) {
					$print .=$left.($menulist);
				}
				//$print .= $left."------------------------------------------\n";
				$print .= $left.$vv."\n";//ojin
				
				$final=0;$i=1;
				while($result_report  = mysqli_fetch_array($sql_login)) 
				{
					$final=$final + $result_report['tab_netamt'];
					$dt=explode("-",$result_report['tab_dayclosedate']);
					$date=$dt[2]."-".$dt[1]."-".$dt[0];
					
					$menulist= array(
						new menulist($i,$date,$result_report['tab_billno'],number_format($result_report['tab_netamt'],$_SESSION['be_decimal'])),
					);
					foreach($menulist as $menulist) {
						$print .=$left.($menulist);
					}
					
					
					
					
					//$print .= $left.$i."    ".$date."     ".$result_report['bm_billno']."   ".$result_report['bm_finaltotal']."\n";
					$i++;
				}
				$print .= $left.$vv."\n";//ojin
				$print .=$center."Total = ".$bold_on.number_format($final,$_SESSION['be_decimal']).$bold_off."\n";
				$print .= $left.$vv."\n";//ojin
				
				
				
				$print .="\n\n\n\n\n";
				$print.=$cutpaper;
				
				//And pr_floorid='".$florrid."'
				$sql_kots="Select * From tbl_printersettings  Where pr_branchid ='".$_SESSION['branchofid']."' and pr_printertype='".$_SESSION['reportprint_tp']."' ";
				$sql_kotss  =  mysqli_query($con,$sql_kots); 
				$num_kots  = mysqli_num_rows($sql_kotss);
				if($num_kots){	
				while($result_kots  = mysqli_fetch_array($sql_kotss)) 
						{
							if($result_kots['pr_defaultusb']=='Y')
							{
							  $printer="\\\\".$result_kots['pr_usbprinterip']."\\".$result_kots['pr_usbprinter'];
							  $fp=fopen($printer, 'w');
							  fwrite($fp,$print);
							  fclose($fp);
							}else
							{
								$fp = fsockopen($result_kots['pr_printerip'], $result_kots['pr_printerport'], $errno, $errstr, 10);
							  fwrite($fp,$print);
							  fclose($fp);
							}
						}
				}
				
				
		  }
        }
else if($_REQUEST['type']=="cancelhistory_cs")
	{
		$string='';
		$print='';
		$from='';
		$to='';
		$typestring='';
		 $date=date("Ymd");
		$string.="tbm.tab_mode='CS' and tbm.tab_status='Closed' and ";
			if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
			{
				$from=$database->convert_date($_REQUEST['hidfr']);
				$to=$database->convert_date($_REQUEST['hidto']);
				$string.= " ci.tc_dayclosedate between '".$from."' and '".$to."' ";
			}
			else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
			{
				$from=$database->convert_date($_REQUEST['hidfr']);
				$to=date("Y-m-d");
				$string.= " ci.tc_dayclosedate between '".$from."' and '".$to."' ";
			}
			else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
			{
				$from=date("Y-m-d");
				$to=$database->convert_date($_REQUEST['hidto']);
				$string.= " ci.tc_dayclosedate between '".$from."' and '".$to."' ";
			}
		
		else
		{
			$bydatz=$_REQUEST['hidbydate'];
			if($bydatz!="null")
			{
			//$search="";
		
		if($bydatz=="Last5days")
		{
			$string.="ci.tc_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
			$typestring="Last 5 days";
		}elseif($bydatz=="Last10days")
		{
			$string.="ci.tc_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
			$typestring="Last 10 days";
		}
		elseif($bydatz=="Last15days")
		{
			$string.=" ci.tc_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
			$typestring="Last 15 days";
		}
		else if($bydatz=="Last20days")
		{
			$string.=" ci.tc_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
			$typestring="Last 20 days";
		}
		else if($bydatz=="Last25days")
		{
			$string.=" ci.tc_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
			$typestring="Last 25 days";
		}
		else if($bydatz=="Last30days")
		{
			$string.=" ci.tc_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
			$typestring="Last 30 days";
		}
		else if($bydatz=="Today")
		{
			$string.=" ci.tc_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
			$typestring="Today";
		}
		else if($bydatz=="Yesterday")
		{
			$string.=" ci.tc_dayclosedate = CURDATE() - INTERVAL 1 DAY " ;
			$typestring="Yesterday";
		}
		 else if($bydatz=="Last1month")
		{
			$string.=" ci.tc_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			$typestring="Last 1 month";
		}
		else if($bydatz=="Last90days")
			{
				$string.=" ci.tc_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
				$typestring="Last 90 days"; 
			}
		else if($bydatz=="Last180days")
			{
				$string.=" ci.tc_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
				$typestring="Last 180 days";
			}
		else if($bydatz=="Last365days")
			{
				$string.=" ci.tc_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
				$typestring="Last 365 days";
			}
		}
		else
		{
			$from=date("Y-m-d");
				$to=date("Y-m-d");
				$string.= " ci.tc_dayclosedate between '".$from."' and '".$to."' ";
		}
		}
		  $cur=date("Y-m-d");
                  
                 
  
		  $sql_login  =  $database->mysqlQuery("select ci.tc_dayclosedate,sm.ser_firstname, mm.mr_menuname,tbm.tab_billno,tbd.tab_qty  FROM tbl_takeaway_cancel_items ci
                                        left join tbl_takeaway_billmaster tbm on tbm.tab_billno = ci.tc_billno
                                        left join tbl_takeaway_billdetails tbd on tbd.tab_billno = ci.tc_billno and ci.tc_bill_slno=tbd.tab_slno
                                        left join tbl_menumaster mm on  mm.mr_menuid = tbd.tab_menuid
                                        left join tbl_staffmaster sm ON sm.ser_staffid = ci.tc_cancelled_by                                        
                                        where $string order by tbm.tab_billno ASC " );  
		
                  $num_login   = $database->mysqlNumRows($sql_login);
		  if($num_login)
		  {
                                $print .= $center.$bold_on."Counter Sale".$bold_off."\n";
				$print .= $center.$bold_on."Item Cancel History Report".$bold_off."\n";
				if($from=='' && $to=='')
				{
					$print .= $center.$bold_on.$typestring.$bold_off."\n";
				}
				else
				{
				$print .= $center.$bold_on.$from." To ".$to.$bold_off."\n";
				}
				/*$print .= "------------------------------------------------\n";
				$print .= "Slno    Date           Bilno               Final\n";
				$print .= "------------------------------------------------\n";*/
				
				$vv=str_pad("-",'44%', "-");//46
				$print .= $left.$vv."\n";//ojin
				//$print .= $left."Slno  Date        Bilno              Final\n";
				
				
				$menulist= array(
					new menulist("Slno","Bill No","Item","Qty"),
				);
				foreach($menulist as $menulist) {
					$print .=$left.($menulist);
				}
				//$print .= $left."------------------------------------------\n";
				$print .= $left.$vv."\n";//ojin
				
				$final=0;$i=1;
				while($result_report  = mysqli_fetch_array($sql_login)) 
				{
					//$final=$final + $result_report['tab_amount'];
					$dt=explode("-",$result_report['tc_dayclosedate']);
					$date=$dt[2]."-".$dt[1]."-".$dt[0];
					
					
					$item=$result_report['mr_menuname'];
                                        $bill_no=$result_report['tab_billno'];
				
				//$result_report['qty'],$result_report['total']
					$menulist= array(
						new menulist1($i,$bill_no),
					);
					
                                       
						$menulist2= array(
						new menulist('','',$item,$result_report['tab_qty']),
					);
						
					
					foreach($menulist as $menulist) {
					$print .=$left.($menulist);
					
					foreach($menulist2 as $menulist2){
					$print .=$left.($menulist2);											
					}											
					}
					$i++;
				}
				$print .= $left.$vv."\n";//ojin
				$print .="\n\n\n\n\n";
				$print.=$cutpaper;
				
				//And pr_floorid='".$florrid."'
				$sql_kots="Select * From tbl_printersettings  Where pr_branchid ='".$_SESSION['branchofid']."' and pr_printertype='".$_SESSION['reportprint_tp']."' ";
				$sql_kotss  =  mysqli_query($con,$sql_kots); 
				$num_kots  = mysqli_num_rows($sql_kotss);
				if($num_kots){	
				while($result_kots  = mysqli_fetch_array($sql_kotss)) 
						{
							if($result_kots['pr_defaultusb']=='Y')
							{
							  $printer="\\\\".$result_kots['pr_usbprinterip']."\\".$result_kots['pr_usbprinter'];
							  $fp=fopen($printer, 'w');
							  fwrite($fp,$print);
							  fclose($fp);
							}else
							{
								$fp = fsockopen($result_kots['pr_printerip'], $result_kots['pr_printerport'], $errno, $errstr, 10);
							  fwrite($fp,$print);
							  fclose($fp);
							}
						}
				}
				
				
		  }
	}	
	else if($_REQUEST['type']=="itemordered_cs")
	{
            $string ="";
            $string.=" tbm.tab_status = 'Closed' and tbm.tab_mode='CS'";
            $from='';
            $to='';
            $reporthead="";
            $st="";
            $print='';
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
	  if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
		{
		  
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=$database->convert_date($_REQUEST['hidto']);
                        $string.= "and tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
			
		}
		else if($_REQUEST['hidfr']!="" && $_REQUEST['hidfr']=="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=date("Y-m-d");
                        $string.= "and tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
			
		}
		else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=$database->convert_date($_REQUEST['hidto']);
                        $string.= "and tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		
		}
                else{
                    
                    $bydatz=$_REQUEST['hidbydate'];
	
		    if($bydatz!="null" && $bydatz!="")
                    {
                        if($bydatz=="Last5days")
                        {
                            $string.="and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                            $st="Last5days";
                        }    
                        elseif($bydatz=="Last10days")
                        {   
                            $string.="and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";

                            $st="Last 10 days";
                        }
                        elseif($bydatz=="Last15days")
                        {
                            $string.="and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";

                            $st="Last 15 days";
                        }
                        else if($bydatz=="Last20days")
                        {
                            $string.="and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";

                            $st="Last 20 days";
                        }
                        else if($bydatz=="Last25days")
                        {
                            $string.="and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";

                            $st="Last 25 days";
                        }
                        else if($bydatz=="Last30days")
                        {
                            $string.="and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                            $st="Last 30 days";
                        }
                        else if($bydatz=="Today")
                        {
                            $string.="and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
                            $st="Today";
                        }

                        else if($bydatz=="Yesterday")
			{
                            $string.="and tbm.tab_dayclosedate = CURDATE( ) - INTERVAL 1 DAY ";
                            $st="Yesterday";
			}
                        else if($bydatz=="Last1month")
                        {
                           $string.="and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
                           $st="Last 1 Month"; 
                        }
                        else if($bydatz=="Last90days")
                        {
                            $string.="and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                            $st="Last 90 months";
                        }
                        else if($bydatz=="Last180days")
                        {
                            $string.="and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                            $st="Last 180 days";
                        }
                        else if($bydatz=="Last365days")
                        {
                            $string.="and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                            $st="Last 365 days";
                        }
                        $reporthead=$st;
                    }
                    else
                    {
                        $from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                    }        
                    }  
    
	$final=0;

 	  $sql_login  =  $database->mysqlQuery("SELECT mc.mmy_maincategoryname,ms.msy_subcategoryname,m.mr_menuname,p.pm_portionname,p.pm_portionshortcode,sum(tbd.tab_qty) as qty,ROUND(avg(tbd.tab_rate), 1) as Unit_Price,tbm.tab_netamt,((sum(tbd.tab_qty))*(ROUND(avg(tbd.tab_rate), 1))) as Sub_Total from tbl_takeaway_billmaster tbm left join tbl_takeaway_billdetails tbd on tbd.tab_billno = tbm.tab_billno left join tbl_menumaster m on m.mr_menuid = tbd.tab_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = m.mr_maincatid left join tbl_menusubcategory ms on ms.msy_subcategoryid = m.mr_subcatid left join tbl_portionmaster p on p.pm_id = tbd.tab_portion where $string $stringta_addon group by m.mr_maincatid ,m.mr_subcatid,tbd.tab_menuid,tbd.tab_portion ORDER BY mc.mmy_maincategoryname,m.mr_menuname ASC ");
      $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1;$t=0;$old="";
	  
	  
	  
                                $print .= $center.$bold_on."Counter Sale".$bold_off."\n";
				$print .= $center.$bold_on."Items Ordered Report".$addon_head.$bold_off."\n";
				if($from=='' && $to=='')
				{
					$print .= $center.$bold_on.$reporthead.$bold_off."\n";
				}
				else
				{
				$print .= $center.$bold_on.$from." To ".$to.$bold_off."\n";
				}
                             
				/*$print .= "------------------------------------------------\n";
				$print .= "Slno    Date           Bilno               Final\n";
				$print .= "------------------------------------------------\n";*/
				
				$vv=str_pad("-",'46%', "-");//46
				$print .= $left.$vv."\n";//ojin
				//$print .= $left."Slno  Date        Bilno              Final\n";
				
				
				$menulist= array(
					new itemordered("Item","Qty", "Total"),
				);
				foreach($menulist as $menulist) {
					$print .=$left.($menulist);
				}
				//$print .= $left."------------------------------------------\n";
//				$print .= $left.$vv."\n";//ojin
				
				$final=0;$i=1;$sub_total=0;
                                $old="";
                               
				while($result_report  = mysqli_fetch_array($sql_login)) 
				{       $sub_total=$sub_total + $result_report['Sub_Total'];
					$final=$final + $result_report['tab_netamt'];
					//$dt=explode("-",$result_report['tab_dayclosedate']);
					//$date=$dt[2]."-".$dt[1]."-".$dt[0];
					
//                                        $ln="";
                                        $maincatname = $result_report['mmy_maincategoryname'];
                                        if($result_report['mmy_maincategoryname']!=$old){
                                            $print .= $left.$vv."\n";
                                            $print .= $left.$bold_on."* * ".$maincatname.$bold_off."\n";
                                           
                                            $old = $result_report['mmy_maincategoryname'];
//                                            
                                            //-------------
//                                            
                                            //----------
                                            }else{
                                            $print .= "";
                                            $old = $result_report['mmy_maincategoryname'];
                                             }
                                            $item=$result_report['mr_menuname']."(".$result_report['pm_portionshortcode'].")";
                                                
                                            if(strlen($item)>29)
                                            {
                                            $item=substr($item,0,29);
                                                
                                            }
				//$result_report['qty'],$result_report['total']
					$menulist= array(
						new itemordered($item,$result_report['qty'],number_format($result_report['Sub_Total'],$_SESSION['be_decimal'])),
					);
					 	
						
					
					foreach($menulist as $menulist) {
					$print .=$left.($menulist);
					
					
					}
						
					
					
					
					
					
					
					//$print .= $left.$i."    ".$date."     ".$result_report['bm_billno']."   ".$result_report['bm_finaltotal']."\n";
					$i++;
				}
                     }		
	  
				
				
				$print .= $left.$vv."\n";
				$print .=$center.$bold_on."                             Total = ".number_format($sub_total,$_SESSION['be_decimal']).$bold_off.".00\n";
				//$print .=$center."Final-Total(inclusive of tax) = ".$bold_on.$final.$bold_off.".00\n";
                                $print .= $left.$vv."\n";//ojin
				
				
				
				$print .="\n\n\n\n\n";
				$print.=$cutpaper;
				
				//And pr_floorid='".$florrid."'
				$sql_kots="Select * From tbl_printersettings  Where pr_branchid ='".$_SESSION['branchofid']."' and pr_printertype='".$_SESSION['reportprint_tp']."' ";
				$sql_kotss  =  mysqli_query($con,$sql_kots); 
				$num_kots  = mysqli_num_rows($sql_kotss);
				if($num_kots){	
				while($result_kots  = mysqli_fetch_array($sql_kotss)) 
						{
							if($result_kots['pr_defaultusb']=='Y')
							{
							  $printer="\\\\".$result_kots['pr_usbprinterip']."\\".$result_kots['pr_usbprinter'];
							  $fp=fopen($printer, 'w');
							  fwrite($fp,$print);
							  fclose($fp);
							}else
							{
							  $fp = fsockopen($result_kots['pr_printerip'], $result_kots['pr_printerport'], $errno, $errstr, 10);
							  fwrite($fp,$print);
							  fclose($fp);
							}
						}
				}
	  
	  
		
        }
	else if($_REQUEST['type']=="complimentary_cs")
	{
		$string='';
		$print='';
		$from='';
		$to='';
		$typestring='';
		 $date=date("Ymd");
		$string.=" tab_status='Closed' AND tab_mode= 'CS' AND tab_complimentary='Y' ";
			if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
			{
				$from=$database->convert_date($_REQUEST['hidfr']);
				$to=$database->convert_date($_REQUEST['hidto']);
				$string.= " and tab_dayclosedate between '".$from."' and '".$to."' ";
			}
			else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
			{
				$from=$database->convert_date($_REQUEST['hidfr']);
				$to=date("Y-m-d");
				$string.= " and tab_dayclosedate between '".$from."' and '".$to."' ";
			}
			else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
			{
				$from=date("Y-m-d");
				$to=$database->convert_date($_REQUEST['hidto']);
				$string.= " and tab_dayclosedate between '".$from."' and '".$to."' ";
			}
		
		else
		{
			$bydatz=$_REQUEST['hidbydate'];
			if($bydatz!="null")
			{
			//$search="";
		
		if($bydatz=="Last5days")
		{
			$string.="and tab_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
			$typestring="Last 5 days";
		}elseif($bydatz=="Last10days")
		{
			$string.="and tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
			$typestring="Last 10 days";
		}
		elseif($bydatz=="Last15days")
		{
			$string.=" and tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
			$typestring="Last 15 days";
		}
		else if($bydatz=="Last20days")
		{
			$string.=" and tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
			$typestring="Last 20 days";
		}
		else if($bydatz=="Last25days")
		{
			$string.="and tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
			$typestring="Last 25 days";
		}
		else if($bydatz=="Last30days")
		{
			$string.="and tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
			$typestring="Last 30 days";
		}
		else if($bydatz=="Today")
		{
			$string.="and tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
			$typestring="Today";
		}
		else if($bydatz=="Yesterday")
		{
			$string.="and tab_dayclosedate = CURDATE() - INTERVAL 1 DAY " ;
			$typestring="Yesterday";
		}
		 else if($bydatz=="Last1month")
		{
			$string.="and tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			$typestring="Last 1 month";
		}
		else if($bydatz=="Last90days")
			{
				$string.="and tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
				$typestring="Last 90 days"; 
			}
		else if($bydatz=="Last180days")
			{
				$string="and tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
				$typestring="Last 180 days";
			}
		else if($bydatz=="Last365days")
			{
				$string.="and tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
				$typestring="Last 365 days";
			}
		}
		else
		{
			$from=date("Y-m-d");
				$to=date("Y-m-d");
				$string.= "and tab_dayclosedate between '".$from."' and '".$to."' ";
		}
		}
		  $cur=date("Y-m-d");
		  $sql_login  =  $database->mysqlQuery("select tab_total,tab_dayclosedate,tab_billno from tbl_takeaway_billmaster where $string order by tab_dayclosedate"); 
		  $num_login   = $database->mysqlNumRows($sql_login);
		  if($num_login)
		  {
				$print .= $center.$bold_on."Complimentary report".$bold_off."\n";
				if($from=='' && $to=='')
				{
					$print .= $center.$bold_on.$typestring.$bold_off."\n";
				}
				else
				{
				$print .= $center.$bold_on.$from." To ".$to.$bold_off."\n";
				}
				/*$print .= "------------------------------------------------\n";
				$print .= "Slno    Date           Bilno               Final\n";
				$print .= "------------------------------------------------\n";*/
				
				$vv=str_pad("-",  '44%', "-");//46
				$print .= $left.$vv."\n";//ojin
				//$print .= $left."Slno  Date        Bilno              Final\n";
				$menulist= array(
					new menulist("Slno","Date","Bilno", "Final"),
				);
				foreach($menulist as $menulist) {
					$print .=$left.($menulist);
				}
				//$print .= $left."------------------------------------------\n";
				$print .= $left.$vv."\n";//ojin
				
				$final=0;$i=1;
				while($result_report  = mysqli_fetch_array($sql_login)) 
				{
					$final=$final + $result_report['tab_total'];
					$dt=explode("-",$result_report['tab_dayclosedate']);
					$date=$dt[2]."-".$dt[1]."-".$dt[0];
					
					$menulist= array(
						new menulist($i,$date,$result_report['tab_billno'],number_format($result_report['tab_total'],$_SESSION['be_decimal'])),
					);
					foreach($menulist as $menulist) {
						$print .=$left.($menulist);
					}

					//$print .= $left.$i."    ".$date."     ".$result_report['bm_billno']."   ".$result_report['bm_finaltotal']."\n";
					$i++;
				}
				$print .= $left.$vv."\n";//ojin
				$print .=$center."Total = ".$bold_on.number_format($final,$_SESSION['be_decimal']).$bold_off."\n";
				$print .= $left.$vv."\n";//ojin
				
				
				
				$print .="\n\n\n\n\n";
				$print.=$cutpaper;
				
				//And pr_floorid='".$florrid."'
				$sql_kots="Select * From tbl_printersettings  Where pr_branchid ='".$_SESSION['branchofid']."' and pr_printertype='".$_SESSION['reportprint_tp']."' ";
				$sql_kotss  =  mysqli_query($con,$sql_kots); 
				$num_kots  = mysqli_num_rows($sql_kotss);
				if($num_kots){	
				while($result_kots  = mysqli_fetch_array($sql_kotss)) 
						{
							if($result_kots['pr_defaultusb']=='Y')
							{
							  $printer="\\\\".$result_kots['pr_usbprinterip']."\\".$result_kots['pr_usbprinter'];
							  $fp=fopen($printer, 'w');
							  fwrite($fp,$print);
							  fclose($fp);
							}else
							{
								$fp = fsockopen($result_kots['pr_printerip'], $result_kots['pr_printerport'], $errno, $errstr, 10);
							  fwrite($fp,$print);
							  fclose($fp);
							}
						}
				}
				
				
		  }
	}
	
	if($_REQUEST['type']=="billreport_cs")
	{
		$string='';
		$print='';
		$from='';
		$to='';
		$typestring='';
		 $date=date("Ymd");
		$string="tbm.tab_mode='CS' and tbm.tab_status='Closed' ";
			if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
			{
				$from=$database->convert_date($_REQUEST['hidfr']);
				$to=$database->convert_date($_REQUEST['hidto']);
				$string.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
			}
			else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
			{
				$from=$database->convert_date($_REQUEST['hidfr']);
				$to=date("Y-m-d");
				$string.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
			}
			else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
			{
				$from=date("Y-m-d");
				$to=$database->convert_date($_REQUEST['hidto']);
				$string.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
			}
		
		else
		{
			$bydatz=$_REQUEST['hidbydate'];
			if($bydatz!="null")
			{
			//$search="";
		
		if($bydatz=="Last5days")
		{
			$string.="and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
			$typestring="Last 5 days";
		}elseif($bydatz=="Last10days")
		{
			$string.="and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
			$typestring="Last 10 days";
		}
		elseif($bydatz=="Last15days")
		{
			$string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
			$typestring="Last 15 days";
		}
		else if($bydatz=="Last20days")
		{
			$string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
			$typestring="Last 20 days";
		}
		else if($bydatz=="Last25days")
		{
			$string.="and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
			$typestring="Last 25 days";
		}
		else if($bydatz=="Last30days")
		{
			$string.="and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
			$typestring="Last 30 days";
		}
		else if($bydatz=="Today")
		{
			$string.="and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
			$typestring="Today";
		}
		else if($bydatz=="Yesterday")
		{
			$string.="and tbm.tab_dayclosedate = CURDATE() - INTERVAL 1 DAY " ;
			$typestring="Yesterday";
		}
		 else if($bydatz=="Last1month")
		{
			$string.="and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			$typestring="Last 1 month";
		}
		else if($bydatz=="Last90days")
			{
				$string.="and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
				$typestring="Last 90 days"; 
			}
		else if($bydatz=="Last180days")
			{
				$string="and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
				$typestring="Last 180 days";
			}
		else if($bydatz=="Last365days")
			{
				$string.="and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
				$typestring="Last 365 days";
			}
		}
		else
		{
			$from=date("Y-m-d");
				$to=date("Y-m-d");
				$string.= "and tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
		}
		}
		  $cur=date("Y-m-d");
		  $sql_login  =  $database->mysqlQuery("select tab_total,tab_dayclosedate,tab_billno from tbl_takeaway_billmaster where $string order by tab_dayclosedate"); 
		  $num_login   = $database->mysqlNumRows($sql_login);
		  if($num_login)
		  {
			  
				$print .= $center.$bold_on."Bill report".$bold_off."\n";
				if($from=='' && $to=='')
				{
					$print .= $center.$bold_on.$typestring.$bold_off."\n";
				}
				else
				{
				$print .= $center.$bold_on.$from." To ".$to.$bold_off."\n";
				}
				/*$print .= "------------------------------------------------\n";
				$print .= "Slno    Date           Bilno               Final\n";
				$print .= "------------------------------------------------\n";*/
				
				$vv=str_pad("-",  '44%', "-");//46
				$print .= $left.$vv."\n";//ojin
				//$print .= $left."Slno  Date        Bilno              Final\n";
				
				
				$menulist= array(
					new menulist("Slno","Date","Bilno", "Final"),
				);
				foreach($menulist as $menulist) {
					$print .=$left.($menulist);
				}
				//$print .= $left."------------------------------------------\n";
				$print .= $left.$vv."\n";//ojin
				
				$final=0;$i=1;
				while($result_report  = mysqli_fetch_array($sql_login)) 
				{
					$final=$final + $result_report['tab_total'];
					$dt=explode("-",$result_report['tab_dayclosedate']);
					$date=$dt[2]."-".$dt[1]."-".$dt[0];
					
					$menulist= array(
						new menulist($i,$date,$result_report['tab_billno'],number_format($result_report['tab_total'],$_SESSION['be_decimal'])),
					);
					foreach($menulist as $menulist) {
						$print .=$left.($menulist);
					}
					$i++;
				}
				$print .= $left.$vv."\n";//ojin
				$print .=$center."Total = ".$bold_on.number_format($final,$_SESSION['be_decimal']).$bold_off."\n";
				$print .= $left.$vv."\n";//ojin
				
				
				
				$print .="\n\n\n\n\n";
				$print.=$cutpaper;
				
				//And pr_floorid='".$florrid."'
				$sql_kots="Select * From tbl_printersettings  Where pr_branchid ='".$_SESSION['branchofid']."' and pr_printertype='".$_SESSION['reportprint_tp']."' ";
				$sql_kotss  =  mysqli_query($con,$sql_kots); 
				$num_kots  = mysqli_num_rows($sql_kotss);
				if($num_kots){	
				while($result_kots  = mysqli_fetch_array($sql_kotss)) 
						{
							if($result_kots['pr_defaultusb']=='Y')
							{
							  $printer="\\\\".$result_kots['pr_usbprinterip']."\\".$result_kots['pr_usbprinter'];
							  $fp=fopen($printer, 'w');
							  fwrite($fp,$print);
							  fclose($fp);
							}else
							{
								$fp = fsockopen($result_kots['pr_printerip'], $result_kots['pr_printerport'], $errno, $errstr, 10);
							  fwrite($fp,$print);
							  fclose($fp);
							}
						}
				}
				
				
		  }
	}	

        
     if($_REQUEST['type']=="summary_cs")
	{
		$string='';
		$print='';
		$from='';
		$to='';
		$typestring='';
		  $string='';
        $reporthead="";
	$strings="tab_status='Closed' AND tab_mode='CS' AND ";
	$string_pax="";
	$string_pax="tab_status='Closed' AND ";
	
	$string1_str=" (sum(tab_amountpaid) - sum(tab_amountbalace)) ";
	$string2_str=" sum(tab_transactionamount) ";
	$string3_str=" (sum(tab_netamt)-(sum(tab_amountpaid)-sum(tab_amountbalace))) ";
	$string4_str=" (sum(tab_netamt)-(sum(tab_amountpaid)-sum(tab_amountbalace))) ";
	$string5_str=" (sum(tab_netamt)-(sum(tab_amountpaid)-sum(tab_amountbalace))) ";
	$string6_str=" (sum(tab_netamt)-(sum(tab_amountpaid)-sum(tab_amountbalace))) ";
        $string7_str=" sum(tab_netamt)";
	
	$string1 =$strings. " ((pym_code='cash') or (pym_code='credit') or (pym_code='coupon') or (pym_code='voucher') or (pym_code='cheque') or (pym_code='credit_person') or (pym_code='complimentary')   ) AND ";
	$string2 =" pym_code='credit'  AND";//bm_paymode='credit' AND//"credit"  bm_transactionamount <>''
	$string3 =$strings. " pym_code='coupon'  AND";//"coupons"  bm_couponcompany <>''  and bm_couponamt <>'0.00'
	$string4 =$strings. " pym_code='voucher' AND";//"voucher" bm_voucherid <>''
	$string5 =$strings. " pym_code='cheque' AND";//"cheque" bm_chequeno <>'' and bm_chequebankname<>''
	$string6=$strings. " pym_code='credit_person' AND ";
	$string7=$strings. " pym_code='complimentary' AND";
	
			if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
			{
				$from=$database->convert_date($_REQUEST['hidfr']);
				$to=$database->convert_date($_REQUEST['hidto']);
				$string.= " tab_dayclosedate between '".$from."' and '".$to."' ";
				$string_pax.= "  (tab_dayclosedate  between '".$from."' and '".$to."' ) ";
				$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to) ; 
			}
			else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
			{
				$from=$database->convert_date($_REQUEST['hidfr']);
				$to=date("Y-m-d");
				$string.= " tab_dayclosedate between '".$from."' and '".$to."' ";
				$string_pax.= "  (tab_dayclosedate between '".$from."' and '".$to."' ) ";
				$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to) ; 
			}
			else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
			{
				$from=date("Y-m-d");
				$to=$database->convert_date($_REQUEST['hidto']);
				$string.= " tab_dayclosedate between '".$from."' and '".$to."' ";
				
				$string_pax.= "  (tab_dayclosedate  between '".$from."' and '".$to."' ) ";
				$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to) ; 
			}
		
		else
		{
			$bydatz=$_REQUEST['hidbydate'];
			
			if($bydatz!="null")
			{
			//$search="";
		
		if($bydatz=="Last5days")
		{
			$string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
			$string_pax.= "tab_dayclosedate  between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
			$typestring="Last 5 days";
		}elseif($bydatz=="Last10days")
		{
			$string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
			$string_pax.= "tab_dayclosedate  between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
			$typestring="Last 10 days";
		}
		elseif($bydatz=="Last15days")
		{
			$string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
			$string_pax.= "tab_dayclosedate  between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
			$typestring="Last 15 days";
		}
		else if($bydatz=="Last20days")
		{
			$string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
			$string_pax.= "tab_dayclosedate  between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
			$typestring="Last 20 days";
		}
		else if($bydatz=="Last25days")
		{
			$string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
			$string_pax.= "tab_dayclosedate  between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
			$typestring="Last 25 days";
		}
		else if($bydatz=="Last30days")
		{
			$string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
			$string_pax.= " tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
			$typestring="Last 30 days";
		}
		else if($bydatz=="Today")
		{
			$string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
			$string_pax.= "tab_dayclosedate between  CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
			$typestring="Today";
		}
		else if($bydatz=="Yesterday")
		{
			$string.=" tab_dayclosedate = CURDATE() - INTERVAL 1 DAY " ;
			$string_pax.= "tab_dayclosedate = CURDATE() - INTERVAL 1 DAY " ;
			$typestring="Yesterday";
		}
		 else if($bydatz=="Last1month")
		{
			$string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			$string_pax.= "tab_dayclosedate between  CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			$typestring="Last 1 month";
		}
		else if($bydatz=="Last90days")
			{
				$string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
				$string_pax.= " tab_dayclosedate  between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
				$typestring="Last 90 days"; 
			}
		else if($bydatz=="Last180days")
			{
				$string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
				$string_pax.= "tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
				$typestring="Last 180 days";
			}
		else if($bydatz=="Last365days")
			{
				$string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
				$string_pax.= "tab_dayclosedate  between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
				$typestring="Last 365 days";
			}
		}
		else
		{
			$from=date("Y-m-d");
				$to=date("Y-m-d");
				$string.= " btab_dayclosedate between '".$from."' and '".$to."' ";
				$string_pax.= " tab_dayclosedate   between '".$from."' and '".$to."'";
		}
		}
		  $cur=date("Y-m-d");
		  //$print .= $center.$bold_on.$branchname.$bold_off."\n";
                  $print .= $center.$bold_on."Counter Sale".$bold_off."\n";
		  $print .= $center.$bold_on."Summary".$bold_off."\n";
				if($from=='' && $to=='')
				{
					$print .= $center.$bold_on.$typestring.$bold_off."\n";
				}
				else
				{
				$print .= $center.$bold_on.$database->convert_date($from)." To ".$database->convert_date($to).$bold_off."\n";
				}
			
				$vv=str_pad("-",'46%',"-");//46
				$print .= $left.$vv."\n";//ojin
				$bilno= array(
					new bilno("Type","Value"),
				);
				foreach($bilno as $bilno) {
					$print .=$left.($bilno);
				}
				$print .= $left.$vv."\n";//ojin
				$final=0;$i=1;
		  
		  
		  $sql_login  =  $database->mysqlQuery("select $string1_str as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tb.tab_paymode=tbl_paymentmode.pym_id   where $string1"."$string order by tab_dayclosedate,tab_time ASC"); 
                  
		  $num_login   = $database->mysqlNumRows($sql_login);
		  if($num_login)
		  {
				
				while($result_report  = mysqli_fetch_array($sql_login)) 
				{
					if($result_report['tot'] != "")
			{
					$subtotal =$subtotal + $result_report['tot'];
					
					
					
					
					$bilno= array(
						new bilno("Cash",number_format($result_report['tot'],$_SESSION['be_decimal'])),
					);
					foreach($bilno as $bilno) {
						$print .=$left.($bilno);
					}
					$i++;
				}
		  }}
	  
		  $sql_login1  =  $database->mysqlQuery("select bm_name as bank_name, (sum(tab_transactionamount)) as tot from tbl_takeaway_billmaster tb left join tbl_paymentmode on tb.tab_paymode=tbl_paymentmode.pym_id  , tbl_bankmaster b  where  b.bm_id = tb.tab_transcbank and tb.tab_status='Closed' AND $string2 "."$string order by tb.tab_dayclosedate,tb.tab_time ASC "); 
	      
	  $num_login1   = $database->mysqlNumRows($sql_login1);
		  
		    if($num_login1)
		  {
				
				while($result_report1  = mysqli_fetch_array($sql_login1)) 
				{
				        if($result_report1['tot'] != "")
                                        {
					$subtotal =$subtotal + $result_report1['tot'];
					$bilno= array(
						new bilno("Card",number_format($result_report1['tot'],$_SESSION['be_decimal'] )),
					);
					foreach($bilno as $bilno) {
						$print .=$left.($bilno);
					}
					$i++;
                                        }
                               }
                  }
		  
                 $sql_logincreditta  =  $database->mysqlQuery("select distinct (b.bm_name) as bnk, sum(bc.mc_cardamount) as tot  FROM 
                                                    tbl_takeaway_billmaster bm 
                                                    left join tbl_paymentmode on bm.tab_paymode=tbl_paymentmode.pym_id 
                                                    left join tbl_bill_card_payments bc on bc.mc_billno=bm.tab_billno
                                                    left join tbl_bankmaster b  on  b.bm_id = bc.mc_to_bank 
                                                    where tbl_paymentmode.pym_code='credit' and bm.tab_mode='CS'
                                                    and bm.tab_status='Closed' AND bm.tab_complimentary!='Y' AND $string group by bnk");
                      


                  $num_logincreditta   = $database->mysqlNumRows($sql_logincreditta);
                  if($num_logincreditta){
                          while($result_logincreditta  = $database->mysqlFetchArray($sql_logincreditta)) 
                                {  
                             
                              
            $bilno= array(
						new bilno($result_logincreditta['bnk'],number_format($result_logincreditta['tot'],$_SESSION['be_decimal'] )),
					);
					foreach($bilno as $bilno) {
						$print .=$left.($bilno);
					}
					$i++;
            
            
           
                          }
                          }
                  
                  
		  
		   $sql_login  =  $database->mysqlQuery("select $string6_str as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $string6"." $string order by tab_dayclosedate,tab_time ASC"); 
		  
		  $num_login   = $database->mysqlNumRows($sql_login);
		  if($num_login)
		  {
				
				while($result_report2  = mysqli_fetch_array($sql_login)) 
				{
					if($result_report2['tot'] != "")
			{
					$subtotal =$subtotal + $result_report2['tot'];
					$bilno= array(
						new bilno("Credits -",number_format($result_report2['tot'],$_SESSION['be_decimal'] )),
					);
					foreach($bilno as $bilno) {
						$print .=$left.($bilno);
					}
					$i++;
				}
		  }}
		  
		  
		   $sql_login  =  $database->mysqlQuery("select $string3_str as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $string3"." $string order by tab_dayclosedate,tab_time ASC"); 
		  $num_login   = $database->mysqlNumRows($sql_login);
		  if($num_login)
		  {
				
				while($result_report3  = mysqli_fetch_array($sql_login)) 
				{
						if($result_report3['tot'] != "")
			{
					$subtotal =$subtotal + $result_report3['tot'];
					$bilno= array(
						new bilno("Coupons",number_format($result_report3['tot'],$_SESSION['be_decimal'])),
					);
					foreach($bilno as $bilno) {
						$print .=$left.($bilno);
					}
					$i++;
				}
		  }}
		  
		   $sql_login  =  $database->mysqlQuery("select $string5_str as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $string5"." $string order by tab_dayclosedate,tab_time ASC"); 
		  $num_login   = $database->mysqlNumRows($sql_login);
		  if($num_login)
		  {
				
				while($result_report4  = mysqli_fetch_array($sql_login)) 
				{
						if($result_report4['tot'] != "")
						{
					$subtotal =$subtotal + $result_report4['tot'];
					$bilno= array(
						new bilno("Voucher",number_format($result_report4['tot'],$_SESSION['be_decimal'])),
					);
					foreach($bilno as $bilno) {
						$print .=$left.($bilno);
					}
					$i++;
				}
		  }}
		  
		   $sql_login  =  $database->mysqlQuery("select $string5_str as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $string5"." $string order by tab_dayclosedate,tab_time ASC"); 
		  $num_login   = $database->mysqlNumRows($sql_login);
		  if($num_login)
		  {
				
				while($result_report5  = mysqli_fetch_array($sql_login)) 
				{
						if($result_report5['tot'] != "")
						{
					$subtotal =$subtotal + $result_report5['tot'];
					$bilno= array(
						new bilno("Cheque",number_format($result_report5['tot'],$_SESSION['be_decimal'])),
					);
					foreach($bilno as $bilno) {
						$print .=$left.($bilno);
					}
					$i++;
				}
		  }}
                  ///cpmplimentary-----------
            $sql_login  =  $database->mysqlQuery("select $string7_str as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $string7"." $string order by tab_dayclosedate,tab_time ASC");                  
			$num_login   = $database->mysqlNumRows($sql_login);
		  if($num_login)
		  {
				
				while($result_report6  = mysqli_fetch_array($sql_login)) 
				{
					if($result_report6['tot'] != "")
			{
					$subtotal =$subtotal + $result_report6['tot'];
					
					
					
					
					$bilno= array(
						new bilno("Complimetary",number_format($result_report6['tot'],$_SESSION['be_decimal'])),
					);
					foreach($bilno as $bilno) {
						$print .=$left.($bilno);
					}
					$i++;
				}
		  }}
                 
		  
		  
				$print .= $left.$vv."\n";//ojin
				$print .=$center."Total = ".$bold_on.number_format($subtotal,$_SESSION['be_decimal']).$bold_off."\n";
				$print .= $left.$vv."\n";//ojin

				$print .="\n\n\n\n\n";
				$print.=$cutpaper;
				
				//And pr_floorid='".$florrid."'
				$sql_kots="Select * From tbl_printersettings  Where pr_branchid ='".$_SESSION['branchofid']."' and pr_printertype='".$_SESSION['reportprint_tp']."' ";
				$sql_kotss  =  mysqli_query($con,$sql_kots); 
				$num_kots  = mysqli_num_rows($sql_kotss);
				if($num_kots){	
				while($result_kots  = mysqli_fetch_array($sql_kotss)) 
						{
							if($result_kots['pr_defaultusb']=='Y')
							{
							  $printer="\\\\".$result_kots['pr_usbprinterip']."\\".$result_kots['pr_usbprinter'];
							  $fp=fopen($printer, 'w');
							  fwrite($fp,$print);
							  fclose($fp);
							}else
							{
								$fp = fsockopen($result_kots['pr_printerip'], $result_kots['pr_printerport'], $errno, $errstr, 10);
							  fwrite($fp,$print);
							  fclose($fp);
							}
						}
				}
				
				
		  
	}
           
 else if($_REQUEST['type']=="categorywise_report_cs")
	{
            $string ="";
            $string.=" tbm.tab_status = 'Closed' and tbm.tab_mode='CS'";
            $from='';
            $to='';
            $reporthead="";
            $st="";
	  $vv='';
          $print='';
	  if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
		{
		  
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=$database->convert_date($_REQUEST['hidto']);
                        $string.= "and tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
			
		}
		else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=date("Y-m-d");
                        $string.= "and tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
			
		}
		else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=$database->convert_date($_REQUEST['hidto']);
                        $string.= "and tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		
		}
                else{
                    
                    $bydatz=$_REQUEST['hidbydate'];
	
		    if($bydatz!="null")
                    {
                        if($bydatz=="Last5days")
                        {
                            $string.="and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                            $st="Last5days";
                        }    
                        elseif($bydatz=="Last10days")
                        {   
                            $string.="and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";

                            $st="Last 10 days";
                        }
                        elseif($bydatz=="Last15days")
                        {
                            $string.="and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";

                            $st="Last 15 days";
                        }
                        else if($bydatz=="Last20days")
                        {
                            $string.="and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";

                            $st="Last 20 days";
                        }
                        else if($bydatz=="Last25days")
                        {
                            $string.="and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";

                            $st="Last 25 days";
                        }
                        else if($bydatz=="Last30days")
                        {
                            $string.="and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                            $st="Last 30 days";
                        }
                        else if($bydatz=="Today")
                        {
                            $string.="and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
                            $st="Today";
                        }

                        else if($bydatz=="Yesterday")
			{
                            $string.="and tbm.tab_dayclosedate = CURDATE( ) - INTERVAL 1 DAY ";
                            $st="Yesterday";
			}
                        else if($bydatz=="Last1month")
                        {
                           $string.="and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
                           $st="Last 1 Month"; 
                        }
                        else if($bydatz=="Last90days")
                        {
                            $string.="and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                            $st="Last 90 months";
                        }
                        else if($bydatz=="Last180days")
                        {
                            $string.="and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                            $st="Last 180 days";
                        }
                        else if($bydatz=="Last365days")
                        {
                            $string.="and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                            $st="Last 365 days";
                        }
                        $reporthead=$st;
                    }
                    else
                    {
                        $from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                    }        
                    }  
    
	$final=0;
        $total=0;

 	  $sql_login  =  $database->mysqlQuery("SELECT mc.mmy_maincategoryname,count(distinct(tbd.tab_menuid)) as 'no of items',sum(tbd.tab_qty) as qty ,sum(tbd.tab_qty* tbd.tab_rate) as Total from tbl_takeaway_billmaster tbm left join tbl_takeaway_billdetails tbd on tbd.tab_billno = tbm.tab_billno left join tbl_menumaster on mr_menuid =tbd.tab_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = mr_maincatid where $string group by mr_maincatid ORDER BY mr_maincatid ASC ");
      $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1;$t=0;
	  
	  
	  
                                $print .= $center.$bold_on."Counter Sale".$bold_off."\n";
				$print .= $center.$bold_on."Category Wise Report".$bold_off."\n";
				if($from=='' && $to=='')
				{
					$print .= $center.$bold_on.$reporthead.$bold_off."\n";
				}
				else
				{
				$print .= $center.$bold_on.$from." To ".$to.$bold_off."\n";
				}
                             
				/*$print .= "------------------------------------------------\n";
				$print .= "Slno    Date           Bilno               Final\n";
				$print .= "------------------------------------------------\n";*/
				
				$vv=str_pad("-",  '48%', "-");//46
				$print .= $left.$vv."\n";//ojin
				//$print .= $left."Slno  Date        Bilno              Final\n";
				
				
				$menulist= array(
					new cat_wise("Slno"," Category ","  Qty","  Total")
				);
				foreach($menulist as $menulist) {
					$print .=$left.($menulist);
				}
				//$print .= $left."------------------------------------------\n";
				$print .= $vv."\n";//ojin
				
				$final=0;$i=1;$total=0;
                               
                               
				while($result_report  = mysqli_fetch_array($sql_login)) 
				{       $total=$total + $result_report['Total'];
			                //$final=$final + $result_report['Final'];
					//$dt=explode("-",$result_report['tab_dayclosedate']);
					//$date=$dt[2]."-".$dt[1]."-".$dt[0];
                                        $main_cat=$result_report['mmy_maincategoryname'];
                                        $main_cat1=substr($main_cat,0,24);
					$menulist= array(
						new cat_wise($i,$main_cat1,$result_report['qty'],number_format($result_report['Total'],$_SESSION['be_decimal']))
                                            
					);
					 	
						
					
					foreach($menulist as $menulist) {
					$print .=$left.($menulist);
					
					
						
					
					}
					
					
					
					
					//$print .= $left.$i."    ".$date."     ".$result_report['bm_billno']."   ".$result_report['bm_finaltotal']."\n";
					$i++;
				}
                     }		
	  
				
				
				$print .= $left.$vv."\n";
				$print .=$center."                             Total = ".$bold_on.number_format($total,$_SESSION['be_decimal']).$bold_off.".00\n";
				//$print .=$center."                       Final-Total = ".$bold_on.$final.$bold_off.".00\n";
                                $print .= $left.$vv."\n";//ojin
				
				
				
				$print .="\n\n\n\n\n";
				$print.=$cutpaper;
				
				//And pr_floorid='".$florrid."'
				$sql_kots="Select * From tbl_printersettings  Where pr_branchid ='".$_SESSION['branchofid']."' and pr_printertype='".$_SESSION['reportprint_tp']."' ";
				$sql_kotss  =  mysqli_query($con,$sql_kots); 
				$num_kots  = mysqli_num_rows($sql_kotss);
				if($num_kots){	
				while($result_kots  = mysqli_fetch_array($sql_kotss)) 
						{
							if($result_kots['pr_defaultusb']=='Y')
							{
							  $printer="\\\\".$result_kots['pr_usbprinterip']."\\".$result_kots['pr_usbprinter'];
							  $fp=fopen($printer, 'w');
							  fwrite($fp,$print);
							  fclose($fp);
							}else
							{
							  $fp = fsockopen($result_kots['pr_printerip'], $result_kots['pr_printerport'], $errno, $errstr, 10);
							  fwrite($fp,$print);
							  fclose($fp);
							}
						}
				}
	  
	  
		
        }
        }
                        else{
                            echo "**failed**Report Printing Failed: " .$printer_kotname_bill[$key]."( ".$printer_kotip_bill[$key]." )";
                        }
                			 
				  
	
	}
        }
        else{
            echo "**failed**Printer Status Is Off";
        }
  }
class menulist {
    private $product;
    private $qty;
    private $rate;
    private $amount;
    private $style;

    public function __construct($product = '', $qty = '', $rate = '', $amount = '', $style='') {
        $this -> product = $product;
        $this -> qty = $qty;
        $this -> rate = $rate;
	$this -> amount = $amount;
        $this -> style = $style;
    }

    public function __toString() {
        if($this -> style=='1'){
        $leftCols ="5%";
	$leftCols1 ="12%";
        $rightCols ="15%";
	$rightCols1 ="14%";
        }
        else if($this -> style=='2'){
           $leftCols ="5%";
	$leftCols1 ="13%";
        $rightCols ="13%";
	$rightCols1 ="10%"; 
        }
		/*$leftCols ="5%";
		$leftCols1 ="12%";
        $rightCols ="14%";
		$rightCols1 ="12%";*/
		
		
        $left = str_pad($this -> product, $leftCols,' ', STR_PAD_BOTH) ;
		$left1 = str_pad($this -> qty, $leftCols1,' ', STR_PAD_BOTH) ;
		$right = str_pad($this -> rate, $rightCols,' ', STR_PAD_BOTH) ;
		$right1 = str_pad($this -> amount, $rightCols1,' ', STR_PAD_LEFT) ;
        return "$left$left1$right$right1\n";
    }
}


class menulist1 {
    private $product;
    private $qty;
  

    public function __construct($product = '', $qty = '') {
        $this -> product = $product;
        $this -> qty = $qty;
      
	
    }

    public function __toString() {
        $leftCols ="5%";
		$leftCols1 ="40%";
        
		/*$leftCols ="5%";
		$leftCols1 ="12%";
        $rightCols ="14%";
		$rightCols1 ="12%";*/
		
		
        $left = str_pad($this -> product, $leftCols,' ', STR_PAD_RIGHT) ;
		$left1 = str_pad($this -> qty, $leftCols1,' ', STR_PAD_RIGHT) ;
		/*$right = str_pad($this -> rate, $rightCols,' ', STR_PAD_BOTH) ;
		$right1 = str_pad($this -> amount, $rightCols1,' ', STR_PAD_BOTH) ;
			$right12 = str_pad($this -> total, $rightCols2,' ', STR_PAD_BOTH) ;*/
        return "$left$left1\n";
    }
}





class menulist2 {
	private $flr;
	  private $itm;
    private $qty;
    private $tot;



    public function __construct($flr='',$itm ='', $qty = '', $tot = '') {
		$this ->flr=$flr;
       $this -> itm = $itm;
        $this -> qty = $qty;
       $this -> tot = $tot;
    }

    public function __toString() {
		
		
	$leftCols ="5%";
		$leftCols1= "20";
		$leftCols2 ="10%";
        $rightCols ="10%";

      
		
		/*$leftCols ="5%";
		$leftCols1 ="12%";
        $rightCols ="14%";
		$rightCols1 ="12%";*/
		   $left = str_pad($this -> flr, $leftCols,' ', STR_PAD_BOTH) ;
		
        $left1 = str_pad($this -> itm, $leftCols1,' ', STR_PAD_BOTH) ;
		
		$left2 = str_pad($this -> qty, $leftCols2,' ', STR_PAD_BOTH) ;
		$right = str_pad($this -> tot, $rightCols,' ', STR_PAD_BOTH) ;
	
        return "$left$left1$left2$right\n";
    }
}



class bilno {
    private $name;
    private $price;

    public function __construct($name = '', $price = '') {
        $this -> name = $name;
        $this -> price = $price;
    }

    public function __toString() {
        $leftCols = '33%';//32-ojin    33-bbq
        $rightCols = '13%';//10-ojin   13-bbq
        $left = str_pad($this -> name, $leftCols) ;
		//$center = str_pad(":", $centerCols) ;
        $right = str_pad($this -> price, $rightCols,' ', STR_PAD_LEFT);
        return "$left$right\n";
    }
}
class cat_wise {
    private $product;
    private $qty;
    private $rate;
    private $amount;

    public function __construct($product = '', $qty = '', $rate = '', $amount = '') {
        $this -> product = $product;
        $this -> qty = $qty;
        $this -> rate = $rate;
        $this -> amount = $amount;
    }

    public function __toString() {
        $leftCols ="4%";
	$leftCols1 ="21%";
        $rightCols ="14%";
	$rightCols1 ="8%";
		
		
		
        $left = str_pad($this -> product, $leftCols,' ', STR_PAD_BOTH) ;
		$left1 = str_pad($this -> qty, $leftCols1,' ', STR_PAD_BOTH) ;
		$right = str_pad($this -> rate, $rightCols,' ', STR_PAD_BOTH) ;
		$right1 = str_pad($this -> amount, $rightCols1,' ', STR_PAD_BOTH) ;
        return "$left$left1$right$right1\n";
    }
}
class itemordered {
    private $product;
    private $qty;
    private $rate;
  

    public function __construct($product = '', $qty = '',$rate='') {
        $this -> product = $product;
        $this -> qty = $qty;
        $this -> rate = $rate;
      
	
    }

    public function __toString() {
        $leftCols ="30%";
	$leftCols1 ="5%";
        $rightCols="11%";
        
		
		
                $left = str_pad($this -> product, $leftCols,' ', STR_PAD_RIGHT) ;
		$left1 = str_pad($this -> qty, $leftCols1,' ', STR_PAD_LEFT) ;
		$right = str_pad($this -> rate, $rightCols,' ', STR_PAD_LEFT) ;
		
        return "$left$left1$right\n";
    }
}



?>