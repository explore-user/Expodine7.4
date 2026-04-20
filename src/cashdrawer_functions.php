<?php
//error_reporting(0);
date_default_timezone_set("Asia/Kolkata");

class CashDrawerCommonSettings
{
	function opendrawer($date,$branchid,$username,$hostype='',$type)
	{
		$localhost='';
		if($type=="web")
		{
	   		$localhost=mysqli_connect(HOST_NAME, USER_NAME, PASSWORD,DATABASE_NAME);
		}else if($type=="android")
		{
			include("appdbconnection.php");
		}
		require_once("Escpos.php");
		
		$connector ='';
		$printers ='';$ips='';
		
		$sql_kots_check='';
		if($type=="web")
		{
		 $sql_kots_check="Select cm_cash_drawer_usb as usb,cm_cash_drawer_ip as ip,cm_cash_drawer_port as port From  tbl_expodine_machines  Where cm_ip_address ='".$hostype."' AND cm_enable_cash_drawer='Y'";
                
                 
                }else
		{
			 $sql_kots_check="Select as_cash_drawer_usb as usb,as_cash_drawer_ip as ip,as_cash_drawer_port as port From  tbl_appmachinedetails  Where as_appmachineid ='".$hostype."' AND as_enable_cash_drawer='Y'";
		}
		  $sql_kotss2  =  mysqli_query($localhost,$sql_kots_check); 
		  $num_kots2  = mysqli_num_rows($sql_kotss2);
		  if($num_kots2){
			  while($result_kots2  = mysqli_fetch_array($sql_kotss2)) 
			  {
				  if($result_kots2['ip']!='' && $result_kots2['port']!='')
				  {
                                      
                                      
                                             
                                if($result_kots2['usb']=="N"){
                                          $counter_prn=$result_kots2['ip'];
                                    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
                                    exec("ping -n 1 -w 1 ".$counter_prn, $output, $result); 
                                    } else if (strtoupper(substr(PHP_OS, 0, 3)) === 'LIN')
                                    {
                                        exec("ping -c 1 -w 1 ".$counter_prn, $output, $result);
                                    }
                               
                                
                                if ($result == 0)
                                    {
					  $connector = new NetworkPrintConnector(trim($result_kots2['ip']), trim($result_kots2['port']));
					  $printers = new Escpos($connector);
                                          
                                    }
                                    
                                    }else if($result_kots2['usb']=="Y"){
                                       $printers="\\\\".$result_kots2['ip']."\\".$result_kots2['port'];
                                             $connector = new FilePrintConnector($printers);
                                             $printers = new Escpos($connector);
                                      }                              
					  $printers -> pulse(0);
					  $printers -> close();
                                    
					  //log
					  
					  if($type=="web")
						{
							mysqli_query($localhost,"INSERT INTO `tbl_cash_drawer_log`(`cdl_login`, `cdl_interface`, `cdl_machineid`) VALUES ('".$username."','W','".$hostype."')"); 
						}else
						{
							mysqli_query($localhost,"INSERT INTO `tbl_cash_drawer_log`(`cdl_login`, `cdl_interface`, `cdl_app_id`) VALUES ('".$username."','A','".$hostype."')"); 
						}
					  
					  return "1";
				  }else
				  {
					  return "3";
				  }
				
			  }
			  
		  }else
		  {
			  return "2";
		  }
		
		
		
		
	}
}
