<?php
session_start();
include("database.class.php"); // DB Connection class
$database	= new Database();
include('includes/master_settings.php');
require_once("Escpos.php");

$con=mysqli_connect(HOST_NAME, USER_NAME, PASSWORD,DATABASE_NAME);
mysqli_set_charset($con,"utf8");
error_reporting(0);
date_default_timezone_set("Asia/Kolkata");
//printer setup
require_once("printer_functions.php");
$printpage=new PrinterCommonSettings();


if($_SESSION['s_printst']=="Y") // printer all yes or no
{   
    
if(($_REQUEST['set']=="kotprint"))
		{   
                        
                        $printing_count=0;
			if(isset($_REQUEST['kot']))
			{
				$_SESSION['kot_id']=$_REQUEST['kot'];
				if(isset($_REQUEST['check']))
				{
					$sql_flor="SELECT ter_orderno FROM `tbl_tableorder` where `ter_kotno`='".$_SESSION['kot_id']."' AND ter_dayclosedate='".$_SESSION['date']."' ";
					$sql_flors  =  mysqli_query($con,$sql_flor); 
					$num_flor  = mysqli_num_rows($sql_flors);
					if($num_flor){	
					while($result_flor  = mysqli_fetch_array($sql_flors)) 
					 {
					      $_SESSION['order_id']=$result_flor['ter_orderno'];
					 }
					}
				}
			}
                        
			if(isset($_REQUEST['ordn']))
			{
				$_SESSION['order_id']=$_REQUEST['ordn'];
			}
                        
			if($_SESSION['kot_id']!="")
			{   
                            $sql_kots="select pr_defaultusb,pr_printerip , pr_printerport , pr_printername, pr_printertype FROM 
                            (select pr_defaultusb,p.pr_printerip AS pr_printerip ,p.pr_printerport AS pr_printerport ,p.pr_printername AS pr_printername,
                            p.pr_printertype AS pr_printertype
                            from tbl_tableorder t
                            left join tbl_menumaster m on t.ter_menuid = m.mr_menuid
                            left join tbl_kotcountermaster k on k.kr_kotcode = m.mr_kotcounter
                            left join tbl_printersettings p on k.kr_kotcode = p.pr_kotcode
                            left join tbl_printertype pt ON pt.pt_id = p.pr_printertype
                            where t.ter_status = ('Served' or 'Opened')  and pt.pt_typename ='KOT Print' AND t.ter_dayclosedate='".$_SESSION['date']."'
                            and p.pr_floorid='".$_SESSION['floorid']."' and  p.pr_enable='Y'  AND t.ter_orderno = '".$_SESSION['order_id']."'
                            union all 
                            select pr_defaultusb,p.pr_printerip AS pr_printerip ,p.pr_printerport AS pr_printerport ,p.pr_printername AS pr_printername,
                            p.pr_printertype AS pr_printertype
                            from tbl_tableorder t
                            left join tbl_printersettings p on p.pr_floorid =  t.ter_floorid
                            left join tbl_printertype pt ON pt.pt_id = p.pr_printertype
                            where t.ter_status = ('Served' or 'Opened')  and pt.pt_typename='Consolidated' 
                            and t.ter_dayclosedate='".$_SESSION['date']."' AND p.pr_floorid='".$_SESSION['floorid']."') z
                            GROUP BY pr_printerip";
                            
                        $sql_kotss  =  mysqli_query($con,$sql_kots); 
                        $num_kots  = mysqli_num_rows($sql_kotss);
                        if($num_kots)
                        {	
                          while($result_kots  = mysqli_fetch_array($sql_kotss)) 
                          {
                                
				$printer_kotip_bill[]=$result_kots['pr_printerip'];
                                $printer_kotusb_bill[]=$result_kots['pr_defaultusb'];
				
			  }
                        }
                        
			foreach ($printer_kotip_bill as $key=>$port)
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
                            
                             
                        if ($result == 0 && $printing_count==0)
                          { 
                            $printing_count=1;
                            $a=$printpage->print_kot($_SESSION['kot_id'],$_SESSION['order_id'],$_SESSION['date'],$_SESSION['kotprint_tp'],$_SESSION['branchofid'],"web");
                          }
                             
			}
		
		}
 }  
            
