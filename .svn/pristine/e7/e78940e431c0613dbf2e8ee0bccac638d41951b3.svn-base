<?php

include("appdbconnection.php"); // DB Connection class
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



/*$localhost = mysqli_connect($hostname_localhost,$username_localhost,$password_localhost,$database_localhost)
or
trigger_error(mysql_error(),E_USER_ERROR);*/
 date_default_timezone_set("Asia/Kolkata");
//mysql_select_db($database_localhost, $localhost);
$check = $_GET['check_value']; 

if($check=="login")
{
$username = $_GET['username'];
$login_type = $_GET['login'];

if($login_type == 'Y')
{
	$password = md5($_GET['password']);
}
else
{
	$password = $_GET['password'];
}


$machineid =$_GET['testt'];// mysqli_real_escape_string($localhost,'e204412fa695a6d');
//`tbl_logindetails`(`ls_username`, `ls_password`, `ls_branchid`, `ls_headofficeid`, `ls_applogin`)
//$query_search = "select * from tbl_logindetails where ls_username = '".$username."' AND ls_password = '".$password. "'";
//$query_exec = mysqli_query($localhost,$query_search) or die(mysql_error());
//$rows = mysqli_num_rows($query_exec);
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
	//$query_exec = mysqli_query($localhost,"select * from tbl_logindetails where ls_username = '".$username."' AND ls_password = '".$password. "'");
	/*$query_exec = mysqli_query($localhost,"select *,sm.ser_defaultfloor from  tbl_logindetails as lg LEFT JOIN  tbl_staffmaster as sm ON  lg.ls_staffid=sm.ser_staffid LEFT JOIN tbl_designationmaster as dg ON dg.dr_designationid=sm.ser_designation LEFT JOIN tbl_staffattendence as sa ON sa.sce_staffid=sm.ser_staffid  WHERE lg.ls_username='".$username."' and lg.ls_password='".$password. "' and lg.ls_status='Y' AND  dg.dr_takeorder='Y' AND sa.sce_date=CURDATE() and sm.ser_designation IN (".$desgn_takordr.") and sa.sce_timein<CURTIME() and (sa.sce_timeout IS NULL)");*/
}else
{
	$query_exec = mysqli_query($localhost,"select * from tbl_logindetails where ls_username = '".$username."' AND ls_password = '".$password. "'");
}
$result = mysqli_num_rows($query_exec);
    // check if row inserted or notTable_menu_list
    if ($result) {
        // successfully inserted into database
		//`tbl_appmachinedetails`(`as_appmachineid`, `as_appmachiesych`, `as_appmachiesychid`, `as_status`, `as_lastupdated`)
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
								}/*else
								{
									$response["success"] = 8;
									$response["message"] = "Mark Attendance";
								}*/
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

