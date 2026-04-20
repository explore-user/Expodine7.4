<?php
session_start();

include('database.class.php'); // DB Connection class
$database	= new Database();
$con=mysqli_connect(HOST_NAME, USER_NAME, PASSWORD,DATABASE_NAME);
error_reporting(0);


if($_REQUEST['type']=="tot_sales"){
    
	$printer_kotip_bill=array();
	$printer_kotport_bill=array(); 
	$bill_ok=0;
	$bill_sorry=1;
	$sql_kots="Select pr_printerip,pr_printerport,pr_printername From tbl_printersettings  Where pr_branchid ='".$_SESSION['branchofid']."' "
        . " and pr_printertype=3 and  pr_enable='Y' ";
	$sql_kotss  =  mysqli_query($con,$sql_kots); 
	$num_kots  = mysqli_num_rows($sql_kotss);
	if($num_kots)
	{	
	while($result_kots  = mysqli_fetch_array($sql_kotss)) 
			{
                                $printer_kotname_bill[]=$result_kots['pr_printername'];
				$printer_kotip_bill[]=$result_kots['pr_printerip'];
				$printer_kotport_bill[]=$result_kots['pr_printerport'];
			}
			foreach ($printer_kotport_bill as $key=>$port)
			{
                                exec("ping -n 1 -w 500 ".$printer_kotip_bill[$key], $output, $result);
                                   
                                   if (!$result == 0)
                                    {

                                        echo "Printing Failed: " .$printer_kotname_bill[$key]."( ".$printer_kotip_bill[$key]." )";

                                    }				 
				  else
				  {
					  echo "";
					
				  }
                                  
			}
        }
}



if($_REQUEST['type']=="TA_KOT_consol_print"){
    
    if($_SESSION['s_printst']=='Y'){
        
	$printer_kotip_bill=array();
	$printer_kotport_bill=array(); 
	$bill_ok=0;
	$bill_sorry=1;
	$sql_kots="Select pr_defaultusb,pr_printerip,pr_printerport,pr_printername From tbl_printersettings  Where "
        . " pr_branchid ='".$_SESSION['branchofid']."' and (pr_printertype= '4' or pr_printertype= '7') and  pr_enable='Y' and "
        . " pr_defaultusb = 'N' group by pr_printerip ";
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
			foreach ($printer_kotip_bill as $key=>$port)
			{
                          if($printer_kotusb_bill[$key]=='N'){  
                          if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
                            exec("ping -n 1 -w 500 ".$printer_kotip_bill[$key], $output, $result);               
                            
                           
                          }
                            
                                   if (!$result == 0)
                                    {
                                       
                                        echo "TA KOT Printing Failed: " .$printer_kotname_bill[$key]."( ".$printer_kotip_bill[$key]." )";

                                    }				 
				  else
				  {
					  echo "";
					 
				  }
                              }   
			}
			
	}else{
                echo '';
        } 
} 
}



if($_REQUEST['type']=="TA_KOT_print"){
    
    if($_SESSION['s_printst']=='Y'){
        
	$printer_kotip_bill=array();
	$printer_kotport_bill=array(); 
	$bill_ok=0;
	$bill_sorry=1;
	$sql_kots="Select pr_defaultusb,pr_printerip,pr_printerport,pr_printername From tbl_printersettings  Where"
        . " pr_branchid ='".$_SESSION['branchofid']."' and pr_printertype= '4' and  pr_enable='Y' and pr_defaultusb = 'N' group by pr_printerip ";
	
       
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
                              
                               exec("ping -n 1 -w 500 ".$printer_kotip_bill[$key], $output, $result);               
                            
                           
                          } 
                               if (!$result == 0)
                                    {
                                       
                                        echo "TA KOT Printing Failed: " .$printer_kotname_bill[$key]."( ".$printer_kotip_bill[$key]." )";

                                    }				 
				  else
				  {
					  echo "";
					 
				  }
                              }else{
                                           echo '';
                            }    
			}
			
	}
} 
}


