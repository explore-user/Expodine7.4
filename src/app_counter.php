<?php 
include("appdbconnection.php");
require_once("Escpos.php"); 
date_default_timezone_set("Asia/Kolkata");
$check = $_GET['check_value']; 

if($check=="getDate")
{
	$result = mysqli_query($localhost,"SELECT dc_day FROM tbl_dayclose WHERE dc_dateclose IS NULL");
	if (mysqli_num_rows($result) > 0) 
	{
		 while ($row = mysqli_fetch_array($result)) {
			 $response["success"] = 1;
			 $response["Date"] = $row["dc_day"];
			echo json_encode($response);
		 }
	}else
	{
		$response["success"] = 0;
		$response["Date"] = "empty";
		echo json_encode($response);
	}
}

else if($check=="login_details")
{
	$branchid = $_GET["branchid"];
	
	$sql = "SELECT b.be_branchname,b.be_others1,b.be_address,b.be_others2,b.be_email,b.be_others3,b.be_others4,b.be_footer1,b.be_footer2,b.be_footer3,b.be_footer4,b.be_app_printwithloyality,
	b.be_app_printwithdiscount,b.be_androdilogin,b.be_andr_default_login,l.ls_password,b.be_bilregen_with_permission,
	b.be_cash_drawer_settle_btn,b.be_qtychange_authorise,be_kotwaiter_name_dis,b.be_menuimage_in_android,b.be_decimal,b.be_staff_selection,b.be_bill_cancel_auth,b.be_compl_manage_auth,b.be_reprint_authorise,b.be_auth_paymentchange,b.be_search_focus  
	FROM tbl_branchmaster b left join tbl_logindetails l on l.ls_username = b.be_andr_default_login  WHERE b.be_branchid = '".$branchid."'";

 	
	$result = mysqli_query($localhost,$sql);
	if (mysqli_num_rows($result) > 0) 
	{
		 while ($row = mysqli_fetch_array($result)) {
			$response["success"] = 1;
			$response["flr_name"] = $row["be_branchname"];
			//$response["flr_discounttype"] = $row["be_discpountypeoption"];
			$response["flr_discounttype"] ="P";
			$response["flr_loyality"] = $row["be_app_printwithloyality"];
			$response["flr_printwithdiscount"] = $row["be_app_printwithdiscount"];
			$response["flr_portionname"] = "Portion";
			$response["flr_portion_auto_update"] ="N";
			/*$response["flr_portionname"] = $row["be_portionname"];
			$response["flr_portion_auto_update"] = $row["be_portion_autoday_update"];*/
			$response["andr_default_password"] = $row["ls_password"];
			
			$response["flr_androdilogin"] = $row["be_androdilogin"];
			$response["be_staff_selection"] = $row["be_staff_selection"];
			$response["flr_andr_default_login"] = $row["be_andr_default_login"];
			$response["flr_bilregen_with_permission"] = $row["be_bilregen_with_permission"];
			$response["cash_drawer_settle_button"] = $row["be_cash_drawer_settle_btn"];
			$response["qtychange_authorise"] = $row["be_qtychange_authorise"];
			$response["be_reprint_authorise"] = $row["be_reprint_authorise"];
			$response["be_auth_paymentchange"] = $row["be_auth_paymentchange"];
			$response["kotwaiter_name_dis"] = $row["be_kotwaiter_name_dis"];
			$response["menuimageshow"] = $row["be_menuimage_in_android"];
			$response["be_search_focus"] = $row["be_search_focus"];
			
			$response["be_others1"] = $row["be_others1"];
			$response["be_others2"] = $row["be_others2"];
			$response["be_others3"] = $row["be_others3"];
			$response["be_others4"] = $row["be_others4"];
			$response["be_address"] = $row["be_address"];
			$response["be_email"] = $row["be_email"];
			$response["be_footer1"] = $row["be_footer1"];
			$response["be_footer2"] = $row["be_footer2"];
			$response["be_footer3"] = $row["be_footer3"];
			$response["be_footer4"] = $row["be_footer4"];
			$response["be_bill_cancel_auth"] = $row["be_bill_cancel_auth"];
			$response["be_compl_manage_auth"] = $row["be_compl_manage_auth"];
			
			
			
			if($response["flr_portion_auto_update"]=='Y')
			{
				
				if($row["be_specialday"]=='N')
				{
					$sql = "select UPPER(DAYNAME(d.dc_day)) as day from tbl_dayclose d where D.dc_dateclose IS NULL";
					
					$result1 = mysqli_query($localhost,$sql);
					
					if(mysqli_num_rows($result1) > 0)
					{
						//print ">0"; exit();
						while ($row = mysqli_fetch_array($result1)) {
							$response["flr_day"] = $row["day"];
						}
					}
					else
					{
						//print "<0"; exit();
						$response["flr_day"] = "";	
					}
				}
				else
				{
					$response["flr_day"] = "SP HOLIDAY";
				}
			}
			else
			{
				$response["flr_day"] = "";			
			}
			$response["be_decimal"] = $row["be_decimal"];
			echo json_encode($response);
		 }
	}else
	{
		$response["success"] = 0;
		echo json_encode($response);
	}
}

else if($check=="login")
{
$username = $_GET['username'];
$login_type = $_GET['loginyorn'];

if($login_type == 'Y')
{
	$password = md5($_GET['password']);
}
else
{
	$password = $_GET['password'];
}

$machineid =$_GET['machid'];
$s_attenst="";
$query_exec="";
$sql_table_nos="select * from tbl_branchmaster ";
$sql_table  =  mysqli_query($localhost,$sql_table_nos); 
$num_table  = mysqli_num_rows($sql_table);

$floorid = '';
$floorname = '';


/*if($num_table)
{
	while($result_table  = mysqli_fetch_array($sql_table)) 
		{
			$s_attenst=$result_table['be_attendance'];
		}
}*/

$tkord="";
if($s_attenst=="Y")
{
	$sql_desg_nos="select * from tbl_designationmaster where dr_takeorder='Y' ";
	$sql_desg  =  mysqli_query($localhost,$sql_desg_nos); 
	$num_desg  = mysqli_num_rows($sql_desg);
	if($num_desg)
	{$i=0;
		while($result_desg  = mysqli_fetch_array($sql_desg)) 
			{
				if($i==0)
				$tkord="'".$result_desg['dr_designationid']."'";
				else
				$tkord=$tkord.","."'".$result_desg['dr_designationid']."'";
				$i++;
			}
	}
	$desgn_takordr =$tkord;	

}else
{
	$query_exec = mysqli_query($localhost,"select * from tbl_logindetails where ls_username = '".$username."' AND ls_password = '".$password. "'");
}
$result = mysqli_num_rows($query_exec);
    // check if row inserted or notTable_menu_list
    if ($result) {
        $query_exec_mac = mysqli_query($localhost,"select * from tbl_appmachinedetails where as_appmachineid = '".$machineid."'");
		$result_mac = mysqli_num_rows($query_exec_mac);
		
		if (!$result_mac)
		{//echo "insert into tbl_appmachinedetails (as_appmachineid) values('".$machineid."')";
			mysqli_query($localhost,"insert into tbl_appmachinedetails (as_appmachineid) values('".$machineid."')");
			$response["mmachinedetails"] = "new";
		}
		else
		{
			$response["mmachinedetails"] = "old";
		}
		while ($row = mysqli_fetch_array($query_exec)) {
        // temp user array
        $app_rest = $row["ls_applogin"];
		$app_staffid = $row["ls_staffid"];
		if($app_rest == 'Y')
		{
			$response["success"] = 1;
			$response["staff id"] = $app_staffid;
			$response["message"] = "User permission granted!!";
			$response["permission"] = $row["ls_status"];
		}
		else if($app_rest == 'N')

		{
			$response["success"] = 3;
			$response["message"] = "User denied permission!!"; 
			
		}
		}
		
          echo json_encode($response);
    } 
	else 
	{



		//jj
			  $query_checklog = mysqli_query($localhost,"select * from tbl_logindetails where ls_username = '".$username."'");
			  $result_checklog= mysqli_num_rows($query_checklog);
			  if($result_checklog>0)
			  {
				  $query_checklog1 = mysqli_query($localhost,"select * from tbl_logindetails where ls_username = '".$username."' AND ls_password = '".$password. "'");
				  $result_checklog1= mysqli_num_rows($query_checklog1);
				  if($result_checklog1>0)
				  {
					  if($s_attenst=="Y")
						{	
							$query_checklog2 = mysqli_query($localhost,"select * from  tbl_logindetails as lg LEFT JOIN  tbl_staffmaster as sm ON  lg.ls_staffid=sm.ser_staffid LEFT JOIN tbl_designationmaster as dg ON dg.dr_designationid=sm.ser_designation WHERE lg.ls_username='".$username."' and lg.ls_password='".$password. "' and lg.ls_status='Y' AND  dg.dr_takeorder='Y'  and sm.ser_designation IN (".$desgn_takordr.") ");
							$result_checklog2= mysqli_num_rows($query_checklog2);
							if($result_checklog2>0)
							{	
								$query_checklog3 = mysqli_query($localhost,"select * from  tbl_logindetails as lg LEFT JOIN  tbl_staffmaster as sm ON  lg.ls_staffid=sm.ser_staffid LEFT JOIN tbl_designationmaster as dg ON dg.dr_designationid=sm.ser_designation LEFT JOIN tbl_staffattendence as sa ON sa.sce_staffid=sm.ser_staffid  WHERE lg.ls_username='".$username."' and lg.ls_password='".$password. "' and lg.ls_status='Y' AND  dg.dr_takeorder='Y' AND sa.sce_date=CURDATE() and sm.ser_designation IN (".$desgn_takordr.") and sa.sce_timein<CURTIME() and (sa.sce_timeout IS NULL)");
								$result_checklog3= mysqli_num_rows($query_checklog3);
								if($result_checklog3<=0)
								{	
									$response["success"] = 7;
									$response["message"] = "Time Out / Mark Attendance"; 
								}
							}else
							{
								$response["success"] = 6;
								$response["message"] = "No Permission"; 
							}
					  }
					  
				  }else
				  {
					  $response["success"] = 4;
					  $response["message"] = "Password Mismatch"; 
				  }				  			  
			  }
			  else 	
			  {
					  $response["success"] = 5;
					  $response["message"] = "Username not found";   
			  }
		echo json_encode($response);
	}
}


else if($check == "getuserpermission")
{
	$staffid = $_GET['staffid'];
	
	$sql = "select * from tbl_staffmaster where ser_staffid = '".$staffid."'";

	
	$result = mysqli_query($localhost,$sql);
	if(mysqli_num_rows($result) > 0)
	{
		while($row = mysqli_fetch_array($result))
		{
			$response["message"] = "ok";
			$response["success"] = 1;
			$response["discount_permission"] = $row["ser_discountpermission"];
			$response["discount_permission_value"] = $row["ser_discount_manual"];
			$response["kot_cancellation_permission"] = $row["ser_kot_cancel_permission"];

			echo json_encode($response);
		}
	}
	else
	{
		$response["message"] = "not";
		$response["success"] = 0;
		echo json_encode($response);
		
	}	
}


else if($check == "getcompsettlepermission")
{
	$staffid = $_GET['staffid'];
	
	$sql = "select * from tbl_staffmaster where ser_authorisation_code = '".$staffid."'";
	//echo $sql;

	
	$result = mysqli_query($localhost,$sql);
	if(mysqli_num_rows($result) > 0)
	{
		while($row = mysqli_fetch_array($result))
		{
			$response["message"] = "ok";
			$response["success"] = 1;
			$response["ser_comp_permission"] = $row["ser_comp_permission"];
			$response["ser_bill_reprint_per"] = $row["ser_bill_reprint_per"];
			$response["ser_bill_settle_change_per"] = $row["ser_bill_settle_change_per"];
			

			echo json_encode($response);
		}
	}
	else
	{
		$response["message"] = "not";
		$response["success"] = 0;
		echo json_encode($response);
		
	}	
}else if($check == "cancel_cs_itemqty")
{


	$branchid= $_REQUEST['branchid'];
	$billno= $_REQUEST['billno'];
    $mode = $_REQUEST['mode'];

	$itemslno = $_REQUEST['itemslno'];
    $itemqty = $_REQUEST['itemqty'];
    $slno = explode(',',$itemslno);
    $qty = explode(',',$itemqty);
    $reason=$_REQUEST['reason'];
    $staff=$_REQUEST['staff'];
    $login=$_REQUEST['uname'];
    $dayclosedate=$_REQUEST['dayclosedate'];
    //$login=$_SESSION['expodine_id'];
    $cancel_date_time=  date("Y-m-d H:i:s");
     if($_REQUEST['reason']!=""){
      $reason= $_REQUEST['reason'];
      
   }else{
      $reason=0; 
   }


     $response["success"] = 0;
	 $response["message"] = "Kot not cancelled";
    

    mysqli_query($localhost,"SET @branchid = " . "'" .  mysqli_real_escape_string($localhost,$branchid) . "'");
	mysqli_query($localhost,"SET @temp_id = " . "'" .  mysqli_real_escape_string($localhost,$billno) . "'");
	mysqli_query($localhost,"SET @mode = " . "'" .  mysqli_real_escape_string($localhost,$mode) . "'");
	

	$sq = mysqli_query($localhost,"CALL proc_kot_cancel(@branchid,@temp_id,@mode,@cancel_id)");

	if($sq)
	{

		
		$rs = mysqli_query($localhost,'SELECT @cancel_id AS cancel_id' );
		while($row = mysqli_fetch_array($rs))
		{
			$cancel_id= $row['cancel_id'];

		}
	
	}


	$sl_array=  array();
	for($i=0;$i<count($slno);$i++){



if($qty[$i]!=""){



		 $new_qty=0;
		
	$sql_qry1 ="SELECT tab_kotno from tbl_takeaway_billmaster where tab_billno = '".$billno."'";

	

	$num_rows1 = mysqli_query($localhost,$sql_qry1);

			if ($num_rows1) 
			{


				while($result_row1 = mysqli_fetch_array($num_rows1))
				{
					$kot_no=$result_row1['tab_kotno'];

					
				
					
				}

				
			}

			$sql_qry = "SELECT * from tbl_takeaway_billdetails where tab_billno = '".$billno."' and tab_slno = $slno[$i] order by tab_slno asc";


/*echo " SELECT * from tbl_takeaway_billdetails where tab_billno = '".$billno."' and tab_slno = $slno[$i] order by tab_slno asc";*/
		

			$num_rows = mysqli_query($localhost,$sql_qry);

			if ($num_rows) 
			{

				
				$result_row = mysqli_fetch_array($num_rows);




				if($result_row['tab_qty'] != $qty[$i]){

					
					mysqli_query($localhost,"update tbl_takeaway_billdetails set tab_qty = $qty[$i],tab_amount = $qty[$i]*tab_rate
                    where tab_billno = '".$billno."' and tab_slno = $slno[$i]");

                    if( $qty[$i]==0)
                    {

		              mysqli_query($localhost,"update tbl_takeaway_billdetails set tab_status='Cancelled',tab_cancelled='Y' where tab_billno = '".$billno."' and tab_slno = $slno[$i]");

         			} 

         			$new_qty=$result_row['tab_qty']- $qty[$i];

         			  $mode="CS";
         			  /*$insertion['tc_mode'] =$mode;

         			  $insertion['tc_dayclosedate'] =$dayclosedate; 

         			  $insertion['tc_cancel_kotno'] =$kot_no;

         			  	$insertion['tc_cancel_id'] = $cancel_id;                
					    $insertion['tc_billno'] = $billno;
					    $insertion['tc_bill_slno'] = $slno[$i];
					    $insertion['tc_cancel_qty'] = $new_qty;
					    $insertion['tc_cancelled_by'] =$staff;
					    $insertion['tc_cancelled_login'] =$login;
					    $insertion['tc_cancelled_time'] =$cancel_date_time;
					    $insertion['tc_reason'] =$reason;*/

					   

					   /* echo "insert into tbl_takeaway_cancel_items (tc_mode,tc_dayclosedate,tc_cancel_kotno,tc_cancel_id,tc_billno,tc_bill_slno,tc_cancel_qty,tc_cancelled_by,tc_cancelled_login,tc_cancelled_time,tc_reason) values('".$mode."','".$dayclosedate."','".$kot_no."','".$cancel_id."','".$billno."','".$slno[$i]."','".$new_qty."','".$staff."','".$login."','".$cancel_date_time."','".$reason."')";*/


$sql5 = "insert into tbl_takeaway_cancel_items (tc_mode,tc_dayclosedate,tc_cancel_kotno,tc_cancel_id,tc_billno,tc_bill_slno,tc_cancel_qty,tc_cancelled_by,tc_cancelled_login,tc_cancelled_time,tc_reason) values('".$mode."','".$dayclosedate."','".$kot_no."','".$cancel_id."','".$billno."','".$slno[$i]."','".$new_qty."','".$staff."','".$login."','".$cancel_date_time."','".$reason."')";



		mysqli_query($localhost,$sql5);
		//echo $sql5;

				}

				
			}
				
		}

}

 /*echo " | branchid :".$branchid." temp_id :".$billno." mode :".$mode." itemslno :".$itemslno." itemqty :".$itemqty." reason :".$reason." staff :".$staff." login :".$login." reason :".$reason." cancel_id :".$cancel_id." kot_no :".$kot_no." tab_qty :".$result_row['tab_qty']." qty :".$qty[$i]." slno :".$slno[$i];*/



	mysqli_query($localhost,"SET @billno = " . "'" .  mysqli_real_escape_string($localhost,$billno) . "'");
	mysqli_query($localhost,"SET @branchid = " . "'" .  mysqli_real_escape_string($localhost,$branchid) . "'");
	mysqli_query($localhost,"SET @bmode = " . "'" .  mysqli_real_escape_string($localhost,$mode) . "'");


	$kotno="";
		$sq = mysqli_query($localhost,"CALL proc_ta_kot_cancel(@billno,@branchid,@bmode,@MESSAGE)");


          $response["success"] = 1;
		 $response["message"] = "Kot cancelled";
		  			


	 $rp="";
        /*require_once("printer_functions.php");
        $printpage=new PrinterCommonSettings();*/

        $sql_qry11 = "select * from tbl_takeaway_billmaster where tab_billno = '".$billno."'";

        $num_rows11 = mysqli_query($localhost,$sql_qry11);

			if ($num_rows11) 
			{

				
				while($result_row11 = mysqli_fetch_array($num_rows11))
				{
					$billprinted = $result_row11['tab_bill_print'];
					$net_amount=$result_row11['tab_subtotal'];
					
				}

				
			}




			if($billprinted=='Y' && $net_amount>0)
			{

				$printer_on = "select be_printall from tbl_branchmaster";
	  $result_printer_on = mysqli_query($localhost,$printer_on);
	  if(mysqli_num_rows($result_printer_on)>0)
	  {
		  while($row1 = mysqli_fetch_array($result_printer_on))
		  {
			  $print_all = $row1["be_printall"];
		  }
	  }

				
              if ($print_all=='Y') {

              	require_once("printer_functions.php");
							$printpage=new PrinterCommonSettings();

							$prtck=$printpage->print_bill_ta($billno,$mode,$branchid,"android");

							 $response["success"] = 1;
							 $response["message"] = "printall_enabled";
							
              }
              else
              {
              				 $response["success"] = 1;
							 $response["message"] = "printall_disabled";
							
              }

         			
                
     		}
     		else{
     			 $response["success"] = 1;
							 $response["message"] = "Bill not printed";
							
              }
     		







echo json_encode($response);   


	
}

else if($check == "getusermodules")
{
	$staffname = $_GET['staffname'];
	
	$sql = "SELECT u.um_access FROM `tbl_modulemaster` mm left join tbl_usermodules u on u.um_moduleid=mm.`mer_moduleid` where `mer_modulename`='Payment Pending' and u.um_submoduleid='1' and u.um_username= '".$staffname."'";

	
	$result = mysqli_query($localhost,$sql);
	if(mysqli_num_rows($result) > 0)
	{
		while($row = mysqli_fetch_array($result))
		{
			$response["message"] = "ok";
			$response["success"] = 1;
			if(($row["um_access"] == NULL) || ($row["um_access"]==''))
			{
				$response["payment_option_activated"] = 'N';
			}
			else
			{
				$response["payment_option_activated"] = $row["um_access"];
			}
			echo json_encode($response);
		}
	}
	else
	{
		$response["payment_option_activated"] = 'N';
		$response["message"] = "not";
		$response["success"] = 0;
		echo json_encode($response);
		
	}	
}

else if($check == "ordertakingper")
{
	$staffname = $_GET['staffname'];
	
	$sql = "SELECT u.um_access FROM `tbl_modulemaster` mm left join tbl_usermodules u on u.um_moduleid=mm.`mer_moduleid` where `mer_modulename`='Table Order' and u.um_submoduleid='1' and u.um_username= '".$staffname."'";
	
	$result = mysqli_query($localhost,$sql);
	if(mysqli_num_rows($result) > 0)
	{
		while($row = mysqli_fetch_array($result))
		{
			$response["message"] = "ok";
			$response["success"] = 1;
			if(($row["um_access"] == NULL) || ($row["um_access"]==''))
			{
				$response["order_taking_permission"] = 'N';
			}
			else
			{
				$response["order_taking_permission"] = $row["um_access"];
			}
			echo json_encode($response);
		}
	}
	else
	{
		$response["order_taking_permission"] = 'N';
		$response["message"] = "not";
		$response["success"] = 0;
		echo json_encode($response);
	}	
}


else if($check == "ordertakingcounter")
{
	$staffname = $_GET['staffname'];
	
	$sql = "SELECT u.um_access FROM `tbl_modulemaster` mm left join tbl_usermodules u on u.um_moduleid=mm.`mer_moduleid` where `mer_modulename`='Counter Sales' and u.um_submoduleid='1' and u.um_username= '".$staffname."'";
	
	$result = mysqli_query($localhost,$sql);
	if(mysqli_num_rows($result) > 0)
	{
		while($row = mysqli_fetch_array($result))
		{
			$response["message"] = "ok";
			$response["success"] = 1;
			if(($row["um_access"] == NULL) || ($row["um_access"]==''))
			{
				$response["counter_sales_active"] = 'N';
			}
			else
			{
				$response["counter_sales_active"] = $row["um_access"];
			}
			echo json_encode($response);
		}
	}
	else
	{
		$response["counter_sales_active"] = 'N';
		$response["message"] = "not";
		$response["success"] = 0;
		echo json_encode($response);
	}	
}


else if($check == "ordertakingtakeaway")
{
	$staffname = $_GET['staffname'];
	
	$sql = "SELECT u.um_access FROM tbl_usermodules u left join `tbl_modulemaster` mm on mm.mer_moduleid= u.um_moduleid left join tbl_modulesubmaster s on s.mser_submoduleid = u.um_submoduleid where mm.`mer_modulename`='Take Away' and s.`mser_subname`='Take away Bill' and u.um_username = '".$staffname."'";
	
	$result = mysqli_query($localhost,$sql);
	if(mysqli_num_rows($result) > 0)
	{
		while($row = mysqli_fetch_array($result))
		{
			$response["message"] = "ok";
			$response["success"] = 1;
			if(($row["um_access"] == NULL) || ($row["um_access"]==''))
			{
				$response["takeaway_active"] = 'N';
			}
			else
			{
				$response["takeaway_active"] = $row["um_access"];
			}
			echo json_encode($response);
		}
	}
	else
	{
		$response["takeaway_active"] = 'N';
		$response["message"] = "not";
		$response["success"] = 0;
		echo json_encode($response);
	}	
}


else if($check == "koddisplay")
{
	$staffname = $_GET['username'];
	
	$sql = "SELECT u.um_access FROM `tbl_modulemaster` mm left join tbl_usermodules u on u.um_moduleid=mm.`mer_moduleid` where `mer_modulename`='KOD Screen' and u.um_submoduleid='1' and u.um_username= '".$staffname."'";
	
	$result = mysqli_query($localhost,$sql);
	if(mysqli_num_rows($result) > 0)
	{
		while($row = mysqli_fetch_array($result))
		{
			$response["message"] = "ok";
			$response["success"] = 1;
			if(($row["um_access"] == NULL) || ($row["um_access"]==''))
			{
				$response["kodscreen_display"] = 'N';
			}
			else
			{
				$response["kodscreen_display"] = $row["um_access"];
			}
			echo json_encode($response);
		}
	}
	else
	{
		$response["kodscreen_display"] = 'N';
		$response["message"] = "not";
		$response["success"] = 0;
		echo json_encode($response);
	}	
}




else if($check == "getcounterclose")
{
	$staffname = $_GET['staffname'];
	
	$sql = "SELECT u.um_access FROM tbl_usermodules U left join `tbl_modulemaster` mm on mm.mer_moduleid= u.um_moduleid left join tbl_modulesubmaster s on s.mser_submoduleid = um_submoduleid where mm.`mer_modulename`='Take Away' and s.`mser_subname`='Take away Bill' and u.um_username= '".$staffname."'";

	
	$result = mysqli_query($localhost,$sql);
	if(mysqli_num_rows($result) > 0)
	{
		while($row = mysqli_fetch_array($result))
		{
			$response["message"] = "ok";
			$response["success"] = 1;
			if(($row["um_access"] == NULL) || ($row["um_access"]==''))
			{
				$response["counter_payment_option_activated"] = 'N';
			}
			else
			{
				$response["counter_payment_option_activated"] = $row["um_access"];
			}
			echo json_encode($response);
		}
	}
	else
	{
		$response["counter_payment_option_activated"] = 'N';
		$response["message"] = "not";
		$response["success"] = 0;
		echo json_encode($response);
		
	}	
}

else if($check == "getcounterclose_settle_permission")
{
	$staffname = $_GET['staffname'];

	
	$sql = "SELECT ser_counter_settle_permission FROM `tbl_logindetails` join tbl_staffmaster on ls_staffid=ser_staffid where ls_username='".$staffname."'";

	
	$result = mysqli_query($localhost,$sql);
	if(mysqli_num_rows($result) > 0)
	{
		while($row = mysqli_fetch_array($result))
		{
			$response["message"] = "ok";
			$response["success"] = 1;
			if(($row["ser_counter_settle_permission"] == NULL) || ($row["ser_counter_settle_permission"]==''))
			{
				$response["counter_settlement_permission"] = 'N';
			}
			else
			{
				$response["counter_settlement_permission"] = $row["ser_counter_settle_permission"];
			}
			echo json_encode($response);
		}
	}
	else
	{
		$response["counter_settlement_permission"] = 'N';
		$response["message"] = "not";
		$response["success"] = 0;
		echo json_encode($response);
		
	}	
}


else if($check == "bill_history")
{
	$staffname = $_GET['staffname'];
	
	$sql = "SELECT u.um_access FROM tbl_usermodules u left join `tbl_modulemaster` mm on mm.mer_moduleid= u.um_moduleid left join tbl_modulesubmaster s on s.mser_submoduleid = um_submoduleid where mm.`mer_modulename`='Bill History' and s.`mser_subname`='Load Bill History' and u.um_username= '".$staffname."'";

	
	$result = mysqli_query($localhost,$sql);
	if(mysqli_num_rows($result) > 0)
	{
		while($row = mysqli_fetch_array($result))
		{
			$response["message"] = "ok";
			$response["success"] = 1;
			if(($row["um_access"] == NULL) || ($row["um_access"]==''))
			{
				$response["bill_history_view"] = 'N';
			}
			else
			{
				$response["bill_history_view"] = $row["um_access"];
			}
			echo json_encode($response);
		}
	}
	else
	{
		$response["bill_history_view"] = 'N';
		$response["message"] = "not";
		$response["success"] = 0;
		echo json_encode($response);
		
	}	
}




else if($check == "completed_order_permission")
{
	$staffname = $_GET['staffname'];
	
	$sql = "SELECT u.um_access FROM tbl_usermodules u left join `tbl_modulemaster` mm on mm.mer_moduleid= u.um_moduleid left join tbl_modulesubmaster s on s.mser_submoduleid = um_submoduleid where mm.`mer_modulename`='Completed Order' and s.`mser_subname`='Load Completed order' and u.um_username= '".$staffname."'";

	
	$result = mysqli_query($localhost,$sql);
	if(mysqli_num_rows($result) > 0)
	{
		while($row = mysqli_fetch_array($result))
		{
			$response["message"] = "ok";
			$response["success"] = 1;
			if(($row["um_access"] == NULL) || ($row["um_access"]==''))
			{
				$response["completed_order_permission"] = 'N';
			}
			else
			{
				$response["completed_order_permission"] = $row["um_access"];
			}
			echo json_encode($response);
		}
	}
	else
	{
		$response["completed_order_permission"] = 'N';
		$response["message"] = "not";
		$response["success"] = 0;
		echo json_encode($response);
		
	}	
}


else if($check == "setmac")
{
	$machid = $_GET['macid'];
	$sql = "SELECT * FROM `tbl_appmachinedetails` WHERE as_appmachineid = '".$machid."'";
		
	$result = mysqli_query($localhost,$sql);
	
	if(mysqli_num_rows($result)>0)
	{
		while($row = mysqli_fetch_array($result))
		{
			$response["synchornot"] = $row["as_appmachiesych"];
		}
		$response["message"] = "ok";
		$response["success"] = 1;
		echo json_encode($response);
	}
	else
	{
		$sql1 = "insert into tbl_appmachinedetails (as_appmachineid) values('".$machid."')";
		mysqli_query($localhost,$sql1);
	
		$response["synchornot"] = "Y";
		$response["message"] = "ok";
		$response["success"] = 1;
		echo json_encode($response);
		
	}
}

else if($check == "synchornot")
{
	$machid = $_GET['machineid'];
	$sql = "SELECT * FROM `tbl_appmachinedetails` WHERE as_appmachineid = '".$machid."'";
		
	$result = mysqli_query($localhost,$sql);
	
	if(mysqli_num_rows($result)>0)
	{
		while($row = mysqli_fetch_array($result))
		{
			$response["sync"] = $row["as_appmachiesych"];
		}
		$response["message"] = "ok";
		$response["success"] = 1;
		echo json_encode($response);
	}
	else
	{
		$response["message"] = "ok";
		$response["success"] = 0;
		echo json_encode($response);
		
	}
}

else if($check == "status_update")
{
	$machid = $_GET['mac_id'];
	$sql = "SELECT * FROM `tbl_appmachinedetails` WHERE as_appmachineid = '".$machid."'";
	$up = "";	
	
	$result = mysqli_query($localhost,$sql);
	
	if(mysqli_num_rows($result)>0)
	{
		while($row = mysqli_fetch_array($result))
		{
			$up = $row["as_appmachiesych"];
			
			if($up=="Y")
			{
				$sql1 = "update tbl_appmachinedetails set as_appmachiesych='N' where as_appmachineid = '".$machid."' ";
				mysqli_query($localhost,$sql1);
			}
		}		
		$response["message"] = "ok";
		$response["success"] = 1;
		echo json_encode($response);
	}
	else
	{
		$response["message"] = "ok";
		$response["success"] = 0;
		echo json_encode($response);
		
	}
}

else if($check == 'temptake_proc')
{
	$ordernum = $_GET['ordernum'];
	$menuid = $_GET['menuid'];
	$ratetype = $_GET['rate_type'];
	if ($ratetype == 'Portion') {
		$portion = $_GET['portion'];
		$unittype ="";
		$unitweight = 0;
		$unitid = 0;
		$baseunitid = 0;

	}
	else{
		$portion = 0;
		$unitweight = $_GET['unit_weight'];
		$unittype = $_GET['unit_type'];
		if ($unittype == 'Packet') {
			$baseunitid = 0;
			$unitid = $_GET['unit_id'];
		}else{
			$unitid = 0;
			$baseunitid = $_GET['base_unit_id'];
		}
	}
	
	$qty = $_GET['qty'];
	$preference = $_GET['prefernce'];
	$rate = $_GET['rate'];
	$branchid = $_GET['branchid'];
	$mode = $_GET['input_mode'];
	$orderfrom = $_GET['orderfrom'];
	$slno = 0;
	$mode="Add";
	$food=$_GET['food'];
	
	// $obj = json_decode($address);
	
	// for($c=0;$c<count($obj);$c++){
		// echo $obj[$c]->mobile;
	// }



	/*echo 'ordernum: '.$ordernum.',menuid: '.$menuid.',ratetype: '.$ratetype.',portion: '.$portion.',unittype: '.$unittype.',unitweight: '.$unitweight.',unitid: '.$unitid.',baseunitid: '.$baseunitid.',qty: '.$qty.',preference: '.$preference.',rate: '.$rate.',branchid: '.$branchid.',mode: '.$mode.',orderfrom: '.$orderfrom.',slno: '.$slno;
	
	*/


	
	 //mysqli_query($localhost,"SET @temp_billno = " . "'" .$ordernum . "'");

	mysqli_query($localhost,"SET @temp_billno = " . "'" .  mysqli_real_escape_string($localhost,$ordernum) . "'");
	mysqli_query($localhost,"SET @menuid = " . "'" .  mysqli_real_escape_string($localhost,$menuid) . "'");
	mysqli_query($localhost,"SET @rate_type = " . "'" .  mysqli_real_escape_string($localhost,$ratetype) . "'");
	mysqli_query($localhost,"SET @portion = " . "'" .  mysqli_real_escape_string($localhost,$portion) . "'");
	mysqli_query($localhost,"SET @unit_type = " . "'" .  mysqli_real_escape_string($localhost,$unittype) . "'");
	mysqli_query($localhost,"SET @unit_weight = " . "'" .  mysqli_real_escape_string($localhost,$unitweight) . "'");
	mysqli_query($localhost,"SET @unit_id = " . "'" .  mysqli_real_escape_string($localhost,$unitid) . "'");
	mysqli_query($localhost,"SET @base_unit_id = " . "'" .  mysqli_real_escape_string($localhost,$baseunitid) . "'");
	mysqli_query($localhost,"SET @qty = " . "'" .  mysqli_real_escape_string($localhost,$qty) . "'");
	mysqli_query($localhost,"SET @preferencetext = " . "'" .  mysqli_real_escape_string($localhost,$preference) . "'");
	mysqli_query($localhost,"SET @rate = " . "'" .  mysqli_real_escape_string($localhost,$rate) . "'");
	mysqli_query($localhost,"SET @branchid = " . "'" .  mysqli_real_escape_string($localhost,$branchid) . "'");
	mysqli_query($localhost,"SET @mode = " . "'" .  mysqli_real_escape_string($localhost,$mode) . "'");
	mysqli_query($localhost,"SET @order_from = " . "'" .  mysqli_real_escape_string($localhost,$orderfrom) . "'");
	mysqli_query($localhost,"SET @slno = " . "'" .  mysqli_real_escape_string($localhost,$slno) . "'");
	mysqli_query($localhost,"SET @dish_type = " . "'" .  mysqli_real_escape_string($localhost,NULL) . "'");
	mysqli_query($localhost,"SET @food  = " . "'" . mysqli_real_escape_string($localhost,$food) . "'");

	 
	
	$sq=mysqli_query($localhost,"CALL proc_temptakeaway(@temp_billno,@menuid,@rate_type,@portion,@unit_type,@unit_weight,@unit_id,@base_unit_id,@qty,@preferencetext,@rate,@branchid,@mode,@order_from,@slno,@dish_type,@food)")or throw_ex(mysqli_error($localhost)) ;
//print_r($sq) ;
	
	if($sq)
	{
		
		 $response["success"] = 1;
		 $response["message"]= "ok";
		 echo json_encode($response);
	}else
	{
		
		 $response["success"] = 0;
		 $response["message"]= "fail";
		 echo json_encode($response);
	}
	
}

else if($check == 'temptake_proc_blue')
{
	$ordernum = $_GET['ordernum'];
	$menuid = $_GET['menuid'];
	$ratetype = $_GET['ratetype'];
	if ($ratetype == 'Portion') {
		$portion = $_GET['portion'];
		$unittype ="";
		$unitweight = 0;
		$unitid = 0;
		$baseunitid = 0;

	}
	else{
		$portion = 0;
		$unitweight = $_GET['unit_weight'];
		$unittype = $_GET['unit_type'];
		if ($unittype == 'Packet') {
			$baseunitid = 0;
			$unitid = $_GET['unit_id'];
		}else{
			$unitid = 0;
			$baseunitid = $_GET['base_unit_id'];
		}
	}
	
	$qty = $_GET['qty'];
	$preference = $_GET['preference'];
	$rate = $_GET['rate'];
	$branchid = $_GET['branchid'];
	$mode = $_GET['input_mode'];
	$orderfrom = $_GET['orderfrom'];
	$slno = 0;
	$mode="Add";


	/*echo 'ordernum: '.$ordernum.',menuid: '.$menuid.',ratetype: '.$ratetype.',portion: '.$portion.',unittype: '.$unittype.',unitweight: '.$unitweight.',unitid: '.$unitid.',baseunitid: '.$baseunitid.',qty: '.$qty.',preference: '.$preference.',rate: '.$rate.',branchid: '.$branchid.',mode: '.$mode.',orderfrom: '.$orderfrom.',slno: '.$slno;
	
	*/


	
	 //mysqli_query($localhost,"SET @temp_billno = " . "'" .$ordernum . "'");

	mysqli_query($localhost,"SET @temp_billno = " . "'" .  mysqli_real_escape_string($localhost,$ordernum) . "'");
	mysqli_query($localhost,"SET @menuid = " . "'" .  mysqli_real_escape_string($localhost,$menuid) . "'");
	mysqli_query($localhost,"SET @rate_type = " . "'" .  mysqli_real_escape_string($localhost,$ratetype) . "'");
	mysqli_query($localhost,"SET @portion = " . "'" .  mysqli_real_escape_string($localhost,$portion) . "'");
	mysqli_query($localhost,"SET @unit_type = " . "'" .  mysqli_real_escape_string($localhost,$unittype) . "'");
	mysqli_query($localhost,"SET @unit_weight = " . "'" .  mysqli_real_escape_string($localhost,$unitweight) . "'");
	mysqli_query($localhost,"SET @unit_id = " . "'" .  mysqli_real_escape_string($localhost,$unitid) . "'");
	mysqli_query($localhost,"SET @base_unit_id = " . "'" .  mysqli_real_escape_string($localhost,$baseunitid) . "'");
	mysqli_query($localhost,"SET @qty = " . "'" .  mysqli_real_escape_string($localhost,$qty) . "'");
	mysqli_query($localhost,"SET @preferencetext = " . "'" .  mysqli_real_escape_string($localhost,$preference) . "'");
	mysqli_query($localhost,"SET @rate = " . "'" .  mysqli_real_escape_string($localhost,$rate) . "'");
	mysqli_query($localhost,"SET @branchid = " . "'" .  mysqli_real_escape_string($localhost,$branchid) . "'");
	mysqli_query($localhost,"SET @mode = " . "'" .  mysqli_real_escape_string($localhost,$mode) . "'");
	mysqli_query($localhost,"SET @order_from = " . "'" .  mysqli_real_escape_string($localhost,$orderfrom) . "'");
	mysqli_query($localhost,"SET @slno = " . "'" .  mysqli_real_escape_string($localhost,$slno) . "'");
	mysqli_query($localhost,"SET @dish_type = " . "'" .  mysqli_real_escape_string($localhost,NULL) . "'");

	 
	
	$sq=mysqli_query($localhost,"CALL proc_temptakeaway(@temp_billno,@menuid,@rate_type,@portion,@unit_type,@unit_weight,@unit_id,@base_unit_id,@qty,@preferencetext,@rate,@branchid,@mode,@order_from,@slno,@dish_type)")or throw_ex(mysqli_error($localhost)) ;
//print_r($sq) ;
	
	if($sq)
	{
		
		 $response["success"] = 1;
		 $response["message"]= "ok";
		 echo json_encode($response);
	}else
	{
		
		 $response["success"] = 0;
		 $response["message"]= "fail";
		 echo json_encode($response);
	}
	
}


else if($check == "discount")
{
	$sql = "SELECT be_app_printwithdiscount from  tbl_branchmaster";
	
	$result = mysqli_query($localhost,$sql);
	
	if(mysqli_num_rows($result)>0)
	{
		while($row = mysqli_fetch_array($result))
		{
			$response["value"] = $row["be_app_printwithdiscount"];
			//$response["type"] = $row["be_discpountypeoption"];
			$response["type"] = "P";
		}
		$response["message"] = "ok";
		$response["success"] = 1;
		echo json_encode($response);
	}
	else
	{
		$response["message"] = "fails";
		$response["success"] = 10;
		echo json_encode($response);
	}
	
}
else if($check == "get_customer_details")
{
	$customer_contact = $_GET['contact'];
		$result = mysqli_query($localhost,"SELECT * FROM `tbl_takeaway_customer` WHERE tac_contactno ='".$customer_contact."'");

	
	 if (mysqli_num_rows($result) > 0) {
		// looping through all results
		// products node

		$response["cus_details"] = array();
		
		while ($row = mysqli_fetch_array($result)) {
			// temp user array

			$table = array();
			$table["id"] = $row["tac_customerid"];
			$table["name"] = $row["tac_customername"];
			$table["address"] = $row["tac_address"];
            $table["landmark"] = $row["tac_landmark"];
            $table["area"] = $row["tac_area"];
            $table["remarks"] = $row["tac_remarks"];
            $table["per_address"] = $row["tac_per_address"];

			
			$response["cus_details"]= $table;
		}
		// success
		$response["success"] = 1;
		$response["message"] = "found";
		// echoing JSON response
		echo json_encode($response);
	} else {
		// no partner found
		$response["success"] = 0;
		$response["message"] = "No customer found";
	
		// echo no users JSON
		echo json_encode($response);
	}

}
else if($check=="secondproc")
{
	$temp_number = $_GET['temp_number'];
	$branchid = $_GET['branchid'];
	$mode = $_GET['mode'];
	$customer = $_GET['customer'];
	$contactno = $_GET['contactno'];
	$permanent_address = $_GET['permanent_address'];
	$order_address = $_GET['order_address'];
	$landmark = $_GET['landmark'];
	$remarks = $_GET['remarks'];
	$expodine_id = $_GET['expodine_id'];
	$area = $_GET['area'];
	$eatin = $_GET['eat_in'];
	$gst = $_GET['gst'];
	$ds_type = $_GET['discounttype'];
	$ds_id = $_GET['discountid'];
	$discount_of_or='N';

	$login_dayopen_staffid = $_GET['login_dayopen_staffid'];
	$dmode=$_GET['discmode'];//"P";
	
	$flag_print = $_GET['printornot'];
	$redeem = $_GET['redeem'];
	
	
	
	$discount_of_or='';
	$discount_unit_or='';
	$discount_or='';
	$discountid_or='';
	if($ds_type=="drop")
	{
		$discount_of_or="";
		$discount_unit_or="";
		$discount_or="Y";
		$discountid_or=$ds_id;
	}else if($ds_type=="text")
	{
	   $discount_of_or=$ds_id;
		$discount_unit_or=$dmode;
		$discount_or="Y";
		$discountid_or=""; 
	}else if($ds_type=="empty")
	{
		$discount_of_or="";
		$discount_unit_or="";
		$discount_or="N";
		$discountid_or=""; 
	}
	$new_billno='';$kotno='';
		$discount_of_or='0';

	mysqli_query($localhost,"SET @temp_billno = " . "'" . $temp_number . "'");
	mysqli_query($localhost,"SET @branchid = " . "'" . $branchid . "'");
	mysqli_query($localhost,"SET @bmode = " . "'" . $mode . "'");
	mysqli_query($localhost,"SET @customer = " . "'" . $customer . "'");
	mysqli_query($localhost,"SET @contactno = " . "'" . $contactno . "'");
	mysqli_query($localhost,"SET @permanent_address = " . "'" . $permanent_address . "'");
	mysqli_query($localhost,"SET @order_address = " . "'" . $order_address . "'");
	mysqli_query($localhost,"SET @landmark = " . "'" . $landmark . "'");
	mysqli_query($localhost,"SET @area = " . "'" . $area . "'");
	mysqli_query($localhost,"SET @discount_of = " . "'" . $discount_of_or . "'");
	mysqli_query($localhost,"SET @discount_unit = " . "'" . $discount_unit_or . "'");
	mysqli_query($localhost,"SET @discount = " . "'" . $discount_or . "'");
	mysqli_query($localhost,"SET @discountid = " . "'" . $discountid_or . "'");
	mysqli_query($localhost,"SET @remarks = " . "'" . $remarks. "'");
	mysqli_query($localhost,"SET @loginid = " . "'" . $expodine_id. "'");
	mysqli_query($localhost,"SET @eat_in = " . "'" . $eatin. "'");
	mysqli_query($localhost,"SET @gst = " . "'" . $gst. "'");
	mysqli_query($localhost,"SET @order_confirming_staff = " . "'" . $login_dayopen_staffid. "'");
	mysqli_query($localhost,"SET @redeem = " . "'" . $redeem. "'");
	mysqli_query($localhost,"SET @new_billno = " . "'" . $new_billno . "'");
	mysqli_query($localhost,"SET @kotno = " . "'" . $kotno . "'");
	//echo $_SESSION['eatin'];
	
	//$database->mysqlQuery("SET @remarks 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['remarks']) . "'");
	// $database->mysqlQuery("SET @loginid 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['expodine_id']) . "'");	
	// $database->mysqlQuery("SET @eat_in 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink, $_REQUEST['eatin']) . "'");	
	// $database->mysqlQuery("SET @gst 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink, $_REQUEST['gst']) . "'");
	// $database->mysqlQuery("SET @order_confirming_staff = " . "'".$_REQUEST['login_dayopen_staffid']."'");
	// $database->mysqlQuery("SET @redeem 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$redeem) . "'");
	
	
	$sq = mysqli_query($localhost,"CALL proc_gentakeaway(@temp_billno,@branchid,@bmode,@customer,@contactno,@permanent_address,@order_address,@landmark,@area,@remarks,@discount_of,@discount_unit,@discount,@discountid,@loginid,@eat_in,@gst,@new_billno,@order_confirming_staff,@redeem,@kotno)");
		// $sq=$database->mysqlQuery("CALL  proc_gentakeaway(@temp_billno,@branchid,@bmode,@customer,@contactno,@permanent_address,@order_address,@landmark,@area,@remarks,@discount_of,@discount_unit,@discount,@discountid,@loginid,@eat_in,@gst,@new_billno,@order_confirming_staff,@redeem,@kotno)");
 $sql_ta_billdetails =  mysqli_query($localhost," UPDATE `tbl_takeaway_customer` SET `tac_customername`='".$customer."',"
               . "`tac_address`='".$order_address."',`tac_landmark`='".$landmark."',`tac_area`='".$area."',`tac_remarks`='".$remarks."',"
               . "`tac_branchid`='".$branchid."',`tac_per_address`='".$permanent_address."',"
               . ",`tac_gst`='".$gst."' WHERE tac_contactno='".$contactno."'");
		
			  
	if($sq)
	{
		
			   
		$rs = mysqli_query($localhost,'SELECT @new_billno AS billnumber,@kotno as kot' );
		
		while($row = mysqli_fetch_array($rs))
		{
			$s= $row['billnumber'];
			$num = $row['kot'];
		}
		$bill_nunmber = $s;
		$kot_number = $num;
$response["bill"] = $s;
$response["kot"] = $num;
		
		$cur="";
	  $sql_desg_nos1="select * from tbl_dayclose where dc_timeclose IS NULL";//and dc_day ='$dt'
			  $sql_desg1  =  mysqli_query($localhost,$sql_desg_nos1);
			  $num_desg1  = mysqli_num_rows($sql_desg1);
			  if($num_desg1){
			  while($result_desg1  = mysqli_fetch_array($sql_desg1)) 
				  {
				  $cur=$result_desg1['dc_day'];
				  
				  }
			  }
			  
		$date = $cur;  
		
			  
	
		$kotprint_tp='';
			$sql_table_pt="select * from tbl_printertype ";
			  $sql_pt  =  mysqli_query($localhost,$sql_table_pt); 
			  $num_pt  = mysqli_num_rows($sql_pt);
			  if($num_pt){
				  while($result_pt  = mysqli_fetch_array($sql_pt)) 
					  {
						  if($result_pt['pt_typename']=="TA KOT Print")
						  {
							  $kotprint_tp=$result_pt['pt_id'];
						  }
						  
					  }
			  }
			  
			  
		/*echo $bill_nunmber;
		echo $kot_number;	
		echo $date;  
		echo $kotprint_tp;
		echo $branchid;*/
		
                          
                        $sql_table_pt="select be_printall from tbl_branchmaster";
	$sql_pt  =  mysqli_query($localhost,$sql_table_pt); 
	$num_pt  = mysqli_num_rows($sql_pt);
	if($num_pt)
	{
		while($result_pt1  = mysqli_fetch_array($sql_pt)) 
		{
                    $print_all=$result_pt1['be_printall'];
                    
                }
                }  
                          
		require_once("printer_functions.php");
		$printpage=new PrinterCommonSettings();
                
                if($print_all=='Y'){
		$prtck=$printpage->print_kot_ta($kot_number,$bill_nunmber,$date,$kotprint_tp,$branchid,"android");
                }
		/*if($prtck>=1)
		{
			echo "kot printed";
		}
		else
		{
			echo "kot not printed";
		}
		*/
		
		if($flag_print==2)
		{
			// print bill starts
			require_once("printer_functions.php");
		    $printpage=new PrinterCommonSettings(); 
                      if($print_all=='Y'){
		    $prtck=$printpage->print_bill_ta($bill_nunmber,$mode,$branchid,"android");
                      }
			//print bill ends
		}

		 $response["success"] = 1;
		 $response["message"]= "ok";
		 echo json_encode($response);
	}else
	{
		echo "fail";
		 $response["success"] = 0;
		 $response["message"]= "fail";
		 echo json_encode($response);
	}
}

else if($check== 'discount_details')
{
	$branchid = $_GET['branchid'];
	
	$result = mysqli_query($localhost,"SELECT `ds_discountid`, `ds_discountname` FROM `tbl_discountmaster` WHERE `ds_branchid`='".$branchid."' and  `ds_status` = 'Active'");
	if (mysqli_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["discountarray"] = array();
	
    while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $submenu = array();
        $submenu["discountid"] = $row["ds_discountid"];
		$submenu["discountname"] = $row["ds_discountname"];
		
		
        array_push($response["discountarray"], $submenu);
    }
  // success
   $response["message"] = "Y";
    $response["success"] = 1;
	
    // echoing JSON response
    echo json_encode($response);
} else {
    // no products found
    $response["success"] = 0;
    $response["message"] = "No discounts found";
    echo json_encode($response);
	}
}

