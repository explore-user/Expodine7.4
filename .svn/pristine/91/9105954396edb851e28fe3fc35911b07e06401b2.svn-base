<?php
session_start();

include('database.class.php'); // DB Connection class
$database	= new Database();
$con=mysqli_connect(HOST_NAME, USER_NAME, PASSWORD,DATABASE_NAME);

	/* **************************** Bill print*******************************  */
	$printer_kotip_bill=array();
	$printer_kotport_bill=array(); 
	$bill_ok=0;
	$bill_sorry=1;
	$sql_kots="Select pr_printerip,pr_printerport From tbl_printersettings  Where pr_branchid ='".$_SESSION['branchofid']."' and pr_printertype='Bill Print'";
	$sql_kotss  =  mysqli_query($con,$sql_kots); 
	$num_kots  = mysqli_num_rows($sql_kotss);
	if($num_kots)
	{	
	while($result_kots  = mysqli_fetch_array($sql_kotss)) 
			{
				$printer_kotip_bill[]=$result_kots['pr_printerip'];
				$printer_kotport_bill[]=$result_kots['pr_printerport'];
			}
			foreach ($printer_kotport_bill as $key=>$port)
			{
				  $connection_check = @fsockopen($printer_kotip_bill[$key], $port);
				  if (is_resource($connection_check))
				  {
					  //echo "ok";
					  $bill_ok++;
					  fclose($connection_check);
				  }
				  else
				  {
					 // echo "sorry";
					  $bill_sorry++;
				  }
			}
			if($bill_sorry>1)
			{
				$_SESSION['billprint_on']="no";
			}else
			{
				$_SESSION['billprint_on']="yes";
			}
	}else
	{
		$_SESSION['billprint_on']="no printer";
	}
	
	//echo "kot";
	/* **************************** Kot print*******************************  */	
	$printer_kotip_kot=array();
	$printer_kotport_kot=array();
	$kot_ok=0;
	$kot_sorry=1;
	$sql_kots="Select tbl_kotcountermaster.kr_kotcode,tbl_printersettings.pr_printerip, tbl_printersettings.pr_printerport,tbl_kotcountermaster.kr_kotname From tbl_kotcountermaster Inner Join tbl_printersettings On tbl_kotcountermaster.kr_printerid = tbl_printersettings.pr_id And tbl_printersettings.pr_branchid = tbl_kotcountermaster.kr_branchid Where tbl_kotcountermaster.kr_branchid ='".$_SESSION['branchofid']."' and tbl_printersettings.pr_printertype='KOT Print'";
	$sql_kotss  =  mysqli_query($con,$sql_kots); 
	$num_kots  = mysqli_num_rows($sql_kotss);
	if($num_kots)
	{	
	while($result_kots  = mysqli_fetch_array($sql_kotss)) 
			{
				$printer_kotip_kot[]=$result_kots['pr_printerip'];
				$printer_kotport_kot[]=$result_kots['pr_printerport'];
			}
			foreach ($printer_kotport_kot as $key=>$port)
			{
				  $connection_check = @fsockopen($printer_kotip_kot[$key], $port);
				  if (is_resource($connection_check))
				  {
					  //echo "ok";
					  $kot_ok++;
					  fclose($connection_check);
				  }
				  else
				  {
					  $kot_sorry++;
					  //echo "sorry";
				  }
			}
			if($kot_sorry>1)
			  {
				  $_SESSION['kotprint_on']="no";
			  }else
			  {
				  $_SESSION['kotprint_on']="yes";
			  }
	}else
	{
		$_SESSION['kotprint_on']="no printer";
	}

  
	echo "Bill-".$_SESSION['billprint_on']."<br>";
	echo "kot-".$_SESSION['kotprint_on'];
 ?>