if($_REQUEST['type']=="cs_kotandbill_print"){
    
    if($_SESSION['s_printst']=='Y'){
        
	$printer_kotip_bill=array();
	$printer_kotport_bill=array(); 
	$bill_ok=0;
	$bill_sorry=1;
	$sql_kots="Select pr_defaultusb,pr_printerip,pr_printerport,pr_printername From tbl_printersettings  Where "
                . " pr_branchid ='".$_SESSION['branchofid']."' and pr_printertype= '4' or pr_printertype='11' or pr_printertype='7' "
                . " and  pr_enable='Y' and pr_defaultusb = 'N' group by pr_printerip ";
	
       
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
                              
                            exec("ping -n 1 -w 500 ".$printer_kotip_bill[$key], $output, $result);               
                            
                           
                          } 
                           
                          if (!$result == 0)
                          {
                                       
                                        echo "Printing Failed: " .$printer_kotname_bill[$key]."( ".$printer_kotip_bill[$key]." )";

                          }				 
			  else{
					echo "";
					 
			  }
                              
                          }else{
                                          
                                        echo '';
                         }     
			}
			
	}
} 
}


if($_REQUEST['type']=="test_print"){
    
    if($_SESSION['s_printst']=='Y'){
        
        if($_REQUEST['usb_lan']=='N'){
        
	$printer_kotip_bill=array();
	$printer_kotport_bill=array(); 
	$bill_ok=0;
	$bill_sorry=1;
	$sql_kots="Select pr_defaultusb,pr_printerip,pr_printerport,pr_printername From tbl_printersettings  Where "
        . " pr_printerip='".$_REQUEST['test_ip']."' and pr_printertype='".$_REQUEST['type1']."' group by pr_printerip";
	
        
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
                            
                          } 
                               
                            if (!$result == 0 )
                                    {
                                      
                                        echo "No Connection to ".$printer_kotip_bill[$key];
                                     
                                    }				 
				  else
				  {
                                        echo 'ok';
                                      
				  }
                            }else{
                                        echo 'ok';
                            }     
			}
        }	
	}else{
            
                        echo 'ok';
        } 
} else{
                        echo 'Print all is Off'; 
}
}




if($_REQUEST['type']=="TA_bill_print"){
    
    if($_SESSION['s_printst']=='Y'){
	$printer_kotip_bill=array();
	$printer_kotport_bill=array(); 
	$bill_ok=0;
	$bill_sorry=1;
	$sql_kots="Select pr_defaultusb,pr_printerip,pr_printerport,pr_printername From tbl_printersettings  Where"
        . " pr_branchid ='".$_SESSION['branchofid']."' and pr_printertype= '5' and  pr_enable='Y' and pr_defaultusb = 'N' group by pr_printerip ";
	
        
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
                              
                            exec("ping -n 1 -w 500 ".$printer_kotip_bill[$key], $output, $result);               
                            
                           
                          } 
                            
                                if (!$result == 0)
                                {
                                     
                                        echo "TA Bill Printing Failed: " .$printer_kotname_bill[$key]."( ".$printer_kotip_bill[$key]." )";

                                  }				 
				  else
				  {
					  echo "";
					 
				  }
                              }else{
                                          echo '';
             }     
		}
			
	}
} 
}


if($_REQUEST['type']=="Advance_pay"){
    
    if($_SESSION['s_printst']=='Y'){
        
	$printer_kotip_bill=array();
	$printer_kotport_bill=array(); 
	$bill_ok=0;
	$bill_sorry=1;
	$sql_kots="Select pr_defaultusb,pr_printerip,pr_printerport,pr_printername From tbl_printersettings  Where"
        . " pr_branchid ='".$_SESSION['branchofid']."' and pr_printertype= '3' and  pr_enable='Y' group by pr_printerip ";
	
       
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
                            
                                   if (!$result == 0)
                                    {
                                      
                                        echo "Advance Bill Printing Failed: " .$printer_kotname_bill[$key]."( ".$printer_kotip_bill[$key]." )";

                                    }				 
				  else
				  {
					  echo "";
					 
				  }
                              }else{
                 echo '';
             }     
			}
			
	}
}else{
    echo '';
} 

}

