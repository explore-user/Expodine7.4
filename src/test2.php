
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
   
  
 if(isset($_REQUEST['set']) && $_REQUEST['set']=="table_view_live"){   
     
              
        $a="8.8.8.8";
        exec("ping -n 1 -w 1 ".$a, $output, $result);
        if($result==0)
        {
     
            ///table live details ///
            
            $sql_login  =  $database->mysqlQuery("SELECT * from tbl_tabledetails "); 
            $num_login   = $database->mysqlNumRows($sql_login);
            if($num_login){
            while($result_br = $database->mysqlFetchArray($sql_login)){
                  
              
                $sql_gen1 =  mysqli_query($localhost1,"select ts_status from tbl_tabledetails where ts_tableid='".$result_br['ts_tableid']."'"
                . "  and ts_tableidprefix='".$result_br['ts_tableidprefix']."'  and branchid='$branchid_cloud' "); 
                $num_gen1  = mysqli_num_rows($sql_gen1);
                 if($num_gen1)
                  {        
                  
                        $sql_gen15 =  mysqli_query($localhost1,"update tbl_tabledetails set ts_status='".$result_br['ts_status']."' , "
                        . " ts_totalamount='".$result_br['ts_totalamount']."' , "
                        . " ts_billnumber='".$result_br['ts_billnumber']."'  where ts_tableid='".$result_br['ts_tableid']."' and "
                        . " ts_tableidprefix='".$result_br['ts_tableidprefix']."' and branchid='$branchid_cloud' "); 
         
                }else{ 
             
                  $sql_gen154 =  mysqli_query($localhost1," INSERT INTO `tbl_tabledetails`(branchid,`ts_tableid`, `ts_tableidprefix`, `ts_status`, `ts_dineintime`, 
                 `ts_noofpersons`, `ts_orderno`, `ts_floorid`, `ts_orderstaff`, `ts_reservetime`, `ts_totalamount`, `ts_entrydate`, `ts_interface`,
                 `ts_billnumber`,ts_paxcount,ts_username,ts_in_access,ts_completed_order,ts_machineid)
                  values
                 ('$branchid_cloud','".$result_br['ts_tableid']."','".$result_br['ts_tableidprefix']."',
                 '".$result_br['ts_status']."' , '".$result_br['ts_dineintime']."', '".$result_br['ts_noofpersons']."',  '".$result_br['ts_orderno']."' , 
                 '".$result_br['ts_floorid']."' ,'".$result_br['ts_orderstaff']."' , '".$result_br['ts_reservetime']."',  '".$result_br['ts_totalamount']."', 
                 '".$result_br['ts_entrydate']."' ,'".$result_br['ts_interface']."','".$result_br['ts_billnumber']."' , '".$result_br['ts_paxcount']."'  ,"
                 . " '".$result_br['ts_username']."' , '".$result_br['ts_in_access']."' , '".$result_br['ts_completed_order']."'  , '".$result_br['ts_machineid']."' ) ");
      
             
         }
    
    
         
        }}
     
     
             /////tableorder///
        
            $datenow=date("Y-m-d");
        
            $sql_login6  =  $database->mysqlQuery("SELECT * from tbl_tableorder where ter_dayclosedate='$datenow' limit 250 "); 
            $num_login6   = $database->mysqlNumRows($sql_login6);
            if($num_login6){
            while($result_br = $database->mysqlFetchArray($sql_login6)){
                  
                
               
                
                $sql_gen1 =  mysqli_query($localhost1,"select ter_menuid from tbl_tableorder where ter_dayclosedate='$datenow'  and "
                . " ter_portion='".$result_br['ter_portion']."' and "
                . " ter_menuid='".$result_br['ter_menuid']."' and ter_orderno='".$result_br['ter_orderno']."'  and branchid='$branchid_cloud'"); 
                $num_gen1  = mysqli_num_rows($sql_gen1);
                 if($num_gen1)
                 {        
                  
                     
                     
                        $sql_gen15 =  mysqli_query($localhost1,"update tbl_tableorder set ter_qty='".$result_br['ter_qty']."' , "
                        . " ter_rate='".$result_br['ter_rate']."' , "
                        . " ter_total_rate='".$result_br['ter_total_rate']."',ter_total_rate='".$result_br['ter_status']."',"
                        . " ter_billnumber='".$result_br['ter_billnumber']."', where ter_orderno='".$result_br['ter_orderno']."' and "
                        . " ter_menuid='".$result_br['ter_menuid']."'  and ter_portion='".$result_br['ter_portion']."'  and branchid='$branchid_cloud' "); 
                    
                        
                }else{
                    
                    
                  $sql_gen151 =  mysqli_query($localhost1,"  INSERT INTO `tbl_tableorder`(`branchid`, `ter_orderno`, `ter_slno`, `ter_branchid`, `ter_menuid`, `ter_rate_type`, 
                 `ter_unit_type`, `ter_portion`, `ter_unit_weight`, `ter_unit_id`, `ter_base_unit_id`, `ter_base_rate`, `ter_org_rate`, `ter_discount`,
                 `ter_rate`, `ter_qty`, `ter_total_rate`, `ter_status`, `ter_preference`, `ter_preferencetext`, `ter_orderfrom`, `ter_entrydate`, 
                 `ter_entrytime`, `ter_entryuser`, `ter_esttime`, `ter_staff`, `ter_type`, `ter_kotno`, `ter_billnumber`, 
                
                  `ter_dayclosedate`, `ter_floorid`, `ter_orderno_temp`, `ter_waiter_id`,
                 `ter_combo_entry_id`, `ter_count_combo_ordering`, `ter_addon_slno`, `ter_new_rate_incl`, `ter_kot_printed`, 
                 `ter_cons_printed`, `ter_rate_before_comp`, `ter_item_disc_manual`, `ter_disc_type`, `ter_disc_before`, `ter_qr_order`)
                  values
                  
                 ('$branchid_cloud','".$result_br['ter_orderno']."','".$result_br['ter_slno']."','".$result_br['ter_branchid']."','".$result_br['ter_menuid']."',
                 '".$result_br['ter_unit_type']."' , '".$result_br['ter_portion']."', '".$result_br['ter_unit_weight']."',  '".$result_br['ter_unit_id']."' , 
                 '".$result_br['ter_base_unit_id']."' ,'".$result_br['ter_base_rate']."' , '".$result_br['ter_org_rate']."',  '".$result_br['ter_discount']."', 
                 '".$result_br['ter_rate']."' ,'".$result_br['ter_qty']."','".$result_br['ter_total_rate']."' , '".$result_br['ter_status']."'  ,"
                 . " '".$result_br['ter_preference']."' , '".$result_br['ter_preferencetext']."' , '".$result_br['ter_orderfrom']."'  , '".$result_br['ter_entrydate']."' "
                 . " '".$result_br['ter_entrytime']."' , '".$result_br['ter_entryuser']."' , '".$result_br['ter_esttime']."'  , '".$result_br['ter_staff']."' "
                 . " '".$result_br['ter_type']."' , '".$result_br['ter_kotno']."' , '".$result_br['ter_billnumber']."'  , '".$result_br['ter_dayclosedate']."'"
                 . " '".$result_br['ter_floorid']."' , '".$result_br['ter_orderno_temp']."' , '".$result_br['ter_waiter_id']."'  , '".$result_br['ter_combo_entry_id']."' "
                 . " '".$result_br['ter_count_combo_ordering']."' , '".$result_br['ter_addon_slno']."' , '".$result_br['ter_new_rate_incl']."'  , '".$result_br['ter_kot_printed']."' "
                 . " '".$result_br['ter_cons_printed']."' , '".$result_br['ter_rate_before_comp']."' , '".$result_br['ter_item_disc_manual']."'  , '".$result_br['ter_disc_type']."'"
                 . " '".$result_br['ter_disc_before']."' , '".$result_br['ter_qr_order']."'  ) ");
      
             
              }
    
    
         
        }}
        
        
 } 
     
 } 
  
  
   if(isset($_REQUEST['set']) && $_REQUEST['set']=="test_api_service_fast"){  
    
     $a="8.8.8.8";
     exec("ping -n 1 -w 1 ".$a, $output, $result);
     if($result==0)
     {  
        $response = file_get_contents('http://localhost:8021/Dropbox/expodine_service/api/cloud_sync_fast'); 
          
     }
     
  }
 
 
  
