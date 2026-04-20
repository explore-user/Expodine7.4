<?php
include('includes/session.php');		// Check session
//session_start();
include("database.class.php"); // DB Connection class
$database	= new Database(); 		// Create a new instance
 if($_REQUEST['value']=="chgedeflt"){
     if($_REQUEST['portionid']!=''){
	$portion="='".$_REQUEST['portionid']."'";
        $portion1="<>'".$_REQUEST['portionid']."'";
     }
     else{
         $portion="IS NULL";
         $portion1="IS  NULL";
     }
     if($_REQUEST['unitid']!=''){
	$unit="='".$_REQUEST['unitid']."'";
        $unit1="<>'".$_REQUEST['unitid']."'";
     }
     else{
         $unit="IS NULL";
          $unit1="IS  NULL";
     }
     if($_REQUEST['baseunitid']!=''){
	$baseunit="='".$_REQUEST['baseunitid']."'";
        $baseunit1="<>'".$_REQUEST['baseunitid']."'";
     }
     else{
         $baseunit="IS NULL";
         $baseunit1="IS  NULL";
     }
     
		// status="+status+"&meniid="+meniid+"&floorid="+floorid+"&portionid="+portionid
		 if($_REQUEST['status']=="ToNo")
		 {
		 	$sql_cat_s  =  $database->mysqlQuery("UPDATE tbl_menuratemaster SET mmr_default='N' WHERE  mmr_menuid='".$_REQUEST['meniid']."' AND mmr_floorid='".$_REQUEST['floorid']."' AND mmr_portion $portion and   mmr_unit_id $unit and  mmr_base_unit_id $baseunit and  mmr_unit_weight='".$_REQUEST['weight']."' "); 
			$sql_cat_s  =  $database->mysqlQuery("select * from tbl_menuratemaster where mmr_menuid='".$_REQUEST['meniid']."' AND mmr_floorid='".$_REQUEST['floorid']."' AND mmr_default='Y' "); 
			$num_cat_s  = $database->mysqlNumRows($sql_cat_s);
			if(!$num_cat_s)
			{
				$sql_cat_c  =  $database->mysqlQuery("select * from tbl_menuratemaster where mmr_menuid='".$_REQUEST['meniid']."' AND mmr_floorid='".$_REQUEST['floorid']."' AND mmr_portion $portion1 and  mmr_unit_id $unit1 and  mmr_base_unit_id $baseunit1 and  mmr_unit_weight<>'".$_REQUEST['weight']."' limit 0,1"); 
				$num_cat_c  = $database->mysqlNumRows($sql_cat_c);
				if($num_cat_c)
				{
					while($result_cat_c  = $database->mysqlFetchArray($sql_cat_c)) 
						{
							$database->mysqlQuery("UPDATE tbl_menuratemaster SET mmr_default='Y' WHERE  mmr_menuid='".$result_cat_c['mmr_menuid']."' AND mmr_floorid='".$result_cat_c['mmr_floorid']."' AND mmr_portion $portion and   mmr_unit_id $unit and  mmr_base_unit_id $baseunit and  mmr_unit_weight='".$result_cat_c['mmr_unit_weight']."' "); 
							//echo "updated- one else changed";
						}
				}else
				{
					$sql_cat_s  =  $database->mysqlQuery("UPDATE tbl_menuratemaster SET mmr_default='Y' WHERE  mmr_menuid='".$_REQUEST['meniid']."' AND mmr_floorid='".$_REQUEST['floorid']."' AND mmr_portion $portion and   mmr_unit_id $unit and  mmr_base_unit_id $baseunit and  mmr_unit_weight='".$result_cat_c['mmr_unit_weight']."' "); 
					//echo "sorry- Nothing else-one yes";
				}
			}
			
			
		 }else
		 {
			 $sql_cat_s  =  $database->mysqlQuery("UPDATE tbl_menuratemaster SET mmr_default='Y' WHERE  mmr_menuid='".$_REQUEST['meniid']."' AND mmr_floorid='".$_REQUEST['floorid']."' AND mmr_portion $portion and   mmr_unit_id $unit and  mmr_base_unit_id $baseunit and  mmr_unit_weight='".$_REQUEST['weight']."' ");
                         //echo " UPDATE tbl_menuratemaster SET mmr_default='Y' WHERE  mmr_menuid='".$_REQUEST['meniid']."' AND mmr_floorid='".$_REQUEST['floorid']."' AND mmr_portion $portion and   mmr_unit_id $unit and  mmr_base_unit_id $baseunit and  mmr_unit_weight='".$_REQUEST['weight']."' " ;
			 $sql_cat_y  =  $database->mysqlQuery("select * from tbl_menuratemaster where mmr_menuid='123' AND mmr_floorid='".$_REQUEST['floorid']."' and mmr_default='Y' AND  mmr_portion $portion1 and   mmr_unit_id $unit1 and  mmr_base_unit_id $baseunit1 and  mmr_unit_weight<>'".$_REQUEST['weight']."'"); 
			 //echo "select * from tbl_menuratemaster where mmr_menuid='".$_REQUEST['meniid']."' AND mmr_floorid='".$_REQUEST['floorid']."' AND mmr_default='Y' AND  mmr_portion $portion1 and   mmr_unit_id $unit1 and  mmr_base_unit_id $baseunit1 and  mmr_unit_weight<>'".$_REQUEST['weight']."'";
                         $num_cat_y  = $database->mysqlNumRows($sql_cat_y);
			if($num_cat_y)
			{
				while($result_cat_y  = $database->mysqlFetchArray($sql_cat_y)) 
                                    {
				$database->mysqlQuery("UPDATE tbl_menuratemaster SET mmr_default='N' WHERE  mmr_menuid='".$result_cat_y['mmr_menuid']."' AND mmr_floorid='".$result_cat_y['mmr_floorid']."' AND mmr_portion='".$result_cat_y['mmr_portion']."' and   mmr_unit_id='".$result_cat_y['mmr_unit_id']."' and  mmr_base_unit_id='".$result_cat_y['mmr_base_unit_id']."' "); 
				//echo "updated- no thers to No";
                                    }
			}
			  
			 
		 }
	 }