else if($check== 'logout')
{
	$username = $_GET['username'];	
	$password = md5($_GET['password']);
	$result = mysqli_query($localhost,"select * from tbl_logindetails where ls_username = '".$username."' AND ls_password = '".$password."'");

	$rows = mysqli_num_rows($result);
	
	if($rows)
	{
		$response["success"] = 1;
		 $response["message"] = "OK";
    	echo json_encode($response);
	}else
	{
		$response["success"] = 2;
		$response["message"] = "NO";
    	echo json_encode($response);
	}
	
}
else if($check== 'set_bill_reorder')
{

			$bill_no = $_GET['bill_no'];
			$bill_status = 'Y';
		$result = mysqli_query($localhost,"UPDATE tbl_takeaway_billmaster SET tab_bill_reorder = '".$bill_status."' WHERE tab_billno='".$bill_no."'");
// echo "UPDATE tbl_takeaway_billmaster SET tab_bill_reorder = '".$bill_status."' WHERE tab_billno='".$bill_no."'";
 if ($result) {
		 
		$response["success"] = 0;
		$response["message"] = "found";
		// echoing JSON response
		echo json_encode($response);
	} else {
		// no products found
		$response["success"] = 1;
		$response["message"] = "No bill found";
		 echo json_encode($response);
	}
	
}

else if($check == "defaultfloor")
{
	$staffid = $_GET['staffid'];	
	$sql = "SELECT `ser_defaultfloor` FROM `tbl_staffmaster` WHERE `ser_staffid`='".$staffid."'";
	
	$result = mysqli_query($localhost,$sql);
	
	if(mysqli_num_rows($result)>0)
	{
		while($row = mysqli_fetch_array($result))
		{
			$s = $row["ser_defaultfloor"];
			if(($s=="NULL") || ($s==""))
			{
				$response["default_floor_id"] = 'N';
			}
			else
			{
				$response["default_floor_id"] = $row["ser_defaultfloor"];
			}
		}
		$response["message"] = "ok";
		$response["success"] = 1;
		echo json_encode($response);
	}
	else
	{
		$response["default_floor_id"] = 'N';
		$response["message"] = "fails";
		$response["success"] = 0;
		echo json_encode($response);
	}
	
}


else if($check== 'bill_number_details')
{
	$date = $_GET['date'];
	$floor_id = $_GET['floor_id'];
	
	
	$sql = "SELECT `bm_billno`,bm_status FROM `tbl_tablebillmaster` where `bm_dayclosedate` = '".$date."'  and bm_status <> 'Regenerating'";
		
	if($floor_id=="blank")
	{
		$sql = $sql." order by `bm_billtime` desc";
	}
	else
	{
		$sql = $sql." and `bm_floorid` = '".$floor_id."'  order by `bm_billtime` desc";
	}
	
	
	$result = mysqli_query($localhost,$sql);
	
	if (mysqli_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["bill_history_details"] = array();
	
    while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $submenu = array();
        $submenu["bill_number"] = $row["bm_billno"];	
		$submenu["bill_status"] = $row["bm_status"];		
		
        array_push($response["bill_history_details"], $submenu);
    }
  // success
   $response["message"] = "Y";
    $response["success"] = 1;
	
    // echoing JSON response
    echo json_encode($response);
} else {
    // no products found
    $response["success"] = 0;
    $response["message"] = "No discounts found";
    echo json_encode($response);
	}
}

else if($check== 'order_settle_deails')
{
	$bill_num = $_GET['bill_num'];
	$branchid = $_GET['branchid'];
	
	$sql = "select m.mr_menuname, p.pm_portionname, t.ter_qty, t.ter_rate,(t.ter_qty*t.ter_rate) as totrate,b.bm_finaltotal FROM tbl_tableorder t left join tbl_menumaster m on m.mr_menuid = t.ter_menuid left join tbl_portionmaster p on p.pm_id=t.ter_portion left join tbl_tablebillmaster b on b.bm_billno=t.ter_billnumber where t.ter_billnumber='".$bill_num."' and t.ter_branchid='".$branchid."'";
	$result = mysqli_query($localhost,$sql);
	
	if (mysqli_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["Bill_No_Ordr_Settlement_Details_details"] = array();
	
    while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $submenu = array();
        $submenu["menu_name"] = $row["mr_menuname"];	
		$submenu["portion_name"] = $row["pm_portionname"];	
		$submenu["menu_qty"] = $row["ter_qty"];	
		$submenu["menu_rate"] = $row["ter_rate"];		
		$submenu["totrate"] = $row["totrate"];
		
        array_push($response["Bill_No_Ordr_Settlement_Details_details"], $submenu);
		
		$response["final_tot"] = $row["bm_finaltotal"];	
    }
  // success
   $response["message"] = "Y";
   
    $response["success"] = 1;
	
    // echoing JSON response
    echo json_encode($response);
} else {
    // no products found
    $response["success"] = 0;
    $response["message"] = "No discounts found";
    echo json_encode($response);
	}
}

else if($check== 'settlement_details')
{
	$bill_num = $_GET['bill_num'];
	
	$sql = "select p.pym_name, m.bm_amountpaid, m.bm_amountbalace,m.bm_transactionamount,m.bm_finaltotal FROM tbl_tablebillmaster m left join tbl_paymentmode p on p.pym_id=m.bm_paymode where m.bm_billno='".$bill_num."'";
	
	$result = mysqli_query($localhost,$sql);
	
	if (mysqli_num_rows($result) > 0) {
    // looping through all resultss
    while ($row = mysqli_fetch_array($result)) {
        // temp user array
		$response["payment_mode"] = $row["pym_name"];   	
		$response["amount_paid"] = $row["bm_amountpaid"];	
		$response["balance_amount"] = $row["bm_amountbalace"];
		$response["final_amount"] = $row["bm_finaltotal"];
		$response["bm_transactionamount"] = $row["bm_transactionamount"];
    }
	$response["success"] = 1;
    echo json_encode($response);
	
} else {
    // no products found
    $response["success"] = 0;
    $response["message"] = "No discounts found";
    echo json_encode($response);
	}
}

else if($check== 'bill_reprint')
{
	$bill_num = $_GET['bill_num'];
	$branchid = $_GET['branchid'];
	
	 require_once("printer_functions.php");
	  $printpage=new PrinterCommonSettings(); 
	  $prtck=$printpage->print_bill($bill_num,$branchid,"android");
	  echo $prtck;
	  
	$response["success"] = 1;
    echo json_encode($response);
	
}

else if($check == 'change_status')
{
	
	$billnum = $_GET['billnum'];

	//`tbl_tabledetails`(`ts_tableid`, `ts_tableidprefix`, `ts_status`, `ts_dineintime`, `ts_noofpersons`, `ts_orderno`)
	$result = mysqli_query($localhost,"UPDATE `tbl_tablebillmaster` SET `bm_status`='Cancelled' where `bm_billno` = '".$billnum."'");
	if($result)
	{
		 $response["success"] = 1;
    	echo json_encode($response);
	}else
	{
		$response["success"] = 0;
    	echo json_encode($response);
	}
}


else if($check== 'bill_master_details')
{
	$bill_num = $_GET['billnum'];
	
	$sql = "select m.*,f.fr_floorname FROM tbl_tablebillmaster m left join tbl_floormaster f on f.fr_floorid=m.bm_floorid where bm_billno='".$bill_num."'";
	
	//echo $sql;
	$result = mysqli_query($localhost,$sql);
	
	if (mysqli_num_rows($result) > 0) {
    // looping through all results
    while ($row = mysqli_fetch_array($result)) {
        // temp user array
		$response["table_num_txt"] = $row["bm_tableno"];   	
		$response["status_txt"] = $row["bm_status"];	
		$response["bill_no_txt"] = $row["bm_billno"];
		$response["date_entered_txt"] = $row["bm_billdate"];
		
		$response["entered_time_txt"] = $row["bm_billtime"];   	
		$response["sub_total_txt"] = $row["bm_subtotal"];	
		$response["tot_pax_txt"] = $row["bm_totalpax"];
		$response["cancel_amnt_txt"] = '';
		
		$response["srvc_chrg_txt"] = '';;   	
		$response["srvc_tax_txt"] = '';	
		$response["vat_txt"] = '';
		$response["discnt_val_txt"] = $row["bm_discountvalue"];
		
		$response["final_tot_txt"] = $row["bm_finaltotal"];   	
		$response["last_print_txt"] = $row["bm_lastprintime"];	
		$response["printed_txt"] = $row["bm_billprinted"];
		$response["floo_id_txt"] = $row["fr_floorname"];
		
		$response["day_close_txt"] = $row["bm_dayclosedate"];   	
		$response["order_number_txt"] = $row["bm_orderno"];	
		
		
    }
	$response["success"] = 1;
    echo json_encode($response);
	
} else {
    // no products found
    $response["success"] = 0;
    $response["message"] = "No discounts found";
    echo json_encode($response);
	}
}

else if($check== 'kot_values_bill')
{
	$ordernum = $_GET['bill_num'];
	
	
	$sql = "select ter_kotno from tbl_tableorder where ter_orderno ='".$ordernum."' group by ter_kotno";
	$result = mysqli_query($localhost,$sql);
	
	if (mysqli_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["kotlist"] = array();
	
    while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $submenu = array();
        $submenu["kot"] = $row["ter_kotno"];	
        array_push($response["kotlist"], $submenu);
    }
  // success
   $response["message"] = "Y";
    $response["success"] = 0;
    // echoing JSON response
    echo json_encode($response);
} else {
    // no products found
    $response["success"] = 1;
    $response["message"] = "No discounts found";
    echo json_encode($response);
	}
}


else if($check=='insert_combo'){


	$ordernum = $_GET['ordernum'];
	$combo_id = $_GET['cod_id'];
		$combo_pack_id = $_GET['combo_pack_id'];
	$combo_qty = $_GET['combo_qty'];
	$combo_pack_rate = $_GET['combo_pack_rate'];
	$combo_total_rate = $_GET['combo_total_rate'];
	$combo_menu_id = $_GET['combo_menu_id'];
	$combo_menu_qty = $_GET['combo_menu_qty'];
    $slno = $_GET['slno'];
	$slno = "3";


	$floor_id = $_GET['floor_id'];
	$steward = $_GET['steward'];
	$user_id = $_GET['user_id'];
	$date = $_GET['date'];
	$combo_order_status = "Added";
	
	$textselectedpref=$_GET['pref'];
	$kotcounter=NULL;
	$max_ordering_count=1;




	mysqli_query($localhost,"SET @orderid = " . "'" . $ordernum . "'");
	mysqli_query($localhost,"SET @cod_id = " . "'" . $combo_id . "'");
	mysqli_query($localhost,"SET @combo_pack_id = " . "'" . $combo_pack_id . "'");
	mysqli_query($localhost,"SET @combo_qty = " . "'" . $combo_qty . "'");
	mysqli_query($localhost,"SET @combo_pack_rate = " . "'" . $combo_pack_rate . "'");
	mysqli_query($localhost,"SET @combo_total_rate = " . "'" . $combo_total_rate . "'");
	mysqli_query($localhost,"SET @combo_menu_id = " . "'" . $combo_menu_id . "'");
	mysqli_query($localhost,"SET @combo_menu_qty = " . "'" . $combo_menu_qty . "'");
	mysqli_query($localhost,"SET @slno = " . "'" . $slno . "'");
	mysqli_query($localhost,"SET @floor_id = " . "'" . $floor_id . "'");
	mysqli_query($localhost,"SET @steward = " . "'" . $steward . "'");
	mysqli_query($localhost,"SET @user_id = " . "'" . $user_id . "'");
	mysqli_query($localhost,"SET @pref = " . "'" . $textselectedpref . "'");
	mysqli_query($localhost,"SET @dc_date = " . "'" . $date . "'");




	$result=mysqli_query($localhost,"CALL 	proc_comboentry (@orderid,@cod_id,@combo_pack_id,@combo_qty,@combo_pack_rate,@combo_total_rate,@combo_menu_id,@combo_menu_qty,@slno,@floor_id,@steward,@user_id,@pref,@dc_date)") or throw_ex(mysqli_error($localhost));


			

 		 		$response["success"] = 1;
				$response["message"] = "success";
			 	echo json_encode($response);


}