else if(($_REQUEST['set']=="console"))
		{
			        if($_SESSION['s_consolidated_print']=="Y")
				{
					if(isset($_REQUEST['kot']))
					{
						$_SESSION['kot_id']=$_REQUEST['kot'];
						if(isset($_REQUEST['check']))
						{
							$sql_flor="SELECT ter_orderno FROM `tbl_tableorder` where `ter_kotno`='".$_SESSION['kot_id']."' "
                                                        . " AND ter_dayclosedate='".$_SESSION['date']."' ";
							$sql_flors  =  mysqli_query($con,$sql_flor); 
							$num_flor  = mysqli_num_rows($sql_flors);
							if($num_flor){	
							while($result_flor  = mysqli_fetch_array($sql_flors)) 
									{
										$_SESSION['order_id']=$result_flor['ter_orderno'];
									}
							}
						}
					}
					if(isset($_REQUEST['ordn']))
					{
						$_SESSION['order_id']=$_REQUEST['ordn'];
					}
					if($_SESSION['kot_id']!="")
					{
						
					if($_SESSION['s_consolidated_print']=="Y")
					{
                                                    
                            $sql_kots="select pr_defaultusb,pr_printerip , pr_printerport , pr_printername, pr_printertype FROM 
                            (select pr_defaultusb,p.pr_printerip AS pr_printerip ,p.pr_printerport AS pr_printerport ,p.pr_printername AS pr_printername,
                            p.pr_printertype AS pr_printertype
                            from tbl_tableorder t
                            left join tbl_menumaster m on t.ter_menuid = m.mr_menuid
                            left join tbl_kotcountermaster k on k.kr_kotcode = m.mr_kotcounter
                            left join tbl_printersettings p on k.kr_kotcode = p.pr_kotcode
                            left join tbl_printertype pt ON pt.pt_id = p.pr_printertype
                            where t.ter_status = ('Served' or 'Opened')  and pt.pt_typename ='KOT Print'  
                            and  t.ter_dayclosedate='".$_SESSION['date']."' AND  p.pr_floorid='".$_SESSION['floorid']."' and  p.pr_enable='Y' 
                             AND t.ter_orderno = '".$_SESSION['order_id']."'
                            union all 
                            select pr_defaultusb,p.pr_printerip AS pr_printerip ,p.pr_printerport AS pr_printerport ,p.pr_printername AS pr_printername,
                            p.pr_printertype AS pr_printertype
                            from tbl_tableorder t
                            left join tbl_printersettings p on p.pr_floorid =  t.ter_floorid
                            left join tbl_printertype pt ON pt.pt_id = p.pr_printertype
                            where t.ter_status = ('Served' or 'Opened')  and pt.pt_typename='Consolidated' 
                            and t.ter_dayclosedate='".$_SESSION['date']."' AND  p.pr_floorid='".$_SESSION['floorid']."') z
                            GROUP BY pr_printerip";
                        $sql_kotss  =  mysqli_query($con,$sql_kots); 
                        $num_kots  = mysqli_num_rows($sql_kotss);
                        if($num_kots)
                        {	
                        while($result_kots  = mysqli_fetch_array($sql_kotss)) 
                        {
                                
				$printer_kotip_bill[]=$result_kots['pr_printerip'];
                                $printer_kotusb_bill[]=$result_kots['pr_defaultusb'];
				
			}
                        }
                        
			foreach ($printer_kotip_bill as $key=>$port)
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
                            
                             
                                  if ($result == 0 && $printing_count==0)
                                   {  $printing_count=1;
                                      $printpage->print_kot_consolidated($_SESSION['kot_id'],$_SESSION['order_id'],$_SESSION['date'],$_SESSION['consolidated_tp'],$_SESSION['branchofid'],"web");
                                   }
                             
			        }
                                                    
                                           	
				}
				}
					
				}
		
}

else if(($_REQUEST['set']=="billprint"))
{ 
    
                    $printing_count=0;
                    
                    echo "billok";
                    
                    $bill_reprint="";
                  
			if(isset($_REQUEST['bilno']))
			{       
				 //$_SESSION['billno']=$_REQUEST['bilno'];
                                 $bill=$_REQUEST['bilno'];
                                
			}
                        
                        if(isset($_REQUEST['bill_reprint']))
			{       
				$bill_reprint=$_REQUEST['bill_reprint'];
			}
                  
                        
            if(isset($_REQUEST['ord']) && $_REQUEST['ord']!=''){
	        
            $sql_flor="SELECT ter_billnumber FROM tbl_tableorder where ter_dayclosedate='".$_SESSION['date']."' and ter_orderno='".$_REQUEST['ord'][0]."' ";
            $sql_flors  =  mysqli_query($con,$sql_flor); 
            $num_flor  = mysqli_num_rows($sql_flors);
            if($num_flor){	
                while($result_flor  = mysqli_fetch_array($sql_flors)) 
                {
                   $bill=$result_flor['ter_billnumber'];
                }
                }
             }
              

                if($printing_count==0)
                {  
                            
                  $printing_count=1;
                        
		  // $printpage->print_bill($_SESSION['billno'],$_SESSION['branchofid'],"web",$_SESSION['billip'],$_SESSION['hosttype'],$bill_reprint); 
                  
                  $printpage->print_bill($bill,$_SESSION['branchofid'],"web",$_SESSION['billip'],$_SESSION['hosttype'],$bill_reprint); 
                  
                  $_SESSION['bill_printed']="yes";
                  
                 } 
     		
}  
else  if(($_REQUEST['set']=="kotcancelprint"))
{
    
    
    if(isset($_REQUEST['kot']))
    {
        $_SESSION['kot_id']=$_REQUEST['kot'];
        if(isset($_REQUEST['check']))
        {
            $sql_flor="SELECT ter_orderno FROM `tbl_tableorder` where `ter_kotno`='".$_SESSION['kot_id']."' AND ter_dayclosedate='".$_SESSION['date']."' ";
            $sql_flors  =  mysqli_query($con,$sql_flor); 
            $num_flor  = mysqli_num_rows($sql_flors);
            if($num_flor){	
                while($result_flor  = mysqli_fetch_array($sql_flors)) 
                {
                   $_SESSION['order_id']=$result_flor['ter_orderno'];
                }
                }
        }
    }
    if(isset($_REQUEST['ordn']))
    {
        $_SESSION['order_id']=$_REQUEST['ordn'];
    }
    if($_SESSION['kot_id']!="")
    {
        $printpage->print_kot_cancel($_SESSION['kot_id'],$_SESSION['order_id'],$_SESSION['date'],$_SESSION['kotprint_tp'],$_SESSION['branchofid'],"web");
    }
}

