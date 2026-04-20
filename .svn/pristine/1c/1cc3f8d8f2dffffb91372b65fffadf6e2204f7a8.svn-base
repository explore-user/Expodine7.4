<?php

include('includes/session.php');		// Check session
include("database.class.php"); // DB Connection class
$database	= new Database(); 		// Create a new instance

if($_REQUEST['set']=="del")
{    
        $qty=0;
        $qty_ordered= $database->mysqlQuery(" select o.ter_menuid,o.ter_portion,o.ter_qty,o.ter_rate_type,o.ter_unit_type,o.ter_unit_id,o.ter_base_unit_id,o.ter_unit_weight from tbl_tableorder o where o.ter_orderno = '".$_REQUEST['linkId']."' and o.ter_slno='".$_REQUEST['sl']."' LIMIT 1 "); 
       
        $num_qty_ordered  = $database->mysqlNumRows($qty_ordered);
        if($num_qty_ordered){
            $result_qty_ordered =  $database->mysqlFetchArray($qty_ordered);
            if($result_qty_ordered['ter_rate_type']=='Portion'){
                $qty_update= $database->mysqlQuery( "UPDATE `tbl_menustock` SET `mk_stock_number`=`mk_stock_number`+'".$result_qty_ordered['ter_qty']."' where `mk_menuid`= '".$result_qty_ordered['ter_menuid']."' and `mk_portion`='".$result_qty_ordered['ter_portion']."'");
            
                
            }
            else { 
                if($result_qty_ordered['ter_unit_type']=='Packet'){
                  $qty_update= $database->mysqlQuery( "UPDATE `tbl_menustock` SET `mk_stock_number`=`mk_stock_number`+'".$result_qty_ordered['ter_qty']."' where `mk_menuid`= '".$result_qty_ordered['ter_menuid']."' and `mk_unit_id`='".$result_qty_ordered['ter_unit_id']."' and `mk_unit_weight`='".$result_qty_ordered['ter_unit_weight']."'");   
                }
                else if ($result_qty_ordered['ter_unit_type']=='Loose'){
                 $qty_update= $database->mysqlQuery( "UPDATE `tbl_menustock` SET `mk_stock_number`=`mk_stock_number`+'".$result_qty_ordered['ter_qty']."' where `mk_menuid`= '".$result_qty_ordered['ter_menuid']."'and `mk_base_unit_id`='".$result_qty_ordered['ter_base_unit_id']."'");   
                }
            }
            $linkId = mysqli_real_escape_string($database->DatabaseLink, $_POST["linkId"]);
            $slno = mysqli_real_escape_string($database->DatabaseLink, $_POST["sl"]);
	$query = $database->mysqlQuery( "DELETE FROM tbl_tableorder WHERE ter_orderno = '".$linkId."' and ter_slno='".$slno."' LIMIT 1") ;
        
        $qty_ordered_addon= $database->mysqlQuery(" select ter_slno,ter_menuid,ter_portion,ter_total_rate,ter_qty,ter_rate_type from tbl_tableorder  where ter_orderno ='".$_REQUEST['linkId']."'  and ter_addon_slno='".$_REQUEST['sl']."'  "); 
        //echo "select o.ter_menuid,o.ter_portion,o.ter_qty,o.ter_rate_type,o.ter_unit_type,o.ter_unit_id,o.ter_base_unit_id,o.ter_unit_weight from tbl_tableorder o where o.ter_orderno = '".$_REQUEST['linkId']."' and o.ter_slno='".$_REQUEST['sl']."' LIMIT 1 ";
        $num_qty_ordered_addon  = $database->mysqlNumRows($qty_ordered_addon);
        if($num_qty_ordered_addon){
            while($result_qty_ordered_addon =  $database->mysqlFetchArray($qty_ordered_addon)){
            
                $qty_update_addon= $database->mysqlQuery( "UPDATE `tbl_menustock` SET `mk_stock_number`=`mk_stock_number`+'".$result_qty_ordered_addon['ter_qty']."' where `mk_menuid`= '".$result_qty_ordered_addon['ter_menuid']."' and `mk_portion`='1'");
                $database->mysqlQuery("delete from  tbl_tableorder where ter_orderno='".$_REQUEST['linkId']."' and  ter_slno='".$result_qty_ordered_addon['ter_slno']."' and  ter_addon_slno='".$_REQUEST['sl']."' ");
                }
        }
        //$addon_delete_query = $database->mysqlQuery( "DELETE FROM tbl_order_addon WHERE ad_orderno = '".$linkId."' and ad_order_slno='".$slno."' ") ;
        }    
	
	
}else if($_REQUEST['set']=="confirm")
{
        $waiterid = $_REQUEST['waiter'];
	$linkId = $_SESSION['order_id'];
        
        $order_confirming_staff=$_REQUEST['order_confirming_staff'];
        
		$returnmsg='';
                
		if(strpos($linkId, 'TEMP') !== false)	
		 {
                    
			 try {
					 
				$database->mysqlQuery("SET @temp_orderno = " . "'" . mysqli_real_escape_string($database->DatabaseLink, $_SESSION['order_id']) . "'");
				$database->mysqlQuery("SET @branchid = " . "'" . mysqli_real_escape_string($database->DatabaseLink,$_SESSION['branchofid']) . "'");
                                $database->mysqlQuery("SET @order_confirming_staff = " . "'" . mysqli_real_escape_string($database->DatabaseLink,$order_confirming_staff) . "'");
                                $database->mysqlQuery("SET @water_id = " . "'" . mysqli_real_escape_string($database->DatabaseLink,$waiterid) . "'");
				$neworderno='';
				$kotnum='';
				$sq=$database->mysqlQuery("CALL proc_tableorder(@temp_orderno,@branchid,@neworderno,@kotnum,@water_id,@order_confirming_staff)") or $database->throw_ex(mysqli_error($database->DatabaseLink));
				$rs = $database->mysqlQuery( 'SELECT @neworderno AS neworderno,@kotnum AS kotnum' );
				while($row = $database->mysqlFetchArray($rs))
				{
                                    $_SESSION['order_id']= $row['neworderno'];
                                    $_SESSION['kot_id']= $row['kotnum'];
				}
				
				$returnmsg="";
                                $sql_menulist1 = "UPDATE tbl_tabledetails SET ts_orderstaff='" . $order_confirming_staff . "' where ts_orderno='" . $_SESSION['order_id'] . "'";
                                $sql_menus1 = $database->mysqlQuery($sql_menulist1);
                                
			  } catch (Exception $e) {
                              
				  $returnmsg= 'Caught exception: '.  $e;
				  $content = date("l F d-m-Y h:i:s A")." ".$returnmsg.PHP_EOL;
				  file_put_contents($file, $content, FILE_APPEND | LOCK_EX);
				  echo   $returnmsg;exit();
			  }
                          
			}else
			{
                            
			 try {
                             
				//orderno branchid kotnum message	 
				$database->mysqlQuery("SET @orderno = " . "'" . mysqli_real_escape_string($database->DatabaseLink, $_SESSION['order_id']) . "'");
				$database->mysqlQuery("SET @branchid = " . "'" . mysqli_real_escape_string($database->DatabaseLink,$_SESSION['branchofid']) . "'");
                                $database->mysqlQuery("SET @waiter_id = " . "'" . mysqli_real_escape_string($database->DatabaseLink,$waiterid) . "'");
				$database->mysqlQuery("SET @order_confirming_staff = " . "'" . mysqli_real_escape_string($database->DatabaseLink,$order_confirming_staff) . "'");
				$kotnum='';
				$message='';
				$sq=$database->mysqlQuery("CALL proc_tableorder_update(@orderno,@branchid,@kotnum,@message,@waiter_id,@order_confirming_staff)") or $database->throw_ex(mysqli_error($database->DatabaseLink));
				$rs = $database->mysqlQuery( 'SELECT @kotnum AS kotnum,@message AS message' );
				while($row = $database->mysqlFetchArray($rs))
				{
                                  
				  $_SESSION['kot_id']= $row['kotnum'];
                                
				}
                                
        $online_on='N'; $qr_db=''; 

        $sql_desg_nos1="select be_online_order_enable,be_qrcode_db from tbl_branchmaster   ";
        $sql_desg1  =  $database->mysqlQuery($sql_desg_nos1);
        $num_desg1  = $database->mysqlNumRows($sql_desg1);
        if($num_desg1){
        while($result_desg1  = $database->mysqlFetchArray($sql_desg1)) 
        {
               $online_on	=$result_desg1['be_online_order_enable'];
               $qr_db           =$result_desg1['be_qrcode_db'];


        }}         
	
   if($online_on=='Y' && $qr_db!=''){
 
                   $ord='';  $tax=0;    $floor='';   
                   
                   $sql_qry111 = $database->mysqlQuery("select * from tbl_tableorder 
                   where ter_dayclosedate='".$_SESSION['date']."' and ter_orderno = '".$_SESSION['order_id']."'  ");
        
                    $num_rows111 = $database->mysqlNumRows($sql_qry111);
                    if($num_rows111){
                          while($result_row111 = $database->mysqlFetchArray($sql_qry111)){  

                            if($result_row111['ter_qr_order']!=''){  
                              
                                 $ord=$result_row111['ter_qr_order'];
                            
                                 $floor=$result_row111['ter_floorid'];
                              
                            }
                            
            if($result_row111['ter_qr_order']!=''){
                                
            $con=mysqli_connect(HOST_NAME_CLOUD, USER_NAME_CLOUD, PASSWORD_CLOUD,DATABASE_NAME_QR);                        
       
            $date=date('Y-m-d H:i:s');
        
            $sql_menuaddon = "select tqi_orderno from tbl_qr_order_item  WHERE  "
            . " tqi_branch='".$_SESSION['firebase_id']."' and tqi_orderno='".$ord."' and tqi_synced='Y' and tqi_orderno!='' ";
           
            $sql_menuaddon1  =  mysqli_query($con,$sql_menuaddon); 
            $num_menuaddon  = mysqli_num_rows($sql_menuaddon1);
            if($num_menuaddon){
                    
                $run 	= 'N'; 
                
                
            }else{
                  $run 	= 'N'; 
                
            }
       
                    $sql_gen =  mysqli_query($con,"INSERT INTO `tbl_qr_order_item`(`tqi_branch`, `tqi_orderno`, `tqi_menuid`,"
                    . " `tqi_portion`, `tqi_qty`, `tqi_rate`, `tqi_total`, `tqi_synced`, `tqi_running`, `tqi_date`) "
                    . " VALUES "
                    . " ('".$_SESSION['firebase_id']."','$ord','".$result_row111['ter_menuid']."','".$result_row111['ter_portion']."',"
                    . " '".$result_row111['ter_qty']."','".$result_row111['ter_rate']."',"
                    . " '".$result_row111['ter_total_rate']."','Y','$run','$date')");
                    
                 
                     
            
          $tot=0; 
          $sql_menuaddon = "select tqi_orderno,tqi_total from tbl_qr_order_item  WHERE  "
          . "tqi_branch='".$_SESSION['firebase_id']."' and tqi_orderno='".$ord."' ";
          
                   $sql_menuaddon1  =  mysqli_query($con,$sql_menuaddon); 
                    $num_menuaddon  = mysqli_num_rows($sql_menuaddon1);
                    if($num_menuaddon){
                        while($result_menus  = mysqli_fetch_array($sql_menuaddon1)) 
			{
                            
                             $tot=$tot+$result_menus['tqi_total'];
                        }
                        }
                        
            $sql_menuaddon4 = "select * from tbl_extra_tax_master left join tbl_floor_tax on tbl_floor_tax.ft_tax_id=tbl_extra_tax_master.amc_id "
                 . " WHERE tbl_floor_tax.ft_floorid='$floor' "
                 . " and tbl_extra_tax_master.amc_enable_ta='Y' group by tbl_floor_tax.ft_floorid,tbl_floor_tax.ft_tax_id ";
             
            
            $sql_menuaddon12  =  mysqli_query($con,$sql_menuaddon4); 
                    $num_menuaddon2  = mysqli_num_rows($sql_menuaddon12);
                    if($num_menuaddon2){
                        while($result_menus2  = mysqli_fetch_array($sql_menuaddon12)) 
			{
                            
                             $tax= $tax+(($result_menus2['amc_value']*$tot)/100)  ;    
                        }
                        }
            
                $final=($tax+$tot);
          
                $sql_gen =  mysqli_query($con,"update tbl_qr_order_details set tq_amount='$tot' ,tq_tax='$tax',tq_final='$final' where"
                . "  tq_branch='".$_SESSION['firebase_id']."'  and  tq_order_no='$ord'  ");                                  
                         
                
                
                $sql_qry111 = $database->mysqlQuery("update tbl_tableorder set ter_qr_order='$ord' where "
                . " ter_dayclosedate='".$_SESSION['date']."' and ter_orderno = '".$_SESSION['order_id']."' and ter_menuid='".$result_row111['ter_menuid']."' ");
                
                
        }
        
        
        } }
        
        }
          
			  $returnmsg="";
                           
			  }catch (Exception $e) {
				  $returnmsg= 'Caught exception: '.  $e;
				  $content = date("l F d-m-Y h:i:s A")." ".$returnmsg.PHP_EOL;
				  file_put_contents($file, $content, FILE_APPEND | LOCK_EX);
				  echo   $returnmsg;exit();
			  }
				
			}
	
        $sql_listall5  =  $database->mysqlQuery("update tbl_menu_preference_kot set tmp_orderno_bill='".$_SESSION['order_id']."' where"
        . " tmp_orderno_bill='$linkId' ");
             
        $sq=$database->mysqlQuery("UPDATE tbl_tabledetails SET ts_in_access='N' WHERE ts_orderno='".$_SESSION['order_id']."' ");
	
        if($_SESSION['auto_accept_qr']=='Y'){
           echo $_SESSION['kot_id']; 
        }else{
           echo $returnmsg; 
        }
	
  
  
        
}
else if(isset($_REQUEST['set_delete_all']) && $_REQUEST['set_delete_all']=="delete_all_di")
{

    
    ////////stockupdate//////
          $sql_qry111 = $database->mysqlQuery("select ter_qty,ter_menuid,ter_portion from tbl_tableorder 
        where ter_orderno = '".$_REQUEST['order_all']."' and  ter_kotno='0' ");
        
            $num_rows111 = $database->mysqlNumRows($sql_qry111);
              if($num_rows111){
              while($result_row111 = $database->mysqlFetchArray($sql_qry111)){
      
      
              $qty_update= $database->mysqlQuery( "UPDATE tbl_menustock SET "
              . " mk_stock_number=mk_stock_number+'".$result_row111['ter_qty']."' "
              . " where mk_menuid= '".$result_row111['ter_menuid']."' "
              . " and mk_portion= '".$result_row111['ter_portion']."' and mk_open_stock_date='".$_SESSION['date']."' and mk_opening_stock >0 ");
      
           }
             }
         ////stockend///////
    
    
    
$query = $database->mysqlQuery( "DELETE FROM tbl_tableorder WHERE ter_orderno = '".$_REQUEST['order_all']."' and ter_kotno='0' ") ;

$query1 = $database->mysqlQuery( "DELETE FROM tbl_combo_ordering_details WHERE cod_orderno = '".$_REQUEST['order_all']."' and cod_order_status='Added'  ") ;

}
?>