else if($check == 'new_insertdb')
{

	$ter_combo = $_GET['ter_combo'];
	$s_ordernum = $_GET['ordernum'];
	$s_branch = $_GET['branchid'];
	$s_menuid = $_GET['menuid'];
	$s_portion = $_GET['portionid'];
	$s_quantity = $_GET['quantity'];
	$s_status = $_GET['status'];
	$s_orderfrom = $_GET['orderfrom'];
	$s_entryuser = $_GET['entryuser'];
	$s_esttime = $_GET['estimate_time'];
	$s_staff = $_GET['staffid'];
	$s_type = $_GET['type'];
	$s_floor = $_GET['floor'];
	$s_rate = $_GET['rate'];
	
	$s_preferencedrp = $_GET['prefid'];
	$s_preftext = $_GET['preftext'];
	$s_date = $_GET['date'];
	$s_unit_type = $_GET['unit_type'] ;
		// $s_preftext = $_GET['confirm_values'];
		
		// $obj = json_decode($jsonInput);
		// for($c=0;$c<count($obj);$c++)


	if ($ter_combo=='N') {
		
	

	$cur=date("Y-m-d");	
	if ($s_unit_type=="") {
		$unit_id = 0;
		$base_unit_id = 0;
		$rate_type = "Portion";
		$unit_type = NULL;
		$unit_weight = 0;
		$sql = "SELECT * FROM tbl_menustock WHERE mk_menuid = '".$s_menuid."'  AND mk_date = '".$s_date."' and mk_portion='".$s_portion."'";

	}
	else if ($s_unit_type=="Loose") {
		$unit_id = 0;
		$base_unit_id = $_GET['base_unit_id'];
		$rate_type = "Unit";
		$unit_type = "Loose";
		$unit_weight = $_GET['unit_weight'];
		$s_portion = 0;
		$sql = "SELECT * FROM tbl_menustock WHERE mk_menuid = '".$s_menuid."'  AND mk_date = '".$s_date."' AND mk_base_unit_id='".$base_unit_id."'";

	}
	else if ($s_unit_type=="Packet") {
		$unit_id = $_GET['unit_id'];
		$base_unit_id = 0;
		$rate_type = "Unit";
		$unit_type = "Packet";
		$unit_weight = $_GET['unit_weight'];
		$s_portion = 0;
		 $sql = "SELECT * FROM tbl_menustock WHERE mk_menuid = '".$s_menuid."'  AND mk_date = '".$s_date."' and mk_unit_weight='".$unit_weight."' AND mk_unit_id='".$unit_id."'";
	}



	
	




	
	
	
		
	

	
	//echo $sql;	
	$result = mysqli_query($localhost,$sql);
	
	if(mysqli_num_rows($result)>0)
	{

		 while ($row = mysqli_fetch_array($result)) 
		 {

			 $value = $row["mk_stock"];
			 if($value=='Y')
			 {
 				 $result1='';
				if($s_preftext=="")
				{
					$s_preftext=NULL;
				}
				if($s_preferencedrp=="")
				{
					$s_preferencedrp=NULL;
				}
				
				mysqli_query($localhost,"SET @temporderno = " . "'" . $s_ordernum . "'");
				mysqli_query($localhost,"SET @branchid = " . "'" . $s_branch . "'");
				mysqli_query($localhost,"SET @menuid = " . "'" . $s_menuid . "'");
				mysqli_query($localhost,"SET @rate_type = " . "'" . $rate_type . "'");
				mysqli_query($localhost,"SET @portion = " . "'" . $s_portion . "'");
				mysqli_query($localhost,"SET @unit_type = " . "'" . $unit_type . "'");
				mysqli_query($localhost,"SET @unit_weight = " . "'" . $unit_weight . "'");
				mysqli_query($localhost,"SET @unit_id = " . "'" . $unit_id . "'");
				mysqli_query($localhost,"SET @base_unit_id = " . "'" . $base_unit_id . "'");	
				mysqli_query($localhost,"SET @qty = " . "'" . $s_quantity . "'");
				mysqli_query($localhost,"SET @status = " . "'" . $s_status . "'");
				mysqli_query($localhost,"SET @orderfrom = " . "'" . $s_orderfrom . "'");
				mysqli_query($localhost,"SET @entryuser = " . "'" . $s_entryuser . "'");
				mysqli_query($localhost,"SET @est_time = " . "'" . $s_esttime . "'");
				mysqli_query($localhost,"SET @staff = " . "'" . $s_staff . "'");
				mysqli_query($localhost,"SET @type = " . "'" . $s_type . "'");
				mysqli_query($localhost,"SET @floorid = " . "'" . $s_floor . "'");
				mysqli_query($localhost,"SET @manual_rate = " . "'" . $s_rate . "'");
				mysqli_query($localhost,"SET @preferencetext = " . "'".$s_preftext."'");
				mysqli_query($localhost,"SET @addon_slno= " . "''");
				
					       /* echo $s_ordernum .','.$s_branch .',' . $s_menuid . ','.$rate_type . ','.$s_portion . ','.$unit_type .','.$unit_weight . ','.$unit_id . 
				','.$base_unit_id . 	
				','. $s_quantity . 	
				','.$s_status . 
				','.$s_orderfrom . 
				','.$s_entryuser . 
				','.$s_esttime . 
				','.$s_staff .
				','.$s_type . 
				','.$s_floor . 
				','.$s_rate .
				','.$s_preftext;*/
				
						
				$messsage='';
				 $returnmsg='';
				$s='';  

				try
				{

					$result1=mysqli_query($localhost,"CALL proc_tableordernentry(@temporderno,@branchid,@menuid,@rate_type,@portion,@unit_type ,
					@unit_weight ,@unit_id ,@base_unit_id ,@qty,@status,@orderfrom,
					@entryuser,@est_time,@staff,@type,@floorid,@manual_rate,@preferencetext,@addon_slno,@messsage)") or throw_ex(mysqli_error($localhost)) ;
				$rs = mysqli_query($localhost, 'SELECT @messsage AS messsage' );
				$s = "Proc no entry";

                                
                                
        $sql_desg_nos="select be_incl_bill_format from tbl_branchmaster ";
	$sql_desg  =  mysqli_query($localhost,$sql_desg_nos); 
	$num_desg  = mysqli_num_rows($sql_desg);
	if($num_desg)
	{$i=0;
		while($result_desg  = mysqli_fetch_array($sql_desg)) 
			{
				
				$incl_bill_format=$result_desg['be_incl_bill_format'];
				
			}
	}              
                                
                                
            if($incl_bill_format=='Y'){ 
            
            if($s_portion !=0){
                
                 $sql_menuaddon="select mmr_menu_final_amount,mmr_rate FROM  tbl_menuratemaster  where  "
                 . " mmr_menuid='".$s_menuid."' and mmr_portion='".$s_portion."'   ";
         
            }else{
                
                if($unit_id!=0){
                
                    $sql_menuaddon="select mmr_menu_final_amount,mmr_rate FROM  tbl_menuratemaster  where "
                    . " mmr_menuid='".$s_menuid."' and mmr_unit_weight='".$unit_weight."'"
                    . " and mmr_unit_id='".$unit_id."' ";
                }
                
                if($base_unit_id !=0){
                    
                   $sql_menuaddon="select mmr_menu_final_amount,mmr_rate FROM  tbl_menuratemaster  where  mmr_menuid='".$s_menuid."'"
                   . " and mmr_base_unit_id='".$base_unit_id."'  ";
                   
                }
                
            }
            
            
            
            $new_rate=0;
            $sql_menuaddon1  =  mysqli_query($localhost,$sql_menuaddon); 
            $num_menuaddon  = mysqli_num_rows($sql_menuaddon1);
            if($num_menuaddon){
                while($result_format  = mysqli_fetch_array($sql_menuaddon1)) 
                {
                    
                    if($result_format['mmr_menu_final_amount']>0 && $result_format['mmr_menu_final_amount']!=''){
                        
                        $new_rate=$result_format['mmr_menu_final_amount'];
                        
                    }else{
                        
                        $new_rate=$result_format['mmr_rate'];
                    }
                    
                    
               if($s_portion !=0){
                
                  $sql_update_subtotal=mysqli_query($localhost," update tbl_tableorder set ter_new_rate_incl='".$new_rate."'"
                  . " where `ter_orderno`='".$s_ordernum."' and ter_menuid='".$s_menuid."'"
                  . " and ter_portion='".$s_portion."'  ");     
          
               }else{
                
                if($unit_id!=0){
                
                   $sql_update_subtotal=mysqli_query($localhost," update tbl_tableorder set ter_new_rate_incl='".$new_rate."' where "
                   . " `ter_orderno`='".$s_ordernum."' and ter_menuid='".$s_menuid."' and "
                   . " ter_unit_weight='".$unit_weight."'  and ter_unit_id='".$unit_id."'  ");     
                }
                
                if($base_unit_id !=0){
                    
                  $sql_update_subtotal=mysqli_query($localhost," update tbl_tableorder set ter_new_rate_incl='".($new_rate*$unit_weight)."' "
                  . " where `ter_orderno`='".$s_ordernum."' and ter_menuid='".$s_menuid."' and"
                  . " ter_unit_weight='".$unit_weight."'  and ter_base_unit_id='".$base_unit_id."'  ");     
                   
                }
               
            }
               
        }
        }  
        
  }
                                
                                

				while($row = mysqli_fetch_array($rs))
				{

					$s= $row['messsage'];

				}
				         $response["success"] = 1;
					 $response["message"] = $s;
					 echo json_encode($response);
					
				}catch (Exception $e) {
				  $returnmsg= 'Caught exception: '.  $e;
				  $file = 'log.txt';
				  $content = date("l F d-m-Y h:i:s A")." ".$returnmsg.PHP_EOL;
				  file_put_contents($file, $content, FILE_APPEND | LOCK_EX);
				   //echo   $returnmsg;exit();
				   $s = "Proc no entry";
				   $response["success"] = 2;
					$response["message"] = $s;
					//$response["error_num"] = mysqli_errno();
					
					
					echo json_encode($response);
			  }
			  
			 }
			 else if($value=='N')
			 {
				$response["success"] = 0;
				$response["message"] = "No Stock";
				echo json_encode($response);		 
			 } 
		 }
	}
	}else{
					$response["success"] = 1;
					 $response["message"] = 'Combo Added';
					 echo json_encode($response);
	} 		
}


else if($check == 'temp_insert')
{
	$s_ordernum = $_GET['ordernum'];
	$s_branch = $_GET['branchid'];
	$s_menuid = $_GET['menuid'];
	$s_portion = $_GET['portionid'];
	$s_quantity = $_GET['quantity'];
	$s_status = $_GET['status'];
	$s_orderfrom = $_GET['orderfrom'];
	$s_entryuser = $_GET['entryuser'];
	$s_esttime = $_GET['estimate_time'];
	$s_staff = $_GET['staffid'];
	$s_type = $_GET['type'];
	$s_floor = $_GET['floor'];
	$s_rate = $_GET['rate'];
	$s_preferencedrp = $_GET['prefid'];
	$s_preftext = $_GET['preftext'];
	$s_date = $_GET['date'];
	
	$cur=date("Y-m-d");	
					
	$sql = "SELECT * FROM tbl_menustock WHERE mk_menuid = '".$s_menuid."'  AND mk_date = '".$s_date."'";	
	$result = mysqli_query($localhost,$sql);
	if(mysqli_num_rows($result)>0)
	{
		 while ($row = mysqli_fetch_array($result)) 
		 {
			 $value = $row["mk_stock"];
			 if($value=='Y')
			 {
 				 $result1='';
				if($s_preftext=="")
				{
					$s_preftext=NULL;
				}
				if($s_preferencedrp=="")
				{
					$s_preferencedrp=NULL;
				}
				$sql = "INSERT INTO `temp_app_orderentry`(`temporderno`, `branchid`, `menuid`, `portion`, `qty`, `status`, `orderfrom`, `entryuser`, `est_time`, `staff`, `type`, `floorid`, `manual_rate`, `preferenceid`, `preferencetext`) VALUES ('" . $s_ordernum . "','" . $s_branch . "','" . $s_menuid . "','" . $s_portion . "','" . $s_quantity . "','" . $s_status . "','" . $s_orderfrom . "','" . $s_entryuser . "','" . $s_esttime . "','" . $s_staff . "','" . $s_type . "','" . $s_floor . "','" . $s_rate . "','" . $s_preferencedrp . "','" . $s_preftext . "')";
				
				
				$result4 = mysqli_query($localhost,$sql);
				
				 $response["success"] = 1;
				 $response["message"] = "Inserted";
				 echo json_encode($response);	 
			 }
			 else if($value=='N')
			 {
				$response["success"] = 0;
				$response["message"] = "No Stock";
				echo json_encode($response);		 
			 } 
		 }
	} 		
}


else if($check== 'temp_proccall')
{
	$ordernum = $_GET['ordernum'];
	
	mysqli_query($localhost,"SET @temporderno_in = " . "'" . $ordernum . "'");
	$messsage='';
	
	
	
	try{
		$result1=mysqli_query($localhost,"CALL proc_app_orderentry(@temporderno_in)")or throw_ex(mysqli_error($localhost)) ;
				/*$rs = mysqli_query($localhost, 'SELECT @messsage AS messsage' );
				while($row = mysqli_fetch_array($rs))
				{
					$s= $row['messsage'];
				}*/
	
				if ($result1) 
				{
				$response["message"] = "OK";
				$response["success"] = 1;
				// echoing JSON response
				echo json_encode($response);
				}
		
	}catch (Exception $e) {
						  $returnmsg= 'Caught exception: '.  $e;
						  $file = 'log.txt';
						  $content = date("l F d-m-Y h:i:s A")." ".$returnmsg.PHP_EOL;
						  file_put_contents($file, $content, FILE_APPEND | LOCK_EX);
						   //echo   $returnmsg;exit();
						  $response["success"] = 0;
					 		 $response["message"] = "Failed to Insert";
					 		 echo json_encode($response);
			 			 }
	
}


else if($check == 'counter_temp_insert')
{
	$menuid = $_GET['menuid'];
	$ordernum = $_GET['ordernum'];
	$portion = $_GET['portion'];
	$prefernce = $_GET['prefernce'];
	$rate = $_GET['rate'];
	$branchid = $_GET['branchid'];
	$qty = $_GET['qty'];
	$mode = $_GET['mode'];
	
	
	$sql = "INSERT INTO `temp_app_orderentry`(`temporderno`, `branchid`, `menuid`, `portion`, `qty`, `manual_rate`, `preferencetext`, `mode_in_ta`) VALUES ('".$ordernum."','".$branchid."','".$menuid."','".$portion."','".$qty."','".$rate."','".$prefernce."','".$mode."')";
				
				
	$result4 = mysqli_query($localhost,$sql);
	if($result4)
	{			
		$response["success"] = 1;
		$response["message"] = "Inserted";
		echo json_encode($response);	 
	}
	else if($value=='N')
	{
		$response["success"] = 0;
		$response["message"] = "No Stock";
		echo json_encode($response);		 
	} 		
}

else if($check== 'temp_proccall_counter')
{
	$ordernum = $_GET['ordernum'];
	
	mysqli_query($localhost,"SET @temporderno_in = " . "'" . $ordernum . "'");
	$messsage='';
	
	$result1=mysqli_query($localhost,"CALL proc_app_ta_orderentry(@temporderno_in,@message)") ;
				$rs = mysqli_query($localhost, 'SELECT @message AS messsage' );
				while($row = mysqli_fetch_array($rs))
				{
					$s= $row['messsage'];
				}
	
	if ($result1) 
	{
    $response["message"] = $s;
    $response["success"] = 1;
    // echoing JSON response
    echo json_encode($response);
} else {
    // no products found
    $response["success"] = 0;
    $response["message"] = "No discounts found";
    echo json_encode($response);
	}
}

else if($check == 'live_insert')
{
	$s_ordernum = $_GET['ordernum'];
	$s_branch = $_GET['branchid'];
	$s_menuid = $_GET['menuid'];
	$s_portion = $_GET['protionid'];
	$s_quantity = $_GET['quantity'];
	$s_status = $_GET['status'];
	$s_orderfrom = $_GET['orderfrom'];
	$s_entryuser = $_GET['entryuser'];
	$s_esttime = $_GET['esttime'];
	$s_staff = $_GET['staffid'];
	$s_type = $_GET['type'];
	$s_floor = $_GET['floorid'];
	$s_rate = $_GET['rate'];
	$s_preferencedrp = $_GET['prefernceid'];
	$s_preftext = $_GET['preferetext'];
	
					
	$result1='';
    if($s_preftext=="")
    {
        $s_preftext=NULL;
    }
    if($s_preferencedrp=="")
    {
        $s_preferencedrp=NULL;
    }
    
    mysqli_query($localhost,"SET @temporderno = " . "'" . $s_ordernum . "'");
    mysqli_query($localhost,"SET @branchid = " . "'" . $s_branch . "'");
    mysqli_query($localhost,"SET @menuid = " . "'" . $s_menuid . "'");
    mysqli_query($localhost,"SET @portion = " . "'" . $s_portion . "'");
    mysqli_query($localhost,"SET @qty = " . "'" . $s_quantity . "'");
    mysqli_query($localhost,"SET @status = " . "'" . $s_status . "'");
    mysqli_query($localhost,"SET @orderfrom = " . "'" . $s_orderfrom . "'");
    mysqli_query($localhost,"SET @entryuser = " . "'" . $s_entryuser . "'");
    mysqli_query($localhost,"SET @est_time = " . "'" . $s_esttime . "'");
    mysqli_query($localhost,"SET @staff = " . "'" . $s_staff . "'");
    mysqli_query($localhost,"SET @type = " . "'" . $s_type . "'");
    mysqli_query($localhost,"SET @floorid = " . "'" . $s_floor . "'");
    mysqli_query($localhost,"SET @manual_rate = " . "'" . $s_rate . "'");
    mysqli_query($localhost,"SET @preferenceid = " . "'".$s_preferencedrp."'");
    mysqli_query($localhost,"SET @preferencetext = " . "'".$s_preftext."'");
	mysqli_query($localhost,"SET @addon_slno= " . "''");        
    $messsage='';
     $returnmsg='';
    $s='';  

      try
      {
          $result1=mysqli_query($localhost,"CALL proc_tableordernentry(@temporderno,@branchid,@menuid,@portion,@qty,@status,@orderfrom,@entryuser,@est_time,@staff,@type,@floorid,@manual_rate,@preferenceid,@preferencetext,@addon_slno,@messsage)") or throw_ex(mysqli_error($localhost)) ;
      $rs = mysqli_query($localhost, 'SELECT @messsage AS messsage' );
      $s = "Proc no entry";
      while($row = mysqli_fetch_array($rs))
      {
          $s= $row['messsage'];
      }
      
      
      
      
      
      
	  
	  if (strpos($s_ordernum, 'TEMP') !== false)
	  {
		  $sql = "select ter_orderno from tbl_tableorder where ter_orderno_temp='". $s_ordernum."'";
		  $result = mysqli_query($localhost,$sql);
		
		if (mysqli_num_rows($result) > 0) {
	
			while ($row = mysqli_fetch_array($result)) {	 
				$new_ordernum = $row["ter_orderno"];	
				}
			}
	  }
	  else
	  {
		  $new_ordernum = $s_ordernum;
	  }
	  
       $response["success"] = 1;
           $response["message"] = $s;
		   $response["ordernum"]= $new_ordernum;
		   
           echo json_encode($response);
          
      }catch (Exception $e) {
        $returnmsg= 'Caught exception: '.  $e;
        $file = 'log.txt';
        $content = date("l F d-m-Y h:i:s A")." ".$returnmsg.PHP_EOL;
        file_put_contents($file, $content, FILE_APPEND | LOCK_EX);
         //echo   $returnmsg;exit();
         $s = "Proc no entry";
         $response["success"] = 2;
          $response["message"] = $s;
         echo json_encode($response);
    }
}


else if($check == "cartcount")
{
	
	$s_ordernum = $_GET['ordernum'];
	$s_branch = $_GET['branchid'];
	$result = mysqli_query($localhost,"SELECT count(*) as lenght FROM `tbl_tableorder` WHERE `ter_orderno`='".$s_ordernum."' and `ter_branchid`='".$s_branch."' and ter_status= 'Added'");
//and tr_tableid NOT IN(select ts_tableid from tbl_tabledetails)
//$result = mysqli_num_rows($getFloor);
$s = 0;
 if (mysqli_num_rows($result) > 0) {
   
    while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $s= $row["lenght"];
		
    }
    // success
    $response["success"] = 1;
 	$response["message"] = "found";
	$response["cartlength"] = $s;
    // echoing JSON response
    echo json_encode($response);
} else {
    // no products found
    $response["success"] = 0;
    $response["message"] = "No products found";
	$response["cartlength"] = $s;
    // echo no users JSON
    echo json_encode($response);
}

}

else if($check=='getcartvalues')
{
	$s_ordernum = $_GET['ordernum'];
	$s_branch = $_GET['branchid'];
	$status = $_GET['status'];
	
	$sql="SELECT to1.ter_orderno as orderno,to1.ter_esttime as time, to1.ter_slno as sl, to1.ter_branchid as br_id,to1.ter_menuid as menuid,
mm.mr_menuname as menuname,pm.pm_id as portion_id,pm.pm_portionname as portionname,to1.ter_qty as qty, to1.ter_rate as rate, 
to1.ter_preference as prefid, mm.mr_manualrateentry as dynamcitype, prefm.pmr_name as preference_dr,to1.ter_preferencetext as pref_name,
to1.ter_type as type 
FROM tbl_tableorder to1
left join tbl_portionmaster as pm on pm.pm_id = to1.ter_portion 
left join tbl_preferencemaster as prefm on prefm.pmr_id = to1.ter_preference 
left join tbl_menumaster as mm on mm.mr_menuid=to1.ter_menuid  
WHERE to1.ter_orderno='".$s_ordernum."' and to1.ter_branchid='".$s_branch."' and to1.ter_status='".$status."' 
group by to1.ter_orderno,to1.ter_slno,to1.ter_branchid,to1.ter_menuid,pm.pm_portionname,to1.ter_type";
	
	
	$result = mysqli_query($localhost,$sql);
	if(mysqli_num_rows($result) > 0)
	{
		$response["cart_values"] = array();
		
		while ($row = mysqli_fetch_array($result)) {
			// temp user array
			$table = array();
			$table["orderno"] = $row["orderno"];
			$table["time"] = $row["time"];
			$table["sl"] = $row["sl"];
			$table["br_id"] = $row["br_id"];
			$table["menuid"] = $row["menuid"];
			$table["menuname"] = $row["menuname"];
			$table["portion_id"] = $row["portion_id"];
			$table["portionname"] = $row["portionname"];
			
			$table["qty"] = $row["qty"];
			$table["rate"] = $row["rate"];
			$table["prefid"] = $row["prefid"];
			$table["preference_dr"] = $row["preference_dr"];
			$table["pref_name"] = $row["pref_name"];
			$table["type"] = $row["type"];
			$table["dynamcitype"] = $row["dynamcitype"];
			
			// push single product into final response array
			array_push($response["cart_values"], $table);
		}
		// success
		$response["success"] = 1;
		$response["message"] = "found";
		// echoing JSON response
		echo json_encode($response);
	} else {
		// no products found
		$response["success"] = 0;
		$response["message"] = "No products found";
	
		// echo no users JSON
		echo json_encode($response);
	}
}

else if($check=="deleteitem")
{
	$serial = $_GET['serialnum'];
	$ordernum = $_GET['ordernum'];
	
	$sql = "DELETE FROM `tbl_tableorder` WHERE `ter_orderno`='".$ordernum."' and `ter_slno`='".$serial."'";
	$result = mysqli_query($localhost,$sql);
	if($result)
	{
		$response["success"] = 1;
		$response["message"] = "Item Removed";
		// echoing JSON response
		echo json_encode($response);
	}
	else
	{
		$response["success"] = 0;
		$response["message"] = "Failed to remove the item";
		// echoing JSON response
		echo json_encode($response);
	}
}


else if($check == 'editcart')
{
	$prefid = $_GET['prefid'];
	$quantity = $_GET['quantity'];
	$rate = $_GET['rate'];
	$pref_text = $_GET['pref_text'];
	$ordernum = $_GET['ordernum'];
	$serial = $_GET['serial'];
	
	
					
	$result1='';
    if($pref_text=="")
    {
        $pref_text=NULL;
    }
    if($prefid=="")
    {
        $prefid=NULL;
    }
    
    mysqli_query($localhost,"SET @orderno = " . "'" . $ordernum . "'");
    mysqli_query($localhost,"SET @slno = " . "'" . $serial . "'");
    mysqli_query($localhost,"SET @qty = " . "'" . $quantity . "'");
    mysqli_query($localhost,"SET @pref = " . "'" . $prefid . "'");
    mysqli_query($localhost,"SET @pref_text = " . "'" . $pref_text . "'");
    mysqli_query($localhost,"SET @rate = " . "'" . $rate . "'");
    
  
    $s='';  

      try
      {
          $result1=mysqli_query($localhost,"CALL proc_tableorderedit(@orderno,@slno,@qty,@pref,@pref_text,@rate)") or throw_ex(mysqli_error($localhost)) ;
      
       $response["success"] = 1;
           $response["message"] = "Updated";
           echo json_encode($response);
          
      }catch (Exception $e) {
        $returnmsg= 'Caught exception: '.  $e;
        $file = 'log.txt';
        $content = date("l F d-m-Y h:i:s A")." ".$returnmsg.PHP_EOL;
        file_put_contents($file, $content, FILE_APPEND | LOCK_EX);
         //echo   $returnmsg;exit();
         $s = "Failed to update";
         $response["success"] = 0;
          $response["message"] = $s;
         echo json_encode($response);
    }
}

else if($check=="changetable_temp")
{
	$ordernum = $_GET['ordernum'];
	
	
	$sql = "select * FROM `tbl_tableorder` WHERE `ter_orderno`='".$ordernum."' and ter_orderfrom='Android_Interface'";
	$result = mysqli_query($localhost,$sql);
	
	if(mysqli_num_rows($result) > 0)
	{
		$response["success"] = 1;
		// echoing JSON response
		echo json_encode($response);
	}
	else
	{
		$response["success"] = 0;
		echo json_encode($response);
	}
}

else if($check=="check_count")
{
	$ordernum = $_GET['ordernum'];
	
	
	$sql = "SELECT count(*) as leng FROM `tbl_tableorder` WHERE `ter_orderno`='".$ordernum."' and `ter_orderfrom`='Android_Interface' and `ter_status`='Added' and `ter_cancel`<>'Y'";
	$result = mysqli_query($localhost,$sql);
	
	if(mysqli_num_rows($result) > 0)
	{
		while ($row = mysqli_fetch_array($result)) 
		{
        	$s= $row["leng"];	
    	}
		$response["success"] = 1;
		$response["message"] = $s;
		// echoing JSON response
		echo json_encode($response);
	}
	else
	{
		$response["success"] = 0;
		echo json_encode($response);
	}
}



else if($check=="kodview")
{
	$branchid = $_GET['branchid'];
	
	$sql = "SELECT be_kod_takeaway,be_kod_dinein FROM `tbl_branchmaster` WHERE `be_branchid`='".$branchid."'";
	$result = mysqli_query($localhost,$sql);
	
	if(mysqli_num_rows($result) > 0)
	{
		while ($row = mysqli_fetch_array($result)) 
		{
        	$takeaway_nav= $row["be_kod_takeaway"];	
			$dine_nav= $row["be_kod_dinein"];	
    	}
		$response["success"] = 1;
		$response["takeaway_nav"] = $takeaway_nav;
		$response["dine_nav"] = $dine_nav;
		// echoing JSON response
		echo json_encode($response);
	}
	else
	{
		$response["success"] = 0;
		echo json_encode($response);
	}
}	

else if ($check == "dine_kot_details_new") 
{

	$counterid = $_GET['counter_id'];	
	$sql = '';
	$countervalues = '';

	if(($counterid=="") || ($counterid==NULL))
	{
		$sql = "SELECT m.mr_kotcounter,t.ter_slno,t.ter_orderno,t.ter_kotno,m.mr_menuname,t.ter_entrytime,t.ter_qty,t.ter_status,p.pm_portionshortcode,t.ter_preferencetext,pr.pmr_name,concat(tm.tr_tableno,concat('(',concat(b.ts_tableidprefix,')'))) as tableid  FROM `tbl_tableorder` t left join tbl_menumaster m on m.mr_menuid=t.ter_menuid left join tbl_portionmaster p on p.pm_id=t.ter_portion left join tbl_preferencemaster pr on pr.pmr_id=t.ter_preference left join tbl_tabledetails b on b.ts_orderno=t.ter_orderno left join tbl_tablemaster tm on tm.tr_tableid=b.ts_tableid WHERE (t.ter_status = 'Opened' or t.ter_status = 'Ready') order by t.ter_entrytime DESC";
	}
	else
	{
		$sql = "SELECT m.mr_kotcounter,t.ter_slno,t.ter_orderno,t.ter_kotno,m.mr_menuname,t.ter_entrytime,t.ter_qty,t.ter_status,p.pm_portionshortcode,t.ter_preferencetext,pr.pmr_name,concat(tm.tr_tableno,concat('(',concat(b.ts_tableidprefix,')'))) as tableid  FROM `tbl_tableorder` t left join tbl_menumaster m on m.mr_menuid=t.ter_menuid left join tbl_portionmaster p on p.pm_id=t.ter_portion left join tbl_preferencemaster pr on pr.pmr_id=t.ter_preference left join tbl_tabledetails b on b.ts_orderno=t.ter_orderno left join tbl_tablemaster tm on tm.tr_tableid=b.ts_tableid WHERE (t.ter_status = 'Opened' or t.ter_status = 'Ready') and ";
		
		$splitedValues = explode(",",$counterid);
		$len = count($splitedValues);
		$countervalues = "(m.mr_kotcounter="."'".$splitedValues[0]."'";
		
		for($i=1;$i<$len;$i++)
		{
			$countervalues = $countervalues." or m.mr_kotcounter="."'".$splitedValues[$i]."'";
		}
		  
		$countervalues = $countervalues.")";
		
		$sql = $sql.$countervalues." order by t.ter_entrytime DESC";

		
	}
	
}



else if($check == "dine_kot_details")
{
	$counterid = $_GET['counter_id'];	
	$sql = '';
	$countervalues = '';
	
	if(($counterid=="") || ($counterid==NULL))
	{
		$sql = "SELECT m.mr_kotcounter,t.ter_slno,t.ter_orderno,t.ter_kotno,m.mr_menuname,t.ter_entrytime,t.ter_qty,t.ter_status,p.pm_portionshortcode,t.ter_preferencetext,pr.pmr_name,concat(tm.tr_tableno,concat('(',concat(b.ts_tableidprefix,')'))) as tableid  FROM `tbl_tableorder` t left join tbl_menumaster m on m.mr_menuid=t.ter_menuid left join tbl_portionmaster p on p.pm_id=t.ter_portion left join tbl_preferencemaster pr on pr.pmr_id=t.ter_preference left join tbl_tabledetails b on b.ts_orderno=t.ter_orderno left join tbl_tablemaster tm on tm.tr_tableid=b.ts_tableid WHERE (t.ter_status = 'Opened' or t.ter_status = 'Ready') order by t.ter_entrytime DESC";
	}
	else
	{
		$sql = "SELECT m.mr_kotcounter,t.ter_slno,t.ter_orderno,t.ter_kotno,m.mr_menuname,t.ter_entrytime,t.ter_qty,t.ter_status,p.pm_portionshortcode,t.ter_preferencetext,pr.pmr_name,concat(tm.tr_tableno,concat('(',concat(b.ts_tableidprefix,')'))) as tableid  FROM `tbl_tableorder` t left join tbl_menumaster m on m.mr_menuid=t.ter_menuid left join tbl_portionmaster p on p.pm_id=t.ter_portion left join tbl_preferencemaster pr on pr.pmr_id=t.ter_preference left join tbl_tabledetails b on b.ts_orderno=t.ter_orderno left join tbl_tablemaster tm on tm.tr_tableid=b.ts_tableid WHERE (t.ter_status = 'Opened' or t.ter_status = 'Ready')";
		
		
		$splitedValues = explode(",",$counterid);
		$len = count($splitedValues);
		$countervalues = "(m.mr_kotcounter="."'".$splitedValues[0]."'";
		
		for($i=1;$i<$len;$i++)
		{
			$countervalues = $countervalues." or m.mr_kotcounter="."'".$splitedValues[$i]."'";
		}
		  
		$countervalues = $countervalues.")";
		
		//$sql = $sql.$countervalues." order by t.ter_entrytime DESC";
		$sql = $sql." order by t.ter_entrytime DESC,mr_kotcounter desc";

		
	}
	
	echo $sql;
	
	$result = mysqli_query($localhost,$sql);
	
	if(mysqli_num_rows($result)>0)
	{
		$response["ta_kot_details"] = array();
		while($row = mysqli_fetch_assoc($result))
		{
			$detail = array();
			$detail["sl_num"] = $row["ter_slno"];
			$detail["ter_orderno"] = $row["ter_orderno"];
			$detail["ter_kotno"] = $row["ter_kotno"];
			$detail["mr_menuname"] = $row["mr_menuname"];
			$detail["ter_entrytime"] = $row["ter_entrytime"];
			$detail["ter_qty"] = $row["ter_qty"];
			$detail["pm_portionname"] = $row["pm_portionshortcode"];
			$detail["tabel_name"] = $row["tableid"];
			$detail["mr_kotcounter"] = $row["mr_kotcounter"];
			$detail["selected_counter"] = "N";

			if ($detail["mr_kotcounter"]==$counterid ) {
				$detail["selected_counter"]="Y";
			}

			
			
			$preference = "";
			
			$s = $row["ter_preferencetext"];
			$s1= $row["pmr_name"];
			if(($s!=null) || ($s1!=null))
			{
				$preference = $s.$s1;
			}
			else if($s1==null)
			{
				if($s==null)
				{
					$preference = "";
				}
				else
				{
					$preference = $s;
				}
			}
			else
			{
				if($s1==null)
				{
					$preference = "";
				}
				else
				{
					$preference = $s1;
				}
			}
		
			$detail["preference"] = $preference;
			$detail["ter_status"] = $row["ter_status"];
			
			
		 	array_push($response["ta_kot_details"], $detail);
		}
		
		$response["message"] = "ok";
		$response["success"] = 1;
		echo json_encode($response);
	}
	else
	{
		$response["message"] = "fails";
		$response["success"] = 10;
		echo json_encode($response);
	}	
}
