/// kot cancel///////

if($_REQUEST['type']=="kot_cancel_print"){
    
    if($_SESSION['s_printst']=='Y'){
	$printer_kotip_bill=array();
	$printer_kotport_bill=array(); 
	$bill_ok=0;
	$bill_sorry=1;
        
        $floor="";
        if(isset($_REQUEST['floor'])){
        $floor=$_REQUEST['floor'];
        }
        
         $order="";
        if(isset($_REQUEST['order'])){
        $order=$_REQUEST['order'];
        }
    
        $kotno="";

        $sql_qry = $database->mysqlQuery("select distinct(ter_kotno) from tbl_tableorder 
        where ter_orderno = '".$order."'  order by ter_slno asc");
        $num_rows  = $database->mysqlNumRows($sql_qry);
        if($num_rows){
          while($result_kots_cancel  = mysqli_fetch_array($sql_qry)) 
	   {
              
              $kotno.="'".$result_kots_cancel['ter_kotno']."',";
              
                
          }  
        }
        
   $kot2=  trim($kotno,",");
  // echo $kot2;
  
      
      
    $sql_kots="select pr_defaultusb,pr_printerip , pr_printerport , pr_printername, pr_printertype FROM 
    (select pr_defaultusb,p.pr_printerip AS pr_printerip ,p.pr_printerport AS pr_printerport ,p.pr_printername AS pr_printername,
    p.pr_printertype AS pr_printertype
    from tbl_tableorder t
    left join tbl_menumaster m on t.ter_menuid = m.mr_menuid
    left join tbl_kotcountermaster k on k.kr_kotcode = m.mr_kotcounter
    left join tbl_printersettings p on k.kr_kotcode = p.pr_kotcode
    left join tbl_printertype pt ON pt.pt_id = p.pr_printertype
    where  pt.pt_typename ='KOT Print'  
    and p.pr_floorid='".$floor."' and  p.pr_enable='Y' and p.pr_defaultusb = 'N' AND t.ter_orderno = '".$order."' AND t.ter_kotno in ($kot2)
    union all 
    select pr_defaultusb,p.pr_printerip AS pr_printerip ,p.pr_printerport AS pr_printerport ,p.pr_printername AS pr_printername,
    p.pr_printertype AS pr_printertype
    from tbl_tableorder t
    left join tbl_printersettings p on p.pr_floorid =  t.ter_floorid
    left join tbl_printertype pt ON pt.pt_id = p.pr_printertype
    where t.ter_kotno in($kot2) and  p.pr_enable='Y' and pt.pt_typename='Consolidated' 
    and p.pr_floorid='".$floor."')z
    GROUP BY pr_printerip";
        
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
                          
                                   if (!$result == 0)
                                    {
                                      
                                        echo "KOT Re-PRINTING FAILED: " .$printer_kotname_bill[$key]."( ".$printer_kotip_bill[$key]." )";

                                    }				 
				  else
				  {
					  echo "";
					 
				  }
                                }else{
         echo '';
         }    
			}
			
	}
} 
}

/////ends//////


