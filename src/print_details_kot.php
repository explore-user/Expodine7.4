<?php
session_start();
include("database.class.php"); 
$database	= new Database();
include('includes/master_settings.php');
require_once("Escpos.php");
$con=mysqli_connect(HOST_NAME, USER_NAME, PASSWORD,DATABASE_NAME);
mysqli_set_charset($con,"utf8");
error_reporting(0);
date_default_timezone_set("Asia/Kolkata");

require_once("printer_functions.php");
$printpage=new PrinterCommonSettings();


if(($_REQUEST['value']=="ta_kotprint"))
  {      
    
    $printing_count=0;

            if(isset($_REQUEST['bilno12']))
            {
                    $_SESSION['printkotbillno']=$_REQUEST['bilno12'];
                    //$_SESSION['printkotno']=$_REQUEST['kotno'];

            }

            if($_SESSION['printkotno']!="")
            {

                    $s=1;
                    if(isset($_REQUEST['gensettle']))
                    {
                    $sql_listall  =  $database->mysqlQuery("Select tab_billno FROM tbl_takeaway_billmaster  Where tab_dayclosedate ='".$_SESSION['date']."' and tab_billno = '".$_SESSION['printkotbillno']."' AND  (tab_mode_of_entry = 'G') limit 1 "); 
                            $num_listall  = $database->mysqlNumRows($sql_listall);
                            if($num_listall){
                              $s++;  
                            }
                    }
                    $mode=1;
                    $sql_listall  =  $database->mysqlQuery("Select tab_billno FROM tbl_takeaway_billmaster  Where tab_dayclosedate ='".$_SESSION['date']."' AND tab_billno = '".$_SESSION['printkotbillno']."' and  (tab_mode = 'CS') limit 1 "); 
                            $num_listall  = $database->mysqlNumRows($sql_listall);
                            if($num_listall){
                              $mode++;  
                            }
                    if($_SESSION['s_printst']=="Y"){
                        $sql_kots="Select pr_defaultusb,pr_printerip,pr_printerport,pr_printername From tbl_printersettings  Where pr_branchid ='".$_SESSION['branchofid']."' and pr_printertype= '4'  and  pr_enable='Y'  group by pr_printerip ";

                    
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

                    if($s==1)
                    {

                    if($mode==2)
                    { 

                    if($_SESSION['counter_kotprint']=='Y')
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


                        if($result == 0 && $printing_count==0)
                        {  
                            $printing_count=1;
                      
                            $printpage->print_kot_ta($_SESSION['printkotno'],$_SESSION['printkotbillno'],$_SESSION['date'],$_SESSION['takotprint_tp'],$_SESSION['branchofid'],"web");
                        }
                    }


                }else
                { 

                    if($_SESSION['ta_hd_kotprint']=='Y'){
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
                            $printpage->print_kot_ta($_SESSION['printkotno'],$_SESSION['printkotbillno'],$_SESSION['date'],$_SESSION['takotprint_tp'],$_SESSION['branchofid'],"web");
                         }           
                }
                
                }
            }
            }
            }
            echo $_SESSION['printkotno'];
    }
    }
    
 else if(($_REQUEST['value']=="ta_kotprint_cancel"))
    {

//			if($_SESSION['printkotno']!="")
//			{

                    $s=1;
                    if(isset($_REQUEST['gensettle']))
                    {
                    $sql_listall  =  $database->mysqlQuery("Select tab_billno FROM tbl_takeaway_billmaster  Where tab_dayclosedate ='".$_SESSION['date']."' AND tab_billno = '".$_SESSION['printkotbillno']."' AND (tab_mode_of_entry = 'G') "); 
                            $num_listall  = $database->mysqlNumRows($sql_listall);
                            if($num_listall){
                                    $s++;  
                            }
                    }
                    $mode=1;
                    $sql_listall  =  $database->mysqlQuery("Select tab_billno FROM tbl_takeaway_billmaster  Where tab_dayclosedate ='".$_SESSION['date']."' AND tab_billno = '".$_SESSION['printkotbillno']."' AND (tab_mode = 'CS') "); 
                            $num_listall  = $database->mysqlNumRows($sql_listall);
                            if($num_listall){
                                    $mode++;  
                            }
                    if($_SESSION['s_printst']=="Y"){
                    if($s==1)
                    {

                            if($mode==2)
                            {

                                    if($_SESSION['counter_kotprint']=='Y')
                                    $printpage->print_cancel_kot_ta($_SESSION['cancel_kot_no'],$_SESSION['cancel_billno'],$_SESSION['date'],$_SESSION['takotprint_tp'],$_SESSION['branchofid'],"web");
                            }else
                            {

                                    if($_SESSION['ta_hd_kotprint']=='Y')
                                    $printpage->print_cancel_kot_ta($_SESSION['cancel_kot_no'],$_SESSION['cancel_billno'],$_SESSION['date'],$_SESSION['takotprint_tp'],$_SESSION['branchofid'],"web");

                            }
                    }
                    }
            //}

    }
    else if(($_REQUEST['value']=="console_ta"))
    {
            $printing_count=0;       
            if($_SESSION['s_consolidated_print']=="Y")
                    {
                    if(isset($_REQUEST['bilno']))
                    {
                            $_SESSION['printkotbillno']=$_REQUEST['bilno'];
                            $_SESSION['printkotno']=$_REQUEST['kotno'];
                    }


                    //if($_SESSION['printkotno']!="")
                    //{
                            $s=1;
                            if(isset($_REQUEST['gensettle']))
                            {
                            $sql_listall  =  $database->mysqlQuery("Select tab_billno FROM tbl_takeaway_billmaster  Where tab_dayclosedate ='".$_SESSION['date']."' and tab_billno = '".$_SESSION['printkotbillno']."' AND (tab_mode_of_entry = 'G') limit 1"); 
                                    $num_listall  = $database->mysqlNumRows($sql_listall);
                                    if($num_listall){
                                            $s++;  
                                    }
                            }
                            $mode=1;

                    $sql_listall  =  $database->mysqlQuery("Select tab_billno FROM tbl_takeaway_billmaster  Where tab_dayclosedate ='".$_SESSION['date']."' and tab_billno = '".$_SESSION['printkotbillno']."' AND tab_mode = 'CS' limit 1"); 
                            $num_listall  = $database->mysqlNumRows($sql_listall);
                            if($num_listall){
                                    $mode++;  

                            }



                            if($_SESSION['s_printst']=="Y"){
                                $sql_kots="Select pr_defaultusb,pr_printerip,pr_printerport,pr_printername From tbl_printersettings  Where pr_branchid ='".$_SESSION['branchofid']."' and pr_printertype= '7' and  pr_enable='Y'  group by pr_printerip ";

                            //echo "Select pr_printerip,pr_printerport,pr_printername From tbl_printersettings  Where pr_branchid ='".$_SESSION['branchofid']."' and pr_printertype=1";
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
                            if($s==1)
                            {


                                    if($mode==2)
                                    { 
                                            if($_SESSION['counter_kotprint']=='Y')

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
                                } 

                                    if($result == 0 && $printing_count==0)
                                    {  $printing_count=1;
                                        $printpage->print_kot_ta_consolidated($_SESSION['printkotno'],$_SESSION['printkotbillno'],$_SESSION['date'],$_SESSION['consolidatedta_tp'],$_SESSION['branchofid'],"web");
                                    }


                                    }else
                                    {
                                            if($_SESSION['ta_hd_kotprint']=='Y')
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
                                    } 
                                    if($result == 0 && $printing_count==0)
                                    {  $printing_count=1;
                                            $printpage->print_kot_ta_consolidated($_SESSION['printkotno'],$_SESSION['printkotbillno'],$_SESSION['date'],$_SESSION['consolidatedta_tp'],$_SESSION['branchofid'],"web");

                                    }        
                                    }
                            }
                            }
                    //}
                    }
    }
    else if(($_REQUEST['value']=="console_ta_cancel"))
    {
            if($_SESSION['s_consolidated_print']=="Y")
                    {//consolidatedta_tp
                    $billno=$_SESSION['cancel_billno'];
                    $kotno=$_SESSION['cancel_kot_no'];

//                                $billno=$_SESSION['printkotbillno'];
//				$kotno=$_SESSION['printkotno'];

                    if(isset($_REQUEST['bilno']))
                    {
                            $billno=$_REQUEST['bilno'];
                            $kotno=$_REQUEST['kotno'];
                    }
                    if($kotno!="")
                    {
                            $s=1;
                            if(isset($_REQUEST['gensettle']))
                            {
                            $sql_listall  =  $database->mysqlQuery("Select tab_billno FROM tbl_takeaway_billmaster  Where tab_dayclosedate ='".$_SESSION['date']."' and tab_billno = '$billno' AND (tab_mode_of_entry = 'G') "); 
                                    $num_listall  = $database->mysqlNumRows($sql_listall);
                                    if($num_listall){
                                            $s++;  
                                    }
                            }
                            $mode=1;
                    $sql_listall  =  $database->mysqlQuery("Select tab_billno FROM tbl_takeaway_billmaster  Where tab_dayclosedate ='".$_SESSION['date']."' and tab_billno = '$billno' AND (tab_mode = 'TA') "); 
                            $num_listall  = $database->mysqlNumRows($sql_listall);
                            if($num_listall){
                                    $mode++;  
                            }
                            if($_SESSION['s_printst']=="Y"){
                            if($s==1)
                            {
                                    if($mode==2)
                                    {
                                            if($_SESSION['counter_kotprint']=='Y')
                            $printpage->print_kot_ta_cancel_consolidated($kotno,$billno,$_SESSION['date'],$_SESSION['consolidatedta_tp'],$_SESSION['branchofid'],"web");
                                    }else
                                    {
                                            if($_SESSION['ta_hd_kotprint']=='Y')
                                            $printpage->print_kot_ta_cancel_consolidated($kotno,$billno,$_SESSION['date'],$_SESSION['consolidatedta_tp'],$_SESSION['branchofid'],"web");
                                    }
                            }
                            }
                    }
                    }
    }
    else if(($_REQUEST['value']=="ta_billprint"))
    {  
        $i=0;
       $printing_count=0;
       $rp="";
       if(isset($_REQUEST['reprintok']))
            {
               $rp=$_REQUEST['reprintok'];
            }


            if(isset($_REQUEST['bilno']) && $_REQUEST['bilno']!=''){
             $que66=$database->mysqlQuery("UPDATE tbl_takeaway_billmaster set tab_bill_print='Y' where "
             . " tab_dayclosedate ='".$_SESSION['date']."' and tab_billno='".$_REQUEST['bilno']."' limit 1 "); 
            }
            
            
            if(isset($_REQUEST['bilno']))
            {
                    $_SESSION['billno']=$_REQUEST['bilno'];
                    $query321=$database->mysqlQuery("UPDATE tbl_takeaway_billmaster set tab_bill_print='Y' where "
                    . " tab_dayclosedate ='".$_SESSION['date']."' and tab_billno='".$_SESSION['billno']."' limit 5 "); 
            }
            
            $s=1;
            if(isset($_REQUEST['bypass']))
            {   
                $query321=$database->mysqlQuery("UPDATE tbl_takeaway_billmaster set tab_bill_print='Y' where "
                . " tab_dayclosedate ='".$_SESSION['date']."' and tab_billno='".$_SESSION['billno']."' limit 5 "); 
                
                    if($_SESSION['s_ta_combkotbill_print']=='Y')
                    {
                            $s++;
                    }
            }else
            { 
                    $query321=$database->mysqlQuery("UPDATE tbl_takeaway_billmaster set tab_bill_print='Y' where "
                    . " tab_dayclosedate ='".$_SESSION['date']."' and tab_billno='".$_SESSION['billno']."' limit 5 "); 
                    $s++;
            }
               $m=1;
              if(isset($_REQUEST['gensettle']))
              {
                  
                      $sql_listall  =  $database->mysqlQuery("Select tab_billno FROM tbl_takeaway_billmaster  Where "
                      . " tab_dayclosedate ='".$_SESSION['date']."' and tab_billno = '".$_SESSION['billno']."' AND (tab_mode_of_entry = 'G') "); 
                      $num_listall  = $database->mysqlNumRows($sql_listall);
                      if($num_listall){
                              $m++;  
                      }
              }
             
              
            if($_SESSION['s_printst']=="Y"){
                
                $sql_kots="Select pr_defaultusb,pr_printerip,pr_printerport,pr_printername From tbl_printersettings  Where "
                . " pr_branchid ='".$_SESSION['branchofid']."' and pr_printertype= '5'  and  pr_enable='Y'  group by pr_printerip ";
                
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
                
            
            if($s==2)
            { 
              
                if($m==1)
              {
                    
                   
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
                        }
                        
            if($result==0 && $printing_count==0)
            {
                
              $printing_count=1;
             
              $printpage->print_bill_ta($_SESSION['billno'],$_REQUEST['homed'],$_SESSION['branchofid'],"web",$_SESSION['billip'],$_SESSION['hosttype'],$rp);
            
              $query321=$database->mysqlQuery("  UPDATE tbl_takeaway_billmaster set tab_bill_print='Y' where tab_dayclosedate ='".$_SESSION['date']."' and tab_billno='".$_SESSION['billno']."' limit 5 ");   
           
            }
               
               
              
              
            }
              
            echo "ok";
            
            }else
            {
              echo "sorry";
            }
            
            
            }
            
           $datetime=date("Y-m-d H:i:s");
            
           $query321=$database->mysqlQuery("UPDATE tbl_takeaway_billmaster set tbl_takeaway_printed='Y' ,tbl_takeaway_print_time='".$datetime."',tab_bill_print='Y' WHERE tab_dayclosedate ='".$_SESSION['date']."' and tab_billno='".$_SESSION['billno']."' ");
            

    }
    else if(($_REQUEST['value']=="ta_billhdprint"))/* ************************Home delivery******************************* */
    {
                    if(isset($_REQUEST['bilno']))
            {
                    $_SESSION['billno']=$_REQUEST['bilno'];
                    //$_SESSION['printkotno']=$_REQUEST['kotno'];
            }
            else{
                $_SESSION['billno']=$_SESSION['printkotbillno'];
            }
    $s=1;
            if(isset($_REQUEST['bypass']))
            {
                    if($_SESSION['s_ta_combkotbill_print']=='Y')
                    {
                            $s++;
                    }
            }else
            {
                    $s++;
            }
            if($_SESSION['s_printst']=="Y"){
    if($s==2)
    {
            $printpage->print_bill_ta($_SESSION['billno'],"hd",$_SESSION['branchofid'],"web",$_SESSION['billip'],$_SESSION['hosttype']);	
            echo "ok";
            }else
    {
            echo "sorry";
    }
        }
    $datetime=date("Y-m-d H:i:s");//$_SESSION['date']." ".
    mysqli_query($con,"UPDATE tbl_takeaway_billmaster set tbl_takeaway_printed='Y' ,tbl_takeaway_print_time='".$datetime."' WHERE tab_billno='".$_SESSION['billno']."' ");

            //unset($_SESSION['billno']);
    }
	

