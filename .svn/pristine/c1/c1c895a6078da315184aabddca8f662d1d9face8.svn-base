<?php

session_start();
include("..\database.class.php"); 
$database	= new Database();
function cleanData(&$str)
  {
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
  }
  
  require_once '../excel_reader.php'; 
  require_once '../Classes/PHPExcel/IOFactory.php';

 if($_SERVER['REQUEST_METHOD']=='POST' && $_FILES['excel_def']['name']!="")
    {
       
        if ( $_FILES['excel_def']['name'] )
		{
            
                        $excel = new PhpExcelReader;
                        $excel->setOutputEncoding('UTF-8');
                        $file=$_FILES["excel_def"]["name"];
                        move_uploaded_file($_FILES['excel_def']['tmp_name'], "../../util/Menu_upload/".$file);
                        $file1="../../util/Menu_upload/".$file;
                        
                        $excel->read($file1);
                        
                            $x=3;
                            $data=array();
                            while($x<=$excel->sheets[0]['numRows']) {
                                $y=1;
                                 while($y <=$excel-> sheets[0]['numCols']) {
                                $data[]= isset($excel->sheets[0]['cells'][$x][$y]) ? $excel->sheets[0]['cells'][$x][$y] : '';
                                

                            $y++;  
                             }
                             
                         
                              
          
        $category='';                       
        $sql_login  =  $database->mysqlQuery("select  mmy_maincategoryid from tbl_menumaincategory where mmy_maincategoryname='$data[9]' ");
        $num_login   = $database->mysqlNumRows($sql_login);
	if($num_login){
            while($result_login  = $database->mysqlFetchArray($sql_login)){
            $category=$result_login['mmy_maincategoryid'];
        }
        
        }else{
            
             if($data[1]=='Raw'){
                
            $sql_login  =  $database->mysqlQuery("INSERT INTO `tbl_menumaincategory`( `mmy_maincategoryname`, "
                    . "`mmy_active`, `mmy_branchid`,  "
                    . " `mmy_inventory`) VALUES ('$data[9]','Y','1','Y' )" );
            }else{
                  $sql_login  =  $database->mysqlQuery("INSERT INTO `tbl_menumaincategory`( `mmy_maincategoryname`, "
                    . "`mmy_active`, `mmy_branchid`,  "
                    . " `mmy_inventory`) VALUES ('$data[9]','Y','1','N' )");
            }
            
            
        $sql_login2  =  $database->mysqlQuery("select  mmy_maincategoryid from tbl_menumaincategory where mmy_maincategoryname='$data[9]' ");
        $num_login2   = $database->mysqlNumRows($sql_login2);
	if($num_login2){
            while($result_login2  = $database->mysqlFetchArray($sql_login2)){
                
            $category=$result_login2['mmy_maincategoryid'];
        }
        }
            
            
            
        }
            
        
        
        $kitchen='';                        
        $sql_login2  =  $database->mysqlQuery("select  kr_kotcode from tbl_kotcountermaster where kr_kotname='$data[10]' ");
        $num_login2   = $database->mysqlNumRows($sql_login2);
	if($num_login2){
            while($result_login2  = $database->mysqlFetchArray($sql_login2)){
                
            $kitchen=$result_login2['kr_kotcode'];
        }
        }else{
            
            $sql_login  =  $database->mysqlQuery("INSERT INTO `tbl_kotcountermaster`( `kr_kotname`, "
            . " `kr_branchid` ) VALUES ('$data[10]','1' )");
             
        $sql_login2  =  $database->mysqlQuery("select  kr_kotcode from tbl_kotcountermaster where kr_kotname='$data[10]' ");
        $num_login2   = $database->mysqlNumRows($sql_login2);
	if($num_login2){
            while($result_login2  = $database->mysqlFetchArray($sql_login2)){
                
            $kitchen=$result_login2['kr_kotcode'];
        }
        }
        
        }
        
        
        $inv='null';                        
        $sql_login17  =  $database->mysqlQuery("select  ti_id from tbl_inv_kitchen where ti_name='$data[8]' ");
        $num_login17   = $database->mysqlNumRows($sql_login17);
	if($num_login17){
            while($result_login17  = $database->mysqlFetchArray($sql_login17)){
            $inv=$result_login17['ti_id'];
        }
        }else{
            
            $sql_login  =  $database->mysqlQuery("INSERT INTO `tbl_inv_kitchen`(`ti_name`, "
            . " `ti_type` ) VALUES ('$data[8]','sub' )");
             
        $sql_login2  =  $database->mysqlQuery("select  ti_id from tbl_inv_kitchen where ti_name='$data[8]'  ");
        $num_login2   = $database->mysqlNumRows($sql_login2);
	if($num_login2){
            while($result_login2  = $database->mysqlFetchArray($sql_login2)){
                
            $inv=$result_login2['ti_id'];
        }
        }
        
        }
          
        
          
        
        
       $mod_date=date("Y-m-d H:i:s");  
       
      
      $itemcode='NULL';  
          
       
        if($data[11]!=''){
           
         $item_pr_barcode="'".$data[11]."'";     
       }else{
          $item_pr_barcode='NULL';
       }    
       
       
        if($data[12]!=''){
           
         $item_pr_reorder=$data[12];     
       }else{
          $item_pr_reorder='0';
       }    
       
       if($data[13]!=''){
           
         $item_central_id=$data[13];     
       }else{
          $item_central_id='NULL';
       }    
       
       
        if($data[14]!=''){
           
         $item_pr_rate=$data[14];       
       }else{
          $item_pr_rate='0';   
       }    
       
       
    
    $pkd = 'NULL';
    
  
    $exp ='NULL';
    
      
    $shortcode=  substr($data[2], 0,19);
                         
    $rate_type=$data[5];
    
    $unittype=$data[6];
    
        $base_unit='NULL';                        
        $sql_login17  =  $database->mysqlQuery("select  bu_id from tbl_base_unit_master where bu_name='$data[7]' ");
        $num_login17   = $database->mysqlNumRows($sql_login17);
	if($num_login17){
            while($result_login17  = $database->mysqlFetchArray($sql_login17)){
            $base_unit="'".$result_login17['bu_id']."'";
        }
        }
        
        
         $main_unit='NULL';                        
        $sql_login171  =  $database->mysqlQuery("select  u_id from tbl_unit_master where u_name='$data[7]' ");
        $num_login171   = $database->mysqlNumRows($sql_login171);
	if($num_login171){
            while($result_login171  = $database->mysqlFetchArray($sql_login171)){
            $main_unit="'".$result_login171['u_id']."'";
        }
        }
        
          
      /////////////menu master//////////////
       
         $date=date('Y-m-d');       
        $sql_login_m1  =  $database->mysqlQuery("select  mr_menuid from tbl_menumaster where mr_menuname='$data[2]' ");
        $num_login_m1   = $database->mysqlNumRows($sql_login_m1);
	if(!$num_login_m1){
        
    
                            $sql_insert="INSERT INTO `tbl_menumaster`(`mr_menuname`, `mr_maincatid`,  "
                                    . " `mr_diet`, `mr_time_min`, `mr_active`, `mr_kotcounter`, `mr_modifieddate`, `mr_rating`,"
                                    . " `mr_prepmode`, `mr_branchid`, `mr_itemshortcode`, `mr_dailystock`, `mr_manualrateentry`, `mr_itemcode`, "
                                    . " `mr_dailystock_in_number`, `mr_android_sync`, `mr_show_in_kod`, `mr_excempt_tax`, `mr_rate_type`,"
                                    . " `mr_unit_type`, `mr_base_unit`, `mr_add_on`, `mr_show_in_kot_print`, `cloud_sync`, `manual_barcode`,"
                                    . " `mr_ingredient`, `mr_replacer`, `mr_product_type`, `mr_inventory_kitchen`, "
                                    . " `mr_reorder_level`, `mr_purchase_price`,`mr_raw_barcode`,`mr_central_id`) "
                                    
                                    . " VALUES ('$data[2]','$category',"
                                    . " 'General','10','Y','$kitchen','$mod_date','0',"
                                    . " 'General','1','$shortcode','Y','N',$itemcode,"
                                    . " 'N','Y','Y','N','$rate_type',"
                                    . " '$unittype',$base_unit,'N','Y','N','N',"
                                    . " 'N','N','$data[1]',$inv,"
                                    . " '$item_pr_reorder','$item_pr_rate',$item_pr_barcode,$item_central_id )"; 
                            
                            
                            
                            
                          
                            $result_insert = mysqli_query($localhost,$sql_insert) or die(mysqli_error($localhost));
                            
                            
                 
                            
                            

        }
                            
         ///////////////////////////store stock///////////////          
                            
             if($data[4]!=''){               
             $qty=$data[4];
             }else{
                $qty=0;  
             }
             
              if($data[3]!=''){               
             $wgt="'".$data[3]."'";     
             }else{
                $wgt='0';  
             }
             
             
             
             
          if($data[7]=='Nos' || $rate_type=='Portion' ){  
              
              if($unittype=='Loose'){
                  
                  $main_unit='NULL';
             }
              
             if($unittype=='Packet'){
                  
                  $base_unit='NULL';
             }
              
          if($unittype=='' || $unittype=='NULL' || $unittype=='null'){
                  
                  $main_unit='NULL';
                   $base_unit='NULL';
              }
              
              
              if($rate_type=='Portion'){
                   $portion='1';
                
              }else{
                   $portion='NULL';
              }
              
               
          $final=($item_pr_rate*$qty);
            
        $sql_login_m  =  $database->mysqlQuery("select  mr_menuid from tbl_menumaster where mr_menuname='$data[2]' ");
        $num_login_m   = $database->mysqlNumRows($sql_login_m);
	if($num_login_m){
            while($result_login_m  = $database->mysqlFetchArray($sql_login_m)){   
              
                
            
                
              if($data[1]!='Raw'){
                  
                
                  
                  
                ////counter sale rate//// 
             $sql_table_selrate  =  $database->mysqlQuery("insert into tbl_menurate_counter (`mrc_menuid`,  `mrc_rate_type`,"
                   . " `mrc_unit_type`, `mrc_unit_weight`, `mrc_unit_id`, `mrc_base_unit_id`, `mrc_rate`,"
                   . " `mrc_default`, `mrc_barcode`,mrc_branchid,mrc_portion) "
                   . "  VALUES('".$result_login_m['mr_menuid']."','$rate_type',"
                   . " '$unittype',$wgt,$main_unit , "
                   . "  $base_unit,'$item_pr_rate','Y',$item_pr_barcode,'1',$portion) "); 
              ///counter sale end /////
                
                 
             //ta start//
              $sql_login  =  $database->mysqlQuery("select tol_id from tbl_online_order"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
                $sql_table_selrate  =  $database->mysqlQuery("insert into tbl_menuratetakeaway (`mta_menuid`, `mta_food_partner`, `mta_rate_type`,"
                   . "  `mta_unit_type`, `mta_unit_weight`, `mta_unit_id`, `mta_base_unit_id`, `mta_rate`,"
                   . " `mta_default`, `mta_barcode`,mta_branchid,mta_portion) "
                   . "  VALUES('".$result_login_m['mr_menuid']."','".$result_login['tol_id']."','$rate_type',"
                   . " '$unittype',$wgt,$main_unit , "
                   . "  $base_unit,'$item_pr_rate','Y',$item_pr_barcode,'1',$portion) ");
                }}
                /////ta end ///
                
                
                ///di start///
               
                
          $sql_loginf  =  $database->mysqlQuery("SELECT fr_floorid  FROM tbl_floormaster"); 
	  $num_loginf   = $database->mysqlNumRows($sql_loginf);
	  if($num_loginf){
		  while($result_loginf  = $database->mysqlFetchArray($sql_loginf)) 
			{
                
                 $sql_table_selrate  =  $database->mysqlQuery("insert into tbl_menuratemaster (`mmr_menuid`, `mmr_floorid`, `mmr_rate_type`,"
                   . "  `mmr_unit_type`, `mmr_unit_weight`, `mmr_unit_id`, `mmr_base_unit_id`, `mmr_rate`,"
                   . " `mmr_default`, `mmr_barcode`, `mmr_android_sync`,mmr_portion) "
                   . "  VALUES('".$result_login_m['mr_menuid']."','".$result_loginf['fr_floorid']."','$rate_type',"
                   . "  '$unittype',$wgt,"
                   . "  $main_unit,$base_unit,'$item_pr_rate','Y',$item_pr_barcode,'N',$portion) ");
          }}
                //////di end //////
                
                
              }
              
               if($data[1]!='Menu'){
                
              $sql_login5  =  $database->mysqlQuery("INSERT INTO `tbl_store_stock`(`ts_product`,`ts_barcode`,`ts_qty`, `ts_weight`,
              `ts_unit`, `ts_average`, `ts_total`, `ts_reorder`, `ts_last_grn`,ts_rate_type,ts_store,
                ts_unit_price,ts_stock_update_date,ts_tax,ts_tx_amount )
               values('".$result_login_m['mr_menuid']."',  $item_pr_barcode, '$qty', $wgt, '$data[7]','0' ,'$final','$item_pr_reorder',
               'INI','$unittype',$inv,$item_pr_rate,'".$date."','0','0')");
                     
               }
        }}
              
              
             
        }else{
            
            
             if($unittype=='Loose'){
                  
                  $main_unit='NULL';
              }
              
               if($unittype=='Packet'){
                  
                  $base_unit='NULL';
              }
              
          if($unittype=='' || $unittype=='NULL' || $unittype=='null'){
                  
                  $main_unit='NULL';
                   $base_unit='NULL';
              }
            
                    
               if($unittype=='Packet' && ($data[7]=='KG' || $data[7]=='LTR')) {  
                   
                $final=($item_pr_rate*$qty);
                    
                    
        $sql_login_m  =  $database->mysqlQuery("select  mr_menuid from tbl_menumaster where mr_menuname='$data[2]' ");
        $num_login_m   = $database->mysqlNumRows($sql_login_m);
	if($num_login_m){
            while($result_login_m  = $database->mysqlFetchArray($sql_login_m)){   
                
                 if($data[1]!='Raw'){
                 ////counter sale rate//// 
             $sql_table_selrate  =  $database->mysqlQuery("insert into tbl_menurate_counter (`mrc_menuid`,  `mrc_rate_type`,"
                   . " `mrc_unit_type`, `mrc_unit_weight`, `mrc_unit_id`, `mrc_base_unit_id`, `mrc_rate`,"
                   . " `mrc_default`, `mrc_barcode`,mrc_branchid) "
                   . "  VALUES('".$result_login_m['mr_menuid']."','$rate_type',"
                   . " '$unittype',$wgt,'$main_unit' , "
                   . "  '$base_unit','$item_pr_rate','Y',NULL,'1') "); 
              ///counter sale end /////
             
                //ta start//
              $sql_login  =  $database->mysqlQuery("select tol_id from tbl_online_order"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
                $sql_table_selrate  =  $database->mysqlQuery("insert into tbl_menuratetakeaway (`mta_menuid`, `mta_food_partner`, `mta_rate_type`,"
                   . "  `mta_unit_type`, `mta_unit_weight`, `mta_unit_id`, `mta_base_unit_id`, `mta_rate`,"
                   . " `mta_default`, `mta_barcode`,mta_branchid) "
                   . "  VALUES('".$result_login_m['mr_menuid']."','".$result_login['tol_id']."','$rate_type',"
                   . " '$unittype',$wgt,$main_unit , "
                   . "  $base_unit,'$item_pr_rate','Y',$item_pr_barcode,'1') ");
                }}
                /////ta end ///
                
                
                ///di start///
               
                
          $sql_loginf  =  $database->mysqlQuery("SELECT fr_floorid  FROM tbl_floormaster"); 
	  $num_loginf   = $database->mysqlNumRows($sql_loginf);
	  if($num_loginf){
		  while($result_loginf  = $database->mysqlFetchArray($sql_loginf)) 
			{
                
                 $sql_table_selrate  =  $database->mysqlQuery("insert into tbl_menuratemaster (`mmr_menuid`, `mmr_floorid`, `mmr_rate_type`,"
                   . "  `mmr_unit_type`, `mmr_unit_weight`, `mmr_unit_id`, `mmr_base_unit_id`, `mmr_rate`,"
                   . " `mmr_default`, `mmr_barcode`, `mmr_android_sync`) "
                   . "  VALUES('".$result_login_m['mr_menuid']."','".$result_loginf['fr_floorid']."','$rate_type',"
                   . "  '$unittype',$wgt,"
                   . "  $main_unit,$base_unit,'$item_pr_rate','Y',$item_pr_barcode,'N') ");
          }}
                //////di end //////
             
                 } 
                
                 
                  if($data[1]!='Menu'){
               $sql_login5  =  $database->mysqlQuery("INSERT INTO `tbl_store_stock`(`ts_product`,`ts_barcode`,`ts_qty`, `ts_weight`,
              `ts_unit`, `ts_average`, `ts_total`, `ts_reorder`, `ts_last_grn`,ts_rate_type,ts_store,
                ts_unit_price,ts_stock_update_date,ts_tax,ts_tx_amount )
               values('".$result_login_m['mr_menuid']."',  $item_pr_barcode, '$qty', $wgt, '$data[7]','0' ,'$final','$item_pr_reorder',
               'INI','$unittype',$inv,$item_pr_rate,'".$date."','0','0' )");
                  }
              
        }}
                    
        }else{
            
            
            if($unittype=='Loose'){
                  
                  $main_unit='NULL';
              }
              
               if($unittype=='Packet'){
                  
                  $base_unit='NULL';
              }
              
          if($unittype=='' || $unittype=='NULL' || $unittype=='null'){
                  
                  $main_unit='NULL';
                   $base_unit='NULL';
              }
            
              $wgt=str_replace("'",'',$wgt);
              
        $final=($item_pr_rate*$wgt);
                         
        $sql_login_m  =  $database->mysqlQuery("select  mr_menuid from tbl_menumaster where mr_menuname='$data[2]' ");
        $num_login_m   = $database->mysqlNumRows($sql_login_m);
	if($num_login_m){
            while($result_login_m  = $database->mysqlFetchArray($sql_login_m)){  
                
                
                
                  if($data[1]!='Raw'){
                 ////counter sale rate//// 
             $sql_table_selrate  =  $database->mysqlQuery("insert into tbl_menurate_counter (`mrc_menuid`,  `mrc_rate_type`,"
                   . " `mrc_unit_type`, `mrc_unit_weight`, `mrc_unit_id`, `mrc_base_unit_id`, `mrc_rate`,"
                   . " `mrc_default`, `mrc_barcode`,mrc_branchid) "
                   . "  VALUES('".$result_login_m['mr_menuid']."','$rate_type',"
                   . " '$unittype',$wgt,'$main_unit' , "
                   . "  '$base_unit','$item_pr_rate','Y',NULL,'1') "); 
              ///counter sale end /////
             
                //ta start//
              $sql_login  =  $database->mysqlQuery("select tol_id from tbl_online_order"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
                $sql_table_selrate  =  $database->mysqlQuery("insert into tbl_menuratetakeaway (`mta_menuid`, `mta_food_partner`, `mta_rate_type`,"
                   . "  `mta_unit_type`, `mta_unit_weight`, `mta_unit_id`, `mta_base_unit_id`, `mta_rate`,"
                   . " `mta_default`, `mta_barcode`,mta_branchid) "
                   . "  VALUES('".$result_login_m['mr_menuid']."','".$result_login['tol_id']."','$rate_type',"
                   . " '$unittype',$wgt,$main_unit , "
                   . "  $base_unit,'$item_pr_rate','Y',$item_pr_barcode,'1') ");
                }}
                /////ta end ///
                
                
                ///di start///
               
                
          $sql_loginf  =  $database->mysqlQuery("SELECT fr_floorid  FROM tbl_floormaster"); 
	  $num_loginf   = $database->mysqlNumRows($sql_loginf);
	  if($num_loginf){
		  while($result_loginf  = $database->mysqlFetchArray($sql_loginf)) 
			{
                
                 $sql_table_selrate  =  $database->mysqlQuery("insert into tbl_menuratemaster (`mmr_menuid`, `mmr_floorid`, `mmr_rate_type`,"
                   . "  `mmr_unit_type`, `mmr_unit_weight`, `mmr_unit_id`, `mmr_base_unit_id`, `mmr_rate`,"
                   . " `mmr_default`, `mmr_barcode`, `mmr_android_sync`) "
                   . "  VALUES('".$result_login_m['mr_menuid']."','".$result_loginf['fr_floorid']."','$rate_type',"
                   . "  '$unittype',$wgt,"
                   . "  $main_unit,$base_unit,'$item_pr_rate','Y',$item_pr_barcode,'N') ");
          }}
                //////di end //////
             
                 } 
                
                 if($data[1]!='Menu'){
                     $sql_login5  =  $database->mysqlQuery("INSERT INTO `tbl_store_stock`(`ts_product`,`ts_barcode`,`ts_qty`, `ts_weight`,
              `ts_unit`, `ts_average`, `ts_total`, `ts_reorder`, `ts_last_grn`,ts_rate_type,ts_store,
                ts_unit_price,ts_stock_update_date,ts_tax,ts_tx_amount )
               values('".$result_login_m['mr_menuid']."',  $item_pr_barcode, '$qty', $wgt, '$data[7]','0' ,'$final','$item_pr_reorder',
               'INI','$unittype',$inv,$item_pr_rate,'".$date."','0','0' )");
              
                     
                 }
                 
                }}
        }
                    
                    
        }
                
                
        
              unset($data);
              $x++;              
                     
                      
                                             
     }
                          
                             
          
       }
        header("Location:store_stock.php");
    }