else if($check=="login1")
{
$result = mysqli_query($localhost,"select tr_tableid,tr_tableno,tr_floor from tbl_tablemaster where tr_status='Active'") or die(mysql_error());
 if (mysqli_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["table"] = array();
    
    while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $table = array();
        $table["tbl_id"] = $row["tr_tableid"];
        $table["tbl_no"] = $row["tr_tableno"];
        $table["tbl_flr"] = $row["tr_floor"];
       // push single product into final response array
        array_push($response["table"], $table);
    }
    // success
    $response["success"] = 1;

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
else if($check=="login2")
{
	
	$branchid = $_GET['branch_id'];

//$result = mysqli_query($localhost,"SELECT b.be_branchname, b.be_country,be_portion_autoday_update,be_specialday FROM tbl_branchmaster b WHERE B.be_branchid = '".$branchid."'");
$result = mysqli_query($localhost,"SELECT b.be_branchname,b.be_country,be_portion_autoday_update,be_specialday,be_discpountypeoption,be_printwithloyality,be_printwithdiscount,be_portionname,be_androdilogin,b.be_andr_default_login,l.ls_password,b.be_bilregen_with_permission,b.be_phone,b.be_address,be_emenu_cart_authorization FROM tbl_branchmaster b left join tbl_logindetails l on l.ls_username = b.be_andr_default_login  WHERE b.be_branchid = '".$branchid."' ");



//$result = mysqli_num_rows($getFloor);

 if (mysqli_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["floors"] = array();
    
    while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $floor = array();
        $floor["flr_name"] = $row["be_branchname"];
		$floor["flr_country"] = $row["be_country"];
		$floor["flr_discounttype"] = $row["be_discpountypeoption"];
		$floor["flr_loyality"] = $row["be_printwithloyality"];
		$floor["flr_printwithdiscount"] = $row["be_printwithdiscount"];
		$floor["flr_portionname"] = $row["be_portionname"];
		$floor["flr_portion_auto_update"] = $row["be_portion_autoday_update"];
		$floor["andr_default_password"] = $row["ls_password"];
		
		$floor["flr_address"] = $row["be_address"];
		$floor["flr_phonenumber"] = $row["be_phone"];
		$floor["flr_androdilogin"] = $row["be_androdilogin"];
		$floor["flr_andr_default_login"] = $row["be_andr_default_login"];
		$floor["flr_bilregen_with_permission"] = $row["be_bilregen_with_permission"];
		$floor["flr_emenu_cart_authorization"] = $row["be_emenu_cart_authorization"];
		
		
		if($row["be_portion_autoday_update"]=='Y')
		{
			
			if($row["be_specialday"]=='N')
			{
				$sql = "select UPPER(DAYNAME(d.dc_day)) as day from tbl_dayclose d where D.dc_dateclose IS NULL";
				
				$result1 = mysqli_query($localhost,$sql);
				
				if(mysqli_num_rows($result1) > 0)
				{
					//print ">0"; exit();
					while ($row = mysqli_fetch_array($result1)) {
						$floor["flr_day"] = $row["day"];
					}
				}
				else
				{
					//print "<0"; exit();
					$floor["flr_day"] = "";	
				}
			}
			else
			{
				$floor["flr_day"] = "SP HOLIDAY";
			}
		}
		else
		{
			$floor["flr_day"] = "";			
		}
			// push single product into final response array
        array_push($response["floors"], $floor);
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

else if($check=="table_details")
{
	
	$branchid = $_GET['branchid'];
	$floorid = $_GET['floorid'];
	
$result = mysqli_query($localhost,"SELECT tr_tableid,tr_tableno,tr_nextprefix_ascii,tr_vaccantcount FROM tbl_tablemaster WHERE tr_branchid='".$branchid."' and tr_floorid='".$floorid."' and tr_status = 'Active' and tr_vaccantcount>0 order by tr_displayorder");
//and tr_tableid NOT IN(select ts_tableid from tbl_tabledetails)
//$result = mysqli_num_rows($getFloor);

 if (mysqli_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["tabledet"] = array();
    
    while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $table = array();
        $table["tableid"] = $row["tr_tableid"];
		$table["tablenum"] = $row["tr_tableno"];
		$table["tablepref"] = chr($row["tr_nextprefix_ascii"]);
		$table["tablecount"] = $row["tr_vaccantcount"];
		
        
     
        // push single product into final response array
        array_push($response["tabledet"], $table);
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

else if($check=="get_floor")
{
	$branchid = $_GET['branchid'];
$result = mysqli_query($localhost,"SELECT fr_floorid,fr_floorname FROM tbl_floormaster WHERE fr_branchid = '".$branchid."' and fr_status = 'Active'");
if(mysqli_num_rows($result) > 0)
{
	$response["floornum"] = array();
    
    while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $floor = array();
        $floor["f_id"] = $row["fr_floorid"];
        $floor["f_name"] = $row["fr_floorname"];
     
        // push single product into final response array
        array_push($response["floornum"], $floor);
    }
    // success
    $response["success"] = 1;

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

else if($check=="main_menu")
{
	
$result = mysqli_query($localhost,"SELECT * FROM tbl_menumaincategory WHERE mmy_active ='Y' ORDER BY mmy_maincategoryname ASC");
//$result = mysqli_num_rows($getFloor);

 if (mysqli_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["menu_main"] = array();
    
    while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $menu = array();
        $menu["menu_id"] = $row["mmy_maincategoryid"];
        $menu["menu_name"] = $row["mmy_maincategoryname"];
     
        // push single product into final response array
        array_push($response["menu_main"], $menu);
    }
    // success
    $response["success"] = 1;

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

else if($check=="menu_sub")
{
	$mainmenuid = $_GET['main_id'];

	$result = mysqli_query($localhost,"select distinct C.msy_subcategoryid, C.msy_subcategoryname 
							from tbl_menumaster M LEFT JOIN tbl_menusubcategory C ON C.msy_subcategoryid = M.mr_subcatid 
							where mr_maincatid = '".$mainmenuid."'");
//$result = mysqli_num_rows($getFloor);

 if (mysqli_num_rows($result) > 0) {
    // looping through all results
    // products node
	
    $response["sub_menu"] = array();
    
    while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $submenu = array();
        $submenu["sub_id"] = $row["msy_subcategoryid"];
        $submenu["sub_name"] = $row["msy_subcategoryname"];
     
        // push single product into final response array
        array_push($response["sub_menu"], $submenu);
    }
    // success
    $response["success"] = 1;

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

else if($check=="menu_list")
{
	$mainmenuid = $_GET['main_id'];
	$submenuid = $_GET['sub_id'];
	$sort = $_GET['sort_value'];
	$diet_values = $_GET['diet'];
	
	
	
	$lth = 'A to Z';
	$htl = 'Z to A';
	
if($sort == $lth)
{
	if($diet_values=='All')
	{
		
		$string1= "select distinct mr_menuname,mr_menuid,mr_time_min 	from tbl_menumaster LEFT JOIN tbl_menusubcategory ON mr_subcatid = msy_subcategoryid LEFT JOIN tbl_menumaincategory ON mr_maincatid = mmy_maincategoryid WHERE mr_maincatid = '".$mainmenuid."' AND mr_subcatid = '".$submenuid."' ORDER BY mr_menuname ASC ";
	}
	else
	{
		$string1= "select distinct mr_menuname,mr_menuid,mr_time_min 	from tbl_menumaster LEFT JOIN tbl_menusubcategory ON mr_subcatid = msy_subcategoryid LEFT JOIN tbl_menumaincategory ON mr_maincatid = mmy_maincategoryid WHERE mr_maincatid = '".$mainmenuid."' AND mr_subcatid = '".$submenuid."' AND mr_diet ='".$diet_values."' ORDER BY mr_menuname ASC ";	
	}
	

	$result = mysqli_query($localhost,$string1);
}
else if($sort == $htl)
{
	if($diet_values=='All')
	{
		$string2= "select distinct mr_menuname,mr_menuid,mr_time_min 	from tbl_menumaster LEFT JOIN tbl_menusubcategory ON mr_subcatid = msy_subcategoryid LEFT JOIN tbl_menumaincategory ON mr_maincatid = mmy_maincategoryid WHERE mr_maincatid = '".$mainmenuid."' AND mr_subcatid = '".$submenuid."' ORDER BY mr_menuname DESC ";
	}
	else
	{
		$string2= "select distinct mr_menuname,mr_menuid,mr_time_min 	from tbl_menumaster LEFT JOIN tbl_menusubcategory ON mr_subcatid = msy_subcategoryid LEFT JOIN tbl_menumaincategory ON mr_maincatid = mmy_maincategoryid WHERE mr_maincatid = '".$mainmenuid."' AND mr_subcatid = '".$submenuid."' AND mr_diet ='".$diet_values."' ORDER BY mr_menuname DESC ";	
	}
								
	$result = mysqli_query($localhost,$string2 );
}
							

//$result = mysqli_num_rows($getFloor);

 if (mysqli_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["menu_list"] = array();
    
    while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $submenu = array();
        $submenu["item_id"] = $row["mr_menuid"];
        $submenu["item_name"] = $row["mr_menuname"];
		$submenu["item_time"] = $row["mr_time_min"];
     
     
        // push single product into final response array
        array_push($response["menu_list"], $submenu);
    }
    // success
    $response["success"] = 1;
	$response["message"] = "";

    // echoing JSON response
    echo json_encode($response);
} else {
    // no products found
    $response["success"] = 0;
    $response["message"] = "There are no items in this menu";
	

    // echo no users JSON
    echo json_encode($response);
}

}

else if($check=="item_details")
{
	$menuid = $_GET['menu_id'];
	$floorid = $_GET['floor_id'];
	$result = mysqli_query($localhost,"SELECT * FROM tbl_menuratemaster LEFT JOIN tbl_portionmaster ON  mmr_portion = pm_id WHERE mmr_menuid = '".$menuid."' and mmr_floorid = '".$floorid."'");

//$result = mysqli_num_rows($getFloor);

 if (mysqli_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["item_detail"] = array();
    
    while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $submenu = array();
        $submenu["portion"] = $row["pm_portionname"];
		$submenu["portion_id"] = $row["pm_id"];
		$submenu["rate"] = $row["mmr_rate"];
		
		
        // push single product into final response array
        array_push($response["item_detail"], $submenu);
    }
    // success
    $response["success"] = 1;
	$response["message"] = "found";
    // echoing JSON response
    echo json_encode($response);
} else {
    // no products found
    $response["success"] = 0;
    $response["message"] = "Not found";

    // echo no users JSON
    echo json_encode($response);
}

}
else if($check=="item_insert")
{
	$floorid=$_GET['floor_id'];
	$temporder = $_GET['temp_value'];
	$slno	= $_GET['sl_no'];
	$branchid = $_GET['branch_id'];
	$menuid = $_GET['menu_id'];
	$portion = $_GET['portion'];
	$quantity = $_GET['quantity'];
	$status = $_GET['status'];
	$preferenceid = $_GET['pref_id'];
	$preferencetext = $_GET['pref'];
	$orderfrom = $_GET['order_from'];
	$username = $_GET['user_name'];
	$esttime = $_GET['est_time'];
	$staffid = $_GET['staff_id'];
	$rate = $_GET['Rate'];
	$type = $_GET['type'];

	//`ter_orderno`, `ter_slno`, `ter_branchid`, `ter_menuid`, `ter_portion`, `ter_qty`, `ter_status`, `ter_preference`, `ter_preferencetext`, `ter_orderfrom`, `ter_entrydate`, `ter_entrytime`, `ter_entryuser`, `ter_esttime`, `ter_staff`
	$result = mysqli_query($localhost,"select t.*,p.pm_portionname from tbl_tableorder t,tbl_portionmaster p where  t.ter_portion = p.pm_id and t.ter_menuid = '".$menuid."' and t.ter_orderno = '".$temporder."' and t.ter_portion = '".$portion."' and t.ter_status = 'Added' and t.ter_type = '".$type."'");
	
	if(mysqli_num_rows($result)>0)
	{
		while ($row = mysqli_fetch_array($result)) {
		
		 $name = $row["pm_portionname"];
		
		}
		 $response["success"] = 10;
		  $response["message"] = "Item with portion ".$name." already exist";
	}
	else
	{
		/*$result = mysqli_query($localhost,
	"INSERT INTO tbl_tableorder(ter_orderno, ter_slno, ter_branchid, ter_menuid, ter_portion, ter_qty,ter_status, ter_preference, ter_orderfrom,ter_entryuser, ter_esttime, ter_staff) VALUES ('".$temporder."','".$slno."','".$branchid."','".$menuid."','".$portion."','".$quantity."','".$status."','".$preference."','".$orderfrom."','".$username."','".$esttime."','".$staffid."')");*/
if($preferenceid=="NULL")
 {
	
	$result = mysqli_query($localhost,
	"INSERT INTO tbl_tableorder(ter_orderno, ter_slno, ter_branchid, ter_menuid, ter_portion, ter_rate, ter_qty, ter_status, ter_preferencetext, ter_orderfrom, ter_entryuser, ter_esttime, ter_staff, ter_type) VALUES ('".$temporder."','".$slno."','".$branchid."','".$menuid."','".$portion."','".$rate."', '".$quantity."','".$status."','".$preferencetext."','".$orderfrom."','".$username."','".$esttime."','".$staffid."','".$type."')");
 }else
 {
	 $result = mysqli_query($localhost,
	"INSERT INTO tbl_tableorder(ter_orderno, ter_slno, ter_branchid, ter_menuid, ter_portion, ter_rate, ter_qty, ter_status, ter_preference, ter_preferencetext, ter_orderfrom, ter_entryuser, ter_esttime, ter_staff, ter_type) VALUES ('".$temporder."','".$slno."','".$branchid."','".$menuid."','".$portion."','".$rate."', '".$quantity."','".$status."','".$preferenceid."','".$preferencetext."','".$orderfrom."','".$username."','".$esttime."','".$staffid."','".$type."')");
 }
	
	if($result)
	{
		$response["success"] = 11;
		$response["message"] = "Item added successfully";
	}else
	{
		$response["success"] = 12;
		 $response["message"] = "Not added";
	}
	}
	echo json_encode($response);
}

else if($check == 'Ingredients')
{
	$result = mysqli_query($localhost,"SELECT * FROM tbl_ingredientmaster");
if (mysqli_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["ingredients"] = array();
    
    while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $submenu = array();
        $submenu["ingredient_id"] = $row["ir_ingredientid"];
        $submenu["ingredient_name"] = $row["ir_ingredientname"];
		
        // push single product into final response array
        array_push($response["ingredients"], $submenu);
    }
    // success
    $response["success"] = 1;

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

else if($check == 'chair_select')
{
	
	$id	= $_GET['id_value'];
	$pref = $_GET['prefix'];
	$status = $_GET['status'];
	$persons = $_GET['persons'];
	$temp_is = $_GET['ordernum'];
	//`tbl_tabledetails`(`ts_tableid`, `ts_tableidprefix`, `ts_status`, `ts_dineintime`, `ts_noofpersons`, `ts_orderno`)
	$result = mysqli_query($localhost,"INSERT INTO tbl_tabledetails(ts_tableid, ts_tableidprefix,ts_status, ts_noofpersons, ts_orderno) VALUES ('".$id."','".$pref."','".$status."','".$persons."','".$temp_is."')");
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


else if($check == 'pref_details')
{
	$menuid = $_GET['menu_id'];
	$result = mysqli_query($localhost,"SELECT pmr_id,pmr_name FROM tbl_menuprefmaster a LEFT JOIN tbl_preferencemaster ON mpr_prefeernce = pmr_id WHERE mpr_menuid = '".$menuid."'");
if (mysqli_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["pref_values"] = array();
    
    while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $submenu = array();
        $submenu["id"] = $row["pmr_id"];
        $submenu["name"] = $row["pmr_name"];
		
        // push single product into final response array
        array_push($response["pref_values"], $submenu);
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

else if($check == 'cart_details')
{
	$order_num = $_GET['order_num'];
	$branch_id = $_GET['branchid'];
	$status = $_GET['status'];
	
	$result = mysqli_query($localhost,"SELECT to1.ter_orderno as orderno,to1.ter_esttime as time, to1.ter_slno as sl, to1.ter_branchid as br_id,to1.ter_menuid as menuid,mm.mr_menuname as menuname,pm.pm_portionname as portionname,to1.ter_qty as qty, to1.ter_rate as rate, to1.ter_preference as prefid, prefm.pmr_name as preference_dr,to1.ter_preferencetext as pref_name,to1.ter_type as type,
mi.mes_imagename as image FROM tbl_tableorder to1 left join tbl_portionmaster as pm on pm.pm_id = to1.ter_portion left join tbl_preferencemaster as prefm on prefm.pmr_id = to1.ter_preference left join tbl_menumaster as mm on mm.mr_menuid=to1.ter_menuid left join tbl_menuimages as mi on mi.mes_menuid =to1.ter_menuid WHERE to1.ter_orderno='".$order_num."' and to1.ter_branchid='".$branch_id."' and to1.ter_status='".$status."' 
group by to1.ter_orderno,to1.ter_slno,to1.ter_branchid,to1.ter_menuid,pm.pm_portionname,to1.ter_type");
if (mysqli_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["cart_values"] = array();
	
    while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $submenu = array();
        $submenu["ordernum"] = $row["orderno"];
        $submenu["slno"] = $row["sl"];
		$submenu["branchid"] = $row["br_id"];
        $submenu["menuid"] = $row["menuid"];
		$submenu["menuname"] = ($row["menuname"]);
        $submenu["portionid"] = $row["prefid"];
		$submenu["portionname"] = $row["portionname"];
        $submenu["quantity"] = $row["qty"];
		$submenu["pref_id"] = $row["prefid"];
        $submenu["prefname_drop"] = $row["preference_dr"];
		$submenu["preference_name"] = $row["pref_name"];
		$submenu["item_rate"] = $row["rate"];
		$submenu["item_time"] = $row["time"];
		$submenu["type"] = $row["type"];
		$submenu["image"] =$row["image"];
		//$submenu["image"]=str_replace('\\', '', ($submenu["image"]));
       	
		
        // push single product into final response array
        array_push($response["cart_values"], $submenu);
    }
  // success
   $response["message"] = "Products found";
    $response["response"] = 50;

    // echoing JSON response
    echo json_encode($response);
} else {
    // no products found
    $response["response"] = 51;
    $response["message"] = "No products found";

    // echo no users JSON
    echo json_encode($response);
}

}

else if($check == 'Delete')
{
	
	$order	= $_GET['ordernum'];
	$sl = $_GET['serial'];
	
	//`tbl_tabledetails`(`ts_tableid`, `ts_tableidprefix`, `ts_status`, `ts_dineintime`, `ts_noofpersons`, `ts_orderno`)
	$result = mysqli_query($localhost,"DELETE FROM tbl_tableorder WHERE ter_orderno = '".$order."' and ter_slno = '".$sl."'");
	if($result)
	{
		 $response["success"] = 1;
		 $response["message"] = "Deleted";
    	echo json_encode($response);
	}else
	{
		$response["success"] = 2;
		$response["message"] = "Failed";
    	echo json_encode($response);
	}
}




else if($check == 'noofpersons')
{
	$prefixvalues = $_GET['prefixvalues'];
	$tableid = $_GET['tableid'];
	$guestcount = $_GET['guestcount'];
	$category = $_GET['category'];
	$staffid = $_GET['staffid'];
	$macid=$_GET['macid'];
	
	$dayclosedate = '';

	$second = mysqli_query($localhost,"SELECT dc_day FROM tbl_dayclose WHERE dc_dateclose IS NULL");

	if(mysqli_num_rows($second) > 0)
	{
		
		mysqli_query($localhost,"SET @tableid = " . "'" . mysqli_real_escape_string($localhost,$tableid) . "'");
			mysqli_query($localhost,"SET @guestcount = " . "'" . mysqli_real_escape_string($localhost, $guestcount) . "'");
			mysqli_query($localhost,"SET @category = " . "'" . mysqli_real_escape_string($localhost,$category) . "'");
			mysqli_query($localhost,"SET @staffid = " . "'" . mysqli_real_escape_string($localhost,$staffid) . "'");
			mysqli_query($localhost,"SET @macid = " . "'" . mysqli_real_escape_string($localhost,$macid) . "'");
	
		try
      {
          $result1=mysqli_query($localhost,"CALL proc_tabledetailentry(@orderid,@tableid,@guestcount,@category,'N',@staffid,'','A',@macid)") or throw_ex(mysqli_error($localhost)) ;
      $rs = mysqli_query($localhost, 'SELECT @orderid AS orderid' );
 
      $s = "";
      while($row = mysqli_fetch_array($rs))
      {
          $s= $row['orderid'];
      }
       $response["success"] = 1;
           $response["message"] = $s;
         
		$array=explode(',', $tableid);
           	if (sizeof($array)>1) 
           	{
           		for ($i=0; $i <sizeof($array) ; $i++) { 

           			$update_access="update tbl_tabledetails set ts_in_access='Y' where ts_tableid='".$array[$i]."'";
           			mysqli_query($localhost,$update_access);
           		}
           	}
           	else
           	{
           		$update_access="update tbl_tabledetails set ts_in_access='Y' where ts_tableid='".$tableid."' and ts_tableidprefix='".$prefixvalues."'";

           		/*$update_access="update tbl_tabledetails set ts_in_access='Y' where ts_tableid='".$tableid."' and ts_tableidprefix='".$prefixvalues."'";*/
           		mysqli_query($localhost,$update_access);
           	}


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

	else{
		 $response["success"] = 3;
           $response["message"] = "Day not Opened";
           echo json_encode($response);
	}
	
}

else if($check == 'order_historyimages')
{
	
	$order	= $_GET['order_num'];
	$branch_id = $_GET['branch_id'];
	$sorting = $_GET['sort_order'];
	


	$temp = "SELECT t.ter_slno, m.mr_menuname, m.mr_menuid,p.pm_id, p.pm_portionname, t.ter_qty,t.ter_esttime, t.ter_status, pm.pmr_name,t.ter_preferencetext, t.ter_entrytime,t.ter_kotno,t.ter_type,oi.mes_imagename as image, (t.`ter_rate`* t.`ter_qty`) as mulrate FROM tbl_tableorder t left join tbl_menumaster m on m.mr_menuid = t.ter_menuid left join tbl_portionmaster p on p.pm_id =t.ter_portion left join tbl_preferencemaster pm on pm.pmr_id = t.ter_preference left join tbl_menuimages as oi on oi.mes_menuid = t.ter_menuid where t.ter_orderno = '".$order."' and t.ter_branchid = '".$branch_id."' and t.ter_status <>'Added' and t.ter_status <>'Closed' and t.ter_status <>'Billed' group by t.ter_slno, m.mr_menuname, p.pm_portionname, t.ter_qty,t.ter_esttime, t.ter_status,pm.pmr_name,t.ter_preferencetext, t.ter_entrytime, t.ter_kotno,t.ter_type order by t.ter_status asc";
	
	if($sorting=='Preparing')
	{
		$temp = $temp." order by t.ter_status = 'Opened' DESC";
		
	}
	else if($sorting=='Prepared')
	{
		$temp = $temp." order by t.ter_status = 'Ready' DESC";
	}
	else if($sorting=='Served')
	{
		$temp = $temp." order by t.ter_status = 'Served' DESC";
	}	
	
	
	
	$result = mysqli_query($localhost,$temp);
	if (mysqli_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["order_values"] = array();
	
    while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $submenu = array();
        $submenu["menu_name"] = $row["mr_menuname"];
		$submenu["menu_id"] = $row["mr_menuid"];
        $submenu["slno"] = $row["ter_slno"];
		$submenu["pref_drop"] = $row["pmr_name"];
        $submenu["pref_txt"] = $row["ter_preferencetext"];
		$submenu["order_time"] = $row["ter_entrytime"];
        $submenu["kot_no"] = $row["ter_kotno"];
		$submenu["qty"] = $row["ter_qty"];
		$submenu["portion_id"] = $row["pm_id"];
		$submenu["portion"] = $row["pm_portionname"];
		$submenu["status"] = $row["ter_status"];
        $submenu["type"] = $row["ter_type"];
		 $submenu["est_time"] = $row["ter_esttime"];
		 $submenu["images"] = $row["image"];

		 $submenu["mulrate"] = $row["mulrate"];
		 
		
       // push single product into final response array
        array_push($response["order_values"], $submenu);
    }
  // success
   $response["message"] = "found";
    $response["response"] = 50;
	
    // echoing JSON response
    echo json_encode($response);
} else {
    // no products found
    $response["response"] = 51;
    $response["message"] = "No products found";
	
	
    // echo no users JSON
    echo json_encode($response);
}
}

else if($check == 'totrate')
{
	$order	= $_GET['order_num'];
	$branch_id = $_GET['branch_id'];
	
	$sql = "SELECT sum(`ter_qty`*`ter_rate`) as rate FROM `tbl_tableorder` WHERE `ter_branchid`='".$branch_id."' and `ter_orderno`='".$order."'";
	$result = mysqli_query($localhost,$sql);
	if(mysqli_num_rows($result) > 0)
	{
		$response["totvale"] = array();
		while($row = mysqli_fetch_array($result))
		{
			$totsum = array();
			$totsum["totvalue"] = $row["rate"];
			array_push($response["totvale"], $totsum);
		}
		// success
	   $response["message"] = "ok";
	   $response["response"] = 1;
	   echo json_encode($response);
		
	}else {
    // no products found
    $response["response"] = 0;
    $response["message"] = "No";
   // echo no users JSON
    echo json_encode($response);
}
	
}

else if($check == 'order_history_combo')
{
	
	$order	= $_GET['order_num'];
	$branch_id = $_GET['branch_id'];
	$sortvalue = $_GET['sortvalue'];

	$sql_c="select cod.cod_kot_no,cod.cod_count_combo_ordering,cod.cod_combo_qty,cod.cod_combo_pack_rate,cp.cp_pack_name from tbl_combo_packs cp left join tbl_combo_ordering_details cod on cp.cp_id=cod.cod_combo_pack_id where cod.cod_orderno='".$order."' group by cod.cod_count_combo_ordering";

	$sql_c="select t.ter_preferencetext,t.ter_entrytime,t.ter_qty,t.ter_status,t.ter_esttime,cod.cod_kot_no,cod.cod_count_combo_ordering,cod.cod_combo_qty,cod.cod_combo_pack_rate,cp.cp_pack_name from tbl_combo_packs cp left join tbl_combo_ordering_details cod on cp.cp_id=cod.cod_combo_pack_id left JOIN tbl_tableorder t on t.ter_combo_entry_id =cod.cod_id where cod.cod_orderno='25111942' group by cod.cod_count_combo_ordering";

	

	echo $sql_c;

	$result = mysqli_query($localhost,$sql_c);
	if (mysqli_num_rows($result) > 0) 
	{
   		 
   		  $response["combos"] = array();

		while ($row = mysqli_fetch_array($result)) 
		{
	        // temp user array
	 		$submenu = array();
	        $submenu["cod_kot_no"] = $row["cod_kot_no"];

        $submenu["menu_name"] = $row["mr_menuname"];
		$submenu["slno"] = $row["ter_slno"];
        $submenu["pref_txt"] = $row["ter_preferencetext"];
		$submenu["order_time"] = date('h:i:a', strtotime($row["ter_entrytime"]));
        $submenu["qty"] = $row["ter_qty"];
        $submenu["status"] = $row["ter_status"];
        $submenu["est_time"] = $row["ter_esttime"];
	       


			 array_push($response["combos"], $submenu);
		}

		 $response["message"] = "found";
    	 $response["response"] = 50;
	}
    	
    	// echo json_encode($response);




}


else if($check == 'order_history')
{
	
	$order	= $_GET['order_num'];
	$branch_id = $_GET['branch_id'];
	$sortvalue = $_GET['sortvalue'];

	if($sortvalue=='Opened')
	{
		/*$temp ="SELECT t.ter_unit_type,t.ter_unit_weight,t.ter_unit_id,t.ter_base_unit_id,t.ter_base_rate,t.ter_slno, m.mr_menuname, p.pm_portionname, t.ter_qty,t.ter_esttime, t.ter_status, pm.pmr_name,t.ter_preferencetext, t.ter_entrytime, t.ter_kotno,t.ter_type FROM tbl_tableorder t left join tbl_menumaster m on m.mr_menuid = t.ter_menuid left join tbl_portionmaster p on p.pm_id = t.ter_portion left join tbl_preferencemaster pm on pm.pmr_id = t.ter_preference where t.ter_orderno = '".$order."' and t.ter_branchid ='".$branch_id."' and t.ter_status <>'Added' and t.ter_status <>'Closed' and t.ter_kotno<>'0' ORDER BY `t`.`ter_kotno`  ASC";*/


		$temp ="SELECT t.ter_unit_type,t.ter_unit_weight,t.ter_unit_id,t.ter_base_unit_id,t.ter_base_rate,t.ter_slno, m.mr_menuname, p.pm_portionname, t.ter_qty,t.ter_esttime, t.ter_status, pm.pmr_name,t.ter_preferencetext, t.ter_entrytime, t.ter_kotno,t.ter_type,cod.cod_combo_total_rate,cod.cod_combo_qty,cod.cod_menu_qty,cod.cod_count_combo_ordering,cp.cp_pack_name FROM tbl_tableorder t left join tbl_menumaster m on m.mr_menuid = t.ter_menuid left join tbl_portionmaster p on p.pm_id = t.ter_portion left join tbl_preferencemaster pm on pm.pmr_id = t.ter_preference left join tbl_combo_ordering_details cod on cod.cod_id=t.ter_combo_entry_id left join tbl_combo_packs cp on cp.cp_id=cod.cod_combo_pack_id where t.ter_orderno = '".$order."' and t.ter_branchid ='".$branch_id."' and t.ter_status <>'Added' and t.ter_status <>'Closed' and t.ter_kotno  <>'0' ORDER BY `t`.`ter_kotno`  ASC,cod.cod_count_combo_ordering ASC";



		
	}
	else if($sortvalue=='Served')
	{
		/*$temp ="SELECT t.ter_unit_type,t.ter_unit_weight,t.ter_unit_id,t.ter_base_unit_id,t.ter_base_rate,t.ter_slno, m.mr_menuname, p.pm_portionname, t.ter_qty,t.ter_esttime, t.ter_status, pm.pmr_name,t.ter_preferencetext, t.ter_entrytime, t.ter_kotno,t.ter_type FROM tbl_tableorder t left join tbl_menumaster m on m.mr_menuid = t.ter_menuid left join tbl_portionmaster p on p.pm_id = t.ter_portion left join tbl_preferencemaster pm on pm.pmr_id = t.ter_preference where t.ter_orderno = '".$order."' and t.ter_branchid ='".$branch_id."' and t.ter_status <>'Added' and t.ter_status <>'Closed' and t.ter_kotno <>'0' ORDER BY `t`.`ter_kotno`  ASC";*/

		$temp ="SELECT t.ter_unit_type,t.ter_unit_weight,t.ter_unit_id,t.ter_base_unit_id,t.ter_base_rate,t.ter_slno, m.mr_menuname, p.pm_portionname, t.ter_qty,t.ter_esttime, t.ter_status, pm.pmr_name,t.ter_preferencetext, t.ter_entrytime, t.ter_kotno,t.ter_type,cod.cod_combo_total_rate,cod.cod_combo_qty,cod.cod_menu_qty,cod.cod_count_combo_ordering,cp.cp_pack_name FROM tbl_tableorder t left join tbl_menumaster m on m.mr_menuid = t.ter_menuid left join tbl_portionmaster p on p.pm_id = t.ter_portion left join tbl_preferencemaster pm on pm.pmr_id = t.ter_preference left join tbl_combo_ordering_details cod on cod.cod_id=t.ter_combo_entry_id left join tbl_combo_packs cp on cp.cp_id=cod.cod_combo_pack_id where t.ter_orderno = '".$order."' and t.ter_branchid ='".$branch_id."' and t.ter_status <>'Added' and t.ter_status <>'Closed' and t.ter_kotno  <>'0' ORDER BY `t`.`ter_kotno`  ASC,cod.cod_count_combo_ordering ASC";
	}
	else if($sortvalue=='Ready')
	{
		/*$temp ="SELECT t.ter_unit_type,t.ter_unit_weight,t.ter_unit_id,t.ter_base_unit_id,t.ter_base_rate,t.ter_slno, m.mr_menuname, p.pm_portionname, t.ter_qty,t.ter_esttime, t.ter_status, pm.pmr_name,t.ter_preferencetext, t.ter_entrytime, t.ter_kotno,t.ter_type FROM tbl_tableorder t left join tbl_menumaster m on m.mr_menuid = t.ter_menuid left join tbl_portionmaster p on p.pm_id = t.ter_portion left join tbl_preferencemaster pm on pm.pmr_id = t.ter_preference where t.ter_orderno = '".$order."' and t.ter_branchid ='".$branch_id."' and t.ter_status <>'Added' and t.ter_status <>'Closed' and t.ter_kotno  <>'0' ORDER BY `t`.`ter_kotno`  ASC";*/


		$temp ="SELECT t.ter_unit_type,t.ter_unit_weight,t.ter_unit_id,t.ter_base_unit_id,t.ter_base_rate,t.ter_slno, m.mr_menuname, p.pm_portionname, t.ter_qty,t.ter_esttime, t.ter_status, pm.pmr_name,t.ter_preferencetext, t.ter_entrytime, t.ter_kotno,t.ter_type,cod.cod_combo_total_rate,cod.cod_combo_qty,cod.cod_menu_qty,cod.cod_count_combo_ordering,cp.cp_pack_name FROM tbl_tableorder t left join tbl_menumaster m on m.mr_menuid = t.ter_menuid left join tbl_portionmaster p on p.pm_id = t.ter_portion left join tbl_preferencemaster pm on pm.pmr_id = t.ter_preference left join tbl_combo_ordering_details cod on cod.cod_id=t.ter_combo_entry_id left join tbl_combo_packs cp on cp.cp_id=cod.cod_combo_pack_id where t.ter_orderno = '".$order."' and t.ter_branchid ='".$branch_id."' and t.ter_status <>'Added' and t.ter_status <>'Closed' and t.ter_kotno  <>'0' ORDER BY `t`.`ter_kotno`  ASC,cod.cod_count_combo_ordering ASC";
	}
	else if($sortvalue=='')
	{
  

		$temp ="SELECT t.ter_unit_type,t.ter_unit_weight,t.ter_unit_id,t.ter_base_unit_id,t.ter_base_rate,t.ter_slno, m.mr_menuname, p.pm_portionname, t.ter_qty,t.ter_esttime, t.ter_status, pm.pmr_name,t.ter_preferencetext, t.ter_entrytime, t.ter_kotno,t.ter_type,cod.cod_combo_total_rate,cod.cod_combo_qty,cod.cod_menu_qty,cod.cod_count_combo_ordering,cp.cp_pack_name FROM tbl_tableorder t left join tbl_menumaster m on m.mr_menuid = t.ter_menuid left join tbl_portionmaster p on p.pm_id = t.ter_portion left join tbl_preferencemaster pm on pm.pmr_id = t.ter_preference left join tbl_combo_ordering_details cod on cod.cod_id=t.ter_combo_entry_id left join tbl_combo_packs cp on cp.cp_id=cod.cod_combo_pack_id where t.ter_orderno = '".$order."' and t.ter_branchid ='".$branch_id."' and t.ter_status <>'Added' and t.ter_status <>'Closed' and t.ter_kotno  <>'0' ORDER BY `t`.`ter_kotno`  ASC,cod.cod_count_combo_ordering ASC";
	}

	//echo $temp;
	
	$result = mysqli_query($localhost,$temp);
	if (mysqli_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["order_values"] = array();
	
    while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $submenu = array();
        $submenu["menu_name"] = $row["mr_menuname"];
        $submenu["slno"] = $row["ter_slno"];
		$submenu["pref_drop"] = $row["pmr_name"];
        $submenu["pref_txt"] = $row["ter_preferencetext"];
		$submenu["order_time"] = date('h:i:a', strtotime($row["ter_entrytime"]));
        $submenu["kot_no"] = $row["ter_kotno"];
		$submenu["qty"] = $row["ter_qty"];
        $submenu["portion"] = $row["pm_portionname"];
		$submenu["status"] = $row["ter_status"];
        $submenu["type"] = $row["ter_type"];
		$submenu["est_time"] = $row["ter_esttime"];
		 
		$submenu["unit_type"] = $row["ter_unit_type"];
		$submenu["unit_weight"] = $row["ter_unit_weight"];
		$submenu["unit_id"] = $row["ter_unit_id"];
		$submenu["base_unit_id"] = $row["ter_base_unit_id"];
		$submenu["base_rate"] = $row["ter_base_rate"];
		$a=$submenu["unit_weight"];
		$b=$submenu["unit_id"];
		$submenu["combo_packname"] = $row["cp_pack_name"];
		$submenu["combo_total_rate"] = $row["cod_combo_total_rate"];
		$submenu["combo_qty"] = $row["cod_combo_qty"];
		$submenu["combo_menu_qty"] = $row["cod_menu_qty"];
		$submenu["count_combo_ordering"] = $row["cod_count_combo_ordering"];


if($submenu["unit_type"]=="Packet"){
	$sq="SELECT u_name from tbl_unit_master  where u_id='".$b."'";
	$result1 = mysqli_query($localhost,$sq);
	if (mysqli_num_rows($result1) > 0) 
	{
     $row1 = mysqli_fetch_array($result1);
     $y=number_format($a,$_SESSION["be_decimal"]);
	 $submenu["unit_weight"]=$y.$row1["u_name"];
	}

}
if($submenu["unit_type"]=="Loose"){

	$c=$submenu["base_unit_id"];
	$sq="SELECT  bu_name from tbl_base_unit_master where bu_id='".$c."'";
	$result2 = mysqli_query($localhost,$sq);
	if (mysqli_num_rows($result2) > 0) 
	{
		$row2 = mysqli_fetch_array($result2);
		//$x=number_format($a,2);
		 $x=number_format($a,$_SESSION["be_decimal"]);
		$submenu["unit_weight"]=$x.$row2["bu_name"];
	}

}


		
       // push single product into final response array
        array_push($response["order_values"], $submenu);
    }
  // success
  $response["message"] = "found";
    $response["response"] = 50;
	
    // echoing JSON response 
    echo json_encode($response);
} else {
    // no products found
    $response["response"] = 51;
    $response["message"] = "No products found";
	
	
    // echo no users JSON
    echo json_encode($response);
}
}




else if($check== 'served')
{
	$slnum = $_GET['serialnumber'];
	$orderdetails = $_GET['orderdetails'];
	
	$result = mysqli_query($localhost,"UPDATE tbl_tableorder SET ter_status= 'Served' WHERE ter_orderno = '".$orderdetails."' and ter_slno = '".$slnum."'");
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

else if($check == 'statuscount')
{
	$orderid = $_GET['order_num'];
	$brnch = $_GET['branch_id'];
	
	$result = mysqli_query($localhost,"SELECT * FROM tbl_tableorder WHERE (ter_status ='Opened' or ter_status = 'Ready' or ter_status = 'Added') and ter_status <> 'Closed' and ter_orderno = '".$orderid."' and ter_branchid = '".$brnch."'");
	if(mysqli_num_rows($result) > 0)
	{
		$response["success"] = 1;
		 $response["message"] = "ok";
    	echo json_encode($response);
	}
	else
	{
		$response["success"] = 2;
		 $response["message"] = "not";
    	echo json_encode($response);
	}
	
}

else if($check == 'occupied_details')
{
	$floor = $_GET['floorid'];
	$brnch = $_GET['branchid'];
	$staffid = $_GET['staffid'];

	$staf = "select be_android_staffwise_occupied from tbl_branchmaster where be_branchid = '".$brnch."'";
	$result_st = mysqli_query($localhost,$staf);
	
	if(mysqli_num_rows($result_st)>0)
	{
		while($row = mysqli_fetch_array($result_st))
		{
			$value = $row["be_android_staffwise_occupied"];
		}
	
			$temp = "SELECT GROUP_CONCAT((CONCAT(trim(t.tr_tableno),concat('(',(trim(td.ts_tableidprefix)),')'))) SEPARATOR '+') as list ,
			GROUP_CONCAT((CONCAT(trim(td.ts_tableid))) SEPARATOR ',') as tableid,GROUP_CONCAT((CONCAT(trim(td.ts_tableidprefix))) SEPARATOR ',') as table_prefix,
			td.ts_dineintime,sum(td.ts_noofpersons) as ts_noofpersons , s.ser_firstname as staff_name,s.ser_staffid as staffid,td.ts_status,td.ts_orderno,
			td.ts_billnumber FROM tbl_tabledetails td LEFT JOIN tbl_tablemaster t on t.tr_tableid = td.ts_tableid 
			LEFT JOIN tbl_staffmaster s ON s.ser_staffid = td.ts_orderstaff where t.tr_branchid = '".$brnch."' and t.tr_floorid = '".$floor."' 
			and td.ts_status != 'Billed' ";		
		
		if($value=='Y')
		{
			$temp = $temp." and s.ser_staffid='".$staffid."' ";
		}
	
		$temp = $temp." GROUP BY ts_orderno ORDER BY t.tr_displayorder ASC";
		
	}	
	
	$result = mysqli_query($localhost,$temp);
	if (mysqli_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["occ_listdetails"] = array();
	
    while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $submenu = array();
        $submenu["occ_id"] = $row["list"];
        $submenu["occ_time"] = $row["ts_dineintime"];
		$submenu["occ_num"] = $row["ts_noofpersons"];
        $submenu["occ_order"] = $row["ts_orderno"];
		$submenu["occ_tableid"] = $row["tableid"];
		$submenu["occ_staffname"] = $row["staff_name"];
		$submenu["occ_staffid"] = $row["staffid"];
		$submenu["occ_staffprefix"] = $row["table_prefix"];
		$submenu["occ_status"] = $row["ts_status"];
		$s = $row["ts_billnumber"];
		if($s=="NULL")
		{
			$submenu["occ_bill_numbber"] = "";
		}
		else
		{
			$submenu["occ_bill_numbber"] = $s;
		}
		
		
       // push single product into final response array
        array_push($response["occ_listdetails"], $submenu);
    }
  // success
   $response["message"] = "ok";
    $response["success"] = 1;
	
    // echoing JSON response
    echo json_encode($response);
} else {
    // no products found
    $response["success"] = 2;
    $response["message"] = "fail";
   // echo no users JSON
    echo json_encode($response);
}

}


else if($check=="Table_menu_list")
{
	$mainmenuid = $_GET['main_id'];
	$submenuid = $_GET['sub_id'];
	$sort = $_GET['sort_value'];
	$diet_values = $_GET['diet'];
	
	
	
	$lth = 'A to Z';
	$htl = 'Z to A';
	
if($sort == $lth)
{
	if($diet_values=='All')
	{
		$string1= "select distinct m.mr_menuname,m.mr_menuid,m.mr_time_min,mi.mes_imagename,m.mr_description,m.mr_diet from tbl_menumaster m LEFT JOIN tbl_menusubcategory ON mr_subcatid = msy_subcategoryid LEFT JOIN tbl_menumaincategory ON mr_maincatid = mmy_maincategoryid LEFT JOIN tbl_menuimages mi ON mes_menuid = m.mr_menuid WHERE m.mr_maincatid = '".$mainmenuid."' AND m.mr_subcatid = '".$submenuid."' group by m.mr_menuid ORDER BY mr_menuname ASC ";
	}
	else
	{
		$string1= "select distinct m.mr_menuname,m.mr_menuid,m.mr_time_min,mi.mes_imagename,m.mr_description,m.mr_diet from tbl_menumaster m LEFT JOIN tbl_menusubcategory ON mr_subcatid = msy_subcategoryid LEFT JOIN tbl_menumaincategory ON mr_maincatid = mmy_maincategoryid LEFT JOIN tbl_menuimages mi ON mes_menuid = m.mr_menuid WHERE m.mr_maincatid = '".$mainmenuid."' AND m.mr_subcatid = '".$submenuid."' AND mr_subcatid = '".$submenuid."' AND m.mr_diet ='".$diet_values."' group by m.mr_menuid ORDER BY mr_menuname ASC ";	
	}
	

	$result = mysqli_query($localhost,$string1);
}
else if($sort == $htl)
{
	if($diet_values=='All')
	{
		$string2= "select distinct m.mr_menuname,m.mr_menuid,m.mr_time_min,mi.mes_imagename,m.mr_description,m.mr_diet from tbl_menumaster m LEFT JOIN tbl_menusubcategory ON mr_subcatid = msy_subcategoryid LEFT JOIN tbl_menumaincategory ON mr_maincatid = mmy_maincategoryid LEFT JOIN tbl_menuimages mi ON mes_menuid = m.mr_menuid WHERE m.mr_maincatid = '".$mainmenuid."' AND m.mr_subcatid = '".$submenuid."' AND mr_subcatid = '".$submenuid."' group by m.mr_menuid ORDER BY mr_menuname DESC ";
	}
	else
	{
		$string2= "select distinct m.mr_menuname,m.mr_menuid,m.mr_time_min,mi.mes_imagename,m.mr_description,m.mr_diet from tbl_menumaster m LEFT JOIN tbl_menusubcategory ON mr_subcatid = msy_subcategoryid LEFT JOIN tbl_menumaincategory ON mr_maincatid = mmy_maincategoryid LEFT JOIN tbl_menuimages mi ON mes_menuid = m.mr_menuid WHERE m.mr_maincatid = '".$mainmenuid."' AND m.mr_subcatid = '".$submenuid."' AND mr_subcatid = '".$submenuid."' AND m.mr_diet ='".$diet_values."' group by m.mr_menuid ORDER BY mr_menuname DESC ";	
	}
								
	$result = mysqli_query($localhost,$string2 );
}
							

//$result = mysqli_num_rows($getFloor);

 if (mysqli_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["menu_list"] = array();
    
    while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $submenu = array();
        $submenu["item_id"] = $row["mr_menuid"];
        $submenu["item_name"] = $row["mr_menuname"];
		$submenu["item_time"] = $row["mr_time_min"];
		$submenu["item_image"] = $row["mes_imagename"];
		$submenu["item_des"] = $row["mr_description"];
		$submenu["item_diet"] = $row["mr_diet"];
     
     
        // push single product into final response array
        array_push($response["menu_list"], $submenu);
    }
    // success
    $response["success"] = 1;
	$response["message"] = "";

    // echoing JSON response
    echo json_encode($response);
} else {
    // no products found
    $response["success"] = 0;
    $response["message"] = "There are no items in this menu";
	

    // echo no users JSON
    echo json_encode($response);
}
}

else if($check == 'mul_iamges')
{
	$menudet = $_GET['menudet'];
	
	
	$result = mysqli_query($localhost,"select mes_imagename from tbl_menuimages where mes_menuid='".$menudet."'");
if (mysqli_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["images"] = array();
	
    while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $submenu = array();
        $submenu["mull_images"] = $row["mes_imagename"];
        // push single product into final response array
        array_push($response["images"], $submenu);
    }
  // success
   $response["message"] = "found";
    $response["success"] = 1;

    // echoing JSON response
    echo json_encode($response);
} else {
    // no products found
    $response["success"] = 2;
    $response["message"] = "not";

    // echo no users JSON
    echo json_encode($response);
}

}
else if($check == 'nutrition')
{
	$menudet = $_GET['menuvalues'];
	$result = mysqli_query($localhost,"SELECT CONCAT(mnf_nutrition,' - ',mnf_value) AS Nutrifact FROM tbl_menunutitionfacts  WHERE mnf_menuid ='".$menudet."'");
if (mysqli_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["nutri"] = array();
	
    while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $submenu = array();
        $submenu["nutrif"] = $row["Nutrifact"];
        // push single product into final response array
        array_push($response["nutri"], $submenu);
    }
  // success
   $response["message"] = "found";
    $response["success"] = 1;

    // echoing JSON response
    echo json_encode($response);
} else {
    // no products found
    $response["success"] = 2;
    $response["message"] = "not";

    // echo no users JSON
    echo json_encode($response);
}
}

else if($check == 'ingredients')
{
	$menudet = $_GET['incre_menu'];
$result = mysqli_query($localhost,"SELECT i.ir_ingredientname  FROM tbl_menuingredients mi left join tbl_ingredientmaster i on i.ir_ingredientid = mi.ms_ingridentid WHERE mi.ms_menuid = '".$menudet."'");
if (mysqli_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["incredient"] = array();
	
    while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $submenu = array();
        $submenu["ingred"] = $row["ir_ingredientname"];
        // push single product into final response array
        array_push($response["incredient"], $submenu);
    }
  // success
   $response["message"] = "found";
    $response["success"] = 1;

    // echoing JSON response
    echo json_encode($response);
} else {
    // no products found
    $response["success"] = 2;
    $response["message"] = "not";

    // echo no users JSON
    echo json_encode($response);
}

}

else if($check == 'cart_edit')
{
	
	$orderno	= $_GET['ordernum'];
	$numsl = $_GET['slnum'];
	
	$preferenceid = $_GET['preferenceid'];
	$quantity = $_GET['quantity'];
	$preftext = $_GET['preftext'];
	
	
	if($preferenceid=="NULL")
 	{
		$test = "UPDATE tbl_tableorder SET ter_qty = '".$quantity."',ter_preferencetext = '".$preftext."' where ter_orderno = '".$orderno."' and ter_slno = '".$numsl."'";
	}
	else
	{
		$test = "UPDATE tbl_tableorder SET ter_preference = '".$preferenceid."',ter_qty = '".$quantity."',ter_preferencetext = '".$preftext."' where ter_orderno = '".$orderno."' and ter_slno = '".$numsl."'";
	}
	
	//`tbl_tabledetails`(`ts_tableid`, `ts_tableidprefix`, `ts_status`, `ts_dineintime`, `ts_noofpersons`, `ts_orderno`)
	


	/*$test = "UPDATE tbl_tableorder SET ter_portion = '2',ter_preference = '6',ter_qty = '69',ter_preferencetext = 'nohrtin' where ter_orderno = 'TEMP*905119235' and ter_slno = '".$slnum."')";
	*/
	$result = mysqli_query($localhost,$test);
	
	if($result)
	{
		 $response["success"] = 1;
		 $response["message"] = "updated";
    	echo json_encode($response);
	}else
	{
		$response["success"] = 0;
		 $response["message"] = "failed";
    	echo json_encode($response);
	}
}

else if($check == 'preference')
{
	$menu = $_GET['menuid'];
	
//`tbl_menuprefmaster`(`mpr_menuid`, `mpr_prefeernce`) 
//`tbl_preferencemaster`(`pmr_id`, `pmr_name`) 	
$result = mysqli_query($localhost,"SELECT pm.pmr_id,pm.pmr_name  FROM tbl_preferencemaster as pm left join tbl_menuprefmaster as mm  on mm.mpr_prefeernce = pm.pmr_id WHERE mm.mpr_menuid = '".$menu."'");

if (mysqli_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["prefvalues"] = array();
	
    while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $submenu = array();
        $submenu["id"] = $row["pmr_id"];
		 $submenu["name"] = $row["pmr_name"];
        // push single product into final response array
        array_push($response["prefvalues"], $submenu);
    }
  // success
   $response["message"] = "ok";
    $response["success"] = 1;

    // echoing JSON response
    echo json_encode($response);
} else {
    // no products found
    $response["success"] = 0;
    $response["message"] = "no";

    // echo no users JSON
    echo json_encode($response);
}

}


else if($check == 'combination')
{
	$menu = $_GET['menuid'];

$result = mysqli_query($localhost,"SELECT distinct m.mr_menuname, mc.mn_menucombid , im.mes_imagename FROM tbl_menucombination mc LEFT JOIN tbl_menuimages im on im.mes_menuid = mc.mn_menuid LEFT JOIN tbl_menumaster m on m.mr_menuid = mc.mn_menucombid where mc.mn_menuid = '".$menu."' group by mc.mn_menucombid");

if (mysqli_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["combivalues"] = array();
	
    while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $submenu = array();
        $submenu["combi_id"] = $row["mn_menucombid"];
		$submenu["combi_name"] = $row["mr_menuname"];
		$submenu["combi_image"] = $row["mes_imagename"];
        // push single product into final response array
        array_push($response["combivalues"], $submenu);
    }
  // success
   $response["message"] = "ok";
    $response["success"] = 1;

    // echoing JSON response
    echo json_encode($response);
} else {
    // no products found
    $response["success"] = 0;
    $response["message"] = "no";

    // echo no users JSON
    echo json_encode($response);
}

}
else if($check == 'synchornot')
{
	$synch = $_GET['machineid'];
	$result = mysqli_query($localhost,"SELECT as_appmachiesych FROM tbl_appmachinedetails WHERE as_appmachineid = '".$synch."'");
	
	if (mysqli_num_rows($result)>0) {
        // successfully inserted into database
		while ($row = mysqli_fetch_array($result)) 
		{
        // temp user array
			$response["success"] = 1;
			$response["sync"] = $row["as_appmachiesych"]; 
		}
          echo json_encode($response);
    } 
	else 
	{
		while ($row = mysqli_fetch_array($result)) 
		{
			$response["success"] = 0;
			$response["sync"] = $row["as_appmachiesych"]; 
		}
		echo json_encode($response);
	}	
	
}


else if($check== 'serveall')
{
	$status = $_GET['status'];
	$orderdetails = $_GET['order_num'];
	
	$result = mysqli_query($localhost,"UPDATE tbl_tableorder SET ter_status= 'Served' WHERE ter_orderno = '".$orderdetails."' and ter_status = '".$status."' or ter_status = 'Ready'");
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


else if($check == "billsum")
{




	$oredernum = $_GET['ordernum'];
	
$sql="SELECT t.ter_portion,t.ter_rate_type,t.ter_unit_type,t.ter_unit_weight,t.ter_unit_id,t.ter_base_unit_id,m.mr_menuname as Name,m.mr_menuid as id, sum(t.ter_qty)as Qty,t.ter_rate as Rate ,t.ter_type as Type ,(sum(t.ter_qty) * t.ter_rate) as TRate,t.ter_kotno as KOT,t.ter_slno sl,t.ter_orderno as order_num   
FROM tbl_tableorder t,tbl_menumaster m 
where  t.ter_menuid = m.mr_menuid and ter_orderno= trim('".$oredernum."') and t.ter_status = 'Served'
GROUP BY ter_menuid,ter_type,ter_rate";

$sql_menu="SELECT t.ter_portion,t.ter_rate_type,t.ter_unit_type,t.ter_unit_weight,t.ter_unit_id,t.ter_base_unit_id,m.mr_menuname as Name,m.mr_menuid as id, sum(t.ter_qty)as Qty,t.ter_rate as Rate ,t.ter_type as Type ,(sum(t.ter_qty) * t.ter_rate) as TRate,t.ter_kotno as KOT,t.ter_slno sl,t.ter_orderno as order_num,t.ter_combo_entry_id FROM tbl_tableorder t,tbl_menumaster m where t.ter_menuid = m.mr_menuid and ter_orderno= trim('".$oredernum."') and t.ter_status = 'Served' and t.ter_combo_entry_id IS NULL GROUP BY ter_menuid,ter_type,ter_rate";


$sql_combo="SELECT cp.cp_pack_name as Name,sum(t.ter_qty)as Qty,cod.cod_combo_pack_rate as Rate ,t.ter_type as Type ,(sum(t.ter_qty) * cod.cod_combo_pack_rate) as TRate,t.ter_kotno as KOT,t.ter_slno sl,t.ter_orderno as order_num,t.ter_combo_entry_id 
FROM tbl_tableorder t 
left join tbl_combo_ordering_details cod on cod.cod_id=t.ter_combo_entry_id
left JOIN tbl_combo_packs cp on cp.cp_id=cod.cod_combo_pack_id
where ter_orderno= trim('".$oredernum."') and t.ter_status = 'Served' and t.ter_combo_entry_id IS NOT null  GROUP BY t.ter_count_combo_ordering,t.ter_orderno";

	$t=0;
	$result_menu = mysqli_query($localhost,$sql_menu);
	$result_combo = mysqli_query($localhost,$sql_combo);

	$t1=mysqli_num_rows($result_combo);
	$t2=mysqli_num_rows($result_menu);

	$t=$t1+$t2;
	//echo $t;
	if ($t>0) {
		$response["billsumm"] = array();
		$response["success"] = 1;
 		$response["message"] = "found";
	}else{
		$response["success"] = 0;
    	$response["message"] = "No products found";

	}



 if (mysqli_num_rows($result_menu) > 0) {
    
    while ($row = mysqli_fetch_array($result_menu)) {
        // temp user array
        $table = array();
        $table["Name"] = $row["Name"];
		$table["id"] = $row["id"];
		$table["Qty"] = $row["Qty"];
		$table["Rate"] = $row["Rate"];
		$table["Type"] = $row["Type"];
		$table["TRate"] = $row["TRate"];
		$table["Kot"] = $row["KOT"];
		$table["Serial_No"] = $row["sl"];
		$table["Order_num"] = $row["order_num"];

		$table["rate_type"] = $row["ter_rate_type"];
		$unit_type = $row["ter_unit_type"];
		    

		$unit_weight =number_format($row["ter_unit_weight"],$_SESSION["be_decimal"]);
 		
		if($table["rate_type"]=="Portion")
		{
			$p_id = $row["ter_portion"];
			$sql_p="SELECT pm_portionshortcode as Portion from tbl_portionmaster WHERE pm_id='".$p_id."'";
	
		}
		else
		 {
			if($unit_type=="Loose")
			{
				$base_unit_id = $row["ter_base_unit_id"];
				$sql_p="SELECT CONCAT('".$unit_weight."',bu_name) as Portion from tbl_base_unit_master WHERE bu_id='".$base_unit_id."'";
				
			}
			else
			 {
				$unit_id = $row["ter_unit_id"];
				$sql_p="SELECT CONCAT('".$unit_weight."',u_name) as Portion from tbl_unit_master WHERE u_id='".$unit_id."'";	
				
			}
		}

		$result_p=mysqli_query($localhost,$sql_p);
		if (mysqli_num_rows($result_p) > 0) {
			$row_p = mysqli_fetch_array($result_p);

			$table["Portion"] = $row_p["Portion"];
		}
		

		$table["Portion_name"] = "";
        // push single product into final response array
        array_push($response["billsumm"], $table);
    }
   
    
} 

if (mysqli_num_rows($result_combo) > 0) {
  
    
    
    while ($row = mysqli_fetch_array($result_combo)) {
        // temp user array
        $table = array();
        $table["Name"] = $row["Name"];
		$table["id"] = $row["id"];
		$table["Qty"] = $row["Qty"];
		$table["Rate"] = $row["Rate"];
		$table["Type"] = $row["Type"];
		$table["TRate"] = $row["TRate"];
		$table["Kot"] = $row["KOT"];
		$table["Serial_No"] = $row["sl"];
		$table["Order_num"] = $row["order_num"];

		$table["rate_type"] = $row["ter_rate_type"];
		$unit_type = $row["ter_unit_type"];
		    

		$unit_weight =number_format($row["ter_unit_weight"],$_SESSION["be_decimal"]);
 		
		
		

		$table["rate_type"] ="Combo";
		$table["Portion"] ="Combo";
		$table["Portion_name"] = "Combo";
        // push single product into final response array
        array_push($response["billsumm"], $table);
    }
  
    
    
} 


echo json_encode($response);
}

else if($check== 'tablenumbers')
{
	$ordernum = $_GET['ordernum'];
	
	$result = mysqli_query($localhost,"SELECT GROUP_CONCAT((CONCAT(trim(t.tr_tableno),trim(td.ts_tableidprefix))) SEPARATOR ',') as tabl_nprf FROM tbl_tabledetails td LEFT JOIN tbl_tablemaster t on t.tr_tableid = td.ts_tableid where ts_orderno = '".$ordernum."'");
	
	if(mysqli_num_rows($result)>0)
	{
		 while ($row = mysqli_fetch_array($result)) 
		{
 			$response["success"] = 1;
			$response["message"] = "found";
			$response["tablenpre"] = $row["tabl_nprf"]; 
		}
          echo json_encode($response);
	}else
	{
		$response["success"] = 0;
		$response["message"] = "not";
    	echo json_encode($response);
	}
	
}

else if($check== 'billalert')
{
 	$mobile = $_GET['mobile'];

 	$tableid = $_GET['tableid'];
	$type = $_GET['type'];
	$branchid = $_GET['branchid'];
	$ordernum = $_GET['ordernum'];
	$ds_type = $_GET['discounttype'];
	$ds_id = $_GET['discountid'];
	$dmode=$_GET['discmode'];//"P";
	$msg = $_GET['msg'];
	$cancel='0.00';
	$billno='';
	$ex=explode(",",$_GET['tableid']);
	$tableid=$ex[0];
	$tablestring = $_GET['table_num'];
	$printedby = $_GET['printedby'];
	
	$loyality_id = $_GET['loyality_id'];
	
	$discount_of_or='';
		  $discount_unit_or='';
		  $discount_or='';
		  $discountid_or='';
		  if($ds_type=="drop")
		  {
			  $discount_of_or=0;
			  $discount_unit_or=0;
			  $discount_or="Y";
			  $discountid_or=$ds_id;
		  }else if($ds_type=="text")
		  {

			 $discount_of_or=$ds_id;

			  $discount_unit_or=$dmode;
			  $discount_or="Y";
			  $discountid_or=0; 
		  }else if($ds_type=="empty")
		  {
			  $discount_of_or=0;
			  $discount_unit_or=0;
			  $discount_or="N";
			  $discountid_or=0; 
		  }
		
		
		
		mysqli_query($localhost,"SET @orderno = " . "'" . $ordernum . "'");
		mysqli_query($localhost,"SET @branchid = " . "'" . $branchid . "'");
		mysqli_query($localhost,"SET @discount_of = " . "'" . $discount_of_or . "'");
		mysqli_query($localhost,"SET @discount_unit = " . "'" . $discount_unit_or . "'");
		mysqli_query($localhost,"SET @discount = " . "'" . $discount_or . "'");
		mysqli_query($localhost,"SET @discountid = " . "'" . $discountid_or . "'");
		mysqli_query($localhost,"SET @tableno = " . "'" . $tablestring . "'");
		$billnumber='';$s='';$bill_proc_message='';
		
		/*echo "orddrnum-".$ordernum.',    branchid -   '.$branchid.',    cancelamt     '.$cancel.',      discount_of     '.$discount_of_or.
		',    discount_unit      '.$discount_unit_or.',    discount      '.$discount_or.',    discountid      '.$discountid_or.',     tableno     '.$tablestring.
		',  tableno     '.$tablestring;*/
		
		

		
		$sq=mysqli_query($localhost,"CALL proc_billgenerate(@orderno,@branchid,@discount_of,@discount_unit,@discount,@discountid,@tableno,0,@billnumber,@Message)");
		$rs = mysqli_query($localhost,'SELECT @billnumber AS billnumber,@Message AS message' );
		
		
		while($row = mysqli_fetch_array($rs))
		{
		$s= $row['billnumber'];
		$bill_proc_message= $row['message'];
		}
		 $billno=$s;
		

	
		
	$direct="";

	
	
		   $sql_branch =  mysqli_query($localhost,"Select be_directclosefirst from tbl_branchmaster where be_branchid='".$branchid."'"); 
		  $num_branch  = mysqli_num_rows($sql_branch);
		  if($num_branch)
		  {
				while($result_branch  = mysqli_fetch_array($sql_branch)) 
					{
						
						$direct= $result_branch["be_directclosefirst"];
						
					}
		  }
		
	  
	  if($direct=='Y') 
	 {
		 
		 mysqli_query($localhost,"SET @billno = " . "'" . $billno . "'");
		$message='';
		$sq=mysqli_query($localhost,"CALL proc_billclose(@billno,@message)");
		$rs = mysqli_query($localhost,'SELECT @message AS message' );
		while($row = mysqli_fetch_array($rs))
		{
		$s= $row['message'];
		}
	 }
	
	$result = mysqli_query($localhost,"INSERT INTO tbl_notifications(tbl_notificationtype,  tbl_message,tbl_billno,tbl_tableid) VALUES 
	('".$type."','".$msg."','".$billno."','".$tableid."')");

	$rt = mysqli_query($localhost,"update tbl_tablebillmaster set bm_cnumber='".$mobile."' where bm_billno='".$billno."'");
	
	
	if($result)
	{


	   	 $response1["success"] = 1;
	 	 $response1["message"] = "ok";
	 	 $response1["bill_no"] = $billno;
		 $response1["bill_reply"] = $bill_proc_message;

		 if ($billno!=null||$billno!="null") {
		 	$updatePrintedBy = mysqli_query($localhost,"UPDATE  tbl_tablebillmaster set bm_bill_printed_by='".$printedby."' where bm_billno='".$billno."'");
		 /*                                                                                                                     */
		 }
    	 echo json_encode($response1);




	 
		//print bill ends
		
	}else
	{
		if($billno=='')
		{
			 $response1["success"] = 1;
			 $billno = "mm";
		}
		else{
			$response["success"] = 0;
		}
			 $response1["message"] = "ok";
			 $response1["bill_no"] = $billno;
			 $response1["bill_reply"] = $bill_proc_message;
			 echo json_encode($response1);
	}
	
	
}



else if($check== 'taxvalues')
{
	$floorid = $_GET['floorid'];
	
	
	$result = mysqli_query($localhost,"SELECT fr_servicetax,fr_vat,fr_servicecharge FROM tbl_floormaster WHERE fr_floorid='".$floorid."'");
	
	if(mysqli_num_rows($result)>0)
	{
		 while ($row = mysqli_fetch_array($result)) 
		{
 			$response["success"] = 1;
			$response["message"] = "ok";
			$response["fr_servicetax"] = $row["fr_servicetax"]; 
			$response["fr_vat"] = $row["fr_vat"]; 
			$response["fr_servicecharge"] = $row["fr_servicecharge"]; 
		}
          echo json_encode($response);
	}else
	{
		$response["success"] = 0;
		$response["message"] = "not";
    	echo json_encode($response);
	}
	
}

else if($check== 'billedornot')
{
	$ordernum = $_GET['ordernum'];
	
	
	$result = mysqli_query($localhost,"select * from tbl_tabledetails where ts_orderno = '".$ordernum."' and ts_status = 'Billed'");
	
	if(mysqli_num_rows($result)>0)
	{
		 while ($row = mysqli_fetch_array($result)) 
		{
 			$response["success"] = 1;
		 	$response["message"] = "ok";
    	
		}
          echo json_encode($response);
	}else
	{
		$response["success"] = 0;
		$response["message"] = "not";
    	echo json_encode($response);
	}
	
}

else if($check== 'callwaiter')
{
	$tableid = $_GET['tableid'];
	$type = $_GET['type'];
	$msg = $_GET['msg'];
	$ex=explode(",",$_GET['tableid']);
	$tableid=$ex[0];
	
	$result = mysqli_query($localhost,"INSERT INTO tbl_notifications(tbl_notificationtype, tbl_tableid, tbl_message) VALUES ('".$type."','".$tableid."','".$msg."')");
	
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

else if($check== 'wateralert')
{
	$tableid = $_GET['tableid'];
	$type = $_GET['type'];
	$msg = $_GET['msg'];
	$ex=explode(",",$_GET['tableid']);
	$tableid=$ex[0];
	
	$result = mysqli_query($localhost,"INSERT INTO tbl_notifications(tbl_notificationtype, tbl_tableid, tbl_message) VALUES ('".$type."','".$tableid."','".$msg."')");
	
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
		$response["success"] = 0;
		$response["message"] = "NO";
    	echo json_encode($response);
	}
	
}

else if($check == 'itemfeddback')
{
	
	$order	= $_GET['ordernum'];
	$branch_id = $_GET['branchid'];

	$temp = "SELECT t.ter_slno,t.ter_menuid,t.ter_feedbackrating, t.ter_feedbackremarks, m.mr_menuname,oi.mes_imagename as image FROM tbl_tableorder t left join tbl_menumaster m on m.mr_menuid = t.ter_menuid left join tbl_menuimages as oi on oi.mes_menuid = t.ter_menuid where t.ter_orderno = trim('".$order."') and t.ter_branchid = '".$branch_id."' and (t.ter_status ='Served' or t.ter_status ='Closed' or t.ter_status ='Billed') group by t.ter_slno,t.ter_menuid, m.mr_menuname";
	
	
	//`tbl_tabledetails`(`ts_tableid`, `ts_tableidprefix`, `ts_status`, `ts_dineintime`, `ts_noofpersons`, `ts_orderno`)
	$result = mysqli_query($localhost,$temp);
	if (mysqli_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["order_values"] = array();
	
    while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $submenu = array();
        $submenu["menu_name"] = $row["mr_menuname"];
		$submenu["id"] = $row["ter_menuid"];
        $submenu["slno"] = $row["ter_slno"];
		$submenu["remarks"] = $row["ter_feedbackremarks"];
		$submenu["images"] = $row["image"];
		$submenu["rating"] = $row["ter_feedbackrating"];
		 
		
       // push single product into final response array
        array_push($response["order_values"], $submenu);
    }
  // success
   $response["message"] = "found";
    $response["response"] = 50;
	
    // echoing JSON response
    echo json_encode($response);
} else {
    // no products found
    $response["response"] = 51;
    $response["message"] = "No products found";
	
	
    // echo no users JSON
    echo json_encode($response);
}
}

else if($check== 'feedbackitem')
{
	$remarks = $_GET['remarks'];	
	$rating = $_GET['rating'];	
	$check = $_GET['check'];
	$sl = $_GET['slnum'];
	$ordernum = $_GET['orderno'];
	

	$sql = "UPDATE tbl_tableorder SET ter_feedbackrating='".$rating."',ter_feedbackremarks='".$remarks."',ter_feedbackenter='".$check."' WHERE ter_orderno='".$ordernum."' and ter_slno = '".$sl."'";
	
	$result = mysqli_query($localhost,$sql);
	//$rows = mysqli_num_rows($result);
	if($result)
	{
		$response["success"] = 1;
		 $response["message"] = "ok";
    	echo json_encode($response);
	}else
	{
		$response["success"] = 0;
		$response["message"] = "no";
    	echo json_encode($response);
	}
	
}

else if($check == 'generalfd')
{
	$branch_id = $_GET['branchid'];
	$orderid = $_GET['orderid'];
	/*$slq = "SELECT fbm_id, fbm_question FROM tbl_feedbackmaster WHERE fbm_branchid = '".$branch_id."' and `fbm_active` = 'Y'";*/
	
	$slq = "SELECT m.fbm_id, m.fbm_question,r.fbr_rate FROM tbl_feedbackmaster m left join tbl_feedbackrating r on r.fbr_fbm_id = m.fbm_id WHERE m.fbm_branchid = '".$branch_id."' and m.fbm_active = 'Y' and r.fbr_orderid='".$orderid."'";
	
	$result = mysqli_query($localhost,$slq);
	if (mysqli_num_rows($result) > 0) {
    // looping through all results
    // products nodegeneralfd
    $response["genarlvalues"] = array();
	
    while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $submenu = array();
        $submenu["sl"] = $row["fbm_id"];
        $submenu["questions"] = $row["fbm_question"];
		 $submenu["rating"] = $row["fbr_rate"];
		
		
       // push single product into final response array
        array_push($response["genarlvalues"], $submenu);
    }
  // success
   $response["message"] = "found";
    $response["response"] = 50;
	
    // echoing JSON response
    echo json_encode($response);
} else {
    // no products found
	
	$slq1 = "SELECT fbm_id, fbm_question FROM tbl_feedbackmaster WHERE fbm_branchid = '".$branch_id."' and `fbm_active` = 'Y'";
	$result = mysqli_query($localhost,$slq1);
	if (mysqli_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["genarlvalues"] = array();
	
    while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $submenu = array();
        $submenu["sl"] = $row["fbm_id"];
        $submenu["questions"] = $row["fbm_question"];
		
		
       // push single product into final response array
        array_push($response["genarlvalues"], $submenu);
    }
    $response["response"] = 51;
    $response["message"] = "No products found";
	
	
    // echo no users JSON
    echo json_encode($response);
	}
	else
	{
		$response["response"] = 52;
		$response["message"] = "No details";
		
		
		// echo no users JSON
		echo json_encode($response);
	}
}
	
}


else if($check== 'general_feeback')
{
	$branch_id = $_GET['branchid'];
	$slq1 = "SELECT fbm_id, fbm_question FROM tbl_feedbackmaster WHERE fbm_branchid = '".$branch_id."' and `fbm_active` = 'Y'";
	$result = mysqli_query($localhost,$slq1);
	
	if (mysqli_num_rows($result) > 0) 
	{
		// looping through all results
		// products node
		$response["genarlvalues"] = array();
		
		while ($row = mysqli_fetch_array($result)) {
			// temp user array
			$submenu = array();
			$submenu["sl"] = $row["fbm_id"];
			$submenu["questions"] = $row["fbm_question"];
		   // push single product into final response array
			array_push($response["genarlvalues"], $submenu);
		}
		$response["success"] = 1;
		$response["message"] = "products found";
		echo json_encode($response);
	}
	else
	{
		$response["success"] = 0;
		$response["message"] = "No details";
		echo json_encode($response);
	}
}





else if($check== 'feedbackinsert')
{
	$idvalues = $_GET['idvalues'];
	$ratingvalue = $_GET['ratingvalue'];
	$tableid = $_GET['tableid'];
	$orderid = $_GET['orderid'];
	if($tableid=='xyz')
	{
		$sql = "INSERT INTO `tbl_feedbackrating`(fbr_fbm_id, fbr_rate) VALUES ('".$idvalues."','".$ratingvalue."')";
	}
	else
	{
		$sql = "INSERT INTO `tbl_feedbackrating`(fbr_fbm_id, fbr_rate, fbr_table, fbr_orderid) VALUES ('".$idvalues."','".$ratingvalue."','".$tableid."' ,'".$orderid."')";
	}

	
	$result = mysqli_query($localhost,$sql);
	
	if($result)
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
}
else if($check== 'checkcount')
{
	$orderid = $_GET['ordernum'];
	
	$result = mysqli_query($localhost,"SELECT ter_orderno FROM tbl_tableorder WHERE ter_orderno = '".$orderid."' and ter_status!='Closed' or ter_status!='Billed'");
	if (mysqli_num_rows($result) > 0) 
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
	  
	
}

else if($check== 'check_printer')
{
	
	$result = mysqli_query($localhost,"SELECT be_printall,be_consolidated_print FROM tbl_branchmaster");
	if (mysqli_num_rows($result) > 0) 
	{
		 while ($row = mysqli_fetch_array($result)) {
			 $response["success"] = 1;
			 $response["message"] = $row["be_printall"];
			 $response["consolidated"] = $row["be_consolidated_print"];
			echo json_encode($response);
		 }
	}else
	{
		$response["success"] = 0;
		$response["message"] = "N";
		echo json_encode($response);
	}
}


else if($check== 'check_printer_cancel')
{
	
	$result = mysqli_query($localhost,"SELECT be_printall,be_kot_cancellation_print FROM tbl_branchmaster");
	if (mysqli_num_rows($result) > 0) 
	{
		 while ($row = mysqli_fetch_array($result)) {
			 $response["success"] = 1;
			 $response["message"] = $row["be_printall"];
			 $response["message1"] = $row["be_kot_cancellation_print"];
			echo json_encode($response);
		 }
	}else
	{
		$response["success"] = 0;
		$response["message"] = "N";
		echo json_encode($response);
	}
}

else if($check== 'check_printer_cancel')
{
	
	$result = mysqli_query($localhost,"SELECT be_printall FROM tbl_branchmaster");
	if (mysqli_num_rows($result) > 0) 
	{
		 while ($row = mysqli_fetch_array($result)) {
			 $response["success"] = 1;
			 $response["message"] = $row["be_printall"];
			echo json_encode($response);
		 }
	}else
	{
		$response["success"] = 0;
		$response["message"] = "N";
		echo json_encode($response);
	}
}

else if($check== 'check_rating')
{
	$orderid = $_GET['orderid'];
	
	$result = mysqli_query($localhost,"SELECT * FROM `tbl_feedbackrating` WHERE `fbr_orderid` = '".$orderid."'");
	if (mysqli_num_rows($result) > 0) 
	{
		 while ($row = mysqli_fetch_array($result)) {
			 $response["success"] = 0;
			 $response["message"] = "Y";
			echo json_encode($response);
		 }
	}else
	{
		$response["success"] = 1;
		$response["message"] = "N";
		echo json_encode($response);
	}
}


else if($check== 'getlivestock')
{
	$menuid = $_GET['menuid'];
	$date = $_GET['date'];
	
	$sql = "SELECT `mk_stock_number` FROM `tbl_menustock` WHERE `mk_menuid`= '".$menuid."' and `mk_date`= '".$date."'";
	
	$result = mysqli_query($localhost,$sql);
	
	if (mysqli_num_rows($result) > 0) 
	{
		 while ($row = mysqli_fetch_array($result)) {
			 $response["success"] = 1;
			 $s = $row["mk_stock_number"];
			 if($s==NULL)
			 {
				 $response["message"] = "N";
			 }
			 else
			 {
				  $response["message"] = $s;
			 }
			echo json_encode($response);
		 }
	}else
	{
		$response["success"] = 0;
		$response["message"] = "N";
		echo json_encode($response);
	}
}




else if($check=='stock_details')
{
	$todaydate = $_GET['date'];
	$maincategory = $_GET['maincat'];
	$subcategory = $_GET['subcat'];
	$stock = $_GET['stockactive'];
	
	$sql = "select m.mr_menuname,ms.mk_stock,ms.mk_menuid from tbl_menustock ms 
	left join tbl_menumaster m ON m.mr_menuid = ms.mk_menuid 
	left join tbl_menumaincategory mc ON mc.mmy_maincategoryid = m.mr_maincatid 
	left join tbl_menusubcategory su ON su.msy_subcategoryid = m.mr_subcatid 
	where  ms.`mk_date`='".$todaydate."' and m.mr_dailystock_in_number='N' and m.mr_dailystock='Y' 
	and m.mr_rate_type='Portion' and mc.mmy_active='Y' and m.mr_active='Y'";
	
	if($maincategory!="")
	{
		$sql = $sql. " and mc.mmy_maincategoryid = '".$maincategory."'";	
	}
	
	if($subcategory!="")
	{
		$sql = $sql. " and su.msy_subcategoryid = '".$subcategory."'";	
	}
	
	if($stock!="A")
	{
		$sql = $sql. " and ms.mk_stock = '".$stock."'";			
	}
	
	$result = mysqli_query($localhost,$sql);
//and tr_tableid NOT IN(select ts_tableid from tbl_tabledetails)
//$result = mysqli_num_rows($getFloor);

 if (mysqli_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["stock_update"] = array();
    
    while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $table = array();
        $table["m_name"] = $row["mr_menuname"];
		$table["m_id"] = $row["mk_menuid"];
		$table["m_stock"] = $row["mk_stock"];
		
        // push single product into final response array
        array_push($response["stock_update"], $table);
    }
    // success
    $response["success"] = 0;
 	$response["message"] = "ok";
    // echoing JSON response
    echo json_encode($response);
} else {
    // no products found
    $response["success"] = 1;
    $response["message"] = "No";

    // echo no users JSON
    echo json_encode($response);
}

}

else if($check== 'stock_update')
{
	$menuid = $_GET["menu_id"];
	$value = $_GET["value"];
	$date = $_GET["date"];

	$result = mysqli_query($localhost,"UPDATE `tbl_menustock` SET `mk_stock`='".$value."' WHERE `mk_menuid`='".$menuid."' and mk_date = '".$date."'");
	
	if($result)
	{
		 $response["success"] = 0;
		 $response["message"] = "ok";
    	echo json_encode($response);
	}else
	{
		$response["success"] = 1;
		$response["message"] = "fail";
    	echo json_encode($response);
	}
}



else if($check== 'getDate')
{
	
	$result = mysqli_query($localhost,"SELECT dc_day FROM tbl_dayclose WHERE dc_dateclose IS NULL");
	if (mysqli_num_rows($result) > 0) 
	{
		 while ($row = mysqli_fetch_array($result)) {
			 $response["success"] = 0;
			 $response["Date"] = $row["dc_day"];
			echo json_encode($response);
		 }
	}else
	{
		$response["success"] = 1;
		$response["Date"] = "empty";
		echo json_encode($response);
	}
}


else if($check== 'kotlist')
{
	$branchid = $_GET['branchid'];
	$ordernum = $_GET['ordernum'];
	$dayclose = $_GET['dayclose'];
	
	$ss = "select DISTINCT k.kr_kotno,k.kr_print from tbl_kotmaster k where k.kr_kotno in (select o.ter_kotno from tbl_tableorder o WHERE o.ter_orderno = '".$ordernum."' and o.ter_branchid = '".$branchid."' and o.ter_kotno<>'0') and k.kr_date='".$dayclose."' ORDER BY k.kr_print,k.kr_kotno";
	

	
	$result = mysqli_query($localhost,$ss);
	
	if (mysqli_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["kotlist"] = array();
	
    while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $submenu = array();
        $submenu["kot"] = $row["kr_kotno"];
		$submenu["kot_printed"] = $row["kr_print"];
		
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
    $response["message"] = "No products found";
	
	
    // echo no users JSON
    echo json_encode($response);
}
	
}

else if($check=='reprintonly')
{
	$billno = $_GET['billnumber'];
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

					$response["success"] = 7;
				    $response["message"] = "RE-Printed";
				    $response["bill_reply"] = "Reprinted";
				    echo json_encode($response);
			}else{
					$response["success"] = 0;
				    $response["message"] = "Print All-Disabled";
				    echo json_encode($response);
			}
		 }
	}else
	{
		$response["success"] = 0;
		$response["message"] = "N";
		echo json_encode($response);
	}
	
	
	
}







