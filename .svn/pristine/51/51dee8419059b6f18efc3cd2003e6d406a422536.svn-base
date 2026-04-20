<?php
include('../includes/session.php');		// Check session
include("../database.class.php"); // DB Connection class
$database	= new Database();
/* ################################ Country master ######################################### */
if($_REQUEST['type']=="country")
{
	$data = array();
	 $sql_login  =  $database->mysqlQuery("select distinct(cy_countryname) from tbl_country where cy_countryname LIKE '%".$_REQUEST['term']."%' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$data[] = array(
				  'label' => $result_login['cy_countryname'] ,
				  'value' => $result_login['cy_countryname']
			  );
			}
	  }
	
		echo json_encode($data);
flush();

}else if($_REQUEST['type']=="currency")
{
	$data = array();
	 $sql_login  =  $database->mysqlQuery("select distinct(cy_currencycode) from tbl_country where  cy_currencycode LIKE '%".$_REQUEST['term']."%' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$data[] = array(
				  'label' => $result_login['cy_currencycode'] ,
				  'value' => $result_login['cy_currencycode']
			  );
			}
	  }
	
		echo json_encode($data);
		flush();

}else if($_REQUEST['type']=="nationality")
{
	$data = array();
	 $sql_login  =  $database->mysqlQuery("select distinct(cy_nationality) from tbl_country where    cy_nationality LIKE '%".$_REQUEST['term']."%' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$data[] = array(
				  'label' => $result_login['cy_nationality'] ,
				  'value' => $result_login['cy_nationality']
			  );
			}
	  }
	
		echo json_encode($data);
flush();

}
/* ################################ State master ######################################### */
else if($_REQUEST['type']=="state")
{
	$data = array();
	 $sql_login  =  $database->mysqlQuery("select distinct(se_statename) from tbl_state LEFT JOIN tbl_country ON tbl_state.se_countryid=tbl_country.cy_countyid where   tbl_state.se_statename LIKE '%".$_REQUEST['term']."%' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$data[] = array(
				  'label' => $result_login['se_statename'] ,
				  'value' => $result_login['se_statename']
			  );
			}
	  }
	
		echo json_encode($data);
flush();

}else if($_REQUEST['type']=="country_s")
{
	$data = array();
	 $sql_login  =  $database->mysqlQuery("select distinct(cy_countryname) from tbl_state LEFT JOIN tbl_country ON tbl_state.se_countryid=tbl_country.cy_countyid where   tbl_country.cy_countryname LIKE '%".$_REQUEST['term']."%' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$data[] = array(
				  'label' => $result_login['cy_countryname'] ,
				  'value' => $result_login['cy_countryname']
			  );
			}
	  }
	
		echo json_encode($data);
flush();

}
/* ################################ city master ######################################### */
else if($_REQUEST['type']=="city_s")
{
	$data = array();
	 $sql_login  =  $database->mysqlQuery("select distinct(cy_cityname) from tbl_city LEFT JOIN tbl_state ON tbl_city.cy_stateid=tbl_state.se_stateid LEFT JOIN tbl_country ON  tbl_city.cy_countryid=tbl_country.cy_countyid where   tbl_city.cy_cityname LIKE '%".$_REQUEST['term']."%' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$data[] = array(
				  'label' => $result_login['cy_cityname'] ,
				  'value' => $result_login['cy_cityname']
			  );
			}
	  }
	
		echo json_encode($data);
flush();

}else if($_REQUEST['type']=="state_s")
{
	$data = array();
	 $sql_login  =  $database->mysqlQuery("select distinct(se_statename) from tbl_city LEFT JOIN tbl_state ON tbl_city.cy_stateid=tbl_state.se_stateid LEFT JOIN tbl_country ON  tbl_city.cy_countryid=tbl_country.cy_countyid where   tbl_state.se_statename LIKE '%".$_REQUEST['term']."%' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$data[] = array(
				  'label' => $result_login['se_statename'] ,
				  'value' => $result_login['se_statename']
			  );
			}
	  }
	
		echo json_encode($data);
flush();

}else if($_REQUEST['type']=="countrys_s")
{
	$data = array();
	 $sql_login  =  $database->mysqlQuery("select distinct(cy_countryname) from tbl_city LEFT JOIN tbl_state ON tbl_city.cy_stateid=tbl_state.se_stateid LEFT JOIN tbl_country ON  tbl_city.cy_countryid=tbl_country.cy_countyid where   tbl_country.cy_countryname LIKE '%".$_REQUEST['term']."%' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$data[] = array(
				  'label' => $result_login['cy_countryname'] ,
				  'value' => $result_login['cy_countryname']
			  );
			}
	  }
	
		echo json_encode($data);
flush();

}
/* ################################ Kot counter master ######################################### */
else if($_REQUEST['type']=="kot_s")
{
	$data = array();
	 $sql_login  =  $database->mysqlQuery("select distinct(kr_kotname) from tbl_kotcountermaster LEFT JOIN tbl_branchmaster ON tbl_kotcountermaster.kr_branchid=tbl_branchmaster.be_branchid  LEFT JOIN tbl_printersettings ON tbl_kotcountermaster.kr_printerid=tbl_printersettings.pr_id Where kr_kotname LIKE '%".$_REQUEST['term']."%' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$data[] = array(
				  'label' => $result_login['kr_kotname'] ,
				  'value' => $result_login['kr_kotname']
			  );
			}
	  }
	
		echo json_encode($data);
flush();

}else if($_REQUEST['type']=="branch_s")
{
	$data = array();
	 $sql_login  =  $database->mysqlQuery("select distinct(be_branchname) from tbl_kotcountermaster LEFT JOIN tbl_branchmaster ON tbl_kotcountermaster.kr_branchid=tbl_branchmaster.be_branchid  LEFT JOIN tbl_printersettings ON tbl_kotcountermaster.kr_printerid=tbl_printersettings.pr_id Where be_branchname LIKE '%".$_REQUEST['term']."%' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$data[] = array(
				  'label' => $result_login['be_branchname'] ,
				  'value' => $result_login['be_branchname']
			  );
			}
	  }
	
		echo json_encode($data);