else if($check == "dine_kod_details")
{
	$counterid = $_GET['counter_id'];	
	$sql = '';
	$countervalues = '';
	
	if(($counterid=="") || ($counterid==NULL))
	{
		$counterid="";
		$sql="SELECT DISTINCT (t.ter_kotno),t.ter_entrytime, concat(tm.tr_tableno,concat('(',concat(b.ts_tableidprefix,')'))) as tableid FROM tbl_tableorder t join tbl_menumaster m on m.mr_menuid=t.ter_menuid left join tbl_tabledetails b on b.ts_orderno=t.ter_orderno left join tbl_tablemaster tm on tm.tr_tableid=b.ts_tableid WHERE (t.ter_status = 'Opened' or t.ter_status = 'Ready') GROUP by t.ter_kotno order by t.ter_entrytime DESC";
		
	}
	else
	{
		$sql="SELECT DISTINCT (t.ter_kotno),t.ter_entrytime, concat(tm.tr_tableno,concat('(',concat(b.ts_tableidprefix,')'))) as tableid FROM tbl_tableorder t join tbl_menumaster m on m.mr_menuid=t.ter_menuid left join tbl_tabledetails b on b.ts_orderno=t.ter_orderno left join tbl_tablemaster tm on tm.tr_tableid=b.ts_tableid WHERE ( (t.ter_status = 'Opened' or t.ter_status = 'Ready') and";
		
		$splitedValues = explode(",",$counterid);
		$len = count($splitedValues);
		$countervalues = "(m.mr_kotcounter="."'".$splitedValues[0]."'";
		
		for($i=1;$i<$len;$i++)
		{
			$countervalues = $countervalues." or m.mr_kotcounter="."'".$splitedValues[$i]."'";
		}
		  
		$countervalues = $countervalues."))";
		$sql = $sql.$countervalues."GROUP by t.ter_kotno order by t.ter_entrytime DESC";


		
	}


	
	//echo $sql;
	
	$result = mysqli_query($localhost,$sql);
	
	if(mysqli_num_rows($result)>0)
	{
		$response["data"] = array();
		while($row = mysqli_fetch_assoc($result))
		{
			$detail = array();

			$detail["type"] = "DI";
			$detail["ter_kotno"] = $row["ter_kotno"];
			$detail["tablename"] = $row["tableid"];
			$detail["time"] = $row["ter_entrytime"];

			$kitchendata = array();

			/*$sql_new="select DISTINCT c.kr_kotname,m.mr_kotcounter from tbl_menumaster m JOIN tbl_tableorder t on m.mr_menuid=t.ter_menuid 
JOIN tbl_kotcountermaster c ON  m.mr_kotcounter=c.kr_kotcode
where t.ter_kotno="."'".$detail["ter_kotno"]."'";*/


		$sql_select="select DISTINCT c.kr_kotname,m.mr_kotcounter from tbl_menumaster m JOIN tbl_tableorder t on m.mr_menuid=t.ter_menuid 
		JOIN tbl_kotcountermaster c ON  m.mr_kotcounter=c.kr_kotcode
		where  (t.ter_status = 'Opened' or t.ter_status = 'Ready') and t.ter_kotno="."'".$detail["ter_kotno"]."' and";



			$splitedValues = explode(",",$counterid);
				$len = count($splitedValues);
				$countervalues = "(m.mr_kotcounter!="."'".$splitedValues[0]."'";
				
				for($i=1;$i<$len;$i++)
				{
					$countervalues = $countervalues." and m.mr_kotcounter!="."'".$splitedValues[$i]."'";
				}
				  
				$countervalues = $countervalues.")";
				$sql_select = $sql_select.$countervalues;

//*********************************************************************************************************

$result_new = mysqli_query($localhost,$sql_select);
				
				if(mysqli_num_rows($result_new)>0)
				{
					
					
					
					while($row_new= mysqli_fetch_assoc($result_new))
					{
						$temp = array();
						$temp["kitchenname"]=$row_new["kr_kotname"];
						$temp["mr_kotcounter"]=$row_new["mr_kotcounter"];
						$temp["selected"]=false;


								$sql_menu="SELECT t.ter_entrytime,m.mr_kotcounter,t.ter_slno,t.ter_orderno,t.ter_kotno,m.mr_menuname,t.ter_entrytime,t.ter_qty,t.ter_status,p.pm_portionshortcode,t.ter_preferencetext,pr.pmr_name FROM `tbl_tableorder` t left join tbl_menumaster m on m.mr_menuid=t.ter_menuid left join tbl_portionmaster p on p.pm_id=t.ter_portion left join tbl_preferencemaster pr on pr.pmr_id=t.ter_preference 
WHERE (t.ter_kotno='".$detail["ter_kotno"]."' and  m.mr_kotcounter='".$temp["mr_kotcounter"]."' and (t.ter_status = 'Opened' or t.ter_status = 'Ready') ) order by t.ter_entrytime DESC";


						

						$result_menu= mysqli_query($localhost,$sql_menu);
				
						if(mysqli_num_rows($result_menu)>0)
						{
							$menulist=array();
							while($row_menu= mysqli_fetch_assoc($result_menu))
							{

									$dish = array();

									$dish["sl_num"] = $row_menu["ter_slno"];
									$dish["ter_orderno"] = $row_menu["ter_orderno"];
									$dish["ter_kotno"] = $row_menu["ter_kotno"];
									$dish["mr_menuname"] = $row_menu["mr_menuname"];
									$dish["ter_qty"] = $row_menu["ter_qty"];
									$dish["pm_portionname"] = $row_menu["pm_portionshortcode"];

									if (($dish["pm_portionname"]==null) ||($dish["pm_portionname"]==NULL)){
										$dish["pm_portionname"] ="";
									}
									$dish["mr_kotcounter"] = $row_menu["mr_kotcounter"];
									$dish["ter_entrytime"] = $row_menu["ter_entrytime"];

									$dish["selected_counter"] = "N";

									/*if ($dish["mr_kotcounter"]==$counterid ) {
										$dish["selected_counter"]="Y";
									}*/


/*if(strpos($counterid, $dish["mr_kotcounter"]) !== false){
  $dish["selected_counter"]="Y";
} 
*/

									$preference = "";
			
										$s = $row_menu["ter_preferencetext"];
										$s1= $row_menu["pmr_name"];
										if(($s!=null) || ($s1!=null))
										{
											$preference = $s.$s1;
										}
										else if($s1==null)
										{
											if($s==null)
											{
												$preference = "";
											}
											else
											{
												$preference = $s;
											}
										}
										else
										{
											if($s1==null)
											{
												$preference = "";
											}
											else
											{
												$preference = $s1;
											}
										}
									
										$dish["preference"] = $preference;
										$dish["ter_status"] = $row_menu["ter_status"];
										
									

								array_push($menulist, $dish);
							}
							$temp["menulist"]=$menulist;

						}


						
						array_push($kitchendata, $temp);
						
				}
					

				}

				//***********************************************************************************************



			$sql_new="select DISTINCT c.kr_kotname,m.mr_kotcounter from tbl_menumaster m JOIN tbl_tableorder t on m.mr_menuid=t.ter_menuid 
			JOIN tbl_kotcountermaster c ON  m.mr_kotcounter=c.kr_kotcode
			where  (t.ter_status = 'Opened' or t.ter_status = 'Ready') and t.ter_kotno="."'".$detail["ter_kotno"]."' and ";

			$countervalues = "(m.mr_kotcounter="."'".$splitedValues[0]."'";
					
					for($i=1;$i<$len;$i++)
					{
						$countervalues = $countervalues." or m.mr_kotcounter="."'".$splitedValues[$i]."'";
					}
					  
					$countervalues = $countervalues.")";
					$sql_new = $sql_new.$countervalues;


			//echo $sql_new;
			$result_new = mysqli_query($localhost,$sql_new);
				
				if(mysqli_num_rows($result_new)>0)
				{
					
					
					
					while($row_new= mysqli_fetch_assoc($result_new))
					{
						$temp = array();
						$temp["kitchenname"]=$row_new["kr_kotname"];
						$temp["mr_kotcounter"]=$row_new["mr_kotcounter"];
						$temp["selected"]=true;


								$sql_menu="SELECT t.ter_entrytime,m.mr_kotcounter,t.ter_slno,t.ter_orderno,t.ter_kotno,m.mr_menuname,t.ter_entrytime,t.ter_qty,t.ter_status,p.pm_portionshortcode,t.ter_preferencetext,pr.pmr_name FROM `tbl_tableorder` t left join tbl_menumaster m on m.mr_menuid=t.ter_menuid left join tbl_portionmaster p on p.pm_id=t.ter_portion left join tbl_preferencemaster pr on pr.pmr_id=t.ter_preference 
WHERE (t.ter_kotno='".$detail["ter_kotno"]."' and  m.mr_kotcounter='".$temp["mr_kotcounter"]."' and (t.ter_status = 'Opened' or t.ter_status = 'Ready') ) order by t.ter_entrytime DESC";


						

						$result_menu= mysqli_query($localhost,$sql_menu);
				
						if(mysqli_num_rows($result_menu)>0)
						{
							$menulist=array();
							while($row_menu= mysqli_fetch_assoc($result_menu))
							{

									$dish = array();

									$dish["sl_num"] = $row_menu["ter_slno"];
									$dish["ter_orderno"] = $row_menu["ter_orderno"];
									$dish["ter_kotno"] = $row_menu["ter_kotno"];
									$dish["mr_menuname"] = $row_menu["mr_menuname"];
									$dish["ter_qty"] = $row_menu["ter_qty"];
									$dish["pm_portionname"] = $row_menu["pm_portionshortcode"];
									$dish["mr_kotcounter"] = $row_menu["mr_kotcounter"];
									$dish["ter_entrytime"] = $row_menu["ter_entrytime"];

									$dish["selected_counter"] = "Y";

									/*if ($dish["mr_kotcounter"]==$counterid ) {
										$dish["selected_counter"]="Y";
									}*/





/*if(strpos($counterid, $dish["mr_kotcounter"]) !== false){
  $dish["selected_counter"]="Y";
} */

if (($dish["pm_portionname"]==null) ||($dish["pm_portionname"]==NULL)){
										$dish["pm_portionname"] ="";
									}

									$preference = "";
			
										$s = $row_menu["ter_preferencetext"];
										$s1= $row_menu["pmr_name"];
										if(($s!=null) || ($s1!=null))
										{
											$preference = $s.$s1;
										}
										else if($s1==null)
										{
											if($s==null)
											{
												$preference = "";
											}
											else
											{
												$preference = $s;
											}
										}
										else
										{
											if($s1==null)
											{
												$preference = "";
											}
											else
											{
												$preference = $s1;
											}
										}
									
										$dish["preference"] = $preference;
										$dish["ter_status"] = $row_menu["ter_status"];
										
									

								array_push($menulist, $dish);
							}
							$temp["menulist"]=$menulist;

						}


						
						array_push($kitchendata, $temp);
						
				}
					

				}



			

			$detail["kitchendata"]=$kitchendata;
		 	array_push($response["data"], $detail);
		}
		
		$response["message"] = "ok";
		$response["success"] = 1;
		echo json_encode($response);
	}
	else
	{
		$response["message"] = "fails";
		$response["success"] = 10;
		echo json_encode($response);
	}	
}





























else if($check== 'update_status')
{
	$serial_no = $_GET["serial_no"];
	$order_no = $_GET["order_no"];
	$status = $_GET["status"];
	
	$sql = "UPDATE `tbl_tableorder` SET `ter_status`='".$status."' where `ter_orderno`='".$order_no."' and ter_slno='".$serial_no."'";
	
	$result = mysqli_query($localhost,$sql);
	
	if($result)
	{
		 $response["success"] = 1;
		 $response["message"] = "ok";
    	echo json_encode($response);
	}else
	{
		$response["success"] = 0;
		$response["message"] = "fail";
    	echo json_encode($response);
	}
}


else if($check== 'insertmacdetails')
{
	$machine_id = $_GET["machineid"];
	$version_code = $_GET["version_code"];
	$login_mode_value = "Normal";
	
	
	$login_mode = "select an_login_mode from tbl_branchsettings_android";
	
	$result_login = mysqli_query($localhost,$login_mode);
	if(mysqli_num_rows($result_login) > 0)
	{
		while($row1 = mysqli_fetch_array($result_login))
		{
			$login_mode_value = $row1["an_login_mode"];
		}
	}
	$sql = "select * from tbl_appmachinedetails where as_appmachineid = '".$machine_id."'";
	$result = mysqli_query($localhost,$sql);
	if(mysqli_num_rows($result) > 0)
	{
		while($row = mysqli_fetch_array($result))
		{
			$versionupdate = $row["as_update_found"];
			$present_version = $row["as_new_ver"];
			
			if($present_version==$version_code)
			{
				$upd = "update tbl_appmachinedetails set as_update_found='N' ,as_cur_ver='".$version_code."' where as_appmachineid = '".$machine_id."'";
				mysqli_query($localhost,$upd);
				$versionupdate = 'N';
			}
		}
			
		 $response["success"] = 1;
		 $response["login_mode_value"] = $login_mode_value;
		 $response["versioncheck"] = $versionupdate;
		 $response["message"] = "ok";
    	echo json_encode($response);
	}else
	{
		$sl = "insert into tbl_appmachinedetails (as_appmachineid,as_cur_ver) values('".$machine_id."','".$version_code."')";
		mysqli_query($localhost,$sl);
		
		$response["versioncheck"] = 'N';
		$response["success"] = 0;
		$response["login_mode_value"] = $login_mode_value;
		$response["message"] = "fail";
    	echo json_encode($response);
	}
}


else if($check=="login_new")
{
	$username = $_GET['username'];
	$login_type = $_GET['loginyorn'];
	
	if($login_type == 'Y')
	{
		$password = md5($_GET['password']);
	}
	else
	{
		$password = $_GET['password'];
	}
	
	$machineid =$_GET['machid'];
	$s_attenst="Y";
	$query_exec="";
	$sql_table_nos="select * from tbl_branchmaster ";
	$sql_table  =  mysqli_query($localhost,$sql_table_nos); 
	$num_table  = mysqli_num_rows($sql_table);
	
	$floorid = '';
	$floorname = '';
	
	
	if($num_table)
	{
		while($result_table  = mysqli_fetch_array($sql_table)) 
			{
				$s_attenst=$result_table['be_attendance'];
			}
	}
	
	$tkord="";
	if($s_attenst=="Y")
	{
		$sql_desg_nos="select * from tbl_designationmaster where dr_takeorder='Y' ";
		$sql_desg  =  mysqli_query($localhost,$sql_desg_nos); 
		$num_desg  = mysqli_num_rows($sql_desg);
		if($num_desg)
		{$i=0;
			while($result_desg  = mysqli_fetch_array($sql_desg)) 
				{
					if($i==0)
					$tkord="'".$result_desg['dr_designationid']."'";
					else
					$tkord=$tkord.","."'".$result_desg['dr_designationid']."'";
					$i++;
				}
		}
		$desgn_takordr =$tkord;	
	
	}else
	{
		$query_exec = mysqli_query($localhost,"select * from tbl_logindetails where ls_username = '".$username."' AND ls_password = '".$password. "'");
	}
	$result = mysqli_num_rows($query_exec);
		// check if row inserted or notTable_menu_list
		if ($result) {
			while ($row = mysqli_fetch_array($query_exec)) {
			// temp user array
			$app_rest = $row["ls_applogin"];
			$app_staffid = $row["ls_staffid"];
			if($app_rest == 'Y')
			{
				$response["success"] = 1;
				$response["staff id"] = $app_staffid;
				$response["message"] = "User permission granted!!";
				$response["permission"] = $row["ls_status"];
			}
			else if($app_rest == 'N')
	
			{
				$response["success"] = 3;
				$response["message"] = "User denied permission!!"; 
				
			}
			}
			
			  echo json_encode($response);
		} 
		else 
		{
				  $query_checklog = mysqli_query($localhost,"select * from tbl_logindetails where ls_username = '".$username."'");
				  $result_checklog= mysqli_num_rows($query_checklog);
				  if($result_checklog>0)
				  {
					  $query_checklog1 = mysqli_query($localhost,"select * from tbl_logindetails where ls_username = '".$username."' AND ls_password = '".$password. "'");
					  $result_checklog1= mysqli_num_rows($query_checklog1);
					  if($result_checklog1>0)
					  {
						  if($s_attenst=="Y")
							{	
								$query_checklog2 = mysqli_query($localhost,"select * from  tbl_logindetails as lg LEFT JOIN  tbl_staffmaster as sm ON  lg.ls_staffid=sm.ser_staffid LEFT JOIN tbl_designationmaster as dg ON dg.dr_designationid=sm.ser_designation WHERE lg.ls_username='".$username."' and lg.ls_password='".$password. "' and lg.ls_status='Y' AND  dg.dr_takeorder='Y'  and sm.ser_designation IN (".$desgn_takordr.") ");
								$result_checklog2= mysqli_num_rows($query_checklog2);
								if($result_checklog2>0)
								{	
									$query_checklog3 = mysqli_query($localhost,"select * from  tbl_logindetails as lg LEFT JOIN  tbl_staffmaster as sm ON  lg.ls_staffid=sm.ser_staffid LEFT JOIN tbl_designationmaster as dg ON dg.dr_designationid=sm.ser_designation LEFT JOIN tbl_staffattendence as sa ON sa.sce_staffid=sm.ser_staffid  WHERE lg.ls_username='".$username."' and lg.ls_password='".$password. "' and lg.ls_status='Y' AND  dg.dr_takeorder='Y' AND sa.sce_date=CURDATE() and sm.ser_designation IN (".$desgn_takordr.") and sa.sce_timein<CURTIME() and (sa.sce_timeout IS NULL)");
									$result_checklog3= mysqli_num_rows($query_checklog3);
									if($result_checklog3<=0)
									{	
										$response["success"] = 7;
										$response["message"] = "Time Out / Mark Attendance"; 
									}
								}else
								{
									$response["success"] = 6;
									$response["message"] = "No Permission"; 
								}
						  }
						  
					  }else
					  {
						  $response["success"] = 4;
						  $response["message"] = "Password Mismatch"; 
					  }				  			  
				  }
				  else 	
				  {
						  $response["success"] = 5;
						  $response["message"] = "Username not found";   
				  }
			echo json_encode($response);
		}
}



else if($check == 'check_staff_discount')
{
	$user_code = $_GET['code'];

	$query_exec = mysqli_query($localhost,"SELECT l.ls_applogin,l.ls_staffid,l.ls_username FROM `tbl_logindetails` l left join  tbl_staffmaster s on s.ser_staffid=l.ls_staffid where s.ser_authorisation_code='".$user_code."'  and s.ser_employeestatus='Active'");

	$result = mysqli_num_rows($query_exec);

	if ($result) {
			while ($row = mysqli_fetch_array($query_exec)) {
			// temp user array
			$app_rest = $row["ls_applogin"];
			$app_staffid = $row["ls_staffid"];
			  if($app_rest == 'Y')
			  {

			  	$sql = "select * from tbl_staffmaster where ser_staffid = '".$app_staffid."'";
				$resultstf = mysqli_query($localhost,$sql);
	
	
					if(mysqli_num_rows($resultstf) > 0)
					{
						while($row = mysqli_fetch_array($resultstf))
						{
							$response["message"] = "ok";
							$response["success"] = 1;
							$response["discount_permission"] = $row["ser_discountpermission"];
							$response["discount_permission_value"] = $row["ser_discount_manual"];
							$response["kot_cancellation_permission"] = $row["ser_kot_cancel_permission"];

							echo json_encode($response);
						}
					}
					else
					{
						$response["message"] = "not";
						$response["success"] = 2;
						echo json_encode($response);
						
					}	

				 
			  }
			  else if($app_rest == 'N')
	  
			  {

					$response["message"] = "User denied permission!!"; 
				  	$response["success"] = 3;
				  
				   	echo json_encode($response); 
			  }
			}
			 
		} 
		else{
					$response["success"] = 0;
				  	$response["message"] = "No user found!!"; 
				   	echo json_encode($response); 
		}
	
}


else if($check=="login_mod_check")	
{
	$user_code = $_GET['code'];
	$machineid =$_GET['machid'];
		
	$s_attenst="N";
	$query_exec="";
	$sql_table_nos="select * from tbl_branchmaster ";
	$sql_table  =  mysqli_query($localhost,$sql_table_nos); 
	$num_table  = mysqli_num_rows($sql_table);
	
	$floorid = '';
	$floorname = '';
	
	
	
	$tkord="";
	if($s_attenst=="Y")
	{
		$sql_desg_nos="select * from tbl_designationmaster where dr_takeorder='Y' ";
		$sql_desg  =  mysqli_query($localhost,$sql_desg_nos); 
		$num_desg  = mysqli_num_rows($sql_desg);
		if($num_desg)
		{$i=0;
			while($result_desg  = mysqli_fetch_array($sql_desg)) 
				{
					if($i==0)
					$tkord="'".$result_desg['dr_designationid']."'";
					else
					$tkord=$tkord.","."'".$result_desg['dr_designationid']."'";
					$i++;
				}
		}
		$desgn_takordr =$tkord;	
	
	}else
	{


		$query_exec = mysqli_query($localhost,"SELECT l.ls_applogin,l.ls_staffid,l.ls_username FROM `tbl_logindetails` l left join  tbl_staffmaster s on s.ser_staffid=l.ls_staffid where s.ser_authorisation_code='".$user_code."'  and s.ser_employeestatus='Active'");
	}
	$result = mysqli_num_rows($query_exec);
		// check if row inserted or notTable_menu_list
		if ($result) {
			while ($row = mysqli_fetch_array($query_exec)) {
			// temp user array
			$app_rest = $row["ls_applogin"];
			$app_staffid = $row["ls_staffid"];
			  if($app_rest == 'Y')
			  {
				  $response["success"] = 1;
				  $response["staff id"] = $app_staffid;
				  $response["username"] = $row["ls_username"];
				  $response["message"] = "User permission granted!!";
			  }
			  else if($app_rest == 'N')
	  
			  {
				  $response["success"] = 3;
				  $response["message"] = "User denied permission!!";  
			  }
			}
			  echo json_encode($response);
		} 
		else 
		{


				  $query_checklog = mysqli_query($localhost,"select * from tbl_staffmaster where ser_authorisation_code='".$user_code."'");
				  $result_checklog= mysqli_num_rows($query_checklog);
				  if(!$result_checklog)
				  {
						 $response["success"] = 2;
						$response["message"] = "User Code not found!!"; 
						echo json_encode($response);
				  }

				  else{
				  	$response["success"] = 2;
						$response["message"] = "User Code not found!!"; 
						echo json_encode($response);
				  }
			
		}	
}

else if($check=="check_for_update")
{
	$machineid = $_GET['machineid'];
	$ip="";
	
	
	$sql = "SELECT `as_update_found` FROM `tbl_appmachinedetails` WHERE `as_appmachineid`='".$machineid."'";
	$result = mysqli_query($localhost,$sql);
	
	if(mysqli_num_rows($result) > 0)
	{
		while ($row = mysqli_fetch_array($result)) 
		{
        	$s= $row["as_update_found"];	
    	}
		
		$sql1 = "select cm_ip_address from tbl_expodine_machines where cm_is_server='Y'";
		$result1 = mysqli_query($localhost,$sql1);
		if(mysqli_num_rows($result1) > 0)
		{
			while ($row1 = mysqli_fetch_array($result1)) 
			{
				$ip= $row1["cm_ip_address"];	
			}
		}
		
		$response["success"] = 1;
		$response["update"] = $s;
		$response["ip"] = $ip;
		// echoing JSON response
		echo json_encode($response);
	}
	else
	{
		$response["success"] = 0;
		echo json_encode($response);
	}
}




