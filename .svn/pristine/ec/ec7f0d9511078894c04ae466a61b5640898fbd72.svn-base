<?php
error_reporting(0);
// title settings

 $sql_table_nos = "select * from tbl_languages  where ls_status='Y'";
$sql_table = $database->mysqlQuery($sql_table_nos);
$num_table = $database->mysqlNumRows($sql_table);
if ($num_table) {
    while ($result_table = $database->mysqlFetchArray($sql_table)) {
        $_SESSION['main_language'] = $result_table['ls_language'];
    }
}

if ($_SESSION['main_language_login'] != '') {
    $_SESSION['main_language'] = $_SESSION['main_language_login'];
}
//main_pages.xml
//$xml = simplexml_load_file($_SESSION['s_xmlfilelocation']) or die("Error: Cannot create object");
//if(!isset($_SESSION['login_submitbutton'])) //*********after completion, please uncomment this condition
//{
foreach ($xml->children() as $lang) {
    if ($lang->number['lang'] == $_SESSION['main_language']) {
        $_SESSION['main_language_array'] = (int) trim($lang->number);
    }
}
/*$sql_menulist= "select * from tbl_menumaster as mr LEFT JOIN tbl_menumaincategory as mc ON mr.mr_maincatid=mc.mmy_maincategoryid  LEFT JOIN tbl_menustock ON tbl_menustock.mk_menuid=mr.mr_menuid	WHERE mc.mmy_active='Y' and mr.mr_active='Y'   and tbl_menustock.mk_date='".$_SESSION['date']."'  order by mr_subcatid ";
$sql_menus  =  $database->mysqlQuery($sql_menulist); 
$num_menus  = $database->mysqlNumRows($sql_menus);
if($num_menus){
	while($result_menus  = $database->mysqlFetchArray($sql_menus)) 
		{
			$_SESSION[$result_menus['mr_menuid']]['menu']=(string) $xml->menu[$_SESSION['main_language_array']]->$result_menus['mr_menuid'];
			$_SESSION[$result_menus['mr_maincatid']]['category']=(string) $xml->category[$_SESSION['main_language_array']]->$result_menus['mr_maincatid'];
			$_SESSION[$result_menus['mr_subcatid']]['subcategory']=(string) $xml->category[$_SESSION['main_language_array']]->$result_menus['mr_subcatid'];
                                                   
                        
                }
}*/
$sql_menulist= "select * from tbl_designationmaster  order by dr_designationid ";
$sql_menus  =  $database->mysqlQuery($sql_menulist); 
$num_menus  = $database->mysqlNumRows($sql_menus);
if($num_menus){
	while($result_menus  = $database->mysqlFetchArray($sql_menus)) 
		{
			$_SESSION[$result_menus['dr_designationid']]['designation']=(string) $xml->designation[$_SESSION['main_language_array']]->$result_menus['dr_designationid'];
                                                   
                        
                }
}

$sql_menulist= "select * from tbl_menumaster  order by mr_menuid ";
$sql_menus  =  $database->mysqlQuery($sql_menulist); 
$num_menus  = $database->mysqlNumRows($sql_menus);
if($num_menus){
	while($result_menus  = $database->mysqlFetchArray($sql_menus)) 
		{
			$_SESSION[$result_menus['mr_menuid']]['menu']=(string) $xml->menu[$_SESSION['main_language_array']]->$result_menus['mr_menuid'];
                                                   
                        
                }
}
$sql_menulist= "select * from tbl_menumaincategory  order by mmy_maincategoryid ";
$sql_menus  =  $database->mysqlQuery($sql_menulist); 
$num_menus  = $database->mysqlNumRows($sql_menus);
if($num_menus){
	while($result_menus  = $database->mysqlFetchArray($sql_menus)) 
		{
			$_SESSION[$result_menus['mmy_maincategoryid']]['category']=(string) $xml->category[$_SESSION['main_language_array']]->$result_menus['mmy_maincategoryid'];
                                                   
                        
                }
}