flush();

}else if($_REQUEST['type']=="printer_s")
{
	$data = array();
	 $sql_login  =  $database->mysqlQuery("select distinct(pr_printername) from tbl_kotcountermaster LEFT JOIN tbl_branchmaster ON tbl_kotcountermaster.kr_branchid=tbl_branchmaster.be_branchid  LEFT JOIN tbl_printersettings ON tbl_kotcountermaster.kr_printerid=tbl_printersettings.pr_id Where pr_printername LIKE '%".$_REQUEST['term']."%' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$data[] = array(
				  'label' => $result_login['pr_printername'] ,
				  'value' => $result_login['pr_printername']
			  );
			}
	  }
	
		echo json_encode($data);
flush();

}
/* ################################ Floor master ######################################### */
else if($_REQUEST['type']=="floors_s")
{ 
	$data = array();
	 $sql_login  =  $database->mysqlQuery("select distinct(fr_floorname) from tbl_floormaster LEFT JOIN tbl_branchmaster ON tbl_floormaster.fr_branchid=tbl_branchmaster.be_branchid Where fr_floorname LIKE '%".$_REQUEST['term']."%' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$data[] = array(
				  'label' => $result_login['fr_floorname'] ,
				  'value' => $result_login['fr_floorname']
			  );
			}
	  }
	
		echo json_encode($data);
flush();

}else if($_REQUEST['type']=="branchs_s")
{
	$data = array();
	 $sql_login  =  $database->mysqlQuery("select distinct(be_branchname) from tbl_floormaster LEFT JOIN tbl_branchmaster ON tbl_floormaster.fr_branchid=tbl_branchmaster.be_branchid Where be_branchname LIKE '%".$_REQUEST['term']."%' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$data[] = array(
				  'label' => $result_login['be_branchname'] ,
				  'value' => $result_login['be_branchname']
			  );
			}
	  }
	
		echo json_encode($data);
flush();

}else if($_REQUEST['type']=="servtxs_s")
{
	$data = array();
	 $sql_login  =  $database->mysqlQuery("select distinct(fr_servicetax) from tbl_floormaster LEFT JOIN tbl_branchmaster ON tbl_floormaster.fr_branchid=tbl_branchmaster.be_branchid Where fr_servicetax LIKE '%".$_REQUEST['term']."%' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$data[] = array(
				  'label' => $result_login['fr_servicetax'] ,
				  'value' => $result_login['fr_servicetax']
			  );
			}
	  }
	
		echo json_encode($data);
flush();

}else if($_REQUEST['type']=="vats_s")
{
	$data = array();
	 $sql_login  =  $database->mysqlQuery("select distinct(fr_vat) from tbl_floormaster LEFT JOIN tbl_branchmaster ON tbl_floormaster.fr_branchid=tbl_branchmaster.be_branchid Where fr_vat LIKE '%".$_REQUEST['term']."%' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$data[] = array(
				  'label' => $result_login['fr_vat'] ,
				  'value' => $result_login['fr_vat']
			  );
			}
	  }
	
		echo json_encode($data);
flush();

}else if($_REQUEST['type']=="servchs_s")
{
	$data = array();
	 $sql_login  =  $database->mysqlQuery("select distinct(fr_servicecharge) from tbl_floormaster LEFT JOIN tbl_branchmaster ON tbl_floormaster.fr_branchid=tbl_branchmaster.be_branchid Where fr_servicecharge LIKE '%".$_REQUEST['term']."%' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$data[] = array(
				  'label' => $result_login['fr_servicecharge'] ,
				  'value' => $result_login['fr_servicecharge']
			  );
			}
	  }
	
		echo json_encode($data);
flush();

}
else if($_REQUEST['type']=="statuss_s")
{
	$data = array();
	 $sql_login  =  $database->mysqlQuery("select distinct(fr_status) from tbl_floormaster LEFT JOIN tbl_branchmaster ON tbl_floormaster.fr_branchid=tbl_branchmaster.be_branchid Where fr_status LIKE '%".$_REQUEST['term']."%' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$data[] = array(
				  'label' => $result_login['fr_status'] ,
				  'value' => $result_login['fr_status']
			  );
			}
	  }
	
		echo json_encode($data);
flush();

}
/* ################################ Table master ######################################### */
else if($_REQUEST['type']=="tables_t")
{         
	$data = array();
	 $sql_login  =  $database->mysqlQuery("select distinct(tr_tableno) from tbl_tablemaster INNER JOIN tbl_branchmaster ON tbl_tablemaster.tr_branchid=tbl_branchmaster.be_branchid INNER JOIN tbl_floormaster ON tbl_tablemaster.tr_floorid=tbl_floormaster.fr_floorid Where tr_tableno LIKE '%".$_REQUEST['term']."%' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$data[] = array(
				  'label' => $result_login['tr_tableno'] ,
				  'value' => $result_login['tr_tableno']
			  );
			}
	  }
	
		echo json_encode($data);
flush();

}else if($_REQUEST['type']=="chairs_t")
{
	$data = array();
	 $sql_login  =  $database->mysqlQuery("select distinct(tr_maxchaircount) from tbl_tablemaster INNER JOIN tbl_branchmaster ON tbl_tablemaster.tr_branchid=tbl_branchmaster.be_branchid INNER JOIN tbl_floormaster ON tbl_tablemaster.tr_floorid=tbl_floormaster.fr_floorid Where tr_maxchaircount LIKE '%".$_REQUEST['term']."%' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$data[] = array(
				  'label' => $result_login['tr_maxchaircount'] ,
				  'value' => $result_login['tr_maxchaircount']
			  );
			}
	  }
	
		echo json_encode($data);
