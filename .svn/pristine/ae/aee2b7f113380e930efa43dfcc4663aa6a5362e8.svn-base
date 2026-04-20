<?php
include("database.class.php"); // DB Connection class
$database	= new Database();


require_once("Escpos.php");
error_reporting(0);
session_start();
$sql_desg_nos="select be_decimal from tbl_branchmaster where be_branchid='1' ";
	$sql_desg  =  mysqli_query($localhost,$sql_desg_nos); 
	$num_desg  = mysqli_num_rows($sql_desg);
	if($num_desg)
	{
		$result_desg  = mysqli_fetch_array($sql_desg);
		$_SESSION["be_decimal"]=$result_desg['be_decimal'];
				
	}



$check = $_GET['check_value']; 
 if($check == "set_cancel_ta")
{
	$billno=$_REQUEST['billno'];
	$slno='';
        $credit_amount= 0;
        $credit_id= '';
	if(isset($_REQUEST['slno']))
	{
	$slno=$_REQUEST['slno']; 
	$sql_listall  =  $database->mysqlQuery("Update tbl_takeaway_billdetails set tab_cancelled='Y',tab_status='Cancelled' Where tab_billno='".$billno."' AND tab_slno='".$slno."'");
	}else
	{
		$sql_listall  =  $database->mysqlQuery("Update tbl_takeaway_billdetails set tab_cancelled='Y',tab_status='Cancelled' Where tab_billno='".$billno."' ");
		$sql_listall  =  $database->mysqlQuery("Update tbl_takeaway_billmaster set tab_cancelled='Y',tab_status='Cancelled' Where tab_billno='".$billno."' ");
	}
	$sql_listall  = $database->mysqlQuery("SELECT  cd_amount, cd_masterid FROM tbl_credit_details WHERE  cd_billno='".$billno."'"); 
        $num_listall  = $database->mysqlNumRows($sql_listall);
        if($num_listall)
        {
                while($row = mysqli_fetch_array($sql_listall))
                      {
                      $credit_amount= $row['cd_amount'];
                      $credit_id= $row['cd_masterid'];
                      }
            $sql_listall  = $database->mysqlQuery("update tbl_credit_master set crd_totalamount= crd_totalamount-$credit_amount where crd_id='".$credit_id."' ");         
        }
	$sql_listall  =  $database->mysqlQuery("delete from tbl_credit_details  where  cd_billno='".$billno."' ");
	 /*$returnmsg= 'Caught exception: '.  "Update tbl_takeaway_billdetails set tab_cancelled='Y' Where tab_billno='".$billno."' AND tab_slno='".$slno."'";
		  $file = 'log.txt';
		  $content = date("l F d-m-Y h:i:s A")." ".$returnmsg.PHP_EOL;
		  file_put_contents($file, $content, FILE_APPEND | LOCK_EX);*/
		 
	
	$reasontext=mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['reasontext']));
	date_default_timezone_set('Asia/Kolkata');
        $dateexp=date("Y-m-d H:i:s");
	$sql_table_sel3  = $database->mysqlQuery("SELECT * from tbl_staffmaster  WHERE  ser_staffid ='".$_REQUEST['stafflist']."' AND  ser_employeestatus='Active'"); $rrt='';
  $num_table3  = $database->mysqlNumRows($sql_table_sel3);
  if($num_table3)
  {
	  while($row = mysqli_fetch_array($sql_table_sel3))
		{
		$rrt= $row['ser_cancelwithkey'];
                 $staff_cancel= $row['ser_firstname'];
		}
  }