?>
<html>
    
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="assets/images/favicon.png">

        <title>Store Stock </title>

        <!--Morris Chart CSS -->
        <link href="assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
        <link href="assets/plugins/custombox/css/custombox.css" rel="stylesheet">
         <link href="assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css"/>
        

		<link href="assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
        <link href="assets/css/content.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="assets/js/modernizr.min.js"></script>

		<style>.dataTables_length{display:none;}.dataTables_filter{display:none}div.dataTables_info{padding-top:7px}div.dataTables_paginate ul.pagination{margin-top:0 !important}.card-box{margin-bottom:0}.content-page > .content{margin-bottom:0}.nav > li > a{padding:16px 15px;}.logo{padding:15px;}.table > thead > tr > th{text-align:center;font-size: 14px}.table tr td{font-size: 14px}
  
  .production-btn3{
    right:-256px !important;
  }
  
  .production-btn2{
    right:-385px !important;
  }
  
  .production-btn{
    position: absolute;
    top: -3px;
    right: -469px;
    font-size: 1rem !important;
}
@media(max-width:1350px) {
    .production-btn{
        right: -294px;
        font-size: 0.8rem !important;
    } 
    .production-btn3{
      right: -119px !important;
  }
  
  .production-btn2{
    right: -225px !important;
  }
}
  </style>

    </head>


    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            <?php include( 'includes/header.php') ?>
            <!-- Top Bar End -->
            <div class="loyalty_mgmt_head">
                
                <div class="">
                    
     <form enctype="multipart/form-data"   method="post" name="submitxmldetails" id="submitxmldetails"> 
         
        
         <i title="DEFAULT EXCEL DOWNLOAD" class="fa fa-download" onclick="default_excel('download');" style="position: absolute;top: 0px;left: 28px;border: solid 1px ;padding: 2px;cursor: pointer;border-radius: 5px;background-color: #b4d6db"></i>  
         <i  class="fa fa-file-excel-o"  style="position: absolute;top: 0px;left: 0px;border: solid 1px #1C6C40;padding: 2px;cursor: pointer; color:#1C6C40;"></i>            
     <input type="file" id="excel_def"  name="excel_def" style="font-size: 7px;position: absolute;top: 0px;left: 0px;width: 22px;z-index:1;height: 25px;opacity: 0;cursor: pointer;" />
                    
                    
      <i title="UPLOAD EXCEL FOR ITEM ADD AND STOCK ADD" class="fa fa-upload"   onclick="default_excel('upload');"    style="position: absolute;top: 0px;left: -29px;;border: solid 1px ;padding: 2px;cursor: pointer;border-radius: 5px;background-color: #b4d6db"></i>  
      
      <span class="err_stk" style="float: left;color: darkred;font-size: 9px;margin-left: -110px;"></span>
     </form> 
                    
                    
      <span classs="" style="    margin-left: 65px;font-size: 1.2rem;border-radius: 0.5rem;box-shadow: 0rem 0rem 0rem 0.1rem #fbaea4;color: #000000;background-image: linear-gradient(223deg, #ffffff, #ffffff)!important;padding: 0.7rem;">STORE STOCK</span> 
                    
                    
                    <?php
                    $stock_val='0.000'; $item_ct=0;
                    
                 $sql_kotlist  =  $database->mysqlQuery("SELECT sum(ts_total) as stock_value from tbl_store_stock "); 
 
                    $num_kotlist  = $database->mysqlNumRows($sql_kotlist);
					if($num_kotlist){ 
				while($result_kotlist99  = $database->mysqlFetchArray($sql_kotlist)) 
							  {  
                                    $stock_val=$result_kotlist99['stock_value'];
                                    
                                }
                                }
                                
                       $sql_kotlist5  =  $database->mysqlQuery("SELECT ts_total from tbl_store_stock group by ts_product "); 
 
                    $num_kotlist  = $database->mysqlNumRows($sql_kotlist5);
					if($num_kotlist){ 
				while($result_kotlist99  = $database->mysqlFetchArray($sql_kotlist5)) 
				{  
                                   $item_ct++;
                                    
                                }
                                }
                                         
                                
                                
                           if($stock_val==''){
                               
                                $stock_val='0.000';
                           }     
                                
                                
                    ?>
                     
                    <span style="font-size: 11px;font-weight: bold;margin-left: -6px"> &nbsp;  Stock Amount : <span  id="stock_val_on"><?=$stock_val?></span> | Items : <span id="item_count"><?=$item_ct?></span> </span> 
                
                </div>
                
               
                
                
               <span class="production-btn production-btn3" style="font-size: 1.6rem;border-radius: 0.5rem;color: #ffffff !important;background-image: linear-gradient(223deg,#433d54, #3a3939)!important;padding: 0.5rem;"><a style="color:#fff;" href="monthly_store_stock.php">LAST MONTH</a></span>
              
                
            <span class="production-btn production-btn2" style="font-size: 1.6rem;border-radius: 0.5rem;color: #ffffff !important;background-image: linear-gradient(223deg,#4dbfcb, #3a3939)!important;padding: 0.5rem;"><a style="color:#fff;" href="conversion.php">CONVERSION HISTORY</a></span>
            
            
               <?php if($_SESSION['ser_production']=='Y'){  ?>
                <span class="production-btn" style="font-size: 1.6rem;border-radius: 0.5rem;color: #ffffff !important;background-image: linear-gradient(223deg,#b75c5c, #ff9797)!important;padding: 0.5rem;"><a style="color:#fff;" href="production.php">PRODUCTION</a></span>
              <?php  } ?>
              
             
            </div>

            
            
          
            
            
            <div class="content-page">
               
                <div class="content">
                	
                    <div class="container" style="overflow:auto;" >
