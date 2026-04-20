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
$sql_kots1="Select pr_style From tbl_printersettings  Where pr_branchid ='".$_SESSION['branchofid']."' and pr_printertype='".$_SESSION['reportprint_tp']."' ";
            $sql_kotss1  =  mysqli_query($con,$sql_kots1); 
            $num_kots1  = mysqli_num_rows($sql_kotss1);
            if($num_kots1){	
                $result_kots1  = mysqli_fetch_array($sql_kotss1);
		$printer_style=$result_kots1['pr_style'];
            }
 
if($_SESSION['s_printst']=="Y") // printer ye or no
{       
    $printer_kotip_bill=array();
	$printer_kotport_bill=array(); 
	$bill_ok=0;
	$bill_sorry=1;
	$sql_kots="Select pr_defaultusb,pr_printerip,pr_printerport,pr_printername From tbl_printersettings  Where pr_branchid ='1' and pr_printertype= '3' and  pr_enable='Y' group by pr_printerip ";
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
                                       
                                   
    if($_REQUEST['type']=="tot_sales")
    {
		$string='';
		$print='';
		$from='';
		$to='';
        $floor_name='';
		$typestring='';
		$date=date("Ymd");
		$string=" bm_status='Closed' AND ";
    	$floorvalue=$_REQUEST['floorz'];

        if($_REQUEST['floorz']!=''){
                $string.=" bm_floorid='".$floorvalue."' AND ";
                
                $sql_floor  =  $database->mysqlQuery("select fr_floorname FROM tbl_floormaster where fr_floorid='".$floorvalue."'"); 
                $num_floor   = $database->mysqlNumRows($sql_floor);
                if($num_floor)
                {
                  $result_floor  = mysqli_fetch_array($sql_floor);
                  $floor_name=$result_floor['fr_floorname'];
                }       
        }
			if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
			{
				$from=$database->convert_date($_REQUEST['hidfr']);
				$to=$database->convert_date($_REQUEST['hidto']);
				$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
			}
			else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
			{
				$from=$database->convert_date($_REQUEST['hidfr']);
				$to=date("Y-m-d");
				$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
			}
			else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
			{
				$from=date("Y-m-d");
				$to=$database->convert_date($_REQUEST['hidto']);
				$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
			}
		
		else
		{
			$bydatz=$_REQUEST['hidbydate'];
			if($bydatz!="null")
			{

		if($bydatz=="Last5days")
		{
			$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
			$typestring="Last 5 days";
		}elseif($bydatz=="Last10days")
		{
			$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
			$typestring="Last 10 days";
		}
		elseif($bydatz=="Last15days")
		{
			$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
			$typestring="Last 15 days";
		}
		else if($bydatz=="Last20days")
		{
			$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
			$typestring="Last 20 days";
		}
		else if($bydatz=="Last25days")
		{
			$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
			$typestring="Last 25 days";
		}
		else if($bydatz=="Last30days")
		{
			$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
			$typestring="Last 30 days";
		}
		else if($bydatz=="Today")
		{
			$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
			$typestring="Today";
		}
		else if($bydatz=="Yesterday")
		{
			$string.="bm_dayclosedate = CURDATE() - INTERVAL 1 day";
			$typestring="Yesterday";
		}
		 else if($bydatz=="Last1month")
		{
			$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			$typestring="Last 1 month";
		}
		else if($bydatz=="Last90days")
			{
				$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
				$typestring="Last 90 days"; 
			}
		else if($bydatz=="Last180days")
			{
				$string="bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
				$typestring="Last 180 days";
			}
		else if($bydatz=="Last365days")
			{
				$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
				$typestring="Last 365 days";
			}
		}
		else
		{
			$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "bm_dayclosedate between '".$from."' and '".$to."' ";
		}
		}
		$cur=date("Y-m-d");
		$sql_login  =  $database->mysqlQuery("select bm_paymode,bm_finaltotal,bm_dayclosedate,bm_billno 
											from tbl_tablebillmaster where $string order by bm_dayclosedate"); 
		$num_login   = $database->mysqlNumRows($sql_login);
		if($num_login)
		{			  
				$print .= $center.$bold_on."Total Sales Report".$bold_off."\n";
				if($from=='' && $to=='')
				{
					$print .= $center.$bold_on.$typestring.$bold_off."\n";
				}
				else
				{
				$print .= $center.$bold_on.$from." To ".$to.$bold_off."\n";
				}
                if($floor_name!=''){
                    $print .= $center.$bold_on." Floor :".$floor_name.$bold_off."\n";
                }
                                if($printer_style=='1'){
                                    $vv=str_pad("-",  '46%', "-");//46
                                    }
                                    else if($printer_style=='2'){
                                         $vv=str_pad("-",  '42%', "-");
                                    }
				$print .= $left.$vv."\n";//ojin
				$menulist= array(
					new menulist("Slno","Date","Bilno", "Final",$printer_style),
				);
				foreach($menulist as $menulist) {
					$print .=$left.($menulist);
				}
				$print .= $left.$vv."\n";//ojin
				
				$final=0;$i=1;
				while($result_report  = mysqli_fetch_array($sql_login)) 
				{       
					if($result_report['bm_paymode']!=7){
					$final=$final + $result_report['bm_finaltotal'];
					$dt=explode("-",$result_report['bm_dayclosedate']);
					$date=$dt[2]."-".$dt[1]."-".$dt[0];
					
					$menulist= array(
						new menulist($i,$date,$result_report['bm_billno'], number_format($result_report['bm_finaltotal'],$_SESSION['be_decimal']),$printer_style),
					);
					foreach($menulist as $menulist) {
						$print .=$left.($menulist);
					}
					$i++;
                                }}
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
				
				$sql_kots="Select pr_defaultusb,pr_usbprinterip,pr_usbprinter,pr_printerip,pr_printerport 
				From tbl_printersettings  Where pr_branchid ='".$_SESSION['branchofid']."' and pr_printertype='".$_SESSION['reportprint_tp']."' ";
				$sql_kotss  =  mysqli_query($con,$sql_kots);                              
				$num_kots  = mysqli_num_rows($sql_kotss);
				if($num_kots)
				{	
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
    else if($_REQUEST['type']=="sales_summary_zam")
    {
             
		$string='';
		$print='';
		$from='';
		$to='';
		$typestring='';
		  $string='';
                   $strings='';
        $reporthead="";
	$string.="bm_status='Closed' AND ";
	$string_pax="";
	$string_pax="bm_status='Closed' AND ";
	
	$string1_str=" (sum(bm_amountpaid) - sum(bm_amountbalace)) ";
	$string2_str=" sum(bm_transactionamount) ";
	$string3_str=" sum(bm_finaltotal) ";
	$string4_str=" sum(bm_finaltotal) ";
	$string5_str=" sum(bm_finaltotal) ";
        $string7_str=" sum(bm_finaltotal)";
	
	$string1 =$strings. " ";//"cash"//(bm_transactionamount ='' or bm_transactionamount IS NULL) and (bm_couponcompany ='' or bm_couponcompany IS NULL) and bm_voucherid IS NULL and bm_couponamt ='0.00' and  (bm_chequeno ='' or bm_chequeno IS NULL) and (bm_chequebankname='' or bm_chequebankname IS NULL)
		$string2 =$strings. " ";//"credit"  bm_transactionamount <>''
		$string3 =$strings. " bm_paymode='coupon'  AND";//"coupons"  bm_couponcompany <>''  and bm_couponamt <>'0.00'
		$string4 =$strings. " bm_paymode='voucher' AND";//"voucher" bm_voucherid <>''
		$string5 =$strings. " bm_paymode='cheque' AND";//"cheque" bm_chequeno <>'' and bm_chequebankname<>''
	// $string=" bm_status='Closed' AND ";
                $string7=$strings. " bm_paymode='complimentary' AND";
	
			if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
			{
				$from=$database->convert_date($_REQUEST['hidfr']);
				$to=$database->convert_date($_REQUEST['hidto']);
				$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
				$string_pax.= "  (bm_dayclosedate  between '".$from."' and '".$to."' ) ";
				$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to) ; 
			}
			else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
			{
				$from=$database->convert_date($_REQUEST['hidfr']);
				$to=date("Y-m-d");
				$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
				$string_pax.= "  (bm_dayclosedate between '".$from."' and '".$to."' ) ";
				$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to) ; 
			}
			else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
			{
				$from=date("Y-m-d");
				$to=$database->convert_date($_REQUEST['hidto']);
				$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
				
				$string_pax.= "  (bm_dayclosedate  between '".$from."' and '".$to."' ) ";
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
			$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
			$string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
			$typestring="Last 5 days";
		}elseif($bydatz=="Last10days")
		{
			$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
			$string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
			$typestring="Last 10 days";
		}
		elseif($bydatz=="Last15days")
		{
			$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
			$string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
			$typestring="Last 15 days";
		}
		else if($bydatz=="Last20days")
		{
			$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
			$string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
			$typestring="Last 20 days";
		}
		else if($bydatz=="Last25days")
		{
			$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
			$string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
			$typestring="Last 25 days";
		}
		else if($bydatz=="Last30days")
		{
			$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
			$string_pax.= " bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
			$typestring="Last 30 days";
		}
		else if($bydatz=="Today")
		{
			$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
			$string_pax.= "bm_dayclosedate between  CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
			$typestring="Today";
		}
		else if($bydatz=="Yesterday")
		{
			$string.=" bm_dayclosedate = CURDATE() - INTERVAL 1 day";
			$string_pax.= "bm_dayclosedate = CURDATE() - INTERVAL 1 day";
			$typestring="Yesterday";
		}
		 else if($bydatz=="Last1month")
		{
			$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			$string_pax.= "bm_dayclosedate between  CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			$typestring="Last 1 month";
		}
		else if($bydatz=="Last90days")
			{
				$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
				$string_pax.= " bm_dayclosedate  between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
				$typestring="Last 90 days"; 
			}
		else if($bydatz=="Last180days")
			{
				$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
				$string_pax.= "bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
				$typestring="Last 180 days";
			}
		else if($bydatz=="Last365days")
			{
				$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
				$string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
				$typestring="Last 365 days";
			}
		}
		else
		{
			$from=date("Y-m-d");
				$to=date("Y-m-d");
				$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
				$string_pax.= " bm_dayclosedate   between '".$from."' and '".$to."'";
		}
		}
                
                
                $flg=0;
           
            $sql_kots="Select pr_printerip,pr_printerport From tbl_printersettings  Where pr_branchid ='".$_SESSION['branchofid']."' and pr_printertype='".$_SESSION['reportprint_tp']."' ";
            $sql_kotss  =  mysqli_query($con,$sql_kots); 
            $num_kots  = mysqli_num_rows($sql_kotss);
            if($num_kots){	
                $result_kots  = mysqli_fetch_array($sql_kotss);          
                    require_once("Escpos.php");
                    $connector = new NetworkPrintConnector($result_kots['pr_printerip'],$result_kots['pr_printerport']);
                   $printers = new Escpos($connector);
                   $printers -> setJustification(Escpos::JUSTIFY_CENTER);
                   $logo = new EscposImage("img/print-logo/print_logo.png");
                   $printers -> bitImage($logo);//graphics($logo);
                             $printers -> feed();
                             $printers -> feed();
                             $printers->close();
            }
                //branch details
                $footer4 = "";
                $branchname="";
                $branchaddress="";
                $branchemail="";
                $branchphone = "";
                $sql_branch  =  $database->mysqlQuery("Select be_branchname,be_address,be_email,be_phone,be_footer3,be_footer4 from tbl_branchmaster where be_branchid='".$_SESSION['branchofid']."'"); 
				$num_branch  = mysqli_num_rows($sql_branch);
		  if($num_branch)
		  {
				while($result_branch  = mysqli_fetch_array($sql_branch)) 
					{
						 $branchname=$result_branch['be_branchname'];
						 $branchaddress=$result_branch['be_address'];
						 $branchemail=$result_branch['be_email'];
						 $branchphone=$result_branch['be_phone'];
						 $footer3=$result_branch['be_footer3'];
						 $footer4=$result_branch['be_footer4'];						 					
					}
		  }    
                     
                $print .= $center.$branchaddress."\n";
                $print .= $center.$branchemail."\n";
                $print .= $center.$branchphone."\n";
                $print .="\n";
                $print .= $center."KVAT Rules,2005 FORM 8B"."\n";
                
                $print .= $center."TIN-32010855603 "."\n";
                $print .= $center."FSSAI Lic. No-11312001000061"."\n";
                $print .= $center."ASSESSE CODE: AABFZ4015HSD001"."\n";
                $print .="\n";
		  $cur=date("Y-m-d");
                  $vv=str_pad("-",  '46%', "-");//46
                    $print .= $left.$vv."\n";//ojin
                    
                    $print .= $center."Date:".date('d-m-Y')."\n";
                    $print .="\n";
		  $print .= $center.$bold_on."BRANCH: ".$branchname.$bold_off."\n";
                  $print .="\n";
		  
				if($from=='' && $to=='')
				{
					$print .= $center.$typestring."\n";
				}
				else
				{
                                $print .= $center."Report\n";
				$print .= $center."From ".$database->convert_date($from)."\n";
                                $print .= $center."To ".$database->convert_date($to)."\n";
				}
			
				
				
                               $print .="\n";
                                
				$print .= $left.$vv."\n";//ojin
                                 $print .="\n";
                                 $print .= $center.$bold_on."SALES SUMMARY (Inc.Tax)".$bold_off."\n";
                                $print .="\n";
				$final=0;$i=1;
		  
		  
		  $sql_login  =  $database->mysqlQuery("select sum(bm_finaltotal) as tot FROM tbl_tablebillmaster where bm_floorid <> 'YMR-FL3' AND $string"); 
		$num_login   = $database->mysqlNumRows($sql_login);
		  if($num_login)
		  {
				
				while($result_report  = mysqli_fetch_array($sql_login)) 
				{
					if($result_report['tot'] != "")
			{
					$bilno= array(
						new bilno("Dine In",number_format($result_report['tot'],$_SESSION['be_decimal'])),
					);
					foreach($bilno as $bilno) {
						$print .=$left.($bilno);
					}
					$i++;
				}
		  }}

		  $sql_login1  =  $database->mysqlQuery("select sum(bm_finaltotal) as tot FROM tbl_tablebillmaster where bm_floorid = 'YMR-FL3' AND $string"); 
		  $num_login1   = $database->mysqlNumRows($sql_login1);
		  
		    if($num_login1)
		  {				
				while($result_report1  = mysqli_fetch_array($sql_login1)) 
				{				
					$bilno= array(
						new bilno("Take Away",number_format($result_report1['tot'],$_SESSION['be_decimal'])),
					);
					foreach($bilno as $bilno) {
						$print .=$left.($bilno);
					}
					$i++;
				}
		  }		
		  $print .= $left.$vv."\n";//ojin
		  $qtycount=0;
		   $sql_stw  =  $database->mysqlQuery("select sum(bm_finaltotal) as tot FROM tbl_tablebillmaster where $string"); 
	  $num_stw   = $database->mysqlNumRows($sql_stw);
	  if($num_stw){
		  $result_stw  = $database->mysqlFetchArray($sql_stw);			
	  }
	 			 $bilno= array(
						new bilno("Total",number_format($result_stw['tot'],$_SESSION['be_decimal'])),
					);
					foreach($bilno as $bilno) {
						$print .=$left.($bilno);
					}		  		  
				$print .= $left.$vv."\n";//ojin				                               
                                //tax summary
                                 $print .="\n";
                                 $print .= $center.$bold_on."TAX SUMMARY".$bold_off."\n";
                                $print .="\n";
				$final=0;$i=1;
		  
		  
		  $sql_login  =  $database->mysqlQuery("select sum(bm_finaltotal) as tot FROM tbl_tablebillmaster where bm_floorid <> 'YMR-FL3' AND $string"); 
	$num_login   = $database->mysqlNumRows($sql_login);
		  if($num_login)
		  {
				
				while($result_report  = mysqli_fetch_array($sql_login)) 
				{
					if($result_report['tot'] != "")
			{
					
					$saleinctax = $result_report['tot'];
					
					
					
					$bilno= array(
						new bilno("Sales Inc.Tax",number_format($result_report['tot'],$_SESSION['be_decimal'])),
					);
					foreach($bilno as $bilno) {
						$print .=$left.($bilno);
					}
					$i++;
				}
		  }}

		$sql_login1  =  $database->mysqlQuery("select sum( bm_servicetax) as tot FROM tbl_tablebillmaster where bm_floorid <> 'YMR-FL3' AND $string"); 
		$num_login1   = $database->mysqlNumRows($sql_login1);		  
		    if($num_login1)
		  {				
				$result_report1  = mysqli_fetch_array($sql_login1);				
				$srvtax = $result_report1['tot'];								
		  }
                  
                  $salesextax = $saleinctax -$srvtax;
                  $bilno= array(
                        						new bilno("Sales Ex.Tax",number_format($salesextax,$_SESSION['be_decimal'])),
					);
					foreach($bilno as $bilno) {
						$print .=$left.($bilno);
					}
		
		  $bilno= array(
                        						new bilno($taxname1,number_format($srvtax,$_SESSION['be_decimal'])),
					);
					foreach($bilno as $bilno) {
						$print .=$left.($bilno);
					}
					$i++;
		 
		  
		  $print .="\n";
				$print .= $left.$vv."\n";//ojin
				
                                //tax summary end
                                //footer
                                
                                if($footer4!="")
                                {
                                    
                                     $print .= $center.$footer3."\n";
                                    $print .= $left.$vv."\n";//ojin
				}
                                
                                if($footer4!="")
                                {
                                     $print .= $center.$footer4."\n";
                                    
				}
                                //footer end
				$print .="\n\n\n\n\n";
				$print.=$cutpaper;
                   
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
    else if($_REQUEST['type']=="tax_sales_summary")
    {
       
		$string='';
		$print='';
		$from='';
		$to='';
		$typestring='';
		  $string='';
                   $strings='';
        $reporthead="";

        $string .=" bm_status='Closed' AND bm_complimentary !='Y' AND ";
	$string1_str=" (sum(bm_amountpaid) - sum(bm_amountbalace)) ";
	$string2_str=" sum(bm_transactionamount) ";
	$string3_str=" (sum(bm_finaltotal) - (sum(bm_amountpaid)-sum(bm_amountbalace))) ";
        $string4_str=" (sum(bm_finaltotal) - (sum(bm_amountpaid)-sum(bm_amountbalace))) ";
	$string5_str=" (sum(bm_finaltotal) - (sum(bm_amountpaid)-sum(bm_amountbalace)))";
	$string6_str=" (sum(bm_finaltotal) - (sum(bm_amountpaid)-sum(bm_amountbalace)))";
        $string7_str=" sum(bm_finaltotal)";
        
	$string_pax="";
	$string_pax=" bm_status='Closed' AND ";
	$string1 =$strings. " ((pym_code='cash') or (pym_code='credit') or (pym_code='coupon') or (pym_code='voucher') or (pym_code='cheque') or (pym_code='credit_person') or (pym_code='complimentary')  ) AND ";
	$string2 =" pym_code='credit'  AND";//bm_paymode='credit' AND//"credit"  bm_transactionamount <>''
	$string3 =$strings. " pym_code='coupon'  AND";//"coupons"  bm_couponcompany <>''  and bm_couponamt <>'0.00'
	$string4 =$strings. " pym_code='voucher' AND";//"voucher" bm_voucherid <>''
	$string5 =$strings. " pym_code='cheque' AND";//"cheque" bm_chequeno <>'' and bm_chequebankname<>''
	$string6=$strings. " pym_code='credit_person' AND ";
	$string7= " bm_complimentary ='Y' AND pym_code='complimentary' AND";
	
			if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
			{
				$from=$database->convert_date($_REQUEST['hidfr']);
				$to=$database->convert_date($_REQUEST['hidto']);
				$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
				$string_pax.= "  (bm_dayclosedate  between '".$from."' and '".$to."' ) ";
				$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to) ; 
			}
			else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
			{
				$from=$database->convert_date($_REQUEST['hidfr']);
				$to=date("Y-m-d");
				$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
				$string_pax.= "  (bm_dayclosedate between '".$from."' and '".$to."' ) ";
				$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to) ; 
			}
			else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
			{
				$from=date("Y-m-d");
				$to=$database->convert_date($_REQUEST['hidto']);
				$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
				
				$string_pax.= "  (bm_dayclosedate  between '".$from."' and '".$to."' ) ";
				$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to) ; 
			}
		
		else
		{
			$bydatz=$_REQUEST['hidbydate'];
			
			if($bydatz!="null" && $bydatz!="")
			{
			
		
		if($bydatz=="Last5days")
		{
			$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
			$string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
			$typestring="Last 5 days";
		}elseif($bydatz=="Last10days")
		{
			$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
			$string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
			$typestring="Last 10 days";
		}
		elseif($bydatz=="Last15days")
		{
			$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
			$string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
			$typestring="Last 15 days";
		}
		else if($bydatz=="Last20days")
		{
			$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
			$string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
			$typestring="Last 20 days";
		}
		else if($bydatz=="Last25days")
		{
			$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
			$string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
			$typestring="Last 25 days";
		}
		else if($bydatz=="Last30days")
		{
			$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
			$string_pax.= " bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
			$typestring="Last 30 days";
		}
		else if($bydatz=="Today")
		{
			$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
			$string_pax.= "bm_dayclosedate between  CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
			$typestring="Today";
		}
		else if($bydatz=="Yesterday")
		{
			$string.=" bm_dayclosedate = CURDATE() - INTERVAL 1 day";
			$string_pax.= "bm_dayclosedate = CURDATE() - INTERVAL 1 day";
			$typestring="Yesterday";
		}
		 else if($bydatz=="Last1month")
		{
			$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			$string_pax.= "bm_dayclosedate between  CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			$typestring="Last 1 month";
		}
		else if($bydatz=="Last90days")
			{
				$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
				$string_pax.= " bm_dayclosedate  between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
				$typestring="Last 90 days"; 
			}
		else if($bydatz=="Last180days")
			{
				$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
				$string_pax.= "bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
				$typestring="Last 180 days";
			}
		else if($bydatz=="Last365days")
			{
				$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
				$string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
				$typestring="Last 365 days";
			}
		}
		else
		{
			$from=date("Y-m-d");
				$to=date("Y-m-d");
				$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
				$string_pax.= " bm_dayclosedate   between '".$from."' and '".$to."'";
		}
		}
            $flg=0;          
            $sql_kots="Select pr_printerip,pr_printerport From tbl_printersettings  Where pr_branchid ='".$_SESSION['branchofid']."' and pr_printertype='".$_SESSION['reportprint_tp']."' ";
            $sql_kotss  =  mysqli_query($con,$sql_kots); 
            $num_kots  = mysqli_num_rows($sql_kotss);
            if($num_kots){	
                $result_kots  = mysqli_fetch_array($sql_kotss);		
                    require_once("Escpos.php");
                    $connector = new NetworkPrintConnector($result_kots['pr_printerip'],$result_kots['pr_printerport']);
                   $printers = new Escpos($connector);
                   $printers -> setJustification(Escpos::JUSTIFY_CENTER);
                   $logo = new EscposImage("img/print-logo/print_logo.png");
                   $printers -> bitImage($logo);//graphics($logo);
                             $printers -> feed();
                             $printers -> feed();
                             $printers->close();
            }
             
                $footer4 = "";
                $branchname="";
                $branchaddress="";
                $branchemail="";
                $branchphone = "";
                $sql_branch  =  $database->mysqlQuery("Select be_branchname,be_address,be_email,be_phone,be_footer3,be_footer4 from tbl_branchmaster where be_branchid='".$_SESSION['branchofid']."'"); 
               
		  $num_branch  = mysqli_num_rows($sql_branch);
		  if($num_branch)
		  {
				while($result_branch  = mysqli_fetch_array($sql_branch)) 
					{
						 $branchname=$result_branch['be_branchname'];
						 $branchaddress=$result_branch['be_address'];
						 $branchemail=$result_branch['be_email'];
						 $branchphone=$result_branch['be_phone'];						 
						 $footer3=$result_branch['be_footer3'];
						 $footer4=$result_branch['be_footer4'];						 					
					}
		  }       
                $print .= $center.$branchaddress."\n";
                $print .= $center.$branchemail."\n";
                $print .= $center.$branchphone."\n";
                $print .="\n";
                
                $print .="\n";
		  $cur=date("Y-m-d");
                  if($printer_style=='1'){
                        $vv=str_pad("-",  '46%', "-");//46
                    }
                    else if($printer_style=='2'){
                        $vv=str_pad("-",  '42%', "-");
                    }
                    $print .= $left.$vv."\n";//ojin
                    
                    $print .= $center."Date:".date('d-m-Y')."\n";
                    $print .="\n";
		  $print .= $center.$bold_on."BRANCH: ".$branchname.$bold_off."\n";
                  
		  
				if($from=='' && $to=='')
				{
					$print .= $center.$typestring."\n";
				}
				else
				{
                                $print .= $center."Report\n";
				$print .= $center."From ".$database->convert_date($from)."\n";
                                $print .= $center."To ".$database->convert_date($to)."\n";
				}
			
                               $print .="\n";
                                
				$print .= $left.$vv."\n";//ojin
                                
                                 $print .= $center.$bold_on."SALES SUMMARY".$bold_off."\n";
                                $print .="\n";
				$final=0;$i=1;
                                
                                //-----------------------
   $extax = 0;
  $total=0;
  $cash = 0;
  $card = 0;
  $card1=0;
  $cheque=0;
  $coupon=0;
  $voucher=0;
  $creditperson=0;
  $complimentary=0;
  $totaltax = 0;
  $roundoff = 0;
  $roundoff1=0;
  $final_exclusive_tax=0;
  $tax_exempt=0;
  $discount=0;
  $final=0;
  $total_tax=0;

    $sql_login_cash  =  $database->mysqlQuery(" select  $string1_str as cash,sum( bm_roundoff_value) as roundoff FROM tbl_tablebillmaster tbm
    left join tbl_paymentmode pm ON pm.pym_id = tbm.bm_paymode where $string1 $string"); 
	  $num_login_cash   = $database->mysqlNumRows($sql_login_cash);
	  if($num_login_cash){
            $result_login_cash  = $database->mysqlFetchArray($sql_login_cash); 
            $cash = $result_login_cash['cash'];
            $roundoff=$roundoff+$result_login_cash['roundoff'];
            if($cash!=0){
                    $bilno= array(
                            new tax("Cash",number_format($cash,$_SESSION['be_decimal']),$printer_style),
                            );
                            foreach($bilno as $bilno) {
                            	$print .=$left.($bilno);
                            }
            }
          }
    $sql_login_card  =  $database->mysqlQuery(" select bm_name as bank_name, $string2_str as card,sum( bm_roundoff_value) as roundoff from tbl_tablebillmaster tbm left join tbl_paymentmode on tbm.bm_paymode=tbl_paymentmode.pym_id  , tbl_bankmaster b  where  b.bm_id = tbm.bm_transcbank and tbm.bm_status='Closed' AND $string2 "."$string group by b.bm_name order by tbm.bm_dayclosedate,tbm.bm_billtime ASC "); 
	$num_login_card   = $database->mysqlNumRows($sql_login_card);
	  if($num_login_card){
            while($result_login_card  = $database->mysqlFetchArray($sql_login_card)){ 
            $card1 = $card1+$result_login_card['card'];
            $card = $result_login_card['card'];
            $roundoff=$roundoff+$result_login_card['roundoff'];
           if($card!=0){
            $bilno= array(
                            new tax("Card -".$result_login_card['bank_name'],number_format($card,$_SESSION['be_decimal']),$printer_style),
                            );
                            foreach($bilno as $bilno) {
                            	$print .=$left.($bilno);
                            }
           }
          } }
    $sql_login_coupon  =  $database->mysqlQuery(" select $string3_str as coupon, sum( bm_roundoff_value) as roundoff from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string3"." $string order by bm_dayclosedate,bm_billtime ASC"); 
	$num_login_coupon   = $database->mysqlNumRows($sql_login_coupon);
	  if($num_login_coupon){
            $result_login_coupon  = $database->mysqlFetchArray($sql_login_coupon); 
           
            $coupon = $result_login_coupon['coupon'];
            $roundoff=$roundoff+$result_login_coupon['roundoff'];
            if($coupon!=0){
            $bilno= array(
                            new tax("Coupon",number_format($coupon,$_SESSION['be_decimal']),$printer_style),
                            );
                            foreach($bilno as $bilno) {
                            	$print .=$left.($bilno);
                            }
            }
          }
          
      $sql_login_voucher  =  $database->mysqlQuery(" select $string4_str as voucher, sum( bm_roundoff_value) as roundoff from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string4"." $string order by bm_dayclosedate,bm_billtime ASC"); 
     $num_login_voucher   = $database->mysqlNumRows($sql_login_voucher);
	  if($num_login_voucher){
            $result_login_voucher  = $database->mysqlFetchArray($sql_login_voucher); 
           
            $voucher = $result_login_voucher['voucher'];
            $roundoff=$roundoff+$result_login_voucher['roundoff'];
            if($voucher!=0){
            $bilno= array(
                            new tax("Voucher",number_format($voucher,$_SESSION['be_decimal']),$printer_style),
                            );
                            foreach($bilno as $bilno) {
                            	$print .=$left.($bilno);
                            }
            }
          }    
      $sql_login_cheque  =  $database->mysqlQuery(" select $string5_str as cheque, sum( bm_roundoff_value) as roundoff from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string5"." $string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login_cheque   = $database->mysqlNumRows($sql_login_cheque);
	  if($num_login_cheque){
            $result_login_cheque  = $database->mysqlFetchArray($sql_login_cheque); 
           
            $cheque = $result_login_cheque['cheque'];
            $roundoff=$roundoff+$result_login_cheque['roundoff'];
            if($cheque!=0){
            $bilno= array(
                            new tax("Cheque",number_format($cheque,$_SESSION['be_decimal']),$printer_style),
                            );
                            foreach($bilno as $bilno) {
                            	$print .=$left.($bilno);
                            }
            }
          } 
          $sql_login_creditperson  =  $database->mysqlQuery(" select $string6_str as creditperson, sum( bm_roundoff_value) as roundoff from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string6"." $string order by bm_dayclosedate,bm_billtime ASC"); 
          $num_login_creditperson   = $database->mysqlNumRows($sql_login_creditperson);
	  if($num_login_creditperson){
            $result_login_creditperson  = $database->mysqlFetchArray($sql_login_creditperson); 
           
            $creditperson = $result_login_creditperson['creditperson'];
            $roundoff=$roundoff+$result_login_creditperson['roundoff'];
            if($creditperson!=0){
            $bilno= array(
                            new tax("Credit Person",number_format($creditperson,$_SESSION['be_decimal']),$printer_style),
                            );
                            foreach($bilno as $bilno) {
                            	$print .=$left.($bilno);
                            }
            }
          }
          
       $sql_login_complimentary  =  $database->mysqlQuery(" select $string7_str as complimentary, sum( bm_roundoff_value) as roundoff from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where  $string7 $string_pax order by bm_dayclosedate,bm_billtime ASC"); 
        $num_login_complimentary   = $database->mysqlNumRows($sql_login_complimentary);
	  if($num_login_complimentary){
            $result_login_complimentary  = $database->mysqlFetchArray($sql_login_complimentary); 
           
            $complimentary = $result_login_complimentary['complimentary'];
            if($complimentary!=0){
            $bilno= array( new tax("Complimentary",number_format($complimentary,$_SESSION['be_decimal']),$printer_style),
                            );
                            foreach($bilno as $bilno) {
                            	$print .=$left.($bilno);
                            }
            }
          }
          
          $total=$cash+$card1+$coupon+$voucher+$cheque+$creditperson;
          
          if($total!=0){
              $print .= $left.$vv."\n";
             $bilno= array( new tax("Total Summary",number_format($total,$_SESSION['be_decimal']),$printer_style),
                            );
                            foreach($bilno as $bilno) {
                            	$print .=$left.($bilno);
                            } 
                            
            }
            
                            $print .= $left.$vv."\n";
                            $print .= $center.$bold_on."TAX SUMMARY".$bold_off."\n";
                            $print .="\n";
                            $print .="\n";
            
                            
            $sql_login_totsales  =  $database->mysqlQuery("select sum(bm_subtotal) as exclusivetax ,sum(bm_discountvalue) as discount, sum(bm_finaltotal) as final, sum(bm_tax_exempt) as taxexempt,sum(bm_roundoff_value) as roundoff1 FROM tbl_tablebillmaster bm where $string"); 
           $num_login_totsales   = $database->mysqlNumRows($sql_login_totsales);
            if($num_login_totsales){
              $result_login_totsales  = $database->mysqlFetchArray($sql_login_totsales); 
              $final = $result_login_totsales['final']; 
              $final_exclusive_tax = $result_login_totsales['exclusivetax'];
              $tax_exempt=$result_login_totsales['taxexempt'];
              $roundoff1=$result_login_totsales['roundoff1'];
              $discount=$result_login_totsales['discount'];
              $final_exclusive_tax=$final_exclusive_tax-$discount;
            }

             if($final_exclusive_tax!=0){
           
          $bilno= array( new tax("SALES EXCL.TAX",number_format($final_exclusive_tax,$_SESSION['be_decimal']),$printer_style),
                            );
                            foreach($bilno as $bilno) {
                            	$print .=$left.($bilno);
                            } 
          
          }
          
           if($tax_exempt!=0){
              $bilno= array( new tax("SALES TAX EXEMPT",number_format($tax_exempt,$_SESSION['be_decimal']),$printer_style),
                            );
                            foreach($bilno as $bilno) {
                            	$print .=$left.($bilno);
                            } 
            }
              
             
                $sql_login_tax  =  $database->mysqlQuery("select sum(etm.bem_total_value) as totax_single ,etm.bem_label  
                    FROM tbl_tablebillmaster tbm
                    left join tbl_tablebill_extra_tax_master etm on etm.bem_billno = tbm.bm_billno 
                    where $string group by etm.bem_taxid"); 

	  $num_login_tax   = $database->mysqlNumRows($sql_login_tax);
	  if($num_login_tax){
              
             while($result_login_tax  = $database->mysqlFetchArray($sql_login_tax)) 
			{   
             
              $total_tax_single = $result_login_tax['totax_single'];
              $label= $result_login_tax['bem_label'];
             if($total_tax_single!=0){
                 $total_tax=$total_tax+$total_tax_single;
                       $bilno= array( new tax($label,number_format($total_tax_single,$_SESSION['be_decimal']),$printer_style),
                            );
                            foreach($bilno as $bilno) {
                            	$print .=$left.($bilno);
                            }   
              
                     
             }   } }
             
              if($roundoff1!=0){
              
                $bilno= array( new tax("ROUND OFF",number_format($roundoff1,$_SESSION['be_decimal']),$printer_style),
                            );
                            foreach($bilno as $bilno) {
                            	$print .=$left.($bilno);
                }  
            }
           
             if($final!=0){
              $print .= $left.$vv."\n";
                   $bilno= array( new tax("SALES INCL.TAX",number_format(($final_exclusive_tax-$tax_exempt+$total_tax+$roundoff1),$_SESSION['be_decimal']),$printer_style),
                            );
                            foreach($bilno as $bilno) {
                            	$print .=$left.($bilno);
                }
             }

                            $print .= $left.$vv."\n";//ojin
			
                                if($footer4!="")
                                {
                                    
                                     $print .= $center.$footer3."\n";
                                    $print .= $left.$vv."\n";
				}
                                
                                if($footer4!="")
                                {
                                     $print .= $center.$footer4."\n";
                                    
				}
                                //footer end
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
    else if($_REQUEST['type']=="cancel_history")
	{
		
		 
 $string ="";
   
  
									
	$reporthead="";
	$st="";
										  
	  if($_REQUEST['from']!="" && $_REQUEST['to']!="")
		{
		  
			$from=$database->convert_date($_REQUEST['from']);
			$to=$database->convert_date($_REQUEST['to']);
			
			if($string !="")
			{
				$string.= "and ch.ch_dayclosedate  between '".$from."' and '".$to."' ";
			}
			else
			{
				$string.= " ch.ch_dayclosedate  between '".$from."' and '".$to."' ";
			}
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
			
						
			
			
			
		}
		else if($_REQUEST['from']!="" && $_REQUEST['to']=="")
		{
			$from=$database->convert_date($_REQUEST['from']);
			$to=date("Y-m-d");
		if($string !="")
			{
				$string.= "and ch.ch_dayclosedate  between '".$from."' and '".$to."' ";
			}
			else
			{
				$string.= " ch.ch_dayclosedate  between '".$from."' and '".$to."' ";
			}
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
			
						
			
			
			
			
		}
		else if($_REQUEST['from']=="" && $_REQUEST['to']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['to']);
			if($string !="")
			{
				$string.= "and ch.ch_dayclosedate  between '".$from."' and '".$to."' ";
			}
			else
			{
				$string.= " ch.ch_dayclosedate  between '".$from."' and '".$to."' ";
			}
		$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
					
			
		
		}
	else
	{
			$orderbydate=$_REQUEST['hidbydate'];
	
			if($orderbydate!="null")
	{
	if($orderbydate=="Last5days")
	{
		if($string !="")
		{
		
		$string.=" and ch.ch_dayclosedate  between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
		}
		else
		{
				$string.="ch.ch_dayclosedate  between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
		}
		
		
$st="Last 5 days";
	}elseif($orderbydate=="Last10days")
	{
	if($string !="")
{
	
		$string.=" and  ch.ch_dayclosedate  between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
}
else
{
		$string.=" ch.ch_dayclosedate  between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
}
$st="Last 10 days";
	}
	elseif($orderbydate=="Last15days")
	{
		if($string !="")
		{
			$string.="  and ch.ch_dayclosedate  between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
		}
		else
		{
		$string.=" ch.ch_dayclosedate  between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
		}
$st="Last 15 days";
	}
	else if($orderbydate=="Last20days")
	{
	if($string !="")
		{
				$string.=" and ch.ch_dayclosedate  between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
		}
		else
		{
		$string.=" ch.ch_dayclosedate  between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
		}
$st="Last 20 days";
	}
	else if($orderbydate=="Last25days")
	{
		if($string !="")
		{
			$string.=" and ch.ch_dayclosedate  between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
		}
		else{
		$string.=" ch.ch_dayclosedate  between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
		}
$st="Last 25 days";
	}
	else if($orderbydate=="Last30days")
	{
		if($string !="")
		{
				$string.=" and ch.ch_dayclosedate  between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
		}
		else
		{
		$string.=" ch.ch_dayclosedate  between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
		}
$st="Last 30 days";
	}
	else if($orderbydate=="Today")
	{
	if($string !="")
		{
		$string.=" and ch.ch_dayclosedate  between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
		}
		else
		{
			$string.=" ch.ch_dayclosedate  between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 		
		}
		$st="Today";
	}

else if($orderbydate=="Yesterday")
			  {
				    if($string !="")
				  {
					    $string.=" and ch.ch_dayclosedate  =  CURDATE() - INTERVAL 1 day";
				  }
				  else
				  {
					    $string.=" ch.ch_dayclosedate  =  CURDATE() - INTERVAL 1 day";
				  }
				  $st="Yesterday";
			  }
	else if($orderbydate=="Last1month")
	{
			  if($string !="")
				  {
					    $string.=" and ch.ch_dayclosedate  between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
				  }
				  else
				  {
					    $string.=" ch.ch_dayclosedate  between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
				  }
$st="Last 1 month";
	}

	else if($orderbydate=="Last90days")
	{
	if($string !="")
		{
		$string.=" and ch.ch_dayclosedate  between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
		}
		else
		{
			$string.="ch.ch_dayclosedate  between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
		}
		$st="Last 3 months";
	}
		else if($orderbydate=="Last180days")
	{
	if($string !="")
		{
		$string.=" and ch.ch_dayclosedate  between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
		}
		else
		{
			$string.=" ch.ch_dayclosedate  between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
		}
		$st="Last 6 months";
	}
		else if($orderbydate=="Last365days")
	{
		if($string !="")
		{	
		$string.=" and ch.ch_dayclosedate  between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
			
		}
		else
		{
			$string.="ch.ch_dayclosedate  between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
		}
		$st="Last 1 year";
	}
	$reporthead=$st;
	
	

	
	
	}
	else
	{
			$from=date("Y-m-d");
			$to=date("Y-m-d");
			if($string !="")
			{
			
			$string.= " and ch.ch_dayclosedate   between '".$from."' and '".$to."' ";
			}
			else
			{	
			$string.= " ch.ch_dayclosedate   between '".$from."' and '".$to."' ";
			}
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
			
//		
	}
	}  
    
	$final=0;

 	$sql_stw  =  $database->mysqlQuery("Select  ch.ch_dayclosedate,ch_kotno,ch.ch_entrydate,sm.ser_firstname,ch.ch_orderno,ch.ch_orderslno,ch.ch_cancelled_qty,ch_cancelledreason,ld.ls_username,m.mr_menuname,t.ter_entrytime 
        From tbl_tableorder_changes as ch 
        LEFT JOIN tbl_staffmaster as sm ON sm.ser_staffid=ch.ch_cancelledby_careof 
        left join tbl_logindetails as ld on ld.ls_username=ch.ch_cancelledlogin 
        left join tbl_tableorder as t ON t.ter_orderno = ch.ch_orderno and t.ter_slno = ch_orderslno 
        left join tbl_menumaster as m on m.mr_menuid = t.ter_menuid 
        where $string");

	  $num_stw   = $database->mysqlNumRows($sql_stw);
	  if($num_stw){$i=1;$t=0;$old="";
	  
	  
	  
	    
				$print .= $center.$bold_on."Items Cancel Report".$bold_off."\n";
				if($from=='' && $to=='')
				{
					$print .= $center.$bold_on.$reporthead.$bold_off."\n";
				}
				else
				{
				$print .= $center.$bold_on.$from." To ".$to.$bold_off."\n";
				}
//                                $flr = "";
//                                if($_REQUEST['byflr']=="")
//                                 {
//                                    
//                                    $print .= $center.$bold_on.'All Floors'.$bold_off."\n";
//                                 }
                                
				/*$print .= "------------------------------------------------\n";
				$print .= "Slno    Date           Bilno               Final\n";
				$print .= "------------------------------------------------\n";*/
				
				$vv=str_pad("-",  '46%', "-");//46
				$print .= $left.$vv."\n";//ojin
				//$print .= $left."Slno  Date        Bilno              Final\n";
				
				
				$menulist= array(
					new menulist1("Slno","Item","order No.","Qty", "KOT"),
				);
				foreach($menulist as $menulist) {
					$print .=$left.($menulist);
				}
				//$print .= $left."------------------------------------------\n";
				$print .= $left.$vv."\n";//ojin
				
				$final=0;$i=1;
				while($result_report  = mysqli_fetch_array($sql_stw)) 
				{
					$final=$final + $result_report['total'];
					$dt=explode("-",$result_report['ch_dayclosedate']);
					$date=$dt[2]."-".$dt[1]."-".$dt[0];
					
					
					$item=$result_report['mr_menuname'];
				
				//$result_report['qty'],$result_report['total']
					$menulist= array(
						new menulist1($i,$item),
					);
					
                                       
                                        
	    
					
						$menulist2= array(
						new menulist('','',"Qty.".$result_report['ch_cancelled_qty'],$result_report['ch_kotno'],$printer_style),
					);
						
					
					foreach($menulist as $menulist) {
					$print .=$left.($menulist);
					
					foreach($menulist2 as $menulist2) {
					$print .=$left.($menulist2);
						
					
					}
						
					
					}
					
					
					
					
					//$print .= $left.$i."    ".$date."     ".$result_report['bm_billno']."   ".$result_report['bm_finaltotal']."\n";
					$i++;
				}
				
	  }
				
				
				$print .= $left.$vv."\n";//ojin
//				$print .=$center."                       Total = ".$bold_on.$final.$bold_off.".00\n";
//				$print .= $left.$vv."\n";//ojin
				
				
				
				$print .="\n\n\n\n\n";
				$print.=$cutpaper;
				
				//And pr_floorid='".$florrid."'
				$sql_kots="Select pr_defaultusb,pr_usbprinterip,pr_usbprinter,pr_printerip,pr_printerport From tbl_printersettings  Where pr_branchid ='".$_SESSION['branchofid']."' and pr_printertype='".$_SESSION['reportprint_tp']."' ";
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
    else if($_REQUEST['type']=="no_sale_report")
	{
		$string='';
		$print='';
		$from='';
		$to='';
		$typestring='';
		 $date=date("Ymd");
		 $string="";
			if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
			{
				$from=$database->convert_date($_REQUEST['hidfr']);
				$to=$database->convert_date($_REQUEST['hidto']);
				$string.= " o.ter_dayclosedate between '".$from."' and '".$to."' ";
			}
			else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
			{
				$from=$database->convert_date($_REQUEST['hidfr']);
				$to=date("Y-m-d");
				$string.= " o.ter_dayclosedate between '".$from."' and '".$to."' ";
			}
			else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
			{
				$from=date("Y-m-d");
				$to=$database->convert_date($_REQUEST['hidto']);
				$string.= " o.ter_dayclosedate between '".$from."' and '".$to."' ";
			}
		
		else
		{
			$bydatz=$_REQUEST['hidbydate'];
			if($bydatz!="null")
			{
			//$search="";
		
		if($bydatz=="Last5days")
		{
			$string.="o.ter_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
			$typestring="Last 5 days";
		}elseif($bydatz=="Last10days")
		{
			$string.="o.ter_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
			$typestring="Last 10 days";
		}
		elseif($bydatz=="Last15days")
		{
			$string.=" o.ter_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
			$typestring="Last 15 days";
		}
		else if($bydatz=="Last20days")
		{
			$string.=" o.ter_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
			$typestring="Last 20 days";
		}
		else if($bydatz=="Last25days")
		{
			$string.="o.ter_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
			$typestring="Last 25 days";
		}
		else if($bydatz=="Last30days")
		{
			$string.="o.ter_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
			$typestring="Last 30 days";
		}
		else if($bydatz=="Today")
		{
			$string.="o.ter_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
			$typestring="Today";
		}
		else if($bydatz=="Yesterday")
		{
			$string.="o.ter_dayclosedate = CURDATE() - INTERVAL 1 day";
			$typestring="Yesterday";
		}
		 else if($bydatz=="Last1month")
		{
			$string.="o.ter_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			$typestring="Last 1 month";
		}
		else if($bydatz=="Last90days")
			{
				$string.="o.ter_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
				$typestring="Last 90 days"; 
			}
		else if($bydatz=="Last180days")
			{
				$string="o.ter_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
				$typestring="Last 180 days";
			}
		else if($bydatz=="Last365days")
			{
				$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
				$typestring="Last 365 days";
			}
		}
		else
		{
			$from=date("Y-m-d");
				$to=date("Y-m-d");
				$string.= "o.ter_dayclosedate between '".$from."' and '".$to."' ";
		}
		}
		  $cur=date("Y-m-d");
		  $sql_login  =  $database->mysqlQuery("SELECT mc.mmy_maincategoryname,sc.msy_subcategoryname,m.mr_menuname FROM tbl_menumaster m 
LEFT JOIN tbl_menumaincategory mc ON MC.mmy_maincategoryid = m.mr_maincatid
LEFT JOIN tbl_menusubcategory sc ON SC.msy_subcategoryid = m.mr_subcatid
where m.mr_menuid NOT IN(SELECT o.ter_menuid from tbl_tableorder o where $string)
ORDER BY m.mr_maincatid,m.mr_subcatid  DESC"); 
		  $num_login   = $database->mysqlNumRows($sql_login);
		  if($num_login)
		  {
			  
				$print .= $center.$bold_on."Total Sales Report".$bold_off."\n";
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
					new menulist("Slno","Date","Bilno", "Final",$printer_style),
				);
				foreach($menulist as $menulist) {
					$print .=$left.($menulist);
				}
				//$print .= $left."------------------------------------------\n";
				$print .= $left.$vv."\n";//ojin
				
				$final=0;$i=1;
				while($result_report  = mysqli_fetch_array($sql_login)) 
				{
					$final=$final + $result_report['bm_finaltotal'];
					$dt=explode("-",$result_report['bm_dayclosedate']);
					$date=$dt[2]."-".$dt[1]."-".$dt[0];
					
					$menulist= array(
						new menulist($i,$date,$result_report['bm_billno'], number_format($result_report['bm_finaltotal'],$_SESSION['be_decimal']),$printer_style),
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
				$sql_kots="Select pr_defaultusb,pr_usbprinterip,pr_usbprinter,pr_printerip,pr_printerport From tbl_printersettings  Where pr_branchid ='".$_SESSION['branchofid']."' and pr_printertype='".$_SESSION['reportprint_tp']."' ";
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
    else if($_REQUEST['type']=="regenerate_bill_logs")
	{
		$string='';
		$print='';
		$from='';
		$to='';
		$typestring='';
		 $date=date("Ymd");
		 $string="";
			if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
			{
				$from=$database->convert_date($_REQUEST['hidfr']);
				$to=$database->convert_date($_REQUEST['hidto']);
				$string.= " DATE(r.re_datetime) between '".$from."' and '".$to."' ";
			}
			else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
			{
				$from=$database->convert_date($_REQUEST['hidfr']);
				$to=date("Y-m-d");
				$string.= "DATE(r.re_datetime) between '".$from."' and '".$to."' ";
			}
			else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
			{
				$from=date("Y-m-d");
				$to=$database->convert_date($_REQUEST['hidto']);
				$string.= " DATE(r.re_datetime) between '".$from."' and '".$to."' ";
			}
		
		else
		{
			$bydatz=$_REQUEST['hidbydate'];
			if($bydatz!="null")
			{
			//$search="";
		
		if($bydatz=="Last5days")
		{
			$string.="DATE(r.re_datetime) between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
			$typestring="Last 5 days";
		}elseif($bydatz=="Last10days")
		{
			$string.="DATE(r.re_datetime) between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
			$typestring="Last 10 days";
		}
		elseif($bydatz=="Last15days")
		{
			$string.=" DATE(r.re_datetime) between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
			$typestring="Last 15 days";
		}
		else if($bydatz=="Last20days")
		{
			$string.=" DATE(r.re_datetime) between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
			$typestring="Last 20 days";
		}
		else if($bydatz=="Last25days")
		{
			$string.="DATE(r.re_datetime) between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
			$typestring="Last 25 days";
		}
		else if($bydatz=="Last30days")
		{
			$string.="DATE(r.re_datetime) between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
			$typestring="Last 30 days";
		}
		else if($bydatz=="Today")
		{
			$string.="DATE(r.re_datetime) between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
			$typestring="Today";
		}
		else if($bydatz=="Yesterday")
		{
			$string.="DATE(r.re_datetime) = CURDATE() - INTERVAL 1 day";
			$typestring="Yesterday";
		}
		 else if($bydatz=="Last1month")
		{
			$string.="DATE(r.re_datetime) between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			$typestring="Last 1 month";
		}
		else if($bydatz=="Last90days")
			{
				$string.="DATE(r.re_datetime) between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
				$typestring="Last 90 days"; 
			}
		else if($bydatz=="Last180days")
			{
				$string="DATE(r.re_datetime) between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
				$typestring="Last 180 days";
			}
		else if($bydatz=="Last365days")
			{
				$string.="DATE(r.re_datetime) between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
				$typestring="Last 365 days";
			}
		}
		else
		{
			$from=date("Y-m-d");
				$to=date("Y-m-d");
				$string.= "DATE(r.re_datetime) between '".$from."' and '".$to."' ";
		}
		}
		  $cur=date("Y-m-d");
		  $sql_login  =  $database->mysqlQuery("select r.re_billno,DATE(r.re_datetime) AS Date, s.ser_firstname,
		  r.re_reason,r.re_loginid,r.re_amount from tbl_regenrate_log r 
		  left join tbl_staffmaster s on r.re_staffid=s.ser_staffid where $string
 		  order by r.re_billno ASC "); 
              
		  $num_login   = $database->mysqlNumRows($sql_login);
		  if($num_login)
		  {			  
				$print .= $center.$bold_on."Regenerate Bill Logs".$bold_off."\n";
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
					new menulist("Slno","Date","Bilno", "Old.Final",$printer_style),
				);
				foreach($menulist as $menulist) {
					$print .=$left.($menulist);
				}
				//$print .= $left."------------------------------------------\n";
				$print .= $left.$vv."\n";//ojin
				
				$final=0;$i=1;
				while($result_report  = mysqli_fetch_array($sql_login)) 
				{
					$final=$final + $result_report['re_amount'];
					$dt=explode("-",$result_report['Date']);
					$date=$dt[2]."-".$dt[1]."-".$dt[0];
					
					$menulist= array(
						new menulist($i,$date,$result_report['re_billno'], number_format($result_report['re_amount'],$_SESSION['be_decimal']),$printer_style),
					);
					foreach($menulist as $menulist) {
						$print .=$left.($menulist);
					}
					
					
					
					
					//$print .= $left.$i."    ".$date."     ".$result_report['bm_billno']."   ".$result_report['bm_finaltotal']."\n";
					$i++;
				}
				$print .= $left.$vv."\n";//ojin
				$print .=$center."                  Total = ".$bold_on.number_format($final,$_SESSION['be_decimal']).$bold_off."\n";
				$print .= $left.$vv."\n";//ojin
				
				
				
				$print .="\n\n\n\n\n";
				$print.=$cutpaper;
				
				//And pr_floorid='".$florrid."'
				$sql_kots="Select pr_defaultusb,pr_usbprinterip,pr_usbprinter,pr_printerip,pr_printerport From tbl_printersettings  Where pr_branchid ='".$_SESSION['branchofid']."' and pr_printertype='".$_SESSION['reportprint_tp']."' ";
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
    else if($_REQUEST['type']=="bill_cancel")
	{
		$string='';
		$print='';
		$from='';
		$to='';
		$typestring='';
		 $date=date("Ymd");
		 $string="( b.bm_status= 'Cancelled' OR b.bm_status= 'Cancelled for Split')  AND ";
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
			$bydatz=$_REQUEST['hidbydate'];
			if($bydatz!="null")
			{
			//$search="";
		
		if($bydatz=="Last5days")
		{
			$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
			$typestring="Last 5 days";
		}elseif($bydatz=="Last10days")
		{
			$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
			$typestring="Last 10 days";
		}
		elseif($bydatz=="Last15days")
		{
			$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
			$typestring="Last 15 days";
		}
		else if($bydatz=="Last20days")
		{
			$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
			$typestring="Last 20 days";
		}
		else if($bydatz=="Last25days")
		{
			$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
			$typestring="Last 25 days";
		}
		else if($bydatz=="Last30days")
		{
			$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
			$typestring="Last 30 days";
		}
		else if($bydatz=="Today")
		{
			$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
			$typestring="Today";
		}
		else if($bydatz=="Yesterday")
		{
			$string.="bm_dayclosedate = CURDATE() - INTERVAL 1 day";
			$typestring="Yesterday";
		}
		 else if($bydatz=="Last1month")
		{
			$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			$typestring="Last 1 month";
		}
		else if($bydatz=="Last90days")
			{
				$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
				$typestring="Last 90 days"; 
			}
		else if($bydatz=="Last180days")
			{
				$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
				$typestring="Last 180 days";
			}
		else if($bydatz=="Last365days")
			{
				$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
				$typestring="Last 365 days";
			}
		}
		else
		{
			$from=date("Y-m-d");
				$to=date("Y-m-d");
				$string.= "bm_dayclosedate between '".$from."' and '".$to."' ";
		}
		}
		  $cur=date("Y-m-d");
		  $sql_login  =  $database->mysqlQuery("select bm_finaltotal,bm_dayclosedate,bm_billno,bm_finaltotal 
		  										from tbl_tablebillmaster where $string"); 
		  $num_login   = $database->mysqlNumRows($sql_login);
		  if($num_login)
		  {			  
				$print .= $center.$bold_on."Bill Cancel Report".$bold_off."\n";
				if($from=='' && $to=='')
				{
					$print .= $center.$bold_on.$typestring.$bold_off."\n";
				}
				else
				{
				$print .= $center.$bold_on.$from." To ".$to.$bold_off."\n";
				}
				
				if($printer_style=='1'){
                                $vv=str_pad("-",  '47%', "-");//46
                                }
                                else if($printer_style=='2'){
                                     $vv=str_pad("-",  '42%', "-");
                                }
				$print .= $left."\n";//ojin
				$menulist= array(
					new menulist("Slno","Date","Bilno", "Final",$printer_style),
				);
				foreach($menulist as $menulist) {
					$print .=$left.($menulist);
				}
				$print .= $left.$vv."\n";//ojin
				
				$final=0;$i=1;
				while($result_report  = mysqli_fetch_array($sql_login)) 
				{
					$final=$final + $result_report['bm_finaltotal'];
					$dt=explode("-",$result_report['bm_dayclosedate']);
					$date=$dt[2]."-".$dt[1]."-".$dt[0];
					
					$menulist= array(
						new menulist($i,$date,$result_report['bm_billno'], number_format($result_report['bm_finaltotal'],$_SESSION['be_decimal']),$printer_style),
					);
					foreach($menulist as $menulist) {
						$print .=$left.($menulist);
					}
					$i++;
				}
				$print .= $left.$vv."\n";//ojin
				$print .=$center."                      Total = ".$bold_on.number_format($final,$_SESSION['be_decimal']).$bold_off."\n";
				$print .= $left.$vv."\n";//ojin		
				$print .="\n\n\n\n\n";
				$print.=$cutpaper;				
				$sql_kots="Select pr_defaultusb,pr_usbprinterip,pr_usbprinter,pr_printerip,pr_printerport From tbl_printersettings  Where pr_branchid ='".$_SESSION['branchofid']."' and pr_printertype='".$_SESSION['reportprint_tp']."' ";
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
    else if($_REQUEST['type']=="summary")
	{
		$string='';
		$print='';
		$from='';
		$to='';
		$typestring='';
		  $string='';
        $reporthead="";
	$strings="bm_status='Closed' AND ";
	$string_pax="";
	$string_pax="bm_status='Closed' AND ";
	
	$string1_str=" (sum(bm_amountpaid) - sum(bm_amountbalace)) ";
	$string2_str=" sum(bm_transactionamount) ";
	$string3_str=" (sum(bm_finaltotal) - (sum(bm_amountpaid)-sum(bm_amountbalace))) ";
        $string4_str=" (sum(bm_finaltotal) - (sum(bm_amountpaid)-sum(bm_amountbalace))) ";
	$string5_str=" (sum(bm_finaltotal) - (sum(bm_amountpaid)-sum(bm_amountbalace)))";
	$string6_str=" (sum(bm_finaltotal) - (sum(bm_amountpaid)-sum(bm_amountbalace)))";
        $string7_str=" sum(bm_finaltotal)";
	
                $string1 =$strings. " ((pym_code='cash') or (pym_code='credit') or (pym_code='coupon') or (pym_code='voucher') or (pym_code='cheque') or (pym_code='credit_person') or (pym_code='complimentary')   ) AND ";
		$string2 = " pym_code='credit'  AND ";//"credit"  bm_transactionamount <>''
		$string3 =$strings. " pym_code='coupon'  AND";//"coupons"  bm_couponcompany <>''  and bm_couponamt <>'0.00'
		$string4 =$strings. " pym_code='voucher' AND";//"voucher" bm_voucherid <>''
		$string5 =$strings. " pym_code='cheque' AND";//"cheque" bm_chequeno <>'' and bm_chequebankname<>''
		$string6=$strings. " pym_code='credit_person' AND ";
            $string7=$strings. " pym_code='complimentary' AND";
	
			if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
			{
				$from=$database->convert_date($_REQUEST['hidfr']);
				$to=$database->convert_date($_REQUEST['hidto']);
				$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
				$string_pax.= "  (bm_dayclosedate  between '".$from."' and '".$to."' ) ";
				$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to) ; 
			}
			else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
			{
				$from=$database->convert_date($_REQUEST['hidfr']);
				$to=date("Y-m-d");
				$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
				$string_pax.= "  (bm_dayclosedate between '".$from."' and '".$to."' ) ";
				$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to) ; 
			}
			else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
			{
				$from=date("Y-m-d");
				$to=$database->convert_date($_REQUEST['hidto']);
				$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
				
				$string_pax.= "  (bm_dayclosedate  between '".$from."' and '".$to."' ) ";
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
			$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
			$string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
			$typestring="Last 5 days";
		}elseif($bydatz=="Last10days")
		{
			$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
			$string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
			$typestring="Last 10 days";
		}
		elseif($bydatz=="Last15days")
		{
			$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
			$string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
			$typestring="Last 15 days";
		}
		else if($bydatz=="Last20days")
		{
			$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
			$string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
			$typestring="Last 20 days";
		}
		else if($bydatz=="Last25days")
		{
			$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
			$string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
			$typestring="Last 25 days";
		}
		else if($bydatz=="Last30days")
		{
			$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
			$string_pax.= " bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
			$typestring="Last 30 days";
		}
		else if($bydatz=="Today")
		{
			$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
			$string_pax.= "bm_dayclosedate between  CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
			$typestring="Today";
		}
		else if($bydatz=="Yesterday")
		{
			$string.=" bm_dayclosedate = CURDATE() - INTERVAL 1 day";
			$string_pax.= "bm_dayclosedate = CURDATE() - INTERVAL 1 day";
			$typestring="Yesterday";
		}
		 else if($bydatz=="Last1month")
		{
			$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			$string_pax.= "bm_dayclosedate between  CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			$typestring="Last 1 month";
		}
		else if($bydatz=="Last90days")
			{
				$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
				$string_pax.= " bm_dayclosedate  between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
				$typestring="Last 90 days"; 
			}
		else if($bydatz=="Last180days")
			{
				$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
				$string_pax.= "bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
				$typestring="Last 180 days";
			}
		else if($bydatz=="Last365days")
			{
				$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
				$string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
				$typestring="Last 365 days";
			}
		}
		else
		{
			$from=date("Y-m-d");
				$to=date("Y-m-d");
				$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
				$string_pax.= " bm_dayclosedate   between '".$from."' and '".$to."'";
		}
		}
		  $cur=date("Y-m-d");
		  $print .= $center.$bold_on.$branchname.$bold_off."\n";
		  $print .= $center.$bold_on."Summary".$bold_off."\n";
				if($from=='' && $to=='')
				{
					$print .= $center.$bold_on.$typestring.$bold_off."\n";
				}
				else
				{
				$print .= $center.$bold_on.$database->convert_date($from)." To ".$database->convert_date($to).$bold_off."\n";
				}
                                if($printer_style=='1'){
                                    $vv=str_pad("-",  '46%', "-");//46

                                    }
                                    else if($printer_style=='2'){
                                         $vv=str_pad("-",  '42%', "-");
                                    }
				$print .= $left.$vv."\n";//ojin
				$bilno= array(
					new bilno("Type","Value",$printer_style),
				);
				foreach($bilno as $bilno) {
					$print .=$left.($bilno);
				}
				$print .= $left.$vv."\n";//ojin
				$final=0;$i=1;
		  
		  
		  $sql_login  =  $database->mysqlQuery("select $string1_str as tot from tbl_tablebillmaster  bm  left join tbl_paymentmode on bm.bm_paymode=tbl_paymentmode.pym_id  where $string1"."$string order by bm_dayclosedate,bm_billtime ASC"); 
          $num_login   = $database->mysqlNumRows($sql_login);
		  if($num_login)
		  {				
				while($result_report  = mysqli_fetch_array($sql_login)) 
				{
					if($result_report['tot'] != "")
			{
					$subtotal =$subtotal + $result_report['tot'];
					$bilno= array(
						new bilno("Cash",number_format($result_report['tot'],$_SESSION['be_decimal']),$printer_style),
					);
					foreach($bilno as $bilno) {
						$print .=$left.($bilno);
					}
					$i++;
				}
		  }}
	
	$sql_login1  =  $database->mysqlQuery("select bm_name as bank_name, (sum(bm_transactionamount)) as tot from tbl_tablebillmaster tb  , tbl_bankmaster b    where  b.bm_id = tb.bm_transcbank and tb.bm_status='Closed' AND $string  group by b.bm_name order by tb.bm_dayclosedate,tb.bm_billtime ASC");      
	  $num_login1   = $database->mysqlNumRows($sql_login1);		  
		    if($num_login1)
		  {				
				while($result_report1  = mysqli_fetch_array($sql_login1)) 
				{
				$subtotal =$subtotal + $result_report1['tot'];
					$bilno= array(
						new bilno("Card",number_format($result_report1['tot'],$_SESSION['be_decimal']),$printer_style),
					);
					foreach($bilno as $bilno) {
						$print .=$left.($bilno);
					}
					$i++;
				}
		  }
		  
                  
                  $sql_logincredit  =  $database->mysqlQuery(" select  distinct (b.bm_name) as bnk,sum(bc.mc_cardamount) as tot
                FROM tbl_tablebillmaster bm
                left join tbl_paymentmode on bm.bm_paymode=tbl_paymentmode.pym_id  
                left join tbl_bill_card_payments bc on bc.mc_billno=bm.bm_billno
                left join tbl_bankmaster b on  b.bm_id = bc.mc_to_bank 
                where  tbl_paymentmode.pym_code='credit' and  bm.bm_status='Closed' 
                AND bm.bm_complimentary!='Y' AND  $string group by bnk ") ;                          

                  $num_logincredit   = $database->mysqlNumRows($sql_logincredit);
                  if($num_logincredit){
                          while($result_logincredit  = $database->mysqlFetchArray($sql_logincredit)) 
                                {   
                              
                        $bilno= array(
						new bilno($result_logincredit['bnk'],number_format($result_logincredit['tot'],$_SESSION['be_decimal']),$printer_style),
					);
					foreach($bilno as $bilno) {
						$print .=$left.($bilno);
					}
					$i++;      
                              
                              
                          }
                          }
                  
		  
		  
		   $sql_login  =  $database->mysqlQuery("select $string6_str as tot from tbl_tablebillmaster bm left join tbl_paymentmode pm ON pm.pym_id = bm.bm_paymode where $string6"."$string   order by bm_dayclosedate,bm_billtime ASC"); 
		  
		  $num_login   = $database->mysqlNumRows($sql_login);
		  if($num_login)
		  {
				
				while($result_report  = mysqli_fetch_array($sql_login)) 
				{
					if($result_report['tot'] != "")
			{
					$subtotal =$subtotal + $result_report['tot'];
					$bilno= array(
						new bilno("Credit Sale",number_format($result_report['tot'],$_SESSION['be_decimal']),$printer_style),
					);
					foreach($bilno as $bilno) {
						$print .=$left.($bilno);
					}
                                        
					//$i++;
				}
		  }}
		  
		   $sql_login  =  $database->mysqlQuery("select $string3_str as tot from tbl_tablebillmaster bm left join tbl_paymentmode pm ON pm.pym_id = bm.bm_paymode where $string3"."$string order by bm_dayclosedate,bm_billtime ASC"); 
		  $num_login   = $database->mysqlNumRows($sql_login);
		  if($num_login)
		  {
				
				while($result_report  = mysqli_fetch_array($sql_login)) 
				{
						if($result_report['tot'] != "")
			{
					$subtotal =$subtotal + $result_report['tot'];
					$bilno= array(
						new bilno("Coupons",number_format($result_report['tot'],$_SESSION['be_decimal']),$printer_style),
					);
					foreach($bilno as $bilno) {
						$print .=$left.($bilno);
					}
					$i++;
				}
		  }}
		  
		   $sql_login  =  $database->mysqlQuery("select $string4_str as tot from tbl_tablebillmaster bm left join tbl_paymentmode pm ON pm.pym_id = bm.bm_paymode where $string4"."$string order by bm_dayclosedate,bm_billtime ASC"); 
		  $num_login   = $database->mysqlNumRows($sql_login);
		  if($num_login)
		  {
				
				while($result_report  = mysqli_fetch_array($sql_login)) 
				{
						if($result_report['tot'] != "")
						{
					$subtotal =$subtotal + $result_report['tot'];
					$bilno= array(
						new bilno("Voucher",number_format($result_report['tot'],$_SESSION['be_decimal']),$printer_style),
					);
					foreach($bilno as $bilno) {
						$print .=$left.($bilno);
					}
					$i++;
				}
		  }}
		  
		   $sql_login  =  $database->mysqlQuery("select $string5_str as tot from tbl_tablebillmaster bm left join tbl_paymentmode pm ON pm.pym_id = bm.bm_paymode where $string5"."$string order by bm_dayclosedate,bm_billtime ASC"); 
		  $num_login   = $database->mysqlNumRows($sql_login);
		  if($num_login)
		  {
				
				while($result_report  = mysqli_fetch_array($sql_login)) 
				{
						if($result_report['tot'] != "")
						{
					$subtotal =$subtotal + $result_report['tot'];
					$bilno= array(
						new bilno("Cheque",number_format($result_report['tot'],$_SESSION['be_decimal']),$printer_style),
					);
					foreach($bilno as $bilno) {
						$print .=$left.($bilno);
					}
                                        
					$i++;
				}
		  }}
                  ///cpmplimentary-----------
                  $sql_login  =  $database->mysqlQuery("select $string7_str as tot from tbl_tablebillmaster bm left join tbl_paymentmode pm ON pm.pym_id = bm.bm_paymode where $string7"."$string order by bm_dayclosedate,bm_billtime ASC"); 
                  $num_login   = $database->mysqlNumRows($sql_login);
		  if($num_login)
		  {
				
				while($result_report  = mysqli_fetch_array($sql_login)) 
				{
					if($result_report['tot'] != "")
			{
					$bilno= array(
						new bilno("Complimetary",number_format($result_report['tot'],$_SESSION['be_decimal']),$printer_style),
					);
					foreach($bilno as $bilno) {
						$print .=$left.($bilno);
					}
					$i++;
				}
		  }}
                  ///cpmplimentary-----------
		  
		  $qtycount=0;
		   $sql_stw  =  $database->mysqlQuery("SELECT sum(bm_totalpax) as ct FROM `tbl_tablebillmaster` WHERE $string_pax"); 
	  $num_stw   = $database->mysqlNumRows($sql_stw);
	  if($num_stw){
		  while($result_stw  = $database->mysqlFetchArray($sql_stw)) 
			{
				$qtycount=$qtycount + $result_stw['ct'];
			}
	  }
	 			 $bilno= array(
						new bilno("Total Pax",$qtycount,$printer_style),
					);
					foreach($bilno as $bilno) {
						$print .=$left.($bilno);
					}
		  
		  
				$print .= $left.$vv."\n";//ojin
				$print .=$center."Total = ".$bold_on.number_format($subtotal,$_SESSION['be_decimal']).$bold_off."\n";
				$print .= $left.$vv."\n";//ojin

				$print .="\n\n\n\n\n";
				$print.=$cutpaper;
				
				//And pr_floorid='".$florrid."'
				$sql_kots="Select pr_defaultusb,pr_usbprinterip,pr_usbprinter,pr_printerip,pr_printerport From tbl_printersettings  Where pr_branchid ='".$_SESSION['branchofid']."' and pr_printertype='".$_SESSION['reportprint_tp']."' ";
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
    else if($_REQUEST['type']=="turnover_report")
	{
		$string12="";
            $string13="";
                    $string="";
                    $date = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') +0 , date('Y')));
                $parts = explode('-', $date);
                $string12 = date(
                    'd-m-Y', 
                    mktime(0, 0, 0, $parts[1], $parts[2] + 0, $parts[0])
                    //              ^ Month    ^ Day       ^ Year
                );
                
                       $start = $string12;
                    for($i=0; $i < 1; $i++) {
                     $string13= date("d-m-Y", strtotime("$start - " . ($i*1) . " day")) . "<br>";
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
                 
		    $string12=$_REQUEST['fromdt'];
                    $string13=$_REQUEST['todt'];
		}
		
		
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
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
			$string_pax.= " bm_dayclosedate   between '".$from."' and '".$to."'";
		}
		}
		  $cur=date("Y-m-d");
		  $print .= $center.$bold_on.$branchname.$bold_off."\n";
		  $print .= $center.$bold_on."Turnover Report".$bold_off."\n";
				if($from=='' && $to=='')
				{
                                    $print .= $center.$bold_on.$typestring.$bold_off."\n";
				}
				else
				{
                                    $print .= $center.$bold_on.$database->convert_date($from)." To ".$database->convert_date($to).$bold_off."\n";
				}
			$print .= $reporthead."\n";
				$vv=str_pad("-",  '46%', "-");//46
				$print .= $left.$vv."\n";//ojin
				$bilno= array(
					new bilno("Type","Value"),
				);
				foreach($bilno as $bilno) {
					$print .=$left.($bilno);
				}
				$print .= $left.$vv."\n";//ojin
				$final=0;$i=1;
		  
		  
	$database->mysqlQuery("SET @fromdate = " . "'" . $string12 . "'");
	$database->mysqlQuery("SET @todate = " . "'" . $string13 . "'");
		
        $gross_turnover='';
        $total_ser_tax='';
        $total_vat='';
        $total_tax='';
        $net_turnover='';
        $total_extra_vat = '';
        $total_pax = '';
        $tot = '';
      	$sq=$database->mysqlQuery("CALL proc_total_turnover(@fromdate,@todate,@gross_turnover,@total_ser_tax,@total_vat,@total_extra_vat,@total_tax,@net_turnover,@tot_pax)");
	$rs = $database->mysqlQuery( 'SELECT  @gross_turnover AS gross_turnover, @total_ser_tax AS total_ser_tax, @total_vat AS total_vat, @total_extra_vat AS total_extra_vat, @total_tax AS total_tax, @net_turnover AS net_turnover, @tot_pax AS tot_pax');
        while($row = mysqli_fetch_array($rs))
	{
            $gross_turnover= $row['gross_turnover'];
            $total_ser_tax= $row['total_ser_tax'];
            $total_vat= $row['total_vat'];
            $total_tax= $row['total_tax'];
            $net_turnover= $row['net_turnover'];
            $total_extra_vat= $row['total_extra_vat'];
            $total_pax= $row['tot_pax'];
            $tot = $total_vat + $total_extra_vat;
					
		$bilno= array(
                    new bilno("GROSS TURN OVER",number_format($gross_turnover,$_SESSION['be_decimal'])),
		);
		foreach($bilno as $bilno) {
                    $print .=$left.($bilno);
		}
                
                $bilno= array(
                    new bilno($taxname2." COOKED ITEM",number_format($total_vat,$_SESSION['be_decimal'])),
		);
		foreach($bilno as $bilno) {
                    $print .=$left.($bilno);
		}
                
                $bilno= array(
                    new bilno($taxname2." BOUGHT OUT",number_format($total_extra_vat,$_SESSION['be_decimal'])),
		);
		foreach($bilno as $bilno) {
                    $print .=$left.($bilno);
		}
                
                $bilno= array(
                    new bilno("TOTAL ".$taxname2,number_format($tot,$_SESSION['be_decimal'])),
		);
		foreach($bilno as $bilno) {
                    $print .=$left.($bilno);
		}
                
                $bilno= array(
                    new bilno("TOTAL ".$taxname1,number_format($total_ser_tax,$_SESSION['be_decimal'])),
		);
		foreach($bilno as $bilno) {
                    $print .=$left.($bilno);
		}
                
                $bilno= array(
                    new bilno("TOTAL TAX",number_format($total_tax,$_SESSION['be_decimal'])),
		);
		foreach($bilno as $bilno) {
                    $print .=$left.($bilno);
		}
                
                $bilno= array(
                    new bilno("NET TURN OVER",number_format($net_turnover,$_SESSION['be_decimal'])),
		);
		foreach($bilno as $bilno) {
                    $print .=$left.($bilno);
		}
                
                $bilno= array(
                    new bilno("TOTAL PAX",($total_pax)),
		);
		foreach($bilno as $bilno) {
                    $print .=$left.($bilno);
		}
		$i++;
	}

		  
		  
//				$print .= $left.$vv."\n";//ojin
//				$print .=$center."Total = ".$bold_on.round($subtotal).$bold_off."\n";
				$print .= $left.$vv."\n";//ojin

				$print .="\n\n\n\n\n";
				$print.=$cutpaper;
				
				//And pr_floorid='".$florrid."'
				$sql_kots="Select pr_defaultusb,pr_usbprinterip,pr_usbprinter,pr_printerip,pr_printerport From tbl_printersettings  Where pr_branchid ='".$_SESSION['branchofid']."' and pr_printertype='".$_SESSION['reportprint_tp']."' ";
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
   else if(($_REQUEST['type']=="steward"))
{
	$stw=$_REQUEST['stwrd'];
	$string="";
	$reporthead="";
	$st="";
        $string1='';
      if($_REQUEST['stw_mode']=='Cancel'){
        $string .= "  bm.bm_status='Cancelled' ";
      }else{
        $string .= "  bm.bm_status='Closed' ";   
      }
	
			$stewardbydate=$_REQUEST['hidbydate'];             
          $string1.=" ch.ch_cancelledby_careof ='".$_REQUEST['stwrd']."' and ";   
          
                        
	if($stewardbydate!="null")
	{

	
	if($stewardbydate=="Last5days")
	{
            
             $string1.= " ch.ch_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
		$string.=" and bm.bm_dayclosedate  between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";

$st="Last 5 days";
	}elseif($stewardbydate=="Last10days")
	{
            
             $string1.= " ch.ch_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
		$string.=" and bm.bm_dayclosedate   between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";

$st="Last 10 days";
	}
	elseif($stewardbydate=="Last15days")
	{
            
             $string1.= " ch.ch_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
		$string.="and bm.bm_dayclosedate  between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
$st="Last 15 days";
	}
	else if($stewardbydate=="Last20days")
	{
            
             $string1.= " ch.ch_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
		$string.="and bm.bm_dayclosedate  between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
$st="Last 20 days";
	}
	else if($stewardbydate=="Last25days")
	{
             $string1.= " ch.ch_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
		$string.="and bm.bm_dayclosedate   between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
$st="Last 25 days";
	}
	else if($stewardbydate=="Last30days")
	{
             $string1.= " ch.ch_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
		$string.="and bm.bm_dayclosedate   between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
$st="Last 30 days";
	}
	else if($stewardbydate=="Today")
	{
            $string1.= " ch.ch_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
		$string.="and bm.bm_dayclosedate  between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
		$st="Today";
	}
	else if($stewardbydate=="Yesterday")
			  {
             $string1.= " ch.ch_dayclosedate between CURDATE( ) - INTERVAL 1 day";
				  $string.="and bm.bm_dayclosedate  =  CURDATE() - INTERVAL 1 day";
				  $st="Yesterday";
			  }
	else if($stewardbydate=="Last1month")
	{
             $string1.= " ch.ch_dayclosedate between CURDATE( ) - INTERVAL  1 MONTH AND CURDATE( )";
		$string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
$st="Last 1 month";
	}
	
	else if($stewardbydate=="Last90days")
	{
             $string1.= " ch_dayclosedate between CURDATE( ) - INTERVAL  3 MONTH AND CURDATE( )";
		$string.="and bm.bm_dayclosedate  between CURDATE( ) - INTERVAL  3 MONTH AND CURDATE( )"; 
	$st="Last 3 months";
	}

else if($stewardbydate=="Last180days")
	{
      $string1.= " ch.ch_dayclosedate between CURDATE( ) - INTERVAL  6 MONTH AND CURDATE( )";
		$string.="and bm.bm_dayclosedate  between CURDATE( ) - INTERVAL  6 MONTH AND CURDATE( )"; 
			$st="Last 6 months";
	}
else if($stewardbydate=="Last365days")
	{
		  $string1.= " ch.ch_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
		$string.="and bm.bm_dayclosedate   between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
			$st="Last 1 year";
	}
	$reporthead=$st;

        }
	if($_REQUEST['from']!="" && $_REQUEST['to']!="")
		{
			$from=$database->convert_date($_REQUEST['from']);
			$to=$database->convert_date($_REQUEST['to']);
			$string.= " and ( bm.bm_dayclosedate  between '".$from."' and '".$to."' ) ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                         $string1.= " ch.ch_dayclosedate between '".$from."' and '".$to."'  ";
		}
		else if($_REQUEST['from']!="" && $_REQUEST['to']=="")
		{
			$from=$database->convert_date($_REQUEST['from']);
			$to=date("Y-m-d");
			$string.= " and ( bm.bm_dayclosedate between '".$from."' and '".$to."' ) ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                         $string1.= " ch.ch_dayclosedate between '".$from."' and '".$to."'  ";
		}
		else if($_REQUEST['from']=="" && $_REQUEST['to']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['to']);
			$string.= " and ( bm.bm_dayclosedate  between '".$from."' and '".$to."' )  ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                         $string1.= " ch.ch_dayclosedate between '".$from."' and '".$to."'  ";
		}else if($_REQUEST['from']=="" && $_REQUEST['to']=="" && ($stewardbydate=='' || $stewardbydate=='null' ))
		{
			$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " and ( bm.bm_dayclosedate between '".$from."' and '".$to."' )  ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                        
                        $string1.= " ch.ch_dayclosedate between '".$from."' and '".$to."'  ";
		} 

                $print .= $center.$bold_on."".$bold_off."\n";
				$print .= $center.$bold_on." Steward Report".$addon_head.$bold_off."\n";
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
				
				$vv=str_pad("-",  '47%', "-");//46
				$print .= $left.$vv."\n";//ojin
				//$print .= $left."Slno  Date        Bilno              Final\n";
				
				
				
                
                
                
      if($_REQUEST['steward_type']=='Detailed'){
                        
                
	$sql_stw  =  $database->mysqlQuery("select m.mr_menuname  as menuname,sum(bd.bd_qty) as ct,sum((bd.bd_rate*bd.bd_qty)) as amnt
      FROM tbl_tablebilldetails bd
      left join tbl_tablebillmaster bm on bd.bd_billno = bm.bm_billno
      left join tbl_menumaster m on bd.bd_menuid = m.mr_menuid
      left join tbl_staffmaster sm ON sm.ser_staffid = bm.bm_steward
      where $string
      and  bm.bm_steward = '".$stw."'
      group by menuname  order by bm.bm_finaltotal asc");
               
		$menulist= array(
						new steward_new1('Sl','Item','Count','Amount',$printer_style),
					
                                            );
					
                                      					
					foreach($menulist as $menulist) {
					$print .=$left.($menulist);
                                        
					
					}
	$print .= $left.$vv."\n";//ojin
	
 	  $total_count = 0;
          $total_amount = 0;
	  $num_stw   = $database->mysqlNumRows($sql_stw);
	  if($num_stw){$i=1;
		  while($result_stw  = $database->mysqlFetchArray($sql_stw)) 
			{
                      //print_r($result_stw);die();
                      $total_count = $total_count + $result_stw['ct'];
                      $total_amount = $total_amount + $result_stw['amnt'];
                      
                      
                      
                      $menulist= array(
						new steward_new1($i++,$result_stw['menuname'],$result_stw['ct'],number_format($result_stw['amnt'],$_SESSION['be_decimal']),$printer_style),
					
                                            );
					
                                      					
					foreach($menulist as $menulist) {
					$print .=$left.($menulist);
                                        
					
					}
				
			}
                        
	  }
          
          $print .= $left.$vv."\n";//ojin
          $menulist= array(
						new steward_new1('Total','',$total_count,number_format($total_amount,$_SESSION['be_decimal']),$printer_style),
					
                                            );
					
                                      					
					foreach($menulist as $menulist) {
					$print .=$left.($menulist);
                                        
					
					}
	  $print .= $left.$vv."\n";//ojin
      
}else{
    
  
    if($_REQUEST['stw_mode']=='Sale'){
    
         $menulist= array(
						new steward_new1('Sl',' Date ',' Bills',' Amount',$printer_style),
					
                                            );
					
                                      					
					foreach($menulist as $menulist) {
					$print .=$left.($menulist);
                                        
					
					}
    $print .= $left.$vv."\n";//ojin
   
	$sql_stw1  =  $database->mysqlQuery("select count(bm.bm_billno) as billcount,bm.bm_dayclosedate,sum(bm.bm_subtotal_final) as amt_new
        FROM   tbl_tablebillmaster bm 
     
        where $string
        and  bm.bm_steward = '".$stw."'
        group by bm.bm_dayclosedate  ");
       
	
 	 
          $total_amount1 = 0; $total_amount12= 0;
	  $num_stw1   = $database->mysqlNumRows($sql_stw1);
	  if($num_stw1){$i=1;
		  while($result_stw1  = $database->mysqlFetchArray($sql_stw1)) 
			{
                     
                    
                      $total_amount1 = $total_amount1 + $result_stw1['amt_new'];
                      $menulist= array(
						new steward_new1($i++,$result_stw1['bm_dayclosedate'],$result_stw1['billcount'],number_format($result_stw1['amt_new'],$_SESSION['be_decimal']),$printer_style),
					
                                            );
					
                                      					
					foreach($menulist as $menulist) {
					$print .=$left.($menulist);
                                        
					
					}
                     	
			}
                        
	  }
          
          $print .= $left.$vv."\n";//ojin
          $menulist= array(
						new steward_new1('Total','','',number_format($total_amount1,$_SESSION['be_decimal']),$printer_style),
					
                                            );
					
                                      					
					foreach($menulist as $menulist) {
					$print .=$left.($menulist);
                                        
					
					}
	  $print .= $left.$vv."\n";//ojin
      
}else if($_REQUEST['stw_mode']=='Cancel'){
    
    
      $menulist= array(
						new steward_new1('Sl ',' Date',' Bills',' Amount',$printer_style),
					
                                            );
					
                                      					
					foreach($menulist as $menulist) {
					$print .=$left.($menulist);
                                        
					
					}
    
    $print .= $left.$vv."\n";//ojin
	$sql_stw1  =  $database->mysqlQuery("select count(bm.bm_billno) as billcount,bm.bm_dayclosedate,sum(bm.bm_subtotal_final) as amt_new
        FROM   tbl_tablebillmaster bm  where $string and  bm.bm_steward = '".$stw."' group by bm.bm_dayclosedate  ");      
          $total_amount1 = 0; $total_amount12= 0;
	  $num_stw1   = $database->mysqlNumRows($sql_stw1);
	  if($num_stw1){$i=1;
		  while($result_stw1  = $database->mysqlFetchArray($sql_stw1)) 
			{
                      $total_amount1 = $total_amount1 + $result_stw1['amt_new'];
                      
                      $menulist= array(
						new steward_new1($i++,$result_stw1['bm_dayclosedate'],$result_stw1['billcount'],number_format($result_stw1['amt_new'],$_SESSION['be_decimal']),$printer_style),
					
                                            );                					
					foreach($menulist as $menulist) {
					$print .=$left.($menulist);
					}      	
			}
                        
	  }
          $print .= $left.$vv."\n";//ojin
          
          $menulist= array(
						new steward_new1('Total','','',number_format($total_amount1,$_SESSION['be_decimal']),$printer_style),
					
                                            );
					
                                      					
					foreach($menulist as $menulist) {
					$print .=$left.($menulist);
                                        
					
					}
	  
    
    $print .= $left.$vv."\n";//ojin
    
}else{
    
    $menulist= array(
						new steward_new1('KOT ',' Item',' Qty ',' Amount',$printer_style),
					
                                            );
					
                                      					
					foreach($menulist as $menulist) {
					$print .=$left.($menulist);
                                        
					
					}
    
    $print .= $left.$vv."\n";//ojin
     $tot1=0; $tot2=0;
     $sql_login  =  $database->mysqlQuery("Select t.ter_count_combo_ordering,cmb.cod_combo_pack_rate,t.ter_rate,ch.ch_dayclosedate,ch_kotno,ch.ch_entrydate,ch.ch_orderno,ch.ch_orderslno,ch.ch_cancelled_qty,ch_cancelledreason,m.mr_menuname,t.ter_entrytime From tbl_tableorder_changes as ch  left join tbl_tableorder as t ON t.ter_orderno = ch.ch_orderno and t.ter_slno = ch_orderslno left join tbl_menumaster as m on m.mr_menuid = t.ter_menuid left join tbl_combo_ordering_details cmb on cmb.cod_orderno=ch.ch_orderno   where  $string1 group by ch.ch_orderno,m.mr_menuname,t.ter_count_combo_ordering"); 
	$num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
                 		
	          
                      
                   if($result_login['ter_count_combo_ordering']=='' ){
                         
                          $tot1=$tot1+($result_login['ch_cancelled_qty']*$result_login['ter_rate']);  
                         
                         
                        $menulist= array(
						new steward_new1($result_login['ch_kotno'],$result_login['mr_menuname'],$result_login['ch_cancelled_qty'],number_format(($result_login['ch_cancelled_qty']*$result_login['ter_rate']),$_SESSION['be_decimal']),$printer_style),
					
                                            );
					
                                      					
					foreach($menulist as $menulist) {
					$print .=$left.($menulist);
                                        
					
					}
                                        
                     }else{
                         
                          $tot2=$tot2+($result_login['ch_cancelled_qty']*$result_login['cod_combo_pack_rate']);   
                         
                          
                           $menulist= array(
						new steward_new1($result_login['ch_kotno'],$result_login['mr_menuname'],$result_login['ch_cancelled_qty'],number_format(($result_login['ch_cancelled_qty']*$result_login['cod_combo_pack_rate']),$_SESSION['be_decimal']),$printer_style),
					
                                            );
					
                                      					
					foreach($menulist as $menulist) {
					$print .=$left.($menulist);
                                        
					
					}
                     }
                              
            
  
  	
  
  
   }
}


$print .= $left.$vv."\n";//ojin
                                $menulist= array(
						new steward_new1('Total','','',number_format(($tot1+$tot2),$_SESSION['be_decimal']),$printer_style),
					
                                            );
					
                                      					
					foreach($menulist as $menulist) {
					$print .=$left.($menulist);
                                        
					
					}	
                                        $print .= $left.$vv."\n";//ojin
					//$print .= $left.$i."    ".$date."     ".$result_report['bm_billno']."   ".$result_report['bm_finaltotal']."\n";
					
}				
}			
				$print .="\n\n\n\n\n";
				$print.=$cutpaper;
				
				//And pr_floorid='".$florrid."'
				$sql_kots="Select pr_defaultusb,pr_usbprinterip,pr_usbprinter,pr_printerip,pr_printerport From tbl_printersettings  Where pr_branchid ='".$_SESSION['branchofid']."' and pr_printertype='".$_SESSION['reportprint_tp']."' ";
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
    else if($_REQUEST['type']=="order")
	{
            $string ="";
            $string="bm.bm_status = 'Closed'";
            $from='';
            $to='';
            $reporthead="";
            $st="";
            $floor_name='';
	    $print='';
            $vv='';
            if(isset ($_REQUEST['floorvalue']))
	{
		
		$floorvalue=$_REQUEST['floorvalue'];
                if($floorvalue!="")
                {
		
		$string.=" and bm.bm_floorid='".$floorvalue."'  ";
                $sql_floor  =  $database->mysqlQuery("select fr_floorname FROM tbl_floormaster where fr_floorid='".$floorvalue."'"); 
                            $num_floor   = $database->mysqlNumRows($sql_floor);
                            if($num_floor)
                            {
                              $result_floor  = mysqli_fetch_array($sql_floor);
                              $floor_name=$result_floor['fr_floorname'];
                            }  
                }
	}
            $string_addon="";
            $addon_head='';
            if($_REQUEST['addon']=='N')
            {  
            $string_addon.=" and bd.bd_bill_addon_slno IS NULL ";
           
            }
            else if($_REQUEST['addon']=='Y')
            {   
            $string_addon.=" and bd.bd_bill_addon_slno IS NOT NULL";
            $addon_head='-Addon ';
            }
	  if($_REQUEST['from']!="" && $_REQUEST['to']!="")
		{
		  
			$from=$database->convert_date($_REQUEST['from']);
			$to=$database->convert_date($_REQUEST['to']);
                        $string.= "and bm.bm_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
			
		}
		else if($_REQUEST['from']!="" && $_REQUEST['to']=="")
		{
			$from=$database->convert_date($_REQUEST['from']);
			$to=date("Y-m-d");
                        $string.= "and bm.bm_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
			
		}
		else if($_REQUEST['from']=="" && $_REQUEST['to']!="")
		{
			$from=$database->convert_date($_REQUEST['from']);
			$to=$database->convert_date($_REQUEST['to']);
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
                            $string.="and bm.bm_dayclosedate = CURDATE() - INTERVAL 1 day";
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

 	  $sql_stw  =  $database->mysqlQuery("SELECT mc.mmy_maincategoryname,ms.msy_subcategoryname,m.mr_menuname,p.pm_portionname,p.pm_portionshortcode,sum(bd.bd_qty) as qty,ROUND(avg(bd.bd_rate), 1) as Unit_Price, sum(bd.bd_amount) as Total from tbl_tablebilldetails bd left join tbl_menumaster m on m.mr_menuid = bd.bd_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = m.mr_maincatid left join tbl_menusubcategory ms on ms.msy_subcategoryid = m.mr_subcatid left join tbl_portionmaster p on p.pm_id = bd.bd_portion left join tbl_tablebillmaster bm on bm.bm_billno=bd.bd_billno where $string $string_addon group by m.mr_maincatid ,m.mr_subcatid,bd.bd_menuid ORDER BY mc.mmy_maincategoryname,m.mr_menuname ASC");
      $num_stw   = $database->mysqlNumRows($sql_stw);
	  if($num_stw){$i=1;$t=0;$old="";
                $print .= $center.$bold_on."Dine In".$bold_off."\n";
				$print .= $center.$bold_on."Items Ordered Report".$addon_head.$bold_off."\n";
				if($from=='' && $to=='')
				{
					$print .= $center.$bold_on.$reporthead.$bold_off."\n";
				}
				else
				{
				$print .= $center.$bold_on.$from." To ".$to.$bold_off."\n";
				}
                                if($floor_name!=''){
                                    $print .= $center.$bold_on." Floor :".$floor_name.$bold_off."\n";
                                }
                                
				/*$print .= "------------------------------------------------\n";
				$print .= "Slno    Date           Bilno               Final\n";
				$print .= "------------------------------------------------\n";*/
				
				$vv=str_pad("-",  '47%', "-");//46
				$print .= $left.$vv."\n";//ojin
				//$print .= $left."Slno  Date        Bilno              Final\n";
				
				
				$menulist= array(
					new itemordered("Item","Qty", "Total"),
				);
				foreach($menulist as $menulist) {
					$print .=$left.($menulist);
				}
                                $print .= $left.$vv."\n";
				//$print .= $left."------------------------------------------\n";
//				$print .= $left.$vv."\n";//ojin
				
				$final=0;$i=1;
                                $old="";
                                $subold="";
				while($result_report  = mysqli_fetch_array($sql_stw)) 
				{
					$final=$final + $result_report['Total'];
					$dt=explode("-",$result_report['bm_dayclosedate']);
					$date=$dt[2]."-".$dt[1]."-".$dt[0];
					
//                                        $ln="";
                                        $maincatname = $result_report['mmy_maincategoryname'];
                                        if($result_report['mmy_maincategoryname']!=$old){
                                            $print .= $left."\n";
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
						new itemordered($item,$result_report['qty'],number_format($result_report['Total'],$_SESSION['be_decimal'])),
					
                                            );
					
                                      					
					foreach($menulist as $menulist) {
					$print .=$left.($menulist);
                                        
					
					}				
					//$print .= $left.$i."    ".$date."     ".$result_report['bm_billno']."   ".$result_report['bm_finaltotal']."\n";
					$i++;
				}
				
	    
          }	
				$print .= $left.$vv."\n";
				$print .=$center.$bold_on."                              Total = ".number_format($final,$_SESSION['be_decimal']).$bold_off."\n";
				$print .= $left.$vv."\n";//ojin
				 
            
				
				$print .="\n\n\n\n\n";
				$print.=$cutpaper;
				
				//And pr_floorid='".$florrid."'
				$sql_kots="Select pr_defaultusb,pr_usbprinterip,pr_usbprinter,pr_printerip,pr_printerport From tbl_printersettings  Where pr_branchid ='".$_SESSION['branchofid']."' and pr_printertype='".$_SESSION['reportprint_tp']."' ";
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
//------------------------------------kitchen wise starts------------------------------------
    else if($_REQUEST['type']=="kitchen_wise")
	{				 
   $string="o.ter_status='Closed'";
										  $reporthead="";
										  $st="";
										  
	  if($_REQUEST['from']!="" && $_REQUEST['to']!="")
		{		  
			$from=$database->convert_date($_REQUEST['from']);
			$to=$database->convert_date($_REQUEST['to']);			
			if($string !="")
			{
				$string.= "and o.ter_dayclosedate  between '".$from."' and '".$to."' ";
			}
			else
			{
				$string.= " o.ter_dayclosedate  between '".$from."' and '".$to."' ";
			}
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
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
		else if($_REQUEST['from']!="" && $_REQUEST['to']=="")
		{
			$from=$database->convert_date($_REQUEST['from']);
			$to=date("Y-m-d");
		if($string !="")
			{
				$string.= "and o.ter_dayclosedate  between '".$from."' and '".$to."' ";
			}
			else
			{
				$string.= " o.ter_dayclosedate  between '".$from."' and '".$to."' ";
			}
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
			
						
			
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
				$string.= " o.ter_dayclosedate  between '".$from."' and '".$to."' ";
			}
		$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
					
			
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
			$orderbydate=$_REQUEST['hidbydate'];
	
			if($orderbydate!="null")
	{
	if($orderbydate=="Last5days")
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
		
		
$st="Last 5 days";
	}elseif($orderbydate=="Last10days")
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
$st="Last 10 days";
	}
	elseif($orderbydate=="Last15days")
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
$st="Last 15 days";
	}
	else if($orderbydate=="Last20days")
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
$st="Last 20 days";
	}
	else if($orderbydate=="Last25days")
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
$st="Last 25 days";
	}
	else if($orderbydate=="Last30days")
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
$st="Last 30 days";
	}
	else if($orderbydate=="Today")
	{
	if($string !="")
		{
		$string.=" and o.ter_dayclosedate  between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
		}
		else
		{
			$string.=" o.ter_dayclosedate  between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 		
		}
		$st="Today";
	}

else if($orderbydate=="Yesterday")
			  {
				    if($string !="")
				  {
					    $string.=" and o.ter_dayclosedate  =  CURDATE() - INTERVAL 1 day";
				  }
				  else
				  {
					    $string.=" o.ter_dayclosedate  =  CURDATE() - INTERVAL 1 day";
				  }
				  $st="Yesterday";
			  }
	else if($orderbydate=="Last1month")
	{
			  if($string !="")
				  {
					    $string.=" and o.ter_dayclosedate  between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
				  }
				  else
				  {
					    $string.=" o.ter_dayclosedate  between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
				  }
$st="Last 1 month";
	}

	else if($orderbydate=="Last90days")
	{
	if($string !="")
		{
		$string.=" and o.ter_dayclosedate  between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
		}
		else
		{
			$string.="o.ter_dayclosedate  between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
		}
		$st="Last 3 months";
	}
		else if($orderbydate=="Last180days")
	{
	if($string !="")
		{
		$string.=" and o.ter_dayclosedate  between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
		}
		else
		{
			$string.=" o.ter_dayclosedate  between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
		}
		$st="Last 6 months";
	}
		else if($orderbydate=="Last365days")
	{
		if($string !="")
		{	
		$string.=" and o.ter_dayclosedate  between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
			
		}
		else
		{
			$string.="o.ter_dayclosedate  between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
		}
		$st="Last 1 year";
	}
	$reporthead=$st;
	
	
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
			
			$string.= " and o.ter_dayclosedate   between '".$from."' and '".$to."' ";
			}
			else
			{	
			$string.= " o.ter_dayclosedate   between '".$from."' and '".$to."' ";
			}
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
			
		 $byflr=$_REQUEST['byflr'];

		if($byflr !="")
	{
		if($string!="")
		{
			$string.=" and  m.mr_kotcounter LIKE  '%" . $byflr ."%'";
		}else
		{
			$string.=" m.mr_kotcounter  LIKE  '%" . $byflr ."%'";
		}
	}	 
		
	}
	}  
    
	$final=0;
        
         $slno = 0;  
     $total = 0;
     $qty = 0;
$sql_ktc  =  $database->mysqlQuery("select distinct(m.mr_kotcounter),k.kr_kotname from tbl_tableorder o
inner join tbl_menumaster m on m.mr_menuid = o.ter_menuid
inner join tbl_kotcountermaster k on k.kr_kotcode = m.mr_kotcounter where $string
"); 
$num_ktc   = $database->mysqlNumRows($sql_ktc);
if($num_ktc){
  while($result_ktc  = $database->mysqlFetchArray($sql_ktc)) {
      $slno++;

 	  $sql_stw  =  $database->mysqlQuery("select m.mr_kotcounter,o.ter_menuid, m.mr_menuname,sum(o.ter_qty) as qty, o.ter_rate*sum(o.ter_qty) as tot from tbl_tableorder o
inner join tbl_menumaster m on m.mr_menuid = o.ter_menuid
where m.mr_kotcounter = '".$result_ktc['mr_kotcounter']."' and $string
group by o.ter_menuid"); 
	  $num_stw   = $database->mysqlNumRows($sql_stw);
	  if($num_stw){$i=1;$t=0;$old="";
	  
	  
	  
	    
				$print .= $center.$bold_on."Kitchen Wise Report".$bold_off."\n";
				if($from=='' && $to=='')
				{
					$print .= $center.$bold_on.$orderbydate.$bold_off."\n";
				}
				else
				{
				$print .= $center.$bold_on.$from." To ".$to.$bold_off."\n";
				}
				/*$print .= "------------------------------------------------\n";
				$print .= "Slno    Date           Bilno               Final\n";
				$print .= "------------------------------------------------\n";*/
				
				$vv=str_pad("-",  '46%', "-");//46
				$print .= $left.$vv."\n";//ojin
				//$print .= $left."Slno  Date        Bilno              Final\n";
				
//				if($menuitem==""){
                                        $menulist= array(
                                    
					new menulist1("Slno","Kitchen","Item","Qty", "Total"),
				);
//                                    }else{
//                                         $menulist= array(
//                                    
//					new menulist1("Slno","Item","Kitchen","Item","Qty", "Total"),
//				);
                                    //}
				
				foreach($menulist as $menulist) {
					$print .=$left.($menulist);
				}
				//$print .= $left."------------------------------------------\n";
				$print .= $left.$vv."\n";//ojin
				
				$final=0;$i=1;
				while($result_report  = mysqli_fetch_array($sql_stw)) 
				{
					$final=$final + $result_report['tot'];
					//$dt=explode("-",$result_report['bm_dayclosedate']);
					//$date=$dt[2]."-".$dt[1]."-".$dt[0];
					
					
					$item=$result_report['mr_kotcounter'];
				
				//$result_report['qty'],$result_report['total']
					$menulist= array(
						new menulist1($slno,$item),
					);
					
					
						$menulist2= array(
						new menulist2('',$result_report['mr_menuname'],$result_report['qty'],number_format($result_report['tot'],$_SESSION['be_decimal']),$printer_style),
					);
						
					
					foreach($menulist as $menulist) {
					$print .=$left.($menulist);
					
					foreach($menulist2 as $menulist2) {
					$print .=$left.($menulist2);
						
					
					}
						
					
					}
					
					
					
					
					//$print .= $left.$i."    ".$date."     ".$result_report['bm_billno']."   ".$result_report['bm_finaltotal']."\n";
					$i++;
				}
				
	  }
  }
}
				
				
				$print .= $left.$vv."\n";//ojin
				$print .=$center."Total = ".$bold_on.number_format($final,$_SESSION['be_decimal']).$bold_off."\n";
				$print .= $left.$vv."\n";//ojin
				
				
				
				$print .="\n\n\n\n\n";
				$print.=$cutpaper;
				
				//And pr_floorid='".$florrid."'
				$sql_kots="Select pr_defaultusb,pr_usbprinterip,pr_usbprinter,pr_printerip,pr_printerport From tbl_printersettings  Where pr_branchid ='".$_SESSION['branchofid']."' and pr_printertype='".$_SESSION['reportprint_tp']."' ";
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
//------------------------------------kitchen wise end------------------------------------------
    else if($_REQUEST['type']=="categorywise_report")
	{
            $string ="";
            $string="bm.bm_status = 'Closed'";
            $from='';
            $to='';
            $reporthead="";
            $st="";
	    $print='';
            $vv='';
            $floor_name='';
            if(isset ($_REQUEST['floorz']))
	{
		
		$floorvalue=$_REQUEST['floorz'];
                if($floorvalue!="")
                {
		
		$string.=" and bm.bm_floorid='".$floorvalue."' ";
                $sql_floor  =  $database->mysqlQuery("select fr_floorname FROM tbl_floormaster where fr_floorid='".$floorvalue."'"); 
                            $num_floor   = $database->mysqlNumRows($sql_floor);
                            if($num_floor)
                            {
                              $result_floor  = mysqli_fetch_array($sql_floor);
                              $floor_name=$result_floor['fr_floorname'];
                            }  
                }
	}
       
	  if($_REQUEST['from']!="" && $_REQUEST['to']!="")
		{
		  
			$from=$database->convert_date($_REQUEST['from']);
			$to=$database->convert_date($_REQUEST['to']);
                        $string.= "and bm.bm_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
			
		}
		else if($_REQUEST['from']!="" && $_REQUEST['to']=="")
		{
			$from=$database->convert_date($_REQUEST['from']);
			$to=date("Y-m-d");
                        $string.= "and bm.bm_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
			
		}
		else if($_REQUEST['from']=="" && $_REQUEST['to']!="")
		{
			$from=$database->convert_date($_REQUEST['from']);
			$to=$database->convert_date($_REQUEST['to']);
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
                            $string.="and bm.bm_dayclosedate = CURDATE() - INTERVAL 1 day";
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
      $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1;$t=0;
                $print .= $center.$bold_on."Dine In".$bold_off."\n";
				$print .= $center.$bold_on."Category Wise Report".$bold_off."\n";
				if($from=='' && $to=='')
				{
					$print .= $center.$bold_on.$reporthead.$bold_off."\n";
				}
				else
				{
				$print .= $center.$bold_on.$from." To ".$to.$bold_off."\n";
				}
                                
                                if($floor_name!=''){
                                  $print .= $center.$bold_on." Floor: ".$floor_name.$bold_off."\n";  
                                }
                                if($printer_style=='1'){
                                    $vv=str_pad("-",  '48%', "-");//46

                                    }
                                    else if($printer_style=='2'){
                                         $vv=str_pad("-",  '42%', "-");
                                    }
				/*$print .= "------------------------------------------------\n";
				$print .= "Slno    Date           Bilno               Final\n";
				$print .= "------------------------------------------------\n";*/
				
				$vv=str_pad("-",  '48%', "-");//46
				$print .= $left.$vv."\n";//ojin
				//$print .= $left."Slno  Date        Bilno              Final\n";
				
				
				$menulist= array(
					new cat_wise("Slno"," Category ","  Qty","  Total",$printer_style)
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
						new cat_wise($i,$main_cat1,$result_report['qty'],number_format($result_report['Total'],$_SESSION['be_decimal']),$printer_style)
                                            
					);
					 	
						
					
					foreach($menulist as $menulist) {
					$print .=$left.($menulist);
					
					
						
					
					}
					
					
					
					
					//$print .= $left.$i."    ".$date."     ".$result_report['bm_billno']."   ".$result_report['bm_finaltotal']."\n";
					$i++;
				}
                     }		
	  
				
				
				$print .= $left.$vv."\n";
				$print .=$center."                             Total = ".$bold_on.number_format($total,$_SESSION['be_decimal']).$bold_off."\n";
				//$print .=$center."                        Final-Total = ".$bold_on.$final.$bold_off.".00\n";
                $print .= $left.$vv."\n";//ojin												
				$print .="\n\n\n\n\n";
				$print.=$cutpaper;
				
				//And pr_floorid='".$florrid."'
				$sql_kots="Select pr_defaultusb,pr_usbprinterip,pr_usbprinter,pr_printerip,pr_printerport From tbl_printersettings  Where pr_branchid ='".$_SESSION['branchofid']."' and pr_printertype='".$_SESSION['reportprint_tp']."' ";
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
    else if($_REQUEST['type']=="credit_details")
    {
	   $string="";
	  $reporthead="";
          $print='';
            $vv='';
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
            $string.=" (bm.bm_dayclosedate = CURDATE() - INTERVAL 1 day   or tbm.tab_dayclosedate = CURDATE() - INTERVAL 1 day )"; 
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

 	$sql_login  =  $database->mysqlQuery("select cd_amount,crd_staffid,ser_firstname,crd_roomid,rm_roomno,crd_corporateid,
											ct_corporatename,crd_guestid,ly_firstname,cd_billno 
											from tbl_credit_master as c 
											left join tbl_credit_details as cd on c.crd_id=cd.cd_masterid 
											left join tbl_staffmaster as s on c.crd_staffid=s.ser_staffid 
											left join tbl_roommaster as r on c.crd_roomid=r.rm_roomid 
											left join tbl_corporatemaster as cm on c.crd_corporateid=cm.ct_corporatecode 
											left join tbl_loyalty_reg  as l on c.crd_guestid=l.ly_id 
											left join tbl_tablebillmaster bm on bm.bm_billno=cd.cd_billno  
											left join tbl_takeaway_billmaster tbm on tbm.tab_billno=cd.cd_billno  
											where $string  order by cd.cd_dateofentry ASC"); 
	$num_login   = $database->mysqlNumRows($sql_login);
	if($num_login)
    {
        $final=0;$i=1;
        $print .= $center.$bold_on."Credit Sale  Report".$bold_off."\n";
				if($from=='' && $to=='')
				{
					$print .= $center.$bold_on.$reporthead.$bold_off."\n";
				}
				else
				{
				$print .= $center.$bold_on.$from." To ".$to.$bold_off."\n";
				}
				if($printer_style=='1')
				{
                    $vv=str_pad("-",  '46%', "-");//46
                }
                else if($printer_style=='2'){
                    $vv=str_pad("-",  '42%', "-");
                }
				$print .= $left.$vv."\n";                               
                $menulist= array(
					new menulist("Slno","Party","Bilno", "Credit",$printer_style),
				);
				foreach($menulist as $menulist) {
					$print .=$left.($bold_on.$menulist.$bold_off);
				}
                $print .= $left.$vv."\n";//ojin
				while($result_login  = $database->mysqlFetchArray($sql_login)) 
                {
				$final=$final + $result_login['cd_amount'];
				
				if($result_login['crd_staffid']!="")
				
				{
					$party=$result_login['ser_firstname'];
					
					$cat='Staff';
				}
				else if($result_login['crd_roomid']!="")
				{
					$party=$result_login['rm_roomno'];
					$cat="Room";
				}
				
				else if($result_login['crd_corporateid']!="")
				{
					$party=$result_login['ct_corporatename'];
					$cat="Corporate";
				}
				else if($result_login['crd_guestid']!="")
				{
					$party=$result_login['ly_firstname'];
					$cat="Guest";
				}

					$menulist= array(
						new menulist($i,$party,$result_login['cd_billno'], number_format($result_login['cd_amount'],$_SESSION['be_decimal']),$printer_style),
					);
					foreach($menulist as $menulist) {
						$print .=$left.($menulist);
					}
					$i++;
                }}
				$print .= $left.$vv."\n";//ojin
                                $menulist= array(
					new menulist("Total","","",number_format($final,$_SESSION['be_decimal']) ,$printer_style),
				);
				foreach($menulist as $menulist) {
					$print .=$left.($bold_on.$menulist.$bold_off);
				}
				
				$print .= $left.$vv."\n";//ojin
                               
                            $print .="\n\n\n\n\n";
				$print.=$cutpaper;
				$sql_kots="Select pr_defaultusb,pr_usbprinterip,pr_usbprinter,pr_printerip,pr_printerport From tbl_printersettings  Where pr_branchid ='".$_SESSION['branchofid']."' and pr_printertype='".$_SESSION['reportprint_tp']."' ";
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
    else if($_REQUEST['type']=="table_turnoversummary")
    {
	$string="";
	$string.=" bm_status='Closed' and bm_complimentary!='Y' and ";
	$reporthead="";
	$st="";
        $print="";
	$from="";
        $to="";
        
            if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
                    $from=$database->convert_date($_REQUEST['fromdt']);
                    $to=$database->convert_date($_REQUEST['todt']);
                    $string.= " bm_dayclosedate  between '".$from."' and '".$to."' ";
                    $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                }
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
                    $from=$database->convert_date($_REQUEST['fromdt']);
                    $to=date("Y-m-d");
                    $string.= " bm_dayclosedate  between '".$from."' and '".$to."' ";
                    $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                }
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
                    $from=date("Y-m-d");
                    $to=$database->convert_date($_REQUEST['todt']);
                    $string.= " bm_dayclosedate  between '".$from."' and '".$to."' ";
                    $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                }
		
        
	else 
	{
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
                    $reporthead=$st;
            }
            else
	{
            $cur=date("Y-m-d");
            $string.=" bm_dayclosedate='".$cur."'";
            $reporthead="On ".$database->convert_date($cur);		
	}
        }
	

 $final=0;
 $total_cust=0;
 $billamount2=array();
 $tablename2=array();
  $sql_login  =  $database->mysqlQuery("select bm_finaltotal as tot,bm_tableno from tbl_tablebillmaster where $string   order by bm_finaltotal DESC"); 
	$old='';$new='';
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
                            
                            $print .= $center.$bold_on."Table Turnover  Summary".$bold_off."\n";
				
                            $print .= $center.$bold_on.$reporthead.$bold_off."\n";
				
                            $vv=str_pad("-",  '44%', "-");//46
                            $print .= $left.$vv."\n";
                             $menulist= array(
						new tableturnover("SlNo","TABLE NO","AMOUNT"),
					);
					foreach($menulist as $menulist) {
						$print .=$left.($bold_on.$menulist.$bold_off);
					}  
                             $print .= $left.$vv."\n";            
                            while($result_login  = $database->mysqlFetchArray($sql_login)) 
                            {
				
				$billamount=$result_login['tot'];
                                $tablename=$result_login['bm_tableno'];
                                
                                $tablename1=explode(",",$tablename);
                                
                                for($j=0;$j<count($tablename1);$j++){
                                    $tablename11=explode("(",$tablename1[$j]);
                                    
                                    $tablename2[]=$tablename11[0];
                                    if(array_key_exists($tablename11[0],$billamount2)){
                                    $billamount2[$tablename11[0]]=$billamount2[$tablename11[0]]+$billamount/count($tablename1);
                                    }
                                    else{
                                       $billamount2[$tablename11[0]]=$billamount/count($tablename1); 
                                    }
                                    }
                                
                        }
                        } 
//                        print_r($billamount2);
                        $i=0;
                        foreach($billamount2 as $key=>$val){
                            $i++;
			$menulist= array(
						new tableturnover($i,$key,number_format($val,$_SESSION['be_decimal'])),
					);
					foreach($menulist as $menulist) {
						$print .=$left.($menulist);
					}
                            }
                            
                            $print .= $left.$vv."\n";//ojin
                            $menulist= array(
						new tableturnover("","","Total = ".number_format(array_sum($billamount2),$_SESSION['be_decimal'])),
					);
					foreach($menulist as $menulist) {
						$print .=$left.($bold_on.$menulist.$bold_off);
					}
                            
                            //$print .=$center."                         Total = ".$bold_on.number_format(array_sum($billamount2),$_SESSION['be_decimal']).$bold_off."\n";
                            $print .= $left.$vv."\n";//ojin
                               
                            $print .="\n\n\n";
                            $print.=$cutpaper;
				//And pr_floorid='".$florrid."'
				$sql_kots="Select pr_defaultusb,pr_usbprinterip,pr_usbprinter,pr_printerip,pr_printerport From tbl_printersettings  Where pr_branchid ='".$_SESSION['branchofid']."' and pr_printertype='".$_SESSION['reportprint_tp']."' ";
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
                            echo "**failed**DI Report Printing Failed: " .$printer_kotname_bill[$key]."( ".$printer_kotip_bill[$key]." )";
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
    private $style;

    public function __construct($name = '', $price = '',$style='') {
        $this -> name = $name;
        $this -> price = $price;
        $this -> style = $style;
    }

    public function __toString() {
        if($this -> style =="1")
            {
            $leftCols = '33%';//32-ojin    33-bbq
            $rightCols = '13%';//10-ojin   13-bbq
            }
        if($this -> style =="2")
            {
            $leftCols = '27%';//32-ojin    33-bbq
            $rightCols = '15%';
            }
                
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
    private $style;

    public function __construct($product = '', $qty = '', $rate = '', $amount = '',$style='') {
        $this -> product = $product;
        $this -> qty = $qty;
        $this -> rate = $rate;
        $this -> amount = $amount;
         $this -> style = $style;
    }

    public function __toString() {
        if($this -> style=='1'){
        $leftCols ="4%";
	$leftCols1 ="21%";
        $rightCols ="8%";
	$rightCols1 ="14%";
        }
        else if($this -> style=='2'){
        $leftCols ="5%";
	$leftCols1 ="16%";
        $rightCols ="8%";
	$rightCols1 ="12%"; 
        }
		
		
        $left = str_pad($this -> product, $leftCols,' ', STR_PAD_BOTH) ;
		$left1 = str_pad($this -> qty, $leftCols1,' ', STR_PAD_RIGHT) ;
		$right = str_pad($this -> rate, $rightCols,' ', STR_PAD_LEFT) ;
		$right1 = str_pad($this -> amount, $rightCols1,' ', STR_PAD_LEFT) ;
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
        $rightCols="12%";
        
		
		
                $left = str_pad($this -> product, $leftCols,' ', STR_PAD_RIGHT) ;
		$left1 = str_pad($this -> qty, $leftCols1,' ', STR_PAD_LEFT) ;
		$right = str_pad($this -> rate, $rightCols,' ', STR_PAD_LEFT) ;
		
        return "$left$left1$right\n";
    }
}

class tableturnover {
    private $slno;
    private $table;
    private $amount;
  

    public function __construct($slno = '', $table = '',$amount='') {
        $this -> slno = $slno;
        $this -> table = $table;
        $this -> amount = $amount;
      
	
    }

    public function __toString() {
        $leftCols ="6%";
	$leftCols1 ="18%";
        $rightCols="20%";
        
		
		
                $left = str_pad($this -> slno, $leftCols,' ', STR_PAD_LEFT) ;
		$left1 = str_pad($this -> table, $leftCols1,' ', STR_PAD_LEFT) ;
		$right = str_pad($this -> amount, $rightCols,' ', STR_PAD_LEFT) ;
		
        return "$left$left1$right\n";
    }
}


class tax {
    private $name;
    private $price;
    private $style;

    public function __construct($name = '', $price = '',$style='') {
        $this -> name = $name;
        $this -> price = $price;
        $this -> style = $style;
    }

    public function __toString() {
        if($this -> style =="1")
            {
            $leftCols = '33%';//32-ojin    33-bbq
            $rightCols = '13%';//10-ojin   13-bbq
            }
        if($this -> style =="2")
            {
            $leftCols = '27%';//32-ojin    33-bbq
            $rightCols = '15%';
            }
                
        $left = str_pad($this -> name, $leftCols) ;
		//$center = str_pad(":", $centerCols) ;
        $right = str_pad($this -> price, $rightCols,' ', STR_PAD_LEFT);
        return "$left$right\n";
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


class steward_new {
    private $product;
    private $qty;
    private $rate;
    private $amount;
    private $style;

    public function __construct($product = '', $qty = '', $rate = '', $amount = '',$style='') {
        $this -> product = $product;
        $this -> qty = $qty;
        $this -> rate = $rate;
        $this -> amount = $amount;
         $this -> style = $style;
    }

    public function __toString() {
        if($this -> style=='1'){
        $leftCols ="4%";
	$leftCols1 ="21%";
        $rightCols ="6%";
	$rightCols1 ="13%";
        }
        else if($this -> style=='2'){
        $leftCols ="4%";
	$leftCols1 ="20%";
        $rightCols ="6%";
	$rightCols1 ="12%"; 
        }
		
		
        $left = str_pad($this -> product, $leftCols,' ', STR_PAD_RIGHT) ;
		$left1 = str_pad($this -> qty, $leftCols1,' ', STR_PAD_BOTH) ;
		$right = str_pad($this -> rate, $rightCols,' ', STR_PAD_LEFT) ;
		$right1 = str_pad($this -> amount, $rightCols1,' ', STR_PAD_LEFT) ;
        return "$left$left1$right$right1\n";
    }
}

class steward_new1 {
    private $product;
    private $qty;
    private $rate;
    private $amount;
    private $style;

    public function __construct($product = '', $qty = '', $rate = '', $amount = '',$style='') {
        $this -> product = $product;
        $this -> qty = $qty;
        $this -> rate = $rate;
        $this -> amount = $amount;
         $this -> style = $style;
    }

    public function __toString() {
        if($this -> style=='1'){
        $leftCols ="10%";
	$leftCols1 ="15%";
        $rightCols ="10%";
	$rightCols1 ="10%";
        }
        else if($this -> style=='2'){
        $leftCols ="10%";
	$leftCols1 ="15%";
        $rightCols ="10%";
	$rightCols1 ="10%"; 
        }
		
		
        $left = str_pad($this -> product, $leftCols,' ', STR_PAD_RIGHT) ;
		$left1 = str_pad($this -> qty, $leftCols1,' ', STR_PAD_BOTH) ;
		$right = str_pad($this -> rate, $rightCols,' ', STR_PAD_BOTH) ;
		$right1 = str_pad($this -> amount, $rightCols1,' ', STR_PAD_LEFT) ;
        return "$left$left1$right$right1\n";
    }
}
?>