if(isset($_REQUEST['set']) && $_REQUEST['set']=="test_api_service"){  
    
     $a="8.8.8.8";
     exec("ping -n 1 -w 1 ".$a, $output, $result);
     if($result==0)
     {  
        $central='N';  
        $sql_table_nos="select be_central_kitchen from tbl_branchmaster ";
        $sql_table  =  $database->mysqlQuery($sql_table_nos); 
        $num_table  = $database->mysqlNumRows($sql_table);
        if($num_table){
	while($result_table  = $database->mysqlFetchArray($sql_table)) 
	{  
                       
           $central =$result_table['be_central_kitchen'];  
        }}
         
     $sql_login_n_all  =  $database->mysqlQuery("update tbl_br_cloud_tables set status='N' "
     . " where (table_name='tbl_br_cloud_tables' or table_name='tbl_version'  or table_name='tbl_version_log') ");     
         
     if($central=='N'){
         
     $table='';
     
     $sql_login  =  $database->mysqlQuery("SELECT table_name FROM tbl_br_cloud_tables where table_name!='tbl_br_cloud_tables' "
     . " and table_name!='tbl_version'  and table_name!='tbl_version_log' "); 
     $num_login   = $database->mysqlNumRows($sql_login);
            if($num_login){
            while($result_br = $database->mysqlFetchArray($sql_login)){
                   
            $table=$result_br['table_name'];
                    
            $sql_login_check  =  $database->mysqlQuery("SELECT * FROM  $table where cloud_sync='N' limit 1"); 
            $num_login_check   = $database->mysqlNumRows($sql_login_check);
            if($num_login_check){
                
                     $sql_login_y  =  $database->mysqlQuery("update tbl_br_cloud_tables set status='Y' where table_name='$table' "); 
                   
            }else{
                 
                   $sql_login_n  =  $database->mysqlQuery("update tbl_br_cloud_tables set status='N' where table_name='$table' ");   
                  
                   ///////////////live local check///////////////
                  
                   $local_count=0;   $live_count=0;       
                    
                   $sql_sms_show1  =  $database->mysqlQuery("select count(*) as local_count from $table "); 
                   $num_sms_show1  = $database->mysqlNumRows($sql_sms_show1);
                    if($num_sms_show1){
                        while($result_sms_show13  = $database->mysqlFetchArray($sql_sms_show1)) 
                        {
                              $local_count= $result_sms_show13['local_count']; 
                          
                        } }                   
                              
                  $sql_gen1 =  mysqli_query($localhost1,"select count(*) as live_count from $table where branchid='$branchid_cloud'   "); 
                  $num_gen1  = mysqli_num_rows($sql_gen1);
		  if($num_gen1)
		  {
		     while($result_cat_s_tc1  = mysqli_fetch_array($sql_gen1)) 
		     {
                              $live_count= $result_cat_s_tc1['live_count']; 
                            
                  } }
                  
                  if($local_count!=$live_count){
                        
                        ///// resync data in table/////////
                      
                        $sql_login_n333  =  $database->mysqlQuery("update tbl_br_cloud_tables set status='Y' where table_name='$table'  ");   
                      
                        $sql_gen1333 =  $database->mysqlQuery("update $table set cloud_sync='N' where cloud_sync='Y' ");  
                        
                 }
                 
            }
                   
      } }
      
      
     }   
     
    $response = file_get_contents('http://localhost:8021/Dropbox/expodine_service/api/cloud_sync');
      
}

}    