flush();

}else if($_REQUEST['type']=="floors_t")
{
	$data = array();
	 $sql_login  =  $database->mysqlQuery("select distinct(fr_floorname) from tbl_tablemaster INNER JOIN tbl_branchmaster ON tbl_tablemaster.tr_branchid=tbl_branchmaster.be_branchid INNER JOIN tbl_floormaster ON tbl_tablemaster.tr_floorid=tbl_floormaster.fr_floorid Where fr_floorname LIKE '%".$_REQUEST['term']."%' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$data[] = array(
				  'label' => $result_login['fr_floorname'] ,
				  'value' => $result_login['fr_floorname']
			  );
			}
	  }
	
		echo json_encode($data);
flush();

}else if($_REQUEST['type']=="branchs_t")
{
	$data = array();
	 $sql_login  =  $database->mysqlQuery("select distinct(be_branchname) from tbl_tablemaster INNER JOIN tbl_branchmaster ON tbl_tablemaster.tr_branchid=tbl_branchmaster.be_branchid INNER JOIN tbl_floormaster ON tbl_tablemaster.tr_floorid=tbl_floormaster.fr_floorid Where be_branchname LIKE '%".$_REQUEST['term']."%' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$data[] = array(
				  'label' => $result_login['be_branchname'] ,
				  'value' => $result_login['be_branchname']
			  );
			}
	  }
	
		echo json_encode($data);
flush();

}else if($_REQUEST['type']=="statuss_t")
{
	$data = array();
	 $sql_login  =  $database->mysqlQuery("select distinct(tr_status) from tbl_tablemaster INNER JOIN tbl_branchmaster ON tbl_tablemaster.tr_branchid=tbl_branchmaster.be_branchid INNER JOIN tbl_floormaster ON tbl_tablemaster.tr_floorid=tbl_floormaster.fr_floorid Where tr_status LIKE '%".$_REQUEST['term']."%' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$data[] = array(
				  'label' => $result_login['tr_status'] ,
				  'value' => $result_login['tr_status']
			  );
			}
	  }
	
		echo json_encode($data);
flush();

}
/* ################################ Printer master ######################################### */
else if($_REQUEST['type']=="pname_s")
{    
	$data = array();
	 $sql_login  =  $database->mysqlQuery("select distinct(pr_printername) from tbl_printersettings INNER JOIN tbl_branchmaster ON tbl_printersettings.pr_branchid=tbl_branchmaster.be_branchid Where pr_printername LIKE '%".$_REQUEST['term']."%' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$data[] = array(
				  'label' => $result_login['pr_printername'] ,
				  'value' => $result_login['pr_printername']
			  );
			}
	  }
	  $sql_login  =  $database->mysqlQuery("select distinct(pr_usbprinter) from tbl_printersettings INNER JOIN tbl_branchmaster ON tbl_printersettings.pr_branchid=tbl_branchmaster.be_branchid Where pr_usbprinter LIKE '%".$_REQUEST['term']."%' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$data[] = array(
				  'label' => $result_login['pr_usbprinter'] ,
				  'value' => $result_login['pr_usbprinter']
			  );
			}
	  }
	
		echo json_encode($data);
flush();

}
else if($_REQUEST['type']=="pip_s")
{
	$data = array();
	 $sql_login  =  $database->mysqlQuery("select distinct(pr_printerip) from tbl_printersettings INNER JOIN tbl_branchmaster ON tbl_printersettings.pr_branchid=tbl_branchmaster.be_branchid Where pr_printerip LIKE '%".$_REQUEST['term']."%' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$data[] = array(
				  'label' => $result_login['pr_printerip'] ,
				  'value' => $result_login['pr_printerip']
			  );
			}
	  }
	  $sql_login  =  $database->mysqlQuery("select distinct(pr_usbprinterip) from tbl_printersettings INNER JOIN tbl_branchmaster ON tbl_printersettings.pr_branchid=tbl_branchmaster.be_branchid Where pr_usbprinterip LIKE '%".$_REQUEST['term']."%' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$data[] = array(
				  'label' => $result_login['pr_usbprinterip'] ,
				  'value' => $result_login['pr_usbprinterip']
			  );
			}
	  }
	
		echo json_encode($data);
flush();

}
else if($_REQUEST['type']=="pport_s")
{
	$data = array();
	 $sql_login  =  $database->mysqlQuery("select distinct(pr_printerport) from tbl_printersettings INNER JOIN tbl_branchmaster ON tbl_printersettings.pr_branchid=tbl_branchmaster.be_branchid Where pr_printerport LIKE '%".$_REQUEST['term']."%' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$data[] = array(
				  'label' => $result_login['pr_printerport'] ,
				  'value' => $result_login['pr_printerport']
			  );
			}
	  }
	
		echo json_encode($data);
flush();

}
else if($_REQUEST['type']=="ptype_s")
{
	$data = array();
	 $sql_login  =  $database->mysqlQuery("select distinct(pr_printertype) from tbl_printersettings INNER JOIN tbl_branchmaster ON tbl_printersettings.pr_branchid=tbl_branchmaster.be_branchid Where pr_printertype LIKE '%".$_REQUEST['term']."%' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$data[] = array(
				  'label' => $result_login['pr_printertype'] ,
				  'value' => $result_login['pr_printertype']
			  );
			}
	  }
	
		echo json_encode($data);
flush();

}
else if($_REQUEST['type']=="pbranch_s")
{
	$data = array();
	 $sql_login  =  $database->mysqlQuery("select distinct(be_branchname) from tbl_printersettings INNER JOIN tbl_branchmaster ON tbl_printersettings.pr_branchid=tbl_branchmaster.be_branchid Where be_branchname LIKE '%".$_REQUEST['term']."%' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$data[] = array(
				  'label' => $result_login['be_branchname'] ,
				  'value' => $result_login['be_branchname']
			  );
			}
	  }
	
		echo json_encode($data);
