<?php
include("appdbconnection.php");
date_default_timezone_set("Asia/Kolkata");


$check=$_GET['check_value'];

if ($check=="combo_names") 
{

	$sql="select * from tbl_combo_name where cn_active='Y'";
	$result=mysqli_query($localhost,$sql);

	if (mysqli_num_rows($result)>0) 
	{

		$response["combos"]=array();

		while ( $row= mysqli_fetch_array($result)) 
		{

			$subarray = array();
			$subarray["cn_id"] = $row["cn_id"];
			$subarray["cn_name"] = $row["cn_name"];
			$subarray["cn_type"] = $row["cn_type"];
			$subarray["cn_stock_check"] = $row["cn_stock_check"];

			array_push($response["combos"], $subarray);

	
		}
		$response["success"] = 1;
        
	}else{
		$response["success"] = 0;
	}
	echo json_encode($response);

}

else if ($check=="combo_packs") 
{

	$sql="select * from tbl_combo_packs where cp_pack_active='Y'";
	$result=mysqli_query($localhost,$sql);

	if (mysqli_num_rows($result)>0) 
	{

		$response["combo_packs"]=array();
		while ( $row= mysqli_fetch_array($result)) 
		{

			$subarray = array();
			$subarray["cp_id"] = $row["cp_id"];
			$subarray["cp_pack_name"] = $row["cp_pack_name"];
			$subarray["cp_combo"] = $row["cp_combo"];
			$subarray["cp_pack_qty"] = $row["cp_pack_qty"];

			array_push($response["combo_packs"], $subarray);

	
		}
		$response["success"] = 1;
        


	}
	else{
		$response["success"] = 0;
	}
	echo json_encode($response);

}
else if ($check=="tbl_combo_pack_menus") 
{


$sql="select * from tbl_combo_pack_menus";
	$result=mysqli_query($localhost,$sql);

	if (mysqli_num_rows($result)>0) 
	{

		$response["combo_pack_menus"]=array();
		while ( $row= mysqli_fetch_array($result)) 
		{

			$subarray = array();
			$subarray["cpm_id"] = $row["cpm_id"];
			$subarray["cpm_menu_id"] = $row["cpm_menu_id"];
			$subarray["cpm_combo_pack_id"] = $row["cpm_combo_pack_id"];
			$subarray["cpm_combo_id"] = $row["cpm_combo_id"];
			$subarray["cpm_menu_sale_type"] = $row["cpm_menu_sale_type"];
			$subarray["cpm_menu_type_label_id"] = $row["cpm_menu_type_label_id"];
			$subarray["cpm_menu_qty"] = $row["cpm_menu_qty"];
			$subarray["cpm_menu_active"] = $row["cpm_menu_active"];



			array_push($response["combo_pack_menus"], $subarray);

	
		}
		$response["success"] = 1;

	}
	else{
		$response["success"] = 0;
	}
	echo json_encode($response);

}


else if ($check=="tbl_combo_pack_rates") 
{


$sql="select * from tbl_combo_pack_rates";
	$result=mysqli_query($localhost,$sql);

	if (mysqli_num_rows($result)>0) 
	{

		$response["tbl_combo_pack_rates"]=array();
		while ( $row= mysqli_fetch_array($result)) 
		{

			$subarray = array();
			$subarray["cpr_id"] = $row["cpr_id"];
			$subarray["cpr_combo_pack_id"] = $row["cpr_combo_pack_id"];
			$subarray["cpr_combo_id"] = $row["cpr_combo_id"];
			$subarray["cpr_floor_id"] = $row["cpr_floor_id"];
			$subarray["cpr_mode"] = $row["cpr_mode"];
			$subarray["cpr_rate"] = $row["cpr_rate"];
		


			array_push($response["tbl_combo_pack_rates"], $subarray);

	
		}
		$response["success"] = 1;
        


	}
	else{
		$response["success"] = 0;
	}
	echo json_encode($response);



}

else if ($check=="tbl_combo_menu_labels") 
{


$sql="select * from tbl_combo_menu_labels where cml_active='Y'";
	$result=mysqli_query($localhost,$sql);

	if (mysqli_num_rows($result)>0) 
	{

		$response["tbl_combo_menu_labels"]=array();
		while ( $row= mysqli_fetch_array($result)) 
		{

			$subarray = array();
			$subarray["cml_id"] = $row["cml_id"];
			$subarray["cml_label"] = $row["cml_label"];
			array_push($response["tbl_combo_menu_labels"], $subarray);

	
		}
		$response["success"] = 1;
        


	}
	else{
		$response["success"] = 0;
	}
	echo json_encode($response);



}





?>