if($_REQUEST['type']=="kot_reprint"){
    
    if($_SESSION['s_printst']=='Y'){
        
	$printer_kotip_bill=array();
	$printer_kotport_bill=array(); 
	$bill_ok=0;
	$bill_sorry=1;
        
        $floor="";
        if(isset($_REQUEST['floor'])){
        $floor=$_REQUEST['floor'];
        }
        
         $order="";
        if(isset($_REQUEST['order'])){
        $order=$_REQUEST['order'];
        }
    
        $kotno="";
        if(isset($_REQUEST['kotno'])){
        $kotno=$_REQUEST['kotno'];
        }
        
        
        
        
        $sql_kots="select pr_defaultusb,pr_printerip , pr_printerport , pr_printername, pr_printertype FROM 
    (select pr_defaultusb, p.pr_printerip AS pr_printerip ,p.pr_printerport AS pr_printerport ,
    p.pr_printername AS pr_printername,p.pr_printertype AS pr_printertype
    from tbl_tableorder t
    left join tbl_menumaster m on t.ter_menuid = m.mr_menuid
    left join tbl_kotcountermaster k on k.kr_kotcode = m.mr_kotcounter
    left join tbl_printersettings p on k.kr_kotcode = p.pr_kotcode
    left join tbl_printertype pt ON pt.pt_id = p.pr_printertype
    where  pt.pt_typename ='KOT Print'  
    and p.pr_floorid='".$floor."' and  p.pr_enable='Y' and p.pr_defaultusb = 'N' AND t.ter_orderno = '".$order."' AND t.ter_kotno = '".$kotno."'
    union all 
    select pr_defaultusb,p.pr_printerip AS pr_printerip ,p.pr_printerport AS pr_printerport ,
    p.pr_printername AS pr_printername,p.pr_printertype AS pr_printertype
    from tbl_tableorder t
    left join tbl_printersettings p on p.pr_floorid =  t.ter_floorid
    left join tbl_printertype pt ON pt.pt_id = p.pr_printertype
    where t.ter_kotno = '$kotno' and  p.pr_enable='Y' and pt.pt_typename='Consolidated' 
    and p.pr_floorid='".$floor."')z
    GROUP BY pr_printerip";
        


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
                          
                                   if (!$result == 0)
                                    {
                                       
                                        echo "KOT Re-PRINTING FAILED: " .$printer_kotname_bill[$key]."( ".$printer_kotip_bill[$key]." )";

                                    }				 
				  else
				  {
					  echo "";
					 
				  }
                              }else{
                                         echo '';
                    }      
			}
			
	}
} 
}



if($_REQUEST['type']=="KOT_print"){
    
    if($_SESSION['s_printst']=='Y'){
        
	$printer_kotip_bill=array();
	$printer_kotport_bill=array(); 
	$bill_ok=0;
	$bill_sorry=1;
        
        $floor="";
        if(isset($_REQUEST['floor'])){
        $floor=$_REQUEST['floor'];
        }
        
         $order="";
        if(isset($_REQUEST['order'])){
        $order=$_REQUEST['order'];
        }
        
	$sql_kots="select pr_defaultusb,pr_printerip , pr_printerport , pr_printername, pr_printertype FROM 
        (select pr_defaultusb,p.pr_printerip AS pr_printerip ,p.pr_printerport AS pr_printerport ,
        p.pr_printername AS pr_printername,p.pr_printertype AS pr_printertype
        from tbl_tableorder t
        left join tbl_menumaster m on t.ter_menuid = m.mr_menuid
        
        left join tbl_printersettings p on m.mr_kotcounter = p.pr_kotcode
        
        where t.ter_dayclosedate='".$_SESSION['date']."' and t.ter_status = 'Added'  and p.pr_printertype ='1'  
        and p.pr_floorid='".$floor."' and  p.pr_enable='Y' and p.pr_defaultusb = 'N' AND t.ter_orderno = '".$order."' 
        union all 
        select pr_defaultusb,p.pr_printerip AS pr_printerip ,p.pr_printerport AS pr_printerport ,
        p.pr_printername AS pr_printername,p.pr_printertype AS pr_printertype
        from tbl_tableorder t
        left join tbl_printersettings p on p.pr_floorid =  t.ter_floorid
        
        where t.ter_dayclosedate='".$_SESSION['date']."' and t.ter_status = 'Added' and  p.pr_enable='Y' and p.pr_printertype ='6'  
        and p.pr_floorid='".$floor."')z
        GROUP BY pr_printerip";
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
			}
			foreach ($printer_kotport_bill as $key=>$port)
			{
                            if($printer_kotusb_bill[$key]=='N'){
                          if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
                              
                            exec("ping -n 1 -w 500 ".$printer_kotip_bill[$key], $output, $result);               
                            
                           
                          } 
                          
                                   if (!$result == 0)
                                    {
                                       
                                        echo "KOT PRINTING FAILED: " .$printer_kotname_bill[$key]."( ".$printer_kotip_bill[$key]." )";

                                    }				 
				  else
				  {
					  echo "";
					 
				  }
                               }else{
                                          echo '';
         }       
			}
			
	}
} 
}