if($rrt=="Y")
	{  
		$result= "yes";
		$sql=$database->mysqlQuery("UPDATE tbl_secretkeymaster SET `sr_expiredtime`='".$dateexp."' WHERE (sr_key='".$_REQUEST['secretkey']."' )  AND (`sr_expiredtime`='0000-00-00 00:00:00' OR sr_expiredtime IS NULL)");
  }else
  {
	  	$result= "no";
		$sql=$database->mysqlQuery("UPDATE tbl_secretkeymaster SET `sr_expiredtime`='".$dateexp."' WHERE (sr_password='".md5($_REQUEST['secretkey'])."')  AND (`sr_expiredtime`='0000-00-00 00:00:00' OR sr_expiredtime IS NULL)");
  }
	//`tab_cancelled`, `tab_cancelledby_careof`, `tab_cancelledreason`, `tab_cancelledsecretkey`, `tab_cancelledlogin`
	
	$sql='';
	if(isset($_REQUEST['slno']))
	{
	$sql=$database->mysqlQuery("UPDATE tbl_takeaway_billdetails SET tab_cancelled='Y',tab_status='Cancelled',`tab_cancelledby_careof`='".$_REQUEST['stafflist']."', `tab_cancelledreason`='".$reasontext."', `tab_cancelledtime`='".$dateexp."', `tab_cancelledsecretkey`='".$_REQUEST['secretkey']."', `tab_cancelledlogin`='".$_SESSION['expodine_id']."' WHERE tab_billno='".$billno."' AND tab_slno='".$slno."' ");
	
	}else
	{
	$sql=$database->mysqlQuery("UPDATE tbl_takeaway_billdetails SET tab_cancelled='Y',tab_status='Cancelled',`tab_cancelledby_careof`='".$_REQUEST['stafflist']."', `tab_cancelledreason`='".$reasontext."', `tab_cancelledtime`='".$dateexp."', `tab_cancelledsecretkey`='".$_REQUEST['secretkey']."', `tab_cancelledlogin`='".$_SESSION['expodine_id']."' WHERE tab_billno='".$billno."' ");	
	$sql=$database->mysqlQuery("UPDATE  tbl_takeaway_billmaster SET tab_cancelled='Y',tab_status='Cancelled',`tab_cancelledby_careof`='".$_REQUEST['stafflist']."', `tab_cancelledreason`='".$reasontext."', `tab_cancelledtime`='".$dateexp."', `tab_cancelledsecretkey`='".$_REQUEST['secretkey']."', `tab_cancelledlogin`='".$_SESSION['expodine_id']."' WHERE tab_billno='".$billno."'  ");
	}
	if($sql)
	echo  "ok";
	else
	echo "sorry";
	
        
        
        $customer="";
    $point_add=0;
    $point_redeem=0;
     $sql_sms1211 =  $database->mysqlQuery("Select * from tbl_loyalty_pointadd_bill where  lob_billno='".$billno."'"); 
		  $num_sms1211  = $database->mysqlNumRows($sql_sms1211);
		  if($num_sms1211)
		  {
		      while($result_sms1211  = $database->mysqlFetchArray($sql_sms1211)) 
			{
                              $customer =$result_sms1211['lob_loyalty_customer'];
                               $point_add =$result_sms1211['lob_point_add'];
                                $point_redeem =$result_sms1211['lob_point_redeem'];
                              
                                      } }
              if($point_redeem>0 || $point_add>0){                        
     $sql_loy=$database->mysqlQuery("UPDATE tbl_loyalty_reg SET ly_points=(ly_points+'".$point_redeem."')-'".$point_add."' ,ly_totalvisit=ly_totalvisit-1 WHERE ly_id='".$customer."' ");
      $sql_loy1=$database->mysqlQuery("UPDATE tbl_takeaway_billmaster  SET tab_redeem_amount='0' where tab_billno='".$billno."' ");
     $sql_loy_del=$database->mysqlQuery("Delete from tbl_loyalty_pointadd_bill where lob_billno ='".$billno."' ");       
    
              }
        
              
              
              
           
              
              
              
                 $bill_tot_cancel=0;     
  $sql_table_sel311  = $database->mysqlQuery("SELECT * from tbl_takeaway_billmaster  WHERE  tab_billno ='".$billno."' ");
