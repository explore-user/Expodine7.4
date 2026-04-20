<?php
//include('includes/session.php');		// Check session
session_start();
include("database.class.php"); // DB Connection class
$database	= new Database(); 		// Create a new instance
	/* ******************************************** Checking already existing menu  ******************************************************* */
 if($_REQUEST['value']=="checkmenu")
	 {
		$test= $_REQUEST['mid'];
	
	 $sql_login  =  $database->mysqlQuery("select (mr_menuname) from tbl_menumaster where mr_menuname='$test'"); 
	
	  
      $num_login   = $database->mysqlNumRows($sql_login);

	 
	  if($num_login =='1')
	  {
		 echo 'sorry';
	  }
	  else
	  {
		echo 'ok';
	  }
	 }
         
      else if($_REQUEST['value']=="checshortcode")
	 {
		$test1= $_REQUEST['mid1'];
           
	
	 $sql_login  =  $database->mysqlQuery("select (mr_itemcode) from tbl_menumaster where mr_itemcode='$test1'"); 
	
	  
      $num_login   = $database->mysqlNumRows($sql_login);

	 
	  if($num_login =='1')
	  {
		 echo 'sorry';
	  }
	  else
	  {
		echo 'ok';
	  }
	 }   
       else if($_REQUEST['value']=="checkplu")
	 {
		$test1= $_REQUEST['mid'];
           
	
	 $sql_login  =  $database->mysqlQuery("select mr_plu from tbl_menumaster where mr_plu='$test1'"); 
	
	  
      $num_login   = $database->mysqlNumRows($sql_login);

	 
	  if($num_login =='1')
	  {
		 echo 'sorry';
	  }
	  else
	  {
		echo 'ok';
	  }
          
	 }   
           else if($_REQUEST['value']=="checkcentral")
	 {
		$test1= $_REQUEST['mid'];
           
	
	 $sql_login  =  $database->mysqlQuery("select mr_central_id from tbl_menumaster where mr_central_id='$test1'"); 
	
	  
      $num_login   = $database->mysqlNumRows($sql_login);

	 
	  if($num_login =='1')
	  {
		 echo 'sorry';
	  }
	  else
	  {
		echo 'ok';
	  }
          
	 }
         else if($_REQUEST['value']=="checkcentral_edit")
	 {
		$test1= $_REQUEST['mid1'];
           
	$id1=$_REQUEST['id1'];
        
	 $sql_login  =  $database->mysqlQuery("select mr_central_id from tbl_menumaster where mr_central_id='$test1' and mr_menuid<>'$id1'  "); 
	
	  
      $num_login   = $database->mysqlNumRows($sql_login);

	 
	  if($num_login =='1')
	  {
		 echo 'sorry';
	  }
	  else
	  {
		echo 'ok';
	  }
          
	 }    
	else if($_REQUEST['value']=="checkplu_edit")
	 {
		$test1= $_REQUEST['mid1'];
           
	$id1=$_REQUEST['id1'];
        
	 $sql_login  =  $database->mysqlQuery("select mr_plu from tbl_menumaster where mr_plu='$test1' and mr_menuid<>'$id1'  "); 
	
	  
      $num_login   = $database->mysqlNumRows($sql_login);

	 
	  if($num_login =='1')
	  {
		 echo 'sorry';
	  }
	  else
	  {
		echo 'ok';
	  }
          
	 }    
	 
else if($_REQUEST['value']=="checkmenuedit")
	 {
		$test1= $_REQUEST['menid'];
		$id1=$_REQUEST['idnew'];
		
	$sql_login  =  $database->mysqlQuery("select (mr_menuname) from tbl_menumaster where mr_menuname='$test1' and mr_menuid<>'$id1' ");
	
      $num_login   = $database->mysqlNumRows($sql_login);
//echo $num_login;
//die();
	  if($num_login =='0' )
	  {
		 echo 'ok';
	  }
	  else
	  {
		echo 'sorry';
	  }
	 }
         
         else if($_REQUEST['value']=="check_discount_item")
	 {
		$mid_dis= $_REQUEST['menu_id'];
		$dis_id=$_REQUEST['dis_id'];
		
	$sql_login  =  $database->mysqlQuery("select (md_menuid) from  tbl_menu_discount where md_menuid='$mid_dis'  ");
	
      $num_login   = $database->mysqlNumRows($sql_login);

	  if($num_login =='0' )
	  {
		 echo 'ok';
	  }
	  else
	  {
		echo 'sorry';
	  }
	 }
      
     else if($_REQUEST['value']=="checkitemcodedit")
	 {
		$test3= $_REQUEST['shortcode'];
		$test4=$_REQUEST['tsid'];
	
	 $sql_login  =  $database->mysqlQuery("select (mr_itemcode) from tbl_menumaster where mr_itemcode='$test3' and mr_menuid<>'$test4'"); 
	
	  
      $num_login   = $database->mysqlNumRows($sql_login);
//echo $num_login;
	 
	  if($num_login =='0')
	  {
		 echo 'ok';
	  }
	  else
	  {
		echo 'sorry';
	  }
	 }    
         
	 