else if($check == "get_ta_kod_details")
{
	$counterid = $_GET['counter_id'];	
	$date = $_GET['date'];
	$sql = '';
	$countervalues = '';
	// echo "...";
	if(($counterid=="") || ($counterid==NULL))
	{
		
 $sql="SELECT DISTINCT (bm.tab_kotno),bm.tab_billno,bm.tab_mode,DATE_FORMAT(bm.tab_time,'%H:%i:%s') as tab_time
FROM tbl_takeaway_billmaster bm join tbl_takeaway_billdetails d on d.tab_billno=bm.tab_billno WHERE (d.tab_status = 'Processing' or d.tab_status = 'Ready') and bm.tab_dayclosedate='".$date."' order by d.tab_entrytime DESC";
	}
	else
	{
		 $sql="SELECT DISTINCT (bm.tab_kotno),bm.tab_billno,bm.tab_mode,DATE_FORMAT(bm.tab_time,'%H:%i:%s') as tab_time
FROM tbl_takeaway_billmaster bm join tbl_takeaway_billdetails d on d.tab_billno=bm.tab_billno 
join tbl_menumaster m on m.mr_menuid=d.tab_menuid 
WHERE ((d.tab_status = 'Processing' or d.tab_status = 'Ready') and bm.tab_dayclosedate='".$date."' and";		
		$splitedValues = explode(",",$counterid);
		$len = count($splitedValues);
		$countervalues = "(m.mr_kotcounter="."'".$splitedValues[0]."'";
		
		for($i=1;$i<$len;$i++)
		{
			$countervalues = $countervalues." or m.mr_kotcounter="."'".$splitedValues[$i]."'";
		}
		  
		$countervalues = $countervalues.")";
		
		$sql = $sql.$countervalues.") order by d.tab_entrytime ASC";
		
	}
	
	
	// echo $sql;
	
	$result = mysqli_query($localhost,$sql);
	
	if(mysqli_num_rows($result)>0)
	{
		 $response["data"] = array();

		while($row = mysqli_fetch_assoc($result))
		{
			 $detail = array();

           
            $detail["ter_kotno"] = $row["tab_kotno"];
            $detail["tab_billno"] = $row["tab_billno"];
            $detail["time"] = $row["tab_time"];
            $detail["type"] = $row["tab_mode"];

            $kitchendata = array();

              $sql_select="select DISTINCT c.kr_kotname,m.mr_kotcounter from tbl_menumaster m JOIN tbl_takeaway_billdetails t on m.mr_menuid=t.tab_menuid 
        JOIN tbl_kotcountermaster c ON  m.mr_kotcounter=c.kr_kotcode
        where  (t.tab_status = 'Processing' or t.tab_status = 'Ready') and t.tab_billno="."'".$detail["tab_billno"]."' and";

// echo $sql_select;

            $splitedValues = explode(",",$counterid);
                $len = count($splitedValues);
                $countervalues = "(m.mr_kotcounter!="."'".$splitedValues[0]."'";
                
                for($i=1;$i<$len;$i++)
                {
                    $countervalues = $countervalues." and m.mr_kotcounter!="."'".$splitedValues[$i]."'";
                }
                  
                $countervalues = $countervalues.")";
                $sql_select = $sql_select.$countervalues;

//*********************************************************************************************************

//echo $sql_select;
$result_new = mysqli_query($localhost,$sql_select);
			
			
			  if(mysqli_num_rows($result_new)>0)
                {
                    
                    
                    
                    while($row_new= mysqli_fetch_assoc($result_new))
                    {
                        $temp = array();
                        $temp["kitchenname"]=$row_new["kr_kotname"];
                        $temp["mr_kotcounter"]=$row_new["mr_kotcounter"];
                        $temp["selected"]=false;


                                $sql_menu="SELECT t.tab_slno,t.tab_entrytime,m.mr_kotcounter,t.tab_billno,m.mr_menuname,t.tab_qty,t.tab_status,p.pm_portionshortcode,t.tab_preferencetext FROM `tbl_takeaway_billdetails` t left join tbl_menumaster m on m.mr_menuid=t.tab_menuid left join tbl_portionmaster p on p.pm_id=t.tab_portion  
WHERE (t.tab_billno='".$detail["tab_billno"]."' and  m.mr_kotcounter='".$temp["mr_kotcounter"]."' and (t.tab_status = 'Processing' or t.tab_status = 'Ready') ) order by t.tab_entrytime DESC";

// echo $sql_menu;
                        

                        $result_menu= mysqli_query($localhost,$sql_menu);
                
                        if(mysqli_num_rows($result_menu)>0)
                        {
                            $menulist=array();
                            while($row_menu= mysqli_fetch_assoc($result_menu))
                            {

                                    $dish = array();

                                    $dish["sl_num"] = $row_menu["tab_slno"];
                                    $dish["ter_orderno"] = $row_menu["tab_billno"];
                                    $dish["ter_kotno"] = $detail["ter_kotno"];
                                    $dish["mr_menuname"] = $row_menu["mr_menuname"];
                                    $dish["ter_qty"] = $row_menu["tab_qty"];
                                    $dish["pm_portionname"] = $row_menu["pm_portionshortcode"];


									if(($dish["pm_portionname"]=='null') || ($dish["pm_portionname"]==null) || ($dish["pm_portionname"]==NULL)){
									
										$dish["pm_portionname"] ="";
										//echo "string";
									}

                                    $dish["mr_kotcounter"] = $row_menu["mr_kotcounter"];
                                    $dish["ter_entrytime"] = $row_menu["tab_entrytime"];

                                    $dish["selected_counter"] = "N";

                                    /*if ($dish["mr_kotcounter"]==$counterid ) {
                                        $dish["selected_counter"]="Y";
                                    }*/


/*if(strpos($counterid, $dish["mr_kotcounter"]) !== false){
  $dish["selected_counter"]="Y";
} */

									$preference =$row_menu["tab_preferencetext"];
                                    if(($preference==null) || ($preference==NULL))
                                        {
                                            $preference ="";
                                        }
                                       
                                    
                                        $dish["preference"] = $preference;
                                        $dish["ter_status"] = $row_menu["tab_status"];
                                        
                                    

                                array_push($menulist, $dish);
                            }
                            $temp["menulist"]=$menulist;

                        }


                        
                        array_push($kitchendata, $temp);
                        
                }
                    

                }

                //***********************************************************************************************

				

 		 $sql_select="select DISTINCT c.kr_kotname,m.mr_kotcounter from tbl_menumaster m JOIN tbl_takeaway_billdetails t on m.mr_menuid=t.tab_menuid 
        JOIN tbl_kotcountermaster c ON  m.mr_kotcounter=c.kr_kotcode
        where  (t.tab_status = 'Processing' or t.tab_status = 'Ready') and t.tab_billno="."'".$detail["tab_billno"]."' and";



            $splitedValues = explode(",",$counterid);
                $len = count($splitedValues);
                $countervalues = "(m.mr_kotcounter="."'".$splitedValues[0]."'";
                
                for($i=1;$i<$len;$i++)
                {
                    $countervalues = $countervalues." or m.mr_kotcounter="."'".$splitedValues[$i]."'";
                }
                  
                $countervalues = $countervalues.")";
                $sql_select = $sql_select.$countervalues;

                //echo $sql_select;

			$result_new = mysqli_query($localhost,$sql_select);
			
			
			  if(mysqli_num_rows($result_new)>0)
                {
                    
                    
                    
                    while($row_new= mysqli_fetch_assoc($result_new))
                    {
                        $temp = array();
                        $temp["kitchenname"]=$row_new["kr_kotname"];
                        $temp["mr_kotcounter"]=$row_new["mr_kotcounter"];
                        $temp["selected"]=true;


                                $sql_menu="SELECT t.tab_slno,t.tab_entrytime,m.mr_kotcounter,t.tab_billno,m.mr_menuname,t.tab_qty,t.tab_status,p.pm_portionshortcode,t.tab_preferencetext FROM `tbl_takeaway_billdetails` t left join tbl_menumaster m on m.mr_menuid=t.tab_menuid left join tbl_portionmaster p on p.pm_id=t.tab_portion  
WHERE (t.tab_billno='".$detail["tab_billno"]."' and  m.mr_kotcounter='".$temp["mr_kotcounter"]."' and (t.tab_status = 'Processing' or t.tab_status = 'Ready') ) order by t.tab_entrytime DESC";

//echo $sql_menu;
                        

                        $result_menu= mysqli_query($localhost,$sql_menu);
                
                        if(mysqli_num_rows($result_menu)>0)
                        {
                            $menulist=array();
                            while($row_menu= mysqli_fetch_assoc($result_menu))
                            {

                                    $dish = array();

                                    $dish["sl_num"] = $row_menu["tab_slno"];
                                    $dish["ter_orderno"] = $row_menu["tab_billno"];
                                    $dish["ter_kotno"] = $detail["ter_kotno"];
                                    $dish["mr_menuname"] = $row_menu["mr_menuname"];
                                    $dish["ter_qty"] = $row_menu["tab_qty"];
                                    $dish["pm_portionname"] = $row_menu["pm_portionshortcode"];
                                    $dish["mr_kotcounter"] = $row_menu["mr_kotcounter"];
                                    $dish["ter_entrytime"] = $row_menu["tab_entrytime"];

                                    $dish["selected_counter"] = "Y";

                                    /*if ($dish["mr_kotcounter"]==$counterid ) {
                                        $dish["selected_counter"]="Y";
                                    }*/


/*if(strpos($counterid, $dish["mr_kotcounter"]) !== false){
  $dish["selected_counter"]="Y";


} */

if(($dish["pm_portionname"]=='null') || ($dish["pm_portionname"]==null) || ($dish["pm_portionname"]==NULL)){
									
										$dish["pm_portionname"] ="";
										//echo "string";
									}

									$preference =$row_menu["tab_preferencetext"];
                                    if(($preference==null) || ($preference==NULL))
                                        {
                                            $preference ="";
                                        }
                                       
                                    
                                        $dish["preference"] = $preference;
                                        $dish["ter_status"] = $row_menu["tab_status"];
                                        
                                    

                                array_push($menulist, $dish);
                            }
                            $temp["menulist"]=$menulist;

                        }


                        
                        array_push($kitchendata, $temp);
                        
                }
                    

                }


//***************************************************************************************************************

           
            $detail["kitchendata"]=$kitchendata;
		 	array_push($response["data"], $detail);
		}
		
		$response["message"] = "ok";
		$response["success"] = 1;
		echo json_encode($response);
	}
	else
	{
		$response["message"] = "fails";
		$response["success"] = 0;
		echo json_encode($response);
	}	
}


else if($check == "get_ta_kot_details")
{
	$counterid = $_GET['counter_id'];	
	$date = $_GET['date'];
	$sql = '';
	$countervalues = '';
	
	if(($counterid=="") || ($counterid==NULL))
	{
		$sql = "select bd.tab_slno,bd.tab_billno,concat(bd.tab_qty,concat('(',concat(p.pm_portionshortcode,')'))) as qtysh,bd.tab_preferencetext,bd.tab_status,DATE_FORMAT(bd.tab_entrytime,'%H:%i:%s') tab_entrytime,bm.tab_kotno,m.mr_menuname,bm.tab_mode
from tbl_takeaway_billdetails bd 
left join tbl_takeaway_billmaster bm on bd.tab_billno=bm.tab_billno 
left join tbl_menumaster m on m.mr_menuid=bd.tab_menuid 
left join tbl_portionmaster p on p.pm_id=bd.tab_portion 
where ((bd.tab_status='Processing') or (bd.tab_status='Ready')) and bm.tab_dayclosedate='".$date."' order by bd.tab_entrytime ASC";
	}
	else
	{
		$sql = "select bd.tab_slno,bd.tab_billno,concat(bd.tab_qty,concat('(',concat(p.pm_portionshortcode,')'))) as qtysh,bd.tab_preferencetext,bd.tab_status,DATE_FORMAT(bd.tab_entrytime,'%H:%i:%s') tab_entrytime,bm.tab_kotno,m.mr_menuname,bm.tab_mode
from tbl_takeaway_billdetails bd 
left join tbl_takeaway_billmaster bm on bd.tab_billno=bm.tab_billno 
left join tbl_menumaster m on m.mr_menuid=bd.tab_menuid 
left join tbl_portionmaster p on p.pm_id=bd.tab_portion 
where ((bd.tab_status='Processing') or (bd.tab_status='Ready')) and bm.tab_dayclosedate='".$date."' and ";
		
		$splitedValues = explode(",",$counterid);
		$len = count($splitedValues);
		$countervalues = "(m.mr_kotcounter="."'".$splitedValues[0]."'";
		
		for($i=1;$i<$len;$i++)
		{
			$countervalues = $countervalues." or m.mr_kotcounter="."'".$splitedValues[$i]."'";
		}
		  
		$countervalues = $countervalues.")";
		
		$sql = $sql.$countervalues." order by bd.tab_entrytime ASC";
		
	}
	
	
	
	$result = mysqli_query($localhost,$sql);
	
	if(mysqli_num_rows($result)>0)
	{
		$response["kot_details"] = array();
		while($row = mysqli_fetch_assoc($result))
		{
			$detail = array();
			$detail["tab_slno"] = $row["tab_slno"];
			$detail["tab_billno"] = $row["tab_billno"];
			$detail["qtysh"] = $row["qtysh"];
			$detail["tab_status"] = $row["tab_status"];
			$detail["tab_entrytime"] = $row["tab_entrytime"];
			$detail["tab_kotno"] = $row["tab_kotno"];
			$detail["mr_menuname"] = $row["mr_menuname"];
			
			$preference = "";
			
			$s = $row["tab_preferencetext"];
			if($s!=null)
			{
				$preference = $s;
			}
			else if($s==null)
			{
				$preference = "";
			}
		
			$detail["preference"] = $preference;
			$detail["tab_mode"] = $row["tab_mode"];
			
			
		 	array_push($response["kot_details"], $detail);
		}
		
		$response["message"] = "ok";
		$response["success"] = 1;
		echo json_encode($response);
	}
	else
	{
		$response["message"] = "fails";
		$response["success"] = 10;
		echo json_encode($response);
	}	
}

else if($check== 'update_statu_tas')
{
	$serial_no = $_GET["serial_no"];
	$order_no = $_GET["order_no"];
	$status = $_GET["status"];
	
	$sq = "select tab_status from tbl_takeaway_billdetails where `tab_billno`='".$order_no."' and tab_slno='".$serial_no."'";
	$res =  mysqli_query($localhost,$sq);
	if(	mysqli_num_rows($res)>0)
	{
		while($row = mysqli_fetch_assoc($res))
		{
			$stat = $row["tab_status"];
			if($stat=="Ready")
			{
				$sql = "UPDATE `tbl_takeaway_billdetails` SET `tab_status`='".$status."' where `tab_billno`='".$order_no."' and tab_slno='".				                        $serial_no."'";
				$result = mysqli_query($localhost,$sql);
				$response["success"] = 1;
				$response["reply"] = "Item Packed";
				$response["message"] = "ok";
				echo json_encode($response);
			}
			else
			{
				$response["success"] = 0;
				$response["reply"] = "Item not Ready to get Packed";
				$response["message"] = "fail";
				echo json_encode($response);
			}
		}
	}
	else
	{
		$response["success"] = 0;
		$response["reply"] = "Order not found";
		$response["message"] = "fail";
    	echo json_encode($response);
	}
}

else if($check == "packing_screen")
{
	$staffname = $_GET['username'];
	
	$sql = "SELECT u.um_access FROM `tbl_modulemaster` mm left join tbl_usermodules u on u.um_moduleid=mm.`mer_moduleid` where `mer_modulename`='Packing Counter' and u.um_submoduleid='1' and u.um_username= '".$staffname."'";
	
	$result = mysqli_query($localhost,$sql);
	if(mysqli_num_rows($result) > 0)
	{
		while($row = mysqli_fetch_array($result))
		{
			$response["message"] = "ok";
			$response["success"] = 1;
			if(($row["um_access"] == NULL) || ($row["um_access"]==''))
			{
				$response["packing_screen_display"] = 'N';
			}
			else
			{
				$response["packing_screen_display"] = $row["um_access"];
			}
			echo json_encode($response);
		}
	}
	else
	{
		$response["packing_screen_display"] = 'N';
		$response["message"] = "not";
		$response["success"] = 0;
		echo json_encode($response);
	}	
}

else if($check == "pkg_details")
{
	$sql = "SELECT DISTINCT tb.tab_billno,bm.tab_time,bm.tab_kotno 
FROM  tbl_takeaway_billdetails tb 
LEFT JOIN tbl_takeaway_billmaster bm on bm.tab_billno=tb.tab_billno 
where ((tb.tab_status = 'Processing') or (tb.tab_status = 'Ready')) and tb.tab_billno not like 'Temp%' 
order by bm.tab_kotno ASC";
	
	$result = mysqli_query($localhost,$sql);
	
	if(mysqli_num_rows($result)>0)
	{
		$response["billnumber"] = array();
		while($row = mysqli_fetch_array($result))
		{
			$detail = array();
			$detail["tab_billno"] = $row["tab_billno"];
		 	$detail["tab_time"] = $row["tab_time"];
			$detail["tab_kotno"] = $row["tab_kotno"];			
		
			$sql1 = "SELECT count(*) as processing_items, tb.tab_billno,tb.tab_time FROM tbl_takeaway_billmaster tb left join tbl_takeaway_billdetails tbd on tb.tab_billno = tbd.tab_billno where tbd.tab_status = 'Processing' and tb.tab_billno ='".$row["tab_billno"]."'";
	
			$sql2 = "SELECT count(*) as ready_items, tb.tab_billno,tb.tab_time FROM tbl_takeaway_billmaster tb left join tbl_takeaway_billdetails tbd on tb.tab_billno = tbd.tab_billno where tbd.tab_status = 'Ready' and tb.tab_billno ='".$row["tab_billno"]."'";
			
			$sql3 = "SELECT count(*) as total_items, tb.tab_billno,tb.tab_time FROM tbl_takeaway_billmaster tb left join tbl_takeaway_billdetails tbd on tb.tab_billno = tbd.tab_billno where tb.tab_billno ='".$row["tab_billno"]."'";
	
			$result1 = mysqli_query($localhost,$sql1);
			$result2 = mysqli_query($localhost,$sql2);
			$result3 = mysqli_query($localhost,$sql3);
			
			if(mysqli_num_rows($result1)>0)
			{
				while($row = mysqli_fetch_array($result1))
				{
					$detail["processing_items"]= $row["processing_items"];	
				}
			}
			
			if(mysqli_num_rows($result2)>0)
			{
				while($row = mysqli_fetch_array($result2))
				{
					$detail["ready_items"]= $row["ready_items"];
				}	
			}
			
			if(mysqli_num_rows($result3)>0)
			{
				while($row = mysqli_fetch_array($result3))
				{
					$detail["total_items"]= $row["total_items"];
				}	
			}
		 	array_push($response["billnumber"], $detail);
		}
		
		
		$response["message"] = "ok";
		$response["success"] = 1;
		echo json_encode($response);
	}
	else
	{
		$response["message"] = "fails";
		$response["success"] = 10;
		echo json_encode($response);
	}
	
}


else if($check == "update_statu_package")
{
	$billnum = $_GET['billnumber'];
	$status = $_GET['status'];
	
	$sql = "SELECT EXISTS(SELECT tab_status FROM tbl_takeaway_billdetails where tab_billno='".$billnum."' and tab_status='Processing') AS VAL";
	
	$result = mysqli_query($localhost,$sql);
	while($row = mysqli_fetch_array($result))
	{
		$VAL = $row["VAL"];
		if($VAL==1)
		{
			$response["message"] = "fails";
			$response["success"] = 0;
			$response["reply"] = "Some items are not ready to pack";
			echo json_encode($response);	
		}
		else
		{
			$updat = "update tbl_takeaway_billdetails set tab_status='".$status."' where tab_billno='".$billnum."'";
			$result = mysqli_query($localhost,$updat);
			$response["reply"] = "Items Packed";

			$response["message"] = "ok";
			$response["success"] = 1;
			echo json_encode($response);
			
		}
	}
	
}

else if($check == "details_pkg")
{
	$billnum = $_GET['billnumber'];
	
	$sql = "SELECT b.tab_slno,b.tab_billno,m.mr_menuname,p.pm_portionname,b.tab_qty,b.tab_status FROM tbl_takeaway_billdetails b left join tbl_menumaster m on m.mr_menuid = b.`tab_menuid` left join tbl_portionmaster p on p.pm_id = b.`tab_portion` left join tbl_takeaway_billmaster t on t.tab_billno = b.tab_billno where ((b.tab_status ='Ready') or (b.tab_status = 'Processing')) and b.tab_billno='".$billnum."' order by b.tab_entrytime ASC";
	
	$result = mysqli_query($localhost,$sql);
	
	if(mysqli_num_rows($result)>0)
	{
		$response["details"] = array();
		while($row = mysqli_fetch_array($result))
		{
			$detail = array();
			$detail["tab_slno"] = $row["tab_slno"];
			$detail["tab_billno"] = $row["tab_billno"];
			$detail["mr_menuname"] = $row["mr_menuname"];
			
			$detail["pm_portionname"] = $row["pm_portionname"];
			$detail["tab_qty"] = $row["tab_qty"];
			$detail["tab_status"] = $row["tab_status"];
						
		 	array_push($response["details"], $detail);
		}
		
		$response["message"] = "ok";
		$response["success"] = 1;
		echo json_encode($response);
	}
	else
	{
		$response["message"] = "fails";
		$response["success"] = 10;
		echo json_encode($response);
	}
	
}

else if($check== 'update_statu_takod')
{
	$serial_no = $_GET["serial_no"];
	$order_no = $_GET["order_no"];
	$status = $_GET["status"];
	
	$sql = "UPDATE `tbl_takeaway_billdetails` SET `tab_status`='".$status."' where `tab_billno`='".$order_no."' and tab_slno='".$serial_no."'";
	$result = mysqli_query($localhost,$sql);
	if($result)
	{
		$response["success"] = 1;
		$response["reply"] = "Item got ".$status;
		$response["message"] = "ok";
		echo json_encode($response);
	}
	else
	{
		$response["success"] = 0;
		$response["reply"] = "Item is Processing";
		$response["message"] = "fail";
		echo json_encode($response);
	}
}

else if($check == "cashdrawer_details")
{
	$mac_id = $_GET['mac_id'];
	
	$sql = "SELECT `as_enable_cash_drawer`, `as_cash_drawer_ip`, `as_cash_drawer_port` FROM `tbl_appmachinedetails` WHERE `as_appmachineid`='".$mac_id."' ";
	
	$result = mysqli_query($localhost,$sql);
	
	$switchpos="";
	$cashdrawer_ip="";
	$cashdrawer_port="";
	
	if(mysqli_num_rows($result)>0)
	{
		while($row = mysqli_fetch_array($result))
		{
			$switchpos = $row["as_enable_cash_drawer"];
			if($switchpos=="Y")
			{
				$switchpos = "true";	
			}
			else{
				$switchpos = "false";	
			}
			
			$caship = $row["as_cash_drawer_ip"];
			if($caship==NULL)
			{
				$caship = "";
			}
			
			$cashport = $row["as_cash_drawer_port"];
			if($cashport==NULL)
			{
				$cashport = "";
			}
		}
		
		$response["message"] = "ok";
		$response["switch_positon_default"] = $switchpos;
		$response["cashdrawer_ip"] = $caship;
		$response["cashdrawer_port"] = $cashport;
		$response["success"] = 1;
		echo json_encode($response);
	}
	else
	{
		$response["message"] = "fails";
		$response["success"] = 0;
		echo json_encode($response);
	}
}


else if($check== 'update_cashdrawer')
{
	$ip_cash = $_GET["ip_cash"];
	$port_cash = $_GET["port_cash"];
	$machineid = $_GET["machineid"];
	
	$sql = "UPDATE `tbl_appmachinedetails` SET `as_cash_drawer_ip`='".$ip_cash."',`as_cash_drawer_port`='".$port_cash."',`as_enable_cash_drawer`='Y' where `as_appmachineid`='".$machineid."'";
	
	$result = mysqli_query($localhost,$sql);
	if($result)
	{
		$response["success"] = 1;
		$response["message"] = "Updated";
		echo json_encode($response);
	}
	else
	{
		$response["success"] = 0;
		$response["message"] = "Failed to update";
		echo json_encode($response);
	}
}

else if($check== 'open_cash_drawer')
{
	
error_reporting(0);

	$machineid = $_GET["machineid"];
	$branchid = $_GET["branchid"];
	$login_username = $_GET["login_username"];
	
	$check_permission = "select be_cash_drawer from tbl_branchmaster";
	$result = mysqli_query($localhost,$check_permission);
	if(mysqli_num_rows($result)>0)
	{
		while($row = mysqli_fetch_array($result))
		{
			$be_cash_drawer = $row["be_cash_drawer"];
			if($be_cash_drawer=="Y")
			{
				$cur="";
	  			$sql_desg_nos1="select * from tbl_dayclose where dc_timeclose IS NULL";//and dc_day ='$dt'
			  	$sql_desg1  =  mysqli_query($localhost,$sql_desg_nos1);
			  	$num_desg1  = mysqli_num_rows($sql_desg1);
			  	if($num_desg1)
				{
					 while($result_desg1  = mysqli_fetch_array($sql_desg1)) 
					 {
						$cur=$result_desg1['dc_day'];
						require_once("cashdrawer_functions.php");
						$opendrawer=new CashDrawerCommonSettings();
						$open_or_not=$opendrawer->opendrawer($cur,$branchid,$login_username,$machineid,"android");
						
						if($open_or_not==1)
						{
							$response["success"] = 1;
							$response["message"] = "Opened";
							echo json_encode($response);
						}
						else if($open_or_not==2)
						{
							$response["success"] = 0;
							$response["message"] = "Drawer open permission not allowed";
							echo json_encode($response);
						}
						else if($open_or_not==3)
						{
							$response["success"] = 0;
							$response["message"] = "Drawer IP or Port number is empty";
							echo json_encode($response);
						}
					 }
			 	}
				else
				{
					$response["success"] = 0;
					$response["message"] = "Day not opened";
					echo json_encode($response);
				}
			}
			else
			{
				$response["success"] = 2;
				$response["message"] = "Drawer permission not activated";
				echo json_encode($response);
			}
		}
	}
	else
	{
		$response["success"] = 0;
		$response["message"] = "";
		echo json_encode($response);
	}

}


else if($check == "cashdrawer_ip_staff_permission")
{
	$staff_id = $_GET['staff_id'];
	
	$sql = "SELECT `ser_permit_cash_drawer_open` FROM `tbl_staffmaster` WHERE `ser_staffid`='".$staff_id."' ";
	
	$result = mysqli_query($localhost,$sql);
	
	if(mysqli_num_rows($result)>0)
	{
		while($row = mysqli_fetch_array($result))
		{
			$response["staff_permission"] = $row["ser_permit_cash_drawer_open"];
		}
		$response["message"] = "ok";
		$response["success"] = 1;
		echo json_encode($response);
	}
	else
	{
		$response["message"] = "fails";
		$response["success"] = 0;
		$response["staff_permission"] = "N";
		echo json_encode($response);
	}
}


else if($check == "check_counter_discount")
{
	$sql = "SELECT bsc_discount_popup from  tbl_branch_settings_counter";
	
	$result = mysqli_query($localhost,$sql);
	
	if(mysqli_num_rows($result)>0)
	{
		while($row = mysqli_fetch_array($result))
		{
			$response["reply"] = $row["bsc_discount_popup"];
		}
		$response["message"] = "ok";
		$response["success"] = 1;
		echo json_encode($response);
	}
	else
	{
		$response["message"] = "fails";
		$response["success"] = 10;
		echo json_encode($response);
	}	
}


else if($check == "print_counter")
{	
	$temp_number = $_GET['temp_number'];
	$branchid = $_GET['branchid'];
	$ds_type = $_GET['discounttype'];
	$ds_id = $_GET['discountid'];
	$dmode=$_GET['discmode'];//"P";
	$mode=$_GET['mode_of_input'];//"CS,TA"
	$loginname=$_GET['loginname'];
	$staus = "Bill_Generated";
	
	
	$discount_of_or='';
	$discount_unit_or='';
	$discount_or='';
	$discountid_or='';
	if($ds_type=="drop")
	{
		$discount_of_or="";
		$discount_unit_or="";
		$discount_or="Y";
		$discountid_or=$ds_id;
	}else if($ds_type=="text")
	{
	   $discount_of_or=$ds_id;
		$discount_unit_or=$dmode;
		$discount_or="Y";
		$discountid_or=""; 
	}else if($ds_type=="empty")
	{
		$discount_of_or="";
		$discount_unit_or="";
		$discount_or="N";
		$discountid_or=""; 
	}

	$discount_of_or="0";
	
	mysqli_query($localhost,"SET @temp_billno = " . "'" . $temp_number . "'");
	mysqli_query($localhost,"SET @branchid = " . "'" . $branchid . "'");
	mysqli_query($localhost,"SET @discount = " . "'" . $discount_or . "'");
	mysqli_query($localhost,"SET @discount_of = " . "'" . $discount_of_or . "'");
	mysqli_query($localhost,"SET @discount_unit = " . "'" . $discount_unit_or . "'");
	mysqli_query($localhost,"SET @discountid = " . "'" . $discountid_or . "'");
	mysqli_query($localhost,"SET @loginid = " . "'" . $loginname . "'");
	
	$billnumber='';$kot_number='';$proc_message='';
		
	try
      {
          $result1=mysqli_query($localhost,"CALL proc_gencounter(@temp_billno,@branchid,@discount,@discount_of,@discount_unit,@discountid,
		  @loginid,@new_billno,@new_kotno,@message)") or throw_ex(mysqli_error($localhost)) ;
      $rs = mysqli_query($localhost,'SELECT @message AS message,@new_billno AS bill_no,@new_kotno AS kot_num');
	  
      $proc_message = "Failed to execute the procedure";
      while($row = mysqli_fetch_array($rs))
      {
		  $proc_message= $row['message'];
		  $billnumber= $row['bill_no'];
		  $kot_number= $row['kot_num'];
      }
	 
	  
	  	if($proc_message == "Bill and Kot generated sucessfully")
		{
                    
                    $printer_on = "select be_printall from tbl_branchmaster";
	  $result_printer_on = mysqli_query($localhost,$printer_on);
	  if(mysqli_num_rows($result_printer_on)>0)
	  {
		  while($row1 = mysqli_fetch_array($result_printer_on))
		  {
			  $print_all = $row1["be_printall"];
		  }
	  }
                    
                    
                    
			require_once("printer_functions.php");
			$printpage=new PrinterCommonSettings(); 
                        
                        if($print_all=="Y"){
			$prtck=$printpage->print_bill_ta($billnumber,$mode,$branchid,"android");
                        }
			// $result = mysqli_query($localhost,"UPDATE  tbl_takeaway_billmaster set tab_status='".$status."' where `tab_billno` = '".$billnumber."'");
	   // echo "UPDATE  tbl_takeaway_billmaster set tab_status='".$status."' where `tab_billno` = '".$billnumber."'";
			
			$cur="";
			$sql_desg_nos1="select * from tbl_dayclose where dc_timeclose IS NULL";//and dc_day ='$dt'
			$sql_desg1  =  mysqli_query($localhost,$sql_desg_nos1);
			$num_desg1  = mysqli_num_rows($sql_desg1);
			if($num_desg1){
				while($result_desg1  = mysqli_fetch_array($sql_desg1)) 
				{
					$cur=$result_desg1['dc_day'];
				}
			}		  
			$date = $cur;  
		   
			$kot_or = "select bsc_kotprint from tbl_branch_settings_counter";
			$result1 = mysqli_query($localhost,$kot_or);
	  
			if(mysqli_num_rows($result1)>0)
			{
				while($row = mysqli_fetch_array($result1))
				{
					$repl = $row["bsc_kotprint"];
				}
				
				if($repl=="Y")
				{	
                                    
                                    
                                    
                                    $sql_table_pt="select be_printall from tbl_branchmaster";
	$sql_pt  =  mysqli_query($localhost,$sql_table_pt); 
	$num_pt  = mysqli_num_rows($sql_pt);
	if($num_pt)
	{
		while($result_pt1  = mysqli_fetch_array($sql_pt)) 
		{
                    $print_all=$result_pt1['be_printall'];
                    
                }
                }  
                                    
					$kotprint_tp='';
					$sql_table_pt="select * from tbl_printertype";
					$sql_pt  =  mysqli_query($localhost,$sql_table_pt); 
					$num_pt  = mysqli_num_rows($sql_pt);
					if($num_pt)
					{
						while($result_pt  = mysqli_fetch_array($sql_pt)) 
						{
							if($result_pt['pt_typename']=="KOT Print TA CS")
							{
								$kotprint_tp=$result_pt['pt_id'];
								require_once("printer_functions.php");
								$printpage=new PrinterCommonSettings();
                                                                
                                                                if($print_all=='Y'){
								$prtck=$printpage->print_kot_ta($kot_number,$billnumber,$date,$kotprint_tp,$branchid,"android");
                                                                }
							}
						}
					}	
                                        
                                        
                                        
					$kotprint_tp1='';
					$sql_table_pt1="select * from tbl_printertype";
					$sql_pt1  =  mysqli_query($localhost,$sql_table_pt1); 
					$num_pt1  = mysqli_num_rows($sql_pt1);
					if($num_pt1)
					{
						while($result_pt1  = mysqli_fetch_array($sql_pt1)) 
						{
							if($result_pt1['pt_typename']== "Consolidated TA CS")
							{
								$kotprint_tp1=$result_pt1['pt_id'];
								require_once("printer_functions.php");
								$printpage=new PrinterCommonSettings();
                                                                  if($print_all=='Y'){
								$prtck=$printpage->print_kot_ta_consolidated($kot_number,$billnumber,$date,$kotprint_tp1,$branchid,"android");
                                                                  }
							}
						}
					}			
				}  
			}
			 $response["success"] = 1;
			 $response["message"] = $proc_message;
			 echo json_encode($response);
		}
		else if($proc_message == "Bill and Kot generated sucessfully")
		{
			 $response["success"] = 0;
			 $response["message"] = $proc_message;
			 echo json_encode($response);
		}
		
		else
		{
		   $response["success"] = 0;
		   $response["message"] = "No procedure";
		   echo json_encode($response);
		}
          
      }catch (Exception $e) {
        $returnmsg= 'Caught exception: '.  $e;
        $file = 'log.txt';
        $content = date("l F d-m-Y h:i:s A")." ".$returnmsg.PHP_EOL;
        file_put_contents($file, $content, FILE_APPEND | LOCK_EX);
         echo   $returnmsg;exit();
         $proc_message = "Failed to execute the procedure";
         $response["success"] = 2;
         $response["message"] = $proc_message;
         echo json_encode($response);
    }	
}

else if($check == "generate_settle_blue")
{	

	$temp_number = $_GET['temp_number'];
	$branchid = $_GET['branchid'];
	$ds_type = $_GET['discounttype'];
	$ds_id = $_GET['discountid'];
	$dmode=$_GET['discmode'];//"P";
	$mode=$_GET['mode_of_input'];//"CS,TA"
	$loginname=$_GET['loginname'];

$table_name=NULL;
	$pax=NULL;

	$redeem=0;
	$c_name="";
	$c_no="";
	$c_veh_no="";


	$discount_of_or='';
	$discount_unit_or='';
	$discount_or='';
	$discountid_or='';
	if($ds_type=="drop")
	{
		$discount_of_or=0;
		$discount_unit_or="";
		$discount_or="Y";
		$discountid_or=$ds_id;
	}else if($ds_type=="text")
	{
	   $discount_of_or=$ds_id;
		$discount_unit_or=$dmode;
		$discount_or="Y";
		$discountid_or=""; 
	}else if($ds_type=="empty")
	{
		$discount_of_or=0;
		$discount_unit_or="";
		$discount_or="N";
		$discountid_or=""; 
	}



	/*echo 'temp_number: '.$temp_number.',branchid: '.$branchid.',discount_or: '.$discount_or.',discount_of_or: '.$discount_of_or.',discount_unit_or: '.$discount_unit_or.',discountid_or: '.$discountid_or.',loginname: '.$loginname;*/
	
	mysqli_query($localhost,"SET @temp_billno = " . "'" . $temp_number . "'");
	mysqli_query($localhost,"SET @branchid = " . "'" . $branchid . "'");
	mysqli_query($localhost,"SET @discount = " . "'" . $discount_or . "'");
	mysqli_query($localhost,"SET @discount_of = " . "'" . $discount_of_or . "'");
	mysqli_query($localhost,"SET @discount_unit = " . "'" . $discount_unit_or . "'");
	mysqli_query($localhost,"SET @discountid = " . "'" . $discountid_or . "'");
	mysqli_query($localhost,"SET @loginid = " . "'" . $loginname . "'");
	mysqli_query($localhost,"SET @table_name = " . "'" . $table_name . "'");
	mysqli_query($localhost,"SET @pax = " . "'" . $pax . "'");
	mysqli_query($localhost,"SET @redeem = " . "'" . $redeem . "'");
	
	$billnumber='';$kot_number='';$proc_message='';


		
	try
      {

          $result1=mysqli_query($localhost,"CALL proc_gencounter_bill(@temp_billno,@branchid,@discount,@discount_of,@discount_unit,@discountid,@loginid, @table_name,@pax,@redeem,@new_billno,@message)") or throw_ex(mysqli_error($localhost)) ;

      $rs = mysqli_query($localhost,'SELECT @message AS message,@new_billno AS bill_no');
      
      $proc_message = "Failed to execute the procedure";
      while($row = mysqli_fetch_array($rs))
      {
		  $proc_message= $row['message'];
		  $billnumber= $row['bill_no'];
		 
		  

      }
	  
	  
	  $printer_on = "select be_printall from tbl_branchmaster";
	  $result_printer_on = mysqli_query($localhost,$printer_on);
	  if(mysqli_num_rows($result_printer_on)>0)
	  {
		  while($row1 = mysqli_fetch_array($result_printer_on))
		  {
			  $print_all = $row1["be_printall"];
		  }
	  }
	 
		if($proc_message == "Bill generated sucessfully")
		{
			/*$result = mysqli_query($localhost,"UPDATE  `tbl_takeaway_billmaster` set `tab_c_name`='".$c_name."',`tab_c_no`='".$c_no."',`tab_c_veh_no`='".$c_veh_no."' where `tab_billno` = '".$billnumber."'");
*/

			$result = mysqli_query($localhost,"UPDATE  `tbl_takeaway_billmaster` set `tab_c_name`='".$c_name."',`tab_c_no`='".$c_no."',`tab_c_veh_no`='".$c_veh_no."',`tab_no_pax`='".$pax."',`tab_table_no`='".$table_name."' where `tab_billno` = '".$billnumber."'");


			$check_condition_print_bill = "select bsc_bill_before_settle from tbl_branch_settings_counter";
			$result1 = mysqli_query($localhost,$check_condition_print_bill);
	  		if(mysqli_num_rows($result1)>0)
			{
				$msg = "";
				while($row = mysqli_fetch_array($result1))
				{
					$msg = $row["bsc_bill_before_settle"];
				}
				
				$check = "select * FROM tbl_takeaway_billmaster  Where tab_billno = '".$billnumber."' AND (tab_mode_of_entry = 'G')";
				$result2 = mysqli_query($localhost,$check);
				if(mysqli_num_rows($result2)==0)
				{
					if($msg=="Y")
					{

						if($print_all=="Y")
						{
							

							require_once("printer_functions.php");
							$printpage=new PrinterCommonSettings(); 
							$prtck=$printpage->print_bill_ta($billnumber,$mode,$branchid,"android");
							$updateqry="update tbl_takeaway_billmaster set tab_bill_print='Y',tbl_takeaway_printed='Y' where tab_billno='".$billnumber."'";
							mysqli_query($localhost,$updateqry);

						}
					}	
				}
			}
		   $response["success"] = 1;
		   $response["message"] = $proc_message;
		   $response["bill_number_generated"] = $billnumber;
		   echo json_encode($response);
		}
		else if($proc_message == "Bill Not Generated")
		{
		   $response["success"] = 0;
		   $response["message"] = $proc_message;
		   echo json_encode($response);
		}
		else if ($proc_message =="DISCOUNT GIVEN MORE THAN BILL AMOUNT") {
			$response["success"] = 2;
		   $response["message"] = $proc_message;
		   echo json_encode($response);
		}
         
      }catch (Exception $e) {
        $returnmsg= 'Caught exception: '.  $e;
        $file = 'log.txt';
        $content = date("l F d-m-Y h:i:s A")." ".$returnmsg.PHP_EOL;
        file_put_contents($file, $content, FILE_APPEND | LOCK_EX);
         echo   $returnmsg;exit();
         $proc_message = "Failed to execute the procedure";
         $response["success"] = 2;
         $response["message"] = $proc_message;
         echo json_encode($response);
    }
}






else if($check == "generate_settle")
{	

	$temp_number = $_GET['temp_number'];
	$branchid = $_GET['branchid'];
	$ds_type = $_GET['discounttype'];
	$ds_id = $_GET['discountid'];
	$dmode=$_GET['discmode'];//"P";
	$mode=$_GET['mode_of_input'];//"CS,TA"
	$loginname=$_GET['loginname'];

	$table_name=$_GET['table'];
	$pax=$_GET['pax'];
	
	$redeem=0;
	$c_name="";
	$c_no="";
	$c_veh_no="";


	$discount_of_or='';
	$discount_unit_or='';
	$discount_or='';
	$discountid_or='';
	if($ds_type=="drop")
	{
		$discount_of_or=0;
		$discount_unit_or="";
		$discount_or="Y";
		$discountid_or=$ds_id;
	}else if($ds_type=="text")
	{
	   $discount_of_or=$ds_id;
		$discount_unit_or=$dmode;
		$discount_or="Y";
		$discountid_or=""; 
	}else if($ds_type=="empty")
	{
		$discount_of_or=0;
		$discount_unit_or="";
		$discount_or="N";
		$discountid_or=""; 
	}



	/*echo 'temp_number: '.$temp_number.',branchid: '.$branchid.',discount_or: '.$discount_or.',discount_of_or: '.$discount_of_or.',discount_unit_or: '.$discount_unit_or.',discountid_or: '.$discountid_or.',loginname: '.$loginname;*/
	
	mysqli_query($localhost,"SET @temp_billno = " . "'" . $temp_number . "'");
	mysqli_query($localhost,"SET @branchid = " . "'" . $branchid . "'");
	mysqli_query($localhost,"SET @discount = " . "'" . $discount_or . "'");
	mysqli_query($localhost,"SET @discount_of = " . "'" . $discount_of_or . "'");
	mysqli_query($localhost,"SET @discount_unit = " . "'" . $discount_unit_or . "'");
	mysqli_query($localhost,"SET @discountid = " . "'" . $discountid_or . "'");
	mysqli_query($localhost,"SET @loginid = " . "'" . $loginname . "'");
	mysqli_query($localhost,"SET @table_name = " . "'" . $table_name . "'");
	mysqli_query($localhost,"SET @pax = " . "'" . $pax . "'");
	mysqli_query($localhost,"SET @redeem = " . "'" . $redeem . "'");
	
	$billnumber='';$kot_number='';$proc_message='';


		
	try
      {

          $result1=mysqli_query($localhost,"CALL proc_gencounter_bill(@temp_billno,@branchid,@discount,@discount_of,@discount_unit,@discountid,@loginid, @table_name,@pax,@redeem,@new_billno,@message)") or throw_ex(mysqli_error($localhost)) ;

      $rs = mysqli_query($localhost,'SELECT @message AS message,@new_billno AS bill_no');
      
      $proc_message = "Failed to execute the procedure";
      while($row = mysqli_fetch_array($rs))
      {
		  $proc_message= $row['message'];
		  $billnumber= $row['bill_no'];
		 
		  

      }
	  
	  
	  $printer_on = "select be_printall from tbl_branchmaster";
	  $result_printer_on = mysqli_query($localhost,$printer_on);
	  if(mysqli_num_rows($result_printer_on)>0)
	  {
		  while($row1 = mysqli_fetch_array($result_printer_on))
		  {
			  $print_all = $row1["be_printall"];
		  }
	  }
	 
		if($proc_message == "Bill generated sucessfully")
		{
			/*$result = mysqli_query($localhost,"UPDATE  `tbl_takeaway_billmaster` set `tab_c_name`='".$c_name."',`tab_c_no`='".$c_no."',`tab_c_veh_no`='".$c_veh_no."' where `tab_billno` = '".$billnumber."'");
*/

			$result = mysqli_query($localhost,"UPDATE  `tbl_takeaway_billmaster` set `tab_c_name`='".$c_name."',`tab_c_no`='".$c_no."',`tab_c_veh_no`='".$c_veh_no."',`tab_no_pax`='".$pax."',`tab_table_no`='".$table_name."' where `tab_billno` = '".$billnumber."'");


			$check_condition_print_bill = "select bsc_bill_before_settle from tbl_branch_settings_counter";
			$result1 = mysqli_query($localhost,$check_condition_print_bill);
	  		if(mysqli_num_rows($result1)>0)
			{
				$msg = "";
				while($row = mysqli_fetch_array($result1))
				{
					$msg = $row["bsc_bill_before_settle"];
				}
				
				$check = "select * FROM tbl_takeaway_billmaster  Where tab_billno = '".$billnumber."' AND (tab_mode_of_entry = 'G')";
				$result2 = mysqli_query($localhost,$check);
				if(mysqli_num_rows($result2)==0)
				{
					if($msg=="Y")
					{

						if($print_all=="Y")
						{
							

							require_once("printer_functions.php");
							$printpage=new PrinterCommonSettings(); 
							$prtck=$printpage->print_bill_ta($billnumber,$mode,$branchid,"android");
							$updateqry="update tbl_takeaway_billmaster set tab_bill_print='Y',tbl_takeaway_printed='Y' where tab_billno='".$billnumber."'";
							mysqli_query($localhost,$updateqry);

						}
					}	
				}
			}
		   $response["success"] = 1;
		   $response["message"] = $proc_message;
		   $response["bill_number_generated"] = $billnumber;
		   echo json_encode($response);
		}
		else if($proc_message == "Bill Not Generated")
		{
		   $response["success"] = 0;
		   $response["message"] = $proc_message;
		   echo json_encode($response);
		}
		else if ($proc_message =="DISCOUNT GIVEN MORE THAN BILL AMOUNT") {
			$response["success"] = 2;
		   $response["message"] = $proc_message;
		   echo json_encode($response);
		}
         
      }catch (Exception $e) {
        $returnmsg= 'Caught exception: '.  $e;
        $file = 'log.txt';
        $content = date("l F d-m-Y h:i:s A")." ".$returnmsg.PHP_EOL;
        file_put_contents($file, $content, FILE_APPEND | LOCK_EX);
         echo   $returnmsg;exit();
         $proc_message = "Failed to execute the procedure";
         $response["success"] = 2;
         $response["message"] = $proc_message;
         echo json_encode($response);
    }
}

else if($check == "generate_settle_new")
{	

	$temp_number = $_GET['temp_number'];
	$branchid = $_GET['branchid'];
	$ds_type = $_GET['discounttype'];
	$ds_id = $_GET['discountid'];
	$dmode=$_GET['discmode'];//"P";
	$mode=$_GET['mode_of_input'];//"CS,TA"
	$loginname=$_GET['loginname'];

	$table_name=$_GET['table'];
	$pax=$_GET['pax'];
	
	$redeem=0;
	$c_name="";
	$c_no="";
	$c_veh_no="";


	$discount_of_or='';
	$discount_unit_or='';
	$discount_or='';
	$discountid_or='';
	if($ds_type=="drop")
	{
		$discount_of_or=0;
		$discount_unit_or="";
		$discount_or="Y";
		$discountid_or=$ds_id;
	}else if($ds_type=="text")
	{
	   $discount_of_or=$ds_id;
		$discount_unit_or=$dmode;
		$discount_or="Y";
		$discountid_or=""; 
	}else if($ds_type=="empty")
	{
		$discount_of_or=0;
		$discount_unit_or="";
		$discount_or="N";
		$discountid_or=""; 
	}



	/*echo 'temp_number: '.$temp_number.',branchid: '.$branchid.',discount_or: '.$discount_or.',discount_of_or: '.$discount_of_or.',discount_unit_or: '.$discount_unit_or.',discountid_or: '.$discountid_or.',loginname: '.$loginname;*/
	
	mysqli_query($localhost,"SET @temp_billno = " . "'" . $temp_number . "'");
	mysqli_query($localhost,"SET @branchid = " . "'" . $branchid . "'");
	mysqli_query($localhost,"SET @discount = " . "'" . $discount_or . "'");
	mysqli_query($localhost,"SET @discount_of = " . "'" . $discount_of_or . "'");
	mysqli_query($localhost,"SET @discount_unit = " . "'" . $discount_unit_or . "'");
	mysqli_query($localhost,"SET @discountid = " . "'" . $discountid_or . "'");
	mysqli_query($localhost,"SET @loginid = " . "'" . $loginname . "'");
	mysqli_query($localhost,"SET @table_name = " . "'" . $table_name . "'");
	mysqli_query($localhost,"SET @pax = " . "'" . $pax . "'");
	mysqli_query($localhost,"SET @redeem = " . "'" . $redeem . "'");
	
	$billnumber='';$kot_number='';$proc_message='';


		
	try
      {

          $result1=mysqli_query($localhost,"CALL proc_gencounter_bill(@temp_billno,@branchid,@discount,@discount_of,@discount_unit,@discountid,@loginid, @table_name,@pax,@redeem,@new_billno,@message)") or throw_ex(mysqli_error($localhost)) ;

      $rs = mysqli_query($localhost,'SELECT @message AS message,@new_billno AS bill_no');
      
      $proc_message = "Failed to execute the procedure";
      while($row = mysqli_fetch_array($rs))
      {
		  $proc_message= $row['message'];
		  $billnumber= $row['bill_no'];
		 
		  

      }
	  
	  
	  $printer_on = "select be_printall from tbl_branchmaster";
	  $result_printer_on = mysqli_query($localhost,$printer_on);
	  if(mysqli_num_rows($result_printer_on)>0)
	  {
		  while($row1 = mysqli_fetch_array($result_printer_on))
		  {
			  $print_all = $row1["be_printall"];
		  }
	  }
	 
		if($proc_message == "Bill generated sucessfully")
		{
			$kot_number="";
		  $s = "select tab_kotno from tbl_takeaway_billmaster where `tab_billno` = '".$billnumber."'";
		  $r = mysqli_query($localhost,$s);
		  if(mysqli_num_rows($r)>0)
		  {
			  while($row1 = mysqli_fetch_array($r))
			  {
				  $kot_number = $row1["tab_kotno"];
				
			  }
		  }

			$result = mysqli_query($localhost,"UPDATE  `tbl_takeaway_billmaster` set `tab_c_name`='".$c_name."',`tab_c_no`='".$c_no."',`tab_c_veh_no`='".$c_veh_no."',`tab_no_pax`='".$pax."',`tab_table_no`='".$table_name."' where `tab_billno` = '".$billnumber."'");


			$check_condition_print_bill = "select bc.bsc_bill_before_settle,bc.bsc_kotprint,b.be_cs_kot_before_settle,b.be_cs_kot_after_settle from tbl_branch_settings_counter bc join tbl_branchmaster b";
			$result1 = mysqli_query($localhost,$check_condition_print_bill);
	  		if(mysqli_num_rows($result1)>0)
			{
				$msg = "";
				while($row = mysqli_fetch_array($result1))
				{
					$bill_before_settle = $row["bsc_bill_before_settle"];
					$kot_before_settle = $row["be_cs_kot_before_settle"];
					$kot_before_settle = $row["be_cs_kot_before_settle"];
					$kot_after_settle = $row["be_cs_kot_after_settle"];
					$kot_print = $row["bsc_kotprint"];
				}
				
				$check = "select * FROM tbl_takeaway_billmaster  Where tab_billno = '".$billnumber."' AND (tab_mode_of_entry = 'G')";
				$result2 = mysqli_query($localhost,$check);
				if(mysqli_num_rows($result2)==0)
				{
					if($print_all=="Y")
					{

						if($bill_before_settle=="Y")
						{
							


							require_once("printer_functions.php");
							$printpage=new PrinterCommonSettings(); 
							$prtck=$printpage->print_bill_ta($billnumber,$mode,$branchid,"android");
							$updateqry="update tbl_takeaway_billmaster set tab_bill_print='Y',tbl_takeaway_printed='Y' where tab_billno='".$billnumber."'";
							mysqli_query($localhost,$updateqry);

						}
					}	
				}
			}
		   $response["success"] = 1;
		   $response["message"] = $proc_message;
		   $response["bill_number_generated"] = $billnumber;
		   $response["kot_number"] = $kot_number;
		   $response["kot_before_settle"] = $kot_before_settle;
		   $response["kot_after_settle"] = $kot_after_settle;
		   $response["kot_print"] = $kot_print;
		   $response["print_all"] = $print_all;
		   echo json_encode($response);
		}
		else if($proc_message == "Bill Not Generated")
		{
		   $response["success"] = 0;
		   $response["message"] = $proc_message;
		   echo json_encode($response);
		}
		else if ($proc_message =="DISCOUNT GIVEN MORE THAN BILL AMOUNT") {
			$response["success"] = 2;
		   $response["message"] = $proc_message;
		   echo json_encode($response);
		}
         
      }catch (Exception $e) {
        $returnmsg= 'Caught exception: '.  $e;
        $file = 'log.txt';
        $content = date("l F d-m-Y h:i:s A")." ".$returnmsg.PHP_EOL;
        file_put_contents($file, $content, FILE_APPEND | LOCK_EX);
         echo   $returnmsg;exit();
         $proc_message = "Failed to execute the procedure";
         $response["success"] = 2;
         $response["message"] = $proc_message;
         echo json_encode($response);
    }
}





else if ($check =="device_print_bill") {
	

		$printer_on = "select be_printall from tbl_branchmaster";
	  $result_printer_on = mysqli_query($localhost,$printer_on);
	  if(mysqli_num_rows($result_printer_on)>0)
	  {
		  while($row1 = mysqli_fetch_array($result_printer_on))
		  {
			  $print_all = $row1["be_printall"];
		  }


	  }
	 
		if($print_all == "Y")
		{
			$check_condition_print_bill = "select bsc_bill_before_settle,bsc_bill_in_hand_device from tbl_branch_settings_counter";
			$result1 = mysqli_query($localhost,$check_condition_print_bill);
	  		if(mysqli_num_rows($result1)>0)
			{
				$msg = "";
				while($row = mysqli_fetch_array($result1))
				{
					$msg = $row["bsc_bill_before_settle"];
					$pd = $row["bsc_bill_in_hand_device"];
				}
				
								$response["success"] = 1;
							   $response["bsc_bill_before_settle"] = $msg;
							   $response["bsc_bill_in_hand_device"] = $pd;
							   
							   echo json_encode($response);
				
			}
		   
		}
		else 
		{
		   						$response["success"] = 0;
							   $response["message"] = "Print All disabled";
							   
							   echo json_encode($response);
		}
}else if ($check =="device_print_kot") {
	

		$printer_on = "select be_printall from tbl_branchmaster";
	  $result_printer_on = mysqli_query($localhost,$printer_on);
	  if(mysqli_num_rows($result_printer_on)>0)
	  {
		  while($row1 = mysqli_fetch_array($result_printer_on))
		  {
			  $print_all = $row1["be_printall"];
		  }


	  }
	 
		if($print_all == "Y")
		{
			$check_condition_print_bill = "select bsc_bill_before_settle,bsc_kot_in_hand_device,bsc_settle_billprint from tbl_branch_settings_counter";
			$result1 = mysqli_query($localhost,$check_condition_print_bill);
	  		if(mysqli_num_rows($result1)>0)
			{
				$msg = "";
				while($row = mysqli_fetch_array($result1))
				{
					
					$pd = $row["bsc_kot_in_hand_device"];
					$msg = $row["bsc_bill_before_settle"];
					$db = $row["bsc_settle_billprint"];
				}
				
								$response["success"] = 1;
							   $response["bsc_kot_in_hand_device"] = $pd;
							   $response["bsc_bill_before_settle"] = $msg;
							   $response["bsc_settle_billprint"] = $db;
							   
							   echo json_encode($response);
					

						
					
					
				
			}
		   
		}
		else 
		{
		   						$response["success"] = 0;
							   $response["message"] = "Print All disabled";
							   
							   echo json_encode($response);
		}
}

else if($check == "billdetails_counter")
{
	$billnumber = $_GET['billnumber'];




	$sqltax="SELECT * from tbl_takeaway_bill_extra_tax_master where tbe_billno='".$billnumber."'";
	$resulttax=mysqli_query($localhost,$sqltax);
	if(mysqli_num_rows($resulttax)>0)
	{
		$response["taxlist"] = array();

		while ($row = mysqli_fetch_array($resulttax)) {
        // temp user array
        $taxlist = array();
        $taxlist["tbe_total_value"] = $row["tbe_total_value"];
        $taxlist["tbe_label"] = $row["tbe_label"];
        
       // push single product into final response array
        array_push($response["taxlist"], $taxlist);
    }


    
	}

	else{
		$response["taxlist"] = array();
	}

	
	$sql = "SELECT * from tbl_takeaway_billmaster where tab_billno='".$billnumber."'";
	$result = mysqli_query($localhost,$sql);
	
	if(mysqli_num_rows($result)>0)
	{
		while($row = mysqli_fetch_array($result))
		{
			$response["tab_subtotal"] = $row["tab_subtotal"];
			$response["tab_discountvalue"] = $row["tab_discountvalue"];
			$response["tab_discount_label"] = $row["tab_discount_label"];
			$response["tab_subtotal_final"] = $row["tab_subtotal_final"];
			$response["tab_total"] = $row["tab_total"];
			$response["tab_roundoff_value"] = $row["tab_roundoff_value"];
			$response["tab_netamt"] = $row["tab_netamt"];
			$response["tab_bill_ref"] = $row["tab_bill_ref"];
			$response["tab_amountpaid"] = $row["tab_amountpaid"];
			$response["tab_amountbalace"] = $row["tab_amountbalace"];
			$response["tab_tips_given"] = $row["tab_tips_given"];
			$response["tab_c_name"] = $row["tab_c_name"];
			$response["tab_c_no"] = $row["tab_c_no"];
			$response["tab_c_veh_no"] = $row["tab_c_veh_no"];
			
		}
		$response["message"] = "ok";
		$response["success"] = 0;
		echo json_encode($response);
	}
	else
	{
		$response["message"] = "fails";
		$response["success"] = 1;
		echo json_encode($response);
	}	
}

else if($check == 'settle_bill_counter')
{
	$bill_number_topass = $_GET['bill_number_topass'];
	$branchid_topass = $_GET['branchid_topass'];	
	$payment_mode_topass = $_GET['payment_mode_topass'];
	$amountpaid_topass = $_GET['amountpaid_topass'];	
	$transaction_amount_topass = $_GET['transaction_amount_topass'];
	$card_bank_topass = $_GET['card_bank_topass'];	
	$complimentary_topass = $_GET['complimentary_topass'];
	$remarks_topass = $_GET['remarks_topass'];	
	$voucherid_topass = $_GET['voucherid_topass'];
	$couponcompany_topass = $_GET['couponcompany_topass'];	
	$coupon_amount_topass = $_GET['coupon_amount_topass'];
	$cheque_no_topass = $_GET['cheque_no_topass'];	
	$cheque_bankname_topass = $_GET['cheque_bankname_topass'];
	$chequeamount_topass = $_GET['chequeamount_topass'];
	$credittypes_topass = $_GET['credittypes_topass'];
	$credit_master_topass = $_GET['credit_master_topass'];
	$credit_amount_topass = $_GET['credit_amount_topass'];
	$balance_amount_topass = $_GET['balance_amount_topass'];
	$complimentary_staffid_topass = $_GET['complimentary_staffid_topass'];
	$mode = $_GET['mode'];
	$login_id = $_GET['login_id'];
	$auth_secretkey = '';
	$auth_staffid = '';
	$credit_remark_cs = '';
	$upiamount=0;
	$upitxnid='';
	$username = $_GET['login_username'];
	
	$kot_number='';$proc_message='';
	$order_confirming_staff="";
	
	mysqli_query($localhost,"SET @billno = " . "'" . $bill_number_topass . "'");
	mysqli_query($localhost,"SET @branchid = " . "'" . $branchid_topass . "'");
	mysqli_query($localhost,"SET @paymodeid = " . "'" . $payment_mode_topass . "'");
	mysqli_query($localhost,"SET @amountpaid = " . "'" . $amountpaid_topass . "'");
	mysqli_query($localhost,"SET @upiamount = " . "'" . $upiamount . "'");
	mysqli_query($localhost,"SET @upitxnid = " . "'" . $upitxnid . "'");
	mysqli_query($localhost,"SET @transactionamount = " . "'" . $transaction_amount_topass . "'");
	mysqli_query($localhost,"SET @card_bank = " . "'" . $card_bank_topass . "'");
	mysqli_query($localhost,"SET @complementary = " . "'" . $complimentary_topass . "'");
	mysqli_query($localhost,"SET @remark = " . "'" . $remarks_topass . "'");
	mysqli_query($localhost,"SET @voucherid = " . "'" . $voucherid_topass . "'");
	mysqli_query($localhost,"SET @couponcompany = " . "'" . $couponcompany_topass . "'");
	mysqli_query($localhost,"SET @couponamt = " . "'" . $coupon_amount_topass . "'");
	mysqli_query($localhost,"SET @chequeno = " . "'" . $cheque_no_topass . "'");
	mysqli_query($localhost,"SET @chequebankname = " . "'" . $cheque_bankname_topass . "'");
	mysqli_query($localhost,"SET @chequeamount = " . "'" . $chequeamount_topass . "'");
	mysqli_query($localhost,"SET @credit = " . "'" . $credittypes_topass . "'");
	mysqli_query($localhost,"SET @creditmasterid = " . "'" . $credit_master_topass . "'");
	mysqli_query($localhost,"SET @creditamount = " . "'" . $credit_amount_topass . "'");
	mysqli_query($localhost,"SET @balanceamt = " . "'" . $balance_amount_topass . "'");
	mysqli_query($localhost,"SET @complementary_staff = " . "'" . $complimentary_staffid_topass . "'");
	mysqli_query($localhost,"SET @mode = " . "'" . $mode . "'");
	mysqli_query($localhost,"SET @auth_secretkey = " . "'" . $auth_secretkey . "'");
	mysqli_query($localhost,"SET @auth_staffid = " . "'" . $auth_staffid . "'");
	mysqli_query($localhost,"SET @auth_loginid = " . "'" . $login_id . "'");
	mysqli_query($localhost,"SET @payment_login = " . "'" . $username . "'");
	mysqli_query($localhost,"SET @credit_remark_cs = " . "'" . $credit_remark_cs . "'");
		mysqli_query($localhost,"SET @order_confirming_staff = " . "'" . $order_confirming_staff . "'");

	


	try
      {  
$result1=mysqli_query($localhost,"CALL proc_gencounter_billsettle_kot(@billno,@branchid,@paymodeid,@amountpaid,@upiamount,@upitxnid,@transactionamount,@card_bank,@complementary,@remark,@voucherid,@couponcompany,@couponamt,@chequeno,@chequebankname,@chequeamount,@credit,@creditmasterid,@creditamount,@balanceamt,@complementary_staff,@mode,@payment_login,@credit_remark_cs,@kotno,@order_confirming_staff,@message)") or throw_ex(mysqli_error($localhost));
		  
			$rs = mysqli_query($localhost, 'SELECT @message AS message,@kotno AS kot_num' );
			$proc_message = "Failed to execute the procedure";
			while($row = mysqli_fetch_array($rs))
			{
				$proc_message = $row['message'];
				$kot_number = $row['kot_num'];
			}  
			  
			if($proc_message == "KOT GENERATED & PAYMENT SUCCESSFUL")
			{
				$check_condition_print_bill = "select bsc_bill_before_settle from tbl_branch_settings_counter";
				$result1 = mysqli_query($localhost,$check_condition_print_bill);
				if(mysqli_num_rows($result1)>0)
				{
					$msg = "";
					while($row = mysqli_fetch_array($result1))
					{
						$msg = $row["bsc_bill_before_settle"];
					}
					$check = "select * FROM tbl_takeaway_billmaster  Where tab_billno = '".$bill_number_topass."' AND (tab_mode_of_entry = 'G')";
					$result2 = mysqli_query($localhost,$check);
					
					if(mysqli_num_rows($result2)==0)
					{
						$cur="";
						$sql_desg_nos1="select * from tbl_dayclose where dc_timeclose IS NULL";//and dc_day ='$dt'
						$sql_desg1  =  mysqli_query($localhost,$sql_desg_nos1);
						$num_desg1  = mysqli_num_rows($sql_desg1);
						if($num_desg1)
						{
							while($result_desg1  = mysqli_fetch_array($sql_desg1)) 
							{
								$cur=$result_desg1['dc_day'];
							}
						}	
						$date = $cur;  
						$kot_or = "select bsc_kotprint from tbl_branch_settings_counter";
						$result3 = mysqli_query($localhost,$kot_or);
						
						if(mysqli_num_rows($result3)>0)
						{
							while($row = mysqli_fetch_array($result3))
							{
								$repl = $row["bsc_kotprint"];
							}
						}
					}	
				}
				
				$response["success"] = 0;
			   	$response["bill_before_settle"] = $msg;
				$response["kot_print_status"] = $repl;
				$response["kot_number"] = $kot_number;
			
			   	echo json_encode($response);
			}
			else
			{
			   $response["success"] = 1;
			   $response["message"] = $proc_message;
			   echo json_encode($response);
			}
		
		}catch (Exception $e) {
        $returnmsg= 'Caught exception: '.  $e;
        $file = 'log.txt';
        $content = date("l F d-m-Y h:i:s A")." ".$returnmsg.PHP_EOL;
        file_put_contents($file, $content, FILE_APPEND | LOCK_EX);
        echo   $returnmsg;exit();
         $proc_message = "Failed to execute the procedure";
         $response["success"] = 2;
         $response["message"] = $proc_message;
         echo json_encode($response);
    }
}


else if($check == "print_kot_ta")
{
	$kot_number = $_GET['kot_number'];
	$branchid_topass = $_GET['branchid'];
	$bill_number_topass = $_GET['bill_number_topass'];
	
	$cur="";
	$sql_desg_nos1="select * from tbl_dayclose where dc_timeclose IS NULL";//and dc_day ='$dt'
	$sql_desg1  =  mysqli_query($localhost,$sql_desg_nos1);
	$num_desg1  = mysqli_num_rows($sql_desg1);
	if($num_desg1)
	{
		while($result_desg1  = mysqli_fetch_array($sql_desg1)) 
		{
			$cur=$result_desg1['dc_day'];
		}
	}		
        
        
        $sql_table_pt="select be_printall from tbl_branchmaster";
	$sql_pt  =  mysqli_query($localhost,$sql_table_pt); 
	$num_pt  = mysqli_num_rows($sql_pt);
	if($num_pt)
	{
		while($result_pt1  = mysqli_fetch_array($sql_pt)) 
		{
                    $print_all=$result_pt1['be_printall'];
                    
                }
                }
        
        
	$date = $cur; 
	$kotprint_tp='';
	$sql_table_pt="select * from tbl_printertype";
	$sql_pt  =  mysqli_query($localhost,$sql_table_pt); 
	$num_pt  = mysqli_num_rows($sql_pt);
	if($num_pt)
	{
		while($result_pt  = mysqli_fetch_array($sql_pt)) 
		{
			if($result_pt['pt_typename']=="KOT Print TA CS")
			{
				$kotprint_tp=$result_pt['pt_id'];
				require_once("printer_functions.php");
				$printpage=new PrinterCommonSettings();
                                
                                if($print_all=='Y'){
				$prtck=$printpage->print_kot_ta($kot_number,$bill_number_topass,$date,$kotprint_tp,$branchid_topass,"android");
                                }
                                
			}
		}
		 $response["success"] = 1;
		 echo json_encode($response);
	}	
}

else if($check == "print_kot_consolidated_ta")
{
	$kot_number = $_GET['kot_number'];
	$branchid_topass = $_GET['branchid'];
	$bill_number_topass = $_GET['bill_number_topass'];
	
	$cur="";
	$sql_desg_nos1="select * from tbl_dayclose where dc_timeclose IS NULL";//and dc_day ='$dt'
	$sql_desg1  =  mysqli_query($localhost,$sql_desg_nos1);
	$num_desg1  = mysqli_num_rows($sql_desg1);
	if($num_desg1)
	{
		while($result_desg1  = mysqli_fetch_array($sql_desg1)) 
		{
			$cur=$result_desg1['dc_day'];
		}
	}		  
	$date = $cur; 
        
         $sql_table_pt="select be_printall from tbl_branchmaster";
	$sql_pt  =  mysqli_query($localhost,$sql_table_pt); 
	$num_pt  = mysqli_num_rows($sql_pt);
	if($num_pt)
	{
		while($result_pt1  = mysqli_fetch_array($sql_pt)) 
		{
                    $print_all=$result_pt1['be_printall'];
                    
                }
                }
	
	$kotprint_tp1='';
	$sql_table_pt1="select * from tbl_printertype";
	$sql_pt1  =  mysqli_query($localhost,$sql_table_pt1); 
	$num_pt1  = mysqli_num_rows($sql_pt1);
	  if($num_pt1)
	  {
		  while($result_pt1  = mysqli_fetch_array($sql_pt1)) 
		  {
			  if($result_pt1['pt_typename']== "Consolidated TA CS")
			  {
				  $kotprint_tp1=$result_pt1['pt_id'];
				  require_once("printer_functions.php");
				  $printpage=new PrinterCommonSettings();
                                  
                                  if($print_all=='Y'){
				  $prtck=$printpage->print_kot_ta_consolidated($kot_number,$bill_number_topass,$date,$kotprint_tp1,$branchid_topass,"android");	  
                                  }
                                  
                                  }
		  }
		  
		   $response["success"] = 1;
		   echo json_encode($response);
	  }		
}


else if($check == "bill_print_ta")
{
	$mode = $_GET['mode'];
	$branchid_topass = $_GET['branchid'];
	$bill_number_topass = $_GET['bill_number_topass'];
	
         $sql_table_pt="select be_printall from tbl_branchmaster";
	$sql_pt  =  mysqli_query($localhost,$sql_table_pt); 
	$num_pt  = mysqli_num_rows($sql_pt);
	if($num_pt)
	{
		while($result_pt1  = mysqli_fetch_array($sql_pt)) 
		{
                    $print_all=$result_pt1['be_printall'];
                    
                }
                }  
        
        
	require_once("printer_functions.php");
	$printpage=new PrinterCommonSettings(); 
        
        if($print_all=='Y'){
	$prtck=$printpage->print_bill_ta($bill_number_topass,$mode,$branchid_topass,"android");		
        }
	   $response["success"] = 1;
		   echo json_encode($response);
}

else if($check == "bill_reprint_cs")
{
	$auth_code = $_GET['auth_code'];
	$staffid = "";
	$sql = "select ser_staffid from tbl_staffmaster where ser_authorisation_code='".$auth_code."'";
	$result = mysqli_query($localhost,$sql);
	if(mysqli_num_rows($result) > 0)
	{
		while($row = mysqli_fetch_array($result))
		{
			$staffid = $row["ser_staffid"];
		}
		
		$tbl = "select ser_bill_reprint_per from tbl_staffmaster where ser_staffid='".$staffid."'";
		$re = mysqli_query($localhost,$tbl);
		if(mysqli_num_rows($re) > 0)
		{
			while($ro = mysqli_fetch_array($re))
			{
				$per = $ro["ser_bill_reprint_per"];
			}
			
			if($per=="Y")
			{
				$mode = $_GET['mode'];
				$branchid_topass = $_GET['branchid'];
				$bill_number_topass = $_GET['bill_number_topass'];

				 $sqlz="UPDATE tbl_takeaway_billmaster set tab_bill_print='Y' where tab_billno='".$bill_number_topass."' ";
				 	$r = mysqli_query($localhost,$sqlz);

				
				require_once("printer_functions.php");
				$printpage=new PrinterCommonSettings(); 
                              
                                
                                 $sql_table_pt="select be_printall from tbl_branchmaster";
	$sql_pt  =  mysqli_query($localhost,$sql_table_pt); 
	$num_pt  = mysqli_num_rows($sql_pt);
	if($num_pt)
	{
		while($result_pt1  = mysqli_fetch_array($sql_pt)) 
		{
                    $print_all=$result_pt1['be_printall'];
                    
                }
                }  
                                
                                if($print_all=='Y'){
				$prtck=$printpage->print_bill_ta($bill_number_topass,$mode,$branchid_topass,"android",'N','N','Y');		
				   $response["success"] = 1;
				   $response["message"] ="Reprint success";
                                }
							
			}
			else{
				$response["message"] = "User dont have permission";
				$response["success"] = 0;
			
			}
		}
	}
	else
	{
		$response["message"] = "User code not available";
		$response["success"] = 0;
		
		
	}	
	echo json_encode($response);
}





else if($check == "gettakeaway_payment")
{
	$staffname = $_GET['staffname'];
	
	$sql = "SELECT u.um_access FROM tbl_usermodules u left join `tbl_modulemaster` mm on mm.mer_moduleid= u.um_moduleid left join tbl_modulesubmaster s on s.mser_submoduleid = u.um_submoduleid where mm.`mer_modulename`='Take Away' and s.`mser_subname`='Payment Pending  TA' and u.um_username= '".$staffname."'";


	$result = mysqli_query($localhost,$sql);
	if(mysqli_num_rows($result) > 0)
	{
		while($row = mysqli_fetch_array($result))
		{
			$response["message"] = "ok";
			$response["success"] = 1;
			if(($row["um_access"] == NULL) || ($row["um_access"]==''))
			{
				$response["payment_option_activated"] = 'N';
			}
			else
			{
				$response["payment_option_activated"] = $row["um_access"];
			}
			echo json_encode($response);
		}
	}
	else
	{
		$response["payment_option_activated"] = 'N';
		$response["message"] = "not";
		$response["success"] = 0;
		echo json_encode($response);
		
	}	
}


else if($check == "getcounter_payment")
{
	$staffname = $_GET['staffname'];
	
	$sql = "SELECT u.um_access FROM tbl_usermodules u left join `tbl_modulemaster` mm on mm.mer_moduleid= u.um_moduleid left join tbl_modulesubmaster s on s.mser_submoduleid = u.um_submoduleid where mm.`mer_modulename`='Counter Sales' and s.`mser_subname`='Payment_settle_cs' and u.um_username= '".$staffname."'";


	$result = mysqli_query($localhost,$sql);
	if(mysqli_num_rows($result) > 0)
	{
		while($row = mysqli_fetch_array($result))
		{
			$response["message"] = "ok";
			$response["success"] = 1;
			if(($row["um_access"] == NULL) || ($row["um_access"]==''))
			{
				$response["payment_option_activated"] = 'N';
			}
			else
			{
				$response["payment_option_activated"] = $row["um_access"];
			}
			echo json_encode($response);
		}
	}
	else
	{
		$response["payment_option_activated"] = 'N';
		$response["message"] = "not";
		$response["success"] = 0;
		echo json_encode($response);
		
	}	
}

else if($check == "waiterlist")
{
	$branchid = $_GET['branchid'];
	
	$sql = "SELECT `ser_staffid`, concat(`ser_firstname`, `ser_lastname`) as name FROM `tbl_staffmaster` WHERE `ser_branchofficeid` = '".$branchid."' and `ser_designation` = 'DES9'";
	
	$result = mysqli_query($localhost,$sql);
	
	if(mysqli_num_rows($result)>0)
	{
		$response["waiter_list"] = array();
	
		while ($row = mysqli_fetch_array($result)) {
			// temp user array
			$submenu = array();
			$submenu["id"] = $row["ser_staffid"];	
			$submenu["name"] = $row["name"];	
			array_push($response["waiter_list"], $submenu);
		}	
		$response["message"] = "success";
		$response["success"] = 1;
		echo json_encode($response);
	}
	else
	{
		$response["message"] = "fails";
		$response["success"] = 0;
		echo json_encode($response);
	}	
}

else if($check == "getAuthorisationMode")
{
	$sql = "select be_app_auth_code from tbl_branchmaster";
	$result = mysqli_query($localhost,$sql);
	$yorn = "";
	if(mysqli_num_rows($result) > 0)
	{
		while($row = mysqli_fetch_array($result))
		{
			$yorn = $row["be_app_auth_code"];
		}
			$response["message"] = "ok";
			$response["success"] = 1;
			$response["auth_code"] = $yorn;
			echo json_encode($response);
	}
	else
	{
		$response["message"] = "not";
		$response["success"] = 0;
		$response["auth_code"] = "N";
		echo json_encode($response);
	}	
}

else if($check == "check_auth_reprint")
{
	$sql = "select an_reprint_auth from tbl_branchsettings_android";
	$result = mysqli_query($localhost,$sql);
	$yorn = "";
	if(mysqli_num_rows($result) > 0)
	{
		while($row = mysqli_fetch_array($result))
		{
			$yorn = $row["an_reprint_auth"];
		}
			$response["message"] = "ok";
			$response["success"] = 1;
			$response["auth_code"] = $yorn;
			echo json_encode($response);
	}
	else
	{
		$response["message"] = "not";
		$response["success"] = 0;
		$response["auth_code"] = "N";
		echo json_encode($response);
	}	
}

else if($check == "check_repirnt_auth")
{
	$sql = "select be_reprint_authorise from  tbl_branchmaster";
	$result = mysqli_query($localhost,$sql);
	$yorn = "";
	if(mysqli_num_rows($result) > 0)
	{
		while($row = mysqli_fetch_array($result))
		{
			$yorn = $row["be_reprint_authorise"];
		}
			$response["message"] = "ok";
			$response["success"] = 1;
			$response["auth_code"] = $yorn;
			echo json_encode($response);
	}
	else
	{
		$response["message"] = "not";
		$response["success"] = 0;
		$response["auth_code"] = "N";
		echo json_encode($response);
	}	
}


else if($check == "check_regenrate_yorn")
{
	$sql = "select be_regenerate_enable  from  tbl_branchmaster";
	$result = mysqli_query($localhost,$sql);
	$yorn = "";
	if(mysqli_num_rows($result) > 0)
	{
		while($row = mysqli_fetch_array($result))
		{
			$yorn = $row["be_regenerate_enable"];
		}
			$response["success"] = 1;
			$response["message"] = $yorn;
			echo json_encode($response);
	}
	else
	{
		$response["success"] = 0;
		$response["message"] = "N";
		echo json_encode($response);
	}	
}


else if($check == "getauthocode_valid")
{
	$auth_code = $_GET['auth_code'];
	$staffid = "";
	$sql = "select ser_staffid from tbl_staffmaster where ser_authorisation_code='".$auth_code."'";
	$result = mysqli_query($localhost,$sql);
	if(mysqli_num_rows($result) > 0)
	{
		while($row = mysqli_fetch_array($result))
		{
			$staffid = $row["ser_staffid"];
		}
		
		$tbl = "select ser_bill_reprint_per from tbl_staffmaster where ser_staffid='".$staffid."'";
		$re = mysqli_query($localhost,$tbl);
		if(mysqli_num_rows($re) > 0)
		{
			while($ro = mysqli_fetch_array($re))
			{
				$per = $ro["ser_bill_reprint_per"];
			}
			
			if($per=="Y")
			{
				$response["message"] = "ok";
				$response["success"] = 0;
				$response["staffid"] = $staffid;
				echo json_encode($response);
			}
			else{
				$response["message"] = "User dont have permission";
				$response["success"] = 1;
				echo json_encode($response);
			}
		}
	}
	else
	{
		$response["message"] = "User code not available";
		$response["success"] = 1;
		echo json_encode($response);
		
	}	
}


else if($check == "getauthocode_valid_regenrate")
{
	$auth_code = $_GET['auth_code'];
	$staffid = "";
	$sql = "select ser_staffid from tbl_staffmaster where ser_authorisation_code='".$auth_code."'";
	$result = mysqli_query($localhost,$sql);
	if(mysqli_num_rows($result) > 0)
	{
		while($row = mysqli_fetch_array($result))
		{
			$staffid = $row["ser_staffid"];
		}
		
		$tbl = "select ser_bill_regen_per from tbl_staffmaster where ser_staffid='".$staffid."'";
		$re = mysqli_query($localhost,$tbl);
		if(mysqli_num_rows($re) > 0)
		{
			while($ro = mysqli_fetch_array($re))
			{
				$per = $ro["ser_bill_regen_per"];
			}
			
			if($per=="Y")
			{
				$response["message"] = "ok";
				$response["success"] = 0;
				$response["staffid"] = $staffid;
				echo json_encode($response);
			}
			else{
				$response["message"] = "User dont have permission";
				$response["success"] = 1;
				echo json_encode($response);
			}
		}
	}
	else
	{
		$response["message"] = "User code not available";
		$response["success"] = 1;
		echo json_encode($response);
		
	}	
}

else if($check == "getauthocode_valid_kot_reprint")
{
	$auth_code = $_GET['auth_code'];
	$staffid = "";
	$sql = "select ser_staffid from tbl_staffmaster where ser_authorisation_code='".$auth_code."'";
	$result = mysqli_query($localhost,$sql);
	if(mysqli_num_rows($result) > 0)
	{
		while($row = mysqli_fetch_array($result))
		{
			$staffid = $row["ser_staffid"];
		}
		
		$tbl = "select ser_kot_reprint_per from tbl_staffmaster where ser_staffid='".$staffid."'";
		$re = mysqli_query($localhost,$tbl);
		if(mysqli_num_rows($re) > 0)
		{
			while($ro = mysqli_fetch_array($re))
			{
				$per = $ro["ser_kot_reprint_per"];
			}
			
			if($per=="Y")
			{
				$response["message"] = "ok";
				$response["success"] = 0;
				$response["staffid"] = $staffid;
				echo json_encode($response);
			}
			else{
				$response["message"] = "User dont have permission";
				$response["success"] = 1;
				echo json_encode($response);
			}
		}
	}
	else
	{
		$response["message"] = "User code not available";
		$response["success"] = 1;
		echo json_encode($response);
		
	}	
}


 
else if($check == "getauthocode_valid_cancel")
{
	$auth_code = $_GET['auth_code'];
	$staffid = "";
	$sql = "select l.ls_username,s.ser_staffid,s.ser_cancelpermission from tbl_staffmaster s  left join `tbl_logindetails` l on s.ser_staffid=l.ls_staffid where s.ser_authorisation_code='".$auth_code."' and s.ser_employeestatus='Active'";
	$result = mysqli_query($localhost,$sql);
	if(mysqli_num_rows($result) > 0)
	{
		while($row = mysqli_fetch_array($result))
		{
			$staffid = $row["ser_staffid"];
			$username = $row["ls_username"];
			$s = $row["ser_cancelpermission"];
		}
		
	/*	$sql1 = "select ser_cancelpermission from tbl_staffmaster where ser_staffid='".$staffid."'";
		$result1 = mysqli_query($localhost,$sql1);
		if(mysqli_num_rows($result1) > 0)
		{
			while($row1 = mysqli_fetch_array($result1))
			{
				$s = $row1["ser_cancelpermission"];
			}*/
			
			if($s=="Y")
			{
				$response["message"] = "ok";
				$response["success"] = 0;
				$response["staffid"] = $staffid;
				$response["username"] = $username;
				echo json_encode($response);
			}
			else{
				$response["message"] = "User dont have the permission";
				$response["success"] = 1;
				echo json_encode($response);
			}
		//}
	}
	else
	{
		$response["message"] = "User code not available";
		$response["success"] = 1;
		echo json_encode($response);
		
	}	
}



else if($check == 'getRegenerate_reasons')
{
	$sql = "select * from tbl_regenerate_reasons WHERE rr_active='Y'";
	
	$result = mysqli_query($localhost,$sql);
	if(mysqli_num_rows($result) >0)
	{
		$response["regenerate_questions"] = array();
		
		while($row = mysqli_fetch_array($result))
		{
			$submenu = array();
			$submenu["reason"] = $row["rr_reason"];
			
			array_push($response["regenerate_questions"], $submenu);
			
		}
		
		$response["message"] = "ok";
    	$response["success"] = 1;
		echo json_encode($response);
	}
	else
	{
		$response["message"] = "no";
    	$response["success"] = 0;
    	echo json_encode($response);
	}
}

else if($check == 'kot_reprint_only')
{
	$kot_id = $_GET['kotnumber'];
	$branchid = $_GET['branchid'];
	$ordernum = $_GET['ordernum'];
	$consolidated = $_GET['consolidated'];
	
	if($kot_id!="")
	{
		$cur="";
		$sql_desg_nos1="select * from tbl_dayclose where dc_timeclose IS NULL";//and dc_day ='$dt'
			  $sql_desg1  =  mysqli_query($localhost,$sql_desg_nos1);
			  $num_desg1  = mysqli_num_rows($sql_desg1);
			  if($num_desg1){
			  while($result_desg1  = mysqli_fetch_array($sql_desg1)) 
				  {
					$cur=$result_desg1['dc_day'];
				  }
			  }
			  
			  $sql_table_pt="select * from tbl_printertype ";
			  $sql_pt  =  mysqli_query($localhost,$sql_table_pt); 
			  $num_pt  = mysqli_num_rows($sql_pt);
			  if($num_pt){
				  while($result_pt  = mysqli_fetch_array($sql_pt)) 
					  {
						  if($result_pt['pt_typename']=="KOT Print")
						  {
							  $kotprint_tp=$result_pt['pt_id'];
						  }
						   if($result_pt['pt_typename']=="Consolidated")
						  {
							  $kotprint_consolidated=$result_pt['pt_id'];
						  }
					  }
			  }
			  
        $sql_table_pt="select be_printall from tbl_branchmaster";
	$sql_pt  =  mysqli_query($localhost,$sql_table_pt); 
	$num_pt  = mysqli_num_rows($sql_pt);
	if($num_pt)
	{
		while($result_pt1  = mysqli_fetch_array($sql_pt)) 
		{
                    $print_all=$result_pt1['be_printall'];
                    
                }
                }  
                          
			require_once("printer_functions.php");
			$printpage=new PrinterCommonSettings(); 
			$prtck=$printpage->print_kot($kot_id,$ordernum,$cur,$kotprint_tp,$branchid,"android");
			
			if($consolidated=="Y")
			{
				//echo $kotprint__consolidated;
				require_once("printer_functions.php");
				$printpage1=new PrinterCommonSettings(); 
                                
                                if($print_all=='Y'){
				   $prtck1=$printpage1->print_kot_consolidated($kot_id,$ordernum,$cur,$kotprint_consolidated,$branchid,"android");
                                }
                                
                        }
	}
	
	$response["result"] = 2;
	$response["rsltmsg"] = "no";
	echo json_encode($response);
	
	
}

else if($check == 'printer_ip_list')
{
	$floor_id = $_GET['floorid'];
	$kot_counter_name = $_GET['kot_counter_name'];
	$branchid = $_GET['branchid'];
	
	$d = str_replace("_","'",$kot_counter_name);

$sql1_printall = mysqli_query($localhost,"select be_printall from tbl_branchmaster where be_branchid='".$branchid."'");
	if (mysqli_num_rows($sql1_printall) > 0) 
	{
		while ($row = mysqli_fetch_array($sql1_printall)) 
		{
			$printerstatus = $row['be_printall'];
		}
	}
	
	

if ($printerstatus=='Y') {

		
	
	
	
	$sql = "select p.`pr_printerip`,p.`pr_usbprinterip`,p.`pr_defaultusb`,c.kr_kotname from tbl_printersettings p left join tbl_kotcountermaster c on p.`pr_kotcode`=c.kr_kotcode 
	where p.`pr_floorid`='".$floor_id."' and p.`pr_enable`='Y' and p.`pr_kotcode` in (".$d .")  group by p.`pr_printerip`";
	

	$result = mysqli_query($localhost,$sql);
	if(mysqli_num_rows($result) >0)
	{
		$response["printer_ip"] = array();
		
		while($row = mysqli_fetch_array($result))
		{
			$submenu = array();

			$pr_defaultusb = $row["pr_defaultusb"];

			if($pr_defaultusb=="Y")	{
				$submenu["ip"] = $row["pr_usbprinterip"];
			}
			else{
				$submenu["ip"] = $row["pr_printerip"];
			}

			$submenu["counter_name"] = $row["kr_kotname"];
			
			
			array_push($response["printer_ip"], $submenu);
			
		}
		
		$response["message"] = "ok";
    	$response["success"] = 1;
		echo json_encode($response);
	}
	else 
	{
		
		$sql = "select p.`pr_usbprinterip`,c.kr_kotname from tbl_printersettings p left join tbl_kotcountermaster c on p.`pr_kotcode`=c.kr_kotcode 
		where p.`pr_floorid`='".$floor_id."' and p.`pr_enable`='Y' and p.`pr_kotcode` in (".$d .") and pr_defaultusb='Y'  group by p.`pr_usbprinterip`";
	
		$result = mysqli_query($localhost,$sql);
		if(mysqli_num_rows($result) >0)
		{
			$response["printer_ip"] = array();
			
			while($row = mysqli_fetch_array($result))
			{
				$submenu = array();
				$submenu["ip"] = $row["pr_usbprinterip"];
				$submenu["counter_name"] = $row["kr_kotname"];
				
				array_push($response["printer_ip"], $submenu);
				
			}
			
			$response["message"] = "ok";
			$response["success"] = 1;
			echo json_encode($response);
			
		}else{
			
			$response["message"] = "no";
			$response["success"] = 0;
			echo json_encode($response);
		}
	}
	}

	else{


			$response["message"] = "no";
			$response["success"] = 3;
			echo json_encode($response);

	}
}



//********************LoadPrinterMaster


else if($check == 'LoadPrinterMaster')
{
	
	
/*	$sql = "select p.`pr_printerip`,p.`pr_usbprinterip`,p.pr_usbprinter,p.`pr_defaultusb`,c.kr_kotname from tbl_printersettings p left join tbl_kotcountermaster c on p.`pr_kotcode`=c.kr_kotcode 
	where p.`pr_enable`='Y' group by p.`pr_printerip`";*/


	$sql = "select p.`pr_printerip`,p.`pr_usbprinterip`,p.`pr_defaultusb`,p.pr_usbprinter,pr_printerport from tbl_printersettings p where p.`pr_enable`='Y' group by p.`pr_printerip`";
	
	

	$result = mysqli_query($localhost,$sql);
	if(mysqli_num_rows($result) >0)
	{
		$response["printer_ip"] = array();
		
		while($row = mysqli_fetch_array($result))
		{
			$submenu = array();

			$pr_defaultusb = $row["pr_defaultusb"];

			if($pr_defaultusb=="Y")	{
				$submenu["ip"] = $row["pr_usbprinterip"];
				$submenu["printer_type"] = "USB";
				$submenu["port"] =  $row["pr_usbprinter"];
			}
			else{
				$submenu["ip"] = $row["pr_printerip"];
				$submenu["printer_type"] = "LAN";
				$submenu["port"] =$row["pr_printerport"];
			}

			
			
			
			array_push($response["printer_ip"], $submenu);
			
		}
		
		$response["message"] = "ok";
    	$response["success"] = 1;
		echo json_encode($response);
	}
	else 
	{
		
		$sql = "select p.`pr_usbprinterip`,c.kr_kotname from tbl_printersettings p left join tbl_kotcountermaster c on p.`pr_kotcode`=c.kr_kotcode 
		where p.`pr_floorid`='".$floor_id."' and p.`pr_enable`='Y' and p.`pr_kotcode` in (".$d .") and pr_defaultusb='Y'  group by p.`pr_usbprinterip`";
	
		$result = mysqli_query($localhost,$sql);
		if(mysqli_num_rows($result) >0)
		{
			$response["printer_ip"] = array();
			
			while($row = mysqli_fetch_array($result))
			{
				$submenu = array();
				$submenu["ip"] = $row["pr_usbprinterip"];
				$submenu["counter_name"] = $row["kr_kotname"];
				
				array_push($response["printer_ip"], $submenu);
				
			}
			
			$response["message"] = "ok";
			$response["success"] = 1;
			echo json_encode($response);
			
		}else{
			
			$response["message"] = "no";
			$response["success"] = 0;
			echo json_encode($response);
		}
	}
}





//////////////////**********end 

else if($check == 'printer_kot_reprint')
{
	$floor_id = $_GET['floorid'];
	$kotnumber = $_GET['kotnumber'];
	$ordernum = $_GET['ordernum'];
	
	$sql = "select pr_printerip , pr_printerport , pr_printername, pr_printertype,usb,usb_status
FROM 
(select p.pr_defaultusb as usb_status,p.pr_usbprinterip as usb,p.pr_printerip AS pr_printerip ,p.pr_printerport AS pr_printerport ,p.pr_printername AS pr_printername,p.pr_printertype AS pr_printertype
from tbl_tableorder t
left join tbl_menumaster m on t.ter_menuid = m.mr_menuid
left join tbl_kotcountermaster k on k.kr_kotcode = m.mr_kotcounter
left join tbl_printersettings p on k.kr_kotcode = p.pr_kotcode
left join tbl_printertype pt ON pt.pt_id = p.pr_printertype
where pt.pt_typename ='KOT Print'  
and p.pr_floorid='".$floor_id."' and  p.pr_enable='Y' and p.pr_defaultusb = 'N' AND t.ter_orderno = '".$ordernum."' AND t.ter_kotno = '".$kotnumber."'
union all 
select p.pr_defaultusb as usb_status,p.pr_usbprinterip as usb,p.pr_printerip AS pr_printerip ,p.pr_printerport AS pr_printerport ,p.pr_printername AS pr_printername,p.pr_printertype AS pr_printertype
from tbl_tableorder t
left join tbl_printersettings p on p.pr_floorid =  t.ter_floorid
left join tbl_printertype pt ON pt.pt_id = p.pr_printertype
where pt.pt_typename='Consolidated'  AND t.ter_kotno = '".$kotnumber."'
and p.pr_floorid='".$floor_id."') d
GROUP BY pr_printerip";

	

	$result = mysqli_query($localhost,$sql);
	if(mysqli_num_rows($result) >0)
	{
		$response["printer_ip"] = array();
		
		while($row = mysqli_fetch_array($result))
		{
			if($row["usb_status"]=='Y'){
			$submenu = array();
			$submenu["ip"] = $row["usb"];
			array_push($response["printer_ip"], $submenu);
			}else
			{
			$submenu = array();
			$submenu["ip"] = $row["pr_printerip"];
			array_push($response["printer_ip"], $submenu);
			}
			
			
		}
		
		$response["message"] = "ok";
    	$response["success"] = 1;
		echo json_encode($response);
	}
	else
	{
		$response["message"] = "no";
    	$response["success"] = 0;
    	echo json_encode($response);
	}
}


else if($check == 'printer_bill_print')
{
	$floor_id = $_GET['floorid'];
	$branchid = $_GET['branchid'];
	

$sql1_printall = mysqli_query($localhost,"select be_printall from tbl_branchmaster where be_branchid='".$branchid."'");
	if (mysqli_num_rows($sql1_printall) > 0) 
	{
		while ($row = mysqli_fetch_array($sql1_printall)) 
		{
			$printerstatus = $row['be_printall'];
		}
	}

	if ($printerstatus=='Y') {

	$sql = "select distinct p.`pr_printerip`,p.`pr_usbprinterip`,p.`pr_defaultusb` from tbl_printersettings p where p.`pr_floorid`='".$floor_id."' and p.`pr_enable`='Y' and p.pr_printertype=2";
	

	$result = mysqli_query($localhost,$sql);
	if(mysqli_num_rows($result) >0)
	{
		$response["printer_ip"] = array();
		
		while($row = mysqli_fetch_array($result))
		{

			$pr_defaultusb=$row["pr_defaultusb"];
			$submenu = array();
			if($pr_defaultusb=="N"){
				$submenu["ip"] = $row["pr_printerip"];
			}
			else{
				$submenu["ip"] = $row["pr_usbprinterip"];
			}
			
				
			array_push($response["printer_ip"], $submenu);
			
		}
		
		$response["message"] = "ok";
    	$response["success"] = 1;
		echo json_encode($response);
	}
	else
	{
		$response["message"] = "no";
    	$response["success"] = 0;
    	echo json_encode($response);
	}
	}else {
		$response["message"] = "no";
    	$response["success"] = 3;
    	echo json_encode($response);
	}

}

else if($check == 'printer_ip_cancel_kot')
{
	$floor_id = $_GET['floorid'];
	$kotnumber = $_GET['kot_counter_name'];
	$ordernum = $_GET['ordernum'];
	
	$d = str_replace("_","'",$kotnumber);
	
	$sql = "select pr_printerip , pr_printerport , pr_printername, pr_printertype,pr_defaultusb,pr_usbprinterip
FROM 
(select p.pr_printerip AS pr_printerip ,p.pr_printerport AS pr_printerport ,p.pr_printername AS pr_printername,p.pr_printertype AS pr_printertype,p.pr_defaultusb AS pr_defaultusb,p.pr_usbprinterip AS pr_usbprinterip
from tbl_tableorder t
left join tbl_menumaster m on t.ter_menuid = m.mr_menuid
left join tbl_kotcountermaster k on k.kr_kotcode = m.mr_kotcounter
left join tbl_printersettings p on k.kr_kotcode = p.pr_kotcode
left join tbl_printertype pt ON pt.pt_id = p.pr_printertype
where pt.pt_typename ='KOT Print'  
and p.pr_floorid='".$floor_id."' and  p.pr_enable='Y' AND t.ter_orderno = '".$ordernum."' AND t.ter_kotno in (".$d .") 
union all 
select p.pr_printerip AS pr_printerip ,p.pr_printerport AS pr_printerport ,p.pr_printername AS pr_printername,p.pr_printertype AS pr_printertype,p.pr_defaultusb AS pr_defaultusb,p.pr_usbprinterip AS pr_usbprinterip
from tbl_tableorder t
left join tbl_printersettings p on p.pr_floorid =  t.ter_floorid
left join tbl_printertype pt ON pt.pt_id = p.pr_printertype
where pt.pt_typename='Consolidated'  AND t.ter_kotno in (".$d .") 
and p.pr_floorid='".$floor_id."') d
GROUP BY pr_printerip";

	

	$result = mysqli_query($localhost,$sql);
	if(mysqli_num_rows($result) >0)
	{
		$response["printer_ip"] = array();
		
		

		while($row = mysqli_fetch_array($result))
		{
			$submenu = array();
			$pr_defaultusb=$row["pr_defaultusb"];

			if($pr_defaultusb=="N"){

				$submenu["ip"] = $row["pr_printerip"];

			}
			else{

				$submenu["ip"] = $row["pr_usbprinterip"];
			}
			array_push($response["printer_ip"], $submenu);
			
		}
		
		$response["message"] = "ok";
    	$response["success"] = 1;
		echo json_encode($response);
	}
	else
	{
		$response["message"] = "no";
    	$response["success"] = 0;
    	echo json_encode($response);
	}
}



else if($check=="check_staff_reprint_permission")
{
	$staffid = $_GET['staffid'];
	
	$tbl = "select ser_bill_reprint_per from tbl_staffmaster where ser_staffid='".$staffid."'";
		$re = mysqli_query($localhost,$tbl);
		if(mysqli_num_rows($re) > 0)
		{
			while($ro = mysqli_fetch_array($re))
			{
				$per = $ro["ser_bill_reprint_per"];
			}
			
			if($per=="Y")
			{
				$response["success"] = 0;
				echo json_encode($response);
			}
			else{
				$response["message"] = "User dont have permission";
				$response["success"] = 1;
				echo json_encode($response);
			}
		}
		else
		{
			$response["success"] = 1;
			$response["message"] = "Staff id not found";
			echo json_encode($response);
		}
}




else if($check == 'table_occupied_or_not')
{
	$table_id = $_GET['table_id'];
	$table_pref = $_GET['prefix'];

	$sql = "select * from tbl_tabledetails where `ts_tableid`='".$table_id."' and ts_tableidprefix='".$table_pref."'";
	$result = mysqli_query($localhost,$sql);
	if(mysqli_num_rows($result) >0)
	{
		while($row = mysqli_fetch_array($result))
		{
			$ordernum = $row["ts_orderno"];
			$status = $row["ts_status"];
			
			if($status!="Billed")
			{
				$tbl = "SELECT GROUP_CONCAT((CONCAT(trim(t.tr_tableno),concat('(',(trim(td.ts_tableidprefix)),')'))) SEPARATOR ',') as list ,
				GROUP_CONCAT((CONCAT(trim(td.ts_tableid))) SEPARATOR ',') as tableid,ts_orderstaff,ts_orderno FROM tbl_tabledetails td LEFT JOIN tbl_tablemaster t on t.tr_tableid = td.ts_tableid 
				where ts_orderno = '".$ordernum."'";
				
				$result1 = mysqli_query($localhost,$tbl);
				if(mysqli_num_rows($result1) >0)
				{
					while($row1 = mysqli_fetch_array($result1))
					{
						$table_name = $row1["list"];
						$table_id = $row1["tableid"];
						$staffid = $row1["ts_orderstaff"];
						$ordernum1 = $row1["ts_orderno"];
						
						$response["message"] = "occupied";
						$response["success"] = 1;
						$response["table_name"] = $table_name;
						$response["table_id"] = $table_id ;
						$response["staffid"] = $staffid;
						$response["ordernum1"] = $ordernum1;
						echo json_encode($response);
					}
				}
			}
			else{
				$response["message"] = "billed";
				$response["success"] = 2;
				echo json_encode($response);
			}	
		}
	}
	else
	{
		$response["message"] = "vaccant";
    	$response["success"] = 0;
    	echo json_encode($response);
	}
}


else if($check == 'gettabel_detials')
{
	$ordernum = $_GET['ordernum'];

	$tbl = "SELECT GROUP_CONCAT((CONCAT(trim(t.tr_tableno),concat('(',(trim(td.ts_tableidprefix)),')'))) SEPARATOR ',') as list ,
			GROUP_CONCAT((CONCAT(trim(td.ts_tableid))) SEPARATOR ',') as tableid,ts_orderstaff,ts_orderno,ts_in_access,ts_machineid FROM tbl_tabledetails td LEFT JOIN tbl_tablemaster t on t.tr_tableid = td.ts_tableid 
			where ts_orderno = '".$ordernum."'";
			
	$result1 = mysqli_query($localhost,$tbl);
	if(mysqli_num_rows($result1) >0)
	{
		while($row1 = mysqli_fetch_array($result1))
		{
			$response["table_name"] = $row1["list"];
			$response["table_id"] = $row1["tableid"];
			$response["staffid"] = $row1["ts_orderstaff"];
			$response["ordernum1"] = $row1["ts_orderno"];
			$response["ts_in_access"] = $row1["ts_in_access"];
			$response["ts_machineid"] = $row1["ts_machineid"];
		}
		$response["message"] = "occupied";
			$response["success"] = 1;
			echo json_encode($response);
	}
}




/*else if($check== 'print_bill_paper')
{
	$billno = $_GET['billno'];
	$branchid = $_GET['branchid'];
	
	// print bill starts

	  require_once("printer_functions.php");
	  $printpage=new PrinterCommonSettings(); 
	  $prtck=$printpage->print_bill($billno,$branchid,"android");
	  
	  
	  
	if($prtck)
	{
 		$response["success"] = 1;
		$response["message"] = "ok";
        echo json_encode($response);
	}else
	{
		$response["success"] = 0;
		$response["message"] = "not";
    	echo json_encode($response);
	}
	
}*/

else if($check== 'print_bill_paper')
{
	$billno = $_GET['billno'];
	$branchid = $_GET['branchid'];

	$result = mysqli_query($localhost,"SELECT be_printall FROM tbl_branchmaster");
	if (mysqli_num_rows($result) > 0) 
	{
		 while ($row = mysqli_fetch_array($result)) {
			 $be_printall= $row["be_printall"];

			 if ($be_printall=='Y')
			 {
			 	  require_once("printer_functions.php");
				  $printpage=new PrinterCommonSettings(); 
				  $prtck=$printpage->print_bill($billno,$branchid,"android","","","Y");
	  
	  
	  
					if($prtck)
					{
				 		$response["success"] = 1;
						$response["message"] = "ok";
				        echo json_encode($response);
					}else
					{
						$response["success"] = 0;
						$response["message"] = "not";
				    	echo json_encode($response);
					}
			}else{
				$response["success"] = 1;
				$response["message"] = "ok";
		        echo json_encode($response);
			}
		 }
	}else
	{
		$response["success"] = 0;
		$response["message"] = "N";
		echo json_encode($response);
	}
	
	// print bill starts

	 
	
}

else if($check == 'bill_settel_cs')
{


	$bill_number_topass = $_GET['bill_number_topass'];
	$branchid_topass = $_GET['branchid_topass'];
	$payment_mode_topass = $_GET['payment_mode_topass'];
	$amountpaid_topass = $_GET['amountpaid_topass'];
	$upiamount=0;
	$upitxnid='';
	$transaction_amount_topass = $_GET['transaction_amount_topass'];
	$card_bank_topass = $_GET['card_bank_topass'];
	$complimentary_topass = $_GET['complimentary_topass'];
	$remarks_topass = $_GET['remarks_topass'];
	$voucherid_topass = $_GET['voucherid_topass'];
	$couponcompany_topass = $_GET['couponcompany_topass'];
	$coupon_amount_topass = $_GET['coupon_amount_topass'];
	$cheque_no_topass = $_GET['cheque_no_topass'];
	$cheque_bankname_topass = $_GET['cheque_bankname_topass'];
	$chequeamount_topass = $_GET['chequeamount_topass'];
	$credittypes_topass = $_GET['credittypes_topass'];
	$credit_master_topass = $_GET['credit_master_topass'];
	$credit_amount_topass = $_GET['credit_amount_topass'];
	$balance_amount_topass = $_GET['balance_amount_topass'];
	$complimentary_staffid_topass = $_GET['complimentary_staffid_topass'];
	$mode = $_GET['mode'];
	$tip_given = $_GET['tip_given'];
	$tip_mode = $_GET['tip_mode'];
	$username = $_GET['login_username'];
	$credit_remark_cs = '';

	if($transaction_amount_topass==""){
		$transaction_amount_topass=0;
	}
	if($card_bank_topass==""){
		$card_bank_topass=0;
	}
	if($coupon_amount_topass==""){
		$coupon_amount_topass=0;
	}

	if($chequeamount_topass==""){
		$chequeamount_topass=0;
	}
	if($credit_amount_topass==""){
		$credit_amount_topass=0;
	}

	if($amountpaid_topass==""){
		$amountpaid_topass=0;
	}

	if($balance_amount_topass==""){
		$balance_amount_topass=0;
	}

	

		/*echo "bill_number_topass: ".$bill_number_topass.",branchid_topass: ".$branchid_topass.",payment_mode_topass: ".$payment_mode_topass.",amountpaid_topass: ".$amountpaid_topass.",upiamount: ".$upiamount.",upitxnid: ".$upitxnid
	.",transaction_amount_topass: ".$transaction_amount_topass.",card_bank_topass: ".$card_bank_topass.",complimentary_topass: ".$complimentary_topass.",remarks_topass: ".$remarks_topass.",voucherid_topass: ".$voucherid_topass.",couponcompany_topass: ".$couponcompany_topass.",coupon_amount_topass: ".
	$coupon_amount_topass.",cheque_no_topass: ".$cheque_no_topass.",cheque_bankname_topass: ".$cheque_bankname_topass.",chequeamount_topass: ".
	$chequeamount_topass.",credittypes_topass: ".$credittypes_topass.",credit_master_topass: ".$credit_master_topass.",credit_amount_topass: ".
	$credit_amount_topass.",balance_amount_topass: ".$balance_amount_topass.",complimentary_staffid_topass: ".$complimentary_staffid_topass.",mode:".$mode.",username: ".$username.",credit_remark_cs: ".$credit_remark_cs.",".$credit_remark_cs;*/
	//echo $credittypes_topass;

	mysqli_query($localhost,"SET @billno = " . "'" . $bill_number_topass . "'");
	mysqli_query($localhost,"SET @branchid = " . "'" . $branchid_topass . "'");
	mysqli_query($localhost,"SET @paymodeid = " . "'" . $payment_mode_topass . "'");
	mysqli_query($localhost,"SET @amountpaid = " . "'" . $amountpaid_topass . "'");
	mysqli_query($localhost,"SET @upiamount = " . "'" . $upiamount . "'");
	mysqli_query($localhost,"SET @upitxnid = " . "'" . $upitxnid . "'");
	mysqli_query($localhost,"SET @transactionamount = " . "'" . $transaction_amount_topass . "'");
	mysqli_query($localhost,"SET @card_bank = " . "'" . $card_bank_topass . "'");
	mysqli_query($localhost,"SET @complementary = " . "'" . $complimentary_topass . "'");
	mysqli_query($localhost,"SET @remark = " . "'" . $remarks_topass . "'");
	mysqli_query($localhost,"SET @voucherid = " . "'" . $voucherid_topass . "'");
	mysqli_query($localhost,"SET @couponcompany = " . "'" . $couponcompany_topass . "'");
	mysqli_query($localhost,"SET @couponamt = " . "'" . $coupon_amount_topass . "'");
	mysqli_query($localhost,"SET @chequeno = " . "'" . $cheque_no_topass . "'");
	mysqli_query($localhost,"SET @chequebankname = " . "'" . $cheque_bankname_topass . "'");
	mysqli_query($localhost,"SET @chequeamount = " . "'" . $chequeamount_topass . "'");
	mysqli_query($localhost,"SET @credit = " . "'" . $credittypes_topass . "'");
	mysqli_query($localhost,"SET @creditmasterid = " . "'" . $credit_master_topass . "'");
	mysqli_query($localhost,"SET @creditamount = " . "'" . $credit_amount_topass . "'");
	mysqli_query($localhost,"SET @balanceamt = " . "'" . $balance_amount_topass . "'");
	mysqli_query($localhost,"SET @complementary_staff = " . "'" . $complimentary_staffid_topass . "'");
	mysqli_query($localhost,"SET @mode = " . "'" . $mode . "'");
	mysqli_query($localhost,"SET @payment_login = " . "'" . $username . "'");
	mysqli_query($localhost,"SET @credit_remark_cs = " . "'" . $credit_remark_cs . "'");
	mysqli_query($localhost,"SET @order_confirming_staff = " . "'" . $username . "'");


	$message = '';
	$s = "Failed to execute the procedure";

	try{

		$result1=mysqli_query($localhost,"CALL proc_gencounter_billsettle_kot(@billno,@branchid,@paymodeid,@amountpaid,@upiamount,@upitxnid,@transactionamount,@card_bank,@complementary,@remark,@voucherid,@couponcompany,@couponamt,@chequeno,@chequebankname,@chequeamount,@credit,@creditmasterid,@creditamount,@balanceamt,@complementary_staff,@mode,@payment_login,@credit_remark_cs,@kotno,@order_confirming_staff,@message)") or throw_ex(mysqli_error($localhost)) ;

		$rs = mysqli_query($localhost, 'SELECT @message AS message,@kotno AS kot_num' );
		$proc_message = "Failed to execute the procedure";
			while($row = mysqli_fetch_array($rs))
			{
				$proc_message = $row['message'];
				$kot_number = $row['kot_num'];

				//echo "kot".$row['kot_num'];
				
			}
			

					
					
					
if($proc_message == "KOT GENERATED & PAYMENT SUCCESSFUL")
			{
				$ttt= "update tbl_takeaway_billmaster SET tab_tips_given ='".$tip_given."', tab_tips_mode='".$tip_mode."' WHERE tab_billno='".$bill_number_topass."'";
					$result5 = mysqli_query($localhost,$ttt);
					
				$check_condition_print_bill = "select bsc_bill_before_settle from tbl_branch_settings_counter";
				$result1 = mysqli_query($localhost,$check_condition_print_bill);
				if(mysqli_num_rows($result1)>0)
				{
					$msg = "";
					while($row = mysqli_fetch_array($result1))
					{
						$msg = $row["bsc_bill_before_settle"];
					}
					$check = "select * FROM tbl_takeaway_billmaster  Where tab_billno = '".$bill_number_topass."' AND (tab_mode_of_entry = 'G')";
					$result2 = mysqli_query($localhost,$check);
					
					
					
					if(mysqli_num_rows($result2)==0)
					{
						$cur="";
						$sql_desg_nos1="select * from tbl_dayclose where dc_timeclose IS NULL";//and dc_day ='$dt'
						$sql_desg1  =  mysqli_query($localhost,$sql_desg_nos1);
						$num_desg1  = mysqli_num_rows($sql_desg1);
						if($num_desg1)
						{
							while($result_desg1  = mysqli_fetch_array($sql_desg1)) 
							{
								$cur=$result_desg1['dc_day'];
							}
						}	
						$date = $cur;  
						$kot_or = "select bc.bsc_kotprint,bc.bsc_settle_billprint,b.be_cs_kot_before_settle,b.be_cs_kot_after_settle from tbl_branch_settings_counter bc join tbl_branchmaster b";


						$result3 = mysqli_query($localhost,$kot_or);
						
						if(mysqli_num_rows($result3)>0)
						{
							while($row = mysqli_fetch_array($result3))
							{
								$repl = $row["bsc_kotprint"];
								$kot_after_settle = $row["be_cs_kot_after_settle"];
								$settle_billprint = $row["bsc_settle_billprint"];
							}
						}
					}	
				}
				
				$response["success"] = 0;
			   	$response["bill_before_settle"] = $msg;
			   	$response["kot_after_settle"] = $kot_after_settle;
				$response["kot_print_status"] = $repl;
				$response["settle_billprint"] = $settle_billprint;
				$response["kot_number"] = $kot_number;
				$response["message"] = $proc_message;


			 echo json_encode($response);
			}
			else
			{
			   $response["success"] = 1;
			   $response["message"] = $proc_message;
			   echo json_encode($response);
			}
			 

	}catch (Exception $e) {
			$returnmsg= 'Caught exception: '.  $e;
			$file = 'log.txt';
			$content = date("l F d-m-Y h:i:s A")." ".$returnmsg.PHP_EOL;
			file_put_contents($file, $content, FILE_APPEND | LOCK_EX);
			 echo   $returnmsg;exit();
			 $proc_message = "Failed to execute the procedure";
			 $response["success"] =1 ;
			 $response["message"] = $proc_message;
			 echo json_encode($response);
		}
}

else if($check == 'consolidated_detials_cs')
{
	$billnumber = $_GET['billnumber'];

		$kot_sql="SELECT tab_kotno,tab_bill_ref,tab_subtotal  FROM `tbl_takeaway_billmaster` WHERE `tab_billno`='".$billnumber."'";

				$result=mysqli_query($localhost,$kot_sql);
			if(mysqli_num_rows($result)>0)
			{
				while ($row1 = mysqli_fetch_array($result)) 
				{

				   $response["kot_no"] = $row1["tab_kotno"];
				   $response["ref_no"] = $row1["tab_bill_ref"];
				   $response["kot_value"] = $row1["tab_subtotal"];
				}
			}




		   
		$sqlco="SELECT p.pm_portionname,td.*,bum.*,tm.*,um.* from tbl_takeaway_billdetails as td LEFT JOIN tbl_menumaster as tm ON td.tab_menuid=tm.mr_menuid LEFT JOIN tbl_base_unit_master as bum ON td.tab_base_unit_id=bum.bu_id LEFT JOIN tbl_unit_master um ON td.tab_unit_id=um.u_id LEFT JOIN tbl_portionmaster p on td.tab_portion=p.pm_id where tab_billno='".$billnumber."' and tab_cancelled='N'";
	
	/*$sqlco="SELECT * from tbl_takeaway_billdetails as td LEFT JOIN tbl_menumaster as tm ON td.tab_menuid=tm.mr_menuid LEFT JOIN tbl_base_unit_master as bum ON td.tab_base_unit_id=bum.bu_id LEFT JOIN tbl_unit_master um ON td.tab_unit_id=um.u_id where tab_billno='".$billnumber."' and tab_cancelled='N'";*/


	$resultco=mysqli_query($localhost,$sqlco);
	if(mysqli_num_rows($resultco)>0)
	{

			

		$response["c_menulist"] = array();

		while ($row = mysqli_fetch_array($resultco)) 
		{
        // temp user array
   			$menulist = array();
    		//$menulist["sl_no"] = $row["tab_slno"];
    	    $menulist["menuname"] = $row["mr_menuname"];
   		    //$menulist["ratetype"] = $row["tab_rate_type"];
   		    //$menulist["unittype"] = $row["tab_unit_type"];
    		//$menulist["portionid"] = $row["tab_portion"];
    		//$menulist["unitweight"] = $row["tab_unit_weight"];
    		$menulist["single_rate"] = $row["tab_rate"];
    		$menulist["total_rate"] = $row["tab_amount"];
    		$menulist["qty"] = $row["tab_qty"];
    		$menulist["preference"] = $row["tab_preferencetext"];

    		if($row["tab_rate_type"]=="Portion"){

    			$menulist["portion_name"] = $row["pm_portionname"];
    		}
    		else
    		{
				if($row["tab_unit_type"]=="Loose")
				{

						$bu_id=$row["tab_unit_weight"];
						
						$bu_name=$row["bu_name"];

						$name="Loose: ".$bu_id." ".$bu_name;
						$menulist["portion_name"] = $name;		
				}
				else{

						$bu_id=$row["tab_unit_weight"];
						
						$u_name=$row["u_name"];

						$name="Packet: ".$bu_id." ".$u_name;
						$menulist["portion_name"] = $name;		
				   }
				}

 				array_push($response["c_menulist"], $menulist);
			}

				// push single product into final response array
			$response["message"] = "ok";
		    $response["success"] = 1;
		   
    	   
    	}

    	else{
    		$response["message"] = "fail";
		    $response["success"] = 0;

    	}

    	 	
		    echo json_encode($response);
    	
  }
   
    

    else if($check == 'bill_details'){

	$billnumber = $_GET['billnumber'];

    $sql = "SELECT * from tbl_takeaway_billdetails where tab_billno='".$billnumber."'";
	$result = mysqli_query($localhost,$sql);
	
	if(mysqli_num_rows($result)>0)
	{
		while($row = mysqli_fetch_array($result))
		{
			$response["tab_menuid"] = $row["tab_menuid"];
			$response["tab_rate_type"] = $row["tab_rate_type"];
			$response["tab_unit_type"] = $row["tab_unit_type"];
			$response["tab_portion"] = $row["tab_portion"];
			$response["tab_unit_weight"] = $row["tab_unit_weight"];
			$response["tab_unit_id"] = $row["tab_unit_id"];
			$response["tab_base_unit_id"] = $row["tab_base_unit_id"];
			$response["tab_base_rate"] = $row["tab_base_rate"];
			$response["tab_qty"] = $row["tab_qty"];
			$response["tab_org_rate"] = $row["tab_org_rate"];
			$response["tab_discount"] = $row["tab_discount"];
			$response["tab_rate"] = $row["tab_rate"];
			$response["tab_qty"] = $row["tab_qty"];
			$response["tab_amount"] = $row["tab_amount"];
			
			
		}
		$response["message"] = "ok";
		$response["success"] = 1;
		echo json_encode($response);
	}
	else
	{
		$response["message"] = "fails";
		$response["success"] = 0;
		echo json_encode($response);
	}	

    }

	
	



else if($check == "lastsynchon")
{
    
    $macid = $_GET['macid'];
    
    $synch_sql = "SELECT as_lastupdated FROM tbl_appmachinedetails WHERE as_appmachineid = '".$macid."'";
    
   
    $result = mysqli_query($localhost,$synch_sql);

     if ($row=mysqli_fetch_array($result)) {
         
       
         
        $response["success"] = 1;
        $response["lastsynch"] = $row["as_lastupdated"];
        // echoing JSON response
        echo json_encode($response);
    } else {
        // no products found
        $response["success"] = 0;
        $response["message"] = "No products found";
         echo json_encode($response);
    }
}




else if($check == "print_in_device")
{
    
    $branchid = $_GET['branchid'];
    
    $sql = "SELECT bsc_kot_in_hand_device,bsc_bill_in_hand_device FROM tbl_branch_settings_counter WHERE bsc_branchid = '".$branchid."'";
    
   
    $result = mysqli_query($localhost,$sql);

     if ($row=mysqli_fetch_array($result)) {
         
       
        $response["success"] = 1;
        $response["bsc_kot_in_hand_device"] = $row["bsc_kot_in_hand_device"];
        $response["bsc_bill_in_hand_device"]=$row["bsc_bill_in_hand_device"];
       
        
    } else {
        $response["success"] = 0;
        	
    }
     echo json_encode($response);
}







else if($check == "bill_history_list"){
    $payment_pending='';
    if($_REQUEST['payment_pending']!=''){
        $payment_pending=" tbm.tab_payment_settled='N' and tbm.tab_status!='Cancelled' and ";
    }
    $bill_history = "select tbm.tab_billno as bill, tbm.tab_date as billdate, tbm.tab_time as billtime, tbm.tab_status as status,tbm.tab_bill_print as billprinted,tbm.tab_netamt as amount, pm.pym_name as paymode 
                    FROM tbl_takeaway_billmaster tbm
                    left join tbl_paymentmode pm on pm.pym_id=tbm.tab_paymode
                    where tbm.tab_mode='CS' and $payment_pending tbm.tab_dayclosedate=(SELECT dc_day FROM tbl_dayclose dc where dc.dc_dateclose IS NULL AND dc.dc_timeclose IS NULL ORDER BY dc.dc_id desc LIMIT 1) and tbm.tab_billno NOT LIKE '%TEMP%' AND tbm.tab_billno NOT LIKE '%HOLD%'
                    order by tbm.tab_date,tbm.tab_time asc;";
    $result_bill_history = mysqli_query($localhost,$bill_history);
	if(mysqli_num_rows($result_bill_history) >0)
	{
		while($row_bill_history = mysqli_fetch_array($result_bill_history))
		{
			$response['BILL_LIST'][$row_bill_history["bill"]]["BILL"] = $row_bill_history["bill"];
                        $response['BILL_LIST'][$row_bill_history["bill"]]["DATE"] = $row_bill_history["billdate"];
                        $response['BILL_LIST'][$row_bill_history["bill"]]["TIME"] = $row_bill_history["billtime"];
                        $response['BILL_LIST'][$row_bill_history["bill"]]["STATUS"] = $row_bill_history["status"];
                        if($row_bill_history["billprinted"]=='Y'){
                            $response['BILL_LIST'][$row_bill_history["bill"]]["BILL_PRINTED"] = 'Printed';
                        }else{
                            $response['BILL_LIST'][$row_bill_history["bill"]]["BILL_PRINTED"] = '';
                        }
                        $response['BILL_LIST'][$row_bill_history["bill"]]["PAYMODE"] = $row_bill_history["paymode"];
                        $response['BILL_LIST'][$row_bill_history["bill"]]["BILL_AMOUNT"] = $row_bill_history["amount"];
                }
        }
echo   json_encode($response);      
}





else if($check == 'bill_detials_cs')
{
	$billnumber = $_GET['billnumber'];
	$branch = $_GET['branch'];

		$kot_sql="SELECT tab_kotno,tab_bill_ref,tab_subtotal,tab_loginid  FROM `tbl_takeaway_billmaster` WHERE `tab_billno`='".$billnumber."'";

				$result=mysqli_query($localhost,$kot_sql);
			if(mysqli_num_rows($result)>0)
			{
				while ($row1 = mysqli_fetch_array($result)) 
				{

				   $response["kot_no"] = $row1["tab_kotno"];
				   $response["ref_no"] = $row1["tab_bill_ref"];
				   $response["kot_value"] = $row1["tab_subtotal"];
				   $response["tab_loginid"] = $row1["tab_loginid"];
				}
			}


$otherlang='';
$sql_branch =  mysqli_query($localhost,"Select * from tbl_branch_settings_printer where bp_branchid='".$branch."'"); 
$num_branch  = mysqli_num_rows($sql_branch);
if($num_branch)
{
	while($result_branch  = mysqli_fetch_array($sql_branch)) 
		{
			 $otherlang=$result_branch['bp_item_other_lang_kot'];
		}
}


		   
		$sqlco="SELECT lm.lm_menu_print,p.pm_portionshortcode,td.*,bum.*,tm.*,um.* from tbl_takeaway_billdetails as td LEFT JOIN tbl_menumaster as tm ON td.tab_menuid=tm.mr_menuid LEFT JOIN tbl_base_unit_master as bum ON td.tab_base_unit_id=bum.bu_id LEFT JOIN tbl_unit_master um ON td.tab_unit_id=um.u_id LEFT JOIN tbl_portionmaster p on td.tab_portion=p.pm_id LEFT JOIN tbl_language_menu_master as lm ON td.tab_menuid=lm.lm_menu_id where tab_billno='".$billnumber."' and tab_cancelled='N' and lm.lm_language_id='2'";

	
	
	/*$sqlco="SELECT * from tbl_takeaway_billdetails as td LEFT JOIN tbl_menumaster as tm ON td.tab_menuid=tm.mr_menuid LEFT JOIN tbl_base_unit_master as bum ON td.tab_base_unit_id=bum.bu_id LEFT JOIN tbl_unit_master um ON td.tab_unit_id=um.u_id where tab_billno='".$billnumber."' and tab_cancelled='N'";*/


	$resultco=mysqli_query($localhost,$sqlco);
	if(mysqli_num_rows($resultco)>0)
	{

			

		$response["c_menulist"] = array();

		while ($row = mysqli_fetch_array($resultco)) 
		{
      
   			$menulist = array();
    		
    	    $menulist["menuname"] = $row["mr_menuname"];
    	    if ($otherlang=="Y") {
	   		    $menulist["lm_menu_print"] = $row["lm_menu_print"];

    	    }
   		    $menulist["single_rate"] = $row["tab_rate"];
    		$menulist["total_rate"] = $row["tab_amount"];
    		$menulist["qty"] = $row["tab_qty"];

    		if($row["tab_rate_type"]=="Portion"){

    			$menulist["portion_name"] = $row["pm_portionshortcode"];
    		}
    		else
    		{
				if($row["tab_unit_type"]=="Loose")
				{

						$bu_id=$row["tab_unit_weight"];
						
						$bu_name=$row["bu_name"];

						$name="Loose: ".$bu_id." ".$bu_name;
						$menulist["portion_name"] = $name;		
				}
				else{

						$bu_id=$row["tab_unit_weight"];
						
						$u_name=$row["u_name"];

						$name="Packet: ".$bu_id." ".$u_name;
						$menulist["portion_name"] = $name;		
				   }
				}

 				array_push($response["c_menulist"], $menulist);
			}

				// push single product into final response array
			$response["message"] = "ok";
		    $response["success"] = 1;
		   
    	   
    	}

    	else{
    		$response["message"] = "fail";
		    $response["success"] = 0;

    	}

    	 	
		    echo json_encode($response);
    	
  }


  elseif ($check == "check_printer_value") {

	
	$branchid = $_GET['branchid'];

	$response["success"]=0;
	$sql1 = mysqli_query($localhost,"SELECT be_android_kotprint,be_android_kot_consolidated FROM tbl_branchmaster where be_branchid='".$branchid."'");
	if (mysqli_num_rows($sql1) > 0) 
	{
		while ($row = mysqli_fetch_array($sql1)) 
		{
			$response["be_android_kotprint"] = $row['be_android_kotprint'];
			$response["be_android_kot_consolidated"] = $row['be_android_kot_consolidated'];
			$response["success"]=1;
		}
	}
	else{

		$response["success"]=0;
	}

	echo json_encode($response);
	
}

  else if ($check == 'bill_cancel_authentication') 
  {


			$staff_pin = $_GET['staff_pin'];
			$billno=$_GET['billno'];
			$cancel_reason=$_GET['cancel_reason'];
			$login_stafff=$_GET['login_stafff'];
			$bm_status=$_GET['bill_status'];
			$bm_total;
			$ser_firstname='';


			//check bill cancel permisssion






			$sql_auth="select ser_bill_cancel_permission,ser_staffid,ser_firstname from tbl_staffmaster where ser_authorisation_code='".$staff_pin."'";


					$result=mysqli_query($localhost,$sql_auth);


					if(mysqli_num_rows($result)>0)
					{
						while ($row1 = mysqli_fetch_array($result)) 
						{

						   $ser_bill_cancel_permission = $row1["ser_bill_cancel_permission"];

						   $ser_staffid= $row1["ser_staffid"];
						    $ser_firstname= $row1["ser_firstname"];


						  // echo $ser_bill_cancel_permission;




						   if ($ser_bill_cancel_permission=='Y') 
						   {

									   	$response["message"] = "Permisssion granted";
							    		$response["success"] = 0;


							    				//cancel bill
							    		  $credit_amount= 0;
					       				  $credit_id= '';

					       				 
					       				  $sql_status="select bm_status,bm_total from tbl_tablebillmaster Where bm_billno='".$billno."'";
					       				    $result_select=mysqli_query($localhost,$sql_status);


					       				
										  if(mysqli_num_rows($result_select)>0)
											{

												while ($row = mysqli_fetch_array($result_select)) 
						                         {
						                            $bm_status= $row['bm_status'];
													$bm_total= $row['bm_total'];
						                            
						                          }


						                         if ($bm_status=='Cancelled') {
						                         	$response["message"] = "Bill already cancelled";
							    				   $response["success"] = 0;
						                         }else{
												 $sql_change_status="Update tbl_tablebillmaster set bm_status='Cancelled' Where bm_billno='".$billno."'";
					       				         $result3=mysqli_query($localhost,$sql_change_status);


												 $sql_update_table_order="Update tbl_tableorder set ter_status='Cancelled' Where ter_billnumber='".$billno."'";

					       				       $result4=mysqli_query($localhost,$sql_update_table_order);


					       				        $sql_update_bill_details="Update tbl_tablebilldetails set bd_cancelled='Y' Where bd_billno='".$billno."'";

					       				       $result5=mysqli_query($localhost,$sql_update_bill_details);


					       				         $sql_update_cancel_reason="Update tbl_tablebillmaster set 	ter_cancelledreason='".$cancel_reason."',ter_cancelledby_careof='".$ser_staffid."',ter_cancelledsecretkey='".$staff_pin."',ter_cancelledlogin='".$login_stafff."' Where bm_billno='".$billno."'";



					       				       $result5=mysqli_query($localhost,$sql_update_cancel_reason);

					       				       $response["message"] = "Bill cancelled";
							    				$response["success"] = 1;
					       				       					





					       				       				if ($bm_status=='Closed') 
					       				       				{


					       				       					  $response["message"] = "Failed to  cancel";
							    									$response["success"] = 0;


					       				       						$sql_cd  ="SELECT  cd_amount, cd_masterid FROM tbl_credit_details WHERE  cd_billno='".$billno."'"; 

															        $resultcd=mysqli_query($localhost,$sql_cd);


																	 if(mysqli_num_rows($resultcd)>0)
															        
															        {
															               // while($row = mysqli_fetch_array($sql_listall))
															        	     while ($row = mysqli_fetch_array($resultcd)) 
															                      {
																                      $credit_amount= $row['cd_amount'];
																                      $credit_id= $row['cd_masterid'];
															                      }

																               $sql_update_cm  = "update tbl_credit_master set crd_totalamount= crd_totalamount-$credit_amount where crd_id='".$credit_id."' "; 

																               $result_update=mysqli_query($localhost,$sql_update_cm);        
															        }


															        	$sql_delete  =  "delete from tbl_credit_details  where  cd_billno='".$billno."' ";
															 			$result_delete=mysqli_query($localhost,$sql_delete); 
															 			$response["message"] = "Bill cancelled";
							    										$response["success"] = 1;
					       				       					
					       				       				}
					       				       			}

															 



							}
							else{

										$response["message"] = "No such bill";
										$response["success"] = 0;
								  }



				}
				else{
						   	$response["message"] = "No permisssion";
				    		$response["success"] = 0;
					  }
			}
			}else{

							


				    		//check no popup condition


				    		if ($staff_pin=='') 
				    		{
							
								 $ser_staffid= Null;

								 //cancel bill











	  $credit_amount= 0;
					       				  $credit_id= '';

					       				 
					       				  $sql_status="select bm_status,bm_total from tbl_tablebillmaster Where bm_billno='".$billno."'";
					       				    $result_select=mysqli_query($localhost,$sql_status);


					       				
										  if(mysqli_num_rows($result_select)>0)
											{

												while ($row = mysqli_fetch_array($result_select)) 
						                         {
						                            $bm_status= $row['bm_status'];
						                            $bm_total= $row['bm_total'];
						                            
						                          }


						                         if ($bm_status=='Cancelled') {
						                         	$response["message"] = "Bill already cancelled";
							    				   $response["success"] = 0;
						                         }else{
												 $sql_change_status="Update tbl_tablebillmaster set bm_status='Cancelled' Where bm_billno='".$billno."'";
					       				         $result3=mysqli_query($localhost,$sql_change_status);


												 $sql_update_table_order="Update tbl_tableorder set ter_status='Cancelled' Where ter_billnumber='".$billno."'";

					       				       $result4=mysqli_query($localhost,$sql_update_table_order);


					       				        $sql_update_bill_details="Update tbl_tablebilldetails set bd_cancelled='Y' Where bd_billno='".$billno."'";

					       				       $result5=mysqli_query($localhost,$sql_update_bill_details);


					       				         $sql_update_cancel_reason="Update tbl_tablebillmaster set 	ter_cancelledreason='".$cancel_reason."',ter_cancelledby_careof='".$ser_staffid."',ter_cancelledsecretkey='".$staff_pin."',ter_cancelledlogin='".$login_stafff."' Where bm_billno='".$billno."'";



					       				       $result5=mysqli_query($localhost,$sql_update_cancel_reason);

					       				       $response["message"] = "Bill cancelled";
							    				$response["success"] = 1;
					       				       					





					       				       				if ($bm_status=='Closed') 
					       				       				{


					       				       					  $response["message"] = "Failed to  cancel";
							    									$response["success"] = 0;


					       				       						$sql_cd  ="SELECT  cd_amount, cd_masterid FROM tbl_credit_details WHERE  cd_billno='".$billno."'"; 

															        $resultcd=mysqli_query($localhost,$sql_cd);


																	 if(mysqli_num_rows($resultcd)>0)
															        
															        {
															               // while($row = mysqli_fetch_array($sql_listall))
															        	     while ($row = mysqli_fetch_array($resultcd)) 
															                      {
																                      $credit_amount= $row['cd_amount'];
																                      $credit_id= $row['cd_masterid'];
															                      }

																               $sql_update_cm  = "update tbl_credit_master set crd_totalamount= crd_totalamount-$credit_amount where crd_id='".$credit_id."' "; 

																               $result_update=mysqli_query($localhost,$sql_update_cm);        
															        }


															        	$sql_delete  =  "delete from tbl_credit_details  where  cd_billno='".$billno."' ";
															 			$result_delete=mysqli_query($localhost,$sql_delete); 
															 			$response["message"] = "Bill cancelled";
							    										$response["success"] = 1;
					       				       					
					       				       				}
					       				       			}

															 



							}
							else{

										$response["message"] = "No such bill";
										$response["success"] = 0;
								  }

















								 






							//staffpin	
							}
							else{
								$response["message"] = "No user found";
				    			$response["success"] = 0;
							}









					}


if ($response["success"] ==1) {
$date_nw_nw=date('Y-m-d h:i:s');
$dt= date("Y-m-d H:i:s");
 $dt1=date("Y-m-d");


  $detail=" Bill no:$billno <br> . Cancelled by: $ser_firstname <br>. Cancelled time:$dt <br>. Cancelled reason:$cancel_reason<br>. Bill amount:$bm_total ";
 // echo $detail;
        
     $sql_cancel_log="INSERT INTO tbl_billcancel_log(bc_billno,bc_date, bc_details, bc_datetime, bc_sms_time, bc_email_time) VALUES ('$billno','$dt1','$detail','$dt','$date_nw_nw','$date_nw_nw')"; 



}
 
echo json_encode($response);
}

 else if ($check == 'test_print') 
  {
     require_once("Escpos.php");
     
             $a=$_GET['print_ip'];
             $b=$_GET['print_port'];
           
      if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
                          exec("ping -n 1 -w 1 ".$a, $output, $result);              
                           
                   
                         } else if (strtoupper(substr(PHP_OS, 0, 3)) === 'LIN')
                               {
                            exec("ping -c 1 -w 1 ".$a, $output, $result);
                               

                        }
             
                                   if ($result == 0)
                                    {
             require_once("Escpos.php");
             $printers='';
             
             if($b=='9100'){
	 $connector = new NetworkPrintConnector($a, $b);
         $printers = new Escpos($connector);	
             }else{
                $printer="\\\\".$a."\\".$b;
		$connector = new FilePrintConnector($printer);
		$printers = new Escpos($connector); 
             }
         
	$printers -> setJustification(Escpos::JUSTIFY_CENTER);
	$printers -> selectPrintMode(Escpos::MODE_DOUBLE_HEIGHT);
	$printers -> selectPrintMode(Escpos::MODE_DOUBLE_WIDTH);
	$printers -> setEmphasis(true);
	$printers -> setTextSize(2,2);
	$printers -> text('Test print');
        
								$printers -> setEmphasis(true);
								$printers -> setFont(Escpos::FONT_A);
								$printers -> setJustification(Escpos::JUSTIFY_LEFT);
								$printers -> selectPrintMode(Escpos::MODE_DOUBLE_HEIGHT);
								$printers -> feed();
                                                                
								$printers -> setEmphasis(true);
								$printers -> setFont(Escpos::FONT_A);
								$printers -> setJustification(Escpos::JUSTIFY_LEFT);
								$printers -> selectPrintMode(Escpos::MODE_DOUBLE_HEIGHT);
								$printers -> feed();
                                                                $printers -> text('TEST IP:  '.$a);
        
								   
       
	$printers -> setTextSize(1, 2);
	$printers -> selectPrintMode();
	$printers -> feed();
	$printers -> cut();
	$printers -> close();		
         
         
           $response['msg']='OK';
            echo json_encode($response);
         
                                    }
 else {
     $response['msg']='NOT_OK';
            echo json_encode($response);
             
         }
     
  }