$num_table311  = $database->mysqlNumRows($sql_table_sel311);
  if($num_table311)
  {
	  while($row11 = mysqli_fetch_array($sql_table_sel311))
		{
		$bill_tot_cancel= $row11['tab_netamt'];
		}
  }    
  
  $reasontext_cancel='';
  $sql_sms121 =  $database->mysqlQuery("Select * from tbl_cancellation_reasons where  cr_id=$reasontext"); 
		  $num_sms121  = $database->mysqlNumRows($sql_sms121);
		  if($num_sms121)
		  {
		         while($result_sms121  = $database->mysqlFetchArray($sql_sms121)) 
					{
                                          $reasontext_cancel                                =$result_sms121['cr_reason'];
                                      } }
  
        $dt= date("Y-m-d H:i:s");  
        $dt1=date("Y-m-d");
        $detail=" Bill no:$billno \n Cancelled by: $staff_cancel \n Cancelled time:$dt \n Cancelled reason:$reasontext_cancel \n Bill amount:$bill_tot_cancel ";
        
       $date_nw_nw=date('Y-m-d H:i:s');
        
     $sql12=$database->mysqlQuery("INSERT INTO tbl_billcancel_log(bc_billno,bc_date, bc_details, bc_datetime, bc_sms_time, bc_email_time) VALUES ('$billno','$dt1','$detail','$dt','$date_nw_nw','$date_nw_nw')");  
              
          
              
              
}





 if($check == "bill_cancel_cs")
{
	$billno=$_GET['billno'];
	$bill_status=$_GET['status'];
	$staff_pin=$_GET['staff_pin'];

	$reasontext=mysqli_real_escape_string($database->DatabaseLink,trim($_GET['reason']));
    $ser_bill_cancel_permission;
    $staff_id;

	$sql_auth="select ser_bill_cancel_permission,ser_staffid,ser_firstname from tbl_staffmaster where ser_authorisation_code='".$staff_pin."'";


					$result=mysqli_query($localhost,$sql_auth);
					if(mysqli_num_rows($result)>0)
					{
						while ($row1 = mysqli_fetch_array($result)) 
						{

						   $ser_bill_cancel_permission = $row1["ser_bill_cancel_permission"];
						   $ser_staffid= $row1["ser_staffid"];

						    //$ser_firstname= $row1["ser_firstname"];
						}
						if ($ser_bill_cancel_permission=="N") {
							$response["msg"] = "User dont have the permission";
							$response["success"]=0;
						}else
						{
							/////////**************************************$$$$cancel bill**********************



									    	  $credit_amount= 0;
									        $credit_id= '';
										
											$sql_listall  =  $database->mysqlQuery("Update tbl_takeaway_billdetails set tab_cancelled='Y',tab_status='Cancelled' Where tab_billno='".$billno."' ");
											$sql_listall  =  $database->mysqlQuery("Update tbl_takeaway_billmaster set tab_cancelled='Y',tab_status='Cancelled' Where tab_billno='".$billno."' ");
										

										/////*******check paid or not

											if($bill_status=="Closed")
											{

												//******reset credit

												 $sql_listall  = $database->mysqlQuery("SELECT  cd_amount, cd_masterid FROM tbl_credit_details WHERE  cd_billno='".$billno."'"); 
											        $num_listall  = $database->mysqlNumRows($sql_listall);
											        if($num_listall)
											        {
											                while($row = mysqli_fetch_array($sql_listall))
											                {
											                      $credit_amount= $row['cd_amount'];
											                      $credit_id= $row['cd_masterid'];
											                }

											            $sql_listall  = $database->mysqlQuery("update tbl_credit_master set crd_totalamount= crd_totalamount-$credit_amount where crd_id='".$credit_id."' ");         
											        }

											        $sql_listall  =  $database->mysqlQuery("delete from tbl_credit_details  where  cd_billno='".$billno."' ");

											}


										   

										
											 


										date_default_timezone_set('Asia/Kolkata');
									    $dateexp=date("Y-m-d H:i:s");

										$sql_table_sel3  = $database->mysqlQuery("SELECT * from tbl_staffmaster  WHERE  ser_staffid ='".$staff_id."' AND  ser_employeestatus='Active'");
										 $rrt='';
									    $num_table3  = $database->mysqlNumRows($sql_table_sel3);
									    if($num_table3)
									    {
										  while($row = mysqli_fetch_array($sql_table_sel3))
										   {
											         $rrt= $row['ser_cancelwithkey'];
									                 $staff_cancel= $row['ser_firstname'];
										   }
									    }
										if($rrt=="Y")
										{  
											$result= "yes";
											$sql=$database->mysqlQuery("UPDATE tbl_secretkeymaster SET `sr_expiredtime`='".$dateexp."' WHERE (sr_key='".$_REQUEST['secretkey']."' )  AND (`sr_expiredtime`='0000-00-00 00:00:00' OR sr_expiredtime IS NULL)");
									  	}else
									  	{
										  	$result= "no";
											$sql=$database->mysqlQuery("UPDATE tbl_secretkeymaster SET `sr_expiredtime`='".$dateexp."' WHERE (sr_password='".md5($_REQUEST['secretkey'])."')  AND (`sr_expiredtime`='0000-00-00 00:00:00' OR sr_expiredtime IS NULL)");
									  	}
										
										$sql='';
										
										$sql=$database->mysqlQuery("UPDATE tbl_takeaway_billdetails SET tab_cancelled='Y',tab_status='Cancelled',`tab_cancelledby_careof`='".$_REQUEST['stafflist']."', `tab_cancelledreason`='".$reasontext."', `tab_cancelledtime`='".$dateexp."', `tab_cancelledsecretkey`='".$_REQUEST['secretkey']."', `tab_cancelledlogin`='".$_SESSION['expodine_id']."' WHERE tab_billno='".$billno."' ");	
										$sql=$database->mysqlQuery("UPDATE  tbl_takeaway_billmaster SET tab_cancelled='Y',tab_status='Cancelled',`tab_cancelledby_careof`='".$_REQUEST['stafflist']."', `tab_cancelledreason`='".$reasontext."', `tab_cancelledtime`='".$dateexp."', `tab_cancelledsecretkey`='".$_REQUEST['secretkey']."', `tab_cancelledlogin`='".$_SESSION['expodine_id']."' WHERE tab_billno='".$billno."'  ");
										
										if($sql)
										{
											$response["msg"] = "Bill Cancelled";
											$response["success"]=1;
										}
										else
										{
											$response["msg"] = "Bill Cancel failed";
											$response["success"]=0;
										}
										
									        
									        
									    $customer="";
									    $point_add=0;
									    $point_redeem=0;
									    $sql_sms1211 =  $database->mysqlQuery("Select * from tbl_loyalty_pointadd_bill where  lob_billno='".$billno."'"); 
									    $num_sms1211  = $database->mysqlNumRows($sql_sms1211);
										if($num_sms1211)
										{
											  
										    while($result_sms1211  = $database->mysqlFetchArray($sql_sms1211)) 
											{
									                             
									                  $customer =$result_sms1211['lob_loyalty_customer'];
									                  $point_add =$result_sms1211['lob_point_add'];
									                  $point_redeem =$result_sms1211['lob_point_redeem'];
									                              
									          } 
									      }
									    

									     if($point_redeem>0 || $point_add>0)
									     {      

										        $sql_loy=$database->mysqlQuery("UPDATE tbl_loyalty_reg SET ly_points=(ly_points+'".$point_redeem."')-'".$point_add."' ,ly_totalvisit=ly_totalvisit-1 WHERE ly_id='".$customer."' ");
										        $sql_loy1=$database->mysqlQuery("UPDATE tbl_takeaway_billmaster  SET tab_redeem_amount='0' where tab_billno='".$billno."' ");
										        $sql_loy_del=$database->mysqlQuery("Delete from tbl_loyalty_pointadd_bill where lob_billno ='".$billno."' ");       
										    
									     }
									        
									              
									              
									  $bill_tot_cancel=0;     
									  $sql_table_sel311  = $database->mysqlQuery("SELECT * from tbl_takeaway_billmaster  WHERE  tab_billno ='".$billno."' ");
									  $num_table311  = $database->mysqlNumRows($sql_table_sel311);
									  if($num_table311)
									  {
										  while($row11 = mysqli_fetch_array($sql_table_sel311))
											{
											$bill_tot_cancel= $row11['tab_netamt'];
											}
									  }    
									  
									  $reasontext_cancel='';
									  $sql_sms121 =  $database->mysqlQuery("Select * from tbl_cancellation_reasons where  cr_id='".$reasontext."'"); 
											  $num_sms121  = $database->mysqlNumRows($sql_sms121);
											  if($num_sms121)
											  {
											         while($result_sms121  = $database->mysqlFetchArray($sql_sms121)) 
														{
									                          $reasontext_cancel =$result_sms121['cr_reason'];
									                    }
									          }
									  
									        $dt= date("Y-m-d H:i:s");  
									        $dt1=date("Y-m-d");
									        $detail=" Bill no:$billno \n Cancelled by: $staff_cancel \n Cancelled time:$dt \n Cancelled reason:$reasontext_cancel \n Bill amount:$bill_tot_cancel ";
									        
									       $date_nw_nw=date('Y-m-d H:i:s');
									        
									     $sql12=$database->mysqlQuery("INSERT INTO tbl_billcancel_log(bc_billno,bc_date, bc_details, bc_datetime, bc_sms_time, bc_email_time) VALUES ('$billno','$dt1','$detail','$dt','$date_nw_nw','$date_nw_nw')");  
									              
									    



									    /////*********************************************$$$$$$$$$$$$$$$$$$&



						}
					}else{
						$response["msg"] = "User code not available";
						$response["success"]=0;
					}


	
            	echo json_encode($response);
              
              
}