else if($check== 'reprintbillcheckstatus')
{
	$tableid = $_GET['tableid'];
	$type = $_GET['type'];
	$branchid = $_GET['branchid'];
	$ordernum = $_GET['ordernum'];
	
	$ds_type = $_GET['discounttype'];
	$ds_id = $_GET['discountid'];
	$dmode=$_GET['discmode'];//"P";//
	$msg = $_GET['msg'];
	$cancel='0.00';
	$tablestring = $_GET['table_num'];
	
$loyality_id = $_GET['loyality_id'];
	$ex=explode(",",$_GET['tableid']);
	$tableid=$ex[0];
	
	$result = mysqli_query($localhost,"SELECT  ter_billnumber FROM `tbl_tableorder` WHERE `ter_status` = 'Billed' and `ter_orderno` = '".$ordernum."'");
		if (mysqli_num_rows($result) > 0) 
		{
			while ($row = mysqli_fetch_array($result)) {
			 //repriint
				$billnumberreprint = $row["ter_billnumber"];
				
			}
		
			//    bill new print 
			billreprint($billnumberreprint,$branchid,"RE-Printed","Reprinted");
			$result = mysqli_query($localhost,"INSERT INTO tbl_notifications(tbl_notificationtype, tbl_tableid, tbl_message,tbl_billno) VALUES ('".$type."','".$tableid."','".$msg."','".$billnumberreprint."')");
			if($result)
			{
				
			}else
			{
				$response["success"] = 8;
				$response["message"] = "Re-print fail";
				echo json_encode($response);
			}
		}
		else
		{
			$result = mysqli_query($localhost,"SELECT * FROM `tbl_tableorder` WHERE `ter_status` != 'Served' and `ter_status` != 'Closed' and  `ter_orderno` =  '".$ordernum."'");
			
			if (mysqli_num_rows($result) > 0) 
			{
				 $response["success"] = 0;
				 $response["message"] = "Dishes Pending";
				echo json_encode($response);
			}
			else
			{
			//    bill new print 
			
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
		  
				mysqli_query($localhost,"SET @orderno = " . "'" . $ordernum . "'");
				mysqli_query($localhost,"SET @branchid = " . "'" . $branchid . "'");
				mysqli_query($localhost,"SET @cancelamt = " . "'" . $cancel . "'");
				mysqli_query($localhost,"SET @discount_of = " . "'" . $discount_of_or . "'");
				mysqli_query($localhost,"SET @discount_unit = " . "'" . $discount_unit_or . "'");
				mysqli_query($localhost,"SET @discount = " . "'" . $discount_or . "'");
				mysqli_query($localhost,"SET @discountid = " . "'" . $discountid_or . "'");
				mysqli_query($localhost,"SET @tableno = " . "'" . $tablestring . "'");
				mysqli_query($localhost,"SET @loyalty_id = " . "'" . $loyality_id . "'");
				$billnumber='';$s='';$bill_gen_reply='';
				$sq=mysqli_query($localhost,"CALL proc_billgenerate(@orderno,@branchid,@billnumber,@cancelamt,@discount_of,@discount_unit,@discount,@discountid,@tableno,@loyalty_id,@Message)");
				$rs = mysqli_query($localhost,'SELECT @billnumber AS billnumber, @Message AS bill_reply' );
				while($row = mysqli_fetch_array($rs))
				{
				$s= $row['billnumber'];
				$bill_gen_reply= $row['bill_reply'];
				}
	
				billreprint($s,$branchid,"Printed",$bill_gen_reply);
				
			$result = mysqli_query($localhost,"INSERT INTO tbl_notifications(tbl_notificationtype, tbl_tableid, tbl_message,tbl_billno) VALUES ('".$type."','".$tableid."','".$msg."','".$s."')");
			if($result)
			{
				
				
			}else
			{
				$response["success"] = 4;
				$response["message"] = "Print Failed";
				echo json_encode($response);
			}
			
		
			}
			
		}
		
		
		

}
else if($check== 'itemsratingcheck')
{
	$ordernum = $_GET['ordernum'];
	
	$result = mysqli_query($localhost,"SELECT `ter_feedbackenter` FROM `tbl_tableorder` WHERE `ter_orderno`='".$ordernum."' group by ter_feedbackenter");
	if (mysqli_num_rows($result) > 0) 
	{
		 while ($row = mysqli_fetch_array($result)) {
			
			 $checked = $row["ter_feedbackenter"];
			 
			 if($checked=="Y")
			 {
				  $response["success"] = 2;
				  $response["message"] = $checked;
				  echo json_encode($response);
			 }
			 else
			 {
				 $response["success"] = 3;
				 $response["message"] = $checked;
				 echo json_encode($response);
			 }
		
		 }
	}else
	{
		$response["success"] = 1;
		$response["Date"] = "empty";
		echo json_encode($response);
	}
}