if($_REQUEST['type']=="shift_print"){
    
    if($_SESSION['s_printst']=='Y'){
        
	$printer_kotip_bill=array();
	$printer_kotport_bill=array(); 
	$bill_ok=0;
	$bill_sorry=1;
        
	$sql_kots="Select pr_defaultusb,pr_printerip,pr_printerport,pr_printername From tbl_printersettings  Where "
        . " pr_branchid ='".$_SESSION['branchofid']."' and pr_printertype= '8' and  pr_enable='Y' and pr_defaultusb = 'N' group by pr_printerip ";
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
                            
                                   if (!$result == 0)
                                    {
                                       
                                        echo "Shift  Report Printer Failed: " .$printer_kotname_bill[$key]."( ".$printer_kotip_bill[$key]." )";

                                    }				 
				  else
				  {
					  echo "";
					 
				  }
                               }else{
                                         echo '';
         }       
			}
			
	}
} 
}



if($_REQUEST['type']=="Bill_print"){
    
     if($_SESSION['s_printst']=='Y'){
         
	$printer_kotip_bill=array();
	$printer_kotport_bill=array(); 
	$bill_ok=0;
	$bill_sorry=1;
        $floor="";
        if(isset($_REQUEST['floor'])){
        $floor=$_REQUEST['floor'];
        }
	$sql_kots="Select pr_defaultusb,pr_printerip,pr_printerport,pr_printername From tbl_printersettings  Where "
        . " pr_branchid ='".$_SESSION['branchofid']."' and pr_printertype= '2' and  pr_enable='Y' and pr_floorid='".$floor."' and pr_defaultusb = 'N' group by pr_printerip ";
	
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
                            
                             
                                   if (!$result == 0)
                                    {
                                      
                                        echo "BILL PRINTING FAILED: " .$printer_kotname_bill[$key]."( ".$printer_kotip_bill[$key]." )";

                                    }				 
				  else
				  {
					  echo "";
					 
				  }
                                }else{
                                          echo '';
         }      
			}
			
	}
} 
}

if($_REQUEST['type']=="Bill_reprint"){
    
     if($_SESSION['s_printst']=='Y'){
         
	$printer_kotip_bill=array();
	$printer_kotport_bill=array(); 
	$bill_ok=0;
	$bill_sorry=1;
        
        $floor="";
        if(isset($_REQUEST['floor'])){
        $floor=$_REQUEST['floor'];
        }
        
	$sql_kots="Select pr_defaultusb,pr_printerip,pr_printerport,pr_printername From tbl_printersettings  Where "
        . " pr_branchid ='".$_SESSION['branchofid']."' and pr_printertype= '2' and pr_floorid='".$floor."'  and  pr_enable='Y' and pr_defaultusb = 'N' group by pr_printerip ";
	
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
                            
                                   if (!$result == 0)
                                    {
                                       
                                        echo "Bill Reprinting Failed: " .$printer_kotname_bill[$key]."( ".$printer_kotip_bill[$key]." )";

                                    }				 
				  else
				  {
					  echo "";
					 
				  }
                             }else{
                                          echo '';
         }         
			}
			
	}
} 
}