if($check == "bill_details_cs")
{
$billno=$_GET['billno'];


$bm_billno='';
	$bm_dayclosedate='';
	$bm_billtime='';
	$bm_finaltotal='';
	$bm_serv='';
	$bm_billprinted='';
	$bm_lastprintime='';
	$bm_status='';
	$bm_name='';
	$bm_mode='';
	
	$bm_esttime='';
	$bm_customername ='';
	$bm_customermobile ='';
	$bm_address='';
	$bm_landmark='';	
	$bm_area='';
					
	$mode='';



	 $sql_billhis="select *  from tbl_takeaway_billmaster as bm  LEFT JOIN tbl_staffmaster as sm ON sm.ser_staffid=bm.tab_assignedto LEFT JOIN tbl_takeaway_customer as ts ON ts.tac_customerid=bm.tab_hdcustomerid WHERE bm.tab_billno='".$billno."'";



echo $sql_billhis;

	$sql_billhistory  =  $database->mysqlQuery($sql_billhis); 
	$num_billhistory  = $database->mysqlNumRows($sql_billhistory);
	if($num_billhistory)
	{
		while($result_billhistory  = $database->mysqlFetchArray($sql_billhistory)) 
			{
				$bm_billno=$result_billhistory['tab_billno'];
				$bm_dayclosedate=$database->convert_date($result_billhistory['tab_dayclosedate']);
				$bm_billtime=$result_billhistory['tab_time'];
				$bm_mode=$result_billhistory['tab_mode'];

				if($bm_mode=="HD") $mode="Home Delivery";
				else if($bm_mode=="CS") $mode="Counter Sales";
				else if($bm_mode=="TA") $mode="Take Away";

				$bm_status=$result_billhistory['tab_status'];
				$bm_subtotal=$result_billhistory['tab_subtotal'];
				$bm_serv=$result_billhistory['tab_servicecharge'];
				$bm_finaltotal=$result_billhistory['tab_netamt'];
				$bm_billprinted=$result_billhistory['tbl_takeaway_printed'];
				$bm_lastprintime=$result_billhistory['tbl_takeaway_print_time'];
		        $bm_printed_by=$result_billhistory['tab_bill_printed_by'];
			    $bm_kotno=$result_billhistory['tab_kotno'];
				
				
				
				
				
                  $ta_dayclose_pin=$result_billhistory['tab_dayclosedate'];
				 $bm_name=$result_billhistory['ser_firstname'];
				$bm_esttime=$result_billhistory['tab_esttime'];
				$bm_totpax=$result_billhistory['bm_totalpax'];
				
				
				
				
				$cust=$database->show_customer_list($result_billhistory['tab_hdcustomerid']);
				$bm_customername =$cust['tac_customername'];
				$bm_customermobile =$cust['tac_contactno'];
				$bm_address=$result_billhistory['tac_address'];
				$bm_landmark=$result_billhistory['tac_landmark'];	
				$bm_area=$result_billhistory['tac_area'];
                $tips_given=number_format(str_replace(',','',$result_billhistory['tab_tips_given']),$_SESSION['be_decimal']);



				
				$response["success"]=1;
				$response["msg"]="bill data found";
				$details=array();

				$details["Bill no"]="yy";
				$details["Date"]=$bm_dayclosedate;
				$details["Time"]=$bm_billtime;
				$details["Type"]=$mode;
				$details["Status"]=$bm_status;
				$details["Sub total"]=$bm_subtotal;
				$details["Service Charge"]=$bm_serv;
				$details["Net amount"]=$bm_finaltotal;
				$details["Bill Printed"]=$bm_billprinted;
				$details["Last Printed Time"]=$bm_lastprintime;
				$details["Bill Printed by"]=$bm_lastprintime;
				$details["KOT NO"]=$bm_kotno;
				array_push($response["details"], $details);
			


  		
	       

				
					
			}
			
	}else{
		$response["success"]=0;
		$response["msg"]="No bill data found";
	}
	echo json_encode($response);


}