if(($_REQUEST['set']=="kotcancel"))
		{
			
                   $printpage->print_kot_cancel('KOT-329','MBK241216-105',$_SESSION['date'],$_SESSION['kotprint_tp'],$_SESSION['branchofid'],"web");
		
		} 
	
} 

if(($_REQUEST['set']=="kotprint"))
{
if($_SESSION['s_kotstatus']=='N')
	{
		
		$sql_kots="Select * From tbl_tableorder  WHERE ter_orderno = '".$_SESSION['order_id']."' AND ter_status='Added' ";
		$sql_kotss  =  mysqli_query($con,$sql_kots); 
		$num_kots  = mysqli_num_rows($sql_kotss);
		if($num_kots){	
		//$query =mysqli_query($con,"update  tbl_tableorder set ter_status='Served' WHERE ter_orderno = '".$_SESSION['order_id']."' ");				
		}
	}
}


if(($_REQUEST['set']=="thermal_invoice")){
    
     $br=$_REQUEST['branch'];
     $ad=$_REQUEST['adr'];
     $phn=$_REQUEST['phn'];
     $functionid=$_REQUEST['fid'];
     $bp=$_REQUEST['bp'];
     $dp1=$_REQUEST['dup1'];
     
      if($_SESSION['s_printst']=='Y'){
          $printpage->print_invoice($br,$ad,$phn,$functionid,$bp,$dp1);
      }
}


if(($_REQUEST['set']=="shift_report")){
    
    
    $sl=$_REQUEST['slnoshift'];
    $day_shift=$_REQUEST['day_shift'];
    
    
     if($_SESSION['s_printst']=='Y'){
         
        $printpage->print_shiftdetail($sl,$day_shift,$_SESSION['branchofid'],$_SESSION['reportip'],$_SESSION['hosttype'],"web");
        
     }
     
      
}

if(($_REQUEST['set']=="shift_close_drawer")){
      
      //cashdrawer/////
     
     if($_SESSION['s_cash_drawer']=='Y'){
        
     $usb='N';
     $sql_kots="Select * From tbl_printersettings  Where pr_printertype='8' and pr_enable='Y' ";
		$sql_kotss  =  mysqli_query($con,$sql_kots); 
		 $num_kots  = mysqli_num_rows($sql_kotss);
		if($num_kots){	
		while($result_kots  = mysqli_fetch_array($sql_kotss)) 
		{
                    
                  $usb= $result_kots['pr_defaultusb']; 
                    
                   if($result_kots['pr_defaultusb']=='Y'){
                       
                       
                      $ip=$result_kots['pr_usbprinterip'];
                      $port=$result_kots['pr_usbprinter']; 
                      
                   }else{
                       
                     $ip=$result_kots['pr_printerip'];
                     $port='9100';  
                     
                   } 
                  
                  
                }
                
                
    if($usb!="Y"){
        
             $connector = new NetworkPrintConnector($ip,$port);
	     $printers = new Escpos($connector);
                                                           
	     $printers -> pulse(0);
	     $printers -> close();
    }else{
        
            $printers="\\\\".$ip."\\".$port;
            $connector = new FilePrintConnector($printers);
            $printers = new Escpos($connector);
            $printers -> pulse(0);
	    $printers -> close();
          
    }
                
                
    }
     
     
       echo 'ok';
             
        $localIP = getHostByName(getHostName()); 
    
            mysqli_query($localhost,"INSERT INTO `tbl_cash_drawer_log`(`cdl_login`, `cdl_interface`, `cdl_machineid`)"
            . " VALUES ('".$_SESSION['expodine_id']."','W','".$localIP."')"); 
    
   }else{
       
        echo 'no';
   }
   
 }


