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
//printer setup
if($_SESSION['s_printst']=="Y") // printer ye or no
{   $printer_kotip_bill=array();
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
	if($_REQUEST['type']=="tot_sales_ta")
	{
		$string='';
		$print='';
		$from='';
		$to='';
		$typestring='';
		 $date=date("Ymd");
                 
               
    
      if($_REQUEST['staffsel'] =='null')
      {
            $string.=" tab_status='closed' AND tab_mode='TA' and tab_complimentary!='Y' AND ";
      }
      else{
          $string.=" tab_status='closed' AND tab_mode='TA' and tab_complimentary!='Y' AND tab_loginid='".$_REQUEST['staffsel']."' AND "; 
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
				$string.= " tab_dayclosedate between '".$from."' and '".$to."' ";
			}
			else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
			{
				$from=date("Y-m-d");
				$to=$database->convert_date($_REQUEST['hidto']);
				$string.= " tab_dayclosedate between '".$from."' and '".$to."' ";
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
			$string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
			$typestring="Last 15 days";
		}
		else if($bydatz=="Last20days")
		{
			$string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
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
			$string.="tab_dayclosedate = CURDATE() - INTERVAL 1 DAY " ;
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
		  $sql_login  =  $database->mysqlQuery("select * from tbl_takeaway_billmaster where $string order by tab_dayclosedate"); 
          $num_login   = $database->mysqlNumRows($sql_login);
		  if($num_login)
		  {             
				$print .= $center.$bold_on."Take Away".$bold_off."\n";
                                
                                if(isset($_REQUEST['cncl']))
                                {
                                    $print .= $center.$bold_on."Bill Cancelled Report".$bold_off."\n";
                                }else{
                                    $print .= $center.$bold_on."Total Sales Report".$bold_off."\n";
                                }
				if($from=='' && $to=='')
				{
					$print .= $center.$bold_on.$typestring.$bold_off."\n";
				}
				else
				{
				$print .= $center.$bold_on.$from." To ".$to.$bold_off."\n";
				}
                                if(isset($_REQUEST['staffsel'])){
                                 if($_REQUEST['staffsel'] !='null'){
                                    $sql_staff  =  $database->mysqlQuery("select ser_firstname from tbl_staffmaster where ser_staffid = '".$_REQUEST['staffsel']."'"); 
                                    $result_staff  = mysqli_fetch_array($sql_staff);
                                    $print .= $center.$bold_on."Login Staff:".$_REQUEST['staffsel'].$bold_off."\n";
                                }else{
                                   $print .= $center.$bold_on."All".$bold_off."\n";
                               }
                                }
                               else if(isset($_REQUEST['loginstf'])){
                                if($_REQUEST['loginstf'] !='null')
                                    {
                                    $print .= $center.$bold_on."Cancelled Login:".$_REQUEST['loginstf'].$bold_off."\n";
                                }else{
                                   $print .= $center.$bold_on."All".$bold_off."\n";
                               }
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
				
				$final=0;$i=1;$roundoff=0;
				while($result_report  = mysqli_fetch_array($sql_login)) 
				{
					$final=$final + $result_report['tab_netamt'];
                                        
					$dt=explode("-",$result_report['tab_dayclosedate']);
					$date=$dt[2]."-".$dt[1]."-".$dt[0];
					
					$menulist= array(
						new menulist($i,$date,$result_report['tab_billno'], number_format($result_report['tab_total'],$_SESSION['be_decimal']),$printer_style),
					);
					foreach($menulist as $menulist) {
						$print .=$left.($menulist);
					}
					
					
					
					
					//$print .= $left.$i."    ".$date."     ".$result_report['bm_billno']."   ".$result_report['bm_finaltotal']."\n";
					$bcnt = $i;
                                        $i++;
				}
                                
                                       
				$print .= $left.$vv."\n";//ojin
				$menulist= array(
					new menulist("Bill:",$bcnt,"Total",number_format($final,$_SESSION['be_decimal']),$printer_style),
				);
				foreach($menulist as $menulist) {
					$print .=$left.($bold_on.$menulist.$bold_off);
				}
				$print .= $left.$vv."\n";//ojin
				
				
				
				$print .="\n\n\n\n\n";
				$print.=$cutpaper;
				
				//And pr_floorid='".$florrid."'
				$sql_kots="Select pr_usbprinterip,pr_usbprinter,pr_printerip,pr_printerport,pr_defaultusb From tbl_printersettings  Where pr_branchid ='".$_SESSION['branchofid']."' and pr_printertype='".$_SESSION['reportprint_tp']."' ";
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
 else if($_REQUEST['type']=="tot_sale_online")
{    
    $stringdi='';
    $print='';
    $string="";
    $typesale=$_REQUEST['typesale'];
    $staffsel = '';
    $string.=" tab_status = 'Closed'  and tab_complimentary!='Y' AND ";
    $stringdi.="  bm_status = 'Closed' and  bm_complimentary!='Y' AND ";
    
    if($_REQUEST['partner']!=''){
        
        $string.=" tab_food_partner='".$_REQUEST['partner']."' and  ";
    }
    
    if($_REQUEST['partner_mode']!=''){
        
        $string.=' tab_mode="'.$_REQUEST['partner_mode'].'" and  ';
    }else{
         $string.=" (tab_mode= 'TA' || tab_mode= 'HD') and ";
    }
    
    
    if($_REQUEST['type_online']=='Local'){
        
        $string.=" tab_urban_order_id is NULL and tab_qr_order_id is NULL and  ";
         $stringdi.=" bm_qr_orderno ='hi' and ";
    }else if($_REQUEST['type_online']=='Online'){
        
         $string.=" tab_urban_order_id !='' and tab_qr_order_id is NULL and  ";
          $stringdi.=" bm_qr_orderno ='hi' and ";
    }else if($_REQUEST['type_online']=='Qr_code'){
        
         $string.=" tab_qr_order_id !='' and tab_urban_order_id is NULL and  ";
          $stringdi.=" bm_qr_orderno !='' and ";
    }
    
    
    
    $reporthead="";
    $st="";
  
        if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!=""){
            $from=$database->convert_date($_REQUEST['hidfr']);
            $to=$database->convert_date($_REQUEST['hidto']);
            $string.= "tab_dayclosedate between '".$from."' and '".$to."'order by tab_dayclosedate";
            $stringdi.=" bm_dayclosedate between '".$from."' and '".$to."'order by bm_dayclosedate";
            $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
        }else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']==""){
            $from=$database->convert_date($_REQUEST['hidfr']);
            $to=date("Y-m-d");
            $string.= "tab_dayclosedate between '".$from."' and '".$to."'order by tab_dayclosedate";
            $stringdi.=" bm_dayclosedate between '".$from."' and '".$to."'order by bm_dayclosedate";
            $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
        }else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!=""){
            $from=date("Y-m-d");
            $to=$database->convert_date($_REQUEST['hidto']);
            $string.= "tab_dayclosedate between '".$from."' and '".$to."'order by tab_dayclosedate ";
            $stringdi.=" bm_dayclosedate between '".$from."' and '".$to."'order by bm_dayclosedate";
            $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
        }
        
    
    else {
        $reporthead="";
	$st="";
	$bydatz=$_REQUEST['hidbydate'];
	if($bydatz!="null"){
            if($bydatz=="Last5days"){
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                $stringdi.=" bm_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( ) ";
                $st="Last 5 days";
            }elseif($bydatz=="Last10days"){
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                 $stringdi.=" bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( ) ";
                $st="Last 10 days";
            }elseif($bydatz=="Last15days"){
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                 $stringdi.=" bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( ) ";
                $st="Last 15 days";
            }else if($bydatz=="Last20days"){
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                 $stringdi.=" bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( ) ";
                $st="Last 20 days";
                
            }else if($bydatz=="Last25days"){
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                 $stringdi.=" bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( ) ";
                $st="Last 25 days";
            }else if($bydatz=="Last30days"){
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                 $stringdi.=" bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( ) ";
                $st="Last 30 days";
            }else if($bydatz=="Today"){
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                 $stringdi.=" bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( ) ";
                $st="Today";
            }else if($bydatz=="Yesterday"){
		$string.="tab_dayclosedate = CURDATE() - INTERVAL 1 DAY " ;
                 $stringdi.=" bm_dayclosedate = CURDATE( ) - INTERVAL 1 DAY  ";
                $st="Yesterday";
            }
	else if($bydatz=="Last1month")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
                 $stringdi.=" bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                $st="Last 1 month";
	}
else if($bydatz=="Last90days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                $stringdi.=" bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( ) ";
                $st="Last 3 months";
	}
else if($bydatz=="Last180days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                $stringdi.=" bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( ) ";
                $st="Last 6 months";
                
	}
else if($bydatz=="Last365days")
	{
		$string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
                $stringdi.=" bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( ) ";
                $st="Last 1 Year";
	}
              $reporthead=$st;
	}
	else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "tab_dayclosedate between '".$from."' and '".$to."' ";
                        $stringdi.=" bm_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
	}
		
	}
	
                                $print .= $center.$bold_on."".$bold_off."\n";
				$print .= $center.$bold_on."Online Sales Report".$bold_off."\n";
				if($from=='' && $to=='')
				{
					$print .= $center.$bold_on.$reporthead.$bold_off."\n";
				}
				else
				{
				$print .= $center.$bold_on.$from." To ".$to.$bold_off."\n";
				}
                             
				
				$vv=str_pad("-",  '48%', "-");//48
				$print .= $left.$vv."\n";//ojin
				
				$menulist= array(
					new cat_wise("Date","BillNo "," Partner"," Total")
				);
				foreach($menulist as $menulist) {
					$print .=$left.($menulist);
				}
				
				$print .= $vv."\n";//ojin
        
	
  if($_REQUEST['partner_mode']!='DI' || $_REQUEST['partner_mode']==''){    
      
  $dsc=0; $total=0; $final_partner=0;
  $sql_login  =  $database->mysqlQuery("select * from tbl_takeaway_billmaster where $string");
  	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=0;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{  $i++;
                        $total=$total + $result_login['tab_netamt'];
                        $dsc=$dsc + $result_login['tab_food_partner_discount'];
			$final_partner=$final_partner + $result_login['tab_food_partner_total'];
                        
		$partner='';	
          $sql_login7  =  $database->mysqlQuery("select tol_name from tbl_online_order where tol_id='".$result_login['tab_food_partner']."' ");
  
  	  $num_login7   = $database->mysqlNumRows($sql_login7);
	  if($num_login7){
		  while($result_login7  = $database->mysqlFetchArray($sql_login7)) 
			{
                      $partner=$result_login7['tol_name'];
                      
                  }
                  }
                  $menulist= array(
	new cat_wise($result_login['tab_dayclosedate'],$result_login['tab_billno'],$partner,number_format($result_login['tab_food_partner_total'],$_SESSION['be_decimal']))
                                            
					);
					foreach($menulist as $menulist) {
					$print .=$left.($menulist);
					}
	 	   
                             } }
                                  
                                  
                  $print .= $vv."\n";//ojin
                  $menulist= array(
	new cat_wise('Total','','',number_format($final_partner,$_SESSION['be_decimal']))
                                            
					);
					foreach($menulist as $menulist) {
					$print .=$left.($menulist);
					}
 
}            
                                        
 
 if($_REQUEST['partner_mode']=='DI' || $_REQUEST['partner_mode']==''){    
      
  $dsc=0; $total=0; $final_partner=0;
  $sql_login  =  $database->mysqlQuery("select * from tbl_tablebillmaster where $stringdi");
  	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=0;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{  $i++;
                        $total=$total + $result_login['bm_finaltotal'];
                      //  $dsc=$dsc + $result_login['tab_food_partner_discount'];
			//$final_partner=$final_partner + $result_login['tab_food_partner_total'];
                        
          $partner='';	
          $sql_login7  =  $database->mysqlQuery("select fr_floorname from tbl_floormaster where fr_floorid='".$result_login['bm_floorid']."' ");
  
  	  $num_login7   = $database->mysqlNumRows($sql_login7);
	  if($num_login7){
		  while($result_login7  = $database->mysqlFetchArray($sql_login7)) 
			{
                      $partner=$result_login7['fr_floorname'];
                      
                  }
                  }
                  $menulist= array(
	new cat_wise($result_login['bm_dayclosedate'],$result_login['bm_billno'],$partner,number_format($result_login['bm_finaltotal'],$_SESSION['be_decimal']))
                                            
					);
					foreach($menulist as $menulist) {
					$print .=$left.($menulist);
					}
	 	   
                             } }
                                  
                                  
                  $print .= $vv."\n";//ojin
                  $menulist= array(
	new cat_wise('Total','','',number_format($total,$_SESSION['be_decimal']))
                                            
					);
					foreach($menulist as $menulist) {
					$print .=$left.($menulist);
					}
 
}


                                $print .="\n\n\n\n\n";
				$print.=$cutpaper;
				
				//And pr_floorid='".$florrid."'
				$sql_kots="Select pr_defaultusb,pr_usbprinterip,pr_usbprinter From tbl_printersettings  Where pr_branchid ='".$_SESSION['branchofid']."' and pr_printertype='".$_SESSION['reportprint_tp']."' ";
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
 else if($_REQUEST['type']=="categorywise_report_ta")
 {
            $string ="";
            $string.=" tbm.tab_status = 'Closed' and tbm.tab_mode='TA'";
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
          //echo "SELECT mc.mmy_maincategoryname,count(distinct(tbd.tab_menuid)) as 'no of items',sum(tbd.tab_qty) as qty ,sum(tbd.tab_qty* tbd.tab_rate) as Total from tbl_takeaway_billmaster tbm left join tbl_takeaway_billdetails tbd on tbd.tab_billno = tbm.tab_billno left join tbl_menumaster on mr_menuid =tbd.tab_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = mr_maincatid where $string group by mr_maincatid ORDER BY mr_maincatid ASC ";
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1;$t=0;
	  
	  
	  
                                $print .= $center.$bold_on."Take Away".$bold_off."\n";
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
				
				$vv=str_pad("-",  '48%', "-");//48
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
				$print .=$center."                             Total = ".$bold_on.number_format($total,$_SESSION['be_decimal']).$bold_off."\n";
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
        
        else if($_REQUEST['type']=="summary_ta")
	{
		$string='';
		$print='';
		$from='';
		$to='';
		$typestring='';
		  $string='';
        $reporthead="";
	$strings="tab_status='Closed' AND tab_mode = 'TA' AND ";
	$string_pax="";
	$string_pax="tab_status='Closed' AND tab_mode = 'TA' AND ";
	
	$string1_str=" (sum(tab_amountpaid) - sum(tab_amountbalace)) ";
	$string2_str=" sum(bm_transactionamount) ";
	$string3_str=" (sum(tab_netamt)-(sum(tab_amountpaid)-sum(tab_amountbalace))) ";
	$string4_str=" (sum(tab_netamt)-(sum(tab_amountpaid)-sum(tab_amountbalace))) ";
	$string5_str=" (sum(tab_netamt)-(sum(tab_amountpaid)-sum(tab_amountbalace))) ";
	$string6_str=" (sum(tab_netamt)-(sum(tab_amountpaid)-sum(tab_amountbalace))) ";
        $string7_str=" sum(tab_netamt)";
	
	$string1 =$strings. " ";//"cash"//(bm_transactionamount ='' or bm_transactionamount IS NULL) and (bm_couponcompany ='' or bm_couponcompany IS NULL) and bm_voucherid IS NULL and bm_couponamt ='0.00' and  (bm_chequeno ='' or bm_chequeno IS NULL) and (bm_chequebankname='' or bm_chequebankname IS NULL)
		$string2 =$strings. " pym_code='credit'  AND ";//"credit"  bm_transactionamount <>''
		$string3 =$strings. " pym_code='coupon'  AND";//"coupons"  bm_couponcompany <>''  and bm_couponamt <>'0.00'
		$string4 =$strings. " pym_code='voucher' AND";//"voucher" bm_voucherid <>''
		$string5 =$strings. " pym_code='cheque' AND";//"cheque" bm_chequeno <>'' and bm_chequebankname<>''
                $string6=$strings. " pym_code='credit_person' AND ";	
// $string=" bm_status='Closed' AND ";
                $string7=$strings. " tab_complimentary='Y' AND";
	
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
				$string.= " tab_dayclosedate between '".$from."' and '".$to."' ";
				$string_pax.= " tab_dayclosedate   between '".$from."' and '".$to."'";
		}
		}
		  $cur=date("Y-m-d");
		  $print .= $center.$bold_on.$branchname.$bold_off."\n";
		  
                  $print .= $center.$bold_on."Take Away Summary Report".$bold_off."\n";
				if($from=='' && $to=='')
				{
					$print .= $center.$bold_on.$typestring.$bold_off."\n";
				}
				else
				{
				$print .= $center.$bold_on.$database->convert_date($from)." To ".$database->convert_date($to).$bold_off."\n";
				}
			
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
		  
		  
		  $sql_login  =  $database->mysqlQuery("select $string1_str as tot from tbl_takeaway_billmaster tb  left join tbl_paymentmode on tb.tab_paymode=tbl_paymentmode.pym_id   where $string1"."$string order by tab_dayclosedate,tab_time ASC"); 
                  
