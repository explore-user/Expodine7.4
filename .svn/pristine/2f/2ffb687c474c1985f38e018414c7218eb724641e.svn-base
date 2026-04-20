<?php
include("appdbconnection.php"); // DB Connection class
require_once("Escpos.php"); 
date_default_timezone_set("Asia/Kolkata");


$check = $_GET['check_value']; 

if($check == "menumaincategory")
{

	$qry_sync="SELECT *  FROM tbl_menumaincategory WHERE mmy_active='Y'";
	$result_sync=mysqli_query($localhost,$qry_sync);
			
			
	if (mysqli_num_rows($result_sync)>0) {
				
				$response["menumaincategory"] = array();
				 
				
		while ($row = mysqli_fetch_array($result_sync)) 
		{
        
		    $submenu = array();
			$submenu["mmy_id"] = $row["mmy_maincategoryid"];	
			$submenu["main_category_name"] = $row["mmy_maincategoryname"];	
            $submenu["mmy_active"] = $row["mmy_active"];	
            $submenu["mmy_branchid"] = $row["mmy_branchid"];	
            $submenu["mmy_displayorder"] = $row["mmy_displayorder"];	
            $submenu["mmy_imagename"] = $row["mmy_imagename"];	
            $submenu["mmy_orderofprint"] = $row["mmy_orderof_print"];	
            $submenu["mmy_androidsync"] = $row["mmy_android_sync"];	
            array_push($response["menumaincategory"], $submenu);
			
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
else if($check == "menusubcategory")
{
	$qry_sub="SELECT *  FROM tbl_menusubcategory WHERE msy_active='Y'";
	$result_sub=mysqli_query($localhost,$qry_sub);
	if (mysqli_num_rows($result_sub)>0) {
				
				$response["menusubcategory"] = array();
				 
				
		while ($row = mysqli_fetch_array($result_sub)) 
		{
			 $submenu = array();
			 $submenu["msy_id"] = $row["msy_subcategoryid"];
			 $submenu["msy_branchid"] = $row["msy_branchid"];
			 $submenu["msy_subcategoryname"] = $row["msy_subcategoryname"];
			 $submenu["msy_active"] = $row["msy_active"];
			 $submenu["msy_android_sync"] = $row["msy_android_sync"];
			
			array_push($response["menusubcategory"], $submenu);
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
else if($check=="menumaster")
	{

	$qry_master="SELECT *  FROM tbl_menumaster WHERE mr_active='Y'";
	$result_master=mysqli_query($localhost,$qry_master);
			
			
	if (mysqli_num_rows($result_master)>0) {
				
				$response["menumaster"] = array();
				 
				
		while ($row = mysqli_fetch_array($result_master)) 
		{
        
		    $submenu = array();
			$submenu["mr_id"] = $row["mr_menuid"];
			$submenu["mr_menuname"] = $row["mr_menuname"];
			$submenu["mr_maincatid"] = $row["mr_maincatid"];
			$submenu["mr_subcatid"] = $row["mr_subcatid"];
			$submenu["mr_description"] = $row["mr_description"];
			$submenu["mr_diet"] = $row["mr_diet"];
			$submenu["mr_time_min"] = $row["mr_time_min"];
			$submenu["mr_active"] = $row["mr_active"];
			$submenu["mr_kotcounter"] = $row["mr_kotcounter"];
			$submenu["mr_modifieddate"] = $row["mr_modifieddate"];
			$submenu["mr_modifieduser"] = $row["mr_modifieduser"];
			$submenu["mr_rating"] = $row["mr_rating"];
			$submenu["mr_prepmode"] = $row["mr_prepmode"];
			$submenu["mr_branchid"] = $row["mr_branchid"];
			$submenu["mr_itemshortcode"] = $row["mr_itemshortcode"];
			$submenu["mr_dailystock"] = $row["mr_dailystock"];
			$submenu["mr_manualrateentry"] = $row["mr_manualrateentry"];
			$submenu["mr_itemcode"] = $row["mr_itemcode"];
			$submenu["mr_dailystock_in_number"] = $row["mr_dailystock_in_number"];
			$submenu["mr_android_sync"] = $row["mr_android_sync"];
			$submenu["mr_show_in_kod"] = $row["mr_show_in_kod"];
			$submenu["mr_excempt_tax"] = $row["mr_excempt_tax"];
			
			  array_push($response["menumaster"], $submenu);
			  
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
else if($check=="kotmaster")
	{

	$qry_kot="SELECT *  FROM tbl_kotmaster";
	$result_kot=mysqli_query($localhost,$qry_kot);
			
			
	if (mysqli_num_rows($result_kot)>0) {
				
				$response["kotmaster"] = array();
				 
				
		while ($row = mysqli_fetch_array($result_kot)) 
		{	
				$submenu = array();
			 $submenu["kr_date"] = $row["kr_date"];
			 $submenu["kr_kotno"] = $row["kr_kotno"];
			 $submenu["kr_print"] = $row["kr_print"];
			 $submenu["kr_firstprint"] = $row["kr_firstprint"];
			 $submenu["kr_lastprint"] = $row["kr_lastprint"];
			 $submenu["kr_time"] = $row["kr_time"];
			 $submenu["kr_mode_of_order"] = $row["kr_mode_of_order"];
			  array_push($response["kotmaster"], $submenu);
			  
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
	else if($check=="portionmaster")
	{

	$qry_portion="SELECT *  FROM tbl_portionmaster";
	$result_portion=mysqli_query($localhost,$qry_portion);
			
			
	if (mysqli_num_rows($result_portion)>0) {
				
				$response["portionmaster"] = array();
				 
				
		while ($row = mysqli_fetch_array($result_portion)) 
		{	
				$submenu = array();
			 $submenu["pm_id"] = $row["pm_id"];
			 $submenu["pm_portionname"] = $row["pm_portionname"];
			 $submenu["pm_portionshortcode"] = $row["pm_portionshortcode"];
			 $submenu["pm_viewinbill"] = $row["pm_viewinbill"];
			 $submenu["pm_viewinkot"] = $row["pm_viewinkot"];
			 $submenu["pm_ratio"] = $row["pm_ratio"];
			 $submenu["pm_android_sync"] = $row["pm_android_sync"];
			 array_push($response["portionmaster"], $submenu);
			  
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
else if($check=="menuratemaster")
	{

	$qry_rate="SELECT *  FROM tbl_menuratemaster";
	$result_rate=mysqli_query($localhost,$qry_rate);
			
			
	if (mysqli_num_rows($result_rate)>0) {
				
				$response["menuratemaster"] = array();
				 
				
		while ($row = mysqli_fetch_array($result_rate)) 
		{	
			$submenu = array();
			 $submenu["mmr_menuid"] = $row["mmr_menuid"];
			 $submenu["mmr_floorid"] = $row["mmr_floorid"];
			 $submenu["mmr_portion"] = $row["mmr_portion"];
			 $submenu["mmr_rate"] = $row["mmr_rate"];
			 $submenu["mmr_default"] = $row["mmr_default"];
			 $submenu["mmr_android_sync"]= $row["mmr_android_sync"];
			  array_push($response["menuratemaster"], $submenu);
			  
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
else if($check=="preferencemaster")
	{

	$qry_preference="SELECT *  FROM tbl_preferencemaster";
	$result_preference=mysqli_query($localhost,$qry_preference);
			
			
	if (mysqli_num_rows($result_preference)>0) {
		
		$response["preferencemaster"] = array();
		while ($row = mysqli_fetch_array($result_preference)) 
		{	
				 $submenu = array();
				  $submenu["pmr_id"] = $row["pmr_id"];
				  $submenu["pmr_name"] = $row["pmr_name"];
				  $submenu["pmr_android_sync"] = $row["pmr_android_sync"];
				 array_push($response["preferencemaster"],$submenu);
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




else if($check=="menuprefmaster")
	{

	$qry_menupreference="SELECT *  FROM tbl_menuprefmaster";
	$result_menupreference=mysqli_query($localhost,$qry_menupreference);
			
			
	if (mysqli_num_rows($result_menupreference)>0) {
		
		$response["menuprefmaster"] = array();
		while ($row = mysqli_fetch_array($result_menupreference)) 
		{	
				 $submenu = array();
				  $submenu["mpr_menuid"] = $row["mpr_menuid"];
				  $submenu["mpr_prefeernce"] = $row["mpr_prefeernce"];
				  $submenu["mpr_android_sync"] = $row["mpr_android_sync"];
				array_push($response["menuprefmaster"],$submenu);
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
			 
	else if($check=="menustock")
	{

	$qry_menustock="SELECT *  FROM tbl_menustock";
	$result_menustock=mysqli_query($localhost,$qry_menustock);
			
			
	if (mysqli_num_rows($result_menustock)>0) {
				
				$response["menustock"] = array();	
		while ($row = mysqli_fetch_array($result_menustock)) 
		{	
			$submenu = array();
			 $submenu["mk_date"] = $row["mk_date"];
			 $submenu["mk_menuid"] = $row["mk_menuid"];
			 $submenu["mk_portion"] = $row["mk_portion"];
			 $submenu["mk_stock"] = $row["mk_stock"];
			 $submenu["mk_stocktime"] = $row["mk_stocktime"];
			 $submenu["mk_stock_number"] = $row["mk_stock_number"];
			$submenu["mk_android_sync"]= $row["mk_android_sync"];
			  array_push($response["menustock"], $submenu);
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


else if($check=="menuimage")
	{

	$qry_menuimage="SELECT *  FROM tbl_menuimages";
	$result_menuimage=mysqli_query($localhost,$qry_menuimage);
			
			
	if (mysqli_num_rows($result_menuimage)>0) {
				
		$response["menuimages"] = array();
		while ($row = mysqli_fetch_array($result_menuimage)) 
		{	
			$submenu = array();
			 $submenu["mes_imagename"] = $row["mes_imagename"];
			 $submenu["mes_imagethumb"] = $row["mes_imagethumb"];
			 $submenu["mes_menuid"] = $row["mes_menuid"];

			 array_push($response["menuimages"],$submenu);
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


else if($check=="menuingredients")
	{

	$qry_ingredients="SELECT *  FROM tbl_menuingredients";
	$result_ingredients=mysqli_query($localhost,$qry_ingredients);
			
			
	if (mysqli_num_rows($result_ingredients)>0) {
		
		$response["menuingredients"] = array();
		while ($row = mysqli_fetch_array($result_ingredients)) 
		{	
			$submenu = array();
			 $submenu["ms_menuid"] = $row["ms_menuid"];
			 $submenu["ms_ingridentid"] = $row["ms_ingridentid"];
				 array_push($response["menuingredients"],$submenu);
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


else if($check=="menucombo")
	{

	$qry_menucombo="SELECT *  FROM tbl_menucombination";
	$result_menucombo=mysqli_query($localhost,$qry_menucombo);
			
		if (mysqli_num_rows($result_menucombo)>0) {
				
			$response["menucombo"] = array();
			while ($row = mysqli_fetch_array($result_menucombo)) 
		{	
			$submenu = array();
			 $submenu["mn_menuid"] = $row["mn_menuid"];
			 $submenu["mn_menucombid"] = $row["mn_menucombid"];
				 array_push($response["menucombo"],$submenu);
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
	

	else if($check=="menunutritionfacts")
	{

	$qry_nutrition="SELECT *  FROM tbl_menunutitionfacts";
	$result_nutrition=mysqli_query($localhost,$qry_nutrition);
			
			
	if (mysqli_num_rows($result_nutrition)>0) {
				
			$response["menunutritionfacts"] = array();
			while ($row = mysqli_fetch_array($result_nutrition)) 
		{	
			$submenu = array();
			 $submenu["mnf_menuid"] = $row["mnf_menuid"];
			 $submenu["mnf_nutrition"] = $row["mnf_nutrition"];
			 $submenu["mnf_value"] = $row["mnf_value"];
			array_push($response["menunutritionfacts"],$submenu);
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



else if($check=="languages")
	{

	$qry_language="SELECT *  FROM tbl_languages";
	$result_language=mysqli_query($localhost,$qry_language);
	if (mysqli_num_rows($result_language)>0) {
			
				$response["languages"] = array();	
		while ($row = mysqli_fetch_array($result_language)) 
		{	
			$submenu = array();
			 $submenu["ls_id"] = $row["ls_id"];
			 $submenu["ls_language"] = $row["ls_language"];
			 $submenu["ls_status"] = $row["ls_status"];
			 $submenu["ls_shortcode"] = $row["ls_shortcode"];
			  array_push($response["languages"],$submenu);
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



else if($check=="languagefeedback")
	{

	$qry_lfeedback="SELECT *  FROM tbl_language_feedback";
	$result_lfeedback=mysqli_query($localhost,$qry_lfeedback);
			
		if (mysqli_num_rows($result_lfeedback)>0) {
				
			$response["languagefeedback"] = array();
		while ($row = mysqli_fetch_array($result_lfeedback)) 
		{	
			$submenu = array();
			 $submenu["fe_lang_id"] = $row["fe_lang_id"];
			 $submenu["fe_feedback_id"] = $row["fe_feedback_id"];
			 $submenu["fe_feedback_name"] = $row["fe_feedback_name"];
				 array_push($response["languagefeedback"],$submenu);
				 
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


else if($check=="languagemenumain")
	{

	$qry_lmain="SELECT *  FROM tbl_language_menu_main";
	$result_lmain=mysqli_query($localhost,$qry_lmain);
			
		if (mysqli_num_rows($result_lmain)>0) {
				
			$response["languagemenumain"] = array();
			while ($row = mysqli_fetch_array($result_lmain)) 
		    {	
				$submenu = array();
				$submenu["mm_lang_id"] = $row["mm_lang_id"];
				$submenu["mm_categoryid"] = $row["mm_categoryid"];
				$submenu["mm_name"] = $row["mm_name"];
				 array_push($response["languagemenumain"],$submenu);
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

else if($check=="languagemenumaster")
	{

	$qry_lmm="SELECT *  FROM tbl_language_menu_master";
	$result_lmm=mysqli_query($localhost,$qry_lmm);
			
		if (mysqli_num_rows($result_lmm)>0) {
				
			$response["languagemenumaster"] = array();
			while ($row = mysqli_fetch_array($result_lmm)) 
		    {	
				$submenu = array();
				$submenu["lm_language_id"] = $row["lm_language_id"];
				$submenu["lm_menu_id"] = $row["lm_menu_id"];
				$submenu["lm_menu_name"] = $row["lm_menu_name"];
				$submenu["lm_menu_print"] = $row["lm_menu_print"];
				$submenu["lm_menu_description"] = $row["lm_menu_description"];
				$submenu["lm_menu_diet"] = $row["lm_menu_diet"];
				$submenu["lm_menu_prepmode"] = $row["lm_menu_prepmode"];
			
				array_push($response["languagemenumaster"],$submenu);
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
		
		
		else if($check=="languagemenusub")
	{

	$qry_lms="SELECT *  FROM tbl_language_menu_sub";
	$result_lms=mysqli_query($localhost,$qry_lms);
			
		if (mysqli_num_rows($result_lms)>0) {
				
			$response["languagemenusub"] = array();
			while ($row = mysqli_fetch_array($result_lms)) 
		    {	
				$submenu = array();
				$submenu["mm_lang_id"] = $row["mm_lang_id"];
				$submenu["mm_subcategory_id"] = $row["mm_sub_category_id"];
				$submenu["mm_name"] = $row["mm_name"];
				 array_push($response["languagemenusub"],$submenu);
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
		


	else if($check=="languageportion")
	{

	$qry_lportion="SELECT *  FROM tbl_language_portion";
	$result_lportion=mysqli_query($localhost,$qry_lportion);
			
		if (mysqli_num_rows($result_lportion)>0) {
				
			$response["languageportion"] = array();
				while ($row = mysqli_fetch_array($result_lportion)) 
		    {	
				$submenu = array();
				$submenu["lm_language_id"] = $row["lm_language_id"];
				$submenu["lm_portion_id"] = $row["lm_portion_id"];
				$submenu["lm_portion_name"] = $row["lm_portion_name"];
				 array_push($response["languageportion"],$submenu);
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


else if($check=="languagepreference")
	{

	$qry_lprefer="SELECT *  FROM tbl_language_preference";
	$result_lprefer=mysqli_query($localhost,$qry_lprefer);
			
		if (mysqli_num_rows($result_lprefer)>0) {
				
			$response["languagepreference"] = array();
			while ($row = mysqli_fetch_array($result_lprefer)) 
		    {	
				$submenu = array();
				$submenu["l_lang_id"] = $row["l_lang_id"];
				$submenu["l_pref_id"] = $row["l_pref_id"];
				$submenu["l_pref_name"] = $row["l_pref_name"];
				array_push($response["languagepreference"],$submenu);
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


else if($check=="ingredientmaster")
	{

	$qry_imaster="SELECT *  FROM tbl_ingredientmaster";
	$result_imaster=mysqli_query($localhost,$qry_imaster);
			
		if (mysqli_num_rows($result_imaster)>0) {
				
			$response["ingredientmaster"] = array();
			while ($row = mysqli_fetch_array($result_imaster)) 
		    {	
				$submenu = array();
				$submenu["ir_ingredientid"] = $row["ir_ingredientid"];
				$submenu["ir_ingredientname"] = $row["ir_ingredientname"];
				$submenu["ir_headofficeid"] = $row["ir_headofficeid"];
				array_push($response["ingredientmaster"],$submenu);
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


else if($check == "discountmaster")
{

	$qry_sync="SELECT *  FROM tbl_discountmaster WHERE ds_status='Active'";
	$result_sync=mysqli_query($localhost,$qry_sync);
			
			
	if (mysqli_num_rows($result_sync)>0) {
				
				$response["discountmaster"] = array();
				 
				
		while ($row = mysqli_fetch_array($result_sync)) 
		{
        
		    $submenu = array();
			$submenu["ds_discountid"] = $row["ds_discountid"];	
			$submenu["ds_discountname"] = $row["ds_discountname"];	
            $submenu["ds_item_discount"] = $row["ds_item_discount"];	
            $submenu["ds_branchid"] = $row["ds_branchid"];	
            $submenu["ds_status"] = $row["ds_status"];	
            $submenu["ds_discountof"] = $row["ds_discountof"];	
            $submenu["ds_mode"] = $row["ds_mode"];	
           
           array_push($response["discountmaster"], $submenu);
			
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

else if($check == "menudiscount")
{

	$qry_sync="SELECT *  FROM tbl_menu_discount WHERE md_active='Y'";
	$result_sync=mysqli_query($localhost,$qry_sync);
			
			
	if (mysqli_num_rows($result_sync)>0) {
				
				$response["menudiscount"] = array();
				 
				
		while ($row = mysqli_fetch_array($result_sync)) 
		{
        
		    $submenu = array();
			$submenu["md_menuid"] = $row["md_menuid"];	
			$submenu["md_slno"] = $row["md_slno"];	
            $submenu["md_discount"] = $row["md_discount"];	
            $submenu["md_date_limit"] = $row["md_date_limit"];	
            $submenu["md_time_limit"] = $row["md_time_limit"];	
            $submenu["md_day_limit"] = $row["md_day_limit"];	
            $submenu["md_day"] = $row["md_day"];	
            $submenu["md_from_date"] = $row["md_from_date"];	
            $submenu["md_to_date"] = $row["md_to_date"];	
            $submenu["md_di_active"] = $row["md_di_active"];	
            $submenu["md_cs_active"] = $row["md_cs_active"];	
            $submenu["md_ta_active"] = $row["md_ta_active"];	
            $submenu["md_active"] = $row["md_active"];	
            $submenu["md_from_time"] = $row["md_from_time"];	
            $submenu["md_to_time"] = $row["md_to_time"];	
           
           
           array_push($response["menudiscount"], $submenu);
			
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








else if($check=="syncOrNot")
{
	$macId = $_GET['macId'];

	//$qry_status="SELECT as_appmachiesych  FROM tbl_appmachinedetails WHERE as_appmachineid = '$macId';";
	$qry_status="SELECT *  FROM tbl_appmachinedetails WHERE as_appmachineid = '$macId';";
	
	$result_status=mysqli_query($localhost,$qry_status);
	
	if (mysqli_num_rows($result_status)>0) {
        
		//$response["menu_update"] = array();
		
		while ($row = mysqli_fetch_array($result_status)) 
		{
        // temp user array
			$response["sync"] = $row["as_appmachiesych"]; 
			$response["success"] = 1;
			$status=$row["as_appmachiesych"];
			
				if($status=='Y')
				{
						//$submenu=array();
					
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
					$response["as_sync_menucombination"] = $row["as_sync_menucombination"];
					$response["as_sync_nutrition"] = $row["as_sync_nutrition"];
					$response["as_sync_ingredient"] = $row["as_sync_ingredient"];
					//array_push($response["menu_update"],$submenu);	
				}
				
		}
		
		 
			 echo json_encode($response);	
		
	}
	else
	{
		$response["success"] = 0;
		echo json_encode($response);
	}
					
}

else if($check == "prefmaster_update")
{					
	$qry_preference="SELECT *  FROM tbl_preferencemaster WHERE pmr_android_sync='Y'";
	$result_preference=mysqli_query($localhost,$qry_preference);
			
	
		if (mysqli_num_rows($result_preference)>0) 
			{
				$response["preferncemaster_update"] = array();
				while ($row = mysqli_fetch_array($result_preference)) 
				{
					$pref=array();
					$pref["pmr_id"] = $row["pmr_id"];
					$pref["pmr_name"] = $row["pmr_name"];
					$pref["pmr_android_sync"] = $row["pmr_android_sync"];
					array_push($response["preferncemaster_update"],$pref);
									
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

else if($check == "menumaincat_update")
{
		$qry_mmc="SELECT *  FROM tbl_menumaincategory WHERE mmy_android_sync='Y'";
		$result_mmc=mysqli_query($localhost,$qry_mmc);
					
		if (mysqli_num_rows($result_mmc)>0) 
		  {
			 $response["menumaincat_update"] = array();
			  while ($row = mysqli_fetch_array($result_mmc)) 
				{

					 $mmc = array();
					$mmc["mmy_id"] = $row["mmy_maincategoryid"];	
					$mmc["main_category_name"] = $row["mmy_maincategoryname"];	
					$mmc["mmy_active"] = $row["mmy_active"];	
					$mmc["mmy_branchid"] = $row["mmy_branchid"];	
					$mmc["mmy_displayorder"] = $row["mmy_displayorder"];	
					$mmc["mmy_imagename"] = $row["mmy_imagename"];	
					$mmc["mmy_orderofprint"] = $row["mmy_orderof_print"];	
					$mmc["mmy_androidsync"] = $row["mmy_android_sync"];	
					array_push($response["menumaincat_update"], $mmc);

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


else if($check == "menusubcat_update")
{					
	$qry_ms="SELECT *  FROM tbl_menusubcategory WHERE msy_android_sync='Y'";
	$result_ms=mysqli_query($localhost,$qry_ms);
					
	if (mysqli_num_rows($result_ms)>0) 
	  {
					
		$response["menusubcat_update"] = array();

		while ($row = mysqli_fetch_array($result_ms)) 
		{
			$ms = array();
			$ms["msy_id"] = $row["msy_subcategoryid"];
			$ms["msy_branchid"] = $row["msy_branchid"];
			$ms["msy_subcategoryname"] = $row["msy_subcategoryname"];
			$ms["msy_active"] = $row["msy_active"];
			$ms["msy_android_sync"] = $row["msy_android_sync"];

			array_push($response["menusubcat_update"], $ms);
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


else if($check == "portionmas_update")
{				
	$qry_pmas="SELECT *  FROM tbl_portionmaster WHERE pm_android_sync='Y'";
	$result_pmas=mysqli_query($localhost,$qry_pmas);
	
	
	if (mysqli_num_rows($result_pmas)>0) 
		{
	
			$response["portionmas_update"] = array();

				while ($row = mysqli_fetch_array($result_pmas)) 
				{
						$pm = array();
						$pm["pm_id"] = $row["pm_id"];
						$pm["pm_portionname"] = $row["pm_portionname"];
						$pm["pm_portionshortcode"] = $row["pm_portionshortcode"];
						$pm["pm_viewinbill"] = $row["pm_viewinbill"];
						$pm["pm_viewinkot"] = $row["pm_viewinkot"];
						$pm["pm_ratio"] = $row["pm_ratio"];
						$pm["pm_android_sync"] = $row["pm_android_sync"];
						array_push($response["portionmas_update"], $pm);
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


else if($check == "menumaster_update")
{
	$qry_rate="SELECT *  FROM tbl_menumaster WHERE mr_android_sync='Y'";
	$result_rate1=mysqli_query($localhost,$qry_rate);
					
	if (mysqli_num_rows($result_rate1)>0) 
	{
					
		$response["menumaster_update"] = array();
		
		while ($row = mysqli_fetch_array($result_rate1)) 

		{
			$menu = array();
			$menu["mr_id"] = $row["mr_menuid"];
			$menu["mr_menuname"] = $row["mr_menuname"];
			$menu["mr_maincatid"] = $row["mr_maincatid"];
			$menu["mr_subcatid"] = $row["mr_subcatid"];
			$menu["mr_description"] = $row["mr_description"];
			$menu["mr_diet"] = $row["mr_diet"];
			$menu["mr_time_min"] = $row["mr_time_min"];
			$menu["mr_active"] = $row["mr_active"];
			$menu["mr_kotcounter"] = $row["mr_kotcounter"];
			$menu["mr_modifieddate"] = $row["mr_modifieddate"];
			$menu["mr_modifieduser"] = $row["mr_modifieduser"];
			$menu["mr_rating"] = $row["mr_rating"];
			$menu["mr_prepmode"] = $row["mr_prepmode"];
			$menu["mr_branchid"] = $row["mr_branchid"];
			$menu["mr_itemshortcode"] = $row["mr_itemshortcode"];
			$menu["mr_dailystock"] = $row["mr_dailystock"];
			$menu["mr_manualrateentry"] = $row["mr_manualrateentry"];
			$menu["mr_itemcode"] = $row["mr_itemcode"];
			$menu["mr_dailystock_in_number"] = $row["mr_dailystock_in_number"];
			$menu["mr_android_sync"] = $row["mr_android_sync"];
			$menu["mr_show_in_kod"] = $row["mr_show_in_kod"];
			$menu["mr_excempt_tax"] = $row["mr_excempt_tax"];
			
			  array_push($response["menumaster_update"], $menu);
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



else if($check == "menuprefemaster_update")
{
	$qry_menupref="SELECT *  FROM tbl_menuprefmaster WHERE mpr_android_sync='Y'";
	$result_menupref=mysqli_query($localhost,$qry_menupref);
					
	if (mysqli_num_rows($result_menupref)>0) 
		{
			$response["menuprefemaster_update"] = array();
			while ($row = mysqli_fetch_array($result_menupref)) 
			
			{
				  $menupref = array();
				  $menupref["mpr_menuid"] = $row["mpr_menuid"];
				  $menupref["mpr_prefeernce"] = $row["mpr_prefeernce"];
				  $menupref["mpr_android_sync"] = $row["mpr_android_sync"];
				  array_push($response["menuprefemaster_update"],$menupref);
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



else if($check == "menuratemaster_update")
{					
	$qry_rate="SELECT *  FROM tbl_menuratemaster WHERE mmr_android_sync='Y'";
	$result_rate1=mysqli_query($localhost,$qry_rate);
	
	
	if (mysqli_num_rows($result_rate1)>0) 
		{
	
			$response["menuratemaster_update"] = array();

				while ($row = mysqli_fetch_array($result_rate1)) 
				{
					$rate=array();
					 $rate["mmr_menuid"] = $row["mmr_menuid"];
					 $rate["mmr_floorid"] = $row["mmr_floorid"];
					 $rate["mmr_portion"] = $row["mmr_portion"];
					$rate["mmr_rate"] = $row["mmr_rate"];
					$rate["mmr_default"] = $row["mmr_default"];
					$rate["mmr_android_sync"]= $row["mmr_android_sync"];
					
					array_push($response["menuratemaster_update"],$rate);
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


else if($check == "menustock_update")
{
	$qry_rate="SELECT *  FROM tbl_menustock WHERE mk_android_sync='Y'";
	$result_rate1=mysqli_query($localhost,$qry_rate);
					
		if (mysqli_num_rows($result_rate1)>0) 
			{
				$response["menustock_update"] = array();
				while ($row = mysqli_fetch_array($result_rate1)) 
				{
					 $stock = array();
					 $stock["mk_date"] = $row["mk_date"];
					 $stock["mk_menuid"] = $row["mk_menuid"];
					 $stock["mk_portion"] = $row["mk_portion"];
					 $stock["mk_stock"] = $row["mk_stock"];
					 $stock["mk_stocktime"] = $row["mk_stocktime"];
					 $stock["mk_stock_number"] = $row["mk_stock_number"];
					 $stock["mk_android_sync"]= $row["mk_android_sync"];
					 array_push($response["menustock_update"], $stock);
									
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





else if($check == "menuimage_update")
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


else if($check == "menucomb_update")
{
	$qry_combs="SELECT *  FROM tbl_menucombination WHERE mn_android_sync='Y'";
	$result_combs=mysqli_query($localhost,$qry_combs);
					
		if (mysqli_num_rows($result_combs)>0) 
			{
				$response["menucomb_update"] = array();
				while ($row = mysqli_fetch_array($result_combs)) 
				{
					 $combs = array();
					 $combs["mn_menuid"] = $row["mn_menuid"];
					 $combs["mn_menucombid"] = $row["mn_menucombid"];
					 $combs["mn_android_sync"] = $row["mn_android_sync"];
					array_push($response["menucomb_update"], $combs);
									
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






else if($check == "nutrition_update")
{
	$qry_mnfs="SELECT *  FROM tbl_menunutitionfacts WHERE mnf_android_sync='Y'";
	$result_mnfs=mysqli_query($localhost,$qry_mnfs);
					
		if (mysqli_num_rows($result_mnfs)>0) 
			{
				$response["nutrition_update"] = array();
				while ($row = mysqli_fetch_array($result_mnfs)) 
				{
					 $mnfs = array();
					 $mnfs["mnf_menuid"] = $row["mnf_menuid"];
					 $mnfs["mnf_nutrition"] = $row["mnf_nutrition"];
					 $mnfs["mnf_value"] = $row["mnf_value"];
					 $mnfs["mnf_android_sync"] = $row["mnf_android_sync"];
					array_push($response["nutrition_update"], $mnfs);
									
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


else if($check == "menuingredient_update")
{
	$qry_inc="SELECT *  FROM tbl_menuingredients WHERE ms_android_sync='Y'";
	$result_inc=mysqli_query($localhost,$qry_inc);
					
		if (mysqli_num_rows($result_inc)>0) 
			{
				$response["menuingredient_update"] = array();
				while ($row = mysqli_fetch_array($result_inc)) 
				{
					 $incs = array();
					 $incs["ms_menuid"] = $row["ms_menuid"];
					 $incs["ms_ingridentid"] = $row["ms_ingridentid"];
					 $incs["ms_android_sync"] = $row["ms_android_sync"];
					array_push($response["menuingredient_update"], $incs);
									
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












else if($check == "status_update")
{
	$table = $_GET['table'];
	$field = $_GET['field'];
	
	$up_sql = "update $table set $field='N'";
	
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

						
						
?>