flush();

}
/* ################################ Department  master ######################################### */
else if($_REQUEST['type']=="depts_s")
{
	$data = array();
	 $sql_login  =  $database->mysqlQuery("select distinct(der_departmentname) from tbl_departmentmaster Where der_departmentname LIKE '%".$_REQUEST['term']."%' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$data[] = array(
				  'label' => $result_login['der_departmentname'] ,
				  'value' => $result_login['der_departmentname']
			  );
			}
	  }
	
		echo json_encode($data);
flush();

}
/* ################################ Designation  master ######################################### */
else if($_REQUEST['type']=="desgs_d")
{
	$data = array();
	 $sql_login  =  $database->mysqlQuery("select distinct(dr_designationname) from tbl_designationmaster Where dr_designationname LIKE '%".$_REQUEST['term']."%' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$data[] = array(
				  'label' => $result_login['dr_designationname'] ,
				  'value' => $result_login['dr_designationname']
			  );
			}
	  }
	
		echo json_encode($data);
flush();

}
else if($_REQUEST['type']=="logins_d")
{
	$data = array();
	 $sql_login  =  $database->mysqlQuery("select distinct(dr_login) from tbl_designationmaster Where dr_login LIKE '%".$_REQUEST['term']."%' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$data[] = array(
				  'label' => $result_login['dr_login'] ,
				  'value' => $result_login['dr_login']
			  );
			}
	  }
	
		echo json_encode($data);
flush();

}  
/* ################################ Discount  master ######################################### */
else if($_REQUEST['type']=="discounts_s")
{
	$data = array();
	 $sql_login  =  $database->mysqlQuery("select distinct(ds_discountname) from tbl_discountmaster INNER JOIN tbl_branchmaster ON tbl_discountmaster.ds_branchid=tbl_branchmaster.be_branchid Where ds_discountname LIKE '%".$_REQUEST['term']."%' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$data[] = array(
				  'label' => $result_login['ds_discountname'] ,
				  'value' => $result_login['ds_discountname']
			  );
			}
	  }
	
		echo json_encode($data);
flush();

}
else if($_REQUEST['type']=="branchs_s")
{
	$data = array();
	 $sql_login  =  $database->mysqlQuery("select distinct(be_branchname) from tbl_discountmaster INNER JOIN tbl_branchmaster ON tbl_discountmaster.ds_branchid=tbl_branchmaster.be_branchid Where be_branchname LIKE '%".$_REQUEST['term']."%' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$data[] = array(
				  'label' => $result_login['be_branchname'] ,
				  'value' => $result_login['be_branchname']
			  );
			}
	  }
	
		echo json_encode($data);
flush();

}
else if($_REQUEST['type']=="statuss_s")
{
	$data = array();
	 $sql_login  =  $database->mysqlQuery("select distinct(ds_status) from tbl_discountmaster INNER JOIN tbl_branchmaster ON tbl_discountmaster.ds_branchid=tbl_branchmaster.be_branchid Where ds_status LIKE '%".$_REQUEST['term']."%' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$data[] = array(
				  'label' => $result_login['ds_status'] ,
				  'value' => $result_login['ds_status']
			  );
			}
	  }
	
		echo json_encode($data);
flush();

}
/* ################################ Corporate Discount  master ######################################### */
else if($_REQUEST['type']=="coprnames_s")
{
	$data = array();
	 $sql_login  =  $database->mysqlQuery("select distinct(ct_corporatename) from tbl_corporatemaster INNER JOIN tbl_branchmaster ON tbl_corporatemaster.ct_branchid=tbl_branchmaster.be_branchid Where ct_corporatename LIKE '%".$_REQUEST['term']."%' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$data[] = array(
				  'label' => $result_login['ct_corporatename'] ,
				  'value' => $result_login['ct_corporatename']
			  );
			}
	  }
	
		echo json_encode($data);
flush();

}
else if($_REQUEST['type']=="corpdiscs_s")
{
	$data = array();
	 $sql_login  =  $database->mysqlQuery("select distinct(ct_corporatediscount) from tbl_corporatemaster INNER JOIN tbl_branchmaster ON tbl_corporatemaster.ct_branchid=tbl_branchmaster.be_branchid Where ct_corporatediscount LIKE '%".$_REQUEST['term']."%' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$data[] = array(
				  'label' => $result_login['ct_corporatediscount'] ,
				  'value' => $result_login['ct_corporatediscount']
			  );
			}
	  }
	
		echo json_encode($data);
flush();

}
/* ################################ Voucher master ######################################### */
	
else if($_REQUEST['type']=="vochrs_v")
{
	$data = array();
	 $sql_login  =  $database->mysqlQuery("select distinct(vr_vouchername) from tbl_vouchermaster INNER JOIN tbl_branchmaster ON tbl_vouchermaster.vr_branchid=tbl_branchmaster.be_branchid Where vr_vouchername LIKE '%".$_REQUEST['term']."%' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$data[] = array(
				  'label' => $result_login['vr_vouchername'] ,
				  'value' => $result_login['vr_vouchername']
			  );
			}
	  }
	
		echo json_encode($data);
flush();

}
else if($_REQUEST['type']=="froms_v")
{
	$data = array();
	 $sql_login  =  $database->mysqlQuery("select distinct(vr_voucherfrom) from tbl_vouchermaster INNER JOIN tbl_branchmaster ON tbl_vouchermaster.vr_branchid=tbl_branchmaster.be_branchid Where vr_voucherfrom LIKE '%".$_REQUEST['term']."%' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$data[] = array(
				  'label' => $result_login['vr_voucherfrom'] ,
				  'value' => $result_login['vr_voucherfrom']
			  );
			}
	  }
	
		echo json_encode($data);