else if($check== 'sendbillalert')
{
	$tableid = $_GET['tableid'];
	$type = $_GET['type'];
	$msg = $_GET['msg'];
	$ex=explode(",",$_GET['tableid']);
	$tableid=$ex[0];
	
	$result = mysqli_query($localhost,"INSERT INTO tbl_notifications(tbl_notificationtype, tbl_tableid, tbl_message) VALUES ('".$type."','".$tableid."','".$msg."')");
	
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

else if($check== 'new_registration')
{     

	
	$name = $_GET['name'];
	$mobile = $_GET['mobile'];
	$mail = $_GET['mail_id'];
	$dob = $_GET['dob'];
	//$anniversary = $_GET['anniversary'];
	$anniversary = '1984-12-04';
	$gender = $_GET['gender_selected'];
	
	
	$profession = $_GET['profession'];
	$lastname = $_GET['lastname'];
	$status=$_GET['status_selected'];
	
	$mail_status = $_GET['mail'];
	$sms = $_GET['sms'];

	$billno= $_GET['bill_no'];

	

	 // $search = mysqli_query($localhost,"SELECT ly_id FROM `tbl_loyalty_reg` WHERE `ly_mobileno`='".$mobile."'");
	  //if (mysqli_num_rows($search) > 0) 
		//{
	if ($dob==""&&$anniversary=="") {


		$resultI = mysqli_query($localhost,"INSERT INTO `tbl_loyalty_reg`(`ly_firstname`,`ly_gender`, `ly_lastname`, `ly_mobileno`, `ly_emailid`, `ly_profession`,ly_mailreceive,ly_smsreceive,ly_maritalstatus) VALUES ('".$name."','".$gender."','".$lastname."','".$mobile."','".$mail."','".$profession."','".$mail_status."','".$sms."','".$status."')");


	}

	else if ($anniversary=="") {


		$resultI = mysqli_query($localhost,"INSERT INTO `tbl_loyalty_reg`(`ly_firstname`,`ly_gender`, `ly_lastname`, `ly_mobileno`, `ly_emailid`, `ly_birthdaydate`, `ly_profession`,ly_mailreceive,ly_smsreceive,ly_maritalstatus) VALUES ('".$name."','".$gender."','".$lastname."','".$mobile."','".$mail."','".$dob."','".$profession."','".$mail_status."','".$sms."','".$status."')");

	}
	
	else if ($dob=="") {


		$resultI = mysqli_query($localhost,"INSERT INTO `tbl_loyalty_reg`(`ly_firstname`,`ly_gender`, `ly_lastname`, `ly_mobileno`, `ly_emailid`, `ly_anniversarydate`, `ly_profession`,ly_mailreceive,ly_smsreceive,ly_maritalstatus) VALUES ('".$name."','".$gender."','".$lastname."','".$mobile."','".$mail."','".$anniversary."','".$profession."','".$mail_status."','".$sms."','".$status."')");
	}

	
	else{
	
		$resultI = mysqli_query($localhost,"INSERT INTO `tbl_loyalty_reg`(`ly_firstname`,`ly_gender`, `ly_lastname`, `ly_mobileno`, `ly_emailid`, `ly_birthdaydate`, `ly_anniversarydate`, `ly_profession`,ly_mailreceive,ly_smsreceive,ly_maritalstatus) VALUES ('".$name."','".$gender."','".$lastname."','".$mobile."','".$mail."','".$dob."','".$anniversary."','".$profession."','".$mail_status."','".$sms."','".$status."')");
	}
		
	




			///********************
       // }

//echo $resultI;
$cus_id='';
        $result = mysqli_query($localhost,"SELECT ly_id FROM `tbl_loyalty_reg` WHERE `ly_mobileno`='".$mobile."'");
	if (mysqli_num_rows($result) > 0) 
	{
	while ($row = mysqli_fetch_array($result)) {
            $cus_id=$row['ly_id'];
            
            $result1 = mysqli_query($localhost,"UPDATE  tbl_tablebillmaster  set bm_feedback_customer='".$row['ly_id']."' where bm_billno='".$billno."' ");
            
        }
		
		
		$respons["success"] = 1;
			$respons["mail_status"] = $mail_status;
			$respons["sms"] = $sms;
			$respons["id"] = $cus_id;
		 	$respons["message"] = "Thank you for registering with us";
    		echo json_encode($respons);
		
        }else{

		$respons["success"] = 0;
			$respons["mail_status"] = '';
			$respons["sms"] = '';
			$respons["id"] = '';
		 	$respons["message"] = "Not registered ";
    		echo json_encode($respons);
			
		}
	
        
        
	
	
}


else if ($check=='sendloyaltymail') {

	$name = $_GET['name'];
	$mobile = $_GET['mobile'];
	$mail = $_GET['mail_id'];

	$mail_status = $_GET['mail'];
	$sms = $_GET['sms'];

	$result = mysqli_query($localhost,"SELECT be_loyality_reg_msg FROM `tbl_branchmaster`");
	
	$row = mysqli_fetch_array($result);
	$content=$row['be_loyality_reg_msg'];
	send_mail($mail,$name,$content);




}

else if ($check=='sendsms') {
	$name = $_GET['name'];
	$mobile = $_GET['mobile'];
	$result = mysqli_query($localhost,"SELECT be_loyality_reg_msg FROM `tbl_branchmaster`");
	
	$row = mysqli_fetch_array($result);
	$content=$row['be_loyality_reg_msg'];

	//dynamic_sms_api($mobile,$name,$content);
        
        
        $data = file_get_contents("https://app.getlead.co.uk/api/pushsms?username=919895313434"
                    . "&token=gl_eaca38edaf495f311f34&sender=GTLEAD&to=$mobile&message=$content&priority=11&message_type=0");
       
      if (strpos($data, 'success') !== false) {
        $msg = 'MESSAGE SENT';
      }else{
         $msg = 'NETWORK ERROR';
      }

       return   $msg;  
        
        
}


else if($check=='sendReview')
{
  
    $remark=$_GET['review_text'];
    $billno1=$_GET['bill_no'];
    $name=$_GET['name'];
    $mobileNo=$_GET['mobileNo'];
    
    if($billno1!='' && $billno1!='null' && $billno1!=null){
        
        $billno=$_GET['bill_no'];
    }else{
        $billno='General';
    }
    
     $date= date('Y-m-d H:i:s');
     
    $result555 = mysqli_query($localhost,"INSERT INTO tbl_feedback_remark_entry(tfb_customer,tfb_remarks, tfb_datetime, tfb_billno,tfb_mobile) VALUES ('".$name."','".$remark."','".$date."','".$billno."','".$mobileNo."')");
    //echo "INSERT INTO tbl_feedback_remark_entry(tfb_customer,tfb_remarks, tfb_datetime, tfb_billno,tfb_mobile) VALUES ('".$name."','".$remark."','".$date."','".$billno."','".$mobileNo."')";
                  $response["success"] = 1;
		  
		  echo json_encode($response);
    
    
}

else if($check== 'check_member')
{
	$mobile = $_GET['mobilenumber'];
	
	$result = mysqli_query($localhost,"SELECT ly_firstname,ly_lastname,ly_totalvisit,CONCAT(ly_firstname,' ',ly_lastname) as name,ly_id FROM `tbl_loyalty_reg` WHERE `ly_mobileno`='".$mobile."'");
	if (mysqli_num_rows($result) > 0) 
	{
		$response["visitcount"] = array();
	
              
                
    while ($row = mysqli_fetch_array($result)) {
        
         $first= $row["ly_firstname"];
               $last=$row["ly_lastname"];
               
        // temp user array
        $submenu = array();
        $submenu["visitcount"] = $row["ly_totalvisit"];
		$submenu["cust_name"] = $row["name"];
		$submenu["loyality_id"] = $row["ly_id"];
		
		
        array_push($response["visitcount"], $submenu);
    	}
			
		  $response["success"] = 0;
		  $response["message"] = "Already registered";
                   $response["firstname"] =$first;
                    $response["lastname"] = $last;
		  echo json_encode($response);
	
	}else
	{
		$response["success"] = 1;
		$response["message"] = "Not A Member yet";
		echo json_encode($response);
	}
}

else if($check == 'delete_tabel')
{
	$order	= $_GET['ordernum'];
	$sql = "DELETE FROM `tbl_tabledetails` WHERE `ts_orderno`='".$order."' and (ts_interface= 'A' OR ts_interface= 'E')";
	//echo $sql;
	$result = mysqli_query($localhost,$sql);
	if($result)
	{
		$response["success"] = 11;
		 $response["message"] = "Y";
    	echo json_encode($response);
	}else
	{
		$response["success"] = 2;
		$response["message"] = "N";
    	echo json_encode($response);
	}
}

else if($check== 'discount_deatils')
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


else if($check == 'staff_Details')
{
	$branchid = $_GET['branchid'];
	
//`tbl_menuprefmaster`(`mpr_menuid`, `mpr_prefeernce`) 
//`tbl_preferencemaster`(`pmr_id`, `pmr_name`) 	
/*$result = mysqli_query($localhost,"SELECT `ser_staffid`,concat(`ser_firstname`,`ser_lastname`) as name FROM `tbl_staffmaster` s left join tbl_designationmaster d on s.`ser_designation`= d.dr_designationid WHERE d.dr_designationname='Steward' and s.ser_employeestatus='Active' and s.ser_branchofficeid='".$branchid."'");
*/
$result = mysqli_query($localhost,"SELECT DISTINCT(concat(sm.ser_firstname,' ',sm.ser_lastname)) as name,sm.ser_staffid as ser_staffid
FROM `tbl_staffmaster` sm 
LEFT JOIN `tbl_designationmaster` dm on dm.`dr_designationid`=sm.`ser_designation` 
LEFT JOIN `tbl_logindetails` ld on ld.`ls_staffid`=sm.`ser_staffid`
LEFT JOIN `tbl_usermodules` um on um.um_username=ld.ls_username
LEFT JOIN tbl_modulemaster mm on mm.mer_moduleid=um.um_moduleid
WHERE  dm.`dr_takeorder`='Y' and trim(mm.mer_modulename)='Table Order' and um.um_access='Y'");

if (mysqli_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["staff_details"] = array();
	
    while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $submenu = array();
        $submenu["staffid"] = $row["ser_staffid"];
		 $submenu["staffname"] = $row["name"];
        // push single product into final response array
        array_push($response["staff_details"], $submenu);
    }
  // success
   $response["message"] = "ok";
    $response["success"] = 1;

    // echoing JSON response
    echo json_encode($response);
} else {
    // no products found
    $response["success"] = 0;
    $response["message"] = "no";

    // echo no users JSON
    echo json_encode($response);
}

}

else if($check == 'staff_Permission')

{
	$branchid = $_GET['branchid'];
	$pincode = $_GET['pincode'];
	
//`tbl_menuprefmaster`(`mpr_menuid`, `mpr_prefeernce`) 
//`tbl_preferencemaster`(`pmr_id`, `pmr_name`) 	
/*$result = mysqli_query($localhost,"SELECT `ser_staffid`,concat(`ser_firstname`,`ser_lastname`) as name FROM `tbl_staffmaster` s left join tbl_designationmaster d on s.`ser_designation`= d.dr_designationid WHERE d.dr_designationname='Steward' and s.ser_employeestatus='Active' and s.ser_branchofficeid='".$branchid."'");
*/
$result = mysqli_query($localhost,"SELECT DISTINCT(concat(sm.ser_firstname,' ',sm.ser_lastname)) as name,sm.ser_staffid as ser_staffid
FROM `tbl_staffmaster` sm 
LEFT JOIN `tbl_designationmaster` dm on dm.`dr_designationid`=sm.`ser_designation` 
LEFT JOIN `tbl_logindetails` ld on ld.`ls_staffid`=sm.`ser_staffid`
LEFT JOIN `tbl_usermodules` um on um.um_username=ld.ls_username
LEFT JOIN tbl_modulemaster mm on mm.mer_moduleid=um.um_moduleid
WHERE sm.`ser_authorisation_code`='".$pincode."' 
and dm.`dr_takeorder`='Y' and trim(mm.mer_modulename)='Table Order' and um.um_access='Y'");

if (mysqli_num_rows($result) > 0) {
    // looping through all results
    // products node
    //$response["staff_details"] = array();
	
   while ($row = mysqli_fetch_array($result)) {
			$response["message"] = "ok";
		    $response["success"] = 1;
		    $response["staffid"] = $row["ser_staffid"];
		    $response["staffname"] = $row["name"];
			echo json_encode($response);
		 }
  // success
  

    // echoing JSON response
   
} else {
    // no products found
    $response["success"] = 0;
    $response["message"] = "no";

    // echo no users JSON
    echo json_encode($response);
}

}

else if($check == 'staff_BillPermission')

{
	$branchid = $_GET['branchid'];
	$pincode = $_GET['pincode'];
	
//`tbl_menuprefmaster`(`mpr_menuid`, `mpr_prefeernce`) 
//`tbl_preferencemaster`(`pmr_id`, `pmr_name`) 	
/*$result = mysqli_query($localhost,"SELECT `ser_staffid`,concat(`ser_firstname`,`ser_lastname`) as name FROM `tbl_staffmaster` s left join tbl_designationmaster d on s.`ser_designation`= d.dr_designationid WHERE d.dr_designationname='Steward' and s.ser_employeestatus='Active' and s.ser_branchofficeid='".$branchid."'");
*/
$result = mysqli_query($localhost,"SELECT DISTINCT(concat(ld.ls_username)) as name,sm.ser_staffid as ser_staffid
FROM `tbl_staffmaster` sm 
LEFT JOIN `tbl_designationmaster` dm on dm.`dr_designationid`=sm.`ser_designation` 
LEFT JOIN `tbl_logindetails` ld on ld.`ls_staffid`=sm.`ser_staffid`
WHERE sm.ser_bill_print_permission='Y' and sm.`ser_authorisation_code`='".$pincode."'");

/*echo "SELECT DISTINCT(concat(ld.ls_username)) as name,sm.ser_staffid as ser_staffid
FROM `tbl_staffmaster` sm 
LEFT JOIN `tbl_designationmaster` dm on dm.`dr_designationid`=sm.`ser_designation` 
LEFT JOIN `tbl_logindetails` ld on ld.`ls_staffid`=sm.`ser_staffid`
WHERE sm.ser_bill_print_permission='Y' and sm.`ser_authorisation_code`='".$pincode."'";*/

if (mysqli_num_rows($result) > 0) {
    // looping through all results
    // products node
    //$response["staff_details"] = array();
	
   while ($row = mysqli_fetch_array($result)) {
			$response["message"] = "ok";
		    $response["success"] = 1;
		    $response["staffid"] = $row["ser_staffid"];
		    $response["staffname"] = $row["name"];
			echo json_encode($response);
		 }
  // success
  

    // echoing JSON response
   
} else {
    // no products found
    $response["success"] = 0;
    $response["message"] = "no";

    // echo no users JSON
    echo json_encode($response);
}

}

else if($check == 'staff_settlePermission')

{
	$branchid = $_GET['branchid'];
	$pincode = $_GET['pincode'];
	
//`tbl_menuprefmaster`(`mpr_menuid`, `mpr_prefeernce`) 
//`tbl_preferencemaster`(`pmr_id`, `pmr_name`) 	
/*$result = mysqli_query($localhost,"SELECT `ser_staffid`,concat(`ser_firstname`,`ser_lastname`) as name FROM `tbl_staffmaster` s left join tbl_designationmaster d on s.`ser_designation`= d.dr_designationid WHERE d.dr_designationname='Steward' and s.ser_employeestatus='Active' and s.ser_branchofficeid='".$branchid."'");
*/
$result = mysqli_query($localhost,"SELECT DISTINCT(concat(ld.ls_username)) as name,sm.ser_staffid as ser_staffid
FROM `tbl_staffmaster` sm 
LEFT JOIN `tbl_designationmaster` dm on dm.`dr_designationid`=sm.`ser_designation` 
LEFT JOIN `tbl_logindetails` ld on ld.`ls_staffid`=sm.`ser_staffid`
WHERE sm.ser_bill_settle_permission='Y' and sm.`ser_authorisation_code`='".$pincode."'");

/*echo "SELECT DISTINCT(concat(ld.ls_username)) as name,sm.ser_staffid as ser_staffid
FROM `tbl_staffmaster` sm 
LEFT JOIN `tbl_designationmaster` dm on dm.`dr_designationid`=sm.`ser_designation` 
LEFT JOIN `tbl_logindetails` ld on ld.`ls_staffid`=sm.`ser_staffid`
WHERE sm.ser_bill_print_permission='Y' and sm.`ser_authorisation_code`='".$pincode."'";*/

if (mysqli_num_rows($result) > 0) {
    // looping through all results
    // products node
    //$response["staff_details"] = array();
	
   while ($row = mysqli_fetch_array($result)) {
			$response["message"] = "ok";
		    $response["success"] = 1;
		    $response["staffid"] = $row["ser_staffid"];
		    $response["staffname"] = $row["name"];
			echo json_encode($response);
		 }
  // success
  

    // echoing JSON response
   
} else {
    // no products found
    $response["success"] = 0;
    $response["message"] = "no";

    // echo no users JSON
    echo json_encode($response);
}

}


else if($check == 'combine_list')
{
	$branchid = $_GET['branchid'];
	$floorid = $_GET['floorid'];
	$ordernum = $_GET['ordernum'];
	
//`tbl_menuprefmaster`(`mpr_menuid`, `mpr_prefeernce`) 
//`tbl_preferencemaster`(`pmr_id`, `pmr_name`) 

	
$result = mysqli_query($localhost,"SELECT GROUP_CONCAT((CONCAT(trim(t.tr_tableno),concat('(',(trim(td.ts_tableidprefix)),')'))) SEPARATOR ',') as list ,td.ts_orderno FROM tbl_tabledetails td LEFT JOIN tbl_tablemaster t on t.tr_tableid = td.ts_tableid where t.tr_branchid ='".$branchid."' and t.tr_floorid ='".$floorid."' and td.ts_status = 'Served' and td.ts_orderno!='".$ordernum."' GROUP BY ts_orderno ORDER BY td.ts_dineintime DESC");

if (mysqli_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["combine_details"] = array();
	
    while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $submenu = array();
        $submenu["tabel_num"] = $row["list"];
		$submenu["order_num"] = $row["ts_orderno"];
        // push single product into final response array
        array_push($response["combine_details"], $submenu);
    }
  // success
   $response["message"] = "ok";
    $response["success"] = 1;

    // echoing JSON response
    echo json_encode($response);
} else {
    // no products found
    $response["success"] = 0;
    $response["message"] = "no";

    // echo no users JSON
    echo json_encode($response);
}

}







/***************************************HUG A MUG************************************************/


else if($check=='insertmac_HAM')
{
	$machid = $_GET['machineid'];
	$ret = '';
	$checkmachine = "select * from tbl_appmachinedetails where as_appmachineid = '".$machid."' and as_status = 'Active'";
	$result = mysqli_query($localhost,$checkmachine);
	if(mysqli_num_rows($result) == 0)
	{
		//echo "INSERT INTO `tbl_appmachinedetails`(`as_appmachineid`) VALUES ('".$machid."')";
		$result1 = mysqli_query($localhost,"INSERT INTO `tbl_appmachinedetails`(`as_appmachineid`) VALUES ('".$machid."')");
		$ret = 'new';	
		
		$response["message"] = $ret;
		$response["success"] = 1;
		
		// echoing JSON response
		echo json_encode($response);
		
	}
	else
	{
		$ret = 'old';
		$response["message"] = $ret;
		$response["success"] = 0;
		
		// echoing JSON response
		echo json_encode($response);
	}
}
else if($check == 'secret_key')
{
	$keyvalue	= $_GET['keyvalue'];
	$sql = "select `be_androidpasscode` from tbl_branchmaster where be_androidpasscode='".$keyvalue."'";
	$result = mysqli_query($localhost,$sql);
	$result_sec = mysqli_num_rows($result);
	
	
	
	
	if($result_sec)
	{
		$response["success"] = 1;
		$response["message"] = "ok";
    	echo json_encode($response);
	}
	else
	{
		$response["success"] = 0;
		$response["message"] = "Please enter a valid key to enter";
    	echo json_encode($response);
	}
}

else if($check == 'changeTable')
{
	
	$oldid = $_GET['oldid'];
	$oldpref = $_GET['oldpref'];
	$changeid = $_GET['changeid'];
	$changepref = $_GET['changepref'];
	$new_floorid=$_GET['new_floorid'];

	$srt='';
	$statusresult = '';
	$sq='';
	
	$billedornot = mysqli_query($localhost,"SELECT `ts_status` FROM `tbl_tabledetails` WHERE `ts_tableid`='".$oldid."' and `ts_tableidprefix`='".$oldpref."'");
	
	
	
	if (mysqli_num_rows($billedornot) > 0) 
	{
 		while ($row = mysqli_fetch_array($billedornot)) 
		
		{
			$statusresult = $row['ts_status'];
	//		print $statusresult;
	//		exit();
    	}
	}
	
	if($statusresult!='Billed')
	{
			 mysqli_query($localhost,"SET @prev_tableid = " . "'" . $oldid . "'");
			 mysqli_query($localhost,"SET @prev_prefix = " . "'" . $oldpref . "'");
			 mysqli_query($localhost,"SET @new_tableid = " . "'" . $changeid . "'");
			 mysqli_query($localhost,"SET @new_prefix  = " . "'" .$changepref . "'");


			// mysqli_query($localhost,"SET @message = " . "''");
			
			//$sq= mysqli_query($localhost,"CALL proc_tablechange(@prev_tableid,@prev_prefix,@new_tableid,@new_prefix,@new_floor_id,@message)") ;


  			mysqli_query($localhost,"SET @new_floor_id  = " . "'" .$new_floorid. "'");
			
			$sq= mysqli_query($localhost,"CALL proc_tablechange(@prev_tableid,@prev_prefix,@new_tableid,@new_prefix,@new_floor_id,@message)") ;
			


			$rs = mysqli_query($localhost, 'SELECT @message AS message' );
			while($row = mysqli_fetch_array($rs))
			{
			 $srt= $row['message'];
			}
	}
	else
	{
		$srt= "Bill already generated";
	}

	
			 
	if($sq)
	{
		$response["success"] = 0;
		$response["message"] = $srt;
    	echo json_encode($response);
	}
	else
	{
		$response["success"] = 1;
		$response["message"] = $srt;
    	echo json_encode($response);
	}
	 
}

else if($check == 'check_table_details')
{
	$table_id = $_GET['table_id'];
	$table_pref = $_GET['table_pref'];
	
	$sql = "SELECT `ts_orderno` FROM `tbl_tabledetails` WHERE `ts_tableid`='".$table_id."' and `ts_tableidprefix` = '".$table_pref."'";
	$billedornot = mysqli_query($localhost,$sql);
	
	if(mysqli_num_rows($billedornot) > 0)
	{
		while ($row = mysqli_fetch_array($billedornot)) 
		{
			$response["success"] = 0;
			$response["ordernum"] = $row['ts_orderno'];
    		echo json_encode($response);
    	}
	}
	else
	{
		$response["success"] = 1;
		$response["ordernum"] = "no";
    	echo json_encode($response);
	}
	
	
}


else if($check == 'order_count')
{
	$order_num = $_GET['order_num'];
	
	
	$sql = "SELECT count(*) as leng from tbl_tableorder where ter_orderno='".$order_num."'";
	
	$value = mysqli_query($localhost,$sql);
	
	if(mysqli_num_rows($value) > 0)
	{
		while ($row = mysqli_fetch_array($value)) 
		{
			$response["response"] = 1;
			$response["len"] = $row['leng'];
    		echo json_encode($response);
    	}
	}
	else
	{
		$response["response"] = 0;
		$response["len"] = "0";
    	echo json_encode($response);
	}
	
	
}

/******************************** Version  2 ****************************/

else if($check == 'staffid_get')
{
	$username = $_GET['user_name'];
	$branchid = $_GET['branchid'];
	
	$sql = "SELECT `ls_staffid` FROM `tbl_logindetails` WHERE `ls_status`='Y' and `ls_username`='".$username."' and `ls_branchid` = '".$branchid."'";
	
	$result = mysqli_query($localhost,$sql);
	$submenu = "";
	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_array($result)) {
			// temp user array
			$submenu = $row["ls_staffid"];
		}
	  // success
	   $response["message"] = "ok";
	   $response["staffid"] = $submenu;
	   $response["success"] = 1;
		// echoing JSON response
    echo json_encode($response);
	} else {
		// no products found
		$response["success"] = 0;
		$response["message"] = "no";
		$response["staffid"] = $submenu;
		// echo no users JSON
		echo json_encode($response);
	}
	
}

else if($check == 'check_order_status')
{
	$ordernum = $_GET['ordernum'];
	
	$sql = "SELECT `ter_status` FROM `tbl_tableorder` WHERE `ter_orderno` = '".$ordernum."'";
	
	$result = mysqli_query($localhost,$sql);
	$status = "";
	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_array($result)) {
			// temp user array
			$status = $row["ter_status"];
		}
	  // success
	   $response["message"] = "ok";
	   $response["status"] = $status;
	   $response["success"] = 1;
		// echoing JSON response
    echo json_encode($response);
	} else {
		// no products found
		$response["success"] = 0;
		$response["message"] = "no";
		$response["status"] = $status;
		// echo no users JSON
		echo json_encode($response);
	}
	
}

