
<?php

include("appdbconnection.php"); // DB Connection class
require_once("Escpos.php");
error_reporting(0);

$check = $_GET['check_value']; 
date_default_timezone_set("Asia/Kolkata");

if($check == "status_update")
{
	$macid = $_GET['mac_id'];
	
	$result = mysqli_query($localhost,"UPDATE tbl_appmachinedetails SET as_appmachiesych='N' WHERE as_appmachineid = '".$macid."'");
	
	$response["success"] = 1;
 	$response["message"] = "found";
    // echoing JSON response
    echo json_encode($response);
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

else if($check == "country")
{
	$result = mysqli_query($localhost,"SELECT * FROM tbl_country where cy_conversionrate>0");
//and tr_tableid NOT IN(select ts_tableid from tbl_tabledetails)
//$result = mysqli_num_rows($getFloor);

 if (mysqli_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["country"] = array();
    
    while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $table = array();
        $table["c_id"] = $row["cy_countyid"];
		$table["c_name"] = $row["cy_countryname"];
		$table["c_nation"] = $row["cy_nationality"];
		$table["c_code"] = $row["cy_currencycode"];
		$table["c_convert"] = $row["cy_conversionrate"];
		$table["c_flag"] = $row["cy_flagimage"];
		
        
     
        // push single product into final response array
        array_push($response["country"], $table);
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

else if($check == "floor")
{
	$result = mysqli_query($localhost,"SELECT * FROM tbl_floormaster where fr_status='Active'");
//and tr_tableid NOT IN(select ts_tableid from tbl_tabledetails)
//$result = mysqli_num_rows($getFloor);

 if (mysqli_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["floor"] = array();
    
    while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $table = array();
        $table["f_id"] = $row["fr_floorid"];
		$table["f_brid"] = $row["fr_branchid"];
		$table["f_name"] = $row["fr_floorname"];
		$table["f_status"] = $row["fr_status"];
		
        
     
        // push single product into final response array
        array_push($response["floor"], $table);
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

else if($check == "menucombi")
{
	$result = mysqli_query($localhost,"SELECT * FROM tbl_menucombination");
//and tr_tableid NOT IN(select ts_tableid from tbl_tabledetails)
//$result = mysqli_num_rows($getFloor);

 if (mysqli_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["menucombination"] = array();
    
    while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $table = array();
        $table["menu_id"] = $row["mn_menuid"];
		$table["menu_combiid"] = $row["mn_menucombid"];
	   
        // push single product into final response array
        array_push($response["menucombination"], $table);
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

else if($check == "menuimages")
{
	$result = mysqli_query($localhost,"SELECT * FROM tbl_menuimages");
//and tr_tableid NOT IN(select ts_tableid from tbl_tabledetails)
//$result = mysqli_num_rows($getFloor);

 if (mysqli_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["m_images"] = array();
    
    while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $table = array();
        $table["image_name"] = $row["mes_imagename"];
		$table["image_id"] = $row["mes_menuid"];
		
        // push single product into final response array
        array_push($response["m_images"], $table);
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

else if($check == "menuingredient")
{
	$result = mysqli_query($localhost,"SELECT * FROM tbl_menuingredients");
//and tr_tableid NOT IN(select ts_tableid from tbl_tabledetails)
//$result = mysqli_num_rows($getFloor);

 if (mysqli_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["menu_ingredient"] = array();
    
    while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $table = array();
        $table["mm_id"] = $row["ms_menuid"];
		$table["m_i_id"] = $row["ms_ingridentid"];
		
        // push single product into final response array
        array_push($response["menu_ingredient"], $table);
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

else if($check == "menumaincat")
{
	$result = mysqli_query($localhost,"SELECT * FROM tbl_menumaincategory");
//and tr_tableid NOT IN(select ts_tableid from tbl_tabledetails)
//$result = mysqli_num_rows($getFloor);

 if (mysqli_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["maincate"] = array();
    
    while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $table = array();
        $table["mm_id"] = $row["mmy_maincategoryid"];
		$table["mm_cate"] = $row["mmy_maincategoryname"];
		$table["mm_act"] = $row["mmy_active"];
		$table["mm_hdoof"] = $row["mmy_headofficeid"];
		$table["mm_disp"] = $row["mmy_displayorder"];
        $table["mm_image"] = $row["mmy_imagename"];
        $table["mm_print"] = $row["mmy_orderof_print"];
     
        // push single product into final response array
        array_push($response["maincate"], $table);
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

else if($check == "menumaster")
{
	$result = mysqli_query($localhost,"SELECT * FROM tbl_menumaster");
//and tr_tableid NOT IN(select ts_tableid from tbl_tabledetails)
//$result = mysqli_num_rows($getFloor);

 if (mysqli_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["menumaster"] = array();
    
    while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $table = array();
        $table["m_menuid"] = $row["mr_menuid"];
		$table["m_menuname"] = $row["mr_menuname"];
		$table["m_maincatid"] = $row["mr_maincatid"];
		$table["m_subcatid"] = $row["mr_subcatid"];
		$table["m_description"] = $row["mr_description"];
		
		$table["m_diet"] = $row["mr_diet"];
		$table["m_time_min"] = $row["mr_time_min"];
		$table["m_active"] = $row["mr_active"];
		$table["m_kotcounter"] = $row["mr_kotcounter"];
		$table["m_modifieddate"] = $row["mr_modifieddate"];
		
		$table["m_modifieduser"] = $row["mr_modifieduser"];
		$table["m_rating"] = $row["mr_rating"];
		$table["m_prepmode"] = $row["mr_prepmode"];
		$table["m_headofficeid"] = $row["mr_headofficeid"];
		$table["m_branchadd"] = $row["mr_branchadd"];
		$table["m_branchid"] = $row["mr_branchid"];
		$table["m_manualrateentry"] = $row["mr_manualrateentry"];
		$table["m_itemcode"] = $row["mr_itemcode"];
		$table["m_dailystock"] = $row["mr_dailystock"];
		$table["m_dailystock_in_number"] = $row["mr_dailystock_in_number"];
		$table["m_rate_type"] = $row["mr_rate_type"];
		$table["m_unit_type"] = $row["mr_unit_type"];
        $table["m_base_unit"] = $row["mr_base_unit"];
		$table["m_itemshortcode"] = $row["mr_itemshortcode"];
		
	  
        // push single product into final response array
        array_push($response["menumaster"], $table);
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

else if($check == "menunutrition")
{
	$result = mysqli_query($localhost,"SELECT * FROM tbl_menunutitionfacts");
//and tr_tableid NOT IN(select ts_tableid from tbl_tabledetails)
//$result = mysqli_num_rows($getFloor);

 if (mysqli_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["nutrition"] = array();
    
    while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $table = array();
        $table["me_id"] = $row["mnf_menuid"];
		$table["me_nutri"] = $row["mnf_nutrition"];
		$table["me_val"] = $row["mnf_value"];
		
        // push single product into final response array
        array_push($response["nutrition"], $table);
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

else if($check == "ing_master")
{
	$result = mysqli_query($localhost,"SELECT * FROM tbl_ingredientmaster");
//and tr_tableid NOT IN(select ts_tableid from tbl_tabledetails)
//$result = mysqli_num_rows($getFloor);

 if (mysqli_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["ingmaster"] = array();
    
    while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $table = array();
        $table["i_ingredientid"] = $row["ir_ingredientid"];
		$table["i_ingredientname"] = $row["ir_ingredientname"];
		$table["i_headofficeid"] = $row["ir_headofficeid"];
		
        // push single product into final response array
        array_push($response["ingmaster"], $table);
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

else if($check == "menuprefmaster")
{
	$result = mysqli_query($localhost,"SELECT * FROM tbl_menuprefmaster");
//and tr_tableid NOT IN(select ts_tableid from tbl_tabledetails)
//$result = mysqli_num_rows($getFloor);

 if (mysqli_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["menu_pref_master"] = array();
    
    while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $table = array();
        $table["mpr_id"] = $row["mpr_menuid"];
		$table["mpr_name"] = $row["mpr_prefeernce"];
		
        // push single product into final response array
        array_push($response["menu_pref_master"], $table);
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


else if($check == "menurate")
{
	$result = mysqli_query($localhost,"SELECT * FROM tbl_menuratemaster");
//and tr_tableid NOT IN(select ts_tableid from tbl_tabledetails)
//$result = mysqli_num_rows($getFloor);

 if (mysqli_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["rate"] = array();
    
    while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $table = array();
        $table["r_id"] = $row["mmr_menuid"];
		$table["r_floor"] = $row["mmr_floorid"];
		$table["r_por"] = $row["mmr_portion"];
		$table["r_rate"] = $row["mmr_rate"];
		$table["r_default"] = $row["mmr_default"];
		$table["r_rate_type"] = $row["mmr_rate_type"];
		$table["r_unit_type"] = $row["mmr_unit_type"];
		$table["r_unit_weight"] = $row["mmr_unit_weight"];
		$table["r_unit_id"] = $row["mmr_unit_id"];
		$table["r_base_unit_id"] = $row["mmr_base_unit_id"];

        // push single product into final response array
        array_push($response["rate"], $table);
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

else if($check == "menutakerate")
{
	$result = mysqli_query($localhost,"SELECT * FROM tbl_menuratetakeaway");
//and tr_tableid NOT IN(select ts_tableid from tbl_tabledetails)
//$result = mysqli_num_rows($getFloor);

 if (mysqli_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["take_rate"] = array();
    
    while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $table = array();
        $table["t_menuid"] = $row["mta_menuid"];
		$table["t_portion"] = $row["mta_portion"];
		$table["t_brid"] = $row["mta_branchid"];
		$table["t_rate"] = $row["mta_rate"];
	

        // push single product into final response array
        array_push($response["take_rate"], $table);
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
else if($check== 'getDate')
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



else if($check == "menusubcate")
{
	$result = mysqli_query($localhost,"SELECT * FROM tbl_menusubcategory");
//and tr_tableid NOT IN(select ts_tableid from tbl_tabledetails)
//$result = mysqli_num_rows($getFloor);

 if (mysqli_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["menu_sub"] = array();
    
    while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $table = array();
        $table["m_sub"] = $row["msy_subcategoryid"];
		$table["m_hd"] = $row["msy_headofficeid"];
		$table["m_subcat"] = $row["msy_subcategoryname"];
		$table["m_active"] = $row["msy_active"];

        // push single product into final response array
        array_push($response["menu_sub"], $table);
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

else if($check == "menuportion")
{
	$result = mysqli_query($localhost,"SELECT * FROM tbl_portionmaster");
//and tr_tableid NOT IN(select ts_tableid from tbl_tabledetails)
//$result = mysqli_num_rows($getFloor);

 if (mysqli_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["mportion"] = array();
    
    while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $table = array();
        $table["p_id"] = $row["pm_id"];
		$table["p_name"] = $row["pm_portionname"];
		$table["p_porrate"] = $row["pm_portionshortcode"];
		$table["p_ratio"] = $row["pm_ratio"];
		
        // push single product into final response array
        array_push($response["mportion"], $table);
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

else if($check == "menupref")
{
	$result = mysqli_query($localhost,"SELECT * FROM tbl_preferencemaster");
//and tr_tableid NOT IN(select ts_tableid from tbl_tabledetails)
//$result = mysqli_num_rows($getFloor);

 if (mysqli_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["menupreference"] = array();
    
    while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $table = array();
        $table["p_id"] = $row["pmr_id"];
		$table["p_name"] = $row["pmr_name"];
		
        // push single product into final response array
        array_push($response["menupreference"], $table);
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

else if($check == "stock_HAM")
{
	$result = mysqli_query($localhost,"SELECT * FROM `tbl_menustock`");
//and tr_tableid NOT IN(select ts_tableid from tbl_tabledetails)
//$result = mysqli_num_rows($getFloor);

 if (mysqli_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["menustock"] = array();
    
    while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $table = array();
        $table["m_id"] = $row["mk_menuid"];
		$table["m_date"] = $row["mk_date"];
		$table["m_floor_sstock"] = $row["mk_stock"];
	   
        // push single product into final response array
        array_push($response["menustock"], $table);
    }
    // success
    $response["success"] = 1;
 	$response["message"] = "ok";
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

else if($check=='stock')
{
	$todaydate = $_GET['date'];
	
	
	$result = mysqli_query($localhost,"SELECT * FROM tbl_menustock where mk_date = '".$todaydate."'");
//and tr_tableid NOT IN(select ts_tableid from tbl_tabledetails)
//$result = mysqli_num_rows($getFloor);

 if (mysqli_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["menustock"] = array();
    
    while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $table = array();
        $table["m_id"] = $row["mk_menuid"];
		$table["m_date"] = $row["mk_date"];
		$table["m_stock"] = $row["mk_stock"];
		
        // push single product into final response array
        array_push($response["menustock"], $table);
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
else if($check=='rating_item')
{
	$result = mysqli_query($localhost,"select * from tbl_feedbackratingcount");
	if(mysqli_num_rows($result) > 0)
	{
		$response["ratingarray"] = array();
		
		while ($row = mysqli_fetch_array($result)) {
			// temp user array
			$table = array();
			$table["f_menuid"] = $row["frc_menuid"];
			$table["f_1star"] = $row["frc_1star"];
			$table["f_2star"] = $row["frc_2star"];
			$table["f_3star"] = $row["frc_3star"];
			$table["f_4star"] = $row["frc_4star"];
			$table["f_5star"] = $row["frc_5star"];
			
			// push single product into final response array
			array_push($response["ratingarray"], $table);
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

else if($check=='tablemster')
{
	$result = mysqli_query($localhost,"select * from tbl_tablemaster");
	if(mysqli_num_rows($result) > 0)
	{
		$response["masterarray"] = array();
		
		while ($row = mysqli_fetch_array($result)) {
			// temp user array
			$table = array();
			$table["r_tableid"] = $row["tr_tableid"];
			$table["r_branchid"] = $row["tr_branchid"];
			$table["r_floorid"] = $row["tr_floorid"];
			$table["r_tableno"] = $row["tr_tableno"];
			$table["r_status"] = $row["tr_status"];
			$table["r_maxchaircount"] = $row["tr_maxchaircount"];
			$table["r_vaccantcount"] = $row["tr_vaccantcount"];
			$table["r_nextprefix_ascii"] = $row["tr_nextprefix_ascii"];
			
			// push single product into final response array
			array_push($response["masterarray"], $table);
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

else if($check=='tabledetails')
{
	$result = mysqli_query($localhost,"select * from tbl_tabledetails");
	if(mysqli_num_rows($result) > 0)
	{
		$response["tablearray"] = array();
		
		while ($row = mysqli_fetch_array($result)) {
			// temp user array
			$table = array();
			$table["s_tableid"] = $row["ts_tableid"];
			$table["s_tableidprefix"] = $row["ts_tableidprefix"];
			$table["s_status"] = $row["ts_status"];
			$table["s_dineintime"] = $row["ts_dineintime"];
			$table["s_noofpersons"] = $row["ts_noofpersons"];
			$table["s_orderno"] = $row["ts_orderno"];
			$table["s_floorid"] = $row["ts_floorid"];
			$table["s_orderstaff"] = $row["ts_orderstaff"];
			
			// push single product into final response array
			array_push($response["tablearray"], $table);
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

else if($check=='staffmaster')
{
	$result = mysqli_query($localhost,"select * from tbl_staffmaster");
	if(mysqli_num_rows($result) > 0)
	{
		$response["staffarray"] = array();
		
		while ($row = mysqli_fetch_array($result)) {
			// temp user array
			$table = array();
			$table["er_staffid"] = $row["ser_staffid"];
			$table["er_firstname"] = $row["ser_firstname"];
			$table["er_lastname"] = $row["ser_lastname"];
			$table["er_gender"] = $row["ser_gender"];
			$table["er_designation"] = $row["ser_designation"];
			$table["er_department"] = $row["ser_department"];
			$table["er_dob"] = $row["ser_dob"];
			$table["er_address1"] = $row["ser_address1"];
			
			$table["er_address2"] = $row["ser_address2"];
			$table["er_city"] = $row["ser_city"];
			$table["er_state"] = $row["ser_state"];
			$table["er_country"] = $row["ser_country"];
			$table["er_dateofjoin"] = $row["ser_dateofjoin"];
			$table["er_mobileno"] = $row["ser_mobileno"];
			$table["er_alternateno"] = $row["ser_alternateno"];
			$table["er_nationality"] = $row["ser_nationality"];
			
			$table["er_email"] = $row["ser_email"];
			$table["er_employeestatus"] = $row["ser_employeestatus"];
			$table["er_remarks"] = $row["ser_remarks"];
			$table["er_idtype"] = $row["ser_idtype"];
			$table["er_idno"] = $row["ser_idno"];
			$table["er_headofficeid"] = $row["ser_headofficeid"];
			$table["er_branchofficeid"] = $row["ser_branchofficeid"];
			$table["er_branchstaff"] = $row["ser_branchstaff"];
			
			// push single product into final response array
			array_push($response["staffarray"], $table);
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


else if($check == 'insertwith')
{
	
					$s_ordernum = $_GET['s_ordernum1'];
					$s_branch = $_GET['s_branch1'];
					$s_menuid = $_GET['s_menuid1'];
					$s_portion = $_GET['s_portion1'];
					$s_rate = $_GET['s_rate1'];
					$s_quantity = $_GET['s_quantity1'];
					$s_status = $_GET['s_status1'];
					$s_preferencedrp = $_GET['s_preferencedrp1'];
					$s_preftext = $_GET['s_preftext1'];
					$s_orderfrom = $_GET['s_orderfrom1'];
					$s_entryuser = $_GET['s_entryuser1'];
					$s_esttime = $_GET['s_esttime1'];
					$s_staff = $_GET['s_staff1'];
					$s_type = $_GET['s_type1'];
					$s_slnum = $_GET['s_slnumber'];
					$s_date = $_GET['s_date'];
					$s_floor = $_GET['s_floor'];
					$cur=date("Y-m-d");	
					
	$sql = "SELECT * FROM tbl_menustock WHERE mk_menuid = '".$s_menuid."' AND mk_stock='Y' AND mk_date = '".$s_date."'";	
	$result = mysqli_query($localhost,$sql);
	if(mysqli_num_rows($result)>0)
	{$result1='';

	//`tbl_tabledetails`(`ts_tableid`, `ts_tableidprefix`, `ts_status`, `ts_dineintime`, `ts_noofpersons`, `ts_orderno`)
	//$result1 = mysqli_query($localhost,"INSERT INTO tbl_tableorder(ter_orderno, ter_branchid, ter_menuid, ter_portion, ter_rate, ter_qty, ter_status, ter_preference, ter_preferencetext, ter_orderfrom, ter_entryuser, ter_esttime, ter_staff, ter_type) VALUES ('".$s_ordernum."','".$s_branch."','".$s_menuid."','".$s_portion."','".$s_rate."','".$s_quantity."','".$s_status."','".$s_preferencedrp."','".$s_preftext."','".$s_orderfrom."','".$s_entryuser."','".$s_esttime."','".$s_staff."','".$s_type."')");
	if($s_preftext=="")
	{
		$s_preftext=NULL;
	}
	if($s_preferencedrp=="")
	{
		$s_preferencedrp=NULL;
	}
	try {
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
		  
		$result1=mysqli_query($localhost,"CALL proc_tableordernentry(@temporderno,@branchid,@menuid,@portion,@qty,@status,@orderfrom,@entryuser,@est_time,@staff,@type,@floorid,@manual_rate,@preferenceid,@preferencetext,@addon_slno,@messsage)") or $this->throw_ex(mysqli_error($localhost));
		$rs = mysqli_query($localhost, 'SELECT @messsage AS messsage' );
		while($row = mysqli_fetch_array($rs))
		{
		$s= $row['messsage'];
		}
	 } catch (Exception $e) {
		  $returnmsg= 'Caught exception: '.  $e;
		  $file = 'log.txt';
		  $content = date("l F d-m-Y h:i:s A")." ".$returnmsg.PHP_EOL;
		  file_put_contents($file, $content, FILE_APPEND | LOCK_EX);
		   exit();
	  }	
	
	
	
	if($result1)
	{
		 $response["success"] = 1;
		 $response["message"] = "inserted";
		 
		 
    	echo json_encode($response);
	}else
	{
		$response["success"] = 0;
		$response["message"] = "failed";
		
    	echo json_encode($response);
	}
	
	} else {
			// no products found
			$response["success"] = 0;
			$response["message"] = "No Stock";
			$response["serial"] = $s_slnum;
			echo json_encode($response);
				
		}			
}

else if($check == 'insertout')
{
	
					$s_ordernum = $_GET['s_ordernum1'];
					$s_branch = $_GET['s_branch1'];
					$s_menuid = $_GET['s_menuid1'];
					$s_portion = $_GET['s_portion1'];
					$s_rate = $_GET['s_rate1'];
					$s_quantity = $_GET['s_quantity1'];
					$s_status = $_GET['s_status1'];
					$s_preftext = $_GET['s_preftext1'];
					$s_orderfrom = $_GET['s_orderfrom1'];
					$s_entryuser = $_GET['s_entryuser1'];
					$s_esttime = $_GET['s_esttime1'];
					$s_staff = $_GET['s_staff1'];
					$s_type = $_GET['s_type1'];
					$s_slnum = $_GET['s_slnumber'];
					$s_date = $_GET['s_date'];
					$s_floor = $_GET['s_floor'];
				$cur=date("Y-m-d");	
	$result1 ='';				
	$sql = "SELECT * FROM tbl_menustock WHERE mk_menuid = '".$s_menuid."' AND mk_stock='Y' AND mk_date = '".$s_date."'";	
	$result = mysqli_query($localhost,$sql);
	if(mysqli_num_rows($result)>0)
	{$result1 ='';
    	/*while ($row = mysqli_fetch_array($result)) 
		{*/
        	//$value = $row["mk_stock"];
			
			/*if($value=="Y")
			{*/
				//`tbl_tabledetails`(`ts_tableid`, `ts_tableidprefix`, `ts_status`, `ts_dineintime`, `ts_noofpersons`, `ts_orderno`)
	//$result1 = mysqli_query($localhost,"INSERT INTO tbl_tableorder(ter_orderno, ter_branchid, ter_menuid, ter_portion, ter_rate, ter_qty, ter_status, ter_preferencetext, ter_orderfrom, ter_entryuser, ter_esttime, ter_staff, ter_type) VALUES ('".$s_ordernum."','".$s_branch."','".$s_menuid."','".$s_portion."','".$s_rate."','".$s_quantity."','".$s_status."','".$s_preftext."','".$s_orderfrom."','".$s_entryuser."','".$s_esttime."','".$s_staff."','".$s_type."')");
	
	if($s_preftext=="")
	{
		$s_preftext=NULL;
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
		  mysqli_query($localhost,"SET @preferenceid = " . "'0'");
		  mysqli_query($localhost,"SET @preferencetext = " . "'".$s_preftext."'");
          mysqli_query($localhost,"SET @addon_slno= " . "''");
		
		$messsage='';
		  
		$result1=mysqli_query($localhost,"CALL proc_tableordernentry(@temporderno,@branchid,@menuid,@portion,@qty,@status,@orderfrom,@entryuser,@est_time,@staff,@type,@floorid,@manual_rate,@preferenceid,@preferencetext,@addon_slno,@messsage)") ;
		$rs = mysqli_query($localhost, 'SELECT @messsage AS messsage' );
		while($row = mysqli_fetch_array($rs))
		{
		$s= $row['messsage'];
		}
	  
				if($result1)
				{
					 $response["success"] = 1;
					 $response["message"] = "inserted";
					 
					echo json_encode($response);
				}else
				{
					$response["success"] = 0;
					$response["message"] = "failed";
					
					echo json_encode($response);
				}
			/*}
			else
			{
				$response["success"] = 3;
				$response["message"] = "No Stock";
				// echoing JSON response
				echo json_encode($response);
			}*/
	   	//}
  	  
		} else {
			// no products found
			$response["success"] = 0;
			$response["message"] = "No Stock";
			$response["serial"] = $s_slnum;
			echo json_encode($response);
				
		}				
}



else if($check == 'update_status')
{
	//&ordernum=TEMP*413438371&serial=1,2&branchid=1
	$order	= $_GET['ordernum'];
	//$sl = $_GET['serial'];
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
				
				 $returnmsg="";




			

           $sql_staff = "UPDATE tbl_tabledetails SET ts_orderstaff='" . $s_staffid . "' where ts_orderno='" . $s. "'";
             mysqli_query($localhost,$sql_staff);
			 
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
		//echo $kot_id.",".$order_id.",".$date.",".$kotprint_tp.",".$branchofid;
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
else if($check == "printkot_ta")
{echo'1';
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
    
    date_default_timezone_set("Asia/Kolkata");
    require_once("printer_functions.php");
    $printpage=new PrinterCommonSettings();
	
   
            
    $prtck=$printpage->print_kot_ta($kot_id,$billno,$date,$kotprint_tp,$branchofid,"android");
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


else if($check == "stockcheck")
{
	 $macid = $_GET['mac_id'];
	//echo  "SELECT mk_menuid,mk_stock FROM tbl_menustock m, tbl_appmachinedetails a where a.as_appmachineid = '".$macid."' and m.mk_stocktime > a.as_lastupdated";
	$sql = mysqli_query($localhost, "SELECT mk_menuid,mk_stock FROM tbl_menustock m, tbl_appmachinedetails a where a.as_appmachineid = '".$macid."' and m.mk_stocktime > a.as_lastupdated");
	
	if (mysqli_num_rows($sql) > 0) 
	{
		$response["stock"] = array();
    
		while ($row = mysqli_fetch_array($sql)) {
			// temp user array
			$table = array();
			$table["menuid"] = $row["mk_menuid"];
			$table["stock"] = $row["mk_stock"];
		  
			array_push($response["stock"], $table);
		}
		
		 $sqlq = "UPDATE tbl_appmachinedetails SET as_lastupdated= '".date("Y-m-d H:i:s")."' WHERE as_appmachineid = '".$macid."'";
		mysqli_query($localhost, $sqlq);
		// success
		$response["success"] = 1;
		$response["message"] = "yes";
		// echoing JSON response
		echo json_encode($response);	
	}
	else
	{
		 $response["success"] = 0;
		$response["message"] = "no";
		echo json_encode($response);
	}
}

else if($check == "menustockcheck")
{
	$menuid = $_GET['menuid'];
	
	$sql = "SELECT mk_stock FROM tbl_menustock WHERE mk_menuid = '".$menuid."'";
	$result = mysqli_query($localhost,$sql);
	if(mysqli_num_rows($result)>0)
	{
	
    while ($row = mysqli_fetch_array($result)) {
        $response["message"] = $row["mk_stock"];
    }
  // success
   
    $response["success"] = 1;

    // echoing JSON response
    echo json_encode($response);
} else {
    // no products found
    $response["success"] = 0;
    $response["message"] = "N";

    // echo no users JSON
    echo json_encode($response);
		
}
	
}

else if($check== 'checkkotstaus')
{
	$branchid = $_GET['branchid'];
	$result = mysqli_query($localhost,"SELECT be_kotstatuschange FROM `tbl_branchmaster` WHERE be_branchid = '".$branchid."'");
	if (mysqli_num_rows($result) > 0) 
	{
		 while ($row = mysqli_fetch_array($result)) {
			 $response["success"] = 0;
			 $response["message"] = $row["be_kotstatuschange"];
			echo json_encode($response);
		 }
	}else
	{
		$response["success"] = 1;
		$response["message"] = "W";
		echo json_encode($response);
	}
}


else if($check== 'setmac')
{
	$macid = $_GET['macid'];
	
	$sql=  "select * from tbl_appmachinedetails where as_appmachineid='".$macid."'";
	$result = mysqli_query($localhost,$sql);
	if (mysqli_num_rows($result) > 0) 
	{
		 $s1 = "update tbl_appmachinedetails set as_appmachiesych='Y' where as_appmachineid='".$macid."'";
		 $result = mysqli_query($localhost,$s1);
	}else
	{
		$s2 = "insert into tbl_appmachinedetails (as_appmachineid) values('".$macid."')";
		$result = mysqli_query($localhost,$s2);
	}
		$response["success"] = 1;
		$response["message"] = "ok";
		echo json_encode($response);
	
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

else if($check == "menucounterrate")
{

	$result = mysqli_query($localhost,"SELECT * FROM tbl_menurate_counter");
	
	
	 if (mysqli_num_rows($result) > 0) {
		// looping through all results
		// products node
		$response["counter_rate"] = array();
		
		while ($row = mysqli_fetch_array($result)) {
			// temp user array
			$table = array();
			$table["mr_menuid"] = $row["mrc_menuid"];
			$table["mr_portion"] = $row["mrc_portion"];
			$table["mr_brid"] = $row["mrc_branchid"];
            $table["mr_rate"] = $row["mrc_rate"];

            $table["mrc_rate_type"] = $row["mrc_rate_type"];
            $table["mrc_unit_type"] = $row["mrc_unit_type"];
            $table["mrc_unit_weight"] = $row["mrc_unit_weight"];$table["mrc_unit_id"] = $row["mrc_unit_id"];
			$table["mrc_base_unit_id"] = $row["mrc_base_unit_id"];
		
			array_push($response["counter_rate"], $table);
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

else if($check == "menu_takeaway_rate")
{
		$partener_id = $_GET['id'];

		$result = mysqli_query($localhost,"SELECT * FROM  tbl_menuratetakeaway where mta_food_partner='".$partener_id."'");

		// $result = "SELECT * FROM  tbl_menuratetakeaway";
	 if (mysqli_num_rows($result) > 0) {
		// looping through all results
		// products node

		$response["counter_takeaway"] = array();
		
		while ($row = mysqli_fetch_array($result)) {
			// temp user array

			$table = array();
			$table["mr_menuid"] = $row["mta_menuid"];
			$table["mr_portion"] = $row["mta_portion"];
			$table["mr_brid"] = $row["mta_branchid"];
            $table["mr_rate"] = $row["mta_rate"];
            $table["mr_food_partner"] = $row["mta_food_partner"];

            $table["mta_rate_type"] = $row["mta_rate_type"];
            $table["mta_unit_type"] = $row["mta_unit_type"];
            $table["mta_unit_weight"] = $row["mta_unit_weight"];
			$table["mta_unit_id"] = $row["mta_unit_id"];
			$table["mta_base_unit_id"] = $row["mta_base_unit_id"];
			
			array_push($response["counter_takeaway"], $table);
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

else if($check == "get_online_partner")
{
		$result = mysqli_query($localhost,"SELECT * FROM  tbl_online_order");

	
	 if (mysqli_num_rows($result) > 0) {
		// looping through all results
		// products node

		$response["online_partner"] = array();
		
		while ($row = mysqli_fetch_array($result)) {
			// temp user array

			$table = array();
			$table["id"] = $row["tol_id"];
			$table["name"] = $row["tol_name"];
            $table["status"] = $row["tol_status"];
            $table["img_url"] = $row["tol_logo_url"];

			
			array_push($response["online_partner"], $table);
		}
		// success
		$response["success"] = 1;
		$response["message"] = "found";
		// echoing JSON response
		echo json_encode($response);
	} else {
		// no partner found
		$response["success"] = 0;
		$response["message"] = "No partner found";
	
		// echo no users JSON
		echo json_encode($response);
	}

}
else if($check == "set_online_partner")

{
			$id = $_GET['id'];
		$result = mysqli_query($localhost,"UPDATE tbl_online_order SET tol_status= '".Y."' WHERE tol_id = '".$id."'");
				$result = mysqli_query($localhost,"UPDATE tbl_online_order SET tol_status= '".N."' WHERE tol_id != '".$id."'");

 if ($result) {
		 
		$response["success"] = 0;
		$response["message"] = "found";
		// echoing JSON response
		echo json_encode($response);
	} else {
		// no products found
		$response["success"] = 1;
		$response["message"] = "No partner found";
		 echo json_encode($response);
	}

}


//****** version 4.0.2

else if($check == "unit_master")
{
	$result = mysqli_query($localhost,"SELECT * FROM tbl_unit_master");


 if (mysqli_num_rows($result) > 0) {
    // looping through all results
   
    $response["unit_master"] = array();
    
    while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $table = array();
        $table["u_id"] = $row["u_id"];
		$table["u_name"] = $row["u_name"];
		

        // push single product into final response array
        array_push($response["unit_master"], $table);
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


else if($check == "base_unit_master")
{
	$result = mysqli_query($localhost,"SELECT * FROM tbl_base_unit_master");


 if (mysqli_num_rows($result) > 0) {
    // looping through all results
   
    $response["base_unit_master"] = array();
    
    while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $table = array();
        $table["bu_id"] = $row["bu_id"];
		$table["bu_name"] = $row["bu_name"];
		

        // push single product into final response array
        array_push($response["base_unit_master"], $table);
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




else if($check=="checkforupdate")
{
	$macid = $_GET['macid'];
	$branchid = $_GET['branchid'];
	
	$getsynch = "select * from tbl_appmachinedetails where as_appmachineid='".$macid."' and as_status='Active'";
	$result = mysqli_query($localhost,$getsynch);
	if(mysqli_num_rows($result)>0)
	{
		while($row = mysqli_fetch_array($result))
		{
			$response["as_sync_floormaster"] = $row["as_sync_floormaster"];
			$response["as_sync_kotcounter"] = $row["as_sync_kotcounter"];
			$response["as_sync_prefemaster"] = $row["as_sync_prefemaster"];
			$response["as_sync_menumaincat"] = $row["as_sync_menumaincat"];
			$response["as_sync_menusubcat"] = $row["as_sync_menusubcat"];
			$response["as_sync_portionmas"] = $row["as_sync_portionmas"];
			$response["as_sync_menumaster"] = $row["as_sync_menumaster"];
			$response["as_sync_menuprefemaster"] = $row["as_sync_menuprefemaster"];
			$response["as_sync_menuratemaster"] = $row["as_sync_menuratemaster"];
			$response["as_sync_counterrate"] = $row["as_sync_counterrate"];
			$response["as_sync_menustock"] = $row["as_sync_menustock"];
			$response["as_sync_menuimage"] = $row["as_sync_menuimage"];
			
			$response["success"] = 1;
			$response["message"] = "No products found";
			echo json_encode($response);
			
		}	
	}
	else
	{
		$response["success"] = 0;
		$response["message"] = "No products found";
		echo json_encode($response);	
	}

}



else if($check == "floor_synch")
{
	$result = mysqli_query($localhost,"SELECT * FROM tbl_floormaster where fr_status='Active' and fr_android_sync='Y'");
//and tr_tableid NOT IN(select ts_tableid from tbl_tabledetails)
//$result = mysqli_num_rows($getFloor);

 if (mysqli_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["floor"] = array();
    
    while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $table = array();
        $table["f_id"] = $row["fr_floorid"];
		$table["f_brid"] = $row["fr_branchid"];
		$table["f_name"] = $row["fr_floorname"];
		$table["f_status"] = $row["fr_status"];
		
        
     
        // push single product into final response array
        array_push($response["floor"], $table);
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

else if($check == "kot_counter_details_synch")
{
	$branchid = $_GET['branchid'];
	
	$sql = "select * from tbl_kotcountermaster where kr_branchid = '".$branchid."' and kr_android_sync='Y'";
	
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

else if($check == "menuprefmaster_synch")
{
	$result = mysqli_query($localhost,"SELECT * FROM tbl_menuprefmaster where mpr_android_sync='Y'");
//and tr_tableid NOT IN(select ts_tableid from tbl_tabledetails)
//$result = mysqli_num_rows($getFloor);

 if (mysqli_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["menu_pref_master"] = array();
    
    while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $table = array();
        $table["mpr_id"] = $row["mpr_menuid"];
		$table["mpr_name"] = $row["mpr_prefeernce"];
		
        // push single product into final response array
        array_push($response["menu_pref_master"], $table);
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

else if($check == "menumaincat_synch")
{
	$result = mysqli_query($localhost,"SELECT * FROM tbl_menumaincategory where mmy_android_sync = 'Y'");
//and tr_tableid NOT IN(select ts_tableid from tbl_tabledetails)
//$result = mysqli_num_rows($getFloor);

 if (mysqli_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["maincate"] = array();
    
    while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $table = array();
        $table["mm_id"] = $row["mmy_maincategoryid"];
		$table["mm_cate"] = $row["mmy_maincategoryname"];
		$table["mm_act"] = $row["mmy_active"];
		$table["mm_hdoof"] = $row["mmy_headofficeid"];
		$table["mm_disp"] = $row["mmy_displayorder"];
        $table["mm_image"] = $row["mmy_imagename"];
        $table["mm_print"] = $row["mmy_orderof_print"];
        
     
        // push single product into final response array
        array_push($response["maincate"], $table);
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

else if($check == "menusubcate_synch")
{
	$result = mysqli_query($localhost,"SELECT * FROM tbl_menusubcategory where msy_android_sync = 'Y'");
//and tr_tableid NOT IN(select ts_tableid from tbl_tabledetails)
//$result = mysqli_num_rows($getFloor);

 if (mysqli_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["menu_sub"] = array();
    
    while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $table = array();
        $table["m_sub"] = $row["msy_subcategoryid"];
		$table["m_hd"] = $row["msy_headofficeid"];
		$table["m_subcat"] = $row["msy_subcategoryname"];
		$table["m_active"] = $row["msy_active"];

        // push single product into final response array
        array_push($response["menu_sub"], $table);
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

else if($check == "menuportion_synch")
{
	$result = mysqli_query($localhost,"SELECT * FROM tbl_portionmaster where pm_android_sync='Y'");
//and tr_tableid NOT IN(select ts_tableid from tbl_tabledetails)
//$result = mysqli_num_rows($getFloor);

 if (mysqli_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["mportion"] = array();
    
    while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $table = array();
        $table["p_id"] = $row["pm_id"];
		$table["p_name"] = $row["pm_portionname"];
		$table["p_porrate"] = $row["pm_portionshortcode"];
		$table["p_ratio"] = $row["pm_ratio"];
		
        // push single product into final response array
        array_push($response["mportion"], $table);
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

else if($check == "menumaster_synch")
{
	$result = mysqli_query($localhost,"SELECT * FROM tbl_menumaster where mr_android_sync='Y'");
//and tr_tableid NOT IN(select ts_tableid from tbl_tabledetails)
//$result = mysqli_num_rows($getFloor);

 if (mysqli_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["menumaster"] = array();
    
    while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $table = array();
        $table["m_menuid"] = $row["mr_menuid"];
		$table["m_menuname"] = $row["mr_menuname"];
		$table["m_maincatid"] = $row["mr_maincatid"];
		$table["m_subcatid"] = $row["mr_subcatid"];
		$table["m_description"] = $row["mr_description"];
		
		$table["m_diet"] = $row["mr_diet"];
		$table["m_time_min"] = $row["mr_time_min"];
		$table["m_active"] = $row["mr_active"];
		$table["m_kotcounter"] = $row["mr_kotcounter"];
		$table["m_modifieddate"] = $row["mr_modifieddate"];
		
		$table["m_modifieduser"] = $row["mr_modifieduser"];
		$table["m_rating"] = $row["mr_rating"];
		$table["m_prepmode"] = $row["mr_prepmode"];
		$table["m_headofficeid"] = $row["mr_headofficeid"];
		$table["m_branchadd"] = $row["mr_branchadd"];
		$table["m_branchid"] = $row["mr_branchid"];
		$table["m_manualrateentry"] = $row["mr_manualrateentry"];
		$table["m_itemcode"] = $row["mr_itemcode"];
		$table["m_dailystock"] = $row["mr_dailystock"];
		$table["m_dailystock_in_number"] = $row["mr_dailystock_in_number"];
		$table["m_rate_type"] = $row["mr_rate_type"];
		$table["m_unit_type"] = $row["mr_unit_type"];
		$table["m_base_unit"] = $row["mr_base_unit"];
		
		
	  
        // push single product into final response array
        array_push($response["menumaster"], $table);
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

else if($check == "menupref_synch")
{
	$result = mysqli_query($localhost,"SELECT * FROM tbl_preferencemaster where pmr_android_sync='Y'");
//and tr_tableid NOT IN(select ts_tableid from tbl_tabledetails)
//$result = mysqli_num_rows($getFloor);

 if (mysqli_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["menupreference"] = array();
    
    while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $table = array();
        $table["p_id"] = $row["pmr_id"];
		$table["p_name"] = $row["pmr_name"];
		
        // push single product into final response array
        array_push($response["menupreference"], $table);
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

else if($check == "menurate_synch")
{
	$result = mysqli_query($localhost,"SELECT * FROM tbl_menuratemaster where mmr_android_sync='Y'");
//and tr_tableid NOT IN(select ts_tableid from tbl_tabledetails)
//$result = mysqli_num_rows($getFloor);

 if (mysqli_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["rate"] = array();
    
    while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $table = array();
        $table["r_id"] = $row["mmr_menuid"];
		$table["r_floor"] = $row["mmr_floorid"];
		$table["r_por"] = $row["mmr_portion"];
		$table["r_rate"] = $row["mmr_rate"];
		$table["r_default"] = $row["mmr_default"];
		
		$table["r_rate_type"] = $row["mmr_rate_type"];
		$table["r_unit_type"] = $row["mmr_unit_type"];
		$table["r_unit_weight"] = $row["mmr_unit_weight"];
		$table["r_unit_id"] = $row["mmr_unit_id"];
		$table["r_base_unit_id"] = $row["mmr_base_unit_id"];

        // push single product into final response array
        array_push($response["rate"], $table);
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

else if($check == "menucounterrate_synch")
{
	$result = mysqli_query($localhost,"SELECT * FROM tbl_menurate_counter where mrc_android_sync='Y'");
	
	 if (mysqli_num_rows($result) > 0) {
		// looping through all results
		// products node
		$response["counter_rate"] = array();
		
		while ($row = mysqli_fetch_array($result)) {
			// temp user array
			$table = array();
			$table["mr_menuid"] = $row["mrc_menuid"];
			$table["mr_portion"] = $row["mrc_portion"];
			$table["mr_brid"] = $row["mrc_branchid"];
			$table["mr_rate"] = $row["mrc_rate"];

            $table["mrc_rate_type"] = $row["mrc_rate_type"];
            $table["mrc_unit_type"] = $row["mrc_unit_type"];
            $table["mrc_unit_weight"] = $row["mrc_unit_weight"];
            $table["mrc_unit_id"] = $row["mrc_unit_id"];
            $table["mrc_base_unit_id"] = $row["mrc_base_unit_id"];
		
			array_push($response["counter_rate"], $table);
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

else if($check=='stock_synch')
{
	$todaydate = $_GET['date'];
	
	
	$result = mysqli_query($localhost,"SELECT * FROM tbl_menustock where mk_date = '".$todaydate."' and mk_android_sync='Y'");
//and tr_tableid NOT IN(select ts_tableid from tbl_tabledetails)
//$result = mysqli_num_rows($getFloor);

 if (mysqli_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["menustock"] = array();
    
    while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $table = array();
        $table["m_id"] = $row["mk_menuid"];
		$table["m_date"] = $row["mk_date"];
		$table["m_stock"] = $row["mk_stock"];
		
        // push single product into final response array
        array_push($response["menustock"], $table);
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


else if($check == "floor_synch_update")
{
	$table = $_GET['table'];
	$field = $_GET['field'];
	$macid = $_GET['macid'];
    
    $up_sql = "update $table set $field ='N',as_lastupdated=NOW() WHERE as_appmachineid = '".$macid."'";
	
	$result = mysqli_query($localhost,$up_sql);

	 if ($result) {
		 
		mysqli_query($localhost,"CALL proc_app_machine_details()");
		 
		$response["success"] = 1;
		$response["message"] = "found";
		// echoing JSON response
		echo json_encode($response);
	} else {
		// no products found
		$response["success"] = 0;
		$response["message"] = "No products found";
		 echo json_encode($response);
	}


}

else if($check == "synch_update_date")
{
	
	$macid = $_GET['macid'];
    
    $up_sql = "UPDATE tbl_appmachinedetails SET as_lastupdated= '".date("Y-m-d H:i:s")."' WHERE as_appmachineid = '".$macid."'";
	
	
	$result = mysqli_query($localhost,$up_sql);

	 if ($result) {
		 
		mysqli_query($localhost,"CALL proc_app_machine_details()");
		 
		$response["success"] = 1;
		$response["message"] = "found";
		// echoing JSON response
		echo json_encode($response);
	} else {
		// no products found
		$response["success"] = 0;
		$response["message"] = "No products found";
		 echo json_encode($response);
	}
}


/////:))))))))Most Selling Items


else if($check == "most_selling")
{
	 
    $sql = "SELECT distinct tbd.tab_menuid 
FROM tbl_takeaway_billdetails tbd
LEFT  join tbl_takeaway_billmaster tbm on tbm.tab_billno = tbd.tab_billno
where tbm.tab_mode = 'CS'
ORDER BY tab_qty DESC LIMIT 10";

	
	$result = mysqli_query($localhost,$sql);

	 if ($result) {
	 	$response["success"] = 1;
	


   		$response["most_selling"] = array();
	 

	 	while ($row = mysqli_fetch_array($result)) {
		$table = array();
        $table["tab_menuid"] = $row["tab_menuid"];
        array_push($response["most_selling"], $row["tab_menuid"]);

	 	}
		 
		
		
	
	}
	 else {
	
		$response["success"] = 0;
		//$response["message"] = "No products found";
		
	}

echo json_encode($response);
}




else if($check == "menuimage_synch")
{
	$qry_img="SELECT *  FROM tbl_menuimages WHERE mes_android_sync='Y'";
	$result_img=mysqli_query($localhost,$qry_img);
					
		if (mysqli_num_rows($result_img)>0) 
			{
				$response["menuimage_update"] = array();
				while ($row = mysqli_fetch_array($result_img)) 
				{
					 $imgs = array();
					 $imgs["mes_imagename"] = $row["mes_imagename"];
					 $imgs["mes_imagethumb"] = $row["mes_imagethumb"];
					 $imgs["mes_menuid"] = $row["mes_menuid"];
					 $imgs["mes_android_sync"] = $row["mes_android_sync"];
					 array_push($response["menuimage_update"], $imgs);
									
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



//k




?>