flush();

}
else if($_REQUEST['type']=="expirys_v")
{
	$data = array();
	 $sql_login  =  $database->mysqlQuery("select distinct(vr_voucherexpiry) from tbl_vouchermaster INNER JOIN tbl_branchmaster ON tbl_vouchermaster.vr_branchid=tbl_branchmaster.be_branchid Where vr_voucherexpiry LIKE '%".$_REQUEST['term']."%' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$data[] = array(
				  'label' => $result_login['vr_voucherexpiry'] ,
				  'value' => $result_login['vr_voucherexpiry']
			  );
			}
	  }
	
		echo json_encode($data);
flush();

}else if($_REQUEST['type']=="costs_v")
{
	$data = array();
	 $sql_login  =  $database->mysqlQuery("select distinct(vr_vouchercost) from tbl_vouchermaster INNER JOIN tbl_branchmaster ON tbl_vouchermaster.vr_branchid=tbl_branchmaster.be_branchid Where vr_vouchercost LIKE '%".$_REQUEST['term']."%' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$data[] = array(
				  'label' => $result_login['vr_vouchercost'] ,
				  'value' => $result_login['vr_vouchercost']
			  );
			}
	  }
	
		echo json_encode($data);
flush();

}
else if($_REQUEST['type']=="holders_v")
{
	$data = array();
	 $sql_login  =  $database->mysqlQuery("select distinct(vr_voucherholder) from tbl_vouchermaster INNER JOIN tbl_branchmaster ON tbl_vouchermaster.vr_branchid=tbl_branchmaster.be_branchid Where vr_voucherholder LIKE '%".$_REQUEST['term']."%' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$data[] = array(
				  'label' => $result_login['vr_voucherholder'] ,
				  'value' => $result_login['vr_voucherholder']
			  );
			}
	  }
	
		echo json_encode($data);
flush();

}
else if($_REQUEST['type']=="contacts_v")
{
	$data = array();
	 $sql_login  =  $database->mysqlQuery("select distinct(vr_holdercontact) from tbl_vouchermaster INNER JOIN tbl_branchmaster ON tbl_vouchermaster.vr_branchid=tbl_branchmaster.be_branchid Where vr_holdercontact LIKE '%".$_REQUEST['term']."%' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$data[] = array(
				  'label' => $result_login['vr_holdercontact'] ,
				  'value' => $result_login['vr_holdercontact']
			  );
			}
	  }
	
		echo json_encode($data);
flush();

}
else if($_REQUEST['type']=="branchs_v")
{
	$data = array();
	 $sql_login  =  $database->mysqlQuery("select distinct(be_branchname) from tbl_vouchermaster INNER JOIN tbl_branchmaster ON tbl_vouchermaster.vr_branchid=tbl_branchmaster.be_branchid Where be_branchname LIKE '%".$_REQUEST['term']."%' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$data[] = array(
				  'label' => $result_login['be_branchname'] ,
				  'value' => $result_login['be_branchname']
			  );
			}
	  }
	
		echo json_encode($data);
flush();

}
else if($_REQUEST['type']=="statuss_v")
{
	$data = array();
	 $sql_login  =  $database->mysqlQuery("select distinct(vr_active) from tbl_vouchermaster INNER JOIN tbl_branchmaster ON tbl_vouchermaster.vr_branchid=tbl_branchmaster.be_branchid Where vr_active LIKE '%".$_REQUEST['term']."%' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$data[] = array(
				  'label' => $result_login['vr_active'] ,
				  'value' => $result_login['vr_active']
			  );
			}
	  }
	
		echo json_encode($data);
flush();

}
/* ################################ Coupon company master ######################################### */
	
else if($_REQUEST['type']=="companys_c")
{
	$data = array();
	 $sql_login  =  $database->mysqlQuery("select distinct(cy_companyname) from tbl_couponcompany Where cy_companyname LIKE '%".$_REQUEST['term']."%' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$data[] = array(
				  'label' => $result_login['cy_companyname'] ,
				  'value' => $result_login['cy_companyname']
			  );
			}
	  }
	
		echo json_encode($data);
flush();

}
else if($_REQUEST['type']=="startds_c")
{
	$data = array();
	 $sql_login  =  $database->mysqlQuery("select distinct(cy_startdate) from tbl_couponcompany Where cy_startdate LIKE '%".$_REQUEST['term']."%' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$data[] = array(
				  'label' => $result_login['cy_startdate'] ,
				  'value' => $result_login['cy_startdate']
			  );
			}
	  }
	
		echo json_encode($data);
flush();

}
else if($_REQUEST['type']=="statuss_c")
{
	$data = array();
	 $sql_login  =  $database->mysqlQuery("select distinct(cy_active) from tbl_couponcompany Where cy_active LIKE '%".$_REQUEST['term']."%' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$data[] = array(
				  'label' => $result_login['cy_active'] ,
				  'value' => $result_login['cy_active']
			  );
			}
	  }
	
		echo json_encode($data);
flush();

}  
/* ################################ Category master ######################################### */
	
else if($_REQUEST['type']=="categrys_c")
{
	$data = array();
	 $sql_login  =  $database->mysqlQuery("select distinct(mmy_maincategoryname) from tbl_menumaincategory Where mmy_maincategoryname LIKE '%".$_REQUEST['term']."%' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$data[] = array(
				  'label' => $result_login['mmy_maincategoryname'] ,
				  'value' => $result_login['mmy_maincategoryname']
			  );
			}
	  }
	
		echo json_encode($data);
flush();

}
else if($_REQUEST['type']=="displys_c")
{
	$data = array();
	 $sql_login  =  $database->mysqlQuery("select distinct(mmy_displayorder) from tbl_menumaincategory Where mmy_displayorder LIKE '%".$_REQUEST['term']."%' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$data[] = array(
				  'label' => $result_login['mmy_displayorder'] ,
				  'value' => $result_login['mmy_displayorder']
			  );
			}
	  }
	
		echo json_encode($data);