else if($check == 'bill_regenerate')
{
	 $secret_key = $_GET['secret_key'];
	 $staff_id =$_GET['staff_id'];
	 $reason =$_GET['reason'];
	 $login_staff_id = $_GET['login_staff_id'];
	 $bill_number =$_GET['bill_number'];
	
		mysqli_query($localhost,"SET @secretkey = " . "'" . $secret_key . "'");
		mysqli_query($localhost,"SET @staffid = " . "'" . $staff_id . "'");
		mysqli_query($localhost,"SET @reason = " . "'" . $reason . "'");
		mysqli_query($localhost,"SET @loginid = " . "'" . $login_staff_id . "'");
		mysqli_query($localhost,"SET @regen_billno = " . "'" . $bill_number . "'");
		
		$reply='';
		$message='';
		
		if($staff_id!='')
		  {
			  $dateexp=date("Y-m-d H:i:s");
			  $sql_table_sel3  = mysqli_query($localhost,"SELECT * from tbl_staffmaster  WHERE  ser_staffid ='".$staff_id."' AND  ser_employeestatus='Active'");
			  $rrt='';
			  $num_table3  = mysqli_num_rows($sql_table_sel3);
			  if($num_table3)
			  {
				  while($row = mysqli_fetch_array($sql_table_sel3))
					{
					$rrt= $row['ser_cancelwithkey'];
					}
			  }
			if($rrt=="Y")
				{  
					$result= "yes";
					$sql=mysqli_query($localhost,"UPDATE tbl_secretkeymaster SET `sr_expiredtime`='".$dateexp."' WHERE (sr_key='".$secret_key."' )  AND (`sr_expiredtime`='0000-00-00 00:00:00' OR sr_expiredtime IS NULL)");
			  }else
			  {
					$result= "no";
					$sql=mysqli_query($localhost,"UPDATE tbl_secretkeymaster SET `sr_expiredtime`='".$dateexp."' WHERE (sr_password='".md5($secret_key)."')  AND (`sr_expiredtime`='0000-00-00 00:00:00' OR sr_expiredtime IS NULL)");
			  }		
		  }
			  
		
		
		$regenrate = mysqli_query($localhost,"CALL proc_bill_regenerate(@regen_billno,@secretkey,@staffid,@reason,@loginid,@message)");
		
		$rs = mysqli_query($localhost, 'SELECT @message AS message');
		
		while($row = mysqli_fetch_array($rs))
		{
			$reply= $row['message'];
		}
		//echo "dfS";
		
	if($reply!='')
	{
		$response["success"] = 1;
		$response["reply"] = $reply;
		echo json_encode($response);
	}
	else
	{
		$response["success"] = 0;
		$response["reply"] = "Fail";
		echo json_encode($response);
	}
	
}

else if($check == 'table_order_details')
{
	$branchid = $_GET['branchid'];
	$dayclodedate = $_GET['dayclodedate'];
	$floorid = $_GET['floorid'];
	
	$sql = "SELECT b.bm_billno,b.bm_finaltotal, b.bm_tableno,b.bm_billtime,f.fr_floorname,b.bm_bill_is_split,f.fr_floorid 
FROM tbl_tablebillmaster b left join tbl_floormaster f
on b.bm_floorid = f.fr_floorid WHERE ((b.bm_status='Billed') ) 
AND  b.bm_dayclosedate ='".$dayclodedate."' 
AND b.bm_billno not like 'Temp%' ";

	if($floorid == "")
	{
		$sql = $sql." group by b.bm_billno order by b.bm_billtime";
	}
	else
	{
		$sql = $sql." AND f.fr_floorid='".$floorid."' group by b.bm_billno order by b.bm_billtime";
	}
	
	$result = mysqli_query($localhost,$sql);
	
	if (mysqli_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["table_orders"] = array();
	
    while ($row = mysqli_fetch_array($result)) {
        // temp user array

        $split=$row["bm_bill_is_split"];
        if ($split=="Y") {
        	$split='N';
        }
        else{
        	$split='Y';
        }
        $submenu = array();
        $submenu["tr_tableno"] = $row["bm_tableno"];
	//	$submenu["ts_tableidprefix"] = $row["ts_tableidprefix"];
		$submenu["bm_finaltotal"] = $row["bm_finaltotal"];
		$submenu["ts_dineintime"] = date("g:i:s a", strtotime($row["bm_billtime"]));
		$submenu["ts_orderno"] = "";
		$submenu["fr_floorname"] = $row["fr_floorname"];
		$submenu["ts_tableid"] = $row["bm_tableno"];
		$submenu["ts_billnumber"] = $row["bm_billno"];
		$submenu["bm_can_regenerate"] = $split;
		
        // push single product into final response array
        array_push($response["table_orders"], $submenu);
    }
  // success
   $response["message"] = "ok";
    $response["success"] = 1;

    // echoing JSON response
    echo json_encode($response);
} else {
    // no products found
    $response["success"] = 0;
    $response["message"] = "no";

    // echo no users JSON
    echo json_encode($response);
}
}


else if($check == 'bill_detials')
{
	$billnumber = $_GET['bill_number'];
	$rate = 0;
	
	$sql = "SELECT * from tbl_tablebilldetails as td LEFT JOIN tbl_menumaster as mn ON td.bd_menuid=mn.mr_menuid LEFT JOIN tbl_portionmaster as pm ON td.bd_portion=pm.pm_id WHERE td.bd_billno='".$billnumber."' AND bd_cancelled='N' order by td.bd_billslno ";
	$sql1 ="SELECT * from tbl_tablebillmaster WHERE bm_billno ='".$billnumber."'";
		$result1 = mysqli_query($localhost,$sql1);
	if(mysqli_num_rows($result1) >0)
	{
			while($row = mysqli_fetch_array($result1))
		{
			$discount_list = array();
	  $discount= $row["bm_discountvalue"];
	  $pay_amount= $row["bm_total"];
	
		}
	}
	$result = mysqli_query($localhost,$sql);

	if(mysqli_num_rows($result) >0)
	{
		$response["order_details"] = array();
		
		while($row = mysqli_fetch_array($result))
		{
			$submenu = array();
			$rate=$rate + ($row['bd_qty'] * $row['bd_rate']);

			$submenu["bill_itemname"] = $row["mr_itemshortcode"];
			$submenu["bill_qty"] = $row["bd_qty"];
			$submenu["bill_rate"] = $row["bd_rate"];
			$submenu["bill_amount"] = $row["bd_amount"];
			array_push($response["order_details"], $submenu);
			
		}
		
		$response["message"] = "ok";
    	$response["success"] = 50;
		$response["total"] = $rate;
		$response["discount"] = $discount;
		$response["pay_amount"] = $pay_amount;
    	echo json_encode($response);
	}
	else
	{
		$response["message"] = "no";
    	$response["success"] = 51;
    	echo json_encode($response);
	}
}

else if($check == 'bill_detials_cs')
{
	$billnumber = $_GET['bill_number'];
	$rate = 0;
	
	$sql = "SELECT * from tbl_takeaway_billdetails as td LEFT JOIN tbl_menumaster as mn ON td.tab_menuid=mn.mr_menuid LEFT JOIN tbl_portionmaster as pm ON td.tab_portion=pm.pm_id WHERE td.tab_billno='".$billnumber."' AND tab_cancelled='N' order by td.tab_slno ";
	
	
	$result = mysqli_query($localhost,$sql);
	if(mysqli_num_rows($result) >0)
	{
		$response["order_details"] = array();
		
		while($row = mysqli_fetch_array($result))
		{
			$submenu = array();
			$rate=$rate + ($row['tab_qty'] * $row['tab_rate']);
			$submenu["bill_itemname"] = $row["mr_itemshortcode"];
			$submenu["bill_qty"] = $row["tab_qty"];
			$submenu["bill_rate"] = $row["tab_rate"];
			$submenu["bill_amount"] = $row["tab_amount"];
			array_push($response["order_details"], $submenu);
			
		}
		
		$response["message"] = "ok";
    	$response["success"] = 50;
		$response["total"] = $rate;
    	echo json_encode($response);
	}
	else
	{
		$response["message"] = "no";
    	$response["success"] = 51;
    	echo json_encode($response);
	}
}

else if($check == 'bill_detials_counter_all')
{
	$billnumber = $_GET['bill_number'];
	$rate = 0;
	
	$sql = "SELECT *,ROUND(td.tab_unit_weight, 1) AS tab_unit_weight from tbl_takeaway_billdetails as td LEFT JOIN tbl_menumaster as mn ON td.tab_menuid=mn.mr_menuid LEFT JOIN tbl_portionmaster as pm ON td.tab_portion=pm.pm_id WHERE td.tab_billno='".$billnumber."' order by td.tab_slno ";

	/*$sql = "SELECT pm.pm_portionname,td.* from tbl_takeaway_billdetails as td LEFT JOIN tbl_menumaster as mn ON td.tab_menuid=mn.mr_menuid LEFT JOIN tbl_portionmaster as pm ON td.tab_portion=pm.pm_id WHERE td.tab_billno='".$billnumber."' AND tab_cancelled='N' order by td.tab_slno ";*/
	
	
	$result = mysqli_query($localhost,$sql);
	if(mysqli_num_rows($result) >0)
	{
		$response["order_details"] = array();
		
		while($row = mysqli_fetch_array($result))
		{
			$submenu = array();
			$rate=$rate + ($row['tab_qty'] * $row['tab_rate']);
			$submenu["bill_itemname"] = $row["mr_itemshortcode"];
			$submenu["bill_qty"] = $row["tab_qty"];
			$submenu["bill_rate"] = $row["tab_rate"];
			$submenu["bill_amount"] = $row["tab_amount"];

			$unit=$row["tab_rate_type"];

			
			if ($unit=="Portion") 
			{

				$portion= $row["pm_portionname"];
					$unit=$unit." ".$portion;
			}else{

				$unit=$row['tab_unit_type'];
				$q=$row["tab_unit_weight"];

				$y;
				$sql_unit;
				if ($unit=="Packet") {
					$y=$row["tab_unit_id"];
					$sql_unit="select u_name as name  from tbl_unit_master where u_id='".$y."'";
				}else{

					$y=$row["tab_base_unit_id"];
					$sql_unit="select bu_name as name from tbl_base_unit_master where bu_id='".$y."'";
				}

				
				$result_unit = mysqli_query($localhost,$sql_unit);
				if(mysqli_num_rows($result_unit) >0)
				{
					while($r = mysqli_fetch_array($result_unit))
					{
						$q=$q." ".$r["name"];
						$unit=$unit." ".$q;
					}
				}

					
					
					

					/*if ($unit=="Packet") {


					}*/
			}

			$submenu["unit"] = $unit;
			array_push($response["order_details"], $submenu);
			
		}
		
		$response["message"] = "ok";
    	$response["success"] = 50;
		$response["total"] = $rate;
    	echo json_encode($response);
	}
	else
	{
		$response["message"] = "no";
    	$response["success"] = 51;
    	echo json_encode($response);
	}
}