//}

if(($_REQUEST['value']=="ta_kotprint"))
{
if($_SESSION['s_ta_kotbypass']=='N')
	{
		if(isset($_REQUEST['bilno']))
		{
			$_SESSION['printkotbillno']=$_REQUEST['bilno'];
		}
	}
	
}

if(($_REQUEST['value']=="ta_kot_reprint"))
{
    
     if($_SESSION['s_printst']=="Y"){
  $printpage->print_kot_ta($_REQUEST['kotno_rep'],$_REQUEST['bilno_rep'],$_SESSION['date'],$_SESSION['takotprint_tp'],$_SESSION['branchofid'],"web");  
}

}

if($_REQUEST['value']=="cs_kotprint_first")
{
    //echo $_REQUEST['bilno_rep'].$_REQUEST['kotno_rep'].$_SESSION['date'].$_SESSION['takotprint_tp'].$_SESSION['branchofid'];  
     if($_SESSION['s_printst']=="Y"){
         
         
          $sql_kots="Select tab_kotno from tbl_takeaway_billmaster where tab_billno='".$_REQUEST['bill_cs']."'  ";
               
                $sql_kotss  =  mysqli_query($con,$sql_kots); 
                $num_kots  = mysqli_num_rows($sql_kotss);
                if($num_kots)
                {	
                while($result_kots  = mysqli_fetch_array($sql_kotss)) 
                {
                    
                    $kot_cs_new=$result_kots['tab_kotno'];
                }
                }
         
        
                
  $printpage->print_kot_ta($kot_cs_new,$_REQUEST['bill_cs'],$_SESSION['date'],$_SESSION['takotprint_tp'],$_SESSION['branchofid'],"web");  
}

}

if($_REQUEST['value']=="cs_console_kotprint_first")
{
    //echo $_REQUEST['bilno_rep'].$_REQUEST['kotno_rep'].$_SESSION['date'].$_SESSION['takotprint_tp'].$_SESSION['branchofid'];  
     if($_SESSION['s_printst']=="Y"){
         
         
          $sql_kots="Select tab_kotno from tbl_takeaway_billmaster where tab_billno='".$_REQUEST['bill_cs']."'  ";
               
                $sql_kotss  =  mysqli_query($con,$sql_kots); 
                $num_kots  = mysqli_num_rows($sql_kotss);
                if($num_kots)
                {	
                while($result_kots  = mysqli_fetch_array($sql_kotss)) 
                {
                    
                    $kot_cs_new=$result_kots['tab_kotno'];
                }
                }
         
       
        
  $printpage->print_kot_ta_consolidated($kot_cs_new,$_REQUEST['bill_cs'],$_SESSION['date'],$_SESSION['consolidatedta_tp'],$_SESSION['branchofid'],"web");  
}

}

   
?>