<div class="inv-req-content">


<div class="inv-req-history" >
 <span id="load_error" style="color:darkred;font-size: 10px;float: right;margin-right:77px;margin-top: -25px;font-weight: bold" ></span>

  <div class="history-filter">
      
      
      <select onchange="search_history();"  id="store" style="display: block ;font-weight: bold">
       <option value="">Store</option>  
     <?php
      
              
     $sql_kotlist  =  $database->mysqlQuery("SELECT * from  tbl_inv_kitchen where ti_status='Y' "); 
 
                 $num_kotlist  = $database->mysqlNumRows($sql_kotlist);
					if($num_kotlist){ 
				while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
							  {  
                                    
                                    ?>
       
       <option value="<?=$result_kotlist['ti_id']?>"><?=$result_kotlist['ti_name']?></option>  
       <?php
                                }
                                }
            ?>                    
          
  </select>
        
      
      
      <select onchange="search_history();"  id="menu_type">
    
       <option value="">All</option>
    
           <option value="Finished">Finished Goods</option>
            <option value="Raw">Raw Materials</option>
        </select>
      
      
      
      
      
      
      <input onkeyup="search_history();" placeholder="Product" id="product"   type="text" style=""> 
      <input onkeyup="search_history();" placeholder="Barcode" id="barcode"   type="text" style=""> 
 
  <select onchange="search_history();"  id="category">
    
    <option value="">Category</option>
    
     <?php
     $sql_kotlist  =  $database->mysqlQuery("SELECT mmy_maincategoryid,mmy_maincategoryname from tbl_menumaincategory  "); 
 
                 $num_kotlist  = $database->mysqlNumRows($sql_kotlist);
					if($num_kotlist){ 
				while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
					{  
                                    
                                    ?>
       
       <option value="<?=$result_kotlist['mmy_maincategoryid']?>"><?=$result_kotlist['mmy_maincategoryname']?></option>  
         <?php
                  }
              }
         ?>                    
  </select>
      
      
   <select onchange="search_history();"  id="brand" style="display: none ">
       <option value="">Brand</option>  
     <?php
      
              
     $sql_kotlist  =  $database->mysqlQuery("SELECT tg_brand from tbl_grn_order where  tg_set='Y' and tg_brand!=''  group by  tg_brand "); 
 
                 $num_kotlist  = $database->mysqlNumRows($sql_kotlist);
					if($num_kotlist){ 
				while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
							  {  
                                    
                                    ?>
       
       <option value="<?=$result_kotlist['tg_brand']?>"><?=$result_kotlist['tg_brand']?></option>  
       <?php
                                }
                                }
            ?>                    
          
  </select>
      
      
     
      
      
   

   
    <select onchange="search_history();"  id="reorder">
    
    <option value="">Reorder By</option>
    
    <option value="nostock">NO STOCK</option>
    
    <option value="reorder">REORDER LEVEL</option>
    </select>
   
      
       <select onchange="search_history();"  id="stock_order">
    
    <option value="">Order By</option>
    
    <option value="higherqty">HIGHER QTY</option>
    
    <option value="lowerqty">LOWER QTY </option>
    
    
    <option value="higherwgt">HIGHER WEIGHT </option>
    
    <option value="lowerwgt">LOWER WEIGHT </option>
    
    </select>
      
      
  
   <input autocomplete="off" onchange="search_history();" placeholder="Expiry Date" id="expiry" class="datepicker" type="text" style=""> 
   
   
    <select onchange="search_history();"  id="rt">
    
       <option value="">Rate Type</option>
    
           <option value="Single">Single</option>
            <option value="Loose">Loose</option>
             <option value="Packet">Packet</option>
        </select>
   
    <select onchange="search_history();"  id="ut">
    
       <option value="">Unit Type</option>
    
           <option value="Single">Single</option>
            <option value="Nos">Nos</option>
              <option value="KG">Kg</option>
              <option value="LTR">Ltr</option>
              
        </select>
   
   
   
  
   <span title="Store Stock Excel Sheet For Qty-Weight Entry" onclick="excel_download()" classs="" style="display: block;cursor: pointer;font-size: 1.6rem;border-radius: 0.5rem;box-shadow: 0rem 0rem 0rem 0.1rem #fbaea4;color: #000000;padding: 3px;background-color: darkred;color: white">Excel</span> 
  
  </div>