else if ($check == "counter_bill_details") {

$billno=$_GET['billno'];
	
	$sql="select * from tbl_takeaway_billmaster as bm LEFT JOIN tbl_staffmaster as sm ON sm.ser_staffid=bm.tab_assignedto LEFT JOIN tbl_takeaway_customer as ts ON ts.tac_customerid=bm.tab_hdcustomerid WHERE bm.tab_billno='".$billno."'";


	 $result = mysqli_query($localhost,$sql);


	 if (mysqli_num_rows($result)>0) 
	 {


		$response["success"]=1;
		$response["bill_list"] = array();

		while($row_bill=mysqli_fetch_array($result))
		{

		
			

	        $submenu = array();

	       $mode;
	$bm_mode=$row_bill['tab_mode'];

				if($bm_mode=="HD") $mode="Home Delivery";
				else if($bm_mode=="CS") $mode="Counter Sales";
				else if($bm_mode=="TA") $mode="Take Away";

			$submenu["Bill no"] =$billno;
			$submenu["Date"] =$row_bill["tab_dayclosedate"];
			$submenu["Time"] = $row_bill["tab_time"];
			$submenu["Type"] = $mode;
			$submenu["Status"] = $row_bill["tab_status"];
			$submenu["Sub total"] = $row_bill["tab_subtotal"];
			$submenu["Service Charge"] = $row_bill["tab_servicecharge"];
			$submenu["Net amount"] = $row_bill["tab_netamt"];
			$submenu["Bill Printed"] = $row_bill["tbl_takeaway_printed"];
			$submenu["Last Printed Time"] = $row_bill["tbl_takeaway_print_time"];
			$submenu["Bill Printed by"] = $row_bill["tab_bill_printed_by"];
			$submenu["KOT NO"] = $row_bill["tab_kotno"];

			  array_push($response["bill_list"],$submenu);
			 
			 


		}
	

	 }else{
	 	$response["success"]=0;
	 }
	 echo json_encode($response);



}