if(($_REQUEST['set']=="shift_detail")){
    
    $sl=$_REQUEST['slno'];
    $date=$_REQUEST['date'];
    
     if($_SESSION['s_printst']=='Y'){
          $printpage->print_shift_details_report($sl,$date,$_SESSION['branchofid'],$_SESSION['reportip'],$_SESSION['hosttype'],"web");
     }
}
if(isset($_REQUEST['set'])&& ($_REQUEST['set']=='reprint_ta_new')){
        

 if($_SESSION['s_printst']=='Y'){
     
      $printpage->print_bill_ta($_REQUEST['billno'],$_REQUEST['homed'],'1',"web",$_SESSION['billip'],$_SESSION['hosttype'],"Y");  
 }
     
}
    

if(isset($_REQUEST['set'])&& ($_REQUEST['set']=='check_missed_kot_di')){ 
  
   if($_SESSION['s_printst']=='Y'){ 
     
     ///kot di////
     $result=0;
     $sql_flor="SELECT ter_kotno,ter_orderno,ter_floorid,ter_slno,ter_qty FROM tbl_tableorder where ter_dayclosedate='".$_SESSION['date']."' "
     . " and ter_kot_printed='N' and "
     . " (ter_kotno !='' and ter_kotno!='0')  group by ter_orderno,ter_dayclosedate,ter_slno "
     . " order by  ter_kotno asc limit 25 ";
            $sql_flors  =  mysqli_query($con,$sql_flor); 
            $num_flor  = mysqli_num_rows($sql_flors);
            if($num_flor){	
                while($result_flor  = mysqli_fetch_array($sql_flors)) 
                {
                   
                if($result_flor['ter_qty']=='0' || $result_flor['ter_qty']==''){
                        
                $log_data_printy=mysqli_query($localhost,"update tbl_tableorder set  ter_kot_printed='Y' where ter_dayclosedate='".$_SESSION['date']."' "
                . " and ter_orderno = '".$result_flor['ter_orderno']."' and ter_slno = '".$result_flor['ter_slno']."' ");              
                        
                }
                     
    $sql_kots="select t.ter_menuid,p.pr_enable,p.pr_defaultusb,p.pr_printerip ,p.pr_printerport ,p.pr_printername,p.pr_printertype
    from tbl_tableorder t
    left join tbl_menumaster m on t.ter_menuid = m.mr_menuid
    left join tbl_printersettings p on  m.mr_kotcounter = p.pr_kotcode
    where t.ter_dayclosedate='".$_SESSION['date']."' and  p.pr_printertype ='1'  
    and p.pr_floorid='".$result_flor['ter_floorid']."'  AND t.ter_orderno = '".$result_flor['ter_orderno']."'
    GROUP BY p.pr_printerip";
  
        $sql_kotss  =  mysqli_query($con,$sql_kots); 
	$num_kots  = mysqli_num_rows($sql_kotss);
	if($num_kots)
	{	      
	    while($result_kots  = mysqli_fetch_array($sql_kotss)) 
			{
                                $printer_kotname_bill[]=$result_kots['pr_printername'];
				$printer_kotip_bill[]=$result_kots['pr_printerip'];
				$printer_kotport_bill[]=$result_kots['pr_printerport'];
                                $printer_type_bill[]=$result_kots['pr_printertype'];
                                $printer_kotusb_bill[]=$result_kots['pr_defaultusb'];
                                $printer_kot_enable[]=$result_kots['pr_enable'];
                                $printer_kot_menu[]=$result_kots['ter_menuid'];
			}
                        
			foreach ($printer_kotport_bill as $key=>$port)
			{
                           if($printer_kot_enable[$key]=='Y'){  
                               
                            if($printer_kotusb_bill[$key]=='N'){
                                
                                  if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
                                  //exec("ping -n 1 -w 1 ".$printer_kotip_bill[$key], $output, $result);               
                            
                                  
                              ///////////ping starts///// 
                              $ip=$printer_kotip_bill[$key];
                              $logFile = __DIR__ . "/ping_$ip.txt";
                              pclose(popen("start /B cmd /c \"ping -n 1 -w 500 $ip > $logFile\"", "r"));
                              if (file_exists($logFile)) {
                              $content = file_get_contents($logFile);
                                if (strpos($content, "TTL=") !== false) {
                                    $result=0;
                                } else {
                                     $result=1;
                                }
                              }
                             ///////////ping ends/////   
                                      
                                      
                        }
                        }else{
                                $result=0;
                        }  
                           
            if($result == 0)
            {  
               $printpage->print_kot_di_missing($result_flor['ter_kotno'],$result_flor['ter_orderno'],$_SESSION['date'],$_SESSION['kotprint_tp'],$_SESSION['branchofid'],"web");
            }
         
            
            }else{
                
            $log_data_printy=mysqli_query($localhost,"update tbl_tableorder set  ter_kot_printed='Y' where ter_dayclosedate='".$_SESSION['date']."' "
            . "  and ter_orderno = '".$result_flor['ter_orderno']."' and ter_menuid = '".$printer_kot_menu[$key]."' ");
                            
            }
                         
            }    
       
    }
       
   }}
        
}else{
     
   $log_data_printy=mysqli_query($localhost,"update tbl_tableorder set  ter_kot_printed='Y' where "
   . " ter_dayclosedate='".$_SESSION['date']."' and ter_kot_printed='N'  ");
 
} 


}