if(isset($_REQUEST['set']) && $_REQUEST['set']=="test_api_archive"){   
         
   $response = file_get_contents('http://localhost:8021/Dropbox/expodine_service/api/expodine_db_archive/Y');
    
}    

if(isset($_REQUEST['set']) && $_REQUEST['set']=="relogin_session"){   
         
        session_start([
          'cookie_lifetime' => 604800,
        ]);

	$bch="";
	$floorstaff='';
     
            $sql_login  =  $database->mysqlQuery("select ld.ls_username,ls_staffid,ls_login_status from tbl_logindetails ld
            left join tbl_staffmaster sm on sm.ser_staffid = ld.ls_staffid
            where ld.ls_status = 'Y' and sm.ser_authorisation_code = '".$_REQUEST['pin']."' and sm.ser_employeestatus = 'Active'"); 
            $num_login   = $database->mysqlNumRows($sql_login);
                           
   $loginpin=$_REQUEST['pin'];
   $datenow=date("Y-m-d H:i:s");
   $machineip= getHostByName(getHostName());
  
    $machine_old_ip='';
    $sql_login12  =  $database->mysqlQuery("select ld.ls_username,ld.ls_staffid,ld.ls_login_status,ld.ls_restrict_login,
            ld.ls_login_machineip from tbl_logindetails ld
            left join tbl_staffmaster sm on sm.ser_staffid = ld.ls_staffid
            where ld.ls_status = 'Y' and sm.ser_authorisation_code = '".$_REQUEST['pin']."'"); 
            $num_login12   = $database->mysqlNumRows($sql_login12);
            if($num_login12){
                while($result_lg12 = $database->mysqlFetchArray($sql_login12)){
                    
                   $lgstatus=$result_lg12['ls_login_status'];
                   $restricted_login=$result_lg12['ls_restrict_login'];
                   $machine_old_ip=$result_lg12['ls_login_machineip'];
                     
                }
            }

	if($num_login && $_REQUEST['pin']!="")
	{   
            
            $machineip= getHostByName(getHostName());
        
            if($lgstatus!='Y' || $restricted_login=="N" ||($lgstatus=='Y' && ($machine_old_ip==$machineip) ) ){
                
                
             $query321=$database->mysqlQuery(" update  tbl_logindetails l, tbl_staffmaster s  set l.ls_login_status='Y' , "
             . " l.ls_login_time='$datenow',l.ls_logout_time=null,l.ls_login_machineip='$machineip' where l.ls_staffid=s.ser_staffid and "
             . "  s.ser_authorisation_code ='".$_REQUEST['pin']."' ");  
            
            
            if($_SESSION['login_mode']=='Normal'){
                
                $strn = " tbl_logindetails.ls_username = '".$username."' AND  tbl_staffmaster.ser_employeestatus='Active'";
                
            }else{
                
                   $strn = " tbl_staffmaster.ser_authorisation_code = '".$_REQUEST['pin']."'";
            }
            
            
	//check designation  of the logged person
            
	$sql_login2  =  $database->mysqlQuery("Select tbl_logindetails.ls_username,tbl_designationmaster.dr_designationname,"
                . " tbl_staffmaster.ser_branchofficeid,tbl_staffmaster.ser_defaultfloor,tbl_designationmaster.dr_designationid From tbl_logindetails"
                . " Inner Join tbl_staffmaster On tbl_staffmaster.ser_staffid = tbl_logindetails.ls_staffid Inner Join tbl_designationmaster On"
                . " tbl_staffmaster.ser_designation = tbl_designationmaster.dr_designationid where $strn"); 
		$num_login2   = $database->mysqlNumRows($sql_login2);
		if($num_login2)
		{
			while($result_login2  = $database->mysqlFetchArray($sql_login2)) 
			{
                            
			$_SESSION['designtnname']=$result_login2['dr_designationname'];
			$_SESSION['designtnfinalid']=$result_login2['dr_designationid'];
			$bch= $result_login2['ser_branchofficeid'];
			$floorstaff= $result_login2['ser_defaultfloor'];
			$_SESSION['floorstaff']=$result_login2['ser_defaultfloor'];
                        $_SESSION['expodine_id']=$result_login2['ls_username'];
                        
			}
		}	
	             while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
                                $_SESSION['loginempid_id']=$result_login['ls_staffid'];
				$_SESSION['expodine_id']=$result_login['ls_username'];
				$_SESSION['main_language_login']=$_REQUEST['hidlanguage'];
				
				if($result_login['ls_branchid']!="")
				{
				        $_SESSION['type']="branch";
				}
				else
				{
                                    
					$_SESSION['type']="headoffice";
				}
                                
                                
                                
					$_SESSION['branchofid']=$bch;
					$_SESSION['headofid']=$result_login['ls_headofficeid'];
                                        
					if($result_login['ls_applogin']=="Y")
						{
							$_SESSION['applogin']="Yes";
						}else 
						{
							$_SESSION['applogin']="No";
						}
						
						//default permission change in master_settings.php
						$sql_table_nos="select * from tbl_branchmaster ";
						$sql_table  =  $database->mysqlQuery($sql_table_nos); 
						$num_table  = $database->mysqlNumRows($sql_table);
						if($num_table){
							while($result_table  = $database->mysqlFetchArray($sql_table)) 
								{
									$_SESSION['s_listimage']=$result_table['be_listimage'];
									$_SESSION['s_kotstatus']=$result_table['be_kotstatuschange'];
									$_SESSION['s_printst']=$result_table['be_printall'];
									$_SESSION['s_attenst']=$result_table['be_attendance'];
									$_SESSION['s_persct']=$result_table['be_personscount'];
									$_SESSION['s_portinct']=$result_table['be_portiondefault'];
									$_SESSION['s_portnuse']=$result_table['be_userportion'];
									$_SESSION['s_invtorylink']=$result_table['be_inventorylink'];
									$_SESSION['s_mainlink']=$result_table['be_mainlink'];
									$_SESSION['s_userpermissionadd']=$result_table['be_userpermissionadd'];
									$_SESSION['s_currency']="Rs";
									$_SESSION['s_ta_kotbypass']=$result_table['be_ta_kotbypass'];
									$_SESSION['s_ta_combkotbill_print']=$result_table['be_ta_combkotbill_print'];
									$_SESSION['s_ta_directclosefirst']=$result_table['be_directclosefirst'];
									$_SESSION['s_portionname']=$result_table['be_portionname'];
									$_SESSION['s_portion_autoday_update']=$result_table['be_portion_autoday_update'];
									
								}}
								
								$sql_desg_nos="select max(dc_id) as id from tbl_dayclose";
								$sql_desg  =  $database->mysqlQuery($sql_desg_nos); 
								$num_desg  = $database->mysqlNumRows($sql_desg);
								if($num_desg)
								{
									while($result_desg  = $database->mysqlFetchArray($sql_desg)) 
										{
											$dt=date("Y-m-d");
											$sql_desg_nos1="select * from tbl_dayclose where dc_id='".$result_desg['id']."'  and dc_timeclose IS NULL";//and dc_day ='$dt'
											$sql_desg1  =  $database->mysqlQuery($sql_desg_nos1);
											$num_desg1  = $database->mysqlNumRows($sql_desg1);
											if($num_desg1){
											while($result_desg1  = $database->mysqlFetchArray($sql_desg1)) 
												{
                                                                                            
												$_SESSION['date']		=$result_desg1['dc_day'];
												$_SESSION['dateopen']	=$result_desg1['dc_dateopen'];
												$_SESSION['timeopen']	=$result_desg1['dc_timeopen'];
												$_SESSION['dateclose']	=$result_desg1['dc_dateclose'];
												$_SESSION['timeclose']	=$result_desg1['dc_timeclose'];
                                                                                                
												}
											}else
											{
												unset($_SESSION['date']);
												unset($_SESSION['dateopen']);
												unset($_SESSION['timeopen']);
												unset($_SESSION['dateclose']);
												unset($_SESSION['timeclose']);
											}
										}
								}
						$tkord="";
						$sql_desg_nos="select * from tbl_designationmaster where dr_takeorder='Y' ";
						$sql_desg  =  $database->mysqlQuery($sql_desg_nos); 
						$num_desg  = $database->mysqlNumRows($sql_desg);
						if($num_desg)
						{$i=0;
							while($result_desg  = $database->mysqlFetchArray($sql_desg)) 
								{
									if($i==0)
									$tkord="'".$result_desg['dr_designationid']."'";
									else
									$tkord=$tkord.","."'".$result_desg['dr_designationid']."'";
									$i++;
								}
						}
						$_SESSION['desgn_takordr'] =$tkord;			
						$sql_desg_nos="select * from tbl_designationmaster where dr_designationname='Steward' ";
						$sql_desg  =  $database->mysqlQuery($sql_desg_nos); 
						$num_desg  = $database->mysqlNumRows($sql_desg);
						if($num_desg){
							while($result_desg  = $database->mysqlFetchArray($sql_desg)) 
								{
									$_SESSION['desgn_steward']=$result_desg['dr_designationid'];
								}}
                                                                
						$sql_desg_nos="select * from tbl_designationmaster where dr_designationname='Delivery Boy' ";
						$sql_desg  =  $database->mysqlQuery($sql_desg_nos); 
						$num_desg  = $database->mysqlNumRows($sql_desg);
						if($num_desg){
							while($result_desg  = $database->mysqlFetchArray($sql_desg)) 
								{
									$_SESSION['desgn_deliveryboy']=$result_desg['dr_designationid'];
								}}
                                                                
						//corporate checking		
						$sql_dsc_nos="select * from tbl_discountmaster where ds_discountname='Corporate' ";
						$sql_dsc  =  $database->mysqlQuery($sql_dsc_nos); 
						$num_dsc  = $database->mysqlNumRows($sql_dsc);
						if($num_dsc){
							while($result_dsc  = $database->mysqlFetchArray($sql_dsc)) 
								{
									$_SESSION['corporateval']=$result_dsc['ds_discountid'];
								}}
                                                                
							//user persmission check	
							$_SESSION['menuarray']=array();
 							$_SESSION['menumodarray']=array();
							$_SESSION['menusubarray']=array();
							$_SESSION['menufullarray']=array();
						 $sql_login  =  $database->mysqlQuery("Select tbl_modulemaster.mer_modulename, tbl_modulesubmaster.mser_subname, tbl_modulemaster.mer_modulelink, tbl_modulesubmaster.mser_submodulelink, tbl_usermodules.um_access,  tbl_usermodules.um_username From tbl_usermodules Inner Join tbl_modulesubmaster On tbl_modulesubmaster.mser_submoduleid = tbl_usermodules.um_submoduleid Inner Join tbl_modulemaster On tbl_modulemaster.mer_moduleid = tbl_usermodules.um_moduleid Where tbl_usermodules.um_username = '".$_SESSION['expodine_id']."' order by   tbl_modulemaster.mer_modulename"); 
						 $num_login   = $database->mysqlNumRows($sql_login);
							if($num_login)
							{
								while($result_login  = $database->mysqlFetchArray($sql_login)) 
									{
										 $_SESSION['menuarray'][]=$result_login['mer_modulelink'];
										 $_SESSION['menumodarray'][]=$result_login['mer_modulename'];
										 $_SESSION['menusubarray'][]=$result_login['mser_submodulelink'];
										 if($result_login['mser_submodulelink']!="")
										 $_SESSION['menufullarray'][]=$result_login['mser_submodulelink'];
										 if($result_login['mer_modulelink']!="")
										 $_SESSION['menufullarray'][]=$result_login['mer_modulelink'];
									}
							}
                                                        
		  header('location:index.php');
					
		}
	              
          } 
                         
        }else{
            
            echo 'PLEASE LOGIN';
            
            header('location:dont_delete.php?relogin_ses=relogin_ses1');
       }

}

?>