else if ($check == "counter_bill_settle_details") {

$billno=$_GET['billno'];

$sqls="select *  from tbl_takeaway_billmaster as bm LEFT JOIN  tbl_paymentmode as pm ON bm.tab_paymode=pm.pym_id LEFT JOIN tbl_bankmaster as bk ON bk.bm_id=bm.tab_transcbank  WHERE bm.tab_billno='".$billno."'";

	 $result = mysqli_query($localhost,$sqls);
	  if (mysqli_num_rows($result)>0) 
	 {
	 	$response["success"]=1;
	 	$response["details"] = array();

	 	while($row_bill=mysqli_fetch_array($result))
		{

				$submenu["Bill no"] =$billno;
				$submenu["Pay Mode"] =$row_bill['pym_name'];
				$submenu["Amount"] =$row_bill['tab_netamt'];

				$payid =$row_bill['tab_paymode'];
				$paymode=$row_bill['pym_name'];







				if( $paymode=="Cash")
				{
						$submenu["Amount Paid"]=$row_bill['tab_amountpaid'];
						$submenu["Balance Amount"]=$row_bill['tab_amountbalace'];

				}else if( $paymode=="Credit / Debit")
				{
					
					$submenu["Transaction Amount"]=$result_billhistory['tab_transactionamount'];
					$submenu["Transaction Bank"]=$result_billhistory['bm_name'];
					$submenu["Amount Paid"]=$result_billhistory['tab_amountpaid'];
					$submenu["Balance Amount"]=$result_billhistory['tab_amountbalace'];
					
				}
					else if( $paymode=="Coupons")
				{
					$submenu["Coupon Company"]=$result_billhistory['tab_couponcompany'];
					$submenu["Coupon Amount"]=$result_billhistory['tab_couponamt'];
					$submenu["Amount Paid"]=$result_billhistory['tab_amountpaid'];
					$submenu["Balance Amount"]=$result_billhistory['tab_amountbalace'];
					
					
				}else if( $paymode=="Voucher")
				{
					$submenu["Voucher Name"]=$result_billhistory['vr_vouchername'];
					$submenu["Voucher Cost"]=$result_billhistory['vr_vouchercost'];
					$submenu["Amount Paid"]=$result_billhistory['tab_amountpaid'];
					$submenu["Balance Amount"]=$result_billhistory['tab_amountbalace'];
				
					
				} else if( $paymode=="Cheque")
				{
					
					$submenu["Cheque NO"]=$result_billhistory['tab_chequeno'];
					$submenu["Cheque Bank"]=$result_billhistory['tab_chequebankname'];
					$submenu["Cheque Amount"]=$result_billhistory['tab_chequebankamount'];
					$submenu["Amount Paid"]=$result_billhistory['tab_amountpaid'];
					$submenu["Balance Amount"]=$result_billhistory['tab_amountbalace'];
					
				} 
			



				



				 array_push($response["details"],$submenu);
		}



	 }else
	 {
		$response["success"]=0;
	 }


	 echo json_encode($response);

}


?>