//----------------tot sales HD ---------------------//
if(isset($_REQUEST['type']) && $_REQUEST['type']=="tot_sales_hd"){
    
    
	$printer_kotip_bill=array();
	$printer_kotport_bill=array(); 
	$bill_ok=0;
	$bill_sorry=1;
	$sql_kots="Select pr_printerip,pr_printerport,pr_printername From tbl_printersettings  Where pr_branchid ='".$_SESSION['branchofid']."' and pr_printertype=3 and  pr_enable='Y' ";
	$sql_kotss  =  mysqli_query($con,$sql_kots); 
	$num_kots  = mysqli_num_rows($sql_kotss);
	if($num_kots)
	{	
	while($result_kots  = mysqli_fetch_array($sql_kotss)) 
			{
                                $printer_kotname_bill[]=$result_kots['pr_printername'];
				$printer_kotip_bill[]=$result_kots['pr_printerip'];
				$printer_kotport_bill[]=$result_kots['pr_printerport'];
			}
			foreach ($printer_kotport_bill as $key=>$port)
			{
                                exec("ping -n 1 -w 1 ".$printer_kotip_bill[$key], $output, $result);
                                   
                                   if (!$result == 0)
                                    {

                                        echo "Printing Failed: " .$printer_kotname_bill[$key]."( ".$printer_kotip_bill[$key]." )";

                                    }				 
				  else
				  {
					  echo "";
					
				  }
                                 
			}
			
	}
    
}

//-------------------kot reprint log--------/////

if(isset($_REQUEST['set_log_reprint']) && $_REQUEST['set_log_reprint']=="log_reprint") 
 
{  
    $staff_id=$_SESSION['loginempid_id'];
    $date=  date('y-m-d-h-i-s');   
    $kotno=$_REQUEST['kotno'];
    if($kotno!=""){
    $ord="insert into tbl_kot_reprint_log(staff_id,kot_no,reprint_date)"
                   . "values('$staff_id','$kotno','$date')";
            
	$ord1=mysqli_query($con,$ord); 

    }
}


//----------------bill reprint log---------------///

if(isset($_REQUEST['set_log_reprint_bill']) && $_REQUEST['set_log_reprint_bill']=="log_reprint_bill") 
 
{  
    $staff_id=$_SESSION['loginempid_id'];
    $date=  date('y-m-d-h-i-s');   
    $bill_reprint_no=$_REQUEST['billno_reprint'];
    if($bill_reprint_no!=""){
    $ord2="insert into tbl_bill_reprint_log(staff_id,bill_no,reprint_date)"
                   . "values('$staff_id','$bill_reprint_no','$date')";
            
	$ord12=mysqli_query($con,$ord2); 

    }
}
//----------------------- day clsoe report print-----------------------//

else if($_REQUEST['type']=="dayclose_report_print_check"){
    
        $printer_kotip_bill=array();
	$printer_kotport_bill=array(); 
	$bill_ok=0;
	$bill_sorry=1;
	$sql_kots="Select pr_defaultusb,pr_printerip,pr_printerport,pr_printername From tbl_printersettings  Where"
        . " pr_branchid ='1' and pr_printertype='3' and  pr_enable='Y' ";
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
                                exec("ping -n 1 -w 1 ".$printer_kotip_bill[$key], $output, $result);
                                   
                                   if (!$result == 0)
                                    {

                                        echo "Printing Failed: " .$printer_kotname_bill[$key]."( ".$printer_kotip_bill[$key]." )";

                                    }				 
				  else
				  {
					  echo "";
					
				  }
                              }else{
                                          echo "";
                              }
                                
			}
        }
        else{
                              echo "Printer Status Is Off";
        }
}

//----------------------- day clsoe report print-----------------------//

 ?>