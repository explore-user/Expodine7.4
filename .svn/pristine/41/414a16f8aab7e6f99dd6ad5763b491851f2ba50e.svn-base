<?php
include("appdbconnection.php"); 
date_default_timezone_set("Asia/Kolkata");
$check = $_GET['check_value']; 


if($check=="branch_details")
{
	$branchid = $_GET["branchid"];
	$sql = "SELECT `be_branchname` FROM `tbl_branchmaster` WHERE `be_branchid`='".$branchid."'";
	$result = mysqli_query($localhost,$sql);
	if(mysqli_num_rows($result) > 0)
	{
		while ($row = mysqli_fetch_array($result)) 
		{
			$response["success"] = 1;
			$response["branchname"] = $row["be_branchname"];
			echo json_encode($response);
		}
	}
	else
	{
		$response["success"] = 0;
		$response["branchname"] = "Branch name is not defined in database";
		echo json_encode($response);
	}
}

else if($check=="getDate")
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
	
	$sql = "select b.be_androdilogin,b.be_andr_default_login,l.ls_password  from tbl_branchmaster b left join tbl_logindetails l on l.ls_username = b.be_andr_default_login  WHERE b.be_branchid = '".$branchid."'";
 	
	$result = mysqli_query($localhost,$sql);
	if (mysqli_num_rows($result) > 0) 
	{
		 while ($row = mysqli_fetch_array($result)) {
			 $response["success"] = 1;
			 $response["andr_default_password"] = $row["ls_password"];
			 $response["flr_androdilogin"] = $row["be_androdilogin"];
			 $response["flr_andr_default_user_name"] = $row["be_andr_default_login"];
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

else if($check == "kot_counter_details")
{
	$branchid = $_GET['branchid'];
	
	$sql = "select * from tbl_kotcountermaster where kr_branchid = '".$branchid."'";
	
	$result = mysqli_query($localhost,$sql);
	
	if(mysqli_num_rows($result)>0)
	{
		$response["counter_list"] = array();
		while($row = mysqli_fetch_array($result))
		{
			$detail = array();
			$detail["counter_id"] = $row["kr_kotcode"];
			$detail["counter_name"] = $row["kr_kotname"];
			$detail["counter_branchid"] = $row["kr_branchid"];
						
		 	array_push($response["counter_list"], $detail);
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

else if($check == "insert_mac")
{
	$machid = $_GET['machid'];
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


else if($check == "updatemacsynch")
{
	$machid = $_GET['machid'];
	$sql = "update `tbl_appmachinedetails` set as_appmachiesych='N' WHERE as_appmachineid = '".$machid."'";
		
	$result = mysqli_query($localhost,$sql);
	$response["message"] = "ok";
	$response["success"] = 1;
	echo json_encode($response);
	
}

else if($check == "take_kot_details")
{
	$counterid = $_GET['counter_id'];	
	$sql = '';
	$countervalues = '';
	
	if(($counterid=="") || ($counterid==NULL))
	{
		$sql = "SELECT b.tab_slno,b.tab_billno,m.mr_menuname,p.pm_portionname,b.tab_qty,b.tab_preferencetext,b.tab_status FROM tbl_takeaway_billdetails b left join tbl_menumaster m on m.mr_menuid = b.`tab_menuid` left join tbl_portionmaster p on p.pm_id = b.`tab_portion` left join tbl_takeaway_billmaster t on t.tab_billno = b.tab_billno where b.tab_status <> 'Cancelled' and b.tab_status = 'Processing'
 order by b.tab_entrytime ASC";
	}
	else
	{
		$sql = "SELECT b.tab_slno,b.tab_billno,m.mr_menuname,p.pm_portionname,b.tab_qty,b.tab_preferencetext,b.tab_status FROM tbl_takeaway_billdetails b left join tbl_menumaster m on m.mr_menuid = b.`tab_menuid` left join tbl_portionmaster p on p.pm_id = b.`tab_portion` left join tbl_takeaway_billmaster t on t.tab_billno = b.tab_billno where b.tab_status <> 'Cancelled' and b.tab_status = 'Processing'
 and ";
		
		$splitedValues = explode(",",$counterid);
		$len = count($splitedValues);
		$countervalues = "(m.mr_kotcounter="."'".$splitedValues[0]."'";
		
		for($i=1;$i<$len;$i++)
		{
			$countervalues = $countervalues." or m.mr_kotcounter="."'".$splitedValues[$i]."'";
		}
		  
		$countervalues = $countervalues.")";
		
		$sql = $sql.$countervalues." order by b.tab_entrytime ASC";
		
	}

	
	$result = mysqli_query($localhost,$sql);
	
	if(mysqli_num_rows($result)>0)
	{
		$response["ta_kot_details"] = array();
		while($row = mysqli_fetch_assoc($result))
		{
			$detail = array();
			$detail["sl_num"] = $row["tab_slno"];
			$detail["bill_number"] = $row["tab_billno"];
			$detail["menu_name"] = $row["mr_menuname"];
			$detail["portion"] = $row["pm_portionname"];
			$detail["qty"] = $row["tab_qty"];
			$detail["preference"] = $row["tab_preferencetext"];
			$detail["status"] = $row["tab_status"];
			
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


else if($check == "ta_change_status")
{
	$slnum = $_GET['slnum'];
	$billnum = $_GET['bill_Number'];
	$status = $_GET['status'];
	
	$sql = "UPDATE `tbl_takeaway_billdetails` SET `tab_status`='".$status."' WHERE `tab_slno`= '".$slnum."' and tab_billno = '".$billnum."'";
	$result = mysqli_query($localhost,$sql);
	if($result)
	{
		$response["message"] = "ok";
		$response["success"] = 1;
		echo json_encode($response);
	}else{
		$response["message"] = "fails";
		$response["success"] = 10;
		echo json_encode($response);
	}
}


else if($check == "ta_all_status")
{
	$billnum = $_GET['bill_Number'];
	$status = $_GET['status'];
	
	$sql = "UPDATE `tbl_takeaway_billdetails` SET `tab_status`='".$status."' WHERE tab_billno = '".$billnum."'";
	$result = mysqli_query($localhost,$sql);
	if($result)
	{
		$response["message"] = "ok";
		$response["success"] = 1;
		echo json_encode($response);
	}else{
		$response["message"] = "fails";
		$response["success"] = 10;
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
		$response["success"] = 10;
		$response["message"] = "NO";
    	echo json_encode($response);
	}
	
}

else if($check == "pkg_details")
{
	$sql = "SELECT tb.tab_billno,tb.tab_time FROM tbl_takeaway_billmaster tb left join tbl_takeaway_billdetails tbd on tb.tab_billno = tbd.tab_billno where ((tbd.tab_status != 'KOT_Generated') && (tbd.tab_status != 'Closed') && (tbd.tab_status != 'Delivered')) and tb.tab_billno not like 'Temp%' group by tb.tab_billno";
	
	$result = mysqli_query($localhost,$sql);
	
	if(mysqli_num_rows($result)>0)
	{
		$response["billnumber"] = array();
		while($row = mysqli_fetch_array($result))
		{
			$detail = array();
			$detail["tab_billno"] = $row["tab_billno"];
		 	$detail["tab_time"] = $row["tab_time"];		
		
			$sql1 = "SELECT count(*) as processing_items, tb.tab_billno,tb.tab_time FROM tbl_takeaway_billmaster tb left join tbl_takeaway_billdetails tbd on tb.tab_billno = tbd.tab_billno where tbd.tab_status = 'Processing' and tb.tab_billno ='".$row["tab_billno"]."'";
	
			$sql2 = "SELECT count(*) as ready_items, tb.tab_billno,tb.tab_time FROM tbl_takeaway_billmaster tb left join tbl_takeaway_billdetails tbd on tb.tab_billno = tbd.tab_billno where tbd.tab_status = 'Ready' and tb.tab_billno ='".$row["tab_billno"]."'";
	
			$result1 = mysqli_query($localhost,$sql1);
			$result2 = mysqli_query($localhost,$sql2);
			
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

else if($check == "statusdetails")
{
	$billnum = $_GET['billnumber'];
	
	$sql = "SELECT count(*) as processing_items, tb.tab_billno,tb.tab_time FROM tbl_takeaway_billmaster tb left join tbl_takeaway_billdetails tbd on tb.tab_billno = tbd.tab_billno where tbd.tab_status = 'Processing' and tb.tab_billno ='".$billnum."'";
	
	$sql1 = "SELECT count(*) as ready_items, tb.tab_billno,tb.tab_time FROM tbl_takeaway_billmaster tb left join tbl_takeaway_billdetails tbd on tb.tab_billno = tbd.tab_billno where tbd.tab_status = 'Ready' and tb.tab_billno ='".$billnum."'";
	
	$result = mysqli_query($localhost,$sql);
	$result1 = mysqli_query($localhost,$sql1);
	
	if(mysqli_num_rows($result)>0)
	{
		$response["processing_items"]= $row["processing_items"];	
	}
	
	if(mysqli_num_rows($result1)>0)
	{
		$response["processing_items"]= $row["ready_items"];	
	}
	$response["message"] = "ok";
	$response["success"] = 1;
	echo json_encode($response);
	
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









?>