else if ($check == "counter_bills") {

	$dayclodedate=$_GET['dayclodedate'];
	$mode =$_GET['mode'];
		// $sql = "Select distinct(tb.tab_billno) as billnumber,tb.tab_time as time,tb.tab_netamt as amount from tbl_takeaway_billmaster as tb LEFT JOIN tbl_takeaway_customer ts ON ts.tac_customerid=tb.tab_hdcustomerid where tb.tab_dayclosedate ='".$dayclodedate."' and (tb.tab_payment_settled = 'N') and (tb.tab_mode='".$mode."') and tb.tab_billno not like 'Temp%' and tb.tab_netamt>0 and tb.tab_status='Bill_Generated' order by tb.tab_time DESC ";

if($mode=="TA"){
	$sql = "Select distinct(tb.tab_billno) as billnumber,tb.tab_time as time,tb.tab_total as amount from tbl_takeaway_billmaster as tb LEFT JOIN tbl_takeaway_customer ts ON ts.tac_customerid=tb.tab_hdcustomerid where tb.tab_dayclosedate ='".$dayclodedate."' and (tb.tab_payment_settled = 'N') and (tb.tab_mode='".$mode."')and tb.tab_billno not like 'Temp%' and tb.tab_netamt>0 and (tb.tab_status='Bill_Generated' or tb.tab_status='Kot_Generated' or tb.tab_status='Processing') order by tb.tab_dayclosedate,tb.tab_time DESC ";
}else{
		$sql = "Select distinct(tb.tab_billno) as billnumber,tb.tab_time as time,tb.tab_total as amount from tbl_takeaway_billmaster as tb LEFT JOIN tbl_takeaway_customer ts ON ts.tac_customerid=tb.tab_hdcustomerid where tb.tab_dayclosedate ='".$dayclodedate."' and (tb.tab_payment_settled = 'N') and (tb.tab_mode='".$mode."')and tb.tab_billno not like 'Temp%' and tb.tab_netamt>0 and (tb.tab_status='Bill_Generated' or tb.tab_status='Closed') order by tb.tab_dayclosedate,tb.tab_time DESC ";
}
// echo $sql;
	 $result = mysqli_query($localhost,$sql);


	 if (mysqli_num_rows($result)>0) 
	 {


		$response["success"]=1;
		$response["bill_list"] = array();

		while($row_bill=mysqli_fetch_array($result))
		{

			$subarray=array();
			$subarray["billno"]=$row_bill["billnumber"];
			$subarray["time"]=$row_bill["time"];
			$subarray["amount"]=$row_bill["amount"];
	        array_push($response["bill_list"],$subarray);


		}
	

	 }else{
	 	$response["success"]=0;
	 }
	 echo json_encode($response);



}