else if($check == 'drop_down_details')
{
	$sql = "select * from tbl_paymentmode where pym_active = 'Y'";
	
	$result = mysqli_query($localhost,$sql);
	if(mysqli_num_rows($result) >0)
	{
		$response["drop_array"] = array();
		
		while($row = mysqli_fetch_array($result))
		{
			$submenu = array();
			$submenu["drop_int_id"] = $row["pym_id"];
			$submenu["drop_id"] = $row["pym_code"];
			$submenu["drop_value"] = $row["pym_name"];
			
			array_push($response["drop_array"], $submenu);
			
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


else if($check == 'drop_down_details_counter')
{
	$sql = "select * from tbl_paymentmode where pym_takeaway_view = 'Y'";
	
	$result = mysqli_query($localhost,$sql);
	if(mysqli_num_rows($result) >0)
	{
		$response["drop_array"] = array();
		
		while($row = mysqli_fetch_array($result))
		{
			$submenu = array();
			$submenu["drop_int_id"] = $row["pym_id"];
			$submenu["drop_id"] = $row["pym_code"];
			$submenu["drop_value"] = $row["pym_name"];
			
			array_push($response["drop_array"], $submenu);
			
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






else if($check == 'drop_down_details_change_payment')
{
	$sql = "select * from tbl_paymentmode where pym_active = 'Y' and pym_changesettled_view = 'Y'";
	
	$result = mysqli_query($localhost,$sql);
	if(mysqli_num_rows($result) >0)
	{
		$response["drop_array"] = array();
		
		while($row = mysqli_fetch_array($result))
		{
			$submenu = array();
			$submenu["drop_int_id"] = $row["pym_id"];
			$submenu["drop_id"] = $row["pym_code"];
			$submenu["drop_value"] = $row["pym_name"];
			
			array_push($response["drop_array"], $submenu);
			
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


else if($check == 'bank_detials')
{
	$sql = "select * from tbl_bankmaster where bm_active = 'Y'";
	
	$result = mysqli_query($localhost,$sql);
	if(mysqli_num_rows($result) >0)
	{
		$response["bank_values"] = array();
		
		while($row = mysqli_fetch_array($result))
		{
			$submenu = array();
			$submenu["bank_id"] = $row["bm_id"];
			$submenu["bank_name"] = $row["bm_name"];
			
			
			array_push($response["bank_values"], $submenu);
			
		}
		
		$response["message"] = "ok";
    	$response["success"] = 0;
		echo json_encode($response);
	}
	else
	{
		$response["message"] = "no";
    	$response["success"] = 1;
    	echo json_encode($response);
	}
}


///////**************card

else if($check == 'cardtype_detials')
{
	$sql = "SELECT `crd_name`,`crd_id` FROM `tbl_cardmaster` WHERE `crd_active` = 'Y'";
	
	
	$result = mysqli_query($localhost,$sql);
	if(mysqli_num_rows($result) >0)
	{
		$response["card_types"] = array();
		
		while($row = mysqli_fetch_array($result))
		{
			$submenu = array();
			$submenu["card_id"] = $row["crd_id"];
			$submenu["card_name"] = $row["crd_name"];
			
			array_push($response["card_types"], $submenu);
			
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


//////////////////****
else if($check == 'coupon_detials')
{
	$sql = "SELECT * FROM `tbl_couponcompany` WHERE `cy_active` = 'Yes'";
	
	$result = mysqli_query($localhost,$sql);
	if(mysqli_num_rows($result) >0)
	{
		$response["coupon_values"] = array();
		
		while($row = mysqli_fetch_array($result))
		{
			$submenu = array();
			$submenu["coupon_name"] = $row["cy_companyname"];
			
			array_push($response["coupon_values"], $submenu);
			
		}
		
		$response["message"] = "ok";
    	$response["success"] = 0;
		echo json_encode($response);
	}
	else
	{
		$response["message"] = "no";
    	$response["success"] = 1;
    	echo json_encode($response);
	}
}

else if($check == 'credit_detials')
{
	$sql = "SELECT * FROM `tbl_credit_types` WHERE `ct_active` = 'Y'";
	
	$result = mysqli_query($localhost,$sql);
	if(mysqli_num_rows($result) >0)
	{
		$response["credit_values"] = array();
		
		while($row = mysqli_fetch_array($result))
		{
			$submenu = array();
			$submenu["credit_id"] = $row["ct_creditid"];
			$submenu["credit_name"] = $row["ct_labels"];
			
			array_push($response["credit_values"], $submenu);
			
		}
		
		$response["message"] = "ok";
    	$response["success"] = 0;
		echo json_encode($response);
	}
	else
	{
		$response["message"] = "no";
    	$response["success"] = 1;
    	echo json_encode($response);
	}
}

else if($check == 'voucher_detials')
{
	$sql = "SELECT * FROM `tbl_vouchermaster` WHERE `vr_active`='Yes'";
	
	$result = mysqli_query($localhost,$sql);
	if(mysqli_num_rows($result) >0)
	{
		$response["voucher_values"] = array();
		
		while($row = mysqli_fetch_array($result))
		{
			$submenu = array();
			$submenu["voucher_id"] = $row["vr_voucherid"];
			$submenu["voucher_name"] = $row["vr_vouchername"];
			
			array_push($response["voucher_values"], $submenu);
			
		}
		
		$response["message"] = "ok";
    	$response["success"] = 0;
		echo json_encode($response);
	}
	else
	{
		$response["message"] = "no";
    	$response["success"] = 1;
    	echo json_encode($response);
	}
}

else if($check == 'staff_compli')
{
	$sql = "select sm.ser_firstname,sm.ser_staffid  from  tbl_staffmaster as sm  where sm.ser_employeestatus='Active' AND ser_compl_mgmt='Y'";
	
	$result = mysqli_query($localhost,$sql);
	if(mysqli_num_rows($result) >0)
	{
		$response["staff_array"] = array();
		
		while($row = mysqli_fetch_array($result))
		{
			$submenu = array();
			$submenu["staff_id"] = $row["ser_staffid"];
			$submenu["staff_name"] = $row["ser_firstname"];
			
			array_push($response["staff_array"], $submenu);
			
		}
		
		$response["message"] = "ok";
    	$response["success"] = 0;
		echo json_encode($response);
	}
	else
	{
		$response["message"] = "no";
    	$response["success"] = 1;
    	echo json_encode($response);
	}
}

else if($check == 'details_auth')
{
	$sql = "select * from tbl_staffmaster WHERE ser_cancelpermission='Y' AND ser_employeestatus='Active'";
	
	$result = mysqli_query($localhost,$sql);
	if(mysqli_num_rows($result) >0)
	{
		$response["staff_details"] = array();
		
		while($row = mysqli_fetch_array($result))
		{
			$submenu = array();
			$submenu["staff_id"] = $row["ser_staffid"];
			$submenu["staff_name"] = $row["ser_firstname"];
			$submenu["permission"] = $row["ser_cancelwithkey"];
			
			array_push($response["staff_details"], $submenu);
			
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

else if($check == "check_Staff")
{
	$staffid = $_GET['staffid'];
	$password = md5($_GET['password']);
	
	$sql = "SELECT * FROM `tbl_logindetails` l left join tbl_staffmaster s on s.ser_staffid = l.ls_staffid where s.ser_cancelwithkey='N' and l.ls_staffid = '".$staffid."' and l.ls_password = '".$password."'";
	
	$result = mysqli_query($localhost,$sql);
	if(mysqli_num_rows($result) >0)
	{
		$response["message"] = "ok";
    	$response["success"] = 1;
		echo json_encode($response);
	}
	else
	{
		$response["message"] = "fail";
    	$response["success"] = 0;
		echo json_encode($response);
	}
	
}


else if($check == "check_permission")
{
	
	$sql = "SELECT be_auth_paymentchange FROM `tbl_branchmaster`";
	
	$result = mysqli_query($localhost,$sql);
	
	if(mysqli_num_rows($result)>0)
	{
		while($row = mysqli_fetch_array($result))
		{
			$s = $row["be_auth_paymentchange"];
		}
		$response["message"] = $s;
		$response["success"] = 1;
		echo json_encode($response);
	}
	else
	{
		$response["message"] = "N";
    	$response["success"] = 0;
		echo json_encode($response);
	}
	
}




else if($check == 'credit_details_second')
{
	$credittype = $_GET['credit_typ'];
	$branchid = $_GET['branchid'];
	
	if($credittype=="1")
	{
                 $sql_ds_nos="select cm.crd_id as id,rm.rm_roomno as names from tbl_credit_master as cm LEFT JOIN tbl_roommaster as rm ON cm.crd_roomid=rm.rm_roomid where cm.crd_type='".$credittype."' AND cm.crd_branchid='".$branchid."' AND cm.crd_active='Y'";
	}else if($credittype=="2")
	{
                 $sql_ds_nos="select cm.crd_id as id,sm.ser_firstname as names from tbl_credit_master as cm  LEFT JOIN tbl_staffmaster as sm ON cm.crd_staffid=sm.ser_staffid where cm.crd_type='".$credittype."' AND cm.crd_branchid='".$branchid."' AND cm.crd_active='Y' AND  sm.ser_employeestatus='Active'";
	}else if($credittype=="3")
	{
                 /*$sql_ds_nos="select cm.crd_id as id,cp.ct_corporatename as names from tbl_credit_master as cm  LEFT JOIN tbl_corporatemaster as cp ON cm.crd_corporateid=cp.ct_corporatecode where cm.crd_type='".$credittype."' AND cm.crd_branchid='".$branchid."' AND cm.crd_active='Y'";*/
$sql_ds_nos="select ct_corporatecode as id,ct_corporatename as names  from  tbl_corporatemaster where ct_status='Y'";


                
	}else if($credittype=="4")
	{
                 /*$sql_ds_nos="select cm.crd_id as id,lg.ly_firstname as names from tbl_credit_master as cm  LEFT JOIN tbl_loyalty_reg as lg ON cm.crd_guestid=lg.ly_id where cm.crd_type='".$credittype."' AND cm.crd_branchid='".$branchid."' AND cm.crd_active='Y'";*/

                 $sql_ds_nos="select ly_mobileno as id,ly_firstname AS names from tbl_loyalty_reg where ly_status='Active'";
	}
	
	$result = mysqli_query($localhost,$sql_ds_nos);
	if(mysqli_num_rows($result) >0)
	{
		$response["credit_array_details"] = array();
		
		while($row = mysqli_fetch_array($result))
		{
			$submenu = array();
			$submenu["name"] = $row["names"];
			$submenu["id"] = $row["id"];
			
			array_push($response["credit_array_details"], $submenu);
			
		}
		
		$response["message"] = "ok";
    	$response["success"] = 0;
		echo json_encode($response);
	}
	else
	{
		$response["message"] = "no";
    	$response["success"] = 1;
    	echo json_encode($response);
	}
}else if($check == 'credit_details_second')
{
	$credittype = $_GET['credit_typ'];
	$branchid = $_GET['branchid'];
	
	if($credittype=="1")
	{
                 $sql_ds_nos="select cm.crd_id as id,rm.rm_roomno as names from tbl_credit_master as cm LEFT JOIN tbl_roommaster as rm ON cm.crd_roomid=rm.rm_roomid where cm.crd_type='".$credittype."' AND cm.crd_branchid='".$branchid."' AND cm.crd_active='Y'";
	}else if($credittype=="2")
	{
                 $sql_ds_nos="select cm.crd_id as id,sm.ser_firstname as names from tbl_credit_master as cm  LEFT JOIN tbl_staffmaster as sm ON cm.crd_staffid=sm.ser_staffid where cm.crd_type='".$credittype."' AND cm.crd_branchid='".$branchid."' AND cm.crd_active='Y' AND  sm.ser_employeestatus='Active'";
	}else if($credittype=="3")
	{
                 /*$sql_ds_nos="select cm.crd_id as id,cp.ct_corporatename as names from tbl_credit_master as cm  LEFT JOIN tbl_corporatemaster as cp ON cm.crd_corporateid=cp.ct_corporatecode where cm.crd_type='".$credittype."' AND cm.crd_branchid='".$branchid."' AND cm.crd_active='Y'";*/
$sql_ds_nos="select ct_corporatecode as id,ct_corporatename as names  from  tbl_corporatemaster where ct_status='Y'";


                
	}else if($credittype=="4")
	{
                 /*$sql_ds_nos="select cm.crd_id as id,lg.ly_firstname as names from tbl_credit_master as cm  LEFT JOIN tbl_loyalty_reg as lg ON cm.crd_guestid=lg.ly_id where cm.crd_type='".$credittype."' AND cm.crd_branchid='".$branchid."' AND cm.crd_active='Y'";*/

                 $sql_ds_nos="select ly_mobileno as id,ly_firstname AS names from tbl_loyalty_reg where ly_status='Active'";
	}
	
	$result = mysqli_query($localhost,$sql_ds_nos);
	if(mysqli_num_rows($result) >0)
	{
		$response["credit_array_details"] = array();
		
		while($row = mysqli_fetch_array($result))
		{
			$submenu = array();
			$submenu["name"] = $row["names"];
			$submenu["id"] = $row["id"];
			
			array_push($response["credit_array_details"], $submenu);
			
		}
		
		$response["message"] = "ok";
    	$response["success"] = 0;
		echo json_encode($response);
	}
	else
	{
		$response["message"] = "no";
    	$response["success"] = 1;
    	echo json_encode($response);
	}
}

else if($check == 'credit_details_counter')
{
	$credittype = $_GET['credit_typ'];
	$branchid = $_GET['branchid'];
	
	if($credittype=="1")
	{
                 $sql_ds_nos="select cm.crd_id as id,rm.rm_roomno as names from tbl_credit_master as cm LEFT JOIN tbl_roommaster as rm ON cm.crd_roomid=rm.rm_roomid where cm.crd_type='".$credittype."' AND cm.crd_branchid='".$branchid."' AND cm.crd_active='Y'";
	}else if($credittype=="2")
	{
                 $sql_ds_nos="select cm.crd_id as id,sm.ser_firstname as names from tbl_credit_master as cm  LEFT JOIN tbl_staffmaster as sm ON cm.crd_staffid=sm.ser_staffid where cm.crd_type='".$credittype."' AND cm.crd_branchid='".$branchid."' AND cm.crd_active='Y' AND  sm.ser_employeestatus='Active'";
	}else if($credittype=="3")
	{
                 $sql_ds_nos="select cm.crd_id as id,cp.ct_corporatename as names from tbl_credit_master as cm  LEFT JOIN tbl_corporatemaster as cp ON cm.crd_corporateid=cp.ct_corporatecode where cm.crd_type='".$credittype."' AND cm.crd_branchid='".$branchid."' AND cm.crd_active='Y'";
/*$sql_ds_nos="select ct_corporatecode as id,ct_corporatename as names  from  tbl_corporatemaster where ct_status='Y'";*/


                
	}else if($credittype=="4")
	{
                 $sql_ds_nos="select cm.crd_id as id,lg.ly_firstname as names from tbl_credit_master as cm  LEFT JOIN tbl_loyalty_reg as lg ON cm.crd_guestid=lg.ly_id where cm.crd_type='".$credittype."' AND cm.crd_branchid='".$branchid."' AND cm.crd_active='Y' AND ly_status='Active'";

                /* $sql_ds_nos="select ly_mobileno as id,ly_firstname AS names from tbl_loyalty_reg where ly_status='Active'";*/
	}
	
	$result = mysqli_query($localhost,$sql_ds_nos);
	if(mysqli_num_rows($result) >0)
	{
		$response["credit_array_details"] = array();
		
		while($row = mysqli_fetch_array($result))
		{
			$submenu = array();
			$submenu["name"] = $row["names"];
			$submenu["id"] = $row["id"];
			
			array_push($response["credit_array_details"], $submenu);
			
		}
		
		$response["message"] = "ok";
    	$response["success"] = 0;
		echo json_encode($response);
	}
	else
	{
		$response["message"] = "no";
    	$response["success"] = 1;
    	echo json_encode($response);
	}
}

else if($check == 'bill_settel')
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
	$auth_secretkey = '';
	$auth_staffid = '';
	$auth_loginid = $_GET['login_id'];

	
	mysqli_query($localhost,"SET @billno = " . "'" . $bill_number_topass . "'");
	mysqli_query($localhost,"SET @branchid = " . "'" . $branchid_topass . "'");
	mysqli_query($localhost,"SET @paymodeid = " . "'" . $payment_mode_topass . "'");
	mysqli_query($localhost,"SET @amountpaid = " . "'" . $amountpaid_topass . "'");
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
	mysqli_query($localhost,"SET @auth_secretkey = " . "'" . $auth_secretkey . "'");
	mysqli_query($localhost,"SET @auth_staffid = " . "'" . $auth_staffid . "'");
	mysqli_query($localhost,"SET @auth_loginid = " . "'" . $auth_loginid . "'");


	
	$message = '';
	
	$s = '';

	$result1=mysqli_query($localhost,"CALL proc_billpayment(@billno,@branchid,@paymodeid,@amountpaid,@transactionamount,@card_bank,@complementary,@remark,@voucherid,@couponcompany,@couponamt,@chequeno,@chequebankname,@chequeamount,@credit,@creditmasterid,@creditamount,@balanceamt,@complementary_staff,@auth_secretkey,@auth_staffid,@auth_loginid,@message)");
	
	$rs = mysqli_query($localhost, 'SELECT @message AS message' );
		while($row = mysqli_fetch_array($rs))
		{
			$s= $row['message'];
		}
	if($result1)
	{
		 $response["success"] = 0;
		 $response["message"] = $s;
    	 echo json_encode($response);
		 
	}else
	{
		$response["success"] = 1;
		$response["message"] = "failed";
		
    	echo json_encode($response);
	}
	
}

else if($check == 'bill_settel_change')
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
	$auth_secretkey = $_GET['auth_secret_key'];;
	$auth_staffid = $_GET['auth_staff_id'];;
	$auth_loginid = $_GET['login_id'];
	$changereason = $_GET['reason'];


	if ($coupon_amount_topass=="") {
		$coupon_amount_topass=0;
	}
	if ($chequeamount_topass=="") {
		$chequeamount_topass=0;
	}
	if ($credit_amount_topass=="") {
		$credit_amount_topass=0;
	}if ($transaction_amount_topass=="") {
		$transaction_amount_topass=0;
	}if ($credit_amount_topass=="") {
		$credit_amount_topass=0;
	}if ($card_bank_topass=="") {
		$card_bank_topass=0;
	}


	
	mysqli_query($localhost,"SET @billno = " . "'" . $bill_number_topass . "'");
	mysqli_query($localhost,"SET @branchid = " . "'" . $branchid_topass . "'");
	mysqli_query($localhost,"SET @paymodeid = " . "'" . $payment_mode_topass . "'");
	mysqli_query($localhost,"SET @amountpaid = " . "'" . $amountpaid_topass . "'");
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
	mysqli_query($localhost,"SET @auth_secretkey = " . "'" . $auth_secretkey . "'");
	mysqli_query($localhost,"SET @auth_staffid = " . "'" . $auth_staffid . "'");
	mysqli_query($localhost,"SET @auth_loginid = " . "'" . $auth_loginid . "'");
	mysqli_query($localhost,"SET @changereason = " . "'" . $changereason . "'");
	

	/*echo "billno:".$bill_number_topass.":branchid:".$branchid_topass.":paymodeid:".$payment_mode_topass.":amountpaid:".$amountpaid_topass.":transaction_amount_topass:".$transaction_amount_topass.":card_bank:".$card_bank_topass.":complementary:".$complimentary_topass.":remark:".$remarks_topass.":voucherid:".$voucherid_topass.":couponcompany:".$couponcompany_topass.":coupon_amount_topass:".$coupon_amount_topass.":cheque_no_topass:".$cheque_no_topass.":cheque_bankname_topass:".$cheque_bankname_topass.":chequeamount_topass:".$chequeamount_topass.":credittypes_topass:".$credittypes_topass.":credit_master_topass:".$credit_master_topass.":credit_amount_topass:".$credit_amount_topass.":balance_amount_topass:".$balance_amount_topass.
	":complimentary_staffid_topass:".$complimentary_staffid_topass.":auth_secretkey:".$auth_secretkey.":auth_staffid:".$auth_staffid.":auth_loginid:".$auth_loginid.":changereason:".$changereason;
	*/
	$message = '';
	
	$s = '';

	$result1=mysqli_query($localhost,"CALL proc_billpayment_change(@billno,@branchid,@paymodeid,@amountpaid,@transactionamount,@card_bank,@complementary,@remark,@voucherid,@couponcompany,@couponamt,@chequeno,@chequebankname,@chequeamount,@credit,@creditmasterid,@creditamount,@balanceamt,@complementary_staff,@auth_secretkey,@auth_staffid,@auth_loginid,@changereason,@message)");
	
	$rs = mysqli_query($localhost, 'SELECT @message AS message' );
		while($row = mysqli_fetch_array($rs))
		{
			$s= $row['message'];
		}
	if($result1)
	{
		 $response["success"] = 0;
		 $response["message"] = $s;
    	 echo json_encode($response);
		 
	}else
	{
		$response["success"] = 1;
		$response["message"] = "failed";
		
    	echo json_encode($response);
	}
	
}





else if($check == 'billed_details')
{
	$floor = $_GET['floorid'];
	$brnch = $_GET['branchid'];
	/*SELECT GROUP_CONCAT((CONCAT(trim(t.tr_tableno),trim(td.ts_tableidprefix))) SEPARATOR ',') as list,td.ts_dineintime,td.ts_noofpersons,td.ts_orderno,td.ts_tableid as tableid, ser_firstname as staff_name FROM tbl_tabledetails td LEFT JOIN tbl_tablemastert on t.tr_tableid = td.ts_tableid LEFT JOIN tbl_staffmaster S ON S.ser_staffid = td.ts_orderstaff where t.tr_branchid = '1' and t.tr_floorid = 'EX-FL1'GROUP BY ts_orderno ORDER BY td.ts_dineintime DESC*/
	$temp = "SELECT GROUP_CONCAT((CONCAT(trim(t.tr_tableno),concat('(',(trim(td.ts_tableidprefix)),')'))) SEPARATOR ',') as list ,GROUP_CONCAT((CONCAT(trim(td.ts_tableid))) SEPARATOR ',') as tableid,GROUP_CONCAT((CONCAT(trim(td.ts_tableidprefix))) SEPARATOR ',') as table_prefix, td.ts_dineintime,sum(td.ts_noofpersons) as ts_noofpersons , s.ser_firstname as staff_name,s.ser_staffid as staffid,td.ts_status,td.ts_orderno,td.ts_billnumber FROM tbl_tabledetails td LEFT JOIN tbl_tablemaster t on t.tr_tableid = td.ts_tableid LEFT JOIN tbl_staffmaster s ON s.ser_staffid = td.ts_orderstaff where t.tr_branchid = '".$brnch."' and t.tr_floorid = '".$floor."' and td.ts_status = 'Billed' GROUP BY ts_orderno ORDER BY td.ts_dineintime DESC";
	
	
	//`tbl_tabledetails`(`ts_tableid`, `ts_tableidprefix`, `ts_status`, `ts_dineintime`, `ts_noofpersons`, `ts_orderno`)
	$result = mysqli_query($localhost,$temp);
	if (mysqli_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["bill_listdetails"] = array();
	
    while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $submenu = array();
        $submenu["bill_id"] = $row["list"];
        $submenu["bill_time"] = $row["ts_dineintime"];
		$submenu["bill_num"] = $row["ts_noofpersons"];
        $submenu["bill_order"] = $row["ts_orderno"];
		$submenu["bill_tableid"] = $row["tableid"];
		$submenu["bill_staffname"] = $row["staff_name"];
		$submenu["bill_staffid"] = $row["staffid"];
		$submenu["bill_tableprefix"] = $row["table_prefix"];
		$submenu["bill_status"] = $row["ts_status"];
		$s = $row["ts_billnumber"];
		if($s=="NULL")
		{
			$submenu["bill_bill_numbber"] = "";
		}
		else
		{
			$submenu["bill_bill_numbber"] = $s;
		}
		
		
       // push single product into final response array
        array_push($response["bill_listdetails"], $submenu);
    }
  // success
   $response["message"] = "ok";
    $response["success"] = 1;
	
    // echoing JSON response
    echo json_encode($response);
} else {
    // no products found
    $response["success"] = 2;
    $response["message"] = "fail";
   // echo no users JSON
    echo json_encode($response);
}

}



else if($check == 'sendotp')
{
	$result="";
	$response1=array();
	$staff=$_GET['staffid'];//echo "SELECT * from tbl_staffmaster  WHERE  ser_staffid ='".$staff."' AND  ser_employeestatus='Active'";
	$sql_table_sel3  = mysqli_query($localhost,"SELECT * from tbl_staffmaster  WHERE  ser_staffid ='".$staff."' AND  ser_employeestatus='Active'"); $rrt='';
   $num_table3  = mysqli_num_rows($sql_table_sel3);
  if($num_table3)
  {
	  while($row = mysqli_fetch_array($sql_table_sel3))
		{
		$rrt= trim($row['ser_cancelwithkey']);
		}
  }
 /* if($rrt=="Y")
  {  
		$result= "yes";
  }else
  {
	  	$result= "no";
  }*/$srt='';
	
		
		if($rrt== "Y")
		{
			mysqli_query($localhost,"SET @staffid = " . "'" . $staff . "'");
			$secretkey='';
			$sq=mysqli_query($localhost,"CALL proc_gensecretkey(@staffid,@secretkey)");
			$rs = mysqli_query($localhost, 'SELECT @secretkey AS secretkey' );
			while($row = mysqli_fetch_array($rs))
			{
			 $srt= $row['secretkey'];
	
			}
			
		//sms sending starts
		$mobileno='';
		$sql_stff  =  mysqli_query($localhost,"SELECT * FROM tbl_staffmaster WHERE ser_staffid='".$staff."' AND  ser_employeestatus='Active'"); 
		while($result_stff  = mysqli_fetch_array($sql_stff)) 
		{
			$mobileno=$result_stff['ser_mobileno'];
		}
		
		
		$phonelist= $mobileno;
		$smstext="OTP for Bill Alteration request is  ".$srt.". Please enter this to verify the identity.";
		$be_sms_username		="";
		$be_sms_apipassword	="";
		$be_sms_senderid		="";
		  $sql_general =  mysqli_query($localhost,"Select * from tbl_generalsettings "); 
		  $num_general  = mysqli_num_rows($sql_general);
		  if($num_general)
		  {
			  
				while($result_general  = mysqli_fetch_array($sql_general)) 
					{
						
						 $be_sms_username			=$result_general['be_sms_username'];
						 $be_sms_apipassword		=$result_general['be_sms_apipassword'];
						 $be_sms_senderid			=$result_general['be_sms_senderid'];
					         $be_sms_domainid			=$result_general['be_sms_domainid'];
                                                 $be_sms_priority			=$result_general['be_sms_priority'];
                                                 $be_sms_method			        =$result_general['be_sms_method'];
                                                 
                                        }
		  }
		
		
		$username=$be_sms_username;
		$api_password=$be_sms_apipassword;
		$sender=$be_sms_senderid;
		$domain=$be_sms_domainid;
                $priority=$be_sms_priority;
                $smstype = $be_sms_method;

		$username=urlencode($username);
		$sender=urlencode($sender);
		$message=urlencode($smstext);
		$domain=urlencode($domain);
                $route=urlencode($priority);
                
		
                
                 $parameters="username=$username&api_password=$api_password&sender=$sender&to=$phonelist&priority=$route&message=$message";
                
		if($method=="POST")
		{
			$opts = array(
			  'http'=>array(
				'method'=>"$method",
				'content' => "$parameters",
				'header'=>"Accept-language: en\r\n" .
						  "Cookie: foo=bar\r\n"
			  )
			);
	
			$context = stream_context_create($opts);
			
			
	
		
		}
		else
		{
			
                        $fp = fopen("http://$domain/pushsms.php?$parameters", "r");
		}
	
		$response = stream_get_contents($fp);
		fpassthru($fp);
		fclose($fp);
	
		
	
		
		//sms sending ends
		}else
		{
			//$sqq=substr(floor( 1000 + ( rand( ) *8999 )),0,4);
			//$sql_i=mysqli_query($localhost,"INSERT INTO `tbl_secretkeymaster`( `sr_staffid`, `sr_password`,sr_key, `sr_generatedtime`, `sr_defaultkey`) VALUES ('".$_REQUEST['stafflist']."','".md5($_REQUEST['secretkey'])."','".$sqq."','".date("Y-m-d H:i:s")."','N')");
		}
		
		
		//echo $srt;
		 $response1["key"] = $srt;
		 $response1["message"] = "ok";
   		 $response1["success"] = 1;
	
	//print_r($response);
	//echo $response["keys"];
    // echoing JSON response
    		echo json_encode($response1);
		
		//echo $rrt."dd".$srt;
		
}


else if($check == "kot_verify")
{
	$ordernum = $_GET['ordernumber'];	
	$sl_number = $_GET['sl_number'];	
	$quantity_changed = $_GET['quantity_changed'];	
	$staffId_selected = $_GET['staffId_selected'];	
	$kot_number = $_GET['kot_number'];	
	$reason = $_GET['reason'];	
	$secretKeyGenerated = $_GET['secretKeyGenerated'];
	$username = $_GET['username'];	
	$branchid = $_GET['branchid'];
	$new_qty = $_GET['new_qty'];
	$s = $_GET['cancel_id'];
	$combo=$_GET['combo'];
	$count_combo_ordering=$_GET['count_combo_ordering'];
	
		$jsonInput=$_GET['jsonInput'];
		
		
		$obj = json_decode($jsonInput);





//foreach($jsonInput as $key => $value)
//{
//echo $value->cancel_id;
//}

	
		
	if($reason=="!")
	{
		$reason = "";
	}
	
	try
	{
for($c=0;$c<count($obj);$c++){
			if ($obj[$c]->combo=="N") 

			{

							if($obj[$c]->staffId_selected=="")
							{
							$sql = "INSERT INTO `tbl_tableorder_changes`(ch_kot_cancel_id,`ch_orderno`, `ch_orderslno`, `ch_cancelled_qty`, `ch_kotno`, `ch_cancelledlogin`) VALUES ('".$obj[$c]->cancel_id."','".$obj[$c]->ordernumber."','".$obj[$c]->sl_number."','".$obj[$c]->quantity_changed."','".$obj[$c]->kot_number."','".$obj[$c]->username."')";

							}
							else
							{
							$sql = "INSERT INTO `tbl_tableorder_changes`(ch_kot_cancel_id,`ch_orderno`, `ch_orderslno`, `ch_cancelled_qty`, `ch_cancelledby_careof`, `ch_kotno`, `ch_cancelledreason`, `ch_cancelledsecret`, `ch_cancelledlogin`) VALUES ('".$obj[$c]->cancel_id."','".$obj[$c]->ordernumber."','".$obj[$c]->sl_number."','".$obj[$c]->quantity_changed."','".$obj[$c]->staffId_selected."','".$obj[$c]->kot_number."','".$obj[$c]->reason."','".$obj[$c]->secretKeyGenerated."','".$obj[$c]->username."')";
							//$sql_update = "update tbl_tableorder set ter_qty='".$new_qty."',ter_total_rate='".$new_qty."'*ter_rate where ter_orderno='".$ordernum."' and ter_slno='".$sl_number."'";

							}
							
	
	
									$sql_update = "update tbl_tableorder set ter_qty='".$obj[$c]->new_qty."',ter_total_rate='".$obj[$c]->new_qty."'*ter_rate where ter_orderno='".$obj[$c]->ordernumber."' and ter_slno='".$obj[$c]->sl_number."'";

//echo $sql;
//echo $sql_update;

								//$sql_update = "update tbl_tableorder set ter_qty='".$new_qty."',ter_total_rate='".$new_qty."'*ter_rate where ter_orderno='".$ordernum."' and ter_slno='".$sl_number."'";

 //$response["qry"] = $sql_update;
					    	   //echo json_encode($testre);

							$result7 = mysqli_query($localhost,$sql);
							$result8 = mysqli_query($localhost,$sql_update);
							
			}
			else
			{
					

					if ($obj[$c]->new_qty==0) {
						

						$sql_update = "update tbl_tableorder set ter_qty='".$obj[$c]->new_qty."',ter_cancel='Y' where ter_orderno='".$obj[$c]->ordernumber."' and ter_count_combo_ordering='".$obj[$c]->count_combo_ordering."'";

							$sql_combo_update = "update tbl_combo_ordering_details set cod_combo_qty='".$obj[$c]->new_qty."',cod_cancel='Y' where cod_orderno='".$obj[$c]->ordernumber."' and cod_count_combo_ordering='".$obj[$c]->count_combo_ordering."'";

					}else{
						
					
						$sql_update = "update tbl_tableorder set ter_qty='".$obj[$c]->new_qty."' where ter_orderno='".$obj[$c]->ordernumber."' and ter_count_combo_ordering='".$obj[$c]->count_combo_ordering."'";

							$sql_combo_update = "update tbl_combo_ordering_details set cod_combo_qty='".$obj[$c]->new_qty."' where cod_orderno='".$obj[$c]->ordernumber."' and cod_count_combo_ordering='".$obj[$c]->count_combo_ordering."'";
					}



				
					
					$result2 = mysqli_query($localhost,$sql_update);
					$result3 = mysqli_query($localhost,$sql_combo_update);



					$sql_get_combos="select ter_slno from tbl_tableorder where ter_count_combo_ordering='".$obj[$c]->count_combo_ordering."'";

					$result4 = mysqli_query($localhost,$sql_get_combos);
					$num_rows  = mysqli_num_rows($result4);

					if($num_rows)
					{
						while($row  = mysqli_fetch_array($result4)) 
						{
							$ter_slno=$row['ter_slno'];

								if($obj[$c]->staffId_selected=="")
								{

									 $sql = "INSERT INTO `tbl_tableorder_changes`(ch_kot_cancel_id,`ch_orderno`, `ch_orderslno`, `ch_cancelled_qty`, `ch_kotno`, `ch_cancelledlogin`, `ch_combo_pack_cancelled_qty`) VALUES  ('".$obj[$c]->cancel_id."','".$obj[$c]->ordernumber."','".$obj[$c]->sl_number."','".$obj[$c]->quantity_changed."','".$obj[$c]->kot_number."','".$obj[$c]->username."','".$obj[$c]->quantity_changed."')";

					              }else
					              {

										$sql = "INSERT INTO `tbl_tableorder_changes`(ch_kot_cancel_id,`ch_orderno`, `ch_orderslno`, `ch_cancelled_qty`, `ch_cancelledby_careof`, `ch_kotno`, `ch_cancelledreason`, `ch_cancelledsecret`, `ch_cancelledlogin`, `ch_combo_pack_cancelled_qty`) VALUES ('".$s."','".$ordernum."','".$ter_slno."','".$quantity_changed."','".$staffId_selected."','".$kot_number."','".$reason."','".$secretKeyGenerated."','".$username."','".$quantity_changed."')";
									}

									$result = mysqli_query($localhost,$sql);
	

						   }

					 }







				
				


			}




		
		
		
		
		if($obj[$c]->staffId_selected!="")
		  {
			  $dateexp=date("Y-m-d H:i:s");
			  $sql_table_sel3  = mysqli_query($localhost,"SELECT * from tbl_staffmaster  WHERE  ser_staffid ='".$staffId_selected."' AND  ser_employeestatus='Active'");
			  $rrt='';
			  $num_table3  = mysqli_num_rows($sql_table_sel3);
			  if($num_table3)
			  {
				  while($row = mysqli_fetch_array($sql_table_sel3))
					{
						$rrt= $row['ser_cancelwithkey'];
					}
			  }
			if($rrt=="Y")
				{  
					$result= "yes";
					$upd = "UPDATE tbl_secretkeymaster SET `sr_expiredtime`='".$dateexp."' WHERE (sr_key='".$secretKeyGenerated."' )  AND (`sr_expiredtime`='0000-00-00 00:00:00' OR sr_expiredtime IS NULL)";
					
					$sql=mysqli_query($localhost,$upd);
			  }else
			  {
					$result= "no";
					$sql=mysqli_query($localhost,"UPDATE tbl_secretkeymaster SET `sr_expiredtime`='".$dateexp."' WHERE (sr_password='".md5($secretKeyGenerated)."')  AND (`sr_expiredtime`='0000-00-00 00:00:00' OR sr_expiredtime IS NULL)");
			  }		
		  }
}
		   $response["success"] = 0;
		   $response["message"] = "ok";
		   $response["cancel_id"] = $s;
    	   echo json_encode($response);
		
	}catch (Exception $e) 
	{
		$returnmsg= 'Caught exception: '.  $e;
		$file = 'log.txt';
		$content = date("l F d-m-Y h:i:s A")." ".$returnmsg.PHP_EOL;
		file_put_contents($file, $content, FILE_APPEND | LOCK_EX);
		 //echo   $returnmsg;exit();
		$response["success"] = 1;
		 $response["message"] = "failed";
    	echo json_encode($response);
	}

	
}

else if($check == "gencancelid")
{
	$ordernum = $_GET['ordernumber'];	
	$branchid = $_GET['branchid'];
	$mode = "DI";
	
	try
	{
		mysqli_query($localhost,"SET @branchid = " . "'" . $branchid . "'");
		mysqli_query($localhost,"SET @temp_id = " . "'" . $ordernum . "'");
		mysqli_query($localhost,"SET @mode = " . "'" . $mode . "'");
		$sq=mysqli_query($localhost,"CALL proc_kot_cancel(@branchid,@temp_id,@mode,@cancel_id)");
		$rs = mysqli_query($localhost,'SELECT @cancel_id AS cancel_id' );
		while($row = mysqli_fetch_array($rs))
		{
			$s= $row['cancel_id'];
		}
		   $response["success"] = 0;
		   $response["message"] = "ok";
		   $response["cancel_id"] = $s;
    	   echo json_encode($response);
		
	}catch (Exception $e) 
	{
		$returnmsg= 'Caught exception: '.  $e;
		$file = 'log.txt';
		$content = date("l F d-m-Y h:i:s A")." ".$returnmsg.PHP_EOL;
		file_put_contents($file, $content, FILE_APPEND | LOCK_EX);
		 //echo   $returnmsg;exit();
		$response["success"] = 1;
		 $response["message"] = "failed";
    	echo json_encode($response);
	}
	
}


else if($check == "print_cancel_kot")
{
	$cancel_id = $_GET['cancel_id'];	
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
		require_once("printer_functions.php");
		$printpage=new PrinterCommonSettings();
		$printpage->print_kot_cancel($cancel_id,$cur,"android","1");
               	$printpage->print_kot_cancel_consolidated($cancel_id,$cur,"android","1");
		$response["message"] = "Item reduced Successfully";
		$response["success"] = 1;
		echo json_encode($response);
	}
	else
	{
		$response["message"] = "Failed to print the kot";
		$response["success"] = 0;
		echo json_encode($response);
	}
}



else if($check == "xml_link")
{
	$branchid = $_GET['branchid'];	
	$sql = "SELECT 	bsx_xml_location FROM tbl_branchsettings_xml where bsx_branchid='".$branchid."'";
	
	$result = mysqli_query($localhost,$sql);
	
	if(mysqli_num_rows($result)>0)
	{
		while($row = mysqli_fetch_array($result))
		{
			$s = $row["bsx_xml_location"];
		}
		$response["message"] = $s;
		$response["success"] = 1;
		echo json_encode($response);
	}
	else
	{
		$response["message"] = "N";
    	$response["success"] = 0;
		echo json_encode($response);
	}
	
}


else if($check == 'table_order_details_payment')
{
	$branchid = $_GET['branchid'];
	$dayclodedate = $_GET['dayclodedate'];
	$floorid = $_GET['floorid'];
	$mode = $_GET['mode'];
	
	$sql= "";
	
	if($mode=='D')
	{
		$sql = "SELECT b.bm_billno as ts_billnumber,b.bm_finaltotal, b.bm_tableno,b.bm_billtime as ts_dineintime,f.fr_floorname,b.bm_can_regenerate,f.fr_floorid 
FROM tbl_tablebillmaster b left join tbl_floormaster f
on b.bm_floorid = f.fr_floorid WHERE ((b.bm_status='Billed') ) 
AND  b.bm_dayclosedate ='".$dayclodedate."' 
AND b.bm_billno not like 'Temp%'";

		if($floorid == "")
		{
			$sql = $sql." group by b.bm_billno order by b.bm_billtime";
		}
		else
		{
			$sql = $sql." AND f.fr_floorid ='".$floorid."' group by b.bm_billno order by b.bm_billtime";
		}
	}
	else
	{		
		$sql = "Select distinct(tb.tab_billno) as ts_billnumber,tb.tab_time as ts_dineintime,tb.tab_subtotal_final as bm_finaltotal from tbl_takeaway_billmaster as tb LEFT JOIN tbl_takeaway_customer ts ON ts.tac_customerid=tb.tab_hdcustomerid where tb.tab_dayclosedate ='".$dayclodedate."' and (tb.tab_payment_settled = 'N') and (tb.tab_mode='".$mode."')   order by tb.tab_time DESC ";
	}
	
	
	$result = mysqli_query($localhost,$sql);
	
	if (mysqli_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["table_orders"] = array();
	
    while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $submenu = array();
		
		if($row["bm_tableno"]==null)
		{
			$submenu["tr_tableno"] = "";	
		}else {
			$submenu["tr_tableno"] = $row["bm_tableno"];
		}
		
		if($row["bm_finaltotal"]==null)
		{
			$submenu["bm_finaltotal"] = "";	
		}else {
			$submenu["bm_finaltotal"] = $row["bm_finaltotal"];
		}
		
		if($row["ts_dineintime"]==null)
		{
			$submenu["ts_dineintime"] = "";	
		}else {
			$submenu["ts_dineintime"] = date("g:i:s a", strtotime($row["ts_dineintime"]));
		}
		
		$submenu["ts_orderno"] = "";
		
		if($row["fr_floorname"]==null)
		{
			$submenu["fr_floorname"] = "";	
		}else {
			$submenu["fr_floorname"] = $row["fr_floorname"];
		}
		
		if($row["bm_tableno"]==null)
		{
			$submenu["ts_tableid"] = "";	
		}else {
			$submenu["ts_tableid"] = $row["bm_tableno"];
		}
		
		if($row["ts_billnumber"]==null)
		{
			$submenu["ts_billnumber"] = "";	
		}else {
			$submenu["ts_billnumber"] = $row["ts_billnumber"];
		}
		
		if($row["bm_can_regenerate"]==null)
		{
			$submenu["bm_can_regenerate"] = "";	
		}else {
			$submenu["bm_can_regenerate"] = $row["bm_can_regenerate"];
		}
		
        array_push($response["table_orders"], $submenu);
    }
  // success
   $response["message"] = "ok";
    $response["success"] = 1;

    // echoing JSON response
    echo json_encode($response);
} else {
    // no products found
    $response["success"] = 0;
    $response["message"] = "no";

    // echo no users JSON
    echo json_encode($response);
}
}



else if($check == 'bill_settel_all')
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
	$auth_secretkey = '';
	$auth_staffid = '';
	$credit_remark_cs = '';
	$auth_loginid = $_GET['login_id'];
	$username = $_GET['login_username'];
	$payment_login = $_GET['payment_login'];
	$mode = $_GET['mode'];
	$upiamount=0;
	$upitxnid='';

	$credittype = $_GET['credittype'];
	$mobileno = "";


if ($credittype==3||$credittype==4) {


	
		
		

		mysqli_query($localhost,"SET @name = " . "'" . $credit_master_topass . "'");
		mysqli_query($localhost,"SET @mobileno = " . "'" . $mobileno . "'");
		mysqli_query($localhost,"SET @branchid = " . "'" . $branchid_topass . "'");
		mysqli_query($localhost,"SET @credit_type = " . "'" . $credittype . "'");


		$result=mysqli_query($localhost,"CALL proc_credit_entry(@name,@mobileno,@branchid,@credit_type,@credit_id)");


		$r = mysqli_query($localhost, 'SELECT @credit_id AS credit_id' );

		while($row = mysqli_fetch_array($r))
		{

			$a= $row['credit_id'];
			
				

		}


	}

	/*if ($credittype==4) {
		
		mysqli_query($localhost,"SET @name = " . "'" . $credit_master_topass . "'");
		mysqli_query($localhost,"SET @mobileno = " . "'" . $mobileno . "'");
		mysqli_query($localhost,"SET @branchid = " . "'" . $branchid_topass . "'");
		mysqli_query($localhost,"SET @credit_type = " . "'" . $credittype . "'");

		$result=mysqli_query($localhost,"CALL proc_credit_entry(@name,@mobileno,@branchid,@credit_type,@credit_id)");

		$r = mysqli_query($localhost, 'SELECT @credit_id AS credit_id' );
		while($row = mysqli_fetch_array($r))
		{
			$credit_master_topass= $row['credit_id'];
			//echo $credit_master_topass;

		}
	}*/
	
	
	
	if($amountpaid_topass=='')
	{
		$amountpaid_topass = 0;
	}
	if($transaction_amount_topass=='')
	{
		$transaction_amount_topass = 0;
	}
	if($card_bank_topass=='')
	{
		$card_bank_topass = 0;
	}
	if($coupon_amount_topass=='')
	{
		$coupon_amount_topass = 0;
	}
	if($chequeamount_topass=='')
	{
		$chequeamount_topass = 0;
	}
	
	if($credit_amount_topass=='')
	{
		$credit_amount_topass = 0;
	}

	if($balance_amount_topass=='')
	{
		$balance_amount_topass = 0;
	}
	
/*	echo $bill_number_topass.",".$branchid_topass.",".$payment_mode_topass.",".$amountpaid_topass.",".$upiamount.",".$upitxnid
	.",".$transaction_amount_topass.",".$card_bank_topass.",".$complimentary_topass.",".$remarks_topass.",".$voucherid_topass.",".$couponcompany_topass.",".
	$coupon_amount_topass.",".$cheque_no_topass.",".$cheque_bankname_topass.",".
	$chequeamount_topass.",".$credittypes_topass.",".$credit_master_topass.",".
	$credit_amount_topass.",".$balance_amount_topass.",".$balance_amount_topass.
	",".$complimentary_staffid_topass.",".$auth_secretkey.",".$auth_staffid.",".
	$auth_loginid.",".$mode.",".$username.",".$credit_remark_cs.",".$credit_remark_cs;*/


	 










	
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
	mysqli_query($localhost,"SET @auth_secretkey = " . "'" . $auth_secretkey . "'");
	mysqli_query($localhost,"SET @auth_staffid = " . "'" . $auth_staffid . "'");
	mysqli_query($localhost,"SET @auth_loginid = " . "'" . $auth_loginid . "'");
	mysqli_query($localhost,"SET @mode = " . "'" . $mode . "'");
	mysqli_query($localhost,"SET @payment_login = " . "'" . $payment_login . "'");
	mysqli_query($localhost,"SET @credit_remark_cs = " . "'" . $credit_remark_cs . "'");

	mysqli_query($localhost,"SET @order_confirming_staff = " . "'" . $username . "'");

	
	
	
	$message = '';
	$s = "Failed to execute the procedure";
	
	if($mode=="D")
	{
		$result1=mysqli_query($localhost,"CALL proc_billpayment(@billno,@branchid,@paymodeid,@amountpaid,@upiamount,@upitxnid,@transactionamount,
		@card_bank,@complementary,@remark,@voucherid,@couponcompany,@couponamt,@chequeno,@chequebankname,@chequeamount,@credit,@creditmasterid,
		@creditamount,@balanceamt,@complementary_staff,@auth_secretkey,@auth_staffid,@auth_loginid,@payment_login,@credit_remark_cs,@message)");
	
		$rs = mysqli_query($localhost, 'SELECT @message AS message' );
			while($row = mysqli_fetch_array($rs))
			{
				$s= $row['message'];
			}
		if($result1)
		{

			if ($s=="Please open the shift for the current login") {
				$response["success"] = 2;
			 $response["message"] = $s;
			 echo json_encode($response);
			}else{
				$response["success"] = 0;
			 $response["message"] = $s;
			 echo json_encode($response);
			}
			 
			 
		}else
		{
			$response["success"] = 1;
			$response["message"] = $s;
			echo json_encode($response);
		}
	}
	else if($mode=="CS"||$mode=="TA")
	{

		try
		  {	  
		  	
		  				  		/*echo "bill_number_topass ".$bill_number_topass.",branchid_topass ".$branchid_topass.",payment_mode_topass ".$payment_mode_topass.",amountpaid_topass ".$amountpaid_topass.",upiamount ".$upiamount.",upitxnid ".$upitxnid
	.",transaction_amount_topass".$transaction_amount_topass.",card_bank_topass".$card_bank_topass.",complimentary_topass".$complimentary_topass.",remarks_topass".$remarks_topass.",voucherid_topass".$voucherid_topass.",couponcompany_topass".$couponcompany_topass.",coupon_amount_topass".
	$coupon_amount_topass.",cheque_no_topass".$cheque_no_topass.",cheque_bankname_topass".$cheque_bankname_topass.",chequeamount_topass".
	$chequeamount_topass.",credittypes_topass".$credittypes_topass.",credit_master_topass".$credit_master_topass.",credit_amount_topass".
	$credit_amount_topass.",balance_amount_topass".$balance_amount_topass.
	",complimentary_staffid_topass".$complimentary_staffid_topass.",auth_secretkey".$auth_secretkey.",auth_staffid".$auth_staffid.",auth_loginid".
	$auth_loginid.",mode".$mode.",username".$username.",credit_remark_cs".$credit_remark_cs;*/

	//echo "b".$balance_amount_topass;

			  $result1=mysqli_query($localhost,"CALL proc_gencounter_billsettle_kot(@billno,@branchid,@paymodeid,@amountpaid,@upiamount,@upitxnid,@transactionamount,@card_bank,
			  @complementary,@remark,@voucherid,@couponcompany,@couponamt,@chequeno,@chequebankname,@chequeamount,@credit,@creditmasterid,@creditamount,
			  @balanceamt,@complementary_staff,@mode,@payment_login,@credit_remark_cs,@kotno,@order_confirming_staff,@message)") or throw_ex(mysqli_error($localhost)) ;
			  
			 
			$rs = mysqli_query($localhost, 'SELECT @message AS message,@kotno AS kot_num' );
			$proc_message = "Failed to execute the procedure";
			while($row = mysqli_fetch_array($rs))
			{
				$proc_message = $row['message'];
				$kot_number = $row['kot_num'];
				
			}
	


			if($proc_message == "KOT GENERATED & PAYMENT SUCCESSFUL")
			{

				$check_printAll = "select be_printall from tbl_branchmaster";
				$resultPA = mysqli_query($localhost,$check_printAll);
				if(mysqli_num_rows($resultPA)>0){
					$printAll = "";
					while($rowp = mysqli_fetch_array($resultPA))
					{
						$printAll = $rowp["be_printall"];
					}

					
				}
			   $response["success"] = 0;
			   $response["message"] = $proc_message;
			   $response["printall"] = $printAll;
			   $response["bill_number_generated"] = $bill_number_topass;
			   $response["KOT"] = $kot_number;
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
			 //echo   $returnmsg;exit();
			 $proc_message = "Failed to execute the procedure";
			 $response["success"] = 2;
			 $response["message"] = $proc_message;
			 echo json_encode($response);
		}
	}	
}

else if ($check == 'bill_before_settle') {


	$check_condition_print_bill = "select bsc_bill_before_settle from tbl_branch_settings_counter";
				$result1 = mysqli_query($localhost,$check_condition_print_bill);
				if(mysqli_num_rows($result1)>0){


					$msg = "";
					while($row = mysqli_fetch_array($result1))
					{
						$msg = $row["bsc_bill_before_settle"];
					}


 				$response["success"] = 0;
			   $response["message"] = $msg;
			   echo json_encode($response);

				}
	
}
else if ($check == 'tab_mode_of_entry') {

$bill_number_topass = $_GET['bill_number_topass'];

	$check = "select * FROM tbl_takeaway_billmaster  Where tab_billno = '".$bill_number_topass."' AND (tab_mode_of_entry = 'G')";
					
					$result2 = mysqli_query($localhost,$check);
					if(mysqli_num_rows($result2)==0){


				 			$response["success"] = 0;
						    $response["message"] = "true";
						    echo json_encode($response);

				}
				else{
							$response["success"] = 1;
						    $response["message"] = "false";
						    echo json_encode($response);	
				}
	
}
else if ($check == 'check_kotprint_countersale') {

$kot_or = "select bsc_kotprint from tbl_branch_settings_counter";
						$result3 = mysqli_query($localhost,$kot_or);
				  
						if(mysqli_num_rows($result3)>0)
						{
							while($row = mysqli_fetch_array($result3))
							{
								$repl = $row["bsc_kotprint"];
							}

							$response["success"] = 0;
						    $response["message"] = $repl;
						    echo json_encode($response);

						}
	
}

else if ($check == 'check_consolidated_countersale') {

$check_consoldtd="select be_consolidated_print from tbl_branchmaster";
$resultc = mysqli_query($localhost,$check_consoldtd);

				if(mysqli_num_rows($resultc)>0)
				{

					while($rowc = mysqli_fetch_array($resultc))
					{
						$msgc = $rowc["be_consolidated_print"];
					}

					$response["success"] = 0;
				    $response["message"] = $msgc;
				    echo json_encode($response);
				}
				  
						
	
}


else if($check == "print_consolidated_counter")
{
	$kot_id = $_GET['kotnumber'];
	$branchid = $_GET['branchid'];
	$ordenum = $_GET['ordernum'];
	
	$rn=chr(13).chr(10); 
	$esc=chr(27); 
	$cutpaper=$esc."m";
	$bold_on=$esc."E1";
	$bold_off=$esc."E0";
	$reset=pack('n', 0x1B30);
	$right=$esc."a2";
	$left=$esc."a0";
	$center=$esc."a1";
	$underlineon=$esc."-1";
	$underlineofn=$esc."-0";
	date_default_timezone_set("Asia/Kolkata");
	$string="";
	$status="";
	$slnoinkot='';
	$rateinkot='';
	$staffinkot='';
	$itemcoutinkot='';
	
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
			  
			  $kotprint_tp='';
			  $kotprint_tp1='';
			  $sql_table_pt="select * from tbl_printertype ";
			  $sql_pt  =  mysqli_query($localhost,$sql_table_pt); 
			  $num_pt  = mysqli_num_rows($sql_pt);
			  if($num_pt){
				  while($result_pt  = mysqli_fetch_array($sql_pt)) 
					  {
						  if($result_pt['pt_typename']=="Consolidated TA CS")
						  {
							  $kotprint_tp1=$result_pt['pt_id'];
						  }
						  
					  }
			  }
					
		$order_id=$ordenum;
		$date=$cur;
		$branchofid=$branchid;
		require_once("printer_functions.php");
		$printpage1=new PrinterCommonSettings();
		$prtck1=$printpage1->print_kot_ta_consolidated($kot_id,$order_id,$date,$kotprint_tp1,$branchofid,"android");
				// print code common
			  
		if($prtck1>=1)
		  {
			$response["success"] = 0;
			$response["rsltmsg"] = "ok";
	
			
			echo json_encode($response);
		  }else
		  {
			$response["success"] = 1;
			$response["rsltmsg"] = "no";
			echo json_encode($response);
		  }
			
		
	}

}

else if($check == "printkot_counter")
{
	
	$kot_id = $_GET['kotnumber'];
	$branchid = $_GET['branchid'];
	$ordenum = $_GET['ordernum'];
	
	$rn=chr(13).chr(10); 
	$esc=chr(27); 
	$cutpaper=$esc."m";
	$bold_on=$esc."E1";
	$bold_off=$esc."E0";
	$reset=pack('n', 0x1B30);
	$right=$esc."a2";
	$left=$esc."a0";
	$center=$esc."a1";
	$underlineon=$esc."-1";
	$underlineofn=$esc."-0";
	date_default_timezone_set("Asia/Kolkata");
//printer setup

	$string="";
	$status="";
	//$printertype ="";
	//$printername="";
	$slnoinkot='';
	$rateinkot='';
	$staffinkot='';
	$itemcoutinkot='';
	require_once("printer_functions.php");
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
			  
			  $kotprint_tp='';
			  $kotprint_tp1='';
			$sql_table_pt="select * from tbl_printertype ";
			  $sql_pt  =  mysqli_query($localhost,$sql_table_pt); 
			  $num_pt  = mysqli_num_rows($sql_pt);
			  if($num_pt){
				  while($result_pt  = mysqli_fetch_array($sql_pt)) 
					  {
						  if($result_pt['pt_typename']=="KOT Print TA CS")
						  {
							  $kotprint_tp=$result_pt['pt_id'];
						  }
					  }
			  }
					
		$order_id=$ordenum;
		$date=$cur;
		$branchofid=$branchid;
		$printpage=new PrinterCommonSettings();
		$prtck=$printpage->print_kot_ta($kot_id,$order_id,$date,$kotprint_tp,$branchofid,"android");
		
		if($prtck>=1)
		  {
			$response["success"] = 0;
			$response["rsltmsg"] = "ok";
			echo json_encode($response);
		  }else
		  {
			$response["success"] = 1;
			$response["rsltmsg"] = "no";
			echo json_encode($response);
		  }
	}
}

else if($check == "printbill_counter")
{
	


	
	$branchid = $_GET['branchid'];
	$ordenum = $_GET['ordernum'];
	
	$rn=chr(13).chr(10); 
	$esc=chr(27); 
	$cutpaper=$esc."m";
	$bold_on=$esc."E1";
	$bold_off=$esc."E0";
	$reset=pack('n', 0x1B30);
	$right=$esc."a2";
	$left=$esc."a0";
	$center=$esc."a1";
	$underlineon=$esc."-1";
	$underlineofn=$esc."-0";
	date_default_timezone_set("Asia/Kolkata");
//printer setup

	$string="";
	$status="";
	//$printertype ="";
	//$printername="";
	$slnoinkot='';
	$rateinkot='';
	$staffinkot='';
	$itemcoutinkot='';
	require_once("printer_functions.php");

	$printpage=new PrinterCommonSettings(); 
	$prtck=$printpage->print_bill_ta($ordenum,"CS",$branchid,"android");

	if($prtck>=1)
		  {
			$response["success"] = 0;
			$response["rsltmsg"] = "ok";
			echo json_encode($response);
		  }else
		  {
			$response["success"] = 1;
			$response["rsltmsg"] = "no";
			echo json_encode($response);
		  }
	
}

else if($check == 'bill_settel_all_copy')
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
	$auth_secretkey = '';
	$auth_staffid = '';
	$credit_remark_cs = '';
	$auth_loginid = $_GET['login_id'];
	$username = $_GET['login_username'];
	$mode = $_GET['mode'];
	$upiamount=0;
	$upitxnid='';

	$credittype = $_GET['credittype'];
	$mobileno = "";


if ($credittype==3||$credittype==4) {


	
		
		

		mysqli_query($localhost,"SET @name = " . "'" . $credit_master_topass . "'");
		mysqli_query($localhost,"SET @mobileno = " . "'" . $mobileno . "'");
		mysqli_query($localhost,"SET @branchid = " . "'" . $branchid_topass . "'");
		mysqli_query($localhost,"SET @credit_type = " . "'" . $credittype . "'");


		$result=mysqli_query($localhost,"CALL proc_credit_entry(@name,@mobileno,@branchid,@credit_type,@credit_id)");


		$r = mysqli_query($localhost, 'SELECT @credit_id AS credit_id' );

		while($row = mysqli_fetch_array($r))
		{

			$a= $row['credit_id'];
			
				

		}


	}

	/*if ($credittype==4) {
		
		mysqli_query($localhost,"SET @name = " . "'" . $credit_master_topass . "'");
		mysqli_query($localhost,"SET @mobileno = " . "'" . $mobileno . "'");
		mysqli_query($localhost,"SET @branchid = " . "'" . $branchid_topass . "'");
		mysqli_query($localhost,"SET @credit_type = " . "'" . $credittype . "'");

		$result=mysqli_query($localhost,"CALL proc_credit_entry(@name,@mobileno,@branchid,@credit_type,@credit_id)");

		$r = mysqli_query($localhost, 'SELECT @credit_id AS credit_id' );
		while($row = mysqli_fetch_array($r))
		{
			$credit_master_topass= $row['credit_id'];
			//echo $credit_master_topass;

		}
	}*/
	
	
	
	if($amountpaid_topass=='')
	{
		$amountpaid_topass = 0;
	}
	if($transaction_amount_topass=='')
	{
		$transaction_amount_topass = 0;
	}
	if($card_bank_topass=='')
	{
		$card_bank_topass = 0;
	}
	if($coupon_amount_topass=='')
	{
		$coupon_amount_topass = 0;
	}
	if($chequeamount_topass=='')
	{
		$chequeamount_topass = 0;
	}
	
	if($credit_amount_topass=='')
	{
		$credit_amount_topass = 0;
	}

	if($balance_amount_topass=='')
	{
		$balance_amount_topass = 0;
	}
	
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
	mysqli_query($localhost,"SET @auth_secretkey = " . "'" . $auth_secretkey . "'");
	mysqli_query($localhost,"SET @auth_staffid = " . "'" . $auth_staffid . "'");
	mysqli_query($localhost,"SET @auth_loginid = " . "'" . $auth_loginid . "'");
	mysqli_query($localhost,"SET @mode = " . "'" . $mode . "'");
	mysqli_query($localhost,"SET @payment_login = " . "'" . $username . "'");
	mysqli_query($localhost,"SET @credit_remark_cs = " . "'" . $credit_remark_cs . "'");

	mysqli_query($localhost,"SET @order_confirming_staff = " . "'" . $username . "'");

	
	
	
	$message = '';
	$s = "Failed to execute the procedure";
	
	if($mode=="D")
	{
		$result1=mysqli_query($localhost,"CALL proc_billpayment(@billno,@branchid,@paymodeid,@amountpaid,@upiamount,@upitxnid,@transactionamount,
		@card_bank,@complementary,@remark,@voucherid,@couponcompany,@couponamt,@chequeno,@chequebankname,@chequeamount,@credit,@creditmasterid,
		@creditamount,@balanceamt,@complementary_staff,@auth_secretkey,@auth_staffid,@auth_loginid,@payment_login,@credit_remark_cs,@message)");
	
		$rs = mysqli_query($localhost, 'SELECT @message AS message' );
			while($row = mysqli_fetch_array($rs))
			{
				$s= $row['message'];
			}
		if($result1)
		{
			 $response["success"] = 0;
			 $response["message"] = $s;
			 echo json_encode($response);
			 
		}else
		{
			$response["success"] = 1;
			$response["message"] = $s;
			echo json_encode($response);
		}
	}
	else if($mode=="CS")
	{

		try
		  {	  
		  	
		  				  		/*echo "bill_number_topass ".$bill_number_topass.",branchid_topass ".$branchid_topass.",payment_mode_topass ".$payment_mode_topass.",amountpaid_topass ".$amountpaid_topass.",upiamount ".$upiamount.",upitxnid ".$upitxnid
	.",transaction_amount_topass".$transaction_amount_topass.",card_bank_topass".$card_bank_topass.",complimentary_topass".$complimentary_topass.",remarks_topass".$remarks_topass.",voucherid_topass".$voucherid_topass.",couponcompany_topass".$couponcompany_topass.",coupon_amount_topass".
	$coupon_amount_topass.",cheque_no_topass".$cheque_no_topass.",cheque_bankname_topass".$cheque_bankname_topass.",chequeamount_topass".
	$chequeamount_topass.",credittypes_topass".$credittypes_topass.",credit_master_topass".$credit_master_topass.",credit_amount_topass".
	$credit_amount_topass.",balance_amount_topass".$balance_amount_topass.
	",complimentary_staffid_topass".$complimentary_staffid_topass.",auth_secretkey".$auth_secretkey.",auth_staffid".$auth_staffid.",auth_loginid".
	$auth_loginid.",mode".$mode.",username".$username.",credit_remark_cs".$credit_remark_cs;*/

	//echo "b".$balance_amount_topass;

			  $result1=mysqli_query($localhost,"CALL proc_gencounter_billsettle_kot(@billno,@branchid,@paymodeid,@amountpaid,@upiamount,@upitxnid,@transactionamount,@card_bank,
			  @complementary,@remark,@voucherid,@couponcompany,@couponamt,@chequeno,@chequebankname,@chequeamount,@credit,@creditmasterid,@creditamount,
			  @balanceamt,@complementary_staff,@mode,@payment_login,@credit_remark_cs,@kotno,@order_confirming_staff,@message)") or throw_ex(mysqli_error($localhost)) ;
			  
			 
			$rs = mysqli_query($localhost, 'SELECT @message AS message,@kotno AS kot_num' );
			$proc_message = "Failed to execute the procedure";
			while($row = mysqli_fetch_array($rs))
			{
				$proc_message = $row['message'];
				$kot_number = $row['kot_num'];
				
			}
	


			if($proc_message == "KOT GENERATED & PAYMENT SUCCESSFUL")
			{

				$check_printAll = "select be_printall from tbl_branchmaster";
				$resultPA = mysqli_query($localhost,$check_printAll);
				if(mysqli_num_rows($resultPA)>0){
					$printAll = "";
					while($rowp = mysqli_fetch_array($resultPA))
					{
						$printAll = $rowp["be_printall"];
					}

					if ($printAll=="Y") {
						
					
				
			

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
						if($num_desg1){
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
							
							if($repl=="Y")
							{

								if($msg=="Y")
								{
									$kotprint_tp='';
									$sql_table_pt="select * from tbl_printertype";
									$sql_pt  =  mysqli_query($localhost,$sql_table_pt); 
									$num_pt  = mysqli_num_rows($sql_pt);
									if($num_pt)
									{
										
										while($result_pt  = mysqli_fetch_array($sql_pt)) 
										{

											
											  if($result_pt['pt_typename']== "Consolidated TA CS")
											  {
											  	require_once("printer_functions.php");
												$printpage=new PrinterCommonSettings();

												  $kotprint_tp=$result_pt['pt_id'];
												  
								
											$prtc=$printpage->print_kot_ta_consolidated($kot_number,$bill_number_topass,$date,$kotprint_tp,$branchid_topass,"android");

											


												  
											  }

											 /*else if($result_pt['pt_typename']=="KOT Print TA CS")
											{
												require_once("printer_functions.php");
												$printpage=new PrinterCommonSettings();
												$kotprint_tp=$result_pt['pt_id'];



												
											$prtck=$printpage->print_kot_ta($kot_number,$bill_number_topass,$date,$kotprint_tp,$branchid_topass,"android");




												
												
											}*/
										}
									}

									$check_d_bill="select bsc_settle_billprint from tbl_branch_settings_counter";
										$resultdb = mysqli_query($localhost,$check_d_bill);
										if(mysqli_num_rows($result1)>0)
										{

											while($rowdb = mysqli_fetch_array($resultdb))
											{
												$msgdb = $rowdb["bsc_settle_billprint"];
											}
										}

										if ($msgdb=='Y') {
												require_once("printer_functions.php");
										$printpage=new PrinterCommonSettings(); 
										$prtck=$printpage->print_bill_ta($bill_number_topass,$mode,$branchid_topass,"android");
											}	
									
								
									}
									else if($msg=="N")		
									{
										require_once("printer_functions.php");
										$printpage=new PrinterCommonSettings(); 
										$prtck=$printpage->print_bill_ta($bill_number_topass,$mode,$branchid_topass,"android");
										
										/*$kotprint_tp='';
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
													$prtck=$printpage->print_kot_ta($kot_number,$bill_number_topass,$date,$kotprint_tp,$branchid_topass,"android");
													
												}
											}
										}*/

										$check_consoldtd="select be_consolidated_print from tbl_branchmaster";
										$resultc = mysqli_query($localhost,$check_consoldtd);
										if(mysqli_num_rows($result1)>0)
										{

											while($rowc = mysqli_fetch_array($resultc))
											{
												$msgc = $rowc["be_consolidated_print"];
											}
										}

										if ($msgc=='Y') {



											$kotprint_tp1='';
											$sql_table_pt1="select * from tbl_printertype";
											$sql_pt1  =  mysqli_query($localhost,$sql_table_pt1); 
											$num_pt1  = mysqli_num_rows($sql_pt1);
											  if($num_pt1)
											  {

											  		require_once("printer_functions.php");
													$printpage=new PrinterCommonSettings();
												  while($result_pt1  = mysqli_fetch_array($sql_pt1)) 
												  {
													  if($result_pt1['pt_typename']== "Consolidated TA CS")
													  {
													  	
														  $kotprint_tp1=$result_pt1['pt_id'];
														  require_once("printer_functions.php");
														  $printpage=new PrinterCommonSettings();
														  $prtck=$printpage->print_kot_ta_consolidated($kot_number,$bill_number_topass,$date,$kotprint_tp1,$branchid_topass,"android");
														  
													  }
												  }
											  }	
											
										}

									}
							}
							else if( $repl=="N")
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

									$check_consoldtd="select be_consolidated_print from tbl_branchmaster";
									$resultc = mysqli_query($localhost,$check_consoldtd);
									if(mysqli_num_rows($result1)>0)
									{

										while($rowc = mysqli_fetch_array($resultc))
										{
											$msgc = $rowc["be_consolidated_print"];
										}
									}
									
									$check = "select * FROM tbl_takeaway_billmaster  Where tab_billno = '".$bill_number_topass."' AND (tab_mode_of_entry = 'G')";

									//echo $check;
									$result2 = mysqli_query($localhost,$check);
									if(mysqli_num_rows($result2)==0)
									{
										if($msg=="N")
										{
											require_once("printer_functions.php");
											$printpage=new PrinterCommonSettings(); 
											$prtck=$printpage->print_bill_ta($bill_number_topass,$mode,$branchid_topass,"android");
										}
										if($msgc=="Y")
										{

											$kotprint_tp='';
											$sql_table_pt="select * from tbl_printertype";
											$sql_pt  =  mysqli_query($localhost,$sql_table_pt); 
											$num_pt  = mysqli_num_rows($sql_pt);

											if($num_pt)
											{
												require_once("printer_functions.php");
												$printpage=new PrinterCommonSettings();
												while($result_pt  = mysqli_fetch_array($sql_pt)) 
												{
													if($result_pt['pt_typename']== "Consolidated TA CS")
													  {

														$kotprint_tp=$result_pt['pt_id'];
														  
										
														$prtc=$printpage->print_kot_ta_consolidated($kot_number,$bill_number_topass,$date,$kotprint_tp,$branchid_topass,"android");

													//echo $prtc;

														  
													  }	
												}

											}
										}
									}
											
										}		
									}
								}
							}
						}	
					}
				}
			   $response["success"] = 0;
			   $response["message"] = $proc_message;
			   $response["bill_number_generated"] = $bill_number_topass;
			   $response["KOT"] = $kot_number;
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
			 //echo   $returnmsg;exit();
			 $proc_message = "Failed to execute the procedure";
			 $response["success"] = 2;
			 $response["message"] = $proc_message;
			 echo json_encode($response);
		}
	}	
}



else if($check == 'bill_tax_details')
{
	$billnumber = $_GET['billnumber'];
	
	$sql_ds_nos="select bm_servicecharge,bm_vat,bm_discountvalue from tbl_tablebillmaster where bm_billno='".$billnumber."'";
	
	$result = mysqli_query($localhost,$sql_ds_nos);
	if(mysqli_num_rows($result) >0)
	{
		while($row = mysqli_fetch_array($result))
		{
			$response["sctax"] = $row["bm_servicecharge"];
			$response["vat"] = $row["bm_vat"];
			$response["discount"] = $row["bm_discountvalue"];
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

else if($check == 'bill_tax_details_cs')
{
	$billnumber = $_GET['billnumber'];
	
	$sql_ds_nos="select tab_servicecharge,tab_vat,tab_discountvalue from tbl_takeaway_billmaster where tab_billno='".$billnumber."' and tab_payment_settled='N'";
	
	$result = mysqli_query($localhost,$sql_ds_nos);
	if(mysqli_num_rows($result) >0)
	{
		while($row = mysqli_fetch_array($result))
		{
			$response["sctax"] = $row["tab_servicecharge"];
			$response["vat"] = $row["tab_vat"];
			$response["discount"] = $row["tab_discountvalue"];
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

else if($check == "getCancelReason")
{
	$sql = "SELECT * FROM `tbl_cancellation_reasons` WHERE `cr_active`='Y'";
	$result = mysqli_query($localhost,$sql);
	if(mysqli_num_rows($result)>0)
	{
		$response["reason_details"] = array();
		while($row = mysqli_fetch_array($result))
		{
			$submenu = array();
			$submenu["cr_id"] = $row["cr_id"];	
			$submenu["cr_reason"] = $row["cr_reason"];	
			
			array_push($response["reason_details"], $submenu);
			
		}
		$response["message"] = "ok";
		$response["response"] = 1;
		echo json_encode($response);
	}
	else
	{
		$response["message"] = "fails";
		$response["response"] = 0;
		echo json_encode($response);
	}	
}

else if($check == "servekot")
{
	$kot = $_GET['kot'];
	$branchid = $_GET['branchid'];
	$tempid = $_GET['tempid'];
	$date = $_GET['date'];
	
	$sql = "UPDATE `tbl_tableorder` SET `ter_status`='Served' where `ter_orderno`='".$tempid."' and `ter_branchid`='".$branchid."' AND `ter_dayclosedate`='".$date."' AND `ter_kotno`='".$kot."'";
	$result = mysqli_query($localhost,$sql);
	if($result)
	{
		$response["message"] = "ok";
		$response["response"] = 1;
		echo json_encode($response);
	}
	else
	{
		$response["message"] = "fails";
		$response["response"] = 0;
		echo json_encode($response);
	}	
}

else if($check == "kot_served_check")
{
	$kot = $_GET['kot'];
	$date = $_GET['date'];
	$ordernum = $_GET['ordernum'];
	
	$sql = "SELECT count(*) as c FROM `tbl_tableorder` WHERE `ter_kotno`='".$kot."' and `ter_dayclosedate`='".$date."' and ter_orderno = '".$ordernum."' and (ter_status='Opened' or ter_status='Ready')";
	
	$result = mysqli_query($localhost,$sql);
	if(mysqli_num_rows($result)>0)
	{
		while($row = mysqli_fetch_array($result))
		{
			$s = $row["c"];
			if($s==0)
			{
				$response["message"] = "fails";
				$response["response"] = 0;
				echo json_encode($response);
			}
			else
			{
				$response["message"] = "ok";
				$response["response"] = 1;
				echo json_encode($response);
			}	
		}
	}
	else
	{
		$response["message"] = "bb";
		$response["response"] = 0;
		echo json_encode($response);
	}	

}
 

else if($check == "all_table")
{


	
	
	$branchid = $_GET['branchid'];
	$floorid = $_GET['floorid'];
	mysqli_query($localhost,"SET @floorid = " . "'" . $floorid . "'");
	$sql=mysqli_query($localhost,"CALL proc_table_list(@floorid)") or $this->throw_ex(mysqli_error($con));
	
	if(mysqli_num_rows($sql)>0)
	{
		$response["tabledet"] = array();
		while($row = mysqli_fetch_array($sql))
		{

$submenu = array();

			/*$localhost=mysqli_connect(HOST_NAME, USER_NAME, PASSWORD,DATABASE_NAME);
			$sql_status = mysqli_query($localhost,"SELECT  td.ts_in_access FROM tbl_tabledetails td WHERE td.ts_orderno = '".$e."'");
				if (mysqli_num_rows($sql_status)>0) {
					
					$row2=mysqli_fetch_assoc($sql_status);
					if($row2["ts_in_access"]=="Y"){
						$k ="Y" ;	
					}
					else{
						$k="N";
					}
					
	
				}*/

				

			$submenu["ts_in_access"] = $row["in_access"];
			$submenu["tr_tableid"] = $row["tableid"];	
			$submenu["tr_tableno"] = $row["tableno"];
			$submenu["status"] = $row["status"];

                        if(($row["vacant"]!=0) && ($row["maxchair"]!=$row["vacant"]))
                            {
                            	$submenu["ts_in_access"] = "N";
	                            $submenu["tr_tableid"] = $row["tableid"];	
	                            $submenu["tr_tableno"] = $row["tableno"];
	                           
	                            $s = $row["table_prefix"];
	                            if($row["status"]=='Occupied'||$row["status"]=='Billed')
		                            {
		                            $submenu["ts_in_access"] = $row["in_access"];
		                            $submenu["prefix"] = $row["table_prefix"];
		                            }
	                            else
		                            {
		                          	$submenu["ts_in_access"] = $row["in_access"];
		                            $submenu["prefix"] = $s;
	                            	}
                            }

                            else
                            {
                            	
	                            $p = $row["table_prefix"];
	                            if($row["status"]=='Occupied'|| $row["status"]=='Billed')
		                            {
		                            $submenu["prefix"] = $row["table_prefix"];
		                            }
	                            else
		                            {
		                            $submenu["prefix"] = $p;
		                            }
                            }
			
			
			$h = $row["status"];	
			if($h==NULL)
			{
				$submenu["ts_in_access"] = "N";
				$submenu["status"] = "Vaccant";
				$submenu["tr_table_time"] ="0";
				$submenu["tr_final_total"]="0";
	        	$submenu["tr_steward_name"] = "0";
			}
			else
			{


			if ($h=="Billed") 
			{


				
				
				$localhost=mysqli_connect(HOST_NAME, USER_NAME, PASSWORD,DATABASE_NAME);

				$e = $row["orderno"];

				$billnumber=$row["billnumber"];

				if ($billnumber=="Split") {
					$submenu["tr_table_time"]="";
					$submenu["tr_final_total"]="Splitted";
				}

				$sql_billed = mysqli_query($localhost,"SELECT  bm_billtime, bm_finaltotal FROM tbl_tablebillmaster bm
                    left join tbl_tabledetails td on td.ts_billnumber = bm.bm_billno WHERE td.ts_orderno = '".$e."'");

					

				if (mysqli_num_rows($sql_billed)>0) {
					
					
			

					$row1=mysqli_fetch_assoc($sql_billed);

					
					// $submenu["status"] = "Billed";

                   	$submenu["tr_table_time"]=date('h:i:s A', strtotime($row1["bm_billtime"]));
                   	$y=number_format($row1["bm_finaltotal"],$_SESSION["be_decimal"]);
                    $submenu["tr_final_total"]=$y;


                    
				
				}

			}
			else
				{
					//$submenu["status"] = $row["status"];
					$submenu["tr_table_time"] =date('h:i:s A', strtotime($row["dineintime"]));
					$y=number_format($row["totalamount"],$_SESSION["be_decimal"]);
		        	$submenu["tr_final_total"] = $y;
					
	        	}

	        		
					$submenu["tr_steward_name"] = $row["firstname"];
			}

			
			
			$e = $row["orderno"];	
			if($h==NULL)
			{
				$submenu["ordernum"] = "";
			}
			else
			{
				$submenu["ordernum"] = $row["orderno"];
			}
			
			$q = $row["staff"];	
			if($h==NULL)
			{
				$submenu["staffid"] = "";
			}
			else
			{
				$submenu["staffid"] = $row["staff"];
			}
			

			
			if($h==NULL)
			{
				$submenu["tr_vaccantcount_empty"] = $row["maxchair"]-$row["vacant"];	
				//$submenu["tr_vaccantcount_empty"] =2;	
				$submenu["tr_vaccantcount"] = $row["vacant"];
			}
			else{
					$array=array();
				$array=explode(",", $row["noofpersons"]);

           	if (sizeof($array)>1) 
           	{
           		$person=0;
           		for ($i=0; $i <sizeof($array) ; $i++) { 
           			$person=$person+$array[$i];
				}
				$submenu["tr_vaccantcount_empty"] = $person;	
				//$submenu["tr_vaccantcount_empty"] = 4;	
				$submenu["tr_vaccantcount"] = $row["vacant"];
			}
			else{
				$submenu["tr_vaccantcount_empty"] = $row["noofpersons"];	
				//$submenu["tr_vaccantcount_empty"] = 3	;
				$submenu["tr_vaccantcount"] = $row["vacant"];
			}
			}
			

			$submenu["ts_macid"] = $row["macid"];
			//$localhost1=mysqli_connect(HOST_NAME, USER_NAME, PASSWORD,DATABASE_NAME);



			array_push($response["tabledet"], $submenu);
			
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

else if($check == "code_check")
{
	$code = $_GET['code'];
	$staffid = $_GET['staffid'];
	$branchid = $_GET['branchid'];
		
	$sql = "SELECT ser_confirm_code FROM `tbl_staffmaster` WHERE `ser_staffid`='".$staffid."' and`ser_branchofficeid`='".$branchid."'";
		
	$result = mysqli_query($localhost,$sql);
	if(mysqli_num_rows($result)>0)
	{
		while($row = mysqli_fetch_array($result))
		{
			$mssg = "";
			$s = $row["ser_confirm_code"];
			if($s==NULL)
			{
				$mssg = "Code has not been provided in server";
				$response["message"] = $mssg;
				$response["success"] = 0;
			}
			else
			{
				if($code==$s)
				{
					$mssg = "ok";
					$response["message"] = $mssg;
					$response["success"] = 1;
				}
				else
				{
					$mssg = "Code mismatch";
					$response["message"] = $mssg;
					$response["success"] = 2;
				}
			}
		}
		echo json_encode($response);
	}
	else
	{
		$response["message"] = "Staffid with details not found";
		$response["success"] = 3;
		echo json_encode($response);
	}	

}


else if($check=="ts_access"){

	
$tableid = $_GET['tableid'];
$array=explode(',', $tableid);

           	if (sizeof($array)>1) 
           	{
           		for ($i=0; $i <sizeof($array) ; $i++) 
           		{ 
					$ts_access="select ts_in_access,ts_machineid FROM tbl_tabledetails where ts_tableid='".$array[$i]."'";	
           		}
           	}
           	else
           	{
           		$ts_access="select ts_in_access,ts_machineid FROM tbl_tabledetails where  ts_tableid='".$tableid."'";	
           		
           	}
           	$resultt=mysqli_query($localhost,$ts_access);
           	if(mysqli_num_rows($resultt)>0)
           	{
           		
           		$response["ts_access"] = array();
           		while($row = mysqli_fetch_array($resultt))
           		{
           				$subarray=array();
           				$subarray["ts_in_access"]=$row["ts_in_access"];
           				$subarray["ts_machineid"]=$row["ts_machineid"];
           		}
           		array_push($response["ts_access"], $subarray);
           		$response["success"]=1;
           	}
           	else{
           		$response["success"]=0;
           	}

echo json_encode($response);
}



//counter bill_history


else if($check == "bill_history_list"){

$da = $_GET['date'];


   $payment_pending='';
   if($_REQUEST['payment_pending']!=''){

       $payment_pending=" tbm.tab_payment_settled='N' and tbm.tab_status!='Cancelled' and ";
       $bill_history = "select tbm.tab_billno as bill, tbm.tab_date as billdate, tbm.tab_time as billtime, tbm.tab_status as status,tbm.tab_bill_print as billprinted,tbm.tab_netamt as amount, pm.pym_name as paymode 
                   FROM tbl_takeaway_billmaster tbm
                   left join tbl_paymentmode pm on pm.pym_id=tbm.tab_paymode
                   where tbm.tab_mode='CS' and $payment_pending tbm.tab_dayclosedate=(SELECT dc_day FROM tbl_dayclose dc where dc.dc_dateclose IS NULL AND dc.dc_timeclose IS NULL ORDER BY dc.dc_id desc LIMIT 1) and tbm.tab_billno NOT LIKE '%TEMP%' AND tbm.tab_billno NOT LIKE '%HOLD%' and tbm.tab_billno NOT IN(select cbd.cbd_billno FROM tbl_combo_bill_details_ta cbd)
                   order by tbm.tab_date,tbm.tab_time asc;";

   }
   else{
   

   	   $payment_pending='';
   	  

   	   $bill_history = "select tbm.tab_billno as bill, tbm.tab_date as billdate, tbm.tab_time as billtime, tbm.tab_status as status,tbm.tab_bill_print as billprinted,tbm.tab_netamt as amount, pm.pym_name as paymode 
                   FROM tbl_takeaway_billmaster tbm
                   left join tbl_paymentmode pm on pm.pym_id=tbm.tab_paymode
                   where tbm.tab_mode='CS' and $payment_pending tbm.tab_dayclosedate='".$da."' and tbm.tab_billno NOT LIKE '%TEMP%' AND tbm.tab_billno NOT LIKE '%HOLD%'
                   and tbm.tab_payment_settled='Y' and tbm.tab_billno NOT IN(select cbd.cbd_billno FROM tbl_combo_bill_details_ta cbd) order by tbm.tab_date,tbm.tab_time asc;";



   }


      $result_bill_history = mysqli_query($localhost,$bill_history);
if(mysqli_num_rows($result_bill_history) >0)
{
	$response["success"]=1;
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
       else{
       	$response["success"]=0;
       }
echo   json_encode($response);      
}



else if($check == "multi_card_insertion"){


$mc_billno=$_GET['billno'];
$mc_cardtype=$_GET['cardtype'];
$mc_cardamount=$_GET['cardamount'];
$mc_carnumber=$_GET['carnumber'];

if($mc_cardtype==""){
	$mc_cardtype=0;

}

/*echo "INSERT INTO `tbl_bill_card_payments`(`mc_billno`, `mc_cardtype`, `mc_cardamount`, `mc_carnumber`) VALUES ('$mc_billno','$mc_cardtype','$mc_cardamount','$mc_carnumber')";
*/
$sql="INSERT INTO `tbl_bill_card_payments`(`mc_billno`, `mc_cardtype`, `mc_cardamount`, `mc_carnumber`) VALUES ('$mc_billno','$mc_cardtype','$mc_cardamount','$mc_carnumber')";
$result=mysqli_query($localhost,$sql);

if ($result) {
	$response["success"]=0;
}
else{
	$response["success"]=1;
}


echo   json_encode($response);  
}

else if($check == "quick_cash_view"){
    
    
           	$ts_access="select dm_denomination from tbl_denomination_master where dm_active='Y' order by dm_display_order asc";	
           	
           	$resultt=mysqli_query($localhost,$ts_access);
           	if(mysqli_num_rows($resultt)>0)
           	{
           		
           		$response["denomination"] = array();
           		while($row = mysqli_fetch_array($resultt))
           		{
           				$subarray=array();
           				$subarray["denomination"]=$row["dm_denomination"];
           			array_push($response["denomination"], $subarray);	
           		}
           		
           	$response["message"]='OK';
           	}else{
                    $response["message"]='NOTOK';
                }
           	

echo json_encode($response);

}

 else if($check == "cancel_cs_itemqty"){
    
   
   $response["success"]=0;

    $billno= $_GET['billno'];
    $itemslno = $_GET['itemslno'];
    $itemqty = $_GET['itemqty'];
    //$reason = $_REQUEST['reason'];
    $slno = explode(',',$itemslno);
    $qty = explode(',',$itemqty);
    $reason=$_GET['reason'];
    $staff=$_GET['staff'];
    $login=$_GET['login'];
    $cancel_date_time=  date("Y-m-d H:i:s");
     if($_GET['reason']!=""){
      $reason= $_GET['reason'];
      
   }else{
      $reason=0; 
   }
  // echo "SELECT * FROM tbl_takeaway_billmaster WHERE tab_bill_reorder != 'Y' and tab_billno = '".$billno."'";
  // echo "SELECT * FROM tbl_takeaway_billmaster  WHERE tab_bill_reorder != 'Y'OR tab_bill_reorder IS NULL and tab_billno = '".$billno."'";
    $sql1 = "SELECT * FROM tbl_takeaway_billmaster  WHERE tab_bill_reorder != 'Y'OR tab_bill_reorder IS NULL and tab_billno = '".$billno."'";
	$result2 = mysqli_query($localhost,$sql1);
	if(mysqli_num_rows($result2) >0){
	
     if($billno[0]=="T"){
               $mode="TA"; 
          }else if($billno[0]=="H"){
            $mode="HD";    
          }else if($billno[0]=="C"){
              $mode="CS";
          }
     $branch_new='1';
     
     
    mysqli_query($localhost,"SET @branchid = " . "'" . $branch_new . "'");
    mysqli_query($localhost,"SET @temp_id = " . "'" . $billno . "'");
    mysqli_query($localhost,"SET @mode = " . "'" . $mode . "'");
    $sq=mysqli_query($localhost,"CALL proc_kot_cancel(@branchid,@temp_id,@mode,@cancel_id)");
    $rs = mysqli_query($localhost,"SELECT @cancel_id AS cancel_id");
    $row = mysqli_fetch_array($rs);
    $cancel_id= $row['cancel_id'];
    
   
    $sl_array=  array();
    
    for($i=0;$i<count($slno);$i++){
            if($qty[$i]!=""){
            
            $new_qty=0;    
         
    $sql_qry1 = "select tab_kotno from tbl_takeaway_billmaster 
where tab_billno = '".$billno."'";
        
   
    $resultt=mysqli_query($localhost,$sql_qry1);
 if(mysqli_num_rows($resultt)>0)
           	{
     while($row = mysqli_fetch_array($resultt))
           		{


$kot_no=$row['tab_kotno'];
}
                }

  
        $sql_qry = "select * from tbl_takeaway_billdetails 
where tab_billno = '".$billno."' and tab_slno = $slno[$i] order by tab_slno asc";
   
       
    $num_rows=mysqli_query($localhost,$sql_qry);
 if(mysqli_num_rows($num_rows)>0)
           	{
  
$result_row = mysqli_fetch_array($num_rows);

if($result_row['tab_qty'] != $qty[$i]){
        
     $sl_array[]=$slno[$i];
   
         
                   mysqli_query($localhost,"update tbl_takeaway_billdetails set tab_qty = $qty[$i],tab_amount = $qty[$i]*tab_rate
                    where tab_billno = '".$billno."' and tab_slno = $slno[$i] and tab_status!='Cancelled'");
                   
                    
               
                  if( $qty[$i]==0){
                mysqli_query($localhost,"update tbl_takeaway_billdetails set tab_status='Cancelled',tab_cancelled='Y'
                    where tab_billno = '".$billno."' and tab_slno = '".$slno[$i]."'");
                mysqli_query($localhost,"update tbl_takeaway_billdetails set tab_qty='0',tab_amount='0',tab_status='Cancelled',tab_cancelled='Y'
                    where tab_billno = '".$billno."' and tab_bill_addon_slno = '".$slno[$i]."'");

         }   
                    
               
     $new_qty=$result_row['tab_qty']- $qty[$i];   
     
     
      if($billno[0]=="T"){
               $mode="TA"; 
          }else if($billno[0]=="H"){
            $mode="HD";    
          }else if($billno[0]=="C"){
              $mode="CS";
          }
     
     
         
    
        mysqli_query($localhost,"insert into tbl_takeaway_cancel_items (tc_mode,tc_dayclosedate,tc_cancel_kotno,tc_cancel_id,tc_billno,tc_bill_slno,tc_cancel_qty,tc_cancelled_by,tc_cancelled_login,tc_cancelled_time,tc_reason)"
                . " values('".$mode."','".$_GET['date_dayclose']."','".$kot_no."','".$cancel_id."','".$billno."','".$slno[$i]."','".$new_qty."','".$staff."','".$login."','".$cancel_date_time."','".$reason."')");
        
        
        
             }
                   
      
}
}
               
     }
    
     
     
          if($billno[0]=="T"){
               $homed="TA"; 
          }else if($billno[0]=="H"){
            $homed="HD";    
          }else if($billno[0]=="C"){
              $homed="CS";
          }
          
          
  	mysqli_query($localhost,"SET @billno	 	      = " . "'" .$billno . "'");
	mysqli_query($localhost,"SET @branchid 			= " . "'" . $branch_new. "'");
	mysqli_query($localhost,"SET @bmode 			= " . "'" . $homed . "'");
	
	$kotno="";
	$sq=mysqli_query($localhost,"CALL  proc_ta_kot_cancel(@billno,@branchid,@bmode,@MESSAGE)");
	
        $response["success"]=1;
        $rp="";
        require_once("printer_functions.php");
        $printpage=new PrinterCommonSettings();
         //$printpage->print_kot_cancel_ta($cancel_id,$_SESSION['date'],"web",$_SESSION['branchofid'],$sl_array);
         
         //do not delete this 2 $printpage//
         
         // $printpage->print_kot_cancel_ta_consolidated($cancel_id,$_SESSION['date'],"web",$_SESSION['branchofid']);
          
          
          
          
          
         $sql_qry11 =mysqli_query($localhost,"select * from tbl_takeaway_billmaster 
  where tab_billno = '".$billno."'");
        
$num_rows11 = mysqli_num_rows($sql_qry11);
if($num_rows11){
  while($result_row11 = mysqli_fetch_array($sql_qry11)){

$billprinted = $result_row11['tab_bill_print'];

$net_amount=$result_row11['tab_subtotal'];
        }
}
          
          
          
         if($billprinted=='Y' && $net_amount>0){
                if($_SESSION['s_printst']=='Y'){
         $printpage->print_bill_ta($billno,$homed,$_SESSION['branchofid'],"web",$_SESSION['billip'],$_SESSION['hosttype'],$rp);
                }
     }
     
	}else{
		  $response["success"]=0;
	}
       echo json_encode($response);
     
}




    function billreprint($billnumber,$branchid,$message1,$bill_reply1)
	{
				include("appdbconnection.php"); // DB Connection class
			 	$billno=$billnumber;
				// print bill starts
				require_once("printer_functions.php");
				$printpage=new PrinterCommonSettings(); 
				$prtck=$printpage->print_bill($billno,$branchid,"android");
				
				$direct="";
					$sql_branch =  mysqli_query($localhost,"Select * from tbl_branchmaster where be_branchid='".$branchid."'"); 
					$num_branch  = mysqli_num_rows($sql_branch);
					if($num_branch)
					{
						  while($result_branch  = mysqli_fetch_array($sql_branch)) 
							  {
								  
								  $direct= $result_branch["be_directclosefirst"];
								  
							  }
					}
					
					
				 if($direct=='Y') 
			   {
				   
				   mysqli_query($localhost,"SET @billno = " . "'" . $billnumber . "'");
				  $message='';
				  $sq=mysqli_query($localhost,"CALL proc_billclose(@billno,@message)");
				  $rs = mysqli_query($localhost,'SELECT @message AS message' );
				  while($row = mysqli_fetch_array($rs))
				  {
				  $s= $row['message'];
				  }
			   }
				
				 $response["success"] = 7;
				 $response["message"] = $message1;
				 $response["bill_reply"] = $bill_reply1;
				 echo json_encode($response);
	  
		}





		function send_mail($mail,$name,$content) {

			include("appdbconnection.php");
			require_once('Mailer/PHPMailerAutoload.php');
			include('email/km_smtp_class.php'); 
						$mail=$mail;
						$name=$name;
				   $be_mail_server		="";
				   $be_mail_port		="";
				   $be_mail_emailid		="";
				   $be_mail_password	="";
				   $be_mail_secure		="";
				   $be_mail_from='';
				   $branchname='';
				 $sql_branch =  mysqli_query($localhost,"Select be_branchname from tbl_branchmaster where be_branchid='".$branchid."'"); 
				  $num_branch  = mysqli_num_rows($sql_branch);
				  if($num_branch)
				  {
						while($result_branch  = mysqli_fetch_array($sql_branch)) 
							{
								 $branchname=$result_branch['be_branchname'];
							}
				  }
				  $sql_general =  mysqli_query($localhost,"Select * from tbl_generalsettings "); 
				  $num_general  = mysqli_num_rows($sql_general);
				  if($num_general)
				  {
						while($result_general  = mysqli_fetch_array($sql_general)) 
							{
								 $be_mail_server			=$result_general['be_mail_server'];
								 $be_mail_port				=$result_general['be_mail_port'];
								 $be_mail_emailid			=$result_general['be_mail_emailid'];
								 $be_mail_password			=$result_general['be_mail_password'];
								 $be_mail_secure			=$result_general['be_mail_secure'];
								 $be_mail_from			    =$result_general['be_mail_from'];
							}
				  }
				  
				$emailto= $mail;
				$content= $content;
				$mailtext_o = stripslashes("Dear ".$name."\n".$content);
				$mailtext = preg_replace("|\n|","<br>","$mailtext_o");
				
				
				$mail = new PHPMailer();
		        $mail->isSMTP();
		        $mail->CharSet = "UTF-8";
		        $mail->SMTPSecure = $be_mail_secure;
		        $mail->SMTPOptions = array(
		            'ssl' => array(
		                'verify_peer' => false,
		                'verify_peer_name' => false,
		                'allow_self_signed' => true
		            )
		        );        
		       
		         $from_name="Expodine";      
		        $mail->Host = $be_mail_server;
		        $mail->SMTPAuth = true;
		        $mail->Username = $be_mail_emailid;
		        $mail->Password = $be_mail_password;
		        $mail->Port = $be_mail_port;
		        $mail->SetFrom($be_mail_from,$from_name);
		        $mail->Subject = "EXPODINE";
		        $mail->Body = $mailtext;
		        
		        
		        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		        
		        $emls=explode(",",$emailto);
				  $ctem=count($emls);
				  if($ctem==0)
				  {
				  		 $mail->AddAddress($allmail);
				  }else
				  {
					  for($k=0;$k<$ctem;$k++)
					  {
						 
		                                   $mail->AddAddress($emls[$k]);
					  }
				  }   
		        
		        if (!$mail->send()) {
		            //echo 'Message could not be sent.';
		           // echo 'Mailer Error: ' . $mail->ErrorInfo;

		        	$response["success"] = 1;
			
					$response["mail_status"] =  $mail->ErrorInfo;
			    	echo json_encode($respons);
		        } else {
		          //echo 'Message sent.';

		        	$i=0;

		        	$response["success"] = 0;
		        	$response["i"] = $i;
					
					$response["mail_status"] = "Message sent";
			    	echo json_encode($response);



		          
		        }
				
				
			
}

function sendsms($mobile,$name,$content){

				include("appdbconnection.php");
				
				$phonelist= $mobile;
				$content= $content;
				$smstext= "Dear ".$name."\n".$content; 
				$be_sms_username		="";
				$be_sms_apipassword	="";
				$be_sms_senderid		="";
				  $sql_general =  mysqli_query($localhost,"Select * from tbl_generalsettings "); 
				  $num_general  = mysqli_num_rows($sql_general);
				  if($num_general)
				  {//`tbl_generalsettings`(`be_id`, `be_mail_server`, `be_mail_port`, `be_mail_emailid`, `be_mail_password`, `be_mail_secure`, `be_sms_username`, `be_sms_apipassword`, `be_sms_senderid`)
						while($result_general  = mysqli_fetch_array($sql_general)) 
							{
								
								 $be_sms_username			=$result_general['be_sms_username'];
								 $be_sms_apipassword		=$result_general['be_sms_apipassword'];
								 $be_sms_senderid			=$result_general['be_sms_senderid'];
							         $be_sms_domainid			=$result_general['be_sms_domainid'];
		                                                 $be_sms_priority			=$result_general['be_sms_priority'];
		                                                 $be_sms_method			        =$result_general['be_sms_method'];
		                                                 
		                                        }
				  }
				
				
				//http://www.webqua.net/pushsms.php?username=exploreit&api_password=f8386edkhhzkcsaqt&sender=websms&to=9895366444&message=thank%20you%20for%20contacting%20us&priority=11
				$username=$be_sms_username;
				$api_password=$be_sms_apipassword;
				$sender=$be_sms_senderid;
				$domain=$be_sms_domainid;
		                $priority=$be_sms_priority;
		                $smstype = $be_sms_method; 

				$username=urlencode($username);
				$sender=urlencode($sender);
				$message=urlencode($smstext);
				$domain=urlencode($domain);
		                $route=urlencode($priority);
		                
                                
                                 $parameters="username=$username&api_password=$api_password&sender=$sender&to=$phonelist&priority=$route&message=$message";
				if($method=="POST")
				{
					$opts = array(
					  'http'=>array(
						'method'=>"$method",
						'content' => "$parameters",
						'header'=>"Accept-language: en\r\n" .
								  "Cookie: foo=bar\r\n"
					  )
					);
			
					$context = stream_context_create($opts);
			
					
				}
				else
				{
					
                                        $fp = fopen("http://$domain/pushsms.php?$parameters", "r");
				}
			
				$response = stream_get_contents($fp);
				fpassthru($fp);
				fclose($fp);
			
				
			

	

}


?>