flush();

}
else if($_REQUEST['type']=="statuss_cm")
{
	$data = array();
	$sr="";
	$type=strtolower($_REQUEST['term']);
	if($type=="ye")
	{
		$sr="Y";
	}elseif($type=="yes")
	{
		$sr="Y";
	}elseif($type=="n")
	{
		$sr="N";
	}elseif($type=="no")
	{
		$sr="N";
	}else
	{
		$sr=$type;
	}
	 $sql_login  =  $database->mysqlQuery("select distinct(mmy_active) from tbl_menumaincategory Where mmy_active LIKE '%".$sr."%' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				if($result_login['mmy_active']=="Y")
				{
					$active="Yes";
				}else 
				{
					$active="No";
				}
			$data[] = array(
				  'label' => $active ,
				  'value' => $active
			  );
			}
	  }
	
		echo json_encode($data);
flush();

}
/* ################################ Sub Category master ######################################### */
	
else if($_REQUEST['type']=="subcatnams_su")
{
	$data = array();
	 $sql_login  =  $database->mysqlQuery("select distinct(msy_subcategoryname) from tbl_menusubcategory Where msy_subcategoryname LIKE '%".$_REQUEST['term']."%' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$data[] = array(
				  'label' => $result_login['msy_subcategoryname'] ,
				  'value' => $result_login['msy_subcategoryname']
			  );
			}
	  }
	
		echo json_encode($data);
flush();

}
else if($_REQUEST['type']=="statuss_su")
{
	$data = array();
	 $sr="";
	$type=strtolower($_REQUEST['term']);
	if($type=="ye")
	{
		$sr="Y";
	}elseif($type=="yes")
	{
		$sr="Y";
	}elseif($type=="n")
	{
		$sr="N";
	}elseif($type=="no")
	{
		$sr="N";
	}else
	{
		$sr=$type;
	}
	 $sql_login  =  $database->mysqlQuery("select distinct(msy_active) from tbl_menusubcategory Where msy_active LIKE '%".$sr."%' ");  
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				if($result_login['msy_active']=="Y")
				{
					$active="Yes";
				}else 
				{
					$active="No";
				}
			$data[] = array(
				  'label' => $active ,
				  'value' => $active
			  );
			}
	  }
	
		echo json_encode($data);
flush();

}
/* ################################ Portion master ######################################### */
	
else if($_REQUEST['type']=="portionams_p")
{
	$data = array();
	 $sql_login  =  $database->mysqlQuery("select distinct(pm_portionname) from tbl_portionmaster Where pm_portionname LIKE '%".$_REQUEST['term']."%' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$data[] = array(
				  'label' => $result_login['pm_portionname'] ,
				  'value' => $result_login['pm_portionname']
			  );
			}
	  }
	
		echo json_encode($data);
flush();

}
else if($_REQUEST['type']=="shtcds_p")
{
	$data = array();
	 $sql_login  =  $database->mysqlQuery("select distinct(pm_portionshortcode) from tbl_portionmaster Where pm_portionshortcode LIKE '%".$_REQUEST['term']."%' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$data[] = array(
				  'label' => $result_login['pm_portionshortcode'] ,
				  'value' => $result_login['pm_portionshortcode']
			  );
			}
	  }
	
		echo json_encode($data);
flush();

}
/* ################################ Change Password ######################################### */
	
else if($_REQUEST['type']=="usernames_u")
{
	$data = array();
	 $sql_login  =  $database->mysqlQuery("select distinct(ls_username) from tbl_logindetails Where ls_username LIKE '%".$_REQUEST['term']."%' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$data[] = array(
				  'label' => $result_login['ls_username'] ,
				  'value' => $result_login['ls_username']
			  );
			}
	  }
	
		echo json_encode($data);
flush();

}
else if($_REQUEST['type']=="statuss_u")
{
	$data = array();
	 $sr="";
	$type=strtolower($_REQUEST['term']);
	if($type=="ye")
	{
		$sr="Y";
	}elseif($type=="yes")
	{
		$sr="Y";
	}elseif($type=="n")
	{
		$sr="N";
	}elseif($type=="no")
	{
		$sr="N";
	}else
	{
		$sr=$type;
	}
	 $sql_login  =  $database->mysqlQuery("select distinct(ls_status) from tbl_logindetails Where ls_status LIKE '%".$sr."%' ");  
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				if($result_login['ls_status']=="Y")
				{
					$active="Yes";
				}else 
				{
					$active="No";
				}
			$data[] = array(
				  'label' => $active ,
				  'value' => $active
			  );
			}
	  }
	
		echo json_encode($data);
flush();

}
/* ################################ Menu master ######################################### */
	
else if($_REQUEST['type']=="mname_m")
{
	$data = array();
	 $sql_login  =  $database->mysqlQuery("select distinct(tbl_menumaster.mr_menuname) as menuname from tbl_menumaster LEFT JOIN tbl_menumaincategory ON tbl_menumaster.mr_maincatid=tbl_menumaincategory.mmy_maincategoryid LEFT JOIN tbl_menusubcategory ON tbl_menumaster.mr_subcatid=tbl_menusubcategory.msy_subcategoryid Where tbl_menumaster.mr_menuname LIKE '%".$_REQUEST['term']."%' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$data[] = array(
				  'label' => $result_login['menuname'] ,
				  'value' => $result_login['menuname']
			  );
			}
	  }
	
		echo json_encode($data);
flush();

}
else if($_REQUEST['type']=="mcate_m")
{
	$data = array();
	 $sql_login  =  $database->mysqlQuery("select distinct(tbl_menumaincategory.mmy_maincategoryname) from tbl_menumaster LEFT JOIN tbl_menumaincategory ON tbl_menumaster.mr_maincatid=tbl_menumaincategory.mmy_maincategoryid LEFT JOIN tbl_menusubcategory ON tbl_menumaster.mr_subcatid=tbl_menusubcategory.msy_subcategoryid Where tbl_menumaincategory.mmy_maincategoryname LIKE '%".$_REQUEST['term']."%' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$data[] = array(
				  'label' => $result_login['mmy_maincategoryname'] ,
				  'value' => $result_login['mmy_maincategoryname']
			  );
			}
	  }
	
		echo json_encode($data);
