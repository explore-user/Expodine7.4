<?php

include("appdbconnection.php");
require_once("Escpos.php"); 
date_default_timezone_set("Asia/Kolkata");

$check=$_GET['check_value'];



if ($check=="login") 
{

	
	$pin = $_GET['pincode'];


	$qry_day_close="SELECT dc_day  FROM tbl_dayclose WHERE dc_dateclose IS NULL;";
	$result_dycls=mysqli_query($localhost,$qry_day_close);
	$row_day_close=mysqli_fetch_assoc($result_dycls);
	$day_close=$row_day_close['dc_day'];
	$dayof=date('l',strtotime($day_close));
                         

                         
	
	if ($day_close) 
	{

		$qry_uname="SELECT `ls_username` from tbl_logindetails left join tbl_staffmaster  on tbl_staffmaster.ser_staffid=tbl_logindetails.`ls_staffid` where tbl_staffmaster.ser_authorisation_code='$pin';";
		$result_uname=mysqli_query($localhost,$qry_uname);
		
		$row=mysqli_fetch_assoc($result_uname);
		$uname=$row['ls_username'];


	if ($uname) 
	{



	$query_aplgn="SELECT `ls_applogin`,`ls_staffid` from tbl_logindetails  where tbl_logindetails.ls_username='$uname';";
	$result_aplgn=mysqli_query($localhost,$query_aplgn);
	$rw=mysqli_fetch_assoc($result_aplgn);
	$app_login=$rw['ls_applogin'];
	//echo $app_login;


		if($app_login=="Y")
					{


						
						$staff_id=$rw['ls_staffid'];
						echo json_encode(['Success'=>1,'Message'=>"User permission Granted",'Day_Close'=>"$day_close",'Day_Close_day'=>"$dayof",'StaffId'=>"$staff_id",'uname'=>"$uname"]);
						
						

					}

		else
					{
						$fail=array('Success'=>2,'Message'=>'No Permission');
						$fail_data=json_encode($fail);
						echo $fail_data;
					}			


		
	}

	else
	{
		echo json_encode(['Success'=>0,'Message'=>"No User Found"]);
	}

		
	}

	else
	{
		echo json_encode(['Success'=>3,'Message'=>"Day is not open"]);
	}
}


if ($check=="insertmacid") 

{

	$macid = $_GET['macid'];
	$v_code = $_GET['v_code'];

	$qry_smacid="SELECT *  FROM tbl_appmachinedetails WHERE as_appmachineid='$macid';";

	
	$result_smacid=mysqli_query($localhost,$qry_smacid);
	$row_smacid=mysqli_fetch_assoc($result_smacid);
	$smacid=$row_smacid['as_appmachineid'];

	if ($row_smacid>0) 
	{

	$qry_upmacid =mysqli_query($localhost,"update  tbl_appmachinedetails set as_em_cur_ver='$v_code' WHERE as_em_update_found = 'Y' and as_appmachineid='".$macid."'");

		echo json_encode(['Success'=>0,'Message'=>"Already Exist",'Macid'=>"$macid"]);
		
	}

	else
	{
		

		$qry_imacid="INSERT into tbl_appmachinedetails (as_appmachineid,as_em_cur_ver) values('$macid','$v_code');";

	
		mysqli_query($localhost,$qry_imacid);
		
		
		$response["Message"] = "MacID Inserted";
		$response["Success"] = 1;
    	echo json_encode($response);
	}



}

if ($check=="selectlanguage") 

{

	

	$qry_slanguage="SELECT *  FROM tbl_languages WHERE ls_status='Y';";

	
	$result_sflanguage=mysqli_query($localhost,$qry_slanguage);

	if (mysqli_num_rows($result_sflanguage) > 0) {
    // looping through all results
    // products node
	    $response["languages"] = array();
		
	    while ($row = mysqli_fetch_array($result_sflanguage)) {
	        // temp user array
	        $submenu = array();
	        $submenu["language"] = $row["ls_language"];	
	        $submenu["language_id"] = $row["ls_id"];	
	        array_push($response["languages"], $submenu);
	    }

	    $response["Message"] = "Y";
	    $response["Success"] = 0;
	    // echoing JSON response
	    echo json_encode($response);
	}
	else
	{
		$response["Message"] = "N";
	    $response["Success"] = 1;
	    // echoing JSON response
	    echo json_encode($response);
	}
	
	
}

if ($check=="selectfloor") 

