<?php

include("appdbconnection.php"); // DB Connection class




$check = $_GET['check_value']; 
if($check=="config")
{
	//$branchid = $_GET['branchid'];
	
	$query_exec = mysqli_query($localhost,"select be_appstring,be_branchid from tbl_branchmaster");

if (mysqli_num_rows($query_exec) > 0) {
    // looping through all results
    // products node
   // $response["configdetails"] = array();
    $submenu="";
	$app_astring = "";
    while ($row = mysqli_fetch_array($query_exec)) {
        // temp user array
       // $submenu = array();
      
		$submenu = $row["be_appstring"]."/src";
		$branchid = $row["be_branchid"];
		$app_astring = $row["be_appstring"];
        // push single product into final response array
       // array_push($response["configdetails"], $submenu);
    }
    // success
    $response["success"] = 1;
	$response["appstring_applink"] = $submenu;
	$response["appstring"] = $app_astring;
	$response["be_branchid"] = $branchid;
	$response["message"] = "found";
    // echoing JSON response
    echo json_encode($response);
} else {
    // no products found
    $response["success"] = 0;
	$response["appstring"] =0;
    $response["message"] = "No products found";

    // echo no users JSON
    echo json_encode($response);
}
}





?>