flush();

}else if($_REQUEST['type']=="msubc_m")
{
	$data = array();
	 $sql_login  =  $database->mysqlQuery("select distinct(tbl_menusubcategory.msy_subcategoryname) from tbl_menumaster LEFT JOIN tbl_menumaincategory ON tbl_menumaster.mr_maincatid=tbl_menumaincategory.mmy_maincategoryid LEFT JOIN tbl_menusubcategory ON tbl_menumaster.mr_subcatid=tbl_menusubcategory.msy_subcategoryid Where tbl_menusubcategory.msy_subcategoryname LIKE '%".$_REQUEST['term']."%' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$data[] = array(
				  'label' => $result_login['msy_subcategoryname'] ,
				  'value' => $result_login['msy_subcategoryname']
			  );
			}
	  }
	
		echo json_encode($data);
flush();

}else if($_REQUEST['type']=="mdiet_m")
{
	$data = array();
	 $sql_login  =  $database->mysqlQuery("select distinct(tbl_menumaster.mr_diet) from tbl_menumaster LEFT JOIN tbl_menumaincategory ON tbl_menumaster.mr_maincatid=tbl_menumaincategory.mmy_maincategoryid LEFT JOIN tbl_menusubcategory ON tbl_menumaster.mr_subcatid=tbl_menusubcategory.msy_subcategoryid Where tbl_menumaster.mr_diet LIKE '%".$_REQUEST['term']."%' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$data[] = array(
				  'label' => $result_login['mr_diet'] ,
				  'value' => $result_login['mr_diet']
			  );
			}
	  }
	
		echo json_encode($data);
flush();

}
else if($_REQUEST['type']=="mstatus_m")
{
	$data = array();
	 $sr="";
	$type=strtolower($_REQUEST['term']);
	if($type=="ye")
	{
		$sr="Y";
	}elseif($type=="yes")
	{
		$sr="Y";
	}elseif($type=="n")
	{
		$sr="N";
	}elseif($type=="no")
	{
		$sr="N";
	}else
	{
		$sr=$type;
	}
	 $sql_login  =  $database->mysqlQuery("select distinct(tbl_menumaster.mr_active) from tbl_menumaster LEFT JOIN tbl_menumaincategory ON tbl_menumaster.mr_maincatid=tbl_menumaincategory.mmy_maincategoryid LEFT JOIN tbl_menusubcategory ON tbl_menumaster.mr_subcatid=tbl_menusubcategory.msy_subcategoryid Where tbl_menumaster.mr_active LIKE '%".$sr."%' ");  
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				if($result_login['mr_active']=="Y")
				{
					$active="Yes";
				}else 
				{
					$active="No";
				}
			$data[] = array(
				  'label' => $active ,
				  'value' => $active
			  );
			}
	  }
	
		echo json_encode($data);
flush();

}
/* ################################ Ingredient master ######################################### */
	
else if($_REQUEST['type']=="ingrdnts_i")
{
	$data = array();
	 $sql_login  =  $database->mysqlQuery("select distinct(ir_ingredientname) from tbl_ingredientmaster Where ir_ingredientname LIKE '%".$_REQUEST['term']."%' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$data[] = array(
				  'label' => $result_login['ir_ingredientname'] ,
				  'value' => $result_login['ir_ingredientname']
			  );
			}
	  }
	
		echo json_encode($data);
flush();

}


/* ################################ Staff master ######################################### */

else if($_REQUEST['type']=="sname_s")
{
	$data = array();
	 $sql_login  =  $database->mysqlQuery("select ser_firstname,ser_lastname from tbl_staffmaster Where ser_firstname LIKE '%".$_REQUEST['term']."%'  OR ser_lastname LIKE '%".$_REQUEST['term']."%'  "); 
	//
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$data[] = array(
				  'label' => $result_login['ser_firstname'],
			//	  ." ".$result_login['ser_lastname'] ,
				  'value' => $result_login['ser_firstname'] 
				//  ." ".$result_login['ser_lastname'] 
			  );
			}
	  }
	
		echo json_encode($data);
flush();

}
else if($_REQUEST['type']=="dep_s")
{
	$data = array();
	 $sql_login  =  $database->mysqlQuery("select distinct(tbl_departmentmaster.der_departmentname) from tbl_staffmaster LEFT JOIN tbl_departmentmaster ON tbl_staffmaster.ser_department=tbl_departmentmaster.der_departmentid Where der_departmentname LIKE '%".$_REQUEST['term']."%' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$data[] = array(
				  'label' => $result_login['der_departmentname'] ,
				  'value' => $result_login['der_departmentname']
			  );
			}
	  }
	
		echo json_encode($data);
flush();

}

else if($_REQUEST['type']=="desg_s")
{
	$data = array();
	 $sql_login  =  $database->mysqlQuery("select distinct(tbl_designationmaster.dr_designationname) from tbl_staffmaster LEFT JOIN tbl_designationmaster ON tbl_staffmaster.ser_designation=tbl_designationmaster.dr_designationid Where dr_designationname LIKE '%".$_REQUEST['term']."%' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$data[] = array(
				  'label' => $result_login['dr_designationname'] ,
				  'value' => $result_login['dr_designationname']
			  );
			}
	  }
	
		echo json_encode($data);
flush();

}
else if($_REQUEST['type']=="emp_s")
{
	$data = array();
	 $sql_login  =  $database->mysqlQuery("select distinct(ser_employeestatus) from tbl_staffmaster Where ser_employeestatus LIKE '%".$_REQUEST['term']."%' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$data[] = array(
				  'label' => $result_login['ser_employeestatus'] ,
				  'value' => $result_login['ser_employeestatus']
			  );
			}
	  }
	
		echo json_encode($data);
flush();

}

/* ################################ feedback master ######################################### */

