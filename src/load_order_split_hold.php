<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
include("database.class.php");
$database	= new Database(); 
include('includes/master_settings.php');
mysqli_set_charset($con,"utf8");

require_once("printer_functions.php");
$printpage=new PrinterCommonSettings();

if(isset($_REQUEST['set_split'])&& $_REQUEST['set_split']=="split_bill"){
    $inv= 'TEMP*' . rand(5, 999999);
   
    $sql_split_insert=$database->mysqlQuery("INSERT INTO tbl_tablebillmaster(bm_billno, bm_branchid, bm_tableno, bm_orderno,bm_steward) VALUES ('".$inv."','1','".$_REQUEST['split_tableno']."','".$_REQUEST['split_orderno']."','".$_REQUEST['steward']."')");  
  
           echo $inv;
 
}



if(isset($_REQUEST['set_split_json'])&& $_REQUEST['set_split_json']=="split_bill_json"){
    
    $billno=$_REQUEST['bill_no_split'];
    $billcount_all=$_REQUEST['bill_count'];      
    $menu_all=  json_decode($_REQUEST['split_all_json_detail']);
   
    $combo_all=json_decode($_REQUEST['split_all_json_detail_combo']);
    
    $count_mainmenu=count($menu_all);
   
    $count_combomenu=count($combo_all);
     
    if($count_mainmenu==0 &&  $count_combomenu==0){
        
        $sql_split_delete=$database->mysqlQuery("Delete from tbl_tablebillmaster where bm_billno='".$billno."'");
    }
    
    $time=date('h:i:s');
                                 
                                 
    $tt=rand(4, 9999);
    $ktt='KOT-'.rand(4, 9999);
    $new_ord_spl=$_REQUEST['split_orderno'].'-'.$tt;
    
    for($c=0;$c<count($combo_all);$c++){
        
                $menuid_combo=$combo_all[$c]->menu_id_cb;
                $menuid_combo_pack=$combo_all[$c]->menu_id_pack_cb;
                $menuid_qty_cb=$combo_all[$c]->menu_qty_cb;
                $menuid_rate_cb=$combo_all[$c]->menu_rate_cb;
                $menuid_order_cb=$combo_all[$c]->menu_order_cb;
                $menuid_slno_cb=$combo_all[$c]->menu_slno_cb;
                $menuid_kot_cb=$combo_all[$c]->menu_kot_combo;
                $order_cb_slno=$combo_all[$c]->menu_cbslno_cb;
                
                $menuid_combo_new=$combo_all[$c]->menuid_combo_new;
                
               
                
                $sql_main  =  $database->mysqlQuery(" SELECT * from tbl_combo_bill_details where cbd_billno='".$billno."' and cbd_combo_id='".$menuid_combo."' and cbd_combo_pack_id='".$menuid_combo_pack."' ");
				
                                $num_main = $database->mysqlNumRows($sql_main);
				if($num_main){ 
                                $result_main  = $database->mysqlFetchArray($sql_main);
                                $menu_order_slno_for_addon=$result_main['bd_billslno'];
                                    
                $sql_split_update=$database->mysqlQuery("update  tbl_combo_bill_details  set cbd_combo_qty='".$menuid_qty_cb."' ,cbd_combo_total_rate=(cbd_combo_pack_rate*$menuid_qty_cb)where  cbd_billno='".$billno."' and cbd_combo_id='".$menuid_combo."' and cbd_combo_pack_id='".$menuid_combo_pack."' ");
                                   
                                }else{
                $sql_split_insert=$database->mysqlQuery("INSERT INTO tbl_combo_bill_details(cbd_billno,cbd_billslno,cbd_count_combo_ordering,cbd_combo_id,cbd_combo_pack_id,cbd_combo_qty,cbd_combo_pack_rate,cbd_combo_total_rate,cbd_menu_id,cbd_menu_qty,cbd_entry_date,cbd_dayclosedate,cloud_sync)
                    Select '".$billno."',cod_slno,cod_count_combo_ordering,cod_combo_id,cod_combo_pack_id,'".$menuid_qty_cb."',cod_combo_pack_rate,(cod_combo_pack_rate*$menuid_qty_cb),cod_menu_id,cod_menu_qty,cod_entry_date,cod_dayclosedate,'N' from tbl_combo_ordering_details where cod_orderno='".$menuid_order_cb."' and cod_count_combo_ordering='".$order_cb_slno."' and cod_kot_no='".$menuid_kot_cb."'");
                
                                }
                                $rate_cb=0;
             $sql_main1  =  $database->mysqlQuery(" SELECT cbd_combo_total_rate from tbl_combo_bill_details where cbd_billno='".$billno."' and cbd_count_combo_ordering='".$order_cb_slno."' limit 1 ");
				
                                $num_main1 = $database->mysqlNumRows($sql_main1);
				if($num_main1){ 
                            while($result_main1  = $database->mysqlFetchArray($sql_main1)){
            $rate_cb=$result_main1['cbd_combo_total_rate'];
                              }
                                }
           $sql_split_update1=$database->mysqlQuery("update tbl_tablebillmaster set bm_subtotal='".$rate_cb."' WHERE bm_billno='".$billno."' ");    
           
      $sql_split_update1=$database->mysqlQuery("update tbl_combo_ordering_details set cod_combo_qty=(cod_combo_qty-'".$menuid_qty_cb."'),cod_combo_total_rate=(cod_combo_qty*cod_combo_pack_rate) WHERE cod_orderno='".$menuid_order_cb."' and cod_combo_id='".$menuid_combo."' and cod_combo_pack_id='".$menuid_combo_pack."' and cod_menu_id='".$menuid_combo_new."' ");         
      
      
    $sql_split_update_to=$database->mysqlQuery("update tbl_tableorder set ter_qty=(ter_qty-'".$menuid_qty_cb."') ,ter_total_rate=(ter_rate*ter_qty) where   ter_orderno='".$menuid_order_cb."' and ter_menuid='".$menuid_combo_new."' and ter_count_combo_ordering='".$order_cb_slno."' ");  
      
      
     //echo "update tbl_combo_ordering_details set cod_combo_qty=(cod_combo_qty-'".$menuid_qty_cb."'),cod_combo_total_rate=(cod_combo_qty*cod_combo_pack_rate) WHERE cod_orderno='".$menuid_order_cb."' and cod_combo_id='".$menuid_combo."' and cod_combo_pack_id='".$menuid_combo_pack."' and cod_menu_id='".$menuid_combo_new."' ";
       $sql_split_update_to_table_order=$database->mysqlQuery("INSERT INTO `tbl_combo_ordering_details`( `cod_count_combo_ordering`, "
               . " `cod_orderno`, `cod_combo_id`, `cod_combo_pack_id`, `cod_slno`, `cod_combo_qty`, `cod_combo_pack_rate`, "
               . "`cod_combo_total_rate`, `cod_menu_id`, `cod_menu_qty`, `cod_combo_preference`, `cod_entry_date`, "
               . "`cod_dayclosedate`, `cod_order_status`, `cloud_sync`, `cod_kot_no`, `cod_cancel`) SELECT  "
               . "`cod_count_combo_ordering`, '".$new_ord_spl."', `cod_combo_id`, `cod_combo_pack_id`, `cod_slno`, "
               . " '".$menuid_qty_cb."', `cod_combo_pack_rate`, (cod_combo_pack_rate*'".$menuid_qty_cb."'), `cod_menu_id`, `cod_menu_qty`,"
               . " `cod_combo_preference`, `cod_entry_date`, `cod_dayclosedate`, `cod_order_status`, `cloud_sync`,"
               . " '".$ktt."' , `cod_cancel` FROM `tbl_combo_ordering_details` WHERE cod_orderno='".$menuid_order_cb."' and cod_combo_id='".$menuid_combo."' and cod_combo_pack_id='".$menuid_combo_pack."' and cod_menu_id='".$menuid_combo_new."' ");
    
       
       
       
       $sql_split_update_to_table_order=$database->mysqlQuery("INSERT INTO `tbl_tableorder`(`ter_orderno`, `ter_slno`, `ter_branchid`, `ter_menuid`,"
                         . " `ter_rate_type`, `ter_unit_type`, `ter_portion`, `ter_unit_weight`, `ter_unit_id`, `ter_base_unit_id`, `ter_base_rate`, `ter_org_rate`,"
                         . " `ter_discount`, `ter_rate`, `ter_qty`, `ter_total_rate`, `ter_status`, `ter_preference`, `ter_preferencetext`, `ter_orderfrom`, `ter_entrydate`,"
                         . " `ter_entrytime`, `ter_entryuser`, `ter_esttime`, `ter_staff`, `ter_type`, `ter_kotno`, `ter_billnumber`, `ter_feedbackrating`, `ter_feedbackremarks`, "
                         . "`ter_feedbackenter`, `ter_dayclosedate`, `ter_floorid`, `ter_cancel`, `ter_cancelledby_careof`, `ter_cancelledreason`, `ter_cancelledsecretkey`, `ter_cancelledlogin`,"
                         . " `ter_orderno_temp`, `ter_waiter_id`, `ter_kot_canceltime`, `cloud_sync`, `ter_combo_entry_id`, `ter_count_combo_ordering`, `ter_addon_slno`) SELECT '".$new_ord_spl."',"
                         . " `ter_slno`, `ter_branchid`, `ter_menuid`, `ter_rate_type`, `ter_unit_type`, `ter_portion`, `ter_unit_weight`, `ter_unit_id`, `ter_base_unit_id`, `ter_base_rate`,"
                         . " `ter_org_rate`, `ter_discount`, `ter_rate`, '".$menuid_qty_cb."', `ter_total_rate` , 'Billed', `ter_preference`, `ter_preferencetext`, `ter_orderfrom`, "
                         . "`ter_entrydate`, `ter_entrytime`, `ter_entryuser`, `ter_esttime`, `ter_staff`, `ter_type`, '".$ktt."', `ter_billnumber`, `ter_feedbackrating`, "
                         . "`ter_feedbackremarks`, `ter_feedbackenter`, `ter_dayclosedate`, `ter_floorid`, `ter_cancel`, `ter_cancelledby_careof`, `ter_cancelledreason`, "
                         . "`ter_cancelledsecretkey`, `ter_cancelledlogin`, `ter_orderno_temp`, `ter_waiter_id`, `ter_kot_canceltime`, `cloud_sync`, `ter_combo_entry_id`, "
                         . "`ter_count_combo_ordering`, `ter_addon_slno` FROM `tbl_tableorder` WHERE ter_orderno='".$menuid_order_cb."' and ter_menuid='".$menuid_combo_new."' and ter_count_combo_ordering='".$order_cb_slno."' ");            
       
       
       
                            }
    
    
  for($i=0;$i<count($menu_all);$i++){
      
        
                $menuid_main=$menu_all[$i]->menu_id;
                $menuid_qty=$menu_all[$i]->menu_qty;
                $menuid_rate=$menu_all[$i]->menu_rate;
                $menuid_order=$menu_all[$i]->menu_order;
                $menuid_slno=$menu_all[$i]->menu_slno;
                $menuid_kot=$menu_all[$i]->menu_kot;
                
          $sql_main  =  $database->mysqlQuery(" SELECT * from tbl_tablebilldetails where bd_billno='".$billno."' and bd_menuid='".$menuid_main."'");
				
                                $num_main = $database->mysqlNumRows($sql_main);
				if($num_main){ 
                                $result_main  = $database->mysqlFetchArray($sql_main);
                                $menu_order_slno_for_addon=$result_main['bd_billslno'];
                                    
                                    $sql_split_update=$database->mysqlQuery("update  tbl_tablebilldetails  set bd_qty=(bd_qty+'".$menuid_qty."') ,bd_amount=(bd_amount+(bd_rate*$menuid_qty)) where  bd_billno='".$billno."' and bd_menuid='".$menuid_main."'");
                                   
                                }else{
                                    
                $sql_split_insert=$database->mysqlQuery("INSERT INTO tbl_tablebilldetails(bd_billno,bd_billslno,bd_menuid,bd_rate_type,bd_unit_type,bd_portion,bd_unit_weight,bd_unit_id,bd_base_unit_id,bd_base_rate,bd_org_rate,bd_rate,bd_qty,bd_amount,bd_type)
                Select '".$billno."','0','".$menuid_main."',ter_rate_type,ter_unit_type,ter_portion,ter_unit_weight,ter_unit_id,ter_base_unit_id,ter_base_rate,ter_org_rate,ter_rate,'".$menuid_qty."',(ter_rate*$menuid_qty),ter_type from tbl_tableorder where ter_orderno='".$menuid_order."' and ter_slno='".$menuid_slno."' and ter_kotno='".$menuid_kot."'");
               
                                }
               
    
    }
    
                  $discount_of_or='';
		  $discount_unit_or='';
		  $discount_or='';
		  $discountid_or='';
		  if(isset($_REQUEST['type']))
		  {
			  if($_REQUEST['type']=="drop")
			  {
				  $discount_of_or=0;
				  $discount_unit_or=0;
				  $discount_or="Y";
				  $discountid_or=$_REQUEST['dis_drop'];
			  }else if($_REQUEST['type']=="text")
			  {
				 $discount_of_or=$_REQUEST['dis_text'];
				  $discount_unit_or=$_REQUEST['disctype'];
				  $discount_or="Y";
				  $discountid_or=0; 
			  }else
			  {
				  $discount_of_or=0;
				  $discount_unit_or=0;
				  $discount_or="N";
				  $discountid_or=0; 
			  }
		  }else
		  {
			  $discount_of_or=0;
			  $discount_unit_or=0;
			  $discount_or="N";
			  $discountid_or=0; 
		  }
    
                 
                    if($_REQUEST['redeemamount']!=""){
                        $redeem_amt=$_REQUEST['redeemamount'];
                    }else{
                        $redeem_amt=0;
                    }
                  
                  
                  $database->mysqlQuery("SET @temp_billno = " ."'". $billno."'");
                  $database->mysqlQuery("SET @floor_id = " . "'".$_REQUEST['floor']."'");
                
		  $database->mysqlQuery("SET @discount_of = " . "'".$discount_of_or."'");
		  $database->mysqlQuery("SET @discount_unit = " . "'".$discount_unit_or."'");
		  $database->mysqlQuery("SET @discount = " . "'".$discount_or."'");
		  $database->mysqlQuery("SET @discountid = " . "'".$discountid_or."'");
		  $database->mysqlQuery("SET @redeem     = " . "'" .$redeem_amt . "'");
       //echo $billno."-".$_REQUEST['floor']."-".$discount_of_or."-".$discount_unit_or."-".$discount_or."-".$discountid_or;
       $sq=$database->mysqlQuery("CALL proc_order_split_generate(@temp_billno,@floor_id,@discount_of,@discount_unit,@discount,@discountid,@redeem,@billnumber,@Message)") or $database->throw_ex(mysqli_error($database->DatabaseLink));
                                                                          
                       $rs = $database->mysqlQuery( 'SELECT @billnumber AS billnumber,@Message as Message' );
                       while($row = mysqli_fetch_array($rs))
                        {
                          $s= $row['billnumber'];
                          $returnmsg=$row['Message'];
                          echo $returnmsg;
                        }

      $sql_kotlist_1  =  $database->mysqlQuery("SELECT bm_orderno,bm_finaltotal from  tbl_tablebillmaster where bm_billno='".$s."' "); 
				
                                $num_kotlist_1  = $database->mysqlNumRows($sql_kotlist_1);
				if($num_kotlist_1){
				while($result_kotlist_1  = $database->mysqlFetchArray($sql_kotlist_1)) 
				{  
                                   
                                    $orderno1=$result_kotlist_1['bm_orderno'];
                                    $tot_final=$result_kotlist_1['bm_finaltotal'];
                                }
                                }
                               
  $sql_split_update_to=$database->mysqlQuery("Insert into tbl_tablebill_split (tbs_orderno,tbs_newbillno,tbs_billtotal,tbs_billstatus) VALUES ('".$orderno1."','".$s."','".$tot_final."','Billed')");                 
                                
 
 
                                $orderno=explode(',',$orderno1);       
                                $table_name_list='';
                                $orderno11=array();
                                $orderno11=array_unique($orderno);
                               
                                foreach($orderno11 as $key => $value){
                                  $i++;
                                 if($value!=""){
                                     
                                 $sql_split_update_to=$database->mysqlQuery("update tbl_tabledetails set  ts_status='Served',ts_billnumber = '' where ts_orderno='".$value."'  ");
                                 
                                 $sql_split_update_to=$database->mysqlQuery("update tbl_tableorder set  ter_status='Served' where ter_orderno='".$value."'  ");
                                    
                                 $sql_split_update_to=$database->mysqlQuery("update  tbl_tablebillmaster set bm_bill_is_split='Y',bm_bill_no_of_split='".$billcount_all."' where bm_billno='".$s."'");
                                
                                 
                                 ///new changes////
                                 
                                $new_ord_spl=$value.'-'.$tt;
                             // echo   $new_ord_spl;
                                 
                for($i=0;$i<count($menu_all);$i++){
      
        
                $menuid_main=$menu_all[$i]->menu_id;
                $menuid_qty=$menu_all[$i]->menu_qty;
                $menuid_rate=$menu_all[$i]->menu_rate;
                $menuid_order=$menu_all[$i]->menu_order;
                $menuid_slno=$menu_all[$i]->menu_slno;
                $menuid_kot=$menu_all[$i]->menu_kot;
                
                $sql_split_update_to=$database->mysqlQuery("update tbl_tableorder set ter_qty=(ter_qty-'".$menuid_qty."') ,ter_total_rate=(ter_rate*ter_qty) where ter_menuid='".$menuid_main."' and   ter_orderno='".$value."'  ");
                               
                        
                  $sql_split_update_to_table_order=$database->mysqlQuery("INSERT INTO `tbl_tableorder`(`ter_orderno`, `ter_slno`, `ter_branchid`, `ter_menuid`,"
                         . " `ter_rate_type`, `ter_unit_type`, `ter_portion`, `ter_unit_weight`, `ter_unit_id`, `ter_base_unit_id`, `ter_base_rate`, `ter_org_rate`,"
                         . " `ter_discount`, `ter_rate`, `ter_qty`, `ter_total_rate`, `ter_status`, `ter_preference`, `ter_preferencetext`, `ter_orderfrom`, `ter_entrydate`,"
                         . " `ter_entrytime`, `ter_entryuser`, `ter_esttime`, `ter_staff`, `ter_type`, `ter_kotno`, `ter_billnumber`, `ter_feedbackrating`, `ter_feedbackremarks`, "
                         . "`ter_feedbackenter`, `ter_dayclosedate`, `ter_floorid`, `ter_cancel`, `ter_cancelledby_careof`, `ter_cancelledreason`, `ter_cancelledsecretkey`, `ter_cancelledlogin`,"
                         . " `ter_orderno_temp`, `ter_waiter_id`, `ter_kot_canceltime`, `cloud_sync`, `ter_combo_entry_id`, `ter_count_combo_ordering`, `ter_addon_slno`) SELECT '".$new_ord_spl."',"
                         . " `ter_slno`, `ter_branchid`, `ter_menuid`, `ter_rate_type`, `ter_unit_type`, `ter_portion`, `ter_unit_weight`, `ter_unit_id`, `ter_base_unit_id`, `ter_base_rate`,"
                         . " `ter_org_rate`, `ter_discount`, `ter_rate`, '".$menuid_qty."', (ter_rate*'".$menuid_qty."') , 'Billed', `ter_preference`, `ter_preferencetext`, `ter_orderfrom`, "
                         . "`ter_entrydate`, `ter_entrytime`, `ter_entryuser`, `ter_esttime`, `ter_staff`, `ter_type`, '".$ktt."', `ter_billnumber`, `ter_feedbackrating`, "
                         . "`ter_feedbackremarks`, `ter_feedbackenter`, `ter_dayclosedate`, `ter_floorid`, `ter_cancel`, `ter_cancelledby_careof`, `ter_cancelledreason`, "
                         . "`ter_cancelledsecretkey`, `ter_cancelledlogin`, `ter_orderno_temp`, `ter_waiter_id`, `ter_kot_canceltime`, `cloud_sync`, `ter_combo_entry_id`, "
                         . "`ter_count_combo_ordering`, `ter_addon_slno` FROM `tbl_tableorder` WHERE ter_orderno='".$value."' and ter_menuid='".$menuid_main."'  ");                               
                                 
                }
                            
                
                
                              
                            if(count($menu_all)>0 || count($combo_all)>0){  
                                
                            $sql_kotlist_1  =  $database->mysqlQuery("SELECT * from  tbl_tabledetails where ts_orderno='".$value."'  "); 
				
                                $num_kotlist_1  = $database->mysqlNumRows($sql_kotlist_1);
				if($num_kotlist_1){
				while($result_kotlist_1  = $database->mysqlFetchArray($sql_kotlist_1)) 
				{  
                                   
                                    
                                   $table_nw=$result_kotlist_1['ts_tableid'];
                                   $no_ts_noofpersons= $result_kotlist_1['ts_noofpersons'];
                                   $ts_floorid= $result_kotlist_1['ts_floorid'];
                                   $ts_dineintime= $result_kotlist_1['ts_dineintime'];
                                   $ts_orderstaff= $result_kotlist_1['ts_orderstaff'];
                                   $ts_reservetime= $result_kotlist_1['ts_reservetime'];
                                   $ts_totalamount= $result_kotlist_1['ts_totalamount'];
                                   $ts_entrydate= $result_kotlist_1['ts_entrydate'];
                                   $ts_paxcount= $result_kotlist_1['ts_paxcount'];
                                   $ts_username= $result_kotlist_1['ts_username'];
                                   $ts_machineid= $result_kotlist_1['ts_machineid'];
                                        
                                   // $ts_table_prfx= $result_kotlist_1['ts_tableidprefix'];
                                        
                                        
                                        
                                $sql_kotlist_12  =  $database->mysqlQuery("SELECT ts_tableidprefix from  tbl_tabledetails where ts_tableid='".$table_nw."' and ts_floorid='".$ts_floorid."' order by ts_tableidprefix asc "); 
				
                                $num_kotlist_12  = $database->mysqlNumRows($sql_kotlist_12);
				if($num_kotlist_12){
				while($result_kotlist_12  = $database->mysqlFetchArray($sql_kotlist_12)) 
				{  
                                    
                                    $ts_table_prfx=$result_kotlist_12['ts_tableidprefix'];
                                }
                                }
                                        
                                        
                                        
                                        if($ts_table_prfx=='A'){
                                            $now_prfx='B';
                                        }else if($ts_table_prfx=='B'){
                                             $now_prfx='C';
                                        }else if($ts_table_prfx=='C'){
                                             $now_prfx='D';
                                        }
                                         else if($ts_table_prfx=='D'){
                                             $now_prfx='E';
                                        }
                                         else if($ts_table_prfx=='E'){
                                             $now_prfx='F';
                                        }
                                        else if($ts_table_prfx=='F'){
                                             $now_prfx='G';
                                        }
                                        else if($ts_table_prfx=='G'){
                                             $now_prfx='H';
                                        }
                                         else if($ts_table_prfx=='H'){
                                             $now_prfx='I';
                                        }
                                        else if($ts_table_prfx=='I'){
                                             $now_prfx='J';
                                        }
                                        
                                   
                                   
                                                          }
                                }
                                
                                
                                
                                
                                
                                
                                  $sql_split_update_to1=$database->mysqlQuery("Insert into tbl_tabledetails (`ts_tableid`, `ts_tableidprefix`, `ts_status`, `ts_dineintime`, `ts_noofpersons`, `ts_orderno`, "
                                          . "`ts_floorid`, `ts_orderstaff`, `ts_reservetime`, `ts_totalamount`, `ts_entrydate`, `ts_interface`, `ts_billnumber`, `ts_paxcount`,"
                                          . " `ts_username`, `ts_in_access`, `ts_completed_order`, `ts_machineid`, `cloud_sync`) VALUES ('".$table_nw."','".$now_prfx."','Billed',"
                                          . " '".$ts_dineintime."','".$no_ts_noofpersons."','".$new_ord_spl."','".$ts_floorid."','".$ts_orderstaff."','".$ts_reservetime."',"
                                          . " '".$ts_totalamount."','".$ts_entrydate."','W','".$s."','".$ts_paxcount."','".$ts_username."','N','Y','".$ts_machineid."','N') ");
                                  
                                  
                                  $new_table_no_for_split=$table_nw.'('.$now_prfx.')';
                                  $sql_split_update_to=$database->mysqlQuery("update  tbl_tablebillmaster set bm_orderno='".$new_ord_spl."', bm_tableno='".$new_table_no_for_split."' where bm_billno='".$s."'");
                                  
                                  
                                  
                
                                  }
                                  ///end change///
                                  
                                  
                                  }
          
         //delete empty table///                         
         $sql_split_update_to1=$database->mysqlQuery(" delete from tbl_tabledetails where ts_tableid='$table_nw' and ts_totalamount='0' "
         .  " and ts_status='Served' and (ts_billnumber is NULL or ts_billnumber='') ");                       
                                 
                                  
                                
                                }
if($_SESSION['s_printst']=="Y") 
 {  
     $printpage->print_bill($s,"1","web",$_SESSION['billip'],$_SESSION['hosttype'],"N"); 
 }            
                                
        if($_REQUEST['point_redeem']>0 ||  $_REQUEST['point_add']>0){
             
          $date= date('Y-m-d H:i:s');
        
          $insertion['lob_billno']=  mysqli_real_escape_string($database->DatabaseLink,trim($s));
          
          
      if($_REQUEST['point_add']>0){
        $insertion['lob_point_add']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['point_add']));
      }
      
       if($_REQUEST['point_redeem']>0){
        $insertion['lob_point_redeem']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['point_redeem']));
       }
       
        if($_REQUEST['redeemamount']>0){
        $insertion['lob_redeem_amount']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['redeemamount']));
        }
        
         $insertion['lob_bill_amount']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['billamount']));
      
        $insertion['lob_date']= mysqli_real_escape_string($database->DatabaseLink,trim($date));
       
    
        $insertion['lob_loyalty_customer']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['id_loy']));
     
        $mode="DI";   
       
        
        $insertion['lob_mode']= mysqli_real_escape_string($database->DatabaseLink,trim($mode));
      
       
	
    $sql=$database->check_duplicate_entry('tbl_loyalty_pointadd_bill',$insertion);
    if($sql!=1)
	{
	    $insertid      =  $database->insert('tbl_loyalty_pointadd_bill',$insertion);
        }
        
        
        if($_REQUEST['point_redeem']>0){
            
           $sql_loy=$database->mysqlQuery("update tbl_loyalty_reg set ly_points=(ly_points-'".$_REQUEST['point_redeem']."') where ly_id='".$_REQUEST['id_loy']."'");  
           
          
        }
        
        if($_REQUEST['point_add']>0){ 
          $sql_loy=$database->mysqlQuery("update tbl_loyalty_reg set ly_points=(ly_points+'".$_REQUEST['point_add']."'),ly_totalvisit=ly_totalvisit+1  where ly_id='".$_REQUEST['id_loy']."'");
       
        }
        
        
        $a="8.8.8.8";
        exec("ping -n 1 -w 1 ".$a, $output, $result);
        if($result==0)
        {
       
           
                $sms_number='';
		$sms_text="";
		$be_sms_username="";
		$be_sms_apipassword="";
		$be_sms_senderid="";
                $be_sms_domainid="";
                $be_sms_method='';
                $be_sms_priority='';
	        $sql_general =  $database->mysqlQuery("Select * from tbl_generalsettings "); 
		$num_general  = $database->mysqlNumRows($sql_general);
		if($num_general)
		{
				while($result_general  = $database->mysqlFetchArray($sql_general)) 
					{
					     $be_sms_username			=$result_general['be_sms_username'];
					     $be_sms_apipassword		=$result_general['be_sms_apipassword'];
				             $be_sms_senderid			=$result_general['be_sms_senderid'];
		                             $be_sms_domainid			=$result_general['be_sms_domainid'];
                                             $be_sms_priority                   =$result_general['be_sms_priority'];                                                                                                           $be_sms_priority			=$result_general['be_sms_priority'];
                                             $be_sms_method                     =$result_general['be_sms_method'];                                                                                                              $be_sms_method			        =$result_general['be_sms_method'];
                                                 
                                        }
		  }
                  
                   if($_REQUEST['point_redeem']>0){
                       $rd="You have redeemed ".number_format($_REQUEST['point_redeem'],$_SESSION['be_decimal'])." points.";
                   }
                   
                    if($_REQUEST['point_add']>0){
                       $ad="You have earned ".number_format($_REQUEST['point_add'],$_SESSION['be_decimal'])." points.";
                   }
                   
                $common="(CS) Visit Again . Thank You .\n".$_SESSION['s_branchname']	;
		
		$l_name=$_REQUEST['loy_name'];
		$sms_text="Congratulations ".$l_name.".\n".$rd."\n".$ad."\n".$common;
                $date_sms = date('Y-m-d H:i:s');
                 
   $sql_split_insert=$database->mysqlQuery("INSERT INTO tbl_loyalty_sms_source(ls_sms_data, ls_date_sendon,ls_login_name) VALUES ('".$sms_text."','".$date_sms."','".$_SESSION['expodine_id']."')");  
       
                $sms_number=$_REQUEST['loy_number'];
		$api_password=$be_sms_apipassword;
		$smstype = $be_sms_method; 
                $username=urlencode($be_sms_username);
		$sender=urlencode($be_sms_senderid);
		$message=urlencode($sms_text);
		$domain=urlencode($be_sms_domainid);
                $route=urlencode($be_sms_priority);
		
               
                
                 $parameters="username=$username&api_password=$api_password&sender=$sender&to=$sms_number&priority=$route&message=$message";
		if($method=="POST")
		{
			$opts = array(
			  'http'=>array(
				'method'=>"$method",
				'content' => "$parameters",
				'header'=>"Accept-language: en\r\n" .
						  "Cookie: foo=bar\r\n"
			  )
			);
	
			$context = stream_context_create($opts);
	
			
		}
		else
		{
			$fp = fopen("http://$domain/pushsms.php?$parameters", "r");
		}
	
		$response = stream_get_contents($fp);
		fpassthru($fp);
		fclose($fp);
        }
        
 }              
                                
   
}

?>
