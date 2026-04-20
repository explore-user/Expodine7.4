<?php

include("database.class.php"); 
$database	= new Database();  
   
            
    $branchid_cloud='';
    $sql_table_pt2="SELECT bsc_cloud_branchid FROM tbl_branch_settings_cloud ";
    $sql_pt2  =  $database->mysqlQuery($sql_table_pt2); 
    $num_pt2  = $database->mysqlNumRows($sql_pt2);
    if($num_pt2){
    while($result_pt2  = $database->mysqlFetchArray($sql_pt2)) 
    {
        $branchid_cloud =$result_pt2['bsc_cloud_branchid'];
    }
    }

                
    $localhost1=mysqli_connect(HOST_NAME_CLOUD, USER_NAME_CLOUD, PASSWORD_CLOUD,DATABASE_NAME_QR);
                

if(isset($_REQUEST['set']) && ($_REQUEST['set']=='update_cloud_menu')){
 
        $a="8.8.8.8";
        exec("ping -n 1 -w 1 ".$a, $output, $result);
        if($result==0)
        {
           ////main category add/////
    
         $cnt_main='0';
         $sql_gen_store =  mysqli_query($localhost1,"select * from tbl_menumaincategory where branchid='$branchid_cloud' "
         . " and (new_from_cloud='Y' or central_edited='Y') order by mmy_maincategoryid asc "); 
        
         $num_gen_store  = mysqli_num_rows($sql_gen_store);
	 if($num_gen_store)
	 { 
	  while($result_store  = mysqli_fetch_array($sql_gen_store)) 
	  {
              
              if($result_store['central_id']!='' && $result_store['central_id']!='undefined'){
                  
                $cnt_main  =$result_store['central_id'];
                  
              }
              
             
              if($result_store['new_from_cloud']=='Y'){
                  
              $sql_table_selrate  =  $database->mysqlQuery("INSERT INTO `tbl_menumaincategory`(`mmy_maincategoryname`,"
              . " `mmy_active`, `mmy_branchid`, `mmy_displayorder`, `mmy_orderof_print`,"
              . "  `mmy_inventory`, `new_from_cloud`,central_id)"
              . "  VALUES ('".$result_store['mmy_maincategoryname']."','".$result_store['mmy_active']."','1', '".$result_store['mmy_displayorder']."',"
              . "  '".$result_store['mmy_orderof_print']."', '".$result_store['mmy_inventory']."','D','$cnt_main')  "); 
              
              
                   $sql_gen_store =  mysqli_query($localhost1,"update tbl_menumaincategory set new_from_cloud='D' where"
                   . " branchid='$branchid_cloud' and new_from_cloud='Y' and  mmy_maincategoryname='".$result_store['mmy_maincategoryname']."'  "); 
              }
              
              
            if($result_store['central_edited']=='Y'){
                  
            $sql_table_selrate = $database->mysqlQuery(" update  tbl_menumaincategory set mmy_maincategoryname='".$result_store['mmy_maincategoryname']."' ,"
            . " mmy_active='".$result_store['mmy_active']."',mmy_displayorder='".$result_store['mmy_displayorder']."',mmy_orderof_print='".$result_store['mmy_orderof_print']."' ,"
            . " mmy_inventory='".$result_store['mmy_inventory']."' where central_id='$cnt_main'  ");
                
            $sql_gen_store =  mysqli_query($localhost1,"update tbl_menumaincategory set central_edited='D' where "
            . " branchid='$branchid_cloud'  and  central_id='".$result_store['central_id']."'  "); 
                  
                   
            }
              
             
          }
          }
          
         ////sub category add/////
          
         $cnt_sub='0';
         $sql_gen_store =  mysqli_query($localhost1,"select * from tbl_menusubcategory where branchid='$branchid_cloud' "
         . " and (new_from_cloud='Y' or central_edited='Y') order by msy_subcategoryid asc  "); 
         $num_gen_store  = mysqli_num_rows($sql_gen_store);
	 if($num_gen_store)
	 { 
	  while($result_store  = mysqli_fetch_array($sql_gen_store)) 
	  {
             
               if($result_store['central_id']!='' && $result_store['central_id']!='undefined'){
                $cnt_sub  =$result_store['central_id'];
                  
              }
              
              
             if($result_store['new_from_cloud']=='Y'){
                   
              $sql_table_selrate  =  $database->mysqlQuery("INSERT INTO `tbl_menusubcategory`(`msy_subcategoryname`,"
              . " `msy_active`, `msy_branchid`, `msy_sub_displayorder`, "
              . " `new_from_cloud`,central_id)"
              . " VALUES ('".$result_store['msy_subcategoryname']."','".$result_store['msy_active']."','1', "
                      . " '".$result_store['msy_sub_displayorder']."', "
                      . "  'D','$cnt_sub' )  "); 
              
              
           $sql_gen_store =  mysqli_query($localhost1,"update tbl_menusubcategory set new_from_cloud='D' where"
           . " branchid='$branchid_cloud' and new_from_cloud='Y' and  msy_subcategoryname='".$result_store['msy_subcategoryname']."'  "); 
        
           
               }
               
               
            if($result_store['central_edited']=='Y'){
                
              $sql_table_selrate  =  $database->mysqlQuery("update tbl_menusubcategory set msy_subcategoryname='".$result_store['msy_subcategoryname']."',"
              . "  msy_active='".$result_store['msy_active']."',`msy_sub_displayorder`='".$result_store['msy_sub_displayorder']."'  "
              . "  where   central_id= '$cnt_sub'   "); 
              
              
              $sql_gen_store =  mysqli_query($localhost1,"update tbl_menusubcategory set central_edited='D' where "
              . " branchid='$branchid_cloud' and  central_id='".$result_store['central_id']."'  "); 
         
                
            }   
            
               
              
          }
          }  
          
          
          
         ////kitchen kot add/////
         $cnt_kot='0';
         $sql_gen_store =  mysqli_query($localhost1,"select * from tbl_kotcountermaster where branchid='$branchid_cloud' "
                 . " and (new_from_cloud='Y' or central_edited='Y')  order by kr_kotcode asc "); 
         $num_gen_store  = mysqli_num_rows($sql_gen_store);
	 if($num_gen_store)
	 { 
	  while($result_store  = mysqli_fetch_array($sql_gen_store)) 
	  {
             
               if($result_store['central_id']!='' && $result_store['central_id']!='undefined'){
                $cnt_kot  =$result_store['central_id'];
                  
              }
              
              if($result_store['new_from_cloud']=='Y'){
                    
              $sql_table_selrate  =  $database->mysqlQuery("INSERT INTO `tbl_kotcountermaster`(`kr_kotname`,"
              . "   `kr_branchid`, "
              . "   `new_from_cloud`,central_id)"
              . "    VALUES ('".$result_store['kr_kotname']."','1', "
                     . "  'D' ,'$cnt_kot')  "); 
              
              
             $sql_gen_store =  mysqli_query($localhost1,"update tbl_kotcountermaster set new_from_cloud='D' where"
               . " branchid='$branchid_cloud' and new_from_cloud='Y' and  kr_kotname='".$result_store['kr_kotname']."'  "); 
        
            }
                
                
           if($result_store['central_edited']=='Y'){
               
                 $sql_table_selrate  =  $database->mysqlQuery("update `tbl_kotcountermaster` set `kr_kotname`='".$result_store['kr_kotname']."'   "
              
                . " where central_id='".$result_store['central_id']."' ");
            
              
               $sql_gen_store =  mysqli_query($localhost1,"update tbl_kotcountermaster set central_edited='D' where"
               . " branchid='$branchid_cloud' and  central_id='$cnt_kot'  "); 
         
           }
           
              
          }
          }  
    
          
         ///////MENU ITEM ADD STARTS HERE ///////////////
          
         $sql_gen1 =  mysqli_query($localhost1,"select * from tbl_cloud_menu_data where branchid='$branchid_cloud' "); 
         $num_gen1  = mysqli_num_rows($sql_gen1);
	 if($num_gen1)
	 { 
	   while($result_cld  = mysqli_fetch_array($sql_gen1)) 
	   {
           
             if($result_cld['tm_central_id']!='' && $result_cld['tm_central_id']!='0'){
                 
                   $menuid_del=$result_cld['tm_central_id'];
                 
            }else{
                 
                   $menuid_del='';
            
             }
   
            if($result_cld['tm_method']=='Insert'){ 
                
                  
            $desc=$result_cld['tm_desc'];
            $modifydate=date('Y-m-d H:i:s');
            $modify_user='Local';
            $rating=0;
            $sync_android='Y';
            $cloud_sync='N';
            $item_code='';
            $addon      = 'N';
            $stock      = 'Y';
            $stock_no   = 'N';
            $show_kod   = 'Y';
            $excempt    = 'N';
            $kot_print  = 'Y';
            $barcode    = 'N';
            $ingredient = 'N';
            $replacer   = 'N';
           
            
             if($result_cld['tm_central_id']!=''){
                  $tm_central_id="'".$result_cld['tm_central_id']."'";
             }else{
                 $tm_central_id='NULL';
             }
             
             
              if($result_cld['tm_subcat']!='' && $result_cld['tm_subcat']!='0'){
                  
                  $subcat_id="'".$result_cld['tm_subcat']."'";
             }else{
                 $subcat_id='NULL';
             }
             
             
              if($result_cld['tm_inv_store']!='' && $result_cld['tm_inv_store']!='0'){
                  
                  $store_id=$result_cld['tm_inv_store'];
             }else{
                 
                 $store_id='0';
             }
             
               //////////menu adding ////////////
             
             
              if($result_cld['tm_code']!='' && $result_cld['tm_code']!='NULL' && $result_cld['tm_code']!='0' && $result_cld['tm_code']!=NULL){
                
                  
              $sql_table_selrate4  =  $database->mysqlQuery("INSERT INTO `tbl_menumaster`(`mr_menuname`, `mr_maincatid`, `mr_subcatid`, "
             . " `mr_description`, `mr_diet`, `mr_time_min`, `mr_active`, `mr_kotcounter`, `mr_modifieddate`, `mr_modifieduser`,"
             . " `mr_rating`, `mr_prepmode`, `mr_branchid`, `mr_itemshortcode`, `mr_dailystock`, `mr_manualrateentry`, `mr_itemcode`, "
             . " `mr_dailystock_in_number`, `mr_android_sync`, `mr_show_in_kod`, `mr_excempt_tax`, `mr_rate_type`, `mr_unit_type`,"
             . " `mr_base_unit`, `mr_add_on`, `mr_show_in_kot_print`, `cloud_sync`,`manual_barcode`,mr_ingredient,"
             . " mr_replacer,mr_central_id,mr_product_type,mr_inventory_kitchen) "
                          
             . " VALUES ('".$result_cld['tm_menu_name']."',"
             . " '".$result_cld['tm_maincat']."',$subcat_id,'".$desc."','General','10',"
             . " '".$result_cld['tm_status']."', '".$result_cld['tm_kot']."',"
             . " '".$modifydate."','".$modify_user."', '".$rating."','General', '1','".substr($result_cld['tm_menu_name'],0,25)."',"
             . " '".$stock."','".$result_cld['tm_dynamic']."',"
             . " '".$result_cld['tm_code']."','".$stock_no."','".$sync_android."','".$show_kod."','".$excempt."','".$result_cld['tm_type']."',"
             . " '".$result_cld['tm_unit_type']."','".$result_cld['tm_base_unit']."','".$addon."','".$kot_print."',"
             . " '".$cloud_sync."','".$barcode."','".$ingredient."','".$replacer."',$tm_central_id ,"
             . " '".$result_cld['tm_item_type']."','$store_id' )");
             
              
              
            }else{
                  
             $sql_table_selrate4  =  $database->mysqlQuery("INSERT INTO `tbl_menumaster`(`mr_menuname`, `mr_maincatid`, `mr_subcatid`, "
             . " `mr_description`, `mr_diet`, `mr_time_min`, `mr_active`, `mr_kotcounter`, `mr_modifieddate`, `mr_modifieduser`,"
             . " `mr_rating`, `mr_prepmode`, `mr_branchid`, `mr_itemshortcode`, `mr_dailystock`, `mr_manualrateentry`, "
             . " `mr_dailystock_in_number`, `mr_android_sync`, `mr_show_in_kod`, `mr_excempt_tax`, `mr_rate_type`, `mr_unit_type`,"
             . " `mr_base_unit`, `mr_add_on`, `mr_show_in_kot_print`, `cloud_sync`,`manual_barcode`,"
             . " mr_ingredient,mr_replacer,mr_central_id,mr_product_type,mr_inventory_kitchen) "
                          
             . " VALUES ('".$result_cld['tm_menu_name']."',"
             . " '".$result_cld['tm_maincat']."',$subcat_id,'".$desc."','General','10',"
             . " '".$result_cld['tm_status']."', '".$result_cld['tm_kot']."',"
             . " '".$modifydate."','".$modify_user."', '".$rating."','General', '1','".substr($result_cld['tm_menu_name'],0,25)."',"
             . " '".$stock."','".$result_cld['tm_dynamic']."',"
             . "   '".$stock_no."','".$sync_android."','".$show_kod."','".$excempt."','".$result_cld['tm_type']."',"
             . " '".$result_cld['tm_unit_type']."','".$result_cld['tm_base_unit']."','".$addon."','".$kot_print."',"
             . " '".$cloud_sync."','".$barcode."','".$ingredient."','".$replacer."',"
             . " $tm_central_id , '".$result_cld['tm_item_type']."','$store_id')");
             
             
            
             
            }
         //////////menu adding ends ////////////////
             
             
            
             
        //////////menu update delete edit starts ///
           
 }else if( $result_cld['tm_method']=='Update' || $result_cld['tm_method']=='Delete' || $result_cld['tm_method']=='Edit'  || $result_cld['tm_method']=='First_Edit' ){
     
     $menuid_from_cnt='';
     $sql_listall2  =  $database->mysqlQuery("SELECT mr_menuid from tbl_menumaster where mr_central_id='$menuid_del'  "); 
	$num_listall2  = $database->mysqlNumRows($sql_listall2);
	if($num_listall2){
		  while($row_listall2  = $database->mysqlFetchArray($sql_listall2)) 
		  {
                      $menuid_from_cnt=$row_listall2['mr_menuid'];
                      
                  }
                  }
                  
              
            if($result_cld['tm_mode']=='DI'){
               
               
               if($result_cld['tm_method']=='Update'){
                   
               $sql_table_selrate  =  $database->mysqlQuery("update tbl_menuratemaster set  mmr_rate='".$result_cld['tm_rate']."'   where "
               . " mmr_menuid='$menuid_from_cnt'  ");   
               
              }else if($result_cld['tm_method']=='Delete'){
                   
                $sql_table_selrate  =  $database->mysqlQuery("delete from tbl_menuratemaster  where "
                . " mmr_menuid='$menuid_from_cnt'  ");  
              }
               
               
            }else if($result_cld['tm_mode']=='TA'){
                
               
             if($result_cld['tm_method']=='Update'){
                   
                $sql_table_selrate  =  $database->mysqlQuery("update tbl_menuratetakeaway set  mta_rate='".$result_cld['tm_rate']."'   where"
                . " mta_menuid='$menuid_from_cnt' ");   
               
            }else if($result_cld['tm_method']=='Delete'){
                    
                $sql_table_selrate  =  $database->mysqlQuery("delete from tbl_menuratetakeaway   where"
                . " mta_menuid='$menuid_from_cnt'  "); 
                
            }
               
               
        }else if($result_cld['tm_mode']=='CS'){
               
              if($result_cld['tm_method']=='Update'){
               
               $sql_table_selrate  =  $database->mysqlQuery("update tbl_menurate_counter set  mrc_rate='".$result_cld['tm_rate']."'   where"
               . " mrc_menuid='$menuid_from_cnt'   ");   
               
              }else if($result_cld['tm_method']=='Delete'){
                   
               $sql_table_selrate  =  $database->mysqlQuery("delete from tbl_menurate_counter    where"
               . " mrc_menuid='$menuid_from_cnt'   ");   
                   
             }
            
                 
        }else{
            
            
        if($result_cld['tm_method']=='Edit'){
            
            if($result_cld['tm_central_id']!=''){
                  $tm_central_id="'".$result_cld['tm_central_id']."'";
             }else{
                 $tm_central_id='NULL';
             }
              
                
        if($result_cld['tm_subcat']!='' && $result_cld['tm_subcat']!='0' ){
                       
            
        if($result_cld['tm_central_id']!='0' && $result_cld['tm_central_id']!='' && $result_cld['tm_central_id']!='NULL'){   
            
        $sql_table_selrate  =  $database->mysqlQuery("update tbl_menumaster set mr_itemshortcode='".substr($result_cld['tm_menu_name'],0,25)."',"
        . " mr_menuname='".$result_cld['tm_menu_name']."' ,mr_active='".$result_cld['tm_status']."',mr_maincatid='".$result_cld['tm_maincat']."',"
        . " mr_subcatid='".$result_cld['tm_subcat']."',mr_unit_type='".$result_cld['tm_unit_type']."' ,mr_rate_type='".$result_cld['tm_type']."', "
        . " mr_description='".$result_cld['tm_desc']."',mr_manualrateentry='".$result_cld['tm_dynamic']."',"
        . " mr_central_id=$tm_central_id ,mr_base_unit='".$result_cld['tm_base_unit']."' ,mr_modifieduser='Local' ,"
        . " mr_product_type='".$result_cld['tm_item_type']."',mr_inventory_kitchen='".$result_cld['tm_inv_store']."' ,cloud_sync='Z' where "
        . " mr_central_id='".$result_cld['tm_central_id']."' ");   
        
        }
        
        
        }else{
                    
         if($result_cld['tm_central_id']!='0' && $result_cld['tm_central_id']!='' && $result_cld['tm_central_id']!='NULL'){       
            
        $sql_table_selrate  =  $database->mysqlQuery("update tbl_menumaster set mr_itemshortcode='".substr($result_cld['tm_menu_name'],0,25)."',"
        . " mr_menuname='".$result_cld['tm_menu_name']."' ,mr_active='".$result_cld['tm_status']."',mr_maincatid='".$result_cld['tm_maincat']."',"
        . " mr_description='".$result_cld['tm_desc']."',mr_manualrateentry='".$result_cld['tm_dynamic']."' ,mr_base_unit='".$result_cld['tm_base_unit']."',"
        . " mr_central_id=$tm_central_id,mr_unit_type='".$result_cld['tm_unit_type']."',mr_rate_type='".$result_cld['tm_type']."' ,mr_modifieduser='Local' , "
        . " mr_product_type='".$result_cld['tm_item_type']."',mr_inventory_kitchen='".$result_cld['tm_inv_store']."',cloud_sync='Z'  where "
        . " mr_central_id='".$result_cld['tm_central_id']."' ");  
                  
        
         }
        
        }
        
       }
       
       
       
       
       if($result_cld['tm_method']=='First_Edit'){
            
            if($result_cld['tm_central_id']!=''){
                  $tm_central_id="'".$result_cld['tm_central_id']."'";
             }else{
                 $tm_central_id='NULL';
             }
              
                
        if($result_cld['tm_subcat']!='' && $result_cld['tm_subcat']!='0'){
                       
        $sql_table_selrate  =  $database->mysqlQuery("update tbl_menumaster set mr_itemshortcode='".substr($result_cld['tm_menu_name'],0,25)."',"
        . " mr_menuname='".$result_cld['tm_menu_name']."' ,mr_active='".$result_cld['tm_status']."',mr_maincatid='".$result_cld['tm_maincat']."',"
        . " mr_subcatid='".$result_cld['tm_subcat']."',mr_unit_type='".$result_cld['tm_unit_type']."' ,mr_rate_type='".$result_cld['tm_type']."', "
        . " mr_description='".$result_cld['tm_desc']."',mr_manualrateentry='".$result_cld['tm_dynamic']."',"
        . " mr_central_id=$tm_central_id ,mr_base_unit='".$result_cld['tm_base_unit']."' ,"
        . " mr_product_type='".$result_cld['tm_item_type']."',mr_inventory_kitchen='".$result_cld['tm_inv_store']."' ,cloud_sync='Z' where "
        . " mr_menuname='".$result_cld['tm_menu_name']."' ");   
        
        }else{
                        
        $sql_table_selrate  =  $database->mysqlQuery("update tbl_menumaster set mr_itemshortcode='".substr($result_cld['tm_menu_name'],0,25)."',"
        . " mr_menuname='".$result_cld['tm_menu_name']."' ,mr_active='".$result_cld['tm_status']."',mr_maincatid='".$result_cld['tm_maincat']."',"
        . " mr_description='".$result_cld['tm_desc']."',mr_manualrateentry='".$result_cld['tm_dynamic']."' ,mr_base_unit='".$result_cld['tm_base_unit']."',"
        . " mr_central_id=$tm_central_id,mr_unit_type='".$result_cld['tm_unit_type']."',mr_rate_type='".$result_cld['tm_type']."' ,"
        . " mr_product_type='".$result_cld['tm_item_type']."',mr_inventory_kitchen='".$result_cld['tm_inv_store']."',cloud_sync='Z'  where "
        . " mr_menuname='".$result_cld['tm_menu_name']."' ");  
                   
        
        }
        
       }
       
       
             
  }
  
  
  ////////////modules rate add//////////////////      
    
  }else if($result_cld['tm_method']=='Add'){
      
      
      
      $menuid_from_cnt='';
       $sql_listall2  =  $database->mysqlQuery("SELECT mr_menuid from tbl_menumaster where mr_central_id='$menuid_del'  "); 
	$num_listall2  = $database->mysqlNumRows($sql_listall2);
	if($num_listall2){
		  while($row_listall2  = $database->mysqlFetchArray($sql_listall2)) 
		  {
                      $menuid_from_cnt=$row_listall2['mr_menuid'];
                      
                  }
                  }
      
          
          
           if($result_cld['tm_unit_id']!='0' && $result_cld['tm_unit_id']!='' ){ 
               
               $unit_id_cl="'".$result_cld['tm_unit_id']."'";
           }else{
              
               $unit_id_cl='NULL';          
           }
           
           
           if($result_cld['tm_portion']!='0' && $result_cld['tm_portion']!='' ){ 
               
               $portion_id_cl="'".$result_cld['tm_portion']."'";
           }else{
              
               $portion_id_cl='NULL';          
           }
           
           
          if($result_cld['tm_base_unit']!='0' && $result_cld['tm_base_unit']!='' ){ 
               
               $base_id_cl="'".$result_cld['tm_base_unit']."'";
           }else{
              
               $base_id_cl='NULL';            
           }
           
           
          if($result_cld['tm_unit_wt']!='0' && $result_cld['tm_unit_wt']!='' ){ 
               
               $wgt_cl="'".$result_cld['tm_unit_wt']."'";
          }else{
              
               $wgt_cl='0.000';         
          }
         
           
    if($result_cld['tm_mode']=='DI'){
        
         $sql_table_selrate  =  $database->mysqlQuery("delete from  tbl_menuratemaster where  mmr_menuid='$menuid_from_cnt'   and "
                . " mmr_floorid='".$result_cld['tm_area_id']."'  and mmr_portion=$portion_id_cl  ");   
                  
          $sql_table_selrate  =  $database->mysqlQuery("insert into tbl_menuratemaster (`mmr_id`, `mmr_menuid`, `mmr_floorid`, `mmr_rate_type`,"
          . "  `mmr_unit_type`, `mmr_unit_weight`, `mmr_unit_id`, `mmr_base_unit_id`, `mmr_rate`,"
          . " `mmr_default`, `mmr_barcode`, `mmr_android_sync`, `cloud_sync`,mmr_portion) "
          . "  VALUES('".$result_cld['tm_mmr_id']."','$menuid_from_cnt','".$result_cld['tm_area_id']."','".$result_cld['tm_type']."',"
          . "  '".$result_cld['tm_unit_type']."',$wgt_cl,"
          . "  $unit_id_cl,$base_id_cl,'".$result_cld['tm_rate']."','Y',NULL,'N','N',$portion_id_cl) ");
          
    }
                    
                    
    if($result_cld['tm_mode']=='TA'){
        
        
        $sql_table_selrate  =  $database->mysqlQuery("delete from  tbl_menuratetakeaway where  mta_menuid='$menuid_from_cnt'   and "
                . " mta_food_partner='".$result_cld['tm_area_id']."' and mta_portion=$portion_id_cl  ");   
                
             $sql_table_selrate  =  $database->mysqlQuery("insert into tbl_menuratetakeaway (mta_id, `mta_menuid`, `mta_food_partner`, `mta_rate_type`,"
            . "  `mta_unit_type`, `mta_unit_weight`, `mta_unit_id`, `mta_base_unit_id`, `mta_rate`,"
            . "  `mta_default`, `mta_barcode`,  `cloud_sync`,mta_branchid,mta_portion) "
            . "  VALUES('".$result_cld['tm_mmr_id']."','$menuid_from_cnt','".$result_cld['tm_area_id']."','".$result_cld['tm_type']."',"
            . "  '".$result_cld['tm_unit_type']."',$wgt_cl,$unit_id_cl , "
            . "  $base_id_cl,'".$result_cld['tm_rate']."','Y',NULL,'N','1',$portion_id_cl) ");
        
          
            
    }       
                
      
                    
    if($result_cld['tm_mode']=='CS'){
        
        
        $sql_table_selrate  =  $database->mysqlQuery("delete from  tbl_menurate_counter where  mrc_menuid='$menuid_from_cnt'   and "
        . " mrc_portion=$portion_id_cl ");   
        
         $sql_table_selrate  =  $database->mysqlQuery("insert into tbl_menurate_counter (`mrc_id`, `mrc_menuid`,  `mrc_rate_type`,"
         . " `mrc_unit_type`, `mrc_unit_weight`, `mrc_unit_id`, `mrc_base_unit_id`, `mrc_rate`,"
         . " `mrc_default`, `mrc_barcode`,  `cloud_sync`,mrc_branchid,mrc_portion) "
         . "  VALUES('".$result_cld['tm_mmr_id']."','$menuid_from_cnt','".$result_cld['tm_type']."',"
         . " '".$result_cld['tm_unit_type']."',$wgt_cl,$unit_id_cl , "
         . " $base_id_cl,'".$result_cld['tm_rate']."','Y',NULL,'N','1',$portion_id_cl) ");   
         
         
         
    }
        
    ////modules rate add end ///
       
    }
         
    }
    
    
         
    ///DELETE DATA AFTER ADD UPDATE FROM CLOUD ///
          
    $sql_table_pt2="select mr_menuid from tbl_menumaster where mr_central_id='$menuid_del' ";
    $sql_pt2  =  $database->mysqlQuery($sql_table_pt2); 
    $num_pt2  = $database->mysqlNumRows($sql_pt2);
    if($num_pt2){   
             
      $sql_gen1 =  mysqli_query($localhost1,"delete from  tbl_cloud_menu_data where tm_central_id='$menuid_del' and branchid='$branchid_cloud'  ");
         
    }
         
    //END///
         
         
    }
    
    
       
         ///////inventory cloud section ///
    
         ////store add/////
    
         $sql_gen_store =  mysqli_query($localhost1,"select * from tbl_inv_kitchen where branchid='$branchid_cloud' and central_created='Y' and updated_in_local!='Y'  "); 
         $num_gen_store  = mysqli_num_rows($sql_gen_store);
	 if($num_gen_store)
	 { 
	  while($result_store  = mysqli_fetch_array($sql_gen_store)) 
	  {
             
              
              $sql_table_selrate  =  $database->mysqlQuery(" INSERT INTO `tbl_inv_kitchen`(`ti_name`, `ti_status`, `ti_type`)"
              . " VALUES ('".$result_store['ti_name']."','".$result_store['ti_status']."','".$result_store['ti_type']."')  "); 
              
              
           $sql_gen_store =  mysqli_query($localhost1,"update tbl_inv_kitchen set updated_in_local='Y' where branchid='$branchid_cloud' and central_created='Y' and  ti_name='".$result_store['ti_name']."'  "); 
        
              
          }
          }
    
    
    
          
          
          
         ////store--vendor add/////
    
         
        
         $sql_gen_store7 =  mysqli_query($localhost1,"select * from tbl_vendor_master where branchid='$branchid_cloud' "
         . " and (central_created='Y' or central_edited='Y')  and updated_in_local='N' "); 
         $num_gen_store7  = mysqli_num_rows($sql_gen_store7);
	 if($num_gen_store7)
	 { 
	  while($result_store  = mysqli_fetch_array($sql_gen_store7)) 
	  {
             
              
               
              if($result_store['v_open_bal']!=''){
                  $openbal=$result_store['v_open_bal'];
              }else{
                   $openbal=0;
              }
              
              if($result_store['v_entry_date']!=''){
                  $entrydate=$result_store['v_entry_date'];
              }else{
                   $entrydate=date('Y-m-d');
              }
              
              
              if($result_store['id']!=''){
                  $id_new='"'.$result_store['id']."'";
              }else{
                   $id_new='NULL';
              }
              
              
             
               if($result_store['central_created']=='Y'){
                  
                 
              $sql_table_selrate  =  $database->mysqlQuery(" insert into tbl_vendor_master( `v_name`, `v_branchid`, `v_address`,"
              . " `v_city`, `v_state`, `v_country`, `v_email`,"
              . " `v_contact_no`, `v_open_bal`, `v_tin_no`, `gst`, `v_srvctax_reg_no`, `v_pan`, `v_bank_name`, `v_branch_name`,"
              . " `v_acct_no`, `v_ifsc`, `v_mode_of_pay`, `v_credit_period`, `v_favour`, `v_conc_name`, `v_conc_desg`,"
              . " `v_conc_contact`, `v_conc_email`, `v_active`, `v_entry_type`, `cloud_sync`, `v_entry_date` ,updated_in_local,id)"
                     
               . " VALUES ('".$result_store['v_name']."','1','".$result_store['v_address']."','".$result_store['v_city']."', "
               . "  '".$result_store['v_state']."' ,'".$result_store['v_country']."' ,'".$result_store['v_email']."' ,"
               . "  '".$result_store['v_contact_no']."','".$openbal."' ,'".$result_store['v_tin_no']."' ,'".$result_store['gst']."' ,"
               . "  '".$result_store['v_srvctax_reg_no']."' ,'".$result_store['v_pan']."' ,'".$result_store['v_bank_name']."',"
               .    "'".$result_store['v_branch_name']."' ,"
               . "  '".$result_store['v_acct_no']."' ,'".$result_store['v_ifsc']."','".$result_store['v_mode_of_pay']."',"
               . "  '".$result_store['v_credit_period']."','".$result_store['v_favour']."','".$result_store['v_conc_name']."',"
               . "  '".$result_store['v_conc_desg']."','".$result_store['v_conc_contact']."','".$result_store['v_conc_email']."','".$result_store['v_active']."',"
               . "  '".$result_store['v_entry_type']."','Y','".$entrydate."', 'Y',$id_new )  "); 
              
             
              
                $sql_gen_store =  mysqli_query($localhost1,"update tbl_vendor_master set updated_in_local='Y' "
                . " where branchid='$branchid_cloud' and  v_name='".$result_store['v_name']."'  "); 
        
           
            }
               
               
               
           
            if($result_store['central_edited']=='Y'){
                
                $city='0';
                if($result_store['v_city']!='' && $result_store['v_city']!=null && $result_store['v_city']!='null'){
                    
                  $city  =$result_store['v_city'];
                    
                }
                
                $state='0';
                if($result_store['v_state']!='' && $result_store['v_state']!=null && $result_store['v_state']!='null'){
                    
                  $state  =$result_store['v_city'];
                    
                }
                
                $cntry='0';
                if($result_store['v_country']!='' && $result_store['v_country']!=null && $result_store['v_country']!='null'){
                    
                  $cntry  =$result_store['v_country'];
                    
                }
                
                
               $sql_table_selrate  =  $database->mysqlQuery(" update tbl_vendor_master set "
                     
               . " v_name='".$result_store['v_name']."',v_address='".$result_store['v_address']."',v_city='$city', "
               . " v_state='$state' ,v_country='$cntry' ,v_email='".$result_store['v_email']."' ,"
               . " v_contact_no='".$result_store['v_contact_no']."',v_open_bal='".$openbal."' ,"
               . " v_tin_no='".$result_store['v_tin_no']."' ,gst='".$result_store['gst']."' ,"
               . " v_srvctax_reg_no='".$result_store['v_srvctax_reg_no']."' ,v_pan='".$result_store['v_pan']."' ,"
               . " v_bank_name='".$result_store['v_bank_name']."',"
               . " v_branch_name='".$result_store['v_branch_name']."' ,"
               . " v_acct_no='".$result_store['v_acct_no']."' ,v_ifsc='".$result_store['v_ifsc']."',v_mode_of_pay='".$result_store['v_mode_of_pay']."',"
               . " v_credit_period='".$result_store['v_credit_period']."',v_favour='".$result_store['v_favour']."',"
               . " v_conc_name='".$result_store['v_conc_name']."',"
               . " v_conc_desg='".$result_store['v_conc_desg']."',v_conc_contact='".$result_store['v_conc_contact']."',"
               . " v_conc_email='".$result_store['v_conc_email']."',v_active='".$result_store['v_active']."',"
               . " v_entry_type='".$result_store['v_entry_type']."' where v_id='".$result_store['v_id']."'  "); 
              
               
               
               
               
               $sql_gen_store =  mysqli_query($localhost1,"update tbl_vendor_master set updated_in_local='Y',central_edited='D' "
               . " where branchid='$branchid_cloud' and  id='".$result_store['id']."'  "); 
         
            }
           
            
              
          }
          }      
          
          
          //////////////////discount master///////////
          
         $entrydate=date('Y-m-d H:i:s');
         
         $sql_gen_store =  mysqli_query($localhost1,"select * from tbl_discountmaster where branchid='$branchid_cloud' "
         . " and (ds_cloud_added='Yes' or ds_cloud_edit='Edit')  "); 
         $num_gen_store  = mysqli_num_rows($sql_gen_store);
	 if($num_gen_store)
	 { 
	  while($result_store  = mysqli_fetch_array($sql_gen_store)) 
	  {
             
              if($result_store['ds_cloud_added']=='Yes'){
                  
                $sql_table_selrate  =  $database->mysqlQuery("INSERT into  tbl_discountmaster (ds_discountid,ds_discountname,ds_item_discount,"
                . " ds_branchid,ds_status,ds_discountof,ds_mode,ds_cloud_added)"
                . " values('".$result_store['ds_discountid']."','".$result_store['ds_discountname']."','".$result_store['ds_item_discount']."',"
                . " '".$result_store['ds_branchid']."','".$result_store['ds_status']."','".$result_store['ds_discountof']."',"
                . " '".$result_store['ds_mode']."','Done')"); 
              
                
               $sql_gen_store =  mysqli_query($localhost1,"update tbl_discountmaster set ds_cloud_added='Done' "
               . " where branchid='$branchid_cloud' and ds_discountid='".$result_store['ds_discountid']."'  "); 
                
          }
              
              
           if($result_store['ds_cloud_edit']=='Edit'){
                  
                 $sql_table_selrate  =  $database->mysqlQuery("update  tbl_discountmaster set "
                 . " ds_discountname='".$result_store['ds_discountname']."',ds_item_discount='".$result_store['ds_item_discount']."', "
                 . " ds_status='".$result_store['ds_status']."',ds_discountof='".$result_store['ds_discountof']."',ds_mode='".$result_store['ds_mode']."', "
                 . " ds_cloud_edit ='Updated' where ds_discountid='".$result_store['ds_discountid']."'  "); 
             
                $sql_gen_store =  mysqli_query($localhost1,"update tbl_discountmaster set ds_cloud_edit='Updated' "
                . " where branchid='$branchid_cloud' and ds_discountid='".$result_store['ds_discountid']."'  "); 
                 
                  
          }
              
              
         }}
         
         
         //////////////////staff master/////
          
         $entrydate=date('Y-m-d H:i:s');
         
         $sql_gen_store =  mysqli_query($localhost1,"select * from tbl_staffmaster where branchid='$branchid_cloud' and "
         . " (ser_cloud_added='Yes' or ser_cloud_edit='Edit')  "); 
         $num_gen_store  = mysqli_num_rows($sql_gen_store);
	 if($num_gen_store)
	 { 
	  while($result_store  = mysqli_fetch_array($sql_gen_store)) 
	  {
             
             
              if($result_store['ser_cloud_added']=='Yes'){
                  
                $sql_table_selrate  =  $database->mysqlQuery("INSERT into  tbl_staffmaster (ser_staffid,ser_firstname,ser_designation,"
                . " ser_department,ser_gender,ser_employeestatus,ser_created_by,ser_created_time,ser_cloud_added,ser_branchofficeid,ser_authorisation_code)"
                . " values('".$result_store['ser_staffid']."','".$result_store['ser_firstname']."','".$result_store['ser_designation']."',"
                . " '".$result_store['ser_department']."','".$result_store['ser_gender']."','".$result_store['ser_employeestatus']."',"
                . " '".$result_store['ser_created_by']."','".$result_store['ser_created_time']."','Done','1','".$result_store['ser_authorisation_code']."')"); 
              
                
                $sql_gen_store =  mysqli_query($localhost1,"update tbl_staffmaster set ser_cloud_added='Done' "
                . " where branchid='$branchid_cloud' and ser_staffid='".$result_store['ser_staffid']."'  "); 
                
              }
              
              
              
              
              if($result_store['ser_cloud_edit']=='Edit'){
                  
                 $sql_table_selrate  =  $database->mysqlQuery("update  tbl_staffmaster set "
                 . " ser_firstname='".$result_store['ser_firstname']."',ser_designation='".$result_store['ser_designation']."',"
                 . " ser_department='".$result_store['ser_department']."',ser_gender='".$result_store['ser_gender']."',ser_employeestatus='".$result_store['ser_employeestatus']."',"
                 . " ser_last_update ='Update from Cloud'  ,ser_cloud_edit='Updated', ser_authorisation_code='".$result_store['ser_authorisation_code']."'  where ser_staffid='".$result_store['ser_staffid']."'  "); 
             
                 $sql_gen_store =  mysqli_query($localhost1,"update tbl_staffmaster set ser_cloud_edit='Updated' "
                 . " where branchid='$branchid_cloud' and ser_staffid='".$result_store['ser_staffid']."'  "); 
                 
              }
              
               
         }}  
         
       
      
         //////////////////staff master permissions/////
          
         $sql_gen_store09 =  mysqli_query($localhost1,"select * from tbl_staffmaster where branchid='$branchid_cloud' and ser_perm_edited_cloud='Y'  "); 
         $num_gen_store09  = mysqli_num_rows($sql_gen_store09);
	 if($num_gen_store09)
	 { 
	  while($request  = mysqli_fetch_array($sql_gen_store09)) 
	  {
             
 
                  
   $sql_table_selrate  =  $database->mysqlQuery("update tbl_staffmaster set ser_cancelpermission='".$request['ser_cancelpermission']."' ,"
   . " ser_bill_cancel_permission='".$request['ser_bill_cancel_permission']."',"
   . " ser_discountpermission='".$request['ser_discountpermission']."',ser_compl_mgmt='".$request['ser_compl_mgmt']."', "
   . " ser_discount_manual='".$request['ser_discount_manual']."',ser_stockchng_permission='".$request['ser_stockchng_permission']."',"
   . " ser_cancelwithkey='".$request['ser_cancelwithkey']."',"
   . " ser_kot_cancel_permission='".$request['ser_kot_cancel_permission']."',  ser_bill_reprint_per='".$request['ser_bill_reprint_per']."',"
   . " ser_bill_regen_per='".$request['ser_bill_regen_per']."',"
   . " ser_release_login='".$request['ser_release_login']."',ser_shift_permission='".$request['ser_shift_permission']."',ser_counter_enable_hold='".$request['ser_counter_enable_hold']."', "
   . " ser_permit_cash_drawer_open='".$request['ser_permit_cash_drawer_open']."',ser_dayclose_permission='".$request['ser_dayclose_permission']."', "         
   . " ser_counter_enable_generate='".$request['ser_counter_enable_generate']."'  ,ser_bill_reset='".$request['ser_bill_reset']."',"
   . " ser_dayclose_revert_permission='".$request['ser_dayclose_revert_permission']."',ser_tip_edit_permission='".$request['ser_tip_edit_permission']."' , "
   . " ser_order_split_permission='".$request['ser_order_split_permission']."',ser_bill_settle_change_per='".$request['ser_bill_settle_change_per']."', "
   . " ser_kot_reprint_per='".$request['ser_kot_reprint_per']."',ser_bill_settle_permission='".$request['ser_bill_settle_permission']."', "
  . "  ser_bill_print_permission='".$request['ser_bill_print_permission']."' ,ser_comp_permission='".$request['ser_comp_permission']."', "
  . "  ser_credit_permission='".$request['ser_credit_permission']."', ser_comp_view='".$request['ser_comp_view']."',ser_credit_view='".$request['ser_credit_view']."' ,ser_force_close='".$request['ser_force_close']."' ,"
  . "  ser_com_item='".$request['ser_com_item']."', ser_online_order='".$request['ser_online_order']."',  "
  . "  ser_counter_settle_permission='".$request['ser_counter_settle_permission']."',  "
  . "  ser_advance_pay_permission='".$request['ser_advance_pay_permission']."',ser_change_table_permission='".$request['ser_change_table_permission']."', "
  . "  ser_menu_unit_edit='".$request['ser_menu_unit_edit']."', ser_delete_menu='".$request['ser_delete_menu']."', "
  . "  ser_all_shift_closer='".$request['ser_all_shift_closer']."', "     
  . "  ser_item_discount_manual='".$request['ser_item_discount_manual']."',ser_discount_after='".$request['ser_discount_after']."', "       
  . "  ser_physical_stock_permission='".$request['ser_physical_stock_permission']."',ser_wastage_entry='".$request['ser_wastage_entry']."', "    
  . "  ser_wastage_entry='".$request['ser_wastage_entry']."',ser_stock_entry='".$request['ser_stock_entry']."', "      
  . "  ser_req='".$request['ser_req']."',ser_po='".$request['ser_po']."',ser_rps='".$request['ser_rps']."', " 
  . "  ser_store_stock='".$request['ser_store_stock']."',ser_consumption='".$request['ser_consumption']."',ser_purchase_return='".$request['ser_purchase_return']."', " 
  . "  ser_inventory_reports='".$request['ser_inventory_reports']."',ser_store_transfer='".$request['ser_store_transfer']."',ser_return_history='".$request['ser_return_history']."', " 
  . "  ser_approve_cancel_inv='".$request['ser_approve_cancel_inv']."',ser_indent='".$request['ser_indent']."',ser_central_accept='".$request['ser_central_accept']."', " 
  . "  ser_recipe='".$request['ser_recipe']."',ser_central_kitchen='".$request['ser_central_kitchen']."',ser_production='".$request['ser_production']."', "    
  . "  ser_normal_transfer_accept='".$request['ser_normal_transfer_accept']."',ser_direct_transfer_accept='".$request['ser_direct_transfer_accept']."',ser_indent_accept='".$request['ser_indent_accept']."', " 
  . "  ser_direct_transfer='".$request['ser_direct_transfer']."' , ser_perm_edited_cloud='D' "    
   ."  where ser_staffid='".$request['ser_staffid']."' "); 
       
       ////login detail  permsion ///
   
         $sql_gen_store091 =  mysqli_query($localhost1,"select ls_applogin,ls_restrict_login from tbl_logindetails where"
         . " branchid='$branchid_cloud' and ls_staffid='".$request['ser_staffid']."'  "); 
         $num_gen_store091  = mysqli_num_rows($sql_gen_store091);
	 if($num_gen_store091)
	 { 
	  while($request1  = mysqli_fetch_array($sql_gen_store091)) 
	  {

            $sql_table_selrate  =  $database->mysqlQuery("update tbl_logindetails set ls_applogin='".$request1['ls_applogin']."', "
            . " ls_restrict_login='".$request1['ls_restrict_login']."'  where ls_staffid='".$request['ser_staffid']."' ");

   
         }}
   
      
           $sql_gen_store99 =  mysqli_query($localhost1,"update tbl_staffmaster set ser_perm_edited_cloud='D' "
           . " where branchid='$branchid_cloud' and ser_staffid='".$request['ser_staffid']."' "); 
          
   } }
         
        
   
      /////accounts section start////
   
   
          /////supplier voucher/////
   
         $sql_gen_store_acc =  mysqli_query($localhost1,"select * from  tbl_supplier_voucher
         where branchid='$branchid_cloud' and (sv_cloud_added='Y' or sv_cloud_edited='Y') order by sv_entry_time asc"); 
         $num_gen_storeacc  = mysqli_num_rows($sql_gen_store_acc);
	 if($num_gen_storeacc)
	 { 
	  while($request_acc  = mysqli_fetch_array($sql_gen_store_acc)) 
	  {
              
              
        ///add voucher/////
              
        if($request_acc['sv_cloud_added']=='Y'){
            
                  
         $date=date('Y-m-d');   
        
         $insertion['sv_vendor_id'] 		        =  mysqli_real_escape_string($database->DatabaseLink,$request_acc['sv_vendor_id']);
        
        if($_REQUEST['sv_date']!=''){
            
          $insertion['sv_date'] 		               =  mysqli_real_escape_string($database->DatabaseLink,$request_acc['sv_date']);
        }
        
        $insertion['sv_address'] 		       =  mysqli_real_escape_string($database->DatabaseLink,$request_acc['sv_address']);
        $insertion['sv_invoice_no'] 		       =  mysqli_real_escape_string($database->DatabaseLink,$request_acc['sv_invoice_no']);
        $insertion['sv_invoice_amount'] 	        =  mysqli_real_escape_string($database->DatabaseLink,$request_acc['sv_invoice_amount']);
        $insertion['sv_from'] 		               =  mysqli_real_escape_string($database->DatabaseLink,$request_acc['sv_from']);
        $insertion['sv_paid_amount'] 		       =  mysqli_real_escape_string($database->DatabaseLink,$request_acc['sv_paid_amount']);
        $insertion['sv_trn_detail'] 		        =  mysqli_real_escape_string($database->DatabaseLink,$request_acc['sv_trn_detail']); 
        $insertion['sv_remarks'] 		       =  mysqli_real_escape_string($database->DatabaseLink,$request_acc['sv_remarks']);
        $insertion['sv_entry_type'] 		       =  mysqli_real_escape_string($database->DatabaseLink,$request_acc['sv_entry_type']);
        $insertion['sv_entry_date'] 		       =  mysqli_real_escape_string($database->DatabaseLink,$request_acc['sv_entry_date']);
        $insertion['sv_credit_amount'] 		       =  mysqli_real_escape_string($database->DatabaseLink,$request_acc['sv_credit_amount']);
        $insertion['sv_purchase_type'] 		       =  mysqli_real_escape_string($database->DatabaseLink,$request_acc['sv_purchase_type']);
         
        if($_REQUEST['sv_discount']!=''){
            
                $insertion['sv_discount'] 		  =  mysqli_real_escape_string($database->DatabaseLink,$request_acc['sv_discount']);
        } 
        
       if($_REQUEST['sv_subtotal']!=''){
            
                $insertion['sv_subtotal'] 		   =  mysqli_real_escape_string($database->DatabaseLink,$request_acc['sv_subtotal']);
       }  
       
       
       if($_REQUEST['sv_tax']!=''){
           
                $insertion['sv_tax'] 		          =  mysqli_real_escape_string($database->DatabaseLink,$request_acc['sv_tax']);
       } 
       
       if($_REQUEST['sv_credit_amount']>0){   
           
                $insertion['sv_paid_fully'] 		   =  mysqli_real_escape_string($database->DatabaseLink,'N');              
       }else{
               
                $insertion['sv_paid_fully'] 		   =  mysqli_real_escape_string($database->DatabaseLink,'Y');
               
       }
           
         $insertion['sv_type_pay'] 		         =  mysqli_real_escape_string($database->DatabaseLink,'First');  
             
         $entry_time=date('Y-m-d H:i:s'); 
         
         $insertion['sv_entry_time'] 		        =  mysqli_real_escape_string($database->DatabaseLink,$request_acc['sv_entry_time']); 
        
         $insertion['sv_login'] 		        =  mysqli_real_escape_string($database->DatabaseLink,$_SESSION['expodine_id']);  
         
        $insertion['cloud_sync'] 		         =  mysqli_real_escape_string($database->DatabaseLink,'Y');   
         
         $sql=$database->check_duplicate_entry('tbl_supplier_voucher',$insertion);
	 if($sql!=1)
	 {
             
	      $insertid =  $database->insert('tbl_supplier_voucher',$insertion);
         } 
         
         
         $sql_gen_store_acc =  mysqli_query($localhost1,"update  tbl_supplier_voucher
         set sv_cloud_added='D'  where branchid='$branchid_cloud' and  sv_id='".$request_acc['sv_id']."' "); 
       
         
  } 
          
     
       ///edit supplier voucher ////
         
       if($request_acc['sv_cloud_edited']=='Y'){  
         
         
       if($request_acc['sv_discount']!=''){    

           $dis=$request_acc['sv_discount'];
           
       }else{
           
           $dis='0';
       }
    
    

        if($request_acc['sv_date']!=''){

                 $query3=$database->mysqlQuery("UPDATE `tbl_supplier_voucher` SET sv_date='".$request_acc['sv_date']."',`sv_address`='".$request_acc['sv_address']."',"
                 . " `sv_invoice_no`='".$request_acc['sv_invoice_no']."',"
                 . " `sv_invoice_amount`='".$_REQUEST['sv_invoice_amount']."',`sv_from`='".$request_acc['sv_from']."',`sv_paid_amount`='".$request_acc['sv_paid_amount']."',"
                 . " `sv_trn_detail`='".$request_acc['sv_trn_detail']."', cloud_sync='Y' , "
                 . " `sv_remarks`='".$request_acc['sv_remarks']."',sv_credit_amount='".$request_acc['sv_credit_amount']."',"
                 . " sv_purchase_type='".$request_acc['sv_purchase_type']."',sv_discount='".$dis."'  where sv_id='".$request_acc['sv_id']."' ");

        }else{

                 $query3=$database->mysqlQuery("UPDATE `tbl_supplier_voucher` SET sv_date=NULL,`sv_address`='".$request_acc['sv_address']."',"
                 . " `sv_invoice_no`='".$request_acc['sv_invoice_no']."',"
                 . " `sv_invoice_amount`='".$request_acc['sv_invoice_amount']."',`sv_from`='".$request_acc['sv_from']."',`sv_paid_amount`='".$request_acc['sv_paid_amount']."',"
                 . " `sv_trn_detail`='".$request_acc['sv_trn_detail']."',cloud_sync='Y' , "
                 . " `sv_remarks`='".$request_acc['sv_remarks']."',sv_credit_amount='".$request_acc['sv_credit_amount']."',"
                 . "  sv_purchase_type='".$request_acc['sv_purchase_type']."' ,sv_discount='".$dis."'   where sv_id='".$request_acc['sv_id']."' "); 
       
        } 
        

       $sql_gen_store_acc =  mysqli_query($localhost1,"update  tbl_supplier_voucher
       set sv_cloud_edited='D'  where branchid='$branchid_cloud' and  sv_id='".$request_acc['sv_id']."' "); 
            
         
    }
        
        
        
              
   } }
   
   
         ////////////employee voucher////////////////
 
         $sql_gen_store_acc11 =  mysqli_query($localhost1,"select * from  tbl_employee_voucher
         where branchid='$branchid_cloud' and (ev_cloud_added='Y' or ev_cloud_edited='Y') order by ev_entry_time asc"); 
         $num_gen_storeacc11  = mysqli_num_rows($sql_gen_store_acc11);
	 if($num_gen_storeacc11)
	 { 
	  while($request_acc11  = mysqli_fetch_array($sql_gen_store_acc11)) 
	  {
              
              
          if($request_acc11['ev_cloud_added']=='Y'){
                  
        $date=date('Y-m-d');
        $insertion['ev_employee_id'] 		        =  mysqli_real_escape_string($database->DatabaseLink,$request_acc11['ev_employee_id']); 
        $insertion['ev_department'] 		        =  mysqli_real_escape_string($database->DatabaseLink,$request_acc11['ev_department']); 
        $insertion['ev_pay_type'] 		        =  mysqli_real_escape_string($database->DatabaseLink,$request_acc11['ev_pay_type']); 
        
        
             $insertion['ev_date'] 		=  mysqli_real_escape_string($database->DatabaseLink,$request_acc11['ev_date']); 
            
             $insertion['ev_amount'] 		=  mysqli_real_escape_string($database->DatabaseLink,$request_acc11['ev_amount']); 
             $insertion['ev_from'] 		=  mysqli_real_escape_string($database->DatabaseLink,$request_acc11['ev_from']); 
             $insertion['ev_approved_by'] 		        =  mysqli_real_escape_string($database->DatabaseLink,$request_acc11['ev_approved_by']); 
             $insertion['ev_trans'] 		=  mysqli_real_escape_string($database->DatabaseLink,$request_acc11['ev_trans']); 
             $insertion['ev_remarks'] 		=  mysqli_real_escape_string($database->DatabaseLink,$request_acc11['ev_remarks']); 
             
             $insertion['ev_entry_date'] 	=  mysqli_real_escape_string($database->DatabaseLink,$request_acc11['ev_entry_date']); 
             $insertion['ev_entry_login'] 	=  mysqli_real_escape_string($database->DatabaseLink,'Cloud'); 
             
             $insertion['ev_month'] 		=  mysqli_real_escape_string($database->DatabaseLink,$request_acc11['ev_month']); 
             $insertion['ev_year'] 		=  mysqli_real_escape_string($database->DatabaseLink,$request_acc11['ev_year']); 
             
            if($request_acc11['ev_pay_type_acc'] =='First'){
                 
             $insertion['ev_pay_type_acc'] 	=  mysqli_real_escape_string($database->DatabaseLink,'First'); 
             $insertion['ev_net_salary_new'] 	=  mysqli_real_escape_string($database->DatabaseLink,$request_acc11['ev_net_salary_new']); 
              
            }else{
                 
               $insertion['ev_pay_type_acc'] 	=  mysqli_real_escape_string($database->DatabaseLink,'Partial');  
                 
               $insertion['ev_net_salary_new'] 	=  mysqli_real_escape_string($database->DatabaseLink,$request_acc11['ev_net_salary_new']); 
            }

                    $entry_time=date('Y-m-d H:i:s'); 
                    $insertion['ev_entry_time'] 		        =  mysqli_real_escape_string($database->DatabaseLink,$entry_time); 

                    $insertion['ev_login'] 		        =  mysqli_real_escape_string($database->DatabaseLink,'Cloud'); 
         
                      $insertion['cloud_sync'] 		         =  mysqli_real_escape_string($database->DatabaseLink,'Y');   
                    
                    $sql=$database->check_duplicate_entry('tbl_employee_voucher',$insertion);
                     if($sql!=1)
                     {

                      $insertid =  $database->insert('tbl_employee_voucher',$insertion);
                     } 
                   
                  $sql_gen_store_acc =  mysqli_query($localhost1,"update  tbl_employee_voucher
         set ev_cloud_added='D'  where branchid='$branchid_cloud' and  ev_id='".$request_acc11['ev_id']."' ");     
                     
                     
                   
               }
   
               
               
   //edit employee voucher///
               
   if($request_acc11['ev_cloud_edited']=='Y'){  
               
               
    if($request_acc11['ev_date']!=''){
    $dov='"'.$request_acc11['ev_date'].'"';
    }else{
      $dov='NULL';  
    }
    
     $query3=$database->mysqlQuery(" UPDATE `tbl_employee_voucher` SET `ev_employee_id`='".$request_acc11['ev_employee_id']."',"
             . " `ev_department`='".$request_acc11['ev_department']."',`ev_pay_type`='".$request_acc11['ev_pay_type']."',`ev_date`=$dov,"
             . " `ev_amount`='".$request_acc11['ev_amount']."',cloud_sync='Y' , "
             . " `ev_from`='".$request_acc11['ev_from']."',`ev_approved_by`='".$request_acc11['ev_approved_by']."',`ev_trans`='".$request_acc11['ev_trans']."',"
             . " `ev_remarks`='".$request_acc11['ev_remarks']."',ev_month='".$request_acc11['ev_month']."',ev_year='".$request_acc11['ev_year']."' "
             . "  WHERE ev_id='".$request_acc11['ev_id']."' ");

       $sql_gen_store_acc =  mysqli_query($localhost1,"update  tbl_employee_voucher
       set ev_cloud_edited='D'  where branchid='$branchid_cloud' and  ev_id='".$request_acc11['ev_id']."' "); 
               
       
           }     
               
              
          } }
   
   
   
   
   
         ////////////expense voucher////////////////
 
         $sql_gen_store_acc1 =  mysqli_query($localhost1,"select * from  tbl_expense_voucher
         where branchid='$branchid_cloud' and (ev_cloud_added='Y' or ev_cloud_edited='Y') order by ev_entry_time asc"); 
         $num_gen_storeacc1  = mysqli_num_rows($sql_gen_store_acc1);
	 if($num_gen_storeacc1)
	 { 
	  while($request_acc1  = mysqli_fetch_array($sql_gen_store_acc1)) 
	  {
              
              
         ///add voucher/////
              
        if($request_acc1['ev_cloud_added']=='Y'){
                 
                 
        $entry_time=date('Y-m-d H:i:s'); 
      
        $date=date('Y-m-d');
        
        if($request_acc1['ev_date']!=''){
        $insertion['ev_date'] 		               =  mysqli_real_escape_string($database->DatabaseLink,$request_acc1['ev_date']);
        }
        
        $insertion['ev_from_acc'] 		       =  mysqli_real_escape_string($database->DatabaseLink,$request_acc1['ev_from_acc']);
        $insertion['ev_to_acc'] 		       =  mysqli_real_escape_string($database->DatabaseLink,$request_acc1['ev_to_acc']);
        $insertion['ev_amount'] 	        =  mysqli_real_escape_string($database->DatabaseLink,$request_acc1['ev_amount']);
        
        $insertion['ev_transaction_data'] 		       =  mysqli_real_escape_string($database->DatabaseLink,$request_acc1['ev_transaction_data']);
        $insertion['ev_remarks'] 		        =  mysqli_real_escape_string($database->DatabaseLink,$request_acc1['ev_remarks']); 
        $insertion['ev_acc_type'] 		        =  mysqli_real_escape_string($database->DatabaseLink,$request_acc1['ev_acc_type']); 
        
        $insertion['ev_entry_date'] 		        =  mysqli_real_escape_string($database->DatabaseLink,$date); 
        
        $insertion['ev_entry_time'] 		        =  mysqli_real_escape_string($database->DatabaseLink,$entry_time); 
        
        $insertion['ev_login'] 		        =  mysqli_real_escape_string($database->DatabaseLink,$_SESSION['expodine_id']); 
        
        $insertion['cloud_sync'] 		         =  mysqli_real_escape_string($database->DatabaseLink,'Y');   
        
        $sql=$database->check_duplicate_entry('tbl_expense_voucher',$insertion);
	 if($sql!=1)
	 {
             
	  $insertid =  $database->insert('tbl_expense_voucher',$insertion);
         } 
         
         
         $sql_gen_store_acc =  mysqli_query($localhost1,"update  tbl_expense_voucher
         set ev_cloud_added='D'  where branchid='$branchid_cloud' and  ev_id='".$request_acc1['ev_id']."' "); 
       
         
   } 
          
   
   
           
    ///edit expense voucher ////
         
    if($request_acc1['ev_cloud_edited']=='Y'){  
         
    if($request_acc1['ev_date']!=''){
             
     $query3=$database->mysqlQuery("UPDATE `tbl_expense_voucher` SET ev_acc_type='".$request_acc1['ev_acc_type']."',"
             . " ev_date='".$request_acc1['ev_date']."',`ev_from_acc`='".$_REQUEST['ev_from_acc']."',"
             . " `ev_to_acc`='".$request_acc1['ev_to_acc']."',cloud_sync='Y' , "
             . " `ev_amount`='".$request_acc1['ev_amount']."',`ev_transaction_data`='".$request_acc1['ev_transaction_data']."',"
             . " `ev_remarks`='".$request_acc1['ev_remarks']."' where ev_id='".$request_acc1['ev_id']."' ");
             
    }else{
        
             $query3=$database->mysqlQuery("UPDATE `tbl_expense_voucher` SET ev_acc_type='".$request_acc1['ev_acc_type']."', "
             . " ev_date=NULL,`ev_from_acc`='".$_REQUEST['ev_from_acc']."',"
             . " `ev_to_acc`='".$request_acc1['ev_to_acc']."',cloud_sync='Y' , "
             . " `ev_amount`='".$request_acc1['ev_amount']."',`ev_transaction_data`='".$request_acc1['ev_transaction_data']."',"
             . " `ev_remarks`='".$request_acc1['ev_remarks']."' where ev_id='".$request_acc1['ev_id']."' ");
             
    }
    
       $sql_gen_store_acc =  mysqli_query($localhost1,"update  tbl_expense_voucher
       set ev_cloud_edited='D'  where branchid='$branchid_cloud' and  ev_id='".$request_acc1['ev_id']."' "); 
            
         
   }
   
        
              
   } }
    
   
   
    ///delete expense voucher/////
   
         $entry_time1=date('Y-m-d H:i:s'); 
    
         $sql_gen_store_acc12 =  mysqli_query($localhost1,"select tv_cloud_id_deleted from  tbl_voucher_delete_log
         where branchid='$branchid_cloud' and tv_deleted_local='N'  "); 
         $num_gen_storeacc12  = mysqli_num_rows($sql_gen_store_acc12);
	 if($num_gen_storeacc12)
	 { 
	  while($request_acc12  = mysqli_fetch_array($sql_gen_store_acc12)) 
	  {
              
              
        $sql_kotlist225  =  $database->mysqlQuery("SELECT ev_from_acc,ev_to_acc,ev_amount,ev_date,ev_remarks from tbl_expense_voucher "
        . " where ev_id='".$request_acc12['tv_cloud_id_deleted']."' "); 
	$num_kotlist22 = $database->mysqlNumRows($sql_kotlist225);
	if($num_kotlist22){
	while($result_kotlist256  = $database->mysqlFetchArray($sql_kotlist225)) 
	{ 
            
            
        $data='From:'.$result_kotlist256['ev_from_acc'].' To:'.$result_kotlist256['ev_to_acc'].' Amount:'.$result_kotlist256['ev_amount'].' Date:'.$result_kotlist256['ev_date'].' Remarks:'.$result_kotlist256['ev_remarks'];        
          
        
        $sql_kotlist2256  =  $database->mysqlQuery("INSERT INTO `tbl_voucher_delete_log`(`tvd_type`, `tvd_data`, `tvd_date`,tv_cloud_id_deleted,tv_deleted_local) "
        . "VALUES ('Expense','$data','$entry_time1','".$request_acc12['tv_cloud_id_deleted']."','D')");   
                     
          ////delete local update /////
                    
         $query3=$database->mysqlQuery("delete from tbl_expense_voucher where ev_id='".$request_acc12['tv_cloud_id_deleted']."' ");
                       
         $sql_gen_store_acc127 =  mysqli_query($localhost1,"update tbl_voucher_delete_log set tv_deleted_local='D'
         where branchid='$branchid_cloud' and tv_cloud_id_deleted='".$request_acc12['tv_cloud_id_deleted']."' "); 
                    
                    
        } } 
              
              
   } }
   
   
         /////expense delete end///// 
   
   
   
         /////contra voucher start ////
   
   
         $sql_gen_store_acc125 =  mysqli_query($localhost1,"select * from tbl_contra_voucher
         where branchid='$branchid_cloud' and (cv_cloud_added='Y' or cv_cloud_edited='Y')  "); 
         $num_gen_storeacc125  = mysqli_num_rows($sql_gen_store_acc125);
	 if($num_gen_storeacc125)
	 { 
	  while($request_acc125  = mysqli_fetch_array($sql_gen_store_acc125)) 
	  {
              
              
        ///addd///
              
        if($request_acc125['cv_cloud_added']=='Y'){ 
              
        $date=date('Y-m-d');
        
        if($request_acc125['cv_date']!=''){
         $insertion['cv_date'] 		                =  mysqli_real_escape_string($database->DatabaseLink,$request_acc125['cv_date']);
        }
        
        $insertion['cv_from_acc'] 		        =  mysqli_real_escape_string($database->DatabaseLink,$request_acc125['cv_from_acc']);
        $insertion['cv_to_acc'] 		        =  mysqli_real_escape_string($database->DatabaseLink,$request_acc125['cv_to_acc']);
        $insertion['cv_amount'] 	                =  mysqli_real_escape_string($database->DatabaseLink,$request_acc125['cv_amount']);
        $insertion['cv_transaction_data'] 		=  mysqli_real_escape_string($database->DatabaseLink,$request_acc125['cv_transaction_data']);
        $insertion['cv_remarks'] 		        =  mysqli_real_escape_string($database->DatabaseLink,$request_acc125['cv_remarks']); 
        $insertion['cv_entry_date'] 		        =  mysqli_real_escape_string($database->DatabaseLink,$date); 
        
        $insertion['cloud_sync'] 		         =  mysqli_real_escape_string($database->DatabaseLink,'Y');   
        
        $sql=$database->check_duplicate_entry('tbl_contra_voucher',$insertion);
	 if($sql!=1)
	 {
             
        $insertid =  $database->insert('tbl_contra_voucher',$insertion);
    
        $sql_kotlist22  =  $database->mysqlQuery("SELECT max(tps_id) as mxid from tbl_ledger_setting where "
        . " tps_ledger_id='".$request_acc125['cv_to_acc']."' limit 1 "); 
        
	$num_kotlist22 = $database->mysqlNumRows($sql_kotlist22);
	if($num_kotlist22){
	while($result_kotlist256  = $database->mysqlFetchArray($sql_kotlist22)) 
	{ 
             $sql_kotlist2  =  $database->mysqlQuery("update tbl_ledger_setting set "
             . " tps_closing_balance=(tps_closing_balance+'".$request_acc125['cv_amount']."')  where tps_id='".$result_kotlist256['mxid']."'  "); 
	}} 
        
     } 
     
      $sql_gen_store_acc127 =  mysqli_query($localhost1,"update tbl_contra_voucher set cv_cloud_added='D'
      where branchid='$branchid_cloud' and cv_id='".$request_acc125['cv_id']."' "); 
     
     }     
             
        
    ////////update contra ////
        
        
    if($request_acc125['cv_cloud_edited']=='Y'){ 
             
             
    if($request_acc125['cv_date']!=''){
        
     $query3=$database->mysqlQuery("UPDATE `tbl_contra_voucher` SET cv_date='".$request_acc125['cv_date']."', `cv_from_acc`='".$request_acc125['cv_from_acc']."',"
     . " `cv_to_acc`='".$request_acc125['cv_to_acc']."', cloud_sync='Y' , "
     . " `cv_amount`='".$request_acc125['cv_amount']."', `cv_transaction_data`='".$request_acc125['cv_transaction_data']."', "
     . " `cv_remarks`='".$request_acc125['cv_remarks']."' where cv_id='".$request_acc125['cv_id']."' ");
             
    }else{
        
            $query3=$database->mysqlQuery("UPDATE `tbl_contra_voucher` SET cv_date=NULL,`cv_from_acc`='".$request_acc125['cv_from_acc']."' , "
             . " `cv_to_acc`='".$request_acc125['cv_to_acc']."', cloud_sync='Y' , "
             . " `cv_amount`='".$request_acc125['cv_amount']."', `cv_transaction_data`='".$request_acc125['cv_transaction_data']."', "
             . " `cv_remarks`='".$request_acc125['cv_remarks']."' where cv_id='".$request_acc125['cv_id']."' ");
    }
    
     
        $sql_kotlist22  =  $database->mysqlQuery("SELECT max(tps_id) as mxid from tbl_ledger_setting where "
        . " tps_ledger_id='".$request_acc125['cv_to_acc']."' limit 1 "); 
	$num_kotlist22 = $database->mysqlNumRows($sql_kotlist22);
	if($num_kotlist22){
	while($result_kotlist256  = $database->mysqlFetchArray($sql_kotlist22)) 
	{ 
                                                      
             $sql_kotlist2  =  $database->mysqlQuery("update tbl_ledger_setting set "
             . " tps_closing_balance=(tps_closing_balance+'".$request_acc125['cv_amount']."')  where tps_id='".$result_kotlist256['mxid']."'  "); 
					
                                                  
        } }
        
        
        $sql_gen_store_acc127 =  mysqli_query($localhost1,"update tbl_contra_voucher set cv_cloud_edited='D'
        where branchid='$branchid_cloud' and cv_id='".$request_acc125['cv_id']."' "); 
              
    }
        
    ////edit contra end//   
             
 } }
   
  
         //////ledger master add/////

         $sql_gen_store_acc_led =  mysqli_query($localhost1,"select * from tbl_ledger_master
         where branchid='$branchid_cloud' and (tlm_cloud_add='Y' or tlm_cloud_edit='Y')  "); 
         $num_gen_storeacc_led  = mysqli_num_rows($sql_gen_store_acc_led);
	 if($num_gen_storeacc_led)
	 { 
	  while($request_acc_led  = mysqli_fetch_array($sql_gen_store_acc_led)) 
	  {
               
              
     ///addd///
              
     if($request_acc_led['tlm_cloud_add']=='Y'){ 
            
            
     $insertion1['tlm_ledger_name'] 		=  mysqli_real_escape_string($database->DatabaseLink,$request_acc_led['tlm_ledger_name']);
     
     $insertion1['tlm_group'] 		=  mysqli_real_escape_string($database->DatabaseLink,$request_acc_led['tlm_group']);
     
     if($request_acc_led['tlm_vendor_id']!=''){
      $insertion1['tlm_vendor_id'] 		=  mysqli_real_escape_string($database->DatabaseLink,$request_acc_led['tlm_vendor_id']);
     }
     
     if($request_acc_led['tlm_staff_id']!=''){
      $insertion1['tlm_staff_id'] 		=  mysqli_real_escape_string($database->DatabaseLink,$request_acc_led['tlm_staff_id']);
     }
     
     if($request_acc_led['tlm_guest_id']!=''){
      $insertion1['tlm_guest_id'] 		=  mysqli_real_escape_string($database->DatabaseLink,$request_acc_led['tlm_guest_id']);
     }
     
     if($request_acc_led['tlm_company_id']!=''){
      $insertion1['tlm_company_id'] 		=  mysqli_real_escape_string($database->DatabaseLink,$request_acc_led['tlm_company_id']);
     }
    
   if($request_acc_led['tlm_type']!=''){ 
     $insertion1['tlm_type'] 		=  mysqli_real_escape_string($database->DatabaseLink,$request_acc_led['tlm_type']);
   }
     
     
   if($request_acc_led['tlm_open_bal']!=''){    
     $insertion1['tlm_open_bal'] 		=  mysqli_real_escape_string($database->DatabaseLink,$request_acc_led['tlm_open_bal']);
   }
     
    if($request_acc_led['tlm_close_bal']!=''){ 
     $insertion1['tlm_close_bal'] 		=  mysqli_real_escape_string($database->DatabaseLink,$request_acc_led['tlm_close_bal']);
    }
     
     if($request_acc_led['tlm_capital_cb']!=''){
      $insertion1['tlm_capital_cb'] 		=  mysqli_real_escape_string($database->DatabaseLink,$request_acc_led['tlm_capital_cb']);
     }
     
     $insertion1['tlm_cloud_add'] 		=  mysqli_real_escape_string($database->DatabaseLink,'D');
    
     if($request_acc_led['tlm_cloud_add_by']!=''){
      $insertion1['tlm_cloud_add_by'] 		=  mysqli_real_escape_string($database->DatabaseLink,$request_acc_led['tlm_cloud_add_by']);
     }
     
     $insertion1['cloud_sync'] 		=  mysqli_real_escape_string($database->DatabaseLink,'N');
     
     
       $sql=$database->check_duplicate_entry('tbl_ledger_master',$insertion1);
     
	if($sql!=1)
	{
	    $insertid1  =  $database->insert('tbl_ledger_master',$insertion1);
            
            
        } 
        
        
         $sql_gen_store_acc127 =  mysqli_query($localhost1,"update tbl_ledger_master set tlm_cloud_add='D'
          where branchid='$branchid_cloud' and tlm_id='".$request_acc_led['tlm_id']."' "); 
            
            
   }
   
   
        
    if($request_acc_led['tlm_cloud_edit']=='Y'){ 
        
          
   if($request_acc_led['tlm_capital_cb']!=''){
       
    
    $sql_stwrd  =  $database->mysqlQuery("Update tbl_ledger_master set tlm_ledger_name='".$request_acc_led['tlm_ledger_name']."',tlm_group='".$request_acc_led['tlm_group']."',"
    . " tlm_open_bal='".$request_acc_led['tlm_open_bal']."',tlm_type='".$request_acc_led['tlm_type']."',tlm_capital_cb='".$request_acc_led['tlm_capital_cb']."' "
    . " where tlm_id='".$request_acc_led['tlm_id']."' ");
    
    }else{
        
    $sql_stwrd  =  $database->mysqlQuery("Update tbl_ledger_master set tlm_ledger_name='".$request_acc_led['tlm_ledger_name']."',tlm_group='".$request_acc_led['tlm_group']."',"
    . " tlm_open_bal='".$request_acc_led['tlm_open_bal']."',tlm_type='".$request_acc_led['tlm_type']."' "
    . " where tlm_id='".$request_acc_led['tlm_id']."' ");
    
    }
          
          
    $sql_gen_store_acc127 =  mysqli_query($localhost1,"update tbl_ledger_master set tlm_cloud_edit='D'
    where branchid='$branchid_cloud' and tlm_id='".$request_acc_led['tlm_id']."' "); 
          
          
    }   
        
        
        
    } }


 
     ///////item discount offer////
    
       $sql_gen_store_acc_led =  mysqli_query($localhost1,"select * from  tbl_menu_discount
      where branchid='$branchid_cloud' and (md_cloud_added='Y' or md_cloud_edited='Y')  "); 
         $num_gen_storeacc_led  = mysqli_num_rows($sql_gen_store_acc_led);
	 if($num_gen_storeacc_led)
	 { 
	  while($request_acc_led  = mysqli_fetch_array($sql_gen_store_acc_led)) 
	  {
               
              
       ///addd///
              
      if($request_acc_led['md_cloud_added']=='Y'){ 
         
         
        $sql_kotlist22  =  $database->mysqlQuery("SELECT md_menuid from tbl_menu_discount where md_menuid='".$request_acc_led['md_menuid']."' limit 1 "); 
	$num_kotlist22 = $database->mysqlNumRows($sql_kotlist22);
	if(!$num_kotlist22){
         
         $sql_stwrd  =  $database->mysqlQuery("INSERT INTO `tbl_menu_discount`(`md_menuid`, `md_slno`, `md_discount`, `md_date_limit`, `md_time_limit`, "
         . "  `md_from_date`, `md_to_date`, `md_di_active`, `md_cs_active`, `md_ta_active`, `md_active`, "
         . " `md_from_time`, `md_to_time`, `cloud_sync`) VALUES ('".$request_acc_led['md_menuid']."','1','".$request_acc_led['md_discount']."', "
         . " '".$request_acc_led['md_date_limit']."','".$request_acc_led['md_time_limit']."','".$request_acc_led['md_from_date']."',"
         . " '".$request_acc_led['md_to_date']."','".$request_acc_led['md_di_active']."','".$request_acc_led['md_cs_active']."','".$request_acc_led['md_ta_active']."',"
         . " '".$request_acc_led['md_active']."','".$request_acc_led['md_from_time']."','".$request_acc_led['md_to_time']."', "
         . " 'Y') ");
         
         $sql_gen_store_acc127 =  mysqli_query($localhost1,"update tbl_menu_discount set md_cloud_added='D'
         where branchid='$branchid_cloud' and md_menuid='".$request_acc_led['md_menuid']."' "); 
         
        }
         
     }
    
     ////update////
     if($request_acc_led['md_cloud_edited']=='Y'){ 
         
       $sql_stwrd  =  $database->mysqlQuery("UPDATE `tbl_menu_discount` SET "
            . " `md_discount`='".$request_acc_led['md_discount']."',`md_date_limit`='".$request_acc_led['md_date_limit']."',`md_time_limit`='".$request_acc_led['md_time_limit']."',"
            . " `md_from_date`='".$request_acc_led['md_from_date']."',`md_to_date`='".$request_acc_led['md_to_date']."',`md_di_active`='".$request_acc_led['md_di_active']."',"
            . " `md_cs_active`='".$request_acc_led['md_cs_active']."',`md_ta_active`='".$request_acc_led['md_ta_active']."',`md_active`='".$request_acc_led['md_active']."',"
            . " `md_from_time`='".$request_acc_led['md_from_time']."',"
            . " `md_to_time`='".$request_acc_led['md_to_time']."'  WHERE md_menuid='".$request_acc_led['md_menuid']."' ");
         
       
         $sql_gen_store_acc127 =  mysqli_query($localhost1,"update tbl_menu_discount set md_cloud_edited='D'
         where branchid='$branchid_cloud' and md_menuid='".$request_acc_led['md_menuid']."' "); 
       
         
        }
     
        }}
        
        
        
        //////branch settings update //////
        
        
        $sql_gen_st =  mysqli_query($localhost1,"select * from  tbl_cloud_menu_detail
         where branchid='$branchid_cloud' and updation_status='Y' "); 
         $num_g  = mysqli_num_rows($sql_gen_st);
	 if($num_g)
	 { 
	  while($request_acc_led  = mysqli_fetch_array($sql_gen_st)) 
	  {
      
              
              
     ///local branchmaster settings///       
              
     $sql_all2  =  $database->mysqlQuery("update tbl_branchmaster set `be_others2`='".$request_acc_led['be_others2']."',"
    . " `be_others3`='".$request_acc_led['be_others3']."',"
    . " `be_others4`='".$request_acc_led['be_others4']."', `be_footer2`='".$request_acc_led['be_footer2']."', "
    . " `be_footer3`='".$request_acc_led['be_footer3']."', `be_phone`='".$request_acc_led['be_phone']."',"
    . " `be_printall`='".$request_acc_led['be_printall']."' ,be_dbbackuplocation='".$request_acc_led['be_dbbackuplocation']."', "
    . " be_nearest_roundoff_value='".$request_acc_led['di_roundoff']."' ,be_tableprefix_split='".$request_acc_led['di_table_sharing']."',"
    . " be_printwithdiscount='".$request_acc_led['di_discount']."',be_settle_billprint='".$request_acc_led['di_duplicate']."', "
    . " be_cs_kot_before_settle= '".$request_acc_led['cs_kot_before']."',be_cs_kot_after_settle = '".$request_acc_led['cs_kot_after']."',"
    . " be_kot_cancellation_print='".$request_acc_led['kot_cancel_print']."',  be_consolidated_print='".$request_acc_led['kot_cons_print']."' , "
    . " be_kod_dinein='".$request_acc_led['kod_di']."', be_kod_takeaway='".$request_acc_led['kod_ta']."',be_kod_screen='".$request_acc_led['kod_option']."',"
    . " be_logoinbill='".$request_acc_led['bill_logo']."',be_billprint_option='".$request_acc_led['bill_without_print']."', "
    . " be_email_on_dayclose='".$request_acc_led['dayclose_mail']."' , be_print_on_dayclose='".$request_acc_led['dayclose_print']."' , "
    . " be_reportemail_list='".$request_acc_led['dayclose_mail_list']."',be_time_zone='".$request_acc_led['adm_timezone']."', "
    . " be_floor_table_change='".$request_acc_led['adm_floot_table_change']."', be_uae_tax_concept='".$request_acc_led['adm_uae_format']."', "
    . " be_uae_tax_value='".$request_acc_led['adm_uae_value']."', "
    . " be_saudi_format='".$request_acc_led['adm_sa_format']."', be_disc_after='".$request_acc_led['adm_disc_settle']."', "
    . " be_multistore_staff='".$request_acc_led['adm_staffwise_reduction']."', "
    . " be_inventory_staff_add='".$request_acc_led['adm_invnentory']."', be_inv_sales_stock_reduce='".$request_acc_led['adm_sales_reduction']."', "
    . " be_online_order_enable='".$request_acc_led['adm_online_order']."' "); 
     
        
    //archive///
     
    $sql_lis  =  $database->mysqlQuery("update tbl_branch_settings_counter set archive_enabled='".$request_acc_led['adm_archive']."' "); 
	
        
    ///local general settings///       
       
    $sql_all222  =  $database->mysqlQuery("update tbl_generalsettings  set dynamic_invoice_name= '".$request_acc_led['dynamic_invoice_name']."'  , "
    . " kot_detail_print= '".$request_acc_led['kot_cons_customer']."',otp_item_cancel='".$request_acc_led['otp_item_cancel']."', "
    . " otp_bill_cancel='".$request_acc_led['otp_bill_cancel']."',otp_mail='".$request_acc_led['otp_mail']."' , "
    . " be_mail_emailid = '".$request_acc_led['mail_from']."', be_mail_password='".$request_acc_led['mail_psw']."',"
    . " accounts_section='".$request_acc_led['adm_accounts']."' ");
     
   
    ///ta settings////
    
    $sql_all2226  =  $database->mysqlQuery("update tbl_branch_settings_ta_hd set bsth_nearest_roundoff='".$request_acc_led['ta_roundoff']."', "
    . "  bsth_enable_hold='".$request_acc_led['ta_hold']."', "
    . "  bsth_discount_popup='".$request_acc_led['ta_discount']."', bsth_settle_billprint='".$request_acc_led['ta_duplicate']."', "
    . "  bsth_bill_print='".$request_acc_led['ta_bill_print']."', bsth_bill_before_tahd='".$request_acc_led['ta_bill_before']."', "
    . "  bsth_kot_before_tahd='".$request_acc_led['ta_kot_before']."', bsth_kot_after_tahd='".$request_acc_led['ta_kot_after']."', "
    . "  bsth_delivery_charge='".$request_acc_led['hd_charge']."'   "); 
    
    
    //cs settings/////
    
     $sql_all22236  =  $database->mysqlQuery("update tbl_branch_settings_counter set bsc_nearest_roundoff='".$request_acc_led['cs_roundoff']."', "
    . "  bsc_enable_hold='".$request_acc_led['cs_hold']."', "
    . "  bsc_discount_popup='".$request_acc_led['cs_discount']."', bsc_settle_billprint='".$request_acc_led['cs_duplicate']."', "
    . "  bsc_bill_print='".$request_acc_led['cs_bill_print']."', bsc_bill_before_settle='".$request_acc_led['cs_bill_before']."' ");
    
     
     
      ///kot ---- bill/////
     
      $sql_li =  $database->mysqlQuery("update tbl_branch_settings_printer set bp_footer='".$request_acc_led['kot_footer_msg']."', "
      . " bp_item_other_lang_kot= '".$request_acc_led['kot_other_lang']."', bp_kot_iplock='".$request_acc_led['kot_ip_lock']."',"
      . " bp_consolidate_kot_iplock= '".$request_acc_led['kot_cons_ip_lock']."',bp_kot_size= '".$request_acc_led['kot_font_size']."' , "
      . " bp_item_other_lang='".$request_acc_led['bill_lang']."', bp_bill_set_ip='".$request_acc_led['bill_iplock']."' , "
      . " bp_long_menu='".$request_acc_led['bill_long_name']."' , bp_bill_size ='".$request_acc_led['bill_font']."' "); 
	
      
      ///cloud/////
      
      $sql_listall44240  =  $database->mysqlQuery("update tbl_branch_settings_cloud set be_cloud_sync='".$request_acc_led['cloud_on']."' , "
      . " bsc_firebase_status='".$request_acc_led['cloud_notify']."' ,  bsc_cloud_branchid='".$request_acc_led['cloud_br']."' , "
      . " bsc_cloud_group_id='".$request_acc_led['cloud_gr']."'  "); 
      
      
    //update in live status///
    
    $sql_gen_st22 =  mysqli_query($localhost1,"update  tbl_cloud_menu_detail set updation_status='N' where branchid='$branchid_cloud' "); 
    
    
    
    }
    }
        
   
}

}

if(isset($_REQUEST['set'])&& ($_REQUEST['set']=='update_cloud_menu_count')){
    
    
        $a="8.8.8.8";
        exec("ping -n 1 -w 1 ".$a, $output, $result);
        if($result==0)
        {

            
        $menucount_branch=0; $staff_count=0; $disc_count=0; $be_accounts_start_date='2050-01-01'; $di_roundoff= '';$kot_cons_print='';
        $be_others2=''; $be_others3=''; $be_others4=''; $di_discount= '';  $di_table_sharing = '';  $cs_kot_before = ''; $cs_kot_after  = '';
        $be_footer2=''; $be_footer3=''; $di_duplicate = ''; $be_phone=''; $be_printall=''; $be_dbbackuplocation='';$kot_cancel_print='';
	$kod_di= ''; $kod_ta= ''; $kod_option=''; $bill_font=''; $bill_logo=''; $bill_without_print='';
        $adm_timezone=''; $adm_floot_table_change=''; $adm_uae_format= ''; $adm_uae_value= ''; $adm_sa_format ='';$adm_disc_settle ='';
        $adm_staffwise_reduction  = '';$adm_invnentory= ''; $adm_sales_reduction= ''; $adm_online_order = ''; 
        
        $sql_listall2  =  $database->mysqlQuery("SELECT * from tbl_branchmaster "); 
	$num_listall2  = $database->mysqlNumRows($sql_listall2);
	if($num_listall2){
		  while($row_listall2  = $database->mysqlFetchArray($sql_listall2)) 
		  {
                      
                      $menucount_branch=$row_listall2['be_menucount'];
                      
                      $staff_count=$row_listall2['be_staffidcount'];
                      
                      $disc_count=$row_listall2['be_discountcount'];
                      
                      $be_accounts_start_date=$row_listall2['be_accounts_start_date'];
                      
                      $be_others2	=$row_listall2['be_others2'];
		      $be_others3	=$row_listall2['be_others3'];
                      $be_others4	=$row_listall2['be_others4'];
                      
                      $be_footer2	=$row_listall2['be_footer2'];
		      $be_footer3	=$row_listall2['be_footer3'];
		      $be_phone      	=$row_listall2['be_phone'];
                      $be_printall	=$row_listall2['be_printall'];
                      $be_dbbackuplocation  = $row_listall2['be_dbbackuplocation']; 
                     
                $di_roundoff           = $row_listall2['be_nearest_roundoff_value'];
                $di_table_sharing      = $row_listall2['be_tableprefix_split'];
                $di_discount           =  $row_listall2['be_printwithdiscount'];
                $di_duplicate          =  $row_listall2['be_settle_billprint'];

              $cs_kot_before         = $row_listall2['be_cs_kot_before_settle'];
              $cs_kot_after          = $row_listall2['be_cs_kot_after_settle'];
              
              $kot_cancel_print         = $row_listall2['be_kot_cancellation_print'];
              $kot_cons_print           = $row_listall2['be_consolidated_print'];   
              
              $kod_di            = $row_listall2['be_kod_dinein'];
              $kod_ta            = $row_listall2['be_kod_takeaway'];
              $kod_option        = $row_listall2['be_kod_screen'];
                
              $bill_logo           = $row_listall2['be_logoinbill'];
              $bill_without_print  = $row_listall2['be_billprint_option'];
              
              $dayclose_mail       = $row_listall2['be_email_on_dayclose']; 
              $dayclose_print      = $row_listall2['be_print_on_dayclose'];
              $dayclose_mail_list  = $row_listall2['be_reportemail_list'];
             
             
             $adm_timezone             = $row_listall2['be_time_zone'];
             $adm_floot_table_change   = $row_listall2['be_floor_table_change'];
             $adm_uae_format           = $row_listall2['be_uae_tax_concept'];
             $adm_uae_value            = $row_listall2['be_uae_tax_value'];
             $adm_sa_format            = $row_listall2['be_saudi_format'];
             $adm_disc_settle          = $row_listall2['be_disc_after'];
             $adm_staffwise_reduction  = $row_listall2['be_multistore_staff'];
             $adm_invnentory           = $row_listall2['be_inventory_staff_add'];
             $adm_sales_reduction      = $row_listall2['be_inv_sales_stock_reduce'];
             $adm_online_order         = $row_listall2['be_online_order_enable'];
              
              
              
              } } 
              
         //archive//
              
        $adm_archive='';      
        $sql_lis  =  $database->mysqlQuery("SELECT * from tbl_branch_settings_counter "); 
	$num_lis  = $database->mysqlNumRows($sql_lis);
	if($num_lis){
		  while($row_lis  = $database->mysqlFetchArray($sql_lis)) 
		  { 
                      
                       $adm_archive  = $row_lis['archive_enabled'];
                         
                  } }      
              
              
              
              
              
    ///kot setitngs//      
              
   $kot_footer_msg=''; $kot_other_lang=''; $kot_ip_lock =''; $kot_cons_ip_lock=''; $kot_font_size=''; $bill_lang='';$bill_iplock=''; $bill_long_name='';
       $sql_li =  $database->mysqlQuery("SELECT * from tbl_branch_settings_printer "); 
       $num_li  = $database->mysqlNumRows($sql_li);
	if($num_li){
	while($row_li  = $database->mysqlFetchArray($sql_li)) 
	{ 
                      
              $kot_footer_msg           = $row_li['bp_footer'];
              $kot_other_lang           = $row_li['bp_item_other_lang_kot'];
              $kot_ip_lock              = $row_li['bp_kot_iplock'];
              $kot_cons_ip_lock         = $row_li['bp_consolidate_kot_iplock'];
              $kot_font_size            = $row_li['bp_kot_size'];
              
              $bill_lang	        = $row_li['bp_item_other_lang'];
              $bill_iplock              = $row_li['bp_bill_set_ip']; 
              $bill_long_name           = $row_li['bp_long_menu']; 
              $bill_font                = $row_li['bp_bill_size'];
        } }   
                  
                  
         ///tahd////
                  
        $hd_charge='0';   $ta_roundoff='0';  $ta_hold = ''; $ta_discount  = ''; $ta_duplicate = ''; $ta_bill_print = ''; $ta_bill_before = '';
        $ta_kot_before = ''; $ta_kot_after  = '';  
        $sql_listall202  =  $database->mysqlQuery("SELECT * from tbl_branch_settings_ta_hd "); 
	$num_listall202  = $database->mysqlNumRows($sql_listall202);
	if($num_listall202){
		  while($row_listall202  = $database->mysqlFetchArray($sql_listall202)) 
		  { 
                      
                       $ta_roundoff           = $row_listall202['bsth_nearest_roundoff'];
                       $ta_hold               = $row_listall202['bsth_enable_hold'];
                       $ta_discount           = $row_listall202['bsth_discount_popup'];
                       $ta_duplicate          = $row_listall202['bsth_settle_billprint'];
                       $ta_bill_print         = $row_listall202['bsth_bill_print']; 
                       $ta_bill_before        = $row_listall202['bsth_bill_before_tahd'];
                       $ta_kot_before         = $row_listall202['bsth_kot_before_tahd'];
                       $ta_kot_after          = $row_listall202['bsth_kot_after_tahd'];
                       $hd_charge             = $row_listall202['bsth_delivery_charge'];
                       
                  } }   
              
              
        $cs_roundoff='0';  $cs_hold = ''; $cs_discount  = ''; $cs_duplicate = ''; $cs_bill_print = '';  $cs_bill_before = '';
        
        $sql_listall2023  =  $database->mysqlQuery("SELECT * from tbl_branch_settings_counter "); 
	$num_listall2023  = $database->mysqlNumRows($sql_listall2023);
	if($num_listall2023){
		  while($row_listall2023  = $database->mysqlFetchArray($sql_listall2023)) 
		  { 
                      
                       $cs_roundoff           = $row_listall2023['bsc_nearest_roundoff'];
                       $cs_hold               = $row_listall2023['bsc_enable_hold'];
                       $cs_discount           = $row_listall2023['bsc_discount_popup'];
                       $cs_duplicate          = $row_listall2023['bsc_settle_billprint'];
                       $cs_bill_print         = $row_listall2023['bsc_bill_print']; 
                       $cs_bill_before        = $row_listall2023['bsc_bill_before_settle'];
                         
                  } }   
                  
                  
        $dynamic_invoice_name='';$kot_cons_customer= '';$otp_item_cancel='';$otp_bill_cancel=''; $otp_mail=''; $mail_from='';$mail_psw='';$adm_accounts='';    
        $sql_listall20  =  $database->mysqlQuery("SELECT * from tbl_generalsettings "); 
	$num_listall20  = $database->mysqlNumRows($sql_listall20);
	if($num_listall20){
		  while($row_listall20  = $database->mysqlFetchArray($sql_listall20)) 
		  { 
                        $dynamic_invoice_name   = $row_listall20['dynamic_invoice_name']; 
                        $kot_cons_customer      = $row_listall20['kot_detail_print'];
                        
                        $otp_item_cancel     =  $row_listall20['otp_item_cancel'];
                        $otp_bill_cancel     =  $row_listall20['otp_bill_cancel'];
                        $otp_mail            =  $row_listall20['otp_mail'];
                        
                        $mail_from           = $row_listall20['be_mail_emailid'];
                        $mail_psw            = $row_listall20['be_mail_password'];
                        $adm_accounts        = $row_listall20['accounts_section'];
                  } }   
                 
                 
                  
              $cloud_on       = '';
              $cloud_notify   = '';
              $cloud_br       = '';
              $cloud_gr       = '';
        $sql_listall240  =  $database->mysqlQuery("SELECT * from tbl_branch_settings_cloud "); 
	$num_listall240  = $database->mysqlNumRows($sql_listall240);
	if($num_listall240){
		  while($row_listall240  = $database->mysqlFetchArray($sql_listall240)) 
		  { 
                      
                        $cloud_on       = $row_listall240['be_cloud_sync'];
                        $cloud_notify   = $row_listall240['bsc_firebase_status'];
                        $cloud_br       = $row_listall240['bsc_cloud_branchid'];
                        $cloud_gr       = $row_listall240['bsc_cloud_group_id'];
                        
                  } }      
                  
      
         $menucount_branch1=0;       
         $sql_gen_store_acc_led =  mysqli_query($localhost1,"select tcd_menu_count from  tbl_cloud_menu_detail
         where branchid='$branchid_cloud' "); 
         $num_gen_storeacc_led  = mysqli_num_rows($sql_gen_store_acc_led);
	 if($num_gen_storeacc_led)
	 { 
	  while($request_acc_led5  = mysqli_fetch_array($sql_gen_store_acc_led)) 
	  {
              $menucount_branch1=$request_acc_led5['tcd_menu_count'];
              
          }
          }    
               
          if($menucount_branch>$menucount_branch1){
              
              $menucount_br=$menucount_branch;
              
          }else{
              
              $menucount_br=$menucount_branch1;
          }
          
          
        $sql_gen =  mysqli_query($localhost1,"select branchid from tbl_cloud_menu_detail where branchid='$branchid_cloud'  "); 
        $num_gen  = mysqli_num_rows($sql_gen);
	if($num_gen)
	{
                      
    $sql_gen11 =  mysqli_query($localhost1,"update tbl_cloud_menu_detail set tcd_disc_count='$disc_count', tcd_staff_count='$staff_count', "
    . "  tcd_menu_count='".$menucount_br."',tcd_accounts_start_date='$be_accounts_start_date',`be_others2`='$be_others2', `be_others3`='$be_others3',"
    . "  be_others4='$be_others4', `be_footer2`='$be_footer2',  be_dbbackuplocation='$be_dbbackuplocation'  , "
    . "  be_footer3='$be_footer3', `be_phone`='$be_phone', `be_printall`='$be_printall',dynamic_invoice_name='$dynamic_invoice_name' , "
    . "  di_roundoff='$di_roundoff', di_table_sharing='$di_table_sharing', di_discount='$di_discount', di_duplicate='$di_duplicate',"
    . "  ta_roundoff='$ta_roundoff', ta_hold='$ta_hold', "
    . "  ta_discount='$ta_discount', ta_duplicate='$ta_duplicate', ta_bill_print='$ta_bill_print', ta_bill_before='$ta_bill_before', "
    . "  ta_kot_before='$ta_kot_before', ta_kot_after='$ta_kot_after' ,hd_charge='$hd_charge' ,cs_roundoff='$cs_roundoff', cs_hold='$cs_hold', "
    . "  cs_discount='$cs_discount', cs_duplicate='$cs_duplicate', cs_bill_print='$cs_bill_print', cs_bill_before='$cs_bill_before', "
    . "  cs_kot_before='$cs_kot_before', cs_kot_after='$cs_kot_after' ,kot_footer_msg='$kot_footer_msg',kot_other_lang='$kot_other_lang', "
    . " kot_cancel_print='$kot_cancel_print',kot_cons_print='$kot_cons_print',kot_ip_lock='$kot_ip_lock',kot_cons_ip_lock='$kot_cons_ip_lock', "
    . " kot_font_size='$kot_font_size',kot_cons_customer='$kot_cons_customer',kod_di='$kod_di',kod_ta='$kod_ta',kod_option='$kod_option', "
    . " bill_logo='$bill_logo',bill_lang='$bill_lang',bill_iplock='$bill_iplock',bill_without_print='$bill_without_print', "
    . " bill_long_name='$bill_long_name',bill_font='$bill_font',otp_item_cancel='$otp_item_cancel',otp_bill_cancel='$otp_bill_cancel',otp_mail='$otp_mail', "
    . " dayclose_mail='$dayclose_mail',dayclose_print='$dayclose_print',dayclose_mail_list='$dayclose_mail_list',cloud_on='$cloud_on', "
    . " cloud_notify='$cloud_notify' ,cloud_br='$cloud_br',cloud_gr='$cloud_gr',  mail_from='$mail_from',mail_psw='$mail_psw' , adm_timezone='$adm_timezone', "
    . " adm_archive='$adm_archive',adm_floot_table_change='$adm_floot_table_change',adm_uae_format='$adm_uae_format',adm_uae_value='$adm_uae_value', "
    . " adm_sa_format='$adm_sa_format',adm_disc_settle='$adm_disc_settle',adm_accounts='$adm_accounts',adm_staffwise_reduction='$adm_staffwise_reduction', "
    . " adm_invnentory='$adm_invnentory',adm_sales_reduction='$adm_sales_reduction',adm_online_order='$adm_online_order' "  
    . " where branchid='$branchid_cloud' and updation_status='N' "); 
   	
       
         
    }else{
            
    if($branchid_cloud!='0' && $branchid_cloud!=0){
            
    $sql_gen =  mysqli_query($localhost1,"insert into  tbl_cloud_menu_detail(branchid,tcd_qr_enable,tcd_menu_count,tcd_order_count,tcd_cloudmenu_count)"
    . " values ('$branchid_cloud','N','1','0','1')  ");      
        
    }
                      
    }   
        
        
        
        
  
        ////menu double deleteion ///
      
        $sql_gen1122 =  mysqli_query($localhost1," SELECT mr_central_id ,mr_menuid  from tbl_menumaster where"
        . "  branchid= '$branchid_cloud'  and mr_delete_mode='N'
        GROUP BY mr_central_id HAVING COUNT( * ) >1 ");  
        $num_gen  = mysqli_num_rows($sql_gen1122);
	if($num_gen)
	{
          while($request_acc_led1  = mysqli_fetch_array($sql_gen1122)) 
	  {   
              
        if($request_acc_led1['mr_central_id']!='' && $request_acc_led1['mr_central_id']!='NULL' && $request_acc_led1['mr_central_id']!='0' && $request_acc_led1['mr_central_id']!=NULL){
           
                $sql_gen11242 =  mysqli_query($localhost1," Delete from tbl_menumaster where branchid= '$branchid_cloud' and "
            . " mr_central_id='".$request_acc_led1['mr_central_id']."' and mr_modifieduser!='Local' limit 1   ");
           
                
        }
            
        } }      
                
        
        
      ///delete duplicate ledger//
        
        $sql_gen11221 =  mysqli_query($localhost1," SELECT tlm_ledger_name  from tbl_ledger_master where "
         . "  branchid= '$branchid_cloud'  GROUP BY tlm_ledger_name HAVING COUNT( * ) >1 ");  
        $num_gen1  = mysqli_num_rows($sql_gen11221);
	if($num_gen1)
	{
          while($request_acc_led11  = mysqli_fetch_array($sql_gen11221)) 
	  {   
       
                $sql_gen11242 =  mysqli_query($localhost1," Delete from tbl_ledger_master where branchid= '$branchid_cloud' "
                . " and  tlm_ledger_name='".$request_acc_led11['tlm_ledger_name']."'  and cloud_sync is null   limit 1   ");
           
            
        } }      
        
        
        
     $sql_gen112212 =  mysqli_query($localhost1," SELECT v_name  from tbl_vendor_master where "
        . "  branchid= '$branchid_cloud'  GROUP BY v_name HAVING COUNT( * ) >1 ");  
        $num_gen12  = mysqli_num_rows($sql_gen112212);
	if($num_gen12)
	{
          while($request_acc_led112  = mysqli_fetch_array($sql_gen112212)) 
	  {   
       
                $sql_gen11242 =  mysqli_query($localhost1," Delete from tbl_vendor_master where branchid= '$branchid_cloud' "
               . " and v_name='".$request_acc_led112['v_name']."'  and central_created ='Y'  limit 1   ");
           
            
        } }      
        
        
        
        
        

}


}

?>