{

	

	$qry_sfloor="SELECT *  FROM tbl_floormaster WHERE fr_status='Active';";

	
	$result_sfloor=mysqli_query($localhost,$qry_sfloor);

	if (mysqli_num_rows($result_sfloor) > 0) {
    // looping through all results
    // products node
	    $response["floor_master"] = array();
		
	    while ($row = mysqli_fetch_array($result_sfloor)) {
	        // temp user array
	        $submenu = array();
	        $submenu["floor_name"] = $row["fr_floorname"];	
	        $submenu["floor_id"] = $row["fr_floorid"];	
	        array_push($response["floor_master"], $submenu);
	    }

	    $response["Message"] = "Y";
	    $response["Success"] = 0;
	    // echoing JSON response
	    echo json_encode($response);
	}
	else
	{
		$response["Message"] = "N";
	    $response["Success"] = 1;
	    // echoing JSON response
	    echo json_encode($response);
	}
	
	
}



else if($check == "all_table")
{
	
	$floorid = $_GET['floorid'];
	mysqli_query($localhost,"SET @floorid = " . "'" . $floorid . "'");
	$sql=mysqli_query($localhost,"CALL proc_table_list(@floorid)") or $this->throw_ex(mysqli_error($con));
	
	if(mysqli_num_rows($sql)>0)
	{
		$response["tabledet"] = array();
		while($row = mysqli_fetch_array($sql))
		{
			$submenu = array();
			$submenu["ts_in_access"] = $row["in_access"];
			$submenu["tr_tableid"] = $row["tableid"];	
			$submenu["tr_tableno"] = $row["tableno"];
                        if(($row["vacant"]!=0) && ($row["maxchair"]!=$row["vacant"]))
                            {
                            	$submenu["ts_in_access"] = "N";
								$submenu["tr_tableid"] = $row["tableid"];	
								$submenu["tr_tableno"] = $row["tableno"];

								//$s = chr($row["asci"]);
								if($row["status"]=='Occupied'||$row["status"]=='Billed')
								{
									$submenu["ts_in_access"] = $row["in_access"];
									$submenu["prefix"] = $row["table_prefix"];
								}
								else
								{
									$submenu["ts_in_access"] = $row["in_access"];
									$submenu["prefix"] = $row["table_prefix"];
								}
                            }
                            else{
								//$p = chr($row["asci"]);
								if($row["status"]=='Occupied'|| $row["status"]=='Billed')
								{
									$submenu["prefix"] = $row["table_prefix"];
								}
								else
								{
									$submenu["prefix"] = $row["table_prefix"];
								}
                            }
			
			
			$h = $row["status"];	
			if($h==NULL)
			{
				$submenu["ts_in_access"] = "N";
				$submenu["status"] = "Vaccant";
			}
			else
			{
				$submenu["status"] = $row["status"];
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
			$persons_count = 0;
			$persons_count1 = 0;
			$persons_count = explode(',',$row["noofpersons"]);
			for($v=0;$v<count($persons_count);$v++){
                $persons_count1= $persons_count1+$persons_count[$v];
             }
			 $submenu["tr_vaccantcount_empty"] = $persons_count1;
		
			$h = $row["status"];	
			if($h==NULL)
			{
				$submenu["tr_vaccantcount"] = $row["vacant"];
			}
			else
			{
				$submenu["tr_vaccantcount"] = $persons_count1;
			}
		 $submenu["ts_macid"] = $row["macid"];
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


else if($check == 'noofpersons')
{
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
          $result1=mysqli_query($localhost,"CALL proc_tabledetailentry(@orderid,@tableid,@guestcount,@category,'N',@staffid,'','E',@macid)") or throw_ex(mysqli_error($localhost)) ;
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
           		$update_access="update tbl_tabledetails set ts_in_access='Y' where ts_tableid='".$tableid."'";
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
	
}


else if($check == 'check_billed_or_not')
{
	$tableid = $_GET['table_id'];
	$tableprefix = $_GET['table_prefix'];
	$second = mysqli_query($localhost,"SELECT ts_status,ts_orderno FROM tbl_tabledetails WHERE ts_tableidprefix ='".$tableprefix."' and ts_tableid = '".$tableid."'");
	
	if(mysqli_num_rows($second) > 0)
	{
		while($row = mysqli_fetch_array($second))
		{
			$status = $row['ts_status'];
			$ts_orderno = $row['ts_orderno'];
		}
		
		if($status=="Billed")
		{
			$response["success"] = 2;
			$response["message"] = "Table already billed";
			echo json_encode($response);
		}
		
		else{
			$response["success"] = 1;
			$response["message"] = $ts_orderno;
			echo json_encode($response);
		}
	}

	else 
		{
			$response["success"] = 3;
			$response["message"] = "Table already Closed";
			echo json_encode($response);
		}


}
else if($check=="order_history")
{
		$order_no = $_GET['order_no'];
		$qry_order="SELECT tbl_portionmaster.pm_portionname,ter_entrytime,ter_slno,ter_status,ter_menuid,ter_total_rate,ter_qty,ter_preferencetext,ter_preference,ter_portion FROM tbl_tableorder right join tbl_portionmaster on tbl_portionmaster.pm_id=tbl_tableorder.ter_portion  WHERE ter_orderno='".$order_no."'";
		
		$result_order = mysqli_query($localhost,$qry_order);

		if (mysqli_num_rows($result_order)>0) 
		{
					$response["order_history"] = array();		 
						
				while ($row = mysqli_fetch_array($result_order)) 
				{
					$order["ter_entrytime"] = $row["ter_entrytime"];	
					$order["ter_slno"] = $row["ter_slno"];	
					$order["ter_status"] = $row["ter_status"];	
					$order["ter_menuid"] = $row["ter_menuid"];	
					$order["ter_rate"] = $row["ter_total_rate"];	
					$order["ter_qty"] = $row["ter_qty"];
					$order["ter_preferencetext"] = $row["ter_preferencetext"];	
					$order["ter_preference"] = $row["ter_preference"];
					$order["pm_portionname"] = $row["pm_portionname"];




					$menuid=$row["ter_menuid"];
					
					$qry_name="SELECT mr_menuname FROM tbl_menumaster WHERE mr_menuid='".$menuid."'";
					$result_name = mysqli_query($localhost,$qry_name);
					if (mysqli_num_rows($result_name)>0) 
					{
						while ($row = mysqli_fetch_array($result_name)) 
						{
							$order["mr_menuname"] = $row["mr_menuname"];	
						}
					}
					else{
							$order["mr_menuname"] = "";	

					}
					
					
					
					
						$qry_img="SELECT mes_imagethumb FROM tbl_menuimages WHERE mes_menuid='".$menuid."'";
						$result_img = mysqli_query($localhost,$qry_img);
						if (mysqli_num_rows($result_img)>0)
						
						{
							$response["im_success"] = 1;
							while ($row = mysqli_fetch_array($result_img)) 
							{

								$order["mes_imagethumb"] = $row["mes_imagethumb"];	
								
							}
						}
						else
						{
							$response["im_success"] = 0;
							$order["mes_imagethumb"] = "";	
						}
						
						array_push($response["order_history"], $order);
					}
					$response["success"] = 1;
					echo json_encode($response);
			}

			else 
			{
				$response["success"] = 0;
				echo json_encode($response);
			}	
				
	

}




else if($check=="bill")
{
		$order_no = $_GET['order_no'];
		$qry_order="SELECT tbl_portionmaster.pm_portionname,ter_entrydate,ter_portion,ter_billnumber,ter_entrytime,ter_slno,ter_rate,ter_status,ter_menuid,sum(ter_qty) as ter_qty,sum(ter_qty*ter_rate) as ter_total_rate FROM tbl_tableorder right join tbl_portionmaster on tbl_tableorder.ter_portion=tbl_portionmaster.pm_id  WHERE ter_orderno='".$order_no."' group by ter_menuid,ter_portion";
		$result_order = mysqli_query($localhost,$qry_order);

		if (mysqli_num_rows($result_order)>0) 
		{
					$response["bill"] = array();		 
						
				while ($row = mysqli_fetch_array($result_order)) 
				{
					$order["ter_entrydate"] = $row["ter_entrydate"];	
					$order["ter_entrytime"] = $row["ter_entrytime"];	
					$order["ter_slno"] = $row["ter_slno"];	
					$order["ter_status"] = $row["ter_status"];	
					$order["ter_menuid"] = $row["ter_menuid"];	
					$order["ter_rate"] = $row["ter_rate"];	
					$order["ter_qty"] = $row["ter_qty"];	
					$order["ter_portion"] = $row["pm_portionname"];	
					$order["ter_total_rate"] = $row["ter_total_rate"];	
					$order["ter_billnumber"] = $row["ter_billnumber"];	

					$menuid=$row["ter_menuid"];

					
					$qry_name="SELECT mr_menuname FROM tbl_menumaster WHERE mr_menuid='".$menuid."'";
					$result_name = mysqli_query($localhost,$qry_name);
					if (mysqli_num_rows($result_name)>0) 
					{
						while ($row = mysqli_fetch_array($result_name)) 
						{
							$order["mr_menuname"] = $row["mr_menuname"];	
						}
					}
					else{
							$order["mr_menuname"] = "";	

					}
					
					array_push($response["bill"], $order);
				}
				$response["success"] = 1;
				echo json_encode($response);
			}

			else 
			{
				$response["success"] = 0;
				echo json_encode($response);
			}	
				
}



else if($check=="tax_details")
{
	
	$order_no = $_GET['order_no'];
	$qry_bill="SELECT bm_billno FROM tbl_tablebillmaster WHERE bm_orderno='".$order_no."'";
	$result_bill = mysqli_query($localhost,$qry_bill);
	
	if (mysqli_num_rows($result_bill)>0) 
		{
						
				while ($row = mysqli_fetch_array($result_bill)) 
				{
					
					$response["bm_billno"]= $row["bm_billno"];	
					$bill_no= $row["bm_billno"];	
				}
				
				$qry_tax="SELECT bem_label,bem_total_value FROM tbl_tablebill_extra_tax_master WHERE bem_billno='".$bill_no."'";
				$result_tax = mysqli_query($localhost,$qry_tax);
				if (mysqli_num_rows($result_tax)>0) 
				{
					
								$response["tax_details"] = array();		 

					while ($row = mysqli_fetch_array($result_tax)) 
					{
						$tax["bem_label"]= $row["bem_label"];	
						$tax["bem_total_value"]= $row["bem_total_value"];	
						array_push($response["tax_details"], $tax);

							
					}
					$response["tax_success"]=1;
				}
				else
				{
					$response["tax_success"]=1;
				}
				
				$response["success"]=1;
				echo json_encode($response);

		}
	else
	{
		$response["success"]=0;
		echo json_encode($response);
	}

}



else if($check == 'cart_authorization')
{
	
	$authorization = mysqli_query($localhost,"SELECT be_emenu_cart_authorization FROM tbl_branchmaster");
	
	if(mysqli_num_rows($authorization) > 0)
	{
		while($row = mysqli_fetch_array($authorization))
		{
			$response["be_emenu_cart_authorization"] = $row['be_emenu_cart_authorization'];
		}
		
			$response["success"] = 1;
			echo json_encode($response);
	}	
	else{
			$response["success"] = 0;
			echo json_encode($response);
		}
	
}






else if ($check=="order_permission") 
{

	
	$pin = $_GET['pincode'];


		$qry_uname="SELECT `ls_username`,ts.ser_designation from tbl_logindetails ld 
		left join tbl_staffmaster ts on ts.ser_staffid=ld.`ls_staffid` 
		where ts.ser_authorisation_code='$pin'";
		
		$result_uname=mysqli_query($localhost,$qry_uname);
		
		$row=mysqli_fetch_assoc($result_uname);
		$uname=$row['ls_username'];
		$des_id=$row['ser_designation'];


	if ($uname) 
	{

		$query_aplgn="SELECT `ls_applogin`,`ls_staffid` from tbl_logindetails  where tbl_logindetails.ls_username='$uname';";
		$result_aplgn=mysqli_query($localhost,$query_aplgn);
		$rw=mysqli_fetch_assoc($result_aplgn);
		$app_login=$rw['ls_applogin'];
		$staffid=$rw['ls_staffid'];


					if($app_login=="Y")
					{

						$query_designation = mysqli_query($localhost,"SELECT `dr_takeorder` from tbl_designationmaster  where dr_designationid='".$des_id."'");
						if(mysqli_num_rows($query_designation) > 0)
						{
							while($row = mysqli_fetch_array($query_designation))
							{
								$dr_takeorder = $row['dr_takeorder'];
								if($dr_takeorder=="Y")
								{
									
									
									$query_userpermission = mysqli_query($localhost,"SELECT `um_access` from tbl_usermodules  left join tbl_modulemaster  on tbl_modulemaster.mer_moduleid=tbl_usermodules.`um_moduleid` left join `tbl_modulesubmaster` on tbl_usermodules.um_submoduleid=tbl_modulesubmaster.mser_submoduleid where tbl_modulemaster.mer_modulename='Table Order' and tbl_modulesubmaster.mser_subname='Load Menu Order' and um_username='".$uname."'");
											if(mysqli_num_rows($query_userpermission) > 0)
											{
														while($row = mysqli_fetch_array($query_userpermission))
														{
															$um_access=$row['um_access'];
															if($um_access=="Y")
															{


																$response["access_success"]=1;
																$response["staffid"] = $staffid;
															}
															else{
																$response["access_success"]=0;
																$response["um_access"]=$um_access;
																$response["message"]="You dont have permission to take order";

															}
														}
											}
											else{
												$response["access_success"]=0;
												$response["message"]="You dont have permission to take order";
											}

								}else{
									$response["access_success"]=0;
									$response["dr_takeorder"]=$dr_takeorder;
									$response["message"]="You dont have permission to take order";

								}
					
							}
						}
						else{
							$response["access_success"]=0;
						$response["message"]="You dont have permission to take order";
					}
						
					}
					else{
						$response["access_success"]=0;
						$response["message"]="You dont have permission to take order";
					}

	}

	else
	{
		$response["access_success"]=0;
		$response["message"]="User Id not found";
	}

		echo json_encode($response);
	
}

else if($check == 'printer_ip_list')
{
	$floor_id = $_GET['floorid'];
	$kot_counter_name = $_GET['kot_counter_name'];
	
	$d = str_replace("_","'",$kot_counter_name);
	
	
	$sql = "select p.`pr_printerip`,c.kr_kotname from tbl_printersettings p left join tbl_kotcountermaster c on p.`pr_kotcode`=c.kr_kotcode 
	where p.`pr_floorid`='".$floor_id."' and p.`pr_enable`='Y' and p.`pr_kotcode` in (".$d .") and pr_defaultusb='N' group by p.`pr_printerip`";
	

	$result = mysqli_query($localhost,$sql);
	if(mysqli_num_rows($result) >0)
	{
		$response["printer_ip"] = array();
		
		while($row = mysqli_fetch_array($result))
		{
			$submenu = array();
			$submenu["ip"] = $row["pr_printerip"];
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


else if($check == 'new_insertdb')
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
	$s_preftext = $_GET['preftext'];
	$s_date = $_GET['date'];
	
	$unit_id = 0;
	$base_unit_id = 0;
	$rate_type = "Portion";
	$unit_type = NULL;
	$unit_weight = 0;
	
	$cur=date("Y-m-d");	
					
	$sql = "SELECT * FROM tbl_menustock WHERE mk_menuid = '".$s_menuid."'  AND mk_date = '".$s_date."' and mk_portion='".$s_portion."'";	
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

				
				        /*echo $s_ordernum .','.$s_branch .',' . $s_menuid . ','.$rate_type . ','.$s_portion . ','.$unit_type .','.$unit_weight . ','.$unit_id . 
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
					@entryuser,@est_time,@staff,@type,@floorid,@manual_rate,@preferencetext,@addon_slno,@messsage)");
				$rs = mysqli_query($localhost, 'SELECT @messsage AS messsage' );
				$s = "Proc no entry";
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
	} 	else 
			 {
				$response["success"] = 0;
				$response["message"] = "No Stock";
				
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






else if($check == 'update_status_single')
{
	$order	= $_GET['ordernum'];
	$branchid = $_GET['branchid'];
	$s_waiterid = $_GET['waiter_id'];
	$menuid = $_GET['menuid'];
	$portion = $_GET['portion'];
	$s_staffid = $_GET['staff_id'];
	
	$status = '';
	$s='';
	$kot_id='';
	$result='';
	
	
	$sql = "SELECT * FROM tbl_tableorder WHERE ter_orderno= '".$order."'  and  `ter_status` = 'Added'  and  `ter_cancel` = 'N'  and  `ter_menuid` = '".$menuid."'  and  `ter_portion` = '".$portion."'";
	
	$result = mysqli_query($localhost,$sql);
		if (mysqli_num_rows($result) > 0) 
		{
			if (strpos($order, 'TEMP') !== false)	
			{ 
				mysqli_query($localhost,"SET @temp_orderno = " . "'" . mysqli_real_escape_string($localhost, $order) . "'");
				mysqli_query($localhost,"SET @branchid = " . "'" . mysqli_real_escape_string($localhost,$branchid) . "'");
				mysqli_query($localhost,"SET @waiter_id = " . "'".mysqli_real_escape_string($localhost,$s_waiterid)."'");
				mysqli_query($localhost,"SET @staff_id = " . "'".mysqli_real_escape_string($localhost,$s_staffid)."'");
				$neworderno='';
				$kotnum='';
				$result=mysqli_query($localhost,"CALL proc_tableorder(@temp_orderno,@branchid,@neworderno,@kotnum,@waiter_id,@staff_id)");
				$rs = mysqli_query($localhost, 'SELECT @neworderno AS neworderno,@kotnum AS kotnum' );
				while($row = mysqli_fetch_array($rs))
				{
				$s= $row['neworderno'];
				$kot_id= $row['kotnum'];
				}
				//$_SESSION['order_id']=$s;
				 $returnmsg="";
			 
			}else
			{
			 
				//orderno branchid kotnum message	 
				mysqli_query($localhost,"SET @orderno = " . "'" . mysqli_real_escape_string($localhost, $order) . "'");
				mysqli_query($localhost,"SET @branchid = " . "'" . mysqli_real_escape_string($localhost,$branchid) . "'");
				mysqli_query($localhost,"SET @waiter_id = " . "'".mysqli_real_escape_string($localhost,$s_waiterid)."'");
				mysqli_query($localhost,"SET @staff_id = " . "'".mysqli_real_escape_string($localhost,$s_staffid)."'");
				//$database->mysqlQuery("SET @kotno = " . "'" . mysqli_real_escape_string($database->DatabaseLink,$_SESSION['kot_id']) . "'");
				$kotnum='';
				$message='';
				$result=mysqli_query($localhost,"CALL proc_tableorder_update(@orderno,@branchid,@kotnum,@message,@waiter_id,@staff_id)");
				$rs = mysqli_query($localhost,'SELECT @kotnum AS kotnum,@message AS message' );
				while($row = mysqli_fetch_array($rs))
				{
				//$_SESSION['order_id']= $row['neworderno'];
				$kot_id= $row['kotnum'];
				$s= $order;
				}
				//$_SESSION['order_id']=$s;
				 $returnmsg="";
			 
				
			}


$update_access="update tbl_tabledetails set ts_in_access='N' where ts_orderno='".$s."'";
                 mysqli_query($localhost,$update_access);



	$printerstatus = "";  
		$kotstatus = "";  
		$consolidated = "";
	$sql1 = mysqli_query($localhost,"select be_printall,be_kotstatuschange,be_consolidated_print from tbl_branchmaster where be_branchid='".$branchid."'");
	if (mysqli_num_rows($sql1) > 0) 
	{
		while ($row = mysqli_fetch_array($sql1)) 
		{
			$printerstatus = $row['be_printall'];
			$kotstatus = $row['be_kotstatuschange'];
			$consolidated = $row['be_consolidated_print'];
		}
	}
	
		  if($sql1)
		  {
			   $response["success"] = 1;
			   $response["orderid"] = $s;
			   $response["message"] = "Updated";
			   $response["consolidated"] = $consolidated ;
			   $response["printerstatus"] = $printerstatus;
			   $response["kotnumber"] = $kot_id;
			  echo json_encode($response);
		  }else
		  {
			  $response["success"] = 2;
			 $response["message"] = "Kot not printed, please print it from POS";
			  echo json_encode($response);
		 }
	}else
		  {
			  $response["success"] = 3;
			  $response["message"] = "Order already placed";
			  echo json_encode($response);
		 }
	
} 




else if($check == 'update_status')
{
	$order	= $_GET['ordernum'];
	$branchid = $_GET['branchid'];
	$s_waiterid = $_GET['waiter_id'];
	$s_staffid = $_GET['staff_id'];
	
	$status = '';
	$s='';
	$kot_id='';
	$result='';
	
	
	$sql = "SELECT * FROM tbl_tableorder WHERE ter_orderno= '".$order."'  and  `ter_status` = 'Added'  and  `ter_cancel` = 'N'";
	
	$result = mysqli_query($localhost,$sql);
		if (mysqli_num_rows($result) > 0) 
		{
			if (strpos($order, 'TEMP') !== false)	
			{ 
				mysqli_query($localhost,"SET @temp_orderno = " . "'" . mysqli_real_escape_string($localhost, $order) . "'");
				mysqli_query($localhost,"SET @branchid = " . "'" . mysqli_real_escape_string($localhost,$branchid) . "'");
				mysqli_query($localhost,"SET @waiter_id = " . "'".mysqli_real_escape_string($localhost,$s_waiterid)."'");
				mysqli_query($localhost,"SET @staff_id = " . "'".mysqli_real_escape_string($localhost,$s_staffid)."'");
				$neworderno='';
				$kotnum='';
				$result=mysqli_query($localhost,"CALL proc_tableorder(@temp_orderno,@branchid,@neworderno,@kotnum,@waiter_id,@staff_id)");
				$rs = mysqli_query($localhost, 'SELECT @neworderno AS neworderno,@kotnum AS kotnum' );
				while($row = mysqli_fetch_array($rs))
				{
				$s= $row['neworderno'];
				$kot_id= $row['kotnum'];
				}
				//$_SESSION['order_id']=$s;
				 $returnmsg="";
			 
			}else
			{
			 
				//orderno branchid kotnum message	 
				mysqli_query($localhost,"SET @orderno = " . "'" . mysqli_real_escape_string($localhost, $order) . "'");
				mysqli_query($localhost,"SET @branchid = " . "'" . mysqli_real_escape_string($localhost,$branchid) . "'");
				mysqli_query($localhost,"SET @waiter_id = " . "'".mysqli_real_escape_string($localhost,$s_waiterid)."'");
				mysqli_query($localhost,"SET @staff_id = " . "'".mysqli_real_escape_string($localhost,$s_staffid)."'");
				//$database->mysqlQuery("SET @kotno = " . "'" . mysqli_real_escape_string($database->DatabaseLink,$_SESSION['kot_id']) . "'");
				$kotnum='';
				$message='';
				$result=mysqli_query($localhost,"CALL proc_tableorder_update(@orderno,@branchid,@kotnum,@message,@waiter_id,@staff_id)");
				$rs = mysqli_query($localhost,'SELECT @kotnum AS kotnum,@message AS message' );
				while($row = mysqli_fetch_array($rs))
				{
				//$_SESSION['order_id']= $row['neworderno'];
				$kot_id= $row['kotnum'];
				$s= $order;
				}
				//$_SESSION['order_id']=$s;
				 $returnmsg="";
			 
				
			}

$update_access="update tbl_tabledetails set ts_in_access='N' where ts_orderno='".$s."'";
                 mysqli_query($localhost,$update_access);


	$printerstatus = "";  
		$kotstatus = "";  
		$consolidated = "";
	$sql1 = mysqli_query($localhost,"select be_printall,be_kotstatuschange,be_consolidated_print from tbl_branchmaster where be_branchid='".$branchid."'");
	if (mysqli_num_rows($sql1) > 0) 
	{
		while ($row = mysqli_fetch_array($sql1)) 
		{
			$printerstatus = $row['be_printall'];
			$kotstatus = $row['be_kotstatuschange'];
			$consolidated = $row['be_consolidated_print'];
		}
	}
	
		  if($sql1)
		  {
			   $response["success"] = 1;
			   $response["orderid"] = $s;
			   $response["message"] = "Updated";
			   $response["consolidated"] = $consolidated ;
			   $response["printerstatus"] = $printerstatus;
			   $response["kotnumber"] = $kot_id;
			  echo json_encode($response);
		  }else
		  {
			  $response["success"] = 2;
			 $response["message"] = "Kot not printed, please print it from POS";
			  echo json_encode($response);
		 }
	}else
		  {
			  $response["success"] = 3;
			  $response["message"] = "Order already placed";
			  echo json_encode($response);
		 }
	
} 


/*elseif ($check == "check_printer_value") {

	
	$branchid = $_GET['branchid'];

	$response["success"]=0;
	$sql1 = mysqli_query($localhost,"SELECT be_android_kotprint,be_android_kot_consolidated FROM tbl_branchmaster where be_branchid='".$branchid."'");
	if (mysqli_num_rows($sql1) > 0) 
	{
		//while ($row = mysqli_fetch_array($sql1)) 
		//{
			$response["be_android_kotprint"] = $row['be_android_kotprint'];
			$response["be_android_kot_consolidated"] = $row['be_android_kot_consolidated'];
			$response["success"]=1;
		//}
	}
	else{

		$response["success"]=0;
	}

	json_encode($response);
	
}*/


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





else if($check == "printkot")
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
						  if($result_pt['pt_typename']=="KOT Print")
						  {
							  $kotprint_tp=$result_pt['pt_id'];
						  }
					  }
			  }
					
		$order_id=$ordenum;
		$date=$cur;
		$branchofid=$branchid;
		$printpage=new PrinterCommonSettings();
		$prtck=$printpage->print_kot($kot_id,$order_id,$date,$kotprint_tp,$branchofid,"android");
		
		if($prtck>=1)
		  {
			$response["result"] = 1;
			$response["rsltmsg"] = "ok";
			 if($status=="N")
			 {
				 $result =mysqli_query($localhost,"update  tbl_tableorder set ter_status='Served' WHERE ter_orderno = '".$ordenum."' and ter_kotno='".$kot_id."'");
			 }
			
			echo json_encode($response);
		  }else
		  {
			$response["result"] = 2;
			$response["rsltmsg"] = "no";
			echo json_encode($response);
		  }
	}
}

else if($check == "printkot_consolidated")
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
						  if($result_pt['pt_typename']=="Consolidated")
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
		$prtck1=$printpage1->print_kot_consolidated($kot_id,$order_id,$date,$kotprint_tp1,$branchofid,"android");
				// print code common
			  
		if($prtck1>=1)
		  {
			$response["result"] = 1;
			$response["rsltmsg"] = "ok";
			 if($status=="N")
			 {
				 $result =mysqli_query($localhost,"update  tbl_tableorder set ter_status='Served' WHERE ter_orderno = '".$ordenum."' and ter_kotno='".$kot_id."'");
			 }
			
			echo json_encode($response);
		  }else
		  {
			$response["result"] = 2;
			$response["rsltmsg"] = "no";
			echo json_encode($response);
		  }
			
		
	}

}


else if ($check=="feedback") 
{

	$branch_id = $_GET['branch_id'];
	
	$qry_feedback="SELECT fbm_id,fbm_question FROM tbl_feedbackmaster WHERE fbm_active='Y' and fbm_branchid='".$branch_id."'";

	
	$result_feedback=mysqli_query($localhost,$qry_feedback);

	if (mysqli_num_rows($result_feedback) > 0) {
    // looping through all results
    // products node
	    $response["feedback_master"] = array();
		
	    while ($row = mysqli_fetch_array($result_feedback)) {
	        // temp user array
	        $submenu = array();
	        $submenu["fbm_id"] = $row["fbm_id"];	
	        $submenu["fbm_question"] = $row["fbm_question"];	
	        array_push($response["feedback_master"], $submenu);
	    }

	    $response["Message"] = "Y";
	    $response["Success"] = 0;
	    // echoing JSON response
	    echo json_encode($response);
	}
	else
	{
		$response["Message"] = "N";
	    $response["Success"] = 1;
	    // echoing JSON response
	    echo json_encode($response);
	}

}


else if ($check=="insertrating") 

{

	$qstid = $_GET['qstid'];
	$rate = $_GET['rate'];
	$tableid = $_GET['tableid'];
	$orderid = $_GET['orderid'];
$soderid="";
	$qry_oderid="SELECT *  FROM tbl_feedbackrating WHERE fbr_orderid='$orderid' and fbr_fbm_id='$qstid';";
	
	$result_oderid=mysqli_query($localhost,$qry_oderid);
	$row_soderid=mysqli_fetch_assoc($result_oderid);
	$soderid=$row_soderid['fbr_orderid'];
	
	//echo $qry_oderid;
	if ($soderid) 
	{

	
		echo json_encode(['Success'=>1,'Message'=>"Already Rated",'Oderid'=>"$soderid"]);
		
	}

	else
	{


		$qry_rate="INSERT into tbl_feedbackrating (fbr_fbm_id,fbr_rate,fbr_table,fbr_orderid) values('$qstid','$rate','$tableid','$orderid');";
		
		mysqli_query($localhost,$qry_rate);
			
			
			$response["Message"] = "Rating Inserted";
			$response["Success"] = 0;
	    	echo json_encode($response);
		
	}


}


else if($check == "printbill")
{

	
	$tbl_notificationtype = $_GET['tbl_notificationtype'];
	$tbl_tableid = $_GET['tbl_tableid'];
	$tbl_message = $_GET['tbl_message'];
	$response["Success"] = 0;
	$response["Message"] = "notification_insertion failed";
	$qry_bill="INSERT into tbl_notifications (tbl_notificationtype,tbl_tableid,tbl_message) values('$tbl_notificationtype','$tbl_tableid','$tbl_message');";
	$result_bill=mysqli_query($localhost,$qry_bill);
	if ($result_bill) {
			$response["Message"] = "inserted into tbl_notification";
			$response["Success"] = 1;
	}
	else{
			$response["Message"] = "insertion failed";
			$response["Success"] = 0;
	}
			
	    	echo json_encode($response);
}

else if ($check == "currency") {
	$query_currency = mysqli_query($localhost,"select cr.c_short_code,cr.c_status,cr.c_name,be_base_currency,b.be_decimal from tbl_branchmaster b left join tbl_currency_master cr on cr.c_id=b.be_base_currency");
	if(mysqli_num_rows($query_currency)>0)
	{
		// $response["currency"]=array();
		while ($row = mysqli_fetch_array($query_currency)) 
		{
			$response["c_short_code"]=$row["c_short_code"];
			$response["c_name"]=$row["c_name"];
			$response["be_decimal"]=$row["be_decimal"];
			
		}
		$response["success"]=1;
	}
	else{
		$response["success"]=0;
	}

	echo json_encode($response);

}

else if ($check == "stock_updation") {
	$s_menuid = $_GET['menuid'];
	$s_date = $_GET['date'];
	$s_portion = $_GET['portionid'];
	$sql = "SELECT * FROM tbl_menustock WHERE mk_menuid = '".$s_menuid."'  AND mk_date = '".$s_date."' and mk_portion='".$s_portion."'";
	$result = mysqli_query($localhost,$sql);
	$response["success"] = 0;
	if(mysqli_num_rows($result)>0)
	{
		 while ($row = mysqli_fetch_array($result)) 
		 {
			 $value = $row["mk_stock"];
			 if($value=='Y')
			 {
				$response["success"] = 1;
				$response["value"] = $value; 		
			 }
 		 }
 	}
 	echo json_encode($response);
 	
}





else if($check=="check_for_update")
{
	$machineid = $_GET['machineid'];
	
	
	$sql = "SELECT `as_em_update_found` FROM `tbl_appmachinedetails` WHERE `as_appmachineid`='".$machineid."'";
	$result = mysqli_query($localhost,$sql);
	
	if(mysqli_num_rows($result) > 0)
	{
		while ($row = mysqli_fetch_array($result)) 
		{
        	$s= $row["as_em_update_found"];	
    	}
		
		$sql1 = "select `cm_ip_address` from `tbl_expodine_machines` where `cm_is_server`='Y'";
		$result1 = mysqli_query($localhost,$sql1);

		$ip="";
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

//**** Emenu4.0.3**:)


else if($check == 'new_insertdb')
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
	
	$unit_id = 0;
	$base_unit_id = 0;
	$rate_type = "Portion";
	$unit_type = NULL;
	$unit_weight = 0;
	
	$cur=date("Y-m-d");	
					
	$sql = "SELECT * FROM tbl_menustock WHERE mk_menuid = '".$s_menuid."'  AND mk_date = '".$s_date."' and mk_portion='".$s_portion."'";	
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
}



else if($check == 'delete_tabel')
{
	$order	= $_GET['ordernum'];
	$sql = "DELETE FROM `tbl_tabledetails` WHERE `ts_orderno`='".$order."' and (ts_interface= 'E' OR ts_interface= 'A')";
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



	
?>