else if($_REQUEST['type']=="feedbackqstn_q")
{
	$data = array();
	 $sql_login  =  $database->mysqlQuery("select fbm_question from tbl_feedbackmaster Where fbm_question LIKE '%".$_REQUEST['term']."%'"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$data[] = array(
				  'label' => $result_login['fbm_question'],
			//	  ." ".$result_login['ser_lastname'] ,
				  'value' => $result_login['fbm_question'] 
				//  ." ".$result_login['ser_lastname'] 
			  );
			}
	  }
	
		echo json_encode($data);
flush();

}
else if($_REQUEST['type']=="feedbackstatus_s")
{
	$data = array();
	$sr="";
	$type=strtolower($_REQUEST['term']);
	if($type=="ye")
	{
		$sr="Y";
	}elseif($type=="yes")
	{
		$sr="Y";
	}elseif($type=="n")
	{
		$sr="N";
	}elseif($type=="no")
	{
		$sr="N";
	}else
	{
		$sr=$type;
	}
	
	 $sql_login  =  $database->mysqlQuery("select distinct(fbm_active) from tbl_feedbackmaster Where fbm_active LIKE '%".$sr."%' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				
				if($result_login['fbm_active']=="Y")
				{
					$active="Yes";
				}else 
				{
					$active="No";
				}
				
			$data[] = array(
				  'label' => $active ,
				  'value' => $active
			  );
			}
	  }
	
		echo json_encode($data);
flush();

}

/* ################################ feedback rating ######################################### */
else if($_REQUEST['type']=="feedback_q")
{
	$data = array();
	 $sql_login  =  $database->mysqlQuery("select fbm_question from tbl_feedbackmaster LEFT JOIN  tbl_feedbackrating ON tbl_feedbackmaster.fbm_question=tbl_feedbackrating.fbr_fbm_id Where fbm_question LIKE '%".$_REQUEST['term']."%'"); 
	 
	 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$data[] = array(
				  'label' => $result_login['fbm_question'],
			//	  ." ".$result_login['ser_lastname'] ,
				  'value' => $result_login['fbm_question'] 
				//  ." ".$result_login['ser_lastname'] 
			  );
			}
	  }
	
		echo json_encode($data);
flush();

}
else if($_REQUEST['type']=="order_i")
{
	$data = array();
	 $sql_login  =  $database->mysqlQuery("select fbr_orderid from tbl_feedbackrating Where fbr_orderid LIKE '%".$_REQUEST['term']."%'"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$data[] = array(
				  'label' => $result_login['fbr_orderid'],
			//	  ." ".$result_login['ser_lastname'] ,
				  'value' => $result_login['fbr_orderid'] 
				//  ." ".$result_login['ser_lastname'] 
			  );
			}
	  }
	
		echo json_encode($data);
flush();

}
else if($_REQUEST['type']=="table_n")
{
	$data = array();
	 $sql_login  =  $database->mysqlQuery("select distinct (tr_tableno) FROM tbl_tablemaster LEFT JOIN tbl_feedbackrating ON tbl_tablemaster.tr_tableid=tbl_feedbackrating.fbr_table WHERE tr_tableno LIKE '%".$_REQUEST['term']."%'"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$data[] = array(
				  'label' => $result_login['tr_tableno'],
			//	  ." ".$result_login['ser_lastname'] ,
				  'value' => $result_login['tr_tableno'] 
				//  ." ".$result_login['ser_lastname'] 
			  );
			}
	  }
	
		echo json_encode($data);
flush();

}

else if($_REQUEST['type']=="rate_f")
{
	$data = array();
	 $sql_login  =  $database->mysqlQuery("select fbr_rate from tbl_feedbackrating  Where fbr_rate LIKE '%".$_REQUEST['term']."%'"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$data[] = array(
				  'label' => $result_login['fbr_rate'],
			//	  ." ".$result_login['ser_lastname'] ,
				  'value' => $result_login['fbr_rate'] 
				//  ." ".$result_login['ser_lastname'] 
			  );
			}
	  }
	
		echo json_encode($data);
flush();

}

/* ################################ Preference master ######################################### */
	
else if($_REQUEST['type']=="pref_c")
{
	$data = array();
	 $sql_login  =  $database->mysqlQuery("select distinct(pmr_name) from tbl_preferencemaster Where pmr_name LIKE '%".$_REQUEST['term']."%' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$data[] = array(
				  'label' => $result_login['pmr_name'] ,
				  'value' => $result_login['pmr_name']
			  );
			}
	  }
	
		echo json_encode($data);
flush();

}
/* ################################ Printer master ######################################### */
else if($_REQUEST['type']=="ptype_n")
{
	$data = array();
	 $sql_login  =  $database->mysqlQuery("select distinct(pt_typename) from tbl_printertype Where pt_typename LIKE '%".$_REQUEST['term']."%' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$data[] = array(
				  'label' => $result_login['pt_typename'] ,
				  'value' => $result_login['pt_typename']
			  );
			}
	  }
	
		echo json_encode($data);
flush();

}
/* ################################ Registration Name ######################################### */
else if($_REQUEST['type']=="reg_name")
{
	$data = array();
	 $sql_login  =  $database->mysqlQuery("select distinct(ly_firstname) from tbl_loyalty_reg Where ly_firstname LIKE '%".$_REQUEST['term']."%' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$data[] = array(
				  'label' => $result_login['ly_firstname'] ,
				  'value' => $result_login['ly_firstname']
			  );
			}
	  }
	
		echo json_encode($data);
flush();

}
/* ################################ Registration NO ######################################### */
else if($_REQUEST['type']=="reg_no")
{
	$data = array();
	 $sql_login  =  $database->mysqlQuery("select distinct(ly_mobileno) from tbl_loyalty_reg Where ly_mobileno LIKE '%".$_REQUEST['term']."%' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$data[] = array(
				  'label' => $result_login['ly_mobileno'] ,
				  'value' => $result_login['ly_mobileno']
			  );
			}
	  }
	
		echo json_encode($data);
flush();

}