else if($_REQUEST['value']=="checkcat")
	 {
		$test= $_REQUEST['mid'];
            	
	 $sql_login  =  $database->mysqlQuery("select (mmy_maincategoryname) from tbl_menumaincategory where mmy_maincategoryname='$test'"); 
	
	  
      $num_login   = $database->mysqlNumRows($sql_login);

	 
	  if($num_login =='1')
	  {
		 echo 'sorry';
	  }
	  else
	  {
		echo 'ok';
	  }
	 }
         
         
     else if($_REQUEST['value']=="checkextra")
	 {
		$test= $_REQUEST['mid'];
            	
	 $sql_login  =  $database->mysqlQuery("select (amc_name) from tbl_extra_tax_master where amc_name='$test'"); 
	
	  
      $num_login   = $database->mysqlNumRows($sql_login);

	 
	  if($num_login =='1')
	  {
		 echo 'sorry';
	  }
	  else
	  {
		echo 'ok';
	  }
	 }   
         
         else if($_REQUEST['value']=="extrataxsymbol")
	 {
		$test1= $_REQUEST['mid1'];
            	
	 $sql_login  =  $database->mysqlQuery("select (amc_symbol) from tbl_extra_tax_master where amc_symbol='$test1'"); 
	
	  
      $num_login   = $database->mysqlNumRows($sql_login);

	 
	  if($num_login =='1')
	  {
		 echo 'sorry';
	  }
	  else
	  {
		echo 'ok';
	  }
	 } 
         
          else if($_REQUEST['value']=="extrataxsymbol1")
	 {
		$test11= $_REQUEST['mid11'];
            	
	 $sql_login  =  $database->mysqlQuery("select (amc_symbol) from tbl_extra_tax_master where amc_symbol='$test11'"); 
	
	  
      $num_login   = $database->mysqlNumRows($sql_login);

	 
	  if($num_login =='1')
	  {
		 echo 'sorry';
	  }
	  else
	  {
		echo 'ok';
	  }
	 } 
         
         else if($_REQUEST['value']=="checkextraedit")
	 {
		$test2= $_REQUEST['mid'];
		$taxid=$_REQUEST['taxtid'];
	
	 $sql_login  =  $database->mysqlQuery("select (amc_name) from tbl_extra_tax_master where amc_name='$test2' and amc_id<>'$taxid'"); 
	
	  
      $num_login   = $database->mysqlNumRows($sql_login);
//echo $num_login;
	 
	  if($num_login =='0')
	  {
		 echo 'ok';
	  }
	  else
	  {
		echo 'sorry';
	  }
	 }
         
         
         else if($_REQUEST['value']=="checkorderprint")
	 {
		$test1= $_REQUEST['mid1'];
           
	
	 $sql_login  =  $database->mysqlQuery("select (mmy_orderof_print) from tbl_menumaincategory where mmy_orderof_print='$test1'"); 
	
	  
      $num_login   = $database->mysqlNumRows($sql_login);

	 
	  if($num_login =='1')
	  {
		 echo 'sorry';
	  }
	  else
	  {
		echo 'ok';
	  }
	 }
         
         
         
    
	 else if($_REQUEST['value']=="checkcatedit")
	 {
		$test2= $_REQUEST['catid'];
		$catid=$_REQUEST['catidchk'];
	
	 $sql_login  =  $database->mysqlQuery("select (mmy_maincategoryname) from tbl_menumaincategory where mmy_maincategoryname='$test2' and mmy_maincategoryid<>'$catid'"); 
	
	  
      $num_login   = $database->mysqlNumRows($sql_login);
//echo $num_login;
	 
	  if($num_login =='0')
	  {
		 echo 'ok';
	  }
	  else
	  {
		echo 'sorry';
	  }
	 }
         
          else if($_REQUEST['value']=="checkodprintedit")
	 {
		$test3= $_REQUEST['orderprint'];
		$test4=$_REQUEST['opid'];
	
	 $sql_login  =  $database->mysqlQuery("select (mmy_orderof_print) from tbl_menumaincategory where mmy_orderof_print='$test3' and mmy_maincategoryid<>'$test4'"); 
	
	  
      $num_login   = $database->mysqlNumRows($sql_login);
//echo $num_login;
	 
	  if($num_login =='0')
	  {
		 echo 'ok';
	  }
	  else
	  {
		echo 'sorry';
	  }
	 }
	 
	 else if($_REQUEST['value']=="checkbankedit"   )
	 {
		$test2= $_REQUEST['catid'];
		$catid=$_REQUEST['catidchk'];
	
	 $sql_login  =  $database->mysqlQuery("select (bm_name) from tbl_bankmaster where bm_name='$test2' and bm_id<>'$catid'"); 
	
	  
      $num_login   = $database->mysqlNumRows($sql_login);
//echo $num_login;
	 
	  if($num_login =='0')
	  {
		 echo 'ok';
	  }
	  else
	  {
		echo 'sorry';
	  }
	 
		 
	 }
	 
	else if($_REQUEST['value']=="checksubcat")
	 {
		$test= $_REQUEST['mid'];
	
	 $sql_login  =  $database->mysqlQuery("select (msy_subcategoryname) from tbl_menusubcategory where msy_subcategoryname='$test'"); 
	
	  
      $num_login   = $database->mysqlNumRows($sql_login);

	 
	  if($num_login =='1')
	  {
		 echo 'sorry';
	  }
	  else
	  {
		echo 'ok';
	  }
	 }
	else if($_REQUEST['value']=="checksubcatedit")
	 {
		$test3= $_REQUEST['subcatidchk'];
			$test4= $_REQUEST['subcatid'];
	
	 $sql_login  =  $database->mysqlQuery("select (msy_subcategoryname) from tbl_menusubcategory where msy_subcategoryname='$test4' and msy_subcategoryid<>'$test3' "); 
	
	  
      $num_login   = $database->mysqlNumRows($sql_login);
	  

	 
	  if($num_login =='0')
	  {
		 echo 'ok';
	  }
	  else
	  {
		echo 'sorry';
	  }
	 }
	 else if($_REQUEST['value']=="checkportion")
	 {
		$test= $_REQUEST['mid'];
	
	 $sql_login  =  $database->mysqlQuery("select (pm_portionname) from tbl_portionmaster where pm_portionname='$test'"); 
	
	  
      $num_login   = $database->mysqlNumRows($sql_login);

	 
	  if($num_login =='1')
	  {
		 echo 'sorry';
	  }
	  else
	  {
		echo 'ok';
	  }
	 } 
	 
	 else if($_REQUEST['value']=="checkprtnedit")
	 {
		$test5= $_REQUEST['prtnid'];
		$test6= $_REQUEST['prtnidchk'];
	 $sql_login  =  $database->mysqlQuery("select (pm_portionname) from tbl_portionmaster where pm_portionname='$test5' and pm_id<>'$test6' "); 
     $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login =='0')
	  {
		 echo 'ok';
	  }
	  else
	  {
		echo 'sorry';
	  }
	 }
	 
	  else if($_REQUEST['value']=="checkprefrnc")
	 {
		$test= $_REQUEST['mid'];
	
	 $sql_login  =  $database->mysqlQuery("select (pmr_name) from tbl_preferencemaster where pmr_name='$test'"); 
	
	  
      $num_login   = $database->mysqlNumRows($sql_login);

	 
	  if($num_login =='1')
	  {
		 echo 'sorry';
	  }
	  else
	  {
		echo 'ok';
	  }
	 } 
	   else if($_REQUEST['value']=="addonadd")
	 {
		$test= $_REQUEST['mid'];
	
	 $sql_login  =  $database->mysqlQuery("select (ma_name) from tbl_menu_addon_master where ma_name='$test'"); 
	
	  
      $num_login   = $database->mysqlNumRows($sql_login);

	 
	  if($num_login =='1')
	  {
		 echo 'sorry';
	  }
	  else
	  {
		echo 'ok';
	  }
	 }
         
         else if($_REQUEST['value']=="mobileadd_loyalty")
	 {
		$test= $_REQUEST['mid'];
	
	 $sql_login  =  $database->mysqlQuery("select (ly_mobileno) from tbl_loyalty_reg where ly_mobileno='$test'"); 
	
	  
      $num_login   = $database->mysqlNumRows($sql_login);

	 
	  if($num_login)
	  {
		 echo 'sorry';
	  }
	  else
	  {
		echo 'ok';
	  }
	 }
         else if($_REQUEST['value']=="mobileadd_loyalty_edit")
	 {
		$test= $_REQUEST['mid'];
	
	 $sql_login  =  $database->mysqlQuery("select (ly_mobileno) from tbl_loyalty_reg where ly_mobileno='$test' and ly_id<>'".$_REQUEST['ly_id']."'"); 
	
	  
      $num_login   = $database->mysqlNumRows($sql_login);

	 
	  if($num_login)
	  {
		 echo 'sorry';
	  }
	  else
	  {
		echo 'ok';
	  }
	 }
          else if($_REQUEST['value']=="mailadd_loyalty")
	 {
		$test= $_REQUEST['mid'];
	
	 $sql_login  =  $database->mysqlQuery("select (ly_emailid) from tbl_loyalty_reg where ly_emailid='$test'"); 
	
	  
      $num_login   = $database->mysqlNumRows($sql_login);

	 
	  if($num_login)
	  {
		 echo 'sorry';
	  }
	  else
	  {
		echo 'ok';
	  }
	 }
          else if($_REQUEST['value']=="mailadd_loyalty_edit")
	 {
		$test= $_REQUEST['mid'];
	
	 $sql_login  =  $database->mysqlQuery("select (ly_emailid) from tbl_loyalty_reg where ly_emailid='$test' and ly_id<>'".$_REQUEST['ly_id']."'"); 
	
	  
      $num_login   = $database->mysqlNumRows($sql_login);

	 
	  if($num_login)
	  {
		 echo 'sorry';
	  }
	  else
	  {
		echo 'ok';
	  }
	 }
          else if($_REQUEST['value']=="unitadd")
	 {
		$test= $_REQUEST['mid'];
	
	 $sql_login  =  $database->mysqlQuery("select (u_name) from tbl_unit_master where u_name='$test'"); 
	
	  
      $num_login   = $database->mysqlNumRows($sql_login);

	 
	  if($num_login =='1')
	  {
		 echo 'sorry';
	  }
	  else
	  {
		echo 'ok';
	  }
	 } 
         else if($_REQUEST['value']=="baseunitadd")
	 {
		$test= $_REQUEST['mid'];
	
	 $sql_login  =  $database->mysqlQuery("select (bu_name) from tbl_base_unit_master where bu_name='$test'"); 
	
	  
      $num_login   = $database->mysqlNumRows($sql_login);

	 
	  if($num_login =='1')
	  {
		 echo 'sorry';
	  }
	  else
	  {
		echo 'ok';
	  }
	 }
	 else if($_REQUEST['value']=="checkprefrncedit")
	 {
		$test7= $_REQUEST['mid'];
			$test8= $_REQUEST['prefidchk'];
	 $sql_login  =  $database->mysqlQuery("select (pmr_name) from tbl_preferencemaster where pmr_name='$test7' and pmr_id<>'$test8' "); 
      $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login =='0')
	  {
		 echo 'ok';
	  }
	  else
	  {
		echo 'sorry';
	  }
	 } 
	 else if($_REQUEST['value']=="addonedit")
	 {
		$test7= $_REQUEST['mid'];
			$test8= $_REQUEST['prefidchk'];
	 $sql_login  =  $database->mysqlQuery("select (ma_name) from tbl_menu_addon_master where ma_name='$test7' and ma_id<>'$test8' "); 
      $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login =='0')
	  {
		 echo 'ok';
	  }
	  else
	  {
		echo 'sorry';
	  }
	 } 
	// 
	 else if($_REQUEST['value']=="checkcountry")
	 {
		$test= $_REQUEST['mid'];
	
	 $sql_login  =  $database->mysqlQuery("select (cy_countryname) from tbl_country where cy_countryname='$test'"); 
	
	  
      $num_login   = $database->mysqlNumRows($sql_login);

	 
	  if($num_login =='1')
	  {
		 echo 'sorry';
	  }
	  else
	  {
		echo 'ok';
	  }
	 } 
	 
	else if($_REQUEST['value']=="checkvalue")
	 {
		$test= $_REQUEST['mid'];
		
		$sql="select (sr_salevalue) from tbl_sms_report_slab where sr_salevalue='$test'";
	 $sql_login1  =  $database->mysqlQuery("select (sr_salevalue) from tbl_sms_report_slab where sr_salevalue='$test'"); 
	
      $num_login1   = $database->mysqlNumRows($sql_login1);

	
	 
	  if($num_login1=='1')
		  
		  {	 
		echo "sorry";
		
	  }
	  else{
		  
		  echo "ok";  
	 
	 } 
	 } 
	 
	else if($_REQUEST['value']=="checkvalue1")
	 {
		$test= $_REQUEST['mid'];

		$sql2="SELECT  MAX(sr_salevalue) FROM tbl_sms_report_slab GROUP BY sr_salevalue HAVING MAX(sr_salevalue)>'$test'";
	  
	$sql_login2= $database->mysqlQuery("SELECT  MAX(sr_salevalue) FROM tbl_sms_report_slab GROUP BY sr_salevalue HAVING MAX(sr_salevalue)>'$test' ");
	
      
	$num_login2   = $database->mysqlNumRows($sql_login2);
	
	 
	  if($num_login2)
		  
		  {	 
		echo "sorry";
		
	  }
	  else{
		  
		  echo "ok";  
	 
	 } 
	 }
	 
	
		 else if($_REQUEST['value']=="checkcountryedit")
	 {
		$test7= $_REQUEST['countryid'];
			$test8= $_REQUEST['countryidchk'];
	
	 $sql_login  =  $database->mysqlQuery("select (cy_countryname) from tbl_country where cy_countryname='$test7' and cy_countyid<>'$test8' "); 
	
	  
      $num_login   = $database->mysqlNumRows($sql_login);
	  

	 
	  if($num_login =='0')
	  {
		 echo 'ok';
	  }
	  else
	  {
		echo 'sorry';
	  }
	 }
	
	else if($_REQUEST['value']=="checkheadedit")
	 {
		$test7= $_REQUEST['countryidchk'];
			
	
	 $sql_login  =  $database->mysqlQuery("select * from tbl_sms_report_slab where sr_id='$test7' "); 
	
	  
      $num_login   = $database->mysqlNumRows($sql_login);
	  

	 
	  if($num_login =='0')
	  {
		 echo 'ok';
	  }
	  else
	  {
		echo 'sorry';
	  }
	 }
	 else if($_REQUEST['value']=="checkstate")
	 {
		$test= $_REQUEST['mid'];
		$cntry=$_REQUEST['cntry'];
	
	 $sql_login  =  $database->mysqlQuery("select (se_statename) from tbl_state INNER JOIN tbl_country ON tbl_state.se_countryid=tbl_country.cy_countyid where se_statename='$test' and se_countryid='$cntry'"); 
	
	  
      $num_login   = $database->mysqlNumRows($sql_login);

	 
	  if($num_login =='1')
	  {
		 echo 'sorry';
	  }
	  else
	  {
		echo 'ok';
	  }
	 } 
	
	 
	 	 else if($_REQUEST['value']=="checkstateedit")
	 {
		$test9= $_REQUEST['statename'];
			$test10= $_REQUEST['stateidchk'];
	
	 $sql_login  =  $database->mysqlQuery("select (se_statename) from tbl_state where se_statename='$test9' and se_stateid<>'$test10' "); 
	
	  
      $num_login   = $database->mysqlNumRows($sql_login);
	  

	 
	  if($num_login =='0')
	  {
		 echo 'ok';
	  }
	  else
	  {
		echo 'sorry';
	  }
	 }
	 
	  else if($_REQUEST['value']=="checkcity")
	 {
		$test= $_REQUEST['mid'];
		$cntryid=$_REQUEST['cntryid'];
		$state=$_REQUEST['state'];
	
	 $sql_login  =  $database->mysqlQuery("select (cy_cityname) from tbl_city where cy_cityname='$test' and cy_countryid='$cntryid' and cy_stateid='$state' "); 
	
	  
      $num_login   = $database->mysqlNumRows($sql_login);

	 
	  if($num_login =='1')
	  {
		 echo 'sorry';
	  }
	  else
	  {
		echo 'ok';
	  }
	 }  
	 
	 
	 	 else if($_REQUEST['value']=="checkcityedit")
	 {
		$test11= $_REQUEST['cityname'];
			$test12= $_REQUEST['cityidchk'];
			$country=$_REQUEST['country'];
			$state=$_REQUEST['state'];
	
	 $sql_login  =  $database->mysqlQuery("select (cy_cityname) from tbl_city where cy_cityname='$test11' and cy_cityid<>'$test12' and cy_countryid='$country' and cy_stateid='$state'"); 
      $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login =='0')
	  {
		 echo 'ok';
	  }
	  else
	  {
		echo 'sorry';
	  }
	 }
	
	 
	   else if($_REQUEST['value']=="checkkot")
	 {
		$kot= $_REQUEST['mid'];
		$brnnn=$_REQUEST['brch'];
	
	 $sql_login  =  $database->mysqlQuery("  select (kr_kotname) from tbl_kotcountermaster INNER JOIN tbl_branchmaster ON tbl_kotcountermaster.kr_branchid=tbl_branchmaster.be_branchid where kr_kotname='$kot' and kr_branchid='$brnnn'"); 
	
	
      $num_login   = $database->mysqlNumRows($sql_login);

	 
	  if($num_login =='1')
	  {
		 echo 'sorry';
	  }
	  else
	  {
		echo 'ok';
	  }
	 }  
	 
	  	 else if($_REQUEST['value']=="checkkotedit")
	 {
		$test13= $_REQUEST['kotname'];
			$test14= $_REQUEST['kotidchk'];
			$test30= $_REQUEST['brn'];
	
	 $sql_login  =  $database->mysqlQuery("select (kr_kotname) from tbl_kotcountermaster INNER JOIN tbl_branchmaster ON tbl_kotcountermaster.kr_branchid=tbl_branchmaster.be_branchid where kr_kotname='$test13' and kr_branchid='$test30' and kr_kotcode<>'$test14' ");
	
      $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login =='0')
	  {
		 echo 'ok';
	  }
	  else
	  {
		echo 'sorry';
	  }
	 }
	   else if($_REQUEST['value']=="checkfloor")
	 {
		$floorr= $_REQUEST['mid'];
		$branch=$_REQUEST['brch'];
	
	 $sql_login  =  $database->mysqlQuery("select (fr_floorname) from tbl_floormaster INNER JOIN tbl_branchmaster ON tbl_floormaster.fr_branchid=tbl_branchmaster.be_branchid where fr_floorname='$floorr' and fr_branchid='$branch'"); 
	
	  
      $num_login   = $database->mysqlNumRows($sql_login);

	 if($num_login =='0')
	  {
		 echo 'ok';
	  }
	  else
	  {
		echo 'sorry';
	  }
	 }
         
          
         
         
	  else if($_REQUEST['value']=="checkflooredit")
	 {
		$test15= $_REQUEST['floorname'];
			$test16= $_REQUEST['flooridchk'];
			$test20=$_REQUEST['br'];
	
	 $sql_login  =  $database->mysqlQuery("select (fr_floorname) from tbl_floormaster INNER JOIN tbl_branchmaster ON tbl_floormaster.fr_branchid=tbl_branchmaster.be_branchid where fr_floorname='$test15' and fr_branchid='$test20' and fr_floorid<>'$test16' "); 
      $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login =='1')
	  {
		 echo 'sorry';
	  }
	  else
	  {
		echo 'ok';
	  }
	 }
	 
	  else if($_REQUEST['value']=="checktable")
	 {
		$table= $_REQUEST['mid'];
		$flr=$_REQUEST['flor'];
		$brnch=$_REQUEST['brn'];
	
	 $sql_login  =  $database->mysqlQuery("select (tr_tableno),fr_floorname,be_branchname from tbl_tablemaster INNER JOIN tbl_floormaster ON tbl_tablemaster.tr_floorid=tbl_floormaster.fr_floorid INNER JOIN tbl_branchmaster ON tbl_tablemaster.tr_branchid=tbl_branchmaster.be_branchid  where tr_tableno='$table' and tr_branchid='$brnch' and tr_floorid='$flr'"); 
	
	  
      $num_login   = $database->mysqlNumRows($sql_login);

	 
	  if($num_login =='1')
	  {
		 echo 'sorry';
	  }
	  else
	  {
		echo 'ok';
	  }
	 }  
	  else if($_REQUEST['value']=="checktableedit")
	 {
		$tablid=$_REQUEST['tabid'];
		$test17= $_REQUEST['tid'];
			$test20= $_REQUEST['flr'];
			$test19=$_REQUEST['brnch'];
	 $sql_login  =  $database->mysqlQuery("select (tr_tableno),fr_floorname,be_branchname from tbl_tablemaster INNER JOIN tbl_floormaster ON tbl_tablemaster.tr_floorid=tbl_floormaster.fr_floorid INNER JOIN tbl_branchmaster ON tbl_tablemaster.tr_branchid=tbl_branchmaster.be_branchid  where tr_tableno='$test17' and tr_branchid='$test19' and tr_floorid='$test20' and tr_tableid<>'$tablid'");
	// $sql_login  =  $database->mysqlQuery("select (tr_tableno) from tbl_tablemaster where tr_tableno='$test17' and tr_tableid<>'$test18' "); 
      $num_login   = $database->mysqlNumRows($sql_login);
	 
	  if($num_login =='0')
	  {
		 echo 'ok';
	  }
	  else
	  {
		echo 'sorry';
	  }
	 }
	 
	 
	  else if($_REQUEST['value']=="checkprinterkot")
	 {
		$ptype= $_REQUEST['typeid'];
		$floor=$_REQUEST['flr'];
	$kot=$_REQUEST['kot'];
	$brnch=$_REQUEST['brnch'];
	$printer=$_REQUEST['printername'];
	 $sql_login  =  $database->mysqlQuery("select (pr_printername) from tbl_printersettings where pr_floorid='$floor' and pr_printertype='$ptype' and pr_kotcode='$kot' and pr_branchid='$brnch' and pr_printername='$printer'"); 
      $num_login   = $database->mysqlNumRows($sql_login);

	 
	  if($num_login =='1')
	  {
		 echo 'sorry';
	  }
	  else
	  {
		echo 'ok';
	  }
	 } 
	 
	   else if($_REQUEST['value']=="checkprinter")
	 {
		$ptype= $_REQUEST['typeid'];
		$floor=$_REQUEST['flr'];
			$brnch=$_REQUEST['brnch'];
	//$kot=$_REQUEST['kot'];
	$printer=$_REQUEST['printername'];
	 $sql_login  =  $database->mysqlQuery("select (pr_printername) from tbl_printersettings where pr_floorid='$floor' and pr_printertype='$ptype' and pr_branchid='$brnch' and pr_printername='$printer'"); 
	
      $num_login   = $database->mysqlNumRows($sql_login);

	 
	  if($num_login =='1')
	  {
		 echo 'sorry';
	  }
	  else
	  {
		echo 'ok';
	  }
	 } 
	   else if($_REQUEST['value']=="checkprintkotedit")
	 {
		 
		$test35= $_REQUEST['type1'];
			$test36= $_REQUEST['printeridchk'];
			$test37=$_REQUEST['floor1'];
			$test38=$_REQUEST['kot1'];
			$printer1=$_REQUEST['printername1'];
			$br1=$_REQUEST['br1'];
			

	 $sql_login  =  $database->mysqlQuery("select * from tbl_printersettings LEFT JOIN tbl_branchmaster ON tbl_printersettings.pr_branchid=tbl_branchmaster.be_branchid LEFT JOIN tbl_floormaster ON tbl_printersettings.pr_floorid=tbl_floormaster.fr_floorid LEFT JOIN tbl_printertype ON tbl_printersettings.pr_printertype=tbl_printertype.pt_id LEFT JOIN tbl_kotcountermaster ON tbl_printersettings.pr_kotcode=tbl_kotcountermaster.kr_kotcode where pr_printertype='$test35' and pr_floorid='$test37' and pr_kotcode='$test38' and pr_printername='$printer1' and pr_branchid='$br1' and pr_id<>'$test36'");
	// $sql_login  =  $database->mysqlQuery("select (tr_tableno) from tbl_tablemaster where tr_tableno='$test17' and tr_tableid<>'$test18' "); 
      $num_login   = $database->mysqlNumRows($sql_login);
	 
	  if($num_login =='0')
	  {
		 echo 'ok';
	  }
	  else
	  {
		echo 'sorry';
	  }
	 }
         
         
         