<div style="overflow-y: auto;height: 75vh;position: relative" id="load_store_stock">


</div>
    
</div>
	</div>
	</div>
	</div>

     <input type="hidden" value="<?=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>" id="url_check" >            
                
        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>

        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/wow.min.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>

        
<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatables/dataTables.bootstrap.js"></script>

        <script src="assets/pages/datatables.init.js"></script>
        <script src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>
        
         <script src="assets/plugins/sweet-alert2/sweetalert2.min.js"></script>
        <script src="assets/pages/jquery.sweet-alert2.init.js"></script>
        
        <!-- Modal-Effect -->
        <script src="assets/plugins/custombox/js/custombox.min.js"></script>
        <script src="assets/plugins/custombox/js/legacy.min.js"></script>
       <script src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script> 
        
			<script type="text/javascript">
    $(document).ready(function () {
        
         var url_check=$('#url_check').val();
    
   var new_id=url_check.split('from_id=');
   
 
   if(new_id[1]=='dash'){
       
      $('#reorder').val('reorder'); 
          search_history();
          
     }else{
        
        var data="set=load_store_stock&reorder=&product=&expiry=&brand=&category=&barcode=&store=&stock_order=&menu_type=&rt=&ut="
        $.ajax({
        type: "POST",
        url: "load_inventory.php",
        data: data,
        success: function(data)
        {
           
           $('#load_store_stock').html($.trim(data));
         
        }
    });
    
    }
    
    $( ".datepicker").datepicker({
               changeMonth: true,
               changeYear: true,
               format: 'yyyy-mm-dd',
               autoclose: true,
               todayHighlight: true
           });
    
    var data="set=set_monthly_store_stock"
        $.ajax({
        type: "POST",
        url: "load_inventory.php",
        data: data,
        success: function(data)
        { 
           
        }
    });
        
        
        $('#datatable').dataTable();
        $('#datatable-keytable').DataTable({keys: true});
        $('#datatable-responsive').DataTable();
        $('#datatable-colvid').DataTable({
            "dom": 'C<"clear">lfrtip',
            "colVis": {
                "buttonText": "Change columns"
            }
        });
        
	var table = $('#datatable-levels').DataTable({
            scrollY: "560px",
            scrollX: true,
            scrollCollapse: true,
            paging: true,
            fixedColumns: {
                leftColumns: 1,
                rightColumns: 1
            }
        });
        
        
       
    });
    TableManageButtons.init();