else if ($check == "counter_setteled_bills") {

	
	$mode =$_GET['mode'];
	if($mode=="TA"){
			$sql = "Select distinct(tb.tab_billno) as billnumber,tb.tab_dayclosedate as date,tb.tab_status as status,tb.tab_netamt as amount from tbl_takeaway_billmaster as tb LEFT JOIN tbl_takeaway_customer ts ON ts.tac_customerid=tb.tab_hdcustomerid where (tb.tab_mode='".$mode."')and (tb.tab_status='Bill_Generated' or tb.tab_status='Generated' or tb.tab_status='Processing')  order by tb.tab_dayclosedate DESC ";

	}else{

	/*$sql = "Select distinct(tb.tab_billno) as billnumber,tb.tab_time as time,tb.tab_netamt as amount from tbl_takeaway_billmaster as tb LEFT JOIN tbl_takeaway_customer ts ON ts.tac_customerid=tb.tab_hdcustomerid where tb.tab_dayclosedate ='".$dayclodedate."' and (tb.tab_mode='CS') and tb.tab_billno not like 'Temp%' and tb.tab_netamt>0 order by tb.tab_time DESC ";*/

	$sql = "Select distinct(tb.tab_billno) as billnumber,tb.tab_dayclosedate as date,tb.tab_status as status,tb.tab_netamt as amount from tbl_takeaway_billmaster as tb LEFT JOIN tbl_takeaway_customer ts ON ts.tac_customerid=tb.tab_hdcustomerid where (tb.tab_mode='".$mode."') and (tb.tab_status='Bill_Generated' or tb.tab_status='Generated' ) and tb.tab_billno not like 'Temp%' order by tb.tab_dayclosedate DESC ";
	}
	// echo $sql;
	 $result = mysqli_query($localhost,$sql);


	 if (mysqli_num_rows($result)>0) 
	 {


		$response["success"]=1;
		$response["bill_list"] = array();

		while($row_bill=mysqli_fetch_array($result))
		{

			$subarray=array();
			$subarray["billno"]=$row_bill["billnumber"];
			$subarray["date"]=$row_bill["date"];
			$subarray["amount"]=$row_bill["amount"];
			$subarray["status"]=$row_bill["status"];
	        array_push($response["bill_list"],$subarray);


		}
	

	 }else{
	 	$response["success"]=0;
	 }
	 echo json_encode($response);



}