$sql_menulist= "select * from tbl_menusubcategory  order by msy_subcategoryid ";
$sql_menus  =  $database->mysqlQuery($sql_menulist); 
$num_menus  = $database->mysqlNumRows($sql_menus);
if($num_menus){
	while($result_menus  = $database->mysqlFetchArray($sql_menus)) 
		{
			$_SESSION[$result_menus['msy_subcategoryid']]['subcategory']=(string) $xml->subcategory[$_SESSION['main_language_array']]->$result_menus['msy_subcategoryid'];
                                                   
                        
                }
}
$sql_menulist= "select * from tbl_portionmaster  order by 	pm_id ";
$sql_menus  =  $database->mysqlQuery($sql_menulist); 
$num_menus  = $database->mysqlNumRows($sql_menus);
if($num_menus){
	while($result_menus  = $database->mysqlFetchArray($sql_menus)) 
		{	$ids="pm_".$result_menus['pm_id'];
			 $_SESSION[$ids]['portion']=(string) $xml->portion[$_SESSION['main_language_array']]->$ids;
                                                   
                        
                }
}

$sql_menulist= "select * from tbl_preferencemaster  order by 	pmr_id ";
$sql_menus  =  $database->mysqlQuery($sql_menulist); 
$num_menus  = $database->mysqlNumRows($sql_menus);
if($num_menus){
	while($result_menus  = $database->mysqlFetchArray($sql_menus)) 
		{	$ids="pmr_".$result_menus['pmr_id'];
			 $_SESSION[$ids]['preference']=(string) $xml->preference[$_SESSION['main_language_array']]->$ids;
                                                   
                        
                }
}


$sql_menulist= "select * from tbl_floormaster  order by 	fr_floorid ";
$sql_menus  =  $database->mysqlQuery($sql_menulist); 
$num_menus  = $database->mysqlNumRows($sql_menus);
if($num_menus){
	while($result_menus  = $database->mysqlFetchArray($sql_menus)) 
		{	
			 $_SESSION[$result_menus['fr_floorid']]['floormaster']=(string) $xml->floormaster[$_SESSION['main_language_array']]->$result_menus['fr_floorid'];
                                                   
                        
                }
}

$sql_menulist= "select * from tbl_tablemaster  order by 	tr_tableid ";
$sql_menus  =  $database->mysqlQuery($sql_menulist); 
$num_menus  = $database->mysqlNumRows($sql_menus);
if($num_menus){
	while($result_menus  = $database->mysqlFetchArray($sql_menus)) 
		{	
			 $_SESSION[$result_menus['tr_tableid']]['tablemaster']=(string) $xml->tablemaster[$_SESSION['main_language_array']]->$result_menus['tr_tableid'];
                                                   
                        
                }
}