if(isset($_REQUEST['set'])&& ($_REQUEST['set']=='check_missed_kot_ta')){ 
  
   if($_SESSION['s_printst']=='Y'){ 
   
     /////////////kot ta_hd_cs///////////////////
   
     $sql_flor2="SELECT tab_status,tab_kotno_new,tab_billno,tab_qty,tab_slno FROM tbl_takeaway_billdetails  "
     . " where tab_dayclose_in='".$_SESSION['date']."' and  tab_kot_printed='N' and (tab_kotno_new!='' and tab_kotno_new!='0') "
     . "  group by tab_billno,tab_dayclose_in,tab_slno order by tab_kotno_new asc limit 25";
            $sql_flors2  =  mysqli_query($con,$sql_flor2); 
            $num_flor2  = mysqli_num_rows($sql_flors2);
            if($num_flor2){	
                while($result_flor2  = mysqli_fetch_array($sql_flors2)) 
                {
                      
                    if($result_flor2['tab_qty']=='0' || $result_flor2['tab_qty']==''){
                       
                         $log_data_printy=mysqli_query($localhost,"update tbl_takeaway_billdetails set  tab_kot_printed='Y' where "
                         . " tab_dayclose_in='".$_SESSION['date']."' and tab_billno = '".$result_flor2['tab_billno']."'"
                         . " and tab_slno = '".$result_flor2['tab_slno']."' ");
                        
                    }
                     
                
    $sql_kots="select  p.pr_enable,t.tab_menuid,p.pr_defaultusb,p.pr_printerip ,p.pr_printerport ,p.pr_printername,p.pr_printertype
    from tbl_takeaway_billdetails t
    left join tbl_menumaster m on t.tab_menuid = m.mr_menuid
    left join tbl_printersettings p on m.mr_kotcounter = p.pr_kotcode
    where t.tab_dayclose_in='".$_SESSION['date']."' and t.tab_billno='".$result_flor2['tab_billno']."' and p.pr_printertype ='4' GROUP BY p.pr_printerip"; 
  
 
        $sql_kotss  =  mysqli_query($con,$sql_kots); 
	$num_kots  = mysqli_num_rows($sql_kotss);
	if($num_kots)
	{	
	while($result_kots  = mysqli_fetch_array($sql_kotss)) 
			{
                                $printer_kotname_bill[]=$result_kots['pr_printername'];
				$printer_kotip_bill[]=$result_kots['pr_printerip'];
				$printer_kotport_bill[]=$result_kots['pr_printerport'];
                                $printer_type_bill[]=$result_kots['pr_printertype'];
                                $printer_kotusb_bill[]=$result_kots['pr_defaultusb'];
                                $printer_kot_enable[]=$result_kots['pr_enable'];
                                $printer_kot_menu[]=$result_kots['tab_menuid'];
			}
			foreach ($printer_kotport_bill as $key=>$port)
			{
                            if($printer_kot_enable[$key]=='Y'){  
                                
                            
                            if($printer_kotusb_bill[$key]=='N'){
                                
                            if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
                              
                                
                               //exec("ping -n 1 -w 1 ".$printer_kotip_bill[$key], $output, $result); 
                              ///////////ping starts///// 
                              $ip=$printer_kotip_bill[$key];
                              $logFile = __DIR__ . "/ping_$ip.txt";
                              pclose(popen("start /B cmd /c \"ping -n 1 -w 500 $ip > $logFile\"", "r"));
                              if (file_exists($logFile)) {
                              $content = file_get_contents($logFile);
                                if (strpos($content, "TTL=") !== false) {
                                    $result=0;
                                } else {
                                     $result=1;
                                }
                              }
                             ///////////ping ends/////
                                
                                
                           }
                           
                           }else{
                                  $result=0;
                           }  
                           
        
         if ($result==0) {
    
                
           
                if($result_flor2['tab_billno'][0]=='C'){      
                  ///////cs/////  
                 if($_SESSION['s_cs_kot_before_settle']=='Y' || ($_SESSION['s_cs_kot_after_settle']=='Y' && $result_flor2['tab_status']=='Closed')){

                     $printpage->print_kot_ta_missing($result_flor2['tab_kotno_new'],$result_flor2['tab_billno'],$_SESSION['date'],$_SESSION['takotprint_tp'],$_SESSION['branchofid'],"web");

                 }

                }


                 if($result_flor2['tab_billno'][0]!='C'){      
                  ////ta hd///// 
                 if($_SESSION['bsth_kot_before_tahd']=='Y' ||  ($_SESSION['bsth_kot_after_tahd']=='Y' && $result_flor2['tab_status']=='Closed')){

                     $printpage->print_kot_ta_missing($result_flor2['tab_kotno_new'],$result_flor2['tab_billno'],$_SESSION['date'],$_SESSION['takotprint_tp'],$_SESSION['branchofid'],"web");

                 }
                }
           
            
            }  
                 
            }else{
                
                   $log_data_printy=mysqli_query($localhost,"update tbl_takeaway_billdetails set  tab_kot_printed='Y' where "
                   . " tab_dayclose_in='".$_SESSION['date']."' and tab_billno = '".$result_flor2['tab_billno']."' "
                   . " and tab_menuid = '".$printer_kot_menu[$key]."' ");
               
            } 
                 
            }
                 
            }
        
   }} 
     
}else{
   
   $log_data_printy88=mysqli_query($localhost,"update tbl_takeaway_billdetails set  tab_kot_printed='Y' where "
   . " tab_dayclose_in='".$_SESSION['date']."' and  tab_kot_printed='N' ");
    
} 

}
 if(isset($_REQUEST['set'])&& ($_REQUEST['set']=='check_missed_kot_cons')){
     
 if($_SESSION['s_printst']=='Y'){
    
     ////consolidated di///  
            
            $sql_flor1="SELECT ter_kotno,ter_orderno,ter_floorid,ter_qty,ter_slno FROM tbl_tableorder where ter_cons_printed='N' "
            . " and (ter_kotno !='' and ter_kotno!='0' ) AND ter_dayclosedate='".$_SESSION['date']."' "
            . " group by ter_orderno,ter_kotno,ter_dayclosedate order by  ter_kotno asc limit 25";
            $sql_flors1  =  mysqli_query($con,$sql_flor1); 
            $num_flor1  = mysqli_num_rows($sql_flors1);
            if($num_flor1){	
                while($result_flor1  = mysqli_fetch_array($sql_flors1)) 
                {
                    
                     if($result_flor1['ter_qty']=='0' || $result_flor1['ter_qty']==''){
                         
                       $log_data_printy=mysqli_query($localhost,"update tbl_tableorder set  ter_kot_printed='Y' where "
                       . " ter_dayclosedate='".$_SESSION['date']."'  and ter_orderno = '".$result_flor1['ter_orderno']."' and ter_slno = '".$result_flor1['ter_slno']."' ");              
                        
                    }
                    
                  
     $sql_kots="Select pr_enable,pr_defaultusb,pr_printerip,pr_printerport,pr_printername,pr_printertype From tbl_printersettings "
     . "  Where  pr_printertype='6' and  pr_floorid='".$result_flor1['ter_floorid']."' group by pr_printerip ";
     
 
        $sql_kotss  =  mysqli_query($con,$sql_kots); 
	$num_kots  = mysqli_num_rows($sql_kotss);
	if($num_kots)
	{	
	while($result_kots  = mysqli_fetch_array($sql_kotss)) 
			{
                                $printer_kotname_bill[]=$result_kots['pr_printername'];
				$printer_kotip_bill[]=$result_kots['pr_printerip'];
				$printer_kotport_bill[]=$result_kots['pr_printerport'];
                                $printer_type_bill[]=$result_kots['pr_printertype'];
                                $printer_kotusb_bill[]=$result_kots['pr_defaultusb'];
                                $printer_kot_enable[]=$result_kots['pr_enable'];
			}
                        
			foreach ($printer_kotport_bill as $key=>$port)
			{
                             if($printer_kot_enable[$key]=='Y'){  
                                 
                            if($printer_kotusb_bill[$key]=='N'){
                                  if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
                                 // exec("ping -n 1 -w 1 ".$printer_kotip_bill[$key], $output, $result); 
                                                
                            ///////////ping starts///// 
                              $ip=$printer_kotip_bill[$key];
                              $logFile = __DIR__ . "/ping_$ip.txt";
                              pclose(popen("start /B cmd /c \"ping -n 1 -w 500 $ip > $logFile\"", "r"));
                              if (file_exists($logFile)) {
                              $content = file_get_contents($logFile);
                                if (strpos($content, "TTL=") !== false) {
                                    $result=0;
                                } else {
                                     $result=1;
                                }
                              }
                             ///////////ping ends///// 
                                      
                                      
                            }
                            
                        }else{
                                $result=0;
                        }  
                           
                           
                    if ($result == 0)
                       {     
                    
            if($_SESSION['s_consolidated_print']=='Y'){
              
            $printpage->print_kot_consolidated($result_flor1['ter_kotno'],$result_flor1['ter_orderno'],$_SESSION['date'],$_SESSION['consolidated_tp'],$_SESSION['branchofid'],"web");
  
           }else{
               
              $log_data_printy=mysqli_query($localhost,"update tbl_tableorder set  ter_cons_printed='Y' where "
              . " ter_dayclosedate='".$_SESSION['date']."' and  ter_cons_printed='N'  "); 
              
            }
     
            }
                
            }else{
                            
                $log_data_printy=mysqli_query($localhost,"update tbl_tableorder set  ter_cons_printed='Y' where "
                . " ter_dayclosedate='".$_SESSION['date']."' and  ter_cons_printed='N' ");  
            }
                
           }
                        
          }
           
   }}
     
 }else{
     
     $log_data_printy=mysqli_query($localhost,"update tbl_tableorder set  ter_cons_printed='Y'  where "
     . " ter_dayclosedate='".$_SESSION['date']."' and ter_cons_printed='N'  ");
     
 }
 
 
 }  
 if(isset($_REQUEST['set'])&& ($_REQUEST['set']=='check_missed_kot_cons_ta')){
     
    if($_SESSION['s_printst']=='Y'){    
        
             ///con kot tahdcs////
     
             $sql_flor3="SELECT tab_status,tab_kotno_new,tab_billno,tab_qty,tab_slno FROM tbl_takeaway_billdetails   "
             . " where tab_cons_printed='N' and (tab_kotno_new!='' and "
             . " tab_kotno_new!='0') AND tab_dayclose_in='".$_SESSION['date']."' group by tab_billno,tab_dayclose_in,tab_kotno_new "
             . " order by tab_kotno_new asc limmit 25";
            $sql_flors3  =  mysqli_query($con,$sql_flor3); 
            $num_flor3  = mysqli_num_rows($sql_flors3);
            if($num_flor3){	
                while($result_flor3  = mysqli_fetch_array($sql_flors3)) 
                {
             
              
                     if($result_flor3['tab_qty']=='0' || $result_flor3['tab_qty']==''){
                         
                        $log_data_printy=mysqli_query($localhost,"update tbl_takeaway_billdetails set  tab_kot_printed='Y' where "
                        . " tab_dayclose_in='".$_SESSION['date']."' and tab_billno = '".$result_flor3['tab_billno']."' "
                        . " and tab_slno = '".$result_flor3['tab_slno']."' ");
                        
                    }
                    
         $sql_kots="Select pr_enable,pr_defaultusb,pr_printerip,pr_printerport,pr_printername,pr_printertype From tbl_printersettings "
         . "  Where  pr_printertype='7' group by pr_printerip ";
 
        $sql_kotss  =  mysqli_query($con,$sql_kots); 
	$num_kots  = mysqli_num_rows($sql_kotss);
	if($num_kots)
	{	
	while($result_kots  = mysqli_fetch_array($sql_kotss)) 
			{
           
                                $printer_kotname_bill[]=$result_kots['pr_printername'];
				$printer_kotip_bill[]=$result_kots['pr_printerip'];
				$printer_kotport_bill[]=$result_kots['pr_printerport'];
                                $printer_type_bill[]=$result_kots['pr_printertype'];
                                $printer_kotusb_bill[]=$result_kots['pr_defaultusb'];
                                $printer_kot_enable[]=$result_kots['pr_enable'];
			}
			foreach ($printer_kotport_bill as $key=>$port)
			{
                            
                           if($printer_kot_enable[$key]=='Y'){
                               
                            if($printer_kotusb_bill[$key]=='N'){
                                
                                  if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
                                  //exec("ping -n 1 -w 1 ".$printer_kotip_bill[$key], $output, $result);  
                              ///////////ping starts///// 
                              $ip=$printer_kotip_bill[$key];
                              $logFile = __DIR__ . "/ping_$ip.txt";
                              pclose(popen("start /B cmd /c \"ping -n 1 -w 500 $ip > $logFile\"", "r"));
                              if (file_exists($logFile)) {
                              $content = file_get_contents($logFile);
                                if (strpos($content, "TTL=") !== false) {
                                    $result=0;
                                } else {
                                     $result=1;
                                }
                              }
                             ///////////ping ends///// 
                            
                            }
                           }else{
                                  $result=0;
                           }  
                           
                if ($result == 0)
                {     
                   
                   
            if($_SESSION['s_consolidated_print']=='Y'){     
                   
                
            if($result_flor3['tab_billno'][0]=='C'){      
             
            ///////cs/////  
           if($_SESSION['s_cs_kot_before_settle']=='Y' || ($_SESSION['s_cs_kot_after_settle']=='Y' && $result_flor3['tab_status']=='Closed')){

            
               $printpage->print_kot_ta_consolidated($result_flor3['tab_kotno_new'],$result_flor3['tab_billno'],$_SESSION['date'],$_SESSION['consolidatedta_tp'],$_SESSION['branchofid'],"web");
               
            }
            
           }
           
           
            if($result_flor3['tab_billno'][0]!='C'){      
             
             ////ta hd///// 
            if($_SESSION['bsth_kot_before_tahd']=='Y' ||  ($_SESSION['bsth_kot_after_tahd']=='Y' && $result_flor3['tab_status']=='Closed')){

            
                $printpage->print_kot_ta_consolidated($result_flor3['tab_kotno_new'],$result_flor3['tab_billno'],$_SESSION['date'],$_SESSION['consolidatedta_tp'],$_SESSION['branchofid'],"web");
               
            }
           }
                
                
                
                         
                 }else{
                    
                    
                         $log_data_printy=mysqli_query($localhost,"update tbl_takeaway_billdetails set tab_cons_printed='Y' "
                         . " where tab_dayclose_in='".$_SESSION['date']."' and tab_cons_printed='N' "); 
                }
                
               }
                 
                }else{
                          $log_data_printy=mysqli_query($localhost,"update tbl_takeaway_billdetails set tab_cons_printed='Y' where "
                          . " tab_dayclose_in='".$_SESSION['date']."' and tab_cons_printed='N' ");    
                }
                 
                }
             }
             
     }}
     
     
 }else{
     
   $log_data_printy=mysqli_query($localhost,"update tbl_takeaway_billdetails set tab_cons_printed='Y' where "
   . " tab_dayclose_in='".$_SESSION['date']."' and  tab_cons_printed='N' "); 
    
 }
 
 
 }