function numdot(item,evt) { 
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode==46)
    {
        var regex = new RegExp(/\./g)
        var count = $(item).val().match(regex).length;
        if (count > 1)
        {
            return false;
        }
    }
    if (charCode > 31 && (charCode < 48 || charCode > 57) || charCode==189) {
        return false;
    }
    return true;
} 


function conversion(menu,store,name,qty,weight,unit,rt){
    
   
    var store=$('#store').val();
    
    if(store!=''){
    
    $('.conversion_pop').show();
    
    $('.conversion_pop').attr('menuid',menu);
    $('.conversion_pop').attr('store',store);
    
     $('.conversion_pop').attr('unit',unit);
     $('.conversion_pop').attr('rt',rt);
     
     $('#conv_head').text(name);
    
                   if(unit=='Nos' || unit=='Single' ){
                                      
                            $('.conversion_pop').attr('menu_qty',qty);
                              $('.conversion_pop').attr('menu_weight',0);  
                              
                             $('#conv_head1').text('[Qty:'+qty+' | Weight:0]');   
                               $('#conv_qty_enter').attr('readonly',false);     
                           $('#conv_weight_enter').attr('readonly',true);   
                   }else{
                              
                              $('.conversion_pop').attr('menu_qty',0);
                          $('.conversion_pop').attr('menu_weight',weight); 
                              
                            $('#conv_head1').text('[Qty:0 | Weight:'+weight+']');   
                                      
                              $('#conv_qty_enter').attr('readonly',true);         
                             $('#conv_weight_enter').attr('readonly',false); 
                              
                             if(rt=='Packet' && (unit=='KG' || unit=='LTR')){
                                $('.conversion_pop').attr('menu_qty',qty); 
                                
                                 $('#conv_weight_enter').attr('readonly',true); 
                                  $('#conv_qty_enter').attr('readonly',false);     
                                  $('#conv_head1').text('[Qty:'+qty+' | Weight:0]');   
                             }
                                          
                  }
    
    
    //$('.conversion_pop').attr('menu_qty',qty);
    //$('.conversion_pop').attr('menu_weight',weight);
    
    
    }else{
       $('.err_stk').show();
                                    
         $('.err_stk').text('SELECT STORE');
         $('.err_stk').delay(1000).fadeOut('slow'); 
       // alert('SELECT STORE FIRST');
    }
   
        
}


    function pagination(p,q)
    {
      
       var s=$('#recordcount').val();

     if(q==1)
     {
     var m= q;
     var j=parseInt(q)+6;
     }
     else if(q==2)
     {
     var m= parseInt(q)-1;
     var j=parseInt(q)+5;
     }
     else if(q==3)
     {
       var m= parseInt(q)-2;
       var j= parseInt(q)+4;
     }
     else 
     {
       var m= parseInt(q)-3;
       var j= parseInt(q)+3;
     }

    
     var o=0;
     var w=0;
     var n=0;
     
    for(w=1;w<=m;w++)
     {
         
         $('#pagi'+w).hide();
     } 
     for(n=m;n<=j;n++)
     {
         
         $('#pagi'+n).show();
     } 
     for(o=j;o<=s;o++)
     {
         
         $('#pagi'+o).hide();
     } 
     
     var recordcount=parseInt(p);
  
     var product=$('#product').val();
     
     var barcode=$('#barcode').val();
     
     var expiry=$('#expiry').val();
     
     var reorder=$('#reorder').val();
     
     var brand=$('#brand').val();
    
    var category=$('#category').val();
     
    var store=$('#store').val();
    
     var stock_order=$("#stock_order").val();
     
     var menu_type=$("#menu_type").val();
     
     var rt=$("#rt").val();
     
     var ut=$("#ut").val();
     
     
     
    var data="set=load_store_stock&reorder="+reorder+"&product="+product+"&expiry="+expiry+"&brand="+brand+"&category="+category+"&barcode="+barcode+"&pagination="+p+"&recordcount="+recordcount+"&store="+store+"&stock_order="+stock_order+"&menu_type="+menu_type+"&rt="+rt+"&ut="+ut
             $.ajax({
        type: "POST",
        url: "load_inventory.php",
        data: data,
        success: function(data)
        {
         
           $('#load_store_stock').html($.trim(data));
          $('#pagi'+q).css('color','red');
          
      
                                              for(w=1;w<=m;w++)
                                               {

                                                   $('#pagi'+w).hide();
                                               } 
                                               for(n=m;n<=j;n++)
                                               {

                                                   $('#pagi'+n).show();
                                               } 
                                               for(o=j;o<=s;o++)
                                               {

                                                   $('#pagi'+o).hide();
                                               } 
          
          
        }
    });
    
    
    var data="set=load_store_stock1&reorder="+reorder+"&product="+product+"&expiry="+expiry+"&brand="+brand+"&category="+category+"&barcode="+barcode+"&store="+store+"&stock_order="+stock_order+"&menu_type="+menu_type+"&rt="+rt+"&ut="+ut
             $.ajax({
        type: "POST",
        url: "load_inventory.php",
        data: data,
        success: function(data)
        {
           
           var det=$.trim(data).split('*');
           
           $('#stock_val_on').html(det[0]);
          $('#item_count').html(det[1]); 
         
        }
    });
    
    
    
    
 } 
     
     function reset_inventory(){
      var confirm1=confirm("CONFIRM RESET INVENTORY ?");
    if(confirm1===true){
      var data="set=reset_inventory"
             
             $.ajax({
        type: "POST",
        url: "load_inventory.php",
        data: data,
        success: function(data)
        {
            
      location.reload();
          
        }
    });
    
        }
}
     
  function excel_download(){
     
      var product=$('#product').val();
     
     var barcode=$('#barcode').val();
     
     var expiry=$('#expiry').val();
     
     var reorder=$('#reorder').val();
     
     var brand=$('#brand').val();
    
    var category=$('#category').val();
    
    var store=$('#store').val();
    
    var menu_type=$("#menu_type").val();
     
     var rt=$("#rt").val();
     
     var ut=$("#ut").val();
     
      
      if($('#reorder').val()!=''){
          
          if($('#reorder').val()=='nostock'){
              
              var stock_check='out';
          }
          
          
          if($('#reorder').val()=='reorder'){
              
              var stock_check='reorder';
          }
      }else{
          
           var stock_check='';
      }
      
           window.location.href="inventory_excel.php?set=download_physical_excel&reorder="+reorder+"&product="+product+"&expiry="+expiry+"&brand="+brand+"&category="+category+"&barcode="+barcode+"&store="+store+"&stock_check="+stock_check+"&menu_type="+menu_type+"&rt="+rt+"&ut="+ut;
      
        
  }   
     
     
     
 function search_history(){
     
      var product=$('#product').val();
     
     var barcode=$('#barcode').val();
     
     var expiry=$('#expiry').val();
     
     var reorder=$('#reorder').val();
     
     var brand=$('#brand').val();
    
    var category=$('#category').val();
    
      var store=$('#store').val();
      
      var stock_order=$("#stock_order").val();
      
      var menu_type=$("#menu_type").val();
     
     var rt=$("#rt").val();
     
     var ut=$("#ut").val();
     
   
    var data="set=load_store_stock&reorder="+reorder+"&product="+product+"&expiry="+expiry+"&brand="+brand+"&category="+category+"&barcode="+barcode+"&store="+store+"&stock_order="+stock_order+"&menu_type="+menu_type+"&rt="+rt+"&ut="+ut
             $.ajax({
        type: "POST",
        url: "load_inventory.php",
        data: data,
        success: function(data)
        {
           
           $('#load_store_stock').html($.trim(data));
         
        }
    });
     
  
  var data="set=load_store_stock1&reorder="+reorder+"&product="+product+"&expiry="+expiry+"&brand="+brand+"&category="+category+"&barcode="+barcode+"&store="+store+"&stock_order="+stock_order+"&menu_type="+menu_type+"&rt="+rt+"&ut="+ut
             $.ajax({
        type: "POST",
        url: "load_inventory.php",
        data: data,
        success: function(data)
        {
           
           var det=$.trim(data).split('*');
           
           $('#stock_val_on').html(det[0]);
          $('#item_count').html(det[1]); 
         
        }
    });
  
  
  
            
        
  }
  function close_req1(){
      
        $('.expiry_pop').hide();
    }
    
  function close_req2(){
      
        $('.grn_pop').hide();
    }
  
  
  function close_req3(){
       $('#conv_store').val('');
            $('#conv_item').val('');
              $('#conv_qty').val(''); 
              $('#conv_weight').val(''); 
        $('.conversion_pop').hide();
          $("#conv_weight_enter").val('');
                $("#conv_qty_enter").val('');
                 $('#name_load').html('');
              $('#name_load').hide();   
    }
    
    
  function expiry_date(prd){ 
      
        $('.expiry_pop').show();
      
       var data="set=load_stock_expiry&product="+prd
             $.ajax({
        type: "POST",
        url: "load_inventory.php",
        data: data,
        success: function(data)
        {
          
           $('.load_expiry').html($.trim(data));
         
        }
    });
     
      
  }
  
  function grn_qty(prd){
      
        $('.grn_pop').show();
      
       var data="set=load_stock_grn&product="+prd
             $.ajax({
        type: "POST",
        url: "load_inventory.php",
        data: data,
        success: function(data)
        {
           
           $('.load_grn').html($.trim(data));
         
        }
    });
     
      
  }
  
  
  function search_ing(e){
    
    if($("#conv_store").val()!=''){
    
       if (localStorage.name_length5 != $('#conv_item').val().length && localStorage.name_length5 > 0){
           
           //$('#conv_item').val('');
              $('#conv_qty').val(''); 
              $('#conv_weight').val(''); 
              
        }
    
     var name=$('#conv_item').val();
    var store= $("#conv_store").val();
  
     var data="set=searchname_conversion&name="+name+"&store="+store;
        $.ajax({
        type: "POST",
        url: "../load_index.php",
        data: data,
        success: function(data)
        { 
             $('#name_load').show();
         
           $('#name_load').html(data);
           
        }
    });      
       
        }else{
            
            alert('Select Store');
        }
       
}