$sql_menulist= "select * from tbl_staffmaster  order by 	ser_staffid ";
$sql_menus  =  $database->mysqlQuery($sql_menulist); 
$num_menus  = $database->mysqlNumRows($sql_menus);
if($num_menus){
	while($result_menus  = $database->mysqlFetchArray($sql_menus)) 
		{	$first="First_".$result_menus['ser_staffid'];$last="Last_".$result_menus['ser_staffid'];
			  $_SESSION[$result_menus['ser_staffid']]['staffmaster_first']=(string) $xml->staffmaster[$_SESSION['main_language_array']]->$first;
			   $_SESSION[$result_menus['ser_staffid']]['staffmaster_last']=(string) $xml->staffmaster[$_SESSION['main_language_array']]->$last;
                                                   
                        
                }
}
$sql_menulist= "select * from tbl_discountmaster  order by 	ds_discountid ";
$sql_menus  =  $database->mysqlQuery($sql_menulist); 
$num_menus  = $database->mysqlNumRows($sql_menus);
if($num_menus){
	while($result_menus  = $database->mysqlFetchArray($sql_menus)) 
		{	
		 $_SESSION[$result_menus['ds_discountid']]['discount']=(string) $xml->discount[$_SESSION['main_language_array']]->$result_menus['ds_discountid'];       
                }
}
$sql_menulist= "select * from tbl_credit_types  order by  ct_creditid ";
$sql_menus  =  $database->mysqlQuery($sql_menulist); 
$num_menus  = $database->mysqlNumRows($sql_menus);
if($num_menus){
	while($result_menus  = $database->mysqlFetchArray($sql_menus)) 
		{	$ids1="ctype_".$result_menus['ct_creditid'];
			$ids2="clabel_".$result_menus['ct_creditid'];
		 $_SESSION[$result_menus['ct_creditid']]['credittypes_type']=(string) $xml->credittypes[$_SESSION['main_language_array']]->$ids1;  
		  $_SESSION[$result_menus['ct_creditid']]['credittypes_label']=(string) $xml->credittypes[$_SESSION['main_language_array']]->$ids2;       
                }
}
$sql_menulist= "select * from tbl_paymentmode  order by  pym_id ";
$sql_menus  =  $database->mysqlQuery($sql_menulist); 
$num_menus  = $database->mysqlNumRows($sql_menus);
if($num_menus){
	while($result_menus  = $database->mysqlFetchArray($sql_menus)) 
		{	$ids1="pname_".$result_menus['pym_id'];
		 $_SESSION[$result_menus['pym_id']]['paymentmode']=(string) $xml->paymentmode[$_SESSION['main_language_array']]->$ids1;  
                }
}

$sql_menulist= "select * from tbl_bankmaster  order by  bm_id ";
$sql_menus  =  $database->mysqlQuery($sql_menulist); 
$num_menus  = $database->mysqlNumRows($sql_menus);
if($num_menus){
	while($result_menus  = $database->mysqlFetchArray($sql_menus)) 
		{	$ids1="bm_".$result_menus['bm_id'];
		 $_SESSION[$result_menus['bm_id']]['bankmaster']=(string) $xml->bankmaster[$_SESSION['main_language_array']]->$ids1;  
                }
}
$sql_menulist= "select * from tbl_couponcompany  order by  cy_coupid ";
$sql_menus  =  $database->mysqlQuery($sql_menulist); 
$num_menus  = $database->mysqlNumRows($sql_menus);
if($num_menus){
	while($result_menus  = $database->mysqlFetchArray($sql_menus)) 
		{	$ids1="coup_".$result_menus['cy_coupid'];
		 $_SESSION[$result_menus['cy_coupid']]['coupon']=(string) $xml->coupon[$_SESSION['main_language_array']]->$ids1;  
                }
}
$sql_menulist= "select * from tbl_corporatemaster  order by  ct_corporatecode ";
$sql_menus  =  $database->mysqlQuery($sql_menulist); 
$num_menus  = $database->mysqlNumRows($sql_menus);
if($num_menus){
	while($result_menus  = $database->mysqlFetchArray($sql_menus)) 
		{	
		 $_SESSION[$result_menus['ct_corporatecode']]['corporate']=(string) $xml->corporate[$_SESSION['main_language_array']]->$result_menus['ct_corporatecode'];        
                }
}

$sql_menulist= "select * from tbl_roommaster  order by  rm_roomid ";
$sql_menus  =  $database->mysqlQuery($sql_menulist); 
$num_menus  = $database->mysqlNumRows($sql_menus);
if($num_menus){
	while($result_menus  = $database->mysqlFetchArray($sql_menus)) 
		{	$ids1="rm_".$result_menus['rm_roomid'];
		 $_SESSION[$result_menus['rm_roomid']]['roommaster']=(string) $xml->roommaster[$_SESSION['main_language_array']]->$ids1;        
                }
}


//}