//        else if($_REQUEST['value']=="checkprintkotedit1")
//	 {
//		 
//		$test35= $_REQUEST['type1'];
//			$test36= $_REQUEST['printeridchk'];
//			$test37=$_REQUEST['floor1'];
//			$test38=$_REQUEST['kot1'];
//                        $test39=$_REQUEST['uname'];
//                        $test40=$_REQUEST['port'];
//                        $test41=$_REQUEST['usb'];
//                        $test42=$_REQUEST['status'];
//                        $test43=$_REQUEST['usbip'];
//                        $test44=$_REQUEST['lanip'];
//                        $test45=$_REQUEST['prcount'];
//                        $test46=$_REQUEST['style'];
//			$printer1=$_REQUEST['printername1'];
//			$br1=$_REQUEST['br1'];
//			
//
//	 $sql_login  =  $database->mysqlQuery("select * from tbl_printersettings LEFT JOIN tbl_branchmaster ON tbl_printersettings.pr_branchid=tbl_branchmaster.be_branchid LEFT JOIN tbl_floormaster ON tbl_printersettings.pr_floorid=tbl_floormaster.fr_floorid LEFT JOIN tbl_printertype ON tbl_printersettings.pr_printertype=tbl_printertype.pt_id LEFT JOIN tbl_kotcountermaster ON tbl_printersettings.pr_kotcode=tbl_kotcountermaster.kr_kotcode where pr_printertype='$test35' and pr_floorid='$test37' and pr_kotcode='$test38' and pr_usbprinter='$test39' and pr_printerport='$test40' and pr_defaultusb='$test41' and pr_usbprinterip='$test43' and pr_printerip='$test44' and pr_printcount='$test45' and pr_style='$test46' and pr_enable='$test42' and pr_printername='$printer1' and pr_branchid='$br1' and pr_id<>'$test36'");
//	// $sql_login  =  $database->mysqlQuery("select (tr_tableno) from tbl_tablemaster where tr_tableno='$test17' and tr_tableid<>'$test18' "); 
//      $num_login   = $database->mysqlNumRows($sql_login);
//	 
//	  if($num_login =='0')
//	  {
//		 echo 'ok';
//	  }
//	  else
//	  {
//		echo 'sorry';
//	  }
//	 }   
//         
         
         
         

         
//          else if($_REQUEST['value']=="checkprintkotedit1")
//	 {
//		 
//		$test35= $_REQUEST['ptypes'];
//			$test36= $_REQUEST['pips'];
//			$test37=$_REQUEST['pports'];
//			$test38=$_REQUEST['pnames'];
//			//$printer1=$_REQUEST['printername1'];
//			$br1=$_REQUEST['br1'];
//			
//
//	 $sql_login  =  $database->mysqlQuery("select * from tbl_printersettings LEFT JOIN tbl_branchmaster ON tbl_printersettings.pr_branchid=tbl_branchmaster.be_branchid LEFT JOIN tbl_floormaster ON tbl_printersettings.pr_floorid=tbl_floormaster.fr_floorid LEFT JOIN tbl_printertype ON tbl_printersettings.pr_printertype=tbl_printertype.pt_id LEFT JOIN tbl_kotcountermaster ON tbl_printersettings.pr_kotcode=tbl_kotcountermaster.kr_kotcode where pr_printertype='$test35' and pr_printerip='$test36' and pr_printerport='$test37' and pr_printername='$test38' and pr_branchid='$br1'");
//	// $sql_login  =  $database->mysqlQuery("select (tr_tableno) from tbl_tablemaster where tr_tableno='$test17' and tr_tableid<>'$test18' "); 
//      $num_login   = $database->mysqlNumRows($sql_login);
//	 
//	  if($num_login =='0')
//	  {
//		 echo 'ok';
//	  }
//	  else
//	  {
//		echo 'sorry';
//	  }
//	 }
         
         
	 
	 
	 else if($_REQUEST['value']=="checkprintedit")
	 {
		$test35= $_REQUEST['type1'];
			$test36= $_REQUEST['printeridchk'];
			$test37=$_REQUEST['floor1'];
			if(isset($_REQUEST['kot1']))
			{
			$test38=$_REQUEST['kot1'];
			}
			$printer1=$_REQUEST['printername1'];
			$br1=$_REQUEST['br1'];

	 $sql_login  =  $database->mysqlQuery("select * from tbl_printersettings LEFT JOIN tbl_branchmaster ON tbl_printersettings.pr_branchid=tbl_branchmaster.be_branchid LEFT JOIN tbl_floormaster ON tbl_printersettings.pr_floorid=tbl_floormaster.fr_floorid LEFT JOIN tbl_printertype ON tbl_printersettings.pr_printertype=tbl_printertype.pt_id LEFT JOIN tbl_kotcountermaster ON tbl_printersettings.pr_kotcode=tbl_kotcountermaster.kr_kotcode where pr_printertype='$test35' and pr_floorid='$test37' and pr_printername='$printer1' and pr_branchid='$br1' and pr_id<>'$test36'");
	 
	
	 
	 
	// $sql_login  =  $database->mysqlQuery("select (tr_tableno) from tbl_tablemaster where tr_tableno='$test17' and tr_tableid<>'$test18' "); 
      $num_login   = $database->mysqlNumRows($sql_login);
	 
	  if($num_login =='0')
	  {
	echo 'ok';
	  }
	  else
	  {
	echo 'sorry';
	  }
	 } 
	   else if($_REQUEST['value']=="checkprintername")
	 {
		$pname= $_REQUEST['mid'];
		
	//$kot=$_REQUEST['kot'];
	//$printer=$_REQUEST['printername'];
	 $sql_login  =  $database->mysqlQuery("select (pr_printername) from tbl_printersettings where pr_printername='$pname'"); 
	
      $num_login   = $database->mysqlNumRows($sql_login);

	 
	  if($num_login =='1')
	  {
		 echo 'sorry';
	  }
	  else
	  {
		echo 'ok';
	  }
	 } 
	 else if($_REQUEST['value']=="checkdept")
	 {
		$dept= $_REQUEST['mid'];
	
	 $sql_login  =  $database->mysqlQuery("select (der_departmentname) from tbl_departmentmaster where der_departmentname='$dept'"); 
	
	  
      $num_login   = $database->mysqlNumRows($sql_login);

	 
	  if($num_login =='1')
	  {
		 echo 'sorry';
	  }
	  else
	  {
		echo 'ok';
	  }
	 } 
	 
	 else if($_REQUEST['value']=="checkdesig")
	 {
		$des= $_REQUEST['mid'];
	
	 $sql_login  =  $database->mysqlQuery("select (dr_designationname) from tbl_designationmaster where dr_designationname='$des'"); 
	
	  
      $num_login   = $database->mysqlNumRows($sql_login);

	 
	  if($num_login =='1')
	  {
		 echo 'sorry';
	  }
	  else
	  {
		echo 'ok';
	  }
	 } 
	  
	   else if($_REQUEST['value']=="checkdeptedit")
	 {
		$dptid= $_REQUEST['deptid'];
			$dptname= $_REQUEST['deptname'];
	
	 $sql_login  =  $database->mysqlQuery("select (der_departmentname) from tbl_departmentmaster where der_departmentname='$dptname' and der_departmentid<>'$dptid' "); 
      $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login =='0')
	  {
		 echo 'ok';
	  }
	  else
	  {
		echo 'sorry';
	  }
	 }
	 
	   else if($_REQUEST['value']=="checkdesigedit")
	 {
		
		$desigid= $_REQUEST['desigid'];
			$designame= $_REQUEST['designame'];
	
	 $sql_login  =  $database->mysqlQuery("select (dr_designationname) from tbl_designationmaster where dr_designationname='$designame' and dr_designationid<>'$desigid' "); 
      $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login =='0')
	  {
		 echo 'ok';
	  }
	  else
	  {
		echo 'sorry';
	  }
	 }
	  else if($_REQUEST['value']=="checkdiscount")
	 {
		$disname= $_REQUEST['mid'];
		$brnchname=$_REQUEST['brch'];
	 $sql_login  =  $database->mysqlQuery("select(ds_discountname) from tbl_discountmaster INNER JOIN tbl_branchmaster ON tbl_discountmaster.ds_branchid=tbl_branchmaster.be_branchid where ds_discountname='$disname' and ds_branchid='$brnchname'"); 
      $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login =='1')
	  {
		 echo 'sorry';
	  }
	  else
	  {
		echo 'ok';
	  }
	 }  
	  else if($_REQUEST['value']=="checkdiscedit")
	 {
		$discedit= $_REQUEST['discname'];
			$discid= $_REQUEST['discidchk'];
			$discbrnch= $_REQUEST['branchhh'];
	
	 $sql_login  =  $database->mysqlQuery("select (ds_discountname) from tbl_discountmaster INNER JOIN tbl_branchmaster ON tbl_discountmaster.ds_branchid=tbl_branchmaster.be_branchid where ds_discountname='$discedit' and ds_branchid='$discbrnch' and ds_discountid<>'$discid' ");
	
      $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login =='0')
	  {
		 echo 'ok';
	  }
	  else
	  {
		echo 'sorry';
	  }
	 }
	 

	  else if($_REQUEST['value']=="checkcorporate")
	 {
		$corp= $_REQUEST['mid'];
	
	 $sql_login  =  $database->mysqlQuery("select (ct_corporatename) from tbl_corporatemaster where ct_corporatename='$corp'"); 
	
	  
      $num_login   = $database->mysqlNumRows($sql_login);

	 
	  if($num_login =='1')
	  {
		 echo 'sorry';
	  }
	  else
	  {
		echo 'ok';
	  }
	 } 
	   else if($_REQUEST['value']=="checkcorpedit")
	 {
		
		$corpid= $_REQUEST['corpid'];
			$corpname= $_REQUEST['corpname'];
	
	 $sql_login  =  $database->mysqlQuery("select(ct_corporatename) from tbl_corporatemaster where ct_corporatename='$corpname' and ct_corporatecode<>'$corpid' "); 
      $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login =='0')
	  {
		 echo 'ok';
	  }
	  else
	  {
		echo 'sorry';
	  }
	 }
	 
	  
	  
	    else if($_REQUEST['value']=="checkvoucher")
	 {
		$voucher= $_REQUEST['mid'];
	
	 $sql_login  =  $database->mysqlQuery("select (vr_vouchername) from tbl_vouchermaster where vr_vouchername='$voucher'"); 
	
	  
      $num_login   = $database->mysqlNumRows($sql_login);

	 
	  if($num_login =='1')
	  {
		 echo 'sorry';
	  }
	  else
	  {
		echo 'ok';
	  }
	 } 
         
         
             else if($_REQUEST['value']=="checkvoucherhead")
	 {
		$voucher= $_REQUEST['mid'];
	
	 $sql_login  =  $database->mysqlQuery("select (vh_vouchername) from tbl_voucherhead where vh_vouchername='$voucher'"); 
	
	  
      $num_login   = $database->mysqlNumRows($sql_login);

	 
	  if($num_login =='1')
	  {
		 echo 'sorry';
	  }
	  else
	  {
		echo 'ok';
	  }
	 }
         
               else if($_REQUEST['value']=="checkvoucherpayment")
	 {
		$vochpayment= $_REQUEST['mid'];
	
	 $sql_login  =  $database->mysqlQuery("select (vp_vhid) from tbl_voucherpayment where vp_vhid='$vochpayment'"); 
	
	  
      $num_login   = $database->mysqlNumRows($sql_login);

	 
	  if($num_login =='1')
	  {
		 echo 'sorry';
	  }
	  else
	  {
		echo 'ok';
	  }
	 }
         
         
         
           else if($_REQUEST['value']=="checkvoucherheadedit")
	 {
		
		$voucherid= $_REQUEST['voucheridchk'];
			$vouchername= $_REQUEST['vouchername'];
	
	 $sql_login  =  $database->mysqlQuery("select(vh_vouchername) from tbl_voucherhead where vh_vouchername='$vouchername' and vh_id<>'$voucherid' "); 
      $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login =='0')
	  {
		 echo 'ok';
	  }
	  else
	  {
		echo 'sorry';
	  }
	 }
         
         
              else if($_REQUEST['value']=="checkvoucherpaymentedit")
	 {
		
		$voucherid= $_REQUEST['voucheridchk'];
			$vouchername= $_REQUEST['vhid'];
	
	 $sql_login  =  $database->mysqlQuery("select(vp_vhid) from tbl_voucherpayment where vp_vhid='$vouchername' and vp_id<>'$voucherid' "); 
      $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login =='0')
	  {
		 echo 'ok';
	  }
	  else
	  {
		echo 'sorry';
	  }
	 }
         
         else if($_REQUEST['value']=="checkvoucherapprove")
	 {
		
		$voucherid= $_REQUEST['voucheridchk'];
			$vouchername= $_REQUEST['vhid'];
	
	 $sql_login  =  $database->mysqlQuery("select(vp_approvedby) from tbl_voucherpayment where vp_approvedby='$vouchername' and vp_id<>'$voucherid' "); 
      $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login =='0')
	  {
		 echo 'ok';
	  }
	  else
	  {
		echo 'sorry';
	  }
	 }
         
         
         
	   else if($_REQUEST['value']=="checkvoucheredit")
	 {
		
		$voucherid= $_REQUEST['voucheridchk'];
			$vouchername= $_REQUEST['vouchername'];
	
	 $sql_login  =  $database->mysqlQuery("select(vr_vouchername) from tbl_vouchermaster where vr_vouchername='$vouchername' and vr_voucherid<>'$voucherid' "); 
      $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login =='0')
	  {
		 echo 'ok';
	  }
	  else
	  {
		echo 'sorry';
	  }
	 }
         
         
         
            else if($_REQUEST['value']=="checkmobile")
	 {
		$reg= $_REQUEST['mid'];
	
	 $sql_login  =  $database->mysqlQuery("select (ly_mobileno) from tbl_loyalty_reg where ly_mobileno='$reg'"); 
	
	  
      $num_login   = $database->mysqlNumRows($sql_login);

	 
	  if($num_login =='1')
	  {
		 echo 'sorry';
	  }
	  else
	  {
		echo 'ok';
	  }
	 } 
         
         
         
	 
	   else if($_REQUEST['value']=="checkfeedback")
	 {
		$feedbk= $_REQUEST['mid'];
	
	 $sql_login  =  $database->mysqlQuery("select (fbm_question) from tbl_feedbackmaster where fbm_question='$feedbk'"); 
	
	  
      $num_login   = $database->mysqlNumRows($sql_login);

	 
	  if($num_login =='1')
	  {
		 echo 'sorry';
	  }
	  else
	  {
		echo 'ok';
	  }
	 } 
	   else if($_REQUEST['value']=="checkvoucheredit")
	 {
		
		$voucherid= $_REQUEST['voucheridchk'];
			$vouchername= $_REQUEST['vouchername'];
	
	 $sql_login  =  $database->mysqlQuery("select(vr_vouchername) from tbl_vouchermaster where vr_vouchername='$vouchername' and vr_voucherid<>'$voucherid' "); 
      $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login =='0')
	  {
		 echo 'ok';
	  }
	  else
	  {
		echo 'sorry';
	  }
	 }
	 
	   else if($_REQUEST['value']=="checkcmpny")
	 {
		$cmpny= $_REQUEST['mid'];
		//$strtdate=$_REQUEST['strtdate'];
		$dateOb=$database->convert_date($_REQUEST['strtdate']);	
		//echo $dateOb;
	$newdate	= explode("-",$dateOb);
	$date		= $newdate[0];
	$month		= $newdate[1];
	$year		= $newdate[2];
	if(strlen($date) == '2') 
	{
		$strtdt		= $year."-".$month."-".$date;
	}
	
		else
	{
	$strtdt		= $date."-".$month."-".$year;
	}

	
	 $sql_login  =  $database->mysqlQuery("select (cy_companyname) from tbl_couponcompany where cy_companyname='$cmpny'"); 

      $num_login   = $database->mysqlNumRows($sql_login);

	 
	  if($num_login =='1')
	  {
		 echo 'sorry';
	  }
	  else
	  {
		echo 'ok';
	  }
	 }
         
         
    
         
         
         
         
	 
	 else if($_REQUEST['value']=="checkprinttype")
	 {
		$test= $_REQUEST['mid'];
	
	 $sql_login  =  $database->mysqlQuery("select (pt_typename) from tbl_printertype where pt_typename='$test'"); 
	
	  
      $num_login   = $database->mysqlNumRows($sql_login);

	 
	  if($num_login =='1')
	  {
		 echo 'sorry';
	  }
	  else
	  {
		echo 'ok';
	  }
	 } 
	 
	 else if($_REQUEST['value']=="checkprinttypeedit")
	 {
		$test7= $_REQUEST['mid'];
			$test8= $_REQUEST['printtypeid'];
	 $sql_login  =  $database->mysqlQuery("select (pt_typename) from tbl_printertype where pt_typename='$test7' and pt_id<>'$test8' "); 
      $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login =='0')
	  {
		 echo 'ok';
	  }
	  else
	  {
		echo 'sorry';
	  }
 }  
 else if($_REQUEST['value']=="addratechange"){
             
	 /* ************ rate change ************** */
             
	$rate=$_REQUEST['rate'];
	
	$type=$_REQUEST['type'];
	 
	$mode=$_REQUEST['mode'];
        $floorrate=$_REQUEST['floorrate'];
        $catrate=$_REQUEST['catrate'];
        $module=$_REQUEST['module'];
	
	
	 $database->mysqlQuery("SET @rate 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$rate) . "'");
	 $database->mysqlQuery("SET @type 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$type) . "'");
	 $database->mysqlQuery("SET @mode 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$mode) . "'");
	 $database->mysqlQuery("SET @floorid 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$floorrate) . "'");
	 $database->mysqlQuery("SET @catid 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$catrate) . "'");
         $database->mysqlQuery("SET @module 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$module) . "'");
         
	$message="";
	$sq=$database->mysqlQuery("CALL  proc_ratechange(@rate,@type,@mode,@message,@floorid,@catid,@module)");
	$rs = $database->mysqlQuery( 'SELECT @message AS message' );
	while($row = mysqli_fetch_array($rs))
	{
	   $s= $row['message'];
	}
        
        
       $sql_general_sync =  $database->mysqlQuery("update  tbl_staffmaster set ser_app_change='Y' ");  
        
	echo $s;
        
        
        
        
 }
 
 else if($_REQUEST['value']=="addtakeawayratechange")
 {
	$mode_from=$_REQUEST['mode_from'];
        $tafloorrate=$_REQUEST['floorrate'];
        $takeaway1=$_REQUEST['takeaway1'];
        $branchofid=$_SESSION['branchofid'];

        $online=$_REQUEST['online'];
        
	$database->mysqlQuery("SET @mode_from 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$mode_from) . "'");
	$database->mysqlQuery("SET @floorid 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$tafloorrate) . "'");
        $database->mysqlQuery("SET @mode 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$takeaway1) . "'");
        $database->mysqlQuery("SET @branchid 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$branchofid) . "'");
         $database->mysqlQuery("SET @online				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$online) . "'");
	$message="";
	$sq=$database->mysqlQuery("CALL  proc_rate_copy(@mode_from,@floorid,@branchid,@mode,@online,@message)");
	$rs = $database->mysqlQuery( 'SELECT @message AS message' );
	while($row = mysqli_fetch_array($rs))
	{
	$s= $row['message'];
	}
        
          $sql_general_sync =  $database->mysqlQuery("update  tbl_staffmaster set ser_app_change='Y' ");
        
	echo $s; 
 
 }
 
  else if($_REQUEST['value']=="addcountersaleratechange")
 {
$mode_from=$_REQUEST['mode_from'];	
$tafloorrate=$_REQUEST['floorrate2'];
$countersale1=$_REQUEST['countersale1'];
 $branchofid=$_SESSION['branchofid'];
$online=$_REQUEST['online'];
           $database->mysqlQuery("SET @mode_from 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$mode_from) . "'");  
	  $database->mysqlQuery("SET @floorid 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$tafloorrate) . "'");
          $database->mysqlQuery("SET @mode 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$countersale1) . "'");
          $database->mysqlQuery("SET @branchid 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$branchofid) . "'");
          $database->mysqlQuery("SET @online				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$online) . "'");
	 $message="";
	$sq=$database->mysqlQuery("CALL  proc_rate_copy(@mode_from,@floorid,@branchid,@mode,@online,@message)");
	$rs = $database->mysqlQuery( 'SELECT @message AS message' );
	while($row = mysqli_fetch_array($rs))
	{
	$s= $row['message'];
	}
        
        
         $sql_general_sync =  $database->mysqlQuery("update  tbl_staffmaster set ser_app_change='Y' ");
	echo $s; 
 
 }
 
 
  else if($_REQUEST['value']=="adddineinratechange")
 {
       
    $mode_from=$_REQUEST['mode_from'];	
    $tafloorrate=$_REQUEST['floorrate3'];
    $dinein1=$_REQUEST['dinein1'];
    $branchofid=$_SESSION['branchofid'];
    $online=$_REQUEST['online'];
        $database->mysqlQuery("SET @mode_from 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$mode_from) . "'");  
	$database->mysqlQuery("SET @floorid 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$tafloorrate) . "'");
        $database->mysqlQuery("SET @mode 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$dinein1) . "'");
        $database->mysqlQuery("SET @branchid 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$branchofid) . "'");
        $database->mysqlQuery("SET @online				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$online) . "'");
	$message="";
	$sq=$database->mysqlQuery("CALL  proc_rate_copy(@mode_from,@floorid,@branchid,@mode,@online,@message)");
	$rs = $database->mysqlQuery( 'SELECT @message AS message' );
	while($row = mysqli_fetch_array($rs))
	{
	$s= $row['message'];
	}
        
         $sql_general_sync =  $database->mysqlQuery("update  tbl_staffmaster set ser_app_change='Y' ");
        
	echo $s; 
 
 }
 
 else if($_REQUEST['value']=="maincat_discount")
 {
      
	 $mode=$_REQUEST['mode'];
         $maincat=$_REQUEST['maincat'];
         
         $status=$_REQUEST['status'];
         $discountid=$_REQUEST['discountid'];
      
         $add='A';   
        
         if($_REQUEST['dine']=="Y"){
             $dine='Y'; 
         }else{
              $dine='N'; 
         }
         
          if($_REQUEST['ta']=="Y"){
             $ta='Y'; 
         }else{
              $ta='N'; 
         }
         
         if($_REQUEST['cs']=="Y"){
             $cs='Y'; 
         }else{
              $cs='N'; 
         }
         
         
          if($_REQUEST['date']=="Y"){
             $date='Y'; 
         }else{
              $date='N'; 
         }
         
         if($_REQUEST['time']=="Y"){
             $time='Y'; 
         }else{
              $time='N'; 
         }
         
         
          if($_REQUEST['day']=="Y"){
             $day='Y'; 
         }else{
              $day='N'; 
         }
         
         
         if($_REQUEST['day_in']!=""){
            $day_in=$_REQUEST['day_in'];
        }else{
           $day_in=0; 
        }
         
         
        if($_REQUEST['fromdate']!=""){
             $fromdate=$_REQUEST['fromdate']; 
        }else{
           $fromdate=0; 
        }
        
        
          if($_REQUEST['todate']!=""){
              $todate=$_REQUEST['todate'];
        }else{
           $todate=0; 
        }
        
          if($_REQUEST['fromtime']!=""){
             $fromtime=date("H:i", strtotime($_REQUEST['fromtime']));
        }else{
           $fromtime=0; 
        }
       
        if($_REQUEST['totime']!=""){
           $totime=date("H:i", strtotime($_REQUEST['totime']));
        }else{
           $totime=0; 
        }
       
	$database->mysqlQuery("SET @mode 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$mode) . "'");
	$database->mysqlQuery("SET @category 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$maincat) . "'");
        $database->mysqlQuery("SET @dicsount_id 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$discountid) . "'");
	 $database->mysqlQuery("SET @operation 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$add) . "'"); 
         $database->mysqlQuery("SET @di 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$dine) . "'");
	$database->mysqlQuery("SET @ta 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$ta) . "'");
        $database->mysqlQuery("SET @cs 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$cs) . "'");
	 $database->mysqlQuery("SET @date_limit 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$date) . "'"); 
         $database->mysqlQuery("SET @time_limit 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$time) . "'");
	$database->mysqlQuery("SET @day_limit 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$day) . "'");
        $database->mysqlQuery("SET @from_date 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$fromdate) . "'");
	 $database->mysqlQuery("SET @to_date 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$todate) . "'"); 
         $database->mysqlQuery("SET @from_time 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$fromtime) . "'");
	$database->mysqlQuery("SET @to_time 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$totime) . "'");
        $database->mysqlQuery("SET @day_name 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$day_in) . "'");
	
        
      //  echo $mode.$maincat.$discountid.$add.$dine.$ta.$cs.$date.$date.$time.$day.$fromdate.$todate.$fromtime.$totime.$day_in;
        
        $message="";
	$sq=$database->mysqlQuery("CALL  proc_discount_add(@mode,@category,@dicsount_id,@operation,@di,@ta,@cs,@date_limit,@time_limit,@day_limit,@from_date,@to_date,@from_time,@to_time,@day_name,@message)");
	$rs = $database->mysqlQuery( 'SELECT @message AS message' );
	while($row = mysqli_fetch_array($rs))
	{
	$s= $row['message'];
	}
	echo $s; 
    
       
 }
 
 
   else if($_REQUEST['value']=="subcat_discount")
 {
	$mode=$_REQUEST['mode'];
        $subcat=$_REQUEST['subcat'];
        $status=$_REQUEST['status'];
        $discountid=$_REQUEST['discountid'];
       
             
        $add='A';
       
        if($_REQUEST['dine']=="Y"){
             $dine='Y'; 
         }else{
              $dine='N'; 
         }
         
          if($_REQUEST['ta']=="Y"){
             $ta='Y'; 
         }else{
              $ta='N'; 
         }
         
         if($_REQUEST['cs']=="Y"){
             $cs='Y'; 
         }else{
              $cs='N'; 
         }
         
         
          if($_REQUEST['date']=="Y"){
             $date='Y'; 
         }else{
              $date='N'; 
         }
         
         if($_REQUEST['time']=="Y"){
             $time='Y'; 
         }else{
              $time='N'; 
         }
         
         
          if($_REQUEST['day']=="Y"){
             $day='Y'; 
         }else{
              $day='N'; 
         }
        
        
         if($_REQUEST['day_in']!=""){
            $day_in=$_REQUEST['day_in'];
        }else{
           $day_in=0; 
        }
        
        
        if($_REQUEST['fromdate']!=""){
             $fromdate=$_REQUEST['fromdate']; 
        }else{
           $fromdate=0; 
        }
        
        
          if($_REQUEST['todate']!=""){
              $todate=$_REQUEST['todate'];
        }else{
           $todate=0; 
        }
        
           if($_REQUEST['fromtime']!=""){
             $fromtime=date("H:i", strtotime($_REQUEST['fromtime']));
        }else{
           $fromtime=0; 
        }
       
        if($_REQUEST['totime']!=""){
           $totime=date("H:i", strtotime($_REQUEST['totime']));
        }else{
           $totime=0; 
        }
        
        
	$database->mysqlQuery("SET @mode 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$mode) . "'");
	$database->mysqlQuery("SET @category 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$subcat) . "'");
        $database->mysqlQuery("SET @dicsount_id 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$discountid) . "'");
	 $database->mysqlQuery("SET @operation 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$add) . "'"); 
         $database->mysqlQuery("SET @di 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$dine) . "'");
	$database->mysqlQuery("SET @ta 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$ta) . "'");
        $database->mysqlQuery("SET @cs 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$cs) . "'");
	 $database->mysqlQuery("SET @date_limit 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$date) . "'"); 
         $database->mysqlQuery("SET @time_limit 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$time) . "'");
	$database->mysqlQuery("SET @day_limit 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$day) . "'");
        $database->mysqlQuery("SET @from_date 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$fromdate) . "'");
	 $database->mysqlQuery("SET @to_date 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$todate) . "'"); 
         $database->mysqlQuery("SET @from_time 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$fromtime) . "'");
	$database->mysqlQuery("SET @to_time 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$totime) . "'");
        $database->mysqlQuery("SET @day_name 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$day_in) . "'");
	
        $message="";
	$sq=$database->mysqlQuery("CALL  proc_discount_add(@mode,@category,@dicsount_id,@operation,@di,@ta,@cs,@date_limit,@time_limit,@day_limit,@from_date,@to_date,@from_time,@to_time,@day_name,@message)");
	$rs = $database->mysqlQuery( 'SELECT @message AS message' );
	while($row = mysqli_fetch_array($rs))
	{
	$s= $row['message'];
	}
	echo $s; 
    
       
 }
 
 else if($_REQUEST['value']=="remove_maincat_discount")
 {
	$mode=$_REQUEST['mode'];
        $maincat=$_REQUEST['maincat'];
        $status=$_REQUEST['status'];
        $discountid=$_REQUEST['discountid'];
       
         $add='R';   
        
         if($_REQUEST['dine']=="Y"){
             $dine='Y'; 
         }else{
              $dine='N'; 
         }
         
          if($_REQUEST['ta']=="Y"){
             $ta='Y'; 
         }else{
              $ta='N'; 
         }
         
         if($_REQUEST['cs']=="Y"){
             $cs='Y'; 
         }else{
              $cs='N'; 
         }
         
         
          if($_REQUEST['date']=="Y"){
             $date='Y'; 
         }else{
              $date='N'; 
         }
         
         if($_REQUEST['time']=="Y"){
             $time='Y'; 
         }else{
              $time='N'; 
         }
         
         
          if($_REQUEST['day']=="Y"){
             $day='Y'; 
         }else{
              $day='N'; 
         }
         
         
         if($_REQUEST['day_in']!=""){
            $day_in=$_REQUEST['day_in'];
        }else{
           $day_in=0; 
        }
         
         
        if($_REQUEST['fromdate']!=""){
             $fromdate=$_REQUEST['fromdate']; 
        }else{
           $fromdate=0; 
        }
        
        
          if($_REQUEST['todate']!=""){
              $todate=$_REQUEST['todate'];
        }else{
           $todate=0; 
        }
        
          if($_REQUEST['fromtime']!=""){
             $fromtime=date("H:i", strtotime($_REQUEST['fromtime']));
        }else{
           $fromtime=0; 
        }
       
        if($_REQUEST['totime']!=""){
           $totime=date("H:i", strtotime($_REQUEST['totime']));
        }else{
           $totime=0; 
        }
       
	$database->mysqlQuery("SET @mode 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$mode) . "'");
	$database->mysqlQuery("SET @category 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$maincat) . "'");
        $database->mysqlQuery("SET @dicsount_id 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$discountid) . "'");
	 $database->mysqlQuery("SET @operation 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$add) . "'"); 
         $database->mysqlQuery("SET @di 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$dine) . "'");
	$database->mysqlQuery("SET @ta 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$ta) . "'");
        $database->mysqlQuery("SET @cs 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$cs) . "'");
	 $database->mysqlQuery("SET @date_limit 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$date) . "'"); 
         $database->mysqlQuery("SET @time_limit 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$time) . "'");
	$database->mysqlQuery("SET @day_limit 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$day) . "'");
        $database->mysqlQuery("SET @from_date 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$fromdate) . "'");
	 $database->mysqlQuery("SET @to_date 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$todate) . "'"); 
         $database->mysqlQuery("SET @from_time 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$fromtime) . "'");
	$database->mysqlQuery("SET @to_time 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$totime) . "'");
        $database->mysqlQuery("SET @day_name 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$day_in) . "'");
	
        
      //  echo $mode.$maincat.$discountid.$add.$dine.$ta.$cs.$date.$date.$time.$day.$fromdate.$todate.$fromtime.$totime.$day_in;
        
        $message="";
	$sq=$database->mysqlQuery("CALL  proc_discount_add(@mode,@category,@dicsount_id,@operation,@di,@ta,@cs,@date_limit,@time_limit,@day_limit,@from_date,@to_date,@from_time,@to_time,@day_name,@message)");
	$rs = $database->mysqlQuery( 'SELECT @message AS message' );
	while($row = mysqli_fetch_array($rs))
	{
	$s= $row['message'];
	}
	echo $s; 
    
       
 }
 
    else if($_REQUEST['value']=="remove_subcat_discount")
 {
	$mode=$_REQUEST['mode'];
        $subcat=$_REQUEST['subcat'];
        $status=$_REQUEST['status'];
        $discountid=$_REQUEST['discountid'];
       
             
        $add='R';
       
        if($_REQUEST['dine']=="Y"){
             $dine='Y'; 
         }else{
              $dine='N'; 
         }
         
          if($_REQUEST['ta']=="Y"){
             $ta='Y'; 
         }else{
              $ta='N'; 
         }
         
         if($_REQUEST['cs']=="Y"){
             $cs='Y'; 
         }else{
              $cs='N'; 
         }
         
         
          if($_REQUEST['date']=="Y"){
             $date='Y'; 
         }else{
              $date='N'; 
         }
         
         if($_REQUEST['time']=="Y"){
             $time='Y'; 
         }else{
              $time='N'; 
         }
         
         
          if($_REQUEST['day']=="Y"){
             $day='Y'; 
         }else{
              $day='N'; 
         }
        
        
         if($_REQUEST['day_in']!=""){
            $day_in=$_REQUEST['day_in'];
        }else{
           $day_in=0; 
        }
        
        
        if($_REQUEST['fromdate']!=""){
             $fromdate=$_REQUEST['fromdate']; 
        }else{
           $fromdate=0; 
        }
        
        
          if($_REQUEST['todate']!=""){
              $todate=$_REQUEST['todate'];
        }else{
           $todate=0; 
        }
        
           if($_REQUEST['fromtime']!=""){
             $fromtime=date("H:i", strtotime($_REQUEST['fromtime']));
        }else{
           $fromtime=0; 
        }
       
        if($_REQUEST['totime']!=""){
           $totime=date("H:i", strtotime($_REQUEST['totime']));
        }else{
           $totime=0; 
        }
        
        
	$database->mysqlQuery("SET @mode 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$mode) . "'");
	$database->mysqlQuery("SET @category 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$subcat) . "'");
        $database->mysqlQuery("SET @dicsount_id 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$discountid) . "'");
	 $database->mysqlQuery("SET @operation 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$add) . "'"); 
         $database->mysqlQuery("SET @di 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$dine) . "'");
	$database->mysqlQuery("SET @ta 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$ta) . "'");
        $database->mysqlQuery("SET @cs 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$cs) . "'");
	 $database->mysqlQuery("SET @date_limit 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$date) . "'"); 
         $database->mysqlQuery("SET @time_limit 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$time) . "'");
	$database->mysqlQuery("SET @day_limit 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$day) . "'");
        $database->mysqlQuery("SET @from_date 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$fromdate) . "'");
	 $database->mysqlQuery("SET @to_date 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$todate) . "'"); 
         $database->mysqlQuery("SET @from_time 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$fromtime) . "'");
	$database->mysqlQuery("SET @to_time 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$totime) . "'");
        $database->mysqlQuery("SET @day_name 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$day_in) . "'");
	
        $message="";
	$sq=$database->mysqlQuery("CALL  proc_discount_add(@mode,@category,@dicsount_id,@operation,@di,@ta,@cs,@date_limit,@time_limit,@day_limit,@from_date,@to_date,@from_time,@to_time,@day_name,@message)");
	$rs = $database->mysqlQuery( 'SELECT @message AS message' );
	while($row = mysqli_fetch_array($rs))
	{
	$s= $row['message'];
	}
	echo $s; 
    
       
 }
 
 
else if($_REQUEST['value']=="addcattax")
 {
	
$categorytax1=$_REQUEST['categorytax1'];
$maincattaxname1=$_REQUEST['maincattaxname1'];
$categoryname1=$_REQUEST['categoryname1'];
$add='A';

	$database->mysqlQuery("SET @mode 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$maincattaxname1) . "'");
	$database->mysqlQuery("SET @category 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$categoryname1) . "'");
        $database->mysqlQuery("SET @tax_id 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$categorytax1) . "'");
         $database->mysqlQuery("SET @operation 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$add) . "'");
	 $message="";
	$sq=$database->mysqlQuery("CALL  proc_extra_tax_change(@mode,@category,@tax_id,@operation,@message)");
	$rs = $database->mysqlQuery( 'SELECT @message AS message' );
	while($row = mysqli_fetch_array($rs))
	{
	$s= $row['message'];
	}
	echo $s; 
 
 }
 
 else if($_REQUEST['value']=="removecattax")
 {
	
$categorytax1=$_REQUEST['categorytax1'];
$maincattaxname1=$_REQUEST['maincattaxname1'];
$categoryname1=$_REQUEST['categoryname1'];
$remove='R';

	$database->mysqlQuery("SET @mode 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$maincattaxname1) . "'");
	$database->mysqlQuery("SET @category 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$categoryname1) . "'");
        $database->mysqlQuery("SET @tax_id 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$categorytax1) . "'");
         $database->mysqlQuery("SET @operation				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$remove) . "'");
	 $message="";
	$sq=$database->mysqlQuery("CALL  proc_extra_tax_change(@mode,@category,@tax_id,@operation,@message)");
	$rs = $database->mysqlQuery( 'SELECT @message AS message' );
	while($row = mysqli_fetch_array($rs))
	{
	$s= $row['message'];
	}
	echo $s; 
 
 }
 
 else if($_REQUEST['value']=="addsubcattax")
 {
	
$subcategoryname1=$_REQUEST['subcategoryname1'];
$subcategorytax1=$_REQUEST['subcategorytax1'];
$subcattaxname1=$_REQUEST['subcattaxname1'];
$add='A';
	$database->mysqlQuery("SET @mode 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$subcattaxname1) . "'");
	$database->mysqlQuery("SET @category 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$subcategoryname1) . "'");
        $database->mysqlQuery("SET @tax_id 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$subcategorytax1) . "'");
	 $database->mysqlQuery("SET @operation 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$add) . "'"); 
        $message="";
	$sq=$database->mysqlQuery("CALL  proc_extra_tax_change(@mode,@category,@tax_id,@operation,@message)");
	$rs = $database->mysqlQuery( 'SELECT @message AS message' );
	while($row = mysqli_fetch_array($rs))
	{
	$s= $row['message'];
	}
	echo $s; 
 
 }
 
 else if($_REQUEST['value']=="removesubcattax")
 {
	
$subcategoryname1=$_REQUEST['subcategoryname1'];
$subcategorytax1=$_REQUEST['subcategorytax1'];
$subcattaxname1=$_REQUEST['subcattaxname1'];
$remove='R';
	$database->mysqlQuery("SET @mode 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$subcattaxname1) . "'");
	$database->mysqlQuery("SET @category 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$subcategoryname1) . "'");
        $database->mysqlQuery("SET @tax_id 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$subcategorytax1) . "'");
	 $database->mysqlQuery("SET @operation 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$remove) . "'"); 
        $message="";
	$sq=$database->mysqlQuery("CALL  proc_extra_tax_change(@mode,@category,@tax_id,@operation,@message)");
	$rs = $database->mysqlQuery( 'SELECT @message AS message' );
	while($row = mysqli_fetch_array($rs))
	{
	$s= $row['message'];
	}
	echo $s; 
 
 }
 
 else if($_REQUEST['value']=="adddiettax")
 {
	
$dietname1=$_REQUEST['dietname1'];
$diettax1=$_REQUEST['diettax1'];
$diettaxname1=$_REQUEST['diettaxname1'];
$add='A';
	$database->mysqlQuery("SET @mode 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$diettaxname1) . "'");
	$database->mysqlQuery("SET @category 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$dietname1) . "'");
        $database->mysqlQuery("SET @tax_id 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$diettax1) . "'");
        $database->mysqlQuery("SET @operation 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$add) . "'"); 
	 $message="";
	$sq=$database->mysqlQuery("CALL  proc_extra_tax_change(@mode,@category,@tax_id,@operation,@message)");
	$rs = $database->mysqlQuery( 'SELECT @message AS message' );
	while($row = mysqli_fetch_array($rs))
	{
	$s= $row['message'];
	}
	echo $s; 
 
 }
  else if($_REQUEST['value']=="removediettax")
 {
	
$dietname1=$_REQUEST['dietname1'];
$diettax1=$_REQUEST['diettax1'];
$diettaxname1=$_REQUEST['diettaxname1'];
$remove='R';
	$database->mysqlQuery("SET @mode 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$diettaxname1) . "'");
	$database->mysqlQuery("SET @category 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$dietname1) . "'");
        $database->mysqlQuery("SET @tax_id 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$diettax1) . "'");
        $database->mysqlQuery("SET @operation 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$remove) . "'"); 
	 $message="";
	$sq=$database->mysqlQuery("CALL  proc_extra_tax_change(@mode,@category,@tax_id,@operation,@message)");
	$rs = $database->mysqlQuery( 'SELECT @message AS message' );
	while($row = mysqli_fetch_array($rs))
	{
	$s= $row['message'];
	}
	echo $s; 
 
 }
  else if($_REQUEST['value']=="addfloorrate"){
	 /* ******************************************** Load menu stock master ******************************************************* */
	
	 $new_floorid=$_REQUEST['new_floorid'];
	
	$floorid=$_REQUEST['floorid'];
	

	 $database->mysqlQuery("SET @new_floorid 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$new_floorid) . "'");
	 $database->mysqlQuery("SET @floorid 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$floorid) . "'");
	 $message="";
	$sq=$database->mysqlQuery("CALL  
proc_copyfloorrate(@new_floorid,@floorid,@message)");
	$rs = $database->mysqlQuery( 'SELECT @message AS message' );
	while($row = mysqli_fetch_array($rs))
	{
	$s= $row['message'];
	}
	echo $s;
 }
 
	 else if($_REQUEST['value']=="addprintercopy"){
	 /* ******************************************** Load menu stock master ******************************************************* */
	 $new_printerid=$_REQUEST['new_printerid'];
	$printerid=$_REQUEST['printerid'];
	 $database->mysqlQuery("SET @new_printerid 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$new_printerid) . "'");
	 $database->mysqlQuery("SET @printerid 				= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$printerid) . "'");
	 $message="";
	$sq=$database->mysqlQuery("CALL  
proc_copyfloorrate(@new_printerid,@printerid
,@message)");
	$rs = $database->mysqlQuery( 'SELECT @message AS message' );
	while($row = mysqli_fetch_array($rs))
	{
	$s= $row['message'];
	}
	echo $s;
 } else if($_REQUEST['value']=="chkpermissionvlaue"){
	/* ********************************************  User permission  ******************************************************* */ 
	 $mod 		=  $_REQUEST['modtype'];
	if($mod=="main1")
	{//mainmodname="+mainmodname+"&mainlinkname="+mainlinkname
		 $insertion['mer_modulename'] =$_REQUEST['mainmodname']; 
		 $sql=$database->check_duplicate_entry('tbl_modulemaster',$insertion);
		 if($sql!=1)
		 {
			$insertion1['mer_modulelink'] =$_REQUEST['mainlinkname']; 
			$sqlchk=$database->check_duplicate_entry('tbl_modulemaster',$insertion1);
			if($sqlchk!=1)
		 	{
				echo "ok";
		 	}
			else
			{
				echo "Module Link Name exists";
			}
		 }  
		 else 
	 	 {
			 echo "Module Name exists";
	 	 } 
		 
	}else if($mod=="sub1")
	{//submainnid="+submainnid+"&submodname="+submodname+"&submodlink="+submodlink
		$insertion['mser_moduleid'] =$_REQUEST['submainnid'];
		$insertion1['mser_subname'] =$_REQUEST['submodname']; 
		$sqlchk=$database->check_duplicate_entry('tbl_modulesubmaster',$insertion1);
		if($sqlchk!=1)
		{
			 $insertion2['mser_submodulelink'] =$_REQUEST['submodlink'];
			 $sqlchknw=$database->check_duplicate_entry('tbl_modulesubmaster',$insertion2);
			 if($sqlchknw!=1)
		 	 {
			 	echo "ok";
		     }  
			 else
			 {
				 echo "Sub Module Link Name exists";
			 }
		 } 
		 else
		 {
			  echo "Sub Module Name exists";
		 }
	}


 }
 
 

	 else if($_REQUEST['value']=="checkbank")
	 {
		$test= $_REQUEST['mid'];
	
	 $sql_login  =  $database->mysqlQuery("select (bm_name) from tbl_bankmaster where bm_name='$test'"); 
	
	  
      $num_login   = $database->mysqlNumRows($sql_login);

	 
	  if($num_login =='1')
	  {
		 echo 'sorry';
	  }
	  else
	  {
		echo 'ok';
	  }
	 }

         
        else if($_REQUEST['value']=="checkuserk")
	 {
		$test= $_REQUEST['mid'];
	
	 $sql_login  =  $database->mysqlQuery("select (ls_username) from tbl_logindetails where ls_username='$test'"); 
	
	  
      $num_login   = $database->mysqlNumRows($sql_login);

	 
	  if($num_login =='1')
	  {
		 echo 'sorry';
	  }
	  else
	  {
		echo 'ok';
	  }
	 }  
         //confirmcode//
           else if($_REQUEST['value']=="checkpin")
	 {
		$test= $_REQUEST['mid'];
	
	 $sql_login  =  $database->mysqlQuery("select ser_authorisation_code from tbl_staffmaster where ser_authorisation_code='$test'"); 
	
	  
      $num_login   = $database->mysqlNumRows($sql_login);

	 
	  if($num_login )
	  {
		 echo 'yes';
	  }
	  else
	  {
		echo 'no';
	  }
	 }  
         //aurhcode//
         else if($_REQUEST['value']=="checkpin2")
	 {
		$test= $_REQUEST['mid'];
	
	 $sql_login  =  $database->mysqlQuery("select ser_authorisation_code from tbl_staffmaster where ser_authorisation_code='$test' and ser_staffid!='".$_REQUEST['stf']."'"); 
	
	  
          $num_login   = $database->mysqlNumRows($sql_login);

	 
	  if($num_login )
	  {
		 echo 'yes';
	  }
	  else
	  {
		echo 'no';
	  }
	 } 
         
          else if($_REQUEST['value']=="check_ip_lan")
	 {
		$lanip= $_REQUEST['lanip'];
                $printer_floorid=$_REQUEST['printer_floorid'];
                $printer_type=$_REQUEST['printer_type'];
                $kot_counter=$_REQUEST['kot_counter'];
	
	$sql_login  =  $database->mysqlQuery("select pr_printerip from tbl_printersettings where pr_printerip='".$lanip."' and pr_printertype='".$printer_type."' and  pr_floorid='".$printer_floorid."' and  pr_kotcode='".$kot_counter."'"); 
	$num_login   = $database->mysqlNumRows($sql_login);

	 
	  if($num_login)
	  {
		 echo 'yes';
	  }
	  else
	  {
		echo 'no';
	  }
	}
         
         //ip address//
           else if($_REQUEST['value']=="ipaddress")
	 {
		$test= $_REQUEST['mid'];
	
	 $sql_login  =  $database->mysqlQuery("select cm_ip_address from tbl_expodine_machines where cm_ip_address='$test'"); 
	
	  
      $num_login   = $database->mysqlNumRows($sql_login);

	 
	  if($num_login )
	  {
		 echo 'yes';
	  }
	  else
	  {
		echo 'no';
	  }
	 } 
 
 	//loaduser_permsn 
	 else if($_REQUEST['value']=="loaduser_permsn")
	 {
		 
	$from_user=	$_REQUEST['frm'];
	$to_user=$_REQUEST['to'];
		 if($to_user !="")
		 {
$dlt_query=$database->mysqlQuery("DELETE FROM  tbl_usermodules WHERE um_username ='$from_user'"); 
$insrt_query=$database->mysqlQuery("INSERT INTO tbl_usermodules(um_username, um_moduleid, um_submoduleid, um_access)select '$from_user', um_moduleid, um_submoduleid, um_access from tbl_usermodules where um_username = '$to_user' ")	 ;
		
		 if($insrt_query)
		 {
			echo 'ok';
		 }
		 }
		 else
		 {
			 echo 'sorry';
		 }
		 
	 }
 
   else if($_REQUEST['value']=="all_printer_on_off")
    {
        $dlt_query=$database->mysqlQuery("update tbl_branchmaster set be_printall='".$_REQUEST['sts']."' "); 
        
        $_SESSION['s_printst']=	$_REQUEST['sts'];
        
    }     
          
 else if($_REQUEST['value']=="testprinter")
	 {
		$printerid=$_REQUEST['printerid'];
                
                $all=explode('*',$_REQUEST['all']);
                
                
		$printers='';
		require_once("Escpos.php");
		//INSERT INTO `tbl_printersettings`(`pr_id`, `pr_printername`, `pr_printerip`, `pr_printerport`, `pr_branchid`, `pr_printertype`, `pr_floorid`, `pr_kotcode`, `pr_usbprinterip`, `pr_usbprinter`, `pr_defaultusb`, `pr_enable`, `pr_printcount`)
		$sql_billhis="select *  from tbl_printersettings WHERE pr_id='".$printerid."' AND pr_branchid='".$_SESSION['branchofid']."'";
		$sql_billhistory  =  $database->mysqlQuery($sql_billhis); 
		$num_billhistory  = $database->mysqlNumRows($sql_billhistory);
		if($num_billhistory)
		{
			while($result_billhistory  = $database->mysqlFetchArray($sql_billhistory)) 
				{
					$default=$result_billhistory['pr_defaultusb'];
					if($default=='Y') // checking usb or not
					 {
						  $printer="\\\\".$result_billhistory['pr_usbprinterip']."\\".$result_billhistory['pr_usbprinter'];
						  $connector = new FilePrintConnector($printer);
						  $printers = new Escpos($connector);
					 }else
					 {
						  $connector = new NetworkPrintConnector($result_billhistory['pr_printerip'], $result_billhistory['pr_printerport']);
						  $printers = new Escpos($connector);
					 }
				}
                   $be_logoinbill= 'N';             
                  $sql_branch =  mysqli_query($localhost,"Select be_logoinbill from tbl_branchmaster "); 
		  $num_branch  = mysqli_num_rows($sql_branch);
		  if($num_branch)
		  {
				while($result_branch  = mysqli_fetch_array($sql_branch)) 
					{
                                    
                                    $be_logoinbill= $result_branch["be_logoinbill"];
                                }
                                }
                                 
                                
                                if($be_logoinbill=='Y' && file_exists("img/print-logo/print_logo.png")){
								$printers -> setJustification(Escpos::JUSTIFY_CENTER);
								
								$logo = new EscposImage("img/print-logo/print_logo.png");
								
								$printers -> bitImage($logo);//graphics($logo);
								$printers -> feed();
								
                                }else{
                                   $printers -> setJustification(Escpos::JUSTIFY_CENTER);
				$printers -> selectPrintMode(Escpos::MODE_DOUBLE_HEIGHT);
				$printers -> selectPrintMode(Escpos::MODE_DOUBLE_WIDTH);
				$printers -> setEmphasis(true);
				$printers -> setTextSize(2,1); 
                                    $printers -> text("NO PRINT LOGO FOUND");
                                $printers -> feed();
                                $printers -> text("   ");
                                    
                                }
                                
				$printers -> setJustification(Escpos::JUSTIFY_CENTER);
				$printers -> selectPrintMode(Escpos::MODE_DOUBLE_HEIGHT);
				$printers -> selectPrintMode(Escpos::MODE_DOUBLE_WIDTH);
                                
				$printers -> setEmphasis(true);
				$printers -> setTextSize(2,3);
                                
                                if($default!='Y'){
                                    
				$printers -> text("TEST PRINT  : LAN");
                                //$printers -> feed();
                                $printers -> text("   ");
                                
                                }else{
                               
                              
				$printers -> text("TEST PRINT : USB");
                                 //$printers -> feed();
                                 $printers -> text("  ");
                                }
                                
                                $printers -> setEmphasis(false);
				$printers -> setTextSize(1, 1);
                                
                               $printers -> setEmphasis(false);
								$printers -> setFont(Escpos::FONT_A);
								$printers -> setJustification(Escpos::JUSTIFY_LEFT);
								//$printers -> selectPrintMode(Escpos::MODE_DOUBLE_HEIGHT);
								//$printers -> feed();
                                                                
								$printers -> setEmphasis(true);
								$printers -> setFont(Escpos::FONT_A);
								$printers -> setJustification(Escpos::JUSTIFY_LEFT);
								//$printers -> selectPrintMode(Escpos::MODE_DOUBLE_HEIGHT);
								$printers -> feed();
                                                                if($default!='Y'){
                                                                $printers -> text('IP : '.$all[1]);
                                                                }else{
                                                                    $printers -> text('IP : '.$all[3]);
                                                                }
								$printers -> setEmphasis(true);
								$printers -> setFont(Escpos::FONT_A);
								$printers -> setJustification(Escpos::JUSTIFY_LEFT);
								//$printers -> selectPrintMode(Escpos::MODE_DOUBLE_HEIGHT);
								//$printers -> feed();
                                                                
								$printers -> setEmphasis(true);
								$printers -> setFont(Escpos::FONT_A);
								$printers -> setJustification(Escpos::JUSTIFY_LEFT);
								//$printers -> selectPrintMode(Escpos::MODE_DOUBLE_HEIGHT);
								$printers -> feed();
                                                                   
                                                                   if($default!='Y'){
                                                                $printers -> text('PORT : '.$all[2]);
                                                                }else{
                                                                     $printers -> text('PORT : '.$all[4]);
                                                                }
                                                                    
                                                                    
								$printers -> setEmphasis(true);
								$printers -> setFont(Escpos::FONT_A);
								$printers -> setJustification(Escpos::JUSTIFY_LEFT);
								//$printers -> selectPrintMode(Escpos::MODE_DOUBLE_HEIGHT);
								//$printers -> feed();
                                                                
								$printers -> setEmphasis(true);
								$printers -> setFont(Escpos::FONT_A);
								$printers -> setJustification(Escpos::JUSTIFY_LEFT);
								//$printers -> selectPrintMode(Escpos::MODE_DOUBLE_HEIGHT);
								$printers -> feed();
                                                                  $printers -> text('PRINTER NAME : '.$all[0]);   
                                                                  
                                                                  
				$printers -> selectPrintMode();
				$printers -> feed();
				$printers -> cut();
				$printers -> close();
		}
		
		
		
		 
	 }
         else if($_REQUEST['value']=="print_lan")
             {
                $a=$_REQUEST['ip'];
             $b=$_REQUEST['port'];
             $c=$_REQUEST['name'];
             
             
             if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
                          exec("ping -n 1 -w 1 ".$a, $output, $result);              
                           
                   
                         } else if (strtoupper(substr(PHP_OS, 0, 3)) === 'LIN')
                               {
                            exec("ping -c 1 -w 1 ".$a, $output, $result);
                               

                               }
             
                                   if ($result == 0)
                                    {
             require_once("Escpos.php");
             $printers='';
             
             if($_REQUEST['mode']=='lan'){
	 $connector = new NetworkPrintConnector($a, $b);
         $printers = new Escpos($connector);	
             }else{
                $printer="\\\\".$a."\\".$b;
		$connector = new FilePrintConnector($printer);
		$printers = new Escpos($connector); 
             }
         
	$printers -> setJustification(Escpos::JUSTIFY_CENTER);
	$printers -> selectPrintMode(Escpos::MODE_DOUBLE_HEIGHT);
	$printers -> selectPrintMode(Escpos::MODE_DOUBLE_WIDTH);
	$printers -> setEmphasis(true);
	$printers -> setTextSize(2,2);
	$printers -> text('Test print');
        
								$printers -> setEmphasis(true);
								$printers -> setFont(Escpos::FONT_A);
								$printers -> setJustification(Escpos::JUSTIFY_LEFT);
								$printers -> selectPrintMode(Escpos::MODE_DOUBLE_HEIGHT);
								$printers -> feed();
                                                                
								$printers -> setEmphasis(true);
								$printers -> setFont(Escpos::FONT_A);
								$printers -> setJustification(Escpos::JUSTIFY_LEFT);
								$printers -> selectPrintMode(Escpos::MODE_DOUBLE_HEIGHT);
								$printers -> feed();
                                                                $printers -> text('IP:  '.$a);
        
								$printers -> setEmphasis(true);
								$printers -> setFont(Escpos::FONT_A);
								$printers -> setJustification(Escpos::JUSTIFY_LEFT);
								$printers -> selectPrintMode(Escpos::MODE_DOUBLE_HEIGHT);
								$printers -> feed();
                                                                
								$printers -> setEmphasis(true);
								$printers -> setFont(Escpos::FONT_A);
								$printers -> setJustification(Escpos::JUSTIFY_LEFT);
								$printers -> selectPrintMode(Escpos::MODE_DOUBLE_HEIGHT);
								$printers -> feed();
                                                                    $printers -> text('PORT:  '.$b);
         
								$printers -> setEmphasis(true);
								$printers -> setFont(Escpos::FONT_A);
								$printers -> setJustification(Escpos::JUSTIFY_LEFT);
								$printers -> selectPrintMode(Escpos::MODE_DOUBLE_HEIGHT);
								$printers -> feed();
                                                                
								$printers -> setEmphasis(true);
								$printers -> setFont(Escpos::FONT_A);
								$printers -> setJustification(Escpos::JUSTIFY_LEFT);
								$printers -> selectPrintMode(Escpos::MODE_DOUBLE_HEIGHT);
								$printers -> feed();
                                                                  $printers -> text('Printer name:  '.$c);   
       
	$printers -> setTextSize(1, 2);
	$printers -> selectPrintMode();
	$printers -> feed();
	$printers -> cut();
	$printers -> close();		
         }
 else {
             echo 'sorry';  
             
         }
             }
             
             
else if($_REQUEST['value']=="quick_rest")
	 { 
            if($_REQUEST['type']=='lan'){
               $query3=$database->mysqlQuery( "update tbl_printersettings set pr_printerip='".$_REQUEST['ip']."',pr_printerport='".$_REQUEST['port']."',pr_defaultusb='N',pr_style='".$_REQUEST['style']."' ");
                  
            }else{
                $query3=$database->mysqlQuery(" update tbl_printersettings set pr_usbprinterip='".$_REQUEST['ip']."',pr_usbprinter='".$_REQUEST['port']."',pr_defaultusb='Y',pr_style='".$_REQUEST['style']."' ");
             
            } 
              
         } 
         
 else if($_REQUEST['value']=="quick_rest_on_off")
	 { 
            if($_REQUEST['type']=='lan'){
                
               $query3=$database->mysqlQuery( "update tbl_printersettings set pr_enable='".$_REQUEST['sts']."' where  pr_printerip='".$_REQUEST['ip']."' ");
                  
            }else{
                $query3=$database->mysqlQuery(" update tbl_printersettings set pr_enable='".$_REQUEST['sts']."' where  pr_usbprinterip='".$_REQUEST['ip']."' ");
             
            } 
              
  }   


 else if($_REQUEST['value']=="quick_rest_change")
	 { 
            if($_REQUEST['type']=='lan'){
                
               $query3=$database->mysqlQuery( "update tbl_printersettings set pr_printerip='".$_REQUEST['ip1']."' where  pr_printerip='".$_REQUEST['ip']."' ");
                  
            }else{
                $query3=$database->mysqlQuery(" update tbl_printersettings set pr_usbprinterip='".$_REQUEST['ip1']."' where  pr_usbprinterip='".$_REQUEST['ip']."' ");
             
            } 
              
  }  
         
         
         else if($_REQUEST['value']=="checktable_order")
	 {
		
		$ord=$_REQUEST['ord'];
                
   $sql_login = $database->mysqlQuery("select tr_displayorder from tbl_tablemaster  where tr_displayorder='$ord' and tr_floorid='".$_REQUEST['flr']."' "); 
	
	  
      $num_login   = $database->mysqlNumRows($sql_login);

	 
	  if($num_login >0)
	  {
		 echo 'sorry';
	  }
	  else
	  {
		echo 'ok';
	  }
	 }  
         else if($_REQUEST['value']=="checktable_order_edit")
	 {
		
		$ord=$_REQUEST['ord'];
	
	 $sql_login  =  $database->mysqlQuery("select tr_displayorder from tbl_tablemaster  where tr_displayorder='$ord' "
                 . " and tr_tableid!='".$_REQUEST['edit_id']."' and tr_floorid='".$_REQUEST['flr']."' "); 
	
	  
      $num_login   = $database->mysqlNumRows($sql_login);

	 
	  if($num_login >0)
	  {
		 echo 'sorry';
	  }
	  else
	  {
		echo 'ok';
	  }
	 }  
    else if($_REQUEST['value']=="approve_voucher_new")
	 {
        
            $staff_details = $database->show_login_ful_details($_SESSION['expodine_id']);
    $staff_id = $staff_details['ls_staffid'];
     
     $approvedby=$staff_id;
  
     
     if(isset($_REQUEST['active1']))
	{
		$active='Approved';
	}
        else 
         {
	$active='Approved';
        }
     
     
         $id1=$_REQUEST['voucherid'];
         $remarks=$_REQUEST['rmk'];
        
        $approveddate = date("Y-m-d H:i:s");
        $query4=$database->mysqlQuery("update tbl_voucherpayment set vp_approvedby='$approvedby',vp_approveddate='$approveddate',vp_remarks='$remarks',vp_status='$active' where vp_id='$id1'");
      // echo "update tbl_voucherpayment set vp_approvedby='$approvedby',vp_approveddate='$approveddate',vp_remarks='$remarks',vp_status='$active' where vp_id='$id1'";
        
    }     
    else if($_REQUEST['value']=="check_qr")
	 {
		
		if($_REQUEST['flr']!=''){
	$sql_login  =  $database->mysqlQuery("select fr_qr_order from tbl_floormaster  where fr_qr_order='Y' and fr_floorid !='".$_REQUEST['flr']."' "); 
	
	  
      $num_login   = $database->mysqlNumRows($sql_login);

	 
	  if($num_login >0)
	  {
		 echo 'sorry';
	  }
	  else
	  {
		echo 'ok';
	  }
            
                }else{
                
	 $sql_login  =  $database->mysqlQuery("select fr_qr_order from tbl_floormaster  where fr_qr_order='Y' "); 
	
	  
      $num_login   = $database->mysqlNumRows($sql_login);

	 
	  if($num_login >0)
	  {
		 echo 'sorry';
	  }
	  else
	  {
		echo 'ok';
	  }
          
          
                }
          
          
	 } 
         else if($_REQUEST['value']=="view_change")
	 {
             
             if($_REQUEST['type']=="KOT"){
             $sql_login  =  $database->mysqlQuery("update tbl_portionmaster  set pm_viewinkot='".$_REQUEST['view_kot']."'  where pm_id='".$_REQUEST['id']."'  "); 
             
             }
         
             if($_REQUEST['type']=="BILL"){
             $sql_login  =  $database->mysqlQuery("update tbl_portionmaster  set pm_viewinbill='".$_REQUEST['view_bill']."'   where pm_id='".$_REQUEST['id']."'   "); 
             }
         
         }
         else if($_REQUEST['value']=="change_kitchen_printer")
	 {
             
             
              $sql_login  =  $database->mysqlQuery("update tbl_menumaster set mr_kotcounter= '".$_REQUEST['kitchen']."'  where mr_maincatid='".$_REQUEST['cat']."'  ");
             
              
              $sql_login2  =  $database->mysqlQuery("update tbl_menumaincategory set last_printer_kitchen= '".$_REQUEST['kitchen']."'  where mmy_maincategoryid='".$_REQUEST['cat']."'  ");
             
    }
    else if($_REQUEST['value']=="tb_order_dis")
    {
             
                $ct=0;
                $sql_billhis="select max(tr_displayorder) as dis  from tbl_tablemaster WHERE tr_floorid='".$_REQUEST['flr']."' limit 1";
		$sql_billhistory  =  $database->mysqlQuery($sql_billhis); 
		$num_billhistory  = $database->mysqlNumRows($sql_billhistory);
		if($num_billhistory)
		{
		while($result_billhistory  = $database->mysqlFetchArray($sql_billhistory)) 
		{
              
                    $ct= $result_billhistory['dis'];
                }
                }
                
                if($ct>0){
                    
                   echo $ct;
                
                }else{
                    
                   echo '0';
                }
                
    }
    
      else if($_REQUEST['value']=="flr_order_dis")
    {
             
                $ct=0;
                $sql_billhis="select max(fr_order_display) as dis  from tbl_floormaster  limit 1";
		$sql_billhistory  =  $database->mysqlQuery($sql_billhis); 
		$num_billhistory  = $database->mysqlNumRows($sql_billhistory);
		if($num_billhistory)
		{
		while($result_billhistory  = $database->mysqlFetchArray($sql_billhistory)) 
		{
              
                    $ct= $result_billhistory['dis'];
                }
                }
                
                if($ct>0){
                    
                   echo $ct;
                
                }else{
                    
                   echo '0';
                }
                
    }
         
?>

    