else if($check == "getCustomerInfo"){
	 $mobile=$_REQUEST['mobile'];
    $sql_customer_info =  "select * from tbl_takeaway_customer where tac_contactno = '".$mobile."' "; 
	$result = mysqli_query($localhost,$sql_customer_info);
	if(mysqli_num_rows($result) > 0)
	{
	while ($row = mysqli_fetch_array($result)) {
			$response["success"] = 1;
		//	$response["id"] = $row["tac_customerid"];
		//	$response["name"] = $row["tac_customername"];
		//	$response["address"] = $row["tac_address"];
			$response["contactno"] = $row["tac_contactno"];
			
			$response["id"] = $row["tac_customerid"];
			$response["name"] = $row["tac_customername"];
            $response["address"] = $row["tac_address"];
            $response["landmark"] = $row["tac_landmark"];
            $response["area"] = $row["tac_area"];
            $response["per_adddress"] = $row["tac_per_address"];
				echo json_encode($response);

	}
	}else{
		$response["success"] = 0;
		echo json_encode($response);
	}
	
}
else if($check == "getCustomerContact"){
	 $mobile=$_REQUEST['mobile'];
    $sql_customer_info =  "select * from tbl_takeaway_customer where tac_contactno LIKE '%".$mobile."%' "; 
	$result = mysqli_query($localhost,$sql_customer_info);
	 if (mysqli_num_rows($result) > 0) {

		$response["contact_no"] = array();
		
		while ($row = mysqli_fetch_array($result)) {
			// temp user array

			$table = array();
			
            $table["contactno"] = $row["tac_contactno"];

	
			array_push($response["contact_no"], $table);
		}
		// success
		$response["success"] = 1;
		$response["message"] = "found";
		// echoing JSON response
		echo json_encode($response);
	} else {
		// no partner found
		$response["success"] = 0;
		$response["message"] = "No contact found";
	
		// echo no users JSON
		echo json_encode($response);
	}
	
}




function throw_ex($er){  
	  throw new Exception($er);  
	} 


?>