if(isset($_REQUEST['set'])&& ($_REQUEST['set']=='check_missed_kot_set_ok')){
    
     //di///
     $log_data_printy1=mysqli_query($localhost,"update tbl_tableorder set  ter_cons_printed='Y' where "
     . " ter_dayclosedate='".$_SESSION['date']."' and ter_cons_printed='N'  ");
     
     $log_data_printy2=mysqli_query($localhost,"update tbl_tableorder set  ter_kot_printed='Y' where "
     . " ter_dayclosedate='".$_SESSION['date']."' and  ter_kot_printed='N' ");
   
}  
if(isset($_REQUEST['set'])&& ($_REQUEST['set']=='check_missed_kot_set_ta_ok')){

     ///tahdcs///
     $log_data_printy3=mysqli_query($localhost,"update tbl_takeaway_billdetails  set tab_kot_printed='Y' where "
     . " tab_dayclose_in='".$_SESSION['date']."' and tab_kot_printed='N' ");
     
     $log_data_printy=mysqli_query($localhost,"update tbl_takeaway_billdetails  set tab_cons_printed='Y' where "
     . " tab_dayclose_in='".$_SESSION['date']."'  and tab_cons_printed='N'  "); 
     
     
}

if(isset($_REQUEST['bill_reprintno'] ) && ($_REQUEST['bill_reprintno']!="" )){
    
        require_once("printer_functions.php");
        $printpage=new PrinterCommonSettings();
    
    if($_REQUEST['db_name']=="arc" ){
        
        $_SESSION['reprint_db']='arc';
    }else{
        $_SESSION['reprint_db']='normal';
    }
        
        
        
         $billno=$_REQUEST['bill_reprintno'];
  
    
          if($billno[0]=="T"){
               $homed="TA"; 
          }else if($billno[0]=="H"){
            $homed="HD";    
          }else if($billno[0]=="C"){
              $homed="CS";
          }else if($billno[0]=="D"){
              $homed="DI";
          }
          
    
    
             if($billno[0]=='D'){
                 
              if($_SESSION['s_printst']=='Y'){    
                 
               $printpage->print_bill($billno,$_SESSION['branchofid'],"web",$_SESSION['billip'],$_SESSION['hosttype'],'Y'); 
                  
              }
             
             }else{
               
                 
             if($_SESSION['s_printst']=='Y'){
                 
              $printpage->print_bill_ta($billno,$homed,$_SESSION['branchofid'],"web",$_SESSION['billip'],$_SESSION['hosttype'],'Y');
              
             }
            
            }
    
}
?>