function  ing_click(n,id,unit,rt_type){ 
   
   $('#conv_item').val(n);
  
   $('#conv_item').attr('menu_id_to',id);
   
    $('#conv_item').attr('unit_to',unit);
     $('#conv_item').attr('rt_to',rt_type);
  
  
  var conv_head=$('#conv_head').text();
  
  if(conv_head==n){
      
      $('#conv_item').val('');
      $('#conv_item').attr('menu_id_to','');
   
    $('#conv_item').attr('unit_to','');
     $('#conv_item').attr('rt_to','');
      alert('FROM AND TO ITEM CANT BE SAME');
  }
  
   localStorage.name_length5 = $("#conv_item").val().length;
   
         $('#name_load').hide();
    
                            
                          if(unit=='Nos' || unit=='Single' ){
                                    
                                       if(rt_type!='Packet'){
                                        $('#conv_weight').attr('readonly', true);
                                          }
                                        $('#conv_qty').attr('readonly', false);
                                        
                                        
                                        if(rt_type=='Packet' && unit=='Nos'){
                                        $('#conv_weight').attr('readonly', true);
                                           
                                        }
                                       
                              }else{
                                    
                                          $('#conv_qty').attr('readonly', true);
                                          $('#conv_weight').attr('readonly', false);
                                          
                                         if(rt_type=='Packet' && (unit=='KG' || unit=='LTR')){
                                          $('#conv_qty').attr('readonly', true);
                                          
                                        }
                                       
                                        if(rt_type=='Packet'  && unit=='Nos'){
                                         
                                           $('#conv_qty').attr('readonly', false);
                                           $('#conv_weight').attr('readonly', false);
                                        }
                                        
                                     }
    
}    
  
  function qty_conv_check(){
      
       var c_qty =   parseFloat($('.conversion_pop').attr('menu_qty'));
   
        var qty= parseFloat($("#conv_qty_enter").val());
    
    
    if(qty>c_qty){
        
        alert('Invalid Qty');
        
        $("#conv_qty_enter").val('')
    }
    
    
      
  }
  
  
  function weight_conv_check(){
      
       var c_weight =   parseFloat($('.conversion_pop').attr('menu_weight'));
   
        var wgt= parseFloat($("#conv_weight_enter").val());
    
    
    if(wgt>c_weight){
        
        alert('Invalid Weight');
        
        $("#conv_weight_enter").val('');
    }
    
    
      
  }
  
  
  function submit_conversion(){
      
      
    var from_menu=$('.conversion_pop').attr('menuid');
    var to_menu= $('#conv_item').attr('menu_id_to');
    
    var from_store=$('.conversion_pop').attr('store');
    var to_store= $("#conv_store").val();
    
  
    var from_unit=$('.conversion_pop').attr('unit');
    var from_rt=$('.conversion_pop').attr('rt');
    
    
    var to_unit=  $('#conv_item').attr('unit_to');
    var to_rt=$('#conv_item').attr('rt_to');
  
     
     
    var qty= $("#conv_qty").val();
    
    var weight= $("#conv_weight").val();
    
    if(from_menu==to_menu){
        
        $("#conv_item").val('');
        $('.conversion_pop').attr('menuid','');
        
         alert('FROM AND TO MENU CANT BE SAME ');
    }
    
    
    if(parseFloat($("#conv_qty_enter").val())>0){
    var c_qty = parseFloat($("#conv_qty_enter").val());
    }else{
         var c_qty ='0';
          
    }
    
    if(parseFloat($("#conv_weight_enter").val())>0){
    var c_weight= parseFloat($("#conv_weight_enter").val());
    }else{
         var c_weight ='0';
          
    }
    
    if( (qty>0 || weight>0) &&  (c_qty>0 || c_weight>0) && to_menu!='' &&  to_store!=''){
        
     var data="set=product_conversion&from_menu="+from_menu+"&to_menu="+to_menu+"&from_store="+from_store+"&to_store="+to_store+"&qty="+qty+"&weight="+weight+"&from_weight="+c_weight+"&from_qty="+c_qty;
      
    
            $.ajax({
        type: "POST",
        url: "load_inventory.php",
        data: data,
        success: function(data)
        {    
              alert('CONVERSION SUCCESSFULL');
              $('#conv_store').val('');
              $('#conv_item').val('');
              $('#conv_qty').val(''); 
              $('#conv_weight').val(''); 
              
     $('.conversion_pop').hide();
           
     var product=$('#product').val();
     
     var barcode=$('#barcode').val();
     
     var expiry=$('#expiry').val();
     
     var reorder=$('#reorder').val();
     
     var brand=$('#brand').val();
    
     var category=$('#category').val();
    
     var store=$('#store').val();
     
       var store=$('#stock_order').val();
   
     var data="set=load_store_stock&reorder="+reorder+"&product="+product+"&expiry="+expiry+"&brand="+brand+"&category="+category+"&barcode="+barcode+"&store="+store+"&stock_order="+stock_order 
             $.ajax({
        type: "POST",
        url: "load_inventory.php",
        data: data,
        success: function(data)
        {
             
           $("#conv_weight_enter").val('');
           $("#conv_qty_enter").val('');
           $('#load_store_stock').html($.trim(data));
         
        }
        });
    
        }
         });      
      
    }else{
        
         if(to_menu=='' || to_menu==undefined){
           alert('ENTER MENU');
         }
        
         if(to_store=='' || to_store==undefined){
           alert('SELECT STORE');
         }
       
          if( ((qty>c_qty) || qty=='' || qty=='0') && (to_unit=='Single' ||  to_unit=='Nos')  && (to_rt=='Single' ||  to_rt=='Packet')){
             alert('INVALID  QTY');
         }
        
         if(((weight>c_weight) ||  weight=='' ||  weight=='0') && (to_unit!='Single' &&  to_unit!='Nos')){
            alert('INVALID WEIGHT');
         }
       
        if((c_weight<=0 || c_weight=='') && (from_unit!='Single' &&  from_unit!='Nos')){
            alert('INVALID FROM WEIGHT');
        }
         
        if((c_qty<=0 || c_qty=='') &&  ( (from_unit=='Single' ||  from_unit=='Nos') && (from_rt=='Single' ||  from_rt=='Packet')) ){
            alert('INVALID FROM QTY');
        }
     
    } 
      
  }
  
  
  
  function default_excel(type){
      
      if(type=='download' ){
          
          if($("#store").val()!=''){
              
            var str=  $("#store").val();
              
       window.location.href="inventory_excel.php?set=default_excel&store="+str;
          }else{
              alert('Select Store');
          }
       
       
      }else{
          
        var excel= $("#excel_def").val();
          
      if(excel!=''){
          
        $('.confrmation_overlay_proce').css('display','block');
        $('#sms_email_loader').html('<img src="img/ajax-loaders/ajax-loader.gif" />'); 
     
         document.submitxmldetails.submit();
       }else{
           
         //alert('SELECT EXCEL FILE ');
         $('.err_stk').show();
                                    
         $('.err_stk').text('SELECT FILE');
         $('.err_stk').delay(1000).fadeOut('slow');
         
        
        }
   
      }
      
  }
  