//                  echo "select $string1_str as tot from tbl_takeaway_billmaster where $string1"."$string order by tab_dayclosedate,tab_time ASC";die();
		
		  $num_login   = $database->mysqlNumRows($sql_login);
                  $subtotal = 0;
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
		  
		 
		  
		  $sql_login1  =  $database->mysqlQuery("select tab_transcbank as bank_name, (sum(tab_transactionamount)) as tot from tbl_takeaway_billmaster tb , tbl_bankmaster b ,tbl_paymentmode where  tb.tab_paymode=tbl_paymentmode.pym_id  and   b.bm_id = tb.tab_transcbank and $string2 $string  order by tb.tab_dayclosedate,tb.tab_time ASC"); 
                                                        //echo "select tab_transcbank as bank_name, (sum(tab_transactionamount)) as tot from tbl_takeaway_billmaster tb , tbl_bankmaster b ,tbl_paymentmode where  tb.tab_paymode=tbl_paymentmode.pym_id  and   b.bm_id = tb.tab_transcbank and $string2 $string  group by b.bm_name order by tb.tab_dayclosedate,tb.tab_time ASC";
	  $num_login1   = $database->mysqlNumRows($sql_login1);
		  
		    if($num_login1)
		  {
				
				while($result_report1  = mysqli_fetch_array($sql_login1)) 
				{
                                        $subtotal =$subtotal + $result_report1['tot'];
					$bilno= array(
						new bilno("Card",number_format($result_report1['tot'],$_SESSION['be_decimal']) ),
					);
					foreach($bilno as $bilno) {
						$print .=$left.($bilno);
					}
					$i++;
				}
		  }
		 
                  
                  $sql_logincreditta  =  $database->mysqlQuery("select distinct (b.bm_name) as bnk, sum(bc.mc_cardamount) as tot  FROM 
                                                    tbl_takeaway_billmaster bm 
                                                    left join tbl_paymentmode on bm.tab_paymode=tbl_paymentmode.pym_id 
                                                    left join tbl_bill_card_payments bc on bc.mc_billno=bm.tab_billno
                                                    left join tbl_bankmaster b  on  b.bm_id = bc.mc_to_bank 
                                                    where tbl_paymentmode.pym_code='credit' and bm.tab_mode='TA'
                                                    and bm.tab_status='Closed' AND bm.tab_complimentary!='Y' AND $string group by bnk");
                      


                  $num_logincreditta   = $database->mysqlNumRows($sql_logincreditta);
                  if($num_logincreditta){
                          while($result_logincreditta  = $database->mysqlFetchArray($sql_logincreditta)) 
                                { 
                              
                              $bilno= array(
						new bilno($result_logincreditta['bnk'],number_format($result_logincreditta['tot'],$_SESSION['be_decimal']) ),
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
		  
		   $sql_login  =  $database->mysqlQuery("select $string4_str as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $string4"." $string order by tab_dayclosedate,tab_time ASC"); 
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
                  $sql_login  =  $database->mysqlQuery("select $string7_str as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tab_paymode=tbl_paymentmode.pym_id where $string7"."$string order by tab_dayclosedate,tab_time ASC"); 
                  
//                  echo "select $string7_str as tot from tbl_takeaway_billmaster where $string7"."$string order by tab_dayclosedate,tab_time ASC";die();
		
		  $num_login   = $database->mysqlNumRows($sql_login);
		  if($num_login)
		  {
				
				while($result_report  = mysqli_fetch_array($sql_login)) 
				{
					if($result_report['tot'] != "")
			{
					
					
					$bilno= array(
						new bilno("Complimentary",number_format($result_report['tot'],$_SESSION['be_decimal'])),
					);
					foreach($bilno as $bilno) {
						$print .=$left.($bilno);
					}
					$i++;
				}
		  }}
                  ///cpmplimentary-----------
		  
		  $qtycount=0;
	
		  
		  
				$print .= $left.$vv."\n";//ojin
				$print .=$center."                             Total = ".$bold_on.number_format($subtotal,$_SESSION['be_decimal']).$bold_off."\n";
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
				
				
		  
	} else if($_REQUEST['type']=="order_ta")
	{
            $string ="";
            $string.=" tbm.tab_status = 'Closed' and tbm.tab_mode='TA'";
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
	  if($_REQUEST['from']!="" && $_REQUEST['to']!="")
		{
		  
			$from=$database->convert_date($_REQUEST['from']);
			$to=$database->convert_date($_REQUEST['to']);
                        $string.= "and tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
			
		}
		else if($_REQUEST['from']!="" && $_REQUEST['to']=="")
		{
			$from=$database->convert_date($_REQUEST['from']);
			$to=date("Y-m-d");
                        $string.= "and tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
			
		}
		else if($_REQUEST['from']=="" && $_REQUEST['to']!="")
		{
			$from=$database->convert_date($_REQUEST['from']);
			$to=$database->convert_date($_REQUEST['to']);
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

 	  $sql_login  =  $database->mysqlQuery("SELECT mc.mmy_maincategoryname,ms.msy_subcategoryname,m.mr_menuname,p.pm_portionname,sum(tab_qty * tab_rate) as Total3,p.pm_portionshortcode,sum(tbd.tab_qty) as qty,ROUND(avg(tbd.tab_rate), 1) as Unit_Price,tbm.tab_netamt,((sum(tbd.tab_qty))*(ROUND(avg(tbd.tab_rate), 1))) as Sub_Total from tbl_takeaway_billmaster tbm left join tbl_takeaway_billdetails tbd on tbd.tab_billno = tbm.tab_billno left join tbl_menumaster m on m.mr_menuid = tbd.tab_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = m.mr_maincatid left join tbl_menusubcategory ms on ms.msy_subcategoryid = m.mr_subcatid left join tbl_portionmaster p on p.pm_id = tbd.tab_portion where $string $stringta_addon group by m.mr_maincatid ,m.mr_subcatid,tbd.tab_menuid,tbd.tab_portion  ORDER BY mc.mmy_maincategoryname ASC");
          // echo "SELECT mc.mmy_maincategoryname,ms.msy_subcategoryname,m.mr_menuname,p.pm_portionname,p.pm_portionshortcode,sum(tbd.tab_qty) as qty,ROUND(avg(tbd.tab_rate), 1) as Unit_Price, ((sum(tbd.tab_qty))*(ROUND(avg(tbd.tab_rate), 1))) as Total from tbl_takeaway_billmaster tbm left join tbl_takeaway_billdetails tbd on tbd.tab_billno = tbm.tab_billno left join tbl_menumaster m on m.mr_menuid = tbd.tab_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = m.mr_maincatid left join tbl_menusubcategory ms on ms.msy_subcategoryid = m.mr_subcatid left join tbl_portionmaster p on p.pm_id = tbd.tab_portion where $string $stringta_addon group by m.mr_maincatid ,m.mr_subcatid,tbd.tab_menuid,tbd.tab_portion ORDER BY m.mr_maincatid,m.mr_subcatid  DESC";
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1;$t=0;$old="";
	  
	  
	  
                                $print .= $center.$bold_on."TAKEAWAY".$bold_off."\n";
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
                                $print .= $left.$vv."\n";
				//$print .= $left."------------------------------------------\n";
//				$print .= $left.$vv."\n";//ojin
				
				$final=0;$i=1;$sub_total=0;
                                $old=""; $fn=0;
                               
				while($result_report  = mysqli_fetch_array($sql_login)) 
				{       $sub_total=$sub_total + $result_report['Sub_Total'];
					$final=$final + $result_report['tab_netamt'];
                                        
                                        
                                        $fn=$fn+$result_report['Total3']; 
					//$dt=explode("-",$result_report['tab_dayclosedate']);
					//$date=$dt[2]."-".$dt[1]."-".$dt[0];
					
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
						new itemordered($item,$result_report['qty'],number_format($result_report['Total3'],$_SESSION['be_decimal'])),
					);
					 	
						
					
					foreach($menulist as $menulist) {
					$print .=$left.($menulist);
					
					
					}
						
					
					
					
					
					
					
					//$print .= $left.$i."    ".$date."     ".$result_report['bm_billno']."   ".$result_report['bm_finaltotal']."\n";
					$i++;
				}
                     }		
	  
				
				
				$print .= $left.$vv."\n";
				$print .=$center.$bold_on."                         Total : ".number_format($fn,$_SESSION['be_decimal']).$bold_off."\n";
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
        else if($_REQUEST['type']=="order_ta1")
	{
		
		 
 $string ="";
   
   $string.=" tbm.tab_status='Closed' AND tbm.tab_mode='TA' ";
        
        							
	$reporthead="";
	$st="";
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
	  if($_REQUEST['from']!="" && $_REQUEST['to']!="")
		{
		  
			$from=$database->convert_date($_REQUEST['from']);
			$to=$database->convert_date($_REQUEST['to']);
			
			if($string !="")
			{
				$string.= "and tbm.tab_dayclosedate  between '".$from."' and '".$to."' ";
			}
			else
			{
				$string.= " tbm.tab_dayclosedate  between '".$from."' and '".$to."' ";
			}
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
			
						
			
			
			
		}
		else if($_REQUEST['from']!="" && $_REQUEST['to']=="")
		{
			$from=$database->convert_date($_REQUEST['from']);
			$to=date("Y-m-d");
		if($string !="")
			{
				$string.= "and tbm.tab_dayclosedate  between '".$from."' and '".$to."' ";
			}
			else
			{
				$string.= " tbm.tab_dayclosedate  between '".$from."' and '".$to."' ";
			}
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
			
						
			
			
			
			
		}
		else if($_REQUEST['from']=="" && $_REQUEST['to']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['to']);
			if($string !="")
			{
				$string.= "and tbm.tab_dayclosedate  between '".$from."' and '".$to."' ";
			}
			else
			{
				$string.= " tbm.tab_dayclosedate  between '".$from."' and '".$to."' ";
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
		
		$string.=" and tbm.tab_dayclosedate  between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
		}
		else
		{
				$string.="tbm.tab_dayclosedate  between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
		}
		
		
$st="Last 5 days";
	}elseif($orderbydate=="Last10days")
	{
	if($string !="")
{
	
		$string.=" and  tbm.tab_dayclosedate  between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
}
else
{
		$string.=" tbm.tab_dayclosedate  between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
}
$st="Last 10 days";
	}
	elseif($orderbydate=="Last15days")
	{
		if($string !="")
		{
			$string.="  and tbm.tab_dayclosedate  between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
		}
		else
		{
		$string.=" tbm.tab_dayclosedate  between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
		}
$st="Last 15 days";
	}
	else if($orderbydate=="Last20days")
	{
	if($string !="")
		{
				$string.=" and tbm.tab_dayclosedate  between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
		}
		else
		{
		$string.=" tbm.tab_dayclosedate  between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
		}
$st="Last 20 days";
	}
	else if($orderbydate=="Last25days")
	{
		if($string !="")
		{
			$string.=" and tbm.tab_dayclosedate  between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
		}
		else{
		$string.=" tbm.tab_dayclosedate  between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
		}
$st="Last 25 days";
	}
	else if($orderbydate=="Last30days")
	{
		if($string !="")
		{
				$string.=" and tbm.tab_dayclosedate  between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
		}
		else
		{
		$string.=" tbm.tab_dayclosedate  between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
		}
$st="Last 30 days";
	}
	else if($orderbydate=="Today")
	{
	if($string !="")
		{
		$string.=" and tbm.tab_dayclosedate  between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
		}
		else
		{
			$string.=" tbm.tab_dayclosedate  between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 		
		}
		$st="Today";
	}

else if($orderbydate=="Yesterday")
			  {
				    if($string !="")
				  {
					    $string.=" and tbm.tab_dayclosedate  =  CURDATE() - INTERVAL 1 day";
				  }
				  else
				  {
					    $string.=" tbm.tab_dayclosedate  =  CURDATE() - INTERVAL 1 day";
				  }
				  $st="Yesterday";
			  }
	else if($orderbydate=="Last1month")
	{
			  if($string !="")
				  {
					    $string.=" and tbm.tab_dayclosedate  between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
				  }
				  else
				  {
					    $string.=" tbm.tab_dayclosedate  between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
				  }
$st="Last 1 month";
	}

	else if($orderbydate=="Last90days")
	{
	if($string !="")
		{
		$string.=" and tbm.tab_dayclosedate  between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
		}
		else
		{
			$string.="tbm.tab_dayclosedate  between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
		}
		$st="Last 3 months";
	}
		else if($orderbydate=="Last180days")
	{
	if($string !="")
		{
		$string.=" and tbm.tab_dayclosedate  between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
		}
		else
		{
			$string.=" tbm.tab_dayclosedate  between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
		}
		$st="Last 6 months";
	}
		else if($orderbydate=="Last365days")
	{
		if($string !="")
		{	
		$string.=" and tbm.tab_dayclosedate  between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
			
		}
		else
		{
			$string.="tbm.tab_dayclosedate  between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
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
			
			$string.= " and tbm.tab_dayclosedate   between '".$from."' and '".$to."' ";
			}
			else
			{	
			$string.= " tbm.tab_dayclosedate   between '".$from."' and '".$to."' ";
			}
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
			
//		
	}
	}  
    
	$final=0;
        $print="";

 	$sql_stw  =  $database->mysqlQuery("SELECT tbm.tab_billno, tbd.tab_menuid, mmc.mmy_maincategoryname, msc.msy_subcategoryname , mm.mr_menuname, tbd.tab_qty,sum(tbd.tab_qty) as qty, pm.pm_portionname,  sum(tab_qty * tab_rate) as Total,tbd.tab_rate, tbd.tab_amount, sm.ser_firstname
        from tbl_takeaway_billmaster tbm
        left join tbl_takeaway_billdetails tbd on tbd.tab_billno = tbm.tab_billno
        left join tbl_menumaster mm on tbd.tab_menuid = mm.mr_menuid
        left join tbl_menumaincategory mmc on mmc.mmy_maincategoryid = mm.mr_maincatid
        left join tbl_menusubcategory msc on mm.mr_subcatid = msc.msy_subcategoryid
        left join tbl_portionmaster pm on pm.pm_id = tbd.tab_portion
        left join tbl_staffmaster sm on tbm.tab_assignedto = sm.ser_staffid
        where $string $stringta_addon
        group by tbd.tab_menuid 
        ORDER BY mmc.mmy_maincategoryname ASC");
        
        
          
	  $num_stw   = $database->mysqlNumRows($sql_stw);
	  if($num_stw){$i=1;$t=0;$old="";
	  
	  $sql_stf  =  $database->mysqlQuery("select ser_firstname FROM tbl_staffmaster where ser_staffid= '".$_REQUEST['staffsel']." '");
 
          $num_stf   = $database->mysqlNumRows($sql_stf);
          if($num_stf){
              $result_stf  = mysqli_fetch_array($sql_stf);
          }
	  
	    
				$print .= $center.$bold_on."Take Away Items Ordered Report".$addon_head.$bold_off."\n";
				if($from=='' && $to=='')
				{
					$print .= $center.$bold_on.$reporthead.$bold_off."\n";
                    		}
				else
				{
				$print .= $center.$bold_on.$from." To ".$to.$bold_off."\n";
				}
                                
                                if($_REQUEST['staffsel']=="null")
                                 {
                                    
                                    $print .= $center.$bold_on.'All'.$bold_off."\n";
                                 }else{
                                     $print .= $center.$bold_on."Delivered By:".$result_stf['ser_firstname'].$bold_off."\n";
                                 }
                                
				/*$print .= "------------------------------------------------\n";
				$print .= "Slno    Date           Bilno               Final\n";
				$print .= "------------------------------------------------\n";*/
				
				$vv=str_pad("-",  '48%', "-");//46
				$print .= $left.$vv."\n";//ojin
				//$print .= $left."Slno  Date        Bilno              Final\n";
				
				
				$menulist= array(
					new menulist1("Slno","Item","Floor","Qty", "Total"),
				);
				foreach($menulist as $menulist) {
					$print .=$left.($menulist);
				}
				//$print .= $left."------------------------------------------\n";
				$print .= $left.$vv."\n";//ojin
				
				$final=0;$i=1;
				while($result_report  = mysqli_fetch_array($sql_stw)) 
				{
					$final=$final + $result_report['Total'];
					$dt=explode("-",$result_report['bm_dayclosedate']);
					$date=$dt[2]."-".$dt[1]."-".$dt[0];
					
					
					$item=$result_report['mr_menuname']."(".$result_report['pm_portionname'].")";
				
				//$result_report['qty'],$result_report['total']
					$menulist= array(
						new menulist1($i,$item),
					);
					
                                        if($_REQUEST['staffsel']!="")
                                        {
                                           $staf = $result_report['ser_firstname'];
                                       }
                                        
	    
					
						$menulist2= array(
						new menulist('',$staf,"Qty.".$result_report['qty'],"= ".number_format($result_report['Total'],$_SESSION['be_decimal'])),
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
				$print .=$center."                       Total = ".$bold_on.number_format($final,$_SESSION['be_decimal']).$bold_off.".00\n";
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
                            echo "**failed**TA Report Printing Failed: " .$printer_kotname_bill[$key]."( ".$printer_kotip_bill[$key]." )";
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
	$leftCols1 ="17%";
        $rightCols ="11%";
	$rightCols1 ="16%";
		
		
		
        $left = str_pad($this -> product, $leftCols,' ', STR_PAD_BOTH) ;
		$left1 = str_pad($this -> qty, $leftCols1,' ', STR_PAD_BOTH) ;
		$right = str_pad($this -> rate, $rightCols,' ', STR_PAD_BOTH) ;
		$right1 = str_pad($this -> amount, $rightCols1,' ', STR_PAD_RIGHT) ;
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