</script>

	<style>
            
            .dataTables_scrollBody{height:460px !important;}
		.dataTables_scrollBody{height:460px !important;}.swal2-modal .swal2-styled{padding: 6px 32px;}
		.modal-dialog{width:450px !important;top: 30%;}.modal .modal-dialog .modal-content{padding: 15px;}
               
        </style>

<style>
    .act_pag{
        color:darkred !important;
    }   
.new_overlay{
	 width:100%;
	 height:100%;
	 background-color:rgba(0,0,0,0.8);
	 position:fixed;
	 z-index:999;
	 height: 100%;
	 }
         
.quick_pop_printer_sec{width:100%;height:100%;float:left;position:fixed;background-color:rgba(0,0,0,0.7);left:0;top:0;z-index:9999;}   
 .quick_pop_printer{width:350px;height:150px;background-color:#fff;border-radius:8px;overflow:hidden;left:0;right:0;margin:auto;top:0;bottom:0;position:absolute; display: grid;grid-template-columns: 1fr;grid-template-rows: 2fr;justify-content: center;}  
 .quick_pop_printer_head{text-align:center;font-size:20px;color:#818181;padding:15px 0;font-weight:bold; text-transform:capitalize;}   
 .quick_pop_printer_content{width:100%;height:auto;padding:15px;text-align:center;} 
 .production-btn4{
 position: absolute;
    top: -3px;
    right: -165px;
    font-size: 1rem !important;
 }
 
 .confrmation_overlay_proce{
	width:100%;
	height:100%;
	position:fixed;
	z-index:999;
	background-color:rgba(0,0,0,0.8);
	top:0;
	text-align:center;
	line-height: 40;
	display:none;
		}
</style>

  <div class=" confrmation_overlay_proce" id="sms_email_loader">
        
    </div>


<div class="quick_pop_printer_sec bill_quick_div approve_pop" style="display:none">
    <div class="quick_pop_printer">
        <div class="quick_pop_printer_head" > Confirm </div>
          
        <div class="quick_pop_printer_content ">
                  
            <div onclick="approve_submit_req();"  class="search_btn_member_invoice filte_new_box_btn btn_index_popup inv-popup-btn"><span id="submit_quick_print">SUBMIT</span></div>
                  
                  <div onclick="close_req();"  class="search_btn_member_invoice filte_new_box_btn btn_index_popup inv-popup-btn"><span id="submit_quick_close" >CLOSE</span></div>
                  
             </div>
    </div>
      <div>
      </div>
</div>
<div class="quick_pop_printer_sec bill_quick_div conversion_pop" style="display:none;cursor: pointer">
    <div class="quick_pop_printer" style="grid-template-rows:0fr;padding: 1rem;width: 400px;height: 222px;">
    <div style="display: flex;justify-content: center;align-items: center;">
        <div class="quick_pop_printer_head" style="font-size:1.2rem" > CONVERSION - <span style="color:darkred" id="conv_head"></span>
            <br>
            <span style="font-size:10px" id="conv_head1"></span> </div> 
             <br>
             
                
                
        <span onclick="close_req3()" style="position:absolute;right: 5px;top: 5px"><img src="../images/black_cross.png"></span>
        </div>
        
        <div style="display: flex;justify-content: center;"> 
            
        <input  style="width: 15%;" id="conv_qty_enter" onkeypress="return numdot(this,event);" placeholder="Qty" type="text" onkeyup="qty_conv_check()"  >  &nbsp;  &nbsp;
              
        <input  style="width: 15%;" id="conv_weight_enter" onkeypress="return numdot(this,event);"  placeholder="Weight" type="text" onkeyup="weight_conv_check()"  > 
                
        </div>


        <div class="history-filter" style="">
            
            
            <select style="width: 20%;"  id="conv_store" required>
                                <option value="">Store</option>
                                
                               <?php
      
              
     $sql_kotlist  =  $database->mysqlQuery("SELECT * from  tbl_inv_kitchen where ti_status='Y' "); 
 
                 $num_kotlist  = $database->mysqlNumRows($sql_kotlist);
					if($num_kotlist){ 
				while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
							  {  
                                    
                                    ?>
       
       <option value="<?=$result_kotlist['ti_id']?>"><?=$result_kotlist['ti_name']?></option>  
       <?php
                                }
                                }
            ?>      
                                
                            </select> 
            
            <input  style="width: 35%;" id="conv_item" placeholder="Convert To" type="text" onkeyup="search_ing()"  > 
            <div id="name_load" class="customer_list_autoload" style="display:none;width: 31%;top: 141px;left: 105px;height: 73px;">                              <ul>
                               <li onclick="return ing_click();" style="cursor: pointer"> </li>
                             </ul>
                             </div>
      
            <input  style="width: 15%;" onkeypress="return numdot(this,event);" id="conv_qty" placeholder="QTY" type="text"> 
      <input style="width: 15%;" onkeypress="return numdot(this,event);" id="conv_weight" placeholder="Weight" type="text"> 

  </div>
  <div class="history-filter" style="justify-self: end;">
      <a class="inv-submit-btn" style="width:9rem" onclick="submit_conversion()" href="#">CONVERT</a>
  </div>
</div>
</div>

<div class="quick_pop_printer_sec bill_quick_div expiry_pop" style="display:none;">
    <div class="quick_pop_printer" style="grid-template-rows:0fr;padding: 1rem;width: 400px;height: 325px;">
    <div style="display: flex;justify-content: space-between;align-items: center;">
        <div class="quick_pop_printer_head" > Last 5 Dates  </div>
        <span onclick="close_req1()" style=""><img src="../images/black_cross.png"></span>
        </div>
        <div class="" style="overflow-y:auto; height:">
                  
            <table class="blueTable table table-bordered table-striped">
<thead>
<tr>
<th>Qty</th>
<th>Weight</th>
<th>Expiry Date</th>


</tr>
</thead>
<tfoot>
<tr>
<td colspan="4">
<div class="links"></div>
</td>
</tr>
</tfoot>
<tbody class="load_expiry">


</tbody>
</table>
                  
                 
                  
             </div>
        
        
    </div>
    
   
      <div>
      </div>
</div>




<div class="quick_pop_printer_sec bill_quick_div grn_pop" style="display:none;">
    <div class="quick_pop_printer" style="grid-template-rows:0fr;padding: 1rem;width: 400px;height: 325px;">
    <div  style="display: flex;justify-content: space-between;align-items: center;">
        <div class="quick_pop_printer_head" > Last 5 Grn  </div>
        <span onclick="close_req2()" style=""><img src="../images/black_cross.png"></span>
        </div>
        <div class=""style="overflow-y:auto;">
                  
            <table class="blueTable table table-bordered table-striped">
<thead>
<tr>
<th>Qty</th>
<th>Weight</th>
<th>Grn Id</th>


</tr>
</thead>
<tfoot>
<tr>
<td colspan="4">
<div class="links"></div>
</td>
</tr>
</tfoot>
<tbody class="load_grn">


</tbody>
</table>
                  
                 
                  
             </div>
        
        
    </div>
    
   
      <div>
      </div>
</div>
    </body>

</html>

